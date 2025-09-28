<?php

namespace App\Services;

use App\Builders\Menu\MenuBuilder;
use App\Builders\Menu\MenuItem;

class AdminMenuService
{
    public static function getPrimaryMenu(): array
    {
        return MenuBuilder::make()
            ->guard(config('auth.defaults.guard'))
            ->group('Manage', [
                MenuItem::make('Nerva')
                    ->route('for-you')
                    ->icon('ArrowLeft')
                    ->allows(true),
                MenuItem::make('Home')
                    ->route('deck.index')
                    ->active('deck.index')
                    ->icon('Dock')
                    ->allows(true),
                MenuItem::make('Pulse')
                    ->route('deck.pulse.index')
                    ->active('startsWith:deck.pulse.')
                    ->icon('HeartPulse')
                    ->allows(true),
                MenuItem::make('Drop')
                    ->route('deck.drop.index')
                    ->active('deck.drop.index')
                    ->icon('CloudUpload')
                    ->allows(true),
            ])->toArray();
    }

    public static function getSecondaryMenu(): array
    {
        return [];
    }
}
