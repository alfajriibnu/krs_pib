@extends('layouts.dosen')

@section('title', 'Edit Password')

@section('content')
<div class="container py-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Ubah Password --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light fw-bold">
            <i class="bi bi-shield-lock-fill me-1"></i> Ubah Password
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('dosen.profil.updatePassword') }}">
                @csrf
                @method('PUT')

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
                    <i class="bi bi-lock-fill me-1"></i> Ubah Password
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
