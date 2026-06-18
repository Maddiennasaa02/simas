{{-- resources/views/public/partials/page-header.blade.php --}}
<div class="bg-gradient-to-r from-red-800 to-red-700 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <nav class="text-xs text-white/60 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            @isset($breadcrumb)
                @foreach ($breadcrumb as $crumb)
                <i class="fa fa-chevron-right text-[10px]"></i>
                @if ($loop->last)
                    <span class="text-white">{{ $crumb['label'] }}</span>
                @else
                    <a href="{{ $crumb['url'] }}" class="hover:text-white transition-colors">{{ $crumb['label'] }}</a>
                @endif
                @endforeach
            @endisset
        </nav>
        <h1 class="text-2xl md:text-3xl font-black">{{ $pageHeading ?? $pageTitle ?? 'Halaman' }}</h1>
        @isset($pageSubheading)
        <p class="text-white/75 text-sm mt-2">{{ $pageSubheading }}</p>
        @endisset
    </div>
</div>