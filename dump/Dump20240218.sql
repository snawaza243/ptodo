-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: todophp
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `due_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `completed` tinyint(1) DEFAULT '0',
  `priority` varchar(50) NOT NULL DEFAULT 'Medium',
  PRIMARY KEY (`task_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (38,1,'Prepare Presentation Slides','Create slides for the project presentation meeting next week.','2024-03-05','2024-02-15 14:30:00',1,'Low'),(39,2,'Review Marketing Campaign','Evaluate the effectiveness of the current marketing campaign and propose improvements.','2024-02-15','2024-02-16 09:45:00',1,'High'),(40,2,'Conduct Market Research','Gather data and insights about the target market demographics and preferences.','2024-03-01','2024-02-17 11:20:00',1,'Medium'),(56,1,'Grocery shopping','Pick up milk, eggs, bread, and bananas.','2024-02-08','2024-02-16 00:17:51',1,'Medium'),(59,1,'Pay bills','Set up online payments for electricity, water, and internet.','2024-02-25','2024-02-16 00:17:51',0,'Medium'),(60,2,'Learn a new skill','Take an online course on basic web development.','2024-03-03','2024-02-16 00:17:51',0,'Medium'),(61,3,'Organize paperwork on time','File documents, receipts, and other important papers.','2024-03-05','2024-02-16 00:17:51',0,'Medium'),(62,1,'Go for a run','Run a 5K race for charity.','2024-03-10','2024-02-16 00:17:51',0,'Medium'),(63,2,'Meet with friends','Catch up with friends over coffee or lunch.','2024-03-12','2024-02-16 00:17:51',0,'Medium'),(96,1,'Pick up birthday gift for friend','Get a thoughtful gift for Mary\'s birthday.','2024-02-29','2024-02-16 00:28:41',0,'Medium'),(97,2,'Plan weekend getaway','Choose a destination and book accommodations for a relaxing trip.','2024-03-23','2024-02-16 00:28:41',0,'Medium'),(98,3,'Organize closet','Sort clothes, declutter items, and fold everything neatly.','2024-03-16','2024-02-16 00:28:41',0,'Medium'),(99,8,'Call parents','Catch up with parents and share recent news.','2024-02-23','2024-02-16 00:28:41',1,'Medium'),(100,3,'Brainstorm project ideas','Come up with new and innovative ideas for the upcoming project.','2024-02-27','2024-02-16 00:28:41',0,'High'),(101,1,'Create presentation slides','Design engaging and informative slides for the upcoming client meeting.','2024-03-07','2024-02-16 00:28:41',0,'Medium'),(102,2,'Review performance report','Analyze personal performance metrics and identify areas for improvement.','2024-03-09','2024-02-16 00:28:41',0,'Medium'),(103,3,'Follow up with client','Send a follow-up email after the meeting to address any remaining questions.','2024-02-24','2024-02-16 00:28:41',0,'Medium'),(104,8,'Go for a hike','Explore a new trail and enjoy the fresh air.','2024-03-02','2024-02-16 00:28:41',0,'Medium'),(105,1,'Cook a healthy breakfast','Prepare a nutritious and delicious meal to start the day.','2024-02-26','2024-02-16 00:28:41',0,'Medium'),(106,2,'Schedule gym session','Book a time for a workout at the gym.','2024-03-06','2024-02-16 00:28:41',0,'Medium'),(107,3,'Meditate for 10 minutes','Reduce stress and improve focus with a short meditation session.','2024-02-22','2024-02-16 00:28:41',1,'Medium'),(108,8,'Balance checkbook','Reconcile bank statements and ensure accurate financial records.','2024-03-05','2024-02-16 00:28:41',0,'Medium'),(109,1,'Set budget for next month','Allocate funds for different categories like groceries, bills, and entertainment.','2024-03-01','2024-02-16 00:28:41',0,'Medium'),(110,2,'Research retirement options','Explore different investment options for future financial security.','2024-03-10','2024-02-16 00:28:41',0,'Medium'),(111,3,'Pay off credit card debt','Make a payment towards eliminating credit card debt.','2024-02-28','2024-02-16 00:28:41',1,'Medium'),(114,1,'Pick up birthday gift for friend','Get a thoughtful gift for Mary\'s birthday.','2024-02-29','2024-02-16 14:58:31',0,'Medium'),(115,2,'Plan weekend getaway','Choose a destination and book accommodations for a relaxing trip.','2024-03-23','2024-02-16 14:58:31',0,'Medium'),(116,3,'Organize closet','Sort clothes, declutter items, and fold everything neatly.','2024-03-16','2024-02-16 14:58:31',0,'Medium'),(117,8,'Call parents','Catch up with parents and share recent news.','2024-02-23','2024-02-16 14:58:31',1,'Medium'),(118,3,'Brainstorm project ideas','Come up with new and innovative ideas for the upcoming project.','2024-02-27','2024-02-16 14:58:31',0,'Medium'),(119,1,'Create presentation slides','Design engaging and informative slides for the upcoming client meeting.','2024-03-07','2024-02-16 14:58:31',0,'Medium'),(120,2,'Review performance report','Analyze personal performance metrics and identify areas for improvement.','2024-03-09','2024-02-16 14:58:31',0,'Medium'),(121,3,'Follow up with client','Send a follow-up email after the meeting to address any remaining questions.','2024-02-07','2024-02-16 14:58:31',1,'Low'),(122,8,'Go for a hike','Explore a new trail and enjoy the fresh air.','2024-03-02','2024-02-16 14:58:31',0,'Medium'),(123,1,'Cook a healthy breakfast','Prepare a nutritious and delicious meal to start the day.','2024-02-26','2024-02-16 14:58:31',0,'Medium'),(124,2,'Schedule gym session','Book a time for a workout at the gym.','2024-03-06','2024-02-16 14:58:31',0,'Medium'),(125,3,'Meditate for 10 minutes','Reduce stress and improve focus with a short meditation session.','2024-02-22','2024-02-16 14:58:31',1,'Medium'),(126,8,'Balance checkbook','Reconcile bank statements and ensure accurate financial records.','2024-03-05','2024-02-16 14:58:31',0,'Medium'),(127,1,'Set budget for next month','Allocate funds for different categories like groceries, bills, and entertainment.','2024-03-01','2024-02-16 14:58:31',0,'Medium'),(128,2,'Research retirement options','Explore different investment options for future financial security.','2024-03-10','2024-02-16 14:58:31',0,'Medium'),(129,3,'Pay off credit card debt','Make a payment towards eliminating credit card debt.','2024-02-28','2024-02-16 14:58:31',1,'Medium'),(130,1,'Renew car insurance','Shop around for the best rates and update coverage.','2023-12-31','2024-02-16 15:03:44',0,'High'),(131,2,'Write book review','Finish up a review for a recently read book.','2024-01-15','2024-02-16 15:03:58',1,'Medium'),(132,3,'Clean out gutters','Remove leaves and debris to prevent water damage.','2023-11-15','2024-02-16 15:03:58',1,'High'),(133,8,'Visit dentist','Schedule a checkup and cleaning.','2024-02-10','2024-02-16 15:04:45',0,'High'),(134,3,'Learn a new language','Start basic lessons in Spanish using an app.','2024-01-31','2024-02-16 15:04:45',0,'Medium'),(135,1,'Plan summer vacation','Research destinations and book accommodations.','2024-05-20','2024-02-16 15:04:45',0,'High'),(136,2,'Update resume','Highlight recent skills and achievements to showcase experience.','2024-03-15','2024-02-16 15:04:45',0,'Medium'),(137,3,'Buy birthday gift for brother','Find a unique and thoughtful present for his special day.','2024-02-12','2024-02-16 15:04:45',1,'High'),(138,8,'Organize photos','Sort and categorize pictures from recent trips.','2024-02-25','2024-02-16 15:04:45',0,'High'),(139,1,'Fix leaky faucet','Repair the dripping faucet in the kitchen sink.','2023-12-20','2024-02-16 15:04:45',1,'High'),(140,2,'Volunteer at local shelter','Help out at the animal shelter with various tasks.','2024-03-25','2024-02-16 15:04:45',0,'High'),(141,3,'Start home improvement project','Begin painting the living room in a new color.','2024-01-20','2024-02-16 15:04:45',0,'Medium'),(142,8,'Learn to cook a new dish','Master a signature recipe to impress friends and family.','2024-04-08','2024-02-16 15:04:45',0,'High'),(143,1,'Read classic novel','Start \"Moby Dick\" and delve into the literary adventure.','2024-02-05','2024-02-16 15:04:45',0,'Medium'),(144,2,'Attend industry conference','Network with professionals and learn about industry trends.','2024-04-12','2024-02-16 15:04:45',0,'High'),(145,3,'Donate to charity','Support a cause close to your heart with a financial contribution.','2024-02-14','2024-02-16 15:04:45',1,'High'),(146,8,'Go for a run','Start a regular running routine to improve fitness.','2024-02-17','2024-02-16 15:04:45',0,'Medium'),(147,1,'Clean out attic','Sort through belongings and discard unnecessary items.','2024-01-25','2024-02-16 15:04:45',0,'High'),(148,1,'Renew car insurance','Shop around for best rates and update coverage.','2022-11-30','2024-02-16 15:26:17',0,'Low'),(149,2,'Write book review','Finish review for recently read book.','2023-04-15','2024-02-16 15:26:17',0,'Medium'),(150,3,'Clean out gutters','Remove leaves and debris to prevent water damage.','2025-09-15','2024-02-16 15:26:17',0,'High'),(151,8,'Visit dentist','Schedule checkup and cleaning.','2024-03-12','2024-02-16 15:26:17',0,'High'),(152,1,'Learn a new language','Start basic lessons in French using an app.','2023-10-31','2024-02-16 15:26:17',1,'Low'),(153,2,'Plan summer vacation','Research destinations and book accommodations.','2024-07-20','2024-02-16 15:26:17',0,'High'),(154,3,'Update resume','Highlight recent skills and achievements.','2024-05-15','2024-02-16 15:26:17',1,'Medium'),(155,8,'Buy birthday gift for friend','Find a unique and thoughtful present.','2023-12-12','2024-02-16 15:26:17',1,'High'),(156,3,'Organize photos','Sort and categorize pictures from last trip.','2024-04-25','2024-02-16 15:26:17',0,'Low'),(157,1,'Fix leaky faucet','Repair the dripping faucet in the bathroom sink.','2022-12-20','2024-02-16 15:26:17',0,'High'),(158,2,'Volunteer at local shelter','Help out with various tasks.','2024-06-25','2024-02-16 15:26:17',0,'High'),(159,3,'Start home improvement project','Begin painting the bedroom.','2023-08-20','2024-02-16 15:26:17',0,'Medium'),(160,8,'Learn to cook a new dish','Master a signature recipe for pasta.','2024-08-08','2024-02-16 15:26:17',0,'High'),(161,1,'Read classic novel','Start \"Jane Eyre\" and delve into the literary world.','2023-03-05','2024-02-16 15:26:17',1,'Low'),(162,2,'Attend industry conference','Network with professionals and learn new trends.','2024-09-12','2024-02-16 15:26:17',0,'High'),(163,3,'Donate to charity','Support a cause close to your heart.','2023-02-14','2024-02-16 15:26:17',1,'Medium'),(164,8,'Go for a run','Start a regular running routine for fitness.','2024-03-18','2024-02-16 15:26:17',0,'High'),(165,1,'Clean out garage','Sort through belongings and discard unnecessary items.','2023-07-25','2024-02-16 15:26:17',0,'Medium'),(166,1,'Renew car insurance','Shop around for best rates and update coverage.','2023-11-30','2024-02-16 15:27:41',1,'Low'),(167,1,'Plan summer vacation','Research destinations and book accommodations.','2024-07-20','2024-02-16 15:27:41',0,'High'),(168,1,'Create presentation slides','Design engaging and informative slides for meeting.','2024-03-07','2024-02-16 15:27:41',0,'Medium'),(169,1,'Set budget for next month','Allocate funds for different categories.','2024-03-01','2024-02-16 15:27:41',0,'Low'),(170,1,'Cook a healthy breakfast','Prepare a nutritious and delicious meal.','2024-02-26','2024-02-16 15:27:41',0,'Low'),(171,1,'Read classic novel','Start \"Moby Dick\" and delve into the adventure.','2024-02-05','2024-02-16 15:27:41',0,'Medium'),(172,1,'Clean out attic','Sort through belongings and discard unnecessary items.','2024-01-25','2024-02-16 15:27:41',0,'High'),(173,2,'Write book review','Finish up a review for recently read book.','2023-04-15','2024-02-16 15:27:41',1,'Medium'),(174,2,'Update resume','Highlight recent skills and achievements.','2024-03-15','2024-02-16 15:27:41',0,'Medium'),(175,2,'Schedule gym session','Book a time for a workout.','2024-03-06','2024-02-16 15:27:41',0,'Low'),(176,2,'Research retirement options','Explore different investment options.','2024-03-10','2024-02-16 15:27:41',0,'High'),(177,2,'Attend industry conference','Network with professionals and learn new trends.','2024-04-12','2024-02-16 15:27:41',0,'High'),(179,3,'Learn a new language','Start basic lessons in Spanish using an app.','2023-10-31','2024-02-16 15:27:41',1,'Low'),(180,3,'Organize closet','Sort clothes, declutter items, and fold everything neatly.','2024-03-16','2024-02-16 15:27:41',0,'Medium'),(181,3,'Meditate for 10 minutes','Reduce stress and improve focus with a short session.','2024-02-22','2024-02-16 15:27:41',1,'High'),(182,3,'Pay off credit card debt','Make a payment towards eliminating debt.','2024-02-28','2024-02-16 15:27:41',1,'High'),(183,3,'Start home improvement project','Begin painting the living room.','2024-01-20','2024-02-16 15:27:41',0,'Medium'),(184,8,'Visit dentist','Schedule checkup and cleaning.','2024-03-12','2024-02-16 15:27:41',0,'High'),(185,8,'Buy birthday gift for friend','Find a unique and thoughtful present.','2023-12-12','2024-02-16 15:27:41',1,'High'),(186,8,'Organize photos','Sort and categorize pictures from last trip.','2024-04-25','2024-02-16 15:27:41',0,'Low'),(187,8,'Go for a run','Start a regular running routine for fitness.','2024-03-18','2024-02-16 15:27:41',0,'High'),(188,8,'Balance checkbook','Reconcile bank statements and ensure accurate records.','2024-03-05','2024-02-16 15:27:41',0,'Low'),(189,1,'fffffffffffffgvvvvvvvv','','2024-02-20','2024-02-18 00:11:14',0,'Medium');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `failed_attempts` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','$2y$10$MG4p4r/I3y7Nt8Ca5i5pluEPXPYXle43L1NiUgYWUcSW188rflUPm','Sam Edward','+919955448800','uploads/profile/1_admin.png',NULL),(2,'demo','demo@gmail.com','$2y$10$CAa4GPc2d2yO9ugKSt91Pe2hPsH492ApjtsRCH3xSHL0Alf8yFSSu','Demo De','999999999','uploads/profile/2_demo.png',NULL),(3,'sam','sam@gmail.com','$2y$10$BLmYoGQu8BFFWTZSGFwxq.jKidQj63JfsHDWWvFMaj5AIyrVgiObC','Sam Edward','+919955448877','uploads/profile/3_sam.png',NULL),(8,'armin243','armin@gmail.com','$2y$10$pnnqtP1Sb8ouLpLhElZBOeJ8vJCpD6u.qowM274ivbDn8OhIXcvMO','Armin','+919999999999',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'todophp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-18 19:39:48
