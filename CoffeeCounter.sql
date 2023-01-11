-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: coffecounter
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `consumption`
--

DROP TABLE IF EXISTS `consumption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumption` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `drinktype_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`user_id`),
  KEY `drinktype_id` (`drinktype_id`),
  CONSTRAINT `consumption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`),
  CONSTRAINT `consumption_ibfk_2` FOREIGN KEY (`drinktype_id`) REFERENCES `drinktype` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumption`
--

LOCK TABLES `consumption` WRITE;
/*!40000 ALTER TABLE `consumption` DISABLE KEYS */;
INSERT INTO `consumption` VALUES (1,'2022-09-29',2,1),(2,'2022-09-29',2,1),(3,'2022-09-29',1,2),(4,'2022-09-29',2,1),(5,'2022-09-29',2,2),(6,'2022-09-29',2,1),(7,'2022-09-29',2,1),(8,'2022-09-29',2,3),(9,'2022-09-29',2,1),(10,'2022-09-29',2,1),(11,'2022-09-29',2,2),(12,'2022-09-30',2,5),(13,'2022-09-30',2,1),(14,'2022-09-30',2,1),(15,'2022-09-30',1,1),(16,'2022-10-05',1,1),(17,'2022-10-05',2,2),(18,'2022-10-05',1,1),(19,'2022-10-05',1,3),(20,'2022-10-05',1,1),(21,'2022-10-05',1,1),(22,'2022-10-05',1,1),(23,'2022-10-05',1,2),(24,'2022-10-05',1,3),(25,'2022-10-05',1,4),(26,'2022-10-05',1,5),(27,'2022-10-05',1,4),(28,'2022-10-05',3,3),(29,'2022-10-05',1,2),(30,'2022-10-05',1,2),(31,'2022-10-05',2,5),(32,'2022-10-05',2,5),(33,'2022-10-05',1,1),(34,'2022-10-05',1,2),(35,'2022-10-05',1,5),(36,'2022-10-06',1,2),(37,'2022-10-06',1,2),(38,'2022-10-06',1,3),(39,'2022-10-06',1,4),(40,'2022-10-06',1,5),(41,'2022-10-06',1,2),(42,'2022-10-06',1,2),(43,'2022-10-06',1,5),(44,'2022-10-06',1,3),(45,'2022-10-06',1,3),(46,'2022-10-06',1,3),(47,'2022-10-06',1,3),(48,'2022-10-06',1,5),(49,'2022-10-06',1,5),(50,'2022-10-06',1,5),(51,'2022-10-06',1,5),(52,'2022-10-06',1,1),(53,'2022-10-06',1,3),(54,'2022-10-06',1,5),(55,'2022-10-06',1,4),(56,'2022-10-06',1,2),(57,'2022-10-06',1,5),(58,'2022-10-06',1,2),(59,'2022-10-06',1,5),(60,'2022-10-06',1,2),(61,'2022-10-06',1,5),(62,'2022-10-06',1,1),(63,'2022-10-06',1,4),(64,'2022-10-06',1,2),(65,'2022-10-06',1,4),(66,'2022-10-06',2,1),(67,'2022-10-06',2,4),(68,'2022-10-06',2,1),(69,'2022-10-06',2,4),(70,'2022-10-07',1,1),(71,'2022-10-07',1,2),(72,'2022-10-07',1,3),(73,'2022-10-07',1,1),(74,'2022-10-07',1,4),(75,'2022-10-10',1,1),(76,'2022-10-10',1,1),(77,'2022-10-10',1,4),(78,'2022-10-10',1,4),(79,'2022-10-10',1,3),(80,'2022-10-12',3,1),(81,'2022-10-12',3,4),(82,'2022-10-14',1,1),(83,'2022-10-14',1,1),(84,'2022-10-14',1,4),(85,'2022-10-14',1,1),(86,'2022-10-15',2,1),(87,'2022-10-15',2,1),(88,'2022-10-15',1,3),(89,'2022-10-15',1,3),(90,'2022-10-15',1,3),(91,'2022-10-15',2,3),(92,'2022-10-15',1,1),(93,'2022-10-15',1,4),(94,'2022-10-15',1,3),(95,'2022-10-15',1,3),(96,'2022-10-15',2,3),(97,'2022-10-15',1,3),(98,'2022-10-15',1,3),(99,'2022-10-15',1,3),(100,'2022-10-15',1,3),(101,'2022-10-15',1,3),(102,'2022-10-15',1,3),(103,'2022-10-15',2,1),(104,'2022-10-15',3,1),(105,'2022-10-15',1,1),(106,'2022-10-15',1,3),(107,'2022-10-15',1,3),(108,'2022-10-15',1,1),(109,'2022-10-15',1,1),(110,'2022-10-15',1,3),(111,'2022-10-15',1,2),(112,'2022-10-15',1,4),(113,'2022-10-15',1,1),(114,'2022-10-15',1,3),(115,'2022-10-15',1,5),(116,'2022-10-15',1,3),(117,'2022-10-15',1,3),(118,'2022-10-16',1,3),(119,'2022-10-16',1,3),(120,'2022-10-16',1,4),(121,'2022-10-16',1,1),(122,'2022-10-16',1,1),(123,'2022-10-16',2,1),(124,'2022-10-16',2,2),(125,'2022-10-16',2,3),(126,'2022-10-16',2,4),(127,'2022-10-16',2,5),(142,'2023-01-10',1,1),(143,'2023-01-10',2,1);
/*!40000 ALTER TABLE `consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drinktype`
--

DROP TABLE IF EXISTS `drinktype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drinktype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `size` int(11) NOT NULL,
  `is_coffee` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drinktype`
--

LOCK TABLES `drinktype` WRITE;
/*!40000 ALTER TABLE `drinktype` DISABLE KEYS */;
INSERT INTO `drinktype` VALUES (1,'Mléko',20,0),(2,'Espresso',7,1),(3,'Coffe',14,1),(4,'Long',14,1),(5,'Doppio+',21,1);
/*!40000 ALTER TABLE `drinktype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin'),(2,'CoffeeEnjoyer');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `drinktype_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`user_id`),
  KEY `drinktype_id` (`drinktype_id`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`),
  CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`drinktype_id`) REFERENCES `drinktype` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (1,2,1,1000,20);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Lukáš','Masopust','lm','mamradkafe',1),(2,'David','Remis','remis','mamradkaficko',1),(3,'Molič','Jan','molic','podoli',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-11  1:01:11
