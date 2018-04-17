-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 30 mars 2018 à 17:49
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
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id_album` int(11) NOT NULL,
  `cle` int(11) NOT NULL,
  `ext` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_album`, `cle`, `ext`) VALUES
(9, 1, 'jpg'),
(9, 2, 'jpg'),
(9, 3, 'jpg'),
(9, 4, 'jpg'),
(9, 5, 'jpg'),
(9, 6, 'jpg'),
(9, 7, 'jpg'),
(9, 8, 'jpg'),
(9, 9, 'jpg'),
(10, 1, 'jpg'),
(10, 2, 'jpg'),
(10, 3, 'jpg'),
(10, 4, 'jpg'),
(10, 5, 'jpg'),
(10, 6, 'jpg'),
(10, 7, 'jpg'),
(11, 1, 'jpg'),
(11, 2, 'jpg'),
(11, 3, 'jpg'),
(11, 4, 'jpg'),
(11, 5, 'jpg'),
(11, 6, 'jpg'),
(11, 7, 'jpg'),
(11, 8, 'jpg'),
(11, 9, 'jpg'),
(11, 10, 'jpg'),
(11, 11, 'jpg'),
(11, 12, 'jpg'),
(11, 13, 'jpg'),
(11, 14, 'jpg'),
(11, 15, 'jpg'),
(11, 16, 'jpg'),
(11, 17, 'jpg'),
(11, 18, 'jpg'),
(11, 19, 'jpg'),
(11, 20, 'jpg'),
(11, 21, 'jpg'),
(11, 22, 'jpg'),
(11, 23, 'jpg'),
(11, 24, 'jpg'),
(11, 25, 'jpg'),
(11, 26, 'jpg'),
(4, 1, 'jpg'),
(4, 2, 'jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD KEY `album` (`id_album`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `album` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
