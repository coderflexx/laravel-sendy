<?php

namespace Coderflex\LaravelSendy\DTOs\Subscribers;

use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class SubscriberStatusDTO extends Data
{
    public function __construct(
        public string $list_id,
        public string $email,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'email' => ['email'],
        ];
    }
}
