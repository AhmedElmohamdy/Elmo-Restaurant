<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\AdminNotification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Sliders — available on all views
        View::composer('*', function ($view) {
            $view->with('sliders', Slider::all());
        });

        // Settings — available on all views
        View::composer('*', function ($view) {
            $view->with('setting', Setting::first());
        });

        // Admin Notifications — only on Admin views
        View::composer('*', function ($view) {
            $view->with('notifications', AdminNotification::orderBy('created_at', 'desc')->take(5)->get());
            $view->with('notifCount',    AdminNotification::where('is_read', false)->count());
        });
    }
}
