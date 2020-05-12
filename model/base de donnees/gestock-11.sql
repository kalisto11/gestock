-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 12 mai 2020 à 16:21
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `groupe`) VALUES
(3, 'Papier', '2'),
(4, 'Imprimante', '1'),
(5, 'Fauteuil', '1'),
(6, 'Scanner', '2'),
(7, 'Photocopie', '2'),
(8, 'Stylo Ã  bille', '2'),
(9, 'Blocnotes', '2'),
(10, 'ClÃ© usb', '2'),
(11, 'Disque dur externe', '2'),
(12, 'Souris', '2'),
(13, 'Clavier', '2'),
(15, 'Ordinateur', '2'),
(17, 'Cahier de 196p', '2'),
(18, 'Ardoise d\'Ã©colier', '2'),
(19, 'Crayon noir', '2'),
(20, 'Paquet crayons de couleur moyen', '2'),
(21, 'Kit gÃ©omÃ©trique gm', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_entree`
--

INSERT INTO `bon_entree` (`id`, `reference`, `numero_facture`, `date_facture`, `date`, `fournisseur_id`, `fournisseur_nom`, `modificateur_id`, `modificateur_nom`, `date_modification`) VALUES
(1, '23', NULL, NULL, '2020-05-12', 7, 'KAFFRINE INFORMATIQUE', 5, 'Admin Admin', '2020-05-12'),
(2, '23', NULL, NULL, '2020-05-12', 7, 'KAFFRINE INFORMATIQUE', 5, 'Admin Admin', '2020-05-12'),
(3, '34', 'ff', '2020-03-02', '2020-05-12', 6, 'SSB', 6, 'gestionnaire', '2020-05-12'),
(4, '6', NULL, NULL, '2020-05-12', 13, 'GIE FIDELE', 6, 'gestionnaire', '2020-05-12'),
(5, '445', '4556', '2020-05-05', '2020-05-12', 13, 'GIE FIDELE', 6, 'gestionnaire', '2020-05-12');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_sortie`
--

INSERT INTO `bon_sortie` (`id`, `reference`, `date`, `beneficiaire_id`, `beneficiaire_nom`, `modificateur_id`, `modificateur_nom`, `date_modification`) VALUES
(1, '23', '2020-05-05', 2, 'DAOUDA KONTE', 6, 'gestionnaire', '2020-05-12'),
(2, '23', '2020-05-12', 9, 'AMADOU WOURY DIALLO', 5, 'Admin Admin', '2020-05-12'),
(3, '25', '2020-05-12', 3, 'SALIMATA WADE GUEYE', 5, 'Admin Admin', '2020-05-12');

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
(3, 13, 'Clavier', 3, 2000),
(4, 17, 'Cahier de 196p', 7200, 360),
(18, 9, '', 21, 23),
(17, 11, '', 2, 0),
(23, 11, '', 2, 4000),
(23, 10, '', 5, 4000),
(21, 9, '', 3, 789),
(22, 10, '', 4, 5000),
(21, 12, '', 23, 34),
(20, 9, '', 10, 1000),
(20, 4, '', 2, 50000),
(26, 12, '', 40, 90),
(25, 9, '', 20, 1000),
(27, 12, '', 40, 90),
(28, 12, '', 40, 90),
(29, 5, '', 2, 25000),
(29, 12, '', 100, 10),
(29, 9, '', 100, 200000),
(29, 7, '', 2, 200000),
(29, 10, '', 10, 200000),
(30, 6, '', 2, 50000),
(30, 10, '', 10, 5000),
(25, 12, '', 10, 2000),
(23, 6, '', 2, 4000),
(20, 12, '', 2, 1000),
(31, 14, '', 2, 2000),
(31, 13, '', 5, 2000),
(31, 4, '', 2, 2000),
(31, 11, '', 1, 0),
(22, 12, '', 10, 3000),
(18, 15, '', 2, 200000),
(32, 3, '', 20, 3000),
(33, 11, '', 2, 20000),
(3, 10, 'ClÃ© usb', 2, 2997),
(35, 11, '', 2, 20000),
(36, 13, '', 2, 3000),
(36, 10, '', 2, 3000),
(38, 11, '', 2, 20000),
(39, 7, '', 2, 250000),
(39, 5, '', 1, 30000),
(39, 11, '', 2, 25000),
(23, 14, '', 1, 50000),
(41, 5, '', 2, 25000),
(41, 13, '', 2, 3000),
(36, 11, '', 2, 20000),
(42, 13, '', 2, 2000),
(42, 9, '', 10, 1000),
(44, 11, '', 1, 30000),
(44, 9, '', 2, 5000),
(44, 10, '', 5, 5000),
(44, 13, '', 2, 5000),
(39, 14, '', 1, 50000),
(39, 4, '', 2, 80000),
(39, 3, '', 5, 3000),
(39, 12, '', 10, 3000),
(39, 13, '', 5, 3000),
(39, 10, '', 10, 3000),
(39, 9, '', 5, 800),
(2, 13, 'Clavier', 2, 2),
(1, 13, 'Clavier', 2, 2),
(45, 5, 'Fauteuil', 5, 0),
(46, 9, 'Blocnotes', 2, 0),
(42, 8, '', 10, 2000),
(47, 4, 'Imprimante', 2, 80000),
(47, 10, 'ClÃ© usb', 5, 5000),
(48, 12, 'Souris', 3, 2000),
(4, 18, 'Ardoise d\'Ã©colier', 900, 169),
(4, 8, 'Stylo Ã  bille', 5400, 85),
(4, 19, 'Crayon noir', 1800, 42),
(4, 20, 'Paquet crayons de couleur moyen', 900, 322),
(4, 21, 'Kit gÃ©omÃ©trique gm', 900, 1525),
(5, 4, 'Imprimante', 2, 80000);

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
(4, 'BAOBAB HIGH TECH'),
(5, 'OUMOU INFORMATIQUE'),
(6, 'SSB'),
(7, 'KAFFRINE INFORMATIQUE'),
(8, 'MICROSOFT'),
(12, 'ADIE'),
(10, 'DAGE/MEN'),
(11, 'CONTECH'),
(13, 'GIE FIDELE');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `prenom`, `nom`) VALUES
(2, 'DAOUDA', 'KONTE'),
(3, 'SALIMATA WADE', 'GUEYE'),
(6, 'ABDOULAYE', 'NDIAYE'),
(7, 'IBRAHIMA', 'LOUM'),
(9, 'AMADOU WOURY', 'DIALLO'),
(10, 'AWA', 'SENE');

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
(6, 6),
(7, 15),
(7, 1),
(3, 3),
(9, 5),
(2, 12),
(2, 8),
(2, 13),
(10, 7);

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
  `nom_article` varchar(255) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sortie_article`
--

INSERT INTO `sortie_article` (`id_bon_sortie`, `id_article`, `nom_article`, `quantite`, `prix`) VALUES
(42, 7, '', 1, 300000),
(40, 11, '', 1, 30000),
(40, 15, '', 1, 200000),
(35, 15, '', 2, 0),
(34, 4, '1', 400000, 400000),
(33, 9, '', 2, 1000),
(39, 11, '', 1, 30000),
(33, 10, '', 2, 0),
(27, 11, '', 1, 25000),
(27, 9, '', 4, 800),
(27, 3, '', 5, 35000),
(27, 5, '', 2, 35000),
(27, 6, '', 3, 200),
(39, 15, '', 2, 200000),
(38, 15, 'Ordinateur', 1, 200000),
(37, 15, 'Ordinateur', 1, 200000),
(36, 8, '', 10, 1000),
(36, 3, '', 10, 3000),
(40, 4, '', 1, 30000),
(35, 7, '', 1, 250000),
(35, 13, '', 2, 3000),
(35, 3, '', 8, 3000),
(35, 9, '', -4, 1000),
(37, 10, 'ClÃ© usb', 1, 5000),
(43, 15, '2', 300, 600),
(43, 13, '10', 4000, 40000),
(39, 10, '', 10, 5000),
(39, 12, '', 10, 3000),
(39, 13, '', 5, 2500),
(39, 16, '', 1, 25000),
(41, 8, '500', 2, 0),
(41, 12, '3000', 0, 0),
(37, 11, 'Disque dur externe', 1, 30000),
(47, 9, 'Blocnotes', 12, 1000),
(47, 12, 'Souris', 2, 3000),
(38, 11, 'Disque dur externe', 1, 30000),
(2, 15, 'Ordinateur', 1, 200),
(1, 12, 'Souris', 2, 3000),
(3, 9, 'Blocnotes', 2, 2000),
(3, 13, 'Clavier', 1, 3000),
(1, 13, 'Clavier', 1, 3000);

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
