@props(['title', 'breadcrumbs' => []])
<!-- Banner full lebar dengan posisi lepas dari container -->
<div class="relative w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] h-[180px] bg-cover bg-center" style="background-image: url('{{ asset('images/bg-head.jpg') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>
    
    <!-- Judul -->
    <h1 class="absolute inset-0 mt-10 flex items-center justify-center text-2xl font-bold">
        {{ $title }}
    </h1>


    <!-- Breadcrumb -->
    <div class="absolute bottom-4 left-6 text-white text-sm z-10">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="{{ route('home') }}" class="hover:text-teal-300">
                    <i class="fas fa-home mr-1"></i>
                </a>
            </li>
            @foreach ($breadcrumbs as $breadcrumb)
                <li><span class="mx-1">›</span></li>
                <li>
                    @if ($loop->last)
                        <!-- Halaman aktif -->
                        <span class="text-teal-300 font-semibold">{{ $breadcrumb['label'] }}</span>
                    @else
                        <!-- Link halaman sebelumnya -->
                        <a href="{{ $breadcrumb['url'] }}" class="text-white hover:text-teal-300">
                            {{ $breadcrumb['label'] }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>


    <!-- Title center -->
    <div class="absolute inset-0 flex items-center justify-center z-10 pt-10">
        <h1 class="text-white text-3xl font-bold text-center drop-shadow">{{ $title }}</h1>
    </div>
</div>

</div>

