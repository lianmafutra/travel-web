-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_travel
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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi_tujuan` int(11) DEFAULT NULL,
  `lokasi_keberangkatan` int(11) DEFAULT NULL,
  `mobil_id` int(11) DEFAULT NULL,
  `supir_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_jadwal_lokasi_2` (`lokasi_keberangkatan`),
  KEY `FK_jadwal_lokasi` (`lokasi_tujuan`),
  KEY `FK_jadwal_mobil` (`mobil_id`),
  KEY `FK_jadwal_supir` (`supir_id`),
  CONSTRAINT `FK_jadwal_lokasi` FOREIGN KEY (`lokasi_tujuan`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_jadwal_lokasi_2` FOREIGN KEY (`lokasi_keberangkatan`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_jadwal_mobil` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_jadwal_supir` FOREIGN KEY (`supir_id`) REFERENCES `supir` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
INSERT INTO `jadwal` VALUES (13,5,10,1,3,688888,'16:15:00','2023-02-26 00:00:00','2023-02-03 18:35:13','2023-02-04 00:21:24'),(14,10,5,2,3,12323,'12:50:00','2023-02-10 00:00:00','2023-02-03 18:36:20','2023-02-03 18:46:26'),(15,10,5,37,3,79000,'12:00:00','2023-02-25 00:00:00','2023-02-25 05:16:49','2023-02-25 05:16:49');
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursi_mobil`
--

DROP TABLE IF EXISTS `kursi_mobil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kursi_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobil_id` int(11) NOT NULL,
  `nama` char(10) DEFAULT '',
  `posisi` int(11) DEFAULT NULL,
  `tipe` enum('KOSONG','SUPIR','PENUMPANG') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_kursi_mobil_mobil` (`mobil_id`),
  CONSTRAINT `FK_kursi_mobil_mobil` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursi_mobil`
--

LOCK TABLES `kursi_mobil` WRITE;
/*!40000 ALTER TABLE `kursi_mobil` DISABLE KEYS */;
INSERT INTO `kursi_mobil` VALUES (2,1,'Supir',3,'SUPIR','2023-02-04 15:06:04','2023-02-06 14:50:35'),(3,1,'A1',1,'PENUMPANG','2023-02-04 15:06:04','2023-02-04 16:58:44'),(4,1,NULL,2,'KOSONG','2023-02-04 15:06:05','2023-02-06 14:50:45'),(5,1,'A3',5,'PENUMPANG','2023-02-04 15:06:05','2023-02-04 16:34:03'),(6,1,'A6',8,'PENUMPANG','2023-02-04 15:06:06','2023-02-04 16:52:27'),(11,1,'A4',6,'PENUMPANG','2023-02-04 16:46:57','2023-02-04 16:50:04'),(12,1,'A5',7,'PENUMPANG','2023-02-04 16:47:20','2023-02-04 16:51:34'),(13,1,'A7',9,'PENUMPANG','2023-02-04 16:47:45','2023-02-04 16:56:52'),(14,1,'A8',10,'PENUMPANG','2023-02-04 16:58:17','2023-02-04 16:58:24'),(15,1,'A9',11,'PENUMPANG','2023-02-04 17:06:28','2023-02-04 17:06:28'),(16,1,'A10',11,'PENUMPANG','2023-02-04 17:18:01','2023-02-04 17:18:01'),(17,1,'A2',4,'PENUMPANG','2023-02-04 17:20:08','2023-02-04 17:20:08'),(18,2,'A1',1,'PENUMPANG','2023-02-04 17:22:56','2023-02-04 17:22:56'),(19,2,'supir',2,'SUPIR','2023-02-04 17:23:14','2023-02-04 17:23:14'),(20,2,'A2',3,'PENUMPANG','2023-02-04 17:23:44','2023-02-04 17:23:44'),(21,2,'A3',3,'PENUMPANG','2023-02-06 21:11:44','2023-02-06 21:11:44'),(22,37,'A1',1,'PENUMPANG','2023-02-25 05:17:21','2023-02-25 05:17:21'),(23,37,'A2',2,'PENUMPANG','2023-02-25 05:17:30','2023-02-25 05:17:30'),(24,37,'Supir',3,'SUPIR','2023-02-25 05:17:45','2023-02-25 05:17:45'),(25,37,'A3',4,'PENUMPANG','2023-02-25 06:55:35','2023-02-25 06:55:35'),(26,1,'SUPIR',77,'SUPIR','2023-03-18 01:11:57','2023-03-18 01:11:57'),(27,1,NULL,12,'KOSONG','2023-03-18 01:12:04','2023-03-18 01:12:04'),(28,1,'',67,'KOSONG','2023-03-18 01:14:42','2023-03-18 01:14:42'),(29,1,'',1,'KOSONG','2023-03-18 01:14:51','2023-03-18 01:14:51'),(30,1,'',100000,'KOSONG','2023-03-18 01:14:59','2023-03-18 01:14:59'),(31,1,'ok',1,'PENUMPANG','2023-03-18 01:15:26','2023-03-18 01:15:26'),(32,1,'SUPIR',1,'SUPIR','2023-03-18 01:15:35','2023-03-18 01:15:35');
/*!40000 ALTER TABLE `kursi_mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursi_pesanan`
--

DROP TABLE IF EXISTS `kursi_pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kursi_pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` int(11) NOT NULL DEFAULT '0',
  `kursi_mobil_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_kursi_pesanan_kursi_mobil` (`kursi_mobil_id`),
  KEY `FK_kursi_pesanan_pesanan` (`pesanan_id`),
  CONSTRAINT `FK_kursi_pesanan_kursi_mobil` FOREIGN KEY (`kursi_mobil_id`) REFERENCES `kursi_mobil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_kursi_pesanan_pesanan` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursi_pesanan`
--

LOCK TABLES `kursi_pesanan` WRITE;
/*!40000 ALTER TABLE `kursi_pesanan` DISABLE KEYS */;
INSERT INTO `kursi_pesanan` VALUES (1,1,17,'2023-03-06 16:47:21','2023-03-06 16:47:21'),(2,1,12,'2023-03-06 16:47:21','2023-03-06 16:47:21'),(3,2,18,'2023-03-06 19:49:17','2023-03-06 19:49:17'),(4,2,21,'2023-03-06 19:49:17','2023-03-06 19:49:17'),(5,3,14,'2023-03-06 19:50:14','2023-03-06 19:50:14'),(6,4,20,'2023-03-18 01:15:59','2023-03-18 01:15:59');
/*!40000 ALTER TABLE `kursi_pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokasi`
--

DROP TABLE IF EXISTS `lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokasi`
--

LOCK TABLES `lokasi` WRITE;
/*!40000 ALTER TABLE `lokasi` DISABLE KEYS */;
INSERT INTO `lokasi` VALUES (5,'Palembang','2023-01-06 07:28:05','2023-02-03 17:55:45'),(10,'Padang','2023-02-03 17:55:50','2023-02-03 17:55:50');
/*!40000 ALTER TABLE `lokasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_03_19_102456_create_permission_tables',1),(6,'2022_03_29_105225_create_settings_table',1),(7,'2016_06_01_000001_create_oauth_auth_codes_table',2),(8,'2016_06_01_000002_create_oauth_access_tokens_table',2),(9,'2016_06_01_000003_create_oauth_refresh_tokens_table',2),(10,'2016_06_01_000004_create_oauth_clients_table',2),(11,'2016_06_01_000005_create_oauth_personal_access_clients_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobil`
--

DROP TABLE IF EXISTS `mobil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `supir_id` int(11) DEFAULT NULL,
  `mobil_jenis_id` int(11) DEFAULT NULL,
  `kolom_kursi` int(11) DEFAULT NULL COMMENT 'Jumlah grid kolom kursi ',
  `plat` char(50) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mobil_mobil_jenis` (`mobil_jenis_id`),
  CONSTRAINT `FK_mobil_mobil_jenis` FOREIGN KEY (`mobil_jenis_id`) REFERENCES `mobil_jenis` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil`
--

LOCK TABLES `mobil` WRITE;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` VALUES (1,'Suzuki APV',5,3,3,'B 981 OPL','images/rzesvPEAY5kcxBWPhUC2pKe0uKaJSL0hVYdWWogm.jpg',NULL,'2023-01-03 18:06:46','2023-03-17 14:15:49'),(2,'Toyota Hiace',3,1,3,'B 982 OPL','images/UmC4OKBTkbaa4ITr1hXtoAGfR6pVwwGYsrWiAR7n.jpg',NULL,'2023-01-03 18:06:46','2023-02-06 21:11:48'),(3,'Isuzu Elf Microbus',3,3,2,'B 983 OPL','images/h69id47xWAfdayZR6RcRJMxpOB2vIQCgBLUUKSBK.jpg',NULL,'2023-01-03 18:06:46','2023-02-06 18:07:05'),(37,'Hyundai H-1',3,3,3,'dqwdwqd','images/GdNf7d0codvGdCn87qDAF6RSP7JKlxTtckNlnv25.jpg',NULL,'2023-02-03 16:27:17','2023-03-18 00:52:38'),(38,'baru',1,1,NULL,'dadwqdq','images/xXdPRstza9KSP7xSxjawZE12fKVL8kuhLsLSMXsH.webp',NULL,'2023-03-10 21:27:29','2023-03-17 14:23:23'),(39,'baru aja',3,3,NULL,'dqwdqwd','images/EfbQChCO0DwtimRNvyevV5vqkcUXKhhiLZOrL09G.jpg',NULL,'2023-03-10 21:29:18','2023-03-17 14:23:12');
/*!40000 ALTER TABLE `mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobil_jenis`
--

DROP TABLE IF EXISTS `mobil_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobil_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil_jenis`
--

LOCK TABLES `mobil_jenis` WRITE;
/*!40000 ALTER TABLE `mobil_jenis` DISABLE KEYS */;
INSERT INTO `mobil_jenis` VALUES (1,'BUS','2023-01-03 16:58:25','2023-01-03 16:58:26'),(3,'Mini Bus','2023-03-10 21:22:37','2023-03-10 21:22:54');
/*!40000 ALTER TABLE `mobil_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('03c7596d2780072131b753c28807843584d3f9130bd63718fd5d0d90e3469eea75fd2b5982f7d449',1,1,'travel_app','[]',0,'2023-02-11 17:17:38','2023-02-11 17:17:38','2024-02-12 00:17:38'),('10d70da786fc2bc9f33f01b7490abb1a630d8b57c28fd84f40601b962cd3815bb288fd08dd5b416d',1,1,'travel_app','[]',0,'2023-02-16 14:36:02','2023-02-16 14:36:02','2024-02-16 21:36:02'),('1d8b70399494a083c807d53036bec668a3acd6d0a705e95ac19d9ef157f1e7a20398f96465602b2e',1,1,'travel_app','[]',0,'2023-02-11 15:46:29','2023-02-11 15:46:29','2024-02-11 22:46:29'),('2593862547ba1771d6f2e9f30948fa6a322f61b52d699e9886d9a81cf036bea86611865b75584971',4,1,'travel_app','[]',1,'2023-03-06 19:09:43','2023-03-06 19:10:04','2024-03-07 02:09:43'),('289b4bd8fe069d6e10599d24d648c44edf7736191fb45ba73b1c9b81004ca94763f2d3c75c05b6f0',2,1,'travel_app','[]',0,'2023-02-25 07:40:39','2023-02-25 07:40:39','2024-02-25 14:40:39'),('292e35df12aaff18dd415a5faba95ea393b96d418711c9d29d8556d2b63eed64787e0ee3f63a1a96',1,1,'travel_app','[]',0,'2023-02-09 15:04:00','2023-02-09 15:04:00','2024-02-09 22:04:00'),('2f4c87012fc3d82dcbf02502d5aae6333ae614b0882e3f89e595f6bbac52679c5f2ad2cab26461c5',3,1,'travel_app','[]',1,'2023-03-06 18:49:31','2023-03-06 18:50:51','2024-03-07 01:49:31'),('307e59ebccfe268ad0a389e059041648390c9e4a794d857208e588939506144cd31ce142be75f314',14,7,'travel_app','[]',0,'2023-03-18 00:46:36','2023-03-18 00:46:36','2024-03-18 07:46:36'),('36ee42efde43c78eea084e150c5fbfbbbfb5c2d24bc3a3da74a5c7a4c989a64cd5a453f625f2553a',14,7,'travel_app','[]',0,'2023-03-18 03:58:08','2023-03-18 03:58:08','2024-03-18 10:58:08'),('3887c864f1ae07210d7f9987c319248563035977a5f6f455504966a59ef8d01cf4b820a38b7fdce2',2,1,'travel_app','[]',0,'2023-02-23 16:23:34','2023-02-23 16:23:34','2024-02-23 23:23:34'),('3a1535eb1f224bfc5fffe5edb36f98844b1f56c5b15806d8294a9dc1c60dfe090b63f52b0661fe48',2,1,'travel_app','[]',0,'2023-02-23 16:02:26','2023-02-23 16:02:26','2024-02-23 23:02:26'),('3b2c33b0618453be7049250c3d0dd86dc360a0f73fd1cf0986540916785c00886421d106b38503d9',1,1,'travel_app','[]',0,'2023-02-11 17:36:33','2023-02-11 17:36:33','2024-02-12 00:36:33'),('3cb0d2700b861a3b85ba02199f4c3cd938f505235e0ee72bd2ac43e2c2e234d8a6ca265c721fd0de',1,1,'travel_app','[]',0,'2023-02-12 11:33:36','2023-02-12 11:33:36','2024-02-12 18:33:36'),('4e9f1bde1b776ef28893d74e36c9866c06d7818c7e7908135459c28d3765f5ddfea4253b3d9910aa',2,1,'travel_app','[]',0,'2023-02-25 00:17:14','2023-02-25 00:17:15','2024-02-25 07:17:14'),('53e29bdb29478503debc767f2769a683d35e78231b88354348029ad2ef209a2ce68c3abcd4a43c7c',1,1,'travel_app','[]',0,'2023-02-11 17:13:42','2023-02-11 17:13:42','2024-02-12 00:13:42'),('56dd822793b5b5dee5a4751c613aabcaffc6f0baf426178f71b3fecebe111314f9d9ec90005ad801',2,1,'travel_app','[]',0,'2023-02-25 00:24:19','2023-02-25 00:24:19','2024-02-25 07:24:19'),('575e45d98aebcba5956296062286a8845831fed35e3fc5b18cf587d3ec9b498c68b65640a5a6d6e4',33,1,'travel_app','[]',0,'2023-02-25 08:15:21','2023-02-25 08:15:21','2024-02-25 15:15:21'),('585f557ba1380dcf4e70fd59137fa83f6fb3862f6f6b1482d24861cfbf982b9565fcea96c43582ea',2,1,'travel_app','[]',0,'2023-02-25 00:46:19','2023-02-25 00:46:19','2024-02-25 07:46:19'),('5a1850b54968f77b1a6e8be5d1c740dae2142f8a9b64ebfeb0645e32bd41f939c5cf2a549c4aa662',1,1,'travel_app','[]',0,'2023-02-16 14:35:46','2023-02-16 14:35:46','2024-02-16 21:35:46'),('6188d3c45f5de558f1ac2d946c7e49abef941e69bb9a96cd7518f55aa885d6c0cbd6538bfc568ec8',1,1,'travel_app','[]',0,'2023-02-13 15:39:02','2023-02-13 15:39:03','2024-02-13 22:39:02'),('63d27544b7fb53a9080cae99ed1cb86c21eb027fbc31c6a99468c8d8ebf70ef8f2f297b667504156',1,1,'travel_app','[]',0,'2023-02-14 13:54:21','2023-02-14 13:54:21','2024-02-14 20:54:21'),('65ea2a29013f632f7c6c7a25650796adf69748f27ee9ced394de2974ee13046abfaa8cc886ced46a',1,1,'travel_app','[]',0,'2023-02-11 17:17:45','2023-02-11 17:17:45','2024-02-12 00:17:45'),('6bc0f1b3c6681772e8cd4b3d49cc15df389a9ea74802e08f358f153bb01d518199aa67284be37f15',2,1,'travel_app','[]',0,'2023-02-25 07:39:35','2023-02-25 07:39:35','2024-02-25 14:39:35'),('6d4e9ab0c34081549f2355e7ef2e91e6ab2831339950f67e01e202ee1c51dba5c192460c85ccc85d',1,1,'travel_app','[]',0,'2023-02-11 15:39:02','2023-02-11 15:39:02','2024-02-11 22:39:02'),('6e3cb3be82c62a8b53b8370bb201c19edd508e95168d3c66631578dbb75d4bb8bedc7cee6ed04f80',2,1,'travel_app','[]',1,'2023-03-06 17:56:09','2023-03-06 18:05:37','2024-03-07 00:56:09'),('718b4f9fca75c9ec06fe07d499772df4798771a2655b0b9f91f30f07f1a64b46fa5ebf2e8d92887e',1,1,'travel_app','[]',0,'2023-02-11 15:44:37','2023-02-11 15:44:37','2024-02-11 22:44:37'),('72fe1b674f3cf943b3d0a325ca1f691594540bd71af341bd2e4d4f78c142ede24d75dbf882dc22d3',14,7,'travel_app','[]',0,'2023-03-17 23:48:12','2023-03-17 23:48:12','2024-03-18 06:48:12'),('74217570ee3fcd6c3fff49118a8246d32cb4e64f137e8c2e79cbb298cecc8b57009de308949c572c',2,1,'travel_app','[]',1,'2023-03-06 16:44:22','2023-03-06 17:46:08','2024-03-06 23:44:22'),('77bcadf2dc90bbcea0b015a9ac7b42ad171ce3ee37e648ac4989ffae12fd53adc73d38d4ff823d30',1,1,'travel_app','[]',0,'2023-02-18 01:39:57','2023-02-18 01:39:58','2024-02-18 08:39:57'),('7bd498ce674d6d6e1e79d9895eb9145ad455399de3ef0502950e9eebe95237a73fafd675c849274d',2,1,'travel_app','[]',0,'2023-02-25 00:21:19','2023-02-25 00:21:19','2024-02-25 07:21:19'),('7ee10a50193dd395b0d78140597eb7cf227e5f80b74514b333fe8a06e5089d848fb809b470d309b7',1,1,'travel_app','[]',0,'2023-02-11 15:01:56','2023-02-11 15:01:57','2024-02-11 22:01:56'),('7ff5ebabf66764699499565da27158bbc85a06dc1cc8d6516277444dc43d14582631c8be25d9dc7d',1,1,'travel_app','[]',0,'2023-02-14 13:38:45','2023-02-14 13:38:45','2024-02-14 20:38:45'),('80d65c63dcb2adc71398f7ff28e42787b907e4238dff4cd5e86ba272e40f24312019c05d564c5541',14,1,'travel_app','[]',0,'2023-02-25 00:19:43','2023-02-25 00:19:43','2024-02-25 07:19:43'),('89e0ea7111131e8b09ec6262d6506f66c3bc2be00536bac24401b62d567a5c566f1eb222d7a70f36',1,1,'travel_app','[]',0,'2023-02-09 14:52:00','2023-02-09 14:52:01','2024-02-09 21:52:00'),('8bccb9caefe9f4a765b6ade9fba1ef36e18c7f45879dff19db8f2becbf7ba70e4b7d90213d78e04f',2,1,'travel_app','[]',0,'2023-02-25 00:18:12','2023-02-25 00:18:12','2024-02-25 07:18:12'),('8cd02157e1e86b1bd08a80849ca63f815e2875b14df0889d938e4bcfb011a96e69fb629284c011a7',1,1,'travel_app','[]',0,'2023-02-11 15:50:51','2023-02-11 15:50:51','2024-02-11 22:50:51'),('8fdeca1413146b1e608475bfc898598868b85112ed51aa5ceb29ca27aea9dc7c98a27e5264296765',2,1,'travel_app','[]',1,'2023-02-25 07:48:20','2023-02-25 07:48:26','2024-02-25 14:48:20'),('91979814deebdf89d047e504f7ef6b1d7266217a3e3b405e23f8ffb393fb3a4f67224664dfb2e50f',1,1,'travel_app','[]',0,'2023-02-16 15:37:05','2023-02-16 15:37:05','2024-02-16 22:37:05'),('9c8e9f9149ea661736c888aa480008aa05742b7bfd149c586b9a0d88fdd6f67c90c7518192bdd658',2,1,'travel_app','[]',0,'2023-02-25 02:32:14','2023-02-25 02:32:14','2024-02-25 09:32:14'),('a86e1531d69bc66d8a23942106f87b9db72ba673fb49fdb137b1f791c8e0c1e158f9910e9f8e9452',5,1,'travel_app','[]',0,'2023-03-06 19:10:57','2023-03-06 19:10:57','2024-03-07 02:10:57'),('ad38a96b6285d9cff1737080a7ebc0bd12dbbae9913fc696d133631d76ffd7732b57b83d327df083',1,1,'travel_app','[]',0,'2023-02-11 15:36:16','2023-02-11 15:36:16','2024-02-11 22:36:16'),('afbdd9837a1af9667087ec608153f4337c100795e2c861b96ab963b08519ed4818d9f27da16626b9',1,1,'travel_app','[]',0,'2023-02-11 17:17:51','2023-02-11 17:17:52','2024-02-12 00:17:51'),('b48975289428de21c61e56bcb8c6079caafd8c61cb3418ec85a4102b2a3a3bbd2f853c3f8cddc9af',2,1,'travel_app','[]',0,'2023-02-23 16:02:07','2023-02-23 16:02:07','2024-02-23 23:02:07'),('b5280d754d3184bc5a4f9006e8903f40e7d5f822f502cb95e0ead1fb9b88f91396e2610385f1a5b0',1,1,'travel_app','[]',0,'2023-02-11 17:37:34','2023-02-11 17:37:35','2024-02-12 00:37:34'),('b61d43b30b49a70dadcdad1d6cb066b6f6c8e1de39f7943f417fd634ac606d34d1f2205bb89efb74',2,1,'travel_app','[]',1,'2023-02-25 07:48:38','2023-02-25 07:48:47','2024-02-25 14:48:38'),('b75d978f130638ac2ba9aba9731f76ad75b0318f3b5d816e6bcbfc53a2df898026bcbe23278b5677',1,1,'travel_app','[]',0,'2023-02-11 17:27:18','2023-02-11 17:27:18','2024-02-12 00:27:18'),('bfc4b48225ab4b988b96c3906fb7cfdd5c0372e6f10e082b245288a10521f2b537b76c9bdfffb08e',1,1,'travel_app','[]',0,'2023-02-11 17:35:50','2023-02-11 17:35:50','2024-02-12 00:35:50'),('c256fe93bb308e892dba74926fa47ca663a0b4be0ac86361d8d384f130ff0092b89268939775349c',1,1,'travel_app','[]',0,'2023-02-14 13:50:55','2023-02-14 13:50:55','2024-02-14 20:50:55'),('c3afac7e373c98bd89eda848e81d18bd590a07d8b404da5c8321ab0d1cb524642bf26a0bc88b0f74',1,1,'travel_app','[]',0,'2023-02-23 15:40:53','2023-02-23 15:40:53','2024-02-23 22:40:53'),('c4b587a22d23f61128a91c2020b2c0e0e43264bebac759f9a105989a0f3f74a6be4984de3f640203',4,1,'travel_app','[]',1,'2023-03-06 19:06:14','2023-03-06 19:06:39','2024-03-07 02:06:14'),('c77d26eb11c07de6638c242cd644407b625d2604074768847dd2fe3ddaea61298e44263d48a4018b',4,1,'travel_app','[]',1,'2023-03-06 18:55:18','2023-03-06 18:56:44','2024-03-07 01:55:18'),('d0b465451d6b171692a78247a29f547c9673b52626fe8804dd0308116ae546f6b5fe860add5dffcf',1,1,'travel_app','[]',0,'2023-02-09 14:53:08','2023-02-09 14:53:08','2024-02-09 21:53:08'),('dae505df5c4f1d34196fbc0abb682c82c8f90ab83d67375f1b7b1039dba86180cb2449962c0d817c',4,1,'travel_app','[]',1,'2023-03-06 18:58:14','2023-03-06 19:00:21','2024-03-07 01:58:14'),('dd75b1757813cbaef8ce3563334ab50c624830bb6a4b707dbe2435005a086d576b30f1e94b2086b2',2,1,'travel_app','[]',0,'2023-02-25 00:26:37','2023-02-25 00:26:37','2024-02-25 07:26:37'),('e29e07ce915c5d4efc287b1d7d8e40358c2b8e774191a0e02fe41e7d37481e49e8290a02c7fb8b60',1,1,'travel_app','[]',0,'2023-02-20 16:28:30','2023-02-20 16:28:30','2024-02-20 23:28:30'),('e4df1f87d07ef65ae47cec051b3a7c08d48b6f2e97eeabf0f6bdecf96e9ed9b0808219e88233c4c9',2,1,'travel_app','[]',1,'2023-02-25 07:46:44','2023-02-25 07:47:06','2024-02-25 14:46:44'),('e500ce2bf94dee403b36e3d4934c5a9c5b453dd7fc6b8fafe0863983d07a194e83c0ba122621bec1',13,1,'travel_app','[]',0,'2023-02-23 19:01:10','2023-02-23 19:01:10','2024-02-24 02:01:10'),('e58cd519ba78be5ae147a76415721e224790d02b1ef72d2602570fbe0284aaff66fdfb79b1c795a7',2,1,'travel_app','[]',0,'2023-02-25 07:45:18','2023-02-25 07:45:19','2024-02-25 14:45:18'),('e72e9e3b5387adbfcafbe4669cf7f4b9a72211b2720df49dfff137039278b52230fb5e6d84d7c765',1,1,'travel_app','[]',0,'2023-02-11 15:46:34','2023-02-11 15:46:34','2024-02-11 22:46:34'),('ec68e7623e0d05ea7abc495953f678545cf9b3dd7d4f15d83b9e2bad912dfdd970af2a0bff1af5c9',1,1,'travel_app','[]',0,'2023-02-17 14:56:47','2023-02-17 14:56:48','2024-02-17 21:56:47'),('f2f01032fea2b09b5b2d351f5af359d21106e5d027d140c38515b41742609b1b1b1f210e565fa62a',1,1,'travel_app','[]',0,'2023-02-12 11:01:18','2023-02-12 11:01:18','2024-02-12 18:01:18'),('f4fca6a4d2cfb93437151966015dc2ebd33668421caea4fb543d04a2443d4a941367803ffbd7ec53',1,1,'travel_app','[]',0,'2023-02-14 13:43:51','2023-02-14 13:43:51','2024-02-14 20:43:51'),('fce27714b66e9ecadcaae575bbb1cf3247aac2d8b37de66df90339ed01b0168eafbac8307d9d2ad7',1,1,'travel_app','[]',0,'2023-02-11 17:14:26','2023-02-11 17:14:26','2024-02-12 00:14:26');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,' Personal Access Client','PgQEmkEv4ekJ0jYaVzlniQordOoNDUamae5XPU7J',NULL,'http://localhost',1,0,0,'2023-02-07 23:30:23','2023-02-07 23:30:23'),(2,NULL,' Password Grant Client','k5zn28UVAZQ6GWjTBSH8k7dRE0eSbo01ICoyyBbD','users','http://localhost',0,1,0,'2023-02-07 23:30:23','2023-02-07 23:30:23'),(3,NULL,' Personal Access Client','iXWPoI1qnSY8xBWJVXujsKVNjO70usSDKmYrVIpB',NULL,'http://localhost',1,0,0,'2023-03-06 19:18:59','2023-03-06 19:18:59'),(4,NULL,' Password Grant Client','nVb0pddypEUy93O8lZZXZD2uyoqyNdeKSj92XmwF','users','http://localhost',0,1,0,'2023-03-06 19:18:59','2023-03-06 19:18:59'),(5,NULL,' Personal Access Client','VFP9YKP0vK3CiqHy1sy8sbkkHJ9FA55WouPIWpwL',NULL,'http://localhost',1,0,0,'2023-03-06 19:48:37','2023-03-06 19:48:37'),(6,NULL,' Password Grant Client','whm3C6qIY4b5mlV7LXfQvPbMxkjAXy4bLUBQKSMj','users','http://localhost',0,1,0,'2023-03-06 19:48:37','2023-03-06 19:48:37'),(7,NULL,' Personal Access Client','O1hMZKZTAde97ceqaDtEVdzaccTNYzRQGwTGj1bK',NULL,'http://localhost',1,0,0,'2023-03-15 08:20:19','2023-03-15 08:20:19'),(8,NULL,' Password Grant Client','fnTjGIoh0WksQgSdnje0ZJc9syIUCTmHhVdRTjVc','users','http://localhost',0,1,0,'2023-03-15 08:20:19','2023-03-15 08:20:19');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2023-02-07 23:30:23','2023-02-07 23:30:23'),(2,3,'2023-03-06 19:18:59','2023-03-06 19:18:59'),(3,5,'2023-03-06 19:48:37','2023-03-06 19:48:37'),(4,7,'2023-03-15 08:20:19','2023-03-15 08:20:19');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_group`
--

DROP TABLE IF EXISTS `permission_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_group` (
  `id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_group`
--

LOCK TABLES `permission_group` WRITE;
/*!40000 ALTER TABLE `permission_group` DISABLE KEYS */;
INSERT INTO `permission_group` VALUES (1,2,'pengajuan','2023-01-18 09:28:58','2023-01-18 09:28:58');
/*!40000 ALTER TABLE `permission_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'filemanager','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(2,'read module','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(3,'delete setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(4,'update setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(5,'read setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(6,'create setting','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(7,'delete user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(8,'update user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(9,'read user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(10,'create user','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(11,'delete role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(12,'update role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(13,'read role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(14,'create role','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(15,'delete permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(16,'update permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(17,'read permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(18,'create permission','web','2022-11-18 03:50:20','2022-11-18 03:50:20'),(19,'view_data_pegawai','web','2022-11-18 04:16:07','2022-11-18 04:16:07'),(20,'pengajuan menu','web','2022-11-18 04:41:26','2022-11-29 01:42:51'),(21,'pengajuan create','web','2022-11-22 02:08:40','2022-11-22 02:08:40'),(22,'pengajuan store','web','2022-11-22 07:59:32','2022-11-22 07:59:32'),(23,'pengajuan destroy','web','2022-11-22 07:59:43','2022-11-22 07:59:43'),(24,'pengajuan update','web','2022-11-22 07:59:50','2022-11-22 07:59:50'),(25,'profile menu','web','2022-11-29 01:43:03','2022-11-29 01:43:03'),(26,'pengajuan index','web','2022-11-29 01:43:44','2022-11-29 01:43:44'),(27,'pengajuan show','web','2022-12-03 09:27:42','2022-12-03 09:27:42'),(28,'pengajuan verifikasi kirim','web','2022-12-05 02:25:00','2022-12-05 02:38:16'),(29,'pengajuan verifikasi index','web','2022-12-05 02:38:59','2022-12-05 02:38:59'),(31,'pengajuan selesai','web','2022-12-06 03:06:08','2022-12-06 03:06:08'),(32,'pengajuan filter','web','2022-12-06 18:14:56','2022-12-06 18:14:56'),(33,'master rekom pegawai','web','2022-12-07 04:02:14','2022-12-07 04:02:31');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',1,'travel_app','80e8f772feb0e3f932ae49ef1151444b023c3bc7ac616d1f62f46166c7ea1598','[\"*\"]',NULL,'2023-02-09 14:50:26','2023-02-09 14:50:26');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesanan`
--

DROP TABLE IF EXISTS `pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` char(50) NOT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `mobil_id` int(11) DEFAULT NULL,
  `supir_id` int(11) DEFAULT NULL,
  `status_pesanan` enum('SELESAI','DITOLAK','PROSES','DIBATALKAN') DEFAULT 'PROSES',
  `pesan_tolak` text,
  `status_pembayaran` enum('LUNAS','BELUM','EXPIRED') DEFAULT 'BELUM',
  `tgl_pembayaran` datetime DEFAULT NULL,
  `tgl_keberangkatan` datetime DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `rating_komen` text,
  `rating_nilai` int(11) NOT NULL DEFAULT '0' COMMENT 'Rating bintang pengguna',
  `rating_created_at` timestamp NULL DEFAULT NULL,
  `total_biaya` int(11) NOT NULL DEFAULT '0',
  `bukti_pembayaran` text COMMENT 'file bukti pembayaran',
  `id_kursi_pesanan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `kode_pesanan` (`kode_pesanan`),
  KEY `FK_pesanan_users` (`user_id`),
  KEY `FK_pesanan_mobil` (`mobil_id`),
  KEY `FK_pesanan_jadwal` (`jadwal_id`),
  CONSTRAINT `FK_pesanan_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pesanan_mobil` FOREIGN KEY (`mobil_id`) REFERENCES `mobil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pesanan_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesanan`
--

LOCK TABLES `pesanan` WRITE;
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
INSERT INTO `pesanan` VALUES (1,'HTXE4S',13,2,1,1,'SELESAI',NULL,'LUNAS','2023-03-06 23:47:21','2023-02-26 00:00:00','2023-03-06 23:47:21','Wahyu','082244261525','pelayanan baik',4,'2023-03-18 03:58:38',1377776,'images/F53F88Da26CQrzynCdd4WOmmgGnBf9IU7dVYibic.jpg','17,12','2023-03-06 16:47:21','2023-03-06 17:00:11'),(2,'FICWSI',14,5,2,NULL,'SELESAI',NULL,'BELUM','2023-03-07 02:49:17','2023-02-10 00:00:00','2023-03-07 02:49:17','lian','616494',NULL,0,'2023-03-18 03:58:37',24646,'images/hX1QFz7GnTkpaDQdBdA4q3C3uwaePBgcbQ70P3x4.jpg','18,21','2023-03-06 19:49:17','2023-03-06 19:49:24'),(3,'AOOIKT',13,5,1,NULL,'SELESAI',NULL,'BELUM','2023-03-07 02:50:14','2023-02-26 00:00:00','2023-03-07 02:50:14','lian','616494',NULL,0,'2023-03-18 03:58:37',688888,'images/10YtaIS6FRFwGOSETkycVY9YCpcq7DDJDwYueENP.jpg','14','2023-03-07 17:00:00','2023-03-06 19:50:20'),(4,'XTECN3',14,14,2,NULL,'SELESAI',NULL,'LUNAS','2023-03-18 08:15:59','2023-02-10 00:00:00','2023-03-18 08:15:59','ika sundarry','082244261525','ok',4,'2023-03-18 03:58:43',12323,'images/jDWmFBMlJe0CUYOEmm3dI9whBIzsOQztCwFmzJ7Z.jpg','20','2023-03-18 01:15:59','2023-03-18 03:58:25');
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekening`
--

DROP TABLE IF EXISTS `rekening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rekening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` char(50) DEFAULT NULL,
  `nama_pemilik` char(50) DEFAULT NULL,
  `no_rek` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekening`
--

LOCK TABLES `rekening` WRITE;
/*!40000 ALTER TABLE `rekening` DISABLE KEYS */;
INSERT INTO `rekening` VALUES (1,'BRI','Umam','121232442','082244261525','2023-01-03 15:08:51','2023-02-04 18:00:51'),(3,'BCA','Umam','23232323','082244261525','2023-01-03 15:08:51','2023-02-04 18:00:57');
/*!40000 ALTER TABLE `rekening` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'superadmin','web','2022-11-18 03:50:20','2022-11-18 03:50:20');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` enum('information','contact','payment','email','api') COLLATE utf8mb4_unicode_ci DEFAULT 'information',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'app_name','Travel','Application Short Name','text',NULL,'information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(2,'app_short_name','Travel','Application Name','text',NULL,'information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(3,'app_logo','storage/','Application Logo','file','png','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(4,'app_favicon','storage/','Application Favicon','file','png','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(5,'app_loading_gif','storage/','Application Loading Image','file','gif','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(6,'app_map_loaction','none','Application Map Location','textarea',NULL,'contact','2022-11-18 03:50:20','2023-01-18 03:51:15');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supir`
--

DROP TABLE IF EXISTS `supir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supir`
--

LOCK TABLES `supir` WRITE;
/*!40000 ALTER TABLE `supir` DISABLE KEYS */;
INSERT INTO `supir` VALUES (1,'Andi','082244261525',NULL,'2023-01-03 15:08:51','2023-01-06 07:29:32'),(3,'Udin','082244261525',NULL,'2023-01-03 15:08:51','2023-01-03 15:08:52'),(5,'Dedek','0823782632323',NULL,'2023-01-06 07:28:05','2023-01-07 10:23:49');
/*!40000 ALTER TABLE `supir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token_fcm`
--

DROP TABLE IF EXISTS `token_fcm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token_fcm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_token_fcm_users` (`user_id`),
  CONSTRAINT `FK_token_fcm_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token_fcm`
--

LOCK TABLES `token_fcm` WRITE;
/*!40000 ALTER TABLE `token_fcm` DISABLE KEYS */;
INSERT INTO `token_fcm` VALUES (7,5,'danP_9TMSbGiREKi_4TGm2:APA91bG_pOt9y4yWmMAUEdiwhMmDX2tqJ1CeZrrBjEiArRrHT_OC33L2fCqgOHPgGCJz-t-eudrqEtTKJlHS41a5GIA3jmLRRGdiFCCb93JAcIcI8QGVinZwJTek4ufY3GY7O7XRoGZ3','2023-03-06 19:10:58','2023-03-06 19:10:58'),(8,14,'fSn0KRs4RWSjrL7p7VKkO3:APA91bFzHI0d0lv3_wB9a52gLVbhJkDYIiX0PXkpvqKjYbrthDZBmV6aKBtLgYHXSEgBGk8N91dCzNF8QrZsRawRu_CrYNkFnjwtua4ej-LiChLJyz6rQl_OhYsj6m1luh4R7E7GGqMQ','2023-03-17 23:48:13','2023-03-17 23:48:13'),(9,14,'fQVETAHbQjS-JDeyBYX0Sn:APA91bHAK6p6h0FIG33a_E0cyyziGx_cwSL5kw7JZcHAor5mGoJCYeiger1NBaZBqcnIACrLAxn5k7zc9PiuhjEFz1c5u-GB-gyMC2PjZl4YUjF4LhlpXxN03e7aPT5TpB_VsT80ne-c','2023-03-18 03:58:09','2023-03-18 03:58:09');
/*!40000 ALTER TABLE `token_fcm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nama_lengkap` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hak_akses` enum('admin','owner','pelanggan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` char(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admintravel','Admin Travel','admin','admintravel@gmail.com','082244261525','Jl. Sunan Kalijaga RT. 16','L','images/RHok1WlgQl60nWbChl0hW0cCghk4aBNUVehhBdH5.jpg','$2y$10$dWYOrDcatC5kkYcTeXWAp.jXt5Xxax2m/YFmQoqfxpyUfqqpJ1RF.','hx7YDgc6jIx5gGPgx3nSNy0YsbIs9V2AVTFPcYsOg8teVnu7Q6SINnLTJ9qP','2022-11-23 09:04:52','2023-03-17 15:44:50'),(2,'','Wahyu','pelanggan','wahyu@gmail.com','082244261525','Jl. Sunan Kalijaga RT. 16','L','images/profile_superadmin.jpg','$2a$12$FeFOuSpZgnqVq8cLlUbfdup9JFvxwif6CVQ2kRSsiNL0JGiKRhah6','s9oosXYqvHBwdAfwuZHwRCCPVTcO9WLE7jnwsl4XQH4d1RlQpGK0kkQfvSEn','2022-11-23 09:04:52','2023-01-03 14:02:24'),(4,'joko@gmail.com','joko','pelanggan','joko@gmail.com','646494','gaysus','L','images/tZGqhCKDCPhicj3fywCRfdA2F3oQCfG2i2466dL0.jpg','$2y$10$2UMLHTfqkK8WuVeXkH466.28g3T1vxv.wGFR/HKvJBj3PbINVBVH6',NULL,'2023-03-06 18:55:11','2023-03-06 19:10:01'),(5,'lianmafutra@gmail.com','lian','pelanggan','lianmafutra@gmail.com','616494','hahaja','L','images/NiMYgZw2rUkrWyIOR9QAJ1425Lg9lnzJZVYxax73.jpg','$2y$10$ba5SlXVUJtcEWEVUold8Y.isd8HcN9jaT/psQFBpXnf2ODAq.xKyS',NULL,'2023-03-06 19:10:51','2023-03-06 19:10:51'),(10,'ownertravel2','Owner Travel','owner','ownertravel@gmail.com','0822442615251','Jl. Sunan Kalijaga RT. 16','L','images/profile_superadmin.jpg','$2y$10$Cy.6ektfWI/17XvZSbPv0u9Gj83T/YS3GHWxPVz8paYhoEsRsywxO','hx7YDgc6jIx5gGPgx3nSNy0YsbIs9V2AVTFPcYsOg8teVnu7Q6SINnLTJ9qP','2022-11-23 09:04:52','2023-03-17 14:58:22'),(11,'huda','huda faqihul hakim','admin',NULL,'3213213213',NULL,NULL,'images/oTg618VLtDIhBwB37Ok04mZ0Ww8uAFFGMS7a064O.jpg','$2y$10$afBt6U3W.ZXHuWdVQV7vB.BE5BzXXoAbyoxijkbYAKtPl/Ri14I4i',NULL,'2023-03-17 14:11:03','2023-03-17 14:46:26'),(13,'312321','21321','admin',NULL,'321321',NULL,NULL,'images/SbAambVs5fSzU0zaseMMk5d3adTWRwhjzcRg8Izm.webp','$2y$10$jXW4zYBVdwdWiiqjBvc2Fuv2CIt6A4QO7aziJMt2Rwi.5Gw6lGvLC',NULL,'2023-03-17 14:45:52','2023-03-17 14:57:50'),(14,'ika@gmail.com','ika sundarry',NULL,'ika@gmail.com','082244261525','sekernan','P','images/wUp2hcuXTdxIvWEpuwQGfFidTV0HCCdyGIZJpkaa.jpg','$2y$10$SRncGLxw1O9I05qMzmg/le4R5hoUMIkBqw8QSMiwvjjvOhAQUmz8a',NULL,'2023-03-17 23:48:06','2023-03-17 23:52:07');
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

-- Dump completed on 2023-03-18 11:01:07
