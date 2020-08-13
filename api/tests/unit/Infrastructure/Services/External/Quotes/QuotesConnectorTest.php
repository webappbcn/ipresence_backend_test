<?php

namespace App\Tests\Infrastructure\Services\External\Quotes;

use App\Infrastructure\Services\External\Quotes\QuotesConnector;

/**
 * Class QuotesConnectorTest.
 */
class QuotesConnectorTest extends \Codeception\Test\Unit
{
    /**
     * testFilter
     */
    public function testWriteDTO()
    {
        $quotesConnector = new QuotesConnector();
        $this->assertIsArray($quotesConnector->getQuotes('test', 1));
    }
}