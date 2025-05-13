<?php

namespace App\Http\Controllers;

use App\Filament\Pages\Dashboard;
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
        return view('pages.home', [
            'title' => 'Beranda',
            'breadcrumbs' => [
                ['label' => 'Beranda', 'url' => route('home')],
            ]
        ]);;
    }
}
