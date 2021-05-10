<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather",
            "mount" => "weather",
            "handler" => "\Anax\Controller\WeatherController",
        ]
    ]
];
