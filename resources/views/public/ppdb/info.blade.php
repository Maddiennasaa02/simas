@extends('layouts.public')

@section('title', $pageTitle ?? 'Informasi PPDB — SDN Sukorame 1')

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
    .info-card {
        background: white; border-radius: 20px; border: 1px solid #f1f5f9;
        transition: all .3s; position: relative; overflow: hidden;
    }
    .info-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .info-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
        background: #1d4ed8; opacity: 0; transition: opacity .3s;
    }
    .info-card:hover::after { opacity: 1; }
    .stat-card {
        background: white; border-radius: 20px; border: 1px solid #f1f5f9;
        transition: all .3s;
    }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .cta-band {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%);
        position: relative; overflow: hidden;
    }
    .cta-band::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 24px 24px;
    }
    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    .progress-bar { width: 0; transition: width 1.2s cubic-bezier(.4,0,.2,1); }
</style>
@endpush

@section('content')

{{-- PAGE HERO --}}
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div style="position:absolute;width:400px;height:400px;right:-100px;top:-100px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.06) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;width:240px;height:240px;left:6%;bottom:-70px;border-radius:50%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);pointer-events:none;"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">PPDB</span>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Informasi</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Penerimaan Peserta Didik Baru
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    PPDB Tahun Pelajaran<br>
                    <span style="color:#FDE68A;">2025 / 2026</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl" style="font-size:1rem;">
                    SDN Sukorame 1 membuka penerimaan peserta didik baru. Daftarkan putra-putri Anda
                    sekarang — pendaftaran gratis dan terbuka untuk semua.
                </p>
                <div class="flex flex-wrap gap-3 mt-7">
                    @foreach([
                        ['#jalur',  'fa-road',      'Jalur Penerimaan'],
                        ['#kuota',  'fa-users',     'Kuota'],
                        ['#kontak', 'fa-phone',     'Kontak'],
                    ] as $n)
                    <a href="{{ $n[0] }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                        <i class="fa {{ $n[1] }} text-amber-300 text-[10px]"></i> {{ $n[2] }}
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 flex-shrink-0">
                @foreach([
                    ['60',     'Kuota Siswa',       'fa-user-graduate', 'text-amber-300'],
                    ['2',      'Rombel Baru',        'fa-chalkboard',    'text-blue-300'],
                    ['Gratis', 'Biaya Pendaftaran',  'fa-circle-check',  'text-green-300'],
                    ['A',      'Terakreditasi',      'fa-medal',         'text-amber-300'],
                ] as $s)
                <div class="bg-white/10 border border-white/20 rounded-2xl px-5 py-4 text-center">
                    <i class="fa {{ $s[2] }} {{ $s[3] }} text-xl mb-2 block"></i>
                    <p class="font-display text-white font-black text-2xl leading-none">{{ $s[0] }}</p>
                    <p class="text-white/60 text-[11px] mt-1">{{ $s[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">

    {{-- BANNER PENGUMUMAN --}}
    <div class="bg-amber-50 border-b border-amber-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center gap-4">
            <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fa fa-bullhorn text-white text-sm"></i>
            </div>
            <p class="text-amber-900 text-sm font-semibold">
                <span class="font-black">Pendaftaran Resmi Dibuka!</span>
                Pendaftaran dibuka mulai <span class="font-black">2 Juni 2025</span> s.d.
                <span class="font-black">20 Juni 2025</span>. Tidak dipungut biaya apapun.
            </p>
        </div>
    </div>

    {{-- JALUR PENERIMAAN --}}
    <section id="jalur" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Jalur Penerimaan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Informasi Umum PPDB</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Hal-hal penting yang perlu Anda ketahui sebelum mendaftarkan putra-putri Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $infos = [
                    ['ico'=>'fa-graduation-cap',           'bg'=>'bg-blue-50',   'ico_c'=>'text-blue-600',   'title'=>'Jenjang Pendidikan',   'desc'=>'Pendidikan dasar 6 tahun dari Kelas I hingga Kelas VI.'],
                    ['ico'=>'fa-road',                     'bg'=>'bg-amber-50',  'ico_c'=>'text-amber-600',  'title'=>'Jalur Penerimaan',     'desc'=>'Zonasi, Afirmasi, dan Perpindahan Tugas sesuai ketentuan Dinas Pendidikan.'],
                    ['ico'=>'fa-calendar-days',            'bg'=>'bg-green-50',  'ico_c'=>'text-green-600',  'title'=>'Periode Pendaftaran',  'desc'=>'2 Juni 2025 s.d. 20 Juni 2025 pada hari dan jam kerja.'],
                    ['ico'=>'fa-hand-holding-dollar',      'bg'=>'bg-indigo-50', 'ico_c'=>'text-indigo-600', 'title'=>'Biaya Pendaftaran',    'desc'=>'Tidak dipungut biaya apapun (GRATIS). Waspada pungutan tidak resmi.'],
                ];
                @endphp
                @foreach($infos as $idx => $info)
                <div class="info-card p-6 fade-up" style="transition-delay: {{ $idx * 70 }}ms">
                    <div class="w-12 h-12 {{ $info['bg'] }} rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa {{ $info['ico'] }} {{ $info['ico_c'] }} text-xl"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-sm mb-2">{{ $info['title'] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $info['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- KUOTA --}}
    <section id="kuota" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Kuota Siswa</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Rincian Kuota Penerimaan</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Pembagian kuota berdasarkan jalur penerimaan Tahun Pelajaran 2025/2026.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                @php
                $kuotas = [
                    ['jalur'=>'Zonasi',            'icon'=>'fa-house',     'jumlah'=>42, 'persen'=>70, 'bar'=>'bg-blue-600',  'light'=>'bg-blue-50',  'txt'=>'text-blue-700',  'desc'=>'Berdomisili di wilayah zonasi sekolah'],
                    ['jalur'=>'Afirmasi',           'icon'=>'fa-heart',     'jumlah'=>12, 'persen'=>20, 'bar'=>'bg-green-600', 'light'=>'bg-green-50', 'txt'=>'text-green-700', 'desc'=>'Penerima KIP / PKH / DTKS'],
                    ['jalur'=>'Perpindahan Tugas', 'icon'=>'fa-briefcase', 'jumlah'=>6,  'persen'=>10, 'bar'=>'bg-amber-500', 'light'=>'bg-amber-50', 'txt'=>'text-amber-700', 'desc'=>'Orang tua mutasi ke Kota Kediri'],
                ];
                @endphp
                @foreach($kuotas as $idx => $k)
                <div class="stat-card p-6 fade-up" style="transition-delay: {{ $idx * 80 }}ms">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 {{ $k['light'] }} rounded-2xl flex items-center justify-center">
                            <i class="fa {{ $k['icon'] }} {{ $k['txt'] }} text-lg"></i>
                        </div>
                        <span class="text-xs font-bold {{ $k['txt'] }} {{ $k['light'] }} px-3 py-1 rounded-full">{{ $k['persen'] }}%</span>
                    </div>
                    <p class="font-display font-black text-gray-900 text-3xl leading-none mb-1">{{ $k['jumlah'] }}</p>
                    <p class="text-gray-500 text-xs mb-1">siswa — <strong class="{{ $k['txt'] }}">{{ $k['jalur'] }}</strong></p>
                    <p class="text-gray-400 text-[11px] leading-relaxed mb-4">{{ $k['desc'] }}</p>
                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="progress-bar {{ $k['bar'] }} h-full rounded-full" data-width="{{ $k['persen'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="bg-blue-900 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 fade-up">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
                        <i class="fa fa-users text-amber-300 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-white/60 text-xs font-semibold uppercase tracking-wider">Total Keseluruhan</p>
                        <p class="text-white font-black text-lg">60 Siswa — 2 Rombongan Belajar</p>
                    </div>
                </div>
                <span class="bg-green-400 text-green-900 text-xs font-black px-4 py-2 rounded-full">✓ Pendaftaran Dibuka</span>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- KONTAK --}}
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Hubungi Kami</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Informasi & Kontak</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Butuh bantuan atau pertanyaan seputar PPDB? Hubungi panitia kami.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $kontaks = [
                    ['ico'=>'fa-phone',        'bg'=>'bg-blue-50',  'ico_c'=>'text-blue-600',  'lbl'=>'Telepon',          'val'=>'(0354) 123456'],
                    ['ico'=>'fa-location-dot', 'bg'=>'bg-red-50',   'ico_c'=>'text-red-500',   'lbl'=>'Alamat',           'val'=>'Jl. Sukorame, Kediri'],
                    ['ico'=>'fa-clock',        'bg'=>'bg-amber-50', 'ico_c'=>'text-amber-600', 'lbl'=>'Jam Pendaftaran',  'val'=>'Sen–Jum, 08.00–14.00'],
                    ['ico'=>'fa-envelope',     'bg'=>'bg-green-50', 'ico_c'=>'text-green-600', 'lbl'=>'Email',            'val'=>'ppdb@sdnsukorame1.sch.id'],
                ];
                @endphp
                @foreach($kontaks as $idx => $k)
                <div class="info-card p-5 flex items-center gap-4 fade-up" style="transition-delay:{{ $idx * 70 }}ms">
                    <div class="w-11 h-11 {{ $k['bg'] }} rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa {{ $k['ico'] }} {{ $k['ico_c'] }} text-lg"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-[11px] font-semibold uppercase tracking-wider">{{ $k['lbl'] }}</p>
                        <p class="text-gray-900 font-bold text-sm">{{ $k['val'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="cta-band py-16">
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 fade-up">
            <h2 class="font-display text-white font-black text-3xl md:text-4xl mb-4">
                Siap Mendaftarkan Putra-Putri Anda?
            </h2>
            <p class="text-white/70 mb-8 max-w-lg mx-auto">
                Ikuti alur pendaftaran dan siapkan dokumen persyaratan sebelum datang ke sekolah.
            </p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('ppdb.alur') }}"
                   class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black text-sm px-6 py-3 rounded-xl transition-all hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fa fa-arrow-right-long"></i> Lihat Alur Pendaftaran
                </a>
                <a href="{{ route('ppdb.syarat') }}"
                   class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm px-6 py-3 rounded-xl transition-all">
                    <i class="fa fa-list-check"></i> Syarat Pendaftaran
                </a>
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

    const progObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('.progress-bar').forEach(bar => {
                    setTimeout(() => { bar.style.width = bar.dataset.width; }, 300);
                });
                progObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('.stat-card').forEach(el => progObs.observe(el));
});
</script>
@endpush