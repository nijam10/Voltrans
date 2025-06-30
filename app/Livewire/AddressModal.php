<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;

class AddressModal extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $name = '';
    public $address = '';
    public $province = '';
    public $city = '';
    public $state = '';
    public $postal_code = '';
    public $is_default = false;
    public $ktp_image;
    public $addressCount = 0;
    public $editing = false;
    public $editId = null;
    public $requiresKtp = false;
    public $maxAddressesReached = false;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string|max:20',
            'is_default' => 'boolean',
        ];

        // Only require KTP if this is the first address or if user wants to verify this address
        if ($this->requiresKtp) {
            $rules['ktp_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'name.required' => 'Nama penerima wajib diisi.',
            'name.string' => 'Nama penerima harus berupa teks.',
            'name.max' => 'Nama penerima tidak boleh lebih dari 255 karakter.',
            
            'address.required' => 'Alamat lengkap wajib diisi.',
            'address.string' => 'Alamat lengkap harus berupa teks.',
            
            'province.required' => 'Provinsi wajib dipilih.',
            'province.string' => 'Provinsi harus berupa teks.',
            
            'city.required' => 'Kota wajib dipilih.',
            'city.string' => 'Kota harus berupa teks.',
            
            'state.required' => 'Kecamatan wajib dipilih.',
            'state.string' => 'Kecamatan harus berupa teks.',
            
            'postal_code.required' => 'Kode pos wajib diisi.',
            'postal_code.string' => 'Kode pos harus berupa teks.',
            'postal_code.max' => 'Kode pos tidak boleh lebih dari 20 karakter.',
            
            'is_default.boolean' => 'Status alamat default harus berupa benar atau salah.',
            
            'ktp_image.required' => 'Foto KTP wajib diunggah.',
            'ktp_image.image' => 'File yang diunggah harus berupa gambar.',
            'ktp_image.mimes' => 'Format file harus JPEG, PNG, atau JPG.',
            'ktp_image.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ];
    }

    protected $listeners = ['save', 'deleteAddress', 'edit'];

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->addressCount = $user->addresses()->count();
        $this->checkAddressLimits();
    }

    public function checkAddressLimits()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->addressCount = $user->addresses()->count();
        $this->maxAddressesReached = $this->addressCount >= 3;
        
        // Determine if KTP is required
        $hasVerifiedAddress = $user->addresses()->where('is_verified', true)->exists();
        $hasRejectedAddress = $user->addresses()->where('is_verified', false)->whereNotNull('rejection_reason')->exists();
        
        // KTP required when no verified address exists OR when there's a rejected address that can be resubmitted
        $this->requiresKtp = !$hasVerifiedAddress || $hasRejectedAddress;
    }

    public function openModal()
    {
        $this->checkAddressLimits();
        
        if ($this->maxAddressesReached) {
            session()->flash('error', 'Anda telah mencapai batas maksimal 3 alamat.');
            return;
        }
        
        $this->resetForm();
        $this->checkAddressLimits(); // Re-check after reset to set requiresKtp correctly
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
        $this->postal_code = $address->postal_code;
        $this->is_default = $address->is_default;
        $this->editing = true;
        $this->requiresKtp = false; // KTP not required for editing
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $ktpPath = null;
        $isVerified = false;

        // Check if this is a new address and if we need to verify it
        if (!$this->editing) {
            $hasVerifiedAddress = $user->addresses()->where('is_verified', true)->exists();
            
            // If this is the first address or user wants to verify this address
            if ($this->requiresKtp && $this->ktp_image) {
                $ktpPath = $this->ktp_image->store('ktp', 'public');
                $isVerified = false; // Will be verified by admin later
            }
        }

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
                'city' => $this->city,
                'state' => $this->state,
                'postal_code' => $this->postal_code,
                'is_default' => $this->is_default,
                'ktp_path' => $ktpPath,
                'is_verified' => $isVerified,
            ]);
            if ($this->is_default) {
                $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            }
            
            if ($this->requiresKtp && $ktpPath) {
                session()->flash('success', 'Alamat berhasil ditambah.');
            } else {
                session()->flash('success', 'Alamat berhasil ditambah.');
            }
        }

        $this->checkAddressLimits();
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
        $this->ktp_image = null;
    }

    public function render()
    {
        return view('livewire.address-modal');
    }
}
