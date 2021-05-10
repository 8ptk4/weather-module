<?php

namespace Anax\Models;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Models\Ipstack;
use Anax\Request\Request;

/**
 * Test the WeatherControllerModel.
 */
class WeatherControllerTest extends TestCase
{


    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di = $this->di;
        $di->request = new Request();
        $di->request->setGlobals(
            [
                'post' => [
                    'city' => "karlskrona",
                    'faulty' => 'asdasdasd',
                ]
            ]
        );

        $this->controller = $this->di->get("weather");
    }



    /**
     * Test loadGeolocation with correct city.
     * @method testLoadGeoLocationCorrectValues
     */
    public function testLoadGeolocationCorrectValues()
    {
        $this->controller->location = $this->di->request->getPost('city');
        $returnedArr = $this->controller->loadGeolocation($this->di->request->getPost('city'));
        
        $this->assertInternalType('array', $returnedArr);
        $this->assertInternalType('string', $returnedArr['latitude']);
        $this->assertInternalType('string', $returnedArr['longitude']);
        $this->assertInternalType('array', $returnedArr['geolocation']);
        $this->assertEquals('success', $returnedArr['status']);
    }



    /**
     * Test loadGeolocation with faulty city..
     * @method testLoadGeolocationFaultyLocation
     */
    public function testLoadGeolocationFaultyLocation()
    {
        $faulty = $this->di->request->getPost('faulty');
        $returnedArr = $this->controller->loadGeolocation($faulty);
        
        $this->assertInternalType('array', $returnedArr);
        $this->assertEquals('error', $returnedArr['status'], "{$faulty} couldnt be converted to a lontitude, latitude");
    }



    /**
     * Test loading weather data.
     * @method testLoadWeather
     */
    public function testLoadWeather()
    {
        $this->controller->location = $this->di->request->getPost('city');
        $geo = $this->controller->loadGeolocation($this->di->request->getPost('city'));
        $weather = $this->controller->loadWeather();
        
        $this->assertInternalType('array', $weather);
    }



    /**
     * Test that multi curl returns data.
     * @method testMultiCurl
     */
    public function testMultiCurl()
    {
        $this->controller->location = $this->di->request->getPost('city');
        $geo = $this->controller->loadGeolocation($this->di->request->getPost('city'));
        $mcWeather = $this->controller->multiCurl();

        $this->assertInternalType('array', $mcWeather);
    }
}
