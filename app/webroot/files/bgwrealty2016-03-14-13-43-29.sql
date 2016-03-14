-- MySQL dump 10.13  Distrib 5.6.26, for osx10.6 (x86_64)
--
-- Host: localhost    Database: bgw
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `type` varchar(20) DEFAULT NULL,
  `content` text,
  `date` datetime DEFAULT NULL,
  `suburb_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `filename` text,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'业内动态第一篇','YNDT','<p>不知道有什么动态</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg\" style=\"height:226px; width:300px\" /></p>\r\n','2016-03-01 15:37:04',0,0,'APPROVAL','复制.jpg',0),(2,'市政规划第一篇','SZGH','<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Wifi.jpg\" style=\"height:207px; width:244px\" /></td>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Kensington 区要有free WiFi了~~~</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>以后上网不用花钱了~~~</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>哈哈哈哈</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n','2016-03-01 16:16:35',3,0,'APPROVAL','FileZilla_3.14.1_macosx-x86.app.tar.bz2',0),(3,'业内动态第二篇','YNDT','<p><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg\" style=\"height:226px; width:300px\" /></p>\r\n\r\n<p>没啥内容，随便写点啥</p>\r\n','2016-03-02 02:41:55',2,0,'APPROVAL',NULL,0),(4,'市场数据第一篇','SCSJ','<p><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Wifi.jpg\" style=\"height:207px; width:244px\" /></p>\r\n\r\n<p>谁知道呢</p>\r\n','2016-03-02 13:10:46',3,2,'APPROVAL','Idea.jpg',0),(5,'政策信息第一篇','ZCXX','<p>不知道</p>\r\n','2016-03-02 13:13:50',2,1,'APPROVAL','Idea.jpg',0),(6,'楼盘信息第一篇','LPXX','<p><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/20150725_135004.jpg\" style=\"height:183px; width:326px\" /></p>\r\n\r\n<p>这个楼盘要涨价~~~！</p>\r\n','2016-03-05 14:57:57',3,2,'DRAFT','',1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` date DEFAULT NULL COMMENT '联系时间',
  `date` datetime DEFAULT NULL COMMENT '记录时间',
  `content` text,
  `delete` tinyint(1) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type` text COMMENT '联系方式',
  `xg` text COMMENT '效果',
  `khyx` text COMMENT '客户意向',
  `kpsj` text COMMENT '看盘时间',
  `property_id` int(11) DEFAULT NULL,
  `ptype_id` int(11) DEFAULT NULL COMMENT '拟推户型',
  `kpjg` text COMMENT '看盘结果',
  `khyj` text COMMENT '客户意见',
  `ctype_id` int(11) DEFAULT NULL COMMENT '意向判断',
  `hxfw` text COMMENT '后续服务',
  `zjmsj` text COMMENT '再见面时间',
  `gjjh` text COMMENT '跟进计划',
  `sxzz` text COMMENT '所需支持',
  PRIMARY KEY (`id`,`customer_id`,`employee_id`),
  KEY `contacts_customers1_idx` (`customer_id`),
  KEY `contacts_employees1_idx` (`employee_id`),
  CONSTRAINT `contacts_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `contacts_employees1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'2016-03-06','2016-03-06 14:01:43','打了一次电话吧',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'2016-02-11','2016-02-16 14:24:33','很早的联系',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'2016-03-05','2016-03-06 14:42:04','谈了几分钟',NULL,3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'2016-03-06','2016-03-08 04:42:44','11111',NULL,1,1,'12','2','3','4',1,1,'5','6',1,'7','8','9999','0000'),(6,'2016-03-07','2016-03-13 01:25:47','werq35',NULL,2,4,'3135','w5a','ijoj','明天',2,1,'adf ','asd a',1,'asdfa','fasdf','asdf','asdf'),(7,'2016-03-09','2016-03-13 01:27:07','',NULL,5,4,'','','','',2,2,'','',NULL,'','','','');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctypes`
--

DROP TABLE IF EXISTS `ctypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL COMMENT '客户来源/客户分类',
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctypes`
--

