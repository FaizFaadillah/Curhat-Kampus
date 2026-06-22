<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Otomatis membuat jembatan (symlink) storage di server cloud jika belum ada
        if (!file_exists(public_path('storage'))) {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
        }
    }
}