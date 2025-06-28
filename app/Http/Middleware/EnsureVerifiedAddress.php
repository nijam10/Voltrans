<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureVerifiedAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $verifiedAddress = $user->addresses()->where('is_verified', true)->first();
        
        if (!$verifiedAddress) {
            return redirect()->route('user.addresses.index')
                ->with('error', 'Anda harus menambahkan dan memverifikasi alamat terlebih dahulu sebelum dapat melakukan checkout. Silakan tambahkan alamat di profil Anda.');
        }

        return $next($request);
    }
} 