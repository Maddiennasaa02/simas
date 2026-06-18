@extends('layouts.public')

@section('title', $pageTitle ?? 'Akreditasi — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }

    /* ── PAGE HERO ── */
    .page-hero {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%);
        position: relative; overflow: hidden;
    }
    .hero-pattern {
        position: absolute; inset: 0; opacity: .05;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 28px 28px;
    }

    /* ── SECTION LABEL ── */
    .sec-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: #1d4ed8; background: #eff6ff; border: 1px solid #bfdbfe;
        padding: 4px 14px; border-radius: 999px; margin-bottom: 12px;
    }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; }

    /* ── DIVIDER ── */
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); }

    /* ── AKREDITASI BADGE (besar, hero) ── */
    .akreditasi-badge {
        width: 160px; height: 160px; border-radius: 50%;
        background: linear-gradient(135deg, #d97706, #f59e0b, #fbbf24);
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        box-shadow: 0 0 0 8px rgba(251,191,36,.2), 0 0 0 16px rgba(251,191,36,.08);
        position: relative; flex-shrink: 0;
    }
    .akreditasi-badge .grade {
        font-family: 'Playfair Display', serif;
        font-size: 5rem; font-weight: 900; color: white;
        line-height: 1; text-shadow: 0 2px 12px rgba(0,0,0,.18);
    }
    .akreditasi-badge .grade-label {
        font-size: 10px; font-weight: 800; letter-spacing: .15em;
        color: rgba(255,255,255,.85); text-transform: uppercase;
    }

    /* ── INFO CARD ── */
    .info-card {
        background: white; border-radius: 20px;
        border: 1px solid #f1f5f9;
        transition: all .3s; position: relative; overflow: hidden;
    }
    .info-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .info-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
        background: #1d4ed8; opacity: 0; transition: opacity .3s;
    }
    .info-card:hover::after { opacity: 1; }

    /* ── KOMPONEN CARD ── */
    .komponen-card {
        background: white; border-radius: 18px; padding: 20px;
        border: 1px solid #f1f5f9;
        transition: all .25s; position: relative; overflow: hidden;
    }
    .komponen-card:hover { border-color: #bfdbfe; box-shadow: 0 8px 24px rgba(29,78,216,.08); transform: translateY(-3px); }
    .komponen-card::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
        background: #1d4ed8; border-radius: 0 2px 2px 0; opacity: 0; transition: opacity .25s;
    }
    .komponen-card:hover::before { opacity: 1; }

    /* ── PROGRESS BAR ── */
    .progress-wrap { height: 6px; background: #f1f5f9; border-radius: 999px; overflow: hidden; }
    .progress-bar  { height: 100%; border-radius: 999px; transition: width 1.2s cubic-bezier(.4,0,.2,1); }

    /* ── TIMELINE ── */
    .timeline-item { position: relative; padding-left: 32px; }
    .timeline-item::before {
        content: ''; position: absolute; left: 9px; top: 28px; bottom: -16px;
        width: 2px; background: #e5e7eb;
    }
    .timeline-item:last-child::before { display: none; }
    .timeline-dot {
        position: absolute; left: 0; top: 6px;
        width: 20px; height: 20px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 8px;
    }

    /* ── HUKUM CARD (sama persis komite) ── */
    .hukum-card {
        background: linear-gradient(145deg, #1e3a8a, #1d4ed8);
        border-radius: 22px; padding: 28px 32px;
        position: relative; overflow: hidden;
    }
    .hukum-card::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 20px 20px;
    }

    /* ── CTA BAND ── */
    .cta-band {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%);
        position: relative; overflow: hidden;
    }
    .cta-band::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 24px 24px;
    }

    /* Animasi */
    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    .progress-bar { width: 0; }
    .progress-bar.animated { width: var(--target-width); }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════
     PAGE HERO
