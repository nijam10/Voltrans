@php
    $isHome = request()->routeIs('home') || request()->is('/');
@endphp
<nav id="navbar" x-data="{ open: false }" class="fixed w-full transition-all duration-300 z-50 {{ $isHome ? 'bg-transparent' : 'bg-white shadow-md' }}">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-20">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <x-application-mark/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link href="about" :active="request()->routeIs('about')">
                        {{ __('Tentang') }}
                    </x-nav-link>
                    <x-nav-link href="/#product" :active="request()->routeIs('/#product')">
                        {{ __('Produk') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('rent') }}" :active="request()->routeIs('rent')">
                        {{ __('Sewa') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <!-- Search Bar - Only visible on desktop -->
                <div class="mr-4">
                    @livewire('search-bar')
                </div>
                
                @auth
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 ring-2 ring-green-500 rounded-full focus:outline-hidden focus:border-gray-300 transition">
                                        <img class="size-10 rounded-full object-cover" src="{{ optional(Auth::user())->profile_photo_url ?? '' }}" alt="{{ optional(Auth::user())->name ?? 'User' }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-hidden focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ optional(Auth::user())->name ?? 'User' }}

                                            <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Kelola Akun') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}">
                        <x-secondary-button id="button-home" class="cursor-pointer hover:bg-teal-500 hover:text-white">LOGIN</x-secondary-button>
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button id="hamburger" @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-transition :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
        <!-- Search Bar - Moved to mobile menu -->
        <div class="px-4 py-3 border-b border-gray-200">
            @livewire('search-bar')
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                {{ __('Tentang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/#product" :active="request()->routeIs('/#product')">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('rent') }}" :active="request()->routeIs('rent')">
                {{ __('Sewa') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ optional(Auth::user())->name ?? 'Guest' }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ optional(Auth::user())->email ?? '' }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="py-3 px-4">
                    <a href="{{ route('login') }}" class="block w-full">
                        <x-button class="w-full justify-center">LOGIN</x-button>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
<script>
    // Navbar color change on scroll only on homepage
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.pathname === '/' || window.location.pathname === '/about') {
            const navbar = document.getElementById('navbar');
            const logoImage = document.getElementById('logo-image');
            const logoText = document.getElementById('logo-text');
            const navLinks = document.querySelectorAll('.hidden.space-x-8.sm\\:-my-px.sm\\:ms-10.sm\\:flex a');
            const buttonHome = document.getElementById('button-home');
            const hamburger = document.getElementById('hamburger');

            let lastScrollTop = 0;
            let ticking = false;

            function handleScroll() {
                const scrollTop = window.scrollY;

                // Show/hide navbar on scroll direction
                if (scrollTop > lastScrollTop && scrollTop > 200) {
                    // Scrolling down - hide navbar
                    if (navbar) {
                        navbar.style.transform = 'translateY(-100%)';
                        navbar.style.transition = 'transform 0.7s ease-in-out';
                    }
                } else {
                    // Scrolling up - show navbar
                    if (navbar) {
                        navbar.style.transform = 'translateY(0)';
                        navbar.style.transition = 'transform 0.7s ease-in-out';
                    }
                }

                // Existing color change logic
                if (scrollTop > 150) {
                    // Scrolled state
                    if (navbar) {
                        navbar.classList.remove('bg-transparent');
                        navbar.classList.add('bg-white', 'shadow-md');
                    }
                    
                    // changes logo image
                    if (logoImage) {
                        logoImage.src = 'images/voltrans-logo.png';
                        logoImage.alt = 'Logo Dark';
                    }

                    // Change text colors to dark
                    if (logoText) {
                        logoText.classList.remove('text-white');
                        logoText.classList.add('text-green-900');
                    }
                    
                    // Change nav link colors to gray-500
                    navLinks.forEach(item => {
                        item.classList.remove('text-white', 'border-gray-500');
                        item.classList.add('text-gray-500','border-green-900');
                    });

                    if (hamburger) {
                        hamburger.classList.remove('text-white')
                        hamburger.classList.add('text-gray-500')
                    }

                    if (buttonHome) {
                        buttonHome.classList.remove('bg-white')
                        buttonHome.classList.add('bg-teal-700', 'text-white')
                    }
                    
                } else {
                    // Top state (transparent)
                    if (navbar) {
                        navbar.classList.add("bg-transparent");
                        navbar.classList.remove("bg-white", "shadow-md");
                    }

                    // Change text colors to light
                    if (logoText) {
                        logoText.classList.add("text-white");
                        logoText.classList.remove("text-green-900");
                    }

                    // default logo image
                    if (logoImage) {
                        logoImage.src = "images/voltrans-white.png";
                        logoImage.alt = "Logo White";
                    }

                    // Change nav link colors to white
                    navLinks.forEach((item) => {
                        item.classList.add("text-white", "border-gray-200");
                        item.classList.remove("text-gray-500", "border-green-900");
                    });

                    
                    if (hamburger) {
                        hamburger.classList.add('text-white')
                        hamburger.classList.remove('text-gray-500')
                    }

                    if (buttonHome) {
                        buttonHome.classList.remove('bg-teal-700', 'text-white')
                        buttonHome.classList.add('bg-white')
                    }
                }

                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
                ticking = false;
            }

            // Throttle scroll event for performance
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(handleScroll);
                    ticking = true;
                }
            });

            // Run on page load
            handleScroll();
        }
    });
</script>
