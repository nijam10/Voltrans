<?php

namespace App\Http\Controllers;

use App\Filament\Pages\Dashboard;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil data categori
        $categories = Category::orderBy('name')->get();

        // Mengambil data produk terbaru
        $latestProducts = Product::with('category')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();
        
        // Menghitung jumlah total data user dan product
        $userCount = User::count();
        $productCount = Product::count();

        return view('pages.home', [
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'userCount' => $userCount,
            'productCount' => $productCount,
        ]);
    }
}
