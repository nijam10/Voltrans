@props([
    'title' => 'Judul',
    'breadcrumbs' => [], // array: ['label' => ..., 'url' => ..., 'isCurrent' => true/false]
])

<div class="bg-[url(/public/images/bg-head.jpg)] mt-[15px] w-screen -mx-9 relative bg-cover bg-left h-42 text-white">
    
    <!-- Judul -->
    <h1 class="absolute inset-0 mt-10 flex items-center justify-center text-2xl font-bold">
        {{ $title }}
    </h1>

    <!-- Breadcrumb -->
    <div class="absolute bottom-2 left-6 text-sm flex items-center gap-1">
        <svg class="w-4 h-4 inline" fill="none" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        @foreach ($breadcrumbs as $item)
            <span>&gt;</span>
            @if (!empty($item['isCurrent']))
                <span class="text-teal-400 font-semibold">{{ $item['label'] }}</span>
            @else
                <a href="{{ $item['url'] }}" class="text-white hover:underline">{{ $item['label'] }}</a>
            @endif
        @endforeach
    </div>
</div>