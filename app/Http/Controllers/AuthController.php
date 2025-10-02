<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string",
                "email" => "required|string|email|unique:users",
                "password" => "required|string"
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();

                if (in_array("The email has already been taken.", $errors->get('email'))) {
                    return response()->json([
                        "message" => "Email sudah digunakan",
                    ], 422);
                };
                return response()->json([
                    "message" => "Validasi error",
                ], 422);
            }

            $data = $validator->validated();

            $user = User::create([
                "name" => $data['name'],
                "email" => $data['email'],
                "password" => Hash::make($data['password'])
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "message" => "Pengguna berhasil terdaftar",
                "token" => $token
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error",
                "error" => $e
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => "required|string"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "message" => "Validasi Error"
                ], 422);
            };

            $data = $validator->validated();
            if (!Auth::attempt($data)) {
                return response()->json([
                    "message" => "Email atau password salah"
                ], 422);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "message" => "Berhasil login",
                "token" => $token
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error",
                "error" => $e
            ], 500);
        }
    }
}
