<?php

namespace App\Models;

use Database\Factories\StreamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stream extends Model
{
    /** @use HasFactory<StreamFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'host_id',
        'started_at',
        'ended_at',
        'is_live',
        'audience_count',
        'engagement_rate',
        'retention_rate',
        'enable_chat',
        'enable_gifts',
        'enable_reactions',
        'metadata',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'metadata' => 'json',
            'is_live' => 'boolean',
            'enable_chat' => 'boolean',
            'enable_gifts' => 'boolean',
            'enable_reactions' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<User, Stream>
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * @return BelongsTo<StreamLike, Stream>
     */
    public function likes(): BelongsTo
    {
        return $this->belongsTo(StreamLike::class);
    }

    /**
     * @return HasMany<StreamListener, Stream>
     */
    public function listeners(): HasMany
    {
        return $this->hasMany(StreamListener::class);
    }
}
