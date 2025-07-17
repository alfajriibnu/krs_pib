@extends('layouts.admin')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">Edit Mahasiswa</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}"
                        class="form-control @error('nim') is-invalid @enderror" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $mahasiswa->nama) }}"
                        class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" name="semester" id="semester" value="{{ old('semester', $mahasiswa->semester) }}"
                        class="form-control @error('semester') is-invalid @enderror" required min="1" max="14">
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Prodi</label>
                    <select name="prodi_id" id="prodi_id"
                        class="form-select @error('prodi_id') is-invalid @enderror" required>
                        @foreach ($prodi as $item)
                            <option value="{{ $item->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dosen_wali_id" class="form-label">Dosen Wali</label>
                    <select name="dosen_wali_id" id="dosen_wali_id"
                        class="form-select @error('dosen_wali_id') is-invalid @enderror">
                        <option value="">-- Pilih Dosen Wali --</option>
                        {{-- akan diisi oleh JavaScript --}}
                    </select>
                    @error('dosen_wali_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadDosen(prodiId, selected = null) {
        $.get('/get-dosen-by-prodi/' + prodiId, function(data) {
            let options = '<option value="">-- Pilih Dosen Wali --</option>';
            data.forEach(d => {
                let selectedAttr = (d.id == selected) ? 'selected' : '';
                options += `<option value="${d.id}" ${selectedAttr}>${d.nama}</option>`;
            });
            $('#dosen_wali_id').html(options);
        });
    }

    $(document).ready(function () {
        const selectedProdi = $('#prodi_id').val();
        const selectedDosen = '{{ old('dosen_wali_id', $mahasiswa->dosen_wali_id) }}';

        if (selectedProdi) {
            loadDosen(selectedProdi, selectedDosen);
        }

        $('#prodi_id').on('change', function () {
            loadDosen(this.value);
        });
    });
</script>
@endpush
