@extends('layouts.admin')

@section('title', 'Tahun Akademik')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">Tahun Akademik</h4>

    <a href="{{ route('admin.tahunakademik.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Tahun Akademik
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tahun</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tahunAkademik as $item)
                        <tr>
                            <td>{{ $item->tahun }}</td>
                            <td class="text-capitalize">{{ $item->semester }}</td>
                            <td>
                                @if ($item->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tahunakademik.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.tahunakademik.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus tahun akademik ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
