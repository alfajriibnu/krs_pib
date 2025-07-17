@extends('layouts.admin')

@section('title', 'Edit Prodi')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">Edit Program Studi</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_prodi" class="form-label">Nama Prodi</label>
                    <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror"
                           name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
                    @error('nama_prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenjang" class="form-label">Jenjang</label>
                    <select class="form-select @error('jenjang') is-invalid @enderror" name="jenjang" required>
                        @foreach(['D3', 'S1Terapan', 'S1', 'S2', 'S3'] as $jenjang)
                            <option value="{{ $jenjang }}" {{ old('jenjang', $prodi->jenjang) == $jenjang ? 'selected' : '' }}>
                                {{ $jenjang }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenjang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.prodi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection
