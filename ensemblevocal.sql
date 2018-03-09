-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 09 mars 2018 à 14:15
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
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `login` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`login`, `password`, `email`) VALUES
('raison', 'c129b324aee662b04eccf68babba85851346dff9', 'louisraison1@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `titre` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`titre`, `description`, `date`) VALUES
('album1', 'Test : premier album', '2018-02-07'),
('album2', 'Deuxième album de la série, youhou !', '2017-02-22'),
('Messie de Haendel', 'Donné le 13 décembre 2017 à l\'église de la Madeleine. Solistes : Madame Machin / Madame Truc / Monsieur Bidule / Monsieur Truc. Orchestre Ostinato bla bla.', '2017-12-13'),
('Petite Messe Solennelle de Rossini', 'Premier concert avec la nouvelle promotion X2016 ! La représentation a eu lieu à l\'Eglise Saint-Etienne-Du-Mont le 1er juin 2017. Le coeur était accompagné par Yun-Ho au piano, Juliette Bidule à l\'harmonium et les quatre solistes Amanda Troy, Philippa Rodriguez, Jean-Claude Schmidt et Eric-Emmanuel Trucmuch.', '2017-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `content_presentation`
--

CREATE TABLE `content_presentation` (
  `name` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `content_presentation`
--

INSERT INTO `content_presentation` (`name`, `content`) VALUES
('Historique', 'L\'Ensemble Vocal de l\'École polytechnique regroupe 90 chanteurs amateurs : élèves polytechniciens, internationaux, anciens élèves, personnels de l\'école ou des laboratoires... Dirigé par le chef de choeur Patrice Holiner, il se produit régulièrement dans des lieux prestigieux, interprétant principalement des œuvres classiques du chant choral.\r\n\r\nAinsi, il a dernièrement eu l\'occasion de donner en concert le Requiem de Cherubini, la Messe du Couronnement de Mozart, ainsi que le Messie de Handel.\r\n\r\nLa chorale participe également régulièrement à des actions solidaires, en donnant des concerts au profit d\'associations telles que LyricAutsim (cathédrale d\'Evry en février 2010), l\'Ordre de Malte (Grand Amphithéâtre de la Sorbonne en mars 2011) et l\'Association Petits Princes (église Saint-Eustache en décembre 2012), la fondation d\'Auteuil...'),
('Le mot du directeur général', 'L’École polytechnique a toujours eu la volonté d\'allier l\'excellence scientifique à la tradition et à l\'humanisme. Son projet pédagogique est de former des hommes et des femmes équilibrées, à la personnalité affirmée.\r\nL\'Ensemble vocal s\'inscrit pleinement dans ce projet. La musique permet en effet aux élèves de développer leur sensibilité artistique tout en faisant appel aux qualités de rigueur et d\'effort qu\'ils mettent en œuvre quotidiennement dans leurs études scientifiques. Le chant leur donne également l\'occasion de s\'investir dans un projet commun et de montrer ce qu\'ils peuvent réussir ensemble.\r\nL\'Ensemble vocal constitue ainsi une preuve vivante de la richesse et de la diversité des talents de l’École. C\'est avec beaucoup de plaisir, et une certaine fierté, que je vous invite à partager l\'enthousiasme des choristes et leur passion pour le chant.'),
('DG', 'Ingénieur Général Hors Classe de l\'Armement Yves Demay\r\nDirecteur Général de l\'École Polytechnique'),
('Président', 'Noémie Perivier'),
('Promotion', '2016'),
('Logistique', 'Anthony Guillen'),
('Secrétaire Général', 'Raphaël Yu'),
('Communication', 'Yolène Vanhaesbroucke et Louis Raison'),
('Chef de choeur', 'Patrice Holiner'),
('Couriel', 'bureau@chorale.polytechnique.org'),
('Trésorier', 'Maël Madon');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `titre_album` varchar(128) NOT NULL,
  `cle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`titre_album`, `cle`) VALUES
('album1', 2),
('album1', 3),
('album1', 4),
('album1', 5),
('album1', 6),
('album1', 7),
('album1', 8),
('album1', 9),
('album1', 10),
('album1', 11),
('album1', 12),
('album1', 13),
('album1', 14);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `login` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `password`, `email`, `admin`) VALUES
('Martin', 'c129b324aee662b04eccf68babba85851346dff9', 'martin@polytechnique.edu', 0),
('raison', 'c129b324aee662b04eccf68babba85851346dff9', 'louisraison1@gmail.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`titre`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`cle`),
  ADD KEY `album` (`titre_album`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `album` FOREIGN KEY (`titre_album`) REFERENCES `albums` (`titre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
