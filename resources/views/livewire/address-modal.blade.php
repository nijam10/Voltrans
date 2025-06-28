<div>
    {{-- Trigger Button --}}
    <x-button wire:click="openModal" wire:loading.attr="disabled">
        Tambah
    </x-button>

    {{-- Modal --}}
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ $editing ? 'Edit Alamat' : 'Tambah Alamat' }}
        </x-slot>

        <x-slot name="content">
            <form id="addressForm" wire:submit.prevent="save" class="space-y-6">
                {{-- Nama Alamat --}}
                <div class="space-y-1">
                    <x-label for="name" value="Nama Alamat" />
                    <x-input id="name" type="text" class="pl-form-input w-full" wire:model.defer="name" />
                    <x-input-error for="name" class="mt-1 text-sm text-red-600" />
                </div>
            
                {{-- Alamat Lengkap --}}
                <div class="space-y-1">
                    <x-label for="address" value="Alamat Lengkap" />
                    <textarea id="address" rows="3" class="w-full border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-xs" wire:model.defer="address"></textarea>
                    <x-input-error for="address" class="mt-1 text-sm text-red-600" />
                </div>
            
                {{-- Provinsi, Kota, Kecamatan --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <x-label for="province" value="Provinsi" />
                        <x-input id="province" type="text" class="pl-form-input w-full" wire:model.defer="province" />
                        <x-input-error for="province" class="mt-1 text-sm text-red-600" />
                    </div>
            
                    <div class="space-y-1">
                        <x-label for="city" value="Kota/Kabupaten" />
                        <x-input id="city" type="text" class="pl-form-input w-full" wire:model.defer="city" />
                        <x-input-error for="city" class="mt-1 text-sm text-red-600" />
                    </div>
            
                    <div class="space-y-1">
                        <x-label for="state" value="Kecamatan" />
                        <x-input id="state" type="text" class="pl-form-input w-full" wire:model.defer="state" />
                        <x-input-error for="state" class="mt-1 text-sm text-red-600" />
                    </div>
                </div>
            
                {{-- Kode Pos --}}
                <div class="space-y-1">
                    <x-label for="postal_code" value="Kode Pos" />
                    <x-input id="postal_code" type="number" class="pl-form-input w-full" wire:model.defer="postal_code" />
                    <x-input-error for="postal_code" class="mt-1 text-sm text-red-600" />
                </div>
            
                {{-- Upload KTP - Only show for first address or when verification is needed --}}
                @if ($requiresKtp && !$editing)
                    <div class="space-y-2" x-data>
                        <x-label for="ktp_image" value="Upload KTP (jpg/png, max 2MB)" />
                        
                        @php
                            $user = Auth::user();
                            $hasRejectedAddress = $user->addresses()->where('is_verified', false)->whereNotNull('rejection_reason')->exists();
                        @endphp
                        
                        @if($hasRejectedAddress)
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 mb-3">
                                <p class="text-sm text-orange-800">
                                    <strong>Resubmission KTP:</strong> Anda memiliki alamat yang ditolak. 
                                    Upload KTP baru untuk mengajukan ulang verifikasi alamat.
                                </p>
                            </div>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                                <p class="text-sm text-blue-800">
                                    <strong>Verifikasi KTP:</strong> Alamat ini akan diverifikasi dengan KTP Anda. 
                                    Hanya satu alamat yang dapat diverifikasi per akun.
                                </p>
                            </div>
                        @endif
                        
                        <div
                            class="hs-file-upload relative overflow-hidden flex flex-col items-center justify-center px-4 py-8 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gradient-to-br from-purple-100 via-white to-blue-100 text-center"
                            data-hs-file-upload='{
                                "target": "#ktp-upload-preview",
                                "allowPreview": true
                            }'>
                            <input type="file"
                                id="ktp_image"
                                wire:model="ktp_image"
                                accept="image/jpeg, image/png"
                                class="absolute inset-0 opacity-0 cursor-pointer z-20" />
                            <div class="z-10">
                                <svg class="mx-auto mb-2 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16l4 4 4-4m0-8l-4-4-4 4m4 4v12" />
                                </svg>
                                <p class="text-sm text-gray-600">Drop file atau klik untuk unggah</p>
                                <p class="text-xs text-gray-400">Max 2MB. Format: JPG / PNG.</p>
                            </div>
                        </div>
            
                        <div wire:loading wire:target="ktp_image" class="mt-2 text-teal-600 text-sm">
                            Mengunggah KTP...
                        </div>
            
                        @if ($ktp_image)
                            <div class="mt-3">
                                <p class="text-sm text-gray-700 mb-1">Preview:</p>
                                <img src="{{ $ktp_image->temporaryUrl() }}" alt="Preview KTP" class="w-40 rounded-lg shadow border" />
                            </div>
                        @endif
            
                        <x-input-error for="ktp_image" class="mt-1 text-sm text-red-600" />
                    </div>
                @elseif (!$editing)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                        <p class="text-sm text-gray-700">
                            <strong>Alamat Tambahan:</strong> Alamat ini akan ditambahkan tanpa verifikasi KTP. 
                            Anda dapat memiliki maksimal 3 alamat (termasuk 1 alamat terverifikasi).
                        </p>
                    </div>
                @endif
            
                {{-- Checkbox alamat utama --}}
                <div class="flex items-center space-x-2">
                    <input id="is_default" type="checkbox" wire:model.defer="is_default"
                        class="form-checkbox text-green-600 focus:ring-green-500 border-gray-300 rounded" />
                    <label for="is_default" class="text-sm text-gray-800">Jadikan sebagai alamat utama</label>
                </div>
            </form>            
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>
            <x-button class="ml-3" type="submit" form="addressForm" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Simpan</span>
                <span wire:loading wire:target="save">
                    <svg class="animate-spin h-4 w-4 mr-1 inline-block text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Memproses...
                </span>
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
