@extends('layouts.app')
@section('title', $product->name)
@section('content')

{{-- Background Wrapper with Enhanced Gradient --}}
<div class="lg:py-24 py-15 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">

    {{-- Main Product Section --}}
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                {{-- Image Gallery Section - Enhanced Carousel --}}
                <div class="lg:col-span-7 p-4 sm:p-6">
                    {{-- Carousel Component with Preline --}}
                    <div data-hs-carousel='{
                        "loadingClasses": "opacity-0",
                        "isAutoPlay": true,
                        "autoPlayInterval": 5000,
                        "isDraggable": true,
                        "dotsItemClasses": "hs-carousel-active:bg-emerald-500 hs-carousel-active:border-emerald-500 size-3 border border-gray-300 rounded-full cursor-pointer",
                        "slidesQty": {
                            "xs": 1,
                            "sm": 1,
                            "md": 1,
                            "lg": 1
                        },
                        "mode": "snap-slider"
                    }' class="relative">
                        <div class="hs-carousel w-full overflow-hidden bg-gray-50 rounded-xl">
                            <div class="relative min-h-[300px] sm:min-h-[400px] lg:min-h-[500px] -mx-1">
                                <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                                    {{-- Main Thumbnail Slide --}}
                                    <div class="hs-carousel-slide flex justify-center h-full">
                                        <div class="flex flex-col justify-center">
                                            <img class="w-full h-[300px] sm:h-[400px] lg:h-[500px] object-cover rounded-lg" 
                                                    src="{{ Storage::disk('s3')->url($product->thumbnail) }}" 
                                                    alt="{{ $product->name }}"
                                                    loading="lazy">
                                        </div>
                                    </div>
                                    
                                    {{-- Additional Product Images --}}
                                    @foreach($product->images as $index => $image)
                                    <div class="hs-carousel-slide flex justify-center h-full">
                                        <div class="flex flex-col justify-center">
                                            <img class="w-full h-[300px] sm:h-[400px] lg:h-[500px] object-cover rounded-lg" 
                                                src="{{ Storage::disk('s3')->url($image->image) }}" 
                                                alt="{{ $product->slug }} {{ $index + 1 }}"
                                                loading="lazy">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Navigation Arrows --}}
                        <button type="button" class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-12 h-full text-gray-800 hover:bg-gray-100/50 rounded-s-xl transition-colors hover:cursor-pointer">
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button type="button" class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-12 h-full text-gray-800 hover:bg-gray-100/50 rounded-e-xl transition-colors hover:cursor-pointer">
                            <span class="sr-only">Next</span>
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </span>
                        </button>

                        {{-- Carousel Indicators/Dots --}}
                        <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
                            @for($i = 0; $i <= count($product->images); $i++)
                                <span class="hs-carousel-active:bg-green-500 hs-carousel-active:border-green-500 size-3 border border-gray-300 rounded-full cursor-pointer transition-colors"></span>
                            @endfor
                        </div>
                    </div>

                    {{-- Thumbnail Preview Grid --}}
                    <div class="mt-4 sm:mt-6">
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-6 gap-2 sm:gap-3">
                            {{-- Main Thumbnail --}}
                            <button type="button" class="group border-2 border-gray-200 hover:border-green-500 rounded-lg overflow-hidden transition-all duration-200">
                                <img src="{{ Storage::disk('s3')->url($product->thumbnail) }}" 
                                    alt="Main thumbnail" 
                                    class="w-full h-16 sm:h-20 object-cover group-hover:scale-105 transition-transform duration-200"
                                    loading="lazy">
                            </button>
                            
                            {{-- Additional Thumbnails --}}
                            @foreach($product->images as $index => $image)
                            <button type="button" class="group border-2 border-gray-200 hover:border-green-500 rounded-lg overflow-hidden transition-all duration-200">
                                <img src="{{ Storage::disk('s3')->url($image->image) }}" 
                                    alt="Thumbnail {{ $index + 1 }}" 
                                    class="w-full h-16 sm:h-20 object-cover group-hover:scale-105 transition-transform duration-200"
                                    loading="lazy">
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Product Info Section --}}
                <div class="lg:col-span-5 p-4 sm:p-6 lg:p-8 bg-gradient-to-br from-white to-gray-50/50">
                    
                    {{-- Product Header --}}
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-6">
                        <div class="flex-1">
                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $product->category->name }}
                            </span>
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-2">{{ $product->name }}</h1>
                        </div>
                    </div>

                    {{-- Booking Form --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-6 shadow-sm mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilih Tanggal Sewa</h3>
                        
                        @if(!auth()->user()->hasVerifiedAddress())
                        <div class="mb-4 p-3 text-sm text-amber-800 rounded-lg bg-amber-50" role="alert">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 mr-2 size-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Verifikasi alamat terlebih dahulu untuk dapat memesan</span>
                                </div>
                                <a href="{{ route('user.addresses.index') }}" class="text-center text-amber-600 hover:text-amber-700 font-medium underline text-xs">
                                    Tambah Alamat
                                </a>
                            </div>
                        </div>
                        @endif

                        {{-- Date Inputs --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                                <input type="date" 
                                    id="start_date" 
                                    name="start_date"
                                    required
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                                <input type="date" 
                                    id="end_date" 
                                    name="end_date"
                                    required
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none">
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Price Display --}}
                        <div class="text-center mb-4">
                            <div class="text-2xl sm:text-3xl font-bold text-slate-600 mb-1">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <span class="text-sm text-gray-500">per hari</span>
                        </div>

                        {{-- Total Price Display (will be updated by JavaScript) --}}
                        <div class="text-center border-t border-gray-200 pt-4 mb-4">
                            <div class="text-sm text-gray-600 mb-1">Total Sewa</div>
                            <div id="total_price" class="text-2xl sm:text-3xl font-bold text-green-600">
                                Rp 0
                            </div>
                            <div id="total_days" class="text-sm text-gray-500">0 hari</div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            {{-- Cart Form --}}
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" id="cartForm">
                                @csrf
                                <input type="hidden" name="start_date" id="cart_start_date">
                                <input type="hidden" name="end_date" id="cart_end_date">
                                @if(auth()->user()->hasVerifiedAddress())
                                    <x-button type="submit"
                                        class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border disabled:opacity-50 disabled:pointer-events-none transition-all">
                                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                        </svg>
                                        Tambah ke Keranjang
                                    </x-button>
                                @else
                                    <button type="button" disabled
                                        class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
                                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                        </svg>
                                        Tambah ke Keranjang
                                    </button>
                                @endif
                            </form>

                            {{-- Direct Checkout Form --}}
                            <form action="{{ route('checkout.direct') }}" method="POST" id="checkoutForm">
                                @csrf
                                <input type="hidden" name="start_date" id="checkout_start_date">
                                <input type="hidden" name="end_date" id="checkout_end_date">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @if(auth()->user()->hasVerifiedAddress())
                                    <x-button type="submit" class="bg-emerald-700 py-4 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border focus:outline-none focus:bg-emerald-800 disabled:opacity-50 disabled:pointer-events-none transition-all">
                                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pesan Sekarang
                                    </x-button>
                                @else
                                    <button type="button" disabled
                                        class="py-4 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
                                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pesan Sekarang
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Quick Info Cards --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                            <div class="text-xs text-green-600 font-medium">Free Delivery</div>
                            <div class="text-sm text-green-800">Same Day</div>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
                            <div class="text-xs text-blue-600 font-medium">Support</div>
                            <div class="text-sm text-blue-800">24/7 Help</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Details Tabs --}}
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
            
            {{-- Tab Navigation --}}
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4 sm:space-x-8 px-4 sm:px-6 overflow-x-auto" aria-label="Tabs" role="tablist">
                    <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-emerald-600 hs-tab-active:text-emerald-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-emerald-600 focus:outline-none focus:text-emerald-600 active" 
                            id="description-tab" data-hs-tab="#description-panel" aria-controls="description-panel" role="tab">
                        Deskripsi
                    </button>
                    <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-emerald-600 hs-tab-active:text-emerald-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-emerald-600 focus:outline-none focus:text-emerald-600" 
                            id="specifications-tab" data-hs-tab="#specifications-panel" aria-controls="specifications-panel" role="tab">
                        Spesifikasi
                    </button>
                    <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-emerald-600 hs-tab-active:text-emerald ue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-emerald-600 focus:outline-none focus:text-emerald-600" 
                            id="features-tab" data-hs-tab="#features-panel" aria-controls="features-panel" role="tab">
                        Fitur
                    </button>
                </nav>
            </div>

            {{-- Tab Content --}}
            <div class="p-4 sm:p-6 lg:p-8">
                
                {{-- Description Panel --}}
                <div id="description-panel" role="tabpanel" aria-labelledby="description-tab">
                    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-gray-900"> {{ $product->name }} </h2>
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                {{-- Specifications Panel --}}
                <div id="specifications-panel" class="hidden" role="tabpanel" aria-labelledby="specifications-tab">
                    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-900">Spesifikasi</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700">{{ $product->power }}</span>
                            <span class="text-gray-900 font-semibold">{{ $product->battery_capacity }}</span>
                        </div>
                    </div>
                </div>

                {{-- Features Panel --}}
                <div id="features-panel" class="hidden" role="tabpanel" aria-labelledby="features-tab">
                    <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-900">Fitur Unggulan</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Feature items will be populated dynamically --}}
                        <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-lg">
                            <div class="flex justify-center items-center size-8 bg-green-500 rounded-full">
                                <svg class="shrink-0 size-4 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12l5 5L20 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">High Quality Components</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($similarProducts->count())
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Serupa</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarProducts as $product)
                    @include('components.card', [
                        'imgsrc' => Storage::disk('s3')->url($product->thumbnail),
                        'title' => $product->name,
                        'desc' => $product->description,
                        'type' => $product->category->name ?? '-',
                        'price' => $product->price,
                        'rating' => 5,
                        'slug' => $product->slug
                    ])
                @endforeach
            </div>
        </div>
    @endif
    </div>
