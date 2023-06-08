<?php

declare(strict_types=1);

namespace App\Providers;

use App\Facades\Foursquare\Foursquare;
use Illuminate\Support\ServiceProvider;

class FoursquareServiceProvider extends ServiceProvider
{
    public function register()
    {
        app()->bind('Foursquare', function () {
            return new Foursquare;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
