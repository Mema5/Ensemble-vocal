<?php
$albums = Albums::getAlbums($dbh);
//if (isset($_GET["album"]))
$currentAlbumId = $_GET["album"];
$currentAlbum = Albums::getAlbum($dbh, $currentAlbumId);
//var_dump($currentAlbum);
//var_dump($currentAlbumId);

$liste_photos = Photos::getPhotos($dbh, $currentAlbumId);
//var_dump($liste_photos);

    // ---------- Forumlaires d'admin ----------
    if ($_SESSION['admin']) {
        printFormPhoto($currentAlbumId, $liste_photos);
    }


// ---------- Affichage des photos ----------
?>
<div id="gallery" style="display:none;">

    <?php
    foreach ($liste_photos as $photo) {
        echo '<img alt="Photo'.$photo->cle.'" ';
        //quand l'upload miniature fonctionne
        //echo 'src="pictures/album'. $currentAlbumId . '_photo'. $photo->cle .'_petit.'. $photo->ext . '" ';
        echo 'src="pictures/album'. $currentAlbumId . '_photo'. $photo->cle .'.'. $photo->ext . '" ';
	echo 'data-image="pictures/album'. $currentAlbumId . '_photo'. $photo->cle .'.'. $photo->ext . '">';
    }
    ?>
 
</div>
    
<script> 

        jQuery(document).ready(function(){ 
                jQuery("#gallery").unitegallery();
        }); 

</script>



<?php

function printFormPhoto($currentAlbumId, $liste_photos) {
    echo <<<FIN
    
    <div class='row'>
        <div class='col-md-6'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                    <h3>Ajouter des photos</h3>

                    <!--Permet un upload d'images multiples
                    Les images sont alors stockées dans 
                    _FILES['image']-->




                    <form action="index.php?page=galerie_submit" method="post" enctype="multipart/form-data">
                        <label for="upload">Formats autorisés : jpg, png, gif</label> 
                        <div class="form-group">
                            <input id="upload" name="photos[]" type="file" class="file" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                        <input type="hidden" name="addPhotosInAlbum" value=$currentAlbumId>
                    </form>
                </div>
            </div>
        </div>
        
        <div class='col-md-6'>
            <div class='container-fluid'>
                <div class='col-md-10 col-md-offset-1 noir'>
                <h3>Supprimer des photos</h3>
    
                <form action="index.php?page=galerie_submit" method="post" onsubmit="return confirm('Etes-vous sûr de bien vouloir supprimer les photos selectionnées ?');">
                    <div class="form-group">
                        <label for="suppr">Selectionnez les photos à supprimer :</label>
                        <input type="hidden" name="currentAlbum" value=$currentAlbumId>
                        <select name='deletePhoto' class="form-control" id="suppr" multiple>
                        <option value='all'>-Toutes les photos-</option>
FIN;
    
                        // ---------- liste déroulante des photos ----------
                        foreach ($liste_photos as $photo) {
                            echo "<option value='$photo->cle'>Photo $photo->cle</option>";
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
?>
