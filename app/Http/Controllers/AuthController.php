<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Metode untuk mendaftarkan pengguna
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'client_password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->client_password !== env('CLIENT_PASSWORD')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Membuat token untuk pengguna baru
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    // Metode untuk login pengguna
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mencari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Memverifikasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Membuat token untuk pengguna yang berhasil login
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
