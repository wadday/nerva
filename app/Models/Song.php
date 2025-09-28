<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = [];

    public function casts(): array
    {
        return [
            'duration' => 'integer',
            'play_count' => 'integer',
        ];
    }
}
