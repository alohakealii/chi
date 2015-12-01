CREATE DATABASE  IF NOT EXISTS `spartalunch` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `spartalunch`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: spartalunch
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
-- Table structure for table `availability`
--

DROP TABLE IF EXISTS `availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `availability` (
  `userID` int(11) NOT NULL,
  `dayslot` varchar(45) NOT NULL,
  PRIMARY KEY (`userID`,`dayslot`),
  KEY `availability_userID_idx` (`userID`),
  KEY `availability_dayslot_idx` (`dayslot`),
  CONSTRAINT `availability_userID` FOREIGN KEY (`userID`) REFERENCES `login` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `availability`
--

LOCK TABLES `availability` WRITE;
/*!40000 ALTER TABLE `availability` DISABLE KEYS */;
/*!40000 ALTER TABLE `availability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interest`
--

DROP TABLE IF EXISTS `interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interest` (
  `userID` int(11) NOT NULL,
  `subject` varchar(45) NOT NULL,
  PRIMARY KEY (`userID`,`subject`),
  CONSTRAINT `interest` FOREIGN KEY (`userID`) REFERENCES `login` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interest`
--

LOCK TABLES `interest` WRITE;
/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `locationID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `imgPath` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'quickly','/chi/project/images/quickly.jpg'),(2,'360 Grill','/chi/project/images/360grill.jpg'),(3,'Amor Cafe and Tea','/chi/project/images/amorcafetea.jpg'),(4,'Bricks Pizza and Pasta','/chi/project/images/brickspizzapasta.jpg'),(5,'In the Mix','/chi/project/images/inthemix.jpg'),(6,'Jamba Juice','/chi/project/images/jambajuice.jpg'),(7,'La Victoria','/chi/project/images/lavictorias.jpg'),(8,'Leboulanger','/chi/project/images/leboulanger.jpg'),(9,'Mojo Burger','/chi/project/images/mojoburger.jpg'),(10,'Original Gravity','/chi/project/images/originalgravity.jpg'),(11,'Panda Express','/chi/project/images/pandaexpress.jpg'),(12,'Peanuts','/chi/project/images/peanuts.jpg'),(13,'Philz Coffee','/chi/project/images/philz.png'),(14,'San Pedro Square','/chi/project/images/sanpedrosquare.jpg'),(15,'Taco Bell','/chi/project/images/tacobell.jpg'),(16,'Waffle Coop','/chi/project/images/wafflecoop.jpg'),(17,'Whispers','/chi/project/images/whispers.jpg');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (25,'tcruise','tcruise'),(26,'dkong','dkong'),(27,'mlamb','mlamb');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `dayslot` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`senderID`),
  KEY `notification_dayslot_idx` (`dayslot`),
  KEY `notification_receiverID_idx` (`receiverID`),
  CONSTRAINT `notification_dayslot` FOREIGN KEY (`dayslot`) REFERENCES `availability` (`dayslot`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_receiverID` FOREIGN KEY (`receiverID`) REFERENCES `login` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notification_senderID` FOREIGN KEY (`senderID`) REFERENCES `login` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  CONSTRAINT `profile_userID` FOREIGN KEY (`userID`) REFERENCES `login` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (25,'Tom','Cruise','40','Male ','','tcruise@gmail.com'),(26,'Donkey','Kong',NULL,NULL,NULL,'dkong@gmail.com'),(27,'Mary','Lamb','21','Female ','I have a lamb','mlamb@gmail.com');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `dayslot` varchar(45) NOT NULL,
  `comment` varchar(45) DEFAULT 'Pending',
  `status` varchar(45) DEFAULT 'Pending',
  PRIMARY KEY (`senderID`,`receiverID`,`dayslot`),
  KEY `availability_receiverID_idx` (`receiverID`),
  KEY `request_dayslot_idx` (`dayslot`),
  CONSTRAINT `request_dayslot` FOREIGN KEY (`dayslot`) REFERENCES `availability` (`dayslot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `request_receiverID` FOREIGN KEY (`receiverID`) REFERENCES `login` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `request_senderID` FOREIGN KEY (`senderID`) REFERENCES `login` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-01 11:25:32
