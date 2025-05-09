<a href="#" class="group relative block overflow-hidden">
    <button
        class="absolute end-4 top-4 z-10 rounded-full bg-white p-1.5 text-gray-900 transition hover:text-gray-900/75">
    </button>
    <img src="{{ $imgsrc }}" alt="" class="rounded-sm h-44 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-42"/>
    <div class="relative border border-gray-100 bg-white p-6">
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <h3 class="mt-1.5 text-lg font-medium text-gray-900">{{ $title }}</h3>
            <div class="inline-block">
                <span class="text-yellow-400">★★★★★</span>
                <span class="ml-1">{{ $rating }}</span>
            </div>
        </div>        
        <p class="text-gray-700">
            Rp{{ $price }} / hari
        </p>
        <form class="mt-4 flex gap-4">
            <button type="button" 
                class="block w-full rounded-sm bg-green-900 px-4 py-3 text-sm font-medium text-white transition hover:scale-105">
                Pesan
            </button>
        </form>
    </div>
</a>