
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ifilms_database
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `document_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `staff_id` int DEFAULT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uploaded_by` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `meeting_type` varchar(100) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` int DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`document_id`),
  KEY `fk_documents_staff` (`staff_id`),
  KEY `fk_documents_uploaded_by` (`uploaded_by`),
  KEY `fk_deleted_by` (`deleted_by`),
  CONSTRAINT `fk_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_documents_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'ACAD MEETING',17,'documents/cwxT1vmkHBFBIM2pXtHLjiuVFe9vL2RRymzNPVBz.xlsx','xlsx','2025-09-04 14:50:32','17','Transcriptions','Academic Council Meeting',NULL,NULL,NULL,NULL),(2,'Admin Meeting',17,'documents/68b946e5eca94.docx','docx','2025-09-04 15:59:34','17','Transcriptions','Administrative Council Meeting',NULL,NULL,NULL,19),(3,'Board',17,'documents/68b9505398e2d.docx','docx','2025-09-04 16:39:47','17','Transcriptions','Board Meeting',NULL,'2025-11-06 09:56:00',17,17),(4,'Academic Council',17,'documents/68b959237de76.docx','docx','2025-09-04 17:17:23','17','Transcriptions','Academic Council Meeting',NULL,NULL,NULL,17),(5,'Administrative Council',17,'documents/68b95ad277ab0.docx','docx','2025-09-04 17:24:34','17','Transcriptions','Administrative Council Meeting',NULL,NULL,NULL,17),(6,'Certificate',17,'documents/68b96537403fe.docx','docx','2025-09-04 18:08:55','17','Secretary\'s Certification',NULL,NULL,NULL,NULL,19),(7,'Acad Meet',17,'documents/68bae08f3ad05.txt','txt','2025-09-05 21:07:27','17','Minutes','Academic Council Meeting',NULL,NULL,NULL,NULL),(8,'Academic Meet 2',17,'documents/68bae0ec13fc9.docx','docx','2025-09-05 21:09:00','17','Minutes','Academic Council Meeting',NULL,NULL,NULL,NULL),(9,'Academic Meeting 3',17,'documents/68bae11e15721.xlsx','xlsx','2025-09-05 21:09:50','17','Minutes','Academic Council Meeting',NULL,NULL,NULL,19),(12,'Board Meet 2',17,'documents/68baf280df3b3.docx','docx','2025-09-05 22:24:00','17','Excerpts','Board Meeting',NULL,NULL,NULL,19),(13,'Board Meeting 3',17,'documents/68baf2a444e56.xlsx','xlsx','2025-09-05 22:24:36','17','Excerpts','Board Meeting',NULL,NULL,NULL,19),(14,'Acad met 3',17,'documents/68c919d6b3f5a.docx','docx','2025-09-16 16:03:36','17','Transcriptions','Board Meeting',NULL,NULL,NULL,NULL),(15,'Board Res 1',17,'documents/68cf5943b690d.docx','docx','2025-09-21 09:47:48','17','Board Resolution',NULL,NULL,NULL,NULL,17),(16,'Board 4',17,'documents/68df5dc04fd16.pdf','pdf','2025-10-03 13:23:14','17','Transcriptions','Board Meeting',NULL,NULL,NULL,17),(17,'Administrative Meet 4',17,'documents/68e5dc5c54472.pdf','pdf','2025-10-08 11:37:02','17','Minutes','Administrative Council Meeting',NULL,NULL,NULL,17),(18,'Sec Cert 1',17,'documents/68eb780c3fafe.pdf','pdf','2025-10-12 17:42:36','17','Secretary\'s Certification',NULL,NULL,NULL,NULL,17),(20,'FORM WAIVER',17,'documents/68ef454933e00.docx','docx','2025-10-15 14:55:05','17','Secretary\'s Certification',NULL,NULL,'2025-11-06 22:27:05',17,17);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metadata_tags`
--

DROP TABLE IF EXISTS `metadata_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metadata_tags` (
  `metadata_id` int NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `tag` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`metadata_id`),
  KEY `fk_metadata_document` (`document_id`),
  CONSTRAINT `fk_metadata_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metadata_tags`
--

LOCK TABLES `metadata_tags` WRITE;
/*!40000 ALTER TABLE `metadata_tags` DISABLE KEYS */;
INSERT INTO `metadata_tags` VALUES (1,3,'tag','iFilMS'),(2,4,'Context Flow Diagram','Context Flow Diagram'),(3,5,'System Overview','System Overview'),(4,5,'Features','Features'),(5,5,'Functions','Functions'),(6,6,'Structured','Structured'),(7,6,'Unstructured','Unstructured'),(8,6,'Semi-structured','Semi-structured'),(9,7,'Academic Minutes Meeting','Academic Minutes Meeting'),(10,8,'Minutes','Minutes'),(11,8,'meeting','meeting'),(12,8,'Minutes of the meeting 2','Minutes of the meeting 2'),(13,9,'Acad meeting 3','Acad meeting 3'),(18,12,'January','January'),(19,12,'2025','2025'),(20,12,'Excerpts','Excerpts'),(21,13,'meeting 3','meeting 3'),(22,14,'System Administration','System Administration'),(23,14,'Maintenance Laboratory','Maintenance Laboratory'),(24,15,'Building the Foundation','Building the Foundation'),(25,15,'Populating the World','Populating the World'),(26,16,'Learning Objectives','Learning Objectives'),(27,16,'Accurate Data Entry Goals','Accurate Data Entry Goals'),(28,17,'administrative','administrative'),(29,17,'meet','meet'),(30,17,'Administrative','Administrative'),(31,17,'Meet','Meet'),(32,18,'sec','sec'),(33,18,'cert','cert'),(34,18,'Sec','Sec'),(35,18,'Cert','Cert'),(36,18,'DAILY TIME RECORD','DAILY TIME RECORD'),(37,18,'48','48'),(42,20,'form','form'),(43,20,'waiver','waiver'),(44,20,'FORM','FORM'),(45,20,'WAIVER','WAIVER');
/*!40000 ALTER TABLE `metadata_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_07_23_141425_create_password_resets_table',2),(5,'2025_09_01_092151_create_documents_table',3),(6,'2025_09_04_091059_create_metadata_tags_table',4),(7,'2025_09_04_091155_create_storage_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('plmj2022-6325-62187@bicol-u.edu.ph','JQQZViiIxuxQ1mFLkM7bmHJkYit26q3bWdOYMEuuqifAoq93sbQ8tNu8b1aAIXqx','2025-10-22 09:42:02');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retrieval`
--

DROP TABLE IF EXISTS `retrieval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `retrieval` (
  `retrieval_id` int NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `retrieval_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`retrieval_id`),
  KEY `fk_retrieval_document` (`document_id`),
  KEY `fk_retrieval_staff` (`staff_id`),
  CONSTRAINT `fk_retrieval_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_retrieval_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retrieval`
--

LOCK TABLES `retrieval` WRITE;
/*!40000 ALTER TABLE `retrieval` DISABLE KEYS */;
INSERT INTO `retrieval` VALUES (3,20,17,'2025-10-21 15:44:29'),(8,4,19,'2025-10-21 17:22:47'),(9,4,19,'2025-10-21 17:23:32'),(10,4,19,'2025-10-21 17:28:18'),(11,18,19,'2025-10-21 17:29:23'),(12,9,19,'2025-10-21 19:19:08'),(13,9,19,'2025-10-21 19:19:48'),(14,12,19,'2025-10-21 19:28:58'),(15,13,19,'2025-10-21 19:31:40'),(16,6,19,'2025-10-21 19:44:48'),(17,2,19,'2025-10-21 19:48:10'),(18,2,19,'2025-10-21 19:48:32'),(19,5,19,'2025-10-21 19:48:34'),(20,15,19,'2025-10-21 20:41:17'),(21,15,19,'2025-10-21 20:41:36'),(22,20,19,'2025-10-21 20:46:07'),(23,20,19,'2025-10-21 20:48:22'),(24,20,17,'2025-10-22 14:22:30'),(25,16,17,'2025-10-22 22:13:23'),(26,17,17,'2025-10-22 22:13:25'),(27,18,17,'2025-10-22 22:13:27'),(28,20,17,'2025-10-22 22:13:29'),(30,20,17,'2025-10-26 17:21:39'),(31,18,17,'2025-10-26 17:21:41'),(32,15,17,'2025-10-26 20:43:47'),(33,20,17,'2025-10-28 13:13:25'),(34,18,17,'2025-10-28 13:13:28'),(35,20,17,'2025-10-29 13:16:54'),(36,18,17,'2025-10-29 21:20:05'),(37,20,17,'2025-10-29 21:45:02'),(38,20,17,'2025-10-29 22:19:21'),(39,20,17,'2025-10-29 22:20:02'),(40,20,17,'2025-10-29 23:20:47'),(41,18,17,'2025-10-29 23:52:56'),(50,4,17,'2025-11-02 17:34:59'),(51,17,17,'2025-11-02 17:43:55'),(52,5,17,'2025-11-02 17:45:23'),(54,20,17,'2025-11-02 18:04:53'),(56,20,17,'2025-11-05 21:31:04'),(57,20,17,'2025-11-05 21:40:00'),(58,20,17,'2025-11-05 21:41:53'),(62,17,17,'2025-11-05 22:05:16'),(66,18,17,'2025-11-06 06:46:55'),(67,17,17,'2025-11-06 06:54:43'),(68,20,19,'2025-11-06 07:41:55'),(69,14,17,'2025-11-06 09:24:55'),(70,3,17,'2025-11-06 09:55:36');
/*!40000 ALTER TABLE `retrieval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('GtELwIlpUpTAVXkQt4n8Sa5I7jKyPS9tITIrkkq0',17,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGdDWWpoRFFyMmtMb0pkWkFwSXJUUEwzQUg0c3JqNGI5SnNTenpjbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9zdGFmZl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3O30=',1762395800),('HnhUBmWkmf6Zw6fnXDZWODd6Thv87quKDN4Qhyp3',17,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaktYU3dvaUxRakI2ODU4cm5RSnpqUFpETHVxT0tEak1sU2FTZjdNZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9zdGFmZl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3O30=',1762439559),('mestGNvDNXxQctQyzZFuzdiaEZak0fNkRUAkIodB',17,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUzhndTlDVWg3SXhmNmFWcEZRYWZHR3lXalRRa1Z2RGFqY3JRajVUYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9zdGFmZl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3O30=',1762360399),('SkmZdtzYXw99iXqhtbq9BG0J9MQbVyqVHbs7JjxQ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0pMcUlnN3RpenpBeEVoZHMzb3RQc3I0a0FWY3k1R1QxNkdjSXhyayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1762382525),('w6L8UASsCN08OIjzNOmc7g8jArfBv2LuGKc2Ihgq',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNWdKUGtaTzZoWWVsa3pUY1BOSTUyY3djTUN4TUkwSVZydlM0YzJmcyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1762421282),('znbkNuPxjgnUk7pQu6D9tnIJRpPp5R3ItpFUwwBM',19,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEdudzJKUXdZSEZaSGVFSlJpMFh5ZTB2alY3QU5SZ0s2REdZMUhQcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9zdGFmZl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O30=',1762386119);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (16,'Prince Louis','plmj2022-6325-62187@bicol-u.edu.ph','$2y$12$Qx6Shbx7R3xS3t7VvOKxouFPZj1FgIo2Zx4Q.2Dsc3mUjzDI0nsa2',NULL,NULL),(17,'Prince Louis Jaylo','jayloprincelouis123@gmail.com','$2y$12$t/9urYSq26CaW6gZGdz4I.sQ6MXDlbGlKorDZKuG8nhsSjnQdch6K','2025-11-06 20:22:09','2025-11-06 20:12:01'),(19,'OUBS Staff   ','staff@gmail.com','$2y$12$8m4Y3j8HdUA8QNDefzcCNeCIFrvZijaVwo6A3qbuNLxpeyfNMIh/G','2025-11-06 07:41:23','2025-11-01 20:57:09'),(20,'Dr. Daves Tonga','admin@bicol-u.edu.ph','$2y$12$QhBJTrYIzFyCJAF925T3me/46cL79nCx0OdYnjixUVHhZX7feT9gS',NULL,NULL),(21,'Cielo Jaylo','staff1@bicol-u.edu.ph','$2y$12$p826DCJhu2KvY1GKTBQCRekicMZQzLgZAI94ibIMG/2oe5JTTLu42',NULL,NULL),(22,'Alita Lozano','staff2@bicol-u.edu.ph','$2y$12$ac9hKoBh.2J8HUupcQaCletQB5MxQImPh8BDE0zG5d2YXPZvUwNYK',NULL,NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storage` (
  `storage_id` int NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `storage_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storage_id`),
  KEY `fk_storage_document` (`document_id`),
  KEY `fk_storage_staff` (`staff_id`),
  CONSTRAINT `fk_storage_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_storage_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage`
--

LOCK TABLES `storage` WRITE;
/*!40000 ALTER TABLE `storage` DISABLE KEYS */;
INSERT INTO `storage` VALUES (1,3,17,'2025-09-04 08:39:47'),(2,4,17,'2025-09-04 09:17:23'),(3,5,17,'2025-09-04 09:24:34'),(4,6,17,'2025-09-04 10:08:55'),(5,7,17,'2025-09-05 13:07:27'),(6,8,17,'2025-09-05 13:09:00'),(7,9,17,'2025-09-05 13:09:50'),(10,12,17,'2025-09-05 14:24:00'),(11,13,17,'2025-09-05 14:24:36'),(12,14,17,'2025-09-16 08:03:37'),(13,15,17,'2025-09-21 01:47:48'),(14,16,17,'2025-10-03 13:23:14'),(15,17,17,'2025-10-08 11:37:02'),(16,18,17,'2025-10-12 17:42:36'),(18,20,17,'2025-10-15 14:55:05'),(43,20,17,'2025-11-05 21:31:34'),(48,20,17,'2025-11-05 21:41:44'),(56,20,17,'2025-11-06 07:08:56'),(57,20,17,'2025-11-06 07:18:23'),(58,3,17,'2025-11-06 09:55:47'),(63,20,17,'2025-11-06 22:26:05');
/*!40000 ALTER TABLE `storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ifilms_database'
--

--
-- Dumping routines for database 'ifilms_database'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-07  9:07:24
