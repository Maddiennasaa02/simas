@extends('layouts.wali')
@section('title', $pengumuman->judul)

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Pengumuman</h1>
        <p class="page-subtitle"><a href="{{ route('wali.pengumuman.index') }}" style="color:var(--primary);">Pengumuman</a> / Detail</p>
    </div>
    <a href="{{ route('wali.pengumuman.index') }}" class="btn" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="content-card" style="max-width:760px;">
    <div class="card-body">
        @if($pengumuman->kategori)
        <span class="badge badge-blue" style="margin-bottom:12px;display:inline-block;">{{ $pengumuman->kategori }}</span>
        @endif
        <h2 style="font-size:22px;font-weight:800;color:var(--text-primary);margin-bottom:12px;">{{ $pengumuman->judul }}</h2>
        <div style="font-size:12px;color:var(--text-muted);display:flex;gap:16px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid var(--border);">
            <span><i class="fas fa-user"></i> {{ $pengumuman->user->name }}</span>
            <span><i class="fas fa-calendar"></i> {{ $pengumuman->created_at->isoFormat('D MMMM Y, HH:mm') }}</span>
        </div>
        <div style="font-size:14px;color:var(--text-primary);line-height:1.9;white-space:pre-line;">{{ $pengumuman->isi }}</div>
    </div>
</div>

@endsection
