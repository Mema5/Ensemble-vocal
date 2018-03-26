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

    public static function getTitle($dbh, $id) {
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

    public static function addPhotos($dbh, $nbPhotos, $id_album) {
        /*
         * Créé $nbPhotos photos supplémentaires dans l'album $id_album
         * Renvoie la clé de la première photo ajoutée
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

        $sth = $dbh->prepare("INSERT INTO `photos` (`cle`,`id_album`) VALUES (?,?)");
        for ($i = $cle_max + 1; $i <= $cle_max + $nbPhotos; $i++) {
            $sth->execute(array($i, $id_album));
        }

        return $cle_max + 1;
    }
    
    public static function deleteAll($dbh, $id_album) {
        /*
         * Supprime les photos de la base de données et des fichiers.
         */
        $liste_photos = Photos::getPhotos($dbh, $id_album);
        
        foreach($liste_photos as $photo) {
            $filename = 'pictures/album'. $photo->id_album . '_photo'. $photo->cle .'.jpg';
            unlink($filename);
        }
        
        $sth = $dbh->prepare("DELETE FROM `photos` WHERE `id_album`=?");
        $sth->execute(array($id_album));
    }
}

class Concert {

    public $oeuvre;
    public $titre;
    public $auteur;
    public $date;
    public $heure;
    public $description;
    public $lieu;
    public $id;

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

    public function print_concert() {
        echo <<<FIN
        

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Concert du $this->date : $this->oeuvre à $this->lieu</h2>
            </div>
            <div class="panel-body">
                $this->description
            </div>
        </div>
        
        
FIN;
    }

}

?>
