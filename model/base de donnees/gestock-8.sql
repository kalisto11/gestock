-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 mai 2020 à 13:54
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestock`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `groupe` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `groupe`) VALUES
(3, 'Papier', '2'),
(4, 'Imprimante', '1'),
(5, 'Fauteuil', '1'),
(6, 'Scanner', '2'),
(7, 'Photocopie', '2'),
(8, 'Stylo', '2'),
(9, 'Blocnotes', '2'),
(10, 'ClÃ© usb', '2'),
(11, 'Disque dur externe', '2'),
(12, 'Souris', '2'),
(13, 'Clavier', '2'),
(14, 'Armoire', '1'),
(15, 'Ordinateur', '2'),
(16, 'Souffleur', '2');

-- --------------------------------------------------------

--
-- Structure de la table `bon_entree`
--

DROP TABLE IF EXISTS `bon_entree`;
CREATE TABLE IF NOT EXISTS `bon_entree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fournisseur` int(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_entree`
--

INSERT INTO `bon_entree` (`id`, `reference`, `date`, `fournisseur`) VALUES
(17, 2, '2020-05-04', 4),
(18, 90, '2020-05-04', 5),
(20, 34, '2020-05-06', 6),
(21, 45, '2020-05-07', 4),
(22, 45, '2020-05-07', 4),
(23, 87, '2020-05-07', 6),
(25, 32, '2020-05-07', 4),
(26, 43, '2020-05-07', 7),
(27, 43, '2020-05-07', 7),
(28, 43, '2020-05-07', 7),
(29, 21, '2020-05-07', 7),
(30, 27, '2020-05-07', 4),
(31, 23, '2020-05-07', 9);

-- --------------------------------------------------------

--
-- Structure de la table `bon_sortie`
--

DROP TABLE IF EXISTS `bon_sortie`;
CREATE TABLE IF NOT EXISTS `bon_sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `beneficiaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_sortie`
--

INSERT INTO `bon_sortie` (`id`, `reference`, `date`, `beneficiaire`) VALUES
(26, '3', '2020-04-28', 2),
(27, '6', '2020-04-28', 7),
(33, '34', '2020-05-03', 7),
(34, '87', '2020-05-04', 1),
(35, '67', '2020-05-04', 6),
(36, '32', '2020-05-07', 5);

-- --------------------------------------------------------

--
-- Structure de la table `entree_article`
--

DROP TABLE IF EXISTS `entree_article`;
CREATE TABLE IF NOT EXISTS `entree_article` (
  `id_bon_entree` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entree_article`
--

INSERT INTO `entree_article` (`id_bon_entree`, `id_article`, `quantite`, `prix`, `total`) VALUES
(3, 1, 2, 0, 0),
(3, 4, 1, 0, 0),
(3, 7, 1, 0, 0),
(4, 2, 1, 0, 0),
(4, 1, 3, 0, 0),
(18, 9, 21, 23, 483),
(17, 11, 2, 0, 0),
(23, 11, 43, 87, 3741),
(23, 10, 32, 67, 2144),
(21, 9, 3, 789, 998),
(22, 10, 4, 5000, 20000),
(21, 12, 23, 34, 87),
(20, 9, 10, 1000, 10000),
(20, 4, 2, 50000, 100000),
(26, 12, 40, 90, 0),
(25, 9, 20, 1000, 20000),
(27, 12, 40, 90, 0),
(28, 12, 40, 90, 3600),
(29, 5, 2, 25000, 50000),
(29, 12, 100, 10, 1000),
(29, 9, 100, 200000, 2300),
(29, 7, 2, 200000, 400000),
(29, 10, 10, 200000, 2000000),
(30, 6, 2, 50000, 100000),
(30, 10, 10, 5000, 50000),
(25, 12, 10, 2000, 20000),
(23, 6, 2, 87, 30000),
(20, 12, 2, 1000, 4000),
(31, 14, 2, 2000, 100000),
(31, 13, 5, 2000, 10000),
(31, 4, 2, 2000, 4000),
(31, 11, 1, 0, 0),
(22, 12, 10, 3000, 30000),
(18, 15, 2, 200000, 400000);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`) VALUES
(4, 'BAOBAB HIGH TECH'),
(5, 'OUMOU INFORMATIQUE'),
(6, 'SSB'),
(7, 'KAFFRINE INFORMATIQUE'),
(8, 'MICROSOFT'),
(9, 'ADIE');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `prenom`, `nom`) VALUES
(1, 'AWA', 'SENE'),
(2, 'DAOUDA', 'KONTE'),
(3, 'SALIMATA WADE', 'GUEYE'),
(5, 'KHADIM', 'DIAW'),
(6, 'ABDOULAYE', 'NDIAYE'),
(7, 'IBRAHIMA', 'LOUM'),
(8, 'SAMBA', 'MBALLO'),
(9, 'AMADOU WOURY', 'DIALLO');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_poste`
--

DROP TABLE IF EXISTS `personnel_poste`;
CREATE TABLE IF NOT EXISTS `personnel_poste` (
  `id_personnel` int(11) DEFAULT NULL,
  `id_poste` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnel_poste`
--

INSERT INTO `personnel_poste` (`id_personnel`, `id_poste`) VALUES
(5, 7),
(6, 6),
(2, 12),
(2, 8),
(7, 15),
(7, 1),
(1, 9),
(1, 11),
(1, 4),
(8, 10),
(9, 5);

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

DROP TABLE IF EXISTS `poste`;
CREATE TABLE IF NOT EXISTS `poste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id`, `nom`) VALUES
(1, 'STATISTIQUES'),
(3, 'TICE'),
(4, 'ALPHABETISATION'),
(5, 'GESTION MATÃ‰RIÃˆLLE'),
(6, 'GESTION FINANCIÃˆRE'),
(7, 'COMMUNICATION'),
(8, 'GENRE'),
(9, 'BEXCO'),
(10, 'BRH'),
(11, 'COURRIER'),
(12, 'BEMSG'),
(13, 'SG'),
(14, 'IA'),
(15, 'PLANIFICATION');

-- --------------------------------------------------------

--
-- Structure de la table `sortie_article`
--

DROP TABLE IF EXISTS `sortie_article`;
CREATE TABLE IF NOT EXISTS `sortie_article` (
  `id_bon_sortie` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sortie_article`
--

INSERT INTO `sortie_article` (`id_bon_sortie`, `id_article`, `quantite`, `prix`, `total`) VALUES
(26, 12, 1, 0, 0),
(26, 5, 1, 0, 0),
(26, 7, 1, 0, 0),
(26, 6, 1, 0, 0),
(35, 3, 8, 0, 0),
(34, 4, 8, 0, 0),
(33, 10, 2, 0, 0),
(26, 1, 3, 0, 0),
(33, 7, 1, 0, 0),
(27, 11, 1, 25000, 25000),
(27, 9, 4, 800, 3200),
(27, 3, 5, 35000, 15000),
(27, 5, 2, 35000, 70000),
(27, 6, 3, 200, 600),
(26, 6, 3, 0, 0),
(26, 11, 1, 0, 0),
(26, 10, 2, 0, 0),
(26, 9, 2, 0, 0),
(26, 8, 5, 0, 0),
(36, 3, 10, 30000, 300000),
(36, 8, 10, 5000, 50000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
