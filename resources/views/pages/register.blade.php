@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="bg-linear-to-b from-[#4C956C] to-[#2C6E6D] min-h-screen overflow-hidden flex items-center justify-center pt-20">
    <div class="card w-full max-w-md shadow-xl bg-base-100 p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Buat Akun Baru</h2>
        <form action="" method="POST" class="space-y-4">
            @csrf
            <div class="form-control">
                <label class="label block" for="name">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required class="input input-bordered w-full" />
            </div>
            <div class="form-control">
                <label class="label block" for="email">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" id="email" name="email" placeholder="user@example.com" required class="input input-bordered w-full" />
            </div>
            <div class="form-control">
                <label class="label block" for="password">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" id="password" name="password" placeholder="Masukkan katasandi" required class="input input-bordered w-full" />
            </div>
            <div class="form-control">
                <label class="label block" for="password_confirmation">
                    <span class="label-text">Konfirmasi Katasandi</span>
                </label>
                <input type="password" id="password_confirmation" name="confirm_password" placeholder="Konfirmasi katasandi" required class="input input-bordered w-full" />
            </div>
            <button
                class="w-full mt-3 inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 p-2 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white"
                >
                Daftar
            </button>
        </form>
        <p class="text-center text-sm mt-4">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="text-green-900 font-semibold hover:underline">Login disini</a>
        </p>
    </div>
</div>
@endsection
