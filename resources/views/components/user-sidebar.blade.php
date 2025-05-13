<div class="w-64 bg-white h-full shadow-sm px-4 py-6 rounded-md">
    {{-- Foto & Nama --}}
    <div class="flex flex-col items-center space-y-2">
        <img src="{{ asset('images/voltrans-logo.png') }}" class="w-16 h-16 rounded-full object-cover" alt="User Photo">
        <p class="font-semibold text-lg">Username</p>
        <a class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded-sm text-sm" href="#">
            Profil Anda
        </a>
    </div>

    {{-- Menu --}}
    <nav class="mt-6 space-y-2">
        <a href="{{ route('profil') }}"
           @class([
               'flex items-center px-4 py-2 rounded-sm transition',
               'text-black font-semibold' => request()->routeIs('profil'),
               'text-gray-400 hover:text-black' => !request()->routeIs('profil')
           ])>
            <i class="fa fa-user mr-2"></i>
            Kelola Profil
        </a>

        <a href="{{ route('notification') }}"
           @class([
               'flex items-center px-4 py-2 rounded-sm transition',
               'text-black font-semibold' => request()->routeIs('notification'),
               'text-gray-400 hover:text-black' => !request()->routeIs('notification')
           ])>
            <i class="fa fa-cog mr-2"></i>
            Notifikasi
        </a>

        <a href="{{ route('history') }}"
           @class([
               'flex items-center px-4 py-2 rounded-sm transition',
               'text-black font-semibold' => request()->routeIs('history'),
               'text-gray-400 hover:text-black' => !request()->routeIs('history')
           ])>
            <i class="fa fa-list mr-2"></i>
            Riwayat Pesanan
        </a>

        <a href="{{ route('setting') }}"
           @class([
               'flex items-center px-4 py-2 rounded-sm transition',
               'text-black font-semibold' => request()->routeIs('setting'),
               'text-gray-400 hover:text-black' => !request()->routeIs('setting')
           ])>
            <i class="fa fa-cog mr-2"></i>
            Pengaturan
        </a>

        <form method="POST" action="{{ route('home') }}">
            @csrf
            <button type="submit"
               @class([
                   'flex items-center px-4 py-2 rounded-sm transition w-full text-left',
                   'text-black font-semibold' => request()->routeIs('home'),
                   'text-gray-400 hover:text-black' => !request()->routeIs('home')
               ])>
                <i class="fa fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </nav>
</div>
