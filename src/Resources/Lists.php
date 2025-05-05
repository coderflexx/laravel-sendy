<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Lists\ListsDTO;
use Coderflex\LaravelSendy\Sendy;
use Illuminate\Http\Client\Response;

class Lists
{
    public function __construct(
        protected Sendy $sendy
    ) {}

    public function get(array $data, bool $async = false): Response
    {
        $data = ListsDTO::validate($data);

        return $this->sendy->post('/api/lists/get-lists.php', $data, $async);
    }
}
