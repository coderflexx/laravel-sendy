<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\SubscribersDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Subscribers
{
    public function subscribe(array $data, bool $async = false)
    {
        $data = SubscribersDTO::validateAndCreate($data)->toArray();

        return LaravelSendy::post('subscribe', $data, $async);
    }

    public function unsubscribe(int $listId, string $email, bool $plainTextResponse, bool $async = false)
    {
        $data = http_build_query([
            'list' => $listId,
            'email' => $email,
            'boolean' => $plainTextResponse,
        ]);

        return LaravelSendy::post('api/subscribers/unsubscribe.php', $data, $async);
    }

    public function delete(int $listId, string $email, bool $async = false)
    {
        $data = http_build_query([
            'list_id' => $listId,
            'email' => $email,
        ]);

        return LaravelSendy::post('api/subscribers/delete.php', $data, $async);
    }

    public function status(int $listId, string $email, bool $async = false)
    {
        $data = http_build_query([
            'list_id' => $listId,
            'email' => $email,
        ]);

        return LaravelSendy::post('api/subscribers/subscription-status.php', $data, $async);
    }

    public function count(int $listId, bool $async = false)
    {
        $data = http_build_query([
            'list_id' => $listId,
        ]);

        return LaravelSendy::post('api/subscribers/subscriber-count.php', $data, $async);
    }
}
