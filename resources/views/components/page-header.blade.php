@props(['title', 'breadcrumbs' => []])
<!-- Banner full lebar dengan posisi lepas dari container -->
<div class="relative w-screen h-100 bg-cover bg-center" style="background-image: url('{{ asset('images/hero.jpg') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-xs z-10"></div>
    <!-- Title center -->
    <div class="absolute inset-0 flex items-center justify-center z-10 pt-10">
        <h1 class="text-white text-3xl font-bold text-center drop-shadow-sm">{{ $title }}</h1>
    </div>
</div>

</div>

