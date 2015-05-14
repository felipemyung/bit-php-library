<?php

namespace BandsInTownApi;

use BandsInTownApi\BandsInTownApi;
use BandsInTownApi\Components\DateRequested\DateRange;
use BandsInTownApi\Components\Location\CityCountryLocation;

/**
 * Class BandsInTownApi\BandsInTownApiTest
 *
 * Test of Class BandsInTownApi\BandsInTownApi
 *
 * @createdAt 2015-05-12
 *
 * @library BandsInTownApi
 * @author Felipe Freitas
 */
class BandsInTownApiTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testGetApiVersion()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $this->assertEquals('2.0', $bandsInTownApi->getApiVersion());
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidApiKeyException
     * @expectedExceptionMessage invalid api key
     *
     * @return void
     */
    public function testConstructorMustThrownExceptionInvalidApiKey()
    {
        $bandsInTownApi = new BandsInTownApi('');
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage invalid artist name format
     *
     * @return void
     */
    public function testGetArtistMustThrownExceptionWithInvalidFormatOfName()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getArtist(array('invalid format'));
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage artist name can not be empty
     *
     * @return void
     */
    public function testGetArtistMustThrownExceptionWithEmptyName()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getArtist('');
    }

    /**
     * @return void
     */
    public function testGetArtistMustReturnDataArray()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getArtist('beatles');
        $this->assertTrue(is_array($data));
        $this->assertArrayHasKey('name', $data);
        $this->assertEquals('The Beatles', $data['name']);
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\RequestFailedException
     * @expectedExceptionMessage request returned a list of errors: (Unknown Artist)
     *
     * @return void
     */
    public function testGetArtistMustThrownExceptionListOfErrors()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getArtist('invalidbandname_ihope');
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\RequestFailedException
     * @expectedExceptionMessage request was returned with a failing httpCode: 404
     *
     * @return void
     */
    public function testGetArtistMustThrownExceptionReturned404HttpCode()
    {
        // Create a stub for the BandsInTownApi class.
        /* @var BandsInTownApi $stub */
        $stub = $this
            ->getMockBuilder('\\BandsInTownApi\\BandsInTownApi')
            ->setConstructorArgs(array('test_api_key'))
            ->setMethods(array('curl'))
            ->getMock()
        ;
        // Configure the stub.
        $stub->method('curl')->willReturn(
            array(
                'httpCode' => 404,
                'response' => '[]',
            )
        );
        // call the method to trigger exception
        $data = $stub->getArtist('none');
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\RequestFailedException
     * @expectedExceptionMessage request was returned with a failing httpCode: 505
     *
     * @return void
     */
    public function testGetArtistMustThrownExceptionReturned505HttpCode()
    {
        // Create a stub for the BandsInTownApi class.
        /* @var BandsInTownApi $stub */
        $stub = $this
            ->getMockBuilder('\\BandsInTownApi\\BandsInTownApi')
            ->setConstructorArgs(array('test_api_key'))
            ->setMethods(array('curl'))
            ->getMock()
        ;
        // Configure the stub.
        $stub->method('curl')->willReturn(
            array(
                'httpCode' => 505,
                'response' => '[]',
            )
        );
        // call the method to trigger exception
        $data = $stub->getArtist('none');
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\RequestFailedException
     * @expectedExceptionMessage failed to decode response
     *
     * @return void
     */
    public function testGetArtistMustThrownExceptionFailedToDecodeResponse()
    {
        // Create a stub for the BandsInTownApi class.
        /* @var BandsInTownApi $stub */
        $stub = $this
            ->getMockBuilder('\\BandsInTownApi\\BandsInTownApi')
            ->setConstructorArgs(array('test_api_key'))
            ->setMethods(array('curl'))
            ->getMock()
        ;
        // Configure the stub.
        $stub->method('curl')->willReturn(
            array(
                'httpCode' => 200,
                'response' => '%invalid%',
            )
        );
        // call the method to trigger exception
        $data = $stub->getArtist('none');
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage invalid date requested format
     *
     * @return void
     */
    public function testGetEventsForSingleArtistMustThrownExceptionWithInvalidDateRequestedFormat()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getEventsForSingleArtist('name', array('invalid'));
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage date requested object must be an instance of `Date` or `DateRange`
     *
     * @return void
     */
    public function testGetEventsForSingleArtistMustThrownExceptionWithInvalidDateRequestedObject()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getEventsForSingleArtist('name', new \DateTime());
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage date requested string must be `upcoming` or `all`
     *
     * @return void
     */
    public function testGetEventsForSingleArtistMustThrownExceptionWithInvalidDateRequestedString()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getEventsForSingleArtist('name', 'InVaLid');
    }

    /**
     * @return void
     */
    public function testGetEventsForSingleArtistMustReturnDataArray()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->getEventsForSingleArtist('metallica');
        $this->assertTrue(is_array($data));
        if (!empty($data)) {
            $firstElement = reset($data);
            $this->assertArrayHasKey('id', $firstElement);
            $this->assertArrayHasKey('title', $firstElement);
        }
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage invalid location format
     *
     * @return void
     */
    public function testEventSearchMustThrownExceptionWithInvalidLocationFormat()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->eventSearch('name', array('invalid'));
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage location object must be an instance of `CityCountryLocation`, `CityStateLocation` or `LatLonLocation`
     *
     * @return void
     */
    public function testEventSearchMustThrownExceptionWithInvalidLocationObject()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->eventSearch('name', new \DateTime());
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage location string must be `use_geoip`
     *
     * @return void
     */
    public function testEventSearchMustThrownExceptionWithInvalidLocationString()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->eventSearch('name', 'invalid_string');
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage invalid radius format
     *
     * @return void
     */
    public function testEventSearchMustThrownExceptionWithInvalidRadiusFormat()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->eventSearch('name', 'use_geoip', array('invalid'));
    }

    /**
     * @expectedException        \BandsInTownApi\Components\Exceptions\InvalidParameterException
     * @expectedExceptionMessage maximum radius is 150
     *
     * @return void
     */
    public function testEventSearchMustThrownExceptionWithMaximumRadius()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->eventSearch('name', 'use_geoip', 200);
    }

    /**
     * @return void
     */
    public function testEventSearchMustReturnDataArray()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->eventSearch(
            'nas',
            new CityCountryLocation('London', 'United Kingdom'),
            150
        );
        $this->assertTrue(is_array($data));
        if (!empty($data)) {
            $firstElement = reset($data);
            $this->assertArrayHasKey('id', $firstElement);
            $this->assertArrayHasKey('title', $firstElement);
        }
    }

    /**
     * @return void
     */
    public function testRecommendedEventsMustReturnDataArray()
    {
        $bandsInTownApi = new BandsInTownApi('test_api_key');
        $data = $bandsInTownApi->recommendedEvents(
            'nas',
            new CityCountryLocation('London', 'United Kingdom'),
            150
        );
        $this->assertTrue(is_array($data));
        if (!empty($data)) {
            $firstElement = reset($data);
            $this->assertArrayHasKey('id', $firstElement);
            $this->assertArrayHasKey('title', $firstElement);
        }
    }
}