<?php

namespace App\Models;

use Database\Factories\PulseCommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PulseComment extends Model
{
    /** @use HasFactory<PulseCommentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pulse_id',
        'content',
        'parent_id',
    ];

    /**
     * @return BelongsTo<User, PulseComment>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Pulse, PulseComment>
     */
    public function pulse(): BelongsTo
    {
        return $this->belongsTo(Pulse::class);
    }
}
