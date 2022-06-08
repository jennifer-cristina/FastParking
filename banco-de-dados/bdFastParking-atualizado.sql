-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: dbfastparking
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `tblbloco`
--

DROP TABLE IF EXISTS `tblbloco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblbloco` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `capacidadeMaxima` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbloco`
--

LOCK TABLES `tblbloco` WRITE;
/*!40000 ALTER TABLE `tblbloco` DISABLE KEYS */;
INSERT INTO `tblbloco` VALUES (1,'A',200),(2,'B',200),(3,'C',150);
/*!40000 ALTER TABLE `tblbloco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcliente`
--

DROP TABLE IF EXISTS `tblcliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcliente` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cnh` varchar(45) DEFAULT NULL,
  `idSexo` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Sexo_Cliente` (`idSexo`),
  CONSTRAINT `FK_Sexo_Cliente` FOREIGN KEY (`idSexo`) REFERENCES `tblsexo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcliente`
--

LOCK TABLES `tblcliente` WRITE;
/*!40000 ALTER TABLE `tblcliente` DISABLE KEYS */;
INSERT INTO `tblcliente` VALUES (6,'Luiz Carvalho dos Santos da Silva','514.513.425-56','56.246.551-8','56546546545',2),(9,'Gustavo lima','514.513.425-56','56.246.551-8','56546546545',2);
/*!40000 ALTER TABLE `tblcliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontrole`
--

DROP TABLE IF EXISTS `tblcontrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcontrole` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `horaEntrada` time NOT NULL,
  `horaSaida` time DEFAULT NULL,
  `dataEntrada` date NOT NULL,
  `dataSaida` date DEFAULT NULL,
  `idVeiculo` int unsigned NOT NULL,
  `idVaga` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Veiculo_Controle` (`idVeiculo`),
  KEY `FK_Vaga_Controle` (`idVaga`),
  CONSTRAINT `FK_Vaga_Controle` FOREIGN KEY (`idVaga`) REFERENCES `tblvaga` (`id`),
  CONSTRAINT `FK_Veiculo_Controle` FOREIGN KEY (`idVeiculo`) REFERENCES `tblveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontrole`
--

