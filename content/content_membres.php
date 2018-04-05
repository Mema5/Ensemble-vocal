
<div class='container-fluid'>
    <h3>Ajout nouveau bureau</h3>
    <form action="index.php?page=membres_submit" method="post" enctype="multipart/form-data">
        <div class='row'>
            <div class='col-md-4'>
                <div class='container-fluid'>
                    <div class="form-group">
                        <label for="promo">Promotion :</label>
                        <input type='text' class="form-control" id="promo" placeholder="2048" name='ajoutBureau' required>
                    </div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='container-fluid'>
                    <div class="form-group">
                        <label for="photo">Photo du bureau (facultatif) :</label>
                        <input id="photo" name="photos" type="file" class="file">
                    </div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='container-fluid'>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success" width="100%">Créer le nouveau bureau</button>
                    </div>
                </div>
            </div>

        </div>

        <div class='row'>
            <div class='col-md-4'>
                <div class='container-fluid'>
                    <div class="form-group">
                        <label for="membre1">Membre 1 :</label>
                        <input type='text' class="form-control" id="membre1" value="Président(e)" name='fonction1'>
                        <input type='text' class="form-control" id="membre1" placeholder="Nom" name='nom1'>
                        <input type='text' class="form-control" id="membre1" placeholder="Prénom" name='prenom1'>
                    </div>
                    <div class="form-group">
                        <label for="membre2">Membre 4 :</label>
                        <input type='text' class="form-control" id="membre4" placeholder="Respo log" name='fonction4'>
                        <input type='text' class="form-control" id="membre4" placeholder="Nom" name='nom4'>
                        <input type='text' class="form-control" id="membre4" placeholder="Prénom" name='prenom4'>
                    </div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='container-fluid'>
                    <div class="form-group">
                        <label for="membre2">Membre 2 :</label>
                        <input type='text' class="form-control" id="membre2" value="Trésorier(e)" name='fonction2'>
                        <input type='text' class="form-control" id="membre2" placeholder="Nom" name='nom2'>
                        <input type='text' class="form-control" id="membre2" placeholder="Prénom" name='prenom2'>
                    </div>
                    <div class="form-group">
                        <label for="membre1">Membre 5 :</label>
                        <input type='text' class="form-control" id="membre5" placeholder="Respo web" name='fonction5'>
                        <input type='text' class="form-control" id="membre5" placeholder="Nom" name='nom5'>
                        <input type='text' class="form-control" id="membre5" placeholder="Prénom" name='prenom5'>
                    </div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='container-fluid'>
                    <div class="form-group">
                        <label for="membre3">Membre 3 :</label>
                        <input type='text' class="form-control" id="membre3" placeholder="Respo com" name='fonction3'>
                        <input type='text' class="form-control" id="membre3" placeholder="Nom" name='nom3'>
                        <input type='text' class="form-control" id="membre3" placeholder="Prénom" name='prenom3'>
                    </div>
                    <div class="form-group">
                        <label for="membre2">Membre 6 :</label>
                        <input type='text' class="form-control" id="membre6" placeholder="Fonction" name='fonction6'>
                        <input type='text' class="form-control" id="membre6" placeholder="Nom" name='nom6'>
                        <input type='text' class="form-control" id="membre6" placeholder="Prénom" name='prenom6'>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <h3>Suppression d'un bureau</h3>
    <form action="index.php?page=membres_submit" method="post" onsubmit="return confirm('Etes-vous sûr de bien vouloir supprimer le bureau sélectionné ?');">
        <div class="form-inline">
            <label for="suppr">Selectionnez le bureau à supprimer :</label> 
            <select name='deleteBureau' class="form-control" id="suppr">
    
            <?php
            // ---------- liste déroulante des promotions ----------
            $promos = Bureau::getPromos($dbh);
            foreach ($promos as $promo) {
                echo "<option value='$promo[0]'>$promo[0]</option>";
            }
            ?>
                
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Supprimer</button>
    </form>
</div>

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
        echo "<option value='$album->id'>$album->titre, " . date("d/m/Y", $date) . "</option>";
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