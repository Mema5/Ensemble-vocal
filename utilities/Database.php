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
        if ($user->password == SHA1($mdp)) {
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
            $_SESSION['loggedIn']=true;
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
        }
    }
}

class Albums {
    
    public $titre;
    public $date;
    public $description;
    
    public static function getAlbums($dbh) {
        $sth = $dbh->prepare("SELECT * FROM `albums` ORDER BY `albums`.`date` DESC");
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Albums');
        $sth->execute();
        $liste_album = $sth->fetchAll();
        return $liste_album;
    }
    
    public static function addAlbum($dbh, $titre, $date, $description) {
        $sth = $dbh->prepare("INSERT INTO `albums` (`titre`, `date`, `description`) VALUES (?,?,?)");
        $sth->execute(array($titre, $date, $description));
    }
    
    public static function deleteAlbum($dbh, $titre) {
        $sth = $dbh->prepare("DELETE FROM `albums` WHERE `titre`=?");
        $sth->execute(array($titre));         
    }
    
    public static function addPhotos($dbh, $nbPhotos, $titre_album) {
        /*
         * Créé $nbPhotos photos supplémentaires dans l'album $titre_album
         * Renvoie la clé de la première photo ajoutée
         */
        $sth = $dbh->prepare("SELECT max(`photos`.`cle`) FROM `photos` WHERE (`photos`.`titre_album` = ?)");
        
        $sth->execute(array($titre_album));
        $cle_max = $sth->fetch();
        // cle_max[0] vaut la plus grande clé des photos de l'album ou NULL si pas de photo
        
        if ($cle_max==NULL) {
            $cle_max = 0;
        }
        else {
            $cle_max = (int) $cle_max[0];
        }
        
        $sth = $dbh->prepare("INSERT INTO `photos` (`cle`,`titre_album`) VALUES (?,?)");
        for ($i=$cle_max+1; $i<=$cle_max+$nbPhotos; $i++) {
            $sth->execute(array($i, $titre_album));
        }
        
        return $cle_max+1;
    }  
}

?>