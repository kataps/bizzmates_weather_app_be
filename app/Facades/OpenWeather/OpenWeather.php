<?php

declare(strict_types=1);

namespace App\Facades\OpenWeather;

use Illuminate\Support\Facades\Http;

class OpenWeather
{
    private const API_FORECAST_ENDPOINT = 'https://api.openweathermap.org/data/2.5/forecast';

    public function getWeatherForecast(string $city, string $unit = 'metric', $country_code = 'JP'): array
    {
        $response = Http::get(self::API_FORECAST_ENDPOINT, [
            'q' => $city . ',' . $country_code, // eg. Tokoy, JP
            'appid' => env('OPEN_WEATHER_APP_KEY'),
            'units' => $unit, // if metric, its based on celcius
            'cnt' => 3 // count of forecast data to fetch
        ]);

        return $response->json();
    }
}
