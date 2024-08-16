-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-07-23 11:19:41
-- 服务器版本： 5.5.62-log
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `xunxian`
--

-- --------------------------------------------------------

--
-- 表的结构 `forum_res`
--

CREATE TABLE `forum_res` (
  `belong` varchar(255) NOT NULL,
  `sid` text NOT NULL,
  `created_time` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `forum_text`
--

CREATE TABLE `forum_text` (
  `id` int(11) NOT NULL,
  `sid` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `response_count` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `game1`
--

CREATE TABLE `game1` (
  `uis_designer` int(1) NOT NULL DEFAULT '0' COMMENT '是否有后台权限。',
  `uis_forum_gm` int(1) NOT NULL COMMENT '是否论坛版主',
  `uid` int(11) NOT NULL,
  `ucmd` text NOT NULL COMMENT '//当前页面cmd',
  `ulast_cmd` text NOT NULL COMMENT '//最后页面cmd',
  `uphone` varchar(11) NOT NULL,
  `sid` text CHARACTER SET utf8 NOT NULL,
  `token` text CHARACTER SET utf8 NOT NULL,
  `utran_state` int(11) NOT NULL COMMENT '交易状态，0未交易，1正在进行交易请求确认，2正在交易',
  `uname` text CHARACTER SET utf8 NOT NULL,
  `uimage` varchar(255) NOT NULL,
  `unick_name` text NOT NULL,
  `ulvl` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `uburthen` int(10) NOT NULL,
  `umax_burthen` int(10) NOT NULL,
  `ustorage` int(10) NOT NULL,
  `uis_pve` int(1) NOT NULL DEFAULT '0' COMMENT '0为关闭1为开启',
  `ukill` int(1) NOT NULL COMMENT '0为关闭1为开启',
  `uauto_fight` int(1) NOT NULL COMMENT '0为关闭状态，1为开启状态',
  `uis_sailing` int(11) NOT NULL COMMENT '0为关闭状态，1为开启状态',
  `uauto_sailing` int(11) NOT NULL COMMENT '0为关闭状态，1为开启状态',
  `umoney` int(11) NOT NULL DEFAULT '0',
  `uteam_invited_id` int(11) NOT NULL,
  `uteam_id` int(11) NOT NULL,
  `uteam_putin_id` int(11) NOT NULL,
  `uexp` int(11) NOT NULL DEFAULT '0',
  `uhp` int(11) NOT NULL DEFAULT '100',
  `umaxhp` int(11) NOT NULL DEFAULT '100',
  `ugj` int(11) NOT NULL DEFAULT '12',
  `ufy` int(11) NOT NULL DEFAULT '5',
  `usex` text NOT NULL,
  `endtime` datetime NOT NULL,
  `minutetime` datetime NOT NULL,
  `nowmid` int(11) NOT NULL DEFAULT '225',
  `justmid` int(11) NOT NULL,
  `tpsmid` int(11) NOT NULL,
  `nowguaiwu` int(11) NOT NULL,
  `sfzx` int(11) NOT NULL DEFAULT '0',
  `allchattime` datetime NOT NULL,
  `citychattime` datetime NOT NULL,
  `areachattime` datetime NOT NULL,
  `cw` int(11) NOT NULL,
  `ispvp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `game1`
--

INSERT INTO `game1` (`uis_designer`, `uis_forum_gm`, `uid`, `ucmd`, `ulast_cmd`, `uphone`, `sid`, `token`, `utran_state`, `uname`, `uimage`, `unick_name`, `ulvl`, `uburthen`, `umax_burthen`, `ustorage`, `uis_pve`, `ukill`, `uauto_fight`, `uis_sailing`, `uauto_sailing`, `umoney`, `uteam_invited_id`, `uteam_id`, `uteam_putin_id`, `uexp`, `uhp`, `umaxhp`, `ugj`, `ufy`, `usex`, `endtime`, `minutetime`, `nowmid`, `justmid`, `tpsmid`, `nowguaiwu`, `sfzx`, `allchattime`, `citychattime`, `areachattime`, `cw`, `ispvp`) VALUES
(1, 1, 1, '', 'gm_scene_new', '18150040719', '959c9277a3e15eacff9e5f117e51f5bb', '6153c573c2237ed0422c426d6786dc4f', 1, '轩辕', '', '旧街居民', 77, 100, 100, 0, 0, 0, 0, 0, 1, 1697, 0, 0, 0, 101553, 14219, 14268, 32, 30, '男', '2024-07-23 11:18:30', '2024-07-23 11:19:28', 346, 346, 0, 0, 1, '2024-07-22 12:12:39', '2023-12-14 14:59:02', '2023-12-14 15:00:25', 0, 0),
(0, 0, 2, '', 'gm_scene_new', '', '68dcd3cd66a76b81cfc90c0e147617d4', 'e0eaeb7d19fcde3fbd6075c91a6e7039', 1, '秋梦', '', '', 13, 31, 50, 0, 0, 0, 1, 0, 0, 1319770, 0, 0, 0, 3380, 1, 828, 33, 5, '女', '2024-07-23 11:18:26', '2024-07-23 11:19:11', 225, 225, 0, 0, 1, '2024-07-04 02:11:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 3, '', 'gm_scene_new', '', '0277b7c43250e3bda5d7fb423ce14d92', '8d85deb95ac222630170d467d3ebf9ef', 0, '梦秋', '', '', 1, 2, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '女', '2023-12-13 15:32:46', '2023-12-13 15:32:56', 225, 225, 0, 0, 0, '2023-12-13 15:32:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 4, '', 'gm_scene_new', '', '214658c4375c343e280ae38e880ac4ba', '8fcae6b1a6f201d1b25d3186f1887f6a', 1, '心醉迷神', '', '', 2, 28, 50, 0, 0, 0, 0, 0, 0, 50, 0, 0, 0, 292, 47, 168, 12, 5, '女', '2024-06-06 13:01:18', '2024-06-06 08:03:11', 671, 671, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 5, '', 'gm_scene_new', '', 'a8c7b0c51c60be7441214c0b0c671d88', '11de1b2d74bff722bf47c1fe0d7a1586', 1, 'xunxian', '', '', 1, 10, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-06 23:12:06', '2024-06-06 23:12:26', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 6, '', 'gm_scene_new', '', '01a0d4f5e64a677721a1089d4914bc6a', 'bd6ad1a2bd957d1af8f9029bd86054b2', 0, '规划', '', '', 1, 15, 50, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 100, 12, 5, '男', '2024-06-05 06:09:08', '2024-06-05 06:09:49', 671, 671, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 7, '', '', '', '79462faa70c368423c7f9fb106fa1f47', '8a3f0145cdd02d3a5b21faa47335ad5a', 0, 'aaa123', '', '', 1, 13, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-05 14:05:43', '2024-06-05 14:06:14', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 8, '', 'gm_game_firstpage', '', '945fd26d30e007abfed414cc1f2795f5', '5fd37cf7246fdd96c1a6808dd0a9776c', 0, '天涯', '', '', 5, 27, 50, 0, 0, 0, 0, 0, 0, 70, 0, 0, 0, 560, 294, 300, 12, -90, '男', '2024-06-09 10:37:30', '2024-06-09 10:38:00', 358, 358, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 9, '', 'gm_scene_new', '', 'f55913444ef985484baf7580c60f15ce', '3bd64d874d8de07e0c000130eac39cd1', 0, '天涯小号', '', '', 2, 25, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 278, 1, 168, 17, 9, '男', '2024-06-05 22:33:44', '2024-06-05 22:33:55', 338, 338, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 10, '', 'gm_scene_new', '', 'fe3319b6dd10f68aaa36ee852cd79cc1', '7b69c4b07cd900f5b85f89e64e834d38', 0, '云澈', '', '', 1, 25, 50, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 100, 100, 1000, 5, '男', '2024-06-27 15:19:03', '2024-06-27 15:18:57', 565, 565, 0, 0, 1, '0000-00-00 00:00:00', '2024-06-06 01:04:31', '2024-06-06 01:04:26', 0, 0),
(0, 0, 11, '', 'gm_scene_new', '', '01acd0637eb2b6a6a3055e4fc37e8457', 'a7d8a52f6f62b749aacd656156101e9e', 0, '蜉蝣', '', '', 1, 14, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1, 100, 12, 5, '男', '2024-07-06 23:32:07', '2024-07-06 23:31:44', 672, 672, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 12, '', 'gm_game_firstpage', '', '2f4746d4d36396302d36e51c969d3e68', '604077277c57e12b1e3f0a9815a979fa', 0, '急急忙忙', '', '', 1, 11, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-07 07:06:54', '2024-06-06 08:20:52', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 13, '', 'gm_scene_new', '', 'e3130d019f7689f5501bc3633f97eb88', '9cc64b284957f1afb54f20caceac59a0', 0, '大王的', '', '', 1, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-11 22:32:11', '2024-06-11 22:33:02', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 14, '', '', '', '76623f3a68872fa88502af535498a991', 'b0d565aa0d423b7507a2ff7eda5db95f', 0, '测试123', '', '', 1, 20, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-15 10:09:52', '2024-06-15 10:09:48', 226, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 15, '', '', '', 'f244e629c0bc88068f2ecd6baf212683', 'fd7900c0d69114b7caad71ce86c9eb58', 0, '34D大波', '', '', 1, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '女', '2024-06-15 11:46:07', '2024-06-15 11:47:02', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 16, '', 'npc_html', '', 'f4cd01caaf9ec17c03413de91b97b5f2', '4be4c87864dc5d0fcc627e4d96806211', 0, '34D大波浪', '', '', 1, 11, 50, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 90, 100, 12, 5, '女', '2024-06-15 13:04:36', '2024-06-15 13:04:43', 230, 229, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 17, '', 'gm_scene_new', '', '344773e829d514e37d748e906a4f020a', '3452fa0da5eba8106aa44154660dd821', 0, '寒奇', '', '', 1, 16, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-21 20:28:07', '2024-06-21 20:28:45', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 18, '', 'gm_scene_new', '', '6b5913cfa12674939ee93c59e0bb7254', 'c0cfb06999cc03b9c027a0777cbf38fa', 0, '测试33', '', '', 1, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '男', '2024-06-28 17:22:14', '2024-06-28 17:22:30', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 19, '', 'npc_html', '', '976f6bbeda6b3bca384d8842e569f05e', '05ee93c4c6d65097cf576b439e6a7413', 0, '轩辕22', '', '', 1, 0, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 12, 5, '女', '2024-06-30 14:17:54', '2024-06-30 14:18:06', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 20, '', 'gm_scene_new', '', '98c50608a11ec800fba8b2d0b7294aeb', '137033b69556ca35b8fb9da749db1a57', 0, '等我打完', '', '', 1, 14, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 82, 100, 12, 5, '男', '2024-06-30 16:15:07', '2024-06-30 16:15:36', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(0, 0, 21, '', 'gm_scene_new', '', '269d6f1d2272bf0f3af7633340052a03', '51a8c1a197e4c37ce59cc3af3b5c5d5e', 0, '鳈江', '', '', 1, 18, 50, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 11, 100, 100, 12, 5, '男', '2024-07-23 10:59:50', '2024-07-23 11:00:27', 229, 229, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `game2`
--

CREATE TABLE `game2` (
  `sid` text NOT NULL,
  `gid` text NOT NULL,
  `fight_umsg` text NOT NULL,
  `fight_omsg` text NOT NULL,
  `hurt_hp` text NOT NULL,
  `cut_hp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='临时表';

-- --------------------------------------------------------

--
-- 表的结构 `game3`
--

CREATE TABLE `game3` (
  `gid` text NOT NULL,
  `sid` text NOT NULL,
  `fight_umsg` text NOT NULL,
  `fight_omsg` text NOT NULL,
  `hurt_hp` text NOT NULL,
  `cut_hp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='怪物临时表';

-- --------------------------------------------------------

--
-- 表的结构 `game4`
--

CREATE TABLE `game4` (
  `sid` text NOT NULL,
  `device_agent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `game_equip_page`
--

CREATE TABLE `game_equip_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_equip_page`
--

INSERT INTO `game_equip_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(2, 1, '3', '', '装备核心列表\r\n', NULL, '0', '78', NULL),
(1, 2, '1', '', '这里可以进行一些自定义文本或操作\r\n============\r\n', NULL, '0', NULL, NULL),
(3, 3, '1', '', '============\r\n下面可以加一些操作元素或跳转状态物品等\r\n', NULL, '0', NULL, NULL),
(4, 4, '3', '', '我的状态\r\n', NULL, '0', '14', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_function_page`
--

CREATE TABLE `game_function_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_function_page`
--

INSERT INTO `game_function_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 3, '1', '', '[功能设置]\r\n新纪元{eval(v(g.minute)/360)}年{eval(v(g.minute)>=360?(v(g.minute)%360/30+1):(v(g.minute)/30+1))}月{eval(v(g.minute)>=30?(v(g.minute)%30+1):(v(g.minute)+1))}日\r\n', NULL, '0', NULL, NULL),
(2, 4, '3', '', '快捷键设置\r\n', NULL, '0', '29', '0'),
(5, 5, '3', '{u.is_designer}==1', '显示设置\r\n', NULL, '0', '30', NULL),
(6, 6, '3', '{u.is_designer}==1', '在线玩家\r\n', NULL, '0', '34', NULL),
(7, 7, '3', '', '好友列表\r\n', NULL, '0', '22', '0'),
(11, 8, '3', '', '游戏首页\r\n', NULL, '0', '12', '0'),
(8, 9, '3', '', '黑名单\r\n', NULL, '0', '23', '0'),
(9, 10, '3', '', '手机号码\r\n', NULL, '0', '69', '0'),
(10, 11, '3', '', '报时：{c.nowtime_H:i:s}\r\n', NULL, '0', '13', '0'),
(3, 12, '3', '', '排行榜\r\n', NULL, '0', '33', NULL),
(4, 13, '3', '', '拍卖行\r\n', NULL, '0', '32', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_item_page`
--

CREATE TABLE `game_item_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_item_page`
--

INSERT INTO `game_item_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(2, 1, '1', '', '{o.name}x{o.count}\r\n', NULL, '0', NULL, '0'),
(4, 2, '1', '', '【类别】:{o.type}{eval(v(o.subtype)!=\"\"&&v(o.type)!=\"兵器\"&&v(o.type)!=\"防具\"?\"-v(o.subtype)\":\"\")}\r\n【重量】:{o.weight}\r\n【来源】:{o.root}\r\n【介绍】:{o.desc}\r\n【是否可赠送】:{eval(v(o.no_give)==\"0\"?\"是\":\"否\")}\r\n【是否可丢弃】:{eval(v(o.no_out)==\"0\"?\"是\":\"否\")}\r\n', NULL, '0', NULL, NULL),
(3, 3, '1', '', '【价格】:{o.price}枚\r\n', NULL, '0', NULL, NULL),
(7, 4, '3', '', '操作列表\r\n', NULL, '0', '6', '0'),
(5, 7, '1', '{o.type} == \"兵器\"', '【攻击力】:{o.attack_value}\r\n【物攻】:{o.wg_fj}\r\n【魔攻】:{o.mg_add}\r\n', NULL, '0', NULL, NULL),
(6, 8, '1', '{o.type} == \"防具\"', '【防御力】:{o.recovery_value}\r\n', NULL, '0', NULL, NULL),
(1, 9, '1', '{o.image}!=\'\'', '#{o.image}#', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_main_page`
--

CREATE TABLE `game_main_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT '0',
  `value` varchar(255) DEFAULT '0',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_main_page`
--

INSERT INTO `game_main_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '【{c.name}-{c.status_string}】\r\n{c.desc}\r\n', NULL, '0', NULL, NULL),
(2, 2, '3', '{u.is_designer}==1', '设计游戏\r\n', NULL, '0', '64', '0'),
(3, 3, '3', '', '进入游戏', NULL, '0', '65', NULL),
(9, 5, '1', '', '{e.time_name}好！\r\n{e.greeting_text}\r\n----------------\r\n@ff0000@《健康游戏忠告》@end@\r\n抵制不良游戏，拒绝盗版游戏\r\n适度游戏益脑，沉迷游戏伤身\r\n合理安排时间，享受健康生活\r\n', NULL, '0', NULL, NULL),
(10, 6, '2', '', '用户协议', NULL, '2', NULL, NULL),
(5, 10, '3', '', '游戏论坛\r\n', NULL, '0', '66', NULL),
(4, 11, '1', '', '|', NULL, '0', '1', NULL),
(6, 12, '2', '', '背景故事', NULL, '45', NULL, NULL),
(7, 13, '1', '', '|', NULL, '0', '1', NULL),
(8, 15, '4', '', '同人小说\r\n', NULL, '0', NULL, 'https://book.qidian.com/info/1035615776/'),
(11, 16, '1', '', '|', NULL, '0', '1', NULL),
(12, 17, '2', '', '账号安全\r\n', NULL, '44', '1', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_npc_page`
--

CREATE TABLE `game_npc_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '0',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_npc_page`
--

INSERT INTO `game_npc_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(2, 1, '1', '{o.nick_name}!=\'\'||{o.nick_name}!=0', '{o.nick_name}.', NULL, '0', NULL, NULL),
(3, 2, '1', '', '「{o.name}」\r\n性别：{eval(v(o.sex)!=\"\"?v(o.sex):\"未知\")}\r\n{eval(v(o.kill)==1?\"等级：v(o.lvl)级\":\"一个善良的人\")}\r\n', NULL, '0', NULL, NULL),
(7, 3, '3', '', '操作列表\r\n', NULL, '0', '6', '0'),
(9, 4, '1', '{o.desc}!=\'\'', '{o.desc}\r\n', NULL, '0', NULL, '0'),
(4, 5, '1', '{o.kill} ==1', '体力：{o.hp}/{o.maxhp}\r\n攻击力：{o.gj}\r\n防御力：{o.fy}\r\n', NULL, '0', NULL, '0'),
(6, 8, '1', '{o.skills_cmmt}!=\"\"', '技能：{o.skills_cmmt}\r\n', NULL, '0', NULL, NULL),
(5, 9, '1', '{o.equips_cmmt}!=\"\"', '装备：{o.equips_cmmt}\r\n', NULL, '0', NULL, NULL),
(1, 10, '1', '', '「{u.env.name}」\r\n', NULL, '0', NULL, NULL),
(8, 11, '3', '{o.id}==\"35\"', '镶嵌装备\r\n', NULL, '0', '77', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_oplayer_page`
--

CREATE TABLE `game_oplayer_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '0',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_oplayer_page`
--

INSERT INTO `game_oplayer_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(2, 3, '1', '', '「{o.name}」\r\n{eval(v(o.image)!=\"\"?\"#v(o.image)#\":\"\")}\r\n一个纯洁善良的人（罪恶值：0）。\r\n{o.lvl}级{o.sex}{eval(v(o.nick_name)!=\"\"?\"【{o.nick_name}】\":\"【无名之辈】\")}\r\n「{o.env.name}」-{eval(v(ot.is_computer)==0?\"「手机在线」\":(v(ot.is_computer)==1?\"「电脑在线」\":\"「离线」\"))}\r\n状态:正常，看上去精力充沛\r\n', NULL, '0', NULL, NULL),
(3, 4, '3', '', '操作列表\r\n', NULL, '0', '6', '0'),
(1, 5, '1', '', '「世界的初学者」\r\n', NULL, '0', NULL, NULL),
(4, 9, '3', '{u.is_designer} ==1', '邀请组队\r\n', NULL, '0', '43', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_pet_page`
--

CREATE TABLE `game_pet_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `game_player_page`
--

CREATE TABLE `game_player_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '0',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_player_page`
--

INSERT INTO `game_player_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '[{eval(v(u.nick_name)!=\"\"?\"v(u.nick_name)\":\"无\")}]姓名：{u.name}\r\nid：{u.id}\r\n性别：{u.sex}\r\n等级：{u.lvl}\r\n经验：{u.exp}/{eval(v(e.maxexp))}\r\n生命：{u.hp}/{u.maxhp}\r\n信用币：{u.money}\r\n负重：{u.burthen}/{u.max_burthen}\r\n攻击力：{u.gj}\r\n防御力：{u.fy}\r\n===\r\n在线时间：{u.zxsj}分\r\n===\r\n', NULL, '0', NULL, NULL),
(2, 2, '3', '', '物品', NULL, '0', '17', '0'),
(3, 3, '3', '', '聊天', NULL, '0', '24', '0'),
(4, 4, '3', '', '技能\r\n', NULL, '0', '15', '0'),
(5, 7, '3', '', '装备', NULL, '0', '16', '0'),
(6, 8, '3', '', '好友', NULL, '0', '22', NULL),
(7, 11, '3', '', '队伍\r\n', NULL, '0', '19', NULL),
(8, 12, '2', '', '测试操作\r\n', NULL, '98', '1', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_pve_page`
--

CREATE TABLE `game_pve_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '0',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_pve_page`
--

INSERT INTO `game_pve_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(8, 2, '1', '', '[{u.name}]:({u.hp}/{u.maxhp})', NULL, '0', NULL, NULL),
(9, 3, '1', '{ut.cut_hp}!=\'\'', '{ut.cut_hp}\r\n', NULL, '0', NULL, '0'),
(10, 4, '1', '{ut.cut_hp}==\'\'', '\r\n', NULL, '0', NULL, NULL),
(11, 5, '1', '', '----------\r\n', NULL, '0', NULL, '0'),
(12, 6, '3', '', '敌人状态\r\n', NULL, '0', '60', '0'),
(5, 8, '3', '', '快捷键1', NULL, '0', '50', '0'),
(6, 9, '3', '', '快捷键2', NULL, '0', '51', '0'),
(7, 10, '3', '', '快捷键3\r\n', NULL, '0', '52', '0'),
(14, 11, '3', '', '逃跑\r\n', NULL, '0', '63', NULL),
(15, 12, '1', '', '报时:{c.nowtime_H:i:s}\r\n', NULL, '0', '1', NULL),
(2, 13, '3', '{u.auto_fight}==0', '开启自动战斗', NULL, '0', '71', NULL),
(3, 14, '3', '{u.auto_fight}==1', '关闭自动战斗', NULL, '0', '72', NULL),
(4, 15, '3', '', '查看\r\n', NULL, '0', '73', NULL),
(13, 16, '3', '{ut.fight_omsg}!=\'\'', '敌人攻击描述\r\n', NULL, '0', '62', NULL),
(1, 17, '3', '{ut.fight_umsg}!=\"\"', '自己攻击描述\r\n', NULL, '0', '61', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_scene_page`
--

CREATE TABLE `game_scene_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '0',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_scene_page`
--

INSERT INTO `game_scene_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '你{eval(v(u.env.nowmid)==v(u.env.justmid)?\"站在\":\"来到\")}「{o.name}」({u.refresh_time})\r\n', NULL, '0', NULL, NULL),
(15, 2, '3', '', '任务', NULL, '0', '21', NULL),
(14, 3, '3', '', '刷新', NULL, '0', '1', NULL),
(8, 4, '3', '{u.env.npc_count}>0', 'npc\r\n', NULL, '0', '3', NULL),
(10, 5, '3', '{u.env.user_count}>1&&{o.is_shield}==0', '附近玩家\r\n', NULL, '0', '2', NULL),
(18, 6, '1', '{o.up}!=0 || {o.down}!=0 || {o.left}!=0 || {o.right}!=0', '从「{o.name}」出发:\r\n', NULL, '0', NULL, NULL),
(20, 7, '3', '', '东向出口\r\n', NULL, '0', '7', '0'),
(6, 8, '1', '', '{o.desc}\r\n', NULL, '0', NULL, NULL),
(21, 9, '3', '', '南向出口\r\n', NULL, '0', '8', '0'),
(22, 10, '3', '', '西向出口\r\n', NULL, '0', '9', '0'),
(19, 11, '3', '', '北向出口\r\n', NULL, '0', '10', NULL),
(13, 12, '3', '', '地上物品\r\n', NULL, '0', '4', NULL),
(17, 13, '3', '', '地图\r\n', NULL, '0', '11', NULL),
(24, 14, '3', '', '物品', NULL, '0', '17', '0'),
(23, 15, '3', '', '状态', NULL, '0', '14', '0'),
(26, 16, '3', '', '首页', NULL, '0', '12', '0'),
(4, 18, '3', '', '操作列表\r\n', NULL, '0', '6', NULL),
(33, 19, '3', '', '报时', NULL, '0', '13', '0'),
(11, 20, '3', '', '聊天信息\r\n', NULL, '0', '5', '0'),
(16, 21, '3', '', '聊天', NULL, '0', '24', NULL),
(25, 25, '3', '', '技能\r\n', NULL, '0', '15', '0'),
(34, 26, '1', '', ':{c.nowtime_H:i:s}\r\n', NULL, '0', NULL, '0'),
(9, 27, '1', '{u.env.user_count}>1&&{o.is_shield}==0', '遇到', NULL, '0', NULL, NULL),
(29, 28, '3', '', '功能', NULL, '0', '28', NULL),
(27, 29, '3', '', '好友', NULL, '0', '22', NULL),
(30, 30, '3', '', '抽奖', NULL, '0', '70', NULL),
(28, 31, '2', '', '签到\r\n', NULL, '1', NULL, NULL),
(35, 34, '2', '{u.is_designer} ==1', 'GM传送\r\n', NULL, '16', NULL, NULL),
(31, 35, '3', '', '队伍\r\n', NULL, '0', '19', NULL),
(2, 36, '1', '{o.photo}!=\'\'', '#{o.photo}#\r\n', NULL, '0', NULL, NULL),
(3, 37, '3', '{o.is_tp}==1&&{o.tp_type}==1', '出航\r\n', NULL, '0', '74', NULL),
(12, 39, '1', '{u.env.item_count}>0', '发现', NULL, '0', NULL, NULL),
(7, 40, '1', '{u.env.npc_count}>0', '遇到', NULL, '0', NULL, NULL),
(5, 41, '3', '{o.is_rp}!=0', '采集资源\r\n', NULL, '0', '76', NULL),
(32, 42, '3', '', '宠物\r\n', NULL, '0', '20', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_bounty_01`
--

CREATE TABLE `game_self_page_bounty_01` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_bounty_01`
--

INSERT INTO `game_self_page_bounty_01` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '歌尔特:「你好，「{u.name}」，为了共同对抗异变，我，【风啸佣兵团团长】，会不定期发布一些悬赏任务，只要达到要求，便可以换取丰厚物资，当然，每个人每天能领取的悬赏任务也是有限额的，我们得考虑勇士们的身体！」\r\n===============\r\n1.「怪物材料日常提交」\r\n', NULL, '0', NULL, NULL),
(2, 2, '1', '', '★变异利爪x10', NULL, '0', NULL, NULL),
(3, 3, '2', '{u.submit_bounty_01_item_01}!={c.date}', '提交\r\n', NULL, '78', '1', NULL),
(4, 4, '1', '{u.submit_bounty_01_item_01}=={c.date}', '「今日已提交」\r\n', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_HP_lift_1`
--

CREATE TABLE `game_self_page_HP_lift_1` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_HP_lift_1`
--

INSERT INTO `game_self_page_HP_lift_1` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '「{u.env.name}-{u.tomorrow_1_floor}层」\r\n', NULL, '0', NULL, NULL),
(2, 2, '2', '', '选择层数\r\n', NULL, '84', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_HW003`
--

CREATE TABLE `game_self_page_HW003` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_HW003`
--

INSERT INTO `game_self_page_HW003` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '【露天浴场】\r\nH-W-003：您好，{u.name}，有什么可以帮你的？\r\n', NULL, '0', NULL, NULL),
(2, 2, '2', '', '[阅读水源守则]\r\n', NULL, '34', '1', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_tent`
--

CREATE TABLE `game_self_page_tent` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_tent`
--

INSERT INTO `game_self_page_tent` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '{u.name}，这是你的帐篷。\r\n尺寸：「{u.tent_x}」米x「{u.tent_y}」米x「{u.tent_z}」米\r\n颜色：{u.tent_color}\r\n容量：{u.tent_burthen}\r\n', NULL, '0', NULL, NULL),
(2, 2, '2', '', '进入帐篷\r\n', NULL, '31', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_test`
--

CREATE TABLE `game_self_page_test` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_test`
--

INSERT INTO `game_self_page_test` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '【签到福利】\r\n你好，【{u.name}】，欢迎来到签到页面！\r\n', NULL, '0', NULL, '0'),
(2, 2, '2', '', '签到\r\n', NULL, '75', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_vip`
--

CREATE TABLE `game_self_page_vip` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_vip`
--

INSERT INTO `game_self_page_vip` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '测试操作\r\n', NULL, '0', NULL, NULL),
(2, 2, '2', '', '测试操作\r\n', NULL, '108', '1', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_skill_page`
--

CREATE TABLE `game_skill_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT '未命名',
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_skill_page`
--

INSERT INTO `game_skill_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '【{m.name}】{eval(v(m.default)==1?\"[默认]\":\"\")}\r\n技能介绍:{m.desc}\r\n等级:{m.lvl}【{m.point}/{eval(v(m.promotion))}】\r\n伤害系数:{m.hurt_mod}\r\n攻击范围:{m.group_attack}\r\n伤害目标:{m.hurt_attr}\r\n消耗目标:{m.deplete_attr}\r\n', NULL, '0', NULL, NULL),
(2, 2, '3', '', '操作列表\r\n', NULL, '0', '6', '0');

-- --------------------------------------------------------

--
-- 表的结构 `global_data`
--

CREATE TABLE `global_data` (
  `gid` varchar(255) NOT NULL,
  `gvalue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `global_data`
--

INSERT INTO `global_data` (`gid`, `gvalue`) VALUES
('minute', '54182');

-- --------------------------------------------------------

--
-- 表的结构 `gm_game_attr`
--

CREATE TABLE `gm_game_attr` (
  `pos` int(11) NOT NULL COMMENT ' 位置',
  `id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value_type` varchar(255) DEFAULT '1',
  `default_value` varchar(255) DEFAULT NULL,
  `if_item_use_attr` int(1) NOT NULL DEFAULT '0',
  `if_basic` int(1) NOT NULL,
  `if_show` varchar(255) DEFAULT '1',
  `attr_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `gm_game_attr`
--

INSERT INTO `gm_game_attr` (`pos`, `id`, `name`, `value_type`, `default_value`, `if_item_use_attr`, `if_basic`, `if_show`, `attr_type`) VALUES
(1, 'id', '标识', '5', '1', 0, 1, '1', '0'),
(2, 'area_name', '区域名称', '5', '0', 0, 1, '1', '1'),
(3, 'area_id', '区域id', '5', '0', 0, 1, '0', '0'),
(4, 'name', '场景名称', '5', '0', 0, 1, '0', '1'),
(5, 'photo', '图片', '5', '0', 0, 1, '1', '1'),
(6, 'desc', '描述', '5', '0', 0, 1, '1', '1'),
(7, 'name', '名称', '1', '', 0, 1, '0', '1'),
(8, 'id', '标识', '1', '', 0, 1, '1', '0'),
(9, 'nick_name', '称号', '1', '', 0, 1, '0', '1'),
(10, 'sex', '性别', '1', '', 0, 1, '0', '1'),
(11, 'image', '图片', '1', '', 0, 1, '0', '1'),
(12, 'max_burthen', '最大负载', '1', '', 0, 1, '0', '0'),
(13, 'exp', '经验', '1', '', 1, 1, '0', '0'),
(14, 'lvl', '等级', '1', '1', 0, 1, '0', '0'),
(15, 'money', '信用币', '1', '', 1, 1, '0', '0'),
(16, 'hp', '生命', '1', '', 1, 1, '0', '0'),
(17, 'maxhp', '最大生命', '1', '', 1, 1, '0', '0'),
(18, 'id', '标识', '3', '', 0, 1, '0', '0'),
(19, 'area_id', '区域', '3', '', 0, 1, '0', '0'),
(20, 'name', '名称', '3', '', 0, 1, '0', '1'),
(21, 'nick_name', '绰号', '3', '', 0, 1, '0', '1'),
(22, 'image', '图片', '3', '', 0, 1, '0', '1'),
(23, 'desc', '描述', '3', '', 0, 1, '0', '1'),
(24, 'exp', '经验', '3', '', 0, 1, '0', '0'),
(25, 'lvl', '等级', '3', '', 0, 1, '0', '0'),
(26, 'kill', '是否可杀', '3', '', 0, 1, '0', '2'),
(27, 'not_dead', '是否杀不死', '3', '', 0, 1, '0', '2'),
(28, 'chuck', '是否可赶走', '3', '', 0, 1, '0', '2'),
(29, 'refresh_time', '刷新间隔', '3', '', 0, 1, '0', '0'),
(30, 'shop', '是否贩货', '3', '', 0, 1, '0', '2'),
(31, 'hock_shop', '是否收购', '3', '', 0, 1, '0', '2'),
(32, 'hp', '生命', '3', '', 0, 1, '0', '0'),
(33, 'maxhp', '最大生命', '3', '100', 0, 1, '1', '0'),
(34, 'gj', '攻击力', '3', '0', 0, 1, '0', '0'),
(35, 'fy', '防御力', '3', '', 0, 1, '0', '0'),
(36, 'kill', '是否可pk', '1', '0', 0, 1, '0', '2'),
(37, 'id', '标识', '4', '1', 0, 1, '0', '0'),
(38, 'area_id', '区域', '4', '0', 0, 1, '0', '0'),
(39, 'name', '名称', '4', '', 0, 1, '0', '1'),
(40, 'image', '图片', '4', '', 0, 1, '0', '1'),
(41, 'desc', '描述', '4', '', 0, 1, '0', '1'),
(42, 'type', '类别', '4', '0', 0, 1, '0', '0'),
(43, 'subtype', '子类别', '4', '0', 0, 1, '0', '0'),
(44, 'weight', '重量', '4', '0', 0, 1, '0', '0'),
(45, 'price', '价格', '4', '0', 0, 1, '0', '0'),
(46, 'no_give', '是否不可赠送', '4', '0', 0, 1, '0', '2'),
(47, 'no_out', '是否不可丢弃', '4', '0', 0, 1, '0', '2'),
(48, 'refresh_time', '刷新间隔', '5', '1', 0, 1, '1', '0'),
(49, 'id', '标识', '6', '1', 0, 1, '1', '0'),
(50, 'name', '名称', '6', '', 0, 1, '1', '1'),
(51, 'desc', '描述', '6', '', 0, 1, '1', '1'),
(52, 'effect_cmmt', '攻击描述', '6', '', 0, 1, '1', '1'),
(53, 'lvl', '等级', '6', '1', 0, 1, '1', '0'),
(54, 'point', '当前熟练度', '6', '0', 0, 1, '0', '0'),
(55, 'group_attack', '攻击范围', '6', '1', 0, 1, '1', '0'),
(56, 'shop', '是否商店', '5', '0', 0, 1, '1', '2'),
(57, 'hockshop', '是否当铺', '5', '0', 0, 1, '1', '2'),
(58, 'storage', '是否仓库', '5', '0', 0, 1, '1', '2'),
(59, 'kill', '是否允许pk', '5', '1', 0, 1, '1', '2'),
(60, 'is_rp', '是否资源点', '5', '0', 0, 1, '1', '2'),
(62, 'rp_id', '资源点名称', '5', '0', 0, 1, '0', '0'),
(63, 'is_tp', '是否中转点', '5', '0', 0, 1, '1', '2'),
(64, 'accept_give', '是否接受物品', '3', '', 0, 1, '0', '2'),
(65, 'tp_type', '中转点类型', '5', '0', 0, 1, '1', '0'),
(66, 'dire', '坐标', '5', '0,0,0', 0, 1, '1', '1'),
(67, 'tianqi', '天气', '5', '晴天', 0, 1, '0', '1'),
(68, 'is_shield', '是否屏蔽其他玩家', '5', '0', 0, 1, '1', '2'),
(69, 'is_signal_block', '是否信号闭塞', '5', '0', 0, 1, '1', '2'),
(70, 'wg_fj', '物攻附加', '4', '0', 0, 0, '0', '0'),
(71, 'mg_add', '魔攻附加', '4', '0', 0, 0, '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `gm_game_basic`
--

CREATE TABLE `gm_game_basic` (
  `game_id` int(10) NOT NULL DEFAULT '0',
  `game_name` text NOT NULL,
  `game_desc` text NOT NULL,
  `game_creat_time` datetime NOT NULL,
  `game_open_time` datetime NOT NULL,
  `money_name` text NOT NULL,
  `money_measure` text NOT NULL,
  `promotion_exp` varchar(1024) NOT NULL,
  `promotion_cond` varchar(1024) NOT NULL,
  `mod_promotion_exp` varchar(1024) NOT NULL,
  `mod_promotion_cond` varchar(1024) NOT NULL,
  `clan_promotion_exp` varchar(1024) NOT NULL,
  `clan_promotion_cond` varchar(1024) NOT NULL,
  `default_skill_id` int(10) NOT NULL,
  `entrance_id` int(10) NOT NULL,
  `game_status` int(10) NOT NULL,
  `game_max_char` int(10) NOT NULL DEFAULT '50' COMMENT '//聊天信息最大字符数',
  `gm_post_canshu` int(10) NOT NULL,
  `game_forum_gm_id` text NOT NULL COMMENT '//论坛版主',
  `game_status_string` varchar(255) NOT NULL,
  `pet_max_count` int(2) NOT NULL DEFAULT '1',
  `team_max_count` int(2) NOT NULL DEFAULT '1',
  `default_storage` int(10) NOT NULL COMMENT '//默认仓库容量',
  `player_offline_time` int(2) NOT NULL COMMENT '//玩家无操作状态下离线时间，单位：分钟',
  `player_send_global_msg_interval` int(11) NOT NULL COMMENT '//玩家发送公共聊天（除了私聊）的间隔时间',
  `scene_op_br` int(2) NOT NULL COMMENT '//场景操作是否换行',
  `npc_op_br` int(2) NOT NULL COMMENT '//npc操作是否换行',
  `item_op_br` int(2) NOT NULL COMMENT '//物品操作是否换行',
  `list_row` int(11) NOT NULL COMMENT '//列表行数',
  `game_player_regular_minute` datetime NOT NULL COMMENT '//玩家分钟时',
  `near_player_show` int(3) NOT NULL COMMENT '//场景附近玩家显示，大于部分以省略号呈现',
  `game_temp_notice` varchar(255) NOT NULL COMMENT '//临时公告',
  `game_temp_notice_time` int(4) NOT NULL COMMENT '//临时公告剩余分钟数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `gm_game_basic`
--

INSERT INTO `gm_game_basic` (`game_id`, `game_name`, `game_desc`, `game_creat_time`, `game_open_time`, `money_name`, `money_measure`, `promotion_exp`, `promotion_cond`, `mod_promotion_exp`, `mod_promotion_cond`, `clan_promotion_exp`, `clan_promotion_cond`, `default_skill_id`, `entrance_id`, `game_status`, `game_max_char`, `gm_post_canshu`, `game_forum_gm_id`, `game_status_string`, `pet_max_count`, `team_max_count`, `default_storage`, `player_offline_time`, `player_send_global_msg_interval`, `scene_op_br`, `npc_op_br`, `item_op_br`, `list_row`, `game_player_regular_minute`, `near_player_show`, `game_temp_notice`, `game_temp_notice_time`) VALUES
(19980925, '失色纪元', '〝命运，如造物主的看不见的大手，穿针引线，映射于失色之地下的禁忌领域。\r\n粼粼的月光之下，是终局的开端，还是虚幻的重建?〞\r\n〝戈德兰的守护者们，是昨天还是今天，是明天还是后天？〞\r\n......\r\n', '2023-08-01 00:22:15', '2023-09-25 00:05:20', '信用币', '张', '{e.maxexp}', '{u.lvl}<100', '', '', '', '', 1, 225, 0, 20, 0, '959c9277a3e15eacff9e5f117e51f5bb', '开发中', 1, 2, 20, 10, 10, 1, 1, 1, 8, '2023-09-09 01:29:48', 1, '哈哈哈哈', 0);

-- --------------------------------------------------------

--
-- 表的结构 `gm_game_scene`
--

CREATE TABLE `gm_game_scene` (
  `location_num` int(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  `show_cond` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `target_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `playerchongwu`
--

CREATE TABLE `playerchongwu` (
  `cwid` int(11) NOT NULL,
  `cwname` varchar(255) NOT NULL,
  `cwhp` int(11) NOT NULL,
  `cwmaxhp` int(11) NOT NULL,
  `cwgj` int(11) NOT NULL,
  `cwfy` int(11) NOT NULL,
  `cwbj` int(11) NOT NULL,
  `cwxx` int(11) NOT NULL,
  `cwlv` int(11) NOT NULL,
  `cwexp` int(11) NOT NULL,
  `tool1` int(11) NOT NULL,
  `tool2` int(11) NOT NULL,
  `tool3` int(11) NOT NULL,
  `tool4` int(11) NOT NULL,
  `tool5` int(11) NOT NULL,
  `tool6` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `uphp` int(11) NOT NULL,
  `upgj` int(11) NOT NULL,
  `upfy` int(11) NOT NULL,
  `cwpz` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `playerchongwu`
--

INSERT INTO `playerchongwu` (`cwid`, `cwname`, `cwhp`, `cwmaxhp`, `cwgj`, `cwfy`, `cwbj`, `cwxx`, `cwlv`, `cwexp`, `tool1`, `tool2`, `tool3`, `tool4`, `tool5`, `tool6`, `sid`, `uphp`, `upgj`, `upfy`, `cwpz`) VALUES
(12, '伶俐鼠', 100, 100, 6, 4, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '52664809fa08794f8aa304b6495a7db9', 18, 5, 6, 0),
(13, '蛋蛋鸡', 100, 100, 6, 4, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '08f9b3ba3f9be7b774629517c3189673', 15, 5, 6, 0);

-- --------------------------------------------------------

--
-- 表的结构 `playerdaoju`
--

CREATE TABLE `playerdaoju` (
  `djname` varchar(255) NOT NULL,
  `djzl` varchar(255) NOT NULL,
  `djinfo` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `sid` text NOT NULL,
  `djsum` int(11) NOT NULL,
  `djid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `playerdaoju`
--

INSERT INTO `playerdaoju` (`djname`, `djzl`, `djinfo`, `uid`, `sid`, `djsum`, `djid`) VALUES
('强化石', '2', '强化装备用的道具', 422, 'c472c6fb6ddbf2723f34cb351c1c230c', 1, 1),
('强化石', '2', '强化装备用的道具', 426, '08f9b3ba3f9be7b774629517c3189673', 10, 1),
('强化石', '2', '强化装备用的道具', 427, '77b102b55d345c3579ffe21ac0549deb', 185, 1),
('硬翅蜂蜜', '', '硬翅蜂的蜂蜜', 426, '08f9b3ba3f9be7b774629517c3189673', 2, 8),
('硬翅蜂蜜', '', '硬翅蜂的蜂蜜', 427, '77b102b55d345c3579ffe21ac0549deb', 2, 8),
('符箓残页-初级灵', '', '兑换符箓用的', 427, '77b102b55d345c3579ffe21ac0549deb', 95, 6),
('符箓残页-初级魔', '', '兑换符箓', 427, '77b102b55d345c3579ffe21ac0549deb', 100, 7);

-- --------------------------------------------------------

--
-- 表的结构 `playerjineng`
--

CREATE TABLE `playerjineng` (
  `jnname` varchar(255) NOT NULL,
  `jnid` int(11) NOT NULL,
  `jngj` int(11) NOT NULL,
  `jnfy` int(11) NOT NULL,
  `jnbj` int(11) NOT NULL,
  `jnxx` int(11) NOT NULL,
  `sid` text NOT NULL,
  `jncount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `playerjineng`
--

INSERT INTO `playerjineng` (`jnname`, `jnid`, `jngj`, `jnfy`, `jnbj`, `jnxx`, `sid`, `jncount`) VALUES
('聚灵斩', 4, 10, 0, 0, 2, '77b102b55d345c3579ffe21ac0549deb', 0);

-- --------------------------------------------------------

--
-- 表的结构 `playerrenwu`
--

CREATE TABLE `playerrenwu` (
  `rwname` varchar(255) NOT NULL,
  `rwzl` int(11) NOT NULL,
  `rwdj` varchar(255) NOT NULL,
  `rwzb` varchar(255) NOT NULL,
  `rwexp` varchar(255) NOT NULL,
  `rwyxb` varchar(255) NOT NULL,
  `sid` text NOT NULL,
  `rwzt` int(11) NOT NULL,
  `rwid` int(11) NOT NULL,
  `rwyq` int(11) NOT NULL,
  `rwcount` int(11) NOT NULL,
  `rwnowcount` int(11) NOT NULL,
  `rwlx` int(11) NOT NULL,
  `rwyp` text NOT NULL,
  `data` int(11) NOT NULL,
  `rwjineng` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `playerrenwu`
--

INSERT INTO `playerrenwu` (`rwname`, `rwzl`, `rwdj`, `rwzb`, `rwexp`, `rwyxb`, `sid`, `rwzt`, `rwid`, `rwyq`, `rwcount`, `rwnowcount`, `rwlx`, `rwyp`, `data`, `rwjineng`) VALUES
('硬翅蜂扰', 2, '1|15,6|100,7|100', '', '200', '150', 'c2853ea53cf2b2731616d4f3e26a50b7', 1, 25, 55, 20, 5, 3, '', 0, ''),
('屠尽妖王', 1, '', '45', '2000', '2000', 'c2853ea53cf2b2731616d4f3e26a50b7', 1, 27, 12, 150, 0, 1, '', 0, ''),
('故人', 3, '1|50', '29', '400', '200', 'c2853ea53cf2b2731616d4f3e26a50b7', 3, 28, 11, 14, 0, 1, '', 0, ''),
('硬翅蜂扰', 2, '1|15,6|100,7|100', '', '200', '150', '08f9b3ba3f9be7b774629517c3189673', 1, 25, 55, 20, 8, 3, '', 0, ''),
('故人', 3, '1|50', '29', '400', '200', '08f9b3ba3f9be7b774629517c3189673', 3, 28, 11, 14, 0, 1, '', 0, ''),
('硬翅蜂扰', 2, '1|15,6|100,7|100', '', '200', '150', '77b102b55d345c3579ffe21ac0549deb', 3, 25, 55, 20, 0, 3, '', 0, ''),
('找王大妈', 3, '1|20', '25', '200', '100', 'c2853ea53cf2b2731616d4f3e26a50b7', 3, 24, 11, 18, 0, 3, '', 0, ''),
('狼患', 2, '1|100', '', '400', '300', 'c2853ea53cf2b2731616d4f3e26a50b7', 3, 29, 62, 10, 0, 3, '', 0, ''),
('故人', 3, '1|50', '29', '400', '200', '77b102b55d345c3579ffe21ac0549deb', 3, 28, 11, 14, 0, 1, '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `playeryaopin`
--

CREATE TABLE `playeryaopin` (
  `ypname` varchar(255) NOT NULL,
  `ypid` int(11) NOT NULL,
  `yphp` int(11) NOT NULL,
  `ypgj` int(11) NOT NULL,
  `ypfy` int(11) NOT NULL,
  `ypxx` int(11) NOT NULL,
  `ypbj` int(11) NOT NULL,
  `sid` text NOT NULL,
  `ypsum` int(11) NOT NULL,
  `ypjg` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `playeryaopin`
--

INSERT INTO `playeryaopin` (`ypname`, `ypid`, `yphp`, `ypgj`, `ypfy`, `ypxx`, `ypbj`, `sid`, `ypsum`, `ypjg`) VALUES
('还原丹', 6, 100, 0, 0, 0, 0, 'c472c6fb6ddbf2723f34cb351c1c230c', 11, 30),
('还原丹', 6, 100, 0, 0, 0, 0, '08f9b3ba3f9be7b774629517c3189673', 14, 30),
('复伤丹', 9, 1200, 0, 0, 0, 0, '77b102b55d345c3579ffe21ac0549deb', 99, 310),
('还原丹', 6, 100, 0, 0, 0, 0, '77b102b55d345c3579ffe21ac0549deb', 28, 30);

-- --------------------------------------------------------

--
-- 表的结构 `playerzhuangbei`
--

CREATE TABLE `playerzhuangbei` (
  `zbname` varchar(255) NOT NULL,
  `zbinfo` varchar(255) NOT NULL,
  `zbgj` varchar(255) NOT NULL,
  `zbfy` varchar(255) NOT NULL,
  `zbbj` varchar(255) NOT NULL,
  `zbxx` varchar(255) NOT NULL,
  `zbid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `zbnowid` int(11) NOT NULL,
  `sid` text NOT NULL,
  `zbhp` varchar(255) NOT NULL,
  `qianghua` int(11) NOT NULL,
  `zblv` int(11) NOT NULL,
  `zbtool` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `playerzhuangbei`
--

INSERT INTO `playerzhuangbei` (`zbname`, `zbinfo`, `zbgj`, `zbfy`, `zbbj`, `zbxx`, `zbid`, `uid`, `zbnowid`, `sid`, `zbhp`, `qianghua`, `zblv`, `zbtool`) VALUES
('新手木剑', '新手使用的木剑', '1', '0', '0', '1', 23, 0, 75624, '', '0', 0, 0, 1),
('初级嗜血剑', '初级嗜血剑', '7', '0', '1', '3', 29, 422, 75625, 'c472c6fb6ddbf2723f34cb351c1c230c', '0', 5, 0, 1),
('新手布衣', '新手使用的布衣', '0', '2', '0', '0', 24, 424, 75626, 'c472c6fb6ddbf2723f34cb351c1c230c', '10', 0, 0, 3),
('初级嗜血剑', '初级嗜血剑', '7', '0', '1', '3', 29, 426, 75627, '08f9b3ba3f9be7b774629517c3189673', '0', 5, 0, 1),
('新手布衣', '新手使用的布衣', '0', '2', '0', '0', 24, 426, 75628, '08f9b3ba3f9be7b774629517c3189673', '10', 0, 0, 3),
('黑魔匕首', '黑魔匕首', '21', '0', '3', '4', 33, 427, 75629, '77b102b55d345c3579ffe21ac0549deb', '0', 7, 0, 0),
('明月之剑', '明月  明月', '3', '0', '0', '1', 25, 0, 75643, '', '0', 0, 0, 1),
('初级嗜血剑', '初级嗜血剑', '2', '0', '1', '3', 29, 427, 75646, '77b102b55d345c3579ffe21ac0549deb', '0', 0, 0, 1),
('百炼轻蕊甲', '百炼轻蕊甲', '0', '8', '0', '0', 28, 427, 75635, '77b102b55d345c3579ffe21ac0549deb', '40', 0, 0, 3),
('陨铁武棍', '陨铁武棍', '8', '3', '1', '1', 36, 427, 75645, '77b102b55d345c3579ffe21ac0549deb', '0', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `player_equip_mosaic`
--

CREATE TABLE `player_equip_mosaic` (
  `equip_id` int(11) NOT NULL,
  `equip_root` int(11) NOT NULL,
  `belong_sid` text NOT NULL,
  `equip_mosaic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `player_temp_attr`
--

CREATE TABLE `player_temp_attr` (
  `obj_id` text NOT NULL,
  `obj_oid` text NOT NULL,
  `obj_type` int(11) NOT NULL,
  `attr_name` varchar(255) NOT NULL,
  `attr_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_addition_attr`
--

CREATE TABLE `system_addition_attr` (
  `sid` text NOT NULL,
  `oid` varchar(255) NOT NULL,
  `mid` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_addition_attr`
--

INSERT INTO `system_addition_attr` (`sid`, `oid`, `mid`, `name`, `value`) VALUES
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uzxsj', '3013'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uqd_daily', '7'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'usubmit_bounty_01_item_01', '26'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'uqd_daily', '6'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'uzxsj', '225'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'upick_lj', '1719946448'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'upick_lj', '1704554008'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utomorrow_1_floor', '1'),
('0277b7c43250e3bda5d7fb423ce14d92', '', 0, 'uzxsj', '3'),
('0277b7c43250e3bda5d7fb423ce14d92', '', 0, 'uqd_daily', '13'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'utomorrow_1_floor', '1'),
('214658c4375c343e280ae38e880ac4ba', '', 0, 'uqd_daily', '6'),
('214658c4375c343e280ae38e880ac4ba', '', 0, 'uzxsj', '12'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_x', '2'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_y', '2'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_z', '1.5'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_burthen', '100'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'ulq_map0_dailygift', '8'),
('01a0d4f5e64a677721a1089d4914bc6a', '', 0, 'uqd_daily', '5'),
('01a0d4f5e64a677721a1089d4914bc6a', '', 0, 'upick_lj', '1717538783'),
('01a0d4f5e64a677721a1089d4914bc6a', '', 0, 'uzxsj', '3'),
('a8c7b0c51c60be7441214c0b0c671d88', '', 0, 'uzxsj', '13'),
('945fd26d30e007abfed414cc1f2795f5', '', 0, 'uzxsj', '451'),
('945fd26d30e007abfed414cc1f2795f5', '', 0, 'uqd_daily', '5'),
('f55913444ef985484baf7580c60f15ce', '', 0, 'uzxsj', '5'),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 0, 'uzxsj', '546'),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 0, 'uqd_daily', '27'),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 0, 'uqd_daily', '6'),
('e3130d019f7689f5501bc3633f97eb88', '', 0, 'uzxsj', '1'),
('76623f3a68872fa88502af535498a991', '', 0, 'uzxsj', '1'),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 0, 'uzxsj', '5'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u98507', '9'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uzb_mg', '70'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'uzb_mg', '20'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u98520', '3'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'u33225', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u98517', '3'),
('344773e829d514e37d748e906a4f020a', '', 0, 'uzxsj', '11'),
('344773e829d514e37d748e906a4f020a', '', 0, 'uqd_daily', '21'),
('344773e829d514e37d748e906a4f020a', '', 0, 'u0', '1'),
('344773e829d514e37d748e906a4f020a', '', 0, 'upick_lj', '1718972871'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'u37367', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u110418', '4'),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 0, 'u0', '1'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'u37374', '2'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u130926', '1'),
('6b5913cfa12674939ee93c59e0bb7254', '', 0, 'uzxsj', '8'),
('976f6bbeda6b3bca384d8842e569f05e', '', 0, 'uzxsj', '1'),
('98c50608a11ec800fba8b2d0b7294aeb', '', 0, 'uzxsj', '1'),
('98c50608a11ec800fba8b2d0b7294aeb', '', 0, 'upick_lj', '1719735300'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'ulq_map0_dailygift', '4'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utest_id', '2'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u130', '40'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'urandom', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u1690', '2'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'upick_lj', '1720187792'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'uzxsj', '11'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'uqd_daily', '23'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'u0', '3'),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 0, 'u1318680', '1'),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 0, 'uzxsj', '6'),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 0, 'urandom', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'urandom', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u0cs', '14'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uxxx', '37'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u37cs', '2');

-- --------------------------------------------------------

--
-- 表的结构 `system_area`
--

CREATE TABLE `system_area` (
  `belong` int(11) NOT NULL COMMENT '//所属大区域，0失落之地，1日出之地，2灼热之地，3日落之地，4极寒之地，5湿热之地',
  `pos` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_area`
--

INSERT INTO `system_area` (`belong`, `pos`, `id`, `name`) VALUES
(0, -1, 0, '未分区'),
(0, 0, 1, '旧街'),
(0, 2, 2, '希望镇'),
(0, 4, 3, '未来城'),
(0, 19, 4, '失落之地'),
(0, 5, 5, '理想城'),
(0, 6, 6, '黑雾城'),
(1, 8, 7, '安宁之地'),
(4, 9, 8, '纳米之都'),
(1, 7, 9, '金陵古城'),
(5, 10, 10, '银月戈壁'),
(3, 11, 11, '智慧山脊'),
(4, 12, 12, '不夜之城'),
(2, 13, 13, '熔岩山岭'),
(3, 18, 14, '黑石镇'),
(1, 14, 15, '钱塘古城'),
(1, 15, 16, '广陵古城'),
(1, 16, 17, '刺桐古城'),
(1, 17, 18, '楚庭古城'),
(1, 20, 19, '曼尼拉城'),
(1, 21, 20, '浪速古城'),
(1, 22, 21, '首里古城'),
(4, 23, 22, '雪漫古城'),
(0, 1, 23, '迷雾森林'),
(2, 24, 24, '卡普斯镇'),
(2, 25, 25, '亚特兰蒂斯'),
(2, 26, 26, '蒙巴萨城'),
(0, 3, 27, '宁静森林'),
(0, 27, 28, '克蒙伦斯城'),
(2, 28, 29, '塞恩古城');

-- --------------------------------------------------------

--
-- 表的结构 `system_auc`
--

CREATE TABLE `system_auc` (
  `auc_id` int(11) NOT NULL,
  `auc_area` int(11) NOT NULL COMMENT '拍卖行所属区域id',
  `auc_name` varchar(255) NOT NULL,
  `auc_desc` varchar(255) NOT NULL,
  `auc_money` varchar(255) NOT NULL DEFAULT 'money' COMMENT '拍卖行用什么货币交易',
  `auc_fee` int(2) NOT NULL DEFAULT '10' COMMENT '手续费，如10就是10%'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_auc_data`
--

CREATE TABLE `system_auc_data` (
  `auc_id` int(11) NOT NULL COMMENT '交易id',
  `belong` int(11) NOT NULL COMMENT '所属拍卖行id',
  `auc_item_id` int(11) NOT NULL COMMENT '物品真实id',
  `auc_item_name` varchar(255) NOT NULL COMMENT '物品真实名称',
  `auc_item_type` varchar(255) NOT NULL COMMENT '物品类别',
  `auc_count` int(11) NOT NULL COMMENT '物品数量',
  `auc_sale_id` text NOT NULL COMMENT '拍卖者id',
  `auc_low_value` int(11) NOT NULL COMMENT '起拍价',
  `auc_now_value` int(11) NOT NULL COMMENT '当前价/最高价/成交价',
  `auc_pay_id` text NOT NULL COMMENT '最高出价者id',
  `auc_pay_creat_time` datetime NOT NULL COMMENT '拍卖者上架时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_auc_data`
--

INSERT INTO `system_auc_data` (`auc_id`, `belong`, `auc_item_id`, `auc_item_name`, `auc_item_type`, `auc_count`, `auc_sale_id`, `auc_low_value`, `auc_now_value`, `auc_pay_id`, `auc_pay_creat_time`) VALUES
(1, 0, 1, '金疮药', '消耗品', 10, '', 0, 5555, '', '2023-10-22 16:25:40');

-- --------------------------------------------------------

--
-- 表的结构 `system_boss`
--

CREATE TABLE `system_boss` (
  `boss_id` int(11) NOT NULL,
  `boss_name` varchar(255) DEFAULT NULL,
  `boss_lvl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_buff`
--

CREATE TABLE `system_buff` (
  `buff_id` int(11) NOT NULL,
  `buff_name` varchar(255) DEFAULT NULL,
  `buff_impact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_chat_data`
--

CREATE TABLE `system_chat_data` (
  `name` text NOT NULL,
  `msg` text CHARACTER SET utf8mb4 NOT NULL,
  `send_time` datetime NOT NULL,
  `id` int(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `imuid` int(11) NOT NULL COMMENT '12345生效，此时为对方id，城市id，区域id，队伍id，公会id',
  `chat_type` int(1) NOT NULL DEFAULT '0' COMMENT '0为公共，1为私聊，2为城聊，3为区聊，4为队聊，5为会聊',
  `send_type` int(1) NOT NULL COMMENT '0为玩家或系统，1为npc，2为物品',
  `viewed` int(1) NOT NULL DEFAULT '0' COMMENT '0为未看，1为已读'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_chat_data`
--

INSERT INTO `system_chat_data` (`name`, `msg`, `send_time`, `id`, `uid`, `imuid`, `chat_type`, `send_type`, `viewed`) VALUES
('轩辕', '策略类rpg设计器的实现', '2024-06-21 12:59:20', 495, 1, 0, 0, 0, 0),
('轩辕', '特殊战斗限制，比如副本等，n回合内没杀死则判定对方逃跑。', '2024-01-02 00:09:58', 435, 1, 0, 0, 0, 0),
('秋梦', '邮件系统也可以参考修真天下的', '2023-12-29 11:51:11', 433, 2, 0, 0, 0, 0),
('轩辕', '办事任务的图标显示有些异常', '2024-06-28 02:27:01', 515, 1, 0, 0, 0, 0),
('轩辕', '加入附近玩家名称显示，比如：@red@[VIP{o.vip}]@end@{o.name}({o.lvl}级)', '2024-07-01 22:36:33', 530, 1, 0, 0, 0, 0),
('轩辕', '势力背景:五角贸易联盟(割据在戈德兰大陆四个角落及中心主城(克蒙伦斯城))， 中庭(一个由许多有才能的科学家组成的隐秘组织，正在研究纪元后时代的出路)，厄加帝国(废墟上开出的一朵艳丽危险的花)，希望教会(希望神的教会)，火种公司(一家科技驱动型，以研究纪元前航天科技为主的公司)，惩戒者(一个民间超能者组成的组织，目的是惩戒一切不公)。', '2023-12-26 00:36:10', 428, 1, 0, 0, 0, 0),
('轩辕', '物品加入品质属性如:劣质，良好，无暇等', '2023-12-13 15:40:21', 405, 1, 0, 0, 0, 0),
('轩辕', '怪物装备攻防应该在创建的时候赋值，另外创建事件也可以加入', '2024-07-03 08:54:57', 540, 1, 0, 0, 0, 0),
('秋梦', '我向你赠送了废弃塑料x1!', '0000-00-00 00:00:00', 529, 2, 1, 1, 0, 1),
('轩辕', '或者数据库每分钟执行在线检测', '2024-06-16 14:44:17', 487, 1, 0, 0, 0, 0),
('轩辕', '抽象语法树替换，ot.busy跳回合，尝试合并一些pdo数据库文件以及探索高版本php和mysql的兼容性', '2024-06-20 18:06:45', 492, 1, 0, 0, 0, 0),
('轩辕', '定时器：系统定时(包括系统本身定时，场景定时，npc定时，物品定时，临时公告等)与玩家定时(自创帮派定时，自身分钟定时)以及自定义定时', '2024-06-26 02:18:57', 504, 1, 0, 0, 0, 0),
('轩辕', '对前往场景，若当前玩家没有mid则不跳转场景模板', '2024-06-27 20:29:09', 511, 1, 0, 0, 0, 0),
('云澈', '兄弟们好', '2024-06-06 01:04:07', 462, 10, 1, 4, 0, 0),
('秋梦', '拍卖系统参考修真天下的，且挂售和拍卖是两套系统，挂售要双方在同一个mid且该mid不屏蔽玩家，拍卖是区域独立，两者都有时限限制。', '2023-12-29 11:50:35', 432, 2, 0, 0, 0, 0),
('轩辕', '在模板设计元素提交请求更新缓存值', '2024-07-01 08:36:47', 528, 1, 0, 0, 0, 0),
('轩辕', '输入框元素有这几个属性：name，type，style，default,value，sub_value,sub_style,link_event', '2024-07-01 22:54:01', 532, 1, 0, 0, 0, 0),
('轩辕', '宠物模板中宠物被识别为o', '2023-12-14 11:27:48', 407, 1, 0, 0, 0, 0),
('梦秋', '设计pvp', '2023-12-13 15:32:34', 404, 3, 0, 0, 0, 0),
('轩辕', '尝试引入聊天模版自定义', '2024-06-30 14:30:47', 525, 1, 0, 0, 0, 0),
('轩辕', '普通，良好，优秀，史诗，传说，神域', '2023-12-15 01:09:56', 421, 1, 0, 0, 0, 0),
('轩辕', '\r\n设计制造系统，包括制作药品，制作消耗品(各类子弹)，制作装备，制作半加工材料，设计烹饪系统，包括制作各类食物等', '2023-12-26 00:23:56', 427, 1, 0, 0, 0, 0),
('轩辕', '接下去应该是帮派和宠物，以及buff系统', '2024-06-21 01:41:38', 494, 1, 0, 0, 0, 0),
('轩辕', '尝试开发，设计器的设计器，封装抽象api模块调用', '2024-06-21 13:13:18', 496, 1, 0, 0, 0, 0),
('轩辕', '地图设计新增:新增item，npc到指定范围mid', '2023-12-11 15:09:19', 394, 1, 0, 0, 0, 0),
('轩辕', '不同枪械使用有回合限制，冲锋枪，手枪，狙击枪，步枪，霰弹枪。', '2023-12-20 00:46:17', 424, 1, 0, 0, 0, 0),
('测试号', '设计大厅+设计buff和debuff，物品属性能进行buff加持或debuff去除等。', '2023-12-01 01:20:54', 344, 14, 0, 0, 0, 0),
('轩辕', '加入元素绑定自动播放音乐链接', '2023-12-06 02:37:43', 379, 1, 0, 0, 0, 0),
('点点', '信封系统', '2023-11-30 22:26:58', 342, 1, 0, 0, 0, 0),
('点点', '快捷键加两个投掷位，可以放任意物品，产生随机伤害或者触发特殊效果，投掷会消耗该物品以及一定的体力。', '2023-12-01 01:15:46', 343, 1, 0, 0, 0, 0),
('轩辕', '创建一些特殊事件，事件名称应该是部分动态的', '2024-07-03 00:59:03', 536, 1, 0, 0, 0, 0),
('轩辕', '对于各个地方的删除事件，应该对其内含的所有相关事件，元素，操作和步骤进行删除', '2024-06-28 00:26:52', 512, 1, 0, 0, 0, 0),
('轩辕', '给任务加个系列belong字段，然后任务支持导出所选系列的所有任务到excel', '2023-12-13 11:43:35', 401, 1, 0, 0, 0, 0),
('轩辕', '完善抽奖系统', '2023-12-08 16:05:44', 386, 1, 0, 0, 0, 0),
('轩辕', '捡东西是否会触发事件', '2023-12-11 14:57:04', 390, 1, 0, 0, 0, 0),
('轩辕', '考虑缓存实现：储存一些系统信息到数据库，然后输出一些系统信息到用户端，然后通过用户端是否已经读取将其置为0或删除。', '2024-07-04 22:42:47', 548, 1, 0, 0, 0, 0),
('轩辕', '尝试引入xdebug调试器优化代码', '2024-06-22 16:20:09', 500, 1, 0, 0, 0, 0),
('轩辕', '查看玩家页面模板进行操作拆分，从而实现不同场合显示不同效果', '2024-07-22 12:12:39', 551, 1, 0, 0, 0, 0),
('测试2', '战斗中引入先手值的概念，若怪物先手，则最后一击无论是否杀死，玩家均会受到伤害', '2023-12-04 14:55:53', 367, 10, 0, 0, 0, 0),
('云澈', '打副本', '2024-06-06 01:04:13', 463, 10, 1, 4, 0, 0),
('轩辕', '尝试对公共事件依据主体不同分开撰写特定函数，缩小冗余代码量', '2024-06-26 15:20:55', 509, 1, 0, 0, 0, 0),
('轩辕', '物品保质期设定，过保质期则无法使用，无法操作，且在重登时候会自动验证删除。', '2024-06-18 18:10:55', 491, 1, 0, 0, 0, 0),
('轩辕', '被对主表达式要把npc加入，现在都是midguaiwu', '2023-12-06 11:03:54', 380, 1, 0, 0, 0, 0),
('轩辕', '玩家的定时可以以玩家本身状态作为基准点进行设计，系统的定时可以结合cron定时器，定时运行一个php文件，里面是一个循环，获取某个动态文件的id数组值，包括系统，场景，npc，物品等，这些都可以在gm.php里面检测是否创建。', '2024-06-26 02:22:29', 505, 1, 0, 0, 0, 0),
('轩辕', '对cmd参数进行分离和优化，运用是否在数组以及缓存，二分查找等手段加快处理cmd文件', '2024-06-26 02:25:22', 506, 1, 0, 0, 0, 0),
('轩辕', '组队系统仍然有问题，另外设计系统在创建新记录的时候考虑加入重复验证', '2024-06-28 08:31:36', 519, 1, 0, 0, 0, 0),
('轩辕', '对php进行压力测试，以及探索数据库连接池的可能性', '2024-06-26 02:37:39', 508, 1, 0, 0, 0, 0),
('轩辕', '装备强化数据表：equip_id,equip_root_id,belong_sid,equip_ strengthen_lvl，进行交易(售出，挂售，拍卖)时：默认查询该表进行清空。', '2024-07-03 09:37:55', 542, 1, 0, 0, 0, 0),
('轩辕', '模板在解析触发条件时可先检测是不是空，空的话直接跳过解析', '2024-07-04 02:06:57', 544, 1, 0, 0, 0, 0),
('秋梦', '挂售物品到时应该进行上架记录删除处理', '2024-07-04 02:11:07', 545, 2, 0, 0, 0, 0),
('轩辕', '完善宠物逻辑', '2024-07-22 12:10:56', 550, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_designer_assist`
--

CREATE TABLE `system_designer_assist` (
  `sid` text NOT NULL,
  `op_target` varchar(255) NOT NULL,
  `op_canshu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_designer_assist`
--

INSERT INTO `system_designer_assist` (`sid`, `op_target`, `op_canshu`) VALUES
('959c9277a3e15eacff9e5f117e51f5bb', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `system_draw`
--

CREATE TABLE `system_draw` (
  `id` int(11) NOT NULL COMMENT '它的id是什么',
  `name` varchar(255) NOT NULL COMMENT '抽奖名称',
  `cons_type` int(1) NOT NULL COMMENT '1金钱2物品3属性',
  `cons_count` text NOT NULL COMMENT '元素id及每次消耗多少：1|2',
  `draw_reward` text NOT NULL COMMENT '2|1|10,6|1|20，前者表物品id，接着的是物品数量，后者表示抽中概率',
  `cons_open_time` datetime NOT NULL DEFAULT '1900-01-01 00:00:00' COMMENT '开放时间',
  `cons_close_time` datetime NOT NULL DEFAULT '1900-01-01 00:00:00' COMMENT '关闭时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_draw`
--

INSERT INTO `system_draw` (`id`, `name`, `cons_type`, `cons_count`, `draw_reward`, `cons_open_time`, `cons_close_time`) VALUES
(1, '抽奖1', 1, 'money|100', '5|1|10,19|1|1,1|1|10,28|1|10,123|1|10,120|1|10,2|1|10,87|1|10,82|1|10,26|1|10,109|1|10,84|1|10,72|1|10,119|1|10', '1900-02-28 00:00:00', '2024-07-30 00:00:00'),
(2, '抽奖2', 2, '3|1', '', '2023-12-08 12:44:00', '2023-12-15 15:40:00');

-- --------------------------------------------------------

--
-- 表的结构 `system_equip_def`
--

CREATE TABLE `system_equip_def` (
  `id` int(2) NOT NULL,
  `name` varchar(10) NOT NULL,
  `type` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_equip_def`
--

INSERT INTO `system_equip_def` (`id`, `name`, `type`) VALUES
(1, '剑', 1),
(2, '刀', 1),
(3, '枪', 1),
(4, '帽子', 2),
(5, '衣服', 2),
(6, '裤子', 2),
(7, '鞋子', 2),
(8, '项链', 2),
(9, '戒指', 2),
(10, '工具', 1),
(11, '弓', 1),
(12, '拳套', 1),
(13, '法杖', 1),
(14, '战斧', 1),
(15, '长矛', 1),
(16, '勋章', 2),
(17, '披风', 2);

-- --------------------------------------------------------

--
-- 表的结构 `system_equip_default`
--

CREATE TABLE `system_equip_default` (
  `pos` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `type` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_equip_default`
--

INSERT INTO `system_equip_default` (`pos`, `name`, `type`) VALUES
(1, '剑', 1),
(2, '刀', 1),
(3, '枪', 1),
(4, '帽子', 2),
(5, '衣服', 2),
(6, '裤子', 2),
(7, '鞋子', 2),
(8, '项链', 2),
(9, '戒指', 2);

-- --------------------------------------------------------

--
-- 表的结构 `system_equip_user`
--

CREATE TABLE `system_equip_user` (
  `eqsid` varchar(255) NOT NULL,
  `eqid` int(10) UNSIGNED NOT NULL COMMENT '源id',
  `eq_true_id` int(10) NOT NULL COMMENT '真实id',
  `eq_type` int(1) NOT NULL COMMENT '1武器，2防具',
  `equiped_pos_id` varchar(11) NOT NULL COMMENT '装备位置'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_equip_user`
--

INSERT INTO `system_equip_user` (`eqsid`, `eqid`, `eq_true_id`, `eq_type`, `equiped_pos_id`) VALUES
('959c9277a3e15eacff9e5f117e51f5bb', 109, 115, 2, '4'),
('68dcd3cd66a76b81cfc90c0e147617d4', 107, 291, 1, '1'),
('959c9277a3e15eacff9e5f117e51f5bb', 110, 117, 2, '5'),
('959c9277a3e15eacff9e5f117e51f5bb', 104, 116, 2, '6'),
('959c9277a3e15eacff9e5f117e51f5bb', 108, 114, 1, '2');

-- --------------------------------------------------------

--
-- 表的结构 `system_event`
--

CREATE TABLE `system_event` (
  `belong` int(1) NOT NULL,
  `id` int(11) NOT NULL,
  `cond` varchar(255) DEFAULT NULL,
  `cmmt` text,
  `link_evs` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_event`
--

INSERT INTO `system_event` (`belong`, `id`, `cond`, `cmmt`, `link_evs`, `desc`) VALUES
(1, 1, '', '你不能注册！目前注册事件仅步骤一会被触发!', '1', '注册'),
(1, 2, '', '你不能登录！目前登录事件仅步骤一会被触发', '2', '登录'),
(1, 3, '', '', '', '上传形象照'),
(1, 4, NULL, NULL, NULL, 'pk'),
(1, 5, '', '', '', '出招'),
(1, 6, NULL, NULL, NULL, '被攻击'),
(1, 7, '', '', '', '战胜'),
(1, 8, NULL, NULL, NULL, '战败'),
(1, 9, NULL, NULL, NULL, '自创技能检测'),
(1, 10, NULL, NULL, NULL, '自创技能创建'),
(1, 11, NULL, NULL, NULL, '废除技能'),
(1, 12, NULL, NULL, NULL, '自创帮派检测'),
(1, 13, NULL, NULL, NULL, '自创帮派创建'),
(1, 14, NULL, NULL, NULL, '自创帮派战胜'),
(1, 15, NULL, NULL, NULL, '自创帮派升级'),
(1, 16, NULL, NULL, NULL, '自创帮派分钟定时'),
(1, 17, NULL, NULL, NULL, '帮派技能分钟定时'),
(1, 18, NULL, NULL, NULL, '加入帮派检测'),
(1, 19, NULL, NULL, NULL, '加入帮派'),
(1, 20, NULL, NULL, NULL, '退出帮派检测'),
(1, 21, NULL, NULL, NULL, '退出帮派'),
(1, 22, NULL, NULL, '7', '升级'),
(1, 23, NULL, NULL, NULL, '心跳'),
(1, 24, NULL, NULL, '6', '分钟定时'),
(1, 25, NULL, NULL, NULL, '小时定时'),
(2, 26, NULL, NULL, NULL, '创建'),
(2, 27, NULL, NULL, NULL, '查看'),
(2, 28, NULL, NULL, NULL, '出招'),
(2, 29, NULL, NULL, NULL, '被攻击'),
(2, 30, NULL, NULL, NULL, '战胜'),
(2, 31, '', '', '9', '战败'),
(2, 32, NULL, NULL, NULL, '被收养'),
(2, 33, NULL, NULL, NULL, '交易'),
(2, 34, NULL, NULL, NULL, '升级'),
(2, 35, NULL, NULL, NULL, '心跳'),
(2, 36, NULL, NULL, NULL, '分钟定时'),
(3, 37, NULL, NULL, NULL, '创建'),
(3, 38, NULL, NULL, NULL, '查看'),
(3, 39, NULL, NULL, NULL, '使用'),
(3, 40, '', '', '', '穿上装备'),
(3, 41, '', '', '', '卸下装备'),
(3, 42, NULL, NULL, NULL, '镶物镶入'),
(3, 43, NULL, NULL, NULL, '镶物卸下'),
(3, 44, NULL, NULL, NULL, '存储数据'),
(3, 45, NULL, NULL, NULL, '导出数据'),
(3, 46, NULL, NULL, NULL, '分钟定时'),
(4, 47, NULL, NULL, NULL, '创建'),
(4, 48, '', '', '', '查看'),
(4, 49, NULL, NULL, '', '进入'),
(4, 50, NULL, NULL, NULL, '离开'),
(4, 51, NULL, NULL, NULL, '分钟定时'),
(5, 52, NULL, NULL, '8', '分钟定时'),
(5, 53, NULL, NULL, '', '小时定时'),
(5, 54, NULL, NULL, NULL, '每日定时');

-- --------------------------------------------------------

--
-- 表的结构 `system_event_evs`
--

CREATE TABLE `system_event_evs` (
  `belong` varchar(4) NOT NULL COMMENT '步骤从属事件',
  `id` int(4) NOT NULL COMMENT '步骤id',
  `s_attrs` text COMMENT '设置属性',
  `m_attrs` text COMMENT '更改属性',
  `equips` varchar(255) DEFAULT NULL COMMENT '装备相关',
  `a_skills` varchar(255) DEFAULT NULL COMMENT '学会技能',
  `r_skills` varchar(255) DEFAULT NULL COMMENT '废除技能',
  `items` varchar(255) DEFAULT NULL COMMENT '更改物品',
  `a_tasks` varchar(255) DEFAULT NULL COMMENT '触发任务',
  `r_tasks` varchar(255) DEFAULT NULL COMMENT '删除任务',
  `cond` varchar(255) DEFAULT NULL COMMENT '触发条件',
  `exec_cond` text COMMENT '执行条件',
  `cmmt` text COMMENT '触发提示语',
  `cmmt2` text COMMENT '不满足提示语',
  `not_return_link` tinyint(4) DEFAULT '1' COMMENT '是否没有返回游戏的链接，1为没有',
  `dests` varchar(255) DEFAULT NULL COMMENT '移动目标',
  `inputs` text COMMENT '用户输入',
  `just_return` tinyint(4) DEFAULT '0' COMMENT '执行后立即返回',
  `view_user_exp` varchar(255) DEFAULT NULL COMMENT '查看玩家的id表达式',
  `page_name` varchar(100) DEFAULT NULL COMMENT '显示页面模板',
  `refresh_scene_npcs` varchar(255) DEFAULT NULL COMMENT '刷新场景npc',
  `refresh_scene_items` varchar(255) DEFAULT NULL COMMENT '刷新场景物品',
  `a_adopt` varchar(255) DEFAULT NULL COMMENT '添加宠物',
  `r_adopt` varchar(255) DEFAULT NULL COMMENT '删除宠物'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_event_evs`
--

INSERT INTO `system_event_evs` (`belong`, `id`, `s_attrs`, `m_attrs`, `equips`, `a_skills`, `r_skills`, `items`, `a_tasks`, `r_tasks`, `cond`, `exec_cond`, `cmmt`, `cmmt2`, `not_return_link`, `dests`, `inputs`, `just_return`, `view_user_exp`, `page_name`, `refresh_scene_npcs`, `refresh_scene_items`, `a_adopt`, `r_adopt`) VALUES
('1', 1, 'u.max_burthen=50', '', NULL, '1', '', '', NULL, NULL, '', '', '', '', 1, '', '', 0, '', '', '', '', NULL, NULL),
('2', 2, '', '', NULL, '', '', '', NULL, NULL, '', '', '', '', 0, NULL, '', 0, '', '', '', '', NULL, NULL),
('24', 6, '', 'u.zxsj=1', NULL, '', NULL, '', NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('22', 7, 'u.maxhp=({u.lvl}+10)*({u.lvl}+5)*2,u.hp={u.maxhp}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('52', 8, '', 'g.minute=1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('31', 9, 'u.xxx={o.id}', 'u.v(u.xxx).cs=1', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `system_event_evs_npc`
--

CREATE TABLE `system_event_evs_npc` (
  `belong` varchar(4) NOT NULL COMMENT '步骤从属事件',
  `id` int(4) NOT NULL COMMENT '步骤id',
  `s_attrs` text COMMENT '设置属性',
  `m_attrs` text COMMENT '更改属性',
  `equips` varchar(255) DEFAULT NULL COMMENT '装备相关',
  `a_skills` varchar(255) DEFAULT NULL COMMENT '技能相关',
  `items` varchar(255) DEFAULT NULL COMMENT '更改物品',
  `a_tasks` varchar(255) DEFAULT NULL COMMENT '触发任务',
  `r_tasks` varchar(255) DEFAULT NULL COMMENT '删除任务',
  `cond` varchar(255) DEFAULT NULL COMMENT '触发条件',
  `exec_cond` text COMMENT '执行条件',
  `cmmt` text COMMENT '触发提示语',
  `cmmt2` text COMMENT '不满足提示语',
  `not_return_link` tinyint(4) DEFAULT '0' COMMENT '是否有返回游戏的链接',
  `dests` varchar(255) DEFAULT NULL COMMENT '移动目标',
  `inputs` text COMMENT '用户输入',
  `just_return` tinyint(4) DEFAULT '0' COMMENT '执行后立即返回',
  `view_user_exp` varchar(255) DEFAULT NULL COMMENT '查看玩家的id表达式',
  `page_name` varchar(100) DEFAULT NULL COMMENT '显示页面模板',
  `refresh_scene_npcs` varchar(255) DEFAULT NULL COMMENT '刷新场景npc',
  `refresh_scene_items` varchar(255) DEFAULT NULL COMMENT '刷新场景物品'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='这是处理非公共事件的其余事件';

--
-- 转存表中的数据 `system_event_evs_npc`
--

INSERT INTO `system_event_evs_npc` (`belong`, `id`, `s_attrs`, `m_attrs`, `equips`, `a_skills`, `items`, `a_tasks`, `r_tasks`, `cond`, `exec_cond`, `cmmt`, `cmmt2`, `not_return_link`, `dests`, `inputs`, `just_return`, `view_user_exp`, `page_name`, `refresh_scene_npcs`, `refresh_scene_items`) VALUES
('1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '你好！\r\n', NULL, 0, NULL, NULL, 0, NULL, '', NULL, NULL),
('2', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '再见！', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `system_event_evs_self`
--

CREATE TABLE `system_event_evs_self` (
  `belong` varchar(4) NOT NULL COMMENT '步骤从属事件',
  `id` int(4) NOT NULL COMMENT '步骤id',
  `s_attrs` text COMMENT '设置属性',
  `m_attrs` text COMMENT '更改属性',
  `equips` varchar(255) DEFAULT NULL COMMENT '装备相关',
  `a_skills` varchar(255) DEFAULT NULL COMMENT '学会技能',
  `r_skills` varchar(255) DEFAULT NULL COMMENT '废除技能',
  `items` varchar(255) DEFAULT NULL COMMENT '更改物品',
  `a_tasks` varchar(255) DEFAULT NULL COMMENT '触发任务',
  `r_tasks` varchar(255) DEFAULT NULL COMMENT '删除任务',
  `fight_npcs` varchar(255) DEFAULT NULL COMMENT '挑战人物',
  `cond` varchar(255) DEFAULT NULL COMMENT '触发条件',
  `exec_cond` text COMMENT '执行条件',
  `cmmt` text COMMENT '触发提示语',
  `cmmt2` text COMMENT '不满足提示语',
  `not_return_link` tinyint(4) DEFAULT '1' COMMENT '是否没有返回游戏的链接，1为没有',
  `dests` varchar(255) DEFAULT NULL COMMENT '移动目标',
  `inputs` text COMMENT '用户输入',
  `just_return` tinyint(4) DEFAULT '0' COMMENT '执行后立即返回',
  `view_user_exp` varchar(255) DEFAULT NULL COMMENT '查看玩家的id表达式',
  `page_name` varchar(100) DEFAULT NULL COMMENT '显示页面模板',
  `refresh_scene_npcs` varchar(255) DEFAULT NULL COMMENT '刷新场景npc',
  `refresh_scene_items` varchar(255) DEFAULT NULL COMMENT '刷新场景物品',
  `a_adopt` varchar(255) DEFAULT NULL COMMENT '添加宠物',
  `r_adopt` varchar(255) DEFAULT NULL COMMENT '删除宠物'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_event_evs_self`
--

INSERT INTO `system_event_evs_self` (`belong`, `id`, `s_attrs`, `m_attrs`, `equips`, `a_skills`, `r_skills`, `items`, `a_tasks`, `r_tasks`, `fight_npcs`, `cond`, `exec_cond`, `cmmt`, `cmmt2`, `not_return_link`, `dests`, `inputs`, `just_return`, `view_user_exp`, `page_name`, `refresh_scene_npcs`, `refresh_scene_items`, `a_adopt`, `r_adopt`) VALUES
('2', 2, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '---\r\n\r\n**游戏用户协议**\r\n\r\n**一、接受协议**\r\n1. 感谢您选择使用【{c.name}】游戏（以下简称“游戏”）。在使用本游戏前，请仔细阅读并理解本用户协议。\r\n2. 您同意并接受本协议的全部内容，一旦使用本游戏，即表示您同意遵守本协议的条款和条件。\r\n\r\n**二、用户许可**\r\n1. 我们授予您一项有限的、非排他性的许可，以使用【{c.name}】游戏，但您不得以任何方式复制、修改或分发游戏。\r\n2. 您不得使用任何未经授权的方式干扰、破坏或尝试破坏游戏的正常运作。\r\n\r\n**三、账户**\r\n1. 您需要创建一个游戏账户，您对该账户的安全负有责任。\r\n2. 您不得分享或泄露您的账户信息，如有账户安全问题，您应立即通知我们。\r\n\r\n**四、游戏内容**\r\n1. 游戏内的虚拟物品和货币属于【{c.name}】，您无权要求以任何形式兑换或提取。\r\n2. 我们保留随时修改、更新或删除游戏内容的权利。\r\n\r\n**五、隐私政策**\r\n1. 您同意我们的隐私政策，了解我们如何处理您的个人信息。\r\n2. 我们将采取合理措施保护您的个人信息的安全。\r\n\r\n**六、终止**\r\n1. 您可以随时停止使用游戏。\r\n2. 我们有权随时终止您的许可，如果您违反本协议。\r\n\r\n**七、免责声明**\r\n1. 游戏按“原样”提供，我们不保证游戏的适用性、可用性或安全性。\r\n2. 我们不对因使用游戏而引起的损失承担任何责任。\r\n\r\n**八、协议变更**\r\n1. 我们保留随时更改本协议的权利。\r\n2. 更新后的协议将在游戏内生效，您应定期查看协议内容。\r\n\r\n**九、联系我们**\r\n1. 如果您有任何问题或疑虑，请联系我们。\r\n\r\n**十、法律适用**\r\n1. 本协议受相关法律的约束。\r\n\r\n【{c.name}】游戏团队\r\n\r\n---\r\n', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('4', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('4', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一座无名的石碑。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('6', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一块有些年头的大理石圆柱石碑，右上角缺了一口，石碑中间位置写着：\r\n@red@中庭地白树栖鸦，冷露无声湿桂花。\r\n今夜月明人尽望，不知秋思落谁家。@end@', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('7', 8, '', 'u.hp=-{r.10}', NULL, NULL, NULL, '1|-1', NULL, NULL, NULL, '', '', '你好！{u.name}。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('8', 9, '', 'u.hp={u.maxhp}-{u.hp}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}：怎么伤得这么重，让我给你治疗一下吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('9', 10, 'u.pick_lj={c.time}', 'u.hp=-{r.20}', NULL, NULL, NULL, '9|{r.2}+1', NULL, NULL, NULL, '', '', '你打开了这个圆柱形的家伙，一股恶臭向你袭来，你感觉整个人都不好了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('10', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你拿起了褶皱的报纸一看，上面很大一部分的字迹都模糊了，只有一行字还比较完整：\r\n@red@希望小队至今无一人有消息。@end@', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('11', 12, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '一盏由橡木和不知名水晶组合成的路灯，不清楚其运行机理。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('12', 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这个咖啡杯已经很久没有使用过了，灰尘遍布。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('13', 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '树枝，废铁，封的死死的，毫无办法。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('14', 15, NULL, '', NULL, NULL, NULL, '1|10', NULL, NULL, NULL, '', '', '「{o.name}」望了望你的样子。\r\n「{o.name}」：嘿，小子，你从哪里来?(说完便抽了一口手中的劣质雪茄)\r\n「{u.name}」：我可能患有间歇性失忆症，忘记了很多事，我只知道自己叫「{u.name}」了。\r\n「{o.name}」：旧街不养闲人，你必须证明你自己的价值，否则就会被驱赶出去荒野！\r\n「{u.name}」：我看路上有很多无家可归的人啊，他们怎么可以留在这。\r\n「{o.name}」：他们?他们是附近一个避难所被异兽潮汐攻陷后的流民，身份干净的可怜人，睁一只眼闭一只眼了，但你的眼神迷茫却没有绝望，只是疑惑。\r\n「{u.name}」：好吧。。。怎么证明?\r\n「{o.name}」：很简单，智力和武力。\r\n「{u.name}」毫不犹豫：我选择智力。\r\n「{o.name}」：你是第925个挑战智力的，我劝你直接放弃去选择武力。\r\n「{u.name}」：智力的考验是什么?\r\n「{o.name}」：也罢，虽然已经讲过了924遍了，再讲一遍又何妨呢?咳咳，听好了：\r\n一天早上，「薇儿」医生想去荒野采集草药时，惊讶地发现自己的智能轮椅不见了，他知道，一定是邻居家的那几位小孩干的。她很清楚，这几个孩子经常喜欢搞恶作剧，于是便找到了邻居家里，恰好，邻居家5个小孩都在。\r\n「薇儿」很和蔼地笑了笑，并询问是不是你们当中谁骑走了她的轮椅。然而，这五个孩子却给她出了一道题。下面是这5个孩子陈述的内容，其中各有一半正确一半错误。（即：一句话中，逗号前面是一半，后面是一半）\r\n孩子A：是B骑走的，C说D骑走的是撒谎；\r\n孩子B：不是我骑走的，也不是A骑走的；\r\n孩子C：不是B骑走的，是D骑走的；\r\n孩子D：A说是B骑走的是说谎，B说不是A骑走的是真的；\r\n孩子E：不是我骑走的，关于这件事我只知道这么多。\r\n聪明的「薇儿」听完他们的话，很快就推理出究竟是谁骑走的轮椅，很快便找到了轮椅。\r\n请问，根据以上信息，你能否推理出，究竟是哪一个孩子骑走的呢？请给出你的推理。\r\n「{u.name}」：是。。。算了还是说说武力测试吧。\r\n「{o.name}」：往东边走过去你会看到一条发黑粘稠的小河，那边发生了一些异变导致堤岸的泥土拥有了形体和微弱的战斗本能，去取得它们身上3块「变异的土」给我证明你是个有点战斗能力的人。\r\n「{u.name}」：这么简单啊?我去去就来。\r\n「{o.name}」：别小瞧了，这些「变异的泥土生物」力气很大且不惧怕疼痛的，这几个药带着，外乡人。(说完「{o.name}」便自顾自抽剩下的半截雪茄去了)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('15', 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '腐烂的大理石桌上躺着一座老式台灯，灯罩漏了一个洞，你用右手食指碰了一下，突然发现墙壁角落里出现了一个秘密通道...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('15', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '309', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('16', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'gomid|传送mid|1|10', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('16', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.value}!=\"\"', '', '你输入的是{u.input.value}！', '', 0, '{u.input.value}', NULL, 0, '', '', '', '', NULL, NULL),
('17', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, NULL, 0, '', 'ct_tent', '', '', NULL, NULL),
('19', 23, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '「{o.name}」：你就是「{u.name}」吧，我从「莉莉安」那听过你的大名。\r\n「{u.name}」：这真是我的荣幸啊。\r\n「{o.name}」：行了，闲话不多说，我有点事走不开，你能帮我找来几个「变异利爪」吗，我会给你付报酬的，我需要这些爪子造点有趣的东西。\r\n「{u.name}」：我要去哪里找?还有，什么有趣的东西?\r\n「{o.name}」：去那片「灰青草地」看看吧！这是秘密，你要是能找来我要的东西我可以考虑告诉你。\r\n「{u.name}」：行，那你等我吧。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('19', 24, NULL, NULL, NULL, NULL, NULL, '1|5', NULL, NULL, NULL, '', '', '「{o.name}」：行，带上这些药，你也许能用到。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('20', 25, NULL, 'u.exp=500,u.money=50', NULL, NULL, NULL, '1|10,24|-5', NULL, NULL, NULL, '', '', '你将五个「变异利爪」递给了「{o.name}」\r\n「{u.name}」：给，这应该是你要的东西吧?\r\n「{o.name}」拿起来反复观摩了好一会，说道：太好了，这下我的「秘密武器」的最后一块总算补上了。\r\n「{u.name}」：什么「秘密武器」?\r\n「{o.name}」一脸警惕和不耐烦：这些东西拿着，当你的报酬了，好了没有「秘密武器」，该干嘛干嘛去，不要烦我。\r\n「{u.name}」：。。。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('22', 27, NULL, NULL, NULL, NULL, NULL, '67|1', NULL, NULL, NULL, '', '', '「{u.name}」:找我何事?\r\n「{o.name}」:听说最近你帮旧街的大家解决了很多问题嘛，挺能干的啊～(抽了一口烟)\r\n「{u.name}」:大哥，您又要让「{u.name}牌牛马」干什么事了，我有心理准备。\r\n「{o.name}」突然严肃起来:「希望镇」的商队已经很久没过来了，我担心是不是出了什么变故，我观察你最近表现，身手很敏捷，我想让你去那边看一看，顺便把我的一封信带给我的老朋友「姗妮」，她就是「希望镇」贸易的负责人，她住在希望小区1栋306房间，事成之后我会把我一条珍贵的项链送给你当作报酬。\r\n「{u.name}」:「歌尔特」说要到那边去很危险，我觉得你就是故意让我去送死！\r\n「{o.name}」:不是的，实在是「希望小队」的成员全体失踪，「歌尔特」的伤又那么严重，现在只能靠你了，如果你不愿意，我不敢想象没有商队补给这边稀缺的物资过来，旧街的大家能撑到什么时候。。。\r\n「{o.name}」陷入了沉默。\r\n「{u.name}」:我接了，正好我也要寻找一下自己身世来历，看看希望镇那有没有什么线索，但是我还有一个要求。\r\n「{o.name}」:什么要求?\r\n「{u.name}」:等我回来再说。\r\n说完你便准备起身离开。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('24', 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你从暗道的管道口爬了出去。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('24', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '306', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('25', 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这座断桥原本应该是通向外界的，不知什么原因断了，也许是年久失修吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('26', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一台能与外界进行联络的通讯设备，但似乎不能运转了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('27', 33, NULL, 'u.money=-200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.money}>=200', '', '「巡逻警卫」瞅了你一眼，收下了你的200张信用币，数了一会，随后便示意你进去。', '「巡逻警卫」：非希望镇居民进入需缴纳200信用币进城费!', 1, '', NULL, 0, '', '', '', '', NULL, NULL),
('28', 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '雕像通体长大约五米，宽两米，刻画的是一个双手拿着一把威能武器的中年男人，下面还有刻字：@red@人类纪元3216年，于此立镇取名〝希望〞，纪宁留@end@。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('29', 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '295', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('30', 36, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '37|{r.6}+1,18|{r.6}+1', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('27', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '236', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('31', 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18|100', '', '', '你好奇地看了看地洞，结果钻出来一堆怪物。\r\n', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('31', 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '287', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('32', 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}:......\r\n他似乎并不想理你。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('33', 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_HW003', '', '', NULL, NULL),
('34', 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'H-W-003：自从异变以来，自然界中的地表水源发生了未知的变异，长期使用者罹患癌症丶重度癫痫等不治之症，目前仅有深藏于地下的水源和经过多道工序蒸馏冷凝水得到的过滤水可以使用，每一滴水源都来之不易，望每个希望镇居民能珍惜！', '', 0, NULL, NULL, 0, '', 'ct_HW003', '', '', NULL, NULL),
('35', 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：看你这副打扮，你就是「莉莉安」推荐的「{u.name}」吧。\r\n「{u.name}」：我不知道怎么就失忆了，如果这个聚集地没有其他叫「{u.name}」的，那应该是我了。\r\n「{o.name}」：那你应该也从「莉莉安」那听说过我了，这样吧，也不卖关子了，你去北边杀几只老鼠看看实力。\r\n「{u.name}」：不就是几只老鼠，洒洒水啦～\r\n「{o.name}」：一棵灌木丛那么大的老鼠呢?\r\n「{u.name}」：呃，这个那个，有这么大的老鼠?\r\n「{o.name}」：北边的地原本是一片肥沃的草场，自从异变发生后，科学家猜测是某种辐射导致的生物群落变异，原先绿油油的草地不见了，变成了灰青色的草，这种草正常人吃了就会上吐下泻虚脱，但原来的野生鼠吃了以后就产生了奇怪的变异，现在和灌木丛一样大咯。\r\n「{u.name}」：不过是大一点的老鼠嘛，多大点事～\r\n「{o.name}」：那么大的牙齿咬人的话真的会死人的，而且据说在深处还有一只鼠王，被咬一口三分钟内就会中毒身亡，七窍流血死得很难看。\r\n「{u.name}」：这么可怕，那我能不能不去了?\r\n「{o.name}」：不行，「莉莉安」交代说如果你不去就把你逐出旧街。\r\n「{u.name}」：该死的女人！\r\n(你转身离去)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('37', 44, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}:谢谢您的光临！', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('36', 45, NULL, 'u.money=20,u.exp=500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：可以，有两下子嘛{e.player_sex}，虽然是对你的考验，不过也得给你点回报，毕竟，天下没有免费的劳动是吧?收着吧这是给你的报酬。\r\n「{u.name}」：简简单单信手拈来！\r\n「{o.name}」：还挺自信啊?我这边暂时没什么适合你的委托，不过好像「皮格」有事情在找人，你可以去找他看看，他在南街那里，噢～你也可以顺道去看看可怜的「迪伦斯」，真是个可怜的家伙，就说是我说的，去吧！我先忙去了！\r\n「{u.name}」：「迪伦斯」?\r\n(「{o.name}」没有回应，转身捣鼓自己的笔记本去了)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('38', 46, NULL, 'u.hp=-({r.u.maxhp})', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」正在自言自语什么：蓝色蚊子的血偏碱性，用巨型苍蝇的卵中和一下，再用水元素粘液稀释，这样下来这道菜一定很美味！\r\n「{u.name}」：你好！\r\n「{o.name}」：{e.player_sex}，吓我一跳，想尝尝「{o.name}」的美食吗?\r\n「{u.name}」：美食?\r\n你看着眼前这口大坩埚里咕噜冒泡的五颜六色的液体，不禁浑身颤抖。\r\n「{u.name}」：这能吃?骗鬼呢?\r\n「{o.name}」：{e.player_sex}，新来的吧，旧街上谁不知道「{o.name}」的大名，有意思，这么久了，竟然有新人会来到旧街，好好好！哈哈哈！\r\n你看着对方狂笑，感觉是不是来错地方了，正打算回去找一下「歌尔特」问看看。\r\n「{o.name}」的一只大手就搭过来肩膀，重重地拍了你几下，你感觉胸腔的气血都要蹦出来了。\r\n「{u.name}」：有猫病?你这看起来就像是旧世纪书中那些女巫婆炼金的药液一样，你自己尝了吗?你看那冒着咕噜的泡泡，我想，里面孕育着恶魔是吧！\r\n「{o.name}」：{e.player_sex}，你是在挑战「{o.name}」的厨艺吗?看样子不露两手给你看看，你还真没把「{o.name}」放眼里呀，这样吧，就眼前这口汤，我其他辅料都准备好了，就差一味「蓝蚊子的血」，你去北边搞几滴过来，我让你见识下啥叫美味！\r\n「{u.name}」：我才不想当小白鼠，除非?\r\n「{o.name}」：除非什么?\r\n「{u.name}」：得加钱！\r\n「{o.name}」：哼，真是庸俗，我的美味岂是俗物可以衡量的。\r\n「{u.name}」：那我走?\r\n「{o.name}」：+100\r\n「{u.name}」：成交！大爷您要蓝蚊子血液是吧，得勒，马上来！\r\n「{o.name}」：哼，臭{e.player_sex}，一定让你看看「{o.name}」的手艺！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('39', 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一方不大不小的水池，周围的野生动物有时会来此补给水分，也是蚊子的滋生地！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('40', 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}：传说，一场灾变几乎导致了人类的灭顶之灾，而后身处神国的主不顾天地法则的戒律，硬是往这绝望的土地传下祂的力量，主的心中有大慈大悲之心，祂怜悯世人，祂指引世人，祂将祂的无限伟力无偿地赋予了每一位祂的信徒们，祂曾降下神谕：希望是最伟大的力量。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('41', 49, NULL, 'u.exp=500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你看着眼前这个眼神呆滞的男人，心里涌现了一股怜悯。\r\n「{o.name}」：乌鸦！好多乌鸦！（说完「{o.name}」又蹲在了墙角，一只手抱着头，一只手在啃一个早已变质发臭的面饼）\r\n你感到奇怪，这个乌鸦肯定是关键线索，你想想还是回去和歌尔特说明一下情况吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('42', 50, NULL, NULL, NULL, NULL, NULL, '6|1', NULL, '6', NULL, '', '', '{u.name}：「迪伦斯」，他究竟怎么了?\r\n{o.name}：你看过他的状态了吧。\r\n{u.name}默尔不语。\r\n{o.name}拿起了他的笔记本，提了下眼镜，轻轻翻了几下。\r\n{o.name}接着说：也是过去半年了啊，这日子真是没个安生的，算一天过一天啊。\r\n{u.name}：到底发生什么事了。\r\n{o.name}：半年前的一天，由于生态平衡已经彻底被打破了，造成了那些变异的野兽食物短缺，从而发疯似的朝着「旧街」的聚集地冲撞，起码有上千只了，这些变异的野兽力大无比，魁梧健壮，地上跑的天上飞的都有。那天我正在安排佣兵团处理一个地下水道老鼠的事情，然后......\r\n{u.name}：等等，什么地下水道老鼠?\r\n{o.name}：这不重要，重要的是那个时候忽然从天空传来几声刺耳的尖叫，震碎了好多居民的木房子，接着就看到不远处的草地那边像地震一样跑着许许多多的野兽，「旧街」上的人很慌张，于是我马上拉响了最高警戒，很快，「旧街」上能战斗的都拿起武器聚集到广场上了。「迪伦斯」的父亲「詹姆士」也在内。\r\n{u.name}：然后呢?\r\n{o.name}：不知道为什么，那次的异兽潮很不对劲，狼群里那几只最健壮的青狼一起扑向了「詹姆士」，「詹姆士」寡不敌众，我们其他人也被缠着腾不出手，结果「詹姆士」硬生生拼死了两头青狼，剩下的一头青狼也精疲力竭全身重伤，这时红狼王见状呼嚎了一声，异兽潮很快退去了，而「詹姆士」深受重伤又精疲力尽，最终卡尔萨斯也没能救回来，更可怜的是「迪伦斯」亲眼目睹了父亲的死，结果精神失常了，只是不断喊着〝紫色的丶乌鸦，我不是叛徒之类的〞。\r\n{u.name}：叛徒?「詹姆士」之前是哪里来的?\r\n{o.name}：「旧街」的规矩是来者只要被认可为一员不会询问来处，不过以我多年接触到的人以及他的口音推测可能是「希望镇」的人吧。\r\n{u.name}：「希望镇」?\r\n{o.name}：是的，那是一片人类仅剩不多的繁华之地，从「旧街」北边过去要跨过很长的路，没有专业的护卫队和枪械力量根本过不去。算了我们还是说说「迪伦斯」的事情吧。我觉得突破口在于找到「紫色的羽毛」，估计「灰青草地」深处会有线索，我事务很忙走不开，这件匕首给你，这事只能麻烦你了。\r\n{u.name}：我会尽力的。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('44', 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '【{c.name}】账号密码安全手册(第一版)\r\n为了您的账号安全，请阅读本手册。\r\n免责声明：若出现账号纠纷，无法以未阅读本手册作为辩护理由。\r\n1.用户不得将账号密码丶安全令丶绑定手机号等泄漏或提供给第三人知悉，亦或者转让他人使用，如因用户自身不遵守本条导致的账号数据丶财产损失等，由用户自身承担责任，本公司将协助调停并调和双方矛盾。\r\n2.若忘记账号密码，可通过绑定手机号验证码找回或者安全令进行重置。\r\n', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('45', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '〝善良，真诚，矢志不渝，机器的轰鸣没有击碎人性的美好，那是段祥和的时光。〞旧纪元的故事仿佛只留存在了少数的古书之中，过去的百年间，世界发生了太多的变化，这变化让人类不得不重新思考自己和这个世界的关系，那场至今都是未解之谜的异常中子星衰变带来了一系列的灾难，野兽普遍体型剧增，开始变得癫狂又富有攻击性;地表水等基础资源受到未知变异，表现出许多的特性。\r\n人类的未来何去何从?', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('43', 53, NULL, 'u.money=50,u.money=100,u.exp=500', NULL, NULL, NULL, '29|-5,31|1', NULL, NULL, NULL, '', '', '你将几滴蓝色液体递给了「{o.name}」。\r\n「{o.name}」颤抖着双手接过：很好，就是这个。\r\n只见「{o.name}」将那几滴蓝色液体加入沸腾的糊状液体中，原本暗红的液体时而浅蓝，深蓝，时而又变回暗红，最后「{o.name}」将几粒白色颗粒粉末碾碎撒入后，颜色固定成了棕蓝色，液体也变得很粘稠，最后几乎成了固体，只见「{o.name}」将早已准备好的木勺一舀，装进了一个木色方形袋子中。\r\n「{o.name}」：一份Q弹可口的「营养元素冻」，请享用，这是给你的，{e.player_sex}，为了感谢你，做事不拖泥带水，很合「{o.name}」胃口，「{o.name}」心情很好，决定以后你可以从「{o.name}」的买走美味！\r\n「{u.name}」：哇，大爷你真厉害！给你竖大拇指！\r\n(这大爷不会真有什么毛病吧，你心想)\r\n「{o.name}」：好了，美味的征程是无止境的，「{o.name}」要开始研究下一道美食的旅途了，有缘再见！\r\n「{u.name}」：那就希望大爷能继续创造美味咯～(o～\r\n「{o.name}」：怎么了?\r\n「{u.name}」：美食，最近睡眠不好，头有点晕。\r\n「{o.name}」：要注意休息啊，这是「{o.name}」给朋友的报酬，收好了！\r\n「{u.name}」：再见，大爷！\r\n(你觉得还是有必要回去找找「歌尔特」)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('48', 54, NULL, NULL, NULL, NULL, NULL, '1|10', NULL, NULL, NULL, '', '', '「{u.name}」：我觉得你在坑我！\r\n「{o.name}」：为什么这么说？\r\n「{u.name}」：你让我去找「皮格」，我真醉了他要什么蓝蚊子的血液，说要做美食，这太扯淡了！\r\n「{o.name}」：哈哈，你竟然能让「皮格」那家伙理你，我本来都没抱什么希望，这旧街能让「皮格」说上几句话的可没几个，他的东西奇怪是奇怪了点，可味道没得说，最主要的是效果。\r\n「{u.name}」：效果？\r\n「{o.name}」：是的，他的食物有的能解放人体基因锁，有的能增强体质，有的能加强回复力。\r\n你拿起手中那个奇怪的食物。\r\n「{u.name}」：真这么神？\r\n「{o.name}」：以后你有机会会见到的，不过最好是不要见到。\r\n「{u.name}」：我还是不信...\r\n你话还没说完，「{o.name}」突然抬起了腕表，只见上面闪着几道红色的激光。\r\n「{o.name}」：你可能要用上了。\r\n「{u.name}」：？？？\r\n「{o.name}」：这个月的狼群数量波动异常了，一些「变异的灰狼」战斗能力会变强但群体意识会下降脱离狼群，现在我正式委托你前去清理一些「变异的灰狼」，它们的尾巴上有淡淡的蓝光，很好辨认，对了如果遇到尾巴上是淡淡红光的，赶紧跑，那是「变异狼王」。\r\n「{u.name}」：你为什么不自己去？或者让你的佣兵团去？\r\n「{o.name}」：其他的佣兵都有自己的任务了，你的战斗力也不弱，对了，这些药品给你作为补给品，别死那了，这是「莉莉安」大人说的。\r\n「{u.name}」：恶毒的女人，还有你，鄙视你。\r\n「{o.name}」：今天的羊羔肉卷饼价格是...\r\n「{o.name}」回过头去在笔记本上写写划划，仿佛把你当成了空气。\r\n「{u.name}」：......', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('49', 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你仔细找了找鹅卵石小路旁边一个不起眼的小洞口，而后钻了进去...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('49', 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '339', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('50', 57, 'u.nick_name=\"旧街居民\",u.tent_x=2,u.tent_y=2,u.tent_z=1.5,u.tent_color=\"灰色\",u.tent_burthen=100', 'u.exp=1000,u.money=50', NULL, NULL, NULL, '1|20,18|3,11|3', NULL, NULL, NULL, '', '', '「{o.name}」：很好，「莉莉安」大人说了，你用行动帮助了「旧街」，也用行动证明了你的能力，从现在开始，你被正式接受了，成为「旧街」的一个居民，有顶闲置的帐篷你拿去用吧。\r\n获得称号：旧街居民\r\n「{u.name}」：啊?不用再完成你的委托啦?那个坏女人呢?\r\n「{o.name}」：嘘～可不许这样背后嘀咕「莉莉安」大人，委托你想做就做吧，只是在旧街遭遇生死危机的时候履行你作为旧街居民的义务就行，这些奖励你先拿着，以后每天你可以在我这领取一些物资和金钱，当然没有这次这么多，「莉莉安」大人好像找你有事，你去看看吧！\r\n「{u.name}」：哇，行，旧街是我家，美化靠大家。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('47', 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你似乎没有办法徒手爬上去。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('51', 59, 'u.fix_bridge=1', NULL, NULL, NULL, NULL, '8|-10,10|-20,15|-5,37|-3', NULL, NULL, NULL, '{u.ic.i8}>=10&&{u.ic.i10}>=20&&{u.ic.i15}>=5&&{u.ic.i37}>=3', '', '你将所有材料拿了出来，按照脑海中的大概念想，先是用黑色牛角钉住了铁皮和小树枝编成的简易桥体，然后竖了起来慢慢往对岸轻轻放下，随着扑腾一声，你用石块压住了黑牛角，而后走到对岸又用黑牛角以及碎石做了固定，这座桥看起来勉强可以过人了。', '你看了一眼这座年久失修的破桥，脑海在飞速计算，要修好面前这座残破的桥的话，差不多需要10个左右铁皮({u.ic.i8})，20个小树枝({u.ic.i10})，5个碎石块({u.ic.i15})和3个黑色牛角({u.ic.i37})。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('52', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你蹑手蹑脚地踏上了桥，一步步地移动到对岸......', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('52', 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '489', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('53', 62, NULL, 'u.exp=800,u.money=100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你将拿到的羽毛递给了「{o.name}」\r\n只见{o.name}翻出了他的笔记本，翻着翻着找到了一页对应的页数。\r\n「{o.name}」：有了。\r\n「禽类变异羽毛」-「紫色乌鸦羽毛」\r\n说明：原先是普通的乌鸦的羽毛，经历不知名变异后通体为紫色，带有中度致幻效果，会尝试诱导较为刺激性的往事，若无法及时被唤醒则会逐渐迷失直至精神衰亡。\r\n「{u.name}」：那我为什么和它们战斗的时候没有被影响?\r\n「{o.name}」用右手顿了顿眉心：我记得你说过你是一个失忆的旅人是吧，若是如此，那便可以解释得通了，你的记忆以普通乌鸦的致幻性不足以撬开那个封口，所以也就不会让你致幻了。\r\n「{u.name}」：唉，要是能帮我回忆起来也好啊，我也不至于这么迷茫。话说这样的话我们要怎么解救「迪伦斯」?\r\n「{o.name}」：为今之计，只有去「迷雾小屋」那找一下「赛西」，让她用一味刺激性的魔药强行唤醒「迪伦斯」了，这件事我亲自去处理一下吧，「赛西」不太希望被陌生人打扰。\r\n「{u.name}」：这个「赛西」是谁?\r\n「{o.name}」：一个神秘的女士，擅长一些不可思议的事情，好了以后有机会再介绍给你，这些是给你的报酬，唉，可怜的「迪伦斯」......', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('54', 63, 'u.lq_map0_dailygift={c.date}', NULL, NULL, NULL, NULL, '2|{r.2}+1,1|3', NULL, NULL, NULL, '{u.lq_map0_dailygift}!={c.date}||{u.is_designer}==1', '', '{o.name}：每天的供给都十分有限，身为旧街居民的一员，更应该有为旧街贡献的觉悟！这是你今天的补给。\r\n{o.name}说完掏出了他的笔记本。', '{o.name}掏出了他的笔记本。\r\n{o.name}：根据记载，今天你的供给已经发放了呀。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('56', 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '你好！欢迎来到{o.name}!', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('59', 65, 'u.map_enter_fog=0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('60', 66, NULL, 'u.map_enter_fog=1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.map_enter_fog}<4&&{u.tasks.t7}==2', '你感觉有些不太对劲...', '', 1, '', NULL, 1, '', '', '', '', NULL, NULL),
('60', 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.map_enter_fog}>=4&&{u.tasks.t7}==2', '你逐渐迷失了自我...', '', 1, '554', NULL, 0, '', '', '', '', NULL, NULL),
('69', 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你打开了面前的这扇木门，忽然一股吸力将你往外吸出，回头已经看不见小屋的踪迹，只有一片迷雾回应你...', '', 1, '539', NULL, 0, '', '', '', '', NULL, NULL),
('70', 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '615', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('71', 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_HP_lift_1', '', '', NULL, NULL),
('72', 71, '', 'u.money=520', NULL, NULL, NULL, '2|-1', NULL, NULL, NULL, '', '', '你打开了钱袋，发现了不少钱。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('1', 72, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_test', '', '', NULL, NULL),
('75', 73, 'u.qd_daily={c.date}', 'u.v(u.money)=1', NULL, NULL, NULL, '1|{r.c.day}+1', NULL, NULL, NULL, '{u.qd_daily}!={c.date}||{u.name}==\"轩辕\"', '', '签到成功！', '今日已签到!', 0, NULL, NULL, 0, '', 'ct_test', '', '', NULL, NULL),
('76', 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_bounty_01', '', '', NULL, NULL),
('78', 75, 'u.submit_bounty_01_item_01={c.date}', 'u.exp=1000,u.money=50', NULL, NULL, NULL, '24|-10,1|10', NULL, NULL, NULL, '{u.ic.i24}>=10', '', '「歌尔特」:感谢你的付出，这是你的报酬，请明天再来!', '「歌尔特」:你并没有这么多「变异利爪」，再去找找吧!', 0, NULL, NULL, 0, '', 'ct_bounty_01', '', '', NULL, NULL),
('79', 76, NULL, 'u.money=-50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.money}>=50', '', '「小乞丐」:谢谢你的善良和慷慨，愿「希望之主」眷顾你！', '「小乞丐」:谢谢你的好意，但是你似乎也没有多少余钱了，还是照顾好自己吧！', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('81', 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这座墓碑上没有姓名，仅仅只有一行字:\r\n@red@向为了「火种计划」而牺牲的所有人类同胞致以最崇高的敬意@end@', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('82', 78, NULL, 'u.max_burthen=5', NULL, NULL, NULL, '72|-1', NULL, NULL, NULL, '{u.max_burthen}<100', '', '你拿出背包编织工具，对你的背包进行了一番修缮，忙活了一阵后，看起来你的背包能装下更多东西了。', '你发现再编织下去背包就要散架了，只得收手。', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('83', 79, 'u.tomorrow_1_floor=1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_HP_lift_1', '', '', NULL, NULL),
('84', 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{u.env.name}」', '', 1, NULL, 'hp_1_target_floor|要去几楼呢?|1|2', 0, '', '', '', '', NULL, NULL),
('84', 81, 'u.tomorrow_1_floor={u.input.value}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.value}>=1&&{u.input.value}<=20', '', '你按下了{u.input.value}层的按钮，过了一会功夫，电梯就将你送到了目的地。', '你看了半天，总觉得找不到这个层数啊!', 1, '{eval(v(u.tomorrow_1_floor)==1?493:614)}', NULL, 0, '', '', '', '', NULL, NULL),
('85', 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你往这个粉色的门敲了敲，过了一会，一个美丽的年轻女子出来开门迎接了你...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('85', 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '632', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('86', 84, NULL, NULL, NULL, NULL, NULL, '67|-1', NULL, '3', NULL, '', '', '「{o.name}」(一脸警惕)：你是?\r\n「你」：我是「莉莉安」的。。呃。。朋友，这是她的书信，你看了就明白了。\r\n你递过书信。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('87', 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你正想触碰这个药罐，却被一个声音制止了。\r\n〝别碰这个药罐!除非你想尝尝执法队的子弹!〞', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('88', 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一台高精密的仪器终端，由特制的程序负责调动各个模块和接口实现利用生物能丶太阳能等进行一系列的复杂的能量传递转化。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('89', 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '莫名地产生一股寒意，还是不要随便触碰为好。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('90', 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你轻轻一跃，有惊无险地抓住了古藤条，它宛如粗壮的手臂承载了你的重量，你顺着枝条慢慢往下爬去...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('90', 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '333', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('91', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你用力一蹬，顺着古藤条爬了上去...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('91', 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '546', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('86', 92, NULL, 'u.exp=3000', NULL, NULL, NULL, '128|1', NULL, NULL, NULL, '', '', '「{o.name}」看了看「莉莉安的书信」，嘴中不断呢喃着什么。 不久过后。\r\n「{o.name}」：唉，自从疑似先知预言的「灾月」之后，希望镇的局势就变得很复杂，人心惶惶的，所有商队活动都暂时取消了。我先前有让人给「莉莉安」送去一封书信，看样子信使没有送到，凶多吉少了。\r\n「{o.name}」：既然你能找到这里，想必「莉莉安」对你的能力也很有信心，我这里这封信你再把它交给「莉莉安」，如果可以的话，请她带人过来支援下希望镇，森林那边的异兽潮汐越来越严重了，斥候小队疑似发现了五头异常能量波动的精英级别的异兽，异常行为背后疑似有第三方势力介入。如果不是代理镇长因为上次那事受伤实力大减，这次兽潮倒是勉强可以接下，唉～\r\n你：能将具体事与我说说吗?\r\n「{o.name}」：罢了，时间紧迫，以后你会慢慢明白的，现在先赶紧回去告诉「莉莉安」异兽潮汐异常的消息吧，这封信上我有大概说明了一下情况。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('93', 93, NULL, 'u.exp=3000', NULL, NULL, NULL, '128|-1,137|1', NULL, '9', NULL, '', '', '「{o.name}」看到了你急匆匆的样子，你将「姗妮」的书信递给了她。\r\n「{o.name}」看了看信后，一脸凝重的样子。\r\n「{o.name}」：情况不容乐观。\r\n「{o.name}」：宁静森林的深处传来异动，并且陆陆续续有几头强大的异兽在希望镇哨站附近徘徊，驱赶过程杀了几头，偶然发现它们戴着一种小型的生态力场项圈，有控制心智的功能。\r\n「{o.name}」：这下有些棘手了，我得留在这统筹物资和人员，我需要你的帮助。\r\n「{u.name}」：但说无妨。\r\n「{o.name}」：有几个需要的人，一个是「KM」，是个黑客，住在北边峡谷里，一个是「赛西」，你见过的，她是一个魔法师，还有一个是「赫米特」，她在南边的小树林里，是一个天赋异秉的猎手，他们的性格都比较孤僻，不过也都遵守着旧街的规矩，若有请，以信物回答。\r\n「{u.name}」：也就是我要去取得他们的信物，然后交给你。\r\n「{o.name}」：恩，等你拿来他们的信物，我便知道你已经说服了他们，然后等候他们到来后你便先行带领「先行者小队」前往希望镇，找到「凌影」，他会给你们安排后面都任务的，时间紧迫，莫要拖延。\r\n「{u.name}」：我的项链呢？\r\n一串闪闪发光的项链从空而降，落到了你的手上。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('94', 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '接受了', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('95', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '完成了！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('97', 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '哈哈哈哈！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('98', 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', NULL, NULL),
('99', 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '峡谷的一间小木屋外，你敲了敲门，发现门没锁，于是你谨慎地走了进去，发现一个坐在地板上的人。\r\n「{o.name}」：该死，密克系统又出bug了，你是谁？\r\n「{u.name}」：希望镇出了一些奇怪的事情，「莉莉安」让我来邀请你加入「先驱者小队」前去探查一番，还有，我需要你的信物证明你的加入。\r\n「{o.name}」：一个土豆饼，我就跟你走，信物也给你。({o.name}拿出了胸口一块破碎的怀表)\r\n「{u.name}」(荒郊野岭的哪里给你找这玩意)：行，我去去就来。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('100', 99, NULL, 'u.exp=1000', NULL, NULL, NULL, '65|-1,133|1', NULL, NULL, NULL, '', '', '你将「土豆饼」递给了KM。\r\n「{o.name}」：虽然不是当年那个味道，不过总能勾起我的回忆，真是一段肆意盎然的往事啊哈哈哈。\r\n说完他将胸前破碎的怀表交给了你。\r\n「{o.name}」：虽然不认可当年「莉莉安」的那些行为，但不得不承认，她的行动都是当时的最优解了，这个表请务必保管好，它对我很重要，谢谢。\r\n「{u.name}」：...', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('101', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：又见面了，「{u.name}」，别来无恙，嘘~我知道你的来意，我也很乐意出一份力，但我需要你的帮助。我在一次研究禁忌魔法的时候不小心沾染了深渊，现在我的梦境坐标被一批梦魇获取到了，我的精神状态很差，必须赶紧解决。我稍后会用秘法将你传送去我的梦中世界，你要做的便是帮我消灭一批成长体梦魇，我会在里面巩固一个临时传送阵，你完成后我能感应到，有任何问题你可以第一时间从传送阵往返。\r\n「{u.name}」：梦魇？传送，坏了，遇到真女巫了。\r\n「{o.name}」：...', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('102', 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你站在这座六芒星阵上，一阵奇特的符号出现在你的四周，而后光芒由脚升起，逐渐将你淹没...', '', 1, '677', NULL, 0, '', '', '', '', NULL, NULL),
('103', 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这座缓慢运作的五角星法阵散发着一股奇幻的气息，你站在上面，你的头上生出一颗不断膨胀的粉色光球，而后炸开成湍流而下，你很快便被粉色的洪流淹没...', '', 1, '554', NULL, 0, '', '', '', '', NULL, NULL),
('104', 103, NULL, 'u.exp=1200', NULL, NULL, NULL, '132|1,95|1', NULL, NULL, NULL, '', '', '「{o.name}」：噢，感谢你，终于能睡个好觉了，这些天可没少折腾，这个发夹给你，这颗钻石算是我的额外感谢，希望镇的事我会助一臂之力的，那么到时候见。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('106', 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你一走进山洞，还没适应有些黑暗的环境，便看到一把反光的匕首抵在你的身后，而后你做了一个标准的举手动作。\r\n「{o.name}」：你是谁？\r\n「{u.name}」：我是莉莉安派来的，希望镇出了一些事情，需要组建一只「先驱者小队」，希望你能加入。\r\n「{o.name}」沉默了一会：你等会。\r\n只见她抱着一只小黑狗过来，边过来还一边抚摸。\r\n「{o.name}」：我可以跟你走，但我得安顿好小黑，这样吧，你帮我找来一些木头，我给它搭个窝，木头要松木，食物的话，小黑喜欢吃素，自己会出去觅食。\r\n「{u.name}」：行。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('107', 105, NULL, NULL, NULL, NULL, NULL, '45|-20,134|1', NULL, NULL, NULL, '', '', '你将松木交给了「{o.name}」。\r\n一阵时间过去了，一件简易精致的小屋搭成了，小黑看起来很开心，绕着小屋直打转。\r\n「{o.name}」：行了，我再陪一会小黑，我先把我的信物给你，到时候我会出现的。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('108', 106, 'u.random={r.3}', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '测试，请点继续。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('110', 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, 'i37|使用数量|1|5', 0, '', '', '', '', NULL, NULL),
('110', 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.value}>=1&&{u.input.value}<={u.ic.i37}', '', '', '错误！', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('111', 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'test|字段|0|10', 0, NULL, NULL, NULL, NULL, NULL, NULL),
('111', 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你输入的是：{u.input.value}!', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('113', 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37|5', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('105', 112, NULL, 'u.exp=3000', NULL, NULL, NULL, '133|-1,132|-1,134|-1', NULL, NULL, NULL, '', '', '你将km三人的信物递给了莉莉安。\r\n「莉莉安」：还好，他们还是没有见死不救，那么，你便去「KM」的小屋那边和他们汇聚吧，任务我已经和他们通过了，你们去希望镇找凌影开启后面的计划吧！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('114', 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你来到了熟悉的小屋，轻轻推开嘎吱的木门，才发觉KM，赛西，赫米特三人正在火炉旁边的木桌上坐着。\r\n「KM」：来了。\r\n「赛西」：那我们便准备出发吧，此次行动「{u.name}」为「先驱者小队」的队长，那么，我们的第一步动作是?\r\n「{u.name}」：走，出发，去找「凌影」。\r\n「KM」：等一等，这个山谷最近杀人蜂的状态不太对劲，我觉得还是先清理一波然后再过去比较安全，你觉得呢，「{u.name}」?\r\n「{u.name}」：妥。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('115', 114, NULL, 'u.exp=3000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '费了一些功夫，你们总算把大黄蜂群清理掉了一些。\r\n「KM」：「{u.name}」队长，既然已经处理完了，那我们便早些出发吧，去希望镇的路上还要经过一片森林，如果晚上了还是挺危险的，趁天色还早我们早点出发。\r\n众人点了点头。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('116', 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你查看了{o.name}！', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('117', 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们来到了「迷雾森林」前方的峡谷口。\r\n「赫米特」：这边有很多变异的魔物，性情暴躁危险，即使是经验老道的猎人也不敢轻易涉足。\r\n「赛西」：我有一种魔药能驱赶魔物，但需要这些魔物身上对应的一些材料。\r\n「赫米特」：这片森林最多的就是巨齿兔，狂暴野猪和变异棕熊。\r\n「KM」：那么这边「{u.name}」队长你战斗力最高，就交给你了！\r\n「{u.name}」：举手之劳。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('118', 117, NULL, NULL, NULL, NULL, NULL, '139|-3,140|-1,141|-6,142|1', NULL, NULL, NULL, '', '', '你将各种魔物材料递给了「赛西」。\r\n只见「赛西」将材料放在刻满了阵法的地上，接着拿出她的魔杖，朝着地上的材料指着，一道绿光从魔杖顶部射出，笼罩着地上的材料。没过一会，材料和阵法皆消失不见，只剩下一堆深灰色的粉末。\r\n「赛西」：将其带在身上，能避免那三种魔物的攻击。\r\n「KM」：那么事不宜迟，我们赶紧走吧！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('119', 118, NULL, 'u.exp=5000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们走出了「迷雾森林」。\r\n「赫米特」：看来这便是希望镇附近的荒野了，那么，我们去找凌影吧。\r\n「KM」：这一路上倒是没感到什么危险。\r\n「{u.name}」：废话，我之前都被「莉莉安」忽悠来踩过一圈了，我的实力保你们几个轻而易举。\r\n「KM」&amp;「赫米特」&amp;「赛西」：还得是队长👍', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('120', 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, '', '', '你们一行人来到了{u.env.name}。\r\n「凌影」：是旧街的援军吗，听莉莉安说先来了一支小队是吧。\r\n「{u.name}」：我们是「先驱者小队」，我是队长{u.name}，这位是KM，擅长黑客技术，这位是赛西，擅长超自然魔法，这位是赫米特，是一位经验丰富的猎手，后续大部队还在路上。\r\n「凌影」：太好了，这下希望镇的燃眉之急能缓解了。\r\n「{u.name}」：能请问一下到底发生了什么吗?\r\n「凌影」：经过我们的专家研究，附近森林后异兽很有可能发生了二次变异，变得更加暴躁和富有攻击力，原因还未知，不过怀疑有第三方势力插足。\r\n「{u.name}」：看样子是个令人头疼的问题，那么你需要我们做些什么吗?\r\n「凌影」：我们的生物学家需要更多的样本来分析异兽二次变异的原因，所以我们需要大量的异兽材料，其中很大一部分已经被获取分析了，唯独森林深处有几只比较强大的异变兽仍未制服，我希望你们能帮我取来这些异变兽的躯体，分别是：变异蓝蝶后的翅膀，变异杀人峰王的尾针以及变异巨齿虎王的利齿。\r\n「{u.name}」：该干活了各位。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('74', 120, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('108', 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.random}==1', '成功了！', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', NULL, NULL),
('108', 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.random}==0', '失败了', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', NULL, NULL),
('108', 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.random}==2', '没有发生任何事情', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `system_event_self`
--

CREATE TABLE `system_event_self` (
  `belong` varchar(255) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `root_op_id` int(11) NOT NULL,
  `id` int(4) NOT NULL,
  `cond` text NOT NULL,
  `cmmt` text NOT NULL,
  `link_evs` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_event_self`
--

INSERT INTO `system_event_self` (`belong`, `module_id`, `root_op_id`, `id`, `cond`, `cmmt`, `link_evs`, `desc`) VALUES
('31', '1', 0, 1, '', '', '72', '签到\r\n'),
('6', '11', 0, 2, '', '', '2', '用户协议'),
('1', 'map_op', 0, 6, '', '', '6', '无名石碑'),
('2', 'npc_op', 0, 8, '', '', '9', '治疗'),
('2', 'map_op', 0, 9, '({c.time}-{u.pick_lj})>=30', '空空如也。', '10', '垃圾桶'),
('5', 'map_op', 0, 10, '', '', '11', '褶皱的报纸'),
('6', 'map_op', 0, 11, '', '', '12', '路灯'),
('7', 'map_op', 0, 12, '', '', '13', '一半的咖啡杯'),
('8', 'map_op', 0, 13, '', '', '14', '查看封口'),
('1', 'npc_task_accept', 0, 14, '', '', '15', '[留下的证明]的接受'),
('9', 'map_op', 0, 15, '', '', '16,17', '老式台灯'),
('34', '1', 0, 16, '', '', '18,19', 'GM传送\r\n'),
('10', 'map_op', 0, 17, '', '', '20', '进入帐篷'),
('1', 'npc_task_finish', 0, 18, '', '', '22', '[留下的证明]的完成'),
('2', 'npc_task_accept', 0, 19, '', '', '23,24', '[急切的交易]的接受'),
('2', 'npc_task_finish', 0, 20, '', '', '25', '[急切的交易]的完成'),
('3', 'npc_task_accept', 0, 22, '', '', '27', '[莉莉安的书信]的接受'),
('3', 'npc_task_finish', 0, 23, '', '', '', '[莉莉安的书信]的完成'),
('11', 'map_op', 0, 24, '', '', '29,30', '爬出暗道'),
('12', 'map_op', 0, 25, '', '', '31', '断桥'),
('13', 'map_op', 0, 26, '', '', '32', '损坏的通讯机'),
('14', 'map_op', 0, 27, '', '', '33,37', '进入希望镇'),
('15', 'map_op', 0, 28, '', '', '34', '人型雕像'),
('16', 'map_op', 0, 29, '', '', '35', '出门'),
('17', 'map_op', 0, 30, '', '', '36', '打随机不同数个老鼠和泥怪'),
('2', 'game_self_page_tent', 0, 31, '', '', '39', '进入帐篷\r\n'),
('3', 'npc_op', 0, 32, '', '', '40', '和流民对话'),
('18', 'map_op', 0, 33, '', '', '41', 'H-W-003终端'),
('2', 'game_self_page_HW003', 0, 34, '', '', '42', '[阅读水源守则]\r\n'),
('4', 'npc_task_accept', 0, 35, '', '', '43', '[变异的老鼠]的接受'),
('4', 'npc_task_finish', 0, 36, '', '', '45', '[变异的老鼠]的完成'),
('36', 'npc_shop', 0, 37, '', '', '44', '杰德交易'),
('5', 'npc_task_accept', 0, 38, '', '', '46', '[皮格的美味实验]的接受'),
('19', 'map_op', 0, 39, '', '', '47', '查看小水池'),
('4', 'npc_op', 0, 40, '', '', '48', '聆听教诲'),
('6', 'npc_task_accept', 0, 41, '', '', '49', '[迪伦斯的现状]的接受'),
('7', 'npc_task_accept', 0, 42, '', '', '50', '[乌鸦的谜团]的接受'),
('5', 'npc_task_finish', 0, 43, '', '', '53', '[皮格的美味实验]的完成'),
('17', '11', 0, 44, '', '', '51', '账号安全\r\n'),
('12', '11', 0, 45, '', '', '52', '背景故事'),
('20', 'map_op', 0, 46, '{u.ic.i255}>=1', '你尝试着往上爬了几下，结果还没到1/10就滑下来了，可能得用什么工具才能上去。', NULL, '爬上高架'),
('20', 'map_op', 0, 47, '', '', '58', '爬上高架'),
('8', 'npc_task_accept', 0, 48, '', '', '54', '[清剿狼群]的接受'),
('21', 'map_op', 0, 49, '', '', '55,56', '回到暗道'),
('8', 'npc_task_finish', 0, 50, '', '', '57', '[清剿狼群]的完成'),
('22', 'map_op', 0, 51, '', '', '59', '修理断桥'),
('23', 'map_op', 0, 52, '', '', '60,61', '过桥'),
('7', 'npc_task_finish', 0, 53, '', '', '62', '[乌鸦的谜团]的完成'),
('5', 'npc_op', 0, 54, '', '', '63', '领取每日物资'),
('274', 'map_into', 0, 56, '', '', '64', 'GM工作室进入'),
('539', 'map_into', 0, 59, '', '', '65', '灰土路进入'),
('540', 'map_into', 0, 60, '', '', '66,67', '迷雾小径进入'),
('24', 'map_op', 0, 69, '', '', '68', '离开小屋'),
('25', 'map_op', 0, 70, '', '', '69', '离开小屋'),
('26', 'map_op', 0, 71, '', '', '70', '乘坐电梯'),
('2', 'item_use', 0, 72, '', '', '71', '钱袋使用'),
('1', 'skill_use', 0, 73, '', '', NULL, '普通攻击使用'),
('1', 'skill_use', 0, 74, '', '', '120', '普通攻击使用'),
('2', 'game_self_page_test', 0, 75, '', '', '73', '签到\r\n'),
('6', 'npc_op', 0, 76, '', '', '74', '歌尔特的日常悬赏'),
('3', 'game_self_page_bounty_01', 0, 77, '{u.ic.i24}>=10', '「歌尔特」:你并没有这么多「变异利爪」，再去找找吧!', NULL, '提交\r\n'),
('3', 'game_self_page_bounty_01', 0, 78, '', '', '75', '提交\r\n'),
('7', 'npc_op', 0, 79, '', '', '76', '施舍'),
('27', 'map_op', 0, 80, '', '', NULL, '无名墓碑'),
('27', 'map_op', 0, 81, '', '', '77', '无名墓碑'),
('72', 'item_use', 0, 82, '', '', '78', '背包编织工具使用'),
('28', 'map_op', 0, 83, '', '', '79', '乘坐电梯'),
('2', 'game_self_page_HP_lift_1', 0, 84, '', '', '80,81', '选择层数\r\n'),
('29', 'map_op', 0, 85, '', '', '82,83', '敲门'),
('9', 'npc_task_accept', 0, 86, '', '', '84,92', '[希望镇的困境]的接受'),
('30', 'map_op', 0, 87, '', '', '85', '培养液立体药罐'),
('31', 'map_op', 0, 88, '', '', '86', 'E-314发电机终端'),
('32', 'map_op', 0, 89, '', '', '87', '红色珊瑚石礁'),
('33', 'map_op', 0, 90, '', '', '88,89', '跳向古藤条'),
('34', 'map_op', 0, 91, '', '', '90,91', '爬上古藤条'),
('10', 'npc_task_accept', 0, 93, '', '', '93', '[众人拾柴火焰高]的接受'),
('11', 'npc_task_accept', 0, 94, '', '', '94', '[测试多任务目标对象（寻物）]的接受'),
('11', 'npc_task_finish', 0, 95, '', '', '95', '[测试多任务目标对象（寻物）]的完成'),
('11', 'npc_task_accept', 0, 96, '', '', NULL, '[测试任务]的接受'),
('13', 'npc_task_accept', 0, 97, '', '', '96', '[你好啊]的接受'),
('12', '7', 0, 98, '', '', '97', '测试操作\r\n'),
('12', 'npc_task_accept', 0, 99, '', '', '98', '[K-M的爱好]的接受'),
('12', 'npc_task_finish', 0, 100, '', '', '99', '[K-M的爱好]的完成'),
('13', 'npc_task_accept', 0, 101, '', '', '100', '[赛西的梦魇]的接受'),
('35', 'map_op', 0, 102, '', '', '101', '六芒星阵'),
('36', 'map_op', 0, 103, '', '', '102', '粉色五角星阵'),
('13', 'npc_task_finish', 0, 104, '', '', '103', '[赛西的梦魇]的完成'),
('10', 'npc_task_finish', 0, 105, '', '', '112', '[众人拾柴火焰高]的完成'),
('14', 'npc_task_accept', 0, 106, '', '', '104', '[赫米特的烦恼]的接受'),
('14', 'npc_task_finish', 0, 107, '', '', '105', '[赫米特的烦恼]的完成'),
('2', 'game_self_page_vip', 0, 108, '', '', '106,121,122,123', '测试操作\r\n'),
('9', 'npc_task_finish', 0, 109, '', '', NULL, '[希望镇的困境]的完成'),
('11', 'item_use', 0, 110, '', '', '107,108', '旧电路板使用'),
('37', 'map_op', 0, 111, '', '', '109,110', '输入事件测试'),
('38', 'map_op', 0, 112, '', '', NULL, '老鼠群'),
('38', 'map_op', 0, 113, '', '', '111', '老鼠群'),
('15', 'npc_task_accept', 0, 114, '', '', '113', '[前往希望镇.一]的接受'),
('15', 'npc_task_finish', 0, 115, '', '', '114', '[前往希望镇.一]的完成'),
('274', 'map_look', 0, 116, '', '', '115', 'GM工作室查看'),
('16', 'npc_task_accept', 0, 117, '', '', '116', '[前往希望镇.二]的接受'),
('16', 'npc_task_finish', 0, 118, '', '', '117', '[前往希望镇.二]的完成'),
('17', 'npc_task_accept', 0, 119, '', '', '118', '[前往希望镇.三]的接受'),
('18', 'npc_task_accept', 0, 120, '', '', '119', '[希望镇的困境]的接受'),
('17', 'npc_task_finish', 0, 121, '', '', NULL, '[前往希望镇.三]的完成'),
('18', 'npc_win', 0, 123, '', '', NULL, '泥泞元素怪战胜');

-- --------------------------------------------------------

--
-- 表的结构 `system_exp_def`
--

CREATE TABLE `system_exp_def` (
  `pos` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `type` int(1) DEFAULT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_exp_def`
--

INSERT INTO `system_exp_def` (`pos`, `id`, `type`, `value`) VALUES
(1, 'damage', 1, '(({u.lvl}*8+{m.lvl}*6+({m.hurt_mod}*({m.lvl}+12)/6)+{u.gj}*5)-({o.lvl}+2)*5-{r.o.lvl}*2-{o.fy}*4)'),
(4, 'maxexp', 1, '({u.lvl}+1)*({u.lvl}+1)*({u.lvl}+11)+200'),
(5, 'sk_lvl', 1, '((({m.lvl}/3+5)*({m.lvl}+5))*2)'),
(6, 'player_sex', 3, '{eval(v(u.sex)==\"男\"?\"小伙子\":\"小姑娘\")}'),
(7, 'time_name', 3, '{eval(v(c.hour)>=0&&v(c.hour)<2?\"凌晨\":(v(c.hour)>=2&&v(c.hour)<4?\"拂晓\":(v(c.hour)>=4&&v(c.hour)<6?\"黎明\":(v(c.hour)>=6&&v(c.hour)<8 ?\"清晨\":(v(c.hour)>=8&&v(c.hour)<11?\"早上\":(v(c.hour)>=11&&v(c.hour)<13?\"中午\":(v(c.hour)>=13&&v(c.hour)<16?\"下午\":(v(c.hour)>=16&&v(c.hour)<18?\"黄昏\":(v(c.hour)>=18&&v(c.hour)<21?\"晚上\":(v(c.hour)>=21&&v(c.hour)<=23?\"子夜\":\"\"))))))))))}'),
(8, 'weather_text', 3, '{eval(v(c.hour)>=0&&v(c.hour)<2?\"闪电撕裂着天空，雷声隆隆地传来。\":(v(c.hour)>=2&&v(c.hour)<4?\"四周一片寂静，几声犬吠从远处传来。\":(v(c.hour)>=4&&v(c.hour)<6?\"月亮在云中忽隐忽现，四周漆黑一片。\":(v(c.hour)>=6&&v(c.hour)<8 ?\"清新的空气令你心旷神怡。\":(v(c.hour)>=8&&v(c.hour)<11?\"微风轻轻地吹拂在你的脸上。\":(v(c.hour)>=11&&v(c.hour)<13?\"一两声闷雷从远处传来。\":(v(c.hour)>=13&&v(c.hour)<16?\"气温下降了，地上的影子越拉越长。\":(v(c.hour)>=16&&v(c.hour)<18?\"天黑了下来，看得见远方炊烟升起。\":(v(c.hour)>=18&&v(c.hour)<21?\"闪电撕裂着天空，雷声隆隆地传来。\":(v(c.hour)>=21&&v(c.hour)<=23?\"风越刮越大了。\":\"\"))))))))))}'),
(9, 'season_text', 3, '{eval(v(c.month)==1?\"早春\":(v(c.month)==2?\"杏春\":(v(c.month)==3?\"晚春\":(v(c.month)==4?\"孟夏\":(v(c.month)==5?\"仲夏\":(v(c.month)==6?\"伏夏\":(v(c.month)==7?\"早秋\":(v(c.month)==8?\"桂秋\":(v(c.month)==9?\"暮秋\":(v(c.month)==10?\"初冬\":(v(c.month)==11?\"寒冬\":(v(c.month)==12?\"隆冬\":\"\"))))))))))))}'),
(10, 'greeting_text', 3, '{eval(v(c.hour)>4&&v(c.hour)<8?\"早上好，新的一天新的开始！\":(v(c.hour)>7&&v(c.hour)<11?\"上午好，不要因为玩游戏而冷落了朋友！\":(v(c.hour)>10&&v(c.hour)<13?\"中午好，吃饭了吗？\":(v(c.hour)>12&&v(c.hour)<19?\"下午好，工作要加油哦！\":(v(c.hour)>18&&v(c.hour)<=23?\"晚上好，不要忽视了与家人的沟通！\":\"夜已深，注意身体哦！早点休息。\")))))}');

-- --------------------------------------------------------

--
-- 表的结构 `system_fb`
--

CREATE TABLE `system_fb` (
  `fbid` int(11) NOT NULL,
  `fbname` varchar(255) NOT NULL,
  `fbinfo` varchar(255) NOT NULL,
  `fbnpc` varchar(255) NOT NULL,
  `fbmonster` varchar(255) NOT NULL,
  `fbitem` varchar(255) NOT NULL,
  `fbevents` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_fb`
--

INSERT INTO `system_fb` (`fbid`, `fbname`, `fbinfo`, `fbnpc`, `fbmonster`, `fbitem`, `fbevents`) VALUES
(1, '测试副本', '测试。', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `system_fight_quick`
--

CREATE TABLE `system_fight_quick` (
  `sid` text NOT NULL,
  `quick_value` text NOT NULL COMMENT '格式：type_id|id',
  `quick_pos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_fight_quick`
--

INSERT INTO `system_fight_quick` (`sid`, `quick_value`, `quick_pos`) VALUES
('7c936037baabb3f953d1247ac57fd33d', '1|1', 1),
('7c936037baabb3f953d1247ac57fd33d', '2|1', 2),
('7c936037baabb3f953d1247ac57fd33d', '2|73', 3),
('7c936037baabb3f953d1247ac57fd33d', '', 4),
('7c936037baabb3f953d1247ac57fd33d', '', 5),
('7c936037baabb3f953d1247ac57fd33d', '', 6),
('7c936037baabb3f953d1247ac57fd33d', '', 7),
('2be824d1d1eaf47b51176faf90a5b8c9', '1|1', 1),
('2be824d1d1eaf47b51176faf90a5b8c9', '2|1', 2),
('2be824d1d1eaf47b51176faf90a5b8c9', '2|73', 3),
('2be824d1d1eaf47b51176faf90a5b8c9', '', 4),
('2be824d1d1eaf47b51176faf90a5b8c9', '', 5),
('2be824d1d1eaf47b51176faf90a5b8c9', '', 6),
('2be824d1d1eaf47b51176faf90a5b8c9', '', 7),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '1|1', 1),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '2|1', 2),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '2|73', 3),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '', 4),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '', 5),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '', 6),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '', 7),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '1|1', 1),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '2|1', 2),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '2|73', 3),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '', 4),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '', 5),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '', 6),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '', 7),
('8e47713211e401e3719ae2860624ea1d', '1|1', 1),
('8e47713211e401e3719ae2860624ea1d', '2|1', 2),
('8e47713211e401e3719ae2860624ea1d', '2|73', 3),
('8e47713211e401e3719ae2860624ea1d', '', 4),
('8e47713211e401e3719ae2860624ea1d', '', 5),
('8e47713211e401e3719ae2860624ea1d', '', 6),
('8e47713211e401e3719ae2860624ea1d', '', 7),
('3d8568eba8ad03799b060cac7f1c3661', '1|1', 1),
('3d8568eba8ad03799b060cac7f1c3661', '2|1', 2),
('3d8568eba8ad03799b060cac7f1c3661', '2|73', 3),
('3d8568eba8ad03799b060cac7f1c3661', '', 4),
('3d8568eba8ad03799b060cac7f1c3661', '', 5),
('3d8568eba8ad03799b060cac7f1c3661', '', 6),
('3d8568eba8ad03799b060cac7f1c3661', '', 7),
('41400d200be5d46bc95b8573768c3409', '1|1', 1),
('41400d200be5d46bc95b8573768c3409', '2|1', 2),
('41400d200be5d46bc95b8573768c3409', '2|73', 3),
('41400d200be5d46bc95b8573768c3409', '', 4),
('41400d200be5d46bc95b8573768c3409', '', 5),
('41400d200be5d46bc95b8573768c3409', '', 6),
('41400d200be5d46bc95b8573768c3409', '', 7),
('b602cfc31a3e2d6e05a63629d10ab245', '1|1', 1),
('b602cfc31a3e2d6e05a63629d10ab245', '2|1', 2),
('b602cfc31a3e2d6e05a63629d10ab245', '2|73', 3),
('b602cfc31a3e2d6e05a63629d10ab245', '', 4),
('b602cfc31a3e2d6e05a63629d10ab245', '', 5),
('b602cfc31a3e2d6e05a63629d10ab245', '', 6),
('b602cfc31a3e2d6e05a63629d10ab245', '', 7),
('1c9dac0bc157445e9825e43681ef8d05', '1|1', 1),
('1c9dac0bc157445e9825e43681ef8d05', '2|1', 2),
('1c9dac0bc157445e9825e43681ef8d05', '2|73', 3),
('1c9dac0bc157445e9825e43681ef8d05', '', 4),
('1c9dac0bc157445e9825e43681ef8d05', '', 5),
('1c9dac0bc157445e9825e43681ef8d05', '', 6),
('1c9dac0bc157445e9825e43681ef8d05', '', 7),
('01a110059f80eaa13a42841f56fcb21a', '1|1', 1),
('01a110059f80eaa13a42841f56fcb21a', '2|1', 2),
('01a110059f80eaa13a42841f56fcb21a', '2|73', 3),
('01a110059f80eaa13a42841f56fcb21a', '', 4),
('01a110059f80eaa13a42841f56fcb21a', '', 5),
('01a110059f80eaa13a42841f56fcb21a', '', 6),
('01a110059f80eaa13a42841f56fcb21a', '', 7),
('05db3f20ee644be4cd30002f6503b8d9', '1|1', 1),
('05db3f20ee644be4cd30002f6503b8d9', '2|1', 2),
('05db3f20ee644be4cd30002f6503b8d9', '2|73', 3),
('05db3f20ee644be4cd30002f6503b8d9', '', 4),
('05db3f20ee644be4cd30002f6503b8d9', '', 5),
('05db3f20ee644be4cd30002f6503b8d9', '', 6),
('05db3f20ee644be4cd30002f6503b8d9', '', 7),
('bf4f95ce8a8132fe94fd09ed9776c248', '1|1', 1),
('bf4f95ce8a8132fe94fd09ed9776c248', '2|1', 2),
('bf4f95ce8a8132fe94fd09ed9776c248', '2|73', 3),
('bf4f95ce8a8132fe94fd09ed9776c248', '', 4),
('bf4f95ce8a8132fe94fd09ed9776c248', '', 5),
('bf4f95ce8a8132fe94fd09ed9776c248', '', 6),
('bf4f95ce8a8132fe94fd09ed9776c248', '', 7),
('959c9277a3e15eacff9e5f117e51f5bb', '1|1', 1),
('959c9277a3e15eacff9e5f117e51f5bb', '2|1', 2),
('959c9277a3e15eacff9e5f117e51f5bb', '2|73', 3),
('959c9277a3e15eacff9e5f117e51f5bb', '', 4),
('959c9277a3e15eacff9e5f117e51f5bb', '', 5),
('959c9277a3e15eacff9e5f117e51f5bb', '', 6),
('959c9277a3e15eacff9e5f117e51f5bb', '', 7),
('68dcd3cd66a76b81cfc90c0e147617d4', '1|1', 1),
('68dcd3cd66a76b81cfc90c0e147617d4', '2|1', 2),
('68dcd3cd66a76b81cfc90c0e147617d4', '2|73', 3),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 4),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 5),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 6),
('68dcd3cd66a76b81cfc90c0e147617d4', '', 7),
('0277b7c43250e3bda5d7fb423ce14d92', '1|1', 1),
('0277b7c43250e3bda5d7fb423ce14d92', '2|1', 2),
('0277b7c43250e3bda5d7fb423ce14d92', '2|73', 3),
('0277b7c43250e3bda5d7fb423ce14d92', '', 4),
('0277b7c43250e3bda5d7fb423ce14d92', '', 5),
('0277b7c43250e3bda5d7fb423ce14d92', '', 6),
('0277b7c43250e3bda5d7fb423ce14d92', '', 7),
('c618319c00c8a0ddfc15fefbe3f4f898', '1|1', 1),
('c618319c00c8a0ddfc15fefbe3f4f898', '2|1', 2),
('c618319c00c8a0ddfc15fefbe3f4f898', '2|73', 3),
('c618319c00c8a0ddfc15fefbe3f4f898', '', 4),
('c618319c00c8a0ddfc15fefbe3f4f898', '', 5),
('c618319c00c8a0ddfc15fefbe3f4f898', '', 6),
('c618319c00c8a0ddfc15fefbe3f4f898', '', 7),
('214658c4375c343e280ae38e880ac4ba', '1|1', 1),
('214658c4375c343e280ae38e880ac4ba', '2|1', 2),
('214658c4375c343e280ae38e880ac4ba', '2|73', 3),
('214658c4375c343e280ae38e880ac4ba', '', 4),
('214658c4375c343e280ae38e880ac4ba', '', 5),
('214658c4375c343e280ae38e880ac4ba', '', 6),
('214658c4375c343e280ae38e880ac4ba', '', 7),
('a8c7b0c51c60be7441214c0b0c671d88', '1|1', 1),
('a8c7b0c51c60be7441214c0b0c671d88', '2|1', 2),
('a8c7b0c51c60be7441214c0b0c671d88', '2|73', 3),
('a8c7b0c51c60be7441214c0b0c671d88', '', 4),
('a8c7b0c51c60be7441214c0b0c671d88', '', 5),
('a8c7b0c51c60be7441214c0b0c671d88', '', 6),
('a8c7b0c51c60be7441214c0b0c671d88', '', 7),
('01a0d4f5e64a677721a1089d4914bc6a', '1|1', 1),
('01a0d4f5e64a677721a1089d4914bc6a', '2|1', 2),
('01a0d4f5e64a677721a1089d4914bc6a', '2|73', 3),
('01a0d4f5e64a677721a1089d4914bc6a', '', 4),
('01a0d4f5e64a677721a1089d4914bc6a', '', 5),
('01a0d4f5e64a677721a1089d4914bc6a', '', 6),
('01a0d4f5e64a677721a1089d4914bc6a', '', 7),
('79462faa70c368423c7f9fb106fa1f47', '1|1', 1),
('79462faa70c368423c7f9fb106fa1f47', '2|1', 2),
('79462faa70c368423c7f9fb106fa1f47', '2|73', 3),
('79462faa70c368423c7f9fb106fa1f47', '', 4),
('79462faa70c368423c7f9fb106fa1f47', '', 5),
('79462faa70c368423c7f9fb106fa1f47', '', 6),
('79462faa70c368423c7f9fb106fa1f47', '', 7),
('945fd26d30e007abfed414cc1f2795f5', '1|1', 1),
('945fd26d30e007abfed414cc1f2795f5', '2|1', 2),
('945fd26d30e007abfed414cc1f2795f5', '2|73', 3),
('945fd26d30e007abfed414cc1f2795f5', '', 4),
('945fd26d30e007abfed414cc1f2795f5', '', 5),
('945fd26d30e007abfed414cc1f2795f5', '', 6),
('945fd26d30e007abfed414cc1f2795f5', '', 7),
('f55913444ef985484baf7580c60f15ce', '1|1', 1),
('f55913444ef985484baf7580c60f15ce', '2|1', 2),
('f55913444ef985484baf7580c60f15ce', '2|73', 3),
('f55913444ef985484baf7580c60f15ce', '', 4),
('f55913444ef985484baf7580c60f15ce', '', 5),
('f55913444ef985484baf7580c60f15ce', '', 6),
('f55913444ef985484baf7580c60f15ce', '', 7),
('fe3319b6dd10f68aaa36ee852cd79cc1', '1|1', 1),
('fe3319b6dd10f68aaa36ee852cd79cc1', '2|1', 2),
('fe3319b6dd10f68aaa36ee852cd79cc1', '2|73', 3),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 4),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 5),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 6),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 7),
('01acd0637eb2b6a6a3055e4fc37e8457', '1|1', 1),
('01acd0637eb2b6a6a3055e4fc37e8457', '2|1', 2),
('01acd0637eb2b6a6a3055e4fc37e8457', '2|73', 3),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 4),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 5),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 6),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 7),
('2f4746d4d36396302d36e51c969d3e68', '1|1', 1),
('2f4746d4d36396302d36e51c969d3e68', '2|1', 2),
('2f4746d4d36396302d36e51c969d3e68', '2|73', 3),
('2f4746d4d36396302d36e51c969d3e68', '', 4),
('2f4746d4d36396302d36e51c969d3e68', '', 5),
('2f4746d4d36396302d36e51c969d3e68', '', 6),
('2f4746d4d36396302d36e51c969d3e68', '', 7),
('e3130d019f7689f5501bc3633f97eb88', '1|1', 1),
('e3130d019f7689f5501bc3633f97eb88', '2|1', 2),
('e3130d019f7689f5501bc3633f97eb88', '2|73', 3),
('e3130d019f7689f5501bc3633f97eb88', '', 4),
('e3130d019f7689f5501bc3633f97eb88', '', 5),
('e3130d019f7689f5501bc3633f97eb88', '', 6),
('e3130d019f7689f5501bc3633f97eb88', '', 7),
('76623f3a68872fa88502af535498a991', '1|1', 1),
('76623f3a68872fa88502af535498a991', '2|1', 2),
('76623f3a68872fa88502af535498a991', '2|73', 3),
('76623f3a68872fa88502af535498a991', '', 4),
('76623f3a68872fa88502af535498a991', '', 5),
('76623f3a68872fa88502af535498a991', '', 6),
('76623f3a68872fa88502af535498a991', '', 7),
('f244e629c0bc88068f2ecd6baf212683', '1|1', 1),
('f244e629c0bc88068f2ecd6baf212683', '2|1', 2),
('f244e629c0bc88068f2ecd6baf212683', '2|73', 3),
('f244e629c0bc88068f2ecd6baf212683', '', 4),
('f244e629c0bc88068f2ecd6baf212683', '', 5),
('f244e629c0bc88068f2ecd6baf212683', '', 6),
('f244e629c0bc88068f2ecd6baf212683', '', 7),
('f4cd01caaf9ec17c03413de91b97b5f2', '1|1', 1),
('f4cd01caaf9ec17c03413de91b97b5f2', '2|1', 2),
('f4cd01caaf9ec17c03413de91b97b5f2', '2|73', 3),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 4),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 5),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 6),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 7),
('344773e829d514e37d748e906a4f020a', '1|1', 1),
('344773e829d514e37d748e906a4f020a', '2|1', 2),
('344773e829d514e37d748e906a4f020a', '', 3),
('344773e829d514e37d748e906a4f020a', '', 4),
('344773e829d514e37d748e906a4f020a', '', 5),
('344773e829d514e37d748e906a4f020a', '', 6),
('344773e829d514e37d748e906a4f020a', '', 7),
('6b5913cfa12674939ee93c59e0bb7254', '1|1', 1),
('6b5913cfa12674939ee93c59e0bb7254', '2|1', 2),
('6b5913cfa12674939ee93c59e0bb7254', '', 3),
('6b5913cfa12674939ee93c59e0bb7254', '', 4),
('6b5913cfa12674939ee93c59e0bb7254', '', 5),
('6b5913cfa12674939ee93c59e0bb7254', '', 6),
('6b5913cfa12674939ee93c59e0bb7254', '', 7),
('976f6bbeda6b3bca384d8842e569f05e', '1|1', 1),
('976f6bbeda6b3bca384d8842e569f05e', '2|1', 2),
('976f6bbeda6b3bca384d8842e569f05e', '', 3),
('976f6bbeda6b3bca384d8842e569f05e', '', 4),
('976f6bbeda6b3bca384d8842e569f05e', '', 5),
('976f6bbeda6b3bca384d8842e569f05e', '', 6),
('976f6bbeda6b3bca384d8842e569f05e', '', 7),
('98c50608a11ec800fba8b2d0b7294aeb', '1|1', 1),
('98c50608a11ec800fba8b2d0b7294aeb', '2|1', 2),
('98c50608a11ec800fba8b2d0b7294aeb', '', 3),
('98c50608a11ec800fba8b2d0b7294aeb', '', 4),
('98c50608a11ec800fba8b2d0b7294aeb', '', 5),
('98c50608a11ec800fba8b2d0b7294aeb', '', 6),
('98c50608a11ec800fba8b2d0b7294aeb', '', 7),
('269d6f1d2272bf0f3af7633340052a03', '1|1', 1),
('269d6f1d2272bf0f3af7633340052a03', '2|1', 2),
('269d6f1d2272bf0f3af7633340052a03', '', 3),
('269d6f1d2272bf0f3af7633340052a03', '', 4),
('269d6f1d2272bf0f3af7633340052a03', '', 5),
('269d6f1d2272bf0f3af7633340052a03', '', 6),
('269d6f1d2272bf0f3af7633340052a03', '', 7);

-- --------------------------------------------------------

--
-- 表的结构 `system_function`
--

CREATE TABLE `system_function` (
  `belong` varchar(255) NOT NULL,
  `id` int(2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link_function` varchar(255) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_function`
--

INSERT INTO `system_function` (`belong`, `id`, `name`, `link_function`, `default_value`) VALUES
('1', 1, '刷新', '1', '刷新'),
('1', 2, '附近玩家', '2', '附近玩家'),
('1', 3, 'npc', '3', 'npc'),
('1', 4, '地上物品', '4', '地上物品'),
('1', 5, '聊天信息', '5', '聊天信息'),
('1,2,3,4,5,6,8', 6, '操作列表', '6', '操作列表'),
('1', 7, '东向出口', '7', '东向出口'),
('1', 8, '南向出口', '8', '南向出口'),
('1', 9, '西向出口', '9', '西向出口'),
('1', 10, '北向出口', '10', '北向出口'),
('1,9', 11, '查看地图', '11', '查看地图'),
('1,2,3,4,5,6,7,8,9,10,11,12,13', 12, '游戏首页', '12', '游戏首页'),
('1,9', 13, '报时', '13', '报时'),
('1,6,9,10', 14, '状态', '14', '状态'),
('1,6,7,9', 15, '技能', '15', '技能'),
('1,7,9,10', 16, '装备', '16', '装备'),
('1,6,7,9,10', 17, '物品', '17', '物品'),
('1,7,9', 18, '帮派', '18', '帮派'),
('1,7,9', 19, '组队', '19', '组队'),
('1,7,9', 20, '宠物', '20', '宠物'),
('1,7,9', 21, '任务', '21', '任务'),
('1,7,9', 22, '好友', '22', '好友'),
('1,7,9', 23, '黑名单', '23', '黑名单'),
('1,7,9,10', 24, '聊天', '24', '聊天'),
('7', 25, '修改名字性别', '25', '修改名字性别'),
('7', 26, '修改个性签名', '26', '修改个性签名'),
('7', 27, '上传形象照', '27', '上传形象照'),
('1', 28, '功能', '28', '功能'),
('1,7,9,10', 29, '快捷键设置', '29', '快捷键设置'),
('9', 30, '显示设置', '30', '显示设置'),
('1,9', 31, '帮派列表', '31', '帮派列表'),
('1,9', 32, '拍卖行', '32', '拍卖行'),
('1,9', 33, '排行榜', '33', '排行榜'),
('1,9', 34, '在线玩家', '34', '在线玩家'),
('9', 35, '存储数据', '35', '存储数据'),
('9', 36, '退出登录', '36', '退出登录'),
('5', 37, '对方帮派', '37', '对方帮派'),
('5', 38, '发送消息', '38', '发送消息'),
('5', 39, '购买物品', '39', '购买物品'),
('5', 40, '购买宠物', '40', '购买宠物'),
('5', 41, '赠送物品', '41', '赠送物品'),
('5', 42, '赠送银两', '42', '赠送银两'),
('5', 43, '邀请组队', '43', '邀请组队'),
('5', 44, '邀请比武', '44', '邀请比武'),
('5', 45, '加为好友', '45', '加为好友'),
('5', 46, '加为黑名单', '46', '加为黑名单'),
('5', 47, '攻击玩家', '47', '攻击玩家'),
('1,5,9', 48, '货架宠物列表', '48', '货架宠物列表'),
('1,5,9', 49, '货架物品列表', '49', '货架物品列表'),
('10', 50, '快捷键1', '50', '快捷键1'),
('10', 51, '快捷键2', '51', '快捷键2'),
('10', 52, '快捷键3', '52', '快捷键3'),
('10', 53, '快捷键4', '53', '快捷键4'),
('10', 54, '快捷键5', '54', '快捷键5'),
('10', 55, '快捷键6', '55', '快捷键6'),
('10', 56, '快捷键7', '56', '快捷键7'),
('10', 57, '快捷键8(宠物)', '57', '快捷键8(宠物)'),
('10', 58, '快捷键9(宠物)', '58', '快捷键9(宠物)'),
('10', 59, '自己状态', '59', '自己状态'),
('10', 60, '敌人状态', '60', '敌人状态'),
('10', 61, '自己攻击描述', '61', '自己攻击描述'),
('10', 62, '敌人攻击描述', '62', '敌人攻击描述'),
('10', 63, '逃跑', '63', '逃跑'),
('1,11', 64, '设计游戏', '64', '设计游戏'),
('11', 65, '进入游戏', '65', '进入游戏'),
('11', 66, '游戏论坛', '66', '游戏论坛'),
('11', 67, '申诉', '67', '申诉'),
('1,9', 68, '擂台', '68', '擂台'),
('9', 69, '手机号码', '69', '手机号码'),
('1', 70, '抽奖', '70', '抽奖'),
('10', 71, '开启自动战斗', '71', '开启自动战斗'),
('10', 72, '关闭自动战斗', '72', '关闭自动战斗'),
('10', 73, '查看', '73', '查看'),
('1', 74, '出航', '74', '出航'),
('1', 75, '传送', '75', '传送'),
('1', 76, '采集资源', '76', '采集资源'),
('2', 77, '镶嵌装备', '77', '镶嵌装备'),
('6', 78, '装备核心列表', '78', '装备核心列表');

-- --------------------------------------------------------

--
-- 表的结构 `system_item`
--

CREATE TABLE `system_item` (
  `item_true_id` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `uid` int(10) NOT NULL,
  `iid` int(11) NOT NULL,
  `icount` int(11) NOT NULL,
  `ibind` int(11) NOT NULL COMMENT '0为未绑定，1为绑定。',
  `iequiped` int(11) NOT NULL COMMENT '0为未装备，1为装备',
  `isale_state` int(1) NOT NULL COMMENT '0为未销售，1未销售中',
  `isale_price` int(11) NOT NULL COMMENT '销售价格',
  `icreate_sale_time` datetime NOT NULL COMMENT '创建销售的时间',
  `iexpire_sale_time` datetime NOT NULL COMMENT '过期时间',
  `isale_time` int(11) NOT NULL COMMENT '设定销售时长，单位：小时',
  `iroot` varchar(255) NOT NULL COMMENT '物品来源格式：类别|id，类别0代表未知，1代表怪物掉落，2代表玩家打造，3代表任务赠送，4代表其它',
  `img_add` int(11) NOT NULL DEFAULT '0',
  `iwg_fj` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_item`
--

INSERT INTO `system_item` (`item_true_id`, `sid`, `uid`, `iid`, `icount`, `ibind`, `iequiped`, `isale_state`, `isale_price`, `icreate_sale_time`, `iexpire_sale_time`, `isale_time`, `iroot`, `img_add`, `iwg_fj`) VALUES
(93, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 10, 23, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(10, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 10, 40, 4, 0, 0, 1, 15, '2023-12-03 18:35:30', '2023-12-04 18:35:30', 24, '', 0, 0),
(48, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 22, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(64, '41400d200be5d46bc95b8573768c3409', 0, 1, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(77, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 10, 23, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(46, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 6, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(54, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 30, 6, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|57', 0, 0),
(47, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 21, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(78, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 8, 14, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(73, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 18, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(50, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 7, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(63, '41400d200be5d46bc95b8573768c3409', 0, 2, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(65, 'b602cfc31a3e2d6e05a63629d10ab245', 0, 1, 8, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(69, 'b602cfc31a3e2d6e05a63629d10ab245', 0, 27, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(72, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 1, 31, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(70, 'b602cfc31a3e2d6e05a63629d10ab245', 15, 24, 6, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0),
(71, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 20, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(74, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 11, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(75, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 20, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(79, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 9, 11, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(84, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 39, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(81, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 23, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(82, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 40, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(83, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 37, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|58', 0, 0),
(85, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 16, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(86, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 45, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(87, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 25, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(88, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 4, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(89, '1c9dac0bc157445e9825e43681ef8d05', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(97, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 52, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(94, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 23, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(103, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 10, 25, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(98, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 39, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(99, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 40, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(100, '2be824d1d1eaf47b51176faf90a5b8c9', 0, 2, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(102, '2be824d1d1eaf47b51176faf90a5b8c9', 0, 1, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(104, 'b602cfc31a3e2d6e05a63629d10ab245', 15, 25, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(105, '01a110059f80eaa13a42841f56fcb21a', 17, 25, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(107, '01a110059f80eaa13a42841f56fcb21a', 17, 5, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(109, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 0, 1, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(155, '959c9277a3e15eacff9e5f117e51f5bb', 1, 27, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(114, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(115, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', '2024-07-05 22:44:38', 0, '', 0, 0),
(116, '959c9277a3e15eacff9e5f117e51f5bb', 1, 21, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(117, '959c9277a3e15eacff9e5f117e51f5bb', 1, 22, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', '2024-07-06 13:53:25', 0, '', 0, 0),
(264, '959c9277a3e15eacff9e5f117e51f5bb', 0, 142, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(146, '959c9277a3e15eacff9e5f117e51f5bb', 1, 23, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(162, '214658c4375c343e280ae38e880ac4ba', 4, 4, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(128, '68dcd3cd66a76b81cfc90c0e147617d4', 2, 39, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(247, '959c9277a3e15eacff9e5f117e51f5bb', 1, 21, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(185, '959c9277a3e15eacff9e5f117e51f5bb', 0, 18, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(147, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 9, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(159, '959c9277a3e15eacff9e5f117e51f5bb', 1, 30, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|57', 0, 0),
(279, '959c9277a3e15eacff9e5f117e51f5bb', 0, 2, 7, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(145, '959c9277a3e15eacff9e5f117e51f5bb', 0, 9, 6, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(151, '959c9277a3e15eacff9e5f117e51f5bb', 1, 8, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(153, '0277b7c43250e3bda5d7fb423ce14d92', 0, 1, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(163, '214658c4375c343e280ae38e880ac4ba', 0, 1, 23, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(165, '214658c4375c343e280ae38e880ac4ba', 0, 27, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(166, 'a8c7b0c51c60be7441214c0b0c671d88', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(168, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 27, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '2024-07-05 22:43:15', 0, '', 0, 0),
(176, '959c9277a3e15eacff9e5f117e51f5bb', 1, 45, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(262, '959c9277a3e15eacff9e5f117e51f5bb', 1, 139, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|64', 0, 0),
(265, '98c50608a11ec800fba8b2d0b7294aeb', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(182, '959c9277a3e15eacff9e5f117e51f5bb', 0, 6, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '2024-07-06 14:08:20', 0, '', 0, 0),
(195, '01a0d4f5e64a677721a1089d4914bc6a', 0, 1, 13, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(186, '959c9277a3e15eacff9e5f117e51f5bb', 0, 11, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(196, '01a0d4f5e64a677721a1089d4914bc6a', 6, 4, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(197, '01a0d4f5e64a677721a1089d4914bc6a', 0, 9, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(198, '79462faa70c368423c7f9fb106fa1f47', 7, 4, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(199, '79462faa70c368423c7f9fb106fa1f47', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(203, '945fd26d30e007abfed414cc1f2795f5', 0, 1, 7, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(201, '945fd26d30e007abfed414cc1f2795f5', 8, 4, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(204, '945fd26d30e007abfed414cc1f2795f5', 0, 27, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(205, '945fd26d30e007abfed414cc1f2795f5', 8, 25, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(206, 'f55913444ef985484baf7580c60f15ce', 0, 1, 18, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(208, 'f55913444ef985484baf7580c60f15ce', 0, 27, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(209, 'f55913444ef985484baf7580c60f15ce', 9, 5, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(210, 'f55913444ef985484baf7580c60f15ce', 9, 7, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(211, 'f55913444ef985484baf7580c60f15ce', 9, 21, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(212, 'f55913444ef985484baf7580c60f15ce', 9, 22, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(213, 'f55913444ef985484baf7580c60f15ce', 9, 71, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(214, 'f55913444ef985484baf7580c60f15ce', 9, 24, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0),
(216, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 4, 5, 0, 0, 1, 1, '2024-06-07 02:04:36', '2024-06-09 02:04:36', 48, '', 0, 0),
(217, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 10, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(218, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 45, 11, 0, 0, 0, 0, '0000-00-00 00:00:00', '2024-06-06 23:52:13', 0, '', 0, 0),
(219, '01acd0637eb2b6a6a3055e4fc37e8457', 0, 1, 11, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(220, '01acd0637eb2b6a6a3055e4fc37e8457', 11, 4, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(221, '01acd0637eb2b6a6a3055e4fc37e8457', 11, 10, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(222, '945fd26d30e007abfed414cc1f2795f5', 8, 5, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(223, '945fd26d30e007abfed414cc1f2795f5', 8, 7, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(224, '945fd26d30e007abfed414cc1f2795f5', 8, 21, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(225, '945fd26d30e007abfed414cc1f2795f5', 8, 22, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(226, '945fd26d30e007abfed414cc1f2795f5', 8, 71, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(230, '214658c4375c343e280ae38e880ac4ba', 4, 25, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(228, '945fd26d30e007abfed414cc1f2795f5', 0, 6, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(229, '945fd26d30e007abfed414cc1f2795f5', 8, 29, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|51', 0, 0),
(231, '2f4746d4d36396302d36e51c969d3e68', 12, 4, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(232, '2f4746d4d36396302d36e51c969d3e68', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(233, 'fe3319b6dd10f68aaa36ee852cd79cc1', 0, 1, 6, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(282, '959c9277a3e15eacff9e5f117e51f5bb', 1, 24, 44, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0),
(239, '76623f3a68872fa88502af535498a991', 14, 4, 8, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(240, '76623f3a68872fa88502af535498a991', 14, 8, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(241, '76623f3a68872fa88502af535498a991', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(242, 'f4cd01caaf9ec17c03413de91b97b5f2', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(243, 'f4cd01caaf9ec17c03413de91b97b5f2', 16, 4, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(246, '68dcd3cd66a76b81cfc90c0e147617d4', 2, 5, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(266, '98c50608a11ec800fba8b2d0b7294aeb', 20, 4, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(257, '959c9277a3e15eacff9e5f117e51f5bb', 1, 15, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(269, '959c9277a3e15eacff9e5f117e51f5bb', 1, 25, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0),
(250, '344773e829d514e37d748e906a4f020a', 0, 1, 13, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(251, '344773e829d514e37d748e906a4f020a', 17, 4, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(252, '344773e829d514e37d748e906a4f020a', 0, 9, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(290, '68dcd3cd66a76b81cfc90c0e147617d4', 2, 24, 7, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0),
(260, '959c9277a3e15eacff9e5f117e51f5bb', 0, 95, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(267, '98c50608a11ec800fba8b2d0b7294aeb', 0, 9, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(271, '959c9277a3e15eacff9e5f117e51f5bb', 1, 76, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(289, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 1, 12, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(283, '269d6f1d2272bf0f3af7633340052a03', 0, 1, 10, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(284, '269d6f1d2272bf0f3af7633340052a03', 0, 9, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(285, '269d6f1d2272bf0f3af7633340052a03', 21, 4, 2, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(286, '269d6f1d2272bf0f3af7633340052a03', 21, 10, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(287, '269d6f1d2272bf0f3af7633340052a03', 21, 16, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(291, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 6, 1, 0, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(292, '68dcd3cd66a76b81cfc90c0e147617d4', 2, 29, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|51', 0, 0),
(293, '959c9277a3e15eacff9e5f117e51f5bb', 0, 1, 8, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0),
(294, '959c9277a3e15eacff9e5f117e51f5bb', 1, 39, 1, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_item_module`
--

CREATE TABLE `system_item_module` (
  `iid` int(11) NOT NULL,
  `iarea_name` varchar(255) NOT NULL,
  `iarea_id` int(11) NOT NULL DEFAULT '0',
  `iname` varchar(255) NOT NULL DEFAULT '',
  `iimage` varchar(255) NOT NULL DEFAULT '',
  `idesc` varchar(255) NOT NULL DEFAULT '',
  `idetail_desc` text NOT NULL COMMENT '//书籍分类专用',
  `itype` varchar(255) NOT NULL DEFAULT '0',
  `isubtype` varchar(255) NOT NULL DEFAULT '1',
  `iweight` int(11) NOT NULL DEFAULT '0',
  `iprice` int(11) NOT NULL DEFAULT '0',
  `ino_give` tinyint(1) NOT NULL DEFAULT '0',
  `ino_out` tinyint(1) NOT NULL DEFAULT '0',
  `iop_target` varchar(255) NOT NULL,
  `itask_target` varchar(255) NOT NULL,
  `icreat_event_id` int(11) NOT NULL,
  `ilook_event_id` int(11) NOT NULL,
  `iuse_event_id` int(11) NOT NULL,
  `iminute_event_id` int(11) NOT NULL,
  `iuse_attr` varchar(255) NOT NULL COMMENT '使用目标',
  `iuse_value` varchar(255) NOT NULL COMMENT '使用效果值',
  `iattack_value` varchar(255) NOT NULL COMMENT '兵器，兵器镶物攻击力',
  `irecovery_value` varchar(255) NOT NULL COMMENT '防具，防具镶物防御力',
  `iembed_count` varchar(255) NOT NULL COMMENT '可镶宝数',
  `iequip_cond` varchar(255) NOT NULL COMMENT '装备条件表达式',
  `img_add` int(11) NOT NULL,
  `iwg_fj` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_item_module`
--

INSERT INTO `system_item_module` (`iid`, `iarea_name`, `iarea_id`, `iname`, `iimage`, `idesc`, `idetail_desc`, `itype`, `isubtype`, `iweight`, `iprice`, `ino_give`, `ino_out`, `iop_target`, `itask_target`, `icreat_event_id`, `ilook_event_id`, `iuse_event_id`, `iminute_event_id`, `iuse_attr`, `iuse_value`, `iattack_value`, `irecovery_value`, `iembed_count`, `iequip_cond`, `img_add`, `iwg_fj`) VALUES
(2, '旧街', 1, '钱袋', '', '一袋用废弃塑料袋子装起来的钱币，拎起来叮当响。', '', '其它', '钱袋', 1, 11, 0, 0, '', '', 0, 0, 72, 0, 'money', '10', '', '', '', '', 0, 0),
(3, '未分区', 0, '灰烬', '', '一小堆燃烧后的灰烬，暗灰色，是增肥的好东西。', '', '其它', '杂物', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(4, '未分区', 0, '垃圾', '', '散发着难闻的味道。', '', '其它', '废物', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(5, '旧街', 1, '@6a5353@生锈的铁剑@end@', '剑|sword_0001', '锈迹斑斑的样子，估计拿来砍肉都费劲。', '', '兵器', '1', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '10', '', '1', '', 10, 1),
(6, '未分区', 0, '粗糙的匕首', '刀|knife_0001', '勉强能砍得动东西的一把匕首，狩猎时有用。', '', '兵器', '2', 1, 20, 0, 0, '', '', 0, 0, 0, 0, '', '', '11', '', '2', '', 0, 0),
(7, '未分区', 0, '草帽', '', '用杂草编织成的圆形帽子，实在是说不上美观。', '', '防具', '4', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'exp', '', '', '1', '', '', 0, 0),
(19, '未分区', 0, 'P-01手枪', '', '最原始的手枪型号，单发伤害稳定射速一般，不是一般人能拥有的。', '', '兵器', '3', 1, 2000, 0, 0, '', '', 0, 0, 0, 0, '', '', '60', '', '', '', 0, 0),
(8, '未分区', 0, '生锈的铁片', '', '这是一块生锈的铁片，锈迹斑斑的模样诉说着它的历史。', '', '其它', '材料', 1, 2, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(9, '未分区', 0, '废弃塑料', '', '塑料曾是人类最伟大的发明，是的，曾是。', '', '其它', '材料', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(10, '未分区', 0, '@587934@小树枝@end@', '', '一根树枝，不知道可以有什么用途。', '', '其它', '材料', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(11, '未分区', 0, '旧电路板', '', '这块有些老旧的电路板似乎是从什么电器上被拆解下来的。', '', '其它', '材料', 1, 30, 0, 0, '', '', 0, 0, 110, 0, '', '', '', '', '', '', 0, 0),
(1, '旧街', 1, '@e22400@金疮药@end@', '', '古籍中记载的很基础的草药药方，能稍微缓解跌打肿胀或外伤的疼痛。', '', '消耗品', '1', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '80', '', '', '', '', 0, 0),
(18, '希望镇', 2, '废旧六号电池', '', '看起来好像是一块电子垃圾，却是人类曾经工业的结晶，估计是收藏价值大于实用价值。', '', '其它', '能源', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(14, '未分区', 0, '莎草纸', '', '这种摸起来略微有些粗糙的纸张似乎有神奇的功能。', '', '其它', '纸张', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(15, '未分区', 0, '碎石块', '', '一块不规则的碎石。', '', '其它', '石头', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(16, '未分区', 0, '@583300@动物粪便@end@', '', '什么动物的排泄物，异常恶臭。', '', '其它', '排泄物', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(20, '未分区', 0, 'A-01冲锋枪(猎豹)', '枪|gun-a-01', '昂贵的冲锋枪不是一般的势力能够装备得起的，当然，猎豹只是初级款的，所以还行。', '', '兵器', '3', 1, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '80', '', '', '', 0, 0),
(21, '未分区', 0, '破旧的牛仔裤', '', '耐磨的牛仔裤，勉强能保暖和提供一点缓冲作用。', '', '防具', '6', 1, 5, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0),
(22, '旧街', 1, '老旧的圆领外衣', '', '脏兮兮的模样，平平无奇的款式，却能带给人一丝丝的温暖。', '', '防具', '5', 1, 15, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '10', '1', '', 0, 0),
(23, '希望镇', 2, '《陈年旧梦》', '', '一本暗红色的书，似乎是一本小说。', '儿时，秋与林曾是一对恋人。他们相识于故乡的田野之间，共同度过了无数欢乐的时光。然而，随着岁月的流逝，他们的人生道路逐渐发生了变化。\r\n秋，一个温文尔雅的男子，为了家族的利益，被迫离开了故乡，去往繁华的都市谋求生计。临别时，林紧紧握住秋的手，眼中闪烁着泪花，却无法改变他的决定。\r\n“你要记得我，无论何时何地，我永远都会等着你。”林的话语，至今仍在秋的耳边回荡。\r\n城市的生活让秋变得愈加成熟，然而他的内心却始终无法割舍对林的思念。一天，他偶然得知林也来到了都市，成为了一名小学教师。秋心中涌起了重逢的渴望，他决定要再次见到林，重温那段美好的旧梦。\r\n秋千方百计地寻找林的踪迹，终于在一个雨夜，他在林的家门口与她重逢。秋欣喜若狂，然而他发现林已经变得陌生了许多。她的眼神中已经没有了过去的单纯与欢乐，取而代之的是一种深深的忧虑与疲惫。\r\n“林，你还记得我吗？”秋问道。\r\n林缓缓抬起头，看着秋熟悉的面孔，眼中闪过一丝惊讶与欣喜。“我当然记得你，我一直都在等你。”\r\n然而，他们的重逢并没有像秋想象中的那样美好。林的身边已经有了其他的男人，一个看似平凡却对她呵护备至的男人。秋的心中充满了失落，但他并没有放弃对林的追求。\r\n他开始用各种方式向林表达自己的爱意，送花、写情书、甚至是公开的表白。然而，这些举动并没有让林回心转意。相反，她开始逃避秋的眼神，对他的追求感到困扰与不安。\r\n“林，为什么你要这样对我？”秋在林的面前，流下了痛苦的泪水。\r\n林轻轻地摇了摇头，“不是的，秋，你是一个好人，但我真的不能接受你的爱。”\r\n在那个陈年的旧梦之中，秋与林的爱情终究没有得到圆满的结局。时光荏苒，他们的故事成为了故乡的一则传说，让人们感叹不已。\r\n岁月如梭，秋已经变成了一个孤独的老人。他常常独自漫步在故乡的田野之间，回忆着过去的美好时光。而林也早已离开了这个地方，去往一个遥远的地方追求自己的梦想。\r\n在一个寂静的夜晚，秋独自坐在月光下，眼前浮现出林年轻时的模样。他想起了他们的欢笑、他们的誓言以及他们的分别。突然间，他明白了林的决定和她的痛苦。他们的爱情早已埋藏在那个陈年的旧梦之中，成为了他们生命中永远无法触及的遗憾。\r\n“林，愿你幸福。”秋在心中默默地祝福着林，然后缓缓闭上了双眼。在这个宁静的夜晚，他的灵魂终于得以安息。', '书籍', '小说', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(24, '旧街', 1, '变异利爪', '', '不知道是什么动物变异后的爪子，异常锋利，很适合用于打磨武器。', '', '其它', '材料', 1, 5, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(25, '旧街', 1, '@brown@变异黑土@end@', '', '这块黑土摸起来拥有奇怪的感觉。', '', '其它', '稀土', 1, 2, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(26, '旧街', 1, '电动轮椅', '', '瞧瞧，一把精巧的电动轮椅，造价可是颇为不菲，', '', '防具', '7', 100, 2500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0),
(27, '旧街', 1, '旧街通行身份牌', '', '一块薄薄的金属和不知名木头做成的菱形牌子，上面刻着【{u.name}】的名字。', '', '任务物品', '木牌', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(28, '旧街', 1, '@ae1313@黑耗子炖电路板@end@', '', '黑耗子先不说?炖电路板能吃吗?我一定是疯了！', '', '消耗品', '0', 1, 100, 0, 0, '', '', 0, 0, 0, 0, 'exp', '200', '', '', '', '', 0, 0),
(29, '旧街', 1, '@87cefa@蓝色血液@end@', '', '蓝蚊子身上掉下的一滴血，在月光照射下亮蓝亮蓝的，看起来很好看。', '', '其它', '原液', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(30, '旧街', 1, '@purple@紫色羽毛@end@', '', '一片紫色的羽毛，似乎是什么禽类身上的。', '', '其它', '材料', 1, 20, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(31, '旧街', 1, '@cb4d4d@营养元素冻@end@', '', '看着还不错，灰蓝的颜色，不知道是什么做的，闻起来有一股清香的奇特味道。', '', '消耗品', '0', 1, 200, 0, 0, '', '', 0, 0, 0, 0, 'exp', '300', '', '', '', '', 0, 0),
(32, '未分区', 0, '《日出之地海图》', '', '用一张羊皮卷记载了传说中的日出之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝传说太阳升起的地方，是一片富饶之地，拥有吃不完腐烂的食物以及穿不完随便乱扔的丝绸，随便往地上一躺就是黄金，翻个身大概率是块宝石......〞\r\n〝我用了大半生的时间，越过了「迷雾海」和「绝望漩涡」，当我看到那一轮冉冉升起的无与伦比的大太阳以及那块一生难忘的陆地时，我激动到难以自已，古书的记载就这样呈现在了我的眼前......〞\r\n「旧世纪复原会」－「马可.波罗」', '书籍', '海图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(33, '未分区', 0, '《灼热之地海图》', '', '用一张羊皮卷记载了传说中的灼热之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝无时无刻不在下着雨的森林，一望无际的草原，数不清的波涛汹涌的大河，蠢蠢欲动的火山......瞧瞧，我在她的尽头发现了什么，一座婀娜多姿的瀑布，她是那么迷人...〞\r\n〝噢，伙计，我想我找到她了，那片「灼热之地」，老实说，我现在只想找个地方喝点朗姆酒再和几位美人探讨下生命的真谛，我开玩笑的好吧如果你不这么认为我也没办法......〞\r\n「旧世纪复原会」－「大卫.利文斯通」', '书籍', '海图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(34, '未分区', 0, '《日落之地海图》', '', '用一张羊皮卷记载了传说中的日落之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '', '书籍', '海图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(35, '未分区', 0, '《极寒之地海图》', '', '用一张羊皮卷记载了传说中的极寒之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '', '书籍', '海图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(36, '未分区', 0, '《湿热之地海图》', '', '用一张羊皮卷记载了传说中的湿热之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '', '书籍', '海图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(37, '旧街', 1, '@black@黑色牛角@end@', '', '一块巨大的黑色牛角。', '', '其它', '动物角', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(38, '希望镇', 2, '@d36c27@胡萝卜汤@end@', '', '淡淡油花，点点青葱，津津有味，齿颊留香，旧时代前比较廉价的一道菜到如今却十分珍贵。', '', '消耗品', '0', 1, 50, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0),
(39, '未分区', 0, '@A67F37@铜矿@end@', '', '可以利用的含铜的自然矿物集合体的总称，铜矿石一般是铜的硫化物或氧化物与其他矿物组成的集合体，与硫酸反应生成蓝绿色的硫酸铜。', '', '任务物品', '原矿', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(40, '未分区', 0, '@DCDFE3@锡矿@end@', '', '锡质软有延展性、化学性质稳定，抗腐蚀、易熔，摩擦系数小，是良好的工业原料。', '', '任务物品', '原矿', 1, 15, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(41, '未分区', 0, '@d4d7d9@铁矿@end@', '', '铁是世界上发现最早，利用最广，用量也是最多的一种金属，其消耗量约占金属总消耗量的95%左右。铁矿石主要用于钢铁工业。', '', '任务物品', '原矿', 1, 30, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(42, '未分区', 0, '@72777b@铅矿@end@', '', '金属铅是一种耐蚀的重有色金属材料，铅具有熔点低、耐蚀性高、X射线和γ射线等不易穿透、塑性好等优点', '', '任务物品', '原矿', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(51, '未分区', 0, '《亵渎者的手册》', '', '记载着本地居民不诚和渎神之举的破烂书本，噢，兴许能卖给一个愚蠢的信徒。', '', '书籍', '手册', 1, 5, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(43, '广陵古城', 16, '白色长袍', '', '一件用精美的丝绸缝制而成的长袍，似乎来自遥远的东方。', '', '防具', '5', 1, 40, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '2', '', '', 0, 0),
(44, '广陵古城', 16, '蓝色头巾', '', '一件用精美的丝绸缝制而成的头巾，似乎来自遥远的东方。', '', '防具', '4', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0),
(45, '未分区', 0, '@0c1f04@松木@end@', '', '松木是一种针叶植物它具有松香味、色淡黄、疖疤多、对大气温度反应快、容易胀大、极难自然风干等特性。', '', '任务物品', '原木', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(46, '旧街', 1, '精钢剑', '剑|sword_0001', '用精钢打造的剑，拥有不小的威力。', '', '兵器', '1', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '15', '', '', '', 0, 0),
(47, '希望镇', 2, '@96d35f@豌豆沙拉@end@', '', '一些不知名的野菜，几颗干瘪的豌豆，用劣质奶油拌在一起就是一顿美味。', '', '消耗品', '0', 1, 100, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0),
(48, '希望镇', 2, '@d19d01@牛肉三明治@end@', '', '一块优质的生态农场黄牛肉，两片来自磨坊加工的小麦制成的食物，真是末世的一种奢侈享受啊。', '', '消耗品', '0', 1, 300, 0, 0, '', '', 0, 0, 0, 0, 'hp', '250', '', '', '', '', 0, 0),
(49, '希望镇', 2, '@4e7a27@蔬菜羹@end@', '', '生态农场出产的优质甜菜根以及芜菁，用高纯水烧煮，成非牛顿流体后加入特殊香料，十里飘香。', '', '消耗品', '0', 1, 80, 0, 0, '', '', 0, 0, 0, 0, 'hp', '120', '', '', '', '', 0, 0),
(50, '旧街', 1, '精钢匕首', '', '精钢锻造的匕首，锋利且杀伤力惊人。', '', '兵器', '2', 1, 120, 0, 0, '', '', 0, 0, 0, 0, '', '', '17', '', '', '', 0, 0),
(52, '未分区', 0, '《无名旅者的日记》', '', '这是一本无名旅者的日记，记载了一位无名旅者的故事。', '第一天：现在的我得知了真相，忘却了从前。是她带的那个戒指，我真愚蠢。\r\n第四天：天呐，我要死在这漫无天日的地洞了。', '书籍', '日记', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(53, '未分区', 0, '《枫叶气味的信》', '', '秋\r\n我爱你。\r\n好了，我说出来了。\r\n你看到的时候我估计在离开你的船上了。\r\n不知何时再会栖霞看一眼云海。\r\n也许此生无望。\r\n勿忘我-林。', '', '书籍', '信封', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(54, '未分区', 0, '《吟游诗人的地图》', '', '该死的诗人，好端端的把藏宝点塞文字里干什么。', '', '书籍', '地图', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(55, '希望镇', 2, '@763700@多汁的灰苹果@end@', '', '真搞不懂生态农场那批人怎么搞出来这种品种的，感觉没有鲜红的苹果吸引你的啃咬。', '', '消耗品', '水果', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0),
(56, '未分区', 0, '《贴着邮票的传单》', '', '一张破烂，措辞得体的传单，内容是招募冒险者。', '', '书籍', '传单', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(57, '未分区', 0, '《模糊不清的字条》', '', '这是一张模糊不清的字条，岁月的痕迹在上面很明显。', '', '书籍', '便签', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(58, '未分区', 0, '《目击者的证言》', '', '上面密密麻麻写满了许多人名以及其阐述的内容。', '', '书籍', '便签', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(59, '未分区', 0, '《末日的狂欢》', '', '交媾，愉悦，上千人的疯狂记载于此。', '', '书籍', '笔记', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(60, '未分区', 0, '《戈德兰植物图鉴》', '', '这本图鉴记载了戈德兰上常见的植物的信息，由某位不知名植物学家撰写。', '', '书籍', '图鉴', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(61, '未分区', 0, '《锻炉使用手册》', '', '这本手册记载了如何用锻炉打造出一副装备的过程。', '', '书籍', '手册', 1, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(62, '未分区', 0, '@4e7a27@绿色柑橘@end@', '', '这柑橘已经成熟了，但怎么是绿色的，那帮人又搞什么东西。', '', '消耗品', '水果', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0),
(63, '未分区', 0, '@d19d01@干式奶酪@end@', '', '黑雾城的人发明的一种奶酪，香味粗旷刺激，保质期很长，深受旅行者的喜爱。', '', '消耗品', '奶制品', 1, 50, 0, 0, '', '', 0, 0, 0, 0, 'hp', '100', '', '', '', '', 0, 0),
(64, '未分区', 0, '@785800@朗姆酒@end@', '', '自从这种琥珀色的烈酒被带到戈德兰以来，就成为了水手们的钟爱之物。', '', '消耗品', '酒', 1, 20, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0),
(65, '未分区', 0, '@ffab01@土豆饼@end@', '', '劣质的棕榈油的香气包裹住了土豆的脆感，是戈德兰上一般人也能享用得起的一道美食。', '', '消耗品', '主食', 1, 5, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0),
(66, '未分区', 0, '@01c7fc@水@end@', '', '用廉价的木头制成的水壶，里面装的不知道是哪口污染还不够严重的井水，清甜可口。', '', '消耗品', '水', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '1', '', '', '', '', 0, 0),
(67, '旧街', 1, '《莉莉安的书信》', '', '莉莉安写给姗妮的一封信，用书皮保护着，不知道上面写了什么。', 'to 亲爱的姗妮:\r\n你还好吗?你最近过得怎么样?上次的匆匆一别是我心中的一大遗憾，真想和你继续就着牛蒡菊花茶消磨午后的时光啊，对了，有件事想问一下你，希望镇的商队已经一个多月没有来过旧街了，是否出了什么变故，如果可以的话，可否给予我一封回信来说明情况?\r\nfrom 爱你的莉莉安', '书籍', '书信', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(68, '黑雾城', 6, 'B-99冲锋枪(黑冢)', '枪|gun-a-01', '黑雾城军工厂出产的一款冲锋枪，射速快穿透力强后座稳定，是昂贵又危险的武器。', '', '兵器', '3', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '100', '', '', '', 0, 0),
(69, '黑雾城', 6, '钨钢合金装甲', '', '钨钢合金打造的装甲，造价不菲，虽然厚重了一点，但是防御力非常优秀。', '', '防具', '5', 20, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '40', '', '', 0, 0),
(70, '未来城', 3, '激光短刃', '', '难以想象是什么样的手段让人类驯服了激光，并将其用于冷兵器领域，使其削铁如泥，锋利无比。', '', '兵器', '2', 10, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '50', '', '', '', 0, 0),
(71, '未分区', 0, '布鞋', '', '就是一块粗布做成了鞋子的样子，穿久了明显会感到硌脚。', '', '防具', '7', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'exp', '', '', '1', '', '', 0, 0),
(72, '未分区', 0, '背包编织包', '', '一套很粗糙的针线，能将你的背包稍微扩大一些。', '', '其它', '拓展包', 1, 60, 0, 0, '', '', 0, 0, 82, 0, '', '', '', '', '', '', 0, 0),
(73, '银月戈壁', 10, '@5C4033@风干的肉肠@end@', '', '一节不知道什么动物的肉，捣碎灌入肠衣，风干后别有一番风味。', '', '消耗品', '肉制品', 1, 150, 0, 0, '', '', 0, 0, 0, 0, 'hp', '300', '', '', '', '', 0, 0),
(74, '未分区', 0, '生锈的铁镐', '', '由杂质斑驳的铁制成的镐子，能进行一些初级的矿石采集。', '', '兵器', '10', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '1', '', '', '', 0, 0),
(75, '未分区', 0, '墨绿结晶', '', '一块不规则的墨绿色的结晶，靠近它你仿佛能听到一股涌动的力量。', '', '兵器镶嵌物', '结晶', 1, 300, 0, 0, '', '', 0, 0, 0, 0, '', '', '10', '', '', '', 0, 0),
(76, '未分区', 0, '淡蓝结晶', '', '这个不规则的晶体衍射着一股淡蓝色的光辉，夜晚下梦幻般美丽。', '', '防具镶嵌物', '结晶', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '10', '', '', 0, 0),
(77, '未分区', 0, '轻便兜帽', '', '一件由轻质有机材料制成的兜帽，戴着它仿佛整个人的头脑都放松了。', '', '防具', '4', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '15', '', '', 0, 0),
(78, '未分区', 0, '银色树汁', '', '这滴取自变异的银杉树上的汁液，不仅珍贵而且赏心悦目。', '', '任务物品', '树汁', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(79, '未分区', 0, '琥珀石', '', '这是一块外表崎岖不平的灰色石头，兴许切开后有琥珀也不一定。', '', '其它', '原石', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(80, '银月戈壁', 10, '@d9ec37@牛蒡菊花茶@end@', '', '牛蒡与菊花的味道巧妙地融合在一起。', '', '消耗品', '茶包', 1, 90, 0, 0, '', '', 0, 0, 0, 0, 'hp', '140', '', '', '', '', 0, 0),
(81, '失落之地', 4, '冒险者头巾', '', '一件用粗布缝制成的头巾，也缝制了冒险者的梦想。', '', '防具', '4', 1, 40, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '3', '', '', 0, 0),
(82, '未分区', 0, '希望勋章', '', '为了纪念「火种计划」的胜利而发行的勋章，是缅怀过去也是寄托希望于未来。', '', '防具', '16', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0),
(83, '刺桐古城', 17, '@blue@清风@end@', '', '「清风徐徐，水波不兴」据说是由一位遥远的东方工匠打造而成，符合人体工学，其动力装置能让人畅游天空的奥秘。', '', '防具', '17', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '10', '', '', 0, 0),
(84, '未分区', 0, '复合弓', '', '一把轻巧又致命的复合结构的弓，尖锐的箭能轻易穿透敌人，造价不菲。', '', '兵器', '11', 1, 1500, 0, 0, '', '', 0, 0, 0, 0, '', '', '55', '', '', '', 0, 0),
(85, '未分区', 0, '古老的刻印', '', '也许是灾变前时代的产物，沉甸甸的重量以及光怪陆离的图案，让人无不思索起那个时代的繁荣。', '', '其它', '刻印', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(86, '未分区', 0, '《残缺的羊皮卷轴》', '', '这是一份用山羊皮书写而成的卷轴，仿佛记录着什么神奇的东西，可惜是残缺的。', '', '书籍', '卷轴', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(87, '未分区', 0, '混乱宝珠', '', '一颗漆黑的宝珠，光是看着就感到头晕目眩了，是什么材料在起作用。', '', '兵器镶嵌物', '宝珠', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '30', '', '', '', 0, 0),
(88, '未分区', 0, '梦界令牌', '', '不知道什么材质制成，摸起来有种岁月的蹉跎感，上面有一些奇怪的符号。', '', '任务物品', '令牌', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(89, '未分区', 0, '奇楠沉香', '', '大自然的馈赠，一股独特的香气萦绕。', '', '其它', '沉香', 1, 400, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(90, '未分区', 0, '渡瓶', '', '能传递梦界与实界的奇特瓶子，材质是超级稀有的空间耦合材料「DMPK」。', '', '任务物品', '瓶子', 1, 6000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(91, '刺桐古城', 17, '淡红舍利指环', '', '漆黑光滑透露着一点点红色，由神秘的东方奇物舍利子制成。', '', '防具', '9', 1, 888, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '30', '', '', 0, 0),
(92, '未分区', 0, '硫磺', '', '一小块不规则的硫磺，似乎是从哪里挖到的。', '', '其它', '硫磺', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(93, '未分区', 0, '玄铁', '', '一块玄铁，沉甸甸的。', '', '其它', '玄铁', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(94, '未分区', 0, '秘银', '', '一块秘银。', '', '其它', '秘银', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(95, '未分区', 0, '钻石', '', '钻石。', '', '其它', '钻石', 2, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(96, '未分区', 0, '白金', '', '。', '', '其它', '白金', 1, 6000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(97, '未分区', 0, '乌木', '', '乌木。', '', '其它', '乌木', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(98, '未分区', 0, '晶髓', '', '晶石的精髓。', '', '其它', '晶髓', 1, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(99, '未分区', 0, '@864ffe@奥秘蘑菇@end@', '', '经过了异变后的普通的蘑菇，可不要轻易吞下它。', '', '消耗品', '蘑菇', 1, 30, 0, 0, '', '', 0, 0, 0, 0, 'hp', '-10', '', '', '', '', 0, 0),
(100, '未分区', 0, '@76bb40@接骨草@end@', '', '听名字就不一般，对跌打扭伤有不俗的疗效。', '', '消耗品', '草药', 1, 40, 0, 0, '', '', 0, 0, 0, 0, 'hp', '150', '', '', '', '', 0, 0),
(101, '未分区', 0, '树人之根', '', '等一下，树人是什么?我一定是疯了。', '', '任务物品', '树根', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(102, '未分区', 0, '@ebebeb@山羊奶@end@', '', '变异黑山羊的奶，淡黄的颜色，看着不是很有胃口。', '', '消耗品', '原奶', 1, 250, 0, 0, '', '', 0, 0, 0, 0, 'hp', '150', '', '', '', '', 0, 0),
(103, '未分区', 0, '毛蕊花', '', '这朵粉红的花，中间的花蕊是带着很多小毛的蓝色形状，很漂亮。', '', '任务物品', '花朵', 1, 20, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(104, '未分区', 0, '《火种计划·其一》', '', '火种计划的第一章，记录了那段黑暗的人类岁月中先驱者们在摸索救亡的一些事。', '', '书籍', '记录书', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(105, '未分区', 0, '生锈的铁斧', '', '由杂质斑驳的铁制成的斧头，能进行一些初级的木材采集。', '', '兵器', '10', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '1', '', '', '', 0, 0),
(106, '未分区', 0, '格斗拳套', '', '铭刻了许多奇特符号的拳套，能增强使用者的力量，简直是为为格斗而生的。', '', '兵器', '12', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '75', '', '', '', 0, 0),
(107, '未分区', 0, '刺客兜帽', '', '仿连帽式设计的黑色兜帽，采用的有机聚合抗压材料，能潜伏于阴影和人群之中，是刺客常见的配装。', '', '防具', '4', 1, 800, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '25', '', '', 0, 0),
(108, '未分区', 0, '诅咒法杖', '', '一颗骷髅头栩栩如生，乍一看仿佛能见到其周围的幽绿色气体，能从神秘的高维空间产生因果律伤害。', '', '兵器', '13', 1, 20000, 0, 0, '', '', 0, 0, 0, 0, '', '', '125', '', '', '', 0, 0),
(109, '未分区', 0, '黑曜晶石', '', '无比珍贵的黑曜结晶石，是黑曜石中最坚硬的部分。', '', '防具镶嵌物', '结晶', 5, 400, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '20', '', '', 0, 0),
(110, '未分区', 0, 'DMPK', '', '全称「暗聚复合酯酮」，一种能让周遭空间表现出「虚纹」的灰色超级材料，机理未知，被首次合成以后广泛应用于空间研究领域。', '', '其它', '超级材料', 50, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(111, '金陵古城', 9, '锦绣', '', '旧纪元时由商人取自海外蚕丝所制,异常珍贵。', '', '其它', '丝织品', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(112, '未分区', 0, '生锈的镰刀', '', '由杂质斑驳的铁制成的镰刀，能进行一些初级的植物采集。', '', '兵器', '10', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '1', '', '', '', 0, 0),
(113, '未分区', 0, '赤铁战斧', '', '通体血红，斧身坚硬光滑且开口处锋利无比，为痛饮敌人鲜血而造。', '', '兵器', '14', 5, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '35', '', '', '', 0, 0),
(114, '未分区', 0, '@583300@野兔腿@end@', '', '一只黑色变异野兔的腿肉，异常强健发达，应该味道不错。', '', '消耗品', '腿肉', 1, 40, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0),
(115, '未分区', 0, '@ffecd4@鲑鱼肉@end@', '', '在这个时代，这是多么奢华的享受。', '', '消耗品', '鱼肉', 1, 300, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0),
(116, '未分区', 0, '@5c0701@魔鹿肉@end@', '', '一头异化的魔鹿的肉，有些结实，硬梆梆的，估计不好咬动。', '', '消耗品', '鹿肉', 1, 600, 0, 0, '', '', 0, 0, 0, 0, 'hp', '140', '', '', '', '', 0, 0),
(117, '未分区', 0, '@c4bc00@麦芽酒@end@', '', '味道不会像烈酒那么火爆，但也不是没有脾气的。', '', '消耗品', '酒', 1, 20, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0),
(118, '未来城', 3, '25型重机枪', '', '看你看到这个大家伙的枪口时候，噢伙计，那可不太妙。', '', '兵器', '3', 1, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '200', '', '', '', 0, 0),
(119, '未分区', 0, '碾碎者', '', '曾经是大势力警卫力量的标配，后来被淘汰了，在枪械爱好者的收藏库也许能一睹方颜。', '', '兵器', '3', 1, 7000, 0, 0, '', '', 0, 0, 0, 0, '', '', '75', '', '', '', 0, 0),
(120, '未分区', 0, '老兵', '', '曾经是射程最远的狙击枪，威慑了一个时代，能量枪的崛起造就了它的没落，不过仍然是一把威力不俗的枪。', '', '兵器', '3', 1, 30000, 0, 0, '', '', 0, 0, 0, 0, '', '', '250', '', '', '', 0, 0),
(121, '未分区', 0, '正义之手', '', '如同它的缔造者所言:〝用绝对的力量审判世间一切的不正义之事。〞', '', '兵器', '12', 10, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '125', '', '', '', 0, 0),
(122, '未分区', 0, '奇怪的戒指', '', '通体发黑的椭圆形戒指，看着有些瘆人。', '', '防具', '9', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0),
(123, '希望镇', 2, '达克莱尔的合金扳手', '', '达克莱尔请求异域商人从遥远的东方带回来的一把特制合金扳手，拥有暗金色光芒以及高雅的外观。', '', '兵器', '10', 1, 998925, 0, 0, '', '', 0, 0, 0, 0, '', '', '10', '', '', '', 0, 0),
(124, '广陵古城', 16, '燕尾帽', '', '一件用精美的蚕丝制成的白色帽子，呈现燕尾形状，常见于医护人士。', '', '防具', '4', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0),
(125, '旧街', 1, '无刃之剑', '剑|sword_0001', '这把剑由某种合金制成，没有开刃，但杀伤力很可怕。', '', '兵器', '1', 1, 600, 0, 0, '', '', 0, 0, 0, 0, '', '', '60', '', '', '', 0, 0),
(126, '未分区', 0, '榫卯弓', '', '一把榫卯结构的弓，复杂的工艺造就了惊人的穿透力。', '', '兵器', '11', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '70', '', '', '', 0, 0),
(127, '旧街', 1, '生锈的长矛', '', '生锈的一把长矛，不知道能扛住几下冲击。', '', '兵器', '15', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '6', '', '', '', 0, 0),
(128, '希望镇', 2, '《姗妮的书信》', '', '姗妮写给莉莉安的一封信，用书皮保护着，不知道上面写了什么。', 'to 亲爱的莉莉安:\r\n很抱歉上次的信使出了点意外，没能及时将消息传递给你，目前的局势是这样的：今年的异兽潮汐出现了异常波动，根据斥候小队的报告疑似宁静森林深处有个地方出现了异常信号波动，自那以后，各洲的商队听到风声草动也断了和希望镇的商贾行为，这件事最近我们也焦头烂额的，如果可以，还请姐姐你相助一臂之力。\r\nfrom 爱你的姗妮', '书籍', '书信', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(129, '未分区', 0, '@0061fe@海洋之心@end@', '', '传说中的一颗宝石，来自于神秘的海沟深处，隐藏着巨大的秘密。', '', '任务物品', '奇物', 1, 99999, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(130, '未分区', 0, '灵魂晶石', '', '一颗闪耀着奇异色彩的晶石，蕴藏着有关灵魂的秘密。', '', '任务物品', '晶石', 1, 9999, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(131, '旧街', 1, '变异野兽长衣', '', '一件用变异的野兽皮制成的长衣，拥有一定的防御能力。', '', '防具', '5', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '5', '', '', 0, 0),
(132, '旧街', 1, '@5e30eb@赛西的紫色发夹@end@', '', '赛西的紫色发夹，似乎有什么特别的含义。', '', '任务物品', '发夹', 1, 10, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(133, '旧街', 1, '@008cb4@K-M的破旧怀表@end@', '', 'K-M的破旧怀表，似乎藏着一段往事。', '', '任务物品', '怀表', 1, 10, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(134, '旧街', 1, '@831100@赫米特的红绳@end@', '', '赫米特的一段红绳，有一些岁月的痕迹。', '', '任务物品', '红绳', 1, 10, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(135, '未分区', 0, '石炭', '', '一块黑乎乎的石炭。', '', '其它', '素材', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(136, '未分区', 0, '@785800@蛤蜊罐头@end@', '', '吃起来就像婴儿的呕吐物，应该没人喜欢吃这东西。', '', '消耗品', '罐头', 1, 20, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0),
(137, '未分区', 0, '@583300@青铜项链@end@', '', '用青铜打造而成的项链。', '', '防具', '8', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '5', '', '', 0, 0),
(138, '未分区', 0, '未命名', '', '', '', '消耗品', '0', 0, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(139, '未分区', 0, '@583300@变异棕熊皮@end@', '', '这是一张变异棕熊的皮毛，棕色上方有点点瘆人的紫斑。', '', '其它', '皮毛', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(140, '未分区', 0, '@5a1c00@野猪獠牙@end@', '', '一颗狂暴的野猪身上的恐怖獠牙，异常坚硬。', '', '其它', '牙齿', 3, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(141, '未分区', 0, '@000000@黑色兔毛@end@', '', '兔子变异成巨齿兔，毛发变得黝黑深邃粗糙，有不少价值。', '', '其它', '皮毛', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(142, '未分区', 0, '驱魔粉末', '', '赛西炼制的驱魔粉末，真是神奇的炼金术！', '', '任务物品', '魔药', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(143, '未分区', 0, '@01c7fc@幻.月华流光@end@', '', '一把神奇梦幻的法杖，通体浅金闪耀，镶嵌着一颗巨大的钻石。', '', '兵器', '13', 1, 200000, 0, 0, '', '', 0, 0, 0, 0, '', '', '600', '', '', '', 0, 0),
(144, '未分区', 0, '@0061fe@变异蓝蝶后的翅膀@end@', '', '这是一对变异蓝蝶后的翅膀，是深蓝色的触感下的一双庞大的翅膀。', '', '其它', '翅膀', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(145, '未分区', 0, '@000000@变异杀人蜂王的尾针@end@', '', '这是一根变异杀人蜂王的尾针，黑色的表面传来丝丝的危险。', '', '其它', '尾针', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0),
(146, '未分区', 0, '@263e0f@变异巨齿虎王的利齿@end@', '', '这是一颗变异巨齿虎王的牙齿，墨绿色下尽显王霸之气。', '', '其它', '牙齿', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_item_op`
--

CREATE TABLE `system_item_op` (
  `belong` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `show_cond` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT '未命名',
  `link_event` varchar(255) DEFAULT NULL,
  `link_task` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_lp`
--

CREATE TABLE `system_lp` (
  `lp_id` int(11) NOT NULL,
  `lp_name` varchar(255) NOT NULL,
  `lp_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_lp`
--

INSERT INTO `system_lp` (`lp_id`, `lp_name`, `lp_desc`) VALUES
(1, '伐木工', '伐木工是那些能够利用手中的工具，如斧头、锯子等，从森林中砍伐树木，获取木材、木料等资源的人。'),
(2, '采矿工', '采矿工能辨别矿物并利用镐子进行开采活动。'),
(3, '渔夫', '渔夫是一种从事捕鱼业的职业，包括在海洋、湖泊、河流等水体中运用各种技巧和工具捕鱼的人员。'),
(4, '农夫', '指以耕种农作物为业的人。'),
(5, '养殖员', '专门负责养殖培训和繁殖(水产动植物)的人员。');

-- --------------------------------------------------------

--
-- 表的结构 `system_map`
--

CREATE TABLE `system_map` (
  `mid` int(11) UNSIGNED NOT NULL,
  `mname` text CHARACTER SET gb2312 NOT NULL,
  `mitem` text CHARACTER SET gb2312 NOT NULL,
  `mitem_now` text CHARACTER SET gb2312 NOT NULL,
  `mnpc` text CHARACTER SET gb2312 NOT NULL,
  `mnpc_now` text CHARACTER SET gb2312 NOT NULL,
  `mgtime` datetime NOT NULL,
  `mpick_time` datetime NOT NULL,
  `mrefresh_time` int(11) NOT NULL DEFAULT '1',
  `mphoto` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `mdesc` text CHARACTER SET gb2312 NOT NULL,
  `mup` int(11) NOT NULL,
  `mdown` int(11) NOT NULL,
  `mleft` int(11) NOT NULL,
  `mright` int(11) NOT NULL,
  `marea_name` text CHARACTER SET gb2312 NOT NULL,
  `marea_id` int(11) NOT NULL,
  `mop_target` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `mtask_target` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `mcreat_event_id` int(11) NOT NULL,
  `mlook_event_id` int(11) NOT NULL,
  `minto_event_id` int(11) NOT NULL,
  `mout_event_id` int(11) NOT NULL,
  `mminute_event_id` int(11) NOT NULL,
  `mshop` tinyint(1) NOT NULL DEFAULT '0',
  `mhockshop` tinyint(1) NOT NULL DEFAULT '0',
  `mshop_item_id` text CHARACTER SET gb2312 NOT NULL,
  `mkill` tinyint(1) NOT NULL DEFAULT '1',
  `mstorage` tinyint(1) NOT NULL DEFAULT '0',
  `mtianqi` varchar(255) CHARACTER SET gb2312 NOT NULL DEFAULT '晴天',
  `mdire` varchar(255) CHARACTER SET gb2312 NOT NULL DEFAULT '0,0,0',
  `mis_tp` tinyint(1) NOT NULL DEFAULT '0',
  `mtp_type` int(1) NOT NULL DEFAULT '0' COMMENT '0为无，1为渡口，2为陆行车站，2为飞行营地',
  `mis_rp` tinyint(1) NOT NULL DEFAULT '0',
  `mrp_id` int(11) NOT NULL DEFAULT '0',
  `mis_shield` tinyint(1) NOT NULL DEFAULT '0',
  `mis_signal_block` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `system_map`
--

INSERT INTO `system_map` (`mid`, `mname`, `mitem`, `mitem_now`, `mnpc`, `mnpc_now`, `mgtime`, `mpick_time`, `mrefresh_time`, `mphoto`, `mdesc`, `mup`, `mdown`, `mleft`, `mright`, `marea_name`, `marea_id`, `mop_target`, `mtask_target`, `mcreat_event_id`, `mlook_event_id`, `minto_event_id`, `mout_event_id`, `mminute_event_id`, `mshop`, `mhockshop`, `mshop_item_id`, `mkill`, `mstorage`, `mtianqi`, `mdire`, `mis_tp`, `mtp_type`, `mis_rp`, `mrp_id`, `mis_shield`, `mis_signal_block`) VALUES
(225, '旧街广场', '4|{r.3}+1', '4|1', '11|1|,13|1,46|{r.3}+2', '11|1,13|1,46|2', '2024-07-23 10:59:36', '0000-00-00 00:00:00', 60, '旧街|map001_center', '地面上凌乱不堪的各种垃圾堆放着，石阶上还有几个流浪汉在呼呼大睡。', 296, 294, 295, 226, '旧街', 1, '1', '', 0, 0, 0, 0, 0, 0, 0, '1|1,2|1', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(226, '旧街东路', '4|{r.2}+1', '4|2', '46|{r.3}+2', '46|2', '2024-07-22 12:09:35', '0000-00-00 00:00:00', 1, '', '这边相对比较开阔了一些，路两边也开设了一些店铺。', 299, 300, 225, 228, '旧街', 1, '2', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(228, '旧街东出口', '', '', '46|{r.3}+2', '46|4', '2024-07-05 21:57:02', '0000-00-00 00:00:00', 1, '', '说是出口，不过是由铁丝网围起来的一个通道。', 297, 576, 226, 229, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(229, '小树林', '10|{r.3}+1,16|{r.2}', '10|1,16|0', '', '', '2024-07-23 10:59:30', '0000-00-00 00:00:00', 1, '', '这里的树木普遍低矮，几处灌木丛里还散发着不可描述的味道。', 305, 575, 228, 230, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(230, '湖堤', '', '', '18|{r.5}+2', '18|6', '2024-07-06 23:30:47', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感。', 630, 672, 229, 232, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(231, '乱石堆', '15|{r.4}+1', '15|3', '46|{r.3}+2', '46|4', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这里不知道为什么会有一堆乱石，大的小的，形状各异。', 0, 0, 230, 232, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(232, '湖泊边缘', '', '', '18|{r.3}+2', '18|3', '2024-07-05 21:58:47', '0000-00-00 00:00:00', 1, '', '勉强能站人的一处平地，眼前的湖泊里，像石油一样颜色的水浆在其中咕噜翻滚，{eval(v(u.fix_bridge)==1?\"你看到一座简陋的木质桥浮在眼前。\":\"你看着面前的断桥望而兴叹。\")}', 0, 0, 230, 0, '旧街', 1, '12,22,23', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(233, '荒野', '', '', '', '', '2024-07-04 00:31:23', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。\r\n一块路牌随着风吹仿佛随时要倒下，上面标着一个往右的箭头，写着\"希望镇\"三个歪歪斜斜的字 。', 559, 561, 560, 235, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(235, '希望镇入口', '', '', '23|{r.3}+1,45|{r.4}+2', '23|2,45|3', '2024-07-04 00:31:20', '0000-00-00 00:00:00', 1, '', '为了抵御异变生物的侵蚀，人类建立了大大小小的聚集点，大部分中小规模的城镇只会拥有一个出入口。', 664, 318, 233, 0, '希望镇', 2, '14', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(236, '小镇西路', '', '', '23|{r.2}+1,45|{r.4}+2', '23|2,45|4', '2024-07-04 00:31:19', '0000-00-00 00:00:00', 1, '', '路两边被高高的铁网与外界隔绝开来，说是路其实就是由各种各样不规则的石块堆一起然后用黄沙铺平，毫无美感可言。', 0, 0, 235, 237, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(237, '希望镇西街', '', '', '14|1,23|{r 3}+1,45|{r.4}+2', '14|1,23|1,45|5', '2024-07-03 00:01:04', '0000-00-00 00:00:00', 1, '', '这里就比较繁华了，路面用大理石铺成，再用紫砂点缀铺平，两旁是各种各样的工厂和农场。', 442, 604, 236, 238, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(238, '希望镇西街', '', '', '23|{r.3}+1,45|{r.4}+2,53|{r.4}+2', '23|3,45|3,53|2', '2024-07-02 22:56:41', '0000-00-00 00:00:00', 1, '', '这里灯红酒绿，商品琳琅满目的，你都怀疑自己是不是在末世了。', 321, 320, 237, 239, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(239, '希望镇广场', '', '', '16|1,23|{r.3}+1,45|{r.4}+2', '16|1,23|3,45|4', '2024-07-02 22:56:37', '0000-00-00 00:00:00', 1, '', '这是一片方形广场，大约能容纳一两百人，路上行人衣着都比较讲究了，在广场中央伫立着一尊用大理石打造的雕像。', 322, 273, 238, 240, '希望镇', 2, '15', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(240, '希望镇东街', '', '', '23|{r.3}+1,45|{r.4}+2', '23|3,45|2', '2024-07-02 15:28:18', '0000-00-00 00:00:00', 1, '', '这里似乎是小镇的管理机构所在区域，设立了诸多机关。', 242, 316, 239, 241, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(241, '综合执法局', '', '', '23|{r.4}+2,45|{r.4}+2', '23|5,45|2', '2024-07-02 01:25:07', '0000-00-00 00:00:00', 1, '', '从这里可以进入综合执法局，此处守卫森严，最好不要随意走动，负责管理小镇大大小小的纠纷冲突问题。', 0, 0, 240, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(242, '希望医院', '', '', '76|1,23|{r.3}+1,45|{r.4}+2', '76|1,23|2,45|3', '2024-07-02 01:26:10', '0000-00-00 00:00:00', 1, '', '规模中等的一所医院，看起来比较正规了，每天都在接受各种各样的病人。', 0, 240, 322, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(243, '关口检查站(皇后街)', '', '', '', '', '2024-07-05 03:35:10', '0000-00-00 00:00:00', 1, '', '这个站口过去就是皇后街了，检查很严格。', 0, 246, 497, 244, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(244, '八车大道', '', '', '', '', '2024-07-05 03:35:16', '0000-00-00 00:00:00', 1, '', '电镀砖铺成的可供八辆车同时并头行进的大道。', 673, 0, 243, 439, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(245, '矿山', '', '', '', '', '2024-06-22 12:47:17', '0000-00-00 00:00:00', 1, '', '一座一座的矿山，年久失修后荒废了。', 0, 0, 0, 247, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(246, '盥洗室', '', '', '', '', '2024-01-11 23:54:05', '0000-00-00 00:00:00', 1, '', '位于关口检查站边上的一处盥洗室，一个有些年头的水龙头在模糊的镜子下缓慢地滴水。', 243, 0, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(247, '矿洞', '', '', '', '', '2024-03-11 16:21:56', '0000-00-00 00:00:00', 1, '', '矿山往下探得洞穴，仿佛随时都会塌陷。', 0, 0, 245, 248, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(248, '荒树林', '', '', '20|1', '20|1', '2024-03-11 16:21:53', '0000-00-00 00:00:00', 1, '', '荒芜的一片稀疏树林，树叶颜色呈现出发黑的怪异颜色。', 0, 0, 247, 249, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(249, '枫叶林', '', '', '15|1,17|1,21|1', '15|1,17|1,21|1', '2024-03-11 16:21:44', '0000-00-00 00:00:00', 1, '', '何以寄萧萧？月落霜枫别梦寒。', 0, 0, 248, 250, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(250, '针叶林', '', '', '19|1,22|1', '19|1,22|1', '2024-03-11 16:21:39', '0000-00-00 00:00:00', 1, '', '一大片的针叶林。', 0, 0, 249, 251, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(251, '雪山山脚', '', '', '', '', '2024-03-11 16:21:38', '0000-00-00 00:00:00', 1, '', '你望着眼前的雪山，感受到了生命的渺小。', 0, 0, 250, 252, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雪天', '0,0,0', 0, 0, 0, 0, 0, 0),
(252, '雪山山腰', '', '', '', '', '2024-03-11 16:21:37', '0000-00-00 00:00:00', 1, '', '已经到达雪山的山腰了，好像能看到雪山顶的耀眼白光在照耀。', 0, 0, 251, 253, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雪天', '0,0,0', 0, 0, 0, 0, 0, 0),
(253, '渡河港口', '', '', '', '', '2024-03-11 16:21:33', '0000-00-00 00:00:00', 1, '', '', 0, 0, 252, 254, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(254, '生态农场', '', '', '', '', '2024-03-11 16:21:32', '0000-00-00 00:00:00', 1, '', '为了在恶劣的末世环境存活下去，科学家们绞尽脑汁设计了内循环的生态农场。', 0, 0, 253, 255, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(255, '枯树林', '', '', '', '', '2024-07-05 01:43:07', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 0, 0, 254, 256, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(256, '迷雾沼泽', '', '', '', '', '2024-06-11 11:10:54', '0000-00-00 00:00:00', 1, '', '不仅泥泞难行，而且迷雾萦绕的一片沼泽，极少有人踏入进去。', 257, 0, 255, 258, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '大雾', '0,0,0', 0, 0, 0, 0, 0, 0),
(257, '无人山洞', '', '', '', '', '2023-11-08 15:20:45', '0000-00-00 00:00:00', 1, '', '', 0, 256, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(258, '暴风峡谷', '', '', '', '', '2024-06-11 11:10:56', '0000-00-00 00:00:00', 1, '', '这个峡谷终年暴风呼啸，似乎是在驱逐外来者。', 0, 0, 256, 259, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '暴风', '0,0,0', 0, 0, 0, 0, 0, 0),
(259, '废水处理区', '', '', '', '', '2024-06-11 11:10:57', '0000-00-00 00:00:00', 1, '', '臭气熏天的废水处理片区，没有人能在这里长待。', 0, 0, 258, 260, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(260, '垃圾填埋场', '', '', '24|1', '24|1', '2024-06-11 11:10:59', '0000-00-00 00:00:00', 1, '', '每天都会无数的垃圾被运到此处填埋。', 0, 0, 259, 261, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(261, '牧场', '', '', '', '', '2024-06-11 11:15:52', '0000-00-00 00:00:00', 1, '', '草长得很高，牧民和牛羊都去哪了。', 0, 0, 260, 262, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(262, '葡萄园', '', '', '', '', '2024-06-11 11:17:35', '0000-00-00 00:00:00', 1, '', '你能看到一些高科技设备在自动管理着这片葡萄园。', 0, 0, 261, 263, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(263, '迷雾小道', '', '', '', '', '2024-06-11 11:11:05', '0000-00-00 00:00:00', 1, '', '人迹罕见的一条小道，终年被迷雾所覆盖。', 0, 0, 262, 264, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '大雾', '0,0,0', 0, 0, 0, 0, 0, 0),
(264, '火山峡谷', '', '', '', '', '2024-01-06 07:44:43', '0000-00-00 00:00:00', 1, '', '由活火山冲击出来的一座峡谷，甚是宏伟。', 0, 0, 263, 265, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '浓雾', '0,0,0', 0, 0, 0, 0, 0, 0),
(265, '发光蘑菇林', '', '', '', '', '2024-06-22 12:47:24', '0000-00-00 00:00:00', 1, '', '这里远离人类聚居地，这种变异的发光蘑菇美丽又致命。', 0, 0, 264, 266, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(266, '机械之门', '', '', '', '', '2024-01-06 07:44:45', '0000-00-00 00:00:00', 1, '', '一个由蒸汽作为动力的纯粹合金打造成的机械门，高大威猛，是黑雾城的进出通道之一。', 0, 267, 0, 269, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(267, '瘴气林地', '', '', '', '', '2023-12-25 10:47:18', '0000-00-00 00:00:00', 1, '', '这处充满瘴气的林地位于这座被诅咒的城市外的西南一角。', 266, 0, 631, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(268, '黑雾平原', '', '', '', '', '2023-10-12 17:03:03', '0000-00-00 00:00:00', 1, '', '浓浓的黑雾覆盖在这平原上，伸手不见五指。', 0, 266, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(269, '黑雾城中心', '', '', '', '', '2024-01-06 07:44:46', '0000-00-00 00:00:00', 1, '', '由一种很坚硬的灰色合金M-06打造成的一个平台，是黑雾城的中央枢纽。', 667, 668, 266, 270, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(270, '黑雾城东', '', '', '', '', '2024-01-06 07:44:48', '0000-00-00 00:00:00', 1, '', '整条路都是用城中最先进的合金铺成，时不时有动能车来回通行。', 0, 0, 269, 271, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(271, '黑雾城东', '', '', '', '', '2024-01-06 07:44:49', '0000-00-00 00:00:00', 1, '', '十足的合金路，也是黑雾城最繁华的地带。', 0, 0, 270, 272, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(272, '黑雾城东城门', '', '', '24|1,25|1', '24|1,25|1', '2024-06-22 14:52:35', '0000-00-00 00:00:00', 1, '', '从城门往外看去能看到浓浓的黑雾覆盖着，看不清更远处的景色。', 0, 0, 271, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(273, '明日小区小路', '', '', '26|1,45|{r.4}+2', '26|1,45|4', '2024-07-02 22:56:36', '0000-00-00 00:00:00', 1, '', '这条路通向城镇里生活比较富裕的居民住处：明日小区，用的也是比较规整的大理石铺成。', 239, 319, 320, 316, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(274, 'GM工作室', '75|1,76|1', '75|1,76|1', '48|1|', '48|1', '2024-07-06 04:08:26', '0000-00-00 00:00:00', 1, '', '...', 490, 276, 278, 275, '未分区', 0, '17', '', 0, 116, 56, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(275, 'GM工作室2', '', '', '', '', '2024-07-06 01:24:24', '0000-00-00 00:00:00', 1, '', '', 0, 0, 274, 0, '未分区', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(276, 'GM工作室3', '', '', '', '', '2024-07-06 01:40:25', '0000-00-00 00:00:00', 1, '', '公聊测试', 274, 0, 0, 0, '未分区', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(278, 'GM工作室4', '', '', '', '', '2024-07-06 01:24:27', '0000-00-00 00:00:00', 1, '', '', 0, 0, 0, 274, '未分区', 0, '37', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(287, '帐篷内', '', '', '', '', '2024-07-04 15:14:14', '0000-00-00 00:00:00', 1, '', '这是你的帐篷内部。', 0, 0, 0, 0, '旧街', 1, '16', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 1, '晴天', '0,0,0', 0, 0, 0, 1, 1, 0),
(294, '旧街南路', '', '', '46|{r.3}+2,50|1,52|1', '46|4,50|1,52|1', '2024-07-23 10:59:00', '0000-00-00 00:00:00', 1, '旧街|map001_south', '旧街广场的南边通道，这里的房子看起来正常多了，有些许漂亮的砖瓦房矗立。', 225, 307, 306, 314, '旧街', 1, '6', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(295, '旧街西路', '', '', '49|1,46|{r.3}+2', '49|1,46|2', '2024-07-22 13:44:02', '0000-00-00 00:00:00', 1, '旧街|map001_west', '各种各样的棚户楼，简陋的帐篷，北面不远处有个临时市场，西面是一堵厚厚的墙壁，各种淤泥和腥臭味弥漫在此。', 298, 306, 0, 225, '旧街', 1, '10', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(296, '旧街北路', '8|{r.6}+2,4|{r.10}+1', '8|6,4|4', '46|{r.3}+2', '46|2', '2024-07-22 13:21:48', '0000-00-00 00:00:00', 1, '', '这里已经不能算是路了，一片又一片的废墟。', 302, 225, 0, 299, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(297, '废弃铁皮房', '', '', '', '', '2024-07-03 08:51:33', '0000-00-00 00:00:00', 1, '', '一间四四方方的铁皮房子，用各种废铁搭成，风一吹，摇摇欲坠。', 0, 228, 0, 0, '旧街', 1, '5,13', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(298, '临时市场', '', '', '36|1,46|{r.3}+2,53|{r.3}+1', '36|1,46|4,53|3', '2024-07-22 20:07:36', '0000-00-00 00:00:00', 1, '旧街|map001_west_shop', '这个临时市场看起来已经存在了很久,流浪者和旧街居民以及异地商队来来往往。', 303, 295, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 1, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(299, '瓦尔金铁匠铺', '', '', '35|1,46|{r.3}+2', '35|1,46|2', '2024-07-22 13:17:11', '0000-00-00 00:00:00', 1, '', '这家铁匠铺的主人叫瓦尔金，年轻的时候在新世界闯荡过，好像得罪了什么人，隐居于此。', 0, 226, 296, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(300, '浮沉诊所', '', '', '17|1,59|1,46|{r.2}+1', '17|1,59|1,46|1', '2024-07-07 16:10:54', '0000-00-00 00:00:00', 1, '', '不知道为什么这家诊所的主人要取一个这个名字。', 226, 0, 0, 576, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(302, '废墟', '4|{r.5}+2,8|{r.3}+1,9|{r.2}', '4|4,8|2,9|0', '46|{r.3}+2', '46|4', '2024-07-22 13:17:42', '0000-00-00 00:00:00', 10, '', '一片狼藉的废墟，一个醒目的哨站就矗立在北方不远处。', 0, 296, 0, 304, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(303, '旧街北出口', '', '', '46|{r.3}+2,53|{r.3}+2', '46|2,53|3', '2024-07-22 20:07:38', '0000-00-00 00:00:00', 1, '', '北出口很大，也是旧街与外界交流沟通的其中一条重要道路，居民们有时候会去不远处的灰青草地上狩猎异兽与过往商人交易换取信用币。', 308, 298, 530, 529, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(304, '废墟', '11|{r.5}+1', '11|1', '46|{r.3}+2', '46|3', '2024-07-03 09:31:53', '0000-00-00 00:00:00', 30, '', '脏乱差，前方已经没有路了，偶尔还能见到几片闪着电光的废旧板子。', 0, 0, 302, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(305, '小树林', '10|{r.4}+2', '10|4', '', '', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这片小树林丝毫没有应有的生气，反而看起来死气沉沉，左手边被一圈铁丝网围住，隐约能看到里面的建筑。', 574, 229, 0, 630, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(306, '办事处', '', '', '', '', '2024-07-04 15:14:27', '0000-00-00 00:00:00', 1, '', '空无一人，不知道人都去哪了，很难想象这个破烂地方是个办公室。', 295, 0, 0, 294, '旧街', 1, '7,9', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(307, '旧街南出口', '', '', '', '', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '你透过缝隙能看到一条鹅卵石铺成的小路，但这个出口已经被废铁树枝啥的封死了。', 294, 0, 0, 0, '旧街', 1, '8', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(308, '灰青草地', '', '', '37|{r.3}+1', '37|3', '2024-07-22 13:43:32', '0000-00-00 00:00:00', 1, '', '地面是绿到发青的那种颜色，泥土，稀疏的杂草堆。', 338, 303, 538, 551, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(309, '暗道', '', '', '', '', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '办事处下方的暗道，黑乎乎的什么也看不见。', 0, 0, 0, 311, '旧街', 1, '11', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(311, '暗道', '', '', '', '', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '办事处下方的暗道，黑乎乎的什么也看不见。', 0, 0, 309, 339, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(314, '服装店', '', '', '41|1,46|{r.3}+2', '41|1,46|3', '2024-07-05 02:29:54', '0000-00-00 00:00:00', 1, '', '安妮开的一家服装店。', 0, 0, 294, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 1, 0, '7|1,21|1,22|1,71|1', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(316, '镇长办公室', '', '', '75|1,23|{r.3}+1,45|{r.4}+2', '75|1,23|3,45|3', '2024-07-02 22:56:13', '0000-00-00 00:00:00', 1, '', '只有德高望重且武艺高超的人才能竞选成为希望镇代理镇长，负责希望镇与外界的交流沟通。', 240, 0, 273, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(317, '安宁渡口', '', '', '34|{r.2}+1', '34|1', '2024-06-26 18:22:31', '0000-00-00 00:00:00', 1, '', '安宁城的渡口，来来往往的船只不断。', 447, 0, 446, 445, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '103,1,0', 1, 1, 0, 0, 0, 0),
(318, '车队驿站', '', '', '45|{r.4}+2,53|{r.5}+1', '45|4,53|2', '2024-07-04 00:31:21', '0000-00-00 00:00:00', 1, '', '这里是希望镇来往于人类各个集聚点的商人或佣兵等车队的营地，只要付出足够的代价，就能随行车队。', 235, 0, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '120,30,0', 1, 2, 0, 1, 0, 0),
(319, '明日小区北门', '', '', '45|{r.4}+2', '45|5', '2024-06-28 02:50:12', '0000-00-00 00:00:00', 1, '', '这里是希望镇明日小区的北门，中规中矩又不失威仪。', 273, 492, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(320, '大型集市', '', '', '45|{r.4}+2', '45|5', '2024-06-30 14:12:22', '0000-00-00 00:00:00', 1, '', '这里集聚了大大小小的商贩，有流动摊贩也有门店摊贩，卖着各式各样的东西。', 238, 0, 604, 273, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 1, 1, '55|99,62|1,65|1,49|1', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(321, '希望教堂', '', '', '47|1,45|{r.3}+1', '47|1,45|1', '2024-07-02 23:01:15', '0000-00-00 00:00:00', 1, '', '在困境中的人们总是希望在心灵上得到一些寄托。', 438, 238, 442, 322, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(322, '希望镇北街', '', '', '69|{r.2}+1', '69|1', '2024-06-28 02:50:42', '0000-00-00 00:00:00', 1, '', '这条街道往北走是居民和冒险者以及佣兵们排忧解难的地方。', 323, 239, 321, 242, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(323, '赌场', '', '', '69|{r.2}+2', '69|2', '2024-06-28 02:50:59', '0000-00-00 00:00:00', 1, '', '末世的规则底线总是比较灵活的。', 496, 322, 438, 437, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(324, '流沙山谷', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '一条巨大的瀑布携带着无数的黄沙无时无刻地冲刷着这个山谷。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(325, '奇特溶洞', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '流水长年累月腐蚀出来的地貌，看了令人称奇。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(326, '迷失沙漠', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '真的会有人来到这里吗？', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '高温', '0,0,0', 0, 0, 0, 0, 0, 0),
(327, '潮汐森林', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '涨潮时，森林隐藏，落潮时，森林浮现', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(328, '日落沼泽', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '日落的美景一览无遗，闻着沼泽上生长的芦苇的香气，能让人暂时忘记这末世的残酷。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(329, '深渊悬空池', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '真令人惊叹的自然现象！', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(330, '月光丛林', '', '', '', '', '2023-10-17 00:00:33', '0000-00-00 00:00:00', 1, '', '月光洒下，树木会泛出银白色的光芒，美极了。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(331, '白云崖', '', '', '', '', '2024-06-11 11:21:43', '0000-00-00 00:00:00', 1, '', '能依稀看到一个被厚厚的白云层掩盖住的深渊。', 546, 548, 547, 478, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(332, '栖霞山麓', '', '', '', '', '2024-06-11 11:22:01', '0000-00-00 00:00:00', 1, '', '栖霞山上有成片的枫树，深秋的栖霞，满山枫树长了红色的叶片。', 478, 473, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(333, '古藤林', '', '', '', '', '2024-06-11 11:21:52', '0000-00-00 00:00:00', 1, '', '碧绿的古藤，错综复杂。', 0, 0, 0, 0, '金陵古城', 9, '34', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(334, '百花谷', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '谷中百花盛开，宛若人间仙境', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(335, '飞瀑崖', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '飞流直下三千尺，疑似银河落九天。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(336, '星夜湖', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '听说以前的湖边会有一闪一闪的萤火虫，不知道那是什么样的一种景象呢？', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(337, '冰晶湖', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '这片湖面及湖四周都悬浮着冰晶，显然这里发生了奇异的变化。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(338, '灰青草地', '', '', '37|{r.3}+1', '37|1', '2024-07-22 13:43:31', '0000-00-00 00:00:00', 1, '', '地面是绿到发青的那种颜色，泥土，稀疏的杂草堆，隐约往东北方向仿佛能看到水的反光。', 346, 308, 539, 0, '旧街', 1, '38', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(339, '暗道', '', '', '', '', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '办事处下方的暗道，眼前似乎有一丝若隐若现的亮光。', 0, 482, 311, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(340, '秦淮渡口', '', '', '53|{r.3}+1', '53|1', '2024-06-26 19:13:21', '0000-00-00 00:00:00', 1, '', '花船，商船数不胜数，秦淮河从此处流入了无边无际的东海。', 466, 448, 450, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '118,32,0', 1, 1, 0, 0, 0, 0),
(341, '不冻港', '', '', '', '', '2023-10-19 21:11:43', '0000-00-00 00:00:00', 1, '', '这座港口终年不结冰，堪称是附近的一个奇迹。', 0, 0, 0, 0, '不夜之城', 12, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '37,55,0', 1, 1, 0, 0, 0, 0),
(342, '奇迹港口', '', '', '', '', '2023-12-13 14:59:53', '0000-00-00 00:00:00', 1, '', '这是个充满了奇迹的港口，飞天的扫帚丶跳舞的船帆以及那唱歌的朗姆酒......', 0, 0, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '10,46,0', 1, 1, 0, 0, 0, 0),
(343, '神圣港口', '', '', '', '', '2024-06-26 19:12:18', '0000-00-00 00:00:00', 1, '', '这个港口是银月人代神与外界交流的场所，在银月人心中代表了至高无上的地位。', 0, 0, 0, 0, '银月戈壁', 10, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '50,27,0', 1, 1, 0, 0, 0, 0),
(344, '勘测港口', '', '', '', '', '2023-11-25 01:50:28', '0000-00-00 00:00:00', 1, '', '瓦兰人擅长勘测和算术，这个港口的每一个角度和长度都经过了精密的计算，因此得名。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '32,1,0', 1, 1, 0, 0, 0, 0),
(346, '灰青草地', '', '', '37|{r.3}+2', '37|2', '2024-07-23 11:17:56', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 347, 338, 552, 359, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(347, '灰青草地', '', '', '37|{r.3}+1', '37|0', '2024-07-22 22:25:10', '0000-00-00 00:00:00', 1, '', '左边被高大的山石挡住了，不知道里面有什么秘密。', 348, 346, 0, 360, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(348, '灰青草地', '', '', '37|{r.3}+1', '37|3', '2024-07-16 13:20:53', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 349, 347, 0, 361, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(349, '灰青草地', '', '', '37|{r.3}+1', '37|1', '2024-07-16 13:20:48', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 350, 348, 0, 362, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(350, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 351, 349, 0, 363, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(351, '灰青草地', '', '', '37|{r.3}+1', '37|3', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 352, 350, 0, 364, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(352, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 353, 351, 0, 365, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(353, '灰青草地', '', '', '37|{r.3}+1', '37|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 354, 352, 0, 366, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(354, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 355, 353, 0, 367, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(355, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 356, 354, 0, 368, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(356, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 357, 355, 0, 369, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(357, '灰青草地', '', '', '51|{r.4}+1', '51|3', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 358, 356, 0, 370, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(358, '灰青草地', '', '', '51|{r.4}+1', '51|1', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 357, 0, 371, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(359, '小水池', '', '', '51|{r.4}+1', '51|3', '2024-07-22 12:07:41', '0000-00-00 00:00:00', 1, '', '这片灰青草地中间的一个小水池，是许多野兽喝水的地方。', 360, 0, 346, 372, '旧街', 1, '19', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(360, '灰青草地', '', '', '51|{r.3}', '51|0', '2024-07-18 00:15:43', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 361, 359, 347, 373, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(361, '灰青草地', '', '', '51|{r.4}+1', '51|1', '2024-07-18 00:15:44', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 362, 360, 348, 374, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(362, '灰青草地', '', '', '57|{r.4}+1', '57|0', '2024-07-06 04:15:45', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 363, 361, 349, 375, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(363, '灰青草地', '', '', '51|{r.4}+1', '51|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 364, 362, 350, 376, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(364, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 365, 363, 351, 377, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(365, '灰青草地', '', '', '57|{r.4}+1', '57|1', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 366, 364, 352, 378, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(366, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 367, 365, 353, 379, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(367, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 368, 366, 354, 380, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(368, '灰青草地', '', '', '57|{r.4}+1', '57|1', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 369, 367, 355, 381, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(369, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:50', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 370, 368, 356, 382, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(370, '灰青草地', '', '', '57|{r.4}+1', '57|4', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 371, 369, 357, 383, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(371, '灰青草地', '', '', '57|{r.4}+1', '57|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 370, 358, 384, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(372, '灰青草地', '', '', '51|{r.3}', '51|2', '2024-07-22 12:07:38', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 373, 0, 359, 385, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(373, '灰青草地', '', '', '51|{r.3}', '51|2', '2024-07-06 04:15:27', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 374, 372, 360, 386, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(374, '灰青草地', '', '', '51|{r.3}', '51|0', '2024-07-06 04:15:38', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 375, 373, 361, 387, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(375, '灰青草地', '', '', '51|{r.3}', '51|0', '2024-07-06 04:15:44', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 376, 374, 362, 388, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(376, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 377, 375, 363, 389, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(377, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 378, 376, 364, 390, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(378, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 379, 377, 365, 391, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(379, '灰青草地', '', '', '51|{r.3}', '51|0', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 380, 378, 366, 392, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(380, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 381, 379, 367, 393, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(381, '灰青草地', '', '', '51|{r.3}', '51|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 382, 380, 368, 394, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(382, '灰青草地', '', '', '51|{r.3}', '51|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 383, 381, 369, 395, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(383, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 384, 382, 370, 396, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(384, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 383, 371, 397, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(385, '灰青草地', '', '', '51|{r.3}', '51|0', '2024-07-22 12:07:37', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 386, 0, 372, 398, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(386, '灰青草地', '', '', '51|{r.3}', '51|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 387, 385, 373, 399, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(387, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-06 04:15:40', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 388, 386, 374, 400, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(388, '灰青草地', '', '', '51|{r.3}', '51|0', '2024-07-06 04:15:41', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 389, 387, 375, 401, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(389, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-06 04:15:41', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 390, 388, 376, 402, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(390, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 391, 389, 377, 403, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(391, '灰青草地', '', '', '51|{r.3}', '51|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 392, 390, 378, 404, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(392, '灰青草地', '', '', '51|{r.3}', '51|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 393, 391, 379, 405, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(393, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 394, 392, 380, 406, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(394, '灰青草地', '', '', '57|{r.4}+1', '57|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 395, 393, 381, 407, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(395, '灰青草地', '', '', '57|{r.4}+1', '57|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 396, 394, 382, 408, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(396, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 397, 395, 383, 409, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(397, '灰青草地', '', '', '57|{r.4}+1', '57|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 396, 384, 410, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(398, '灰青草地', '', '', '57|{r.4}+1', '57|3', '2024-07-22 12:07:16', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 399, 0, 385, 411, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(399, '灰青草地', '', '', '57|{r.4}+1', '57|4', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 400, 398, 386, 412, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(400, '灰青草地', '', '', '57|{r.4}+1', '57|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 401, 399, 387, 413, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(401, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 402, 400, 388, 414, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(402, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 403, 401, 389, 415, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(403, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 404, 402, 390, 416, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(404, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 405, 403, 391, 417, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(405, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 406, 404, 392, 418, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(406, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 407, 405, 393, 419, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(407, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 408, 406, 394, 420, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(408, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 409, 407, 395, 421, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(409, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 410, 408, 396, 422, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(410, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 409, 397, 423, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(411, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 412, 0, 398, 424, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(412, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 413, 411, 399, 425, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(413, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 414, 412, 400, 426, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(414, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 415, 413, 401, 427, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(415, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 416, 414, 402, 428, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(416, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:51', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 417, 415, 403, 429, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(417, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 418, 416, 404, 430, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(418, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 419, 417, 405, 431, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(419, '灰青草地', '', '', '58|{r.3}+1', '58|1', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 420, 418, 406, 432, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(420, '灰青草地', '', '', '58|{r.3}+1', '58|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 421, 419, 407, 433, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(421, '灰青草地', '', '', '58|{r.3}+1', '58|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 422, 420, 408, 434, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(422, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 423, 421, 409, 435, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(423, '灰青草地', '', '', '58|{r.3}+1', '58|2', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 422, 410, 436, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(424, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 425, 0, 411, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(425, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 426, 424, 412, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(426, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 427, 425, 413, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(427, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 428, 426, 414, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(428, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 429, 427, 415, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(429, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 430, 428, 416, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(430, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 431, 429, 417, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(431, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 432, 430, 418, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(432, '灰青草地', '', '', '55|{r.3}+1', '55|1', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 433, 431, 419, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(433, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 434, 432, 420, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(434, '灰青草地', '', '', '55|{r.3}+1', '55|2', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 435, 433, 421, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(435, '灰青草地', '', '', '55|{r.3}+1', '55|3', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 436, 434, 422, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(436, '巨型洞穴', '', '', '56|1', '56|1', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 30, '', '这是一个天然的巨型洞穴，你仿佛能听到几声吼叫传来。', 0, 435, 423, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(437, '露天浴场', '', '', '45|{r.5}+5,69|{r.2}+1', '45|8,69|2', '2024-06-28 02:51:03', '0000-00-00 00:00:00', 1, '', '人们在这里欢呼洗漱，恍然忘记了身处的时代。', 0, 0, 323, 0, '希望镇', 2, '18', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(438, '末日剧场', '', '', '', '', '2024-06-28 02:51:33', '0000-00-00 00:00:00', 1, '', '氤氲的气氛，剧场上正在上演一幕又一幕悲怆的人类史诗。', 0, 321, 0, 323, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(439, '八车大道', '', '', '', '', '2024-06-28 03:03:12', '0000-00-00 00:00:00', 1, '', '电镀砖铺成的可供八辆车同时并头行进的大道，两边是高楼林立，前方是一座高架十字桥。', 0, 0, 244, 452, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(440, '智慧公会', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '瓦兰人打造的一个用于研究各种前沿领域的公会，吸引了来自各个地方的高智商人才。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(441, '真理图书馆', '', '', '', '', '2023-12-13 10:23:02', '0000-00-00 00:00:00', 1, '', '什么是真理?瓦罗人对知识的渴求已经到了要将一切世间真理纳入到这一所高耸入云的图书馆的地步。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(442, '公墓', '', '', '74|1', '74|1', '2024-07-03 00:01:00', '0000-00-00 00:00:00', 1, '', '一片阴冷的墓地，仿佛能听到魂灵在耳边的呢喃......', 0, 237, 0, 321, '希望镇', 2, '27', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(443, '壁炉旅馆', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '温暖的壁炉，带给每一位歇息的旅客些许的温暖。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(444, '冲击港口', '', '', '', '', '2024-06-25 00:24:06', '0000-00-00 00:00:00', 1, '', '活火山喷出的岩浆在这个三角洲冷却形成了一个冲击平原，霍摩人在此用黑耀石修建了这样一个坚固的港口。', 0, 0, 0, 0, '熔岩山岭', 13, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '78,0,0', 1, 1, 0, 0, 0, 0),
(445, '露天大型市场', '', '', '34|{r.3}+2,53|{r.5}+2,54|1', '34|4,53|4,54|1', '2023-10-29 15:45:22', '0000-00-00 00:00:00', 1, '', '来来往往的商人，旅客，当地的渔民......声声不绝的吆喝声，电子广播声，各种嘈杂的声音在这里汇集。', 0, 0, 317, 0, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(446, '滨海花园', '', '', '', '', '2023-11-14 00:09:30', '0000-00-00 00:00:00', 1, '', '安宁城的人们闲暇之余会来这个美丽祥和的花园散心。', 0, 0, 0, 317, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(447, '入城干道', '', '', '', '', '2023-11-14 10:35:06', '0000-00-00 00:00:00', 1, '', '从安宁渡口往安宁城方向的一条主干道，用平整的混凝土铺成的八车通道，上方还有色彩各异的顶棚遮挡阳光。', 0, 317, 0, 0, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(448, '长乐露天市场', '', '', '', '', '2024-06-11 11:29:53', '0000-00-00 00:00:00', 1, '', '金陵城最大的市场，位于秦淮渡口附近，一边倚靠秦淮河，商贾林立，小贩叫卖声连绵不绝。', 340, 0, 449, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(449, '金陵市舶司', '', '', '', '', '2024-06-11 11:29:51', '0000-00-00 00:00:00', 1, '', '金陵城设立的市舶司分部，用于管理金陵对外贸易的大小事宜。', 450, 0, 0, 448, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(450, '夫子庙东入口', '', '', '', '', '2024-06-26 22:28:43', '0000-00-00 00:00:00', 1, '', '这里是夫子庙的东边入口，用青石铸成的一座牌坊之门，上书\"古秦淮\"，进去后是一个古玩街道。', 465, 449, 451, 340, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(451, '古玩街道', '', '', '', '', '2024-06-11 11:22:43', '0000-00-00 00:00:00', 1, '', '这是一条繁华的街道，两边的小摊上摆满了各式各样的古玩，人群络绎不绝。', 456, 0, 457, 450, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(452, '高架十字桥底', '', '', '', '', '2024-06-28 03:03:13', '0000-00-00 00:00:00', 1, '', '各种眩目的广告扑面而来，光污染在这里体现得淋漓尽致，再过去就是皇后街了。', 0, 0, 439, 453, '未来城', 3, '20', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(453, '皇后街西', '', '', '', '', '2024-01-10 11:26:37', '0000-00-00 00:00:00', 1, '', '皇后街的西边，分布着各种小吃和餐馆，是美食爱好者的天堂。', 0, 0, 452, 454, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(454, '十字广场', '', '', '', '', '2024-01-10 10:48:28', '0000-00-00 00:00:00', 1, '', '这里是皇后街的十字广场，车水马龙，人来人往，好不热闹。', 666, 0, 453, 625, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(455, '金陵南路', '', '', '', '', '2024-03-11 16:20:01', '0000-00-00 00:00:00', 1, '', '金陵城南边的大道，人声鼎沸，两旁是眼花缭乱的小摊和商铺。', 467, 465, 476, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(456, '乌衣巷', '', '', '', '', '2024-06-11 11:22:41', '0000-00-00 00:00:00', 1, '', '旧时王谢堂前燕，飞入寻常百姓家。', 0, 451, 463, 465, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(457, '雨花街道', '', '', '', '', '2024-06-11 11:22:47', '0000-00-00 00:00:00', 1, '', '驰道如砥。树以青槐，亘以绿水玄荫耽耽，清流潺潺。', 463, 458, 459, 451, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(458, '大报恩寺塔', '', '', '', '', '2023-11-24 16:45:32', '0000-00-00 00:00:00', 1, '', '这座寺庙香火不断，历史悠久，一座巨塔高耸入云。', 457, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(459, '贡院前广场', '', '', '', '', '2024-06-11 11:22:51', '0000-00-00 00:00:00', 1, '', '这里视野开阔，身后可以看到文庙丶贡院，身前有一条秦淮河支流缓缓淌过。', 460, 462, 461, 457, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(460, '金陵贡院', '', '', '', '', '2023-11-13 09:13:04', '0000-00-00 00:00:00', 1, '', '莘莘学子于此证己立志，渴望实现自己远大的抱负。', 0, 459, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(461, '文庙', '', '', '', '', '2024-06-11 11:22:53', '0000-00-00 00:00:00', 1, '', '祭拜先哲的场所，古朴恢弘端庄，香客络绎不绝。', 0, 0, 0, 459, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(462, '河岸小道', '', '', '', '', '2024-06-11 11:22:55', '0000-00-00 00:00:00', 1, '', '这里是秦淮河支流岸边的一条小路，可以看到有几艘花船停靠在岸边，而更多的花船则是在水上行进。', 459, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(463, '殿前路', '', '', '', '', '2024-06-11 11:22:36', '0000-00-00 00:00:00', 1, '', '一条青石铺成的路，一直通往大成殿，往来的香客不少。', 464, 457, 0, 456, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(464, '大成殿', '', '', '', '', '2024-06-11 11:22:34', '0000-00-00 00:00:00', 1, '', '大成殿内陈设仿制旧世界的编钟、编磬等十五种古代祭孔乐器，定期有艺术团体在此进行古曲、雅乐演奏。', 0, 463, 0, 476, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(465, '秦淮路', '', '', '', '', '2024-03-11 16:19:49', '0000-00-00 00:00:00', 1, '', '一条宽敞的道路，旁边就是秦淮河，故此得名。', 455, 450, 456, 466, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(466, '秦淮河岸', '', '', '', '', '2024-03-11 16:19:48', '0000-00-00 00:00:00', 1, '', '秦淮河沿岸的一条道路，能一览秦淮河的风采。', 0, 340, 465, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(467, '金陵城中心', '', '', '', '', '2024-06-11 11:22:24', '0000-00-00 00:00:00', 1, '', '这是一片广阔的中心广场，各种各样的声音此起彼伏，连绵不绝......', 469, 455, 468, 470, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(468, '玄武大街', '', '', '', '', '2024-06-11 11:22:29', '0000-00-00 00:00:00', 1, '', '宽阔的玄武大街，这一条路的尽头可以看到著名的玄武湖，', 474, 476, 475, 467, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0);
INSERT INTO `system_map` (`mid`, `mname`, `mitem`, `mitem_now`, `mnpc`, `mnpc_now`, `mgtime`, `mpick_time`, `mrefresh_time`, `mphoto`, `mdesc`, `mup`, `mdown`, `mleft`, `mright`, `marea_name`, `marea_id`, `mop_target`, `mtask_target`, `mcreat_event_id`, `mlook_event_id`, `minto_event_id`, `mout_event_id`, `mminute_event_id`, `mshop`, `mhockshop`, `mshop_item_id`, `mkill`, `mstorage`, `mtianqi`, `mdire`, `mis_tp`, `mtp_type`, `mis_rp`, `mrp_id`, `mis_shield`, `mis_signal_block`) VALUES
(469, '栖霞北路', '', '', '', '', '2024-06-11 11:22:18', '0000-00-00 00:00:00', 1, '', '这一条路通向美丽的栖霞山，来来往往的行人丶游客络绎不绝。', 471, 467, 0, 479, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(470, '江宁大街', '', '', '', '', '2024-06-11 11:22:27', '0000-00-00 00:00:00', 1, '', '这是一条宽阔的大街。', 0, 0, 467, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(471, '迈皋路', '', '', '', '', '2024-06-11 11:22:04', '0000-00-00 00:00:00', 1, '', '这里有一座著名的迈皋桥，再过去不远处就是栖霞山了。', 473, 469, 477, 472, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(472, '仙林路', '', '', '', '', '2024-06-11 11:22:08', '0000-00-00 00:00:00', 1, '', '这里是金陵的高等教育区域，分布着诸多高等学府。', 0, 479, 471, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(473, '栖霞山脚', '', '', '', '', '2024-06-11 11:22:03', '0000-00-00 00:00:00', 1, '', '栖霞山的山脚，能看到两旁种满的枫树正在随风舞动。', 332, 471, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(474, '长江大桥', '', '', '', '', '2023-12-25 14:52:29', '0000-00-00 00:00:00', 1, '', '从这里俯瞰这翻涌的长江，忽知世间须臾为何物。', 480, 468, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(475, '玄武湖', '', '', '', '', '2024-06-11 11:22:31', '0000-00-00 00:00:00', 1, '', '霜起千年，堤绝金陵。', 0, 0, 0, 468, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(476, '金陵驿站', '', '', '', '', '2024-06-11 11:22:33', '0000-00-00 00:00:00', 1, '', '这里是金陵最古老的驿站，数不胜数的人群来来往往，好不热闹。', 468, 0, 464, 455, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '118,32,0', 1, 2, 0, 0, 0, 0),
(477, '明德路', '', '', '', '', '2024-06-11 11:22:06', '0000-00-00 00:00:00', 1, '', '周边分布着大大小小的商铺和饭馆等，附近的学子闲暇之余会来此放松休息。', 0, 0, 0, 471, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(478, '栖霞山顶', '', '', '', '', '2024-06-11 11:21:57', '0000-00-00 00:00:00', 1, '', '漫天红叶与千年古刹在此相会，动人心魄。', 0, 332, 331, 484, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(479, '三元巷', '', '', '', '', '2024-06-11 11:22:12', '0000-00-00 00:00:00', 1, '', '星罗棋布的小巷子，承载着多少人几十年的回忆呢。', 472, 0, 469, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(480, '浦口栈道', '', '', '', '', '2023-12-25 14:52:18', '0000-00-00 00:00:00', 1, '', '长江与支流汇合的交界处，建于江上的一条玻璃栈道。', 0, 474, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(481, '三七八巷', '', '', '', '', '2023-10-20 15:51:05', '0000-00-00 00:00:00', 1, '', '人间烟火味，最抚凡人心。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(482, '鹅卵石小径', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '封死的南铁门恍然就在身后，看来这就是南铁门外的地方，一个不起眼的洞穴正新鲜着。', 0, 483, 0, 0, '旧街', 1, '21', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(483, '荒野', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '旧街外的郊野，异常凄凉。', 482, 486, 487, 485, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(484, '栖霞禅寺', '', '', '', '', '2024-06-11 11:21:59', '0000-00-00 00:00:00', 1, '', '一个神秘而庄严的地方,每一处都散发着崇高的气息。', 0, 0, 478, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(485, '荒野', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '你总感觉那风吹过杂草的声音异常得诡异。', 0, 505, 483, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(486, '荒野', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '荒无人烟的荒野，你感到一阵的凄凉。', 483, 488, 506, 505, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(487, '山洞', '', '', '79|1', '79|1', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这是一个不大的山洞，不过有点黑，要是有把火把就好了。', 0, 0, 0, 483, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(488, '枯树林', '10|{r.2}+1', '10|2', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 486, 502, 504, 503, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(489, '湖边荒原', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '不远处有座你费尽九牛二虎之力搭建起来的简易桥，眼前的凄凉从里透到外。', 0, 0, 232, 491, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(490, 'GM工作室', '', '', '', '', '2024-07-06 01:24:21', '0000-00-00 00:00:00', 1, '', '...', 0, 274, 0, 0, '未分区', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(491, '远古石道', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 0, 0, 489, 557, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(492, '明日小道', '', '', '71|{r.5}+2', '71|6', '2024-06-28 02:50:02', '0000-00-00 00:00:00', 1, '', '明日小区的通道，由鹅卵石铺成。', 319, 495, 494, 493, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(493, '一号居民楼大厅', '', '', '45|{r.2}+1', '45|2', '2024-06-28 02:49:57', '0000-00-00 00:00:00', 1, '', '这栋居民楼的外观有些陈旧了，整体看起来大约20层高。', 0, 0, 492, 0, '希望镇', 2, '28', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(494, '二号居民楼大厅', '', '', '71|0', '71|0', '2024-06-28 02:50:09', '0000-00-00 00:00:00', 1, '', '这里是明日小区的二号楼，装修风格比一号楼新颖了一点，就是电梯还在维修之中。', 0, 0, 0, 492, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(495, '铁网大门', '', '', '23|2', '23|2', '2024-06-28 02:50:07', '0000-00-00 00:00:00', 1, '', '你发现不能继续往里走了，从铁网的缝隙中你看到了一排的别墅矗立。', 492, 0, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(496, '风月楼', '', '', '', '', '2024-06-28 02:51:01', '0000-00-00 00:00:00', 1, '', '只谈风月不谈情，只羡鸳鸯不羡仙。', 0, 323, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(497, '恶土边缘', '', '', '', '', '2024-07-05 03:35:13', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，即恶土的边缘。', 500, 498, 499, 243, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(498, '恶土边缘', '', '', '', '', '2024-01-11 23:54:12', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，即恶土的边缘。', 497, 0, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(499, '恶土边缘', '', '', '', '', '2024-01-10 08:37:09', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，即恶土的边缘。', 501, 0, 0, 497, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(500, '恶土边缘', '', '', '', '', '2024-01-11 23:54:09', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，即恶土的边缘。', 0, 497, 501, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(501, '恶土边缘', '', '', '', '', '2024-01-10 08:37:10', '0000-00-00 00:00:00', 1, '', '零星的流浪者部族占据着这里。横行肆虐的资源盗采、着火的油井和触目惊心的污染构成了恶土的日常。', 0, 499, 0, 500, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(502, '枯树林', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 488, 566, 567, 565, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(503, '枯树林', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 505, 565, 488, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(504, '枯树林', '', '', '', '', '2024-07-03 07:31:52', '2024-06-27 00:44:38', 1, '', '干枯的树林，树叶都掉光了，偶尔有几棵松树矗立。', 506, 567, 0, 488, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 5, 0, 0),
(505, '荒野', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '荒无人烟的荒野，你感到一阵的凄凉。', 485, 503, 486, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(506, '荒野', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '荒无人烟的荒野，你感到一阵的凄凉。', 0, 504, 0, 486, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(507, '钱塘渡口', '', '', '', '', '2023-12-05 16:48:46', '0000-00-00 00:00:00', 1, '', '海阔天空浪若雷，钱塘潮涌自天来，九曲之江在此汇入东海，各个国度来来往往的船只目不暇接。', 0, 512, 508, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '121,30,0', 1, 1, 0, 0, 0, 0),
(508, '钱塘古道', '', '', '', '', '2023-12-05 16:49:24', '0000-00-00 00:00:00', 1, '', '这是一条颇具古色古香的石板路，旁边就是著名的钱塘江，她正在默默地积蓄力量，等待下一次的绽放。', 0, 509, 510, 507, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(509, '两浙路市舶司', '', '', '', '', '2023-12-05 16:49:25', '0000-00-00 00:00:00', 1, '', '这里是钱塘古城管理海外事务的机构。', 508, 0, 513, 512, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(510, '余杭古道', '', '', '', '', '2023-11-03 10:05:36', '0000-00-00 00:00:00', 1, '', '这里通往钱塘古城的余杭区，那是一片富饶的地区。', 0, 513, 511, 508, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(511, '余杭广场', '', '', '', '', '2023-11-03 10:12:13', '0000-00-00 00:00:00', 1, '', '商贩丶行人络绎不绝，摊点丶店铺星罗棋布，人声鼎沸，嘈杂得很。', 0, 0, 0, 510, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(512, '钱塘贸易市场', '', '', '', '', '2023-12-05 16:48:51', '0000-00-00 00:00:00', 1, '', '这里是一个巨大的露天市场，能看到许多的脚夫在搬运货物，来来往往。', 507, 0, 509, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(513, '西湖古道', '', '', '', '', '2023-12-05 16:49:28', '0000-00-00 00:00:00', 1, '', '这里通向著名的西湖，也是经济繁荣的地带。', 510, 514, 0, 509, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(514, '西湖堤岸', '', '', '', '', '2023-12-05 16:49:30', '0000-00-00 00:00:00', 1, '', '春夏秋冬，各有不同的美景，真可谓是人间天堂。', 513, 515, 517, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(515, '西湖堤岸', '', '', '', '', '2023-12-05 16:49:32', '0000-00-00 00:00:00', 1, '', '春夏秋冬，各有不同的美景，真可谓是人间天堂。', 514, 0, 518, 516, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(516, '雷峰塔', '', '', '', '', '2023-12-05 16:49:33', '0000-00-00 00:00:00', 1, '', '夕照山上雷峰塔，夕照山下西湖水。', 0, 0, 515, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(517, '灵隐大道', '', '', '', '', '2023-11-30 15:21:24', '0000-00-00 00:00:00', 1, '', '你从这条人山人海的街道上偶尔窥见不远处那座古色古香的千年寺庙。', 0, 0, 524, 514, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(518, '林荫小道', '', '', '', '', '2023-12-05 16:49:35', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 0, 520, 519, 515, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(519, '林荫小道', '', '', '', '', '2023-12-05 16:49:37', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 524, 521, 0, 518, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(520, '林荫小道', '', '', '', '', '2023-11-02 23:50:05', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 518, 0, 521, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(521, '林荫小道', '', '', '', '', '2023-12-05 16:49:43', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 519, 0, 522, 520, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(522, '林荫小道', '', '', '', '', '2023-12-05 16:49:45', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 523, 0, 0, 521, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(523, '龙井古村', '', '', '', '', '2023-12-05 16:49:46', '0000-00-00 00:00:00', 1, '', '这是一座拥有悠久历史的古村落，享誉天下的龙井茶就在此诞生。', 0, 522, 0, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(524, '灵隐寺', '', '', '', '', '2023-12-05 16:49:38', '0000-00-00 00:00:00', 1, '', '背靠北高峰，面朝飞来峰，这里诉说着许多悠久的故事和传说。', 525, 519, 526, 517, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(525, '梅园', '', '', '', '', '2023-11-30 15:14:52', '0000-00-00 00:00:00', 1, '', '梅花盛开的日子，有许多观光客会来此以酒会诗，以龙井会友。', 0, 524, 0, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(526, '私塾', '', '', '', '', '2023-12-05 16:49:40', '0000-00-00 00:00:00', 1, '', '这座古旧的私塾不知道居住着什么人物。', 0, 0, 0, 524, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(527, '广陵渡口', '', '', '', '', '2023-11-03 15:57:46', '0000-00-00 00:00:00', 1, '', '这里是广陵古城的渡口，也是金塘大运河与东海的交汇口。', 0, 0, 0, 0, '广陵古城', 16, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '119,32,0', 1, 1, 0, 0, 0, 0),
(528, '刺桐渡口', '', '', '', '', '2023-11-05 15:50:15', '0000-00-00 00:00:00', 1, '', '这里是刺桐的渡口，繁华的样子用千帆万船来形容都不夸张。', 535, 0, 533, 534, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '118,24,0', 1, 1, 0, 0, 0, 0),
(529, '北部哨站', '', '', '60|1,53|{r.3}+2', '60|1,53|3', '2024-07-22 12:07:50', '0000-00-00 00:00:00', 1, '', '旧街设立在此的一个哨站，不仅是提防草地上可能出现的兽潮威胁，还是过往商队于此交换通商许可的地方。', 551, 0, 303, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(530, '灰土路', '', '', '', '', '2024-07-22 20:07:41', '0000-00-00 00:00:00', 1, '', '这里可以绕过灰青草地的危险，去到远方，依稀能看到土路上历经岁月洗礼的轮胎印。', 538, 543, 550, 303, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(531, '天字渡口', '', '', '', '', '2023-11-05 15:12:39', '0000-00-00 00:00:00', 1, '', '楚庭海上贸易的起点，商贾之船来来往往，好不热闹。', 0, 0, 0, 0, '楚庭古城', 18, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '113,23,0', 1, 1, 0, 0, 0, 0),
(532, '曼尼拉港口', '', '', '', '', '2023-11-29 00:29:46', '0000-00-00 00:00:00', 1, '', '曼尼拉城最大的港口，也是日出之东与日出之南往来的必经之路。', 0, 0, 0, 0, '曼尼拉城', 19, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '121,14,0', 1, 1, 0, 0, 0, 0),
(533, '刺桐沿海市场', '', '', '', '', '2023-11-05 15:43:06', '0000-00-00 00:00:00', 1, '', '脚夫丶远道而来的商人，过往的行人，游客，贩卖海砺煎的小贩，纵是红尘如是也。', 0, 0, 0, 528, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(534, '刺桐市舶司', '', '', '', '', '2023-11-05 15:45:24', '0000-00-00 00:00:00', 1, '', '刺桐城管理对外事宜的机构。', 536, 0, 528, 0, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(535, '丰泽大道', '', '', '', '', '2023-11-05 15:47:05', '0000-00-00 00:00:00', 1, '', '这条大道连接着刺桐港口与刺桐城的丰泽区域，两边是高低不一的红砖厝。', 0, 528, 0, 536, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(536, '六胜石塔', '', '', '', '', '2023-11-05 15:45:24', '0000-00-00 00:00:00', 1, '', '据说是刺桐的第一个灯塔，指引着来来往往的船只进出刺桐港。', 0, 534, 535, 0, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(537, '界港', '', '', '', '', '2023-11-13 23:50:07', '0000-00-00 00:00:00', 1, '', '浪速城海上贸易的重要港口。', 0, 0, 0, 0, '浪速古城', 20, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '135,34,0', 1, 1, 0, 0, 0, 0),
(538, '灰土路', '', '', '', '', '2024-07-22 20:07:42', '0000-00-00 00:00:00', 1, '', '这里更窄了，左手边就是深不可测的悬崖，你可以看到右手边那片辽阔的草原，神秘又充满危险。', 539, 530, 0, 308, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(539, '灰土路', '', '', '', '', '2024-07-22 20:07:43', '0000-00-00 00:00:00', 1, '', '你可以看到右手边那片辽阔的草原，神秘又充满危险，你发现左手方向有一片迷雾。', 552, 538, 540, 338, '旧街', 1, '', '', 0, 0, 59, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(540, '迷雾小径', '', '', '', '', '2024-07-11 17:44:13', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了，往南一看就是万丈深渊。', 542, 0, 541, 539, '旧街', 1, '', '', 0, 0, 60, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0),
(541, '迷雾小径', '', '', '', '', '2024-07-11 17:44:15', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了。', 553, 0, 0, 540, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0),
(542, '迷雾小径', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了。', 0, 540, 553, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0),
(543, '灰土路', '', '', '', '', '2024-07-22 12:09:17', '0000-00-00 00:00:00', 1, '', '前面就是一个悬崖了，你能透过一堵厚厚的混合金属的墙壁看到一个正在喧嚣的市场。', 530, 544, 545, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(544, '悬崖边', '', '', '', '', '2024-07-22 12:09:18', '0000-00-00 00:00:00', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来。', 543, 0, 549, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(545, '悬崖边', '', '', '', '', '2024-07-22 12:09:20', '2024-07-22 12:09:22', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来，你看到一个露天的铜矿立在那边。', 550, 549, 0, 543, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 1, 0, 0),
(546, '白云崖', '', '', '', '', '2024-06-11 11:21:49', '0000-00-00 00:00:00', 1, '', '能依稀看到一个被厚厚的白云层掩盖住的深渊，以及几根巨大的古藤枝条的影子。', 0, 331, 0, 0, '金陵古城', 9, '33', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(547, '白云崖', '', '', '', '', '2024-06-11 11:21:45', '0000-00-00 00:00:00', 1, '', '这里是一个60度倾斜角的悬崖，往下俯瞰是一个被淡淡的白云层掩盖住的深渊。', 0, 0, 0, 331, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(548, '白云崖', '', '', '', '', '2024-06-11 11:21:41', '2023-11-24 16:43:03', 1, '', '能比较清晰看到一个被薄薄的白云层掩盖住的深渊，往东张望依稀能看到栖霞山麓的风景。', 331, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 4, 0, 0),
(549, '悬崖边', '', '', '', '', '2024-07-22 12:09:19', '0000-00-00 00:00:00', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来。', 545, 0, 0, 544, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(550, '悬崖边', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来。', 0, 545, 0, 530, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(551, '旧街北部前线', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这里是旧街抵御灰青草地异兽潮的前线，依稀能闻到土地中的血腥味，可以看到一条长长的围栏隔开了旧街与灰青草地。', 0, 529, 308, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(552, '峡谷口', '', '', '', '', '2024-07-22 20:07:44', '0000-00-00 00:00:00', 1, '', '你左手边布满了迷雾，一片荆棘拦住了你的去路，前方是一个峡谷的入口，右手边是那片辽阔的草原，神秘又充满危险。', 555, 539, 0, 346, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(553, '迷雾小径', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了。', 0, 541, 0, 542, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(554, '迷雾小屋', '', '', '61|1', '61|1', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '一扇棕红色的木门，上面涂抹着奇特的不断旋转的阵法，一个烧红的壁炉，能看到火星正在跳动，铺满一地的红砖，摆放着不知名的瓶瓶罐罐，等等，这里为什么会有一个屋子！', 0, 0, 0, 0, '旧街', 1, '24,35', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0),
(555, '幽谷小径', '', '', '', '', '2024-07-22 20:07:45', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上。', 0, 552, 568, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(556, '理想城中心', '', '', '', '', '2023-12-12 01:02:54', '0000-00-00 00:00:00', 1, '', '一个以人类理想为因构建的城市，这里是它的中心广场，矗立着一尊男人的雕像，上面刻着「维特鲁威」的名字。', 0, 0, 0, 0, '理想城', 5, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(557, '远古石道', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 629, 628, 491, 627, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(558, '那霸港', '', '', '', '', '2023-11-13 23:54:19', '0000-00-00 00:00:00', 1, '', '首里的重要港口，通过转口贸易赚取了巨额财富。', 0, 0, 0, 0, '首里古城', 21, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '128,26,0', 1, 1, 0, 1, 0, 0),
(559, '荒野', '', '', '', '', '2024-07-03 00:50:13', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，右手边被严密的铁网牢牢锁住。', 658, 233, 564, 664, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(560, '荒野', '15|{r.3}+1', '15|1', '', '', '2024-07-04 00:31:24', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。', 564, 562, 563, 233, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(561, '荒野', '', '', '', '', '2024-07-03 00:42:37', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，能隐约看到不远处有块木牌矗立。', 233, 0, 562, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(562, '荒野', '', '', '77|1|%7Bu.tasks.t16%7D%3D%3D2%26%26%7Bu.tasks.t17%7D%21%3D2', '77|1', '2024-07-04 00:31:25', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，南边是一片辽阔的森林，危险且充满了未知。', 560, 603, 626, 561, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(563, '荒野', '', '', '', '', '2024-07-02 01:26:51', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。', 0, 0, 0, 560, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(564, '荒野', '', '', '', '', '2024-07-03 00:50:14', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。', 652, 560, 0, 559, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(565, '枯树林', '', '', '', '', '2024-07-03 07:31:52', '2024-06-27 15:17:04', 1, '', '干枯的树林，树叶都掉光了，有几棵松木挺立在那边。', 503, 0, 502, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 5, 0, 0),
(566, '枯树林', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了，再往南走就是一片危险的沼泽地，还是不要靠近好。', 502, 0, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(567, '枯树林', '', '', '', '', '2024-07-03 07:31:52', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 504, 0, 0, 502, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(568, '幽谷小径', '', '', '', '', '2024-07-16 13:24:53', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上。', 570, 0, 569, 555, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(569, '幽谷小径', '', '', '', '', '2024-07-03 07:31:52', '2024-03-11 16:24:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上，眼前是一条死路。', 0, 0, 0, 568, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 2, 0, 0),
(570, '幽谷小径', '', '', '67|{r.4}+5', '67|5', '2024-07-16 13:24:37', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上。', 571, 568, 572, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(571, '幽谷小径', '', '', '37|{r.4}+2', '37|5', '2024-07-13 10:19:48', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上，你隐约能看到一个亮光在前方。', 578, 570, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(572, '幽谷小径', '', '', '', '', '2024-07-04 00:31:48', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上，前面已经没有路了。', 670, 0, 0, 570, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(574, '小树林边缘', '', '', '', '', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '这片小树林丝毫没有应有的生气，反而看起来死气沉沉，左手边的铁丝网挡住了去路，一条小河从眼前穿过汇入了湖泊。', 0, 305, 0, 671, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(575, '小树林边缘', '', '', '', '', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '这里的树木普遍低矮，面前就是一条河，透过左边的混合金属栅栏还能隐约看到里面的行人。', 229, 0, 0, 672, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(576, '旧吧', '', '', '63|1,62|1,46|{r.5}+1', '63|1,62|1,46|1', '2024-07-07 16:10:56', '0000-00-00 00:00:00', 1, '', '一家小酒吧，这里鱼龙混杂，透过东边的木制窗户外的被隔绝的金属栅栏往外看能看到一片小树林。', 228, 0, 300, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(578, '峡谷口', '', '', '77|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2,61|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2,79|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2', '77|1,61|1,79|1', '2024-07-04 00:31:44', '0000-00-00 00:00:00', 1, '', '这个峡谷的一个出入口，外面是一片高大的森林，里面是神秘的山谷。', 579, 571, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(579, '迷雾森林', '', '', '66|{r.3}+3', '66|5', '2024-07-04 00:31:43', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 580, 578, 0, 584, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0),
(580, '迷雾森林', '', '', '', '', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 581, 579, 0, 585, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(581, '迷雾森林', '', '', '', '', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 582, 580, 0, 586, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(582, '迷雾森林', '', '', '', '', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 583, 581, 0, 587, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(583, '迷雾森林', '', '', '', '', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 0, 582, 0, 588, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(584, '迷雾森林', '', '', '72|{r.3}+2', '72|4', '2024-07-04 00:31:35', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 585, 0, 579, 589, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(585, '迷雾森林', '', '', '', '', '2024-07-04 00:31:34', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 586, 584, 580, 590, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(586, '迷雾森林', '', '', '', '', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 587, 585, 581, 591, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(587, '迷雾森林', '', '', '', '', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 588, 586, 582, 592, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(588, '迷雾森林', '', '', '64|2', '64|2', '2024-07-03 07:31:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 0, 587, 583, 593, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(589, '迷雾森林', '', '', '', '', '2024-07-04 00:31:35', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 590, 0, 584, 594, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(590, '迷雾森林', '', '', '64|{r.5}+1', '64|2', '2024-07-04 00:31:33', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 591, 589, 585, 595, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(591, '迷雾森林', '', '', '65|{r.2}+2', '65|3', '2024-07-04 00:31:31', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 592, 590, 586, 596, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(592, '迷雾森林', '', '', '', '', '2024-07-04 00:31:30', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 593, 591, 587, 597, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(593, '迷雾森林', '', '', '64|1', '64|1', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 0, 592, 588, 598, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(594, '迷雾森林', '', '', '', '', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 595, 0, 589, 599, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(595, '迷雾森林', '', '', '', '', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 596, 594, 590, 600, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(596, '迷雾森林', '', '', '64|3', '64|3', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 597, 595, 591, 601, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(597, '迷雾森林', '', '', '64|{r.2}+1', '64|1', '2024-07-04 00:31:29', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 598, 596, 592, 602, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(598, '迷雾森林', '', '', '65|2', '65|2', '2024-07-04 00:31:27', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 0, 597, 593, 603, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(599, '迷雾森林', '', '', '', '', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 600, 0, 594, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(600, '迷雾森林', '', '', '', '', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 601, 599, 595, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(601, '迷雾森林', '', '', '', '', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 602, 600, 596, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(602, '迷雾森林', '', '', '65|{r.2}+2', '65|2', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 603, 601, 597, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(603, '迷雾森林', '', '', '', '', '2024-07-04 00:31:26', '0000-00-00 00:00:00', 1, '', '这里是迷雾森林的边缘，不远处能看到一片平地...', 562, 602, 598, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(604, '生产中心广场', '', '', '70|1,45|{r.4}+2,23|{r.2}+2', '70|1,45|3,23|2', '2024-06-28 02:52:59', '0000-00-00 00:00:00', 1, '', '这里是希望镇的生产区域，周围零零散散伫立着一些工厂和农场，生产着整个镇所需要的日用品和食物。', 237, 607, 608, 320, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(607, '希望轻工厂', '', '', '71|{r.4}+3', '71|5', '2024-06-28 02:52:46', '0000-00-00 00:00:00', 1, '', '工厂是人类向自然的一种征服，这里是希望镇的先驱者们设立的轻型工厂，生产一些日用品等。', 604, 0, 609, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(608, '生态农场', '', '', '45|{r.3}+2,71|{r.4}+3', '45|3,71|4', '2024-06-28 02:52:07', '0000-00-00 00:00:00', 1, '', '为了在恶劣的末世环境存活下去，希望镇最初的工程师绞尽脑汁设计了这片可以内循环的生态农场。', 0, 609, 0, 604, '希望镇', 2, '30', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(609, '发电站', '', '', '73|1', '73|1', '2024-06-28 02:52:13', '0000-00-00 00:00:00', 1, '', '这里利用生态农场的循环生物能以及居民区的沼气丶天上的部分时段的太阳能等进行发电，供给整个希望镇的电力需求。', 608, 0, 0, 607, '希望镇', 2, '31', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(611, '公寓小屋', '', '', '', '', '2023-12-31 08:48:15', '0000-00-00 00:00:00', 1, '', '这是你在希望小区的公寓小屋，小巧又精致。', 0, 0, 0, 0, '希望镇', 2, '25', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 1, '晴天', '0,0,0', 0, 0, 0, 1, 1, 0),
(612, '公寓走廊', '', '', '45|{r.3}+1', '45|3', '2024-06-10 09:05:11', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 621, 0, 613, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(613, '公寓走廊', '', '', '45|{r.3}+1', '45|3', '2024-06-10 09:05:13', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 0, 612, 614, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(614, '公寓走廊(电梯口)', '', '', '45|{r.3}+1', '45|2', '2024-06-28 02:49:43', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客，一部电梯正在匆忙地运转。', 0, 0, 613, 615, '希望镇', 2, '26', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(615, '公寓走廊', '', '', '45|{r.3}+1', '45|3', '2024-06-28 02:48:23', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 616, 614, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(616, '公寓走廊', '', '', '45|{r.3}+1', '45|1', '2024-06-28 02:47:12', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 615, 617, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(617, '公寓走廊', '', '', '45|{r.3}+1', '45|2', '2024-06-28 02:47:13', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 616, 0, 618, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(618, '公寓走廊', '', '', '45|{r.3}+1', '45|3', '2024-06-10 09:05:06', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 0, 619, 617, '希望镇', 2, '29', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(619, '公寓走廊', '', '', '45|{r.3}+1', '45|2', '2024-06-10 09:05:07', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 0, 621, 618, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(620, '公寓走廊', '', '', '45|{r.3}+1', '45|3', '2023-12-11 15:08:30', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 612, 619, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(621, '公寓走廊', '', '', '45|{r.3}+1', '45|1', '2024-06-10 09:05:08', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 612, 0, 0, 619, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(622, '海角港', '', '', '', '', '2024-06-25 00:27:07', '0000-00-00 00:00:00', 1, '', '这是一个得天独厚丶地理位置优越的港口，常常能看见过往的帆船忙碌。', 0, 0, 0, 0, '卡普斯镇', 24, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '18,-34,0', 1, 1, 0, 1, 0, 0),
(623, '失落暗礁', '', '', '', '', '2024-06-24 21:41:05', '0000-00-00 00:00:00', 1, '', '水下似乎蕴藏着深不可测的秘密，一股骇人的气息从四方传来。', 0, 0, 0, 0, '亚特兰蒂斯', 25, '32', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '-11,21,0', 1, 1, 0, 1, 0, 0),
(624, '基林迪尼港', '', '', '', '', '2024-06-28 08:10:09', '0000-00-00 00:00:00', 1, '', '这个繁华的港口为蒙巴萨的繁华提供了大量的贡献，年吞吐量惊人。', 0, 0, 0, 0, '蒙巴萨城', 26, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '39,-4,0', 1, 1, 0, 1, 0, 0),
(625, '皇后街东', '', '', '', '', '2024-01-10 10:48:33', '0000-00-00 00:00:00', 1, '', '皇后街的东边，是一片广阔的住宅区。', 0, 0, 454, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(626, '荒野', '', '', '', '', '2024-06-27 00:40:52', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，南边是一片辽阔的森林，危险且充满了未知。', 0, 0, 0, 562, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(627, '远古石道', '', '', '', '', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 0, 0, 557, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(628, '远古石道', '', '', '', '', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 557, 0, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(629, '远古石道', '', '', '', '', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 0, 557, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(630, '湖堤', '', '', '18|{r.5}+1', '18|1', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感。', 671, 230, 305, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(631, '瘴气林地', '', '', '', '', '2023-12-25 10:47:20', '0000-00-00 00:00:00', 1, '', '这处充满瘴气的林地位于这座被诅咒的城市外的西南一角。', 0, 0, 0, 267, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(632, '姗妮的小屋', '', '', '68|1', '68|1', '2024-01-11 01:37:12', '0000-00-00 00:00:00', 1, '', '「姗妮」居住的小屋，一半粉色的风格，另一半是蓝色的风格，棕色梯形沙发旁边还放着一只羊驼玩偶。', 618, 0, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 1, 0),
(634, '宁静森林', '', '', '', '', '2024-07-05 03:33:53', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 635, 0, 665, 640, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(635, '宁静森林', '', '', '', '', '2024-07-03 03:21:55', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 636, 634, 0, 641, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(636, '宁静森林', '', '', '', '', '2024-07-03 03:21:55', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 637, 635, 0, 642, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(637, '宁静森林', '', '', '', '', '2024-07-03 03:21:55', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 638, 636, 0, 643, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(638, '宁静森林深处', '', '', '89|1|', '89|1', '2024-07-05 03:34:34', '0000-00-00 00:00:00', 1, '', '这里的乔木更高大了，森林中偶有猛兽咆哮，远在天边近在眼前。', 639, 637, 0, 644, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(639, '宁静森林', '', '', '', '', '2024-07-05 03:34:33', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 638, 0, 645, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(640, '宁静森林', '', '', '', '', '2024-07-05 03:33:54', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 641, 0, 634, 646, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(641, '宁静森林', '', '', '', '', '2024-07-05 03:33:56', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 642, 640, 635, 647, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(642, '宁静森林', '', '', '', '', '2024-07-05 03:34:02', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 643, 641, 636, 648, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(643, '宁静森林', '', '', '88|{r.3}+1|', '88|2', '2024-07-05 03:34:43', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 644, 642, 637, 649, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(644, '宁静森林', '', '', '', '', '2024-07-05 03:34:40', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 645, 643, 638, 650, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(645, '宁静森林', '', '', '', '', '2024-07-05 03:34:32', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 644, 639, 651, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(646, '宁静森林', '', '', '', '', '2024-07-05 03:34:09', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 647, 0, 640, 652, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(647, '宁静森林', '', '', '', '', '2024-07-05 03:33:56', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 648, 646, 641, 653, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(648, '宁静森林', '', '', '', '', '2024-07-05 03:33:57', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 649, 647, 642, 654, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(649, '宁静森林', '', '', '', '', '2024-07-05 03:34:44', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 650, 648, 643, 655, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(650, '宁静森林', '', '', '', '', '2024-07-05 03:34:46', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 651, 649, 644, 656, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(651, '宁静森林', '', '', '', '', '2024-07-05 03:34:21', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 650, 645, 657, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(652, '宁静森林', '', '', '', '', '2024-07-05 03:34:10', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 653, 564, 646, 658, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(653, '宁静森林', '', '', '', '', '2024-07-03 03:21:55', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 654, 652, 647, 659, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(654, '宁静森林', '', '', '', '', '2024-07-05 03:33:58', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 655, 653, 648, 660, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(655, '宁静森林', '', '', '', '', '2024-07-05 03:33:59', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 656, 654, 649, 661, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(656, '宁静森林', '', '', '', '', '2024-07-05 03:34:19', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 657, 655, 650, 662, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(657, '宁静森林', '', '', '', '', '2024-07-05 03:34:20', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 656, 651, 663, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(658, '宁静森林', '', '', '', '', '2024-07-05 03:34:11', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 659, 559, 652, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(659, '宁静森林', '', '', '', '', '2024-07-05 03:34:12', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 660, 658, 653, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(660, '宁静森林', '', '', '', '', '2024-07-05 03:34:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 661, 659, 654, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(661, '宁静森林', '', '', '', '', '2024-07-05 03:34:16', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 662, 660, 655, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(662, '宁静森林', '', '', '', '', '2024-07-05 03:34:18', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 663, 661, 656, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(663, '宁静森林', '', '', '', '', '2024-07-05 03:34:26', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 662, 657, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(664, '荒野哨站', '', '', '23|3', '23|3', '2024-07-03 00:50:12', '0000-00-00 00:00:00', 1, '', '希望镇设立在原野上的一处哨站，负责警示两片森林的异常。', 0, 235, 559, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(665, '铁索桥头', '', '', '', '', '2024-07-05 03:34:06', '0000-00-00 00:00:00', 1, '', '这座铁索桥摇摇欲坠，一看就年代久远，还是不要随便上去吧。', 0, 0, 0, 634, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(666, '皇后街北', '', '', '', '', '2024-01-10 10:48:29', '0000-00-00 00:00:00', 1, '', '皇后街的北部。', 0, 454, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(667, '黑雾城北', '', '', '', '', '2023-12-25 01:43:06', '0000-00-00 00:00:00', 1, '', '这里是黑雾城的北部，人声鼎沸，市场繁荣，许多变异异兽材料和物资在此交易。', 0, 269, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(668, '凯旋之门', '', '', '', '', '2023-12-25 10:40:20', '0000-00-00 00:00:00', 1, '', '比起西北的机械之门，这座城门更加古朴大气。', 269, 0, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(669, '湖中小岛', '', '', '', '', '2024-06-11 11:21:32', '0000-00-00 00:00:00', 1, '', '玄武湖中心的一处小岛，视野开阔，妙趣横生，是许多文人雅士流连忘返的地方。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(670, '木屋', '', '', '77|1|%7Bu.tasks.t15%7D%21%3D2', '77|1', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '这座神秘的山谷里为什么会立着这样一座木屋?', 0, 572, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(671, '湖堤', '', '', '18|{r.3}+4', '18|6', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感。', 0, 630, 574, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(672, '湖堤', '', '', '', '', '2024-07-06 23:32:07', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感，湖泊中的水蜿蜒从面前的小河流出。', 230, 0, 575, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(673, '嗜血巷', '', '', '', '', '2024-07-05 13:42:47', '0000-00-00 00:00:00', 1, '', '生存法则，无止境的斗争以及不断刷新的底线，FCPD的职员们最不想来的区域之一。', 674, 244, 675, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(674, '嗜血巷', '', '', '', '', '2024-07-05 13:50:05', '0000-00-00 00:00:00', 1, '', '生存法则，无止境的斗争以及不断刷新的底线，FCPD的职员们最不想来的区域之一。', 0, 673, 676, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(675, '威利斯大厦大厅', '', '', '', '', '2024-07-05 13:43:05', '0000-00-00 00:00:00', 1, '', '威利斯大厦的大厅，躺着几个流浪汉，这是一座比较有年头的建筑了，因为租金便宜住着不少低收入者以及赛博成瘾者。', 0, 0, 0, 673, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(676, '迪赞尔17号街', '', '', '', '', '2024-06-11 11:20:28', '0000-00-00 00:00:00', 1, '', '灯红酒绿，廉价的酒精的气味以及粗糙的胭脂粉味，宣泄自己的好去处。', 0, 0, 0, 674, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(677, '赛西的梦中幻境', '', '', '81|{r.3}+1', '81|1', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '粉色的云团像水一般往上流动，蒲公英轻飘飘的，蓝紫相间的丝带突然出现又突然消失，留下天空中一抹淡淡的幻香。', 679, 0, 0, 0, '旧街', 1, '36', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '未知', '0,0,0', 0, 0, 0, 1, 1, 1),
(678, '@01c7fc@马哈赞加湾@end@', '', '', '', '', '2024-06-28 08:32:21', '0000-00-00 00:00:00', 1, '', '一座像月亮一样的港湾，皎洁美丽，塞恩人相信这是月亮女神的赐予。', 0, 686, 0, 685, '塞恩古城', 29, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '46,-15,0', 1, 1, 0, 1, 0, 0),
(679, '赛西的梦中幻境', '', '', '81|{r.4}+1', '81|4', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '粉色是这里唯一的旋律，奇幻的造物此起彼伏，美不胜收。', 0, 677, 683, 682, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '未知', '0,0,0', 0, 0, 0, 1, 1, 1),
(682, '赛西的梦中幻境', '', '', '81|{r.3}+2', '81|4', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '粉色是这里唯一的旋律，奇幻的造物此起彼伏，美不胜收。', 0, 0, 679, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(683, '赛西的梦中幻境', '', '', '81|{r.3}+2', '81|2', '2024-07-03 07:31:53', '0000-00-00 00:00:00', 1, '', '粉色是这里唯一的旋律，奇幻的造物此起彼伏，美不胜收。', 0, 0, 0, 679, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0),
(685, '海滨小道', '', '', '', '', '2024-06-28 08:30:18', '0000-00-00 00:00:00', 1, '', '踏入这条小路时，仿佛走进了一个充满热带风情的画卷。小路两旁，郁郁葱葱的热带植物簇拥着，为您带来阵阵清新的海风。阳光透过树叶的缝隙洒在地面上，形成斑驳的光影，给人一种宁静而惬意的感觉。', 0, 0, 678, 0, '塞恩古城', 29, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0),
(686, '海滨小道', '', '', '', '', '2024-06-28 08:30:21', '0000-00-00 00:00:00', 1, '', '踏入这条小路时，仿佛走进了一个充满热带风情的画卷。小路两旁，郁郁葱葱的热带植物簇拥着，为您带来阵阵清新的海风。阳光透过树叶的缝隙洒在地面上，形成斑驳的光影，给人一种宁静而惬意的感觉。', 678, 0, 0, 0, '塞恩古城', 29, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_map_op`
--

CREATE TABLE `system_map_op` (
  `belong` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `show_cond` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '未命名',
  `link_event` int(11) NOT NULL,
  `link_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_map_op`
--

INSERT INTO `system_map_op` (`belong`, `id`, `show_cond`, `name`, `link_event`, `link_task`) VALUES
(225, 1, '', '无名石碑', 6, 0),
(226, 2, '', '垃圾桶', 9, 0),
(297, 5, '', '褶皱的报纸', 10, 0),
(294, 6, '', '路灯', 11, 0),
(306, 7, '', '一半的咖啡杯', 12, 0),
(307, 8, '', '查看封口', 13, 0),
(306, 9, '', '老式台灯', 15, 0),
(295, 10, '{u.tasks.t8}==2', '进入帐篷', 17, 0),
(309, 11, '', '爬出暗道', 24, 0),
(232, 12, '{u.fix_bridge}==0', '断桥', 25, 0),
(297, 13, '', '损坏的通讯机', 26, 0),
(235, 14, '', '进入希望镇', 27, 0),
(239, 15, '', '人型雕像', 28, 0),
(287, 16, '', '出门', 29, 0),
(274, 17, '', '打随机不同数个老鼠和泥怪', 30, 0),
(437, 18, '', 'H-W-003终端', 33, 0),
(359, 19, '', '查看小水池', 39, 0),
(452, 20, '', '爬上高架', 47, 0),
(482, 21, '', '回到暗道', 49, 0),
(232, 22, '{u.fix_bridge}==0', '修理断桥', 51, 0),
(232, 23, '{u.fix_bridge}==1', '过桥', 52, 0),
(554, 24, '', '离开小屋', 69, 0),
(611, 25, '', '离开小屋', 70, 0),
(614, 26, '', '乘坐电梯', 71, 0),
(442, 27, '', '无名墓碑', 81, 0),
(493, 28, '', '乘坐电梯', 83, 0),
(618, 29, '{u.tomorrow_1_floor}==3', '敲门', 85, 0),
(608, 30, '', '培养液立体药罐', 87, 0),
(609, 31, '', 'E-314发电机终端', 88, 0),
(623, 32, '', '红色珊瑚石礁', 89, 0),
(546, 33, '', '跳向古藤条', 90, 0),
(333, 34, '', '爬上古藤条', 91, 0),
(554, 35, '{u.tasks.t13}==1', '六芒星阵', 102, 0),
(677, 36, '{u.tasks.t13}==1', '粉色五角星阵', 103, 0),
(278, 37, '', '输入事件测试', 111, 0),
(338, 38, '', '老鼠群', 113, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_mk`
--

CREATE TABLE `system_mk` (
  `mk_id` int(11) NOT NULL,
  `mk_item_root` int(11) NOT NULL COMMENT '资源对应物品id',
  `mk_name` varchar(255) NOT NULL,
  `mk_desc` varchar(255) NOT NULL,
  `mk_rarity` int(1) NOT NULL COMMENT '稀有度，0为最低级，9为最高级',
  `mk_renew_time` int(11) NOT NULL COMMENT '刷新时间，以秒为单位',
  `mk_pick_cond` text NOT NULL COMMENT '采集条件表达式',
  `mk_action_name` varchar(255) NOT NULL COMMENT '采集动作名称，eg:矿石用挖矿、树木用砍伐'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='资源设计表';

-- --------------------------------------------------------

--
-- 表的结构 `system_money_type`
--

CREATE TABLE `system_money_type` (
  `rid` varchar(11) NOT NULL COMMENT '货币标识',
  `rname` varchar(255) NOT NULL COMMENT '货币名称',
  `runit` varchar(255) NOT NULL COMMENT '货币单位',
  `rif_default` int(1) NOT NULL COMMENT '是否默认货币'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_money_type`
--

INSERT INTO `system_money_type` (`rid`, `rname`, `runit`, `rif_default`) VALUES
('money', '信用币', '张', 1),
('money2', '教会币', '张', 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_npc`
--

CREATE TABLE `system_npc` (
  `narea_id` int(11) NOT NULL,
  `narea_name` varchar(255) NOT NULL,
  `nid` int(11) UNSIGNED NOT NULL,
  `nstate` int(1) NOT NULL DEFAULT '0',
  `nkill` int(1) NOT NULL DEFAULT '0',
  `nnot_dead` int(1) NOT NULL DEFAULT '0',
  `nchuck` int(1) NOT NULL DEFAULT '0',
  `nrefresh_time` int(255) NOT NULL DEFAULT '0',
  `nshop` int(1) NOT NULL DEFAULT '0',
  `nhock_shop` int(1) NOT NULL DEFAULT '0',
  `naccept_give` int(1) NOT NULL DEFAULT '0',
  `nname` text CHARACTER SET utf8 NOT NULL,
  `nexp` int(11) NOT NULL,
  `nlvl` int(11) NOT NULL,
  `nsex` varchar(255) NOT NULL,
  `ndesc` text CHARACTER SET utf8 NOT NULL,
  `nequips` text NOT NULL,
  `ndrop_exp` text NOT NULL,
  `ndrop_money` text NOT NULL,
  `ndrop_item` text NOT NULL,
  `ndrop_item_type` int(1) NOT NULL COMMENT '0直接到背包，1掉落到地上',
  `nskills` text NOT NULL,
  `nshop_item_id` varchar(255) NOT NULL,
  `nmuban` text NOT NULL,
  `nshop_cond` text NOT NULL COMMENT '交易条件，包括购买和出售',
  `ntaskid` text NOT NULL,
  `nnick_name` varchar(255) NOT NULL DEFAULT '',
  `nhp` int(11) NOT NULL DEFAULT '100',
  `nmaxhp` int(11) NOT NULL DEFAULT '100',
  `ngj` int(11) NOT NULL DEFAULT '0',
  `nfy` int(11) NOT NULL DEFAULT '1',
  `nimage` varchar(255) NOT NULL DEFAULT '',
  `nop_target` varchar(255) NOT NULL,
  `ntask_target` varchar(255) NOT NULL,
  `ncreat_event_id` int(11) NOT NULL,
  `nlook_event_id` int(11) NOT NULL,
  `nattack_event_id` int(11) NOT NULL,
  `nwin_event_id` int(11) NOT NULL,
  `ndefeat_event_id` int(11) NOT NULL,
  `npet_event_id` int(11) NOT NULL,
  `nshop_event_id` int(11) NOT NULL,
  `nup_event_id` int(11) NOT NULL,
  `nheart_event_id` int(11) NOT NULL,
  `nminute_event_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `system_npc`
--

INSERT INTO `system_npc` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`) VALUES
(1, '旧街', 11, 0, 0, 0, 0, 0, 0, 0, 1, '莉莉安', 1, 1, '女', '她看起来三十多岁，一头金色波浪，脸上长着雀斑。', '', '', '', '', 0, '', '', '', '', '1,2', '', 100, 100, 10, 0, '', '', '1,3,10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 13, 0, 0, 0, 0, 0, 0, 0, 1, '格兰特', 0, 1, '男', '他满脸灰尘，此刻正双腿交叉坐在自己的坐布上，右手还拎着一瓶欧念。', '', '', '', '', 0, '', '', '', '', '24', '', 100, 100, 1, 1, '', '', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 14, 0, 0, 0, 0, 0, 1, 0, 0, '赫炳', 0, 1, '男', '是一个艺术家，可惜生在了这个时代，靠在街头帮雇佣兵写字养家糊口。', '', '', '', '', 0, '', '23|1', '', '', '28', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 15, 0, 0, 0, 0, 0, 1, 0, 0, '周富贵', 0, 10, '男', '来看看,都是荒野上淘来的好货!', '', '', '', '', 0, '', '18|10', '商店.php', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 16, 0, 0, 0, 0, 0, 0, 0, 0, '王小波', 0, 6, '男', '拥有一身好气力，有各种表演的绝活，卖艺为生。', '', '', '', '', 0, '', '', '技能兑换.php', '', '', '', 100, 100, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(1, '旧街', 17, 0, 0, 0, 0, 0, 1, 0, 1, '薇儿', 0, 1, '女', '她看起来三十多岁，听说是个从荒野捡回来的失忆小女孩，她的养父「卡尔萨斯」给她取名「薇儿」。', '', '', '', '', 0, '', '1|99', '治疗.php', '', '', '', 100, 100, 1, 1, '', '2', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 19, 0, 0, 0, 0, 0, 0, 0, 0, '符箓大师', 0, 0, '男', '技能大师，负责兑换技能', '', '', '', '', 0, '', '', '技能兑换.php', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 20, 0, 0, 0, 0, 0, 0, 0, 0, '小蛮', 0, 0, '女', '小蛮好怕...', '', '', '', '', 0, '', '', '', '', '20', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 21, 0, 0, 0, 0, 0, 0, 0, 0, '蛮族长老', 0, 0, '男', '蛮族长老', '', '', '', '', 0, '', '', '', '', '19', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 22, 0, 0, 0, 0, 0, 0, 0, 0, '蛮族猎手', 0, 0, '男', '老了,干不动了', '', '', '', '', 0, '', '', '', '', '21', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情!', '', '', '', '', 0, '', '', '', '', '27', '', 1000, 1000, 50, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, '智慧山脊', 24, 0, 0, 0, 0, 0, 0, 0, 0, '羁旅者', 0, 50, '男', '没人知道他的来历，但没人敢轻视他。', '', '', '', '', 0, '', '', '治疗_级别1.php', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 26, 0, 0, 0, 0, 0, 0, 0, 0, '小乞丐', 0, 1, '男', '骨瘦如柴，龟缩在一栋砖瓦房的墙角，正瑟瑟发抖。', '', '', '', '', 0, '', '', '门派管理员.php', '', '', '', 100, 100, 1, 1, '', '7', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '安宁海滨', 34, 0, 0, 0, 0, 0, 1, 0, 0, '渔民', 0, 1, '男', '一个皮肤黝黑粗糙的中年男人，戴着顶斗笠，穿着长衣长裤，今天的收获还不错，再这么持续一段日子，他就能换掉自己漏风的斗笠了吧。', '', '', '', '', 0, '', '', '', '{u.lang_anni}>=4', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 35, 0, 0, 0, 0, 0, 1, 1, 1, '瓦尔金', 0, 1, '男', '他看起来有五十多岁了，脸上皱纹和伤疤已经分不清了，头上的白发和金发也难以辨别。', '', '', '', '', 0, '', '5|1,74|1,105|1,112|1', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 36, 0, 0, 0, 0, 0, 1, 0, 0, '杰德', 0, 1, '男', '一个旅行商人，但由于什么原因，在旧街停留了好长一阵子。', '', '', '', '', 0, '', '11|3,73|1,80|1', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 37, 0, 0, 0),
(1, '旧街', 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 47, 0, 0, 0, 0, 0, 0, 0, 0, '卡斯珀神父', 0, 10, '男', '希望神教遍布了这片土地，他是希望神教在希望镇的一个教父，负责传教以及给信徒排忧解惑！', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '4', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 41, 0, 0, 0, 0, 0, 1, 1, 0, '安妮', 0, 1, '女', '她生得金发碧眼，很是抚媚，看起来二十几岁。', '', '', '', '', 0, '', '7|1,21|1,22|1,71|1', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 48, 0, 1, 0, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '兵器_1_46,防具_4_7,防具_5_22', '', '', '', 0, '1|1', '', '', '', '', '', 19980925, 19980925, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 49, 0, 0, 0, 0, 0, 0, 0, 0, '歌尔特', 0, 10, '男', '经营着一个佣兵集团的佣兵头子，经常会发布一些悬赏任务，正在拿着一本羊皮笔记本写着什么。', '', '', '', '', 0, '1|10', '', '', '', '', '风啸佣兵团团长', 100, 100, 1, 1, '', '6,5', '4,8,7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 50, 0, 0, 0, 0, 0, 1, 0, 1, '皮格', 0, 1, '男', '胖胖的中年男人，发明了很多〝黑暗料理〞，只有尝过的人才知道，不可名状之物的味道竟然出奇地好！不过他有个怪脾气，卖东西只卖给投缘的人。', '', '', '', '', 0, '', '28|6', '', '{u.tasks.t5} ==2', '', '', 100, 100, 1, 1, '', '', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 52, 0, 0, 0, 0, 0, 0, 0, 1, '迪伦斯', 0, 1, '男', '他似乎看起来精神状态不太好，披头散发的，也不知道能不能活到明天。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '6', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 62, 0, 0, 0, 0, 0, 0, 0, 0, '威尔海姆', 0, 10, '男', '他就是经营旧吧的老板，右手戴着一个奇怪的戒指，脸上写满了沧桑与故事。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '安宁海滨', 54, 0, 0, 0, 0, 0, 0, 0, 0, '苏加诺', 0, 1, '男', '一个中年男人，留着一脸的络腮胡，是安宁城对外的贸易官。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 56, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼王', 0, 10, '母', '一头母灰狼，体型比一般灰狼更大，经历某种不知名突变，尾巴颜色带上了一点淡淡的红光。', '', '', '', '', 0, '3|2', '', '', '', '', '', 1000, 1000, 60, 30, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 59, 0, 0, 0, 0, 0, 0, 0, 0, '卡尔萨斯', 0, 1, '男', '浮沉诊所的主人，留着一脸大胡子，是附近医术最好的医生。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '13', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 60, 0, 0, 0, 0, 0, 0, 0, 0, '维奇', 0, 6, '男', '他通过层层选拔被选中为岗哨，成为了旧街居民发现危险的眼睛。', '', '', '', '', 0, '', '', '', '', '', '旧街的岗哨', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '13', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 63, 0, 0, 0, 0, 0, 1, 0, 1, '黛西', 0, 10, '女', '她是酒吧的女仆，看起来身材消瘦，但长着一双水汪汪的大眼睛，性感的小嘴唇，楚楚动人。', '', '', '', '', 0, '', '64|1,117|1,65|1', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', 420, 420, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3', '', '', '', '', '', 120, 120, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 68, 0, 0, 0, 0, 0, 0, 0, 0, '姗妮', 0, 0, '女', '一个艳丽的女人，举手投足间都散发着魅力，黄色的波浪发丝，每舞动一次就带起了一次迷人的涟漪。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '9', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 70, 0, 0, 0, 0, 0, 0, 0, 0, '马修', 0, 1, '男', '他是希望镇生产中心的负责人，总是戴着一个单片眼镜和一支蓝紫色的钢笔。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '迷雾森林', 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', 480, 480, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 73, 0, 0, 0, 0, 0, 0, 0, 0, '达克莱尔', 0, 1, '男', '一个穿着灰色长衣的中年男人，是希望镇的大工程师，负责发电站的技术工作。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 74, 0, 0, 0, 0, 0, 0, 0, 0, '巴尔克', 0, 1, '男', '穿着一身白色长衫，一脸忧郁的样子。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 75, 0, 0, 0, 0, 0, 0, 0, 0, '凌影', 0, 1, '男', '他就是希望镇这一届的代理镇长，气宇轩昂，高深莫测。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '18', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '希望镇', 76, 0, 0, 0, 0, 0, 0, 0, 0, '特蕾莎', 0, 1, '女', '她眼神坚毅，没有寻常女子的粉雕玉啄，偏黄的肤色上汗水正往地上滴落...', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 77, 0, 0, 0, 0, 0, 0, 0, 0, 'K-M', 0, 0, '男', '一个全身裹着风衣的奇怪男人，戴着一副很奇特的眼镜。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '12,15,16,17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 78, 0, 0, 0, 0, 0, 0, 0, 0, '钟七隐', 0, 0, '', '一位耄耋老人，不知道于此作甚。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 79, 0, 0, 0, 0, 0, 0, 0, 0, '赫米特', 0, 0, '女', '他穿着一身棕色的兽衣，背着一把复合弓，似乎正在瞄准什么。', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 80, 0, 0, 0, 0, 0, 0, 0, 0, '任务测试怪', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '11', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 82, 0, 0, 0, 0, 0, 0, 0, 0, '测试', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(0, '未分区', 83, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 84, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 85, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 86, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1, '旧街', 87, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', 100, 100, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, '宁静森林', 88, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎', 0, 10, '公', '这是一头经过变异的老虎，一双锋利的牙齿异常瘆人。', '', '{r.100}', '', '139|{r.2}', 0, '2|4,3|6', '', '', '', '', '', 1000, 1000, 120, 70, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, '宁静森林', 89, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎王', 0, 15, '公', '这是一头经过变异的巨齿虎王，是凶残的王者，一双锋利的牙齿异常瘆人。', '', '{r.5000}+2000', '', '146|{r.3}==1?1:0', 0, '2|4,3|6', '', '', '', '', '', 3000, 3000, 200, 120, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_npc_midguaiwu`
--

CREATE TABLE `system_npc_midguaiwu` (
  `ngid` int(11) NOT NULL COMMENT '怪物id主键',
  `ncreate_time` datetime NOT NULL,
  `nsid` text NOT NULL COMMENT '归属者',
  `narea_id` int(11) NOT NULL,
  `narea_name` varchar(255) NOT NULL,
  `nmid` int(11) NOT NULL COMMENT '怪物所属地图id',
  `nid` int(11) UNSIGNED NOT NULL COMMENT '怪物真实id',
  `nstate` int(1) NOT NULL DEFAULT '0' COMMENT '是否战斗中',
  `nkill` int(1) NOT NULL DEFAULT '0',
  `nnot_dead` int(1) NOT NULL DEFAULT '0',
  `nchuck` int(1) NOT NULL DEFAULT '0',
  `nrefresh_time` int(255) NOT NULL DEFAULT '0',
  `nshop` int(1) NOT NULL DEFAULT '0',
  `nhock_shop` int(1) NOT NULL DEFAULT '0',
  `naccept_give` int(1) NOT NULL DEFAULT '0',
  `nname` text CHARACTER SET utf8 NOT NULL,
  `nexp` int(11) NOT NULL,
  `nlvl` int(11) NOT NULL,
  `nsex` varchar(255) NOT NULL,
  `ndesc` text CHARACTER SET utf8 NOT NULL,
  `nequips` text NOT NULL,
  `ndrop_exp` text NOT NULL,
  `ndrop_money` text NOT NULL,
  `ndrop_item` text NOT NULL,
  `ndrop_item_type` int(1) NOT NULL,
  `nskills` text NOT NULL,
  `nshop_item_id` varchar(255) NOT NULL,
  `nshop_cond` text NOT NULL,
  `nmuban` text NOT NULL,
  `ntaskid` text NOT NULL,
  `nnick_name` varchar(255) DEFAULT '',
  `nhp` int(11) NOT NULL DEFAULT '100',
  `nmaxhp` int(11) NOT NULL DEFAULT '100',
  `ngj` int(11) DEFAULT '0',
  `nfy` int(11) DEFAULT '1',
  `nimage` varchar(255) DEFAULT '',
  `nop_target` varchar(255) DEFAULT NULL,
  `ntask_target` varchar(255) DEFAULT NULL,
  `ncreat_event_id` int(11) NOT NULL,
  `nlook_event_id` int(11) NOT NULL,
  `nattack_event_id` int(11) NOT NULL,
  `nwin_event_id` int(11) NOT NULL,
  `ndefeat_event_id` int(11) NOT NULL,
  `npet_event_id` int(11) NOT NULL,
  `nshop_event_id` int(11) NOT NULL,
  `nup_event_id` int(11) NOT NULL,
  `nheart_event_id` int(11) NOT NULL,
  `nminute_event_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `system_npc_midguaiwu`
--

INSERT INTO `system_npc_midguaiwu` (`ngid`, `ncreate_time`, `nsid`, `narea_id`, `narea_name`, `nmid`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nshop_cond`, `nmuban`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`) VALUES
(5759, '2024-07-03 07:31:51', '', 1, '旧街', 377, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5806, '2024-07-03 07:31:51', '', 1, '旧街', 405, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5669, '2024-07-03 07:31:15', '', 23, '迷雾森林', 588, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5678, '2024-07-03 07:31:16', '', 23, '迷雾森林', 596, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5758, '2024-07-03 07:31:51', '', 1, '旧街', 376, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5677, '2024-07-03 07:31:16', '', 23, '迷雾森林', 596, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5676, '2024-07-03 07:31:16', '', 23, '迷雾森林', 596, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5925, '2024-07-04 00:31:31', '', 23, '迷雾森林', 591, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6280, '2024-07-22 12:07:16', '', 1, '旧街', 398, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6363, '2024-07-23 11:17:56', '', 1, '旧街', 346, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5683, '2024-07-03 07:31:16', '', 23, '迷雾森林', 602, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5682, '2024-07-03 07:31:16', '', 23, '迷雾森林', 602, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2135, '2024-01-11 00:33:42', '', 1, '旧街', 275, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5750, '2024-07-03 07:31:51', '', 1, '旧街', 370, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2142, '2024-01-11 00:33:42', '', 1, '旧街', 275, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2137, '2024-01-11 00:33:42', '', 1, '旧街', 275, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5765, '2024-07-03 07:31:51', '', 1, '旧街', 382, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2140, '2024-01-11 00:33:42', '', 1, '旧街', 275, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5713, '2024-07-03 07:31:50', '', 1, '旧街', 353, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5872, '2024-07-03 07:31:52', '', 1, '旧街', 435, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5831, '2024-07-03 07:31:52', '', 1, '旧街', 418, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5837, '2024-07-03 07:31:52', '', 1, '旧街', 421, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5708, '2024-07-03 07:31:50', '', 1, '旧街', 351, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2141, '2024-01-11 00:33:42', '', 1, '旧街', 275, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5860, '2024-07-03 07:31:52', '', 1, '旧街', 429, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5859, '2024-07-03 07:31:52', '', 1, '旧街', 429, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5717, '2024-07-03 07:31:50', '', 1, '旧街', 356, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5711, '2024-07-03 07:31:50', '', 1, '旧街', 352, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5710, '2024-07-03 07:31:50', '', 1, '旧街', 352, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5709, '2024-07-03 07:31:50', '', 1, '旧街', 352, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6284, '2024-07-22 12:07:38', '', 1, '旧街', 372, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5930, '2024-07-04 00:31:35', '', 23, '迷雾森林', 584, 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', 480, 480, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5718, '2024-07-03 07:31:50', '', 1, '旧街', 357, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6283, '2024-07-22 12:07:38', '', 1, '旧街', 372, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5857, '2024-07-03 07:31:52', '', 1, '旧街', 428, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5807, '2024-07-03 07:31:51', '', 1, '旧街', 405, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5805, '2024-07-03 07:31:51', '', 1, '旧街', 405, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5865, '2024-07-03 07:31:52', '', 1, '旧街', 431, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5873, '2024-07-03 07:31:52', '', 1, '旧街', 435, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5868, '2024-07-03 07:31:52', '', 1, '旧街', 433, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5810, '2024-07-03 07:31:51', '', 1, '旧街', 407, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3479, '2024-06-15 13:03:59', 'f4cd01caaf9ec17c03413de91b97b5f2', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 46, 50, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5738, '2024-07-03 07:31:50', '', 1, '旧街', 364, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6090, '2024-07-06 04:15:27', '', 1, '旧街', 373, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6089, '2024-07-06 04:15:27', '', 1, '旧街', 373, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5851, '2024-07-03 07:31:52', '', 1, '旧街', 426, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5854, '2024-07-03 07:31:52', '', 1, '旧街', 427, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5760, '2024-07-03 07:31:51', '', 1, '旧街', 378, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5769, '2024-07-03 07:31:51', '', 1, '旧街', 386, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5741, '2024-07-03 07:31:50', '', 1, '旧街', 366, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5740, '2024-07-03 07:31:50', '', 1, '旧街', 366, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5739, '2024-07-03 07:31:50', '', 1, '旧街', 365, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2136, '2024-01-11 00:33:42', '', 1, '旧街', 275, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5749, '2024-07-03 07:31:51', '', 1, '旧街', 370, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5743, '2024-07-03 07:31:50', '', 1, '旧街', 367, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5744, '2024-07-03 07:31:50', '', 1, '旧街', 368, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5821, '2024-07-03 07:31:51', '', 1, '旧街', 412, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5746, '2024-07-03 07:31:50', '', 1, '旧街', 369, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6287, '2024-07-22 12:07:41', '', 1, '旧街', 359, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5763, '2024-07-03 07:31:51', '', 1, '旧街', 381, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5761, '2024-07-03 07:31:51', '', 1, '旧街', 380, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5748, '2024-07-03 07:31:51', '', 1, '旧街', 370, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5751, '2024-07-03 07:31:51', '', 1, '旧街', 371, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6297, '2024-07-22 13:43:32', '', 1, '旧街', 308, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6294, '2024-07-22 13:43:31', '', 1, '旧街', 338, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5714, '2024-07-03 07:31:50', '', 1, '旧街', 354, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6094, '2024-07-06 04:15:40', '', 1, '旧街', 387, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5768, '2024-07-03 07:31:51', '', 1, '旧街', 386, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5767, '2024-07-03 07:31:51', '', 1, '旧街', 384, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5764, '2024-07-03 07:31:51', '', 1, '旧街', 382, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5762, '2024-07-03 07:31:51', '', 1, '旧街', 381, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5784, '2024-07-03 07:31:51', '', 1, '旧街', 394, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5776, '2024-07-03 07:31:51', '', 1, '旧街', 390, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5766, '2024-07-03 07:31:51', '', 1, '旧街', 383, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5848, '2024-07-03 07:31:52', '', 1, '旧街', 425, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5864, '2024-07-03 07:31:52', '', 1, '旧街', 431, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5778, '2024-07-03 07:31:51', '', 1, '旧街', 391, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5779, '2024-07-03 07:31:51', '', 1, '旧街', 392, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5787, '2024-07-03 07:31:51', '', 1, '旧街', 395, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5783, '2024-07-03 07:31:51', '', 1, '旧街', 394, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5781, '2024-07-03 07:31:51', '', 1, '旧街', 393, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5803, '2024-07-03 07:31:51', '', 1, '旧街', 403, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5820, '2024-07-03 07:31:51', '', 1, '旧街', 412, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5782, '2024-07-03 07:31:51', '', 1, '旧街', 394, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5816, '2024-07-03 07:31:51', '', 1, '旧街', 409, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5795, '2024-07-03 07:31:51', '', 1, '旧街', 399, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5786, '2024-07-03 07:31:51', '', 1, '旧街', 395, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5785, '2024-07-03 07:31:51', '', 1, '旧街', 395, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5788, '2024-07-03 07:31:51', '', 1, '旧街', 396, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5789, '2024-07-03 07:31:51', '', 1, '旧街', 396, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5736, '2024-07-03 07:31:50', '', 1, '旧街', 363, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2139, '2024-01-11 00:33:42', '', 1, '旧街', 275, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5870, '2024-07-03 07:31:52', '', 1, '旧街', 434, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5790, '2024-07-03 07:31:51', '', 1, '旧街', 397, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5745, '2024-07-03 07:31:50', '', 1, '旧街', 369, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5747, '2024-07-03 07:31:51', '', 1, '旧街', 370, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5794, '2024-07-03 07:31:51', '', 1, '旧街', 399, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6282, '2024-07-22 12:07:16', '', 1, '旧街', 398, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5813, '2024-07-03 07:31:51', '', 1, '旧街', 408, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5793, '2024-07-03 07:31:51', '', 1, '旧街', 399, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5792, '2024-07-03 07:31:51', '', 1, '旧街', 399, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5812, '2024-07-03 07:31:51', '', 1, '旧街', 408, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5797, '2024-07-03 07:31:51', '', 1, '旧街', 400, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5796, '2024-07-03 07:31:51', '', 1, '旧街', 400, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5799, '2024-07-03 07:31:51', '', 1, '旧街', 401, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5798, '2024-07-03 07:31:51', '', 1, '旧街', 401, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5801, '2024-07-03 07:31:51', '', 1, '旧街', 402, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5802, '2024-07-03 07:31:51', '', 1, '旧街', 403, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5800, '2024-07-03 07:31:51', '', 1, '旧街', 402, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5804, '2024-07-03 07:31:51', '', 1, '旧街', 404, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5845, '2024-07-03 07:31:52', '', 1, '旧街', 424, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5808, '2024-07-03 07:31:51', '', 1, '旧街', 406, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5809, '2024-07-03 07:31:51', '', 1, '旧街', 407, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5811, '2024-07-03 07:31:51', '', 1, '旧街', 408, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5815, '2024-07-03 07:31:51', '', 1, '旧街', 409, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5814, '2024-07-03 07:31:51', '', 1, '旧街', 409, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5817, '2024-07-03 07:31:51', '', 1, '旧街', 410, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5828, '2024-07-03 07:31:51', '', 1, '旧街', 416, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5818, '2024-07-03 07:31:51', '', 1, '旧街', 411, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5847, '2024-07-03 07:31:52', '', 1, '旧街', 425, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5819, '2024-07-03 07:31:51', '', 1, '旧街', 412, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5838, '2024-07-03 07:31:52', '', 1, '旧街', 421, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5822, '2024-07-03 07:31:51', '', 1, '旧街', 413, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5830, '2024-07-03 07:31:52', '', 1, '旧街', 417, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5823, '2024-07-03 07:31:51', '', 1, '旧街', 414, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5825, '2024-07-03 07:31:51', '', 1, '旧街', 415, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5824, '2024-07-03 07:31:51', '', 1, '旧街', 415, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5827, '2024-07-03 07:31:51', '', 1, '旧街', 416, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5826, '2024-07-03 07:31:51', '', 1, '旧街', 416, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5829, '2024-07-03 07:31:52', '', 1, '旧街', 417, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5835, '2024-07-03 07:31:52', '', 1, '旧街', 420, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5834, '2024-07-03 07:31:52', '', 1, '旧街', 420, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5832, '2024-07-03 07:31:52', '', 1, '旧街', 419, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5850, '2024-07-03 07:31:52', '', 1, '旧街', 426, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5833, '2024-07-03 07:31:52', '', 1, '旧街', 420, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5840, '2024-07-03 07:31:52', '', 1, '旧街', 422, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5842, '2024-07-03 07:31:52', '', 1, '旧街', 423, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5836, '2024-07-03 07:31:52', '', 1, '旧街', 421, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5839, '2024-07-03 07:31:52', '', 1, '旧街', 422, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5853, '2024-07-03 07:31:52', '', 1, '旧街', 427, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5841, '2024-07-03 07:31:52', '', 1, '旧街', 423, 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '37|1', 0, '3|2', '', '', '', '', '', 360, 360, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5844, '2024-07-03 07:31:52', '', 1, '旧街', 424, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5843, '2024-07-03 07:31:52', '', 1, '旧街', 424, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5846, '2024-07-03 07:31:52', '', 1, '旧街', 425, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5849, '2024-07-03 07:31:52', '', 1, '旧街', 426, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5889, '2024-07-03 07:31:53', '', 1, '旧街', 671, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5852, '2024-07-03 07:31:52', '', 1, '旧街', 427, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5856, '2024-07-03 07:31:52', '', 1, '旧街', 428, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5855, '2024-07-03 07:31:52', '', 1, '旧街', 428, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5862, '2024-07-03 07:31:52', '', 1, '旧街', 430, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5858, '2024-07-03 07:31:52', '', 1, '旧街', 429, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5861, '2024-07-03 07:31:52', '', 1, '旧街', 430, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5863, '2024-07-03 07:31:52', '', 1, '旧街', 431, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5866, '2024-07-03 07:31:52', '', 1, '旧街', 432, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5867, '2024-07-03 07:31:52', '', 1, '旧街', 433, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5869, '2024-07-03 07:31:52', '', 1, '旧街', 434, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2133, '2024-01-11 00:33:42', '', 1, '旧街', 275, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2138, '2024-01-11 00:33:42', '', 1, '旧街', 275, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5871, '2024-07-03 07:31:52', '', 1, '旧街', 435, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5874, '2024-07-03 07:31:52', '', 1, '旧街', 436, 56, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼王', 0, 10, '母', '一头母灰狼，体型比一般灰狼更大，经历某种不知名突变，尾巴颜色带上了一点淡淡的红光。', '', '', '', '', 0, '3|2', '', '', '', '', '', 1000, 1000, 60, 30, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6295, '2024-07-22 13:43:32', '', 1, '旧街', 308, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5737, '2024-07-03 07:31:50', '', 1, '旧街', 364, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5777, '2024-07-03 07:31:51', '', 1, '旧街', 391, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5929, '2024-07-04 00:31:35', '', 23, '迷雾森林', 584, 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', 480, 480, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5936, '2024-07-04 00:31:43', '', 23, '迷雾森林', 579, 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', 420, 420, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2134, '2024-01-11 00:33:42', '', 1, '旧街', 275, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5715, '2024-07-03 07:31:50', '', 1, '旧街', 355, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6128, '2024-07-06 23:30:47', '', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5742, '2024-07-03 07:31:50', '', 1, '旧街', 367, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6127, '2024-07-06 23:30:47', '', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6027, '2024-07-05 03:34:43', '', 27, '宁静森林', 643, 88, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎', 0, 10, '公', '这是一头经过变异的老虎，一双锋利的牙齿异常瘆人。', '', '{r.100}', '', '139|{r.2}', 0, '2|4,3|6', '', '', '', '', '', 1000, 1000, 120, 70, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5885, '2024-07-03 07:31:53', '', 1, '旧街', 671, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5735, '2024-07-03 07:31:50', '', 1, '旧街', 363, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5931, '2024-07-04 00:31:35', '', 23, '迷雾森林', 584, 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', 480, 480, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5887, '2024-07-03 07:31:53', '', 1, '旧街', 671, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6054, '2024-07-05 21:58:47', '', 1, '旧街', 232, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6200, '2024-07-16 13:20:53', '', 1, '旧街', 348, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6286, '2024-07-22 12:07:41', '', 1, '旧街', 359, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6285, '2024-07-22 12:07:41', '', 1, '旧街', 359, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5884, '2024-07-03 07:31:53', '', 1, '旧街', 630, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5888, '2024-07-03 07:31:53', '', 1, '旧街', 671, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6095, '2024-07-06 04:15:42', '', 1, '旧街', 389, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5716, '2024-07-03 07:31:50', '', 1, '旧街', 356, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5780, '2024-07-03 07:31:51', '', 1, '旧街', 393, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5895, '2024-07-03 07:31:53', '', 0, '未分区', 679, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5894, '2024-07-03 07:31:53', '', 0, '未分区', 679, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5921, '2024-07-04 00:31:27', '', 23, '迷雾森林', 598, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5924, '2024-07-04 00:31:31', '', 23, '迷雾森林', 591, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6025, '2024-07-05 03:34:34', '', 27, '宁静森林', 638, 89, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎王', 0, 15, '公', '这是一头经过变异的巨齿虎王，是凶残的王者，一双锋利的牙齿异常瘆人。', '', '{r.5000}+2000', '', '146|{r.3}==1?1:0', 0, '2|4,3|6', '', '', '', '', '', 3000, 3000, 200, 120, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6055, '2024-07-05 21:58:47', '', 1, '旧街', 232, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5928, '2024-07-04 00:31:35', '', 23, '迷雾森林', 584, 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', 480, 480, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5899, '2024-07-03 07:31:53', '', 0, '未分区', 682, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5935, '2024-07-04 00:31:43', '', 23, '迷雾森林', 579, 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', 420, 420, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6053, '2024-07-05 21:58:47', '', 1, '旧街', 232, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5934, '2024-07-04 00:31:43', '', 23, '迷雾森林', 579, 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', 420, 420, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5933, '2024-07-04 00:31:43', '', 23, '迷雾森林', 579, 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', 420, 420, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6174, '2024-07-13 10:19:48', '', 1, '旧街', 571, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `system_npc_midguaiwu` (`ngid`, `ncreate_time`, `nsid`, `narea_id`, `narea_name`, `nmid`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nshop_cond`, `nmuban`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`) VALUES
(6281, '2024-07-22 12:07:16', '', 1, '旧街', 398, 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '30|{r.2}+1', 0, '3|2', '', '', '', '', '', 300, 300, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6170, '2024-07-13 10:19:48', '', 1, '旧街', 571, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6172, '2024-07-13 10:19:48', '', 1, '旧街', 571, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5668, '2024-07-03 07:31:15', '', 23, '迷雾森林', 588, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5920, '2024-07-04 00:31:27', '', 23, '迷雾森林', 598, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5922, '2024-07-04 00:31:29', '', 23, '迷雾森林', 597, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6171, '2024-07-13 10:19:48', '', 1, '旧街', 571, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6221, '2024-07-16 13:24:37', '', 1, '旧街', 570, 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3', '', '', '', '', '', 120, 120, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5886, '2024-07-03 07:31:53', '', 1, '旧街', 671, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(5898, '2024-07-03 07:31:53', '', 0, '未分区', 682, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5891, '2024-07-03 07:31:53', '', 0, '未分区', 677, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6220, '2024-07-16 13:24:37', '', 1, '旧街', 570, 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3', '', '', '', '', '', 120, 120, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5893, '2024-07-03 07:31:53', '', 0, '未分区', 679, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5892, '2024-07-03 07:31:53', '', 0, '未分区', 679, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6173, '2024-07-13 10:19:48', '', 1, '旧街', 571, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5901, '2024-07-03 07:31:53', '', 0, '未分区', 683, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5900, '2024-07-03 07:31:53', '', 0, '未分区', 683, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5897, '2024-07-03 07:31:53', '', 0, '未分区', 682, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5896, '2024-07-03 07:31:53', '', 0, '未分区', 682, 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', 777, 777, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6126, '2024-07-06 23:30:47', '', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6123, '2024-07-06 23:30:47', '', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6219, '2024-07-16 13:24:37', '', 1, '旧街', 570, 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3', '', '', '', '', '', 120, 120, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6218, '2024-07-16 13:24:37', '', 1, '旧街', 570, 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3', '', '', '', '', '', 120, 120, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6217, '2024-07-16 13:24:37', '', 1, '旧街', 570, 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3', '', '', '', '', '', 120, 120, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5707, '2024-07-03 07:31:50', '', 1, '旧街', 351, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5712, '2024-07-03 07:31:50', '', 1, '旧街', 353, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5706, '2024-07-03 07:31:50', '', 1, '旧街', 351, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5721, '2024-07-03 07:31:50', '', 1, '旧街', 358, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5923, '2024-07-04 00:31:31', '', 23, '迷雾森林', 591, 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', 720, 720, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6225, '2024-07-18 00:15:44', '', 1, '旧街', 361, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5705, '2024-07-03 07:31:50', '', 1, '旧街', 350, 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', 380, 380, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5927, '2024-07-04 00:31:33', '', 23, '迷雾森林', 590, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5926, '2024-07-04 00:31:33', '', 23, '迷雾森林', 590, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6072, '2024-07-06 04:08:26', '', 0, '未分区', 274, 48, 0, 1, 0, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '兵器_1_46,防具_4_7,防具_5_22', '', '', '', 0, '1|1', '', '', '', '', '', 19980925, 19980925, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5932, '2024-07-04 00:31:43', '', 23, '迷雾森林', 579, 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', 420, 420, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5675, '2024-07-03 07:31:16', '', 23, '迷雾森林', 593, 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', 660, 660, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6026, '2024-07-05 03:34:43', '', 27, '宁静森林', 643, 88, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎', 0, 10, '公', '这是一头经过变异的老虎，一双锋利的牙齿异常瘆人。', '', '{r.100}', '', '139|{r.2}', 0, '2|4,3|6', '', '', '', '', '', 1000, 1000, 120, 70, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6296, '2024-07-22 13:43:32', '', 1, '旧街', 308, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6125, '2024-07-06 23:30:47', '', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6124, '2024-07-06 23:30:47', '', 1, '旧街', 230, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0),
(6364, '2024-07-23 11:17:56', '', 1, '旧街', 346, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6199, '2024-07-16 13:20:53', '', 1, '旧街', 348, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6198, '2024-07-16 13:20:53', '', 1, '旧街', 348, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6196, '2024-07-16 13:20:48', '', 1, '旧街', 349, 37, 0, 1, 0, 0, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '{r.20}', '', '24|{r.2}+1', 0, '3|5', '', '', '', '', '', 110, 110, 13, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5719, '2024-07-03 07:31:50', '', 1, '旧街', 357, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5720, '2024-07-03 07:31:50', '', 1, '旧街', 357, 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '29|{r.2}', 0, '3|2', '', '', '', '', '', 260, 260, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5890, '2024-07-03 07:31:53', '', 1, '旧街', 671, 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '25|{r.2}', 0, '2|1', '', '', '', '24,29', '', 50, 50, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_npc_op`
--

CREATE TABLE `system_npc_op` (
  `belong` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `show_cond` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT '未命名',
  `link_event` varchar(255) DEFAULT NULL,
  `link_task` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_npc_op`
--

INSERT INTO `system_npc_op` (`belong`, `id`, `show_cond`, `name`, `link_event`, `link_task`) VALUES
(17, 2, '{u.hp}<{u.maxhp}', '治疗', '8', NULL),
(46, 3, '', '和流民对话', '32', NULL),
(47, 4, '', '聆听教诲', '40', NULL),
(49, 5, '{u.tasks.t8}==2', '领取每日物资', '54', NULL),
(49, 6, '{u.tasks.t1}==2', '歌尔特的日常悬赏', '76', NULL),
(26, 7, '', '施舍', '79', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `system_npc_relationship`
--

CREATE TABLE `system_npc_relationship` (
  `npc_id_1` int(11) NOT NULL,
  `npc_id_2` int(11) NOT NULL,
  `npc_relationship` varchar(255) NOT NULL,
  `npc_relationship_lvl` int(1) NOT NULL COMMENT '关系亲近等级，1最小9最大'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_oplayer`
--

CREATE TABLE `system_oplayer` (
  `oid` int(11) NOT NULL,
  `osid` text CHARACTER SET utf8 NOT NULL,
  `token` text CHARACTER SET utf8 NOT NULL,
  `oname` text CHARACTER SET utf8 NOT NULL,
  `olvl` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `oyxb` int(11) NOT NULL DEFAULT '2000',
  `uczb` int(11) NOT NULL DEFAULT '100',
  `uexp` int(11) NOT NULL DEFAULT '0',
  `uvip` int(11) NOT NULL DEFAULT '0',
  `uhp` int(11) NOT NULL DEFAULT '35',
  `umaxhp` int(11) NOT NULL DEFAULT '35',
  `ugj` int(11) NOT NULL DEFAULT '12',
  `ufy` int(11) NOT NULL DEFAULT '5',
  `usex` int(11) NOT NULL DEFAULT '1',
  `uendtime` datetime NOT NULL,
  `unowmid` int(11) NOT NULL DEFAULT '225',
  `uwx` int(11) NOT NULL DEFAULT '0',
  `unowguaiwu` int(11) NOT NULL,
  `tool1` int(11) NOT NULL,
  `tool2` int(11) NOT NULL,
  `tool3` int(11) NOT NULL,
  `tool4` int(11) NOT NULL,
  `tool5` int(11) NOT NULL,
  `tool6` int(11) NOT NULL,
  `ubj` int(11) NOT NULL DEFAULT '0',
  `uxx` int(11) NOT NULL DEFAULT '0',
  `sfzx` int(11) NOT NULL DEFAULT '0',
  `qandaotime` datetime NOT NULL,
  `xiuliantime` datetime NOT NULL,
  `sfxl` int(11) NOT NULL DEFAULT '0',
  `yp1` int(11) NOT NULL,
  `yp2` int(11) NOT NULL,
  `yp3` int(11) NOT NULL,
  `cw` int(11) NOT NULL,
  `jn1` int(11) NOT NULL,
  `jn2` int(11) NOT NULL,
  `jn3` int(11) NOT NULL,
  `ispvp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `system_pet_player`
--

CREATE TABLE `system_pet_player` (
  `petid` int(11) NOT NULL,
  `petsid` text NOT NULL,
  `petlvl` int(11) NOT NULL,
  `pethp` varchar(255) NOT NULL,
  `petgj` varchar(255) NOT NULL,
  `petfy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_photo`
--

CREATE TABLE `system_photo` (
  `id` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `photo_style` text NOT NULL COMMENT 'height: 72px;width: 128px 场景用',
  `format_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_photo`
--

INSERT INTO `system_photo` (`id`, `name`, `type`, `photo_url`, `photo_style`, `format_type`) VALUES
('test_photo', '小狗2', '系统图片', 'images/系统图片/系统图片-test_photo-小狗2.jpg', 'height: 4em', 'jpg'),
('广场通用', '广场', '系统图片', 'images/系统图片/系统图片-广场通用-广场.png', 'height: 72px;width: 128px', 'png'),
('sword_0001', '生锈的铁剑', '剑', 'images/剑/剑-sword_0001-生锈的铁剑.png', 'height: 4em', 'png'),
('map001_south', '旧街南', '旧街', 'images/旧街/旧街-map001_south-旧街南.png', 'height: 72px;width: 128px', 'png'),
('map001_west', '旧街西', '旧街', 'images/旧街/旧街-map001_west-旧街西.png', 'height: 72px;width: 128px', 'png'),
('map001_west_shop', '旧街临时市场', '旧街', 'images/旧街/旧街-map001_west_shop-旧街临时市场.png', 'height: 72px;width: 128px', 'png'),
('knife_0001', '粗糙的匕首', '刀', 'images/刀/刀-knife_0001-粗糙的匕首.png', 'height: 4em', 'png'),
('map001_center', '旧街广场', '旧街', 'images/旧街/旧街-map001_center-旧街广场.png', 'height: 72px;width: 128px', 'png'),
('gun-a-01', 'a-01猎豹', '枪', 'images/枪/枪-gun-a-01-a-01猎豹.jpeg', 'height: 4em', 'jpeg');

-- --------------------------------------------------------

--
-- 表的结构 `system_photo_type`
--

CREATE TABLE `system_photo_type` (
  `name` varchar(255) NOT NULL,
  `contains` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_photo_type`
--

INSERT INTO `system_photo_type` (`name`, `contains`) VALUES
('系统图片', '2'),
('旧街', '4'),
('剑', '1'),
('刀', '1'),
('枪', '1');

-- --------------------------------------------------------

--
-- 表的结构 `system_player`
--

CREATE TABLE `system_player` (
  `uid` int(11) NOT NULL,
  `sid` text CHARACTER SET utf8 NOT NULL,
  `token` text CHARACTER SET utf8 NOT NULL,
  `uname` text CHARACTER SET utf8 NOT NULL,
  `ulvl` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `uyxb` int(11) NOT NULL DEFAULT '2000',
  `uczb` int(11) NOT NULL DEFAULT '100',
  `uexp` int(11) NOT NULL DEFAULT '0',
  `uvip` int(11) NOT NULL DEFAULT '0',
  `uhp` int(11) NOT NULL DEFAULT '35',
  `umaxhp` int(11) NOT NULL DEFAULT '35',
  `ugj` int(11) NOT NULL DEFAULT '12',
  `ufy` int(11) NOT NULL DEFAULT '5',
  `usex` int(11) NOT NULL DEFAULT '1',
  `uendtime` datetime NOT NULL,
  `unowmid` int(11) NOT NULL DEFAULT '225',
  `uwx` int(11) NOT NULL DEFAULT '0',
  `unowguaiwu` int(11) NOT NULL,
  `tool1` int(11) NOT NULL,
  `tool2` int(11) NOT NULL,
  `tool3` int(11) NOT NULL,
  `tool4` int(11) NOT NULL,
  `tool5` int(11) NOT NULL,
  `tool6` int(11) NOT NULL,
  `ubj` int(11) NOT NULL DEFAULT '0',
  `uxx` int(11) NOT NULL DEFAULT '0',
  `sfzx` int(11) NOT NULL DEFAULT '0',
  `qandaotime` datetime NOT NULL,
  `xiuliantime` datetime NOT NULL,
  `sfxl` int(11) NOT NULL DEFAULT '0',
  `yp1` int(11) NOT NULL,
  `yp2` int(11) NOT NULL,
  `yp3` int(11) NOT NULL,
  `cw` int(11) NOT NULL,
  `jn1` int(11) NOT NULL,
  `jn2` int(11) NOT NULL,
  `jn3` int(11) NOT NULL,
  `ispvp` int(11) NOT NULL DEFAULT '0',
  `unick_name` varchar(255) DEFAULT '',
  `uimage` varchar(255) DEFAULT '',
  `ukill` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `system_player_black`
--

CREATE TABLE `system_player_black` (
  `usid` text NOT NULL,
  `osid` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_player_boat`
--

CREATE TABLE `system_player_boat` (
  `sid` text NOT NULL,
  `boat_name` varchar(255) NOT NULL,
  `boat_cons` int(11) NOT NULL COMMENT '百里能耗',
  `boat_distance` int(11) NOT NULL COMMENT '剩余航行距离',
  `boat_speed` int(11) NOT NULL DEFAULT '255' COMMENT '船速',
  `boat_begin_id` int(11) NOT NULL COMMENT '起始id',
  `boat_over_id` int(11) NOT NULL COMMENT '目标id',
  `boat_durable` int(11) NOT NULL DEFAULT '200' COMMENT '耐久,每航行1000海里-1',
  `boat_max_durable` int(11) NOT NULL DEFAULT '200' COMMENT '最大耐久'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_player_boat`
--

INSERT INTO `system_player_boat` (`sid`, `boat_name`, `boat_cons`, `boat_distance`, `boat_speed`, `boat_begin_id`, `boat_over_id`, `boat_durable`, `boat_max_durable`) VALUES
('959c9277a3e15eacff9e5f117e51f5bb', '飞翔的荷兰人号', 200, 0, 255, 624, 678, 200, 200);

-- --------------------------------------------------------

--
-- 表的结构 `system_player_friend`
--

CREATE TABLE `system_player_friend` (
  `usid` text NOT NULL,
  `osid` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_player_friend`
--

INSERT INTO `system_player_friend` (`usid`, `osid`) VALUES
('2be824d1d1eaf47b51176faf90a5b8c9', 'f5f8f28ae6c3fb5529d578a31cfcf72d'),
('2be824d1d1eaf47b51176faf90a5b8c9', '7c936037baabb3f953d1247ac57fd33d'),
('7c936037baabb3f953d1247ac57fd33d', '2be824d1d1eaf47b51176faf90a5b8c9');

-- --------------------------------------------------------

--
-- 表的结构 `system_player_inputs`
--

CREATE TABLE `system_player_inputs` (
  `sid` text NOT NULL,
  `event_id` int(11) NOT NULL,
  `id` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_player_setting`
--

CREATE TABLE `system_player_setting` (
  `sid` text NOT NULL,
  `if_photo` int(1) NOT NULL COMMENT '是否显示图片',
  `if_message` int(1) NOT NULL,
  `if_save_last_message` int(1) NOT NULL,
  `save_last_message_text` text NOT NULL,
  `show_message_reg` int(2) NOT NULL,
  `show_list_reg` int(2) NOT NULL,
  `accept_state` int(1) NOT NULL,
  `back_color` varchar(255) NOT NULL,
  `text_color` varchar(255) NOT NULL,
  `cmd_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `system_pvp_score`
--

CREATE TABLE `system_pvp_score` (
  `pvp_id` int(11) NOT NULL,
  `pvp_name` varchar(255) NOT NULL,
  `pvp_show_cond` varchar(255) NOT NULL,
  `pvp_battle_cond` varchar(255) NOT NULL,
  `pvp_start_time` datetime NOT NULL,
  `pvp_end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_rank`
--

CREATE TABLE `system_rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL,
  `rank_exp` varchar(255) NOT NULL COMMENT '表达式',
  `show_cond` text NOT NULL,
  `show_count` int(3) NOT NULL DEFAULT '10',
  `show_obj` int(1) NOT NULL COMMENT '0为玩家，1为宠物'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_rank`
--

INSERT INTO `system_rank` (`rank_id`, `rank_name`, `rank_exp`, `show_cond`, `show_count`, `show_obj`) VALUES
(1, '等级榜', '{u.lvl}', '{u.lvl}>1', 3, 0),
(2, '财富榜', '{u.money}', '', 10, 0),
(3, '攻击榜', '{u.gj}', '', 10, 0),
(4, '防御榜', '{u.fy}', '', 10, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_regular_tasks`
--

CREATE TABLE `system_regular_tasks` (
  `reg_id` int(11) NOT NULL COMMENT 'id',
  `reg_regular` text NOT NULL COMMENT '规则'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_rp`
--

CREATE TABLE `system_rp` (
  `rp_id` int(11) NOT NULL,
  `rp_item_root` int(11) NOT NULL COMMENT '资源对应物品id',
  `rp_name` varchar(255) NOT NULL,
  `rp_desc` varchar(255) NOT NULL,
  `rp_rarity` int(1) NOT NULL COMMENT '稀有度，0为最低级，9为最高级',
  `rp_renew_time` int(11) NOT NULL COMMENT '刷新时间，以秒为单位',
  `rp_pick_cond` text NOT NULL COMMENT '采集条件表达式',
  `rp_action_name` varchar(255) NOT NULL COMMENT '采集动作名称，eg:矿石用挖矿、树木用砍伐'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='资源设计表';

--
-- 转存表中的数据 `system_rp`
--

INSERT INTO `system_rp` (`rp_id`, `rp_item_root`, `rp_name`, `rp_desc`, `rp_rarity`, `rp_renew_time`, `rp_pick_cond`, `rp_action_name`) VALUES
(1, 39, '铜矿', '可以利用的含铜的自然矿物集合体的总称，铜矿石一般是铜的硫化物或氧化物与其他矿物组成的集合体，与硫酸反应生成蓝绿色的硫酸铜。', 1, 30, '', '挖掘铜矿'),
(2, 40, '锡矿', '锡质软有延展性、化学性质稳定，抗腐蚀、易熔，摩擦系数小，是良好的工业原料。', 2, 42, '', '挖掘锡矿'),
(3, 41, '铁矿', '铁是世界上发现最早，利用最广，用量也是最多的一种金属，其消耗量约占金属总消耗量的95%左右。铁矿石主要用于钢铁工业。', 3, 60, '', '挖掘铁矿'),
(4, 42, '铅矿', '金属铅是一种耐蚀的重有色金属材料，铅具有熔点低、耐蚀性高、X射线和γ射线等不易穿透、塑性好等优点', 4, 90, '', '挖掘铅矿'),
(5, 45, '松木', '松木是一种针叶植物它具有松香味、色淡黄、疖疤多、对大气温度反应快、容易胀大、极难自然风干等特性。', 1, 30, '', '砍伐松树');

-- --------------------------------------------------------

--
-- 表的结构 `system_self_define_module`
--

CREATE TABLE `system_self_define_module` (
  `pos` int(11) NOT NULL,
  `id` varchar(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `call_sum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_self_define_module`
--

INSERT INTO `system_self_define_module` (`pos`, `id`, `name`, `call_sum`) VALUES
(1, 'test', '测试页面', 417),
(2, 'tent', '旧街帐篷', 20),
(3, 'HW003', '希望镇露天浴场终端', 44),
(4, 'bounty_01', '歌尔特日常悬赏', 122),
(5, 'HP_lift_1', '希望镇小区一区电梯', 97),
(6, 'vip', 'vip界面', 216);

-- --------------------------------------------------------

--
-- 表的结构 `system_skill`
--

CREATE TABLE `system_skill` (
  `jname` varchar(255) NOT NULL,
  `jid` int(10) UNSIGNED NOT NULL,
  `jdesc` varchar(255) NOT NULL COMMENT '技能描述',
  `joccasion` int(1) NOT NULL COMMENT '使用场合',
  `jimage` varchar(255) NOT NULL,
  `jhurt_mod` text NOT NULL COMMENT '伤害系数',
  `jgroup_attack` int(1) NOT NULL DEFAULT '1' COMMENT '攻击范围，-1代表攻击所有',
  `jcooling_time` int(11) NOT NULL COMMENT '冷却时间（秒）',
  `jcooling_round` int(11) NOT NULL COMMENT '冷却时间（回合）',
  `jhurt_attr` text NOT NULL COMMENT '伤害目标',
  `jdeplete_attr` text NOT NULL COMMENT '消耗目标',
  `jhurt_exp` text NOT NULL COMMENT '伤害公式',
  `jdeplete_exp` text NOT NULL COMMENT '消耗公式',
  `jequip_type` int(11) NOT NULL DEFAULT '19980925' COMMENT '使用兵器类型，默认为任意',
  `jequip_appoint` varchar(255) NOT NULL COMMENT '指定兵器id',
  `juse_cond` text NOT NULL COMMENT '使用条件表达式',
  `jcant_use_cmmt` text NOT NULL COMMENT '不满足使用条件提示语',
  `jadd_point_exp` text NOT NULL COMMENT '熟练度表达式',
  `jpromotion` text NOT NULL COMMENT '升级公式',
  `jpromotion_cond` text NOT NULL COMMENT '升级条件表达式',
  `jeffect_cmmt` varchar(255) NOT NULL COMMENT '出招效果描述',
  `jevent_use_id` int(11) NOT NULL COMMENT '使用事件指向id',
  `jevent_up_id` int(11) NOT NULL COMMENT '升级事件指向id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_skill`
--

INSERT INTO `system_skill` (`jname`, `jid`, `jdesc`, `joccasion`, `jimage`, `jhurt_mod`, `jgroup_attack`, `jcooling_time`, `jcooling_round`, `jhurt_attr`, `jdeplete_attr`, `jhurt_exp`, `jdeplete_exp`, `jequip_type`, `jequip_appoint`, `juse_cond`, `jcant_use_cmmt`, `jadd_point_exp`, `jpromotion`, `jpromotion_cond`, `jeffect_cmmt`, `jevent_use_id`, `jevent_up_id`) VALUES
('普通攻击', 1, '生物的战斗本能。', 0, '', '1', 2, 0, 0, 'hp', 'money', '{e.damage}', '', 19980925, '', '', '', '1', '2', '{m.lvl}<10', '{eval(v(u.equips.b.count)==0?\"v(u.name)挥动拳头对v(o.name)一阵乱打。\":\"v(u.name)挥动v(u.equips.b.name)，戴着v(u.equips.0.name)穿着v(u.equips.1.name)对v(o.name)一阵乱砍。\")}', 74, 0),
('冲撞', 2, '单纯用蛮力撞向敌人的手段。', 0, '', '3', 1, 0, 0, 'hp', 'hp', '{e.damage}', '', 19980925, '', '', '', '', '{e.sk_lvl}', '', '{u.name}猛地朝着{o.name}扑撞了过去！', 0, 0),
('撕咬', 3, '这似乎是变异后的生物自然进化出的本能。', 0, '', '5', 1, 0, 0, 'hp', 'exp', '{e.damage}', '', 19980925, '', '', '', '', '', '', '{u.name}猛地向{o.name}一扑，粘稠的唾液附着在尖锐的牙齿上朝{o.name}咬去。', 0, 0),
('蜇击', 4, '利用毒刺进行攻击的行为。', 0, '', '4', 1, 0, 0, 'hp', 'exp', '{e.damage}', '1', 19980925, '', '', '', '1', '', '', '{u.name}亮起了毒刺，狠狠地朝{o.name}扎了过去！', 0, 0),
('堕落之梦', 5, '这是梦魇生物的天生本能技能，是一种强大的精神攻击。', 0, '', '20', 1, 0, 0, 'hp', 'money', '{e.damage}', '3', 19980925, '', '', '', '', '', '', '{u.name}使用堕落之梦，{o.name}感到灵魂有些疲惫。', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_skill_module`
--

CREATE TABLE `system_skill_module` (
  `jid` int(11) NOT NULL COMMENT '用于标识默认值和修改值,默认值1修改值2',
  `jhurt_attr` text NOT NULL COMMENT '伤害目标',
  `jdeplete_attr` text NOT NULL COMMENT '消耗目标',
  `jhurt_exp` text NOT NULL COMMENT '伤害公式',
  `jdeplete_exp` text NOT NULL COMMENT '消耗公式',
  `jadd_point_exp` text NOT NULL COMMENT '单次增加熟练度公式',
  `jpromotion` text NOT NULL COMMENT '升级公式',
  `jpromotion_cond` text NOT NULL COMMENT '升级条件表达式',
  `jeffect_cmmt` varchar(255) NOT NULL COMMENT '使用效果描述',
  `jevent_use_id` int(11) NOT NULL COMMENT '使用事件指向id',
  `jevent_up_id` int(11) NOT NULL COMMENT '升级事件指向id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_skill_module`
--

INSERT INTO `system_skill_module` (`jid`, `jhurt_attr`, `jdeplete_attr`, `jhurt_exp`, `jdeplete_exp`, `jadd_point_exp`, `jpromotion`, `jpromotion_cond`, `jeffect_cmmt`, `jevent_use_id`, `jevent_up_id`) VALUES
(1, 'hp', 'money', '', '', '', '{m.lvl}*10', '1', '', 0, 0),
(2, 'hp', 'money', '(({u.lvl}*({r.100}+20)+{m.lvl}*8+({m.hurt_mod}*({m.lvl}+18)/6)+{u.gj}*8)-({r.o.lvl}+10)*8-{o.fy}*3)', '', '', '{e.sk_lvl}', '1', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_skill_user`
--

CREATE TABLE `system_skill_user` (
  `jsid` varchar(255) NOT NULL,
  `jid` int(10) UNSIGNED NOT NULL,
  `jlvl` int(11) NOT NULL COMMENT '技能等级',
  `jpoint` int(11) NOT NULL COMMENT '当前熟练度',
  `jdefault` int(1) NOT NULL COMMENT '0为非默认，1为默认，在自动战斗中生效'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_skill_user`
--

INSERT INTO `system_skill_user` (`jsid`, `jid`, `jlvl`, `jpoint`, `jdefault`) VALUES
('f244e629c0bc88068f2ecd6baf212683', 1, 1, 0, 0),
('76623f3a68872fa88502af535498a991', 1, 1, 0, 0),
('e3130d019f7689f5501bc3633f97eb88', 1, 1, 0, 0),
('2f4746d4d36396302d36e51c969d3e68', 1, 1, 0, 0),
('01acd0637eb2b6a6a3055e4fc37e8457', 1, 4, 2, 0),
('fe3319b6dd10f68aaa36ee852cd79cc1', 1, 1, 0, 1),
('f55913444ef985484baf7580c60f15ce', 1, 1, 18, 0),
('945fd26d30e007abfed414cc1f2795f5', 1, 2, 74, 0),
('79462faa70c368423c7f9fb106fa1f47', 1, 1, 0, 0),
('01a0d4f5e64a677721a1089d4914bc6a', 1, 1, 3, 0),
('a8c7b0c51c60be7441214c0b0c671d88', 1, 1, 0, 0),
('214658c4375c343e280ae38e880ac4ba', 1, 1, 23, 0),
('c618319c00c8a0ddfc15fefbe3f4f898', 1, 1, 0, 0),
('0277b7c43250e3bda5d7fb423ce14d92', 1, 1, 0, 0),
('68dcd3cd66a76b81cfc90c0e147617d4', 1, 10, 2, 1),
('959c9277a3e15eacff9e5f117e51f5bb', 1, 10, 2, 1),
('f4cd01caaf9ec17c03413de91b97b5f2', 1, 1, 2, 0),
('344773e829d514e37d748e906a4f020a', 1, 1, 0, 0),
('6b5913cfa12674939ee93c59e0bb7254', 1, 1, 0, 0),
('976f6bbeda6b3bca384d8842e569f05e', 1, 1, 0, 0),
('98c50608a11ec800fba8b2d0b7294aeb', 1, 1, 0, 0),
('269d6f1d2272bf0f3af7633340052a03', 1, 6, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_storage`
--

CREATE TABLE `system_storage` (
  `ibelong_mid` int(11) NOT NULL COMMENT '//所属地图',
  `item_true_id` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `uid` int(10) NOT NULL,
  `iid` int(11) NOT NULL,
  `icount` int(11) NOT NULL,
  `ibind` int(11) NOT NULL COMMENT '0为未绑定，1为绑定。',
  `iroot` varchar(255) NOT NULL COMMENT '物品来源格式：类别|id，类别0代表未知，1代表怪物掉落，2代表玩家打造，3代表任务赠送，4代表其它'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_storage`
--

INSERT INTO `system_storage` (`ibelong_mid`, `item_true_id`, `sid`, `uid`, `iid`, `icount`, `ibind`, `iroot`) VALUES
(287, 154, '959c9277a3e15eacff9e5f117e51f5bb', 1, 72, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `system_storage_locked`
--

CREATE TABLE `system_storage_locked` (
  `ibelong_mid` int(11) NOT NULL COMMENT '//所属地图',
  `sid` varchar(255) NOT NULL,
  `istate` int(1) NOT NULL COMMENT '0代表没锁，1代表锁住',
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_storage_locked`
--

INSERT INTO `system_storage_locked` (`ibelong_mid`, `sid`, `istate`, `password`) VALUES
(287, '959c9277a3e15eacff9e5f117e51f5bb', 1, ''),
(611, '959c9277a3e15eacff9e5f117e51f5bb', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `system_task`
--

CREATE TABLE `system_task` (
  `tbelong` int(11) NOT NULL COMMENT '属于哪个父任务系列',
  `tid` int(11) NOT NULL,
  `tname` varchar(255) NOT NULL,
  `tnpc_id` int(11) NOT NULL COMMENT '哪个npc发布的',
  `ttype` int(1) NOT NULL COMMENT '1杀怪2寻物3办事',
  `ttype2` int(1) NOT NULL COMMENT '1主线2支线3日常',
  `tgiveup` int(1) NOT NULL COMMENT '0不可放弃1可放弃',
  `treaccept` int(1) NOT NULL COMMENT '0不可重复接受1可重复接受',
  `taccept_lvl` int(11) NOT NULL COMMENT '最低接受等级',
  `tcond` text NOT NULL COMMENT '触发条件',
  `taccept_cond` text NOT NULL COMMENT '接受条件',
  `tcmmt1` varchar(255) NOT NULL COMMENT '不能接受提示语',
  `tcmmt2` varchar(255) NOT NULL COMMENT '未完成提示语',
  `ttarget_event_accept` int(255) NOT NULL COMMENT '接受事件id',
  `ttarget_event_giveup` int(255) NOT NULL COMMENT '放弃事件id',
  `ttarget_event_finish` int(255) NOT NULL COMMENT '完成事件id',
  `ttarget_obj` varchar(255) NOT NULL COMMENT '任务要求，格式：id|数量,id|数量，会因type不同而不同'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_task`
--

INSERT INTO `system_task` (`tbelong`, `tid`, `tname`, `tnpc_id`, `ttype`, `ttype2`, `tgiveup`, `treaccept`, `taccept_lvl`, `tcond`, `taccept_cond`, `tcmmt1`, `tcmmt2`, `ttarget_event_accept`, `ttarget_event_giveup`, `ttarget_event_finish`, `ttarget_obj`) VALUES
(0, 2, '急切的交易', 13, 2, 2, 0, 0, 0, '{u.tasks.t1}==2', '', '', '「格兰特」：快点，我现在急需这个东西，要不是我分身乏术才不会叫你帮这个忙！', 19, 0, 20, '24|5'),
(0, 3, '莉莉安的书信', 11, 3, 1, 0, 0, 0, '{u.tasks.t8} == 2', '', '', '「莉莉安」:快去吧，去探明「希望镇」发生了什么，我等你的好消息！', 22, 0, 23, ''),
(0, 1, '留下的证明', 11, 2, 1, 0, 1, 1, '', '', '', '「莉莉安」：呦，这是怕了?想证明自己的价值就去东边的河流那吧！', 14, 0, 18, '25|3'),
(0, 4, '变异的老鼠', 49, 1, 1, 0, 0, 0, '{u.tasks.t1}==2', '', '「歌尔特」：你的实力太弱了，哼！', '「歌尔特」：怎么，几只老鼠都杀不了吗?', 35, 0, 36, '37|4'),
(0, 5, '皮格的美味实验', 50, 2, 1, 0, 0, 0, '{u.tasks.t4}==2', '', '「皮格」盯着你上下看了好几眼，然后才瞪着你说道：快滚蛋，我看你不顺眼！', '「皮格」：蓝蚊子的血+巨型苍蝇的卵+水元素生物的粘液，emmm，也许还要再来点迦仕敦的酒...你怎么还在这?说几遍了，蓝蚊子在那片灰青草地上，能找到不?再找不到我煮完这锅美味我就自己去了！', 38, 0, 43, '29|5'),
(0, 6, '迪伦斯的现状', 52, 3, 2, 0, 0, 0, '{u.tasks.t4} ==2', '', '', '「迪伦斯」：乌鸦，好多乌鸦。。。\r\n（去找歌尔特聊聊吧）', 41, 0, 0, ''),
(0, 7, '乌鸦的谜团', 49, 2, 2, 0, 0, 0, '{u.tasks.t6}==2', '', '', '「歌尔特」：去找找看看吧！往「灰青草地」深处找找，紫色的羽毛。', 42, 0, 53, '30|5'),
(0, 8, '清剿狼群', 49, 1, 1, 0, 0, 0, '{u.tasks.t5}==2', '', '', '「歌尔特」：狼群的存在威胁着旧街的安全！\r\n「歌尔特」：羊羔肉卷饼怎么一个卖4.5块了!昨天还是4.2块的!', 48, 0, 50, '55|6'),
(0, 9, '希望镇的困境', 68, 3, 1, 0, 0, 0, '{u.tasks.t3}==2', '', '', '「姗妮」：快回去吧，时间紧迫!', 86, 0, 109, ''),
(0, 10, '众人拾柴火焰高', 11, 2, 1, 0, 0, 0, '{u.tasks.t9}==2', '', '', '「莉莉安」：支援行动不是一件小事，我们需要一只先遣队的力量来组建「先驱者小队」先行一步，需要女巫丶黑客和猎人的力量，去想办法取得「赛西」丶「K-M」丶「赫米特」的信物来吧，事态紧急，一切从简。', 93, 0, 105, '132|1,133|1,134|1'),
(0, 11, '测试任务', 80, 3, 1, 0, 0, 0, '', '', '', '', 96, 0, 0, ''),
(0, 12, 'K-M的爱好', 77, 2, 1, 0, 0, 0, '{u.tasks.t10}==1', '', '', '「K-M」：土豆饼的味道，是玛格尼斯的记忆。', 99, 0, 100, '65|1'),
(0, 13, '赛西的梦魇', 61, 1, 1, 0, 0, 0, '{u.tasks.t10}==1', '', '', '赛西：那些东西在虚实之间，妄想触及真实的世界。', 101, 0, 104, '81|7'),
(0, 14, '赫米特的烦恼', 79, 2, 1, 0, 0, 0, '{u.tasks.t10}==1', '', '', '「赫米特」：该怎么搭一个好看又好用的小屋呢。', 106, 0, 107, '45|20'),
(0, 15, '前往希望镇.一', 77, 1, 1, 0, 0, 0, '{u.tasks.t10}==2', '', '', '「KM」：赶紧处理掉前面的大黄蜂，既然接下了任务，我们必须尽快赶往希望镇！', 114, 0, 115, '67|6'),
(0, 16, '前往希望镇.二', 77, 2, 1, 0, 0, 0, '{u.tasks.t15}==2', '', '', '「KM」：森林里危机重重，我们需要赶紧收集「赛西」需要的材料炼制驱魔药。', 117, 0, 118, '139|3,140|1,141|6'),
(0, 17, '前往希望镇.三', 77, 3, 1, 0, 0, 0, '{u.tasks.t16}==2', '', '', '「KM」：去找凌影聊聊当前的情况吧！', 119, 0, 121, ''),
(0, 18, '希望镇的困境', 75, 2, 1, 0, 0, 0, '{u.tasks.t17}==2', '', '', '「凌影」：这些变异生物简直是一把把悬在头上的刀，不知道何时会落下！', 120, 0, 0, '144|1,145|1,146|1');

-- --------------------------------------------------------

--
-- 表的结构 `system_task_evs_old`
--

CREATE TABLE `system_task_evs_old` (
  `id` varchar(4) NOT NULL COMMENT '任务id，以t开头',
  `name` varchar(255) DEFAULT NULL COMMENT '任务名',
  `s_cond` varchar(255) DEFAULT NULL COMMENT '触发条件',
  `cond` varchar(255) DEFAULT NULL COMMENT '接受条件',
  `cmmt1` text COMMENT '不能提示语',
  `cmmt2` text COMMENT '未完成提示语',
  `type` int(2) DEFAULT NULL COMMENT '任务类型，1为杀怪，2为寻物，3为办事',
  `dosth_flag` varchar(255) DEFAULT NULL COMMENT '办事任务标志名称',
  `on_accept` varchar(255) DEFAULT NULL COMMENT '接受事件',
  `npcs` varchar(255) DEFAULT NULL COMMENT '杀怪目标',
  `items` varchar(255) DEFAULT NULL COMMENT '寻物目标',
  `evs` varchar(255) DEFAULT NULL,
  `on_finish` varchar(255) DEFAULT NULL COMMENT '完成事件'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_task_father`
--

CREATE TABLE `system_task_father` (
  `f_id` int(11) NOT NULL COMMENT '系列id',
  `f_name` varchar(255) NOT NULL COMMENT '系列名称',
  `f_desc` varchar(255) NOT NULL COMMENT '系列介绍'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_task_user`
--

CREATE TABLE `system_task_user` (
  `tid` int(11) NOT NULL,
  `sid` text NOT NULL,
  `tnowcount` varchar(255) NOT NULL COMMENT '//当前任务进度数量,格式:id|数量',
  `tstate` int(1) NOT NULL COMMENT '//任务状态，1未完成2已完成'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_task_user`
--

INSERT INTO `system_task_user` (`tid`, `sid`, `tnowcount`, `tstate`) VALUES
(3, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(8, '959c9277a3e15eacff9e5f117e51f5bb', '55|6', 2),
(7, '959c9277a3e15eacff9e5f117e51f5bb', '30|5', 2),
(2, '959c9277a3e15eacff9e5f117e51f5bb', '24|5', 2),
(6, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(5, '959c9277a3e15eacff9e5f117e51f5bb', '29|5', 2),
(4, '959c9277a3e15eacff9e5f117e51f5bb', '37|4', 2),
(10, '959c9277a3e15eacff9e5f117e51f5bb', '132|1,133|1,134|1', 2),
(1, '959c9277a3e15eacff9e5f117e51f5bb', '25|3', 2),
(9, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(1, '68dcd3cd66a76b81cfc90c0e147617d4', '25|3', 2),
(4, '68dcd3cd66a76b81cfc90c0e147617d4', '37|4', 2),
(1, '01a0d4f5e64a677721a1089d4914bc6a', '25|0', 1),
(1, '79462faa70c368423c7f9fb106fa1f47', '25|0', 1),
(1, '945fd26d30e007abfed414cc1f2795f5', '25|3', 2),
(2, '945fd26d30e007abfed414cc1f2795f5', '24|5', 2),
(1, 'f55913444ef985484baf7580c60f15ce', '25|3', 2),
(2, 'f55913444ef985484baf7580c60f15ce', '24|0', 1),
(4, 'f55913444ef985484baf7580c60f15ce', '37|1', 1),
(1, 'fe3319b6dd10f68aaa36ee852cd79cc1', '25|0', 1),
(1, '01acd0637eb2b6a6a3055e4fc37e8457', '25|0', 1),
(4, '945fd26d30e007abfed414cc1f2795f5', '37|4', 2),
(6, '945fd26d30e007abfed414cc1f2795f5', '', 2),
(5, '945fd26d30e007abfed414cc1f2795f5', '29|0', 1),
(7, '945fd26d30e007abfed414cc1f2795f5', '30|0', 1),
(1, '2f4746d4d36396302d36e51c969d3e68', '25|0', 1),
(12, '959c9277a3e15eacff9e5f117e51f5bb', '65|1', 2),
(13, '959c9277a3e15eacff9e5f117e51f5bb', '81|7', 2),
(1, '76623f3a68872fa88502af535498a991', '25|0', 1),
(1, 'f4cd01caaf9ec17c03413de91b97b5f2', '25|0', 1),
(14, '959c9277a3e15eacff9e5f117e51f5bb', '45|20', 2),
(1, '344773e829d514e37d748e906a4f020a', '25|0', 1),
(15, '959c9277a3e15eacff9e5f117e51f5bb', '67|6', 2),
(16, '959c9277a3e15eacff9e5f117e51f5bb', '139|3,140|1,141|6', 2),
(17, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(1, '98c50608a11ec800fba8b2d0b7294aeb', '25|0', 1),
(18, '959c9277a3e15eacff9e5f117e51f5bb', '144|0,145|0,146|0', 1),
(1, '269d6f1d2272bf0f3af7633340052a03', '25|0', 1),
(2, '68dcd3cd66a76b81cfc90c0e147617d4', '24|5', 2),
(5, '68dcd3cd66a76b81cfc90c0e147617d4', '29|0', 1),
(6, '68dcd3cd66a76b81cfc90c0e147617d4', '', 2),
(7, '68dcd3cd66a76b81cfc90c0e147617d4', '30|0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `system_team_user`
--

CREATE TABLE `system_team_user` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_decla` varchar(255) NOT NULL,
  `team_master` varchar(255) NOT NULL,
  `team_member` varchar(255) NOT NULL,
  `team_auto_pass` int(1) NOT NULL DEFAULT '0',
  `team_created_time` datetime NOT NULL,
  `team_putin_id` varchar(255) NOT NULL COMMENT '申请人uid，格式：id1|id2|...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_team_user`
--

INSERT INTO `system_team_user` (`team_id`, `team_name`, `team_decla`, `team_master`, `team_member`, `team_auto_pass`, `team_created_time`, `team_putin_id`) VALUES
(1, '测伤', '好梦', '10', '10,2', 1, '2024-06-05 23:46:52', '');

-- --------------------------------------------------------

--
-- 表的结构 `system_tran_user`
--

CREATE TABLE `system_tran_user` (
  `tran_id` int(11) NOT NULL,
  `tran_state` varchar(255) NOT NULL,
  `tran_sid` int(11) NOT NULL,
  `tran_oid` int(11) NOT NULL,
  `tran_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `username` text,
  `userpass` text,
  `token` text,
  `sid` text,
  `designer` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`username`, `userpass`, `token`, `sid`, `designer`) VALUES
('123456', 'lwd54088', '6153c573c2237ed0422c426d6786dc4f', NULL, 1),
('7904169', 'lwd54088', 'e0eaeb7d19fcde3fbd6075c91a6e7039', NULL, 0),
('19980925', 'lwd54088', '8d85deb95ac222630170d467d3ebf9ef', NULL, 0),
('8888888888', '8888888888', 'b6526c6f92585d88c035022894633a46', NULL, 0),
('1008601', '1008601', '8c1c9aebf5d0cd9dab8a3f07e21b19a9', NULL, 0),
('1392713687', 'bbk13927', '8fcae6b1a6f201d1b25d3186f1887f6a', NULL, 0),
('568858', '568858', 'b0d565aa0d423b7507a2ff7eda5db95f', NULL, 0),
('123123', '123123', '4be4c87864dc5d0fcc627e4d96806211', NULL, 0),
('123456789', 'lwd54088', '875f5c113100c5d9fd7e3a8a1e017d53', NULL, 0),
('xunxian', 'xunxian', '11de1b2d74bff722bf47c1fe0d7a1586', NULL, 0),
('888888', '888888', 'bd6ad1a2bd957d1af8f9029bd86054b2', NULL, 0),
('aaa123', 'aaa123', '8a3f0145cdd02d3a5b21faa47335ad5a', NULL, 0),
('1763520934', '123456789', '5fd37cf7246fdd96c1a6808dd0a9776c', NULL, 0),
('17635209341', '123456789', '3bd64d874d8de07e0c000130eac39cd1', NULL, 0),
('1620824116', 'zxcvbnm', '7b69c4b07cd900f5b85f89e64e834d38', NULL, 0),
('111111', '111111', 'a7d8a52f6f62b749aacd656156101e9e', NULL, 0),
('124555', '124555', '604077277c57e12b1e3f0a9815a979fa', NULL, 0),
('qwe123123', 'qwe123123', '9cc64b284957f1afb54f20caceac59a0', NULL, 0),
('a19881102', '123456', 'fd7900c0d69114b7caad71ce86c9eb58', NULL, 0),
('hanshen', 'wa684572', '3452fa0da5eba8106aa44154660dd821', NULL, 0),
('1234567', 'lwd54088', 'c0cfb06999cc03b9c027a0777cbf38fa', NULL, 0),
('12345678', 'lwd54088', '05ee93c4c6d65097cf576b439e6a7413', NULL, 0),
('qqqqqq', 'qqqqqq', '76e1a946158fed2415d33ba4e58bbe06', NULL, 0),
('wowgm1', 'wowgm1', '137033b69556ca35b8fb9da749db1a57', NULL, 0),
('ss123as', 'ss123as', '40ec9b3fb84f1d1c082d2e9df3d733b1', NULL, 0),
('decent001', '0116152881', '51a8c1a197e4c37ce59cc3af3b5c5d5e', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `sid` text NOT NULL,
  `is_active` int(11) NOT NULL,
  `device_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `zhuangbei`
--

CREATE TABLE `zhuangbei` (
  `zbname` varchar(255) NOT NULL,
  `zbinfo` varchar(255) NOT NULL,
  `zbgj` varchar(255) NOT NULL,
  `zbfy` varchar(255) NOT NULL,
  `zbbj` varchar(255) NOT NULL,
  `zbxx` varchar(255) NOT NULL,
  `zbid` int(11) NOT NULL,
  `zbhp` varchar(255) NOT NULL,
  `zblv` int(11) NOT NULL,
  `zbtool` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zhuangbei`
--

INSERT INTO `zhuangbei` (`zbname`, `zbinfo`, `zbgj`, `zbfy`, `zbbj`, `zbxx`, `zbid`, `zbhp`, `zblv`, `zbtool`) VALUES
('新手木剑', '新手使用的木剑', '1', '0', '0', '1', 23, '0', 0, 1),
('新手布衣', '新手使用的布衣', '0', '2', '0', '0', 24, '10', 0, 3),
('明月之剑', '明月  明月', '3', '0', '0', '1', 25, '0', 0, 1),
('清风护甲', '取自清风常伴', '0', '5', '1', '0', 26, '25', 0, 3),
('百炼青刚剑', '百炼青刚剑', '5', '0', '0', '2', 27, '0', 0, 1),
('百炼轻蕊甲', '百炼轻蕊甲', '0', '8', '0', '0', 28, '40', 0, 3),
('初级嗜血剑', '初级嗜血剑', '2', '0', '1', '3', 29, '0', 0, 1),
('轻蕊盔', '轻蕊盔', '0', '7', '1', '0', 30, '50', 0, 2),
('雷鹰护甲', '雷鹰护甲', '0', '8', '1', '0', 31, '55', 0, 3),
('血鹰项链', '血鹰项链', '0', '3', '3', '5', 32, '20', 0, 0),
('黑魔匕首', '黑魔匕首', '14', '0', '3', '4', 33, '0', 0, 0),
('中级噬血剑', '中级噬血剑', '15', '0', '0', '4', 34, '0', 0, 0),
('普通蛮甲', '普通蛮甲', '0', '9', '2', '0', 35, '62', 0, 0),
('陨铁武棍', '陨铁武棍', '8', '3', '1', '1', 36, '0', 0, 0),
('月轮枪', '月轮枪', '10', '0', '0', '2', 37, '0', 0, 0),
('厚土甲', '厚土甲', '0', '10', '1', '0', 38, '120', 0, 0),
('嗜魂骨忍', '嗜魂骨忍', '17', '0', '5', '3', 39, '0', 0, 0),
('百斩狂澜枪', '百斩狂澜', '20', '0', '0', '5', 40, '0', 0, 0),
('缘风·虬雷衣', '缘风·虬雷衣', '0', '10', '0', '0', 41, '150', 0, 0),
('缘风·墨魂靴', '缘风·墨魂靴', '0', '10', '3', '0', 42, '155', 0, 0),
('缘风·破军腰带', '缘风·破军腰带', '0', '14', '0', '0', 43, '170', 0, 0),
('缘风·兽魂项链', '缘风·兽魂项链', '18', '12', '4', '4', 44, '55', 0, 0),
('[神器]妖王剑', '[神器]妖王剑\r\n妖王剑碎片合成', '45', '0', '13', '11', 45, '0', 0, 0),
('劫刀', '劫刀', '25', '0', '4', '5', 46, '0', 0, 0),
('军用锁子甲', '军用锁子甲', '5', '16', '5', '0', 47, '170', 0, 0),
('军官陌刀', '军官陌刀', '30', '0', '5', '4', 48, '0', 0, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `forum_text`
--
ALTER TABLE `forum_text`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game1`
--
ALTER TABLE `game1`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `game_equip_page`
--
ALTER TABLE `game_equip_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_function_page`
--
ALTER TABLE `game_function_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_item_page`
--
ALTER TABLE `game_item_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_main_page`
--
ALTER TABLE `game_main_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_npc_page`
--
ALTER TABLE `game_npc_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_oplayer_page`
--
ALTER TABLE `game_oplayer_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_pet_page`
--
ALTER TABLE `game_pet_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_player_page`
--
ALTER TABLE `game_player_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_pve_page`
--
ALTER TABLE `game_pve_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_scene_page`
--
ALTER TABLE `game_scene_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_bounty_01`
--
ALTER TABLE `game_self_page_bounty_01`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_HP_lift_1`
--
ALTER TABLE `game_self_page_HP_lift_1`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_HW003`
--
ALTER TABLE `game_self_page_HW003`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_tent`
--
ALTER TABLE `game_self_page_tent`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_test`
--
ALTER TABLE `game_self_page_test`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_vip`
--
ALTER TABLE `game_self_page_vip`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_skill_page`
--
ALTER TABLE `game_skill_page`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `gm_game_attr`
--
ALTER TABLE `gm_game_attr`
  ADD PRIMARY KEY (`pos`);

--
-- 表的索引 `gm_game_basic`
--
ALTER TABLE `gm_game_basic`
  ADD PRIMARY KEY (`game_id`);

--
-- 表的索引 `playerchongwu`
--
ALTER TABLE `playerchongwu`
  ADD PRIMARY KEY (`cwid`);

--
-- 表的索引 `playerzhuangbei`
--
ALTER TABLE `playerzhuangbei`
  ADD PRIMARY KEY (`zbnowid`);

--
-- 表的索引 `system_area`
--
ALTER TABLE `system_area`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_auc`
--
ALTER TABLE `system_auc`
  ADD PRIMARY KEY (`auc_id`);

--
-- 表的索引 `system_auc_data`
--
ALTER TABLE `system_auc_data`
  ADD PRIMARY KEY (`auc_id`) USING BTREE;

--
-- 表的索引 `system_boss`
--
ALTER TABLE `system_boss`
  ADD PRIMARY KEY (`boss_id`);

--
-- 表的索引 `system_buff`
--
ALTER TABLE `system_buff`
  ADD PRIMARY KEY (`buff_id`);

--
-- 表的索引 `system_chat_data`
--
ALTER TABLE `system_chat_data`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_draw`
--
ALTER TABLE `system_draw`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_equip_def`
--
ALTER TABLE `system_equip_def`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_equip_default`
--
ALTER TABLE `system_equip_default`
  ADD PRIMARY KEY (`pos`) USING BTREE;

--
-- 表的索引 `system_equip_user`
--
ALTER TABLE `system_equip_user`
  ADD PRIMARY KEY (`eqid`) USING BTREE;

--
-- 表的索引 `system_event`
--
ALTER TABLE `system_event`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_event_self`
--
ALTER TABLE `system_event_self`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_exp_def`
--
ALTER TABLE `system_exp_def`
  ADD PRIMARY KEY (`pos`) USING BTREE;

--
-- 表的索引 `system_fb`
--
ALTER TABLE `system_fb`
  ADD PRIMARY KEY (`fbid`);

--
-- 表的索引 `system_function`
--
ALTER TABLE `system_function`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_item`
--
ALTER TABLE `system_item`
  ADD PRIMARY KEY (`item_true_id`) USING BTREE;

--
-- 表的索引 `system_item_module`
--
ALTER TABLE `system_item_module`
  ADD PRIMARY KEY (`iid`) USING BTREE;

--
-- 表的索引 `system_item_op`
--
ALTER TABLE `system_item_op`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_lp`
--
ALTER TABLE `system_lp`
  ADD PRIMARY KEY (`lp_id`);

--
-- 表的索引 `system_map`
--
ALTER TABLE `system_map`
  ADD PRIMARY KEY (`mid`);

--
-- 表的索引 `system_map_op`
--
ALTER TABLE `system_map_op`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_mk`
--
ALTER TABLE `system_mk`
  ADD PRIMARY KEY (`mk_id`) USING BTREE;

--
-- 表的索引 `system_money_type`
--
ALTER TABLE `system_money_type`
  ADD PRIMARY KEY (`rid`);

--
-- 表的索引 `system_npc`
--
ALTER TABLE `system_npc`
  ADD PRIMARY KEY (`nid`) USING BTREE;

--
-- 表的索引 `system_npc_midguaiwu`
--
ALTER TABLE `system_npc_midguaiwu`
  ADD PRIMARY KEY (`ngid`) USING BTREE;

--
-- 表的索引 `system_npc_op`
--
ALTER TABLE `system_npc_op`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `system_oplayer`
--
ALTER TABLE `system_oplayer`
  ADD PRIMARY KEY (`oid`) USING BTREE;

--
-- 表的索引 `system_pet_player`
--
ALTER TABLE `system_pet_player`
  ADD PRIMARY KEY (`petid`);

--
-- 表的索引 `system_player`
--
ALTER TABLE `system_player`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `system_pvp_score`
--
ALTER TABLE `system_pvp_score`
  ADD PRIMARY KEY (`pvp_id`) USING BTREE;

--
-- 表的索引 `system_rank`
--
ALTER TABLE `system_rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- 表的索引 `system_regular_tasks`
--
ALTER TABLE `system_regular_tasks`
  ADD PRIMARY KEY (`reg_id`);

--
-- 表的索引 `system_rp`
--
ALTER TABLE `system_rp`
  ADD PRIMARY KEY (`rp_id`);

--
-- 表的索引 `system_self_define_module`
--
ALTER TABLE `system_self_define_module`
  ADD PRIMARY KEY (`pos`,`id`) USING BTREE;

--
-- 表的索引 `system_skill`
--
ALTER TABLE `system_skill`
  ADD PRIMARY KEY (`jid`) USING BTREE;

--
-- 表的索引 `system_skill_module`
--
ALTER TABLE `system_skill_module`
  ADD PRIMARY KEY (`jid`);

--
-- 表的索引 `system_task`
--
ALTER TABLE `system_task`
  ADD PRIMARY KEY (`tid`) USING BTREE;

--
-- 表的索引 `system_task_evs_old`
--
ALTER TABLE `system_task_evs_old`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `system_task_father`
--
ALTER TABLE `system_task_father`
  ADD PRIMARY KEY (`f_id`);

--
-- 表的索引 `system_team_user`
--
ALTER TABLE `system_team_user`
  ADD PRIMARY KEY (`team_id`);

--
-- 表的索引 `system_tran_user`
--
ALTER TABLE `system_tran_user`
  ADD PRIMARY KEY (`tran_id`);

--
-- 表的索引 `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `zhuangbei`
--
ALTER TABLE `zhuangbei`
  ADD PRIMARY KEY (`zbid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `forum_text`
--
ALTER TABLE `forum_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `game1`
--
ALTER TABLE `game1`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `game_equip_page`
--
ALTER TABLE `game_equip_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `game_function_page`
--
ALTER TABLE `game_function_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `game_item_page`
--
ALTER TABLE `game_item_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `game_main_page`
--
ALTER TABLE `game_main_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `game_npc_page`
--
ALTER TABLE `game_npc_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `game_oplayer_page`
--
ALTER TABLE `game_oplayer_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `game_pet_page`
--
ALTER TABLE `game_pet_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `game_player_page`
--
ALTER TABLE `game_player_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `game_pve_page`
--
ALTER TABLE `game_pve_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `game_scene_page`
--
ALTER TABLE `game_scene_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- 使用表AUTO_INCREMENT `game_self_page_bounty_01`
--
ALTER TABLE `game_self_page_bounty_01`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `game_self_page_HP_lift_1`
--
ALTER TABLE `game_self_page_HP_lift_1`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_self_page_HW003`
--
ALTER TABLE `game_self_page_HW003`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_self_page_tent`
--
ALTER TABLE `game_self_page_tent`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_self_page_test`
--
ALTER TABLE `game_self_page_test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `game_self_page_vip`
--
ALTER TABLE `game_self_page_vip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_skill_page`
--
ALTER TABLE `game_skill_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `gm_game_attr`
--
ALTER TABLE `gm_game_attr`
  MODIFY `pos` int(11) NOT NULL AUTO_INCREMENT COMMENT ' 位置', AUTO_INCREMENT=72;

--
-- 使用表AUTO_INCREMENT `playerchongwu`
--
ALTER TABLE `playerchongwu`
  MODIFY `cwid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `playerzhuangbei`
--
ALTER TABLE `playerzhuangbei`
  MODIFY `zbnowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75647;

--
-- 使用表AUTO_INCREMENT `system_auc`
--
ALTER TABLE `system_auc`
  MODIFY `auc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_auc_data`
--
ALTER TABLE `system_auc_data`
  MODIFY `auc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '交易id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `system_chat_data`
--
ALTER TABLE `system_chat_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;

--
-- 使用表AUTO_INCREMENT `system_draw`
--
ALTER TABLE `system_draw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '它的id是什么', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `system_equip_def`
--
ALTER TABLE `system_equip_def`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `system_equip_user`
--
ALTER TABLE `system_equip_user`
  MODIFY `eqid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '源id', AUTO_INCREMENT=111;

--
-- 使用表AUTO_INCREMENT `system_event`
--
ALTER TABLE `system_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- 使用表AUTO_INCREMENT `system_exp_def`
--
ALTER TABLE `system_exp_def`
  MODIFY `pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `system_fb`
--
ALTER TABLE `system_fb`
  MODIFY `fbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `system_item`
--
ALTER TABLE `system_item`
  MODIFY `item_true_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- 使用表AUTO_INCREMENT `system_item_module`
--
ALTER TABLE `system_item_module`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- 使用表AUTO_INCREMENT `system_lp`
--
ALTER TABLE `system_lp`
  MODIFY `lp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_map`
--
ALTER TABLE `system_map`
  MODIFY `mid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=689;

--
-- 使用表AUTO_INCREMENT `system_mk`
--
ALTER TABLE `system_mk`
  MODIFY `mk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_npc`
--
ALTER TABLE `system_npc`
  MODIFY `nid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- 使用表AUTO_INCREMENT `system_npc_midguaiwu`
--
ALTER TABLE `system_npc_midguaiwu`
  MODIFY `ngid` int(11) NOT NULL AUTO_INCREMENT COMMENT '怪物id主键', AUTO_INCREMENT=6365;

--
-- 使用表AUTO_INCREMENT `system_oplayer`
--
ALTER TABLE `system_oplayer`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_player`
--
ALTER TABLE `system_player`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_pvp_score`
--
ALTER TABLE `system_pvp_score`
  MODIFY `pvp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_rank`
--
ALTER TABLE `system_rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `system_rp`
--
ALTER TABLE `system_rp`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_self_define_module`
--
ALTER TABLE `system_self_define_module`
  MODIFY `pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `system_skill`
--
ALTER TABLE `system_skill`
  MODIFY `jid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_team_user`
--
ALTER TABLE `system_team_user`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `zhuangbei`
--
ALTER TABLE `zhuangbei`
  MODIFY `zbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`xunxian`@`%` EVENT `update_game_minute_event` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-30 19:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
UPDATE gm_game_basic SET game_temp_notice_time = game_temp_notice_time-1 WHERE game_temp_notice_time!=0;
DELETE from system_addition_attr where value = 0;
UPDATE game1 g
JOIN (SELECT player_offline_time FROM gm_game_basic LIMIT 1) gb
SET g.sfzx = 0
WHERE gb.player_offline_time != 0
  AND (UNIX_TIMESTAMP() - UNIX_TIMESTAMP(g.endtime)) / 60 > gb.player_offline_time;
END$$

DELIMITER ;
COMMIT;
ALTER EVENT `update_game_minute_event` ENABLE;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
