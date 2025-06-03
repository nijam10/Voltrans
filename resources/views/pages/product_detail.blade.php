@extends('layouts.app')
@section('title', 'Detail Produk')
@section('content')

{{-- Background Wrapper --}}


    <x-page-header :title="'Detail Transportasi'" :breadcrumbs="$breadcrumbs" />

    <div class="mx-auto px-6 sm:px-8 flex flex-col lg:flex-row gap-8 p-6 max-w-7xl bg-white/90 rounded-xl shadow-xl">
        <!-- Gambar besar di kiri -->
        <div class="w-full lg:w-3/5 relative h-[400px] rounded-2xl shadow-lg overflow-hidden bg-gray-100">
            @include('components/product-slider')
        </div>

        <!-- Keterangan di kanan -->
        <div class="w-full lg:w-2/5 space-y-6">
            <div class="flex justify-between items-start">
                <h1 class="text-3xl font-bold text-gray-800">Wuling Air EV</h1>
                <button class="text-red-500 text-2xl hover:scale-110 transition-transform">&#9829;</button>
            </div>

            <div class="text-sm text-gray-600 flex items-center gap-1">
                ⭐⭐⭐⭐⭐ <span class="text-blue-600 ml-2">440+ Ulasan</span>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <label for="tanggal_sewa" class="text-sm font-medium">Tanggal Sewa</label>
                <input type="date" id="tanggal_sewa" class="input input-bordered w-full rounded-lg" />

                <label for="tanggal_kembali" class="text-sm font-medium">Tanggal Kembali</label>
                <input type="date" id="tanggal_kembali" class="input input-bordered w-full rounded-lg" />
            </div>

            <div class="text-2xl font-bold text-emerald-700">
                Rp120.000 <span class="text-sm text-gray-500">/ hari</span>
            </div>

            <a href="{{ route('rent') }}"
                class="block w-full text-center rounded-xl bg-emerald-700 px-5 py-3 text-white font-semibold shadow-md hover:bg-emerald-600 hover:shadow-xl transition duration-300">
                Cek Stok
            </a>
        </div>
    </div>

    <!-- Deskripsi -->
    <div class="p-6 max-w-5xl mx-auto mt-10 bg-white/80 rounded-xl shadow-md">
        <section>
            <h2 class="text-2xl font-bold mb-4 text-gray-900">Deskripsi</h2>
            <p class="text-gray-700 leading-relaxed text-base">
                Wuling Air EV 2023 adalah 4-Seater Hatchback yang tersedia dalam daftar harga Rp 184 – 307.5 Juta di Indonesia.
                Dimensi Air EV adalah 2974 mm L x 1505 mm W x 1631 mm H. Lebih dari 1 pengguna telah memberikan penilaian untuk Air EV
                berdasarkan fitur, jarak tempuh, kenyamanan tempat duduk dan kinerja mesin.
            </p>
        </section>
    </div>

    <!-- Ulasan -->
    <div class="p-6 max-w-5xl mx-auto mt-10">
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Ulasan</h2>

            <div class="space-y-6">
                @foreach ([
                    ['name' => 'Alex Stanton', 'role' => 'CEO at Bukalapak', 'date' => '15-Juni-2018', 'review' => 'We are very happy with the service from the MORENT App. Morent has a low price and also a large variety of cars.'],
                    ['name' => 'Skylar Dias', 'role' => 'CEO at Amazon', 'date' => '07-Juni-2018', 'review' => 'We are greatly happy with the services of the MORENT Application. Morent has low prices and a wide variety of cars.']
                ] as $user)
                <div class="flex gap-4 p-5 bg-emerald-50/30 rounded-xl shadow-md border border-emerald-100">
                    <img src="https://i.pravatar.cc/50?u={{ $user['name'] }}" class="w-12 h-12 rounded-full object-cover" />
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $user['name'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $user['role'] }} · <span>{{ $user['date'] }}</span></p>
                            </div>
                        </div>
                        <p class="text-gray-700 mt-3 text-sm">
                            {{ $user['review'] }}
                        </p>
                        <div class="flex items-center mt-3 text-yellow-400 text-lg">
                            ★★★★☆
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Produk Serupa -->
    <div class="p-6 max-w-7xl mx-auto mt-10 bg-emerald-50/30 rounded-xl shadow-inner">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-2xl font-semibold text-gray-800">Produk Serupa</h2>
            <a href="{{ route('rent') }}" class="text-blue-600 hover:underline font-semibold">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
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
        </div>
    </div>

@endsection
