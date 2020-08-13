<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Tests\Infrastructure\Services\External\Quotes;

use App\Infrastructure\Services\External\Quotes\QuotesRepository;

/**
 * Class QuotesRepositoryTest.
 */
class QuotesRepositoryTest extends \Codeception\Test\Unit
{
    /**
     * testFilter
     */
    public function testFilter()
    {
        $qr = new QuotesRepository();
        $this->assertIsArray($qr->filter('test', 1));
    }
}