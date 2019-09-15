<html>
<head>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.css' rel='stylesheet' /><script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.css' rel='stylesheet' />
    <link href='assets/css/mapbox-map.css' rel='stylesheet' />

</head>
<body>
<div class='sidebar pad2'>Listing</div>
<div id='map' class='map pad2'>Map</div>

</body>
</html>
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoiem9lMDkyNSIsImEiOiJjam5mNDY1dHEwZ3djM3BwN2E2MGRsOWVyIn0.R6wzrqMBMgdivRmsFeWgew';
    var map = ​new mapboxgl.Map({
        container: 'map',
        // style URL
        style: 'mapbox://styles/mapbox/light-v10',
        // initial position in [lon, lat] format
        center: [144.96517749999998, -37.81837925],
        // initial zoom
        zoom: 14
    });
</script>
<?php
?>