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

                        {{-- Order Timeline --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Timeline Pesanan</h3>
                            <div class="relative">
                                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                                
                                {{-- Collapsible Timeline Container --}}
                                <div x-data="{ expanded: false }" class="space-y-6">
                                    {{-- Timeline Items Container --}}
                                    <div class="space-y-6" :class="{ 'max-h-96 overflow-hidden': !expanded }">
                                        {{-- Order Created (Always visible at bottom) --}}
                                        <div class="relative flex items-center">
                                            <div class="absolute left-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-12">
                                                <h4 class="text-sm font-medium text-gray-900">Pesanan Dibuat</h4>
                                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                                            </div>
                                        </div>

                                        {{-- Order Status Updates (Newest at top) --}}
                                        @if($order->status === 'dibatalkan')
                                            <div class="relative flex items-center">
                                                <div class="absolute left-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-12">
                                                    <h4 class="text-sm font-medium text-gray-900">Pesanan Dibatalkan</h4>
                                                    <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                                    @if($order->cancellation_reason)
                                                        <p class="text-sm text-gray-600 mt-1">Alasan: {{ $order->cancellation_reason }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if($order->status === 'selesai')
                                            <div class="relative flex items-center">
                                                <div class="absolute left-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-12">
                                                    <h4 class="text-sm font-medium text-gray-900">Pesanan Selesai</h4>
                                                    <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($order->status === 'dalam_proses')
                                            <div class="relative flex items-center">
                                                <div class="absolute left-0 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-12">
                                                    <h4 class="text-sm font-medium text-gray-900">Pembayaran Berhasil - Menyiapkan Kendaraan</h4>
                                                    <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($order->status === 'diverifikasi')
                                            <div class="relative flex items-center">
                                                <div class="absolute left-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </div>
                                                <div class="ml-12">
                                                    <h4 class="text-sm font-medium text-gray-900">Pesanan Diverifikasi</h4>
                                                    <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($order->status === 'menunggu_verifikasi')
                                            <div class="relative flex items-center">
                                                <div class="absolute left-0 w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-12">
                                                    <h4 class="text-sm font-medium text-gray-900">Menunggu Verifikasi Admin</h4>
                                                    <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Expand/Collapse Button --}}
                                    <div class="flex justify-center">
                                        <button 
                                            @click="expanded = !expanded"
                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                                        >
                                            <span x-text="expanded ? 'Sembunyikan Timeline' : 'Lihat Semua Timeline'"></span>
                                            <svg 
                                                class="ml-2 h-4 w-4 transition-transform duration-200" 
                                                :class="{ 'rotate-180': expanded }"
                                                fill="none" 
                                                stroke="currentColor" 
                                                viewBox="0 0 24 24"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
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
                            </div>
                        </div>

                        {{-- Order Information --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pemesanan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Kontak</h4>
                                    <p class="text-sm text-gray-600">Nomor HP: {{ $order->phone_number }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Jumlah Dibayar</h4>
                                    <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
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