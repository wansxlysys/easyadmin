-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-04-09 10:08:32
-- 服务器版本： 5.7.26
-- PHP 版本： 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `easyadmin`
--

-- --------------------------------------------------------

--
-- 表的结构 `easy_manager`
--

CREATE TABLE `easy_manager` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `roleId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属用户组',
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `realName` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `account` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `isSystem` tinyint(1) UNSIGNED NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态：1-正常，2-禁用，3-锁定',
  `loginTime` datetime DEFAULT NULL COMMENT '登录时间',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

--
-- 转存表中的数据 `easy_manager`
--

INSERT INTO `easy_manager` (`id`, `roleId`, `avatar`, `realName`, `account`, `password`, `isSystem`, `status`, `loginTime`, `createTime`, `updateTime`) VALUES
(1, 1, '/upload/image/20231024/47220acdd326647e029949627e49b197.jpg', '黎明', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-04-09 10:03:38', '2022-11-06 14:29:39', '2024-04-08 17:31:47'),
(10, 6, '/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg', '测试管理员', 'test', '098f6bcd4621d373cade4e832627b4f6', 2, 1, NULL, '2022-11-06 14:29:39', '2024-02-21 14:58:39');

-- --------------------------------------------------------

--
-- 表的结构 `easy_manager_role`
--

CREATE TABLE `easy_manager_role` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `identify` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色标识',
  `permission` text COLLATE utf8mb4_unicode_ci COMMENT '菜单权限',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';

--
-- 转存表中的数据 `easy_manager_role`
--

INSERT INTO `easy_manager_role` (`id`, `name`, `identify`, `permission`, `remark`, `sort`, `createTime`, `updateTime`) VALUES
(1, '超级管理员', 'super', '75,128,141,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149', '拥有最高权限', 0, '2022-11-06 14:28:28', '2024-03-28 15:45:03'),
(5, '普通管理员', 'common', '75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149', '普通权限', 0, '2022-11-06 14:28:28', '2023-11-22 11:41:55'),
(6, '部门管理员', 'department', '75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149', '部门管理员', 0, '2022-11-06 14:28:28', '2023-11-28 09:04:09');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_log`
--

