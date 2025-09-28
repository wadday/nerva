<?php

namespace App\Http\Controllers;

class NervaDashboardController extends Controller
{
    public function __invoke()
    {
        return inertia('nerva/Dashboard', [
            'title' => 'Nerva Dashboard',
        ]);
    }
}
