@extends('layouts.app')

@section('title', 'Setting')

@section('content')

<div class="mt-11 p-9">
<div class="breadcrumbs text-sm">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="#" class="text-blue-500">Settings</a></li>
  </ul>
</div>

<div class="flex mx-auto min-h-screen w-full bg-gray-100">
<x-user-sidebar />

<div class="p-8 bg-white rounded-lg shadow p-6">
  <!-- Header -->
  <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">Settings</h2>

  <!-- Subheader -->
  <h3 class="text-lg font-semibold text-gray-700 mb-1">Set Password</h3>
  <p class="text-sm text-gray-500 mb-6">
    please do not share your password with others.
  </p>

  <!-- Form -->
  <form class="align-item-center space-y-5 max-w-xl mx-auto">
    <!-- Password Lama -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Old Password</label>
      <input type="password" placeholder="Input the Old Password" class="input input-bordered w-full bg-gray-100" />
    </div>

    <!-- Password Baru -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
      <input type="password" placeholder="Input the New Password" class="input input-bordered w-full bg-gray-100" />
    </div>

    <!-- Konfirmasi Password Baru -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">New Password Confirmation</label>
      <input type="password" placeholder="Confirm the New Password" class="input input-bordered w-full bg-gray-100" />
    </div>

    <!-- Tombol Simpan -->
    <div class="pt-3 text-center">
      <button type="submit" class="btn bg-green-600 text-white hover:bg-green-700 px-10">
        Save
      </button>
    </div>
  </form>
</div>



</div>
</div>