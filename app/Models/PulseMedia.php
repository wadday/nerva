<?php

namespace App\Models;

use Database\Factories\PulseMediaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PulseMedia extends Model
{
    /** @use HasFactory<PulseMediaFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'filename',
        'path',
        'mime_type',
        'disk',
        'pulse_id',
    ];

    protected $appends = ['url'];

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->attributes['disk'])
            ->url($this->attributes['path']);
    }

    /**
     * @return BelongsTo<Pulse, PulseMedia>
     */
    public function pulse(): BelongsTo
    {
        return $this->belongsTo(Pulse::class);
    }
}
