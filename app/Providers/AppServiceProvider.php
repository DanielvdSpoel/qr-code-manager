<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use pxlrbt\FilamentEnvironmentIndicator\FilamentEnvironmentIndicator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {

            Filament::registerTheme(
                mix('css/filament.css'),
            );
        });

        FilamentEnvironmentIndicator::configureUsing(function (FilamentEnvironmentIndicator $indicator) {
            $indicator->visible = fn () => !App::environment('production');
        }, isImportant: true);
    }
}
