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
                            <a href="{{ asset('storage/' . $file_path ?? $dok->file_path) }}" target="_blank" class="btn btn-xs btn-link p-0">Lihat File Bukti</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Validasi Keputusan Admin -->
    <div class="card p-4 mt-4 border-warning">
        <h5>Formulir Keputusan Validasi</h5>
        <form action="/admin/laporan/validasi/{{ $pengajuan->id }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Pilih Status Kelayakan Dokumen</label>
                <select name="status" class="form-select" required>
                    <option value="valid">VALID (Setujui & Siap Cetak)</option>
                    <option value="tidak_valid">TIDAK VALID (Tolak Dokumen)</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Catatan Admin (Alasan disetujui / ditolak)</label>
                <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: Berkas sesuai atau Berkas KK buram..."></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Simpan Keputusan Final</button>
        </form>
    </div>
</body>
</html>