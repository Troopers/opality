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
        self::DISCOURAGED => 'degree.confidence.'.self::DISCOURAGED,
        self::ANGUISH => 'degree.confidence.'.self::ANGUISH,
        self::ANXIOUS => 'degree.confidence.'.self::ANXIOUS,
        self::UNCERTAIN => 'degree.confidence.'.self::UNCERTAIN,
        self::EASED => 'degree.confidence.'.self::EASED,
        self::SERENE => 'degree.confidence.'.self::SERENE,
        self::CONFIDENT => 'degree.confidence.'.self::CONFIDENT,
        self::CERTAIN => 'degree.confidence.'.self::CERTAIN,
    ];
}
