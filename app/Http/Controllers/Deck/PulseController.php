<?php

namespace App\Http\Controllers\Deck;

use App\Enums\VisibilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pulse\UpdatePulseRequest;
use App\Models\Pulse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;

class PulseController extends Controller
{
    public function index()
    {
        $pulses = auth()->user()->pulses()->paginate();

        return inertia('Deck/Pulse/PulseIndex', [
            'title' => 'Pulse - Deck',
            'pulses' => $pulses,
        ]);
    }

    public function create()
    {
        $pulse = Pulse::query()->firstOrCreate([
            'user_id' => auth()->id(),
            'status' => 'draft',
        ], [
            'allow_comments' => true,
            'visibility' => VisibilityEnum::Public,
        ]);

        $pulse->loadMissing(['medias', 'song']);
//return $pulse;
        return inertia('Deck/Pulse/EditPulse', [
            'title' => 'Create Pulse - Deck',
            'pulseLength' => config('nerva.pulse.length'),
            'pulse' => $pulse->toData(),
            'public_songs' => Inertia::optional(fn() => $this->getSongs()),
            'liked_songs' => Inertia::optional(fn() => $this->getSongs()),
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

    public function update(UpdatePulseRequest $request, Pulse $pulse)
    {
        $data = $request->validated();

        $pulse->update(Arr::only($data, [
            'caption',
            'status',
            'visibility',
            'allow_comments',
            'selected_timestamp',
            'song_id',
        ]));

        return back();
    }

    public function destroy(string $pulse) {}

    protected function getSongs()
    {
        return auth()->user()->songs()->get();
    }
}
