<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'public/css/input.css' , 'resources/js/app.js'])

    <title> @yield('title', 'Voltrans') </title>
</head>
<body class="bg-base-100 font-poppins">
    <div class="min-h-srcreen pb-20">
    <header class="fixed top-0 left-0 w-full bg-white z-50 shadow">
        @include('components.navbar')
    </header>
    
    <main class="container mx-auto">
        @yield('content')
    </main>
    </div>
    <footer>    
        @include('components.footer')
    </footer>
    
</body>
</html>