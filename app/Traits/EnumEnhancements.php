<?php

namespace App\Traits;

trait EnumEnhancements
{
    public static function toArray(): array
    {
        $array = [];

        foreach (self::cases() as $case) {
            $array[] = $case->value;
        }

        return $array;
    }
}
