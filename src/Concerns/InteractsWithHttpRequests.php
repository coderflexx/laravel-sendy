<?php

namespace Coderflex\LaravelSendy\Concerns;

use Coderflex\LaravelSendy\Exceptions\InvalidApiKeyException;
use Coderflex\LaravelSendy\Exceptions\InvalidApiUrlException;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * @method static \Illuminate\Http\Client\Response get(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response post(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response put(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response delete(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response patch(string $path, array $data = [], bool $async = false, array $headers = [])
 */
trait InteractsWithHttpRequests
{
    public function __call(string $function, array $args): Response
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
            $apiKey = config('laravel-sendy.api_key');
            $apiUrl = config('laravel-sendy.api_url');

            throw_if(
                blank($apiKey),
                InvalidApiKeyException::class,
            );

            throw_if(
                blank($apiUrl),
                InvalidApiUrlException::class,
            );

            $payload = array_merge($data, [
                'api_key' => $apiKey,
            ]);

            $url = rtrim($apiUrl, '/').'/'.ltrim($request, '/');

            $client = Http::withHeaders(array_merge([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ], $headers));

            return $async
                ? $client->async()->{$type}($url, $payload)
                : $client->{$type}($url, $payload);

        } catch (InvalidApiKeyException $th) {
            throw new InvalidApiKeyException('Error: '.$th->getMessage());
        } catch (InvalidApiUrlException $th) {
            throw new InvalidApiUrlException('Error: '.$th->getMessage());
        } catch (Exception $th) {
            throw new Exception('Error: '.$th->getMessage());
        }
    }
}
