<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response([
                'message' => '인증되지 않은 사용자 입니다'
            ]);
        };

        $user = Auth::user();

        $token = $user->createToken('access-token')->plainTextToken;

        // $cookie = cookie('jwt', $token, 60 * 24);

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function user()
    {
        return Auth::user();
    }
}
