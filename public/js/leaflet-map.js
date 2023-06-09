var mymap = L.map('map').setView([-8.443107990508,115.10995605616532], 10);
var markers = [];

var myIcon = L.icon({
    iconUrl: 'cart.png',
    iconSize: [85, 80],
    iconAnchor: [20, 40],
});
var currentMarker = null;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 16,
}).addTo(mymap);

var markerClusters = L.markerClusterGroup().addTo(mymap);

// Handle click on the map to create a new draggable marker
mymap.on('click', function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    
    // Remove the current marker if exists
    if (currentMarker) {
        mymap.removeLayer(currentMarker);
    }
    
    currentMarker = L.marker([lat, lng], {
        icon: myIcon,
        draggable: true,
    }).addTo(mymap).bindPopup(`
        <div>
            <a href="${createUrl}">Create a new minimarket</a>
        </div>
    `).openPopup();
});

minimarkets.forEach(function (minimarkets, index) {
    markers.push(
        new L.Marker([minimarkets.latitude, minimarkets.longitude], {
            icon: myIcon,
            draggable: false,
        }).addTo(mymap)
    );
    markerClusters.addLayer(L.layerGroup(markers));
});

markers.forEach(function(m, index) {
    m.on("click", function(e) {
        var popup = L.popup(e.latlng, {
            content: 
            `
            <div class="" style="width: 270px">
                <img src="">
                <h3>${minimarkets[index].name} ${minimarkets[index].branch} </h3>
                <div class="border-top">
                  <table class="table table-border">
                    <tbody>
                        <tr>
                            <td>${minimarkets[index].address}</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <a href="minimarkets/${minimarkets[index].id}">See details</a>
            </div>
            `,
        }).openOn(mymap);
    })
})