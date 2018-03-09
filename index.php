<?php session_name("SessionUtilisateur");session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
require('utilities/utils.php');
require('utilities/Database.php');
$dbh = Database::connect();

//Checks the admin.



init_admin($dbh);


var_dump($_SESSION);


if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = false;
}





if (array_key_exists('page', $_GET)) {
    $page = $_GET['page'];
} else {
    $page = 'accueil';
}




$authorized = checkPage($page, $_SESSION['admin']);
if ($authorized) {
    $pageTitle = getPageTitle($page);
} else {
    $pageTitle = 'ERREUR';
}


generateHTMLHeader($pageTitle, array("css/bootstrap.css", "css/perso.css"));
?>




<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->



<?php
generateMenu($_SESSION['admin']);
?>





<div class="jumbotron" style = "color : white; background-image : url('pictures/sorbonne.png')">
    <h1 class="title">Ensemble Vocal de l'École polytechnique</h1>
</div>

<div class="container">



    <div id="content">
        
        
        
        <div>
            <h1><?php echo $pageTitle ?></h1>
        </div>
        <?php
        if ($authorized) {
            require 'content/content_' . $page . '.php';
        } else {
            echo "Désolé, la page que vous avez demandé n'existe pas ou vous n'avez pas l'autorisation d'y accéder.";
        }
        ?>
    </div>

    

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>



<?php
generateHTMLFooter();
$dbh = null;

?>

