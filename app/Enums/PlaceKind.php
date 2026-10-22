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
}
