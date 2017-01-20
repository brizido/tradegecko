<?php

namespace Brizido\Tradegecko\Tests;

use Brizido\Tradegecko\Tradegecko;

class ConnectionTest extends \PHPUnit_Framework_TestCase {

    public function testConnect()
    {
        $tradegecko = new Tradegecko(getenv('TRADEGECKO_APPLICATION_ID'), getenv('TRADEGECKO_SECRET'));
        $tradegecko->authorizeFromExisting(getenv('TRADEGECKO_PRIVILEGED_ACCESS_TOKEN'));
        $accounts = $tradegecko->get('contacts');
        $this->assertNotNull($accounts);
    }
}