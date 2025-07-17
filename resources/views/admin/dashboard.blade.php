@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Heading --}}
    <div class="mb-4">
        <h3 class="fw-bold">Dashboard Admin</h3>
        <p class="text-muted">Selamat datang, {{ Auth::user()->username }}</p>
    </div>

    {{-- Statistik Kartu --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                        <div>
                            <h6 class="text-muted mb-0">Total Mahasiswa</h6>
                            <h4 class="fw-bold mb-0">{{ $totalMahasiswa }}</h4> {{-- bisa diganti dengan dynamic count --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-person-workspace fs-1 text-warning"></i>
                        <div>
                            <h6 class="text-muted mb-0">Dosen Terdaftar</h6>
                            <h4 class="fw-bold mb-0">{{ $totalDosen }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark-fill fs-1 text-success"></i>
                        <div>
                            <h6 class="text-muted mb-0">Mata Kuliah Aktif</h6>
                            <h4 class="fw-bold mb-0">{{ $totalMatkul }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Cepat --}}
    <div class="mt-5">
        <h5 class="mb-3">Menu Cepat</h5>
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('admin.prodi.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-mortarboard-fill me-1"></i> Kelola Prodi
            </a>
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-people-fill me-1"></i> Kelola Mahasiswa
            </a>
            <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-person-workspace me-1"></i> Kelola Dosen
            </a>
            <a href="{{ route('admin.matakuliah.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-journal-bookmark-fill me-1"></i> Mata Kuliah
            </a>
            <a href="{{ route('admin.tahunakademik.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-calendar2-week-fill me-1"></i> Tahun Akademik
            </a>
        </div>
    </div>

</div>
@endsection
