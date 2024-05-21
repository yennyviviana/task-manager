// Inicializa el mapa de Google
function initMap() {
    // Coordenadas del centro del mapa
    var centroMapa = {lat: -34.603722, lng: -58.381592};
    // Crea el mapa
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12, // Nivel de zoom del mapa
        center: centroMapa // Centra el mapa en las coordenadas especificadas
    });
}
