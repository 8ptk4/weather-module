<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class WeatherController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;

    /**
     * Request post and setup page.
     * @method indexAction
     * @return array
     */
    public function indexAction() : object
    {
        $title = "Weather";

        $location = htmlentities($this->di->get("request")->getPost("location"));
        $weather = $this->di->get("weather");
        $page = $this->di->get("page");

        $page->add("anax/weather/index", [
            "title" => $title,
            "location" => $location,
            "geolocation" => $weather->loadGeolocation($location),
            "weather" => $weather->loadWeather(),
            "historic" => $weather->multiCurl(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
