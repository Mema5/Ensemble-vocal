<html>
    <?php
    echo "<div class='container-fluid'>";

    $albums = Albums::getAlbums($dbh);
    //var_dump($albums);
    //var_dump($_SESSION);
    //var_dump($_POST);


    // ---------- Forumlaires d'admin ----------
    if ($_SESSION['admin']) {
        printFormAlbum($albums);
    }
    
    // ---------- Affichage des albums photo ----------
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
function printFormAlbum($albums) {
    echo <<<FIN
    <div class='row'>
        <div class='col-md-6'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                <h3>Créer un nouvel album</h3>
                
                <form action="index.php?page=galerie_submit" method="post">
                    <div class="form-group">
                        <label for="album">Nom de l'album photo :</label>
                        <input type='text' class="form-control" id="album" placeholder="Messe en si de Holiner" name='ajoutAlbum' required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date de l'évènement :</label>
                        <input type='date' class="form-control" id="date" name='dateAlbum' required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description : </label>
                        <textarea class="form-control" name="descriptionAlbum" id="description" rows="4" required>Court paragraphe sur le concert. Préciser le lieu, les solistes...</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                <h3>Supprimer un album</h3>
    
                <form action="index.php?page=galerie_submit" method="post" onsubmit="return confirm('Etes-vous sûr de bien vouloir supprimer l\'album et toutes les photos qui lui sont associées ?');">
                    <div class="form-group">
                        <label for="suppr">Selectionnez l'album à supprimer :</label> 
                        <select name='deleteAlbum' class="form-control" id="suppr">
FIN;
    
    // ---------- liste déroulante du nom des albums ----------
    foreach ($albums as $album) {
        echo "<option value='$album->id'>$album->titre, $album->date</option>";
    }
    
    echo <<<FIN
                
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                </form>
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
            <a href="index.php?page=galerie_album&album=$album->id"><img class="img-responsive" src='pictures/album_defaut.png' alt="$album->titre"></a>
            <h2><a href="index.php?page=galerie_album&album=$album->id">$album->titre</a></h2>
            <h4>$album->date</h4>
            <p>$album->description</p>
        </div>
    </div>
FIN;
}
?>
