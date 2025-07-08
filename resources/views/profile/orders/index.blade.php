@extends('layouts/app')
@section('title', 'Pesanan Saya')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 lg:py-10 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
        <x-breadcrumb :breadcrumbs="[
            ['label' => 'Profil', 'url' => route('profile.show')],
            ['label' => 'Riwayat Pesanan']
        ]" class="mt-6 sm:mt-0"/>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
            {{-- Sidebar --}}
            <div class="mb-2 lg:mb-0 lg:col-span-3">
                <x-user-sidebar />
            </div>

            {{-- Main Content --}}
            <div class="lg:col-span-9">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <p class="text-sm text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
                            <div class="flex items-center gap-4">
                                <h2 class="text-lg font-medium text-gray-900">Riwayat Pesanan</h2>
                                @if($orders->where('status', 'menunggu_verifikasi')->count() > 0)
                                    <button onclick="refreshPage()" 
                                        class="inline-flex items-center gap-x-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 2v6h-6"></path>
                                            <path d="M3 12a9 9 0 0 1 15-6.7L21 8"></path>
                                            <path d="M3 22v-6h6"></path>
                                            <path d="M21 12a9 9 0 0 1-15 6.7L3 16"></path>
                                        </svg>
                                        Refresh
                                    </button>
                                @endif
                            </div>
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
                                <div class="border rounded-xl p-4 sm:p-6 hover:shadow-md transition-all duration-200 @if($order->status === 'menunggu_verifikasi') border-orange-200 bg-orange-50 @endif">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4">
                                        <div>
                                            <h3 class="text-base font-medium text-gray-900">Pesanan #{{ $order->order_code }}</h3>
                                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
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
                                                @if($order->status === 'menunggu_verifikasi')
                                                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <polyline points="12,6 12,12 16,14"></polyline>
                                                    </svg>
                                                @endif
                                                {{ $order->status_label }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Status-specific information --}}
                                    @if($order->status === 'menunggu_verifikasi')
                                        <div class="mb-4 p-3 bg-orange-100 border border-orange-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-orange-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12,6 12,12 16,14"></polyline>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-orange-800">Menunggu Verifikasi Admin</p>
                                                    <p class="text-xs text-orange-700">Pesanan Anda sedang diverifikasi oleh admin. Anda akan dapat melakukan pembayaran setelah pesanan diverifikasi.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($order->status === 'diverifikasi')
                                        <div class="mb-4 p-3 bg-blue-100 border border-blue-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-blue-800">Siap untuk Pembayaran</p>
                                                    <p class="text-xs text-blue-700">Pesanan Anda telah diverifikasi. Silakan lakukan pembayaran untuk melanjutkan proses rental.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($order->status === 'dalam_proses')
                                        <div class="mb-4 p-3 bg-yellow-100 border border-yellow-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-yellow-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-yellow-800">Pesanan anda sedang dalam proses</p>
                                                    <p class="text-xs text-yellow-700">Lihat detail untuk memantau setiap pesanan anda atau klik menu item pesanan</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="space-y-4">
                                        {{-- Product Details --}}
                                        @if($order->items->count() > 0)
                                            @php
                                                $firstItem = $order->items->first();
                                            @endphp
                                            <div class="flex items-center gap-4">
                                                <img src="{{ Storage::disk('s3')->url($firstItem->product->thumbnail) }}" 
                                                    alt="{{ $firstItem->product->name }}" 
                                                    class="w-20 h-20 object-cover rounded-lg">
                                                <div class="flex-1">
                                                    <h4 class="text-base font-medium text-gray-900">{{ $firstItem->product->name }}</h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $firstItem->started_at->format('d M Y') }} - {{ $firstItem->ended_at->format('d M Y') }}
                                                    </p>
                                                    @if($order->items->count() > 1)
                                                        <p class="text-xs text-gray-400 mt-1">+{{ $order->items->count() - 1 }} item lainnya</p>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-base font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-center gap-4">
                                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="text-base font-medium text-gray-900">Produk tidak tersedia</h4>
                                                    <p class="text-sm text-gray-500">
                                                        Tanggal tidak tersedia
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-base font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endif

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
                                                            @if(isset($deliveryLocation['type']))
                                                                @if($deliveryLocation['type'] === 'existing')
                                                                    {{ $deliveryLocation['name'] ?? 'N/A' }}<br>
                                                                    {{ $deliveryLocation['city'] ?? 'N/A' }}, {{ $deliveryLocation['province'] ?? 'N/A' }}
                                                                @elseif($deliveryLocation['type'] === 'new')
                                                                    {{ $deliveryLocation['name'] ?? 'N/A' }}<br>
                                                                    {{ $deliveryLocation['city'] ?? 'N/A' }}, {{ $deliveryLocation['province'] ?? 'N/A' }}
                                                                @endif
                                                            @else
                                                                Alamat tidak tersedia
                                                            @endif
                                                        @else
                                                            Alamat Perusahaan
                                                        @endif
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Lokasi Pengembalian:</span><br>
                                                            Silahkan kembalikan ke lokasi perusahaan
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="flex justify-end gap-5">
                                            @if($order->status === 'diverifikasi')
                                            <a href="{{ route('checkout.payment', ['order_code' => $order->order_code]) }}" 
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                                </svg>
                                                Bayar Sekarang
                                            </a>
                                            @endif
                                            <a href="{{ route('user.orders.show', $order) }}" 
                                                class="inline-flex items-center gap-x-2 text-sm font-medium text-teal-600 hover:text-teal-800">
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

@push('scripts')
<script>
    // Auto-refresh functionality for pending verification orders
    @if($orders->where('status', 'menunggu_verifikasi')->count() > 0)
    function checkOrderStatuses() {
        const pendingOrders = @json($orders->where('status', 'menunggu_verifikasi')->pluck('order_code'));
        
        pendingOrders.forEach(orderCode => {
            fetch(`/checkout/order-status/${orderCode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'diverifikasi') {
                        // Order has been verified, refresh the page
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error checking order status:', error);
                });
        });
    }

    // Check status every 15 seconds for pending orders
    setInterval(checkOrderStatuses, 15000);
    @endif

    // Manual refresh button functionality
    function refreshPage() {
        window.location.reload();
    }
</script>
@endpush 