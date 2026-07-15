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

                <!-- Input Nama Lengkap -->
                <div class="mb-3">
                    <label for="name" class="form-label text-secondary small fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama sesuai KTP" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary small fw-bold">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label text-secondary small fw-bold">Kata Sandi (Min. 8 Karakter)</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password (Wajib ada 'name="password_confirmation"' untuk validasi 'confirmed') -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label text-secondary small fw-bold">Ulangi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary w-100 py-2 mb-3 fw-bold">Daftar Sekarang</button>
            </form>

            <div class="text-center">
                <span class="text-muted small">Sudah punya akun?</span>
                <a href="/login" class="small text-decoration-none fw-bold">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>