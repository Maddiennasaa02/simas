@extends('layouts.public')

@section('title', $pageTitle ?? 'Komite Sekolah — SDN Sukorame 1')

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

    /* ── MEMBER CARD ── */
    .member-card {
        background: white; border-radius: 22px; overflow: hidden;
        border: 1px solid #f1f5f9;
        transition: all .3s; position: relative;
    }
    .member-card:hover { transform: translateY(-5px); box-shadow: 0 20px 48px rgba(29,78,216,.11); border-color: #bfdbfe; }
    .member-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
        background: #1d4ed8; opacity: 0; transition: opacity .3s;
    }
    .member-card:hover::after { opacity: 1; }

    .member-card.ketua {
        border-color: #fde68a;
        box-shadow: 0 8px 32px rgba(217,119,6,.15);
    }
    .member-card.ketua::after { background: linear-gradient(90deg,#d97706,#f59e0b); opacity: 1; }
    .member-card.ketua:hover { box-shadow: 0 24px 56px rgba(217,119,6,.25); border-color: #f59e0b; }

    .member-photo {
        height: 140px; display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .member-jabatan-badge {
        position: absolute; top: 12px; right: 12px;
        font-size: 9px; font-weight: 800; letter-spacing: .06em;
        padding: 3px 10px; border-radius: 999px; text-transform: uppercase;
    }

    /* ── TUGAS CARD ── */
    .tugas-card {
        background: white; border-radius: 18px; padding: 22px 20px;
        border: 1px solid #f1f5f9;
        transition: all .25s;
        position: relative; overflow: hidden;
    }
    .tugas-card:hover { border-color: #bfdbfe; box-shadow: 0 10px 28px rgba(29,78,216,.08); transform: translateY(-3px); }
    .tugas-card::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
        background: #1d4ed8; border-radius: 0 2px 2px 0; opacity: 0;
        transition: opacity .25s;
    }
    .tugas-card:hover::before { opacity: 1; }

    /* ── PROGRAM ITEM ── */
    .program-item {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 16px 18px; border-radius: 16px;
        border: 1px solid #f1f5f9; background: white;
        transition: all .22s;
    }
    .program-item:hover { border-color: #bfdbfe; background: #f8fbff; transform: translateX(4px); }

    /* ── DASAR HUKUM ── */
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
            <span class="text-white/80">Komite Sekolah</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Profil Sekolah
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Komite<br>
                    <span style="color:#FDE68A;">Sekolah</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl" style="font-size:1rem;">
                    Mitra strategis sekolah yang menjembatani antara kebutuhan peserta didik,
                    harapan orang tua, dan program SDN Sukorame 1 Kota Kediri.
                </p>

                {{-- Quick nav --}}
                <div class="flex flex-wrap gap-3 mt-7">
                    @foreach([['#anggota','fa-users','Anggota'],['#tugas','fa-list-check','Tugas & Fungsi'],['#program','fa-calendar-check','Program Kerja'],['#hukum','fa-gavel','Dasar Hukum']] as $n)
                    <a href="{{ $n[0] }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                        <i class="fa {{ $n[1] }} text-amber-300 text-[10px]"></i> {{ $n[2] }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Hero stat --}}
            <div class="flex gap-3 flex-shrink-0">
                @php
                    $hs = [
                        ['val'=> isset($komite) ? $komite->count() : '9', 'lbl'=>'Anggota',    'ico'=>'fa-users'],
                        ['val'=>'3', 'lbl'=>'Bidang Kerja', 'ico'=>'fa-sitemap'],
                        ['val'=>date('Y'), 'lbl'=>'Periode',   'ico'=>'fa-calendar'],
                    ];
                @endphp
                @foreach($hs as $h)
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
         ANGGOTA KOMITE
    ══════════════════════════════════════ --}}
    <section id="anggota" class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Keanggotaan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Susunan Pengurus Komite</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Pengurus Komite SDN Sukorame 1 periode {{ date('Y') }}/{{ date('Y',strtotime('+1 year')) }}
                    yang dipilih melalui musyawarah orang tua peserta didik.
                </p>
            </div>

            @php
                /*
                 * Ganti dengan data dari DB jika ada:
                 * $komite = \App\Models\Komite::orderBy('urutan')->get();
                 *
                 * Struktur kolom yang disarankan:
                 * id, nama, jabatan, unsur, telepon, urutan
                 */
                $anggota_default = [
                    ['jabatan'=>'Ketua',             'unsur'=>'Orang Tua Siswa',     'level'=>'ketua',
                     'photo_bg'=>'from-amber-50 to-yellow-100', 'photo_ico'=>'fa-user-tie',    'ico_c'=>'text-amber-500',
                     'badge_bg'=>'bg-amber-400 text-amber-900'],
                    ['jabatan'=>'Wakil Ketua',        'unsur'=>'Orang Tua Siswa',     'level'=>'wakil',
                     'photo_bg'=>'from-blue-50 to-sky-100',    'photo_ico'=>'fa-user-shield', 'ico_c'=>'text-blue-500',
                     'badge_bg'=>'bg-blue-100 text-blue-800'],
                    ['jabatan'=>'Sekretaris I',       'unsur'=>'Orang Tua Siswa',     'level'=>'normal',
                     'photo_bg'=>'from-indigo-50 to-blue-100','photo_ico'=>'fa-user',        'ico_c'=>'text-indigo-400',
                     'badge_bg'=>'bg-indigo-100 text-indigo-800'],
                    ['jabatan'=>'Sekretaris II',      'unsur'=>'Tokoh Masyarakat',    'level'=>'normal',
                     'photo_bg'=>'from-violet-50 to-purple-100','photo_ico'=>'fa-user',      'ico_c'=>'text-violet-400',
                     'badge_bg'=>'bg-violet-100 text-violet-800'],
                    ['jabatan'=>'Bendahara I',        'unsur'=>'Orang Tua Siswa',     'level'=>'normal',
                     'photo_bg'=>'from-green-50 to-emerald-100','photo_ico'=>'fa-user',      'ico_c'=>'text-green-500',
                     'badge_bg'=>'bg-green-100 text-green-800'],
                    ['jabatan'=>'Bendahara II',       'unsur'=>'Orang Tua Siswa',     'level'=>'normal',
                     'photo_bg'=>'from-teal-50 to-cyan-100',  'photo_ico'=>'fa-user',        'ico_c'=>'text-teal-500',
                     'badge_bg'=>'bg-teal-100 text-teal-800'],
                    ['jabatan'=>'Anggota Bid. Akademik','unsur'=>'Orang Tua Siswa',   'level'=>'normal',
                     'photo_bg'=>'from-sky-50 to-blue-100',   'photo_ico'=>'fa-user',        'ico_c'=>'text-sky-500',
                     'badge_bg'=>'bg-sky-100 text-sky-800'],
                    ['jabatan'=>'Anggota Bid. Sarana', 'unsur'=>'Tokoh Masyarakat',   'level'=>'normal',
                     'photo_bg'=>'from-pink-50 to-rose-100',  'photo_ico'=>'fa-user',        'ico_c'=>'text-pink-500',
                     'badge_bg'=>'bg-pink-100 text-pink-800'],
                    ['jabatan'=>'Anggota Bid. Humas',  'unsur'=>'Alumni / Masyarakat','level'=>'normal',
                     'photo_bg'=>'from-amber-50 to-orange-100','photo_ico'=>'fa-user',       'ico_c'=>'text-orange-500',
                     'badge_bg'=>'bg-orange-100 text-orange-800'],
                ];

                // Jika ada data dari DB, gunakan itu; kalau tidak, pakai default
                $anggota_list = isset($komite) && $komite->count() > 0 ? $komite : collect($anggota_default);
            @endphp

            {{-- Ketua — full row --}}
            @php $ketua = $anggota_list->first(); @endphp
            <div class="flex justify-center mb-8 fade-up">
                <div class="member-card ketua w-full max-w-xs">
                    <div class="member-photo bg-gradient-to-br {{ is_array($ketua) ? $ketua['photo_bg'] : 'from-amber-50 to-yellow-100' }}">
                        <i class="fa {{ is_array($ketua) ? $ketua['photo_ico'] : 'fa-user-tie' }} {{ is_array($ketua) ? $ketua['ico_c'] : 'text-amber-500' }} text-5xl"></i>
                        <span class="member-jabatan-badge {{ is_array($ketua) ? $ketua['badge_bg'] : 'bg-amber-400 text-amber-900' }}">
                            Ketua
                        </span>
                    </div>
                    <div class="p-5 text-center">
                        <p class="font-black text-gray-900 text-base leading-snug mb-1">
                            {{ is_object($ketua) ? $ketua->nama : '—' }}
                        </p>
                        <p class="text-xs font-bold text-amber-600 mb-1">{{ is_array($ketua) ? $ketua['jabatan'] : $ketua->jabatan }}</p>
                        <p class="text-xs text-gray-400">{{ is_array($ketua) ? $ketua['unsur'] : $ketua->unsur }}</p>
                        @if(is_object($ketua) && !empty($ketua->telepon))
                        <a href="tel:{{ $ketua->telepon }}" class="inline-flex items-center gap-1 mt-3 text-blue-600 text-xs font-semibold hover:text-blue-800">
                            <i class="fa fa-phone text-[9px]"></i> {{ $ketua->telepon }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Anggota lainnya --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach($anggota_list->skip(1) as $idx => $ag)
                <div class="member-card fade-up" style="transition-delay: {{ $idx * 60 }}ms">
                    <div class="member-photo bg-gradient-to-br {{ is_array($ag) ? $ag['photo_bg'] : 'from-blue-50 to-sky-100' }}">
                        <i class="fa {{ is_array($ag) ? $ag['photo_ico'] : 'fa-user' }} {{ is_array($ag) ? $ag['ico_c'] : 'text-blue-400' }} text-4xl"></i>
                        <span class="member-jabatan-badge {{ is_array($ag) ? $ag['badge_bg'] : 'bg-blue-100 text-blue-800' }}">
                            {{ is_array($ag) ? explode(' ', $ag['jabatan'])[0] : explode(' ', $ag->jabatan)[0] }}
                        </span>
                    </div>
                    <div class="p-4 text-center">
                        <p class="font-black text-gray-900 text-sm leading-snug mb-1">
                            {{ is_object($ag) ? $ag->nama : '—' }}
                        </p>
                        <p class="text-xs font-bold text-blue-700 mb-1">{{ is_array($ag) ? $ag['jabatan'] : $ag->jabatan }}</p>
                        <p class="text-xs text-gray-400">{{ is_array($ag) ? $ag['unsur'] : $ag->unsur }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ══════════════════════════════════════
         TUGAS & FUNGSI
    ══════════════════════════════════════ --}}
    <section id="tugas" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Peran Komite</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Tugas &amp; Fungsi</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Berdasarkan Permendikbud No. 75 Tahun 2016, Komite Sekolah menjalankan empat fungsi utama.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @php
                    $fungsi = [
                        [
                            'icon' =>'fa-lightbulb',
                            'color'=>'blue',
                            'title'=>'Pertimbangan (Advisory)',
                            'desc' =>'Memberikan pertimbangan dalam penetapan dan pelaksanaan kebijakan pendidikan — mulai dari penyusunan RKAS, kurikulum muatan lokal, hingga kriteria kinerja sekolah.',
                            'poin' =>['Penyusunan RKAS/RKJM','Pengembangan kurikulum','Kriteria penerimaan siswa'],
                        ],
                        [
                            'icon' =>'fa-hand-holding-heart',
                            'color'=>'amber',
                            'title'=>'Dukungan (Supporting)',
                            'desc' =>'Mendukung sekolah dalam mewujudkan program pendidikan baik berupa tenaga, sarana/prasarana, maupun pengawasan dan pemikiran.',
                            'poin' =>['Mobilisasi dana sukarela','Dukungan sarana belajar','Pengembangan SDM guru'],
                        ],
                        [
                            'icon' =>'fa-eye',
                            'color'=>'green',
                            'title'=>'Pengawasan (Controlling)',
                            'desc' =>'Melakukan pengawasan terhadap kebijakan, program, dan keluaran pendidikan di SDN Sukorame 1 demi transparansi dan akuntabilitas.',
                            'poin' =>['Pengawasan penggunaan anggaran','Evaluasi program sekolah','Pelaporan kepada orang tua'],
                        ],
                        [
                            'icon' =>'fa-handshake',
                            'color'=>'indigo',
                            'title'=>'Mediasi (Mediating)',
                            'desc' =>'Menjadi penghubung antara pemerintah daerah, sekolah, dan masyarakat — memastikan sinergi semua pihak demi kemajuan pendidikan.',
                            'poin' =>['Komunikasi orang tua–sekolah','Koordinasi dengan Disdik','Jaringan alumni & donatur'],
                        ],
                    ];
                    $fc = [
                        'blue'  =>['bg'=>'bg-blue-50',  'ico'=>'text-blue-600',  'ring'=>'border-blue-200','dot'=>'bg-blue-500'],
                        'amber' =>['bg'=>'bg-amber-50', 'ico'=>'text-amber-600', 'ring'=>'border-amber-200','dot'=>'bg-amber-500'],
                        'green' =>['bg'=>'bg-green-50', 'ico'=>'text-green-600', 'ring'=>'border-green-200','dot'=>'bg-green-500'],
                        'indigo'=>['bg'=>'bg-indigo-50','ico'=>'text-indigo-600','ring'=>'border-indigo-200','dot'=>'bg-indigo-500'],
                    ];
                @endphp
                @foreach($fungsi as $f)
                @php $fcc = $fc[$f['color']]; @endphp
                <div class="tugas-card fade-up">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 {{ $fcc['bg'] }} border {{ $fcc['ring'] }} rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i class="fa {{ $f['icon'] }} {{ $fcc['ico'] }} text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-base leading-snug">{{ $f['title'] }}</h3>
                            <p class="text-gray-500 text-xs leading-relaxed mt-1">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                    <div class="space-y-1.5 pl-1">
                        @foreach($f['poin'] as $p)
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <span class="w-1.5 h-1.5 {{ $fcc['dot'] }} rounded-full flex-shrink-0"></span>
                            {{ $p }}
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
         PROGRAM KERJA
    ══════════════════════════════════════ --}}
    <section id="program" class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Program Kerja</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Program Kerja Komite</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Agenda kerja Komite SDN Sukorame 1 tahun ajaran {{ date('Y') }}/{{ date('Y',strtotime('+1 year')) }}.
                </p>
            </div>

            @php
                $program = [
                    ['triwulan'=>'Triwulan I', 'bln'=>'Jan – Mar', 'color'=>'blue',
                     'items'=>[
                         ['icon'=>'fa-handshake',      'judul'=>'Rapat Koordinasi Awal Tahun',      'desc'=>'Konsolidasi program kerja, evaluasi tahun sebelumnya, dan penentuan prioritas anggaran.'],
                         ['icon'=>'fa-file-signature',  'judul'=>'Penyusunan RKAS Bersama',          'desc'=>'Berpartisipasi aktif dalam penyusunan Rencana Kegiatan & Anggaran Sekolah.'],
                     ]],
                    ['triwulan'=>'Triwulan II', 'bln'=>'Apr – Jun', 'color'=>'indigo',
                     'items'=>[
                         ['icon'=>'fa-graduation-cap', 'judul'=>'Persiapan Ujian Akhir Sekolah',    'desc'=>'Memastikan kesiapan fasilitas, moril siswa, dan dukungan orang tua menjelang ujian.'],
                         ['icon'=>'fa-medal',          'judul'=>'Penghargaan Siswa Berprestasi',     'desc'=>'Koordinasi pemberian apresiasi bagi siswa yang meraih prestasi akademik dan non-akademik.'],
                     ]],
                    ['triwulan'=>'Triwulan III', 'bln'=>'Jul – Sep', 'color'=>'green',
                     'items'=>[
                         ['icon'=>'fa-user-plus',      'judul'=>'Pengawasan PPDB',                  'desc'=>'Memantau proses penerimaan peserta didik baru agar berjalan transparan dan adil.'],
                         ['icon'=>'fa-book-open',      'judul'=>'Evaluasi Kurikulum Semester Ganjil','desc'=>'Memberi masukan atas pelaksanaan kurikulum merdeka di awal semester.'],
                     ]],
                    ['triwulan'=>'Triwulan IV', 'bln'=>'Okt – Des', 'color'=>'amber',
                     'items'=>[
                         ['icon'=>'fa-chart-bar',      'judul'=>'Rapat Evaluasi Akhir Tahun',       'desc'=>'Review capaian program, penggunaan anggaran, dan penyusunan laporan pertanggungjawaban.'],
                         ['icon'=>'fa-star',           'judul'=>'Musyawarah Orang Tua Siswa',       'desc'=>'Forum terbuka bagi seluruh orang tua untuk menyampaikan aspirasi dan evaluasi sekolah.'],
                     ]],
                ];
                $prog_c = [
                    'blue'  =>['bg'=>'bg-blue-700',  'light'=>'bg-blue-50',  'ico'=>'text-blue-600',  'bdr'=>'border-blue-200'],
                    'indigo'=>['bg'=>'bg-indigo-700','light'=>'bg-indigo-50','ico'=>'text-indigo-600','bdr'=>'border-indigo-200'],
                    'green' =>['bg'=>'bg-green-700', 'light'=>'bg-green-50', 'ico'=>'text-green-600', 'bdr'=>'border-green-200'],
                    'amber' =>['bg'=>'bg-amber-600', 'light'=>'bg-amber-50', 'ico'=>'text-amber-600', 'bdr'=>'border-amber-200'],
                ];
            @endphp

            <div class="space-y-6">
                @foreach($program as $prog)
                @php $pc = $prog_c[$prog['color']]; @endphp
                <div class="fade-up">
                    {{-- Header triwulan --}}
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex items-center gap-2 {{ $pc['bg'] }} text-white text-xs font-bold px-4 py-2 rounded-full">
                            <i class="fa fa-calendar-alt text-[10px]"></i> {{ $prog['triwulan'] }}
                        </span>
                        <span class="text-xs text-gray-400 font-semibold">{{ $prog['bln'] }}</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-2">
                        @foreach($prog['items'] as $item)
                        <div class="program-item">
                            <div class="w-10 h-10 {{ $pc['light'] }} border {{ $pc['bdr'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $item['icon'] }} {{ $pc['ico'] }} text-sm"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm mb-1">{{ $item['judul'] }}</p>
                                <p class="text-gray-500 text-xs leading-relaxed">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
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
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => obs.observe(el));
});
</script>
@endpush