<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth md:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="apple-mobile-web-app-title" content="Voltrans" />

        <meta name="description" content="Voltrans adalah platform penyewaan kendaraan listrik terpercaya dan ramah lingkungan.">
        <meta name="keywords" content="sewa mobil listrik, kendaraan listrik, ramah lingkungan, voltrans">
        <meta name="author" content="Voltrans App">

        <link rel="icon" type="image/png" href="{{asset('favicon/favicon-96x96.png')}}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{asset('favicon/favicon.svg')}}" />
        <link rel="shortcut icon" href="{{asset('favicon/favicon.ico')}}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}" />    
        <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}" />

        <title>@yield('title', 'Voltrans: Aplikasi Penyewaan Listrik Ramah Lingkungan')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
        
    </head>
    <body class="bg-gradient-to-b to-white">
        <x-banner />

        <div>
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
            <footer>
                @include('components.footer')
            </footer>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')

        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    </body>
</html>
