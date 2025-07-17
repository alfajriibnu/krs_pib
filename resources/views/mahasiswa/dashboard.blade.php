@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="container-fluid py-4">

    {{-- Heading --}}
    <div class="mb-4">
        <h3 class="fw-bold">
            Hai, {{ Auth::user()->mahasiswa?->nama ?? Auth::user()->username }}
        </h3>
        <p class="text-muted">
            Selamat datang di <strong>Sistem KRS Online</strong><br class="d-md-none">
            Politeknik Indonesia Banjarmasin.
        </p>
    </div>

    {{-- Info Mahasiswa --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light fw-semibold">
            <i class="bi bi-person-vcard-fill me-2 text-primary"></i> Profil Mahasiswa
        </div>
        <div class="card-body">
            <div class="row gy-3">
                <div class="col-md-6">
                    <span class="text-muted">NIM:</span><br>
                    <strong>{{ Auth::user()->mahasiswa?->nim ?? '-' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted">Program Studi:</span><br>
                    <strong>{{ Auth::user()->mahasiswa?->prodi?->nama_prodi ?? '-' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted">Semester:</span><br>
                    <strong>{{ Auth::user()->mahasiswa?->semester ?? '-' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted">Dosen Wali:</span><br>
                    <strong>{{ Auth::user()->mahasiswa?->dosenWali?->nama ?? '-' }}</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- Tahun Akademik Aktif --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <div class="text-muted small">Tahun Akademik Aktif</div>
                <h5 class="fw-bold mb-0">
                    {{ $tahun_aktif->tahun ?? '-' }} <span class="text-capitalize">({{ $tahun_aktif->semester ?? '-' }})</span>
                </h5>
            </div>
            <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-primary mt-3 mt-md-0">
                <i class="bi bi-pencil-square me-1"></i> Isi KRS
            </a>
        </div>
    </div>

</div>
@endsection
