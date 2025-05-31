@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section id="home" class="bg-fixed bg-cover bg-center bg-no-repeat relative" style="background-image: url('{{ asset('images/hero.jpg') }}');">
        <div class="absolute inset-0 bg-black/50 z-0"></div>
        <div class="overflow-hidden relative grid w-full px-3 md:px-7 lg:px-15 py-6 lg:py-12 md:py-7 min-h-screen place-items-center z-10">
            <div class="flex w-full"> 
                <!-- Title Section -->
                <x-animations.slide-up>
                    <div class="flex flex-col z-10 w-full max-w-4xl px-5">
                        <h1 class="text-base font-semibold text-white md:text-lg">Hellow, Selamat Datang di Voltrans 👋 
                            <span class="block font-bold text-white text-3xl mt-2 sm:text-base lg:text-6xl md:text-4xl">
                                Berkendara Nyaman, Tanpa Polusi, Demi Masa Depan Kita
                            </span>
                        </h1>
                        <span class="flex items-center py-5">
                            <span class="h-px flex-1 bg-gray-300"></span>
                        </span>
                        <h2 class="font-medium text-slate-200 text-md mb-5 lg:text-xl">Aplikasi Penyewaan Transportasi Listrik Ramah Lingkungan </h2>
                        {{-- Custom Button --}}
                        <div class="relative group">
                            <a href="/#about">
                                <button
                                    class="relative inline-block p-px font-semibold leading-6 text-white bg-gray-800 shadow-2xl cursor-pointer rounded-xl shadow-zinc-900 transition-transform duration-300 ease-in-out hover:scale-105 active:scale-95"
                                >
                                <span
                                    class="absolute inset-0 rounded-xl bg-gradient-to-r from-teal-400 via-blue-500 to-purple-500 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                ></span>
                                    <span class="relative z-10 block px-6 py-3 rounded-xl bg-gray-950">
                                        <div class="relative z-10 flex items-center space-x-2">
                                            <span class="transition-all duration-500 group-hover:translate-x-1"
                                            >Jelajahi</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </div>
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </x-animations.slide-up>
            </div>
        </div>
        <div class="custom-shape-divider-bottom-1747102928">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section> 
    {{-- Tentang Kami --}}
    <section id="about" class="min-h-screen overflow-hidden py-12 lg:py-0 relative isolate">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <svg class="absolute top-0 left-[max(50%,25rem)] h-256 w-512 -translate-x-1/2 mask-[radial-gradient(64rem_64rem_at_top,white,transparent)] stroke-gray-200" aria-hidden="true">
            <defs>
                <pattern id="e813992c-7d03-4cc4-a2bd-151760b470a0" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                <path d="M100 200V.5M.5 .5H200" fill="none" />
                </pattern>
            </defs>
            <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
                <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
            </svg>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#e813992c-7d03-4cc4-a2bd-151760b470a0)" />
            </svg>
        </div>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center min-h-screen">
            <div class="flex flex-wrap w-full"> 
                <!-- Left Section -->
                <div class="w-full lg:w-1/3 md:w-1/2 relative flex-auto mb-12 lg:mb-0 
                    intersect-once intersect:motion-preset-slide-right motion-blur-in-md">
                    <div class="text-center lg:absolute lg:left-0 lg:top-1/2 lg:transform lg:-translate-y-1/2">
                        <img src="{{asset('images/voltrans-logo.png')}}" alt="Gambar" class="w-3/4 sm:w-2/3 lg:w-auto lg:max-h-[80vh] object-contain mx-auto">
                        <span class="block text-4xl sm:text-5xl font-extrabold text-emerald-800 mt-4">VOLTRANS</span>
                        <span class="absolute -bottom-10 -z-10 left-1/2 -translate-x-1/2 scale-75 sm:scale-100 lg:scale-125 lg:bottom-20 xl:scale-150">
                            <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#F2F4F8" d="M60.5,-55.1C75.9,-45,84.3,-22.5,81.8,-2.5C79.2,17.4,65.7,34.8,50.3,51.2C34.8,67.6,17.4,83,-0.6,83.6C-18.5,84.1,-37,69.8,-50.7,53.4C-64.3,37,-73.1,18.5,-68.5,4.6C-64,-9.4,-46,-18.7,-32.4,-28.8C-18.7,-38.9,-9.4,-49.7,6.6,-56.3C22.5,-62.9,45,-65.2,60.5,-55.1Z" transform="translate(100 100)" />
                            </svg>
                        </span>
                    </div>
                </div>
                <!-- Right Section -->
                <div class="w-full self-center md:w-1/2 z-10 flex-auto px-4 sm:px-6 lg:px-10 
                    intersect-once intersect:motion-preset-slide-left motion-blur-in-md">
                    <h1 class="text-lg font-extrabold text-emerald-800 md:text-xl lg:text-2xl">TENTANG KAMI</h1>
                    <span class="block py-3 text-2xl font-semibold text-gray-800 capitalize lg:text-3xl">
                        Temukan berbagai transportasi elektrik yang keren dan nyaman untuk masa depan anda
                    </span>
                    <p class="my-5 text-base sm:text-lg lg:text-xl">Voltrans adalah sebuah platform penyewaan transportasi listrik sebagai upaya untuk mengurangi emisi karbon dengan akses mudah dan harga yang terjangkau demi mempersiapkan masa depan yang lebih sehat</p>
                    <div class="flex flex-col sm:flex-row flex-wrap mt-10 p-4 sm:p-5 py-8 sm:py-10 rounded-l-[40px] sm:rounded-l-[50px] text-white bg-linear-to-r from-[#4C956C] to-[#2C6E6D] shadow-lg text-center overflow-hidden">
                        <div class="stat flex-1 p-2">
                            <div class="stat-value text-4xl sm:text-5xl lg:text-6xl">3 Tahun </div>
                            <div class="stat-title text-2xl sm:text-3xl lg:text-4xl text-white mt-2">Pengalaman</div>
                        </div>
                        <div class="stat flex-1 p-2">
                            <div class="stat-value text-4xl sm:text-5xl lg:text-6xl">300+</div>
                            <div class="stat-title text-2xl sm:text-3xl lg:text-4xl text-white mt-2">Pengguna</div>
                        </div>
                        <div class="stat flex-1 p-2">
                            <div class="stat-value text-4xl sm:text-5xl lg:text-6xl">100+</div>
                            <div class="stat-title text-2xl sm:text-3xl lg:text-4xl text-white mt-2">Produk</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Mengapa Kami Section --}}
    <section class="bg-slate-100 relative">
        <div class="mx-auto px-4 py-8 sm:px-6 lg:px-20 lg:py-20 min-h-screen">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl
                intersect-once intersect:motion-preset-slide-right motion-delay-0">rasakan keamanan <br> dan kenyamanan aplikasi</h1>
            <div class="mt-2 intersect-once intersect:motion-preset-slide-right motion-delay-500">
                <span class="inline-block w-40 h-1 bg-teal-500 rounded-full"></span>
                <span class="inline-block w-3 h-1 ml-1 bg-teal-500 rounded-full"></span>
                <span class="inline-block w-1 h-1 ml-1 bg-teal-500 rounded-full"></span>
            </div>
            <div class="py-8 lg:py-10 lg:flex lg:items-center 
                intersect-once intersect:motion-preset-slide-up motion-delay-200">
                <div class="grid w-full grid-cols-1 gap-8 lg:w-1/2 xl:gap-16 md:grid-cols-2 shadow-lg p-8 bg-white rounded-2xl">
                    <div class="space-y-1 border-b-3 border-gray-300 pb-4">
                        <span class="inline-block text-gray-500 bg-teal-500 rounded-xl">
                            <img src="{{asset('icons/pay.png')}}" alt="Pay Icon" class="w-15 h-15">
                        </span>
                        <h1 class="text-xl font-semibold text-gray-700 capitalize">Pembayaran Mudah</h1>
                        <p class="text-gray-500">
                            Nikmati berbagai metode pembayaran praktis dan aman. Transaksi cepat dengan sekali klik tanpa perlu repot mengisi form berulang kali.
                        </p>
                    </div>
                    <div class="space-y-1 border-b-3 border-gray-300 pb-4">
                        <span class="inline-block text-gray-500 rounded-xl bg-teal-500">
                            <img src="{{asset('icons/eco_choice.png')}}" alt="Eco Choice Icon" class="w-15 h-15">
                        </span>
                        <h1 class="text-xl font-semibold text-gray-700 capitalize">Pilihan Ramah Lingkungan</h1>
                        <p class="text-gray-500">
                            Menawarkan solusi terbaik demi mencegah kerusakan lingkungan dengan berbagai pilihan transportasi bebas emisi.
                        </p>
                    </div>
                    <div class="space-y-1 border-b-3 border-gray-300 pb-4">
                        <span class="inline-block text-gray-500 bg-teal-500 rounded-xl">
                            <img src="{{asset('icons/best_choice.png')}}" alt="Best Choice Icon" class="w-15 h-15">
                        </span>
                        <h1 class="text-xl font-semibold text-gray-700 capitalize">Jaminan Produk Terbaik</h1>
                        <p class="text-gray-500">
                            Setiap kendaraan kami telah melalui inspeksi menyeluruh untuk memastikan perjalanan aman dan nyaman.
                        </p>
                    </div>
                    <div class="space-y-1 border-b-3 border-gray-300 pb-4">
                        <span class="inline-block text-gray-500 bg-teal-500 rounded-xl">
                            <img src="{{asset('icons/support.png')}}" alt="Support Icon" class="w-15 h-15">
                        </span>
                        <h1 class="text-xl font-semibold text-gray-700 capitalize">Layanan Pelanggan 24/7</h1>
                        <p class="text-gray-500">
                            Dukungan virtual berbasis AI ChatBot siap membantu kapanpun Anda butuhkan.
                        </p>
                    </div>
                </div>
                <div class="hidden lg:flex lg:w-1/2 lg:justify-center">
                    <img class="w-[28rem] h-[28rem] flex-shrink-0 object-cover xl:w-[36rem] xl:h-[36rem] rounded-2xl shadow-xl" src="{{ asset('images/why-choose-us.jpg') }}" alt="">
                </div>
            </div>
            <div class="custom-shape-divider-bottom-1747102928">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
    </section>
    {{-- Cara Kerja Section --}}
    <section id="how" class="py-20 bg-linear-to-b from-[#4C956C] to-[#2C6E6D] relative">
        <div class="flex flex-wrap w-full justify-center items-center">
            <div class="w-full px-4 
                intersect-once intersect:motion-preset-slide-up">
                <div class="max-w-2xl mx-auto text-center mb-4">
                    <h1 class="text-lg font-extrabold text-[#F0E5C1] md:text-lg lg:text-2xl">CARA KERJA</h1>
                    <span class="py-3 text-2xl font-semibold text-slate-50 capitalize lg:text-3xl">Dijamin cepat dan mudah
                        untuk melakukan penyewaan</span>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row justify-between items-start gap-6 py-15 mx-4 sm:mx-8 lg:mx-24 text-center">
                <div class="flex flex-col items-center w-full p-4 relative text-white 
                    intersect-once intersect:motion-preset-slide-up motion-delay-0">
                    <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                        <img src="{{asset('icons/cursor.png')}}" alt="cursor.png" class="w-17">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pilih Kendaraan</h3>
                    <p class="text-md text-center">Pilih kendaraan yang ingin
                        anda sewa</p>
                </div>
                <div class="flex flex-col items-center w-full p-4 relative text-white
                    intersect-once intersect:motion-preset-slide-up motion-delay-100">
                    <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                        <img src="{{asset('icons/calendar.png')}}" alt="calendar.png" class="lg:w-17">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pilih Tanggal dan Lokasi Sewa</h3>
                    <p class="text-sm text-center">Pilih tanggal sewa sesuai kebutuhan dan lokasi pengambilan</p>
                </div>
                <div class="flex flex-col items-center w-full p-4 relative text-white
                    intersect-once intersect:motion-preset-slide-up motion-delay-200">
                    <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                        <img src="{{asset('icons/stickynote.png')}}" alt="stickynote.png" class="lg:w-17">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Buat Pesanan</h3>
                    <p class="text-sm text-center">Buat dan lengkapi administarasi pemesanan anda</p>
                </div>
                <div class="flex flex-col items-center w-full p-4 text-white
                    intersect-once intersect:motion-preset-slide-up motion-delay-300">
                    <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                        <img src="{{asset('icons/driving.png')}}" alt="driving.png" class="lg:w-17">
                    </div>
                    <h3 class="text-xl font-bold mb-2">Selamat berkendara</h3>
                    <p class="text-sm text-center">Anda bisa menggunakan kendaraan selama waktu yang ditentukan</p>
                </div>
            </div>
        </div>
        <div class="custom-shape-divider-bottom-1747102928">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>
    {{-- Produk Section --}}
    <section id="product" class="min-h-screen overflow-hidden pattern relative">
        <div class="flex flex-wrap w-full items-center justify-between mx-auto px-4 py-10 sm:px-6 lg:px-20 lg:py-20">
            <div class="px-4 w-full flex flex-col md:flex-row md:items-center md:justify-between gap-2
                intersect-once intersect:motion-preset-slide-right motion-blur-in-md motion-delay-300">
                <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl uppercase">Produk Kami
                    <span class="block py-3 text-2xl font-semibold text-gray-800 capitalize lg:text-3xl md:py-0">
                    Beberapa produk terlaris dari kami
                    </span>
                    <div class="mt-2 intersect-once intersect:motion-preset-slide-right motion-delay-500">
                        <span class="inline-block w-40 h-1 bg-teal-500 rounded-full"></span>
                        <span class="inline-block w-3 h-1 ml-1 bg-teal-500 rounded-full"></span>
                        <span class="inline-block w-1 h-1 ml-1 bg-teal-500 rounded-full"></span>
                    </div>
                </h1>
                <a class="cursor-pointer lg:mt-2 text-lg text-pretty text-green-800 hover:underline">Telusuri semua</a>    
            </div>
            <div class="py-10 justify-center gap-8 w-full flex flex-wrap items-center
                intersect-once intersect:motion-preset-slide-up motion-delay-500">
                @for ($i = 0; $i < 4; $i++)
                <div class="card bg-base-100 shadow-sm hover:shadow-emerald-700 hover:shadow-lg transition-shadow">
                    <figure class="px-4 pt-4">
                        <img src="{{asset('images/wuling.png')}}" alt="Wuling Air EV" class="rounded-xl h-40 w-full object-cover" />
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title">Wuling Air EV</h3>
                        <p class="text-gray-500">E-Car</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-bold">Rp120.000/ hari</span>
                            <div class="flex items-center">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="ml-1">5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div> 
            <!-- Running Brand -->
            <div class="mt-12 overflow-hidden relative">
                <h1 class="py-3 text-2xl font-semibold text-gray-800 capitalize lg:text-3xl text-center">bekerja sama dengan industri ternama</h1>
                <div class="relative animate-marquee py-10">
                    <!-- Brand marquee container -->
                    <div class="flex gap-8 items-center animate-marquee whitespace-nowrap ">
                        {{-- duplicate for continous flow  --}}
                        @for($i = 0; $i < 2; $i++)
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Wuling-logo.svg/2560px-Wuling-logo.svg.png" alt="Wuling" class="h-12 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Hyundai_Motor_Company_logo.svg/1280px-Hyundai_Motor_Company_logo.svg.png" alt="Hyundai" class="h-12 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Tesla_logo.png/1200px-Tesla_logo.png" alt="Tesla" class="h-25 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/BYD_Auto_2022_logo.svg/1200px-BYD_Auto_2022_logo.svg.png" alt="BYD" class="h-12 brand-logo"/>
                            <img src="https://www.gesitsmotors.com/wp-content/uploads/2020/06/Logo-dark-gesits.png" alt="Gesits" class="h-12 brand-logo"/>
                            <img src="https://teladan-resources.com/wp-content/uploads/2022/10/IMG-Alva.png" alt="Alva" class="h-25 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Polytron.svg/2560px-Polytron.svg.png" alt="Polytron" class="h-12 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Chery_logo.svg/1200px-Chery_logo.svg.png" alt="Chery" class="h-12 brand-logo"/>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        {{-- Product Type Section --}}
        <div>
            <div class="mx-auto px-4 py-8 sm:px-6 lg:px-20">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl text-right
                    intersect-once intersect:motion-preset-slide-left motion-delay-100">pilih kategori produk <br> sesuai kebutuhan anda</h1>
                <div class="mt-2 text-right intersect-once intersect:motion-preset-slide-left motion-delay-500">
                    <span class="inline-block w-1 h-1 ml-1 bg-teal-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 ml-1 bg-teal-500 rounded-full"></span>
                    <span class="inline-block w-40 h-1 bg-teal-500 rounded-full"></span>
                </div>
                <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
                    <div class="overflow-hidden bg-cover rounded-lg cursor-pointer h-96 group 
                    intersect-once intersect:motion-preset-slide-up motion-delay-200"
                        style="background-image:url('https://images.unsplash.com/photo-1707758283240-814ee7fbb33a?q=80&w=2066&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                        <div
                            class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-100 md:opacity-0 backdrop-blur-sm bg-gray-800/60 group-hover:opacity-100">
                            <h2 class="mt-4 text-xl font-semibold text-white capitalize">Electric Car</h2>
                            <a href="#">
                                <p class="mt-2 text-lg tracking-wider text-green-400 uppercase hover:underline">Jelajahi</p>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-cover rounded-lg cursor-pointer h-96 group
                        intersect-once intersect:motion-preset-slide-up motion-delay-300"
                        style="background-image:url('https://s.yimg.com/ny/api/res/1.2/Gc90Znzau.d_3cOVUtAD6g--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD04NTc-/https://o.aolcdn.com/hss/storage/midas/8289038fd76920312ee586de32ee8c12/204650248/1-bmw-motorrad-vision-next-100.jpg')">
                        <div
                            class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-100 md:opacity-0 backdrop-blur-sm bg-gray-800/60 group-hover:opacity-100">
                            <h2 class="mt-4 text-xl font-semibold text-white capitalize">Electric Motorcycle</h2>
                            <a href="#">
                                <p class="mt-2 text-lg tracking-wider text-green-400 uppercase hover:underline">Jelajahi</p>
                            </a>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-cover rounded-lg cursor-pointer h-96 group
                        intersect-once intersect:motion-preset-slide-up motion-delay-400"
                        style="background-image:url('https://images.unsplash.com/photo-1698947815772-97886c96c6a6?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                        <div
                            class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-100 md:opacity-0 backdrop-blur-sm bg-gray-800/60 group-hover:opacity-100">
                            <h2 class="mt-4 text-xl font-semibold text-white capitalize">Electric Scooter</h2>
                            <a href="#">
                                <p class="mt-2 text-lg tracking-wider text-green-400 uppercase hover:underline">Jelajahi</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Review Section -->
    @php
        $reviews = [
            [
                'name' => 'Ema Watson',
                'role' => 'Marketing Manager at Stech',
                'image' => 'https://images.unsplash.com/photo-1488508872907-592763824245?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
                'review' => '“Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quibusdam ducimus libero ad tempora doloribus expedita laborum saepe voluptas perferendis delectus assumenda”.',
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Pengusaha',
                'image' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80',
                'review' => '“Pelayanan sangat ramah dan kendaraan selalu dalam kondisi prima. Sangat puas dengan Voltrans!”',
            ],
            [
                'name' => 'Siti Aminah',
                'role' => 'Mahasiswa',
                'image' => 'https://images.unsplash.com/photo-1499470932971-a90681ce8530?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
                'review' => '“Aplikasi mudah digunakan, harga terjangkau, dan sangat membantu mobilitas saya sehari-hari.”',
            ],
        ];
    @endphp
    <section 
        x-data="{
            reviews: @js($reviews),
            active: 0,
            get current() { return this.reviews[this.active]; },
            prev() { this.active = (this.active === 0) ? this.reviews.length - 1 : this.active - 1 },
            next() { this.active = (this.active === this.reviews.length - 1) ? 0 : this.active + 1 }
        }"
        class="bg-slate-100 relative isolate overflow-hidden py-10"
    >
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,var(--color-teal-100),white)] opacity-20"></div>
        <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl ring-1 shadow-teal-600/10 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>
        <div class="max-w-6xl px-6 py-10 mx-auto">
            <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl uppercase text-center">Testimoni</h1>
            <p class="mt-2 text-2xl font-semibold text-gray-800 capitalize lg:text-3xl text-center">
                Apa kata mereka ? 
            </p>
            <main class="relative z-20 w-full mt-8 md:flex md:items-center xl:mt-12
                intersect-once intersect:motion-scale-in-[0.5] motion-translate-x-in-[1%] motion-translate-y-in-[2%] motion-rotate-in-[-10deg] motion-blur-in-[10px] motion-duration-[1.5s]/translate motion-delay-[1.5s]/rotate motion-delay-[1.5s]/blur">
                <div class="absolute w-full bg-linear-to-b from-[#4C956C] to-[#2C6E6D] -z-10 md:h-96 rounded-2xl"></div>
                <div class="w-full p-6 bg-teal-800 md:flex md:items-center rounded-2xl md:bg-transparent md:p-0 lg:px-12 md:justify-evenly">
                    <div class="flex justify-center md:block flex-shrink-0">
                        <img 
                            :src="current.image" 
                            :alt="current.name" 
                            class="h-24 w-24 md:mx-6 rounded-full object-cover shadow-md md:h-[32rem] md:w-80 lg:h-[36rem] lg:w-[26rem] md:rounded-2xl transition-all duration-500 ease-in-out"
                            x-transition:enter="transition ease-out duration-500"
                        />
                    </div>
                    <div class="mt-2 md:mx-6 flex-1">
                        <div>
                            <p class="text-xl font-medium tracking-tight text-white" x-text="current.name"></p>
                            <p class="text-blue-200" x-text="current.role"></p>
                        </div>
                        <p class="mt-4 text-lg leading-relaxed text-white md:text-xl min-h-[80px]" x-text="current.review"
                            x-transition:enter="transition-opacity duration-500"
                        ></p>
                        <div class="flex items-center justify-between mt-6 md:justify-start">
                            <button 
                                @click="prev"
                                title="left arrow" 
                                class="cursor-pointer p-2 text-white transition-colors duration-300 border rounded-full rtl:-scale-x-100 hover:bg-slate-400"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button 
                                @click="next"
                                title="right arrow" 
                                class="cursor-pointer p-2 text-white transition-colors duration-300 border rounded-full rtl:-scale-x-100 md:mx-6 hover:bg-slate-400"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex gap-2 mt-6 justify-center md:justify-start">
                            <template x-for="(item, idx) in reviews" :key="idx">
                                <span 
                                    class="w-3 h-3 rounded-full transition-all duration-300"
                                    :class="active === idx ? 'bg-white' : 'bg-white/40'"
                                ></span>
                            </template>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>
    {{-- Call to access section --}}
    <section class="bg-teal-800">
        <x-animations.modal>
        <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="relative isolate overflow-hidden bg-slate-100 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                <svg viewBox="0 0 1024 1024" class="absolute top-1/2 left-1/2 -z-10 size-256 -translate-y-1/2 mask-[radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0" aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
                    <defs>
                    <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                        <stop stop-color="#4C956C" />
                        <stop offset="1" stop-color="#2C6E6D" />
                    </radialGradient>
                    </defs>
                </svg>
                <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                    <h2 class="text-3xl font-semibold tracking-tight text-balance text-gray-800 sm:text-4xl">
                        Masih Ragu Bergabung Bersama Voltrans?
                    </h2>
                    <p class="mt-6 text-lg/8 text-pretty text-gray-600">
                        Kenali lebih dekat visi kami dalam menghadirkan transportasi listrik ramah lingkungan untuk masa depan yang lebih baik. Temukan alasan mengapa Voltrans adalah pilihan tepat untuk kebutuhan mobilitas Anda.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                        <a href="/about" class="text-sm/6 font-semibold text-emerald-800 hover:underline">
                            Kenali kami lebih lanjut <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
                <div class="relative mt-16 h-80 lg:mt-8">
                    <img class="absolute top-0 left-0 w-228 max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="App screenshot" width="1824" height="1080">
                </div>
            </div>
        </div>
        </x-animations.modal>
    </section>
@endsection
