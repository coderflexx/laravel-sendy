<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Campaigns\CampaignDTO;
use Coderflex\LaravelSendy\Facades\Sendy;

class Campaigns
{
    public function create(array $data, bool $async = false)
    {
        $data = CampaignDTO::validate($data);

        return Sendy::post('/api/campaigns/create.php', $data, $async);
    }

    public function createAndSend(array $data, bool $async = false)
    {
        $data = array_merge($data, [
            'send_compaign' => 1,
        ]);

        return Sendy::post('/api/campaigns/create.php', $data, $async);
    }
}
