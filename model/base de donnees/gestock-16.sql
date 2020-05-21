-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 21 mai 2020 à 05:43
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
  `quantite` int(11) NOT NULL,
  `seuil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `groupe`, `quantite`, `seuil`) VALUES
(2, 'Ordinateur', '2', 17, 5),
(4, 'Imprimante', '2', 6, 2),
(5, 'Scanner', '2', 6, 1),
(6, 'Disque dur externe', '2', 0, 2),
(7, 'ClÃ© usb', '2', 4, 2),
(9, 'Cahier', '2', 200, 10);

-- --------------------------------------------------------

--
-- Structure de la table `bon_entree`
--

DROP TABLE IF EXISTS `bon_entree`;
CREATE TABLE IF NOT EXISTS `bon_entree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(11) DEFAULT NULL,
  `numero_facture` varchar(255) DEFAULT NULL,
  `date_facture` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fournisseur_id` int(45) DEFAULT NULL,
  `fournisseur_nom` varchar(255) NOT NULL,
  `modificateur_id` int(11) NOT NULL,
  `modificateur_nom` varchar(255) NOT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_entree`
--

INSERT INTO `bon_entree` (`id`, `reference`, `numero_facture`, `date_facture`, `date`, `fournisseur_id`, `fournisseur_nom`, `modificateur_id`, `modificateur_nom`, `date_modification`) VALUES
(1, '2', '3', '2020-05-04', '2020-05-18', 2, 'ADIE', 2, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-18'),
(2, '1', '5', '2020-05-05', '2020-05-18', 2, 'ADIE', 2, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-18'),
(3, '3', 'h24', '2020-05-04', '2020-05-20', 5, 'CONTECH', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-20'),
(4, '4', '549', '2020-05-01', '2020-05-20', 1, 'DAGE/MEN', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-20'),
(5, '5', '56', '2020-05-04', '2020-05-20', 8, 'GIE FIDELE', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-20'),
(6, '6', '43', '2020-05-06', '2020-05-21', 8, 'GIE FIDELE', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-21'),
(7, '9', '32', '2020-05-04', '2020-05-21', 7, 'SLIDE', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-21');

-- --------------------------------------------------------

--
-- Structure de la table `bon_sortie`
--

DROP TABLE IF EXISTS `bon_sortie`;
CREATE TABLE IF NOT EXISTS `bon_sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `beneficiaire_id` int(11) DEFAULT NULL,
  `beneficiaire_nom` varchar(255) NOT NULL,
  `modificateur_id` int(11) NOT NULL,
  `modificateur_nom` varchar(255) NOT NULL,
  `date_modification` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_sortie`
--

INSERT INTO `bon_sortie` (`id`, `reference`, `date`, `beneficiaire_id`, `beneficiaire_nom`, `modificateur_id`, `modificateur_nom`, `date_modification`) VALUES
(1, '1', '2020-05-19', 5, 'KHADIM DIAW', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-19'),
(2, '2', '2020-05-19', 1, 'AZIZ SECK', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-19'),
(3, '3', '2020-05-19', 3, 'SALIMATA WADE GUEYE', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-19'),
(4, '4', '2020-05-19', 4, 'DAOUDA KONTE', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-19'),
(5, '5', '2020-05-19', 2, 'AWA SENE', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-19'),
(6, '6', '2020-05-20', 11, 'SAMBA BAKHOUM', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-20'),
(9, '7', '2020-05-21', 12, 'YOUSSOU FOFANA', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-21'),
(10, '8', '2020-05-21', 12, 'YOUSSOU FOFANA', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-21'),
(11, '45', '2020-05-21', 6, 'SAMBA MBALLO', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-21'),
(12, '9', '2020-05-21', 5, 'KHADIM DIAW', 3, 'GESTIONNAIRE GESTIONNAIRE', '2020-05-21');

-- --------------------------------------------------------

--
-- Structure de la table `entree_article`
--

DROP TABLE IF EXISTS `entree_article`;
CREATE TABLE IF NOT EXISTS `entree_article` (
  `id_bon_entree` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `nom_article` varchar(255) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entree_article`
--

INSERT INTO `entree_article` (`id_bon_entree`, `id_article`, `nom_article`, `quantite`, `prix`) VALUES
(1, 2, 'Ordinateur', 2, 200000),
(2, 2, 'Ordinateur', 2, 2),
(3, 5, 'Scanner', 1, 50000),
(4, 4, 'Imprimante', 1, 80000),
(5, 7, 'ClÃ© usb', 4, 5000),
(6, 7, 'ClÃ© usb', 2, 5000),
(7, 2, 'Ordinateur', 2, 200000);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`) VALUES
(1, 'DAGE/MEN'),
(2, 'ADIE'),
(3, 'BAOBAB HIGH TECH'),
(4, 'OUMU INFORMATIQUE'),
(5, 'CONTECH'),
(6, 'SSB'),
(7, 'SLIDE'),
(8, 'GIE FIDELE'),
(9, 'BAYE INFORMATIQUE'),
(10, 'SOLUTIONS TECH'),
(12, 'KHADIM TECH'),
(13, 'KAF TECH');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `prenom`, `nom`) VALUES
(1, 'AZIZ', 'SECK'),
(2, 'AWA', 'SENE'),
(3, 'SALIMATA WADE', 'GUEYE'),
(4, 'DAOUDA', 'KONTE'),
(5, 'KHADIM', 'DIAW'),
(6, 'SAMBA', 'MBALLO'),
(7, 'AISSATOU', 'TOURE'),
(8, 'BIRAME', 'NDIAYE'),
(9, 'ABOUBAKRY SADIKH', 'NIANG'),
(10, 'IBRAHIMA', 'SARR'),
(11, 'SAMBA', 'BAKHOUM'),
(12, 'YOUSSOU', 'FOFANA'),
(13, 'NDOUMBÃ‰', 'THIOBANE'),
(14, 'AMADOU WOURY', 'DIALLO');

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
(1, 3),
(2, 4),
(3, 18),
(4, 1),
(5, 21),
(6, 2),
(7, 22),
(8, 7),
(9, 13),
(10, 12),
(11, 6),
(12, 8),
(13, 11),
(14, 9);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id`, `nom`) VALUES
(1, 'TICE'),
(2, 'BRH/A'),
(3, 'COMMUNICATION'),
(4, 'GENRE'),
(5, 'BEXCO'),
(6, 'IEMS'),
(7, 'COURRIER'),
(8, 'GESTION FINANCIERE'),
(9, 'GESTION MATERIELLE'),
(10, 'COFC'),
(11, 'SEPA'),
(12, 'SG'),
(13, 'IA'),
(14, 'BEMSG'),
(15, 'PLANIFICATION'),
(16, 'CTR'),
(17, 'MFPAA'),
(18, 'SPORT'),
(19, 'ALPHABETISATION'),
(20, 'CYCLE FONDAMENTAL'),
(21, 'STATISTIQUES'),
(22, 'BRH/C');

-- --------------------------------------------------------

--
-- Structure de la table `sortie_article`
--

DROP TABLE IF EXISTS `sortie_article`;
CREATE TABLE IF NOT EXISTS `sortie_article` (
  `id_bon_sortie` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `nom_article` varchar(255) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sortie_article`
--

INSERT INTO `sortie_article` (`id_bon_sortie`, `id_article`, `nom_article`, `quantite`, `prix`) VALUES
(1, 2, 'Ordinateur', 1, 1),
(2, 7, 'ClÃ© usb', 1, 1),
(3, 6, 'Disque dur externe', 1, 1),
(4, 2, 'Ordinateur', 1, 1),
(5, 4, 'Imprimante', 1, 1),
(6, 2, 'Ordinateur', 1, 200000),
(9, 6, 'Disque dur externe', 1, 25000),
(10, 6, 'Disque dur externe', 1, 25000),
(11, 7, 'ClÃ© usb', 2, 5000),
(12, 7, 'ClÃ© usb', 2, 5000);

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dateTrans` date NOT NULL,
  `idArticle` int(11) NOT NULL,
  `nomArticle` varchar(255) DEFAULT NULL,
  `idBon` int(255) NOT NULL,
  `numeroBon` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `typeTrans` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `dateTrans`, `idArticle`, `nomArticle`, `idBon`, `numeroBon`, `quantite`, `typeTrans`) VALUES
(1, '2020-05-18', 2, '', 2, 'GESTIONNAIRE GESTIONNAIRE', 14, 'crÃ©ation'),
(2, '2020-05-18', 3, '', 2, 'GESTIONNAIRE GESTIONNAIRE', 44, 'crÃ©ation'),
(3, '2020-05-18', 3, '', 2, 'GESTIONNAIRE GESTIONNAIRE', 6, 'modification'),
(4, '2020-05-18', 2, '', 1, '2', 2, 'entrÃ©e'),
(6, '2020-05-18', 2, '', 2, '1', 2, 'entrÃ©e'),
(7, '2020-05-19', 4, '', 3, 'GESTIONNAIRE GESTIONNAIRE', 6, 'crÃ©ation'),
(8, '2020-05-19', 5, '', 3, 'GESTIONNAIRE GESTIONNAIRE', 5, 'crÃ©ation'),
(9, '2020-05-19', 6, '', 3, 'GESTIONNAIRE GESTIONNAIRE', 6, 'crÃ©ation'),
(10, '2020-05-19', 7, '', 3, 'GESTIONNAIRE GESTIONNAIRE', 10, 'crÃ©ation'),
(11, '2020-05-19', 2, '', 1, '1', 1, 'sortie'),
(12, '2020-05-19', 7, '', 2, '2', 1, 'sortie'),
(30, '2020-05-19', 6, '', 3, '3', 1, 'sortie'),
(14, '2020-05-19', 2, '', 4, '4', 1, 'sortie'),
(26, '2020-05-19', 4, '', 5, '5', 1, 'sortie'),
(31, '2020-05-19', 7, '', 3, 'GESTIONNAIRE GESTIONNAIRE', -7, 'modification'),
(32, '2020-05-19', 6, '', 3, 'GESTIONNAIRE GESTIONNAIRE', -3, 'modification'),
(33, '2020-05-20', 2, '', 6, '4', 1, 'sortie'),
(34, '2020-05-20', 5, '', 3, '2', 1, 'entrÃ©e'),
(35, '2020-05-20', 4, '', 4, '4', 1, 'entrÃ©e'),
(36, '2020-05-20', 7, '', 5, '5', 4, 'entrÃ©e'),
(37, '2020-05-21', 7, '', 6, '6', 2, 'entrÃ©e'),
(38, '2020-05-21', 6, '', 9, '7', 1, 'sortie'),
(39, '2020-05-21', 6, '', 10, '8', 1, 'sortie'),
(40, '2020-05-21', 2, 'Ordinateur', 7, '9', 2, 'entrÃ©e'),
(41, '2020-05-21', 7, 'ClÃ© usb', 11, '45', 2, 'sortie'),
(42, '2020-05-21', 9, 'Cahier', 3, 'GESTIONNAIRE GESTIONNAIRE', 200, 'crÃ©ation'),
(43, '2020-05-21', 7, 'ClÃ© usb', 12, '9', 2, 'sortie');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pasword` varchar(255) NOT NULL,
  `niveau` int(255) NOT NULL,
  `changePassword` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `username`, `pasword`, `niveau`, `changePassword`) VALUES
(1, 'ADMIN', 'ADMIN', 'admin', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 3, 0),
(3, 'GESTIONNAIRE', 'GESTIONNAIRE', 'gestionnaire', '893cf2f5edbc8c751c5f84db8d169a7b0db0348c', 2, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
