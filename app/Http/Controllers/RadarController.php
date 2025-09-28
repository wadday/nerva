<?php

namespace App\Http\Controllers;

class RadarController extends Controller
{
    public function __invoke()
    {
        return inertia('Radar', [
            'title' => 'Radar - Find your favourite songs',
        ]);
    }
}
