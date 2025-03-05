<?php

declare(strict_types=1);

namespace In2code\Bluesky\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class GetPostIdViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument(
            'uri',
            'string',
            'like "at://did:plc:jerwfdtqw6voauleqa33yzxg/app.bsky.feed.post/3ljmnqgwj322q"'
        );
    }

    public function render(): string
    {
        $uri = $this->arguments['uri'];
        if ($uri === null) {
            $uri = $this->renderChildren();
        }
        return basename($uri);
    }
}
