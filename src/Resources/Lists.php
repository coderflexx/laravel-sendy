<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Lists\ListsDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Lists
{
    /**
     * Get all lists for a specific brand.
     *
     * @return array
     */
    public function get(array $data, bool $async = false)
    {
        $data = ListsDTO::validate($data);

        return LaravelSendy::post('/api/lists/get-lists.php', $data, $async);
    }
}
