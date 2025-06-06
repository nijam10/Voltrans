{{-- resources/views/pages/rent.blade.php --}}
@extends('layouts.app')
@section('title', 'Sewa Kendaraan')
@section('content')

<div class="bg-gradient-to-br from-emerald-50 via-white to-blue-50">
    
    <x-page-header :title="'Sewa Kendaraan'" :breadcrumbs="$breadcrumbs" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Filter Kendaraan</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Kendaraan</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Tipe</option>
                        <option value="E-Car">E-Car</option>
                        <option value="MPV">MPV</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Sedan">Sedan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Minimum</label>
                    <input type="number" placeholder="Rp 0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimum</label>
                    <input type="number" placeholder="Rp 1.000.000" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                        Filter
                    </button>
                </div>
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($allProducts as $product)
                @include('components.card', [
                    'imgsrc' => asset('storage/' . $product->thumbnail),
                    'title' => $product->name,
                    'desc' => $product->description,
                    'type' => $product->category->name,
                    'price' => $product->price,
                    'rating' => 5,
                    'slug' => $product->slug  // <- Pastikan slug dikirim
                ])
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center mt-12">
            <nav class="flex items-center gap-2">
                <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg">1</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">2</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">3</button>
                
                <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </nav>
        </div>
    </div>
</div>

@endsection