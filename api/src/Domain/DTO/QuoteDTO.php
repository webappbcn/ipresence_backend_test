<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Domain\DTO;

/**
 * Class QuoteDTO
 */
class QuoteDTO implements DTOInterface
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
    public function __construct(?string $quote = null, ?string $author = null)
    {
        $this->quote = $quote !== null ? $this->convertShout($quote) : null;
        $this->author = $author !== null ? $this->convertShout($author) : null;
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

    /**
     * @param string $text
     *
     * @return string
     */
    private function convertShout(string $text): string
    {
        return strtoupper(rtrim($text, '.')).'!';
    }
}
