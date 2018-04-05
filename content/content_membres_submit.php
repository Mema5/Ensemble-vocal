<?php
echo "<div class='container-fluid'>";

// Un bureau a été créé
if (isset($_POST["ajoutBureau"])) {
    echo "<div class='row'>";
    $promo = $_POST["ajoutBureau"];
    
    // Ajout des membres dans la base de donnée
    for ($i=1;$i<=6;$i++) {
        if ($_POST['fonction'.$i] != "") {
            Bureau::addMembre($dbh, $promo, $_POST['nom'.$i], $_POST['prenom'.$i], $_POST['fonction'.$i]);
        }
    }
    
    // Gestion de l'image facultative ;)
    if (!empty($_FILES['photos']['tmp_name'])) {
        // vérifications de type
        $test = true;
        $allowedExtensions = array("png", "PNG", "gif", "jpg", "jpeg", "JPG", "JPEG");
        $fileName = $_FILES['photos']['name'];
        $dec = explode(".", $fileName);
        $ext = end($dec);
        $test = $test && in_array(end($dec), $allowedExtensions);
        
        if (!$test) {
            echo "<h4>Erreur : un des fichiers n'est pas au bon type !</h4>";
        } 
        else {        
            $temp = $_FILES['photos']['tmp_name'];
            if ($ext == "jpg" || $ext == "JPG" || $ext == "jpeg" || $ext == "JPEG")
                $ext = "jpg";
            elseif ($ext == "PNG" || $ext == "png")
                $ext = "png";

            $chemin = "pictures/bureau_$promo.$ext";
            move_uploaded_file($temp, $chemin);
        }

            echo "<h4>Photos du bureau ajoutée.</h4>";
        }
 
    echo "<h4>Le bureau " . $promo . " a bien été créé !</h4>";
    echo '<a href="index.php?page=membres" class="btn btn-primary" role="button">Retourner à la page membre</a>';
    echo "</div>";
}

// Un bureau a été supprimé
if (isset($_POST["deleteBureau"])) {
    $promo = $_POST["deleteBureau"];
    Bureau::deleteBureau($dbh, $promo);
    echo "<h4>Le bureau " . $promo . " a bien été supprimé !</h4>";
    echo '<a href="index.php?page=membres" class="btn btn-primary" role="button">Retourner à la page membre</a>';
}