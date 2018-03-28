-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 28 mars 2018 à 10:17
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
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `titre` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`titre`, `description`, `date`, `id`) VALUES
('album1', 'Test : premier album', '2018-02-07', 1),
('album2', 'Deuxième album de la série, youhou !', '2017-02-22', 2),
('Messie de Haendel', 'Donné le 13 décembre 2017 à l\'église de la Madeleine. Solistes : Madame Machin / Madame Truc / Monsieur Bidule / Monsieur Truc. Orchestre Ostinato bla bla.', '2017-12-13', 3),
('Petite Messe Solennelle de Rossini', 'Premier concert avec la nouvelle promotion X2016 ! La représentation a eu lieu à l\'Eglise Saint-Etienne-Du-Mont le 1er juin 2017. Le coeur était accompagné par Yun-Ho au piano, Juliette Bidule à l\'harmonium et les quatre solistes Amanda Troy, Philippa Rodriguez, Jean-Claude Schmidt et Eric-Emmanuel Trucmuch.', '2017-06-01', 4),
('blaz', 'Court paragraphe sur le concert. Préciser le lieu, les solistes...', '2018-03-23', 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
