<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
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
        // See https://laravel.com/docs/11.x/eloquent#configuring-eloquent-strictness
        Model::preventLazyLoading();
        Model::preventSilentlyDiscardingAttributes();

        // See https://laraveldaily.com/post/filament-sign-in-with-google-using-laravel-socialite
        URL::forceScheme('https');

        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn (): string => Blade::render('<link rel="manifest" href="' . config('app.url') . '/manifest.json">'),
        );
    }
}
