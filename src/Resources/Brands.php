<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\Facades\LaravelSendy;
use Illuminate\Http\Client\Response;

class Brands
{
    public function get(): Response
    {
        return LaravelSendy::post('/api/brands/get-brands.php');
    }
}
