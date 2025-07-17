@extends('layouts.admin')

@section('title', 'Kelola Prodi')

@section('content')
<div class="container-fluid">

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Daftar Program Studi</h4>
        <a href="{{ route('admin.prodi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Prodi
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel Prodi --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Prodi</th>
                        <th>Jenjang</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prodis as $index => $prodi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $prodi->nama_prodi }}</td>
                            <td>{{ $prodi->jenjang }}</td>
                            <td>
                                <a href="{{ route('admin.prodi.edit', $prodi->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.prodi.destroy', $prodi->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus prodi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data prodi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
