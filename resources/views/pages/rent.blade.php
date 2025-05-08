@extends('layouts.app')

@section('title', 'Rent')
@section('content')
    <x-page-header :title="'Sewa'" :breadcrumbs="$breadcrumbs" />

    {{-- Main container for the page content --}}
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 py-15">
        <header>
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Pilih Transportasi</h2>
            <p class="mt-4 max-w-md text-gray-500">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque praesentium cumque iure
                dicta incidunt est ipsam, officia dolor fugit natus?
            </p>
        </header>

        {{-- Mobile filter button visible on small screens --}}
        <div class="mt-8 block lg:hidden">
            <button
                class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600"
            >
                <span class="text-sm font-medium"> Sortir & Filter </span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4 rtl:rotate-180"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        {{-- Grid container for sidebar filter and product listing --}}
        <div class="mt-4 lg:mt-8 lg:grid lg:grid-cols-5 lg:items-start lg:gap-8">
            
            @include('components.filter-sidebar')

            {{-- Product listing section on the right --}}
            <section class="w-full lg:col-span-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for($i = 0; $i < 9; $i++)
                        @include('components.card', [
                            'imgsrc' => 'images/wuling.png',
                            'title' => 'Wuling Air EV',
                            'type' => 'E-Car',
                            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus mollitia officia consectetur temporibus in nemo ea minus, beatae vitae vero ab quas illum eos neque sunt omnis blanditiis? Assumenda voluptatem dicta explicabo architecto, temporibus totam ipsa, laudantium fuga incidunt officiis unde itaque beatae dolorum libero, est praesentium tempore dolor reiciendis.',
                            'price' => '120.000',
                            'rating' => '5.0'
                        ])
                    @endfor
                </div>

                {{-- Pagination controls --}}
                <div class="join flex justify-center mt-8">
                    <input
                        class="join-item btn btn-success btn-square"
                        type="radio"
                        name="options"
                        aria-label="1"
                        checked="checked" />
                    <input class="join-item btn btn-square" type="radio" name="options" aria-label="2" />
                    <input class="join-item btn btn-square" type="radio" name="options" aria-label="3" />
                    <input class="join-item btn btn-square" type="radio" name="options" aria-label="4" />
                </div>
            </section>
        </div>
    </div>
@endsection
