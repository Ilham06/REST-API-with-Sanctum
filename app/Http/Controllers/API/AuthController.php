<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'User Tidak Ditemukan'
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
                'message'   => 'success',
                'user'      => $user,
                'token'      => $token,
            ]);

    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
                'message'   => 'Logout Berhasil'
            ]);
    }
}
