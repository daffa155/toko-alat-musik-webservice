<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'data' => $user
        ], 201);
    }

    // LOGIN (JWT)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        ActivityLog::create([
            'user_id' => Auth::guard('api')->id(),
            'activity' => 'Login',
            'endpoint' => '/api/login',
            'method' => 'POST',
            'ip_address' => $request->ip()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'type' => 'bearer'
        ], 200);
    }

    // ME
    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    // LOGOUT
    public function logout(Request $request)
    {
        ActivityLog::create([
            'user_id' => Auth::guard('api')->id(),
            'activity' => 'Logout',
            'endpoint' => '/api/logout',
            'method' => 'POST',
            'ip_address' => $request->ip()
        ]);

        Auth::guard('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
