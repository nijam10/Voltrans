<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\LoginController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rent', [RentController::class, 'index'])->name('rent');
Route::get('user/profile', [UserProfileController::class, 'index'])->name('profile');
Route::get('product_detail', [ProductDetailController::class,'index'])->name('product-detail');
Route::get('user/order', [OrderController::class, 'index'])->name('pesanan');
Route::get('user/history', [HistoryController::class, 'index'])->name('history');
Route::get('user/settings', [SettingController::class, 'index'])->name('settings');
Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::get('/register', [RegistController::class, 'index'])->name('register');

// Route to set redirect the user can only view this route if he is logged in
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('user.login');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('user.register');
    Route::get('user/profile', function () {
        return view('profile.show');
    })->name('profile.show');
    Route::get('pesanan', function () {
        return view('pages.order');
    })->name('user.order');
    Route::get('user/setting', function () {
        return view('pages.setting');
    })->name('user.setting');
    Route::get('user/history', function () {
        return view('pages.history');
    })->name('user.history');
});
