<?php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Return the response for a successful authentication.
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->intended('/admin');
        }

        // Default redirect for customers and any other roles
        return redirect()->intended('/');
    }
}
