<?php
/**
 * User: xiaoge
 * At: 13-6-25 9:32
 * Email: abraham1@163.com
 */
$sql_arr = array(

"DROP TABLE IF EXISTS `active`;",

    "CREATE TABLE `active` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_name` varchar(25) NOT NULL,
  `begin_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `act_type` tinyint(4) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `chat`;",

"CREATE TABLE `chat` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `is_read` tinyint(4) DEFAULT '0',
  `content` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `notify`;",

    "CREATE TABLE `notify` (
  `notify_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `time` int(11) NOT NULL,
  `is_read` tinyint(4) DEFAULT '0',
  `content` varchar(300) DEFAULT NULL,
  `to_user_id` int(11) NOT NULL,
  PRIMARY KEY (`notify_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `photo`;",

    "CREATE TABLE `photo` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1477 DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `photo_view`;",

    "CREATE TABLE `photo_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view_time` int(11) DEFAULT NULL,
  `view_number` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `photo_vote`;",

    "CREATE TABLE `photo_vote` (
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `star`;",

    "CREATE TABLE `star` (
  `user_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `act_vote` int(11) NOT NULL DEFAULT '0',
  `act_view` int(11) NOT NULL DEFAULT '0',
  `act_score` int(11) NOT NULL DEFAULT '0',
  `poster_url` varchar(150) DEFAULT NULL,
  `user_name` varchar(25) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`act_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `user`;",

    "CREATE TABLE `user` (
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
  `follow_number` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  UNIQUE KEY `nick_name_UNIQUE` (`nick_name`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `user_active`;",

    "CREATE TABLE `user_active` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `user_fan`;",

    "CREATE TABLE `user_fan` (
  `user_id` int(11) NOT NULL,
  `fan_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`fan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `user_friend`;",

    "CREATE TABLE `user_friend` (
  `user_id_1` int(11) NOT NULL,
  `user_id_2` int(11) NOT NULL,
  PRIMARY KEY (`user_id_1`,`user_id_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `user_location`;",

    "CREATE TABLE `user_location` (
  `user_id` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `user_level` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `LOCATION` (`lng`,`lat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `user_view`;",

    "CREATE TABLE `user_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `view_id` int(11) NOT NULL,
  `view_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `video`;",

    "CREATE TABLE `video` (
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
  `video_name` varchar(25) NOT NULL,
  `poster_url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `video_view`;",

    "CREATE TABLE `video_view` (
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `view_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `video_vote`;",

    "CREATE TABLE `video_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;",

    "DROP TABLE IF EXISTS `news`;",

    "CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(150) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `tag` varchar(50) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;",

    "DROP FUNCTION IF EXISTS `GETDISTANCE`;",


    "CREATE FUNCTION `GETDISTANCE`(lat1 DOUBLE, lng1 DOUBLE, lat2 DOUBLE, lng2 DOUBLE) RETURNS double

READS SQL DATA

DETERMINISTIC

BEGIN

DECLARE RAD DOUBLE;

DECLARE EARTH_RADIUS DOUBLE DEFAULT 6378137;

DECLARE radLat1 DOUBLE;

DECLARE radLat2 DOUBLE;

DECLARE radLng1 DOUBLE;

DECLARE radLng2 DOUBLE;

DECLARE s DOUBLE;

SET RAD = PI() / 180.0;

SET radLat1 = lat1 * RAD;

SET radLat2 = lat2 * RAD;

SET radLng1 = lng1 * RAD;

SET radLng2 = lng2 * RAD;

SET s = 2*asin(sqrt(pow(sin((radLat1-radLat2)/2),2)+cos(radLat1)*cos(radLat2)*pow(sin((radLng1-radLng2)/2),2)))*EARTH_RADIUS;

#SET s = ACOS(COS(radLat1)*COS(radLat2)*COS(radLng1-radLng2)+SIN(radLat1)*SIN(radLat2))*EARTH_RADIUS;

SET s = ROUND(s * 10000) / 10000;

RETURN s;

END"


);