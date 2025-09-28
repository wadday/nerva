<?php

namespace App\Http\Controllers;

class PulseController extends Controller
{
    public function __invoke()
    {
        return inertia('Pulse/ForYou', [
            'title' => 'Feels Alive',
        ]);

    }
}
