@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <style>
        html {
            scroll-behavior: smooth;
        }
        .custom-shape-divider-bottom-1747102928 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1747102928 svg {
            position: relative;
            display: block;
            width: calc(154% + 1.3px);
            height: 84px;
        }

        .custom-shape-divider-bottom-1747102928 .shape-fill {
            fill: #FFFFFF;
        }
    </style>
    {{-- Hero Section --}}
        <section id="home" class="bg-fixed bg-cover bg-center bg-no-repeat relative" style="background-image: url('{{ asset('images/hero.jpg') }}');">
            <div class="absolute inset-0 bg-black/50 z-0"></div>
            <div class="overflow-hidden relative grid w-full lg:px-15 md:px-7 px-3 py-6 lg:py-12 md:py-7 min-h-screen place-items-center z-10">
                <div class="flex w-full"> 
                    <!-- Title Section -->
                    <div class="flex flex-col px-5 z-10 w-full max-w-4xl">
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
        <section id="about" class="min-h-screen overflow-hidden py-12 lg:py-0">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section -->
                    <div class="w-full lg:w-1/3 md:w-1/2 relative flex-auto mb-12 lg:mb-0">
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
                    <div class="w-full self-center px-4 sm:px-6 lg:px-10 md:w-1/2 z-10 flex-auto">
                        <h1 class="text-lg font-extrabold text-emerald-800 md:text-xl lg:text-2xl">TENTANG KAMI</h1>
                        <span class="block py-3 font-bold text-gray-700 text-xl sm:text-2xl md:text-3xl lg:text-4xl leading-5 md:leading-none mt-2 capitalize">
                            Temukan berbagai transportasi elektrik yang keren dan nyaman untuk masa depan anda
                        </span>
                        <p class="my-5 text-base sm:text-lg lg:text-xl">Voltrans adalah sebuah platform penyewaan transportasi listrik sebagai upaya untuk mengurangi emisi karbon dengan akses mudah dan harga yang terjangkau demi mempersiapkan masa depan yang lebih sehat</p>
                        <div class="flex flex-col sm:flex-row mt-10 p-4 sm:p-5 py-8 sm:py-10 rounded-l-[40px] sm:rounded-l-[80px] text-white bg-linear-to-r from-[#4C956C] to-[#2C6E6D] shadow-lg text-center overflow-hidden">
                            <div class="stat flex-1 p-2">
                                <div class="stat-value text-4xl sm:text-5xl lg:text-6xl">3+</div>
                                <div class="stat-title text-2xl sm:text-3xl lg:text-4xl text-white mt-2">Pengalaman</div>
                            </div>
                            <div class="stat flex-1 p-2">
                                <div class="stat-value text-4xl sm:text-5xl lg:text-6xl">300+</div>
                                <div class="stat-title text-2xl sm:text-3xl lg:text-4xl text-white mt-2">Customer</div>
                            </div>
                            <div class="stat flex-1 p-2">
                                <div class="stat-value text-4xl sm:text-5xl lg:text-6xl">100+</div>
                                <div class="stat-title text-2xl sm:text-3xl lg:text-4xl text-white mt-2">Kendaraan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Mengapa Kami Section --}}
        <section class="bg-white">
            <div class="mx-auto px-4 py-8 sm:px-6 lg:px-20 lg:py-20 min-h-screen">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl">rasakan keamanan <br> dan kenyamanan aplikasi</h1>
                <div class="mt-2">
                    <span class="inline-block w-40 h-1 bg-teal-500 rounded-full"></span>
                    <span class="inline-block w-3 h-1 ml-1 bg-teal-500 rounded-full"></span>
                    <span class="inline-block w-1 h-1 ml-1 bg-teal-500 rounded-full"></span>
                </div>
                <div class="py-8 lg:py-10 lg:flex lg:items-center">
                    <div class="grid w-full grid-cols-1 gap-8 lg:w-1/2 xl:gap-16 md:grid-cols-2 shadow-lg p-8">
                        <div class="space-y-1">
                            <span class="inline-block text-gray-500 bg-teal-500 rounded-xl">
                                <img src="{{asset('icons/pay.png')}}" alt="Pay Icon" class="w-15 h-15">
                            </span>
                            <h1 class="text-xl font-semibold text-gray-700 capitalize">Pembayaran Mudah</h1>
                            <p class="text-gray-500">
                                Nikmati berbagai metode pembayaran praktis dan aman. Transaksi cepat dengan sekali klik tanpa perlu repot mengisi form berulang kali.
                            </p>
                        </div>
                        <div class="space-y-1">
                            <span class="inline-block text-gray-500 bg-blue-100 rounded-xl bg-teal-500">
                                <img src="{{asset('icons/eco_choice.png')}}" alt="Eco Choice Icon" class="w-15 h-15">
                            </span>
                            <h1 class="text-xl font-semibold text-gray-700 capitalize">Pilihan Ramah Lingkungan</h1>
                            <p class="text-gray-500">
                                Menawarkan solusi terbaik demi mencegah kerusakan lingkungan dengan berbagai pilihan transportasi bebas emisi.
                            </p>
                        </div>
                        <div class="space-y-1">
                            <span class="inline-block text-gray-500 bg-teal-500 rounded-xl">
                                <img src="{{asset('icons/best_choice.png')}}" alt="Best Choice Icon" class="w-15 h-15">
                            </span>
                            <h1 class="text-xl font-semibold text-gray-700 capitalize">Jaminan Produk Terbaik</h1>
                            <p class="text-gray-500">
                                Setiap kendaraan kami telah melalui inspeksi menyeluruh untuk memastikan perjalanan aman dan nyaman.
                            </p>
                        </div>
                        <div class="space-y-1">
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
                        <img class="w-[28rem] h-[28rem] flex-shrink-0 object-cover xl:w-[34rem] xl:h-[34rem] rounded-2xl shadow-xl" src="{{ asset('images/why-choose-us.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        {{-- <section id="why" class="min-h-screen overflow-hidden py-12 lg:py-0">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section - Image (Order changes on mobile) -->
                    <div class="w-full lg:w-1/2 md:w-1/2 flex-auto flex justify-center items-center lg:order-1 mt-8 lg:mt-0">
                        <img src="{{asset('images/charging-car.jpg')}}" alt="Gambar" class="w-full h-auto max-h-[70vh] rounded-[20px] sm:rounded-r-[80px] object-cover shadow-lg">
                    </div>
                    <!-- Right Section - Content -->
                    <div class="w-full self-center px-4 sm:px-6 lg:px-10 md:w-1/2 z-10 flex-auto order-1 lg:order-2">
                        <h1 class="text-lg font-extrabold text-emerald-800 md:text-xl lg:text-2xl">MENGAPA VOLTRANS ?</h1>
                        <span class="block py-3 font-bold text-black text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl leading-tight mt-2">
                            Menawarkan sensasi terbaik dalam setiap penyewaan
                        </span>
                        <div class="shadow-lg border-2 border-[#4C956C] bg-white p-4 sm:p-5 mt-5 rounded-[20px] sm:rounded-l-[50px] text-[#2C6E6D]">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="p-2 hover:bg-[#f0f8f5] rounded-lg transition-all duration-300 flex flex-col items-center sm:items-start">
                                    <img src="{{asset('icons/pay.png')}}" alt="Pay Icon" width="70" class="mb-2">
                                    <h2 class="text-xl font-bold text-center md:text-left">Pembayaran Mudah</h2>
                                    <p class="text-md text-center">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="p-2 hover:bg-[#f0f8f5] rounded-lg transition-all duration-300 flex flex-col items-center sm:items-start">
                                    <img src="{{asset('icons/eco_choice.png')}}" alt="Eco Choice Icon" width="70" class="mb-2">
                                    <h2 class="text-xl font-bold text-center">Pilihan Ramah Lingkungan</h2>
                                    <p class="text-md text-center sm:text-left">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="p-2 hover:bg-[#f0f8f5] rounded-lg transition-all duration-300 flex flex-col items-center sm:items-start">
                                    <img src="{{asset('icons/best_choice.png')}}" alt="Best Choice Icon" width="70" class="mb-2">
                                    <h2 class="text-xl font-bold">Jaminan Produk Terbaik</h2>
                                    <p class="text-md text-center sm:text-left">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="p-2 hover:bg-[#f0f8f5] rounded-lg transition-all duration-300 flex flex-col items-center sm:items-start">
                                    <img src="{{asset('icons/support.png')}}" alt="Customer Support Icon" width="70" class="mb-2">
                                    <h2 class="text-xl font-bold">Layanan Pelanggan 24/7</h2>
                                    <p class="text-md text-center sm:text-left">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        {{-- Cara Kerja Section --}}
        <section id="how" class="py-20 bg-linear-to-b from-[#4C956C] to-[#2C6E6D]">
            <div class="flex flex-wrap w-full justify-center items-center">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-[#F0E5C1] md:text-lg lg:text-2xl">CARA KERJA</h1>
                        <span class="py-3 font-bold text-white text-2xl mt-2 lg:text-5xl/[6vh] md:text-3xl">Dijamin cepat dan mudah
                            untuk melakukan penyewaan</span>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row justify-between items-start gap-6 py-15 mx-4 sm:mx-8 lg:mx-24 text-center">
                    <div class="flex flex-col items-center w-full p-4 relative text-white">
                        <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                            <img src="{{asset('icons/cursor.png')}}" alt="cursor.png" class="w-17">
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Pilih Kendaraan</h3>
                        <p class="text-md text-center">Pilih kendaraan yang ingin
                            anda sewa</p>
                    </div>
                    <div class="flex flex-col items-center w-full p-4 relative text-white">
                        <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                            <img src="{{asset('icons/calendar.png')}}" alt="calendar.png" class="lg:w-17">
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Pilih Tanggal dan Lokasi Sewa</h3>
                        <p class="text-sm text-center">Pilih tanggal sewa sesuai kebutuhan dan lokasi pengambilan</p>
                    </div>
                    <div class="flex flex-col items-center w-full p-4 relative text-white">
                        <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                            <img src="{{asset('icons/stickynote.png')}}" alt="stickynote.png" class="lg:w-17">
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Buat Pesanan</h3>
                        <p class="text-sm text-center">Buat dan lengkapi administarasi pemesanan anda</p>
                    </div>
                    <div class="flex flex-col items-center w-full p-4 text-white">
                        <div class="bg-[#17E3B2] p-4 rounded-lg mb-3">
                            <img src="{{asset('icons/driving.png')}}" alt="driving.png" class="lg:w-17">
                        </div>
                        <h3 class="text-xl font-bold mb-2">Selamat berkendara</h3>
                        <p class="text-sm text-center">Anda bisa menggunakan kendaraan selama waktu yang ditentukan</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- Produk Section --}}
        <section id="product" class="py-15 min-h-screen overflow-hidden">
            <div class="flex flex-wrap w-full justify-center items-center">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl">PRODUK KAMI</h1>
                        <span class="py-3 font-bold text-black text-2xl mt-2 sm:text-base lg:text-4xl md:text-3xl">Nikmati berbagai pilihan kendaraan kualitas terbaik</span>
                    </div>
                </div>
                <div class="py-10 justify-center gap-8 w-full flex flex-wrap items-center">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="card bg-base-100 shadow-sm hover:shadow-emerald-700 hover:shadow-lg  transition-shadow">
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
                            <div class="card-actions mt-4">
                                <button
                                class="w-full inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 px-5 py-3 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white"
                                >
                                Sewa
                                </button>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div> 
                <div class="w-full flex justify-center">
                    <button
                    class="inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 px-5 py-3 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white"
                    >
                    Lihat Semua
                    </button>
                </div>
            <!-- Running Brand -->
                <div class="mt-12 overflow-hidden">
                    <div class="relative animate-marquee">
                        <!-- Brand marquee container -->
                        <div class="flex gap-8 items-center animate-marquee whitespace-nowrap ">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Wuling-logo.svg/2560px-Wuling-logo.svg.png" alt="Wuling" class="h-8 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Hyundai_Motor_Company_logo.svg/1280px-Hyundai_Motor_Company_logo.svg.png" alt="Hyundai" class="h-8 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Tesla_logo.png/1200px-Tesla_logo.png" alt="Tesla" class="h-20 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/BYD_Auto_2022_logo.svg/1200px-BYD_Auto_2022_logo.svg.png" alt="BYD" class="h-8 brand-logo"/>
                            <img src="https://www.gesitsmotors.com/wp-content/uploads/2020/06/Logo-dark-gesits.png" alt="Gesits" class="h-8 brand-logo"/>
                            <img src="https://teladan-resources.com/wp-content/uploads/2022/10/IMG-Alva.png" alt="Alva" class="h-20 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Polytron.svg/2560px-Polytron.svg.png" alt="Polytron" class="h-8 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Chery_logo.svg/1200px-Chery_logo.svg.png" alt="Chery" class="h-8 brand-logo"/>
                            <!-- Duplicate for continuous flow -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Wuling-logo.svg/2560px-Wuling-logo.svg.png" alt="Wuling" class="h-8 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Hyundai_Motor_Company_logo.svg/1280px-Hyundai_Motor_Company_logo.svg.png" alt="Hyundai" class="h-8 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Tesla_logo.png/1200px-Tesla_logo.png" alt="Tesla" class="h-20 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/BYD_Auto_2022_logo.svg/1200px-BYD_Auto_2022_logo.svg.png" alt="BYD" class="h-8 brand-logo"/>
                            <img src="https://www.gesitsmotors.com/wp-content/uploads/2020/06/Logo-dark-gesits.png" alt="Gesits" class="h-8 brand-logo"/>
                            <img src="https://teladan-resources.com/wp-content/uploads/2022/10/IMG-Alva.png" alt="Alva" class="h-20 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Polytron.svg/2560px-Polytron.svg.png" alt="Polytron" class="h-8 brand-logo"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Chery_logo.svg/1200px-Chery_logo.svg.png" alt="Chery" class="h-8 brand-logo"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Review Section -->
        <section id="review" class="bg-gray-50 py-12 px-4 md:px-8 lg:px-16">
            <div class="container mx-auto">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl">ULASAN</h1>
                        <span class="py-3 font-bold text-2xl mt-2 lg:text-4xl md:text-3xl">Apa kata mereka ?</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for ($i = 0; $i < 6; $i++)
                    <div class="bg-emerald-900 p-6 rounded-lg relative">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-gray-300 mr-4"></div>
                            <div>
                                <h3 class="font-bold text-white">Customer</h3>
                                <div class="flex">
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-white">Layanan yang sangat baik dan cepat, mobil dalam keadaan bersih dan terawat. Harga juga bersaing. Sangat direkomendasikan!</p>
                    </div>
                    @endfor
                </div>
            </div>
        </section>
        <!-- Contact Section -->
        <section id="contact" class="py-12 px-4 md:px-8 lg:px-16">
            <div class="container mx-auto">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl">HUBUNGI KAMI</h1>
                        <span class="py-3 font-bold text-2xl mt-2 lg:text-4xl md:text-3xl">Kami sangat menerima saran dan masukan anda</span>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-8 py-10">
                    <!-- Contact Form -->
                    <div class="w-full lg:w-1/2 bg-white p-6 shadow-xl rounded-lg">
                        <form>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 mb-2">Nama</label>
                                <input type="text" id="name" class="w-full border border-gray-300 rounded-sm p-2">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" class="w-full border border-gray-300 rounded-sm p-2">
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block text-gray-700 mb-2">Pesan</label>
                                <textarea id="message" rows="5" class="w-full border border-gray-300 rounded-sm p-2"></textarea>
                            </div>
                            <button type="submit"
                            class="w-full inline-block cursor-pointer items-center justify-center rounded-xl border-[1.58px] border-zinc-600 bg-emerald-900 px-5 py-3 font-medium text-slate-200 shadow-md transition-all duration-300 hover:[transform:translateY(-.335rem)] hover:shadow-xl hover:bg-emerald-700 hover:text-white"
                            >
                            Sewa
                            </button>
                        </form>
                    </div>
                    <!-- Map -->
                    <div class="w-full lg:w-1/2">
                        <div class="bg-gray-200 rounded-lg h-full min-h-64 relative">
                            <!-- This would be replaced with an actual map integration -->
                            <div class="flex items-center justify-center h-full">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127649.84980064462!2d103.8960212972656!3d1.1187205000000238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sid!2sid!4v1745922630823!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
