<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Brands
{
    public function get()
    {
        return LaravelSendy::get('/api/brands/get-brands.php');
    }
}
