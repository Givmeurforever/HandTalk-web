-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: handtalk
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id_admin` char(5) NOT NULL,
  `nama_depan_admin` varchar(10) NOT NULL,
  `nama_belakang_admin` varchar(10) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `password_admin` varchar(20) NOT NULL,
  `dibuat_pada` date NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `Admin_PK` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kamus`
--

DROP TABLE IF EXISTS `kamus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kamus` (
  `id_kamus` char(5) NOT NULL,
  `id_admin` char(5) NOT NULL,
  `kata_kamus` varchar(20) NOT NULL,
  `media_kamus` mediumblob NOT NULL,
  PRIMARY KEY (`id_kamus`),
  UNIQUE KEY `Kamus_PK` (`id_kamus`),
  KEY `Mengendalikan_FK` (`id_admin`),
  CONSTRAINT `kamus_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kamus`
--

LOCK TABLES `kamus` WRITE;
/*!40000 ALTER TABLE `kamus` DISABLE KEYS */;
/*!40000 ALTER TABLE `kamus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuis`
--

DROP TABLE IF EXISTS `kuis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuis` (
  `id_kuis` char(5) NOT NULL,
  `id_topik` char(5) NOT NULL,
  `id_admin` char(5) NOT NULL,
  `soal_teks` varchar(30) DEFAULT NULL,
  `soal_media` text DEFAULT NULL,
  `jawaban_benar` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_kuis`),
  UNIQUE KEY `Kuis_PK` (`id_kuis`),
  KEY `Mempunyai_FK` (`id_topik`),
  KEY `Memelihara_FK` (`id_admin`),
  CONSTRAINT `kuis_ibfk_1` FOREIGN KEY (`id_topik`) REFERENCES `topik` (`id_topik`),
  CONSTRAINT `kuis_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuis`
--

LOCK TABLES `kuis` WRITE;
/*!40000 ALTER TABLE `kuis` DISABLE KEYS */;
/*!40000 ALTER TABLE `kuis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuis_pilihan`
--

DROP TABLE IF EXISTS `kuis_pilihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuis_pilihan` (
  `id_kuis_pilihan` char(5) NOT NULL,
  `id_kuis` char(5) NOT NULL,
  `pilihan_jawaban` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kuis_pilihan`),
  UNIQUE KEY `kuis_pilihan_PK` (`id_kuis_pilihan`),
  KEY `ada_FK` (`id_kuis`),
  CONSTRAINT `kuis_pilihan_ibfk_1` FOREIGN KEY (`id_kuis`) REFERENCES `kuis` (`id_kuis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuis_pilihan`
--

LOCK TABLES `kuis_pilihan` WRITE;
/*!40000 ALTER TABLE `kuis_pilihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kuis_pilihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `latihan`
--

DROP TABLE IF EXISTS `latihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `latihan` (
  `id_latihan` char(5) NOT NULL,
  `id_materi` char(5) NOT NULL,
  `id_admin` char(5) NOT NULL,
  `soal_teks` varchar(30) NOT NULL,
  `soal_media` blob DEFAULT NULL,
  `jawaban_benar` char(1) NOT NULL,
  `penjelasan_latihan` text NOT NULL,
  PRIMARY KEY (`id_latihan`),
  UNIQUE KEY `Latihan_PK` (`id_latihan`),
  KEY `Mendapatkan_FK` (`id_materi`),
  KEY `Mengurus_FK` (`id_admin`),
  CONSTRAINT `latihan_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`),
  CONSTRAINT `latihan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `latihan`
--

LOCK TABLES `latihan` WRITE;
/*!40000 ALTER TABLE `latihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `latihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `latihan_pilihan`
--

DROP TABLE IF EXISTS `latihan_pilihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `latihan_pilihan` (
  `id_latihan_pilihan` char(5) NOT NULL,
  `id_latihan` char(5) NOT NULL,
  `pilihan_jawaban` varchar(30) NOT NULL,
  PRIMARY KEY (`id_latihan_pilihan`),
  UNIQUE KEY `Latihan_pilihan_PK` (`id_latihan_pilihan`),
  KEY `Memegang_FK` (`id_latihan`),
  CONSTRAINT `latihan_pilihan_ibfk_1` FOREIGN KEY (`id_latihan`) REFERENCES `latihan` (`id_latihan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `latihan_pilihan`
--

LOCK TABLES `latihan_pilihan` WRITE;
/*!40000 ALTER TABLE `latihan_pilihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `latihan_pilihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materi` (
  `id_materi` char(5) NOT NULL,
  `id_admin` char(5) NOT NULL,
  `id_topik` char(5) NOT NULL,
  `judul_materi` varchar(30) NOT NULL,
  `slug_materi` varchar(100) NOT NULL,
  `video_materi` varchar(100) NOT NULL,
  `deskripsi_materi` text NOT NULL,
  `urutan_materi` int(11) NOT NULL,
  `dibuat_pada` date NOT NULL,
  PRIMARY KEY (`id_materi`),
  UNIQUE KEY `Materi_PK` (`id_materi`),
  KEY `Memiliki_FK` (`id_topik`),
  KEY `Menambahkan_FK` (`id_admin`),
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_topik`) REFERENCES `topik` (`id_topik`),
  CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materi`
--

LOCK TABLES `materi` WRITE;
/*!40000 ALTER TABLE `materi` DISABLE KEYS */;
/*!40000 ALTER TABLE `materi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topik`
--

DROP TABLE IF EXISTS `topik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topik` (
  `id_topik` char(5) NOT NULL,
  `id_admin` char(5) NOT NULL,
  `judul_topik` varchar(30) NOT NULL,
  `slug_topik` varchar(100) NOT NULL,
  `deskripsi_topik` text NOT NULL,
  `urutan_topik` int(11) NOT NULL,
  `dibuat_pada` date NOT NULL,
  PRIMARY KEY (`id_topik`),
  UNIQUE KEY `Topik_PK` (`id_topik`),
  KEY `Mengelola_FK` (`id_admin`),
  CONSTRAINT `topik_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topik`
--

LOCK TABLES `topik` WRITE;
/*!40000 ALTER TABLE `topik` DISABLE KEYS */;
/*!40000 ALTER TABLE `topik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` char(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `password_user` varchar(20) NOT NULL,
  `nama_depan_user` varchar(20) NOT NULL,
  `nama_belakang_user` varchar(20) NOT NULL,
  `dibuat_pada` date NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `User_PK` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favorite`
--

DROP TABLE IF EXISTS `user_favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_favorite` (
  `id_user_fav` char(5) NOT NULL,
  `id_user` char(5) NOT NULL,
  `id_materi` char(5) NOT NULL,
  PRIMARY KEY (`id_user_fav`),
  UNIQUE KEY `Menggunakan_PK` (`id_user_fav`),
  KEY `Menggunakan_FK` (`id_user`),
  KEY `Menggunakan2_FK` (`id_materi`),
  CONSTRAINT `user_favorite_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `user_favorite_ibfk_2` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favorite`
--

LOCK TABLES `user_favorite` WRITE;
/*!40000 ALTER TABLE `user_favorite` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_progress`
--

DROP TABLE IF EXISTS `user_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_progress` (
  `id_user_prog` char(5) NOT NULL,
  `id_user` char(5) NOT NULL,
  `id_materi` char(5) NOT NULL,
  `progress` int(11) NOT NULL,
  PRIMARY KEY (`id_user_prog`),
  UNIQUE KEY `Mengakses_PK` (`id_user_prog`),
  KEY `Mengakses_FK` (`id_user`),
  KEY `Mengakses2_FK` (`id_materi`),
  CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `user_progress_ibfk_2` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_progress`
--

LOCK TABLES `user_progress` WRITE;
/*!40000 ALTER TABLE `user_progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_progress` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-29  0:49:04
