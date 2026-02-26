<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Yeh line Laravel ko batati hai ke hamesha HTTPS use kare
    if (app()->environment('production') || env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }
    }
    
}
