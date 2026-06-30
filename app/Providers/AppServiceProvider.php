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
        $rate_limit = config('api.rate_limit', 60);

        RateLimiter::for('api', function (Request $request) use ($rate_limit) {
            return Limit::perMinute($rate_limit)->by($request->user()?->id ?: $request->ip());
        });
    }
}
