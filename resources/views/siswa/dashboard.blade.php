@extends('layouts.siswa')
@section('title', 'Dashboard Siswa')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Halo, {{ auth()->user()->name }}! 👋</h1>
        <p class="page-subtitle">{{ $siswa->kelas->nama_kelas ?? '-' }} &nbsp;·&nbsp; {{ now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
</div>

{{-- Rekap Absensi --}}
<div class="stats-grid">
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
        <div><span class="stat-number">{{ $absensi['hadir'] ?? 0 }}</span><span class="stat-label">Hadir Bulan Ini</span></div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon"><i class="fas fa-hospital"></i></div>
        <div><span class="stat-number">{{ $absensi['sakit'] ?? 0 }}</span><span class="stat-label">Sakit</span></div>
    </div>
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-file-lines"></i></div>
        <div><span class="stat-number">{{ $absensi['izin'] ?? 0 }}</span><span class="stat-label">Izin</span></div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-user-times"></i></div>
        <div><span class="stat-number">{{ $absensi['alpha'] ?? 0 }}</span><span class="stat-label">Alpha</span></div>
    </div>
</div>

<div class="content-grid">
    {{-- Tugas Aktif --}}
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-file-pen" style="color:var(--primary);margin-right:8px;"></i>Tugas Aktif</h3>
            <a href="{{ route('siswa.tugas.index') }}" style="font-size:12px;color:var(--primary);font-weight:600;">Lihat semua</a>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead><tr><th>Tugas</th><th>Mapel</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($tugasAktif as $t)
                    <tr>
                        <td>
                            <a href="{{ route('siswa.tugas.show', $t) }}" style="font-weight:600;color:var(--primary);">{{ $t->judul }}</a>
                            @if($t->deadline)
                            <div style="font-size:11px;color:{{ $t->isTerlambat()?'var(--danger)':'var(--text-muted)' }};">
                                <i class="fas fa-clock"></i> {{ $t->deadline->format('d/m/Y') }}
                            </div>
                            @endif
                        </td>
                        <td>{{ $t->mataPelajaran->nama ?? '-' }}</td>
                        <td>
                            @if($t->sudah_kumpul)
                                <span class="badge badge-green">✓ Dikumpulkan</span>
                            @else
                                <span class="badge badge-light" style="color:var(--danger);">Belum</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="empty-row">Tidak ada tugas aktif.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Materi Terbaru --}}
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-book-open" style="color:var(--secondary);margin-right:8px;"></i>Materi Terbaru</h3>
            <a href="{{ route('siswa.materi.index') }}" style="font-size:12px;color:var(--primary);font-weight:600;">Lihat semua</a>
        </div>
        <div style="padding:0;">
            @forelse($materiTerbaru as $m)
            <div class="announcement-item" style="padding:12px 20px;">
                <div class="ann-icon" style="background:#e6f4ea;color:var(--secondary);"><i class="fas fa-file-alt"></i></div>
                <div>
                    <div class="ann-title">{{ $m->judul }}</div>
                    <div class="ann-meta">{{ $m->mataPelajaran->nama ?? '-' }} &nbsp;·&nbsp; {{ $m->created_at->diffForHumans() }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state">Belum ada materi.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- Pengumuman --}}
<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-bullhorn" style="color:var(--orange);margin-right:8px;"></i>Pengumuman</h3>
    </div>
    <div>
        @forelse($pengumuman as $p)
        <div class="announcement-item" style="padding:12px 20px;">
            <div class="ann-icon"><i class="fas fa-megaphone"></i></div>
            <div>
                <div class="ann-title">{{ $p->judul }}</div>
                <div class="ann-meta">{{ $p->created_at->diffForHumans() }} &nbsp;·&nbsp; {{ $p->kategori ?? 'Umum' }}</div>
            </div>
        </div>
        @empty
        <div class="empty-state">Tidak ada pengumuman.</div>
        @endforelse
    </div>
</div>

@endsection
