<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Sewa', 'url' => route('rent')],
            ['label' => 'Wuling Air EV', 'url' => route('product-detail')],
            ['label' => 'Detail Pesanan'], // yang ini aktif (tidak ada URL)
        ];

        return view('pages.order', compact('breadcrumbs'));
    }

    public function calculateOrderTotal(Request $request)
    {
        // Get order items and calculate subtotal
        $orderItems = $request->input('items', []);
        $subtotal = collect($orderItems)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $discountCode = $request->input('discount_code');
        $discountAmount = 0;
        $finalTotal = $subtotal;

        // Apply discount if provided
        if ($discountCode) {
            $discount = Discount::where('code', $discountCode)
                ->where('is_active', true)
                ->first();

            if ($discount && $discount->isValid()) {
                $discountResult = $discount->applyToOrder($subtotal);
                
                $discountAmount = $discountResult['discount_amount'];
                $finalTotal = $discountResult['final_total'];
            }
        }

        return response()->json([
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'final_total' => $finalTotal,
            'subtotal' => 'Rp ' . number_format($subtotal, 0, ',', '.'),
            'discount_amount' => 'Rp ' . number_format($discountAmount, 0, ',', '.'),
            'final_total' => 'Rp ' . number_format($finalTotal, 0, ',', '.')
        ]);
    }
}
