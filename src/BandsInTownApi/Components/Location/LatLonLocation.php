<?php

namespace BandsInTownApi\Components\Location;

/**
 * Class LatLonLocation
 *
 * @package BandsInTownApi\Components\Location
 */
class LatLonLocation
{

    /**
     * @var null|float
     */
    protected $lat = null;

    /**
     * @var null|float
     */
    protected $lon = null;

    /**
     * @param float $lat
     * @param float $lon
     *
     * @return LatLonLocation
     */
    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * @param null|float $lat
     *
     * @return LatLonLocation
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return null|float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param null|float $lon
     *
     * @return LatLonLocation
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return null|float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->lat . ',' . (string)$this->lon;
    }
} 