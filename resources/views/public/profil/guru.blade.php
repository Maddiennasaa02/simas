@extends('layouts.public')

@section('title', $pageTitle ?? 'Profil Guru & Karyawan — SDN Sukorame 1')

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

    .member-card.kepsek {
        border-color: #fde68a;
        box-shadow: 0 8px 32px rgba(217,119,6,.15);
    }
    .member-card.kepsek::after { background: linear-gradient(90deg,#d97706,#f59e0b); opacity: 1; }
    .member-card.kepsek:hover { box-shadow: 0 24px 56px rgba(217,119,6,.25); border-color: #f59e0b; }

    .member-photo {
        height: 140px; display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }
    .member-photo img { width: 100%; height: 100%; object-fit: cover; }
    .member-jabatan-badge {
        position: absolute; top: 12px; right: 12px;
        font-size: 9px; font-weight: 800; letter-spacing: .06em;
        padding: 3px 10px; border-radius: 999px; text-transform: uppercase;
    }

    /* ── FILTER TABS ── */
    .filter-tab {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 700; padding: 7px 18px;
        border-radius: 999px; border: 1.5px solid #e5e7eb;
        background: white; color: #6b7280; cursor: pointer;
        transition: all .2s;
    }
    .filter-tab:hover { border-color: #93c5fd; color: #1d4ed8; background: #eff6ff; }
    .filter-tab.active { background: #1d4ed8; color: white; border-color: #1d4ed8; }

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
            <span class="text-white/80">Guru & Karyawan</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Profil Sekolah
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Guru &amp;<br>
                    <span style="color:#FDE68A;">Karyawan</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl" style="font-size:1rem;">
                    Tenaga pendidik dan kependidikan yang berdedikasi dalam membentuk
                    generasi unggul di SDN Sukorame 1 Kota Kediri.
                </p>

                {{-- Quick nav --}}
                <div class="flex flex-wrap gap-3 mt-7">
                    @foreach([['#pendidik','fa-chalkboard-teacher','Tenaga Pendidik'],['#kependidikan','fa-user-cog','Tenaga Kependidikan']] as $n)
                    <a href="{{ $n[0] }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                        <i class="fa {{ $n[1] }} text-amber-300 text-[10px]"></i> {{ $n[2] }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Hero stat --}}
            <div class="flex gap-3 flex-shrink-0">
                @php
                    $totalGuru = isset($guru) ? $guru->count() : 0;
                    $hs = [
                        ['val' => $totalGuru ?: '10+', 'lbl' => 'Pendidik',    'ico' => 'fa-chalkboard-teacher'],
                        ['val' => '6',                  'lbl' => 'Rombel',      'ico' => 'fa-layer-group'],
                        ['val' => date('Y'),             'lbl' => 'Tahun Aktif', 'ico' => 'fa-calendar'],
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
         TENAGA PENDIDIK
    ══════════════════════════════════════ --}}
    <section id="pendidik" class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Tenaga Pendidik</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Susunan Guru & Karyawan</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Tenaga pendidik dan kependidikan SDN Sukorame 1 tahun ajaran {{ date('Y') }}/{{ date('Y', strtotime('+1 year')) }}.
                </p>
            </div>

            @php
                $guruPlaceholder = [
                    ['nama' => 'Kepala Sekolah',    'jabatan' => 'Kepala Sekolah',        'nip' => null, 'foto' => null, 'is_kepsek' => true,
                     'photo_bg' => 'from-amber-50 to-yellow-100', 'ico' => 'fa-user-tie',  'ico_c' => 'text-amber-500',
                     'badge_bg' => 'bg-amber-400 text-amber-900'],
                    ['nama' => 'Guru Kelas I',       'jabatan' => 'Wali Kelas I',          'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-blue-50 to-sky-100',     'ico' => 'fa-user',       'ico_c' => 'text-blue-500',
                     'badge_bg' => 'bg-blue-100 text-blue-800'],
                    ['nama' => 'Guru Kelas II',      'jabatan' => 'Wali Kelas II',         'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-indigo-50 to-blue-100',  'ico' => 'fa-user',       'ico_c' => 'text-indigo-400',
                     'badge_bg' => 'bg-indigo-100 text-indigo-800'],
                    ['nama' => 'Guru Kelas III',     'jabatan' => 'Wali Kelas III',        'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-violet-50 to-purple-100','ico' => 'fa-user',       'ico_c' => 'text-violet-400',
                     'badge_bg' => 'bg-violet-100 text-violet-800'],
                    ['nama' => 'Guru Kelas IV',      'jabatan' => 'Wali Kelas IV',         'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-green-50 to-emerald-100','ico' => 'fa-user',       'ico_c' => 'text-green-500',
                     'badge_bg' => 'bg-green-100 text-green-800'],
                    ['nama' => 'Guru Kelas V',       'jabatan' => 'Wali Kelas V',          'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-teal-50 to-cyan-100',    'ico' => 'fa-user',       'ico_c' => 'text-teal-500',
                     'badge_bg' => 'bg-teal-100 text-teal-800'],
                    ['nama' => 'Guru Kelas VI',      'jabatan' => 'Wali Kelas VI',         'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-sky-50 to-blue-100',     'ico' => 'fa-user',       'ico_c' => 'text-sky-500',
                     'badge_bg' => 'bg-sky-100 text-sky-800'],
                    ['nama' => 'Guru PAI',           'jabatan' => 'Guru Agama Islam',      'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-pink-50 to-rose-100',    'ico' => 'fa-user',       'ico_c' => 'text-pink-500',
                     'badge_bg' => 'bg-pink-100 text-pink-800'],
                    ['nama' => 'Guru PJOK',          'jabatan' => 'Guru Olahraga',         'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-orange-50 to-amber-100', 'ico' => 'fa-user',       'ico_c' => 'text-orange-500',
                     'badge_bg' => 'bg-orange-100 text-orange-800'],
                    ['nama' => 'Staff TU',           'jabatan' => 'Tenaga Administrasi',   'nip' => null, 'foto' => null, 'is_kepsek' => false,
                     'photo_bg' => 'from-slate-50 to-gray-100',   'ico' => 'fa-user',       'ico_c' => 'text-slate-400',
                     'badge_bg' => 'bg-slate-100 text-slate-700'],
                ];

                $useDB    = isset($guru) && $guru->count() > 0;
                $list     = $useDB ? $guru : collect($guruPlaceholder);
                $kepsek   = $useDB
                    ? $list->firstWhere(fn($g) => str_contains(strtolower($g->jabatan ?? ''), 'kepala'))
                    : $list->first();
                $anggota  = $useDB
                    ? $list->filter(fn($g) => !str_contains(strtolower($g->jabatan ?? ''), 'kepala'))
                    : $list->skip(1);
            @endphp

            {{-- Kepala Sekolah — baris penuh --}}
            @if($kepsek)
            <div class="flex justify-center mb-10 fade-up">
                <div class="member-card kepsek w-full max-w-xs">
                    <div class="member-photo bg-gradient-to-br {{ is_array($kepsek) ? $kepsek['photo_bg'] : 'from-amber-50 to-yellow-100' }}">
                        @if(!is_array($kepsek) && $kepsek->user?->foto)
                            <img src="{{ asset('storage/' . $kepsek->user->foto) }}" alt="{{ $kepsek->user->name }}">
                        @else
                            <i class="fa {{ is_array($kepsek) ? $kepsek['ico'] : 'fa-user-tie' }} {{ is_array($kepsek) ? $kepsek['ico_c'] : 'text-amber-500' }} text-5xl"></i>
                        @endif
                        <span class="member-jabatan-badge {{ is_array($kepsek) ? $kepsek['badge_bg'] : 'bg-amber-400 text-amber-900' }}">
                            Kepsek
                        </span>
                    </div>
                    <div class="p-5 text-center">
                        <p class="font-black text-gray-900 text-base leading-snug mb-1">
                            {{ is_object($kepsek) ? ($kepsek->user?->name ?? '—') : $kepsek['nama'] }}
                        </p>
                        <p class="text-xs font-bold text-amber-600 mb-1">
                            {{ is_array($kepsek) ? $kepsek['jabatan'] : ($kepsek->jabatan ?? 'Kepala Sekolah') }}
                        </p>
                        @if(is_object($kepsek) && !empty($kepsek->nip))
                        <span class="inline-block mt-2 text-xs bg-amber-50 text-amber-700 px-3 py-1 rounded-full font-semibold">
                            NIP: {{ $kepsek->nip }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Grid anggota --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                @foreach($anggota as $idx => $g)
                @php
                    $bgs   = ['from-blue-50 to-sky-100','from-indigo-50 to-blue-100','from-violet-50 to-purple-100',
                              'from-green-50 to-emerald-100','from-teal-50 to-cyan-100','from-sky-50 to-blue-100',
                              'from-pink-50 to-rose-100','from-orange-50 to-amber-100','from-slate-50 to-gray-100'];
                    $badges= ['bg-blue-100 text-blue-800','bg-indigo-100 text-indigo-800','bg-violet-100 text-violet-800',
                              'bg-green-100 text-green-800','bg-teal-100 text-teal-800','bg-sky-100 text-sky-800',
                              'bg-pink-100 text-pink-800','bg-orange-100 text-orange-800','bg-slate-100 text-slate-700'];
                    $i     = $idx % count($bgs);

                    $nama    = is_array($g) ? $g['nama']    : ($g->user?->name ?? '—');
                    $jabatan = is_array($g) ? $g['jabatan'] : ($g->jabatan ?? '—');
                    $nip     = is_array($g) ? ($g['nip'] ?? null) : ($g->nip ?? null);
                    $foto    = is_array($g) ? null : ($g->user?->foto ?? null);
                    $bg      = is_array($g) ? $g['photo_bg'] : $bgs[$i];
                    $badge   = is_array($g) ? $g['badge_bg'] : $badges[$i];
                    $label   = explode(' ', $jabatan)[0];
                @endphp
                <div class="member-card fade-up" style="transition-delay: {{ ($idx % 5) * 60 }}ms">
                    <div class="member-photo bg-gradient-to-br {{ $bg }}">
                        @if($foto)
                            <img src="{{ asset('storage/' . $foto) }}" alt="{{ $nama }}">
                        @else
                            <i class="fa fa-user {{ is_array($g) ? $g['ico_c'] : 'text-blue-400' }} text-4xl"></i>
                        @endif
                        <span class="member-jabatan-badge {{ $badge }}">{{ $label }}</span>
                    </div>
                    <div class="p-4 text-center">
                        <p class="font-black text-gray-900 text-sm leading-snug mb-1">{{ $nama }}</p>
                        <p class="text-xs font-bold text-blue-700 mb-1">{{ $jabatan }}</p>
                        @if($nip)
                        <span class="inline-block mt-1 text-xs bg-red-50 text-red-700 px-2 py-0.5 rounded-full font-semibold">
                            NIP: {{ $nip }}
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @if(!$useDB)
            <p class="text-center text-xs text-gray-400 mt-8 italic">* Data guru akan ditampilkan sesuai database sekolah.</p>
            @endif

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