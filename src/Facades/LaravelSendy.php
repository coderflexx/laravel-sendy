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
 */
class LaravelSendy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Coderflex\LaravelSendy\LaravelSendy::class;
    }
}
