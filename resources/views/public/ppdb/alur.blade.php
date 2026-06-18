@extends('layouts.public')

@section('title', $pageTitle ?? 'Alur Pendaftaran PPDB — SDN Sukorame 1')

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

    /* Step flow */
    .step-wrap { position: relative; }
    .step-wrap::before {
        content: '';
        position: absolute;
        left: 27px;
        top: 60px;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #3b82f6 0%, #bfdbfe 100%);
    }
    @media (min-width: 768px) {
        .step-wrap::before { left: 50%; transform: translateX(-50%); top: 80px; }
    }
    .step-card {
        background: white; border-radius: 20px; border: 1px solid #f1f5f9;
        transition: all .3s; position: relative;
    }
    .step-card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .step-number {
        width: 56px; height: 56px; border-radius: 50%;
        background: #1d4ed8; color: white;
        font-family: 'Playfair Display', serif;
        font-weight: 900; font-size: 1.25rem;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; position: relative; z-index: 1;
        box-shadow: 0 4px 20px rgba(29,78,216,.35);
    }
    .step-connector {
        width: 2px; height: 32px; background: #bfdbfe; margin: 0 auto;
    }
    .doc-card {
        background: white; border-radius: 16px; border: 1px solid #f1f5f9;
        transition: all .3s;
    }
    .doc-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(29,78,216,.08); border-color: #bfdbfe; }
    .tip-card {
        border-left: 4px solid;
        border-radius: 0 16px 16px 0;
        padding: 16px 20px;
    }
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
            <span class="text-white/80">Alur Pendaftaran</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Panduan Lengkap PPDB
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Alur & Prosedur<br>
                    <span style="color:#FDE68A;">Pendaftaran PPDB</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl" style="font-size:1rem;">
                    Ikuti langkah-langkah berikut dengan cermat agar proses pendaftaran putra-putri
                    Anda di SDN Sukorame 1 berjalan lancar dan berhasil.
                </p>
                <div class="flex flex-wrap gap-3 mt-7">
                    @foreach([
                        ['#alur-langkah', 'fa-list-ol',    'Langkah-Langkah'],
                        ['#dokumen',      'fa-folder-open', 'Dokumen'],
                        ['#tips',         'fa-lightbulb',   'Tips & Catatan'],
                    ] as $n)
                    <a href="{{ $n[0] }}" class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                        <i class="fa {{ $n[1] }} text-amber-300 text-[10px]"></i> {{ $n[2] }}
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 flex-shrink-0">
                @foreach([
                    ['7',      'Langkah Mudah',    'fa-shoe-prints',   'text-amber-300'],
                    ['GRATIS', 'Tanpa Biaya',       'fa-circle-check',  'text-green-300'],
                    ['Online', 'Cek Hasil',         'fa-globe',         'text-blue-300'],
                    ['B',      'Terakreditasi',     'fa-medal',         'text-amber-300'],
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

    {{-- BANNER --}}
    <div class="bg-amber-50 border-b border-amber-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center gap-4">
            <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fa fa-triangle-exclamation text-white text-sm"></i>
            </div>
            <p class="text-amber-900 text-sm font-semibold">
                <span class="font-black">Perhatian:</span> Calon siswa harus sudah berusia
                <span class="font-black">minimal 6 tahun</span> per 1 Juli 2025 dan belum pernah
                duduk di bangku Sekolah Dasar.
            </p>
        </div>
    </div>

    {{-- ALUR LANGKAH-LANGKAH --}}
    <section id="alur-langkah" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Panduan Pendaftaran</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Alur Pendaftaran PPDB</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Ikuti 7 langkah di bawah ini secara berurutan untuk menyelesaikan proses pendaftaran.
                </p>
            </div>

            @php
            $steps = [
                [
                    'num'   => '1',
                    'judul' => 'Pelajari Informasi PPDB',
                    'icon'  => 'fa-circle-info',
                    'bg'    => 'bg-blue-600',
                    'desc'  => 'Baca seluruh informasi PPDB yang tersedia di website sekolah dan papan pengumuman, termasuk persyaratan, kuota, jalur penerimaan, dan jadwal lengkap.',
                    'tips'  => 'Pastikan domisili Anda masuk zona prioritas SDN Sukorame 1 sebelum mendaftar melalui jalur zonasi.',
                    'detail'=> ['Baca ketentuan jalur penerimaan (Zonasi / Afirmasi / Perpindahan Tugas)', 'Periksa batas usia minimal calon siswa', 'Pahami kuota yang tersedia di setiap jalur'],
                ],
                [
                    'num'   => '2',
                    'judul' => 'Siapkan Dokumen Persyaratan',
                    'icon'  => 'fa-folder-open',
                    'bg'    => 'bg-indigo-600',
                    'desc'  => 'Kumpulkan semua dokumen asli dan fotokopi yang diperlukan sesuai jalur yang akan dipilih. Pastikan seluruh dokumen masih berlaku dan dalam kondisi baik.',
                    'tips'  => 'Fotokopi dokumen minimal 2 rangkap. Bawa dokumen asli untuk proses verifikasi.',
                    'detail'=> ['Akta kelahiran asli + fotokopi', 'Kartu Keluarga (KK) asli + fotokopi', 'KTP orang tua/wali + fotokopi', 'Bukti domisili / surat keterangan RT/RW (jalur zonasi)', 'Kartu KIP/PKH/DTKS (jalur afirmasi)', 'Surat mutasi tugas orang tua (jalur perpindahan tugas)'],
                ],
                [
                    'num'   => '3',
                    'judul' => 'Datang ke Sekolah & Ambil Formulir',
                    'icon'  => 'fa-school',
                    'bg'    => 'bg-green-600',
                    'desc'  => 'Datang ke SDN Sukorame 1 pada hari dan jam kerja (Senin–Jumat, 08.00–14.00 WIB) selama periode pendaftaran 2 – 20 Juni 2025. Ambil formulir pendaftaran di meja panitia.',
                    'tips'  => 'Datang lebih awal untuk menghindari antrean panjang, terutama di pekan pertama pembukaan.',
                    'detail'=> ['Menuju ruang panitia PPDB di lantai 1', 'Ambil nomor antrean', 'Isi formulir pendaftaran dengan lengkap dan benar'],
                ],
                [
                    'num'   => '4',
                    'judul' => 'Serahkan Formulir & Berkas',
                    'icon'  => 'fa-file-arrow-up',
                    'bg'    => 'bg-amber-500',
                    'desc'  => 'Serahkan formulir yang telah diisi beserta berkas persyaratan kepada petugas panitia PPDB. Panitia akan memeriksa kelengkapan berkas saat itu juga.',
                    'tips'  => 'Jika ada berkas yang kurang, Anda akan diberi waktu untuk melengkapi sebelum batas waktu pendaftaran.',
                    'detail'=> ['Serahkan formulir yang sudah diisi lengkap', 'Serahkan fotokopi berkas persyaratan', 'Tunjukkan dokumen asli untuk verifikasi'],
                ],
                [
                    'num'   => '5',
                    'judul' => 'Terima Tanda Bukti Pendaftaran',
                    'icon'  => 'fa-receipt',
                    'bg'    => 'bg-purple-600',
                    'desc'  => 'Setelah berkas dinyatakan lengkap, panitia akan mencetak dan menyerahkan tanda bukti pendaftaran beserta nomor peserta. Simpan tanda bukti ini dengan baik.',
                    'tips'  => 'Nomor peserta digunakan untuk memantau hasil seleksi. Jangan sampai hilang.',
                    'detail'=> ['Terima tanda bukti pendaftaran bernomor', 'Cek kebenaran data pada tanda bukti', 'Simpan untuk keperluan berikutnya'],
                ],
                [
                    'num'   => '6',
                    'judul' => 'Pantau Pengumuman Hasil Seleksi',
                    'icon'  => 'fa-bullhorn',
                    'bg'    => 'bg-rose-600',
                    'desc'  => 'Pengumuman hasil seleksi sementara pada 23 Juni 2025 dan hasil final pada 27 Juni 2025. Cek di papan pengumuman sekolah atau website SDN Sukorame 1.',
                    'tips'  => 'Jika keberatan dengan hasil seleksi sementara, gunakan masa sanggah 24–25 Juni 2025.',
                    'detail'=> ['Pantau pengumuman sementara: 23 Jun 2025', 'Ajukan sanggahan (jika ada): 24–25 Jun 2025', 'Pengumuman final: 27 Jun 2025'],
                ],
                [
                    'num'   => '7',
                    'judul' => 'Lakukan Daftar Ulang',
                    'icon'  => 'fa-pen-to-square',
                    'bg'    => 'bg-teal-600',
                    'desc'  => 'Bagi siswa yang dinyatakan diterima, wajib melakukan daftar ulang pada 30 Juni – 4 Juli 2025. Bawa berkas asli dan siapkan kelengkapan seragam.',
                    'tips'  => 'Siswa yang tidak melakukan daftar ulang tepat waktu dianggap mengundurkan diri dan kursi dialihkan ke calon berikutnya.',
                    'detail'=> ['Bawa semua dokumen asli untuk daftar ulang', 'Isi formulir daftar ulang', 'Ikuti MPLS: 14–16 Juli 2025'],
                ],
            ];
            @endphp

            <div class="space-y-6">
                @foreach($steps as $idx => $s)
                <div class="flex gap-5 fade-up" style="transition-delay: {{ $idx * 60 }}ms">
                    {{-- Number --}}
                    <div class="flex flex-col items-center flex-shrink-0">
                        <div class="step-number {{ $s['bg'] }}">{{ $s['num'] }}</div>
                        @if(!$loop->last)
                        <div class="step-connector mt-2"></div>
                        @endif
                    </div>
                    {{-- Card --}}
                    <div class="step-card p-6 flex-1 mb-{{ $loop->last ? '0' : '0' }}">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-9 h-9 {{ $s['bg'] }} bg-opacity-10 rounded-xl flex items-center justify-center">
                                <i class="fa {{ $s['icon'] }} text-sm" style="color: inherit; opacity: 0.9;" class="{{ $s['bg'] }}"></i>
                            </div>
                            <h3 class="font-black text-gray-900 text-sm">{{ $s['judul'] }}</h3>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed mb-4">{{ $s['desc'] }}</p>

                        {{-- Detail checklist --}}
                        <ul class="space-y-1.5 mb-4">
                            @foreach($s['detail'] as $d)
                            <li class="flex items-start gap-2">
                                <i class="fa fa-check-circle text-blue-500 text-[11px] mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-600 text-xs">{{ $d }}</span>
                            </li>
                            @endforeach
                        </ul>

                        {{-- Tip --}}
                        <div class="bg-amber-50 border border-amber-100 rounded-xl px-4 py-3 flex items-start gap-2">
                            <i class="fa fa-lightbulb text-amber-500 text-xs mt-0.5 flex-shrink-0"></i>
                            <p class="text-amber-800 text-xs leading-relaxed"><strong>Tips:</strong> {{ $s['tips'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- DOKUMEN --}}
    <section id="dokumen" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Persyaratan Dokumen</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Dokumen yang Diperlukan</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Siapkan dokumen berikut sesuai jalur yang dipilih. Bawa dokumen asli dan fotokopi saat mendaftar.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @php
                $docs = [
                    [
                        'jalur' => 'Jalur Zonasi',
                        'icon'  => 'fa-house',
                        'bg'    => 'bg-blue-50',
                        'ico_c' => 'text-blue-600',
                        'border'=> 'border-blue-200',
                        'items' => [
                            'Akta Kelahiran (asli + fotokopi)',
                            'Kartu Keluarga (asli + fotokopi)',
                            'KTP Orang Tua/Wali (asli + fotokopi)',
                            'Surat Keterangan Domisili dari RT/RW',
                            'Pas foto 3×4 (4 lembar)',
                            'Formulir Pendaftaran (diisi di sekolah)',
                        ],
                    ],
                    [
                        'jalur' => 'Jalur Afirmasi',
                        'icon'  => 'fa-heart',
                        'bg'    => 'bg-green-50',
                        'ico_c' => 'text-green-600',
                        'border'=> 'border-green-200',
                        'items' => [
                            'Akta Kelahiran (asli + fotokopi)',
                            'Kartu Keluarga (asli + fotokopi)',
                            'KTP Orang Tua/Wali (asli + fotokopi)',
                            'Kartu KIP / PKH / DTKS (asli + fotokopi)',
                            'Surat Keterangan dari Dinas Sosial (jika ada)',
                            'Pas foto 3×4 (4 lembar)',
                            'Formulir Pendaftaran (diisi di sekolah)',
                        ],
                    ],
                    [
                        'jalur' => 'Jalur Perpindahan Tugas',
                        'icon'  => 'fa-briefcase',
                        'bg'    => 'bg-amber-50',
                        'ico_c' => 'text-amber-600',
                        'border'=> 'border-amber-200',
                        'items' => [
                            'Akta Kelahiran (asli + fotokopi)',
                            'Kartu Keluarga (asli + fotokopi)',
                            'KTP Orang Tua/Wali (asli + fotokopi)',
                            'Surat Tugas/Mutasi Orang Tua (asli + fotokopi)',
                            'Surat Keterangan Domisili Baru',
                            'Pas foto 3×4 (4 lembar)',
                            'Formulir Pendaftaran (diisi di sekolah)',
                        ],
                    ],
                ];
                @endphp
                @foreach($docs as $idx => $d)
                <div class="doc-card p-6 border {{ $d['border'] }} fade-up" style="transition-delay: {{ $idx * 80 }}ms">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-11 h-11 {{ $d['bg'] }} rounded-2xl flex items-center justify-center">
                            <i class="fa {{ $d['icon'] }} {{ $d['ico_c'] }} text-lg"></i>
                        </div>
                        <h3 class="font-black text-gray-900 text-sm">{{ $d['jalur'] }}</h3>
                    </div>
                    <ul class="space-y-2.5">
                        @foreach($d['items'] as $item)
                        <li class="flex items-start gap-2">
                            <i class="fa fa-check-circle {{ $d['ico_c'] }} text-[11px] mt-0.5 flex-shrink-0"></i>
                            <span class="text-gray-600 text-xs leading-relaxed">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- TIPS & CATATAN --}}
    <section id="tips" class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Tips & Catatan Penting</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Hal-Hal yang Perlu Diperhatikan</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Agar proses pendaftaran berjalan lancar, perhatikan catatan-catatan penting berikut.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                $tips = [
                    ['color'=>'border-blue-400   bg-blue-50   text-blue-800',   'icon'=>'fa-circle-check text-blue-500',   'judul'=>'Datang Tepat Waktu',             'isi'=>'Panitia hanya melayani pendaftaran pada jam kerja Senin–Jumat, pukul 08.00–14.00 WIB. Tidak ada pelayanan di luar jam tersebut.'],
                    ['color'=>'border-green-400  bg-green-50  text-green-800',  'icon'=>'fa-circle-check text-green-500',  'judul'=>'Cek Kelengkapan Sebelum Berangkat','isi'=>'Pastikan semua dokumen sudah lengkap sebelum datang ke sekolah untuk menghindari bolak-balik yang membuang waktu.'],
                    ['color'=>'border-amber-400  bg-amber-50  text-amber-800',  'icon'=>'fa-triangle-exclamation text-amber-500', 'judul'=>'Waspada Pungutan Liar', 'isi'=>'Seluruh proses pendaftaran adalah GRATIS. Jika ada pihak yang meminta uang atas nama PPDB, segera laporkan kepada kepala sekolah.'],
                    ['color'=>'border-rose-400   bg-rose-50   text-rose-800',   'icon'=>'fa-triangle-exclamation text-rose-500',  'judul'=>'Satu Anak Satu Jalur',  'isi'=>'Setiap calon siswa hanya boleh mendaftar pada satu jalur penerimaan. Pendaftaran ganda akan didiskualifikasi.'],
                    ['color'=>'border-purple-400 bg-purple-50 text-purple-800', 'icon'=>'fa-circle-check text-purple-500', 'judul'=>'Daftar Ulang Tepat Waktu',        'isi'=>'Siswa yang diterima wajib daftar ulang pada 30 Jun–4 Jul 2025. Tidak daftar ulang = dianggap mengundurkan diri.'],
                    ['color'=>'border-teal-400   bg-teal-50   text-teal-800',   'icon'=>'fa-circle-check text-teal-500',   'judul'=>'Informasi Resmi',                 'isi'=>'Selalu pantau informasi resmi hanya melalui website sekolah dan papan pengumuman. Hindari informasi dari sumber tidak resmi.'],
                ];
                @endphp
                @foreach($tips as $idx => $t)
                @php $parts = explode(' ', $t['color']); @endphp
                <div class="tip-card {{ $parts[0] }} {{ $parts[1] }} fade-up" style="transition-delay: {{ $idx * 60 }}ms">
                    <div class="flex items-start gap-3">
                        <i class="fa {{ $t['icon'] }} text-base mt-0.5 flex-shrink-0"></i>
                        <div>
                            <p class="font-black {{ $parts[2] }} text-sm mb-1">{{ $t['judul'] }}</p>
                            <p class="{{ $parts[2] }} text-xs leading-relaxed opacity-80">{{ $t['isi'] }}</p>
                        </div>
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