<?php

namespace Laracast\Preset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset 
{
    public static function install()
    {
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
        static::updateStyles();
    }

    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));
    }

    public static function updatePackageArray($packages)
    {
        return array_merge(['laravel-mix-tailwind' => '^0.1.0'], Arr::except($packages, [
            'popper.js'
        ]));
    }

    public static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    public static function updateScripts(){
        copy(__DIR__.'/stubs/bootstrap.js', base_path('resources/js/bootstrap.js'));
        copy(__DIR__.'/stubs/app.js', base_path('resources/js/app.js'));
    }

    public static function updateStyles(){
        File::put(resource_path('sass/app.scss'), '');
    }
}