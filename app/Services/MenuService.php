<?php

namespace App\Services;

use App\Builders\Menu\MenuBuilder;
use App\Builders\Menu\MenuItem;

class MenuService
{
    public static function getPrimaryMenu(): array
    {
        return MenuBuilder::make()
            ->guard(config('auth.defaults.guard'))
            ->items([
                MenuItem::make('Pulse')
                    ->route('for-you')
                    ->active('for-you')
                    ->icon('HeartPulse')
                    ->allows(true),
                MenuItem::make('Radar')
                    ->route('radar')
                    ->active('radar')
                    ->icon('Radar')
                    ->allows(true),
                MenuItem::make('Signal')
                    ->route('live')
                    ->active('startsWith:live')
                    ->icon('Radio')
                    ->allows(true),
                MenuItem::make('Profile')
                    ->route('profile.edit')
                    ->active('profile.edit')
                    ->icon('User')
                    ->allows(true),
                MenuItem::make('Deck')
                    ->route('deck.index')
                    ->icon('Cpu')
                    ->allows(auth()->check()),
            ])->toArray();
    }

    public static function getSecondaryMenu(): array
    {
        return [];
    }
}
