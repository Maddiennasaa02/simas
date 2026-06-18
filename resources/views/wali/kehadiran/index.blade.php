@extends('layouts.wali')
@section('title', 'Absensi Anak')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Absensi Anak</h1>
        <p class="page-subtitle">Pantau kehadiran anak di sekolah</p>
    </div>
</div>

@if($anakList->count() > 1)
<div class="content-card" style="margin-bottom:16px;">
    <div class="card-body" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <span style="font-size:13px;color:var(--text-secondary);font-weight:600;">Pilih anak:</span>
        <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;">
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
<div class="content-card" style="margin-bottom:16px;">
    <div class="table-toolbar">
        <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;">
            <input type="hidden" name="anak_id" value="{{ $anak->id }}">
            <select name="bulan" class="form-control" style="width:auto;">
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" @selected($bulan==$b)>{{ \Carbon\Carbon::create()->month($b)->isoFormat('MMMM') }}</option>
                @endforeach
            </select>
            <select name="tahun" class="form-control" style="width:auto;">
                @foreach(range(now()->year-1, now()->year) as $y)
                    <option value="{{ $y }}" @selected($tahun==$y)>{{ $y }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Tampilkan</button>
        </form>
    </div>
</div>

<div class="stats-grid" style="grid-template-columns:repeat(5,1fr);margin-bottom:24px;">
    <div class="stat-card stat-green">
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
        <div><span class="stat-number">{{ $rekap['hadir'] }}</span><span class="stat-label">Hadir</span></div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon"><i class="fas fa-hospital"></i></div>
        <div><span class="stat-number">{{ $rekap['sakit'] }}</span><span class="stat-label">Sakit</span></div>
    </div>
    <div class="stat-card stat-blue">
        <div class="stat-icon"><i class="fas fa-file-lines"></i></div>
        <div><span class="stat-number">{{ $rekap['izin'] }}</span><span class="stat-label">Izin</span></div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon"><i class="fas fa-user-times"></i></div>
        <div><span class="stat-number">{{ $rekap['alpha'] }}</span><span class="stat-label">Alpha</span></div>
    </div>
    <div class="stat-card" style="border-color:#0f172a;">
        <div class="stat-icon" style="background:#f0f4f8;color:#0f172a;"><i class="fas fa-percent"></i></div>
        <div><span class="stat-number">{{ $rekap['persentase'] }}%</span><span class="stat-label">Kehadiran</span></div>
    </div>
</div>

<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-calendar-alt" style="color:var(--primary);margin-right:8px;"></i>Detail Absensi — {{ $anak->nama_lengkap }}</h3>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead><tr><th>Tanggal</th><th>Hari</th><th>Status</th><th>Keterangan</th></tr></thead>
            <tbody>
                @forelse($absensi as $a)
                @php $b=['hadir'=>'badge-green','sakit'=>'badge-light','izin'=>'badge-blue','alpha'=>'badge-light'][$a->status]??'badge-light'; @endphp
                <tr>
                    <td style="font-weight:600;">{{ $a->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $a->tanggal->isoFormat('dddd') }}</td>
                    <td><span class="badge {{ $b }}">{{ ucfirst($a->status) }}</span></td>
                    <td style="color:var(--text-secondary);">{{ $a->keterangan??'-' }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty-row">Tidak ada data absensi untuk periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
<div class="content-card">
    <div class="empty-state" style="padding:40px;">Data anak tidak ditemukan.</div>
</div>
@endif

@endsection
