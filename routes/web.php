<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\InvoiceController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rent', [ProductController::class, 'index'])->name('rent');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Social media login
Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

// Protected routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('verified.address');
    Route::post('/checkout', [CheckoutController::class, 'directCheckout'])->name('checkout.direct')->middleware('verified.address');
    Route::post('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment')->middleware('verified.address');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process')->middleware('verified.address');
    Route::get('/checkout/confirmation/{orderCode}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

    // Profile Routes
    Route::prefix('user')->name('user.')->group(function () {
        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
        // Addresses
        Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
        Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
        Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
        // Export Invoices
        Route::get('/invoice/{orderCode}/pdf', [InvoiceController::class, 'exportPdf'])->name('invoice.pdf');
        Route::get('/invoice/{orderCode}/view', [InvoiceController::class, 'viewPdf'])->name('invoice.view');
        
    });
});