CREATE TABLE `easy_system_log` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `managerId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `menu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作菜单',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '操作描述',
  `url` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `requestIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求IP',
  `params` longtext COLLATE utf8mb4_unicode_ci COMMENT '请求参数',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '操作状态：1-成功，2-失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';

--
-- 转存表中的数据 `easy_system_log`
--

INSERT INTO `easy_system_log` (`id`, `managerId`, `menu`, `description`, `url`, `requestIp`, `params`, `status`, `createTime`, `updateTime`) VALUES
(376, 1, '日志清空', '系统自动记录：清空成功', '/admin/system_log/clear.html', '127.0.0.1', '[]', 1, '2023-11-28 16:10:29', '2023-11-28 16:10:29'),
(377, 1, '管理员修改', '系统自动记录：修改成功', '/admin/manager/update.html', '127.0.0.1', '{\"role_id\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"real_name\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"id\":\"1\"}', 1, '2023-11-29 16:04:56', '2023-11-29 16:04:56'),
(378, 1, '管理员修改', '系统自动记录：修改成功', '/admin/manager/update.html', '127.0.0.1', '{\"role_id\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"real_name\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"id\":\"1\"}', 1, '2023-11-29 16:04:58', '2023-11-29 16:04:58'),
(379, 1, '个人资料', '系统自动记录：修改成功', '/admin/index/profile.html', '127.0.0.1', '{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"real_name\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"id\":\"1\"}', 1, '2023-12-09 15:38:16', '2023-12-09 15:38:16'),
(380, 1, '角色修改', '系统自动记录：修改成功', '/admin/manager_role/update.html', '127.0.0.1', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"id\":\"1\",\"permission\":\"75,128,141,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142\"}', 1, '2023-12-09 16:13:55', '2023-12-09 16:13:55'),
(381, 1, '角色修改', '系统自动记录：修改成功', '/admin/manager_role/update.html', '127.0.0.1', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"id\":\"1\",\"permission\":\"75,128,141,64,1,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142\"}', 1, '2023-12-09 16:14:01', '2023-12-09 16:14:01'),
(382, 1, '角色修改', '系统自动记录：修改成功', '/admin/manager_role/update.html', '127.0.0.1', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"id\":\"1\",\"permission\":\"75,128,141,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149\"}', 1, '2023-12-09 16:38:46', '2023-12-09 16:38:46'),
(383, 1, '管理员修改', '系统自动记录：修改成功', '/admin/manager/update.html', '127.0.0.1', '{\"role_id\":\"6\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/cafe4106049840244c2ffd34e7d0de4a.jpg\",\"real_name\":\"测试管理员\",\"account\":\"test1\",\"password\":\"\",\"status\":\"1\",\"id\":\"10\"}', 1, '2024-02-21 14:58:35', '2024-02-21 14:58:35'),
(384, 1, '管理员修改', '系统自动记录：修改成功', '/admin/manager/update.html', '127.0.0.1', '{\"role_id\":\"6\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/cafe4106049840244c2ffd34e7d0de4a.jpg\",\"real_name\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"id\":\"10\"}', 1, '2024-02-21 14:58:39', '2024-02-21 14:58:39'),
(385, 1, '头像上传', '系统自动记录：上传成功', '/admin/manager/avatar.html', '192.168.124.24', '[]', 1, '2024-03-28 15:38:12', '2024-03-28 15:38:12'),
(386, 1, '菜单添加', '系统自动记录：添加成功', '/admin/system_menu/create.html', '192.168.124.24', '{\"parent_id\":\"153\",\"name\":\"切片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"slice\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2024-03-28 15:44:57', '2024-03-28 15:44:57'),
(387, 1, '角色修改', '系统自动记录：修改成功', '/admin/manager_role/update.html', '192.168.124.24', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"id\":\"1\",\"permission\":\"75,128,141,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}', 1, '2024-03-28 15:45:03', '2024-03-28 15:45:03'),
(388, 1, '菜单修改', '系统自动记录：修改成功', '/admin/system_menu/update.html', '192.168.124.24', '{\"parent_id\":\"153\",\"name\":\"图片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"image\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"154\"}', 1, '2024-03-28 15:45:52', '2024-03-28 15:45:52'),
(389, 1, '菜单修改', '系统自动记录：修改成功', '/admin/system_menu/update.html', '192.168.124.24', '{\"parent_id\":\"153\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"file\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"155\"}', 1, '2024-03-28 15:45:56', '2024-03-28 15:45:56'),
(390, 1, '菜单修改', '系统自动记录：修改成功', '/admin/system_menu/update.html', '192.168.124.24', '{\"parent_id\":\"153\",\"name\":\"文件检测\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"check\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"id\":\"156\"}', 1, '2024-03-28 15:45:59', '2024-03-28 15:45:59'),
(391, 1, '文件检测', '系统自动记录：文件不存在', '/admin/system_upload/check.html', '192.168.124.24', '{\"file_name\":\"5.2abb0bf1.mp4\",\"file_md5\":\"0c88d36ef4909652bdb12ef9b4b325a7\",\"file_size\":\"970263\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 2, '2024-03-28 15:46:07', '2024-03-28 15:46:07'),
(392, 1, '文件检测', '系统自动记录：文件不存在', '/admin/system_upload/check.html', '192.168.124.24', '{\"file_name\":\"5.2abb0bf1.mp4\",\"file_md5\":\"0c88d36ef4909652bdb12ef9b4b325a7\",\"file_size\":\"970263\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 2, '2024-03-28 15:46:19', '2024-03-28 15:46:19'),
(393, 1, '文件检测', '系统自动记录：文件不存在', '/admin/system_upload/check.html', '192.168.124.24', '{\"file_name\":\"5.2abb0bf1.mp4\",\"file_md5\":\"0c88d36ef4909652bdb12ef9b4b325a7\",\"file_size\":\"970263\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 2, '2024-03-28 15:47:46', '2024-03-28 15:47:46'),
(394, 1, '切片上传', '系统自动记录：文件格式必须zip', '/admin/system_upload/slice.html', '192.168.124.24', '{\"file_name\":\"5.2abb0bf1.mp4\",\"file_size\":\"970263\",\"file_chunksize\":\"970263\",\"file_suffix\":\"mp4\",\"file_total\":\"1\",\"file_md5\":\"0c88d36ef4909652bdb12ef9b4b325a7\",\"file_index\":\"1\",\"apped_data\":\"{}\"}', 2, '2024-03-28 15:47:46', '2024-03-28 15:47:46'),
(395, 1, '文件检测', '系统自动记录：文件不存在', '/admin/system_upload/check.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_size\":\"8179364\",\"file_total\":\"4\",\"apped_data\":\"{}\"}', 2, '2024-03-28 15:48:07', '2024-03-28 15:48:07'),
(396, 1, '切片上传', '系统自动记录：上传成功', '/admin/system_upload/slice.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_size\":\"8179364\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"4\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_index\":\"1\",\"apped_data\":\"{}\"}', 1, '2024-03-28 15:48:07', '2024-03-28 15:48:07'),
(397, 1, '切片上传', '系统自动记录：上传成功', '/admin/system_upload/slice.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_size\":\"8179364\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"4\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_index\":\"2\",\"apped_data\":\"{}\"}', 1, '2024-03-28 15:48:08', '2024-03-28 15:48:08'),
(398, 1, '切片上传', '系统自动记录：上传成功', '/admin/system_upload/slice.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_size\":\"8179364\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"4\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_index\":\"3\",\"apped_data\":\"{}\"}', 1, '2024-03-28 15:48:08', '2024-03-28 15:48:08'),
(399, 1, '切片上传', '系统自动记录：上传成功', '/admin/system_upload/slice.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_size\":\"8179364\",\"file_chunksize\":\"1887908\",\"file_suffix\":\"zip\",\"file_total\":\"4\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_index\":\"4\",\"apped_data\":\"{}\"}', 1, '2024-03-28 15:48:08', '2024-03-28 15:48:08'),
(400, 1, '文件检测', '系统自动记录：文件已存在', '/admin/system_upload/check.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_size\":\"8179364\",\"file_total\":\"4\",\"apped_data\":\"{}\"}', 1, '2024-03-28 15:48:53', '2024-03-28 15:48:53'),
(401, 1, '文件检测', '系统自动记录：文件已存在', '/admin/system_upload/check.html', '192.168.124.24', '{\"file_name\":\"test.zip\",\"file_md5\":\"26ae9bea6b90e2285fda78d4fe256610\",\"file_size\":\"8179364\",\"file_total\":\"4\",\"apped_data\":\"{}\"}', 1, '2024-03-28 15:49:47', '2024-03-28 15:49:47'),
(402, 1, '退出登录', '系统自动记录：退出成功', '/admin/index/logout.html', '192.168.124.24', '[]', 1, '2024-04-08 17:28:19', '2024-04-08 17:28:19');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_login_log`
--

