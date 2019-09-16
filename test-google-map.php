<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MuziVic</title>
    <meta name="robots" content="noindex, follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            width: 600px;
            height: 400px;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icons.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!--fonts added here-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair%20Display">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Karla:regular,italic,700", "Frank Ruhl Libre:300,regular", "Playfair Display:regular,italic,700,700italic,900,900italic"]}});</script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Karla:regular,italic,700%7CFrank+Ruhl+Libre:300,regular%7CPlayfair+Display:regular,italic,700,700italic,900,900italic"
          media="all">
    <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="Scripts/jquery-3.2.1.min.js"></script>

</head>
<html>
<body>
<?php include "header.html" ?>
<form id="mapForm" name="mapForm" action="../php/server%20receive%20request%20on%20sports.php"
      method="post">
    <P>Select your suburb: <input type="text" name="suburb" id="suburb"/> * required</P>
    <br>
    <label for="sports">Select a sports activity</label>
    <select class="custom-select" name="sports" id="sports selection">
        <h4>Select your preference and see recommended sports activities</h4>
        <option value="Australian Rules Football">Australian Rules Football</option>
        <option value="Basketball">Basketball</option>
        <option value="Cricket">Cricket</option>
        <option value="Cycling">Cycling</option>
        <option value="Dancing">Dancing</option>
        <option value="Fitness / Gymnasium Workouts">Fitness / Gymnasium Workouts</option>
        <option value="Soccer" selected="selected">Soccer</option>
        <option value="Golf">Golf</option>
        <option value="Gymnastics">Gymnastics</option>
        <option value="Athletics">Athletics</option>
        <option value="Swimming">Swimming</option>
        <option value="Tennis">Tennis</option>
        <option value="Walking">Walking</option>
        <option value="Tennis">Tennis</option>
        <option value="Netball">Netball</option>
        <option value="Yoga">Yoga</option>
    </select>
    <br>
</form>
<br>
<button type="button" form="mapForm" id="mapButton" value="Submit">Search by Suburb or Activity</button>
<div id="displayLocations"></div>
<div class="col-lg-5"></div>
<div id="map"></div>
<div class="col-lg-2"></div>
<script>
    var map;
    var infoWindow;
    var xml;
    var markers;

    var customLabel = {
        restaurant: {
            label: 'R'
        },
        bar: {
            label: 'B'
        }
    };

    $(document).ready(function () {
        $("#mapButton").click(function (e) {
            $('#displayLocations').empty();
            e.preventDefault();
            $.ajax({
                url: "php/google-map-find-sports.php",
                type: "POST",
                data: $('#mapForm').serialize(),
                success: function (data) { // Pop the location data on map
                    var output = "";
                    for (var i in data) {
                        output += "<br>" + data[i].facilityName + ": " + data[i].address + "<br>";
                        output += "Sports activity: " + data[i].sports + "<br>";
                    }
                    output += "</tbody></table>";
                    $('#displayLocations').append(output);
                },
                error: function (jqxhr, status, exception) {
                    //alert("No result found. Please refresh and search again.");
                    alert(status);
                    alert(exception);
                }
            });
            $("#mapButton").unbind();
        });
    });


    function initMap() {
        var center = new google.maps.LatLng(-37.818078, 144.96681);
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 12
        });

        infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        //downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
    }

    function updteMarker() {
        markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function (markerElem) {
            // var id = markerElem.getAttribute('id');
            var name = markerElem.getAttribute('name');
            // var address = markerElem.getAttribute('address');
            //  var type = markerElem.getAttribute('type');
            var sports = markerElem.getAttribute('sports');
            var condition = markerElem.getAttribute('condition');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = "Sports played: " + sports;
            var conditionText = document.createElement('text');
            conditionText.textContent = "Sports played: " + condition;
            infowincontent.appendChild(text);
            var icon = customLabel[type] || {};
            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
            });
            marker.addListener('click', function () {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2KlPbWJr_OLQZ7mx-AI6TVXXXzOdQxw0&callback=initMap">
</script>
</body>
</html>

