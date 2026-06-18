@extends('layouts.wali')
@section('title', 'Dashboard Orang Tua')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Selamat Datang! 👋</h1>
        <p class="page-subtitle">{{ auth()->user()->name }} &nbsp;·&nbsp; {{ now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
</div>

@if($anakList->count() > 1)
<div class="content-card" style="margin-bottom:16px;">
    <div class="card-body" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <span style="font-size:13px;color:var(--text-secondary);font-weight:600;">Pilih anak:</span>
        @foreach($anakList as $anak)
        <a href="?anak={{ $anak->id }}"
           class="btn btn-sm {{ ($anakUtama?->id==$anak->id) ? 'btn-primary' : '' }}"
           style="{{ ($anakUtama?->id!=$anak->id) ? 'background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);' : '' }}">
            {{ $anak->nama_lengkap }}
        </a>
        @endforeach
    </div>
</div>
@endif

@if($anakUtama)
{{-- Info Anak --}}
<div class="content-card" style="margin-bottom:24px;">
    <div class="card-body" style="display:flex;align-items:center;gap:16px;">
        <div class="user-avatar" style="width:56px;height:56px;font-size:20px;border-radius:14px;">
            {{ strtoupper(substr($anakUtama->nama_lengkap,0,1)) }}
        </div>
        <div>
            <div style="font-size:18px;font-weight:800;color:var(--text-primary);">{{ $anakUtama->nama_lengkap }}</div>
            <div style="font-size:13px;color:var(--text-muted);">NISN: {{ $anakUtama->nisn }} &nbsp;·&nbsp; Kelas {{ $anakUtama->kelas->nama_kelas ?? '-' }}</div>
        </div>
    </div>
</div>

{{-- Rekap Absensi --}}
@php $abs = $absensiRekap[$anakUtama->id] ?? collect(); @endphp
<div class="stats-grid" style="margin-bottom:24px;">
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
        <div><span class="stat-number">{{ $abs['hadir']??0 }}</span><span class="stat-label">Hadir Bulan Ini</span></div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon"><i class="fas fa-hospital"></i></div>
        <div><span class="stat-number">{{ $abs['sakit']??0 }}</span><span class="stat-label">Sakit</span></div>
    </div>
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-file-lines"></i></div>
        <div><span class="stat-number">{{ $abs['izin']??0 }}</span><span class="stat-label">Izin</span></div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-user-times"></i></div>
        <div><span class="stat-number">{{ $abs['alpha']??0 }}</span><span class="stat-label">Alpha</span></div>
    </div>
</div>

<div class="content-grid">
    {{-- Rekap Tugas --}}
    @php $tgs = $tugasRekap[$anakUtama->id] ?? []; @endphp
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-tasks" style="color:var(--primary);margin-right:8px;"></i>Tugas Anak</h3>
            <a href="{{ route('wali.tugas') }}" style="font-size:12px;color:var(--primary);font-weight:600;">Lihat detail</a>
        </div>
        <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div style="background:var(--primary-light);padding:16px;border-radius:var(--radius-sm);text-align:center;">
                <div style="font-size:28px;font-weight:800;color:var(--primary);">{{ $tgs['aktif']??0 }}</div>
                <div style="font-size:12px;color:var(--primary);font-weight:600;">Tugas Aktif</div>
            </div>
            <div style="background:#e6f4ea;padding:16px;border-radius:var(--radius-sm);text-align:center;">
                <div style="font-size:28px;font-weight:800;color:var(--secondary);">{{ $tgs['dikumpul']??0 }}</div>
                <div style="font-size:12px;color:var(--secondary);font-weight:600;">Dikumpulkan</div>
            </div>
        </div>
    </div>

    {{-- Absensi Terbaru --}}
    <div class="content-card">
        <div class="card-header">
            <h3><i class="fas fa-calendar-check" style="color:var(--secondary);margin-right:8px;"></i>Absensi Terbaru</h3>
            <a href="{{ route('wali.kehadiran') }}" style="font-size:12px;color:var(--primary);font-weight:600;">Lihat semua</a>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead><tr><th>Tanggal</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($absensiTerbaru as $a)
                    @php $b=['hadir'=>'badge-green','sakit'=>'badge-light','izin'=>'badge-blue','alpha'=>'badge-light'][$a->status]??'badge-light'; @endphp
                    <tr>
                        <td>{{ $a->tanggal->isoFormat('ddd, D MMM') }}</td>
                        <td><span class="badge {{ $b }}">{{ ucfirst($a->status) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="empty-row">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

{{-- Pengumuman --}}
<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-bullhorn" style="color:var(--orange);margin-right:8px;"></i>Pengumuman</h3>
        <a href="{{ route('wali.pengumuman.index') }}" style="font-size:12px;color:var(--primary);font-weight:600;">Lihat semua</a>
    </div>
    <div>
        @forelse($pengumuman as $p)
        <a href="{{ route('wali.pengumuman.show', $p) }}" class="announcement-item" style="padding:12px 20px;display:flex;gap:12px;text-decoration:none;">
            <div class="ann-icon"><i class="fas fa-megaphone"></i></div>
            <div>
                <div class="ann-title">{{ $p->judul }}</div>
                <div class="ann-meta">{{ $p->kategori??'Umum' }} &nbsp;·&nbsp; {{ $p->created_at->diffForHumans() }}</div>
            </div>
        </a>
        @empty
        <div class="empty-state">Tidak ada pengumuman.</div>
        @endforelse
    </div>
</div>

@endsection
