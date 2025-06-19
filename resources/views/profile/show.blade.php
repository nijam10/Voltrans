@extends('layouts/app')
@section('title', 'Profile')
@section('content')

<div class="min-h-screen pt-20">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex gap-8">
            {{-- Sidebar --}}
            <x-user-sidebar />
            {{-- Main Content --}}
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm">
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
@endsection
