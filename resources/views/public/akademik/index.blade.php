@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@include('public.partials.page-header', [
    'pageHeading'    => 'Berita Sekolah',
    'pageSubheading' => 'Informasi dan berita terbaru dari SD Negeri Sukorame 1',
    'breadcrumb'     => [
        ['label' => 'Berita', 'url' => route('berita.index')],
        ['label' => 'Semua Berita'],
    ],
])

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        @if(isset($berita) && $berita->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($berita as $idx => $p)
            <div class="hover-lift bg-white rounded-2xl overflow-hidden border border-gray-100">
                <div class="h-44 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                    <i class="fa fa-newspaper text-5xl text-red-300"></i>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-red-50 text-red-700">
                            {{ ucfirst($p->kategori ?? 'Berita') }}
                        </span>
                        <span class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($p->created_at)->locale('id')->isoFormat('D MMM Y') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 mb-2">{{ $p->judul }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($p->isi ?? $p->konten ?? ''), 120) }}
                    </p>
                    <a href="{{ route('berita.show', $p->id) }}" class="inline-flex items-center gap-1 text-red-700 text-xs font-semibold mt-3 hover:underline">
                        Selengkapnya <i class="fa fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $berita->links() }}
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-200">
            <i class="fa fa-newspaper text-gray-200 text-5xl mb-3 block"></i>
            <p class="text-gray-400 text-sm">Belum ada berita yang dipublikasikan.</p>
        </div>
        @endif

    </div>
</section>

@endsection