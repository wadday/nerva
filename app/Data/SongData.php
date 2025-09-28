<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SongData extends Data
{
    public function __construct(
        public int $id,
        public string $slug,
        public string $title,
        public string $cover,
        public string $duration,
        public string $song_url,
        public string $status,
        public int $play_count = 0,
    ) {}
}
