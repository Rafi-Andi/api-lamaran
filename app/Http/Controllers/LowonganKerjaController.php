<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerja;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class LowonganKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $lowongan = LowonganKerja::select('id', 'judul', 'deskripsi')->where('sedang_terbuka', 1)->get();

            return response()->json([
                "lowongan" => $lowongan
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LowonganKerja $lowonganKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LowonganKerja $lowonganKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LowonganKerja $lowonganKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LowonganKerja $lowonganKerja)
    {
        //
    }
}
