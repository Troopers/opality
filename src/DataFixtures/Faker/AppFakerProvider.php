<?php
declare(strict_types = 1);

namespace App\DataFixtures\Faker;

use App\DBAL\Types\CriticalityType;
use App\DBAL\Types\DegreeConfidenceType;
use App\DBAL\Types\RecurrenceType;

class AppFakerProvider
{
    public static function criticality(): ?int
    {
        return static::pickInArray(array_flip(CriticalityType::getChoices()));
    }

    public static function recurrence(): ?string
    {
        return static::pickInArray(array_flip(RecurrenceType::getChoices()));
    }

    public static function degreeConfidence(): ?int
    {
        return static::pickInArray(array_flip(DegreeConfidenceType::getChoices()));
    }

    protected static function pickInArray($array)
    {
        return array_rand($array, 1);
    }
}