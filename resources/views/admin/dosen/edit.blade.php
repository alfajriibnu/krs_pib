@extends('layouts.admin')

@section('title', 'Edit Dosen')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">Edit Dosen</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" name="nidn" id="nidn" value="{{ old('nidn', $dosen->nidn) }}"
                           class="form-control @error('nidn') is-invalid @enderror" required>
                    @error('nidn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Dosen</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $dosen->nama) }}"
                           class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Prodi</label>
                    <select name="prodi_id" id="prodi_id"
                            class="form-select @error('prodi_id') is-invalid @enderror" required>
                        @foreach ($prodi as $item)
                            <option value="{{ $item->id }}" {{ old('prodi_id', $dosen->prodi_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
