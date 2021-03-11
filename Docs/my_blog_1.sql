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
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (404,'Le WUuuuuu','&lt;p&gt;Super Group&lt;/p&gt;','2020-12-24 12:25:16',19,35,0),(413,'teste super global','&lt;p&gt;test1&lt;/p&gt;','2021-01-21 01:20:50',37,28,0),(414,'test super global','&lt;p&gt;test avec session&lt;/p&gt;','2021-01-21 01:30:58',37,28,0),(415,'bon deal','Test du deal                        ','2021-01-21 08:41:10',26,35,0),(416,'eelelel','&lt;p&gt;mldldldldl&lt;/p&gt;','2021-02-20 17:43:08',47,28,0),(417,'aoaaoao','&lt;p&gt;sososos&lt;/p&gt;','2021-02-20 19:23:02',36,40,0);
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `CommentsReport`
--

LOCK TABLES `CommentsReport` WRITE;
/*!40000 ALTER TABLE `CommentsReport` DISABLE KEYS */;
/*!40000 ALTER TABLE `CommentsReport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Contacts`
--

LOCK TABLES `Contacts` WRITE;
/*!40000 ALTER TABLE `Contacts` DISABLE KEYS */;
INSERT INTO `Contacts` VALUES (1,'jeanMarie','jean@free.fr','test message','test message                ','2021-01-17 23:53:00'),(2,'jeanMarie','jean@free.fr','test Message','test Message                ','2021-01-18 00:24:00'),(3,'AsunaKito','alprod81@gmail.com','test message','test massage','2021-01-18 00:29:00'),(4,'AsunaKito','alprod81@gmail.com','test message','test Message                ','2021-01-18 00:51:00'),(5,'AsunaKito','alprod81@gmail.com','test message','test message                ','2021-01-18 00:59:00'),(6,'AsunaKito','alprod81@gmail.com','test message','test message                ','2021-01-18 01:05:00'),(7,'AsunaKito','alprod81@gmail.com','test message','test message','2021-01-18 01:36:00'),(8,'AsunaKito','alprod81@gmail.com','test message','message numero 2                ','2021-01-18 01:40:00'),(9,'AsunaKito','alprod81@gmail.com','test message 3','test message','2021-01-18 01:46:00'),(10,'AsunaKito','alprod81@gmail.com','test message 4','Message reussi','2021-01-18 01:53:00'),(11,'AsunaKito','alprod81@gmail.com','long test','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel facilisis urna, nec molestie est. Phasellus a metus eget ligula ultrices sodales in in turpis. Ut consectetur ex vitae elit ultrices, venenatis cursus est suscipit. Vivamus elit tellus, tempus et lorem a, volutpat ullamcorper lorem. In massa quam, pellentesque vel magna at, congue pellentesque nunc. Etiam pulvinar mi eget lorem pretium, quis pretium quam imperdiet. Morbi magna enim, placerat eget fringilla a, consequat pretium leo. Morbi laoreet tincidunt nisl, eu efficitur purus vestibulum sed. Maecenas quis tellus eget orci interdum tempor. Vivamus at laoreet lectus. In fringilla mi finibus, gravida lectus nec, aliquam massa. Aliquam at volutpat justo, quis tincidunt velit. Quisque pulvinar dolor in ultrices sodales. Sed facilisis odio nibh, nec blandit mauris mollis et. Sed bibendum dictum ante eu viverra.\r\n\r\nEtiam iaculis consectetur fermentum. Maecenas lobortis eleifend posuere. Aenean ligula urna, ornare a augue id, congue sodales sapien. Donec dignissim ex neque, id interdum nibh tempor nec. Etiam semper convallis arcu, vitae pretium sapien consectetur nec. Cras eget molestie tellus. Praesent eu lobortis sem, ut dictum erat. Quisque viverra tincidunt nulla, vel feugiat enim mattis et. Nullam gravida sollicitudin nibh, id fermentum ligula dictum in.\r\n\r\nMorbi dictum et magna nec suscipit. Aenean feugiat ac sem eget gravida. Mauris semper quam dignissim lectus auctor ultrices. Morbi id fermentum ligula. Nam laoreet nisl in odio vestibulum maximus. Sed et ipsum dolor. Vestibulum facilisis nibh nunc. Morbi ac iaculis est. Proin gravida accumsan magna quis vestibulum.','2021-01-18 02:18:00'),(12,'AsunaKito','alprod81@gmail.com','long test 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel facilisis urna, nec molestie est. Phasellus a metus eget ligula ultrices sodales in in turpis. Ut consectetur ex vitae elit ultrices, venenatis cursus est suscipit. Vivamus elit tellus, tempus et lorem a, volutpat ullamcorper lorem. In massa quam, pellentesque vel magna at, congue pellentesque nunc. Etiam pulvinar mi eget lorem pretium, quis pretium quam imperdiet. Morbi magna enim, placerat eget fringilla a, consequat pretium leo. Morbi laoreet tincidunt nisl, eu efficitur purus vestibulum sed. Maecenas quis tellus eget orci interdum tempor. Vivamus at laoreet lectus. In fringilla mi finibus, gravida lectus nec, aliquam massa. Aliquam at volutpat justo, quis tincidunt velit. Quisque pulvinar dolor in ultrices sodales. Sed facilisis odio nibh, nec blandit mauris mollis et. Sed bibendum dictum ante eu viverra.\r\n\r\nEtiam iaculis consectetur fermentum. Maecenas lobortis eleifend posuere. Aenean ligula urna, ornare a augue id, congue sodales sapien. Donec dignissim ex neque, id interdum nibh tempor nec. Etiam semper convallis arcu, vitae pretium sapien consectetur nec. Cras eget molestie tellus. Praesent eu lobortis sem, ut dictum erat. Quisque viverra tincidunt nulla, vel feugiat enim mattis et. Nullam gravida sollicitudin nibh, id fermentum ligula dictum in.\r\n\r\nMorbi dictum et magna nec suscipit. Aenean feugiat ac sem eget gravida. Mauris semper quam dignissim lectus auctor ultrices. Morbi id fermentum ligula. Nam laoreet nisl in odio vestibulum maximus. Sed et ipsum dolor. Vestibulum facilisis nibh nunc. Morbi ac iaculis est. Proin gravida accumsan magna quis vestibulum.                ','2021-01-18 02:21:00'),(13,'AsunaKito','alprod81@gmail.com','long test 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel facilisis urna, nec molestie est. Phasellus a metus eget ligula ultrices sodales in in turpis. Ut consectetur ex vitae elit ultrices, venenatis cursus est suscipit. Vivamus elit tellus, tempus et lorem a, volutpat ullamcorper lorem. In massa quam, pellentesque vel magna at, congue pellentesque nunc. Etiam pulvinar mi eget lorem pretium, quis pretium quam imperdiet. Morbi magna enim, placerat eget fringilla a, consequat pretium leo. Morbi laoreet tincidunt nisl, eu efficitur purus vestibulum sed. Maecenas quis tellus eget orci interdum tempor. Vivamus at laoreet lectus. In fringilla mi finibus, gravida lectus nec, aliquam massa. Aliquam at volutpat justo, quis tincidunt velit. Quisque pulvinar dolor in ultrices sodales. Sed facilisis odio nibh, nec blandit mauris mollis et. Sed bibendum dictum ante eu viverra.\r\n\r\nEtiam iaculis consectetur fermentum. Maecenas lobortis eleifend posuere. Aenean ligula urna, ornare a augue id, congue sodales sapien. Donec dignissim ex neque, id interdum nibh tempor nec. Etiam semper convallis arcu, vitae pretium sapien consectetur nec. Cras eget molestie tellus. Praesent eu lobortis sem, ut dictum erat. Quisque viverra tincidunt nulla, vel feugiat enim mattis et. Nullam gravida sollicitudin nibh, id fermentum ligula dictum in.\r\n\r\nMorbi dictum et magna nec suscipit. Aenean feugiat ac sem eget gravida. Mauris semper quam dignissim lectus auctor ultrices. Morbi id fermentum ligula. Nam laoreet nisl in odio vestibulum maximus. Sed et ipsum dolor. Vestibulum facilisis nibh nunc. Morbi ac iaculis est. Proin gravida accumsan magna quis vestibulum.','2021-01-18 02:28:00'),(14,'AsunaKito','alprod81@gmail.com','test message 4','teste message                ','2021-01-18 12:08:00'),(15,'AsunaKito','alprod81@gmail.com','test message 4','teste message                ','2021-01-18 12:08:00'),(16,'AsunaKito','alprod81@gmail.com','iifkfiffii','                didididididididi','2021-01-18 12:16:00'),(17,'alain','alain.germain@me.com','test','test                ','2021-01-18 13:15:00'),(18,'alain','alain.germain@me.com','tees','teredefedc                ','2021-01-18 13:18:00'),(19,'alain','alain.germain@me.com','Sujet test','message test                ','2021-01-18 13:27:00'),(20,'AsunaKito','alprod81@gmail.com','New vue message','Nouvel structure du message\r\n','2021-01-25 08:36:00'),(21,'AsunaKito','alprod81@gmail.com','Encore envoyer',' Toujours La m&ecirc;me histoire          ','2021-01-25 08:53:00'),(22,'AsunaKito','alprod81@gmail.com','un Dernier test','Un dernier test pour ma posture','2021-02-06 03:19:00'),(23,'AsunaKito','alprod81@gmail.com','fleur','la grande fleur','2021-02-15 04:21:00'),(24,'alain','alain.germain@me.com','test&eacute;','Message de test                ','2021-02-15 11:50:00'),(25,'alain','alain.germain@gmail.com','test&eacute;','message de test 2                ','2021-02-15 11:56:00'),(26,'AsunaKito','alprod81@gmail.com','aakakaakkkk','  aaaassssssssss','2021-02-20 19:29:00');
/*!40000 ALTER TABLE `Contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
INSERT INTO `Posts` VALUES (19,'Wu tang forever','&lt;p&gt;Trop bien&lt;/p&gt;','Wu_tang_forever-28_984074.jpg','','2020-12-14 02:09:34',28),(26,'Teste Post','&lt;h1&gt;Article de test 3 !!&lt;/h1&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;un atricle test&lt;/p&gt;','Teste_Post-28_Wu-Tang-Killer-Mascot-Design-Old-Dirty-Dermot-BK-NY.jpg','alain-germain.fr','2020-12-14 02:07:55',28),(36,'L\'avenir','&lt;p&gt;Tout commence Demain&lt;/p&gt;','Lavenir-28_markus-spiske-1nInzk7c0hg-unsplash.jpg','www.apple.com','2021-01-17 00:08:24',28),(37,'Mille born','&lt;p&gt;le temp roulle&lt;/p&gt;','Mille_born-35_rafael-de-nadai-b0eg-PYGICQ-unsplash.jpg','','2021-01-19 23:43:41',35),(47,'teste Post','&lt;p&gt;tes&lt;/p&gt;','user_id_35_teste_Post.png','','2021-02-10 02:48:49',35),(49,'sososo','&lt;p&gt;wosososdo&lt;/p&gt;','user-id_28_sososo.jpg','','2021-02-20 19:25:08',28);
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (28,2,'Anne','Am&eacute;lie','Ameliane','3fe9084939de5f6d45d3fb97a70893443e87c19e543c87401baf977f5b215df6','amelie@free.fr','2020-11-15 17:26:59','1','rue vendome','Bordeau',95600,'Val d\'Oise','France'),(35,1,'alain','Germain','AsunaKito','9b386fa0d390f128d0bd8e23bad38f32723fb5109ae7bdaf2c9dcfcacce67135','alprod81@gmail.com','2020-12-22 15:59:25','12','rue de la tour','Ambroise',23455,'Val d\'Oise','France'),(36,2,'germain','jackson','jack\'s','3fe9084939de5f6d45d3fb97a70893443e87c19e543c87401baf977f5b215df6','jackson@free.fr','2020-12-27 18:33:56','12','Bis de rue','Cergy',95890,NULL,'France'),(39,3,'marie','Jean','jeanMarie','3fe9084939de5f6d45d3fb97a70893443e87c19e543c87401baf977f5b215df6','jean@free.fr','2021-01-17 19:33:19','12','rue de tout','Cergy',98765,'Val d\'oise','France'),(40,3,'alain','dupont','alDupt','3fe9084939de5f6d45d3fb97a70893443e87c19e543c87401baf977f5b215df6','alain@free.fr','2021-02-09 04:55:05','12','Rue de rien','Cergy',95800,'Val d\'Oise','France');
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

-- Dump completed on 2021-03-04 15:38:09
