-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1:3306	Database: easyadmin_v6
-- ------------------------------------------------------
-- Server version 	5.7.26-log
-- Date: Mon, 26 May 2025 14:17:59 +0800

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `queue_jobs`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queue_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '队列名称',
  `payload` longtext COLLATE utf8mb4_unicode_ci COMMENT '队列数据',
  `attempts` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '重试次数',
  `reserved` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '保留状态',
  `reserved_at` bigint(20) unsigned DEFAULT '0' COMMENT '保留时间',
  `available_at` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '可用时间',
  `created_at` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='队列数据';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queue_jobs`
--

LOCK TABLES `queue_jobs` WRITE;
/*!40000 ALTER TABLE `queue_jobs` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `queue_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `queue_jobs` with 0 row(s)
--

--
-- Table structure for table `system_dict_data`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_dict_data` (
  `dataId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dictId` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '字典ID',
  `label` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字典标签',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '字典数据',
  `style` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典样式',
  `isDefault` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '是否默认：1-是，2-否',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '字典备注',
  `status` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '字典状态：1-启用，2-禁用',
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '字典排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`dataId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统字典数据表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_dict_data`
--

LOCK TABLES `system_dict_data` WRITE;
/*!40000 ALTER TABLE `system_dict_data` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_dict_data` VALUES (1,1,'热门','hot','red',2,'热门新闻标签',1,100,'2025-05-26 14:03:13','2025-05-26 14:06:26'),(2,2,'铂金','pt','bule',2,'铂金等级',1,100,'2025-05-26 14:17:09','2025-05-26 14:17:09');
/*!40000 ALTER TABLE `system_dict_data` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_dict_data` with 2 row(s)
--

--
-- Table structure for table `system_dict_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_dict_type` (
  `dictId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典名称',
  `identify` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典标识',
  `status` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '字典状态：1-启用，2-禁用',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '字典备注',
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '字典排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`dictId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统字典表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_dict_type`
--

LOCK TABLES `system_dict_type` WRITE;
/*!40000 ALTER TABLE `system_dict_type` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_dict_type` VALUES (1,'新闻标签','newsTag',1,'新闻标签',100,'2025-05-26 11:32:00','2025-05-26 14:06:45'),(2,'用户等级','userLevel',1,'用户等级',100,'2025-05-26 14:08:47','2025-05-26 14:08:47');
/*!40000 ALTER TABLE `system_dict_type` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_dict_type` with 2 row(s)
--

--
-- Table structure for table `system_login_log`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_login_log` (
  `logId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `managerId` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `description` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述信息',
  `loginIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` bigint(20) unsigned NOT NULL DEFAULT '1' COMMENT '登录状态：1-登录成功，2-登录失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`logId`),
  KEY `manager_id` (`managerId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统登录日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_login_log`
--

LOCK TABLES `system_login_log` WRITE;
/*!40000 ALTER TABLE `system_login_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_login_log` VALUES (1,1,'登录成功','127.0.0.1',1,'2025-05-25 18:12:05','2025-05-25 18:12:05'),(2,1,'登录成功','127.0.0.1',1,'2025-05-26 11:05:20','2025-05-26 11:05:20');
/*!40000 ALTER TABLE `system_login_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_login_log` with 2 row(s)
--

--
-- Table structure for table `system_manager`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_manager` (
  `managerId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `roleId` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员头像',
  `realName` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员姓名',
  `account` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员账号',
  `password` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员密码',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '管理员状态：1-正常，2-禁用，3-锁定',
  `isDelete` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '是否删除：1-是，2-否',
  `loginError` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '失败次数',
  `loginTime` datetime DEFAULT NULL COMMENT '登录时间',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`managerId`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_manager`
--

LOCK TABLES `system_manager` WRITE;
/*!40000 ALTER TABLE `system_manager` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_manager` VALUES (1,1,'/upload/image/20231024/47220acdd326647e029949627e49b197.jpg','黎明','admin','21232f297a57a5a743894a0e4a801fc3',1,2,0,'2025-05-26 11:05:20','2022-11-06 14:29:39','2025-05-26 11:05:20'),(10,6,'/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg','测试管理员','test','098f6bcd4621d373cade4e832627b4f6',1,2,0,'2025-05-15 21:19:25','2022-11-06 14:29:39','2025-05-15 21:19:25');
/*!40000 ALTER TABLE `system_manager` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_manager` with 2 row(s)
--

--
-- Table structure for table `system_manager_role`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_manager_role` (
  `roleId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `identify` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色标识',
  `permission` text COLLATE utf8mb4_unicode_ci COMMENT '菜单权限',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色备注',
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色排序',
  `isDelete` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '是否删除：1-是，2-否',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_manager_role`
--

LOCK TABLES `system_manager_role` WRITE;
/*!40000 ALTER TABLE `system_manager_role` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_manager_role` VALUES (1,'超级管理员','super','75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149','拥有最高权限',10,2,'2022-11-06 14:28:28','2025-05-26 13:50:48'),(5,'普通管理员','common','75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149','普通权限',20,2,'2022-11-06 14:28:28','2025-05-15 21:17:31'),(6,'部门管理员','department','75,128,141,72,73,81,85,86,74,82,83,84','部门管理员',30,2,'2022-11-06 14:28:28','2025-05-15 21:17:35');
/*!40000 ALTER TABLE `system_manager_role` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_manager_role` with 3 row(s)
--

--
-- Table structure for table `system_menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_menu` (
  `menuId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parentId` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `module` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单模块',
  `controller` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单控制器',
  `action` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单操作',
  `params` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求参数',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '菜单类型：1-菜单，2-按钮，3-外链',
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '打开方式：1-默认方式，2-当前窗口，3-新窗口',
  `record` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '日志记录：1-开启，2-关闭',
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_menu`
--

LOCK TABLES `system_menu` WRITE;
/*!40000 ALTER TABLE `system_menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_menu` VALUES (1,0,'系统日志','fa-cogs','','','','',1,'',1,2,20010,'2022-11-06 14:28:59','2025-05-25 19:18:38'),(2,99,'设置添加','fa-cog','admin','SystemSetting','create','',2,'',1,1,10,'2022-11-06 14:28:59','2025-05-15 20:42:32'),(69,145,'菜单管理','fa-bars','admin','SystemMenu','index','',1,'',1,2,30,'2022-11-06 14:28:59','2025-05-26 11:13:36'),(72,0,'权限管理','fa-users','','','','',1,'',1,2,20000,'2022-11-06 14:28:59','2025-05-25 19:18:35'),(73,72,'管理员','fa-user','admin','SystemManager','index','',1,'',1,2,10,'2022-11-06 14:28:59','2025-05-25 19:18:57'),(74,72,'角色管理','fa-user-plus','admin','SystemManagerRole','index','',1,'',1,2,10,'2022-11-06 14:28:59','2025-05-25 19:19:07'),(75,0,'系统主页','fa-home','admin','SystemIndex','index','',1,'',1,2,10,'2022-11-06 14:28:59','2025-05-25 19:17:46'),(76,69,'菜单添加','fa-link','admin','SystemMenu','create','',2,'',1,1,10,'2022-11-06 14:28:59','2023-10-24 13:49:44'),(79,69,'菜单删除','fa-link','admin','SystemMenu','delete','',2,'',1,1,30,'2022-11-06 14:28:59','2023-10-24 13:49:45'),(80,69,'菜单修改','fa-link','admin','SystemMenu','update','',2,'',1,1,20,'2022-11-06 14:28:59','2023-10-24 13:49:48'),(81,73,'管理员添加','fa-link','admin','SystemManager','create','',2,'',1,1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(82,74,'角色添加','fa-link','admin','SystemManagerRole','create','',2,'',1,1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(83,74,'角色修改','fa-link','admin','SystemManagerRole','update','',2,'',1,1,20,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(84,74,'角色删除','fa-link','admin','SystemManagerRole','delete','',2,'',1,1,30,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(85,73,'管理员修改','fa-link','admin','SystemManager','update','',2,'',1,1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(86,73,'管理员删除','fa-link','admin','SystemManager','delete','',2,'',1,1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(99,145,'系统设置','fa-cog','admin','SystemSetting','index','',1,'',1,2,10,'2022-11-06 14:28:59','2025-05-25 19:20:26'),(114,1,'操作日志','fa-book','admin','SystemOperLog','index','',1,'',1,2,30,'2022-11-06 14:28:59','2025-05-25 19:19:16'),(121,114,'日志详情','fa-link','admin','SystemOperLog','detail','',2,'',1,2,10,'2022-11-06 14:28:59','2025-05-25 19:19:31'),(122,114,'日志清空','fa-link','admin','SystemOperLog','clear','',2,'',1,1,20,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(128,75,'控制台','fa-dashboard','admin','SystemIndex','console','',1,'',1,2,10,'2022-11-06 14:28:59','2025-05-25 19:18:50'),(134,69,'菜单排序','fa-link','admin','SystemMenu','sort','',2,'',1,1,100,'2022-11-06 14:28:59','2023-10-24 13:49:50'),(136,137,'系统信息','fa-link','admin','SystemIndex','system','',2,'',1,2,100,'2022-11-06 14:28:59','2025-05-25 19:27:56'),(137,157,'其他菜单','fa-link','admin','','','',2,'',1,1,100000,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(138,137,'个人资料','fa-link','admin','SystemIndex','profile','',2,'',1,1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(141,75,'UI组件','fa-pie-chart','admin','SystemIndex','components','',1,'',1,2,100,'2022-11-06 14:28:59','2025-05-25 19:18:53'),(142,69,'全部菜单','fa-link','admin','SystemMenu','getAll','',2,'',1,2,100,'2022-11-06 14:28:59','2025-05-25 19:20:45'),(143,157,'公共权限','fa-link','admin','','','',2,'',1,2,10000,'2022-11-06 14:28:59','2025-05-25 19:30:33'),(144,143,'文本编辑','fa-link','admin','SystemEditor','ueditor','',2,'',1,2,100,'2022-11-06 14:28:59','2025-05-25 19:30:03'),(145,0,'运维管理','fa-server','','','','',1,'',1,2,20020,'2022-11-06 14:28:59','2025-05-26 11:08:33'),(147,143,'全部角色','fa-link','admin','SystemManagerRole','getAll','',2,'',1,1,100,'2023-03-15 14:17:55','2023-10-24 10:34:03'),(148,137,'头像上传','fa-link','admin','SystemManager','avatar','',2,'',1,2,100,'2023-03-20 15:11:09','2025-05-25 19:29:31'),(149,137,'退出登录','fa-link','admin','SystemIndex','logout','',2,'',1,2,100,'2023-03-21 10:46:54','2025-05-25 19:29:45'),(150,1,'登录日志','fa-file-text','admin','SystemLoginLog','index','',1,'',1,2,100,'2023-03-21 11:55:24','2025-05-25 19:19:22'),(151,150,'日志详情','fa-link','admin','SystemLoginLog','detail','',2,'',1,2,100,'2023-03-21 12:01:11','2025-05-25 19:19:41'),(152,150,'日志清空','fa-link','admin','SystemLoginLog','clear','',2,'',1,1,100,'2023-03-21 12:01:22','2023-10-24 10:34:03'),(153,157,'文件上传','fa-link','admin','','','',2,'',1,2,100,'2023-03-21 14:32:33','2025-05-25 19:27:23'),(154,153,'图片上传','fa-link','admin','SystemUpload','image','',2,'',1,2,100,'2023-03-21 14:32:51','2025-05-25 19:30:17'),(155,153,'文件上传','fa-link','admin','SystemUpload','file','',2,'',1,2,100,'2023-03-21 14:33:00','2025-05-25 19:30:23'),(156,153,'文件检测','fa-link','admin','SystemUpload','check','',2,'',1,2,100,'2023-03-21 14:33:07','2025-05-25 19:30:27'),(157,0,'系统菜单','fa-bars','','','','',2,'',1,2,90000,'2023-10-24 10:10:06','2025-05-25 19:37:45'),(158,153,'切片上传','fa-link','admin','SystemUpload','slice','',2,'',1,2,100,'2024-03-28 15:44:57','2025-05-25 19:30:37'),(159,99,'设置修改','fa-link','admin','SystemSetting','update','',2,'',1,1,100,'2025-05-15 20:42:48','2025-05-15 20:42:48'),(160,99,'设置删除','fa-link','admin','SystemSetting','delete','',2,'',1,1,100,'2025-05-15 20:42:55','2025-05-15 20:42:55'),(161,145,'字典管理','fa-book','admin','SystemDictType','index','',1,'',1,2,20,'2025-05-25 19:33:28','2025-05-26 11:09:03'),(162,161,'字典添加','fa-link','admin','SystemDictType','create','',2,'',1,1,100,'2025-05-25 19:33:39','2025-05-26 11:10:28'),(163,161,'字典修改','fa-link','admin','SystemDictType','update','',2,'',1,1,100,'2025-05-25 19:33:48','2025-05-26 11:32:37'),(164,161,'字典删除','fa-link','admin','SystemDictType','delete','',2,'',1,1,100,'2025-05-26 11:10:17','2025-05-26 11:10:17'),(165,161,'字典数据','fa-link','admin','SystemDictData','index','',2,'',1,2,100,'2025-05-26 11:11:00','2025-05-26 11:11:00'),(166,165,'数据添加','fa-link','admin','SystemDictData','create','',2,'',1,1,100,'2025-05-26 11:11:20','2025-05-26 11:11:20'),(167,165,'数据修改','fa-link','admin','SystemDictData','update','',2,'',1,1,100,'2025-05-26 11:11:27','2025-05-26 11:11:27'),(168,165,'数据删除','fa-link','admin','SystemDictData','delete','',2,'',1,1,100,'2025-05-26 11:11:34','2025-05-26 11:11:34');
/*!40000 ALTER TABLE `system_menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_menu` with 52 row(s)
--

--
-- Table structure for table `system_oper_log`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_oper_log` (
  `logId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `menuId` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `managerId` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '操作描述',
  `requestIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求IP',
  `requestUrl` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `params` longtext COLLATE utf8mb4_unicode_ci COMMENT '请求参数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '操作状态：1-操作成功，2-操作失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`logId`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_oper_log`
--

LOCK TABLES `system_oper_log` WRITE;
/*!40000 ALTER TABLE `system_oper_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_oper_log` VALUES (118,122,1,'清空成功','127.0.0.1','/admin/SystemOperLog/clear.html','[]',1,'2025-05-25 14:20:49','2025-05-25 14:20:49'),(119,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:13:38','2025-05-25 19:13:38'),(120,99,1,'获取成功','127.0.0.1','/admin/SystemSetting/index.html?page=1&limit=15','[]',1,'2025-05-25 19:13:39','2025-05-25 19:13:39'),(121,150,1,'获取成功','127.0.0.1','/admin/SystemLoginLog/index.html?page=1&limit=15','[]',1,'2025-05-25 19:13:41','2025-05-25 19:13:41'),(122,114,1,'获取成功','127.0.0.1','/admin/SystemOperLog/index.html?page=1&limit=15','[]',1,'2025-05-25 19:13:41','2025-05-25 19:13:41'),(123,114,1,'获取成功','127.0.0.1','/admin/SystemOperLog/index.html?page=1&limit=15','[]',1,'2025-05-25 19:14:05','2025-05-25 19:14:05'),(124,150,1,'获取成功','127.0.0.1','/admin/SystemLoginLog/index.html?page=1&limit=15','[]',1,'2025-05-25 19:14:05','2025-05-25 19:14:05'),(125,114,1,'获取成功','127.0.0.1','/admin/SystemOperLog/index.html?page=1&limit=15','[]',1,'2025-05-25 19:14:06','2025-05-25 19:14:06'),(126,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:14:49','2025-05-25 19:14:49'),(127,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:16:28','2025-05-25 19:16:28'),(128,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:16:30','2025-05-25 19:16:30'),(129,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"系统主页\",\"icon\":\"fa-home\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"75\"}',1,'2025-05-25 19:16:33','2025-05-25 19:16:33'),(130,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:16:34','2025-05-25 19:16:34'),(131,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:16:35','2025-05-25 19:16:35'),(132,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:17:44','2025-05-25 19:17:44'),(133,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"系统主页\",\"icon\":\"fa-home\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"75\"}',1,'2025-05-25 19:17:46','2025-05-25 19:17:46'),(134,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:17:47','2025-05-25 19:17:47'),(135,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:17:48','2025-05-25 19:17:48'),(136,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:17:53','2025-05-25 19:17:53'),(137,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:31','2025-05-25 19:18:31'),(138,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:34','2025-05-25 19:18:34'),(139,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"权限管理\",\"icon\":\"fa-users\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20000\",\"menuId\":\"72\"}',1,'2025-05-25 19:18:35','2025-05-25 19:18:35'),(140,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:36','2025-05-25 19:18:36'),(141,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:37','2025-05-25 19:18:37'),(142,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"系统日志\",\"icon\":\"fa-cogs\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20010\",\"menuId\":\"1\"}',1,'2025-05-25 19:18:38','2025-05-25 19:18:38'),(143,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:39','2025-05-25 19:18:39'),(144,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:41','2025-05-25 19:18:41'),(145,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"运维管理\",\"icon\":\"fa-server\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20020\",\"menuId\":\"145\"}',1,'2025-05-25 19:18:42','2025-05-25 19:18:42'),(146,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:43','2025-05-25 19:18:43'),(147,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:44','2025-05-25 19:18:44'),(148,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"系统菜单\",\"icon\":\"fa-bars\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20020\",\"menuId\":\"157\"}',1,'2025-05-25 19:18:45','2025-05-25 19:18:45'),(149,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:45','2025-05-25 19:18:45'),(150,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:49','2025-05-25 19:18:49'),(151,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"75\",\"name\":\"控制台\",\"icon\":\"fa-dashboard\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"console\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"128\"}',1,'2025-05-25 19:18:50','2025-05-25 19:18:50'),(152,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:50','2025-05-25 19:18:50'),(153,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:52','2025-05-25 19:18:52'),(154,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"75\",\"name\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"components\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"141\"}',1,'2025-05-25 19:18:53','2025-05-25 19:18:53'),(155,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:54','2025-05-25 19:18:54'),(156,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:56','2025-05-25 19:18:56'),(157,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"72\",\"name\":\"管理员\",\"icon\":\"fa-user\",\"module\":\"admin\",\"controller\":\"SystemManager\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"73\"}',1,'2025-05-25 19:18:57','2025-05-25 19:18:57'),(158,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:18:58','2025-05-25 19:18:58'),(159,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:18:59','2025-05-25 19:18:59'),(160,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:19:06','2025-05-25 19:19:06'),(161,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"72\",\"name\":\"角色管理\",\"icon\":\"fa-user-plus\",\"module\":\"admin\",\"controller\":\"SystemManagerRole\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"74\"}',1,'2025-05-25 19:19:07','2025-05-25 19:19:07'),(162,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:19:08','2025-05-25 19:19:08'),(163,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:19:14','2025-05-25 19:19:14'),(164,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"1\",\"name\":\"操作日志\",\"icon\":\"fa-book\",\"module\":\"admin\",\"controller\":\"SystemOperLog\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"30\",\"menuId\":\"114\"}',1,'2025-05-25 19:19:16','2025-05-25 19:19:16'),(165,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:19:17','2025-05-25 19:19:17'),(166,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:19:22','2025-05-25 19:19:22'),(167,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"1\",\"name\":\"登录日志\",\"icon\":\"fa-file-text\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"150\"}',1,'2025-05-25 19:19:22','2025-05-25 19:19:22'),(168,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:19:23','2025-05-25 19:19:23'),(169,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:19:30','2025-05-25 19:19:30'),(170,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"114\",\"name\":\"日志详情\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemOperLog\",\"action\":\"detail\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"121\"}',1,'2025-05-25 19:19:31','2025-05-25 19:19:31'),(171,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:19:33','2025-05-25 19:19:33'),(172,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:19:40','2025-05-25 19:19:40'),(173,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"150\",\"name\":\"日志详情\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"detail\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"151\"}',1,'2025-05-25 19:19:41','2025-05-25 19:19:41'),(174,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:19:44','2025-05-25 19:19:44'),(175,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:20:07','2025-05-25 19:20:07'),(176,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:20:24','2025-05-25 19:20:24'),(177,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"145\",\"name\":\"系统设置\",\"icon\":\"fa-cog\",\"module\":\"admin\",\"controller\":\"SystemSetting\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"99\"}',1,'2025-05-25 19:20:26','2025-05-25 19:20:26'),(178,69,1,'获取成功','127.0.0.1','/admin/SystemMenu/index.html','[]',1,'2025-05-25 19:20:27','2025-05-25 19:20:27'),(179,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:20:36','2025-05-25 19:20:36'),(180,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"145\",\"name\":\"菜单设置\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"SystemMenu\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20\",\"menuId\":\"69\"}',1,'2025-05-25 19:20:38','2025-05-25 19:20:38'),(181,142,1,'获取成功','127.0.0.1','/admin/SystemMenu/getAll.html','[]',1,'2025-05-25 19:20:45','2025-05-25 19:20:45'),(182,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"69\",\"name\":\"全部菜单\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemMenu\",\"action\":\"getAll\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"142\"}',1,'2025-05-25 19:20:45','2025-05-25 19:20:45'),(183,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"157\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"153\"}',1,'2025-05-25 19:27:23','2025-05-25 19:27:23'),(184,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"137\",\"name\":\"系统信息\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"system\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"136\"}',1,'2025-05-25 19:27:56','2025-05-25 19:27:56'),(185,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"137\",\"name\":\"头像上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemManager\",\"action\":\"avatar\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"148\"}',1,'2025-05-25 19:29:32','2025-05-25 19:29:32'),(186,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"137\",\"name\":\"退出登录\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"logout\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"149\"}',1,'2025-05-25 19:29:45','2025-05-25 19:29:45'),(187,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"143\",\"name\":\"文本编辑\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemEditor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"144\"}',1,'2025-05-25 19:30:03','2025-05-25 19:30:03'),(188,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"153\",\"name\":\"图片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"image\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"154\"}',1,'2025-05-25 19:30:17','2025-05-25 19:30:17'),(189,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"153\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"file\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"155\"}',1,'2025-05-25 19:30:23','2025-05-25 19:30:23'),(190,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"153\",\"name\":\"文件检测\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"check\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"156\"}',1,'2025-05-25 19:30:27','2025-05-25 19:30:27'),(191,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"157\",\"name\":\"公共权限\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10000\",\"menuId\":\"143\"}',1,'2025-05-25 19:30:33','2025-05-25 19:30:33'),(192,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"153\",\"name\":\"切片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"slice\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"158\"}',1,'2025-05-25 19:30:37','2025-05-25 19:30:37'),(193,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"0\",\"name\":\"字典管理\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-25 19:33:28','2025-05-25 19:33:28'),(194,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"161\",\"name\":\"字典类型\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-25 19:33:39','2025-05-25 19:33:39'),(195,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-25 19:33:48','2025-05-25 19:33:48'),(196,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"字典管理\",\"icon\":\"fa-book\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"161\"}',1,'2025-05-25 19:36:35','2025-05-25 19:36:35'),(197,83,1,'修改成功','127.0.0.1','/admin/SystemManagerRole/update.html','{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,161,162,163,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}',1,'2025-05-25 19:36:42','2025-05-25 19:36:42'),(198,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"menuId\":\"161\",\"sort\":\"20020\"}',1,'2025-05-25 19:37:05','2025-05-25 19:37:05'),(199,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"menuId\":\"157\",\"sort\":\"90000\"}',1,'2025-05-25 19:37:45','2025-05-25 19:37:45'),(200,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"menuId\":\"145\",\"sort\":\"20030\"}',1,'2025-05-25 19:37:55','2025-05-25 19:37:55'),(201,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-book-open\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}',1,'2025-05-25 19:38:25','2025-05-25 19:38:25'),(202,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典类型\",\"icon\":\"fa-folder-open\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}',1,'2025-05-25 19:39:28','2025-05-25 19:39:28'),(203,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典类型\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}',1,'2025-05-25 19:40:04','2025-05-25 19:40:04'),(204,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-book-open\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}',1,'2025-05-25 19:40:14','2025-05-25 19:40:14'),(205,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 11:05:25','2025-05-26 11:05:25'),(206,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 11:05:34','2025-05-26 11:05:34'),(207,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 11:06:08','2025-05-26 11:06:08'),(208,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"145\",\"name\":\"字典管理\",\"icon\":\"fa-book\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20020\",\"menuId\":\"161\"}',1,'2025-05-26 11:08:24','2025-05-26 11:08:24'),(209,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"menuId\":\"145\",\"sort\":\"20020\"}',1,'2025-05-26 11:08:33','2025-05-26 11:08:33'),(210,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"menuId\":\"69\",\"sort\":\"30\"}',1,'2025-05-26 11:08:43','2025-05-26 11:08:43'),(211,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"menuId\":\"161\",\"sort\":\"20\"}',1,'2025-05-26 11:08:46','2025-05-26 11:08:46'),(212,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"145\",\"name\":\"字典管理\",\"icon\":\"fa-book\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20\",\"menuId\":\"161\"}',1,'2025-05-26 11:09:03','2025-05-26 11:09:03'),(213,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典添加\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}',1,'2025-05-26 11:09:27','2025-05-26 11:09:27'),(214,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典修改\",\"icon\":\"fa-book-open\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}',1,'2025-05-26 11:09:39','2025-05-26 11:09:39'),(215,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典添加\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}',1,'2025-05-26 11:09:43','2025-05-26 11:09:43'),(216,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"161\",\"name\":\"字典删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-26 11:10:17','2025-05-26 11:10:17'),(217,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}',1,'2025-05-26 11:10:25','2025-05-26 11:10:25'),(218,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}',1,'2025-05-26 11:10:28','2025-05-26 11:10:28'),(219,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-26 11:11:00','2025-05-26 11:11:00'),(220,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"165\",\"name\":\"数据添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-26 11:11:20','2025-05-26 11:11:20'),(221,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"165\",\"name\":\"数据修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-26 11:11:27','2025-05-26 11:11:27'),(222,76,1,'添加成功','127.0.0.1','/admin/SystemMenu/create.html','{\"parentId\":\"165\",\"name\":\"数据删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2025-05-26 11:11:34','2025-05-26 11:11:34'),(223,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"145\",\"name\":\"菜单管理\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"SystemMenu\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"30\",\"menuId\":\"69\"}',1,'2025-05-26 11:13:36','2025-05-26 11:13:36'),(224,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 11:27:52','2025-05-26 11:27:52'),(225,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 11:27:55','2025-05-26 11:27:55'),(226,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 11:28:00','2025-05-26 11:28:00'),(227,162,1,'添加成功','127.0.0.1','/admin/SystemDictType/create.html','{\"name\":\"新闻类型\",\"identify\":\"newsType\",\"remark\":\"\",\"sort\":\"100\",\"status\":\"1\"}',1,'2025-05-26 11:32:00','2025-05-26 11:32:00'),(228,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"161\",\"name\":\"字典修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}',1,'2025-05-26 11:32:37','2025-05-26 11:32:37'),(229,163,1,'修改成功','127.0.0.1','/admin/SystemDictType/update.html','{\"name\":\"新闻类型\",\"identify\":\"newsType\",\"remark\":\"测试\\n111\",\"sort\":\"100\",\"status\":\"1\",\"dictId\":\"1\"}',1,'2025-05-26 11:35:44','2025-05-26 11:35:44'),(230,164,1,'账号未授权访问','127.0.0.1','/admin/SystemDictType/delete.html','{\"dictId\":\"1\"}',2,'2025-05-26 11:39:10','2025-05-26 11:39:10'),(231,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 13:38:47','2025-05-26 13:38:47'),(232,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 13:38:59','2025-05-26 13:38:59'),(233,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 13:39:01','2025-05-26 13:39:01'),(234,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 13:46:41','2025-05-26 13:46:41'),(235,147,1,'获取成功','127.0.0.1','/admin/SystemManagerRole/getAll.html','[]',1,'2025-05-26 13:46:45','2025-05-26 13:46:45'),(236,83,1,'修改成功','127.0.0.1','/admin/SystemManagerRole/update.html','{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}',1,'2025-05-26 13:50:48','2025-05-26 13:50:48'),(237,166,1,'添加成功','127.0.0.1','/admin/SystemDictData/create.html','{\"label\":\"热门\",\"value\":\"hot\",\"style\":\"red\",\"isDefault\":\"2\",\"remark\":\"\",\"sort\":\"100\",\"status\":\"1\"}',1,'2025-05-26 14:03:13','2025-05-26 14:03:13'),(238,167,1,'修改成功','127.0.0.1','/admin/SystemDictData/update.html','{\"label\":\"热门\",\"value\":\"hot\",\"style\":\"red\",\"isDefault\":\"2\",\"remark\":\"热门新闻标签\",\"sort\":\"100\",\"status\":\"1\",\"dataId\":\"1\"}',1,'2025-05-26 14:06:26','2025-05-26 14:06:26'),(239,163,1,'修改成功','127.0.0.1','/admin/SystemDictType/update.html','{\"name\":\"新闻标签\",\"identify\":\"newsTag\",\"remark\":\"新闻标签\",\"sort\":\"100\",\"status\":\"1\",\"dictId\":\"1\"}',1,'2025-05-26 14:06:45','2025-05-26 14:06:45'),(240,162,1,'添加成功','127.0.0.1','/admin/SystemDictType/create.html','{\"name\":\"用户等级\",\"identify\":\"userLevel\",\"remark\":\"用户等级\",\"sort\":\"100\",\"status\":\"1\"}',1,'2025-05-26 14:08:47','2025-05-26 14:08:47'),(241,166,1,'添加成功','127.0.0.1','/admin/SystemDictData/create.html','{\"label\":\"铂金\",\"value\":\"pt\",\"style\":\"bule\",\"isDefault\":\"2\",\"remark\":\"铂金等级\",\"sort\":\"100\",\"status\":\"1\",\"dictId\":\"2\"}',1,'2025-05-26 14:17:09','2025-05-26 14:17:09');
/*!40000 ALTER TABLE `system_oper_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_oper_log` with 124 row(s)
--

--
-- Table structure for table `system_setting`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_setting` (
  `settingId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设置分类',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设置名称',
  `identify` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设置标识',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '设置数据',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '设置备注',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '设置排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`settingId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统设置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_setting`
--

LOCK TABLES `system_setting` WRITE;
/*!40000 ALTER TABLE `system_setting` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_setting` VALUES (1,'system','系统名称','name','EasyAdmin','系统LOGO展示文字',10,'2023-10-24 10:33:41','2025-05-15 21:14:30'),(2,'system','系统名称','slogan','PHP后台快速开发系统','系统登录页面展示标语',20,'2023-10-24 10:33:41','2025-05-15 21:14:41');
/*!40000 ALTER TABLE `system_setting` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_setting` with 2 row(s)
--

--
-- Table structure for table `system_upload`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_upload` (
  `fileId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `md5` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件MD5',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名称',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `ext` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件后缀',
  `path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '保存位置',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`fileId`),
  UNIQUE KEY `md5` (`md5`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文件上传表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_upload`
--

LOCK TABLES `system_upload` WRITE;
/*!40000 ALTER TABLE `system_upload` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_upload` VALUES (2,'8ddf582f610c68b1729111fd86d05ec1','1.jpg',329748,'jpg','/upload/image/20231024/47220acdd326647e029949627e49b197.jpg','2023-10-24 10:00:52','2023-10-24 10:00:52'),(3,'628eebd9a0247ae4e336dcf3423eed05','6.jpg',113905,'jpg','/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg','2023-10-24 10:07:44','2023-10-24 10:07:44'),(4,'ecacf72ba64171c4f64cea6e0c2e1be4','1.jpg',277066,'jpg','/upload/image/20231218/6ad96658aae1eef280fd761e0ba61ae2.jpg','2023-12-18 14:55:14','2023-12-18 14:55:14'),(6,'87ba150e7f8083c33572b20770357881','1.png',3310,'png','/upload/image/20240408/aa6762ebf6f902a578e66c9693816d43.png','2024-04-08 16:58:55','2024-04-08 16:58:55'),(7,'11b86e1b496a5c31ec8082d71338ef88','1.png',3310,'png','/upload/image/20240408/e6ebed780447aac2213763e6391f0af6.png','2024-04-08 16:59:03','2024-04-08 16:59:03'),(8,'3a94908f444c3bec293d3bb1a5bf405c','1.png',3310,'png','/upload/image/20240408/f50c1dca9f4cd382fe2f2cbc77eacac0.png','2024-04-08 16:59:21','2024-04-08 16:59:21'),(9,'53bc98803ccb09a81df4d1299853efaa','1.png',3309,'png','/upload/image/20240408/f2d9385a1f6bdba45f818528302d33f5.png','2024-04-08 16:59:27','2024-04-08 16:59:27'),(10,'c9731c0cb436807306a1209b2c7d949c','1.png',3311,'png','/upload/image/20240408/0581b8c9f22d29d7740244ba2112be5d.png','2024-04-08 17:00:01','2024-04-08 17:00:01'),(11,'4a196dd60d34111bbc69eac68af125ec','2.jpg',224779,'jpg','/upload/image/20240408/ef6a893e72e33f7c5742032c582d5c81.jpg','2024-04-08 17:00:19','2024-04-08 17:00:19'),(12,'0c88d36ef4909652bdb12ef9b4b325a7','5.2abb0bf1.mp4',970263,'mp4','/upload/video/20240408/edcfe3f3084fe1cc76c3df9144b0a56c.mp4','2024-04-08 17:03:38','2024-04-08 17:03:38'),(13,'74337e48216f38be269a170264dabda5','test.mp3',3856713,'mp3','/upload/audio/20240408/59bf95117cd614dbf94b3498adf5133f.mp3','2024-04-08 17:09:56','2024-04-08 17:09:56'),(15,'80c2c41f3a2799654cda00b82db30638','2fc7d7ee5554e8f4e83abde52ab4021.jpg',2094067,'jpg','/upload/image/20240409/17f4673180f6bb655deebd941dc4e755.jpg','2024-04-09 11:54:49','2024-04-09 11:54:49'),(16,'26ae9bea6b90e2285fda78d4fe256610','test.zip',8179364,'zip','/upload/file/20240409/26ae9bea6b90e2285fda78d4fe256610.zip','2024-04-09 14:09:29','2024-04-09 14:09:29'),(17,'396814d705b2ceb75f487e5c63e9c6c4','1.png',6034,'png','/upload/image/20240410/f582520d44d7ae0ceb798fb588ab3428.png','2024-04-10 09:45:37','2024-04-10 09:45:37'),(18,'9853d6db42392f5bedd2b7fa8a396c4f','1.png',3310,'png','/upload/image/20240410/7d1aaeb4627793f5366c84fa8f0adf8a.png','2024-04-10 09:46:43','2024-04-10 09:46:43'),(19,'e86a52d02371d3bf825bf3db722ad38e','1 - 副本.jpg',4635,'jpg','/upload/image/20241204/62c9d1282e947b95755e87a8ddf96f81.jpg','2024-12-04 08:41:47','2024-12-04 08:41:47'),(20,'05a6f21f1064c45b2b9f5cfaf541144e','2.jpg',229185,'jpg','/upload/image/20241207/6034b8c05a93cf3a3d1cba314517fdae.jpg','2024-12-07 14:53:29','2024-12-07 14:53:29'),(21,'7e5b1b87da3ad9581672260eae458d9e','23.9MB.zip',24543864,'zip','/upload/file/20241207/7e5b1b87da3ad9581672260eae458d9e.zip','2024-12-07 17:11:30','2024-12-07 17:11:30'),(22,'76dfea2fe52c6eaceb3471cf17f24dcd','4.04MB.mp4',4241470,'mp4','/upload/video/20241207/9849a2caa4b7c968c73391e5052cba88.mp4','2024-12-07 17:19:57','2024-12-07 17:19:57');
/*!40000 ALTER TABLE `system_upload` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_upload` with 19 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 26 May 2025 14:17:59 +0800
