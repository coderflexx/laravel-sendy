<?php

namespace Coderflex\LaravelSendy\Resources;

use Coderflex\LaravelSendy\DTOs\Subscribers\DeleteSubscriberDTO;
use Coderflex\LaravelSendy\DTOs\Subscribers\SubscribeDTO;
use Coderflex\LaravelSendy\DTOs\Subscribers\SubscriberStatusDTO;
use Coderflex\LaravelSendy\DTOs\Subscribers\UnsubscribeDTO;
use Coderflex\LaravelSendy\Sendy;
use Illuminate\Http\Client\Response;

class Subscribers
{
    public function __construct(
        protected Sendy $sendy
    ) {}

    public function subscribe(array $data, bool $async = false): Response
    {
        $data = SubscribeDTO::validate($data);

        return $this->sendy->post('subscribe', $data, $async);
    }

    public function unsubscribe(array $data, bool $async = false): Response
    {
        $data = UnsubscribeDTO::validate($data);

        return $this->sendy->post('api/subscribers/unsubscribe.php', $data, $async);
    }

    public function delete(array $data, bool $async = false): Response
    {
        $data = DeleteSubscriberDTO::validate($data);

        return $this->sendy->post('api/subscribers/delete.php', $data, $async);
    }

    public function status(array $data, bool $async = false): Response
    {
        $data = SubscriberStatusDTO::validate($data);

        return $this->sendy->post('api/subscribers/subscription-status.php', $data, $async);
    }

    public function count(int $listId, bool $async = false): Response
    {
        $data = [
            'list_id' => $listId,
        ];

        return $this->sendy->post('api/subscribers/subscriber-count.php', $data, $async);
    }
}
