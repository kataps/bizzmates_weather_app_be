### Details
This will act as REST-ful for weather Application.
its contains 3 endpoints that renders the response as `JSON` format.
each endpoints has it's own validation.

* `/cities/{city}` gives the historic places/venue within the city.
* `/cities/{city}/weather` provides the weather information.
* `/photos/venues` returns photos of provided venues.

The code follows the PHP Standard Recommendation and some of SOLID principles. I used Facade Design pattern since all the data is came from External Services, It is easy to call each service anywhere.
I wanted to use Repository Design Pattern which more likely supports SOLID principles but I concedered the 16 hrs max time.

I created a facade for each service. It's Dynamic, which allows the developer to add functionalities in the future development.
Facades are located in: `App\Facades`.

The has custom Exception  `CityNotExistInJapanException` thats when triggred, it will render the error as JSON format and it can be use in future development such us 
assertions in jobs/background task.

### setup
```
composer install
mv .env.example .env
```
### Put your API keys for Foresquare and OpenWeather in .env
```
OPEN_WEATHER_APP_KEY= <key>
FOURSQUARE_API_KEY= <key>
```

### clear caches and start your server
```
php artisan optimize:clear
php artisan server --host <your-private-ip> --port <preferred port>

# imporant: The ip and port should be also configured in front-end (.env file)
```
