<?php

namespace Coderflex\LaravelSendy\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

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
            'name' => ['string', 'nullable'],
            'email' => ['required', 'string', 'email'],
            'list' => ['required', 'string'],
            'country' => ['string', 'nullable'],
            'ipaddress' => ['string', 'nullable', 'ip'],
            'referrer' => ['string', 'nullable'],
            'gdpr' => ['boolean', 'nullable'],
            'silent' => ['boolean', 'nullable'],
            'boolean' => ['boolean', 'nullable'],
        ];
    }
}
