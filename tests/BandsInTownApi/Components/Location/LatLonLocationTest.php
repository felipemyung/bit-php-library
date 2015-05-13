<?php

namespace BandsInTownApi\Components\Location;

use BandsInTownApi\Components\Location\LatLonLocation;

/**
 * Class BandsInTownApi\Components\Location\LatLonLocationTest
 *
 * Test of Class BandsInTownApi\Components\Location\LatLonLocation
 *
 * @createdAt 2015-05-13
 *
 * @library BandsInTownApi
 * @author Felipe Freitas
 */
class LatLonLocationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testMustFormatACorrectString()
    {
        $locationObject = new LatLonLocation(51.6166667, 13.3166667);
        $this->assertEquals('51.6166667,13.3166667', (string)$locationObject);
    }

    /**
     * @return void
     */
    public function testSetterAndGetter()
    {
        $locationObject = new LatLonLocation(51.6166667, 13.3166667);
        $this->assertEquals(51.6166667, $locationObject->getLat());
        $this->assertEquals(13.3166667, $locationObject->getLon());
        $locationObject->setLat(51.5166667);
        $locationObject->setLon(7.05);
        $this->assertEquals(51.5166667, $locationObject->getLat());
        $this->assertEquals(7.05,       $locationObject->getLon());
    }
}