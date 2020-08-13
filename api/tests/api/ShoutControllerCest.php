<?php

namespace App\Tests;

/**
 * Class ShoutControllerCest.
 */
class ShoutControllerCest
{
    /**
     * @param ApiTester $I
     */
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
    }

    /**
     * testGetShoutOK
     */
    public function testGetShoutOK(ApiTester $I)
    {
        $I->wantToTest('test get shout OK');
        $I->sendGET('/shout/marie-curie?limit=1');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
    }

    /**
     * @param ApiTester $I
     */
    public function testGetShoutKO(ApiTester $I)
    {
        $I->wantToTest('test get shout KO');
        $I->sendGET('/shout/marie-curie?limit=test');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
    }
}