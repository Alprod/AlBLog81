CREATE DATABASE  IF NOT EXISTS `my_blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_blog`;
-- MySQL dump 10.13  Distrib 8.0.22, for macos10.15 (x86_64)
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
  `commentCreateAt` datetime DEFAULT NULL,
  `postCommentId` int DEFAULT NULL,
  `userCommentId` int DEFAULT NULL,
  `signal` tinyint DEFAULT '0',
  PRIMARY KEY (`idComments`),
  KEY `post_commentId` (`postCommentId`),
  KEY `user_commentId` (`userCommentId`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postCommentId`) REFERENCES `Posts` (`idPosts`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userCommentId`) REFERENCES `Users` (`idUsers`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=403 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (399,'Nous appartiens','&lt;p&gt;Quoi Pour demain&lt;/p&gt;','2020-12-07 00:44:41',25,28,0),(400,'D&eacute;j&agrave; demain','&lt;p&gt;Que nous reserve l\'avenir&lt;/p&gt;','2020-12-19 18:23:10',25,33,0),(401,'article','&lt;p&gt;Titre de votre article est trop nul&lt;/p&gt;','2020-12-20 01:28:06',26,33,0),(402,'Article','&lt;h2&gt;Articles&lt;/h2&gt;','2020-12-21 00:11:09',26,28,0);
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
  `dateCreateAt` datetime DEFAULT NULL,
  `postUserId` int NOT NULL,
  PRIMARY KEY (`idPosts`),
  KEY `posts_ibfk_1_idx` (`postUserId`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`postUserId`) REFERENCES `Users` (`idUsers`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
INSERT INTO `Posts` VALUES (19,'Wu tang forever','&lt;p&gt;Trop bien&lt;/p&gt;','Wu_tang_forever-28_984074.jpg','','2020-12-14 02:09:34',28),(25,'demain mis jour','&lt;h2&gt;Demain&lt;/h2&gt;\r\n&lt;p&gt;Demain&lt;/p&gt;','demain_mis_jour-28_88d1c125b2e31baad04c23148d5a2fb8.jpg','','2020-12-14 02:14:16',28),(26,'Teste Post','&lt;h1&gt;Article de test 3 !!&lt;/h1&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;un atricle test&lt;/p&gt;','Teste_Post-28_Wu-Tang-Killer-Mascot-Design-Old-Dirty-Dermot-BK-NY.jpg','alain-germain.fr','2020-12-14 02:07:55',28),(27,'Nouvelle article','&lt;p&gt;Tesst Nouvelle article&lt;/p&gt;','Nouvelle_article-28_18828545.jpg','','2020-12-14 02:33:26',28),(28,'Bulle d\'aire','&lt;h1&gt;Une blle dans le temps !???&lt;/h1&gt;\r\n&lt;p&gt;Une bulle qui tourne dans le temps ne vaut rien&lt;/p&gt;','Bulle_d\'aire-28_wu_2x.png','','2020-12-20 01:34:09',28);
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
  `zip_code` int DEFAULT NULL,
  `departement` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (28,2,'Anne','Am&eacute;lie','Amelianne','9868f1e5a1a152d3ec3e03d5eb24a6bfe44064bdd6597966bb0ea08434ccce01','amelie@free.fr','2020-11-15 17:26:59','1','rue de la maire','Chamonix',95600,'Val d\'Oise','France'),(29,3,'jean','jean','BigJean','efbcc4ab66fe89a1d9562423dc0233455f1f03d1edc155ed029422a765940849','jean@free.fr','2020-11-29 12:08:02','12','rue de tout','Vaureal',95490,'Val d\'oise','France'),(31,1,'alain','germain','Alprod81','6ad985ea11348802cf992713e11225ee4f65f9fb4f2c1fb41a99cd04fb28ae26','alain@free.fr','2020-12-03 23:41:56','12','Bis Mendes','Cergy',95800,'Val d\'Oise','France'),(33,3,'Marshal','Frank','MaxFranky','3fe9084939de5f6d45d3fb97a70893443e87c19e543c87401baf977f5b215df6','franck@free.fr','2020-12-19 18:09:38','2','rue de la paroisse','Cergy',95670,'Val d\'oise','France'),(34,3,'Septembre','julie','SeptJul','3fe9084939de5f6d45d3fb97a70893443e87c19e543c87401baf977f5b215df6','julie@free.fr','2020-12-20 18:41:24','12 ','rue de tout','Cergy',95800,NULL,'France');
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

-- Dump completed on 2020-12-22 13:42:40
