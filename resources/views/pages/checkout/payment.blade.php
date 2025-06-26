@extends('layouts.app')
@section('title', 'Review & Bayar')
@section('content')

<div class="py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Progress Steps --}}
        <div class="max-w-3xl mx-auto mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Checkout</div>
                </div>
                <div class="flex-1 h-0.5 bg-emerald-600 mx-4"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        2
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Pembayaran</div>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 text-gray-600">
                        3
                    </div>
                    <div class="ml-2 text-sm font-medium text-gray-600">Konfirmasi</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Review & Payment Form --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Review & Bayar</h2>
                        
                        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            {{-- Hidden Fields --}}
                            <input type="hidden" name="phone_number" value="{{ $request->phone_number }}">
                            <input type="hidden" name="delivery_location" value="{{ $orderData['delivery_location'] }}">

                            {{-- Contact Details --}}
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-2">Contact Details</h3>
                                <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- Shipping Details --}}
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-2">Informasi Pemesanan</h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">No Telepon:</span> {{ $request->phone_number }}
                                    </p>
                                    @if($orderData['is_delivered'])
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Metode Pickup:</span> Kirim ke Alamat
                                        </p>
                                        @php
                                            $deliveryAddress = json_decode($orderData['delivery_location'], true);
                                        @endphp
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Alamat Pengiriman:</span><br>
                                            @if(isset($deliveryAddress['type']))
                                                @if($deliveryAddress['type'] === 'existing')
                                                    {{ $deliveryAddress['name'] ?? 'N/A' }}<br>
                                                    {{ $deliveryAddress['address'] ?? 'N/A' }}<br>
                                                    {{ $deliveryAddress['city'] ?? 'N/A' }}, {{ $deliveryAddress['province'] ?? 'N/A' }} {{ $deliveryAddress['postal_code'] ?? '' }}
                                                @elseif($deliveryAddress['type'] === 'new')
                                                    {{ $deliveryAddress['name'] ?? 'N/A' }}<br>
                                                    {{ $deliveryAddress['address'] ?? 'N/A' }}<br>
                                                    {{ $deliveryAddress['city'] ?? 'N/A' }}, {{ $deliveryAddress['province'] ?? 'N/A' }} {{ $deliveryAddress['postal_code'] ?? '' }}
                                                @endif
                                            @else
                                                Alamat tidak tersedia
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Delivery Method:</span> Ambil di Lokasi
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Lokasi Pengambilan:</span><br>
                                            Alamat Perusahaan (akan dikirimkan via email)
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- Payment Method --}}
                            <div>
                                <div class="w-full" id="snap-container">
                                </div>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <a href="{{ route('checkout.index') }}" 
                                        class="py-3 mt-5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none transition-all">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                        <div class="space-y-4">
                            @if(isset($isDirectCheckout) && $isDirectCheckout)
                                {{-- Direct Checkout Item Display --}}
                                <div class="flex items-center gap-4">
                                    <img src="{{ Storage::disk('s3')->url($cartItems->first()->product->thumbnail) }}" 
                                        alt="{{ $cartItems->first()->product->name }}" 
                                        class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $cartItems->first()->product->name }}</h3>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($cartItems->first()->start_date)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($cartItems->first()->end_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp {{ number_format($cartItems->first()->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @else
                                {{-- Cart Items Display --}}
                                @foreach($cartItems as $item)
                                <div class="flex items-center gap-4">
                                    <img src="{{ Storage::disk('s3')->url($item->product->thumbnail) }}" 
                                        alt="{{ $item->product->name }}" 
                                        class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $item->start_date->format('d M Y') }} - {{ $item->end_date->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp {{ number_format($item->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif

                            <div class="border-t border-gray-200 pt-4 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-gray-900 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tax (11%)</span>
                                    <span class="text-gray-900 font-medium">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t border-gray-200 pt-2">
                                    <div class="flex justify-between">
                                        <span class="text-base font-semibold text-gray-900">Total</span>
                                        <span class="text-base font-bold text-emerald-700">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="pt-5">
                                        <button type="button" id="pay-button"
                                            class="hover:cursor-pointer w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-slate-800 text-white hover:bg-slate-700 focus:outline-none focus:bg-slate-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                                            Bayar Sekarang
                                        </button>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript"
		src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
          // Also, use the embedId that you defined in the div above, here.
            window.snap.embed('{{ $orderData['snap_token'] }}', {
            embedId: 'snap-container',
                onSuccess: function (result) {
                    // Use AJAX to process the order
                    $.ajax({
                        url: '{{ route("checkout.process") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = response.redirect;
                            } else {
                                alert(response.message || 'Terjadi kesalahan saat memproses pesanan.');
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat memproses pesanan.';
                            try {
                                const response = JSON.parse(xhr.responseText);
                                errorMessage = response.message || errorMessage;
                            } catch (e) {
                                console.error('Error parsing response:', e);
                            }
                            alert(errorMessage);
                            console.error('Error details:', xhr.responseText);
                        }
                    });
                },
                onPending: function (result) {
                /* You may add your own implementation here */
                    alert("wating your payment!"); console.log(result);
                },
                onError: function (result) {
                /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                },
                onClose: function () {
                /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });
    </script>
@endpush
@endsection 

