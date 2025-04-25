<?php

use Coderflex\LaravelSendy\Facades\LaravelSendy;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'laravel-sendy.api_key' => 'test_api_key',
        'laravel-sendy.api_url' => 'https://sendy.test/',
    ]);
});

it('can get subscriber lists', function () {
    Http::fake([
        'https://sendy.test/api/lists/get-lists.php' => Http::response([123 => 'Custom List'], 200),
    ]);

    $response = LaravelSendy::lists()->get([
        'brand_id' => 123,
        'include_hidden' => 'yes',
    ]);

    expect($response->json())->toBe([123 => 'Custom List']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/api/lists/get-lists.php' &&
               $request['brand_id'] === 123 &&
               $request['include_hidden'] === 'yes' &&
               $request['api_key'] === 'test_api_key';
    });
});
