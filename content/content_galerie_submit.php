<?php

echo "<div class='container-fluid'>";

// Un album a été créé
if (isset($_POST["ajoutAlbum"])OR isset($_POST["dateAlbum"])OR isset($_POST["descriptionAlbum"])) {
    echo "<div class='row'>";

    // Vérifie si toutes les infos ont bien été rentrées
    if (isset($_POST["ajoutAlbum"])AND isset($_POST["dateAlbum"])AND isset($_POST["descriptionAlbum"])) {
        $titre = $_POST["ajoutAlbum"];

        // ajout dans la base de donnée
        Albums::addAlbum($dbh, $titre, $_POST["dateAlbum"], $_POST["descriptionAlbum"]);
        echo "<h4>L'album " . $titre . " a bien été créé. Ajoutez maintenant des photos !</h4>";
                
    } else {
        echo "<h4>Tous les champs n'ont pas été remplis !</h4>";
    }
    
    echo '<a href="index.php?page=galerie" class="btn btn-primary" role="button">Retourner à la galerie</a>';
    echo "</div>";
}

// Un album a été supprimé
elseif (isset($_POST["deleteAlbum"])) {
    echo "<div class='row'>";
    $id = $_POST["deleteAlbum"];
    Albums::deleteAlbum($dbh, $id);
    $titre = Albums::getTitle($dbh, $id);
    echo "<h4>L'album " . $titre . " a bien été supprimé.</h4>";
    echo '<a href="index.php?page=galerie" class="btn btn-primary" role="button">Retourner à la galerie</a>';
    echo "</div>";
}

?>
        