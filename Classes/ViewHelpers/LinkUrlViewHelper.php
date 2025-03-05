<?php

declare(strict_types=1);

namespace In2code\Bluesky\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class LinkUrlViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('text', 'string', 'Text of bluesky post');
        $this->registerArgument('attributes', 'array', 'Associative array of attributes', false, []);
    }

    public function render(): string
    {
        $text = $this->arguments['text'];
        if ($text === null) {
            $text = $this->renderChildren();
        }
        $text = $this->addLinks($text);
        return $text;
    }

    private function addLinks(string $text): string
    {
        $pattern = '~(^|\s+)([a-zA-Z0-9]+\.[a-z]{2,3}(\.[a-z]{2,3})?[\/\.a-zA-Z0-9_-]*)($|\s+)~';
        return preg_replace_callback($pattern, [$this, 'getReplaceString'], $text);
    }

    private function getReplaceString(array $matches): string
    {
        $href = $matches[2];
        if (str_starts_with($href, 'http://') === false && str_starts_with($href, 'https://') === false) {
            $href = 'https://' . $href;
        }
        return $matches[1] . '<a href="' . $href . '"' . $this->getAttributeString() . '>'
            . $matches[2] . '</a>'
            . $matches[4];
    }

    private function getAttributeString(): string
    {
        $attributeString = '';
        $attributes = $this->arguments['attributes'] + ['target' => '_blank', 'rel' => 'noreferrer'];
        foreach ($attributes as $key => $value) {
            $attributeString .= ' ' . $key . '=' . $value;
        }
        return $attributeString;
    }
}
