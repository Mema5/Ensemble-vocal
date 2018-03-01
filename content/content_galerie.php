<html>
    <?php
    echo "<div class='container-fluid'>";
    var_dump($_SESSION);
    var_dump($_GET);
    
    // ---------- Forumlaires d'admin ----------
    if ($_SESSION['admin']) {
        printFormAlbum();
    }
    
    // ---------- Affichage des albums photo ----------
    $albums = Albums::getAlbums($dbh);
    $colonne = 1;
    foreach ($albums as $album) {
        if ($colonne==1) { 
            echo "<div class='row'>";
        }
        echo "<div class='col-md-4'>";
        printAlbum($album);
        echo "</div>";
        
        $colonne++;
        if ($colonne==4) {
            echo "</div>";
            $colonne=1;
        }
    }
    echo "</div>";
    ?>
   
</html>

<?php
function printFormAlbum() {
    echo <<<FIN
    <div class='row'>
        <div class='col-md-4'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                <h3>Créer un nouvel album</h3>
                <form method="post">
                    Nom de l'album photo : <input type='text' name='titre'><br>
                    Date de l'album : <input type='date' name='date'><br>
                    Description : <input type='text' name='description'><br>
                    <input type="submit" value="envoyer">
                </form>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                <h3>Supprimer un album</h3>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                <h3>Bla</h3>
                </div>
            </div>
        </div>
    </div>
FIN;
}
    
/*
        <h1>Upload de fichiers</h1>
        <h2>Formulaire</h2>
        <h3>Envoyer des photos</h3>
        <?php
        //echo Albums::addPhotos($dbh, 10, "album2");
        ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <!--Permet un upload d'images multiples
            Les images sont alors stockées dans 
            $_FILES['image']-->
            <p>Nom de l'album : <select name='album'>
                <?php
                $titres = Albums::getAlbums($dbh);
                        foreach ($titres as $titre) {
                            echo "<option value='$titre'>$titre</option>";
                        }
                ?>
                
                </select></p>
            <input id="image" type="file" name="image[]" multiple>
            <br>
            <input type="submit" value="envoyer"/>
        </form>
        
        <h3>Créer un album</h3>
        <form>
            Nom de l'album photo : <input type='text' name='titre'><br>
            Date de l'album : <input type='date' name='date'><br>
            Description : <input type='text' name='description'><br>
        </form>
*/

function printAlbum($album) {
    echo <<<FIN
    <div class='container-fluid'>
        <div class='col-md-10 col-md-offset-1 noir'>
            <img class="img-responsive" src='pictures/album_defaut.png' alt="$album->titre">
            <h2>$album->titre</h2>
            <p>$album->description</p>
        </div>
    </div>
FIN;
}
?>
