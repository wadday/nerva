<?php

namespace App\Http\Controllers\Pulse;

use App\Http\Controllers\Controller;
use App\Models\Pulse;
use App\Models\PulsePlay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PulseEngagementController extends Controller
{
    public function play(Pulse $pulse): void
    {
        $recent = PulsePlay::query()
            ->where('user_id', auth()->id())
            ->where('pulse_id', $pulse->id)
            ->where('created_at', '>=', now()->subMinute())
            ->exists();

        if (!$recent) {
            $pulse->plays()->create([
                'user_id' => auth()->id(),
                'pulse_id' => $pulse->id,
            ]);

            $pulse->update([
                'plays_count' => $pulse->plays()->count(),
            ]);
        }

    }

    public function like(Pulse $pulse)
    {
        try {
            DB::transaction(function () use ($pulse) {
                $like = $pulse->likes()->firstOrCreate([
                    'user_id' => auth()->id(),
                    'pulse_id' => $pulse->id,
                ]);

                if ($like->wasRecentlyCreated) {
                    $pulse->increment('likes_count');
                } else {
                    $like->delete();
                    $pulse->decrement('likes_count');
                }

            });
        } catch (\Throwable $e) {
            Log::error('Error in PulseEngagementController::like()', [$e]);
        }
    }

    public function share(Pulse $pulse)
    {

    }

    public function comment(Pulse $pulse)
    {

    }
}
