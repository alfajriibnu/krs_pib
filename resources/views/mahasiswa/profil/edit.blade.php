@extends('layouts.mahasiswa')

@section('title', 'Edit Profil')

@section('content')
<div class="container py-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        {{-- Form Profil --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header fw-bold bg-light">
                    <i class="bi bi-person-lines-fill me-1"></i> Edit Profil Mahasiswa
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.profil.update') }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="number" name="semester" value="{{ old('semester', $mahasiswa->semester) }}" class="form-control" min="1" max="14" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Form Password --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header fw-bold bg-light">
                    <i class="bi bi-shield-lock-fill me-1"></i> Ubah Password
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.profil.updatePassword') }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" required>
                            @error('password_lama') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_baru_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-lock me-1"></i> Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
