<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Controllers\Socialite\ProviderCallbackController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rent', [ProductController::class, 'index'])->name('rent');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Social media login
Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

// Route to set redirect the user can only view this route if he is logged in
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // User Routes
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
