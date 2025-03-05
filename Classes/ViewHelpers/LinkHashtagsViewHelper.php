<?php

declare(strict_types=1);

namespace In2code\Bluesky\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class LinkHashtagsViewHelper extends AbstractViewHelper
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
        $text = $this->protectAsciiCharacters($text);
        $text = $this->addLinks($text);
        $text = $this->restoreAsciiCharacters($text);
        return $text;
    }

    private function protectAsciiCharacters(string $text): string
    {
        return preg_replace('~#([0-9]{3,4};)~', '# $1', $text);
    }

    private function addLinks(string $text): string
    {
        $replaceString = '<a href="https://web-cdn.bsky.app/hashtag/$1"' . $this->getAttributeString() . '>$0</a>';
        return preg_replace('~#([^\s]+)~', $replaceString, $text);
    }

    private function restoreAsciiCharacters(string $text): string
    {
        return preg_replace('~# ([0-9]{3,4};)~', '#$1', $text);
    }

    private function getAttributeString(): string
    {
        $attributeString = '';
        if ($this->arguments['attributes'] !== []) {
            foreach ($this->arguments['attributes'] as $key => $value) {
                $attributeString .= ' ' . $key . '=' . $value;
            }
        }
        return $attributeString;
    }
}
