-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 mai 2020 à 11:56
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnel_poste`
--

DROP TABLE IF EXISTS `personnel_poste`;
CREATE TABLE IF NOT EXISTS `personnel_poste` (
  `id_personnel` int(11) DEFAULT NULL,
  `id_poste` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dateTrans` date NOT NULL,
  `idArticle` int(11) NOT NULL,
  `idBon` int(255) NOT NULL,
  `numeroBon` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `typeTrans` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `username`, `pasword`, `niveau`, `changePassword`) VALUES
(1, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 3, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
