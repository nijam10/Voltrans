@extends('layouts.app')
@section('title', 'Keranjang Anda')
@section('content')

<div class="py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="py-10">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Keranjang Anda</h1>
            <p class="mt-2 text-sm text-gray-600">Review produk yang Anda pilih dan lanjutkan ke pembayaran</p>
        </div>

        @if(session('error'))
        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 motion-translate-y-in-100" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
        @endif

        @if(!auth()->user()->hasVerifiedAddress())
        <div class="mb-4 p-4 text-sm text-amber-800 rounded-lg bg-amber-50 motion-translate-y-in-100" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>Anda harus menambahkan dan memverifikasi alamat terlebih dahulu sebelum dapat melakukan checkout.</span>
                </div>
                <a href="{{ route('user.addresses.index') }}" class="text-amber-600 hover:text-amber-700 font-medium underline">
                    Tambah Alamat
                </a>
            </div>
        </div>
        @endif

        @if($cartItems->isEmpty())
            <div class="text-center py-12">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang Anda kosong</h3>
                <p class="text-gray-500 mb-6">Tampaknya Anda belum menambahkan produk apapun ke keranjang Anda.</p>
                <a href="{{ route('rent') }}" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 px-4 py-2">
                    Lanjutkan Belanja
                </a>
            </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-4 sm:p-6">
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                            <div class="flex flex-col sm:flex-row gap-4 p-4 bg-gray-50 rounded-lg">
                                {{-- Product Image --}}
                                <div class="flex-shrink-0">
                                    <img src="{{Storage::disk('s3')->url($item->product->thumbnail) }}" 
                                        alt="{{ $item->product->name }}" 
                                        class="w-24 h-24 object-cover rounded-lg">
                                </div>

                                {{-- Product Details --}}
                                <div class="flex-1">
                                    <div class="flex flex-col sm:flex-row sm:justify-between gap-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                {{ $item->product->name }}
                                            </h3>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $item->product->category->name }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-emerald-700">
                                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $item->start_date->format('d M Y') }} - {{ $item->end_date->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Remove Button --}}
                                    <div class="mt-4 flex justify-end">
                                        <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline delete-cart-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="hover:cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium text-red-600 hover:text-red-700 focus:outline-none focus:text-red-700">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tax (11%)</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($total * 0.11, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-base font-semibold text-gray-900">Total</span>
                                    <span class="text-base font-bold text-emerald-700">Rp {{ number_format($total * 1.11, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            @if(auth()->user()->hasVerifiedAddress())
                                <a href="{{ route('checkout.index') }}" 
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-slate-800 text-white hover:bg-slate-700 focus:outline-none focus:bg-slate-700 transition-all">
                                    Lanjutkan ke Checkout
                                </a>
                                {{-- Admin Verification Note --}}
                                <div class="mt-2 text-xs text-yellow-700 bg-yellow-100 border border-yellow-300 rounded p-2">
                                    <strong>Catatan:</strong> Setelah checkout, pesanan Anda akan diverifikasi oleh admin sebelum dapat melakukan pembayaran.
                                </div>
                            @else
                                <button disabled
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-300 text-gray-500 cursor-not-allowed">
                                    Lanjutkan ke Checkout
                                </button>
                                <p class="text-xs text-gray-500 mt-2 text-center">Verifikasi alamat terlebih dahulu</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.delete-cart-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Produk ini akan dihapus dari keranjang!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Produk berhasil dihapus",
                                icon: "success",
                                timer: 10000
                            });
                            form.submit();
                        }
                    });
                });
            });

            // SweetAlert2 for Checkout Button
            const checkoutBtn = document.querySelector('a[href="{{ route('checkout.index') }}"]');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'success',
                        title: 'Menuju Checkout',
                        text: 'Anda akan diarahkan ke halaman checkout.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(() => {
                        window.location.href = checkoutBtn.href;
                    }, 1600);
                });
            }
        });
    </script>
@endpush
@endsection 