@extends('layouts.public')

@section('title', $pageTitle ?? $item->judul . ' — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }

    .page-hero { position: relative; overflow: hidden; }
    .hero-pattern {
        position: absolute; inset: 0; opacity: .05;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 28px 28px;
    }

    /* ── UNTUK BADGE ── */
    .untuk-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
        padding: 5px 14px; border-radius: 999px;
    }
    .untuk-semua      { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .untuk-guru       { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .untuk-siswa      { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .untuk-wali_murid { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }

    /* ── CONTENT WRAPPER ── */
    .content-card {
        background: white; border-radius: 24px;
        border: 1.5px solid #e0e7ff;
        box-shadow: 0 4px 24px rgba(29,78,216,.06);
    }

    /* ── PROSE ── */
    .prose-content {
        font-size: 15px; line-height: 1.85; color: #374151;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .prose-content p   { margin-bottom: 1.4em; }
    .prose-content h2  { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 800; color: #111827; margin: 2em 0 .75em; }
    .prose-content h3  { font-size: 1.1rem; font-weight: 700; color: #1f2937; margin: 1.5em 0 .5em; }
    .prose-content ul  { list-style: none; padding: 0; margin-bottom: 1.4em; }
    .prose-content ul li { position: relative; padding-left: 1.4em; margin-bottom: .5em; }
    .prose-content ul li::before { content: ''; position: absolute; left: 0; top: .65em; width: 6px; height: 6px; border-radius: 50%; background: #1d4ed8; }
    .prose-content ol  { padding-left: 1.4em; margin-bottom: 1.4em; }
    .prose-content ol li { margin-bottom: .5em; }
    .prose-content blockquote {
        border-left: 3px solid #1d4ed8; margin: 1.5em 0;
        padding: 1em 1.5em; background: #eff6ff; border-radius: 0 12px 12px 0;
        color: #1e40af; font-style: italic;
    }
    .prose-content strong { color: #111827; font-weight: 700; }

    /* ── SHARE BUTTONS ── */
    .share-btn {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; border-radius: 12px; font-size: 12px; font-weight: 700;
        text-decoration: none; transition: all .2s; border: 1.5px solid; cursor: pointer;
        background: none; font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .share-wa   { background: #dcfce7; color: #16a34a; border-color: #bbf7d0; }
    .share-wa:hover   { background: #16a34a; color: white; }
    .share-copy { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .share-copy:hover { background: #1d4ed8; color: white; }

    /* ── RELATED / NAV CARD ── */
    .nav-card {
        background: white; border-radius: 16px; border: 1.5px solid #e0e7ff;
        padding: 16px; display: flex; gap: 14px; align-items: flex-start;
        text-decoration: none; transition: all .22s;
    }
    .nav-card:hover { border-color: #93c5fd; box-shadow: 0 6px 20px rgba(29,78,216,.1); transform: translateY(-2px); }

    .related-card {
        background: white; border-radius: 14px; border: 1.5px solid #e0e7ff;
        padding: 14px; display: flex; gap: 12px; align-items: flex-start;
        text-decoration: none; transition: all .2s;
    }
    .related-card:hover { border-color: #93c5fd; background: #f8fbff; }
    .related-icon {
        width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }

    /* Nav info bar */
    .info-nav-bar { background: white; border-bottom: 1px solid #e0e7ff; position: sticky; top: 0; z-index: 30; }
    .info-nav-link {
        display: inline-flex; align-items: center; gap: 6px; padding: 14px 20px;
        font-size: 13px; font-weight: 600; color: #6b7280; border-bottom: 2px solid transparent;
        text-decoration: none; transition: all .2s;
    }
    .info-nav-link:hover { color: #1d4ed8; }
    .info-nav-link.active { color: #1d4ed8; border-bottom-color: #1d4ed8; }

    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')

@php
    // $item dikirim dari BeritaController@show
    $unt     = $item->untuk ?? 'semua';
    $untCls  = 'untuk-' . $unt;
    $untLbl  = match($unt) {
        'guru'       => 'Khusus Guru',
        'siswa'      => 'Khusus Siswa',
        'wali_murid' => 'Wali Murid',
        default      => 'Untuk Semua',
    };
    $untIco  = match($unt) {
        'guru'       => 'fa-chalkboard-teacher',
        'siswa'      => 'fa-user-graduate',
        'wali_murid' => 'fa-users',
        default      => 'fa-bullhorn',
    };
    $heroGradient = match($unt) {
        'guru'       => 'linear-gradient(135deg, #451a03 0%, #78350f 50%, #d97706 100%)',
        'siswa'      => 'linear-gradient(135deg, #052e16 0%, #14532d 50%, #16a34a 100%)',
        'wali_murid' => 'linear-gradient(135deg, #431407 0%, #7c2d12 50%, #ea580c 100%)',
        default      => 'linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%)',
    };
    $accentBg = match($unt) {
        'guru'       => '#fffbeb', 'siswa' => '#f0fdf4', 'wali_murid' => '#fff7ed', default => '#eff6ff',
    };
    $accentBorder = match($unt) {
        'guru'       => '#fde68a', 'siswa' => '#bbf7d0', 'wali_murid' => '#fed7aa', default => '#bfdbfe',
    };
    $accentIconBg = match($unt) {
        'guru'       => '#fef3c7', 'siswa' => '#dcfce7', 'wali_murid' => '#ffedd5', default => '#dbeafe',
    };
    $accentColor = match($unt) {
        'guru'       => '#d97706', 'siswa' => '#16a34a', 'wali_murid' => '#ea580c', default => '#1d4ed8',
    };
@endphp

{{-- HERO --}}
<div class="page-hero py-16" style="background: {{ $heroGradient }}">
    <div class="hero-pattern"></div>
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">Berita & Pengumuman</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/70 truncate max-w-[200px]">{{ $item->judul }}</span>
        </nav>

        <div class="flex items-center gap-3 mb-5 flex-wrap">
            <span class="untuk-badge {{ $untCls }}">
                <i class="fa {{ $untIco }}"></i> {{ $untLbl }}
            </span>
            @if(!$item->is_aktif)
            <span class="inline-flex items-center gap-1 bg-red-500/20 text-red-200 border border-red-400/30 text-[10px] font-bold px-3 py-1 rounded-full">
                <i class="fa fa-eye-slash text-[9px]"></i> Tidak Aktif
            </span>
            @endif
        </div>

        <h1 class="font-display text-white font-black leading-tight mb-5" style="font-size: clamp(1.8rem, 4vw, 3rem);">
            {{ $item->judul }}
        </h1>

        <div class="flex items-center gap-5 text-white/60 text-xs flex-wrap">
            @if($item->user)
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 bg-white/15 rounded-full flex items-center justify-center border border-white/20">
                    <i class="fa fa-user text-white/70 text-[10px]"></i>
                </div>
                <span class="text-white/80 font-semibold">{{ $item->user->name }}</span>
            </div>
            @endif
            <div class="flex items-center gap-1.5">
                <i class="fa fa-calendar text-[10px]"></i>
                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fa fa-clock text-[10px]"></i>
                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB
            </div>
        </div>
    </div>
</div>

{{-- INFO NAV BAR --}}
<div class="info-nav-bar shadow-sm">
    <div class="max-w-5xl mx-auto px-6 flex gap-1 overflow-x-auto">
        <a href="{{ route('berita.index') }}"      class="info-nav-link active whitespace-nowrap"><i class="fa fa-bullhorn"></i> Pengumuman</a>
        <a href="{{ route('berita.agenda') }}"     class="info-nav-link whitespace-nowrap"><i class="fa fa-calendar-alt"></i> Agenda Kegiatan</a>
        <a href="{{ route('berita.info-dinas') }}" class="info-nav-link whitespace-nowrap"><i class="fa fa-university"></i> Info Dinas</a>
    </div>
</div>

<main class="bg-gray-50">
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Konten Utama --}}
            <div class="lg:col-span-2">
                <article class="content-card p-8 md:p-10 mb-6 fade-up">

                    {{-- Kotak penerima --}}
                    <div class="flex items-center gap-3 p-4 rounded-2xl mb-8"
                         style="background:{{ $accentBg }};border:1px solid {{ $accentBorder }};">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:{{ $accentIconBg }};">
                            <i class="fa {{ $untIco }}" style="color:{{ $accentColor }};"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Pengumuman ini ditujukan untuk</p>
                            <p class="text-sm font-bold text-gray-800">{{ $untLbl }}</p>
                        </div>
                    </div>

                    {{-- Isi --}}
                    <div class="prose-content">
                        {!! nl2br(e($item->isi)) !!}
                    </div>

                    {{-- Divider --}}
                    <div class="my-8" style="height:1px;background:linear-gradient(90deg,transparent,#e5e7eb 30%,#e5e7eb 70%,transparent);"></div>

                    {{-- Share --}}
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wide">Bagikan:</span>
                        <a href="https://wa.me/?text={{ urlencode($item->judul . ' — ' . url()->current()) }}"
                           target="_blank" rel="noopener" class="share-btn share-wa">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <button onclick="copyLink()" class="share-btn share-copy" id="copyBtn">
                            <i class="fa fa-link"></i> Salin Tautan
                        </button>
                    </div>
                </article>

                {{-- Navigasi prev / next --}}
                @if(isset($prev) || isset($next))
                <div class="grid grid-cols-2 gap-4 fade-up">
                    @if($prev)
                    <a href="{{ route('berita.show', $prev->id) }}" class="nav-card">
                        <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-chevron-left text-gray-400 text-xs"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-400 font-semibold uppercase mb-1">Sebelumnya</p>
                            <p class="text-xs font-bold text-gray-700 line-clamp-2 leading-snug">{{ $prev->judul }}</p>
                        </div>
                    </a>
                    @else <div></div> @endif

                    @if($next)
                    <a href="{{ route('berita.show', $next->id) }}" class="nav-card flex-row-reverse text-right">
                        <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fa fa-chevron-right text-gray-400 text-xs"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-400 font-semibold uppercase mb-1">Berikutnya</p>
                            <p class="text-xs font-bold text-gray-700 line-clamp-2 leading-snug">{{ $next->judul }}</p>
                        </div>
                    </a>
                    @endif
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-5">

                {{-- Detail Info --}}
                <div class="content-card p-5 fade-up">
                    <h4 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                        <i class="fa fa-info-circle text-blue-500"></i> Detail Pengumuman
                    </h4>
                    <div class="space-y-1">
                        @php $rows = [
                            ['Ditujukan untuk', $untLbl,                                             'badge'],
                            ['Tanggal',  \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM Y'), 'text'],
                            ['Pukul',    \Carbon\Carbon::parse($item->created_at)->format('H:i').' WIB', 'text'],
                            ['Penulis',  $item->user->name ?? '—',                                   'text'],
                            ['Status',   $item->is_aktif ? 'Aktif' : 'Nonaktif',                     'status'],
                        ]; @endphp
                        @foreach($rows as [$label, $value, $type])
                        <div class="flex justify-between items-center text-xs py-2.5 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                            <span class="text-gray-400 font-semibold">{{ $label }}</span>
                            @if($type === 'badge')
                                <span class="untuk-badge {{ $untCls }} text-[10px]">{{ $value }}</span>
                            @elseif($type === 'status')
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-full border
                                    {{ $item->is_aktif ? 'bg-green-50 text-green-600 border-green-100' : 'bg-red-50 text-red-500 border-red-100' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->is_aktif ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    {{ $value }}
                                </span>
                            @else
                                <span class="text-gray-700 font-bold">{{ $value }}</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Pengumuman Lainnya --}}
                @if(isset($lainnya) && $lainnya->count() > 0)
                <div class="content-card p-5 fade-up">
                    <h4 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                        <i class="fa fa-list text-blue-500"></i> Pengumuman Lainnya
                    </h4>
                    <div class="space-y-2">
                        @foreach($lainnya as $rel)
                        @php
                            $relUnt = $rel->untuk ?? 'semua';
                            $relIco = match($relUnt) {
                                'guru'       => 'fa-chalkboard-teacher',
                                'siswa'      => 'fa-user-graduate',
                                'wali_murid' => 'fa-users',
                                default      => 'fa-bullhorn',
                            };
                            $relIconBg = match($relUnt) {
                                'guru'       => 'linear-gradient(135deg,#fef3c7,#fde68a)',
                                'siswa'      => 'linear-gradient(135deg,#dcfce7,#bbf7d0)',
                                'wali_murid' => 'linear-gradient(135deg,#ffedd5,#fed7aa)',
                                default      => 'linear-gradient(135deg,#dbeafe,#bfdbfe)',
                            };
                            $relIconColor = match($relUnt) {
                                'guru'       => '#d97706',
                                'siswa'      => '#16a34a',
                                'wali_murid' => '#ea580c',
                                default      => '#1d4ed8',
                            };
                        @endphp
                        <a href="{{ route('berita.show', $rel->id) }}" class="related-card">
                            <div class="related-icon" style="background: {{ $relIconBg }};">
                                <i class="fa {{ $relIco }}" style="color:{{ $relIconColor }};font-size:.85rem;"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-gray-700 line-clamp-2 leading-snug mb-1">{{ $rel->judul }}</p>
                                <p class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($rel->created_at)->locale('id')->isoFormat('D MMM Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <a href="{{ route('berita.index') }}" class="mt-4 flex items-center justify-center gap-2 text-blue-600 text-xs font-bold py-3 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors">
                        Lihat Semua <i class="fa fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
                @endif

            </aside>
        </div>
    </div>
</section>
</main>

@endsection

@push('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = document.getElementById('copyBtn');
        btn.innerHTML = '<i class="fa fa-check"></i> Tersalin!';
        btn.classList.add('share-wa');
        btn.classList.remove('share-copy');
        setTimeout(() => {
            btn.innerHTML = '<i class="fa fa-link"></i> Salin Tautan';
            btn.classList.remove('share-wa');
            btn.classList.add('share-copy');
        }, 2000);
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const obs = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
});
</script>
@endpush