══════════════════════════════════════ --}}
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div style="position:absolute;width:400px;height:400px;right:-100px;top:-100px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;width:240px;height:240px;left:6%;bottom:-70px;border-radius:50%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);pointer-events:none;"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <a href="#" class="hover:text-white transition-colors">Profil</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Akreditasi</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Profil Sekolah
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Akreditasi<br>
                    <span style="color:#FDE68A;">Sekolah</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl" style="font-size:1rem;">
                    Pengakuan resmi dari Badan Akreditasi Nasional atas kualitas penyelenggaraan
                    pendidikan di SDN Sukorame 1 Kota Kediri.
                </p>

                <div class="flex flex-wrap gap-3 mt-7">
                    @foreach([
                        ['#sertifikat', 'fa-certificate',  'Sertifikat'],
                    ] as $n)
                    <a href="{{ $n[0] }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                        <i class="fa {{ $n[1] }} text-amber-300 text-[10px]"></i> {{ $n[2] }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Akreditasi Badge --}}
            @php
                $grade      = isset($sekolah->akreditasi)         ? $sekolah->akreditasi         : 'B';
                $nilaiAkr   = isset($sekolah->nilai_akreditasi)   ? $sekolah->nilai_akreditasi   : '80,22';
                $tahunAkr   = isset($sekolah->tahun_akreditasi)   ? $sekolah->tahun_akreditasi   : '2022';
                $noSk       = isset($sekolah->nomor_sk_akreditasi)? $sekolah->nomor_sk_akreditasi: '—';
            @endphp
            <div class="flex flex-col items-center gap-4 flex-shrink-0">
                <div class="akreditasi-badge">
                    <span class="grade">{{ $grade }}</span>
                    <span class="grade-label">Akreditasi</span>
                </div>
                <div class="text-center">
                    <p class="text-white font-black text-2xl">{{ $nilaiAkr }}</p>
                    <p class="text-white/60 text-xs">Nilai Akreditasi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">

    {{-- ══════════════════════════════════════
         SERTIFIKAT & INFO UTAMA
    ══════════════════════════════════════ --}}
    <section id="sertifikat" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Sertifikasi</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Detail Akreditasi</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Informasi lengkap sertifikasi akreditasi SDN Sukorame 1 dari BAN-S/M.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                @php
                    $infos = [
                        ['lbl'=>'Peringkat',        'val'=>$grade,     'ico'=>'fa-medal',          'bg'=>'bg-amber-50', 'ico_c'=>'text-amber-600', 'val_c'=>'text-amber-700'],
                        ['lbl'=>'Nilai',             'val'=>$nilaiAkr,  'ico'=>'fa-star',           'bg'=>'bg-blue-50',  'ico_c'=>'text-blue-600',  'val_c'=>'text-blue-700'],
                        ['lbl'=>'Tahun Akreditasi',  'val'=>$tahunAkr,  'ico'=>'fa-calendar-check', 'bg'=>'bg-green-50', 'ico_c'=>'text-green-600', 'val_c'=>'text-green-700'],
                        ['lbl'=>'Lembaga',           'val'=>'BAN-S/M',  'ico'=>'fa-building-columns','bg'=>'bg-indigo-50','ico_c'=>'text-indigo-600','val_c'=>'text-indigo-700'],
                    ];
                @endphp
                @foreach($infos as $idx => $info)
                <div class="info-card p-6 text-center fade-up" style="transition-delay: {{ $idx * 70 }}ms">
                    <div class="w-12 h-12 {{ $info['bg'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i class="fa {{ $info['ico'] }} {{ $info['ico_c'] }} text-xl"></i>
                    </div>
                    <p class="font-black {{ $info['val_c'] }} text-2xl leading-none">{{ $info['val'] }}</p>
                    <p class="text-gray-500 text-xs mt-2">{{ $info['lbl'] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Detail SK + Gambar Sertifikat --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 fade-up">

                {{-- Detail SK --}}
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
                    <p class="text-blue-800 font-bold text-xs uppercase tracking-wider mb-4">Detail Surat Keputusan</p>
                    <div class="space-y-4">
                        @php
                            $skDetails = [
                                ['lbl'=>'Nomor SK',            'val'=>$noSk],
                                ['lbl'=>'Lembaga Penerbit',    'val'=>'BAN-S/M (Badan Akreditasi Nasional Sekolah/Madrasah)'],
                                ['lbl'=>'Tahun Berlaku',       'val'=>$tahunAkr . ' – ' . ($tahunAkr + 5)],
                                ['lbl'=>'Status',              'val'=>'Aktif & Berlaku'],
                            ];
                        @endphp
                        @foreach($skDetails as $sk)
                        <div class="flex flex-col gap-1 border-b border-blue-100 pb-3 last:border-0 last:pb-0">
                            <span class="text-blue-500 font-semibold text-xs">{{ $sk['lbl'] }}</span>
                            <span class="text-blue-900 font-bold text-sm">{{ $sk['val'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Gambar Sertifikat --}}
                @php
                    $imgSertifikat = public_path('images/sertifikat-akreditasi.jpg');
                    $hasSertifikat = file_exists($imgSertifikat) || file_exists(public_path('images/sertifikat-akreditasi.png'));
                    $sertifikatUrl = file_exists(public_path('images/sertifikat-akreditasi.jpg'))
                        ? asset('images/sertifikat-akreditasi.jpg')
                        : (file_exists(public_path('images/sertifikat-akreditasi.png'))
                            ? asset('images/sertifikat-akreditasi.png')
                            : null);
                @endphp
                <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden flex flex-col">
                    <div class="px-5 pt-5 pb-3">
                        <p class="text-gray-800 font-bold text-xs uppercase tracking-wider">Sertifikat Akreditasi</p>
                        <p class="text-gray-400 text-xs mt-0.5">Dokumen resmi BAN-S/M</p>
                    </div>

                    @if($sertifikatUrl)
                    {{-- Ada file gambar --}}
                    <div class="relative flex-1 mx-5 mb-5 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 cursor-pointer group"
                         onclick="openLightbox('{{ $sertifikatUrl }}')">
                        <img src="{{ $sertifikatUrl }}"
                             alt="Sertifikat Akreditasi SDN Sukorame 1"
                             class="w-full object-cover transition-transform duration-300 group-hover:scale-105"
                             style="max-height: 220px; object-fit: contain; padding: 8px;">
                        {{-- Overlay zoom --}}
                        <div class="absolute inset-0 bg-blue-900/0 group-hover:bg-blue-900/20 transition-all flex items-center justify-center">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                <i class="fa fa-magnifying-glass-plus text-blue-700 text-sm"></i>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 pb-5">
                        <button onclick="openLightbox('{{ $sertifikatUrl }}')"
                                class="w-full inline-flex items-center justify-center gap-2 bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 font-bold text-xs px-4 py-2.5 rounded-xl transition-colors">
                            <i class="fa fa-expand text-[10px]"></i> Lihat Ukuran Penuh
                        </button>
                    </div>

                    @else
                    {{-- Belum ada file --}}
                    <div class="flex-1 mx-5 mb-5 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center gap-3 py-10">
                        <div class="w-14 h-14 bg-amber-50 border border-amber-200 rounded-2xl flex items-center justify-center">
                            <i class="fa fa-certificate text-amber-500 text-2xl"></i>
                        </div>
                        <div class="text-center px-4">
                            <p class="text-gray-600 font-bold text-sm">Sertifikat belum diunggah</p>
                            <p class="text-gray-400 text-xs mt-1 leading-relaxed">
                                Taruh file gambar di<br>
                                <code class="bg-gray-100 px-1.5 py-0.5 rounded text-[10px] font-mono text-gray-600">
                                    public/images/sertifikat-akreditasi.jpg
                                </code>
                            </p>
                        </div>
                    </div>
                    @endif
                </div>

            </div>{{-- end grid SK + foto --}}
        </div>
    </section>

    {{-- ══════════════════════════════════════
         LIGHTBOX MODAL
    ══════════════════════════════════════ --}}
    <div id="lightbox"
         class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden"
         onclick="closeLightbox()">
        <div class="relative max-w-3xl w-full" onclick="event.stopPropagation()">
            <button onclick="closeLightbox()"
                    class="absolute -top-4 -right-4 w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-gray-100 transition-colors z-10">
                <i class="fa fa-xmark text-gray-700 text-sm"></i>
            </button>
            <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
                <div class="bg-gray-50 px-5 py-3 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fa fa-certificate text-amber-500 text-sm"></i>
                        <span class="font-bold text-gray-800 text-sm">Sertifikat Akreditasi — SDN Sukorame 1</span>
                    </div>
                    <a id="lightbox-download" href="#" download
                       class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-colors">
                        <i class="fa fa-download text-[10px]"></i> Unduh
                    </a>
                </div>
                <div class="p-4 bg-gray-50">
                    <img id="lightbox-img" src="" alt="Sertifikat Akreditasi"
                         class="w-full rounded-lg shadow-sm object-contain max-h-[70vh]">
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

@push('scripts')
<script>
    function openLightbox(url) {
        document.getElementById('lightbox-img').src = url;
        document.getElementById('lightbox-download').href = url;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

document.addEventListener('DOMContentLoaded', function () {
    // Fade-up observer
    const obs = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));

    // Progress bar observer
    const progObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const bar = e.target.querySelector('.progress-bar');
                if (bar) {
                    setTimeout(() => bar.classList.add('animated'), 200);
                }
                progObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('.komponen-card').forEach(el => progObs.observe(el));
});
</script>
@endpush