# Host: 127.0.0.1  (Version: 5.5.44)
# Date: 2015-08-31 07:14:27
# Generator: MySQL-Front 5.3  (Build 4.43)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "message"
#

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

#
# Data for table "message"
#

INSERT INTO `message` VALUES (2,'root','111'),(3,'test','4444'),(4,'test','hello'),(5,'test','helloo'),(6,'test','test'),(7,'test','tteesstt'),(22,'root','ddd'),(23,'root','hhhh'),(24,'root','aaa'),(25,'root','hello'),(26,'root','fff'),(27,'root','hello'),(28,'hello','nihao '),(29,'hello','hhh'),(30,'hello','jjj'),(56,'root','你今天吃饭了吗'),(57,'aaa','我吃饭了'),(58,'bb','ttt'),(59,'xiao','dd'),(60,'root','dd'),(61,'root','rrr');

#
# Structure for table "onlineuser"
#

DROP TABLE IF EXISTS `onlineuser`;
CREATE TABLE `onlineuser` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5326 DEFAULT CHARSET=utf8;

#
# Data for table "onlineuser"
#

INSERT INTO `onlineuser` VALUES (1,'bb');

#
# Structure for table "t_user"
#

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "t_user"
#

INSERT INTO `t_user` VALUES (2,'root','root','542146682@qq.com'),(5,'beyondwebcn','abc1','abc1'),(6,'abc2','ab2','ab2'),(8,'hello','hello','767'),(9,'xiao','xiao','123'),(10,'xiao','xiao','hua'),(11,'aaa','aaa','aaa'),(12,'bb','bb','bb');
