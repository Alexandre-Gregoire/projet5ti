CREATE DATABASE  IF NOT EXISTS `alexandre` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `alexandre`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 10.10.51.252    Database: alexandre
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bonne_reponse`
--

DROP TABLE IF EXISTS `bonne_reponse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bonne_reponse` (
  `bonneReponseId` int NOT NULL AUTO_INCREMENT,
  `bonneReponseText` varchar(255) NOT NULL,
  PRIMARY KEY (`bonneReponseId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonne_reponse`
--

LOCK TABLES `bonne_reponse` WRITE;
/*!40000 ALTER TABLE `bonne_reponse` DISABLE KEYS */;
INSERT INTO `bonne_reponse` VALUES (1,'50'),(2,'Ukraine'),(3,'Formidable'),(4,'Cheese'),(5,'24'),(6,'Algerie'),(7,'Kenya'),(8,'Non'),(9,'Argentine'),(10,'France'),(11,'Allemagne'),(12,'if condition:'),(13,'while condition :'),(14,'Nouveau texte de la bonne réponse'),(15,'bonne reponse');
/*!40000 ALTER TABLE `bonne_reponse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie` (
  `categorieId` int NOT NULL AUTO_INCREMENT,
  `categorieNom` varchar(255) NOT NULL,
  `categorieImage` varchar(255) NOT NULL,
  PRIMARY KEY (`categorieId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Geographie','Images/Geographie.png'),(2,'Chansons','Images/chansons.png'),(3,'Foot','Images/football.png'),(4,'Informatique','Images/informatique.png');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mauvaise_reponse`
--

