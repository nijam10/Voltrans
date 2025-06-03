@props(['title', 'breadcrumbs' => []])
<!-- Banner full lebar dengan posisi lepas dari container -->
<div class="relative w-screen h-100 bg-cover bg-center" style="background-image: url('{{ asset('images/hero.jpg') }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- Judul -->
    <h1 class="absolute inset-0 mt-10 flex items-center justify-center text-2xl font-bold">
        {{ $title }}
    </h1>

    <!-- Breadcrumb -->
    <div class="absolute mx-auto max-w-(--breakpoint-xl) px-4 bottom-4 lg:left-20 text-white text-sm z-10">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="{{ route('home') }}" class="hover:text-teal-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
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
        <h1 class="text-white text-3xl font-bold text-center drop-shadow-sm">{{ $title }}</h1>
    </div>
</div>

</div>

