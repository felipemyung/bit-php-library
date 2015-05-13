<?php

namespace BandsInTownApi\Components\DateRequested;

use BandsInTownApi\Components\DateRequested\Date;

/**
 * Class BandsInTownApi\Components\DateRequested\DateTest
 *
 * Test of Class BandsInTownApi\Components\DateRequested\Date
 *
 * @createdAt 2015-05-13
 *
 * @library BandsInTownApi
 * @author Felipe Freitas
 */
class DateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testMustFormatACorrectString()
    {
        $dateObject = new Date(new \DateTime('2015-05-13 12:00:00'));
        $this->assertEquals('2015-05-13', (string)$dateObject);
    }

    /**
     * @return void
     */
    public function testSetterAndGetter()
    {
        $date = new \DateTime('2015-05-13 12:00:00');
        $dateObject = new Date($date);
        $this->assertSame($date, $dateObject->getDate());
        $newDate = new \DateTime('2015-05-12 10:00:00');
        $dateObject->setDate($newDate);
        $this->assertSame($newDate, $dateObject->getDate());
    }
}