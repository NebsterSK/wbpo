<?php

namespace App\Enums;

use App\Traits\EnumEnhancements;

enum Currency: string implements EnumInterface
{
    use EnumEnhancements;

    case EUR = 'eur';
    case USD = 'usd';
}
