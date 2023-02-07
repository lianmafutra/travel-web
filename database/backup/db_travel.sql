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
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(500) NOT NULL,
  `parent_file_id` int(11) NOT NULL,
  `name_origin` text NOT NULL,
  `name_random` text NOT NULL,
  `path` varchar(500) NOT NULL,
  `size` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
INSERT INTO `jadwal` VALUES (13,5,10,1,3,688888,'16:15:00','2023-02-26 00:00:00','2023-02-03 18:35:13','2023-02-04 00:21:24'),(14,10,5,2,3,12323,'12:50:00','2023-02-10 00:00:00','2023-02-03 18:36:20','2023-02-03 18:46:26');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursi_mobil`
--

LOCK TABLES `kursi_mobil` WRITE;
/*!40000 ALTER TABLE `kursi_mobil` DISABLE KEYS */;
INSERT INTO `kursi_mobil` VALUES (2,1,'Supir',3,'SUPIR','2023-02-04 15:06:04','2023-02-06 14:50:35'),(3,1,'A1',1,'PENUMPANG','2023-02-04 15:06:04','2023-02-04 16:58:44'),(4,1,NULL,2,'KOSONG','2023-02-04 15:06:05','2023-02-06 14:50:45'),(5,1,'A3',5,'PENUMPANG','2023-02-04 15:06:05','2023-02-04 16:34:03'),(6,1,'A6',8,'PENUMPANG','2023-02-04 15:06:06','2023-02-04 16:52:27'),(11,1,'A4',6,'PENUMPANG','2023-02-04 16:46:57','2023-02-04 16:50:04'),(12,1,'A5',7,'PENUMPANG','2023-02-04 16:47:20','2023-02-04 16:51:34'),(13,1,'A7',9,'PENUMPANG','2023-02-04 16:47:45','2023-02-04 16:56:52'),(14,1,'A8',10,'PENUMPANG','2023-02-04 16:58:17','2023-02-04 16:58:24'),(15,1,'A9',11,'PENUMPANG','2023-02-04 17:06:28','2023-02-04 17:06:28'),(16,1,'A10',11,'PENUMPANG','2023-02-04 17:18:01','2023-02-04 17:18:01'),(17,1,'A2',4,'PENUMPANG','2023-02-04 17:20:08','2023-02-04 17:20:08'),(18,2,'A1',1,'PENUMPANG','2023-02-04 17:22:56','2023-02-04 17:22:56'),(19,2,'supir',2,'SUPIR','2023-02-04 17:23:14','2023-02-04 17:23:14'),(20,2,'A2',3,'PENUMPANG','2023-02-04 17:23:44','2023-02-04 17:23:44'),(21,2,'A3',3,'PENUMPANG','2023-02-06 21:11:44','2023-02-06 21:11:44');
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
  KEY `FK_kursi_pesanan_pesanan` (`pesanan_id`),
  KEY `FK_kursi_pesanan_kursi_mobil` (`kursi_mobil_id`),
  CONSTRAINT `FK_kursi_pesanan_kursi_mobil` FOREIGN KEY (`kursi_mobil_id`) REFERENCES `kursi_mobil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_kursi_pesanan_pesanan` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursi_pesanan`
--

