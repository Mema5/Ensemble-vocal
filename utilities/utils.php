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
        'name' => 'galerie_submit',
        'title' => 'Formulaire envoyé',
        'menutitle' => 'hidden',
        'admin' => true
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>$title</title>
FIN;
    foreach ($links as $link) {
        echo "<link href = '$link' rel = 'stylesheet'>";
    }
    echo"</head><body><section id ='main-content' class='container ng-scope' ui-view style>";
}

function generateMenu($admin) {
 

//Generates a menu that corresponds to the page_list given in utils.php
    global $page_list;
    echo <<<FIN
    <header id="header" class="ng-scope">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                    <span class="icon-bar"></span>
                </button> 
            </div>
            <div class="collapse navbar-collapse" id="navBar">
                <ul class="nav navbar-nav">
FIN;
    foreach ($page_list as $page) {

        if ($page['name'] != 'accueil' && ($admin && $page['name'] != 'adminlogin') || (!$page['admin'] && !$admin)) {
            echo "<li><a href='index.php?page=" . $page['name'] . "'>" . $page['menutitle'];
            echo "</a></li>";

        }
    }
    if ($admin) {
        echo "<li><a href='index.php?page=accueil&todo=disconnect'> Déconnexion";
        echo "</a></li>";
    }
//echo logButton();
    echo "</ul></div></div></nav></header>";

//<!--Static navbar -->
//<div
//<div class = "navbar navbar-inverse navbar-fixed-top" role = "banner">
//<div class = "container">
//
//<div class = "navbar-collapse collapse">
//<ul class = "nav navbar-nav">
//FIN;
//
//echo"<li><a class='navbar-brand' ui-sref='index.home' href='#'>
//        <div class = navbar-header><img alt='Brand' src='pictures/Logo.png' style='max-height:80px'></div>
//      </a></li>";
//foreach ($page_list as $page) {
//if ($page['name'] != 'accueil' && ($admin && $page['name'] != 'adminlogin') || (!$page['admin']&&!$admin)) {
//
//echo "<li><a href='index.php?page=" . $page['name'] . "'>" . $page['menutitle'];
//echo "</a></li>";
//}
//}
//if ($admin){
//echo "<li><a href='index.php?page=accueil&todo=disconnect'> Déconnexion";
//echo "</a></li>";
//}
////echo logButton();
//echo"</ul></div></div></div>";


}
function generateHTMLFooter() {

    echo <<<FIN
    <div id="footer">
        <p>Site réalisé en Modal par Louis Raison et Maël Madon</p>

    </div>
    </section>
        </body>
        
    </html>
FIN;
}

function disconnect() {
    unset($_SESSION['loggedIn']);

    $_SESSION['admin'] = false;

}
