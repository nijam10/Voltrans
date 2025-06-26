@extends('layouts.app')
@section('title', 'Sewa Kendaraan')
@section('content')

<div class="bg-gradient-to-br from-emerald-50 via-white to-blue-50">
    
    <x-page-header :title="'Sewa Kendaraan'" :breadcrumbs="$breadcrumbs" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Filter Kendaraan</h2>
            <form method="GET" action="{{ route('rent') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                {{-- Tipe Kendaraan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Kendaraan</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Tipe</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}" {{ request('type') == $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga Minimum --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Minimum</label>
                    <input name="min_price" type="number" value="{{ request('min_price') }}" placeholder="Rp 0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>

                {{-- Harga Maksimum --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimum</label>
                    <input name="max_price" type="number" value="{{ request('max_price') }}" placeholder="Rp 1.000.000"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>

                {{-- Rating --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating Minimum</label>
                    <select name="rating" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option class='text-yellow-400' value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                @for ($star = 0 ; $star < $i; $star++) 
                                    ★
                                @endfor
                                <span class='text-gray-500'>( {{ $i }} Bintang )</span>
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Tombol Filter --}}
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                        Filter
                    </button>
                    
                    <a href="{{ route('rent') }}" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg text-center transition-colors duration-300">
                        Reset
                    </a>
                </div>
                

                {{-- Hidden search (opsional) --}}
                <input type="hidden" name="q" value="{{ request('q') }}">
            </form>
        </div>

        {{-- Search Results Info --}}
        @if(request()->filled('q'))
            <div class="mb-4 text-gray-700 text-lg font-medium">
                Menampilkan hasil untuk "{{ request('q') }}"
            </div>
        @endif

        {{-- Products Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @forelse($allProducts as $product)
                @include('components.card', [
                    'imgsrc' => Storage::disk('s3')->url($product->thumbnail),
                    'title' => $product->name,
                    'desc' => $product->description,
                    'type' => $product->category->name,
                    'price' => $product->price,
                    'rating' => $product->rating ?? 5,
                    'slug' => $product->slug
                ])
            @empty
            <div class="col-span-full text-center text-gray-600">Produk yang anda cari tidak tersedia saat ini</div>
            @endforelse
            
        </div>

        {{-- Pagination --}}
        @if(method_exists($allProducts, 'links'))
            <div class="flex justify-center mt-12">
                {{ $allProducts->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
