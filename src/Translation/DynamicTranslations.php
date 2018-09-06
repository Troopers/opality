<?php

namespace App\Translation;

use App\DBAL\Types\CriticalityType;
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
        $messages = [];

        $doctrineEnums = [
            CriticalityType::class,
        ];

        foreach ($doctrineEnums as $doctrineEnum) {
            foreach ($doctrineEnum::getChoices() as $label => $value) {
                $messages[] = new Message($label);
            }
        }

        return $messages;
    }
}
