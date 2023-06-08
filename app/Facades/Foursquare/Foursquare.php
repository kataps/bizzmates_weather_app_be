<?php

declare(strict_types=1);

namespace App\Facades\Foursquare;

use App\Facades\Foursquare\Abstracts\FoursquareAbstract;
use Illuminate\Http\Client\Response;

class Foursquare extends FoursquareAbstract
{
    private const API_ENDPOINT = 'https://api.foursquare.com/v3';
    private const JAPAN_COUNTRY_CODE = 'JP';
    private const HISTORIC_CATEGORY = 10035;

    public function searchCityHistoricPlaces(string $city, int $limit = 4): Response
    {
        $near = $city . ',' . self::JAPAN_COUNTRY_CODE;
        $uri = self::API_ENDPOINT . '/places/search';

        return $this->makeHttp()
            ->get($uri, [
                'categories' => self::HISTORIC_CATEGORY,
                'near' => $near,
                'limit' => $limit,
                'fields' => 'location,name,fsq_id',
            ]);
    }

    public function getPlacesPhoto(array $fsq_ids): array
    {
        $photo_urls = [];

        foreach($fsq_ids as $id) {
            $url = $this->getPhotoUrl($id);

            array_push($photo_urls, [
                'id' => $id,
                'url' => $url
            ]);
        }

        return $photo_urls;
    }

    public function getPhotoUrl(string $fsq_id, $width = 400, int $height = 230): string
    {
        $image_url = null;

        $response = $this->getPlacePhotoData($fsq_id);

        if ($response->ok()) {
            // get singular photo
            $result = $response->json();
            $photo_data = $result[0];
            $image_size = $width . 'x' . $height;
            $image_url  = $photo_data['prefix'] . $image_size . $photo_data['suffix'];
        }

        return $image_url;
    }

    // Note: fsq_id is based on the documentation
    public function getPlacePhotoData(string $fsq_id, int $limit = 1): Response
    {
        $url = sprintf(self::API_ENDPOINT . '/places/%s/photos',  $fsq_id);

        return self::makeHttp()
            ->get($url, [
                'limit' => $limit
            ]);
    }
}
