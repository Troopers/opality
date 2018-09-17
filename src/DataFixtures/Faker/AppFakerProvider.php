<?php
declare(strict_types = 1);

namespace App\DataFixtures\Faker;

use App\DBAL\Types\CriticalityType;
use App\DBAL\Types\RecurrenceType;

class AppFakerProvider
{
    public static function criticality(): ?string
    {
        return static::pickInArray(array_flip(CriticalityType::getChoices()));
    }

    public static function recurrence(): ?string
    {
        return static::pickInArray(array_flip(RecurrenceType::getChoices()));
    }

    protected static function pickInArray($array): ?string
    {
        return array_rand($array, 1);
    }
}