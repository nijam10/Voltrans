@extends('layout.app')

@section('title', 'Home')
    @section('content')
        <section id="home" class="bg-linear-to-b from-[#4C956C] to-[#2C6E6D] min-h-screen overflow-hidden">
            <div class="@container lg:px-15 md:px-7 px-3 py-6 lg:py-12 md:py-7 flex mx-auto justify-between items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section -->
                    <div class="w-full self-center px-5 lg:w-1/2 md:w-1/2 z-10">
                        <h1 class="text-base font-semibold text-white md:text-lg">Hellow👋 Selamat Datang di Voltrans 
                            <span class="block py-3 font-bold text-white text-3xl mt-2 sm:text-base lg:text-6xl md:text-2xl">
                                Berkendara Nyaman, Tanpa Polusi, Demi Masa Depan Kita
                            </span>
                        </h1>
                        <h2 class="font-medium text-slate-200 my-5 text-md mb-5 lg:text-xl">Aplikasi Penyewaan Transportasi Listrik Ramah Lingkungan </h2>
                        <div class="flex gap-4">
                            <a href="#contact" class="btn btn-warning mt-5 rounded-full">
                                <img src="https://img.icons8.com/ios-filled/50/000000/handshake.png" alt="Contact Me" width="24" height="24">
                                Sewa Sekarang
                            </a>
                            <a href="#contact" class="btn btn-success mt-5 rounded-full">
                                <img src="https://img.icons8.com/ios-filled/50/000000/handshake.png" alt="Contact Me" width="24" height="24">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                    <!-- Right Section -->
                    <div class="w-full lg:w-1/2 md:w-1/2 relative">
                        <div class="lg:absolute lg:right-0 lg:top-1/2 lg:transform lg:-translate-y-1/2">
                            <img src="{{asset('images/hero.png')}}" alt="Gambar" class="w-full lg:w-auto lg:max-h-[90vh] object-contain mx-auto">
                            <span class="absolute -bottom-10 -z-10 left-1/2 -translate-x-1/2 lg:scale-125 lg:-bottom-0 md:scale-75 2xl:scale-150">
                                <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#F2F4F8" d="M60.5,-55.1C75.9,-45,84.3,-22.5,81.8,-2.5C79.2,17.4,65.7,34.8,50.3,51.2C34.8,67.6,17.4,83,-0.6,83.6C-18.5,84.1,-37,69.8,-50.7,53.4C-64.3,37,-73.1,18.5,-68.5,4.6C-64,-9.4,-46,-18.7,-32.4,-28.8C-18.7,-38.9,-9.4,-49.7,6.6,-56.3C22.5,-62.9,45,-65.2,60.5,-55.1Z" transform="translate(100 100)" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about" class=" min-h-screen overflow-hidden">
            <div class="@container px-10 py-12 flex mx-auto justify-between items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section -->
                    <div class="w-full lg:w-1/3 md:w-1/2 relative flex-auto">
                        <div class="lg:absolute lg:right-0 lg:top-2/5 lg:transform lg:-translate-y-1/2 text-center">
                            <img src="{{asset('images/voltrans-green.png')}}" alt="Gambar" class="w-full lg:w-auto lg:max-h-[90vh] object-contain mx-auto">
                            <span class="text-5xl font-extrabold text-emerald-800 -mt-10">VOLTRANS</span>
                            <span class="absolute -bottom-10 -z-10 left-1/2 -translate-x-1/2 lg:scale-125 lg:bottom-20 md:scale-75 2xl:scale-150">
                                <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#F2F4F8" d="M60.5,-55.1C75.9,-45,84.3,-22.5,81.8,-2.5C79.2,17.4,65.7,34.8,50.3,51.2C34.8,67.6,17.4,83,-0.6,83.6C-18.5,84.1,-37,69.8,-50.7,53.4C-64.3,37,-73.1,18.5,-68.5,4.6C-64,-9.4,-46,-18.7,-32.4,-28.8C-18.7,-38.9,-9.4,-49.7,6.6,-56.3C22.5,-62.9,45,-65.2,60.5,-55.1Z" transform="translate(100 100)" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <!-- Right Section -->
                    <div class="w-full self-center px-10 md:w-1/2 z-10 flex-auto">
                        <h1 class="text-lg font-extrabold text-emerald-800 md:text-lg lg:text-2xl">Tentang Kami
                            <span class="block py-3 font-bold text-black text-2xl mt-2 sm:text-base lg:text-5xl/[6vh] md:text-3xl">
                                Temukan berbagai transportasi elektrik yang keren dan nyaman untuk masa depan anda
                            </span>
                        </h1>
                        <p class="my-5 text-md mb-5 lg:text-xl">Voltrans adalah sebuah platform penyewaan transportasi listrik sebagai upaya untuk mengurangi emisi karbon dengan akses mudah dan harga yang terjangkau demi mempersiapkan masa depan yang lebih sehat</p>
                        <div class="flex mt-10 p-5 py-10 rounded-l-[80px] text-white bg-linear-to-r from-[#4C956C] to-[#2C6E6D] shadow-lg text-center">
                            <div class="stat gap-3 font-inter">
                                <div class="stat-value text-6xl">3+</div>
                                <div class="stat-title text-4xl text-white">Pengalaman</div>
                            </div>
                            <div class="stat gap-3 font-inter">
                                <div class="stat-value text-6xl">300+</div>
                                <div class="stat-title text-4xl text-white">Customer</div>
                            </div>
                            <div class="stat gap-3 font-inter">
                                <div class="stat-value text-6xl">100+</div>
                                <div class="stat-title text-4xl text-white">Kendaraan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="why" class="min-h-screen overflow-hidden">
            <div class="@container px-10 py-12 flex mx-auto justify-between items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section -->
                    <div class="w-full lg:w-1/2 md:w-1/2 flex-auto flex justify-center items-center">
                        <img src="{{asset('images/charging-car.jpg')}}" alt="Gambar" class="w-full lg:w-auto lg:max-h-[90vh] rounded-r-[80px] object-contain mx-auto">
                    </div>
                    <!-- Right Section -->
                    <div class="w-full self-center px-10 md:w-1/2 z-10 flex-auto">
                        <h1 class="text-lg font-extrabold text-emerald-800 md:text-lg lg:text-2xl">Mengapa Kami
                            <span class="block py-3 font-bold text-black text-2xl mt-2 sm:text-base lg:text-5xl/[6vh] md:text-3xl">
                                Menawarkan sensasi terbaik dalam setiap penyewaan
                            </span>
                        </h1>
                        <div class="flex-wrap shadow-lg border-2 border-[#4C956C] bg-white p-5 mt-5 rounded-l-[50px] text-white bg-linear-to-r from-[#4C956C] to-[#2C6E6D]">
                            <div class='gap-y-4 w-full flex flex-wrap items-center'>
                                <div class="w-full p-2 lg:w-1/2">
                                    <img src="{{asset('icons/pay.png')}}" alt="Contact Me" width="50" height="50">
                                    <h2 class="text-xl font-bold">Pembayaran Mudah</h2>
                                    <p class="text-md">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="w-full p-2 lg:w-1/2">
                                    <img src="{{asset('icons/pay.png')}}" alt="Contact Me" width="50" height="50">
                                    <h2 class="text-xl font-bold">Pembayaran Mudah</h2>
                                    <p class="text-md">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="w-full p-2 lg:w-1/2">
                                    <img src="{{asset('icons/pay.png')}}" alt="Contact Me" width="50" height="50">
                                    <h2 class="text-xl font-bold">Pembayaran Mudah</h2>
                                    <p class="text-md">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="w-full p-2 lg:w-1/2">
                                    <img src="{{asset('icons/pay.png')}}" alt="Contact Me" width="50" height="50">
                                    <h2 class="text-xl font-bold">Pembayaran Mudah</h2>
                                    <p class="text-md">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    @endsection
