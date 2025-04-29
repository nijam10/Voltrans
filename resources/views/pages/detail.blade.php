@extends('layout.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="flex gap-6 px-16 py-10 bg-gray-50 pt-24">

    <!-- Sidebar -->
    <aside class="w-64 bg-white rounded shadow-xl p-6">
        <div class="flex flex-col items-center">
            <img src="https://via.placeholder.com/80" alt="Profile" class="rounded-full mb-4">
            <h2 class="font-semibold text-lg mb-2">User Name</h2>
            <button class="btn btn-wide bg-green-700 text-white px-4 py-2 rounded w-full">Profil Anda</button>
        </div>
        <nav class="mt-10 space-y-4">
            <a href="#" class="flex items-center font-semibold hover:text-green-700">Kelola Profil</a>
            <a href="#" class="flex items-center font-semibold hover:text-green-700">Riwayat Pesanan</a>
            <a href="#" class="flex items-center font-semibold hover:text-green-700">Pengaturan</a>
            <a href="#" class="flex items-center font-semibold hover:text-green-700">Keluar</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-white p-6 rounded border border-blue-500">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 flex items-center mb-4">
            <span>Profil</span>
            <span class="mx-2">></span>
            <span class="text-green-600">Riwayat Pesanan</span>
        </div>

        <h1 class="text-2xl font-bold mb-4">Riwayat Pesanan</h1>

        <!-- Tabs -->
        <div class="navbar bg-gray-100 shadow-sm flex border-b text-sm font-medium text-gray-600 mb-6">
          <button class="px-6 py-3 hover:text-green-600 hover:border-b-2 hover:border-green-600 transition cursor-pointer">Semua</button>
          <button class="px-6 py-3 hover:text-green-600 hover:border-b-2 hover:border-green-600 transition cursor-pointer">Belum dikonfirmasi</button>
          <button class="px-6 py-3 hover:text-green-600 hover:border-b-2 hover:border-green-600 transition cursor-pointer">Sedang Berlangsung</button>
          <button class="px-6 py-3 hover:text-green-600 hover:border-b-2 hover:border-green-600 transition cursor-pointer">Selesai</button>
        </div>



       <!-- List Pesanan -->
<div class="space-y-4">
  <!-- Card -->
  <div class="flex items-center justify-between border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
    <div class="flex items-center gap-4">
      <img src="https://via.placeholder.com/100x60" alt="Mobil" class="rounded w-28 h-20 object-cover">
      <div>
        <h2 class="font-semibold text-lg">Wuling Air EV</h2>
        <span class="text-blue-600 text-sm">Mobil</span>
        <div class="flex items-center mt-1">
        <div class="rating">
            <input type="radio" name="rating-1" class="mask mask-star-2 bg-yellow-400" aria-label="1 star" />
            <input type="radio" name="rating-1" class="mask mask-star-2 bg-yellow-400" aria-label="2 star" checked="checked" />
            <input type="radio" name="rating-1" class="mask mask-star-2 bg-yellow-400" aria-label="3 star" />
            <input type="radio" name="rating-1" class="mask mask-star-2 bg-yellow-400" aria-label="4 star" />
            <input type="radio" name="rating-1" class="mask mask-star-2 bg-yellow-400" aria-label="5 star" />
          </div>
          <span class="text-gray-600 text-sm">5.0</span>
        </div>
      </div>
    </div>
    <div class="text-right">
      <div class="text-lg font-bold mb-2">Rp120.000</div>
      <button class="btn btn-neutral bg-green-700 text-white px-5 py-1 rounded text-sm">lihat</button>
    </div>
  </div>

  <!-- card 2 -->
  <div class="flex items-center justify-between border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
    <div class="flex items-center gap-4">
      <img src="https://via.placeholder.com/100x60" alt="Mobil" class="rounded w-28 h-20 object-cover">
      <div>
        <h2 class="font-semibold text-lg">Wuling Air EV</h2>
        <span class="text-blue-600 text-sm">Mobil</span>
        <div class="flex items-center mt-1">
          <div class="rating">
            <input type="radio" name="rating-2" class="mask mask-star-2 bg-yellow-400" aria-label="1 star" />
            <input type="radio" name="rating-2" class="mask mask-star-2 bg-yellow-400" aria-label="2 star" checked="checked" />
            <input type="radio" name="rating-2" class="mask mask-star-2 bg-yellow-400" aria-label="3 star" />
            <input type="radio" name="rating-2" class="mask mask-star-2 bg-yellow-400" aria-label="4 star" />
            <input type="radio" name="rating-2" class="mask mask-star-2 bg-yellow-400" aria-label="5 star" />
          </div>
          <span class="text-gray-600 text-sm"> 5.0</span>
        </div>
      </div>
    </div>
    <div class="text-right">
      <div class="text-lg font-bold mb-2">Rp120.000</div>
      <button class="btn btn-neutral bg-green-700 text-white px-5 py-1 rounded text-sm">lihat</button>
    </div>
  </div>
 <!-- card 3 -->
  <div class="flex items-center justify-between border border-gray-200 rounded-lg p-4 shadow-sm mb-4">
    <div class="flex items-center gap-4">
      <img src="https://via.placeholder.com/100x60" alt="Mobil" class="rounded w-28 h-20 object-cover">
      <div>
        <h2 class="font-semibold text-lg">Wuling Air EV</h2>
        <span class="text-blue-600 text-sm">Mobil</span>
        <div class="flex items-center mt-1">
        <div class="rating">
            <input type="radio" name="rating-3" class="mask mask-star-2 bg-yellow-400" aria-label="1 star" />
            <input type="radio" name="rating-3" class="mask mask-star-2 bg-yellow-400" aria-label="2 star" checked="checked" />
            <input type="radio" name="rating-3" class="mask mask-star-2 bg-yellow-400" aria-label="3 star" />
            <input type="radio" name="rating-3" class="mask mask-star-2 bg-yellow-400" aria-label="4 star" />
            <input type="radio" name="rating-3" class="mask mask-star-2 bg-yellow-400" aria-label="5 star" />
          </div>
          <span class="text-gray-600 text-sm">5.0</span>
        </div>
      </div>
    </div>
    <div class="text-right">
      <div class="text-lg font-bold mb-2">Rp120.000</div>
      <button class="btn btn-neutral bg-green-700 text-white px-5 py-1 rounded text-sm">lihat</button>
    </div>
  </div>



        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6 text-sm">
            <div class="flex items-center gap-2">
                <label>Per page</label>
                <select class="border rounded px-2 py-1">
                    <option>5</option>
                    <option>10</option>
                </select>
            </div>
            <button class="border px-4 py-2 rounded hover:bg-gray-100">Next</button>
        </div>
    </main>
</div>
@endsection
