{{-- Desktop Sidebar --}}
<div class="hidden lg:block w-72 shrink-0">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        {{-- Profile Section --}}
        @php
            $user = auth()->user();
            $photoPath = $user->profile_photo_path ?? null;
            $finalPhotoUrl = null;
            if ($photoPath) {
                $finalPhotoUrl = Str::startsWith($photoPath, ['http://', 'https://'])
                    ? $photoPath
                    : Storage::disk('s3')->url($photoPath);
            }
        @endphp
        <div class="bg-gradient-to-r from-teal-50 to-indigo-50 p-6 border-b border-gray-100">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-lg shadow-lg overflow-hidden">
                        @if($finalPhotoUrl)
                            <img src="{{ $finalPhotoUrl }}" alt="{{ $user->name ?? 'User' }}" class="w-full h-full object-cover rounded-full">
                        @else
                            {{ substr($user->name ?? 'U', 0, 1) }}
                        @endif
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-900 truncate">{{ $user->name ?? 'User' }}</h3>
                    <p class="text-sm text-gray-600 truncate">{{ $user->email ?? 'user@example.com' }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="p-4">
            <div class="space-y-2">
                <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 mb-3">
                    Akun Saya
                </div>
                
                <a href="{{ route('profile.show') }}"
                    @class([
                        'group flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:scale-[1.02]',
                        'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('profile.show'),
                        'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('profile.show')
                    ])>
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('profile.show') ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} mr-3 transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <span class="font-medium">Informasi Profil</span>
                </a>

                <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 mb-3 mt-6">
                    Pesanan
                </div>

                <a href="{{ route('user.orders.index') }}"
                    @class([
                        'group flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:scale-[1.02]',
                        'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('user.orders.*') && !request()->routeIs('user.order-items.*'),
                        'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.orders.*') || request()->routeIs('user.order-items.*')
                    ])>
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ (request()->routeIs('user.orders.*') && !request()->routeIs('user.order-items.*')) ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} mr-3 transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                    </div>
                    <span class="font-medium">Riwayat Pesanan</span>
                </a>

                <a href="{{ route('user.order-items.index') }}"
                    @class([
                        'group flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:scale-[1.02]',
                        'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('user.order-items.*'),
                        'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.order-items.*')
                    ])>
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('user.order-items.*') ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} mr-3 transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <span class="font-medium">Item Pesanan</span>
                </a>

                <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 mb-3 mt-6">
                    Pengaturan
                </div>

                <a href="{{ route('user.addresses.index') }}"
                    @class([
                        'group flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:scale-[1.02]',
                        'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('user.addresses.*'),
                        'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.addresses.*')
                    ])>
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('user.addresses.*') ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} mr-3 transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <span class="font-medium">Alamat</span>
                </a>
            </div>

            {{-- Logout Section --}}
            <div class="pt-6 mt-6 border-t border-gray-100">
                <form id="logout-form-desktop" method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="button" 
                        id="logout-btn-desktop"
                        class="hover:cursor-pointer group w-full flex items-center px-3 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 hover:scale-[1.02]">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 group-hover:bg-red-200 mr-3 transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        </div>
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>
</div>

