@extends('layouts.public')

@section('title', $pageTitle ?? 'Gerakan Literasi Sekolah — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }

    .page-hero {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%);
        position: relative; overflow: hidden;
    }
    .hero-pattern {
        position: absolute; inset: 0; opacity: .05;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 28px 28px;
    }
    .sec-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: #1d4ed8; background: #eff6ff; border: 1px solid #bfdbfe;
        padding: 4px 14px; border-radius: 999px; margin-bottom: 12px;
    }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; }
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); }

    /* Literasi Card */
    .lit-card {
        background: white; border-radius: 20px;
        border: 1.5px solid #e0e7ff; overflow: hidden;
        transition: all .25s;
    }
    .lit-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 12px 32px rgba(29,78,216,.12);
        transform: translateY(-3px);
    }
    .lit-card-header {
        padding: 20px 22px 16px; border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; gap: 14px;
    }
    .lit-card-body { padding: 16px 22px 20px; }

    /* Program Row */
    .program-row {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 14px 16px; border-radius: 14px;
        border: 1px solid #f1f5f9; background: white;
        transition: all .22s; margin-bottom: 8px;
    }
    .program-row:last-child { margin-bottom: 0; }
    .program-row:hover { border-color: #bfdbfe; background: #f8fbff; transform: translateX(4px); }

    /* Tahap GLS */
    .tahap-card {
        background: white; border-radius: 20px;
        border: 1.5px solid #e0e7ff; padding: 22px 20px;
        position: relative; overflow: hidden;
        transition: all .25s;
    }
    .tahap-card::before {
        content: attr(data-num);
        position: absolute; right: -8px; top: -12px;
        font-size: 5rem; font-weight: 900; line-height: 1;
        color: #e0e7ff; font-family: 'Playfair Display', serif;
    }
    .tahap-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 12px 32px rgba(29,78,216,.12);
        transform: translateY(-3px);
    }

    /* Pojok Baca */
    .pojok-row {
        display: flex; align-items: center; gap: 14px;
        padding: 12px 16px; border-radius: 14px;
        border: 1px solid #f1f5f9; background: white;
        transition: all .22s;
    }
    .pojok-row:hover { border-color: #bfdbfe; background: #f8fbff; }

    /* Koleksi Buku */
    .buku-bar {
        background: white; border-radius: 14px;
        border: 1.5px solid #e0e7ff; padding: 14px 16px;
        transition: all .2s;
    }
    .buku-bar:hover { border-color: #93c5fd; }
    .buku-progress-bg { background: #f1f5f9; border-radius: 999px; height: 8px; margin-top: 6px; overflow: hidden; }
    .buku-progress    { height: 100%; border-radius: 999px; transition: width 1.2s cubic-bezier(.4,0,.2,1); }

    /* Quote */
    .quote-block {
        background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%);
        border-left: 4px solid #1d4ed8; border-radius: 0 16px 16px 0;
        padding: 20px 24px;
    }

    /* Stat mini */
    .stat-mini {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 20px 14px;
        text-align: center; transition: all .22s;
    }
    .stat-mini:hover { border-color: #93c5fd; box-shadow: 0 8px 20px rgba(29,78,216,.1); transform: translateY(-2px); }

    /* Timeline */
    .tl-item { position: relative; padding-left: 36px; }
    .tl-item::before {
        content: ''; position: absolute; left: 11px; top: 28px;
        bottom: -12px; width: 2px; background: #bfdbfe;
    }
    .tl-item:last-child::before { display: none; }
    .tl-dot {
        position: absolute; left: 0; top: 16px;
        width: 24px; height: 24px; border-radius: 50%;
        background: #1d4ed8; border: 3px solid #bfdbfe;
        display: flex; align-items: center; justify-content: center; z-index: 1;
    }
    .tl-dot i { font-size: 8px; color: white; }
    .tl-card {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 14px 16px;
        margin-bottom: 14px; transition: all .22s;
    }
    .tl-card:hover { border-color: #93c5fd; box-shadow: 0 8px 24px rgba(29,78,216,.1); }

    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div style="position:absolute;width:400px;height:400px;right:-100px;top:-100px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;width:240px;height:240px;left:6%;bottom:-70px;border-radius:50%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);pointer-events:none;"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <a href="#" class="hover:text-white transition-colors">Akademik</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Gerakan Literasi Sekolah</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Akademik
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Gerakan<br>
                    <span style="color:#FDE68A;">Literasi Sekolah</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-lg" style="font-size:1rem;">
                    Membangun budaya membaca, menulis, dan berpikir kritis pada seluruh
                    warga SD Negeri Sukorame 1 Kota Kediri melalui program GLS yang terstruktur.
                </p>
            </div>
            <div class="flex gap-3 flex-shrink-0">
                @php $hs = [
                    ['val'=> $stats['koleksiBuku'] ?? '2.500+', 'lbl'=>'Koleksi Buku',  'ico'=>'fa-book'],
                    ['val'=> $stats['pojokBaca']   ?? '12',     'lbl'=>'Pojok Baca',    'ico'=>'fa-book-reader'],
                    ['val'=> $stats['program']     ?? '6',      'lbl'=>'Program GLS',   'ico'=>'fa-sitemap'],
                ]; @endphp
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

    {{-- OVERVIEW --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Tentang GLS</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Apa itu Gerakan Literasi Sekolah?</h2>
                <p class="text-gray-500 text-sm max-w-2xl mx-auto leading-relaxed">
                    Gerakan Literasi Sekolah (GLS) adalah upaya menyeluruh yang melibatkan semua warga sekolah
                    untuk menjadikan sekolah sebagai organisasi pembelajaran yang warganya literat sepanjang hayat,
                    sesuai Permendikbud No. 23 Tahun 2015.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-14 fade-up">
                @php $ov = [
                    ['icon'=>'fa-book',         'val'=>'2.500+', 'lbl'=>'Koleksi Buku',     'color'=>'bg-blue-50 text-blue-600'],
                    ['icon'=>'fa-book-reader',  'val'=>'12',     'lbl'=>'Pojok Baca',       'color'=>'bg-indigo-50 text-indigo-600'],
                    ['icon'=>'fa-clock',        'val'=>'15 Mnt', 'lbl'=>'Literasi Harian',  'color'=>'bg-amber-50 text-amber-600'],
                    ['icon'=>'fa-calendar',     'val'=>'3',      'lbl'=>'Tahap GLS',        'color'=>'bg-green-50 text-green-600'],
                ]; @endphp
                @foreach ($ov as $o)
                <div class="stat-mini fade-up">
                    <div class="w-12 h-12 {{ $o['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i class="fa {{ $o['icon'] }} text-lg"></i>
                    </div>
                    <p class="font-black text-gray-900 text-2xl leading-tight">{{ $o['val'] }}</p>
                    <p class="text-gray-400 text-xs mt-1">{{ $o['lbl'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="quote-block fade-up">
                <i class="fa fa-quote-left text-blue-200 text-3xl mb-3 block"></i>
                <p class="text-gray-800 font-semibold text-base leading-relaxed mb-2">
                    "Membaca bukan sekadar kegiatan, tetapi sebuah pintu menuju pengetahuan tak terbatas.
                    Melalui GLS, kami menanam kebiasaan membaca hari ini untuk menuai generasi cerdas esok hari."
                </p>
                <p class="text-blue-600 text-xs font-bold">— Kepala Sekolah SDN Sukorame 1</p>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- 3 TAHAP GLS --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Permendikbud No. 23/2015</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Tiga Tahap Pelaksanaan GLS</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    GLS dilaksanakan secara bertahap dari pembiasaan, pengembangan, hingga pembelajaran.
                </p>
            </div>

            @php
                $tahapGLS = [
                    [
                        'no'    => '1',
                        'judul' => 'Tahap Pembiasaan',
                        'sub'   => 'Menumbuhkan Minat Baca',
                        'icon'  => 'fa-seedling',
                        'color' => 'bg-green-50 text-green-600',
                        'border'=> 'border-green-200',
                        'items' => [
                            'Membaca 15 menit sebelum KBM dimulai',
                            'Guru membacakan buku nyaring (read aloud)',
                            'Kunjungan perpustakaan terjadwal',
                            'Membaca mandiri buku non-pelajaran',
                        ],
                    ],
                    [
                        'no'    => '2',
                        'judul' => 'Tahap Pengembangan',
                        'sub'   => 'Meningkatkan Kemampuan Literasi',
                        'icon'  => 'fa-chart-line',
                        'color' => 'bg-blue-50 text-blue-600',
                        'border'=> 'border-blue-200',
                        'items' => [
                            'Membuat ringkasan & peta pikiran',
                            'Diskusi buku dan bedah cerita',
                            'Menulis jurnal harian membaca',
                            'Pameran karya literasi siswa',
                        ],
                    ],
                    [
                        'no'    => '3',
                        'judul' => 'Tahap Pembelajaran',
                        'sub'   => 'Mengintegrasikan dalam KBM',
                        'icon'  => 'fa-graduation-cap',
                        'color' => 'bg-indigo-50 text-indigo-600',
                        'border'=> 'border-indigo-200',
                        'items' => [
                            'Literasi terintegrasi dalam semua mapel',
                            'Penugasan berbasis teks dan bacaan',
                            'Portofolio membaca dan menulis',
                            'Penilaian berbasis literasi',
                        ],
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($tahapGLS as $t)
                <div class="tahap-card fade-up" data-num="{{ $t['no'] }}">
                    <div class="w-12 h-12 {{ $t['color'] }} rounded-xl flex items-center justify-center mb-4">
                        <i class="fa {{ $t['icon'] }}"></i>
                    </div>
                    <p class="font-black text-gray-900 text-base mb-0.5">{{ $t['judul'] }}</p>
                    <p class="text-blue-500 text-xs font-semibold mb-4">{{ $t['sub'] }}</p>
                    <ul class="space-y-2">
                        @foreach ($t['items'] as $item)
                        <li class="flex items-start gap-2 text-xs text-gray-600">
                            <i class="fa fa-check-circle text-green-400 mt-0.5 flex-shrink-0"></i>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- PROGRAM GLS --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Program Unggulan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Program Literasi Sekolah</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Ragam kegiatan yang dirancang untuk mewujudkan budaya literasi di lingkungan sekolah.
                </p>
            </div>

            @php
                $programGLS = [
                    [
                        'label' => 'Program Harian',
                        'color' => 'bg-blue-700',
                        'items' => [
                            [
                                'nama'  => 'Literasi 15 Menit',
                                'icon'  => 'fa-book-open',
                                'color' => 'bg-blue-50 text-blue-600',
                                'waktu' => '07.20 – 07.35',
                                'desc'  => 'Membaca buku non-pelajaran pilihan selama 15 menit setiap pagi sebelum KBM dimulai.',
                            ],
                            [
                                'nama'  => 'Read Aloud oleh Guru',
                                'icon'  => 'fa-microphone-alt',
                                'color' => 'bg-indigo-50 text-indigo-600',
                                'waktu' => 'Setiap Hari',
                                'desc'  => 'Guru membacakan cerita nyaring untuk meningkatkan minat dan pemahaman membaca siswa.',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Program Mingguan',
                        'color' => 'bg-indigo-600',
                        'items' => [
                            [
                                'nama'  => 'Kunjungan Perpustakaan',
                                'icon'  => 'fa-library',
                                'color' => 'bg-violet-50 text-violet-600',
                                'waktu' => '1× per Minggu',
                                'desc'  => 'Setiap kelas mendapat jadwal kunjungan ke perpustakaan untuk meminjam dan membaca buku.',
                            ],
                            [
                                'nama'  => 'Jurnal Baca Siswa',
                                'icon'  => 'fa-journal-whills',
                                'color' => 'bg-green-50 text-green-600',
                                'waktu' => 'Akhir Pekan',
                                'desc'  => 'Siswa mencatat buku yang telah dibaca, ringkasan, dan kesan dalam jurnal membaca pribadi.',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Program Bulanan / Tahunan',
                        'color' => 'bg-violet-600',
                        'items' => [
                            [
                                'nama'  => 'Festival Literasi Sekolah',
                                'icon'  => 'fa-star',
                                'color' => 'bg-amber-50 text-amber-600',
                                'waktu' => 'Setiap Tahun',
                                'desc'  => 'Pameran karya tulis, bazar buku, lomba bercerita, dan penghargaan Siswa Paling Gemar Membaca.',
                            ],
                            [
                                'nama'  => 'Bedah Buku Bersama',
                                'icon'  => 'fa-comments',
                                'color' => 'bg-teal-50 text-teal-600',
                                'waktu' => '1× per Bulan',
                                'desc'  => 'Diskusi dan bedah buku pilihan bersama guru, orang tua, dan komunitas literasi sekitar.',
                            ],
                            [
                                'nama'  => 'Lomba Bercerita & Baca Puisi',
                                'icon'  => 'fa-trophy',
                                'color' => 'bg-pink-50 text-pink-600',
                                'waktu' => 'Per Semester',
                                'desc'  => 'Kompetisi bercerita, membaca puisi, dan menulis cerpen untuk mendorong semangat literasi.',
                            ],
                        ],
                    ],
                ];
            @endphp

            <div class="space-y-8">
                @foreach ($programGLS as $group)
                <div class="fade-up">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex items-center gap-2 {{ $group['color'] }} text-white text-xs font-bold px-4 py-2 rounded-full">
                            <i class="fa fa-layer-group text-white/70"></i>
                            {{ $group['label'] }}
                        </span>
                    </div>
                    <div class="space-y-3">
                        @foreach ($group['items'] as $item)
                        <div class="program-row">
                            <div class="w-11 h-11 {{ $item['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $item['icon'] }} text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 text-sm">{{ $item['nama'] }}</p>
                                <p class="text-gray-400 text-xs mt-0.5">{{ $item['desc'] }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-[10px] font-semibold bg-blue-50 text-blue-600 border border-blue-100 px-3 py-1 rounded-full whitespace-nowrap">
                                    {{ $item['waktu'] }}
                                </span>
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

    {{-- POJOK BACA & KOLEKSI --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Pojok Baca --}}
                <div class="fade-up">
                    <div class="sec-label">Sarana Literasi</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900 mb-6">Pojok Baca & Perpustakaan</h2>

                    @php
                        $pojokBaca = [
                            ['lokasi'=>'Perpustakaan Sekolah',  'icon'=>'fa-library',     'color'=>'bg-blue-50 text-blue-600',    'kol'=>'1.200+ judul', 'jam'=>'Senin – Jumat, 07.00 – 13.00'],
                            ['lokasi'=>'Pojok Baca Kelas I',    'icon'=>'fa-book-reader', 'color'=>'bg-green-50 text-green-600',  'kol'=>'80 judul',     'jam'=>'Setiap hari belajar'],
                            ['lokasi'=>'Pojok Baca Kelas II',   'icon'=>'fa-book-reader', 'color'=>'bg-indigo-50 text-indigo-600','kol'=>'85 judul',     'jam'=>'Setiap hari belajar'],
                            ['lokasi'=>'Pojok Baca Kelas III',  'icon'=>'fa-book-reader', 'color'=>'bg-violet-50 text-violet-600','kol'=>'90 judul',     'jam'=>'Setiap hari belajar'],
                            ['lokasi'=>'Pojok Baca Kelas IV',   'icon'=>'fa-book-reader', 'color'=>'bg-teal-50 text-teal-600',    'kol'=>'100 judul',    'jam'=>'Setiap hari belajar'],
                            ['lokasi'=>'Pojok Baca Kelas V',    'icon'=>'fa-book-reader', 'color'=>'bg-amber-50 text-amber-600',  'kol'=>'110 judul',    'jam'=>'Setiap hari belajar'],
                            ['lokasi'=>'Pojok Baca Kelas VI',   'icon'=>'fa-book-reader', 'color'=>'bg-pink-50 text-pink-600',    'kol'=>'120 judul',    'jam'=>'Setiap hari belajar'],
                            ['lokasi'=>'Taman Baca Outdoor',    'icon'=>'fa-tree',        'color'=>'bg-green-50 text-green-600',  'kol'=>'150 judul',    'jam'=>'Setiap hari, saat istirahat'],
                        ];
                    @endphp

                    <div class="space-y-2.5">
                        @foreach ($pojokBaca as $pb)
                        <div class="pojok-row">
                            <div class="w-10 h-10 {{ $pb['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $pb['icon'] }} text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 text-sm">{{ $pb['lokasi'] }}</p>
                                <p class="text-gray-400 text-xs mt-0.5">
                                    <i class="fa fa-book mr-1"></i>{{ $pb['kol'] }}
                                    <span class="mx-1.5 text-gray-300">·</span>
                                    <i class="fa fa-clock mr-1"></i>{{ $pb['jam'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Koleksi Buku --}}
                <div class="fade-up">
                    <div class="sec-label">Koleksi Perpustakaan</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900 mb-6">Kategori Koleksi Buku</h2>

                    @php
                        $koleksi = [
                            ['kategori'=>'Buku Pelajaran',      'jumlah'=>650,  'total'=>2500, 'color'=>'bg-blue-500'],
                            ['kategori'=>'Buku Fiksi & Cerita', 'jumlah'=>480,  'total'=>2500, 'color'=>'bg-pink-500'],
                            ['kategori'=>'Ensiklopedia & Referensi','jumlah'=>320,'total'=>2500,'color'=>'bg-indigo-500'],
                            ['kategori'=>'Sains & Alam',        'jumlah'=>280,  'total'=>2500, 'color'=>'bg-green-500'],
                            ['kategori'=>'Biografi & Sejarah',  'jumlah'=>210,  'total'=>2500, 'color'=>'bg-amber-500'],
                            ['kategori'=>'Agama & Karakter',    'jumlah'=>200,  'total'=>2500, 'color'=>'bg-teal-500'],
                            ['kategori'=>'Majalah & Koran Anak','jumlah'=>180,  'total'=>2500, 'color'=>'bg-violet-500'],
                            ['kategori'=>'Lainnya',             'jumlah'=>180,  'total'=>2500, 'color'=>'bg-gray-400'],
                        ];
                    @endphp

                    <div class="space-y-3">
                        @foreach ($koleksi as $k)
                        @php $pct = round(($k['jumlah'] / $k['total']) * 100); @endphp
                        <div class="buku-bar">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-semibold text-gray-800 text-xs">{{ $k['kategori'] }}</p>
                                <span class="text-xs font-black text-gray-900">{{ number_format($k['jumlah']) }}</span>
                            </div>
                            <div class="buku-progress-bg">
                                <div class="buku-progress {{ $k['color'] }}" style="width: {{ $pct }}%" data-width="{{ $pct }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-2xl flex items-start gap-3">
                        <i class="fa fa-info-circle text-blue-500 mt-0.5 flex-shrink-0"></i>
                        <p class="text-blue-800 text-xs leading-relaxed">
                            Total <strong>2.500+ koleksi buku</strong> dan terus bertambah melalui program
                            donasi buku, pembelian rutin, dan hibah dari pemerintah daerah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- TIMELINE KEGIATAN GLS --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                {{-- Timeline --}}
                <div class="fade-up">
                    <div class="sec-label">Agenda Literasi</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900 mb-6">Timeline Kegiatan GLS</h2>

                    @php
                        $tlGLS = [
                            ['bln'=>'Juli – Agustus',     'ket'=>'Sosialisasi GLS & Pembentukan Tim Literasi',    'icon'=>'fa-flag-checkered', 'dot'=>'#1d4ed8'],
                            ['bln'=>'September',          'ket'=>'Pelatihan Guru & Pengisian Pojok Baca',         'icon'=>'fa-chalkboard-teacher','dot'=>'#4338ca'],
                            ['bln'=>'Oktober',            'ket'=>'Hari Literasi Sekolah & Pameran Buku',          'icon'=>'fa-book-open',      'dot'=>'#7c3aed'],
                            ['bln'=>'November',           'ket'=>'Lomba Bercerita & Baca Puisi Antar Kelas',      'icon'=>'fa-trophy',         'dot'=>'#059669'],
                            ['bln'=>'Desember',           'ket'=>'Evaluasi Jurnal Baca & Rapor Literasi',         'icon'=>'fa-clipboard-check','dot'=>'#d97706'],
                            ['bln'=>'Februari',           'ket'=>'Bedah Buku Bersama Orang Tua & Komunitas',      'icon'=>'fa-users',          'dot'=>'#1d4ed8'],
                            ['bln'=>'April',              'ket'=>'Festival Literasi & Donor Buku',                'icon'=>'fa-star',           'dot'=>'#dc2626'],
                            ['bln'=>'Mei – Juni',         'ket'=>'Penilaian Literasi & Penghargaan Siswa Teladan','icon'=>'fa-medal',          'dot'=>'#d97706'],
                        ];
                    @endphp

                    <div class="space-y-0">
                        @foreach ($tlGLS as $tl)
                        <div class="tl-item">
                            <div class="tl-dot" style="background: {{ $tl['dot'] }};">
                                <i class="fa {{ $tl['icon'] }}"></i>
                            </div>
                            <div class="tl-card">
                                <p class="text-[10px] font-bold text-blue-500 uppercase tracking-wider mb-1">{{ $tl['bln'] }}</p>
                                <p class="font-bold text-gray-900 text-sm">{{ $tl['ket'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- 6 Literasi Dasar --}}
                <div class="fade-up">
                    <div class="sec-label">UNESCO</div>
                    <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900 mb-6">6 Literasi Dasar</h2>

                    @php
                        $literasiDasar = [
                            ['no'=>1, 'nama'=>'Literasi Baca Tulis',       'icon'=>'fa-pen-nib',    'color'=>'bg-blue-50 text-blue-600',     'desc'=>'Kemampuan membaca, memahami, dan menghasilkan teks.'],
                            ['no'=>2, 'nama'=>'Literasi Numerasi',          'icon'=>'fa-calculator', 'color'=>'bg-indigo-50 text-indigo-600', 'desc'=>'Kemampuan menggunakan angka dan simbol matematika.'],
                            ['no'=>3, 'nama'=>'Literasi Sains',             'icon'=>'fa-flask',      'color'=>'bg-green-50 text-green-600',   'desc'=>'Kemampuan memahami fenomena alam secara ilmiah.'],
                            ['no'=>4, 'nama'=>'Literasi Digital',           'icon'=>'fa-laptop-code','color'=>'bg-cyan-50 text-cyan-600',     'desc'=>'Kemampuan menggunakan teknologi digital secara cerdas.'],
                            ['no'=>5, 'nama'=>'Literasi Finansial',         'icon'=>'fa-coins',      'color'=>'bg-amber-50 text-amber-600',   'desc'=>'Kemampuan mengelola keuangan dan membuat keputusan finansial.'],
                            ['no'=>6, 'nama'=>'Literasi Budaya & Kewargaan','icon'=>'fa-globe-asia', 'color'=>'bg-violet-50 text-violet-600', 'desc'=>'Kemampuan memahami budaya dan berpartisipasi dalam kehidupan bermasyarakat.'],
                        ];
                    @endphp

                    <div class="space-y-3">
                        @foreach ($literasiDasar as $ld)
                        <div class="lit-card">
                            <div class="lit-card-header">
                                <div class="w-11 h-11 {{ $ld['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fa {{ $ld['icon'] }}"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-black text-gray-300">#{{ $ld['no'] }}</span>
                                        <p class="font-bold text-gray-900 text-sm">{{ $ld['nama'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="lit-card-body">
                                <p class="text-gray-500 text-xs leading-relaxed">{{ $ld['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
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

    // Animate progress bars when visible
    const barObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const bar = e.target.querySelector('.buku-progress');
                if (bar) {
                    const w = bar.getAttribute('data-width');
                    setTimeout(() => { bar.style.width = w + '%'; }, 200);
                }
                barObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('.buku-bar').forEach(el => {
        const bar = el.querySelector('.buku-progress');
        if (bar) bar.style.width = '0%';
        barObs.observe(el);
    });
});
</script>
@endpush