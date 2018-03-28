
<?php
$concerts = Concert::getConcerts($dbh);
    
    echo "<div class='row'><div class='col-xs-12 col-sm-offset-1 col-sm-10'>";
    if ($_SESSION['admin']){echo "<div class='row button-row'><div class='btn-group btn-group justified'>"
        . "<a class='btn btn-default'>Ajouter un concert</a>"
        . "<a class='btn btn-default'>Modifier les concerts existants</a>"
        . "<a class='btn btn-default'>Gérer les réservations</a>"
            . "</div></div>";}

$k=0;

foreach ($concerts as $concert) {
    $concert->print_concert($_SESSION['admin'],($k===0));
    $k++;
}

    echo"</div></div>";
    echo"<script>"
    . "function initMap() {
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
}</script>";
    echo"<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD8DX4FeNujZ5CitP0dOjHs3qhCM1kCyrE&callback=initMap'></script>";
    echo"<script src='js/concerts.js'></script>"
?>

