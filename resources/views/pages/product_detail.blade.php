@extends('layouts.app')
@section('title', $product->name)
@section('content')


<div class="py-15 lg:py-18 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">
    {{-- Main Product Section --}}
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
        <x-breadcrumb :breadcrumbs="$breadcrumbs"/>
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
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-2">{{ $product->name }}</h1>
                        </div>
                    </div>

                    {{-- Booking Form --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-6 shadow-sm mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilih Tanggal Sewa</h3>
                        @guest
                            <div class="mb-4 p-3 text-sm text-amber-800 rounded-lg bg-blue-50" role="alert">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="shrink-0 mr-2 size-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 13a1 1 0 01-1 1H7a1 1 0 01-1-1V7a1 1 0 011-1h10a1 1 0 011 1v6zm-2-2a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Silahkan login untuk memesan</span>
                                    </div>
                                </div>
                            </div>
                        @endguest
                        @auth
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
                        @endauth
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
                                @auth
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
                                @endauth
                            </form>

                            {{-- Direct Checkout Form --}}
                            <form action="{{ route('checkout.direct') }}" method="POST" id="checkoutForm">
                                @csrf
                                <input type="hidden" name="start_date" id="checkout_start_date">
                                <input type="hidden" name="end_date" id="checkout_end_date">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                @auth
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
                                @else
                                    <button type="button" disabled
                                        class="py-4 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
                                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pesan Sekarang
                                    </button>
                                @endauth
                            </form>
                        </div>

                        {{-- Admin Verification Note --}}
                        <div class="mt-2 text-xs text-yellow-700 bg-yellow-100 border border-yellow-300 rounded p-2">
                            <strong>Catatan:</strong> Setelah checkout, pesanan Anda akan diverifikasi oleh admin sebelum dapat melakukan pembayaran.
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
    
    {{-- Product Details Section (Vertical, No Tabs) --}}
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
            <div class="p-4 sm:p-6 lg:p-8 space-y-8">
                {{-- Description (Collapsible if long) --}}
                <div x-data="{ expanded: false }">
                    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 17l4 4 4-4m-4-5V3"/></svg>
                            Deskripsi
                    </h2>
                    <div class="overflow-hidden transition-all duration-300 ease-in-out"
                        x-bind:style="expanded ? 'max-height: 1000px; opacity: 1;' : 'max-height: 3.5em; opacity: 0.8;'"
                        x-transition:enter="transition-all duration-300 ease-out"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition-all duration-200 ease-in"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2">
                        <div class="text-gray-700 relative leading-relaxed prose max-w-none">
                            {{ $product->description }}
                        </div>
                    </div>
                    <div class="mt-4 flex">
                        <button @click="expanded = !expanded" type="button"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-teal-600 hover:text-teal-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <span x-text="expanded ? 'Tampilkan lebih sedikit' : 'Tampilkan lebih banyak'"></span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6,9 12,15 18,9"></polyline></svg>
                        </button>
                    </div>
                </div>
                {{-- Specifications Section --}}
                <div x-data="{ expanded: false }">
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 sm:mb-6 text-gray-900 flex items-center gap-2 sm:gap-3">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19.5 2 21l1.5-5L16.5 3.5z"/>
                        </svg>
                        <span class="leading-tight">Spesifikasi</span>
                    </h2>
                    
                    @php
                        $specs = $product->specs ?? [];
                        $specifications = [
                            ['label' => 'Daya', 'value' => ($specs['power'] ?? '-') . ' HP', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5"><path d="M4.75 8a.75.75 0 0 0-.75.75v2.5c0 .414.336.75.75.75h9.5a.75.75 0 0 0 .75-.75v-2.5a.75.75 0 0 0-.75-.75h-9.5Z" /><path fill-rule="evenodd" d="M1 7.25A2.25 2.25 0 0 1 3.25 5h12.5A2.25 2.25 0 0 1 18 7.25v1.085a1.5 1.5 0 0 1 1 1.415v.5a1.5 1.5 0 0 1-1 1.415v1.085A2.25 2.25 0 0 1 15.75 15H3.25A2.25 2.25 0 0 1 1 12.75v-5.5Zm2.25-.75a.75.75 0 0 0-.75.75v5.5c0 .414.336.75.75.75h12.5a.75.75 0 0 0 .75-.75v-5.5a.75.75 0 0 0-.75-.75H3.25Z" clip-rule="evenodd" /></svg>'],
                            ['label' => 'Kapasitas Baterai', 'value' => ($specs['battery_capacity'] ?? '-') . ' kWh', 'icon' => '<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="18" height="10" rx="2"/><line x1="22" y1="11" x2="22" y2="13"/></svg>'],
                            ['label' => 'Kecepatan Maksimum', 'value' => ($specs['max_speed'] ?? '-') . ' km/h', 'icon' => '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polygon points="10,8 16,12 10,16 10,8"/></svg>'],
                            ['label' => 'Jarak Tempuh', 'value' => ($specs['mileage'] ?? '-') . ' km', 'icon' => '<svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"/></svg>'],
                            ['label' => 'Waktu Pengisian', 'value' => $specs['charge_duration'] ?? '-', 'icon' => '<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="13 2 13 13 17 13 7 22 7 11 3 11 13 2"/></svg>'],
                        ];
                        $visibleSpecs = 3; // Number of specs to show initially
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-4">
                        @foreach($specifications as $index => $spec)
                            <div class="flex items-center justify-between p-3 sm:p-4 bg-gradient-to-r from-gray-50 to-gray-100 hover:from-blue-50 hover:to-blue-100 rounded-lg border border-gray-200 hover:border-blue-200 transition-all duration-200 hover:shadow-sm group
                                {{ $index >= $visibleSpecs ? 'transition-all duration-300 ease-in-out' : '' }}"
                                @if($index >= $visibleSpecs)
                                    x-show="expanded"
                                    x-transition:enter="transition-all duration-300 ease-out"
                                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition-all duration-200 ease-in"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                @endif>
                                <div class="flex items-center gap-2 sm:gap-3 flex-1 min-w-0">
                                    <div class="flex-shrink-0 group-hover:scale-110 transition-transform duration-200">
                                        {!! $spec['icon'] !!}
                                    </div>
                                    <span class="font-medium text-gray-700 text-sm sm:text-base truncate">{{ $spec['label'] }}</span>
                                </div>
                                <span class="text-gray-900 font-semibold text-sm sm:text-base flex-shrink-0 ml-2">{{ $spec['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    @if(count($specifications) > $visibleSpecs)
                        <div class="mt-4 flex">
                            <button @click="expanded = !expanded" type="button"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-teal-600 hover:text-teal-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                                <span x-text="expanded ? 'Tampilkan lebih sedikit spesifikasi' : 'Tampilkan semua spesifikasi'"></span>
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" 
                                    :class="{ 'rotate-180': expanded }" 
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polyline points="6,9 12,15 18,9"></polyline>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- Product Reviews Section --}}
        <div>
            <h2 class="text-xl mt-7 sm:text-2xl lg:text-3xl font-bold mb-4 sm:mb-6 text-gray-900 flex items-center gap-2 sm:gap-3">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="leading-tight">Ulasan Pelanggan</span>
            </h2>
            @php
                $reviews = $product->reviews()->with('customer', 'orderItem', 'orderItem.order')->latest()->get();
                $average = $reviews->avg('rating');
                $count = $reviews->count();
                $minCollapseLength = 120;
            @endphp
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-4 sm:p-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-start gap-2 mb-2">
                            <span class="text-3xl sm:text-4xl font-bold text-gray-900">{{ number_format($average, 1) }}</span>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= round($average) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">Berdasarkan {{ $count }} ulasan</p>
                    </div>
                </div>
            </div>
            <div class="space-y-4 sm:space-y-6">
                @forelse($reviews as $review)
                    <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="flex-shrink-0">
                                @php
                                    $photoPath = $review->customer->profile_photo_path ?? null;
                                    $finalPhotoUrl = null;
                                    if ($photoPath) {
                                        $finalPhotoUrl = Str::startsWith($photoPath, ['http://', 'https://'])
                                            ? $photoPath
                                            : Storage::disk('s3')->url($photoPath);
                                    }
                                @endphp
                                <img src="{{ $finalPhotoUrl ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->customer->name ?? 'User') . '&background=059669&color=fff&size=40' }}" alt="{{ $review->customer->name ?? 'User' }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-gray-200">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm sm:text-base">{{ $review->customer->name ?? 'User' }}</h4>
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-xs sm:text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                @php $isCollapsible = strlen($review->comment) > $minCollapseLength; @endphp
                                @if($isCollapsible)
                                <div x-data="{ expanded: false }">
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3 overflow-hidden transition-all duration-300 ease-in-out"
                                        x-bind:style="expanded ? 'max-height: 1000px; opacity: 1;' : 'max-height: 3.5em; opacity: 0.8;'"
                                        x-transition:enter="transition-all duration-300 ease-out"
                                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        x-transition:leave="transition-all duration-200 ease-in"
                                        x-transition:leave-start="opacity-100 transform translate-y-0"
                                        x-transition:leave-end="opacity-0 transform -translate-y-2">
                                        {{ $review->comment }}
                                    </p>
                                    <div class="mt-2 flex">
                                        <button @click="expanded = !expanded" type="button"
                                            class="inline-flex items-center gap-2 px-3 py-1 text-xs font-medium text-teal-600 hover:text-teal-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                                            <span x-text="expanded ? 'Tampilkan lebih sedikit' : 'Tampilkan lebih banyak'"></span>
                                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6,9 12,15 18,9"></polyline></svg>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-3">
                                    {{ $review->comment }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500">Belum ada ulasan untuk produk ini.</div>
                @endforelse
            </div>
        </div>

        {{-- Similar products section --}}
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

        // Set minimum date to 3 days from today
        const today = new Date();
        const minStartDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 3);
        const minStartDateStr = minStartDate.toISOString().split('T')[0];
        startDateInput.setAttribute('min', minStartDateStr);
        endDateInput.setAttribute('min', minStartDateStr);

        // Initially disable submit buttons
        cartForm.querySelector('button[type="submit"]').disabled = true;
        checkoutForm.querySelector('button[type="submit"]').disabled = true;

        function calculateTotal() {
            if (startDateInput.value && endDateInput.value) {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                if (start <= end) {
                    const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                    const total = days * pricePerDay;
                    totalPriceElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                    totalDaysElement.textContent = `${days} hari`;
                    cartForm.querySelector('button[type="submit"]').disabled = false;
                    checkoutForm.querySelector('button[type="submit"]').disabled = false;
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

        startDateInput.addEventListener('change', function() {
            endDateInput.setAttribute('min', this.value);
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = '';
            }
            calculateTotal();
        });
        endDateInput.addEventListener('change', calculateTotal);

        // SweetAlert2 for Add to Cart
        cartForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Optionally, you can do AJAX here. For now, just show notification and submit.
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Produk telah ditambahkan ke keranjang.',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(() => {
                cartForm.submit();
            }, 1600);
        });

        // SweetAlert2 for Direct Checkout
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Pesanan Diproses!',
                text: 'Anda akan diarahkan ke halaman checkout.',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(() => {
                checkoutForm.submit();
            }, 1600);
        });
    });
</script>
@endpush
@endsection