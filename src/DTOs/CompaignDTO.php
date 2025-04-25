<?php

namespace Coderflex\LaravelSendy\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class CompaignDTO extends Data
{
    public function __construct(
        public string $from_name,
        public string $from_email,
        public string $reply_to,
        public string $title,
        public string $subject,
        public ?string $plain_text,
        public string $html_text,
        public string $list_ids,
        public string $segment_ids,
        public ?string $exclude_list_ids,
        public ?string $exclude_segment_ids,
        public ?string $brand_id,
        public ?string $query_string,
        public ?int $track_opens,
        public ?int $track_clicks,
        public ?int $send_compaign,
        public ?string $schedule_date_time,
        public ?string $schedule_timezone,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'from_name' => ['required', 'string'],
            'from_email' => ['required', 'email'],
            'reply_to' => ['required', 'email'],
            'title' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'plain_text' => ['string', 'nullable'],
            'html_text' => ['required', 'string'],
            'list_ids' => ['required', 'string'],
            'segment_ids' => ['required', 'string'],
            'exclude_list_ids' => ['string', 'nullable'],
            'exclude_segment_ids' => ['string', 'nullable'],
            'brand_id' => ['required_if', 'string'],
            'query_string' => ['string', 'nullable'],
            'track_opens' => ['integer', 'nullable', 'in:0,1,2'],
            'track_clicks' => ['integer', 'nullable', 'in:0,1,2'],
            'send_compaign' => ['integer', 'nullable', 'in:0,1'],
            'schedule_date_time' => ['date', 'nullable'],
            'schedule_timezone' => ['date', 'nullable'],
        ];
    }
}
