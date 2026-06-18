@extends('layouts.wali')
@section('title', 'Tugas Anak')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Absen & Tugas Anak</h1>
        <p class="page-subtitle">Pantau tugas yang diberikan ke anak</p>
    </div>
</div>

@if($anakList->count() > 1)
<div class="content-card" style="margin-bottom:16px;">
    <div class="card-body" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <span style="font-size:13px;color:var(--text-secondary);font-weight:600;">Pilih anak:</span>
        <form method="GET" style="display:flex;gap:8px;">
            @foreach($anakList as $a)
            <button type="submit" name="anak_id" value="{{ $a->id }}"
                    class="btn btn-sm {{ ($anak?->id==$a->id)?'btn-primary':'' }}"
                    style="{{ ($anak?->id!=$a->id)?'background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);':'' }}">
                {{ $a->nama_lengkap }}
            </button>
            @endforeach
        </form>
    </div>
</div>
@endif

@if($anak)

@php
    $totalTugas  = $tugas->total();
    $sdKumpul    = $pengumpulan->count();
    $belumKumpul = max(0, $totalTugas - $sdKumpul);
@endphp

<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-list-check"></i></div>
        <div><span class="stat-number">{{ $totalTugas }}</span><span class="stat-label">Total Tugas</span></div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-check-double"></i></div>
        <div><span class="stat-number">{{ $sdKumpul }}</span><span class="stat-label">Dikumpulkan</span></div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon"><i class="fas fa-clock"></i></div>
        <div><span class="stat-number">{{ $belumKumpul }}</span><span class="stat-label">Belum Kumpul</span></div>
    </div>
</div>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-tasks" style="color:var(--primary);margin-right:8px;"></i>Daftar Tugas — {{ $anak->nama_lengkap }}</h3>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul Tugas</th>
                    <th>Mata Pelajaran</th>
                    <th>Deadline</th>
                    <th>Status Kumpul</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tugas as $t)
                @php
                    $statusKumpul = $pengumpulan[$t->id] ?? null;
                    $nilaiTugas   = $nilai[$t->id] ?? null;
                @endphp
                <tr>
                    <td style="font-weight:600;">{{ $t->judul }}</td>
                    <td>{{ $t->mataPelajaran->nama ?? '-' }}</td>
                    <td style="font-size:13px;">{{ $t->deadline?->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        @if($statusKumpul)
                            @php $sc=['tepat_waktu'=>'badge-green','terlambat'=>'badge-light','belum'=>'badge-light'][$statusKumpul]??'badge-light'; @endphp
                            <span class="badge {{ $sc }}">{{ str_replace('_',' ', ucfirst($statusKumpul)) }}</span>
                        @else
                            <span class="badge badge-light" style="color:var(--danger);">Belum kumpul</span>
                        @endif
                    </td>
                    <td style="font-weight:700;font-size:16px;color:{{ $nilaiTugas?'var(--secondary)':'var(--text-muted)' }};">
                        {{ $nilaiTugas ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="empty-row">Tidak ada tugas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper">{{ $tugas->links() }}</div>
</div>

@else
<div class="content-card">
    <div class="empty-state" style="padding:40px;">Data anak tidak ditemukan.</div>
</div>
@endif

@endsection
