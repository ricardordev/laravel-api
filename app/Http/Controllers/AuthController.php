<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Authenticate user and generate access token
     * Endpoint: POST /api/auth
     */
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Security check (avoids timing attacks)
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        // Delete previous tokens to keep only one active session at a time
        // $user->tokens()->delete();

        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
