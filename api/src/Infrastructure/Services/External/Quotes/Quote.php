<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Infrastructure\Services\External\Quotes;

/**
 * Class Quote
 */
class Quote
{
    /**
     * @var string|null
     */
    private $quote;
    /**
     * @var string|null
     */
    private $author;

    /**
     * Quote constructor.
     *
     * @param string|null $quote
     * @param string|null $author
     */
    public function __construct(?string $quote, ?string $author)
    {
        $this->quote = $quote;
        $this->author = $author;
    }

    /**
     * @return string|null
     */
    public function getQuote(): ?string
    {
        return $this->quote;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }
}
