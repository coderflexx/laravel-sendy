<?php

namespace Coderflex\LaravelSendy;

use Exception;
use Illuminate\Support\Facades\Http;

class LaravelSendy
{
    protected string $apiKey;

    protected string $apiUrl;

    public function __construct()
    {
        if (blank(config('laravel-sendy.api_key'))) {
            throw new Exception('API Key is not set in the config file.');
        }

        if (blank(config('laravel-sendy.api_url'))) {
            throw new Exception('API URL is not set in the config file.');
        }

        $this->apiKey = config('laravel-sendy.api_key');
        $this->apiUrl = config('laravel-sendy.api_url');
    }

    public function subscribers(): Resources\Subscribers
    {
        return new Resources\Subscribers;
    }

    public function lists(): Resources\Lists
    {
        return new Resources\Lists;
    }

    public function brands(): Resources\Brands
    {
        return new Resources\Brands;
    }

    public function campaigns(): Resources\Campaigns
    {
        return new Resources\Campaigns;
    }

    public function __call(string $function, array $args): mixed
    {
        $options = ['get', 'post', 'put', 'delete', 'patch'];
        $path = $args[0] ?? null;
        $data = $args[1] ?? [];
        $async = $args[2] ?? false;
        $headers = $args[3] ?? [];

        if (! in_array($function, $options)) {
            throw new Exception("Method {$function} not found.");
        }

        return self::sendRequest(
            type: $function,
            request: $path,
            data: $data,
            headers: $headers,
            async: $async
        );
    }

    /**
     * @throws \Exception
     */
    protected function sendRequest(string $type, string $request, array $data = [], array $headers = [], bool $async = false): mixed
    {
        try {
            $mainHeaders = array_merge([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ], $headers ?? []);

            $payload = array_merge($data, [
                'api_key' => $this->apiKey,
            ]);

            $url = rtrim($this->apiUrl, '/').'/'.ltrim($request, '/');

            $client = Http::withHeaders($headers);

            return $async
                ? $client->async()->{$type}($url, $payload)
                : $client->{$type}($url, $payload);

        } catch (Exception $th) {
            throw new Exception('Error: '.$th->getMessage());
        }
    }

    protected function isJson(string $string): bool
    {
        return is_array(json_decode($string)) &&
            (json_last_error() === JSON_ERROR_NONE);
    }
}
