<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    //social redirect
    public function redirect($provider){

        try {
            return Socialite::driver($provider)
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    //social callback
    public function callback($provider){
        $providerUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $providerUser->email,
        ],[
            'name' => $providerUser->name,
            'nickname' => $providerUser->nickname,
            'password' => Hash::make($providerUser->password),
            'email' => $providerUser->email,
            'provider' => $provider,
            'provider_id' => $providerUser->id,
            'provider_token' => $providerUser->token,
            'role' => 'user'
        ]);

        Auth::login($user);

        return to_route('user#home');
    }
}
