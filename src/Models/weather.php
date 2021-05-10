<?php

namespace Anax\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Weather implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;

    /**
     * location, geolocation and accesskey
     * @var array
     */
    public $location;
    public $geolocation;
    protected $accessKey;



    /**
     * Set access key for openweather.
     * @method __construct
     */
    public function __construct()
    {
        $prep = require ANAX_INSTALL_PATH . "/config/keys.php";
        $this->accessKey = $prep["openWeather"];
    }



    /**
     * Convert input from page form into latitude and longitud.
     * @method loadGeolocation
     * @param  string      $location
     * @return array
     */
    public function loadGeolocation(string $location)
    {
        $this->location = html_entity_decode($location);

        $base = 'https://nominatim.openstreetmap.org/';
        $init = curl_init("{$base}?format=json&addressdetails=1&q={$this->location}&limit=1&email=none@none.se");
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($init);
        curl_close($init);

        $geoArr = json_decode($json, true);

        if (!$this->location) :
            $this->geolocation = array(
                "status" => "error",
                "message" => "No input detected"
            );
        elseif ($geoArr == null) :
            $this->geolocation = array(
                "status" => "error",
                "message" => "{$location} couldnt be converted to a lontitud, latitude"
            );
        else :
            $this->geolocation = array(
                "latitude" => $geoArr[0]['lat'],
                "longitude" => $geoArr[0]['lon'],
                "status" => "success",
                "geolocation" => $geoArr[0]['address']
            );
        endif;

        return $this->geolocation;
    }



    /**
     * Load 7 upcoming weather data from "openweathermap" - no multicurl!
     * @method loadWeather
     * @return array
     */
    public function loadWeather()
    {
        if ($this->geolocation['status'] == "success") :
            $base = 'https://api.openweathermap.org/data/2.5/';
            $init = curl_init("{$base}onecall?lat={$this->geolocation['latitude']}&lon={$this->geolocation['longitude']}&units=metric&exclude=current,minutely,hourly,alerts&appid={$this->accessKey}");
            curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($init);
            curl_close($init);

            return json_decode($json, true);
        endif;
    }



    /**
     * Multicurl for historic data "openweathermap".
     * @method multiCurl
     * @return array
     */
    public function multiCurl()
    {
        if ($this->geolocation['status'] == "success") :
            $nodes = $this->convertDays(5);

            $nodeCount = count($nodes);
            
            $curlArr = array();
            $master = curl_multi_init();

            for ($i = 0; $i < $nodeCount; $i++)
            {
                $url =$nodes[$i];
                $curlArr[$i] = curl_init($url);
                curl_setopt($curlArr[$i], CURLOPT_RETURNTRANSFER, true);
                curl_multi_add_handle($master, $curlArr[$i]);
            }

            do {
                curl_multi_exec($master, $running);
            } while ($running > 0);

            $data = array();

            for ($i = 0; $i < $nodeCount; $i++)
            {
                $results = curl_multi_getcontent($curlArr[$i]);
                array_push($data, json_decode($results, true));
            }
            return $data;
        endif;
    }



    /**
     * Convert days end prepare URL:s for multicurl.
     * @method convertDays
     * @param  int      $days
     * @return array
     */
    public function convertDays(int $days)
    {
        $arr = array();

        $startdate = strtotime("-{$days} days");
        $enddate = strtotime("+{$days} days", $startdate);
        
        while ($startdate < $enddate) {
            array_push($arr, "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat={$this->geolocation['latitude']}&lon={$this->geolocation['longitude']}&unit=metrics&dt={$startdate}&appid={$this->accessKey}");
            $startdate = strtotime("+1 day", $startdate);
        }
        
        return $arr;
    }
}
