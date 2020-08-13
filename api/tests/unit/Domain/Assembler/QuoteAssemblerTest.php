<?php

namespace App\Tests\Domain\Assembler;


use App\Domain\Assembler\QuoteAssembler;
use App\Domain\DTO\QuoteDTO;
use Mockery;

/**
 * Class QuoteAssemblerTest.
 */
class QuoteAssemblerTest extends \Codeception\Test\Unit
{
    /**
     * testWriteDTO
     */
    public function testWriteDTO()
    {
        $quoteAssembler = new QuoteAssembler();
        $this->assertInstanceOf(QuoteDTO::class, $quoteAssembler->writeDTO(null, null));
    }

    /**
     * testConvertQuote
     */
    public function testConvertQuote()
    {
        $quote = Mockery::mock('App\Infrastructure\Services\External\Quotes\Quote');
        $quote->shouldReceive('getQuote')->andReturn(null);

        $quoteAssembler = new QuoteAssembler();
        $this->assertIsArray($quoteAssembler->convertQuote([$quote]));
    }
}
