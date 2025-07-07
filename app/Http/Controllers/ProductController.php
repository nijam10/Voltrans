<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Helper to generate breadcrumbs for product-related pages.
     */
    private function getBreadcrumbs($trail = [])
    {
        $base = [
            ['label' => 'Beranda', 'url' => route('home')],
        ];
        return array_merge($base, $trail);
    }

    /**
     * Show the application all product on rentpage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Product::query()->with('category');
    
        $allProducts = Product::with('category')
            ->withAvg('reviews as avg_rating', 'rating')
            ->when($request->filled('q'), fn($q) =>
                $q->where('name', 'like', '%' . $request->q . '%')
            )
            ->when($request->filled('type'), fn($q) => 
                $q->whereHas('category', fn($q2) => 
                    $q2->where('name', $request->type))
            )
            ->when($request->filled('min_price'), fn($q) =>
                $q->where('price', '>=', $request->min_price)
            )
            ->when($request->filled('max_price'), fn($q) =>
                $q->where('price', '<=', $request->max_price)
            )
            ->when($request->filled('rating'), fn($q) =>
                $q->having('avg_rating', '>=', $request->rating)
            )
            ->where('status', 'ready')
            ->paginate(8)
            ->withQueryString();

        $categories = Category::get();
    
        $breadcrumbs = $this->getBreadcrumbs([
            ['label' => 'Sewa Kendaraan', 'url' => route('rent')],
        ]);
    
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
        $breadcrumbs = $this->getBreadcrumbs([
            ['label' => 'Sewa', 'url' => route('rent')],
            ['label' => $product->name, 'url' => route('product.show', $product->slug)],
        ]);
        return view('pages.product_detail', compact('product', 'similarProducts', 'breadcrumbs'));
    }

}

