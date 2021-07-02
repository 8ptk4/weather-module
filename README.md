# weather-module

[![Build Status](https://travis-ci.com/8ptk4/weather-module.svg?branch=master)](https://travis-ci.com/github/8ptk4/weather-module)
[![CircleCI](https://circleci.com/gh/8ptk4/weather-module/tree/master.svg?style=svg)](https://circleci.com/gh/8ptk4/weather-module/tree/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/8ptk4/weather-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/8ptk4/weather-module/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/8ptk4/weather-module/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/8ptk4/weather-module/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/8ptk4/weather-module/badges/build.png?b=master)](https://scrutinizer-ci.com/g/8ptk4/weather-module/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/8ptk4/weather-module/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## Installation into an existing Anax installation

Inside composer.json add the following:

<pre>
    "require": {
        "anax/anax-ramverk1-me": "^1.0.0",
        "8ptk4/weather": "VERSION HERE"
    },
</pre>

Then, run the command 'composer update' in the terminal.

Lastly run this command:
<pre>
    bash vendor/8ptk4/weather/.anax/scaffold/postprocess.d/700_weather.bash
</pre>
