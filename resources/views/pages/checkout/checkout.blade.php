@extends('layouts.app')
@section('title', 'Checkout')
@section('content')

<div class="py-24 bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Progress Steps --}}
        <div class="max-w-3xl mx-auto mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-600 text-white">
                        1
                    </div>
                    <div class="ml-2 text-sm font-medium text-emerald-600">Checkout</div>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200 mx-4"></div>
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 text-gray-600">
                        2
                    </div>
                    <div class="ml-2 text-sm font-medium text-gray-600">Pembayaran</div>
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
            {{-- Checkout Form --}}
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Pengiriman</h2>
                        
                        <form action="{{ route('checkout.payment') }}" method="POST" class="space-y-6" id="checkoutForm">
                            @csrf
                            <input type="hidden" name="delivery_location" id="deliveryLocationInput">
                            <input type="hidden" name="return_location" id="returnLocationInput">
                            
                            {{-- Phone Number --}}
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" 
                                    id="phone_number" 
                                    name="phone_number" 
                                    value="08"
                                    pattern="^08[0-9]{8,11}$"
                                    title="Nomor telepon harus dimulai dengan 08 dan diikuti 8-11 digit angka"
                                    required
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <p class="mt-1 text-sm text-gray-500">Format: 08xxxxxxxx (8-11 digit)</p>
                                @error('phone_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Order Method --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pengiriman</label>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="radio" 
                                            id="delivery_method_ship" 
                                            name="is_delivered" 
                                            value="1"
                                            class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        <label for="delivery_method_ship" class="ml-3 block text-sm font-medium text-gray-700">
                                            Kirim ke Alamat
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" 
                                            id="delivery_method_pickup" 
                                            name="is_delivered" 
                                            value="0"
                                            class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        <label for="delivery_method_pickup" class="ml-3 block text-sm font-medium text-gray-700">
                                            Ambil di Lokasi
                                        </label>
                                    </div>
                                </div>
                                @error('is_delivered')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Delivery Address Selection --}}
                            <div id="deliveryAddressSection" class="hidden space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                                    <div class="space-y-3">
                                        {{-- Existing Addresses --}}
                                        @if(auth()->user()->addresses->count() > 0)
                                            <div class="space-y-2">
                                                <p class="text-sm text-gray-600">Pilih alamat yang tersimpan:</p>
                                                @foreach(auth()->user()->addresses as $address)
                                                    <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-emerald-500 cursor-pointer address-option" data-address-id="{{ $address->id }}">
                                                        <input type="radio" 
                                                            name="delivery_address_type" 
                                                            value="existing_{{ $address->id }}" 
                                                            class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                                        <div class="ml-3 flex-1">
                                                            <p class="text-sm font-medium text-gray-900">{{ $address->name }}</p>
                                                            <p class="text-sm text-gray-600">{{ $address->address }}</p>
                                                            <p class="text-sm text-gray-500">{{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                                                        </div>
                                                        @if($address->is_default)
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                                Default
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        {{-- Add New Address Option --}}
                                        <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-emerald-500 cursor-pointer">
                                            <input type="radio" 
                                                name="delivery_address_type" 
                                                value="new" 
                                                id="new_delivery_address"
                                                class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                            <label for="new_delivery_address" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tambah Alamat Baru
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- New Address Form (Initially Hidden) --}}
                                <div id="newDeliveryAddressForm" class="hidden space-y-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                    <h4 class="text-sm font-medium text-gray-900">Alamat Baru</h4>
                                    <div>
                                        <label for="delivery_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Alamat</label>
                                        <input type="text" id="delivery_name" name="delivery_name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: Rumah, Kantor">
                                    </div>

                                    <div>
                                        <label for="delivery_province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                        <select id="delivery_province" name="delivery_province" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="delivery_city" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                        <select id="delivery_city" name="delivery_city" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="delivery_state" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                        <select id="delivery_state" name="delivery_state" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="delivery_address_detail" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                                        <textarea id="delivery_address_detail" name="delivery_address_detail" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Nama jalan, no. rumah, atau lokasi spesifik"></textarea>
                                    </div>

                                    <div>
                                        <label for="delivery_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                        <input type="text" id="delivery_postal_code" name="delivery_postal_code" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="12345">
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" id="save_delivery_address" name="save_delivery_address" class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        <label for="save_delivery_address" class="ml-2 block text-sm text-gray-700">
                                            Simpan alamat ini untuk penggunaan selanjutnya
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Pickup Location --}}
                            <div id="pickupLocationForm" class="hidden">
                                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Lokasi Pengambilan</h4>
                                    <p class="text-sm text-gray-600">
                                        Pengambilan akan dilakukan di alamat perusahaan kami. 
                                        Alamat lengkap akan dikirimkan melalui email setelah pembayaran berhasil.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-2">
                                        <strong>Catatan:</strong> Anda dapat memilih untuk mengembalikan kendaraan di lokasi yang sama atau alamat berbeda.
                                    </p>
                                </div>
                            </div>

                            {{-- Return Address Selection --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Pengembalian</label>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input type="radio" 
                                            id="return_same_as_shipping" 
                                            name="return_address_type" 
                                            value="same_as_shipping"
                                            class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        <label for="return_same_as_shipping" class="ml-3 block text-sm font-medium text-gray-700">
                                            Sama dengan metode pengiriman
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" 
                                            id="return_different" 
                                            name="return_address_type" 
                                            value="different"
                                            class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        <label for="return_different" class="ml-3 block text-sm font-medium text-gray-700">
                                            Alamat berbeda
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Different Return Address Form (Initially Hidden) --}}
                            <div id="differentReturnAddressForm" class="hidden space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Alamat Pengembalian</label>
                                    <div class="space-y-3">
                                        {{-- Existing Addresses for Return --}}
                                        @if(auth()->user()->addresses->count() > 0)
                                            <div class="space-y-2">
                                                <p class="text-sm text-gray-600">Pilih alamat yang tersimpan:</p>
                                                @foreach(auth()->user()->addresses as $address)
                                                    <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-emerald-500 cursor-pointer return-address-option" data-address-id="{{ $address->id }}">
                                                        <input type="radio" 
                                                            name="return_address_selection" 
                                                            value="existing_{{ $address->id }}" 
                                                            class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                                        <div class="ml-3 flex-1">
                                                            <p class="text-sm font-medium text-gray-900">{{ $address->name }}</p>
                                                            <p class="text-sm text-gray-600">{{ $address->address }}</p>
                                                            <p class="text-sm text-gray-500">{{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                                                        </div>
                                                        @if($address->is_default)
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                                Default
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        {{-- Add New Return Address Option --}}
                                        <div class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-emerald-500 cursor-pointer">
                                            <input type="radio" 
                                                name="return_address_selection" 
                                                value="new" 
                                                id="new_return_address"
                                                class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                            <label for="new_return_address" class="ml-3 block text-sm font-medium text-gray-700">
                                                Tambah Alamat Baru
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- New Return Address Form (Initially Hidden) --}}
                                <div id="newReturnAddressForm" class="hidden space-y-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                    <h4 class="text-sm font-medium text-gray-900">Alamat Pengembalian Baru</h4>
                                    <div>
                                        <label for="return_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Alamat</label>
                                        <input type="text" id="return_name" name="return_name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: Rumah, Kantor">
                                    </div>

                                    <div>
                                        <label for="return_province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                        <select id="return_province" name="return_province" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="return_city" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                        <select id="return_city" name="return_city" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="return_state" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                        <select id="return_state" name="return_state" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="return_address_detail" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                                        <textarea id="return_address_detail" name="return_address_detail" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Nama jalan, no. rumah, atau lokasi spesifik"></textarea>
                                    </div>

                                    <div>
                                        <label for="return_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                        <input type="text" id="return_postal_code" name="return_postal_code" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="12345">
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" id="save_return_address" name="save_return_address" class="h-4 w-4 border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        <label for="save_return_address" class="ml-2 block text-sm text-gray-700">
                                            Simpan alamat ini untuk penggunaan selanjutnya
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="hover:cursor-pointer py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                                    Lanjutkan ke Pembayaran
                                </button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkoutForm');
        const deliveryLocationInput = document.getElementById('deliveryLocationInput');
        const returnLocationInput = document.getElementById('returnLocationInput');
        const phoneInput = document.getElementById('phone_number');
        
        // Initialize form state
        const deliveryMethodShip = document.getElementById('delivery_method_ship');
        const deliveryMethodPickup = document.getElementById('delivery_method_pickup');
        
        if (deliveryMethodShip && deliveryMethodPickup) {
            // Set initial state
            toggleAddressForm(deliveryMethodShip.checked);
            
            // Add event listeners
            deliveryMethodShip.addEventListener('change', function() {
                toggleAddressForm(this.checked);
            });
            
            deliveryMethodPickup.addEventListener('change', function() {
                toggleAddressForm(!this.checked);
            });
        }

        // Initialize address selectors for new addresses
        initializeAddressSelectors('delivery');
        initializeAddressSelectors('return');

        // Phone number validation
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value;
            // Remove any non-digit characters
            value = value.replace(/\D/g, '');
            // Ensure it starts with 08
            if (value.length > 0 && !value.startsWith('08')) {
                value = '08' + value.substring(2);
            }
            // Limit to 13 digits (08 + 11 digits)
            value = value.substring(0, 13);
            e.target.value = value;
        });

        // Delivery address type change
        document.querySelectorAll('input[name="delivery_address_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'new') {
                    document.getElementById('newDeliveryAddressForm').classList.remove('hidden');
                } else {
                    document.getElementById('newDeliveryAddressForm').classList.add('hidden');
                }
            });
        });

        // Return address type change
        document.querySelectorAll('input[name="return_address_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'different') {
                    document.getElementById('differentReturnAddressForm').classList.remove('hidden');
                } else {
                    document.getElementById('differentReturnAddressForm').classList.add('hidden');
                }
            });
        });

        // Return address selection change
        document.querySelectorAll('input[name="return_address_selection"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'new') {
                    document.getElementById('newReturnAddressForm').classList.remove('hidden');
                } else {
                    document.getElementById('newReturnAddressForm').classList.add('hidden');
                }
            });
        });

        // Form submission handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate phone number
            const phoneNumber = phoneInput.value;
            if (!phoneNumber.match(/^08[0-9]{8,11}$/)) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Nomor telepon harus dimulai dengan 08 dan diikuti 8-11 digit angka',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            const isDelivery = document.getElementById('delivery_method_ship').checked;
            let deliveryLocation = '';
            let returnLocation = '';
            
            // Handle delivery location
            if (isDelivery) {
                const deliveryAddressType = document.querySelector('input[name="delivery_address_type"]:checked');
                if (!deliveryAddressType) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Pilih alamat pengiriman',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (deliveryAddressType.value === 'new') {
                    // Validate new delivery address
                    const requiredFields = ['delivery_name', 'delivery_province', 'delivery_city', 'delivery_state', 'delivery_address_detail', 'delivery_postal_code'];
                    for (let field of requiredFields) {
                        if (!document.getElementById(field).value) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Mohon lengkapi semua data alamat pengiriman',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                    }
                    
                    deliveryLocation = JSON.stringify({
                        type: 'new',
                        name: document.getElementById('delivery_name').value,
                        province: document.getElementById('delivery_province').value,
                        city: document.getElementById('delivery_city').value,
                        state: document.getElementById('delivery_state').value,
                        address_detail: document.getElementById('delivery_address_detail').value,
                        postal_code: document.getElementById('delivery_postal_code').value,
                        save_address: document.getElementById('save_delivery_address').checked
                    });
                } else {
                    // Use existing address
                    const addressId = deliveryAddressType.value.replace('existing_', '');
                    const addressElement = document.querySelector(`[data-address-id="${addressId}"]`);
                    const addressName = addressElement.querySelector('p:first-child').textContent;
                    const addressDetail = addressElement.querySelector('p:nth-child(2)').textContent;
                    const addressLocation = addressElement.querySelector('p:nth-child(3)').textContent;
                    
                    deliveryLocation = JSON.stringify({
                        type: 'existing',
                        address_id: addressId,
                        name: addressName,
                        address: addressDetail,
                        location: addressLocation
                    });
                }
            } else {
                // For pickup at location, use a fixed company address
                deliveryLocation = JSON.stringify({
                    type: 'pickup',
                    location: 'Ambil di Lokasi - Alamat Perusahaan'
                });
            }
            
            // Handle return location
            const returnAddressType = document.querySelector('input[name="return_address_type"]:checked');
            if (!returnAddressType) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Pilih lokasi pengembalian',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (returnAddressType.value === 'same_as_shipping') {
                returnLocation = JSON.stringify({
                    type: 'same_as_shipping'
                });
            } else if (returnAddressType.value === 'different') {
                const returnAddressSelection = document.querySelector('input[name="return_address_selection"]:checked');
                if (!returnAddressSelection) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Pilih alamat pengembalian',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (returnAddressSelection.value === 'new') {
                    // Validate new return address
                    const requiredFields = ['return_name', 'return_province', 'return_city', 'return_state', 'return_address_detail', 'return_postal_code'];
                    for (let field of requiredFields) {
                        if (!document.getElementById(field).value) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Mohon lengkapi semua data alamat pengembalian',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                    }
                    
                    returnLocation = JSON.stringify({
                        type: 'new',
                        name: document.getElementById('return_name').value,
                        province: document.getElementById('return_province').value,
                        city: document.getElementById('return_city').value,
                        state: document.getElementById('return_state').value,
                        address_detail: document.getElementById('return_address_detail').value,
                        postal_code: document.getElementById('return_postal_code').value,
                        save_address: document.getElementById('save_return_address').checked
                    });
                } else {
                    // Use existing address
                    const addressId = returnAddressSelection.value.replace('existing_', '');
                    const addressElement = document.querySelector(`.return-address-option[data-address-id="${addressId}"]`);
                    const addressName = addressElement.querySelector('p:first-child').textContent;
                    const addressDetail = addressElement.querySelector('p:nth-child(2)').textContent;
                    const addressLocation = addressElement.querySelector('p:nth-child(3)').textContent;
                    
                    returnLocation = JSON.stringify({
                        type: 'existing',
                        address_id: addressId,
                        name: addressName,
                        address: addressDetail,
                        location: addressLocation
                    });
                }
            }
            
            // Set the location values
            deliveryLocationInput.value = deliveryLocation;
            returnLocationInput.value = returnLocation;
            
            // Show loading and submit
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit the form
            form.submit();
        });
    });

    // Address selectors initialization
    function initializeAddressSelectors(type) {
        const provinceSelect = document.getElementById(`${type}_province`);
        const citySelect = document.getElementById(`${type}_city`);
        const stateSelect = document.getElementById(`${type}_state`);

        if (!provinceSelect) return;

        // Load provinces
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(provinces => {
                provinces.forEach(province => {
                    const option = new Option(province.name, province.id);
                    provinceSelect.add(option);
                });
            });

        // Province change event
        provinceSelect.addEventListener('change', function() {
            const provinceId = this.value;
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            stateSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            if (provinceId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                    .then(response => response.json())
                    .then(cities => {
                        cities.forEach(city => {
                            const option = new Option(city.name, city.id);
                            citySelect.add(option);
                        });
                    });
            }
        });

        // City change event
        citySelect.addEventListener('change', function() {
            const cityId = this.value;
            stateSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            if (cityId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`)
                    .then(response => response.json())
                    .then(districts => {
                        districts.forEach(district => {
                            const option = new Option(district.name, district.id);
                            stateSelect.add(option);
                        });
                    });
            }
        });
    }

    function toggleAddressForm(isDelivery) {
        const deliveryAddressSection = document.getElementById('deliveryAddressSection');
        const pickupLocationForm = document.getElementById('pickupLocationForm');
        
        if (isDelivery) {
            deliveryAddressSection.classList.remove('hidden');
            pickupLocationForm.classList.add('hidden');
        } else {
            deliveryAddressSection.classList.add('hidden');
            pickupLocationForm.classList.remove('hidden');
        }
    }
</script>
@endpush

@endsection 