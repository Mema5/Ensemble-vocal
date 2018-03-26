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
        printFormPhoto($currentAlbumId);
        //Photos::deleteAll($dbh, $currentAlbumId);
    }
?>

<!--
<div class="navbar-wrapper">
    <div class="container">
        <div class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Photo Album Gallery</a>
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right text-center">
                        <li id="s1" class="clink">
                            <a href="#" data-target="#myCarousel" data-slide-to="0" class="active">Album 1</a>
                        </li>
                        <li id="s2" class="clink"><a href="#" data-target="#myCarousel" data-slide-to="1">Album 2</a></li>
                        <li id="s3" class="clink"><a href="#" data-target="#myCarousel" data-slide-to="2">Album 3</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<div id="home" class="header">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <div class="item active">
                <div class="container">
                    <div id="slide1" class="masonry">

                        <?php
                        foreach ($liste_photos as $photo) {
                            echo '<div class="post-box col-lg-4 col-md-4 col-sm-4">';
                            echo '<img class="img-responsive" src="pictures/album'. $currentAlbumId . '_photo'. $photo->cle .'.'. $photo->ext . '" alt=' . $currentAlbum->titre . '>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

function printFormPhoto($currentAlbumId) {
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
    
                <form action="index.php?page=galerie_submit" method="post" onsubmit="return confirm('Etes-vous sûr de bien vouloir supprimer l\'album et toutes les photos qui lui sont associées ?');">
                    <div class="form-group">
                        <label for="suppr">Selectionnez les photos à supprimer :</label>
                        <input type="hidden" name="currentAlbum" value=$currentAlbumId>
                        <select name='deletePhoto' class="form-control" id="suppr">
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
