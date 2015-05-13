<?php

namespace BandsInTownApi\Components\DateRequested;

use BandsInTownApi\Components\DateRequested\DateRange;

/**
 * Class BandsInTownApi\Components\DateRequested\DateRangeTest
 *
 * Test of Class BandsInTownApi\Components\DateRequested\DateRange
 *
 * @createdAt 2015-05-13
 *
 * @library BandsInTownApi
 * @author Felipe Freitas
 */
class DateRangeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testMustFormatACorrectString()
    {
        $dateObject = new DateRange(new \DateTime('2015-05-13 12:00:00'), new \DateTime('2015-05-14 12:00:00'));
        $this->assertEquals('2015-05-13,2015-05-14', (string)$dateObject);
    }

    /**
     * @return void
     */
    public function testSettersAndGetters()
    {
        $startDate = new \DateTime('2015-05-13 12:00:00');
        $endDate   = new \DateTime('2015-05-14 12:00:00');
        $dateObject = new DateRange($startDate, $endDate);
        $this->assertSame($startDate, $dateObject->getStartDate());
        $this->assertSame($endDate,   $dateObject->getEndDate());
        $newStartDate = new \DateTime('2015-05-12 10:00:00');
        $newEndDate   = new \DateTime('2015-05-13 10:00:00');
        $dateObject->setStartDate($newStartDate);
        $dateObject->setEndDate($newEndDate);
        $this->assertSame($newStartDate, $dateObject->getStartDate());
        $this->assertSame($newEndDate,   $dateObject->getEndDate());
    }
}