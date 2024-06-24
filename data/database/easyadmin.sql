-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-06-24 15:08:02
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
-- 数据库： `easyadmin_v4`
--

-- --------------------------------------------------------

--
-- 表的结构 `easy_manager`
--

CREATE TABLE `easy_manager` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `roleId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色ID',
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员头像',
  `realName` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员姓名',
  `account` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员账号',
  `password` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员密码',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '管理员状态：1-正常，2-禁用，3-锁定',
  `isDelete` tinyint(1) UNSIGNED NOT NULL DEFAULT '2' COMMENT '是否删除：1-是，2-否',
  `loginError` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '失败次数',
  `loginTime` datetime DEFAULT NULL COMMENT '登录时间',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

--
-- 转存表中的数据 `easy_manager`
--

INSERT INTO `easy_manager` (`id`, `roleId`, `avatar`, `realName`, `account`, `password`, `status`, `isDelete`, `loginError`, `loginTime`, `createTime`, `updateTime`) VALUES
(1, 1, '/upload/image/20231024/47220acdd326647e029949627e49b197.jpg', '黎明', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 2, 0, '2024-06-24 15:05:17', '2022-11-06 14:29:39', '2024-06-24 15:05:17'),
(10, 6, '/upload/image/20231024/cafe4106049840244c2ffd34e7d0de4a.jpg', '测试管理员', 'test', '098f6bcd4621d373cade4e832627b4f6', 1, 2, 0, NULL, '2022-11-06 14:29:39', '2024-04-09 17:40:07');

-- --------------------------------------------------------

--
-- 表的结构 `easy_manager_role`
--

CREATE TABLE `easy_manager_role` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `identify` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色标识',
  `permission` text COLLATE utf8mb4_unicode_ci COMMENT '菜单权限',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色备注',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色排序',
  `isDelete` tinyint(1) UNSIGNED NOT NULL DEFAULT '2' COMMENT '是否删除：1-是，2-否',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';

--
-- 转存表中的数据 `easy_manager_role`
--

INSERT INTO `easy_manager_role` (`id`, `name`, `identify`, `permission`, `remark`, `sort`, `isDelete`, `createTime`, `updateTime`) VALUES
(1, '超级管理员', 'super', '75,128,141,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149', '拥有最高权限', 0, 2, '2022-11-06 14:28:28', '2024-03-28 15:45:03'),
(5, '普通管理员', 'common', '75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149', '普通权限', 0, 2, '2022-11-06 14:28:28', '2024-06-24 15:07:35'),
(6, '部门管理员', 'department', '75,128,141,158,64,1,99,114,121,122,150,151,152,72,73,81,85,86,74,82,83,84,145,2,69,76,80,79,134,142,157,153,154,155,156,143,144,147,137,136,138,148,149', '部门管理员', 0, 2, '2022-11-06 14:28:28', '2023-11-28 09:04:09');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_log`
--

