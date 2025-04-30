@extends('layouts.app')

@section('title', 'Rent')
    @section('content')
        

    <x-page-header :title="'Sewa'" :breadcrumbs="$breadcrumbs" />


        <div class="container mx-auto px-4 py-8 mt-2">
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Filter Sidebar -->
                <aside class="w-full lg:w-1/4 bg-white rounded-xl p-6 shadow">
                    <h2 class="text-lg font-semibold mb-4">Filter</h2>

                    <!-- Kategori -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium mb-2">Semua Kategori</h3>
                        <ul class="space-y-1 text-sm text-gray-700">
                            <li><label><input type="checkbox" checked class="mr-2">Semua (107)</label></li>
                            <li><label><input type="checkbox" class="mr-2">Mobil (25)</label></li>
                            <li><label><input type="checkbox" class="mr-2">Motor (37)</label></li>
                            <li><label><input type="checkbox" class="mr-2">Sepeda (35)</label></li>
                            <li><label><input type="checkbox" class="mr-2">Skuter (10)</label></li>
                        </ul>
                    </div>

                    <!-- Harga -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium mb-2">Harga</h3>
                        <input type="range" min="50000" max="150000" value="80000" class="w-full">
                        <p class="text-xs text-gray-600 mt-1">Harga: Rp50.000 – Rp150.000</p>
                    </div>

                    <!-- Rating -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium mb-2">Rating</h3>
                        <ul class="space-y-1 text-sm">
                            @foreach ([5, 4, 3, 2, 1] as $rating)
                                <li>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="mr-2" {{ $rating === 5 ? 'checked' : '' }}>
                                        @for ($i = 0; $i < $rating; $i++)
                                            <span class="text-yellow-400">&#9733;</span>
                                        @endfor
                                        @for ($i = $rating; $i < 5; $i++)
                                            <span class="text-gray-300">&#9733;</span>
                                        @endfor
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
                <!-- Product Listing -->
                <div class="w-full md:w-3/4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @for($i = 0; $i < 9; $i++)
                            @include('components.card', [
                                'imgsrc' => 'images/wuling.png',
                                'title' => 'Wuling Air EV',
                                'type' => 'E-Car',
                                'price' => '120.000',
                                'rating' => '5.0'
                            ])
                        @endfor
                    </div>
                    <!-- Pagination -->
                    <div class="join flex justify-center mt-8">
                        <input
                            class="join-item btn btn-success btn-square"
                            type="radio"
                            name="options"
                            aria-label="1"
                            checked="checked" />
                        <input class="join-item btn btn-square" type="radio" name="options" aria-label="2" />
                        <input class="join-item btn btn-square" type="radio" name="options" aria-label="3" />
                        <input class="join-item btn btn-square" type="radio" name="options" aria-label="4" />
                    </div>
                </div>
            </div>
        </div>
    @endsection

