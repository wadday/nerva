<?php

namespace App\Data;

use App\Enums\PulseStatus;
use App\Enums\VisibilityEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PulseData extends Data
{
    public function __construct(
        public int $id,
        public string $uuid,
        public int $user_id,
        public ?int $song_id,
        public ?string $caption,
        public ?string $selected_timestamp,
        public ?int $likes_count,
        public ?int $comments_count,
        public ?int $shares_count,
        public ?int $plays_count,
        public bool $allow_comments,
        public PulseStatus $status,
        public VisibilityEnum $visibility,
        public ?string $created_at,
        public ?string $updated_at,
        public ?SongData $song,
        public array|Collection $medias,
        public ?User $user,
    ) {}
}
