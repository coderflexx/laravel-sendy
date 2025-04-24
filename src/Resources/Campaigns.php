<?php

namespace Coderflex\LaravelSendy\Resources\Resources;

use Coderflex\LaravelSendy\DTOs\CompaignDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Campaigns
{
    public function create(array $data)
    {
        $data = CompaignDTO::from($data)->toArray();

        // validate the data
        // $this->validate($data);

        return LaravelSendy::post('/api/campaigns/create.php', $data);
    }
}
