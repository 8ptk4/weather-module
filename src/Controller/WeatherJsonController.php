<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class WeatherJsonController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;

    /**
     * Request get and setup json array.
     * @method indexAction
     * @return array
     */
    public function indexActionGet() : array
    {
        $title = "Weather";
        $location = htmlentities($this->di->get("request")->getGet("location"));
        $weather = $this->di->get("weather");
        
        $json = [
            "title" => $title,
            "location" => $location,
            "geocode" => $weather->loadGeolocation($location),
            "weather" => $weather->loadWeather(),
            "historic" => $weather->multiCurl()
        ];

        return [$json];
    }
}
