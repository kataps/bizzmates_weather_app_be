<?php

declare(strict_types=1);

namespace App\Providers;

use App\Facades\OpenWeather\OpenWeather;
use Illuminate\Support\ServiceProvider;

class OpenWeatherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('OpenWeather', function () {
            return new OpenWeather;
        });
    }

    public function boot()
    {
        //
    }
}
