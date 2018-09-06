<?php
declare(strict_types = 1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CriticalityType extends AbstractEnumType
{
    const MINOR = 'minor';
    const MEDIUM = 'medium';
    const CRITICAL =  'critical';

    protected static $choices = [
        self::MINOR => 'admin.level.minor.label',
        self::MEDIUM => 'admin.level.medium.label',
        self::CRITICAL => 'admin.level.critical.label',
    ];
}
