<?php

namespace App\Infrastructure\Services\External\Quotes;


/**
 * Class QuoteAssembler
 * @package App\Infrastructure\Services\External\Quotes
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
