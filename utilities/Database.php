<?php

class Database {

    public static function connect() {
        $dsn = 'mysql:dbname=ensemblevocal;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }

}

// opérations sur la base
//$dbh = Database::connect();
//$dbh->query("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES('moi',SHA1('nombril'),'bebe','louis','2005','1980-03-27','Marcel.Dupont@polytechnique.edu','modal.css')");
//$sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES(?,SHA1(?),?,?,?,?,?,?)");
//$sth->execute(array('SuperMarcel','Mystere','Marcel','Dupont','2005','1980-03-27','Marcel.Dupont@polytechnique.edu','modal.css'));
//ATTENTION : On ne fait pas de preparation en utilisant directement des parametres que rentre l'utilisateur!!!
//Il est necessaire d'utiliser '?' qui sera complété par des paramètres.
//Dans le cas contraire, l'utilisateur pourrait ajouter des commandes sql, qui pourraient lui
//donner accès à des informations confidentielles, ou qui pourraient détruire la base de données.
//$dbh = null; // Déconnexion de MySQL


class Utilisateur {

    public $login;
    public $password;
    public $email;
    public $admin;

    public static function getUtilisateur($dbh, $login) {
        $sth = $dbh->prepare("SELECT * FROM `utilisateurs` WHERE `login`=?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array($login));
        $user = $sth->fetch();
        return $user;
    }

    public static function testerMdp($dbh, $login, $mdp) {
        $user = Utilisateur::getUtilisateur($dbh, $login);
        if (isset($user->password) && $user->password == SHA1($mdp)) {
            return true;
        }
        return false;
    }

    public static function insererUtilisateur($dbh, $login, $mdp, $email, $admin) {
        $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `email`, `admin`) VALUES (?, SHA1(?), ?,?)");
        $sth->execute(array($login, $mdp, $email, $admin));
    }

}

function login($dbh) {
    if (isset($_POST['login']) and isset($_POST['mdp'])) {
        if (Utilisateur::testerMdp($dbh, $_POST['login'], $_POST['mdp'])) {
            $_SESSION['loggedIn'] = true;
            $user = Utilisateur::getUtilisateur($dbh, $_POST['login']);
            $_SESSION['admin'] = $user->admin;
        }
    }
}

function init_admin($dbh) {
    if (array_key_exists('todo', $_GET)) {
        $todo = $_GET['todo'];
        if ($todo == 'login') {
            login($dbh);
        } elseif ($todo == 'disconnect') {
            disconnect();
        }
    }
}

class Albums {

    public $id;
    public $titre;
    public $date;
    public $description;

    public static function getAlbums($dbh) {
        /*
         * Retourne la liste des albums photos sous forme d'une liste d'objets
         * de la classe Albums.
         */
        $sth = $dbh->prepare("SELECT * FROM `albums` ORDER BY `albums`.`date` DESC");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Albums');
        $sth->execute();
        $liste_album = $sth->fetchAll();
        return $liste_album;
    }

    public static function getAlbum($dbh, $id) {
        /*
         * Retourne l'objet de classe Album correspondant au à l'id
         */
        $sth = $dbh->prepare("SELECT `titre` FROM `albums` WHERE `id`=?");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Albums');
        $sth->execute(array($id));
        $alb = $sth->fetch();
        return $alb;
    }

    public static function addAlbum($dbh, $titre, $date, $description) {
        $sth = $dbh->prepare("INSERT INTO `albums` (`titre`, `date`, `description`) VALUES (?,?,?)");
        $sth->execute(array($titre, $date, $description));
    }

    public static function deleteAlbum($dbh, $id) {
        $sth = $dbh->prepare("DELETE FROM `albums` WHERE `id`=?");
        $sth->execute(array($id));
    }

}

class Photos {

    public $cle;
    public $id_album;
    public $ext;
    
    public static function getPhoto($dbh, $id_album, $clePhoto) {
        /*
         * Retourne l'objet photo correspondant à la clé $clePhoto
         */
        $sth = $dbh->prepare("SELECT * FROM `photos` WHERE (`photos`.`id_album` = ? AND `photos`.`cle` = ?)");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Photos');
        $sth->execute(array($id_album, $clePhoto));
        $photo = $sth->fetch();
        return $photo;
    }

