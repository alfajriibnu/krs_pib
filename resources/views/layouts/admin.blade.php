<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin | Sistem KRS')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            height: 100vh;
            background: linear-gradient(to bottom right, #0d6efd, #6610f2);
            color: #fff;
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
        }

        .sidebar-brand {
            font-size: 1.2rem;
            font-weight: bold;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-brand img {
            max-height: 60px;
            margin-bottom: 0.5rem;
        }

        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
        }

        .topbar .username {
            font-weight: 500;
            color: #333;
        }

        main {
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="text-center mb-4 sidebar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
                <div><i class="bi bi-grid-fill me-1"></i> KRS Admin</div>
            </div>

            <ul class="nav flex-column px-3">
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.prodi.*') ? 'active' : '' }}"
                       href="{{ route('admin.prodi.index') }}">
                        <i class="bi bi-mortarboard-fill"></i> Kelola Prodi
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}"
                       href="{{ route('admin.mahasiswa.index') }}">
                        <i class="bi bi-people-fill"></i> Kelola Mahasiswa
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}"
                       href="{{ route('admin.dosen.index') }}">
                        <i class="bi bi-person-workspace"></i> Kelola Dosen
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.matakuliah.*') ? 'active' : '' }}"
                       href="{{ route('admin.matakuliah.index') }}">
                        <i class="bi bi-journal-bookmark-fill"></i> Mata Kuliah
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.tahunakademik.*') ? 'active' : '' }}"
                       href="{{ route('admin.tahunakademik.index') }}">
                        <i class="bi bi-calendar2-week-fill"></i> Tahun Akademik
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        {{-- Main Content --}}
        <main class="col-md-10 ms-sm-auto px-md-4">
            {{-- Topbar --}}
            <div class="topbar d-flex justify-content-between align-items-center">
                <div class="fs-5 fw-semibold">@yield('title', 'Dashboard')</div>
                <div class="username">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->username ?? 'Admin' }}
                </div>
            </div>

            {{-- Page Content --}}
            <div class="py-4">
                @yield('content')
            </div>
        </main>

    </div>
</div>

</body>
@stack('scripts')
</html>