CREATE TABLE `easy_system_login_log` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `managerId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `description` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述信息',
  `loginIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '登录状态：1-登录成功，2-登录失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统登录日志表';

--
-- 转存表中的数据 `easy_system_login_log`
--

INSERT INTO `easy_system_login_log` (`id`, `managerId`, `description`, `loginIp`, `status`, `createTime`, `updateTime`) VALUES
(29, 1, '登录成功', '127.0.0.1', 1, '2023-11-29 15:43:28', '2023-11-29 15:43:28'),
(30, 1, '登录成功', '127.0.0.1', 1, '2023-12-05 15:34:41', '2023-12-05 15:34:41'),
(31, 1, '登录成功', '127.0.0.1', 1, '2023-12-09 13:57:29', '2023-12-09 13:57:29'),
(32, 1, '登录成功', '127.0.0.1', 1, '2023-12-11 10:01:06', '2023-12-11 10:01:06'),
(33, 1, '登录成功', '127.0.0.1', 1, '2023-12-18 11:25:55', '2023-12-18 11:25:55'),
(34, 1, '登录成功', '127.0.0.1', 1, '2024-01-08 10:24:26', '2024-01-08 10:24:26'),
(35, 1, '登录成功', '127.0.0.1', 1, '2024-02-21 10:20:27', '2024-02-21 10:20:27'),
(36, 1, '登录成功', '192.168.124.24', 1, '2024-04-08 17:29:25', '2024-04-08 17:29:25'),
(37, 1, '登录成功', '192.168.124.24', 1, '2024-04-08 17:31:47', '2024-04-08 17:31:47'),
(38, 1, '登录成功', '192.168.124.24', 1, '2024-04-09 10:03:38', '2024-04-09 10:03:38');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_menu`
--

CREATE TABLE `easy_system_menu` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `parentId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标',
  `module` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作',
  `params` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求参数',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '菜单类型：1-菜单，2-按钮，3-外链',
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '打开方式：1-默认方式，2-当前窗口，3-新窗口',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统菜单表';

