-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  lun. 27 avr. 2020 à 19:29
-- Version du serveur :  8.0.18
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
-- Base de données :  `oc_gbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurs`
--

DROP TABLE IF EXISTS `acteurs`;
CREATE TABLE IF NOT EXISTS `acteurs` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_acteur` varchar(255) NOT NULL,
  `image_acteur` varchar(255) NOT NULL,
  `text_acteur` text NOT NULL,
  `like_acteur` int(11) NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acteurs`
--

INSERT INTO `acteurs` (`id_acteur`, `nom_acteur`, `image_acteur`, `text_acteur`, `like_acteur`) VALUES
(1, 'Protectpeople', 'img/protectpeople.png', 'Protectpeople finance la solidarité nationale.</br>\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.</br>\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProtectpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.</br>\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.</br>\r\nNotre mission est double :</br>\r\n - sociale : nous garantissons la fiabilité des données sociales ;</br>\r\n - économique : nous apportons une contribution aux activités économiques.</br>\r\n', 0),
(2, 'Formation & Co', 'img/formation_co.png', 'Formation&co est une association française présente sur tout le territoire.</br>\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.</br>\r\nNotre proposition : </br>\r\n- un financement jusqu’à 30 000€ ;</br>\r\n- un suivi personnalisé et gratuit ;</br>\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.</br>\r\n</br>\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.</br>\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.</br>\r\n', 0),
(3, 'DSA France', 'img/Dsa_france.png', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.</br>\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.</br>\r\nNotre philosophie : s’adapter à chaque entreprise.</br>\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.</br>\r\n', 0),
(4, 'La CDE', 'img/CDE.png', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. </br>\r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.</br>\r\n', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acteur` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_acteur`, `username`, `commentaire`, `date_commentaire`) VALUES
(4, 1, 'ahah', 'ahah', '2020-04-23 17:34:14'),
(3, 1, 'huhu', 'huhu', '2020-04-23 15:57:32'),
(5, 2, 'a', 'salut les amis', '2020-04-27 18:04:20'),
(6, 4, 'antoineb', 'salut', '2020-04-27 20:07:29');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acteur_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `acteur_id`, `username`, `count`) VALUES
(9, 1, 'a', 0),
(15, 1, 'antoineb', 0),
(14, 4, 'a', 1),
(13, 3, 'a', 0),
(12, 2, 'a', 0),
(16, 4, 'antoineb', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reponse` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_user`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(21, 'huhu', 'huhu', 'huhu', '$2y$10$fgc/oMgmApGYXATx/HgiiOVFRA894.DVjOlscKZSwvOXbp.vVVg3e', 'huhu', '$2y$10$fSHaT.b1KJoZm5m2Cp1G.uq/e1aG41YOoygKvgEnAtSs3kwmDglya'),
(20, 'huhu', 'huhu', 'ahahah', '$2y$10$9zK3r/snceQXEobeHSM03eL1WSnLFutcYEpn2DQ6GM4dP8LaFXNSq', 'huhu', '$2y$10$Lk5olhcb9HhtzXA6j4zipObNZBUWodx.PxfndvsR3aoSpRdIeHbry'),
(22, 'antoine', 'becuwe', 'okokokok', '$2y$10$3s8wcA11zLQeZkiH11SnjOWmctHTBXQWku6LRuuw3sTXW1/lc3kOu', 'coucou', '$2y$10$RO1MJYyyJDUORT6zm65mVuHrhfc.i2xddw7LGnyishRio3I2h6cCe'),
(23, 'antoine', 'b', 'abecuwe', '$2y$10$IPK30BXP.1Fi2dT8/lisD.WwgFnGLWCQHNPAhMyoFUXxQfqRf4BqK', 'couvou?', '$2y$10$2ypZTcMybMGQcApv3OMe7uvZY1s6Em8LevWoU/ueC4kYLMNrUaiwe'),
(24, 'a', 'a', 'a', '$2y$10$YddbpMY/KH7wf6OO0qZf9eBbNOF17x3BKwsN/loyLeByBVERx/wBu', 'a', '$2y$10$JB5CnswZNZ2BrsE3hHwCyejkwcxk1I/CD1ARHgGyK8AWJl97U86SS'),
(25, 'antoine', 'becuwe', 'antoineb', '$2y$10$9gmuzFGzr.OWBKu8VdQAt.ozsNtB5vep6Of/DXGzlY6yNdRnBHefq', 'drinks', '$2y$10$.koZBBIGFt9aZlzy9cVeLuIKiw8Jg7iBCbO8iFkF8wMBqssnluDHO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
