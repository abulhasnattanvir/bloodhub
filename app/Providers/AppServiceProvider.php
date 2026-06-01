<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tailwind pagination enable
        Paginator::useTailwind();

        // Global settings share
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
}