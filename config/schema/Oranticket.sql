-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 08 Octobre 2015 à 07:34
-- Version du serveur :  5.6.25-0ubuntu0.15.04.1
-- Version de PHP :  5.6.4-4ubuntu6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `oranticket`
--

CREATE DATABASE IF NOT EXISTS `oranticket` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `oranticket`;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `last_ip` varchar(15) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `bio` text NOT NULL,
  `password_code` varchar(50) NOT NULL,
  `password_code_expire` datetime NOT NULL,
  `password_reset_count` mediumint(9) NOT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjects` varchar(155) NOT NULL,
  `content` text NOT NULL,
  `label` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('solved','not_solved') NOT NULL,
  `content` tinytext NOT NULL,
  `modified` datetime NOT NULL,
  `is_spam` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (ticket_id) REFERENCES tickets(id)
) ENGINE=InnoDB AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` text COLLATE utf8_general_ci NOT NULL,
  `message` text COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0;


-- --------------------------------------------------------

--
-- Structure de la table `tickets_tags`
--

CREATE TABLE IF NOT EXISTS `tickets_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (ticket_id) REFERENCES tickets(id),
  FOREIGN KEY (tag_id) REFERENCES tags(id)
) ENGINE=InnoDB AUTO_INCREMENT=0;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
