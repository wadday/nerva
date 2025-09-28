<?php

namespace App\Http\Controllers\Deck;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PulseController extends Controller
{
    public function index()
    {
        return inertia('Deck/Pulse/PulseIndex', [
            'title' => 'Pulse - Deck',
        ]);
    }

    public function create()
    {
        return inertia('Deck/Pulse/EditPulse', [
            'title' => 'Create Pulse - Deck',
            'pulseLength' => config('nerva.pulse.length'),
        ]);
    }

    public function show(string $pulse) {}

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function edit(string $pulse)
    {
        return inertia('Deck/Pulse/EditPulse', [
            'title' => 'Edit Pulse - Deck',
        ]);
    }

    public function update(Request $request, string $pulse) {}

    public function destroy(string $pulse) {}
}
