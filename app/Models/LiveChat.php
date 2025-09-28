<?php

namespace App\Models;

use Database\Factories\LiveChatFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveChat extends Model
{
    /** @use HasFactory<LiveChatFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'message',
        'track_id',
        'stream_id',
        'sent_at',
        'is_flagged',
        'is_deleted',
        'ip_address',
        'metadata',
        'gift_type',
        'gift_value',
        'reaction_type',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'metadata' => 'json',
            'is_deleted' => 'boolean',
            'is_flagged' => 'boolean',
        ];
    }
}
