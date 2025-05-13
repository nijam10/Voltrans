{{-- Sidebar filter section on the left --}}
<aside class="hidden lg:block lg:col-span-1 space-y-4">
    {{-- Sort By dropdown --}}
    <div>
        <label for="SortBy" class="block text-xs font-medium text-gray-700"> Sortir berdasarkan </label>
        <select class="select my-2 font-semibold">
            <option disabled selected>Pilih Sortir</option>
            <option>Terbaru</option>
            <option>Terlama</option>
            <option>Velvet</option>
        </select>
    </div>
    {{-- Filters --}}
    <div>
        <p class="block text-xs font-medium text-gray-700">Terapkan Filter</p>
        <div class="mt-1 space-y-2">
            {{-- Category filter --}}
            <details class="overflow-hidden rounded-xs border border-gray-300 [&_summary::-webkit-details-marker]:hidden">
                <summary
                    class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition"
                >
                    <span class="text-sm font-medium"> Kategori </span>
                    <span class="transition group-open:-rotate-180">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                            />
                        </svg>
                    </span>
                </summary>
                <div class="border-t border-gray-200 bg-white">
                    <header class="flex items-center justify-between p-4">
                        <span class="text-sm text-gray-700"> 0 Dipilih </span>
                        <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                            Reset
                        </button>
                    </header>
                    <ul class="space-y-1 border-t border-gray-200 p-4">
                        <li>
                            <label for="FilterInStock" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="FilterInStock"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <span class="text-sm font-medium text-gray-700"> E-Car (5+) </span>
                            </label>
                        </li>
                        <li>
                            <label for="FilterPreOrder" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="FilterPreOrder"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <span class="text-sm font-medium text-gray-700"> E-Bike (3+) </span>
                            </label>
                        </li>
                        <li>
                            <label for="FilterOutOfStock" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="FilterOutOfStock"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <span class="text-sm font-medium text-gray-700"> E-Scooter (10+) </span>
                            </label>
                        </li>
                    </ul>
                </div>
            </details>

            {{-- Price filter --}}
            <details
                class="overflow-hidden rounded-xs border border-gray-300 [&_summary::-webkit-details-marker]:hidden"
            >
                <summary
                    class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition"
                >
                    <span class="text-sm font-medium"> Harga </span>
                    <span class="transition group-open:-rotate-180">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                            />
                        </svg>
                    </span>
                </summary>
                <div class="border-t border-gray-200 bg-white">
                    <header class="flex items-center justify-between p-4">
                        <span class="text-sm text-gray-700"> The highest price is $600 </span>
                        <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                            Reset
                        </button>
                    </header>
                    <div class="border-t border-gray-200 p-4">
                        <div class="flex justify-between gap-4">
                            <label for="FilterPriceFrom" class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Rp</span>
                                <input
                                    type="number"
                                    id="FilterPriceFrom"
                                    class="w-full rounded-md border-gray-200 shadow-2xs sm:text-sm"
                                />
                            </label>
                            <label for="FilterPriceTo" class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Rp</span>
                                <input
                                    type="number"
                                    id="FilterPriceTo"
                                    class="w-full rounded-md border-gray-200 shadow-2xs sm:text-sm"
                                />
                            </label>
                        </div>
                    </div>
                </div>
            </details>

            {{-- Rating filter --}}
            <details class="overflow-hidden rounded-xs border border-gray-300 [&_summary::-webkit-details-marker]:hidden">
                <summary
                    class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition"
                >
                    <span class="text-sm font-medium"> Rating </span>
                    <span class="transition group-open:-rotate-180">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                            />
                        </svg>
                    </span>
                </summary>
                <div class="border-t border-gray-200 bg-white">
                    <header class="flex items-center justify-between p-4">
                        <span class="text-sm text-gray-700"> 0 Selected </span>
                        <button type="button" class="text-sm text-gray-900 underline underline-offset-4">
                            Reset
                        </button>
                    </header>
                    <ul class="space-y-1 border-t border-gray-200 p-4">
                        <li>
                            <label for="Filter5Star" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="Filter5Star"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <div class="inline-block">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="ml-1">5.0</span>
                                </div>
                            </label>
                        </li>
                        <li>
                            <label for="Filter4Star" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="Filter4Star"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <div class="inline-block">
                                    <span class="text-yellow-400">★★★★</span>
                                    <span class="ml-1">4.0</span>
                                </div>
                            </label>
                        </li>
                        <li>
                            <label for="Filter3Star" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="Filter3Star"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <div class="inline-block">
                                    <span class="text-yellow-400">★★★</span>
                                    <span class="ml-1">3.0</span>
                                </div>
                            </label>
                        </li>
                        <li>
                            <label for="Filter2Star" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="Filter2Star"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <div class="inline-block">
                                    <span class="text-yellow-400">★★</span>
                                    <span class="ml-1">2.0</span>
                                </div>
                            </label>
                        </li>
                        <li>
                            <label for="Filter1Star" class="inline-flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    id="Filter1Star"
                                    class="size-5 rounded-xs border-gray-300 shadow-xs"
                                />
                                <div class="inline-block">
                                    <span class="text-yellow-400">★</span>
                                    <span class="ml-1">1.0</span>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>
            </details>
        </div>
    </div>
</aside>