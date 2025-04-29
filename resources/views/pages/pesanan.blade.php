@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="bg-gray-100 min-h-screen">
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Pesanan</h1>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Form Pesanan -->
        <div class="md:col-span-8 space-y-6">
            <!-- Informasi Pesanan -->
            <div class="card bg-white p-6 shadow rounded-xl">
                <h2 class="font-semibold text-lg mb-4">Informasi Pesanan</h2>
                <p class="text-gray-500 mb-6">Tolong isi form pesanan berikut.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan nama"
                            class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="telepon" id="telepon" placeholder="Masukkan no. telepon"
                            class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat email</label>
                        <input type="email" name="email" id="email" placeholder="Masukkan alamat email"
                            class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Metode Pemesanan -->
            <div class="card bg-white p-6 shadow rounded-xl">
                <h2 class="font-semibold text-lg mb-4">Metode Pemesanan</h2>
                <div class="mb-4">
                    <label class="label">Penjemputan</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="penjemputan" class="radio" checked />
                            <span>Ambil di toko</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="penjemputan" class="radio" />
                            <span>Antar ke lokasi</span>
                        </label>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <select id="provinsi" name="provinsi"
                        class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none">
                        <option disabled selected>Pilih Provinsi</option>
                        <option>Kepulauan Riau</option>
                        </select>
                    </div>

                    <div>
                        <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                        <select id="kota" name="kota"
                        class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none">
                        <option disabled selected>Pilih Kota</option>
                        <option>Batam</option>
                        </select>
                    </div>

                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan"
                        class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none">
                        <option disabled selected>Pilih Kecamatan</option>
                        <option>Batu Ampar</option>
                        <option>Bengkong</option>
                        <option>Batam Kota</option>
                        <option>Lubuk Baja</option>
                        <option>Nongsa</option>
                        <option>Sei Beduk</option>
                        </select>
                    </div>

                    <div>
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan</label>
                        <select id="kelurahan" name="kelurahan"
                        class="mt-1 block w-full rounded-xl bg-gray-100 border border-gray-300 py-3 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none">
                        <option disabled selected>Pilih Kelurahan</option>
                        <option>Tanjung Sengkuang</option>
                        <option>Teluk Tering</option>
                        <option>Kampung Pelita</option>
                        <option>Baloi Indah</option>
                        <option>Muka Kuning</option>
                        <option>Batam Centre</option>
                        </select>
                    </div>
                </div>



                <!-- Alamat -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                   
                    <textarea class="textarea textarea-bordered w-full mb-4 bg-gray-100 border border-gray-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan alamat detail"></textarea>
                </div>
                <div>
                    <label class="label">Pengembalian</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="pengembalian" class="radio" checked />
                            <span>Antar ke toko</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="pengembalian" class="radio" />
                            <span>Jemput di lokasi</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Konfirmasi -->
            <div class="card bg-white p-6 shadow rounded-xl space-y-4">
                <div>
                    <h2 class="font-semibold text-lg">Konfirmasi</h2>
                    <p class="text-sm text-gray-500">Kita sudah sampai di bagian akhir. Hanya dengan beberapa klik dan pesanan Anda akan siap!</p>
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer bg-gray-50 p-3 rounded-lg">
                    <input type="checkbox" class="checkbox" />
                    <span class="label-text ml-3 font-medium">Saya setuju dengan pengiriman email pemasaran dan promo. Tidak ada spam, dijamin!</span>
                    </label>
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer bg-gray-50 p-3 rounded-lg">
                    <input type="checkbox" class="checkbox" />
                    <span class="label-text ml-3 font-medium">Saya setuju dengan syarat dan ketentuan serta kebijakan privasi aplikasi.</span>
                    </label>
                </div>

                <button class="btn btn-success w-full">Buat Pesanan</button>

                <div class="flex items-start space-x-3 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                    <p class="text-sm font-semibold text-gray-800">Semua data anda pasti aman</p>
                    <p class="text-xs text-gray-500">Kami menggunakan sistem keamanan terbaik untuk memberikan Anda pengalaman terbaik.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Ringkasan Penyewaan -->
        <div class="md:col-span-4 space-y-6">
            <div class="card bg-white p-6 shadow rounded-xl">
                <h2 class="font-semibold text-lg mb-2">Ringkasan Penyewaan</h2>
                <p class="text-sm text-gray-500 mb-4">
                Berikut data ringkasan detail dan harga penyewaan berdasarkan produk yang anda pesan
                </p>

                <div class="relative space-x-4 mb-2">
                <img src="images/wuling.png" alt="Mobil" class="rounded-lg" />
                <div>
                    <h3 class=" font-semibold text-xl">Wuling Air EV</h3>
                    <div class="flex items-center space-x-1">
                    <div class="rating rating-xs">
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" aria-label="1 star" />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" aria-label="2 star" checked />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" aria-label="3 star" />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" aria-label="4 star" />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400" aria-label="5 star" />
                    </div>
                    <span class="text-sm text-gray-500 ml-2">440+ Ulasan</span>
                    </div>
                </div>
                </div>

                <div class="divider"></div>

                <div class="text-sm mb-4">
                <div class="text-sm text-gray-500 space-y-2">
                    <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp120.000</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                    <span>Biaya Pengantaran</span>
                    <span>Rp30.000</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                    <span>Diskon</span>
                    <span>-</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl flex items-center p-2">
                    <input id="kodePromo" type="text" placeholder="Masukkan kode promo jika ada"
                        class="bg-transparent flex-1 outline-none text-sm text-gray-500 placeholder:text-gray-400 px-2" />
                    <button type="button" onclick="pakaiKodePromo()"
                        class="font-semibold text-sm px-4 hover:underline active:scale-95 transition">Gunakan</button>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="flex justify-between font-bold text-lg">
                    <span>Total Harga</span>
                    <span>Rp150.000</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Harga keseluruhan termasuk diskon</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
