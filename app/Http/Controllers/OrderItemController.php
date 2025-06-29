<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    /**
     * Display a listing of order items for the authenticated user
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get all order items from user's orders
        $orderItems = OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['order', 'product'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $orderItems = OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('status', $request->status)
            ->with(['order', 'product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $orderItems = $orderItems->where('started_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $orderItems = $orderItems->where('ended_at', '<=', $request->date_to);
        }

        return view('profile.order-items.index', compact('orderItems'));
    }

    /**
     * Display the specified order item
     */
    public function show(OrderItem $orderItem)
    {
        // Ensure the user owns this order item
        if ($orderItem->order->user_id !== Auth::id()) {
            abort(403);
        }

        $orderItem->load(['order', 'product']);

        return view('profile.order-items.show', compact('orderItem'));
    }

    /**
     * Get order items for a specific order
     */
    public function getOrderItems(Order $order)
    {
        // Ensure the user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $orderItems = $order->items()->with('product')->get();

        return response()->json($orderItems);
    }

    /**
     * Get order item status updates
     */
    public function getStatusUpdates(OrderItem $orderItem)
    {
        // Ensure the user owns this order item
        if ($orderItem->order->user_id !== Auth::id()) {
            abort(403);
        }

        // This would typically come from a separate status_logs table
        // For now, we'll return basic status information
        $statusUpdates = [
            [
                'status' => $orderItem->status,
                'label' => $orderItem->status_label,
                'timestamp' => $orderItem->updated_at,
                'description' => $this->getStatusDescription($orderItem->status)
            ]
        ];

        return response()->json($statusUpdates);
    }

    /**
     * Get status description for order items
     */
    private function getStatusDescription(string $status): string
    {
        return match($status) {
            'dalam_proses' => 'Kendaraan sedang dalam proses persiapan atau sedang digunakan',
            'selesai' => 'Rental kendaraan telah selesai dan kendaraan telah dikembalikan',
            'dibatalkan' => 'Rental kendaraan telah dibatalkan',
            default => 'Status tidak diketahui'
        };
    }
} 