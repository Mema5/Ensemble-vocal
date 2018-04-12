
<?php

//Traitement du formulaire de création de concert

function deleteConcert($dbh) {
    if (array_key_exists("id", $_GET)) {
        Concert::deleteConcert($dbh, $_GET['id']);
    }
}

function addConcert($dbh) {
    $solistes = [];
    $musiciens = [];
    $heure = $_POST['heure'];
    $date = $_POST['date'];
    $auteur = $_POST['auteur'];
    $oeuvre = $_POST['oeuvre'];
    $lieu = Lieu::getLieu($dbh, $_POST['lieu']);
    foreach (array_keys($_POST) as $key) {
        if (substr_count($key, 'nomsoliste') > 0) {
            $soliste = $_POST['soliste' . substr($key, -1)];
            $solistes[$_POST[$key]] = $soliste;
        } elseif (substr_count($key, 'nommusicien') > 0) {
            $musicien = $_POST['musicien' . substr($key, -1)];
            $musiciens[$_POST[$key]] = $musicien;
        }
    }

    $description = "<div class='center' style='text-align: center'>
        <h2>
            <small>$auteur</small>
            <br>
            <span aria-hidden='false'>
                <strong>$oeuvre</strong>
            </span>
        </h2>
        <p>***</p>
        <h3>le $date à $heure</h3>
        <h3>$lieu->nom</h3>
        <h5>$lieu->adresse</h5>
        <div class='row'>
            <p>";
    foreach (array_keys($solistes) as $soliste) {
        $description .= "<span><strong>$solistes[$soliste]</strong>– $soliste<br></span>";
    }
    $description .= "</p><p>***</p><p>";
    foreach (array_keys($musiciens) as $musicien) {
        $description .= "<span><strong>$musiciens[$musicien]</strong>– $musicien<br></span>";
    }
    $description .= "</p><p>***</p>
</div>
<p>
    <strong>Direction</strong> – Patrice HOLINER</p>
<p></p>
</div>";
    Concert::addConcert($dbh, $_POST['oeuvre'], $_POST['titre'], $_POST['auteur'], $_POST['date'], $_POST['heure'], $description, $_POST["lieu"],$_POST['billetterie']);
}

if ($_SESSION['admin']) {
    if (array_key_exists("TODO", $_GET)) {
        if ($_GET['TODO'] == 'add_concert') {
            addConcert($dbh);
        } elseif ($_GET['TODO'] == 'delete_concert') {
            deleteConcert($dbh);
        }
    }
}


$concerts = Concert::getConcerts($dbh);

echo "<div class = 'row'><div class = 'col-xs-12 col-sm-offset-1 col-sm-10'>";
if ($_SESSION['admin']) {
    echo "<div class = 'row button-row'><div class = 'btn-group btn-group justified'>"
    . "<a class = 'btn btn-default' href = 'index.php?page=creation_concert'>Ajouter un concert</a>"
    . "<a class = 'btn btn-default'>Modifier les concerts existants</a>"
    . "<a class = 'btn btn-default'>Gérer les réservations</a>"
    . "</div></div>";
}

$k = 0;

foreach ($concerts as $concert) {
    $coordonnees = $concert->print_concert($dbh, $_SESSION['admin'], ($k === 0));
    if ($k == 0) {
        $lat = $coordonnees[0];
        $lon = $coordonnees[1];
    }
    $k++;
}

echo"</div></div>";
echo"<script>"
 . "function initMap() {
var map;
var Lieu = {lat: $lat, lng: $lon};
map = (new google.maps.Map(document.getElementById('map'), {
zoom: 13,
 center: Lieu
}));
var marker = new google.maps.Marker({
position: Lieu,
 map: map
});
}</script>";
echo"<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD8DX4FeNujZ5CitP0dOjHs3qhCM1kCyrE&callback=initMap'></script>";
echo"<script src='js/concerts.js'></script>"
?>

