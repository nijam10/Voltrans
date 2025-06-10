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
                            
                            {{-- Phone Number --}}
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="number" 
                                    id="phone_number" 
                                    name="phone_number" 
                                    placeholder="08xxxxxxxx"
                                    required
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
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

                            {{-- Address Form (Initially Hidden) --}}
                            <div id="addressForm" class="hidden space-y-4">
                                <div>
                                    <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                    <select id="province" name="province" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                    <select id="city" name="city" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="district" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                    <select id="district" name="district" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="village" class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
                                    <select id="village" name="village" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="address_detail" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                                    <textarea id="address_detail" 
                                        name="address_detail" 
                                        rows="3"
                                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                                </div>
                            </div>

                            {{-- Pickup Location --}}
                            <div id="pickupLocationForm" class="hidden">
                                <label for="pickup_location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Pengambilan</label>
                                <textarea id="pickup_location" 
                                    name="pickup_location" 
                                    required
                                    rows="3"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                                @error('pickup_location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Return Location --}}
                            <div>
                                <label for="return_location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Pengembalian</label>
                                <textarea id="return_location" 
                                    name="return_location" 
                                    required
                                    rows="3"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                                @error('return_location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                            @foreach($cartItems as $item)
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}" 
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

        // Initialize address selectors
        initializeAddressSelectors();

        // Form submission handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const isDelivery = document.getElementById('delivery_method_ship').checked;
            let deliveryLocation = '';
            
            if (isDelivery) {
                const province = document.getElementById('province');
                const city = document.getElementById('city');
                const district = document.getElementById('district');
                const village = document.getElementById('village');
                const addressDetail = document.getElementById('address_detail').value;

                // Validate required fields
                if (!province.value || !city.value || !district.value || !village.value || !addressDetail) {
                    alert('Mohon lengkapi semua data alamat pengiriman');
                    return;
                }
                
                deliveryLocation = JSON.stringify({
                    province: {
                        id: province.value,
                        name: province.options[province.selectedIndex].text
                    },
                    city: {
                        id: city.value,
                        name: city.options[city.selectedIndex].text
                    },
                    district: {
                        id: district.value,
                        name: district.options[district.selectedIndex].text
                    },
                    village: {
                        id: village.value,
                        name: village.options[village.selectedIndex].text
                    },
                    address_detail: addressDetail
                });
            } else {
                // For pickup at location, use a fixed company address
                deliveryLocation = "Ambil di Lokasi - Alamat Perusahaan";
            }
            
            // Set the delivery location value
            deliveryLocationInput.value = deliveryLocation;
            
            // Submit the form
            form.submit();
        });
    });

    // Address selectors initialization
    function initializeAddressSelectors() {
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');
        const districtSelect = document.getElementById('district');
        const villageSelect = document.getElementById('village');

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
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

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
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (cityId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`)
                    .then(response => response.json())
                    .then(districts => {
                        districts.forEach(district => {
                            const option = new Option(district.name, district.id);
                            districtSelect.add(option);
                        });
                    });
            }
        });

        // District change event
        districtSelect.addEventListener('change', function() {
            const districtId = this.value;
            villageSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (districtId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`)
                    .then(response => response.json())
                    .then(villages => {
                        villages.forEach(village => {
                            const option = new Option(village.name, village.id);
                            villageSelect.add(option);
                        });
                    });
            }
        });
    }

    function toggleAddressForm(isDelivery) {
        const addressForm = document.getElementById('addressForm');
        const pickupLocationForm = document.getElementById('pickupLocationForm');
        
        if (isDelivery) {
            addressForm.classList.remove('hidden');
            pickupLocationForm.classList.add('hidden');
            document.getElementById('pickup_location').removeAttribute('required');
            document.getElementById('province').setAttribute('required', '');
            document.getElementById('city').setAttribute('required', '');
            document.getElementById('district').setAttribute('required', '');
            document.getElementById('village').setAttribute('required', '');
            document.getElementById('address_detail').setAttribute('required', '');
        } else {
            addressForm.classList.add('hidden');
            pickupLocationForm.classList.add('hidden');
            document.getElementById('pickup_location').removeAttribute('required');
            document.getElementById('province').removeAttribute('required');
            document.getElementById('city').removeAttribute('required');
            document.getElementById('district').removeAttribute('required');
            document.getElementById('village').removeAttribute('required');
            document.getElementById('address_detail').removeAttribute('required');
        }
    }
</script>
@endpush

@endsection 