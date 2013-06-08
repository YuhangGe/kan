CREATE DATABASE  IF NOT EXISTS `kankan` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kankan`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: localhost    Database: kankan
-- ------------------------------------------------------
-- Server version	5.5.28-log

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
-- Table structure for table `active`
--

DROP TABLE IF EXISTS `active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_name` varchar(25) NOT NULL,
  `begin_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `act_type` tinyint(4) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active`
--

LOCK TABLES `active` WRITE;
/*!40000 ALTER TABLE `active` DISABLE KEYS */;
INSERT INTO `active` VALUES (1,'六一演出',1364774400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(2,'八一演出',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(3,'微电影招募',1364774400,1373846400,1,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(4,'那些花儿海选',1364774400,1373846400,2,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(5,'表演活动',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(6,'表演活动',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(7,'表演活动',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(8,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(9,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(10,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(11,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(12,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(13,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(14,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(15,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(16,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(17,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(18,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG','六一儿童节到了，童心不泯，快乐如初。'),(19,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(20,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(21,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(22,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(23,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(24,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(25,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(26,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(27,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(28,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(29,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(30,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(31,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(32,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(33,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(34,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(35,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(36,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(37,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(38,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL),(39,'test',1371254400,1373846400,0,'http://news.xinhuanet.com/photo/2013-06/02/124798999_441n.JPG',NULL);
/*!40000 ALTER TABLE `active` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `image_url` varchar(150) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `act_name` varchar(25) NOT NULL,
  `upload_time` int(11) NOT NULL,
  `thumb_url` varchar(150) NOT NULL,
  `view_number` int(11) DEFAULT '0',
  `vote_number` int(11) DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',4,1),(2,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',0,1),(3,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',2,1),(4,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',4,1),(5,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',0,0),(6,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',0,0),(7,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',0,0),(8,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',0,0),(9,1,4,'http://localhost:8090/photo/4/photo_137053417133.jpg','白羊座小葛','那些花儿海选',1370535786,'http://localhost:8090/photo/4/thumb_137053417133.png',0,0),(10,100,4,'http://localhost:8090/photo/4/image_100_1370572388120985.jpeg','菡萏','那些花儿海选',1370572534,'http://localhost:8090/photo/4/thumb_100_1370572388120985.jpeg',0,0),(11,100,4,'http://localhost:8090/photo/4/image_100_1370572387416754.jpeg','菡萏','那些花儿海选',1370572534,'http://localhost:8090/photo/4/thumb_100_1370572387416754.jpeg',0,0),(12,100,4,'http://localhost:8090/photo/4/image_100_1370572386953387.jpeg','菡萏','那些花儿海选',1370572630,'http://localhost:8090/photo/4/thumb_100_1370572386953387.jpeg',0,0),(13,100,4,'http://localhost:8090/photo/4/image_100_1370572385899213.jpeg','菡萏','那些花儿海选',1370572650,'http://localhost:8090/photo/4/thumb_100_1370572385899213.jpeg',0,0),(14,100,4,'http://localhost:8090/photo/4/image_100_1370572370502115.jpeg','菡萏','那些花儿海选',1370572655,'http://localhost:8090/photo/4/thumb_100_1370572370502115.jpeg',0,0),(15,100,3,'http://localhost:8090/photo/4/image_100_1370572370502115.jpeg','菡萏','那些花儿',1370572655,'http://localhost:8090/photo/4/thumb_100_1370572370502115.jpeg',0,0),(16,5,5,'http://localhost:8090/photo/4/image_100_1370572370502115.jpeg','test5','那些花儿',1370572630,'http://localhost:8090/photo/4/thumb_100_1370572370502115.jpeg',0,0),(17,6,4,'http://localhost:8090/photo/4/image_100_1370572370502115.jpeg','test6','那些花儿',1370673450,'http://localhost:8090/photo/4/thumb_100_1370572370502115.jpeg',0,0);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo_view`
--

DROP TABLE IF EXISTS `photo_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view_time` int(11) DEFAULT NULL,
  `view_number` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo_view`
--

LOCK TABLES `photo_view` WRITE;
/*!40000 ALTER TABLE `photo_view` DISABLE KEYS */;
INSERT INTO `photo_view` VALUES (1,1,1,1370664000,4),(2,4,1,1370664000,4),(3,3,1,1370664000,2);
/*!40000 ALTER TABLE `photo_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo_vote`
--

DROP TABLE IF EXISTS `photo_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_vote` (
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo_vote`
--

