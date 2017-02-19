-- MySQL dump 10.13  Distrib 5.5.23, for Win64 (x86)
--
-- Host: localhost    Database: atm
-- ------------------------------------------------------
-- Server version	5.5.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES cp1251 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `atm`
--

DROP TABLE IF EXISTS `atm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atm` (
  `id_atm` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` char(50) NOT NULL,
  `serial_number` char(10) NOT NULL,
  `atm_address` char(25) NOT NULL,
  `organization` char(25) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `id_service_staff` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  PRIMARY KEY (`id_atm`),
  UNIQUE KEY `serial_num` (`serial_number`),
  KEY `id_bank` (`id_bank`),
  KEY `id_room` (`id_room`),
  KEY `id_service` (`id_service_staff`),
  CONSTRAINT `atmid_bank` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atmid_room` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atmid_service` FOREIGN KEY (`id_service_staff`) REFERENCES `service_ctaff` (`id_service_staff`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atm`
--

LOCK TABLES `atm` WRITE;
/*!40000 ALTER TABLE `atm` DISABLE KEYS */;
INSERT INTO `atm` VALUES (1,'��� ������-̻','AFY1215621','������, 18','��������',1,1,1),(2,'��� ����� ����������','FCD2560169','������, 8','�������������',1,5,2),(3,'SmartGames','HTM2568402','���������, 52','�����������',2,4,3),(4,'��� ������-̻','ETU2658001','�������, 24','��������',3,8,4),(5,'Wincor Nixdorf AG','JUH2564000','�����������, 10','���',1,2,5),(6,'SmartGames','OKN2000145','����������, 19','���',2,11,4),(7,'��� ������-̻','VHB5648015','�������, 1','��������',1,3,5),(8,'��� ������-̻','ERS2015054','������, 25','���',5,10,6),(9,'��� ����� ����������','WTY2546852','���������������, 11','�����������',5,12,4),(10,'Wincor Nixdorf AG','JIN1110256','������, 152','�����������',2,15,10);
/*!40000 ALTER TABLE `atm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `bic` decimal(9,0) NOT NULL,
  `level` decimal(1,0) NOT NULL,
  `share_premium` decimal(19,4) NOT NULL,
  `name` char(50) NOT NULL,
  `address` char(25) NOT NULL,
  `chairmain` char(50) NOT NULL,
  PRIMARY KEY (`id_bank`),
  UNIQUE KEY `bic` (`bic`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` VALUES (1,512360012,1,1500000.0000,'��������','������, 40','������� ������ ��������'),(2,542100368,1,1100000.0000,'�����������','�������������, 10','��������� ���� ����������'),(3,821035690,2,900000.0000,'���24','������, 1','��������� ������ ������������'),(4,752100021,2,755000.0000,'�������������','�������, 25','������� ��������� ����������'),(5,548900123,2,500000.0000,'���','�������, 15','������� ������ ��������');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `id_card` int(11) NOT NULL AUTO_INCREMENT,
  `name_on_card` char(50) NOT NULL,
  `month` decimal(2,0) NOT NULL,
  `year` decimal(4,0) NOT NULL,
  `number_card` decimal(16,0) NOT NULL,
  `type_of_card` char(10) NOT NULL,
  `id_client` int(11) NOT NULL,
  `balance` decimal(64,0) NOT NULL DEFAULT '0',
  `id_bank` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_card`),
  UNIQUE KEY `number_car` (`number_card`),
  KEY `id_client` (`id_client`),
  KEY `id_bank` (`id_bank`),
  CONSTRAINT `card_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`),
  CONSTRAINT `cardid_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (2,'SHILOV OLEG',4,2015,6589995215485645,'���������',2,0,3),(3,'BRIKOV RUSLAN',9,2015,6589511123589750,'���������',5,0,1),(4,'OSIPOV ANDREY',10,2015,5486511256998511,'���������',8,0,1),(5,'KISELEV PETR',12,2015,6898855451129590,'���������',9,0,1),(6,'OSTAHOV ANTON',2,2016,5556988511265896,'���������',10,0,1),(7,'BASKOV NIKOLAY',5,2016,6658952100026845,'���������',11,0,1),(8,'KLIMOV IVAN',8,2016,5962002590258021,'���������',14,0,1),(9,'PETROVA ANNA',4,2017,6580208956010256,'���������',15,0,1),(10,'NIKONOVA VICTORIA',8,2017,6885100895540158,'���������',16,0,1),(11,'MIHAILOV DENIS',11,2017,5589551220059845,'���������',17,0,1),(12,'SUTULOV ARTEM',1,2018,5100002354862482,'���������',18,0,1),(13,'KIRILLOVA LILIYA',9,2018,5551244800804510,'���������',19,0,1),(14,'NIKITIN VLADISLAV',10,2018,6985001410009580,'���������',20,0,1),(15,'GOR RENATA',2,2018,5488410004486451,'���������',21,0,1),(16,'ROMANOV IVAN',8,2015,6589000000451189,'���������',22,0,1),(17,'MILLER ANASTASIYA',1,2015,5582111025895001,'���������',23,0,1),(18,'MENSHIKOVA DARYA',6,2016,6000158999845144,'���������',24,0,1),(19,'BORISENKOV EGOR',8,2017,5569850001458951,'���������',25,0,1),(20,'KRAVTSOV ALEKSEY',2,2016,5892146580014590,'���������',26,0,1),(21,'ANTON TSOKUROV',2,2020,7320656900326028,'���������',2,10,1),(22,'ANTON TSOKUROV',2,2020,2975560274472195,'���������',2,10,1),(23,'ANTON TSOKUROV',2,2020,6009117446519526,'���������',2,50000,1),(24,'SHILOV OLEG',2,2020,1039300738513397,'���������',2,50000,2);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cctv`
--

DROP TABLE IF EXISTS `cctv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cctv` (
  `id_cctv` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `id_atm` int(11) NOT NULL,
  PRIMARY KEY (`id_cctv`),
  KEY `id_atm` (`id_atm`),
  CONSTRAINT `cctvid_atm` FOREIGN KEY (`id_atm`) REFERENCES `atm` (`id_atm`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cctv`
--

LOCK TABLES `cctv` WRITE;
/*!40000 ALTER TABLE `cctv` DISABLE KEYS */;
INSERT INTO `cctv` VALUES (1,'2015-01-12 00:25:45',1),(2,'2015-01-25 02:12:14',2),(3,'2015-02-01 08:25:36',3),(4,'2015-02-09 11:47:58',4),(5,'2015-02-18 06:59:59',5),(6,'2015-02-28 09:11:12',6),(7,'2015-03-05 08:07:09',7),(8,'2015-03-15 00:25:34',8),(9,'2015-03-21 09:48:12',9),(10,'2015-03-30 01:55:12',10);
/*!40000 ALTER TABLE `cctv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `surname` char(25) NOT NULL,
  `name` char(25) NOT NULL,
  `patronymic` char(25) NOT NULL,
  `pasport_seria` decimal(4,0) NOT NULL,
  `pasport_number` decimal(6,0) NOT NULL,
  `email` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `pasport_nu` (`pasport_number`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'������','������','����������',8110,336582,'heml@heml.com',''),(2,'�����','����','����������',8105,256895,'hila@hila.com','$2a$10$1IthtTjKyKZ26mEXVg.xFOBrd5qcmMuLAj1if1bdIthE2tROv/Xzu'),(3,'������','���������','����������',8012,256586,'',''),(4,'������','����','��������������',8112,256842,'',''),(5,'������','������','��������',8110,336599,'',''),(6,'��������','������','���������',8108,335641,'',''),(7,'������','������','��������',8111,325487,'',''),(8,'������','������','�������',8110,254102,'',''),(9,'�������','����','����������',8113,665841,'',''),(10,'�������','�����','���������',8110,584123,'',''),(11,'������','�������','����������',8107,669988,'',''),(12,'�������','�����','���������',8110,125689,'',''),(13,'������','���������','����������',8106,567451,'',''),(14,'������','����','����������',8111,500146,'',''),(15,'�������','����','���������',8110,895402,'',''),(16,'��������','��������','�������',8113,985102,'',''),(17,'��������','�����','��������',8109,336586,'',''),(18,'�������','�����','��������',8110,234585,'',''),(19,'���������','�����','�������������',8111,962301,'',''),(20,'�������','���������','���������',8110,568401,'',''),(21,'���','������','���������',8114,954582,'',''),(22,'�������','����','�������',8110,568952,'',''),(23,'������','���������','������������',8105,200156,'',''),(24,'����������','�����','�������������',8110,856002,'',''),(25,'����������','����','����������',8108,560003,'',''),(26,'�������','�������','��������',8108,569851,'',''),(27,'�������','����','��������',8106,995401,'',''),(28,'��������','������','������������',8112,569801,'',''),(29,'�������','���������','������������',8113,569850,'',''),(30,'�������','������','��������',8110,650001,'',''),(31,'asdf','asdf','asdf',1234,123456,'',''),(32,'asdf','sdf','fd',1235,129485,'fif@fif.lo',''),(33,'asdf','dfg','dfg',1235,194721,'fu@fu.lo','asdf'),(34,'sd','dsfg','dfg',1985,572852,'re@re.lo','$2a$10$O70WmcN6iqDh89d.fdwn4.do3UQBdaJpJVxLplx.lpCZ66SUhL/c2');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filling`
--

DROP TABLE IF EXISTS `filling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filling` (
  `id_filling` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_filling` date NOT NULL,
  `sum` decimal(19,4) NOT NULL,
  `id_atm` int(11) NOT NULL,
  PRIMARY KEY (`id_filling`),
  KEY `id_atm` (`id_atm`),
  CONSTRAINT `fillingid_atm` FOREIGN KEY (`id_atm`) REFERENCES `atm` (`id_atm`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filling`
--

LOCK TABLES `filling` WRITE;
/*!40000 ALTER TABLE `filling` DISABLE KEYS */;
/*!40000 ALTER TABLE `filling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `address` char(25) NOT NULL,
  `amount_atm` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'������, 18',2),(2,'�������, 8',1),(3,'�������, 24',3),(4,'�������, 7',2),(5,'������, 1',1),(6,'���������, 52',4),(7,'�����������, 10',2),(8,'����������, 19',1),(9,'���������������, 11',3),(10,'������, 152',1);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_ctaff`
--

DROP TABLE IF EXISTS `service_ctaff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_ctaff` (
  `id_service_staff` int(11) NOT NULL AUTO_INCREMENT,
  `surname` char(25) NOT NULL,
  `name` char(25) NOT NULL,
  `patronymic` char(25) NOT NULL,
  `post` char(25) NOT NULL,
  `id_staff` int(11) NOT NULL,
  PRIMARY KEY (`id_service_staff`),
  KEY `id_staff` (`id_staff`),
  CONSTRAINT `service_ctaffid_staff` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_ctaff`
--

LOCK TABLES `service_ctaff` WRITE;
/*!40000 ALTER TABLE `service_ctaff` DISABLE KEYS */;
INSERT INTO `service_ctaff` VALUES (1,'������','�����','��������','����������',12),(2,'�������','����','��������','����������',3),(3,'����������','��������','���������','����������',1),(4,'�����','������','��������','����������',15),(5,'����������','��������','������������','��������',5),(6,'������','��������','��������','����������',4),(7,'����������','�����','��������','�����������',6),(8,'���������','��������','�����������','��������',25),(9,'��������','��������','�������������','�����������',2),(10,'������','���������','�����������','�����������',4),(11,'��������','������','�����������','����������',5),(12,'�������','�������','����������','����������',23),(13,'�������','�����','�������������','��������',9),(14,'��������','�������','��������','�����������',4),(15,'���������','�����','������������','����������',15);
/*!40000 ALTER TABLE `service_ctaff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL AUTO_INCREMENT,
  `surname` char(25) NOT NULL,
  `name` char(25) NOT NULL,
  `patronymic` char(25) NOT NULL,
  `post` char(25) NOT NULL,
  `id_bank` int(11) NOT NULL,
  PRIMARY KEY (`id_staff`),
  KEY `id_bank` (`id_bank`),
  CONSTRAINT `staffid_bank` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id_bank`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'������','�����','��������','����������',1),(2,'�������','���','�����������','������',3),(3,'�������','�����','���������','���������',5),(4,'�������','�������','����������','������������',2),(5,'��������','�����','�����������','����������� ������������',2),(6,'��������','�������','�����������','�����',4),(7,'�������','����','��������','����������',1),(8,'��������','������','����������','������',1),(9,'����������','��������','���������','����������',1),(10,'���������','��������','���������','���������',1),(11,'���������','�������','����������','�������������',2),(12,'�����','������','��������','����������',3),(13,'���������','������','�������������','�����',5),(14,'�����������','�����','��������','���������',4),(15,'����������','��������','������������','��������',5),(16,'������','��������','��������','����������',1),(17,'����������','�����','��������','�����������',2),(18,'����������','����','���������','���������',5),(19,'���������','�����','�������','������',4),(20,'���������','��������','�����������','��������',2),(21,'��������','��������','�������������','�����������',3),(22,'������','���������','�����������','�����������',2),(23,'��������','������','�����������','����������',1),(24,'�������','�������','����������','����������',2),(25,'�������','����','���������','�����������',1),(26,'���������','�������','����������','����������',3),(27,'�������','�����','�������������','��������',1),(28,'����������','������','�����������','������',2),(29,'��������','�������','��������','�����������',1),(30,'���������','�����','������������','����������',1);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL AUTO_INCREMENT,
  `date_and_time` datetime NOT NULL,
  `sum` decimal(19,4) NOT NULL,
  `type_transaction` char(10) NOT NULL,
  `id_card` int(11) NOT NULL,
  `id_atm` int(11) NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `id_atm` (`id_atm`),
  KEY `id_card` (`id_card`),
  KEY `sum` (`sum`),
  CONSTRAINT `transactionid_card` FOREIGN KEY (`id_card`) REFERENCES `card` (`id_card`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transactionid_atm` FOREIGN KEY (`id_atm`) REFERENCES `atm` (`id_atm`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-20  1:17:19
