<?php

namespace Brizido\Tradegecko\Tests;

use Brizido\Tradegecko\Tradegecko;

class AddressTest extends \PHPUnit_Framework_TestCase {

    public function testCreateAddress()
    {
        $tradegecko = new Tradegecko(getenv('TRADEGECKO_APPLICATION_ID'), getenv('TRADEGECKO_SECRET'));
        $tradegecko->authorizeFromExisting(getenv('TRADEGECKO_PRIVILEGED_ACCESS_TOKEN'));
        $address = $tradegecko->addAddress(array(
            'company_id' => 11956025,
            'address1' => rand(1, 899),
            'address2' => 'Test Road',
            'city' => 'London',
            'country' => 'GB',
            'email' => 'testemail@gmail.com',
            'first_name' => 'John',
            'last_name' => 'Snow',
            'label' => 'Shipping',
            'phone_number' => '07884566543',
            'zip_code' => 'SW18 3TD'
        ));
    }
}