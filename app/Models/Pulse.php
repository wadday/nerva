<?php

namespace App\Models;

use App\Attributes\UseData;
use App\Concerns\TransformsToData;
use App\Data\PulseData;
use App\Enums\PulseStatus;
use App\Enums\VisibilityEnum;
use Database\Factories\PulseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[UseData(PulseData::class)]
class Pulse extends Model
{
    /** @use HasFactory<PulseFactory> */
    use HasFactory;

    use TransformsToData;

    protected $fillable = [
        'user_id',
        'song_id',
        'uuid',
        'caption',
        'selected_timestamp',
        'likes_count',
        'comments_count',
        'plays_count',
        'allow_comments',
        'status',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'selected_timestamp' => 'float',
            'likes_count' => 'integer',
            'comments_count' => 'integer',
            'plays_count' => 'integer',
            'allow_comments' => 'boolean',
            'visibility' => VisibilityEnum::class,
            'status' => PulseStatus::class,
        ];
    }

    /**
     * @return HasMany<PulseMedia, Pulse>
     */
    public function medias(): HasMany
    {
        return $this->hasMany(PulseMedia::class);
    }

    /**
     * @return BelongsTo<User, Pulse>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Song, Pulse>
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class);
    }

    /**
     * @return HasMany<PulseLike, Pulse>
     */
    public function likes(): HasMany
    {
        return $this->hasMany(PulseLike::class);
    }

    /**
     * @return HasMany<PulseComment, Pulse>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(PulseComment::class);
    }

    /**
     * @return HasMany<PulsePlay, Pulse>
     */
    public function plays(): HasMany
    {
        return $this->hasMany(PulsePlay::class, 'pulse_id', 'id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function scopePublished($query): void
    {
        $query->where('status', 'published');
    }
}
