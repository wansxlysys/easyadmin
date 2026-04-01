-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2026-03-29 10:19:21
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
(1, 1, '/upload/image/20260112/1275f923063e22a77b64352a1f834c6e.jpg', '超级管理员', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'N', 0, '2026-03-29 09:43:28', NULL, '2022-11-06 14:29:39', '2026-03-29 09:43:28'),
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
(145, 0, '系统管理', 'fa-server', '', '', 1, '', 1, 'N', 20020, '2022-11-06 14:28:59', '2026-03-17 15:16:00'),
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
  MODIFY `queueId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

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
  MODIFY `logId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

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
  MODIFY `logId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `settingId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `system_upload`
--
ALTER TABLE `system_upload`
  MODIFY `fileId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
