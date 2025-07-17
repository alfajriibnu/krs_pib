@extends('layouts.dosen')

@section('title', 'Detail KRS')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">KRS Mahasiswa</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $krs->mahasiswa->nama }}</p>
            <p><strong>NIM:</strong> {{ $krs->mahasiswa->nim }}</p>
            <p><strong>Prodi:</strong> {{ $krs->mahasiswa->prodi->nama_prodi }}</p>
            <p><strong>Semester:</strong> {{ $krs->mahasiswa->semester }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Mata Kuliah</h5>
            <ul class="list-group">
                @foreach ($krs->details as $detail)
                    <li class="list-group-item d-flex justify-content-between">
                        {{ $detail->mataKuliah->nama }} ({{ $detail->mataKuliah->sks }} SKS)
                        <span class="text-muted">{{ $detail->mataKuliah->kode_mk }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Form Verifikasi --}}
    <form method="POST" action="{{ route('dosen.krs.verifikasi', $krs->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold">Verifikasi KRS:</label>
            <select name="status" class="form-select" required>
                <option value="">-- Pilih Aksi --</option>
                <option value="disetujui">Setujui</option>
                <option value="ditolak">Tolak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle me-1"></i> Proses Verifikasi
        </button>
        <a href="{{ route('dosen.krs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
