<?php

use Coderflex\LaravelSendy\Facades\Sendy;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'laravel-sendy.api_key' => 'test_api_key',
        'laravel-sendy.api_url' => 'https://sendy.test/',
    ]);
});

it('can create a campaigns', function () {
    Http::fake([
        'https://sendy.test/api/campaigns/create.php' => Http::response(['status' => 'Campaign created'], 200),
    ]);

    $response = Sendy::campaigns()->create([
        'subject' => 'Test Subject',
        'from_name' => 'John Doe',
        'from_email' => 'john@example.com',
        'reply_to' => 'alex@example.com',
        'title' => 'Test Title',
        'plain_text' => 'This is a plain text version of the email.',
        'html_text' => '<h1>This is a HTML version of the email.</h1>',
        'list_ids' => 'abc123',
        'segment_ids' => 'xyz456',
        'exclude_list_ids' => null,
        'exclude_segment_ids' => null,
        'brand_id' => 'brand123',
        'query_string' => null,
        'track_opens' => 1,
        'track_clicks' => 1,
        'send_campaign' => 0,
        'schedule_date_time' => null,
        'schedule_timezone' => null,
    ]);

    expect($response->json())->toBe(['status' => 'Campaign created']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/api/campaigns/create.php' &&
               $request['from_email'] === 'john@example.com' &&
               $request['from_name'] === 'John Doe' &&
               $request['api_key'] === 'test_api_key';
    });
});

it('can create and send a campaigns', function () {
    Http::fake([
        'https://sendy.test/api/campaigns/create.php' => Http::response(['status' => 'Campaign created and now sending'], 200),
    ]);

    $response = Sendy::campaigns()->createAndSend([
        'subject' => 'Test Subject',
        'from_name' => 'John Doe',
        'from_email' => 'john@example.com',
        'reply_to' => 'alex@example.com',
        'title' => 'Test Title',
        'plain_text' => 'This is a plain text version of the email.',
        'html_text' => '<h1>This is a HTML version of the email.</h1>',
        'list_ids' => 'abc123',
        'segment_ids' => 'xyz456',
        'exclude_list_ids' => null,
        'exclude_segment_ids' => null,
        'brand_id' => 'brand123',
        'query_string' => null,
        'track_opens' => 1,
        'track_clicks' => 1,
        'schedule_date_time' => null,
        'schedule_timezone' => null,
    ]);

    expect($response->json())->toBe(['status' => 'Campaign created and now sending']);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sendy.test/api/campaigns/create.php' &&
               $request['from_email'] === 'john@example.com' &&
               $request['from_name'] === 'John Doe' &&
               $request['api_key'] === 'test_api_key';
    });
});
