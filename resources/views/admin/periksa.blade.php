<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Pencocokan Berkas Warga</title>
</head>
<body class="container mt-5">
    <h2>Pencocokan & Validasi Berkas Layanan</h2>
    
    <div class="row mt-4">
        <!-- Kolom Kiri: Biodata Pengaju Akun -->
        <div class="col-md-6">
            <div class="card p-3 bg-light border-0 shadow-sm">
                <h4 class="fw-bold text-secondary"><i class="bi bi-person-fill"></i> Data Pengaju Akun</h4>
                <hr>
                <p><strong>NIK:</strong> {{ $pengajuan->user->biodata->nik ?? 'Belum diisi' }}</p>
                <p><strong>Nama:</strong> {{ $pengajuan->user->biodata->nama ?? 'Belum diisi' }}</p>
                <p><strong>Alamat:</strong> {{ $pengajuan->user->biodata->alamat ?? 'Belum diisi' }}</p>
                <p><strong>No HP:</strong> {{ $pengajuan->user->biodata->no_hp ?? 'Belum diisi' }}</p>
            </div>
        </div>

        <!-- Kolom Kanan: Dokumen Persyaratan & Subjek Pemohon Lain -->
        <div class="col-md-6">
            <div class="card p-3 bg-light border-0 shadow-sm">
                <h4 class="fw-bold text-secondary"><i class="bi bi-file-earmark-check-fill"></i> Berkas & Informasi Pemohon</h4>
                <hr>
                <ul class="list-group">
                    @foreach($pengajuan->dokumen as $dok)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="text-primary">{{ $dok->nama_syarat }}:</strong>
                            </div>
                            
                            <!-- DETEKSI APAKAH DOKUMEN MERUPAKAN TEKS ATAU FILE -->
                            @if(strpos($dok->file_path, 'text:') === 0)
                                <span class="badge bg-dark text-white px-3 py-2 fs-6">
                                    {{ substr($dok->file_path, 5) }}
                                </span>
                            @else
                                <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank" class="btn btn-sm btn-info text-white fw-bold">
                                    <i class="bi bi-eye"></i> Lihat Berkas
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Panel Validasi & Keputusan Admin -->
    <div class="card mt-4 border-primary shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Panel Validasi Berkas & Keputusan Admin
        </div>
        <div class="card-body text-center py-4">

            @if($pengajuan->status == 'pending')
                <p class="text-muted">Langkah 1: Periksa keabsahan fisik seluruh dokumen yang diunggah warga.</p>
                <form action="/admin/laporan/validasi/{{ $pengajuan->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="aksi" value="periksa_keabsahan">
                    
                    <button type="submit" name="keabsahan" value="sah" class="btn btn-info text-white me-2 px-4 fw-bold">
                        ✓ Berkas Sah (Lanjutkan Proses)
                    </button>
                    <button type="submit" name="keabsahan" value="tidak_sah" class="btn btn-danger px-4 fw-bold">
                        ✕ Berkas Tidak Sah (Otomatis Tolak)
                    </button>
                </form>

            @elseif($pengajuan->status == 'lolos_validasi')
                <div class="alert alert-info d-inline-block px-4">✓ Berkas dinyatakan Sah. Silakan tentukan keputusan final hukum pengajuan ini.</div>
                <form action="/admin/laporan/validasi/{{ $pengajuan->id }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="aksi" value="keputusan_final">
                    
                    <button type="submit" name="status_final" value="approved" class="btn btn-success me-2 px-4 fw-bold">
                        ✓ SETUJUI PENGAJUAN (SELESAI)
                    </button>
                    <button type="submit" name="status_final" value="rejected" class="btn btn-danger px-4 fw-bold">
                        ✕ TOLAK PENGAJUAN (FINAL)
                    </button>
                </form>
            @else
                <div class="alert alert-secondary d-inline-block px-4">Keputusan Final: <strong>{{ strtoupper($pengajuan->status) }}</strong></div>
            @endif

            @if($pengajuan->status == 'request_delete')
            <div class="alert alert-warning border-warning p-4 rounded shadow-sm my-4">
                <h5 class="fw-bold text-dark"><i class="bi bi-exclamation-triangle-fill"></i> Warga Mengajukan Penghapusan Dokumen</h5>
                <p class="text-muted small">Warga memohon agar pengajuan layanan ini dibatalkan dan seluruh berkas pendukungnya dihapus dari database.</p>
                
                <div class="d-flex gap-2 mt-3">
                    <!-- Form Setujui Hapus -->
                    <form action="/admin/laporan/pembatalan/{{ $pengajuan->id }}" method="POST" onsubmit="return confirm('PERINGATAN: Menyetujui akan menghapus data dan semua berkas fisik dari server secara permanen. Lanjutkan?')">
                        @csrf
                        <input type="hidden" name="keputusan" value="setujui">
                        <button type="submit" class="btn btn-danger fw-bold">
                            <i class="bi bi-check-circle"></i> Setujui & Hapus Permanen
                        </button>
                    </form>

                    <!-- Form Tolak Hapus -->
                    <form action="/admin/laporan/pembatalan/{{ $pengajuan->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="keputusan" value="tolak">
                        <button type="submit" class="btn btn-secondary fw-bold">
                            <i class="bi bi-x-circle"></i> Tolak Penghapusan (Tetap Proses)
                        </button>
                    </form>
                </div>
            </div>
        @endif

            <div class="mt-4">
                <a href="/admin/laporan" class="btn btn-outline-secondary btn-sm">Kembali ke Laporan</a>
            </div>
        </div>
    </div>
</body>
</html>