<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\DetailController;
use Doctrine\DBAL\Schema\Index;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rent', [RentController::class, 'index'])->name('rent');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/product_detail', [DetailController::class,'index'])->name('product_detail');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::get('/setting', [SettingController::class, 'index'])->name('setting');


