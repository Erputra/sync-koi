<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Metode untuk mendaftarkan pengguna
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'client_password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        if ($request->client_password !== env('CLIENT_PASSWORD')) {
            return $this->errorResponse('Unauthorized', 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Membuat token untuk pengguna baru
        $token = $user->createToken('MyApp')->plainTextToken;

        return $this->successResponse(['token' => $token], 'User registered successfully', 201);
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
            return $this->validationErrorResponse($validator->errors());
        }

        // Mencari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Memverifikasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Unauthorized', 401);
        }

        // Membuat token untuk pengguna yang berhasil login
        $token = $user->createToken('MyApp')->plainTextToken;

        return $this->successResponse(['token' => $token], 'User registered successfully', 200);
    }
}
