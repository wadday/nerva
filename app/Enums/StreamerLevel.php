<?php

namespace App\Enums;

enum StreamerLevel: string
{
    case Bronze = 'bronze';
    case Silver = 'silver';
    case Gold = 'gold';
    case Platinum = 'platinum';

    public function badgeColor(): string
    {
        return match ($this) {
            self::Bronze => '#cd7f32',
            self::Silver => '#c0c0c0',
            self::Gold => '#ffd700',
            self::Platinum => '#e5e4e2',
        };
    }
}
