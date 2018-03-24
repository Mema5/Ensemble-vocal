
<?php
$concerts = Concert::getConcerts($dbh);
echo"<script src='js/concerts.js'></script>";
echo "<div class='row'><div class='col-xs-12 col-sm-offset-1 col-sm-10'>";



foreach ($concerts as $concert) {
    $concert->print_concert($_SESSION['admin']);
}


echo<<<FIN
<div class="row event secondary1">
<div class="row event-banner">
    <div class="col-xs-4 col-sm-2 date-block">
        <span class="day">3</span>
        <span class="month">Juin</span>
        <span class="year">2018</span>
        <span class="time">20:00</span>
    </div>
    
    <div class="img col-xs-8 col-sm-3">
        <img alt="Mozart" src="pictures/Mozart.png" style="width:100%"/>
    </div>
    <div class="info col-xs-10 col-sm-5">

            <h2>Requiem de Mozart</h2>

            
    </div>
    <div class="social col-xs-2 col-sm-1 align-middle">
        <a class="btn-floating btn-sm btn-fb mx-1" href="https://www.facebook.com/ensembleVocalEcolePolytechnique/"><span class="fa fa-facebook"></span></a>
    </div>
</div>
<div class="row event-description tertiary">
    <div class="row presentation-row">
        <div class="col-md-9 presentation">
            <h3>Présentation :</h3>
            Haec ubi latius fama vulgasset missaeque relationes adsiduae Gallum Caesarem permovissent, quoniam magister equitum longius ea tempestate distinebatur, iussus comes orientis Nebridius contractis undique militaribus copiis ad eximendam periculo civitatem amplam et oportunam studio properabat ingenti, quo cognito abscessere latrones nulla re amplius memorabili gesta, dispersique ut solent avia montium petiere celsorum.
            
        </div>
        <div class="col-md-3 tarifs">
            <h3>Tarifs :</h3>
            <ul>
                <li>
                    Places numérotées : 30€.
                </li>
                <li>
                    Placement libre : 20€.
                </li>
                <li>
                    Tarif étudiant : 15€.
                </li>
            </ul>
        </div>
</div>
<hr class="style14">
<br>
<div class="localisation row">
<div class="col-xs-12 col-md-8 map">
<div id="map" style="width:400px;height:400px"></div>
    <script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8DX4FeNujZ5CitP0dOjHs3qhCM1kCyrE&callback=initMap">
    </script>
</div>
<div class="col-xs-12 col-md-4">
<h3>Adresse : </h3>
1 avenue Charles de Gaulle, 75000 Paris.
   </div>
</div>
    </div>
</div>

<div class="row event secondary2">
<div class="row event-banner">
    <div class="col-xs-2 date-block">
        <span class="day">14</span>
        <span class="month">Mars</span>
        <span class="year">2018</span>
        <span class="time">20:30</span>
    </div>
    
    <div class="img col-xs-3">
        <img alt="Mozart" src="pictures/Brahms.png" style="width:100%"/>
    </div>
    <div class="info col-xs-5">

            <h2> Requiem de Brahms</h2>

            
    </div>
    <div class="social col-xs-2 col-sm-1 align-middle">
        <a class="btn-floating btn-sm btn-fb mx-1" href="https://www.facebook.com/ensembleVocalEcolePolytechnique/"><span class="fa fa-facebook"></span></a>
    </div>
</div>
<div class="row informationsconcerts">



</div>
</div>



FIN;

echo"</div></div>";
?>

<div class="row event-description tertiary">
    <div class="row presentation-row">
        <div class="col-md-9 presentation">
            <h3>Présentation :</h3>
            Haec ubi latius fama vulgasset missaeque relationes adsiduae Gallum Caesarem permovissent, quoniam magister equitum longius ea tempestate distinebatur, iussus comes orientis Nebridius contractis undique militaribus copiis ad eximendam periculo civitatem amplam et oportunam studio properabat ingenti, quo cognito abscessere latrones nulla re amplius memorabili gesta, dispersique ut solent avia montium petiere celsorum.

        </div>
        <div class="col-md-3 tarifs">
            <h3>Tarifs :</h3>
            <ul>
                <li>
                    Places numérotées : 30€.
                </li>
                <li>
                    Placement libre : 20€.
                </li>
                <li>
                    Tarif étudiant : 15€.
                </li>
            </ul>
        </div>
    </div>
    
</div>
