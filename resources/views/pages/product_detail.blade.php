@extends('layouts.app')
@section('title', 'Detail Produk')
@section('content')

<script>
    const images = [
        "/images/wuling.png",
        "/images/charging-car.jpg",
        "/images/hero.png"
    ];
    let currentIndex = 0;

    function showSlide(index) {
        const slideImage = document.getElementById("slide-image");
        const indicator = document.getElementById("slide-indicator");
        slideImage.src = images[index];
        indicator.textContent = (index + 1) + "/" + images.length;
        currentIndex = index;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showSlide(currentIndex);
    }

    document.addEventListener("DOMContentLoaded", function() {
        showSlide(currentIndex);
    });
</script>

<x-page-header :title="'Detail Transportasi'" :breadcrumbs="$breadcrumbs" />

<div class="mx-auto px-6 sm:px-8 flex flex-col lg:flex-row gap-6 items-start p-5 max-w-7xl">
    <!-- Gambar besar di kiri -->
    <div class="w-full lg:w-3/5 relative h-[350px] rounded-xl shadow-md overflow-hidden bg-gray-100">
        <img id="slide-image" src="/images/wuling.png"
            class="w-full h-full object-cover transition-all duration-300 rounded-xl" />
        <!-- Tombol Panah -->
        <button onclick="prevSlide()" class="absolute left-3 top-1/2 transform -translate-y-1/2 bg-white/80 rounded-full p-2 shadow-md hover:bg-white">
            ❮
        </button>
        <button onclick="nextSlide()" class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-white/80 rounded-full p-2 shadow-md hover:bg-white">
            ❯
        </button>
        <!-- Indicator -->
        <div id="slide-indicator" class="absolute bottom-3 right-3 bg-black bg-opacity-50 text-white text-sm rounded px-2 py-1 select-none">
            1/3
        </div>
    </div>

    <!-- Keterangan di kanan -->
    <div class="w-full lg:w-2/5 space-y-4">
        <div class="flex justify-between items-start">
            <h1 class="text-2xl font-bold">Wuling Air EV</h1>
            <button class="text-red-500 text-xl">&#9829;</button>
        </div>

        <div class="text-sm text-gray-500">
            ⭐⭐⭐⭐⭐ <span class="text-blue-600">440+Ulasan</span>
        </div>

        <div class="grid grid-cols-1 gap-3">
            <label for="tanggal_sewa" class="text-sm font-medium">Pilih tanggal Sewa</label>
            <input type="date" id="tanggal_sewa" class="input input-bordered w-full" />

            <label for="tanggal_kembali" class="text-sm font-medium">Pilih tanggal Kembali</label>
            <input type="date" id="tanggal_kembali" class="input input-bordered w-full" />
        </div>

        <div class="text-xl font-bold text-indigo-600">
            Rp120.000 <span class="text-sm text-gray-500">/ hari</span>
        </div>

        <a href="{{ route('rent') }}" class="text-center w-full inline-block rounded-xl border border-zinc-600 bg-emerald-900 px-5 py-3 font-medium text-slate-200 shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:bg-emerald-700 hover:text-white">
            Cek Stok
        </a>
    </div>
</div>
    
    
    <!-- Deskripsi -->
    <div class="p-5">
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


<!-- Produk Serupa -->
<div>
    <div class="flex justify-between mb-3">
        <h2 class="text-xl font-semibold p-4">Produk Serupa</h2>
        <a href="rent" class="text-blue-500 p-3 font-bold">Lihat Semua</a>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4">
        @for($i = 0; $i < 4; $i++)
        @include('components.card', [
            'imgsrc' => 'images/wuling.png',
            'title' => 'Wuling Air EV',
            'desc' => 'Wuling Air EV adalah mobil listrik yang sangat populer di Indonesia',
            'type' => 'E-Car',
            'price' => '120.000',
            'rating' => '5.0'
            ])
                @endfor
            </>
        </div>
    </main>
</div>
</div>
@endsection

