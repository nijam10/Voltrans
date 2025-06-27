<div id="search-bar" class="relative" x-data="{ open: false }" @click.away="open = false">
    <form class="flex w-full md:w-96 lg:w-[400px]" role="search" wire:submit.prevent="getProduct">
        @csrf
        <input id="search-input" tabindex="0" wire:model.live="search" 
            @focus="open = true" 
            @input="open = true" 
            @keydown.escape="open = false"
            class="block w-full rounded-md border border-gray-300 bg-white py-1.5 px-3 text-sm placeholder-gray-400 focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:outline-none" 
            type="search" placeholder="Cari produk" aria-label="Search" autocomplete="off"/>
        <button type="submit" class="ml-2 px-4 py-1.5 rounded-md bg-green-700 text-white text-sm font-semibold hover:bg-green-800 focus:outline-none">Cari</button>
    </form>

    <div x-show="open" x-transition class="absolute left-0 mt-1 w-full rounded-md bg-white shadow-lg z-10 max-h-80 overflow-auto" style="display: none;">
        @if(sizeof($products) > 0 )
            <ul tabindex="0" class="p-2 space-y-2">
                @foreach ($products as $product)
                <li class="flex items-center gap-3 p-2 border border-gray-200 rounded-md hover:bg-gray-50 transition">
                    <a href="{{ route('product.show', $product->slug) }}" class="flex items-center gap-3 w-full">
                        <div class="w-16 h-16 relative flex-shrink-0 rounded overflow-hidden">
                            <img class="absolute inset-0 w-full h-full object-cover" src="{{ Storage::disk('s3')->url($product->thumbnail) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500">Rp{{ number_format($product->price, 0, ',', '.') }} / hari</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<script>
    document.addEventListener("keydown", (e) => {
        e = e || window.event;
        const searchInput = document.getElementById("search-input");
        if (e.ctrlKey && e.key.toLowerCase() === "k") {
            if (searchInput) {
                searchInput.focus();
                e.preventDefault();
            }
        }
    });
</script>
