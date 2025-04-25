<?php

namespace Coderflex\LaravelSendy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Coderflex\LaravelSendy\LaravelSendy
 *
 * @method static \Coderflex\LaravelSendy\Resources\Subscribers subscribers()
 * @method static \Coderflex\LaravelSendy\Resources\Lists lists()
 * @method static \Coderflex\LaravelSendy\Resources\Brands brands()
 * @method static \Coderflex\LaravelSendy\Resources\Campaigns campaigns()
 * @method static \Illuminate\Http\Client\Response get(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response post(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response put(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response delete(string $path, array $data = [], bool $async = false, array $headers = [])
 * @method static \Illuminate\Http\Client\Response patch(string $path, array $data = [], bool $async = false, array $headers = [])
 */
class LaravelSendy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Coderflex\LaravelSendy\LaravelSendy::class;
    }
}
