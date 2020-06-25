-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 25 juin 2020 à 16:57
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `codflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

DROP TABLE IF EXISTS `episode`;
CREATE TABLE IF NOT EXISTS `episode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `duration` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `media_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`id`, `genre_id`, `media_id`, `season`, `episode`, `title`, `status`, `duration`, `release_date`, `summary`, `media_url`) VALUES
(1, 4, 3, 1, 1, 'Noël mortel', 'sortie', 1420, '1989-12-17', 'Après avoir assisté au spectacle de Noël de Bart et Lisa à l\'école élémentaire de Springfield, Marge leur demande ce qu\'ils désirent recevoir comme cadeaux pour Noël : Bart demande un tatouage et Lisa demande un poney, mais Marge refuse de leur offrir ces cadeaux', 'https://www.youtube.com/embed/302zdsKnYQc'),
(2, 4, 3, 1, 2, 'Bart le génie', 'sortie', 1335, '1990-01-14', 'En jouant au Scrabble avec sa famille pour se préparer au test de QI qu\'il devra effectuer le lendemain, Bart, qui ne prend pas le jeu au sérieux, place toutes ses lettres au hasard, ce qui forme un mot inexistant causant la rage d\'Homer qui le poursuit dans la maison.', 'https://www.youtube.com/embed/WtC2e5qlIF4'),
(3, 4, 3, 2, 1, 'Aide-toi, le ciel t\'aidera', 'sortie', 1307, '1990-10-11', 'Une fois que Martin a fini son exposé, Mme Krapabelle demande à Bart de présenter le sien sur le livre L\'Île au trésor qu\'il est censé avoir lu. Bien évidemment, Bart ne l\'a jamais ouvert et tente d\'en faire une explication sans convaincre personne.', 'https://www.youtube.com/embed/mQbshj7ls5o'),
(4, 4, 3, 2, 2, 'Simpson et Delila', 'sortie', 1272, '1990-10-18', 'Pendant un programme télévisé, Homer voit une publicité qui vante les mérites de Dimoxinil, un produit miracle qui permet de faire pousser les cheveux. Il court voir un médecin afin qu\'il lui prescrive le traitement mais ce dernier coûte 1 000 $. En discutant avec Lenny et Carl, il apprend que son traitement peut être pris en charge par son assurance maladie. Il s\'empresse donc de retourner voir le médecin à la clinique du cheveu pour obtenir le produit miracle.', 'https://www.youtube.com/embed/LV-CzpastW0');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction'),
(4, 'Animation');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT 0 COMMENT 'in seconds',
  PRIMARY KEY (`id`),
  KEY `history_user_id_fk_media_id` (`user_id`),
  KEY `history_media_id_fk_media_id` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `user_id`, `media_id`, `start_date`, `finish_date`, `watch_duration`) VALUES
(42, 22, 1, '2020-06-25 00:00:00', NULL, 0),
(43, 22, 3, '2020-06-25 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`) VALUES
(1, 4, 'Les indestructibles', 'film', 'En brouillon', '2004-11-24', 'Bob Paar était jadis l\'un des plus grands super-héros de la planète. Tout le monde connaissait Mr. Indestructible, le héros qui, chaque jour, sauvait des centaines de vies et combattait le mal. Aujourd\'hui, Mr. Indestructible est un petit expert en assurances qui n\'affronte plus que l\'ennui et un tour de taille en constante augmentation.', 'https://www.youtube.com/embed/wZ8l1AavXWM'),
(2, 3, 'Star Wars : A New Hope', 'film', 'released', '1977-10-19', 'A young boy discover the way of the Force to destroy a great Evil', 'https://www.youtube.com/embed/1g3_CFmnU7k'),
(3, 4, 'Les Simpson', 'série', 'sortie', '1989-12-17', 'Les Simpson, famille américaine moyenne, vivent à Springfield. Homer, le père, a deux passions : regarder la télé et boire des bières. Mais son quotidien est rarement reposant, entre son fils Bart qui fait toutes les bêtises possibles, sa fille Lisa qui est une surdouée, ou encore sa femme Marge qui ne supporte pas de le voir se soûler à longueur de journée.', 'https://www.youtube.com/embed/JGfbB4UbHc');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(5, 'testcrypta@gmail.com', 'SHLXeEpVZGn1o'),
(6, 'lucas@gmail.com', 'SHi.3kP7UVSJs'),
(22, 'test1@gmail.com', 'SHOslIH7L7/PA');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
