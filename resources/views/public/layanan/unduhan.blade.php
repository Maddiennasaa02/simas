@extends('layouts.public')

@section('title', $pageTitle ?? 'Pusat Unduhan — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }
    .page-hero { background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%); position: relative; overflow: hidden; }
    .hero-pattern { position: absolute; inset: 0; opacity: .05; background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px; }
    .info-card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; transition: all .3s; }
    .info-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(29,78,216,.1); border-color: #bfdbfe; }
    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
</style>
@endpush

@section('content')
{{-- HERO SECTION --}}
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <nav class="flex items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Layanan</span>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Pusat Unduhan</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-blue-300 text-xs font-bold px-4 py-2 rounded-full uppercase tracking-widest mb-5">
                    <span class="w-1.5 h-1.5 bg-blue-300 rounded-full"></span> Dokumen Resmi
                </div>
                <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
                    Pusat<br><span style="color:#FDE68A;">Unduhan Digital</span>
                </h1>
                <p class="text-white/70 leading-relaxed max-w-xl">
                    Unduh berkas administrasi, formulir pendaftaran, dan dokumen penting lainnya secara mandiri dan cepat.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- CONTENT SECTION --}}
<main class="bg-gray-50 pb-24">
    <div class="max-w-5xl mx-auto px-6 -mt-10 relative z-20 mb-16 mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php
                $files = [
                    ['nama' => 'Formulir Pendaftaran Siswa Baru', 'format' => 'PDF', 'ukuran' => '1.2 MB', 'kategori' => 'PPDB', 'icon' => 'fa-file-pdf', 'color' => 'text-red-500'],
                    ['nama' => 'Surat Pernyataan Orang Tua', 'format' => 'DOCX', 'ukuran' => '450 KB', 'kategori' => 'Umum', 'icon' => 'fa-file-word', 'color' => 'text-blue-500'],
                    ['nama' => 'Tata Tertib Siswa 2025/2026', 'format' => 'PDF', 'ukuran' => '2.1 MB', 'kategori' => 'Akademik', 'icon' => 'fa-file-lines', 'color' => 'text-slate-600'],
                    ['nama' => 'Kalender Akademik Terbaru', 'format' => 'JPG', 'ukuran' => '3.5 MB', 'kategori' => 'Akademik', 'icon' => 'fa-image', 'color' => 'text-amber-500'],
                ];
            @endphp

            @foreach($files as $idx => $file)
            <div class="info-card p-5 flex items-center gap-4 fade-up shadow-sm shadow-blue-900/5" style="transition-delay:{{ $idx*60 }}ms">
                <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid {{ $file['icon'] }} {{ $file['color'] }} text-xl"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="text-[9px] font-extrabold text-blue-600 uppercase tracking-widest px-1.5 py-0.5 bg-blue-50 rounded">{{ $file['kategori'] }}</span>
                        <span class="text-[10px] text-slate-400 font-medium">{{ $file['ukuran'] }}</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-sm leading-tight">{{ $file['nama'] }}</h3>
                </div>
                <a href="#" class="w-10 h-10 bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-600 rounded-xl flex items-center justify-center transition-all">
                    <i class="fa fa-download text-sm"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
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