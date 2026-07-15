@extends('layouts.warga')

@section('content')
<h3 class="fw-bold text-secondary mb-4">Upload Persyaratan Pengajuan</h3>

<div class="card border-0 shadow-sm" style="max-width: 700px;">
    <div class="card-header bg-dark text-white p-3">
        <h5 class="m-0 fw-bold">Formulir Layanan: {{ $layanan->nama_layanan }}</h5>
    </div>
    <div class="card-body p-4">
        <form action="/warga/layanan/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pelayanan_id" value="{{ $layanan->id }}">

            @php
                $layanan_lower = strtolower($layanan->nama_layanan);
            @endphp

            <!-- ========================================== -->
            <!-- 1. DETEKSI DOKUMEN: AKTA KELAHIRAN -->
            <!-- ========================================== -->
            @if(str_contains($layanan_lower, 'akta') || str_contains($layanan_lower, 'lahir'))
                <!-- Identitas Anak -->
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person-fill-add"></i> Identitas Anak / Subjek Akta</h5>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Lengkap Anak</label>
                        <input type="text" name="pemohon_alternatif[nama_anak]" class="form-control" placeholder="Nama lengkap bayi" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">NIK Anak / No. Surat Keterangan Lahir</label>
                        <input type="text" name="pemohon_alternatif[nik_anak_atau_no_surat]" class="form-control" placeholder="NIK atau No Surat Lahir dari RS" required>
                    </div>
                </div>

                <hr class="my-4">
                
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-earmark-arrow-up"></i> Berkas Persyaratan Akta Lahir</h5>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Surat Keterangan Lahir (Dari RS / Bidan)</label>
                    <input type="file" name="berkas[surat_keterangan_lahir]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Buku Nikah / Akta Perkawinan Orang Tua</label>
                    <input type="file" name="berkas[buku_nikah_orang_tua]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Kartu Keluarga (KK) Orang Tua</label>
                    <input type="file" name="berkas[scan_kk_orang_tua]" class="form-control" required>
                </div>

            <!-- ========================================== -->
            <!-- 2. DETEKSI DOKUMEN: KARTU TANDA PENDUDUK (KTP) -->
            <!-- ========================================== -->
            @elseif(str_contains($layanan_lower, 'ktp') || str_contains($layanan_lower, 'penduduk'))
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-person-bounding-box"></i> Identitas Pemohon KTP</h5>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Lengkap Pemohon</label>
                        <input type="text" name="pemohon_alternatif[nama_pemohon]" class="form-control" placeholder="Isi jika untuk anak/orang lain (kosongkan jika diri sendiri)">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">NIK Pemohon</label>
                        <input type="text" name="pemohon_alternatif[nik_pemohon]" class="form-control" maxlength="16" placeholder="Isi jika mendaftarkan orang lain">
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-earmark-arrow-up"></i> Berkas Persyaratan KTP</h5>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Scan Kartu Keluarga (KK) Aktif</label>
                    <input type="file" name="berkas[kartu_keluarga]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Pas Foto Terbaru (Latar Merah / Biru)</label>
                    <input type="file" name="berkas[pas_foto_terbaru]" class="form-control" required>
                </div>

            <!-- ========================================== -->
            <!-- 3. DETEKSI DOKUMEN: KARTU KELUARGA (KK) -->
            <!-- ========================================== -->
            @elseif(str_contains($layanan_lower, 'kk') || str_contains($layanan_lower, 'keluarga'))
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-earmark-arrow-up"></i> Berkas Persyaratan Kartu Keluarga</h5>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Kartu Keluarga (KK) Lama / Surat Kehilangan dari Polsek</label>
                    <input type="file" name="berkas[kk_lama_atau_kehilangan]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Surat Pengantar RT / RW</label>
                    <input type="file" name="berkas[surat_pengantar_rt_rw]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Buku Nikah / Akta Cerai (Pendukung)</label>
                    <input type="file" name="berkas[buku_nikah_atau_cerai]" class="form-control" required>
                </div>

            <!-- ========================================== -->
            <!-- 4. LAYANAN UMUM / FALLBACK -->
            <!-- ========================================== -->
            @else
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-earmark-arrow-up"></i> Berkas Persyaratan Umum</h5>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Scan KTP Pemohon</label>
                    <input type="file" name="berkas[foto_ktp]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Surat Pengantar RT/RW (Berkas Asli)</label>
                    <input type="file" name="berkas[surat_pengantar]" class="form-control" required>
                </div>
                <div class="mb-3 p-3 bg-light border rounded">
                    <label class="form-label fw-bold">Kartu Keluarga (KK) Pendukung</label>
                    <input type="file" name="berkas[kk_pendukung]" class="form-control" required>
                </div>
            @endif

            <div class="d-flex justify-content-between mt-4 border-top pt-3">
                <a href="/warga/layanan/pilih" class="btn btn-light border fw-bold">&larr; Kembali</a>
                <button type="submit" class="btn btn-success px-4 fw-bold">Kirim Berkas</button>
            </div>
        </form>
    </div>
</div>
@endsection