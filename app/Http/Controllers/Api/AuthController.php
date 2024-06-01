<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $mensaje = ['Password incorrect for: ' . $request->username];
            return $this->sendError($mensaje, 401);
        }

        $user->last_login = now();
        $user->save();

        $data = [
            'token' => $user->createToken($request->username)->plainTextToken,
            'minutes_to_expire' => intval(env('SANCTUM_EXPIRATION', 120)),
        ];
        return $this->sendSuccess($data, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
