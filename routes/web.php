<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\DetailController;

use Doctrine\DBAL\Schema\Index;

use App\Http\Controllers\PesananController;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rent', [RentController::class, 'index'])->name('rent');
Route::get('/detail', [DetailController::class, 'index'])->name('detail');
Route::get('/detail_produk', [DetailController::class,'index'])->name('detail_produk');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');



Route::get('/welcome', function () {
    return view('welcome');
})->name('about');