LOCK TABLES `photo_vote` WRITE;
/*!40000 ALTER TABLE `photo_vote` DISABLE KEYS */;
INSERT INTO `photo_vote` VALUES (1,1),(2,1),(3,1),(4,1);
/*!40000 ALTER TABLE `photo_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT '0',
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `nick_name` varchar(25) DEFAULT NULL,
  `real_name` varchar(10) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT '0',
  `constellation` tinyint(4) DEFAULT '0',
  `birthday` int(11) DEFAULT NULL,
  `personalsay` varchar(50) DEFAULT NULL,
  `company` varchar(35) DEFAULT NULL,
  `hobby` varchar(45) DEFAULT NULL,
  `big_avatar` varchar(150) DEFAULT NULL,
  `small_avatar` varchar(150) DEFAULT NULL,
  `image_server` varchar(100) DEFAULT NULL,
  `fan_number` int(11) DEFAULT '0',
  `friend_number` int(11) DEFAULT '0',
  `view_number` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  UNIQUE KEY `nick_name_UNIQUE` (`nick_name`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'abraham1@163.com','15195908816','5f33d6eabf3079dfe84e772bec4679c3','白羊座小葛',NULL,0,4,639014400,NULL,'中华人民共和国',NULL,'http://localhost:8090/avatar/large_1_1370536464751357.jpg','http://localhost:8090/avatar/small_1_1370536464751357.jpg','http://localhost:8089',0,0,0),(4,1,'k@k.com',NULL,'5f33d6eabf3079dfe84e772bec4679c3','kankan',NULL,0,0,670550400,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(5,1,'test1@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test1',NULL,0,0,607478400,NULL,'南京大学',NULL,NULL,NULL,'http://localhost:8089',0,0,0),(6,1,'test6@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test6',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(7,1,'test7@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test7',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(8,1,'test8@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test8',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(9,1,'test9@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test9',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(10,1,'test10@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test10',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(11,1,'test11@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test11',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(12,1,'test12@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test12',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(13,1,'test13@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test13',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(14,1,'test14@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test14',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(15,1,'test15@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test15',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(16,1,'test16@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test16',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(17,1,'test17@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test17',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(18,1,'test18@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test18',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(19,1,'test19@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test19',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(20,1,'test20@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test20',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(21,1,'test21@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test21',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(22,1,'test22@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test22',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(23,1,'test23@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test23',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(24,1,'test24@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test24',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(25,1,'test25@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test25',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(26,1,'test26@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test26',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(27,1,'test27@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test27',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(28,1,'test28@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test28',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(29,1,'test29@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test29',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(30,1,'test30@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test30',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(31,1,'test31@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test31',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(32,1,'test32@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test32',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(33,1,'test33@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test33',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(34,1,'test34@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test34',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(35,1,'test35@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test35',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(36,1,'test36@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test36',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(37,1,'test37@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test37',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(38,1,'test38@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test38',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(39,1,'test39@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test39',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(40,1,'test40@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test40',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(41,1,'test41@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test41',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(42,1,'test42@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test42',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(43,1,'test43@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test43',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(44,1,'test44@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test44',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(45,1,'test45@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test45',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(46,1,'test46@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test46',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(47,1,'test47@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test47',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(48,1,'test48@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test48',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(49,1,'test49@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test49',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(50,1,'test50@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test50',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(51,1,'test51@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test51',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(52,1,'test52@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test52',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(53,1,'test53@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test53',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(54,1,'test54@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test54',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(55,1,'test55@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test55',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(56,1,'test56@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test56',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(57,1,'test57@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test57',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(58,1,'test58@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test58',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(59,1,'test59@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test59',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(60,1,'test60@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test60',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(61,1,'test61@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test61',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(62,1,'test62@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test62',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(63,1,'test63@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test63',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(64,1,'test64@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test64',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(65,1,'test65@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test65',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(66,1,'test66@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test66',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(67,1,'test67@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test67',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(68,1,'test68@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test68',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(69,1,'test69@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test69',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(70,1,'test70@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test70',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(71,1,'test71@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test71',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(72,1,'test72@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test72',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(73,1,'test73@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test73',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(74,1,'test74@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test74',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(75,1,'test75@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test75',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(76,1,'test76@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test76',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(77,1,'test77@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test77',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(78,1,'test78@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test78',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(79,1,'test79@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test79',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(80,1,'test80@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test80',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(81,1,'test81@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test81',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(82,1,'test82@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test82',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(83,1,'test83@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test83',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(84,1,'test84@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test84',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(85,1,'test85@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test85',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(86,1,'test86@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test86',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(87,1,'test87@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test87',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(88,1,'test88@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test88',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(89,1,'test89@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test89',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(90,1,'test90@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test90',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(91,1,'test91@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test91',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(92,1,'test92@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test92',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(93,1,'test93@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test93',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(94,1,'test94@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test94',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(95,1,'test95@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test95',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(96,1,'test96@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test96',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(97,1,'test97@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test97',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(98,1,'test98@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test98',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(99,1,'test99@kankan.com',NULL,'0fe0b0138684873d1164d406f2b80d02','test99',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'http://localhost:8089',0,0,0),(100,1,'love@love.com',NULL,'5f33d6eabf3079dfe84e772bec4679c3','菡萏',NULL,1,0,NULL,NULL,NULL,NULL,'http://localhost:8090/avatar/large_100_1370571254323022.jpeg','http://localhost:8090/avatar/small_100_1370571254323022.jpg','http://localhost:8089',0,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_active`
--

DROP TABLE IF EXISTS `user_active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_active` (
  `user_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `photo_number` smallint(6) NOT NULL DEFAULT '0',
  `intro` varchar(300) DEFAULT NULL,
  `slogan` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`act_id`),
  KEY `act_id_idx` (`act_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `act_id` FOREIGN KEY (`act_id`) REFERENCES `active` (`act_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_active`
--

LOCK TABLES `user_active` WRITE;
/*!40000 ALTER TABLE `user_active` DISABLE KEYS */;
INSERT INTO `user_active` VALUES (1,4,9,NULL,'舍我其谁'),(1,5,0,NULL,NULL),(4,1,0,NULL,NULL),(7,1,0,NULL,NULL),(100,4,5,NULL,NULL);
/*!40000 ALTER TABLE `user_active` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_fan`
--

DROP TABLE IF EXISTS `user_fan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_fan` (
  `user_id` int(11) NOT NULL,
  `fan_id` int(11) NOT NULL,
  `fan_name` varchar(25) NOT NULL,
  `fan_avatar` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`fan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_fan`
--

LOCK TABLES `user_fan` WRITE;
/*!40000 ALTER TABLE `user_fan` DISABLE KEYS */;
INSERT INTO `user_fan` VALUES (1,4,'kankan',NULL),(1,6,'test6',NULL),(1,7,'test7',NULL),(1,8,'test8',NULL),(1,9,'test9',NULL),(1,10,'test10',NULL),(1,11,'test11',NULL),(1,12,'test12',NULL),(1,13,'test13',NULL),(1,14,'test14',NULL),(1,15,'test15',NULL),(1,16,'test16',NULL),(1,17,'test17',NULL),(1,18,'test18',NULL),(1,19,'test19',NULL),(1,20,'test20',NULL),(1,21,'test21',NULL),(1,22,'test22',NULL),(1,23,'test23',NULL),(1,24,'test24',NULL),(1,25,'test25',NULL),(1,26,'test26',NULL),(1,27,'test27',NULL),(1,28,'test28',NULL),(1,29,'test29',NULL),(1,30,'test30',NULL),(1,31,'test31',NULL),(1,32,'test32',NULL),(1,33,'test33',NULL),(1,34,'test34',NULL),(1,35,'test35',NULL),(1,36,'test36',NULL),(1,37,'test37',NULL),(1,38,'test38',NULL),(1,39,'test39',NULL),(1,40,'test40',NULL),(1,41,'test41',NULL),(1,42,'test42',NULL),(1,43,'test43',NULL),(1,44,'test44',NULL),(1,45,'test45',NULL),(1,46,'test46',NULL),(1,47,'test47',NULL),(1,48,'test48',NULL),(1,49,'test49',NULL),(1,50,'test50',NULL),(1,51,'test51',NULL),(1,52,'test52',NULL),(1,53,'test53',NULL),(1,54,'test54',NULL),(1,55,'test55',NULL),(1,56,'test56',NULL),(1,57,'test57',NULL),(1,58,'test58',NULL),(1,59,'test59',NULL),(1,60,'test60',NULL),(1,61,'test61',NULL),(1,62,'test62',NULL),(1,63,'test63',NULL),(1,64,'test64',NULL),(1,65,'test65',NULL),(1,66,'test66',NULL),(1,67,'test67',NULL),(1,68,'test68',NULL),(1,69,'test69',NULL),(1,70,'test70',NULL),(1,71,'test71',NULL),(1,72,'test72',NULL),(1,73,'test73',NULL),(1,74,'test74',NULL),(1,75,'test75',NULL),(1,76,'test76',NULL),(1,77,'test77',NULL),(1,78,'test78',NULL),(1,79,'test79',NULL),(1,80,'test80',NULL),(1,81,'test81',NULL),(1,82,'test82',NULL),(1,83,'test83',NULL),(1,84,'test84',NULL),(1,85,'test85',NULL),(1,86,'test86',NULL),(1,87,'test87',NULL),(1,88,'test88',NULL),(1,89,'test89',NULL),(100,1,'白羊座小葛','http://localhost:8090/avatar/small_1_1370536464751357.jpg');
/*!40000 ALTER TABLE `user_fan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_friend`
--

DROP TABLE IF EXISTS `user_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_friend` (
  `user_id_1` int(11) NOT NULL,
  `user_id_2` int(11) NOT NULL,
  `user_name_1` varchar(25) NOT NULL,
  `user_name_2` varchar(25) NOT NULL,
  `user_avatar_1` varchar(125) DEFAULT NULL,
  `user_avatar_2` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`user_id_1`,`user_id_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_friend`
--

LOCK TABLES `user_friend` WRITE;
/*!40000 ALTER TABLE `user_friend` DISABLE KEYS */;
INSERT INTO `user_friend` VALUES (1,4,'白羊座小葛','kankan','http://localhost:8090/avatar/small_1_1370536464751357.jpg',NULL),(1,100,'白羊座小葛','菡萏','http://localhost:8090/avatar/small_1_1370536464751357.jpg','http://localhost:8090/avatar/small_100_1370571254323022.jpg'),(4,11,'kankan','test11',NULL,NULL),(4,12,'kankan','test12',NULL,NULL),(4,13,'kankan','test13',NULL,NULL),(4,14,'kankan','test14',NULL,NULL),(4,15,'kankan','test15',NULL,NULL),(4,16,'kankan','test16',NULL,NULL),(4,17,'kankan','test17',NULL,NULL),(4,18,'kankan','test18',NULL,NULL),(4,19,'kankan','test19',NULL,NULL),(4,20,'kankan','test20',NULL,NULL),(4,21,'kankan','test21',NULL,NULL),(4,22,'kankan','test22',NULL,NULL),(4,23,'kankan','test23',NULL,NULL),(4,24,'kankan','test24',NULL,NULL),(4,25,'kankan','test25',NULL,NULL),(4,26,'kankan','test26',NULL,NULL),(4,27,'kankan','test27',NULL,NULL),(4,28,'kankan','test28',NULL,NULL),(4,29,'kankan','test29',NULL,NULL),(4,30,'kankan','test30',NULL,NULL),(4,31,'kankan','test31',NULL,NULL),(4,32,'kankan','test32',NULL,NULL),(4,33,'kankan','test33',NULL,NULL),(4,34,'kankan','test34',NULL,NULL),(4,35,'kankan','test35',NULL,NULL),(4,36,'kankan','test36',NULL,NULL),(4,37,'kankan','test37',NULL,NULL),(4,38,'kankan','test38',NULL,NULL),(4,39,'kankan','test39',NULL,NULL),(4,40,'kankan','test40',NULL,NULL),(4,41,'kankan','test41',NULL,NULL),(4,42,'kankan','test42',NULL,NULL),(4,43,'kankan','test43',NULL,NULL),(4,44,'kankan','test44',NULL,NULL),(4,45,'kankan','test45',NULL,NULL),(4,46,'kankan','test46',NULL,NULL),(4,47,'kankan','test47',NULL,NULL),(4,48,'kankan','test48',NULL,NULL),(4,49,'kankan','test49',NULL,NULL),(4,50,'kankan','test50',NULL,NULL),(4,51,'kankan','test51',NULL,NULL),(4,52,'kankan','test52',NULL,NULL),(4,53,'kankan','test53',NULL,NULL),(4,54,'kankan','test54',NULL,NULL),(4,55,'kankan','test55',NULL,NULL),(4,56,'kankan','test56',NULL,NULL),(4,57,'kankan','test57',NULL,NULL),(4,58,'kankan','test58',NULL,NULL),(4,59,'kankan','test59',NULL,NULL),(4,60,'kankan','test60',NULL,NULL),(4,61,'kankan','test61',NULL,NULL),(4,62,'kankan','test62',NULL,NULL),(4,63,'kankan','test63',NULL,NULL),(4,64,'kankan','test64',NULL,NULL),(4,65,'kankan','test65',NULL,NULL),(4,66,'kankan','test66',NULL,NULL),(4,67,'kankan','test67',NULL,NULL),(4,68,'kankan','test68',NULL,NULL),(4,69,'kankan','test69',NULL,NULL),(4,70,'kankan','test70',NULL,NULL),(4,71,'kankan','test71',NULL,NULL),(4,72,'kankan','test72',NULL,NULL),(4,73,'kankan','test73',NULL,NULL),(4,74,'kankan','test74',NULL,NULL),(4,75,'kankan','test75',NULL,NULL),(4,76,'kankan','test76',NULL,NULL),(4,77,'kankan','test77',NULL,NULL),(4,78,'kankan','test78',NULL,NULL),(4,79,'kankan','test79',NULL,NULL),(4,80,'kankan','test80',NULL,NULL),(4,81,'kankan','test81',NULL,NULL),(4,82,'kankan','test82',NULL,NULL),(4,83,'kankan','test83',NULL,NULL),(4,84,'kankan','test84',NULL,NULL),(4,85,'kankan','test85',NULL,NULL),(4,86,'kankan','test86',NULL,NULL),(4,87,'kankan','test87',NULL,NULL),(4,88,'kankan','test88',NULL,NULL),(4,89,'kankan','test89',NULL,NULL);
/*!40000 ALTER TABLE `user_friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_location`
--

DROP TABLE IF EXISTS `user_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_location` (
  `user_id` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `user_level` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `LOCATION` (`lng`,`lat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_location`
--

LOCK TABLES `user_location` WRITE;
/*!40000 ALTER TABLE `user_location` DISABLE KEYS */;
INSERT INTO `user_location` VALUES (1,1370574086,32.0508,118.783,'小粉桥',1),(4,1370076685,32.0508,118.783,'南京大学',1),(5,1370076685,32.0343,118.72,NULL,1),(6,1370076685,32.0723,118.81,NULL,1),(7,1370076685,NULL,NULL,NULL,1),(8,1370076685,NULL,NULL,NULL,1),(9,1370076685,NULL,NULL,NULL,1),(10,NULL,NULL,NULL,NULL,1),(11,NULL,NULL,NULL,NULL,1),(12,NULL,NULL,NULL,NULL,1),(13,NULL,NULL,NULL,NULL,1),(14,NULL,NULL,NULL,NULL,1),(15,NULL,NULL,NULL,NULL,1),(16,NULL,NULL,NULL,NULL,1),(17,NULL,NULL,NULL,NULL,1),(18,NULL,NULL,NULL,NULL,1),(19,NULL,NULL,NULL,NULL,1),(20,NULL,NULL,NULL,NULL,1),(21,NULL,NULL,NULL,NULL,1),(22,NULL,NULL,NULL,NULL,1),(23,NULL,NULL,NULL,NULL,1),(24,NULL,NULL,NULL,NULL,1),(25,NULL,NULL,NULL,NULL,1),(26,NULL,NULL,NULL,NULL,1),(27,NULL,NULL,NULL,NULL,1),(28,NULL,NULL,NULL,NULL,1),(29,NULL,NULL,NULL,NULL,1),(30,NULL,NULL,NULL,NULL,1),(31,NULL,NULL,NULL,NULL,1),(32,NULL,NULL,NULL,NULL,1),(33,NULL,NULL,NULL,NULL,1),(34,NULL,NULL,NULL,NULL,1),(35,NULL,NULL,NULL,NULL,1),(36,NULL,NULL,NULL,NULL,1),(37,NULL,NULL,NULL,NULL,1),(38,NULL,NULL,NULL,NULL,1),(39,NULL,NULL,NULL,NULL,1),(40,NULL,NULL,NULL,NULL,1),(41,NULL,NULL,NULL,NULL,1),(42,NULL,NULL,NULL,NULL,1),(43,NULL,NULL,NULL,NULL,1),(44,NULL,NULL,NULL,NULL,1),(45,NULL,NULL,NULL,NULL,1),(46,NULL,NULL,NULL,NULL,1),(47,NULL,NULL,NULL,NULL,1),(48,NULL,NULL,NULL,NULL,1),(49,NULL,NULL,NULL,NULL,1),(50,NULL,NULL,NULL,NULL,1),(51,NULL,NULL,NULL,NULL,1),(52,NULL,NULL,NULL,NULL,1),(53,NULL,NULL,NULL,NULL,1),(54,NULL,NULL,NULL,NULL,1),(55,NULL,NULL,NULL,NULL,1),(56,NULL,NULL,NULL,NULL,1),(57,NULL,NULL,NULL,NULL,1),(58,NULL,NULL,NULL,NULL,1),(59,NULL,NULL,NULL,NULL,1),(60,NULL,NULL,NULL,NULL,1),(61,NULL,NULL,NULL,NULL,1),(62,NULL,NULL,NULL,NULL,1),(63,NULL,NULL,NULL,NULL,1),(64,NULL,NULL,NULL,NULL,1),(65,NULL,NULL,NULL,NULL,1),(66,NULL,NULL,NULL,NULL,1),(67,NULL,NULL,NULL,NULL,1),(68,NULL,NULL,NULL,NULL,1),(69,NULL,NULL,NULL,NULL,1),(70,NULL,NULL,NULL,NULL,1),(71,NULL,NULL,NULL,NULL,1),(72,NULL,NULL,NULL,NULL,1),(73,NULL,NULL,NULL,NULL,1),(74,NULL,NULL,NULL,NULL,1),(75,NULL,NULL,NULL,NULL,1),(76,NULL,NULL,NULL,NULL,1),(77,NULL,NULL,NULL,NULL,1),(78,NULL,NULL,NULL,NULL,1),(79,NULL,NULL,NULL,NULL,1),(80,NULL,NULL,NULL,NULL,1),(81,NULL,NULL,NULL,NULL,1),(82,NULL,NULL,NULL,NULL,1),(83,NULL,NULL,NULL,NULL,1),(84,NULL,NULL,NULL,NULL,1),(85,NULL,NULL,NULL,NULL,1),(86,NULL,NULL,NULL,NULL,1),(87,NULL,NULL,NULL,NULL,1),(88,NULL,NULL,NULL,NULL,1),(89,NULL,NULL,NULL,NULL,1),(90,NULL,NULL,NULL,NULL,1),(91,NULL,NULL,NULL,NULL,1),(92,NULL,NULL,NULL,NULL,1),(93,NULL,NULL,NULL,NULL,1),(94,NULL,NULL,NULL,NULL,1),(95,NULL,NULL,NULL,NULL,1),(96,NULL,NULL,NULL,NULL,1),(97,NULL,NULL,NULL,NULL,1),(98,NULL,NULL,NULL,NULL,1),(99,NULL,NULL,NULL,NULL,1),(100,1370573998,32.0542,118.781,'南京大学',1);
/*!40000 ALTER TABLE `user_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_view`
--

DROP TABLE IF EXISTS `user_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `view_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_view`
--

LOCK TABLES `user_view` WRITE;
/*!40000 ALTER TABLE `user_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `big_url` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `act_name` varchar(25) NOT NULL,
  `upload_time` int(11) NOT NULL,
  `vote_number` int(11) DEFAULT '0',
  `view_number` int(11) DEFAULT '0',
  `small_url` varchar(150) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_view`
--

DROP TABLE IF EXISTS `video_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_view` (
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `view_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_view`
--

LOCK TABLES `video_view` WRITE;
/*!40000 ALTER TABLE `video_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_vote`
--

DROP TABLE IF EXISTS `video_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_vote`
--

LOCK TABLES `video_vote` WRITE;
/*!40000 ALTER TABLE `video_vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_vote` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-08 23:20:33
