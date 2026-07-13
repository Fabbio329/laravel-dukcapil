<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemPelayananController;

// --- ALUR UTAMA WARGA ---
// 1. Pengisian Biodata
Route::get('/', function () { return redirect('/warga/biodata'); });
Route::get('/warga/biodata', [SistemPelayananController::class, 'formBiodata']);
Route::post('/warga/biodata', [SistemPelayananController::class, 'simpanBiodata']);

// 2. Pemilihan Jenis Layanan
Route::get('/warga/layanan/pilih', [SistemPelayananController::class, 'pilihLayanan']);

// 3. Pengunggahan Dokumen Persyaratan
Route::get('/warga/layanan/upload/{id}', [SistemPelayananController::class, 'formUpload']);
Route::post('/warga/layanan/upload', [SistemPelayananController::class, 'simpanUpload']);


// --- PANEL UTAMA ADMIN ---
// 1. Halaman Utama Laporan Dokumen Masuk
Route::get('/admin/laporan', [SistemPelayananController::class, 'laporanAdmin']);

// 2. Proses Periksa & Cocokkan Data
Route::get('/admin/laporan/periksa/{id}', [SistemPelayananController::class, 'periksaData']);

// 3. Proses Cetak Dokumen
Route::get('/admin/laporan/cetak/{id}', [SistemPelayananController::class, 'cetakDokumen']);