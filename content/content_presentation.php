<div class="row ng-scope"> 
    <div class="col-md-6 col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Historique</h2>
            </div>
            <div class="panel-body">
                <?php
               require ('content/content_historique.php');
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    Le mot du directeur général</h2>
            </div>
            <div class="panel-body">
                <?php
                require('content/content_motDG.php')
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Bureau des élèves</h4>
            </div>
            <div class="panel-body">
                <?php
                $promo = Bureau::getLastPromo($dbh);
                $bureau = Bureau::getBureau($dbh, $promo);
                echo "Le bureau actuel est composé d'élèves de la promotion $promo :";
                echo "<ul>";
                
                foreach ($bureau as $membre) {
                    echo "<li>$membre->fonction : $membre->prenom $membre->nom</li>";
                }
                echo "</ul>";
                ?>
                Chef de choeur : Patrice Holiner
                <br>Courriel : <a title="Contacter le bureau" 
                                  href="mailto:bureau@chorale.polytechnique.org">
                    bureau@chorale.polytechnique.org</a>
            </div>
        </div>
    </div>

</div>