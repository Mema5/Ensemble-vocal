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
    ?>
    <div id="gallery" style="display:none;">
    <?php
    foreach ($albums as $album) {
        $photos = Photos::getPhotos($dbh, $album->id);
        if (!empty($photos)) {
            $couverture = $photos[0];
            $chemin = "pictures/album".$album->id."_photo". $couverture->cle .".". $couverture->ext;
        }
        else $chemin = 'pictures/album_defaut.png';
        
        echo '<a href="index.php?page=galerie_album&album='.$album->id.'">';
        $date = strtotime($album->date);
        echo '<img alt="'.$album->titre.' - '.date("d/m/Y", $date).' - '.$album->lieu.'" ';
        echo 'src='.$chemin.' ';
	echo 'data-image='.$chemin.'>';
        echo '</a>';
    }
    ?>
 
    </div>  
    <script type="text/javascript"> 
            jQuery(document).ready(function(){ 
                    jQuery("#gallery").unitegallery({
                                tiles_justified_row_height: 300,
                                tile_enable_icons:false,
                                tile_enable_textpanel:true,
                                tile_textpanel_title_text_align: "center",
                                tile_textpanel_always_on:true,
                                tile_as_link: true,
                                tile_link_newpage: false,
                                tiles_type: "justified"
                    });
            }); 
    </script>   
</div>

    <?php
//    $colonne = 1;
//    foreach ($albums as $album) {
//        if ($colonne==1) { 
//            echo "<div class='row'>";
//        }
//        echo "<div class='col-md-4'>";
//        printAlbum($album);
//        echo "</div>";
//        
//        $colonne++;
//        if ($colonne==4) {
//            echo "</div>";
//            $colonne=1;
//        }
//    }
//    echo "</div>";
//    ?>

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
                        <label for="lieu">Lieu : </label>
                        <input type='text' class="form-control" id="lieu" placeholder="Bataclan" name='lieu' required>
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
        $date = strtotime($album->date);
        echo "<option value='$album->id'>$album->titre, ".date("d/m/Y",$date)."</option>";
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
