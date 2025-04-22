<?php

namespace Coderflex\LaravelSendy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Coderflex\LaravelSendy\LaravelSendy
 */
class LaravelSendy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Coderflex\LaravelSendy\LaravelSendy::class;
    }
}
