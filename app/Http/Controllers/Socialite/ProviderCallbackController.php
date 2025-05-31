<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(String $provider)
    {
        if (!in_array($provider, ['google'])) {
            return redirect(route('login'))->withErrors(['provider' => 'Invalid provider']);
        }
        
        $socialUser = Socialite::driver($provider)->user();


        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider_name' => $socialUser->name,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token,
            'provider_refresh_token' => $socialUser->refreshToken,
        ]);
    
        Auth::login($user);
    
        return redirect(route('home'));
    }
}
