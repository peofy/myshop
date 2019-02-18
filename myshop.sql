-- MySQL dump 10.13  Distrib 5.7.11, for Win32 (AMD64)
--
-- Host: localhost    Database: myshop
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tel` char(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'周叶','13678901234','北京市昌平区北京大道666号(北京财经大学)'),(2,'小李子','18978901234','广东省广州市白云区白云山上'),(3,'小胖子','19278901234','上海市普陀区普陀寺');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `typeid` int(11) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `store` int(10) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `sales` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL,
  `descr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (16,'Apple iPhone X',19,'201901255c4abe92e38ce9353.jpg',105,6299.00,16,0,'Apple','Apple iPhone X (A1865) 64GB 深空灰色 移动联通电信4G手机\r\n【Apple年货节，限量抢券，券后6099元】选购iPhone+HomePod套装立省232元！\r\n选移动，享大流量，不换号购机！'),(17,'Apple iPhone 8',19,'201901255c4abed6a15b72762.jpg',109,3998.00,12,0,'Apple','Apple iPhone 8 (A1863) 64GB 深空灰色 移动联通电信4G手机'),(18,'Apple iPhone XS Max',19,'201901255c4abf2e625fa9756.jpg',116,10999.00,5,0,'Apple','￥10999.00\r\nApple iPhone XS Max (A2104) 256GB 深空灰色 移动联通电信4G手机 双卡双待 【抢券立减700元！】6.5英寸视网膜全面屏，面容ID，支持双卡！限量抢iPhoneXSMax低至8299！\r\n'),(19,'Apple iPhone XR',19,'201901255c4abf6ea04e54274.jpg',101,6199.00,20,0,'Apple','￥5999.00\r\nApple iPhone XR (A2108) 128GB 黑色 移动联通电信4G手机 双卡双待 【抢券立减400元！】6.1英寸视网膜全面屏，无线充电，支持双卡。iPhoneXR抢券低至5399元！\r\n'),(20,'荣耀8X',17,'201901255c4abfab0bfab8808.jpg',101,1399.00,20,0,'华为','￥1399.00\r\n荣耀8X 千元屏霸 91%屏占比 2000万AI双摄 4GB+64GB 幻夜黑 移动联通电信4G全面屏手机 双卡双待 以旧换新享补贴！麒麟710！2000万AI双摄！荣耀爆品特惠，选品质，购荣耀~\r\n'),(21,'荣耀10',17,'201901255c4ac0141cd3d7854.jpg',95,2599.00,26,0,'华为','￥2199.00\r\n荣耀10 GT游戏加速 AIS手持夜景 6GB+64GB 幻影蓝全网通 移动联通电信4G 双卡双待 游戏手机 限时优惠2199，领券立减200，成交价1999！以旧换新享补贴！荣耀10GT，游戏加速！荣耀爆品特惠，选品质，购荣耀~\r\n二手有售104万+条评价'),(22,' 荣耀10青春版',17,'201901255c4ac0462edc56269.jpg',102,1399.00,19,0,'华为','荣耀10青春版 幻彩渐变 2400万AI自拍 全网通版4GB+64GB 渐变蓝 移动联通电信4G全面屏手机 双卡双待 领券立减100，成交价1299！以旧换新享补贴！荣耀新品，朱正廷同款手机！荣耀爆品特惠，选品质，购荣耀~\r\n13万+条评价'),(23,'华为 HUAWEI Mate 20 ',17,'201901255c4ac07073cf78613.jpg',114,4288.00,7,0,'华为','华为 HUAWEI Mate 20 麒麟980AI智能芯片全面屏超微距影像超大广角徕卡三摄6GB+128GB亮黑色全网通版双4G手机 【6期免息】7nm麒麟980智能芯片，大广角徕卡三摄，高屏占比，长续航京东华为年货节，货好价优，购机首选，详情猛戳》\r\n17万+条评价'),(25,'狄派',25,'201901255c4b03661a25e7502.jpg',113,2399.00,8,0,'狄派','狄派 4G独显/吃鸡台式机电脑酷睿i5-8400六核/i7办公游戏DIY组装电脑主机四核台式整机全套 电脑主机+显示器 套餐二（四核+120G固态+4G独显） 【全国联保 365天上门服务】16G内存 4G独显 吃鸡神器》》查看更多\r\n2.3万+条评价'),(26,'Apple iPad',25,'201901255c4b03a130b3a170.jpg',118,3349.00,3,0,'Apple','【领券立减】Apple iPad 平板电脑 2018年新款9.7英寸（128G WLAN版/A10 芯片/Retina显示屏/Touch ID MRJP2CH/A）金色 此商品将于2019-01-28,00点结束闪购特卖，Apple品牌专场\r\n二手有售84万+条评价'),(27,'Apple iPad',29,'201901255c4b03dc67ba63006.jpg',38,5288.00,5,0,'Apple','【领券立减】Apple iPad 平板电脑 2018年新款9.7英寸（128G WLAN版/A10 芯片/Retina显示屏/Touch ID MR7K2CH/A）银色 此商品将于2019-01-28,00点结束闪购特卖，Apple品牌专场\r\n二手有售84万+条评价'),(28,'联想ThinkPad 翼480',25,'201901255c4b040cba30a4282.jpg',116,1221.00,5,0,'Lenovo','联想ThinkPad 翼480（0VCD）英特尔8代酷睿14英寸轻薄窄边框笔记本电脑（i5-8250U 8G 128GSSD+500G 2G独显） 【鸿运当头】年货节盛宴，口红电源火热上市（支持多种设备快充），电脑最高支持12期免息~~年货节主会场~~~~\r\n二手有售7.6万+条评价');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_info`
--

DROP TABLE IF EXISTS `order_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned NOT NULL,
  `gname` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `gnum` int(11) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_info`
--

LOCK TABLES `order_info` WRITE;
/*!40000 ALTER TABLE `order_info` DISABLE KEYS */;
INSERT INTO `order_info` VALUES (43,57,20,'荣耀8X',1399.00,1,'201901255c4abfab0bfab8808.jpg'),(44,57,18,'Apple iPhone XS Max',10999.00,1,'201901255c4abf2e625fa9756.jpg'),(45,57,22,' 荣耀10青春版',1399.00,1,'201901255c4ac0462edc56269.jpg'),(46,57,19,'Apple iPhone XR',6199.00,1,'201901255c4abf6ea04e54274.jpg'),(47,58,21,'荣耀10',2599.00,1,'201901255c4ac0141cd3d7854.jpg'),(48,58,17,'Apple iPhone 8',3998.00,1,'201901255c4abed6a15b72762.jpg'),(49,58,25,'狄派',2399.00,1,'201901255c4b03661a25e7502.jpg'),(50,58,18,'Apple iPhone XS Max',10999.00,1,'201901255c4abf2e625fa9756.jpg'),(51,58,27,'Apple iPad',5288.00,1,'201901255c4b03dc67ba63006.jpg'),(52,59,16,'Apple iPhone X',6299.00,1,'201901255c4abe92e38ce9353.jpg'),(53,60,16,'Apple iPhone X',6299.00,1,'201901255c4abe92e38ce9353.jpg'),(54,60,16,'Apple iPhone X',6299.00,1,'201901255c4abe92e38ce9353.jpg'),(55,60,22,' 荣耀10青春版',1399.00,1,'201901255c4ac0462edc56269.jpg'),(56,61,23,'华为 HUAWEI Mate 20 ',4288.00,3,'201901255c4ac07073cf78613.jpg'),(57,62,16,'Apple iPhone X',6299.00,2,'201901255c4abe92e38ce9353.jpg'),(58,63,23,'华为 HUAWEI Mate 20 ',4288.00,1,'201901255c4ac07073cf78613.jpg'),(59,64,20,'荣耀8X',1399.00,2,'201901255c4abfab0bfab8808.jpg'),(60,64,23,'华为 HUAWEI Mate 20 ',4288.00,1,'201901255c4ac07073cf78613.jpg'),(61,65,16,'Apple iPhone X',6299.00,5,'201901255c4abe92e38ce9353.jpg');
/*!40000 ALTER TABLE `order_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` char(11) NOT NULL,
  `code` char(6) NOT NULL DEFAULT '0',
  `total` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (57,1,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',19996.00,0),(58,1,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',25283.00,0),(59,1,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',6299.00,0),(60,32,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',7698.00,0),(61,32,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',12864.00,0),(62,32,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',12598.00,0),(63,32,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',4288.00,0),(64,38,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',7086.00,4),(65,39,'周叶','北京市昌平区北京大道666号(北京财经大学)','13678901234','000000',31495.00,0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `display` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (2,'手机 / 数码',0,'0,',0),(3,'电脑 / 办公',0,'0,',0),(4,'家居 / 厨具',0,'0,',0),(5,'服装/ 内衣',0,'0,',0),(6,'汽车 / 汽车用品',0,'0,',0),(7,'母婴 / 玩具乐器',0,'0,',0),(8,'食品 / 酒 / 生鲜 ',0,'0,',0),(9,'图书 / 音像',0,'0,',0),(10,'礼品鲜花 ',0,'0,',0),(11,'美妆个护 / 宠物',0,'0,',0),(17,'华为',2,'0,2,',0),(18,'小米',2,'0,2,',0),(19,'苹果',2,'0,2,',0),(20,'魅族',2,'0,2,',0),(21,'三星',2,'0,2,',0),(22,'OPPO',2,'0,2,',0),(23,'ViVo',2,'0,2,',0),(24,'锤子',2,'0,2,',0),(25,'电脑整机',3,'0,3,',0),(26,'电脑配件',3,'0,3,',0),(27,'外设产品',3,'0,3,',0),(28,'游戏设备',3,'0,3,',0),(29,'网络产品',3,'0,3,',0),(30,'办公设备',3,'0,3,',0),(31,'文具耗材',3,'0,3,',0),(32,'厨具',4,'0,4,',0),(33,'家纺',4,'0,4,',0),(34,'灯具',4,'0,4,',0),(35,'家装主材',4,'0,4,',0),(36,'厨房卫浴',4,'0,4,',0),(37,'五金电工',4,'0,4,',0),(38,'女装',5,'0,5,',0),(39,'男装',5,'0,5,',0),(40,'内衣',5,'0,5,',0),(41,'配饰',5,'0,5,',0),(42,'童装',5,'0,5,',0),(43,'童鞋',5,'0,5,',0),(44,'面部护肤',11,'0,11,',0),(45,'洗发护发',11,'0,11,',0),(46,'身体护理',11,'0,11,',0),(47,'口腔护理',11,'0,11,',0),(48,'女性护理',11,'0,11,',0),(49,'香水彩妆',11,'0,11,',0),(50,'清洁用品',11,'0,11,',0),(51,'宠物生活',11,'0,11,',0),(52,'宝马',6,'0,6,',0),(53,'奔驰',6,'0,6,',0),(54,'沃尔沃',6,'0,6,',0),(55,'红旗',6,'0,6,',0),(56,'奥迪',6,'0,6,',0),(57,'凯迪拉克',6,'0,6,',0),(58,'斯柯达',6,'0,6,',0),(59,'吉利',6,'0,6,',0),(60,'比亚迪',6,'0,6,',0),(61,'奶粉',7,'0,7,',0),(62,'营养辅食',7,'0,7,',0),(63,'尿裤湿巾',7,'0,7,',0),(64,'喂养用品',7,'0,7,',0),(65,'妈妈专区',7,'0,7,',0),(66,'乐器',7,'0,7,',0),(67,'玩具',7,'0,7,',0),(68,'新鲜水果',8,'0,8,',0),(69,'蔬菜蛋品',8,'0,8,',0),(70,'精选肉类',8,'0,8,',0),(71,'海鲜水产',8,'0,8,',0),(72,'冷饮冻食',8,'0,8,',0),(73,'中外名酒',8,'0,8,',0),(74,'进口食品',8,'0,8,',0),(75,'茗茶',8,'0,8,',0),(76,'少儿读物',9,'0,9,',0),(77,'教育',9,'0,9,',0),(78,'文艺',9,'0,9,',0),(79,'经管励志',9,'0,9,',0),(80,'人文社科',9,'0,9,',0),(81,'生活',9,'0,9,',0),(82,'科技',9,'0,9,',0),(83,'礼品',10,'0,10,',0),(84,'种子',10,'0,10,',0),(87,'绿植园艺',10,'0,10,',0);
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',3,0,0),(32,'iPhone','e10adc3949ba59abbe56e057f20f883e',0,0,1548980793),(37,'李','e10adc3949ba59abbe56e057f20f883e',0,0,1548992596),(38,'1@12.com','e10adc3949ba59abbe56e057f20f883e',0,0,1548992932),(39,'abc@1.com','e10adc3949ba59abbe56e057f20f883e',0,0,1548993085);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `zname` varchar(255) NOT NULL,
  `age` tinyint(32) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `mobile` char(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `marry` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (37,1,'张三',12,0,'13678902344','广东',0,'201902015c5393e3af103695.jpg'),(38,32,'张三',121,0,'13678902344','广东',0,'201902015c53c0344dcc59344.jpg'),(39,37,'张三3',12,0,'13678902344','广东',0,'201902015c53c065120ea1176.jpg'),(40,39,'张三',121,0,'13678902344','广东',0,'201902015c53c268618694866.jpg');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-18 20:03:12
