-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1:3306	Database: easyadmin_v6
-- ------------------------------------------------------
-- Server version 	5.7.26
-- Date: Sun, 11 May 2025 18:00:05 +0800

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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统登录日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_login_log`
--

LOCK TABLES `system_login_log` WRITE;
/*!40000 ALTER TABLE `system_login_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_login_log` VALUES (54,1,'登录成功','192.168.124.24',1,'2024-04-10 09:19:45','2024-04-10 09:19:45'),(55,1,'登录成功','192.168.124.24',1,'2024-05-16 10:04:41','2024-05-16 10:04:41'),(56,1,'登录成功','192.168.124.24',1,'2024-05-16 10:04:54','2024-05-16 10:04:54'),(57,1,'登录成功','192.168.124.24',1,'2024-05-16 10:20:45','2024-05-16 10:20:45'),(58,1,'登录成功','192.168.124.24',1,'2024-06-19 14:25:11','2024-06-19 14:25:11'),(59,1,'登录成功','192.168.124.24',1,'2024-06-24 13:55:25','2024-06-24 13:55:25'),(60,1,'登录成功','192.168.124.24',1,'2024-06-24 14:12:40','2024-06-24 14:12:40'),(61,1,'登录成功','192.168.124.24',1,'2024-06-24 14:12:49','2024-06-24 14:12:49'),(62,1,'登录成功','192.168.124.24',1,'2024-06-24 14:13:08','2024-06-24 14:13:08'),(63,1,'登录成功','192.168.124.24',1,'2024-06-24 14:13:19','2024-06-24 14:13:19'),(64,1,'登录成功','192.168.124.24',1,'2024-06-24 14:13:24','2024-06-24 14:13:24'),(65,1,'登录成功','192.168.124.24',1,'2024-06-24 15:05:17','2024-06-24 15:05:17'),(66,1,'登录成功','192.168.124.24',1,'2024-06-25 10:12:43','2024-06-25 10:12:43'),(67,1,'登录成功','192.168.124.24',1,'2024-07-26 14:11:09','2024-07-26 14:11:09'),(68,1,'登录成功','192.168.124.24',1,'2024-07-31 13:49:41','2024-07-31 13:49:41'),(69,1,'登录成功','127.0.0.1',1,'2024-12-03 14:53:59','2024-12-03 14:53:59'),(70,1,'登录成功','127.0.0.1',1,'2024-12-07 14:20:47','2024-12-07 14:20:47'),(71,1,'登录成功','127.0.0.1',1,'2024-12-07 17:32:55','2024-12-07 17:32:55'),(72,1,'登录成功','127.0.0.1',1,'2024-12-18 08:38:11','2024-12-18 08:38:11'),(73,1,'登录成功','192.168.124.24',1,'2025-01-09 17:20:11','2025-01-09 17:20:11'),(74,1,'登录成功','127.0.0.1',1,'2025-01-13 11:09:14','2025-01-13 11:09:14'),(75,1,'登录成功','192.168.124.24',1,'2025-01-15 10:33:10','2025-01-15 10:33:10'),(76,1,'登录成功','127.0.0.1',1,'2025-03-21 17:00:13','2025-03-21 17:00:13'),(77,1,'登录成功','127.0.0.1',1,'2025-04-11 13:54:41','2025-04-11 13:54:41'),(78,1,'登录成功','127.0.0.1',1,'2025-05-11 16:29:37','2025-05-11 16:29:37');
/*!40000 ALTER TABLE `system_login_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_login_log` with 25 row(s)
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
INSERT INTO `system_manager` VALUES (1,1,'/upload/image/20231024/47220acdd326647e029949627e49b197.jpg','黎明','admin','21232f297a57a5a743894a0e4a801fc3',1,2,0,'2025-05-11 16:29:37','2022-11-06 14:29:39','2025-05-11 16:29:37'),(10,6,'/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg','测试管理员','test','098f6bcd4621d373cade4e832627b4f6',1,2,0,NULL,'2022-11-06 14:29:39','2024-04-09 17:40:07');
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
INSERT INTO `system_manager_role` VALUES (1,'超级管理员','super','75,128,141,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149','拥有最高权限',0,2,'2022-11-06 14:28:28','2024-03-28 15:45:03'),(5,'普通管理员','common','75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149','普通权限',0,2,'2022-11-06 14:28:28','2024-06-24 15:07:35'),(6,'部门管理员','department','75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149','部门管理员',0,2,'2022-11-06 14:28:28','2023-11-28 09:04:09');
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
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_menu`
--

