<?php

namespace App\Models;

use Database\Factories\PulseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pulse extends Model
{
    /** @use HasFactory<PulseFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'song_id',
        'audio_url',
        'caption',
        'likes_count',
        'comments_count',
        'plays_count',
        'allow_comments',
        'status',
    ];

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
}