CREATE TABLE `easy_system_log` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `menuId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `managerId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '操作描述',
  `requestIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求IP',
  `requestUrl` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `params` longtext COLLATE utf8mb4_unicode_ci COMMENT '请求参数',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '操作状态：1-操作成功，2-操作失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';

--
-- 转存表中的数据 `easy_system_log`
--

INSERT INTO `easy_system_log` (`id`, `menuId`, `managerId`, `description`, `requestIp`, `requestUrl`, `params`, `status`, `createTime`, `updateTime`) VALUES
(7, 122, 1, '清空成功', '192.168.124.24', '/admin/system_log/clear.html', '[]', 1, '2024-04-10 09:21:53', '2024-04-10 09:21:53'),
(8, 148, 1, '上传成功', '192.168.124.24', '/admin/manager/avatar.html', '[]', 1, '2024-04-10 09:45:37', '2024-04-10 09:45:37'),
(9, 148, 1, '上传成功', '192.168.124.24', '/admin/manager/avatar.html', '[]', 1, '2024-04-10 09:45:47', '2024-04-10 09:45:47'),
(10, 99, 1, '修改成功', '192.168.124.24', '/admin/system_setting/config.html', '{\"content\":\"111\"}', 1, '2024-04-10 09:47:42', '2024-04-10 09:47:42'),
(11, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:52:58', '2024-05-16 09:52:58'),
(12, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:00', '2024-05-16 09:53:00'),
(13, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:02', '2024-05-16 09:53:02'),
(14, 150, 1, '获取成功', '192.168.124.24', '/admin/system_login_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:06', '2024-05-16 09:53:06'),
(15, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:06', '2024-05-16 09:53:06'),
(16, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:16', '2024-05-16 09:53:16'),
(17, 74, 1, '获取成功', '192.168.124.24', '/admin/manager_role/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:24', '2024-05-16 09:53:24'),
(18, 147, 1, '获取成功', '192.168.124.24', '/admin/manager_role/get_all.html', '[]', 1, '2024-05-16 09:53:25', '2024-05-16 09:53:25'),
(19, 73, 1, '获取成功', '192.168.124.24', '/admin/manager/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:26', '2024-05-16 09:53:26'),
(20, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:27', '2024-05-16 09:53:27'),
(21, 114, 1, '获取成功', '192.168.124.24', '/admin/system_log/index.html?page=1&limit=15', '[]', 1, '2024-05-16 09:53:33', '2024-05-16 09:53:33'),
(22, 138, 1, '修改成功', '192.168.124.24', '/admin/index/profile.html', '{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"123456\",\"id\":\"1\"}', 1, '2024-06-24 14:12:54', '2024-06-24 14:12:54'),
(23, 138, 1, '修改成功', '192.168.124.24', '/admin/index/profile.html', '{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"admin\",\"id\":\"1\"}', 1, '2024-06-24 14:13:12', '2024-06-24 14:13:12'),
(24, 138, 1, '修改成功', '192.168.124.24', '/admin/index/profile.html', '{\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"admin\",\"id\":\"1\"}', 1, '2024-06-24 14:13:46', '2024-06-24 14:13:46'),
(25, 148, 1, '上传成功', '192.168.124.24', '/admin/manager/avatar.html', '[]', 1, '2024-06-24 14:20:48', '2024-06-24 14:20:48'),
(26, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:21:01', '2024-06-24 14:21:01'),
(27, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:21:09', '2024-06-24 14:21:09'),
(28, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:21:36', '2024-06-24 14:21:36'),
(29, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:26:38', '2024-06-24 14:26:38'),
(30, 81, 1, '姓名已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:28:40', '2024-06-24 14:28:40'),
(31, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:28:58', '2024-06-24 14:28:58'),
(32, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:29:04', '2024-06-24 14:29:04'),
(33, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:29:11', '2024-06-24 14:29:11'),
(34, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:30:55', '2024-06-24 14:30:55'),
(35, 81, 1, 'account规则错误', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:53:03', '2024-06-24 14:53:03'),
(36, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:53:23', '2024-06-24 14:53:23'),
(37, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:53:36', '2024-06-24 14:53:36'),
(38, 81, 1, '账号已存在', '192.168.124.24', '/admin/manager/create.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"admin\",\"account\":\"admin\",\"password\":\"admin\",\"status\":\"1\"}', 2, '2024-06-24 14:57:22', '2024-06-24 14:57:22'),
(39, 85, 1, '账号已存在', '192.168.124.24', '/admin/manager/update.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"id\":\"1\"}', 2, '2024-06-24 14:57:54', '2024-06-24 14:57:54'),
(40, 84, 1, '禁止删除，角色下存在管理员', '192.168.124.24', '/admin/manager_role/delete.html', '{\"id\":\"1\"}', 2, '2024-06-24 15:07:29', '2024-06-24 15:07:29'),
(41, 84, 1, '禁止删除，角色下存在管理员', '192.168.124.24', '/admin/manager_role/delete.html', '{\"id\":\"6\"}', 2, '2024-06-24 15:07:32', '2024-06-24 15:07:32'),
(42, 84, 1, '删除成功', '192.168.124.24', '/admin/manager_role/delete.html', '{\"id\":\"5\"}', 1, '2024-06-24 15:07:35', '2024-06-24 15:07:35');

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
(54, 1, '登录成功', '192.168.124.24', 1, '2024-04-10 09:19:45', '2024-04-10 09:19:45'),
(55, 1, '登录成功', '192.168.124.24', 1, '2024-05-16 10:04:41', '2024-05-16 10:04:41'),
(56, 1, '登录成功', '192.168.124.24', 1, '2024-05-16 10:04:54', '2024-05-16 10:04:54'),
(57, 1, '登录成功', '192.168.124.24', 1, '2024-05-16 10:20:45', '2024-05-16 10:20:45'),
(58, 1, '登录成功', '192.168.124.24', 1, '2024-06-19 14:25:11', '2024-06-19 14:25:11'),
(59, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 13:55:25', '2024-06-24 13:55:25'),
(60, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 14:12:40', '2024-06-24 14:12:40'),
(61, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 14:12:49', '2024-06-24 14:12:49'),
(62, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 14:13:08', '2024-06-24 14:13:08'),
(63, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 14:13:19', '2024-06-24 14:13:19'),
(64, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 14:13:24', '2024-06-24 14:13:24'),
(65, 1, '登录成功', '192.168.124.24', 1, '2024-06-24 15:05:17', '2024-06-24 15:05:17');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_menu`
--

CREATE TABLE `easy_system_menu` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `parentId` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `module` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单模块',
  `controller` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单控制器',
  `action` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单操作',
  `params` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求参数',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '菜单类型：1-菜单，2-按钮，3-外链',
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '打开方式：1-默认方式，2-当前窗口，3-新窗口',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '菜单排序',
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
(1, 'EASYADMIN', 'PHP后台快速开发系统', '111', '2023-10-24 10:33:41', '2024-04-10 09:47:42');

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
(15, '80c2c41f3a2799654cda00b82db30638', '2fc7d7ee5554e8f4e83abde52ab4021.jpg', 2094067, 'jpg', '/upload/image/20240409/17f4673180f6bb655deebd941dc4e755.jpg', '2024-04-09 11:54:49', '2024-04-09 11:54:49'),
(16, '26ae9bea6b90e2285fda78d4fe256610', 'test.zip', 8179364, 'zip', '/upload/file/20240409/26ae9bea6b90e2285fda78d4fe256610.zip', '2024-04-09 14:09:29', '2024-04-09 14:09:29'),
(17, '396814d705b2ceb75f487e5c63e9c6c4', '1.png', 6034, 'png', '/upload/image/20240410/f582520d44d7ae0ceb798fb588ab3428.png', '2024-04-10 09:45:37', '2024-04-10 09:45:37'),
(18, '9853d6db42392f5bedd2b7fa8a396c4f', '1.png', 3310, 'png', '/upload/image/20240410/7d1aaeb4627793f5366c84fa8f0adf8a.png', '2024-04-10 09:46:43', '2024-04-10 09:46:43');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=43;

--
-- 使用表AUTO_INCREMENT `easy_system_login_log`
--
ALTER TABLE `easy_system_login_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=66;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
