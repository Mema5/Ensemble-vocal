



<form action="index.php?page=concerts&TODO=add_concert" method="post">
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6">
            <label for="inputOeuvre">Oeuvre</label>
            <input type="text" class="form-control" id="oeuvre" name="oeuvre" placeholder="Messiah">
        </div>
        <div class="form-group col-xs-12 col-sm-6">
            <label for="inputAuteur">Auteur</label>
            <input type = "text" class="form-control" id="auteur" name="auteur" placeholder="Haendel">
        </div>
        <div class="form-group col-xs-12 col-sm-6">
            <label for="inputTitre">Titre complet</label>
            <input type = "text" class="form-control" id="titre" name="titre" placeholder="Le Messie de Haendel">
        </div>
        <div class="form-group col-xs-6 col-sm-3">
            <label for="inputDate">Date</label>
            <input type="date" class="form-control" name="date" id="date">
        </div>
        <div class="form-group col-xs-6 col-sm-3">
            <label for="inputHeure">Heure</label>
            <input type="text" class="form-control" name="heure" id="heure" placeholder="ex : 20h précises">
        </div>
    </div>

    <div class="solists col-xs-12 col-sm-3">
        <div class="row">
            <input type="hidden" name="count" value="1" />
            <div class="control-group" id="fields">
                <label class="control-label" for="inputSingers">Chanteurs</label>
                <div class="controls" id="singers"> 
                    <div id="field1">
                        <input autocomplete="off" class="input form-control" id="soliste1" name="soliste1" type="text" placeholder="Soprano" data-items="8"/>
                        <input autocomplete="off" class="input form-control" id="nomsoliste1" name="nomsoliste1" type="text" placeholder="Prénom NOM" data-items="8"/>
                    </div>
                    <button id="b1" class="btn add-more" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
    <div class="solists col-xs-12 col-sm-3">
        <div class="row">
            <input type="hidden" name="counter" value="1" />
            <div class="control-group" id="fields">
                <label class="control-label" for="inputMusicians">Musiciens</label>
                <div class="controls" id="musicians"> 
                    <div id="musician1">
                        <input autocomplete="off" class="input form-control" id="musicien1" name="musicien1" type="text" placeholder="Piano" data-items="8"/>
                        <input autocomplete="off" class="input form-control" id="nommusicien1" name="nommusicien1" type="text" placeholder="Prénom NOM" data-items="8"/>
                    </div>
                    <button id="bm1" class="btn add-more-musician" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="center" style="text-align: center">
            <h2>Aperçu :</h2>
            <h2>
                <small>Johannes BRAHMS</small>
                <br>
                <span aria-hidden="false">
                    <strong>Ein Deutches Requiem</strong>
                </span>
            </h2>
            <p>***</p>
            <h3>mercredi 14 mars 2018 à 20h30</h3>
            <h3>Église Saint-Eustache</h3>
            <h5>2 Impasse Saint-Eustache, 75001 Paris</h5>
            <div class="row">
                <p>
                    <span>
                        <strong>Soprano</strong>
                        – Catherine MANANDAZA<br>
                    </span>
                    <span>
                        <strong>Baryton</strong> – Jean-Louis JARDON<br>
                    </span>   
                </p>
                <p>***</p>
                <p>
                    <span>
                        <strong>Piano</strong>
                        – Yun-Ho CHEN<br>
                    </span>
                    <span>
                        <strong>Piano</strong> – Jessica PAPASIDERO<br>
                    </span>
                    <span>
                        <strong>Timbaliers</strong> – Guy BORDERIEUX<br>
                    </span>
                </p>
                <p>***</p>
            </div>
            <p>
                <strong>Direction</strong> – Patrice HOLINER</p>
            <p></p>
        </div>
    </div>
    
    
    <div class="col-xs-12 col-md-6">
        <label for="inputLieu">Lieu du Concert</label>
        <select class="form-control custom-select input" name="lieu">
            <option selected>Choisissez un lieu</option>
            <?php
            $lieux = Lieu::getLieux($dbh);
            foreach ($lieux as $lieu){
                echo "<option value=$lieu->id>$lieu->nom</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-xs-12 col-md-6">
        <label for="inputBilletterie">Lien vers la Billetterie</label>
        <input type = "text" class="form-control" id="billetterie" name="billetterie" placeholder="https://collecte.io/test-billeterie-59423">
        <small>Attention : créer en premier lieu la billetterie via la console de gestion Lydia.</small>
    </div>

    <div class="col-xs-offset-2 col-xs-8">
        <button type="submit" class="btn btn-primary" style="align-content: center; width: 100%">Submit</button>
    </div>

</form>


<script src="js/solistForm.js"></script>