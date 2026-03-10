<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    

    public function  register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);
        $token = $user->createToken('evolt-token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $les_infos = $request->validated();
        if (!auth()->attempt($les_infos)) {
            return response()->json([
                'error' => 'Invalid email or password'
            ], 401);
        }
        $user = $request->user();
        $token = $user->createToken('evolt-token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }
}
