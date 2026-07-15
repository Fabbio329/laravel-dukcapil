@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-secondary">Daftar Dokumen Masuk untuk Validasi (Admin)</h3>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama Warga (NIK)</th>
                        <th>Layanan yang Diminta</th>
                        <th>Status Validasi</th>
                        <th style="width: 15%">Aksi Sistem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semua_pengajuan as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $p->user->biodata->nama ?? $p->user->name }}</strong>
                            <br>
                            <small class="text-muted">NIK: {{ $p->user->biodata->nik ?? '-' }}</small>
                        </td>
                        <td><span class="badge bg-secondary px-2 py-1">{{ $p->pelayanan->nama_layanan }}</span></td>
                        <td>
                            @if($p->status == 'pending')
                                <span class="badge bg-warning text-dark">Belum Diperiksa</span>
                            @elseif($p->status == 'lolos_validasi')
                                <span class="badge bg-info text-white">Lolos Validasi (Sah)</span>
                            @elseif($p->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/laporan/periksa/{{ $p->id }}" class="btn btn-sm btn-primary fw-bold">
                                <i class="bi bi-search"></i> Periksa
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada dokumen masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection