-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 28 mai 2023 à 16:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `velolib`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `IDABONNEMENT` varchar(8) NOT NULL,
  `IDTYPEABONNEMENT` varchar(8) NOT NULL,
  `IDUTILISATEUR` varchar(8) NOT NULL,
  `DATEDEBUTABONNEMENT` date DEFAULT NULL,
  `MONTANTCAUTIONNEMENT` int DEFAULT NULL,
  PRIMARY KEY (`IDABONNEMENT`),
  KEY `FK_ACHETER` (`IDUTILISATEUR`),
  KEY `FK_ASSOCIER` (`IDTYPEABONNEMENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`IDABONNEMENT`, `IDTYPEABONNEMENT`, `IDUTILISATEUR`, `DATEDEBUTABONNEMENT`, `MONTANTCAUTIONNEMENT`) VALUES
('A1', 'TA1', 'U1', '2022-05-22', 150),
('A2', 'TA2', 'U1', '2022-05-28', 150),
('A3', 'TA1', 'U2', '2022-05-22', 150),
('A4', 'TA1', 'U2', '2022-05-28', 150),
('A5', 'TA1', 'U2', '2022-05-24', 150),
('A6', 'TA3', 'U2', '2022-06-10', 150),
('A7', 'TA1', 'U3', '2022-06-10', 150),
('A8', 'TA1', 'U3', '2022-06-18', 150),
('A9', 'TA2', 'U4', '2022-05-22', 150),
('A10', 'TA1', 'U5', '2022-05-22', 150),
('A11', 'TA1', 'U4', '2022-05-22', 150),
('A12', 'TA1', 'U4', '2022-06-10', 150),
('A13', 'TA1', 'U4', '2022-06-18', 150),
('A14', 'TA1', 'U4', '2022-06-28', 150),
('A15', 'TA2', 'U4', '2022-06-08', 150),
('A16', 'TA2', 'U5', '2022-06-08', 150),
('A17', 'TA1', 'U6', '2022-06-08', 150);

-- --------------------------------------------------------

--
-- Structure de la table `borne`
--

DROP TABLE IF EXISTS `borne`;
CREATE TABLE IF NOT EXISTS `borne` (
  `IDBORNE` varchar(20) NOT NULL,
  `IDSTATION` varchar(8) NOT NULL,
  `DATEAJOUTBORNE` date DEFAULT NULL,
  PRIMARY KEY (`IDBORNE`),
  KEY `FK_APPARTENIR` (`IDSTATION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `borne`
--

INSERT INTO `borne` (`IDBORNE`, `IDSTATION`, `DATEAJOUTBORNE`) VALUES
('B49', 'S4', '2022-05-02'),
('B48', 'S4', '2022-05-02'),
('B47', 'S4', '2022-05-02'),
('B46', 'S4', '2022-05-02'),
('B45', 'S4', '2001-05-02'),
('B44', 'S4', '2001-05-02'),
('B43', 'S4', '2022-05-02'),
('B42', 'S4', '2022-05-02'),
('B41', 'S4', '2022-05-02'),
('B39', 'S3', '2022-05-02'),
('B38', 'S3', '2022-05-02'),
('B37', 'S3', '2022-05-02'),
('B36', 'S3', '2001-05-02'),
('B35', 'S3', '2001-05-02'),
('B34', 'S3', '2022-05-02'),
('B33', 'S3', '2022-05-02'),
('B32', 'S3', '2022-05-02'),
('B31', 'S3', '2022-05-02'),
('B29', 'S2', '2022-05-02'),
('B27', 'S2', '2022-05-02'),
('B26', 'S2', '2022-05-02'),
('B25', 'S2', '2001-05-02'),
('B24', 'S2', '2001-05-02'),
('B23', 'S2', '2022-05-02'),
('B22', 'S2', '2022-05-02'),
('B21', 'S2', '2022-05-02'),
('B19', 'S1', '2022-05-02'),
('B18', 'S1', '2022-05-02'),
('B17', 'S1', '2022-05-02'),
('B16', 'S1', '2022-05-02'),
('B15', 'S1', '2001-05-02'),
('B14', 'S1', '2001-05-02'),
('B13', 'S1', '2022-05-02'),
('B12', 'S1', '2022-05-02'),
('B11', 'S1', '2022-05-02');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `filename`, `email`) VALUES
(14, '64406c3e27da4.jpg', 'nadazc@outlook.fr'),
(18, '644690b703f6a.jpg', 'fedi.bahloul@gmail.com'),
(20, '6446947f7d8a3.webp', 'hadilyahiaoui02@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `IDLOCATION` varchar(8) NOT NULL,
  `IDBORNEPRISE` varchar(20) DEFAULT NULL,
  `IDBORNEDEPOT` varchar(20) NOT NULL,
  `IDVELO` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IDUTILISATEUR` varchar(8) NOT NULL,
  `DATEDEPOT` date DEFAULT NULL,
  `HEUREDEPOT` time DEFAULT NULL,
  `KILOMETRAGEDEPOT` int DEFAULT NULL,
  `VITESSEMAXDEPOT` int DEFAULT NULL,
  `VITESSEMOYDEPOT` int DEFAULT NULL,
  `DATEPRISE` date DEFAULT NULL,
  `HEUREPRISE` time DEFAULT NULL,
  PRIMARY KEY (`IDLOCATION`),
  KEY `FK_DEPOSER` (`IDBORNEDEPOT`),
  KEY `FK_LOUER` (`IDUTILISATEUR`),
  KEY `FK_PRENDRE1` (`IDBORNEPRISE`),
  KEY `FK_PRENDRE2` (`IDVELO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`IDLOCATION`, `IDBORNEPRISE`, `IDBORNEDEPOT`, `IDVELO`, `IDUTILISATEUR`, `DATEDEPOT`, `HEUREDEPOT`, `KILOMETRAGEDEPOT`, `VITESSEMAXDEPOT`, `VITESSEMOYDEPOT`, `DATEPRISE`, `HEUREPRISE`) VALUES
