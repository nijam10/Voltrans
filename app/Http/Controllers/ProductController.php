<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Show the application all product on rentpage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allProducts = Product::get();
        $categories = Category::get();

        $breadcrumbs = [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Sewa'],
        ];

        return view('pages.rent', compact('breadcrumbs', 'allProducts', 'categories'));
    }

    /**
     * Show the product detail page.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        $breadcrumbs = [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Sewa Kendaraan', 'url' => route('rent')],
            ['label' => $product->name, 'url' => route('product.show', $product->slug)],
        ];
        return view('pages.product_detail', compact('product', 'similarProducts', 'breadcrumbs'));
    }

}

