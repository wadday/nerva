<?php

namespace App\Http\Controllers;

use App\Data\SongData;
use App\Models\Song;

class LiveCenterController extends Controller
{
    public function __invoke()
    {
        $songs = Song::query()
            ->where('status', 'published')
            ->get()
            ->transform(fn ($song) => SongData::from($song));

        return inertia('LiveCenter', [
            'title' => 'Live Center',
            'songs' => $songs,
        ]);
    }
}
