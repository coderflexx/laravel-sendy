<?php

use Coderflex\LaravelSendy\Facades\LaravelSendy;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'laravel-sendy.api_key' => 'test_api_key',
        'laravel-sendy.api_url' => 'https://sendy.test/',
    ]);
});

it('can get subscriber brands', function () {
    Http::fake([
        'https://sendy.test/api/brands/get-brands.php' => Http::response([123 => 'Brand Name'], 200),
    ]);

    $response = LaravelSendy::brands()->get();

    expect($response->json())->toBe([123 => 'Brand Name']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/api/brands/get-brands.php' &&
               $request['api_key'] === 'test_api_key';
    });
});
