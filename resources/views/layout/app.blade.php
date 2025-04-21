<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voltrans</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="bg-base-100 font-poppins">
    <x-navbar />
    <main class="">
        {{ $slot }}
    </main>
    <x-footer />
</body>
</html>