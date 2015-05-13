<?php

namespace BandsInTownApi\Components\DateRequested;

/**
 * Class DateRange
 *
 * @package BandsInTownApi\Components\DateRequested
 */
class Date
{

    /**
     * @var null|\DateTime
     */
    protected $date = null;

    /**
     * @param \DateTime $date
     *
     * @return Date
     */
    public function __construct(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->date->format('Y-m-d');
    }
}