@props(['order'])

<div id="cancelModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Batalkan Pesanan</h3>
            <form action="{{ route('user.orders.cancel', $order) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <x-label for="cancellation_reason" value="Alasan Pembatalan" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Pembatalan <span class="text-red-500">*</span>
                    </x-label>
                    <textarea 
                        id="cancellation_reason" 
                        name="cancellation_reason" 
                        rows="4" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        placeholder="Berikan alasan pembatalan pesanan..."
                        required></textarea>
                </div>
                <div class="flex gap-3 justify-end">
                    <x-secondary-button type="button" onclick="closeCancelModal()">
                        Batal
                    </x-secondary-button>
                    <x-danger-button type="submit">
                        Konfirmasi Pembatalan
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</div> 