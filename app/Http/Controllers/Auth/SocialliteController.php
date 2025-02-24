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
    
    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            $registeredUser = User::where("google_id", $socialUser->id)->first();
    
            if (!$registeredUser) {
                $user = User::updateOrCreate([
                    'google_id' => $socialUser->id,
                ], [
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'google_token' => $socialUser->token,
                    'password' => bcrypt('default_password'),
                    'google_refresh_token' => $socialUser->refreshToken,
                ]);
    
                Auth::login($user);
            } else {
                Auth::login($registeredUser);
            }
    
            session()->flash('welcome_back', 'Hai, ' . Auth::user()->name . '.');
    
            return redirect('/')->with('success', 'Login berhasil!');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google!');
        }
    }
    
}
