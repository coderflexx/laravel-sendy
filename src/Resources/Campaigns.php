<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Campaigns\CampaignDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Campaigns
{
    public function create(array $data)
    {
        $data = CampaignDTO::validate($data);

        return LaravelSendy::post('/api/campaigns/create.php', $data);
    }
}
