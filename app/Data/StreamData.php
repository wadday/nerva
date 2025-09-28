<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class StreamData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public int $host_id,
        public string $started_at,
        public string $ended_at,
        public bool $is_live,
        public int $audience_count,
        public float $engagement_rate,
        public float $retention_rate,
        public ?array $metadata,
        public ?string $created_at,
        public ?string $updated_at,
    ) {}
}
