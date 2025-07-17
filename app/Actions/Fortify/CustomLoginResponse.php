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

        // Determine redirect URL based on role
        $redirectUrl = ($user->role === 'admin') ? url('/admin') : url('/');

        // If the request expects JSON (AJAX), return JSON with redirect URL
        if ($request->wantsJson() || $request->expectsJson()) {
            return response()->json([
                'message' => 'Login berhasil',
                'redirect' => $redirectUrl,
            ]);
        }

        // Otherwise, do a normal redirect
        return redirect()->intended($redirectUrl);
    }
}
