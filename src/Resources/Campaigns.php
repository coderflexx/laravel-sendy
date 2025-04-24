<?php

namespace Coderflex\LaravelSendy\Resources\Resources;

use Coderflex\LaravelSendy\DTOs\CompaignDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Campaigns
{
    public function create(array $data)
    {
        $data = CompaignDTO::validateAndCreate($data)->toArray();

        return LaravelSendy::post('/api/campaigns/create.php', $data);
    }
}
