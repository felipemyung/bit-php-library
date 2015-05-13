<?php

namespace BandsInTownApi;

use BandsInTownApi\Components\DateRequested\Date;
use BandsInTownApi\Components\DateRequested\DateRange;
use BandsInTownApi\Components\Exceptions\InvalidApiKeyException;
use BandsInTownApi\Components\Exceptions\InvalidParameterException;
use BandsInTownApi\Components\Exceptions\RequestFailedException;
use BandsInTownApi\Components\Location\CityCountryLocation;
use BandsInTownApi\Components\Location\CityStateLocation;
use BandsInTownApi\Components\Location\LatLonLocation;

/**
 * Class BandsInTownApi
 *
 * @package BandsInTownApi
 */
class BandsInTownApi
{

    /**
     * Holds the api key
     *
     * @var null|string
     */
    protected $apiKey = null;

    /**
     * When enabled makes all curl calls be more verbose
     *
     * @var bool
     */
    protected $debug = false;

    /**
     * Holds the api version
     *
     * @var string
     */
    protected $apiVersion = '2.0';

    /**
     * Holds the base url to access the api
     *
     * @var string
     */
    protected $baseUrl = 'http://api.bandsintown.com/';

    /**
     * Holds the user agent
     *
     * @var string
     */
    protected $userAgent = "BandsInTown PHP Library (V1.0)";

