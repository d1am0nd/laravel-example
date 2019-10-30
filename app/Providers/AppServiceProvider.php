<?php

namespace App\Providers;

use GuzzleHttp\{
    Client,
    RequestOptions,
};
use App\Actions\GetExchangeRates;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GetExchangeRates::class, function ($app) {
            return new GetExchangeRates(
                new Client([
                    'base_uri' => 'https://openexchangerates.org/api/',
                ]),
                config('services.open_exchange.app_id')            
            );
        });
    }
}
