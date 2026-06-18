@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Data Siswa</h1>
        <p class="page-sub">{{ $siswa->nama_lengkap }}</p>
    </div>
    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        <ul style="margin:0; padding-left:1rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-section-title">Data Siswa</div>

        <div class="form-grid">
            <div class="form-group">
                <label>NISN</label>
                <input type="text" class="form-control" value="{{ $siswa->nisn }}" disabled>
            </div>

            <div class="form-group">
                <label>Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                       class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}" required>
                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control">
                    <option value="">-- Belum ada kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}"
                            {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection