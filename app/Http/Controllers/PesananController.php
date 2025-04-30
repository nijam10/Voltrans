<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesananController extends Controller
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
            ['label' => 'Wuling Air EV', 'url' => route('detail_produk')],
            ['label' => 'Detail Pesanan'], // yang ini aktif (tidak ada URL)
        ];

        return view('pages.pesanan', compact('breadcrumbs'));
    }
}
