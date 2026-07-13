<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pilih Pelayanan</title>
</head>
<body class="container mt-5">
    <h3 class="mb-4">Pilih Jenis Pelayanan Dukcapil</h3>
    <div class="row">
        @foreach($layanan as $l)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $l->nama_layanan }}</h5>
                    <p class="card-text text-muted">Pengajuan berkas online resmi.</p>
                    <a href="/warga/layanan/upload/{{ $l->id }}" class="btn btn-primary w-100">Ajukan Sekarang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>