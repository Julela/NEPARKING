<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialliteController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();
    

        $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
