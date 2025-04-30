<div class="card bg-base-100 shadow hover:shadow-emerald-700 hover:shadow-lg  transition-shadow">
    <figure class="px-4 pt-4">
        <img src="{{ $imgsrc }}" alt="Wuling Air EV" class="rounded-xl h-40 w-full object-cover" />
    </figure>
    <div class="card-body">
        <h3 class="card-title">{{ $title }}</h3>
        <p class="text-gray-500">{{ $type }}</p>
        <div class="flex justify-between items-center mt-4">
            <span class="font-bold">Rp{{ $price }}/ hari</span>
            <div class="flex items-center">
                <span class="text-yellow-400">★★★★★</span>
                <span class="ml-1">{{ $rating }}</span>
            </div>
        </div>
        <div class="card-actions mt-4">
            <button
            class="w-full inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 px-5 py-3 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white"
            >
            Sewa
            </button>
        </div>
    </div>
</div>