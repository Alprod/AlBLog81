-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: my_blog
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Comments` (
  `idComments` int NOT NULL AUTO_INCREMENT,
  `commentTitle` varchar(200) DEFAULT NULL,
  `commentContent` text,
  `create_at` datetime DEFAULT NULL,
  `post_commentId` int DEFAULT NULL,
  `user_commnetId` int DEFAULT NULL,
  PRIMARY KEY (`idComments`),
  UNIQUE KEY `user_commnetId` (`user_commnetId`),
  KEY `post_commentId` (`post_commentId`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_commentId`) REFERENCES `Posts` (`idPosts`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_commnetId`) REFERENCES `Users` (`idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Posts` (
  `idPosts` int NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(100) DEFAULT NULL,
  `postContent` text,
  `images` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `date_create_at` datetime DEFAULT NULL,
  `post_userId` int NOT NULL,
  PRIMARY KEY (`idPosts`),
  KEY `post_userId` (`post_userId`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_userId`) REFERENCES `Users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
INSERT INTO `Posts` VALUES (1,'Parimis hôtel','Premier site web 100% html css avec un framwork css Boostrap','/images/aventureLand.jpg',NULL,'2020-10-11 21:47:17',2),(2,'Abc Chauffage','Exercice de css et de javascript ','/images/raodTrip.jpg',NULL,'2020-09-01 10:47:17',2),(3,'Raod trip','Premier Raod Trip de l\'année, avec vue unique.\n','/images/aventureLand.jpg',NULL,'2020-06-17 21:47:17',1),(4,'Vue du ciel','Vol en hélicoptère avec un ciel nuageux trop top.','/images/cloudB&W.jpg',NULL,'2019-11-15 21:47:17',1);
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `idUsers` int NOT NULL AUTO_INCREMENT,
  `roles` int NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `addressNumber` varchar(45) DEFAULT NULL,
  `addressName` varchar(200) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zipcode` int DEFAULT NULL,
  `departement` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,1,'alain','Germain','Alprod','alprod81','alprod81@gmail.com','2020-10-11 20:00:48',NULL,NULL,NULL,NULL,NULL,NULL),(2,2,'marc','Dupont','Mcdupont','dupont95','dupontmarc@free.fr','2020-10-11 21:32:08',NULL,NULL,NULL,NULL,NULL,NULL),(3,3,'marie','Smith','MissSmith','smtihMarie23','mari@orange.fr','2020-10-11 21:32:22',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-02 16:36:16
