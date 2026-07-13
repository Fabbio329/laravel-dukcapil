<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Riwayat Pengajuan Saya</title>
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Riwayat Pengajuan Layanan Anda</h3>
        <a href="/warga/layanan/pilih" class="btn btn-secondary btn-sm">Ajukan Layanan Lain</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Layanan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan_warga as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->pelayanan->nama_layanan }}</td>
                        <td>{{ $p->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @if($p->status == 'pending')
                                <span class="badge bg-warning text-dark">Sedang Diperiksa Admin</span>
                            @elseif($p->status == 'disetujui')
                                <span class="badge bg-success">Disetujui / Selesai</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada riwayat pengajuan berkas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>