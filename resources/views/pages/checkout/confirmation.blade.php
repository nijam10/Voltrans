@extends('layouts.app')
@section('title', 'Order Confirmation')
@section('content')

<div class="py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Progress Steps --}}
        <div class="max-w-3xl mx-auto mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Checkout</div>
                </div>
                <div class="flex-1 h-0.5 bg-emerald-600 mx-4"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Review & Pay</div>
                </div>
                <div class="flex-1 h-0.5 bg-emerald-600 mx-4"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        3
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Confirmation</div>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto">
            {{-- Success Message --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 mb-4">
                    <svg class="w-8 h-8 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">🎉 Pesanan Dikonfirmasi</h1>
                <p class="text-gray-600">Terima kasih atas pesanan Anda!</p>
            </div>

            {{-- Order Details --}}
            <div class="bg-white rounded-xl shadow-sm mb-8">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Detail Pesanan</h2>
                            <p class="text-sm text-gray-500">Order #{{ $order->order_code }}</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Product Details --}}
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $order->product->thumbnail) }}" 
                                alt="{{ $order->product->name }}" 
                                class="w-20 h-20 object-cover rounded-lg">
                            <div class="flex-1">
                                <h3 class="text-base font-medium text-gray-900">{{ $order->product->name }}</h3>
                                <p class="text-sm text-gray-500">
                                    {{ $order->started_at->format('d M Y') }} - {{ $order->ended_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-base font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        {{-- Shipping Details --}}
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-sm font-medium text-gray-900 mb-4">Informasi Pengiriman</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Pickup Location:</span><br>
                                        {{ $order->pickup_location }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Delivery Location:</span><br>
                                        {{ $order->delivery_location }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Return Location:</span><br>
                                        {{ $order->return_location }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Phone Number:</span><br>
                                        {{ $order->phone_number }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Details --}}
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-sm font-medium text-gray-900 mb-4">Informasi Pembayaran</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Payment Method</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Status</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($payment->status) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Amount</span>
                                    <span class="text-gray-900 font-medium">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" 
                    class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none transition-all">
                    Kembali ke Beranda
                </a>
                <button onclick="window.print()" 
                    class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                    Cetak Invoice
                </button>
            </div>
        </div>
    </div>
</div>

@endsection 