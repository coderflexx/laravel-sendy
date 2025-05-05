<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Campaigns\CampaignDTO;
use Coderflex\LaravelSendy\Sendy;
use Illuminate\Http\Client\Response;

class Campaigns
{
    public function __construct(
        protected Sendy $sendy
    ) {}

    public function create(array $data, bool $async = false): Response
    {
        $data = CampaignDTO::validate($data);

        return $this->sendy->post('/api/campaigns/create.php', $data, $async);
    }

    public function createAndSend(array $data, bool $async = false): Response
    {
        $data = array_merge($data, [
            'send_compaign' => 1,
        ]);

        return $this->sendy->post('/api/campaigns/create.php', $data, $async);
    }
}
