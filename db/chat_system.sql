CREATE DATABASE  IF NOT EXISTS `chat_system` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chat_system`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: chat_system
-- ------------------------------------------------------
-- Server version	5.7.30-log

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
-- Table structure for table `tbl_chat`
--

DROP TABLE IF EXISTS `tbl_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_chat` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `SenderID` int(11) NOT NULL,
  `RecieverID` int(11) NOT NULL,
  `Msg` varchar(500) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_chat`
--

LOCK TABLES `tbl_chat` WRITE;
/*!40000 ALTER TABLE `tbl_chat` DISABLE KEYS */;
INSERT INTO `tbl_chat` VALUES (1,1,3,'HI JHAY','2020-09-18 14:10:29'),(2,3,1,'hELLOW','2020-09-18 14:10:43'),(3,1,3,'Okay kalang?','2020-09-18 14:11:00'),(4,3,1,'Oo nman','2020-09-18 14:11:09'),(5,1,3,'gawa mo?','2020-09-18 14:21:02'),(6,1,3,'dsds','2020-09-18 14:21:21'),(7,3,1,'wow','2020-09-18 14:21:46'),(8,3,4,'hiii jet','2020-09-18 14:24:15'),(9,3,1,'hiii  ulit jhay','2020-09-18 14:24:32'),(10,1,3,'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.','2020-09-18 14:26:58'),(11,1,3,'hmmm','2020-09-18 14:32:45'),(12,1,3,'galing ah','2020-09-18 14:58:33');
/*!40000 ALTER TABLE `tbl_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(145) NOT NULL,
  `Password` varchar(345) NOT NULL,
  `CreateAt` date NOT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'test','098f6bcd4621d373cade4e832627b4f6','2020-09-18'),(2,'test','098f6bcd4621d373cade4e832627b4f6','2020-09-18'),(3,'JHAY','105ed89136a57383022fa3e3b69bde04','2020-09-18'),(4,'JET','564f60a2dd82ea24bfa3f2f615348f7c','2020-09-18');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-18 21:04:29
