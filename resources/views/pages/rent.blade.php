@extends('layout.app')

@section('title', 'Rent')
    @section('content')
    <div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Filter Sidebar -->
        <div class="w-full md:w-1/4">
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
                                    @for($i = 0; $i < 5; $i++) <span class="text-yellow-400">★</span> @endfor
                                    <span class="ml-2">5.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 4; $i++) <span class="text-yellow-400">★</span> @endfor
                                    <span class="ml-2">4.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 3; $i++) <span class="text-yellow-400">★</span> @endfor
                                    <span class="ml-2">3.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    @for($i = 0; $i < 2; $i++) <span class="text-yellow-400">★</span> @endfor
                                    <span class="ml-2">2.0</span>
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="checkbox checkbox-primary" checked />
                                <span class="flex">
                                    <span class="text-yellow-400">★</span>
                                    <span class="ml-2">1.0</span>
                                </span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Product Listing -->
        <div class="w-full md:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 0; $i < 7; $i++)
                <div class="card bg-base-100 shadow hover:shadow-lg transition-shadow">
                    <figure class="px-4 pt-4">
                        <img src="https://placehold.co/300x200?text=Product+Image" alt="Wuling Air EV" class="rounded-xl h-48 w-full object-cover" />
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title">Wuling Air EV</h3>
                        <p class="text-gray-500">E-Car</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold">Rp120.000/ Day</span>
                            <div class="flex items-center">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1">5.0</span>
                            </div>
                        </div>
                        <div class="card-actions mt-4">
                            <button class="btn btn-primary w-full">Rent it Now!</button>
                        </div>
                    </div>
                </div>
                @endfor
        </div>
            <!-- Pagination -->
            <div class="join flex justify-center mt-8">
                <button class="join-item btn">«</button>
                <button class="join-item btn btn-active">1</button>
                <button class="join-item btn">2</button>
                <button class="join-item btn">3</button>
                <button class="join-item btn">»</button>
            </div>
        </div>
    </div>
</div>
@endsection

