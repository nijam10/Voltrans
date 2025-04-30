<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
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

        return view('pages.detail_produk', compact('breadcrumbs'));
    }
}

