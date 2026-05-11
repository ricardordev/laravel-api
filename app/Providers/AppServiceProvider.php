<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        $perMinute = (int) env('API_RATE_LIMIT', 60);

        RateLimiter::for('api', function (Request $request) use ($perMinute) {
            return Limit::perMinute($perMinute)->by($request->user()?->id ?: $request->ip());
        });
    }
}