    public static function getPhotos($dbh, $id_album) {
        /*
         * Retourne la liste des photos de l'album sous forme d'une 
         * liste d'objet de la classe Photos.
         */
        $sth = $dbh->prepare("SELECT * FROM `photos` WHERE (`photos`.`id_album` = ?)");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Photos');
        $sth->execute(array($id_album));
        $liste_photos = $sth->fetchAll();
        return $liste_photos;
    }

    public static function addPhoto($dbh, $id_album, $ext) {
        /*
         * Créé une photos supplémentaires dans l'album $id_album
         * Renvoie la clé de la photo ajoutée.
         */

        $sth = $dbh->prepare("SELECT max(`photos`.`cle`) FROM `photos` WHERE (`photos`.`id_album` = ?)");
        $sth->execute(array($id_album));
        $cle_max = $sth->fetch();
        // cle_max[0] vaut la plus grande clé des photos de l'album ou NULL si pas de photo
        

        if ($cle_max == NULL) {
            $cle_max = 0;
        } else {
            $cle_max = (int) $cle_max[0];
        }

        $sth = $dbh->prepare("INSERT INTO `photos` (`cle`,`id_album`,`ext`) VALUES (?,?,?)");
        $sth->execute(array($cle_max+1, $id_album, $ext));

        return $cle_max + 1;
    }
    

//    public static function addPhotos($dbh, $nbPhotos, $id_album) {
//        /*
//         * Créé $nbPhotos photos supplémentaires dans l'album $id_album
//         * Renvoie la clé de la première photo ajoutée
//         */
//
//        $sth = $dbh->prepare("SELECT max(`photos`.`cle`) FROM `photos` WHERE (`photos`.`id_album` = ?)");
//
//        $sth->execute(array($id_album));
//        $cle_max = $sth->fetch();
//        // cle_max[0] vaut la plus grande clé des photos de l'album ou NULL si pas de photo
//
//        if ($cle_max == NULL) {
//            $cle_max = 0;
//        } else {
//            $cle_max = (int) $cle_max[0];
//        }
//
//        $sth = $dbh->prepare("INSERT INTO `photos` (`cle`,`id_album`) VALUES (?,?)");
//        for ($i = $cle_max + 1; $i <= $cle_max + $nbPhotos; $i++) {
//            $sth->execute(array($i, $id_album));
//        }
//
//        return $cle_max + 1;
//    }
    
    public static function addPhotos($dbh, $nbPhotos, $titre_album) {
        /*
         * Créé $nbPhotos photos supplémentaires dans l'album $titre_album
         * Renvoie la clé de la première photo ajoutée
         */
        $sth = $dbh->prepare("SELECT max(`photos`.`cle`) FROM `photos` WHERE (`photos`.`titre_album` = ?)");
        
        foreach($liste_photos as $photo) {
            Photos::deletePhoto($dbh, $photo->id_album, $photo->cle);
        }
    }
    
    public static function deletePhoto($dbh, $id_album, $clePhoto) {
        /*
         * Supprime la photos de la base de données et des fichiers.
         */
        $photo = Photos::getPhoto($dbh, $id_album, $clePhoto);
        
        $filename = 'pictures/album'. $id_album . '_photo'. $clePhoto . '.' . $photo->ext;
        unlink($filename);
        
        $sth = $dbh->prepare("DELETE FROM `photos` WHERE `id_album`=? AND `cle` = ?");
        $sth->execute(array($id_album, $clePhoto));
    }

}

class Concert{
  public $id;
    public $oeuvre;
    public $titre;
    public $auteur;
    public $date;
    public $heure;
    public $description;
    public $lieu;
    

    public static function getConcerts($dbh) {
        $sth = $dbh->prepare("SELECT * FROM `concerts` ORDER BY `date` DESC");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Concert');
        $sth->execute();
        $liste_album = $sth->fetchAll();
        return $liste_album;
    }

