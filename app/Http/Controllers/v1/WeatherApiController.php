<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1;

use App\Exceptions\CityNotExistInJapanException;
use App\Facades\FoursquareFacade;
use App\Facades\OpenWeatherFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherApiController extends Controller
{
    private const VALID_CITIES = [
        "Tokyo",
        "Yokohama",
        "Osaka",
        "Nagoya",
        "Sapporo",
        "Kobe",
        "Kyoto",
        "Fukuoka",
        "Kawasaki",
        "Hiroshima"
    ];

    public function historicSitesByCity(string $city): JsonResponse
    {
        $this->assertCityInJapan($city);

        $results = FoursquareFacade::searchCityHistoricPlaces($city)->json();

        return response()->json($results);
    }

    public function getPlacePhotoUrls(Request $request): JsonResponse
    {
        $request->validate([
            'fsq_ids' => 'required|array'
        ]);

        $photo_urls = FoursquareFacade::getPlacesPhoto($request->fsq_ids);

        return response()->json([
            'photo_urls' => $photo_urls
        ]);
    }

    public function weatherData(string $city): JsonResponse
    {
        $this->assertCityInJapan($city);

        $weather_data = OpenWeatherFacade::getWeatherForecast($city);

        return response()->json($weather_data);
    }

    private function assertCityInJapan($city): void
    {
        if (in_array($city, self::VALID_CITIES)) {
            // all good
        } else {
            throw new CityNotExistInJapanException($city);
        }
    }
}
