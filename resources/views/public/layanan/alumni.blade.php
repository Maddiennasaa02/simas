@extends('layouts.public')

@section('title', $pageTitle ?? 'Ruang Alumni — SDN Sukorame 1')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .font-display { font-family: 'Playfair Display', serif; }
    .page-hero { background: linear-gradient(135deg, #0c1445 0%, #1e3a8a 45%, #1d4ed8 75%, #3b82f6 100%); position: relative; overflow: hidden; }
    .hero-pattern { position: absolute; inset: 0; opacity: .05; background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px; }
    .sec-label { display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: #1d4ed8; background: #eff6ff; border: 1px solid #bfdbfe; padding: 4px 14px; border-radius: 999px; margin-bottom: 12px; }
    .sec-label::before { content: ''; width: 6px; height: 6px; background: #1d4ed8; border-radius: 50%; }
    .info-card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; transition: all .3s; }
    .fade-up { opacity: 0; transform: translateY(18px); transition: opacity .45s ease, transform .45s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }
    .form-input { width: 100%; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 0.875rem; transition: all 0.2s; }
    .form-input:focus { background: white; border-color: #3b82f6; ring: 4px rgba(59, 130, 246, 0.1); }
</style>
@endpush

@section('content')
<div class="page-hero py-20">
    <div class="hero-pattern"></div>
    <div class="max-w-5xl mx-auto px-6 relative z-10 text-center">
        <nav class="flex justify-center items-center gap-2 text-white/50 text-xs mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Layanan</span>
            <i class="fa fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Ruang Alumni</span>
        </nav>
        <h1 class="font-display text-white font-black leading-tight mb-4" style="font-size: clamp(2.2rem, 5vw, 3.8rem);">
            Ruang <span style="color:#FDE68A;">Alumni</span>
        </h1>
        <p class="text-white/70 leading-relaxed max-w-xl mx-auto">
            Wadah silaturahmi dan kontribusi para lulusan SDN Sukorame 1. Mari tetap terhubung untuk masa depan almamater yang lebih baik.
        </p>
    </div>
</div>

<main class="bg-gray-50 py-16">
    <div class="max-w-5xl mx-auto px-6 -mt-24 relative z-30">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Statistik/Sidebar --}}
            <div class="lg:col-span-1 space-y-6 fade-up">
                <div class="info-card p-6 shadow-xl shadow-blue-900/5">
                    <h3 class="font-display text-lg font-black text-gray-900 mb-4">Statistik Alumni</h3>
                    <div class="space-y-4">
                        @foreach([['Melanjutkan SMPN','88%','bg-blue-600'],['Lanjut Swasta/MTS','12%','bg-amber-400']] as $st)
                        <div>
                            <div class="flex justify-between text-[11px] font-bold text-gray-500 uppercase mb-1.5">
                                <span>{{ $st[0] }}</span>
                                <span>{{ $st[1] }}</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="{{ $st[2] }} h-full" style="width: {{ $st[1] }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-blue-600 rounded-3xl p-6 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="font-bold mb-2">Punya Info Alumni?</h4>
                        <p class="text-xs text-blue-100 leading-relaxed mb-4">Bantu kami memperluas jaringan dengan memberikan informasi kegiatan alumni.</p>
                        <a href="#" class="inline-flex items-center gap-2 bg-white text-blue-600 px-4 py-2 rounded-xl text-xs font-bold">Hubungi Admin <i class="fa fa-arrow-right"></i></a>
                    </div>
                    <i class="fa fa-users absolute -bottom-4 -right-4 text-7xl opacity-10"></i>
                </div>
            </div>

            {{-- Form Penelusuran --}}
            <div class="lg:col-span-2 fade-up" style="transition-delay: 100ms">
                <div class="bg-white border border-slate-200 p-8 md:p-10 rounded-[32px] shadow-xl shadow-blue-900/5">
                    <div class="sec-label">Database Alumni</div>
                    <h2 class="font-display text-2xl font-black text-gray-900 mb-3">Penelusuran Alumni (Tracer Study)</h2>
                    <p class="text-gray-500 text-sm mb-8 leading-relaxed">Mohon bantu sekolah dengan mengisi data terkini Anda untuk pemetaan kualitas lulusan kami.</p>

                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Nama Lengkap</label>
                                <input type="text" class="form-input py-3 px-4" placeholder="Sesuai Ijazah">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Tahun Lulus</label>
                                <select class="form-input py-3 px-4">
                                    @for($y=date('Y'); $y>=2010; $y--)
                                        <option>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Pendidikan/Aktivitas Sekarang</label>
                            <input type="text" class="form-input py-3 px-4" placeholder="Contoh: Siswa SMPN 1 Kediri">
                        </div>
                        <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-slate-200">
                            Simpan Data Alumni
                        </button>
                    </form>
                </div>
            </div>
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