DROP TABLE IF EXISTS `mauvaise_reponse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mauvaise_reponse` (
  `mauvaiseReponseId` int NOT NULL AUTO_INCREMENT,
  `mauvaiseReponseText` varchar(255) NOT NULL,
  `questionId` int DEFAULT NULL,
  PRIMARY KEY (`mauvaiseReponseId`),
  KEY `questionId` (`questionId`),
  CONSTRAINT `mauvaise_reponse_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`questionId`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mauvaise_reponse`
--

LOCK TABLES `mauvaise_reponse` WRITE;
/*!40000 ALTER TABLE `mauvaise_reponse` DISABLE KEYS */;
INSERT INTO `mauvaise_reponse` VALUES (1,'53',1),(2,'58',1),(3,'France',2),(4,'Russie',2),(5,'Papaoutai',3),(6,'Ta Fête',3),(7,'Racine carrée',4),(8,'23',5),(9,'21',5),(10,'Congo',6),(11,'Egypte',6),(12,'Jappon',7),(13,'France',7),(14,'oui',8),(15,'Suisse',9),(16,'France',9),(17,'Allemagne',10),(18,'Argentine',10),(19,'Bresil',11),(20,'Belgique',11),(21,'if [condition]:',12),(22,'if (condition):',12),(23,'while [condition] :',13),(24,'while (condition):',13),(25,'Nouveau texte de la mauvaise réponse',14),(26,'Nouveau texte de la mauvaise réponse',14),(27,'Nouveau texte de la mauvaise réponse',14),(28,'mauvaise 1',15),(29,'mauvaise 2',15),(30,'mauvaise 3',15);
/*!40000 ALTER TABLE `mauvaise_reponse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `questionId` int NOT NULL AUTO_INCREMENT,
  `questionText` varchar(255) NOT NULL,
  `bonneReponseId` int DEFAULT NULL,
  `quizzId` int DEFAULT NULL,
  PRIMARY KEY (`questionId`),
  KEY `bonneReponseId` (`bonneReponseId`),
  KEY `quizzId` (`quizzId`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`bonneReponseId`) REFERENCES `bonne_reponse` (`bonneReponseId`),
  CONSTRAINT `question_ibfk_2` FOREIGN KEY (`quizzId`) REFERENCES `quizz` (`quizzId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'Combien de pays il ya en Europe ?',1,1),(2,'Quel est le pays le plus grand d europe',2,1),(3,'Quel est la chansons la plus écoutées de stromae ?',3,2),(4,'Quel est le premier album de stromae ?',4,2),(5,'Combien de titre stromae at il sortis',5,2),(6,'Quel est le pays le plus grand d Afrique',6,3),(7,'Quel pays fais partie de l Afrique',7,3),(8,'l afrique est it le plus grand des continents ?',8,3),(9,'qui est le gagnant de la coupe du monde de 2022',9,4),(10,'qui est le gagnant de la coupe du monde de 2018',10,4),(11,'qui est le gagnant de la coupe du monde de 2014',11,4),(12,'commment on écrit une condition if',12,5),(13,'commment on écrit une condition while',13,5),(14,'comment s\'appelle le pere d\'alexandre',14,14),(15,'question n°1',15,15);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizz` (
  `quizzId` int NOT NULL AUTO_INCREMENT,
  `quizzNom` varchar(255) NOT NULL,
  `quizzDifficulte` int NOT NULL,
  `quizzDateCreation` datetime NOT NULL,
  `utilisateurId` int DEFAULT NULL,
  `categorieId` int DEFAULT NULL,
  PRIMARY KEY (`quizzId`),
  KEY `categorieId` (`categorieId`),
  KEY `utilisateurId` (`utilisateurId`),
  CONSTRAINT `quizz_ibfk_1` FOREIGN KEY (`categorieId`) REFERENCES `categorie` (`categorieId`),
  CONSTRAINT `quizz_ibfk_2` FOREIGN KEY (`utilisateurId`) REFERENCES `utilisateur` (`utilisateurId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizz`
--

LOCK TABLES `quizz` WRITE;
/*!40000 ALTER TABLE `quizz` DISABLE KEYS */;
INSERT INTO `quizz` VALUES (1,'Europe',3,'2023-03-07 00:00:00',1,1),(2,'Stromae',7,'2023-03-07 00:00:00',3,2),(3,'Afrique',5,'2023-03-07 00:00:00',4,1),(4,'Coupe du monde',4,'2023-03-07 00:00:00',2,3),(5,'Python',3,'2023-03-07 00:00:00',1,4),(6,'wesh',1,'2023-04-25 11:11:28',1,3),(7,'yasin est pd',5,'2023-04-25 11:23:00',1,3),(8,'ddzadazdaz',4,'2023-04-25 11:49:26',1,2),(9,'rgtgbtgtertrg',4,'2023-04-25 11:51:42',1,3),(10,'wesh wesh canne a peche',9,'2023-04-25 11:53:47',1,4),(11,'ewan wesh',4,'2023-04-27 12:48:16',1,2),(12,'le test ultime',3,'2023-04-27 12:58:50',1,4),(13,'le test ultime2',7,'2023-04-27 13:39:58',1,2),(14,'daronAlexandre',2,'2023-05-16 10:37:55',6,2),(15,'aaaa',5,'2023-05-16 10:40:09',6,4);
/*!40000 ALTER TABLE `quizz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score`
--

DROP TABLE IF EXISTS `score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `score` (
  `scoreId` int NOT NULL AUTO_INCREMENT,
  `score` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `quizzId` int DEFAULT NULL,
  `utilisateurId` int DEFAULT NULL,
  PRIMARY KEY (`scoreId`),
  KEY `quizzId` (`quizzId`),
  KEY `utilisateurId` (`utilisateurId`),
  CONSTRAINT `score_ibfk_1` FOREIGN KEY (`quizzId`) REFERENCES `quizz` (`quizzId`),
  CONSTRAINT `score_ibfk_2` FOREIGN KEY (`utilisateurId`) REFERENCES `utilisateur` (`utilisateurId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` VALUES (1,8852,'2023-03-11 00:00:00',1,3),(2,7425,'2023-03-12 00:00:00',1,2),(3,1856,'2023-03-10 00:00:00',2,2),(4,2548,'2023-03-13 00:00:00',3,4),(5,7563,'2023-03-20 00:00:00',3,5),(6,9245,'2023-03-14 00:00:00',4,5),(7,9867,'2023-03-18 00:00:00',5,1),(8,4856,'2023-03-21 00:00:00',5,2),(9,7589,'2023-03-20 00:00:00',5,5),(10,NULL,'2023-04-25 11:11:28',6,NULL),(11,NULL,'2023-04-25 11:23:00',7,NULL),(12,NULL,'2023-04-25 11:49:26',8,NULL),(13,NULL,'2023-04-25 11:51:42',9,NULL),(14,NULL,'2023-04-25 11:53:47',10,NULL),(15,NULL,'2023-04-27 12:48:16',11,NULL),(16,NULL,'2023-04-27 12:58:50',12,NULL),(17,NULL,'2023-04-27 13:39:58',NULL,NULL),(18,0,'2023-05-16 10:37:55',14,NULL),(19,0,'2023-05-16 10:40:09',15,NULL);
/*!40000 ALTER TABLE `score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `utilisateurId` int NOT NULL AUTO_INCREMENT,
  `utilisateurPseudo` varchar(255) NOT NULL,
  `utilisateurMdp` varchar(255) NOT NULL,
  `utilisateurEmail` varchar(255) NOT NULL,
  `utilisateurRole` varchar(255) NOT NULL,
  PRIMARY KEY (`utilisateurId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'Alexandre','1234','210278@site.asty-moulin.be','admin'),(2,'lodiren','azerty','lodiren@gmail.com','membre'),(3,'yasin','qsdfg','yasin@gmail.com','membre'),(4,'sefedin','SefShit1','sef@gmail.com','membre'),(5,'victor','victor','victor@gmail.com','membre'),(6,'test','test','test@gjkzhj.c','membre');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-16 10:58:17
