<?php

declare(strict_types=1);

namespace In2code\Bluesky\Controller;

use In2code\Bluesky\Domain\Repository\BlueskyRepository;
use In2code\Bluesky\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ListController extends ActionController
{
    public function __construct(readonly protected BlueskyRepository $blueskyRepository)
    {
    }

    /**
     * @return ResponseInterface
     * @throws RequestException
     * @throws \JsonException
     */
    public function listAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'data' => $this->request->getAttribute('currentContentObject')->data,
            'posts' => $this->blueskyRepository->findBySettings($this->settings),
        ]);
        return $this->htmlResponse();
    }
}
