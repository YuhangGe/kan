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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active`
--

LOCK TABLES `active` WRITE;
/*!40000 ALTER TABLE `active` DISABLE KEYS */;
INSERT INTO `active` VALUES (1,'六一演出',1364774400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(2,'八一演出',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(3,'微电影招募',1364774400,1373846400,1,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(4,'那些花儿海选',1364774400,1377619254,2,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(5,'表演活动',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(6,'表演活动',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(7,'表演活动',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(8,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(9,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(10,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(11,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(12,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(13,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(14,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(15,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(16,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(17,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(18,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','六一儿童节到了，童心不泯，快乐如初。'),(19,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(20,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(21,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(22,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(23,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(24,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(25,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(26,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(27,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(28,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(29,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(30,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(31,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(32,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(33,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(34,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(35,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(36,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(37,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(38,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(39,'test',1371254400,1373846400,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg',NULL),(40,'good',1371052800,1372435200,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','dsdsd'),(41,'测试一下下啦',1371052800,1372521600,1,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','你是我心爱的姑娘-汪峰'),(42,'新活动',1371052800,1374076800,1,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','在所有人是已非的景色里我最喜欢你。'),(43,'活动来啰',1371312000,1377619200,0,'http://shoujixuanxiu.com/upload/image/act_1372232963978638.jpg','测试一下下');
/*!40000 ALTER TABLE `active` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-26 16:17:28
