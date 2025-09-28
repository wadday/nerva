<?php

namespace App\Http\Controllers;

class LiveFeedController extends Controller
{
    public function __invoke()
    {
        return inertia('Live/LiveFeed', [
            'title' => 'Live Feed',
        ]);
    }
}
