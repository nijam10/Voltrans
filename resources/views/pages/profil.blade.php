@extends('layouts.app')
@section('title', 'Profil')

@section('content')

<div class="mt-20">
<div class="breadcrumbs text-sm">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="#" class="text-blue-500">Manage Profile</a></li>
  </ul>
</div>

<div class="flex min-h-screen bg-gray-100">
    <x-user-sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-xl font-bold mb-4">Manage Profile</h1>
        <form action="{{ route('profil') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="label">Username</label>
                    <input type="text" name="username" class="input input-bordered w-full" placeholder="Input username">
                </div>

                <div>
                    <label class="label">Full Name</label>
                    <input type="text" name="full_name" class="input input-bordered w-full" placeholder="Input full name">
                </div>

                <div>
                    <label class="label">Gender</label>
                    <select name="gender" class="select select-bordered w-full">
                        <option disabled selected>Choose Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div>
                    <label class="label">No. Telepon</label>
                    <input type="text" name="telepon" class="input input-bordered w-full" placeholder="Input telepon number">
                </div>

                <div>
                    <label class="label">Birth Date</label>
                    <input type="date" name="birth_date" class="input input-bordered w-full">
                </div>

                <div>
                    <label class="label">Address</label>
                    <input type="text" name="address" class="input input-bordered w-full" placeholder="Input address">
                </div>
            </div>

            <div class="mt-4">
                <label class="label">Profile Photo</label>
                <input type="file" name="photo_profile" class="file-input file-input-bordered w-full max-w-xs" accept=".jpg,.jpeg,.png,.img">
                <small class="text-gray-500 mt-1 block">Maximum file size is 5 MB with .jpg, .png, .jpeg, .img</small>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-sm btn btn-success mt-6">Save</button>
        </form>
    </main>
</div>


</div>
@endsection