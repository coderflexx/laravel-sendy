<?php

use Coderflex\LaravelSendy\Facades\LaravelSendy;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'laravel-sendy.api_key' => 'test_api_key',
        'laravel-sendy.api_url' => 'https://sendy.test/',
    ]);
});

it('can subscribe a user', function () {
    Http::fake([
        'https://sendy.test/subscribe' => Http::response(['success' => true], 200),
    ]);

    $response = LaravelSendy::subscribers()->subscribe([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'list' => 'abc123',
        'country' => 'UAE',
    ]);

    expect($response->json())->toBe(['success' => true]);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/subscribe' &&
               $request['email'] === 'john@example.com' &&
               $request['list'] === 'abc123' &&
               $request['api_key'] === 'test_api_key';
    });
});
