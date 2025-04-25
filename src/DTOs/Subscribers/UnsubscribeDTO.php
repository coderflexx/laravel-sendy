<?php

namespace Coderflex\LaravelSendy\DTOs\Subscribers;

use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class UnsubscribeDTO extends Data
{
    public function __construct(
        public string $list,
        public string $email,
        public ?bool $boolean = false, // plain text response
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'email' => ['email'],
        ];
    }
}
