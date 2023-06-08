# Bizmates Exam (Backend)

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