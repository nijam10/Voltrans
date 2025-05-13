<div id="search-bar" class="relative" x-data="{ open: false }" @click.away="open = false">
    <form class="flex" role="search" @submit.prevent>
        @csrf
        <input id="search-input" tabindex="0" wire:model.live="search" 
            @focus="open = true" 
            @input="open = true" 
            @keydown.escape="open = false"
            class="block w-full rounded-md border border-gray-300 bg-white py-1.5 px-3 text-sm placeholder-gray-400 focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:outline-none" 
            type="search" placeholder="Search" aria-label="Search" autocomplete="off"/>
    </form>
    <div x-show="open" x-transition class="absolute left-0 mt-1 w-full rounded-md bg-white shadow-lg z-10" style="display: none;">
        @if(sizeof($products) > 0 )
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                @foreach ($products as $product)
                    <li>
                        <a class="text-gray-900 text-sm font-medium">{{ $product->name }}</a>
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