<?php

echo "<div class='container-fluid'>";
var_dump($_POST);

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

// Des photos ont été rajoutées
elseif (isset($_POST["addPhotosInAlbum"])) {
    echo "<div class='row'>";
        var_dump($_FILES);
    
    $currentAlbumId = $_POST["addPhotosInAlbum"];
    if (empty($_FILES['photos']['tmp_name'])) {
        echo "<h4>Aucune photo sélectionnée.</h4>";
    }
    else {
        $nbPhoto = count($_FILES['photos']['tmp_name']);
        
        // vérifications de type
        $test = true;
        $allowedExtensions = array("png", "gif", "jpg", "jpeg");
        echo "file name";
        var_dump($_FILES['photos']['name']);
        foreach($_FILES['photos']['name'] as $fileName) {
            $dec = explode(".", $fileName);
            $test = $test && in_array(end($dec), $allowedExtensions);
        }
        
        if (!$test) {
             echo "<h4>Erreur : un des fichiers n'est pas au bon type !</h4>";
        } else {        
            // création des photos dans la base de donnée
            $cle = Photos::addPhotos($dbh, $nbPhoto, $currentAlbumId);

            // ajout des images dans les fichiers du site
            for ($i=0; $i<$nbPhoto; $i++) {
                $temp = $_FILES['photos']['tmp_name'][$i];
                $dec = explode(".", $_FILES['photos']['name'][$i]);
                $ext = end($dec);
                move_uploaded_file($temp, 'pictures/album'. $currentAlbumId .'_photo'. $cle .'.'. $ext );
                $cle = $cle + 1;
            }

            echo "<h4>$nbPhoto photos ajoutées.</h4>";
        }
    }
    
    /*
    if (!empty($_FILES['photos']['tmp_name']) && is_uploaded_file($_FILES['fichier']['tmp_name'])) {
// Le fichier a bien été téléchargé
// Par sécurité on utilise getimagesize plutot que les variables $_FILES
        list($larg, $haut, $type, $attr) = getimagesize($_FILES['fichier']['tmp_name']);
        echo $larg . " " . $haut . " " . $type . " " . $attr;
// JPEG => type=2
        if ($type == 2) {
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], 'images/toto.jpg')) {
                echo "Copie réussie";
            } else {
                echo "echec de la copie";
            }
        } else
            echo "mauvais type de fichier";
    }
     *
     */
    

    echo '<a href="index.php?page=galerie_album&album='. $currentAlbumId .'" class="btn btn-primary" role="button">Retourner à l\'album</a>';
    echo "</div>";
}

// Des photos ont été supprimées
elseif (isset($_POST["deletePhoto"])) {
    
}
?>
        