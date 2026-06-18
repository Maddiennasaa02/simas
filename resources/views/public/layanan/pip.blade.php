@extends('layouts.public')

@section('title', $pageTitle ?? 'Program Indonesia Pintar (PIP) — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }
    .page-hero { background: linear-gradient(135deg, #14532d 0%, #166534 40%, #16a34a 75%, #4ade80 100%); position: relative; overflow: hidden; }
    .hero-pattern { position: absolute; inset: 0; opacity: .05; background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px; }
    .sec-label { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: #166534; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 4px 14px; border-radius: 999px; margin-bottom: 12px; }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #16a34a; border-radius: 50%; }
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); }
    .card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; transition: all .3s; }
    .card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(22,101,52,.1); border-color: #bbf7d0; }
    .cta-band { background: linear-gradient(135deg, #14532d 0%, #166534 50%, #16a34a 100%); position: relative; overflow: hidden; }
    .cta-band::before { content: ''; position: absolute; inset: 0; opacity: .04; background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px; }
    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    .nominal-badge { background: linear-gradient(135deg, #166534, #16a34a); color: white; border-radius: 16px; padding: 4px 14px; font-weight: 900; font-size: 0.85rem; display: inline-block; }
</style>
@endpush

@section('content')
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Layanan</span>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">PIP</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-yellow-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-yellow-300 rounded-full"></span> Bantuan Pemerintah
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Program<br><span style="color:#FEF08A;">Indonesia Pintar</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl">
                    PIP adalah bantuan tunai pendidikan dari pemerintah untuk siswa dari keluarga kurang mampu agar dapat terus bersekolah dan tidak putus pendidikan.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-3 flex-shrink-0">
                @foreach([['Rp 450rb','fa-money-bill-wave','text-yellow-300','Per Tahun SD'],['KIP','fa-id-card','text-green-300','Kartu Indonesia Pintar'],['Gratis','fa-circle-check','text-white','Tanpa Syarat Biaya'],['Prioritas','fa-heart','text-rose-300','Keluarga Kurang Mampu']] as $s)
                <div class="bg-white/10 border border-white/20 rounded-2xl px-5 py-4 text-center">
                    <i class="fa {{ $s[1] }} {{ $s[2] }} text-xl mb-2 block"></i>
                    <p class="font-display text-white font-black text-sm leading-none">{{ $s[0] }}</p>
                    <p class="text-white/60 text-[10px] mt-1">{{ $s[3] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">
    {{-- APA ITU PIP --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Tentang PIP</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Apa itu Program Indonesia Pintar?</h2>
                <p class="text-gray-500 text-sm max-w-2xl mx-auto">PIP dirancang untuk membantu anak-anak dari keluarga miskin/rentan miskin agar mendapatkan layanan pendidikan sampai tamat satuan pendidikan menengah.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $infos=[
                    ['fa-hand-holding-dollar','bg-green-50','text-green-600','Bantuan Tunai','Dana diberikan langsung ke rekening siswa/orang tua melalui bank penyalur yang ditunjuk pemerintah.'],
                    ['fa-school','bg-blue-50','text-blue-600','Untuk Siswa SD','Siswa SD/MI usia 6–12 tahun dari keluarga kurang mampu berhak mendapatkan bantuan PIP.'],
                    ['fa-calendar-year','bg-amber-50','text-amber-600','Penyaluran Per Tahun','Bantuan disalurkan dalam dua tahap per tahun sesuai jadwal yang ditetapkan Kemendikbudristek.'],
                    ['fa-book-reader','bg-indigo-50','text-indigo-600','Tujuan Penggunaan','Dana PIP digunakan untuk kebutuhan pendidikan: seragam, alat tulis, transport, dan biaya pendidikan lainnya.'],
                ];
                @endphp
                @foreach($infos as $idx => $i)
                <div class="card p-6 fade-up" style="transition-delay:{{ $idx*70 }}ms">
                    <div class="w-11 h-11 {{ $i[1] }} rounded-2xl flex items-center justify-center mb-4"><i class="fa {{ $i[0] }} {{ $i[2] }} text-lg"></i></div>
                    <h3 class="font-black text-gray-900 text-sm mb-2">{{ $i[3] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $i[4] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- BESARAN & KRITERIA --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-10">
                {{-- Besaran --}}
                <div class="fade-up">
                    <div class="sec-label">Besaran Bantuan</div>
                    <h2 class="font-display text-2xl font-black text-gray-900 mb-6">Nominal PIP Jenjang SD</h2>
                    <div class="space-y-4">
                        @php
                        $nominals=[
                            ['Kelas I – II (Baru Masuk)','Rp 450.000','per tahun','Diterima di awal tahun pelajaran','bg-green-600'],
                            ['Kelas III – V (Aktif)','Rp 450.000','per tahun','Disalurkan dalam 2 tahap','bg-blue-600'],
                            ['Kelas VI (Akan Lulus)','Rp 225.000','per tahun','Diterima di semester ganjil','bg-amber-500'],
                        ];
                        @endphp
                        @foreach($nominals as $n)
                        <div class="card p-5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-10 {{ $n[4] }} rounded-full"></div>
                                <div>
                                    <p class="font-black text-gray-900 text-sm">{{ $n[0] }}</p>
                                    <p class="text-gray-400 text-xs">{{ $n[3] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-display font-black text-green-700 text-lg leading-none">{{ $n[1] }}</p>
                                <p class="text-gray-400 text-[11px]">{{ $n[2] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- Kriteria --}}
                <div class="fade-up" style="transition-delay:100ms">
                    <div class="sec-label">Kriteria Penerima</div>
                    <h2 class="font-display text-2xl font-black text-gray-900 mb-6">Siapa yang Berhak?</h2>
                    <div class="card p-6">
                        <ul class="space-y-3">
                            @php
                            $krits=[
                                ['fa-id-card text-green-500','Terdaftar sebagai penerima KIP (Kartu Indonesia Pintar)'],
                                ['fa-file-invoice-dollar text-green-500','Berasal dari keluarga penerima PKH (Program Keluarga Harapan)'],
                                ['fa-list-check text-green-500','Terdaftar dalam DTKS (Data Terpadu Kesejahteraan Sosial) Kemensos'],
                                ['fa-home text-green-500','Berasal dari panti asuhan / rumah singgah'],
                                ['fa-user-injured text-green-500','Siswa penyandang disabilitas dari keluarga kurang mampu'],
                                ['fa-fire text-amber-500','Terdampak bencana alam / mengalami kondisi darurat yang berdampak pada kemampuan ekonomi keluarga'],
                                ['fa-school-flag text-blue-500','Diusulkan langsung oleh kepala sekolah berdasarkan pertimbangan khusus'],
                            ];
                            @endphp
                            @foreach($krits as $k)
                            <li class="flex items-start gap-3 text-sm">
                                <i class="fa {{ $k[0] }} mt-0.5 flex-shrink-0"></i>
                                <span class="text-gray-700 text-xs leading-relaxed">{{ $k[1] }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- ALUR PENGAJUAN --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Prosedur</div>
                <h2 class="font-display text-3xl font-black text-gray-900 mb-3">Cara Mengajukan PIP</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">Pengajuan PIP dilakukan melalui sekolah. Orang tua tidak perlu mengajukan langsung ke dinas atau pemerintah.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $alur=[
                    ['1','fa-comments','bg-green-600','Lapor ke Sekolah','Orang tua/wali melaporkan kondisi ekonomi ke wali kelas atau TU sekolah disertai dokumen pendukung.'],
                    ['2','fa-file-pen','bg-blue-600','Pengisian Dapodik','Sekolah memasukkan data calon penerima PIP ke dalam sistem Dapodik berdasarkan usulan.'],
                    ['3','fa-paper-plane','bg-amber-500','Verifikasi Dinas','Data diverifikasi oleh Dinas Pendidikan Kota Kediri sebelum ditetapkan sebagai penerima.'],
                    ['4','fa-money-bill-transfer','bg-indigo-600','Pencairan Dana','Penerima yang ditetapkan akan menerima notifikasi dan dapat mencairkan dana di bank penyalur.'],
                ];
                @endphp
                @foreach($alur as $idx => $a)
                <div class="card p-6 text-center fade-up" style="transition-delay:{{ $idx*70 }}ms">
                    <div class="w-12 h-12 {{ $a[2] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fa {{ $a[1] }} text-white text-lg"></i>
                    </div>
                    <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="font-display font-black text-gray-500 text-xs">{{ $a[0] }}</span>
                    </div>
                    <h3 class="font-black text-gray-900 text-sm mb-2">{{ $a[3] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $a[4] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CEK STATUS --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-green-900 rounded-2xl p-7 flex flex-col md:flex-row items-center justify-between gap-6 fade-up">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fa fa-magnifying-glass-dollar text-yellow-300 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-white font-black text-base mb-1">Cek Status PIP Secara Mandiri</p>
                        <p class="text-white/60 text-xs leading-relaxed max-w-md">Orang tua dapat mengecek apakah anak terdaftar sebagai penerima PIP melalui portal resmi Kemendikbudristek.</p>
                    </div>
                </div>
                <a href="https://pip.kemdikbud.go.id" target="_blank" class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-black text-sm px-5 py-3 rounded-xl transition-all flex-shrink-0">
                    <i class="fa fa-arrow-up-right-from-square"></i> pip.kemdikbud.go.id
                </a>
            </div>
        </div>
    </section>

    {{-- KONTAK --}}
    <section class="py-10 bg-white">
        <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([['fa-phone','bg-blue-50','text-blue-600','Telepon TU','(0354) 123456'],['fa-clock','bg-amber-50','text-amber-600','Jam Layanan','Sen–Jum, 08.00–13.00'],['fa-location-dot','bg-green-50','text-green-600','Lokasi','Ruang TU, Lantai 1']] as $k)
            <div class="card p-5 flex items-center gap-4 fade-up">
                <div class="w-11 h-11 {{ $k[1] }} rounded-2xl flex items-center justify-center flex-shrink-0"><i class="fa {{ $k[0] }} {{ $k[2] }} text-lg"></i></div>
                <div><p class="text-gray-400 text-[11px] font-semibold uppercase tracking-wider">{{ $k[3] }}</p><p class="text-gray-900 font-bold text-sm">{{ $k[4] }}</p></div>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',function(){
    const obs=new IntersectionObserver(entries=>{entries.forEach((e,i)=>{if(e.isIntersecting){setTimeout(()=>e.target.classList.add('visible'),i*80);obs.unobserve(e.target);}});},{threshold:0.1});
    document.querySelectorAll('.fade-up').forEach(el=>obs.observe(el));
});
</script>
@endpush