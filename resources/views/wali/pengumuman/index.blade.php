@extends('layouts.wali')
@section('title', 'Pengumuman')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Pengumuman</h1>
        <p class="page-subtitle">Informasi terbaru dari sekolah</p>
    </div>
</div>

<div class="content-card" style="margin-bottom:16px;">
    <div class="table-toolbar">
        <form method="GET" style="display:flex;gap:10px;width:100%;">
            <select name="kategori" class="form-control" style="width:auto;">
                <option value="">Semua Kategori</option>
                @foreach($kategoriList as $k)
                    <option value="{{ $k }}" @selected(request('kategori')==$k)>{{ $k }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
            <a href="{{ route('wali.pengumuman.index') }}" class="btn btn-sm" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">Reset</a>
        </form>
    </div>
</div>

<div class="content-card">
    <div>
        @forelse($pengumuman as $p)
        <a href="{{ route('wali.pengumuman.show', $p) }}" style="text-decoration:none;display:block;">
            <div class="announcement-item" style="padding:16px 20px;">
                <div class="ann-icon"><i class="fas fa-megaphone"></i></div>
                <div style="flex:1;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                        @if($p->kategori)
                        <span class="badge badge-blue">{{ $p->kategori }}</span>
                        @endif
                    </div>
                    <div class="ann-title">{{ $p->judul }}</div>
                    <div style="font-size:13px;color:var(--text-secondary);margin:4px 0;">{{ Str::limit(strip_tags($p->isi), 100) }}</div>
                    <div class="ann-meta"><i class="fas fa-user"></i> {{ $p->user->name }} &nbsp;·&nbsp; <i class="fas fa-clock"></i> {{ $p->created_at->isoFormat('D MMMM Y') }}</div>
                </div>
                <i class="fas fa-chevron-right" style="color:var(--text-muted);"></i>
            </div>
        </a>
        @empty
        <div class="empty-state" style="padding:40px;">Tidak ada pengumuman saat ini.</div>
        @endforelse
    </div>
    <div class="pagination-wrapper">{{ $pengumuman->links() }}</div>
</div>

@endsection
