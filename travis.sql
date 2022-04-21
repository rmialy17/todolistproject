-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: todolistproject
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (11,'admin','$2y$13$yUvm9Ag3rU0rgEhADcvEoeNDE4AYckuw/TrhbiJR/Zz1N/XXbGove','admin@gmail.com','[\"ROLE_ADMIN\"]'),(12,'userdemo','$2y$13$sUunJEE/F2SqoFr5RD1ihuANAD2IHtGi/uN8nFJm0NWb58jhiEfvK','userdemo@gmail.com','[\"ROLE_USER\"]'),(13,'mialy','dedenou','moi@gmail.com','[\"ROLE_ADMIN\"]'),(14,'mi','$2y$13$M221NMCunDp9qgQjQ8atYev9k1S2gbH4lj1apoDDURQPqzq3xpXmm','mi@gmail.com','[]'),(15,'mamo','$2y$13$rnk.MCFEtazDnG4EOQ2j6O3T9WB/vwvjwglMLZgCQw9UqbhPNKhwC','mamo@gmail.com','[\"ROLE_USER\"]'),(16,'OOOOO','$2y$13$MM4wSExHyLkZS.8CamEWgulZ2xPp1dnMp6o.inqs4NtlSGChWGd7.','OOOO@oooo.com','[\"ROLE_ADMIN\"]'),(17,'eeee','$2y$13$dZVA3.2q3Yi1Jm5o1JwsKOXmXhptf1FWJccpNa4Ypk67kBVGcwI4K','eeeeee@gmail.com','[\"ROLE_ADMIN\"]'),(18,'fffffffff','$2y$13$v49RCH7NnFtHQTaA3MrZr.bfQigehvLVzWsu41cxXMdMYsdS2sevO','ffffff@gsvz.com','[\"ROLE_ADMIN\"]'),(19,'iiiiiiiiii','$2y$13$Jc1wc9ukEt2C7SO3Z4aLCuSlMv0Kw2WG1bSE/jiVojhTL3jmmk3Ae','iiiiiiiiii@gujkgbj.com','[]'),(20,'dddddd','$2y$13$mCnRmf6kd5XD064Saz6wGeD8LluLkrFweG8fwode5RL8wkYkCq7Q2','dddddd@ddddddd.ddd','[]'),(21,'uuuuuuuu','$2y$13$3YUJATj6PqKisP7G0bn67uoxxdmtSt98P7S.OMso3wVOr.zLMqnW6','uuuuuuuu@u.uuu','[\"ROLE_USER\"]'),(22,'tttttttttt','$2y$13$MUsy31dVocbPcPwJxaF2BOjPlYobhjgCc/z/HKIdkSvnhV61u7lOW','ttttttttttt@tttttttttt.tttttttt','[\"ROLE_ADMIN\"]'),(23,'zzzzzzzzzzz','$2y$13$PY/sL9AH2l73j2kS4VOqW.AwYHmWojUxPwKXQW3bWsnpTSo7b9vay','zzzzzz@zzzzz.zzzzz','[\"ROLE_USER\"]'),(24,'zzzzzzzz','$2y$13$v3TdZ0B3fPT.qkEHGaFpGOsuBwAas5eA/t.uKVITjvi1dEOLeEGfe','zzz@zzzzz.zzzzz','[\"ROLE_ADMIN\"]'),(25,'zzzzz','$2y$13$uWJjFzNWrwmU3wKlHmMjhOqeTded8AUTkGAbUsWECSEyaEvrEbJ1C','zz@zzzzz.zzzzz','[\"ROLE_USER\"]'),(26,'nfnnn222','$2y$13$XSu2rJkmy7soPUpCU6l7D.HQV584dR5hLvDN7Q.MJGMOHQ3xozQKu','bgbgdnb@hhhh.hhhh','[\"ROLE_USER\"]');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (35,'2022-04-15 12:41:07','Tâche 1','Faire le ménage',1,NULL),(36,'2022-04-15 12:41:07','Tâche 2','Faire les courses',0,NULL),(37,'2022-04-15 12:41:07','Tâche 3','Sortir les poubelles',1,NULL),(38,'2022-04-15 12:41:07','Tâche 4','Faire un gâteau',0,NULL),(39,'2022-04-15 12:41:07','Tâche 5','Acheter une table',1,NULL),(44,'2022-04-19 10:03:57','dklejk','frzfzrfzrfzr',0,12);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-21 12:59:10
