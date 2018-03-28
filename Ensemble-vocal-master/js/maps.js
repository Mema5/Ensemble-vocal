function initMap() {
    var map;
        var Paris = {lat: 48.86126, lng: 2.345572};
        map=(new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: Paris
        }));
        var marker = new google.maps.Marker({
            position: Paris,
            map: map
        });
    
}