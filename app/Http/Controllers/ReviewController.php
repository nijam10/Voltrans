<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $orderItem = OrderItem::findOrFail($request->order_item_id);
        if ($orderItem->review) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk item ini.');
        }
        if ($orderItem->status !== 'selesai') {
            return redirect()->back()->with('error', 'Anda hanya dapat mengulas item yang sudah selesai.');
        }
        $review = Review::create([
            'order_item_id' => $orderItem->id,
            'product_id' => $request->product_id,
            'customer_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
} 