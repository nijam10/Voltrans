@extends('layouts/app')
@section('title', 'Detail Pesanan')
@section('content')

<div class="min-h-screen">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-breadcrumb :breadcrumbs="[
            ['label' => 'Profil', 'url' => route('profile.show')],
            ['label' => 'Riwayat Pesanan', 'url' => route('user.orders.index')],
            ['label' => 'Detail Pesanan']
        ]" class="mt-10"/>
        <div class="flex gap-8">
            {{-- Sidebar --}}
            <x-user-sidebar /> 

            {{-- Main Content --}}
            <div class="flex-1">
                {{-- Success/Error Messages --}}
                @if(session('success'))
                    <x-success-message type="success">
                        {{ session('success') }}
                    </x-success-message>
                @endif

                @if(session('error'))
                    <x-success-message type="error">
                        {{ session('error') }}
                    </x-success-message>
                @endif
                    <div class="px-6">
                        {{-- Order Header --}}
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Detail Pesanan</h2>
                                <p class="text-lg text-gray-600">#{{ $order->order_code }}</p>
                                <p class="text-sm text-gray-500">Dibuat pada {{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0">
                                <span @class([
                                    'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium',
                                    'bg-orange-100 text-orange-800' => $order->status === 'menunggu_verifikasi',
                                    'bg-blue-100 text-blue-800' => $order->status === 'diverifikasi',
                                    'bg-yellow-100 text-yellow-800' => $order->status === 'dalam_proses',
                                    'bg-green-100 text-green-800' => $order->status === 'selesai',
                                    'bg-red-100 text-red-800' => $order->status === 'dibatalkan',
                                ])>
                                    {{ $order->status_label }}
                                </span>
                            </div>
                        </div>

                        {{-- Product Details --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Produk</h3>
                            <div class="space-y-4">
                                @foreach($order->items as $item)
                                @php
                                    $days = \Carbon\Carbon::parse($item->started_at)->diffInDays(\Carbon\Carbon::parse($item->ended_at)) + 1;
                                @endphp
                                <a href="{{ route('user.order-items.show', $item) }}">
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
                                </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Order Information --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pemesanan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Kontak</h4>
                                    <p class="text-sm text-gray-600">Nomor HP: {{ $order->phone_number }}</p>
                                    <p class="text-sm text-gray-600">Email: {{ $order->customer->email }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Rincian Pembayaran</h4>
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Subtotal:</span>
                                            <span class="text-gray-900">Rp {{ number_format($order->subtotal_amount, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Pajak (11%):</span>
                                            <span class="text-gray-900">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                                        </div>
                                        @if($order->shipping_fee_amount > 0)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Biaya Pengiriman:</span>
                                            <span class="text-gray-900">Rp {{ number_format($order->shipping_fee_amount, 0, ',', '.') }}</span>
                                        </div>
                                        @endif
                                        <div class="border-t border-gray-200 pt-1 flex justify-between text-base font-semibold">
                                            <span class="text-gray-900">Total:</span>
                                            <span class="text-emerald-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Lokasi Pengiriman</h4>
                                    <p class="text-sm text-gray-600">
                                        @if($order->is_delivered)
                                            @php
                                                $deliveryLocation = json_decode($order->delivery_location, true);
                                            @endphp
                                            @if(isset($deliveryLocation['type']))
                                                @if($deliveryLocation['type'] === 'existing')
                                                    {{ $deliveryLocation['name'] ?? 'N/A' }}<br>
                                                    {{ $deliveryLocation['address'] ?? 'N/A' }}<br>
                                                    {{ $deliveryLocation['city'] ?? 'N/A' }}, {{ $deliveryLocation['province'] ?? 'N/A' }} {{ $deliveryLocation['postal_code'] ?? '' }}
                                                @elseif($deliveryLocation['type'] === 'new')
                                                    {{ $deliveryLocation['name'] ?? 'N/A' }}<br>
                                                    {{ $deliveryLocation['address'] ?? 'N/A' }}<br>
                                                    {{ $deliveryLocation['city'] ?? 'N/A' }}, {{ $deliveryLocation['province'] ?? 'N/A' }} {{ $deliveryLocation['postal_code'] ?? '' }}
                                                @endif
                                            @else
                                                Alamat tidak tersedia
                                            @endif
                                        @else
                                            Alamat Perusahaan (akan dikirimkan via email)
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            @if($order->status === 'diverifikasi')
                                <a href="{{ route('checkout.payment', ['order_code' => $order->order_code]) }}" 
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Lanjutkan ke Pembayaran
                                </a>
                            @endif

                            @if($order->status === 'menunggu_verifikasi')
                                @livewire('cancel-order-modal', ['order' => $order])
                            @endif
                            <a href="{{ route('user.invoice.view', $order->order_code) }}" target="_blank"
                                class="px-4 py-2 text-center bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cetak Invoice
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection 