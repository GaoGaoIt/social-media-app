-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: eventswave
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `Admin_ID` int NOT NULL AUTO_INCREMENT,
  `User_Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `COMMENT_ID` int NOT NULL AUTO_INCREMENT,
  `POST_ID` int NOT NULL,
  `USER_ID` int NOT NULL,
  `COMMENT` text NOT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`COMMENT_ID`),
  KEY `POST_ID` (`POST_ID`),
  KEY `USER_ID` (`USER_ID`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`POST_ID`) REFERENCES `posts` (`Post_ID`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,2,'fvdvfdv','2023-11-20 09:03:59'),(2,3,1,'fgfgfgfdgfgdgf','2023-11-21 08:17:13'),(3,3,1,'fdfd4','2023-11-22 17:00:15');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments_events`
--

DROP TABLE IF EXISTS `comments_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `comments_events` (
  `COMMENT_ID` int NOT NULL AUTO_INCREMENT,
  `Event_ID` int NOT NULL,
  `USER_ID` int NOT NULL,
  `COMMENT` text NOT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`COMMENT_ID`),
  KEY `Event_ID` (`Event_ID`),
  KEY `USER_ID` (`USER_ID`),
  CONSTRAINT `comments_events_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`),
  CONSTRAINT `comments_events_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_events`
--

LOCK TABLES `comments_events` WRITE;
/*!40000 ALTER TABLE `comments_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments_vid`
--

DROP TABLE IF EXISTS `comments_vid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `comments_vid` (
  `COMMENT_ID` int NOT NULL AUTO_INCREMENT,
  `VIDEO_ID` int NOT NULL,
  `USER_ID` int NOT NULL,
  `COMMENT` text NOT NULL,
  `DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`COMMENT_ID`),
  KEY `VIDEO_ID` (`VIDEO_ID`),
  KEY `USER_ID` (`USER_ID`),
  CONSTRAINT `comments_vid_ibfk_1` FOREIGN KEY (`VIDEO_ID`) REFERENCES `videos` (`Video_ID`),
  CONSTRAINT `comments_vid_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_vid`
--

LOCK TABLES `comments_vid` WRITE;
/*!40000 ALTER TABLE `comments_vid` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments_vid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `Event_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Likes` int NOT NULL,
  `Event_Poster` text NOT NULL,
  `Caption` varchar(250) NOT NULL,
  `Event_Time` time NOT NULL,
  `Event_Date` datetime NOT NULL,
  `Invite_Link` text NOT NULL,
  `HashTags` varchar(250) NOT NULL,
  `Date_Upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Event_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,0,'File_202311211883026.JPG','dfsfdsfsfs','11:09:00','2023-11-22 00:00:00','https://github.com/organizations/GaoGaoIt/settings/installations/42764475','#valorant','2023-11-21 02:08:50'),(2,1,0,'File_202311222158735.JPG','fjdskfjdksmfdsfdisfiusdpiudsuifdhuipfdf','13:54:00','2023-11-23 00:00:00','https://github.com/organizations/GaoGaoIt/settings/installations/42764475','#dddd','2023-11-22 16:54:43');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fallowing`
--

DROP TABLE IF EXISTS `fallowing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `fallowing` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `User_Id` int NOT NULL,
  `Other_user_id` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fallowing`
--

LOCK TABLES `fallowing` WRITE;
/*!40000 ALTER TABLE `fallowing` DISABLE KEYS */;
INSERT INTO `fallowing` VALUES (1,2,1),(2,2,2),(3,1,2);
/*!40000 ALTER TABLE `fallowing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `Like_ID` int NOT NULL AUTO_INCREMENT,
  `Post_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  PRIMARY KEY (`Like_ID`),
  KEY `Post_ID` (`Post_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`Post_ID`) REFERENCES `posts` (`Post_ID`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes_events`
--

DROP TABLE IF EXISTS `likes_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `likes_events` (
  `Like_ID` int NOT NULL AUTO_INCREMENT,
  `Event_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  PRIMARY KEY (`Like_ID`),
  KEY `Event_ID` (`Event_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `likes_events_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`),
  CONSTRAINT `likes_events_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes_events`
--

LOCK TABLES `likes_events` WRITE;
/*!40000 ALTER TABLE `likes_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes_vid`
--

DROP TABLE IF EXISTS `likes_vid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `likes_vid` (
  `Like_ID` int NOT NULL AUTO_INCREMENT,
  `Video_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  PRIMARY KEY (`Like_ID`),
  KEY `Video_ID` (`Video_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `likes_vid_ibfk_1` FOREIGN KEY (`Video_ID`) REFERENCES `videos` (`Video_ID`),
  CONSTRAINT `likes_vid_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes_vid`
--

LOCK TABLES `likes_vid` WRITE;
/*!40000 ALTER TABLE `likes_vid` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes_vid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pivot_content_data`
--

DROP TABLE IF EXISTS `pivot_content_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `pivot_content_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `content_path_name` varchar(255) DEFAULT NULL,
  `thumnail_path_name` varchar(255) DEFAULT NULL,
  `Date_upload` datetime DEFAULT NULL,
  `Likes` int DEFAULT NULL,
  `Caption` varchar(255) DEFAULT NULL,
  `HashTags` varchar(255) DEFAULT NULL,
  `Invite_Link` varchar(255) DEFAULT NULL,
  `Event_Time` time DEFAULT NULL,
  `Event_Date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pivot_content_data`
--

LOCK TABLES `pivot_content_data` WRITE;
/*!40000 ALTER TABLE `pivot_content_data` DISABLE KEYS */;
INSERT INTO `pivot_content_data` VALUES (1,1,2,'posts','File_202311201085811.jpg',NULL,NULL,NULL,'test','#kmkds',NULL,NULL,NULL),(2,2,1,'videos','Vid_20231121676263.','Thumb_20231121676263.png',NULL,NULL,'my video hehehehe','#dfsfds',NULL,NULL,NULL),(5,3,2,'events','File_202311222158735.JPG',NULL,'2023-11-23 00:00:00',NULL,'fjdskfjdksmfdsfdisfiusdpiudsuifdhuipfdf','#dddd','https://github.com/organizations/GaoGaoIt/settings/installations/42764475','13:54:00','2023-11-23');
/*!40000 ALTER TABLE `pivot_content_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `Post_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Likes` int NOT NULL,
  `Img_Path` text NOT NULL,
  `Caption` varchar(700) NOT NULL,
  `HashTags` varchar(250) NOT NULL,
  `Date_Upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Post_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,2,0,'File_202311202751173.jpg','dsdssd','dsdsd','2023-11-20 09:02:37'),(2,2,0,'File_202311201085811.jpg','dsdsdsdsdsdsd','dsds','2023-11-20 09:02:47'),(3,1,0,'File_202311214511927.jpg','ff','#dddd','2023-11-21 02:05:18');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_events`
--

DROP TABLE IF EXISTS `special_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `special_events` (
  `Event_ID` int NOT NULL AUTO_INCREMENT,
  `Caption` varchar(250) NOT NULL,
  `Event_Time` time NOT NULL,
  `Event_Date` datetime NOT NULL,
  `Invite_Link` text NOT NULL,
  `Date_Upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Event_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_events`
--

LOCK TABLES `special_events` WRITE;
/*!40000 ALTER TABLE `special_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `special_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `FULL_NAME` varchar(100) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `USER_TYPE` varchar(2) NOT NULL,
  `PASSWORD_S` varchar(50) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `IMAGE` varchar(200) DEFAULT 'assets/images/profile_pics/default.png',
  `FACEBOOK` varchar(200) DEFAULT 'www.facebook.com',
  `WHATSAPP` varchar(200) DEFAULT 'www.webwhatsapp.com',
  `BIO` varchar(500) DEFAULT 'bio here',
  `FALLOWERS` int DEFAULT '0',
  `FALLOWING` int DEFAULT '0',
  `POSTS` int DEFAULT '0',
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test','0','f5bb0c8de146c67b44babbf4e6584cc0','test@test','Profile_202311212281156.jpg','www.facebook.com','www.webwhatsapp.com','bio here',1,1,1),(2,'sam','vmskdl','1','f5bb0c8de146c67b44babbf4e6584cc0','samchan952@gmail.com','Profile_202311206631291.JPG','www.facebook.com','www.webwhatsapp.com','tell use more about you',2,2,2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `Video_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Likes` int NOT NULL,
  `Video_Path` text NOT NULL,
  `Caption` varchar(250) NOT NULL,
  `HashTags` varchar(250) NOT NULL,
  `Date_Upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Thumbnail_Path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Video_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,1,0,'Vid_20231121676263.','gujbjkbk','78','2023-11-21 00:00:00','Thumb_20231121676263.png');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-23  9:13:30
