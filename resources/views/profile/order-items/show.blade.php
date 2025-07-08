@extends('layouts/app')
@section('title', 'Detail Item Pesanan')
@section('content')

<div class="min-h-screen pt-8">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-breadcrumb :breadcrumbs="[
            ['label' => 'Profil', 'url' => route('profile.show')],
            ['label' => 'Item Pesanan', 'url' => route('user.order-items.index')],
            ['label' => $orderItem->product->name]
        ]" class="px-8 sm:px-0"/>
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

                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6 pt-0">
                        {{-- Item Header --}}
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Detail Item Pesanan</h2>
                                <p class="text-lg text-gray-600">{{ $orderItem->product->name }}</p>
                                <p class="text-sm text-gray-500">Order #{{ $orderItem->order->order_code }}</p>
                                <p class="text-sm text-gray-500">Dibuat pada {{ $orderItem->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0">
                                <span @class([
                                    'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium',
                                    'bg-yellow-100 text-yellow-800' => $orderItem->status === 'dalam_proses',
                                    'bg-green-100 text-green-800' => $orderItem->status === 'selesai',
                                    'bg-red-100 text-red-800' => $orderItem->status === 'dibatalkan',
                                ])>
                                    @if($orderItem->status === 'dalam_proses')
                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12,6 12,12 16,14"></polyline>
                                        </svg>
                                    @elseif($orderItem->status === 'selesai')
                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @elseif($orderItem->status === 'dibatalkan')
                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    @endif
                                    {{ $orderItem->status_label }}
                                </span>
                            </div>
                        </div>

                        {{-- Item Timeline --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Timeline Item</h3>
                            <div class="relative">
                                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                                
                                <div class="space-y-6">
                                    {{-- Item Created --}}
                                    <div class="relative flex items-center">
                                        <div class="absolute left-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-12">
                                            <h4 class="text-sm font-medium text-gray-900">Item Ditambahkan ke Pesanan</h4>
                                            <p class="text-sm text-gray-500">{{ $orderItem->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>

                                    {{-- Order Status Updates --}}
                                    @if($orderItem->order->status === 'diverifikasi')
                                        <div class="relative flex items-center">
                                            <div class="absolute left-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <div class="ml-12">
                                                <h4 class="text-sm font-medium text-gray-900">Pesanan Diverifikasi</h4>
                                                <p class="text-sm text-gray-500">{{ $orderItem->order->updated_at->format('d M Y H:i') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Item Status Updates --}}
                                    @if($orderItem->status === 'dalam_proses')
                                        <div class="relative flex items-center">
                                            <div class="absolute left-0 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12,6 12,12 16,14"></polyline>
                                                </svg>
                                            </div>
                                            <div class="ml-12">
                                                <h4 class="text-sm font-medium text-gray-900">
                                                    @if($orderItem->isCurrentlyActive())
                                                        Rental Aktif
                                                    @else
                                                        Kendaraan Disiapkan
                                                    @endif
                                                </h4>
                                                <p class="text-sm text-gray-500">{{ $orderItem->updated_at->format('d M Y H:i') }}</p>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    @if($orderItem->isCurrentlyActive())
                                                        Kendaraan sedang digunakan hingga {{ $orderItem->ended_at->format('d M Y') }}
                                                    @else
                                                        Akan mulai pada {{ $orderItem->started_at->format('d M Y') }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($orderItem->status === 'selesai')
                                        <div class="relative flex items-center">
                                            <div class="absolute left-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <div class="ml-12">
                                                <h4 class="text-sm font-medium text-gray-900">Rental Selesai</h4>
                                                <p class="text-sm text-gray-500">{{ $orderItem->updated_at->format('d M Y H:i') }}</p>
                                                <p class="text-sm text-gray-600 mt-1">Kendaraan telah dikembalikan</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($orderItem->status === 'dibatalkan')
                                        <div class="relative flex items-center">
                                            <div class="absolute left-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                            <div class="ml-12">
                                                <h4 class="text-sm font-medium text-gray-900">Item Dibatalkan</h4>
                                                <p class="text-sm text-gray-500">{{ $orderItem->updated_at->format('d M Y H:i') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Product Details --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Produk</h3>
                            <div class="flex flex-col sm:flex-row gap-6 p-6 rounded-lg border border-gray-200 bg-gray-50">
                                <div class="flex-shrink-0">
                                    <img src="{{ Storage::disk('s3')->url($orderItem->product->thumbnail) }}" 
                                        alt="{{ $orderItem->product->name }}" 
                                        class="w-32 h-32 object-cover rounded-lg border">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $orderItem->product->name }}</h4>
                                    <p class="text-gray-600 mb-4">{{ $orderItem->product->description }}</p>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Tanggal Mulai:</span><br>
                                                {{ $orderItem->started_at->format('d M Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Tanggal Selesai:</span><br>
                                                {{ $orderItem->ended_at->format('d M Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Durasi Rental:</span><br>
                                                {{ $orderItem->rental_duration }} hari
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Harga per Hari:</span><br>
                                                Rp {{ number_format($orderItem->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Rental Information --}}
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Rental</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Status Saat Ini</h4>
                                    <div class="p-3 rounded-lg @if($orderItem->status === 'dalam_proses') bg-yellow-50 border border-yellow-200 @elseif($orderItem->status === 'selesai') bg-green-50 border border-green-200 @else bg-red-50 border border-red-200 @endif">
                                        <div class="flex items-center">
                                            @if($orderItem->status === 'dalam_proses')
                                                <svg class="w-5 h-5 text-yellow-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12,6 12,12 16,14"></polyline>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-yellow-800">
                                                        @if($orderItem->isCurrentlyActive())
                                                            Sedang Digunakan
                                                        @else
                                                            Sedang Disiapkan
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-yellow-700">
                                                        @if($orderItem->isCurrentlyActive())
                                                            {{ $orderItem->remaining_days }} hari tersisa
                                                        @else
                                                            Akan mulai dalam {{ now()->diffInDays($orderItem->started_at, false) }} hari
                                                        @endif
                                                    </p>
                                                </div>
                                            @elseif($orderItem->status === 'selesai')
                                                <svg class="w-5 h-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-green-800">Rental Selesai</p>
                                                    <p class="text-xs text-green-700">Kendaraan telah dikembalikan</p>
                                                </div>
                                            @else
                                                <svg class="w-5 h-5 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-red-800">Dibatalkan</p>
                                                    <p class="text-xs text-red-700">Rental telah dibatalkan</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Pembayaran</h4>
                                    <div class="p-3 rounded-lg bg-gray-50 border border-gray-200">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Subtotal:</span><br>
                                            Rp {{ number_format($orderItem->subtotal, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('user.order-items.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kembali ke Daftar
                            </a>
                            
                            <a href="{{ route('user.orders.show', $orderItem->order) }}" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Lihat Order Lengkap
                            </a>
                            
                            @if($orderItem->status === 'selesai')
                                <button type="button" 
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Rental Lagi
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 