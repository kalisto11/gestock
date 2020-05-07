-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 mai 2020 à 05:19
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
(26, 8, 5, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
