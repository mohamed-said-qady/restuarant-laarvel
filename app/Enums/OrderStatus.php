<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum
{
    const Received = 'received';
    const Preparing = 'preparing';
    const Complete = 'complete';
    const Canceled = 'canceled';
}
