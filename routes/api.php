<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyFileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Checkout API Routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Validate 
    Route::post('/checkout/validate-shipping', [CheckoutController::class, 'validateShipping']);

    // Calculate totals
    Route::post('/checkout/calculate-totals', [CheckoutController::class, 'calculateTotals']);
    
});

// Midtrans webhook
Route::post('/checkout/webhook', [CheckoutController::class, 'webhook'])->name('payment.webhook');
