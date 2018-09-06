<?php

namespace App\Translation;

use JMS\TranslationBundle\Model\FileSource;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Model\MessageCatalogue;
use JMS\TranslationBundle\Translation\Extractor\FileVisitorInterface;
use Symfony\Component\Yaml\Yaml;

class EasyAdminTranslationExtractor implements FileVisitorInterface
{
    public function visitFile(\SplFileInfo $file, MessageCatalogue $catalogue)
    {
        if ('.yaml' !== substr($file, -5)) {
            return;
        }
        $content = Yaml::parseFile($file);
        if (null === $content || !is_array($content) || !isset($content['easy_admin'])) {
            return;
        }

        $messages = [];
        $messages = $this->recursive_array_search('label', $content['easy_admin'], $messages);

        foreach ($messages as $message) {
            $message->addSource(new FileSource((string) $file->getRelativePathname()));
            $catalogue->add($message);
        }
    }

    public function visitPhpFile(\SplFileInfo $file, MessageCatalogue $catalogue, array $ast)
    {
    }

    public function visitTwigFile(\SplFileInfo $file, MessageCatalogue $catalogue, \Twig_Node $node)
    {
    }

    private function recursive_array_search($needle, $haystack, $results)
    {
        foreach ($haystack as $k => $value) {
            if (($k === 'label' || $k === 'title' || $k === 'help') && $value !== '' && !is_array($value)) {
                $results[] = new Message($value, 'messages');
            } elseif (is_array($value)) {
                $results = $this->recursive_array_search($needle, $value, $results);
            }
        }

        return $results;
    }
}
