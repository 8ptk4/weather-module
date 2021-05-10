<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather JSON",
            "mount" => "weather_api",
            "handler" => "\Anax\Controller\WeatherJsonController",
        ],
    ]
];
