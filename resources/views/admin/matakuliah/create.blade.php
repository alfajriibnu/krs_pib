@extends('layouts.admin')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">Tambah Mata Kuliah</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kode_mk" class="form-label">Kode MK</label>
                    <input type="text" name="kode_mk" id="kode_mk" value="{{ old('kode_mk') }}"
                        class="form-control @error('kode_mk') is-invalid @enderror" required>
                    @error('kode_mk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sks" class="form-label">SKS</label>
                    <input type="number" name="sks" id="sks" value="{{ old('sks') }}"
                        class="form-control @error('sks') is-invalid @enderror" required min="1" max="6">
                    @error('sks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" name="semester" id="semester" value="{{ old('semester') }}"
                        class="form-control @error('semester') is-invalid @enderror" required min="1" max="14">
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Prodi</label>
                    <select name="prodi_id" id="prodi_id"
                        class="form-select @error('prodi_id') is-invalid @enderror" required>
                        <option disabled selected>-- Pilih Prodi --</option>
                        @foreach ($prodi as $item)
                            <option value="{{ $item->id }}" {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('admin.matakuliah.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
