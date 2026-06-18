@extends('layouts.guru')

@section('title', 'Detail Materi')

@section('content')

<div class="page-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <a href="{{ route('guru.materi.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="page-title">Detail Materi</h1>
            <p class="page-subtitle">Pratinjau materi yang dibagikan</p>
        </div>
    </div>
    <a href="{{ route('guru.materi.edit', $materi) }}" class="btn-primary-action" style="background:var(--orange,#f9ab00);">
        <i class="fas fa-pencil-alt"></i> Edit Materi
    </a>
</div>

<div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

    {{-- Konten Materi --}}
    <div class="content-card">
        <div class="card-body" style="padding:24px;">

            {{-- Header --}}
            <div style="display:flex;align-items:flex-start;gap:16px;margin-bottom:20px;">
                @php
                    $tipeConfig = [
                        'file'  => ['icon' => 'fa-file-alt',    'bg' => '#e8f0fe', 'color' => 'var(--primary)', 'badge' => 'badge-blue',   'label' => 'File Dokumen'],
                        'link'  => ['icon' => 'fa-link',        'bg' => '#f3e8fd', 'color' => '#7c3aed',        'badge' => 'badge-purple', 'label' => 'Tautan'],
                        'video' => ['icon' => 'fa-play-circle', 'bg' => '#fef3e2', 'color' => 'var(--orange)',  'badge' => 'badge-orange', 'label' => 'Video'],
                    ];
                    $cfg = $tipeConfig[$materi->tipe] ?? ['icon'=>'fa-file','bg'=>'#e8f0fe','color'=>'var(--primary)','badge'=>'badge-blue','label'=>$materi->tipe];
                @endphp
                <div style="width:56px;height:56px;border-radius:14px;background:{{ $cfg['bg'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas {{ $cfg['icon'] }}" style="font-size:24px;color:{{ $cfg['color'] }};"></i>
                </div>
                <div>
                    <h2 style="font-size:20px;font-weight:700;color:var(--text-dark);margin:0 0 6px;">{{ $materi->judul }}</h2>
                    <span class="badge {{ $cfg['badge'] }}">{{ $cfg['label'] }}</span>
                </div>
            </div>

            {{-- Deskripsi --}}
            @if($materi->deskripsi)
            <div style="background:var(--bg-light,#f8f9fa);border-radius:10px;padding:16px;margin-bottom:20px;">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;">Deskripsi</div>
                <p style="margin:0;color:var(--text-dark);font-size:14px;line-height:1.6;">{{ $materi->deskripsi }}</p>
            </div>
            @endif

            {{-- Tombol Akses --}}
            <div style="margin-top:8px;">
                @if($materi->tipe === 'file' && $materi->file)
                    <a href="{{ Storage::url($materi->file) }}" target="_blank" class="btn-primary-action">
                        <i class="fas fa-download"></i> Unduh File
                    </a>
                @elseif(in_array($materi->tipe, ['link', 'video']) && $materi->link_video)
                    <a href="{{ $materi->link_video }}" target="_blank" class="btn-primary-action">
                        <i class="fas fa-external-link-alt"></i>
                        {{ $materi->tipe === 'video' ? 'Tonton Video' : 'Buka Tautan' }}
                    </a>

                    {{-- Embed YouTube --}}
                    @if($materi->tipe === 'video' && Str::contains($materi->link_video, ['youtube.com', 'youtu.be']))
                    @php
                        preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_\-]+)/', $materi->link_video, $m);
                        $ytId = $m[1] ?? null;
                    @endphp
                    @if($ytId)
                    <div style="margin-top:20px;border-radius:12px;overflow:hidden;aspect-ratio:16/9;background:#000;">
                        <iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/{{ $ytId }}"
                                frameborder="0" allowfullscreen
                                style="display:block;"></iframe>
                    </div>
                    @endif
                    @endif
                @else
                    <div style="color:var(--text-muted);font-size:13px;">
                        <i class="fas fa-exclamation-circle"></i> Konten belum tersedia.
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Info Sidebar --}}
    <div style="display:flex;flex-direction:column;gap:16px;">
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-info-circle" style="color:var(--primary);margin-right:8px;"></i>Informasi</h3>
            </div>
            <div class="card-body">
                <dl style="display:grid;grid-template-columns:auto 1fr;gap:10px 12px;font-size:13px;margin:0;">
                    <dt style="color:var(--text-muted);white-space:nowrap;">Mata Pelajaran</dt>
                    <dd style="margin:0;font-weight:600;">{{ $materi->mataPelajaran->nama ?? '-' }}</dd>

                    <dt style="color:var(--text-muted);">Kelas</dt>
                    <dd style="margin:0;font-weight:600;">{{ $materi->kelas->nama_kelas ?? '-' }}</dd>
                    <dt style="color:var(--text-muted);">Tipe</dt>
                    <dd style="margin:0;"><span class="badge {{ $cfg['badge'] }}">{{ $cfg['label'] }}</span></dd>

                    <dt style="color:var(--text-muted);">Dibuat</dt>
                    <dd style="margin:0;">{{ $materi->created_at->format('d M Y') }}<br>
                        <span style="color:var(--text-muted);font-size:11px;">{{ $materi->created_at->format('H:i') }}</span>
                    </dd>

                    <dt style="color:var(--text-muted);">Diperbarui</dt>
                    <dd style="margin:0;">{{ $materi->updated_at->format('d M Y') }}<br>
                        <span style="color:var(--text-muted);font-size:11px;">{{ $materi->updated_at->format('H:i') }}</span>
                    </dd>
                </dl>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="content-card">
            <div class="card-header">
                <h3><i class="fas fa-bolt" style="color:var(--orange);margin-right:8px;"></i>Aksi</h3>
            </div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('guru.materi.edit', $materi) }}"
                   style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;background:#fef3e2;color:var(--orange,#f9ab00);font-size:13px;font-weight:600;text-decoration:none;">
                    <i class="fas fa-pencil-alt"></i> Edit Materi
                </a>
                <form action="{{ route('guru.materi.destroy', $materi) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus materi ini? Tindakan tidak dapat dibatalkan.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="width:100%;display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;background:#fce8e6;color:#d93025;font-size:13px;font-weight:600;border:none;cursor:pointer;">
                        <i class="fas fa-trash"></i> Hapus Materi
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection