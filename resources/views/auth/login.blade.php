<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pelayanan Dukcapil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin-top: 10% !important;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="card shadow login-container w-100">
        <div class="card-body p-4">
            <h3 class="text-center mb-2 fw-bold text-primary">Dukcapil Online</h3>
            <p class="text-center text-muted mb-4 text-sm">Masuk untuk mengajukan pelayanan dokumen resmi</p>

            <!-- Menampilkan Pesan Sukses setelah Register -->
            @if(session('success'))
                <div class="alert alert-success py-2 text-center" style="font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary small fw-bold">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label text-secondary small fw-bold">Kata Sandi</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label text-muted small" for="remember">Ingat saya di perangkat ini</label>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary w-100 py-2 mb-3 fw-bold">Masuk Sekarang</button>
            </form>

            <div class="text-center mt-3">
                <span class="text-muted small">Belum punya akun?</span>
                <a href="/register" class="small text-decoration-none fw-bold">Daftar Warga Baru</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>