<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemPelayananController;

// Jalur simulasi dashboard warga
Route::get('/warga/laporan', [SistemPelayananController::class, 'indexWarga']);

// Jalur simulasi dashboard admin
Route::get('/admin/laporan', [SistemPelayananController::class, 'indexAdmin']);
Route::get('/', function () {
    return view('welcome');
});
