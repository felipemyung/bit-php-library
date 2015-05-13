<?php

namespace BandsInTownApi\Components\DateRequested;

/**
 * Class DateRange
 *
 * @package BandsInTownApi\Components\DateRequested
 */
class DateRange
{

    /**
     * @var null|\DateTime
     */
    protected $startDate = null;

    /**
     * @var null|\DateTime
     */
    protected $endDate = null;

    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @return DateRange
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }
    
    /**
     * @param \DateTime $endDate
     *
     * @return DateRange
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return DateRange
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return
            $this->startDate->format('Y-m-d')
            . ','
            . $this->endDate->format('Y-m-d')
        ;
    }
}