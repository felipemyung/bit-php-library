<?php

namespace BandsInTownApi\Components\Location;

use BandsInTownApi\Components\Location\CityStateLocation;

/**
 * Class BandsInTownApi\Components\Location\CityStateLocationTest
 *
 * Test of Class BandsInTownApi\Components\Location\CityStateLocation
 *
 * @createdAt 2015-05-13
 *
 * @library BandsInTownApi
 * @author Felipe Freitas
 */
class CityStateLocationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testMustFormatACorrectString()
    {
        $locationObject = new CityStateLocation('San Diego', 'ca');
        $this->assertEquals('San+Diego,CA', (string)$locationObject);
    }

    /**
     * @return void
     */
    public function testSetterAndGetter()
    {
        $locationObject = new CityStateLocation('city', 'state');
        $this->assertEquals('city',  $locationObject->getCity());
        $this->assertEquals('state', $locationObject->getState());
        $locationObject->setCity('new-city');
        $locationObject->setState('new-state');
        $this->assertEquals('new-city',  $locationObject->getCity());
        $this->assertEquals('new-state', $locationObject->getState());
    }
}