<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LamaranController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            return response()->json([
                "lamaran" => $user->lamarans
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "lowongan_kerja_id" => "required|exists:lowongan_kerjas,id",
                "surat_lamaran" => "required|string|min:8"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "message" => "Validasi Error"
                ], 422);
            }

            $data = $validator->validate();
            $user = Auth::user();

            $lamaran = Lamaran::create([
                "user_id" => $user->id,
                "lowongan_kerja_id" => $data["lowongan_kerja_id"],
                "surat_lamaran" => $data["surat_lamaran"],
            ]);


            return response()->json([
                "message" => "lamaran berhasil dikirim"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error",
                "error" => $e->getMessage()
            ], 400);
        }
    }
    public function update(Request $request, $lamaran_id)
    {
        try {

            $validator = Validator::make($request->all(), [
                "surat_lamaran" => "required|string|min:8"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "message" => "Validasi Error"
                ], 422);
            }
            $lamaran = Lamaran::find($lamaran_id);
            $user = Auth::user();

            if (!$lamaran) {
                return response()->json([
                    "message" => "Lamaran tidak ditemukan",
                ], 404);
            }

            if ($lamaran->user_id !== $user->id) {
                return response()->json([
                    "message" => "Lamaran bukan milik anda",
                ], 403);
            }

            $data = $validator->validated();
            $lamaran->update($data);
            return response()->json([
                "message" => "Berhasil memperbarui lamaran"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error",
                "error" => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($lamaran_id)
    {
        try {
            $lamaran = Lamaran::find($lamaran_id);
            $user = Auth::user();
            if(!$lamaran){
                return response()->json([
                    "message" => "Lamaran tidak ditemukan"
                ], 404);
            };

            if($lamaran->user_id !== $user->id){
                return response()->json([
                    "message" => "Lamaran bukan milik Anda"
                ], 403);
            };

            $lamaran->delete();

            return response()->json([
                
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error",
                "error" => $e->getMessage()
            ], 400);
        }
    }
}
