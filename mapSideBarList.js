function buildLocationList(data) {
    // Iterate through the list of stores
    for (i = 0; i < data.features.length; i++) {
        var currentFeature = data.features[i];
        // Shorten data.feature.properties to `prop` so we're not
        // writing this long form over and over again.
        var prop = currentFeature.properties;
        // Select the listing container in the HTML and append a div
        // with the class 'item' for each store
        var listings = document.getElementById('listings');
        var listing = listings.appendChild(document.createElement('div'));
        listing.className = 'item';
        listing.id = 'listing-' + i;

        // Create a new link with the class 'title' for each store
        // and fill it with the sports played
        var link = listing.appendChild(document.createElement('a'));
        link.href = '#';
        link.className = 'title';
        link.dataPosition = i;
        link.innerHTML = prop.sports;
    }
}