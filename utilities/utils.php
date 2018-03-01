<?php

$page_list = array(
    array(
        'name' => 'accueil',
        'title' => 'Accueil',
        'menutitle' => 'Accueil',
        'admin' => false
    ),
    array(
        'name' => 'presentation',
        'title' => 'Présentation de l\'Ensemble Vocal de l\'X',
        'menutitle' => 'Présentation',
        'admin' => false
    ),
    array(
        'name' => 'concerts',
        'title' => 'Concerts passés et à venir',
        'menutitle' => 'Concerts',
        'admin' => false
    ),
    array(
        'name' => 'membres',
        'title' => 'Espace membres',
        'menutitle' => 'Membres',
        'admin' => false
    ),
    array(
        'name' => 'galerie',
        'title' => 'Galerie des concerts passés',
        'menutitle' => 'Galerie',
        'admin' => false
    ),
    array(
        'name' => 'administration',
        'title' => 'Administration',
        'menutitle' => 'Administration',
        'admin' => true
    ),
    array(
        'name' => 'adminlogin',
        'title' => 'Espace Administration',
        'menutitle' => 'Connexion Administrateur',
        'admin' => false
    )
);

function checkPage($askedPage, $admin) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page['name'] === $askedPage) {
            return ($admin || !$page['admin']);
        }
    }
    return false;
}

function getPageTitle($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page['name'] === $askedPage) {
            return $page['title'];
        }
    }
}

function generateHTMLHeader($title, $links) {

    echo <<<FIN
    <html>
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nom de l'auteur"/>
        <meta name="keywords" content="Mots clefs relatifs à cette page"/>
        <meta name="description" content="Descriptif court"/>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Great+Vibes');
        </style>
    <script src="js/jquery-1.11.0.min.js"></script>

        <title>$title</title>
FIN;
    foreach ($links as $link) {
        echo "<link href = '$link' rel = 'stylesheet'>";
    }
    echo"</head><body>";
}

function generateMenu($admin) {

    //Generates a menu that corresponds to the page_list given in utils.php
    global $page_list;
    echo <<<FIN
    <!-- Static navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
FIN;

    foreach ($page_list as $page) {
        if ($admin || !$page['admin']) {
            echo "<li><a href='index.php?page=" . $page['name'] . "'>" . $page['menutitle'];
            echo "</a></li>";
        }
    }
    //echo logButton();
    echo"</ul></div></div></div>";
}

function generateHTMLFooter() {
    
    echo <<<FIN
    <div id="footer">
        <p>Site réalisé en Modal par Louis Raison et Maël Madon</p>

    </div>
        </body>
        
    </html>
FIN;
}