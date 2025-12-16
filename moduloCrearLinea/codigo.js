var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var puntos = [];
function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var LaPaz= new google.maps.LatLng(-16.50524499495991, -68.1295895576477);
    var mapOptions = {
        zoom: 32,
        center: LaPaz
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    google.maps.event.addListener(map, 'click', function (event) {
        adicionarMarca(event.latLng);
    });
    directionsDisplay.setMap(map);
}
function adicionarMarca(posicion){
    puntos.push(posicion);
    if (puntos.length >= 2)
        dibujarRuta();
}

function dibujarRuta() {
    llenarTabla();
    var n = puntos.length;
    var start = puntos[0];
    var end = puntos[n - 1];

    var waypts = [];
    for (var i = 0; i < n; i++) {
        waypts.push({
            location: puntos[i]
        });
    }

    var request = {
        origin: start,
        destination: end,
        waypoints: waypts,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var superpuntos = response.routes[0].overview_path;
            var nn = superpuntos.length;
            for (var i = 0; i < nn; i++) {
                var pnt = superpuntos[i];
                var marca = new google.maps.Marker({
                    position: pnt,
                    map: map
                });
            }
        }
    });

}
function llenarTabla() {
    var listapuntos = document.getElementById("cajapuntos");
    var contenido = "<select multiple size='30'>";

    for (var i = 0; i < puntos.length; i++) {
        contenido += "<option>" + puntos[i].toString() + "</option>";
    }
    contenido += "</select>";
    listapuntos.innerHTML = contenido;
}
google.maps.event.addDomListener(window, 'load', initialize);