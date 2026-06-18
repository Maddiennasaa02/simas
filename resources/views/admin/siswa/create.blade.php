@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Siswa</h1>
        <p class="page-sub">Isi data siswa baru di bawah ini</p>
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
    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf

        <div class="form-section-title">Data Pribadi</div>

        <div class="form-grid">
            <div class="form-group">
                <label>NISN <span class="required">*</span></label>
                <input type="text" name="nisn" value="{{ old('nisn') }}"
                       class="form-control {{ $errors->has('nisn') ? 'is-invalid' : '' }}"
                       placeholder="Nomor Induk Siswa Nasional" required>
                @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                       class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}"
                       placeholder="Nama lengkap siswa" required>
                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Jenis Kelamin <span class="required">*</span></label>
                <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" required>
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Tempat Lahir <span class="required">*</span></label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                       class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}"
                       placeholder="Kota tempat lahir" required>
                @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Lahir <span class="required">*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                       class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" required>
                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control">
                    <option value="">-- Belum ada kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group form-group-full">
                <label>Alamat <span class="required">*</span></label>
                <textarea name="alamat" rows="3"
                          class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                          placeholder="Alamat lengkap siswa" required>{{ old('alamat') }}</textarea>
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-section-title" style="margin-top:1.5rem;">Akun Login</div>

        <div class="form-grid">
            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       placeholder="email@siswa.sch.id" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Password <span class="required">*</span></label>
                <input type="password" name="password"
                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="Minimal 6 karakter" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Data
            </button>
        </div>

    </form>
</div>
@endsection