@extends('layouts.mahasiswa')

@section('title', 'Pengisian KRS')

@section('content')
<div class="container py-4">

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Header --}}
    <div class="mb-4">
        <h4 class="fw-bold">Pengisian KRS</h4>
        <p class="text-muted mb-0">
            Tahun Akademik: <strong>{{ $tahunAkademik->tahun }}</strong> ({{ ucfirst($tahunAkademik->semester) }})
        </p>
        <p class="text-muted">
            Status KRS: 
            <span class="badge bg-{{ 
                $krs->status === 'draft' ? 'secondary' : 
                ($krs->status === 'diajukan' ? 'info' : 
                ($krs->status === 'disetujui' ? 'success' : 'danger')) }}">
                {{ strtoupper($krs->status) }}
            </span>
        </p>
    </div>

    {{-- Form KRS --}}
    <form method="POST" action="{{ route('mahasiswa.krs.store') }}">
        @csrf

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="mb-3">Pilih Mata Kuliah</h5>

                @if ($mataKuliah->isEmpty())
                    <p class="text-muted">Tidak ada mata kuliah tersedia untuk semester Anda saat ini.</p>
                @else
                    <div class="row">
                        @foreach ($mataKuliah as $mk)
                            <div class="col-md-6 mb-3">
                                <div class="form-check border rounded p-2 shadow-sm">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="mata_kuliah_id[]"
                                           value="{{ $mk->id }}"
                                           id="mk{{ $mk->id }}"
                                           {{ in_array($mk->id, $selectedMatkul) ? 'checked' : '' }}
                                           {{ $krs->status !== 'draft' ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="mk{{ $mk->id }}">
                                        <strong>{{ $mk->nama }}</strong> ({{ $mk->kode_mk }}) - {{ $mk->sks }} SKS
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if ($krs->status === 'draft' && !$mataKuliah->isEmpty())
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan KRS
                </button>
            </div>
        @endif
    </form>

    {{-- Form Ajukan KRS --}}
    @if ($krs->status === 'draft' && !$mataKuliah->isEmpty())
        <form action="{{ route('mahasiswa.krs.ajukan', $krs->id) }}" method="POST" class="mt-3"
              onsubmit="return confirm('Yakin ingin mengajukan KRS? Setelah diajukan, tidak dapat diedit.')">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success">
                <i class="bi bi-send me-1"></i> Ajukan KRS
            </button>
        </form>
    @endif

</div>
@endsection
