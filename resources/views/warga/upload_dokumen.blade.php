<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Upload Persyaratan</title>
</head>
<body class="container mt-5" style="max-width: 600px;">
    <h2>Upload Dokumen Syarat Pembuatan: {{ $layanan->nama_layanan }}</h2>
    
    <form action="/warga/layanan/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Mengirim ID Layanan secara tersembunyi -->
    <input type="hidden" name="pelayanan_id" value="{{ $layanan->id }}">

    <div class="mb-3">
        <label class="form-label">Upload Foto / Scan KTP Pemohon</label>
        <input type="file" name="berkas[foto_ktp]" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Upload Surat Pengantar RT/RW (Berkas Asli)</label>
        <input type="file" name="berkas[surat_pengantar]" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Upload Foto Kartu Keluarga Pendukung</label>
        <input type="file" name="berkas[kk_pendukung]" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Kirim Berkas Pengajuan</button>
</form>
</body>
</html>