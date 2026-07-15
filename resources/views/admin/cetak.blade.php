<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Dokumen - {{ $pengajuan->pelayanan->nama_layanan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: "Times New Roman", Times, serif;
            color: black;
        }
        .kop-surat {
            border-bottom: 5px double black;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }
        .institusi-logo {
            width: 90px;
            height: auto;
        }
        .isi-surat {
            font-size: 12pt;
            line-height: 1.6;
            text-align: justify;
        }
        .table-data td {
            padding: 4px 8px;
            border: none !important;
        }
        .tanda-tangan {
            margin-top: 50px;
            float: right;
            text-align: center;
            width: 250px;
        }
        /* Sembunyikan tombol cetak saat proses print berlangsung */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                margin: 2cm;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container my-4" style="max-width: 800px;">
    
    <!-- Tombol Navigasi Sementara (Hanya tampil di browser, tidak ikut tercetak) -->
    <div class="no-print mb-4 d-flex justify-content-between">
        <button onclick="window.history.back()" class="btn btn-secondary">
            ← Kembali
        </button>
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak Manual
        </button>
    </div>

    <!-- KOP SURAT -->
    <div class="kop-surat d-flex align-items-center justify-content-center text-center">
        <!-- Anda bisa mengganti logo ini dengan logo daerah Anda -->
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/df/Coat_of_arms_of_Indonesia_Garuda_Pancasila.svg" class="institusi-logo me-4" alt="Logo Negara">
        <div>
            <h5 class="fw-bold m-0" style="font-size: 14pt;">PEMERINTAH KABUPATEN / KOTA ADMINISTRASI</h5>
            <h4 class="fw-bold m-0" style="font-size: 16pt; letter-spacing: 1px;">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h4>
            <p class="m-0 text-muted" style="font-size: 10pt; font-style: italic;">Jl. Raya Protokol No. 123, Telp: (021) 123456, Email: disdukcapil@pemerintah.go.id</p>
        </div>
    </div>

    <!-- ISI SURAT -->
    <div class="isi-surat">
        <h5 class="text-center fw-bold text-decoration-underline mb-1">SURAT KETERANGAN LAYANAN</h5>
        <p class="text-center text-muted mb-4">Nomor: {{ 100 + $pengajuan->id }}/DKPS/{{ date('Y') }}</p>

        <p class="mb-3">Yang bertanda tangan di bawah ini, Kepala Dinas Kependudukan dan Pencatatan Sipil menerangkan dengan sebenarnya bahwa:</p>

        <table class="table table-data mb-4" style="max-width: 90%;">
            <tr>
                <td style="width: 30%;">Nama Lengkap</td>
                <td style="width: 3%;">:</td>
                <td><strong>{{ $pengajuan->user->biodata->nama ?? $pengajuan->user->name }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $pengajuan->user->biodata->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Nomor Handphone</td>
                <td>:</td>
                <td>{{ $pengajuan->user->biodata->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat Tinggal</td>
                <td>:</td>
                <td>{{ $pengajuan->user->biodata->alamat ?? '-' }}</td>
            </tr>
        </table>

        <p class="mb-4">Telah mengajukan permohonan layanan kependudukan berupa <strong>"{{ $pengajuan->pelayanan->nama_layanan }}"</strong> pada tanggal <strong>{{ $pengajuan->created_at->format('d M Y') }}</strong> melalui sistem pelayanan mandiri online.</p>

        <p class="mb-4">Berdasarkan hasil verifikasi dan pemeriksaan berkas yang dilakukan oleh tim admin verifikator, dokumen persyaratan dinyatakan <strong>SAH DAN VALID</strong> dengan status keputusan final:</p>
        
        <div class="p-3 text-center mb-4 bg-light border rounded">
            <h4 class="fw-bold text-success m-0">DISETUJUI / SELESAI</h4>
        </div>

        <p>Demikian surat keterangan ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <!-- TANDA TANGAN -->
    <div class="row">
        <div class="col-12">
            <div class="tanda-tangan">
                <p class="mb-1">Ditetapkan di: Admin Pusat</p>
                <p class="mb-5">Pada Tanggal: {{ date('d F Y') }}</p>
                <p class="m-0 fw-bold text-decoration-underline">KEPALA DINAS DUKCAPIL</p>
                <small class="text-muted">NIP. 19820415 200501 1 002</small>
            </div>
        </div>
    </div>

</div>

</body>
</html>