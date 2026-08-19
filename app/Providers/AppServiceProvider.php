<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

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
        if (!app()->runningInConsole()) {
            try {
                if (Schema::hasTable('site_settings')) {
                    View::composer(['pages.*', 'layouts.*'], function ($view) {
                        if (!$view->offsetExists('settings')) {
                            $settings = SiteSetting::all()->pluck('value', 'key');
                            $view->with('settings', $settings);
                        }
                    });
                }
            } catch (\Throwable $e) {
                // Ignore DB connection errors during initial bootstrap
            }
        }
    }
}
