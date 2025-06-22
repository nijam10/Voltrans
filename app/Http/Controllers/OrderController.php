<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show the user's orders.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('customer_id', Auth::id())
            ->latest()
            ->get();

        return view('profile.orders.index', compact('orders'));
    }

    /**
     * Show the detailed order information.
     *
     * @param Order $order
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['items.product', 'customer']);

        return view('profile.orders.show', compact('order'));
    }

    /**
     * Cancel an order that is waiting for confirmation.
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request, Order $order)
    {
        // Ensure user can only cancel their own orders
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        // Only allow cancellation for orders waiting for confirmation
        if ($order->status !== 'sedang_diproses') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:500'
        ]);

        $order->update([
            'status' => 'dibatalkan',
            'cancellation_reason' => $request->cancellation_reason
        ]);

        return redirect()->route('user.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
