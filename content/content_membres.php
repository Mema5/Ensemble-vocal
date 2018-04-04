<?php
function printFormBureau($albums) {
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
?>