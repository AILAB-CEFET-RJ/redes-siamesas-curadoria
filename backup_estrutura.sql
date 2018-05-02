-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: imagenet
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `annotation`
--

DROP TABLE IF EXISTS `annotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annotation` (
  `img_id` varchar(25) NOT NULL,
  `wnid` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `attrs` varchar(255) DEFAULT NULL,
  `md5` varchar(50) DEFAULT NULL,
  `is_valid` int(11) DEFAULT '0',
  `dataset_source` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`img_id`),
  KEY `annotation_wnid_index` (`wnid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bound_box`
--

DROP TABLE IF EXISTS `bound_box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bound_box` (
  `img_id` varchar(25) NOT NULL,
  `x1` double(20,20) NOT NULL,
  `x2` double(20,20) NOT NULL,
  `y1` double(20,20) NOT NULL,
  `y2` double(20,20) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `img_match`
--

DROP TABLE IF EXISTS `img_match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_match` (
  `vqa_img_id` varchar(25) NOT NULL,
  `imagenet_img_id` varchar(25) NOT NULL,
  PRIMARY KEY (`vqa_img_id`,`imagenet_img_id`),
  KEY `imagenet_img_id` (`imagenet_img_id`),
  KEY `vqa_img_id` (`vqa_img_id`),
  CONSTRAINT `img_match_ibfk_1` FOREIGN KEY (`vqa_img_id`) REFERENCES `annotation` (`img_id`),
  CONSTRAINT `img_match_ibfk_2` FOREIGN KEY (`imagenet_img_id`) REFERENCES `annotation` (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_id` varchar(25) NOT NULL,
  `statement` varchar(5000) NOT NULL,
  `answer` varchar(45) NOT NULL DEFAULT '',
  `question_id` varchar(45) DEFAULT NULL,
  `question_type` varchar(45) DEFAULT NULL,
  `answer_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `img_id` (`img_id`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `annotation` (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `question_curation`
--

DROP TABLE IF EXISTS `question_curation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_curation` (
  `vqa_img_id` varchar(25) NOT NULL,
  `imagenet_img_id` varchar(25) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(45) DEFAULT '',
  `applicable` tinyint(1) NOT NULL,
  PRIMARY KEY (`vqa_img_id`,`imagenet_img_id`,`usuario_id`,`question_id`),
  KEY `vqa_img_id` (`vqa_img_id`),
  KEY `imagenet_img_id` (`imagenet_img_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `question_curation_fk` FOREIGN KEY (`vqa_img_id`) REFERENCES `user_curation` (`vqa_img_id`),
  CONSTRAINT `question_curation_fk1` FOREIGN KEY (`imagenet_img_id`) REFERENCES `user_curation` (`imagenet_img_id`),
  CONSTRAINT `question_curation_fk2` FOREIGN KEY (`usuario_id`) REFERENCES `user_curation` (`usuario_id`),
  CONSTRAINT `question_curation_fk3` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `synset`
--

DROP TABLE IF EXISTS `synset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `synset` (
  `wnid` varchar(30) NOT NULL,
  `words` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`wnid`),
  UNIQUE KEY `wnid` (`wnid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training` (
  `img_id` varchar(25) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `test_data` int(10) unsigned zerofill DEFAULT NULL,
  `dataset_source` varchar(100) NOT NULL,
  PRIMARY KEY (`img_id`),
  UNIQUE KEY `img_id_UNIQUE` (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_curation`
--

DROP TABLE IF EXISTS `user_curation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_curation` (
  `vqa_img_id` varchar(25) NOT NULL,
  `imagenet_img_id` varchar(25) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curation` tinyint(1) NOT NULL,
  PRIMARY KEY (`vqa_img_id`,`imagenet_img_id`,`usuario_id`),
  KEY `vqa_img_id` (`vqa_img_id`),
  KEY `imagenet_img_id` (`imagenet_img_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `user_curation_fk` FOREIGN KEY (`vqa_img_id`) REFERENCES `img_match` (`vqa_img_id`),
  CONSTRAINT `user_curation_fk1` FOREIGN KEY (`imagenet_img_id`) REFERENCES `img_match` (`imagenet_img_id`),
  CONSTRAINT `user_curation_fk2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` varchar(100) NOT NULL,
  `data_ultimo_login` datetime DEFAULT NULL,
  `admin` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vqa_categories`
--

DROP TABLE IF EXISTS `vqa_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vqa_categories` (
  `category_id` int(11) NOT NULL,
  `label` varchar(45) NOT NULL,
  `supercategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vqa_images`
--

DROP TABLE IF EXISTS `vqa_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vqa_images` (
  `id` varchar(45) NOT NULL,
  `image_id` varchar(45) DEFAULT NULL,
  `category_id` varchar(45) DEFAULT NULL,
  `filename` varchar(45) DEFAULT NULL,
  `bound_box` varchar(45) DEFAULT NULL,
  `data_split` varchar(45) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vqa_images_backup`
--

DROP TABLE IF EXISTS `vqa_images_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vqa_images_backup` (
  `id` varchar(45) NOT NULL DEFAULT '',
  `image_id` varchar(45) DEFAULT NULL,
  `category_id` varchar(45) DEFAULT NULL,
  `filename` varchar(45) DEFAULT NULL,
  `bound_box` varchar(45) DEFAULT NULL,
  `data_split` varchar(45) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-30  1:52:18
