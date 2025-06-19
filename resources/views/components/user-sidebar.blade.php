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
        </nav>
    </div>
</div>
