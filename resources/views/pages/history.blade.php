@extends('layouts.app')

@section('title', 'History')

@section('content')

<div class="mt-20 px-4">
  <!-- Breadcrumb -->
  <div class="breadcrumbs text-sm mb-4">
    <ul>
      <li><a href="/">Home</a></li>
      <li class="text-blue-500">Riwayat Pesanan</li>
    </ul>
  </div>

  <div class="flex gap-6">
    <!-- Sidebar -->
    <x-user-sidebar />

    <!-- Main Content -->
    <div class="flex-1 bg-white rounded-md shadow-md p-6">
    <h2 class="text-xl font-semibold mb-4">Riwayat Pesanan</h2>
    <div class="flex-1">
      <!-- Tabs -->
      <div class="tabs mb-4">
        <a class="tab tab-bordered">Semua</a>
        <a class="tab tab-bordered">Belum dikonfirmasi</a>
        <a class="tab tab-bordered">Sedang Berlangsung</a>
        <a class="tab tab-bordered">Selesai</a>
      </div>

      <!-- List Card Riwayat -->
      @for ($i = 0; $i < 3; $i++)
        <div class="card bg-base-100 shadow-xs mb-4">
          <div class="card-body flex-row justify-between items-center">
            <div class="flex items-center gap-4">
              <img src="/images/wuling.png" alt="Mobil" class="w-28 h-20 object-cover rounded-sm" />
              <div>
                <h2 class="text-lg font-semibold">Wuling Air EV</h2>
                <p class="text-sm text-blue-500">E-Car</p>
                <div class="text-yellow-500 text-sm">
                  ★★★★★ <span class="text-black ml-1">5.0</span>
                </div>
              </div>
            </div>
            <div class="text-right">
              <p class="text-lg font-bold">Rp120.000</p>
              <button class="btn btn-success btn-sm mt-2">Detail</button>
            </div>
          </div>
        </div>
      @endfor

      <!-- Pagination -->
      <div class="flex justify-between items-center mt-4">
        <div>
          <label class="text-sm">Per page</label>
          <select class="select select-bordered select-sm ml-2 w-20">
            <option>5</option>
            <option>10</option>
          </select>
        </div>
        <div class="join">
          <button class="btn btn-sm join-item">Previous</button>
          <button class="btn btn-sm join-item">Next</button>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
