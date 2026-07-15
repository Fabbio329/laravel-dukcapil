<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Warga - Sistem Pelayanan Dukcapil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 450px;
            margin-top: 5% !important;
            margin-bottom: 5%;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card shadow register-container w-100">
        <div class="card-body p-4">
            <h3 class="text-center mb-2 fw-bold text-primary">Daftar Akun</h3>
            <p class="text-center text-muted mb-4 text-sm">Buat akun untuk pengajuan layanan mandiri online</p>

            <form action="/register" method="POST">
                @csrf
                
                <!-- Box Penampil Error Validasi -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Akun Utama -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <hr class="my-4">
                <h5 class="fw-bold text-secondary mb-3">Data Kependudukan (Biodata)</h5>

                <!-- Biodata Tambahan -->
                <div class="mb-3">
                    <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" placeholder="16 digit angka" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Maksimal 15 digit" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Rumah</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Daftar Akun Baru</button>
            </form>

            <div class="text-center border-top pt-3">
                <span class="text-muted small">Sudah punya akun?</span>
                <a href="/login" class="small text-decoration-none fw-bold">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>