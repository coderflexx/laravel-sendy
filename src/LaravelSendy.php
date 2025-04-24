<?php

namespace Coderflex\LaravelSendy;

use Coderflex\LaravelSendy\Resources\Resources\Brands;
use Coderflex\LaravelSendy\Resources\Resources\Campaigns;
use Coderflex\LaravelSendy\Resources\Resources\Lists;
use Coderflex\LaravelSendy\Resources\Resources\Subscribers;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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

    public function subscribers(): Subscribers
    {
        return new Subscribers;
    }

    public function lists(): Lists
    {
        return new Lists;
    }

    public function brands(): Brands
    {
        return new Brands;
    }

    public function campaigns(): Campaigns
    {
        return new Campaigns;
    }

    public function __call(string $function, array $args)
    {
        $options = ['get', 'post', 'put', 'delete', 'patch'];
        $path = (isset($args[0])) ? $args[0] : null;
        $data = (isset($args[1])) ? $args[1] : [];
        $headers = (isset($args[2])) ? $args[2] : [];

        if (! in_array($function, $options)) {
            throw new Exception("Method {$function} not found.");
        }

        return self::guzzle(
            type: $function,
            request: $path,
            data: $data,
            headers: $headers
        );
    }

    /**
     * @throws \Exception
     */
    protected function guzzle(string $type, string $request, array $data = [], array $headers = []): mixed
    {
        try {
            $client = new Client;

            $mainHeaders = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $headers = is_array($headers) && count($headers) > 0
                ? array_merge($mainHeaders, $headers)
                : $mainHeaders;

            $response = $client->{$type}($this->apiUrl.$request, [
                'headers' => $headers,
                'body' => json_encode(array_merge($data, [
                    'api_key' => $this->apiKey,
                ])),
            ]);

            $responseObject = $response->getBody()->getContents();

            return $this->isJson($responseObject)
                ? json_decode($responseObject, true)
                : $responseObject;

        } catch (ClientException $th) {
            throw new Exception('Error: '.$th->getMessage());
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
