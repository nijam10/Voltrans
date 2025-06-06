{{-- components/card.blade.php --}}
<a href="{{ route('product.show', $slug) }}" class="group relative block cursor-pointer [perspective:1000px]">
    <div class="relative transition-transform duration-500 transform-gpu group-hover:rotate-x-2 group-hover:rotate-y-2 group-hover:scale-[1.03]">
        {{-- Gradient border container --}}
        <div class="rounded-xl p-[2px] bg-gradient-to-br from-black via-purple-500 to-indigo-500 shadow-lg">
            {{-- Inner card --}}
            <div class="rounded-xl bg-white p-4">

                <img src="{{ $imgsrc }}" alt="{{ $title }}"
                    class="rounded-lg h-44 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-42" />

                <div class="pt-3">
                    <div class="flex justify-between items-center mb-2 flex-wrap">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                        <div class="inline-block text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($rating))
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="ml-1 text-gray-700">{{ $rating }}</span>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-1">{{ $type }}</p>
                    <p class="text-gray-700 font-semibold">
                        Rp{{ number_format($price, 0, ',', '.') }} / hari
                    </p>
                    <div class="mt-4">
                        <button type="button"
                                class="block w-full rounded bg-emerald-600 hover:bg-emerald-700 px-4 py-3 text-sm font-medium text-white transition hover:scale-105"
                                onclick="event.preventDefault(); window.location.href='{{ route('product.show', $slug) }}'">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>