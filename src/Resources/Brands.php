<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\Facades\Sendy;

class Brands
{
    public function get()
    {
        return Sendy::post('/api/brands/get-brands.php');
    }
}
