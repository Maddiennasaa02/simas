@extends('layouts.public')

@section('title', $pageTitle ?? 'Kalender Akademik — SDN Sukorame 1')

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

    /* ── CARD BASE ── */
    .kal-card {
        background: white; border-radius: 20px;
        border: 1.5px solid #e0e7ff;
        transition: all .25s; overflow: hidden;
    }
    .kal-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 12px 32px rgba(29,78,216,.12);
        transform: translateY(-3px);
    }

    /* ── MONTH HEADER ── */
    .month-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        color: white; border-radius: 16px 16px 0 0;
        padding: 14px 18px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .month-header.indigo {
        background: linear-gradient(135deg, #312e81 0%, #4338ca 100%);
    }
    .month-header.violet {
        background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%);
    }
    .month-header.green {
        background: linear-gradient(135deg, #064e3b 0%, #059669 100%);
    }
    .month-header.amber {
        background: linear-gradient(135deg, #78350f 0%, #d97706 100%);
    }
    .month-header.red {
        background: linear-gradient(135deg, #7f1d1d 0%, #dc2626 100%);
    }
    .month-header.teal {
        background: linear-gradient(135deg, #134e4a 0%, #0d9488 100%);
    }

    /* ── EVENT ROW ── */
    .event-row {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 11px 14px; border-radius: 12px;
        border: 1px solid #f1f5f9; background: white;
        transition: all .2s; margin-bottom: 6px;
    }
    .event-row:last-child { margin-bottom: 0; }
    .event-row:hover { border-color: #bfdbfe; background: #f8fbff; }

    /* ── BADGE ── */
    .ev-badge {
        display: inline-flex; align-items: center;
        font-size: 9px; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        padding: 2px 8px; border-radius: 999px; flex-shrink: 0;
        margin-top: 2px;
    }

    /* ── TIMELINE FULL ── */
    .tl-item { position: relative; padding-left: 36px; margin-bottom: 0; }
    .tl-item::before {
        content: ''; position: absolute; left: 11px; top: 28px;
        bottom: -12px; width: 2px; background: #bfdbfe;
    }
    .tl-item:last-child::before { display: none; }
    .tl-dot {
        position: absolute; left: 0; top: 16px;
        width: 24px; height: 24px; border-radius: 50%;
        background: #1d4ed8; border: 3px solid #bfdbfe;
        display: flex; align-items: center; justify-content: center;
        z-index: 1;
    }
    .tl-dot i { font-size: 8px; color: white; }
    .tl-card {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 14px 16px;
        margin-bottom: 14px; transition: all .22s;
    }
    .tl-card:hover { border-color: #93c5fd; box-shadow: 0 8px 24px rgba(29,78,216,.1); }

    /* ── LEGEND DOT ── */
    .leg-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    /* ── STAT MINI ── */
    .stat-mini {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 18px 14px;
        text-align: center; transition: all .22s;
    }
    .stat-mini:hover { border-color: #93c5fd; box-shadow: 0 8px 20px rgba(29,78,216,.1); transform: translateY(-2px); }

    /* ── CTA ── */
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
            <a href="#" class="hover:text-white transition-colors">Akademik</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Kalender Akademik</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Akademik
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Kalender<br>
                    <span style="color:#FDE68A;">Akademik</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-lg" style="font-size:1rem;">
                    Jadwal kegiatan dan agenda resmi SD Negeri Sukorame 1 Kota Kediri
                    tahun ajaran <strong class="text-white">{{ date('Y') }}/{{ date('Y') + 1 }}</strong>.
                </p>
            </div>

            {{-- Quick stat --}}
            <div class="flex gap-3 flex-shrink-0">
                @php
                    $hs = [
                        ['val'=> $stats['semester']   ?? '2',   'lbl'=>'Semester',      'ico'=>'fa-layer-group'],
                        ['val'=> $stats['hariEfektif']?? '220', 'lbl'=>'Hari Efektif',  'ico'=>'fa-calendar-check'],
                        ['val'=> $stats['kegiatan']   ?? '18',  'lbl'=>'Kegiatan',      'ico'=>'fa-star'],
                    ];
                @endphp
                @foreach ($hs as $h)
                <div class="bg-white/10 border border-white/20 rounded-2xl p-4 text-center w-24 backdrop-blur-sm">
                    <i class="fa {{ $h['ico'] }} text-amber-300 text-base mb-2 block"></i>
                    <p class="text-white font-black text-xl leading-none">{{ $h['val'] }}</p>
                    <p class="text-white/55 text-[10px] mt-1">{{ $h['lbl'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">

    {{-- ══════════════════════════════════════
         RINGKASAN TAHUN AJARAN
    ══════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Ringkasan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Gambaran umum jadwal kegiatan akademik selama satu tahun pelajaran,
                    mencakup penilaian, libur, dan kegiatan sekolah.
                </p>
            </div>

            {{-- Stat row --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-14 fade-up">
                @php
                    $ringkasan = [
                        ['icon'=>'fa-calendar-alt',   'val'=>'220',     'lbl'=>'Hari Efektif',       'color'=>'bg-blue-50 text-blue-600'],
                        ['icon'=>'fa-sun',             'val'=>'2',       'lbl'=>'Semester',           'color'=>'bg-amber-50 text-amber-600'],
                        ['icon'=>'fa-clipboard-list',  'val'=>'6',       'lbl'=>'Pekan Penilaian',    'color'=>'bg-indigo-50 text-indigo-600'],
                        ['icon'=>'fa-umbrella-beach',  'val'=>'55+',     'lbl'=>'Hari Libur',         'color'=>'bg-green-50 text-green-600'],
                    ];
                @endphp
                @foreach ($ringkasan as $r)
                <div class="stat-mini fade-up">
                    <div class="w-12 h-12 {{ $r['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i class="fa {{ $r['icon'] }} text-lg"></i>
                    </div>
                    <p class="font-black text-gray-900 text-2xl leading-tight">{{ $r['val'] }}</p>
                    <p class="text-gray-400 text-xs mt-1">{{ $r['lbl'] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Legenda warna --}}
            <div class="fade-up">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Keterangan Warna</p>
                <div class="flex flex-wrap gap-4">
                    @php
                        $legenda = [
                            ['color'=>'bg-blue-500',   'label'=>'Kegiatan Belajar Mengajar'],
                            ['color'=>'bg-amber-500',  'label'=>'Penilaian / Ujian'],
                            ['color'=>'bg-green-500',  'label'=>'Kegiatan Sekolah'],
                            ['color'=>'bg-red-400',    'label'=>'Libur Nasional'],
                            ['color'=>'bg-violet-500', 'label'=>'Libur Semester'],
                            ['color'=>'bg-teal-500',   'label'=>'PPDB / Administrasi'],
                        ];
                    @endphp
                    @foreach ($legenda as $l)
                    <div class="flex items-center gap-2">
                        <span class="leg-dot {{ $l['color'] }}"></span>
                        <span class="text-xs text-gray-600 font-medium">{{ $l['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         SEMESTER 1
    ══════════════════════════════════════ --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">

            <div class="flex items-center gap-4 mb-10 fade-up">
                <div>
                    <div class="sec-label">Semester Ganjil</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900">Semester 1 &mdash; Juli s.d. Desember {{ date('Y') }}</h2>
                </div>
            </div>

            @php
                $sem1 = [
                    [
                        'bulan'  => 'Juli',
                        'tahun'  => date('Y'),
                        'color'  => '',
                        'events' => [
                            ['tgl'=>'10 – 12', 'nama'=>'Masa Pengenalan Lingkungan Sekolah (MPLS)',   'type'=>'kegiatan', 'icon'=>'fa-school'],
                            ['tgl'=>'14',      'nama'=>'Awal Kegiatan Belajar Mengajar Semester 1',   'type'=>'kbm',      'icon'=>'fa-book-open'],
                            ['tgl'=>'17',      'nama'=>'Libur Tahun Baru Islam 1 Muharram',           'type'=>'libur',    'icon'=>'fa-moon'],
                        ],
                    ],
                    [
                        'bulan'  => 'Agustus',
                        'tahun'  => date('Y'),
                        'color'  => 'indigo',
                        'events' => [
                            ['tgl'=>'17',      'nama'=>'Peringatan HUT Kemerdekaan RI (Upacara)',      'type'=>'kegiatan', 'icon'=>'fa-flag'],
                            ['tgl'=>'18',      'nama'=>'Libur HUT Kemerdekaan RI',                    'type'=>'libur',    'icon'=>'fa-umbrella-beach'],
                        ],
                    ],
                    [
                        'bulan'  => 'September',
                        'tahun'  => date('Y'),
                        'color'  => 'violet',
                        'events' => [
                            ['tgl'=>'1 – 6',   'nama'=>'Penilaian Tengah Semester (PTS) 1',           'type'=>'ujian',    'icon'=>'fa-clipboard-list'],
                            ['tgl'=>'16',      'nama'=>'Maulid Nabi Muhammad SAW (Libur)',             'type'=>'libur',    'icon'=>'fa-moon'],
                        ],
                    ],
                    [
                        'bulan'  => 'Oktober',
                        'tahun'  => date('Y'),
                        'color'  => 'green',
                        'events' => [
                            ['tgl'=>'2',       'nama'=>'Hari Batik Nasional (Kegiatan Batik Sekolah)', 'type'=>'kegiatan', 'icon'=>'fa-palette'],
                            ['tgl'=>'28',      'nama'=>'Peringatan Hari Sumpah Pemuda',               'type'=>'kegiatan', 'icon'=>'fa-users'],
                        ],
                    ],
                    [
                        'bulan'  => 'November',
                        'tahun'  => date('Y'),
                        'color'  => 'amber',
                        'events' => [
                            ['tgl'=>'10',      'nama'=>'Peringatan Hari Pahlawan',                    'type'=>'kegiatan', 'icon'=>'fa-star'],
                            ['tgl'=>'24 – 29', 'nama'=>'Penilaian Akhir Semester (PAS) 1',            'type'=>'ujian',    'icon'=>'fa-clipboard-list'],
                        ],
                    ],
                    [
                        'bulan'  => 'Desember',
                        'tahun'  => date('Y'),
                        'color'  => 'red',
                        'events' => [
                            ['tgl'=>'1 – 5',   'nama'=>'Remedial & Pengayaan',                        'type'=>'kbm',      'icon'=>'fa-sync'],
                            ['tgl'=>'13',      'nama'=>'Pembagian Rapor Semester 1',                  'type'=>'kegiatan', 'icon'=>'fa-file-alt'],
                            ['tgl'=>'21 – 31', 'nama'=>'Libur Semester Ganjil',                       'type'=>'liburs',   'icon'=>'fa-umbrella-beach'],
                            ['tgl'=>'25',      'nama'=>'Libur Hari Natal',                            'type'=>'libur',    'icon'=>'fa-church'],
                        ],
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($sem1 as $bln)
                <div class="kal-card fade-up">
                    <div class="month-header {{ $bln['color'] }}">
                        <div>
                            <p class="text-white font-black text-lg leading-none">{{ $bln['bulan'] }}</p>
                            <p class="text-white/60 text-xs mt-0.5">{{ $bln['tahun'] }}</p>
                        </div>
                        <div class="bg-white/15 rounded-xl px-3 py-1">
                            <span class="text-white font-bold text-sm">{{ count($bln['events']) }} agenda</span>
                        </div>
                    </div>
                    <div class="p-4">
                        @foreach ($bln['events'] as $ev)
                        @php
                            $typeCfg = match($ev['type']) {
                                'ujian'   => ['bg'=>'bg-amber-100 text-amber-700',  'label'=>'Ujian'],
                                'libur'   => ['bg'=>'bg-red-100 text-red-600',      'label'=>'Libur'],
                                'liburs'  => ['bg'=>'bg-violet-100 text-violet-700','label'=>'Libur Smt'],
                                'kegiatan'=> ['bg'=>'bg-green-100 text-green-700',  'label'=>'Kegiatan'],
                                default   => ['bg'=>'bg-blue-100 text-blue-700',    'label'=>'KBM'],
                            };
                        @endphp
                        <div class="event-row">
                            <div class="w-9 h-9 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $ev['icon'] }} text-gray-500 text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-gray-900 font-semibold text-xs leading-tight mb-1">{{ $ev['nama'] }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="ev-badge {{ $typeCfg['bg'] }}">{{ $typeCfg['label'] }}</span>
                                    <span class="text-gray-400 text-[10px]">{{ $ev['tgl'] }} {{ $bln['bulan'] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         SEMESTER 2
    ══════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">

            <div class="flex items-center gap-4 mb-10 fade-up">
                <div>
                    <div class="sec-label">Semester Genap</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900">Semester 2 &mdash; Januari s.d. Juni {{ date('Y') + 1 }}</h2>
                </div>
            </div>

            @php
                $sem2 = [
                    [
                        'bulan'  => 'Januari',
                        'tahun'  => date('Y') + 1,
                        'color'  => '',
                        'events' => [
                            ['tgl'=>'1',       'nama'=>'Libur Tahun Baru Masehi',                     'type'=>'libur',    'icon'=>'fa-glass-cheers'],
                            ['tgl'=>'6',       'nama'=>'Awal Kegiatan Belajar Mengajar Semester 2',   'type'=>'kbm',      'icon'=>'fa-book-open'],
                            ['tgl'=>'27',      'nama'=>'Tahun Baru Imlek (Libur)',                    'type'=>'libur',    'icon'=>'fa-dragon'],
                        ],
                    ],
                    [
                        'bulan'  => 'Februari',
                        'tahun'  => date('Y') + 1,
                        'color'  => 'indigo',
                        'events' => [
                            ['tgl'=>'5',       'nama'=>'Isra Miraj Nabi Muhammad SAW (Libur)',        'type'=>'libur',    'icon'=>'fa-moon'],
                            ['tgl'=>'12',      'nama'=>'Peringatan Hari Pendidikan Sekolah',          'type'=>'kegiatan', 'icon'=>'fa-graduation-cap'],
                        ],
                    ],
                    [
                        'bulan'  => 'Maret',
                        'tahun'  => date('Y') + 1,
                        'color'  => 'teal',
                        'events' => [
                            ['tgl'=>'3 – 8',   'nama'=>'Penilaian Tengah Semester (PTS) 2',           'type'=>'ujian',    'icon'=>'fa-clipboard-list'],
                            ['tgl'=>'29',      'nama'=>'Libur Wafat Isa Al-Masih',                    'type'=>'libur',    'icon'=>'fa-cross'],
                            ['tgl'=>'30 – 31', 'nama'=>'Awal Libur Ramadan',                          'type'=>'libur',    'icon'=>'fa-moon'],
                        ],
                    ],
                    [
                        'bulan'  => 'April',
                        'tahun'  => date('Y') + 1,
                        'color'  => 'amber',
                        'events' => [
                            ['tgl'=>'1 – 5',   'nama'=>'Libur Idul Fitri',                            'type'=>'libur',    'icon'=>'fa-star-and-crescent'],
                            ['tgl'=>'14',      'nama'=>'Masuk Sekolah Kembali',                       'type'=>'kbm',      'icon'=>'fa-door-open'],
                            ['tgl'=>'21',      'nama'=>'Peringatan Hari Kartini',                     'type'=>'kegiatan', 'icon'=>'fa-female'],
                        ],
                    ],
                    [
                        'bulan'  => 'Mei',
                        'tahun'  => date('Y') + 1,
                        'color'  => 'violet',
                        'events' => [
                            ['tgl'=>'1',       'nama'=>'Libur Hari Buruh Internasional',              'type'=>'libur',    'icon'=>'fa-hard-hat'],
                            ['tgl'=>'2',       'nama'=>'Peringatan Hari Pendidikan Nasional',         'type'=>'kegiatan', 'icon'=>'fa-graduation-cap'],
                            ['tgl'=>'12 – 17', 'nama'=>'Penilaian Akhir Tahun (PAT)',                 'type'=>'ujian',    'icon'=>'fa-clipboard-list'],
                            ['tgl'=>'20',      'nama'=>'Peringatan Hari Kebangkitan Nasional',        'type'=>'kegiatan', 'icon'=>'fa-flag'],
                            ['tgl'=>'29',      'nama'=>'Libur Kenaikan Isa Al-Masih',                 'type'=>'libur',    'icon'=>'fa-cross'],
                        ],
                    ],
                    [
                        'bulan'  => 'Juni',
                        'tahun'  => date('Y') + 1,
                        'color'  => 'green',
                        'events' => [
                            ['tgl'=>'1',       'nama'=>'Libur Hari Lahir Pancasila',                  'type'=>'libur',    'icon'=>'fa-flag'],
                            ['tgl'=>'2 – 6',   'nama'=>'Remedial & Pengayaan',                        'type'=>'kbm',      'icon'=>'fa-sync'],
                            ['tgl'=>'14',      'nama'=>'Pembagian Rapor Kenaikan Kelas',              'type'=>'kegiatan', 'icon'=>'fa-file-alt'],
                            ['tgl'=>'16 – 30', 'nama'=>'Libur Akhir Tahun Pelajaran',                 'type'=>'liburs',   'icon'=>'fa-umbrella-beach'],
                        ],
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($sem2 as $bln)
                <div class="kal-card fade-up">
                    <div class="month-header {{ $bln['color'] }}">
                        <div>
                            <p class="text-white font-black text-lg leading-none">{{ $bln['bulan'] }}</p>
                            <p class="text-white/60 text-xs mt-0.5">{{ $bln['tahun'] }}</p>
                        </div>
                        <div class="bg-white/15 rounded-xl px-3 py-1">
                            <span class="text-white font-bold text-sm">{{ count($bln['events']) }} agenda</span>
                        </div>
                    </div>
                    <div class="p-4">
                        @foreach ($bln['events'] as $ev)
                        @php
                            $typeCfg = match($ev['type']) {
                                'ujian'   => ['bg'=>'bg-amber-100 text-amber-700',  'label'=>'Ujian'],
                                'libur'   => ['bg'=>'bg-red-100 text-red-600',      'label'=>'Libur'],
                                'liburs'  => ['bg'=>'bg-violet-100 text-violet-700','label'=>'Libur Smt'],
                                'kegiatan'=> ['bg'=>'bg-green-100 text-green-700',  'label'=>'Kegiatan'],
                                default   => ['bg'=>'bg-blue-100 text-blue-700',    'label'=>'KBM'],
                            };
                        @endphp
                        <div class="event-row">
                            <div class="w-9 h-9 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $ev['icon'] }} text-gray-500 text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-gray-900 font-semibold text-xs leading-tight mb-1">{{ $ev['nama'] }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="ev-badge {{ $typeCfg['bg'] }}">{{ $typeCfg['label'] }}</span>
                                    <span class="text-gray-400 text-[10px]">{{ $ev['tgl'] }} {{ $bln['bulan'] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         TIMELINE PENTING
    ══════════════════════════════════════ --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Timeline Utama --}}
                <div class="fade-up">
                    <div class="sec-label">Milestone Penting</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900 mb-6">Agenda Utama</h2>

                    @php
                        $milestones = [
                            ['bln'=>'Juli '    .date('Y'),     'ket'=>'Awal Tahun Ajaran & MPLS',          'icon'=>'fa-flag-checkered', 'dot'=>'#1d4ed8'],
                            ['bln'=>'Sep '     .date('Y'),     'ket'=>'Penilaian Tengah Semester 1',        'icon'=>'fa-clipboard-list',  'dot'=>'#4338ca'],
                            ['bln'=>'Nov – Des '.date('Y'),    'ket'=>'Penilaian Akhir Semester 1',         'icon'=>'fa-star',            'dot'=>'#7c3aed'],
                            ['bln'=>'Des '     .date('Y'),     'ket'=>'Pembagian Rapor Semester 1',         'icon'=>'fa-file-alt',        'dot'=>'#059669'],
                            ['bln'=>'Jan '     .(date('Y')+1), 'ket'=>'Awal Semester 2',                   'icon'=>'fa-sync',            'dot'=>'#1d4ed8'],
                            ['bln'=>'Mar '     .(date('Y')+1), 'ket'=>'Penilaian Tengah Semester 2',       'icon'=>'fa-clipboard-list',  'dot'=>'#4338ca'],
                            ['bln'=>'Mei '     .(date('Y')+1), 'ket'=>'Penilaian Akhir Tahun',             'icon'=>'fa-trophy',          'dot'=>'#d97706'],
                            ['bln'=>'Jun '     .(date('Y')+1), 'ket'=>'Pembagian Rapor & Kenaikan Kelas',  'icon'=>'fa-graduation-cap',  'dot'=>'#dc2626'],
                        ];
                    @endphp

                    <div class="space-y-0">
                        @foreach ($milestones as $m)
                        <div class="tl-item">
                            <div class="tl-dot" style="background: {{ $m['dot'] }};">
                                <i class="fa {{ $m['icon'] }}"></i>
                            </div>
                            <div class="tl-card">
                                <p class="text-[10px] font-bold text-blue-500 uppercase tracking-wider mb-1">{{ $m['bln'] }}</p>
                                <p class="font-bold text-gray-900 text-sm">{{ $m['ket'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Libur & Hari Penting --}}
                <div class="fade-up">
                    <div class="sec-label">Libur Nasional & Keagamaan</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900 mb-6">Hari Libur</h2>

                    @php
                        $libur = [
                            ['tgl'=>'1 Jan',  'nama'=>'Tahun Baru Masehi'],
                            ['tgl'=>'27 Jan', 'nama'=>'Tahun Baru Imlek'],
                            ['tgl'=>'5 Feb',  'nama'=>'Isra Miraj Nabi Muhammad SAW'],
                            ['tgl'=>'17 Mar', 'nama'=>'Hari Raya Nyepi'],
                            ['tgl'=>'29 Mar', 'nama'=>'Wafat Isa Al-Masih'],
                            ['tgl'=>'1 – 5 Apr','nama'=>'Idul Fitri 1446 H'],
                            ['tgl'=>'1 Mei',  'nama'=>'Hari Buruh Internasional'],
                            ['tgl'=>'29 Mei', 'nama'=>'Kenaikan Isa Al-Masih'],
                            ['tgl'=>'1 Jun',  'nama'=>'Hari Lahir Pancasila'],
                            ['tgl'=>'6 Jun',  'nama'=>'Idul Adha 1447 H'],
                            ['tgl'=>'17 Agt', 'nama'=>'HUT Kemerdekaan RI'],
                            ['tgl'=>'25 Des', 'nama'=>'Hari Natal'],
                        ];
                    @endphp

                    <div class="space-y-2">
                        @foreach ($libur as $l)
                        <div class="flex items-center gap-4 bg-white border border-gray-100 rounded-2xl px-4 py-3 hover:border-red-200 hover:bg-red-50/30 transition-all">
                            <span class="text-[10px] font-bold text-red-600 bg-red-50 border border-red-100 px-2.5 py-1 rounded-xl min-w-[72px] text-center">{{ $l['tgl'] }}</span>
                            <p class="text-gray-800 font-semibold text-xs">{{ $l['nama'] }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-5 p-4 bg-blue-50 border border-blue-200 rounded-2xl flex items-start gap-3">
                        <i class="fa fa-info-circle text-blue-500 mt-0.5 flex-shrink-0"></i>
                        <p class="text-blue-800 text-xs leading-relaxed">
                            Tanggal libur nasional & keagamaan dapat berubah menyesuaikan
                            <strong>Keputusan Bersama Menteri</strong> dan Surat Edaran Dinas Pendidikan Kota Kediri.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const obs = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 90);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
});
</script>
@endpush