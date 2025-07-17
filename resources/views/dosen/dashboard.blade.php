@extends('layouts.dosen')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="container py-4">

    {{-- Heading --}}
    <div class="mb-4">
        <h3 class="fw-bold">Halo, {{ Auth::user()->dosen->nama ?? Auth::user()->username }}</h3>
        <p class="text-muted mb-0">Selamat datang di Sistem KRS Online sebagai Dosen Wali.</p>
    </div>

    {{-- Informasi Dosen --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Informasi Dosen</h5>
            <div class="row">
                <div class="col-md-6 mb-2"><strong>NIDN:</strong> {{ Auth::user()->dosen->nidn }}</div>
                <div class="col-md-6 mb-2"><strong>Program Studi:</strong> {{ Auth::user()->dosen->prodi->nama_prodi }}</div>
            </div>
        </div>
    </div>

    {{-- Statistik Bimbingan --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-person-lines-fill fs-1 text-primary"></i>
                        <div>
                            <h6 class="text-muted mb-0">Jumlah Mahasiswa Binaan</h6>
                            <h4 class="fw-bold mb-0">{{ $totalMahasiswa }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tambahan statistik bisa disini --}}
    </div>

</div>
@endsection
