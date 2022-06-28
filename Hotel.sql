-- Adminer 4.8.1 MySQL 8.0.29-0ubuntu0.20.04.3 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;



DROP TABLE IF EXISTS `addons`;
CREATE TABLE `addons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_addon` varchar(50) NOT NULL,
  `description_addon` text NOT NULL,
  `prix_addon` int NOT NULL,
  `image_addon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `addons` (`id`, `nom_addon`, `description_addon`, `prix_addon`, `image_addon`) VALUES
(1,	'test',	'aztatattazt',	2000,	'addons1.jpg'),
(2,	'test2',	'arazratatz',	2000,	'image1.jpg');

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `mdp` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `mdp`) VALUES
(2,	'admin',	'admin',	'admin@admin.admin',	'$2y$10$9dYoIeJpHbK.S6BFrdekPuNyVI20DrII1.n/LtEpZi3c0sMbMhEy.');

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(50) NOT NULL,
  `nb_personnes` int NOT NULL,
  `description` text NOT NULL,
  `prix` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `type` (`id`, `nom_type`, `nb_personnes`, `description`, `prix`) VALUES
(1,	'Suite',	4,	'ttazaztaztata',	8000),
(2,	'Grande chambre',	4,	'',	6500),
(3,	'Chambre simple',	1,	'',	2500),
(4,	'Chambre double',	2,	'',	4500),
(5,	'Grande suite',	5,	'',	12000);

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE `chambre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `chambre` (`id`, `type_id`) VALUES
(87,	1),
(90,	1),
(86,	2),
(91,	2),
(89,	3),
(88,	4),
(92,	5);

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `date_naiss` datetime DEFAULT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `tel` int DEFAULT NULL,
  `adresse` varchar(256) DEFAULT NULL,
  `mdp` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `date_naiss`, `sexe`, `tel`, `adresse`, `mdp`) VALUES
(4,	'aziz',	'bourmel',	'azizbourmel01@gmail.com',	'2001-04-13 00:00:00',	'femme',	611121314,	'ait argane,ouadhia',	'$2y$10$kFEO2nOOsJBKt2/pDGP47O5BrNhfiI5lUHOwFnqpPPIBprD7ohme6'),
(5,	'Djebbari',	'Mohamed-ouali',	'dmdouali1@gmail.com',	'2001-07-11 00:00:00',	'homme',	652134512,	'Mechtras,Boghni',	'$2y$10$WOmh4D8raPkufyCCOmnCEOnzKuBSL8fO9NGCEaYxqKpSBLWe6vX0K');

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_type` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `image` (`id`, `name`, `id_type`) VALUES
(26,	'image1.jpg',	1),
(27,	'image2.jpg',	2),
(28,	'image3.jpg',	3),
(29,	'image5.jpg',	4),
(30,	'image6.jpg',	5),
(31,	'image2.jpg',	1),
(32,	'image6.jpg',	1),
(33,	'image5.jpg',	1);

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_chambre` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `date_depart` date DEFAULT NULL,
  `prix` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_chambre` (`id_chambre`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_chambre`) REFERENCES `chambre` (`id`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservation` (`id`, `id_chambre`, `id_client`, `date_arrivee`, `date_depart`, `prix`) VALUES
(3,	90,	4,	'2022-05-20',	'2022-05-24',	NULL),
(4,	86,	4,	'2022-05-21',	'2022-05-24',	NULL),
(5,	89,	4,	'2022-05-22',	'2022-05-24',	NULL),
(6,	88,	4,	'2022-05-22',	'2022-05-23',	NULL),
(7,	87,	4,	'2022-05-26',	'2022-05-27',	NULL),
(8,	90,	4,	'2022-05-26',	'2022-05-27',	NULL),
(9,	86,	4,	'2022-05-26',	'2022-05-27',	NULL),
(10,	87,	4,	'2022-05-28',	'2022-05-30',	NULL),
(11,	87,	4,	'2022-06-01',	'2022-06-02',	NULL),
(12,	87,	4,	'2022-05-28',	'2022-05-29',	NULL),
(13,	87,	4,	'2022-05-28',	'2022-05-29',	NULL),
(14,	87,	4,	'2022-05-28',	'2022-05-29',	NULL),
(15,	87,	4,	'2022-05-30',	'2022-05-31',	NULL),
(16,	86,	4,	'2022-06-01',	'2022-06-02',	NULL),
(17,	86,	4,	'2022-06-01',	'2022-06-02',	NULL),
(18,	91,	4,	'2022-06-01',	'2022-06-02',	NULL),
(19,	87,	4,	'2022-06-05',	'2022-06-07',	18000);



DROP TABLE IF EXISTS `addon_reservation`;
CREATE TABLE `addon_reservation` (
  `id_addon` int NOT NULL,
  `id_reservation` int NOT NULL,
  KEY `id_addon` (`id_addon`),
  KEY `id_reservation` (`id_reservation`),
  CONSTRAINT `addon_reservation_ibfk_1` FOREIGN KEY (`id_addon`) REFERENCES `addons` (`id`),
  CONSTRAINT `addon_reservation_ibfk_2` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `addon_reservation` (`id_addon`, `id_reservation`) VALUES
(2,	10),
(2,	14),
(2,	15),
(2,	19);

-- 2022-06-21 11:59:30
