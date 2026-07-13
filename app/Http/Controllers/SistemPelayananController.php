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
    public function simpanUpload(Request $request)
{
    // 1. Buat 1 baris data pengajuan induk terlebih dahulu
    $pengajuan = \App\Models\Pengajuan::create([
        'user_id' => 2, // Mengunci sementara ke ID Warga Contoh hasil seeder Anda
        'pelayanan_id' => $request->pelayanan_id,
        'status' => 'pending'
    ]);

    // 2. Periksa apakah ada file berkas yang diunggah
    if ($request->hasFile('berkas')) {
        foreach ($request->file('berkas') as $nama_syarat => $file) {
            
            // Simpan fisik file ke folder: storage/app/public/dokumen_warga
            $path = $file->store('dokumen_warga', 'public');

            // Catat data jalurnya ke tabel dokumen_persyaratans
            \App\Models\DokumenPersyaratan::create([
                'pengajuan_id' => $pengajuan->id,
                'nama_syarat'  => ucwords(str_replace('_', ' ', $nama_syarat)), // Mengubah 'foto_ktp' jadi 'Foto Ktp'
                'file_path'    => $path
            ]);
        }
    }

    // 3. Setelah sukses, lempar warga ke dashboard admin untuk melihat laporan datanya
    // 3. Setelah sukses, alihkan warga ke halaman riwayat mereka sendiri
    return redirect('/warga/riwayat')->with('success', 'Berkas pengajuan berhasil dikirim!');
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

    public function riwayatWarga() 
{
    // Mengambil data pengajuan khusus untuk warga dengan user_id = 2
    $pengajuan_warga = \App\Models\Pengajuan::with(['pelayanan'])
                        ->where('user_id', 2)
                        ->get();

    return view('warga.riwayat', compact('pengajuan_warga'));
}

public function simpanValidasi(Request $request, $id)
{
    $pengajuan = \App\Models\Pengajuan::findOrFail($id);
    $aksi = $request->input('aksi');

    if ($aksi == 'periksa_keabsahan') {
        $keabsahan = $request->input('keabsahan');
        
        if ($keabsahan == 'tidak_sah') {
            // Jika tidak sah, langsung otomatis ditolak final
            $pengajuan->update(['status' => 'rejected']);
            return redirect('/admin/laporan')->with('error', 'Pengajuan otomatis ditolak karena berkas tidak sah.');
        } else {
            // Jika sah, status naik tingkat menjadi lolos validasi berkas
            $pengajuan->update(['status' => 'lolos_validasi']);
            return redirect()->back()->with('success', 'Berkas dinyatakan SAH. Silakan tentukan keputusan final.');
        }
    }

    if ($aksi == 'keputusan_final') {
        $status_final = $request->input('status_final'); // 'approved' atau 'rejected'
        $pengajuan->update(['status' => $status_final]);
        return redirect('/admin/laporan')->with('success', 'Keputusan final berhasil disimpan.');
    }
}
}