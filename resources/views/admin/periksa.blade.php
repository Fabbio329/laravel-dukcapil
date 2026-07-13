<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pencocokan Berkas Warga</title>
</head>
<body class="container mt-5">
    <h2>Pencocokan & Validasi Berkas Layanan</h2>
    
    <div class="row mt-4">
        <!-- Kolom Kiri: Biodata Warga -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h4>Data Biodata Warga</h4>
                <hr>
                <p><strong>NIK:</strong> {{ $pengajuan->user->biodata->nik }}</p>
                <p><strong>Nama:</strong> {{ $pengajuan->user->biodata->nama }}</p>
                <p><strong>Alamat:</strong> {{ $pengajuan->user->biodata->alamat }}</p>
                <p><strong>No HP:</strong> {{ $pengajuan->user->biodata->no_hp }}</p>
            </div>
        </div>

        <!-- Kolom Kanan: Dokumen Persyaratan -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h4>Dokumen Persyaratan yang Diunggah</h4>
                <hr>
                <ul>
                    @foreach($pengajuan->dokumen as $dok)
                        <li class="mb-2">
                            <strong>{{ $dok->nama_syarat }} :</strong> 
                            <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank" class="btn btn-xs btn-link p-0">
    Lihat Dokumen
</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="card mt-4 border-primary">
    <div class="card-header bg-light">
        <strong>Panel Validasi Berkas & Keputusan Admin</strong>
    </div>
    <div class="card-body text-center">

        <!-- LANGKAH 1: JIKA STATUS MASIH PENDING (BARU MASUK) -->
        @if($pengajuan->status == 'pending')
            <p class="text-muted">Langkah 1: Periksa keabsahan fisik seluruh dokumen yang diunggah warga.</p>
            <form action="/admin/laporan/validasi/{{ $pengajuan->id }}" method="POST">
                @csrf
                <input type="hidden" name="aksi" value="periksa_keabsahan">
                
                <button type="submit" name="keabsahan" value="sah" class="btn btn-info text-white me-2 px-4">
                    ✓ Berkas Sah (Lanjutkan Proses)
                </button>
                <button type="submit" name="keabsahan" value="tidak_sah" class="btn btn-danger px-4">
                    ✕ Berkas Tidak Sah (Otomatis Tolak)
                </button>
            </form>

        <!-- LANGKAH 2: JIKA BERKAS SUDAH SAH, TAPI BELUM ADA KEPUTUSAN FINAL -->
        @elseif($pengajuan->status == 'lolos_validasi')
            <div class="alert alert-info d-inline-block px-4">✓ Berkas dinyatakan Sah. Silakan tentukan keputusan final hukum pengajuan ini.</div>
            <form action="/admin/laporan/validasi/{{ $pengajuan->id }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="aksi" value="keputusan_final">
                
                <button type="submit" name="status_final" value="approved" class="btn btn-success me-2 px-4">
                    ✓ SETUJUI PENGAJUAN (SELESAI)
                </button>
                <button type="submit" name="status_final" value="rejected" class="btn btn-danger px-4">
                    ✕ TOLAK PENGAJUAN (FINAL)
                </button>
            </form>
        @endif

    </div>
</div>
</div>
</body>
</html>