<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function redirect(){
        return Socialite::driver('github')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            ['email' => $user->getEmail()],
            ['password' => Hash::make(Str::random(24)),'name'=>$user->getNickname()]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
