<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddressModal extends Component
{
    public $showModal = false;
    public $name = '';
    public $address = '';
    public $province = '';
    public $city = '';
    public $state = '';
    public $postal_code = '';
    public $is_default = false;
    public $addressCount = 0;
    public $editing = false;
    public $editId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'province' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'postal_code' => 'required|string|max:20',
        'is_default' => 'boolean',
    ];

    protected $listeners = ['save', 'deleteAddress', 'edit'];


    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->addressCount = $user->addresses()->count();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);

        $this->editId = $id;
        $this->name = $address->name;
        $this->address = $address->address;
        $this->province = $address->province;
        $this->state = $address->state;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->postal_code = $address->postal_code;
        $this->is_default = $address->is_default;
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($this->editing && $this->editId) {
            $address = Address::findOrFail($this->editId);
            $address->update([
                'name' => $this->name,
                'address' => $this->address,
                'province' => $this->province,
                'city' => $this->city,
                'state' => $this->state,
                'postal_code' => $this->postal_code,
                'is_default' => $this->is_default,
            ]);
            if ($this->is_default) {
                $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            }
            session()->flash('success', 'Alamat berhasil diupdate.');
        } else {
            $address = $user->addresses()->create([
                'name' => $this->name,
                'address' => $this->address,
                'province' => $this->province,
                'state' => $this->state,
                'city' => $this->city,
                'postal_code' => $this->postal_code,
                'is_default' => $this->is_default,
            ]);
            if ($this->is_default) {
                $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            }
            session()->flash('success', 'Alamat berhasil ditambah.');
        }
        $this->addressCount = $user->addresses()->count();
        $this->closeModal();
        return redirect()->route('user.addresses.index');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->address = '';
        $this->province = '';
        $this->city = '';
        $this->state = '';
        $this->postal_code = '';
        $this->is_default = false;
        $this->editing = false;
        $this->editId = null;
    }

    public function render()
    {
        return view('livewire.address-modal');
    }
}
