<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Lists\ListsDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;
use Illuminate\Http\Client\Response;

class Lists
{
    public function get(array $data, bool $async = false): Response
    {
        $data = ListsDTO::validate($data);

        return LaravelSendy::post('/api/lists/get-lists.php', $data, $async);
    }
}
