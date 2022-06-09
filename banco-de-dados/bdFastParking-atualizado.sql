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
-- Table structure for table `tblBloco`
--

DROP TABLE IF EXISTS `tblBloco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblBloco` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `capacidadeMaxima` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBloco`
--

LOCK TABLES `tblBloco` WRITE;
/*!40000 ALTER TABLE `tblBloco` DISABLE KEYS */;
INSERT INTO `tblBloco` VALUES (1,'A',200),(2,'B',200),(3,'C',150);
/*!40000 ALTER TABLE `tblBloco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCliente`
--

DROP TABLE IF EXISTS `tblCliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblCliente` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cnh` varchar(45) DEFAULT NULL,
  `idSexo` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Sexo_Cliente` (`idSexo`),
  CONSTRAINT `FK_Sexo_Cliente` FOREIGN KEY (`idSexo`) REFERENCES `tblSexo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCliente`
--

LOCK TABLES `tblCliente` WRITE;
/*!40000 ALTER TABLE `tblCliente` DISABLE KEYS */;
INSERT INTO `tblCliente` VALUES (6,'Luiz Carvalho dos Santos da Silva','514.513.425-56','56.246.551-8','56546546545',2),(9,'Gustavo lima','514.513.425-56','56.246.551-8','56546546545',2);
/*!40000 ALTER TABLE `tblCliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblControle`
--

DROP TABLE IF EXISTS `tblControle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblControle` (
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
  CONSTRAINT `FK_Vaga_Controle` FOREIGN KEY (`idVaga`) REFERENCES `tblVaga` (`id`),
  CONSTRAINT `FK_Veiculo_Controle` FOREIGN KEY (`idVeiculo`) REFERENCES `tblVeiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblControle`
--

LOCK TABLES `tblControle` WRITE;
/*!40000 ALTER TABLE `tblControle` DISABLE KEYS */;
INSERT INTO `tblControle` VALUES (1,'15:03:00',NULL,'2022-03-06',NULL,2,16),(2,'16:00:00','17:00:00','2022-06-07','2022-06-07',6,16),(3,'12:00:00',NULL,'2022-03-06',NULL,2,16),(4,'14:00:00',NULL,'2022-03-08',NULL,6,16),(5,'14:00:00',NULL,'2022-03-08',NULL,6,16),(6,'14:00:00',NULL,'2022-03-08',NULL,6,16),(7,'14:00:00',NULL,'2022-03-08',NULL,6,16),(8,'19:00:00',NULL,'2022-03-08',NULL,6,16),(9,'19:00:00',NULL,'2022-03-08',NULL,6,16),(10,'19:00:00',NULL,'2022-03-08',NULL,6,16),(11,'19:00:00',NULL,'2022-03-08',NULL,6,16),(12,'19:00:00',NULL,'2022-03-08',NULL,6,16),(13,'21:00:00',NULL,'2022-03-08',NULL,6,18),(14,'21:00:00',NULL,'2022-03-08',NULL,6,18),(15,'22:00:00',NULL,'2022-03-08',NULL,6,18),(16,'20:00:00',NULL,'2022-03-08',NULL,6,19),(17,'16:47:00','18:00:00','2022-03-08','2022-03-08',6,19),(18,'16:47:00',NULL,'2022-03-08',NULL,6,19);
/*!40000 ALTER TABLE `tblControle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCor`
--

DROP TABLE IF EXISTS `tblCor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblCor` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCor`
--

LOCK TABLES `tblCor` WRITE;
/*!40000 ALTER TABLE `tblCor` DISABLE KEYS */;
INSERT INTO `tblCor` VALUES (1,'Vermelho'),(2,'Marrom'),(3,'Prata'),(4,'Branco'),(5,'Amarelo'),(6,'Roxo'),(7,'Cinza'),(8,'Verde'),(9,'Preto'),(10,'Azul');
/*!40000 ALTER TABLE `tblCor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblSexo`
--

DROP TABLE IF EXISTS `tblSexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblSexo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(1) NOT NULL,
  `nome` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblSexo`
--

LOCK TABLES `tblSexo` WRITE;
/*!40000 ALTER TABLE `tblSexo` DISABLE KEYS */;
INSERT INTO `tblSexo` VALUES (1,'F','Feminino'),(2,'M','Masculino'),(3,'O','Outros');
/*!40000 ALTER TABLE `tblSexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTelefone`
--

DROP TABLE IF EXISTS `tblTelefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblTelefone` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ddd` varchar(5) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `idCliente` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Cliente_Telefone` (`idCliente`),
  CONSTRAINT `FK_Cliente_Telefone` FOREIGN KEY (`idCliente`) REFERENCES `tblCliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTelefone`
--

LOCK TABLES `tblTelefone` WRITE;
/*!40000 ALTER TABLE `tblTelefone` DISABLE KEYS */;
INSERT INTO `tblTelefone` VALUES (4,'055','94578-8655',6);
/*!40000 ALTER TABLE `tblTelefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTipoVaga`
--

DROP TABLE IF EXISTS `tblTipoVaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblTipoVaga` (
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
-- Dumping data for table `tblTipoVaga`
--

LOCK TABLES `tblTipoVaga` WRITE;
/*!40000 ALTER TABLE `tblTipoVaga` DISABLE KEYS */;
INSERT INTO `tblTipoVaga` VALUES (1,'Pequeno porte',4,2,40),(2,'Medio porte',6,3,60),(3,'Grande porte',8,4,80);
/*!40000 ALTER TABLE `tblTipoVaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblVaga`
--

DROP TABLE IF EXISTS `tblVaga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblVaga` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `statusVaga` tinyint(1) NOT NULL,
  `preferencial` tinyint(1) NOT NULL,
  `idTipoVaga` int unsigned NOT NULL,
  `idBloco` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_TipoVaga_Vaga` (`idTipoVaga`),
  KEY `FK_Bloco_Vaga` (`idBloco`),
  CONSTRAINT `FK_Bloco_Vaga` FOREIGN KEY (`idBloco`) REFERENCES `tblBloco` (`id`),
  CONSTRAINT `FK_TipoVaga_Vaga` FOREIGN KEY (`idTipoVaga`) REFERENCES `tblTipoVaga` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblVaga`
--

LOCK TABLES `tblVaga` WRITE;
/*!40000 ALTER TABLE `tblVaga` DISABLE KEYS */;
INSERT INTO `tblVaga` VALUES (16,1,0,2,1),(17,1,0,2,1),(18,1,0,2,1),(19,0,0,2,1);
/*!40000 ALTER TABLE `tblVaga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblVeiculo`
--

DROP TABLE IF EXISTS `tblVeiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblVeiculo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(10) NOT NULL,
  `idCor` int unsigned NOT NULL,
  `idCliente` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_Cor_Veiculo` (`idCor`),
  KEY `FK_Cliente_Veiculo` (`idCliente`),
  CONSTRAINT `FK_Cliente_Veiculo` FOREIGN KEY (`idCliente`) REFERENCES `tblCliente` (`id`),
  CONSTRAINT `FK_Cor_Veiculo` FOREIGN KEY (`idCor`) REFERENCES `tblCor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblVeiculo`
--

LOCK TABLES `tblVeiculo` WRITE;
/*!40000 ALTER TABLE `tblVeiculo` DISABLE KEYS */;
INSERT INTO `tblVeiculo` VALUES (2,'4657-ajsh',7,6),(6,'4596-ajsh',7,6);
/*!40000 ALTER TABLE `tblVeiculo` ENABLE KEYS */;
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
