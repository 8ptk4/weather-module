<?php

namespace Anax\View;

/**
 * Result.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

// var_dump($historic);
?>

<?php if ($geolocation['status'] == "success") : ?>
    <h4>Forecast - latitud:
        <?= substr($geolocation['latitude'], 0, 5) ?>
        longitud:
        <?= substr($geolocation['longitude'], 0, 5) ?>
    </h4>
    <div style="display: flex; justify-content: space-between;">
        <div >
            <table style="width: 100%; padding-right: 10px">
                <?php foreach ($geolocation['geolocation'] as $key => $value) { ?>
                    <tr>
                        <td style="color: rgb(52, 101, 164); font-weight: bold;"><?= $key ?></td>
                        <td style="padding-left: 20px; color: rgba(52, 101, 164, .5);"><?= $value ?></td>
                    </tr>
                <?php } ?>
            </table>
            <span style="font-size: 30px; color: white;"><?= $weather['daily'][0]['temp']['day'] ?>&#176</span>
            <span style="color: white;"> today</span>
        </div>
        <div id="mapdiv" style="height:250px; width: 400px;"></div>
        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
        <script>
            map = new OpenLayers.Map("mapdiv");
            map.addLayer(new OpenLayers.Layer.OSM());
              
            var lonLat = new OpenLayers.LonLat(
                    <?php echo $geolocation['longitude'] ?>,
                    <?php echo $geolocation['latitude'] ?> )
                .transform(
                    new OpenLayers.Projection("EPSG:4326"),
                    map.getProjectionObject()
                );
            var zoom=11;
            map.setCenter (lonLat, zoom);      
        </script>
    </div>
    <h4>Forecast upcoming 7 days</h4>
    <table style="width: 100%;">
        <tr style="color: rgb(52, 101, 164);">
            <th style="text-align: left;">Date</th>
            <th style="text-align: left;">Min temp</th>
            <th style="text-align: left;">Max temp</th>
            <th style="text-align: left;">Temp</th>
        </tr>
        <?php foreach ($weather['daily'] as $day) { ?>
            <tr style="color: rgba(52, 101, 164, .5);">
                <td><?= date("m.d.y", $day['dt']) ?></td>
                <td><?= $day['temp']['min'] ?>&#176</td>
                <td><?= $day['temp']['max'] ?>&#176</td>
                <td><?= $day['temp']['day'] ?>&#176</td>
            </tr>
        <?php } ?>
    </table>

    <h4>Forecast historic 5 days</h4>

    <table style="width: 100%;">
        <tr style="color: rgb(52, 101, 164);">
            <th style="text-align: left;">Date</th>
            <th style="text-align: left;">Temp</th>
            <th style="text-align: left;">Sunrise</th>
            <th style="text-align: left;">Sunset</th>
            <th style="text-align: left;">Weather</th>
            <th style="text-align: left;">Description</th>
        </tr>
        <?php foreach ($historic as $day) { ?>
            <tr style="color: rgba(52, 101, 164, .5);">
                <td><?= date("m.d.y", $day['current']['dt']) ?></td>
                <td><?= ($day['current']['temp'] - 273.15) ?>&#176</td>
                <td><?= date("H:m:s", $day['current']['sunrise']) ?></td>
                <td><?= date("H:m:s", $day['current']['sunset']) ?></td>
                <td><?= $day['current']['weather'][0]['main'] ?></td>
                <td><?= $day['current']['weather'][0]['description'] ?></td>
            </tr>
        <?php } ?>
    </table>
<?php else : ?>
    <span style="color: red;"><?= $geolocation['message'] ?></span>
<?php endif; ?>
