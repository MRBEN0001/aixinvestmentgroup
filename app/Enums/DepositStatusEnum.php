<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DepositStatusEnum extends Enum
{
    const pending = 'pending';
    const approved = 'approved';
    const closed = 'declined';
}
