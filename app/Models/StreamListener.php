<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamListener extends Model
{
    protected $fillable = [
        'stream_id',
        'user_id',
        'joined_at',
        'left_at',
        'ip_address',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'joined_at' => 'datetime',
            'left_at' => 'datetime',
            'metadata' => 'json',
            'user_id' => 'integer',
            'stream_id' => 'integer',
        ];
    }
}
