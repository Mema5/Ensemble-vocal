
<?php

if (array_key_exists('concert', $_GET)){
    $id = $_GET['concert'];
    if ($id=='next'){
        $concert = Concert::getConcerts($dbh);
    }
    else {
        $concert = Concert::getConcert($dbh, $id);
    }
    if (count($concert)==0){
        $authorized=false;
    }
    else{
        $concert = $concert[0];
        printConcert($concert);
    }
}

function printConcert($concert){
    $lien_billetterie = $concert->billetterie;
    echo<<<FIN
    <iframe 
    height="700"
    width="100%"
    style="border:none;"
    
    src=$lien_billetterie>
    
    Voici le lien vers la billetterie : <a href=$lien_billetterie>$lien_billetterie</a>;
    </iframe>
FIN;
}