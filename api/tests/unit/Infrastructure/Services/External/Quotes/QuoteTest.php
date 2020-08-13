<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Tests\Infrastructure\Services\External\Quotes;

use App\Infrastructure\Services\External\Quotes\Quote;

/**
 * Class QuoteTest.
 */
class QuoteTest extends \Codeception\Test\Unit
{
    /**
     * testQuote
     */
    public function testQuote()
    {
        $quote = new Quote('test', 'test');
        $this->assertIsString($quote->getQuote());
        $this->assertIsString($quote->getAuthor());
    }
}