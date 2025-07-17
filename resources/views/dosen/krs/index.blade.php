@extends('layouts.dosen')

@section('title', 'Verifikasi KRS')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4">Daftar Pengajuan KRS</h4>

    @foreach ($krs as $item)
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">{{ $item->mahasiswa->nama }} ({{ $item->mahasiswa->nim }})</h6>
                    <p class="mb-0 text-muted">{{ $item->tahunAkademik->tahun }} - {{ ucfirst($item->tahunAkademik->semester) }}</p>
                </div>
                <a href="{{ route('dosen.krs.show', $item->id) }}" class="btn btn-outline-primary btn-sm">Lihat</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
