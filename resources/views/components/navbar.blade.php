<nav class="navbar bg-white px-6 shadow-sm text-white fixed w-full z-100">
    <div class="flex mr-20">
        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('images/voltrans-green.png') }}" alt="Logo" class="w-12 h-12" />
            <span class="text-lg font-bold text-green-800 -ml-2">Voltrans</span>
        </a>
    </div>

    {{-- Desktop Menu --}}
    <div class="hidden lg:flex flex-1 items-center gap-6">
        <ul class="menu menu-horizontal px-1 text-sm font-medium text-black">
            <li><a>Beranda</a></li>
            <li><a>Tentang</a></li>
            <li><a>Produk</a></li>
            <li><a>Ulasan</a></li>
            <li><a>Hubungi Kami</a></li>
            <li><a>Sewa</a></li>
        </ul>
    </div>

    {{-- Search + Icons --}}
    <div class="flex items-center gap-3 ml-4">
        {{-- Search Bar --}}
        <label class="input input-bordered bg-black rounded-full px-3 flex items-center gap-2">
            <input type="text" class="bg-transparent grow text-sm" placeholder="Cari disini" />
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </label>

        {{-- Notification --}}
        <button class="btn btn-circle hidden lg:flex">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405M19 13v-2a7 7 0 00-14 0v2l-1.405 1.405M5 17h5m-4 0a2 2 0 104 0" />
                </svg>
                <span class="badge badge-xs badge-primary indicator-item"></span>
            </div>
        </button>
        {{-- Avatar --}}
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                <img src="https://i.pravatar.cc/300" alt="User" />
                </div>
            </label>
            <ul tabindex="0"
                class="menu menu-sm dropdown-content mt-3 z-[1] p-2  bg-white text-black rounded-box w-52">
                <li><a>Profile</a></li>
                <li><a>Pengaturan</a></li>
                <li><a>Logout</a></li>
            </ul>
        </div>
        <div class="dropdown lg:hidden">
            <label tabindex="0" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
            <ul tabindex="0"
                class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-neutral text-white rounded-box w-42">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Produk</a></li>
                <li><a href="#">Ulasan</a></li>
                <li><a href="#">Hubungi Kami</a></li>
                <li><a href="#">Sewa</a></li>
            </ul>
        </div>
    </div>
</nav>
