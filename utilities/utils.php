<?php

$page_list = array(
    array(
        'name' => 'accueil',
        'title' => 'Accueil',
        'menutitle' => 'hidden',
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
        'name' => 'reservation',
        'title' => 'Réservez vos places',
        'menutitle' => 'hidden',
        'admin' => false
    ),
    array(
        'name' => 'membres',
        'title' => 'Espace membres',
        'menutitle' => 'hidden',
        'admin' => false
    ),
    array(
        'name' => 'membres_submit',
        'title' => 'Formulaire envoyé',
        'menutitle' => 'hidden',
        'admin' => true
    ),
    array(
        'name' => 'galerie',
        'title' => 'Galerie des concerts passés',
        'menutitle' => 'Galerie photo',
        'admin' => false
    ),
    array(
        'name' => 'galerie_submit',
        'title' => 'Formulaire envoyé',
        'menutitle' => 'hidden',
        'admin' => true
    ),
    array(
        'name' => 'galerie_album',
        'title' => 'Photos du concert',
        'menutitle' => 'hidden',
        'admin' => false
    ),
    array(
        'name' => 'contact',
        'title' => 'Informations pratiques',
        'menutitle' => 'Infos pratiques',
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
        'menutitle' => 'hidden',
        'admin' => false
    ),
    array(
        'name' => 'concert',
        'title' => 'Description du Concert',
        'menutitle' => 'hidden',
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
    <html lang="fr">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Louis Raison et Maël Madon"/>
        <meta name="keywords" content="chorale polytechnique ensemble vocal patrice holiner"/>
        <meta name="description" content="Site officiel de l'Ensemble Vocal de l'Ecole Polytechnique"/>
        <style>
        
    @import url('https://fonts.googleapis.com/css?family=Great+Vibes');
        </style>

    <link href="https://fonts.googleapis.com/css?family=Gentium+Basic" rel="stylesheet"> 
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>$title</title>
    <link rel="shortcut icon" href="pictures/Logo.png">

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- ... Unite Gallery ... -->
    <script src='unitegallery/js/jquery-11.0.min.js'></script>	
    <script src='unitegallery/js/ug-common-libraries.js'></script>	
    <script src='unitegallery/js/ug-functions.js'></script>
    <script src='unitegallery/js/ug-thumbsgeneral.js'></script>
    <script src='unitegallery/js/ug-thumbsstrip.js'></script>
    <script src='unitegallery/js/ug-touchthumbs.js'></script>
    <script src='unitegallery/js/ug-panelsbase.js'></script>
    <script src='unitegallery/js/ug-strippanel.js'></script>
    <script src='unitegallery/js/ug-gridpanel.js'></script>
    <script src='unitegallery/js/ug-thumbsgrid.js'></script>
    <script src='unitegallery/js/ug-tiles.js'></script>
    <script src='unitegallery/js/ug-tiledesign.js'></script>
    <script src='unitegallery/js/ug-avia.js'></script>
    <script src='unitegallery/js/ug-slider.js'></script>
    <script src='unitegallery/js/ug-sliderassets.js'></script>
    <script src='unitegallery/js/ug-touchslider.js'></script>
    <script src='unitegallery/js/ug-zoomslider.js'></script>	
    <script src='unitegallery/js/ug-video.js'></script>
    <script src='unitegallery/js/ug-gallery.js'></script>
    <script src='unitegallery/js/ug-lightbox.js'></script>
    <script src='unitegallery/js/ug-carousel.js'></script>
    <script src='unitegallery/js/ug-api.js'></script>
            
    <link rel='stylesheet' href='unitegallery/css/unite-gallery.css' type='text/css' />
    <script src='unitegallery/themes/tiles/ug-theme-tiles.js'></script>
    <link rel='stylesheet' 		  href='unitegallery/themes/default/ug-theme-default.css' type='text/css' />
    <!-- ... End Unite Gallery ... -->
    

FIN;
    foreach ($links as $link) {
        echo "<link href = '$link' rel = 'stylesheet'>";
    }
    echo"</head>";
    echo "<body><section id ='main-content' class='container ng-scope ui-view' style>";
}

function generateMenu($admin) {
 
//Generates a menu that corresponds to the page_list given in utils.php
    global $page_list;
    echo <<<FIN
    <header id="header" class="ng-scope">
    <nav class="navbar navbar-fixed-top maincolors">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar" style="color:white">
                    <span class="icon-bar" style="background-color:#ECEFF1"> </span>
                    <span class="icon-bar" style="background-color:#ECEFF1"> </span> 
                    <span class="icon-bar" style="background-color:#ECEFF1"> </span>
                </button> 
            </div>
            <div class="collapse navbar-collapse" id="navBar">
                <ul class="nav navbar-nav">
FIN;
    foreach ($page_list as $page) {
        
        if ($page['name'] == 'accueil') {
            // Logo redirection accueil
            echo '<li><a href="index.php?page=accueil"> <img class="img-responsive" src="pictures/Logo.png" alt="Logo chorale" width="24" height="24"> ';
            echo "</a></li>";
        }
        
        if ($admin || !$page['admin'] && !$admin) {
            // Titres du menu
            if ($page['menutitle'] != "hidden") {
                echo "<li><a class='menuButton' href='index.php?page=" . $page['name'] . "'>" . $page['menutitle'];
                echo "</a></li>";
            }
        }
    }
    echo "</ul>";
    
    // Logo de login
    echo "<ul class='nav navbar-nav navbar-right'>";
    
    if (!$admin) {
        // Cadenas 
        echo <<<FIN
        <li><a href="index.php?page=adminlogin">
            <svg width="17" height="17" fill="white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
            <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
            <g><path d="M683.9,316.2c0-101.5-82.4-183.7-183.9-183.7c-101.6,0-183.9,82.3-183.9,183.7v122.5h367.9h122.6c33.9,0,61.3,27.4,61.3,61.2v428.8c0,33.9-27.5,61.3-61.3,61.3H193.4c-33.9,0-61.3-27.4-61.3-61.3V500c0-33.8,27.4-61.2,61.3-61.2V316.2C193.4,147.1,330.7,10,500,10c169.3,0,306.5,137.1,306.5,306.2H683.9z"/></g>
            </svg>
        </a></li>
FIN;
    }
    if ($admin) {
        // Sign out
        echo <<<FIN

        <li><a class="menuButton" href="index.php?page=accueil&todo=disconnect">

            <svg width="17" height="17" fill="white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
            <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
            <g><path d="M764,152.1c30.9,22,58.3,46.8,82.4,74.6c24,27.8,44.6,57.8,61.8,90.1c17.2,32.3,30.2,66.4,39.1,102.4c8.9,36,13.4,72.6,13.4,109.6c0,63.8-12.2,123.7-36.5,179.6c-24.4,55.9-57.3,104.7-98.8,146.2c-41.5,41.5-90.2,74.5-146.2,98.8C623.2,977.8,563.3,990,499.5,990c-63.1,0-122.7-12.2-178.6-36.5c-55.9-24.4-104.8-57.3-146.7-98.8c-41.9-41.5-74.8-90.2-98.8-146.2c-24-55.9-36-115.8-36-179.6c0-36.4,4.3-72.1,12.9-107.1c8.6-35,20.8-68.3,36.5-99.9c15.8-31.6,35.3-61.1,58.7-88.5c23.3-27.5,49.4-52.2,78.2-74.1c15.1-11,31.4-15.1,48.9-12.4c17.5,2.8,31.7,11.3,42.7,25.7c11,14.4,15.1,30.5,12.4,48.4c-2.8,17.8-11.3,32.3-25.7,43.2c-43.2,31.6-76.4,70.3-99.3,116.3c-23,46-34.5,95.4-34.5,148.2c0,45.3,8.6,88,25.7,128.2c17.2,40.1,40.7,75.1,70.5,105c29.9,29.9,64.9,53.5,105,71c40.1,17.5,82.9,26.2,128.2,26.2c45.3,0,88-8.7,128.2-26.2c40.1-17.5,75.2-41.2,105-71c29.9-29.9,53.5-64.8,71-105c17.5-40.1,26.2-82.9,26.2-128.2c0-53.5-12.3-104.1-37.1-151.8c-24.7-47.7-59.4-87-104-117.9c-15.1-10.3-24.2-24.4-27.3-42.2c-3.1-17.8,0.5-34.3,10.8-49.4c10.3-14.4,24.4-23.2,42.2-26.2C732.5,138.2,748.9,141.8,764,152.1L764,152.1z M499.5,531.9c-17.8,0-33.1-6.3-45.8-19c-12.7-12.7-19-28-19-45.8V75.9c0-17.8,6.3-33.3,19-46.3c12.7-13,28-19.6,45.8-19.6c18.5,0,34.1,6.5,46.8,19.6c12.7,13,19,28.5,19,46.3v391.2c0,17.8-6.3,33.1-19,45.8C533.6,525.6,518,531.9,499.5,531.9L499.5,531.9z"/></g>
            </svg>
        </a></li>
FIN;
    }
   
    echo "</ul>";

    // Bouton de reservation des places si concert en cours de réservation
    $idconcert = 1; 
    // ....
    // requête à écrire dans la bdd pour trouver le dernier concert à venir
    // idconcert vaut -1 si pas de concert à venir
    // ....
   
    if ($idconcert != -1) {
        echo "<a href='index.php?page=concert&id=$idconcert' class='btn btn-primary navbar-btn navbar-right' role='button'>";
        echo "Prochain concert";
        echo "</a>";
    }
    
    echo "</div></div></nav></header>";
}

function generateHTMLFooter() {
//Generates the footer for each page
    echo <<<FIN
    </section>
    <!--Footer-->
    
<div class="row">
    <div class="col-xs-12"></div>
</div>

<footer class="page-footer font-small pt-4 mt-4 maincolors" >

    <!--Footer Links-->
    <div class="container text-center text-md-left">
        <div class="row">

            <div class="col-md-6 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Autour de l'Ensemble Vocal</h5>
                <ul class="list-unstyled">
                    <li>
                        <a class="footerButton" href="#!">Nos partenaires</a>
                    </li>
                    <li>
                        <a class="footerButton" href="#!">L'École polytechnique</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Liens utiles</h5>
                <ul class="list-unstyled">
                    <li>
                        <a class = "footerButton" href="#!">A propos</a>
                    </li>
                    <li>

                        <a class = "footerButton" href="index.php?page=contact">Contactez-nous</a>

                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    <!--/.Footer Links-->

    

    <!--Social buttons-->
    <div class="text-center">
        <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
                <a class="footerButton btn-floating btn-bg btn-fb mx-1" href="https://www.facebook.com/ensembleVocalEcolePolytechnique/">
                    <i class="fa fa-facebook"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="footerButton btn-floating btn-bg btn-yt mx-1" href="https://www.youtube.com/channel/UCwWtVb5arM-E14CcHeq17yQ">
                    <i class="fa fa-youtube"> </i>
                </a>
            </li>
        </ul>
    </div>
    <!--/.Social buttons-->

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        © 2018 Copyright:
        Ensemble Vocal de l'École polytechnique
    </div>
    <!--/.Copyright-->


</footer>


</body>
FIN;
}

function disconnect() {
    unset($_SESSION['loggedIn']);
    $_SESSION['admin'] = false;

}

