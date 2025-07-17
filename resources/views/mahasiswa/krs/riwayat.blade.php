@extends('layouts.mahasiswa')

@section('title', 'Riwayat KRS')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h4 class="fw-bold">Riwayat Pengisian KRS</h4>
        <p class="text-muted">Berikut adalah daftar KRS yang pernah Anda ajukan.</p>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if ($riwayat->isEmpty())
                <p class="text-muted">Belum ada data KRS yang diajukan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tahun Akademik</th>
                                <th>Status</th>
                                <th>Total SKS</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahunAkademik->tahun }} ({{ ucfirst($item->tahunAkademik->semester) }})</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $item->status === 'draft' ? 'secondary' :
                                            ($item->status === 'diajukan' ? 'info' :
                                            ($item->status === 'disetujui' ? 'success' : 'danger')) }}">
                                            {{ strtoupper($item->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->details->sum(fn($d) => $d->mataKuliah->sks) }} SKS</td>
                                    <td class="text-center">
                                        @if ($item->status === 'disetujui')
                                            <a href="{{ route('mahasiswa.krs.cetak', $item->id) }}" 
                                               target="_blank"
                                               class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-printer me-1"></i> Cetak
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
