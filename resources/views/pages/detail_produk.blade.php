@extends('layouts.app')

@section('title', 'Detail_produk')
@section('content')

<x-page-header
    title="Detail Transportasi"
    :breadcrumbs="[
        ['label' => 'Sewa', 'url' => route('home')],
        ['label' => 'Wuling Air EV', 'isCurrent' => true],
    ]"
/>


<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
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

        <!-- Detail Produk -->
        <main class="w-full lg:w-3/4 space-y-6">
            <!-- Gambar & Info -->
            <div class="flex flex-col lg:flex-row gap-6">
                <img src="/images/wuling.png" alt="Wuling Air EV" class="rounded-xl w-full lg:w-1/2 object-cover">

                <div class="flex-1 space-y-4">
                    <div class="flex justify-between items-start">
                        <h1 class="text-2xl font-bold">Wuling Air EV</h1>
                        <button class="text-red-500 text-xl">&#9829;</button>
                    </div>

                    <div class="text-sm text-gray-500">⭐⭐⭐⭐⭐ <span class="text-blue-600">440+Ulasan</span></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <input type="date" class="input input-bordered w-full" placeholder="Tanggal Sewa" />
                        <input type="date" class="input input-bordered w-full" placeholder="Tanggal Kembali" />
                    </div>

                    <div class="text-xl font-bold text-indigo-600">Rp120.000 <span class="text-sm text-gray-500">/ hari</span></div>

                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Cek Stok</button>
                </div>
            </div>

            <!-- Deskripsi -->
            <section>
                <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                <p class="text-sm text-gray-700">
                    Wuling Air EV 2023 adalah 4-Seater Hatchback yang tersedia dalam daftar harga Rp 184 – 307.5 Juta di Indonesia.
                    Dimensi Air EV adalah 2974 mm L x 1505 mm W x 1631 mm H. Lebih dari 1 pengguna telah memberikan penilaian untuk Air EV berdasarkan fitur,
                    jarak tempuh, kenyamanan tempat duduk dan kinerja mesin.
                </p>
            </section>

           

        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Ulasan</h2>
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="https://i.pravatar.cc/50?img=1" />
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold">Alex Stanton <span class="text-sm text-gray-500">CEO at Bukalapak</span></h3>
                        <p class="text-gray-600 text-sm mt-1">
                            We are very happy with the service from the MORENT App. Morent has a low price and also a large variety of cars.
                        </p>
                        <div class="rating rating-sm mt-2">
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" />
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="https://i.pravatar.cc/50?img=2" />
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold">Skylar Dias <span class="text-sm text-gray-500">CEO at Amazon</span></h3>
                        <p class="text-gray-600 text-sm mt-1">
                            We are greatly happy with the services of the MORENT Application. Morent has low prices and a wide variety of cars.
                        </p>
                        <div class="rating rating-sm mt-2">
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" class="mask mask-star-2 bg-orange-400" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Produk Serupa -->
        <div>
            <div class="flex justify-between mb-3">
                <h2 class="text-xl font-semibold">Produk Serupa</h2>
                <a href="#" class="text-sm text-blue-500">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white p-4 rounded-xl shadow text-center space-y-2 relative">
                        <img src="images/wuling.png" class="rounded-xl w-full h-32 object-cover">
                        <h3 class="font-semibold text-sm">Wuling Air EV</h3>
                        <p class="text-sm text-gray-500">⭐⭐⭐⭐⭐ 5.0</p>
                        <p class="text-sm font-medium">Rp120.000/hari</p>
                        <button class="btn btn-sm btn-primary w-full">Detail</button>
                        <button class="absolute top-2 right-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                                2 5.42 4.42 3 7.5 3c1.74 0 
                                3.41.81 4.5 2.09C13.09 3.81 
                                14.76 3 16.5 3 19.58 3 22 
                                5.42 22 8.5c0 3.78-3.4 6.86-8.55 
                                11.54L12 21.35z"/>
                            </svg>
                        </button>
                    </div>
                @endfor
            </div>
        </div>
    </main>
</div>
@endsection
   
