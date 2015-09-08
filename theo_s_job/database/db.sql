-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: chatroom
-- ------------------------------------------------------
-- Server version	5.5.16-log

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
-- Table structure for table `cr_acl`
--

DROP TABLE IF EXISTS `cr_acl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cr_acl` (
  `idcr_acl` int(11) NOT NULL,
  `cr_aclbadge` char(5) NOT NULL,
  `cr_acldes` text,
  PRIMARY KEY (`idcr_acl`),
  UNIQUE KEY `cr_aclbadge_UNIQUE` (`cr_aclbadge`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cr_acl`
--

LOCK TABLES `cr_acl` WRITE;
/*!40000 ALTER TABLE `cr_acl` DISABLE KEYS */;
INSERT INTO `cr_acl` VALUES (1,'ADMIN','User can use admin functions');
/*!40000 ALTER TABLE `cr_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cr_user`
--

DROP TABLE IF EXISTS `cr_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cr_user` (
  `idcr_user` int(11) NOT NULL AUTO_INCREMENT,
  `cr_username` varchar(255) NOT NULL,
  `cr_useremail` varchar(255) NOT NULL,
  `cr_userpass` char(32) NOT NULL,
  `cr_userlomd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcr_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cr_user`
--

LOCK TABLES `cr_user` WRITE;
/*!40000 ALTER TABLE `cr_user` DISABLE KEYS */;
INSERT INTO `cr_user` VALUES (1,'Theo Wang','theo.wang@cn.ibm.com','1f12a0699577470c3df1dee74ebe5f66','2015-08-26 08:26:09'),(2,'Xin Hui Wang','xhwangdl@cn.ibm.com','1f12a0699577470c3df1dee74ebe5f66','2015-08-26 09:07:56'),(3,'Sam','smartwxh@gmail.com','1f12a0699577470c3df1dee74ebe5f66','2015-08-28 06:25:31');
/*!40000 ALTER TABLE `cr_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cr_usertoacl`
--

DROP TABLE IF EXISTS `cr_usertoacl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cr_usertoacl` (
  `cr_userid` int(11) NOT NULL,
  `cr_aclid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cr_usertoacl`
--

LOCK TABLES `cr_usertoacl` WRITE;
/*!40000 ALTER TABLE `cr_usertoacl` DISABLE KEYS */;
INSERT INTO `cr_usertoacl` VALUES (1,1);
/*!40000 ALTER TABLE `cr_usertoacl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-08 17:01:24