('L1', 'B11', 'B12', 'V1', 'U1', '2022-05-22', '17:00:00', 10, 20, 15, '2022-05-22', '15:00:00'),
('L2', 'B13', 'B23', 'V2', 'U1', '2022-05-22', '19:30:00', 10, 20, 15, '2022-05-22', '17:30:00'),
('L3', 'B24', 'B33', 'V3', 'U15', '2022-05-22', '21:25:00', 15, 30, 15, '2022-05-22', '20:30:00'),
('L4', 'B33', 'B33', 'V4', 'U15', '2022-05-22', '23:30:00', 15, 32, 15, '2022-05-22', '21:26:00'),
('L5', 'B31', 'B11', 'V2', 'U15', '2022-05-22', '23:59:00', 6, 32, 10, '2022-05-22', '23:35:00'),
('L6', 'B12', 'B22', 'V1', 'U2', '2022-05-23', '11:30:00', 6, 6, 6, '2022-05-23', '10:30:00'),
('L7', 'B22', 'B12', 'V1', 'U2', '2022-05-23', '12:45:00', 8, 15, 12, '2022-05-23', '11:45:00'),
('L8', 'B12', 'B22', 'V1', 'U2', '2022-05-23', '21:30:00', 15, 6, 9, '2022-05-23', '20:30:00'),
('L9', 'B22', 'B12', 'V1', 'U2', '2022-05-23', '23:59:00', 10, 10, 10, '2022-05-23', '21:40:00'),
('L10', 'L22', 'L23', 'V11', 'U1', '2022-05-24', '10:00:00', 15, 15, 15, '2022-05-24', '09:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `maintenanceborne`
--

DROP TABLE IF EXISTS `maintenanceborne`;
CREATE TABLE IF NOT EXISTS `maintenanceborne` (
  `IDMAINTENANCEBORNE` varchar(8) NOT NULL,
  `IDBORNE` varchar(20) NOT NULL,
  `DATEDEBUTMAINTENANCEBORNE` date DEFAULT NULL,
  `DATEFINMAINTENANCEBORNE` date DEFAULT NULL,
  `COUTMAINTENANCEBORNE` int DEFAULT NULL,
  `TYPEMAINTENANCEBORNE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IDMAINTENANCEBORNE`),
  KEY `FK_ENTRENIRBORNE` (`IDBORNE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `maintenanceborne`
--

INSERT INTO `maintenanceborne` (`IDMAINTENANCEBORNE`, `IDBORNE`, `DATEDEBUTMAINTENANCEBORNE`, `DATEFINMAINTENANCEBORNE`, `COUTMAINTENANCEBORNE`, `TYPEMAINTENANCEBORNE`) VALUES
('MB1', 'B11', '2022-05-24', '2022-05-24', 10, 'preventive'),
('MB2', 'B13', '2022-05-24', '2022-05-24', 10, 'preventive'),
('MB3', 'B24', '2022-05-24', '2022-05-24', 10, 'preventive'),
('MB4', 'B33', '2022-05-24', '2022-05-24', 10, 'preventive'),
('MB5', 'B31', '2022-05-24', '2022-05-24', 10, 'preventive'),
('MB6', 'B22', '2022-05-24', '2022-05-24', 10, 'preventive');

-- --------------------------------------------------------

--
-- Structure de la table `maintenancevelo`
--

DROP TABLE IF EXISTS `maintenancevelo`;
CREATE TABLE IF NOT EXISTS `maintenancevelo` (
  `IDMAINTENANCEVELO` varchar(8) NOT NULL,
  `IDVELO` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DATEDEBUTMAINTENANCEVELO` date DEFAULT NULL,
  `DATEFINMAINTENANCEVELO` date DEFAULT NULL,
  `COUTMAINTENANCEVELO` int DEFAULT NULL,
  `TYPEMAINTENANCEVELO` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IDMAINTENANCEVELO`),
  KEY `FK_ENTRENIRVELO` (`IDVELO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `maintenancevelo`
--

INSERT INTO `maintenancevelo` (`IDMAINTENANCEVELO`, `IDVELO`, `DATEDEBUTMAINTENANCEVELO`, `DATEFINMAINTENANCEVELO`, `COUTMAINTENANCEVELO`, `TYPEMAINTENANCEVELO`) VALUES
('MV1', 'V1', '2022-05-24', '2022-05-24', 30, 'Panne'),
('MV2', 'V2', '2022-05-24', '2022-05-24', 30, 'Panne'),
('MV3', 'V3', '2022-05-24', '2022-05-24', 30, 'Panne'),
('MV4', 'V4', '2022-05-24', '2022-05-24', 30, 'Panne'),
('MV5', 'V5', '2022-05-24', '2022-05-24', 25, 'Panne');

-- --------------------------------------------------------

--
-- Structure de la table `station`
--

DROP TABLE IF EXISTS `station`;
CREATE TABLE IF NOT EXISTS `station` (
  `IDSTATION` varchar(8) NOT NULL,
  `ADRESSESTATION` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `DATEAJOUTSTATION` date DEFAULT NULL,
  PRIMARY KEY (`IDSTATION`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `station`
--

INSERT INTO `station` (`IDSTATION`, `ADRESSESTATION`, `DATEAJOUTSTATION`) VALUES
('S3', 'Avenue', '2022-05-02'),
('S1', 'Rue de la Liberté', '2022-05-02'),
('S2', 'Avenue Habib Bourguiba', '2022-05-02'),
('S4', 'Rue 2 Mars', '2022-05-02');

-- --------------------------------------------------------

--
-- Structure de la table `typeabonnement`
--

DROP TABLE IF EXISTS `typeabonnement`;
CREATE TABLE IF NOT EXISTS `typeabonnement` (
  `IDTYPEABONNEMENT` varchar(8) NOT NULL,
  `DESIGNATIONABONNEMENT_` varchar(20) DEFAULT NULL,
  `DUREEABONNEMENT` varchar(20) DEFAULT NULL,
  `FRAISABONNEMENT` int DEFAULT NULL,
  `TARIFABONNEMENT` int DEFAULT NULL,
  PRIMARY KEY (`IDTYPEABONNEMENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `typeabonnement`
--

INSERT INTO `typeabonnement` (`IDTYPEABONNEMENT`, `DESIGNATIONABONNEMENT_`, `DUREEABONNEMENT`, `FRAISABONNEMENT`, `TARIFABONNEMENT`) VALUES
('TA1', 'Courte Durée', '7', 1, 1),
('TA2', 'Longue Durée', '365', 5, 1),
('TA3', 'TunisTi', '365', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IDUTILISATEUR` varchar(8) NOT NULL,
  `PRENOMUTILISATEUR` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `NOMUTILISATEUR` varchar(20) DEFAULT NULL,
  `DATENAISSANCE` date DEFAULT NULL,
  `NUMEROTELEPHONE` int DEFAULT NULL,
  `SEXE` varchar(1) DEFAULT NULL,
  `EMAILUTILISATEUR` varchar(30) DEFAULT NULL,
  `MDPUTILISATEUR` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDUTILISATEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDUTILISATEUR`, `PRENOMUTILISATEUR`, `NOMUTILISATEUR`, `DATENAISSANCE`, `NUMEROTELEPHONE`, `SEXE`, `EMAILUTILISATEUR`, `MDPUTILISATEUR`) VALUES
('U8', 'Omar', 'Haddad', '1991-10-29', 24890123, 'H', 'omar.haddad@gmail.com', 'qP#9fT4@nL'),
('U7', 'Fatma', 'Gharbi', '1998-04-17', 27789012, 'F', 'fatma.gharbi@gmail.com', 'g@5vR2xMf#'),
('U6', 'Mohamed', 'Farhat', '1989-07-31', 21678901, 'H', 'mohamed.farhat@gmail.com', 'rD#6sT@8lJ'),
('U5', 'Amira', 'Ezzedine', '2000-01-05', 22567890, 'F', 'amira.ezzedine@gmail.com', 'zK!7fG#9@j'),
('U4', 'Sami', 'Dali', '1987-08-19', 29456789, 'H', 'sami.dali@gmail.com', 'a#9@pL4sTc'),
('U3', 'Amina', 'Cherif', '1992-11-04', 24345678, 'F', 'amina.cherif@gmail.com', 'd@%8gJk2$z'),
('U16', 'Hassen', 'Bouzid', '1995-03-12', 27234567, 'H', 'hassen.bouzid@gmail.com', 'p@#5Zw7HxL'),
('U17', 'Ahmed', 'Ben Ali', '1980-05-23', 25123456, 'H', 'ahmed.benali@gmail.com', 'xG#6mDf9@k'),
('U9', 'Salma', 'Ibrahim', '1986-12-25', 26901234, 'F', 'salma.ibrahim@gmail.com', 'p@#6nDf7!k'),
('U10', 'Anis', 'Jarraya', '1994-02-18', 23012345, 'H', 'anis.jarraya@gmail.com', 'dG#9@kT6xL'),
('U11', 'Aicha ', 'Ben Fadhel', '2001-08-31', 94067474, 'F', 'aichaaichabff@gmail.com', 'doordiedoit'),
('U12', 'Amine', 'Bachka', '2001-11-28', 27099064, 'h', 'bachkamohamed1@gmail.com', '123456789'),
('U13', 'siwar', 'behi', '2001-03-12', 56302445, 'F', 'siwar.behi123@gmail.com', 'Ygxj4554nhhn'),
('U14', 'Fatima', 'Ait Zait', '1971-03-09', 96379753, 'F', 'fatima.tami2013@hotmail.fr', 'alphabeta'),
('U1', 'Nada', 'Zammit Chatti', '2001-05-02', 25020291, 'F', 'nadazc@outlook.fr', '123'),
('U18', 'Nabil', 'Kouki', '2001-03-04', 94157789, 'H', 'koukinabil73@gmail.com', '123'),
('U19', 'bahloul', 'fedi', '2001-04-29', 26490181, 'H', 'fedi.bahloul@gmail.com', 'fedifedifedi'),
('U20', 'Nour ', 'Ben Jannena', '2001-06-14', 29450671, 'F', 'nbenjannena@gmail.com', '@nour@'),
('U21', 'didi', 'chatii', '2023-04-24', 51127790, 'F', 'hadilyahiaoui02@gmail.com', 'hahadidi'),
('U45', 'Amine', 'lambda', '2001-02-02', 2558888, 'H', 'zjsnzjs', 'dzzdz'),
('U44', 'Amine', 'lambda', '2001-02-02', 2558888, 'H', 'zjsnzjs', 'dzzdz'),
('U43', 'Siwar', 'ouledhmed', '2001-09-07', 26895895, 'F', 'siwar@gmail.com', '159'),
('U42', 'Siwar', 'ali', '2003-05-06', 21050506, 'F', 'siwar@gmail.com', '1235'),
('U41', 'Ahmed', 'Lamine', '2003-05-31', 25060609, 'H', 'ahmed@gmail.com', '123'),
('U40', 'Ali', 'landolsi', '2001-05-02', 25666999, 'H', 'ali@gmail.com', '123'),
('U39', 'Ahmed', 'nabil', '2001-05-02', 25060603, 'H', 'ahmed@gmail.com', '123'),
('U38', 'Ahmed', 'Nabil', '2001-05-02', 25669669, 'H', 'ahmed@gmail.com', '123456'),
('U36', 'Molka', 'elloumi', '2002-03-28', 98111111, 'F', 'molka.elloumi@gmail.com', '123'),
('U37', 'admin', 'admin', '2001-05-02', 25020291, 'F', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `velo`
--

DROP TABLE IF EXISTS `velo`;
CREATE TABLE IF NOT EXISTS `velo` (
  `IDVELO` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IDBORNE` varchar(20) DEFAULT NULL,
  `MODELEVELO` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `DATEAJOUTVELO` date DEFAULT NULL,
  `KILOMETRAGEACTUEL` varchar(8) DEFAULT NULL,
  `VITESSEMAXACTUELLE` int DEFAULT NULL,
  `VITESSEMOYACTUELLE` int DEFAULT NULL,
  PRIMARY KEY (`IDVELO`),
  KEY `FK_STATIONNER` (`IDBORNE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `velo`
--

INSERT INTO `velo` (`IDVELO`, `IDBORNE`, `MODELEVELO`, `DATEAJOUTVELO`, `KILOMETRAGEACTUEL`, `VITESSEMAXACTUELLE`, `VITESSEMOYACTUELLE`) VALUES
('V20', '', '', '0000-00-00', '0', 0, 0),
('V19', 'B29', 'electrique', '2022-05-02', '0', 0, 0),
('V18', 'B28', 'electrique', '2022-05-02', '0', 0, 0),
('V17', 'B27', 'electrique', '2022-05-02', '0', 0, 0),
('V16', 'B26', 'electrique', '2022-05-02', '0', 0, 0),
('V15', 'B25', 'electrique', '2022-05-02', '0', 0, 0),
('V14', 'B24', 'electrique', '2022-05-02', '0', 0, 0),
('V13', 'B23', 'electrique', '2022-05-02', '0', 0, 0),
('V12', 'B22', 'electrique', '2022-05-02', '0', 0, 0),
('V11', 'B21', 'electrique', '2022-05-02', '0', 0, 0),
('V10', 'B20', 'electrique', '2022-05-02', '0', 0, 0),
('V9', 'B19', 'electrique', '2022-05-02', '0', 0, 0),
('V8', 'B18', 'classique', '2022-05-02', '0', 0, 0),
('V7', 'B17', 'classique', '2022-05-02', '0', 0, 0),
('V6', 'B16', 'classique', '2022-05-02', '0', 0, 0),
('V5', 'B15', 'classique', '2022-05-02', '0', 0, 0),
('V4', 'B14', 'classique', '2022-05-02', '0', 0, 0),
('V3', 'B13', 'classique', '2022-05-02', '0', 0, 0),
('V2', 'B12', 'classique', '2022-05-02', '0', 0, 0),
('V1', 'B11', 'classique', '2022-05-02', '0', 0, 0),
('V23', 'B23', 'classique', '2022-05-02', '0', 0, 0),
('V24', 'B24', 'classique', '2022-05-02', '0', 0, 0),
('V25', 'B25', 'classique', '2022-05-02', '0', 0, 0),
('V26', 'B26', 'classique', '2022-05-02', '0', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
