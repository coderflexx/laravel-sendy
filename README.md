# Laravel Sendy is a simple and clean wrapper for the Sendy API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/coderflexx/laravel-sendy.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-sendy)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/coderflexx/laravel-sendy/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/coderflexx/laravel-sendy/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/coderflexx/laravel-sendy/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/coderflexx/laravel-sendy/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/coderflexx/laravel-sendy.svg?style=flat-square)](https://packagist.org/packages/coderflexx/laravel-sendy)

---

Laravel Sendy is a simple and clean wrapper for the Sendy API, making it easy to manage subscribers, lists, and campaigns directly from your Laravel application.


## Installation

You can install the package via composer:

```bash
composer require coderflexx/laravel-sendy
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-sendy"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Sendy Installation URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to connect to your Sendy installation. It should
    | point to the root of your Sendy installation. For example:
    | https://your-sendy-installation.com
    */
    'sendy_installation_url' => env('SENDY_INSTALLATION_URL', 'https://your-sendy-installation.com'),

    /*
    |--------------------------------------------------------------------------
    | Sendy API Key
    |--------------------------------------------------------------------------
    |
    | This key is used to authenticate your application with the Sendy
    | installation. You can find your API key in the Sendy settings.
    | Make sure to keep this key secure and do not share it with anyone.
    | It is recommended to use environment variables to store sensitive
    | information like API keys. You can set the SENDY_API_KEY
    */
    'sendy_api_key' => env('SENDY_API_KEY', 'your-sendy-api-key'),
];
```

## API Keys
After Installation, you can grab your `API KEYS` from the sendy app installation, then add them in `.env` file

```env
SENDY_INSTALLATION_URL=https://your-app-installation.com/
SENDY_API_KEY=your-api-key
```

## Sendy Version
This package is compatible with __Sendy v6.1.2__ (Latest)

## Usage

In order to use the package, you can use the facade directly, followed by the main method api (e.g. `subscribers()` then the verb (action))

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$sendy = Sendy::{$service()}->{$action()}
```

### Async Argument for HTTP Requests

All HTTP requests support an `async` option, allowing you to __defer execution__. This is useful when a request doesn't need to run immediately or isn't a high priority. You can handle it later using await when you're ready to process the result.

Example:

```php
$promise = Sendy::subscribers()->subscribe(
    data: $data,
    async: true // The request is deferred and returns a promise
);

// perform other tasks/operation here

// later, wait for the response when you're ready.
$response = $promise->await();
```

### Subscribers
In order to create a create/delete a subscriber, you have to access the subscribers service first, then to the action

#### Subscribe a User

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'list' => '123',
    'country' => 'US',
];

$response = Sendy::subscribers()->subscribe(
            data: $data,
            async: false
        );
```

Full Documentation [Here](https://sendy.co/api#subscribe)

#### Unsubscribe a User

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
    'email' => 'john@example.com',
    'list' => '123',
    'boolean' => true, // to get plan text response, instead of json.
];

$response = Sendy::subscribers()->unsubscribe(
                data: $data,
                async: false
            );

```
Full Documentation [Here](https://sendy.co/api#unsubscribe)

#### Delete Subscriber

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
    'email' => 'john@example.com',
    'list_id' => '123',
];

$response = Sendy::subscribers()->delete(
                data: $data,
                async: false
            );

```

Full Documentation [Here](https://sendy.co/api#delete-subscriber)

#### Subscriber Status

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
    'email' => 'john@example.com',
    'list_id' => '123',
];

$response = Sendy::subscribers()->status(
                data: $data,
                async: false
            );

```

Full Documentation [Here](https://sendy.co/api#subscription-status)

#### Subscribers Count

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
    'email' => 'john@example.com',
    'list_id' => '123',
];

$response = Sendy::subscribers()->count(
                listId: '123',
                async: false
            );

```

Full Documentation [Here](https://sendy.co/api#active-subscriber-count)

### Lists

Same thing as the __subscribers__ service, you can access the `lists()` service, then the http action you want.

#### Get Lists

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
    'brand_id' => '123',
    'include_hidden' => 'yes', // either yes or no.
];

$response = Sendy::lists()->get(
                data: $data,
                async: false
            );

```
Full Documentation [Here](https://sendy.co/api#get-lists)

### Brands

__Laravel Sendy__ allows you to retrieve all the brand list you have by

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$response = Sendy::brands()->get();

```

Full Documentation [Here](https://sendy.co/api#get-brands)

### Create & Send Compaigns

```php
use Coderflex\LaravelSendy\Facades\Sendy;

$data = [
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
    'brand_id' => '123',
    'query_string' => null,
    'track_opens' => 1,
    'track_clicks' => 1,
    'send_campaign' => 1, // if set to 1 the compaign will be created & sent.
    'schedule_date_time' => null,
    'schedule_timezone' => null,
];

$response = Sendy::compaigns()->create(
                data: $data,
                async: false
            );

```

If you want to create and send the compaign at the same time, use `createAndSend` method

```php

$response = Sendy::compaigns()->createAndSend(
                data: $data,
                async: false
            );
```

Full Documentation [Here](https://sendy.co/api#create-send-campaigns)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Oussama Sid](https://github.com/ousid)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
