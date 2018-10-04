<?php
declare(strict_types = 1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class DegreeConfidenceType extends AbstractEnumType
{
    const DISCOURAGED = 0;
    const ANGUISH = 1;
    const ANXIOUS = 2;
    const UNCERTAIN = 3;
    const EASED =  4;
    const SERENE =  5;
    const CONFIDENT =  6;
    const CERTAIN =  7;

    protected static $choices = [
        self::DISCOURAGED => 'admin.degree.confidence.'.self::DISCOURAGED,
        self::ANGUISH => 'admin.degree.confidence.'.self::ANGUISH,
        self::ANXIOUS => 'admin.degree.confidence.'.self::ANXIOUS,
        self::UNCERTAIN => 'admin.degree.confidence.'.self::UNCERTAIN,
        self::EASED => 'admin.degree.confidence.'.self::EASED,
        self::SERENE => 'admin.degree.confidence.'.self::SERENE,
        self::CONFIDENT => 'admin.degree.confidence.'.self::CONFIDENT,
        self::CERTAIN => 'admin.degree.confidence.'.self::CERTAIN,
    ];
}
