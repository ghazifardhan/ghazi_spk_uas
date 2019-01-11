-- MySQL dump 10.13  Distrib 5.7.24, for osx10.12 (x86_64)
--
-- Host: localhost    Database: ghazi_spk_wp
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Create Database `ghazi_spk_wp`
--
CREATE DATABASE `ghazi_spk_wp`;
USE `ghazi_spk_wp`;
--
-- Table structure for table `alternatif`
--

DROP TABLE IF EXISTS `alternatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternatif` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alternatif` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatif`
--

-- LOCK TABLES `ghazi_spk_wpalternatif` WRITE;
/*!40000 ALTER TABLE `alternatif` DISABLE KEYS */;
INSERT INTO `alternatif` VALUES (1,'Lucy','2019-01-06 20:19:03','2019-01-10 20:40:25'),(2,'Jim','2019-01-06 20:24:04','2019-01-10 20:40:31'),(3,'Kenneth','2019-01-09 03:34:24','2019-01-10 20:40:34'),(4,'Everett','2019-01-10 20:40:45','2019-01-10 20:40:45'),(5,'Bryan','2019-01-10 20:40:48','2019-01-10 20:40:48'),(6,'Grace','2019-01-10 20:40:53','2019-01-10 20:40:53'),(7,'Lester','2019-01-10 20:40:56','2019-01-10 20:40:56'),(8,'Ida','2019-01-10 20:41:00','2019-01-10 20:41:00'),(9,'Pauline','2019-01-10 20:41:04','2019-01-10 20:41:04'),(10,'Debia','2019-01-10 20:41:10','2019-01-10 20:41:10');
/*!40000 ALTER TABLE `alternatif` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `alternatif_to_kriteria`
--

DROP TABLE IF EXISTS `alternatif_to_kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternatif_to_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alternatif_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatif_to_kriteria`
--

-- LOCK TABLES `alternatif_to_kriteria` WRITE;
/*!40000 ALTER TABLE `alternatif_to_kriteria` DISABLE KEYS */;
INSERT INTO `alternatif_to_kriteria` VALUES (1,1,1,4,'2019-01-10 20:42:23','2019-01-10 20:42:23'),(2,1,2,32.94,'2019-01-10 20:42:23','2019-01-10 20:42:23'),(3,1,3,85.75,'2019-01-10 20:42:23','2019-01-10 20:42:23'),(4,1,4,3,'2019-01-10 20:42:23','2019-01-10 20:42:23'),(5,1,5,2,'2019-01-10 20:42:23','2019-01-10 20:42:23'),(6,2,1,3,'2019-01-10 20:42:40','2019-01-10 20:42:40'),(7,2,2,38.2,'2019-01-10 20:42:40','2019-01-10 20:42:40'),(8,2,3,51.58,'2019-01-10 20:42:40','2019-01-10 20:42:40'),(9,2,4,1,'2019-01-10 20:42:40','2019-01-10 20:42:40'),(10,2,5,3,'2019-01-10 20:42:40','2019-01-10 20:42:40'),(11,3,1,1,'2019-01-10 20:42:52','2019-01-10 20:42:52'),(12,3,2,22.44,'2019-01-10 20:42:52','2019-01-10 20:42:52'),(13,3,3,92.97,'2019-01-10 20:42:52','2019-01-10 20:42:52'),(14,3,4,3,'2019-01-10 20:42:52','2019-01-10 20:42:52'),(15,3,5,3,'2019-01-10 20:42:52','2019-01-10 20:42:52'),(16,4,1,2,'2019-01-10 20:43:06','2019-01-10 20:43:06'),(17,4,2,21.8,'2019-01-10 20:43:06','2019-01-10 20:43:06'),(18,4,3,81.49,'2019-01-10 20:43:06','2019-01-10 20:43:06'),(19,4,4,3,'2019-01-10 20:43:06','2019-01-10 20:43:06'),(20,4,5,4,'2019-01-10 20:43:06','2019-01-10 20:43:06'),(21,5,1,4,'2019-01-10 20:43:19','2019-01-10 20:43:19'),(22,5,2,21.52,'2019-01-10 20:43:19','2019-01-10 20:43:19'),(23,5,3,88.66,'2019-01-10 20:43:19','2019-01-10 20:43:19'),(24,5,4,1,'2019-01-10 20:43:19','2019-01-10 20:43:19'),(25,5,5,4,'2019-01-10 20:43:19','2019-01-10 20:43:19'),(26,6,1,1,'2019-01-10 20:43:34','2019-01-10 20:43:34'),(27,6,2,27.63,'2019-01-10 20:43:34','2019-01-10 20:43:34'),(28,6,3,87,'2019-01-10 20:43:34','2019-01-10 20:43:34'),(29,6,4,3,'2019-01-10 20:43:34','2019-01-10 20:43:34'),(30,6,5,1,'2019-01-10 20:43:34','2019-01-10 20:43:34'),(31,7,1,2,'2019-01-10 20:43:47','2019-01-10 20:43:47'),(32,7,2,30.51,'2019-01-10 20:43:47','2019-01-10 20:43:47'),(33,7,3,71.92,'2019-01-10 20:43:47','2019-01-10 20:43:47'),(34,7,4,3,'2019-01-10 20:43:47','2019-01-10 20:43:47'),(35,7,5,3,'2019-01-10 20:43:47','2019-01-10 20:43:47'),(36,8,1,1,'2019-01-10 20:44:02','2019-01-10 20:44:02'),(37,8,2,23.95,'2019-01-10 20:44:02','2019-01-10 20:44:02'),(38,8,3,67.04,'2019-01-10 20:44:02','2019-01-10 20:44:02'),(39,8,4,3,'2019-01-10 20:44:02','2019-01-10 20:44:02'),(40,8,5,5,'2019-01-10 20:44:02','2019-01-10 20:44:02'),(41,9,1,4,'2019-01-10 20:44:14','2019-01-10 20:44:14'),(42,9,2,20.47,'2019-01-10 20:44:14','2019-01-10 20:44:14'),(43,9,3,83.99,'2019-01-10 20:44:14','2019-01-10 20:44:14'),(44,9,4,3,'2019-01-10 20:44:14','2019-01-10 20:44:14'),(45,9,5,3,'2019-01-10 20:44:14','2019-01-10 20:44:14'),(46,10,1,1,'2019-01-10 20:44:28','2019-01-10 20:44:28'),(47,10,2,36.97,'2019-01-10 20:44:28','2019-01-10 20:44:28'),(48,10,3,54.4,'2019-01-10 20:44:28','2019-01-10 20:44:28'),(49,10,4,2,'2019-01-10 20:44:28','2019-01-10 20:44:28'),(50,10,5,4,'2019-01-10 20:44:28','2019-01-10 20:44:28');
/*!40000 ALTER TABLE `alternatif_to_kriteria` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(100) NOT NULL,
  `bobot` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `atribut` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

-- LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (1,'Jurusan Pendidikan Terakhir',20,'2019-01-06 21:13:47','2019-01-10 20:40:02','benefit'),(2,'Nilai UN (Rata-rata)',20,'2019-01-06 21:14:35','2019-01-10 20:40:09','benefit'),(3,'Tes Potensi Akademik',35,'2019-01-06 21:14:45','2019-01-10 20:40:15','benefit'),(4,'Tes Kesehatan',15,'2019-01-10 20:39:45','2019-01-10 20:39:45','benefit'),(5,'Tes Wawancara',10,'2019-01-10 20:39:54','2019-01-10 20:39:54','benefit');
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

-- LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2a$15$gWdzEBHhUQWOuxwyi2Gf2uF4k9dNJfTzQguAS/4yGTvWBqWqmZI2q','2019-01-06 07:59:20','2019-01-06 07:59:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
-- UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-11 21:29:13
