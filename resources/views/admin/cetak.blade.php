<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cetak Dokumen Resmi</title>
</head>
<body class="container mt-5 text-center" style="max-width: 600px; border: 2px solid black; padding: 30px;">
    <h3>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h3>
    <h6>SURAT KETERANGAN RESMI PELAYANAN</h6>
    <hr style="border-top: 3px double black;">
    
    <div class="text-start mt-4">
        <p>Menyatakan bahwa pengajuan pembuatan dokumen di bawah ini dinyatakan sah:</p>
        <table class="table table-borderless">
            <tr><td>Jenis Layanan</td><td>: <strong>{{ $pengajuan->pelayanan->nama_layanan }}</strong></td></tr>
            <tr><td>Nama Warga</td><td>: {{ $pengajuan->user->biodata->nama }}</td></tr>
            <tr><td>NIK</td><td>: {{ $pengajuan->user->biodata->nik }}</td></tr>
            <tr><td>Alamat</td><td>: {{ $pengajuan->user->biodata->alamat }}</td></tr>
        </table>
    </div>

    <button onclick="window.print()" class="btn btn-dark btn-sm mt-5 no-print">Klik untuk Cetak Lembar Dokumen</button>
</body>
</html>