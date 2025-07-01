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
                                <select id="status-filter" class="py-2 px-3 pe-9 block border-gray-200 rounded-lg text-sm focus:border-teal-500 focus:ring-teal-500">
                                    <option value="">Semua Status</option>
                                    <option value="dalam_proses">Dalam Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                                
                                {{-- Date Range Filter --}}
                                <div class="flex items-center gap-2">
                                    <input type="date" id="date-from" class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Dari">
                                    <span class="text-gray-500">-</span>
                                    <input type="date" id="date-to" class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-teal-500 focus:ring-teal-500" placeholder="Sampai">
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
                                                        <p class="text-sm text-gray-500">Kode Pesanan #{{ $item->order->order_code }}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $item->started_at->format('d M Y') }} - {{ $item->ended_at->format('d M Y') }}
                                                        </p>
                                                        <div class="mt-2 flex items-center gap-2">
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
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
                                                <p class="text-base font-medium text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
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
                                            class="inline-flex items-center gap-x-2 text-sm font-medium text-teal-600 hover:text-teal-800">
                                            Lihat Detail
                                        </a>
                                        @if($item->status === 'selesai')
                                            <a href={{ route('product.show', $item->product->slug) }} 
                                                class="inline-flex items-center gap-x-2 text-sm font-medium text-green-600 hover:text-green-800">
                                                Rental Lagi
                                            </a>
                                            @if(!$item->review)
                                                <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium text-yellow-600 hover:text-yellow-800" data-order-item-id="{{ $item->id }}" onclick="openReviewModal({{ $item->id }}, '{{ $item->product->name }}', '{{ $item->product->id }}')">
                                                    Tinggalkan Ulasan
                                                </button>
                                            @else
                                                <span class="inline-flex items-center gap-x-2 text-sm font-medium text-gray-500">
                                                    Sudah Diulas
                                                </span>
                                            @endif
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

{{-- Review Modal --}}
<div id="review-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onclick="closeReviewModal()">&times;</button>
        <h3 class="text-lg font-semibold mb-2">Tinggalkan Ulasan untuk <span id="modal-product-name"></span></h3>
        <form id="review-form" method="POST" action="{{ route('review.store') }}">
            @csrf
            <input type="hidden" name="order_item_id" id="modal-order-item-id">
            <input type="hidden" name="product_id" id="modal-product-id">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                <div id="star-rating" class="flex gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <svg data-star="{{ $i }}" class="w-8 h-8 cursor-pointer text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                        </svg>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="modal-rating" value="5">
            </div>
            <div class="mb-4">
                <label for="modal-comment" class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                <textarea name="comment" id="modal-comment" rows="3" class="w-full border rounded-lg p-2"></textarea>
            </div>
            <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700">Kirim Ulasan</button>
        </form>
    </div>
</div>
<script>
    function openReviewModal(orderItemId, productName, productId) {
        document.getElementById('review-modal').classList.remove('hidden');
        document.getElementById('modal-product-name').textContent = productName;
        document.getElementById('modal-order-item-id').value = orderItemId;
        document.getElementById('modal-product-id').value = productId;
        document.getElementById('modal-rating').value = 5;
        setStarRating(5);
    }
    function closeReviewModal() {
        document.getElementById('review-modal').classList.add('hidden');
    }
    function setStarRating(rating) {
        document.querySelectorAll('#star-rating svg').forEach((star, idx) => {
            star.classList.toggle('text-yellow-400', idx < rating);
            star.classList.toggle('text-gray-300', idx >= rating);
        });
        document.getElementById('modal-rating').value = rating;
    }
    document.querySelectorAll('#star-rating svg').forEach(star => {
        star.addEventListener('click', function() {
            setStarRating(parseInt(this.getAttribute('data-star')));
        });
    });
</script>

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