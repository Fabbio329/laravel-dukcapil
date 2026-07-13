<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\Pelayanan;
use App\Models\Pengajuan;
use App\Models\DokumenPersyaratan;

class SistemPelayananController extends Controller
{
    // Tampilkan Form Biodata
    public function formBiodata() {
        return view('warga.biodata');
    }

    // Simpan Biodata & Lempar ke Pilih Layanan
    public function simpanBiodata(Request $request)
{
    // 1. Ambil data input secara langsung
    $nik = $request->input('nik');
    $nama = $request->input('nama');
    $alamat = $request->input('alamat');
    $no_hp = $request->input('no_hp');

    // 2. Simpan paksa menggunakan Model Eloquent
    \App\Models\Biodata::create([
        'user_id' => 2, // Mengunci sementara ke ID warga contoh hasil seeder Anda
        'nik'     => $nik,
        'nama'    => $nama,
        'alamat'  => $alamat,
        'no_hp'   => $no_hp,
    ]);

    // 3. Alihkan halaman ke menu Pilih Layanan
    return redirect('/warga/layanan/pilih');
}

    // Tampilkan Pilihan Layanan (KTP, KK, Akta)
    public function pilihLayanan() {
        $layanan = Pelayanan::all();
        return view('warga.pilih_layanan', compact('layanan'));
    }

    // Tampilkan Form Upload Berdasarkan Layanan yang Dipilih
    public function formUpload($id) {
        $layanan = Pelayanan::findOrFail($id);
        return view('warga.upload_dokumen', compact('layanan'));
    }

    // Simpan File ke Folder Storage & Catat ke Database
    public function simpanUpload(Request $request) {
        $pengajuan = Pengajuan::create([
            'user_id' => 2,
            'pelayanan_id' => $request->pelayanan_id,
            'status' => 'pending'
        ]);

        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $nama_form => $file) {
                $path = $file->store('dokumen_warga', 'public');
                DokumenPersyaratan::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_syarat' => $nama_form,
                    'file_path' => $path
                ]);
            }
        }

        return redirect('/warga/biodata')->with('success', 'Berkas berhasil dikirim ke Admin!');
    }

    // Halaman Dashboard Utama Admin
    public function laporanAdmin() {
        $semua_pengajuan = Pengajuan::with(['user.biodata', 'pelayanan'])->get();
        return view('admin.laporan', compact('semua_pengajuan'));
    }

    // Halaman Pemeriksaan Dokumen Warga oleh Admin
    public function periksaData($id) {
        $pengajuan = Pengajuan::with(['user.biodata', 'dokumen'])->findOrFail($id);
        return view('admin.periksa', compact('pengajuan'));
    }
}