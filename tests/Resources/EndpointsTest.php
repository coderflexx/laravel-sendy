<?php

use Coderflex\LaravelSendy\Facades\LaravelSendy;
use Illuminate\Support\Facades\Http;

it('throw and exception if the api key not defined', function () {
    config([
        'laravel-sendy.api_key' => null,
        'laravel-sendy.api_url' => 'https://sendy.test',
    ]);

    Http::fake([
        'https://sendy.test/api/brands/get-brands.php' => Http::response(true, 200),
    ]);

    $response = LaravelSendy::brands()->get();

})->throws(\Coderflex\LaravelSendy\Exceptions\InvalidApiKeyException::class);

it('throw and exception if the api url not defined', function () {
    Http::fake([
        'https://sendy.test/api/brands/get-brands.php' => Http::response(true, 200),
    ]);

    config([
        'laravel-sendy.api_key' => 'test_api_key',
        'laravel-sendy.api_url' => null,
    ]);

    $response = LaravelSendy::brands()->get();

})->throws(\Coderflex\LaravelSendy\Exceptions\InvalidApiUrlException::class);