LOCK TABLES `kursi_pesanan` WRITE;
/*!40000 ALTER TABLE `kursi_pesanan` DISABLE KEYS */;
INSERT INTO `kursi_pesanan` VALUES (1,1,3,'2023-02-05 02:09:56','2023-02-05 02:09:57'),(2,1,5,'2023-02-05 02:09:56','2023-02-05 02:09:57'),(3,1,6,'2023-02-05 02:09:56','2023-02-05 02:09:57'),(4,4,18,'2023-02-05 02:09:56','2023-02-05 02:09:57'),(5,3,12,'2023-02-05 02:09:56','2023-02-05 02:09:57');
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
  `kolom_kursi` int(11) DEFAULT NULL COMMENT 'Jumlah grid kolom kursi ',
  `plat` char(50) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil`
--

LOCK TABLES `mobil` WRITE;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` VALUES (1,'Suzuki APV',5,3,'B 981 OPL','images/Kq4jNcr5oxVuEExcGziebvByJYFQO8MbyjgVsoAk.jpg',NULL,'2023-01-03 18:06:46','2023-02-06 18:06:17'),(2,'Toyota Hiace',3,3,'B 982 OPL','images/UmC4OKBTkbaa4ITr1hXtoAGfR6pVwwGYsrWiAR7n.jpg',NULL,'2023-01-03 18:06:46','2023-02-06 21:11:48'),(3,'Isuzu Elf Microbus',3,2,'B 983 OPL','images/h69id47xWAfdayZR6RcRJMxpOB2vIQCgBLUUKSBK.jpg',NULL,'2023-01-03 18:06:46','2023-02-06 18:07:05'),(37,'Hyundai H-1',3,2,'dqwdwqd','images/GdNf7d0codvGdCn87qDAF6RSP7JKlxTtckNlnv25.jpg',NULL,'2023-02-03 16:27:17','2023-02-06 18:07:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil_jenis`
--

LOCK TABLES `mobil_jenis` WRITE;
/*!40000 ALTER TABLE `mobil_jenis` DISABLE KEYS */;
INSERT INTO `mobil_jenis` VALUES (1,'BAk','2023-01-03 16:58:25','2023-01-03 16:58:26'),(2,'ANGKOT','2023-01-03 16:58:25','2023-01-03 16:58:26');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,' Personal Access Client','PgQEmkEv4ekJ0jYaVzlniQordOoNDUamae5XPU7J',NULL,'http://localhost',1,0,0,'2023-02-07 23:30:23','2023-02-07 23:30:23'),(2,NULL,' Password Grant Client','k5zn28UVAZQ6GWjTBSH8k7dRE0eSbo01ICoyyBbD','users','http://localhost',0,1,0,'2023-02-07 23:30:23','2023-02-07 23:30:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2023-02-07 23:30:23','2023-02-07 23:30:23');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
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
  `status_pesanan` enum('SELESAI','DITOLAK','PROSES') DEFAULT 'PROSES',
  `status_pembayaran` enum('LUNAS','BELUM') DEFAULT 'BELUM',
  `tgl_pembayaran` datetime DEFAULT NULL,
  `tgl_keberangkatan` datetime DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  `nama` char(50) DEFAULT NULL,
  `kontak` char(50) DEFAULT NULL,
  `rating_nilai` int(11) DEFAULT NULL COMMENT 'Rating bintang pengguna',
  `rating_komen` text,
  `bukti_pembayaran` text COMMENT 'file bukti pembayaran',
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
INSERT INTO `pesanan` VALUES (1,'1BCGAH',13,2,1,NULL,'SELESAI','BELUM',NULL,'2023-02-05 01:10:29','2023-02-05 01:12:12','Lian Mafutra','082244261525',NULL,NULL,'bukti_transfer.jpg','2023-01-03 15:08:51','2023-02-06 14:48:49'),(3,'2BCGAH',13,3,1,NULL,'PROSES','LUNAS',NULL,'2023-02-05 01:10:29','2023-02-05 01:12:12','Andi Susanto','082244261525',NULL,NULL,NULL,'2023-01-03 15:08:51','2023-02-05 00:35:46'),(4,'3BCGAH',14,3,2,NULL,'DITOLAK','BELUM','2023-02-07 04:06:36','2023-02-05 01:10:29','2023-02-05 01:12:12','Andi Susanto','082244261525',NULL,NULL,NULL,'2023-01-03 15:08:51','2023-02-05 01:20:44');
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
INSERT INTO `settings` VALUES (1,'app_name','Do Batu Bara','Application Short Name','text',NULL,'information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(2,'app_short_name','Do Batu Bara','Application Name','text',NULL,'information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(3,'app_logo','storage/logo_kota.png','Application Logo','file','png','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(4,'app_favicon','storage/logo_kota.png','Application Favicon','file','png','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(5,'app_loading_gif','storage/logo_kota.png','Application Loading Image','file','gif','information','2022-11-18 03:50:20','2023-01-18 03:51:11'),(6,'app_map_loaction','none','Application Map Location','textarea',NULL,'contact','2022-11-18 03:50:20','2023-01-18 03:51:15');
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` char(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `jenkel` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admintravel','Admin Travel',NULL,'082244261525','Jl. Sunan Kalijaga RT. 16',NULL,'profile_superadmin.jpg','$2a$12$j/ZV5ZiFnRjrb23LbKbOE.rZ2CbfSLZ85RpkaurNxZnDLIEtmX14u','Tc7kVUAW72LPv0KLVIXOR9hZqbDLESOoG6L7rxeogph0BOeWXwjmCUGikpWc','2022-11-23 09:04:52','2023-01-03 14:02:24'),(2,'joko','Lian Mafutra',NULL,'082244261525','Jl. Sunan Kalijaga RT. 16',NULL,'profile_superadmin.jpg','$2a$12$j/ZV5ZiFnRjrb23LbKbOE.rZ2CbfSLZ85RpkaurNxZnDLIEtmX14u','Tc7kVUAW72LPv0KLVIXOR9hZqbDLESOoG6L7rxeogph0BOeWXwjmCUGikpWc','2022-11-23 09:04:52','2023-01-03 14:02:24'),(3,'ddaqwd','Jokow',NULL,'082244261525','Jl. Sunan Kalijaga RT. 16',NULL,'profile_superadmin.jpg','$2a$12$j/ZV5ZiFnRjrb23LbKbOE.rZ2CbfSLZ85RpkaurNxZnDLIEtmX14u','Tc7kVUAW72LPv0KLVIXOR9hZqbDLESOoG6L7rxeogph0BOeWXwjmCUGikpWc','2022-11-23 09:04:52','2023-01-03 14:02:24');
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

-- Dump completed on 2023-02-08  6:32:44
