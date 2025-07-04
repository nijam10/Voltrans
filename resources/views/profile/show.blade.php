@extends('layouts/app')
@section('title', 'Profile')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 lg:py-16 py-8">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-">
        <div class="flex gap-8">
            {{-- Sidebar --}}
            <x-user-sidebar />
            {{-- Main Content --}}
            <div class="flex-1">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl overflow-hidden">
                    <div class="p-6">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            <div class="mt-6">
                                @livewire('profile.update-profile-information-form')
                            </div>
                            <x-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                            <div class="mt-6">
                                @livewire('profile.update-password-form')
                            </div>
                            <x-section-border />
                        @endif

                        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                            <div class="mt-6">
                                @livewire('profile.two-factor-authentication-form')
                            </div>
                            <x-section-border />
                        @endif

                        <div class="mt-6">
                            @livewire('profile.logout-other-browser-sessions-form')
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                            <x-section-border />
                            <div class="mt-6">
                                @livewire('profile.delete-user-form')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('saved', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Profil berhasil diperbarui.',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endpush

@endsection
