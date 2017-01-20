<?php

namespace Brizido\Tradegecko\Tests;

use Brizido\Tradegecko\Consumer;

class ConsumerTest extends \PHPUnit_Framework_TestCase {

    public function testToString()
    {
        $key = uniqid();
        $secret = uniqid();
        $consumer = new Consumer($key, $secret);
        $this->assertEquals("Consumer[application_id=$key,secret=$secret]", $consumer->__toString());
    }

}