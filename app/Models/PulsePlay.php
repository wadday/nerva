<?php

namespace App\Models;

use Database\Factories\PulsePlayFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PulsePlay extends Model
{
    /** @use HasFactory<PulsePlayFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pulse_id',
    ];

    /**
     * @return BelongsTo<User, PulseLike>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Pulse, PulseLike>
     */
    public function pulse(): BelongsTo
    {
        return $this->belongsTo(Pulse::class);
    }
}
