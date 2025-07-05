<x-guest-layout>
    <x-authentication-card>

        <div class="flex justify-center mx-auto">
            <img class="w-auto h-20" src="{{ asset('images/voltrans-logo.png') }}" alt="">
        </div>

        <p class="font-bold text-2xl text-center text-slate-100 mb-4">
            Lupa Kata Sandi ? 
        </p>

        <div class="mb-4 text-sm text-slate-100">
            {{ __('Tidak masalah. Cukup beritahu kami alamat email Anda, dan kami akan mengirimkan tautan reset kata sandi melalui email yang memungkinkan Anda memilih kata sandi baru.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />


        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" class="text-slate-100" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <p class="text-sm py-3 text-slate-200">
                    Sudah ingat katasandi anda ? 
                    <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:underline">Silahkan Login</a>
                </p>
                <x-button>
                    {{ __('Kirim email verifikasi') }}
                </x-button>
            </div>
        </form>
        
    </x-authentication-card>
</x-guest-layout>
