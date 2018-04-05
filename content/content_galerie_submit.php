<?php

echo "<div class='container-fluid'>";
// var_dump($_POST);

// Un album a été créé
if (isset($_POST["ajoutAlbum"])OR isset($_POST["dateAlbum"])OR isset($_POST["lieu"])) {
    echo "<div class='row'>";

    // Vérifie si toutes les infos ont bien été rentrées
    if (isset($_POST["ajoutAlbum"])AND isset($_POST["dateAlbum"])AND isset($_POST["lieu"])) {
        $titre = $_POST["ajoutAlbum"];

        // ajout dans la base de donnée
        $album = Albums::addAlbum($dbh, $titre, $_POST["dateAlbum"], $_POST["lieu"]);
        echo "<h4>L'album " . $titre . " a bien été créé. Ajoutez maintenant des photos !</h4>";
                
    } else {
        echo "<h4>Tous les champs n'ont pas été remplis !</h4>";
    }

    echo '<a href="index.php?page=galerie" class="btn btn-primary" role="button">Retourner à la galerie</a>';
    echo '                         	';
    echo '<a href="index.php?page=galerie_album&album='.$album->id.'" class="btn btn-success" role="button">Ajouter des photos</a>';
    echo "</div>";
}

// Un album a été supprimé
elseif (isset($_POST["deleteAlbum"])) {
    echo "<div class='row'>";
    $id = $_POST["deleteAlbum"];
    $album = Albums::getAlbum($dbh, $id);
    Albums::deleteAlbum($dbh, $id);
    echo "<h4>L'album " . $album->titre . " a bien été supprimé.</h4>";
    echo '<a href="index.php?page=galerie" class="btn btn-primary" role="button">Retourner à la galerie</a>';
    echo "</div>";
}

// Des photos ont été rajoutées
elseif (isset($_POST["addPhotosInAlbum"])) {
    echo "<div class='row'>";
    //var_dump($_FILES);
    
    $currentAlbumId = $_POST["addPhotosInAlbum"];
    if (empty($_FILES['photos']['tmp_name'])) {
        echo "<h4>Aucune photo sélectionnée.</h4>";
    }
    else {
        $nbPhoto = count($_FILES['photos']['tmp_name']);
        
        // vérifications de type
        $test = true;
        $allowedExtensions = array("png", "PNG", "gif", "jpg", "jpeg", "JPG", "JPEG");
        foreach($_FILES['photos']['name'] as $fileName) {
            $dec = explode(".", $fileName);
            $test = $test && in_array(end($dec), $allowedExtensions);
        }
        
        if (!$test) {
             echo "<h4>Erreur : un des fichiers n'est pas au bon type !</h4>";
        } else {        
            

            for ($i=0; $i<$nbPhoto; $i++) {
                
                $temp = $_FILES['photos']['tmp_name'][$i];
                
                $dec = explode(".", $_FILES['photos']['name'][$i]);
                $ext = end($dec);
                if ($ext == "jpg" || $ext == "JPG" || $ext == "jpeg" || $ext == "JPEG")
                    $ext = "jpg";
                elseif ($ext == "PNG" || $ext == "png")
                    $ext = "png";

                // création de la photo dans la base de donnée
                $cle = Photos::addPhoto($dbh, $currentAlbumId, $ext);
                
                // ajout de l'image HD dans les fichiers du site
                $cheminHD = 'pictures/album'. $currentAlbumId .'_photo'. $cle .'.'. $ext ;

                move_uploaded_file($temp, $cheminHD);

                
                // reduction de l'image
                /*
                $cheminLD = 'pictures/album'. $currentAlbumId .'_photo'. $cle .'_petit.'. $ext ;
                $newWidth = 300;
                list($widthOrig, $heightOrig) = getimagesize($cheminHD);
                $ratio = $widthOrig / $newWidth;
                $newHeight = $heightOrig / $ratio;
                //echo "<h4>avant create".memory_get_usage()."</h4>";
                $tmpPhotoLD = imagecreatetruecolor($newWidth, $newHeight);
                
                //echo "<h4>avant imagecreate".memory_get_usage()."</h4>";
                switch($ext){
                    // imagecreatefromjpeg décompresse la photo donc surcharge la mémoire....
                    case 'jpg': $image = imagecreatefromjpeg($cheminHD); break;
                    case 'png': $image = imagecreatefrompng($cheminHD); break;
                    case 'gif': $image = imagecreatefromgif($cheminHD); break;
                }
                //echo "<h4>après imagecreate".memory_get_usage()."</h4>";
                
                    // preserve la transparence
                if($ext == "gif" or $ext == "png"){
                    imagecolortransparent($tmpPhotoLD, imagecolorallocatealpha($tmpPhotoLD, 0, 0, 0, 127));
                    imagealphablending($tmpPhotoLD, false);
                    imagesavealpha($tmpPhotoLD, true);
                }
                    
                imagecopyresampled($tmpPhotoLD, $image, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);
                    
                switch($ext){
                    case 'jpg': imagejpeg($tmpPhotoLD, $cheminLD, 100); break;
                    case 'png': imagepng($tmpPhotoLD, $cheminLD, 100); break;
                    case 'gif': imagegif($tmpPhotoLD, $cheminLD, 100); break;
                }
                 *
                 */
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
    echo "<div class='row'>";
    $clePhoto = $_POST["deletePhoto"];
    $currentAlbumId = $_POST["currentAlbum"];
    if ($clePhoto == 'all') {
        Photos::deleteAll($dbh, $currentAlbumId);
    }
    else {
        Photos::deletePhoto($dbh, $currentAlbumId, $clePhoto);
    }
    
    $album = Albums::getAlbum($dbh, $currentAlbumId);
    echo "<h4>La(les) photos ont bien été supprimées de l'album " . $album->titre . ".</h4>";
    echo '<a href="index.php?page=galerie_album&album='. $currentAlbumId .'" class="btn btn-primary" role="button">Retourner à l\'album</a>';
    echo "</div>";
}
?>
        
