<?php

namespace Coderflex\LaravelSendy;

use Coderflex\LaravelSendy\Resources\Resources\Brands;
use Coderflex\LaravelSendy\Resources\Resources\Campaigns;
use Coderflex\LaravelSendy\Resources\Resources\Lists;
use Coderflex\LaravelSendy\Resources\Resources\Subscribers;

class LaravelSendy
{
    public function subscribers(): Subscribers
    {
        return new Subscribers;
    }

    public function lists(): Lists
    {
        return new Lists;
    }

    public function brands(): Brands
    {
        return new Brands;
    }

    public function campaigns(): Campaigns
    {
        return new Campaigns;
    }
}
