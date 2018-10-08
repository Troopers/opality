<?php
declare(strict_types = 1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CriticalityType extends AbstractEnumType
{
    const MINOR = 0;
    const MEDIUM = 1;
    const CRITICAL =  2;

    protected static $choices = [
        self::MINOR => 'criticality.'.self::MINOR,
        self::MEDIUM => 'criticality.'.self::MEDIUM,
        self::CRITICAL => 'criticality.'.self::CRITICAL,
    ];
}
