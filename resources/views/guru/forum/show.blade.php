@extends('layouts.guru')
@section('title', $forum->judul)

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Forum Diskusi</h1>
        <p class="page-subtitle"><a href="{{ route('guru.forum.index') }}" style="color:var(--primary);">Forum</a> / {{ Str::limit($forum->judul, 40) }}</p>
    </div>
    <a href="{{ route('guru.forum.index') }}" class="btn" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

{{-- Topik Utama --}}
<div class="content-card" style="margin-bottom:16px;">
    <div class="card-body">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
            @if($forum->is_pinned)<span class="badge badge-blue"><i class="fas fa-thumbtack"></i> Pinned</span>@endif
            @if($forum->kelas)<span class="badge badge-light">{{ $forum->kelas->nama_kelas }}</span>@endif
        </div>
        <h2 style="font-size:20px;font-weight:800;color:var(--text-primary);margin-bottom:12px;">{{ $forum->judul }}</h2>
        <div style="font-size:14px;color:var(--text-primary);line-height:1.8;white-space:pre-line;background:var(--bg);padding:16px;border-radius:var(--radius-sm);">{{ $forum->isi }}</div>
        <div style="margin-top:12px;font-size:12px;color:var(--text-muted);display:flex;gap:16px;">
            <span><i class="fas fa-user"></i> {{ $forum->user->name }}</span>
            <span><i class="fas fa-clock"></i> {{ $forum->created_at->isoFormat('D MMMM Y, HH:mm') }}</span>
        </div>
    </div>
</div>

{{-- Komentar --}}
<div class="content-card" style="margin-bottom:16px;">
    <div class="card-header">
        <h3><i class="fas fa-comments" style="color:var(--secondary);margin-right:8px;"></i>{{ $forum->komentar->count() }} Komentar</h3>
    </div>
    <div>
        @forelse($forum->komentar as $k)
        <div style="display:flex;gap:12px;padding:14px 20px;border-bottom:1px solid var(--border);">
            <div class="avatar" style="flex-shrink:0;">{{ strtoupper(substr($k->user->name,0,1)) }}</div>
            <div style="flex:1;">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <div>
                        <span style="font-weight:700;font-size:13.5px;">{{ $k->user->name }}</span>
                        <span style="font-size:12px;color:var(--text-muted);margin-left:8px;">{{ $k->created_at->diffForHumans() }}</span>
                    </div>
                    @if($k->user_id === auth()->id())
                    <form action="{{ route('guru.forum.komentar.hapus', $k) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn-icon btn-delete btn-sm" data-confirm="Hapus komentar ini?"><i class="fas fa-trash"></i></button>
                    </form>
                    @endif
                </div>
                <p style="font-size:13.5px;color:var(--text-primary);margin-top:6px;white-space:pre-line;">{{ $k->isi }}</p>
            </div>
        </div>
        @empty
        <div class="empty-state">Belum ada komentar. Jadilah yang pertama!</div>
        @endforelse
    </div>
</div>

{{-- Form Komentar --}}
<div class="content-card">
    <div class="card-header">
        <h3><i class="fas fa-reply" style="color:var(--primary);margin-right:8px;"></i>Tulis Komentar</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('guru.forum.komentar', $forum) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="isi" rows="3" required class="form-control" placeholder="Tulis komentar atau tanggapan..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim Komentar</button>
        </form>
    </div>
</div>

@endsection
