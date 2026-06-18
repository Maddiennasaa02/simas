{{--
    ========================================================
    TEMPLATE HALAMAN PLACEHOLDER
    Salin file ini dan sesuaikan untuk setiap halaman baru.
    ========================================================
--}}
@extends('layouts.public')

@section('title', $pageTitle)

@section('content')

@include('public.partials.page-header')

<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center py-20 text-gray-400">
            <i class="fa fa-file-alt text-5xl mb-4 block opacity-30"></i>
            <p class="font-semibold text-gray-500">Konten halaman ini sedang dalam pengembangan.</p>
            <a href="{{ route('home') }}" class="mt-4 inline-flex items-center gap-2 bg-red-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-red-800 transition-colors">
                <i class="fa fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection