<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Infrastructure\Services\External\Quotes;

/**
 * Class QuotesClientManager
 */
class QuotesRepository
{
    /**
     * @var QuotesConnector
     */
    private $connector;

    /**
     * QuotesRepository constructor.
     */
    public function __construct()
    {
        $this->connector = new QuotesConnector();
    }

    /**
     * @param string   $author
     * @param int|null $limit
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
