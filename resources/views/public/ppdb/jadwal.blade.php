@extends('layouts.public')

@section('title', $pageTitle ?? 'Jadwal PPDB — SDN Sukorame 1')

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
    .timeline-card {
        background: white; border-radius: 20px; border: 1px solid #f1f5f9;
        transition: all .3s; position: relative;
    }
    .timeline-card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .timeline-card.active { border-color: #3b82f6; box-shadow: 0 8px 32px rgba(59,130,246,.15); }
    .timeline-card.active::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
        background: #1d4ed8; border-radius: 4px 0 0 4px;
    }
    .badge-aktif { background: #dcfce7; color: #166534; }
    .badge-akan { background: #fef3c7; color: #92400e; }
    .badge-selesai { background: #f1f5f9; color: #64748b; }
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
    .countdown-box { background: white; border-radius: 16px; padding: 16px 20px; text-align: center; border: 1px solid #e2e8f0; min-width: 72px; }
</style>
@endpush

@section('content')

@php
    // --- KONFIGURASI JADWAL UTAMA ---
    // Gunakan format Y-m-d agar mudah diproses Carbon
    $raw_jadwals = [
        ['01', 'Sosialisasi PPDB', '2025-05-19', '2025-05-31', 'Informasi resmi diumumkan melalui papan pengumuman sekolah dan website.', 'fa-bullhorn'],
        ['02', 'Pendaftaran Akun/Berkas', '2025-06-02', '2025-06-14', 'Calon siswa menyerahkan berkas persyaratan langsung ke panitia di sekolah.', 'fa-file-pen'],
        ['03', 'Verifikasi & Validasi Data', '2025-06-02', '2025-06-16', 'Panitia mengecek keabsahan dokumen dan pemetaan zonasi tempat tinggal.', 'fa-folder-open'],
        ['04', 'Seleksi & Rapat Pleno', '2025-06-18', '2025-06-19', 'Proses seleksi internal berdasarkan kriteria yang berlaku.', 'fa-list-check'],
        ['05', 'Pengumuman Kelulusan', '2025-06-21', '2025-06-21', 'Hasil akhir diumumkan di papan sekolah dan portal informasi PPDB.', 'fa-trophy'],
    ];

    $now = now();
    $processed_jadwals = [];

    foreach($raw_jadwals as $r) {
        $mulai = \Carbon\Carbon::parse($r[2]);
        $selesai = \Carbon\Carbon::parse($r[3])->endOfDay();
        
        $status = 'akan';
        $label = 'Akan Datang';
        
        if ($now->gt($selesai)) {
            $status = 'selesai';
            $label = 'Selesai';
        } elseif ($now->between($mulai, $selesai)) {
            $status = 'aktif';
            $label = 'Sedang Berjalan';
        }

        $processed_jadwals[] = [
            'no' => $r[0],
            'kegiatan' => $r[1],
            'mulai' => $mulai->translatedFormat('d M Y'),
            'selesai' => $selesai->translatedFormat('d M Y'),
            'keterangan' => $r[4],
            'status' => $status,
            'label' => $label,
            'icon' => $r[5]
        ];
    }

    $badgeClass = ['aktif'=>'badge-aktif', 'akan'=>'badge-akan', 'selesai'=>'badge-selesai'];
@endphp

{{-- PAGE HERO --}}
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">PPDB</span>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Jadwal</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Tahun Pelajaran 2025/2026
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Jadwal Penerimaan<br>
                    <span style="color:#FDE68A;">Peserta Didik Baru</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl">
                    Pantau setiap tahapan pendaftaran PPDB SDN Sukorame 1 agar tidak melewatkan proses penting.
                </p>
            </div>

            <div class="bg-white/10 border border-white/20 rounded-2xl p-6 flex-shrink-0 text-center">
                <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-4">Pendaftaran Dibuka Dalam</p>
                <div class="flex gap-3 justify-center" id="countdown">
                    <div class="countdown-box">
                        <p class="font-display font-black text-gray-900 text-2xl" id="cd-days">--</p>
                        <p class="text-gray-400 text-[10px] mt-1 font-semibold">Hari</p>
                    </div>
                    <div class="countdown-box">
                        <p class="font-display font-black text-gray-900 text-2xl" id="cd-hours">--</p>
                        <p class="text-gray-400 text-[10px] mt-1 font-semibold">Jam</p>
                    </div>
                    <div class="countdown-box">
                        <p class="font-display font-black text-gray-900 text-2xl" id="cd-mins">--</p>
                        <p class="text-gray-400 text-[10px] mt-1 font-semibold">Menit</p>
                    </div>
                </div>
                <p class="text-white/50 text-[11px] mt-4">Target: 2 Juni 2025, 08.00 WIB</p>
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">
    <div class="bg-amber-50 border-b border-amber-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center gap-4">
            <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fa fa-location-dot text-white text-sm"></i>
            </div>
            <p class="text-amber-900 text-sm font-semibold">
                Lokasi: <span class="font-black">Sekretariat PPDB SDN Sukorame 1, Jl. Sukorame, Kediri.</span>
            </p>
        </div>
    </div>

    {{-- TIMELINE SECTION --}}
    <section id="jadwal-pendaftaran" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Timeline</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Agenda Pelaksanaan</h2>
            </div>

            <div class="space-y-4">
                @foreach($processed_jadwals as $idx => $j)
                <div class="timeline-card p-6 fade-up {{ $j['status'] === 'aktif' ? 'active' : '' }}" style="transition-delay: {{ $idx * 60 }}ms">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex items-center gap-4 flex-1">
                            <div class="w-12 h-12 {{ $j['status'] === 'aktif' ? 'bg-blue-600' : ($j['status'] === 'selesai' ? 'bg-gray-100' : 'bg-amber-50') }} rounded-2xl flex items-center justify-center flex-shrink-0">
                                <i class="fa {{ $j['icon'] }} {{ $j['status'] === 'aktif' ? 'text-white' : ($j['status'] === 'selesai' ? 'text-gray-400' : 'text-amber-600') }} text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <h3 class="font-black text-gray-900 text-sm">{{ $j['kegiatan'] }}</h3>
                                    <span class="text-[11px] font-bold px-3 py-0.5 rounded-full {{ $badgeClass[$j['status']] }}">{{ $j['label'] }}</span>
                                </div>
                                <p class="text-gray-400 text-xs">{{ $j['keterangan'] }}</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0 sm:text-right">
                            <p class="text-gray-900 font-bold text-sm">{{ $j['mulai'] }}</p>
                            @if($j['mulai'] !== $j['selesai'])
                                <p class="text-gray-400 text-xs">s.d. {{ $j['selesai'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DAFTAR ULANG --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Pasca Seleksi</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Daftar Ulang & Orientasi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @php
                $fase2 = [
                    ['fa-pen-to-square', 'bg-blue-50', 'text-blue-600', 'Daftar Ulang', '23 — 27 Jun 2025', 'Pukul 08.00 - 12.00'],
                    ['fa-chalkboard-user', 'bg-green-50', 'text-green-600', 'Masa MPLS', '07 — 09 Jul 2025', 'Orientasi siswa baru'],
                    ['fa-book-open', 'bg-amber-50', 'text-amber-600', 'Awal Belajar', '07 Jul 2025', 'Hari pertama masuk'],
                ];
                @endphp
                @foreach($fase2 as $idx => $f)
                <div class="bg-white rounded-2xl border border-gray-100 p-6 fade-up" style="transition-delay: {{ $idx * 80 }}ms">
                    <div class="w-12 h-12 {{ $f[1] }} {{ $f[2] }} rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa {{ $f[0] }} text-xl"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-sm mb-2">{{ $f[3] }}</h3>
                    <p class="text-blue-700 font-bold text-xs mb-1">{{ $f[4] }}</p>
                    <p class="text-gray-400 text-xs">{{ $f[5] }}</p>
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

    // Countdown Logic
    const target = new Date('2025-06-02T08:00:00+07:00').getTime();
    function updateCountdown() {
        const now = Date.now();
        const diff = target - now;
        if (diff <= 0) return;
        
        document.getElementById('cd-days').textContent = String(Math.floor(diff / 86400000)).padStart(2, '0');
        document.getElementById('cd-hours').textContent = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
        document.getElementById('cd-mins').textContent = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
    }
    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endpush