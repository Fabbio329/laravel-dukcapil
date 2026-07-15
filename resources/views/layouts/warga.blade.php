<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelayanan Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: white;
            z-index: 100;
        }
        .sidebar a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR UTAMA -->
        <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between position-fixed">
            <div>
                <h5 class="fw-bold text-center py-3 text-warning border-bottom border-secondary">Dukcapil Online</h5>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item mb-2">
                        <a href="/warga/riwayat" class="nav-link px-3 py-2 {{ Request::is('warga/riwayat') ? 'active' : '' }}">
                            <i class="bi bi-clock-history me-2"></i> Riwayat Pengajuan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/warga/biodata" class="nav-link px-3 py-2 {{ Request::is('warga/biodata') ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill me-2"></i> Biodata Warga
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/warga/layanan/pilih" class="nav-link px-3 py-2 {{ Request::is('warga/layanan/pilih*') || Request::is('warga/layanan/upload*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-plus me-2"></i> Ajukan Pelayanan
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- BUTTON LOGOUT -->
            <div class="border-top border-secondary pt-3 mb-4">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 fw-bold">
                        <i class="bi bi-box-arrow-left me-2"></i> Keluar (Logout)
                    </button>
                </form>
            </div>
        </div>

        <!-- AREA CONTENT -->
        <div class="col-md-9 col-lg-10 p-4 offset-md-3 offset-lg-2">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>