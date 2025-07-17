<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KRS Online | Politeknik Indonesia Banjarmasin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(to right, #0d6efd, #6610f2);
            color: white;
            padding: 100px 0;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: rgba(13, 110, 253, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 100%;
            font-size: 24px;
            color: #0d6efd;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" class="me-2">
                <span class="fw-bold text-primary">Politeknik Indonesia Banjarmasin</span>
            </a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Sistem KRS Online</h1>
            <p class="lead mb-4">Solusi digital untuk pengisian Kartu Rencana Studi yang mudah, cepat, dan aman.</p>
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 py-2 fw-semibold">Masuk Sekarang</a>
        </div>
    </section>

    {{-- Fitur Unggulan --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row text-center g-4">

                <div class="col-md-4">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h5 class="fw-bold">Akses Cepat</h5>
                    <p class="text-muted">Mahasiswa dapat mengisi KRS kapan saja tanpa harus ke kampus.</p>
                </div>

                <div class="col-md-4">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-cloud-check"></i>
                    </div>
                    <h5 class="fw-bold">100% Online</h5>
                    <p class="text-muted">Sistem berbasis web yang bisa diakses dari perangkat apapun.</p>
                </div>

                <div class="col-md-4">
                    <div class="feature-icon mx-auto mb-3">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <h5 class="fw-bold">Persetujuan Dosen</h5>
                    <p class="text-muted">Proses verifikasi KRS langsung oleh dosen wali.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-light text-center py-4 mt-5">
        <p class="mb-0 text-muted">© {{ date('Y') }} Politeknik Indonesia Banjarmasin. All rights reserved.</p>
    </footer>

</body>
</html>
