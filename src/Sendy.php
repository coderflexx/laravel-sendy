<?php

namespace Coderflex\LaravelSendy;

use Coderflex\LaravelSendy\Concerns\InteractsWithHttpRequests;

class Sendy
{
    use InteractsWithHttpRequests;

    public function subscribers(): Resources\Subscribers
    {
        return new Resources\Subscribers($this);
    }

    public function lists(): Resources\Lists
    {
        return new Resources\Lists($this);
    }

    public function brands(): Resources\Brands
    {
        return new Resources\Brands($this);
    }

    public function campaigns(): Resources\Campaigns
    {
        return new Resources\Campaigns($this);
    }
}
