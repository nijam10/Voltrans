<div class="w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 min-h-screen px-5 bg-cover bg-center" style="background-image: url('{{ asset('images/hero.jpg') }}')">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
