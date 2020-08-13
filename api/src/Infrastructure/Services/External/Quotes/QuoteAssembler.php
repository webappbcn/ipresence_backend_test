<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Infrastructure\Services\External\Quotes;

/**
 * Class QuoteAssembler
 */
class QuoteAssembler
{
    /**
     * @param string|null $quote
     * @param string|null $author
     *
     * @return Quote
     */
    public function writeDTO(?string $quote, ?string $author): Quote
    {
        return new Quote($quote, $author);
    }
}