LOCK TABLES `system_menu` WRITE;
/*!40000 ALTER TABLE `system_menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_menu` VALUES (1,0,'系统管理','fa-cogs','admin','','','',1,'',1,20010,'2022-11-06 14:28:59','2025-04-11 15:46:06'),(2,145,'全局设置','fa-cog','admin','SystemSetting','system','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 13:57:25'),(69,145,'菜单设置','fa-bars','admin','SystemMenu','index','',1,'',1,20,'2022-11-06 14:28:59','2023-10-24 13:57:29'),(72,0,'权限管理','fa-users','admin','','','',1,'',1,20000,'2022-11-06 14:28:59','2025-04-11 15:46:00'),(73,72,'管理员','fa-user','admin','SystemManager','index','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(74,72,'角色管理','fa-user-plus','admin','SystemManagerRole','index','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(75,0,'系统主页','fa-home','admin','SystemIndex','index','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(76,69,'菜单添加','fa-link','admin','SystemMenu','create','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 13:49:44'),(79,69,'菜单删除','fa-link','admin','SystemMenu','delete','',2,'',1,30,'2022-11-06 14:28:59','2023-10-24 13:49:45'),(80,69,'菜单修改','fa-link','admin','SystemMenu','update','',2,'',1,20,'2022-11-06 14:28:59','2023-10-24 13:49:48'),(81,73,'管理员添加','fa-link','admin','SystemManager','create','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(82,74,'角色添加','fa-link','admin','SystemManagerRole','create','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(83,74,'角色修改','fa-link','admin','SystemManagerRole','update','',2,'',1,20,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(84,74,'角色删除','fa-link','admin','SystemManagerRole','delete','',2,'',1,30,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(85,73,'管理员修改','fa-link','admin','SystemManager','update','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(86,73,'管理员删除','fa-link','admin','SystemManager','delete','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(99,1,'系统设置','fa-cog','admin','SystemSetting','config','',1,'',1,20,'2022-11-06 14:28:59','2023-10-24 13:57:08'),(114,1,'系统日志','fa-book','admin','SystemOperLog','index','',1,'',1,30,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(121,114,'日志详情','fa-link','admin','SystemOperLog','detail','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(122,114,'日志清空','fa-link','admin','SystemOperLog','clear','',2,'',1,20,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(128,75,'控制台','fa-dashboard','admin','SystemIndex','console','',1,'',1,10,'2022-11-06 14:28:59','2025-04-11 14:32:43'),(134,69,'菜单排序','fa-link','admin','SystemMenu','sort','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 13:49:50'),(136,137,'系统信息','fa-link','admin','SystemIndex','system','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(137,157,'其他菜单','fa-link','admin','','','',2,'',1,100000,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(138,137,'个人资料','fa-link','admin','SystemIndex','profile','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(141,75,'UI组件','fa-pie-chart','admin','SystemIndex','components','',1,'',1,100,'2022-11-06 14:28:59','2025-04-11 14:32:47'),(142,69,'全部菜单','fa-link','admin','SystemMenu','getAll','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 13:49:52'),(143,157,'公共权限','fa-link','admin','','','',2,'',1,10000,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(144,143,'文本编辑','fa-link','admin','SystemEditor','ueditor','',2,'',1,100,'2022-11-06 14:28:59','2025-04-11 14:18:18'),(145,0,'运维管理','fa-server','admin','','','',1,'',1,20020,'2022-11-06 14:28:59','2025-04-11 15:46:10'),(147,143,'全部角色','fa-link','admin','SystemManagerRole','getAll','',2,'',1,100,'2023-03-15 14:17:55','2023-10-24 10:34:03'),(148,137,'头像上传','fa-link','admin','SystemManager','avatar','',2,'',1,100,'2023-03-20 15:11:09','2023-10-24 10:34:03'),(149,137,'退出登录','fa-link','admin','SystemIndex','logout','',2,'',1,100,'2023-03-21 10:46:54','2023-10-24 10:34:03'),(150,1,'登录日志','fa-file-text','admin','SystemLoginLog','index','',1,'',1,100,'2023-03-21 11:55:24','2023-10-24 10:34:03'),(151,150,'日志详情','fa-link','admin','SystemLoginLog','detail','',2,'',1,100,'2023-03-21 12:01:11','2023-10-24 10:34:03'),(152,150,'日志清空','fa-link','admin','SystemLoginLog','clear','',2,'',1,100,'2023-03-21 12:01:22','2023-10-24 10:34:03'),(153,157,'文件上传','fa-link','admin','','','',2,'',1,100,'2023-03-21 14:32:33','2023-10-24 10:34:03'),(154,153,'图片上传','fa-link','admin','SystemUpload','image','',2,'',1,100,'2023-03-21 14:32:51','2024-03-28 15:45:52'),(155,153,'文件上传','fa-link','admin','SystemUpload','file','',2,'',1,100,'2023-03-21 14:33:00','2024-03-28 15:45:56'),(156,153,'文件检测','fa-link','admin','SystemUpload','check','',2,'',1,100,'2023-03-21 14:33:07','2024-03-28 15:45:59'),(157,0,'系统菜单','fa-bars','admin','','','',2,'',1,20020,'2023-10-24 10:10:06','2025-04-11 15:16:56'),(158,153,'切片上传','fa-link','admin','SystemUpload','slice','',2,'',1,100,'2024-03-28 15:44:57','2024-03-28 15:44:57');
/*!40000 ALTER TABLE `system_menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_menu` with 42 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_oper_log`
--

LOCK TABLES `system_oper_log` WRITE;
/*!40000 ALTER TABLE `system_oper_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_oper_log` VALUES (7,122,1,'清空成功','192.168.124.24','/admin/system_log/clear.html','[]',1,'2024-04-10 09:21:53','2024-04-10 09:21:53'),(8,148,1,'上传成功','192.168.124.24','/admin/manager/avatar.html','[]',1,'2024-04-10 09:45:37','2024-04-10 09:45:37'),(9,148,1,'上传成功','192.168.124.24','/admin/manager/avatar.html','[]',1,'2024-04-10 09:45:47','2024-04-10 09:45:47'),(10,99,1,'修改成功','192.168.124.24','/admin/system_setting/config.html','{\"content\":\"111\"}',1,'2024-04-10 09:47:42','2024-04-10 09:47:42'),(11,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:52:58','2024-05-16 09:52:58'),(12,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:00','2024-05-16 09:53:00'),(13,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:02','2024-05-16 09:53:02'),(14,150,1,'获取成功','192.168.124.24','/admin/system_login_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:06','2024-05-16 09:53:06'),(15,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:06','2024-05-16 09:53:06'),(16,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:16','2024-05-16 09:53:16'),(17,74,1,'获取成功','192.168.124.24','/admin/manager_role/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:24','2024-05-16 09:53:24'),(18,147,1,'获取成功','192.168.124.24','/admin/manager_role/get_all.html','[]',1,'2024-05-16 09:53:25','2024-05-16 09:53:25'),(19,73,1,'获取成功','192.168.124.24','/admin/manager/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:26','2024-05-16 09:53:26'),(20,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:27','2024-05-16 09:53:27'),(21,114,1,'获取成功','192.168.124.24','/admin/system_log/index.html?page=1&limit=15','[]',1,'2024-05-16 09:53:33','2024-05-16 09:53:33'),(22,138,1,'修改成功','192.168.124.24','/admin/index/profile.html','{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"123456\",\"id\":\"1\"}',1,'2024-06-24 14:12:54','2024-06-24 14:12:54'),(23,138,1,'修改成功','192.168.124.24','/admin/index/profile.html','{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"admin\",\"id\":\"1\"}',1,'2024-06-24 14:13:12','2024-06-24 14:13:12'),(24,138,1,'修改成功','192.168.124.24','/admin/index/profile.html','{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"admin\",\"id\":\"1\"}',1,'2024-06-24 14:13:46','2024-06-24 14:13:46'),(25,148,1,'上传成功','192.168.124.24','/admin/manager/avatar.html','[]',1,'2024-06-24 14:20:48','2024-06-24 14:20:48'),(26,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:21:01','2024-06-24 14:21:01'),(27,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:21:09','2024-06-24 14:21:09'),(28,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:21:36','2024-06-24 14:21:36'),(29,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:26:38','2024-06-24 14:26:38'),(30,81,1,'姓名已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:28:40','2024-06-24 14:28:40'),(31,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:28:58','2024-06-24 14:28:58'),(32,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:29:04','2024-06-24 14:29:04'),(33,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:29:11','2024-06-24 14:29:11'),(34,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:30:55','2024-06-24 14:30:55'),(35,81,1,'account规则错误','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:53:03','2024-06-24 14:53:03'),(36,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:53:23','2024-06-24 14:53:23'),(37,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:53:36','2024-06-24 14:53:36'),(38,81,1,'账号已存在','192.168.124.24','/admin/manager/create.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}',2,'2024-06-24 14:57:22','2024-06-24 14:57:22'),(39,85,1,'账号已存在','192.168.124.24','/admin/manager/update.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"id\":\"1\"}',2,'2024-06-24 14:57:54','2024-06-24 14:57:54'),(40,84,1,'禁止删除，角色下存在管理员','192.168.124.24','/admin/manager_role/delete.html','{\"id\":\"1\"}',2,'2024-06-24 15:07:29','2024-06-24 15:07:29'),(41,84,1,'禁止删除，角色下存在管理员','192.168.124.24','/admin/manager_role/delete.html','{\"id\":\"6\"}',2,'2024-06-24 15:07:32','2024-06-24 15:07:32'),(42,84,1,'删除成功','192.168.124.24','/admin/manager_role/delete.html','{\"id\":\"5\"}',1,'2024-06-24 15:07:35','2024-06-24 15:07:35'),(43,84,1,'删除成功','192.168.124.24','/admin/manager_role/delete.html','{\"id\":\"1\"}',1,'2024-07-26 14:27:37','2024-07-26 14:27:37'),(44,99,1,'修改成功','192.168.124.24','/admin/system_setting/config.html','{\"content\":\"111\"}',1,'2024-07-31 14:01:22','2024-07-31 14:01:22'),(45,99,1,'修改成功','192.168.124.24','/admin/system_setting/config.html','{\"content\":\"111\"}',1,'2024-07-31 14:01:25','2024-07-31 14:01:25'),(46,99,1,'修改成功','192.168.124.24','/admin/system_setting/config.html','{\"content\":\"111\"}',1,'2024-07-31 14:01:27','2024-07-31 14:01:27'),(47,156,1,'文件已存在','127.0.0.1','/admin/system_upload/check.html','{\"file_name\":\"1 - 副本.jpg\",\"file_md5\":\"396814d705b2ceb75f487e5c63e9c6c4\",\"file_size\":\"6034\",\"file_total\":\"1\",\"apped_data\":\"{}\"}',1,'2024-12-04 08:42:02','2024-12-04 08:42:02'),(48,148,1,'上传成功','127.0.0.1','/admin/Manager/avatar.html','[]',1,'2024-12-07 14:55:48','2024-12-07 14:55:48'),(49,156,1,'文件不存在','127.0.0.1','/admin/SystemUpload/check.html','{\"file_name\":\"134MB.mp4\",\"file_md5\":\"4f242c6df32174ad5fb626a19f4a6bc7\",\"file_size\":\"141494824\",\"file_total\":\"68\",\"apped_data\":\"{}\"}',2,'2024-12-07 17:11:16','2024-12-07 17:11:16'),(50,156,1,'文件不存在','127.0.0.1','/admin/SystemUpload/check.html','{\"file_name\":\"32.2MB.mp4\",\"file_md5\":\"8493788d0f3c54adfaa065358e5f2296\",\"file_size\":\"33773387\",\"file_total\":\"17\",\"apped_data\":\"{}\"}',2,'2024-12-07 17:11:21','2024-12-07 17:11:21'),(51,156,1,'文件不存在','127.0.0.1','/admin/SystemUpload/check.html','{\"file_name\":\"23.9MB.zip\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_size\":\"24543864\",\"file_total\":\"12\",\"apped_data\":\"{}\"}',2,'2024-12-07 17:11:28','2024-12-07 17:11:28'),(52,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"1\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:28','2024-12-07 17:11:28'),(53,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"2\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:28','2024-12-07 17:11:28'),(54,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"3\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:28','2024-12-07 17:11:28'),(55,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"4\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:29','2024-12-07 17:11:29'),(56,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"5\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:29','2024-12-07 17:11:29'),(57,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"6\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:29','2024-12-07 17:11:29'),(58,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"7\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:29','2024-12-07 17:11:29'),(59,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"8\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:29','2024-12-07 17:11:29'),(60,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"9\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:29','2024-12-07 17:11:29'),(61,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"10\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:30','2024-12-07 17:11:30'),(62,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"11\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:30','2024-12-07 17:11:30'),(63,158,1,'上传成功','127.0.0.1','/admin/SystemUpload/slice.html','{\"file_name\":\"23.9MB.zip\",\"file_size\":\"24543864\",\"file_chunksize\":\"1475192\",\"file_suffix\":\"zip\",\"file_total\":\"12\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_index\":\"12\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:30','2024-12-07 17:11:30'),(64,156,1,'文件已存在','127.0.0.1','/admin/SystemUpload/check.html','{\"file_name\":\"23.9MB.zip\",\"file_md5\":\"7e5b1b87da3ad9581672260eae458d9e\",\"file_size\":\"24543864\",\"file_total\":\"12\",\"apped_data\":\"{}\"}',1,'2024-12-07 17:11:56','2024-12-07 17:11:56'),(65,149,1,'退出成功','127.0.0.1','/admin/Index/logout.html','[]',1,'2024-12-07 17:25:43','2024-12-07 17:25:43'),(66,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:33:54','2025-01-16 09:33:54'),(67,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:34:15','2025-01-16 09:34:15'),(68,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:34:38','2025-01-16 09:34:38'),(69,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:35:10','2025-01-16 09:35:10'),(70,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:35:25','2025-01-16 09:35:25'),(71,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:35:49','2025-01-16 09:35:49'),(72,148,1,'上传成功','192.168.124.24','/admin/Manager/avatar.html','[]',1,'2025-01-16 09:36:06','2025-01-16 09:36:06'),(73,85,1,'修改成功','127.0.0.1','/admin/Manager/update.html','{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"id\":\"1\"}',1,'2025-04-11 14:14:32','2025-04-11 14:14:32'),(74,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"143\",\"name\":\"文本编辑\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemEditor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"144\"}',1,'2025-04-11 14:18:18','2025-04-11 14:18:18'),(75,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"75\",\"name\":\"控制台\",\"icon\":\"fa-dashboard\",\"module\":\"admin\",\"controller\":\"SystemHome\",\"action\":\"console\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"128\"}',1,'2025-04-11 14:19:36','2025-04-11 14:19:36'),(76,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"75\",\"name\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"SystemHome\",\"action\":\"components\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"141\"}',1,'2025-04-11 14:19:41','2025-04-11 14:19:41'),(77,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"75\",\"name\":\"控制台\",\"icon\":\"fa-dashboard\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"console\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"128\"}',1,'2025-04-11 14:32:43','2025-04-11 14:32:43'),(78,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"75\",\"name\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"components\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"141\"}',1,'2025-04-11 14:32:47','2025-04-11 14:32:47'),(79,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"系统管理\",\"icon\":\"fa-cogs\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"1\"}',1,'2025-04-11 15:15:36','2025-04-11 15:15:36'),(80,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"权限管理\",\"icon\":\"fa-users\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"72\"}',1,'2025-04-11 15:15:41','2025-04-11 15:15:41'),(81,80,1,'修改成功','127.0.0.1','/admin/SystemMenu/update.html','{\"parentId\":\"0\",\"name\":\"运维管理\",\"icon\":\"fa-server\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"145\"}',1,'2025-04-11 15:15:44','2025-04-11 15:15:44'),(82,79,1,'删除成功','127.0.0.1','/admin/SystemMenu/delete.html','{\"id\":\"64\"}',1,'2025-04-11 15:16:01','2025-04-11 15:16:01'),(83,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"1\",\"sort\":\"10000\"}',1,'2025-04-11 15:16:26','2025-04-11 15:16:26'),(84,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"145\",\"sort\":\"20000\"}',1,'2025-04-11 15:16:41','2025-04-11 15:16:41'),(85,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"1\",\"sort\":\"20000\"}',1,'2025-04-11 15:16:46','2025-04-11 15:16:46'),(86,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"145\",\"sort\":\"20010\"}',1,'2025-04-11 15:16:51','2025-04-11 15:16:51'),(87,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"157\",\"sort\":\"20020\"}',1,'2025-04-11 15:16:56','2025-04-11 15:16:56'),(88,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"72\",\"sort\":\"20000\"}',1,'2025-04-11 15:46:00','2025-04-11 15:46:00'),(89,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"1\",\"sort\":\"20010\"}',1,'2025-04-11 15:46:06','2025-04-11 15:46:06'),(90,134,1,'修改成功','127.0.0.1','/admin/SystemMenu/sort.html','{\"id\":\"145\",\"sort\":\"20020\"}',1,'2025-04-11 15:46:10','2025-04-11 15:46:10'),(91,148,1,'上传成功','127.0.0.1','/admin/SystemManager/avatar.html','[]',1,'2025-04-11 15:46:33','2025-04-11 15:46:33');
/*!40000 ALTER TABLE `system_oper_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_oper_log` with 85 row(s)
--

--
-- Table structure for table `system_setting`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_setting` (
  `settingId` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '系统名称',
  `slogan` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '系统标语',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '测试文本',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`settingId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统设置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_setting`
--

LOCK TABLES `system_setting` WRITE;
/*!40000 ALTER TABLE `system_setting` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `system_setting` VALUES (1,'EASYADMIN','PHP后台快速开发系统','111','2023-10-24 10:33:41','2024-07-31 14:01:27');
/*!40000 ALTER TABLE `system_setting` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `system_setting` with 1 row(s)
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

-- Dump completed on: Sun, 11 May 2025 18:00:05 +0800
