<?php

namespace Coderflex\LaravelSendy\Resources\Resources;

use Coderflex\LaravelSendy\DTOs\SubscribersDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Subscribers
{
    public function subscribe(array $data)
    {
        $data = SubscribersDTO::from($data)->toArray();

        // validate the data

        return LaravelSendy::post('subscribe', $data);
    }

    public function unsubscribe(int $listId, string $email, bool $plainTextResponse)
    {
        $data = http_build_query([
            'list' => $listId,
            'email' => $email,
            'boolean' => $plainTextResponse,
        ]);

        return LaravelSendy::post('/api/subscribers/unsubscribe.php', $data);
    }

    public function delete(int $listId, string $email)
    {
        $data = http_build_query([
            'list_id' => $listId,
            'email' => $email,
        ]);

        return LaravelSendy::post('/api/subscribers/delete.php', $data);
    }

    public function status(int $listId, string $email)
    {
        $data = http_build_query([
            'list_id' => $listId,
            'email' => $email,
        ]);

        return LaravelSendy::post('/api/subscribers/subscription-status.php', $data);
    }

    public function count(int $listId)
    {
        $data = http_build_query([
            'list_id' => $listId,
        ]);

        return LaravelSendy::post('/api/subscribers/active-subscriber-count.php', $data);
    }
}
