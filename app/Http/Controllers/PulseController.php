<?php

namespace App\Http\Controllers;

use App\Models\Pulse;

class PulseController extends Controller
{
    public function __invoke(?string $pulseId = null)
    {
        $pulse = $pulseId
            ? Pulse::query()
                ->where('uuid', $pulseId)
                ->published()
                ->first()
            : Pulse::query()
                ->inRandomOrder()
                ->published()
                ->first();

        $last = Pulse::query()
            ->where('id', '<', $pulse->id)
            ->orderByDesc('id')
            ->published()
            ->first();
        $next = Pulse::query()
            ->where('id', '>', $pulse->id)
            ->orderBy('id')
            ->published()
            ->first();

        $pulse->loadMissing(['medias', 'song', 'user:id,name,avatar,username,is_live,is_verified']);

        return inertia('Pulse/ForYou', [
            'title' => 'Feels Alive',
            'pulse' => $pulse,
            'next' => $next,
            'last' => $last,
        ]);

    }
}
