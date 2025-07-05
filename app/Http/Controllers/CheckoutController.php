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

        // Check if user has verified address
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $verifiedAddress = $user->addresses()->where('is_verified', true)->first();
        
        if (!$verifiedAddress) {
            return redirect()->route('user.addresses.index')
                ->with('error', 'Anda harus menambahkan dan memverifikasi alamat terlebih dahulu sebelum dapat melakukan checkout. Silakan tambahkan alamat di profil Anda.');
        }

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

        // Check if user has verified address
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $verifiedAddress = $user->addresses()->where('is_verified', true)->first();
        
        if (!$verifiedAddress) {
            return redirect()->route('user.addresses.index')
                ->with('error', 'Anda harus menambahkan dan memverifikasi alamat terlebih dahulu sebelum dapat melakukan checkout. Silakan tambahkan alamat di profil Anda.');
        }

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

    /**
     * Handle payment processing for verified orders
     * 
     * This method handles both new order creation and payment for verified orders.
     * For verified orders, it checks for existing payments to prevent Midtrans API errors
     * when users refresh the payment page (order_id already taken error).
     * 
     * @param Request $request
     * @param string|null $orderCode
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request, $orderCode = null)
    {
        // Check if this is a verified order payment
        $orderCode = $orderCode ?? $request->input('order_code');
        $order = null;

        if ($orderCode) {
            // This is a verified order payment - no need for validation as data comes from existing order
            $order = Order::with(['items.product', 'customer'])
                ->where('order_code', $orderCode)
                ->where('customer_id', Auth::id())
                ->where('status', 'diverifikasi')
                ->firstOrFail();

        } else {
            // This is a new order - validate the input and create order immediately
            $request->validate([
                'phone_number' => ['required', 'regex:/^08[0-9]{8,11}$/', 'numeric'],
                'is_delivered' => 'required|boolean',
                'delivery_location' => 'required_if:is_delivered,1|string',
            ], [
                'phone_number.regex' => 'Nomor telepon harus dimulai dengan 08 dan diikuti 8-11 digit angka',
                'phone_number.numeric' => 'Nomor telepon harus berupa angka',
            ]);

            // Check if this is a direct checkout
            $directCheckoutItem = session('direct_checkout_item');
            
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

            // Process delivery location
            $deliveryLocationData = json_decode($request->delivery_location, true);
            $processedDeliveryLocation = $this->processLocationData($deliveryLocationData);

            // Create new order immediately with pending verification status
            $orderData = [
                'order_code' => (new Order)->generateOrderCode(),
                'customer_id' => Auth::id(),
                'phone_number' => $request->phone_number,
                'is_delivered' => $request->is_delivered,
                'delivery_fee' => 0,
                'delivery_location' => $processedDeliveryLocation,
                'status' => 'menunggu_verifikasi', // Set status to pending verification
            ];

            // Create the order
            $order = Order::create($orderData);

            // Create order items
            if ($directCheckoutItem) {
                // Direct order: create one OrderItem
                $days = (new \DateTime($directCheckoutItem->end_date))->diff(new \DateTime($directCheckoutItem->start_date))->days + 1;
                $price = $directCheckoutItem->product->price;
                $subtotal = $price * $days;
                $order->items()->create([
                    'product_id' => $directCheckoutItem->product->id,
                    'price' => $price,
                    'subtotal' => $subtotal,
                    'started_at' => $directCheckoutItem->start_date,
                    'ended_at' => $directCheckoutItem->end_date,
                    'status' => 'dalam_proses',
                ]);
            } else {
                // Cart order: create OrderItem for each cart item
                $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
                foreach ($cartItems as $item) {
                    $days = (new \DateTime($item->end_date))->diff(new \DateTime($item->start_date))->days + 1;
                    $price = $item->product->price;
                    $subtotal = $price * $days;
                    $order->items()->create([
                        'product_id' => $item->product_id,
                        'price' => $price,
                        'subtotal' => $subtotal,
                        'started_at' => $item->start_date,
                        'ended_at' => $item->end_date,
                        'status' => 'dalam_proses',
                    ]);
                }
                // Clear cart after creating order items
                Cart::where('user_id', Auth::id())->delete();
            }

            // Clear sessions
            session()->forget(['pending_order', 'direct_checkout_item']);

            // Redirect to user orders page for new orders
            return redirect()->route('user.orders.index')
                ->with('success', 'Pesanan berhasil dibuat! Pesanan Anda sedang menunggu verifikasi admin.');
        }

        // Handle verified order payment (existing verified orders)
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $verifiedAddress = $user->addresses()->where('is_verified', true)->first();
        
        if (!$verifiedAddress) {
            return redirect()->route('user.addresses.index')
                ->with('error', 'Anda harus menambahkan dan memverifikasi alamat terlebih dahulu sebelum dapat melakukan checkout. Silakan tambahkan alamat di profil Anda.');
        }

        // Calculate totals
        $total = $order->items->sum('subtotal');
        $tax = $total * 0.11;
        $grandTotal = $total + $tax;

        // Check if payment already exists for this order
        $existingPayment = Payment::where('order_code', $order->order_code)->first();
        
        if ($existingPayment) {
            // Check if the existing payment is still valid
            $paymentAge = now()->diffInMinutes($existingPayment->created_at);
            $isExpired = $paymentAge > 60;
            
            if ($existingPayment->payment_status === 'paid') {
                // Payment already completed, redirect to confirmation
                return redirect()->route('checkout.confirmation', $order->order_code)
                    ->with('info', 'Pembayaran sudah selesai.');
            } elseif ($existingPayment->payment_status === 'failed' || $existingPayment->payment_status === 'expired' || $isExpired) {
                // Payment failed/expired, delete old payment and create new one
                Log::info('Deleting expired/failed payment for order: ' . $order->order_code, [
                    'payment_status' => $existingPayment->payment_status,
                    'payment_age_minutes' => $paymentAge
                ]);
                $existingPayment->delete();
            } else {
                // Use existing valid payment data
                $snapToken = $existingPayment->snap_token;
                
                // Store order data in session for processing
                $orderData = [
                    'order_code' => $order->order_code,
                    'customer_id' => $order->customer_id,
                    'phone_number' => $order->phone_number,
                    'is_delivered' => $order->is_delivered,
                    'delivery_fee' => $order->delivery_fee,
                    'delivery_location' => $order->delivery_location,
                    'snap_token' => $snapToken,
                ];

                session(['pending_order' => $orderData]);

                return view('pages.checkout.payment', [
                    'cartItems' => $order->items,
                    'total' => $total,
                    'tax' => $tax,
                    'grandTotal' => $grandTotal,
                    'request' => (object)['phone_number' => $order->phone_number, 'delivery_location' => $order->delivery_location],
                    'orderData' => $orderData,
                    'isDirectCheckout' => false,
                    'isVerifiedOrder' => true
                ]);
            }
        }

        // Generate new Midtrans snap token only if no existing payment
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->order_code,
                'gross_amount' => $grandTotal,
            ),
            'item_details' => $order->items->map(function($item) {
                $days = \Carbon\Carbon::parse($item->started_at)->diffInDays(\Carbon\Carbon::parse($item->ended_at)) + 1;
                return array(
                    'id' => $item->product_id,
                    'price' => $item->subtotal,
                    'quantity' => 1,
                    'name' => $item->product->name . ' (' . $days . ' hari)'
                );
            })->toArray(),
            'customer_details' => array(
                'first_name' => $order->customer->name,
                'email' => $order->customer->email,
                'phone' => $order->phone_number,
            ),
        );

        // Add tax as a separate item
        $taxAmount = $total * 0.11; 
        $params['item_details'][] = array(
            'id' => 'TAX',
            'price' => $taxAmount,
            'quantity' => 1,
            'name' => 'Pajak (11%)'
        );

        // Ensure gross amount includes tax
        $params['transaction_details']['gross_amount'] = $total + $taxAmount;
        
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans API Error: ' . $e->getMessage(), [
                'order_code' => $order->order_code,
                'params' => $params
            ]);
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
        }

        // Save Payment status
        $payment = new Payment;
        $payment->order_code = $order->order_code;
        $payment->snap_token = $snapToken;
        $payment->gross_amount = $grandTotal;
        $payment->payment_status = 'pending';
        $payment->save();

        // Store order data in session for processing
        $orderData = [
            'order_code' => $order->order_code,
            'customer_id' => $order->customer_id,
            'phone_number' => $order->phone_number,
            'is_delivered' => $order->is_delivered,
            'delivery_fee' => $order->delivery_fee,
            'delivery_location' => $order->delivery_location,
            'snap_token' => $snapToken,
        ];

        session(['pending_order' => $orderData]);

        return view('pages.checkout.payment', [
            'cartItems' => $order->items,
            'total' => $total,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
            'request' => (object)['phone_number' => $order->phone_number, 'delivery_location' => $order->delivery_location],
            'orderData' => $orderData,
            'isDirectCheckout' => false,
            'isVerifiedOrder' => true
        ]);
    }

    /**
     * Process location data for delivery addresses
     */
    private function processLocationData($locationData)
    {
        if (!$locationData) {
            return null;
        }

        switch ($locationData['type']) {
            case 'existing':
                // Get existing address from database
                $address = \App\Models\Address::find($locationData['address_id']);
                if ($address) {
                    return json_encode([
                        'type' => 'existing',
                        'address_id' => $address->id,
                        'name' => $address->name,
                        'address' => $address->address,
                        'province' => $address->province,
                        'city' => $address->city,
                        'state' => $address->state,
                        'postal_code' => $address->postal_code
                    ]);
                }
                break;

            case 'new':
                // For delivery (kirim ke alamat), do NOT save new address to database, just use for this payment
                return json_encode([
                    'type' => 'new',
                    'name' => $locationData['name'],
                    'address' => $locationData['address_detail'],
                    'province' => $locationData['province'],
                    'city' => $locationData['city'],
                    'state' => $locationData['state'],
                    'postal_code' => $locationData['postal_code']
                ]);

            case 'pickup':
                return json_encode([
                    'type' => 'pickup',
                    'location' => $locationData['location']
                ]);
        }

        return null;
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

            // This should only handle verified orders (status: diverifikasi)
            $existingOrder = Order::where('order_code', $orderData['order_code'])->first();
            
            if (!$existingOrder) {
                throw new \Exception('Order not found. Please try again.');
            }

            // Update the payment status
            $payment = Payment::where('order_code', $existingOrder->order_code)->first();
            if ($payment) {
                $payment->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
            
            // Update order status to completed since payment is successful
            $existingOrder->update([
                'status' => 'dalam_proses'
            ]);
            
            // Clear session
            session()->forget(['pending_order', 'direct_checkout_item']);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diproses!',
                'redirect' => route('checkout.confirmation', $existingOrder->order_code)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function confirmation($orderCode)
    {
        $order = Order::with(['items', 'customer'])
            ->where('order_code', $orderCode)
            ->firstOrFail();
        $payment = Payment::where('order_code', $orderCode)->first();
        return view('pages.checkout.confirmation', compact('order', 'payment'));
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
                        $payment->paid_at = now();
                    }
                    break;
                case 'settlement':
                    $payment->payment_status = 'paid';
                    $payment->paid_at = now();
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
                    if ($order->status === 'diverifikasi') {
                        $order->status = 'dalam_proses';
                    } else if ($order->status === 'dalam_proses') {
                        $order->status = 'selesai';
                    }
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
