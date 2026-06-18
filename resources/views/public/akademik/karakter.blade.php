@extends('layouts.public')

@section('title', $pageTitle ?? 'Pendidikan Karakter — SDN Sukorame 1')

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

    /* Karakter Card */
    .karakter-card {
        background: white; border-radius: 20px;
        border: 1.5px solid #e0e7ff; overflow: hidden;
        transition: all .25s;
    }
    .karakter-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 12px 32px rgba(29,78,216,.12);
        transform: translateY(-3px);
    }
    .karakter-card-top {
        height: 6px;
    }

    /* Program Row */
    .program-row {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 14px 16px; border-radius: 14px;
        border: 1px solid #f1f5f9; background: white;
        transition: all .22s; margin-bottom: 8px;
    }
    .program-row:last-child { margin-bottom: 0; }
    .program-row:hover { border-color: #bfdbfe; background: #f8fbff; }

    /* Nilai strip */
    .nilai-strip {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 16px 18px;
        display: flex; align-items: center; gap: 14px;
        transition: all .22s;
    }
    .nilai-strip:hover { border-color: #93c5fd; box-shadow: 0 6px 20px rgba(29,78,216,.09); transform: translateX(4px); }

    /* Quote Block */
    .quote-block {
        background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%);
        border-left: 4px solid #1d4ed8; border-radius: 0 16px 16px 0;
        padding: 20px 24px;
    }

    /* Stat Mini */
    .stat-mini {
        background: white; border-radius: 16px;
        border: 1.5px solid #e0e7ff; padding: 20px 14px;
        text-align: center; transition: all .22s;
    }
    .stat-mini:hover { border-color: #93c5fd; box-shadow: 0 8px 20px rgba(29,78,216,.1); transform: translateY(-2px); }

    /* CTA */
    .cta-band {
        background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%);
        position: relative; overflow: hidden;
    }
    .cta-band::before {
        content: ''; position: absolute; inset: 0; opacity: .04;
        background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 24px 24px;
    }

    /* Jadwal table */
    .jadwal-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .jadwal-table thead th {
        background: #1e3a8a; color: white; font-size: 11px; font-weight: 700;
        letter-spacing: .06em; text-transform: uppercase; padding: 10px 14px;
    }
    .jadwal-table thead th:first-child { border-radius: 12px 0 0 0; }
    .jadwal-table thead th:last-child  { border-radius: 0 12px 0 0; }
    .jadwal-table tbody tr { transition: background .15s; }
    .jadwal-table tbody tr:hover { background: #f0f7ff; }
    .jadwal-table tbody td { padding: 10px 14px; font-size: 12px; border-bottom: 1px solid #f1f5f9; }

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
            <span class="text-white/80">Pendidikan Karakter</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Akademik
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Pendidikan<br>
                    <span style="color:#FDE68A;">Karakter</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-lg" style="font-size:1rem;">
                    Pembentukan karakter mulia melalui pembiasaan, keteladanan, dan kegiatan
                    terprogram di SD Negeri Sukorame 1 Kota Kediri.
                </p>
            </div>
            <div class="flex gap-3 flex-shrink-0">
                @php
                    $hs = [
                        ['val'=> $stats['nilaiUtama'] ?? '18',  'lbl'=>'Nilai Karakter', 'ico'=>'fa-heart'],
                        ['val'=> $stats['program']    ?? '8',   'lbl'=>'Program',        'ico'=>'fa-sitemap'],
                        ['val'=> $stats['pembiasaan'] ?? '5',   'lbl'=>'Pembiasaan',     'ico'=>'fa-sun'],
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

    {{-- VISI KARAKTER --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Landasan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Visi Pendidikan Karakter</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
                    Membentuk peserta didik yang beriman, berakhlak mulia, cerdas, mandiri,
                    dan cinta tanah air melalui pembudayaan nilai-nilai luhur Pancasila.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-14 fade-up">
                @php $stats_ov = [
                    ['icon'=>'fa-heart',         'val'=>'18',       'lbl'=>'Nilai Karakter', 'color'=>'bg-red-50 text-red-600'],
                    ['icon'=>'fa-users',          'val'=>'100%',     'lbl'=>'Partisipasi Siswa','color'=>'bg-blue-50 text-blue-600'],
                    ['icon'=>'fa-chalkboard-teacher','val'=>'8',     'lbl'=>'Program Aktif',  'color'=>'bg-indigo-50 text-indigo-600'],
                    ['icon'=>'fa-award',          'val'=>'2024',     'lbl'=>'Tahun Penerapan','color'=>'bg-amber-50 text-amber-600'],
                ]; @endphp
                @foreach ($stats_ov as $s)
                <div class="stat-mini fade-up">
                    <div class="w-12 h-12 {{ $s['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <i class="fa {{ $s['icon'] }} text-lg"></i>
                    </div>
                    <p class="font-black text-gray-900 text-2xl leading-tight">{{ $s['val'] }}</p>
                    <p class="text-gray-400 text-xs mt-1">{{ $s['lbl'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="quote-block fade-up">
                <i class="fa fa-quote-left text-blue-200 text-3xl mb-3 block"></i>
                <p class="text-gray-800 font-semibold text-base leading-relaxed mb-2">
                    "Pendidikan karakter bukan hanya tanggung jawab sekolah, melainkan kolaborasi nyata antara
                    guru, orang tua, dan lingkungan untuk membentuk generasi yang berkarakter mulia."
                </p>
                <p class="text-blue-600 text-xs font-bold">— Kepala Sekolah SDN Sukorame 1</p>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- 18 NILAI KARAKTER --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Kemendikbud</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">18 Nilai Karakter Bangsa</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Nilai-nilai karakter yang dikembangkan berdasarkan panduan Kementerian Pendidikan dan Kebudayaan.
                </p>
            </div>

            @php
                $nilaiKarakter = [
                    ['no'=>1,  'nama'=>'Religius',              'icon'=>'fa-pray',           'color'=>'bg-amber-50 text-amber-600',   'border'=>'border-amber-200',   'desc'=>'Sikap patuh dalam melaksanakan ajaran agama yang dianut.'],
                    ['no'=>2,  'nama'=>'Jujur',                 'icon'=>'fa-hand-paper',     'color'=>'bg-blue-50 text-blue-600',     'border'=>'border-blue-200',     'desc'=>'Perilaku yang menjadikan dirinya sebagai orang yang dapat dipercaya.'],
                    ['no'=>3,  'nama'=>'Toleransi',             'icon'=>'fa-handshake',      'color'=>'bg-green-50 text-green-600',   'border'=>'border-green-200',    'desc'=>'Sikap menghargai perbedaan agama, suku, etnis, dan pendapat.'],
                    ['no'=>4,  'nama'=>'Disiplin',              'icon'=>'fa-clock',          'color'=>'bg-indigo-50 text-indigo-600', 'border'=>'border-indigo-200',   'desc'=>'Tindakan yang menunjukkan perilaku tertib dan patuh pada peraturan.'],
                    ['no'=>5,  'nama'=>'Kerja Keras',           'icon'=>'fa-fist-raised',    'color'=>'bg-orange-50 text-orange-600', 'border'=>'border-orange-200',   'desc'=>'Perilaku sungguh-sungguh dalam mengatasi berbagai hambatan belajar.'],
                    ['no'=>6,  'nama'=>'Kreatif',               'icon'=>'fa-lightbulb',      'color'=>'bg-yellow-50 text-yellow-600', 'border'=>'border-yellow-200',   'desc'=>'Berpikir dan melakukan sesuatu untuk menghasilkan cara atau hasil baru.'],
                    ['no'=>7,  'nama'=>'Mandiri',               'icon'=>'fa-user-check',     'color'=>'bg-teal-50 text-teal-600',     'border'=>'border-teal-200',     'desc'=>'Sikap tidak bergantung pada orang lain dalam menyelesaikan tugas.'],
                    ['no'=>8,  'nama'=>'Demokratis',            'icon'=>'fa-vote-yea',       'color'=>'bg-cyan-50 text-cyan-600',     'border'=>'border-cyan-200',     'desc'=>'Cara berpikir dan bertindak yang menilai sama hak dan kewajiban.'],
                    ['no'=>9,  'nama'=>'Rasa Ingin Tahu',       'icon'=>'fa-search',         'color'=>'bg-violet-50 text-violet-600', 'border'=>'border-violet-200',   'desc'=>'Sikap selalu berupaya mengetahui lebih mendalam dari yang dipelajari.'],
                    ['no'=>10, 'nama'=>'Semangat Kebangsaan',   'icon'=>'fa-flag',           'color'=>'bg-red-50 text-red-600',       'border'=>'border-red-200',      'desc'=>'Cara berpikir dan bertindak yang menempatkan kepentingan bangsa di atas pribadi.'],
                    ['no'=>11, 'nama'=>'Cinta Tanah Air',       'icon'=>'fa-map',            'color'=>'bg-emerald-50 text-emerald-600','border'=>'border-emerald-200', 'desc'=>'Cara berpikir dan bersikap yang menunjukkan kesetiaan pada bangsa.'],
                    ['no'=>12, 'nama'=>'Menghargai Prestasi',   'icon'=>'fa-trophy',         'color'=>'bg-amber-50 text-amber-600',   'border'=>'border-amber-200',    'desc'=>'Sikap mendorong dirinya untuk menghasilkan sesuatu yang berguna.'],
                    ['no'=>13, 'nama'=>'Bersahabat',            'icon'=>'fa-smile',          'color'=>'bg-pink-50 text-pink-600',     'border'=>'border-pink-200',     'desc'=>'Tindakan memperlihatkan rasa senang berbicara dan bekerja sama.'],
                    ['no'=>14, 'nama'=>'Cinta Damai',           'icon'=>'fa-dove',           'color'=>'bg-sky-50 text-sky-600',       'border'=>'border-sky-200',      'desc'=>'Sikap yang menyebabkan orang lain merasa senang dan aman.'],
                    ['no'=>15, 'nama'=>'Gemar Membaca',         'icon'=>'fa-book-open',      'color'=>'bg-blue-50 text-blue-600',     'border'=>'border-blue-200',     'desc'=>'Kebiasaan menyediakan waktu untuk membaca berbagai bacaan.'],
                    ['no'=>16, 'nama'=>'Peduli Lingkungan',     'icon'=>'fa-leaf',           'color'=>'bg-green-50 text-green-600',   'border'=>'border-green-200',    'desc'=>'Sikap mencegah kerusakan lingkungan alam di sekitarnya.'],
                    ['no'=>17, 'nama'=>'Peduli Sosial',         'icon'=>'fa-hands-helping',  'color'=>'bg-orange-50 text-orange-600', 'border'=>'border-orange-200',   'desc'=>'Sikap selalu ingin memberi bantuan bagi orang lain yang membutuhkan.'],
                    ['no'=>18, 'nama'=>'Tanggung Jawab',        'icon'=>'fa-shield-alt',     'color'=>'bg-indigo-50 text-indigo-600', 'border'=>'border-indigo-200',   'desc'=>'Sikap melaksanakan tugas dan kewajibannya terhadap diri sendiri dan orang lain.'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($nilaiKarakter as $nk)
                <div class="nilai-strip fade-up">
                    <div class="w-11 h-11 {{ $nk['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa {{ $nk['icon'] }}"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-black text-gray-300">#{{ str_pad($nk['no'], 2, '0', STR_PAD_LEFT) }}</span>
                            <p class="font-bold text-gray-900 text-sm">{{ $nk['nama'] }}</p>
                        </div>
                        <p class="text-gray-400 text-xs leading-snug">{{ $nk['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- PROGRAM PEMBIASAAN --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Implementasi</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Program Pembiasaan</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Kegiatan rutin yang dilaksanakan untuk menanamkan nilai-nilai karakter secara konsisten.
                </p>
            </div>

            @php
                $pembiasaan = [
                    [
                        'label' => 'Pembiasaan Harian',
                        'color' => 'bg-blue-700',
                        'items' => [
                            ['nama'=>'Salam, Sapa & Jabat Tangan',    'icon'=>'fa-hands',       'color'=>'bg-amber-50 text-amber-600',   'waktu'=>'06.30 – 07.00', 'desc'=>'Guru menyambut siswa di gerbang setiap pagi hari.'],
                            ['nama'=>'Tadarus / Doa Bersama',         'icon'=>'fa-pray',        'color'=>'bg-green-50 text-green-600',   'waktu'=>'07.00 – 07.15', 'desc'=>'Membaca Al-Quran atau doa bersama sebelum KBM dimulai.'],
                            ['nama'=>'Menyanyikan Lagu Indonesia Raya','icon'=>'fa-music',       'color'=>'bg-red-50 text-red-600',       'waktu'=>'07.15 – 07.20', 'desc'=>'Menyanyikan lagu kebangsaan bersama di kelas masing-masing.'],
                            ['nama'=>'Literasi 15 Menit',             'icon'=>'fa-book-open',   'color'=>'bg-blue-50 text-blue-600',     'waktu'=>'07.20 – 07.35', 'desc'=>'Membaca buku non-pelajaran sebelum pembelajaran dimulai.'],
                        ],
                    ],
                    [
                        'label' => 'Pembiasaan Mingguan',
                        'color' => 'bg-indigo-600',
                        'items' => [
                            ['nama'=>'Upacara Bendera',               'icon'=>'fa-flag',        'color'=>'bg-red-50 text-red-600',       'waktu'=>'Senin, 07.00',   'desc'=>'Upacara bendera wajib setiap Senin pagi.'],
                            ['nama'=>'Jumat Bersih & Sehat',          'icon'=>'fa-broom',       'color'=>'bg-green-50 text-green-600',   'waktu'=>'Jumat, 07.00',   'desc'=>'Kerja bakti membersihkan lingkungan sekolah bersama.'],
                            ['nama'=>'Sholat Dhuha Berjamaah',        'icon'=>'fa-mosque',      'color'=>'bg-amber-50 text-amber-600',   'waktu'=>'Jumat, 09.00',   'desc'=>'Sholat Dhuha berjamaah untuk siswa Muslim kelas IV–VI.'],
                        ],
                    ],
                    [
                        'label' => 'Pembiasaan Bulanan / Insidental',
                        'color' => 'bg-violet-600',
                        'items' => [
                            ['nama'=>'Infaq Jumat',                   'icon'=>'fa-hand-holding-heart','color'=>'bg-pink-50 text-pink-600',   'waktu'=>'Setiap Jumat',  'desc'=>'Pengumpulan infaq sukarela untuk kegiatan sosial sekolah.'],
                            ['nama'=>'Peringatan Hari Besar Nasional','icon'=>'fa-star',         'color'=>'bg-indigo-50 text-indigo-600', 'waktu'=>'Insidental',    'desc'=>'Kegiatan upacara dan lomba memperingati hari besar nasional.'],
                        ],
                    ],
                ];
            @endphp

            <div class="space-y-8">
                @foreach ($pembiasaan as $group)
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

    {{-- JADWAL PEMBINAAN --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="mb-10 fade-up">
                <div class="sec-label">Jadwal</div>
                <h2 class="font-display text-2xl md:text-3xl font-black text-gray-900">Jadwal Pembinaan Karakter</h2>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden fade-up shadow-sm">
                <table class="jadwal-table">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Kegiatan</th>
                            <th>Waktu</th>
                            <th>Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $jadwalPembinaan = [
                                ['hari'=>'Senin',  'kegiatan'=>'Upacara Bendera + Pembinaan Wali Kelas', 'waktu'=>'07.00 – 08.00', 'pj'=>'Wali Kelas & Pembina Upacara'],
                                ['hari'=>'Selasa', 'kegiatan'=>'Tadarus & Literasi Pagi',               'waktu'=>'07.00 – 07.35', 'pj'=>'Wali Kelas'],
                                ['hari'=>'Rabu',   'kegiatan'=>'Literasi Pagi + Olahraga Ringan',       'waktu'=>'07.00 – 07.35', 'pj'=>'Guru Olahraga'],
                                ['hari'=>'Kamis',  'kegiatan'=>'Literasi Pagi + Seni Budaya Lokal',     'waktu'=>'07.00 – 07.35', 'pj'=>'Guru Seni'],
                                ['hari'=>'Jumat',  'kegiatan'=>'Jumat Bersih + Sholat Dhuha Berjamaah', 'waktu'=>'07.00 – 09.30', 'pj'=>'Guru PAI & Wali Kelas'],
                            ];
                        @endphp
                        @foreach ($jadwalPembinaan as $j)
                        <tr>
                            <td><span class="font-bold text-gray-900">{{ $j['hari'] }}</span></td>
                            <td class="text-gray-700">{{ $j['kegiatan'] }}</td>
                            <td><span class="text-blue-600 font-semibold text-[11px]">{{ $j['waktu'] }}</span></td>
                            <td class="text-gray-500">{{ $j['pj'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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