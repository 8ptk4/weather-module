---
---
API documentation weather
=========================

Weather API that returns the forcast for 7 upcoming days
and 5 previous days.

#### Try it
Example with city:<br>
[/weather_api?location=flen](http://www.student.bth.se/~paka17/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weather_api?location=flen)

Example with latitude, longitude:<br>
[/weather_api?location=59.05586984999999,16.752681656026375](http://www.student.bth.se/~paka17/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weather_api?location=59.05586984999999,16.752681656026375)

Example with adress:<br>
[/weather_api?location=scheelegatan, flen](http://www.student.bth.se/~paka17/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weather_api?location=scheelegatan,flen)

#### Get the dataset
The dataset can be of the following values:

city: `/weather_api?location=flen`<br> 
city, country: `/weather_api?location=flen, sverige`<br> 
country: `/weather_api?location=sverige`<br>
adress: `/weather_api?location=scheelegatan`<br>
adress, city: `/weather_api?location=scheelegatan, flen`<br>
latitude, longitude: `/weather_api?location=59.05,16.75`<br>

#### GET
```
GET /weather_api?location=[dataset]
GET /weather_api?location=flen
```
Results
```
{
    "title": "Weather",
    "location": "flen",
    "geocode": {
        "latitude": "59.05586984999999",
        "longitude": "16.752681656026375",
        "status": "success",
        "geolocation": {
            "municipality": "Flens kommun",
            "state": "S\u00f6dermanlands l\u00e4n",
            "region": "Svealand",
            "country": "Sverige",
            "country_code": "se"
        }
    },
    "weather": {
        "lat": 59.06,
        "lon": 16.75,
        "timezone": "Europe/Stockholm",
        "timezone_offset": 3600,
        "daily": [
            {
                "dt": 1605952800,
                "sunrise": 1605942009,
                "sunset": 1605968286,
                "temp": {
                    "day": 3.83,
    ...
    "historic": [
        {
            "lat": 59.06,
            "lon": 16.75,
            "timezone": "Europe/Stockholm",
            "timezone_offset": 3600,
            "current": {
                "dt": 1605558530,
                "sunrise": 1605509310,
                "sunset": 1605536845,
                "temp": 282.39,
                "feels_like": 278.16,
                "pressure": 1012,
                "humidity": 87,
                "dew_point": 280.34,
                "uvi": 0.31,
                "clouds": 75,
                "visibility": 10000,
                "wind_speed": 5.1,
                "wind_deg": 210,
                "weather": [
                    {
                        "id": 803,
                        "main": "Clouds",
                        "description": "broken clouds",
                        "icon": "04n"
                    }
                ]
            },
            "hourly": [
                {
                    "dt": 1605484800,
                    "temp": 283.32,
                    "feels_like": 278.44,
                    "pressure": 1013,
                    "humidity": 93,
                    "dew_point": 282.24,
``` 