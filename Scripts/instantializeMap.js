function createMap(response) {
    var locations = [];
    // $('#displayLocations').text(JSON.stringify(response));
    $.$.each(response, function (index, json) {
        var name = getJson("facilityName", json).trim();
        var lat = getJson("lat", json).trim();
        var lng = getJson("lng", json).trim();
        var sports = getJson("sports", json).trim();
        var point = {
            "latitude": lat,
            "longitude": lng,
            "description": name,
            "sports": sports
        };
        locations.push(point);
    });
    var data = [];
    for (var i = 0; i < locations.length; i++) {
        var feature = {
            "type": "Feature",
            "properties": {
                "description": locations[i].description,
                "sports": locations[i].sports,
                "icon": "circle-15"
            },
            "geometry": {
                "type": "Point",
                "coordinates": [locations[i].longitude, locations[i].latitude]
            }
        };
        data.push(feature)
    }
    var geoJson = {
        "type": "FeatureCollection",
        "features": data
    };
    loadMap(gson);
}


