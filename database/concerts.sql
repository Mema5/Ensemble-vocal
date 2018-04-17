-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 12 avr. 2018 à 18:27
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ensemblevocal`
--

-- --------------------------------------------------------

--
-- Structure de la table `concerts`
--

CREATE TABLE `concerts` (
  `id` int(11) NOT NULL,
  `oeuvre` text NOT NULL,
  `titre` text NOT NULL,
  `auteur` text NOT NULL,
  `date` date NOT NULL,
  `heure` varchar(16) NOT NULL,
  `description` text NOT NULL,
  `lieu` int(64) NOT NULL,
  `billetterie` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `concerts`
--

INSERT INTO `concerts` (`id`, `oeuvre`, `titre`, `auteur`, `date`, `heure`, `description`, `lieu`, `billetterie`) VALUES
(17, 'Messiah', 'Le Messie de Haendel', 'Haendel', '2017-12-13', '20h00 précises', '<div class=\'center\' style=\'text-align: center\'>\r\n        <h2>\r\n            <small>Haendel</small>\r\n            <br>\r\n            <span aria-hidden=\'false\'>\r\n                <strong>Messiah</strong>\r\n            </span>\r\n        </h2>\r\n        <p>***</p>\r\n        <h3>le 2017-12-13 à 20h00 précises</h3>\r\n        <h3>Église Saint-Eustache</h3>\r\n        <h5>2 Impasse Saint-Eustache, 75001 Paris</h5>\r\n        <div class=\'row\'>\r\n            <p><span><strong>Soprano</strong>– Catherine MANANDAZA<br></span><span><strong>Alto</strong>– Bertrand DAZIN<br></span><span><strong>Ténor</strong>– Luca SANNAI<br></span><span><strong>Basse</strong>– Bertrand Grünenwald<br></span></p><p>***</p><p><span><strong>Orchestre</strong>– Ostinato<br></span></p><p>***</p>\r\n</div>\r\n<p>\r\n    <strong>Direction</strong> – Patrice HOLINER</p>\r\n<p></p>\r\n</div>', 1, 'https://collecte.io/test-billeterie-59423'),
(18, 'Requiem', 'Le Requiem de Mozart', 'Mozart', '2018-06-02', '20h30', '<div class=\'center\' style=\'text-align: center\'>\r\n        <h2>\r\n            <small>Mozart</small>\r\n            <br>\r\n            <span aria-hidden=\'false\'>\r\n                <strong>Requiem</strong>\r\n            </span>\r\n        </h2>\r\n        <p>***</p>\r\n        <h3>le 2018-06-02 à 20h30</h3>\r\n        <h3>Église Saint-Étienne-du-Mont</h3>\r\n        <h5>Place Sainte-Geneviève, 75005 Paris</h5>\r\n        <div class=\'row\'>\r\n            <p><span><strong>Soprano</strong>– Noémie<br></span></p><p>***</p><p><span><strong>Piano</strong>– Julien<br></span></p><p>***</p>\r\n</div>\r\n<p>\r\n    <strong>Direction</strong> – Patrice HOLINER</p>\r\n<p></p>\r\n</div>', 2, 'https://collecte.io/test-billeterie-59423');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
