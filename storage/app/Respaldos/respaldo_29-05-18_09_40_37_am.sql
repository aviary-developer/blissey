-- MySQL dump 10.16  Distrib 10.1.28-MariaDB, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: blissey
-- ------------------------------------------------------
-- Server version	10.1.28-MariaDB

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
-- Table structure for table `abonos`
--

DROP TABLE IF EXISTS `abonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monto` double NOT NULL,
  `f_transaccion` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abonos_f_transaccion_foreign` (`f_transaccion`),
  CONSTRAINT `abonos_f_transaccion_foreign` FOREIGN KEY (`f_transaccion`) REFERENCES `transacions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonos`
--

LOCK TABLES `abonos` WRITE;
/*!40000 ALTER TABLE `abonos` DISABLE KEYS */;
INSERT INTO `abonos` VALUES (1,'2018-05-28 15:59:18','2018-05-28 15:59:18',240.69,1);
/*!40000 ALTER TABLE `abonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banco_sangres`
--

DROP TABLE IF EXISTS `banco_sangres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banco_sangres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipoSangre` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `anticuerpos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pruebaCruzada` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banco_sangres`
--

LOCK TABLES `banco_sangres` WRITE;
/*!40000 ALTER TABLE `banco_sangres` DISABLE KEYS */;
/*!40000 ALTER TABLE `banco_sangres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacoras`
--

DROP TABLE IF EXISTS `bitacoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacoras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` enum('login','logout','store','update','destroy','activate','desactivate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabla` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indice` int(11) NOT NULL,
  `f_usuario` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bitacoras_f_usuario_foreign` (`f_usuario`),
  CONSTRAINT `bitacoras_f_usuario_foreign` FOREIGN KEY (`f_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacoras`
--

LOCK TABLES `bitacoras` WRITE;
/*!40000 ALTER TABLE `bitacoras` DISABLE KEYS */;
INSERT INTO `bitacoras` VALUES (1,'login','usuarios','users',1,1,'2018-05-18 18:56:19','2018-05-18 18:56:19'),(2,'update','usuarios','users',1,1,'2018-05-18 18:57:03','2018-05-18 18:57:03'),(3,'store','grupo_promesa','empresas',1,1,'2018-05-18 19:05:50','2018-05-18 19:05:50'),(4,'store','usuarios','users',2,1,'2018-05-18 19:07:58','2018-05-18 19:07:58'),(5,'logout','usuarios','users',1,1,'2018-05-18 19:08:03','2018-05-18 19:08:03'),(6,'login','usuarios','users',2,2,'2018-05-18 19:08:37','2018-05-18 19:08:37'),(7,'update','usuarios','users',2,2,'2018-05-18 19:08:54','2018-05-18 19:08:54'),(8,'logout','usuarios','users',2,2,'2018-05-18 19:08:57','2018-05-18 19:08:57'),(9,'login','usuarios','users',1,1,'2018-05-18 19:09:03','2018-05-18 19:09:03'),(10,'store','usuarios','users',3,1,'2018-05-18 19:10:30','2018-05-18 19:10:30'),(11,'logout','usuarios','users',1,1,'2018-05-18 19:10:41','2018-05-18 19:10:41'),(12,'login','usuarios','users',3,3,'2018-05-18 19:10:57','2018-05-18 19:10:57'),(13,'update','usuarios','users',3,3,'2018-05-18 19:11:27','2018-05-18 19:11:27'),(14,'logout','usuarios','users',3,3,'2018-05-18 19:11:43','2018-05-18 19:11:43'),(15,'login','usuarios','users',1,1,'2018-05-18 19:18:48','2018-05-18 19:18:48'),(16,'login','usuarios','users',1,1,'2018-05-18 19:29:09','2018-05-18 19:29:09'),(17,'store','especialidades','especialidads',1,1,'2018-05-18 19:29:31','2018-05-18 19:29:31'),(18,'store','servicios','servicios',1,1,'2018-05-18 19:31:52','2018-05-18 19:31:52'),(19,'store','usuarios','users',4,1,'2018-05-18 19:31:52','2018-05-18 19:31:52'),(20,'store','especialidades','especialidads',2,1,'2018-05-18 19:33:32','2018-05-18 19:33:32'),(21,'store','servicios','servicios',2,1,'2018-05-18 19:33:53','2018-05-18 19:33:53'),(22,'store','usuarios','users',5,1,'2018-05-18 19:33:53','2018-05-18 19:33:53'),(23,'store','servicios','servicios',3,1,'2018-05-18 19:35:13','2018-05-18 19:35:13'),(24,'store','usuarios','users',6,1,'2018-05-18 19:35:13','2018-05-18 19:35:13'),(25,'logout','usuarios','users',1,1,'2018-05-18 19:35:51','2018-05-18 19:35:51'),(26,'login','usuarios','users',4,4,'2018-05-18 19:36:03','2018-05-18 19:36:03'),(27,'update','usuarios','users',4,4,'2018-05-18 19:36:21','2018-05-18 19:36:21'),(28,'logout','usuarios','users',4,4,'2018-05-18 19:36:23','2018-05-18 19:36:23'),(29,'login','usuarios','users',5,5,'2018-05-18 19:36:36','2018-05-18 19:36:36'),(30,'update','usuarios','users',5,5,'2018-05-18 19:37:09','2018-05-18 19:37:09'),(31,'logout','usuarios','users',5,5,'2018-05-18 19:37:14','2018-05-18 19:37:14'),(32,'login','usuarios','users',6,6,'2018-05-18 19:37:24','2018-05-18 19:37:24'),(33,'update','usuarios','users',6,6,'2018-05-18 19:37:46','2018-05-18 19:37:46'),(34,'logout','usuarios','users',6,6,'2018-05-18 19:37:49','2018-05-18 19:37:49'),(35,'login','usuarios','users',1,1,'2018-05-18 19:37:57','2018-05-18 19:37:57'),(36,'store','usuarios','users',7,1,'2018-05-18 19:39:22','2018-05-18 19:39:22'),(37,'logout','usuarios','users',1,1,'2018-05-18 19:39:28','2018-05-18 19:39:28'),(38,'login','usuarios','users',7,7,'2018-05-18 19:39:38','2018-05-18 19:39:38'),(39,'update','usuarios','users',7,7,'2018-05-18 19:39:58','2018-05-18 19:39:58'),(40,'logout','usuarios','users',7,7,'2018-05-18 19:40:01','2018-05-18 19:40:01'),(41,'login','usuarios','users',1,1,'2018-05-22 16:52:08','2018-05-22 16:52:08'),(42,'store','habitaciones','habitacions',1,1,'2018-05-22 16:52:36','2018-05-22 16:52:36'),(43,'store','servicios','servicios',4,1,'2018-05-22 16:52:37','2018-05-22 16:52:37'),(44,'store','habitaciones','habitacions',2,1,'2018-05-22 16:52:51','2018-05-22 16:52:51'),(45,'store','servicios','servicios',5,1,'2018-05-22 16:52:51','2018-05-22 16:52:51'),(46,'store','habitaciones','habitacions',3,1,'2018-05-22 16:53:23','2018-05-22 16:53:23'),(47,'store','servicios','servicios',6,1,'2018-05-22 16:53:23','2018-05-22 16:53:23'),(48,'store','habitaciones','habitacions',4,1,'2018-05-22 16:53:32','2018-05-22 16:53:32'),(49,'store','servicios','servicios',7,1,'2018-05-22 16:53:32','2018-05-22 16:53:32'),(50,'store','categoria_servicios','categoria_servicios',3,1,'2018-05-22 16:54:20','2018-05-22 16:54:20'),(51,'store','servicios','servicios',8,1,'2018-05-22 16:54:39','2018-05-22 16:54:39'),(52,'store','servicios','servicios',9,1,'2018-05-22 16:54:57','2018-05-22 16:54:57'),(53,'logout','usuarios','users',1,1,'2018-05-22 16:55:33','2018-05-22 16:55:33'),(54,'login','usuarios','users',2,2,'2018-05-22 16:55:52','2018-05-22 16:55:52'),(55,'store','examenes','examens',1,2,'2018-05-22 17:02:01','2018-05-22 17:02:01'),(56,'store','examenes','examens',2,2,'2018-05-22 17:02:47','2018-05-22 17:02:47'),(57,'store','examenes','examens',3,2,'2018-05-22 17:03:18','2018-05-22 17:03:18'),(58,'logout','usuarios','users',2,2,'2018-05-22 17:03:33','2018-05-22 17:03:33'),(59,'login','usuarios','users',1,1,'2018-05-22 17:03:52','2018-05-22 17:03:52'),(60,'store','pacientes','pacientes',1,1,'2018-05-22 17:06:42','2018-05-22 17:06:42'),(61,'store','pacientes','pacientes',2,1,'2018-05-22 17:07:56','2018-05-22 17:07:56'),(62,'store','pacientes','pacientes',3,1,'2018-05-22 17:08:48','2018-05-22 17:08:48'),(63,'store','pacientes','pacientes',4,1,'2018-05-22 17:09:59','2018-05-22 17:09:59'),(64,'store','pacientes','pacientes',5,1,'2018-05-22 17:10:53','2018-05-22 17:10:53'),(65,'store','ingresos','ingresos',1,1,'2018-05-22 17:43:40','2018-05-22 17:43:40'),(66,'activate','ingresos','ingresos',1,1,'2018-05-22 17:43:49','2018-05-22 17:43:49'),(67,'store','solicitudex','solicitud_examens',1,1,'2018-05-22 18:03:27','2018-05-22 18:03:27'),(68,'store','transacciones','transacions',1,1,'2018-05-22 18:03:27','2018-05-22 18:03:27'),(69,'login','usuarios','users',1,1,'2018-05-22 23:16:59','2018-05-22 23:16:59'),(70,'login','usuarios','users',1,1,'2018-05-23 15:14:36','2018-05-23 15:14:36'),(71,'login','usuarios','users',1,1,'2018-05-23 15:52:15','2018-05-23 15:52:15'),(72,'store','signos','signo_vitals',2,1,'2018-05-23 17:01:42','2018-05-23 17:01:42'),(73,'login','usuarios','users',1,1,'2018-05-28 15:57:07','2018-05-28 15:57:07'),(74,'logout','usuarios','users',1,1,'2018-05-28 15:57:38','2018-05-28 15:57:38'),(75,'login','usuarios','users',4,4,'2018-05-28 15:57:44','2018-05-28 15:57:44'),(76,'store','consultas','consultas',1,4,'2018-05-28 15:58:54','2018-05-28 15:58:54'),(77,'logout','usuarios','users',4,4,'2018-05-28 15:59:03','2018-05-28 15:59:03'),(78,'login','usuarios','users',1,1,'2018-05-28 15:59:09','2018-05-28 15:59:09'),(79,'store','ingresos','ingresos',2,1,'2018-05-28 15:59:43','2018-05-28 15:59:43'),(80,'logout','usuarios','users',1,1,'2018-05-28 15:59:47','2018-05-28 15:59:47'),(81,'login','usuarios','users',5,5,'2018-05-28 15:59:54','2018-05-28 15:59:54'),(82,'logout','usuarios','users',5,5,'2018-05-28 16:11:40','2018-05-28 16:11:40'),(83,'login','usuarios','users',2,2,'2018-05-28 16:11:48','2018-05-28 16:11:48'),(84,'login','usuarios','users',2,2,'2018-05-28 16:12:00','2018-05-28 16:12:00'),(85,'logout','usuarios','users',2,2,'2018-05-28 16:12:27','2018-05-28 16:12:27'),(86,'login','usuarios','users',2,2,'2018-05-28 16:15:14','2018-05-28 16:15:14'),(87,'logout','usuarios','users',2,2,'2018-05-28 16:25:17','2018-05-28 16:25:17'),(88,'login','usuarios','users',5,5,'2018-05-28 16:25:30','2018-05-28 16:25:30'),(89,'login','usuarios','users',1,1,'2018-05-29 15:39:43','2018-05-29 15:39:43');
/*!40000 ALTER TABLE `bitacoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cambio_productos`
--

DROP TABLE IF EXISTS `cambio_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cambio_productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `f_detalle_transaccion` int(10) unsigned NOT NULL,
  `localizacion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cambio_productos_f_detalle_transaccion_foreign` (`f_detalle_transaccion`),
  CONSTRAINT `cambio_productos_f_detalle_transaccion_foreign` FOREIGN KEY (`f_detalle_transaccion`) REFERENCES `detalle_transacions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cambio_productos`
--

LOCK TABLES `cambio_productos` WRITE;
/*!40000 ALTER TABLE `cambio_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cambio_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_productos`
--

DROP TABLE IF EXISTS `categoria_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_productos`
--

LOCK TABLES `categoria_productos` WRITE;
/*!40000 ALTER TABLE `categoria_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_servicios`
--

DROP TABLE IF EXISTS `categoria_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_servicios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_servicios`
--

LOCK TABLES `categoria_servicios` WRITE;
/*!40000 ALTER TABLE `categoria_servicios` DISABLE KEYS */;
INSERT INTO `categoria_servicios` VALUES (1,'Honorarios',1,'2018-05-18 19:31:52','2018-05-18 19:31:52'),(2,'Habitación',1,'2018-05-22 16:52:36','2018-05-22 16:52:36'),(3,'Otros',1,'2018-05-22 16:54:20','2018-05-22 16:54:20'),(4,'Laboratorio Clínico',1,'2018-05-22 17:02:01','2018-05-22 17:02:01');
/*!40000 ALTER TABLE `categoria_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `componente_productos`
--

DROP TABLE IF EXISTS `componente_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `componente_productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_componente` int(10) unsigned DEFAULT NULL,
  `f_producto` int(10) unsigned DEFAULT NULL,
  `cantidad` double NOT NULL,
  `f_unidad` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `componente_productos_f_componente_foreign` (`f_componente`),
  KEY `componente_productos_f_producto_foreign` (`f_producto`),
  KEY `componente_productos_f_unidad_foreign` (`f_unidad`),
  CONSTRAINT `componente_productos_f_componente_foreign` FOREIGN KEY (`f_componente`) REFERENCES `componentes` (`id`),
  CONSTRAINT `componente_productos_f_producto_foreign` FOREIGN KEY (`f_producto`) REFERENCES `productos` (`id`),
  CONSTRAINT `componente_productos_f_unidad_foreign` FOREIGN KEY (`f_unidad`) REFERENCES `unidads` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componente_productos`
--

LOCK TABLES `componente_productos` WRITE;
/*!40000 ALTER TABLE `componente_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `componente_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `componentes`
--

DROP TABLE IF EXISTS `componentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `componentes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componentes`
--

LOCK TABLES `componentes` WRITE;
/*!40000 ALTER TABLE `componentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `componentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `motivo` text COLLATE utf8mb4_unicode_ci,
  `historia` text COLLATE utf8mb4_unicode_ci,
  `examen_fisico` text COLLATE utf8mb4_unicode_ci,
  `diagnostico` text COLLATE utf8mb4_unicode_ci,
  `resumen` int(11) NOT NULL DEFAULT '2',
  `cita` date DEFAULT NULL,
  `f_ingreso` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `f_medico` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultas_f_ingreso_foreign` (`f_ingreso`),
  KEY `consultas_f_medico_foreign` (`f_medico`),
  CONSTRAINT `consultas_f_ingreso_foreign` FOREIGN KEY (`f_ingreso`) REFERENCES `ingresos` (`id`),
  CONSTRAINT `consultas_f_medico_foreign` FOREIGN KEY (`f_medico`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,'Dolor de estomago','Desde hace 4 días le empezo a doler el estomago, ha tenido nauseas y dolor en el bajo vientre','Inflamación del área abdominal','Indigestión',2,NULL,1,'2018-05-28 15:58:54','2018-05-28 15:58:54',4);
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dependientes`
--

DROP TABLE IF EXISTS `dependientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `f_proveedor` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dependientes_f_proveedor_foreign` (`f_proveedor`),
  CONSTRAINT `dependientes_f_proveedor_foreign` FOREIGN KEY (`f_proveedor`) REFERENCES `proveedors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependientes`
--

LOCK TABLES `dependientes` WRITE;
/*!40000 ALTER TABLE `dependientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `dependientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_rayoxes`
--

DROP TABLE IF EXISTS `detalle_rayoxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_rayoxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_resultado` int(10) unsigned NOT NULL,
  `rayox` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_rayoxes_f_resultado_foreign` (`f_resultado`),
  CONSTRAINT `detalle_rayoxes_f_resultado_foreign` FOREIGN KEY (`f_resultado`) REFERENCES `resultados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_rayoxes`
--

LOCK TABLES `detalle_rayoxes` WRITE;
/*!40000 ALTER TABLE `detalle_rayoxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_rayoxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_resultados`
--

DROP TABLE IF EXISTS `detalle_resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_resultados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_resultado` int(10) unsigned NOT NULL,
  `f_espr` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `resultado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dato_controlado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_resultados_f_resultado_foreign` (`f_resultado`),
  KEY `detalle_resultados_f_espr_foreign` (`f_espr`),
  CONSTRAINT `detalle_resultados_f_espr_foreign` FOREIGN KEY (`f_espr`) REFERENCES `examen_seccion_parametros` (`id`),
  CONSTRAINT `detalle_resultados_f_resultado_foreign` FOREIGN KEY (`f_resultado`) REFERENCES `resultados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_resultados`
--

LOCK TABLES `detalle_resultados` WRITE;
/*!40000 ALTER TABLE `detalle_resultados` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_resultados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_transacions`
--

DROP TABLE IF EXISTS `detalle_transacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_transacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_servicio` int(10) unsigned DEFAULT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `f_transaccion` int(10) unsigned NOT NULL,
  `precio` double unsigned DEFAULT NULL,
  `lote` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_producto` int(10) unsigned DEFAULT NULL,
  `f_estante` int(10) unsigned DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `detalle_transacions_f_servicio_foreign` (`f_servicio`),
  KEY `detalle_transacions_f_transaccion_foreign` (`f_transaccion`),
  KEY `detalle_transacions_f_producto_foreign` (`f_producto`),
  KEY `detalle_transacions_f_estante_foreign` (`f_estante`),
  CONSTRAINT `detalle_transacions_f_estante_foreign` FOREIGN KEY (`f_estante`) REFERENCES `estantes` (`id`),
  CONSTRAINT `detalle_transacions_f_producto_foreign` FOREIGN KEY (`f_producto`) REFERENCES `division_productos` (`id`),
  CONSTRAINT `detalle_transacions_f_servicio_foreign` FOREIGN KEY (`f_servicio`) REFERENCES `servicios` (`id`),
  CONSTRAINT `detalle_transacions_f_transaccion_foreign` FOREIGN KEY (`f_transaccion`) REFERENCES `transacions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_transacions`
--

LOCK TABLES `detalle_transacions` WRITE;
/*!40000 ALTER TABLE `detalle_transacions` DISABLE KEYS */;
INSERT INTO `detalle_transacions` VALUES (1,10,0,1,NULL,'2018-05-22 18:03:27','2018-05-22 18:03:27',1,3,NULL,NULL,NULL,NULL,1),(2,5,0,1,NULL,'2018-05-22 17:43:00','2018-05-28 15:57:22',1,35,NULL,NULL,NULL,NULL,1),(3,5,0,1,NULL,'2018-05-23 17:43:00','2018-05-28 15:57:22',1,35,NULL,NULL,NULL,NULL,1),(4,5,0,1,NULL,'2018-05-24 17:43:00','2018-05-28 15:57:22',1,35,NULL,NULL,NULL,NULL,1),(5,5,0,1,NULL,'2018-05-25 17:43:00','2018-05-28 15:57:22',1,35,NULL,NULL,NULL,NULL,1),(6,5,0,1,NULL,'2018-05-26 17:43:00','2018-05-28 15:57:22',1,35,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `detalle_transacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_ultrasonografias`
--

DROP TABLE IF EXISTS `detalle_ultrasonografias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_ultrasonografias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_resultado` int(10) unsigned NOT NULL,
  `ultrasonografia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_ultrasonografias_f_resultado_foreign` (`f_resultado`),
  CONSTRAINT `detalle_ultrasonografias_f_resultado_foreign` FOREIGN KEY (`f_resultado`) REFERENCES `resultados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_ultrasonografias`
--

LOCK TABLES `detalle_ultrasonografias` WRITE;
/*!40000 ALTER TABLE `detalle_ultrasonografias` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_ultrasonografias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `division_productos`
--

DROP TABLE IF EXISTS `division_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `division_productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_division` int(10) unsigned NOT NULL,
  `f_producto` int(10) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `codigo` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` int(10) unsigned DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT '40',
  PRIMARY KEY (`id`),
  KEY `division_productos_f_division_foreign` (`f_division`),
  KEY `division_productos_f_producto_foreign` (`f_producto`),
  KEY `division_productos_contenido_foreign` (`contenido`),
  CONSTRAINT `division_productos_contenido_foreign` FOREIGN KEY (`contenido`) REFERENCES `unidads` (`id`),
  CONSTRAINT `division_productos_f_division_foreign` FOREIGN KEY (`f_division`) REFERENCES `divisions` (`id`),
  CONSTRAINT `division_productos_f_producto_foreign` FOREIGN KEY (`f_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `division_productos`
--

LOCK TABLES `division_productos` WRITE;
/*!40000 ALTER TABLE `division_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `division_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_hospital` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_hospital` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_clinica` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_clinica` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_laboratorio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_laboratorio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_farmacia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_farmacia` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo_hospital` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen',
  `logo_clinica` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen',
  `logo_farmacia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen',
  `logo_laboratorio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen',
  `codigo_hospital` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_clinica` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_laboratorio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_farmacia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_hospital` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_laboratorio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_clinica` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_farmacia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Hospital Divino Niño','6ta Calle Poniente San Vicente','Clínica médica Divino Niño','2da avenida sur, San Vicente','Laboratorio Divino Niño','6ta Calle poniente, San Vicente','Farmacia Divino Niño','2da Avenida sur, San Vicente','2018-05-18 19:05:50','2018-05-18 19:05:50','public/logo/seCsgsU8YZPlc7VAv0wQj9tLkXiODNOmuOeVyk3i.jpeg','public/logo/n6YDtRXM7k99aFG1ZteznoUCIU1iBeZixEdPcLLG.jpeg','public/logo/y2FgzOGOiTr7QPxCsMlxXUyfdvjjQZ0SF4LOt3Ub.jpeg','public/logo/vrbTSbQitYqvUXuXjyr70HRiHZmeHpU8MNlfssxv.jpeg','33033','78678','28972','8979','hospital@divinonino.com','labo@divinonino.com','clinica@divinonino.com','farmacia@divinonino.com');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad_usuarios`
--

DROP TABLE IF EXISTS `especialidad_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidad_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `principal` tinyint(1) NOT NULL,
  `f_especialidad` int(10) unsigned NOT NULL,
  `f_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `especialidad_usuarios_f_especialidad_foreign` (`f_especialidad`),
  KEY `especialidad_usuarios_f_usuario_foreign` (`f_usuario`),
  CONSTRAINT `especialidad_usuarios_f_especialidad_foreign` FOREIGN KEY (`f_especialidad`) REFERENCES `especialidads` (`id`),
  CONSTRAINT `especialidad_usuarios_f_usuario_foreign` FOREIGN KEY (`f_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad_usuarios`
--

LOCK TABLES `especialidad_usuarios` WRITE;
/*!40000 ALTER TABLE `especialidad_usuarios` DISABLE KEYS */;
INSERT INTO `especialidad_usuarios` VALUES (1,'2018-05-18 19:31:52','2018-05-18 19:31:52',1,1,4),(2,'2018-05-18 19:33:53','2018-05-18 19:33:53',1,2,5);
/*!40000 ALTER TABLE `especialidad_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidads`
--

DROP TABLE IF EXISTS `especialidads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidads`
--

LOCK TABLES `especialidads` WRITE;
/*!40000 ALTER TABLE `especialidads` DISABLE KEYS */;
INSERT INTO `especialidads` VALUES (1,'Pediatría',1,'2018-05-18 19:29:31','2018-05-18 19:29:31'),(2,'Cardiología',1,'2018-05-18 19:33:32','2018-05-18 19:33:32');
/*!40000 ALTER TABLE `especialidads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estantes`
--

DROP TABLE IF EXISTS `estantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estantes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `localizacion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estantes`
--

LOCK TABLES `estantes` WRITE;
/*!40000 ALTER TABLE `estantes` DISABLE KEYS */;
INSERT INTO `estantes` VALUES (1,'1',2,1,'2018-05-22 17:04:53','2018-05-22 17:04:53',1),(2,'2',3,1,'2018-05-22 17:05:02','2018-05-22 17:05:02',1);
/*!40000 ALTER TABLE `estantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_seccion_parametros`
--

DROP TABLE IF EXISTS `examen_seccion_parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen_seccion_parametros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_examen` int(10) unsigned NOT NULL,
  `f_seccion` int(10) unsigned NOT NULL,
  `f_parametro` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `f_reactivo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examen_seccion_parametros_f_examen_foreign` (`f_examen`),
  KEY `examen_seccion_parametros_f_seccion_foreign` (`f_seccion`),
  KEY `examen_seccion_parametros_f_parametro_foreign` (`f_parametro`),
  KEY `examen_seccion_parametros_f_reactivo_foreign` (`f_reactivo`),
  CONSTRAINT `examen_seccion_parametros_f_examen_foreign` FOREIGN KEY (`f_examen`) REFERENCES `examens` (`id`),
  CONSTRAINT `examen_seccion_parametros_f_parametro_foreign` FOREIGN KEY (`f_parametro`) REFERENCES `parametros` (`id`),
  CONSTRAINT `examen_seccion_parametros_f_reactivo_foreign` FOREIGN KEY (`f_reactivo`) REFERENCES `reactivos` (`id`),
  CONSTRAINT `examen_seccion_parametros_f_seccion_foreign` FOREIGN KEY (`f_seccion`) REFERENCES `seccions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_seccion_parametros`
--

LOCK TABLES `examen_seccion_parametros` WRITE;
/*!40000 ALTER TABLE `examen_seccion_parametros` DISABLE KEYS */;
INSERT INTO `examen_seccion_parametros` VALUES (1,1,1,1,'2018-05-22 17:02:01','2018-05-22 17:02:01',1,NULL),(2,1,1,1,'2018-05-22 17:02:01','2018-05-22 17:02:01',1,2),(3,2,4,1,'2018-05-22 17:02:46','2018-05-22 17:02:46',1,NULL),(4,2,1,3,'2018-05-22 17:02:46','2018-05-22 17:02:46',1,1),(5,2,1,4,'2018-05-22 17:02:46','2018-05-22 17:02:46',1,2),(6,3,4,1,'2018-05-22 17:03:18','2018-05-22 17:03:18',1,NULL);
/*!40000 ALTER TABLE `examen_seccion_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examens`
--

DROP TABLE IF EXISTS `examens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombreExamen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipoMuestra` int(11) NOT NULL,
  `area` enum('HEMATOLOGIA','EXAMENES DE ORINA','EXAMENES DE HECES','BACTERIOLOGIA','QUIMICA SANGUINEA','INMUNOLOGIA','ENZIMAS','PRUEBAS ESPECIALES','OTROS') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examens`
--

LOCK TABLES `examens` WRITE;
/*!40000 ALTER TABLE `examens` DISABLE KEYS */;
INSERT INTO `examens` VALUES (1,'2018-05-22 17:02:01','2018-05-22 17:02:01','General de heces',1,1,'EXAMENES DE HECES'),(2,'2018-05-22 17:02:46','2018-05-22 17:02:46','Bilirrubina',1,3,'HEMATOLOGIA'),(3,'2018-05-22 17:03:18','2018-05-22 17:03:18','General de orina',1,2,'EXAMENES DE ORINA');
/*!40000 ALTER TABLE `examens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitacions`
--

DROP TABLE IF EXISTS `habitacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `habitacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(10) unsigned NOT NULL,
  `precio` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `ocupado` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitacions`
--

LOCK TABLES `habitacions` WRITE;
/*!40000 ALTER TABLE `habitacions` DISABLE KEYS */;
INSERT INTO `habitacions` VALUES (1,1,30,'2018-05-22 16:52:36','2018-05-23 15:15:27',1,0,1),(2,2,35,'2018-05-22 16:52:50','2018-05-28 15:59:18',1,0,1),(3,3,20,'2018-05-22 16:53:23','2018-05-22 16:53:23',1,0,1),(4,1,15,'2018-05-22 16:53:32','2018-05-22 16:53:32',1,0,0);
/*!40000 ALTER TABLE `habitacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos`
--

DROP TABLE IF EXISTS `ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `f_paciente` int(10) unsigned NOT NULL,
  `f_responsable` int(10) unsigned NOT NULL,
  `f_medico` int(10) unsigned NOT NULL,
  `f_habitacion` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `f_recepcion` int(10) unsigned DEFAULT NULL,
  `expediente` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ingresos_f_paciente_foreign` (`f_paciente`),
  KEY `ingresos_f_responsable_foreign` (`f_responsable`),
  KEY `ingresos_f_medico_foreign` (`f_medico`),
  KEY `ingresos_f_habitacion_foreign` (`f_habitacion`),
  KEY `ingresos_f_recepcion_foreign` (`f_recepcion`),
  CONSTRAINT `ingresos_f_habitacion_foreign` FOREIGN KEY (`f_habitacion`) REFERENCES `habitacions` (`id`),
  CONSTRAINT `ingresos_f_medico_foreign` FOREIGN KEY (`f_medico`) REFERENCES `users` (`id`),
  CONSTRAINT `ingresos_f_paciente_foreign` FOREIGN KEY (`f_paciente`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `ingresos_f_recepcion_foreign` FOREIGN KEY (`f_recepcion`) REFERENCES `users` (`id`),
  CONSTRAINT `ingresos_f_responsable_foreign` FOREIGN KEY (`f_responsable`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos`
--

LOCK TABLES `ingresos` WRITE;
/*!40000 ALTER TABLE `ingresos` DISABLE KEYS */;
INSERT INTO `ingresos` VALUES (1,'2018-05-22 11:43:00','2018-05-28 09:59:18',1,1,4,2,'2018-05-22 17:43:40','2018-05-28 15:59:18',2,1,'1',0),(2,'2018-05-28 09:59:00',NULL,1,1,5,NULL,'2018-05-28 15:59:43','2018-05-28 15:59:43',0,1,'1',3);
/*!40000 ALTER TABLE `ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_09_06_104310_create_reactivos_table',1),(4,'2017_09_11_142210_create_pacientes_table',1),(5,'2017_09_12_091532_create_proveedors_table',1),(6,'2017_09_12_094005_create_dependientes_table',1),(7,'2017_09_14_094741_add_proveedores_table',1),(8,'2017_09_28_095903_agregar_estado_reactivos',1),(9,'2017_09_28_095927_campos_usuarios',1),(10,'2017_10_02_100700_estado_usuario',1),(11,'2017_10_02_101106_estado_nuevo_usuario',1),(12,'2017_10_02_161358_create_parametros_table',1),(13,'2017_10_02_161508_create_examens_table',1),(14,'2017_10_02_234647_imagen_users',1),(15,'2017_10_03_125202_create_telefono_usuarios_table',1),(16,'2017_10_03_233944_create_especialidads_table',1),(17,'2017_10_04_094857_campos_examenes',1),(18,'2017_10_04_102520_campos_parametros',1),(19,'2017_10_04_103738_create_especialidad_usuarios_table',1),(20,'2017_10_04_153259_campo_unidad_parametros',1),(21,'2017_10_05_101840_administrador_usuario',1),(22,'2017_10_05_105657_create_unidads_table',1),(23,'2017_10_09_100846_create_bitacoras_table',1),(24,'2017_10_12_150826_create_estantes_table',1),(25,'2017_10_12_151054_create_nivels_table',1),(26,'2017_10_15_084017_create_categoria_servicios_table',1),(27,'2017_10_15_212633_create_servicios_table',1),(28,'2017_10_16_112650_delete_nivels_table',1),(29,'2017_10_16_113026_add_estantes_table',1),(30,'2017_10_18_104419_create_componentes_table',1),(31,'2017_10_19_104419_create_divisions_table',1),(32,'2017_10_19_140756_create_presentacions_table',1),(33,'2017_10_19_145521_create_productos_table',1),(34,'2017_10_19_190950_create_transacions_table',1),(35,'2017_10_19_191232_create_detalle_transacions_table',1),(36,'2017_10_20_101622_add_detalle_transacions_table',1),(37,'2017_10_23_104920_deletel_transacions_table',1),(38,'2017_10_23_111217_add_detalle_transaccion_table',1),(39,'2017_10_24_105516_add_transaccions_table',1),(40,'2017_10_25_094707_create_division_productos_table',1),(41,'2017_10_25_094856_create_componente_productos_table',1),(42,'2017_10_26_092937_create_habitacions_table',1),(43,'2017_10_26_100121_create_seccions_table',1),(44,'2017_10_26_152435_create_examen_seccion_parametros_table',1),(45,'2017_10_30_102702_eliminar_estado_habitacion',1),(46,'2017_10_30_102912_estado_ocupado_habitacion',1),(47,'2017_10_30_124040_create_ingresos_table',1),(48,'2017_10_31_102404_estado_ingreso',1),(49,'2017_10_31_103630_agregar_estado_ingreso',1),(50,'2017_10_31_223754_delete_transacion_table',1),(51,'2017_10_31_223840_add_transacion_table',1),(52,'2017_10_31_224216_change_varios_table',1),(53,'2017_11_06_200153_cambios_detalle_transaccion',1),(54,'2017_11_08_093741_otros_cambios_detalle_transaccion',1),(55,'2017_11_08_131629_dui_pacientes',1),(56,'2017_11_09_092825_add_codigo_division_productos',1),(57,'2017_11_13_095457_agregar_estado_a_e_s_p',1),(58,'2017_11_15_094911_create_muestra_examens_table',1),(59,'2017_11_15_104931_modificar_tipoMuestra_examens',1),(60,'2017_11_15_111642_modificar_tipoMuestra2_examens',1),(61,'2017_11_16_094911_create_empresas_table',1),(62,'2017_11_16_101255_agregar_area_examenes',1),(63,'2017_11_16_105044_add_descuento_transaccion',1),(64,'2017_11_19_122725_eliminar_telefono',1),(65,'2017_11_19_132031_eliminar_imagenes',1),(66,'2017_11_19_132317_agregar_imagenes',1),(67,'2017_11_19_174847_eliminar_codigos',1),(68,'2017_11_19_175330_agregar_codigos_empresa',1),(69,'2017_11_20_091443_cambiode_valor_predeterminado',1),(70,'2017_11_21_104529_create_telefono_empresas_table',1),(71,'2017_11_27_084030_create_solicitud_examens_table',1),(72,'2017_11_29_101314_agregar_reactivo_examen',1),(73,'2017_12_04_111928_add_producto_contenido',1),(74,'2018_01_16_101217_nullear_f_reactivo',1),(75,'2018_01_16_133745_eliminar_usuarios',1),(76,'2018_01_22_152024_create_resultados_table',1),(77,'2018_01_22_155857_create_detalle_resultados_table',1),(78,'2018_01_23_102407_nulleando_observacion_resultados',1),(79,'2018_01_23_103218_agregando_resultados_a_detalle_resultados',1),(80,'2018_01_26_094039_correo_empresa',1),(81,'2018_01_26_105607_nulleando_unidad_parametros',1),(82,'2018_01_29_094824_residencia_paciente',1),(83,'2018_02_01_135123_create_banco_sangres_table',1),(84,'2018_02_01_135824_agregar_anular_factura',1),(85,'2018_02_02_112353_expediente_ingreso',1),(86,'2018_02_02_153316_agregar_comentario_transaccion',1),(87,'2018_02_08_151846_nullear_predeterminado_parametros',1),(88,'2018_02_09_095301_cambio_varios',1),(89,'2018_02_15_095857_solicitud_examen_ingreso',1),(90,'2018_02_19_131210_examenes_servicios',1),(91,'2018_02_20_092524_habitacion_servicios',1),(92,'2018_02_22_105355_transaccion_ingreso',1),(93,'2018_02_26_093346_eliminar_ingreso_solicitud',1),(94,'2018_02_28_091613_create_abonos_table',1),(95,'2018_03_02_103739_medico_servicio',1),(96,'2018_03_02_135301_tamanio_nombre',1),(97,'2018_03_05_094007_create_categoria_productos_table',1),(98,'2018_03_05_142421_add_varios_producto_divisionproducto',1),(99,'2018_03_06_091600_estado_transaccion',1),(100,'2018_03_12_094635_tipo_habitaciones',1),(101,'2018_03_12_124455_tipo_ingreso',1),(102,'2018_04_04_113907_modificando_reactivos',1),(103,'2018_04_04_115708_modificando_reactivos_agregar_contenido',1),(104,'2018_04_06_105518_create_signo_vitals_table',1),(105,'2018_04_09_095553_create_ultrasonografias_table',1),(106,'2018_04_10_131926_create_rayosxes_table',1),(107,'2018_04_11_105243_agregandoUltrayRayosXaSolicitudes',1),(108,'2018_04_11_105357_estado_detalle_transaccion',1),(109,'2018_04_11_171607_nullear_muestra',1),(110,'2018_04_11_173753_ultras_rayosx_servicios',1),(111,'2018_04_12_102656_create_cambio_productos_table',1),(112,'2018_04_12_103938_habitacion_nullable_ingreso',1),(113,'2018_04_12_105638_create_detalle_ultrasonografias_table',1),(114,'2018_04_17_110050_foranea_cambio_producto',1),(115,'2018_04_18_110147_create_detalle_rayoxes_table',1),(116,'2018_04_23_111010_localizacion_cambio_producto',1),(117,'2018_05_02_175502_create_consultas_table',1),(118,'2018_05_03_172559_alergia_paciente',1),(119,'2018_05_15_104321_consulta_medico',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muestra_examens`
--

DROP TABLE IF EXISTS `muestra_examens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `muestra_examens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muestra_examens`
--

LOCK TABLES `muestra_examens` WRITE;
/*!40000 ALTER TABLE `muestra_examens` DISABLE KEYS */;
INSERT INTO `muestra_examens` VALUES (1,'Heces',1,'2018-05-22 17:01:01','2018-05-22 17:01:01'),(2,'Orina',1,'2018-05-22 17:01:08','2018-05-22 17:01:08'),(3,'Sangre',1,'2018-05-22 17:01:14','2018-05-22 17:01:14'),(4,'Semen',1,'2018-05-22 17:01:21','2018-05-22 17:01:21');
/*!40000 ALTER TABLE `muestra_examens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `fechaNacimiento` date DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dui` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departamento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `municipio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alergia` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'Walter Antonio','Barrera Bonilla',1,'5153-2130','El desvio San Vicente','1970-05-22',1,'2018-05-22 17:06:42','2018-05-22 17:06:42','12350213-5',NULL,'San Vicente','San Cayetano Istepeque','Bromosol'),(2,'Alejandra Abigail','Rodríguez Villalta',0,'2361-2035','11 avenida sur','2000-04-04',1,'2018-05-22 17:07:56','2018-05-22 17:07:56','12510213-5',NULL,'San Vicente','San Vicente',NULL),(3,'Rosario','Renderos Torres',0,'1235-4123','Desvio de san vicente','1962-08-05',1,'2018-05-22 17:08:48','2018-05-22 17:08:48','12356513-2',NULL,'San Vicente','Apastepeque',NULL),(4,'Santos Adela','Quntanilla de Duran',0,NULL,'El desvio de San Vicente','1959-05-22',1,'2018-05-22 17:09:59','2018-05-22 17:09:59','12354621-3',NULL,'San Vicente','San Cayetano Istepeque','Paracetamol'),(5,'Oscar Armando','Rivera Díaz',1,'2364-6212','El desvio de San Vicente','2004-05-22',1,'2018-05-22 17:10:53','2018-05-22 17:10:53',NULL,NULL,'San Vicente','Apastepeque',NULL);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametros`
--

DROP TABLE IF EXISTS `parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombreParametro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `valorMinimo` double DEFAULT NULL,
  `valorMaximo` double DEFAULT NULL,
  `unidad` int(11) DEFAULT NULL,
  `valorPredeterminado` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros`
--

LOCK TABLES `parametros` WRITE;
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` VALUES (1,'2018-05-22 16:57:33','2018-05-22 16:57:33','Color',1,NULL,NULL,NULL,NULL),(2,'2018-05-22 16:58:47','2018-05-22 16:58:47','Capilaridad',1,1000,2000,1,'1500'),(3,'2018-05-22 16:59:36','2018-05-22 16:59:36','Globulos blancos',1,5000,10000,4,'6000'),(4,'2018-05-22 17:00:04','2018-05-22 17:00:04','Globulos rojos',1,6000,8000,4,'7000');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;
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
-- Table structure for table `presentacions`
--

DROP TABLE IF EXISTS `presentacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentacions`
--

LOCK TABLES `presentacions` WRITE;
/*!40000 ALTER TABLE `presentacions` DISABLE KEYS */;
/*!40000 ALTER TABLE `presentacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_presentacion` int(10) unsigned NOT NULL,
  `f_proveedor` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `f_categoria` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_f_presentacion_foreign` (`f_presentacion`),
  KEY `productos_f_proveedor_foreign` (`f_proveedor`),
  KEY `productos_f_categoria_foreign` (`f_categoria`),
  CONSTRAINT `productos_f_categoria_foreign` FOREIGN KEY (`f_categoria`) REFERENCES `categoria_productos` (`id`),
  CONSTRAINT `productos_f_presentacion_foreign` FOREIGN KEY (`f_presentacion`) REFERENCES `presentacions` (`id`),
  CONSTRAINT `productos_f_proveedor_foreign` FOREIGN KEY (`f_proveedor`) REFERENCES `proveedors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedors`
--

DROP TABLE IF EXISTS `proveedors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `correo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedors`
--

LOCK TABLES `proveedors` WRITE;
/*!40000 ALTER TABLE `proveedors` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rayosxes`
--

DROP TABLE IF EXISTS `rayosxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rayosxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rayosxes`
--

LOCK TABLES `rayosxes` WRITE;
/*!40000 ALTER TABLE `rayosxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `rayosxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reactivos`
--

DROP TABLE IF EXISTS `reactivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reactivos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `contenidoPorEnvase` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reactivos`
--

LOCK TABLES `reactivos` WRITE;
/*!40000 ALTER TABLE `reactivos` DISABLE KEYS */;
INSERT INTO `reactivos` VALUES (1,'Mercurio','Reactivo para examenes','2018-05-22 16:56:21','2018-05-22 16:56:21',1,500),(2,'Hidroxido de niquel','Agua con niquel','2018-05-22 16:56:46','2018-05-22 16:56:46',1,300),(3,'Amoniaco','Elemento para eliminar residuos','2018-05-22 16:57:10','2018-05-22 16:57:10',1,20);
/*!40000 ALTER TABLE `reactivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultados`
--

DROP TABLE IF EXISTS `resultados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_solicitud` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `observacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resultados_f_solicitud_foreign` (`f_solicitud`),
  CONSTRAINT `resultados_f_solicitud_foreign` FOREIGN KEY (`f_solicitud`) REFERENCES `solicitud_examens` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultados`
--

LOCK TABLES `resultados` WRITE;
/*!40000 ALTER TABLE `resultados` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccions`
--

DROP TABLE IF EXISTS `seccions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccions`
--

LOCK TABLES `seccions` WRITE;
/*!40000 ALTER TABLE `seccions` DISABLE KEYS */;
INSERT INTO `seccions` VALUES (1,'Biologica',1,'2018-05-22 17:00:22','2018-05-22 17:00:22'),(2,'Física',1,'2018-05-22 17:00:29','2018-05-22 17:00:29'),(3,'Química',1,'2018-05-22 17:00:44','2018-05-22 17:00:44'),(4,'General',1,'2018-05-22 17:00:53','2018-05-22 17:00:53');
/*!40000 ALTER TABLE `seccions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double(8,2) NOT NULL,
  `f_categoria` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `f_examen` int(10) unsigned DEFAULT NULL,
  `f_habitacion` int(10) unsigned DEFAULT NULL,
  `f_medico` int(10) unsigned DEFAULT NULL,
  `retencion` double DEFAULT NULL,
  `f_ultrasonografia` int(10) unsigned DEFAULT NULL,
  `f_rayox` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servicios_f_categoria_foreign` (`f_categoria`),
  KEY `servicios_f_examen_foreign` (`f_examen`),
  KEY `servicios_f_habitacion_foreign` (`f_habitacion`),
  KEY `servicios_f_medico_foreign` (`f_medico`),
  KEY `servicios_f_ultrasonografia_foreign` (`f_ultrasonografia`),
  KEY `servicios_f_rayox_foreign` (`f_rayox`),
  CONSTRAINT `servicios_f_categoria_foreign` FOREIGN KEY (`f_categoria`) REFERENCES `categoria_servicios` (`id`),
  CONSTRAINT `servicios_f_examen_foreign` FOREIGN KEY (`f_examen`) REFERENCES `examens` (`id`),
  CONSTRAINT `servicios_f_habitacion_foreign` FOREIGN KEY (`f_habitacion`) REFERENCES `habitacions` (`id`),
  CONSTRAINT `servicios_f_medico_foreign` FOREIGN KEY (`f_medico`) REFERENCES `users` (`id`),
  CONSTRAINT `servicios_f_rayox_foreign` FOREIGN KEY (`f_rayox`) REFERENCES `rayosxes` (`id`),
  CONSTRAINT `servicios_f_ultrasonografia_foreign` FOREIGN KEY (`f_ultrasonografia`) REFERENCES `ultrasonografias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Dra. Diana Lourde Portillo Velasquez',7.00,1,1,'2018-05-18 19:31:52','2018-05-18 19:31:52',NULL,NULL,4,3,NULL,NULL),(2,'Dra. Saira Rebeka Ventura Benitez',20.00,1,1,'2018-05-18 19:33:53','2018-05-18 19:33:53',NULL,NULL,5,5,NULL,NULL),(3,'Dra. Bessie Elena Chacón Calixto',5.00,1,1,'2018-05-18 19:35:13','2018-05-18 19:35:13',NULL,NULL,6,2,NULL,NULL),(4,'Habitación 1',30.00,2,1,'2018-05-22 16:52:36','2018-05-22 16:52:36',NULL,1,NULL,NULL,NULL,NULL),(5,'Habitación 2',35.00,2,1,'2018-05-22 16:52:50','2018-05-22 16:52:50',NULL,2,NULL,NULL,NULL,NULL),(6,'Habitación 3',20.00,2,1,'2018-05-22 16:53:23','2018-05-22 16:53:23',NULL,3,NULL,NULL,NULL,NULL),(7,'Habitación 1',15.00,2,1,'2018-05-22 16:53:32','2018-05-22 16:53:32',NULL,4,NULL,NULL,NULL,NULL),(8,'Ambulancia',100.00,3,1,'2018-05-22 16:54:39','2018-05-22 16:54:39',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Aire acondicionado',35.00,3,1,'2018-05-22 16:54:57','2018-05-22 16:54:57',NULL,NULL,NULL,NULL,NULL,NULL),(10,'General de heces',3.00,4,1,'2018-05-22 17:02:01','2018-05-22 17:02:01',1,NULL,NULL,NULL,NULL,NULL),(11,'Bilirrubina',5.00,4,1,'2018-05-22 17:02:46','2018-05-22 17:02:46',2,NULL,NULL,NULL,NULL,NULL),(12,'General de orina',3.00,4,1,'2018-05-22 17:03:18','2018-05-22 17:03:18',3,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signo_vitals`
--

DROP TABLE IF EXISTS `signo_vitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `signo_vitals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `temperatura` double DEFAULT NULL,
  `sistole` int(11) DEFAULT NULL,
  `diastole` int(11) DEFAULT NULL,
  `pulso` int(11) DEFAULT NULL,
  `frecuencia_cardiaca` int(11) DEFAULT NULL,
  `frecuencia_respiratoria` int(11) DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `medida` tinyint(1) NOT NULL DEFAULT '1',
  `glucosa` double DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `f_ingreso` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `signo_vitals_f_ingreso_foreign` (`f_ingreso`),
  CONSTRAINT `signo_vitals_f_ingreso_foreign` FOREIGN KEY (`f_ingreso`) REFERENCES `ingresos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signo_vitals`
--

LOCK TABLES `signo_vitals` WRITE;
/*!40000 ALTER TABLE `signo_vitals` DISABLE KEYS */;
INSERT INTO `signo_vitals` VALUES (2,37,120,66,67,68,15,68,1,23,168,1,'2018-05-23 17:01:42','2018-05-23 17:01:42');
/*!40000 ALTER TABLE `signo_vitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_examens`
--

DROP TABLE IF EXISTS `solicitud_examens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_examens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo_muestra` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_examen` int(10) unsigned DEFAULT NULL,
  `f_paciente` int(10) unsigned NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `f_transaccion` int(10) unsigned DEFAULT NULL,
  `f_ultrasonografia` int(10) unsigned DEFAULT NULL,
  `f_rayox` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitud_examens_f_examen_foreign` (`f_examen`),
  KEY `solicitud_examens_f_paciente_foreign` (`f_paciente`),
  KEY `solicitud_examens_f_transaccion_foreign` (`f_transaccion`),
  KEY `solicitud_examens_f_ultrasonografia_foreign` (`f_ultrasonografia`),
  KEY `solicitud_examens_f_rayox_foreign` (`f_rayox`),
  CONSTRAINT `solicitud_examens_f_examen_foreign` FOREIGN KEY (`f_examen`) REFERENCES `examens` (`id`),
  CONSTRAINT `solicitud_examens_f_paciente_foreign` FOREIGN KEY (`f_paciente`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `solicitud_examens_f_rayox_foreign` FOREIGN KEY (`f_rayox`) REFERENCES `rayosxes` (`id`),
  CONSTRAINT `solicitud_examens_f_transaccion_foreign` FOREIGN KEY (`f_transaccion`) REFERENCES `transacions` (`id`),
  CONSTRAINT `solicitud_examens_f_ultrasonografia_foreign` FOREIGN KEY (`f_ultrasonografia`) REFERENCES `ultrasonografias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_examens`
--

LOCK TABLES `solicitud_examens` WRITE;
/*!40000 ALTER TABLE `solicitud_examens` DISABLE KEYS */;
INSERT INTO `solicitud_examens` VALUES (1,'1-1-18',1,1,1,'2018-05-22 18:03:27','2018-05-22 18:03:33',1,NULL,NULL);
/*!40000 ALTER TABLE `solicitud_examens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefono_empresas`
--

DROP TABLE IF EXISTS `telefono_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefono_empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('hospital','farmacia','laboratorio','clinica') COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_empresa` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `telefono_empresas_f_empresa_foreign` (`f_empresa`),
  CONSTRAINT `telefono_empresas_f_empresa_foreign` FOREIGN KEY (`f_empresa`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono_empresas`
--

LOCK TABLES `telefono_empresas` WRITE;
/*!40000 ALTER TABLE `telefono_empresas` DISABLE KEYS */;
INSERT INTO `telefono_empresas` VALUES (1,'2018-05-18 19:05:50','2018-05-18 19:05:50','2393-4949','hospital',1),(2,'2018-05-18 19:05:50','2018-05-18 19:05:50','2393-4949','laboratorio',1),(3,'2018-05-18 19:05:50','2018-05-18 19:05:50','7687-6876','clinica',1),(4,'2018-05-18 19:05:50','2018-05-18 19:05:50','9878-9899','farmacia',1);
/*!40000 ALTER TABLE `telefono_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telefono_usuarios`
--

DROP TABLE IF EXISTS `telefono_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telefono_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `telefono_usuarios_f_usuario_foreign` (`f_usuario`),
  CONSTRAINT `telefono_usuarios_f_usuario_foreign` FOREIGN KEY (`f_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telefono_usuarios`
--

LOCK TABLES `telefono_usuarios` WRITE;
/*!40000 ALTER TABLE `telefono_usuarios` DISABLE KEYS */;
INSERT INTO `telefono_usuarios` VALUES (1,'2018-05-18 18:56:06','2018-05-18 18:56:06','6185-0246',1),(2,'2018-05-18 19:07:58','2018-05-18 19:07:58','3243-4243',2),(3,'2018-05-18 19:10:30','2018-05-18 19:10:30','3242-3422',3),(4,'2018-05-18 19:31:52','2018-05-18 19:31:52','2423-2342',4),(5,'2018-05-18 19:33:53','2018-05-18 19:33:53','3242-3233',5),(6,'2018-05-18 19:35:13','2018-05-18 19:35:13','4223-2444',6),(7,'2018-05-18 19:39:22','2018-05-18 19:39:22','3423-4234',7);
/*!40000 ALTER TABLE `telefono_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transacions`
--

DROP TABLE IF EXISTS `transacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transacions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `f_cliente` int(10) unsigned DEFAULT NULL,
  `f_proveedor` int(10) unsigned DEFAULT NULL,
  `f_usuario` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `localizacion` int(11) NOT NULL,
  `factura` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descuento` double NOT NULL DEFAULT '0',
  `comentario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  `f_ingreso` int(10) unsigned DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `transacions_f_cliente_foreign` (`f_cliente`),
  KEY `transacions_f_proveedor_foreign` (`f_proveedor`),
  KEY `transacions_f_usuario_foreign` (`f_usuario`),
  KEY `transacions_f_ingreso_foreign` (`f_ingreso`),
  CONSTRAINT `transacions_f_cliente_foreign` FOREIGN KEY (`f_cliente`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `transacions_f_ingreso_foreign` FOREIGN KEY (`f_ingreso`) REFERENCES `ingresos` (`id`),
  CONSTRAINT `transacions_f_proveedor_foreign` FOREIGN KEY (`f_proveedor`) REFERENCES `proveedors` (`id`),
  CONSTRAINT `transacions_f_usuario_foreign` FOREIGN KEY (`f_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transacions`
--

LOCK TABLES `transacions` WRITE;
/*!40000 ALTER TABLE `transacions` DISABLE KEYS */;
INSERT INTO `transacions` VALUES (1,'2018-05-22',1,NULL,1,'2018-05-22 17:43:49','2018-05-22 17:43:49',1,'1',0,NULL,2,1,0),(2,'2018-05-28',1,NULL,1,'2018-05-28 15:59:43','2018-05-28 15:59:43',1,'2',0,NULL,2,2,0);
/*!40000 ALTER TABLE `transacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ultrasonografias`
--

DROP TABLE IF EXISTS `ultrasonografias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ultrasonografias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ultrasonografias`
--

LOCK TABLES `ultrasonografias` WRITE;
/*!40000 ALTER TABLE `ultrasonografias` DISABLE KEYS */;
/*!40000 ALTER TABLE `ultrasonografias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidads`
--

DROP TABLE IF EXISTS `unidads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidads`
--

LOCK TABLES `unidads` WRITE;
/*!40000 ALTER TABLE `unidads` DISABLE KEYS */;
INSERT INTO `unidads` VALUES (1,'mol',1,'2018-05-22 16:57:58','2018-05-22 16:57:58'),(2,'mol / g',1,'2018-05-22 16:58:05','2018-05-22 16:58:05'),(3,'g',1,'2018-05-22 16:58:11','2018-05-22 16:58:11'),(4,'unidad',1,'2018-05-22 16:58:22','2018-05-22 16:58:22');
/*!40000 ALTER TABLE `unidads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `dui` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `tipoUsuario` enum('Administración','Gerencia','Médico','Recepción','Laboaratorio','Ultrasonografía','Rayos X','Farmacia','Enfermería') COLLATE utf8mb4_unicode_ci NOT NULL,
  `juntaVigilancia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `firma` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen.jpg',
  `sello` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen.jpg',
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noImgen.jpg',
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  `eliminar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Recepcion','rne.eclipse@gmail.com','$2y$10$BZ0dFbZlTHaHtnOYvbTs4egsDt6ksKqJk//ZKz0sXYFv3XswhzJbm','hHLqMk1neIV5w37jT3uwMSE8fZpqbscn3MCbHrcqneL2naiBlrd2M6X9eMsk','2018-05-18 18:56:06','2018-05-18 18:57:03','Carlos René','Ruiz Morazán','San Vicente','1993-09-03','23534233-2',1,'Recepción',NULL,1,'noImgen.jpg','noImgen.jpg','public/foto/5THSSUdk5lGy0iMud4n1Sx0YL5eHlMcdeDI9Qkf3.jpeg',1,1),(2,'Laboratorio','l@gmail.com','$2y$10$8b18bMhsrO4xyjdzY.DKCekJA/FyiiqZnhw0mCebKx0kxT9KNY/Pu','26iPI40fGioF2BImOb5WtILSOr77uAXsNagX75DRioWmIVMb7I7XSpewyIAH','2018-05-18 19:07:58','2018-05-18 19:08:54','Alejandro Antonio','Henríquez Merino','San Vicente','1994-02-16','34232424-3',1,'Laboaratorio','42433',1,'public/firma/vsfuvb7UZlCFxrcKP10UL71o3Pj0uo2IVAAY2OME.png','public/sello/12ivTNAhf21l2fTVvIJNoKYN9jdHWii9aA0iyvrs.png','public/foto/pAB15HR54th2cx0lMs8J8BMYhV2zrOOBxo35XQtX.jpeg',0,1),(3,'Farmacia','f@gmail.com','$2y$10$/gsAkSc6YM2JrLm3reyPye6bOP.Cpw1MkgcNkEGEbdvCAR/haCFMy','yRT55wSD4yzZalGuju6AgVNotucL5fDt9wiD0lh6pM4tBF6Puz4zvhV5QjyE','2018-05-18 19:10:30','2018-05-18 19:11:27','Ingrid María','Ayala Morales','San Sebastian','1994-06-14','34298987-8',0,'Farmacia','12344',1,'noImgen.jpg','noImgen.jpg','public/foto/sIT4Az20Z8nVj2E5aMazSKBes5vOOwTRHTPLsRcT.jpeg',0,1),(4,'Medico1','m1@gmail.com','$2y$10$DqkCYnhIqCBhXObct6L3..dbyXlz61zzFUpI4K0Xpw.4Wx9.a.DKq','djAxUgVYNY4lcjM7dtYUir7aO4qQ8JleeV02YRsYxwChvrhRRSQA9PE3bikF','2018-05-18 19:31:51','2018-05-18 19:36:21','Diana Lourde','Portillo Velasquez','Verapaz','1992-10-22','38498789-8',0,'Médico','1234123',1,'public/firma/yf45QosXA9qNfbQUEXEHBrJlvBccOFaWcuRBkKgx.png','public/sello/cGdNnqSwzOMz7SyxoKzBpjHSZiNgtmkWbSXKwrEW.png','public/foto/REhAN925HqAFbM1MU2EfUNcn4ns7KNsNdt69WJOM.jpeg',0,1),(5,'Medico2','m2@gmail.com','$2y$10$6BXqsHrAE/DMnQ8nVKBBYuEM7PgAUOSLwmBORXmgNbnwTU1O.v.YW','GUoRfH1XLADpvwdwmGA6wuUSsyxjZbO0UlIznfum3ZBRw7jdoWUcO3fm6wSs','2018-05-18 19:33:53','2018-05-18 19:37:09','Saira Rebeka','Ventura Benitez','Cojutepeque','1991-04-27','24787878-7',0,'Médico','324232',1,'public/firma/feIWVO2uzGC3Cxsp5OQabM3iUcWIfyKiQ8ivI1RD.png','public/sello/QKIw0twnyQRi3wL2meSrAeC5hRSN6puNpjnrkXpU.png','public/foto/LYsZ0NPJYEzKLmFlgYYYUp9aezlePBchqZu6kP1H.png',0,1),(6,'Medico3','m3@gmail.com','$2y$10$oJo2Ny4w7I6oHwxSNW0xqOB3yGSyPXkhXVBq97vccYR603nC2vPoW','k56gyppgaTqa00cupPOpiXvKJ7Qf7FehLPOTSHMwurQbG3QFdyv0qIUUZ0Te','2018-05-18 19:35:12','2018-05-18 19:37:46','Bessie Elena','Chacón Calixto','San Vicente','1994-08-11','23423423-4',0,'Médico','324234',1,'public/firma/FwlBqoGtrVj34HeogNHmsC30N5KcpFN6WBMxjEz6.png','public/sello/wWPhs5GJFJHmoLzCLCwuYROIyP3T90rtATrwaf6g.png','public/foto/Lp1sxsmr6bj8az8cKhPFLO0OrlwD9TBCWjrh35jp.png',0,1),(7,'Enfermeria','e@gmail.com','$2y$10$8ItW7GOwrALPIk0Vg3d4XeOIph.2FVXpmYo8UDywNq8CxGjd0xag6','KLgmnDLvKJSdRPCB1gviB8FX7hyKI61GyTmHj36XJHzsQy1Y7VJWuuaQk4t1','2018-05-18 19:39:21','2018-05-18 19:39:58','Guadalupe Yamileth','Palacios Quintanilla','San Vicente','1995-06-01','34224344-3',0,'Enfermería',NULL,1,'noImgen.jpg','noImgen.jpg','public/foto/LHXlw8DQCvzavOiyGTwJjAJXfvgNCbhofnSh6Bdh.png',0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'blissey'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29  9:40:39
