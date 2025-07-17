<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Perbarui Katasandi') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
    </x-slot>

    <x-slot name="form">
        @php $user = Auth::user(); @endphp
        @if (!empty($user->password))
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Katasandi saat ini') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>
        @endif
        

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Katasandi baru') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Konfirmasi Katasandi') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Katasandi berhasil di perbarui.') }}
        </x-action-message>

        <x-button>
            {{ __('Simpan') }}
        </x-button>
    </x-slot>
</x-form-section>