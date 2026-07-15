<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemPelayananController;
use App\Http\Controllers\AuthController; 

// ==========================================
// RUTE UTAMA & BEBAS (OTOMATIS MENGALIHKAN SESUAI STATUS LOGIN)
// ==========================================
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/laporan');
        }
        return redirect('/warga/riwayat');
    }
    return redirect('/login');
});

// ==========================================
// RUTE KHUSUS TAMU (HANYA BISA DIAKSES JIKA BELUM LOGIN)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// ==========================================
// RUTE WAJIB LOGIN (WARGA & ADMIN)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    // ------------------------------------------
    // ALUR KHUSUS WARGA
    // ------------------------------------------
    Route::get('/warga/biodata', [SistemPelayananController::class, 'formBiodata']);
    Route::post('/warga/biodata', [SistemPelayananController::class, 'simpanBiodata']);

    Route::get('/warga/layanan/pilih', [SistemPelayananController::class, 'pilihLayanan']);

    Route::get('/warga/layanan/upload/{id}', [SistemPelayananController::class, 'formUpload']);
    Route::post('/warga/layanan/upload', [SistemPelayananController::class, 'simpanUpload']);

    Route::get('/warga/riwayat', [SistemPelayananController::class, 'riwayatWarga']);
    Route::get('/warga/cetak/{id}', [SistemPelayananController::class, 'cetakDokumen']); // Rute cetak warga

    // ------------------------------------------
    // ALUR KHUSUS ADMIN
    // ------------------------------------------
    Route::get('/admin/laporan', [SistemPelayananController::class, 'laporanAdmin']);
    Route::get('/admin/laporan/periksa/{id}', [SistemPelayananController::class, 'periksaData']);
    Route::post('/admin/laporan/validasi/{id}', [SistemPelayananController::class, 'simpanValidasi']);
    Route::get('/admin/laporan/cetak/{id}', [SistemPelayananController::class, 'cetakDokumen']); // Rute cetak admin
});