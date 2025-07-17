@extends('layouts.admin')

@section('title', 'Tambah Tahun Akademik')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">Tambah Tahun Akademik</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.tahunakademik.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Akademik</label>
                    <input type="text" name="tahun" id="tahun"
                        value="{{ old('tahun') }}"
                        class="form-control @error('tahun') is-invalid @enderror"
                        placeholder="Contoh: 2024/2025" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <select name="semester" id="semester"
                        class="form-select @error('semester') is-invalid @enderror" required>
                        <option disabled selected>-- Pilih Semester --</option>
                        <option value="ganjil" {{ old('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="genap" {{ old('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    {{-- Hidden input untuk menangani unchecked checkbox --}}
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active"
                        class="form-check-input" value="1"
                        {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Jadikan Tahun Akademik Aktif
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.tahunakademik.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
