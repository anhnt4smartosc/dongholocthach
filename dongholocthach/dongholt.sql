-- MySQL dump 10.13  Distrib 5.5.36, for Win32 (x86)
--
-- Host: localhost    Database: dongholocthach_db
-- ------------------------------------------------------
-- Server version	5.5.36

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
-- Table structure for table `basic_pages`
--

DROP TABLE IF EXISTS `basic_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basic_pages` (
  `basic_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `basic_page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `basic_page_index` int(11) NOT NULL DEFAULT '0',
  `basic_page_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`basic_page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basic_pages`
--

LOCK TABLES `basic_pages` WRITE;
/*!40000 ALTER TABLE `basic_pages` DISABLE KEYS */;
INSERT INTO `basic_pages` VALUES (2,'<p>Được th&agrave;nh lập từ năm 2003 đến nay, Phụ t&ugrave;ng Ho&agrave;ng Gia đ&atilde; c&oacute; bề d&agrave;y lịch sử ph&acirc;n phối phụ t&ugrave;ng xe m&aacute;y ch&iacute;nh h&atilde;ng đ&aacute;p ứng nhu cầu đa dạng mua bu&ocirc;n, mua lẻ của kh&aacute;ch h&agrave;ng gần xa.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Tầm nh&igrave;n của Phụ t&ugrave;ng Ho&agrave;ng Gia:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&ldquo; Kh&ocirc;ng ngừng n&acirc;ng cao chất lượng phục vụ v&agrave; nguồn h&agrave;ng ch&iacute;nh h&atilde;ng chất lượng cao, gi&aacute; th&agrave;nh cạnh tranh đi đ&ocirc;i với hệ thống cửa h&agrave;ng b&aacute;n lẻ lắp đặt phụ t&ugrave;ng miễn ph&iacute;, nhằm mang đến cho kh&aacute;ch h&agrave;ng sự an to&agrave;n, tiện lợi v&agrave; tiết kiệm&rdquo;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Triết l&yacute; kinh doanh:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&ldquo;Hướng đến sự h&agrave;i h&ograve;a v&agrave; tăng trưởng bền vững trong kinh doanh đi đ&ocirc;i với việc li&ecirc;n tục bồi dưỡng tr&igrave;nh độ, đ&agrave;o tạo tay nghề v&agrave; chăm lo đời sống cho c&aacute;c c&aacute;n bộ c&ocirc;ng nh&acirc;n vi&ecirc;n&rdquo;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r <p><img src=\"http://phutunghoanggia.vn/images/stories/1-pano copy-001.jpg\"  /></p>\r\n\r\n<p><strong>Hệ thống cửa h&agrave;ng:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Số 7 Đo&agrave;n Trần Nghiệp - Hai B&agrave; Trưng - H&agrave; Nội</p>\r\n\r\n<p>Tel: 04.3974.9389</p>\r\n\r <p>Email:&nbsp;<a href=\"mailto:phutunghoanggia@gmail.com\" >phutunghoanggia@gmail.com</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Số 116 Đường Kim Giang - Thanh Liệt - H&agrave; Nội</p>\r\n\r\n<p>Tel: 0904.128.108</p>\r\n\r\n<p>Hotline: 0983.297.252</p>',1,'Giới thiệu'),(3,'<p>Kim chỉ nam của ch&uacute;ng t&ocirc;i:&nbsp;<strong><span >&ldquo;Uy t&iacute;n l&agrave; v&agrave;ng &ndash; kh&aacute;ch h&agrave;ng l&agrave; thượng đế&rdquo;</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r <p>Tất cả phụ t&ugrave;ng mua tại&nbsp;<a href=\"http://www.phutunghoanggia.vn/\" >www.phutunghoanggia.vn</a>&nbsp;đều được bảo h&agrave;nh theo chế độ bảo h&agrave;nh đặc biệt sau:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Chế độ bảo h&agrave;nh k&eacute;p: bảo h&agrave;nh của h&atilde;ng v&agrave; bảo h&agrave;nh của cửa h&agrave;ng</p>\r\n\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mỗi sản phẩm c&oacute; thời gian bảo h&agrave;nh kh&aacute;c nhau từ 6 th&aacute;ng &ndash; 12 th&aacute;ng v&agrave; được ghi chi tiết tr&ecirc;n từng sản phẩm</p>\r\n\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Chế độ lắp đặt v&agrave; thay thế miễn ph&iacute; tại hệ thống cửa h&agrave;ng.</p>\r\n\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&aacute;c sản phẩm đ&atilde; mua c&oacute; thể đổi 1:1 trong v&ograve;ng 24h.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Phương thức giao h&agrave;ng:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i nhận giao h&agrave;ng đi 63 tỉnh th&agrave;nh cả nước qua đường Bưu điện v&agrave; Chuyển ph&aacute;t nhanh.</p>\r\n\r\n<p>Giao h&agrave;ng miễn ph&iacute; tại nội th&agrave;nh H&agrave; Nội trong ng&agrave;y.</p>\r\n\r\n<p>Giao h&agrave;ng tại c&aacute;c tỉnh th&agrave;nh kh&aacute;c: &nbsp;tối đa 2 ng&agrave;y đối với tỉnh miền Bắc v&agrave; 5 ng&agrave;y đối với tỉnh miền Nam.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lựa chọn phương thức giao dịch:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>Phương thức 1</u>: Kh&aacute;ch h&agrave;ng mua h&agrave;ng online</p>\r\n\r\n<p>&nbsp;</p>\r\n\r <p>Bước 1: Lựa chọn sản phẩm v&agrave;o giỏ h&agrave;ng &nbsp;tại&nbsp;<a href=\"http://www.phutunghoanggia.vn/\" >www.phutunghoanggia.vn</a></p>\r\n\r\n<p>Bước 2: Đăng nhập (đối với KH cũ) hoặc điền đầy đủ phần th&ocirc;ng tin kh&aacute;ch h&agrave;ng.</p>\r\n\r\n<p>Bước 3: Lựa chọn h&igrave;nh thức thanh to&aacute;n</p>\r\n\r\n<p>Bước 4: Thanh to&aacute;n. Nh&acirc;n vi&ecirc;n ch&uacute;ng t&ocirc;i sẽ li&ecirc;n lạc với bạn.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>Phương thức 2</u>: Kh&aacute;ch h&agrave;ng mua h&agrave;ng qua điện thoại</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bước 1: Gọi điện để đặt h&agrave;ng: chủng loại, số lượng</p>\r\n\r\n<p>Bước 2: lựa chọn h&igrave;nh thức thanh to&aacute;n</p>\r\n\r\n<p>Nếu ở tỉnh: Chuyển khoản qua ATM, internet Banking</p>\r\n\r\n<p>Nếu ở H&agrave; Nội: Thanh to&aacute;n khi giao h&agrave;ng</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u>Phương thức 3</u>: Kh&aacute;ch h&agrave;ng đến mua h&agrave;ng trực tiếp tại cửa h&agrave;ng</p>',0,'Dịch vụ'),(4,'<p><br />\r\nGoogle Maps Generator by RegioHelden</p>',2,'Liên lạc');
/*!40000 ALTER TABLE `basic_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `brand_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (19,'Ogival',''),(20,'Polo-Gold',''),(21,'Olympia','Olympia\r\n'),(23,'Casio','');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_index` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name_UNIQUE` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `index_table`
--

DROP TABLE IF EXISTS `index_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `index_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `page_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `index_table`
--

LOCK TABLES `index_table` WRITE;
/*!40000 ALTER TABLE `index_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `index_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci,
  `product_price` float NOT NULL DEFAULT '0',
  `product_sale` int(11) DEFAULT NULL,
  `product_create_date` datetime NOT NULL,
  `product_sale_date_start` datetime DEFAULT NULL,
  `product_sale_date_end` datetime DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `product_main_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default-product.png',
  `product_views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name_UNIQUE` (`product_name`),
  KEY `fk_products_brand_idx` (`brand_id`),
  CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (71,'OLYMPIA_1 lịch kim rốn , vành ly vàng _58021M-216','',3150000,10,'2014-08-25 08:13:36','2014-08-20 00:00:00','2014-08-31 00:00:00',21,'1408947216.JPG',20),(72,'OLYMPIA_1 lịch kim rốn ,tròn trắng_58030M-216','',2950000,5,'2014-08-25 19:10:47','2014-08-20 00:00:00','2014-08-30 00:00:00',21,'1408947525.JPG',81),(73,'OLYMPIA_2 khoang lich, tròn trắng_66021-03M-647','',2450000,10,'2014-08-25 08:19:44','2014-08-20 00:00:00','2014-08-28 00:00:00',21,'1408947584.JPG',11);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_info`
--

DROP TABLE IF EXISTS `site_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_info` (
  `site_info_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`site_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_info`
--

LOCK TABLES `site_info` WRITE;
/*!40000 ALTER TABLE `site_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` int(2) NOT NULL,
  `user_fullName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_gender` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin1234','abcd1234@A.',1,'Nguyễn Tuấn Anh','anhnt01682@yahoo.com','0','1231231231',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-30  7:23:17
