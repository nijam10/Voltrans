@extends('layouts.app')
@section('title', 'Status Item Pesanan')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 lg:py-10 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
        <x-breadcrumb :breadcrumbs="[
            ['label' => 'Profil', 'url' => route('profile.show')],
            ['label' => 'Item Pesanan']
        ]" class="mt-5 sm:mt-0 -mb-10 sm:mb-0 px-2 sm:px-0"/>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
            {{-- Sidebar --}}
            <div class="mb-8 lg:mb-0 lg:col-span-3">
                <x-user-sidebar />
            </div>

            {{-- Main Content --}}
            <div class="lg:col-span-9">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <p class="text-sm text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                {{-- Error Message --}}
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 animate-fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <p class="text-sm text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 animate-fade-in">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-red-800">Terjadi kesalahan:</p>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Status Item Pesanan</h2>
                                <p class="text-sm text-gray-500">Kelola dan pantau status setiap item dalam pesanan Anda</p>
                            </div>
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-4 w-full sm:w-auto">
                                {{-- Filter by Status --}}
                                <select id="status-filter" class="py-2 px-3 pe-9 block border-gray-200 rounded-lg text-sm focus:border-teal-500 focus:ring-teal-500 transition-colors w-full sm:w-auto">
                                    <option value="">Semua Status</option>
                                    <option value="dalam_proses">Dalam Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                                {{-- Date Range Filter --}}
                                <div class="flex items-center gap-2 w-full sm:w-auto">
                                    <input type="date" id="date-from" class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-teal-500 focus:ring-teal-500 transition-colors w-full sm:w-auto" placeholder="Dari">
                                    <span class="text-gray-500">-</span>
                                    <input type="date" id="date-to" class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-teal-500 focus:ring-teal-500 transition-colors w-full sm:w-auto" placeholder="Sampai">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @forelse($orderItems as $item)
                                <div class="border rounded-xl p-4 sm:p-6 bg-white hover:shadow-md transition-all duration-200 hover:border-teal-200">
                                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start gap-4">
                                        {{-- Product Information --}}
                                        <div class="flex gap-4 flex-1">
                                            <div class="flex-shrink-0">
                                                <img src="{{ Storage::disk('s3')->url($item->product->thumbnail) }}" 
                                                    alt="{{ $item->product->name }}" 
                                                    class="w-20 h-20 object-cover rounded-lg shadow-sm">
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
                                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 animate-pulse">
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
                                                    'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium transition-all',
                                                    'bg-yellow-100 text-yellow-800 shadow-sm' => $item->status === 'dalam_proses',
                                                    'bg-green-100 text-green-800 shadow-sm' => $item->status === 'selesai',
                                                    'bg-red-100 text-red-800 shadow-sm' => $item->status === 'dibatalkan',
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
                                            class="inline-flex items-center gap-x-2 text-sm font-medium text-teal-600 hover:text-teal-800 transition-colors">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                            </svg>
                                            Lihat Detail
                                        </a>
                                        @if($item->status === 'selesai')
                                            @if(!$item->review)
                                                <button type="button" 
                                                    class="hover:cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium text-yellow-600 hover:text-yellow-800 transition-colors review-btn" 
                                                    data-order-item-id="{{ $item->id }}"
                                                    data-product-id="{{ $item->product->id }}"
                                                    data-product-name="{{ $item->product->name }}"
                                                    data-hs-overlay="#review-modal">
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                    Beri Ulasan
                                                </button>
                                            @else
                                                <span class="inline-flex items-center gap-x-2 text-sm font-medium text-gray-500">
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
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
<div id="review-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="review-modal-label">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xl rounded-xl pointer-events-auto">
            <div class="flex justify-between items-center py-4 px-4 sm:px-6 border-b border-gray-200 bg-gray-50">
                <h3 id="review-modal-label" class="font-bold text-gray-800">
                    Tambah Ulasan
                </h3>
                <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none transition-colors" aria-label="Close" data-hs-overlay="#review-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 sm:p-6 overflow-y-auto">
                <div class="mb-4 p-3 bg-teal-50 border border-teal-200 rounded-lg">
                    <p class="text-sm text-teal-800">
                        <span class="font-medium">Produk:</span> 
                        <span id="modal-product-name">-</span>
                    </p>
                </div>
                
                <form id="review-form" method="POST" action="{{ route('review.store') }}">
                    @csrf
                    <input type="hidden" name="order_item_id" id="modal-order-item-id">
                    <input type="hidden" name="product_id" id="modal-product-id">
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <div id="star-rating" class="flex gap-1 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg data-star="{{ $i }}" class="w-8 h-8 cursor-pointer text-gray-300 hover:text-yellow-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.967z" />
                                </svg>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="modal-rating" value="5">
                        <p class="text-xs text-gray-500">Klik bintang untuk memberikan rating</p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="modal-comment" class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                        <textarea name="comment" id="modal-comment" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:border-teal-500 focus:ring-teal-500 transition-colors" placeholder="Bagikan pengalaman Anda..."></textarea>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="submit" class="hover:cursor-pointer flex-1 bg-teal-600 text-white py-2 px-4 rounded-lg hover:bg-teal-700 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }
</style>

<script>
    // Review Modal Logic
    document.addEventListener('DOMContentLoaded', function() {
        const reviewButtons = document.querySelectorAll('.review-btn');
        const modalProductName = document.getElementById('modal-product-name');
        const modalOrderItemId = document.getElementById('modal-order-item-id');
        const modalProductId = document.getElementById('modal-product-id');
        const modalRating = document.getElementById('modal-rating');
        const modalComment = document.getElementById('modal-comment');
        const starRating = document.getElementById('star-rating');
        
        // Handle review button clicks
        reviewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderItemId = this.getAttribute('data-order-item-id');
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                
                // Populate modal with data
                modalProductName.textContent = productName;
                modalOrderItemId.value = orderItemId;
                modalProductId.value = productId;
                modalRating.value = 5;
                modalComment.value = '';
                
                // Reset stars to 5
                setStarRating(5);
            });
        });
        
        // Star rating functionality
        function setStarRating(rating) {
            const stars = starRating.querySelectorAll('svg');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
            modalRating.value = rating;
        }
        
        // Star click handlers
        starRating.querySelectorAll('svg').forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-star'));
                setStarRating(rating);
            });
            
            // Hover effect
            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.getAttribute('data-star'));
                const stars = starRating.querySelectorAll('svg');
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('text-yellow-300');
                    } else {
                        s.classList.remove('text-yellow-300');
                    }
                });
            });
        });
        
        // Reset hover effect when mouse leaves star container
        starRating.addEventListener('mouseleave', function() {
            const currentRating = parseInt(modalRating.value);
            setStarRating(currentRating);
        });
        
        // Initialize with 5 stars
        setStarRating(5);
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