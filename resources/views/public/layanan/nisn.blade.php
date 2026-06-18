@extends('layouts.public')

@section('title', $pageTitle ?? 'Layanan NISN — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }
    .page-hero { background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%); position: relative; overflow: hidden; }
    .hero-pattern { position: absolute; inset: 0; opacity: .05; background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px; }
    .sec-label { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: #1d4ed8; background: #eff6ff; border: 1px solid #bfdbfe; padding: 4px 14px; border-radius: 999px; margin-bottom: 12px; }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; }
    .section-divider { height: 1px; background: linear-gradient(90deg, transparent, #e5e7eb 30%, #e5e7eb 70%, transparent); }
    .card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; transition: all .3s; }
    .card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .cta-band { background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 50%, #1d4ed8 100%); position: relative; overflow: hidden; }
    .cta-band::before { content: ''; position: absolute; inset: 0; opacity: .04; background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px; }
    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    .nisn-digit { background: #1d4ed8; color: white; border-radius: 10px; width: 36px; height: 44px; display: inline-flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-weight: 900; font-size: 1.2rem; margin: 2px; }
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
            <span class="text-white/80">NISN</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Nomor Induk Siswa Nasional
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Layanan<br><span style="color:#FDE68A;">NISN Siswa</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl">
                    Pengecekan, penerbitan, dan perbaikan NISN (Nomor Induk Siswa Nasional) bagi seluruh siswa SDN Sukorame 1.
                </p>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-2xl p-6 text-center flex-shrink-0">
                <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-4">Contoh Format NISN</p>
                <div class="flex justify-center flex-wrap gap-1 mb-3">
                    @foreach(['0','1','2','3','4','5','6','7','8','9'] as $d)
                    <div class="nisn-digit">{{ $d }}</div>
                    @endforeach
                </div>
                <p class="text-white/50 text-[11px]">10 digit angka unik per siswa</p>
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">
    {{-- APA ITU NISN --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Tentang NISN</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Apa itu NISN?</h2>
                <p class="text-gray-500 text-sm max-w-2xl mx-auto">NISN adalah kode pengenal identitas siswa yang bersifat unik, standar, dan berlaku sepanjang masa bagi setiap peserta didik di Indonesia.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $facts=[
                    ['fa-fingerprint','bg-blue-50','text-blue-600','Unik & Permanen','Setiap siswa memiliki satu NISN yang tidak berubah sepanjang jenjang pendidikan.'],
                    ['fa-globe','bg-green-50','text-green-600','Berlaku Nasional','Dikeluarkan oleh Pusdatin Kemendikbudristek dan berlaku di seluruh Indonesia.'],
                    ['fa-id-card','bg-amber-50','text-amber-600','Identitas Resmi','Digunakan untuk berbagai keperluan administrasi pendidikan, beasiswa, dan SNPMB.'],
                    ['fa-10','bg-indigo-50','text-indigo-600','10 Digit Angka','Format NISN terdiri dari 10 angka yang unik untuk setiap siswa.'],
                ];
                @endphp
                @foreach($facts as $idx => $f)
                <div class="card p-6 fade-up" style="transition-delay:{{ $idx*70 }}ms">
                    <div class="w-11 h-11 {{ $f[1] }} rounded-2xl flex items-center justify-center mb-4"><i class="fa {{ $f[0] }} {{ $f[2] }} text-lg"></i></div>
                    <h3 class="font-black text-gray-900 text-sm mb-2">{{ $f[2+1] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $f[4] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- LAYANAN NISN --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Layanan yang Tersedia</div>
                <h2 class="font-display text-3xl font-black text-gray-900 mb-3">Jenis Layanan NISN</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-5">
                @php
                $layanan=[
                    ['fa-magnifying-glass','bg-blue-600','Cek / Verifikasi NISN','Pengecekan NISN siswa aktif yang sudah terdaftar di sistem Dapodik.','Nama lengkap siswa sesuai akta + Nomor Induk Siswa (NIS) sekolah','1 hari kerja'],
                    ['fa-plus-circle','bg-green-600','Penerbitan NISN Baru','Bagi siswa baru kelas I yang belum memiliki NISN. Proses dilakukan secara otomatis melalui Dapodik saat input data siswa baru.','Proses otomatis — tidak perlu permohonan khusus','Otomatis saat entry Dapodik'],
                    ['fa-pen-to-square','bg-amber-500','Perbaikan Data NISN','Perbaikan kesalahan penulisan nama, tanggal lahir, atau data lain pada NISN yang sudah ada.','Akta kelahiran asli + KK asli + surat permohonan orang tua','7–14 hari kerja (proses ke Pusdatin)'],
                ];
                @endphp
                @foreach($layanan as $idx => $l)
                <div class="card p-6 fade-up" style="transition-delay:{{ $idx*80 }}ms">
                    <div class="w-12 h-12 {{ $l[1] }} rounded-2xl flex items-center justify-center mb-4"><i class="fa {{ $l[0] }} text-white text-lg"></i></div>
                    <h3 class="font-black text-gray-900 text-sm mb-2">{{ $l[2] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed mb-4">{{ $l[3] }}</p>
                    <div class="border-t border-gray-100 pt-3 space-y-2">
                        <div class="flex items-start gap-2 text-xs"><i class="fa fa-folder-open text-gray-400 mt-0.5 flex-shrink-0"></i><span class="text-gray-600"><strong>Syarat:</strong> {{ $l[4] }}</span></div>
                        <div class="flex items-center gap-2 text-xs text-blue-700 font-semibold"><i class="fa fa-clock text-blue-400"></i>{{ $l[5] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- CEK MANDIRI --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Cek Mandiri</div>
                <h2 class="font-display text-3xl font-black text-gray-900 mb-3">Cara Cek NISN Secara Mandiri</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">Orang tua dan siswa dapat mengecek NISN secara mandiri melalui portal resmi Kemendikbudristek tanpa harus ke sekolah.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                @php
                $cara=[
                    ['fa-globe','bg-blue-50','text-blue-600','Melalui Website Resmi','Kunjungi <strong>nisn.data.kemdikbud.go.id</strong> → pilih menu "Pencarian" → masukkan nama siswa dan tanggal lahir → klik Cari.'],
                    ['fa-school','bg-green-50','text-green-600','Melalui Sekolah','Datang ke Ruang TU SDN Sukorame 1, sampaikan nama dan kelas siswa, petugas akan membantu pengecekan melalui sistem Dapodik.'],
                ];
                @endphp
                @foreach($cara as $idx => $c)
                <div class="card p-6 flex gap-4 fade-up" style="transition-delay:{{ $idx*80 }}ms">
                    <div class="w-12 h-12 {{ $c[1] }} rounded-2xl flex items-center justify-center flex-shrink-0"><i class="fa {{ $c[0] }} {{ $c[2] }} text-xl"></i></div>
                    <div>
                        <h3 class="font-black text-gray-900 text-sm mb-2">{{ $c[3] }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">{!! $c[4] !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-6 bg-blue-900 rounded-2xl p-6 flex flex-col sm:flex-row items-center gap-4 justify-between fade-up">
                <div>
                    <p class="text-white font-black text-sm mb-1">Portal Resmi NISN Kemendikbudristek</p>
                    <p class="text-white/60 text-xs">nisn.data.kemdikbud.go.id</p>
                </div>
                <a href="https://nisn.data.kemdikbud.go.id" target="_blank" class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-300 text-gray-900 font-black text-sm px-5 py-2.5 rounded-xl transition-all flex-shrink-0">
                    <i class="fa fa-arrow-up-right-from-square"></i> Buka Portal
                </a>
            </div>
        </div>
    </section>

    {{-- KONTAK --}}
    <section class="py-12 bg-white">
        <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach([['fa-phone','bg-blue-50','text-blue-600','Telepon TU','(0354) 123456'],['fa-clock','bg-amber-50','text-amber-600','Jam Layanan','Sen–Jum, 08.00–13.00'],['fa-location-dot','bg-red-50','text-red-500','Lokasi','Ruang TU, Lantai 1']] as $k)
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