--
-- 转存表中的数据 `easy_system_menu`
--

INSERT INTO `easy_system_menu` (`id`, `parentId`, `name`, `icon`, `module`, `controller`, `action`, `params`, `type`, `link`, `target`, `sort`, `createTime`, `updateTime`) VALUES
(1, 64, '系统管理', 'fa-cogs', 'admin', '', '', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(2, 145, '全局设置', 'fa-cog', 'admin', 'SystemSetting', 'system', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 13:57:25'),
(64, 0, '系统模块', 'fa fa-fw fa-cogs', 'admin', '', '', '', 1, '', 1, 10000, '2022-11-06 14:28:59', '2023-10-24 13:43:38'),
(69, 145, '菜单设置', 'fa-bars', 'admin', 'SystemMenu', 'index', '', 1, '', 1, 20, '2022-11-06 14:28:59', '2023-10-24 13:57:29'),
(72, 64, '权限管理', 'fa-users', 'admin', '', '', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(73, 72, '管理员', 'fa-user', 'admin', 'Manager', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(74, 72, '角色管理', 'fa-user-plus', 'admin', 'ManagerRole', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(75, 0, '系统主页', 'fa-home', 'admin', 'Index', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(76, 69, '菜单添加', 'fa-link', 'admin', 'SystemMenu', 'create', '', 2, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 13:49:44'),
(79, 69, '菜单删除', 'fa-link', 'admin', 'SystemMenu', 'delete', '', 2, '', 1, 30, '2022-11-06 14:28:59', '2023-10-24 13:49:45'),
(80, 69, '菜单修改', 'fa-link', 'admin', 'SystemMenu', 'update', '', 2, '', 1, 20, '2022-11-06 14:28:59', '2023-10-24 13:49:48'),
(81, 73, '管理员添加', 'fa-link', 'admin', 'Manager', 'create', '', 2, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(82, 74, '角色添加', 'fa-link', 'admin', 'ManagerRole', 'create', '', 2, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(83, 74, '角色修改', 'fa-link', 'admin', 'ManagerRole', 'update', '', 2, '', 1, 20, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(84, 74, '角色删除', 'fa-link', 'admin', 'ManagerRole', 'delete', '', 2, '', 1, 30, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(85, 73, '管理员修改', 'fa-link', 'admin', 'Manager', 'update', '', 2, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(86, 73, '管理员删除', 'fa-link', 'admin', 'Manager', 'delete', '', 2, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(99, 1, '系统设置', 'fa-cog', 'admin', 'SystemSetting', 'config', '', 1, '', 1, 20, '2022-11-06 14:28:59', '2023-10-24 13:57:08'),
(114, 1, '系统日志', 'fa-book', 'admin', 'SystemLog', 'index', '', 1, '', 1, 30, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(121, 114, '日志详情', 'fa-link', 'admin', 'SystemLog', 'detail', '', 2, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(122, 114, '日志清空', 'fa-link', 'admin', 'SystemLog', 'clear', '', 2, '', 1, 20, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(128, 75, '控制台', 'fa-dashboard', 'admin', 'Home', 'console', '', 1, '', 1, 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(134, 69, '菜单排序', 'fa-link', 'admin', 'SystemMenu', 'sort', '', 2, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 13:49:50'),
(136, 137, '系统信息', 'fa-link', 'admin', 'Index', 'system', '', 2, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(137, 157, '其他菜单', 'fa-link', 'admin', '', '', '', 2, '', 1, 100000, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(138, 137, '个人资料', 'fa-link', 'admin', 'Index', 'profile', '', 2, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(141, 75, 'UI组件', 'fa-pie-chart', 'admin', 'Home', 'components', '', 1, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(142, 69, '全部菜单', 'fa-link', 'admin', 'SystemMenu', 'get_all', '', 2, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 13:49:52'),
(143, 157, '公共权限', 'fa-link', 'admin', '', '', '', 2, '', 1, 10000, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(144, 143, '文本编辑', 'fa-link', 'admin', 'Editor', 'ueditor', '', 2, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(145, 64, '运维管理', 'fa-server', 'admin', '', '', '', 1, '', 1, 100, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(147, 143, '全部角色', 'fa-link', 'admin', 'ManagerRole', 'get_all', '', 2, '', 1, 100, '2023-03-15 14:17:55', '2023-10-24 10:34:03'),
(148, 137, '头像上传', 'fa-link', 'admin', 'Manager', 'avatar', '', 2, '', 1, 100, '2023-03-20 15:11:09', '2023-10-24 10:34:03'),
(149, 137, '退出登录', 'fa-link', 'admin', 'Index', 'logout', '', 2, '', 1, 100, '2023-03-21 10:46:54', '2023-10-24 10:34:03'),
(150, 1, '登录日志', 'fa-file-text', 'admin', 'SystemLoginLog', 'index', '', 1, '', 1, 100, '2023-03-21 11:55:24', '2023-10-24 10:34:03'),
(151, 150, '日志详情', 'fa-link', 'admin', 'SystemLoginLog', 'detail', '', 2, '', 1, 100, '2023-03-21 12:01:11', '2023-10-24 10:34:03'),
(152, 150, '日志清空', 'fa-link', 'admin', 'SystemLoginLog', 'clear', '', 2, '', 1, 100, '2023-03-21 12:01:22', '2023-10-24 10:34:03'),
(153, 157, '文件上传', 'fa-link', 'admin', '', '', '', 2, '', 1, 100, '2023-03-21 14:32:33', '2023-10-24 10:34:03'),
(154, 153, '图片上传', 'fa-link', 'admin', 'SystemUpload', 'image', '', 2, '', 1, 100, '2023-03-21 14:32:51', '2024-03-28 15:45:52'),
(155, 153, '文件上传', 'fa-link', 'admin', 'SystemUpload', 'file', '', 2, '', 1, 100, '2023-03-21 14:33:00', '2024-03-28 15:45:56'),
(156, 153, '文件检测', 'fa-link', 'admin', 'SystemUpload', 'check', '', 2, '', 1, 100, '2023-03-21 14:33:07', '2024-03-28 15:45:59'),
(157, 0, '系统菜单', 'fa-bars', 'admin', '', '', '', 2, '', 1, 100000, '2023-10-24 10:10:06', '2023-11-28 08:45:27'),
(158, 153, '切片上传', 'fa-link', 'admin', 'SystemUpload', 'slice', '', 2, '', 1, 100, '2024-03-28 15:44:57', '2024-03-28 15:44:57');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_setting`
--

CREATE TABLE `easy_system_setting` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '系统名称',
  `slogan` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '系统标语',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '测试文本',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统设置表';

--
-- 转存表中的数据 `easy_system_setting`
--

INSERT INTO `easy_system_setting` (`id`, `name`, `slogan`, `content`, `createTime`, `updateTime`) VALUES
(1, 'EASYADMIN', 'PHP后台快速开发系统', '111', '2023-10-24 10:33:41', '2023-10-24 10:37:57');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_upload`
--

CREATE TABLE `easy_system_upload` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `md5` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件MD5',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名称',
  `size` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '文件大小',
  `ext` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件后缀',
  `path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '保存位置',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文件上传表';

--
-- 转存表中的数据 `easy_system_upload`
--

INSERT INTO `easy_system_upload` (`id`, `md5`, `name`, `size`, `ext`, `path`, `createTime`, `updateTime`) VALUES
(1, '396814d705b2ceb75f487e5c63e9c6c4', '1.png', 6034, 'png', '/uploads/images/20230321/4caedcd42419e7f699c4434fd2b2dd89.png', '2023-03-21 15:47:06', '2023-10-20 13:52:16'),
(2, '8ddf582f610c68b1729111fd86d05ec1', '1.jpg', 329748, 'jpg', '/upload/image/20231024/47220acdd326647e029949627e49b197.jpg', '2023-10-24 10:00:52', '2023-10-24 10:00:52'),
(3, '628eebd9a0247ae4e336dcf3423eed05', '6.jpg', 113905, 'jpg', '/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg', '2023-10-24 10:07:44', '2023-10-24 10:07:44'),
(4, 'ecacf72ba64171c4f64cea6e0c2e1be4', '1.jpg', 277066, 'jpg', '/upload/image/20231218/6ad96658aae1eef280fd761e0ba61ae2.jpg', '2023-12-18 14:55:14', '2023-12-18 14:55:14'),
(6, '87ba150e7f8083c33572b20770357881', '1.png', 3310, 'png', '/upload/image/20240408/aa6762ebf6f902a578e66c9693816d43.png', '2024-04-08 16:58:55', '2024-04-08 16:58:55'),
(7, '11b86e1b496a5c31ec8082d71338ef88', '1.png', 3310, 'png', '/upload/image/20240408/e6ebed780447aac2213763e6391f0af6.png', '2024-04-08 16:59:03', '2024-04-08 16:59:03'),
(8, '3a94908f444c3bec293d3bb1a5bf405c', '1.png', 3310, 'png', '/upload/image/20240408/f50c1dca9f4cd382fe2f2cbc77eacac0.png', '2024-04-08 16:59:21', '2024-04-08 16:59:21'),
(9, '53bc98803ccb09a81df4d1299853efaa', '1.png', 3309, 'png', '/upload/image/20240408/f2d9385a1f6bdba45f818528302d33f5.png', '2024-04-08 16:59:27', '2024-04-08 16:59:27'),
(10, 'c9731c0cb436807306a1209b2c7d949c', '1.png', 3311, 'png', '/upload/image/20240408/0581b8c9f22d29d7740244ba2112be5d.png', '2024-04-08 17:00:01', '2024-04-08 17:00:01'),
(11, '4a196dd60d34111bbc69eac68af125ec', '2.jpg', 224779, 'jpg', '/upload/image/20240408/ef6a893e72e33f7c5742032c582d5c81.jpg', '2024-04-08 17:00:19', '2024-04-08 17:00:19'),
(12, '0c88d36ef4909652bdb12ef9b4b325a7', '5.2abb0bf1.mp4', 970263, 'mp4', '/upload/video/20240408/edcfe3f3084fe1cc76c3df9144b0a56c.mp4', '2024-04-08 17:03:38', '2024-04-08 17:03:38'),
(13, '74337e48216f38be269a170264dabda5', 'test.mp3', 3856713, 'mp3', '/upload/audio/20240408/59bf95117cd614dbf94b3498adf5133f.mp3', '2024-04-08 17:09:56', '2024-04-08 17:09:56'),
(14, '26ae9bea6b90e2285fda78d4fe256610', 'test.zip', 8179364, 'zip', '/upload/file/20240408/98f79c0ddce611d702b4e37155e8506d.zip', '2024-04-08 17:19:41', '2024-04-08 17:19:41');

--
-- 转储表的索引
--

--
-- 表的索引 `easy_manager`
--
ALTER TABLE `easy_manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account` (`account`);

--
-- 表的索引 `easy_manager_role`
--
ALTER TABLE `easy_manager_role`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_system_log`
--
ALTER TABLE `easy_system_log`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_system_login_log`
--
ALTER TABLE `easy_system_login_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`managerId`);

--
-- 表的索引 `easy_system_menu`
--
ALTER TABLE `easy_system_menu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_system_setting`
--
ALTER TABLE `easy_system_setting`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_system_upload`
--
ALTER TABLE `easy_system_upload`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `md5` (`md5`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `easy_manager`
--
ALTER TABLE `easy_manager`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `easy_manager_role`
--
ALTER TABLE `easy_manager_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `easy_system_log`
--
ALTER TABLE `easy_system_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=403;

--
-- 使用表AUTO_INCREMENT `easy_system_login_log`
--
ALTER TABLE `easy_system_login_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=39;

--
-- 使用表AUTO_INCREMENT `easy_system_menu`
--
ALTER TABLE `easy_system_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=159;

--
-- 使用表AUTO_INCREMENT `easy_system_setting`
--
ALTER TABLE `easy_system_setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `easy_system_upload`
--
ALTER TABLE `easy_system_upload`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
