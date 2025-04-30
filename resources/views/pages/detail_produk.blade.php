@extends('layouts.app')

@section('title', 'Detail_produk')
@section('content')

<x-page-header :title="'Detail Transportasi'" :breadcrumbs="$breadcrumbs" />



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
                        <p>Pilih tanggal Sewa</p>
                        <input type="date" class="input input-bordered w-full" placeholder="Tanggal Sewa" />
                        <p>Pilih tanggal Kembali</p>
                        <input type="date" class="input input-bordered w-full" placeholder="Tanggal Kembali" />
                    </div>

                    <div class="text-xl font-bold text-indigo-600">Rp120.000 <span class="text-sm text-gray-500">/ hari</span></div>

                    <a href="{{ route ('rent')}}" class=" text-center w-full inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 px-5 py-3 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white" >Cek Stok</a>
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
                        <h3 class="font-bold">Alex Stanton <span class="text-sm text-gray-500">CEO at Bukalapak</span></h3><p class="text-gray-500 text-left text-sm">15-Juni-2018</p>
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
                        <h3 class="font-bold">Skylar Dias <span class="text-sm text-gray-500">CEO at Amazon</span></h3><p class="text-gray-500 text-left text-sm">07-Juni-2018</p>
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
                <h2 class="text-xl font-semibold p-2">Produk Serupa</h2>
                <a href="rent" class="text-sm text-blue-500">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @for($i = 0; $i < 4; $i++)
                    @include('components.card', [
                        'imgsrc' => 'images/wuling.png',
                        'title' => 'Wuling Air EV',
                        'type' => 'E-Car',
                        'price' => '120.000',
                        'rating' => '5.0'
                    ])
                @endfor
            </div>
        </div>
    </main>
</div>
@endsection
   
