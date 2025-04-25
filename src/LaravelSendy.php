<?php

namespace Coderflex\LaravelSendy;

use Coderflex\LaravelSendy\Concerns\InteractsWithHttpRequests;

class LaravelSendy
{
    use InteractsWithHttpRequests;

    public function subscribers(): Resources\Subscribers
    {
        return new Resources\Subscribers;
    }

    public function lists(): Resources\Lists
    {
        return new Resources\Lists;
    }

    public function brands(): Resources\Brands
    {
        return new Resources\Brands;
    }

    public function campaigns(): Resources\Campaigns
    {
        return new Resources\Campaigns;
    }
}
