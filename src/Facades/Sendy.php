<?php

namespace Coderflex\LaravelSendy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Coderflex\LaravelSendy\Sendy
 *
 * @method static \Coderflex\LaravelSendy\Resources\Subscribers subscribers()
 * @method static \Coderflex\LaravelSendy\Resources\Lists lists()
 * @method static \Coderflex\LaravelSendy\Resources\Brands brands()
 * @method static \Coderflex\LaravelSendy\Resources\Campaigns campaigns()
 */
class Sendy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Coderflex\LaravelSendy\Sendy::class;
    }
}
