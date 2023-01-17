-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1:3306	Database: easyadmin
-- ------------------------------------------------------
-- Server version 	5.7.26
-- Date: Tue, 17 Jan 2023 10:28:31 +0800

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
-- Table structure for table `easy_log`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `manager_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `menu` varchar(64) NOT NULL DEFAULT '' COMMENT '请求菜单',
  `description` varchar(256) NOT NULL DEFAULT '' COMMENT '请求描述',
  `url` varchar(256) NOT NULL DEFAULT '' COMMENT '请求地址',
  `params` longtext COMMENT '请求参数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '请求状态：1-成功，2-失败',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb4 COMMENT='系统日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_log`
--

LOCK TABLES `easy_log` WRITE;
/*!40000 ALTER TABLE `easy_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_log` VALUES (187,1,'日志清空','系统自动记录：清空成功','/admin/log/clear.html','[]',1,'2022-11-06 14:32:01','2023-01-17 09:58:42'),(188,1,'系统设置','系统自动记录：修改成功','/admin/setting/system.html','{\"name\":\"EASYADMIN\",\"slogan\":\"PHP后台快速开发系统\"}',1,'2023-01-17 10:03:14','2023-01-17 10:03:14'),(189,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','{\"id\":\"137\",\"parent_id\":\"143\",\"title\":\"系统菜单\",\"icon\":\"fa-shield\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100000\"}',1,'2023-01-17 10:26:24','2023-01-17 10:26:24'),(190,1,'菜单添加','系统自动记录：添加成功','/admin/menu/create.html','{\"parent_id\":\"143\",\"title\":\"公共权限\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2023-01-17 10:26:46','2023-01-17 10:26:46'),(191,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','{\"id\":\"144\",\"parent_id\":\"146\",\"title\":\"百度编辑器\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Editor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2023-01-17 10:26:53','2023-01-17 10:26:53'),(192,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','{\"id\":\"137\",\"parent_id\":\"143\",\"title\":\"系统菜单\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100000\"}',1,'2023-01-17 10:27:03','2023-01-17 10:27:03'),(193,1,'菜单添加','系统自动记录：添加成功','/admin/menu/create.html','{\"parent_id\":\"146\",\"title\":\"退出登录\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Index\",\"action\":\"logout\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2023-01-17 10:27:41','2023-01-17 10:27:41'),(194,1,'菜单添加','系统自动记录：添加成功','/admin/menu/create.html','{\"parent_id\":\"146\",\"title\":\"清除缓存\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Index\",\"action\":\"clear_cache\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2023-01-17 10:27:57','2023-01-17 10:27:57');
/*!40000 ALTER TABLE `easy_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_log` with 8 row(s)
--

--
-- Table structure for table `easy_manager`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户组',
  `avatar` varchar(256) NOT NULL DEFAULT '' COMMENT '头像',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `is_system` tinyint(1) NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1-正常，2-禁用',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='管理员';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_manager`
--

LOCK TABLES `easy_manager` WRITE;
/*!40000 ALTER TABLE `easy_manager` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_manager` VALUES (1,1,'/uploads/images/20220227/024757163b86acf4fe41710642fd1d54.jpg','黎明','admin','21232f297a57a5a743894a0e4a801fc3',1,1,'2022-11-06 14:29:39','2022-11-06 14:29:39'),(10,1,'/uploads/images/20220227/047f8122f2040b206ba8ee713e6c235d.jpg','测试管理员','test','098f6bcd4621d373cade4e832627b4f6',2,1,'2022-11-06 14:29:39','2022-11-06 14:29:39');
/*!40000 ALTER TABLE `easy_manager` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_manager` with 2 row(s)
--

--
-- Table structure for table `easy_menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(64) NOT NULL DEFAULT '' COMMENT '图标',
  `module` varchar(65) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(64) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(64) NOT NULL DEFAULT '' COMMENT '操作',
  `params` varchar(256) NOT NULL DEFAULT '' COMMENT '请求参数',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '菜单类型：1-菜单，2-按钮，3-外链',
  `link` varchar(256) NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` tinyint(1) NOT NULL DEFAULT '1' COMMENT '打开方式：1-默认方式，2-当前窗口，3-新窗口',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COMMENT='系统节点';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_menu`
--

LOCK TABLES `easy_menu` WRITE;
/*!40000 ALTER TABLE `easy_menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_menu` VALUES (1,64,'系统管理','fa-cogs','admin','','','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 09:59:13'),(2,1,'系统设置','fa-cog','admin','Setting','system','',1,'',1,0,'2022-11-06 14:28:59','2023-01-17 10:13:20'),(64,0,'系统模块','fa fa-fw fa-cogs','admin','','','',1,'',1,20,'2022-11-06 14:28:59','2023-01-17 09:59:13'),(69,145,'菜单设置','fa-bars','admin','Menu','index','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:13:17'),(72,64,'权限管理','fa-users','admin','','','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 09:59:13'),(73,72,'管理员','fa-user','admin','Manager','index','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:13:13'),(74,72,'角色管理','fa-user-plus','admin','Role','index','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:13:09'),(75,0,'系统主页','fa-home','admin','Index','index','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:13:07'),(76,69,'菜单添加','fa-link','admin','Menu','create','',2,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:13:03'),(79,69,'菜单删除','fa-link','admin','Menu','delete','',2,'',1,30,'2022-11-06 14:28:59','2023-01-17 10:13:00'),(80,69,'菜单修改','fa-link','admin','Menu','update','',2,'',1,20,'2022-11-06 14:28:59','2023-01-17 10:12:58'),(81,73,'管理员添加','fa-link','admin','Manager','create','',2,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:12:54'),(82,74,'角色添加','fa-link','admin','Role','create','',2,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:12:51'),(83,74,'角色修改','fa-link','admin','Role','update','',2,'',1,20,'2022-11-06 14:28:59','2023-01-17 10:12:47'),(84,74,'角色删除','fa-link','admin','Role','delete','',2,'',1,30,'2022-11-06 14:28:59','2023-01-17 10:12:43'),(85,73,'管理员修改','fa-link','admin','Manager','update','',2,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:12:39'),(86,73,'管理员删除','fa-link','admin','Manager','delete','',2,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:12:36'),(99,75,'门户统计','fa-bar-chart','admin','Home','dashboard','',1,'https://www.baidu.com/',1,20,'2022-11-06 14:28:59','2023-01-17 10:12:32'),(114,1,'系统日志','fa-book','admin','Log','index','',1,'',1,30,'2022-11-06 14:28:59','2023-01-17 10:12:30'),(121,114,'日志详情','fa-link','admin','Log','detail','',2,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:12:26'),(122,114,'日志清空','fa-link','admin','Log','clear','',2,'',1,20,'2022-11-06 14:28:59','2023-01-17 10:12:23'),(128,75,'控制台','fa-dashboard','admin','Home','console','',1,'',1,10,'2022-11-06 14:28:59','2023-01-17 10:12:20'),(134,69,'菜单排序','fa-link','admin','Menu','sort','',2,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:12:17'),(136,137,'系统信息','fa-link','admin','Index','system','',2,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:12:13'),(137,143,'系统菜单','fa-link','admin','','','',2,'',1,100000,'2022-11-06 14:28:59','2023-01-17 10:27:03'),(138,137,'个人资料','fa-link','admin','Index','profile','',2,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:12:05'),(139,72,'部门管理','fa-archive','admin','Department','index','',1,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:12:01'),(140,139,'部门添加','fa-link','admin','Department','create','',2,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:11:58'),(141,75,'UI组件','fa-pie-chart','admin','Home','components','',1,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:11:52'),(142,69,'全部菜单','fa-link','admin','Menu','get_all','',2,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:11:49'),(143,0,'公共权限','fa-folder-open','admin','','','',2,'',1,10000,'2022-11-06 14:28:59','2023-01-17 09:59:13'),(144,146,'百度编辑器','fa-link','admin','Editor','ueditor','',2,'',1,100,'2022-11-06 14:28:59','2023-01-17 10:26:53'),(145,64,'运维管理','fa-server','admin','','','',1,'',1,100,'2022-11-06 14:28:59','2023-01-17 09:59:13'),(146,143,'公共权限','fa-link','admin','','','',2,'',1,100,'2023-01-17 10:26:46','2023-01-17 10:26:46'),(147,146,'退出登录','fa-link','admin','Index','logout','',2,'',1,100,'2023-01-17 10:27:41','2023-01-17 10:27:41'),(148,146,'清除缓存','fa-link','admin','Index','clear_cache','',2,'',1,100,'2023-01-17 10:27:57','2023-01-17 10:27:57');
/*!40000 ALTER TABLE `easy_menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_menu` with 36 row(s)
--

--
-- Table structure for table `easy_permission`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_permission`
--

LOCK TABLES `easy_permission` WRITE;
/*!40000 ALTER TABLE `easy_permission` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_permission` VALUES (1,1,128),(2,1,99),(3,1,75),(4,1,2),(5,1,76),(6,1,80),(7,1,79),(8,1,134),(9,1,69),(10,1,121),(11,1,122),(12,1,114),(13,1,1),(14,1,81),(15,1,85),(16,1,86),(17,1,73),(18,1,82),(19,1,83),(20,1,84),(21,1,74),(22,1,72),(23,1,64),(24,5,128),(26,5,75),(27,1,136),(28,1,138),(29,1,137),(34,5,99),(35,5,136),(36,5,138),(37,5,137),(38,6,128),(39,6,99),(40,6,136),(41,6,75),(42,6,2),(43,6,76),(44,6,80),(45,6,79),(46,6,134),(47,6,69),(48,6,121),(49,6,122),(50,6,114),(51,6,1),(52,6,81),(53,6,85),(54,6,86),(55,6,73),(56,6,82),(57,6,83),(58,6,84),(59,6,74),(60,6,72),(61,6,64),(62,6,138),(63,6,137),(65,1,141),(66,1,142),(67,1,139),(68,1,140),(69,1,143),(70,1,144),(71,1,145);
/*!40000 ALTER TABLE `easy_permission` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_permission` with 65 row(s)
--

--
-- Table structure for table `easy_role`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色标识',
  `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '备注',
  `is_super` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否超级权限，1-启用，2-禁用',
  `is_system` tinyint(1) NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='角色';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_role`
--

LOCK TABLES `easy_role` WRITE;
/*!40000 ALTER TABLE `easy_role` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_role` VALUES (1,'超级管理员','super','拥有最高权限',1,1,'2022-11-06 14:28:28','2022-11-06 14:28:28'),(5,'普通管理员','common','普通权限',2,2,'2022-11-06 14:28:28','2022-11-06 14:28:28'),(6,'部门管理员','department','部门管理员',2,2,'2022-11-06 14:28:28','2022-11-06 14:28:28');
/*!40000 ALTER TABLE `easy_role` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_role` with 3 row(s)
--

--
-- Table structure for table `easy_setting_system`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_setting_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '系统名称',
  `slogan` varchar(64) NOT NULL DEFAULT '' COMMENT '系统标语',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='系统配置';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_setting_system`
--

LOCK TABLES `easy_setting_system` WRITE;
/*!40000 ALTER TABLE `easy_setting_system` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_setting_system` VALUES (1,'EASYADMIN','PHP后台快速开发系统','2023-01-17 10:00:19','2023-01-17 10:00:19');
/*!40000 ALTER TABLE `easy_setting_system` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_setting_system` with 1 row(s)
--

--
-- Table structure for table `easy_upload`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件MD5',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '文件名称',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `suffix` varchar(4) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `path` varchar(128) NOT NULL DEFAULT '' COMMENT '保存位置',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `md5` (`md5`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_upload`
--

LOCK TABLES `easy_upload` WRITE;
/*!40000 ALTER TABLE `easy_upload` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_upload` VALUES (17,'7408603c72203747e0f6720f87aaec5b','test_db-master.zip',36688498,'zip','/uploads/bigfile/20220604/7408603c72203747e0f6720f87aaec5b.zip','2022-11-06 14:27:35','2023-01-17 10:00:39');
/*!40000 ALTER TABLE `easy_upload` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_upload` with 1 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Tue, 17 Jan 2023 10:28:31 +0800
