<x-guest-layout>
        <section class='bg-linear-to-b from-[#4C956C] to-[#2C6E6D] 0verflow-hidden flex justify-center items-center flex-col min-h-screen w-full'>
        <div class="container flex items-center justify-center min-h-screen px-6 py-12 mx-auto">
            <div class="w-full">
                <div class="flex flex-col items-center max-w-lg mx-auto text-center">
                    <p class="text-3xl font-bold text-white lg:text-6xl">404 error</p>
                    <h1 class="mt-3 text-2xl font-semibold text-white md:text-3xl">Halaman tidak ditemukan</h1>
                    <p class="mt-4 text-gray-100">Maaf halaman tidak ditemukan. Mari kita cari tempat yang lebih baik untuk Anda kunjungi.</p>

                    <div class="flex justify-center items-center w-full mt-6 gap-x-3 shrink-0 sm:w-auto">
                        <a href="{{ route('home') }}">
                            <x-button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg dark:text-gray-200 gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:border-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:rotate-180">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                </svg>
                                <span>Kembali ke Beranda</span>
                            </x-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </section>
</x-guest-layout>