<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum('total_price');

        return view('pages.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Calculate number of days
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) + 1;

        // Calculate total price
        $totalPrice = $product->price * $days;

        // Check if product already in cart
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_price' => $totalPrice
            ]);

            return redirect()->route('cart')
                ->with('success', $product->name . ' berhasil ditambahkan ke keranjang');
        }

        // Create new cart item
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice
        ]);

        return redirect()->route('cart')
            ->with('success', $product->name . ' berhasil ditambahkan ke keranjang');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart')
                ->with('error', 'Unauthorized action');
        }

        $cart->delete();
        
        return redirect()->route('cart')
            ->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
