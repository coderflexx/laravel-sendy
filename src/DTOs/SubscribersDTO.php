<?php

namespace Coderflex\LaravelSendy\DTOs;

use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class SubscribersDTO extends Data
{
    public function __construct(
        public ?string $name,
        public string $email,
        public string $list,
        public string $country,
        public ?string $ipaddress,
        public ?string $referrer,
        public ?bool $gdpr,
        public ?bool $silent,
        public ?bool $boolean,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'email' => ['email'],
            'ipaddress' => ['ip'],
        ];
    }
}
