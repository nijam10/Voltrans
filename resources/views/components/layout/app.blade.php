<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voltrans</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="bg-base-100 text-base-content">
    <x-navbar />
    <main class="p-10">
        {{ $slot }}
    </main>
    <x-footer />
</body>
</html>