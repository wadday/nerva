<?php

use App\Http\Controllers\Deck\DeckController;
use App\Http\Controllers\Deck\DropController;
use App\Http\Controllers\Deck\PulseController as DeckPulseController;
use App\Http\Controllers\LiveFeedController;
use App\Http\Controllers\LiveFollowingController;
use App\Http\Controllers\NervaDashboardController;
use App\Http\Controllers\PulseController;
use App\Http\Controllers\RadarController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', fn() => 'home')->name('home');
Route::get('/', PulseController::class)->name('for-you');

Route::get('/radar', RadarController::class)->name('radar');

Route::get('/live', LiveFeedController::class)
    ->name('live');

Route::get('/live/following', LiveFollowingController::class)
    ->name('live-following');

Route::prefix('deck')->as('deck.')->middleware(['auth'])->group(function () {
    Route::get('/', DeckController::class)->name('index');

    // Pulse
    Route::resource('pulse', DeckPulseController::class);

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
