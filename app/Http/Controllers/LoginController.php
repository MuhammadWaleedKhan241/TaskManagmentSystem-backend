<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $user = Auth::user();

            $token = $user->createToken('YourAppName')->accessToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }
    }
}
