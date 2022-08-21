-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2022-08-21 09:26:00
-- 服务器版本： 5.5.29
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
-- 表的结构 `easy_department`
--

CREATE TABLE `easy_department` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '部门名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `easy_department`
--

INSERT INTO `easy_department` (`id`, `parent_id`, `title`, `remark`, `create_time`) VALUES
(1, 0, '测试', '1', 1654267535);

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
  `params` longtext COMMENT '请求参数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '操作状态：1-成功，2-失败',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `delete_time` int(10) NOT NULL DEFAULT '0' COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统日志';

--
-- 转存表中的数据 `easy_log`
--

INSERT INTO `easy_log` (`id`, `manager_id`, `menu`, `description`, `url`, `params`, `status`, `create_time`, `delete_time`) VALUES
(145, 1, '日志清空', '系统自动记录：清空成功', '/admin/log/clear.html', '[]', 1, 1648035256, 0),
(146, 1, '菜单添加', '系统自动记录：节点名称不能为空', '/admin/menu/create.html', '{\"parent_id\":\"\",\"title\":\"\",\"icon\":\"fa-link\",\"module\":\"\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 2, 1654263065, 0),
(147, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '{\"id\":\"6\",\"title\":\"部门管理员\",\"name\":\"department\",\"remark\":\"部门管理员\",\"layuiTreeCheck_75\":\"75\",\"layuiTreeCheck_128\":\"128\",\"layuiTreeCheck_99\":\"99\",\"layuiTreeCheck_136\":\"136\",\"layuiTreeCheck_64\":\"64\",\"layuiTreeCheck_1\":\"1\",\"layuiTreeCheck_2\":\"2\",\"layuiTreeCheck_69\":\"69\",\"layuiTreeCheck_76\":\"76\",\"layuiTreeCheck_80\":\"80\",\"layuiTreeCheck_79\":\"79\",\"layuiTreeCheck_134\":\"134\",\"layuiTreeCheck_114\":\"114\",\"layuiTreeCheck_121\":\"121\",\"layuiTreeCheck_122\":\"122\",\"layuiTreeCheck_72\":\"72\",\"layuiTreeCheck_73\":\"73\",\"layuiTreeCheck_', 1, 1654271088, 0),
(148, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"136\",\"parent_id\":\"137\",\"title\":\"系统信息\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"index\",\"action\":\"system\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1654310409, 0),
(149, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"137\",\"parent_id\":\"\",\"title\":\"其他菜单\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1654310422, 0),
(150, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '{\"parent_id\":\"75\",\"title\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"index\",\"action\":\"ui\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1654310587, 0),
(151, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"layuiTreeCheck_75\":\"75\",\"layuiTreeCheck_128\":\"128\",\"layuiTreeCheck_99\":\"99\",\"layuiTreeCheck_141\":\"141\",\"layuiTreeCheck_64\":\"64\",\"layuiTreeCheck_1\":\"1\",\"layuiTreeCheck_2\":\"2\",\"layuiTreeCheck_69\":\"69\",\"layuiTreeCheck_76\":\"76\",\"layuiTreeCheck_80\":\"80\",\"layuiTreeCheck_79\":\"79\",\"layuiTreeCheck_134\":\"134\",\"layuiTreeCheck_114\":\"114\",\"layuiTreeCheck_121\":\"121\",\"layuiTreeCheck_122\":\"122\",\"layuiTreeCheck_72\":\"72\",\"layuiTreeCheck_73\":\"73\",\"layuiTreeCheck_81\":', 1, 1654310597, 0),
(152, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"138\",\"parent_id\":\"137\",\"title\":\"个人资料\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"index\",\"action\":\"profile\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1654310680, 0),
(153, 1, '个人资料', '系统自动记录：修改成功', '/admin/index/profile.html', '{\"id\":\"1\",\"file\":\"\",\"avatar\":\"\\/uploads\\/images\\/20220227\\/024757163b86acf4fe41710642fd1d54.jpg\",\"nickname\":\"黎明\",\"username\":\"admin\",\"password\":\"\"}', 1, 1654310747, 0),
(154, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"141\",\"parent_id\":\"75\",\"title\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"index\",\"action\":\"components\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1654310810, 0),
(155, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"141\",\"parent_id\":\"75\",\"title\":\"UI组件\",\"icon\":\"fa-pie-chart\",\"module\":\"admin\",\"controller\":\"home\",\"action\":\"components\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1654325035, 0),
(156, 1, '系统设置', '系统自动记录：修改成功', '/admin/setting/system.html', '{\"name\":\"EASYADMIN\",\"slogan\":\"PHP后台快速开发系统\"}', 1, 1660975385, 0),
(157, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '{\"parent_id\":\"69\",\"title\":\"全部菜单\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"menu\",\"action\":\"get_all\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660975601, 0),
(158, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '{\"parent_id\":\"\",\"title\":\"公共权限\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660975710, 0),
(159, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '{\"parent_id\":\"143\",\"title\":\"百度编辑器\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"editor\",\"action\":\"ue\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660975727, 0),
(160, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"144\",\"parent_id\":\"143\",\"title\":\"百度编辑器\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"editor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660975737, 0),
(161, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"144\",\"parent_id\":\"143\",\"title\":\"百度编辑器\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"editor\",\"action\":\"ueditor\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660977398, 0),
(162, 1, '管理员修改', '系统自动记录：修改成功', '/admin/manager/update.html', '{\"id\":\"1\",\"role_id\":\"1\",\"file\":\"\",\"avatar\":\"\\/uploads\\/images\\/20220227\\/024757163b86acf4fe41710642fd1d54.jpg\",\"nickname\":\"黎明\",\"username\":\"admin\",\"password\":\"\",\"status\":\"1\"}', 1, 1660977412, 0),
(163, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"64\",\"1\",\"2\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"114\",\"121\",\"122\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"139\",\"140\",\"137\",\"136\",\"138\",\"143\",\"144\"]}', 1, 1660978120, 0),
(164, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"64\",\"parent_id\":\"0\",\"title\":\"系统模块\",\"icon\":\"fa fa-fw fa-cogs\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"20\"}', 1, 1660978642, 0),
(165, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"136\",\"parent_id\":\"137\",\"title\":\"系统信息\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"index\",\"action\":\"system\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660978647, 0),
(166, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"136\",\"parent_id\":\"137\",\"title\":\"系统信息\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"index\",\"action\":\"system\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660978663, 0),
(167, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"137\",\"sort\":\"100\"}', 1, 1660979716, 0),
(168, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"137\",\"sort\":\"1000\"}', 1, 1660979721, 0),
(169, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"137\",\"sort\":\"100\"}', 1, 1660979751, 0),
(170, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"64\",\"sort\":\"2\"}', 1, 1660979758, 0),
(171, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"64\",\"sort\":\"20\"}', 1, 1660979776, 0),
(172, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"137\",\"sort\":\"10000\"}', 1, 1660979782, 0),
(173, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"143\",\"sort\":\"10000\"}', 1, 1660979786, 0),
(174, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"137\",\"sort\":\"100000\"}', 1, 1660979789, 0),
(175, 1, '菜单添加', '系统自动记录：添加成功', '/admin/menu/create.html', '{\"parent_id\":\"64\",\"title\":\"运维管理\",\"icon\":\"fa-server\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660979836, 0),
(176, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"69\",\"parent_id\":\"145\",\"title\":\"菜单设置\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"menu\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"0\"}', 1, 1660979844, 0),
(177, 1, '菜单排序', '系统自动记录：修改成功', '/admin/menu/sort.html', '{\"id\":\"69\",\"sort\":\"10\"}', 1, 1660979853, 0),
(178, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"145\",\"parent_id\":\"64\",\"title\":\"运维管理\",\"icon\":\"fa-link\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660979935, 0),
(179, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"145\",\"parent_id\":\"64\",\"title\":\"运维管理\",\"icon\":\"fa-server\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100\"}', 1, 1660979946, 0),
(180, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"143\",\"parent_id\":\"0\",\"title\":\"公共权限\",\"icon\":\"fa-folder-open\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10000\"}', 1, 1660979973, 0),
(181, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"137\",\"parent_id\":\"0\",\"title\":\"其他菜单\",\"icon\":\"fa-shield\",\"module\":\"admin\",\"controller\":\"\",\"action\":\"\",\"params\":\"\",\"type\":\"2\",\"link\":\"\",\"target\":\"1\",\"sort\":\"100000\"}', 1, 1660980026, 0),
(182, 1, '菜单修改', '系统自动记录：修改成功', '/admin/menu/update.html', '{\"id\":\"69\",\"parent_id\":\"145\",\"title\":\"菜单设置\",\"icon\":\"fa-bars\",\"module\":\"admin\",\"controller\":\"menu\",\"action\":\"index\",\"params\":\"\",\"type\":\"1\",\"link\":\"\",\"target\":\"1\",\"sort\":\"10\"}', 1, 1661044837, 0),
(183, 1, '角色修改', '系统自动记录：修改成功', '/admin/role/update.html', '{\"id\":\"1\",\"title\":\"超级管理员\",\"name\":\"super\",\"remark\":\"拥有最高权限\",\"permission\":[\"75\",\"128\",\"99\",\"141\",\"64\",\"1\",\"2\",\"114\",\"121\",\"122\",\"72\",\"73\",\"81\",\"85\",\"86\",\"74\",\"82\",\"83\",\"84\",\"139\",\"140\",\"145\",\"69\",\"76\",\"80\",\"79\",\"134\",\"142\",\"143\",\"144\",\"137\",\"136\",\"138\"]}', 1, 1661044847, 0);

-- --------------------------------------------------------

--
-- 表的结构 `easy_manager`
--

CREATE TABLE `easy_manager` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属用户组',
  `avatar` varchar(256) NOT NULL DEFAULT '' COMMENT '头像',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `is_system` tinyint(1) NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1-正常，2-禁用',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理员';

--
-- 转存表中的数据 `easy_manager`
--

INSERT INTO `easy_manager` (`id`, `role_id`, `avatar`, `nickname`, `username`, `password`, `is_system`, `status`, `create_time`, `update_time`) VALUES
(1, 1, '/uploads/images/20220227/024757163b86acf4fe41710642fd1d54.jpg', '黎明', 'admin', '', 1, 1, 1589289281, 1636035620),
(10, 1, '/uploads/images/20220227/047f8122f2040b206ba8ee713e6c235d.jpg', '测试管理员', 'test', '', 2, 1, 1589289298, 1638695354);

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
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统节点';

--
-- 转存表中的数据 `easy_menu`
--

INSERT INTO `easy_menu` (`id`, `parent_id`, `title`, `icon`, `module`, `controller`, `action`, `params`, `type`, `link`, `target`, `sort`) VALUES
(1, 64, '系统管理', 'fa-cogs', 'admin', '', '', '', 1, '', 1, 10),
(2, 1, '系统设置', 'fa-cog', 'admin', 'setting', 'system', '', 1, '', 1, 0),
(64, 0, '系统模块', 'fa fa-fw fa-cogs', 'admin', '', '', '', 1, '', 1, 20),
(69, 145, '菜单设置', 'fa-bars', 'admin', 'menu', 'index', '', 1, '', 1, 10),
(72, 64, '权限管理', 'fa-users', 'admin', '', '', '', 1, '', 1, 10),
(73, 72, '管理员', 'fa-user', 'admin', 'manager', 'index', '', 1, '', 1, 10),
(74, 72, '角色管理', 'fa-user-plus', 'admin', 'role', 'index', '', 1, '', 1, 10),
(75, 0, '系统主页', 'fa-home', 'admin', 'index', 'index', '', 1, '', 1, 10),
(76, 69, '菜单添加', 'fa-link', 'admin', 'menu', 'create', '', 2, '', 1, 10),
(79, 69, '菜单删除', 'fa-link', 'admin', 'menu', 'delete', '', 2, '', 1, 30),
(80, 69, '菜单修改', 'fa-link', 'admin', 'menu', 'update', '', 2, '', 1, 20),
(81, 73, '管理员添加', 'fa-link', 'admin', 'manager', 'create', '', 2, '', 1, 10),
(82, 74, '角色添加', 'fa-link', 'admin', 'role', 'create', '', 2, '', 1, 10),
(83, 74, '角色修改', 'fa-link', 'admin', 'role', 'update', '', 2, '', 1, 20),
(84, 74, '角色删除', 'fa-link', 'admin', 'role', 'delete', '', 2, '', 1, 30),
(85, 73, '管理员修改', 'fa-link', 'admin', 'manager', 'update', '', 2, '', 1, 10),
(86, 73, '管理员删除', 'fa-link', 'admin', 'manager', 'delete', '', 2, '', 1, 10),
(99, 75, '门户统计', 'fa-bar-chart', 'admin', 'home', 'dashboard', '', 1, 'https://www.baidu.com/', 1, 20),
(114, 1, '系统日志', 'fa-book', 'admin', 'log', 'index', '', 1, '', 1, 30),
(121, 114, '日志详情', 'fa-link', 'admin', 'log', 'detail', '', 2, '', 1, 10),
(122, 114, '日志清空', 'fa-link', 'admin', 'log', 'clear', '', 2, '', 1, 20),
(128, 75, '控制台', 'fa-dashboard', 'admin', 'home', 'console', '', 1, '', 1, 10),
(134, 69, '菜单排序', 'fa-link', 'admin', 'menu', 'sort', '', 2, '', 1, 100),
(136, 137, '系统信息', 'fa-link', 'admin', 'index', 'system', '', 2, '', 1, 100),
(137, 0, '其他菜单', 'fa-shield', 'admin', '', '', '', 2, '', 1, 100000),
(138, 137, '个人资料', 'fa-link', 'admin', 'index', 'profile', '', 2, '', 1, 100),
(139, 72, '部门管理', 'fa-archive', 'admin', 'department', 'index', '', 1, '', 1, 100),
(140, 139, '部门添加', 'fa-link', 'admin', 'department', 'create', '', 2, '', 1, 100),
(141, 75, 'UI组件', 'fa-pie-chart', 'admin', 'home', 'components', '', 1, '', 1, 100),
(142, 69, '全部菜单', 'fa-link', 'admin', 'menu', 'get_all', '', 2, '', 1, 100),
(143, 0, '公共权限', 'fa-folder-open', 'admin', '', '', '', 2, '', 1, 10000),
(144, 143, '百度编辑器', 'fa-link', 'admin', 'editor', 'ueditor', '', 2, '', 1, 100),
(145, 64, '运维管理', 'fa-server', 'admin', '', '', '', 1, '', 1, 100);

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
(42, 6, 2),
(43, 6, 76),
(44, 6, 80),
(45, 6, 79),
(46, 6, 134),
(47, 6, 69),
(48, 6, 121),
(49, 6, 122),
(50, 6, 114),
(51, 6, 1),
(52, 6, 81),
(53, 6, 85),
(54, 6, 86),
(55, 6, 73),
(56, 6, 82),
(57, 6, 83),
(58, 6, 84),
(59, 6, 74),
(60, 6, 72),
(61, 6, 64),
(62, 6, 138),
(63, 6, 137),
(65, 1, 141),
(66, 1, 142),
(67, 1, 139),
(68, 1, 140),
(69, 1, 143),
(70, 1, 144),
(71, 1, 145);

-- --------------------------------------------------------

--
-- 表的结构 `easy_role`
--

CREATE TABLE `easy_role` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色标识',
  `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '备注',
  `is_super` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否超级权限，1-启用，2-禁用',
  `is_system` tinyint(1) NOT NULL DEFAULT '2' COMMENT '系统内置，1-启用，2-禁用',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色';

--
-- 转存表中的数据 `easy_role`
--

INSERT INTO `easy_role` (`id`, `title`, `name`, `remark`, `is_super`, `is_system`, `create_time`, `update_time`) VALUES
(1, '超级管理员', 'super', '拥有最高权限', 1, 1, 0, 1635769679),
(5, '普通管理员', 'common', '普通权限', 2, 2, 0, 1638696187),
(6, '部门管理员', 'department', '部门管理员', 2, 2, 1645933596, 1645933596);

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
-- 表的结构 `easy_upload`
--

CREATE TABLE `easy_upload` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件MD5',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '文件名称',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `suffix` varchar(4) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `path` varchar(128) NOT NULL DEFAULT '' COMMENT '保存位置',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '上传时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `easy_upload`
--

INSERT INTO `easy_upload` (`id`, `md5`, `name`, `size`, `suffix`, `path`, `create_time`) VALUES
(17, '7408603c72203747e0f6720f87aaec5b', 'test_db-master.zip', 36688498, 'zip', '/uploads/bigfile/20220604/7408603c72203747e0f6720f87aaec5b.zip', 1654341571);

--
-- 转储表的索引
--

--
-- 表的索引 `easy_department`
--
ALTER TABLE `easy_department`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `username` (`username`);

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
-- 表的索引 `easy_upload`
--
ALTER TABLE `easy_upload`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `md5` (`md5`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `easy_department`
--
ALTER TABLE `easy_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `easy_log`
--
ALTER TABLE `easy_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=184;

--
-- 使用表AUTO_INCREMENT `easy_manager`
--
ALTER TABLE `easy_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `easy_menu`
--
ALTER TABLE `easy_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=146;

--
-- 使用表AUTO_INCREMENT `easy_permission`
--
ALTER TABLE `easy_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=72;

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
-- 使用表AUTO_INCREMENT `easy_upload`
--
ALTER TABLE `easy_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
