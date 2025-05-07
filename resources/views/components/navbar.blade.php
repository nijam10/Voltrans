<nav id="navbar" class="fixed top-0 left-0 w-full py-2 px-6 md:px-10 lg:px-20 transition-all duration-300 bg-transparent z-50">
    <div class="flex items-center justify-center mx-auto">
        <!-- Logo Section -->
        <div class="flex items-center">
            <a href="/" class="flex items-center gap-2">
                <img id="logo-image" src="/images/voltrans-white.png" alt="Logo" class="w-12 h-12" />
                <span id="logo-text" class="text-2xl font-bold text-white transition-colors duration-300">Voltrans</span>
            </a>
        </div>
        
        <!-- Menu Section - Desktop -->
        <div class="hidden lg:flex items-center flex-1 lg:px-10">
            <ul class="flex space-x-8">
                <li><a href="#" class="menu-item text-white hover:text-green-300 font-medium transition-colors duration-300">Beranda</a></li>
                <li><a href="#about" class="menu-item text-white hover:text-green-300 font-medium transition-colors duration-300">Tentang</a></li>
                <li><a href="#product" class="menu-item text-white hover:text-green-300 font-medium transition-colors duration-300">Produk</a></li>
                <li><a href="#review" class="menu-item text-white hover:text-green-300 font-medium transition-colors duration-300">Ulasan</a></li>
                <li><a href="#how" class="menu-item text-white hover:text-green-300 font-medium transition-colors duration-300">Hubungi Kami</a></li>
                <li><a href="rent" class="menu-item text-white hover:text-green-300 font-medium transition-colors duration-300">Sewa</a></li>
            </ul>
        </div>
        
        <!-- Right Section - Search, Notifications, User -->
        <div class="flex items-center gap-4">
            <!-- Search Bar -->
            <label class="input input-bordered bg-white rounded-xl px-3 flex items-center gap-2 hidden lg:flex">
                <input type="text" class="bg-transparent grow text-sm" placeholder="Cari disini" />
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </label>
            
            
            <!-- Notification - Desktop Only -->
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
            
            <!-- User Avatar -->
            <div class="dropdown dropdown-end">
                <button class="flex items-center justify-center overflow-hidden w-10 h-10 rounded-full ring-2 ring-green-500 bg-white bg-opacity-20 hover:bg-opacity-30 transition-all duration-300">
                    <img src="https://i.pravatar.cc/300" alt="User" class="w-full h-full object-cover" />
                </button>
                <ul class="menu menu-sm dropdown-content mt-3 p-2 shadow-lg bg-white text-gray-800 rounded-lg w-52">
                    <li><a class="hover:bg-gray-100">Profile</a></li>
                    <li><a class="hover:bg-gray-100">Pengaturan</a></li>
                    <li><a class="hover:bg-gray-100">Logout</a></li>
                </ul>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden btn btn-success btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <!-- Mobile Menu -->
            <div class="dropdown dropdown-end lg:hidden">
                <ul class="menu menu-sm dropdown-content mt-3 p-2 shadow-lg bg-white text-gray-800 rounded-lg w-52">
                    <li><a class="hover:bg-gray-100">Beranda</a></li>
                    <li><a class="hover:bg-gray-100">Tentang</a></li>
                    <li><a class="hover:bg-gray-100">Produk</a></li>
                    <li><a class="hover:bg-gray-100">Ulasan</a></li>
                    <li><a class="hover:bg-gray-100">Hubungi Kami</a></li>
                    <li><a class="hover:bg-gray-100">Sewa</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>