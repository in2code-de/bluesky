<?php

declare(strict_types=1);

namespace In2code\Bluesky\Domain\Repository;

use In2code\Bluesky\Exception\RequestException;
use TYPO3\CMS\Core\Http\RequestFactory;

class BlueskyRepository
{
    private const API_URL = 'https://public.api.bsky.app/xrpc/app.bsky.feed.getAuthorFeed';

    public function __construct(readonly protected RequestFactory $requestFactory)
    {
    }

    /**
     * @param array $settings
     * @return array
     * @throws RequestException
     * @throws \JsonException
     */
    public function findBySettings(array $settings): array
    {
        $parameters = [
            'actor' => $this->getActor($settings),
            'limit' => (int)($settings['limit'] ?? 10) ?: 10,
            'filter' => 'posts_and_author_threads',
        ];
        $response = $this->requestFactory->request(self::API_URL . '?' . http_build_query($parameters));
        if ($response->getStatusCode() !== 200) {
            throw new RequestException('Returned status code is ' . $response->getStatusCode(), 1741173172);
        }
        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json') === false) {
            throw new RequestException('The request did not return JSON data', 1741173228);
        }
        $content = $response->getBody()->getContents();
        $result = json_decode($content, true, flags: JSON_THROW_ON_ERROR);
        if (is_array($result) === false || isset($result['feed']) === false || is_array($result['feed'] === false)) {
            throw new RequestException('The service returned an unexpected format', 1741173605);
        }
        return $result['feed'];
    }

    /**
     * https://bsky.app/profile/www.helmholtz-munich.de
     *
     * @param array $settings
     * @return string
     */
    private function getActor(array $settings): string
    {
        $account = $settings['account'] ?? 'in2code.de';
        if (stristr($account, '/')) {
            $account = basename($account);
        }
        return $account;
    }
}
