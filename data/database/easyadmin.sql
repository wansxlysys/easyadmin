-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2026-01-17 08:39:35
-- 服务器版本： 5.7.26-log
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
  `label` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字典标签',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '字典数据',
  `style` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字典类名',
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
(1, 1, '热门', 'hot', 'layui-bg-blue', 'Y', '热门新闻标签', 'Y', 100, '2025-05-26 14:03:13', '2026-01-07 10:02:51'),
(2, 2, '铂金', 'bj', 'bule', 'Y', '铂金等级', 'Y', 100, '2025-05-26 14:17:09', '2025-05-29 10:29:44'),
(3, 1, '推荐', 'rec', 'layui-bg-green', 'N', '推荐新闻标签', 'Y', 100, '2026-01-07 10:00:34', '2026-01-07 10:22:50'),
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
(29, 4, 'username', '1628883533@qq.com', '', 'Y', '发送人账号', 'Y', 100, '2026-01-10 16:29:08', '2026-01-10 16:29:08');

-- --------------------------------------------------------

--
-- 表的结构 `system_dict_type`
--

CREATE TABLE `system_dict_type` (
  `dictId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
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
(1, '新闻标签', 'newsTag', 'Y', '新闻标签', 100, '2025-05-26 11:32:00', '2026-01-07 10:00:18'),
(2, '用户等级', 'userLevel', 'Y', '用户等级', 100, '2025-05-26 14:08:47', '2025-05-26 14:08:47'),
(3, '文件类型', 'system.upload.type', 'Y', '上传文件类型', 100, '2026-01-07 14:02:15', '2026-01-07 16:04:52'),
(4, '邮箱设置', 'system.mail.config', 'Y', '邮箱发送设置', 100, '2026-01-10 16:28:21', '2026-01-10 16:28:21'),
(5, '系统设置', 'system.info.config', 'Y', '系统信息设置', 100, '2026-01-15 15:52:54', '2026-01-15 15:53:00');

-- --------------------------------------------------------

--
-- 表的结构 `system_login_log`
--

CREATE TABLE `system_login_log` (
  `logId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `managerId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `message` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述信息',
  `loginIp` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT '1' COMMENT '登录状态：1-登录成功，2-登录失败',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统登录日志表';

--
-- 转存表中的数据 `system_login_log`
--

INSERT INTO `system_login_log` (`logId`, `managerId`, `message`, `loginIp`, `status`, `createTime`, `updateTime`) VALUES
(1, 1, '登录成功', '127.0.0.1', 1, '2025-05-25 18:12:05', '2025-05-25 18:12:05'),
(2, 1, '登录成功', '127.0.0.1', 1, '2025-05-26 11:05:20', '2025-05-26 11:05:20'),
(3, 1, '登录成功', '127.0.0.1', 1, '2025-05-29 10:28:48', '2025-05-29 10:28:48'),
(4, 1, '登录成功', '127.0.0.1', 1, '2025-07-16 16:38:39', '2025-07-16 16:38:39'),
(5, 1, '登录成功', '127.0.0.1', 1, '2025-07-28 14:20:05', '2025-07-28 14:20:05'),
(6, 1, '登录成功', '127.0.0.1', 1, '2025-09-10 15:10:11', '2025-09-10 15:10:11'),
(7, 1, '登录成功', '192.168.1.6', 1, '2025-12-11 11:17:02', '2025-12-11 11:17:02'),
(8, 1, '登录失败，密码输入错误', '192.168.1.6', 1, '2025-12-13 11:38:49', '2025-12-13 11:38:49'),
(9, 1, '登录成功', '192.168.1.6', 1, '2025-12-13 11:39:02', '2025-12-13 11:39:02'),
(10, 1, '登录失败，密码输入错误', '192.168.1.6', 1, '2025-12-13 11:39:13', '2025-12-13 11:39:13'),
(11, 1, '登录成功', '192.168.1.6', 1, '2025-12-13 11:39:26', '2025-12-13 11:39:26'),
(12, 1, '登录失败，密码输入错误', '192.168.1.6', 1, '2025-12-13 11:39:38', '2025-12-13 11:39:38'),
(13, 1, '登录失败，管理员已被锁定', '192.168.1.6', 1, '2025-12-13 11:39:45', '2025-12-13 11:39:45'),
(14, 1, '登录失败，密码输入错误', '192.168.1.6', 1, '2025-12-13 11:41:19', '2025-12-13 11:41:19'),
(15, 1, '登录成功', '192.168.1.6', 1, '2025-12-13 11:41:26', '2025-12-13 11:41:26'),
(16, 1, '登录成功', '192.168.1.6', 1, '2025-12-15 10:17:54', '2025-12-15 10:17:54'),
(17, 1, '登录成功', '192.168.1.6', 1, '2025-12-19 09:22:12', '2025-12-19 09:22:12'),
(18, 1, '登录成功', '127.0.0.1', 1, '2025-12-22 08:30:35', '2025-12-22 08:30:35'),
(19, 1, '登录成功', '127.0.0.1', 1, '2025-12-25 08:38:06', '2025-12-25 08:38:06'),
(20, 1, '登录成功', '192.168.1.6', 1, '2025-12-25 14:52:44', '2025-12-25 14:52:44'),
(21, 1, '登录成功', '192.168.1.6', 1, '2026-01-06 14:39:18', '2026-01-06 14:39:18'),
(22, 1, '登录成功', '192.168.1.6', 1, '2026-01-06 16:28:57', '2026-01-06 16:28:57'),
(23, 1, '登录成功', '192.168.1.6', 1, '2026-01-07 11:56:16', '2026-01-07 11:56:16'),
(24, 1, '登录成功', '192.168.1.6', 1, '2026-01-07 17:19:56', '2026-01-07 17:19:56'),
(25, 10, '登录成功', '192.168.1.6', 1, '2026-01-08 09:11:43', '2026-01-08 09:11:43'),
(26, 1, '登录成功', '192.168.1.6', 1, '2026-01-08 13:42:13', '2026-01-08 13:42:13'),
(27, 1, '登录成功', '192.168.1.6', 1, '2026-01-09 14:05:02', '2026-01-09 14:05:02'),
(28, 1, '登录成功', '192.168.1.6', 1, '2026-01-10 11:23:34', '2026-01-10 11:23:34'),
(29, 1, '登录成功', '192.168.1.6', 1, '2026-01-10 11:30:00', '2026-01-10 11:30:00'),
(30, 1, '登录成功', '192.168.1.6', 1, '2026-01-10 14:37:20', '2026-01-10 14:37:20'),
(31, 1, '登录成功', '192.168.1.6', 1, '2026-01-12 08:38:14', '2026-01-12 08:38:14'),
(32, 1, '登录成功', '192.168.1.6', 1, '2026-01-14 10:48:41', '2026-01-14 10:48:41'),
(33, 1, '登录成功', '192.168.1.6', 1, '2026-01-15 09:19:53', '2026-01-15 09:19:53'),
(34, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:10:09', '2026-01-16 15:10:09'),
(35, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:34:27', '2026-01-16 15:34:27'),
(36, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:36:46', '2026-01-16 15:36:46'),
(37, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:48:52', '2026-01-16 15:48:52'),
(38, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:49:55', '2026-01-16 15:49:55'),
(39, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:50:21', '2026-01-16 15:50:21'),
(40, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:50:45', '2026-01-16 15:50:45'),
(41, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 15:51:04', '2026-01-16 15:51:04'),
(42, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 16:00:43', '2026-01-16 16:00:43'),
(43, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 16:01:12', '2026-01-16 16:01:12'),
(44, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 16:01:24', '2026-01-16 16:01:24'),
(45, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 16:02:51', '2026-01-16 16:02:51'),
(46, 1, '登录成功', '192.168.1.6', 1, '2026-01-16 16:03:00', '2026-01-16 16:03:00');

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
(1, 1, '/upload/image/20260112/1275f923063e22a77b64352a1f834c6e.jpg', '超级管理员', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'N', 0, '2026-01-16 16:03:00', NULL, '2022-11-06 14:29:39', '2026-01-16 16:03:00'),
(10, 6, '/upload/image/20260107/7f2b4b3accbd276096d9e334a5a2c4e6.jpg', '测试管理员', 'test', '098f6bcd4621d373cade4e832627b4f6', 1, 'N', 0, '2026-01-08 09:11:43', '2026-01-07 10:36:45', '2022-11-06 14:29:39', '2026-01-16 11:12:34');

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
  `sort` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色排序',
  `isDelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT '是否删除：Y-是，N-否',
  `deleteTime` datetime DEFAULT NULL COMMENT '删除时间',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员角色表';

--
-- 转存表中的数据 `system_manager_role`
--

INSERT INTO `system_manager_role` (`roleId`, `name`, `identify`, `permission`, `remark`, `sort`, `isDelete`, `deleteTime`, `createTime`, `updateTime`) VALUES
(1, '超级管理员', 'super', '75,128,141,144,148,154,155,72,73,81,85,86,74,82,83,84,147,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,143,153,156,158,169,170,137,136,138,149', '拥有最高权限', 10, 'N', NULL, '2022-11-06 14:28:28', '2026-01-12 09:39:21'),
(5, '普通管理员', 'common', '75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149', '普通权限', 20, 'N', NULL, '2022-11-06 14:28:28', '2025-05-15 21:17:31'),
(6, '部门管理员', 'department', '75,128,141,72,73,81,85,86,74,82,83,84,157,153,156,158,169,170,143,147,137,136,138,149', '部门管理员', 30, 'N', NULL, '2022-11-06 14:28:28', '2026-01-08 09:12:45');

-- --------------------------------------------------------

--
-- 表的结构 `system_menu`
--

CREATE TABLE `system_menu` (
  `menuId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `parentId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `module` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单模块',
  `controller` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单控制器',
  `action` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单操作',
  `params` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求参数',
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

INSERT INTO `system_menu` (`menuId`, `parentId`, `name`, `icon`, `module`, `controller`, `action`, `params`, `type`, `link`, `target`, `record`, `sort`, `createTime`, `updateTime`) VALUES
(1, 0, '系统日志', 'fa-cogs', '', '', '', '', 1, '', 1, 'N', 20010, '2022-11-06 14:28:59', '2025-05-25 19:18:38'),
(2, 99, '设置添加', 'fa-cog', 'admin', 'SystemSetting', 'create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2025-05-15 20:42:32'),
(69, 145, '菜单管理', 'fa-bars', 'admin', 'SystemMenu', 'index', '', 1, '', 1, 'N', 30, '2022-11-06 14:28:59', '2025-05-26 11:13:36'),
(72, 0, '权限管理', 'fa-users', '', '', '', '', 1, '', 1, 'N', 20000, '2022-11-06 14:28:59', '2025-05-25 19:18:35'),
(73, 72, '管理员', 'fa-user', 'admin', 'SystemManager', 'index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:18:57'),
(74, 72, '角色管理', 'fa-user-plus', 'admin', 'SystemManagerRole', 'index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:19:07'),
(75, 0, '系统主页', 'fa-home', 'admin', 'SystemIndex', 'index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:17:46'),
(76, 69, '菜单添加', 'fa-link', 'admin', 'SystemMenu', 'create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 13:49:44'),
(79, 69, '菜单删除', 'fa-link', 'admin', 'SystemMenu', 'delete', '', 2, '', 1, 'Y', 30, '2022-11-06 14:28:59', '2023-10-24 13:49:45'),
(80, 69, '菜单修改', 'fa-link', 'admin', 'SystemMenu', 'update', '', 2, '', 1, 'Y', 20, '2022-11-06 14:28:59', '2023-10-24 13:49:48'),
(81, 73, '管理员添加', 'fa-link', 'admin', 'SystemManager', 'create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(82, 74, '角色添加', 'fa-link', 'admin', 'SystemManagerRole', 'create', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(83, 74, '角色修改', 'fa-link', 'admin', 'SystemManagerRole', 'update', '', 2, '', 1, 'Y', 20, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(84, 74, '角色删除', 'fa-link', 'admin', 'SystemManagerRole', 'delete', '', 2, '', 1, 'Y', 30, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(85, 73, '管理员修改', 'fa-link', 'admin', 'SystemManager', 'update', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(86, 73, '管理员删除', 'fa-link', 'admin', 'SystemManager', 'delete', '', 2, '', 1, 'Y', 10, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(99, 145, '系统设置', 'fa-cog', 'admin', 'SystemSetting', 'index', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:20:26'),
(114, 1, '操作日志', 'fa-book', 'admin', 'SystemOperLog', 'index', '', 1, '', 1, 'N', 30, '2022-11-06 14:28:59', '2025-05-25 19:19:16'),
(121, 114, '日志详情', 'fa-link', 'admin', 'SystemOperLog', 'detail', '', 2, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:19:31'),
(122, 114, '日志清空', 'fa-link', 'admin', 'SystemOperLog', 'clear', '', 2, '', 1, 'Y', 20, '2022-11-06 14:28:59', '2023-10-24 10:34:03'),
(128, 75, '控制台', 'fa-dashboard', 'admin', 'SystemIndex', 'console', '', 1, '', 1, 'N', 10, '2022-11-06 14:28:59', '2025-05-25 19:18:50'),
(134, 69, '菜单排序', 'fa-link', 'admin', 'SystemMenu', 'sort', '', 2, '', 1, 'Y', 100, '2022-11-06 14:28:59', '2023-10-24 13:49:50'),
(136, 137, '系统信息', 'fa-link', 'admin', 'SystemIndex', 'system', '', 2, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-05-25 19:27:56'),
(137, 157, '其他菜单', 'fa-link', 'admin', '', '', '', 2, '', 1, 'N', 100000, '2022-11-06 14:28:59', '2026-01-06 17:12:01'),
(138, 137, '个人资料', 'fa-link', 'admin', 'SystemIndex', 'profile', '', 2, '', 1, 'Y', 100, '2022-11-06 14:28:59', '2026-01-10 11:20:17'),
(141, 75, 'UI组件', 'fa-pie-chart', 'admin', 'SystemIndex', 'components', '', 1, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-05-25 19:18:53'),
(142, 69, '全部菜单', 'fa-link', 'admin', 'SystemMenu', 'getAll', '', 2, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-05-25 19:20:45'),
(143, 157, '公共权限', 'fa-link', 'admin', '', '', '', 2, '', 1, 'N', 10000, '2022-11-06 14:28:59', '2025-05-25 19:30:33'),
(144, 0, '文本编辑', 'fa-link', 'admin', 'SystemEditor', 'ueditor', '', 2, '', 1, 'N', 100, '2022-11-06 14:28:59', '2025-12-27 15:01:40'),
(145, 0, '运维管理', 'fa-server', '', '', '', '', 1, '', 1, 'N', 20020, '2022-11-06 14:28:59', '2025-05-26 11:08:33'),
(147, 74, '角色列表', 'fa-link', 'admin', 'SystemManagerRole', 'getAll', '', 2, '', 1, 'N', 100, '2023-03-15 14:17:55', '2026-01-08 10:02:26'),
(148, 144, '头像上传', 'fa-link', 'admin', 'SystemManager', 'avatar', '', 2, '', 1, 'N', 100, '2023-03-20 15:11:09', '2025-12-27 15:02:08'),
(149, 137, '退出登录', 'fa-link', 'admin', 'SystemIndex', 'logout', '', 2, '', 1, 'N', 100, '2023-03-21 10:46:54', '2026-01-10 11:23:28'),
(150, 1, '登录日志', 'fa-file-text', 'admin', 'SystemLoginLog', 'index', '', 1, '', 1, 'N', 100, '2023-03-21 11:55:24', '2025-05-25 19:19:22'),
(151, 150, '日志详情', 'fa-link', 'admin', 'SystemLoginLog', 'detail', '', 2, '', 1, 'N', 100, '2023-03-21 12:01:11', '2025-05-25 19:19:41'),
(152, 150, '日志清空', 'fa-link', 'admin', 'SystemLoginLog', 'clear', '', 2, '', 1, 'Y', 100, '2023-03-21 12:01:22', '2023-10-24 10:34:03'),
(153, 143, '文件上传', 'fa-link', 'admin', '', '', '', 2, '', 1, 'N', 100, '2023-03-21 14:32:33', '2026-01-10 11:29:34'),
(154, 144, '图片上传', 'fa-link', 'admin', 'SystemUpload', 'image', '', 2, '', 1, 'N', 100, '2023-03-21 14:32:51', '2025-12-27 15:01:49'),
(155, 144, '文件上传', 'fa-link', 'admin', 'SystemUpload', 'file', '', 2, '', 1, 'N', 100, '2023-03-21 14:33:00', '2025-12-27 15:01:56'),
(156, 153, '文件检测', 'fa-link', 'admin', 'SystemUpload', 'check', '', 2, '', 1, 'N', 100, '2023-03-21 14:33:07', '2025-05-25 19:30:27'),
(157, 0, '系统菜单', 'fa-bars', '', '', '', '', 2, '', 1, 'N', 90000, '2023-10-24 10:10:06', '2025-05-25 19:37:45'),
(158, 153, '文件修改', 'fa-link', 'admin', 'SystemUpload', 'rename', '', 2, '', 1, 'N', 100, '2024-03-28 15:44:57', '2025-12-27 13:46:49'),
(159, 99, '设置修改', 'fa-link', 'admin', 'SystemSetting', 'update', '', 2, '', 1, 'Y', 100, '2025-05-15 20:42:48', '2025-05-15 20:42:48'),
(160, 99, '设置删除', 'fa-link', 'admin', 'SystemSetting', 'delete', '', 2, '', 1, 'Y', 100, '2025-05-15 20:42:55', '2025-05-15 20:42:55'),
(161, 145, '字典管理', 'fa-book', 'admin', 'SystemDictType', 'index', '', 1, '', 1, 'N', 20, '2025-05-25 19:33:28', '2025-05-26 11:09:03'),
(162, 161, '字典添加', 'fa-link', 'admin', 'SystemDictType', 'create', '', 2, '', 1, 'Y', 100, '2025-05-25 19:33:39', '2025-05-26 11:10:28'),
(163, 161, '字典修改', 'fa-link', 'admin', 'SystemDictType', 'update', '', 2, '', 1, 'Y', 100, '2025-05-25 19:33:48', '2025-05-26 11:32:37'),
(164, 161, '字典删除', 'fa-link', 'admin', 'SystemDictType', 'delete', '', 2, '', 1, 'Y', 100, '2025-05-26 11:10:17', '2025-05-26 11:10:17'),
(165, 161, '字典数据', 'fa-link', 'admin', 'SystemDictData', 'index', '', 2, '', 1, 'N', 100, '2025-05-26 11:11:00', '2025-05-26 11:11:00'),
(166, 165, '数据添加', 'fa-link', 'admin', 'SystemDictData', 'create', '', 2, '', 1, 'Y', 100, '2025-05-26 11:11:20', '2025-05-26 11:11:20'),
(167, 165, '数据修改', 'fa-link', 'admin', 'SystemDictData', 'update', '', 2, '', 1, 'Y', 100, '2025-05-26 11:11:27', '2025-05-26 11:11:27'),
(168, 165, '数据删除', 'fa-link', 'admin', 'SystemDictData', 'delete', '', 2, '', 1, 'Y', 100, '2025-05-26 11:11:34', '2025-05-26 11:11:34'),
(169, 153, '文件列表', 'fa-link', 'admin', 'SystemUpload', 'list', '', 2, '', 1, 'N', 100, '2025-12-19 09:23:06', '2025-12-21 15:33:28'),
(170, 153, '文件上传', 'fa-link', 'admin', 'SystemUpload', 'upload', '', 2, '', 1, 'N', 100, '2025-12-19 09:39:39', '2025-12-19 09:39:39');

-- --------------------------------------------------------

--
-- 表的结构 `system_oper_log`
--

CREATE TABLE `system_oper_log` (
  `logId` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `menuId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `managerId` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `message` text COLLATE utf8mb4_unicode_ci COMMENT '操作描述',
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

INSERT INTO `system_oper_log` (`logId`, `menuId`, `managerId`, `message`, `requestIp`, `requestUrl`, `params`, `status`, `createTime`, `updateTime`) VALUES
(118, 122, 1, '清空成功', '127.0.0.1', '/admin/SystemOperLog/clear.html', '[]', 1, '2025-05-25 14:20:49', '2025-05-25 14:20:49'),
(119, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:13:38', '2025-05-25 19:13:38'),
(120, 99, 1, '获取成功', '127.0.0.1', '/admin/SystemSetting/index.html?page=1&limit=15', '[]', 1, '2025-05-25 19:13:39', '2025-05-25 19:13:39'),
(121, 150, 1, '获取成功', '127.0.0.1', '/admin/SystemLoginLog/index.html?page=1&limit=15', '[]', 1, '2025-05-25 19:13:41', '2025-05-25 19:13:41'),
(122, 114, 1, '获取成功', '127.0.0.1', '/admin/SystemOperLog/index.html?page=1&limit=15', '[]', 1, '2025-05-25 19:13:41', '2025-05-25 19:13:41'),
(123, 114, 1, '获取成功', '127.0.0.1', '/admin/SystemOperLog/index.html?page=1&limit=15', '[]', 1, '2025-05-25 19:14:05', '2025-05-25 19:14:05'),
(124, 150, 1, '获取成功', '127.0.0.1', '/admin/SystemLoginLog/index.html?page=1&limit=15', '[]', 1, '2025-05-25 19:14:05', '2025-05-25 19:14:05'),
(125, 114, 1, '获取成功', '127.0.0.1', '/admin/SystemOperLog/index.html?page=1&limit=15', '[]', 1, '2025-05-25 19:14:06', '2025-05-25 19:14:06'),
(126, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:14:49', '2025-05-25 19:14:49'),
(127, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:16:28', '2025-05-25 19:16:28'),
(128, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:16:30', '2025-05-25 19:16:30'),
(129, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"系统主页\",\"icon\":\"fa-home\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"75\"}', 1, '2025-05-25 19:16:33', '2025-05-25 19:16:33'),
(130, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:16:34', '2025-05-25 19:16:34'),
(131, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:16:35', '2025-05-25 19:16:35'),
(132, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:17:44', '2025-05-25 19:17:44'),
(133, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"系统主页\",\"icon\":\"fa-home\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"75\"}', 1, '2025-05-25 19:17:46', '2025-05-25 19:17:46'),
(134, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:17:47', '2025-05-25 19:17:47'),
(135, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:17:48', '2025-05-25 19:17:48'),
(136, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:17:53', '2025-05-25 19:17:53'),
(137, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:31', '2025-05-25 19:18:31'),
(138, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:34', '2025-05-25 19:18:34'),
(139, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"权限管理\",\"icon\":\"fa-users\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20000\",\"menuId\":\"72\"}', 1, '2025-05-25 19:18:35', '2025-05-25 19:18:35'),
(140, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:36', '2025-05-25 19:18:36'),
(141, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:37', '2025-05-25 19:18:37'),
(142, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"系统日志\",\"icon\":\"fa-cogs\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20010\",\"menuId\":\"1\"}', 1, '2025-05-25 19:18:38', '2025-05-25 19:18:38'),
(143, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:39', '2025-05-25 19:18:39'),
(144, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:41', '2025-05-25 19:18:41'),
(145, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"运维管理\",\"icon\":\"fa-server\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20020\",\"menuId\":\"145\"}', 1, '2025-05-25 19:18:42', '2025-05-25 19:18:42'),
(146, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:43', '2025-05-25 19:18:43'),
(147, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:44', '2025-05-25 19:18:44'),
(148, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"系统菜单\",\"icon\":\"fa-bars\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20020\",\"menuId\":\"157\"}', 1, '2025-05-25 19:18:45', '2025-05-25 19:18:45'),
(149, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:45', '2025-05-25 19:18:45'),
(150, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:49', '2025-05-25 19:18:49'),
(151, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"75\",\"name\":\"控制台\",\"icon\":\"fa-dashboard\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"console\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"128\"}', 1, '2025-05-25 19:18:50', '2025-05-25 19:18:50'),
(152, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:50', '2025-05-25 19:18:50'),
(153, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:52', '2025-05-25 19:18:52'),
(154, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"75\",\"name\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"components\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"141\"}', 1, '2025-05-25 19:18:53', '2025-05-25 19:18:53'),
(155, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:54', '2025-05-25 19:18:54'),
(156, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:56', '2025-05-25 19:18:56'),
(157, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"72\",\"name\":\"管理员\",\"icon\":\"fa-user\",\"module\":\"admin\",\"controller\":\"SystemManager\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"73\"}', 1, '2025-05-25 19:18:57', '2025-05-25 19:18:57'),
(158, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:18:58', '2025-05-25 19:18:58'),
(159, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:18:59', '2025-05-25 19:18:59'),
(160, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:19:06', '2025-05-25 19:19:06'),
(161, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"72\",\"name\":\"角色管理\",\"icon\":\"fa-user-plus\",\"module\":\"admin\",\"controller\":\"SystemManagerRole\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"74\"}', 1, '2025-05-25 19:19:07', '2025-05-25 19:19:07'),
(162, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:19:08', '2025-05-25 19:19:08'),
(163, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:19:14', '2025-05-25 19:19:14'),
(164, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"1\",\"name\":\"操作日志\",\"icon\":\"fa-book\",\"module\":\"admin\",\"controller\":\"SystemOperLog\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"30\",\"menuId\":\"114\"}', 1, '2025-05-25 19:19:16', '2025-05-25 19:19:16'),
(165, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:19:17', '2025-05-25 19:19:17'),
(166, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:19:22', '2025-05-25 19:19:22'),
(167, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"1\",\"name\":\"登录日志\",\"icon\":\"fa-file-text\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"150\"}', 1, '2025-05-25 19:19:22', '2025-05-25 19:19:22'),
(168, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:19:23', '2025-05-25 19:19:23'),
(169, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:19:30', '2025-05-25 19:19:30'),
(170, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"114\",\"name\":\"日志详情\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemOperLog\",\"action\":\"detail\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"121\"}', 1, '2025-05-25 19:19:31', '2025-05-25 19:19:31'),
(171, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:19:33', '2025-05-25 19:19:33'),
(172, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:19:40', '2025-05-25 19:19:40'),
(173, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"150\",\"name\":\"日志详情\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"detail\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"151\"}', 1, '2025-05-25 19:19:41', '2025-05-25 19:19:41'),
(174, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:19:44', '2025-05-25 19:19:44'),
(175, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:20:07', '2025-05-25 19:20:07'),
(176, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:20:24', '2025-05-25 19:20:24'),
(177, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"系统设置\",\"icon\":\"fa-cog\",\"module\":\"admin\",\"controller\":\"SystemSetting\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10\",\"menuId\":\"99\"}', 1, '2025-05-25 19:20:26', '2025-05-25 19:20:26'),
(178, 69, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/index.html', '[]', 1, '2025-05-25 19:20:27', '2025-05-25 19:20:27'),
(179, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:20:36', '2025-05-25 19:20:36'),
(180, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"菜单设置\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"SystemMenu\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"20\",\"menuId\":\"69\"}', 1, '2025-05-25 19:20:38', '2025-05-25 19:20:38'),
(181, 142, 1, '获取成功', '127.0.0.1', '/admin/SystemMenu/getAll.html', '[]', 1, '2025-05-25 19:20:45', '2025-05-25 19:20:45'),
(182, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"69\",\"name\":\"全部菜单\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemMenu\",\"action\":\"getAll\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"142\"}', 1, '2025-05-25 19:20:45', '2025-05-25 19:20:45'),
(183, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"157\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"153\"}', 1, '2025-05-25 19:27:23', '2025-05-25 19:27:23'),
(184, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"系统信息\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"system\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"136\"}', 1, '2025-05-25 19:27:56', '2025-05-25 19:27:56'),
(185, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"头像上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemManager\",\"action\":\"avatar\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"148\"}', 1, '2025-05-25 19:29:32', '2025-05-25 19:29:32'),
(186, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"退出登录\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"logout\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"149\"}', 1, '2025-05-25 19:29:45', '2025-05-25 19:29:45'),
(187, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"143\",\"name\":\"文本编辑\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemEditor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"144\"}', 1, '2025-05-25 19:30:03', '2025-05-25 19:30:03'),
(188, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"图片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"image\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"154\"}', 1, '2025-05-25 19:30:17', '2025-05-25 19:30:17'),
(189, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"file\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"155\"}', 1, '2025-05-25 19:30:23', '2025-05-25 19:30:23'),
(190, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件检测\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"check\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"156\"}', 1, '2025-05-25 19:30:27', '2025-05-25 19:30:27'),
(191, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"157\",\"name\":\"公共权限\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"10000\",\"menuId\":\"143\"}', 1, '2025-05-25 19:30:33', '2025-05-25 19:30:33'),
(192, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"切片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"slice\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"record\":\"2\",\"sort\":\"100\",\"menuId\":\"158\"}', 1, '2025-05-25 19:30:37', '2025-05-25 19:30:37'),
(193, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"0\",\"name\":\"字典管理\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-25 19:33:28', '2025-05-25 19:33:28'),
(194, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"161\",\"name\":\"字典类型\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-25 19:33:39', '2025-05-25 19:33:39'),
(195, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-25 19:33:48', '2025-05-25 19:33:48'),
(196, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"字典管理\",\"icon\":\"fa-book\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"161\"}', 1, '2025-05-25 19:36:35', '2025-05-25 19:36:35'),
(197, 83, 1, '修改成功', '127.0.0.1', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,161,162,163,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}', 1, '2025-05-25 19:36:42', '2025-05-25 19:36:42'),
(198, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"161\",\"sort\":\"20020\"}', 1, '2025-05-25 19:37:05', '2025-05-25 19:37:05'),
(199, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"157\",\"sort\":\"90000\"}', 1, '2025-05-25 19:37:45', '2025-05-25 19:37:45'),
(200, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"145\",\"sort\":\"20030\"}', 1, '2025-05-25 19:37:55', '2025-05-25 19:37:55'),
(201, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-book-open\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}', 1, '2025-05-25 19:38:25', '2025-05-25 19:38:25'),
(202, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典类型\",\"icon\":\"fa-folder-open\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}', 1, '2025-05-25 19:39:28', '2025-05-25 19:39:28'),
(203, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典类型\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}', 1, '2025-05-25 19:40:04', '2025-05-25 19:40:04'),
(204, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-book-open\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}', 1, '2025-05-25 19:40:14', '2025-05-25 19:40:14'),
(205, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 11:05:25', '2025-05-26 11:05:25'),
(206, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 11:05:34', '2025-05-26 11:05:34'),
(207, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 11:06:08', '2025-05-26 11:06:08'),
(208, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"字典管理\",\"icon\":\"fa-book\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20020\",\"menuId\":\"161\"}', 1, '2025-05-26 11:08:24', '2025-05-26 11:08:24'),
(209, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"145\",\"sort\":\"20020\"}', 1, '2025-05-26 11:08:33', '2025-05-26 11:08:33'),
(210, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"69\",\"sort\":\"30\"}', 1, '2025-05-26 11:08:43', '2025-05-26 11:08:43'),
(211, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"161\",\"sort\":\"20\"}', 1, '2025-05-26 11:08:46', '2025-05-26 11:08:46'),
(212, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"字典管理\",\"icon\":\"fa-book\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20\",\"menuId\":\"161\"}', 1, '2025-05-26 11:09:03', '2025-05-26 11:09:03'),
(213, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典添加\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}', 1, '2025-05-26 11:09:27', '2025-05-26 11:09:27'),
(214, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典修改\",\"icon\":\"fa-book-open\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}', 1, '2025-05-26 11:09:39', '2025-05-26 11:09:39'),
(215, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典添加\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}', 1, '2025-05-26 11:09:43', '2025-05-26 11:09:43'),
(216, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"161\",\"name\":\"字典删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-26 11:10:17', '2025-05-26 11:10:17'),
(217, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}', 1, '2025-05-26 11:10:25', '2025-05-26 11:10:25'),
(218, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"162\"}', 1, '2025-05-26 11:10:28', '2025-05-26 11:10:28'),
(219, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"161\",\"name\":\"字典数据\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-26 11:11:00', '2025-05-26 11:11:00'),
(220, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"165\",\"name\":\"数据添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-26 11:11:20', '2025-05-26 11:11:20'),
(221, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"165\",\"name\":\"数据修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-26 11:11:27', '2025-05-26 11:11:27'),
(222, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"165\",\"name\":\"数据删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictData\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-05-26 11:11:34', '2025-05-26 11:11:34'),
(223, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"菜单管理\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"SystemMenu\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"30\",\"menuId\":\"69\"}', 1, '2025-05-26 11:13:36', '2025-05-26 11:13:36'),
(224, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 11:27:52', '2025-05-26 11:27:52'),
(225, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 11:27:55', '2025-05-26 11:27:55'),
(226, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 11:28:00', '2025-05-26 11:28:00'),
(227, 162, 1, '添加成功', '127.0.0.1', '/admin/SystemDictType/create.html', '{\"name\":\"新闻类型\",\"identify\":\"newsType\",\"remark\":\"\",\"sort\":\"100\",\"status\":\"1\"}', 1, '2025-05-26 11:32:00', '2025-05-26 11:32:00'),
(228, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"161\",\"name\":\"字典修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemDictType\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"163\"}', 1, '2025-05-26 11:32:37', '2025-05-26 11:32:37'),
(229, 163, 1, '修改成功', '127.0.0.1', '/admin/SystemDictType/update.html', '{\"name\":\"新闻类型\",\"identify\":\"newsType\",\"remark\":\"测试\\n111\",\"sort\":\"100\",\"status\":\"1\",\"dictId\":\"1\"}', 1, '2025-05-26 11:35:44', '2025-05-26 11:35:44'),
(230, 164, 1, '账号未授权访问', '127.0.0.1', '/admin/SystemDictType/delete.html', '{\"dictId\":\"1\"}', 2, '2025-05-26 11:39:10', '2025-05-26 11:39:10'),
(231, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 13:38:47', '2025-05-26 13:38:47'),
(232, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 13:38:59', '2025-05-26 13:38:59'),
(233, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 13:39:01', '2025-05-26 13:39:01'),
(234, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 13:46:41', '2025-05-26 13:46:41'),
(235, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-26 13:46:45', '2025-05-26 13:46:45'),
(236, 83, 1, '修改成功', '127.0.0.1', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}', 1, '2025-05-26 13:50:48', '2025-05-26 13:50:48'),
(237, 166, 1, '添加成功', '127.0.0.1', '/admin/SystemDictData/create.html', '{\"label\":\"热门\",\"value\":\"hot\",\"style\":\"red\",\"isDefault\":\"2\",\"remark\":\"\",\"sort\":\"100\",\"status\":\"1\"}', 1, '2025-05-26 14:03:13', '2025-05-26 14:03:13'),
(238, 167, 1, '修改成功', '127.0.0.1', '/admin/SystemDictData/update.html', '{\"label\":\"热门\",\"value\":\"hot\",\"style\":\"red\",\"isDefault\":\"2\",\"remark\":\"热门新闻标签\",\"sort\":\"100\",\"status\":\"1\",\"dataId\":\"1\"}', 1, '2025-05-26 14:06:26', '2025-05-26 14:06:26'),
(239, 163, 1, '修改成功', '127.0.0.1', '/admin/SystemDictType/update.html', '{\"name\":\"新闻标签\",\"identify\":\"newsTag\",\"remark\":\"新闻标签\",\"sort\":\"100\",\"status\":\"1\",\"dictId\":\"1\"}', 1, '2025-05-26 14:06:45', '2025-05-26 14:06:45'),
(240, 162, 1, '添加成功', '127.0.0.1', '/admin/SystemDictType/create.html', '{\"name\":\"用户等级\",\"identify\":\"userLevel\",\"remark\":\"用户等级\",\"sort\":\"100\",\"status\":\"1\"}', 1, '2025-05-26 14:08:47', '2025-05-26 14:08:47'),
(241, 166, 1, '添加成功', '127.0.0.1', '/admin/SystemDictData/create.html', '{\"label\":\"铂金\",\"value\":\"pt\",\"style\":\"bule\",\"isDefault\":\"2\",\"remark\":\"铂金等级\",\"sort\":\"100\",\"status\":\"1\",\"dictId\":\"2\"}', 1, '2025-05-26 14:17:09', '2025-05-26 14:17:09'),
(242, 167, 1, '修改成功', '127.0.0.1', '/admin/SystemDictData/update.html', '{\"label\":\"铂金\",\"value\":\"bj\",\"style\":\"bule\",\"isDefault\":\"2\",\"remark\":\"铂金等级\",\"sort\":\"100\",\"status\":\"1\",\"dataId\":\"2\"}', 1, '2025-05-29 10:29:45', '2025-05-29 10:29:45'),
(243, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:30:31', '2025-05-29 10:30:31'),
(244, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:30:32', '2025-05-29 10:30:32'),
(245, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:30:38', '2025-05-29 10:30:38'),
(246, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:30:42', '2025-05-29 10:30:42'),
(247, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:30:44', '2025-05-29 10:30:44'),
(248, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:30:45', '2025-05-29 10:30:45'),
(249, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:24', '2025-05-29 10:32:24'),
(250, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:28', '2025-05-29 10:32:28'),
(251, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:30', '2025-05-29 10:32:30'),
(252, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:32', '2025-05-29 10:32:32'),
(253, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:32', '2025-05-29 10:32:32'),
(254, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:33', '2025-05-29 10:32:33'),
(255, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:34', '2025-05-29 10:32:34'),
(256, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:36', '2025-05-29 10:32:36'),
(257, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:40', '2025-05-29 10:32:40'),
(258, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:42', '2025-05-29 10:32:42'),
(259, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:50', '2025-05-29 10:32:50'),
(260, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:52', '2025-05-29 10:32:52'),
(261, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:54', '2025-05-29 10:32:54'),
(262, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:32:58', '2025-05-29 10:32:58'),
(263, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:33:01', '2025-05-29 10:33:01'),
(264, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:33:03', '2025-05-29 10:33:03'),
(265, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:33:06', '2025-05-29 10:33:06'),
(266, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:44:01', '2025-05-29 10:44:01'),
(267, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-05-29 10:45:30', '2025-05-29 10:45:30'),
(268, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-16 16:39:00', '2025-07-16 16:39:00'),
(269, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:11', '2025-07-26 09:59:11'),
(270, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:16', '2025-07-26 09:59:16'),
(271, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:25', '2025-07-26 09:59:25'),
(272, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:26', '2025-07-26 09:59:26'),
(273, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:27', '2025-07-26 09:59:27'),
(274, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:31', '2025-07-26 09:59:31'),
(275, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-26 09:59:39', '2025-07-26 09:59:39'),
(276, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-28 14:20:08', '2025-07-28 14:20:08'),
(277, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-07-28 14:20:14', '2025-07-28 14:20:14'),
(278, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"145\",\"name\":\"工作流程\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-07-28 14:20:59', '2025-07-28 14:20:59'),
(279, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"169\",\"sort\":\"40\"}', 1, '2025-07-28 14:21:10', '2025-07-28 14:21:10'),
(280, 134, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/sort.html', '{\"menuId\":\"69\",\"sort\":\"100\"}', 1, '2025-07-28 14:21:14', '2025-07-28 14:21:14'),
(281, 83, 1, '修改成功', '127.0.0.1', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,169,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}', 1, '2025-07-28 14:21:21', '2025-07-28 14:21:21'),
(282, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"工作流程\",\"icon\":\"fa-chart-diagram\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"40\",\"menuId\":\"169\"}', 1, '2025-07-28 14:22:40', '2025-07-28 14:22:40'),
(283, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"工作流程\",\"icon\":\"fa-heart\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"40\",\"menuId\":\"169\"}', 1, '2025-07-28 14:23:58', '2025-07-28 14:23:58'),
(284, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"工作流程\",\"icon\":\"fa-chart-diagram\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"40\",\"menuId\":\"169\"}', 1, '2025-07-28 14:24:29', '2025-07-28 14:24:29'),
(285, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"145\",\"name\":\"工作流程\",\"icon\":\"fa-flag\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"index\",\"params\":\"\",\"record\":\"2\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"40\",\"menuId\":\"169\"}', 1, '2025-07-28 14:26:11', '2025-07-28 14:26:11'),
(286, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"169\",\"name\":\"工作流添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-07-28 14:38:50', '2025-07-28 14:38:50'),
(287, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"169\",\"name\":\"工作流修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-07-28 14:38:59', '2025-07-28 14:38:59'),
(288, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"169\",\"name\":\"工作流设计\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"design\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-07-28 14:39:12', '2025-07-28 14:39:12'),
(289, 76, 1, '添加成功', '127.0.0.1', '/admin/SystemMenu/create.html', '{\"parentId\":\"169\",\"name\":\"工作流删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-07-28 14:39:48', '2025-07-28 14:39:48'),
(290, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"170\"}', 1, '2025-07-28 14:39:55', '2025-07-28 14:39:55'),
(291, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"171\"}', 1, '2025-07-28 14:40:00', '2025-07-28 14:40:00'),
(292, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程设计\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"design\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"172\"}', 1, '2025-07-28 14:40:05', '2025-07-28 14:40:05'),
(293, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"173\"}', 1, '2025-07-28 14:40:08', '2025-07-28 14:40:08'),
(294, 83, 1, '修改成功', '127.0.0.1', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,69,76,80,79,134,142,157,153,154,155,156,158,143,144,147,137,136,138,148,149\"}', 1, '2025-07-28 14:40:41', '2025-07-28 14:40:41'),
(295, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程添加\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"create\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"170\"}', 1, '2025-07-28 14:40:54', '2025-07-28 14:40:54'),
(296, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"update\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"171\"}', 1, '2025-07-28 14:40:58', '2025-07-28 14:40:58'),
(297, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程设计\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"design\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"172\"}', 1, '2025-07-28 14:41:01', '2025-07-28 14:41:01'),
(298, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"169\",\"name\":\"流程删除\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemWorkflow\",\"action\":\"delete\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"173\"}', 1, '2025-07-28 14:41:04', '2025-07-28 14:41:04'),
(299, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-09-10 15:08:27', '2025-09-10 15:08:27'),
(300, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-09-10 15:08:38', '2025-09-10 15:08:38'),
(301, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-09-10 15:09:55', '2025-09-10 15:09:55'),
(302, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-09-10 15:10:14', '2025-09-10 15:10:14'),
(303, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-09-10 15:10:15', '2025-09-10 15:10:15'),
(304, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-10-17 09:53:59', '2025-10-17 09:53:59'),
(305, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-10-17 09:54:00', '2025-10-17 09:54:00'),
(306, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-10-17 09:56:30', '2025-10-17 09:56:30'),
(307, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-10-17 10:04:24', '2025-10-17 10:04:24'),
(308, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-11-21 13:41:24', '2025-11-21 13:41:24'),
(309, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-11-21 13:41:26', '2025-11-21 13:41:26'),
(310, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-11-21 13:41:27', '2025-11-21 13:41:27'),
(311, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"file\":\"\",\"avatar\":\"\\/upload\\/image\\/20231024\\/47220acdd326647e029949627e49b197.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2025-11-21 13:41:28', '2025-11-21 13:41:28'),
(312, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:43:16', '2025-12-11 11:43:16'),
(313, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:43:17', '2025-12-11 11:43:17'),
(314, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:43:19', '2025-12-11 11:43:19'),
(315, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:43:21', '2025-12-11 11:43:21'),
(316, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:43:24', '2025-12-11 11:43:24'),
(317, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:43:29', '2025-12-11 11:43:29'),
(318, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:44:17', '2025-12-11 11:44:17'),
(319, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:46:37', '2025-12-11 11:46:37'),
(320, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:47:19', '2025-12-11 11:47:19'),
(321, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:47:23', '2025-12-11 11:47:23'),
(322, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-11 11:48:42', '2025-12-11 11:48:42'),
(323, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-13 11:45:41', '2025-12-13 11:45:41'),
(324, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-13 11:45:42', '2025-12-13 11:45:42'),
(325, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-13 11:54:30', '2025-12-13 11:54:30'),
(326, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-13 11:55:42', '2025-12-13 11:55:42'),
(327, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-13 11:55:46', '2025-12-13 11:55:46'),
(328, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-15 10:17:56', '2025-12-15 10:17:56'),
(329, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-15 10:22:43', '2025-12-15 10:22:43'),
(330, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-15 10:27:39', '2025-12-15 10:27:39'),
(331, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-15 10:27:41', '2025-12-15 10:27:41'),
(332, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-15 10:27:43', '2025-12-15 10:27:43'),
(333, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-15 10:33:24', '2025-12-15 10:33:24'),
(334, 76, 1, '添加成功', '192.168.1.6', '/admin/SystemMenu/create.html', '{\"parentId\":\"153\",\"name\":\"文件管理\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"popup\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-12-19 09:23:06', '2025-12-19 09:23:06'),
(335, 83, 1, '修改成功', '192.168.1.6', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,153,154,155,156,158,169,143,144,147,137,136,138,148,149\"}', 1, '2025-12-19 09:23:14', '2025-12-19 09:23:14'),
(336, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-19 09:35:57', '2025-12-19 09:35:57'),
(337, 76, 1, '添加成功', '192.168.1.6', '/admin/SystemMenu/create.html', '{\"parentId\":\"153\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"upload\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2025-12-19 09:39:39', '2025-12-19 09:39:39'),
(338, 83, 1, '修改成功', '192.168.1.6', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"remark\":\"拥有最高权限\",\"sort\":\"10\",\"roleId\":\"1\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,153,154,155,156,158,169,170,143,144,147,137,136,138,148,149\"}', 1, '2025-12-19 09:39:44', '2025-12-19 09:39:44'),
(339, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-19 09:45:32', '2025-12-19 09:45:32'),
(340, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-19 09:45:39', '2025-12-19 09:45:39'),
(341, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-20 16:52:33', '2025-12-20 16:52:33'),
(342, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-20 16:52:34', '2025-12-20 16:52:34'),
(343, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-20 16:52:39', '2025-12-20 16:52:39'),
(344, 80, 1, '修改成功', '127.0.0.1', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件列表\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"list\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"169\"}', 1, '2025-12-21 15:33:28', '2025-12-21 15:33:28'),
(345, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-22 08:30:54', '2025-12-22 08:30:54'),
(346, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-22 08:30:55', '2025-12-22 08:30:55'),
(347, 147, 1, '获取成功', '127.0.0.1', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-22 08:30:58', '2025-12-22 08:30:58'),
(348, 138, 1, '修改成功', '127.0.0.1', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/20251222\\/5fab467d07144d267d0ef4ff6d24e92a.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2025-12-25 09:13:51', '2025-12-25 09:13:51'),
(349, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2025-12-26 11:29:58', '2025-12-26 11:29:58'),
(350, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"update\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"158\"}', 1, '2025-12-27 13:45:13', '2025-12-27 13:45:13');
INSERT INTO `system_oper_log` (`logId`, `menuId`, `managerId`, `message`, `requestIp`, `requestUrl`, `params`, `status`, `createTime`, `updateTime`) VALUES
(351, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"rename\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"158\"}', 1, '2025-12-27 13:45:25', '2025-12-27 13:45:25'),
(352, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"rename\",\"params\":\"\",\"record\":\"1\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"158\"}', 1, '2025-12-27 13:46:41', '2025-12-27 13:46:41'),
(353, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"153\",\"name\":\"文件修改\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"rename\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"158\"}', 1, '2025-12-27 13:46:49', '2025-12-27 13:46:49'),
(354, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"0\",\"name\":\"文本编辑\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemEditor\",\"action\":\"ueditor\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"144\"}', 1, '2025-12-27 15:01:40', '2025-12-27 15:01:40'),
(355, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"144\",\"name\":\"图片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"image\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"154\"}', 1, '2025-12-27 15:01:49', '2025-12-27 15:01:49'),
(356, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"144\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemUpload\",\"action\":\"file\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"155\"}', 1, '2025-12-27 15:01:56', '2025-12-27 15:01:56'),
(357, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"144\",\"name\":\"头像上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemManager\",\"action\":\"avatar\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"148\"}', 1, '2025-12-27 15:02:08', '2025-12-27 15:02:08'),
(358, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 14:45:21', '2026-01-06 14:45:21'),
(359, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:11:45', '2026-01-06 15:11:45'),
(360, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:11:47', '2026-01-06 15:11:47'),
(361, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:12:58', '2026-01-06 15:12:58'),
(362, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:12:59', '2026-01-06 15:12:59'),
(363, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:15:18', '2026-01-06 15:15:18'),
(364, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/20251222\\/a9eee875c2e2361883decf0204cb14d0.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-06 15:18:41', '2026-01-06 15:18:41'),
(365, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/20251222\\/72802d8aeacc4839612d11ce548f7210.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-06 15:19:09', '2026-01-06 15:19:09'),
(366, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/20251222\\/b34675a404ff8f8f0e7f8bc8a9e76996.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-06 15:19:17', '2026-01-06 15:19:17'),
(367, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:19:22', '2026-01-06 15:19:22'),
(368, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:19:23', '2026-01-06 15:19:23'),
(369, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:19:25', '2026-01-06 15:19:25'),
(370, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"6\",\"avatar\":\"\\/upload\\/20251222\\/3f562f6e166e2d49c70a970b9af0bbd1.jpg\",\"realName\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"10\"}', 1, '2026-01-06 15:19:35', '2026-01-06 15:19:35'),
(371, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:20:05', '2026-01-06 15:20:05'),
(372, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:53:47', '2026-01-06 15:53:47'),
(373, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 15:53:56', '2026-01-06 15:53:56'),
(374, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:29:23', '2026-01-06 16:29:23'),
(375, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:29:30', '2026-01-06 16:29:30'),
(376, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:29:35', '2026-01-06 16:29:35'),
(377, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:32:16', '2026-01-06 16:32:16'),
(378, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:34:01', '2026-01-06 16:34:01'),
(379, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:34:02', '2026-01-06 16:34:02'),
(380, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:34:17', '2026-01-06 16:34:17'),
(381, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:34:17', '2026-01-06 16:34:17'),
(382, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:36:15', '2026-01-06 16:36:15'),
(383, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:39:40', '2026-01-06 16:39:40'),
(384, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:39:40', '2026-01-06 16:39:40'),
(385, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:40:54', '2026-01-06 16:40:54'),
(386, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:40:54', '2026-01-06 16:40:54'),
(387, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:41:04', '2026-01-06 16:41:04'),
(388, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:41:04', '2026-01-06 16:41:04'),
(389, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:43:22', '2026-01-06 16:43:22'),
(390, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:43:22', '2026-01-06 16:43:22'),
(391, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:43:27', '2026-01-06 16:43:27'),
(392, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:43:46', '2026-01-06 16:43:46'),
(393, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:44:22', '2026-01-06 16:44:22'),
(394, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:45:18', '2026-01-06 16:45:18'),
(395, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:47:55', '2026-01-06 16:47:55'),
(396, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:54:12', '2026-01-06 16:54:12'),
(397, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:54:42', '2026-01-06 16:54:42'),
(398, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:58:45', '2026-01-06 16:58:45'),
(399, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:59:16', '2026-01-06 16:59:16'),
(400, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:59:17', '2026-01-06 16:59:17'),
(401, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:59:42', '2026-01-06 16:59:42'),
(402, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 16:59:48', '2026-01-06 16:59:48'),
(403, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:00:54', '2026-01-06 17:00:54'),
(404, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:00:56', '2026-01-06 17:00:56'),
(405, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:01:40', '2026-01-06 17:01:40'),
(406, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:01:42', '2026-01-06 17:01:42'),
(407, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:02:52', '2026-01-06 17:02:52'),
(408, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:03:43', '2026-01-06 17:03:43'),
(409, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:03:51', '2026-01-06 17:03:51'),
(410, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:03:56', '2026-01-06 17:03:56'),
(411, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:03:58', '2026-01-06 17:03:58'),
(412, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:07:54', '2026-01-06 17:07:54'),
(413, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:07:55', '2026-01-06 17:07:55'),
(414, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:09:35', '2026-01-06 17:09:35'),
(415, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:11:27', '2026-01-06 17:11:27'),
(416, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:11:28', '2026-01-06 17:11:28'),
(417, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/20251222\\/b34675a404ff8f8f0e7f8bc8a9e76996.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-01-06 17:11:33', '2026-01-06 17:11:33'),
(418, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:11:35', '2026-01-06 17:11:35'),
(419, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/20251222\\/b34675a404ff8f8f0e7f8bc8a9e76996.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-01-06 17:11:36', '2026-01-06 17:11:36'),
(420, 147, 1, '获取成功', '192.168.1.6', '/admin/SystemManagerRole/getAll.html', '[]', 1, '2026-01-06 17:11:37', '2026-01-06 17:11:37'),
(421, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"143\",\"name\":\"全部角色\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemManagerRole\",\"action\":\"getAll\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"147\"}', 1, '2026-01-06 17:11:52', '2026-01-06 17:11:52'),
(422, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"157\",\"name\":\"其他菜单\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"2\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100000\",\"menuId\":\"137\"}', 1, '2026-01-06 17:12:01', '2026-01-06 17:12:01'),
(423, 163, 1, '修改成功', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"新闻标签\",\"identify\":\"newsTag\",\"remark\":\"新闻标签\",\"sort\":\"100\",\"status\":\"N\",\"dictId\":\"1\"}', 1, '2026-01-07 10:00:08', '2026-01-07 10:00:08'),
(424, 163, 1, '修改成功', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"新闻标签\",\"identify\":\"newsTag\",\"remark\":\"新闻标签\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"1\"}', 1, '2026-01-07 10:00:18', '2026-01-07 10:00:18'),
(425, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"推荐\",\"value\":\"2\",\"style\":\"layui-bg-green\",\"isDefault\":\"1\",\"remark\":\"\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"1\"}', 1, '2026-01-07 10:00:34', '2026-01-07 10:00:34'),
(426, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"推荐\",\"value\":\"rec\",\"style\":\"layui-bg-green\",\"isDefault\":\"1\",\"remark\":\"\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"3\"}', 1, '2026-01-07 10:02:45', '2026-01-07 10:02:45'),
(427, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"热门\",\"value\":\"hot\",\"style\":\"layui-bg-blue\",\"isDefault\":\"2\",\"remark\":\"热门新闻标签\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"1\"}', 1, '2026-01-07 10:02:51', '2026-01-07 10:02:51'),
(428, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"推荐\",\"value\":\"rec\",\"style\":\"layui-bg-green\",\"isDefault\":\"1\",\"remark\":\"推荐新闻标签\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"3\"}', 1, '2026-01-07 10:03:02', '2026-01-07 10:03:02'),
(429, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"推荐\",\"value\":\"rec\",\"style\":\"layui-bg-green\",\"isDefault\":\"N\",\"remark\":\"推荐新闻标签\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"3\"}', 1, '2026-01-07 10:22:50', '2026-01-07 10:22:50'),
(430, 86, 1, '删除成功', '192.168.1.6', '/admin/SystemManager/delete.html', '{\"managerId\":10}', 1, '2026-01-07 10:36:45', '2026-01-07 10:36:45'),
(431, 162, 1, '添加成功', '192.168.1.6', '/admin/SystemDictType/create.html', '{\"name\":\"文件类型\",\"identify\":\"systemUploadType\",\"remark\":\"上传文件类型\",\"sort\":\"100\",\"status\":\"Y\"}', 1, '2026-01-07 14:02:15', '2026-01-07 14:02:15'),
(432, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"video\\/mp4\",\"value\":\"video\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"视频\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:02:48', '2026-01-07 14:02:48'),
(433, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"video\\/mp4\",\"value\":\"video\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"视频\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:03:12', '2026-01-07 14:03:12'),
(434, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"video\\/mpeg\",\"value\":\"video\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"视频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"5\"}', 1, '2026-01-07 14:03:20', '2026-01-07 14:03:20'),
(435, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"audio\\/mp3\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:03:49', '2026-01-07 14:03:49'),
(436, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"audio\\/mpeg\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:00', '2026-01-07 14:04:00'),
(437, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"audio\\/wav\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:07', '2026-01-07 14:04:07'),
(438, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"image\\/jpeg\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:27', '2026-01-07 14:04:27'),
(439, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"image\\/jpg\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:33', '2026-01-07 14:04:33'),
(440, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"image\\/png\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:37', '2026-01-07 14:04:37'),
(441, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"image\\/gif\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:41', '2026-01-07 14:04:41'),
(442, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"image\\/webp\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:04:47', '2026-01-07 14:04:47'),
(443, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/pdf\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:05:09', '2026-01-07 14:05:09'),
(444, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/msword\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:06:20', '2026-01-07 14:06:20'),
(445, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:06:28', '2026-01-07 14:06:28'),
(446, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/vnd.ms-excel\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:06:33', '2026-01-07 14:06:33'),
(447, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/vnd.openxmlformats-officedocument.spreadsheetml.sheet\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:06:40', '2026-01-07 14:06:40'),
(448, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/vnd.ms-powerpoint\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:06:45', '2026-01-07 14:06:45'),
(449, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/vnd.openxmlformats-officedocument.presentationml.presentation\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:06:51', '2026-01-07 14:06:51'),
(450, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"text\\/plain\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:07:00', '2026-01-07 14:07:00'),
(451, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/zip\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:07:45', '2026-01-07 14:07:45'),
(452, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/x-zip-compressed\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:07:50', '2026-01-07 14:07:50'),
(453, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/x-rar-compressed\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:07:54', '2026-01-07 14:07:54'),
(454, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"application\\/x-7z-compressed\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 14:07:59', '2026-01-07 14:07:59'),
(455, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"system\",\"name\":\"系统标语\",\"identify\":\"slogan\",\"value\":\"PHP后台快速开发系统\",\"remark\":\"系统登录页面展示标语\",\"sort\":\"20\",\"settingId\":\"2\"}', 1, '2026-01-07 14:16:55', '2026-01-07 14:16:55'),
(456, 2, 1, '添加成功', '192.168.1.6', '/admin/SystemSetting/create.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1024\",\"remark\":\"上传文件大小限制，填写 0 为不限制\",\"sort\":\"100\"}', 1, '2026-01-07 14:18:33', '2026-01-07 14:18:33'),
(457, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1024\",\"remark\":\"上传文件大小限制mb，填写 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-07 14:18:49', '2026-01-07 14:18:49'),
(458, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1024\",\"remark\":\"上传文件大小限制\\/MB，填写 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-07 14:18:57', '2026-01-07 14:18:57'),
(459, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1024\",\"remark\":\"上传文件大小限制，单位：mb，填写 0 为不限制。\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-07 14:19:17', '2026-01-07 14:19:17'),
(460, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1024\",\"remark\":\"上传文件大小限制，单位：mb，填 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-07 14:19:25', '2026-01-07 14:19:25'),
(461, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1\",\"remark\":\"上传文件大小限制，单位：mb，填 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-07 14:27:04', '2026-01-07 14:27:04'),
(462, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"1024\",\"remark\":\"上传文件大小限制，单位：mb，填 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-07 14:28:22', '2026-01-07 14:28:22'),
(463, 163, 1, '修改成功', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"文件类型\",\"identify\":\"system.upload.type\",\"remark\":\"上传文件类型\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"3\"}', 1, '2026-01-07 16:04:52', '2026-01-07 16:04:52'),
(464, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-07 17:20:46', '2026-01-07 17:20:46'),
(465, 83, 1, '修改成功', '192.168.1.6', '/admin/SystemManagerRole/update.html', '{\"name\":\"部门管理员\",\"identify\":\"department\",\"sort\":\"30\",\"remark\":\"部门管理员\",\"roleId\":\"6\",\"permission\":\"75,128,141,72,73,81,85,86,74,82,83,84,157,153,156,158,169,170,143,147,137,136,138,149\"}', 1, '2026-01-08 09:12:45', '2026-01-08 09:12:45'),
(466, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"6\",\"avatar\":\"\\/upload\\/image\\/20260107\\/7a8f2d15e3d298cd12feb59572c2f4e5.jpg\",\"realName\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"10\"}', 1, '2026-01-08 09:13:32', '2026-01-08 09:13:32'),
(467, 138, 10, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260108\\/3d264d32f3acac55ae09b5d5e815be9a.jpg\",\"realName\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"managerId\":\"10\"}', 1, '2026-01-08 09:17:31', '2026-01-08 09:17:31'),
(468, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"74\",\"name\":\"角色列表\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemManagerRole\",\"action\":\"getAll\",\"params\":\"\",\"record\":\"N\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"147\"}', 1, '2026-01-08 10:02:26', '2026-01-08 10:02:26'),
(469, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"0\",\"remark\":\"上传文件大小限制，单位：mb，填 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-09 09:17:45', '2026-01-09 09:17:45'),
(470, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"system\",\"name\":\"系统名称\",\"identify\":\"name\",\"value\":\"EasyAdmin\",\"remark\":\"系统LOGO展示文字\",\"sort\":\"10\",\"settingId\":\"1\"}', 1, '2026-01-10 10:44:18', '2026-01-10 10:44:18'),
(471, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"0\",\"remark\":\"上传文件大小限制，单位：mb，填 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-10 10:44:27', '2026-01-10 10:44:27'),
(472, 159, 1, '修改成功', '192.168.1.6', '/admin/SystemSetting/update.html', '{\"type\":\"upload\",\"name\":\"上传大小\",\"identify\":\"limit\",\"value\":\"0\",\"remark\":\"上传文件大小限制，单位：mb，填 0 为不限制\",\"sort\":\"100\",\"settingId\":\"3\"}', 1, '2026-01-10 10:46:57', '2026-01-10 10:46:57'),
(473, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"个人资料\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"profile1\",\"params\":\"\",\"record\":\"Y\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"138\"}', 1, '2026-01-10 11:20:10', '2026-01-10 11:20:10'),
(474, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"个人资料\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"profile\",\"params\":\"\",\"record\":\"Y\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"138\"}', 1, '2026-01-10 11:20:17', '2026-01-10 11:20:17'),
(475, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"退出登录\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"logout1\",\"params\":\"\",\"record\":\"N\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"149\"}', 1, '2026-01-10 11:20:21', '2026-01-10 11:20:21'),
(476, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"137\",\"name\":\"退出登录\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemIndex\",\"action\":\"logout\",\"params\":\"\",\"record\":\"N\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"149\"}', 1, '2026-01-10 11:23:28', '2026-01-10 11:23:28'),
(477, 80, 1, '修改成功', '192.168.1.6', '/admin/SystemMenu/update.html', '{\"parentId\":\"143\",\"name\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"record\":\"N\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\",\"menuId\":\"153\"}', 1, '2026-01-10 11:29:34', '2026-01-10 11:29:34'),
(478, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"managerId\":\"1\"}', 1, '2026-01-10 14:36:57', '2026-01-10 14:36:57'),
(479, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"managerId\":\"1\"}', 1, '2026-01-10 14:37:11', '2026-01-10 14:37:11'),
(480, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"managerId\":\"1\"}', 1, '2026-01-10 14:37:26', '2026-01-10 14:37:26'),
(481, 162, 1, '添加成功', '192.168.1.6', '/admin/SystemDictType/create.html', '{\"name\":\"邮箱设置\",\"identify\":\"system.mail.config\",\"remark\":\"邮箱发送设置\",\"sort\":\"100\",\"status\":\"Y\"}', 1, '2026-01-10 16:28:21', '2026-01-10 16:28:21'),
(482, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"host\",\"value\":\"smtp.qq.com\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"服务器地址\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"4\"}', 1, '2026-01-10 16:28:54', '2026-01-10 16:28:54'),
(483, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"username\",\"value\":\"1628883533@qq.com\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"发送人账号\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"4\"}', 1, '2026-01-10 16:29:08', '2026-01-10 16:29:08'),
(484, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"password\",\"value\":\"发送人授权码\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"发送人授权码\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"4\"}', 1, '2026-01-10 16:29:27', '2026-01-10 16:29:27'),
(485, 166, 1, '添加成功', '192.168.1.6', '/admin/SystemDictData/create.html', '{\"label\":\"port\",\"value\":\"服务器端口\",\"style\":\"465\",\"isDefault\":\"Y\",\"remark\":\"服务器端口\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"4\"}', 1, '2026-01-10 16:31:19', '2026-01-10 16:31:19'),
(486, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"port\",\"value\":\"465\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"服务器端口\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"29\"}', 1, '2026-01-10 16:31:26', '2026-01-10 16:31:26'),
(487, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"password\",\"value\":\"iphxfarybutwdjdh\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"发送人授权码\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"28\"}', 1, '2026-01-10 16:33:20', '2026-01-10 16:33:20'),
(488, 83, 1, '修改成功', '192.168.1.6', '/admin/SystemManagerRole/update.html', '{\"name\":\"超级管理员\",\"identify\":\"super\",\"sort\":\"10\",\"remark\":\"拥有最高权限\",\"roleId\":\"1\",\"permission\":\"75,128,141,144,148,154,155,72,73,81,85,86,74,82,83,84,147,1,114,121,122,150,151,152,145,99,2,159,160,161,162,163,164,165,166,167,168,69,76,80,79,134,142,157,143,153,156,158,169,170,137,136,138,149\"}', 1, '2026-01-12 09:39:21', '2026-01-12 09:39:21'),
(489, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"******\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-01-12 09:43:23', '2026-01-12 09:43:23'),
(490, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"mp4\",\"value\":\"video\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"视频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"4\"}', 1, '2026-01-12 15:28:21', '2026-01-12 15:28:21'),
(491, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"mpg\",\"value\":\"video\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"视频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"5\"}', 1, '2026-01-12 15:28:54', '2026-01-12 15:28:54'),
(492, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"mp3\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"6\"}', 1, '2026-01-12 15:28:59', '2026-01-12 15:28:59'),
(493, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"mpeg\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"7\"}', 1, '2026-01-12 15:29:06', '2026-01-12 15:29:06'),
(494, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"wav\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"8\"}', 1, '2026-01-12 15:30:18', '2026-01-12 15:30:18'),
(495, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"jpeg\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"9\"}', 1, '2026-01-12 15:30:23', '2026-01-12 15:30:23'),
(496, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"jpg\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"10\"}', 1, '2026-01-12 15:30:28', '2026-01-12 15:30:28'),
(497, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"png\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"11\"}', 1, '2026-01-12 15:30:31', '2026-01-12 15:30:31'),
(498, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"gif\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"12\"}', 1, '2026-01-12 15:30:37', '2026-01-12 15:30:37'),
(499, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"webp\",\"value\":\"image\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"图片\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"13\"}', 1, '2026-01-12 15:30:41', '2026-01-12 15:30:41'),
(500, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"pdf\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"14\"}', 1, '2026-01-12 15:30:45', '2026-01-12 15:30:45'),
(501, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"doc\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"15\"}', 1, '2026-01-12 15:31:03', '2026-01-12 15:31:03'),
(502, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"docx\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"16\"}', 1, '2026-01-12 15:31:30', '2026-01-12 15:31:30'),
(503, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"xls\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"17\"}', 1, '2026-01-12 15:31:36', '2026-01-12 15:31:36'),
(504, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"xlsx\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"18\"}', 1, '2026-01-12 15:31:41', '2026-01-12 15:31:41'),
(505, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"ppt\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"19\"}', 1, '2026-01-12 15:31:48', '2026-01-12 15:31:48'),
(506, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"pptx\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"20\"}', 1, '2026-01-12 15:31:52', '2026-01-12 15:31:52'),
(507, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"txt\",\"value\":\"doc\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"文档\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"21\"}', 1, '2026-01-12 15:32:02', '2026-01-12 15:32:02'),
(508, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"zip\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"22\"}', 1, '2026-01-12 15:32:07', '2026-01-12 15:32:07'),
(509, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"tar\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"23\"}', 1, '2026-01-12 15:32:16', '2026-01-12 15:32:16'),
(510, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"rar\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"24\"}', 1, '2026-01-12 15:32:22', '2026-01-12 15:32:22'),
(511, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"7z\",\"value\":\"zip\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"压缩包\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"25\"}', 1, '2026-01-12 15:32:26', '2026-01-12 15:32:26'),
(512, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"ogg\",\"value\":\"audio\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"音频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"7\"}', 1, '2026-01-12 15:33:13', '2026-01-12 15:33:13'),
(513, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"mov\",\"value\":\"video\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"视频\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"5\"}', 1, '2026-01-12 15:33:41', '2026-01-12 15:33:41'),
(514, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"黎明\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-12 15:42:21', '2026-01-12 15:42:21'),
(515, 138, 1, '修改成功', '192.168.1.6', '/admin/SystemIndex/profile.html', '{\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"managerId\":\"1\"}', 1, '2026-01-12 15:42:34', '2026-01-12 15:42:34'),
(516, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"host\",\"value\":\"smtp.qq.com1\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"服务器地址\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"26\"}', 1, '2026-01-14 09:38:27', '2026-01-14 09:38:27'),
(517, 167, 1, '修改成功', '192.168.1.6', '/admin/SystemDictData/update.html', '{\"label\":\"host\",\"value\":\"smtp.qq.com\",\"style\":\"\",\"isDefault\":\"Y\",\"remark\":\"服务器地址\",\"sort\":\"100\",\"status\":\"Y\",\"dataId\":\"26\"}', 1, '2026-01-14 13:51:53', '2026-01-14 13:51:53'),
(518, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-01-14 16:11:20', '2026-01-14 16:11:20'),
(519, 162, 1, '添加成功', '192.168.1.6', '/admin/SystemDictType/create.html', '{\"name\":\"系统信息设置\",\"identify\":\"system.info.config\",\"remark\":\"系统信息设置\",\"sort\":\"100\",\"status\":\"Y\"}', 1, '2026-01-15 15:52:54', '2026-01-15 15:52:54'),
(520, 163, 1, '修改成功', '192.168.1.6', '/admin/SystemDictType/update.html', '{\"name\":\"系统设置\",\"identify\":\"system.info.config\",\"remark\":\"系统信息设置\",\"sort\":\"100\",\"status\":\"Y\",\"dictId\":\"5\"}', 1, '2026-01-15 15:53:00', '2026-01-15 15:53:00'),
(521, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"1\",\"avatar\":\"\\/upload\\/image\\/20260112\\/1275f923063e22a77b64352a1f834c6e.jpg\",\"realName\":\"超级管理员\",\"account\":\"admin\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"1\"}', 1, '2026-01-15 17:22:03', '2026-01-15 17:22:03'),
(522, 85, 1, '修改成功', '192.168.1.6', '/admin/SystemManager/update.html', '{\"roleId\":\"6\",\"avatar\":\"\\/upload\\/image\\/20260107\\/7f2b4b3accbd276096d9e334a5a2c4e6.jpg\",\"realName\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\",\"managerId\":\"10\"}', 1, '2026-01-16 11:12:34', '2026-01-16 11:12:34');

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

--
-- 转存表中的数据 `system_setting`
--

INSERT INTO `system_setting` (`settingId`, `type`, `name`, `identify`, `value`, `remark`, `sort`, `createTime`, `updateTime`) VALUES
(1, 'system', '系统名称', 'name', 'EasyAdmin', '系统LOGO展示文字', 10, '2023-10-24 10:33:41', '2026-01-10 10:44:18'),
(2, 'system', '系统标语', 'slogan', 'PHP后台快速开发系统', '系统登录页面展示标语', 20, '2023-10-24 10:33:41', '2026-01-07 14:16:55'),
(3, 'upload', '上传大小', 'limit', '0', '上传文件大小限制，单位：mb，填 0 为不限制', 100, '2026-01-07 14:18:33', '2026-01-10 10:46:57');

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
(7, 1, '26ae9bea6b90e2285fda78d4fe256610', '7.79MB.zip', 'zip', 8179364, '/upload/zip/20260107/2d9a253b7b19a9d04fc83bb9f6f072ee.zip', 3, 'Y', '2026-01-07 17:20:21', '2026-01-10 10:41:13'),
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
  MODIFY `dataId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=30;

--
-- 使用表AUTO_INCREMENT `system_dict_type`
--
ALTER TABLE `system_dict_type`
  MODIFY `dictId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_login_log`
--
ALTER TABLE `system_login_log`
  MODIFY `logId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=47;

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
  MODIFY `logId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=523;

--
-- 使用表AUTO_INCREMENT `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `settingId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `system_upload`
--
ALTER TABLE `system_upload`
  MODIFY `fileId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
