<?php

namespace App\Tests\Infrastructure\Services\External\Quotes;

use App\Infrastructure\Services\External\Quotes\Quote;
use App\Infrastructure\Services\External\Quotes\QuoteAssembler;

/**
 * Class QuotesAssemblerTest.
 */
class QuotesAssemblerTest extends \Codeception\Test\Unit
{
    /**
     * testWriteDTO
     */
    public function testWriteDTO()
    {
        $quoteAssembler = new QuoteAssembler();
        $this->assertInstanceOf(Quote::class, $quoteAssembler->writeDTO(null, null));
    }
}