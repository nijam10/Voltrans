<div>
    {{-- Trigger Button --}}
    <x-button wire:click="openModal" wire:loading.attr="disabled">
        Tambah
    </x-button>
    
    {{-- Modal --}}
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            Tambah Alamat
        </x-slot>

        <x-slot name="content">
            <form id="addressForm" wire:submit.prevent="save" class="space-y-4">
                <div>
                    <x-label for="name" value="Nama Alamat" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div>
                    <x-label for="address" value="Alamat Lengkap" />
                    <textarea id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" wire:model.defer="address"></textarea>
                    <x-input-error for="address" class="mt-2" />
                </div>
                <div>
                    <x-label for="province" value="Provinsi" />
                    <x-input id="province" type="text" class="mt-1 block w-full" wire:model.defer="province" />
                    <x-input-error for="province" class="mt-2" />
                </div>
                <div>
                    <x-label for="city" value="Kota/Kabupaten" />
                    <x-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="city" />
                    <x-input-error for="city" class="mt-2" />
                </div>
                <div>
                    <x-label for="state" value="Kecamatan" />
                    <x-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="state" />
                    <x-input-error for="state" class="mt-2" />
                </div>
                <div>
                    <x-label for="postal_code" value="Kode Pos" />
                    <x-input id="postal_code" type="number" class="mt-1 block w-full" wire:model.defer="postal_code" />
                    <x-input-error for="postal_code" class="mt-2" />
                </div>
                <div class="flex items-center">
                    <input id="is_default" type="checkbox" wire:model.defer="is_default" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                    <label for="is_default" class="ml-2 block text-sm text-gray-900">Jadikan sebagai alamat utama</label>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>
            <x-button class="ml-3" type="submit" form="addressForm">
                Simpan
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>


