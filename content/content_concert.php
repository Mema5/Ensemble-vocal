
<?php

if (array_key_exists('concert', $_GET)){
    $id = $_GET['concert'];
    $concert = Concert::getConcert($dbh, $id);
    if (count($concert==0)){
        $authorized=false;
    }
    else{
        $concert = $concert[0];
        $description = $concert['description'];
        echo "$description";
    }
}

function printConcert(){
    
}