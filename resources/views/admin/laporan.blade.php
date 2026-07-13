<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel Laporan Admin</title>
</head>
<body class="container mt-5">
    <h3 class="mb-4">Daftar Dokumen Masuk untuk Validasi (Admin)</h3>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 30%">Nama Warga (NIK)</th>
                    <th style="width: 25%">Layanan yang Diminta</th>
                    <th style="width: 20%">Status Validasi</th>
                    <th style="width: 20%">Aksi Sistem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($semua_pengajuan as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $data->user->biodata->nama ?? 'Belum Mengisi Biodata' }} 
                        <span class="text-muted small">({{ $data->user->biodata->nik ?? '-' }})</span>
                    </td>
                    <td>{{ $data->pelayanan->nama_layanan }}</td>
                    <td>
                        @if($data->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending (Menunggu)</span>
                        @elseif($data->status == 'lolos_validasi')
                            <span class="badge bg-info text-white">Berkas Sah (Butuh Persetujuan)</span>
                        @elseif($data->status == 'approved' || $data->status == 'disetujui')
                            <span class="badge bg-success">Disetujui / Selesai</span>
                        @elseif($data->status == 'rejected' || $data->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">{{ $data->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if($data->status == 'pending' || $data->status == 'lolos_validasi')
                            <a href="/admin/laporan/periksa/{{ $data->id }}" class="btn btn-sm btn-warning fw-bold text-dark">
                                Periksa & Cocokkan Data
                            </a>
                        @else
                            <span class="text-muted small"><i class="bi bi-check-circle"></i> Selesai Diproses</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada dokumen masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>