    public static function addConcert($dbh, $oeuvre, $titre, $auteur, $date, $heure, $description, $lieu) {
        $sth = $dbh->prepare("INSERT INTO `concerts` (`oeuvre`, `titre`, `auteur`, `date`, `heure`, `description`, `lieu`) VALUES (?,?,?,?,?,?,?)");
        $sth->execute(array($oeuvre, $titre, $auteur, $date, $heure, $description, $lieu));
    }

    public static function deleteConcert($dbh, $id) {
        $sth = $dbh->prepare("DELETE FROM `concerts` WHERE `id`=?");
        $sth->execute(array($id));
    }
    
    public static function getMonth($m){
        if ($m=="01") {return "Janvier";}
        elseif ($m=="02") {return "Février";}
        elseif ($m=="03") {return "Mars";}
        elseif ($m=="04") {return "Avril";}
        elseif ($m=="05") {return "Mai";}
        elseif ($m=="06") {return "Juin";}
        elseif ($m=="07") {return "Juillet";}
        elseif ($m=="08") {return "Août";}
        elseif ($m=="09") {return "Septembre";}
        elseif ($m=="10") {return "Octobre";}
        elseif ($m=="11") {return "Novembre";}
        elseif ($m=="12") {return "Décembre";}
    }

    public function print_concert($admin,$isFirst) {
        $date=explode("-", $this->date);
        $year=$date[0];
        $month=Concert::getMonth($date[1]);
        $day=$date[2];
        $description= $this->description;
        $time= $this->heure;
        
        
        echo <<<FIN
<div class="row event secondary1" id="concert$this->id">
<div class="row event-banner">
    <div class="col-xs-4 col-sm-2 date-block">
        <span class="day">$day</span>
        <span class="month">$month</span>
        <span class="year">$year</span>
        <span class="time">20:00</span>
    </div>
    
    <div class="img col-xs-8 col-sm-3">
        <img alt="Mozart" src="pictures/Mozart.png" style="width:100%"/>
    </div>
    <div class="info col-xs-10 col-sm-5">

            <h2>$this->titre</h2>

            
    </div>
    <div class="social col-xs-2 col-sm-1 align-middle">
        <a class="btn-floating btn-sm btn-fb mx-1" href="https://www.facebook.com/ensembleVocalEcolePolytechnique/"><span class="fa fa-facebook"></span></a>
    </div>
</div>
<div class="row event-description tertiary">
    <div class="row presentation-row">
        <div class="col-md-9 presentation">
            <h3>Présentation :</h3>
            $description
        </div>
        <div class="col-md-3 tarifs">
            <h3>Tarifs :</h3>
            <ul>
                <li>
                    Places numérotées : 30€.
                </li>
                <li>
                    Placement libre : 20€.
                </li>
                <li>
                    Tarif étudiant : 15€.
                </li>
            </ul>
        </div>
</div>
<hr class="style14">
<br>
<div class="localisation row">
FIN;
        
    if($isFirst){
        echo<<<FIN
        <div class="col-xs-12 col-md-8 map">
        <div id="map" class="map"></div>
</div>
<div class="col-xs-12 col-md-4">
<h3>Adresse : </h3>
1 avenue Charles de Gaulle, 75000 Paris.
   </div>
FIN;
    }
    else{
        echo<<<FIN
        <div class="col-xs-12">
            <h3>Adresse : </h3>
            1 avenue Charles de Gaulle, 75000 Paris.
        </div>
FIN;
    }
    echo<<<FIN
    </div>
</div>
<div class="row see-more-book">
    <div class="btn-group btn-group-justified">
FIN;
    if($isFirst){echo"<a class='btn btn-default'>Réserver</a>";}
echo<<<FIN
    <a class='btn btn-default afficherconcert'>Afficher plus</a>
    </div>
</div>
</div>
FIN;
     if ($admin){
        echo"<a href=# class='remove-concert'>Supprimer</a>";
        echo"<a href=# class='modify-concert'>Modifier</a>";
    }


               
}
}
?>


