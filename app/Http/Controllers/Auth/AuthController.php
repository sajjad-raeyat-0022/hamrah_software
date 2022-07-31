<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialite_user = Socialite::driver($provider)->user();

        } catch (\Exception $ex) {
            return redirect()->route('login');
        }

        $user = User::where('email' , $socialite_user->getEmail())->first();
        if(!$user){
            $user = User::create([
                'name' => $socialite_user->getName(),
                'provider' => $provider,
                'avatar' => $socialite_user->getAvatar(),
                'email' => $socialite_user->getEmail(),
                'password' => Hash::make($socialite_user->getId()),
                'email_verified_at' => Carbon::now(),
            ]);
        }

        Auth::login($user , $remember = true);
        alert()->success('ورود شما موفقیت آمیز بود' , 'خوش آمدید')->persistent('باشه');
        return redirect()->route('index');
    }
}
