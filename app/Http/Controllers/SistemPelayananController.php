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
    // Mengambil profil warga yang login beserta biodatanya secara pasti
    $biodata = Biodata::where('user_id', auth()->id())->firstOrFail();
    return view('warga.biodata', compact('biodata'));
    }

    // Simpan/Update Biodata
    // Simpan/Update Biodata
    public function simpanBiodata(Request $request)
    {
        $request->validate([
            'nik'    => 'required|numeric|digits:16',
            'nama'   => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:15', // Batasi maksimal 15 karakter sesuai struktur DB
        ]);

        Biodata::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'nik'    => $request->nik,
                'nama'   => $request->nama,
                'alamat' => $request->alamat,
                'no_hp'  => $request->no_hp,
            ]
        );

        return redirect('/warga/layanan/pilih')->with('success', 'Biodata berhasil diperbarui.');
    }

    // Tampilkan Pilihan Layanan
    public function pilihLayanan() {
        $layanan = Pelayanan::all();
        return view('warga.pilih_layanan', compact('layanan'));
    }

    // Form Upload sesuai jenis layanan
    public function formUpload($id) {
        $layanan = Pelayanan::findOrFail($id);
        return view('warga.upload_dokumen', compact('layanan'));
    }

    // Menyimpan berkas fisik & data tekstual dinamis
    public function simpanUpload(Request $request)
    {
        $request->validate([
            'pelayanan_id' => 'required|exists:pelayanans,id',
        ]);

        // 1. Buat data pengajuan induk
        $pengajuan = Pengajuan::create([
            'user_id'      => auth()->id(),
            'pelayanan_id' => $request->pelayanan_id,
            'status'       => 'pending'
        ]);

        // 2. Simpan identitas pemohon alternatif (jika diisi untuk anak / anggota keluarga lain)
        if ($request->has('pemohon_alternatif')) {
            foreach ($request->input('pemohon_alternatif') as $key => $nilai) {
                if (!empty($nilai)) {
                    DokumenPersyaratan::create([
                        'pengajuan_id' => $pengajuan->id,
                        'nama_syarat'  => ucwords(str_replace('_', ' ', $key)),
                        'file_path'    => 'text:' . $nilai // Gunakan prefix 'text:' untuk membedakan teks dengan file
                    ]);
                }
            }
        }

        // 3. Simpan berkas dokumen pendukung
        if ($request->hasFile('berkas')) {
            foreach ($request->file('berkas') as $nama_syarat => $file) {
                $path = $file->store('dokumen_warga', 'public');

                DokumenPersyaratan::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_syarat'  => ucwords(str_replace('_', ' ', $nama_syarat)),
                    'file_path'    => $path
                ]);
            }
        }

        return redirect('/warga/riwayat')->with('success', 'Berkas pengajuan berhasil dikirim!');
    }

    // Riwayat Pengajuan Warga Aktif
    public function riwayatWarga() 
    {
        // Mengambil data milik warga yang sedang login secara dinamis
        $pengajuan_warga = Pengajuan::with(['pelayanan', 'dokumen'])
                            ->where('user_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('warga.riwayat', compact('pengajuan_warga'));
    }

    // Dashboard Admin
    public function laporanAdmin() {
        $semua_pengajuan = Pengajuan::with(['user.biodata', 'pelayanan'])->get();
        return view('admin.laporan', compact('semua_pengajuan'));
    }

    // Pemeriksaan oleh Admin
    public function periksaData($id) {
        $pengajuan = Pengajuan::with(['user.biodata', 'dokumen', 'pelayanan'])->findOrFail($id);
        return view('admin.periksa', compact('pengajuan'));
    }

    // Validasi Admin
    public function simpanValidasi(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $aksi = $request->input('aksi');

        if ($aksi == 'periksa_keabsahan') {
            $keabsahan = $request->input('keabsahan');
            
            if ($keabsahan == 'tidak_sah') {
                $pengajuan->update(['status' => 'rejected']);
                return redirect('/admin/laporan')->with('error', 'Pengajuan otomatis ditolak karena berkas tidak sah.');
            } else {
                $pengajuan->update(['status' => 'lolos_validasi']);
                return redirect()->back()->with('success', 'Berkas dinyatakan SAH. Silakan tentukan keputusan final.');
            }
        }

        if ($aksi == 'keputusan_final') {
            $status_final = $request->input('status_final');
            $pengajuan->update(['status' => $status_final]);
            return redirect('/admin/laporan')->with('success', 'Keputusan final berhasil disimpan.');
        }
    }

    // Cetak Dokumen
    public function cetakDokumen($id) {
        $pengajuan = Pengajuan::with(['user.biodata', 'pelayanan', 'dokumen'])->findOrFail($id);
        return view('admin.cetak', compact('pengajuan'));
    }
}