
<?php

$concerts = Concert::getConcerts($dbh);
echo"<script type='text/javascript' src='js/concerts.js'></script>";
echo "<div class='row ng-scope'> <div class='col-12'>";

foreach ($concerts as $concert){
    $concert->print_concert($_SESSION['admin']);
}




echo"</div></div>";









?>