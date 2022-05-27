-- Adminer 4.8.1 MySQL 8.0.28-0ubuntu0.20.04.3 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `mdp` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `mdp`) VALUES
(2,	'admin',	'admin',	'admin@admin.admin',	'$2y$10$9dYoIeJpHbK.S6BFrdekPuNyVI20DrII1.n/LtEpZi3c0sMbMhEy.');

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE `chambre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `description` text,
  `prix` int DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `images` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `chambre` (`id`, `nom`, `description`, `prix`, `type`, `images`) VALUES
(22,	'chambre 1',	'une chambre grande et spacieuse avec une belle vue sur la plage,équipé de toutes les options possible',	10000,	'double',	'photo4.jpg'),
(23,	'chambre 2',	'une chambre grande et spacieuse avec une belle vue sur la plage,équipé de toutes les options possible,idéale pour passer les vacances dans grand luxe',	15000,	'grande suite',	'photo3.jpg'),
(24,	'chambre 3 ',	'une chambre grande et spacieuse avec une belle vue sur la plage,équipé de toutes les options possible,idéale pour passer les vacances dans grand luxe',	13500,	'duplex',	'photo2.jpg'),
(25,	'chambre 4',	'petite chambre idéale pour un passage seul et sans compagnie on plonge dans notre solitude attention les moustiques',	6000,	'petite chambre',	'photo1.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `date_naiss`, `sexe`, `tel`, `adresse`, `mdp`) VALUES
(4,	'aziz',	'bourmel',	'azizbourmel01@gmail.com',	'2001-04-13 00:00:00',	'femme',	611121314,	'ait argane,ouadhia',	'$2y$10$kFEO2nOOsJBKt2/pDGP47O5BrNhfiI5lUHOwFnqpPPIBprD7ohme6');

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id_chambre` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `date_depart` date DEFAULT NULL,
  `type_paiement` varchar(30) DEFAULT NULL,
  KEY `id_chambre` (`id_chambre`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_chambre`) REFERENCES `chambre` (`id`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `reservation` (`id_chambre`, `id_client`, `date_arrivee`, `date_depart`, `type_paiement`) VALUES
(22,	4,	'2022-04-01',	'2022-04-03',	'sur place');

-- 2022-03-26 22:42:20
