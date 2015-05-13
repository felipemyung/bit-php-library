<?php

namespace BandsInTownApi\Components\Location;

/**
 * Class CityCountryLocation
 *
 * @package BandsInTownApi\Components\Location
 */
class CityCountryLocation
{

    /**
     * @var null|string
     */
    protected $city = null;

    /**
     * @var null|string
     */
    protected $country = null;

    /**
     * @param string $city
     * @param string $country
     *
     * @return CityCountryLocation
     */
    public function __construct($city, $country)
    {
        $this->city    = $city;
        $this->country = $country;
    }

    /**
     * @param null|string $city
     *
     * @return CityCountryLocation
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
     * @param null|string $country
     *
     * @return CityCountryLocation
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return urlencode($this->city) . ',' . urlencode($this->country);
    }
} 