@extends('layouts.warga')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-secondary">Riwayat Pengajuan Layanan Anda</h3>
    <a href="/warga/layanan/pilih" class="btn btn-primary fw-bold"><i class="bi bi-plus-lg"></i> Ajukan Layanan Lain</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Jenis Layanan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Dokumen</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse($pengajuan_warga as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $p->pelayanan->nama_layanan }}</strong></td>
                        <td>{{ $p->created_at->format('d M Y H:i') }} WIB</td>
                        <td>
                            @if($p->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu Pemeriksaan</span>
                            @elseif($p->status == 'lolos_validasi')
                                <span class="badge bg-info text-white">Lolos Validasi (Sah)</span>
                            @elseif($p->status == 'approved')
                                <span class="badge bg-success">Disetujui / Selesai</span>
                            @elseif($p->status == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif($p->status == 'request_delete')
                                <span class="badge bg-dark">Menunggu Persetujuan Hapus</span>
                            @else
                                <span class="badge bg-secondary">{{ $p->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($p->status == 'approved')
                                <a href="/warga/cetak/{{ $p->id }}" target="_blank" class="btn btn-sm btn-success fw-bold">
                                    <i class="bi bi-printer"></i> Cetak Dokumen
                                </a>
                            @elseif($p->status == 'pending' || $p->status == 'lolos_validasi')
                                <!-- Tombol Minta Batal/Hapus -->
                                <form action="/warga/riwayat/batal/{{ $p->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan/menghapus pengajuan ini?')" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-bold">
                                        <i class="bi bi-trash"></i> Ajukan Batal
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-light text-muted fw-bold" disabled>
                                    <i class="bi bi-lock-fill"></i> Terkunci
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Anda belum memiliki riwayat pengajuan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection