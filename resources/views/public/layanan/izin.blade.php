@extends('layouts.public')

@section('title', $pageTitle ?? 'Layanan Izin Tidak Masuk — SDN Sukorame 1')

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
    .izin-tab { cursor: pointer; border-bottom: 3px solid transparent; padding: 10px 20px; font-weight: 700; font-size: 14px; color: #6b7280; transition: all .2s; }
    .izin-tab.active { border-color: #1d4ed8; color: #1d4ed8; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
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
            <span class="text-white/80">Izin Tidak Masuk</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-amber-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-amber-300 rounded-full"></span> Layanan Sekolah
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Layanan<br><span style="color:#FDE68A;">Izin Tidak Masuk</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl">
                    Prosedur pengajuan izin tidak masuk sekolah yang mudah dan jelas. Ketidakhadiran yang tidak dilaporkan akan tercatat sebagai alpha.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-3 flex-shrink-0">
                @foreach([['fa-hospital','text-rose-300','Sakit'],['fa-mosque','text-green-300','Keperluan'],['fa-file-medical','text-blue-300','Wajib Surat'],['fa-calendar-xmark','text-amber-300','Maks. 3 Hari']] as $s)
                <div class="bg-white/10 border border-white/20 rounded-2xl px-5 py-4 text-center">
                    <i class="fa {{ $s[0] }} {{ $s[1] }} text-xl mb-2 block"></i>
                    <p class="font-display text-white font-black text-sm leading-none">{{ $s[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<main class="bg-gray-50">
    {{-- JENIS IZIN --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Jenis Izin</div>
                <h2 class="font-display text-3xl md:text-4xl font-black text-gray-900 mb-3">Kategori Ketidakhadiran</h2>
                <p class="text-gray-500 text-sm max-w-xl mx-auto">Ketidakhadiran siswa dikategorikan menjadi tiga jenis. Masing-masing memiliki prosedur pelaporan berbeda.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-5">
                @php
                $jenis = [
                    ['fa-hospital','bg-rose-600','Sakit','Siswa tidak masuk karena kondisi kesehatan. Wajib menyerahkan surat keterangan dokter jika sakit lebih dari 2 hari berturut-turut.','Surat keterangan dokter (sakit >2 hari)','Tidak mempengaruhi nilai, namun tetap dicatat.'],
                    ['fa-calendar-check','bg-amber-500','Izin','Siswa tidak masuk karena keperluan tertentu seperti acara keluarga, keperluan keagamaan, atau perlombaan. Harus diajukan sebelumnya.','Surat izin dari orang tua/wali','Maksimal 3 hari per semester tanpa surat resmi instansi.'],
                    ['fa-ban','bg-gray-500','Alpha (Tanpa Keterangan)','Siswa tidak masuk tanpa alasan atau kabar apapun. Dikategorikan sebagai tidak hadir tanpa izin dan dapat mempengaruhi nilai sikap.','—','Lebih dari 15 hari alpha per semester dapat diproses sesuai aturan sekolah.'],
                ];
                @endphp
                @foreach($jenis as $idx => $j)
                <div class="card p-6 fade-up" style="transition-delay:{{ $idx*80 }}ms">
                    <div class="w-12 h-12 {{ $j[1] }} rounded-2xl flex items-center justify-center mb-4">
                        <i class="fa {{ $j[0] }} text-white text-lg"></i>
                    </div>
                    <h3 class="font-black text-gray-900 text-base mb-2">{{ $j[2] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed mb-4">{{ $j[3] }}</p>
                    <div class="space-y-2 border-t border-gray-100 pt-3">
                        <div class="flex items-start gap-2 text-xs"><i class="fa fa-file-alt text-blue-400 mt-0.5 flex-shrink-0"></i><span class="text-gray-600"><strong>Syarat:</strong> {{ $j[4] }}</span></div>
                        <div class="flex items-start gap-2 text-xs"><i class="fa fa-circle-info text-amber-400 mt-0.5 flex-shrink-0"></i><span class="text-gray-600">{{ $j[5] }}</span></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- CARA MELAPOR --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-10 fade-up">
                <div class="sec-label">Prosedur</div>
                <h2 class="font-display text-3xl font-black text-gray-900 mb-3">Cara Melaporkan Izin</h2>
            </div>
            {{-- Tab --}}
            <div class="border-b border-gray-200 flex gap-0 mb-8 fade-up">
                <button class="izin-tab active" data-tab="tab-sakit">Sakit</button>
                <button class="izin-tab" data-tab="tab-izin">Izin Keperluan</button>
            </div>
            <div id="tab-sakit" class="tab-content active">
                <div class="grid md:grid-cols-2 gap-5">
                    @php $stSakit=[['Hubungi wali kelas via telepon/WhatsApp pada hari pertama siswa sakit.','fa-phone'],['Sertakan foto surat keterangan dokter jika sakit lebih dari 2 hari.','fa-camera'],['Pada hari siswa masuk kembali, serahkan surat keterangan asli ke wali kelas.','fa-file-medical'],['Wali kelas mencatat dan merekap data kehadiran di buku absensi.','fa-book']]; @endphp
                    @foreach($stSakit as $idx => $s)
                    <div class="card p-5 flex items-start gap-4 fade-up" style="transition-delay:{{ $idx*60 }}ms">
                        <div class="w-9 h-9 bg-rose-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa {{ $s[1] }} text-white text-sm"></i></div>
                        <div><p class="text-gray-400 text-[11px] font-bold uppercase mb-1">Langkah {{ $idx+1 }}</p><p class="text-gray-700 text-sm leading-relaxed">{{ $s[0] }}</p></div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div id="tab-izin" class="tab-content">
                <div class="grid md:grid-cols-2 gap-5">
                    @php $stIzin=[['Orang tua/wali membuat surat izin tertulis yang menyebutkan alasan dan lama izin.','fa-pen'],['Serahkan surat izin ke wali kelas atau TU sehari sebelum tanggal izin jika memungkinkan.','fa-paper-plane'],['Untuk izin mendadak, hubungi wali kelas via telepon/WA pada pagi hari sebelum pukul 07.30.','fa-phone'],['Surat izin wajib diserahkan pada hari pertama siswa kembali ke sekolah.','fa-file-alt']]; @endphp
                    @foreach($stIzin as $idx => $s)
                    <div class="card p-5 flex items-start gap-4 fade-up" style="transition-delay:{{ $idx*60 }}ms">
                        <div class="w-9 h-9 bg-amber-500 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa {{ $s[1] }} text-white text-sm"></i></div>
                        <div><p class="text-gray-400 text-[11px] font-bold uppercase mb-1">Langkah {{ $idx+1 }}</p><p class="text-gray-700 text-sm leading-relaxed">{{ $s[0] }}</p></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    {{-- KETENTUAN --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-14 fade-up">
                <div class="sec-label">Ketentuan</div>
                <h2 class="font-display text-3xl font-black text-gray-900 mb-3">Ketentuan Kehadiran</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $kts=[
                    ['75%','bg-blue-600','Minimal Kehadiran','Siswa wajib hadir minimal 75% dari total hari efektif per semester untuk dapat mengikuti penilaian akhir.'],
                    ['≤3','bg-amber-500','Batas Izin Tanpa Surat','Maksimal 3 hari izin per semester tanpa surat resmi dari instansi (dokter/RT/instansi terkait).'],
                    ['>15','bg-rose-600','Alpha Kritis','Lebih dari 15 hari alpha per semester akan diproses sesuai peraturan sekolah yang berlaku.'],
                    ['100%','bg-green-600','Target Kehadiran','Sekolah mendorong kehadiran penuh setiap hari demi terjaganya kualitas belajar siswa.'],
                ];
                @endphp
                @foreach($kts as $idx => $k)
                <div class="card p-6 text-center fade-up" style="transition-delay:{{ $idx*70 }}ms">
                    <div class="w-14 h-14 {{ $k[1] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="font-display text-white font-black text-lg">{{ $k[0] }}</span>
                    </div>
                    <p class="font-black text-gray-900 text-sm mb-2">{{ $k[2] }}</p>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $k[3] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',function(){
    const obs=new IntersectionObserver(entries=>{entries.forEach((e,i)=>{if(e.isIntersecting){setTimeout(()=>e.target.classList.add('visible'),i*80);obs.unobserve(e.target);}});},{threshold:0.1});
    document.querySelectorAll('.fade-up').forEach(el=>obs.observe(el));
    document.querySelectorAll('.izin-tab').forEach(tab=>{
        tab.addEventListener('click',function(){
            document.querySelectorAll('.izin-tab').forEach(t=>t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c=>c.classList.remove('active'));
            this.classList.add('active');
            document.getElementById(this.dataset.tab).classList.add('active');
        });
    });
});
</script>
@endpush