LOCK TABLES `ctypes` WRITE;
/*!40000 ALTER TABLE `ctypes` DISABLE KEYS */;
INSERT INTO `ctypes` VALUES (1,'KHFL','很热'),(3,'KHLY','朋友介绍'),(4,'KHLY','网站广告');
/*!40000 ALTER TABLE `ctypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctypes_customers`
--

DROP TABLE IF EXISTS `ctypes_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctypes_customers` (
  `ctype_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`ctype_id`,`customer_id`),
  KEY `ctypes_customers_customers1_idx` (`customer_id`),
  KEY `ctypes_customers_ctypes1_idx` (`ctype_id`),
  CONSTRAINT `ctypes_customers_ctypes1` FOREIGN KEY (`ctype_id`) REFERENCES `ctypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ctypes_customers_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctypes_customers`
--

LOCK TABLES `ctypes_customers` WRITE;
/*!40000 ALTER TABLE `ctypes_customers` DISABLE KEYS */;
INSERT INTO `ctypes_customers` VALUES (3,1),(1,2),(3,2),(1,3),(3,3),(4,3),(1,4),(4,4);
/*!40000 ALTER TABLE `ctypes_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `gender` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `wechat` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `purpose` text COMMENT '购买目的',
  `wys` text COMMENT '意向物业',
  `suburbs` text COMMENT '意向区域',
  `ptypes` text COMMENT '意向户型',
  `cfls` text COMMENT '客户分类',
  `clys` text COMMENT '客户来源',
  `price_min` int(11) DEFAULT NULL COMMENT '意向价格',
  `price_max` int(11) DEFAULT NULL COMMENT '意向价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'客户1',1,'2016-02-29 19:29:19',4,1,'1313515','','customer@cs.com',NULL,'投资','物业2<br/>','Kingsford<br/>','两室一厅一卫<br/>三室一厅一卫<br/>','','朋友介绍<br/>',300,1000),(2,'客户2',0,'2016-02-29 19:55:31',0,4,'1352326','','customer@cs.com',NULL,'自住','物业2<br/>','Kingsford<br/>Kensington<br/>','三室一厅一卫<br/>','很热<br/>','朋友介绍<br/>',500,1300),(3,'客户3',1,'2016-02-29 20:06:16',0,1,'13532346','','customer@cs.com',NULL,'','物业2<br/>','Kingsford<br/>','两室一厅一卫<br/>三室一厅一卫<br/>','分类3<br/>','朋友介绍<br/>网站广告<br/>',500,1400),(4,'客户11',0,'2016-03-12 15:58:29',0,3,'','','',NULL,'投资','物业1<br/>','Kensington<br/>','两室一厅一卫<br/>','很热<br/>','网站广告<br/>',NULL,NULL),(5,'客户12',0,'2016-03-12 15:59:12',0,4,'','','',NULL,'自住','物业1<br/>','Kensington<br/>','三室一厅一卫<br/>','','网站广告<br/>',NULL,NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_ptypes`
--

DROP TABLE IF EXISTS `customers_ptypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_ptypes` (
  `customer_id` int(11) NOT NULL,
  `ptype_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`,`ptype_id`),
  KEY `customers_ptypes_ptypes1_idx` (`ptype_id`),
  KEY `customers_ptypes_customers1_idx` (`customer_id`),
  CONSTRAINT `customers_ptypes_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customers_ptypes_ptypes1` FOREIGN KEY (`ptype_id`) REFERENCES `ptypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_ptypes`
--

LOCK TABLES `customers_ptypes` WRITE;
/*!40000 ALTER TABLE `customers_ptypes` DISABLE KEYS */;
INSERT INTO `customers_ptypes` VALUES (1,1),(3,1),(4,1),(1,2),(2,2),(3,2),(5,2);
/*!40000 ALTER TABLE `customers_ptypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_suburbs`
--

DROP TABLE IF EXISTS `customers_suburbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_suburbs` (
  `customer_id` int(11) NOT NULL,
  `suburb_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`,`suburb_id`),
  KEY `customers_suburbs_suburbs1_idx` (`suburb_id`),
  KEY `customers_suburbs_customers1_idx` (`customer_id`),
  CONSTRAINT `customers_suburbs_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customers_suburbs_suburbs1` FOREIGN KEY (`suburb_id`) REFERENCES `suburbs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_suburbs`
--

LOCK TABLES `customers_suburbs` WRITE;
/*!40000 ALTER TABLE `customers_suburbs` DISABLE KEYS */;
INSERT INTO `customers_suburbs` VALUES (1,2),(2,2),(3,2),(2,3),(4,3),(5,3);
/*!40000 ALTER TABLE `customers_suburbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_wys`
--

DROP TABLE IF EXISTS `customers_wys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_wys` (
  `customer_id` int(11) NOT NULL,
  `wy_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`,`wy_id`),
  KEY `customers_wys_wys1_idx` (`wy_id`),
  KEY `customers_wys_customers1_idx` (`customer_id`),
  CONSTRAINT `customers_wys_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customers_wys_wys1` FOREIGN KEY (`wy_id`) REFERENCES `wys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_wys`
--

LOCK TABLES `customers_wys` WRITE;
/*!40000 ALTER TABLE `customers_wys` DISABLE KEYS */;
INSERT INTO `customers_wys` VALUES (4,1),(5,1),(1,2),(2,2),(3,2);
/*!40000 ALTER TABLE `customers_wys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_date` datetime DEFAULT NULL COMMENT '出合同录入日期',
  `customer_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `c_unitno` varchar(10) DEFAULT NULL COMMENT '房号',
  `c_htjg` varchar(20) DEFAULT NULL COMMENT '合同价格',
  `c_yhje` varchar(20) DEFAULT NULL COMMENT '优惠金额',
  `c_djje` varchar(20) DEFAULT NULL COMMENT '定金金额',
  `c_djzh` varchar(100) DEFAULT NULL COMMENT '定金帐户',
  `c_djpz` text COMMENT '定金凭证',
  `c_gmmd` text COMMENT '购买目的',
  `c_khsf` text COMMENT '客户身份',
  `c_htfn1` varchar(30) DEFAULT NULL COMMENT '合同姓名First name 1',
  `c_htln1` varchar(30) DEFAULT NULL COMMENT '合同姓名Last name 1',
  `c_htfn2` varchar(30) DEFAULT NULL COMMENT '合同姓名First name 2',
  `c_htln2` varchar(30) DEFAULT NULL COMMENT '合同姓名Last name 2',
  `c_lsh` text COMMENT '律师行',
  `c_lsxm` text COMMENT '律师姓名',
  `c_lsdh` varchar(20) DEFAULT NULL COMMENT '律师电话',
  `c_lsyx` varchar(20) DEFAULT NULL COMMENT '律师邮箱',
  `c_lsdz` varchar(100) DEFAULT NULL COMMENT '律所地址',
  `c_htsj` date DEFAULT NULL COMMENT '合同签定时间',
  `q_date` datetime DEFAULT NULL COMMENT '签合同录入时间',
  `q_htsj` date DEFAULT NULL COMMENT '合同签定时间',
  `q_10sj` date DEFAULT NULL COMMENT '10%时间',
  `q_10je` varchar(20) DEFAULT NULL COMMENT '10%金额',
  `q_10zh` varchar(100) DEFAULT NULL COMMENT '10%帐户',
  `q_10pz` text COMMENT '10%凭证',
  `j_date` datetime DEFAULT NULL COMMENT '交换合同录入时间',
  `j_htsj` date DEFAULT NULL COMMENT '合同时间',
  `j_lshh` text COMMENT '律师回函',
  `j_htsy` text COMMENT '合同首页',
  `d_date` datetime DEFAULT NULL COMMENT '贷款录入时间',
  `d_sdsj` date DEFAULT NULL COMMENT '申贷时间',
  `d_yh` text COMMENT '贷款银行',
  `d_gs` text COMMENT '贷款公司',
  `d_lxr` text COMMENT '贷款联系人',
  `d_lxrdh` varchar(20) DEFAULT NULL COMMENT '贷款联系人电话',
  `d_lxryx` varchar(100) DEFAULT NULL COMMENT '贷款联系人邮箱',
  `d_gjlxr` text COMMENT '估价联系人',
  `d_gjlxrdh` varchar(20) DEFAULT NULL COMMENT '估价联系人电话',
  `y_date` datetime DEFAULT NULL COMMENT '验房录入时间',
  `y_sj` date DEFAULT NULL COMMENT '验房时间',
  `y_lxr` text COMMENT '验房联系人',
  `y_lxrdh` varchar(20) DEFAULT NULL COMMENT '联系人电话',
  `jf_date` datetime DEFAULT NULL COMMENT '交房录入时间',
  `jf_sj` date DEFAULT NULL COMMENT '交房时间',
  `jf_lxr` text COMMENT '联系人',
  `jf_lxrdh` varchar(20) DEFAULT NULL COMMENT '联系人电话',
  `cz_date` datetime DEFAULT NULL COMMENT '出租管理录入时间',
  `cz_gs` text COMMENT '出租管理公司',
  `cz_glr` text COMMENT '出租管理联系人',
  `cz_dh` varchar(20) DEFAULT NULL COMMENT '出租管理人电话',
  `cz_yx` varchar(100) DEFAULT NULL COMMENT '管理人邮箱',
  `cz_htsj` date DEFAULT NULL COMMENT '合同时间',
  `cz_ggsj` date DEFAULT NULL COMMENT '广告时间',
  `cz_zfhtsj` date DEFAULT NULL COMMENT '租房合同时间',
  `cz_je` varchar(10) DEFAULT NULL COMMENT '出租金额',
  `cz_qx` text COMMENT '出租期限',
  `status` varchar(45) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`customer_id`,`property_id`,`employee_id`),
  KEY `fk_deals_properties1_idx` (`property_id`),
  KEY `fk_deals_customers1_idx` (`customer_id`),
  KEY `fk_deals_employees1_idx` (`employee_id`),
  CONSTRAINT `fk_deals_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_deals_employees1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_deals_properties1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deals`
--

LOCK TABLES `deals` WRITE;
/*!40000 ALTER TABLE `deals` DISABLE KEYS */;
INSERT INTO `deals` VALUES (1,'2016-03-10 03:21:58',1,1,NULL,'$11','$11','$11','11','','投资','PR/Citizen','11','11','11','11','11','11','11','11','1','2016-03-05','2016-03-10 15:03:39','2016-03-04','2016-03-06','$1111','1213','Idea.jpg','2016-03-11 01:46:41','2016-03-01','复制.jpg','','2016-03-11 01:51:47','2016-03-07','55','55','53','353','35353353','lnln','lnlnlnl','2016-03-11 01:52:14','2016-03-07','1rr1r','12411','2016-03-11 01:52:24','2016-03-08','13r1','141','2016-03-11 01:53:43','11','15135','2525','werq','2016-03-07','2016-03-06','2016-03-06','$235235','1245235','CZ',1),(2,'2016-03-10 03:29:14',3,2,NULL,'$22','$22','$2','2','','自住','PR/Citizen','2','22','2','2','11','11','11','11','1','2016-03-04',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'C',1);
/*!40000 ALTER TABLE `deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `wechat` varchar(45) DEFAULT NULL,
  `leader` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'员工1',1,'2016-02-28 14:14:15','1942-05-07','123','aa@aa.com','',1,1,2),(2,'bb',0,'2016-02-28 14:16:07','1943-10-12','1214134','adfa@agag.com','',0,0,0),(3,'员工2',0,'2016-02-28 14:23:43','1991-10-19','1214134','','',1,7,3),(4,'员工3',1,'2016-02-28 16:26:54','1947-09-17','12435326','aa@aa.com','',0,8,2),(5,'emp11',1,'2016-03-12 15:56:53','1938-04-05','1314','1515','31gsgw',0,0,2);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate_e` varchar(20) DEFAULT NULL COMMENT '员工评价',
  `rate_dk` varchar(20) DEFAULT NULL COMMENT '贷款评价',
  `rate_wy` varchar(20) DEFAULT NULL COMMENT '物业评价',
  `content` text,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`customer_id`),
  KEY `fk_feedbacks_customers1_idx` (`customer_id`),
  CONSTRAINT `fk_feedbacks_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guidances`
--

DROP TABLE IF EXISTS `guidances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guidances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`customer_id`),
  KEY `fk_guidances_customers_idx` (`customer_id`),
  CONSTRAINT `fk_guidances_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guidances`
--

LOCK TABLES `guidances` WRITE;
/*!40000 ALTER TABLE `guidances` DISABLE KEYS */;
INSERT INTO `guidances` VALUES (1,'hh工',2,4);
/*!40000 ALTER TABLE `guidances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lawyers`
--

DROP TABLE IF EXISTS `lawyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lawyers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lawyers`
--

LOCK TABLES `lawyers` WRITE;
/*!40000 ALTER TABLE `lawyers` DISABLE KEYS */;
/*!40000 ALTER TABLE `lawyers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate` text,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'about','<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:950px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg\" style=\"height:301px; width:400px\" /></td>\r\n			<td>\r\n			<p>公司名称：BGW Realty Pty. Ltd. &nbsp;澳洲创富地产有限公司</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>经营范围：房屋买卖、房屋租赁、购地建屋、项目开发、投资融资</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>服务宗旨：诚信服务，为您创富！</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>公司地址：Suite 602，Level 6，5 Hunter Street Sydney NSW 2000</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>联系电话：+61 2 8541 4108 &nbsp; +61 42108 4881</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>电子邮件：<a href=\"mailto:david@bgwrealty.com.au\">david@bgwrealty.com.au</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n'),(2,'info',NULL),(3,'contact',NULL),(4,'join','<p>澳洲创富地产公司欢迎您的加入！</p>\r\n\r\n<p>诚信服务，为您创富！</p>\r\n\r\n<p>请发送简历到：<a href=\"mailto:david@bgwrealty.com.au\">david@bgwrealty.com.au</a>&nbsp;或 电话联系：David 0421084881</p>\r\n'),(5,'电话','+61 2 8541 4108   \r\n+61 4 2108 4881'),(6,'E-mail','info@bgwrealty.com.au'),(7,'地址','Suite 602, Level 6, 5 Hunter Street Sydney NSW 2000'),(8,'新客户注册','<p>欢迎加入BGW Realty - 创富地产.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>您的用户名为: $USERNAME</p>\r\n\r\n<p>初始密码为: $PASSWORD</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>请尽快修改密码. 谢谢合作!</p>\r\n'),(9,'客户重置密码','<p>欢迎加入BGW Realty - 创富地产.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>您的用户名为: $USERNAME</p>\r\n\r\n<p>密码已重置为初始密码: $PASSWORD</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>请尽快修改密码. 谢谢合作!</p>\r\n'),(10,'新员工注册','<p>欢迎加入BGW Realty - 创富地产.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>您的用户名为: $USERNAME</p>\r\n\r\n<p>初始密码为: $PASSWORD</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>请尽快修改密码. 谢谢合作!</p>\r\n'),(11,'员工重置密码','<p>欢迎加入BGW Realty - 创富地产.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>您的用户名为: $USERNAME</p>\r\n\r\n<p>密码已重置为初始密码: $PASSWORD</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>请尽快修改密码. 谢谢合作!</p>\r\n');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工作总结',
  `name` text,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `content` text,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`employee_id`),
  KEY `plans_employees1_idx` (`employee_id`),
  CONSTRAINT `plans_employees1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'第一个月业务计划','YW-M','2016-03-06 15:20:13','没啥计划~·',1),(2,'第一个年业务计划','YW-Y','2016-03-06 15:20:36','计划一下',1);
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `address` varchar(45) DEFAULT NULL,
  `price_min` int(11) DEFAULT NULL,
  `price_max` int(11) DEFAULT NULL,
  `detail` text,
  `display` tinyint(1) DEFAULT NULL,
  `suburb_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,'楼盘1号','i dont know',300,800,'<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Idea.jpg\" style=\"height:225px; width:300px\" /></td>\r\n			<td>\r\n			<p>暴走鞋a</p>\r\n\r\n			<p>莾</p>\r\n\r\n			<p>艺术硕士adfa</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>\r\n			<p>工</p>\r\n\r\n			<p>工</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>\r\n			<p>工</p>\r\n\r\n			<p>&nbsp;a</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n',0,2),(2,'楼盘2号','i know',500,1100,'<p>a</p>\r\n\r\n<p>a</p>\r\n\r\n<p>bfa&nbsp;</p>\r\n\r\n<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" src=\"http://localhost/bgwrealty/app/webroot/img/upload/Wifi.jpg\" style=\"height:207px; width:244px\" /></td>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>fafa</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>adfadf</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>&nbsp;asdf a</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>sdfadsf</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>sadfadf</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n',0,3),(8,'楼盘3','没有',300,1200,'<p>这个楼盘好</p>\r\n',0,2);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties_ptypes`
--

DROP TABLE IF EXISTS `properties_ptypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties_ptypes` (
  `property_id` int(11) NOT NULL,
  `ptype_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`ptype_id`),
  KEY `properties_ptypes_ptypes1_idx` (`ptype_id`),
  CONSTRAINT `properties_ptypes_properties1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `properties_ptypes_ptypes1` FOREIGN KEY (`ptype_id`) REFERENCES `ptypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties_ptypes`
--

LOCK TABLES `properties_ptypes` WRITE;
/*!40000 ALTER TABLE `properties_ptypes` DISABLE KEYS */;
INSERT INTO `properties_ptypes` VALUES (1,1),(8,1),(1,2),(2,2),(8,2);
/*!40000 ALTER TABLE `properties_ptypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptypes`
--

DROP TABLE IF EXISTS `ptypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ptypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '户型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptypes`
--

LOCK TABLES `ptypes` WRITE;
/*!40000 ALTER TABLE `ptypes` DISABLE KEYS */;
INSERT INTO `ptypes` VALUES (1,'两室一厅一卫'),(2,'三室一厅一卫');
/*!40000 ALTER TABLE `ptypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suburbs`
--

DROP TABLE IF EXISTS `suburbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suburbs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suburbs`
--

LOCK TABLES `suburbs` WRITE;
/*!40000 ALTER TABLE `suburbs` DISABLE KEYS */;
INSERT INTO `suburbs` VALUES (2,'Kingsford'),(3,'Kensington');
/*!40000 ALTER TABLE `suburbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `summaries`
--

DROP TABLE IF EXISTS `summaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工作总结',
  `name` text,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `content` text,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`employee_id`),
  KEY `summaries_employees1_idx` (`employee_id`),
  CONSTRAINT `summaries_employees1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `summaries`
--

LOCK TABLES `summaries` WRITE;
/*!40000 ALTER TABLE `summaries` DISABLE KEYS */;
INSERT INTO `summaries` VALUES (1,'月业务总结第一篇','YW-M','2016-03-06 15:48:44','没有~',1);
/*!40000 ALTER TABLE `summaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (2,'团队2',2),(3,'团队3',1);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `p_default` varchar(20) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'shawnm0705@gmail.com','$2a$10$32J.EBFA1DahBpjqZ2.fOuURslwoJoX4nWK9c8HF7JKZA/DseP4te','71','leader',1,1),(3,'admin','$2a$10$b6ca.2lgJIJcicu4uuJJ/.Z7pnY3Y5Kl8RLisi6cL8C0bWKzey/qS','admin','admin',1,NULL),(4,'no1@customer.com','$2a$10$Wx/i0S23KjRe9COra3DkduyMfdqacCEgwd4q1NfLGT6hhd4NQ5jQe','5dd2b7ba','customer',1,1),(7,'yg2@bgwrealty.com.au','$2a$10$2hXwDos5oIsSWNf5PWwDhubeM2ApOU6AVKGjVtmzLOLOoqvVFnJxe','16df7c1b','leader',1,3),(8,'em3@em.com','$2a$10$s7rWsk1xzUyU2simrBL.vO56PutuVVPkhaQ6p5kXQvEBGnn4ChEnW','4825e20a','employee',1,4);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wys`
--

DROP TABLE IF EXISTS `wys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wys`
--

LOCK TABLES `wys` WRITE;
/*!40000 ALTER TABLE `wys` DISABLE KEYS */;
INSERT INTO `wys` VALUES (1,'物业1','1213214','wy@wy.com','yes','nothing'),(2,'物业2','133525','wy@wy.com','','yes\r\n');
/*!40000 ALTER TABLE `wys` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-14 10:43:29
