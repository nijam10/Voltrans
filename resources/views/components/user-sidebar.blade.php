{{-- Desktop Sidebar --}}
<div class="hidden lg:block w-64 shrink-0">
    <div class="bg-white rounded-lg shadow-sm p-4">
        <nav class="space-y-1">
            <a href="{{ route('profile.show') }}"
                @class([
                    'flex items-center px-4 py-2 rounded-md transition',
                    'bg-gray-100 text-gray-900 font-medium' => request()->routeIs('profile.show'),
                    'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('profile.show')
                ])>
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Informasi Profil
            </a>

            <a href="{{ route('user.orders.index') }}"
                @class([
                    'flex items-center px-4 py-2 rounded-md transition',
                    'bg-gray-100 text-gray-900 font-medium' => request()->routeIs('user.orders.*'),
                    'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.orders.*')
                ])>
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                Riwayat Pesanan
            </a>

            <a href="{{ route('user.addresses.index') }}"
                @class([
                    'flex items-center px-4 py-2 rounded-md transition',
                    'bg-gray-100 text-gray-900 font-medium' => request()->routeIs('user.addresses.*'),
                    'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !request()->routeIs('user.addresses.*')
                ])>
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                Alamat
            </a>

            <hr class="border-gray-200 my-2">

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" 
                    class="w-full flex items-center px-4 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md transition">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Keluar
                </button>
            </form>
        </nav>
    </div>
</div>

    {{-- Mobile Sidebar (Preline UI) --}}
    <div id="hs-sidebar-content-push" class="hs-overlay [--auto-close:lg] lg:hidden lg:translate-x-0 lg:end-auto lg:bottom-0 w-64
        hs-overlay-open:translate-x-0
        -translate-x-full transition-all duration-300 transform
        h-full
        fixed top-0 start-0 bottom-0 z-[65]
        bg-white border-e border-gray-200" 
        role="dialog" 
        tabindex="-1" 
        aria-label="Sidebar"
        x-data
        x-on:confirming-password.window="$dispatch('hs-overlay:close', { target: '#hs-sidebar-content-push' })"
        x-on:confirming-logout-other-browser-sessions.window="$dispatch('hs-overlay:close', { target: '#hs-sidebar-content-push' })">
        <div class="relative flex flex-col h-full max-h-full">
            <!-- Header -->
            <header class="p-4 flex justify-between items-center gap-x-2 border-b border-gray-200">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-mark/>
                    </a>
                </div>

                <div class="lg:hidden -me-2">
                    <!-- Close Button -->
                    <button type="button" class="flex justify-center items-center gap-x-3 size-6 bg-white border border-gray-200 text-sm text-gray-600 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100" data-hs-overlay="#hs-sidebar-content-push">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"/>
                            <path d="m6 6 12 12"/>
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                    <!-- End Close Button -->
                </div>
            </header>
            <!-- End Header -->

            <!-- Body -->
            <nav class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
                <div class="pb-0 px-2 w-full flex flex-col flex-wrap">
                    <ul class="space-y-1 pt-4">
                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg transition"
                                @class([
                                    'bg-gray-100 text-gray-800 font-medium' => request()->routeIs('profile.show'),
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-800' => !request()->routeIs('profile.show')
                                ])
                                href="{{ route('profile.show') }}">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                Informasi Profil
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg transition"
                                @class([
                                    'bg-gray-100 text-gray-800 font-medium' => request()->routeIs('user.orders.*'),
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-800' => !request()->routeIs('user.orders.*')
                                ])
                                href="{{ route('user.orders.index') }}">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>
                                Riwayat Pesanan
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg transition"
                                @class([
                                    'bg-gray-100 text-gray-800 font-medium' => request()->routeIs('user.addresses.*'),
                                    'text-gray-600 hover:bg-gray-100 hover:text-gray-800' => !request()->routeIs('user.addresses.*')
                                ])
                                href="{{ route('user.addresses.index') }}">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                Alamat
                            </a>
                        </li>

                        <li class="pt-4">
                            <hr class="border-gray-200">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" 
                                    class="w-full flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg transition">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Body -->
        </div>
    </div>
    <!-- End Sidebar -->