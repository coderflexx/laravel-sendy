<?php

use Coderflex\LaravelSendy\Facades\Sendy;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'laravel-sendy.api_key' => 'test_api_key',
        'laravel-sendy.api_url' => 'https://sendy.test/',
    ]);
});

it('can subscribe a user', function () {
    Http::fake([
        'https://sendy.test/subscribe' => Http::response(true, 200),
    ]);

    $response = Sendy::subscribers()->subscribe([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'list' => 'abc123',
        'country' => 'UAE',
    ]);

    expect($response->json())->toBe(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/subscribe' &&
               $request['email'] === 'john@example.com' &&
               $request['list'] === 'abc123' &&
               $request['api_key'] === 'test_api_key';
    });
});

it('can unsubscribe a user', function () {
    Http::fake([
        'https://sendy.test/api/subscribers/unsubscribe.php' => Http::response(true, 200),
    ]);

    $response = Sendy::subscribers()->unsubscribe([
        'list' => 123,
        'email' => 'jane@example.com',
        'boolean' => true,
    ]);

    expect($response->json())->toBe(1);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/api/subscribers/unsubscribe.php' &&
               $request['email'] === 'jane@example.com' &&
               $request['list'] === 123;
    });
});

it('can delete a subscriber', function () {
    Http::fake([
        'https://sendy.test/api/subscribers/delete.php' => Http::response(true, 200),
    ]);

    $response = Sendy::subscribers()->delete([
        'list_id' => 123,
        'email' => 'john@example.com',
    ]);

    expect($response->json())->toBe(1);

    Http::assertSent(fn ($request) => $request['email'] === 'john@example.com' &&
        $request['list_id'] === 123
    );
});

it('can get subscriber status', function () {
    Http::fake([
        'https://sendy.test/api/subscribers/subscription-status.php' => Http::response(['status' => 'Subscribed'], 200),
    ]);

    $response = Sendy::subscribers()->status([
        'list_id' => 123,
        'email' => 'john@example.com',
    ]);

    expect($response->json())->toBe(['status' => 'Subscribed']);
});

it('can get subscriber count', function () {
    Http::fake([
        'https://sendy.test/api/subscribers/subscriber-count.php' => Http::response(25, 200),
    ]);

    $response = Sendy::subscribers()->count(123);

    expect($response->json())->toBe(25);
});
