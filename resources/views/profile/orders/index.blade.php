@extends('layouts/app')
@section('title', 'Pesanan Saya')
@section('content')

<div class="min-h-screen pt-20">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex gap-8">
            {{-- Sidebar --}}
            <x-user-sidebar />

            {{-- Main Content --}}
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-medium text-gray-900">Riwayat Pesanan</h2>
                            <div class="flex items-center gap-4">
                                <select class="py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @forelse($orders as $order)
                                <div class="border rounded-lg p-6">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4">
                                        <div>
                                            <h3 class="text-base font-medium text-gray-900">Pesanan #{{ $order->order_code }}</h3>
                                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</p>
                                        </div>
                                        <div class="mt-4 sm:mt-0">
                                            <span @class([
                                                'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium',
                                                'bg-yellow-100 text-yellow-800' => $order->status === 'sedang diproses',
                                                'bg-green-100 text-green-800' => $order->status === 'menunggu konfirmasi',
                                                'bg-red-100 text-red-800' => $order->status === 'dibatalkan',
                                                'bg-blue-100 text-blue-800' => $order->status === 'selesai',
                                            ])>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        {{-- Product Details --}}
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('storage/' . $order->product->thumbnail) }}" 
                                                alt="{{ $order->product->name }}" 
                                                class="w-20 h-20 object-cover rounded-lg">
                                            <div class="flex-1">
                                                <h4 class="text-base font-medium text-gray-900">{{ $order->product->name }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $order->started_at->format('d M Y') }} - {{ $order->ended_at->format('d M Y') }}
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-base font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                            </div>
                                        </div>

                                        {{-- Order Details --}}
                                        <div class="border-t border-gray-200 pt-4">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Lokasi Pengiriman:</span><br>
                                                        @if($order->is_delivered)
                                                            @php
                                                                $deliveryLocation = json_decode($order->delivery_location, true);
                                                            @endphp
                                                            {{ $deliveryLocation['address_detail'] }}<br>
                                                            {{ $deliveryLocation['village']['name'] }}, {{ $deliveryLocation['district']['name'] }}<br>
                                                            {{ $deliveryLocation['city']['name'] }}, {{ $deliveryLocation['province']['name'] }}
                                                        @else
                                                            {{ $order->pickup_location }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Lokasi Pengembalian:</span><br>
                                                        {{ $order->return_location }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('user.orders.show', $order) }}" 
                                                class="inline-flex items-center gap-x-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                                                Lihat Detail
                                            </a>
                                            @if($order->status === 'selesai')
                                                <button type="button" 
                                                    class="inline-flex items-center gap-x-2 text-sm font-medium text-green-600 hover:text-green-800">
                                                    Beli Lagi
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <p class="text-gray-500">Tidak ada pesanan ditemukan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 