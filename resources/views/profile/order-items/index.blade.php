@extends('layouts.app')
@section('title', 'Status Item Pesanan')
@section('content')

<div class="min-h-screen pt-20">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex gap-8">
            {{-- Sidebar --}}
            <x-user-sidebar />

            {{-- Main Content --}}
            <div class="flex-1">
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

                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Status Item Pesanan</h2>
                                <p class="text-sm text-gray-500">Kelola dan pantau status setiap item dalam pesanan Anda</p>
                            </div>
                            <div class="flex items-center gap-4">
                                {{-- Filter by Status --}}
                                <select id="status-filter" class="py-2 px-3 pe-9 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="dalam_proses">Dalam Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                                
                                {{-- Date Range Filter --}}
                                <div class="flex items-center gap-2">
                                    <input type="date" id="date-from" class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Dari">
                                    <span class="text-gray-500">-</span>
                                    <input type="date" id="date-to" class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Sampai">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @forelse($orderItems as $item)
                                <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                                        {{-- Product Information --}}
                                        <div class="flex gap-4 flex-1">
                                            <div class="flex-shrink-0">
                                                <img src="{{ Storage::disk('s3')->url($item->product->thumbnail) }}" 
                                                    alt="{{ $item->product->name }}" 
                                                    class="w-20 h-20 object-cover rounded-lg">
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <h3 class="text-base font-medium text-gray-900">{{ $item->product->name }}</h3>
                                                        <p class="text-sm text-gray-500">Order #{{ $item->order->order_code }}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $item->started_at->format('d M Y') }} - {{ $item->ended_at->format('d M Y') }}
                                                        </p>
                                                        <div class="mt-2 flex items-center gap-2">
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $item->rental_duration }} hari
                                                            </span>
                                                            @if($item->isCurrentlyActive())
                                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    {{ $item->remaining_days }} hari tersisa
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Status Information --}}
                                        <div class="flex flex-col items-end gap-3">
                                            <div class="text-right">
                                                <span @class([
                                                    'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium',
                                                    'bg-yellow-100 text-yellow-800' => $item->status === 'dalam_proses',
                                                    'bg-green-100 text-green-800' => $item->status === 'selesai',
                                                    'bg-red-100 text-red-800' => $item->status === 'dibatalkan',
                                                ])>
                                                    @if($item->status === 'dalam_proses')
                                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <polyline points="12,6 12,12 16,14"></polyline>
                                                        </svg>
                                                    @elseif($item->status === 'selesai')
                                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    @elseif($item->status === 'dibatalkan')
                                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    @endif
                                                    {{ $item->status_label }}
                                                </span>
                                            </div>
                                            
                                            <div class="text-right">
                                                <p class="text-sm text-gray-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Status-specific information --}}
                                    @if($item->status === 'dalam_proses')
                                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-yellow-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12,6 12,12 16,14"></polyline>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-yellow-800">
                                                        @if($item->isCurrentlyActive())
                                                            Kendaraan sedang digunakan
                                                        @else
                                                            Kendaraan sedang disiapkan
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-yellow-700">
                                                        @if($item->isCurrentlyActive())
                                                            Rental aktif hingga {{ $item->ended_at->format('d M Y') }}
                                                        @else
                                                            Akan mulai pada {{ $item->started_at->format('d M Y') }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($item->status === 'selesai')
                                        <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-green-800">Rental Selesai</p>
                                                    <p class="text-xs text-green-700">Kendaraan telah dikembalikan dan rental telah selesai</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($item->status === 'dibatalkan')
                                        <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-red-800">Rental Dibatalkan</p>
                                                    <p class="text-xs text-red-700">Item ini telah dibatalkan</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Action Buttons --}}
                                    <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-gray-200">
                                        <a href="{{ route('user.order-items.show', $item) }}" 
                                            class="inline-flex items-center gap-x-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                                            Lihat Detail
                                        </a>
                                        <a href="{{ route('user.orders.show', $item->order) }}" 
                                            class="inline-flex items-center gap-x-2 text-sm font-medium text-gray-600 hover:text-gray-800">
                                            Lihat Order
                                        </a>
                                        @if($item->status === 'selesai')
                                            <button type="button" 
                                                class="inline-flex items-center gap-x-2 text-sm font-medium text-green-600 hover:text-green-800">
                                                Rental Lagi
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada item pesanan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat pesanan baru.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('rent') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Lihat Produk
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
                        @if($orderItems->hasPages())
                            <div class="mt-6">
                                {{ $orderItems->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const statusFilter = document.getElementById('status-filter');
        const dateFrom = document.getElementById('date-from');
        const dateTo = document.getElementById('date-to');

        function applyFilters() {
            const params = new URLSearchParams(window.location.search);
            
            if (statusFilter.value) {
                params.set('status', statusFilter.value);
            } else {
                params.delete('status');
            }
            
            if (dateFrom.value) {
                params.set('date_from', dateFrom.value);
            } else {
                params.delete('date_from');
            }
            
            if (dateTo.value) {
                params.set('date_to', dateTo.value);
            } else {
                params.delete('date_to');
            }

            window.location.search = params.toString();
        }

        statusFilter.addEventListener('change', applyFilters);
        dateFrom.addEventListener('change', applyFilters);
        dateTo.addEventListener('change', applyFilters);

        // Set current filter values from URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status')) {
            statusFilter.value = urlParams.get('status');
        }
        if (urlParams.get('date_from')) {
            dateFrom.value = urlParams.get('date_from');
        }
        if (urlParams.get('date_to')) {
            dateTo.value = urlParams.get('date_to');
        }
    });
</script>
@endpush 