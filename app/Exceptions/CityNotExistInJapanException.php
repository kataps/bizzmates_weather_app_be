<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class CityNotExistInJapanException extends Exception
{
    private string $city;

    public function __construct(string $city)
    {
       $message = 'There is no such '. $city . ' city in Japan';
       parent::__construct($message);
       $this->city = $city;

       // Note: Please see The App/Exception/Handler as this is configured to render as JSON
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
