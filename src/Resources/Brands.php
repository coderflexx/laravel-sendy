<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\Sendy;
use Illuminate\Http\Client\Response;

class Brands
{
    public function __construct(
        protected Sendy $sendy
    ) {}

    public function get(): Response
    {
        return $this->sendy->post('/api/brands/get-brands.php');
    }
}
