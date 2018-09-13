<?php
declare(strict_types = 1);

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class RecurrenceType extends AbstractEnumType
{
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const QUARTERLY =  'quarterly';
    const YEARLY =  'yearly';

    protected static $choices = [
        self::WEEKLY => 'admin.recurrence.weekly.label',
        self::MONTHLY => 'admin.recurrence.monthly.label',
        self::QUARTERLY => 'admin.recurrence.quarterly.label',
        self::YEARLY => 'admin.recurrence.yearly.label'
    ];
}
