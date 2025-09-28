<?php

namespace App\Http\Controllers;

class LiveFollowingController extends Controller
{
    public function __invoke()
    {
        return inertia('Live/LiveFollowing', [
            'title' => 'Following - Live Feed',
        ]);
    }
}
