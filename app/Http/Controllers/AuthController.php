<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;
    // Metode untuk mendaftarkan pengguna
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuid' => 'required|string|max:255|unique:users',
            'device_name' => 'required|string|max:255',
            'client_password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        if ($request->client_password !== env('CLIENT_PASSWORD')) {
            Log::debug(env('CLIENT_PASSWORD'));
            return $this->errorResponse('Unauthorized', 401);
        }

        $user = User::create([
            'uuid' => $request->uuid,
            'device_name' => $request->device_name,
            'password' => Hash::make($request->uuid),
        ]);

        // Membuat token untuk pengguna baru
        $token = $user->createToken('MyApp')->plainTextToken;

        return $this->successResponse([
            'uuid' => $request->uuid,
            'device_name' => $request->device_name,
            'token' => $token], 'Device registered successfully', 201, 1);
    }

    // Metode untuk login pengguna
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'uuid' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // Mencari pengguna berdasarkan email
        $user = User::where('uuid', $request->uuid)->first();

        // Memverifikasi password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Unauthorized', 401);
        }

        // $token = $user->createToken(
        //                 'MyApp', ['*'], now()->addMinutes(1)
        //             )->plainTextToken;
        $token = $user->createToken('MyApp', ['*'])->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        return $this->successResponse(['token' => $token], 'Device verified', 200, 1);
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $newToken = $user->createToken('MyApp')->plainTextToken;
        return $this->successResponse(['token' => $token], 'Token has been refreshed', 200, 1);
    }
}
