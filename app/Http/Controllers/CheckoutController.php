<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum('total_price');
        $tax = $total * 0.11; // 11% tax
        $grandTotal = $total + $tax;

        return view('pages.checkout.checkout', compact('cartItems', 'total', 'tax', 'grandTotal'));
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

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum('total_price');
        $tax = $total * 0.11;
        $grandTotal = $total + $tax;

        // Store order data in session
        $orderData = [
            'order_code' => (new Order)->generateOrderCode(),
            'customer_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'product_id' => $cartItems->first()->product_id,
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
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => $orderData['phone_number'],
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $orderData['snap_token'] = $snapToken;

        // Store in session
        session(['pending_order' => $orderData]);

        return view('pages.checkout.payment', compact(
            'cartItems',
            'total',
            'tax',
            'grandTotal',
            'request',
            'orderData'
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
            $order->status = "success";
            $order->save();

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'method' => $request->payment_method,
                'amount' => $order->total_amount,
                'status' => 'success'
            ]);

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

}