LOCK TABLES `tblcontrole` WRITE;
/*!40000 ALTER TABLE `tblcontrole` DISABLE KEYS */;
INSERT INTO `tblcontrole` VALUES (1,'15:03:00',NULL,'2022-03-06',NULL,2,16),(2,'16:00:00','17:00:00','2022-06-07','2022-06-07',6,16),(3,'12:00:00',NULL,'2022-03-06',NULL,2,16),(4,'14:00:00',NULL,'2022-03-08',NULL,6,16),(5,'14:00:00',NULL,'2022-03-08',NULL,6,16),(6,'14:00:00',NULL,'2022-03-08',NULL,6,16),(7,'14:00:00',NULL,'2022-03-08',NULL,6,16),(8,'19:00:00',NULL,'2022-03-08',NULL,6,16),(9,'19:00:00',NULL,'2022-03-08',NULL,6,16),(10,'19:00:00',NULL,'2022-03-08',NULL,6,16),(11,'19:00:00',NULL,'2022-03-08',NULL,6,16),(12,'19:00:00',NULL,'2022-03-08',NULL,6,16),(13,'21:00:00',NULL,'2022-03-08',NULL,6,18),(14,'21:00:00',NULL,'2022-03-08',NULL,6,18),(15,'22:00:00',NULL,'2022-03-08',NULL,6,18),(16,'20:00:00',NULL,'2022-03-08',NULL,6,19),(17,'16:47:00','18:00:00','2022-03-08','2022-03-08',6,19),(18,'16:47:00',NULL,'2022-03-08',NULL,6,19);
/*!40000 ALTER TABLE `tblcontrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcor`
--

DROP TABLE IF EXISTS `tblcor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblcor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcor`
--

LOCK TABLES `tblcor` WRITE;
/*!40000 ALTER TABLE `tblcor` DISABLE KEYS */;
INSERT INTO `tblcor` VALUES (1,'Vermelho'),(2,'Marrom'),(3,'Prata'),(4,'Branco'),(5,'Amarelo'),(6,'Roxo'),(7,'Cinza'),(8,'Verde'),(9,'Preto'),(10,'Azul');
/*!40000 ALTER TABLE `tblcor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsexo`
--

DROP TABLE IF EXISTS `tblsexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblsexo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(1) NOT NULL,
  `nome` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsexo`
--

LOCK TABLES `tblsexo` WRITE;
/*!40000 ALTER TABLE `tblsexo` DISABLE KEYS */;
INSERT INTO `tblsexo` VALUES (1,'F','Feminino'),(2,'M','Masculino'),(3,'O','Outros');
/*!40000 ALTER TABLE `tblsexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltelefone`
--

DROP TABLE IF EXISTS `tbltelefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltelefone` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ddd` varchar(5) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `idCliente` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Cliente_Telefone` (`idCliente`),
  CONSTRAINT `FK_Cliente_Telefone` FOREIGN KEY (`idCliente`) REFERENCES `tblcliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltelefone`
--

LOCK TABLES `tbltelefone` WRITE;
/*!40000 ALTER TABLE `tbltelefone` DISABLE KEYS */;
INSERT INTO `tbltelefone` VALUES (4,'055','94578-8655',6);
/*!40000 ALTER TABLE `tbltelefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbltipovaga`
--

DROP TABLE IF EXISTS `tbltipovaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbltipovaga` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `precoHora` decimal(50,0) NOT NULL,
  `precoAdicional` decimal(50,0) DEFAULT NULL,
  `precoDiaria` decimal(50,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbltipovaga`
--

LOCK TABLES `tbltipovaga` WRITE;
/*!40000 ALTER TABLE `tbltipovaga` DISABLE KEYS */;
INSERT INTO `tbltipovaga` VALUES (1,'Pequeno porte',4,2,40),(2,'Medio porte',6,3,60),(3,'Grande porte',8,4,80);
/*!40000 ALTER TABLE `tbltipovaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblvaga`
--

DROP TABLE IF EXISTS `tblvaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblvaga` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `statusVaga` tinyint(1) NOT NULL,
  `preferencial` tinyint(1) NOT NULL,
  `idTipoVaga` int unsigned NOT NULL,
  `idBloco` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_TipoVaga_Vaga` (`idTipoVaga`),
  KEY `FK_Bloco_Vaga` (`idBloco`),
  CONSTRAINT `FK_Bloco_Vaga` FOREIGN KEY (`idBloco`) REFERENCES `tblbloco` (`id`),
  CONSTRAINT `FK_TipoVaga_Vaga` FOREIGN KEY (`idTipoVaga`) REFERENCES `tbltipovaga` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblvaga`
--

LOCK TABLES `tblvaga` WRITE;
/*!40000 ALTER TABLE `tblvaga` DISABLE KEYS */;
INSERT INTO `tblvaga` VALUES (16,1,0,2,1),(17,1,0,2,1),(18,1,0,2,1),(19,0,0,2,1);
/*!40000 ALTER TABLE `tblvaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblveiculo`
--

DROP TABLE IF EXISTS `tblveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblveiculo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(10) NOT NULL,
  `idCor` int unsigned NOT NULL,
  `idCliente` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Cor_Veiculo` (`idCor`),
  KEY `FK_Cliente_Veiculo` (`idCliente`),
  CONSTRAINT `FK_Cliente_Veiculo` FOREIGN KEY (`idCliente`) REFERENCES `tblcliente` (`id`),
  CONSTRAINT `FK_Cor_Veiculo` FOREIGN KEY (`idCor`) REFERENCES `tblcor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblveiculo`
--

LOCK TABLES `tblveiculo` WRITE;
/*!40000 ALTER TABLE `tblveiculo` DISABLE KEYS */;
INSERT INTO `tblveiculo` VALUES (2,'4657-ajsh',7,6),(6,'4596-ajsh',7,6);
/*!40000 ALTER TABLE `tblveiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-08 17:02:29
