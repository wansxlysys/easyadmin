-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2026-02-27 13:53:33
-- 服务器版本： 5.7.26-log
-- PHP 版本： 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `easyadmin_v8`
--

-- --------------------------------------------------------

--
-- 表的结构 `queue_failed`
--

CREATE TABLE `queue_failed` (
  `queueId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `queue` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '队列名称',
  `uniqid` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '唯一标识',
  `consumer` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '消费者',
  `payload` text COLLATE utf8mb4_unicode_ci COMMENT '队列数据',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='队执行失败表';

--
-- 转存表中的数据 `queue_failed`
--

INSERT INTO `queue_failed` (`queueId`, `queue`, `uniqid`, `consumer`, `payload`, `createTime`, `updateTime`) VALUES
(2, 'default', '6704ba0b0aad05f1626bd0dc04b214d1', 'app\\queue\\consumer\\MailConsumer@fire', '{\"method\":\"sendMail\",\"params\":{\"body\":\"测试邮件内容\",\"subject\":\"测试邮件主题\",\"address\":\"1628883533@qq.com\"},\"uniqid\":\"6704ba0b0aad05f1626bd0dc04b214d1\"}', '2026-01-14 13:49:02', '2026-01-14 13:49:02');

-- --------------------------------------------------------

--
-- 表的结构 `queue_jobs`
--

CREATE TABLE `queue_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '队列名称',
  `payload` longtext COLLATE utf8mb4_unicode_ci COMMENT '队列数据',
  `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '重试次数',
  `reserved` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '保留状态',
  `reserved_at` bigint(20) UNSIGNED DEFAULT '0' COMMENT '保留时间',
  `available_at` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '可用时间',
  `created_at` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='队列数据';

-- --------------------------------------------------------

--
-- 表的结构 `system_dict_data`
--

CREATE TABLE `system_dict_data` (
  `dataId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `dictId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '字典ID',
  `label` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典标签',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '字典数据',
  `style` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '样式类名',
  `isDefault` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '是否默认：Y-是，N-否',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '字典备注',
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典状态：Y-启用，N-禁用',
  `sort` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '字典排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统字典数据表';

--
-- 转存表中的数据 `system_dict_data`
--

INSERT INTO `system_dict_data` (`dataId`, `dictId`, `label`, `value`, `style`, `isDefault`, `remark`, `status`, `sort`, `createTime`, `updateTime`) VALUES
(1, 1, 'systemName', 'EasyAdmin', '', 'N', '系统LOGO展示文字', 'Y', 100, '2025-05-26 14:03:13', '2026-01-20 09:11:01'),
(3, 1, 'systemSlogan', 'PHP后台快速开发系统', '', 'N', '系统登录页面展示标语', 'Y', 100, '2026-01-07 10:00:34', '2026-01-20 09:11:25'),
(4, 3, 'mp4', 'video', '', 'Y', '视频', 'Y', 100, '2026-01-07 14:02:48', '2026-01-12 15:28:21'),
(5, 3, 'mov', 'video', '', 'Y', '视频', 'Y', 100, '2026-01-07 14:03:12', '2026-01-12 15:33:41'),
(6, 3, 'mp3', 'audio', '', 'Y', '音频', 'Y', 100, '2026-01-07 14:03:49', '2026-01-12 15:28:59'),
(7, 3, 'ogg', 'audio', '', 'Y', '音频', 'Y', 100, '2026-01-07 14:04:00', '2026-01-12 15:33:13'),
(8, 3, 'wav', 'audio', '', 'Y', '音频', 'Y', 100, '2026-01-07 14:04:07', '2026-01-12 15:30:18'),
(9, 3, 'jpeg', 'image', '', 'Y', '图片', 'Y', 100, '2026-01-07 14:04:27', '2026-01-12 15:30:23'),
(10, 3, 'jpg', 'image', '', 'Y', '图片', 'Y', 100, '2026-01-07 14:04:33', '2026-01-12 15:30:28'),
(11, 3, 'png', 'image', '', 'Y', '图片', 'Y', 100, '2026-01-07 14:04:37', '2026-01-12 15:30:31'),
(12, 3, 'gif', 'image', '', 'Y', '图片', 'Y', 100, '2026-01-07 14:04:41', '2026-01-12 15:30:37'),
(13, 3, 'webp', 'image', '', 'Y', '图片', 'Y', 100, '2026-01-07 14:04:47', '2026-01-12 15:30:41'),
(14, 3, 'pdf', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:05:09', '2026-01-12 15:30:45'),
(15, 3, 'doc', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:06:20', '2026-01-12 15:31:03'),
(16, 3, 'docx', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:06:28', '2026-01-12 15:31:30'),
(17, 3, 'xls', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:06:33', '2026-01-12 15:31:36'),
(18, 3, 'xlsx', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:06:40', '2026-01-12 15:31:41'),
(19, 3, 'ppt', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:06:45', '2026-01-12 15:31:48'),
(20, 3, 'pptx', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:06:51', '2026-01-12 15:31:52'),
(21, 3, 'txt', 'doc', '', 'Y', '文档', 'Y', 100, '2026-01-07 14:07:00', '2026-01-12 15:32:02'),
(22, 3, 'zip', 'zip', '', 'Y', '压缩包', 'Y', 100, '2026-01-07 14:07:45', '2026-01-12 15:32:07'),
(23, 3, 'tar', 'zip', '', 'Y', '压缩包', 'Y', 100, '2026-01-07 14:07:50', '2026-01-12 15:32:16'),
(24, 3, 'rar', 'zip', '', 'Y', '压缩包', 'Y', 100, '2026-01-07 14:07:54', '2026-01-12 15:32:22'),
(25, 3, '7z', 'zip', '', 'Y', '压缩包', 'Y', 100, '2026-01-07 14:07:59', '2026-01-12 15:32:26'),
(26, 4, 'host', 'smtp.qq.com', '', 'Y', '服务器地址', 'Y', 100, '2026-01-10 16:28:54', '2026-01-14 13:51:53'),
(27, 4, 'port', '465', '', 'Y', '服务器端口', 'Y', 100, '2026-01-10 16:31:19', '2026-01-10 16:31:26'),
(28, 4, 'password', 'iphxfarybutwdjdh', '', 'Y', '发送人授权码', 'Y', 100, '2026-01-10 16:29:27', '2026-01-10 16:33:20'),
(29, 4, 'username', '1628883533@qq.com', '', 'Y', '发送人账号', 'Y', 100, '2026-01-10 16:29:08', '2026-01-10 16:29:08'),
(30, 1, 'uploadLimit', '0', '', 'N', '上传文件大小限制，单位：mb，填 0 为不限制', 'Y', 100, '2026-01-20 09:10:36', '2026-01-20 13:55:14');

-- --------------------------------------------------------

--
-- 表的结构 `system_dict_type`
--

CREATE TABLE `system_dict_type` (
  `dictId` bigint(20) UNSIGNED NOT NULL COMMENT '字典ID',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典名称',
  `identify` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典标识',
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典状态：Y-启用，N-禁用',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '字典备注',
  `sort` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '字典排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统字典表';

--
-- 转存表中的数据 `system_dict_type`
--

INSERT INTO `system_dict_type` (`dictId`, `name`, `identify`, `status`, `remark`, `sort`, `createTime`, `updateTime`) VALUES
(1, '系统设置', 'system.info.config', 'Y', '系统信息设置', 10, '2025-05-26 11:32:00', '2026-02-07 09:29:42'),
(3, '文件类型', 'system.upload.type', 'Y', '上传文件类型', 30, '2026-01-07 14:02:15', '2026-02-06 17:35:18'),
(4, '邮箱设置', 'system.mail.config', 'Y', '邮箱发送设置', 20, '2026-01-10 16:28:21', '2026-02-06 17:35:14');

-- --------------------------------------------------------

--
-- 表的结构 `system_login_log`
--

CREATE TABLE `system_login_log` (
  `logId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `managerId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `message` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述信息',
  `userAgent` text COLLATE utf8mb4_unicode_ci COMMENT '用户代理',
  `loginIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT '1' COMMENT '登录状态：1-登录成功，2-登录失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统登录日志表';

--
-- 转存表中的数据 `system_login_log`
--

INSERT INTO `system_login_log` (`logId`, `managerId`, `message`, `userAgent`, `loginIp`, `status`, `createTime`, `updateTime`) VALUES
(52, 1, '登录失败，密码输入错误', NULL, '192.168.1.6', 2, '2026-01-20 13:55:47', '2026-01-20 13:55:47'),
(53, 1, '登录成功', NULL, '192.168.1.6', 1, '2026-01-20 13:55:52', '2026-01-20 13:55:52'),
(54, 1, '登录成功', NULL, '192.168.1.6', 1, '2026-01-22 10:48:29', '2026-01-22 10:48:29'),
(55, 10, '登录成功', NULL, '192.168.1.6', 1, '2026-01-22 11:45:51', '2026-01-22 11:45:51'),
(56, 1, '登录成功', NULL, '192.168.1.6', 1, '2026-01-23 14:14:27', '2026-01-23 14:14:27'),
(57, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-01-23 16:57:30', '2026-01-23 16:57:30'),
(58, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-01-27 15:36:07', '2026-01-27 15:36:07'),
(59, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-01-28 11:47:47', '2026-01-28 11:47:47'),
(60, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-01-31 09:47:22', '2026-01-31 09:47:22'),
(61, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-01-31 15:40:59', '2026-01-31 15:40:59'),
(62, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-02-04 09:55:05', '2026-02-04 09:55:05'),
(63, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-02-05 14:16:46', '2026-02-05 14:16:46'),
(64, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-02-07 09:13:26', '2026-02-07 09:13:26'),
(65, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-02-07 09:22:52', '2026-02-07 09:22:52'),
(66, 1, '登录成功', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '192.168.1.6', 1, '2026-02-26 09:07:07', '2026-02-26 09:07:07');

-- --------------------------------------------------------

--
-- 表的结构 `system_manager`
--

CREATE TABLE `system_manager` (
  `managerId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `roleId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色ID',
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员头像',
  `realName` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员姓名',
  `account` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员账号',
  `password` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员密码',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '管理员状态：1-正常，2-禁用，3-锁定',
  `isDelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '是否删除：Y-是，N-否',
  `loginError` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '失败次数',
  `loginTime` datetime DEFAULT NULL COMMENT '登录时间',
  `deleteTime` datetime DEFAULT NULL COMMENT '删除时间',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

--
-- 转存表中的数据 `system_manager`
--

INSERT INTO `system_manager` (`managerId`, `roleId`, `avatar`, `realName`, `account`, `password`, `status`, `isDelete`, `loginError`, `loginTime`, `deleteTime`, `createTime`, `updateTime`) VALUES
(1, 1, '/upload/image/20260112/1275f923063e22a77b64352a1f834c6e.jpg', '超级管理员', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'N', 0, '2026-02-26 09:07:07', NULL, '2022-11-06 14:29:39', '2026-02-26 09:07:07'),
(10, 5, '/upload/image/20260107/7f2b4b3accbd276096d9e334a5a2c4e6.jpg', '测试管理员', 'test', '098f6bcd4621d373cade4e832627b4f6', 1, 'N', 0, '2026-01-22 11:45:51', '2026-01-07 10:36:45', '2022-11-06 14:29:39', '2026-02-07 09:29:54');

-- --------------------------------------------------------

--
-- 表的结构 `system_manager_role`
--

CREATE TABLE `system_manager_role` (
  `roleId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `identify` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色标识',
  `permission` text COLLATE utf8mb4_unicode_ci COMMENT '菜单权限',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色备注',
  `level` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色级别',
  `isDelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '是否删除：Y-是，N-否',
  `deleteTime` datetime DEFAULT NULL COMMENT '删除时间',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';

--
-- 转存表中的数据 `system_manager_role`
--

INSERT INTO `system_manager_role` (`roleId`, `name`, `identify`, `permission`, `remark`, `level`, `isDelete`, `deleteTime`, `createTime`, `updateTime`) VALUES
(1, '超管角色', 'super', '75,128,141,144,148,154,155,72,73,81,85,86,74,82,83,84,147,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,143,153,156,158,169,170,137,136,138,149', '最高权限', 10, 'N', NULL, '2022-11-06 14:28:28', '2026-01-22 11:49:01'),
(5, '普通角色', 'common', '75,128,141,144,148,154,155,72,73,81,85,86,74,82,83,84,147,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,143,153,156,158,169,170,137,136,138,149', '普通权限', 20, 'N', NULL, '2022-11-06 14:28:28', '2026-01-22 11:49:06'),
(6, '部门角色', 'department', '75,128,141,72,73,81,85,86,74,82,83,84,147,157,143,153,156,158,169,170,137,136,138,149', '部门权限', 30, 'N', NULL, '2022-11-06 14:28:28', '2026-01-22 11:49:12');

-- --------------------------------------------------------

--
-- 表的结构 `system_menu`
--

CREATE TABLE `system_menu` (
  `menuId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `parentId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `url` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单URL',
  `identify` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限标识',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '菜单类型：1-菜单，2-按钮，3-外链',
  `link` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '打开方式：1-默认方式，2-当前窗口，3-新窗口',
  `record` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '日志记录：Y-开启，N-关闭',
  `sort` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统菜单表';

--
-- 转存表中的数据 `system_menu`
--

INSERT INTO `system_menu` (`menuId`, `parentId`, `name`, `icon`, `url`, `identify`, `type`, `link`, `target`, `record`, `sort`, `createTime`, `updateTime`) VALUES
(1, 0, '系统日志', 'fa-cogs', '', '', 1, '', 1, 'N', 20010, '2022-11-06 14:28:59', '2025-05-25 19:18:38'),
(2, 99, '设置添加', 'fa-cog', 'admin/SystemSetting/create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2025-05-15 20:42:32'),
(69, 145, '菜单管理', 'fa-bars', 'admin/SystemMenu/index', '', 1, '', 1, 'N', 30, '2022-11-06 14:28:59', '2025-05-26 11:13:36'),
(72, 0, '权限管理', 'fa-users', '', '', 1, '', 1, 'N', 20000, '2022-11-06 14:28:59', '2025-05-25 19:18:35'),
(73, 72, '管理员', 'fa-user', 'admin/SystemManager/index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:18:57'),
(74, 72, '角色管理', 'fa-user-plus', 'admin/SystemManagerRole/index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:19:07'),
(75, 0, '系统主页', 'fa-home', 'admin/SystemIndex/index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:17:46'),
(76, 69, '菜单添加', 'fa-link', 'admin/SystemMenu/create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 13:49:44'),
(79, 69, '菜单删除', 'fa-link', 'admin/SystemMenu/delete', '', 2, '', 1, 'Y', 30, '2022-11-06 14:28:59', '2023-10-24 13:49:45'),
(80, 69, '菜单修改', 'fa-link', 'admin/SystemMenu/update', '', 2, '', 1, 'Y', 20, '2022-11-06 14:28:59', '2023-10-24 13:49:48'),
(81, 73, '管理员添加', 'fa-link', 'admin/SystemManager/create', 'system.manager.create', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2026-02-04 09:58:46'),
(82, 74, '角色添加', 'fa-link', 'admin/SystemManagerRole/create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(83, 74, '角色修改', 'fa-link', 'admin/SystemManagerRole/update', '', 2, '', 1, 'Y', 20, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(84, 74, '角色删除', 'fa-link', 'admin/SystemManagerRole/delete', '', 2, '', 1, 'Y', 30, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(85, 73, '管理员修改', 'fa-link', 'admin/SystemManager/update', 'system.manager.update', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2026-02-04 09:58:54'),
(86, 73, '管理员删除', 'fa-link', 'admin/SystemManager/delete', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(99, 145, '系统设置', 'fa-cog', 'admin/SystemSetting/index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:20:26'),
(114, 1, '操作日志', 'fa-book', 'admin/SystemOperLog/index', '', 1, '', 1, 'N', 30, '2022-11-06 14:28:59', '2025-05-25 19:19:16'),
(121, 114, '日志详情', 'fa-link', 'admin/SystemOperLog/detail', '', 2, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:19:31'),
(122, 114, '日志清空', 'fa-link', 'admin/SystemOperLog/clear', '', 2, '', 1, 'Y', 20, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(128, 75, '控制台', 'fa-dashboard', 'admin/SystemIndex/console', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:18:50'),
(134, 69, '菜单排序', 'fa-link', 'admin/SystemMenu/sort', '', 2, '', 1, 'Y', 100, '2022-11-06 14:28:59', '2023-10-24 13:49:50'),
(136, 137, '系统信息', 'fa-link', 'admin/SystemIndex/system', '', 2, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-05-25 19:27:56'),
(137, 157, '其他菜单', 'fa-link', '', '', 2, '', 1, 'N', 100000, '2022-11-06 14:28:59', '2026-01-06 17:12:01'),
(138, 137, '个人资料', 'fa-link', 'admin/SystemIndex/profile', '', 2, '', 1, 'Y', 100, '2022-11-06 14:28:59', '2026-01-10 11:20:17'),
(141, 75, 'UI组件', 'fa-pie-chart', 'admin/SystemIndex/components', '', 1, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-05-25 19:18:53'),
(142, 69, '全部菜单', 'fa-link', 'admin/SystemMenu/getAll', '', 2, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-05-25 19:20:45'),
(143, 157, '公共权限', 'fa-link', '', '', 2, '', 1, 'N', 10000, '2022-11-06 14:28:59', '2025-05-25 19:30:33'),
(144, 0, '文本编辑', 'fa-link', 'admin/SystemEditor/ueditor', '', 2, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-12-27 15:01:40'),
(145, 0, '运维管理', 'fa-server', '', '', 1, '', 1, 'N', 20020, '2022-11-06 14:28:59', '2025-05-26 11:08:33'),
(147, 74, '角色列表', 'fa-link', 'admin/SystemManagerRole/getAll', '', 2, '', 1, 'N', 100, '2023-03-15 14:17:55', '2026-01-08 10:02:26'),
(148, 144, '头像上传', 'fa-link', 'admin/SystemManager/avatar', '', 2, '', 1, 'N', 100, '2023-03-20 15:11:09', '2025-12-27 15:02:08'),
(149, 137, '退出登录', 'fa-link', 'admin/SystemIndex/logout', '', 2, '', 1, 'N', 100, '2023-03-21 10:46:54', '2026-01-10 11:23:28'),
(150, 1, '登录日志', 'fa-file-text', 'admin/SystemLoginLog/index', '', 1, '', 1, 'N', 100, '2023-03-21 11:55:24', '2025-05-25 19:19:22'),
(151, 150, '日志详情', 'fa-link', 'admin/SystemLoginLog/detail', '', 2, '', 1, 'N', 100, '2023-03-21 12:01:11', '2025-05-25 19:19:41'),
(152, 150, '日志清空', 'fa-link', 'admin/SystemLoginLog/clear', '', 2, '', 1, 'Y', 100, '2023-03-21 12:01:22', '2023-10-24 10:34:03'),
(153, 143, '文件上传', 'fa-link', '', '', 2, '', 1, 'N', 100, '2023-03-21 14:32:33', '2026-01-10 11:29:34'),
(154, 144, '图片上传', 'fa-link', 'admin/SystemUpload/image', '', 2, '', 1, 'N', 100, '2023-03-21 14:32:51', '2025-12-27 15:01:49'),
(155, 144, '文件上传', 'fa-link', 'admin/SystemUpload/file', '', 2, '', 1, 'N', 100, '2023-03-21 14:33:00', '2025-12-27 15:01:56'),
(156, 153, '文件检测', 'fa-link', 'admin/SystemUpload/check', '', 2, '', 1, 'N', 100, '2023-03-21 14:33:07', '2025-05-25 19:30:27'),
(157, 0, '系统菜单', 'fa-bars', '', '', 2, '', 1, 'N', 90000, '2023-10-24 10:10:06', '2025-05-25 19:37:45'),
(158, 153, '文件修改', 'fa-link', 'admin/SystemUpload/rename', '', 2, '', 1, 'N', 100, '2024-03-28 15:44:57', '2025-12-27 13:46:49'),
(159, 99, '设置修改', 'fa-link', 'admin/SystemSetting/update', '', 2, '', 1, 'Y', 100, '2025-05-15 20:42:48', '2025-05-15 20:42:48'),
(160, 99, '设置删除', 'fa-link', 'admin/SystemSetting/delete', '', 2, '', 1, 'Y', 100, '2025-05-15 20:42:55', '2025-05-15 20:42:55'),
(161, 145, '字典管理', 'fa-book', 'admin/SystemDictType/index', '', 1, '', 1, 'N', 20, '2025-05-25 19:33:28', '2025-05-26 11:09:03'),
(162, 161, '字典添加', 'fa-link', 'admin/SystemDictType/create', '', 2, '', 1, 'Y', 100, '2025-05-25 19:33:39', '2025-05-26 11:10:28'),
(163, 161, '字典修改', 'fa-link', 'admin/SystemDictType/update', '', 2, '', 1, 'Y', 100, '2025-05-25 19:33:48', '2025-05-26 11:32:37'),
(164, 161, '字典删除', 'fa-link', 'admin/SystemDictType/delete', '', 2, '', 1, 'Y', 100, '2025-05-26 11:10:17', '2025-05-26 11:10:17'),
(165, 161, '字典数据', 'fa-link', 'admin/SystemDictData/index', '', 2, '', 1, 'N', 100, '2025-05-26 11:11:00', '2025-05-26 11:11:00'),
(166, 165, '数据添加', 'fa-link', 'admin/SystemDictData/create', '', 2, '', 1, 'Y', 100, '2025-05-26 11:11:20', '2025-05-26 11:11:20'),
(167, 165, '数据修改', 'fa-link', 'admin/SystemDictData/update', '', 2, '', 1, 'Y', 100, '2025-05-26 11:11:27', '2025-05-26 11:11:27'),
(168, 165, '数据删除', 'fa-link', 'admin/SystemDictData/delete', '', 2, '', 1, 'Y', 100, '2025-05-26 11:11:34', '2025-05-26 11:11:34'),
(169, 153, '文件列表', 'fa-link', 'admin/SystemUpload/list', '', 2, '', 1, 'N', 100, '2025-12-19 09:23:06', '2025-12-21 15:33:28'),
(170, 153, '文件上传', 'fa-link', 'admin/SystemUpload/upload', '', 2, '', 1, 'N', 100, '2025-12-19 09:39:39', '2025-12-19 09:39:39');

-- --------------------------------------------------------

--
-- 表的结构 `system_oper_log`
--

CREATE TABLE `system_oper_log` (
  `logId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `menuId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `managerId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `message` text COLLATE utf8mb4_unicode_ci COMMENT '操作描述',
  `costTime` float UNSIGNED NOT NULL DEFAULT '0' COMMENT '请求耗时',
  `userAgent` text COLLATE utf8mb4_unicode_ci COMMENT '用户代理',
  `requestIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求IP',
  `requestUrl` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `params` longtext COLLATE utf8mb4_unicode_ci COMMENT '请求参数',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '操作状态：1-操作成功，2-操作失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统日志表';

--
-- 转存表中的数据 `system_oper_log`
--

INSERT INTO `system_oper_log` (`logId`, `menuId`, `managerId`, `message`, `costTime`, `userAgent`, `requestIp`, `requestUrl`, `params`, `status`, `createTime`, `updateTime`) VALUES
(559, 122, 1, '清空成功', 0.103148, NULL, '192.168.1.6', '/admin/SystemOperLog/clear.html', '[]', 1, '2026-01-23 14:37:00', '2026-01-23 14:37:00'),
(560, 138, 1, '修改成功', 0.076809, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-23 14:42:23', '2026-01-23 14:42:23'),
(561, 85, 1, '修改成功', 0.094303, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-01-28 11:48:01', '2026-01-28 11:48:01'),
(562, 80, 1, '修改成功', 0.092018, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"73\",\"name\":\"管理员添加\",\"type\":\"2\",\"icon\":\"fa-link\",\"url\":\"admin\\/SystemManager\\/create\",\"link\":\"\",\"identify\":\"system.manager.create\",\"record\":\"Y\",\"target\":\"1\",\"sort\":\"10\",\"menuId\":\"81\"}', 1, '2026-02-04 09:58:46', '2026-02-04 09:58:46'),
(563, 80, 1, '修改成功', 0.090363, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"73\",\"name\":\"管理员修改\",\"type\":\"2\",\"icon\":\"fa-link\",\"url\":\"admin\\/SystemManager\\/update\",\"link\":\"\",\"identify\":\"system.manager.update\",\"record\":\"Y\",\"target\":\"1\",\"sort\":\"10\",\"menuId\":\"85\"}', 1, '2026-02-04 09:58:54', '2026-02-04 09:58:54'),
(564, 85, 1, '修改成功', 0.115782, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-02-06 16:57:07', '2026-02-06 16:57:07'),
(565, 85, 1, '修改成功', 0.079079, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-02-06 16:57:17', '2026-02-06 16:57:17'),
(566, 85, 1, '修改成功', 0.077139, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-02-06 16:57:18', '2026-02-06 16:57:18'),
(567, 163, 1, '修改成功', 0.07929, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"系统设置\",\"identify\":\"system.info.config\",\"remark\":\"系统全局设置\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"1\"}', 1, '2026-02-06 17:34:42', '2026-02-06 17:34:42'),
(568, 163, 1, '修改成功', 0.101777, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"系统设置\",\"identify\":\"system.info.config\",\"remark\":\"系统全局设置\",\"sort\":\"10\",\"status\":\"Y\",\"dictId\":\"1\"}', 1, '2026-02-06 17:35:11', '2026-02-06 17:35:11'),
(569, 163, 1, '修改成功', 0.079277, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"邮箱设置\",\"identify\":\"system.mail.config\",\"remark\":\"邮箱发送设置\",\"sort\":\"20\",\"status\":\"Y\",\"dictId\":\"4\"}', 1, '2026-02-06 17:35:14', '2026-02-06 17:35:14'),
(570, 163, 1, '修改成功', 0.116497, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"文件类型\",\"identify\":\"system.upload.type\",\"remark\":\"上传文件类型\",\"sort\":\"30\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-02-06 17:35:18', '2026-02-06 17:35:18'),
(571, 163, 1, '修改成功', 0.087662, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"系统设置\",\"identify\":\"system.info.config\",\"remark\":\"系统信息设置\",\"sort\":\"10\",\"status\":\"Y\",\"dictId\":\"1\"}', 1, '2026-02-06 17:35:24', '2026-02-06 17:35:24'),
(572, 163, 1, '修改成功', 0.101899, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"系统设置\",\"identify\":\"system.info.config\",\"remark\":\"系统信息设置\",\"sort\":\"10\",\"status\":\"Y\",\"dictId\":\"1\"}', 1, '2026-02-07 09:29:42', '2026-02-07 09:29:42'),
(573, 85, 1, '修改成功', 0.097293, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"5\",\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"10\"}', 1, '2026-02-07 09:29:54', '2026-02-07 09:29:54'),
(574, 85, 1, '修改成功', 0.09153, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-02-07 09:29:57', '2026-02-07 09:29:57');

-- --------------------------------------------------------

--
-- 表的结构 `system_setting`
--

CREATE TABLE `system_setting` (
  `settingId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设置分类',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设置名称',
  `identify` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设置标识',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '设置数据',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '设置备注',
  `sort` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '设置排序',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统设置表';

-- --------------------------------------------------------

--
-- 表的结构 `system_upload`
--

CREATE TABLE `system_upload` (
  `fileId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `managerId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `hash` char(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件hash',
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名称',
  `type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件类型：image-图片，audio-音频，video-视频，doc-文档，zip-压缩包',
  `size` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '文件大小',
  `path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '保存位置',
  `index` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上传分片',
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '上传状态：Y-已完成，N-未完成',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文件上传表';

--
-- 转存表中的数据 `system_upload`
--

INSERT INTO `system_upload` (`fileId`, `managerId`, `hash`, `name`, `type`, `size`, `path`, `index`, `status`, `createTime`, `updateTime`) VALUES
(6, 1, '7e5b1b87da3ad9581672260eae458d9e', '23.9MB.zip', 'zip', 24543864, '/upload/zip/20260107/1188e64749f1d18aacc20c8f21b3a3a5.zip', 11, 'Y', '2026-01-07 17:20:21', '2026-01-07 17:20:22'),
(7, 1, '26ae9bea6b90e2285fda78d4fe256610', '7.79MB.zip', 'zip', 8179364, '/upload/zip/20260107/2d9a253b7b19a9d04fc83bb9f6f072ee.zip', 3, 'Y', '2026-01-07 17:20:21', '2026-01-31 10:01:41'),
(8, 1, '05a6f21f1064c45b2b9f5cfaf541144e', '2.jpg', 'image', 229185, '/upload/image/20260107/7f2b4b3accbd276096d9e334a5a2c4e6.jpg', 0, 'Y', '2026-01-07 17:20:36', '2026-01-07 17:20:36'),
(9, 1, '8ddf582f610c68b1729111fd86d05ec1', '1.jpg', 'image', 329748, '/upload/image/20260107/fc57bf040ed46b8e46d99e62714eadd4.jpg', 0, 'Y', '2026-01-07 17:20:36', '2026-01-12 15:37:15'),
(10, 1, '628eebd9a0247ae4e336dcf3423eed05', '6.jpg', 'image', 113905, '/upload/image/20260107/7a8f2d15e3d298cd12feb59572c2f4e5.jpg', 0, 'Y', '2026-01-07 17:20:36', '2026-01-07 17:20:36'),
(11, 1, 'a04a5e875119005077ff73d27109c450', 'e9078617052fe37689efe3699b534cd.jpg', 'image', 6608311, '/upload/image/20260107/eb2c001e3a7ac376a80792865e6e2419.jpg', 3, 'Y', '2026-01-07 17:20:36', '2026-01-10 09:18:11'),
(12, 1, 'c9d3cc0c061c6fef29e8fc48946e5ad4', 'xss.pdf', 'doc', 515, '/upload/doc/20260107/7aa6f66190c2f287bfba9b0e2f984898.pdf', 0, 'Y', '2026-01-07 17:21:05', '2026-01-07 17:21:05'),
(13, 1, '60074ee8fa55d9b247389aa4b7c6e501', '空表格.xlsx', 'doc', 10050, '/upload/doc/20260107/816a7529e64fc67c4209ed5a263fa08d.xlsx', 0, 'Y', '2026-01-07 17:21:05', '2026-01-07 17:21:05'),
(14, 1, '4f4988eddb5a0efb1fd20238c5adda21', '有图片文档.docx', 'doc', 565642, '/upload/doc/20260107/829a6a37034c5cfc8db9eb98cdbf0def.docx', 0, 'Y', '2026-01-07 17:21:05', '2026-01-07 17:21:05'),
(15, 1, 'e1edca1d29089138ffedc55a1574b529', '13.7MB.mp4', 'video', 14426736, '/upload/video/20260107/9691e7e5e12743ebf468c6c136b219ef.mp4', 6, 'Y', '2026-01-07 17:21:17', '2026-01-07 17:21:18'),
(16, 1, '8493788d0f3c54adfaa065358e5f2296', '32.2MB.mp4', 'video', 33773387, '/upload/video/20260107/0411c4cb1907be0a04833464baf32373.mp4', 16, 'Y', '2026-01-07 17:21:17', '2026-01-07 17:21:20'),
(17, 1, '15b721f642553a1cc1875084d852e878', '6.76MB.mp4', 'video', 7096570, '/upload/video/20260107/6fbe5b3e6ad5459610d6f5e25974a9fa.mp4', 3, 'Y', '2026-01-07 17:21:17', '2026-01-07 17:21:18'),
(18, 1, '7fc49e07c3c653634af0388714294b6a', '0.071MB.mp3', 'audio', 73395, '/upload/audio/20260107/c33f84e07403782726fea53b398cd31c.mp3', 0, 'Y', '2026-01-07 17:21:30', '2026-01-07 17:21:30'),
(19, 1, '74337e48216f38be269a170264dabda5', '3.76MB.mp3', 'audio', 3856713, '/upload/audio/20260107/7e077d903947a4a68b159446ddd3e58c.mp3', 1, 'Y', '2026-01-07 17:21:30', '2026-01-07 17:21:31'),
(20, 1, '83ab4018af750183a0598b84155f39a1', '14.6MB.wav', 'audio', 15400040, '/upload/audio/20260107/c124cb9581f80198bf42e8bb38324f29.wav', 7, 'Y', '2026-01-07 17:21:30', '2026-01-07 17:40:52'),
(24, 10, '628eebd9a0247ae4e336dcf3423eed05', '6.jpg', 'image', 113905, '/upload/image/20260108/3d264d32f3acac55ae09b5d5e815be9a.jpg', 0, 'Y', '2026-01-08 09:17:27', '2026-01-08 09:17:27'),
(28, 10, '4f242c6df32174ad5fb626a19f4a6bc7', '134MB.mp4', 'video', 141494824, '/upload/video/20260108/53634183c0105d5113cc04b11bda1f14.mp4', 67, 'Y', '2026-01-08 10:05:09', '2026-01-08 10:05:28'),
(31, 1, '53610ff916c70b86cc3a028c2442638f', '1GB.zip', 'zip', 1391924697, '/upload/zip/20260109/93ece758fabbb5c9e9515d46038d0d6c.zip', 663, 'Y', '2026-01-09 09:19:12', '2026-01-10 09:05:29'),
(53, 1, '5bc6b18f1a39acf3e07c199aab464235', '3GB.zip', 'zip', 3500432407, '/upload/zip/20260110/b7e5408bc21e2b3cf4db54d8d00279c5.zip', 1669, 'Y', '2026-01-10 10:20:33', '2026-01-10 10:31:45'),
(55, 1, '4afa9551cb213f2ffa8d1ebc8d22056c', '134MB.zip', 'zip', 141243741, '/upload/zip/20260110/f5306b2155700b508fecf384405bfcce.zip', 67, 'Y', '2026-01-10 10:35:23', '2026-01-10 10:35:42'),
(56, 1, '09e4b3b1fa93fb4c272cbc2b32f56ab1', 'png.jpg', 'image', 299407, '/upload/image/20260112/8f9d676f7c31b0fd81e3697647472c3f.jpg', 0, 'Y', '2026-01-12 15:37:31', '2026-01-12 15:37:32'),
(57, 1, 'e5d6ad8b882e551b820b6fed1f508f7f', 'bae86896d7c70a259655f88a2b9c096.jpg', 'image', 4729918, '/upload/image/20260112/520b872b8698c48d3468481460442113.jpg', 2, 'Y', '2026-01-12 15:37:31', '2026-01-12 15:37:32'),
(58, 1, '96ed7ee935cfa75e68133d4bf6bcdd2c', 'ok.png', 'image', 799322, '/upload/image/20260112/f674e2c59e65b5d8be4bf52d92b13711.png', 0, 'Y', '2026-01-12 15:37:31', '2026-01-12 15:37:32'),
(59, 1, '56a53cfe19ff3dd1bd39d4bd000f759d', 'f87cc47d58510d48d99da6cf8fe0ad8.png', 'image', 139527, '/upload/image/20260112/9eee3ce8e8db6580f534a73809a3f0b2.png', 0, 'Y', '2026-01-12 15:37:48', '2026-01-12 15:37:48'),
(60, 1, '9d763437c428b3b05d60a15c64a66e53', '13.jpg', 'image', 25038, '/upload/image/20260112/1275f923063e22a77b64352a1f834c6e.jpg', 0, 'Y', '2026-01-12 15:38:17', '2026-01-16 10:01:51'),
(61, 1, 'beb95285d2741f5437d370fea46a67b9', 'idCard2.jpg', 'image', 227940, '/upload/image/20260112/a1ed43022a6094de2d9519723c94a3e9.jpg', 0, 'Y', '2026-01-12 15:38:18', '2026-01-12 15:38:18');

--
-- 转储表的索引
--

--
-- 表的索引 `queue_failed`
--
ALTER TABLE `queue_failed`
  ADD PRIMARY KEY (`queueId`);

--
-- 表的索引 `queue_jobs`
--
ALTER TABLE `queue_jobs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_dict_data`
--
ALTER TABLE `system_dict_data`
  ADD PRIMARY KEY (`dataId`);

--
-- 表的索引 `system_dict_type`
--
ALTER TABLE `system_dict_type`
  ADD PRIMARY KEY (`dictId`);

--
-- 表的索引 `system_login_log`
--
ALTER TABLE `system_login_log`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `manager_id` (`managerId`);

--
-- 表的索引 `system_manager`
--
ALTER TABLE `system_manager`
  ADD PRIMARY KEY (`managerId`),
  ADD UNIQUE KEY `account` (`account`);

--
-- 表的索引 `system_manager_role`
--
ALTER TABLE `system_manager_role`
  ADD PRIMARY KEY (`roleId`);

--
-- 表的索引 `system_menu`
--
ALTER TABLE `system_menu`
  ADD PRIMARY KEY (`menuId`);

--
-- 表的索引 `system_oper_log`
--
ALTER TABLE `system_oper_log`
  ADD PRIMARY KEY (`logId`);

--
-- 表的索引 `system_setting`
--
ALTER TABLE `system_setting`
  ADD PRIMARY KEY (`settingId`);

--
-- 表的索引 `system_upload`
--
ALTER TABLE `system_upload`
  ADD PRIMARY KEY (`fileId`),
  ADD KEY `hash` (`hash`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `queue_failed`
--
ALTER TABLE `queue_failed`
  MODIFY `queueId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `queue_jobs`
--
ALTER TABLE `queue_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_dict_data`
--
ALTER TABLE `system_dict_data`
  MODIFY `dataId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=31;

--
-- 使用表AUTO_INCREMENT `system_dict_type`
--
ALTER TABLE `system_dict_type`
  MODIFY `dictId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '字典ID', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `system_login_log`
--
ALTER TABLE `system_login_log`
  MODIFY `logId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=67;

--
-- 使用表AUTO_INCREMENT `system_manager`
--
ALTER TABLE `system_manager`
  MODIFY `managerId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `system_manager_role`
--
ALTER TABLE `system_manager_role`
  MODIFY `roleId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `system_menu`
--
ALTER TABLE `system_menu`
  MODIFY `menuId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=171;

--
-- 使用表AUTO_INCREMENT `system_oper_log`
--
ALTER TABLE `system_oper_log`
  MODIFY `logId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=575;

--
-- 使用表AUTO_INCREMENT `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `settingId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `system_upload`
--
ALTER TABLE `system_upload`
  MODIFY `fileId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
