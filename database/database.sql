-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: testesti
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `estassocie`
--

DROP TABLE IF EXISTS `estassocie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estassocie` (
  `IdProjet` int(11) NOT NULL,
  `IdPartenaires_` int(11) NOT NULL,
  `Role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdProjet`,`IdPartenaires_`),
  KEY `IdPartenaires_` (`IdPartenaires_`),
  CONSTRAINT `estassocie_ibfk_1` FOREIGN KEY (`IdProjet`) REFERENCES `projet` (`IdProjet`),
  CONSTRAINT `estassocie_ibfk_2` FOREIGN KEY (`IdPartenaires_`) REFERENCES `partenaire` (`IdPartenaires_`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `membre`
--

DROP TABLE IF EXISTS `membre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membre` (
  `IdMembre` int(11) NOT NULL AUTO_INCREMENT,
  `Prenom` varchar(50) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `IdSpecialite` int(11) NOT NULL,
  PRIMARY KEY (`IdMembre`),
  KEY `IdSpecialite` (`IdSpecialite`),
  CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`IdSpecialite`) REFERENCES `specialite` (`IdSpecialite`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `partenaire`
--

DROP TABLE IF EXISTS `partenaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partenaire` (
  `IdPartenaires_` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`IdPartenaires_`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `participe`
--

DROP TABLE IF EXISTS `participe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participe` (
  `IdMembre` int(11) NOT NULL,
  `IdTache` int(11) NOT NULL,
  `Fonction` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdMembre`,`IdTache`),
  KEY `IdTache` (`IdTache`),
  CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`IdMembre`) REFERENCES `membre` (`IdMembre`),
  CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`IdTache`) REFERENCES `tache` (`IdTache`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projet`
--

DROP TABLE IF EXISTS `projet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projet` (
  `IdProjet` int(11) NOT NULL AUTO_INCREMENT,
  `Num` bigint(20) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `IdSpecialite` int(11) NOT NULL,
  `IdMembre` int(11) NOT NULL,
  PRIMARY KEY (`IdProjet`),
  KEY `IdSpecialite` (`IdSpecialite`),
  KEY `IdMembre` (`IdMembre`),
  CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`IdSpecialite`) REFERENCES `specialite` (`IdSpecialite`),
  CONSTRAINT `projet_ibfk_2` FOREIGN KEY (`IdMembre`) REFERENCES `membre` (`IdMembre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specialite` (
  `IdSpecialite` int(11) NOT NULL AUTO_INCREMENT,
  `Intitule` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdSpecialite`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tache`
--

DROP TABLE IF EXISTS `tache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tache` (
  `IdTache` int(11) NOT NULL AUTO_INCREMENT,
  `Mun` int(11) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Début` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `IdProjet` int(11) NOT NULL,
  PRIMARY KEY (`IdTache`),
  KEY `IdProjet` (`IdProjet`),
  CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`IdProjet`) REFERENCES `projet` (`IdProjet`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'testesti'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-24 13:33:18
