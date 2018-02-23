-- MySQL dump 10.15  Distrib 10.0.33-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: lilian_schweta_new
-- ------------------------------------------------------
-- Server version	10.0.33-MariaDB

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
-- Table structure for table `accounts_payable`
--

DROP TABLE IF EXISTS `accounts_payable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_payable` (
  `ap_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_ref_no` varchar(50) NOT NULL,
  `supplier_code` varchar(50) NOT NULL,
  `doc_date` date NOT NULL,
  `currency_type` varchar(50) NOT NULL,
  `total_amt` decimal(12,2) NOT NULL,
  `sign` varchar(1) DEFAULT NULL,
  `tran_type` varchar(50) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `offset` varchar(1) DEFAULT 'n',
  `settled` varchar(1) DEFAULT 'n',
  `purchase_id` int(11) NOT NULL,
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_payable`
--

LOCK TABLES `accounts_payable` WRITE;
/*!40000 ALTER TABLE `accounts_payable` DISABLE KEYS */;
INSERT INTO `accounts_payable` VALUES (1,'CN100','supplier2','2017-09-08','HKD',0.00,'+','Open','','o','y',0),(2,'CN9000','supplier2','2017-08-09','HKD',0.00,'+','Open','','o','y',0),(3,'CN300','supplier2','2017-05-06','HKD',0.00,'+','Open','','o','y',0),(4,'Inv555','supplier2','2017-05-04','HKD',0.00,'-','Open','','o','y',0),(5,'Inv8888.89','supplier2','2017-01-02','HKD',8888.89,'-','Open','','n','n',0),(6,'Inv6000.06','supplier2','2017-04-02','HKD',0.00,'-','Open','','o','y',0),(7,'Paymen.66854','supplier2','2017-12-18','HKD',300.00,'+','PAY','','o','y',1),(8,'Paymen.66855','supplier2','2017-12-18','HKD',2844.94,'+','PAY','','o','y',2),(9,'666','supplier2','2017-03-06','HKD',4455.00,'-','Open','444','n','n',0),(10,'2222','supplier2','2017-01-02','HKD',8000.00,'-','Open','000','n','n',0),(11,'555','supplier2','2017-08-05','HKD',80000.00,'+','Open','444','n','n',0);
/*!40000 ALTER TABLE `accounts_payable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts_receivable`
--

DROP TABLE IF EXISTS `accounts_receivable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts_receivable` (
  `ar_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_ref_no` varchar(50) NOT NULL,
  `customer_code` varchar(50) NOT NULL,
  `doc_date` date NOT NULL,
  `currency_type` varchar(11) NOT NULL,
  `total_amt` decimal(12,2) NOT NULL,
  `sign` varchar(5) NOT NULL,
  `tran_type` varchar(15) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `offset` varchar(1) NOT NULL DEFAULT 'n',
  `settled` varchar(1) NOT NULL DEFAULT 'n',
  `invoice_id` int(11) NOT NULL,
  PRIMARY KEY (`ar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts_receivable`
--

LOCK TABLES `accounts_receivable` WRITE;
/*!40000 ALTER TABLE `accounts_receivable` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts_receivable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ap_open`
--

DROP TABLE IF EXISTS `ap_open`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ap_open` (
  `ap_open_id` int(11) NOT NULL AUTO_INCREMENT,
  `ap_open_tran_date` date DEFAULT NULL,
  `ap_open_doc_ref` varchar(255) DEFAULT NULL,
  `ap_open_remarks` varchar(255) DEFAULT NULL,
  `ap_open_amount` decimal(12,2) DEFAULT NULL,
  `ap_open_sign` varchar(1) DEFAULT NULL,
  `ap_open_status` varchar(1) DEFAULT 'C',
  `ap_customer_id` int(11) NOT NULL,
  PRIMARY KEY (`ap_open_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ap_open`
--

LOCK TABLES `ap_open` WRITE;
/*!40000 ALTER TABLE `ap_open` DISABLE KEYS */;
INSERT INTO `ap_open` VALUES (1,'2017-01-02','Inv8888.89','',8888.89,'-','P',5),(2,'2017-04-02','Inv6000.06','',6000.06,'-','P',5),(3,'2017-05-04','Inv555','',555.00,'-','P',5),(4,'2017-08-09','CN9000','',9000.00,'+','P',5),(5,'2017-05-06','CN300','',300.00,'+','P',5),(6,'2017-09-08','CN100','',100.00,'+','P',5),(7,'2017-01-02','2222','000',8000.00,'-','P',5),(8,'2017-03-06','666','444',4455.00,'-','P',5),(9,'2017-08-05','555','444',80000.00,'+','P',5);
/*!40000 ALTER TABLE `ap_open` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_date` date DEFAULT NULL,
  `bank_reference` varchar(255) DEFAULT NULL,
  `bank_remarks` varchar(255) DEFAULT NULL,
  `bank_debit` decimal(12,2) DEFAULT NULL,
  `bank_credit` decimal(12,2) DEFAULT NULL,
  `bank_balance` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` VALUES (1,'2017-12-13','REC.66578','',14974.65,NULL,14974.65),(2,'2017-12-13','REC.66576','',4815.00,NULL,19789.65),(3,'2017-12-13','REC.66577','',988.00,NULL,20777.65),(4,'2017-12-13','Paymen.66828','',NULL,3699.50,17078.15),(5,'2017-12-13','Paymen.66829','',NULL,913.50,16164.65),(6,'2016-12-31','1231','open1231',3000.00,NULL,19164.65),(7,'2017-08-06','0806','open0806',6000.00,NULL,25164.65),(8,'2017-04-03','0403','open0403',3500.00,NULL,28664.65),(9,'2017-05-06','0506','open0506',NULL,5000.00,23664.65),(10,'2017-12-14','REC.66580','',111.00,NULL,23775.65),(11,'2017-12-14','REC.66581','',200.00,NULL,23975.65),(12,'2017-12-14','Paymen.66830','',NULL,90.00,23885.65),(13,'2017-05-03','tewert','e4e4ert',NULL,300.00,23585.65),(14,'2017-05-02','rttrtyrt','erertert',600.00,NULL,24185.65),(15,'2017-05-03','eeeee','tttttttttttttttt',6000.00,NULL,30185.65),(16,'2017-04-05','eeewwwwwwwwww','hhfgh',NULL,3000.00,27185.65),(17,'2017-12-14','REC.66582','',1000.00,NULL,28185.65),(18,'2017-12-14','REC.66583','',2000.00,NULL,30185.65),(19,'2017-12-14','REC.66584','',1200.00,NULL,31385.65),(20,'2017-12-14','REC.66585','',3000.00,NULL,34385.65),(21,'2017-12-14','REC.66586','',5988.00,NULL,40373.65),(22,'2017-12-14','REC.66587','',500.00,NULL,40873.65),(23,'2017-12-14','REC.66588','',500.00,NULL,41373.65),(24,'2017-12-14','REC.66594','',10000.00,NULL,51373.65),(25,'2017-12-14','REC.66593','',2000.00,NULL,53373.65),(26,'2017-12-14','REC.66595','',2000.00,NULL,55373.65),(27,'2017-12-15','Paymen.66831','',NULL,2098.04,53275.61),(28,'2017-12-15','Paymen.66832','',NULL,744.00,52531.61),(29,'2017-12-15','REC.66596','',3100.00,NULL,55631.61),(30,'2017-12-15','Paymen.66834','',NULL,662.00,54969.61),(31,'2017-12-15','Paymen.66833','',NULL,1100.00,53869.61),(32,'2017-12-15','Paymen.66835','',NULL,2000.00,51869.61),(33,'2017-12-15','REC.66598','',1000.00,NULL,52869.61),(34,'2017-12-15','REC.66602','',1000.00,NULL,53869.61),(35,'2017-12-15','REC.66603','',300.00,NULL,54169.61),(36,'2017-12-15','REC.66605','',6000.00,NULL,60169.61),(37,'2017-12-15','REC.66606','',889.89,NULL,61059.50),(38,'2017-12-15','REC.66607','',889.89,NULL,61949.39),(39,'2017-12-15','REC.66608','',6000.00,NULL,67949.39),(40,'2017-12-15','REC.66609','',889.89,NULL,68839.28),(41,'2017-12-15','REC.66610','',6000.00,NULL,74839.28),(42,'2017-12-15','REC.66611','',6000.00,NULL,80839.28),(43,'2017-12-15','REC.66612','',889.89,NULL,81729.17),(44,'2017-12-15','REC.66613','',6000.00,NULL,87729.17),(45,'2017-12-15','REC.66614','',1000.00,NULL,88729.17),(46,'2017-12-15','REC.66615','',889.89,NULL,89619.06),(47,'2017-12-15','REC.66616','',889.89,NULL,90508.95),(48,'2017-12-15','REC.66617','',6000.00,NULL,96508.95),(49,'2017-12-15','REC.66618','',2000.00,NULL,98508.95),(50,'2017-12-15','REC.66619','',889.89,NULL,99398.84),(51,'2017-12-15','REC.66620','',6000.00,NULL,105398.84),(52,'2017-12-15','REC.66621','',2000.00,NULL,107398.84),(53,'2017-12-15','REC.66623','',1000.00,NULL,108398.84),(54,'2017-12-15','REC.66622','',2000.00,NULL,110398.84),(55,'2017-12-15','REC.66624','',1000.00,NULL,111398.84),(56,'2017-12-15','REC.66626','',1000.00,NULL,112398.84),(57,'2017-12-15','REC.66628','',1000.00,NULL,113398.84),(58,'2017-12-15','REC.66629','',200.00,NULL,113598.84),(59,'2017-12-15','Paymen.66838','',NULL,889.89,112708.95),(60,'2017-12-15','Paymen.66839','',NULL,6000.00,106708.95),(61,'2017-12-15','Paymen.66840','',NULL,2000.00,104708.95),(62,'2017-12-15','REC.66630','',1500.00,NULL,106208.95),(63,'2017-12-15','REC.66631','',1500.00,NULL,107708.95),(64,'2017-12-15','Paymen.66841','',NULL,1000.00,106708.95),(65,'2017-12-15','Paymen.66842','',NULL,500.00,106208.95),(66,'2017-12-15','Paymen.66843','',NULL,889.89,105319.06),(67,'2017-12-15','Paymen.66844','',NULL,6000.00,99319.06),(68,'2017-12-15','Paymen.66845','',NULL,2000.00,97319.06),(69,'2017-12-15','Paymen.66847','',NULL,350.00,96969.06),(70,'2017-12-15','Paymen.66846','',NULL,180.00,96789.06),(71,'2017-12-16','REC.66632','',888.09,NULL,97677.15),(72,'2017-12-16','REC.66633','',6000.00,NULL,103677.15),(73,'2017-12-16','REC.66634','',2000.00,NULL,105677.15),(74,'2017-12-16','REC.66635','',888.09,NULL,106565.24),(75,'2017-12-16','REC.66636','',6000.00,NULL,112565.24),(76,'2017-12-16','REC.66637','',2000.00,NULL,114565.24),(77,'2017-12-16','REC.66638','',888.09,NULL,115453.33),(78,'2017-12-16','REC.66639','',6000.00,NULL,121453.33),(79,'2017-12-16','REC.66640','',2000.00,NULL,123453.33),(80,'2017-12-16','REC.66641','',667.67,NULL,124121.00),(81,'2017-12-16','REC.66642','',4166.66,NULL,128287.66),(82,'2017-12-16','REC.66643','',2500.00,NULL,130787.66),(83,'2017-12-16','REC.66644','',2500.00,NULL,133287.66),(84,'2017-12-16','REC.66645','',1500.00,NULL,134787.66),(85,'2017-12-15','Paymen.66848','ertert',NULL,120.00,134667.66),(86,'2017-12-16','Paymen.66849','',NULL,220.00,134447.66),(87,'2017-12-16','Paymen.66849','',NULL,220.00,134227.66),(88,'2017-12-16','REC.66647','',1020.00,NULL,135247.66),(89,'2017-12-16','REC.66646','',1000.00,NULL,136247.66),(90,'2017-12-16','Paymen.66851','',NULL,280.00,135967.66),(91,'2017-12-16','Paymen.66851','',NULL,280.00,135687.66),(92,'2017-12-16','Paymen.66851','',NULL,280.00,135407.66),(93,'2017-12-16','Paymen.66851','',NULL,280.00,135127.66),(94,'2017-12-16','Paymen.66851','',NULL,280.00,134847.66),(95,'2017-12-16','REC.66648','',888.09,NULL,135735.75),(96,'2017-12-16','REC.66649','',888.09,NULL,136623.84),(97,'2017-12-16','REC.66650','',6000.00,NULL,142623.84),(98,'2017-12-16','REC.66651','',2000.00,NULL,144623.84),(99,'2017-12-16','Paymen.66850','',NULL,7300.00,137323.84),(100,'2017-12-16','Paymen.66853','',NULL,50.00,137273.84),(101,'2017-12-16','Paymen.66852','',NULL,30.00,137243.84),(102,'2017-12-16','REC.66652','',1000.00,NULL,138243.84),(103,'2017-12-17','REC.66653','',2800.00,NULL,141043.84),(104,'2017-12-17','REC.66654','',7898.00,NULL,148941.84),(105,'2017-12-17','REC.66655','',-2000.00,NULL,146941.84),(106,'2017-12-17','REC.66656','',400.00,NULL,147341.84),(107,'2017-12-17','REC.66657','',88.55,NULL,147430.39),(108,'2017-12-17','REC.66658','',0.00,NULL,147430.39),(109,'2017-12-17','REC.66664','',1111.67,NULL,148542.06),(110,'2017-12-17','REC.66665','',0.00,NULL,148542.06),(111,'2017-12-17','REC.66666','',2554.89,NULL,151096.95),(112,'2017-12-17','REC.66668','',7012.00,NULL,158108.95),(113,'2017-12-17','REC.66669','',500.00,NULL,158608.95),(114,'2017-12-17','REC.66670','',3500.00,NULL,162108.95),(115,'2017-12-17','REC.66671','',0.00,NULL,162108.95),(116,'2017-12-17','REC.66672','',3100.00,NULL,165208.95),(117,'2017-12-18','Paymen.66854','',NULL,300.00,164908.95),(118,'2017-12-18','Paymen.66855','',NULL,2844.94,162064.01),(119,'2017-12-20','Paymen.66863',NULL,NULL,5000.00,157064.01),(120,'2017-12-20','Paymen.66863',NULL,NULL,100.00,156964.01),(121,'2017-12-20','Paymen.66863',NULL,NULL,200.00,156764.01),(122,'2017-12-20','Paymen.66863',NULL,NULL,200.00,156564.01),(123,'2017-12-20','Paymen.66863',NULL,NULL,100.00,156464.01),(124,'2017-12-20','Paymen.66863',NULL,NULL,100.00,156364.01),(125,'2017-12-20','Paymen.66863',NULL,NULL,2323.00,154041.01),(126,'2017-12-20','Paymen.66863',NULL,NULL,2323.00,151718.01),(127,'2017-12-20','Paymen.66863',NULL,NULL,2323.00,149395.01),(128,'2017-12-20','Paymen.1',NULL,NULL,300.00,149095.01),(129,'2017-12-20','Paymen.66828',NULL,NULL,300.00,148795.01),(130,'2017-12-20','Paymen.66829',NULL,NULL,100.00,148695.01),(131,'2017-12-20','Paymen.66830',NULL,NULL,200.00,148495.01),(132,'2017-12-20','Paymen.66831',NULL,NULL,500.00,147995.01),(133,'2017-12-20','Paymen.66836',NULL,NULL,7777.00,140218.01),(134,'2017-12-20','Paymen.66834',NULL,NULL,120.00,140098.01);
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_adjustment`
--

DROP TABLE IF EXISTS `bank_adjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_adjustment` (
  `bank_ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_ad_date` date DEFAULT NULL,
  `bank_ad_ref` varchar(255) DEFAULT NULL,
  `bank_ad_remarks` varchar(255) DEFAULT NULL,
  `bank_ad_amt` decimal(12,2) DEFAULT NULL,
  `bank_ad_sign` varchar(1) NOT NULL,
  `bank_ad_status` varchar(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`bank_ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_adjustment`
--

LOCK TABLES `bank_adjustment` WRITE;
/*!40000 ALTER TABLE `bank_adjustment` DISABLE KEYS */;
INSERT INTO `bank_adjustment` VALUES (1,'2016-12-31','1231','open1231',3000.00,'+','P'),(2,'2017-05-06','0506','open0506',5000.00,'-','P'),(3,'2017-08-06','0806','open0806',6000.00,'+','P'),(4,'2017-04-03','0403','open0403',3500.00,'+','P'),(5,'2017-05-02','rttrtyrt','erertert',600.00,'+','P'),(6,'2017-05-03','tewert','e4e4ert',300.00,'-','P'),(7,'2017-05-03','eeeee','tttttttttttttttt',6000.00,'+','P'),(8,'2017-04-05','eeewwwwwwwwww','hhfgh',3000.00,'-','P');
/*!40000 ALTER TABLE `bank_adjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_master`
--

DROP TABLE IF EXISTS `billing_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing_master` (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_code` varchar(100) NOT NULL,
  `billing_description` varchar(509) NOT NULL,
  `billing_uom` varchar(25) DEFAULT NULL,
  `billing_price_per_uom` varchar(50) DEFAULT NULL,
  `gst_id` int(11) DEFAULT NULL,
  `billing_update_stock` varchar(5) DEFAULT NULL,
  `billing_type` varchar(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`billing_id`),
  KEY `gst_id` (`gst_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_master`
--

LOCK TABLES `billing_master` WRITE;
/*!40000 ALTER TABLE `billing_master` DISABLE KEYS */;
INSERT INTO `billing_master` VALUES (1,'FIN SVC','FINANCIAL MANAGEMENT SERVICE','JOB','988',20,'YES','Service',1),(5,'TP IAF','STANDARD TRADPAC FOR WINDOWS 10','PKG','4650',19,'YES','Product',1),(6,'PW PLUS','PAYWIN PLUS FOR WINDOWS 10','PKG','4500',19,'YES','Product',1),(11,'TP PLUS (EXPORT)','STANDARD TRADPAC','PKG','3888',20,'YES','Product',1),(12,'PW PLUS (EXPORT)','PAYWIN PLUS ','PKG','4500',20,'YES','Product',1),(13,'PC','PORT CHARGES','JOB','3000',24,'YES','Service',1),(10,'MC ','MAINTENANCE CONTRACT','SET','1200',19,'YES','Service',1);
/*!40000 ALTER TABLE `billing_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chart_of_account`
--

DROP TABLE IF EXISTS `chart_of_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chart_of_account` (
  `coa_id` int(11) NOT NULL AUTO_INCREMENT,
  `coa_prefix` varchar(2) DEFAULT NULL,
  `coa_suffix` varchar(10) DEFAULT NULL,
  `coa_description` varchar(255) DEFAULT NULL,
  `coa_state` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`coa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chart_of_account`
--

LOCK TABLES `chart_of_account` WRITE;
/*!40000 ALTER TABLE `chart_of_account` DISABLE KEYS */;
INSERT INTO `chart_of_account` VALUES (1,'13','001','Purchases',1),(2,'3','001','Debtor control account',1),(3,'3','002','Year opening stock',1),(4,'3','003','Foreign bank control account',1),(5,'3','100','Petty cash account',1),(6,'3','101','Bank Accounts',1),(7,'3','199','Cash sales float account',1),(8,'3','500','Work In Progress Control Account',1),(9,'4','001','Creditor Control Account',1),(10,'4','002','Provision for bad debts',1),(11,'4','300','Goods and Services tax',1),(12,'15','900','Exchange Difference',1),(13,'6','001','Paid up capital',1),(14,'8','001','Retained profit',1),(15,'12','001','Credit Sales',1),(16,'12','002','Cash Sales',1),(19,'13','555','uuuuuuuu',0),(18,'3','999','test',0);
/*!40000 ALTER TABLE `chart_of_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chart_of_account_prefix`
--

DROP TABLE IF EXISTS `chart_of_account_prefix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chart_of_account_prefix` (
  `coa_pre_id` int(11) NOT NULL AUTO_INCREMENT,
  `coa_pre_character` varchar(255) DEFAULT NULL,
  `coa_pre_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`coa_pre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chart_of_account_prefix`
--

LOCK TABLES `chart_of_account_prefix` WRITE;
/*!40000 ALTER TABLE `chart_of_account_prefix` DISABLE KEYS */;
INSERT INTO `chart_of_account_prefix` VALUES (1,'FA','Fixed Assets'),(2,'IA','Intangible Assets'),(3,'CA','Current Assets'),(4,'CL','Current Liabilities'),(5,'DO','Dividend'),(6,'PC','Share Capital'),(7,'PD','Provision For Depreciation'),(8,'RP','Retained Profits'),(9,'CR','Capital Reserves'),(10,'MT','Medium-Term Liabilities'),(11,'LT','Long-Term Liabilities'),(12,'SO','Sales'),(13,'CO','Cost of Sales'),(14,'IO','Sundry & Misc Income'),(15,'EO','All Expenses'),(16,'TO','All Tax Items'),(17,'XO','Extraordinary Items');
/*!40000 ALTER TABLE `chart_of_account_prefix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profile`
--

DROP TABLE IF EXISTS `company_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `gst_reg_no` varchar(100) NOT NULL,
  `uen_no` varchar(100) NOT NULL,
  `company_address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `company_logo` varchar(100) NOT NULL,
  `default_currency` varchar(100) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_profile`
--

LOCK TABLES `company_profile` WRITE;
/*!40000 ALTER TABLE `company_profile` DISABLE KEYS */;
INSERT INTO `company_profile` VALUES (1,'TOPFORM BUSINESS SYSTEMS PTE LTD','sfffff','UEN78902345','BLK 71, UBI ROAD 1 , #08-35 , SINGAPORE 408732','+65 7777888999','(+65)67024812','logo.png','AFN');
/*!40000 ALTER TABLE `company_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration_master`
--

DROP TABLE IF EXISTS `configuration_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_master`
--

LOCK TABLES `configuration_master` WRITE;
/*!40000 ALTER TABLE `configuration_master` DISABLE KEYS */;
INSERT INTO `configuration_master` VALUES (1,'configuration A'),(2,'configuration B'),(3,'configuration C'),(4,'configuration D'),(5,'configuration E'),(6,'configuration admin');
/*!40000 ALTER TABLE `configuration_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country_master`
--

DROP TABLE IF EXISTS `country_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country_master` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(15) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_master`
--

LOCK TABLES `country_master` WRITE;
/*!40000 ALTER TABLE `country_master` DISABLE KEYS */;
INSERT INTO `country_master` VALUES (1,'101','BELGIUM'),(2,'102','DENMARK'),(3,'103','FRANCE'),(4,'104','GERMANY'),(5,'105','GREECE'),(6,'106','IRELAND'),(7,'301','SINGAPORE'),(8,'107','ITALY'),(9,'108','LUXEMBOURG'),(10,'109','NETHERLAND'),(11,'110','UNITED KIN'),(12,'111','PORTUGAL'),(13,'112','SPAIN'),(14,'131','AUSTRIA'),(15,'132','FINLAND'),(16,'133','ICELAND'),(17,'134','NORWAY'),(18,'135','SVALBARD JAN MAYEN'),(19,'136','SWEDEN'),(20,'137','SWITZERLAND'),(21,'138','LIECHSTENSTEIN'),(22,'139','BOUVET ISLAND'),(23,'141','FAEROE ISLANDS'),(24,'142','GREENLAND'),(25,'143','MONACO'),(26,'144','SAN MARINO'),(27,'145','VATICAN CITY STATE'),(28,'152','TURKEY'),(29,'153','ANDORRA'),(30,'154','GIBRALTAR'),(31,'155','MALTA'),(32,'201','ALBANIA'),(33,'202','BULGARIA'),(34,'203','CZECHOSLOVAKIA'),(35,'205','HUNGARY'),(36,'206','POLAND'),(37,'207','ROMANIA'),(38,'209','YUGOSLAVIA'),(39,'211','BELARUS'),(40,'212','UKRAINE'),(41,'213','ESTONIA'),(42,'214','LATVIA'),(43,'215','LITHUANIA'),(44,'216','GEORGIA'),(45,'217','ARMENIA'),(46,'218','AZERBAIJAN'),(47,'219','KYRGYZSTAN'),(48,'221','KAZAKHSTAN'),(49,'222','MOLDOVA'),(50,'223','RUSSIA'),(51,'224','TAJIKISTAN'),(52,'225','TURKMENISTAN'),(53,'226','UZBEKISTAN'),(54,'232','CROATIA'),(55,'233','SLOVENIA'),(56,'234','CZECH REPUBLIC'),(57,'235','SLOVAK REPUBLIC'),(58,'302','BRUNEI'),(59,'303','INDONESIA'),(60,'304','MALAYSIA'),(61,'305','PHILIPPINES'),(62,'306','THAILAND'),(63,'307','EAST TIMOR'),(64,'311','MYANMAR'),(65,'312','CAMBODIA'),(66,'313','LAOS PEO DEM REP'),(67,'314','VIETNAM SOC REP OF'),(68,'319','O C IN S E ASIA'),(69,'331','JAPAN'),(70,'332','HONG KONG'),(71,'333','REP OF KOREA'),(72,'334','TAIWAN'),(73,'335','MACAU'),(74,'336','CHINA'),(75,'337','KOREA NORTH DEM PEO'),(76,'338','MONGOLIAN PEOPLE REP'),(77,'351','AFGHANISTAN'),(78,'352','BANGLADESH'),(79,'353','BHUTAN'),(80,'354','INDIA'),(81,'355','MALDIVES'),(82,'356','NEPAL'),(83,'357','PAKISTAN'),(84,'358','SRI LANKA'),(85,'371','BAHRAIN'),(86,'372','CYPRUS'),(87,'373','ISLAMIC REP OF IRAN'),(88,'374','IRAQ'),(89,'375','ISRAEL'),(90,'376','JORDAN'),(91,'377','KUWAIT'),(92,'378','LEBANON'),(93,'379','OMAN'),(94,'380','QATAR'),(95,'381','SAUDI ARABIA'),(96,'382','SYRIAN ARAB REP'),(97,'383','UNITED ARAB EMIRATES'),(98,'384','YEMEN'),(99,'385','DEMOCRATIC YEMEN'),(100,'386','PALESTINE'),(101,'401','ALGERIA'),(102,'402','EGYPT'),(103,'403','LIBYA A JAMAHIRIYA'),(104,'404','MOROCCO'),(105,'405','SUDAN'),(106,'406','TUNISIA'),(107,'407','DJIBOUTI'),(108,'408','ETHIOPIA'),(109,'409','DEM REP OF SOMALI'),(110,'410','ERITREA'),(111,'421','GHANA'),(112,'422','COTE DIVOIRE'),(113,'423','KENYA'),(114,'424','LIBERIA'),(115,'425','MADAGASCAR'),(116,'426','MAURITIUS'),(117,'427','MOZAMBIQUE'),(118,'428','NIGERIA'),(119,'429','REUNION ISLAND'),(120,'430','TANZANIA'),(121,'431','UGANDA'),(122,'432','ZAMBIA'),(123,'451','ANGOLA'),(124,'452','BENIN'),(125,'453','BOTSWANA'),(126,'454','BURKINA FASO'),(127,'455','BURUNDI'),(128,'456','CAMEROON UNITED REP'),(129,'457','CAPE VERDE'),(130,'458','CENTRAL AFRICAN REP'),(131,'459','CHAD'),(132,'460','COMOROS ISLAND'),(133,'461','CONGO'),(134,'462','EQUATORIAL GUINEA'),(135,'463','GABON'),(136,'464','GAMBIA'),(137,'465','GUINEA'),(138,'466','GUINES BISSAU'),(139,'467','LESOTHO'),(140,'468','MALAWI'),(141,'469','MALI'),(142,'470','MAURITANIA'),(143,'471','NAMIBIA'),(144,'472','NIGER'),(145,'473','RWANDA'),(146,'474','SAO TOME PRINCIPE'),(147,'475','SENEGAL'),(148,'476','SEYCHELLES'),(149,'477','SIERRA LEONE'),(150,'478','SOUTH AFRICA'),(151,'479','WESTERN SAHARA'),(152,'480','SWAZILAND'),(153,'481','TOGO'),(154,'482','REP OF ZAIRE'),(155,'483','ZIMBABWE'),(156,'484','ST HELENA'),(157,'499','O C IN OTHER AFRICA'),(158,'501','CANADA'),(159,'502','PUERTO RICO'),(160,'503','UNITED STATES'),(161,'504','U S MINOR ISLANDS'),(162,'505','ST PIERRE MIQUELON'),(163,'509','OC NORTH AMERICA'),(164,'601','ARGENTINA'),(165,'602','BRAZIL'),(166,'603','CHILE'),(167,'605','ECUADOR'),(168,'606','MEXICO'),(169,'607','PARAGUAY'),(170,'608','PERU'),(171,'609','URUGUAY'),(172,'610','VENEZUELA'),(173,'621','CUBA'),(174,'622','DOMINICAN REPUBLIC'),(175,'623','NETHERLANDS ANTILLES'),(176,'624','PANAMA'),(177,'625','ARUBA'),(178,'641','ANTIGUA AND BARBUDA'),(179,'642','BAHAMAS ISLAND'),(180,'643','BARBADOS'),(181,'644','BELIZE'),(182,'645','BERMUDA'),(183,'646','BOLIVIA'),(184,'647','CAYMAN ISLANDS'),(185,'648','COSTA RICA'),(186,'649','DOMINICA'),(187,'650','EL SALVADOR'),(188,'651','FALKLAND IS'),(189,'652','FRENCH GUIANA'),(190,'653','GRENADA'),(191,'654','GUADELOUPE'),(192,'655','GUATEMALA'),(193,'656','GUYANA'),(194,'657','HAITI'),(195,'658','HONDURAS'),(196,'659','JAMAICA'),(197,'660','NICARAGUA'),(198,'661','MARTINIQUE'),(199,'662','MONTSERRAT'),(200,'663','SAINT KITTS NEVIS'),(201,'664','SAINT LUCIA'),(202,'665','SAINT VINCENT'),(203,'666','SURINAM'),(204,'667','TRINIDAD AND TOBAGO'),(205,'668','TURKS AND CAICOS IS'),(206,'669','VIRGIN ISLANDS US'),(207,'670','ANGUILLA'),(208,'671','BRITISH VIRGIN ISLND'),(209,'672','ISLE OF MAN'),(210,'699','OC CTRL STH AMERICA'),(211,'701','AUSTRALIA'),(212,'702','FIJI'),(213,'703','NAURU'),(214,'704','NEW CALEDONIA'),(215,'706','PAPUA NEW GUINEA'),(216,'707','SAMOA'),(217,'708','BRITISH INDIAN OCEAN'),(218,'709','CHRISTMAS ISLANDS'),(219,'710','COCOS KEELING ISLAND'),(220,'711','FRENCH SOUTHERN TERR'),(221,'712','HEARD MCDONALD ISLND'),(222,'713','NORFOLK ISLAND'),(223,'721','AMERICAN SAMOA'),(224,'722','COOK ISLAND'),(225,'723','FRENCH POLYNESIA'),(226,'724','GUAM'),(227,'725','KIRIBATI'),(228,'726','NIUE'),(229,'727','PITCAIRN'),(230,'728','SOLOMON ISLANDS'),(231,'729','TOKELAU'),(232,'730','TONGA'),(233,'731','TUVALU'),(234,'732','NEW HERBRIDES'),(235,'733','WALLIS AND FUTUNA'),(236,'734','NORTHERN MARIANA ISLANDS'),(237,'735','MARSHALL ISLANDS'),(238,'736','MICRONESIA'),(239,'737','PALAU'),(240,'799','OC OCEANIA'),(241,'999','OTHERS');
/*!40000 ALTER TABLE `country_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `iso` char(3) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iso`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES ('AFN','Afghanistan Afghani'),('ALL','Albanian Lek'),('DZD','Algerian Dinar'),('ADP','Andorran Peseta'),('AOK','Angolan Kwanza'),('ARS','Argentine Peso'),('AMD','Armenian Dram'),('AWG','Aruban Florin'),('AUD','Australian Dollar'),('BSD','Bahamian Dollar'),('BHD','Bahraini Dinar'),('BDT','Bangladeshi Taka'),('BBD','Barbados Dollar');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency_master`
--

DROP TABLE IF EXISTS `currency_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency_master` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(50) NOT NULL,
  `currency_rate` double NOT NULL,
  `currency_description` text NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency_master`
--

LOCK TABLES `currency_master` WRITE;
/*!40000 ALTER TABLE `currency_master` DISABLE KEYS */;
INSERT INTO `currency_master` VALUES (1,'SGD',1,'Singapore Dollar'),(2,'INR',47.14,'Indian Rupee'),(3,'AUD',0.929,' Australian Dollar'),(4,'HKD',5.73,' Hong Kong Dollar'),(6,'USD',0.735,'US Dollar '),(7,'MYR',3.11,'Malaysian Ringgit ');
/*!40000 ALTER TABLE `currency_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_master`
--

DROP TABLE IF EXISTS `customer_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_master` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_bldg_number` varchar(255) DEFAULT NULL,
  `customer_street_name` varchar(255) DEFAULT NULL,
  `customer_postal_code` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_fax` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_contact_person` varchar(255) DEFAULT NULL,
  `customer_credit_limit` decimal(10,2) DEFAULT NULL,
  `customer_credit_term_days` int(11) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `customer_uen_no` varchar(255) DEFAULT NULL,
  `customer_gst_number` varchar(100) DEFAULT NULL,
  `customer_rating` decimal(2,1) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `flag` varchar(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`customer_id`),
  KEY `country_id` (`country_id`),
  KEY `currency_id` (`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_master`
--

LOCK TABLES `customer_master` WRITE;
/*!40000 ALTER TABLE `customer_master` DISABLE KEYS */;
INSERT INTO `customer_master` VALUES (1,'C0002','CHEMICAL MANUFACTURING PTE LTD','68','KAKI BUKIT AVE 6 #03-02 ARK@KB','417896','9264 2275','9800 4493','PAGGY@YAHOO.COM','KELVIN TAN',3000.00,30,1,'53191214K','53191214K',NULL,7,NULL,'C'),(2,'F0002','FENG HUA INDUSTRIES ENGINEERING','BLK 22','WOODLANDS LINK #03-45 WOODLANDS EAST IND ESTATE','738734','6758 6078','6753 0937','FENGHUA@GMAIL.COM','SUSAN LIM',5000.00,60,1,'199078798K','199078798K',NULL,7,NULL,'C'),(3,'G0003','GSPL SDN BHD','338','JALAN KUCHING','84800','03 900 3002','','MARCUS@GSPL.COM.SG','MARCUS LIM',5000.00,30,7,'13738990','13738990',NULL,60,NULL,'C'),(4,'test_supplier','test supplier','','','','','','','contact',0.00,0,6,'','',0.0,160,NULL,'S'),(5,'supplier2','supplier2Name','','','','','','','contact',0.00,0,4,'','',0.0,70,NULL,'S');
/*!40000 ALTER TABLE `customer_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gl_table`
--

DROP TABLE IF EXISTS `gl_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gl_table` (
  `gl_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_date` date NOT NULL,
  `doc_ref_no` varchar(50) NOT NULL,
  `customer_code` varchar(50) NOT NULL,
  `gst` decimal(8,2) NOT NULL,
  `currency_amount` decimal(8,2) NOT NULL,
  `lump_sum_discount_price` decimal(8,2) NOT NULL,
  `total_amt` decimal(8,2) NOT NULL,
  `tran_type` varchar(7) NOT NULL,
  PRIMARY KEY (`gl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gl_table`
--

LOCK TABLES `gl_table` WRITE;
/*!40000 ALTER TABLE `gl_table` DISABLE KEYS */;
INSERT INTO `gl_table` VALUES (1,'2017-10-22','INV.999057','BAS-SC289',7.00,1.00,389.70,416.98,'INV'),(2,'2017-10-21','INV.999056','BAS-MC003',7.00,1.00,315.00,337.05,'INV'),(3,'2017-10-22','INV.999058','BAS-SC168',7.00,1.00,380.00,406.60,'INV'),(4,'2017-10-22','INV.999059','BAS-SC168',7.00,1.00,900.00,963.00,'INV'),(5,'2017-10-22','INV.999060','BAS-SC289',7.00,1.00,2304.00,2465.28,'INV'),(6,'2017-10-23','INV.999064','BAS-SC168',7.00,1.00,2400.00,2568.00,'INV'),(7,'2017-10-26','INV.999068','testcuscode',7.00,0.74,447.00,478.29,'INV'),(8,'2017-10-26','INV.999069','testcuscode',7.00,0.74,1249.50,1336.96,'INV'),(9,'2017-10-26','INV.999070','testcuscode',7.00,0.74,1647.87,1762.65,'INV'),(10,'2017-10-26','INV.999071','testcuscode',7.00,0.74,1647.87,1762.65,'INV'),(11,'2017-10-26','INV.999072','testcuscode',7.00,0.74,1764.00,1887.48,'INV'),(12,'2017-10-27','INV.999074','testcuscode',7.00,0.74,8362.68,8948.07,'INV'),(13,'2017-10-27','INV.999074','testcuscode',7.00,0.74,8362.68,8948.07,'INV'),(14,'2017-10-26','INV.999072','testcuscode',7.00,0.74,1764.00,1887.48,'INV'),(15,'2017-10-28','INV.999077','SGDtestcusto',7.00,1.00,500.00,535.00,'INV'),(16,'2017-10-28','INV.999075','testcuscode',7.00,0.74,367.50,393.23,'INV'),(17,'2017-10-30','INV.999078','SGDtestcusto',7.00,1.00,300.00,321.00,'INV'),(18,'2017-11-01','INV.999087','BAS-SC168',7.00,1.00,2400.00,2568.00,'INV'),(19,'2017-11-01','INV.999089','SGDtestcusto',7.00,1.00,123.00,131.61,'INV'),(20,'2017-11-15','INV.999099','G0003',7.00,3.11,18480.00,19120.50,'INV'),(21,'2017-11-15','INV.999098','F0002',7.00,1.00,10138.00,10778.50,'INV'),(22,'2017-11-15','INV.999097','S0004',7.00,0.74,12081.18,12721.68,'INV'),(23,'2017-11-15','INV.999100','C0002',7.00,1.00,1200.00,1284.00,'INV'),(24,'2017-11-15','INV.999094','S0004',7.00,0.74,12081.18,12721.68,'INV'),(25,'2017-11-15','INV.999095','C0002',7.00,1.00,12150.00,12790.50,'INV'),(26,'2017-11-15','INV.999101','C0002',7.00,1.00,3000.00,3000.00,'INV'),(27,'2017-11-15','INV.999102','C0002',7.00,1.00,3000.00,3000.00,'INV'),(28,'2017-11-15','INV.999103','C0002',7.00,1.00,4500.00,4500.00,'INV'),(29,'2017-11-15','INV.999104','C0002',7.00,1.00,3000.00,3000.00,'INV'),(30,'2017-11-16','INV.999105','C0002',7.00,1.00,1200.00,1284.00,'INV'),(31,'2017-11-16','INV.999106','C0002',7.00,1.00,988.00,988.00,'INV'),(32,'2017-11-16','INV.999107','C0002',7.00,1.00,4500.00,4815.00,'INV'),(33,'2017-11-16','INV.999108','G0003',7.00,3.11,3732.00,3993.24,'INV'),(34,'2017-11-16','INV.999109','C0002',7.00,1.00,0.00,0.00,'INV'),(35,'2017-11-16','INV.999110','C0002',7.00,1.00,988.00,988.00,'INV'),(36,'2017-11-18','INV.999112','G0003',7.00,3.11,999999.99,999999.99,'INV'),(37,'2017-11-16','INV.999111','C0002',7.00,1.00,988.00,988.00,'INV'),(38,'2017-11-20','INV.999113','F0002',7.00,1.00,3000.00,3000.00,'INV'),(39,'2017-11-20','INV.999117','F0002',7.00,1.00,38880.00,38880.00,'INV'),(40,'2017-11-20','INV.999118','G0003',7.00,3.11,462768.00,495161.76,'INV'),(41,'2017-11-21','INV.999129','F0002',7.00,1.00,47700.00,51039.00,'INV'),(42,'2017-11-24','INV.999133','F0002',7.00,1.00,1200.00,1284.00,'INV'),(43,'2017-11-23','INV.999131','F0002',7.00,1.00,17238.00,17647.50,'INV'),(44,'2017-11-24','INV.999132','F0002',7.00,1.00,3000.00,3000.00,'INV'),(45,'2017-11-28','INV.999136','C0002',7.00,1.00,1200.00,1284.00,'INV'),(46,'2017-11-28','INV.999137','C0002',7.00,1.00,988.00,988.00,'INV'),(47,'2017-11-29','INV.999138','C0002',7.00,1.00,3000.00,3000.00,'INV'),(48,'2017-11-29','INV.999139','F0002',7.00,1.00,1200.00,1284.00,'INV'),(49,'2017-11-29','INV.999140','C0002',7.00,1.00,1200.00,1284.00,'INV'),(50,'2017-11-29','INV.999141','C0002',7.00,1.00,3000.00,3000.00,'INV'),(51,'2017-11-29','INV.999142','F0002',7.00,1.00,3000.00,3000.00,'INV'),(52,'2017-11-29','INV.999143','F0002',7.00,1.00,3000.00,3000.00,'INV'),(53,'2017-11-29','INV.999144','C0002',7.00,1.00,1200.00,1284.00,'INV'),(54,'2017-12-02','INV.999146','C0002',7.00,1.00,4500.00,4815.00,'INV'),(55,'2017-12-02','INV.999145','C0002',7.00,1.00,988.00,988.00,'INV'),(56,'2017-12-02','INV.999148','C0002',7.00,1.00,4500.00,4815.00,'INV'),(57,'2017-12-02','INV.999147','C0002',7.00,1.00,1200.00,1284.00,'INV'),(58,'2017-12-02','INV.999149','C0002',7.00,1.00,988.00,988.00,'INV'),(59,'2017-12-02','INV.999150','C0002',7.00,1.00,3000.00,3000.00,'INV'),(60,'2017-12-02','INV.999152','C0002',7.00,1.00,40500.00,43335.00,'INV'),(61,'2017-12-02','INV.999151','C0002',7.00,1.00,1200.00,1284.00,'INV'),(62,'2017-12-03','INV.999154','G0003',7.00,3.11,13995.00,13995.00,'INV'),(63,'2017-12-03','INV.999153','C0002',7.00,1.00,988.00,988.00,'INV'),(64,'2017-12-03','INV.999155','F0002',7.00,1.00,1200.00,1284.00,'INV'),(65,'2017-12-03','INV.999156','C0002',7.00,1.00,988.00,988.00,'INV'),(66,'2017-12-04','INV.999157','C0002',7.00,1.00,5310.00,5681.70,'INV'),(67,'2017-12-04','INV.999160','F0002',7.00,1.00,1200.00,1284.00,'INV'),(68,'2017-12-04','INV.999159','G0003',7.00,3.11,13995.00,13995.00,'INV'),(69,'2017-12-04','INV.999158','F0002',7.00,1.00,4500.00,4815.00,'INV'),(70,'2017-12-04','INV.999162','F0002',7.00,1.00,988.00,988.00,'INV'),(71,'2017-12-04','INV.999161','C0002',7.00,1.00,1200.00,1284.00,'INV'),(72,'2017-12-04','INV.999164','G0003',7.00,3.11,13995.00,14974.65,'INV'),(73,'2017-12-04','INV.999165','G0003',7.00,3.11,13995.00,14974.65,'INV'),(74,'2017-12-04','INV.999167','G0003',7.00,3.11,13995.00,14974.65,'INV'),(75,'2017-12-04','INV.999163','G0003',7.00,3.11,9330.00,9330.00,'INV'),(76,'2017-12-04','INV.999166','F0002',7.00,1.00,4500.00,4815.00,'INV'),(77,'2017-12-04','INV.999168','C0002',7.00,1.00,1200.00,1284.00,'INV'),(78,'2017-12-05','INV.999169','C0002',7.00,1.00,1200.00,1284.00,'INV'),(79,'2017-12-05','INV.999170','C0002',7.00,1.00,988.00,988.00,'INV'),(80,'2017-12-05','INV.999171','C0002',7.00,1.00,0.00,0.00,'INV'),(81,'2017-12-05','INV.999172','C0002',7.00,1.00,3000.00,3000.00,'INV'),(82,'2017-12-05','INV.999174','C0002',7.00,1.00,988.00,988.00,'INV'),(83,'2017-12-05','INV.999175','C0002',7.00,1.00,988.00,988.00,'INV'),(84,'2017-12-05','INV.999176','C0002',7.00,1.00,3000.00,3000.00,'INV'),(85,'2017-12-05','INV.999178','C0002',7.00,1.00,4500.00,4815.00,'INV'),(86,'2017-12-05','INV.999177','C0002',7.00,1.00,1200.00,1284.00,'INV'),(87,'2017-12-06','INV.999184','F0002',7.00,1.00,4500.00,4500.00,'INV'),(88,'2017-12-06','INV.999182','C0002',7.00,1.00,1200.00,1284.00,'INV'),(89,'2017-12-06','INV.999183','F0002',7.00,1.00,988.00,988.00,'INV'),(90,'2017-12-06','INV.999181','C0002',7.00,1.00,988.00,988.00,'INV'),(91,'2017-12-06','INV.999185','C0002',7.00,1.00,4500.00,4500.00,'INV'),(92,'2017-12-06','INV.999188','F0002',7.00,1.00,3000.00,3000.00,'INV'),(93,'2017-12-06','INV.999186','C0002',7.00,1.00,988.00,988.00,'INV'),(94,'2017-12-06','INV.999187','F0002',7.00,1.00,1200.00,1284.00,'INV'),(95,'2017-12-12','INV.999194','E201610001',7.00,1.00,1200.00,1284.00,'INV'),(96,'2017-12-13','INV.999197','G0003',7.00,3.11,13995.00,14974.65,'INV'),(97,'2017-12-13','INV.999196','F0002',7.00,1.00,988.00,988.00,'INV'),(98,'2017-12-13','INV.999195','F0002',7.00,1.00,4500.00,4815.00,'INV'),(99,'2017-12-14','INV.999198','C0002',7.00,1.00,1200.00,1284.00,'INV'),(100,'2017-12-14','INV.999199','C0002',7.00,1.00,3000.00,3000.00,'INV'),(101,'2017-12-14','INV.999200','C0002',7.00,1.00,3000.00,3000.00,'INV'),(102,'2017-12-14','INV.999201','C0002',7.00,1.00,988.00,988.00,'INV'),(103,'2017-12-14','INV.999203','F0002',7.00,1.00,4500.00,4815.00,'INV'),(104,'2017-12-14','INV.999202','C0002',7.00,1.00,1200.00,1284.00,'INV'),(105,'2017-12-15','INV.999204','C0002',7.00,1.00,1200.00,1284.00,'INV'),(106,'2017-12-15','INV.999205','G0003',7.00,3.11,13062.00,13323.24,'INV'),(107,'2017-12-15','INV.999206','G0003',7.00,3.11,37786.50,38798.81,'INV'),(108,'2017-12-16','INV.999207','C0002',7.00,1.00,3000.00,3000.00,'INV');
/*!40000 ALTER TABLE `gl_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `permissions` text NOT NULL COMMENT '21 permissions to group',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='DON''T CHANGE IN THIS TABLE EVEN "ID" OTHERWISE SYSTEM WILL NOT WORK ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'TOPFORM MANAGMENT','Admin of Administrator',''),(3,'admin','Administrator Group','{\"quotation_setting\":1,\"company_profile\":1,\"customer_master\":1,\"billing_master\":1,\"salesman_master\":1,\"forex_master\":1,\"gst_master\":1,\"country_master\":1,\"quotation\":1,\"test\\r\\n\":0}'),(4,'SalesGroup','SalesGroup','{\"quotation_setting\":0,\"company_profile\":0,\"customer_master\":1,\"billing_master\":0,\"salesman_master\":1,\"forex_master\":1,\"gst_master\":1,\"country_master\":1,\"quotation\":1,\"pending_quotation\":1,\"confirm_quotation\":1,\"rejected_quotation\":1,\"test\\r\\n\":0}'),(5,'Accounts','Accounting staff','{\"quotation_setting\":0,\"company_profile\":0,\"customer_master\":1,\"billing_master\":1,\"salesman_master\":0,\"forex_master\":0,\"gst_master\":0,\"country_master\":0,\"quotation\":0,\"pending_quotation\":0,\"confirm_quotation\":0,\"rejected_quotation\":0}');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gst_master`
--

DROP TABLE IF EXISTS `gst_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gst_master` (
  `gst_id` int(11) NOT NULL AUTO_INCREMENT,
  `gst_code` varchar(50) NOT NULL,
  `gst_rate` double NOT NULL,
  `gst_description` text NOT NULL,
  `gst_type` varchar(15) NOT NULL,
  PRIMARY KEY (`gst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gst_master`
--

LOCK TABLES `gst_master` WRITE;
/*!40000 ALTER TABLE `gst_master` DISABLE KEYS */;
INSERT INTO `gst_master` VALUES (1,'tx',7,'Purchases with GST incurred at 7% and directly attributable\r\nto taxable supplies','purchase'),(3,'ZP',0,'Purchases from GST registered suppliers that are subject to GST at 0%','purchase'),(8,'IM',7,'7% GST paid to Singapore Customs on the import of goods\r\ninto Singapore','purchase'),(9,'ME',0,'Imports under a special scheme (eg. Major Exporter Scheme,\r\n3rd Party Logistics Scheme) where the GST payable is\r\nsuspended','purchase'),(10,'IGDS',7,'Imports under the import GST deferment scheme where the GST\r\nis suspended until the filing date of the GST return','purchase'),(11,'BL',7,'Purchases where 7% GST is incurred but is specifically\r\nnot claimable (eg. medical expenses for staff)','purchase'),(12,'NR',0,'Purchases from non-GST registered suppliers','purchase'),(13,'EP',0,'Purchases specifically exempted from GST\r\neg. purchase and lease of residential properties, and\r\nthe provision of certain financial services','purchase'),(14,'OP',0,'Supplies outside of the scope of GST Act\r\neg. purchase of services from suppliers established\r\noverseas or purchase of goods that are delivered from a\r\nplace outside Singapore to another place outside Singapore','purchase'),(15,'TX-ESS',7,'Purchases from GST registered suppliers that are subject to\r\nto GST at 7% and directly attributable to the making of\r\nregulation 33 exempt','purchase'),(16,'TX-ESS',7,'Purchases from GST registered suppliers that are subject to\r\nto GST at 7% and directly attributable to the making of\r\nregulation 33 exempt','purchase'),(17,'TX-N33',7,'Purchases from GST registered suppliers that are subject to\r\nto GST at 7%and directly attributable to the making of\r\nnon-regulation 33 exempt','purchase'),(18,'TX-RE',7,'Purchases from GST registered suppliers that are subject to\r\nto GST at 7% and directly attributable to the making of\r\nboth taxable and exempt supplies','purchase'),(19,'SR',7,'Standard-rated supplies with GST charged\r\nLocal supply of goods and services','supply'),(20,'ZR',0,'Zero-rated supplies\r\nSupplies involving goods for export/provision of international\r\nservices','supply'),(21,'ES33',0,'Specific categories of exempt supplies listed under regulation\r\n33 of the GST (General) Regulations','supply'),(22,'ESN33',0,'Exempt supplies other than those listed under regulation 33\r\nof the GST (General) Regulations','supply'),(23,'DS',7,'Deemed supplies (eg. transfer or disposal of business assets\r\nwithout consideration)\r\nSupplies required to be reported pursuant to the GST legislation','supply'),(24,'OS',0,'Out-of-scope supplies\r\nSupplies outside the scope of the GST Act','supply');
/*!40000 ALTER TABLE `gst_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histcost_master`
--

DROP TABLE IF EXISTS `histcost_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histcost_master` (
  `h_c_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `unit_price_sgd` decimal(8,2) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amt_sgd` decimal(8,2) DEFAULT NULL,
  `purchase_id` int(11) NOT NULL,
  `tranaction_date` date NOT NULL,
  PRIMARY KEY (`h_c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histcost_master`
--

LOCK TABLES `histcost_master` WRITE;
/*!40000 ALTER TABLE `histcost_master` DISABLE KEYS */;
INSERT INTO `histcost_master` VALUES (1,5,23.30,30,699.00,2,'2017-05-02'),(2,12,8.28,50,414.00,4,'2017-04-01'),(3,5,60.00,10,600.00,1,'2017-02-01'),(4,5,23.76,30,712.80,3,'2017-08-06'),(5,12,62.08,20,1241.60,1,'2017-04-02'),(6,5,168.00,30,5040.00,2,'2017-06-03'),(7,12,102.96,10,1029.60,3,'2017-05-02'),(8,12,360.00,10,3600.00,5,'2017-05-02'),(9,6,80.80,10,808.00,1,'2017-05-02'),(10,12,60.80,10,608.00,1,'2017-05-03'),(11,12,319.20,10,3192.00,2,'2017-03-06'),(12,12,18.80,10,188.00,1,'2017-05-02'),(13,12,35.20,10,352.00,1,'2017-08-05');
/*!40000 ALTER TABLE `histcost_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_master`
--

DROP TABLE IF EXISTS `invoice_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_master` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_ref_no` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `invoice_header_text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_total` decimal(8,2) NOT NULL,
  `lump_sum_discount` decimal(8,2) NOT NULL,
  `lump_sum_discount_price` decimal(8,2) NOT NULL,
  `gst` decimal(8,2) NOT NULL,
  `final_total` decimal(8,2) NOT NULL,
  `currency_amount` decimal(8,2) NOT NULL,
  `final_total_forex` decimal(8,2) NOT NULL,
  `terms_of_payments` varchar(50) DEFAULT NULL,
  `training_venue` varchar(50) DEFAULT NULL,
  `modification` varchar(50) DEFAULT NULL,
  `cancellation` varchar(50) DEFAULT NULL,
  `invoice_footer_text` text NOT NULL,
  `invoice_status` varchar(15) NOT NULL DEFAULT 'C',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  `reject_msg` varchar(255) DEFAULT NULL,
  `receipt` int(11) NOT NULL DEFAULT '0',
  `opening_balance` decimal(8,2) DEFAULT NULL,
  `full_amount` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_master`
--

LOCK TABLES `invoice_master` WRITE;
/*!40000 ALTER TABLE `invoice_master` DISABLE KEYS */;
INSERT INTO `invoice_master` VALUES (1,'INV.999204',1,2,'',2,1200.00,0.00,1200.00,7.00,1284.00,1.00,1284.00,'C.O.D.','Topform Trg Ctr',NULL,NULL,'All overdue accounts is chargeable for interest @ 1% per mensum','P','2017-12-15','2017-12-15',NULL,0,NULL,NULL),(2,'INV.999205',3,1,'',2,13062.00,0.00,13062.00,7.00,13323.24,3.11,13323.24,'C.O.D.','Topform Trg Ctr',NULL,NULL,'All overdue accounts is chargeable for interest @ 1% per mensum','P','2017-12-15','2017-12-15',NULL,0,NULL,NULL),(3,'INV.999206',3,4,'',2,37786.50,0.00,37786.50,7.00,38798.81,3.11,38798.81,'C.O.D.','Topform Trg Ctr',NULL,NULL,'All overdue accounts is chargeable for interest @ 1% per mensum','P','2017-12-15','2017-12-15',NULL,0,NULL,NULL),(4,'INV.999207',1,2,'',2,3000.00,0.00,3000.00,7.00,3000.00,1.00,3000.00,'C.O.D.','Topform Trg Ctr',NULL,NULL,'All overdue accounts is chargeable for interest @ 1% per mensum','P','2017-12-16','2017-12-16',NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `invoice_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_product_master`
--

DROP TABLE IF EXISTS `invoice_product_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_product_master` (
  `i_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `product_total` decimal(8,2) NOT NULL,
  `gst_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`i_p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_product_master`
--

LOCK TABLES `invoice_product_master` WRITE;
/*!40000 ALTER TABLE `invoice_product_master` DISABLE KEYS */;
INSERT INTO `invoice_product_master` VALUES (1,1,10,1,0.00,1200.00,1200.00,19,'2017-12-15','2017-12-15'),(2,2,13,1,0.00,3000.00,9330.00,24,'2017-12-15','2017-12-15'),(3,2,10,1,0.00,1200.00,3732.00,19,'2017-12-15','2017-12-15'),(4,3,12,1,0.00,4500.00,13995.00,20,'2017-12-15','2017-12-15'),(5,3,13,1,0.00,3000.00,9330.00,24,'2017-12-15','2017-12-15'),(6,3,5,1,0.00,4650.00,14461.50,19,'2017-12-15','2017-12-15'),(7,4,13,1,0.00,3000.00,3000.00,24,'2017-12-16','2017-12-16');
/*!40000 ALTER TABLE `invoice_product_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_setting`
--

DROP TABLE IF EXISTS `invoice_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_setting` (
  `invoice_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `invoice_text_prefix` varchar(50) NOT NULL,
  `invoice_number_prefix` varchar(50) NOT NULL,
  `invoice_type` varchar(50) NOT NULL,
  `invoice_header_text` text NOT NULL,
  `terms_of_payments` varchar(100) NOT NULL,
  `training_venue` varchar(100) NOT NULL,
  `modification` varchar(100) NOT NULL,
  `cancellation` varchar(100) NOT NULL,
  `invoice_footer_text` text NOT NULL,
  PRIMARY KEY (`invoice_setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_setting`
--

LOCK TABLES `invoice_setting` WRITE;
/*!40000 ALTER TABLE `invoice_setting` DISABLE KEYS */;
INSERT INTO `invoice_setting` VALUES (1,1,'TOPs','19013','invoice','invoice header','cash on delivery','training invoice','modification invoice','','invoice notes'),(2,2,'INV','999207','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum'),(4,3,'','','','','','','','',''),(5,7,'INV','999194','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum'),(6,8,'INV','999195','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum'),(7,10,'INV','999193','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum'),(8,11,'INV','999193','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum'),(9,12,'INV','999193','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum'),(10,5,'INV','999193','','','C.O.D.','Topform Trg Ctr','','','All overdue accounts is chargeable for interest @ 1% per mensum');
/*!40000 ALTER TABLE `invoice_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `open_stock_table`
--

DROP TABLE IF EXISTS `open_stock_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_stock_table` (
  `open_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `open_billing_id` int(11) NOT NULL,
  `open_stock_sign` varchar(1) DEFAULT '+',
  `open_stock_tran_type` varchar(255) DEFAULT 'Open',
  `open_stock_quantity` int(255) DEFAULT NULL,
  `open_stock_status` varchar(1) DEFAULT 'C',
  PRIMARY KEY (`open_stock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_stock_table`
--

LOCK TABLES `open_stock_table` WRITE;
/*!40000 ALTER TABLE `open_stock_table` DISABLE KEYS */;
INSERT INTO `open_stock_table` VALUES (1,0,'+','Open',100,'C'),(2,6,'+','Open',100,'D'),(3,0,'+','Open',200,'C'),(4,12,'+','Open',100,'D'),(5,5,'+','Open',300,'D'),(6,5,'+','Open',100,'C');
/*!40000 ALTER TABLE `open_stock_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `open_table`
--

DROP TABLE IF EXISTS `open_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_table` (
  `open_id` int(11) NOT NULL AUTO_INCREMENT,
  `open_tran_date` date DEFAULT NULL,
  `open_doc_ref` varchar(255) DEFAULT NULL,
  `open_remarks` varchar(255) DEFAULT NULL,
  `open_amount` decimal(12,2) DEFAULT NULL,
  `open_sign` varchar(1) DEFAULT NULL,
  `open_status` varchar(1) DEFAULT 'C',
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`open_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_table`
--

LOCK TABLES `open_table` WRITE;
/*!40000 ALTER TABLE `open_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `open_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `other_payment`
--

DROP TABLE IF EXISTS `other_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `other_payment` (
  `opay_id` int(11) NOT NULL AUTO_INCREMENT,
  `opay_date` date DEFAULT NULL,
  `opay_ref_no` varchar(255) DEFAULT NULL,
  `opay_payee` varchar(255) DEFAULT NULL,
  `opay_coa_id` int(11) NOT NULL,
  `opay_amount` decimal(10,2) DEFAULT NULL,
  `opay_created_on` date NOT NULL,
  `opay_user_id` int(11) NOT NULL,
  `opay_status` varchar(1) DEFAULT 'C',
  PRIMARY KEY (`opay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `other_payment`
--

LOCK TABLES `other_payment` WRITE;
/*!40000 ALTER TABLE `other_payment` DISABLE KEYS */;
INSERT INTO `other_payment` VALUES (1,'2017-12-20','Paymen.66832','5555',6,11111111.00,'2017-12-20',2,'C'),(8,'2017-12-20','Paymen.66835','test_payee_name  ',5,500.00,'2017-12-20',2,'D'),(3,'2017-12-20','Paymen.66833','test_payee_name  ',6,31044.00,'2017-12-20',2,'D'),(4,'2017-12-20','Paymen.66833','test_payee_name  ',4,4777.00,'2017-12-20',2,'D'),(5,'2017-12-20','Paymen.66833','ppppppp',2,500.00,'2017-12-20',2,'C'),(6,'2017-12-20','Paymen.66833','test_payee_name  ',10,400.00,'2017-12-20',2,'C'),(7,'2017-12-20','Paymen.66834','test_payee_name  ',18,120.00,'2017-12-20',2,'P'),(9,'2017-12-20','Paymen.66836','pppp ',6,7777.00,'2017-12-20',2,'P'),(10,'2017-12-20','Paymen.66836','pppp  ',4,6666.00,'2017-12-20',2,'C');
/*!40000 ALTER TABLE `other_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payee`
--

DROP TABLE IF EXISTS `payee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payee` (
  `payee_id` int(11) NOT NULL AUTO_INCREMENT,
  `payee_name` varchar(255) NOT NULL,
  PRIMARY KEY (`payee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payee`
--

LOCK TABLES `payee` WRITE;
/*!40000 ALTER TABLE `payee` DISABLE KEYS */;
INSERT INTO `payee` VALUES (1,'test_payee_name'),(2,'yyyyyyyyyyyyyy'),(9,'5555'),(8,'111111111111'),(7,'pppp');
/*!40000 ALTER TABLE `payee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_master`
--

DROP TABLE IF EXISTS `payment_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_master` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_ref_no` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_reference_id` varchar(255) NOT NULL,
  `bank` varchar(2555) NOT NULL,
  `cheque` varchar(255) NOT NULL,
  `other_reference` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `purchase` varchar(255) NOT NULL,
  `payment_status` varchar(15) NOT NULL DEFAULT 'C',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_master`
--

LOCK TABLES `payment_master` WRITE;
/*!40000 ALTER TABLE `payment_master` DISABLE KEYS */;
INSERT INTO `payment_master` VALUES (1,'Paymen.66854',5,2,'4','','','','HKD',300.00,'CN100,CN300,Inv555','P','2017-12-18','2017-12-18'),(2,'Paymen.66855',5,2,'6','','','','HKD',2844.94,'CN300,CN9000,Inv555,Inv6000.06','P','2017-12-18','2017-12-18'),(3,'Paymen.66856',5,2,'5','','','','HKD',4000.00,'2222,555,Inv8888.89','C','2017-12-18','2017-12-18'),(4,'Paymen.66857',5,2,'9','','','','HKD',0.00,'2222,666','C','2017-12-18','2017-12-18'),(5,'Paymen.66858',5,2,'','','','','HKD',80000.00,'555','C','2017-12-18','2017-12-18'),(6,'Paymen.66859',5,2,'','','','','HKD',0.00,'','C','2017-12-18','2017-12-18'),(7,'Paymen.66860',5,2,'10','','','','HKD',0.00,'2222','C','2017-12-18','2017-12-18'),(8,'Paymen.66861',5,2,'5','ads','weqewwq','ewqwe','HKD',58656.11,'2222,555,666,Inv8888.89','C','2017-12-18','2017-12-18'),(9,'Paymen.66862',5,2,'9','','','','HKD',67545.00,'2222,555,666','C','2017-12-19','2017-12-19');
/*!40000 ALTER TABLE `payment_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_purchase_master`
--

DROP TABLE IF EXISTS `payment_purchase_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_purchase_master` (
  `pay_pur_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `pay_pur_amount` decimal(8,2) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `full_amount` decimal(10,2) DEFAULT NULL,
  `partial_status` varchar(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`pay_pur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_purchase_master`
--

LOCK TABLES `payment_purchase_master` WRITE;
/*!40000 ALTER TABLE `payment_purchase_master` DISABLE KEYS */;
INSERT INTO `payment_purchase_master` VALUES (1,1,100.00,NULL,NULL,1,100.00,'P'),(2,3,200.00,NULL,NULL,1,300.00,'P'),(3,4,300.00,NULL,NULL,1,555.00,'P'),(4,3,100.00,NULL,NULL,2,100.00,'P'),(5,2,9000.00,NULL,NULL,2,9000.00,'P'),(6,4,255.00,NULL,NULL,2,255.00,'P'),(7,6,6000.06,NULL,NULL,2,6000.06,'P'),(8,10,4000.00,NULL,NULL,3,8000.00,'C'),(9,11,4000.00,NULL,NULL,3,80000.00,'C'),(10,5,0.00,NULL,NULL,3,8888.89,'C'),(11,10,0.00,NULL,NULL,4,8000.00,'C'),(12,9,0.00,NULL,NULL,4,4455.00,'C'),(13,10,0.00,NULL,NULL,7,8000.00,'C'),(14,10,8000.00,NULL,NULL,8,8000.00,'C'),(15,11,80000.00,NULL,NULL,8,80000.00,'C'),(16,9,4455.00,NULL,NULL,8,4455.00,'C'),(17,5,8888.89,NULL,NULL,8,8888.89,'C'),(18,10,8000.00,NULL,NULL,9,8000.00,'C'),(19,11,80000.00,NULL,NULL,9,80000.00,'C'),(20,9,4455.00,NULL,NULL,9,4455.00,'C');
/*!40000 ALTER TABLE `payment_purchase_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_setting`
--

DROP TABLE IF EXISTS `payment_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_setting` (
  `payment_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `payment_text_prefix` varchar(50) NOT NULL,
  `payment_number_prefix` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_header_text` text NOT NULL,
  `terms_of_payments` varchar(100) NOT NULL,
  `training_venue` varchar(100) NOT NULL,
  `modification` varchar(100) NOT NULL,
  `cancellation` varchar(100) NOT NULL,
  `payment_footer_text` text NOT NULL,
  PRIMARY KEY (`payment_setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_setting`
--

LOCK TABLES `payment_setting` WRITE;
/*!40000 ALTER TABLE `payment_setting` DISABLE KEYS */;
INSERT INTO `payment_setting` VALUES (4,2,'Paymen','66836','','','','','','',''),(5,7,'Paymen','66827','','','','','','',''),(6,8,'Paymen','66827','','','','','','',''),(7,10,'Paymen','66827','','','','','','',''),(8,11,'Paymen','66827','','','','','','',''),(9,12,'Paymen','66827','','','','','','',''),(10,5,'Paymen','66827','','','','','','','');
/*!40000 ALTER TABLE `payment_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_master`
--

DROP TABLE IF EXISTS `purchase_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_master` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_ref_no` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount_foreign` decimal(8,2) NOT NULL,
  `currency_amount` decimal(8,2) NOT NULL,
  `total_amount_local` decimal(8,2) NOT NULL,
  `local_handling` decimal(8,2) NOT NULL,
  `total_purchase_b4_gst` decimal(8,2) NOT NULL,
  `gst_in_sgd` decimal(8,2) NOT NULL,
  `tran_type` varchar(50) NOT NULL DEFAULT 'PUR',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  `purchase_status` varchar(1) DEFAULT 'C',
  `doc_date` date NOT NULL,
  `freight_insurance` decimal(8,2) DEFAULT NULL,
  `payment` int(1) NOT NULL DEFAULT '0',
  `import_permit_ref` varchar(100) DEFAULT NULL,
  `full_amount` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_master`
--

LOCK TABLES `purchase_master` WRITE;
/*!40000 ALTER TABLE `purchase_master` DISABLE KEYS */;
INSERT INTO `purchase_master` VALUES (1,'ssssss',4,2,1000.00,0.74,1496.60,200.00,1696.60,0.00,'PUR','2017-12-20','2017-12-20','C','2017-12-01',100.00,0,'2dddddd',1247.00);
/*!40000 ALTER TABLE `purchase_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_product_master`
--

DROP TABLE IF EXISTS `purchase_product_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_product_master` (
  `p_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(8,2) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`p_p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_product_master`
--

LOCK TABLES `purchase_product_master` WRITE;
/*!40000 ALTER TABLE `purchase_product_master` DISABLE KEYS */;
INSERT INTO `purchase_product_master` VALUES (1,1,12,100,10.00,1000.00,'2017-12-20','2017-12-20');
/*!40000 ALTER TABLE `purchase_product_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_master`
--

DROP TABLE IF EXISTS `quotation_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotation_master` (
  `quotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_ref_no` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `quotation_header_text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_total` decimal(8,2) NOT NULL,
  `lump_sum_discount` decimal(8,2) NOT NULL,
  `lump_sum_discount_price` decimal(8,2) NOT NULL,
  `gst` decimal(8,2) NOT NULL,
  `final_total` decimal(8,2) NOT NULL,
  `currency_amount` decimal(8,2) NOT NULL,
  `final_total_forex` decimal(8,2) NOT NULL,
  `terms_of_payments` varchar(50) DEFAULT NULL,
  `training_venue` varchar(50) DEFAULT NULL,
  `modification` varchar(50) DEFAULT NULL,
  `cancellation` varchar(50) DEFAULT NULL,
  `quotation_footer_text` text NOT NULL,
  `quotation_status` varchar(15) NOT NULL DEFAULT 'PENDING',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  `invoice` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_master`
--

LOCK TABLES `quotation_master` WRITE;
/*!40000 ALTER TABLE `quotation_master` DISABLE KEYS */;
INSERT INTO `quotation_master` VALUES (1,'TOP.20216',2,1,'Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End',7,3000.00,0.00,3000.00,7.00,3000.00,1.00,3000.00,'5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges',NULL,'All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.','CONFIRM','2017-12-12','2017-12-12',0),(2,'TOP.20216',1,1,'Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End',2,4500.00,0.00,4500.00,7.00,4815.00,1.00,4815.00,'5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges',NULL,'All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.','CONFIRM','2017-12-12','2017-12-12',0),(3,'TOP.20217',2,1,'Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End',2,1200.00,0.00,1200.00,7.00,1284.00,1.00,1284.00,'5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges',NULL,'All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.','PENDING','2017-12-12','2017-12-12',0),(4,'TOP.20218',1,4,'Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End',2,4500.00,0.00,4500.00,7.00,4815.00,1.00,4815.00,'5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges',NULL,'All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.','CONFIRM','2017-12-12','2017-12-12',0);
/*!40000 ALTER TABLE `quotation_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_product_master`
--

DROP TABLE IF EXISTS `quotation_product_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotation_product_master` (
  `q_p_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `product_total` decimal(8,2) NOT NULL,
  `gst_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`q_p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_product_master`
--

LOCK TABLES `quotation_product_master` WRITE;
/*!40000 ALTER TABLE `quotation_product_master` DISABLE KEYS */;
INSERT INTO `quotation_product_master` VALUES (1,1,13,1,0.00,3000.00,3000.00,24,'2017-12-12','2017-12-12'),(2,2,6,1,0.00,4500.00,4500.00,19,'2017-12-12','2017-12-12'),(3,3,10,1,0.00,1200.00,1200.00,19,'2017-12-12','2017-12-12'),(4,4,6,1,0.00,4500.00,4500.00,19,'2017-12-12','2017-12-12');
/*!40000 ALTER TABLE `quotation_product_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_setting`
--

DROP TABLE IF EXISTS `quotation_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotation_setting` (
  `quotation_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `quotation_text_prefix` varchar(50) NOT NULL,
  `quotation_number_prefix` varchar(50) NOT NULL,
  `quotation_type` varchar(50) NOT NULL,
  `quotation_header_text` text NOT NULL,
  `terms_of_payments` varchar(100) NOT NULL,
  `training_venue` varchar(100) NOT NULL,
  `modification` varchar(100) NOT NULL,
  `cancellation` varchar(100) NOT NULL,
  `quotation_footer_text` text NOT NULL,
  PRIMARY KEY (`quotation_setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_setting`
--

LOCK TABLES `quotation_setting` WRITE;
/*!40000 ALTER TABLE `quotation_setting` DISABLE KEYS */;
INSERT INTO `quotation_setting` VALUES (1,2,'TOP','20218','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(2,1,'TOP','88889','invoice','test header','in 5 days','training center','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(6,7,'TOP','20216','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(7,8,'TOP','20215','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(8,10,'TOP','20215','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(9,11,'TOP','20215','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(10,12,'TOP','20215','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.'),(11,5,'TOP','20215','order_entry','Based on the broad guidelines given to us, we are pleased to quote as follows : demo  text End','5 days Overdue will be charged 3% of Total Payment','TRADPAC Training Centre','Modification subject to separate charges','','All discounts extended shall be valid for 7 days from offer date*  Please stamp and sign below to confirm this order.');
/*!40000 ALTER TABLE `quotation_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_invoice_master`
--

DROP TABLE IF EXISTS `receipt_invoice_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_invoice_master` (
  `r_i_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `rec_inv_amount` decimal(8,2) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  `receipt_id` int(11) NOT NULL,
  `full_amount` decimal(10,2) DEFAULT NULL,
  `partial_status` varchar(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`r_i_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_invoice_master`
--

LOCK TABLES `receipt_invoice_master` WRITE;
/*!40000 ALTER TABLE `receipt_invoice_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `receipt_invoice_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_master`
--

DROP TABLE IF EXISTS `receipt_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_master` (
  `receipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_ref_no` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_reference_id` varchar(255) NOT NULL,
  `bank` varchar(2555) NOT NULL,
  `cheque` varchar(255) NOT NULL,
  `other_reference` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `receipt_status` varchar(15) NOT NULL DEFAULT 'C',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`receipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_master`
--

LOCK TABLES `receipt_master` WRITE;
/*!40000 ALTER TABLE `receipt_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `receipt_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipt_setting`
--

DROP TABLE IF EXISTS `receipt_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipt_setting` (
  `receipt_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `receipt_text_prefix` varchar(50) NOT NULL,
  `receipt_number_prefix` varchar(50) NOT NULL,
  `receipt_type` varchar(50) NOT NULL,
  `receipt_header_text` text NOT NULL,
  `terms_of_payments` varchar(100) NOT NULL,
  `training_venue` varchar(100) NOT NULL,
  `modification` varchar(100) NOT NULL,
  `cancellation` varchar(100) NOT NULL,
  `receipt_footer_text` text NOT NULL,
  PRIMARY KEY (`receipt_setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipt_setting`
--

LOCK TABLES `receipt_setting` WRITE;
/*!40000 ALTER TABLE `receipt_setting` DISABLE KEYS */;
INSERT INTO `receipt_setting` VALUES (2,1,'REC','107','','','','','','',''),(3,2,'REC','66679','','','','','','',''),(4,7,'REC','66574','','','','','','',''),(5,8,'REC','66574','','','','','','',''),(6,10,'REC','66574','','','','','','',''),(7,11,'REC','66574','','','','','','',''),(8,12,'REC','66574','','','','','','',''),(9,5,'REC','66574','','','','','','','');
/*!40000 ALTER TABLE `receipt_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salesman_master`
--

DROP TABLE IF EXISTS `salesman_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesman_master` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_code` varchar(50) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_category` varchar(15) DEFAULT NULL,
  `s_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesman_master`
--

LOCK TABLES `salesman_master` WRITE;
/*!40000 ALTER TABLE `salesman_master` DISABLE KEYS */;
INSERT INTO `salesman_master` VALUES (1,'S001','JEN',NULL,NULL),(2,'L001','FANNIE',NULL,NULL),(3,'V0001','VELDA',NULL,NULL),(4,'L002','LILIAN TEO',NULL,NULL);
/*!40000 ALTER TABLE `salesman_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_master`
--

DROP TABLE IF EXISTS `security_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `security_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_master`
--

LOCK TABLES `security_master` WRITE;
/*!40000 ALTER TABLE `security_master` DISABLE KEYS */;
INSERT INTO `security_master` VALUES (1,'quotation_setting'),(2,'company_profile'),(3,'customer_master'),(4,'billing_master'),(5,'salesman_master'),(6,'forex_master'),(7,'gst_master'),(8,'country_master'),(9,'quotation'),(10,'pending_quotation'),(11,'confirm_quotation'),(12,'rejected_quotation');
/*!40000 ALTER TABLE `security_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_adjustment_master`
--

DROP TABLE IF EXISTS `stock_adjustment_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_adjustment_master` (
  `adjustment_id` int(11) NOT NULL AUTO_INCREMENT,
  `adjustment_ref_no` varchar(255) NOT NULL,
  `adjustment_remarks` varchar(255) NOT NULL,
  `adjustment_billing_id` int(11) NOT NULL,
  `adjustment_status` varchar(1) NOT NULL DEFAULT 'C',
  `adjustment_quantity` int(255) DEFAULT NULL,
  `adjustment_sign` varchar(1) NOT NULL,
  `adjustment_tran_type` varchar(255) DEFAULT 'Adjustment',
  `created_on` date DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`adjustment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_adjustment_master`
--

LOCK TABLES `stock_adjustment_master` WRITE;
/*!40000 ALTER TABLE `stock_adjustment_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_adjustment_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_invoice_master`
--

DROP TABLE IF EXISTS `stock_invoice_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_invoice_master` (
  `s_i_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `product_total` decimal(8,2) NOT NULL,
  `gst_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`s_i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_invoice_master`
--

LOCK TABLES `stock_invoice_master` WRITE;
/*!40000 ALTER TABLE `stock_invoice_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_invoice_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_purchase_master`
--

DROP TABLE IF EXISTS `stock_purchase_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_purchase_master` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_ref_no` varchar(50) NOT NULL,
  `purchase_supplier_id` int(11) NOT NULL,
  `purchase_billing_id` int(11) NOT NULL,
  `purchase_quantity` int(255) DEFAULT NULL,
  `purchase_status` varchar(1) DEFAULT 'C',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL,
  `purchase_tran_type` varchar(20) NOT NULL DEFAULT 'Purchase',
  `purchase_sign` varchar(1) NOT NULL DEFAULT '+',
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_purchase_master`
--

LOCK TABLES `stock_purchase_master` WRITE;
/*!40000 ALTER TABLE `stock_purchase_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_purchase_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `emp_name` varchar(50) DEFAULT NULL,
  `level` varchar(50) NOT NULL,
  `conf_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='DON''T CHANGE IN THIS TABLE EVEN ID OTHERWISE SYSTEM WILL NOT WORK';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,3,'117.218.143.51','droopy','$2y$08$uC54Y0lonVVXgKAM6qwMJOWqb5vSUM0ziRIFmZ4SUU8f9BClbY83C',NULL,'trueline.chirag@gmail.com',NULL,NULL,NULL,NULL,1500045874,1513786963,1,'Chirag jagani','admin',6),(3,4,'117.218.143.51','sale1','$2y$08$uaJ.J0H.R0AAookWiUijbufCW.h5TX3BqdTQhm8JpdPC8YIJEg6Ou',NULL,'salesperson1@gmail.com',NULL,NULL,NULL,NULL,1500103217,1500535940,1,'sales person','SalesGroup',NULL),(4,3,'45.126.201.241','velda','$2y$08$9E7kjZukq8jIN49qNgLAt.NktgZGFAgTm1VczG.g95ZBYLyiIvtCK',NULL,'admin2@admin.com',NULL,NULL,NULL,NULL,1500387661,1500529903,1,'velda','SalesGroup',NULL),(5,1,'127.0.0.1','superuser','$2y$08$j2XSkDNnNLW8Ve0wSsHD8.MIqhlkIci4jgMUaeBMIrsVlQzWgmQL2',NULL,'superuser@super.com',NULL,NULL,NULL,NULL,1512706946,1513095215,1,'Super User','TOPFORM MANAGMENT',NULL),(6,5,'127.0.0.1','new_test_user','$2y$08$zKgsTesGs/v2ZgUvb.kRSuJ4KZPf5I8nP25gAVdS8XZV/KYjVER7W',NULL,'new@new.com',NULL,NULL,NULL,NULL,1512788205,NULL,1,'new_test_user','Accounts',NULL),(7,3,'127.0.0.1','admin1','$2y$08$JE8/IxpSd//2nLcvB6qUWecOVuuhdwVexKRid8JlnlbYBG8ApZuB6',NULL,'admin1@admin1.com',NULL,NULL,NULL,NULL,1512812238,1513050815,1,'Admin1 Full name','admin',1),(8,3,'127.0.0.1','admin2','$2y$08$8uR20DAV2td7YO1gI9yuTuQ40B.TNz.7e6iny38zM3sDL.uNuCdqy',NULL,'admin2@admin2.com',NULL,NULL,NULL,NULL,1512812292,1513050260,1,'Admin2 full name','admin',2),(10,3,'127.0.0.1','admin4','$2y$08$EXTRP4HITp029BtWKZYNr.B8vKRgP8Q1dEgMsNqT8YX8ZHvJiAbfy',NULL,'admin4@admin4.com',NULL,NULL,NULL,NULL,1512812382,1513051408,1,'admin 4 full name','admin',4),(11,3,'127.0.0.1','admin5','$2y$08$9wnM.bsEUI8KdNyKGoYen.ByaXjbuDTpDd8dK0mKiwJOfDZoEs3W2',NULL,'admin5@admin5.com',NULL,NULL,NULL,NULL,1512812547,1513048410,1,'admin 5 Full name','admin',5),(12,3,'127.0.0.1','admin3','$2y$08$sbDzChfZHLCOy05a0Tl2kuOKHkHh7ENaNubXa0iQqmYse7Mxppm4a',NULL,'admin3@admin3.com',NULL,NULL,NULL,NULL,1512982220,1513048125,1,'admin3 full name','admin',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='DON''T CHANGE IN THIS TABLE EVEN "ID" OTHERWISE SYSTEM WILL NOT WORK';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (2,2,3),(3,3,4),(4,4,3),(1,5,1),(6,6,5),(11,7,3),(13,8,4),(10,10,3),(12,11,3),(14,12,3);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-21  6:31:50
