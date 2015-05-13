<?php

namespace BandsInTownApi\Components\Location;

/**
 * Class CityStateLocation
 *
 * @package BandsInTownApi\Components\Location
 */
class CityStateLocation
{

    /**
     * @var null|string
     */
    protected $city = null;

    /**
     * @var null|string
     */
    protected $state = null;

    /**
     * @param string $city
     * @param string $state
     *
     * @return CityStateLocation
     */
    public function __construct($city, $state)
    {
        $this->city  = $city;
        $this->state = $state;
    }

    /**
     * @param null|string $city
     *
     * @return CityStateLocation
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param null|string $state
     *
     * @return CityStateLocation
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return urlencode($this->city) . ',' . mb_strtoupper($this->state);
    }
} 