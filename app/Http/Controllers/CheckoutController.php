<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        // Clear any existing sessions when starting a new checkout
        session()->forget(['pending_order', 'direct_checkout_item']);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        
        $total = $cartItems->sum('total_price');
        $tax = $total * 0.11;
        $grandTotal = $total + $tax;

        return view('pages.checkout.checkout', compact('cartItems', 'total', 'tax', 'grandTotal'));
    }

    public function directCheckout(Request $request)
    {
        // Clear any existing sessions when starting a new direct checkout
        session()->forget(['pending_order', 'direct_checkout_item']);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Calculate total price
        $product = \App\Models\Product::findOrFail($request->product_id);
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $startDate->diff($endDate)->days + 1;
        $total = $product->price * $days;
        $tax = $total * 0.11;
        $grandTotal = $total + $tax;

        // Create a temporary cart item for the checkout
        $tempCartItem = (object)[
            'product' => $product,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'total_price' => $total
        ];

        // Store the temporary cart item in session
        session(['direct_checkout_item' => $tempCartItem]);

        return view('pages.checkout.checkout', [
            'cartItems' => collect([$tempCartItem]),
            'total' => $total,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
            'isDirectCheckout' => true
        ]);
    }

    public function payment(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric',
            'is_delivered' => 'required|boolean',
            'pickup_location' => 'required_if:is_delivered,0|string|nullable',
            'delivery_location' => 'required_if:is_delivered,1|string',
            'return_location' => 'required|string',
        ]);

        // Clear any existing pending order from session
        session()->forget('pending_order');

        // Check if this is a direct checkout
        $directCheckoutItem = session('direct_checkout_item');
        $isDirectCheckout = !empty($directCheckoutItem);
        
        if ($directCheckoutItem) {
            $cartItems = collect([$directCheckoutItem]);
            $total = $directCheckoutItem->total_price;
        } else {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
            $total = $cartItems->sum('total_price');
        }

        $tax = $total * 0.11;
        $grandTotal = $total + $tax;

        // Get the product ID based on checkout type
        $productId = $directCheckoutItem 
            ? $directCheckoutItem->product->id 
            : $cartItems->first()->product_id;

        // Create new order data
        $orderData = [
            'order_code' => (new Order)->generateOrderCode(),
            'customer_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'product_id' => $productId,
            'is_delivered' => $request->is_delivered,
            'delivery_fee' => 0,
            'pickup_location' => $request->is_delivered ? null : $request->pickup_location,
            'delivery_location' => $request->delivery_location,
            'return_location' => $request->return_location,
            'total_amount' => $grandTotal,
            'started_at' => $cartItems->first()->start_date,
            'ended_at' => $cartItems->first()->end_date,
            'status' => 'pending'
        ];

        // Generate Midtrans snap token
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderData['order_code'],
                'gross_amount' => $grandTotal,
            ),
            'item_details' => $cartItems->map(function($item) use ($directCheckoutItem) {
                // Calculate days for this item
                $startDate = new \DateTime($item->start_date);
                $endDate = new \DateTime($item->end_date);
                $days = $startDate->diff($endDate)->days + 1;
                
                // Calculate total price for this item
                $itemTotal = $item->product->price * $days;
                
                return array(
                    'id' => $directCheckoutItem ? $item->product->id : $item->product_id,
                    'price' => $itemTotal,
                    'quantity' => 1,
                    'name' => $item->product->name . ' (' . $days . ' hari)'
                );
            })->toArray(),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $orderData['phone_number'],
            ),
        );

        // Add tax as a separate item
        $taxAmount = $total * 0.11; // 11% tax
        $params['item_details'][] = array(
            'id' => 'TAX',
            'price' => $taxAmount,
            'quantity' => 1,
            'name' => 'Pajak (11%)'
        );

        // Ensure gross amount includes tax
        $params['transaction_details']['gross_amount'] = $total + $taxAmount;
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $orderData['snap_token'] = $snapToken;

        // Save Payment status
        $payment = new Payment;
        $payment->order_code = $orderData['order_code'];
        $payment->snap_token = $orderData['snap_token'];
        $payment->gross_amount = $grandTotal;
        $payment->payment_status = 'pending';
        $payment->save();

        // Store in session
        session(['pending_order' => $orderData]);

        return view('pages.checkout.payment', compact(
            'cartItems',
            'total',
            'tax',
            'grandTotal',
            'request',
            'orderData',
            'isDirectCheckout'
        ));
    }

    public function process(Request $request)
    {
        try {
            DB::beginTransaction(); 

            // Get order data from session
            $orderData = session('pending_order');
            
            if (!$orderData) {
                throw new \Exception('Order data not found. Please try again.');
            }

            // Create the order
            $order = Order::create($orderData);
            // Clear cart and session
            Cart::where('user_id', Auth::id())->delete();
            session()->forget('pending_order');

            DB::commit();

            return redirect()->route('checkout.confirmation', $order->order_code)
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    public function confirmation($orderCode)
    {
        $order = Order::with(['product', 'customer'])
            ->where('order_code', $orderCode)
            ->firstOrFail();

        $payment = Payment::where('order_id', $order->id)->first();

        return view('pages.checkout.confirmation', compact('order', 'payment', 'breadcrumbs'));
    }
    /**
     * Calculate order totals
     */
    public function calculateTotals(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        $tax = $subtotal * 0.11; // 11% tax
        $total = $subtotal + $tax;

        return response()->json([
            'status' => 'success',
            'data' => [
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'items' => $cartItems->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'subtotal' => $item->product->price * $item->quantity
                    ];
                })
            ]
        ]);
    }

    public function webhook(Request $request)
    {
        try {
            $payload = $request->all();
            
            // Verify signature
            $signatureKey = $payload['signature_key'];
            $orderId = $payload['order_id'];
            $statusCode = $payload['status_code'];
            $grossAmount = $payload['gross_amount'];
            $serverKey = config('midtrans.serverKey');
            $mySignatureKey = hash('sha512', $orderId.$statusCode.$grossAmount.$serverKey);
            
            if ($signatureKey !== $mySignatureKey) {
                return response()->json(['message' => 'Invalid signature'], 400);
            }

            $transactionStatus = $payload['transaction_status'];
            $fraudStatus = $payload['fraud_status'] ?? null;
            $paymentType = $payload['payment_type'] ?? null;
            $vaNumber = $payload['va_numbers'][0]['va_number'] ?? null;
            $bank = $payload['va_numbers'][0]['bank'] ?? null;

            $payment = Payment::where('order_code', $orderId)->first();
            
            if (!$payment) {
                return response()->json(['message' => 'Payment not found'], 404);
            }

            DB::beginTransaction();
            
            // Map Midtrans status to payment status
            switch ($transactionStatus) {
                case 'capture':
                    if ($fraudStatus == 'challenge') {
                        $payment->payment_status = 'pending';
                    } else if ($fraudStatus == 'accept') {
                        $payment->payment_status = 'paid';
                    }
                    break;
                case 'settlement':
                    $payment->payment_status = 'paid';
                    break;
                case 'pending':
                    $payment->payment_status = 'pending';
                    break;
                case 'deny':
                case 'failure':
                    $payment->payment_status = 'failed';
                    break;
                case 'cancel':
                case 'expire':
                    $payment->payment_status = 'expired';
                    break;
                case 'refund':
                    $payment->payment_status = 'refunded';
                    break;
            }

            // Update payment details
            $payment->payment_type = $paymentType;
            $payment->va_number = $vaNumber;
            $payment->bank = $bank;
            $payment->save();

            // Update order status if payment is successful
            if ($payment->payment_status === 'paid') {
                $order = Order::where('order_code', $orderId)->first();
                if ($order) {
                    $order->status = 'menunggu konfirmasi';
                    $order->save();
                }
            }

            DB::commit();
            
            return response()->json(['message' => 'Success'], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
