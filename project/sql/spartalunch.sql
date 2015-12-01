CREATE DATABASE  IF NOT EXISTS `chi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chi`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: chi
-- ------------------------------------------------------
-- Server version	5.6.26-log

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
-- Table structure for table `availabilities`
--

DROP TABLE IF EXISTS `availabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `availabilities` (
  `userId` int(11) NOT NULL,
  `day` varchar(16) NOT NULL,
  `startTime` int(11) NOT NULL,
  `endTime` int(11) NOT NULL,
  PRIMARY KEY (`day`,`startTime`,`endTime`,`userId`),
  KEY `availabilities_userId_idx` (`userId`),
  CONSTRAINT `availabilities_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `availabilities`
--

LOCK TABLES `availabilities` WRITE;
/*!40000 ALTER TABLE `availabilities` DISABLE KEYS */;
INSERT INTO `availabilities` VALUES (1,'Monday',1,5),(1,'Tuesday',3,5),(2,'Tuesday',1,8),(2,'Wednesday',3,8),(3,'Monday',4,6),(3,'Wednesday',2,6),(4,'Thursday',3,5),(4,'Tuesday',3,5),(5,'Friday',4,8),(5,'Wednesday',2,3),(6,'Monday',7,9),(6,'Wednesday',1,3),(7,'Friday',1,3),(7,'Tuesday',5,9),(8,'Thursday',1,2),(8,'Wednesday',3,5),(9,'Thursday',1,3),(9,'Thursday',7,10),(10,'Friday',1,9),(10,'Monday',5,7),(11,'Monday',3,10),(11,'Tuesday',1,5),(12,'Tuesday',2,4),(12,'Wednesday',7,9);
/*!40000 ALTER TABLE `availabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(16) DEFAULT NULL,
  `lastName` varchar(16) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  CONSTRAINT `profiles_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Frank','Ciotto',60,'male'),(2,'Karen','Armentrout',46,'female'),(3,'Joan','Webber',24,'female'),(4,'David','Drury',55,'male'),(5,'Betty','Smith',21,'female'),(6,'Brenda','Martinelli',29,'female'),(7,'Steven','Booth',33,'male'),(8,'Lisa','Saenz',34,'female'),(9,'Joan','Webber',24,'female'),(10,'Rose','Holmes',37,'female'),(11,'Margarer','Meddars',30,'female'),(12,'Val','Curry',37,'male');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bandanagrizzled','pw'),(2,'grottystores','pw'),(3,'fibroidsforget','pw'),(4,'chinnose','pw'),(5,'woodchuckbeeping','pw'),(6,'sockplantar','pw'),(7,'hallhumanist','pw'),(8,'pufferfishbew','pw'),(9,'responsetrogle','pw'),(10,'disfiguredwatt','pw'),(11,'elitenebula','pw'),(12,'haybobbin','pw');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-30 16:52:18
