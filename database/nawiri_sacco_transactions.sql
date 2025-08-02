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
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `recipient_account` varchar(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,NULL,'withdrawal',2000.00,'2025-04-09 13:12:08'),(2,2,NULL,'withdrawal',5000.00,'2025-04-09 23:06:37'),(3,2,NULL,'withdrawal',5000.00,'2025-04-09 23:08:43'),(4,2,NULL,'withdrawal',5000.00,'2025-04-09 23:09:05'),(5,1,'ACC518011','transfer',5000.00,'2025-04-11 07:47:26'),(6,1,'ACC518011','transfer',5000.00,'2025-04-11 07:54:40'),(7,6,NULL,'withdrawal',800.00,'2025-04-14 08:45:17'),(8,6,NULL,'withdrawal',800.00,'2025-04-14 08:45:21'),(9,6,NULL,'withdrawal',800.00,'2025-04-14 08:45:23'),(10,1,'ACC396614','transfer',1500.00,'2025-04-14 08:51:13'),(11,1,NULL,'withdrawal',5000.00,'2025-04-14 09:00:42'),(12,1,'ACC396614','transfer',5000.00,'2025-04-14 09:01:51'),(13,6,NULL,'withdrawal',3000.00,'2025-04-14 09:05:06'),(14,6,NULL,'withdrawal',3000.00,'2025-04-14 09:11:59'),(15,6,'ACC396614','transfer',10000.00,'2025-04-14 09:15:17'),(16,6,NULL,'withdrawal',2000.00,'2025-04-14 09:16:31'),(17,11,NULL,'withdrawal',1000.00,'2025-04-14 09:18:32'),(18,11,'ACC518011','transfer',2000.00,'2025-04-14 09:19:27');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
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
