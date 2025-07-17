@extends('layouts.admin')

@section('title', 'Edit Tahun Akademik')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">Edit Tahun Akademik</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.tahunakademik.update', $tahunAkademik->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Akademik</label>
                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $tahunAkademik->tahun) }}"
                        class="form-control @error('tahun') is-invalid @enderror" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <select name="semester" id="semester" class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="ganjil" {{ old('semester', $tahunAkademik->semester) == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="genap" {{ old('semester', $tahunAkademik->semester) == 'genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

              <div class="form-check mb-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $tahunAkademik->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Tandai sebagai Tahun Akademik Aktif</label>
             </div>


                <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
                <a href="{{ route('admin.tahunakademik.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
