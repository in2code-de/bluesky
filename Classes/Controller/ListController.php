<?php

declare(strict_types=1);

namespace In2code\Bluesky\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ListController extends ActionController
{
    public function listAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
}
