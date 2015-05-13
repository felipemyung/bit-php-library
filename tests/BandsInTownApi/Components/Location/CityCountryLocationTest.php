<?php

namespace BandsInTownApi\Components\Location;

use BandsInTownApi\Components\Location\CityCountryLocation;

/**
 * Class BandsInTownApi\Components\Location\CityCountryLocationTest
 *
 * Test of Class BandsInTownApi\Components\Location\CityCountryLocation
 *
 * @createdAt 2015-05-13
 *
 * @library BandsInTownApi
 * @author Felipe Freitas
 */
class CityCountryLocationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testMustFormatACorrectString()
    {
        $locationObject = new CityCountryLocation('London', 'United Kingdom');
        $this->assertEquals('London,United+Kingdom', (string)$locationObject);
    }

    /**
     * @return void
     */
    public function testSetterAndGetter()
    {
        $locationObject = new CityCountryLocation('city', 'country');
        $this->assertEquals('city',    $locationObject->getCity());
        $this->assertEquals('country', $locationObject->getCountry());
        $locationObject->setCity('new-city');
        $locationObject->setCountry('new-country');
        $this->assertEquals('new-city',    $locationObject->getCity());
        $this->assertEquals('new-country', $locationObject->getCountry());
    }
}