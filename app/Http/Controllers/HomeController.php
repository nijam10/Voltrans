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
        $categories = Category::orderBy('name')->get();
        $latestProducts = Product::with('category')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();
        $userCount = User::count();
        $productCount = Product::count();
        return view('pages.home', [
            'title' => 'Beranda',
            'breadcrumbs' => [
                ['label' => 'Beranda', 'url' => route('home')],
            ],
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'userCount' => $userCount,
            'productCount' => $productCount,
        ]);
    }
}
