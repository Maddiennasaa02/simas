@extends('layouts.guru')
@section('title', 'Forum Diskusi')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Forum Diskusi</h1>
        <p class="page-subtitle">Diskusi dan tanya jawab dengan siswa</p>
    </div>
    <button onclick="document.getElementById('modalBuatTopik').style.display='flex'" class="btn btn-primary">
        <i class="fas fa-plus"></i> Buat Topik
    </button>
</div>

{{-- Filter --}}
<div class="content-card" style="margin-bottom:16px;">
    <div class="table-toolbar">
        <form method="GET" style="display:flex;gap:10px;width:100%;">
            <select name="kelas_id" class="form-control" style="width:auto;">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" @selected(request('kelas_id')==$k->id)>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
            <a href="{{ route('guru.forum.index') }}" class="btn btn-sm" style="background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">Reset</a>
        </form>
    </div>
</div>

{{-- Daftar Topik --}}
@forelse($forum as $f)
<div class="content-card" style="margin-bottom:12px;">
    <div class="card-body" style="padding:16px 20px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
            <div style="flex:1;">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                    @if($f->is_pinned)
                        <span class="badge badge-blue"><i class="fas fa-thumbtack"></i> Pinned</span>
                    @endif
                    @if($f->kelas)
                        <span class="badge badge-light">{{ $f->kelas->nama_kelas }}</span>
                    @else
                        <span class="badge badge-light">Semua</span>
                    @endif
                </div>
                <a href="{{ route('guru.forum.show', $f) }}" style="font-size:15px;font-weight:700;color:var(--text-primary);display:block;margin-bottom:4px;">
                    {{ $f->judul }}
                </a>
                <p style="font-size:13px;color:var(--text-secondary);margin-bottom:8px;">{{ Str::limit($f->isi, 120) }}</p>
                <div style="font-size:12px;color:var(--text-muted);display:flex;gap:16px;">
                    <span><i class="fas fa-user"></i> {{ $f->user->name }}</span>
                    <span><i class="fas fa-comment"></i> {{ $f->komentar->count() }} komentar</span>
                    <span><i class="fas fa-clock"></i> {{ $f->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div style="display:flex;gap:6px;flex-shrink:0;">
                <form action="{{ route('guru.forum.pin', $f) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-icon" style="background:var(--primary-light);color:var(--primary);" title="{{ $f->is_pinned ? 'Unpin' : 'Pin' }}">
                        <i class="fas fa-thumbtack"></i>
                    </button>
                </form>
                @if($f->user_id === auth()->id())
                <form action="{{ route('guru.forum.destroy', $f) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn-icon btn-delete" data-confirm="Hapus topik ini?" title="Hapus"><i class="fas fa-trash"></i></button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
<div class="content-card">
    <div class="empty-state" style="padding:40px;">
        <i class="fas fa-comments" style="font-size:32px;color:var(--text-muted);display:block;margin-bottom:12px;"></i>
        Belum ada topik diskusi. Mulai diskusi pertama!
    </div>
</div>
@endforelse

<div>{{ $forum->links() }}</div>

{{-- Modal Buat Topik --}}
<div id="modalBuatTopik" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;padding:16px;">
    <div style="background:white;border-radius:var(--radius);width:100%;max-width:540px;box-shadow:var(--shadow-md);">
        <div class="card-header">
            <h3>Buat Topik Diskusi</h3>
            <button onclick="document.getElementById('modalBuatTopik').style.display='none'" style="background:none;border:none;cursor:pointer;font-size:20px;color:var(--text-muted);">×</button>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.forum.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" required class="form-control" placeholder="Judul topik diskusi...">
                </div>
                <div class="form-group">
                    <label>Isi</label>
                    <textarea name="isi" rows="4" required class="form-control" placeholder="Tuliskan pertanyaan atau topik..."></textarea>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div class="form-group">
                        <label>Untuk</label>
                        <select name="untuk" id="forUntuk" class="form-control"
                                onchange="document.getElementById('kelasWrap').style.display=this.value==='kelas'?'block':'none'">
                            <option value="semua">Semua</option>
                            <option value="kelas">Kelas Tertentu</option>
                        </select>
                    </div>
                    <div class="form-group" id="kelasWrap" style="display:none;">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-control">
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="display:flex;gap:10px;margin-top:4px;">
                    <button type="submit" class="btn btn-primary" style="flex:1;"><i class="fas fa-paper-plane"></i> Publikasikan</button>
                    <button type="button" onclick="document.getElementById('modalBuatTopik').style.display='none'"
                            class="btn" style="flex:1;background:var(--bg);color:var(--text-secondary);border:1px solid var(--border);">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
