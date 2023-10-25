-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1:3306	Database: easyadmin
-- ------------------------------------------------------
-- Server version 	5.7.26
-- Date: Wed, 25 Oct 2023 10:07:07 +0800

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
-- Table structure for table `easy_manager`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_manager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属用户组',
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `real_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `account` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `is_system` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1-正常，2-禁用，3-锁定',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_manager`
--

LOCK TABLES `easy_manager` WRITE;
/*!40000 ALTER TABLE `easy_manager` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_manager` VALUES (1,1,'/upload/image/20231024/47220acdd326647e029949627e49b197.jpg','黎明','admin','21232f297a57a5a743894a0e4a801fc3',1,1,'2023-10-24 09:46:37','2022-11-06 14:29:39','2023-10-24 10:00:53'),(10,6,'/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg','测试管理员','test','098f6bcd4621d373cade4e832627b4f6',2,1,NULL,'2022-11-06 14:29:39','2023-10-24 11:33:49');
/*!40000 ALTER TABLE `easy_manager` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_manager` with 2 row(s)
--

--
-- Table structure for table `easy_manager_role`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_manager_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `identify` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色标识',
  `permission` text COLLATE utf8mb4_unicode_ci COMMENT '菜单权限',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色排序',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_manager_role`
--

LOCK TABLES `easy_manager_role` WRITE;
/*!40000 ALTER TABLE `easy_manager_role` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_manager_role` VALUES (1,'超级管理员','super','1,2,64,69,72,73,74,75,76,79,80,81,82,83,84,85,86,99,114,121,122,128,134,136,137,138,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158','拥有最高权限',0,'2022-11-06 14:28:28','2023-10-24 14:14:26'),(5,'普通管理员','common','75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,146,148,149','普通权限',0,'2022-11-06 14:28:28','2023-10-24 14:19:01'),(6,'部门管理员','department','75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,146,148,149','部门管理员',0,'2022-11-06 14:28:28','2023-10-24 14:19:06');
/*!40000 ALTER TABLE `easy_manager_role` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_manager_role` with 3 row(s)
--

--
-- Table structure for table `easy_system_log`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_system_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `manager_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `menu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作菜单',
  `description` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作描述',
  `url` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `request_ip` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求IP',
  `params` longtext COLLATE utf8mb4_unicode_ci COMMENT '请求参数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '操作状态：1-成功，2-失败',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_system_log`
--

LOCK TABLES `easy_system_log` WRITE;
/*!40000 ALTER TABLE `easy_system_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_system_log` VALUES (320,1,'日志清空','系统自动记录：清空成功','/admin/system_log/clear.html','127.0.0.1','[]',1,'2023-10-24 09:57:12','2023-10-24 10:33:16'),(321,1,'头像上传','系统自动记录：上传成功','/admin/manager/avatar.html','127.0.0.1','[]',1,'2023-10-24 10:00:53','2023-10-24 10:33:16'),(322,1,'个人资料','系统自动记录：修改成功','/admin/index/profile.html','127.0.0.1','{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"real_name\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"id\":\"1\"}',1,'2023-10-24 10:00:53','2023-10-24 10:33:16'),(323,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"72\",\"name\":\"角色管理\",\"icon\":\"fa-user-plus\",\"module\":\"admin\",\"controller\":\"ManagerRole\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"74\"}',1,'2023-10-24 10:06:22','2023-10-24 10:33:16'),(324,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"74\",\"name\":\"角色添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"ManagerRole\",\"action\":\"create\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"82\"}',1,'2023-10-24 10:06:27','2023-10-24 10:33:16'),(325,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"74\",\"name\":\"角色修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"ManagerRole\",\"action\":\"update\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20\",\"id\":\"83\"}',1,'2023-10-24 10:06:33','2023-10-24 10:33:16'),(326,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"74\",\"name\":\"角色删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"ManagerRole\",\"action\":\"delete\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"30\",\"id\":\"84\"}',1,'2023-10-24 10:06:38','2023-10-24 10:33:16'),(327,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"143\",\"name\":\"全部角色\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"ManagerRole\",\"action\":\"get_all\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"147\"}',1,'2023-10-24 10:07:38','2023-10-24 10:33:16'),(328,1,'头像上传','系统自动记录：上传成功','/admin/manager/avatar.html','127.0.0.1','[]',1,'2023-10-24 10:07:44','2023-10-24 10:33:16'),(329,1,'管理员修改','系统自动记录：修改成功','/admin/manager/update.html','127.0.0.1','{\"role_id\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/cafe4106049840244c2ffd34e7d0de4a.jpg\",\"real_name\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"id\":\"10\"}',1,'2023-10-24 10:07:45','2023-10-24 10:33:16'),(330,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"145\",\"name\":\"全局设置\",\"icon\":\"fa-cog\",\"module\":\"admin\",\"controller\":\"Setting\",\"action\":\"system\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"0\",\"id\":\"2\"}',1,'2023-10-24 10:08:52','2023-10-24 10:33:16'),(331,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"1\",\"name\":\"系统设置\",\"icon\":\"fa-cog\",\"module\":\"admin\",\"controller\":\"Setting\",\"action\":\"config\",\"params\":\"\",\"type\":\"1\",\"link\":\"https:\\/\\/www.baidu.com\\/\",\"target\":\"1\",\"sort\":\"20\",\"id\":\"99\"}',1,'2023-10-24 10:09:27','2023-10-24 10:33:16'),(332,1,'菜单添加','系统自动记录：添加成功','/admin/menu/create.html','127.0.0.1','{\"parent_id\":\"0\",\"name\":\"系统菜单\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2023-10-24 10:10:07','2023-10-24 10:33:16'),(333,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"公共权限\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10000\",\"id\":\"143\"}',1,'2023-10-24 10:10:19','2023-10-24 10:33:16'),(334,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"其他菜单\",\"icon\":\"fa-shield\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100000\",\"id\":\"137\"}',1,'2023-10-24 10:10:25','2023-10-24 10:33:16'),(335,1,'菜单排序','系统自动记录：修改成功','/admin/menu/sort.html','127.0.0.1','{\"id\":\"157\",\"sort\":\"100000\"}',1,'2023-10-24 10:10:31','2023-10-24 10:33:16'),(336,1,'菜单添加','系统自动记录：添加成功','/admin/menu/create.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}',1,'2023-10-24 10:18:03','2023-10-24 10:33:16'),(337,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"上传功能\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"153\"}',1,'2023-10-24 10:18:23','2023-10-24 10:33:16'),(338,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"153\"}',1,'2023-10-24 10:18:29','2023-10-24 10:33:16'),(339,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"公共权限\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10000\",\"id\":\"143\"}',1,'2023-10-24 10:18:40','2023-10-24 10:33:16'),(340,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"157\",\"name\":\"其他菜单\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100000\",\"id\":\"137\"}',1,'2023-10-24 10:18:44','2023-10-24 10:33:16'),(341,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"143\",\"name\":\"文本编辑\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Editor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"144\"}',1,'2023-10-24 10:19:09','2023-10-24 10:33:16'),(342,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"75\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"158\"}',1,'2023-10-24 10:19:25','2023-10-24 10:33:16'),(343,1,'菜单修改','系统自动记录：修改成功','/admin/menu/update.html','127.0.0.1','{\"parent_id\":\"75\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"158\"}',1,'2023-10-24 10:19:33','2023-10-24 10:33:16'),(344,1,'系统设置','系统自动记录：修改成功','/admin/setting/config.html','127.0.0.1','{\"content\":\"111\"}',1,'2023-10-24 10:37:57','2023-10-24 10:37:57'),(345,1,'角色修改','系统自动记录：Undefined index: title','/admin/manager_role/update.html','127.0.0.1','{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"id\":\"1\",\"permission\":[\"75\",\"128\",\"141\",\"158\",\"64\",\"1\",\"99\",\"114\",\"121\",\"122\",\"150\",\"151\",\"152\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"145\",\"2\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"157\",\"153\",\"154\",\"155\",\"156\",\"143\",\"144\",\"147\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\"]}',2,'2023-10-24 10:53:13','2023-10-24 10:53:13'),(346,1,'角色修改','系统自动记录：修改成功','/admin/manager_role/update.html','127.0.0.1','{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"id\":\"1\",\"permission\":[\"75\",\"128\",\"141\",\"158\",\"64\",\"1\",\"99\",\"114\",\"121\",\"122\",\"150\",\"151\",\"152\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"145\",\"2\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"157\",\"153\",\"154\",\"155\",\"156\",\"143\",\"144\",\"147\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\"]}',1,'2023-10-24 10:53:51','2023-10-24 10:53:51'),(347,1,'管理员修改','系统自动记录：修改成功','/admin/manager/update.html','127.0.0.1','{\"role_id\":\"6\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/cafe4106049840244c2ffd34e7d0de4a.jpg\",\"real_name\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"id\":\"10\"}',1,'2023-10-24 11:33:49','2023-10-24 11:33:49'),(348,1,'菜单排序','系统自动记录：修改成功','/admin/menu/sort.html','127.0.0.1','{\"id\":\"64\",\"sort\":\"90000\"}',1,'2023-10-24 13:43:20','2023-10-24 13:43:20'),(349,1,'菜单排序','系统自动记录：修改成功','/admin/menu/sort.html','127.0.0.1','{\"id\":\"64\",\"sort\":\"900000\"}',1,'2023-10-24 13:43:22','2023-10-24 13:43:22'),(350,1,'菜单排序','系统自动记录：修改成功','/admin/menu/sort.html','127.0.0.1','{\"id\":\"64\",\"sort\":\"10000\"}',1,'2023-10-24 13:43:38','2023-10-24 13:43:38'),(351,1,'头像上传','系统自动记录：上传成功','/admin/manager/avatar.html','127.0.0.1','[]',1,'2023-10-24 13:54:37','2023-10-24 13:54:37'),(352,1,'菜单修改','系统自动记录：修改成功','/admin/system_menu/update.html','127.0.0.1','{\"parent_id\":\"1\",\"name\":\"系统设置\",\"icon\":\"fa-cog\",\"module\":\"admin\",\"controller\":\"SystemSetting\",\"action\":\"config\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20\",\"id\":\"99\"}',1,'2023-10-24 13:57:08','2023-10-24 13:57:08'),(353,1,'菜单修改','系统自动记录：修改成功','/admin/system_menu/update.html','127.0.0.1','{\"parent_id\":\"145\",\"name\":\"全局设置\",\"icon\":\"fa-cog\",\"module\":\"admin\",\"controller\":\"SystemSetting\",\"action\":\"system\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"0\",\"id\":\"2\"}',1,'2023-10-24 13:57:15','2023-10-24 13:57:15'),(354,1,'菜单排序','系统自动记录：修改成功','/admin/system_menu/sort.html','127.0.0.1','{\"id\":\"2\",\"sort\":\"10\"}',1,'2023-10-24 13:57:25','2023-10-24 13:57:25'),(355,1,'菜单排序','系统自动记录：修改成功','/admin/system_menu/sort.html','127.0.0.1','{\"id\":\"69\",\"sort\":\"20\"}',1,'2023-10-24 13:57:29','2023-10-24 13:57:29'),(356,1,'全局设置','系统自动记录：修改成功','/admin/system_setting/system.html','127.0.0.1','{\"name\":\"EASYADMIN\",\"slogan\":\"PHP后台快速开发系统\"}',1,'2023-10-24 13:58:21','2023-10-24 13:58:21'),(357,1,'系统设置','系统自动记录：修改成功','/admin/system_setting/config.html','127.0.0.1','{\"content\":\"111\"}',1,'2023-10-24 13:58:24','2023-10-24 13:58:24'),(358,1,'角色修改','系统自动记录：修改成功','/admin/manager_role/update.html','127.0.0.1','{\"name\":\"普通管理员\",\"identify\":\"common\",\"remark\":\"普通权限\",\"id\":\"5\",\"permission\":\"75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,146,148,149\"}',1,'2023-10-24 14:19:01','2023-10-24 14:19:01'),(359,1,'角色修改','系统自动记录：修改成功','/admin/manager_role/update.html','127.0.0.1','{\"name\":\"部门管理员\",\"identify\":\"department\",\"remark\":\"部门管理员\",\"id\":\"6\",\"permission\":\"75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,146,148,149\"}',1,'2023-10-24 14:19:06','2023-10-24 14:19:06');
/*!40000 ALTER TABLE `easy_system_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_system_log` with 40 row(s)
--

--
-- Table structure for table `easy_system_login_log`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_system_login_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `manager_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `description` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述信息',
  `login_ip` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '登录状态：1-登录成功，2-登录失败',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统登录日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_system_login_log`
--

LOCK TABLES `easy_system_login_log` WRITE;
/*!40000 ALTER TABLE `easy_system_login_log` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_system_login_log` VALUES (14,1,'登录成功','127.0.0.1',1,'2023-03-21 15:41:53','2023-03-21 15:41:53'),(15,1,'登录成功','127.0.0.1',1,'2023-04-04 14:49:52','2023-04-04 14:49:52'),(16,1,'登录成功','127.0.0.1',1,'2023-06-14 16:53:47','2023-06-14 16:53:47'),(17,1,'登录成功','127.0.0.1',1,'2023-08-02 09:29:28','2023-08-02 09:29:28'),(18,1,'登录成功','127.0.0.1',1,'2023-08-02 14:16:45','2023-08-02 14:16:45'),(19,1,'密码错误','127.0.0.1',2,'2023-08-03 08:50:26','2023-08-03 08:50:26'),(20,1,'登录成功','127.0.0.1',1,'2023-08-03 08:50:29','2023-08-03 08:50:29'),(21,1,'登录成功','192.168.124.18',1,'2023-10-07 14:56:45','2023-10-07 14:56:45'),(22,1,'登录成功','192.168.124.24',1,'2023-10-10 14:29:48','2023-10-10 14:29:48'),(23,1,'登录成功','127.0.0.1',1,'2023-10-20 13:47:27','2023-10-20 13:47:27'),(24,1,'登录成功','127.0.0.1',1,'2023-10-24 09:46:37','2023-10-24 09:46:37');
/*!40000 ALTER TABLE `easy_system_login_log` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_system_login_log` with 11 row(s)
--

--
-- Table structure for table `easy_system_menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_system_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标',
  `module` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作',
  `params` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求参数',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '菜单类型：1-菜单，2-按钮，3-外链',
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '打开方式：1-默认方式，2-当前窗口，3-新窗口',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_system_menu`
--

LOCK TABLES `easy_system_menu` WRITE;
/*!40000 ALTER TABLE `easy_system_menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_system_menu` VALUES (1,64,'系统管理','fa-cogs','admin','','','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(2,145,'全局设置','fa-cog','admin','SystemSetting','system','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 13:57:25'),(64,0,'系统模块','fa fa-fw fa-cogs','admin','','','',1,'',1,10000,'2022-11-06 14:28:59','2023-10-24 13:43:38'),(69,145,'菜单设置','fa-bars','admin','SystemMenu','index','',1,'',1,20,'2022-11-06 14:28:59','2023-10-24 13:57:29'),(72,64,'权限管理','fa-users','admin','','','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(73,72,'管理员','fa-user','admin','Manager','index','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(74,72,'角色管理','fa-user-plus','admin','ManagerRole','index','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(75,0,'系统主页','fa-home','admin','Index','index','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(76,69,'菜单添加','fa-link','admin','SystemMenu','create','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 13:49:44'),(79,69,'菜单删除','fa-link','admin','SystemMenu','delete','',2,'',1,30,'2022-11-06 14:28:59','2023-10-24 13:49:45'),(80,69,'菜单修改','fa-link','admin','SystemMenu','update','',2,'',1,20,'2022-11-06 14:28:59','2023-10-24 13:49:48'),(81,73,'管理员添加','fa-link','admin','Manager','create','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(82,74,'角色添加','fa-link','admin','ManagerRole','create','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(83,74,'角色修改','fa-link','admin','ManagerRole','update','',2,'',1,20,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(84,74,'角色删除','fa-link','admin','ManagerRole','delete','',2,'',1,30,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(85,73,'管理员修改','fa-link','admin','Manager','update','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(86,73,'管理员删除','fa-link','admin','Manager','delete','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(99,1,'系统设置','fa-cog','admin','SystemSetting','config','',1,'',1,20,'2022-11-06 14:28:59','2023-10-24 13:57:08'),(114,1,'系统日志','fa-book','admin','SystemLog','index','',1,'',1,30,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(121,114,'日志详情','fa-link','admin','SystemLog','detail','',2,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(122,114,'日志清空','fa-link','admin','SystemLog','clear','',2,'',1,20,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(128,75,'控制台','fa-dashboard','admin','Home','console','',1,'',1,10,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(134,69,'菜单排序','fa-link','admin','SystemMenu','sort','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 13:49:50'),(136,137,'系统信息','fa-link','admin','Index','system','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(137,157,'其他菜单','fa-link','admin','','','',2,'',1,100000,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(138,137,'个人资料','fa-link','admin','Index','profile','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(141,75,'UI组件','fa-pie-chart','admin','Home','components','',1,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(142,69,'全部菜单','fa-link','admin','SystemMenu','get_all','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 13:49:52'),(143,157,'公共权限','fa-link','admin','','','',2,'',1,10000,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(144,143,'文本编辑','fa-link','admin','Editor','ueditor','',2,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(145,64,'运维管理','fa-server','admin','','','',1,'',1,100,'2022-11-06 14:28:59','2023-10-24 10:34:03'),(146,137,'清除缓存','fa-link','admin','Index','clear_cache','',2,'',1,100,'2023-03-15 14:16:27','2023-10-24 10:34:03'),(147,143,'全部角色','fa-link','admin','ManagerRole','get_all','',2,'',1,100,'2023-03-15 14:17:55','2023-10-24 10:34:03'),(148,137,'头像上传','fa-link','admin','Manager','avatar','',2,'',1,100,'2023-03-20 15:11:09','2023-10-24 10:34:03'),(149,137,'退出登录','fa-link','admin','Index','logout','',2,'',1,100,'2023-03-21 10:46:54','2023-10-24 10:34:03'),(150,1,'登录日志','fa-file-text','admin','SystemLoginLog','index','',1,'',1,100,'2023-03-21 11:55:24','2023-10-24 10:34:03'),(151,150,'日志详情','fa-link','admin','SystemLoginLog','detail','',2,'',1,100,'2023-03-21 12:01:11','2023-10-24 10:34:03'),(152,150,'日志清空','fa-link','admin','SystemLoginLog','clear','',2,'',1,100,'2023-03-21 12:01:22','2023-10-24 10:34:03'),(153,157,'文件上传','fa-link','admin','','','',2,'',1,100,'2023-03-21 14:32:33','2023-10-24 10:34:03'),(154,153,'图片上传','fa-link','admin','Upload','image','',2,'',1,100,'2023-03-21 14:32:51','2023-10-24 10:34:03'),(155,153,'文件上传','fa-link','admin','Upload','file','',2,'',1,100,'2023-03-21 14:33:00','2023-10-24 10:34:03'),(156,153,'文件检测','fa-link','admin','Upload','check','',2,'',1,100,'2023-03-21 14:33:07','2023-10-24 10:34:03'),(157,0,'系统菜单','fa-bars','admin','','','',2,'',1,100000,'2023-10-24 10:10:06','2023-10-24 10:34:03'),(158,75,'文件上传','fa-link','admin','','','',1,'',1,100,'2023-10-24 10:18:03','2023-10-24 10:34:03');
/*!40000 ALTER TABLE `easy_system_menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_system_menu` with 44 row(s)
--

--
-- Table structure for table `easy_system_setting`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_system_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '系统名称',
  `slogan` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '系统标语',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '测试文本',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统设置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_system_setting`
--

LOCK TABLES `easy_system_setting` WRITE;
/*!40000 ALTER TABLE `easy_system_setting` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_system_setting` VALUES (1,'EASYADMIN','PHP后台快速开发系统','111','2023-10-24 10:33:41','2023-10-24 10:37:57');
/*!40000 ALTER TABLE `easy_system_setting` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_system_setting` with 1 row(s)
--

--
-- Table structure for table `easy_system_upload`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `easy_system_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `md5` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件MD5',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名称',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `ext` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件后缀',
  `path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '保存位置',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `md5` (`md5`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文件上传表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `easy_system_upload`
--

LOCK TABLES `easy_system_upload` WRITE;
/*!40000 ALTER TABLE `easy_system_upload` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `easy_system_upload` VALUES (1,'396814d705b2ceb75f487e5c63e9c6c4','1.png',6034,'png','/uploads/images/20230321/4caedcd42419e7f699c4434fd2b2dd89.png','2023-03-21 15:47:06','2023-10-20 13:52:16'),(2,'8ddf582f610c68b1729111fd86d05ec1','1.jpg',329748,'jpg','/upload/image/20231024/47220acdd326647e029949627e49b197.jpg','2023-10-24 10:00:52','2023-10-24 10:00:52'),(3,'628eebd9a0247ae4e336dcf3423eed05','6.jpg',113905,'jpg','/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg','2023-10-24 10:07:44','2023-10-24 10:07:44');
/*!40000 ALTER TABLE `easy_system_upload` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `easy_system_upload` with 3 row(s)
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

-- Dump completed on: Wed, 25 Oct 2023 10:07:07 +0800
