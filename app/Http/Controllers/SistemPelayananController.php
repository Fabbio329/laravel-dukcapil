<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class SistemPelayananController extends Controller
{
    // Halaman Laporan Sisi Warga
    public function indexWarga()
    {
        // Sementara kita kunci ke id user 2 (Simulasi warga yang login nanti)
        $simulasiWargaId = 2; 

        $pengajuan_warga = Pengajuan::with(['pelayanan', 'dokumen'])
                            ->where('user_id', $simulasiWargaId)
                            ->get();

        return view('warga.laporan', compact('pengajuan_warga'));
    }

    // Halaman Laporan Sisi Admin
    public function indexAdmin()
    {
        // Admin bisa melihat semua data pengajuan beserta biodata pengaju-nya
        $semua_pengajuan = Pengajuan::with(['user.biodata', 'pelayanan', 'dokumen'])->get();

        return view('admin.laporan', compact('semua_pengajuan'));
    }
}
