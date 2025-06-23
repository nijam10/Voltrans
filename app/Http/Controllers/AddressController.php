<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $addresses = $user->addresses()->orderBy('is_default', 'desc')->get();
        $canAddAddress = $addresses->count() < 3;
        return view('profile.addresses.index', compact('addresses', 'canAddAddress'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'is_default' => 'boolean',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $address = $user->addresses()->create($validated);

        if ($request->is_default) {
            $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        return redirect()->route('profile.addresses.index')->with('success', 'Address added successfully.');
    }

    public function update(Request $request, Address $address)
    {
        $this->authorize('update', $address);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'is_default' => 'boolean',
        ]);

        $address->update($validated);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($request->is_default) {
            $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }


        return redirect()->route('user.addresses.index')->with('success', 'Alamat berhasil diupdate.');
    }

    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();
        return redirect()->route('user.addresses.index')->with('deleted', 'Alamat berhasil dihapus');
    }
} 