<?php

use App\Http\Controllers\Deck\DeckController;
use App\Http\Controllers\Deck\DropController;
use App\Http\Controllers\Deck\PulseController as DeckPulseController;
use App\Http\Controllers\Deck\PulseMediaController;
use App\Http\Controllers\LiveFeedController;
use App\Http\Controllers\LiveFollowingController;
use App\Http\Controllers\NervaDashboardController;
use App\Http\Controllers\Pulse\PulseEngagementController;
use App\Http\Controllers\PulseController;
use App\Http\Controllers\RadarController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', fn () => 'home')->name('home');
Route::redirect('/', '/for-you');
Route::get('/for-you/{pulseId?}', PulseController::class)->name('for-you');

// Pulses Route
Route::put('/pulses/{pulse:uuid}/play', [PulseEngagementController::class, 'play'])->name('pulses.played');
Route::put('/pulses/{pulse:uuid}/like', [PulseEngagementController::class, 'like'])->name('pulses.like');
Route::put('/pulses/{pulse:uuid}/share', [PulseEngagementController::class, 'share'])->name('pulses.share');
Route::put('/pulses/{pulse:uuid}/comment', [PulseEngagementController::class, 'comment'])->name('pulses.comment');

Route::get('/radar', RadarController::class)->name('radar');

Route::get('/live', LiveFeedController::class)
    ->name('live');

// User profile
Route::get('/@{user:username}', [ProfileController::class, 'show'])
    ->name('user.profile');

Route::get('/live/following', LiveFollowingController::class)
    ->name('live-following');


Route::prefix('deck')->as('deck.')->middleware(['auth'])->group(function () {
    Route::get('/', DeckController::class)->name('index');

    // Pulse
    Route::resource('pulse', DeckPulseController::class);

    Route::get('pulse/{pulse}/medias', [PulseMediaController::class, 'index'])->name('pulse.medias.index');
    Route::post('pulse/{pulse}/medias', [PulseMediaController::class, 'store'])->name('pulse.medias.store');
    Route::delete('pulse/{pulse}/medias/{media}', [PulseMediaController::class, 'destroy'])->name('pulse.medias.destroy');

    // Drop (upload)
    Route::resource('drop', DropController::class);
});

Route::get('/live-d', NervaDashboardController::class)
    ->name('live-d');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/live-center', \App\Http\Controllers\LiveCenterController::class)
    ->name('live-center');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
