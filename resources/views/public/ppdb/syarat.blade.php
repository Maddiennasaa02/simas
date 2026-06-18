@extends('layouts.public')

@section('title', $pageTitle ?? 'Syarat Pendaftaran PPDB — SDN Sukorame 1')

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

    /* Tab */
    .tab-nav button {
        padding: 8px 20px; border-radius: 10px; font-size: 13px;
        font-weight: 700; cursor: pointer; border: 2px solid #e5e7eb;
        background: white; color: #6b7280; transition: all .2s;
        font-family: inherit;
    }
    .tab-nav button.active  { background: #1d4ed8; color: white; border-color: #1d4ed8; }
    .tab-nav button:hover:not(.active) { border-color: #1d4ed8; color: #1d4ed8; }
    .tab-pane { display: none; }
    .tab-pane.active { display: block; }

    /* Req item */
    .req-item {
        background: white; border: 1px solid #f1f5f9; border-radius: 16px;
        padding: 18px 20px; display: flex; gap: 16px; align-items: flex-start;
        transition: all .25s;
    }
    .req-item:hover { border-color: #bfdbfe; box-shadow: 0 8px 24px rgba(29,78,216,.08); transform: translateX(4px); }
    .req-num {
        width: 30px; height: 30px; border-radius: 50%;
        background: #1d4ed8; color: white;
        font-size: 12px; font-weight: 800;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;
    }

    .age-table th { background: #1e3a8a; color: white; padding: 12px 16px; text-align: left; font-size: 13px; }
    .age-table td { padding: 11px 16px; font-size: 13px; border-bottom: 1px solid #f3f4f6; background: white; }
    .age-table tr:last-child td { border-bottom: none; }
    .age-table tr:hover td { background: #eff6ff; }

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
            <a href="{{ route('ppdb.info') }}" class="hover:text-white transition-colors">PPDB</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Syarat Pendaftaran</span>
        </nav>

        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
            <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> PPDB 2025/2026
        </div>
        <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
            Syarat<br>
            <span style="color:#FDE68A;">Pendaftaran</span>
        </h1>
        <p class="text-white/70 leading-relaxed max-w-xl" style="font-size:1rem;">
            Persyaratan dokumen yang harus disiapkan calon peserta didik baru sebelum datang ke sekolah.
        </p>
        <div class="flex flex-wrap gap-3 mt-7">
            @foreach([
                ['#zonasi',   'fa-house',     'Jalur Zonasi'],
                ['#afirmasi', 'fa-heart',     'Jalur Afirmasi'],
                ['#pindahan', 'fa-briefcase', 'Perpindahan Tugas'],
                ['#usia',     'fa-calendar',  'Ketentuan Usia'],
            ] as $n)
            <a href="{{ $n[0] }}" onclick="switchTab('{{ ltrim($n[0],'#') }}')"
               class="inline-flex items-center gap-1.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full transition-all">
                <i class="fa {{ $n[1] }} text-amber-300 text-[10px]"></i> {{ $n[2] }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<main class="bg-gray-50">

    {{-- ALERT --}}
    <div class="bg-amber-50 border-b border-amber-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center gap-4">
            <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fa fa-triangle-exclamation text-white text-sm"></i>
            </div>
            <p class="text-amber-900 text-sm font-semibold">
                <span class="font-black">Perhatian!</span>
                Harap menyiapkan dokumen <span class="font-black">asli dan fotokopi</span> sebelum datang ke sekolah.
                Berkas tidak lengkap menyebabkan proses pendaftaran tidak dapat diproses.
            </p>
        </div>
    </div>

    {{-- KONTEN SYARAT --}}
    <section class="py-20">
        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-12 fade-up">
                <div class="sec-label">Dokumen Persyaratan</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Pilih Jalur Pendaftaran</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">
                    Pilih jalur yang sesuai kondisi Anda untuk melihat persyaratan yang dibutuhkan.
                </p>
            </div>

            {{-- TAB NAV --}}
            <div class="tab-nav flex flex-wrap gap-2 mb-10 fade-up">
                <button onclick="switchTab('zonasi')"   class="active"   id="btn-zonasi">🏡 Jalur Zonasi</button>
                <button onclick="switchTab('afirmasi')" id="btn-afirmasi">💚 Jalur Afirmasi</button>
                <button onclick="switchTab('pindahan')" id="btn-pindahan">🏢 Perpindahan Tugas</button>
                <button onclick="switchTab('usia')"     id="btn-usia">📊 Ketentuan Usia</button>
            </div>

            {{-- TAB: ZONASI --}}
            <div class="tab-pane active" id="pane-zonasi">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 mb-8">
                    <p class="text-blue-800 font-bold text-xs uppercase tracking-wider mb-1">📌 Tentang Jalur Zonasi</p>
                    <p class="text-blue-700 text-sm leading-relaxed">
                        Diperuntukkan bagi calon peserta didik yang berdomisili di wilayah zonasi sekolah.
                        Kuota jalur ini sebesar <strong>70% (42 siswa)</strong>. KK yang digunakan minimal telah diterbitkan 1 tahun.
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    @php
                    $syaratZonasi = [
                        ['Akta Kelahiran',         'Asli dan fotokopi Akta Kelahiran atau Surat Keterangan Lahir yang dikeluarkan oleh pejabat berwenang.',           true],
                        ['Kartu Keluarga (KK)',    'Fotokopi KK yang menunjukkan domisili sesuai zonasi. Minimal sudah 1 tahun diterbitkan.',                         true],
                        ['Pas Foto Terbaru',       'Pas foto berwarna ukuran 3×4 cm sebanyak 2 lembar dengan latar belakang merah.',                                  true],
                        ['KTP Orang Tua / Wali',   'Fotokopi KTP ayah atau ibu kandung, atau wali yang sah secara hukum.',                                            true],
                        ['Surat Keterangan Sehat', 'Surat keterangan sehat dari dokter atau Puskesmas setempat.',                                                     false],
                    ];
                    @endphp
                    @foreach($syaratZonasi as $idx => [$judul, $desc, $wajib])
                    <div class="req-item fade-up" style="transition-delay: {{ $idx * 60 }}ms">
                        <div class="req-num">{{ $idx + 1 }}</div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-3 flex-wrap">
                                <p class="font-bold text-gray-900 text-sm">{{ $judul }}</p>
                                <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full {{ $wajib ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $wajib ? 'Wajib' : 'Opsional' }}
                                </span>
                            </div>
                            <p class="text-gray-500 text-xs mt-1 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB: AFIRMASI --}}
            <div class="tab-pane" id="pane-afirmasi">
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5 mb-8">
                    <p class="text-green-800 font-bold text-xs uppercase tracking-wider mb-1">📌 Tentang Jalur Afirmasi</p>
                    <p class="text-green-700 text-sm leading-relaxed">
                        Diperuntukkan bagi peserta didik dari keluarga tidak mampu secara ekonomi (penerima KIP, PKH, atau yang terdata di DTKS).
                        Kuota jalur ini sebesar <strong>20% (12 siswa)</strong>.
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    @php
                    $syaratAfirmasi = [
                        ['Akta Kelahiran',                    'Asli dan fotokopi Akta Kelahiran atau Surat Keterangan Lahir.',                                                true],
                        ['Kartu Keluarga (KK)',               'Fotokopi Kartu Keluarga terbaru.',                                                                              true],
                        ['Kartu KIP / PKH',                   'Fotokopi Kartu Indonesia Pintar (KIP) atau Kartu PKH sebagai bukti keikutsertaan program perlindungan sosial.', true],
                        ['Surat Keterangan Tidak Mampu',      'SKTM dari Kelurahan/Desa jika tidak memiliki KIP/PKH. Berlaku sebagai alternatif bukti ketidakmampuan.',       false],
                        ['Pas Foto & KTP Orang Tua',          'Pas foto anak 3×4 cm (2 lembar) dan fotokopi KTP orang tua/wali.',                                              true],
                    ];
                    @endphp
                    @foreach($syaratAfirmasi as $idx => [$judul, $desc, $wajib])
                    <div class="req-item">
                        <div class="req-num" style="background:#16a34a;">{{ $idx + 1 }}</div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-3 flex-wrap">
                                <p class="font-bold text-gray-900 text-sm">{{ $judul }}</p>
                                <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full {{ $wajib ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $wajib ? 'Wajib' : 'Alternatif' }}
                                </span>
                            </div>
                            <p class="text-gray-500 text-xs mt-1 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB: PINDAHAN --}}
            <div class="tab-pane" id="pane-pindahan">
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 mb-8">
                    <p class="text-amber-800 font-bold text-xs uppercase tracking-wider mb-1">📌 Tentang Jalur Perpindahan Tugas</p>
                    <p class="text-amber-700 text-sm leading-relaxed">
                        Diperuntukkan bagi calon peserta didik yang orang tuanya pindah tugas ke wilayah Kota Kediri.
                        Anak guru yang bertugas di sekolah ini juga dapat didaftarkan melalui jalur ini.
                        Kuota <strong>10% (6 siswa)</strong>.
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    @php
                    $syaratPindahan = [
                        ['Surat Tugas / SK Mutasi',  'Surat keterangan tugas atau SK mutasi orang tua dari instansi/perusahaan, dikeluarkan paling lambat 1 tahun terakhir.', true],
                        ['Akta Kelahiran & KK',      'Fotokopi Akta Kelahiran dan Kartu Keluarga anak.',                                                                       true],
                        ['KTP Orang Tua & Pas Foto', 'Fotokopi KTP orang tua dan pas foto anak terbaru ukuran 3×4 cm (2 lembar).',                                             true],
                    ];
                    @endphp
                    @foreach($syaratPindahan as $idx => [$judul, $desc, $wajib])
                    <div class="req-item">
                        <div class="req-num" style="background:#d97706;">{{ $idx + 1 }}</div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-3 flex-wrap">
                                <p class="font-bold text-gray-900 text-sm">{{ $judul }}</p>
                                <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-red-100 text-red-700">Wajib</span>
                            </div>
                            <p class="text-gray-500 text-xs mt-1 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB: USIA --}}
            <div class="tab-pane" id="pane-usia">
                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-5 mb-8">
                    <p class="text-indigo-800 font-bold text-xs uppercase tracking-wider mb-1">📌 Ketentuan Usia per 1 Juli 2025</p>
                    <p class="text-indigo-700 text-sm leading-relaxed">
                        Usia calon peserta didik dihitung berdasarkan usia pada tanggal <strong>1 Juli 2025</strong>
                        sesuai Permendikbud yang berlaku.
                    </p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
                    <table class="age-table w-full border-collapse">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Ketentuan Usia</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-1 rounded-full">🟢 Diprioritaskan</span></td>
                                <td class="font-bold text-gray-900">7 tahun</td>
                                <td class="text-gray-500">Mendapat prioritas utama dalam proses seleksi</td>
                            </tr>
                            <tr>
                                <td><span class="inline-flex items-center gap-1.5 bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full">✅ Dapat Diterima</span></td>
                                <td class="font-bold text-gray-900">6 tahun</td>
                                <td class="text-gray-500">Wajib menyertakan rekomendasi psikolog atau ahli terkait</td>
                            </tr>
                            <tr>
                                <td><span class="inline-flex items-center gap-1.5 bg-amber-100 text-amber-800 text-xs font-bold px-2.5 py-1 rounded-full">⚠️ Pengecualian</span></td>
                                <td class="font-bold text-gray-900">5 thn 6 bln</td>
                                <td class="text-gray-500">Hanya anak berkebutuhan khusus/cerdas istimewa — wajib surat keterangan ahli</td>
                            </tr>
                            <tr>
                                <td><span class="inline-flex items-center gap-1.5 bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-full">❌ Tidak Diterima</span></td>
                                <td class="font-bold text-gray-900">Di bawah 5 thn 6 bln</td>
                                <td class="text-gray-500">Tidak memenuhi syarat usia minimal yang ditetapkan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Download formulir --}}
            <div class="mt-10 bg-white border border-gray-100 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 fade-up">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-file-arrow-down text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="font-black text-gray-900 text-sm">Formulir Pendaftaran PPDB 2025/2026</p>
                        <p class="text-gray-400 text-xs mt-0.5">Unduh formulir dalam format PDF sebelum datang ke sekolah.</p>
                    </div>
                </div>
                <a href="{{ route('layanan.unduhan') }}"
                   class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-colors whitespace-nowrap">
                    <i class="fa fa-download text-xs"></i> Unduh Formulir
                </a>
            </div>
        </div>
    </section>

    {{-- CTA BAND --}}
    <section class="cta-band py-16">
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 fade-up">
            <h2 class="font-display text-white font-black text-3xl md:text-4xl mb-4">Dokumen Sudah Siap?</h2>
            <p class="text-white/70 mb-8 max-w-lg mx-auto">
                Selanjutnya pelajari alur pendaftaran dan jadwal penerimaan agar tidak terlewat.
            </p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('ppdb.alur') }}"
                   class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black text-sm px-6 py-3 rounded-xl transition-all hover:-translate-y-0.5 hover:shadow-lg">
                    <i class="fa fa-arrow-right-long"></i> Lihat Alur Pendaftaran
                </a>
                <a href="{{ route('ppdb.jadwal') }}"
                   class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm px-6 py-3 rounded-xl transition-all">
                    <i class="fa fa-calendar-days"></i> Cek Jadwal
                </a>
            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
<script>
function switchTab(name) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-nav button').forEach(b => b.classList.remove('active'));
    document.getElementById('pane-' + name).classList.add('active');
    document.getElementById('btn-' + name).classList.add('active');
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