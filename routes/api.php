<?php

declare(strict_types=1);

use App\Http\Controllers\v1\WeatherApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('/cities/{city}', [WeatherApiController::class, 'historicSitesByCity']);
    Route::get('/cities/{city}/weather', [WeatherApiController::class, 'weatherData']);

    // Note: For
    Route::post('/photos/venues',[WeatherApiController::class,'getPlacePhotoUrls']);
});
