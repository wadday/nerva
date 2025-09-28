<?php

namespace App\Http\Controllers\Deck;

use App\Http\Controllers\Controller;

class DeckController extends Controller
{
    public function __invoke()
    {
        return inertia('Deck/Dashboard/Dashboard', [
            'title' => 'Deck',
        ]);
    }
}
