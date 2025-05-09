<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;
use Doctrine\DBAL\Schema\Index;
use App\Http\Controllers\PesananController;
use Filament\Pages\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\LoginController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rent', [RentController::class, 'index'])->name('rent');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/detail_produk', [DetailController::class,'index'])->name('detail_produk');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::get('/setting', [SettingController::class, 'index'])->name('setting');
Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegistController::class, 'index'])->name('register');
