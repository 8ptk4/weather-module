# weather-module

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
