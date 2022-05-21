-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: mysql.info.unicaen.fr    Database: 21913509_bd
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.44-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('Fatma','Fatma','$2y$10$U0RzFmY2IVk3Q5pcYgiq9uiTt1.0vD4RhqFFAxqXTmESw5AWHbq.K',0),('lecarpentier','lecarpentier','$2y$10$DKkC7ddME2bxjzzrtb15h.8JDLp4OZT/llL5B4bZFCpMkrkCSYkq.',0),('vanier','vanier','$2y$10$HuY0aoFOTEPlf7K9Fb386OtuIFnnvb1QbVp5oT3xq3YFA7UpEzryu',0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `marque` varchar(255) DEFAULT NULL,
  `modele` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `systemeExploitation` varchar(255) DEFAULT NULL,
  `paysDeFabrication` varchar(255) DEFAULT NULL,
  `anneeDeSortie` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `stockage` int(11) NOT NULL,
  `RAM` int(11) NOT NULL,
  `dureeBatterie` int(11) NOT NULL,
  `tailleEcran` int(11) NOT NULL,
  `couleur` varchar(255) DEFAULT NULL,
  `id_account` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_account` (`id_account`),
  CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (1,'Samsung Galaxy J4 CORE','Samsung','Galaxy J4 CORE','SmartPhone','Android','France',2018,180,16,1,3300,6,'gris, bleu, noir',NULL),(2,'iPhone Galaxy s6','iPhone','Galaxy s6','SmartPhone','iOS','États-Unis',2015,300,32,3,2600,7,'noir, gris',NULL),(3,'Huawei p30 Pro','Huawei','p30 Pro','SmartPhone','iOS','États-Unis',2019,530,4200,256,8,6,'rouge, rose, bleu, noir',NULL),(4,'iPhone 12 Pro Max','iPhone','12 Pro Max','SmartPhone','iOS','Corée du Sud et Etats-Unis',2020,1200,512,6,3969,7,'Noir, Argent, Or, Bleu','Fatma');
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-07 19:00:55

