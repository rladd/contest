-- MySQL dump 10.13  Distrib 5.5.9, for osx10.4 (i386)
--
-- Host: localhost    Database: trail_contest
-- ------------------------------------------------------
-- Server version	5.5.9

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
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `strFirstName` varchar(40) NOT NULL,
  `strLastName` varchar(40) NOT NULL,
  `strPhone` varchar(20) NOT NULL,
  `strEmail` varchar(40) NOT NULL,
  `strStreet` varchar(80) NOT NULL,
  `strCity` varchar(80) NOT NULL,
  `strPostal` varchar(20) NOT NULL,
  `fynAgree` tinyint(1) NOT NULL,
  `fynOffer` tinyint(1) NOT NULL,
  `timestamp` varchar(12) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `contestId` varchar(80) NOT NULL,
  `strReferralUrl` varchar(252) NOT NULL,
  `resultId` int(11) NOT NULL,
  PRIMARY KEY (`resultId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES ('Oscar','Thegrouch','604-333-2222','oscar@there.com','333 Sesame','TV','v3w1p9',1,1,'1307460279','127.0.0.1','appliance_sweepstakes','referral not found',0);
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-06-07  8:25:30