    /**
     * @param string $apiKey Api key used to identify the application
     * @param bool   $debug  When enabled makes all curl calls be more verbose
     *
     * @return BandsInTownApi
     * @throws InvalidApiKeyException
     */
    public function __construct($apiKey, $debug = false)
    {
        if (empty($apiKey)) {
            throw new InvalidApiKeyException();
        }
        $this->apiKey = urlencode($apiKey);
        $this->debug  = $debug;
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param string $artistName
     *
     * @return array
     * @throws InvalidParameterException
     * @throws RequestFailedException
     */
    public function getArtist($artistName)
    {
        // validations
        $this->validateArtistName($artistName);

        // escape artist name
        $artistName = urlencode($artistName);

        // get data
        $data = $this->makeCall("artists/{$artistName}");

        // return data
        return $data;
    }

    /**
     * @param string                $artistName
     * @param string|Date|DateRange $dateRequested
     *
     * @return array
     * @throws InvalidParameterException
     * @throws RequestFailedException
     */
    public function getEventsForSingleArtist($artistName, $dateRequested = 'upcoming')
    {
        // normalize $dateRequested if string
        $dateRequested = (is_string($dateRequested)) ? mb_strtolower($dateRequested) : $dateRequested;

        // validations
        $this->validateArtistName($artistName);
        $this->validateDateRequested($dateRequested);

        // escape artist name
        $artistName = urlencode($artistName);

        // additional parameters
        $additionalParameters = array(
            'date' => (string)$dateRequested,
        );

        // get data
        $data = $this->makeCall("artists/{$artistName}/events", $additionalParameters);

        // return data
        return $data;
    }

    /**
     * @param string                $artistName
     * @param string                $location
     * @param int                   $radius
     * @param string|Date|DateRange $dateRequested
     *
     * @return array
     * @throws InvalidParameterException
     * @throws RequestFailedException
     */
    public function eventSearch($artistName, $location, $radius = 25, $dateRequested = 'upcoming')
    {
        // normalize $dateRequested if string
        $dateRequested = (is_string($dateRequested)) ? mb_strtolower($dateRequested) : $dateRequested;

        // normalize $location if string
        $location = (is_string($location)) ? mb_strtolower($location) : $location;

        // validations
        $this->validateArtistName($artistName);
        $this->validateLocation($location);
        $this->validateRadius($radius);
        $this->validateDateRequested($dateRequested);

        // escape artist name
        $artistName = urlencode($artistName);

        // additional parameters
        $additionalParameters = array(
            'location' => (string)$location,
            'radius'   => (string)$radius,
            'date'     => (string)$dateRequested,
        );

        // get data
        $data = $this->makeCall("artists/{$artistName}/events/search", $additionalParameters);

        // return data
        return $data;
    }

    /**
     * @param string                $artistName
     * @param string                $location
     * @param int                   $radius
     * @param string|Date|DateRange $dateRequested
     * @param bool                  $onlyRecs
     *
     * @return array
     * @throws InvalidParameterException
     * @throws RequestFailedException
     */
    public function recommendedEvents($artistName, $location, $radius = 25, $dateRequested = 'upcoming', $onlyRecs = false)
    {
        // normalize $dateRequested if string
        $dateRequested = (is_string($dateRequested)) ? mb_strtolower($dateRequested) : $dateRequested;

        // normalize $location if string
        $location = (is_string($location)) ? mb_strtolower($location) : $location;

        // validations
        $this->validateArtistName($artistName);
        $this->validateLocation($location);
        $this->validateRadius($radius);
        $this->validateDateRequested($dateRequested);

        // escape artist name
        $artistName = urlencode($artistName);

        // additional parameters
        $additionalParameters = array(
            'location'  => (string)$location,
            'radius'    => (string)$radius,
            'date'      => (string)$dateRequested,
            'only_recs' => ($onlyRecs) ? 'true' : 'false',
        );

        // get data
        $data = $this->makeCall("artists/{$artistName}/events/recommended", $additionalParameters);

        // return data
        return $data;
    }

    /**
     * @param mixed $artistName
     *
     * @throws InvalidParameterException
     */
    protected function validateArtistName($artistName = null)
    {
        if (!is_string($artistName)) {
            throw new InvalidParameterException('invalid artist name format');
        }
        if (empty($artistName)) {
            throw new InvalidParameterException('artist name can not be empty');
        }
    }

    /**
     * @param mixed $dateRequested
     *
     * @throws InvalidParameterException
     */
    protected function validateDateRequested($dateRequested = null)
    {
        if (!is_object($dateRequested) && !is_string($dateRequested)) {
            throw new InvalidParameterException('invalid date requested format');
        }
        if (is_object($dateRequested) && !$dateRequested instanceof Date && !$dateRequested instanceof DateRange) {
            throw new InvalidParameterException('date requested object must be an instance of `Date` or `DateRange`');
        } else if (is_string($dateRequested) && !in_array($dateRequested, array('upcoming', 'all'))) {
            throw new InvalidParameterException('date requested string must be `upcoming` or `all`');
        }
    }

    /**
     * @param mixed $location
     *
     * @throws InvalidParameterException
     */
    protected function validateLocation($location = null)
    {
        if (!is_object($location) && !is_string($location)) {
            throw new InvalidParameterException('invalid location format');
        }
        if (is_object($location) && !$location instanceof CityCountryLocation && !$location instanceof CityStateLocation && !$location instanceof LatLonLocation) {
            throw new InvalidParameterException('location object must be an instance of `CityCountryLocation`, `CityStateLocation` or `LatLonLocation`');
        } else if (is_string($location) && $location !== 'use_geoip') {
            throw new InvalidParameterException('location string must be `use_geoip`');
        }
    }

    /**
     * @param mixed $radius
     *
     * @throws InvalidParameterException
     */
    protected function validateRadius($radius = null)
    {
        if (!is_int($radius)) {
            throw new InvalidParameterException('invalid radius format');
        }
        if ($radius > 150) {
            throw new InvalidParameterException('maximum radius is 150');
        }
    }

    /**
     * @param string $urlPath    The path to access
     * @param array  $parameters Additional parameters to send
     *
     * @return array
     * @throws RequestFailedException
     */
    protected function makeCall($urlPath, $parameters = array())
    {
        // Mount parameters to send
        $paramsToSend = array_merge(
            $parameters,
            array(
                'app_id'      => $this->apiKey,
                'api_version' => $this->apiVersion,
            )
        );

        // mount the main URL
        $mainUrl = rtrim($this->baseUrl, '/') . '/' . $urlPath . '.json?' . http_build_query($paramsToSend);

        // curl call
        $httpCode = 0;
        $response = '';
        extract($this->curl($mainUrl), EXTR_OVERWRITE);

        // check the response
        if ($httpCode == 200) {
            return $this->decodeResponse($response);
        } else if ($httpCode == 404) {
            $decodedResponse = $this->decodeResponse($response);
            throw new RequestFailedException("request was returned with a failing httpCode: {$httpCode}");
        } else {
            throw new RequestFailedException("request was returned with a failing httpCode: {$httpCode}");
        }
    }

    /**
     * @param string $rawResponse
     *
     * @return array
     * @throws RequestFailedException
     */
    protected function decodeResponse($rawResponse)
    {
        $decodedResponse = json_decode($rawResponse, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new RequestFailedException('failed to decode response');
        }
        if (!is_array($decodedResponse)) {
            throw new RequestFailedException('invalid response format');
        }
        if (array_key_exists('errors', $decodedResponse)) {
            $implodedErrors = implode(', ', $decodedResponse['errors']);
            throw new RequestFailedException("request returned a list of errors: ({$implodedErrors})");
        }
        return $decodedResponse;
    }

    /**
     * Abstract curl calls
     *
     * @param string $url
     *
     * @return array
     */
    protected function curl($url)
    {
        // mount curl parameters
        $curlParameters = array(
            CURLOPT_URL            => $url,
            CURLOPT_USERAGENT      => $this->userAgent,
            CURLOPT_VERBOSE        => $this->debug,
            CURLOPT_NOBODY         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
        );

        // init the curl
        $ch = curl_init();
        curl_setopt_array($ch, $curlParameters);

        // execute the curl
        $response = curl_exec($ch);

        // get the http code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // close the curl
        curl_close($ch);

        // response
        return array(
            'httpCode' => $httpCode,
            'response' => $response,
        );
    }
}