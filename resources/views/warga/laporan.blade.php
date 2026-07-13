<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laporan Warga</title>
</head>
<body class="container mt-5">
    <h3>Status Pengajuan Pelayanan Saya (Warga)</h3>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Jenis Pelayanan</th>
                <th>Dokumen Persyaratan yang Diunggah</th>
                <th>Status Berkas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuan_warga as $data)
            <tr>
                <!-- Kolom 1: Nama Layanan -->
                <td>{{ $data->pelayanan->nama_layanan }}</td>
                
                <!-- Kolom 2: Daftar Dokumen -->
                <td>
                    <ul>
                        @foreach($data->dokumen as $dok)
                            <li>{{ $dok->nama_syarat }}</li>
                        @endforeach
                    </ul>
                </td>
                
                <!-- Kolom 3: Status -->
                <td>
                    @if($data->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($data->status == 'valid')
                        <span class="badge bg-success">Valid</span>
                    @else
                        <span class="badge bg-danger">Tidak Valid</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Anda belum mengajukan pelayanan apapun.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>