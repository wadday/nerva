<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class LiveChatData extends Data
{
    public function __construct(
        public int $id,
        public int $user_id,
        public string $username,
        public string $message,
        public int $track_id,
        public int $stream_id,
        public string $sent_at,
        public bool $is_flagged,
        public bool $is_deleted,
        public ?string $ip_address,
        public ?array $metadata,
        public ?string $gift_type,
        public ?int $gift_value,
        public ?string $reaction_type,
        public ?string $created_at,
        public ?string $updated_at,
    ) {}
}
