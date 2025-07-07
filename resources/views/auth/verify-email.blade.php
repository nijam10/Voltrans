<x-guest-layout>
    <x-authentication-card>
        <div class="flex justify-center mx-auto">
            <img class="w-auto h-20" src="{{ asset('images/voltrans-logo.png') }}" alt="">
        </div>

        <p class="font-bold text-2xl text-center text-slate-100 mb-4">
            Verifikasi Email
        </p>

        <div class="mb-4 text-sm text-slate-100">
            {{ __('Sebelum melanjutkan, dapatkah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan yang baru.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda cantumkan di pengaturan profil.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between gap-8">
            <form method="POST" action="{{ route('verification.send') }}" id="verification-form">
                @csrf

                <div>
                    <x-button type="submit" id="send-verification-btn">
                        {{ __('Kirim Email Verifikasi') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-slate-100 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Edit Profil') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-slate-100 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('verification-form');
            const submitBtn = document.getElementById('send-verification-btn');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengirim...';
                form.submit();
            });

            @if (session('status') == 'verification-link-sent')
                // Show success alert
                Swal.fire({
                    title: 'Email Verifikasi Dikirim!',
                    text: 'Tautan verifikasi baru telah dikirim ke alamat email Anda.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });
    </script>

    
</x-guest-layout>
