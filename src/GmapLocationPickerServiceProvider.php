<?php

namespace Sadiq\GMapLocationPicker;

use Filament\PluginServiceProvider;

class GmapLocationPickerServiceProvider extends PluginServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/gmap-location-picker.php', 'gmap-location-picker');
    }

    public function boot()
    {
        $this->bootLoaders();
        $this->bootPublishing();
    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'gmap-location-picker');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'gmap-location-picker');
    }

    protected function bootPublishing()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/gmap-location-picker'),
        ], 'gmap-location-picker-lang');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/gmap-location-picker'),
        ], 'gmap-location-picker-views');

        $this->publishes(
            [__DIR__ . '/../config/gmap-location-picker.php' => config_path('gmap-location-picker.php')],
            'gmap-location-picker-config'
        );
    }
}
