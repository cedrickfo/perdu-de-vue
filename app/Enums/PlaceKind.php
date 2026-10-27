<?php

namespace App\Enums;

enum PlaceKind: string
{
    case Hall = 'hall';
    case Platform = 'platform';
    case Train = 'train';

    public function label(): string
    {
        return match ($this) {
            self::Hall => 'Hall',
            self::Platform => 'Quai',
            self::Train => 'Train',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Hall => 'bg-sky-100 text-sky-800 ring-1 ring-sky-200',
            self::Platform => 'bg-amber-100 text-amber-800 ring-1 ring-amber-200',
            self::Train => 'bg-orange-100 text-orange-800 ring-1 ring-orange-200',
        };
    }
}
