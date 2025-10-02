<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LowonganKerjaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/pekerjaan', [LowonganKerjaController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/pekerjaan/lamar', [LamaranController::class, "store"]);
    Route::get('/lamaran', [LamaranController::class, "index"]);
    Route::post('/lamaran/{lamaran_id}', [LamaranController::class, "update"]);
    ROute::delete('/lamaran/{lamaran_id}', [LamaranController::class, 'destroy']);
});