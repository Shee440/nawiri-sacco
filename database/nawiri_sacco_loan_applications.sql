-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: nawiri_sacco
-- ------------------------------------------------------
-- Server version	9.2.0

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
-- Table structure for table `loan_applications`
--

DROP TABLE IF EXISTS `loan_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan_applications` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `purpose` text,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `loan_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_applications`
--

LOCK TABLES `loan_applications` WRITE;
/*!40000 ALTER TABLE `loan_applications` DISABLE KEYS */;
INSERT INTO `loan_applications` VALUES (1,1,2000.00,'business','approved','2025-04-09 05:14:04'),(2,1,1000.00,'business','pending','2025-04-09 05:23:09'),(3,1,1000.00,'business','pending','2025-04-09 05:23:14'),(4,1,NULL,NULL,'rejected','2025-04-10 00:31:06'),(5,1,5001.00,'business','approved','2025-04-10 00:32:19'),(6,6,5000.00,'Education','pending','2025-04-14 08:44:49'),(7,1,6000.00,'School fees','pending','2025-04-14 09:01:13'),(8,6,20000.00,'Education,school fees','pending','2025-04-14 09:16:00'),(9,11,10000.00,'Business','pending','2025-04-14 09:19:03');
/*!40000 ALTER TABLE `loan_applications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-20 16:17:23
