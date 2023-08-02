-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-08-02 16:23:27
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
-- 表的结构 `easy_log`
--

CREATE TABLE `easy_log` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `manager_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `menu` varchar(64) NOT NULL DEFAULT '' COMMENT '操作菜单',
  `description` varchar(256) NOT NULL DEFAULT '' COMMENT '操作描述',
  `url` varchar(256) NOT NULL DEFAULT '' COMMENT '请求地址',
  `request_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '请求IP',
  `params` longtext COMMENT '请求参数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '操作状态：1-成功，2-失败',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统日志';

--
-- 转存表中的数据 `easy_log`
--

INSERT INTO `easy_log` (`id`, `manager_id`, `menu`, `description`, `url`, `request_ip`, `params`, `status`, `create_time`) VALUES
(214, 1, '日志清空', '系统自动记录：清空成功', '/admin/log/clear.html', '', '[]', 1, '2023-03-21 11:11:48'),
(215, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"1\",\"title\":\"登录日志\",\"icon\":\"fa-file-text\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 11:55:24'),
(216, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"64\",\"1\",\"2\",\"114\",\"121\",\"122\",\"150\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"139\",\"140\",\"145\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"143\",\"144\",\"147\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\"]}', 1, '2023-03-21 11:55:30'),
(217, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"150\",\"title\":\"日志详情\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"detail\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 12:01:11'),
(218, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"150\",\"title\":\"日志清空\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"SystemLoginLog\",\"action\":\"clear\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 12:01:22'),
(219, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"64\",\"1\",\"2\",\"114\",\"121\",\"122\",\"150\",\"151\",\"152\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"139\",\"140\",\"145\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"143\",\"144\",\"147\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\"]}', 1, '2023-03-21 12:01:32'),
(220, 1, '日志清空', '系统自动记录：清空成功', '/admin/system_login_log/clear.html', '', '[]', 1, '2023-03-21 13:55:08'),
(221, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"137\",\"title\":\"上传功能\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 14:32:33'),
(222, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"153\",\"title\":\"图片上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Upload\",\"action\":\"image\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 14:32:52'),
(223, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"153\",\"title\":\"文件上传\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Upload\",\"action\":\"file\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 14:33:00'),
(224, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '', '{\"parent_id\":\"153\",\"title\":\"文件检测\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"Upload\",\"action\":\"check\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, '2023-03-21 14:33:07'),
(225, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"64\",\"1\",\"2\",\"114\",\"121\",\"122\",\"150\",\"151\",\"152\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"139\",\"140\",\"145\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"143\",\"144\",\"147\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\",\"153\",\"154\",\"155\",\"156\"]}', 1, '2023-03-21 14:33:15'),
(226, 1, '文件上传', '系统自动记录：上传失败', '/admin/upload/file.html', '', '{\"file_name\":\"1.jpg\",\"file_size\":\"329748\",\"file_chunksize\":\"329748\",\"file_suffix\":\"jpg\",\"file_total\":\"1\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_index\":\"1\",\"apped_data\":\"{}\"}', 2, '2023-03-21 14:33:24'),
(227, 1, '文件检测', '系统自动记录：文件不存在', '/admin/upload/check.html', '', '{\"file_name\":\"1.jpg\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_size\":\"329748\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 2, '2023-03-21 14:36:16'),
(228, 1, '文件检测', '系统自动记录：文件不存在', '/admin/upload/check.html', '', '{\"file_name\":\"1.jpg\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_size\":\"329748\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 2, '2023-03-21 14:37:03'),
(229, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"1.jpg\",\"file_size\":\"329748\",\"file_chunksize\":\"329748\",\"file_suffix\":\"jpg\",\"file_total\":\"1\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_index\":\"1\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:37:03'),
(230, 1, '文件检测', '系统自动记录：文件已存在', '/admin/upload/check.html', '', '{\"file_name\":\"1.jpg\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_size\":\"329748\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:37:17'),
(231, 1, '文件检测', '系统自动记录：文件已存在', '/admin/upload/check.html', '', '{\"file_name\":\"1.jpg\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_size\":\"329748\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:39:09'),
(232, 1, '文件检测', '系统自动记录：文件不存在', '/admin/upload/check.html', '', '{\"file_name\":\"1.jpg\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_size\":\"329748\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 2, '2023-03-21 14:40:57'),
(233, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"1.jpg\",\"file_size\":\"329748\",\"file_chunksize\":\"329748\",\"file_suffix\":\"jpg\",\"file_total\":\"1\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_index\":\"1\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:40:57'),
(234, 1, '文件检测', '系统自动记录：文件已存在', '/admin/upload/check.html', '', '{\"file_name\":\"1.jpg\",\"file_md5\":\"8ddf582f610c68b1729111fd86d05ec1\",\"file_size\":\"329748\",\"file_total\":\"1\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:41:12'),
(235, 1, '文件检测', '系统自动记录：文件不存在', '/admin/upload/check.html', '', '{\"file_name\":\"测试上传.zip\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_size\":\"141243741\",\"file_total\":\"68\",\"apped_data\":\"{}\"}', 2, '2023-03-21 14:42:35'),
(236, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"1\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(237, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"2\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(238, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"3\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(239, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"4\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(240, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"5\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(241, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"6\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(242, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"7\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(243, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"8\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:36'),
(244, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"9\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(245, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"10\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(246, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"11\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(247, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"12\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(248, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"13\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(249, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"14\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(250, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"15\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:37'),
(251, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"16\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(252, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"17\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(253, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"18\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(254, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"19\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(255, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"20\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(256, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"21\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(257, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"22\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:38'),
(258, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"23\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(259, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"24\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(260, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"25\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(261, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"26\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(262, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"27\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(263, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"28\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(264, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"29\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:39'),
(265, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"30\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(266, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"31\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(267, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"32\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(268, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"33\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(269, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"34\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(270, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"35\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(271, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"36\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:40'),
(272, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"37\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(273, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"38\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(274, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"39\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(275, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"40\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(276, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"41\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(277, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"42\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(278, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"43\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:41'),
(279, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"44\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(280, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"45\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(281, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"46\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(282, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"47\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(283, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"48\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(284, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"49\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(285, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"50\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(286, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"51\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:42'),
(287, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"52\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(288, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"53\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(289, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"54\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(290, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"55\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(291, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"56\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(292, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"57\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(293, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"58\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:43'),
(294, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"59\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(295, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"60\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(296, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"61\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(297, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"62\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(298, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"63\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(299, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"64\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(300, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"65\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:44'),
(301, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"66\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:45'),
(302, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"2097152\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"67\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:45'),
(303, 1, '文件上传', '系统自动记录：上传成功', '/admin/upload/file.html', '', '{\"file_name\":\"测试上传.zip\",\"file_size\":\"141243741\",\"file_chunksize\":\"734557\",\"file_suffix\":\"zip\",\"file_total\":\"68\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_index\":\"68\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:42:45'),
(304, 1, '文件检测', '系统自动记录：文件已存在', '/admin/upload/check.html', '', '{\"file_name\":\"测试上传.zip\",\"file_md5\":\"4afa9551cb213f2ffa8d1ebc8d22056c\",\"file_size\":\"141243741\",\"file_total\":\"68\",\"apped_data\":\"{}\"}', 1, '2023-03-21 14:43:12'),
(305, 1, '菜单删除', '系统自动记录：删除成功', '/admin/menu/delete.html', '', '{\"id\":\"140\"}', 1, '2023-03-21 14:53:40'),
(306, 1, '菜单删除', '系统自动记录：删除成功', '/admin/menu/delete.html', '', '{\"id\":\"139\"}', 1, '2023-03-21 14:53:43'),
(307, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"64\",\"1\",\"2\",\"114\",\"121\",\"122\",\"150\",\"151\",\"152\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"145\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"143\",\"144\",\"147\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\",\"153\",\"154\",\"155\",\"156\"]}', 1, '2023-03-21 14:53:51'),
(308, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '', '{\"id\":\"5\",\"title\":\"普通管理员\",\"name\":\"common\",\"remark\":\"普通权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\",\"153\",\"154\",\"155\",\"156\"]}', 1, '2023-03-21 14:53:58'),
(309, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '', '{\"id\":\"6\",\"title\":\"部门管理员\",\"name\":\"department\",\"remark\":\"部门管理员\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"137\",\"136\",\"138\",\"146\",\"148\",\"149\",\"153\",\"154\",\"155\",\"156\"]}', 1, '2023-03-21 14:54:03'),
(310, 1, '头像上传', '系统自动记录：上传成功', '/admin/manager/avatar.html', '', '[]', 1, '2023-03-21 15:47:06'),
(311, 1, '管理员修改', '系统自动记录：修改成功', '/admin/manager/update.html', '', '{\"id\":\"10\",\"role_id\":\"1\",\"file\":\"\",\"avatar\":\"\\/uploads\\/images\\/20230321\\/4caedcd42419e7f699c4434fd2b2dd89.png\",\"nickname\":\"测试管理员\",\"account\":\"test\",\"password\":\"\",\"status\":\"1\"}', 1, '2023-03-21 15:47:07'),
(312, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '', '{\"parent_id\":\"0\",\"title\":\"系统主页\",\"icon\":\"fa-home\",\"module\":\"admin\",\"controller\":\"Index\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"75\"}', 1, '2023-08-02 14:28:12'),
(313, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '', '{\"parent_id\":\"0\",\"title\":\"系统主页\",\"icon\":\"fa-home\",\"module\":\"admin\",\"controller\":\"Index\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\",\"id\":\"75\"}', 1, '2023-08-02 14:40:41');

-- --------------------------------------------------------

--
-- 表的结构 `easy_manager`
--

CREATE TABLE `easy_manager` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户组',
  `avatar` varchar(256) NOT NULL DEFAULT '' COMMENT '头像',
  `real_name` varchar(32) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `account` varchar(32) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `is_system` tinyint(1) NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1-正常，2-禁用，3-锁定',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理员';

--
-- 转存表中的数据 `easy_manager`
--

INSERT INTO `easy_manager` (`id`, `role_id`, `avatar`, `real_name`, `account`, `password`, `is_system`, `status`, `login_time`, `create_time`, `update_time`) VALUES
(1, 1, '/uploads/images/20230320/6811572f7034ef16dc02f0447c3dfe2a.jpg', '黎明', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2023-08-02 14:16:45', '2022-11-06 14:29:39', '2023-08-02 14:16:45'),
(10, 1, '/uploads/images/20230321/4caedcd42419e7f699c4434fd2b2dd89.png', '测试管理员', 'test', '098f6bcd4621d373cade4e832627b4f6', 2, 1, NULL, '2022-11-06 14:29:39', '2023-03-21 15:47:07');

-- --------------------------------------------------------

--
-- 表的结构 `easy_menu`
--

CREATE TABLE `easy_menu` (
  `id` int(11) NOT NULL COMMENT 'ID',
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
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统节点';

--
-- 转存表中的数据 `easy_menu`
--

INSERT INTO `easy_menu` (`id`, `parent_id`, `title`, `icon`, `module`, `controller`, `action`, `params`, `type`, `link`, `target`, `sort`, `create_time`) VALUES
(1, 64, '系统管理', 'fa-cogs', 'admin', '', '', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(2, 1, '系统设置', 'fa-cog', 'admin', 'Setting', 'system', '', 1, '', 1, 0, '2022-11-06 14:28:59'),
(64, 0, '系统模块', 'fa fa-fw fa-cogs', 'admin', '', '', '', 1, '', 1, 20, '2022-11-06 14:28:59'),
(69, 145, '菜单设置', 'fa-bars', 'admin', 'Menu', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(72, 64, '权限管理', 'fa-users', 'admin', '', '', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(73, 72, '管理员', 'fa-user', 'admin', 'Manager', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(74, 72, '角色管理', 'fa-user-plus', 'admin', 'Role', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(75, 0, '系统主页', 'fa-home', 'admin', 'Index', 'index', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(76, 69, '菜单添加', 'fa-link', 'admin', 'Menu', 'create', '', 2, '', 1, 10, '2022-11-06 14:28:59'),
(79, 69, '菜单删除', 'fa-link', 'admin', 'Menu', 'delete', '', 2, '', 1, 30, '2022-11-06 14:28:59'),
(80, 69, '菜单修改', 'fa-link', 'admin', 'Menu', 'update', '', 2, '', 1, 20, '2022-11-06 14:28:59'),
(81, 73, '管理员添加', 'fa-link', 'admin', 'Manager', 'create', '', 2, '', 1, 10, '2022-11-06 14:28:59'),
(82, 74, '角色添加', 'fa-link', 'admin', 'Role', 'create', '', 2, '', 1, 10, '2022-11-06 14:28:59'),
(83, 74, '角色修改', 'fa-link', 'admin', 'Role', 'update', '', 2, '', 1, 20, '2022-11-06 14:28:59'),
(84, 74, '角色删除', 'fa-link', 'admin', 'Role', 'delete', '', 2, '', 1, 30, '2022-11-06 14:28:59'),
(85, 73, '管理员修改', 'fa-link', 'admin', 'Manager', 'update', '', 2, '', 1, 10, '2022-11-06 14:28:59'),
(86, 73, '管理员删除', 'fa-link', 'admin', 'Manager', 'delete', '', 2, '', 1, 10, '2022-11-06 14:28:59'),
(99, 75, '门户统计', 'fa-bar-chart', 'admin', 'Home', 'dashboard', '', 1, 'https://www.baidu.com/', 1, 20, '2022-11-06 14:28:59'),
(114, 1, '系统日志', 'fa-book', 'admin', 'Log', 'index', '', 1, '', 1, 30, '2022-11-06 14:28:59'),
(121, 114, '日志详情', 'fa-link', 'admin', 'Log', 'detail', '', 2, '', 1, 10, '2022-11-06 14:28:59'),
(122, 114, '日志清空', 'fa-link', 'admin', 'Log', 'clear', '', 2, '', 1, 20, '2022-11-06 14:28:59'),
(128, 75, '控制台', 'fa-dashboard', 'admin', 'Home', 'console', '', 1, '', 1, 10, '2022-11-06 14:28:59'),
(134, 69, '菜单排序', 'fa-link', 'admin', 'Menu', 'sort', '', 2, '', 1, 100, '2022-11-06 14:28:59'),
(136, 137, '系统信息', 'fa-link', 'admin', 'Index', 'system', '', 2, '', 1, 100, '2022-11-06 14:28:59'),
(137, 0, '其他菜单', 'fa-shield', 'admin', '', '', '', 2, '', 1, 100000, '2022-11-06 14:28:59'),
(138, 137, '个人资料', 'fa-link', 'admin', 'Index', 'profile', '', 2, '', 1, 100, '2022-11-06 14:28:59'),
(141, 75, 'UI组件', 'fa-pie-chart', 'admin', 'Home', 'components', '', 1, '', 1, 100, '2022-11-06 14:28:59'),
(142, 69, '全部菜单', 'fa-link', 'admin', 'Menu', 'get_all', '', 2, '', 1, 100, '2022-11-06 14:28:59'),
(143, 0, '公共权限', 'fa-folder-open', 'admin', '', '', '', 2, '', 1, 10000, '2022-11-06 14:28:59'),
(144, 143, '百度编辑器', 'fa-link', 'admin', 'Editor', 'ueditor', '', 2, '', 1, 100, '2022-11-06 14:28:59'),
(145, 64, '运维管理', 'fa-server', 'admin', '', '', '', 1, '', 1, 100, '2022-11-06 14:28:59'),
(146, 137, '清除缓存', 'fa-link', 'admin', 'Index', 'clear_cache', '', 2, '', 1, 100, '2023-03-15 14:16:27'),
(147, 143, '全部角色', 'fa-link', 'admin', 'Role', 'get_all', '', 2, '', 1, 100, '2023-03-15 14:17:55'),
(148, 137, '头像上传', 'fa-link', 'admin', 'Manager', 'avatar', '', 2, '', 1, 100, '2023-03-20 15:11:09'),
(149, 137, '退出登录', 'fa-link', 'admin', 'Index', 'logout', '', 2, '', 1, 100, '2023-03-21 10:46:54'),
(150, 1, '登录日志', 'fa-file-text', 'admin', 'SystemLoginLog', 'index', '', 1, '', 1, 100, '2023-03-21 11:55:24'),
(151, 150, '日志详情', 'fa-link', 'admin', 'SystemLoginLog', 'detail', '', 2, '', 1, 100, '2023-03-21 12:01:11'),
(152, 150, '日志清空', 'fa-link', 'admin', 'SystemLoginLog', 'clear', '', 2, '', 1, 100, '2023-03-21 12:01:22'),
(153, 137, '上传功能', 'fa-link', 'admin', '', '', '', 2, '', 1, 100, '2023-03-21 14:32:33'),
(154, 153, '图片上传', 'fa-link', 'admin', 'Upload', 'image', '', 2, '', 1, 100, '2023-03-21 14:32:51'),
(155, 153, '文件上传', 'fa-link', 'admin', 'Upload', 'file', '', 2, '', 1, 100, '2023-03-21 14:33:00'),
(156, 153, '文件检测', 'fa-link', 'admin', 'Upload', 'check', '', 2, '', 1, 100, '2023-03-21 14:33:07');

-- --------------------------------------------------------

--
-- 表的结构 `easy_permission`
--

CREATE TABLE `easy_permission` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '菜单ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `easy_permission`
--

INSERT INTO `easy_permission` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 128),
(2, 1, 99),
(3, 1, 75),
(4, 1, 2),
(5, 1, 76),
(6, 1, 80),
(7, 1, 79),
(8, 1, 134),
(9, 1, 69),
(10, 1, 121),
(11, 1, 122),
(12, 1, 114),
(13, 1, 1),
(14, 1, 81),
(15, 1, 85),
(16, 1, 86),
(17, 1, 73),
(18, 1, 82),
(19, 1, 83),
(20, 1, 84),
(21, 1, 74),
(22, 1, 72),
(23, 1, 64),
(24, 5, 128),
(26, 5, 75),
(27, 1, 136),
(28, 1, 138),
(29, 1, 137),
(34, 5, 99),
(35, 5, 136),
(36, 5, 138),
(37, 5, 137),
(38, 6, 128),
(39, 6, 99),
(40, 6, 136),
(41, 6, 75),
(62, 6, 138),
(63, 6, 137),
(65, 1, 141),
(66, 1, 142),
(69, 1, 143),
(70, 1, 144),
(71, 1, 145),
(72, 1, 146),
(73, 1, 147),
(74, 1, 148),
(75, 1, 149),
(76, 1, 150),
(77, 1, 151),
(78, 1, 152),
(79, 1, 153),
(80, 1, 154),
(81, 1, 155),
(82, 1, 156),
(83, 5, 141),
(84, 5, 146),
(85, 5, 148),
(86, 5, 149),
(87, 5, 153),
(88, 5, 154),
(89, 5, 155),
(90, 5, 156),
(91, 6, 141),
(92, 6, 146),
(93, 6, 148),
(94, 6, 149),
(95, 6, 153),
(96, 6, 154),
(97, 6, 155),
(98, 6, 156);

-- --------------------------------------------------------

--
-- 表的结构 `easy_role`
--

CREATE TABLE `easy_role` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色标识',
  `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '备注',
  `is_system` tinyint(1) NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色';

--
-- 转存表中的数据 `easy_role`
--

INSERT INTO `easy_role` (`id`, `title`, `name`, `remark`, `is_system`, `create_time`, `update_time`) VALUES
(1, '超级管理员', 'super', '拥有最高权限', 1, '2022-11-06 14:28:28', '2022-11-06 14:28:28'),
(5, '普通管理员', 'common', '普通权限', 2, '2022-11-06 14:28:28', '2022-11-06 14:28:28'),
(6, '部门管理员', 'department', '部门管理员', 2, '2022-11-06 14:28:28', '2022-11-06 14:28:28');

-- --------------------------------------------------------

--
-- 表的结构 `easy_setting_system`
--

CREATE TABLE `easy_setting_system` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '系统名称',
  `slogan` varchar(64) NOT NULL DEFAULT '' COMMENT '系统标语'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统配置';

--
-- 转存表中的数据 `easy_setting_system`
--

INSERT INTO `easy_setting_system` (`id`, `name`, `slogan`) VALUES
(1, 'EASYADMIN', 'PHP后台快速开发系统');

-- --------------------------------------------------------

--
-- 表的结构 `easy_system_login_log`
--

CREATE TABLE `easy_system_login_log` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `manager_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `description` varchar(64) NOT NULL COMMENT '描述信息',
  `login_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '登录IP',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '登录状态：1-登录成功，2-登录失败',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `easy_system_login_log`
--

INSERT INTO `easy_system_login_log` (`id`, `manager_id`, `description`, `login_ip`, `status`, `create_time`, `update_time`) VALUES
(14, 1, '登录成功', '127.0.0.1', 1, '2023-03-21 15:41:53', '2023-03-21 15:41:53'),
(15, 1, '登录成功', '127.0.0.1', 1, '2023-04-04 14:49:52', '2023-04-04 14:49:52'),
(16, 1, '登录成功', '127.0.0.1', 1, '2023-06-14 16:53:47', '2023-06-14 16:53:47'),
(17, 1, '登录成功', '127.0.0.1', 1, '2023-08-02 09:29:28', '2023-08-02 09:29:28'),
(18, 1, '登录成功', '127.0.0.1', 1, '2023-08-02 14:16:45', '2023-08-02 14:16:45');

-- --------------------------------------------------------

--
-- 表的结构 `easy_upload`
--

CREATE TABLE `easy_upload` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件MD5',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '文件名称',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `suffix` varchar(4) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `path` varchar(128) NOT NULL DEFAULT '' COMMENT '保存位置',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `easy_upload`
--

INSERT INTO `easy_upload` (`id`, `md5`, `name`, `size`, `suffix`, `path`, `create_time`) VALUES
(1, '396814d705b2ceb75f487e5c63e9c6c4', '1.png', 6034, 'png', '/uploads/images/20230321/4caedcd42419e7f699c4434fd2b2dd89.png', '2023-03-21 15:47:06');

--
-- 转储表的索引
--

--
-- 表的索引 `easy_log`
--
ALTER TABLE `easy_log`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_manager`
--
ALTER TABLE `easy_manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account` (`account`);

--
-- 表的索引 `easy_menu`
--
ALTER TABLE `easy_menu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_permission`
--
ALTER TABLE `easy_permission`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_role`
--
ALTER TABLE `easy_role`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_setting_system`
--
ALTER TABLE `easy_setting_system`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `easy_system_login_log`
--
ALTER TABLE `easy_system_login_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- 表的索引 `easy_upload`
--
ALTER TABLE `easy_upload`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `md5` (`md5`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `easy_log`
--
ALTER TABLE `easy_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=314;

--
-- 使用表AUTO_INCREMENT `easy_manager`
--
ALTER TABLE `easy_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `easy_menu`
--
ALTER TABLE `easy_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=157;

--
-- 使用表AUTO_INCREMENT `easy_permission`
--
ALTER TABLE `easy_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=99;

--
-- 使用表AUTO_INCREMENT `easy_role`
--
ALTER TABLE `easy_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `easy_setting_system`
--
ALTER TABLE `easy_setting_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `easy_system_login_log`
--
ALTER TABLE `easy_system_login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `easy_upload`
--
ALTER TABLE `easy_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
