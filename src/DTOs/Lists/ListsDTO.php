<?php

namespace Coderflex\LaravelSendy\DTOs\Lists;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ListsDTO extends Data
{
    public function __construct(
        public string $brand_id,
        public ?string $include_hidden = 'no',
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'include_hidden' => ['in:yes,no'],
        ];
    }
}
