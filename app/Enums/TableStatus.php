<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TableStatus extends Enum
{
    const Free = 'free';
    const Reserved = 'reserved';
    const Occupied = 'occupied';
    const Other = 'other';
}
