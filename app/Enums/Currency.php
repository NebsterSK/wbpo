<?php

namespace App\Enums;

enum Currency : string
{
    case EUR = 'eur';
    case USD = 'usd';

    public static function toArray() : array
    {
        $array = [];

        foreach (self::cases() as $case) {
            $array[] = $case->value;
        }

        return $array;
    }
}