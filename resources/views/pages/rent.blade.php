@extends('layouts.app')

@section('title', 'Rent')
    @section('content')
        <x-page-header
            title="Sewa"
            :breadcrumbs="[
                ['label' => 'Sewa', 'url' => route('rent')],
            ]"
        />

<div class="container mx-auto px-4 py-8 mt-2">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Filter Sidebar -->
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                <h2 class="text-xl font-bold mb-6">Filter</h2>
                
                <!-- Category Filter -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-3">All Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-primary hover:underline">All (107)</a></li>
                        <li><a href="#" class="hover:underline">E-Bicycle (25)</a></li>
                        <li><a href="#" class="hover:underline">E-Motorcycle (37)</a></li>
                        <li><a href="#" class="hover:underline">E-Car (35)</a></li>
                        <li><a href="#" class="hover:underline">E-Scooter (10)</a></li>
                    </ul>
                </div>
                
                <!-- Price Filter -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-3">Price</h3>
                    <div class="flex items-center gap-2">
                        <input type="text" class="input input-bordered w-full" placeholder="Rp50.000">
                        <span>-</span>
                        <input type="text" class="input input-bordered w-full" placeholder="Rp50.000">
                    </div>
                </div>
                
                <!-- Rating Filter -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-3">Rating</h3>
                    <ul class="space-y-2">
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 5; $i++) <span>★</span> @endfor
                                    <span class="ml-2">5.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 4; $i++) <span>★</span> @endfor
                                    <span class="ml-2">4.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 3; $i++) <span>★</span> @endfor
                                    <span class="ml-2">3.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 2; $i++) <span>★</span> @endfor
                                    <span class="ml-2">2.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    <span>★</span>
                                    <span class="ml-2">1.0</span>
                                </span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        
        <!-- Product Listing -->
        <div class="w-full md:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 0; $i < 9; $i++)
                    @include('components.card', [
                        'imgsrc' => 'images/wuling.png',
                        'title' => 'Wuling Air EV',
                        'price' => '120.000/hari',
                        'rating' => '⭐⭐⭐⭐⭐ 5.0'
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

