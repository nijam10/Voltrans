@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="bg-linear-to-b from-[#4C956C] to-[#2C6E6D] min-h-screen overflow-hidden flex items-center justify-center pt-20">
    <div class="card w-full max-w-md shadow-xl bg-base-100 p-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Log in untuk melanjutkan</h2>
        <form action="{{ route('login') }}" method="POST" class="space-y-4 mt-3">
            @csrf
            <div class="form-control">
                <label class="label block" for="email">
                    <span class="label-text">Alamat Email</span>
                </label>
                <input type="email" id="email" name="email" placeholder="info@example.com" required class="input validator w-full" />
                <div class="validator-hint">
                    Masukkan alamat email yang valid
                </div>
            </div>
            <div class="form-control">
                <label class="label block" for="password">
                    <span class="label-text">Katasandi</span>
                </label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required class="input validator w-full" />
            </div>
            <button
            class="w-full mt-3 inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 p-2 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white"
            >
            Login
            </button>
        </form>
        <div class="divider">atau</div>
        <a href="" class="btn btn-outline btn-warning w-full mb-4 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 48 48" fill="none">
                <path fill="#4285F4" d="M24 9.5c3.54 0 6.7 1.22 9.17 3.22l6.85-6.85C34.7 2.7 29.7 0 24 0 14.8 0 6.9 5.4 3.3 13.3l7.95 6.2C12.9 13.1 18.9 9.5 24 9.5z"/>
                <path fill="#34A853" d="M46.5 24c0-1.6-.15-3.1-.43-4.6H24v9h12.7c-.55 3-2.2 5.5-4.7 7.2l7.2 5.6c4.2-3.9 6.6-9.6 6.6-16.2z"/>
                <path fill="#FBBC05" d="M10.3 28.1c-.5-1.5-.8-3.1-.8-4.7s.3-3.2.8-4.7L2.3 12.5C.8 15.3 0 18.5 0 22c0 3.5.8 6.7 2.3 9.5l8-3.4z"/>
                <path fill="#EA4335" d="M24 48c6.5 0 12-2.1 16-5.7l-7.7-6c-2.3 1.5-5.2 2.4-8.3 2.4-5.1 0-9.4-3.4-10.9-8.1l-8 3.4C6.9 42.6 14.9 48 24 48z"/>
                <path fill="none" d="M0 0h48v48H0z"/>
            </svg>
            Lanjutkan dengan Google
        </a>
        <p class="text-center text-sm">
            Belum memiliki akun ? 
            <a href="{{ route('register') }}" class="text-green-900 font-semibold hover:underline">Daftar disini</a>
        </p>
    </div>
</div>
@endsection
