<div class="group relative bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg hover:scale-[1.02] duration-300 w-full max-w-sm mx-auto sm:max-w-none">
    <a href="{{ route('product.show', $slug) }}" class="block">
        <div class="relative overflow-hidden">
            <img 
            src="{{ $imgsrc }}" 
            alt="{{ $title }}" 
            class="w-full h-36 sm:h-44 md:h-48 object-cover bg-gray-100 group-hover:opacity-90 transition duration-300" 
            />
            <!-- Rating badge overlay for mobile -->
            <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 flex items-center gap-1 sm:hidden">
                <div class="text-yellow-400 text-xs">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($rating))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <span class="text-xs text-gray-600">{{ $rating }}</span>
            </div>
        </div>
        </a>
        
        <div class="p-3 sm:p-4">
        <!-- Header section -->
        <div class="flex justify-between items-start gap-2 mb-2">
            <div class="flex-1 min-w-0">
            <h3 class="text-sm sm:text-base font-semibold text-gray-900 leading-tight">
                <a href="{{ route('product.show', $slug) }}" class="hover:underline line-clamp-2">
                {{ $title }}
                </a>
            </h3>
            <p class="text-xs sm:text-sm text-gray-500 mt-1 truncate">{{ $type }}</p>
            </div>
            
            <!-- Desktop rating -->
            <div class="hidden lg:flex items-center flex-shrink-0">
                <div class="text-yellow-400 text-sm">
                    @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($rating))
                        ★
                    @else
                        ☆
                    @endif
                    @endfor
                </div>
                <span class="text-xs text-gray-600 ml-1">{{ $rating }}</span>
                </div>
            </div>
        
        <!-- Price section -->
        <div class="flex items-center justify-between mb-3 sm:mb-4">
            <div class="flex items-baseline gap-1">
                <p class="text-base sm:text-lg font-bold text-gray-900">
                    Rp{{ number_format($price, 0, ',', '.') }}
                </p>
                <span class="text-xs text-gray-500">/ hari</span>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div>
            <a 
            href="{{ route('product.show', $slug) }}" 
            class="inline-block w-full text-center rounded-lg bg-emerald-600 px-3 py-2 sm:px-4 sm:py-2.5 text-sm font-medium text-white hover:bg-emerald-700 active:bg-emerald-800 transition-colors duration-200 touch-manipulation"
            >
            Lihat Detail
            </a>
        </div>
    </div>
</div>