{{-- Mobile Sidebar (Enhanced) --}}
<div id="hs-sidebar-content-push" class="hs-overlay [--auto-close:lg] lg:hidden lg:translate-x-0 lg:end-auto lg:bottom-0 w-80
    hs-overlay-open:translate-x-0
    -translate-x-full transition-all duration-300 transform
    h-full
    fixed top-0 start-0 bottom-0 z-[65]
    bg-white border-e border-gray-200 shadow-xl" 
    role="dialog" 
    tabindex="-1" 
    aria-label="Sidebar"
    x-data
    x-on:confirming-password.window="$dispatch('hs-overlay:close', { target: '#hs-sidebar-content-push' })"
    x-on:confirming-logout-other-browser-sessions.window="$dispatch('hs-overlay:close', { target: '#hs-sidebar-content-push' })">
    <div class="relative flex flex-col h-full max-h-full">
        <!-- Header -->
        <header class="p-4 flex justify-between items-center gap-x-2 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <x-application-mark/>
                </a>
            </div>

            <div class="lg:hidden">
                <button type="button" class="flex justify-center items-center w-8 h-8 bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500" data-hs-overlay="#hs-sidebar-content-push">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/>
                        <path d="m6 6 12 12"/>
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </header>

        <!-- Profile Section Mobile -->
        <div class="bg-gradient-to-r from-teal-50 to-indigo-50 p-6 border-b border-gray-100">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-semibold text-lg shadow-lg overflow-hidden">
                        @if($finalPhotoUrl)
                            <img src="{{ $finalPhotoUrl }}" alt="{{ $user->name ?? 'User' }}" class="w-full h-full object-cover rounded-full">
                        @else
                            {{ substr($user->name ?? 'U', 0, 1) }}
                        @endif
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-900 truncate">{{ $user->name ?? 'User' }}</h3>
                    <p class="text-sm text-gray-600 truncate">{{ $user->email ?? 'user@example.com' }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Mobile -->
        <nav class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
            <div class="p-4 w-full flex flex-col flex-wrap">
                <div class="space-y-2">
                    <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 mb-3">
                        Akun Saya
                    </div>
                    
                    <a class="group flex items-center gap-x-3 py-3 px-3 text-sm rounded-lg transition-all duration-200"
                        @class([
                            'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('profile.show'),
                            'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('profile.show')
                        ])
                        href="{{ route('profile.show') }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('profile.show') ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <span class="font-medium">Informasi Profil</span>
                    </a>

                    <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 mb-3 mt-6">
                        Pesanan
                    </div>

                    <a class="group flex items-center gap-x-3 py-3 px-3 text-sm rounded-lg transition-all duration-200"
                        @class([
                            'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('user.orders.*') && !request()->routeIs('user.order-items.*'),
                            'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.orders.*') || request()->routeIs('user.order-items.*')
                        ])
                        href="{{ route('user.orders.index') }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ (request()->routeIs('user.orders.*') && !request()->routeIs('user.order-items.*')) ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                        </div>
                        <span class="font-medium">Riwayat Pesanan</span>
                    </a>

                    <a class="group flex items-center gap-x-3 py-3 px-3 text-sm rounded-lg transition-all duration-200"
                        @class([
                            'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('user.order-items.*'),
                            'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.order-items.*')
                        ])
                        href="{{ route('user.order-items.index') }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('user.order-items.*') ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <span class="font-medium">Item Pesanan</span>
                    </a>

                    <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-3 mb-3 mt-6">
                        Pengaturan
                    </div>

                    <a class="group flex items-center gap-x-3 py-3 px-3 text-sm rounded-lg transition-all duration-200"
                        @class([
                            'bg-teal-50 text-teal-700 shadow-sm border border-teal-200' => request()->routeIs('user.addresses.*'),
                            'text-gray-700 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.addresses.*')
                        ])
                        href="{{ route('user.addresses.index') }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('user.addresses.*') ? 'bg-teal-100' : 'bg-gray-100 group-hover:bg-gray-200' }} transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Alamat</span>
                    </a>

                    <div class="pt-6 mt-6 border-t border-gray-100">
                        <form id="logout-form-mobile" method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="button" 
                                id="logout-btn-mobile"
                                class="hover:cursor-pointer group w-full flex items-center gap-x-3 py-3 px-3 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 group-hover:bg-red-200 transition-colors">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                </div>
                                <span class="font-medium">Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- End Sidebar -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Desktop logout
        const logoutBtnDesktop = document.getElementById('logout-btn-desktop');
        const logoutFormDesktop = document.getElementById('logout-form-desktop');
        if (logoutBtnDesktop && logoutFormDesktop) {
            logoutBtnDesktop.addEventListener('click', function (e) {
                Swal.fire({
                    title: 'Konfirmasi Logout?',
                    text: "Apakah Anda yakin ingin keluar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, keluar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutFormDesktop.submit();
                    }
                });
            });
        }
        // Mobile logout
        const logoutBtnMobile = document.getElementById('logout-btn-mobile');
        const logoutFormMobile = document.getElementById('logout-form-mobile');
        if (logoutBtnMobile && logoutFormMobile) {
            logoutBtnMobile.addEventListener('click', function (e) {
                Swal.fire({
                    title: 'Konfirmasi Logout?',
                    text: "Apakah Anda yakin ingin keluar?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, keluar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutFormMobile.submit();
                    }
                });
            });
        }
    });
</script>