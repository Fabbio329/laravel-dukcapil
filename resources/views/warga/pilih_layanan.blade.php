@extends('layouts.warga')

@section('content')
<h3 class="fw-bold text-secondary mb-4">Pilih Jenis Pelayanan Dukcapil</h3>

<div class="row">
    @foreach($layanan as $l)
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center d-flex flex-column justify-content-between p-4">
                <div>
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-file-earmark-text fs-3"></i>
                    </div>
                    <h5 class="card-title fw-bold text-dark">{{ $l->nama_layanan }}</h5>
                    <p class="card-text text-muted small">Layanan resmi pembuatan dokumen kependudukan secara digital.</p>
                </div>
                <a href="/warga/layanan/upload/{{ $l->id }}" class="btn btn-primary w-100 mt-3 fw-bold">Ajukan Sekarang</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection