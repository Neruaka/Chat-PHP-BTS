-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 mai 2024 à 19:57
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chat2`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idm` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `message` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `destinataire` varchar(100) NOT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idm`, `pseudo`, `message`, `date`, `destinataire`) VALUES
(1, 'Prof', 'Attention dst la prochaine fois', '2022-12-13 16:18:45', ''),
(2, 'eleve', 'Non svp on a deja beaucoup de dst', '2022-12-15 16:20:05', ''),
(3, 'Directrice', 'Ne discutez pas, dts!!!', '2022-12-20 16:31:47', ''),
(4, 'Fred', 'Super fonctionnel', '2022-12-14 16:43:43', ''),
(5, 'Test', 'Test', '2022-12-14 16:44:39', ''),
(6, 'Paul', 'Hello', '2022-12-14 16:44:50', ''),
(17, 'prof', 'coucou', '2022-12-22 09:11:22', ''),
(18, 'eleve', 'sadfas', '2024-05-27 21:22:39', 'tous'),
(19, 'eleve', 'sadfas', '2024-05-27 21:24:25', 'tous'),
(20, 'Guez', 'salut les eleves', '2024-05-27 21:25:13', 'tous'),
(21, 'Guez', 'salut les eleves', '2024-05-27 21:29:26', 'tous'),
(22, 'Guez', 'salut les eleves', '2024-05-27 21:29:27', 'tous'),
(23, 'Guez', 'salut les eleves', '2024-05-27 21:29:28', 'tous'),
(24, 'Guez', 'salut les eleves', '2024-05-27 21:29:51', 'tous'),
(25, 'Guez', 'salut les eleves', '2024-05-27 21:29:51', 'tous'),
(26, 'eleve', 'Hello monsieur le professeur ', '2024-05-27 21:30:26', 'tous'),
(27, 'eleve', 'Hello monsieur le professeur ', '2024-05-27 21:30:28', 'tous'),
(28, 'eleve', 'Hello monsieur le professeur ', '2024-05-27 21:31:09', 'tous');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idu` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `niveau` int NOT NULL,
  PRIMARY KEY (`idu`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `prenom`, `mail`, `mdp`, `niveau`) VALUES
(1, 'Guez', 'Fred', 'fredguez@gmail.com', 'fred', 2),
(2, 'eleve', 'eleve', 'eleve', 'eleve', 1),
(3, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$8AkoF7DiozbuR56o6uphNePjUoTOVYm0Xko0yHyxL7TCer2pn0MHy', 1),
(4, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$T6XrMqRsI86D4bfHm4QIJefxMEDxMTe3eOWM6ynhuxNkjn4tEfxqK', 1),
(5, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$Pc1h5gH9GJgNkJjaPfuFLeRkORXKyHP05cppbNLHG2rgtpjo4ijRi', 1),
(6, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$n4eph//6FkIkqb7aVO7u0O1LGBNuxe.wn1l5qmHl83mccUYr1fds.', 1),
(7, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$ojEW1OoWB25Cmb17eh6ha.DLtAum..UQ/ubLhPs99wYnH2p7wvA3u', 1),
(8, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$5AdBkU4r6oz8VWZVG95JwepwHYly.PBOzDfoUbFa/uzYd6CBMZRG2', 1),
(9, 'Theo ', 'Babac', 'theo.babac@babac', '$2y$10$SpMZzfiwBtUtD4/YEvpXQ.RKsA9guf1vFUB2kl.l1OWBkI7B2J/zK', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
