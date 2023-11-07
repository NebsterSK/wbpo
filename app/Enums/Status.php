<?php

namespace App\Enums;

use App\Traits\EnumEnhancements;

enum Status: string implements EnumInterface
{
    use EnumEnhancements;

    case Processing = 'processing';
    case Fail = 'fail';
    case Success = 'success';
}
