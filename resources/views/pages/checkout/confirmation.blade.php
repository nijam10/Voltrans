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
                    <div class="ml-2 text-sm font-medium text-emerald-600">Pembayaran</div>
                </div>
                <div class="flex-1 h-0.5 bg-emerald-600 mx-4"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        3
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Konfirmasi</div>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-8" data-hs-confetti>
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 mb-4">
                    <svg class="w-8 h-8 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Dikonfirmasi 🎉</h1>
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

                    <div class="space-y-4">
                        {{-- Product Details --}}
                        @foreach($order->items as $item)
                            @php
                                $days = \Carbon\Carbon::parse($item->started_at)->diffInDays(\Carbon\Carbon::parse($item->ended_at)) + 1;
                            @endphp
                            <div class="flex flex-col sm:flex-row gap-4 p-4 rounded-lg border border-gray-200 shadow-sm bg-gray-50 hover:shadow-md transition-all">
                                <div class="flex-shrink-0">
                                    <img src="{{ Storage::disk('s3')->url($item->product->thumbnail) }}" 
                                        alt="{{ $item->product->name }}" 
                                        class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-md border">
                                </div>
                                <div class="flex flex-col justify-between flex-1">
                                    <div>
                                        <h4 class="text-base font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->started_at)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($item->ended_at)->format('d M Y') }}
                                        </p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-emerald-800">
                                                Durasi {{ $days }} hari
                                            </span>
                                        </div>
                                    </div>
                                    <hr class="border-gray-300 my-2">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-700 gap-1">
                                        <span>Harga per hari: <span class="font-medium text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</span></span>
                                        <span>Subtotal: <span class="font-semibold text-emerald-700">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Shipping Details --}}
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-sm font-medium text-gray-900 mb-4">Informasi Pemesanan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @if($order->is_delivered)
                                    <div>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Lokasi Pengantaran :</span><br>
                                            @php
                                                $deliveryLocation = json_decode($order->delivery_location, true);
                                            @endphp
                                            {{ $deliveryLocation['address_detail'] }}<br>
                                            {{ $deliveryLocation['village']['name'] }}, {{ $deliveryLocation['district']['name'] }}<br>
                                            {{ $deliveryLocation['city']['name'] }}, {{ $deliveryLocation['province']['name'] }}
                                        </p>
                                    </div>
                                @else
                                    <div>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Lokasi Pickup :</span><br>
                                            {{ $order->pickup_location }}
                                        </p>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Lokasi Pengembalian :</span><br>
                                        {{ $order->return_location }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Nomor HP :</span><br>
                                        {{ $order->phone_number }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Details --}}
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-sm font-medium text-gray-900 mb-4">Rincian Pembayaran</h3>
                            <div class="space-y-2">
                                @php
                                    $subtotal = $order->items->sum('subtotal');
                                    $tax = $subtotal * 0.11;
                                    $discountAmount = 0;
                                    if ($order->discount) {
                                        $discountAmount = $order->discount->calculateDiscountAmount($subtotal + $tax);
                                    }
                                    $totalPaid = ($subtotal + $tax) - $discountAmount;
                                @endphp
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-gray-900 font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tax (11%)</span>
                                    <span class="text-gray-900 font-medium">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                @if($order->discount)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Diskon ({{ $order->discount->discount_type == 'percentage' ? $order->discount->value . '%' : 'Rp ' . number_format($order->discount->value, 0, ',', '.') }})</span>
                                    <span class="text-gray-900 font-medium">- Rp {{ number_format($discountAmount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="border-t border-gray-200 pt-2 flex justify-between text-base font-semibold">
                                    <span class="text-gray-900">Total Dibayar</span>
                                    <span class="text-emerald-700">Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm mt-2">
                                    <span class="text-gray-600">Metode Pembayaran</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($payment->payment_type ?? 'Transfer') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Status</span>
                                    <span class="text-gray-900 font-medium">{{ ucfirst($payment->payment_status ?? 'Paid') }}</span>
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
                <a href="{{ route('invoice.pdf', $order->order_code) }}" 
                    class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                    Download Invoice PDF
                </a>
                <a href="{{ route('invoice.view', $order->order_code) }}" target="_blank"
                    class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none transition-all">
                    Lihat Invoice
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Wait for the confetti library to load
        window.addEventListener('load', function() {
            var count = 200;
            var defaults = {
                origin: { y: 0.7 }
            };

            function fire(particleRatio, opts) {
                confetti({
                    ...defaults,
                    ...opts,
                    particleCount: Math.floor(count * particleRatio)
                });
            }

            // Fire multiple confetti bursts
            fire(0.25, {
                spread: 26,
                startVelocity: 55,
            });
            fire(0.2, {
                spread: 60,
            });
            fire(0.35, {
                spread: 100,
                decay: 0.91,
                scalar: 0.8
            });
            fire(0.1, {
                spread: 120,
                startVelocity: 25,
                decay: 0.92,
                scalar: 1.2
            });
            fire(0.1, {
                spread: 120,
                startVelocity: 45,
            });
        });
    </script>
@endpush

@endsection 