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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT '0.00',
  `role` varchar(50) DEFAULT 'user',
  `account_number` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `account_number` (`account_number`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'warima','warimaedgar@gmail.com','$2y$12$SItfXxMk3ecBvFx5/VDD0e2glZJOTESzNo8t/Ap2H4WYHJdhgXqiS',95901.00,'user','ACC821687','2025-04-09 17:13:59'),(2,'eddy mkuu','mkuueddy01@gmail.com','$2y$12$847QkwnIWLoMeC693gFH4.ldXeEpJepC3x73dx6UrBqqXmUI101E.',26500.00,'user','ACC396614','2025-04-09 17:13:59'),(3,'kulankash','coolncash@gmail.com','$2y$12$a9iJk5nk4WgDDHavq4G/4ekxGRlCaF5KGcG.EuMjYEub6B2.tCzX.',7000.00,'user','ACC518011','2025-04-09 17:13:59'),(4,'holyblueshark','william@gmail.com','$2y$12$uUDbR0nIEheEoESYX5F/xucHzKyff78hn13ProQ4.RIgSOd5OcQZ6',0.00,'user','NS-267320','2025-04-09 17:13:59'),(5,'allan','mediapics@gmail.com','$2y$12$VaNWFW5mZ.5bOAkaBJFJLumRATgJxITxstnazW/tLHvOWOsr8BLp6',0.00,'user',NULL,'2025-04-11 14:55:55'),(6,'sheilla mumbi','mumbi@gmail.com','$2y$12$aNE6xRR/dG49s/UzCFxnfeEqQ1YRHKrpFbCku.ywAgco2J2yTOocG',1100.00,'user',NULL,'2025-04-11 15:09:53'),(7,'sheilla mumbi','sheilamumbi@gmail.com','$2y$12$Wri2aKUi9U1pURs0p9OX3eWqYQ/DQSAjVvRRXjAuFRbzaG9BIiyXi',0.00,'user',NULL,'2025-04-13 17:58:14'),(8,'hellen mumbi','hellen@gmail','$2y$12$0LWnlVwOx2f6sIOV4SR2I.cBSCdMlbvn5Az0kyb.p.YMQW1N4510q',0.00,'user',NULL,'2025-04-13 18:34:54'),(9,'hellen mumbi','hellen@gmail.com','$2y$12$XnJ0ALXlOv/28RhAXYV6UesqCyYgQy1QL/CP7oaWN6uYstSJAoKIi',0.00,'user',NULL,'2025-04-13 18:36:47'),(10,'Mazden Loretto','mazdenloretto809@gmail.com','$2y$12$.8EsB/BblnJxgM4W0jkSK.NnSBNcO0c7OgikCKyshvSbLiGMSf/5W',0.00,'user',NULL,'2025-04-13 18:46:02'),(11,'rita wambui','wambui@gmail.com','$2y$12$TrqOmyBpHtjd/dXo4yWYH.SgozzqUGVDAEbgQGOCbL7YZNjNGyQYe',2000.00,'user','ACC206918','2025-04-14 09:17:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-20 16:17:22
