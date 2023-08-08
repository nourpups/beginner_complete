<?php

namespace App\Http\Controllers\ApiPractice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials))
        {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ]
                ]
            ], 422);
        }
        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken
        ]);
    }

}
