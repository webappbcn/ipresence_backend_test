<?php

namespace App\Infrastructure\Services\External\Quotes;

/**
 * Class QuotesClientManager
 * @package App\Infrastructure\Services\External
 */
class QuotesRepository
{
    /**
     * @var QuotesConnector
     */
    private $connector;

    public function __construct()
    {
        $this->connector = new QuotesConnector();
    }

    /**
     * @param string $name
     * @param int    $limit
     *
     * @return array
     */
    public function filter(string $author, ?int $limit): array
    {
        return $this->connector->getQuotes($this->convertAuthor($author), $limit);
    }

    /**
     * @param string $author
     *
     * @return string
     */
    private function convertAuthor(string $author): string
    {
        return trim(str_replace('-', ' ', $author));
    }
}
