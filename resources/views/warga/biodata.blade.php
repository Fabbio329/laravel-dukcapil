@extends('layouts.warga')

@section('content')
<h3 class="fw-bold text-secondary mb-3">Biodata Pribadi Pengaju</h3>
<p class="text-muted">Lengkapi data pribadi Anda di bawah ini sebelum mulai mengajukan pelayanan.</p>

<div class="card border-0 shadow-sm" style="max-width: 650px;">
    <div class="card-body p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="/warga/biodata" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">NIK (16 Digit)</label>
                <input type="text" name="nik" class="form-control" maxlength="16" value="{{ $biodata->nik ?? '' }}" required placeholder="Masukkan 16 digit NIK">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ $biodata->nama ?? '' }}" required placeholder="Nama lengkap sesuai KTP">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Alamat Rumah</label>
                <textarea name="alamat" class="form-control" rows="3" required placeholder="Alamat lengkap RT/RW/Kecamatan">{{ $biodata->alamat ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">No HP Aktif</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $biodata->no_hp ?? '' }}" required placeholder="Contoh: 0812xxxxxxxx">
            </div>
            
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                <i class="bi bi-save me-1"></i> Simpan & Perbarui Data
            </button>
        </form>
    </div>
</div>
@endsection