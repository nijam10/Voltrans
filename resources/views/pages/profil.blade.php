@extends('layouts.app')
@section('title', 'Profil')

@section('content')

<div class="mt-20">
<div class="breadcrumbs text-sm">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="#" class="text-blue-500">Kelola Profil</a></li>
  </ul>
</div>

<div class="flex min-h-screen bg-gray-100">
    <x-user-sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-xl font-bold mb-4">Kelola Profil</h1>
        <form action="{{ route('profil') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="label">Username</label>
                    <input type="text" name="username" class="input input-bordered w-full" placeholder="Masukkan username">
                </div>

                <div>
                    <label class="label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="input input-bordered w-full" placeholder="Masukkan nama">
                </div>

                <div>
                    <label class="label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="select select-bordered w-full">
                        <option disabled selected>Pilih jenis kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="label">No. Telepon</label>
                    <input type="text" name="telepon" class="input input-bordered w-full" placeholder="Masukkan nomor telepon">
                </div>

                <div>
                    <label class="label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="input input-bordered w-full">
                </div>

                <div>
                    <label class="label">Alamat</label>
                    <input type="text" name="alamat" class="input input-bordered w-full" placeholder="Masukkan alamat tinggal">
                </div>
            </div>

            <div class="mt-4">
                <label class="label">Foto Profil</label>
                <input type="file" name="foto" class="file-input file-input-bordered w-full max-w-xs" accept=".jpg,.jpeg,.png,.img">
                <small class="text-gray-500 mt-1 block">Ukuran file maksimal 5 MB dengan ekstensi .jpg, .png, .jpeg, .img</small>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-sm btn btn-success mt-6">Simpan</button>
        </form>
    </main>
</div>


</div>
@endsection