CREATE DATABASE  IF NOT EXISTS `cifundaudo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cifundaudo`;
-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cifundaudo
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoPersona` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_cedula_unique` (`cedula`),
  UNIQUE KEY `clientes_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (7,'12345678','N','Pedro','Perez','pedroperez@example.com','04123456789','--','2018-04-03 07:02:12','2018-04-03 07:02:12');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta_cobrar`
--

DROP TABLE IF EXISTS `cuenta_cobrar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta_cobrar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta_cobrar`
--

LOCK TABLES `cuenta_cobrar` WRITE;
/*!40000 ALTER TABLE `cuenta_cobrar` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuenta_cobrar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horas` double NOT NULL,
  `costo` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cursos_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Excel avanzado','Curso',16,65000,1,'2018-03-31 23:03:31','2018-03-31 23:03:31'),(2,'Microsoft proyect','Curso',16,65000,1,'2018-03-31 23:03:31','2018-03-31 23:03:31'),(4,'Desarrollo gerencial','Curso',16,315000,1,'2018-03-31 23:03:32','2018-03-31 23:03:32'),(5,'Salud ocupacional','Diplomado',100,315000,1,'2018-03-31 23:03:32','2018-03-31 23:03:32'),(6,'Derecho laboral','Diplomado',100,315000,1,'2018-03-31 23:03:32','2018-03-31 23:03:32'),(7,'Producción de gas','Diplomado',100,315000,1,'2018-03-31 23:03:32','2018-03-31 23:03:32');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_factura_cursos`
--

DROP TABLE IF EXISTS `datos_factura_cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos_factura_cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `curso` int(10) unsigned NOT NULL,
  `facturaCurso` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `datos_factura_cursos_curso_foreign` (`curso`),
  KEY `datos_factura_cursos_facturacurso_foreign` (`facturaCurso`),
  CONSTRAINT `datos_factura_cursos_curso_foreign` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `datos_factura_cursos_facturacurso_foreign` FOREIGN KEY (`facturaCurso`) REFERENCES `facturacion_cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_factura_cursos`
--

LOCK TABLES `datos_factura_cursos` WRITE;
/*!40000 ALTER TABLE `datos_factura_cursos` DISABLE KEYS */;
INSERT INTO `datos_factura_cursos` VALUES (6,65000,1,4,'2018-04-03 07:07:12','2018-04-03 07:07:12'),(7,315000,4,4,'2018-04-03 07:07:12','2018-04-03 07:07:12'),(8,300000,4,4,'2018-04-03 07:12:02','2018-04-03 07:12:02');
/*!40000 ALTER TABLE `datos_factura_cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datos_factura_diplomados`
--

DROP TABLE IF EXISTS `datos_factura_diplomados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datos_factura_diplomados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monto` double NOT NULL,
  `curso` int(10) unsigned NOT NULL,
  `facturaDiplomado` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `datos_factura_diplomados_curso_foreign` (`curso`),
  KEY `datos_factura_diplomados_facturadiplomado_foreign` (`facturaDiplomado`),
  CONSTRAINT `datos_factura_diplomados_curso_foreign` FOREIGN KEY (`curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `datos_factura_diplomados_facturadiplomado_foreign` FOREIGN KEY (`facturaDiplomado`) REFERENCES `facturacion_diplomados` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datos_factura_diplomados`
--

LOCK TABLES `datos_factura_diplomados` WRITE;
/*!40000 ALTER TABLE `datos_factura_diplomados` DISABLE KEYS */;
INSERT INTO `datos_factura_diplomados` VALUES (7,315000,5,8,'2018-04-03 07:12:44','2018-04-03 07:12:44'),(8,315000,7,8,'2018-04-03 07:12:44','2018-04-03 07:12:44');
/*!40000 ALTER TABLE `datos_factura_diplomados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturacion_cursos`
--

DROP TABLE IF EXISTS `facturacion_cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturacion_cursos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente` int(10) unsigned NOT NULL,
  `pagado` int(11) DEFAULT NULL,
  `codigoPago` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoPago` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facturacion_cursos_cliente_foreign` (`cliente`),
  CONSTRAINT `facturacion_cursos_cliente_foreign` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturacion_cursos`
--

LOCK TABLES `facturacion_cursos` WRITE;
/*!40000 ALTER TABLE `facturacion_cursos` DISABLE KEYS */;
INSERT INTO `facturacion_cursos` VALUES (4,7,0,NULL,NULL,'2018-04-03 07:07:11','2018-04-03 07:07:11');
/*!40000 ALTER TABLE `facturacion_cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturacion_diplomados`
--

DROP TABLE IF EXISTS `facturacion_diplomados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturacion_diplomados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente` int(10) unsigned NOT NULL,
  `pagado` int(11) DEFAULT NULL,
  `codigoPago` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoPago` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `facturacion_diplomados_cliente_foreign` (`cliente`),
  CONSTRAINT `facturacion_diplomados_cliente_foreign` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturacion_diplomados`
--

LOCK TABLES `facturacion_diplomados` WRITE;
/*!40000 ALTER TABLE `facturacion_diplomados` DISABLE KEYS */;
INSERT INTO `facturacion_diplomados` VALUES (8,7,0,NULL,NULL,'2018-04-03 07:12:44','2018-04-03 07:12:44');
/*!40000 ALTER TABLE `facturacion_diplomados` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (10,'2014_10_12_000000_create_users_table',1),(11,'2014_10_12_100000_create_password_resets_table',1),(12,'2017_11_26_223011_create_clientes_table',1),(13,'2017_11_27_205037_create_cursos_table',1),(14,'2017_12_06_113926_create_facturacion_cursos_table',1),(15,'2017_12_06_114213_create_facturacion_diplomados_table',1),(16,'2017_12_06_141607_create_cuenta_cobrars_table',1),(17,'2018_01_13_175118_create_datos_factura_cursos_table',1),(18,'2018_01_13_175134_create_datos_factura_diplomados_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  UNIQUE KEY `usuarios_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Juan Tovar','tovarjc66@gmail.com','$2y$10$RfG282VX6XjOzsH9XgXMgu3sxiGNGj/prk.K2SKRv87wCOFv.YaG2',NULL,'JuanTovar.jpg','tovarjc66',1,'uGtT6TXVkSgqIeCoESPY6532zzXUc8MCLv45C8ut5h3eMDVn13BX7iiCa8sw','2018-03-31 23:03:31','2018-03-31 23:03:31'),(3,'Pedro Perez','pedroperez@example.com','$2y$10$Fw2Zs.Q/SgMHU3N9GqysEuRdwngeBV/5xQcYwmf9d89McbNfDq/ie','Cliente Pedro Perez','','pedroperez@example.com',3,NULL,'2018-04-03 07:02:12','2018-04-03 07:02:12');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-02 23:35:08
