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
        'name' => 'galerie_album',
        'title' => 'Photos du concert',
        'menutitle' => 'hidden',
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
    <html lang="fr">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Louis Raison et Mael Madon"/>
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

        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    	<!-- ... Unite Gallery ... -->	
	<script type='text/javascript' src='unitegallery/js/jquery-11.0.min.js'></script>	
	
	<script type='text/javascript' src='unitegallery/js/ug-common-libraries.js'></script>	
	<script type='text/javascript' src='unitegallery/js/ug-functions.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-thumbsgeneral.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-thumbsstrip.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-touchthumbs.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-panelsbase.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-strippanel.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-gridpanel.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-thumbsgrid.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-tiles.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-tiledesign.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-avia.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-slider.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-sliderassets.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-touchslider.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-zoomslider.js'></script>	
	<script type='text/javascript' src='unitegallery/js/ug-video.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-gallery.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-lightbox.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-carousel.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-api.js'></script>

	<link rel='stylesheet' href='unitegallery/css/unite-gallery.css' type='text/css' />
	
	<script type='text/javascript' src='unitegallery/themes/tiles/ug-theme-tiles.js'></script>
	<link rel='stylesheet' 		  href='unitegallery/themes/default/ug-theme-default.css' type='text/css' />
        <!-- ... End Unite Gallery ... -->
    

FIN;
    foreach ($links as $link) {
        echo "<link href = '$link' rel = 'stylesheet'>";
    }
    echo"</head><body><section id ='main-content' class='container ng-scope ui-view' style>";
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

        if ($page['name'] != 'accueil' && ($admin && $page['name'] != 'adminlogin') || (!$page['admin'] && !$admin)) {
            if ($page['menutitle'] != "hidden") {
                echo "<li><a href='index.php?page=" . $page['name'] . "'>" . $page['menutitle'];
                echo "</a></li>";
            }
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
    </section>
    <!--Footer-->

<footer class="page-footer font-small pt-4 mt-4 maincolors" >

    <!--Footer Links-->
    <div class="container text-center text-md-left">
        <div class="row">

            <div class="col-md-6 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Autour de l'Ensemble Vocal</h5>
                <ul class="list-unstyled">
                    <li>
                        <a class="mainlinks" href="#!">Nos partenaires</a>
                    </li>
                    <li>
                        <a href="#!">L'École Polytechnique</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Liens utiles</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">A propos</a>
                    </li>
                    <li>
                        <a href="#!">Contactez-nous</a>
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
                <a class="btn-floating btn-bg btn-fb mx-1" href="https://www.facebook.com/ensembleVocalEcolePolytechnique/">
                    <i class="fa fa-facebook"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-bg btn-yt mx-1" href="https://www.youtube.com/channel/UCwWtVb5arM-E14CcHeq17yQ">
                    <i class="fa fa-youtube"> </i>
                </a>
            </li>
        </ul>
    </div>
    <!--/.Social buttons-->

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        © 2018 Copyright:
        Ensemble Vocal de l'École Polytechnique
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

