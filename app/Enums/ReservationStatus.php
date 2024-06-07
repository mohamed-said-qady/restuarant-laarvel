<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ReservationStatus extends Enum
{
    const Requested = 'requested';
    const Pending = 'pending';
    const Confirmed = 'confirmed';
    const Checkedin = 'checkedin';
    const Canceled = 'canceled';
    const Abandoned = 'abandoned';
}
