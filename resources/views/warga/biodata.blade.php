<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Isi Biodata Warga</title>
</head>
<body class="container mt-5" style="max-width: 600px;">
    <h2>Formulir Biodata Warga Awal</h2>
    <p class="text-muted">Silakan lengkapi biodata Anda terlebih dahulu sebelum mengajukan pelayanan.</p>
    
    <form action="/warga/biodata" method="POST">
    @csrf <!-- WAJIB ADA: Tanpa ini, input akan menghasilkan error 419 Page Expired -->
    
    <div class="mb-3">
        <label>NIK (16 Digit)</label>
        <input type="text" name="nik" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Alamat Rumah</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>No HP Aktif</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Simpan & Lanjutkan</button>
</form>
</body>
</html>