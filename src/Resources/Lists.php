<?php

namespace Coderflex\LaravelSendy\Resources\Resources;

use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Lists
{
    /**
     * Get all lists for a specific brand.
     *
     * @return array
     */
    public function get(int $brandId, bool $includeHidden = false)
    {
        $params = http_build_query([
            'brand_id' => $brandId,
            'include_hidden' => $includeHidden,
        ]);

        return LaravelSendy::get('/api/lists/get-lists.php', $params);
    }
}
