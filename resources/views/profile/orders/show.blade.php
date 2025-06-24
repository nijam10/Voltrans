@extends('layouts/app')
@section('title', 'Detail Pesanan')
@section('content')

<div class="min-h-screen pt-20">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
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
                    <div class="p-6">
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
                                
                                {{-- Order Created --}}
                                <div class="relative flex items-center mb-6">
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

                                {{-- Order Status Updates --}}
                                @if($order->status === 'menunggu konfirmasi')
                                    <div class="relative flex items-center mb-6">
                                        <div class="absolute left-0 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-12">
                                            <h4 class="text-sm font-medium text-gray-900">Menunggu Konfirmasi</h4>
                                            <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($order->status === 'sedang diproses')
                                    <div class="relative flex items-center mb-6">
                                        <div class="absolute left-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-12">
                                            <h4 class="text-sm font-medium text-gray-900">Sedang Diproses</h4>
                                            <p class="text-sm text-gray-500">{{ $order->updated_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($order->status === 'selesai')
                                    <div class="relative flex items-center mb-6">
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

                                @if($order->status === 'dibatalkan')
                                    <div class="relative flex items-center mb-6">
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
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Total Pembayaran</h4>
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
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Lokasi Pengembalian</h4>
                                    <p class="text-sm text-gray-600">
                                        @php
                                            $returnLocation = json_decode($order->return_location, true);
                                        @endphp
                                        @if(isset($returnLocation['type']))
                                            @if($returnLocation['type'] === 'same_as_shipping')
                                                @if($order->is_delivered)
                                                    Sama dengan alamat pengiriman
                                                @else
                                                    Sama dengan lokasi pengambilan (Alamat Perusahaan)
                                                @endif
                                            @elseif($returnLocation['type'] === 'existing')
                                                {{ $returnLocation['name'] ?? 'N/A' }}<br>
                                                {{ $returnLocation['address'] ?? 'N/A' }}<br>
                                                {{ $returnLocation['city'] ?? 'N/A' }}, {{ $returnLocation['province'] ?? 'N/A' }} {{ $returnLocation['postal_code'] ?? '' }}
                                            @elseif($returnLocation['type'] === 'new')
                                                {{ $returnLocation['name'] ?? 'N/A' }}<br>
                                                {{ $returnLocation['address'] ?? 'N/A' }}<br>
                                                {{ $returnLocation['city'] ?? 'N/A' }}, {{ $returnLocation['province'] ?? 'N/A' }} {{ $returnLocation['postal_code'] ?? '' }}
                                            @elseif($returnLocation['type'] === 'pickup')
                                                {{ $returnLocation['location'] ?? 'N/A' }}
                                            @endif
                                        @else
                                            Lokasi pengembalian tidak tersedia
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            @if($order->status === 'dalam_proses')
                                @livewire('cancel-order-modal', ['order' => $order])
                            @endif
                            <a href="{{ route('user.invoice.view', $order->order_code) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cetak Invoice
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection 