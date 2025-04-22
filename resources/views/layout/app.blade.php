<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title> @yield('title', 'Voltrans') </title>
    
</head>
<body class="bg-base-100 font-poppins">
    <header>
        @include('components.navbar')
    </header>
    <main class="@container mx-auto">
        @yield('content')
    </main>
    <footer>    
        @include('components.footer')
    </footer>
</body>
</html>