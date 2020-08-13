<?php

namespace App\Infrastructure\Services\External\Quotes;

use App\Application\Exception\InvalidAPIResponseException;

/**
 * Class QuotesClientManager
 * @package App\Infrastructure\Services\External
 */
class QuotesConnector
{
    const URL_SERVICE = 'https://raw.githubusercontent.com/iPresence/backend_test/master/quotes.json';

    /**
     * @var array
     */
    private $rawData;

    /**
     * connect
     */
    private function getRawData(): array
    {
        try {
            $data = file_get_contents(QuotesConnector::URL_SERVICE);
        } catch (\Exception $e) {
            throw new InvalidAPIResponseException();
        }

        return json_decode($data, true);
    }

    /**
     * @param array|null $data
     */
    private function setRawData(?array $data): void
    {
        if ($data && isset($data['quotes']) && is_array($data['quotes'])) {
            $this->rawData = $data['quotes'];
        } else {
            throw new InvalidAPIResponseException();
        }
    }

    /**
     * @param string   $author
     * @param int|null $limit
     *
     * @return array
     */
    public function getQuotes(string $author, int $limit = null): array
    {
        $this->setRawData($this->getRawData());

        return $this->filterAuthor($author, $limit);
    }

    /**
     * @param string $authorSearch
     * @param string $author
     *
     * @return bool
     */
    private function filterAuthor(string $authorSearch, ?int $limit = null): array
    {
        $countLimit = 0;
        $quoteAssembler = new QuoteAssembler();
        $filtered = [];

        foreach ($this->rawData as $item) {
            $quoteItem = isset($item['quote']) ? $item['quote'] : null;
            $authorItem = isset($item['author']) ? $item['author'] : null;

            if (preg_match('/'.preg_quote($authorSearch).'/i', $authorItem)) {
                if (($limit !== null && $countLimit < $limit) || $limit === null) {
                    $countLimit++;
                    $filtered[] = $quoteAssembler->writeDTO($quoteItem, $authorItem);
                }
            }
        }

        return $filtered;
    }
}
