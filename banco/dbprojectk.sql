CREATE DATABASE  IF NOT EXISTS `dbprojectk` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbprojectk`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dbprojectk
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `idAlbum` int(11) NOT NULL AUTO_INCREMENT,
  `nomeAlbum` varchar(45) NOT NULL,
  `dataAlbum` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idAlbum`),
  KEY `fk_album_usuario_idx` (`idUsuario`),
  CONSTRAINT `fk_album_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amigo`
--

DROP TABLE IF EXISTS `amigo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amigo` (
  `idSolitacao` int(11) NOT NULL AUTO_INCREMENT,
  `dataSolicitacao` date NOT NULL,
  `idSolicitante` int(11) NOT NULL,
  `idSolicitado` int(11) NOT NULL,
  `dataConfirmacao` date DEFAULT NULL,
  PRIMARY KEY (`idSolitacao`),
  KEY `fk_solicitado_usuario_idx` (`idSolicitado`),
  KEY `fk_solicitante_usuario_idx` (`idSolicitante`),
  CONSTRAINT `fk_solicitado_usuario` FOREIGN KEY (`idSolicitado`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_solicitante_usuario` FOREIGN KEY (`idSolicitante`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amigo`
--

LOCK TABLES `amigo` WRITE;
/*!40000 ALTER TABLE `amigo` DISABLE KEYS */;
/*!40000 ALTER TABLE `amigo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversa`
--

DROP TABLE IF EXISTS `conversa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversa` (
  `idConversa` int(11) NOT NULL AUTO_INCREMENT,
  `dataConversa` date NOT NULL,
  `idRemetenteCon` int(11) NOT NULL,
  `idDestinatarioCon` int(11) NOT NULL,
  PRIMARY KEY (`idConversa`),
  KEY `fk_remetente_con_usuario_idx` (`idRemetenteCon`),
  KEY `fk_destinatario_con_usuario_idx` (`idDestinatarioCon`),
  CONSTRAINT `fk_destinatario_con_usuario` FOREIGN KEY (`idDestinatarioCon`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_remetente_con_usuario` FOREIGN KEY (`idRemetenteCon`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversa`
--

LOCK TABLES `conversa` WRITE;
/*!40000 ALTER TABLE `conversa` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foto` (
  `idFoto` int(11) NOT NULL AUTO_INCREMENT,
  `idAlbum` int(11) NOT NULL,
  `legendaFoto` varchar(80) DEFAULT NULL,
  `nomeFoto` varchar(64) NOT NULL,
  `dataFoto` date NOT NULL,
  PRIMARY KEY (`idFoto`),
  KEY `fk_foto_album_idx` (`idAlbum`),
  CONSTRAINT `fk_foto_album` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`idAlbum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto`
--

LOCK TABLES `foto` WRITE;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagem`
--

DROP TABLE IF EXISTS `mensagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensagem` (
  `idMensagem` int(11) NOT NULL AUTO_INCREMENT,
  `idConversa` int(11) NOT NULL,
  `textoMsg` varchar(300) NOT NULL,
  `idDestinatarioMsg` int(11) NOT NULL,
  `idRemetenteMsg` int(11) NOT NULL,
  `dataMsg` date NOT NULL,
  `horaMsg` varchar(5) NOT NULL,
  PRIMARY KEY (`idMensagem`),
  KEY `fk_msg_con_idx` (`idConversa`),
  KEY `fk_remetente_msg_usuario_idx` (`idRemetenteMsg`),
  KEY `fk_destinatario_msg_usuario_idx` (`idDestinatarioMsg`),
  CONSTRAINT `fk_destinatario_msg_usuario` FOREIGN KEY (`idDestinatarioMsg`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_msg_con` FOREIGN KEY (`idConversa`) REFERENCES `conversa` (`idConversa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_remetente_msg_usuario` FOREIGN KEY (`idRemetenteMsg`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagem`
--

LOCK TABLES `mensagem` WRITE;
/*!40000 ALTER TABLE `mensagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `idPost` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `textoPost` varchar(500) DEFAULT NULL,
  `dataPost` date DEFAULT NULL,
  `horaPost` varchar(5) DEFAULT NULL,
  `tipoPost` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idPost`),
  KEY `fk_post_usuario_idx` (`idUsuario`),
  CONSTRAINT `fk_post_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fotoPerfil` varchar(64) DEFAULT NULL,
  `dataCadastro` date NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-22 14:09:15
