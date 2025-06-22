<div>
    {{-- Trigger Button --}}
    <x-danger-button wire:click="openModal" wire:loading.attr="disabled">
        Batalkan Pesanan
    </x-danger-button>

    {{-- Modal --}}
    <x-dialog-modal wire:model.live="showModal">
        <x-slot name="title">
            {{ __('Batalkan Pesanan') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-4">
                    Anda yakin ingin membatalkan pesanan <strong>#{{ $order->order_code }}</strong>? 
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <div>
                    <x-label for="cancellation_reason" value="Alasan Pembatalan" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Pembatalan <span class="text-red-500">*</span>
                    </x-label>
                    <textarea 
                        id="cancellation_reason" 
                        wire:model="cancellation_reason"
                        rows="4" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        placeholder="Berikan alasan pembatalan pesanan..."
                        required></textarea>
                    <x-input-error for="cancellation_reason" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="cancelOrder" wire:loading.attr="disabled">
                {{ __('Konfirmasi Pembatalan') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
