<?php

namespace App\Translation;

use App\DBAL\Types\CriticalityType;
use App\DBAL\Types\RecurrenceType;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;

class DynamicTranslations implements TranslationContainerInterface
{
    /**
     * Returns an array of messages.
     *
     * @return array<Message>
     */
    public static function getTranslationMessages()
    {
        $messages = [
            new Message('app.menu.goals'),
            new Message('app.menu.roles'),
            new Message('app.menu.kudos'),
            new Message('app.menu.visualization'),
            new Message('app.menu.visualization.organizationChart'),
            new Message('app.menu.visualization.botleneck'),
            new Message('app.menu.visualization.blooming'),
            new Message('app.menu.meeting'),
        ];

        $doctrineEnums = [
            CriticalityType::class,
            RecurrenceType::class,
        ];

        foreach ($doctrineEnums as $doctrineEnum) {
            foreach ($doctrineEnum::getChoices() as $label => $value) {
                $messages[] = new Message($label);
            }
        }

        return $messages;
    }
}
