-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 mai 2020 à 16:46
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

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
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dateTrans` date NOT NULL,
  `idArticle` int(11) NOT NULL,
  `idBon` int(255) NOT NULL,
  `numeroBon` int(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `typeTrans` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `dateTrans`, `idArticle`, `idBon`, `numeroBon`, `quantite`, `typeTrans`) VALUES
(28, '2020-05-15', 26, 10, 2, 3, 'sortie'),
(27, '2020-05-15', 25, 15, 1, 3, 'entree'),
(26, '2020-05-15', 24, 15, 1, 2, 'entree'),
(25, '2020-05-15', 23, 15, 1, 10, 'entree'),
(29, '2020-05-15', 10, 9, 25, 10, 'entree'),
(30, '2020-05-15', 15, 9, 25, 5, 'entree'),
(31, '2020-05-15', 11, 9, 25, 2, 'entree'),
(32, '2020-05-15', 7, 9, 25, 1, 'entree'),
(33, '2020-05-15', 6, 9, 25, 1, 'entree'),
(34, '2020-05-15', 12, 9, 25, 5, 'entree'),
(35, '2020-05-15', 4, 9, 25, 1, 'entree');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
