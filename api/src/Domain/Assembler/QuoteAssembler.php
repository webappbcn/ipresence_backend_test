<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Domain\Assembler;

use App\Domain\DTO\QuoteDTO;

/**
 * Class QuoteAssembler
 */
class QuoteAssembler
{
    /**
     * @param string|null $quote
     * @param string|null $author
     *
     * @return QuoteDTO
     */
    public function writeDTO(?string $quote, ?string $author): QuoteDTO
    {
        return new QuoteDTO($quote, $author);
    }

    /**
     * @param array $quoteList
     *
     * @return array
     */
    public function convertQuote(array $quoteList): array
    {
        $convert = [];

        foreach ($quoteList as $quote) {
            $quoteDTO = $this->writeDTO($quote->getQuote(), null);
            $convert[] = $quoteDTO->getQuote();
        }

        return $convert;
    }
}
