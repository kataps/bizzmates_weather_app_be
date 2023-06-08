<?php

declare(strict_types=1);

namespace App\Facades\Foursquare\Abstracts;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class FoursquareAbstract
{
    protected function makeHttp(): PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => env('FOURSQUARE_API_KEY'),
            'Accept' => 'application/json'
        ]);
    }
}
