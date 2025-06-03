<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
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
            ['label' => 'Wuling Air EV', 'url' => ''], // Halaman aktif
        ];

        return view('pages.product_detail', compact('breadcrumbs'));
    }
}

