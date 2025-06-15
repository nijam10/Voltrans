@extends('layouts.app')
@section('title', 'Tentang Kami')
@section('content')

    <x-page-header :title="'Tentang Kami'" :breadcrumbs="$breadcrumbs"/>
        <section class="relative isolate overflow-hidden flex flex-col mx-auto px-4 py-8 sm:px-6 lg:px-20 lg:py-20 space-y-6 lg:flex-row lg:items-center">
            <div class="w-full lg:w-1/2">
                <div class="lg:max-w-2xl lg:pr-10">
                    <h1 class="text-lg font-extrabold text-emerald-800 md:text-xl lg:text-2xl uppercase intersect-once intersect:motion-preset-slide-right motion-blur-in-md">tujuan kami</h1>
                    <h2 class="text-xl lg:text-4xl font-semibold tracking-wide text-gray-900 capitalize mt-3 intersect-once intersect:motion-preset-slide-left motion-blur-in-md">bertekad untuk menghadapi masa depan yang lebih indah dan sehat</h2>
                    <p class="mt-4 text-gray-700 intersect-once intersect:motion-preset-fade-in motion-delay-300">Kami berusaha bahwa setiap perjalanan berkontribusi positif terhadap lingkungan dan kualitas hidup masyarakat.</p>
                    <div class="grid gap-6 mt-8 sm:grid-cols-2">
                        <div class="flex items-center text-emerald-800 -px-3 intersect-once intersect:motion-preset-slide-up motion-delay-400">
                            <svg class="w-5 h-5 mx-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="mx-3">Akses Mudah Transportasi Listrik</span>
                        </div>
                        <div class="flex items-center text-emerald-800 -px-3 intersect-once intersect:motion-preset-slide-up motion-delay-500">
                            <svg class="w-5 h-5 mx-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="mx-3">Mengurangi Emisi Karbon</span>
                        </div>
                        <div class="flex items-center text-emerald-800 -px-3 intersect-once intersect:motion-preset-slide-up motion-delay-600">
                            <svg class="w-5 h-5 mx-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="mx-3">Kolaborasi dengan Masyarakat</span>
                        </div>
                        <div class="flex items-center text-emerald-800 -px-3 intersect-once intersect:motion-preset-slide-up motion-delay-700">
                            <svg class="w-5 h-5 mx-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="mx-3">Edukasi Transportasi Listrik</span>
                        </div>
                        <div class="flex items-center text-emerald-800 -px-3 intersect-once intersect:motion-preset-slide-up motion-delay-800">
                            <svg class="w-5 h-5 mx-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="mx-3">Inovasi Teknologi dan Bisnis</span>
                        </div>
                        <div class="flex items-center text-emerald-800 -px-3 intersect-once intersect:motion-preset-slide-up motion-delay-900">
                            <svg class="w-5 h-5 mx-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="mx-3">Maksimalkan Efisiensi Energi</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center w-full lg:w-1/2 intersect-once intersect:motion-preset-slide-left motion-delay-500">
                <img class="object-cover w-full h-full max-w-2xl rounded-md" src="https://images.unsplash.com/photo-1665963112133-011965f045d7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Green Future photo">
            </div>
        </section>
        {{-- Team Section --}}
        <section class="bg-slate-100 relative isolate overflow-hidden">
            <div class="mx-auto px-4 py-8 sm:px-6 lg:px-20 lg:py-18">
                <h1 class="text-lg font-extrabold text-emerald-800 md:text-xl lg:text-2xl uppercase lg:text-center intersect-once intersect:motion-preset-slide-up motion-delay-0">Tim kami</h1>
                <span class="block py-3 text-xl font-semibold text-gray-900 capitalize lg:text-3xl max-w-2xl mx-auto lg:text-center intersect-once intersect:motion-preset-slide-up motion-delay-200">
                    Berusaha memberikan solusi terbaik untuk kebutuhan masa depan.
                </span>
                <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-10 md:grid-cols-2 xl:grid-cols-4">
                    <div class="flex flex-col items-center intersect-once intersect:motion-preset-slide-up motion-delay-100">
                        <a href="#" class="group relative block bg-black w-full rounded-lg overflow-hidden">
                            <img
                                alt=""
                                src="{{ asset('images/nizam-photo.jpg') }}"
                                class="absolute inset-0 w-full h-full object-cover object-center opacity-75 transition-opacity group-hover:opacity-50"
                        />
                            <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium tracking-widest text-teal-400 uppercase">CEO</p>
                                <p class="text-xl font-bold text-white sm:text-2xl">Khairul Nizam</p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                                        <p class="text-sm text-white">
                                            Pemimpin perusahaan yang berdedikasi untuk memberikan solusi terbaik.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <p class="mt-2 text-gray-500 capitalize">Founder & CEO</p>
                        <div class="flex mt-3 -mx-2">
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="LinkedIn">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.27c-.97 0-1.75-.79-1.75-1.76s.78-1.76 1.75-1.76 1.75.79 1.75 1.76-.78 1.76-1.75 1.76zm13.5 11.27h-3v-5.6c0-1.34-.03-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7h-3v-10h2.89v1.36h.04c.4-.75 1.37-1.54 2.82-1.54 3.01 0 3.57 1.98 3.57 4.56v5.62z"/>
                                </svg>
                            </a>
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="Github">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.021c0 4.428 2.865 8.184 6.839 9.504.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.342-3.369-1.342-.454-1.157-1.11-1.465-1.11-1.465-.908-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.339-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.295 2.748-1.025 2.748-1.025.546 1.378.202 2.397.1 2.65.64.7 1.028 1.595 1.028 2.688 0 3.847-2.337 4.695-4.566 4.944.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .267.18.577.688.479C19.138 20.2 22 16.447 22 12.021 22 6.484 17.523 2 12 2z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col items-center intersect-once intersect:motion-preset-slide-up motion-delay-200">
                        <a href="#" class="group relative block bg-black w-full rounded-lg overflow-hidden">
                            <img
                            alt=""
                            src="{{ asset('images/danial-photo.jpg') }}"
                            class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                            />
                            <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium tracking-widest text-teal-400 uppercase">Developer</p>
                                <p class="text-xl font-bold text-white sm:text-2xl">Muhammad Danial</p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div
                                    class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                                    >
                                        <p class="text-sm text-white">
                                            Profesional yang berpengalaman dalam mengembangkan sistem dan teknologi aplikasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <p class="mt-2 text-gray-500 capitalize">Fullstack Developer</p>
                        <div class="flex mt-3 -mx-2">
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="LinkedIn">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.27c-.97 0-1.75-.79-1.75-1.76s.78-1.76 1.75-1.76 1.75.79 1.75 1.76-.78 1.76-1.75 1.76zm13.5 11.27h-3v-5.6c0-1.34-.03-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7h-3v-10h2.89v1.36h.04c.4-.75 1.37-1.54 2.82-1.54 3.01 0 3.57 1.98 3.57 4.56v5.62z"/>
                                </svg>
                            </a>
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="Github">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.021c0 4.428 2.865 8.184 6.839 9.504.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.342-3.369-1.342-.454-1.157-1.11-1.465-1.11-1.465-.908-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.339-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.295 2.748-1.025 2.748-1.025.546 1.378.202 2.397.1 2.65.64.7 1.028 1.595 1.028 2.688 0 3.847-2.337 4.695-4.566 4.944.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .267.18.577.688.479C19.138 20.2 22 16.447 22 12.021 22 6.484 17.523 2 12 2z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col items-center intersect-once intersect:motion-preset-slide-up motion-delay-300">
                        <a href="#" class="group relative block bg-black w-full rounded-lg overflow-hidden">
                            <img
                            alt="Sarah Lee"
                            src="{{ asset('images/maul-photo.jpg') }}"
                            class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                            />
                            <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium tracking-widest text-teal-400 uppercase">Product Designer</p>
                                <p class="text-xl font-bold text-white sm:text-2xl">Maulana R</p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div
                                    class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                                    >
                                        <p class="text-sm text-white">
                                            Spesialis dalam desain produk dan pengalaman pengguna, berfokus pada inovasi dan estetika aplikasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <p class="mt-2 text-gray-500 capitalize">Product Designer</p>
                        <div class="flex mt-3 -mx-2">
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="LinkedIn">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.27c-.97 0-1.75-.79-1.75-1.76s.78-1.76 1.75-1.76 1.75.79 1.75 1.76-.78 1.76-1.75 1.76zm13.5 11.27h-3v-5.6c0-1.34-.03-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7h-3v-10h2.89v1.36h.04c.4-.75 1.37-1.54 2.82-1.54 3.01 0 3.57 1.98 3.57 4.56v5.62z"/>
                                </svg>
                            </a>
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="Github">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.021c0 4.428 2.865 8.184 6.839 9.504.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.342-3.369-1.342-.454-1.157-1.11-1.465-1.11-1.465-.908-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.339-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.295 2.748-1.025 2.748-1.025.546 1.378.202 2.397.1 2.65.64.7 1.028 1.595 1.028 2.688 0 3.847-2.337 4.695-4.566 4.944.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .267.18.577.688.479C19.138 20.2 22 16.447 22 12.021 22 6.484 17.523 2 12 2z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col items-center intersect-once intersect:motion-preset-slide-up motion-delay-400">
                        <a href="#" class="group relative block bg-black w-full rounded-lg overflow-hidden">
                            <img
                            alt="Budi Santoso"
                            src="{{ asset('images/fajar-photo.jpg') }}"
                            class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                            />
                            <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium tracking-widest text-teal-400 uppercase">QA Analyst</p>
                                <p class="text-xl font-bold text-white sm:text-2xl">Aruna Fajar</p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div
                                    class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                                    >
                                        <p class="text-sm text-white">
                                            Melakukan pengujian, analisis, dan pemantauan demi kualitas sistem berjalan dengan baik. 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <p class="mt-2 text-gray-500 capitalize">Quality Assurance</p>
                        <div class="flex mt-3 -mx-2">
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="LinkedIn">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.27c-.97 0-1.75-.79-1.75-1.76s.78-1.76 1.75-1.76 1.75.79 1.75 1.76-.78 1.76-1.75 1.76zm13.5 11.27h-3v-5.6c0-1.34-.03-3.07-1.87-3.07-1.87 0-2.16 1.46-2.16 2.97v5.7h-3v-10h2.89v1.36h.04c.4-.75 1.37-1.54 2.82-1.54 3.01 0 3.57 1.98 3.57 4.56v5.62z"/>
                                </svg>
                            </a>
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 hover:text-teal-500" aria-label="Github">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.477 2 2 6.484 2 12.021c0 4.428 2.865 8.184 6.839 9.504.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.342-3.369-1.342-.454-1.157-1.11-1.465-1.11-1.465-.908-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.339-2.221-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.295 2.748-1.025 2.748-1.025.546 1.378.202 2.397.1 2.65.64.7 1.028 1.595 1.028 2.688 0 3.847-2.337 4.695-4.566 4.944.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .267.18.577.688.479C19.138 20.2 22 16.447 22 12.021 22 6.484 17.523 2 12 2z"/>
                                </svg>
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

        {{-- Contact Us Section --}}
        <section class="bg-slate-100 relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,var(--color-teal-100),white)] opacity-20"></div>
        <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl ring-1 shadow-teal-600/10 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>
            <div class="mx-auto px-4 py-8 sm:px-6 lg:px-20 lg:py-20">
                <div class="text-center">
                    <h1 class="text-lg font-extrabold text-emerald-800 md:text-xl lg:text-2xl uppercase lg:text-center">Hubungi Kami</h1>
                    <h2 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl capitalize">hubungi kami untuk info lebih lanjut</h2>
                </div>
                <div class="py-6 lg:py-10">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.057798979732!2d104.0458816745886!3d1.1187258622759466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sid!2sid!4v1747716627950!5m2!1sid!2sid" height="500" class="w-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="grid grid-cols-1 gap-12 mt-10 lg:grid-cols-3 sm:grid-cols-2">
                        <div class="p-4 rounded-lg bg-teal-50 md:p-6 intersect-once intersect:motion-preset-slide-up motion-delay-100">
                            <span class="inline-block p-3 text-slate-500 rounded-lg bg-blue-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-base font-medium text-gray-800">Kirim pesan</h2>
                            <p class="mt-2 text-sm text-gray-500">Berikan saran atau kendala anda.</p>
                            <p class="mt-2 text-sm text-green-800">info@voltrans.com</p>
                        </div>
                        <div class="p-4 rounded-lg bg-teal-50 md:p-6 intersect-once intersect:motion-preset-slide-up motion-delay-200">
                            <span class="inline-block p-3 text-slate-500 rounded-lg bg-blue-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-base font-medium text-gray-800">Kunjungi Kami</h2>
                            <p class="mt-2 text-sm text-gray-500">Anda bisa datang langsung ke kantor kami</p>
                            <p class="mt-2 text-sm text-green-800">Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461</p>
                        </div>
                        <div class="p-4 rounded-lg bg-teal-50 md:p-6 intersect-once intersect:motion-preset-slide-up motion-delay-300">
                            <span class="inline-block p-3 text-slate-500 rounded-lg bg-blue-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </span>
                            <h2 class="mt-4 text-base font-medium text-gray-800">Hubungi Kami</h2>
                            <p class="mt-2 text-sm text-gray-500">Operasional Senin-Jum'at jam 08.00 hingga 16.00 WIB.</p>
                            <p class="mt-2 text-sm text-green-800">+62 (778) 102-9872</p>
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

        {{-- CTA Section --}}
        <section class="py-10 lg:py-20 lg:flex lg:justify-center">
            <x-animations.modal>
                <div
                    class="overflow-hidden bg-teal-800 lg:mx-8 lg:flex lg:max-w-6xl lg:w-full lg:shadow-md lg:rounded-xl">
                    <div class="lg:w-1/2 intersect-once intersect:motion-preset-fade-in motion-delay-0">
                        <div class="h-64 bg-cover lg:h-full" style="background-image:url('https://plus.unsplash.com/premium_photo-1715639312136-56a01f236440?q=80&w=2057&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')"></div>
                    </div>
                    <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2">
                        <h2 class="text-2xl font-semibold text-slate-100 md:text-3xl">
                            Mulai perjalanan menuju masa depan yang lebih baik
                        </h2>
                        <p class="mt-4 text-slate-50">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Quidem modi reprehenderit vitae exercitationem aliquid dolores ullam temporibus enim expedita aperiam
                            mollitia iure consectetur dicta tenetur, porro consequuntur saepe accusantium consequatur.
                        </p>
                        <div class="inline-flex w-full mt-6 sm:w-auto">
                            <a href="{{ route('rent') }}">
                                <x-secondary-button class="cursor-pointer hover:bg-teal-500 hover:text-white">Sewa Sekarang</x-secondary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </x-animations.modal>
        </section>
@endsection