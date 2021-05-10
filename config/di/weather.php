<?php
/**
 * Configuration file for request service.
 */
return [
    // Services to add to the container.
    "services" => [
        "weather" => [
            "shared" => true,
            "callback" => function () {
                $weather = new Anax\Models\weather;
                return $weather;
            }
        ],
    ],
];
