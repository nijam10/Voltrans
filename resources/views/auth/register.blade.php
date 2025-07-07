<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="flex justify-center mx-auto">
            <img class="w-auto h-20" src="{{ asset('images/voltrans-logo.png') }}" alt="Logo">
        </div>

        <p class="font-bold text-2xl text-center text-slate-100">
            Selamat Datang
        </p>
        <p class="text-sm text-center text-slate-100">
            Silahkan registrasi untuk membuat akun
        </p>

        <form id="register-form">
            @csrf

            <div class="mt-4">
                <x-label for="name" value="{{ __('Nama Lengkap') }}" class="text-slate-100" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Alamat Email') }}" class="text-slate-100" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-slate-100" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" class="text-slate-100" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms" class="text-slate-100">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-slate-200 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-slate-200 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-slate-200 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah terdaftar?') }}
                </a>
                <x-button id="register-btn" class="ms-4 flex items-center">
                    <span id="register-btn-text">{{ __('Registrasi') }}</span>
                    <svg id="register-spinner" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

{{-- JS AJAX --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registerForm = document.getElementById('register-form');
        const registerBtn = document.getElementById('register-btn');
        const registerBtnText = document.getElementById('register-btn-text');
        const registerSpinner = document.getElementById('register-spinner');

        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            registerBtn.disabled = true;
            registerBtnText.textContent = 'Memproses...';
            registerSpinner.classList.remove('hidden');

            const formData = new FormData(registerForm);

            try {
                const response = await fetch("{{ route('register') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrasi Berhasil',
                        text: 'Anda akan diarahkan ke beranda.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    const data = await response.json();
                    let errorMessage = data.message || 'Terjadi kesalahan saat registrasi';

                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('\n');
                    }

                    Swal.fire('Gagal Registrasi', errorMessage, 'error');
                    registerBtn.disabled = false;
                    registerBtnText.textContent = 'Registrasi';
                    registerSpinner.classList.add('hidden');
                }
            } catch (err) {
                console.error(err);
                Swal.fire('Kesalahan Sistem', 'Terjadi error tidak terduga', 'error');
                registerBtn.disabled = false;
                registerBtnText.textContent = 'Registrasi';
                registerSpinner.classList.add('hidden');
            }
        });
    });
</script>
