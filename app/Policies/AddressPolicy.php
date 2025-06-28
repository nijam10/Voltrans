<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Address $address)
    {
        // Allow admin users (users with admin role or super admin) to update any address
        if ($user->role === 'admin') {
            return true;
        }
        
        // Regular users can only update their own addresses
        return $user->id === $address->user_id;
    }

    public function delete(User $user, Address $address)
    {
        // Allow admin users to delete any address
        if ($user->role === 'admin') {
            return true;
        }
        
        // Regular users can only delete their own addresses
        return $user->id === $address->user_id;
    }
} 