-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 05 avr. 2018 à 02:54
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
-- Structure de la table `bureaux`
--

CREATE TABLE `bureaux` (
  `promotion` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `fonction` varchar(32) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bureaux`
--

INSERT INTO `bureaux` (`promotion`, `nom`, `prenom`, `fonction`, `id`) VALUES
(2016, 'Périvier', 'Noémie', 'Présidente', 15),
(2016, 'Guillen', 'Anthony', 'Trésorier', 16),
(2016, 'Raison ', 'Louis', 'Respo com', 17),
(2016, 'Vanhaesbroucke', 'Yolène', 'Respo com', 18),
(2016, 'Yu', 'Raphaël', 'Secrétaire Général', 19),
(2016, 'Madon', 'Maël', 'Respo web', 20);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bureaux`
--
ALTER TABLE `bureaux`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bureaux`
--
ALTER TABLE `bureaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