</div>

{{-- Enhanced JavaScript for Interactions --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalPriceElement = document.getElementById('total_price');
        const totalDaysElement = document.getElementById('total_days');
        const cartForm = document.getElementById('cartForm');
        const checkoutForm = document.getElementById('checkoutForm');
        const cartStartDate = document.getElementById('cart_start_date');
        const cartEndDate = document.getElementById('cart_end_date');
        const checkoutStartDate = document.getElementById('checkout_start_date');
        const checkoutEndDate = document.getElementById('checkout_end_date');
        const pricePerDay = {{ $product->price }};

        // Initially disable submit buttons
        cartForm.querySelector('button[type="submit"]').disabled = true;
        checkoutForm.querySelector('button[type="submit"]').disabled = true;

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);

        function calculateTotal() {
            if (startDateInput.value && endDateInput.value) {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                
                if (start <= end) {
                    const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                    const total = days * pricePerDay;
                    
                    totalPriceElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                    totalDaysElement.textContent = `${days} hari`;
                    
                    // Enable buttons and update hidden inputs
                    cartForm.querySelector('button[type="submit"]').disabled = false;
                    checkoutForm.querySelector('button[type="submit"]').disabled = false;
                    
                    // Update hidden inputs
                    cartStartDate.value = startDateInput.value;
                    cartEndDate.value = endDateInput.value;
                    checkoutStartDate.value = startDateInput.value;
                    checkoutEndDate.value = endDateInput.value;
                } else {
                    totalPriceElement.textContent = 'Rp 0';
                    totalDaysElement.textContent = '0 hari';
                    cartForm.querySelector('button[type="submit"]').disabled = true;
                    checkoutForm.querySelector('button[type="submit"]').disabled = true;
                }
            } else {
                cartForm.querySelector('button[type="submit"]').disabled = true;
                checkoutForm.querySelector('button[type="submit"]').disabled = true;
            }
        }

        // Update return date minimum when start date changes
        startDateInput.addEventListener('change', function() {
            endDateInput.setAttribute('min', this.value);
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = '';
            }
            calculateTotal();
        });

        endDateInput.addEventListener('change', calculateTotal);
    });
</script>
@endpush
@endsection