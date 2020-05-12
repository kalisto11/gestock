-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 12 mai 2020 à 01:32
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
(15, 'Ordinateur', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_entree`
--

INSERT INTO `bon_entree` (`id`, `reference`, `date`, `fournisseur`) VALUES
(17, 2, '2020-05-04', 4),
(18, 90, '2020-05-04', 9),
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
(31, 23, '2020-05-07', 9),
(32, 43, '2020-05-08', 4),
(33, 22, '2020-05-08', 4),
(35, 22, '2020-05-08', 4),
(36, 22, '2020-05-08', 4),
(38, 22, '2020-05-08', 4),
(39, 333, '2020-05-08', 8),
(41, 90, '2020-05-08', 7),
(42, 5, '2020-05-08', 8),
(43, 5, '2020-05-08', 9),
(44, 54, '2020-05-08', 4),
(45, 45, '2020-05-09', 4),
(46, 3, '2020-05-09', 4),
(47, 67, '2020-05-09', 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_sortie`
--

INSERT INTO `bon_sortie` (`id`, `reference`, `date`, `beneficiaire`) VALUES
(27, '6', '2020-04-28', 7),
(33, '34', '2020-05-03', 7),
(34, '87', '2020-05-04', 1),
(35, '67', '2020-05-04', 6),
(36, '32', '2020-05-07', 5),
(37, '333', '2020-05-08', 1),
(38, '333', '2020-05-08', 1),
(39, '333', '2020-05-08', 1),
(40, '333', '2020-05-08', 1),
(41, '34', '2020-05-08', 8),
(42, '21', '2020-05-08', 9),
(43, '23', '2020-05-10', 3);

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
(23, 11, 2, 4000, 8000),
(23, 10, 5, 4000, 20000),
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
(23, 6, 2, 4000, 8000),
(20, 12, 2, 1000, 4000),
(31, 14, 2, 2000, 100000),
(31, 13, 5, 2000, 10000),
(31, 4, 2, 2000, 4000),
(31, 11, 1, 0, 0),
(22, 12, 10, 3000, 30000),
(18, 15, 2, 200000, 400000),
(32, 3, 20, 3000, 60000),
(33, 11, 2, 20000, 40000),
(45, 1, 0, 0, 40000),
(35, 11, 2, 20000, 40000),
(36, 13, 2, 3000, 6000),
(36, 10, 2, 3000, 10000),
(38, 11, 2, 20000, 40000),
(39, 7, 2, 250000, 500000),
(39, 5, 1, 30000, 30000),
(39, 11, 2, 25000, 50000),
(23, 14, 1, 50000, 50000),
(41, 5, 2, 25000, 50000),
(41, 13, 2, 3000, 6000),
(36, 11, 2, 20000, 40000),
(42, 13, 2, 2000, 4000),
(42, 9, 10, 1000, 10000),
(43, 15, 4, 200000, 800000),
(44, 11, 1, 30000, 30000),
(44, 9, 2, 5000, 2000),
(44, 10, 5, 5000, 25000),
(44, 13, 2, 5000, 10000),
(39, 14, 1, 50000, 50000),
(39, 4, 2, 80000, 160000),
(39, 3, 5, 3000, 15000),
(39, 12, 10, 3000, 30000),
(39, 13, 5, 3000, 15000),
(39, 10, 10, 3000, 30000),
(39, 9, 5, 800, 4000),
(45, 2, 0, 2, 40000),
(45, 3, 0, 0, 40000),
(45, 4, 0, 0, 40000),
(45, 5, 5, 0, 40000),
(45, 6, 0, 0, 40000),
(45, 7, 0, 0, 40000),
(45, 8, 0, 0, 40000),
(45, 9, 0, 0, 40000),
(45, 10, 0, 0, 40000),
(46, 9, 2, 0, 0),
(47, 4, 2, 80000, 160000),
(47, 10, 5, 5000, 25000),
(42, 8, 10, 2000, 20000);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`) VALUES
(4, 'BAOBAB HIGH TECH'),
(5, 'OUMOU INFORMATIQUE'),
(6, 'SSB'),
(7, 'KAFFRINE INFORMATIQUE'),
(8, 'MICROSOFT'),
(12, 'ADIE'),
(10, 'DAGE/MEN'),
(11, 'CONTECH');

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
(2, 'DAOUDA', 'KONTE'),
(3, 'SALIMATA WADE', 'GUEYE'),
(5, 'KHADIM', 'DIAW'),
(6, 'ABDOULAYE', 'NDIAYE'),
(7, 'IBRAHIMA', 'LOUM'),
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
(3, 3),
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
(42, 7, 1, 300000, 300000),
(41, 8, 10, 5000, 50000),
(40, 11, 1, 30000, 30000),
(40, 15, 1, 200000, 200000),
(35, 15, 2, 0, 0),
(34, 4, 8, 0, 0),
(33, 9, 2, 1000, 2000),
(39, 11, 1, 30000, 30000),
(33, 10, 2, 0, 0),
(27, 11, 1, 25000, 25000),
(27, 9, 4, 800, 3200),
(27, 3, 5, 35000, 15000),
(27, 5, 2, 35000, 70000),
(27, 6, 3, 200, 600),
(39, 15, 2, 200000, 400000),
(38, 15, 1, 200000, 200000),
(38, 11, 1, 30000, 30000),
(37, 11, 1, 30000, 30000),
(37, 15, 1, 200000, 200000),
(36, 8, 10, 1000, 10000),
(36, 3, 10, 3000, 30000),
(40, 4, 1, 30000, 80000),
(35, 7, 1, 250000, 250000),
(35, 13, 2, 3000, 6000),
(35, 3, 8, 3000, 24000),
(35, 9, -4, 1000, -4000),
(37, 10, 1, 0, 0),
(43, 15, 2, 100000, 200000),
(43, 13, 4, 1000, 4000),
(39, 10, 10, 5000, 50000),
(39, 12, 10, 3000, 30000),
(39, 13, 5, 2500, 12500),
(39, 16, 1, 25000, 25000);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomComplet` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pasword` varchar(255) NOT NULL,
  `niveau` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nomComplet`, `username`, `pasword`, `niveau`) VALUES
(1, 'Daouda KONTE', 'd.konte', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2),
(3, 'Khadim DIAW', 'k.diaw', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 1),
(5, 'Admin Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 3),
(6, 'gestionnaire', 'gestionnaire', '893cf2f5edbc8c751c5f84db8d169a7b0db0348c', 2),
(7, 'superviseur', 'superviseur', 'b3c18d792895e372754eac18de688774762d033d', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
