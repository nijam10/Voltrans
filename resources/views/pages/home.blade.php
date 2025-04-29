@extends('layouts.app')

@section('title', 'Home')
    @section('content')
    {{-- Hero Section --}}
        <section id="home" class="bg-linear-to-b from-[#4C956C] to-[#2C6E6D] min-h-screen overflow-hidden">
            <div class="lg:px-15 md:px-7 px-3 py-6 lg:py-12 md:py-7 flex mx-auto justify-between items-center min-h-screen">
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
                                <img src="https://img.icons8.com/ios-filled/50/000000/car.png" alt="Contact Me" width="24" height="24">
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
                        <div class="lg:absolute lg:right-0 lg:top-1/2 lg:transform lg:-translate-y-1/2 z-10">
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
        {{-- Tentang Kami --}}
        <section id="about" class="min-h-screen overflow-hidden py-12 lg:py-0">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section -->
                    <div class="w-full lg:w-1/3 md:w-1/2 relative flex-auto mb-12 lg:mb-0">
                        <div class="text-center lg:absolute lg:left-0 lg:top-1/2 lg:transform lg:-translate-y-1/2">
                            <img src="{{asset('images/voltrans-green.png')}}" alt="Gambar" class="w-3/4 sm:w-2/3 lg:w-auto lg:max-h-[80vh] object-contain mx-auto">
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
                        <span class="block py-3 font-bold text-black text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl leading-tight mt-2">
                            Temukan berbagai transportasi elektrik yang keren dan nyaman untuk masa depan anda
                        </span>
                        <p class="my-5 text-base sm:text-lg lg:text-xl">Voltrans adalah sebuah platform penyewaan transportasi listrik sebagai upaya untuk mengurangi emisi karbon dengan akses mudah dan harga yang terjangkau demi mempersiapkan masa depan yang lebih sehat</p>
                        <div class="flex flex-col sm:flex-row mt-10 p-4 sm:p-5 py-8 sm:py-10 rounded-l-[40px] sm:rounded-l-[80px] text-white bg-gradient-to-r from-[#4C956C] to-[#2C6E6D] shadow-lg text-center overflow-hidden">
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
        <section id="why" class="min-h-screen overflow-hidden py-12 lg:py-0">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center min-h-screen">
                <div class="flex flex-wrap w-full"> 
                    <!-- Left Section - Image (Order changes on mobile) -->
                    <div class="w-full lg:w-1/2 md:w-1/2 flex-auto flex justify-center items-center order-2 lg:order-1 mt-8 lg:mt-0">
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
                                    <h2 class="text-xl font-bold">Pembayaran Mudah</h2>
                                    <p class="text-md text-center sm:text-left">Kami menawarkan kenyamanan dalam setiap perjalanan anda</p>
                                </div>
                                <div class="p-2 hover:bg-[#f0f8f5] rounded-lg transition-all duration-300 flex flex-col items-center sm:items-start">
                                    <img src="{{asset('icons/eco_choice.png')}}" alt="Eco Choice Icon" width="70" class="mb-2">
                                    <h2 class="text-xl font-bold">Pilihan Ramah Lingkungan</h2>
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
        </section>
        {{-- Cara Kerja Section --}}
        <section id="how" class="py-20 bg-gradient-to-b from-[#4C956C] to-[#2C6E6D]">
            <div class="flex flex-wrap w-full justify-center items-center">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-[#F0E5C1] md:text-lg lg:text-2xl">CARA KERJA</h1>
                        <span class="py-3 text-base font-bold text-white text-2xl mt-2 lg:text-5xl/[6vh] md:text-3xl">Dijamin cepat dan mudah
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
                    <div class="card bg-base-100 shadow hover:shadow-emerald-700 hover:shadow-lg  transition-shadow">
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
                        <div class="flex gap-8 items-center grayscale animate-marquee whitespace-nowrap">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Wuling-logo.svg/2560px-Wuling-logo.svg.png" alt="Honda" class="h-8"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Hyundai_Motor_Company_logo.svg/1280px-Hyundai_Motor_Company_logo.svg.png" alt="Jaguar" class="h-8"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Tesla_logo.png/1200px-Tesla_logo.png" alt="Nissan" class="h-20"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/BYD_Auto_2022_logo.svg/1200px-BYD_Auto_2022_logo.svg.png" alt="Volvo" class="h-8"/>
                            <img src="https://www.gesitsmotors.com/wp-content/uploads/2020/06/Logo-dark-gesits.png" alt="Audi" class="h-8"/>
                            <img src="https://teladan-resources.com/wp-content/uploads/2022/10/IMG-Alva.png" alt="Acura" class="h-20"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Polytron.svg/2560px-Polytron.svg.png" alt="Acura" class="h-8"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Chery_logo.svg/1200px-Chery_logo.svg.png" alt="Acura" class="h-8"/>
                            <!-- Duplicate for continuous flow -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Wuling-logo.svg/2560px-Wuling-logo.svg.png" alt="Honda" class="h-8"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Hyundai_Motor_Company_logo.svg/1280px-Hyundai_Motor_Company_logo.svg.png" alt="Jaguar" class="h-8"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Tesla_logo.png/1200px-Tesla_logo.png" alt="Nissan" class="h-20"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/BYD_Auto_2022_logo.svg/1200px-BYD_Auto_2022_logo.svg.png" alt="Volvo" class="h-8"/>
                            <img src="https://www.gesitsmotors.com/wp-content/uploads/2020/06/Logo-dark-gesits.png" alt="Audi" class="h-8"/>
                            <img src="https://teladan-resources.com/wp-content/uploads/2022/10/IMG-Alva.png" alt="Acura" class="h-20"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Polytron.svg/2560px-Polytron.svg.png" alt="Acura" class="h-8"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Chery_logo.svg/1200px-Chery_logo.svg.png" alt="Acura" class="h-8"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials Section -->
        <section class="bg-gray-50 py-12 px-4 md:px-8 lg:px-16">
            <div class="container mx-auto">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl">ULASAN</h1>
                        <span class="py-3 text-base font-bold text-2xl mt-2 lg:text-4xl md:text-3xl">Apa kata mereka ?</span>
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
        <section class="py-12 px-4 md:px-8 lg:px-16">
            <div class="container mx-auto">
                <div class="w-full px-4">
                    <div class="max-w-2xl mx-auto text-center mb-4">
                        <h1 class="text-lg font-extrabold text-emerald-900 md:text-lg lg:text-2xl">HUBUNGI KAMI</h1>
                        <span class="py-3 text-base font-bold text-2xl mt-2 lg:text-4xl md:text-3xl">Kami sangat menerima saran dan masukan anda</span>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-8 py-10">
                    <!-- Contact Form -->
                    <div class="w-full lg:w-1/2 bg-white p-6 shadow-xl rounded-lg">
                        <form>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 mb-2">Nama</label>
                                <input type="text" id="name" class="w-full border border-gray-300 rounded p-2">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" class="w-full border border-gray-300 rounded p-2">
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block text-gray-700 mb-2">Pesan</label>
                                <textarea id="message" rows="5" class="w-full border border-gray-300 rounded p-2"></textarea>
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
