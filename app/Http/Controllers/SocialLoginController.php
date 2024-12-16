<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    //social redirect
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    //social callback
    public function callback($provider){
        $providerUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $providerUser->email,
        ],[
            'name' => $providerUser->name,
            'nickname' => $providerUser->nickname,
            'email' => $providerUser->email,
            'provider' => $provider,
            'provider_id' => $providerUser->id,
            'provider_token' => $providerUser->token,
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect('user#home');
    }
}
