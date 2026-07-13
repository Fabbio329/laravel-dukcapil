<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel Laporan Admin</title>
</head>
<body class="container mt-5">
    <h3>Daftar Dokumen Masuk untuk Validasi (Admin)</h3>
    <table class="table table-bordered mt-3">
        <thead class="table-primary">
            <tr>
                <th>Nama Warga (NIK)</th>
                <th>Layanan yang Diminta</th>
                <th>Status Validasi</th>
                <th>Aksi Sistem</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semua_pengajuan as $data)
            <tr>
                <td>{{ $data->user->biodata->nama ?? 'Belum Mengisi Biodata' }} ({{ $data->user->biodata->nik ?? '-' }})</td>
                <td>{{ $data->pelayanan->nama_layanan }}</td>
                <td>
                    @if($data->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($data->status == 'valid')
                        <span class="badge bg-success">Valid</span>
                    @else
                        <span class="badge bg-danger">Tidak Valid</span>
                    @endif
                </td>
                <!-- DI SINI TOMBOL AKSENYA BERADA -->
                <td>
                    <a href="/admin/laporan/periksa/{{ $data->id }}" class="btn btn-sm btn-warning">Periksa & Cocokkan Data</a>
                    
                    @if($data->status == 'valid')
                        <a href="/admin/laporan/cetak/{{ $data->id }}" target="_blank" class="btn btn-sm btn-success">Cetak Dokumen</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada berkas pelayanan yang masuk dari warga.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>