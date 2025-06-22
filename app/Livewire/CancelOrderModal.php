<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CancelOrderModal extends Component
{
    public Order $order;
    public $showModal = false;
    public $cancellation_reason = '';

    protected $rules = [
        'cancellation_reason' => 'required|string|min:10|max:500',
    ];

    protected $messages = [
        'cancellation_reason.required' => 'Alasan pembatalan wajib diisi.',
        'cancellation_reason.min' => 'Alasan pembatalan minimal 10 karakter.',
        'cancellation_reason.max' => 'Alasan pembatalan maksimal 500 karakter.',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        
        // Ensure user can only cancel their own orders
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->cancellation_reason = '';
        $this->resetValidation();
    }

    public function cancelOrder()
    {
        $this->validate();

        try {
            $this->order->update([
                'status' => 'dibatalkan',
                'cancellation_reason' => $this->cancellation_reason,
                'cancelled_at' => now(),
            ]);

            $this->closeModal();
            
            session()->flash('success', 'Pesanan berhasil dibatalkan.');
            
            return redirect()->route('user.orders.show', $this->order);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat membatalkan pesanan.');
        }
    }

    public function render()
    {
        return view('livewire.cancel-order-modal');
    }
}
