/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: newishop
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES
(1,0,'kompyutery'),
(2,0,'planshety'),
(3,0,'noutbuki'),
(4,3,'mac'),
(5,3,'windows'),
(6,0,'telefony'),
(7,0,'kamery');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_description`
--

DROP TABLE IF EXISTS `category_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_description` (
  `category_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`category_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_description`
--

LOCK TABLES `category_description` WRITE;
/*!40000 ALTER TABLE `category_description` DISABLE KEYS */;
INSERT INTO `category_description` VALUES
(1,1,'Компьютеры',NULL,NULL,'<p>Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей.</p>'),
(1,2,'Computers',NULL,NULL,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.</p>'),
(2,1,'Планшеты',NULL,NULL,'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.'),
(2,2,'Tablets',NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.'),
(3,1,'Ноутбуки',NULL,NULL,'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.'),
(3,2,'Notebooks',NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.'),
(4,1,'Mac',NULL,NULL,'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.'),
(4,2,'Mac',NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.'),
(5,1,'Windows',NULL,NULL,'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.'),
(5,2,'Windows',NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.'),
(6,1,'Телефоны',NULL,NULL,'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.'),
(6,2,'Phones',NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.'),
(7,1,'Камеры',NULL,NULL,'Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.'),
(7,2,'Cameras',NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla viverra accumsan metus non ullamcorper. Nunc facilisis enim et neque dapibus, at accumsan elit fermentum. Praesent quis ante arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus interdum in tellus quis auctor. In pellentesque congue lacus sed laoreet. Duis imperdiet neque id tempor dictum. Donec volutpat felis et enim consequat, vitae vestibulum turpis eleifend. Integer eget congue lacus. Sed vitae quam tempor, gravida odio in, imperdiet leo. Aenean tincidunt enim vitae sagittis fringilla.');
/*!40000 ALTER TABLE `category_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `download`
--

DROP TABLE IF EXISTS `download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download`
--

LOCK TABLES `download` WRITE;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
INSERT INTO `download` VALUES
(1,'price.zip.RNv58WWAW1mF6ly3gTPiq4gHA00tQQ2B','price.zip'),
(2,'test.txt.fdkrwrcsflytryz23423cf','test.txt'),
(5,'100.jpg615487b659028','100.jpg');
/*!40000 ALTER TABLE `download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `download_description`
--

DROP TABLE IF EXISTS `download_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `download_description` (
  `download_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`download_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download_description`
--

LOCK TABLES `download_description` WRITE;
/*!40000 ALTER TABLE `download_description` DISABLE KEYS */;
INSERT INTO `download_description` VALUES
(1,1,'Файл 1'),
(1,2,'File 1'),
(2,1,'Файл 2'),
(2,2,'File 2'),
(5,1,'Картинка'),
(5,2,'Picture');
/*!40000 ALTER TABLE `download_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `title` varchar(20) NOT NULL,
  `base` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language`
--

LOCK TABLES `language` WRITE;
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` VALUES
(1,'ru','Русский',1),
(2,'en','English',0);
/*!40000 ALTER TABLE `language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `name`
--

DROP TABLE IF EXISTS `name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `name`
--

LOCK TABLES `name` WRITE;
/*!40000 ALTER TABLE `name` DISABLE KEYS */;
INSERT INTO `name` VALUES
(1,'Иванов'),
(2,'Петров');
/*!40000 ALTER TABLE `name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_download`
--

DROP TABLE IF EXISTS `order_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `download_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_download`
--

LOCK TABLES `order_download` WRITE;
/*!40000 ALTER TABLE `order_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `price` double NOT NULL,
  `sum` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` double NOT NULL,
  `qty` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `page` (
  `id` int(10) unsigned NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES
(1,'o-magazine'),
(2,'oplata-i-dostavka'),
(3,'kontakty'),
(4,'testovaya-stranica');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_description`
--

DROP TABLE IF EXISTS `page_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_description` (
  `page_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`page_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_description`
--

LOCK TABLES `page_description` WRITE;
/*!40000 ALTER TABLE `page_description` DISABLE KEYS */;
INSERT INTO `page_description` VALUES
(1,1,'О магазине','Контент страницы О магазине',NULL,NULL),
(1,2,'About shop','Content of the About shop page',NULL,NULL),
(2,1,'Оплата и доставка','Контент страницы Оплата и доставка',NULL,NULL),
(2,2,'Payment and delivery','Content of the page Payment and delivery',NULL,NULL),
(3,1,'Контакты','Контент страницы Контакты',NULL,NULL),
(3,2,'Contact','Contact page content',NULL,NULL),
(4,1,'Тестовая страница','<p>Контент тестовой страницы…!!</p><figure class=\"image\"><img src=\"/public/uploads/images/fields.jpg\"></figure>','2','1'),
(4,2,'Test page','<p>Test page content…123</p>','4','3');
/*!40000 ALTER TABLE `page_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `old_price` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `hit` tinyint(4) NOT NULL DEFAULT 0,
  `img` varchar(255) NOT NULL DEFAULT 'uploads/no_image.jpg',
  `is_download` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES
(1,7,'canon-eos-5d',10,12,1,1,'uploads/2021/11/12/canon_eos_5d_1.jpg',0),
(2,4,'apple-cinema-30',20,0,1,1,'uploads/2021/11/12/apple_cinema_30.jpg',0),
(3,4,'imac',25,0,1,1,'uploads/2021/11/12/imac_1.jpg',0),
(4,6,'iphone',10,0,1,1,'uploads/2021/11/12/iphone_1.jpg',0),
(5,5,'cifrovoj-tovar',5,0,1,1,'uploads/2021/11/12/hp_1.jpg',1),
(6,1,'cifrovoj-tovar-2',21,0,1,0,'uploads/no_image.jpg',1),
(7,1,'kompyuter-2',22,0,1,0,'uploads/no_image.jpg',0),
(8,1,'kompyuter-3',23,0,1,1,'uploads/no_image.jpg',0),
(9,1,'kompyuter-4',24,0,1,0,'uploads/no_image.jpg',0),
(10,1,'kompyuter-5',25,0,1,0,'uploads/no_image.jpg',0),
(11,1,'kompyuter-6',26,0,1,0,'uploads/no_image.jpg',0),
(12,1,'kompyuter-7',27,0,1,0,'uploads/no_image.jpg',0),
(13,1,'kompyuter-8',28,0,1,0,'uploads/no_image.jpg',0),
(14,1,'kompyuter-9',29,0,1,0,'uploads/no_image.jpg',0),
(15,1,'kompyuter-10',30,0,1,0,'uploads/no_image.jpg',0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_description`
--

DROP TABLE IF EXISTS `product_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_description` (
  `product_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `exerpt` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_description`
--

LOCK TABLES `product_description` WRITE;
/*!40000 ALTER TABLE `product_description` DISABLE KEYS */;
INSERT INTO `product_description` VALUES
(1,1,'Canon EOS 5D','<p>Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия. По своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.</p>','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать',NULL,NULL),
(1,2,'Canon EOS 5D','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit. Ut imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.</p>','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(2,1,'Apple cinema 30\"','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать',NULL,NULL),
(2,2,'Apple cinema 30\"','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(3,1,'iMac','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать',NULL,NULL),
(3,2,'iMac','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(4,1,'iPhone','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать',NULL,NULL),
(4,2,'iPhone','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(5,1,'Цифровой товар','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать',NULL,NULL),
(5,2,'Digital product','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(6,1,'Цифровой товар 2','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(6,2,'Digital product 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(7,1,'Компьютер 2','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(7,2,'Computer 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(8,1,'Компьютер 3','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(8,2,'Computer 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(9,1,'Компьютер 4','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(9,2,'Computer 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(10,1,'Компьютер 5','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(10,2,'Computer 5','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(11,1,'Компьютер 6','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(11,2,'Computer 6','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(12,1,'Компьютер 7','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(12,2,'Computer 7','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(13,1,'Компьютер 8','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(13,2,'Computer 8','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(14,1,'Компьютер 9','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(14,2,'Computer 9','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL),
(15,1,'Компьютер 10','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.\r\nПо своей сути рыбатекст является альтернативой традиционному lorem ipsum, который вызывает у некторых людей недоумение при попытках прочитать рыбу текст. В отличии от lorem ipsum, текст рыба на русском языке наполнит любой макет непонятным смыслом и придаст неповторимый колорит советских времен.','Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать ',NULL,NULL),
(15,2,'Computer 10','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at ligula bibendum, sollicitudin mi ac, auctor urna. Nulla vulputate orci fermentum ante pretium blandit ut sed libero. Donec non feugiat turpis, et faucibus est. Vivamus lacus elit, ornare ultrices accumsan sed, pretium quis velit. Integer vel scelerisque odio. Vestibulum id dignissim urna. Fusce vitae urna vel magna dictum hendrerit in eget quam. Cras convallis metus enim, a iaculis metus scelerisque at. Vivamus vel ultricies est. Vivamus imperdiet tempor suscipit. Duis nibh sapien, feugiat a sagittis at, blandit vitae nulla. Sed rutrum vehicula fringilla. Praesent pretium elementum elit.\r\nUt imperdiet sem vel tempor molestie. Maecenas convallis tortor a tincidunt egestas. In ultrices ornare suscipit. Suspendisse consequat eu felis et mollis. Aliquam viverra gravida est, sit amet venenatis arcu porttitor a. Sed maximus placerat sapien, nec fermentum quam luctus nec. Aenean semper ultrices urna eu fermentum. Nam at leo scelerisque, fermentum leo a, egestas odio. Fusce tincidunt magna mi, non pharetra neque egestas a. Sed sagittis vel nunc sed scelerisque. Pellentesque vestibulum quam ultrices fermentum maximus. In hac habitasse platea dictumst. Cras sit amet ornare mi, at efficitur libero. Morbi venenatis sapien a euismod finibus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit',NULL,NULL);
/*!40000 ALTER TABLE `product_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_download`
--

DROP TABLE IF EXISTS `product_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_download` (
  `product_id` int(10) unsigned NOT NULL,
  `download_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_download`
--

LOCK TABLES `product_download` WRITE;
/*!40000 ALTER TABLE `product_download` DISABLE KEYS */;
INSERT INTO `product_download` VALUES
(5,1),
(6,2);
/*!40000 ALTER TABLE `product_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_gallery`
--

DROP TABLE IF EXISTS `product_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_gallery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_gallery`
--

LOCK TABLES `product_gallery` WRITE;
/*!40000 ALTER TABLE `product_gallery` DISABLE KEYS */;
INSERT INTO `product_gallery` VALUES
(1,2,'/uploads/images/1.jpg'),
(2,2,'/uploads/images/2.jpg');
/*!40000 ALTER TABLE `product_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES
(1,'/uploads/slider/1.jpg'),
(2,'/uploads/slider/2.jpg'),
(3,'/uploads/slider/3.jpg');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'example@mail.com','$2y$12$Be79H1KiuAqDxbFrr3F5ZuF47xNkA.sHeOl4gO4sGxIGU2cw/AxQC','John','smith st.','user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-05-18 12:53:35
