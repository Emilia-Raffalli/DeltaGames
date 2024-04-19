-- MySQL dump 10.13  Distrib 8.2.0, for macos13.5 (arm64)
--
-- Host: localhost    Database: quiz-delta
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int DEFAULT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A251E27F6BF` (`question_id`),
  CONSTRAINT `FK_DADD4A251E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` VALUES (1,1,'A. Munich à New York-JFK',1),(2,1,'B. Naples à New York-JFK',1),(3,1,'C. Shannon à New York-JFK',1),(4,1,'D. Dublin à Minneapolis-St. Paul',1),(5,1,'E. Toutes les réponses ci-dessus',1),(6,2,'A. 20 ',1),(7,2,'B. 25 ',0),(8,2,'C. 22',0),(9,2,'D. 30',0),(10,3,'A. Los Angeles',0),(11,3,'B. New York-JFK',0),(12,3,'C. Atlanta',1),(13,3,'D. Boston',0),(14,4,'A. Plus de 700',0),(15,4,'B. Moins de 600 ',0),(16,4,'C. Jusqu\'à 680 ',1),(17,4,'D. Aucune de ces réponses',0),(18,5,'A. Moins de 150',0),(19,5,'B. Plus de 200',1),(20,5,'C. Jusqu\'à 100 ',0),(21,5,'D. Aucune de ces réponses',0);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participation`
--

DROP TABLE IF EXISTS `participation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `user_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AB55E24FA76ED395` (`user_id`),
  CONSTRAINT `FK_AB55E24FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participation`
--

LOCK TABLES `participation` WRITE;
/*!40000 ALTER TABLE `participation` DISABLE KEYS */;
INSERT INTO `participation` VALUES (1,NULL,'0lhcqr1cbjakpv6jrvt9pdgd8q');
/*!40000 ALTER TABLE `participation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participation_answer`
--

DROP TABLE IF EXISTS `participation_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participation_answer` (
  `participation_id` int NOT NULL,
  `answer_id` int NOT NULL,
  PRIMARY KEY (`participation_id`,`answer_id`),
  KEY `IDX_A0B8CC006ACE3B73` (`participation_id`),
  KEY `IDX_A0B8CC00AA334807` (`answer_id`),
  CONSTRAINT `FK_A0B8CC006ACE3B73` FOREIGN KEY (`participation_id`) REFERENCES `participation` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A0B8CC00AA334807` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participation_answer`
--

LOCK TABLES `participation_answer` WRITE;
/*!40000 ALTER TABLE `participation_answer` DISABLE KEYS */;
INSERT INTO `participation_answer` VALUES (1,1),(1,7),(1,12),(1,14),(1,18);
/*!40000 ALTER TABLE `participation_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participation_question`
--

DROP TABLE IF EXISTS `participation_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participation_question` (
  `participation_id` int NOT NULL,
  `question_id` int NOT NULL,
  PRIMARY KEY (`participation_id`,`question_id`),
  KEY `IDX_5ADFC5D96ACE3B73` (`participation_id`),
  KEY `IDX_5ADFC5D91E27F6BF` (`question_id`),
  CONSTRAINT `FK_5ADFC5D91E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5ADFC5D96ACE3B73` FOREIGN KEY (`participation_id`) REFERENCES `participation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participation_question`
--

LOCK TABLES `participation_question` WRITE;
/*!40000 ALTER TABLE `participation_question` DISABLE KEYS */;
INSERT INTO `participation_question` VALUES (1,1),(1,2),(1,3),(1,4),(1,5);
/*!40000 ALTER TABLE `participation_question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quiz_id` int DEFAULT NULL,
  `answer_choice_id` int DEFAULT NULL,
  `question_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hint` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E853CD175` (`quiz_id`),
  KEY `IDX_B6F7494EA479B907` (`answer_choice_id`),
  CONSTRAINT `FK_B6F7494E853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  CONSTRAINT `FK_B6F7494EA479B907` FOREIGN KEY (`answer_choice_id`) REFERENCES `answer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,NULL,NULL,'Quelle est votre nouvelle liaison préférée dans le programme Delta Summer 2024 ? ','Échauffement','Il n\'y a pas de mauvaises réponses. Vous pouvez aimer tous nos vols.'),(2,NULL,NULL,'Au départ de combien de pays d\'Europe, du Moyen-Orient, d\'Afrique et d\'Inde (EMEAI) Delta propose-t-elle un service sans escale vers les États-Unis ?','Quel que soit votre pays d\'origine, Delta est le choix idéal pour vous rendre aux États-Unis.','20 pays de la région EMEAI, sont desservis par Delta en vols directs des USA.'),(3,NULL,NULL,'Quelle est la destination principale de Delta vers les États-Unis ?','Cette ville n\'a jamais été aussi proche avec des vols sans escale depuis 29 villes de la zone EMEAI. ','New York n\'a jamais été aussi proche! C\'est la destination transatlantique numéro 1 de Delta.'),(4,NULL,NULL,'Quel est le nombre de vols hebdomadaires sans escale assurés par Delta au départ de la zone EMEAI cet été ? ','Chacun trouvera forcément un siège à sa convenance avec le plus grand programme transatlantique jamais proposé par Delta.','Delta va opérer jusqu\'à 680 vols par semaine cet été au départ de la région EMEAI.'),(5,NULL,NULL,'Pour combien de destinations aux États-Unis Delta propose-t-elle des correspondances faciles ?','Plus à découvrir dans tous les États-Unis ','Delta offre des correspondances faciles vers plus de 200 destinations à travers les États-Unis.');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'emi.graphisme@gmail.com','[]','Emilia','RAFFALLI','9 cours des Juilliottes','escalier 30','94700','Maisons-Alfort','France'),(3,'e.raffalli@hotmail.fr','[]','Emilia','RAFFALLI','9 cours des Juilliottes','escalier 30','94700','Maisons-Alfort','France'),(4,'emi.graphisme@gmail.com','[]','Emilia','RAFFALLI','9 cours des Juilliottes','escalier 30','94700','Maisons-Alfort','France'),(5,'juliette.raffalli@gmail.com','[]','Juliette','Raffalli','hedgu','duhug','75012','Paris','France'),(6,'e.raffalli@hotmail.fr','[]','Emilia','RAFFALLI','9 cours des Juilliottes','escalier 30','94700','Maisons-Alfort','France'),(7,'em@test.com','[]','Emilia','RAFFALLI','9 cours des Juilliottes',NULL,'94700','Maisons-Alfort','France');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-19 17:21:40
