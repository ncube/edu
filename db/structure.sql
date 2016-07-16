CREATE DATABASE  IF NOT EXISTS `edu` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `edu`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: edu
-- ------------------------------------------------------
-- Server version	5.7.13

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
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` varchar(32) DEFAULT NULL,
  `user_id` varchar(32) NOT NULL,
  `content` text,
  `status` tinyint(1) DEFAULT '0',
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`a_id`,`user_id`),
  KEY `fk_answer_user1_idx` (`user_id`),
  CONSTRAINT `fk_answer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `post_id` varchar(32) NOT NULL,
  `content` text,
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`comment_id`,`user_id`),
  KEY `fk_comment_user1_idx` (`user_id`),
  CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `difficulty`
--

DROP TABLE IF EXISTS `difficulty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `difficulty` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` varchar(32) DEFAULT NULL,
  `user_id` varchar(32) NOT NULL,
  `level` int(2) DEFAULT NULL,
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`d_id`,`user_id`),
  KEY `fk_difficulty_user1_idx` (`user_id`),
  CONSTRAINT `fk_difficulty_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow` (
  `follow_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `following_id` varchar(32) NOT NULL,
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`follow_id`,`user_id`,`following_id`),
  KEY `fk_follow_users_idx` (`user_id`),
  KEY `fk_follow_users1_idx` (`following_id`),
  CONSTRAINT `fk_follow_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_follow_users1` FOREIGN KEY (`following_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `group_id` varchar(32) NOT NULL,
  `group_name` varchar(45) DEFAULT NULL,
  `desp` text NOT NULL,
  `group_pic` text NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group_post`
--

DROP TABLE IF EXISTS `group_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_post` (
  `primary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_primary_id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `group_id` varchar(32) NOT NULL,
  `post_id` varchar(45) DEFAULT NULL,
  `post_data` varchar(1000) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`primary_id`,`user_primary_id`,`user_id`,`group_id`),
  KEY `fk_group_post_group_user1_idx` (`user_primary_id`,`user_id`,`group_id`),
  CONSTRAINT `fk_group_post_group_user1` FOREIGN KEY (`user_primary_id`, `user_id`, `group_id`) REFERENCES `group_user` (`primary_id`, `user_id`, `group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group_user`
--

DROP TABLE IF EXISTS `group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_user` (
  `primary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `group_id` varchar(32) NOT NULL,
  `type` varchar(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`primary_id`,`user_id`,`group_id`),
  KEY `fk_group_users_user1_idx` (`user_id`),
  KEY `fk_group_users_group1_idx` (`group_id`),
  CONSTRAINT `fk_group_users_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_users_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msg`
--

DROP TABLE IF EXISTS `msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg` (
  `msg_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `from_id` varchar(32) NOT NULL,
  `to_id` varchar(32) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `time` bigint(10) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`,`from_id`,`to_id`),
  KEY `fk_msg_users1_idx` (`from_id`),
  KEY `fk_msg_users2_idx` (`to_id`),
  CONSTRAINT `fk_msg_users1` FOREIGN KEY (`from_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_msg_users2` FOREIGN KEY (`to_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msg_notif`
--

DROP TABLE IF EXISTS `msg_notif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_notif` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `to_id` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `time` bigint(10) NOT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `to_id` varchar(32) NOT NULL,
  `type` varchar(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `time` bigint(10) NOT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `post_data` varchar(1000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`post_id`,`user_id`),
  KEY `fk_post_user1_idx` (`user_id`),
  CONSTRAINT `fk_post_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `q_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `title` text,
  `content` text,
  `difficulty` int(2) DEFAULT NULL,
  `views` int(11) NOT NULL,
  `public` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`q_id`,`user_id`),
  KEY `fk_questions_user1_idx` (`user_id`),
  CONSTRAINT `fk_questions_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `request_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(32) NOT NULL,
  `other_user_id` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(1) NOT NULL,
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`request_id`,`user_id`,`other_user_id`),
  KEY `fk_relation_users3_idx` (`user_id`),
  KEY `fk_relation_users4_idx` (`other_user_id`),
  CONSTRAINT `fk_relation_users3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relation_users4` FOREIGN KEY (`other_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` varchar(32) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `country` varchar(5) NOT NULL,
  `profile_pic` varchar(32) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` varchar(32) DEFAULT NULL,
  `user_id` varchar(32) NOT NULL,
  `vote` tinyint(1) DEFAULT NULL,
  `time` bigint(10) DEFAULT NULL,
  PRIMARY KEY (`vote_id`,`user_id`),
  KEY `fk_vote_user1_idx` (`user_id`),
  CONSTRAINT `fk_vote_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-15 19:38:14
