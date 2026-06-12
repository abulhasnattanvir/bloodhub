<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Tailwind pagination enable
        Paginator::useTailwind();

        // Global settings share (SAFE)
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            view()->share('setting', $setting);
        }

        View::composer('layouts.frontend*', function ($view) {

            $menus = Menu::with('children')
                ->whereNull('parent_id')
                ->where('status', 1)
                ->orderBy('sort_order')
                ->get();

            $view->with('menus', $menus);
        });
    }


}