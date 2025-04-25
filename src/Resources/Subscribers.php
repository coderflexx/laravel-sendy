<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Subscribers\DeleteSubscriberDTO;
use Coderflex\LaravelSendy\DTOs\Subscribers\SubscribeDTO;
use Coderflex\LaravelSendy\DTOs\Subscribers\SubscriberStatusDTO;
use Coderflex\LaravelSendy\DTOs\Subscribers\UnsubscribeDTO;
use Coderflex\LaravelSendy\Facades\LaravelSendy;

class Subscribers
{
    public function subscribe(array $data, bool $async = false)
    {
        $data = SubscribeDTO::validate($data);

        return LaravelSendy::post('subscribe', $data, $async);
    }

    public function unsubscribe(array $data, bool $async = false)
    {
        $data = UnsubscribeDTO::validate($data);

        return LaravelSendy::post('api/subscribers/unsubscribe.php', $data, $async);
    }

    public function delete(array $data, bool $async = false)
    {
        $data = DeleteSubscriberDTO::validate($data);

        return LaravelSendy::post('api/subscribers/delete.php', $data, $async);
    }

    public function status(array $data, bool $async = false)
    {
        $data = SubscriberStatusDTO::validate($data);

        return LaravelSendy::post('api/subscribers/subscription-status.php', $data, $async);
    }

    public function count(int $listId, bool $async = false)
    {
        $data = [
            'list_id' => $listId,
        ];

        return LaravelSendy::post('api/subscribers/subscriber-count.php', $data, $async);
    }
}
