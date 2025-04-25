<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\CompaignDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Campaigns
{
    public function create(array $data)
    {
        $data = CompaignDTO::validate($data);

        return LaravelSendy::post('/api/campaigns/create.php', $data);
    }
}
