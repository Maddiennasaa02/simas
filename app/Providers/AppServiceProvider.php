<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL; // <-- 1. WAJIB IMPORT INI
use App\Models\Sekolah;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Paksa HTTPS di Production agar tidak diblokir Browser (Mixed Content)
        if (config('app.env') === 'production' || env('RAILWAY_ENVIRONMENT')) {
            URL::forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.custom');
        Paginator::defaultSimpleView('vendor.pagination.simple-custom');

        // Share data sekolah ke semua view
        View::composer('*', function ($view) {
            $view->with('sekolah', Sekolah::first());
        });
    }
}