-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2025-04-23 23:33:39
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
  `sid` varchar(255) CHARACTER SET utf8 NOT NULL,
  `token` text CHARACTER SET utf8 NOT NULL,
  `utran_state` int(11) NOT NULL COMMENT '交易状态，0未交易，1正在进行交易请求确认，2正在交易',
  `uname` varchar(255) NOT NULL DEFAULT '0',
  `uimage` varchar(255) NOT NULL,
  `unick_name` text NOT NULL,
  `ulvl` decimal(65,0) NOT NULL DEFAULT '1',
  `uburthen` decimal(65,0) NOT NULL,
  `umax_burthen` decimal(65,0) NOT NULL,
  `ustorage` int(10) NOT NULL,
  `uis_pve` int(1) NOT NULL DEFAULT '0' COMMENT '0为关闭1为开启',
  `ukill` tinyint(1) NOT NULL DEFAULT '1',
  `uauto_fight` int(1) NOT NULL COMMENT '0为关闭状态，1为开启状态',
  `uis_sailing` int(11) NOT NULL COMMENT '0为关闭状态，1为开启状态',
  `uauto_sailing` int(11) NOT NULL COMMENT '0为关闭状态，1为开启状态',
  `umoney` int(11) NOT NULL DEFAULT '0',
  `uteam_invited_id` int(11) NOT NULL,
  `uteam_id` int(11) NOT NULL,
  `uteam_putin_id` int(11) NOT NULL,
  `uclan_id` int(11) NOT NULL,
  `uexp` decimal(65,0) NOT NULL DEFAULT '0',
  `uhp` decimal(65,0) NOT NULL DEFAULT '100',
  `umaxhp` decimal(65,0) NOT NULL DEFAULT '100',
  `ump` decimal(65,0) NOT NULL DEFAULT '50',
  `umaxmp` decimal(65,0) NOT NULL DEFAULT '50',
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
  `ispvp` int(11) NOT NULL DEFAULT '0',
  `uwg_fj` int(11) NOT NULL DEFAULT '0',
  `uis_roading` int(11) NOT NULL,
  `uauto_roading` int(1) NOT NULL,
  `uis_skying` int(11) NOT NULL,
  `uauto_skying` int(1) NOT NULL,
  `ubj` int(11) NOT NULL DEFAULT '0',
  `uspeed` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `game1`
--

INSERT INTO `game1` (`uis_designer`, `uis_forum_gm`, `uid`, `ucmd`, `ulast_cmd`, `uphone`, `sid`, `token`, `utran_state`, `uname`, `uimage`, `unick_name`, `ulvl`, `uburthen`, `umax_burthen`, `ustorage`, `uis_pve`, `ukill`, `uauto_fight`, `uis_sailing`, `uauto_sailing`, `umoney`, `uteam_invited_id`, `uteam_id`, `uteam_putin_id`, `uclan_id`, `uexp`, `uhp`, `umaxhp`, `ump`, `umaxmp`, `ugj`, `ufy`, `usex`, `endtime`, `minutetime`, `nowmid`, `justmid`, `tpsmid`, `nowguaiwu`, `sfzx`, `allchattime`, `citychattime`, `areachattime`, `cw`, `ispvp`, `uwg_fj`, `uis_roading`, `uauto_roading`, `uis_skying`, `uauto_skying`, `ubj`, `uspeed`) VALUES
(1, 1, 1, 'gm_scene_new', 'gm_scene_new', '18150040719', '959c9277a3e15eacff9e5f117e51f5bb', '6153c573c2237ed0422c426d6786dc4f', 1, '轩辕', '玩家形象照|player_1', 'GM小小', '21', '1294', '999999', 0, 0, 0, 0, 0, 1, 20166, 0, 0, 1, 1, '1066', '2147483620', '2147483647', '2147483647', '2147483647', 1273, 40, '男', '2025-04-23 23:33:20', '2025-04-23 23:33:53', 306, 306, 0, 0, 1, '2025-03-07 13:16:01', '2023-12-14 14:59:02', '2023-12-14 15:00:25', 0, 0, -397, 0, 0, 0, 1, 0, 6),
(0, 0, 4, '', 'gm_scene_new', '', '214658c4375c343e280ae38e880ac4ba', '8fcae6b1a6f201d1b25d3186f1887f6a', 1, '心醉迷神', '', '', '2', '28', '50', 0, 0, 0, 0, 0, 0, 50, 0, 0, 0, 0, '292', '47', '168', '0', '0', 12, 5, '女', '2024-06-06 13:01:18', '2024-06-06 08:03:11', 671, 671, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 5, 'gm_game_firstpage', 'gm_scene_new', '', 'a8c7b0c51c60be7441214c0b0c671d88', '11de1b2d74bff722bf47c1fe0d7a1586', 1, 'xunxian', '', '', '1', '10', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '男', '2025-04-04 09:32:36', '2025-04-04 09:33:34', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 6, '', 'gm_scene_new', '', '01a0d4f5e64a677721a1089d4914bc6a', 'bd6ad1a2bd957d1af8f9029bd86054b2', 0, '规划', '', '', '1', '15', '50', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '1', '1', '100', '0', '0', 12, 5, '男', '2024-06-05 06:09:08', '2024-06-05 06:09:49', 671, 671, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 7, '', '', '', '79462faa70c368423c7f9fb106fa1f47', '8a3f0145cdd02d3a5b21faa47335ad5a', 0, 'aaa123', '', '', '1', '13', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '男', '2024-06-05 14:05:43', '2024-06-05 14:06:14', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, 0, 8, 'gm_skill_def', 'gm_scene_new', '', '945fd26d30e007abfed414cc1f2795f5', '5fd37cf7246fdd96c1a6808dd0a9776c', 0, '天涯', '玩家形象照|player_8', '', '5', '47', '1000000', 0, 0, 0, 0, 0, 0, 520, 0, 0, 0, 1, '640', '89614', '300', '9961', '10000', 2147483647, 1000, '男', '2025-04-18 08:02:00', '2025-04-18 08:01:56', 274, 274, 0, 0, 1, '2025-03-06 23:14:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 10, 0, 0, 0, 0, 0, 1),
(0, 0, 9, 'gm_scene_new', 'gm_scene_new', '', 'f55913444ef985484baf7580c60f15ce', '3bd64d874d8de07e0c000130eac39cd1', 0, '天涯小号', '', '', '2', '25', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '278', '1', '168', '0', '0', 8888, 9, '男', '2025-03-21 01:53:36', '2025-03-21 01:54:09', 338, 338, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 10, 'main_target_event', 'gm_scene_new', '', 'fe3319b6dd10f68aaa36ee852cd79cc1', '7b69c4b07cd900f5b85f89e64e834d38', 0, '云澈', '', '', '1', '38', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '98', '100', '0', '0', 1000, 5, '男', '2025-04-19 20:51:14', '2025-04-19 20:51:58', 565, 565, 0, 0, 0, '0000-00-00 00:00:00', '2024-06-06 01:04:31', '2024-06-06 01:04:26', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 11, '', 'gm_scene_new', '', '01acd0637eb2b6a6a3055e4fc37e8457', 'a7d8a52f6f62b749aacd656156101e9e', 0, '蜉蝣', '', '', '1', '14', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '5', '1', '100', '0', '0', 12, 5, '男', '2024-07-06 23:32:07', '2024-07-06 23:31:44', 672, 672, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 12, '', 'gm_game_firstpage', '', '2f4746d4d36396302d36e51c969d3e68', '604077277c57e12b1e3f0a9815a979fa', 0, '急急忙忙', '', '', '1', '11', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '男', '2024-06-07 07:06:54', '2024-06-06 08:20:52', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 13, '', 'gm_scene_new', '', 'e3130d019f7689f5501bc3633f97eb88', '9cc64b284957f1afb54f20caceac59a0', 0, '大王的', '', '', '1', '0', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '男', '2024-06-11 22:32:11', '2024-06-11 22:33:02', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 14, '', '', '', '76623f3a68872fa88502af535498a991', 'b0d565aa0d423b7507a2ff7eda5db95f', 0, '测试123', '', '', '1', '20', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '男', '2024-06-15 10:09:52', '2024-06-15 10:09:48', 226, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 15, '', '', '', 'f244e629c0bc88068f2ecd6baf212683', 'fd7900c0d69114b7caad71ce86c9eb58', 0, '34D大波', '', '', '1', '0', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '女', '2024-06-15 11:46:07', '2024-06-15 11:47:02', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 16, 'item_op_basic', 'gm_scene_new', '', 'f4cd01caaf9ec17c03413de91b97b5f2', '4be4c87864dc5d0fcc627e4d96806211', 0, '34D大波浪', '', '', '1', '12', '50', 0, 0, 0, 1, 0, 0, 2, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '女', '2025-01-27 08:25:13', '2025-01-27 07:20:07', 229, 229, 0, 0, 0, '2025-01-26 21:57:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 17, '', 'gm_scene_new', '', '344773e829d514e37d748e906a4f020a', '3452fa0da5eba8106aa44154660dd821', 0, '寒奇', '', '', '1', '16', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '0', '0', 12, 5, '男', '2024-06-21 20:28:07', '2024-06-21 20:28:45', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 20, '', 'gm_scene_new', '', '98c50608a11ec800fba8b2d0b7294aeb', '137033b69556ca35b8fb9da749db1a57', 0, '等我打完', '', '', '1', '14', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '82', '100', '0', '0', 12, 5, '男', '2024-06-30 16:15:07', '2024-06-30 16:15:36', 226, 226, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 21, 'gm_scene_new', 'gm_scene_new', '', '269d6f1d2272bf0f3af7633340052a03', '51a8c1a197e4c37ce59cc3af3b5c5d5e', 0, '江', '', '', '1', '22', '50', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '11', '100', '100', '0', '0', 12, 5, '男', '2025-03-08 14:22:52', '2025-03-08 14:23:10', 305, 305, 0, 0, 0, '2025-02-05 10:50:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 22, '', 'gm_game_firstpage', '', '740c4edeb4bb99c86b2a9b6ee4321422', '8a92f5f23dae59c409b4ef40012ce0d2', 0, '门口', '', '', '1', '10', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '0', '0', '100', 12, 5, '男', '2024-09-05 00:39:52', '2024-09-05 00:39:51', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 23, '', 'gm_scene_new', '', '14ff4a179003b2934da7305a76f718ea', 'f716ebf9b02ce37a5a5530c8fe3c305b', 0, '牛逼', '', '', '1', '18', '50', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, '0', '0', '0', '10', '100', 12, 5, '男', '2024-09-17 16:50:51', '2024-09-17 16:51:06', 225, 225, 0, 0, 0, '2024-09-17 16:45:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 24, 'map_detail', 'gm_game_firstpage', '', '0961f64bfc048e983d34059857ffaffa', '36310ea1a682b2574b5e99df4aa30097', 0, 'dfggdf', '', '', '1', '0', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '100', 12, 5, '男', '2024-09-24 02:53:56', '2024-09-24 02:54:50', 225, 225, 0, 0, 0, '2024-09-24 02:41:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 25, '', 'player_state', '', 'b17c95134e98e11fd56a4d9edfd0df0d', 'a5f991264806f81164bbd92267c2824d', 0, 'wahaha', '', '', '1', '0', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '100', 12, 5, '男', '2024-09-25 16:43:13', '2024-09-25 16:43:51', 225, 225, 0, 0, 0, '2024-09-25 16:42:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 39, 'gm_scene_new', '', '', '46fbdae565140a8d73246e1e01f64b66', 'cd1da21c393f3f7000b7538a9e3e3b3b', 0, '测试33', '', '', '1', '0', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '1', '0', '0', '100', 12, 5, '男', '2025-04-18 18:47:49', '2025-04-18 18:48:45', 225, 225, 0, 0, 0, '2024-10-29 09:36:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 40, '', 'gm_scene_new', '', '11949d9ce6df5a06a3377325c71c7c4f', 'd7a145c2d6a9057895f5396f0a4f98b6', 0, '浪子阿伟', '', '', '1', '19', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '1', '0', '0', '100', 12, 5, '男', '2025-02-10 18:15:11', '2025-02-10 18:15:55', 230, 230, 0, 0, 0, '2025-02-10 18:12:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 41, '', 'gm_scene_new', '', 'f3c4859c79f6f34ac79072571744bf8e', 'e9b4d3f3056b4f6d3184802a0a65ae9f', 0, 'igq6y1q', '', '', '1', '13', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '100', 12, 5, '男', '2024-11-17 09:39:33', '2024-11-17 09:40:14', 225, 225, 0, 0, 0, '2024-11-17 09:38:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 42, '', 'gm_scene_new', '', '79ca852ae3c34e005ba8db7ca9f2429e', 'bc3006729315b7585b27d81bf0274990', 0, '深蓝V', '', '', '1', '12', '50', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '100', 12, 5, '男', '2024-12-04 21:48:26', '2024-12-04 21:49:04', 225, 225, 0, 0, 0, '2024-12-04 21:40:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 46, 'gm_scene_new', 'gm_scene_new', '', '4e792f072d10eb2f6addd8d04cf5cbe8', 'e0eaeb7d19fcde3fbd6075c91a6e7039', 0, '梦浅', '玩家形象照|player_46', '旧街居民', '17', '85', '111', 0, 0, 1, 0, 0, 0, 7377, 0, 0, 0, 0, '6529', '124', '1188', '101', '182', 33, 5, '女', '2025-04-22 21:38:19', '2025-04-22 21:39:04', 598, 598, 0, 0, 0, '2025-03-07 13:25:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 2),
(0, 0, 47, 'npc_html', 'gm_scene_new', '', '0732ec1c98e6496b097d7bee1482d96d', '0515e74c53238527a0984ec7d0c2b40e', 0, '扫地魔', '', '', '1', '10', '50', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-02-27 14:25:43', '2025-02-27 14:26:08', 225, 225, 0, 0, 0, '2025-02-27 14:25:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 48, 'gm_scene_new', 'gm_game_firstpage', '', '40499b34a8c1fd21aca27a6f780913b7', 'ad5ba9f6bc0c1ceff956e352a1c1c06e', 0, '摇摇要', '', '', '1', '11', '50', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '99', '100', '50', '50', 12, 5, '女', '2025-03-10 13:03:22', '2025-03-10 13:03:30', 225, 225, 0, 0, 0, '2025-03-02 15:53:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 49, 'gm_shop_npc', 'npc_html', '', '712f6f87ae511e72bec397c34b66341e', 'b071448562b7cc0823f2f175d8a1b9b4', 0, 'rfgdfgd', '', '', '1', '23', '50', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '79', '100', '50', '50', 12, 5, '男', '2025-03-02 23:58:07', '2025-03-02 23:58:43', 299, 226, 0, 0, 0, '2025-03-02 23:54:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 50, 'gm_scene_new', 'gm_scene_new', '', '3f47043a9d21b1e33eafe14c8e43ff23', 'c566f5f84eea89926745b6ad790e917f', 0, 'fgf23发', '', '', '1', '13', '50', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '87', '100', '50', '50', 12, 5, '男', '2025-03-03 09:54:15', '2025-03-03 09:54:46', 226, 226, 0, 0, 0, '2025-03-03 09:50:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 51, 'liaotian', 'gm_scene_new', '', 'c654e54b080f01395814de4cc5a56a36', '915e74aeb7dacd7cff046fb717442c84', 0, '喂喂喂', '', '', '1', '15', '50', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2', '8', '100', '44', '50', 12, 5, '男', '2025-03-04 02:46:34', '2025-03-04 02:47:29', 232, 232, 0, 0, 0, '2025-03-04 02:41:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 52, 'gm_scene_new', 'npc_html', '', '997e35c67ee90c752adcafcb9146ef0c', 'd39a06ebe169ffccf1512794b8f731dc', 0, '无情', '', '', '1', '0', '0', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '1', '62', '100', '44', '50', 12, 5, '女', '2025-03-06 08:31:30', '2025-03-06 08:32:20', 630, 630, 0, 0, 0, '2025-03-06 08:30:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 53, 'gm_game_firstpage', '', '', '79734573fabe99c2d7b9730fb55b8179', '723f505d88b6db518af0e156d26ed9ec', 0, '李三', '', '', '1', '0', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-03-07 09:05:46', '2025-03-07 09:06:45', 225, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 54, 'liaotian', '', '', '1031e7b699b6b7c0591c7bd314656738', 'e6dbb8b8b41d9c21d22811c06671a25e', 0, 'backdoo', '', '', '1', '0', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-03-10 11:35:42', '2025-03-10 11:36:07', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 55, 'gm_scene_new', 'npc_html', '', '18280efc59907bd2fb48b26d077e374c', 'ec48ace33ac5046062b6416de507e72d', 0, '笑面虎', '', '', '1', '3', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '女', '2025-03-14 01:23:10', '2025-03-14 01:23:50', 307, 294, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 56, 'player_pet', '', '', '428ef3d7da115de87950f34ca0d6ea65', 'ba1380d41be69537aff83a18fcdc17fd', 0, '123456', '', '', '1', '0', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-03-18 22:23:12', '2025-03-18 22:23:36', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 57, 'gm_scene_new', 'gm_scene_new', '', '75f1c222ad8c86ed1fa97f4026ccbb49', '5338ef3de7fd72cdc5749874f8ca5fd8', 0, 'heiyuli', '', '', '1', '0', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-03-20 18:22:53', '2025-03-20 18:23:51', 299, 296, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 58, '', 'gm_scene_new', '', '1f50c749d050ef9cb714a1987d044462', '77c380c398eca339712d35e4c883569d', 0, '诛仙', '', '', '1', '10', '100', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '14', '24', '100', '38', '50', 12, 5, '男', '2025-03-30 21:24:10', '2025-03-30 21:24:19', 630, 630, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 59, 'item_html', '', '', 'd772445edc9d6a2be038c82c9fd09c31', '4df2e27e9291efe9b9cacdf2a443c313', 0, '三三', '', '', '1', '0', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-04-22 09:02:33', '2025-04-22 09:02:57', 225, 225, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, 0, 60, 'gm_scene_new', '', '', '11bcf4429ca461cbb0a1bd8bbbb804c7', '51547217b283793f56da7e8211bc69b0', 0, '哈哈哈', '', '', '1', '10', '100', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '0', '100', '100', '50', '50', 12, 5, '男', '2025-04-22 19:09:37', '2025-04-22 19:10:31', 296, 296, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `game2`
--

CREATE TABLE `game2` (
  `sid` text NOT NULL,
  `pid` int(11) NOT NULL,
  `gid` text NOT NULL,
  `fight_umsg` text NOT NULL,
  `fight_omsg` text NOT NULL,
  `round` int(11) DEFAULT '0',
  `type` int(1) DEFAULT '0' COMMENT '1是玩家对怪物，2是怪物对玩家，3是怪物对宠物，4是宠物对怪物，5是玩家对玩家',
  `hurt_hp` decimal(65,0) NOT NULL,
  `cut_hp` decimal(65,0) NOT NULL,
  `hurt_mp` decimal(65,0) NOT NULL,
  `cut_mp` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='临时表';

--
-- 转存表中的数据 `game2`
--

INSERT INTO `game2` (`sid`, `pid`, `gid`, `fight_umsg`, `fight_omsg`, `round`, `type`, `hurt_hp`, `cut_hp`, `hurt_mp`, `cut_mp`) VALUES
('1f50c749d050ef9cb714a1987d044462', 0, '4233', '诛仙使用普通攻击对泥泞元素怪一阵乱打。', '泥泞元素怪猛地朝着诛仙扑撞了过去！', 1, 2, '0', '-38', '0', '0'),
('1f50c749d050ef9cb714a1987d044462', 0, '4233', '诛仙使用普通攻击对泥泞元素怪一阵乱打。', '', 1, 1, '-40', '0', '0', '0'),
('1f50c749d050ef9cb714a1987d044462', 0, '4233', '诛仙使用普通攻击对泥泞元素怪一阵乱打。', '', 2, 1, '-46', '0', '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `game3`
--

CREATE TABLE `game3` (
  `gid` text NOT NULL,
  `sid` text NOT NULL,
  `hurt_hp` decimal(65,0) NOT NULL,
  `cut_hp` decimal(65,0) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `hurt_mp` decimal(65,0) NOT NULL,
  `cut_mp` decimal(65,0) NOT NULL,
  `round` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='怪物临时表';

--
-- 转存表中的数据 `game3`
--

INSERT INTO `game3` (`gid`, `sid`, `hurt_hp`, `cut_hp`, `pid`, `hurt_mp`, `cut_mp`, `round`, `type`) VALUES
('4233', '1f50c749d050ef9cb714a1987d044462', '0', '0', 0, '0', '-1', 1, 2),
('Array', '1f50c749d050ef9cb714a1987d044462', '0', '0', 0, '0', '-3', 1, 1),
('Array', '1f50c749d050ef9cb714a1987d044462', '0', '0', 0, '0', '-3', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `game4`
--

CREATE TABLE `game4` (
  `sid` text NOT NULL,
  `device_agent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game4`
--

INSERT INTO `game4` (`sid`, `device_agent`) VALUES
('0732ec1c98e6496b097d7bee1482d96d', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0'),
('712f6f87ae511e72bec397c34b66341e', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
('3f47043a9d21b1e33eafe14c8e43ff23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0'),
('c654e54b080f01395814de4cc5a56a36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
('997e35c67ee90c752adcafcb9146ef0c', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0'),
('79734573fabe99c2d7b9730fb55b8179', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36'),
('269d6f1d2272bf0f3af7633340052a03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.6261.95 Safari/537.36'),
('1031e7b699b6b7c0591c7bd314656738', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0'),
('40499b34a8c1fd21aca27a6f780913b7', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36'),
('18280efc59907bd2fb48b26d077e374c', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'),
('428ef3d7da115de87950f34ca0d6ea65', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/537.36 SE 2.X MetaSr 1.0'),
('75f1c222ad8c86ed1fa97f4026ccbb49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
('f55913444ef985484baf7580c60f15ce', 'Mozilla/5.0 (Linux; U; Android 13; zh-CN; M2102J2SC Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/123.0.6312.80 Quark/7.9.1.770 Mobile Safari/537.36'),
('1f50c749d050ef9cb714a1987d044462', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0'),
('a8c7b0c51c60be7441214c0b0c671d88', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36'),
('945fd26d30e007abfed414cc1f2795f5', 'Mozilla/5.0 (Linux; U; Android 13; zh-CN; M2102J2SC Build/TKQ1.221114.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/123.0.6312.80 Quark/7.10.5.800 Mobile Safari/537.36'),
('46fbdae565140a8d73246e1e01f64b66', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4.1 Mobile/15E148 Safari/604.1'),
('fe3319b6dd10f68aaa36ee852cd79cc1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36'),
('d772445edc9d6a2be038c82c9fd09c31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36'),
('11bcf4429ca461cbb0a1bd8bbbb804c7', 'Mozilla/5.0 (Linux; Android 14; V2338A Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/121.0.6167.71 MQQBrowser/6.2 TBS/047501 Mobile Safari/537.36 V1_AND_SQ_9.1.65_9558_YYB_D QQ/9.1.65.24795 NetType/WIFI WebP/0.3.0 AppId/537278304 Pixel/1260 StatusBarHeight/126 SimpleUISwitch/0 QQTheme/1000 StudyMode/0 CurrentMode/0 CurrentFontScale/1.0 GlobalDensityScale/0.90000004 AllowLandscape/false InMagicWin/0'),
('4e792f072d10eb2f6addd8d04cf5cbe8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36'),
('959c9277a3e15eacff9e5f117e51f5bb', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- 表的结构 `game_equip_detail_page`
--

CREATE TABLE `game_equip_detail_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_equip_detail_page`
--

INSERT INTO `game_equip_detail_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '{o.name}\r\n介绍：{o.desc}\r\n根：{o.root}\r\n物攻：{o.wg_fj}\r\n可镶宝数：{o.embed_count}\r\n===========\r\n', NULL, '0', NULL, NULL),
(2, 2, '3', '', '镶嵌', NULL, '0', '88', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_equip_page`
--

CREATE TABLE `game_equip_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
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
  `value` text,
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
  `value` text,
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
(4, 2, '1', '', '【类别】:{o.type}{eval(v(o.subtype)!=\"\"&&v(o.type)!=\"兵器\"&&v(o.type)!=\"防具\"?\"-v(o.subtype)\":\"\")}\r\n【重量】:{o.weight}\r\n【来源】:{o.root}\r\n【介绍】:{o.desc}\r\n【使用等级】:{o.lvl}\r\n【是否可赠送】:{eval(v(o.no_give)==\"0\"?\"是\":\"否\")}\r\n【是否可丢弃】:{eval(v(o.no_out)==\"0\"?\"是\":\"否\")}\r\n', NULL, '0', NULL, NULL),
(3, 3, '1', '', '【价格】:{o.price}枚\r\n', NULL, '0', NULL, NULL),
(8, 4, '3', '', '操作列表\r\n', NULL, '0', '6', '0'),
(5, 7, '1', '{o.type} == \"兵器\"', '【攻击力】:{o.attack_value}\r\n【物攻】:{o.wg_fj}\r\n【镶物物攻】:{o.added_wg}\r\n【额外魔攻】:{o.added_mg}\r\n', NULL, '0', NULL, NULL),
(6, 8, '1', '{o.type} == \"防具\"', '【防御力】:{o.recovery_value}\r\n', NULL, '0', NULL, NULL),
(1, 9, '1', '{o.image}!=\'\'', '#{o.image}#', NULL, '0', NULL, NULL),
(7, 10, '1', '{o.embed_count} >0&&({o.type}==\"兵器\"||{o.type}==\"防具\")', '【孔数】:{o.embed_count}\r\n【孔1】：{eval(v(o.embed.0.name)?\"v(o.embed.0.name)\":\"无\")}\r\n【孔2】：{eval(v(o.embed.1.name)?\"v(o.embed.1.name)\":\"无\")}\r\n', NULL, '0', NULL, NULL),
(9, 11, '2', '{u.is_designer} == 1&&{o.no_give} ==0', '物品绑定\r\n', NULL, '206', NULL, NULL),
(10, 12, '2', '{u.is_designer} == 1&&{o.no_give} ==1', '物品解绑\r\n', NULL, '210', '12', NULL),
(11, 15, '3', '{o.type} == \'兵器\'||{o.type} == \'防具\'', '镶嵌', NULL, '0', '90', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_main_page`
--

CREATE TABLE `game_main_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT '0',
  `value` text,
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
(2, 2, '3', '{u.is_designer}==1', '设计游戏\r\n', NULL, '0', '64', NULL),
(3, 3, '3', '', '进入游戏', NULL, '0', '65', NULL),
(9, 5, '1', '', '{e.time_name}好！\r\n{e.greeting_text}\r\n----------------\r\n@ff0000@《健康游戏忠告》@end@\r\n抵制不良游戏，拒绝盗版游戏\r\n适度游戏益脑，沉迷游戏伤身\r\n合理安排时间，享受健康生活\r\n', NULL, '0', NULL, NULL),
(10, 6, '2', '', '用户协议', NULL, '2', NULL, NULL),
(5, 10, '3', '', '游戏论坛\r\n', NULL, '0', '66', NULL),
(4, 11, '1', '', '|', NULL, '0', '1', NULL),
(6, 12, '2', '', '背景故事', NULL, '45', NULL, NULL),
(7, 13, '1', '', '|', NULL, '0', '1', NULL),
(8, 15, '4', '', '同人小说\r\n', NULL, '0', NULL, 'https://book.qidian.com/info/1035615776/'),
(11, 16, '1', '', '|', NULL, '0', '1', NULL),
(12, 17, '2', '', '账号安全\r\n', NULL, '44', NULL, NULL),
(13, 18, '5', '', '请输入1：<input name =\"test1\"><br/>请输入2：<input name =\"test2\"><br/><input type =\"submit\">', NULL, '204', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_npc_page`
--

CREATE TABLE `game_npc_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_npc_page`
--

INSERT INTO `game_npc_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(2, 1, '1', '{o.nick_name}!=0', '{o.nick_name}.', NULL, '0', NULL, NULL),
(3, 2, '1', '', '「{o.name}」\r\n性别：{eval(v(o.sex)?:\"未知\")}\r\n{eval(v(o.kill)==1?\"等级：v(o.lvl)级\":\"中立\")}\r\n状态：{eval(v(e.oplayer_state))}\r\n', NULL, '0', NULL, NULL),
(8, 3, '3', '', '操作列表\r\n', NULL, '0', '6', '0'),
(10, 4, '1', '{o.desc}!=\'\'', '{o.desc}\r\n', NULL, '0', NULL, '0'),
(5, 5, '1', '{o.kill}==1', '体力：{o.hp}/{o.maxhp}\r\n法力：{o.mp}/{o.maxmp}\r\n攻击力：{o.gj}\r\n防御力：{o.fy}\r\n', NULL, '0', NULL, NULL),
(7, 8, '1', '{o.skills_cmmt}!=\"\"', '技能：{o.skills_cmmt}\r\n', NULL, '0', NULL, NULL),
(6, 9, '1', '{o.equips_cmmt}!=\"\"', '装备：{o.equips_cmmt}\r\n', NULL, '0', NULL, NULL),
(1, 10, '1', '', '「{u.env.name}」\r\n', NULL, '0', NULL, NULL),
(9, 11, '3', '{o.id}==\"35\"', '镶嵌装备\r\n', NULL, '0', '77', NULL),
(4, 12, '1', '{o.image}!=\"\"', '#{o.image}#\r\n', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_oplayer_page`
--

CREATE TABLE `game_oplayer_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_oplayer_page`
--

INSERT INTO `game_oplayer_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(2, 3, '1', '', '「{o.name}」\r\n{eval(v(o.image)?\"#v(o.image)#\":\"\")}\r\n一个纯洁善良的人（罪恶值：0）。\r\n{o.lvl}级{o.sex}{eval(v(o.nick_name)?\"【{o.nick_name}】\":\"【无名之辈】\")}\r\n「{o.env.name}」-{eval(v(ot.is_computer)==0?\"「手机在线」\":(v(ot.is_computer)==1?\"「电脑在线」\":\"「离线」\"))}\r\n状态:{eval(v(e.oplayer_state))}\r\n', NULL, '0', NULL, NULL),
(3, 4, '3', '', '操作列表\r\n', NULL, '0', '6', '0'),
(1, 5, '1', '', '「世界的初学者」\r\n', NULL, '0', NULL, NULL),
(4, 9, '3', '{u.is_designer} ==1', '邀请组队\r\n', NULL, '0', '43', NULL),
(5, 10, '3', '', '赠送\r\n', NULL, '0', '41', NULL),
(6, 11, '3', '', '加为好友\r\n|删除好友\r\n', NULL, '0', '45', NULL),
(7, 12, '3', '', '加黑名单\r\n|删黑名单\r\n', NULL, '0', '46', NULL),
(8, 13, '2', '{u.is_designer} == 1', '传送到对方位置\r\n', NULL, '167', NULL, NULL),
(9, 14, '2', '{u.is_designer} == 1', '设置对方\r\n', NULL, '198', '12', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_pet_page`
--

CREATE TABLE `game_pet_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_pet_page`
--

INSERT INTO `game_pet_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '{eval(v(o.photo)?:\"外形不详\")}\r\n名称：{o.name}\r\n状态：{eval(v(o.state)==1?\"出战中\":\"休息中\")}\r\n{o.name}： 亲爱的主人……吃饱了！精神亢奋！咱是不是可以出去打架了？\r\n生命:{o.hp}/{o.maxhp}\r\n魔法:{o.mp}/{o.maxmp}\r\n出招速度:{o.speed}\r\n攻:{o.gj} | 防:{o.fy}\r\n', NULL, '0', NULL, NULL),
(5, 2, '3', '', '收放', NULL, '0', '79', NULL),
(4, 3, '1', '', '技能：{o.skills_cmmt}\r\n装备：{eval(v(o.equips_cmmt)?:\"无\")}\r\n', NULL, '0', NULL, NULL),
(6, 4, '1', '', '|', NULL, '0', '12', NULL),
(7, 5, '3', '', '技能', NULL, '0', '82', NULL),
(8, 6, '1', '', '|', NULL, '0', '12', NULL),
(9, 7, '3', '', '装备', NULL, '0', '83', NULL),
(10, 8, '1', '', '|', NULL, '0', '12', NULL),
(11, 9, '3', '', '物品', NULL, '0', '87', NULL),
(2, 11, '3', '', '宠物喂食\r\n', NULL, '0', '86', NULL),
(3, 12, '3', '', '宠物清洁\r\n', NULL, '0', '85', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_player_page`
--

CREATE TABLE `game_player_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_player_page`
--

INSERT INTO `game_player_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '[{eval(v(u.nick_name)?:\"无\")}]姓名：{u.name}\r\n状态：{eval(v(e.player_state))}\r\nid：{u.id}\r\n{eval(v(u.image)?\"#v(u.image)#\":\"该用户很懒，没有上传形象照。\")}\r\n性别：{u.sex}\r\n等级：{u.lvl}\r\n经验：{u.exp}/{eval(v(e.maxexp))}\r\n生命：{u.hp}/{u.maxhp}\r\n法力：{u.mp}/{u.maxmp}\r\n出招速度：{u.speed}/100\r\n信用币：{eval(v(u.money)/10000)}金点{eval(v(u.money)>=10000?(v(u.money)%10000/100):(v(u.money)/100))}银点{eval(v(u.money)>=100?(v(u.money)%100):(v(u.money)))}铜点\r\n未来币：{stru(u.money2)}枚\r\n负重：{u.burthen}/{u.max_burthen}\r\n攻击力：{u.gj}\r\n物攻附加：{u.wg_fj}\r\n防御力：{u.fy}\r\n暴击：{u.bj}%\r\n===\r\n在线时间：{u.zxsj}分\r\n===\r\n', NULL, '0', NULL, NULL),
(2, 2, '3', '', '物品', NULL, '0', '17', '0'),
(3, 3, '3', '', '聊天', NULL, '0', '24', '0'),
(4, 4, '3', '', '技能\r\n', NULL, '0', '15', '0'),
(5, 7, '3', '', '装备', NULL, '0', '16', '0'),
(6, 8, '3', '', '好友', NULL, '0', '22', NULL),
(7, 11, '3', '', '队伍\r\n', NULL, '0', '19', NULL),
(8, 12, '2', '{u.land.name}!=\"\"&&{u.boat.name}!=\"\"&&{u.craft.name}!=\"\"', '次元载具\r\n', NULL, '98', NULL, NULL),
(9, 13, '3', '', '上传形象照\r\n', NULL, '0', '27', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_pve_page`
--

CREATE TABLE `game_pve_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_pve_page`
--

INSERT INTO `game_pve_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(8, 2, '1', '', '[{u.name}]:\r\n生命：({u.hp}/{u.maxhp})', NULL, '0', NULL, NULL),
(9, 3, '1', '{ut.fight_show_cut}==1 && {ut.cut_hp}!=0', '{eval((v(ut.cut_hp)>0?\"+\":\"\")+\"v(ut.cut_hp)\")}', NULL, '0', NULL, NULL),
(13, 4, '1', '', '\r\n', NULL, '0', NULL, NULL),
(14, 5, '1', '', '----------\r\n', NULL, '0', NULL, NULL),
(15, 6, '3', '', '敌人状态\r\n', NULL, '0', '60', '0'),
(5, 8, '3', '', '快捷键1', NULL, '0', '50', '0'),
(6, 9, '3', '', '快捷键2', NULL, '0', '51', '0'),
(7, 10, '3', '', '快捷键3\r\n', NULL, '0', '52', '0'),
(17, 11, '3', '', '逃跑\r\n', NULL, '0', '63', NULL),
(18, 12, '1', '', '报时:{c.nowtime_H:i:s}\r\n', NULL, '0', NULL, NULL),
(2, 13, '3', '{u.auto_fight}==0', '开启自动战斗', NULL, '0', '71', NULL),
(3, 14, '3', '{u.auto_fight}==1', '关闭自动战斗', NULL, '0', '72', NULL),
(4, 15, '3', '', '查看\r\n', NULL, '0', '73', NULL),
(16, 16, '3', '', '敌人攻击描述\r\n', NULL, '0', '62', NULL),
(1, 17, '3', '', '自己攻击描述\r\n', NULL, '0', '61', NULL),
(19, 18, '3', '', '自己状态\r\n', NULL, '0', '59', NULL),
(20, 19, '3', '', '快捷键4', NULL, '0', '53', NULL),
(11, 20, '1', '', '法力：({u.mp}/{u.maxmp})', NULL, '0', '12', NULL),
(12, 21, '1', '{ut.fight_show_cut}==1 && {ut.cut_mp}!=0', '{eval((v(ut.cut_mp)>0?\"+\":\"\")+\"v(ut.cut_mp)\")}', NULL, '0', NULL, NULL),
(10, 22, '1', '', '\r\n', NULL, '0', NULL, NULL),
(21, 23, '3', '', '快捷键5', NULL, '0', '54', NULL),
(22, 24, '3', '', '快捷键6\r\n', NULL, '0', '55', NULL),
(23, 25, '3', '', '游戏首页\r\n', NULL, '0', '12', NULL),
(24, 27, '3', '', '快捷键设置\r\n', NULL, '0', '29', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_scene_page`
--

CREATE TABLE `game_scene_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_scene_page`
--

INSERT INTO `game_scene_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '你{eval(v(u.env.nowmid)==v(u.env.justmid)?\"站在\":\"来到\")}「{o.name}」[{u.refresh_time}]\r\n', NULL, '0', NULL, NULL),
(15, 2, '3', '', '任务({u.tasks.count})', NULL, '0', '21', NULL),
(14, 3, '3', '', '刷新', NULL, '0', '1', NULL),
(8, 4, '3', '({u.env.alive_npc_count}>0&&{u.env.npc_count}>0)||{u.env.pet_count}>0', 'npc\r\n', NULL, '0', '3', NULL),
(10, 5, '3', '{u.env.user_count}>1&&{o.is_shield}==0', '附近玩家\r\n', NULL, '0', '2', NULL),
(18, 6, '1', '{o.up}!=0 || {o.down}!=0 || {o.left}!=0 || {o.right}!=0', '从「{o.name}」出发:\r\n', NULL, '0', NULL, NULL),
(22, 7, '3', '{o.exit_e.name}!=\"\"', '{o.exit_e.name}→\r\n', NULL, '0', '7', NULL),
(6, 8, '1', '{o.desc}!=\"\"', '{o.desc}\r\n', NULL, '0', NULL, NULL),
(24, 9, '3', '{o.exit_s.name}!=\"\"', '{o.exit_s.name}↓\r\n', NULL, '0', '8', NULL),
(26, 10, '3', '{o.exit_w.name}!=\"\"', '{o.exit_w.name}←\r\n', NULL, '0', '9', NULL),
(20, 11, '3', '{o.exit_n.name}!=\"\"', '{o.exit_n.name}↑\r\n', NULL, '0', '10', NULL),
(13, 12, '3', '', '地上物品\r\n', NULL, '0', '4', NULL),
(17, 13, '3', '', '地图\r\n', NULL, '0', '11', NULL),
(29, 14, '3', '', '物品', NULL, '0', '17', '0'),
(28, 15, '3', '', '状态', NULL, '0', '14', '0'),
(31, 16, '3', '', '首页', NULL, '0', '12', '0'),
(4, 18, '3', '', '操作列表\r\n', NULL, '0', '6', NULL),
(39, 19, '3', '', '报时', NULL, '0', '13', '0'),
(11, 20, '3', '', '聊天信息\r\n', NULL, '0', '5', '0'),
(16, 21, '3', '', '聊天', NULL, '0', '24', NULL),
(30, 25, '3', '', '技能\r\n', NULL, '0', '15', '0'),
(40, 26, '1', '', ':{c.nowtime_H:i:s}\r\n', NULL, '0', NULL, NULL),
(9, 27, '1', '{u.env.user_count}>1&&{o.is_shield}==0', '遇到', NULL, '0', NULL, NULL),
(34, 28, '3', '', '功能', NULL, '0', '28', NULL),
(32, 29, '3', '', '好友', NULL, '0', '22', NULL),
(35, 30, '3', '', '抽奖|1', NULL, '0', '70', NULL),
(33, 31, '2', '', '数组\r\n', NULL, '1', NULL, NULL),
(41, 34, '2', '{u.is_designer} == 1', 'GM传送\r\n', NULL, '16', NULL, NULL),
(36, 35, '3', '', '队伍\r\n', NULL, '0', '19', NULL),
(2, 36, '1', '{o.photo}!=\"\"', '#{o.photo}#\r\n', NULL, '0', NULL, NULL),
(3, 37, '3', '{o.is_tp}==1', '出行\r\n', NULL, '0', '74', NULL),
(12, 39, '1', '{u.env.item_count}>0', '发现', NULL, '0', NULL, NULL),
(7, 40, '1', '({u.env.alive_npc_count}>0&&{u.env.npc_count}>0)||{u.env.pet_count}>0', '遇到', NULL, '0', NULL, NULL),
(5, 41, '3', '{o.is_rp}!=0', '采集资源\r\n', NULL, '0', '76', NULL),
(37, 42, '3', '', '宠物', NULL, '0', '20', NULL),
(27, 44, '1', '', '{e.season_text}的{e.time_name}，{e.weather_text}\r\n', NULL, '0', NULL, NULL),
(19, 46, '1', '{o.exit_n.name}!=\"\"', '北:', NULL, '0', NULL, NULL),
(21, 47, '1', '{o.exit_e.name}!=\"\"', '东:', NULL, '0', '12', NULL),
(23, 48, '1', '{o.exit_s.name}!=\"\"', '南:', NULL, '0', '12', NULL),
(25, 49, '1', '{o.exit_w.name}!=\"\"', '西:', NULL, '0', '12', NULL),
(38, 50, '3', '', '组织\r\n', NULL, '0', '18', NULL),
(42, 52, '1', '', '\r\n', NULL, '0', NULL, NULL),
(43, 53, '5', '', '请输入聊天信息：<input name =\"ltmsg\"><input type =\"submit\">\r\n<input hidden name =\"ltlx\" value=\"all\">', NULL, '205', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_bounty_01`
--

CREATE TABLE `game_self_page_bounty_01` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
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
-- 表的结构 `game_self_page_future_prison`
--

CREATE TABLE `game_self_page_future_prison` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_future_prison`
--

INSERT INTO `game_self_page_future_prison` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '@red@《未来城绝望囚牢终端验证系统1.0》@end@\r\n', NULL, '0', '12', NULL),
(2, 2, '2', '{u.ic.i161}==1&&{u.open_future_prison}==0', '放入卡片\r\n', NULL, '172', NULL, NULL),
(3, 3, '1', '{u.open_future_prison}==1', '@green@您好，你的身份信息已验证通过!@end@\r\n', NULL, '0', '12', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_HP_lift_1`
--

CREATE TABLE `game_self_page_HP_lift_1` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
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
  `value` text,
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
-- 表的结构 `game_self_page_sc`
--

CREATE TABLE `game_self_page_sc` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_sc`
--

INSERT INTO `game_self_page_sc` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '测试商城\r\n你好，欢迎你，{u.name}\r\n', NULL, '0', '12', NULL),
(2, 2, '3', '', 'sc|2\r\n', NULL, '0', '89', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_szcs`
--

CREATE TABLE `game_self_page_szcs` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_szcs`
--

INSERT INTO `game_self_page_szcs` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '测试名字:{g.test_name}\r\n是否在数组里：{inarr(v(u.name),v(g.test_name)))}\r\n{eval(v(u.id)==1?\"{u.name}<br/>\":\"\")}', NULL, '0', NULL, NULL),
(3, 2, '2', '', '测试违禁词\r\n', NULL, '199', NULL, NULL),
(4, 3, '2', '', '往末尾加元素\r\n', NULL, '200', NULL, NULL),
(2, 4, '1', '{inarr(v(u.name),v(g.test_name)))}==1', '你的名字在数组里！\r\n', NULL, '0', NULL, NULL),
(5, 5, '2', '', '移除第n个元素\r\n', NULL, '203', NULL, NULL),
(6, 6, '1', '', '\r\n', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_tent`
--

CREATE TABLE `game_self_page_tent` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
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
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_test`
--

INSERT INTO `game_self_page_test` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '【签到福利】\r\n你好，【{u.name}】，欢迎来到签到页面！\r\n签到次数：{u.qd_cs}\r\n', NULL, '0', NULL, NULL),
(2, 2, '2', '', '签到\r\n', NULL, '75', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_vehicle`
--

CREATE TABLE `game_self_page_vehicle` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_vehicle`
--

INSERT INTO `game_self_page_vehicle` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(4, 1, '1', '{u.land.name}!=\"\"&&{u.vehicle_ck}==1', '\r\n「{u.land.name}」\r\n消耗:{u.land.cons}\r\n耐久度:{u.land.durable}/{u.land.max_durable}\r\n速度:{u.land.speed}\r\n', NULL, '0', NULL, NULL),
(5, 2, '1', '{u.boat.name}!=\"\"&&{u.vehicle_ck}==2', '\r\n「{u.boat.name}」\r\n消耗:{u.boat.cons}\r\n耐久度:{u.boat.durable}/{u.boat.max_durable}\r\n速度:{u.boat.speed}\r\n', NULL, '0', NULL, NULL),
(6, 3, '1', '{u.craft.name}!=\"\"&&{u.vehicle_ck}==3', '\r\n「{u.craft.name}」\r\n消耗:{u.craft.cons}\r\n耐久度:{u.craft.durable}/{u.craft.max_durable}\r\n速度:{u.craft.speed}\r\n', NULL, '0', NULL, NULL),
(1, 4, '2', '{u.vehicle_ck}!=1', '陆行载具', NULL, '192', NULL, NULL),
(2, 5, '2', '{u.vehicle_ck}!=2', '航海载具', NULL, '193', NULL, NULL),
(3, 6, '2', '{u.vehicle_ck}!=3', '飞行载具', NULL, '194', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_vip`
--

CREATE TABLE `game_self_page_vip` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
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
(2, 2, '2', '', '测试操作\r\n', NULL, '108', '1', NULL),
(3, 3, '4', '', '测试战斗动画\r\n', NULL, '0', NULL, 'fight_test');

-- --------------------------------------------------------

--
-- 表的结构 `game_self_page_vvvv`
--

CREATE TABLE `game_self_page_vvvv` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_self_page_vvvv`
--

INSERT INTO `game_self_page_vvvv` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', 'u.v(u.id).name = {u.v(u.id).name}\r\n', NULL, '0', '12', NULL),
(2, 2, '2', '', '学技能\r\n', NULL, '207', NULL, NULL),
(3, 3, '5', '', '请输入：<input name =\"id\">\r\n请输入：<input name =\"sl\">\r\n<input type =\"submit\">', NULL, '211', '12', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `game_skill_page`
--

CREATE TABLE `game_skill_page` (
  `position` int(4) NOT NULL,
  `id` int(255) NOT NULL,
  `type` varchar(255) DEFAULT '1',
  `show_cond` varchar(255) DEFAULT NULL,
  `value` text,
  `target_tasks` varchar(255) DEFAULT NULL,
  `target_event` varchar(255) DEFAULT '0',
  `target_func` varchar(255) DEFAULT '0',
  `link_value` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `game_skill_page`
--

INSERT INTO `game_skill_page` (`position`, `id`, `type`, `show_cond`, `value`, `target_tasks`, `target_event`, `target_func`, `link_value`) VALUES
(1, 1, '1', '', '【{m.name}】{eval(v(m.default)==1?\"[默认]\":\"\")}\r\n技能介绍:{m.desc}\r\n等级:{m.lvl}【{m.point}/{eval(v(m.promotion)?\"v(m.promotion)\":\"∞\")}】\r\n伤害系数:{m.hurt_mod}\r\n攻击范围:{m.group_attack}\r\n伤害目标:{m.hurt_attr}\r\n消耗目标:{m.deplete_attr}\r\n', NULL, '0', NULL, NULL),
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
('minute', '1415577'),
('qd_fanwei', '1|2|3|4|5|6|7'),
('test_name', ''),
('qd_today', '2025-2-20'),
('zbmz', '\"[凡铁]{o.name}|<font color=\"32CD32\">[精钢]{o.name}</font>|<font color=\"00b7ee\">[法器]{o.name}</font>|<font color=\"808080\">[灵兵]{o.name}</font>|<font color=\"8A2BE2\">[玄兵]{o.name}</font>|<font color=\"FF8C00\">[圣器]{o.name}</font>|<font color=\"FF0000\">[神器]{o.name}</font>|<font class=\"xuancai1\">[仙器]{o.name}</font>\"'),
('test', '\"{eval(v(u.zbtz1)>0?【仙魔新秀】:\"\")}|{eval(v(u.zbtz2)>0?【仙魔战神】:\"\")}|\"');

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
  `attr_type` varchar(255) DEFAULT NULL,
  `long_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `gm_game_attr`
--

INSERT INTO `gm_game_attr` (`pos`, `id`, `name`, `value_type`, `default_value`, `if_item_use_attr`, `if_basic`, `if_show`, `attr_type`, `long_type`) VALUES
(1, 'id', '标识', '5', '1', 0, 1, '1', '0', 0),
(2, 'area_name', '区域名称', '5', '0', 0, 1, '1', '1', 0),
(3, 'area_id', '区域id', '5', '0', 0, 1, '0', '0', 0),
(4, 'name', '场景名称', '5', '0', 0, 1, '0', '1', 0),
(5, 'photo', '图片', '5', '0', 0, 1, '1', '1', 0),
(6, 'desc', '描述', '5', '0', 0, 1, '1', '1', 0),
(7, 'name', '名称', '1', '0', 0, 1, '0', '1', 0),
(8, 'id', '标识', '1', '', 0, 1, '1', '0', 0),
(9, 'nick_name', '称号', '1', '', 0, 1, '0', '1', 0),
(10, 'sex', '性别', '1', '', 0, 1, '0', '1', 0),
(11, 'image', '图片', '1', '', 0, 1, '0', '1', 0),
(12, 'max_burthen', '最大负载', '1', '', 0, 1, '0', '0', 0),
(13, 'exp', '阅历', '1', '0', 1, 1, '0', '0', 2),
(14, 'lvl', '等级', '1', '1', 0, 1, '0', '0', 2),
(15, 'money', '信用币', '1', '0', 1, 1, '1', '0', 0),
(16, 'hp', '血量', '1', '100', 1, 1, '1', '0', 2),
(17, 'maxhp', '最大血量', '1', '100', 1, 1, '0', '0', 2),
(18, 'mp', '魔力', '1', '50', 1, 1, '1', '0', 2),
(19, 'maxmp', '最大魔力', '1', '50', 1, 1, '1', '0', 2),
(20, 'id', '标识', '3', '', 0, 1, '0', '0', 0),
(21, 'area_id', '区域', '3', '', 0, 1, '0', '0', 0),
(22, 'name', '名称', '3', '0', 0, 1, '0', '1', 0),
(23, 'nick_name', '绰号', '3', '', 0, 1, '0', '1', 0),
(24, 'image', '图片', '3', '', 0, 1, '0', '1', 0),
(25, 'desc', '描述', '3', '0', 0, 1, '0', '1', 1),
(26, 'exp', '经验', '3', '', 0, 1, '0', '0', 0),
(27, 'lvl', '等级', '3', '', 0, 1, '0', '0', 0),
(28, 'kill', '是否可杀', '3', '0', 0, 1, '0', '2', 0),
(29, 'not_dead', '是否杀不死', '3', '', 0, 1, '0', '2', 0),
(30, 'chuck', '是否可赶走', '3', '1', 0, 1, '0', '2', 0),
(31, 'refresh_time', '刷新间隔', '3', '', 0, 1, '0', '0', 0),
(32, 'shop', '是否贩货', '3', '', 0, 1, '0', '2', 0),
(33, 'hock_shop', '是否收购', '3', '', 0, 1, '0', '2', 0),
(34, 'hp', '生命', '3', '0', 0, 1, '0', '0', 2),
(35, 'maxhp', '最大生命', '3', '100', 0, 1, '1', '0', 0),
(36, 'mp', '法力', '3', '', 0, 1, '0', '0', 0),
(37, 'maxmp', '最大法力', '3', '100', 0, 1, '1', '0', 0),
(38, 'gj', '攻击力', '3', '', 0, 1, '0', '0', 0),
(39, 'fy', '防御力', '3', '', 0, 1, '0', '0', 0),
(40, 'kill', '是否可pk', '1', '1', 0, 1, '0', '2', 0),
(41, 'id', '标识', '4', '1', 0, 1, '0', '0', 0),
(42, 'area_id', '区域', '4', '0', 0, 1, '0', '0', 0),
(43, 'name', '名称', '4', '0', 0, 1, '0', '1', 0),
(44, 'image', '图片', '4', '', 0, 1, '0', '1', 0),
(45, 'desc', '描述', '4', '0', 0, 1, '0', '1', 0),
(46, 'type', '类别', '4', '', 0, 1, '0', '0', 0),
(47, 'subtype', '子类别', '4', '', 0, 1, '0', '0', 0),
(48, 'weight', '重量', '4', '0', 0, 1, '0', '0', 0),
(49, 'price', '价格', '4', '', 0, 1, '0', '0', 0),
(50, 'no_give', '是否不可赠送', '4', '1', 0, 1, '0', '2', 0),
(51, 'no_out', '是否不可丢弃', '4', '', 0, 1, '0', '2', 0),
(52, 'refresh_time', '刷新间隔', '5', '1', 0, 1, '1', '0', 0),
(53, 'id', '标识', '6', '1', 0, 1, '1', '0', 0),
(54, 'name', '名称', '6', '', 0, 1, '1', '1', 0),
(55, 'desc', '描述', '6', '', 0, 1, '1', '1', 0),
(56, 'effect_cmmt', '攻击描述', '6', '', 0, 1, '1', '1', 0),
(57, 'lvl', '等级', '6', '1', 0, 1, '1', '0', 0),
(58, 'point', '当前熟练度', '6', '', 0, 1, '0', '0', 0),
(59, 'group_attack', '攻击范围', '6', '1', 0, 1, '1', '0', 0),
(60, 'shop', '是否商店', '5', '', 0, 1, '1', '2', 0),
(61, 'hockshop', '是否当铺', '5', '', 0, 1, '1', '2', 0),
(62, 'storage', '是否仓库', '5', '', 0, 1, '1', '2', 0),
(63, 'kill', '是否允许pk', '5', '1', 0, 1, '1', '2', 0),
(64, 'is_rp', '是否资源点', '5', '', 0, 1, '1', '2', 0),
(65, 'rp_id', '资源点名称', '5', '', 0, 1, '0', '0', 0),
(66, 'is_tp', '是否中转点', '5', '', 0, 1, '1', '2', 0),
(67, 'accept_give', '是否接受物品', '3', '', 0, 1, '0', '2', 0),
(68, 'tp_type', '中转点类型', '5', '', 0, 1, '1', '0', 0),
(69, 'dire', '坐标', '5', '0,0,0', 0, 1, '1', '1', 0),
(70, 'tianqi', '天气', '5', '晴天', 0, 1, '0', '1', 0),
(71, 'is_shield', '是否屏蔽其他玩家', '5', '', 0, 1, '1', '2', 0),
(72, 'is_signal_block', '是否信号闭塞', '5', '', 0, 1, '1', '2', 0),
(73, 'hide', '是否隐藏', '5', '', 0, 1, '1', '2', 0),
(75, 'wg_fj', '物攻附加', '4', '0', 0, 0, '1', '0', 0),
(76, 'wg_fj', '物攻附加', '1', '0', 0, 0, '1', '0', 0),
(79, 'gongji', '自定攻击', '6', '1', 0, 0, '0', '0', 0),
(83, 'bj', '暴击', '1', '0', 0, 0, '1', '0', 0),
(84, 'speed', '出招速度', '1', '1', 1, 1, '1', '0', 0),
(85, 'speed', '出招速度', '3', '1', 1, 1, '1', '0', 0),
(97, 'lvl', '使用等级', '4', '1', 0, 0, '0', '0', 1);

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
  `game_temp_notice_time` int(4) NOT NULL COMMENT '//临时公告剩余分钟数',
  `drop_protect_time` int(11) NOT NULL,
  `drop_disappear_time` int(11) NOT NULL,
  `npc_list_br` int(2) NOT NULL,
  `equip_mosaic_link` int(2) NOT NULL,
  `scene_message_count` int(2) NOT NULL,
  `long_exist_message` int(1) NOT NULL,
  `can_verify` int(1) NOT NULL,
  `npc_seg` text NOT NULL,
  `can_input` int(1) NOT NULL,
  `scene_chat_time` int(1) NOT NULL,
  `fight_mod` int(1) NOT NULL,
  `int_long` tinyint(1) NOT NULL,
  `flush_limit` int(4) NOT NULL DEFAULT '300',
  `item_head` text NOT NULL,
  `chat_head` text NOT NULL,
  `fight_head` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `gm_game_basic`
--

INSERT INTO `gm_game_basic` (`game_id`, `game_name`, `game_desc`, `game_creat_time`, `game_open_time`, `money_name`, `money_measure`, `promotion_exp`, `promotion_cond`, `mod_promotion_exp`, `mod_promotion_cond`, `clan_promotion_exp`, `clan_promotion_cond`, `default_skill_id`, `entrance_id`, `game_status`, `game_max_char`, `gm_post_canshu`, `game_forum_gm_id`, `game_status_string`, `pet_max_count`, `team_max_count`, `default_storage`, `player_offline_time`, `player_send_global_msg_interval`, `scene_op_br`, `npc_op_br`, `item_op_br`, `list_row`, `game_player_regular_minute`, `near_player_show`, `game_temp_notice`, `game_temp_notice_time`, `drop_protect_time`, `drop_disappear_time`, `npc_list_br`, `equip_mosaic_link`, `scene_message_count`, `long_exist_message`, `can_verify`, `npc_seg`, `can_input`, `scene_chat_time`, `fight_mod`, `int_long`, `flush_limit`, `item_head`, `chat_head`, `fight_head`) VALUES
(19980925, '失色纪元', '〝命运，如造物主的看不见的大手，穿针引线，映射于失色之地下的禁忌领域。\r\n粼粼的月光之下，是终局的开端，还是虚幻的重建?〞\r\n〝戈德兰的守护者们，是昨天还是今天，是明天还是后天？〞\r\n......', '2023-08-01 00:22:15', '2023-09-25 00:05:20', '信用币', '点', '{e.maxexp}', '{u.lvl}<150', '', '', '', '', 1, 225, 0, 20, 0, '959c9277a3e15eacff9e5f117e51f5bb', '开发中', 2, 2, 20, 10, 10, 1, 1, 1, 8, '2023-09-09 01:29:48', 1, '1', 0, 30, 50, 0, 1, 5, 1, 1, ',', 1, 1, 0, 1, 0, '{u.name}的背包\r\n信用币：{u.money}点\r\n未来币：{u.money2}枚\r\n负重：{u.burthen}/{u.max_burthen}\r\n{{item_type_全部}}|{{item_type_装备}}|{{item_type_镶物}}\r\n{{item_type_药品}}|{{item_type_书籍}}|{{item_type_任务}}\r\n{{item_type_其它}}', '【聊天频道：「{{chat_now_nav}}」】{{chat_flush_url}}\r\n【{{chat_type_all}}|{{chat_type_im}}|{{chat_type_city}}|{{chat_type_area}}|{{chat_type_team}}|{{chat_type_system}}】\r\n<span style=\"font-weight: bold; color: red\">请勿发表有关辱骂、政治、色情、赌博等相关言论！请确保您的言论符合游戏规则和道德准则。违反规则将导致相应的惩罚措施，包括禁言、封号等。</span>', '');

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
-- 表的结构 `player_clan_apply`
--

CREATE TABLE `player_clan_apply` (
  `apply_id` int(11) NOT NULL,
  `apply_sid` text NOT NULL,
  `apply_clan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

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

--
-- 转存表中的数据 `player_equip_mosaic`
--

INSERT INTO `player_equip_mosaic` (`equip_id`, `equip_root`, `belong_sid`, `equip_mosaic`) VALUES
(222, 5, '945fd26d30e007abfed414cc1f2795f5', '75|75|75');

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
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uzxsj', '231'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uqd_daily', '17'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'usubmit_bounty_01_item_01', '26'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'upick_lj', '1745315598'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utomorrow_1_floor', '1'),
('214658c4375c343e280ae38e880ac4ba', '', 0, 'uqd_daily', '6'),
('214658c4375c343e280ae38e880ac4ba', '', 0, 'uzxsj', '12'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_x', '2'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_y', '2'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_z', '1.5'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_burthen', '100'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'ulq_map0_dailygift', '23'),
('01a0d4f5e64a677721a1089d4914bc6a', '', 0, 'uqd_daily', '5'),
('01a0d4f5e64a677721a1089d4914bc6a', '', 0, 'upick_lj', '1717538783'),
('01a0d4f5e64a677721a1089d4914bc6a', '', 0, 'uzxsj', '3'),
('a8c7b0c51c60be7441214c0b0c671d88', '', 0, 'uzxsj', '13'),
('945fd26d30e007abfed414cc1f2795f5', '', 0, 'uzxsj', '2583'),
('945fd26d30e007abfed414cc1f2795f5', '', 0, 'uqd_daily', '26'),
('f55913444ef985484baf7580c60f15ce', '', 0, 'uzxsj', '5'),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 0, 'uzxsj', '550'),
('fe3319b6dd10f68aaa36ee852cd79cc1', '', 0, 'uqd_daily', '27'),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 0, 'uqd_daily', '6'),
('e3130d019f7689f5501bc3633f97eb88', '', 0, 'uzxsj', '1'),
('76623f3a68872fa88502af535498a991', '', 0, 'uzxsj', '1'),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 0, 'uzxsj', '5'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uzb_mg', '70'),
('344773e829d514e37d748e906a4f020a', '', 0, 'uzxsj', '11'),
('344773e829d514e37d748e906a4f020a', '', 0, 'uqd_daily', '21'),
('344773e829d514e37d748e906a4f020a', '', 0, 'upick_lj', '1718972871'),
('98c50608a11ec800fba8b2d0b7294aeb', '', 0, 'uzxsj', '1'),
('98c50608a11ec800fba8b2d0b7294aeb', '', 0, 'upick_lj', '1719735300'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utest_id', '2'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'upick_lj', '1720187792'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'uzxsj', '66'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'uqd_daily', '20'),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 0, 'uzxsj', '6'),
('01acd0637eb2b6a6a3055e4fc37e8457', '', 0, 'urandom', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'umap_enter_fog', '0'),
('269d6f1d2272bf0f3af7633340052a03', '', 0, 'urandom', '0'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'ugongji', '50'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'ufangyu', '60'),
('740c4edeb4bb99c86b2a9b6ee4321422', '', 0, 'uzxsj', '1002'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uwb_id', 'n11'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uremove_cathaya_4', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uremove_cathaya_3', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uremove_cathaya_2', '1'),
('14ff4a179003b2934da7305a76f718ea', '', 0, 'uqd_daily', '17'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uremove_cathaya_1', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uremove_cathaya', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utouch_cathaya', '25'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'umoney2', '123455189'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uopen_future_prison', '2'),
('11949d9ce6df5a06a3377325c71c7c4f', '', 0, 'uzxsj', '65'),
('11949d9ce6df5a06a3377325c71c7c4f', '', 0, 'uqd_daily', '8'),
('f3c4859c79f6f34ac79072571744bf8e', '', 0, 'uqd_daily', '17'),
('f3c4859c79f6f34ac79072571744bf8e', '', 0, 'uzxsj', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'umodify_future_card', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uopen_future_prison_307', '1'),
('79ca852ae3c34e005ba8db7ca9f2429e', '', 0, 'uzxsj', '8'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uvehicle_ck', '1'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'utent_color', '灰青色'),
('f4cd01caaf9ec17c03413de91b97b5f2', '', 0, 'uqd_daily', '26'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'uzxsj', '326'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'upick_lj', '1738345257'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'uqd_daily', '20'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u', '1'),
('', 'item', 458, 'ixq_nl', '26'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'urandom', '0'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'umap_enter_fog', '0'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'usubmit_bounty_01_item_01', '23'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uuexp', '9999999'),
('945fd26d30e007abfed414cc1f2795f5', '', 0, 'umap_enter_fog', '0'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'uqd_cs', '23'),
('', 'item', 512, 'iadded_wg', '0'),
('', 'item', 360, 'iadded_wg', '0'),
('40499b34a8c1fd21aca27a6f780913b7', '', 0, 'uzxsj', '3'),
('712f6f87ae511e72bec397c34b66341e', '', 0, 'uzxsj', '3'),
('712f6f87ae511e72bec397c34b66341e', '', 0, 'upick_lj', '1740930956'),
('3f47043a9d21b1e33eafe14c8e43ff23', '', 0, 'uzxsj', '4'),
('3f47043a9d21b1e33eafe14c8e43ff23', '', 0, 'upick_lj', '1740966851'),
('c654e54b080f01395814de4cc5a56a36', '', 0, 'uzxsj', '5'),
('c654e54b080f01395814de4cc5a56a36', '', 0, 'upick_lj', '1741027366'),
('', 'item', 559, 'ixq_nl', '26'),
('997e35c67ee90c752adcafcb9146ef0c', '', 0, 'uzxsj', '1'),
('', 'item', 512, 'iwg_fj', '599'),
('959c9277a3e15eacff9e5f117e51f5bb', '', 0, 'u1name', '杀杀杀'),
('', 'item', 507, 'ino_out', '1'),
('', 'item', 512, 'ino_give', '1'),
('', 'item', 594, 'iname', '村里最好的一把剑123'),
('', 'item', 595, 'iname', '轩辕的草帽'),
('', 'item', 596, 'izbpz', '2'),
('', 'item', 596, 'iname', '村里最好的一把剑309'),
('', 'item', 597, 'izbpz', '6'),
('', 'item', 598, 'izbpz', '1'),
('', 'item', 598, 'iname', '0'),
('', 'item', 606, 'izbpz', '5'),
('', 'item', 606, 'iname', '<font color=8A2BE2>[玄兵]@6a5353@生锈的铁剑@end@</font>'),
('', 'item', 608, 'izbpz', '8'),
('', 'item', 608, 'iname', '<font class=xuancai1>[仙器]@6a5353@生锈的铁剑@end@</font>'),
('', 'item', 613, 'izbpz', '1'),
('', 'item', 613, 'iname', '[凡铁]@6a5353@生锈的铁剑@end@'),
('1031e7b699b6b7c0591c7bd314656738', '', 0, 'uzxsj', '5'),
('18280efc59907bd2fb48b26d077e374c', '', 0, 'uzxsj', '2'),
('', 'item', 201, 'ino_give', '0'),
('', 'item', 225, 'iadded_wg', '0'),
('', 'item', 222, 'iadded_wg', '33'),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 0, 'uzxsj', '1'),
('', 'item', 512, 'iadded_mg', '0'),
('1f50c749d050ef9cb714a1987d044462', '', 0, 'uzxsj', '2'),
('', 'item', 580, 'iadded_wg', '0'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'utent_x', '2'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'utent_y', '2'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'utent_z', '1.5'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'utent_color', '灰色'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'utent_burthen', '100'),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 0, 'utomorrow_1_floor', '1'),
('', 'item', 512, 'iembed_count', '10'),
('945fd26d30e007abfed414cc1f2795f5', '', 0, 'umap', '10000'),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 0, 'uzxsj', '1');

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
(5, 9, 8, '纳米之都'),
(1, 7, 9, '金陵古城'),
(5, 10, 10, '银月戈壁'),
(3, 11, 11, '智慧山脊'),
(4, 12, 12, '不夜之城'),
(2, 13, 13, '熔岩山岭'),
(6, 18, 14, '天空之城'),
(1, 14, 15, '钱塘古城'),
(1, 15, 16, '广陵古城'),
(1, 16, 17, '刺桐古城'),
(1, 17, 18, '楚庭古城'),
(1, 20, 19, '曼尼拉城'),
(1, 21, 20, '浪速古城'),
(1, 22, 21, '首里古城'),
(4, 23, 22, '雪漫古城'),
(0, 1, 23, '迷雾森林'),
(4, 24, 24, '卡普斯镇'),
(2, 25, 25, '亚特兰蒂斯'),
(2, 26, 26, '蒙巴萨城'),
(0, 3, 27, '宁静森林'),
(0, 27, 28, '克蒙伦斯城'),
(2, 28, 29, '塞恩古城'),
(1, 29, 30, '蓬莱仙岛'),
(6, 30, 31, '次元要塞');

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
  `uid` int(11) NOT NULL COMMENT '0为系统信息',
  `imuid` int(11) NOT NULL COMMENT '0为全体，12345生效，此时为对方id，城市id，区域id，队伍id，公会id',
  `chat_type` int(1) NOT NULL DEFAULT '0' COMMENT '0为公共，1为私聊，2为城聊，3为区聊，4为队聊，5为会聊，6为系统',
  `send_type` int(1) NOT NULL COMMENT '0为玩家或系统，1为npc，2为物品',
  `viewed` int(1) NOT NULL DEFAULT '0' COMMENT '0为未看，1为已读'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_chat_data`
--

INSERT INTO `system_chat_data` (`name`, `msg`, `send_time`, `id`, `uid`, `imuid`, `chat_type`, `send_type`, `viewed`) VALUES
('测试号', '设计大厅+设计buff和debuff，物品属性能进行buff加持或debuff去除等。', '2023-12-01 01:20:54', 344, 14, 0, 0, 0, 0),
('轩辕', '捡东西是否会触发事件', '2023-12-11 14:57:04', 390, 1, 0, 0, 0, 0),
('轩辕', '地图设计新增:新增item，npc到指定范围mid', '2023-12-11 15:09:19', 394, 1, 0, 0, 0, 0),
('轩辕', '特殊战斗限制，比如副本等，n回合内没杀死则判定对方逃跑。', '2024-01-02 00:09:58', 435, 1, 0, 0, 0, 0),
('云澈', '兄弟们好', '2024-06-06 01:04:07', 462, 10, 1, 4, 0, 0),
('云澈', '打副本', '2024-06-06 01:04:13', 463, 10, 1, 4, 0, 0),
('轩辕', '抽象语法树替换，ot.busy跳回合，尝试合并一些pdo数据库文件以及探索高版本php和mysql的兼容性', '2024-06-20 18:06:45', 492, 1, 0, 0, 0, 0),
('轩辕', '接下去应该是帮派和宠物，以及buff系统', '2024-06-21 01:41:38', 494, 1, 0, 0, 0, 0),
('轩辕', '尝试开发，设计器的设计器，封装抽象api模块调用', '2024-06-21 13:13:18', 496, 1, 0, 0, 0, 0),
('轩辕', '尝试引入xdebug调试器优化代码', '2024-06-22 16:20:09', 500, 1, 0, 0, 0, 0),
('轩辕', '定时器：系统定时(包括系统本身定时，场景定时，npc定时，物品定时，临时公告等)与玩家定时(自创帮派定时，自身分钟定时)以及自定义定时', '2024-06-26 02:18:57', 504, 1, 0, 0, 0, 0),
('轩辕', '玩家的定时可以以玩家本身状态作为基准点进行设计，系统的定时可以结合cron定时器，定时运行一个php文件，里面是一个循环，获取某个动态文件的id数组值，包括系统，场景，npc，物品等，这些都可以在gm.php里面检测是否创建。', '2024-06-26 02:22:29', 505, 1, 0, 0, 0, 0),
('轩辕', '对cmd参数进行分离和优化，运用是否在数组以及缓存，二分查找等手段加快处理cmd文件', '2024-06-26 02:25:22', 506, 1, 0, 0, 0, 0),
('轩辕', '对php进行压力测试，以及探索数据库连接池的可能性', '2024-06-26 02:37:39', 508, 1, 0, 0, 0, 0),
('轩辕', '尝试对公共事件依据主体不同分开撰写特定函数，缩小冗余代码量', '2024-06-26 15:20:55', 509, 1, 0, 0, 0, 0),
('轩辕', '组队系统仍然有问题，另外设计系统在创建新记录的时候考虑加入重复验证', '2024-06-28 08:31:36', 519, 1, 0, 0, 0, 0),
('轩辕', '在模板设计元素提交请求更新缓存值', '2024-07-01 08:36:47', 528, 1, 0, 0, 0, 0),
('轩辕', '创建一些特殊事件，事件名称应该是部分动态的', '2024-07-03 00:59:03', 536, 1, 0, 0, 0, 0),
('轩辕', '装备强化数据表：equip_id,equip_root_id,belong_sid,equip_ strengthen_lvl，进行交易(售出，挂售，拍卖)时：默认查询该表进行清空。', '2024-07-03 09:37:55', 542, 1, 0, 0, 0, 0),
('轩辕', '完善宠物逻辑', '2024-07-22 12:10:56', 550, 1, 0, 0, 0, 0),
('轩辕', '查看玩家页面模板进行操作拆分，从而实现不同场合显示不同效果', '2024-07-22 12:12:39', 551, 1, 0, 0, 0, 0),
('轩辕', 'qaq，我在做宠物', '2024-07-26 18:35:55', 553, 1, 21, 1, 0, 0),
('轩辕', '加你为好友了!', '2024-07-26 19:19:07', 555, 1, 21, 1, 0, 0),
('轩辕', '事件的查看定义数据显示逻辑优化', '2024-07-27 01:27:13', 559, 1, 0, 0, 0, 0),
('轩辕', '定时器：添加一个定时器(定时器名称，描述，对象类型，绑定对象定时事件，日志)，修改一个定时器(定时器名称，描述，对象类型，绑定对象定时事件)，查询定时器，删除定时器，system_interval表(tid,tname,tdesc,tob_type，tob_event,tdoc_path)', '2024-07-30 23:56:09', 562, 1, 0, 0, 0, 0),
('轩辕', '全面利用cache缓存机制优化所有渲染性能', '2024-07-31 00:10:07', 566, 1, 0, 0, 0, 0),
('轩辕', '丰富物品来源信息', '2024-08-11 01:47:12', 636, 1, 0, 0, 0, 0),
('轩辕', '加入分区系统', '2024-08-24 03:27:04', 666, 1, 0, 0, 0, 0),
('轩辕', 'npc装备列表加一个查看功能', '2024-08-26 19:42:40', 779, 1, 0, 0, 0, 0),
('轩辕', '如何实现一点击就攻击，并且随机当前场景数量呢', '2024-09-12 15:52:04', 1032, 1, 0, 0, 0, 0),
('轩辕', '组队，宠物，帮派，优化', '2024-09-14 03:12:39', 1073, 1, 0, 0, 0, 0),
('轩辕', '城内基础建筑：四城门，居民区，铁匠铺，酒馆，银行，赌场，教堂，皇宫，珠宝店，市场，商店，警察局，福利院，实验室，广场，花园', '2024-09-15 04:20:35', 1086, 1, 0, 0, 0, 0),
('轩辕', 'npc装备应该可以定义镶物', '2024-09-18 11:24:07', 1103, 1, 0, 0, 0, 0),
('轩辕', 'npc加一个备注字段，用于区分不同时间点的不同npc方便放置', '2024-09-30 01:59:51', 1148, 1, 0, 0, 0, 0),
('轩辕', '物品要加入挂售以及上架，贩卖条件', '2024-10-01 03:46:06', 1150, 1, 0, 0, 0, 0),
('轩辕', '装备要加上被穿的检测', '2024-10-10 00:17:08', 1156, 1, 0, 0, 0, 0),
('轩辕', 'f()不仅取得()内值，还有其所属对象', '2024-10-17 15:00:54', 1165, 1, 0, 0, 0, 0),
('轩辕', '.运算从左往右，f()和v()的区别在于f取得的值有所属对象，v没有', '2024-10-17 15:07:51', 1166, 1, 0, 0, 0, 0),
('轩辕', '继续优化解析器和缓存的逻辑，把f()，u.env等等考虑进去', '2024-10-21 14:40:18', 1170, 1, 0, 0, 0, 0),
('轩辕', '优化缓存回收机制', '2024-10-21 14:46:51', 1171, 1, 0, 0, 0, 0),
('轩辕', '每次离线和登录进入页面清空u，ut相关缓存', '2024-10-24 03:18:19', 1177, 1, 0, 0, 0, 0),
('轩辕', '如果是item的o相关要加入用户标识区分', '2024-10-24 03:21:08', 1179, 1, 0, 0, 0, 0),
('轩辕', '设计一个缓存函数，用于快速统一管理非解析器部分造成的数据更替', '2024-10-24 03:22:14', 1180, 1, 0, 0, 0, 0),
('轩辕', '在其他更新数据库的地方更新redis', '2024-10-27 01:03:59', 1199, 1, 0, 0, 0, 0),
('轩辕', '创建事件，步骤那边加入锁的机制，防止刷新导致数据重复', '2024-10-27 01:09:55', 1200, 1, 0, 0, 0, 0),
('轩辕', '加你为好友了!', '2024-10-30 18:56:06', 1222, 1, 21, 1, 0, 0),
('轩辕', '加你为好友了!', '2024-10-30 18:57:02', 1223, 1, 21, 1, 0, 0),
('轩辕', '加你为好友了!', '2024-10-30 18:57:06', 1224, 1, 21, 1, 0, 0),
('轩辕', '我们恩断义绝吧!', '2024-10-30 19:08:34', 1225, 1, 21, 1, 0, 0),
('轩辕', '我们恩断义绝吧!', '2024-10-30 19:08:39', 1226, 1, 21, 1, 0, 1),
('轩辕', '申请加入你的队伍!', '2024-10-30 21:16:52', 1227, 1, 23, 1, 0, 0),
('轩辕', '航行系统待完善', '2024-12-05 23:00:00', 1281, 1, 0, 0, 0, 0),
('轩辕', '加入npc接受赠送物品一系列功能', '2024-12-11 03:03:45', 1327, 1, 0, 0, 0, 0),
('轩辕', '加入模板元素触发任务，事件步骤触发任务，对象操作触发任务。', '2025-01-13 03:12:17', 1410, 1, 0, 0, 0, 0),
('轩辕', '场景模板最前面加入副本判定：首先是否在副本，其次副本创建时间，第三副本传送地址（成功与失败皆到此），这些都由进入副本的操作赋值', '2025-01-18 12:29:58', 1415, 1, 0, 0, 0, 0),
('轩辕', '副本设计器的demo版', '2025-01-21 20:18:59', 1420, 1, 0, 0, 0, 0),
('轩辕', '更新数据库前先把数据更新到缓存，再异步到数据库中，而前方获取数据则是先从缓存获取', '2025-01-24 15:35:10', 1423, 1, 0, 0, 0, 0),
('轩辕', '将模板元素数据写入redis缓存，再模板加入更新缓存操作', '2025-01-25 02:02:42', 1432, 1, 0, 0, 0, 0),
('轩辕', '设属时候遇到相同的比如u在同一表（副表）中，则合并归类为一句sql语句。', '2025-01-26 17:19:12', 1525, 1, 0, 0, 0, 0),
('轩辕', '加入区域全地图导出', '2025-02-01 01:38:59', 1559, 1, 0, 0, 0, 0),
('轩辕', '物品拆分，合并，独立性', '2025-02-12 02:32:43', 1667, 1, 0, 0, 0, 0),
('轩辕', '事件中刷新场景npc，物品', '2025-02-12 18:05:13', 1669, 1, 0, 0, 0, 0),
('轩辕', '把出招做成一种功能', '2025-02-13 01:06:44', 1670, 1, 0, 0, 0, 0),
('轩辕', '优化战斗逻辑，完善新解析器', '2025-02-17 09:27:27', 1682, 1, 0, 0, 0, 0),
('梦浅', '页面回退再点击任意链接会触发回退警告，那么修改成重新加载最新静态页面，并对ucmd的值进行处理', '2025-02-19 18:29:33', 1692, 46, 0, 0, 0, 0),
('轩辕', '设置属性，更改属性，更改物品放事务一起执行。', '2025-02-23 01:26:29', 1703, 1, 0, 0, 0, 0),
('轩辕', '宠物喂食，清洁，装备，物品，独立事件（oid:pet）', '2025-02-23 19:24:59', 1722, 1, 0, 0, 0, 0),
('轩辕', '组队，帮派，宠物', '2025-02-24 17:34:03', 1729, 1, 0, 0, 0, 0),
('轩辕', '尽全力优化场景模板和战斗模板', '2025-02-25 22:20:15', 1737, 1, 0, 0, 0, 0),
('轩辕', '加入个人显示设置逻辑', '2025-02-27 17:22:13', 1758, 1, 0, 0, 0, 0),
('轩辕', '加入导入定义数据的功能', '2025-02-27 21:08:40', 1759, 1, 0, 0, 0, 0),
('轩辕', '尝试真倒计时的加入，可能引入异步，队列等功能', '2025-02-28 01:40:38', 1760, 1, 0, 0, 0, 0),
('轩辕', '物品加入：是否独立的选项，且应该是当前无人拥有的情况下才行。', '2025-03-02 12:57:08', 1766, 1, 0, 0, 0, 0),
('轩辕', '测试', '2025-03-02 23:35:52', 1798, 1, 21, 1, 0, 0),
('轩辕', '定义商品应该能设置顺序', '2025-03-03 23:34:49', 1806, 1, 0, 0, 0, 0),
('轩辕', '完善公共事件', '2025-03-04 01:24:43', 1807, 1, 0, 0, 0, 0),
('轩辕', '完善物品类别自定义', '2025-03-04 09:17:38', 1810, 1, 0, 0, 0, 0),
('轩辕', '完善json到所有语法中', '2025-03-06 01:39:59', 1822, 1, 0, 0, 0, 0),
('轩辕', '测试', '2025-03-07 13:48:25', 1861, 1, 21, 1, 0, 1),
('系统', '物攻附加+10', '2025-03-07 14:12:50', 1866, -1, 46, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-07 14:12:54', 1867, -1, 46, 6, 0, 1),
('系统', '信用币+2', '2025-03-10 16:42:53', 1924, -1, 1, 6, 0, 1),
('梦浅', '尝试一次性获取，并用json直接取得属性值而不是每次都查询数据库。', '2025-03-10 18:59:22', 1927, 46, 0, 0, 0, 0),
('系统', '信用币+3', '2025-03-11 10:56:21', 1930, -1, 1, 6, 0, 1),
('轩辕', '事件步骤考虑加入：重复执行次数的设定。', '2025-03-11 16:11:20', 1934, 1, 0, 0, 0, 0),
('系统', '物攻附加-600', '2025-03-11 20:04:40', 1937, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:12:35', 1938, -1, 1, 6, 0, 1),
('系统', '信用币+100', '2025-03-11 20:12:35', 1939, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:13:06', 1940, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:13:10', 1941, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:13:12', 1942, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:23:25', 1943, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:23:27', 1944, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:26:06', 1945, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:26:07', 1946, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:26:09', 1947, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:26:14', 1948, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:45:55', 1949, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:45:58', 1950, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:46:13', 1951, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:46:14', 1952, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:14', 1953, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:46:21', 1954, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:46:23', 1955, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:23', 1956, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:46:24', 1957, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:46:26', 1958, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:26', 1959, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:46:28', 1960, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:46:30', 1961, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:30', 1962, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:46:33', 1963, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:46:35', 1964, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:35', 1965, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:46:37', 1966, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:46:44', 1967, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:44', 1968, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:46:46', 1969, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:46:48', 1970, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:48', 1971, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:46:50', 1972, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-11 20:46:51', 1973, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:51', 1974, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:46:53', 1975, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:46:54', 1976, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:54', 1977, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-11 20:46:56', 1978, -1, 1, 6, 0, 1),
('系统', '物攻附加-10', '2025-03-11 20:46:57', 1979, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-11 20:46:57', 1980, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-11 20:46:58', 1981, -1, 1, 6, 0, 1),
('系统', '信用币+3', '2025-03-12 23:25:13', 1982, -1, 1, 6, 0, 1),
('系统', '信用币+50', '2025-03-12 23:25:54', 1983, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-13 01:35:15', 1986, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-13 01:35:15', 1987, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-13 01:35:18', 1988, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-13 01:36:13', 1989, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-13 01:36:13', 1990, -1, 1, 6, 0, 1),
('系统', '信用币+3', '2025-03-13 16:23:44', 1992, -1, 1, 6, 0, 1),
('轩辕', '战斗模式和物品类别自定义', '2025-03-14 13:06:20', 1996, 1, 0, 0, 0, 0),
('系统', '物攻附加+600', '2025-03-16 23:25:56', 1997, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-17 14:24:05', 1998, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-17 14:24:05', 1999, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-17 14:24:54', 2000, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-17 14:25:34', 2001, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-17 14:32:17', 2002, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-17 14:32:34', 2003, -1, 1, 6, 0, 1),
('系统', '信用币+2', '2025-03-17 15:21:41', 2004, -1, 1, 6, 0, 1),
('系统', '信用币+2', '2025-03-17 15:26:13', 2005, -1, 1, 6, 0, 1),
('系统', '信用币+1', '2025-03-17 15:28:32', 2006, -1, 1, 6, 0, 1),
('系统', '信用币+3', '2025-03-17 15:29:28', 2007, -1, 1, 6, 0, 1),
('系统', '信用币+2', '2025-03-17 15:32:16', 2008, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-17 15:59:18', 2009, -1, 1, 6, 0, 1),
('系统', '物攻附加+10', '2025-03-19 22:30:10', 2011, -1, 8, 6, 0, 1),
('轩辕', '修复极大数在战斗时的异常问题', '2025-03-26 15:48:51', 2016, 1, 0, 0, 0, 0),
('系统', '血量+100', '2025-03-26 15:52:26', 2017, -1, 1, 6, 0, 1),
('系统', '信用币+3', '2025-03-26 21:54:35', 2019, -1, 1, 6, 0, 1),
('系统', '信用币+50', '2025-03-26 21:54:50', 2020, -1, 1, 6, 0, 1),
('系统', '信用币+50', '2025-03-26 21:54:53', 2021, -1, 1, 6, 0, 1),
('系统', '信用币+50', '2025-03-26 21:54:58', 2022, -1, 1, 6, 0, 1),
('系统', '信用币+520', '2025-03-27 10:19:02', 2024, -1, 8, 6, 0, 1),
('轩辕', '加入战斗结算页面自定义', '2025-03-27 12:38:40', 2025, 1, 0, 0, 0, 0),
('系统', '物攻附加-600', '2025-03-28 12:39:19', 2027, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-28 15:05:51', 2028, -1, 1, 6, 0, 1),
('系统', '物攻附加-600', '2025-03-28 16:09:00', 2029, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-28 16:09:03', 2030, -1, 1, 6, 0, 1),
('轩辕', '修复设属更属的逻辑问题。', '2025-03-28 19:27:17', 2031, 1, 0, 0, 0, 0),
('轩辕', '物品镶嵌物加入详细第n个的设定', '2025-03-28 22:17:58', 2032, 1, 0, 0, 0, 0),
('系统', '物攻附加-600', '2025-03-28 23:40:32', 2033, -1, 1, 6, 0, 1),
('系统', '物攻附加+600', '2025-03-28 23:40:34', 2034, -1, 1, 6, 0, 1),
('系统', '血量-1', '2025-03-29 14:06:22', 2035, -1, 1, 6, 0, 1),
('系统', '血量+37732', '2025-03-31 01:04:01', 2038, -1, 1, 6, 0, 1),
('系统', '魔力+8', '2025-03-31 01:04:01', 2039, -1, 1, 6, 0, 1),
('系统', '信用币+50', '2025-03-31 01:09:01', 2040, -1, 46, 6, 0, 1),
('系统', '信用币+100', '2025-03-31 01:09:14', 2041, -1, 46, 6, 0, 1),
('系统', '信用币+50', '2025-03-31 01:10:41', 2042, -1, 46, 6, 0, 1),
('系统', '信用币-200', '2025-03-31 01:13:43', 2043, -1, 46, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 09:44:35', 2044, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 09:44:37', 2045, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 09:45:46', 2046, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 09:45:47', 2047, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 09:51:49', 2048, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 09:51:52', 2049, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 12:00:01', 2050, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 12:00:03', 2051, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 12:00:37', 2052, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 12:00:38', 2053, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 12:02:21', 2054, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 12:02:22', 2055, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 12:02:35', 2056, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 12:02:36', 2057, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 12:02:50', 2058, -1, 1, 6, 0, 1),
('系统', '物攻附加+599', '2025-04-05 12:03:54', 2059, -1, 1, 6, 0, 1),
('系统', '物攻附加-599', '2025-04-05 12:04:23', 2060, -1, 1, 6, 0, 1),
('系统', '物攻附加+23', '2025-04-05 12:04:31', 2061, -1, 1, 6, 0, 1),
('系统', '物攻附加-23', '2025-04-05 12:04:32', 2062, -1, 1, 6, 0, 1),
('轩辕', '添加一个功能/事件中打开物品的功能，会将选中的物品id传到下一个步骤中。', '2025-04-05 20:56:05', 2064, 1, 0, 0, 0, 0),
('系统', '物攻附加+23', '2025-04-08 19:56:35', 2067, -1, 1, 6, 0, 1),
('系统', '信用币+2', '2025-04-10 17:45:44', 2071, -1, 1, 6, 0, 1),
('系统', '信用币+2', '2025-04-17 23:01:40', 2073, -1, 1, 6, 0, 1),
('轩辕', '出招事件考虑怪物也要触发的问题', '2025-04-17 23:06:39', 2074, 1, 0, 0, 0, 0),
('轩辕', '完善优化和战斗相关的逻辑，事件等。', '2025-04-17 23:27:57', 2075, 1, 0, 0, 0, 0),
('系统', '血量+1888', '2025-04-22 14:20:19', 2083, -1, 1, 6, 0, 1),
('系统', '魔力+553', '2025-04-22 14:20:19', 2084, -1, 1, 6, 0, 1),
('轩辕', '物品搜索应该考虑更改过名字的情况', '2025-04-22 17:50:05', 2087, 1, 0, 0, 0, 0),
('系统', '血量+1', '2025-04-22 17:50:13', 2088, -1, 1, 6, 0, 1),
('系统', '血量-10', '2025-04-22 17:53:15', 2089, -1, 1, 6, 0, 1),
('系统', '血量-16', '2025-04-22 17:53:17', 2090, -1, 1, 6, 0, 1),
('系统', '血量-1', '2025-04-22 17:53:18', 2091, -1, 1, 6, 0, 1),
('轩辕', '加入自己状态和敌人状态模板定义。', '2025-04-22 18:16:01', 2093, 1, 0, 0, 0, 0),
('轩辕', '丢弃装备应该移除相关的addition属性', '2025-04-23 19:45:40', 2095, 1, 0, 0, 0, 0),
('轩辕', '加入附近玩家名称显示定义，比如：[VIP{o.vip}]{o.name}({o.lvl}级)', '2025-04-23 19:46:40', 2097, 1, 0, 0, 0, 0),
('轩辕', '加入玩家形象照上传事件', '2025-04-23 19:55:01', 2098, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_clan_list`
--

CREATE TABLE `system_clan_list` (
  `clan_id` int(11) NOT NULL,
  `clan_name` varchar(255) NOT NULL,
  `clan_desc` varchar(255) NOT NULL,
  `clan_lvl` int(11) NOT NULL DEFAULT '1',
  `clan_money` int(11) NOT NULL,
  `clan_exp` int(11) NOT NULL,
  `clan_max_exp` int(11) NOT NULL DEFAULT '1000',
  `clan_chairman` int(11) NOT NULL COMMENT '帮主uid',
  `clan_vice_chairman` varchar(255) NOT NULL COMMENT '副帮主uid，用,分割',
  `clan_members` varchar(255) NOT NULL COMMENT '成员uid，包含所有人',
  `clan_city` varchar(255) NOT NULL COMMENT '占领城市id，用,分开'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_clan_list`
--

INSERT INTO `system_clan_list` (`clan_id`, `clan_name`, `clan_desc`, `clan_lvl`, `clan_money`, `clan_exp`, `clan_max_exp`, `clan_chairman`, `clan_vice_chairman`, `clan_members`, `clan_city`) VALUES
(1, '测试', '测试', 1, 0, 0, 1000, 1, '', '1,2,8', '');

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
('959c9277a3e15eacff9e5f117e51f5bb', '', ''),
('945fd26d30e007abfed414cc1f2795f5', '', '');

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
(1, '抽奖1', 3, 'hp|1', '2|2|10,158|1|1,130|1|5,143|1|0.1,83|1|0.5,166|1|0.05', '1900-02-28 00:00:00', '2025-09-01 00:00:00'),
(2, '抽奖2', 3, 'hp|1', '', '2023-12-08 12:44:00', '2023-12-15 15:40:00');

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
(16, '勋章', 2),
(17, '披风', 2),
(18, '长矛', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_equip_user`
--

INSERT INTO `system_equip_user` (`eqsid`, `eqid`, `eq_true_id`, `eq_type`, `equiped_pos_id`) VALUES
('945fd26d30e007abfed414cc1f2795f5', 253, 224, 2, '6'),
('945fd26d30e007abfed414cc1f2795f5', 254, 225, 2, '5'),
('945fd26d30e007abfed414cc1f2795f5', 278, 222, 1, '1'),
('4e792f072d10eb2f6addd8d04cf5cbe8', 282, 553, 1, '2'),
('959c9277a3e15eacff9e5f117e51f5bb', 292, 360, 1, '3'),
('959c9277a3e15eacff9e5f117e51f5bb', 293, 548, 2, '17');

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
(1, 2, '', '你不能登录！目前登录事件仅步骤一会被触发', '', '登录'),
(1, 3, '', '', '', '上传形象照'),
(1, 4, NULL, NULL, NULL, 'pk'),
(1, 5, '', '', '', '出招'),
(1, 6, NULL, NULL, NULL, '被攻击'),
(1, 7, '', '', '', '战胜'),
(1, 8, NULL, NULL, '14', '战败'),
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
(2, 26, NULL, NULL, '', '创建'),
(2, 27, NULL, NULL, NULL, '查看'),
(2, 28, NULL, NULL, NULL, '出招'),
(2, 29, NULL, NULL, NULL, '被攻击'),
(2, 30, NULL, NULL, NULL, '战胜'),
(2, 31, '', '', '', '战败'),
(2, 32, NULL, NULL, NULL, '被收养'),
(2, 33, NULL, NULL, NULL, '交易'),
(2, 34, NULL, NULL, NULL, '升级'),
(2, 35, NULL, NULL, NULL, '心跳'),
(2, 36, NULL, NULL, NULL, '分钟定时'),
(3, 37, NULL, NULL, '', '创建'),
(3, 38, NULL, NULL, NULL, '查看'),
(3, 39, NULL, NULL, NULL, '使用'),
(3, 40, '', '', '12', '穿上装备'),
(3, 41, '', '', '13', '卸下装备'),
(3, 42, '', '', '10', '镶物镶入'),
(3, 43, NULL, NULL, '11', '镶物卸下'),
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
('1', 1, '{\"u.max_burthen\":\"100\"}', '', NULL, '1', '', '', NULL, NULL, '', '', '', '', 1, '', '', 0, '', '', '', '', '', NULL),
('24', 6, '', '{\"u.zxsj\":\"1\"}', NULL, '', NULL, '', NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('22', 7, '{\"u.maxhp\":\"({u.lvl}+10)*({u.lvl}+5)*2\",\"u.hp\":\"{u.maxhp}\",\"u.maxmp\":\"({u.lvl}+10)*({u.lvl}+10)/4\",\"u.mp\":\"{u.maxmp}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL),
('52', 8, '', '{\"g.minute\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('42', 10, NULL, '{\"o.added_wg\":\"{u.wg_fj}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('43', 11, NULL, '{\"o.added_wg\":\"-{u.wg_fj}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('40', 12, NULL, '{\"u.wg_fj\":\"{o.wg_fj}+{o.added_wg}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('41', 13, NULL, '{\"u.wg_fj\":\"-({o.wg_fj}+{o.added_wg})\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
('8', 14, '{\"u.hp\":\"{u.maxhp}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `r_adopt` varchar(255) DEFAULT NULL COMMENT '删除宠物',
  `next_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_event_evs_self`
--

INSERT INTO `system_event_evs_self` (`belong`, `id`, `s_attrs`, `m_attrs`, `equips`, `a_skills`, `r_skills`, `items`, `a_tasks`, `r_tasks`, `fight_npcs`, `cond`, `exec_cond`, `cmmt`, `cmmt2`, `not_return_link`, `dests`, `inputs`, `just_return`, `view_user_exp`, `page_name`, `refresh_scene_npcs`, `refresh_scene_items`, `a_adopt`, `r_adopt`, `next_text`) VALUES
('2', 2, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '---\r\n\r\n**游戏用户协议**\r\n\r\n**一、接受协议**\r\n1. 感谢您选择使用【{c.name}】游戏（以下简称“游戏”）。在使用本游戏前，请仔细阅读并理解本用户协议。\r\n2. 您同意并接受本协议的全部内容，一旦使用本游戏，即表示您同意遵守本协议的条款和条件。\r\n\r\n**二、用户许可**\r\n1. 我们授予您一项有限的、非排他性的许可，以使用【{c.name}】游戏，但您不得以任何方式复制、修改或分发游戏。\r\n2. 您不得使用任何未经授权的方式干扰、破坏或尝试破坏游戏的正常运作。\r\n\r\n**三、账户**\r\n1. 您需要创建一个游戏账户，您对该账户的安全负有责任。\r\n2. 您不得分享或泄露您的账户信息，如有账户安全问题，您应立即通知我们。\r\n\r\n**四、游戏内容**\r\n1. 游戏内的虚拟物品和货币属于【{c.name}】，您无权要求以任何形式兑换或提取。\r\n2. 我们保留随时修改、更新或删除游戏内容的权利。\r\n\r\n**五、隐私政策**\r\n1. 您同意我们的隐私政策，了解我们如何处理您的个人信息。\r\n2. 我们将采取合理措施保护您的个人信息的安全。\r\n\r\n**六、终止**\r\n1. 您可以随时停止使用游戏。\r\n2. 我们有权随时终止您的许可，如果您违反本协议。\r\n\r\n**七、免责声明**\r\n1. 游戏按“原样”提供，我们不保证游戏的适用性、可用性或安全性。\r\n2. 我们不对因使用游戏而引起的损失承担任何责任。\r\n\r\n**八、协议变更**\r\n1. 我们保留随时更改本协议的权利。\r\n2. 更新后的协议将在游戏内生效，您应定期查看协议内容。\r\n\r\n**九、联系我们**\r\n1. 如果您有任何问题或疑虑，请联系我们。\r\n\r\n**十、法律适用**\r\n1. 本协议受相关法律的约束。\r\n\r\n【{c.name}】游戏团队\r\n\r\n---\r\n', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('4', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('4', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一座无名的石碑。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('6', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一块有些年头的大理石圆柱石碑，右上角缺了一口，石碑中间位置写着：\r\n@red@中庭地白树栖鸦，冷露无声湿桂花。\r\n今夜月明人尽望，不知秋思落谁家。@end@', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('7', 8, '', '{\"u.hp\":\"-{r.10}\"}', NULL, NULL, NULL, '{\"1\":\"-1\"}', NULL, NULL, NULL, '', '', '你好！{u.name}。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('8', 9, '', '{\"u.hp\":\"{u.maxhp}-{u.hp}\",\"u.mp\":\"{u.maxmp}-{u.mp}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}：怎么伤得这么重，让我给你治疗一下吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('9', 10, '{\"u.pick_lj\":\"{c.time}\"}', '{\"u.hp\":\"-{r.20}\"}', NULL, NULL, NULL, '{\"9\":\"{r.2}+1\"}', NULL, NULL, NULL, '', '', '你打开了这个圆柱形的家伙，一股恶臭向你袭来，你感觉整个人都不好了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('10', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你拿起了褶皱的报纸一看，上面很大一部分的字迹都模糊了，只有一行字还比较完整：\r\n@red@希望小队至今无一人有消息。@end@', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('11', 12, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '一盏由橡木和不知名水晶组合成的路灯，不清楚其运行机理。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('12', 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这个咖啡杯已经很久没有使用过了，灰尘遍布。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('13', 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '树枝，废铁，封的死死的，毫无办法。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('14', 15, NULL, '', NULL, NULL, NULL, '{\"1\":\"10\"}', NULL, NULL, NULL, '', '', '「{o.name}」望了望你的样子。\r\n「{o.name}」：嘿，小子，你从哪里来?(说完便抽了一口手中的劣质雪茄)\r\n「{u.name}」：我可能患有间歇性失忆症，忘记了很多事，我只知道自己叫「{u.name}」了。\r\n「{o.name}」：旧街不养闲人，你必须证明你自己的价值，否则就会被驱赶出去荒野！\r\n「{u.name}」：我看路上有很多无家可归的人啊，他们怎么可以留在这。\r\n「{o.name}」：他们?他们是附近一个避难所被异兽潮汐攻陷后的流民，身份干净的可怜人，睁一只眼闭一只眼了，但你的眼神迷茫却没有绝望，只是疑惑。\r\n「{u.name}」：好吧。。。怎么证明?\r\n「{o.name}」：很简单，智力和武力。\r\n「{u.name}」毫不犹豫：我选择智力。\r\n「{o.name}」：你是第925个挑战智力的，我劝你直接放弃去选择武力。\r\n「{u.name}」：智力的考验是什么?\r\n「{o.name}」：也罢，虽然已经讲过了924遍了，再讲一遍又何妨呢?咳咳，听好了：\r\n一天早上，「薇儿」医生想去荒野采集草药时，惊讶地发现自己的智能轮椅不见了，他知道，一定是邻居家的那几位小孩干的。她很清楚，这几个孩子经常喜欢搞恶作剧，于是便找到了邻居家里，恰好，邻居家5个小孩都在。\r\n「薇儿」很和蔼地笑了笑，并询问是不是你们当中谁骑走了她的轮椅。然而，这五个孩子却给她出了一道题。下面是这5个孩子陈述的内容，其中各有一半正确一半错误。（即：一句话中，逗号前面是一半，后面是一半）\r\n孩子A：是B骑走的，C说D骑走的是撒谎；\r\n孩子B：不是我骑走的，也不是A骑走的；\r\n孩子C：不是B骑走的，是D骑走的；\r\n孩子D：A说是B骑走的是说谎，B说不是A骑走的是真的；\r\n孩子E：不是我骑走的，关于这件事我只知道这么多。\r\n聪明的「薇儿」听完他们的话，很快就推理出究竟是谁骑走的轮椅，很快便找到了轮椅。\r\n请问，根据以上信息，你能否推理出，究竟是哪一个孩子骑走的呢？请给出你的推理。\r\n「{u.name}」：是。。。算了还是说说武力测试吧。\r\n「{o.name}」：往东边走过去你会看到一条发黑粘稠的小河，那边发生了一些异变导致堤岸的泥土拥有了形体和微弱的战斗本能，去取得它们身上3块「变异的土」给我证明你是个有点战斗能力的人。\r\n「{u.name}」：这么简单啊?我去去就来。\r\n「{o.name}」：别小瞧了，这些「变异的泥土生物」力气很大且不惧怕疼痛的，这几个药带着，外乡人。(说完「{o.name}」便自顾自抽剩下的半截雪茄去了)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('15', 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '腐烂的大理石桌上躺着一座老式台灯，灯罩漏了一个洞，你用右手食指碰了一下，突然发现墙壁角落里出现了一个秘密通道...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('15', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '309', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('16', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, 'gomid|传送mid|1|10', 0, '', '', '', '', NULL, NULL, '传送'),
('16', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.gomid}!=\"\"', '', '你输入的是{u.input.gomid}！', '输入有误！请不要输入空白！', 0, '{u.input.gomid}', NULL, 0, '', '', '', '', NULL, NULL, ''),
('17', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, NULL, 0, '', 'ct_tent', '', '', NULL, NULL, ''),
('19', 23, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '「{o.name}」：你就是「{u.name}」吧，我从「莉莉安」那听过你的大名。\r\n「{u.name}」：这真是我的荣幸啊。\r\n「{o.name}」：行了，闲话不多说，我有点事走不开，你能帮我找来几个「变异利爪」吗，我会给你付报酬的，我需要这些爪子造点有趣的东西。\r\n「{u.name}」：我要去哪里找?还有，什么有趣的东西?\r\n「{o.name}」：去那片「灰青草地」看看吧！这是秘密，你要是能找来我要的东西我可以考虑告诉你。\r\n「{u.name}」：行，那你等我吧。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('19', 24, NULL, NULL, NULL, NULL, NULL, '{\"1\":\"5\"}', NULL, NULL, NULL, '', '', '「{o.name}」：行，带上这些药，你也许能用到。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('20', 25, NULL, '{\"u.exp\":\"500\",\"u.money\":\"50\"}', NULL, NULL, NULL, '{\"1\":\"10\",\"24\":\"-5\"}', NULL, NULL, NULL, '', '', '你将五个「变异利爪」递给了「{o.name}」\r\n「{u.name}」：给，这应该是你要的东西吧?\r\n「{o.name}」拿起来反复观摩了好一会，说道：太好了，这下我的「秘密武器」的最后一块总算补上了。\r\n「{u.name}」：什么「秘密武器」?\r\n「{o.name}」一脸警惕和不耐烦：这些东西拿着，当你的报酬了，好了没有「秘密武器」，该干嘛干嘛去，不要烦我。\r\n「{u.name}」：。。。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('22', 27, NULL, NULL, NULL, NULL, NULL, '{\"67\":\"1\"}', NULL, NULL, NULL, '', '', '「{u.name}」:找我何事?\r\n「{o.name}」:听说最近你帮旧街的大家解决了很多问题嘛，挺能干的啊～(抽了一口烟)\r\n「{u.name}」:大哥，您又要让「{u.name}牌牛马」干什么事了，我有心理准备。\r\n「{o.name}」突然严肃起来:「希望镇」的商队已经很久没过来了，我担心是不是出了什么变故，我观察你最近表现，身手很敏捷，我想让你去那边看一看，顺便把我的一封信带给我的老朋友「姗妮」，她就是「希望镇」贸易的负责人，她住在希望小区1栋306房间，事成之后我会把我一条珍贵的项链送给你当作报酬。\r\n「{u.name}」:「歌尔特」说要到那边去很危险，我觉得你就是故意让我去送死！\r\n「{o.name}」:不是的，实在是「希望小队」的成员全体失踪，「歌尔特」的伤又那么严重，现在只能靠你了，如果你不愿意，我不敢想象没有商队补给这边稀缺的物资过来，旧街的大家能撑到什么时候。。。\r\n「{o.name}」陷入了沉默。\r\n「{u.name}」:我接了，正好我也要寻找一下自己身世来历，看看希望镇那有没有什么线索，但是我还有一个要求。\r\n「{o.name}」:什么要求?\r\n「{u.name}」:等我回来再说。\r\n说完你便准备起身离开。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('24', 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你从暗道的管道口爬了出去。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('24', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '306', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('25', 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这座断桥原本应该是通向外界的，不知什么原因断了，也许是年久失修吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('26', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一台能与外界进行联络的通讯设备，但似乎不能运转了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('27', 33, NULL, '{\"u.money\":\"-200\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.money}>=200', '', '「巡逻警卫」瞅了你一眼，收下了你的200张信用币，数了一会，随后便示意你进去。', '「巡逻警卫」：非希望镇居民进入需缴纳200信用币进城费!', 1, '', NULL, 0, '', '', '', '', NULL, NULL, ''),
('28', 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '雕像通体长大约五米，宽两米，刻画的是一个双手拿着一把威能武器的中年男人，下面还有刻字：\r\n@red@人类纪元3216年，于此立镇取名〝希望〞，纪宁留@end@。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('29', 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '295', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('30', 36, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '48|3', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('27', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '236', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('31', 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18|100', '', '', '你好奇地看了看地洞，结果钻出来一堆怪物。\r\n', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('31', 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '287', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('32', 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}：{eval(v(u.lvl)&gt;20?&quot;你好，大人。&quot;:&quot;。。。&quot;)}', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('33', 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_HW003', '', '', NULL, NULL, ''),
('34', 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'H-W-003：自从异变以来，自然界中的地表水源发生了未知的变异，长期使用者罹患癌症丶重度癫痫等不治之症，目前仅有深藏于地下的水源和经过多道工序蒸馏冷凝水得到的过滤水可以使用，每一滴水源都来之不易，望每个希望镇居民能珍惜！', '', 0, NULL, NULL, 0, '', 'ct_HW003', '', '', NULL, NULL, ''),
('35', 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：看你这副打扮，你就是「莉莉安」推荐的「{u.name}」吧。\r\n「{u.name}」：我不知道怎么就失忆了，如果这个聚集地没有其他叫「{u.name}」的，那应该是我了。\r\n「{o.name}」：那你应该也从「莉莉安」那听说过我了，这样吧，也不卖关子了，你去北边杀几只老鼠看看实力。\r\n「{u.name}」：不就是几只老鼠，洒洒水啦～\r\n「{o.name}」：一棵灌木丛那么大的老鼠呢?\r\n「{u.name}」：呃，这个那个，有这么大的老鼠?\r\n「{o.name}」：北边的地原本是一片肥沃的草场，自从异变发生后，科学家猜测是某种辐射导致的生物群落变异，原先绿油油的草地不见了，变成了灰青色的草，这种草正常人吃了就会上吐下泻虚脱，但原来的野生鼠吃了以后就产生了奇怪的变异，现在和灌木丛一样大咯。\r\n「{u.name}」：不过是大一点的老鼠嘛，多大点事～\r\n「{o.name}」：那么大的牙齿咬人的话真的会死人的，而且据说在深处还有一只鼠王，被咬一口三分钟内就会中毒身亡，七窍流血死得很难看。\r\n「{u.name}」：这么可怕，那我能不能不去了?\r\n「{o.name}」：不行，「莉莉安」交代说如果你不去就把你逐出旧街。\r\n「{u.name}」：该死的女人！\r\n(你转身离去)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('37', 44, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}:谢谢您的光临！', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('36', 45, NULL, '{\"u.money\":\"20\",\"u.exp\":\"500\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：可以，有两下子嘛{eval(v(e.player_sex))}，虽然是对你的考验，不过也得给你点回报，毕竟，天下没有免费的劳动是吧?收着吧这是给你的报酬。\r\n「{u.name}」：简简单单信手拈来！\r\n「{o.name}」：还挺自信啊?我这边暂时没什么适合你的委托，不过好像「皮格」有事情在找人，你可以去找他看看，他在南街那里，噢～你也可以顺道去看看可怜的「迪伦斯」，真是个可怜的家伙，就说是我说的，去吧！我先忙去了！\r\n「{u.name}」：「迪伦斯」?\r\n(「{o.name}」没有回应，转身捣鼓自己的笔记本去了)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('38', 46, NULL, '{\"u.hp\":\"-({r.u.maxhp})\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」正在自言自语什么：蓝色蚊子的血偏碱性，用巨型苍蝇的卵中和一下，再用水元素粘液稀释，这样下来这道菜一定很美味！\r\n「{u.name}」：你好！\r\n「{o.name}」：{e.player_sex}，吓我一跳，想尝尝「{o.name}」的美食吗?\r\n「{u.name}」：美食?\r\n你看着眼前这口大坩埚里咕噜冒泡的五颜六色的液体，不禁浑身颤抖。\r\n「{u.name}」：这能吃?骗鬼呢?\r\n「{o.name}」：{e.player_sex}，新来的吧，旧街上谁不知道「{o.name}」的大名，有意思，这么久了，竟然有新人会来到旧街，好好好！哈哈哈！\r\n你看着对方狂笑，感觉是不是来错地方了，正打算回去找一下「歌尔特」问看看。\r\n「{o.name}」的一只大手就搭过来肩膀，重重地拍了你几下，你感觉胸腔的气血都要蹦出来了。\r\n「{u.name}」：有猫病?你这看起来就像是旧世纪书中那些女巫婆炼金的药液一样，你自己尝了吗?你看那冒着咕噜的泡泡，我想，里面孕育着恶魔是吧！\r\n「{o.name}」：{e.player_sex}，你是在挑战「{o.name}」的厨艺吗?看样子不露两手给你看看，你还真没把「{o.name}」放眼里呀，这样吧，就眼前这口汤，我其他辅料都准备好了，就差一味「蓝蚊子的血」，你去北边搞几滴过来，我让你见识下啥叫美味！\r\n「{u.name}」：我才不想当小白鼠，除非?\r\n「{o.name}」：除非什么?\r\n「{u.name}」：得加钱！\r\n「{o.name}」：哼，真是庸俗，我的美味岂是俗物可以衡量的。\r\n「{u.name}」：那我走?\r\n「{o.name}」：+100\r\n「{u.name}」：成交！大爷您要蓝蚊子血液是吧，得勒，马上来！\r\n「{o.name}」：哼，臭{e.player_sex}，一定让你看看「{o.name}」的手艺！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('39', 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这是一方不大不小的水池，周围的野生动物有时会来此补给水分，也是蚊子的滋生地！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('40', 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{o.name}：传说，一场灾变几乎导致了人类的灭顶之灾，而后身处神国的主不顾天地法则的戒律，硬是往这绝望的土地传下祂的力量，主的心中有大慈大悲之心，祂怜悯世人，祂指引世人，祂将祂的无限伟力无偿地赋予了每一位祂的信徒们，祂曾降下神谕：希望是最伟大的力量。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('41', 49, NULL, '{\"u.exp\":\"500\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你看着眼前这个眼神呆滞的男人，心里涌现了一股怜悯。\r\n「{o.name}」：乌鸦！好多乌鸦！（说完「{o.name}」又蹲在了墙角，一只手抱着头，一只手在啃一个早已变质发臭的面饼）\r\n你感到奇怪，这个乌鸦肯定是关键线索，你想想还是回去和歌尔特说明一下情况吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('42', 50, NULL, NULL, NULL, NULL, NULL, '{\"6\":\"1\"}', NULL, '6', NULL, '', '', '{u.name}：「迪伦斯」，他究竟怎么了?\r\n{o.name}：你看过他的状态了吧。\r\n{u.name}默尔不语。\r\n{o.name}拿起了他的笔记本，提了下眼镜，轻轻翻了几下。\r\n{o.name}接着说：也是过去半年了啊，这日子真是没个安生的，算一天过一天啊。\r\n{u.name}：到底发生什么事了。\r\n{o.name}：半年前的一天，由于生态平衡已经彻底被打破了，造成了那些变异的野兽食物短缺，从而发疯似的朝着「旧街」的聚集地冲撞，起码有上千只了，这些变异的野兽力大无比，魁梧健壮，地上跑的天上飞的都有。那天我正在安排佣兵团处理一个地下水道老鼠的事情，然后......\r\n{u.name}：等等，什么地下水道老鼠?\r\n{o.name}：这不重要，重要的是那个时候忽然从天空传来几声刺耳的尖叫，震碎了好多居民的木房子，接着就看到不远处的草地那边像地震一样跑着许许多多的野兽，「旧街」上的人很慌张，于是我马上拉响了最高警戒，很快，「旧街」上能战斗的都拿起武器聚集到广场上了。「迪伦斯」的父亲「詹姆士」也在内。\r\n{u.name}：然后呢?\r\n{o.name}：不知道为什么，那次的异兽潮很不对劲，狼群里那几只最健壮的青狼一起扑向了「詹姆士」，「詹姆士」寡不敌众，我们其他人也被缠着腾不出手，结果「詹姆士」硬生生拼死了两头青狼，剩下的一头青狼也精疲力竭全身重伤，这时红狼王见状呼嚎了一声，异兽潮很快退去了，而「詹姆士」深受重伤又精疲力尽，最终卡尔萨斯也没能救回来，更可怜的是「迪伦斯」亲眼目睹了父亲的死，结果精神失常了，只是不断喊着〝紫色的丶乌鸦，我不是叛徒之类的〞。\r\n{u.name}：叛徒?「詹姆士」之前是哪里来的?\r\n{o.name}：「旧街」的规矩是来者只要被认可为一员不会询问来处，不过以我多年接触到的人以及他的口音推测可能是「希望镇」的人吧。\r\n{u.name}：「希望镇」?\r\n{o.name}：是的，那是一片人类仅剩不多的繁华之地，从「旧街」北边过去要跨过很长的路，没有专业的护卫队和枪械力量根本过不去。算了我们还是说说「迪伦斯」的事情吧。我觉得突破口在于找到「紫色的羽毛」，估计「灰青草地」深处会有线索，我事务很忙走不开，这件匕首给你，这事只能麻烦你了。\r\n{u.name}：我会尽力的。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('44', 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '【{c.name}】账号密码安全手册(第一版)\r\n为了您的账号安全，请阅读本手册。\r\n免责声明：若出现账号纠纷，无法以未阅读本手册作为辩护理由。\r\n1.用户不得将账号密码丶安全令丶绑定手机号等泄漏或提供给第三人知悉，亦或者转让他人使用，如因用户自身不遵守本条导致的账号数据丶财产损失等，由用户自身承担责任，本公司将协助调停并调和双方矛盾。\r\n2.若忘记账号密码，可通过绑定手机号验证码找回或者安全令进行重置。\r\n', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('45', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '〝善良，真诚，矢志不渝，机器的轰鸣没有击碎人性的美好，那是段祥和的时光。〞旧纪元的故事仿佛只留存在了少数的古书之中，过去的百年间，世界发生了太多的变化，这变化让人类不得不重新思考自己和这个世界的关系，那场至今都是未解之谜的异常中子星衰变带来了一系列的灾难，野兽普遍体型剧增，开始变得癫狂又富有攻击性;地表水等基础资源受到未知变异，表现出许多的特性。\r\n人类的未来何去何从?', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('43', 53, NULL, '{\"u.money\":\"100\",\"u.exp\":\"500\"}', NULL, NULL, NULL, '{\"29\":\"-5\",\"31\":\"1\"}', NULL, NULL, NULL, '', '', '你将几滴蓝色液体递给了「{o.name}」。\r\n「{o.name}」颤抖着双手接过：很好，就是这个。\r\n只见「{o.name}」将那几滴蓝色液体加入沸腾的糊状液体中，原本暗红的液体时而浅蓝，深蓝，时而又变回暗红，最后「{o.name}」将几粒白色颗粒粉末碾碎撒入后，颜色固定成了棕蓝色，液体也变得很粘稠，最后几乎成了固体，只见「{o.name}」将早已准备好的木勺一舀，装进了一个木色方形袋子中。\r\n「{o.name}」：一份Q弹可口的「营养元素冻」，请享用，这是给你的，{e.player_sex}，为了感谢你，做事不拖泥带水，很合「{o.name}」胃口，「{o.name}」心情很好，决定以后你可以从「{o.name}」的买走美味！\r\n「{u.name}」：哇，大爷你真厉害！给你竖大拇指！\r\n(这大爷不会真有什么毛病吧，你心想)\r\n「{o.name}」：好了，美味的征程是无止境的，「{o.name}」要开始研究下一道美食的旅途了，有缘再见！\r\n「{u.name}」：那就希望大爷能继续创造美味咯～(o～\r\n「{o.name}」：怎么了?\r\n「{u.name}」：美食，最近睡眠不好，头有点晕。\r\n「{o.name}」：要注意休息啊，这是「{o.name}」给朋友的报酬，收好了！\r\n「{u.name}」：再见，大爷！\r\n(你觉得还是有必要回去找找「歌尔特」)', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('48', 54, NULL, NULL, NULL, NULL, NULL, '{\"1\":\"10\"}', NULL, NULL, NULL, '', '', '「{u.name}」：我觉得你在坑我！\r\n「{o.name}」：为什么这么说？\r\n「{u.name}」：你让我去找「皮格」，我真醉了他要什么蓝蚊子的血液，说要做美食，这太扯淡了！\r\n「{o.name}」：哈哈，你竟然能让「皮格」那家伙理你，我本来都没抱什么希望，这旧街能让「皮格」说上几句话的可没几个，他的东西奇怪是奇怪了点，可味道没得说，最主要的是效果。\r\n「{u.name}」：效果？\r\n「{o.name}」：是的，他的食物有的能解放人体基因锁，有的能增强体质，有的能加强回复力。\r\n你拿起手中那个奇怪的食物。\r\n「{u.name}」：真这么神？\r\n「{o.name}」：以后你有机会会见到的，不过最好是不要见到。\r\n「{u.name}」：我还是不信...\r\n你话还没说完，「{o.name}」突然抬起了腕表，只见上面闪着几道红色的激光。\r\n「{o.name}」：你可能要用上了。\r\n「{u.name}」：？？？\r\n「{o.name}」：这个月的狼群数量波动异常了，一些「变异的灰狼」战斗能力会变强但群体意识会下降脱离狼群，现在我正式委托你前去清理一些「变异的灰狼」，它们的尾巴上有淡淡的蓝光，很好辨认，对了如果遇到尾巴上是淡淡红光的，赶紧跑，那是「变异狼王」。\r\n「{u.name}」：你为什么不自己去？或者让你的佣兵团去？\r\n「{o.name}」：其他的佣兵都有自己的任务了，你的战斗力也不弱，对了，这些药品给你作为补给品，别死那了，这是「莉莉安」大人说的。\r\n「{u.name}」：恶毒的女人，还有你，鄙视你。\r\n「{o.name}」：今天的羊羔肉卷饼价格是...\r\n「{o.name}」回过头去在笔记本上写写划划，仿佛把你当成了空气。\r\n「{u.name}」：......', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('49', 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你仔细找了找鹅卵石小路旁边一个不起眼的小洞口，而后钻了进去...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('49', 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '339', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('50', 57, '{\"u.nick_name\":\"旧街居民\",\"u.tent_x\":\"2\",\"u.tent_y\":\"2\",\"u.tent_z\":\"1.5\",\"u.tent_color\":\"灰色\",\"u.tent_burthen\":\"100\"}', '{\"u.exp\":\"1000\",\"u.money\":\"50\"}', NULL, NULL, NULL, '{\"1\":\"20\",\"18\":\"3\",\"11\":\"3\"}', NULL, NULL, NULL, '', '', '「{o.name}」：很好，「莉莉安」大人说了，你用行动帮助了「旧街」，也用行动证明了你的能力，从现在开始，你被正式接受了，成为「旧街」的一个居民，有顶闲置的帐篷你拿去用吧。\r\n获得称号：旧街居民\r\n「{u.name}」：啊?不用再完成你的委托啦?那个坏女人呢?\r\n「{o.name}」：嘘～可不许这样背后嘀咕「莉莉安」大人，委托你想做就做吧，只是在旧街遭遇生死危机的时候履行你作为旧街居民的义务就行，这些奖励你先拿着，以后每天你可以在我这领取一些物资和金钱，当然没有这次这么多，「莉莉安」大人好像找你有事，你去看看吧！\r\n「{u.name}」：哇，行，旧街是我家，美化靠大家。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('47', 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你似乎没有办法徒手爬上去。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('51', 59, '{\"u.fix_bridge\":\"1\"}', NULL, NULL, NULL, NULL, '{\"8\":\"-10\",\"10\":\"-20\",\"15\":\"-5\",\"37\":\"-3\"}', NULL, NULL, NULL, '{u.ic.i8}>=10&&{u.ic.i10}>=20&&{u.ic.i15}>=5&&{u.ic.i37}>=3', '', '你将所有材料拿了出来，按照脑海中的大概念想，先是用黑色牛角钉住了铁皮和小树枝编成的简易桥体，然后竖了起来慢慢往对岸轻轻放下，随着扑腾一声，你用石块压住了黑牛角，而后走到对岸又用黑牛角以及碎石做了固定，这座桥看起来勉强可以过人了。', '你看了一眼这座年久失修的破桥，脑海在飞速计算，要修好面前这座残破的桥的话，差不多需要：\r\n10个铁皮({u.ic.i8})\r\n20个小树枝({u.ic.i10})\r\n5个碎石块({u.ic.i15})\r\n3个黑色牛角({u.ic.i37})', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('52', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你蹑手蹑脚地踏上了桥，一步步地移动到对岸......', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('52', 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '489', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('53', 62, NULL, '{\"u.exp\":\"800\",\"u.money\":\"100\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你将拿到的羽毛递给了「{o.name}」\r\n只见{o.name}翻出了他的笔记本，翻着翻着找到了一页对应的页数。\r\n「{o.name}」：有了。\r\n「禽类变异羽毛」-「紫色乌鸦羽毛」\r\n说明：原先是普通的乌鸦的羽毛，经历不知名变异后通体为紫色，带有中度致幻效果，会尝试诱导较为刺激性的往事，若无法及时被唤醒则会逐渐迷失直至精神衰亡。\r\n「{u.name}」：那我为什么和它们战斗的时候没有被影响?\r\n「{o.name}」用右手顿了顿眉心：我记得你说过你是一个失忆的旅人是吧，若是如此，那便可以解释得通了，你的记忆以普通乌鸦的致幻性不足以撬开那个封口，所以也就不会让你致幻了。\r\n「{u.name}」：唉，要是能帮我回忆起来也好啊，我也不至于这么迷茫。话说这样的话我们要怎么解救「迪伦斯」?\r\n「{o.name}」：为今之计，只有去「迷雾小屋」那找一下「赛西」，让她用一味刺激性的魔药强行唤醒「迪伦斯」了，这件事我亲自去处理一下吧，「赛西」不太希望被陌生人打扰。\r\n「{u.name}」：这个「赛西」是谁?\r\n「{o.name}」：一个神秘的女士，擅长一些不可思议的事情，好了以后有机会再介绍给你，这些是给你的报酬，唉，可怜的「迪伦斯」......', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('54', 63, '{\"u.lq_map0_dailygift\":\"{c.date}\"}', NULL, NULL, NULL, NULL, '{\"2\":\"{r.2}+1\",\"1\":\"3\"}', NULL, NULL, NULL, '{u.lq_map0_dailygift}!={c.date}', '', '{o.name}：每天的供给都十分有限，身为旧街居民的一员，更应该有为旧街贡献的觉悟！这是你今天的补给。\r\n{o.name}说完掏出了他的笔记本。', '{o.name}掏出了他的笔记本。\r\n{o.name}：根据记载，今天你的供给已经发放了呀。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('56', 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '你好！欢迎来到{o.name}!', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('59', 65, '{\"u.map_enter_fog\":\"0\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('60', 66, NULL, '{\"u.map_enter_fog\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.map_enter_fog}<4&&{u.tasks.t7}==2', '你感觉有些不太对劲...', '', 1, '', NULL, 1, '', '', '', '', NULL, NULL, ''),
('60', 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.map_enter_fog}>=4&&{u.tasks.t7}==2', '你逐渐迷失了自我...', '', 1, '554', NULL, 0, '', '', '', '', NULL, NULL, ''),
('69', 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你打开了面前的这扇木门，忽然一股吸力将你往外吸出，回头已经看不见小屋的踪迹，只有一片迷雾回应你...', '', 1, '539', NULL, 0, '', '', '', '', NULL, NULL, ''),
('70', 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '615', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('71', 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_HP_lift_1', '', '', NULL, NULL, ''),
('72', 71, '', '{\"u.money\":\"520\"}', NULL, NULL, NULL, '{\"2\":\"-1\"}', NULL, NULL, NULL, '', '', '你打开了钱袋，发现了不少钱。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('1', 72, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_szcs', '', '', NULL, NULL, ''),
('75', 73, '{\"u.qd_daily\":\"{c.date}\"}', '{\"u.money\":\"{r.3}+1\",\"u.qd_cs\":\"1\",\"u.icc.2\":\"2\"}', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '{u.qd_daily}!={c.date}', '签到成功！', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, '返回签到'),
('76', 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_bounty_01', '', '', NULL, NULL, ''),
('78', 75, '{\"u.submit_bounty_01_item_01\":\"{c.date}\"}', '{\"u.exp\":\"1000\",\"u.money\":\"50\"}', NULL, NULL, NULL, '{\"24\":\"-10\",\"18\":\"{r.3}+1\",\"163\":\"1\"}', NULL, NULL, NULL, '{u.ic.i24}>=10', '', '「歌尔特」:感谢你的付出，这是你的报酬，请明天再来!', '「歌尔特」:你并没有这么多「变异利爪」，再去找找吧!', 0, NULL, NULL, 1, '', '', '', '', NULL, NULL, ''),
('79', 76, NULL, '{\"u.money\":\"-50\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.money}>=50', '', '「小乞丐」:谢谢你的善良和慷慨，愿「希望之主」眷顾你！', '「小乞丐」:谢谢你的好意，但是你似乎也没有多少余钱了，还是照顾好自己吧！', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('81', 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这座墓碑上没有姓名，仅仅只有一行字:\r\n@red@向为了「火种计划」而牺牲的所有人类同胞致以最崇高的敬意@end@', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('82', 78, NULL, '{\"u.max_burthen\":\"5\"}', NULL, NULL, NULL, '{\"72\":\"-1\"}', NULL, NULL, NULL, '{u.max_burthen}<100', '', '你拿出背包编织工具，对你的背包进行了一番修缮，忙活了一阵后，看起来你的背包能装下更多东西了。', '你发现再编织下去背包就要散架了，只得收手。', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('83', 79, '{\"u.tomorrow_1_floor\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_HP_lift_1', '', '', NULL, NULL, ''),
('84', 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{u.env.name}」', '', 1, NULL, 'hp_1_target_floor|要去几楼呢?|1|2', 0, '', '', '', '', NULL, NULL, '关上电梯'),
('84', 81, '{\"u.tomorrow_1_floor\":\"{u.input.hp_1_target_floor}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.hp_1_target_floor}>=1&&{u.input.hp_1_target_floor}<=20', '', '你按下了{u.input.hp_1_target_floor}层的按钮，过了一会功夫，电梯就将你送到了目的地。', '你看了半天，总觉得找不到这个层数啊!', 1, '{eval(v(u.tomorrow_1_floor)==1?493:614)}', NULL, 0, '', '', '', '', NULL, NULL, ''),
('85', 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你往这个粉色的门敲了敲，过了一会，一个美丽的年轻女子出来开门迎接了你...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('85', 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '632', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('86', 84, NULL, NULL, NULL, NULL, NULL, '{\"67\":\"-1\"}', NULL, '3', NULL, '', '', '「{o.name}」(一脸警惕)：你是?\r\n「你」：我是「莉莉安」的。。呃。。朋友，这是她的书信，你看了就明白了。\r\n你递过书信。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('87', 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '#希望镇重要物品|item001_tower#\r\n你正想触碰这个药罐，却被一个声音制止了。\r\n〝别碰这个药罐!除非你想尝尝执法队的子弹!〞', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('88', 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '#希望镇重要物品|item001_alternator#\r\n这是一台高精密的仪器终端，由特制的程序负责调动各个模块和接口实现利用生物能丶太阳能等进行一系列的复杂的能量传递转化。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('89', 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '莫名地产生一股寒意，还是不要随便触碰为好。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('90', 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你轻轻一跃，有惊无险地抓住了古藤条，它宛如粗壮的手臂承载了你的重量，你顺着枝条慢慢往下爬去...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('90', 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '333', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('91', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你用力一蹬，顺着古藤条爬了上去...', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('91', 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '546', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('86', 92, NULL, '{\"u.exp\":\"3000\"}', NULL, NULL, NULL, '{\"128\":\"1\"}', NULL, NULL, NULL, '', '', '「{o.name}」看了看「莉莉安的书信」，嘴中不断呢喃着什么。 不久过后。\r\n「{o.name}」：唉，自从疑似先知预言的「灾月」之后，希望镇的局势就变得很复杂，人心惶惶的，所有商队活动都暂时取消了。我先前有让人给「莉莉安」送去一封书信，看样子信使没有送到，凶多吉少了。\r\n「{o.name}」：既然你能找到这里，想必「莉莉安」对你的能力也很有信心，我这里这封信你再把它交给「莉莉安」，如果可以的话，请她带人过来支援下希望镇，森林那边的异兽潮汐越来越严重了，斥候小队疑似发现了五头异常能量波动的精英级别的异兽，异常行为背后疑似有第三方势力介入。如果不是代理镇长因为上次那事受伤实力大减，这次兽潮倒是勉强可以接下，唉～\r\n你：能将具体事与我说说吗?\r\n「{o.name}」：罢了，时间紧迫，以后你会慢慢明白的，现在先赶紧回去告诉「莉莉安」异兽潮汐异常的消息吧，这封信上我有大概说明了一下情况。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('93', 93, NULL, '{\"u.exp\":\"3000\"}', NULL, NULL, NULL, '{\"128\":\"-1\",\"137\":\"1\"}', NULL, '9', NULL, '', '', '「{o.name}」看到了你急匆匆的样子，你将「姗妮」的书信递给了她。\r\n「{o.name}」看了看信后，一脸凝重的样子。\r\n「{o.name}」：情况不容乐观。\r\n「{o.name}」：宁静森林的深处传来异动，并且陆陆续续有几头强大的异兽在希望镇哨站附近徘徊，驱赶过程杀了几头，偶然发现它们戴着一种小型的生态力场项圈，有控制心智的功能。\r\n「{o.name}」：这下有些棘手了，我得留在这统筹物资和人员，我需要你的帮助。\r\n「{u.name}」：但说无妨。\r\n「{o.name}」：有几个需要的人，一个是「KM」，是个黑客，住在北边峡谷里，一个是「赛西」，你见过的，她是一个魔法师，还有一个是「赫米特」，她在南边的小树林里，是一个天赋异秉的猎手，他们的性格都比较孤僻，不过也都遵守着旧街的规矩，若有请，以信物回答。\r\n「{u.name}」：也就是我要去取得他们的信物，然后交给你。\r\n「{o.name}」：恩，等你拿来他们的信物，我便知道你已经说服了他们，然后等候他们到来后你便先行带领「先行者小队」前往希望镇，找到「凌影」，他会给你们安排后面都任务的，时间紧迫，莫要拖延。\r\n「{u.name}」：我的项链呢？\r\n一串闪闪发光的项链从空而降，落到了你的手上。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('94', 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '接受了', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('95', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '完成了！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('97', 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '哈哈哈哈！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('98', 97, '{\"u.vehicle_ck\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_vehicle', '', '', NULL, NULL, ''),
('99', 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '峡谷的一间小木屋外，你敲了敲门，发现门没锁，于是你谨慎地走了进去，发现一个坐在地板上的人。\r\n「{o.name}」：该死，密克系统又出bug了，你是谁？\r\n「{u.name}」：希望镇出了一些奇怪的事情，「莉莉安」让我来邀请你加入「先驱者小队」前去探查一番，还有，我需要你的信物证明你的加入。\r\n「{o.name}」：一个土豆饼，我就跟你走，信物也给你。({o.name}拿出了胸口一块破碎的怀表)\r\n「{u.name}」(荒郊野岭的哪里给你找这玩意)：行，我去去就来。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('100', 99, NULL, '{\"u.exp\":\"1000\"}', NULL, NULL, NULL, '{\"65\":\"-1\",\"133\":\"1\"}', NULL, NULL, NULL, '', '', '你将「土豆饼」递给了KM。\r\n「{o.name}」：虽然不是当年那个味道，不过总能勾起我的回忆，真是一段肆意盎然的往事啊哈哈哈。\r\n说完他将胸前破碎的怀表交给了你。\r\n「{o.name}」：虽然不认可当年「莉莉安」的那些行为，但不得不承认，她的行动都是当时的最优解了，这个表请务必保管好，它对我很重要，谢谢。\r\n「{u.name}」：...', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('101', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：又见面了，「{u.name}」，别来无恙，嘘~我知道你的来意，我也很乐意出一份力，但我需要你的帮助。我在一次研究禁忌魔法的时候不小心沾染了深渊，现在我的梦境坐标被一批梦魇获取到了，我的精神状态很差，必须赶紧解决。我稍后会用秘法将你传送去我的梦中世界，你要做的便是帮我消灭一批成长体梦魇，我会在里面巩固一个临时传送阵，你完成后我能感应到，有任何问题你可以第一时间从传送阵往返。\r\n「{u.name}」：梦魇？传送，坏了，遇到真女巫了。\r\n「{o.name}」：...', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('102', 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你站在这座六芒星阵上，一阵奇特的符号出现在你的四周，而后光芒由脚升起，逐渐将你淹没...', '', 1, '677', NULL, 0, '', '', '', '', NULL, NULL, ''),
('103', 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '这座缓慢运作的五角星法阵散发着一股奇幻的气息，你站在上面，你的头上生出一颗不断膨胀的粉色光球，而后炸开成湍流而下，你很快便被粉色的洪流淹没...', '', 1, '554', NULL, 0, '', '', '', '', NULL, NULL, ''),
('104', 103, NULL, '{\"u.exp\":\"1200\"}', NULL, NULL, NULL, '{\"132\":\"1\",\"95\":\"1\"}', NULL, NULL, NULL, '', '', '「{o.name}」：噢，感谢你，终于能睡个好觉了，这些天可没少折腾，这个发夹给你，这颗钻石算是我的额外感谢，希望镇的事我会助一臂之力的，那么到时候见。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('106', 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你一走进山洞，还没适应有些黑暗的环境，便看到一把反光的匕首抵在你的身后，而后你做了一个标准的举手动作。\r\n「{o.name}」：你是谁？\r\n「{u.name}」：我是莉莉安派来的，希望镇出了一些事情，需要组建一只「先驱者小队」，希望你能加入。\r\n「{o.name}」沉默了一会：你等会。\r\n只见她抱着一只小黑狗过来，边过来还一边抚摸。\r\n「{o.name}」：我可以跟你走，但我得安顿好小黑，这样吧，你帮我找来一些木头，我给它搭个窝，木头要松木，食物的话，小黑喜欢吃素，自己会出去觅食。\r\n「{u.name}」：行。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('107', 105, NULL, NULL, NULL, NULL, NULL, '{\"45\":\"-20\",\"134\":\"1\"}', NULL, NULL, NULL, '', '', '你将松木交给了「{o.name}」。\r\n一阵时间过去了，一件简易精致的小屋搭成了，小黑看起来很开心，绕着小屋直打转。\r\n「{o.name}」：行了，我再陪一会小黑，我先把我的信物给你，到时候我会出现的。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('108', 106, '{\"u.random\":\"{r.3}\"}', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你会摇到什么呢?', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, '查看结果'),
('110', 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, 'i37|使用数量|1|5', 0, '', '', '', '', NULL, NULL, ''),
('110', 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.value}>=1&&{u.input.value}<={u.ic.i37}', '', '', '错误！', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('111', 109, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'shuru1|输入1|0|10,shuru2|输入2|0|10', 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('111', 110, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你的输入1：{u.input.shuru1}\r\n你的输入2：{u.input.shuru2}', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('113', 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '37|5', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('105', 112, NULL, '{\"u.exp\":\"3000\"}', NULL, NULL, NULL, '{\"133\":\"-1\",\"132\":\"-1\",\"134\":\"-1\"}', NULL, NULL, NULL, '', '', '你将km三人的信物递给了莉莉安。\r\n「莉莉安」：还好，他们还是没有见死不救，那么，你便去「KM」的小屋那边和他们汇聚吧，任务我已经和他们通过了，你们去希望镇找凌影开启后面的计划吧！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('114', 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你来到了熟悉的小屋，轻轻推开嘎吱的木门，才发觉KM，赛西，赫米特三人正在火炉旁边的木桌上坐着。\r\n「KM」：来了。\r\n「赛西」：那我们便准备出发吧，此次行动「{u.name}」为「先驱者小队」的队长，那么，我们的第一步动作是?\r\n「{u.name}」：走，出发，去找「凌影」。\r\n「KM」：等一等，这个山谷最近杀人蜂的状态不太对劲，我觉得还是先清理一波然后再过去比较安全，你觉得呢，「{u.name}」?\r\n「{u.name}」：妥。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('115', 114, NULL, '{\"u.exp\":\"3000\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '费了一些功夫，你们总算把大黄蜂群清理掉了一些。\r\n「KM」：「{u.name}」队长，既然已经处理完了，那我们便早些出发吧，去希望镇的路上还要经过一片森林，如果晚上了还是挺危险的，趁天色还早我们早点出发。\r\n众人点了点头。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('116', 115, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '你查看了{o.name}！', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('117', 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们来到了「迷雾森林」前方的峡谷口。\r\n「赫米特」：这边有很多变异的魔物，性情暴躁危险，即使是经验老道的猎人也不敢轻易涉足。\r\n「赛西」：我有一种魔药能驱赶魔物，但需要这些魔物身上对应的一些材料。\r\n「赫米特」：这片森林最多的就是巨齿兔，狂暴野猪和变异棕熊。\r\n「KM」：那么这边「{u.name}」队长你战斗力最高，就交给你了！\r\n「{u.name}」：举手之劳。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('118', 117, NULL, NULL, NULL, NULL, NULL, '{\"139\":\"-3\",\"140\":\"-1\",\"141\":\"-6\",\"142\":\"1\"}', NULL, NULL, NULL, '', '', '你将各种魔物材料递给了「赛西」。\r\n只见「赛西」将材料放在刻满了阵法的地上，接着拿出她的魔杖，朝着地上的材料指着，一道绿光从魔杖顶部射出，笼罩着地上的材料。没过一会，材料和阵法皆消失不见，只剩下一堆深灰色的粉末。\r\n「赛西」：将其带在身上，能避免那三种魔物的攻击。\r\n「KM」：那么事不宜迟，我们赶紧走吧！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('119', 118, NULL, '{\"u.exp\":\"5000\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们走出了「迷雾森林」。\r\n「赫米特」：看来这便是希望镇附近的荒野了，那么，我们去找凌影吧。\r\n「KM」：这一路上倒是没感到什么危险。\r\n「{u.name}」：废话，我之前都被「莉莉安」忽悠来踩过一圈了，我的实力保你们几个轻而易举。\r\n「KM」&amp;「赫米特」&amp;「赛西」：还得是队长👍', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('120', 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, '', '', '你们一行人来到了{u.env.name}。\r\n「凌影」：是旧街的援军吗，听莉莉安说先来了一支小队是吧。\r\n「{u.name}」：我们是「先驱者小队」，我是队长{u.name}，这位是KM，擅长黑客技术，这位是赛西，擅长超自然魔法，这位是赫米特，是一位经验丰富的猎手，后续大部队还在路上。\r\n「凌影」：太好了，这下希望镇的燃眉之急能缓解了。\r\n「{u.name}」：能请问一下到底发生了什么吗?\r\n「凌影」：经过我们的专家研究，附近森林后异兽很有可能发生了二次变异，变得更加暴躁和富有攻击力，原因还未知，不过怀疑有第三方势力插足。\r\n「{u.name}」：看样子是个令人头疼的问题，那么你需要我们做些什么吗?\r\n「凌影」：我们的生物学家需要更多的样本来分析异兽二次变异的原因，所以我们需要大量的异兽材料，其中很大一部分已经被获取分析了，唯独森林深处有几只比较强大的异变兽仍未制服，我希望你们能帮我取来这些异变兽的躯体，分别是：变异蓝蝶后的翅膀，变异杀人峰王的尾针以及变异巨齿虎王的利齿。\r\n「{u.name}」：该干活了各位。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('108', 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.random}==1', '成功了！', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', NULL, NULL, '返回页面'),
('108', 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.random}==0', '失败了', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', NULL, NULL, '返回页面'),
('108', 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '{u.random}==2', '没有发生任何事情', '', 1, NULL, NULL, 0, '', 'ct_vip', '', '', '', NULL, '返回页面'),
('125', 126, '{\"o.exp\":\"1314520\"}', '{\"o.lvl\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('126', 127, '{\"u.name\":\"{u.name}.\\\"123\\\"\"}', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', '', '', '', '', NULL, ''),
('127', 128, NULL, '{\"u.exp\":\"10000\",\"u.money\":\"3336\"}', NULL, NULL, NULL, '{\"147\":\"1\"}', NULL, NULL, NULL, '', '', '「凌影」：你们的强大值得希望镇所有人的尊敬！这是希望镇人民的赠予与感谢。另外这把手枪也赠予你，这样你们小队其它成员都有擅长的专属武器了。\r\n(凌影很快便吩咐随从送走三个材料)\r\n一会过后...\r\n「凌影」：生产中心那边应该已经研究得差不多了，事不宜迟，你们先去那边找「马修」看看，我还得处理其它事情。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('128', 129, NULL, '{\"u.hp\":\"{u.maxhp}-{u.hp}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「{o.name}」：主啊，救救这个受伤的羔羊吧！', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('129', 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '一个男人正在聚精会神用手中的眼睛观摩手中的一个精核。\r\n「马修」：呀！你们来了，吓我一跳。\r\n「KM」：马修博士，果然每次都是这样，一投入研究就忘记了全世界呢。\r\n「马修」：大背头，见到你一天好心情全没。\r\n「赫米特」：行了，老马，先别吵了，你这边研究得怎么样了。\r\n「马修」(一脸严肃)：初步怀疑是「厄加帝国」的遗民，(马修看着手中的精核)但还不敢确定。\r\n「赛西」：哦?「厄加帝国」在当年不是被...\r\n「马修」意味深长看了「赛西」一眼：摄政王没死。\r\n「赛西」显得有些激动：你说什么！\r\n「马修」：冷静冷静，这也只是推测罢了。\r\n「赛西」：你让我怎么冷静！「赛文」他...\r\n「马修」低下了头：抱歉，他的事是意外...\r\n「赛西」：我用各种方法包括创造「幻梦之境」去尝试释怀，但我发现我根本释怀不了。\r\n「KM」：好了，我们现在的主要任务是解决希望镇异常的兽潮，死马，这和厄加帝国有什么关联吗?', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('129', 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「马修」：我们的生命研究小组尝试融合编译了一下异变个体的特殊部件，结果就是我手上这颗精核了。\r\n只见马修手中的精核上面，一朵妖艳诡异的花印在了上面。\r\n「赛西」：紫色曼陀罗?这是「厄加帝国」的标志，没错了，肯定和它们有关！\r\n「马修」：问题就出在这，生命研究小组尝试对其基因密码进行破解，却被一道转译锁挡住了，强行破解会直接毁掉整串基因，我们尝试着用库存的密钥进行比对，发现变异银杉树的树汁的序列高度吻合，很可能就是钥匙。\r\n「赛西」：变异银杉树，这种植物不是灭绝了吗?\r\n「马修」：我本来也发愁，幸运的是，前几天有个冒险家提供了相关线索，就在宁静森林西边的沼泽地里。\r\n「KM」：既然有线索了，那事不宜迟我们马上出发吧\r\n「马修」：务必小心，那位冒险家提到要特别注意里面的荆棘。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('130', 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们看了看眼前的荆棘。\r\n「赛西」摆了摆手：都让开。\r\n只见她的权杖顶端出现了一颗火球，随着她一甩，瞬间将面前的荆棘燃烧殆尽。\r\n随后，她的权杖顶端出现了一颗水球，将眼前的荆棘灰冲洗一空，一条道路出现在眼前。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('131', 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21', NULL, NULL, NULL, NULL, NULL, 1, '706', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('135', 135, '{\"u.remove_cathaya\":\"1\"}', '{\"u.exp\":\"5771\"}', NULL, NULL, NULL, '{\"148\":\"1\"}', NULL, NULL, NULL, '{u.remove_cathaya_1}==1&&{u.remove_cathaya_2}==1&&{u.remove_cathaya_3}==1&&{u.remove_cathaya_4}==1', '', '你将双手放在这棵诡异的银杉树上，突然青光一闪，这棵银杉树一阵颤抖，从其中飞出一暗金色的液滴，缓缓降在你的手心之上，你看着这液滴，能感受到银杉树对你的阵阵喜爱与感谢之情。\r\n「赫米特」：万物皆有灵，人类的贪婪比自然的惩罚更加可怕。\r\n「KM」：既然已经到手了，那我们便回去吧。', '「赫米特」：四个方位的封印没有完全解除，我们不能贸然接触这棵银杉树，恐怕会引起不好的结果。\r\n{eval(v(u.remove_cathaya_1)==1?&quot;●&quot;:&quot;〇&quot;)}北区封印：{eval(v(u.remove_cathaya_1)==1?&quot;已解除&quot;:&quot;未解除&quot;)}| {eval(v(u.remove_cathaya_2)==1?&quot;●&quot;:&quot;〇&quot;)}南区封印：{eval(v(u.remove_cathaya_2)==1?&quot;已解除&quot;:&quot;未解除&quot;)}\r\n{eval(v(u.remove_cathaya_3)==1?&quot;●&quot;:&quot;〇&quot;)}西区封印：{eval(v(u.remove_cathaya_3)==1?&quot;已解除&quot;:&quot;未解除&quot;)}| {eval(v(u.remove_cathaya_4)==1?&quot;●&quot;:&quot;〇&quot;)}东区封印：{eval(v(u.remove_cathaya_4)==1?&quot;已解除&quot;:&quot;未解除&quot;)}', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('136', 136, '{\"u.touch_cathaya\":\"{c.date}\"}', '{\"u.exp\":\"5000\"}', NULL, NULL, NULL, '{\"130\":\"1\"}', NULL, NULL, NULL, '{u.touch_cathaya}!={c.date}', '', '你抚摸了这棵银杉树，它向你投射了自己的善意。', '银杉树似乎还在休息，明天再来吧!', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('137', 137, '{\"u.remove_cathaya_1\":\"1\"}', NULL, NULL, NULL, NULL, '{\"18\":\"-10\",\"11\":\"-3\",\"94\":\"-2\"}', NULL, NULL, NULL, '{u.ic.i18}>=10&&{u.ic.i11}>=3&&{u.ic.i94}>=2', '', '「km」认真地将一块块电池，电路板，秘银等材料安稳地放入卡槽口，没过几秒，你发现上面的电路信号不知不觉消失不见了。\r\n「km」摆了摆手，打住，别问我原理，现在没有那么多时间，不过这是一项来自「未来城」的科技，以后有机会会遇到的。', '「km」仔细地摆弄了一下开关，看了看上面凹凸不平的模样，随手摆动了下手中的便捷终端机#希望镇重要物品|item001_mobileterminal#\r\n沉声说道：这是一个逆序关停设施，里面的原理啥的我就不讲了，经过我的破译，简单来说，我们需要找到装入卡槽的大约10块废旧六号电池，3块旧电路板以及2块秘银。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('139', 139, '{\"u.remove_cathaya_4\":\"1\"}', NULL, NULL, NULL, NULL, '{\"150\":\"-8\"}', NULL, NULL, NULL, '{u.ic.i150}>=8', '', '只见「赫米特」将8滴变异毒蛙的毒液均匀滴落在地上的绿色圆盘上，毒液迅速诡异地消失了，随后绿色圆盘的绿光变得黯淡无比，直至消失。\r\n「km」：这些变异毒蛙怪恶心人的。', '「赫米特」：「冬堡学院」的初学者封印阵盘怎么会在这?呕～(对不起，我想起不好的回忆了)\r\n「赛娜」：冬堡学院?不是被希望联邦覆灭了吗，你怎么会知道这事?\r\n「赫米特」：我曾是里面的初级学徒，导师很喜欢我，但我不争气，没有天赋，被学院劝退了，成了一名猎人，这个初级封印阵盘就是新入学的课程，绿色的是变态发育的回响，采用的是赫姆兹克山的落青石铭刻的，激活需要捣烂的蝌蚪泥，封印要蛙类的体液，当时课堂上吐了很多人。\r\n「km」：那这个阵盘大约要多少?\r\n「赫米特」：这个大小的，8滴左右差不多了。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('140', 140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「赛娜」：西区这个封印看起来像一个智能终端。\r\n☝🤓好好学智能终端为您服务，请输入问题答案解锁！\r\nQ：1+2+3+...+10=?', '', 1, NULL, 'answer|请输入你的答案|1|3', 0, '', '', '', '', NULL, NULL, ''),
('140', 141, '{\"u.remove_cathaya_3\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.value}==55', '', '恭喜你，回答正确，☝🤓好好学智能终端已为你解锁。\r\n「km」：这么弱智的问题都谁放的...', '恭喜你，回答错误，☝🤓好好学智能终端正在怀疑您的智力。\r\n「km」：这么弱智的问题...', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('141', 142, '{\"u.remove_cathaya_2\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.gj}>=300', '', '直接你将双手摸准石块边缘的凸起部分，锁紧位置，然后使出浑身力气，石块大约有些松动，过了好一会，才完全移开，而后化作一股精纯的能量消失了。\r\n「km」：有点意思。', '南区的封印是一个被特殊的能量石块压住的机关。\r\n「赛西」：麻烦了，南区的封印啥取巧都没有，只能以蛮力破之，我们中谁有这力气?按照「人类进化基金会」研究的具现数值，这至少需要300的力量。\r\n「赫米特」：为什么不能一起?\r\n「赛娜」：不行，这是，特制的能量石块，多一个人就要翻倍的压力。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('142', 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「瓦尔金」：嘿，{u.name}，这段时间你在旧街的所作所为可是广为人知，我也是很久想要认识你了。\r\n{u.name}：很荣幸认识你，「瓦尔金」先生。\r\n「瓦尔金」：还是娃儿有礼貌，不像他们只会喊我那个铁匠，简直就是一帮粗鄙村夫！\r\n{u.name}：大伙也没啥恶意哈，可能觉得这样子直接爽快。\r\n「瓦尔金」：行了别替他们说话了，看你顺眼，我这边有个研究项目想不想参与?\r\n{u.name}：是什么?\r\n「瓦尔金」：我有一种制作秘银的秘方。\r\n{u.name}：铁，「瓦尔金」先生，您真厉害。\r\n「瓦尔金」似乎很受用：这种方法需要铜矿:锡矿:变异黑土=3:4:5，再加以长时间锻烧，似乎能得到一块完整的秘银。\r\n{u.name}：我马上帮您准备材料。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('143', 144, NULL, '{\"u.exp\":\"3000\",\"u.money\":\"1000\"}', NULL, NULL, NULL, '{\"39\":\"-3\",\"40\":\"-4\",\"25\":\"-5\",\"75\":\"1\",\"155\":\"1\"}', NULL, NULL, NULL, '', '', '你将材料交给了「瓦尔金」。\r\n只见「瓦尔金」将材料悉数放进锻炉中，炉火烧得很旺。\r\n「瓦尔金」：行了，最终还是要看结果，不过有预感应该不会差，有了这一次的经验，接下去我应该能进一步降低材料需求量，作为回报，你可以随时找我制作秘银，不过每天只能给你一次，这玩意太费燃料了，另外，这两个小东西给你当作谢礼，一个是一种可以镶嵌在武器上的宝石，能增强武器效果，另一个是我年轻时候游历所得，研究半生未果，赠与你了希望能与你有缘。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('144', 145, '{\"u.exchange_mithril\":\"{c.date}\"}', NULL, NULL, NULL, NULL, '{\"39\":\"-2\",\"40\":\"-2\",\"25\":\"-4\",\"94\":\"1\"}', NULL, NULL, NULL, '{u.ic.i39}>=2&&{u.ic.i40}>=2&&{u.ic.i25}>=4', '', '你将2块铜矿，2块锡矿，4块变异黑土交给了「瓦尔金」。只见「瓦尔金」直接拿出一块锡矿递给了你。\r\n「瓦尔金」：这是上次烧的，给你了。', '「瓦尔金」：小娃，想要秘银就拿铜矿，锡矿和变异黑土来，比例2:2:4。', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('145', 146, NULL, '{\"u.exp\":\"10000\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你将变异银杉树的汁液交给了马修。\r\n「马修」：oh，干得不错，这下我们就能解开那道转译锁了，具体的研究细节到时候你们去问下轻工厂那边的碧翠丝，凌影那边有事找我，我整理一下资料得先去找他了，后面的事你们和碧翠丝对接就行了，我都安排好了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('146', 147, NULL, NULL, NULL, NULL, NULL, '{\"154\":\"1\"}', NULL, NULL, NULL, '', '', '「碧翠丝」：你们来了，长话短说，我们直接进正题吧。\r\n「KM」：到底是怎么一回事?\r\n「碧翠丝」：就我们目前拿到的破译结果来看，基本可以确定和「厄加帝国」脱离不了关系了。\r\n「赛西」默默攥紧了拳头。\r\n「赫米特」察觉到了她的异样。\r\n「赫米特」：我们该怎么做?\r\n「碧翠丝」：密码子串提到了一处叫「去时彼岸」的地方，我们毫无头绪，不过我想有一个人或许会知道。\r\n「众人」：是谁?\r\n「碧翠丝」：他叫「守时」，是一个天才科学家，上一次听说他的消息是两年前我去「未来城」进修「生命科学」的时候了，我想，你们有必要去一趟了，可以先去那边的「地上天堂」酒吧找一个叫「蒂娜」的服务员问下情况，我当年勤工俭学时候认识的朋友，她左眼是蓝色的右眼是红色的，很好认。要不是后面的...唉算了，总之，你们得去一趟了。\r\n「{u.name}」：等等，那我们怎么去呢?\r\n「碧翠丝」：我已经和驿站那边车队打过招呼了，他们最近刚好会去一趟「未来城」，你们可以跟着一起去。\r\n对了，想进入「未来城」得有身份验证芯片，我这个是中级的芯片，可以把你们几个也带进去，你们拿好了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('147', 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '两三天过去了，车队到达了「未来城」外的恶土。', '', 1, '497', NULL, 0, '', '', '', '', NULL, NULL, ''),
('149', 149, NULL, '{\"u.money\":\"-500\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '经过了两三天的时间，你跟着他们到达了「希望镇」。', '', 1, '318', NULL, 0, '', '', '', '', NULL, NULL, ''),
('151', 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '盥洗室的水龙头需要支付未来币，更不幸的是，它正在维修，你只好对着镜子搓了搓满是泥灰的脸，虽然是一个{e.player_sex}，可实在是没什么形象可言。', '', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, ''),
('152', 152, NULL, '{\"u.money2\":\"-100\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '旅行商队队长收下了你的未来币，然后取出了其中一枚，置于一个神奇的六边形设备之中，紧接着你发现一架巨大的浮空车升起，你赶紧进去，空中灰雾弥漫，不知过了多久，你到达了一个灰蒙蒙的地方。', '', 1, '266', NULL, 0, '', '', '', '', NULL, NULL, ''),
('153', 153, NULL, '{\"u.money2\":\"300\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们一行人来到了关口检查站。\r\n「KM」：熟悉的地点熟悉的关口啊。\r\n「赫米特」：行了，没时间给你怀念了，「黑网首席」·凯蒙先生。\r\n「陌生的声音」：哦?外来的面孔?\r\n「赛西」：你是?\r\n「陌生的声音」：我是皇后街区的治安官，云骁。你们来未来城有什么事?\r\n「赫米特」：我们受人所托，得去见一个人，他叫「守时」。这是我们的通行证(说完递过去一张颇有质感的名片)\r\n「云骁」熟练地将其划过自身改造的卡槽口：嗯?虚幻教派的学生?「碧翠丝」，面容验证中。。等等，你们中好像没有和「碧翠丝」相匹配的面容，按规定不能让你们进城?\r\n「赫米特」：啥时候改的规定，「碧翠丝」没交代过呀。\r\n「云骁」：最近未来城发生了很多事，总之，很多新的规定陆陆续续被添加了。\r\n「赛西」：我们真的需要和「守时」见一面，我们不是坏人。\r\n「云骁」：未来城没有好人和坏人，只有强人和弱人。不过，放你们进去也不是不可以，这样吧，你们去「黑雾城」帮我搞瓶那边的佳酿过来，我就睁一只眼闭一眼，怎么样?\r\n只见「KM」刚想做什么，就被旁边的「赫米特」压下了。\r\n「赫米特」：行，我们答应你。\r\n「云骁」：这是来往路费和酒钱，去外面驿站找那商队老鬼带就行了，包船来回200未来币。', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('154', 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.tasks.t24}!=2', '你前脚刚踏入，后脚便响起警报。\r\n警报：入侵者，危险级别：黑铁\r\n「云骁」：。。。别闹了，赶紧去帮我搞酒来，下一次我可不能保证这些自动化步枪会听我的话。', '', 1, '243', NULL, 0, '', '', '', '', NULL, NULL, ''),
('155', 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.money2}>=100', '', '庞大的机械船不断运转，直到浮空后，你才走进了其中。沿途中，你感受到周遭的黑雾，仿佛有什么东西就要从中窜出......一路上有惊无险，到达了未来城。', '你想启动这台机械船，却发现没有100个未来币激活，机械船没有动力。', 1, '497', NULL, 0, '', '', '', '', NULL, NULL, ''),
('156', 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '此碑沟壑纵横，颜色灰青，上面写着：\r\n〝继承开拓者们的意志，立城于黑雾之中。〞\r\n〝天灾不可避免地到来了，破晓的诅咒诞生了。〞\r\n〝人类是被圈养的困兽，英雄是困兽的王者。〞\r\n〝接受。〞', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('157', 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你沿着一条小路走了进去，没过多久便来到了一处繁华的地带。', '', 1, '731', NULL, 0, '', '', '', '', NULL, NULL, ''),
('158', 158, NULL, NULL, NULL, NULL, NULL, '{\"138\":\"-1\"}', NULL, NULL, NULL, '', '', '你将一瓶黑雾酿递给了「云骁」。\r\n「云骁」打开了黑雾酿闻了闻。\r\n「云骁」：果然是好酒！好！你们真是雷厉风行啊！\r\n「赫米特」：既已如此，那你该放我们进城了吧。\r\n「云骁」：哈哈哈，请进。(云骁拍了拍手，突然空气中飘来一阵烟雾)\r\n「KM」：不好，是迷魂...(还没说完，四人便被迷晕了过去)\r\n(看好他们)\r\n...', '', 0, '734', NULL, 0, '', '', '', '', NULL, NULL, ''),
('160', 159, '{\"u.open_future_prison_307\":\"1\"}', NULL, NULL, NULL, NULL, '{\"155\":\"-1\",\"158\":\"1\"}', NULL, NULL, NULL, '', '', '你揉了揉双眼，一股酸涩胀痛的感觉传来，让你忍不住抱紧头。\r\n你扫视了一周，发现了仍然昏迷不醒的KM三人。\r\n你上去推了推他们，众人也慢慢醒了过来。\r\n「赫米特」：该死，我们被摆了一道。\r\n「KM」：赛西，这边你能用魔法吗，我感觉自己的赛博芯片程序受到了干扰。\r\n「赛西」尝试了一下，失败了。\r\n「赫米特」：没用的，你们手上戴的是「绝禁手环」，这种是秘银-镀镍合金，会自动扰乱一切秩序能量。\r\n「KM」：那我们怎么办，这手环能拿下来吗?\r\n「赫米特」：我以前上魔器课的时候好像听过，「绝禁手环」一经戴上很难解除，除非是用魔纹石，而且得至少高级品质的魔纹石，才能消解其上的刻印。\r\n「赛西」：高级魔纹石?疯了吧，这东西有价无市的。而且一般情况下都和普通石头没两样，得用ⓚ催化剂才能激活的。还有，我们身上的储物介质都被收走了。\r\n「KM」：看来我还是想想能不能用泥土搓一套全新的非硅计算机架构了。\r\n看着垂头丧气的众人，你突然想到之前瓦尔金给你的一块奇怪的石头，你将它从衣服夹层里拿了出来。\r\n「赛西」：这是?(赛西迅速夺过你手中的石头，并搓了搓手背的泥灰然后慢慢碾碎撒向石头)\r\n「赛西」：还好以前做实验太忙手上沾满了催化剂的残液，运气不错，ⓚ催化剂发挥作用了。\r\n只见原本毫不起眼的石头慢慢褪去表层的杂质，最后竟然变成了一颗散发着神秘紫蓝色的十六边体。\r\n「赛西」二话不说将其递给了「赫米特」，后者心领神会，默念了几句奇怪的咒语，而后这块魔纹石散发出一阵耀眼的白光，众人感觉身上的枷锁被解除了。\r\n「赛西」将高级魔纹石丢还给你：好了，一块魔纹石可以反复使用很多次，其中能量会自动汲取虚空进行回复。\r\n「KM」：接下来就看我的吧。\r\n只见KM的双眼之中浮现了许多0-1数字，不断滚动，而后面前的这道非对成加密锁便被解开了。\r\n「KM」：走吧。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('161', 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.open_future_prison_307}==0', '非对称的密码门像一道无情的屏障，牢牢挡住了你们的去路。', '', 1, '734', NULL, 0, '', '', '', '', NULL, NULL, ''),
('162', 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '743', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('163', 162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '742', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('164', 163, '{\"u.open_future_prison\":\"2\"}', NULL, NULL, NULL, NULL, '{\"57\":\"1\"}', NULL, NULL, NULL, '', '', '你发现角落里有张不起眼的字条，你将其捡了起来。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('166', 164, '{\"o.xq_nl\":\"{c.date}\"}', '{\"u.exp\":\"{r.500}*({c.date}+1)*5*{o.count}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你将{o.name}捧起，静静感受其中的能量波动，一股精纯的能量进入了你的身体。', '', 0, NULL, NULL, 0, '', 'items', '', '', NULL, NULL, ''),
('167', 165, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, '{o.env.nowmid}', NULL, 0, '', '', '', '', NULL, NULL, ''),
('168', 166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你沿着一部楼梯走了上去，这楼梯像是直接挖成形状再灌上合金材料制成。', '', 1, '750', NULL, 0, '', '', '', '', NULL, NULL, ''),
('169', 167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你从楼梯走下了二层。', '', 1, '747', NULL, 0, '', '', '', '', NULL, NULL, ''),
('170', 168, NULL, NULL, NULL, NULL, NULL, '{\"161\":\"1\"}', NULL, NULL, NULL, '', '', '你在杂乱无章的地上的一堆废弃实验材料堆发现一张闪闪发光的卡片，你将其捡起。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('171', 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, NULL, 0, '', 'ct_future_prison', '', '', NULL, NULL, ''),
('172', 170, '{\"u.open_future_prison\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.modify_future_card}==1', '你将修改好的身份卡放入识别区域，全息投影出熟悉的密码界面，你将K.M伪造的密码输入：\r\n@red@您好@end@，操作员：@pink@P.M@end@\r\n请输入您的操作密码：@red@abc123@end@\r\n@grey@身份正在验证...@end@\r\n@green@验证成功!@end@\r\n随着一声清脆的响声，大门缓缓地打开了，久违的一束光线射了进来。', '', 0, NULL, NULL, 0, '', 'ct_future_prison', '', '', NULL, NULL, ''),
('172', 171, '{\"u.modify_future_card\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.modify_future_card}==0', '你将身份卡放入识别区域，全息投影出了一个密码界面：\r\n@red@您好@end@，操作员：@pink@卡尔.森维@end@\r\n请输入您的操作密码：\r\n你顿时陷入困境，望向了一旁的K.M。\r\nK.M：这还不简单，身份卡给我下。\r\n你把身份卡交给了K.M，只见他轻轻扫过腕表，而后在虚空中一串乱码滚动下键入一些什么东西，没过多久他就把身份卡还给你了。\r\nK.M：密码是abc123', '', 0, NULL, NULL, 0, '', 'ct_future_prison', '', '', NULL, NULL, ''),
('173', 172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.open_future_prison}==0', '大门还没打开，挡住了你的去路。', '', 1, '755', NULL, 0, '', '', '', '', NULL, NULL, ''),
('174', 173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你离开了「地上天堂」。', '', 1, '676', NULL, 0, '', '', '', '', NULL, NULL, ''),
('175', 174, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{c.hour}>15||{c.hour}<4', '', '你进入了「地上天堂」。', '似乎还没有开门。', 1, '760', NULL, 0, '', '', '', '', NULL, NULL, ''),
('176', 175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '23', NULL, '', '', '粉紫的闪动的霓虹灯，摇晃的酒杯，纵欲的人群，你们走向了一名身着女仆装的女人，左眼是蓝瞳右眼是红瞳。\r\n「KM」：看来这就是我们要找的，哦，「蒂娜」了。\r\n「蒂娜」停下了手中的动作，抬起头：你们是?\r\n你：我们有要事需要找到「守时」先生，是「碧翠丝」小姐让我们联系你的，说你能帮我们引荐。\r\n「蒂娜」：这样子嘛，看来你们是第一次来「未来城」吧，这里有一条规矩：凡事都是有代价的。看在「碧翠丝」的份上，我就免费赠送你们「守时」的消息，不过我需要你们帮我做一件事。\r\n你：什么?\r\n「蒂娜」：我上周去皇后街那边不小心把我的手帕落在那边的一家烧烤摊了，是靠近东街那边的一家，叫，呃，「铁牛烧烤」，对，是这个名字，我当时还吐槽了好一会，你们帮我找回来，是一条粉色的，对。\r\n「KM」：oh，我的老天啊，这叫什么免费。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('177', 176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你们一行人来到皇后街东的一处小吃摊。\r\n「{o.name}」：要来点什么?\r\n「赫米特」：我们来找一张手帕，是一个左眼蓝瞳右眼红瞳的女人遗失的。\r\n「{o.name}」：oh，她的那双眼令人印象深刻，确实是有这么一张手帕，不过好像被秃鹰帮的二狗拿走了。\r\n「你」：唉，这...\r\n「{o.name}」：我只能说，秃鹰帮的领地在北野垃圾场那一带。\r\n「你」：谢谢你的消息啦~', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('138', 177, '', '{\"u.zxsj\":\"3\"}', NULL, '', NULL, '', NULL, NULL, NULL, '', '', '你好', '再见', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, ''),
('178', 178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, '', '', '「秃鹰帮守卫」：谁?\r\n「赛西」：不要在小人物身上浪费太多时间。\r\n「赫米特」：要不直接打晕吧。\r\n「km」：我觉得给他们植入下赛博病毒让他们瘫痪更快。\r\n「秃鹰帮守卫」瑟瑟发抖：各位好汉，我们也就是拿死工资的打工人，您要进去我们马上开门，直到明天我们都不会出现在这里，您看可以吗?\r\n「你」：我们要找二狗。\r\n「秃鹰帮守卫」：二麻子是吧，您进去以后一直走到尽头左边走廊第一间进去就是了，他应该在那赌钱呢。\r\n「你」：算你们上道。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('179', 179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '774', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('180', 180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, '', '', '你们一进去这间屋子，就能闻到一股刺鼻的烟草味以及混杂着的什么汗臭味，一个粗犷的中年男子正躺在一张靠椅上呼呼大睡，旁边是一台凌乱的麻将。\r\n「张三」猛地惊醒：你们是谁?\r\n「你」：你是不是在张铁牛烧烤摊那捡到了一件手帕，还回来吧。\r\n「张三」：嘿嘿，是那张手帕啊，还别说，这些城里女人的东西就是好闻啊。\r\n「你」：那你还不还。\r\n「张三」：不给，就是不给，你能咋地。\r\n「你」：唉，看样子得打一顿了。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('181', 181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '105|1', '', '', '「张三」：既然如此，那便接招吧!', '', 1, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('182', 182, NULL, '{\"u.exp\":\"10000\"}', NULL, NULL, NULL, '{\"162\":\"1\"}', NULL, NULL, NULL, '', '', '「张三」：行了行了，大侠饶命，是小人有眼不识泰山，这就将东西还你。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('183', 183, NULL, '{\"u.exp\":\"5000\"}', NULL, NULL, NULL, '{\"162\":\"-1\"}', NULL, NULL, NULL, '', '', '你将蒂娜的手帕递给了对方。\r\n「蒂娜」拿起来闻了闻：奇怪，怎么有股奇怪的味道。\r\n「你」：也许是烧烤摊的气味，你知道的，烟火气。\r\n蒂娜半信半疑。\r\n「km」：好了，小妞，该履行你的承诺了，那么烦请告诉我们，「守时」在哪?\r\n「蒂娜」：急性子的男人，真无趣。「守时」他进了「虚境」。\r\n「你」：这「虚境」是什么地方?\r\n「赛娜」：「虚境」?那些节点不是都崩塌了吗?怎么还能进去。\r\n「蒂娜」：我也不知道，这是我在有此接待的时候无意间听到一位大人物谈到的，那位大人物的名讳恕我保密，总之消息一定是可靠的。\r\n「你」：既然如此，我们该怎么进入这个「虚境」?\r\n「蒂娜」：oh，先生，你可真是难为我了，我只是一个普通的女子。\r\n「赛西」：我们先走吧，这里太吵了，出门我再和你们说说。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('184', 184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「km」：还是外面的空气比较舒服，虽然还是能闻到那股不可避免的臭鸡蛋味。\r\n「赛西」：行了，我先说下「虚境」是什么地方吧。其实，「虚境」就是另一个世界，它和我们的世界并行运转，正常情况下是关闭的，但通过一些特殊手段比如一些空间节点可以进入那个世界，我在求学的时候曾经听老师讲过那个世界，我们这个世界的人进去相当于偷渡，那个世界似乎并不完整。\r\n「你」：「守时」可真能跑，他去那里干什么，我们要如何进入?\r\n「赛西」：在「黑雾城」有一扇「真理之门」，传说是世界意志的一丝投影，我们可以向其询问进入「虚境」的方法。\r\n「km」：既然如此我们快走吧!\r\n「赛西」：那扇「真理之门」上篆刻着一些玄奥的字符，据说只有成功说出字符才能得到其认可。\r\n「km」：管他那么多，去了才知道。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, '');
INSERT INTO `system_event_evs_self` (`belong`, `id`, `s_attrs`, `m_attrs`, `equips`, `a_skills`, `r_skills`, `items`, `a_tasks`, `r_tasks`, `fight_npcs`, `cond`, `exec_cond`, `cmmt`, `cmmt2`, `not_return_link`, `dests`, `inputs`, `just_return`, `view_user_exp`, `page_name`, `refresh_scene_npcs`, `refresh_scene_items`, `a_adopt`, `r_adopt`, `next_text`) VALUES
('185', 185, NULL, NULL, NULL, NULL, NULL, '{\"88\":\"1\"}', NULL, '29', NULL, '', '', '这是你第一次看见「真理之门」，却仿佛早已多年相识，你对这种没来由的熟悉感感到惊讶。\r\n「km」：这就是...「真理之门」吗?太玄妙了，我竟然隐隐感受到至高无上的代码在流动。\r\n「赫米特」：我感受到一股原始的狩猎本能仿佛从我体内觉醒。\r\n「赛西」：看来每个人感受到的东西都不一样，{u.name}，你感受到的是什么。\r\n你没有理会，继续沉浸在其中...\r\n你感到整个身体与灵魂脱轨了，你的灵魂在穿梭在各种维度之间，发出兴奋的赞叹;你感到整个宇宙在向你歌唱...突然，你见到了一些熟悉又陌生的词汇：\r\n御者，多方虛界之主，歸位。\r\n你的灵魂之眼突然瞪得巨大，你发现你能看得懂这些文字，并且似乎早已认识多年了。\r\n你的灵魂与其产生共振，突然「真理之门」一阵震动，将一块令牌送到了你的手上。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('186', 186, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「赛西」：发生什么事了，刚才一直叫你都没反应。\r\n你把那块令牌递给了「赛西」。\r\n「赛西」看着那块令牌一脸惊讶。\r\n「赛西」：这是?「虚界令牌」?我在的一本古魔法日志上见过这个传说，但你怎么会有?\r\n你大致描绘了一下当时的场景。\r\n「赛西」：你是说你能看懂那些古语?难怪，罢了，可能这就是天命吧，这令牌只能你一人用，能将你传送到虚境内，也就是说，接下去，找「守时」的任务得你一个人来了。\r\n「km」：真是令人伤感。\r\n「赫米特」：闭嘴，km。\r\n「赛西」：稍后我会用魔法阵激活令牌上的坐标打开一道跨界门，这门只有被虚界令牌认可的存在能进去，靠你了。我们先回「希望镇」了，这门是永固性质的，除非你用令牌主动关闭，否则它会一直存在。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('187', 187, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, '', '', '无尽的呢喃...呓语向你袭来，你的精神一阵恍惚。不知道过了多久...', '', 1, '342', NULL, 0, '', '', '', '', NULL, NULL, ''),
('188', 188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '热情好客充满智慧的银月人招呼着你上车，很快这辆急速的轨道车便将你带到了银月城前...', '', 1, '801', NULL, 0, '', '', '', '', NULL, NULL, ''),
('189', 189, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '一辆轨道车很快将你带到了目的地。', '', 1, '789', NULL, 0, '', '', '', '', NULL, NULL, ''),
('190', 190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你登上了一辆观光车，周围的景色逐渐变得模糊，很快便到达了目的地。', '', 1, '820', NULL, 0, '', '', '', '', NULL, NULL, ''),
('191', 191, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '魔晶石为动力的观光车速度飞快且平稳，孜孜不倦载送着一批批旅客来往...', '', 1, '816', NULL, 0, '', '', '', '', NULL, NULL, ''),
('192', 192, '{\"u.vehicle_ck\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_vehicle', '', '', NULL, NULL, ''),
('193', 193, '{\"u.vehicle_ck\":\"2\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_vehicle', '', '', NULL, NULL, ''),
('194', 194, '{\"u.vehicle_ck\":\"3\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_vehicle', '', '', NULL, NULL, ''),
('195', 195, '{\"o.name\":\"{o.name}.你好\"}', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('196', 196, NULL, '{\"u.exp\":\"300\",\"u.money\":\"50\"}', NULL, NULL, NULL, '{\"1\":\"5\"}', NULL, NULL, NULL, '', '', '「莉莉安」看了看满身污垢的你。\r\n「莉莉安」:呦，还不错嘛。\r\n「你」:那肯定的，撒撒水啦。\r\n「莉莉安」:算你合格了，这些奖励就给你了，你接下去去找歌尔特吧，他会告诉你接下来做什么。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('197', 197, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '「莱兹.恩」：我骑着骆驼四处流浪，心中满是忧愁，\r\n我倒了倒见底的椰子酒，骆驼却悄然而走，如今的我无处可求。\r\n你看见一个浑身邋遢的男子囔囔着什么，一个散发着浓烈酒味的布袋不时滴落着。\r\n「你」：请问?有什么可以帮你的吗?(你来不及惊叹自己为何会银月语)\r\n「莱兹.恩」抬了抬头：异端的小老鼠，哈哈哈，你也来嘲笑我吗?\r\n「你」：不不不，我没有恶意。\r\n随即你想了想：时光，收集人类的泪水，将它蓄满风的谷仓。\r\n「莱兹.恩」：时光...泪水...谷仓...哈哈哈我的王...\r\n你看着他陷入了颠狂，想着要不先走，突然他却拉住了你。\r\n「莱兹.恩」：异乡人，同是天涯沦落人，谢你刚才的言语。\r\n「你」：人生在世皆为友。\r\n「莱兹.恩」：好!我的朋友，请给我一瓶慷慨的「烈焰风暴」，我会同样慷慨地给你一些祝福与回报的。', '', 0, NULL, NULL, 0, '', '', '', '', NULL, NULL, ''),
('75', 198, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{u.qd_daily}=={c.date}', '今日已签到。', '', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, '返回签到'),
('75', 199, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 0, '', 'ct_test', '', '', NULL, NULL, ''),
('199', 200, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '测试违禁词(目前已有：{g.test_name})', '', 1, NULL, 'test_wjc|违禁词|0|100', 0, '', '', '', '', NULL, NULL, ''),
('200', 201, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, 'add_ele|加什么|0|10', 0, '', '', '', '', NULL, NULL, '加入'),
('199', 202, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{inarr(v(u.input.test_wjc),v(g.test_name))}==1', '你输入的文本里含有违禁词哦！', '', 1, NULL, NULL, 0, '', 'ct_szcs', '', '', NULL, NULL, ''),
('199', 203, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '{inarr(v(u.input.test_wjc),v(g.test_name))}==0', '很好，你是一个文明的小可爱！', '', 1, NULL, NULL, 0, '', 'ct_szcs', '', '', NULL, NULL, ''),
('201', 204, NULL, '{\"o.hp\":\"-1000\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '继续'),
('200', 206, '{\"pusharr.(g.test_name)\":\"{u.input.add_ele}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.add_ele}!=\"\"', '', '添加成功！', '输入不能为空！', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, '继续'),
('203', 207, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 0, NULL, 'del_pos|移除第几个？（从1开始）|1|10', 0, '', '', '', '', NULL, NULL, '确认移除'),
('203', 208, '{\"delarr.(g.test_name)\":\"{u.input.del_pos}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{u.input.del_pos}!=\"\"', '', '已经移除第{u.input.del_pos}的元素！', '输入有误！', 1, NULL, NULL, 1, '', 'ct_szcs', '', '', NULL, NULL, '继续'),
('204', 209, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '你输入了：{u.input.test1}！\r\n你输入了：{u.input.test2}！', '', 0, NULL, NULL, 1, '', '', '', '', NULL, NULL, '继续'),
('205', 210, '{\"u.g_msg\":\"{u.input.ltmsg}\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '发送成功！', '', 1, NULL, NULL, 0, '', 'chat', '', '', NULL, NULL, '继续'),
('206', 211, '{\"o.no_give\":\"1\",\"o.embed_count\":\"10\"}', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '成功绑定。', '', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, '继续'),
('207', 212, '', '', NULL, '6', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, '继续'),
('210', 214, '{\"o.no_give\":\"0\"}', '{\"o.wg_fj\":\"-1\",\"o.added_mg\":\"-1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '成功解绑。', '', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, '继续'),
('211', 215, NULL, '{\"u.icc.v(u.input.id)\":\"{u.input.sl}\",\"u.icc.2\":\"10\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, NULL, NULL, 1, '', '', '', '', NULL, NULL, '继续'),
('212', 216, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '继续'),
('213', 217, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '继续'),
('214', 218, NULL, '{\"u.money\":\"1\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '继续');

-- --------------------------------------------------------

--
-- 表的结构 `system_event_react`
--

CREATE TABLE `system_event_react` (
  `event_id` int(11) NOT NULL COMMENT '事件触发id',
  `event_u` varchar(255) NOT NULL COMMENT '事件触发人',
  `event_o` varchar(255) NOT NULL COMMENT '事件被触发人',
  `event_type` int(1) NOT NULL COMMENT '0为玩家事件，1为npc事件，2为物品事件，3为场景事件，4为系统事件',
  `event_state` int(1) NOT NULL COMMENT '事件完成情况'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('31', '1', 0, 1, '', '', '72', '数组\r\n'),
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
('2', 'npc_task_accept', 0, 19, '', '', '23,24', '[急切的交易]的接受'),
('2', 'npc_task_finish', 0, 20, '', '', '25', '[急切的交易]的完成'),
('3', 'npc_task_accept', 0, 22, '', '', '27', '[莉莉安的书信]的接受'),
('11', 'map_op', 0, 24, '', '', '29,30', '爬出暗道'),
('12', 'map_op', 0, 25, '', '', '31', '断桥'),
('13', 'map_op', 0, 26, '', '', '32', '损坏的通讯机'),
('14', 'map_op', 0, 27, '', '', '33,37', '进入希望镇'),
('15', 'map_op', 0, 28, '', '', '34', '人型雕像'),
('16', 'map_op', 0, 29, '', '', '35', '出门'),
('17', 'map_op', 0, 30, '', '', '36', '打随机不同数木桩'),
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
('2', 'game_self_page_test', 0, 75, '', '', '198,73,199', '签到\r\n'),
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
('12', '7', 0, 98, '', '', '97', '次元载具\r\n'),
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
('18', 'npc_win', 0, 123, '', '', NULL, '泥泞元素怪战胜'),
('37', 'npc_pet', 0, 125, '', '', '126', '变异黑耗子被收养'),
('39', 'map_op', 0, 126, '', '', '127', '字符串连接测试'),
('18', 'npc_task_finish', 0, 127, '', '', '128', '[希望镇的困境]的完成'),
('8', 'npc_op', 0, 128, '{u.hp}<{u.maxhp}', '「{o.name}」：{u.name}是吧?去去去，别捣乱！', '129', '治疗'),
('20', 'npc_task_accept', 0, 129, '', '', '130,131', '[奇怪的印记]的接受'),
('21', 'npc_task_accept', 0, 130, '', '', '132', '[进入沼泽地]的接受'),
('40', 'map_op', 0, 131, '', '', '133', '进入沼泽地'),
('9', 'npc_op', 0, 133, '', '', NULL, '解除封印'),
('9', 'npc_op', 0, 134, '', '', NULL, '解除封印'),
('9', 'npc_op', 0, 135, '', '', '135', '解除封印'),
('10', 'npc_op', 0, 136, '{u.touch_cathaya}!={c.date}', '银杉树似乎还在休息，明天再来吧!', '136', '抚摸银杉树'),
('41', 'map_op', 0, 137, '', '', '137', '解除北区封印'),
('42', 'map_op', 0, 138, '', '', '177', '在线时间'),
('43', 'map_op', 0, 139, '', '', '139', '解除东区封印'),
('45', 'map_op', 0, 140, '', '', '140,141', '解除西区封印'),
('44', 'map_op', 0, 141, '', '', '142', '解除南区封印'),
('22', 'npc_task_accept', 0, 142, '', '', '143', '[瓦尔金的研究]的接受'),
('22', 'npc_task_finish', 0, 143, '', '', '144', '[瓦尔金的研究]的完成'),
('11', 'npc_op', 0, 144, '{u.exchange_mithril}!={c.date}', '「瓦尔金」：哼，小娃子，今天安排已经满了，明天再来看看吧!', '145', '换取秘银'),
('20', 'npc_task_finish', 0, 145, '', '', '146', '[奇怪的印记]的完成'),
('23', 'npc_task_accept', 0, 146, '', '', '147', '[神秘的代码]的接受'),
('46', 'map_op', 0, 147, '', '', '148', '@red@!@end@跟随去未来城的车队'),
('47', 'map_op', 0, 149, '{u.money}>=500', '「流浪商人」伸出了五个手指，并摇了摇头对你的穷酸样表达了鄙视。', '149', '@red@!@end@去希望镇'),
('274', 'map_out', 0, 150, '', '', '', 'GM工作室离开'),
('48', 'map_op', 0, 151, '', '', '151', '查看镜子'),
('49', 'map_op', 0, 152, '{u.money2}>=100', '旅行商队的负责人鄙夷地看了看你，去黑雾城要的是未来币，100个，没有就一边去。', '152', '@red@!@end@去黑雾城'),
('24', 'npc_task_accept', 0, 153, '', '', '153', '[灰色交易]的接受'),
('244', 'map_into', 0, 154, '', '', '154', '八车大道进入'),
('50', 'map_op', 0, 155, '{u.ic.i138}>=1||{u.tasks.t24}==2', '你想了想还是先找到云骁要的酒再说吧。', '155', '@red@!@end@去未来城'),
('51', 'map_op', 0, 156, '', '', '156', '黑雾界碑'),
('52', 'map_op', 0, 157, '', '', '157', '＜-进入交易市场'),
('24', 'npc_task_finish', 0, 158, '', '', '158', '[灰色交易]的完成'),
('23', 'npc_task_finish', 0, 159, '', '', NULL, '[神秘的代码]的完成'),
('53', 'map_op', 0, 160, '', '', '159', '@red@!@end@叫醒三人'),
('734', 'map_out', 0, 161, '', '', '160', '绝望囚牢三层307房离开'),
('54', 'map_op', 0, 162, '', '', '161', '进入电梯(去二层)'),
('55', 'map_op', 0, 163, '', '', '162', '进入电梯(去三层)'),
('56', 'map_op', 0, 164, '', '', '163', '拿起神秘字条'),
('', '5', 0, 165, '', '', NULL, ''),
('1', 'item_op', 0, 166, '{o.xq_nl}!={c.date}', '你慢慢感受其中的能量，却无半点波动(请明日再来)。', '164', '吸取能量'),
('13', '5', 0, 167, '', '', '165', '传送到对方位置\r\n'),
('57', 'map_op', 0, 168, '', '', '166', '从楼梯上去'),
('58', 'map_op', 0, 169, '', '', '167', '从楼梯下去'),
('59', 'map_op', 0, 170, '', '', '168', '奇怪的卡片'),
('60', 'map_op', 0, 171, '', '', '169', '终端验证系统'),
('2', 'game_self_page_future_prison', 0, 172, '', '', '171,170', '放入卡片\r\n'),
('756', 'map_into', 0, 173, '', '', '172', '夜筱路进入'),
('61', 'map_op', 0, 174, '', '', '173', '离开'),
('62', 'map_op', 0, 175, '', '', '174', '进入「地上天堂」'),
('25', 'npc_task_accept', 0, 176, '', '', '175', '[蒂娜的请求]的接受'),
('26', 'npc_task_accept', 0, 177, '', '', '176', '[手帕的下落]的接受'),
('27', 'npc_task_accept', 0, 178, '', '', '178', '[进入秃鹰帮]的接受'),
('63', 'map_op', 0, 179, '', '', '179', '进入北野垃圾场'),
('28', 'npc_task_accept', 0, 180, '', '', '180', '[击败二麻子]的接受'),
('64', 'map_op', 0, 181, '', '', '181', '攻击张三'),
('28', 'npc_task_finish', 0, 182, '', '', '182', '[击败二麻子]的完成'),
('25', 'npc_task_finish', 0, 183, '', '', '183', '[蒂娜的请求]的完成'),
('29', 'npc_task_accept', 0, 184, '', '', '184', '[虚境的秘密]的接受'),
('65', 'map_op', 0, 185, '{u.burthen}<{u.max_burthen}', '呓语：重量...无法背负...', '185', '@red@!@end@查看真理之门'),
('30', 'npc_task_accept', 0, 186, '', '', '186', '[进入虚境]的接受'),
('66', 'map_op', 0, 187, '', '', '187', '踏入虚空之门'),
('67', 'map_op', 0, 188, '', '', '188', '@red@!@end@去银月城'),
('68', 'map_op', 0, 189, '', '', '189', '@red@!@end@前往奇迹港口'),
('69', 'map_op', 0, 190, '', '', '190', '@red@!@end@前往珍珠海滩'),
('70', 'map_op', 0, 191, '', '', '191', '@red@!@end@前往银月南城'),
('4', 'game_self_page_vehicle', 0, 192, '', '', '192', '陆行载具'),
('5', 'game_self_page_vehicle', 0, 193, '', '', '193', '航海载具'),
('6', 'game_self_page_vehicle', 0, 194, '', '', '194', '飞行载具'),
('48', 'npc_creat', 0, 195, '', '', '195', '测试木桩创建'),
('1', 'npc_task_finish', 0, 196, '', '', '196', '[留下的证明]的完成'),
('31', 'npc_task_accept', 0, 197, '', '', '197', '[醉醺醺的酒鬼]的接受'),
('14', '5', 0, 198, '', '', NULL, '设置对方\r\n'),
('2', 'game_self_page_szcs', 0, 199, '', '', '200,202,203', '测试违禁词\r\n'),
('3', 'game_self_page_szcs', 0, 200, '', '', '201,206', '往末尾加元素\r\n'),
('3', 'skill_use', 0, 201, '', '', '204', '撕咬使用'),
('5', 'game_self_page_szcs', 0, 203, '', '', '207,208', '移除第n个元素\r\n'),
('18', '11', 0, 204, '', '', '209', '请输入1：<input name =\"test1\"><br/>请输入2：<input name =\"test2\"><br/><input type =\"submit\">'),
('53', '1', 0, 205, '', '', '210', '请输入聊天信息：<input name =\"ltmsg\"><input type =\"submit\">\r\n<input hidden name =\"ltlx\" value=\"all\">'),
('11', '4', 0, 206, '', '', '211', '物品绑定\r\n'),
('2', 'game_self_page_vvvv', 0, 207, '', '', '212', '学技能\r\n'),
('5', 'game_self_page_item_take_on', 0, 208, '', '', NULL, '@6a5353@生锈的铁剑@end@穿上装备'),
('12', '4', 0, 210, '', '', '214', '物品解绑\r\n'),
('3', 'game_self_page_vvvv', 0, 211, '', '', '215', '请输入：<input name =\"id\">\r\n请输入：<input name =\"sl\">\r\n<input type =\"submit\">'),
('5', 'item_take_on', 0, 212, '', '', '216', '@6a5353@生锈的铁剑@end@穿上装备'),
('5', 'item_take_off', 0, 213, '', '', '217', '@6a5353@生锈的铁剑@end@卸下装备'),
('2', 'skill_default_use', 0, 214, '', '', '218', '技能默认使用');

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
(1, 'damage', 1, '(({u.lvl}*8+{m.lvl}*6+{m.gongji}+({m.hurt_mod}*({m.lvl}+12)/6)+{u.gj}*5+{u.wg_fj})-({o.lvl}+2)*5-{r.o.lvl}*2-{o.fy}*4)*({r.100}<{u.bj}?1.5:1)'),
(4, 'maxexp', 1, '({u.lvl}+1)*({u.lvl}+1)*({u.lvl}+11)+200'),
(5, 'sk_lvl', 1, '(({m.lvl}/3+5)*({m.lvl}+5))*2'),
(6, 'player_sex', 2, '{eval(v(u.sex)==\"男\"?\"小伙子\":\"小姑娘\")}'),
(7, 'time_name', 3, '{eval(v(c.hour)>=0&&v(c.hour)<2?\"凌晨\":(v(c.hour)>=2&&v(c.hour)<4?\"拂晓\":(v(c.hour)>=4&&v(c.hour)<6?\"黎明\":(v(c.hour)>=6&&v(c.hour)<8 ?\"清晨\":(v(c.hour)>=8&&v(c.hour)<11?\"早上\":(v(c.hour)>=11&&v(c.hour)<13?\"中午\":(v(c.hour)>=13&&v(c.hour)<16?\"下午\":(v(c.hour)>=16&&v(c.hour)<18?\"黄昏\":(v(c.hour)>=18&&v(c.hour)<21?\"晚上\":(v(c.hour)>=21&&v(c.hour)<=23?\"子夜\":\"\"))))))))))}'),
(8, 'weather_text', 3, '{eval(v(c.hour)>=0&&v(c.hour)<2?\"闪电撕裂着天空，雷声隆隆地传来。\":(v(c.hour)>=2&&v(c.hour)<4?\"四周一片寂静，几声犬吠从远处传来。\":(v(c.hour)>=4&&v(c.hour)<6?\"月亮在云中忽隐忽现，四周漆黑一片。\":(v(c.hour)>=6&&v(c.hour)<8 ?\"清新的空气令你心旷神怡。\":(v(c.hour)>=8&&v(c.hour)<11?\"微风轻轻地吹拂在你的脸上。\":(v(c.hour)>=11&&v(c.hour)<13?\"一两声闷雷从远处传来。\":(v(c.hour)>=13&&v(c.hour)<16?\"气温下降了，地上的影子越拉越长。\":(v(c.hour)>=16&&v(c.hour)<18?\"天黑了下来，看得见远方炊烟升起。\":(v(c.hour)>=18&&v(c.hour)<21?\"闪电撕裂着天空，雷声隆隆地传来。\":(v(c.hour)>=21&&v(c.hour)<=23?\"风越刮越大了。\":\"\"))))))))))}'),
(9, 'season_text', 3, '{eval(v(c.month)==1?\"早春\":(v(c.month)==2?\"杏春\":(v(c.month)==3?\"晚春\":(v(c.month)==4?\"孟夏\":(v(c.month)==5?\"仲夏\":(v(c.month)==6?\"伏夏\":(v(c.month)==7?\"早秋\":(v(c.month)==8?\"桂秋\":(v(c.month)==9?\"暮秋\":(v(c.month)==10?\"初冬\":(v(c.month)==11?\"寒冬\":(v(c.month)==12?\"隆冬\":\"\"))))))))))))}'),
(10, 'greeting_text', 3, '{eval(v(c.hour)>4&&v(c.hour)<8?\"早上好，新的一天新的开始！\":(v(c.hour)>7&&v(c.hour)<11?\"上午好，不要因为玩游戏而冷落了朋友！\":(v(c.hour)>10&&v(c.hour)<13?\"中午好，吃饭了吗？\":(v(c.hour)>12&&v(c.hour)<19?\"下午好，工作要加油哦！\":(v(c.hour)>18&&v(c.hour)<=23?\"晚上好，不要忽视了与家人的沟通！\":\"夜已深，注意身体哦！早点休息。\")))))}'),
(11, 'player_state', 1, '({u.hp}/{u.maxhp})>=0.75?\"正常，看上去精力充沛。\": (({u.hp}/{u.maxhp})>=0.5&&({u.hp}/{u.maxhp})<0.75?\"正常，看上去略微轻伤。\":(({u.hp}/{u.maxhp})>=0.25&&({u.hp}/{u.maxhp})<0.5?\"受伤，看上去伤势很重。\":\"受伤，看上去奄奄一息\"))'),
(12, 'oplayer_state', 1, '({o.hp}/{o.maxhp})>=0.75?\"正常，看上去精力充沛。\": (({o.hp}/{o.maxhp})>=0.5&&({o.hp}/{o.maxhp})<0.75?\"正常，看上去略微轻伤。\":(({o.hp}/{o.maxhp})>=0.25&&({o.hp}/{o.maxhp})<0.5?\"受伤，看上去伤势很重。\":\"受伤，看上去奄奄一息\"))'),
(13, 'test_calc', 1, '{e.test_1}+{e.test_1}*10'),
(14, 'test_1', 1, '((({u.lvl}*10+{u.gj}*20)+{u.liliang}*2+{u.gongji}+({u.gj1}*100000000))*(({u.gjjc}+100)/100))'),
(15, 'damage2', 1, '{m.hurt_mod}*{u.gj}-{o.fy}'),
(16, 'boss_ltlz_flush', 3, '{eval((v(c.time)-v(g.beat_ltlz)-v(u.fresh_time))>0?\"正在等待雷霆领主重生，还需要v(e.boss_ltlz_flush_time)秒\":\"雷霆领主正在恶狠狠地盯着你\")}'),
(17, 'boss_ltlz_flush_time', 1, '{eval(v(u.fresh_time)-v(c.time)+v(g.beat_ltlz))}'),
(18, 'test_name', 3, '{c.name}');

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
('7c936037baabb3f953d1247ac57fd33d', '1|7', 2),
('7c936037baabb3f953d1247ac57fd33d', '2|99', 3),
('7c936037baabb3f953d1247ac57fd33d', '2|1', 4),
('7c936037baabb3f953d1247ac57fd33d', '1|5', 5),
('7c936037baabb3f953d1247ac57fd33d', '1|8', 6),
('7c936037baabb3f953d1247ac57fd33d', '1|1', 7),
('2be824d1d1eaf47b51176faf90a5b8c9', '1|1', 1),
('2be824d1d1eaf47b51176faf90a5b8c9', '1|7', 2),
('2be824d1d1eaf47b51176faf90a5b8c9', '2|99', 3),
('2be824d1d1eaf47b51176faf90a5b8c9', '2|1', 4),
('2be824d1d1eaf47b51176faf90a5b8c9', '1|5', 5),
('2be824d1d1eaf47b51176faf90a5b8c9', '1|8', 6),
('2be824d1d1eaf47b51176faf90a5b8c9', '1|1', 7),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '1|1', 1),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '1|7', 2),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '2|99', 3),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '2|1', 4),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '1|5', 5),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '1|8', 6),
('f5f8f28ae6c3fb5529d578a31cfcf72d', '1|1', 7),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '1|1', 1),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '1|7', 2),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '2|99', 3),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '2|1', 4),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '1|5', 5),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '1|8', 6),
('a228f3a2d068d3a8cc4506ea8adf9eb4', '1|1', 7),
('8e47713211e401e3719ae2860624ea1d', '1|1', 1),
('8e47713211e401e3719ae2860624ea1d', '1|7', 2),
('8e47713211e401e3719ae2860624ea1d', '2|99', 3),
('8e47713211e401e3719ae2860624ea1d', '2|1', 4),
('8e47713211e401e3719ae2860624ea1d', '1|5', 5),
('8e47713211e401e3719ae2860624ea1d', '1|8', 6),
('8e47713211e401e3719ae2860624ea1d', '1|1', 7),
('3d8568eba8ad03799b060cac7f1c3661', '1|1', 1),
('3d8568eba8ad03799b060cac7f1c3661', '1|7', 2),
('3d8568eba8ad03799b060cac7f1c3661', '2|99', 3),
('3d8568eba8ad03799b060cac7f1c3661', '2|1', 4),
('3d8568eba8ad03799b060cac7f1c3661', '1|5', 5),
('3d8568eba8ad03799b060cac7f1c3661', '1|8', 6),
('3d8568eba8ad03799b060cac7f1c3661', '1|1', 7),
('41400d200be5d46bc95b8573768c3409', '1|1', 1),
('41400d200be5d46bc95b8573768c3409', '1|7', 2),
('41400d200be5d46bc95b8573768c3409', '2|99', 3),
('41400d200be5d46bc95b8573768c3409', '2|1', 4),
('41400d200be5d46bc95b8573768c3409', '1|5', 5),
('41400d200be5d46bc95b8573768c3409', '1|8', 6),
('41400d200be5d46bc95b8573768c3409', '1|1', 7),
('b602cfc31a3e2d6e05a63629d10ab245', '1|1', 1),
('b602cfc31a3e2d6e05a63629d10ab245', '1|7', 2),
('b602cfc31a3e2d6e05a63629d10ab245', '2|99', 3),
('b602cfc31a3e2d6e05a63629d10ab245', '2|1', 4),
('b602cfc31a3e2d6e05a63629d10ab245', '1|5', 5),
('b602cfc31a3e2d6e05a63629d10ab245', '1|8', 6),
('b602cfc31a3e2d6e05a63629d10ab245', '1|1', 7),
('1c9dac0bc157445e9825e43681ef8d05', '1|1', 1),
('1c9dac0bc157445e9825e43681ef8d05', '1|7', 2),
('1c9dac0bc157445e9825e43681ef8d05', '2|99', 3),
('1c9dac0bc157445e9825e43681ef8d05', '2|1', 4),
('1c9dac0bc157445e9825e43681ef8d05', '1|5', 5),
('1c9dac0bc157445e9825e43681ef8d05', '1|8', 6),
('1c9dac0bc157445e9825e43681ef8d05', '1|1', 7),
('01a110059f80eaa13a42841f56fcb21a', '1|1', 1),
('01a110059f80eaa13a42841f56fcb21a', '1|7', 2),
('01a110059f80eaa13a42841f56fcb21a', '2|99', 3),
('01a110059f80eaa13a42841f56fcb21a', '2|1', 4),
('01a110059f80eaa13a42841f56fcb21a', '1|5', 5),
('01a110059f80eaa13a42841f56fcb21a', '1|8', 6),
('01a110059f80eaa13a42841f56fcb21a', '1|1', 7),
('05db3f20ee644be4cd30002f6503b8d9', '1|1', 1),
('05db3f20ee644be4cd30002f6503b8d9', '1|7', 2),
('05db3f20ee644be4cd30002f6503b8d9', '2|99', 3),
('05db3f20ee644be4cd30002f6503b8d9', '2|1', 4),
('05db3f20ee644be4cd30002f6503b8d9', '1|5', 5),
('05db3f20ee644be4cd30002f6503b8d9', '1|8', 6),
('05db3f20ee644be4cd30002f6503b8d9', '1|1', 7),
('bf4f95ce8a8132fe94fd09ed9776c248', '1|1', 1),
('bf4f95ce8a8132fe94fd09ed9776c248', '1|7', 2),
('bf4f95ce8a8132fe94fd09ed9776c248', '2|99', 3),
('bf4f95ce8a8132fe94fd09ed9776c248', '2|1', 4),
('bf4f95ce8a8132fe94fd09ed9776c248', '1|5', 5),
('bf4f95ce8a8132fe94fd09ed9776c248', '1|8', 6),
('bf4f95ce8a8132fe94fd09ed9776c248', '1|1', 7),
('959c9277a3e15eacff9e5f117e51f5bb', '1|1', 1),
('959c9277a3e15eacff9e5f117e51f5bb', '1|7', 2),
('959c9277a3e15eacff9e5f117e51f5bb', '2|99', 3),
('959c9277a3e15eacff9e5f117e51f5bb', '2|1', 4),
('959c9277a3e15eacff9e5f117e51f5bb', '', 5),
('959c9277a3e15eacff9e5f117e51f5bb', '', 6),
('959c9277a3e15eacff9e5f117e51f5bb', '', 7),
('c618319c00c8a0ddfc15fefbe3f4f898', '1|1', 1),
('c618319c00c8a0ddfc15fefbe3f4f898', '1|7', 2),
('c618319c00c8a0ddfc15fefbe3f4f898', '2|99', 3),
('c618319c00c8a0ddfc15fefbe3f4f898', '2|1', 4),
('c618319c00c8a0ddfc15fefbe3f4f898', '1|5', 5),
('c618319c00c8a0ddfc15fefbe3f4f898', '1|8', 6),
('c618319c00c8a0ddfc15fefbe3f4f898', '1|1', 7),
('214658c4375c343e280ae38e880ac4ba', '1|1', 1),
('214658c4375c343e280ae38e880ac4ba', '1|7', 2),
('214658c4375c343e280ae38e880ac4ba', '2|99', 3),
('214658c4375c343e280ae38e880ac4ba', '2|1', 4),
('214658c4375c343e280ae38e880ac4ba', '1|5', 5),
('214658c4375c343e280ae38e880ac4ba', '1|8', 6),
('214658c4375c343e280ae38e880ac4ba', '1|1', 7),
('a8c7b0c51c60be7441214c0b0c671d88', '1|1', 1),
('a8c7b0c51c60be7441214c0b0c671d88', '1|7', 2),
('a8c7b0c51c60be7441214c0b0c671d88', '2|99', 3),
('a8c7b0c51c60be7441214c0b0c671d88', '2|1', 4),
('a8c7b0c51c60be7441214c0b0c671d88', '1|5', 5),
('a8c7b0c51c60be7441214c0b0c671d88', '1|8', 6),
('a8c7b0c51c60be7441214c0b0c671d88', '1|1', 7),
('01a0d4f5e64a677721a1089d4914bc6a', '1|1', 1),
('01a0d4f5e64a677721a1089d4914bc6a', '1|7', 2),
('01a0d4f5e64a677721a1089d4914bc6a', '2|99', 3),
('01a0d4f5e64a677721a1089d4914bc6a', '2|1', 4),
('01a0d4f5e64a677721a1089d4914bc6a', '1|5', 5),
('01a0d4f5e64a677721a1089d4914bc6a', '1|8', 6),
('01a0d4f5e64a677721a1089d4914bc6a', '1|1', 7),
('79462faa70c368423c7f9fb106fa1f47', '1|1', 1),
('79462faa70c368423c7f9fb106fa1f47', '1|7', 2),
('79462faa70c368423c7f9fb106fa1f47', '2|99', 3),
('79462faa70c368423c7f9fb106fa1f47', '2|1', 4),
('79462faa70c368423c7f9fb106fa1f47', '1|5', 5),
('79462faa70c368423c7f9fb106fa1f47', '1|8', 6),
('79462faa70c368423c7f9fb106fa1f47', '1|1', 7),
('945fd26d30e007abfed414cc1f2795f5', '1|1', 1),
('945fd26d30e007abfed414cc1f2795f5', '1|7', 2),
('945fd26d30e007abfed414cc1f2795f5', '2|99', 3),
('945fd26d30e007abfed414cc1f2795f5', '2|1', 4),
('945fd26d30e007abfed414cc1f2795f5', '1|5', 5),
('945fd26d30e007abfed414cc1f2795f5', '1|8', 6),
('945fd26d30e007abfed414cc1f2795f5', '1|1', 7),
('f55913444ef985484baf7580c60f15ce', '1|1', 1),
('f55913444ef985484baf7580c60f15ce', '1|7', 2),
('f55913444ef985484baf7580c60f15ce', '2|99', 3),
('f55913444ef985484baf7580c60f15ce', '2|1', 4),
('f55913444ef985484baf7580c60f15ce', '1|5', 5),
('f55913444ef985484baf7580c60f15ce', '1|8', 6),
('f55913444ef985484baf7580c60f15ce', '1|1', 7),
('fe3319b6dd10f68aaa36ee852cd79cc1', '1|1', 1),
('fe3319b6dd10f68aaa36ee852cd79cc1', '1|7', 2),
('fe3319b6dd10f68aaa36ee852cd79cc1', '2|99', 3),
('fe3319b6dd10f68aaa36ee852cd79cc1', '2|1', 4),
('fe3319b6dd10f68aaa36ee852cd79cc1', '1|5', 5),
('fe3319b6dd10f68aaa36ee852cd79cc1', '1|8', 6),
('fe3319b6dd10f68aaa36ee852cd79cc1', '1|1', 7),
('01acd0637eb2b6a6a3055e4fc37e8457', '1|1', 1),
('01acd0637eb2b6a6a3055e4fc37e8457', '1|7', 2),
('01acd0637eb2b6a6a3055e4fc37e8457', '2|99', 3),
('01acd0637eb2b6a6a3055e4fc37e8457', '2|1', 4),
('01acd0637eb2b6a6a3055e4fc37e8457', '1|5', 5),
('01acd0637eb2b6a6a3055e4fc37e8457', '1|8', 6),
('01acd0637eb2b6a6a3055e4fc37e8457', '1|1', 7),
('2f4746d4d36396302d36e51c969d3e68', '1|1', 1),
('2f4746d4d36396302d36e51c969d3e68', '1|7', 2),
('2f4746d4d36396302d36e51c969d3e68', '2|99', 3),
('2f4746d4d36396302d36e51c969d3e68', '2|1', 4),
('2f4746d4d36396302d36e51c969d3e68', '1|5', 5),
('2f4746d4d36396302d36e51c969d3e68', '1|8', 6),
('2f4746d4d36396302d36e51c969d3e68', '1|1', 7),
('e3130d019f7689f5501bc3633f97eb88', '1|1', 1),
('e3130d019f7689f5501bc3633f97eb88', '1|7', 2),
('e3130d019f7689f5501bc3633f97eb88', '2|99', 3),
('e3130d019f7689f5501bc3633f97eb88', '2|1', 4),
('e3130d019f7689f5501bc3633f97eb88', '1|5', 5),
('e3130d019f7689f5501bc3633f97eb88', '1|8', 6),
('e3130d019f7689f5501bc3633f97eb88', '1|1', 7),
('76623f3a68872fa88502af535498a991', '1|1', 1),
('76623f3a68872fa88502af535498a991', '1|7', 2),
('76623f3a68872fa88502af535498a991', '2|99', 3),
('76623f3a68872fa88502af535498a991', '2|1', 4),
('76623f3a68872fa88502af535498a991', '1|5', 5),
('76623f3a68872fa88502af535498a991', '1|8', 6),
('76623f3a68872fa88502af535498a991', '1|1', 7),
('f244e629c0bc88068f2ecd6baf212683', '1|1', 1),
('f244e629c0bc88068f2ecd6baf212683', '1|7', 2),
('f244e629c0bc88068f2ecd6baf212683', '2|99', 3),
('f244e629c0bc88068f2ecd6baf212683', '2|1', 4),
('f244e629c0bc88068f2ecd6baf212683', '1|5', 5),
('f244e629c0bc88068f2ecd6baf212683', '1|8', 6),
('f244e629c0bc88068f2ecd6baf212683', '1|1', 7),
('f4cd01caaf9ec17c03413de91b97b5f2', '1|1', 1),
('f4cd01caaf9ec17c03413de91b97b5f2', '1|7', 2),
('f4cd01caaf9ec17c03413de91b97b5f2', '2|99', 3),
('f4cd01caaf9ec17c03413de91b97b5f2', '2|1', 4),
('f4cd01caaf9ec17c03413de91b97b5f2', '1|5', 5),
('f4cd01caaf9ec17c03413de91b97b5f2', '1|8', 6),
('f4cd01caaf9ec17c03413de91b97b5f2', '1|1', 7),
('344773e829d514e37d748e906a4f020a', '1|1', 1),
('344773e829d514e37d748e906a4f020a', '1|7', 2),
('344773e829d514e37d748e906a4f020a', '2|99', 3),
('344773e829d514e37d748e906a4f020a', '2|1', 4),
('344773e829d514e37d748e906a4f020a', '1|5', 5),
('344773e829d514e37d748e906a4f020a', '1|8', 6),
('344773e829d514e37d748e906a4f020a', '1|1', 7),
('98c50608a11ec800fba8b2d0b7294aeb', '1|1', 1),
('98c50608a11ec800fba8b2d0b7294aeb', '1|7', 2),
('98c50608a11ec800fba8b2d0b7294aeb', '2|99', 3),
('98c50608a11ec800fba8b2d0b7294aeb', '2|1', 4),
('98c50608a11ec800fba8b2d0b7294aeb', '1|5', 5),
('98c50608a11ec800fba8b2d0b7294aeb', '1|8', 6),
('98c50608a11ec800fba8b2d0b7294aeb', '1|1', 7),
('269d6f1d2272bf0f3af7633340052a03', '1|1', 1),
('269d6f1d2272bf0f3af7633340052a03', '1|7', 2),
('269d6f1d2272bf0f3af7633340052a03', '2|99', 3),
('269d6f1d2272bf0f3af7633340052a03', '2|1', 4),
('269d6f1d2272bf0f3af7633340052a03', '1|5', 5),
('269d6f1d2272bf0f3af7633340052a03', '1|8', 6),
('269d6f1d2272bf0f3af7633340052a03', '1|1', 7),
('740c4edeb4bb99c86b2a9b6ee4321422', '1|1', 1),
('740c4edeb4bb99c86b2a9b6ee4321422', '1|7', 2),
('740c4edeb4bb99c86b2a9b6ee4321422', '2|99', 3),
('740c4edeb4bb99c86b2a9b6ee4321422', '2|1', 4),
('740c4edeb4bb99c86b2a9b6ee4321422', '1|5', 5),
('740c4edeb4bb99c86b2a9b6ee4321422', '1|8', 6),
('740c4edeb4bb99c86b2a9b6ee4321422', '1|1', 7),
('14ff4a179003b2934da7305a76f718ea', '1|1', 1),
('14ff4a179003b2934da7305a76f718ea', '1|7', 2),
('14ff4a179003b2934da7305a76f718ea', '2|99', 3),
('14ff4a179003b2934da7305a76f718ea', '2|1', 4),
('14ff4a179003b2934da7305a76f718ea', '1|5', 5),
('14ff4a179003b2934da7305a76f718ea', '1|8', 6),
('14ff4a179003b2934da7305a76f718ea', '', 7),
('0961f64bfc048e983d34059857ffaffa', '1|1', 1),
('0961f64bfc048e983d34059857ffaffa', '1|7', 2),
('0961f64bfc048e983d34059857ffaffa', '2|99', 3),
('0961f64bfc048e983d34059857ffaffa', '2|1', 4),
('0961f64bfc048e983d34059857ffaffa', '1|5', 5),
('0961f64bfc048e983d34059857ffaffa', '1|8', 6),
('0961f64bfc048e983d34059857ffaffa', '', 7),
('b17c95134e98e11fd56a4d9edfd0df0d', '1|1', 1),
('b17c95134e98e11fd56a4d9edfd0df0d', '1|7', 2),
('b17c95134e98e11fd56a4d9edfd0df0d', '2|99', 3),
('b17c95134e98e11fd56a4d9edfd0df0d', '2|1', 4),
('b17c95134e98e11fd56a4d9edfd0df0d', '1|5', 5),
('b17c95134e98e11fd56a4d9edfd0df0d', '1|8', 6),
('b17c95134e98e11fd56a4d9edfd0df0d', '', 7),
('46fbdae565140a8d73246e1e01f64b66', '1|1', 1),
('46fbdae565140a8d73246e1e01f64b66', '1|7', 2),
('46fbdae565140a8d73246e1e01f64b66', '2|99', 3),
('46fbdae565140a8d73246e1e01f64b66', '2|1', 4),
('46fbdae565140a8d73246e1e01f64b66', '1|5', 5),
('46fbdae565140a8d73246e1e01f64b66', '1|8', 6),
('46fbdae565140a8d73246e1e01f64b66', '', 7),
('11949d9ce6df5a06a3377325c71c7c4f', '1|1', 1),
('11949d9ce6df5a06a3377325c71c7c4f', '1|7', 2),
('11949d9ce6df5a06a3377325c71c7c4f', '2|99', 3),
('11949d9ce6df5a06a3377325c71c7c4f', '2|1', 4),
('11949d9ce6df5a06a3377325c71c7c4f', '1|5', 5),
('11949d9ce6df5a06a3377325c71c7c4f', '1|8', 6),
('11949d9ce6df5a06a3377325c71c7c4f', '', 7),
('f3c4859c79f6f34ac79072571744bf8e', '1|1', 1),
('f3c4859c79f6f34ac79072571744bf8e', '1|7', 2),
('f3c4859c79f6f34ac79072571744bf8e', '2|99', 3),
('f3c4859c79f6f34ac79072571744bf8e', '2|1', 4),
('f3c4859c79f6f34ac79072571744bf8e', '1|5', 5),
('f3c4859c79f6f34ac79072571744bf8e', '1|8', 6),
('f3c4859c79f6f34ac79072571744bf8e', '', 7),
('79ca852ae3c34e005ba8db7ca9f2429e', '1|1', 1),
('79ca852ae3c34e005ba8db7ca9f2429e', '1|7', 2),
('79ca852ae3c34e005ba8db7ca9f2429e', '2|99', 3),
('79ca852ae3c34e005ba8db7ca9f2429e', '2|1', 4),
('79ca852ae3c34e005ba8db7ca9f2429e', '1|5', 5),
('79ca852ae3c34e005ba8db7ca9f2429e', '1|8', 6),
('79ca852ae3c34e005ba8db7ca9f2429e', '', 7),
('4e792f072d10eb2f6addd8d04cf5cbe8', '1|1', 1),
('4e792f072d10eb2f6addd8d04cf5cbe8', '1|7', 2),
('4e792f072d10eb2f6addd8d04cf5cbe8', '2|99', 3),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 4),
('4e792f072d10eb2f6addd8d04cf5cbe8', '1|5', 5),
('4e792f072d10eb2f6addd8d04cf5cbe8', '1|8', 6),
('4e792f072d10eb2f6addd8d04cf5cbe8', '', 7),
('0732ec1c98e6496b097d7bee1482d96d', '1|1', 1),
('0732ec1c98e6496b097d7bee1482d96d', '1|7', 2),
('0732ec1c98e6496b097d7bee1482d96d', '', 3),
('0732ec1c98e6496b097d7bee1482d96d', '', 4),
('0732ec1c98e6496b097d7bee1482d96d', '1|5', 5),
('0732ec1c98e6496b097d7bee1482d96d', '1|8', 6),
('0732ec1c98e6496b097d7bee1482d96d', '', 7),
('40499b34a8c1fd21aca27a6f780913b7', '1|1', 1),
('40499b34a8c1fd21aca27a6f780913b7', '1|7', 2),
('40499b34a8c1fd21aca27a6f780913b7', '', 3),
('40499b34a8c1fd21aca27a6f780913b7', '', 4),
('40499b34a8c1fd21aca27a6f780913b7', '1|5', 5),
('40499b34a8c1fd21aca27a6f780913b7', '1|8', 6),
('40499b34a8c1fd21aca27a6f780913b7', '', 7),
('712f6f87ae511e72bec397c34b66341e', '1|1', 1),
('712f6f87ae511e72bec397c34b66341e', '1|7', 2),
('712f6f87ae511e72bec397c34b66341e', '', 3),
('712f6f87ae511e72bec397c34b66341e', '', 4),
('712f6f87ae511e72bec397c34b66341e', '1|5', 5),
('712f6f87ae511e72bec397c34b66341e', '1|8', 6),
('712f6f87ae511e72bec397c34b66341e', '', 7),
('3f47043a9d21b1e33eafe14c8e43ff23', '1|1', 1),
('3f47043a9d21b1e33eafe14c8e43ff23', '1|7', 2),
('3f47043a9d21b1e33eafe14c8e43ff23', '', 3),
('3f47043a9d21b1e33eafe14c8e43ff23', '', 4),
('3f47043a9d21b1e33eafe14c8e43ff23', '1|5', 5),
('3f47043a9d21b1e33eafe14c8e43ff23', '1|8', 6),
('3f47043a9d21b1e33eafe14c8e43ff23', '', 7),
('c654e54b080f01395814de4cc5a56a36', '1|1', 1),
('c654e54b080f01395814de4cc5a56a36', '1|7', 2),
('c654e54b080f01395814de4cc5a56a36', '', 3),
('c654e54b080f01395814de4cc5a56a36', '', 4),
('c654e54b080f01395814de4cc5a56a36', '1|5', 5),
('c654e54b080f01395814de4cc5a56a36', '1|8', 6),
('c654e54b080f01395814de4cc5a56a36', '', 7),
('997e35c67ee90c752adcafcb9146ef0c', '1|1', 1),
('997e35c67ee90c752adcafcb9146ef0c', '1|7', 2),
('997e35c67ee90c752adcafcb9146ef0c', '', 3),
('997e35c67ee90c752adcafcb9146ef0c', '', 4),
('997e35c67ee90c752adcafcb9146ef0c', '1|5', 5),
('997e35c67ee90c752adcafcb9146ef0c', '1|8', 6),
('997e35c67ee90c752adcafcb9146ef0c', '', 7),
('79734573fabe99c2d7b9730fb55b8179', '1|1', 1),
('79734573fabe99c2d7b9730fb55b8179', '1|7', 2),
('79734573fabe99c2d7b9730fb55b8179', '', 3),
('79734573fabe99c2d7b9730fb55b8179', '', 4),
('79734573fabe99c2d7b9730fb55b8179', '1|5', 5),
('79734573fabe99c2d7b9730fb55b8179', '1|8', 6),
('79734573fabe99c2d7b9730fb55b8179', '', 7),
('1031e7b699b6b7c0591c7bd314656738', '1|1', 1),
('1031e7b699b6b7c0591c7bd314656738', '', 2),
('1031e7b699b6b7c0591c7bd314656738', '', 3),
('1031e7b699b6b7c0591c7bd314656738', '', 4),
('1031e7b699b6b7c0591c7bd314656738', '1|5', 5),
('1031e7b699b6b7c0591c7bd314656738', '1|8', 6),
('1031e7b699b6b7c0591c7bd314656738', '', 7),
('18280efc59907bd2fb48b26d077e374c', '1|1', 1),
('18280efc59907bd2fb48b26d077e374c', '', 2),
('18280efc59907bd2fb48b26d077e374c', '', 3),
('18280efc59907bd2fb48b26d077e374c', '', 4),
('18280efc59907bd2fb48b26d077e374c', '1|5', 5),
('18280efc59907bd2fb48b26d077e374c', '', 6),
('18280efc59907bd2fb48b26d077e374c', '', 7),
('428ef3d7da115de87950f34ca0d6ea65', '1|1', 1),
('428ef3d7da115de87950f34ca0d6ea65', '', 2),
('428ef3d7da115de87950f34ca0d6ea65', '', 3),
('428ef3d7da115de87950f34ca0d6ea65', '', 4),
('428ef3d7da115de87950f34ca0d6ea65', '', 5),
('428ef3d7da115de87950f34ca0d6ea65', '', 6),
('428ef3d7da115de87950f34ca0d6ea65', '', 7),
('75f1c222ad8c86ed1fa97f4026ccbb49', '1|1', 1),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 2),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 3),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 4),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 5),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 6),
('75f1c222ad8c86ed1fa97f4026ccbb49', '', 7),
('1f50c749d050ef9cb714a1987d044462', '1|1', 1),
('1f50c749d050ef9cb714a1987d044462', '', 2),
('1f50c749d050ef9cb714a1987d044462', '', 3),
('1f50c749d050ef9cb714a1987d044462', '', 4),
('1f50c749d050ef9cb714a1987d044462', '', 5),
('1f50c749d050ef9cb714a1987d044462', '', 6),
('1f50c749d050ef9cb714a1987d044462', '', 7),
('d772445edc9d6a2be038c82c9fd09c31', '', 1),
('d772445edc9d6a2be038c82c9fd09c31', '', 2),
('d772445edc9d6a2be038c82c9fd09c31', '', 3),
('d772445edc9d6a2be038c82c9fd09c31', '', 4),
('d772445edc9d6a2be038c82c9fd09c31', '', 5),
('d772445edc9d6a2be038c82c9fd09c31', '', 6),
('d772445edc9d6a2be038c82c9fd09c31', '', 7),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 1),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 2),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 3),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 4),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 5),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 6),
('11bcf4429ca461cbb0a1bd8bbbb804c7', '', 7);

-- --------------------------------------------------------

--
-- 表的结构 `system_fight_state`
--

CREATE TABLE `system_fight_state` (
  `sid` text NOT NULL,
  `pid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `now_hp` decimal(65,0) NOT NULL,
  `now_mp` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('1,2,3,4,5,6,7,8,9,10,11,12', 12, '游戏首页', '12', '游戏首页'),
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
('1,13', 70, '抽奖', '70', '抽奖'),
('10', 71, '开启自动战斗', '71', '开启自动战斗'),
('10', 72, '关闭自动战斗', '72', '关闭自动战斗'),
('10', 73, '查看', '73', '查看'),
('1', 74, '出航', '74', '出航'),
('1', 75, '传送', '75', '传送'),
('1', 76, '采集资源', '76', '采集资源'),
('2', 77, '镶嵌装备', '77', '镶嵌装备'),
('6', 78, '装备核心列表', '78', '装备核心列表'),
('3', 79, '宠物收放', '79', '宠物收放'),
('3', 80, '宠物挂售', '80', '宠物挂售'),
('3', 81, '宠物赶走', '81', '宠物赶走'),
('3', 82, '宠物技能', '82', '宠物技能'),
('3', 83, '宠物装备', '83', '宠物装备'),
('3', 84, '宠物培养', '84', '宠物培养'),
('3', 85, '宠物清洁', '85', '宠物清洁'),
('3', 86, '宠物喂食', '86', '宠物喂食'),
('3', 87, '宠物使用物品', '87', '宠物使用物品'),
('14', 88, '装备页面镶嵌功能', '88', '装备页面镶嵌功能'),
('13', 89, '商品列表', '89', '商品列表'),
('4', 90, '物品页面镶嵌功能', '90', '物品页面镶嵌功能');

-- --------------------------------------------------------

--
-- 表的结构 `system_item`
--

CREATE TABLE `system_item` (
  `item_true_id` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `uid` int(10) NOT NULL,
  `iid` int(11) NOT NULL DEFAULT '1',
  `icount` decimal(65,0) NOT NULL DEFAULT '0',
  `iequiped` int(11) NOT NULL COMMENT '0为未装备，1为装备',
  `isale_state` int(1) NOT NULL COMMENT '0为未销售，1未销售中',
  `isale_price` int(11) NOT NULL COMMENT '销售价格',
  `icreate_sale_time` datetime NOT NULL COMMENT '创建销售的时间',
  `iexpire_sale_time` datetime NOT NULL COMMENT '过期时间',
  `isale_time` int(11) NOT NULL COMMENT '设定销售时长，单位：小时',
  `iroot` varchar(255) NOT NULL COMMENT '物品来源格式：类别|id，类别0代表未知，1代表怪物掉落，2代表玩家打造，3代表任务赠送，4代表其它',
  `iwg_fj` int(11) NOT NULL DEFAULT '0',
  `ino_give` tinyint(1) NOT NULL DEFAULT '1',
  `ino_out` tinyint(1) NOT NULL,
  `ilvl` bigint(20) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_item`
--

INSERT INTO `system_item` (`item_true_id`, `sid`, `uid`, `iid`, `icount`, `iequiped`, `isale_state`, `isale_price`, `icreate_sale_time`, `iexpire_sale_time`, `isale_time`, `iroot`, `iwg_fj`, `ino_give`, `ino_out`, `ilvl`) VALUES
(10, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 10, 40, '4', 0, 1, 15, '2023-12-03 18:35:30', '2023-12-04 18:35:30', 24, '', 0, 0, 0, 1),
(46, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 6, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(47, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 21, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(48, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 22, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(50, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(54, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 30, '6', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|57', 0, 0, 0, 1),
(63, '41400d200be5d46bc95b8573768c3409', 0, 2, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(64, '41400d200be5d46bc95b8573768c3409', 0, 1, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(65, 'b602cfc31a3e2d6e05a63629d10ab245', 0, 1, '8', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(69, 'b602cfc31a3e2d6e05a63629d10ab245', 0, 27, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(70, 'b602cfc31a3e2d6e05a63629d10ab245', 15, 24, '6', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0, 0, 1),
(71, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 20, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(72, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 1, '31', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(73, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 18, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(74, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 0, 11, '5', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(75, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 20, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(77, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 10, '23', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(78, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 8, '14', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(79, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 9, '11', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(81, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 23, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(82, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 40, '4', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(83, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 37, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|58', 0, 0, 0, 1),
(84, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 39, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(85, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 16, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(86, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 45, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(87, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 25, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(88, 'a228f3a2d068d3a8cc4506ea8adf9eb4', 11, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(89, '1c9dac0bc157445e9825e43681ef8d05', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(93, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 10, 23, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(94, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 23, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(97, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 52, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(98, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 39, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(99, '2be824d1d1eaf47b51176faf90a5b8c9', 1, 40, '4', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(100, '2be824d1d1eaf47b51176faf90a5b8c9', 0, 2, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(102, '2be824d1d1eaf47b51176faf90a5b8c9', 0, 1, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(103, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 10, 25, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(104, 'b602cfc31a3e2d6e05a63629d10ab245', 15, 25, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(105, '01a110059f80eaa13a42841f56fcb21a', 17, 25, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(107, '01a110059f80eaa13a42841f56fcb21a', 17, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(109, 'f5f8f28ae6c3fb5529d578a31cfcf72d', 0, 1, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(115, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '2024-07-05 22:44:38', 0, '', 0, 0, 0, 1),
(116, '959c9277a3e15eacff9e5f117e51f5bb', 1, 21, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(151, '959c9277a3e15eacff9e5f117e51f5bb', 1, 8, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(153, '0277b7c43250e3bda5d7fb423ce14d92', 0, 1, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(155, '959c9277a3e15eacff9e5f117e51f5bb', 1, 27, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(159, '959c9277a3e15eacff9e5f117e51f5bb', 1, 30, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|57', 0, 0, 0, 1),
(162, '214658c4375c343e280ae38e880ac4ba', 4, 4, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(163, '214658c4375c343e280ae38e880ac4ba', 0, 1, '23', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(165, '214658c4375c343e280ae38e880ac4ba', 0, 27, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(166, 'a8c7b0c51c60be7441214c0b0c671d88', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(176, '959c9277a3e15eacff9e5f117e51f5bb', 1, 45, '9', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(185, '959c9277a3e15eacff9e5f117e51f5bb', 0, 18, '21', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(195, '01a0d4f5e64a677721a1089d4914bc6a', 0, 1, '13', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(196, '01a0d4f5e64a677721a1089d4914bc6a', 6, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(197, '01a0d4f5e64a677721a1089d4914bc6a', 0, 9, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(198, '79462faa70c368423c7f9fb106fa1f47', 7, 4, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(199, '79462faa70c368423c7f9fb106fa1f47', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(201, '945fd26d30e007abfed414cc1f2795f5', 8, 4, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(203, '945fd26d30e007abfed414cc1f2795f5', 0, 1, '8', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(204, '945fd26d30e007abfed414cc1f2795f5', 0, 27, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(205, '945fd26d30e007abfed414cc1f2795f5', 8, 25, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(206, 'f55913444ef985484baf7580c60f15ce', 0, 1, '18', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(208, 'f55913444ef985484baf7580c60f15ce', 0, 27, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(209, 'f55913444ef985484baf7580c60f15ce', 9, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(210, 'f55913444ef985484baf7580c60f15ce', 9, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(211, 'f55913444ef985484baf7580c60f15ce', 9, 21, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(212, 'f55913444ef985484baf7580c60f15ce', 9, 22, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(213, 'f55913444ef985484baf7580c60f15ce', 9, 71, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(214, 'f55913444ef985484baf7580c60f15ce', 9, 24, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0, 0, 1),
(216, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 4, '5', 0, 1, 1, '2024-06-07 02:04:36', '2024-06-09 02:04:36', 48, '', 0, 0, 0, 1),
(217, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 10, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(218, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 45, '21', 0, 0, 0, '0000-00-00 00:00:00', '2024-06-06 23:52:13', 0, '', 0, 0, 0, 1),
(219, '01acd0637eb2b6a6a3055e4fc37e8457', 0, 1, '11', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(220, '01acd0637eb2b6a6a3055e4fc37e8457', 11, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(221, '01acd0637eb2b6a6a3055e4fc37e8457', 11, 10, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(222, '945fd26d30e007abfed414cc1f2795f5', 8, 5, '1', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(223, '945fd26d30e007abfed414cc1f2795f5', 8, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '2025-02-28 03:49:40', 0, '', 0, 0, 0, 1),
(224, '945fd26d30e007abfed414cc1f2795f5', 8, 21, '1', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(225, '945fd26d30e007abfed414cc1f2795f5', 8, 22, '1', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(226, '945fd26d30e007abfed414cc1f2795f5', 8, 71, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(228, '945fd26d30e007abfed414cc1f2795f5', 0, 6, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(229, '945fd26d30e007abfed414cc1f2795f5', 8, 29, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|51', 0, 0, 0, 1),
(230, '214658c4375c343e280ae38e880ac4ba', 4, 25, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(231, '2f4746d4d36396302d36e51c969d3e68', 12, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(232, '2f4746d4d36396302d36e51c969d3e68', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(233, 'fe3319b6dd10f68aaa36ee852cd79cc1', 0, 1, '6', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(239, '76623f3a68872fa88502af535498a991', 14, 4, '8', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(240, '76623f3a68872fa88502af535498a991', 14, 8, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(241, '76623f3a68872fa88502af535498a991', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(242, 'f4cd01caaf9ec17c03413de91b97b5f2', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(243, 'f4cd01caaf9ec17c03413de91b97b5f2', 16, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(250, '344773e829d514e37d748e906a4f020a', 0, 1, '13', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(251, '344773e829d514e37d748e906a4f020a', 17, 4, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(252, '344773e829d514e37d748e906a4f020a', 0, 9, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(262, '959c9277a3e15eacff9e5f117e51f5bb', 1, 139, '4', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|64', 0, 0, 0, 1),
(264, '959c9277a3e15eacff9e5f117e51f5bb', 0, 142, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(265, '98c50608a11ec800fba8b2d0b7294aeb', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(266, '98c50608a11ec800fba8b2d0b7294aeb', 20, 4, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(267, '98c50608a11ec800fba8b2d0b7294aeb', 0, 9, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(271, '959c9277a3e15eacff9e5f117e51f5bb', 1, 76, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(303, '959c9277a3e15eacff9e5f117e51f5bb', 1, 29, '5', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|51', 0, 0, 0, 1),
(304, '269d6f1d2272bf0f3af7633340052a03', 0, 1, '8', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(351, '740c4edeb4bb99c86b2a9b6ee4321422', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(357, '959c9277a3e15eacff9e5f117e51f5bb', 1, 144, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(358, '959c9277a3e15eacff9e5f117e51f5bb', 1, 145, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(359, '959c9277a3e15eacff9e5f117e51f5bb', 1, 146, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(360, '959c9277a3e15eacff9e5f117e51f5bb', 0, 147, '1', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(371, '269d6f1d2272bf0f3af7633340052a03', 0, 99, '7', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(393, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 99, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(409, '269d6f1d2272bf0f3af7633340052a03', 0, 2, '7', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(411, '959c9277a3e15eacff9e5f117e51f5bb', 1, 150, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|95', 0, 0, 0, 1),
(413, '14ff4a179003b2934da7305a76f718ea', 0, 1, '7', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(414, '14ff4a179003b2934da7305a76f718ea', 23, 4, '10', 0, 1, 0, '2024-09-17 16:46:53', '2024-09-18 16:46:53', 24, '', 0, 0, 0, 1),
(416, '14ff4a179003b2934da7305a76f718ea', 0, 2, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(431, '959c9277a3e15eacff9e5f117e51f5bb', 1, 39, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(432, '959c9277a3e15eacff9e5f117e51f5bb', 1, 40, '6', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(433, '959c9277a3e15eacff9e5f117e51f5bb', 1, 25, '9', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(437, '959c9277a3e15eacff9e5f117e51f5bb', 0, 148, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(438, '959c9277a3e15eacff9e5f117e51f5bb', 0, 130, '19', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(440, '959c9277a3e15eacff9e5f117e51f5bb', 1, 154, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(458, '959c9277a3e15eacff9e5f117e51f5bb', 0, 158, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(459, '959c9277a3e15eacff9e5f117e51f5bb', 0, 57, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(468, '11949d9ce6df5a06a3377325c71c7c4f', 40, 4, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(469, '11949d9ce6df5a06a3377325c71c7c4f', 0, 1, '11', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(470, '11949d9ce6df5a06a3377325c71c7c4f', 0, 99, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(471, '11949d9ce6df5a06a3377325c71c7c4f', 0, 2, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(472, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 9, '4', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(473, 'f3c4859c79f6f34ac79072571744bf8e', 0, 1, '11', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(474, 'f3c4859c79f6f34ac79072571744bf8e', 0, 99, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(475, 'f3c4859c79f6f34ac79072571744bf8e', 0, 2, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(478, '959c9277a3e15eacff9e5f117e51f5bb', 0, 161, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(479, '79ca852ae3c34e005ba8db7ca9f2429e', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(480, '79ca852ae3c34e005ba8db7ca9f2429e', 42, 4, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(503, '959c9277a3e15eacff9e5f117e51f5bb', 1, 11, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(505, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 1, '5', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(506, '959c9277a3e15eacff9e5f117e51f5bb', 1, 2, '917', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(507, '959c9277a3e15eacff9e5f117e51f5bb', 0, 1, '135', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(510, '959c9277a3e15eacff9e5f117e51f5bb', 0, 99, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(511, '68dcd3cd66a76b81cfc90c0e147617d4', 0, 18, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(512, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(513, '959c9277a3e15eacff9e5f117e51f5bb', 0, 88, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(514, '959c9277a3e15eacff9e5f117e51f5bb', 0, 9, '23', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(515, 'd12390bc49b0e1e7e94a3b8ed28af06f', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(517, '945fd26d30e007abfed414cc1f2795f5', 0, 2, '16', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(518, '531522b75447d1bb6150be51cf246331', 0, 1, '11', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(522, '531522b75447d1bb6150be51cf246331', 0, 9, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(523, '531522b75447d1bb6150be51cf246331', 0, 99, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(524, '531522b75447d1bb6150be51cf246331', 0, 2, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(526, 'f4cd01caaf9ec17c03413de91b97b5f2', 0, 2, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(528, 'e1c1f6225c9f47ce34285c7565d08894', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(530, '959c9277a3e15eacff9e5f117e51f5bb', 1, 137, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(533, '959c9277a3e15eacff9e5f117e51f5bb', 1, 16, '41', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(534, '959c9277a3e15eacff9e5f117e51f5bb', 1, 137, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(537, '959c9277a3e15eacff9e5f117e51f5bb', 0, 163, '5', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(539, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 9, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(540, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 25, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|18', 0, 0, 0, 1),
(541, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(543, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 16, '15', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(544, '959c9277a3e15eacff9e5f117e51f5bb', 1, 83, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(545, '959c9277a3e15eacff9e5f117e51f5bb', 1, 42, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(546, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 99, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(548, '959c9277a3e15eacff9e5f117e51f5bb', 1, 83, '1', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(549, '11949d9ce6df5a06a3377325c71c7c4f', 40, 10, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(550, '959c9277a3e15eacff9e5f117e51f5bb', 1, 22, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(551, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 18, '5', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(552, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 163, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(553, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 6, '1', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(554, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 30, '5', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|57', 0, 0, 0, 1),
(556, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 6, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(557, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 6, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(559, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 158, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(560, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 130, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(562, '945fd26d30e007abfed414cc1f2795f5', 8, 158, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(563, '0732ec1c98e6496b097d7bee1482d96d', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(564, '959c9277a3e15eacff9e5f117e51f5bb', 1, 80, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(565, '40499b34a8c1fd21aca27a6f780913b7', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(566, '40499b34a8c1fd21aca27a6f780913b7', 48, 130, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(567, '712f6f87ae511e72bec397c34b66341e', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(568, '712f6f87ae511e72bec397c34b66341e', 49, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(569, '712f6f87ae511e72bec397c34b66341e', 0, 9, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(570, '712f6f87ae511e72bec397c34b66341e', 49, 130, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(571, '712f6f87ae511e72bec397c34b66341e', 49, 2, '8', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(572, '3f47043a9d21b1e33eafe14c8e43ff23', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(573, '3f47043a9d21b1e33eafe14c8e43ff23', 50, 130, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(574, '3f47043a9d21b1e33eafe14c8e43ff23', 0, 9, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(575, 'c654e54b080f01395814de4cc5a56a36', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(576, 'c654e54b080f01395814de4cc5a56a36', 0, 9, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(577, 'c654e54b080f01395814de4cc5a56a36', 51, 4, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(578, 'c654e54b080f01395814de4cc5a56a36', 51, 10, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(579, 'c654e54b080f01395814de4cc5a56a36', 51, 130, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(580, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(583, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(584, '959c9277a3e15eacff9e5f117e51f5bb', 1, 46, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(585, '959c9277a3e15eacff9e5f117e51f5bb', 1, 46, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(586, '959c9277a3e15eacff9e5f117e51f5bb', 1, 46, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(587, '959c9277a3e15eacff9e5f117e51f5bb', 1, 50, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(588, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(589, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(590, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(591, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(593, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(595, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(596, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(606, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(608, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(613, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(624, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(625, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(626, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(627, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(628, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(629, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(630, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(631, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(632, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(633, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(634, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(635, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(636, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(637, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(638, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(639, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(640, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(641, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(642, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(643, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(644, '959c9277a3e15eacff9e5f117e51f5bb', 1, 7, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|48', 0, 0, 0, 1),
(645, '18280efc59907bd2fb48b26d077e374c', 55, 8, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(653, '945fd26d30e007abfed414cc1f2795f5', 8, 76, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(654, '959c9277a3e15eacff9e5f117e51f5bb', 1, 24, '6', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0, 0, 1),
(655, '959c9277a3e15eacff9e5f117e51f5bb', 1, 4, '8', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(657, '1f50c749d050ef9cb714a1987d044462', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 0, 1),
(658, '4e792f072d10eb2f6addd8d04cf5cbe8', 46, 24, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '1|37', 0, 0, 0, 1),
(660, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 1, '40', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 0, 1),
(662, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 11, '3', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 0, 1),
(664, '4e792f072d10eb2f6addd8d04cf5cbe8', 0, 128, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 0, 1),
(665, '959c9277a3e15eacff9e5f117e51f5bb', 1, 75, '7', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(666, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 130, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(667, 'fe3319b6dd10f68aaa36ee852cd79cc1', 10, 2, '2', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 0, 0, 1),
(668, '959c9277a3e15eacff9e5f117e51f5bb', 1, 32, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 1, 1),
(669, '959c9277a3e15eacff9e5f117e51f5bb', 1, 33, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 1, 1),
(670, '959c9277a3e15eacff9e5f117e51f5bb', 1, 34, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 1, 1),
(671, '959c9277a3e15eacff9e5f117e51f5bb', 1, 35, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 1, 1),
(672, '959c9277a3e15eacff9e5f117e51f5bb', 1, 36, '1', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 1, 1),
(673, '11bcf4429ca461cbb0a1bd8bbbb804c7', 0, 1, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `system_item_module`
--

CREATE TABLE `system_item_module` (
  `iid` int(11) NOT NULL,
  `iarea_name` varchar(255) NOT NULL,
  `iarea_id` int(11) NOT NULL DEFAULT '0',
  `iname` varchar(255) NOT NULL DEFAULT '0',
  `iimage` varchar(255) NOT NULL DEFAULT '',
  `idesc` varchar(255) NOT NULL DEFAULT '0',
  `idetail_desc` text NOT NULL COMMENT '//书籍分类专用',
  `itype` varchar(255) NOT NULL DEFAULT '0',
  `isubtype` varchar(255) NOT NULL DEFAULT '1',
  `iweight` int(11) NOT NULL DEFAULT '0',
  `iprice` int(11) NOT NULL DEFAULT '0',
  `ino_give` tinyint(1) NOT NULL DEFAULT '1',
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
  `iwg_fj` int(11) NOT NULL DEFAULT '0',
  `itake_on` int(11) NOT NULL,
  `itake_off` int(11) NOT NULL,
  `iembed_on` int(11) NOT NULL,
  `iembed_off` int(11) NOT NULL,
  `ilvl` bigint(20) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_item_module`
--

INSERT INTO `system_item_module` (`iid`, `iarea_name`, `iarea_id`, `iname`, `iimage`, `idesc`, `idetail_desc`, `itype`, `isubtype`, `iweight`, `iprice`, `ino_give`, `ino_out`, `iop_target`, `itask_target`, `icreat_event_id`, `ilook_event_id`, `iuse_event_id`, `iminute_event_id`, `iuse_attr`, `iuse_value`, `iattack_value`, `irecovery_value`, `iembed_count`, `iequip_cond`, `iwg_fj`, `itake_on`, `itake_off`, `iembed_on`, `iembed_off`, `ilvl`) VALUES
(1, '旧街', 1, '@e22400@金疮药@end@', '', '古籍中记载的很基础的草药药方，能稍微缓解跌打肿胀或外伤的疼痛。', '', '消耗品', '回复药', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '80', '', '', '', '', 0, 0, 0, 0, 0, 1),
(2, '旧街', 1, '钱袋', '', '一袋用废弃塑料袋子装起来的钱币，拎起来叮当响。', '', '其它', '钱袋', 1, 11, 0, 0, '', '', 0, 0, 72, 0, 'money', '10', '', '', '', '', 0, 0, 0, 0, 0, 1),
(3, '未分区', 0, '灰烬', '', '一小堆燃烧后的灰烬，暗灰色，是增肥的好东西。', '', '其它', '杂物', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(4, '未分区', 0, '垃圾', '', '散发着难闻的味道。', '', '其它', '废物', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(5, '旧街', 1, '@6a5353@生锈的铁剑@end@', '剑|sword_0001', '锈迹斑斑的样子，估计拿来砍肉都费劲。', '', '兵器', '1', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '10', '', '5', '{u.lvl}>{o.lvl}', 10, 212, 213, 0, 0, 150),
(6, '未分区', 0, '粗糙的匕首', '刀|knife_0001', '勉强能砍得动东西的一把匕首，狩猎时有用。', '', '兵器', '2', 1, 20, 0, 0, '', '', 0, 0, 0, 0, '', '', '11', '', '2', '', 0, 0, 0, 0, 0, 1),
(7, '未分区', 0, '草帽', '', '用杂草编织成的圆形帽子，实在是说不上美观。', '', '防具', '4', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'exp', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(8, '未分区', 0, '生锈的铁片', '', '这是一块生锈的铁片，锈迹斑斑的模样诉说着它的历史。', '', '其它', '材料', 1, 2, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(9, '未分区', 0, '废弃塑料', '', '塑料曾是人类最伟大的发明，是的，曾是。', '', '其它', '材料', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(10, '未分区', 0, '@587934@小树枝@end@', '', '一根树枝，不知道可以有什么用途。', '', '其它', '材料', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(11, '未分区', 0, '旧电路板', '', '这块有些老旧的电路板似乎是从什么电器上被拆解下来的。', '', '其它', '材料', 1, 30, 0, 0, '', '', 0, 0, 110, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(14, '未分区', 0, '莎草纸', '', '这种摸起来略微有些粗糙的纸张似乎有神奇的功能。', '', '其它', '纸张', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(15, '未分区', 0, '碎石块', '', '一块不规则的碎石。', '', '其它', '石头', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(16, '未分区', 0, '@583300@动物粪便@end@', '', '什么动物的排泄物，异常恶臭。', '', '其它', '排泄物', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(18, '希望镇', 2, '废旧六号电池', '', '看起来好像是一块电子垃圾，却是人类曾经工业的结晶，估计是收藏价值大于实用价值。', '', '其它', '能源', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(19, '未分区', 0, 'P-01手枪', '', '最原始的手枪型号，单发伤害稳定射速一般，不是一般人能拥有的。', '', '兵器', '3', 1, 2000, 0, 0, '', '', 0, 0, 0, 0, '', '', '60', '', '', '', 0, 0, 0, 0, 0, 1),
(20, '未分区', 0, 'A-01冲锋枪(猎豹)', '枪|gun-a-01', '昂贵的冲锋枪不是一般的势力能够装备得起的，当然，猎豹只是初级款的，所以还行。', '', '兵器', '3', 1, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '80', '', '4', '', 30, 0, 0, 0, 0, 1),
(21, '未分区', 0, '破旧的牛仔裤', '', '耐磨的牛仔裤，勉强能保暖和提供一点缓冲作用。', '', '防具', '6', 1, 5, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(22, '旧街', 1, '老旧的圆领外衣', '', '脏兮兮的模样，平平无奇的款式，却能带给人一丝丝的温暖。', '', '防具', '5', 1, 15, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '10', '1', '', 0, 0, 0, 0, 0, 1),
(23, '希望镇', 2, '《陈年旧梦》', '', '一本暗红色的书，似乎是一本小说。', '儿时，秋与林曾是一对恋人。他们相识于故乡的田野之间，共同度过了无数欢乐的时光。然而，随着岁月的流逝，他们的人生道路逐渐发生了变化。\r\n秋，一个温文尔雅的男子，为了家族的利益，被迫离开了故乡，去往繁华的都市谋求生计。临别时，林紧紧握住秋的手，眼中闪烁着泪花，却无法改变他的决定。\r\n“你要记得我，无论何时何地，我永远都会等着你。”林的话语，至今仍在秋的耳边回荡。\r\n城市的生活让秋变得愈加成熟，然而他的内心却始终无法割舍对林的思念。一天，他偶然得知林也来到了都市，成为了一名小学教师。秋心中涌起了重逢的渴望，他决定要再次见到林，重温那段美好的旧梦。\r\n秋千方百计地寻找林的踪迹，终于在一个雨夜，他在林的家门口与她重逢。秋欣喜若狂，然而他发现林已经变得陌生了许多。她的眼神中已经没有了过去的单纯与欢乐，取而代之的是一种深深的忧虑与疲惫。\r\n“林，你还记得我吗？”秋问道。\r\n林缓缓抬起头，看着秋熟悉的面孔，眼中闪过一丝惊讶与欣喜。“我当然记得你，我一直都在等你。”\r\n然而，他们的重逢并没有像秋想象中的那样美好。林的身边已经有了其他的男人，一个看似平凡却对她呵护备至的男人。秋的心中充满了失落，但他并没有放弃对林的追求。\r\n他开始用各种方式向林表达自己的爱意，送花、写情书、甚至是公开的表白。然而，这些举动并没有让林回心转意。相反，她开始逃避秋的眼神，对他的追求感到困扰与不安。\r\n“林，为什么你要这样对我？”秋在林的面前，流下了痛苦的泪水。\r\n林轻轻地摇了摇头，“不是的，秋，你是一个好人，但我真的不能接受你的爱。”\r\n在那个陈年的旧梦之中，秋与林的爱情终究没有得到圆满的结局。时光荏苒，他们的故事成为了故乡的一则传说，让人们感叹不已。\r\n岁月如梭，秋已经变成了一个孤独的老人。他常常独自漫步在故乡的田野之间，回忆着过去的美好时光。而林也早已离开了这个地方，去往一个遥远的地方追求自己的梦想。\r\n在一个寂静的夜晚，秋独自坐在月光下，眼前浮现出林年轻时的模样。他想起了他们的欢笑、他们的誓言以及他们的分别。突然间，他明白了林的决定和她的痛苦。他们的爱情早已埋藏在那个陈年的旧梦之中，成为了他们生命中永远无法触及的遗憾。\r\n“林，愿你幸福。”秋在心中默默地祝福着林，然后缓缓闭上了双眼。在这个宁静的夜晚，他的灵魂终于得以安息。', '书籍', '小说', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(24, '旧街', 1, '变异利爪', '', '不知道是什么动物变异后的爪子，异常锋利，很适合用于打磨武器。', '', '其它', '材料', 1, 5, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(25, '旧街', 1, '@brown@变异黑土@end@', '', '这块黑土摸起来拥有奇怪的感觉。', '', '其它', '稀土', 1, 2, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(26, '旧街', 1, '电动轮椅', '', '瞧瞧，一把精巧的电动轮椅，造价可是颇为不菲，', '', '防具', '7', 100, 2500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(27, '旧街', 1, '旧街通行身份牌', '', '一块薄薄的金属和不知名木头做成的菱形牌子，上面刻着【{u.name}】的名字。', '', '任务物品', '木牌', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(28, '旧街', 1, '@ae1313@黑耗子炖电路板@end@', '', '黑耗子先不说?炖电路板能吃吗?我一定是疯了！', '', '消耗品', '0', 1, 100, 0, 0, '', '', 0, 0, 0, 0, 'exp', '200', '', '', '', '', 0, 0, 0, 0, 0, 1),
(29, '旧街', 1, '@87cefa@蓝色血液@end@', '', '蓝蚊子身上掉下的一滴血，在月光照射下亮蓝亮蓝的，看起来很好看。', '', '其它', '原液', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(30, '旧街', 1, '@purple@紫色羽毛@end@', '', '一片紫色的羽毛，似乎是什么禽类身上的。', '', '其它', '材料', 1, 20, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(31, '旧街', 1, '@cb4d4d@营养元素冻@end@', '', '看着还不错，灰蓝的颜色，不知道是什么做的，闻起来有一股清香的奇特味道。', '', '消耗品', '0', 1, 200, 0, 0, '', '', 0, 0, 0, 0, 'exp', '300', '', '', '', '', 0, 0, 0, 0, 0, 1),
(32, '未分区', 0, '《日出之地地图》', '', '用一张羊皮卷记载了传说中的日出之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝传说太阳升起的地方，是一片富饶之地，拥有吃不完腐烂的食物以及穿不完随便乱扔的丝绸，随便往地上一躺就是黄金，翻个身大概率是块宝石......〞\r\n\r\n〝我用了大半生的时间，越过了「迷雾海」和「绝望漩涡」，当我看到那一轮冉冉升起的无与伦比的大太阳以及那块一生难忘的陆地时，我激动到难以自已，古书的记载就这样呈现在了我的眼前......〞\r\n\r\n「旧世纪复原会」－「马可.波罗」', '书籍', '地图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(33, '未分区', 0, '《灼热之地地图》', '', '用一张羊皮卷记载了传说中的灼热之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝无时无刻不在下着雨的森林，一望无际的草原，数不清的波涛汹涌的大河，蠢蠢欲动的火山......瞧瞧，我在她的尽头发现了什么，一座婀娜多姿的瀑布，她是那么迷人...〞\r\n\r\n〝噢，伙计，我想我找到她了，那片「灼热之地」，老实说，我现在只想找个地方喝点朗姆酒再和几位美人探讨下生命的真谛，我开玩笑的好吧如果你不这么认为我也没办法......〞\r\n\r\n「旧世纪复原会」－「大卫.利文斯通」', '书籍', '地图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(34, '未分区', 0, '《日落之地地图》', '', '用一张羊皮卷记载了传说中的日落之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝oh，伙计，这地方简直太美妙了，充满了各种神话传说，可惜我穷尽一生都没遇到，人生真是充满了遗憾啊。〞\r\n\r\n〝上帝啊，差点在「迷失海域」翻车了，那片鬼地方上罗盘都在疯狂旋转，真的，我本来都以为自己要交代在这里了。〞\r\n\r\n「纪元考据同盟」－「埃里克·瑟瓦尔德森」', '书籍', '地图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(35, '未分区', 0, '《极寒之地地图》', '', '用一张羊皮卷记载了传说中的极寒之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝传说世界尽头的高寒之地，是诸神锻造星辰的熔炉，冰川里凝固着永不融化的蓝宝石，雪原下深埋着上古巨兽的骸骨，随手捧起月光就能凝成水晶，呼出的白雾会在空中结成珍珠......〞\r\n\r\n〝我撕裂了十三张熊皮缝制的大氅，折断了六支镶银冰镐，当破冰船在「永夜冰峡」和「霜骨荒原」间粉身碎骨时，我匍匐着爬过最后三里冰面。那天穹上舞动的极光与地平线升起的冰晶尖塔，让我的血液在零下五十度沸腾，羊皮卷轴里的神话正将我的眼睫毛冻成冰帘......〞\r\n\r\n「纪元考据同盟」－「欧内斯特·沙克尔顿」', '书籍', '地图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(36, '未分区', 0, '《湿热之地地图》', '', '用一张羊皮卷记载了传说中的湿热之地的方位丶距离以及行进路线，是来自旧世界的遗物。', '〝传说赤道缠绕的瘴疠之地，是森林之神汗液汇成的秘境，雨林中流淌蜜汁的藤蔓会自己钻进旅人嘴里，腐烂的巨木每时辰绽开七色毒蕈，连暴雨都裹着能醉倒大象的花粉，沼泽吐出的气泡里包裹着龙的眼瞳......〞\r\n\r\n〝我剜去被食人鱼啃噬的腿肉，用火枪烧焦溃烂的伤口，当独木舟在「毒瘴林」与「沸血河」间化作朽木时，我抓着树蟒游过最后半里沸水。那遮天蔽日的荧光巨木与垂落九天的翡翠瀑布，令我的肺叶在四十八度高温中颤栗，龟甲裂纹预示的诅咒正顺着我的汗腺生根......〞\r\n\r\n「旧世纪复原会」－「亨利·沃尔特·贝茨」', '书籍', '地图', 1, 500, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(37, '旧街', 1, '@black@黑色牛角@end@', '', '一块巨大的黑色牛角。', '', '其它', '动物角', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(38, '希望镇', 2, '@d36c27@胡萝卜汤@end@', '', '淡淡油花，点点青葱，津津有味，齿颊留香，旧时代前比较廉价的一道菜到如今却十分珍贵。', '', '消耗品', '0', 1, 50, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0, 0, 0, 0, 1),
(39, '未分区', 0, '@A67F37@铜矿@end@', '', '可以利用的含铜的自然矿物集合体的总称，铜矿石一般是铜的硫化物或氧化物与其他矿物组成的集合体，与硫酸反应生成蓝绿色的硫酸铜。', '', '任务物品', '原矿', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(40, '未分区', 0, '@DCDFE3@锡矿@end@', '', '锡质软有延展性、化学性质稳定，抗腐蚀、易熔，摩擦系数小，是良好的工业原料。', '', '任务物品', '原矿', 1, 15, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(41, '未分区', 0, '@d4d7d9@铁矿@end@', '', '铁是世界上发现最早，利用最广，用量也是最多的一种金属，其消耗量约占金属总消耗量的95%左右。铁矿石主要用于钢铁工业。', '', '任务物品', '原矿', 1, 30, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(42, '未分区', 0, '@72777b@铅矿@end@', '', '金属铅是一种耐蚀的重有色金属材料，铅具有熔点低、耐蚀性高、X射线和γ射线等不易穿透、塑性好等优点', '', '任务物品', '原矿', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(43, '广陵古城', 16, '白色长袍', '', '一件用精美的丝绸缝制而成的长袍，似乎来自遥远的东方。', '', '防具', '5', 1, 40, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '2', '', '', 0, 0, 0, 0, 0, 1),
(44, '广陵古城', 16, '蓝色头巾', '', '一件用精美的丝绸缝制而成的头巾，似乎来自遥远的东方。', '', '防具', '4', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(45, '未分区', 0, '@0c1f04@松木@end@', '', '松木是一种针叶植物它具有松香味、色淡黄、疖疤多、对大气温度反应快、容易胀大、极难自然风干等特性。', '', '任务物品', '原木', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(46, '旧街', 1, '精钢剑', '剑|sword_0001', '用精钢打造的剑，拥有不小的威力。', '', '兵器', '1', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '15', '', '', '', 0, 0, 0, 0, 0, 1),
(47, '希望镇', 2, '@96d35f@豌豆沙拉@end@', '', '一些不知名的野菜，几颗干瘪的豌豆，用劣质奶油拌在一起就是一顿美味。', '', '消耗品', '0', 1, 100, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0, 0, 0, 0, 1),
(48, '希望镇', 2, '@d19d01@牛肉三明治@end@', '', '一块优质的生态农场黄牛肉，两片来自磨坊加工的小麦制成的食物，真是末世的一种奢侈享受啊。', '', '消耗品', '0', 1, 300, 0, 0, '', '', 0, 0, 0, 0, 'hp', '250', '', '', '', '', 0, 0, 0, 0, 0, 1),
(49, '希望镇', 2, '@4e7a27@蔬菜羹@end@', '', '生态农场出产的优质甜菜根以及芜菁，用高纯水烧煮，成非牛顿流体后加入特殊香料，十里飘香。', '', '消耗品', '0', 1, 80, 0, 0, '', '', 0, 0, 0, 0, 'hp', '120', '', '', '', '', 0, 0, 0, 0, 0, 1),
(50, '旧街', 1, '精钢匕首', '', '精钢锻造的匕首，锋利且杀伤力惊人。', '', '兵器', '2', 1, 120, 0, 0, '', '', 0, 0, 0, 0, '', '', '17', '', '', '', 0, 0, 0, 0, 0, 1),
(51, '未分区', 0, '《亵渎者的手册》', '', '记载着本地居民不诚和渎神之举的破烂书本，噢，兴许能卖给一个愚蠢的信徒。', '', '书籍', '手册', 1, 5, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(52, '未分区', 0, '《无名旅者的日记》', '', '这是一本无名旅者的日记，记载了一位无名旅者的故事。', '第一天：现在的我得知了真相，忘却了从前。是她带的那个戒指，我真愚蠢。\r\n第二天：好饿啊，难道我要成为这无名小岛的一具枯骨了吗。\r\n第三天：该死的，森林深处那片水源旁边是老虎的领地。\r\n第四天：天呐，我要死在这漫无天日的地洞了。\r\n第五天：亲爱的爱丽丝，我可能要违背向你许下的诺言了，我真的好想你啊...', '书籍', '日记', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(53, '未分区', 0, '《枫叶气味的信》', '', '秋\r\n我爱你。\r\n好了，我说出来了。\r\n你看到的时候我估计在离开你的船上了。\r\n不知何时再会栖霞看一眼云海。\r\n也许此生无望。\r\n勿忘我-林。', '', '书籍', '信封', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(54, '未分区', 0, '《吟游诗人的地图》', '', '该死的诗人，好端端的把藏宝点塞文字里干什么。', '', '书籍', '地图', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(55, '希望镇', 2, '@763700@多汁的灰苹果@end@', '', '真搞不懂生态农场那批人怎么搞出来这种品种的，感觉没有鲜红的苹果吸引你的啃咬。', '', '消耗品', '水果', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0, 0, 0, 0, 1),
(56, '未分区', 0, '《贴着邮票的传单》', '', '一张破烂，措辞得体的传单，内容是招募冒险者。', '', '书籍', '传单', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(57, '未分区', 0, '《模糊不清的字条》', '', '这是一张模糊不清的字条，岁月的痕迹在上面很明显。', '今天███是第█天，阿█莎███好吗?我不█去揭██世界的██，虚幻██呓语███圈养█人。', '书籍', '便签', 1, 0, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(58, '未分区', 0, '《目击者的证言》', '', '上面密密麻麻写满了许多人名以及其阐述的内容。', '', '书籍', '便签', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(59, '未分区', 0, '《末日的狂欢》', '', '交媾，愉悦，上千人的疯狂记载于此。', '', '书籍', '笔记', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(60, '未分区', 0, '《戈德兰植物图鉴》', '', '这本图鉴记载了戈德兰上常见的植物的信息，由某位不知名植物学家撰写。', '', '书籍', '图鉴', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(61, '未分区', 0, '《锻炉使用手册》', '', '这本手册记载了如何用锻炉打造出一副装备的过程。', '', '书籍', '手册', 1, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(62, '未分区', 0, '@4e7a27@绿色柑橘@end@', '', '这柑橘已经成熟了，但怎么是绿色的，那帮人又搞什么东西。', '', '消耗品', '水果', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0, 0, 0, 0, 1),
(63, '未分区', 0, '@d19d01@干式奶酪@end@', '', '黑雾城的人发明的一种奶酪，香味粗旷刺激，保质期很长，深受旅行者的喜爱。', '', '消耗品', '奶制品', 1, 50, 0, 0, '', '', 0, 0, 0, 0, 'hp', '100', '', '', '', '', 0, 0, 0, 0, 0, 1),
(64, '未分区', 0, '@785800@朗姆酒@end@', '', '自从这种琥珀色的烈酒被带到戈德兰以来，就成为了水手们的钟爱之物。', '', '消耗品', '酒', 1, 20, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0, 0, 0, 0, 1),
(65, '未分区', 0, '@ffab01@土豆饼@end@', '', '劣质的棕榈油的香气包裹住了土豆的脆感，是戈德兰上一般人也能享用得起的一道美食。', '', '消耗品', '主食', 1, 5, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0, 0, 0, 0, 1),
(66, '未分区', 0, '@01c7fc@水@end@', '', '用廉价的木头制成的水壶，里面装的不知道是哪口污染还不够严重的井水，清甜可口。', '', '消耗品', '水', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '1', '', '', '', '', 0, 0, 0, 0, 0, 1),
(67, '旧街', 1, '《莉莉安的书信》', '', '莉莉安写给姗妮的一封信，用书皮保护着，不知道上面写了什么。', 'to 亲爱的姗妮:\r\n你还好吗?你最近过得怎么样?上次的匆匆一别是我心中的一大遗憾，真想和你继续就着牛蒡菊花茶消磨午后的时光啊，对了，有件事想问一下你，希望镇的商队已经一个多月没有来过旧街了，是否出了什么变故，如果可以的话，可否给予我一封回信来说明情况?\r\nfrom 爱你的莉莉安', '书籍', '书信', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(68, '黑雾城', 6, 'B-99冲锋枪(黑冢)', '枪|gun-a-01', '黑雾城军工厂出产的一款冲锋枪，射速快穿透力强后座稳定，是昂贵又危险的武器。', '', '兵器', '3', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '100', '', '', '', 0, 0, 0, 0, 0, 1),
(69, '黑雾城', 6, '钨钢合金装甲', '', '钨钢合金打造的装甲，造价不菲，虽然厚重了一点，但是防御力非常优秀。', '', '防具', '5', 20, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '40', '', '', 0, 0, 0, 0, 0, 1),
(70, '未来城', 3, '激光短刃', '', '难以想象是什么样的手段让人类驯服了激光，并将其用于冷兵器领域，使其削铁如泥，锋利无比。', '', '兵器', '2', 10, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '50', '', '', '', 0, 0, 0, 0, 0, 1),
(71, '未分区', 0, '布鞋', '', '就是一块粗布做成了鞋子的样子，穿久了明显会感到硌脚。', '', '防具', '7', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'exp', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(72, '未分区', 0, '背包编织包', '', '一套很粗糙的针线，能将你的背包稍微扩大一些。', '', '其它', '拓展包', 1, 60, 0, 0, '', '', 0, 0, 82, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(73, '银月戈壁', 10, '@5C4033@风干的肉肠@end@', '', '一节不知道什么动物的肉，捣碎灌入肠衣，风干后别有一番风味。', '', '消耗品', '肉制品', 1, 150, 0, 0, '', '', 0, 0, 0, 0, 'hp', '300', '', '', '', '', 0, 0, 0, 0, 0, 1),
(74, '未分区', 0, '生锈的铁镐', '', '由杂质斑驳的铁制成的镐子，能进行一些初级的矿石采集。', '', '兵器', '10', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '1', '', '', '', 0, 0, 0, 0, 0, 1),
(75, '未分区', 0, '@31c91d@墨绿结晶@end@', '', '一块不规则的墨绿色的结晶，靠近它你仿佛能听到一股涌动的力量。', '', '兵器镶嵌物', '结晶', 1, 300, 0, 0, '', '', 0, 0, 0, 0, '', '', '0', '', '', '', 11, 0, 0, 0, 0, 1),
(76, '未分区', 0, '淡蓝结晶', '', '这个不规则的晶体衍射着一股淡蓝色的光辉，夜晚下梦幻般美丽。', '', '防具镶嵌物', '结晶', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '10', '', '', 0, 0, 0, 0, 0, 1),
(77, '未分区', 0, '轻便兜帽', '', '一件由轻质有机材料制成的兜帽，戴着它仿佛整个人的头脑都放松了。', '', '防具', '4', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '15', '', '', 0, 0, 0, 0, 0, 1),
(78, '未分区', 0, '银色树汁', '', '这滴取自变异的银杉树上的汁液，不仅珍贵而且赏心悦目。', '', '任务物品', '树汁', 1, 1000, 1, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(79, '未分区', 0, '琥珀石', '', '这是一块外表崎岖不平的灰色石头，兴许切开后有琥珀也不一定。', '', '其它', '原石', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(80, '银月戈壁', 10, '@d9ec37@牛蒡菊花茶@end@', '', '牛蒡与菊花的味道巧妙地融合在一起。', '', '消耗品', '茶包', 1, 90, 0, 0, '', '', 0, 0, 0, 0, 'hp', '140', '', '', '', '', 0, 0, 0, 0, 0, 1),
(81, '失落之地', 4, '冒险者头巾', '', '一件用粗布缝制成的头巾，也缝制了冒险者的梦想。', '', '防具', '4', 1, 40, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '3', '', '', 0, 0, 0, 0, 0, 1),
(82, '未分区', 0, '希望勋章', '', '为了纪念「火种计划」的胜利而发行的勋章，是缅怀过去也是寄托希望于未来。', '', '防具', '16', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(83, '刺桐古城', 17, '@blue@清风@end@', '', '「清风徐徐，水波不兴」据说是由一位遥远的东方工匠打造而成，符合人体工学，其动力装置能让人畅游天空的奥秘。', '', '防具', '17', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '10', '', '', 0, 0, 0, 0, 0, 1),
(84, '未分区', 0, '复合弓', '', '一把轻巧又致命的复合结构的弓，尖锐的箭能轻易穿透敌人，造价不菲。', '', '兵器', '11', 1, 1500, 0, 0, '', '', 0, 0, 0, 0, '', '', '55', '', '', '', 0, 0, 0, 0, 0, 1),
(85, '未分区', 0, '古老的刻印', '', '也许是灾变前时代的产物，沉甸甸的重量以及光怪陆离的图案，让人无不思索起那个时代的繁荣。', '', '其它', '刻印', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(86, '未分区', 0, '《残缺的羊皮卷轴》', '', '这是一份用山羊皮书写而成的卷轴，仿佛记录着什么神奇的东西，可惜是残缺的。', '', '书籍', '卷轴', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(87, '未分区', 0, '混乱宝珠', '', '一颗漆黑的宝珠，光是看着就感到头晕目眩了，是什么材料在起作用。', '', '兵器镶嵌物', '宝珠', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '30', '', '', '', 0, 0, 0, 0, 0, 1),
(88, '未分区', 0, '虚界令牌', '', '不知道什么材质制成，摸起来有种岁月的蹉跎感，上面有一些奇怪的符号。', '', '任务物品', '令牌', 1, 1000, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(89, '未分区', 0, '奇楠沉香', '', '大自然的馈赠，一股独特的香气萦绕。', '', '其它', '沉香', 1, 400, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(90, '未分区', 0, '渡瓶', '', '能传递梦界与实界的奇特瓶子，材质是超级稀有的空间耦合材料「DMPK」。', '', '任务物品', '瓶子', 1, 6000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(91, '刺桐古城', 17, '淡红舍利指环', '', '漆黑光滑透露着一点点红色，由神秘的东方奇物舍利子制成。', '', '防具', '9', 1, 888, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '30', '', '', 0, 0, 0, 0, 0, 1),
(92, '未分区', 0, '硫磺', '', '一小块不规则的硫磺，似乎是从哪里挖到的。', '', '其它', '硫磺', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(93, '未分区', 0, '玄铁', '', '一块玄铁，沉甸甸的。', '', '其它', '玄铁', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(94, '未分区', 0, '@d6d6d6@秘银@end@', '', '一块秘银。', '', '其它', '秘银', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(95, '未分区', 0, '钻石', '', '钻石。', '', '其它', '钻石', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(96, '未分区', 0, '白金', '', '。', '', '其它', '白金', 1, 6000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(97, '未分区', 0, '乌木', '', '乌木。', '', '其它', '乌木', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(98, '未分区', 0, '晶髓', '', '晶石的精髓。', '', '其它', '晶髓', 1, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(99, '未分区', 0, '@864ffe@奥秘蘑菇@end@', '', '经过了异变后的普通的蘑菇，可不要轻易吞下它。', '', '消耗品', '蘑菇', 1, 30, 0, 0, '', '', 0, 0, 0, 0, 'mp', '10', '', '', '', '', 0, 0, 0, 0, 0, 1),
(100, '未分区', 0, '@76bb40@接骨草@end@', '', '听名字就不一般，对跌打扭伤有不俗的疗效。', '', '消耗品', '草药', 1, 40, 0, 0, '', '', 0, 0, 0, 0, 'hp', '150', '', '', '', '', 0, 0, 0, 0, 0, 1),
(101, '未分区', 0, '树人之根', '', '等一下，树人是什么?我一定是疯了。', '', '任务物品', '树根', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(102, '未分区', 0, '@ebebeb@山羊奶@end@', '', '变异黑山羊的奶，淡黄的颜色，看着不是很有胃口。', '', '消耗品', '原奶', 1, 250, 0, 0, '', '', 0, 0, 0, 0, 'hp', '150', '', '', '', '', 0, 0, 0, 0, 0, 1),
(103, '未分区', 0, '毛蕊花', '', '这朵粉红的花，中间的花蕊是带着很多小毛的蓝色形状，很漂亮。', '', '任务物品', '花朵', 1, 20, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(104, '未分区', 0, '《火种计划·其一》', '', '火种计划的第一章，记录了那段黑暗的人类岁月中先驱者们在摸索救亡的一些事。', '', '书籍', '记录书', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(105, '未分区', 0, '生锈的铁斧', '', '由杂质斑驳的铁制成的斧头，能进行一些初级的木材采集。', '', '兵器', '10', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '1', '', '', '', 0, 0, 0, 0, 0, 1),
(106, '未分区', 0, '格斗拳套', '', '铭刻了许多奇特符号的拳套，能增强使用者的力量，简直是为为格斗而生的。', '', '兵器', '12', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '75', '', '', '', 0, 0, 0, 0, 0, 1),
(107, '未分区', 0, '刺客兜帽', '', '仿连帽式设计的黑色兜帽，采用的有机聚合抗压材料，能潜伏于阴影和人群之中，是刺客常见的配装。', '', '防具', '4', 1, 800, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '25', '', '', 0, 0, 0, 0, 0, 1),
(108, '未分区', 0, '诅咒法杖', '', '一颗骷髅头栩栩如生，乍一看仿佛能见到其周围的幽绿色气体，能从神秘的高维空间产生因果律伤害。', '', '兵器', '13', 1, 20000, 0, 0, '', '', 0, 0, 0, 0, '', '', '125', '', '', '', 0, 0, 0, 0, 0, 1),
(109, '未分区', 0, '黑曜晶石', '', '无比珍贵的黑曜结晶石，是黑曜石中最坚硬的部分。', '', '防具镶嵌物', '结晶', 5, 400, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '20', '', '', 0, 0, 0, 0, 0, 1),
(110, '未分区', 0, 'DMPK', '', '全称「暗聚复合酯酮」，一种能让周遭空间表现出「虚纹」的灰色超级材料，机理未知，被首次合成以后广泛应用于空间研究领域。', '', '其它', '超级材料', 50, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(111, '金陵古城', 9, '锦绣', '', '旧纪元时由商人取自海外蚕丝所制,异常珍贵。', '', '其它', '丝织品', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(112, '未分区', 0, '生锈的镰刀', '', '由杂质斑驳的铁制成的镰刀，能进行一些初级的植物采集。', '', '兵器', '10', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '1', '', '', '', 0, 0, 0, 0, 0, 1),
(113, '未分区', 0, '赤铁战斧', '', '通体血红，斧身坚硬光滑且开口处锋利无比，为痛饮敌人鲜血而造。', '', '兵器', '14', 5, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '35', '', '', '', 0, 0, 0, 0, 0, 1),
(114, '未分区', 0, '@583300@野兔腿@end@', '', '一只黑色变异野兔的腿肉，异常强健发达，应该味道不错。', '', '消耗品', '腿肉', 1, 40, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0, 0, 0, 0, 1),
(115, '未分区', 0, '@ffecd4@鲑鱼肉@end@', '', '在这个时代，这是多么奢华的享受。', '', '消耗品', '鱼肉', 1, 300, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0, 0, 0, 0, 1),
(116, '未分区', 0, '@5c0701@魔鹿肉@end@', '', '一头异化的魔鹿的肉，有些结实，硬梆梆的，估计不好咬动。', '', '消耗品', '鹿肉', 1, 600, 0, 0, '', '', 0, 0, 0, 0, 'hp', '140', '', '', '', '', 0, 0, 0, 0, 0, 1),
(117, '未分区', 0, '@c4bc00@麦芽酒@end@', '', '味道不会像烈酒那么火爆，但也不是没有脾气的。', '', '消耗品', '酒', 1, 20, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0, 0, 0, 0, 1),
(118, '未来城', 3, '25型重机枪', '', '看你看到这个大家伙的枪口时候，噢伙计，那可不太妙。', '', '兵器', '3', 1, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '200', '', '', '', 0, 0, 0, 0, 0, 1),
(119, '未分区', 0, '碾碎者', '', '曾经是大势力警卫力量的标配，后来被淘汰了，在枪械爱好者的收藏库也许能一睹方颜。', '', '兵器', '3', 1, 7000, 0, 0, '', '', 0, 0, 0, 0, '', '', '75', '', '', '', 0, 0, 0, 0, 0, 1),
(120, '未分区', 0, '老兵', '', '曾经是射程最远的狙击枪，威慑了一个时代，能量枪的崛起造就了它的没落，不过仍然是一把威力不俗的枪。', '', '兵器', '3', 1, 30000, 0, 0, '', '', 0, 0, 0, 0, '', '', '250', '', '', '', 0, 0, 0, 0, 0, 1),
(121, '未分区', 0, '正义之手', '', '如同它的缔造者所言:〝用绝对的力量审判世间一切的不正义之事。〞', '', '兵器', '12', 10, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '125', '', '', '', 0, 0, 0, 0, 0, 1),
(122, '未分区', 0, '奇怪的戒指', '', '通体发黑的椭圆形戒指，看着有些瘆人。', '', '防具', '9', 1, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(123, '希望镇', 2, '达克莱尔的合金扳手', '', '达克莱尔请求异域商人从遥远的东方带回来的一把特制合金扳手，拥有暗金色光芒以及高雅的外观。', '', '兵器', '10', 1, 998925, 0, 0, '', '', 0, 0, 0, 0, '', '', '10', '', '', '', 0, 0, 0, 0, 0, 1),
(124, '广陵古城', 16, '燕尾帽', '', '一件用精美的蚕丝制成的白色帽子，呈现燕尾形状，常见于医护人士。', '', '防具', '4', 1, 50, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '1', '', '', 0, 0, 0, 0, 0, 1),
(125, '旧街', 1, '无刃之剑', '剑|sword_0001', '这把剑由某种合金制成，没有开刃，但杀伤力很可怕。', '', '兵器', '1', 1, 600, 0, 0, '', '', 0, 0, 0, 0, '', '', '60', '', '', '', 0, 0, 0, 0, 0, 1),
(126, '未分区', 0, '榫卯弓', '', '一把榫卯结构的弓，复杂的工艺造就了惊人的穿透力。', '', '兵器', '11', 1, 3000, 0, 0, '', '', 0, 0, 0, 0, '', '', '70', '', '', '', 0, 0, 0, 0, 0, 1),
(127, '旧街', 1, '生锈的长矛', '', '生锈的一把长矛，不知道能扛住几下冲击。', '', '兵器', '18', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '6', '', '', '', 0, 0, 0, 0, 0, 1),
(128, '希望镇', 2, '《姗妮的书信》', '', '姗妮写给莉莉安的一封信，用书皮保护着，不知道上面写了什么。', 'to 亲爱的莉莉安:\r\n很抱歉上次的信使出了点意外，没能及时将消息传递给你，目前的局势是这样的：今年的异兽潮汐出现了异常波动，根据斥候小队的报告疑似宁静森林深处有个地方出现了异常信号波动，自那以后，各洲的商队听到风声草动也断了和希望镇的商贾行为，这件事最近我们也焦头烂额的，如果可以，还请姐姐你相助一臂之力。\r\nfrom 爱你的姗妮', '书籍', '书信', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(129, '未分区', 0, '@0061fe@海洋之心@end@', '', '传说中的一颗宝石，来自于神秘的海沟深处，隐藏着巨大的秘密。', '', '任务物品', '奇物', 1, 99999, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(130, '未分区', 0, '灵魂晶石', '', '一颗闪耀着奇异色彩的晶石，蕴藏着有关灵魂的秘密。', '', '任务物品', '晶石', 1, 9999, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(131, '旧街', 1, '变异野兽长衣', '', '一件用变异的野兽皮制成的长衣，拥有一定的防御能力。', '', '防具', '5', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '5', '', '', 0, 0, 0, 0, 0, 1),
(132, '旧街', 1, '@5e30eb@赛西的紫色发夹@end@', '', '赛西的紫色发夹，似乎有什么特别的含义。', '', '任务物品', '发夹', 1, 10, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(133, '旧街', 1, '@008cb4@K-M的破旧怀表@end@', '', 'K-M的破旧怀表，似乎藏着一段往事。', '', '任务物品', '怀表', 1, 10, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(134, '旧街', 1, '@831100@赫米特的红绳@end@', '', '赫米特的一段红绳，有一些岁月的痕迹。', '', '任务物品', '红绳', 1, 10, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(135, '未分区', 0, '石炭', '', '一块黑乎乎的石炭。', '', '其它', '素材', 1, 10, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(136, '未分区', 0, '@785800@蛤蜊罐头@end@', '', '吃起来就像婴儿的呕吐物，应该没人喜欢吃这东西。', '', '消耗品', '罐头', 1, 20, 0, 0, '', '', 0, 0, 0, 0, 'hp', '50', '', '', '', '', 0, 0, 0, 0, 0, 1),
(137, '未分区', 0, '@583300@青铜项链@end@', '', '用青铜打造而成的项链。', '', '防具', '8', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '5', '', '', 0, 0, 0, 0, 0, 1),
(138, '黑雾城', 6, '@61187c@黑雾酿@end@', '', '黑雾城特有的佳酿，以黑雾熏制黑夜草，采用独特工艺制成。', '', '消耗品', '1', 1, 500, 0, 0, '', '', 0, 0, 0, 0, 'mp', '200', '', '', '', '', 0, 0, 0, 0, 0, 1),
(139, '未分区', 0, '@583300@变异棕熊皮@end@', '', '这是一张变异棕熊的皮毛，棕色上方有点点瘆人的紫斑。', '', '其它', '皮毛', 1, 100, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(140, '未分区', 0, '@5a1c00@野猪獠牙@end@', '', '一颗狂暴的野猪身上的恐怖獠牙，异常坚硬。', '', '其它', '牙齿', 3, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(141, '未分区', 0, '@000000@黑色兔毛@end@', '', '兔子变异成巨齿兔，毛发变得黝黑深邃粗糙，有不少价值。', '', '其它', '皮毛', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(142, '未分区', 0, '驱魔粉末', '', '赛西炼制的驱魔粉末，真是神奇的炼金术！', '', '任务物品', '魔药', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(143, '未分区', 0, '@01c7fc@幻.月华流光@end@', '', '一把神奇梦幻的法杖，通体浅金闪耀，镶嵌着一颗巨大的钻石。', '', '兵器', '13', 1, 200000, 0, 0, '', '', 0, 0, 0, 0, '', '', '600', '', '', '', 0, 0, 0, 0, 0, 1),
(144, '未分区', 0, '@0061fe@变异蓝蝶后的翅膀@end@', '', '这是一对变异蓝蝶后的翅膀，是深蓝色的触感下的一双庞大的翅膀。', '', '其它', '翅膀', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(145, '未分区', 0, '@000000@变异杀人蜂王的尾针@end@', '', '这是一根变异杀人蜂王的尾针，黑色的表面传来丝丝的危险。', '', '其它', '尾针', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(146, '未分区', 0, '@263e0f@变异巨齿虎王的利齿@end@', '', '这是一颗变异巨齿虎王的牙齿，墨绿色下尽显王霸之气。', '', '其它', '牙齿', 1, 500, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(147, '未分区', 0, 'P-02手枪', '', 'p-01手枪加强版型号，单发伤害稳定射速较快，不是一般人能拥有的。', '', '兵器', '3', 1, 5000, 0, 0, '', '', 0, 0, 0, 0, '', '', '75', '', '2', '', 23, 0, 0, 0, 0, 1),
(148, '宁静森林', 27, '@d19d01@变异银杉树的汁液@end@', '', '一滴暗金色的变异银杉树汁液，隐约能看到一棵细小的银杉树在其中紊动。', '', '任务物品', '汁液', 1, 10000, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(149, '未分区', 0, '@d357fe@欧念@end@', '', '洋葱味的汽水饮料，醉生梦死的上头感，和这个时代一样，当一切都失去了意义的时候，逃避不失为一种好办法。', '', '消耗品', '饮料', 1, 5, 0, 0, '', '', 0, 0, 0, 0, 'hp', '10', '', '', '', '', 0, 0, 0, 0, 0, 1),
(150, '宁静森林', 27, '@7a219e@变异毒蛙的毒液@end@', '', '一滴暗紫色的变异毒蛙的毒液，蕴含剧毒，最好不要随便碰。', '', '任务物品', '毒液', 1, 200, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(151, '未分区', 0, '路易斯荣誉', '', '路易斯的荣耀。', '', '兵器', '15', 1, 1000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(152, '未分区', 0, '嗜血的战吼', '', '', '', '兵器', '14', 0, 0, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(153, '未分区', 0, '琥珀红宝石', '', '', '', '兵器镶嵌物', '宝石', 1, 1314458, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(154, '未来城', 3, '中级身份芯片', '', '「碧翠丝」曾经的身份芯片。', '', '其它', '芯片', 1, 66666, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(155, '未分区', 0, '奇怪的石头', '', '一颗不规则的石头，普普通通，实在想不到有什么用途，保险起见还是留着吧。', '', '其它', '奇物', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(156, '未分区', 0, '@01c7fc@初级魔纹石@end@', '', '一块初级的魔纹石，杂质含量略多，似乎拥有超自然的力量。', '', '其它', '魔纹石', 1, 10000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(157, '未分区', 0, '@0061fe@中级魔纹石@end@', '', '一块中级的魔纹石，杂质含量一般，似乎拥有超自然的力量。', '', '其它', '魔纹石', 1, 50000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(158, '未分区', 0, '@5e30eb@高级魔纹石@end@', '', '一块高级的魔纹石，杂质含量很少，似乎拥有超自然的力量。', '', '其它', '魔纹石', 1, 200000, 0, 0, '1', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(159, '未分区', 0, '@be38f3@特级魔纹石@end@', '', '一块特级的魔纹石，杂质含量几乎没有，似乎拥有超自然的力量。', '', '其它', '魔纹石', 1, 500000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(160, '未分区', 0, '@2e063d@究极魔纹石@end@', '', '一块究极的魔纹石，没有杂质，拥有超自然的力量。', '', '其它', '魔纹石', 1, 1000000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(161, '旧街', 1, '超威实验身份卡', '', '一块不知名合金做成的矩形卡片，上面刻着{eval(v(u.modify_future_card)==1?v(u.name):\"卡尔.森维\")}的名字。', '', '任务物品', '卡片', 1, 10000, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(162, '旧街', 1, '@ee719e@蒂娜的手帕@end@', '', '蒂娜的手帕，散发着淡淡的幽香。', '', '任务物品', '手帕', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(163, '未分区', 0, '@1a0a52@涌动之石@end@', '', '一颗黑紫色石头，里面似乎蕴藏规则的力量。', '', '其它', '奇物', 1, 1, 1, 1, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(164, '希望镇', 2, '@ff4015@草莓@end@', '', '新大陆发现的一种水果，营养丰富外形美丽，美味又健康。', '', '消耗品', '水果', 1, 10, 0, 0, '', '', 0, 0, 0, 0, 'hp', '20', '', '', '', '', 0, 0, 0, 0, 0, 1),
(165, '智慧山脊', 11, '@b51a00@烈焰风暴@end@', '', '银月人将椰枣和葡萄发酵后的原液放入特制的蒸馏设备，经过多道工序后最终加入甜菜根汁，这便是大名鼎鼎的烈焰风暴啦。', '', '消耗品', '饮料', 1, 50, 0, 0, '', '', 0, 0, 0, 0, 'hp', '100', '', '', '', '', 0, 0, 0, 0, 0, 1),
(166, '广陵古城', 16, '@563d00@东荒@end@', '', '「东之濯濯，八荒绰绰」，传说是欧冶子一次机缘巧合所锻造而成的一件披风，镇压诸风。', '', '防具', '17', 1, 30000, 0, 0, '', '', 0, 0, 0, 0, '', '', '', '20', '', '', 0, 0, 0, 0, 0, 1),
(167, '', 0, '测试物品', '', '1', '', '其它', '测试', 1, 1, 1, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1),
(168, '', 0, '测试物品2', '', '2', '', '其它', '测试', 2, 2, 1, 0, '', '', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 1);

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

--
-- 转存表中的数据 `system_item_op`
--

INSERT INTO `system_item_op` (`belong`, `id`, `show_cond`, `name`, `link_event`, `link_task`) VALUES
(158, 1, '', '吸取能量', '166', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `system_item_type`
--

CREATE TABLE `system_item_type` (
  `itid` int(11) NOT NULL,
  `itpos` int(11) NOT NULL,
  `itname` varchar(255) NOT NULL,
  `itfather` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

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
  `mis_signal_block` tinyint(1) NOT NULL DEFAULT '0',
  `mhide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `system_map`
--

INSERT INTO `system_map` (`mid`, `mname`, `mitem`, `mitem_now`, `mnpc`, `mnpc_now`, `mgtime`, `mpick_time`, `mrefresh_time`, `mphoto`, `mdesc`, `mup`, `mdown`, `mleft`, `mright`, `marea_name`, `marea_id`, `mop_target`, `mtask_target`, `mcreat_event_id`, `mlook_event_id`, `minto_event_id`, `mout_event_id`, `mminute_event_id`, `mshop`, `mhockshop`, `mshop_item_id`, `mkill`, `mstorage`, `mtianqi`, `mdire`, `mis_tp`, `mtp_type`, `mis_rp`, `mrp_id`, `mis_shield`, `mis_signal_block`, `mhide`) VALUES
(225, '旧街广场', '', '', '11|1|,13|1,46|{r.3}+2', '11|1|,13|1|,46|3|', '2025-04-23 19:57:00', '0000-00-00 00:00:00', 1, '旧街|map001_center', '地面上凌乱不堪的各种垃圾堆放着，石阶上还有几个流浪汉在呼呼大睡。', 296, 294, 295, 226, '旧街', 1, '1', '', 0, 0, 0, 0, 0, 0, 0, '1|1,2|1', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(226, '旧街东路', '4|{r.2}+1', '4|1', '46|{r.3}+2', '46|2|', '2025-04-23 19:55:08', '0000-00-00 00:00:00', 1, '', '这边相对比较开阔了一些，路两边也开设了一些店铺。', 299, 300, 225, 228, '旧街', 1, '2', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(228, '旧街东出口', '', '', '46|{r.3}+2', '46|2|', '2025-04-22 17:53:11', '0000-00-00 00:00:00', 1, '', '说是出口，不过是由铁丝网围起来的一个通道。', 297, 576, 226, 229, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(229, '小树林', '10|{r.3}+1,16|{r.2}', '10|2,16|0', '', '', '2025-04-22 17:53:09', '0000-00-00 00:00:00', 1, '', '这里的树木普遍低矮，几处灌木丛里还散发着不可描述的味道。', 305, 575, 228, 230, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(230, '湖堤', '', '', '18|{r.5}+2', '18|4|', '2025-04-22 17:53:05', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感。', 630, 672, 229, 232, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(231, '乱石堆', '15|{r.4}+1', '15|1', '46|{r.3}+2', '46|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里不知道为什么会有一堆乱石，大的小的，形状各异。', 0, 0, 230, 232, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(232, '湖泊边缘', '', '', '18|{r.3}+2', '18|2|', '2025-04-22 17:52:59', '0000-00-00 00:00:00', 1, '', '勉强能站人的一处平地，眼前的湖泊里，像石油一样颜色的水浆在其中咕噜翻滚，{eval(v(u.fix_bridge)==1?\"你看到一座简陋的木质桥浮在眼前。\":\"你看着面前的断桥望而兴叹。\")}', 0, 0, 230, 0, '旧街', 1, '12,22,23', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(233, '荒野', '', '', '', '', '2025-04-18 21:24:56', '0000-00-00 00:00:00', 1, '', '荒寂的平原，些许病恹恹的不知名杂草，一块路牌随着风吹仿佛随时要倒下，上面标着一个往右的箭头，写着\"希望镇\"三个歪歪斜斜的字。', 559, 561, 560, 235, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(235, '希望镇入口', '', '', '23|{r.3}+1,45|{r.4}+2', '23|3|,45|5|', '2025-04-18 21:24:54', '0000-00-00 00:00:00', 1, '希望镇|map002_entrance', '为了抵御异变生物的侵蚀，人类建立了大大小小的聚集点，大部分中小规模的城镇只会拥有一个出入口。', 664, 318, 233, 0, '希望镇', 2, '14', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(236, '小镇西路', '', '', '23|{r.2}+1,45|{r.4}+2', '23|2|,45|4|', '2025-04-18 21:24:53', '0000-00-00 00:00:00', 1, '', '路两边被高高的铁网与外界隔绝开来，说是路其实就是由各种各样不规则的石块堆一起然后用黄沙铺平，毫无美感可言。', 0, 0, 235, 237, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(237, '希望镇西街', '', '', '14|1,23|{r 3}+1,45|{r.4}+2', '14|1|,23|1|,45|4|', '2025-04-18 21:24:52', '0000-00-00 00:00:00', 1, '', '这里就比较繁华了，路面用大理石铺成，再用紫砂点缀铺平，两旁是各种各样的工厂和农场。', 442, 604, 236, 238, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(238, '希望镇西街', '', '', '23|{r.3}+1,45|{r.4}+2,53|{r.4}+2', '23|1|,45|4|,53|2|', '2025-04-02 14:29:13', '0000-00-00 00:00:00', 1, '', '这里灯红酒绿，商品琳琅满目的，你都怀疑自己是不是在末世了。\r\n', 321, 320, 237, 239, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(239, '希望镇广场', '', '', '16|1,23|{r.3}+1,45|{r.4}+2', '16|1|,23|3|,45|2|', '2025-04-02 14:29:11', '0000-00-00 00:00:00', 1, '希望镇|map002_center', '这是一片方形广场，\r\n大约能容纳一两百人，路上行人衣着都比较讲究了，在广场中央伫立着一尊用大理石打造的雕像。', 322, 273, 238, 240, '希望镇', 2, '15', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(240, '希望镇东街', '', '', '23|{r.3}+1,45|{r.4}+2', '23|1|,45|3|', '2025-03-08 13:20:40', '0000-00-00 00:00:00', 1, '', '这里似乎是小镇的管理机构所在区域，设立了诸多机关。', 242, 316, 239, 241, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(241, '综合执法局', '', '', '23|{r.4}+2,45|{r.4}+2', '23|4|,45|2|', '2025-03-08 13:20:42', '0000-00-00 00:00:00', 1, '', '从这里可以进入综合执法局，此处守卫森严，最好不要随意走动，负责管理小镇大大小小的纠纷冲突问题。', 0, 0, 240, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(242, '希望医院', '', '', '76|1,23|{r.3}+1,45|{r.4}+2', '76|1|,23|1|,45|4|', '2025-03-08 13:20:45', '0000-00-00 00:00:00', 1, '', '规模中等的一所医院，看起来比较正规了，每天都在接受各种各样的病人。', 0, 240, 322, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(243, '关口检查站(皇后街)', '4|{r.3}', '4|0', '100|1|%7Bu.tasks.t24%7D%21%3D2', '100|1|%7Bu.tasks.t24%7D%21%3D2', '2025-02-08 02:32:58', '0000-00-00 00:00:00', 1, '', '这个站口过去就是皇后街了，戒备森严。', 0, 246, 497, 244, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(244, '八车大道', '', '', '', '', '2025-02-08 02:32:59', '0000-00-00 00:00:00', 1, '', '电镀砖铺成的可供八辆车同时并头行进的大道，来来往往的车辆横行于此，一侧是一条散发着恶臭的河流。', 673, 0, 243, 439, '未来城', 3, '', '', 0, 0, 154, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(245, '矿山', '', '', '', '', '2025-04-22 17:46:53', '0000-00-00 00:00:00', 1, '', '一座一座的矿山，年久失修后荒废了。', 0, 0, 715, 247, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(246, '盥洗室', '', '', '', '', '2025-01-09 17:31:22', '0000-00-00 00:00:00', 1, '', '位于关口检查站边上的一处盥洗室，一个有些年头的水龙头在模糊的镜子下缓慢地滴水。', 243, 0, 0, 0, '未来城', 3, '48', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(247, '矿洞', '', '', '', '', '2025-04-22 17:46:55', '0000-00-00 00:00:00', 1, '', '矿山往下探得洞穴，仿佛随时都会塌陷。', 0, 0, 245, 248, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(248, '荒树林', '', '', '', '', '2025-04-22 17:46:56', '0000-00-00 00:00:00', 1, '', '荒芜的一片稀疏树林，树叶颜色呈现出发黑的怪异颜色。', 0, 0, 247, 249, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(249, '枫叶林', '', '', '', '', '2025-04-22 17:46:57', '0000-00-00 00:00:00', 1, '', '何以寄萧萧？月落霜枫别梦寒。', 0, 0, 248, 250, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(250, '针叶林', '', '', '', '', '2025-04-22 17:46:57', '0000-00-00 00:00:00', 1, '', '一大片的针叶林。', 0, 0, 249, 251, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(251, '雪山山脚', '', '', '', '', '2025-04-22 17:46:58', '0000-00-00 00:00:00', 1, '', '你望着眼前的雪山，感受到了生命的渺小。', 0, 0, 250, 252, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雪天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(252, '雪山山腰', '', '', '', '', '2025-04-22 17:46:59', '0000-00-00 00:00:00', 1, '', '已经到达雪山的山腰了，好像能看到雪山顶的耀眼白光在照耀。', 0, 0, 251, 253, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雪天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(253, '渡河港口', '', '', '', '', '2025-04-22 17:47:00', '0000-00-00 00:00:00', 1, '', '', 0, 0, 252, 254, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(254, '生态农场', '', '', '', '', '2025-04-22 17:47:00', '0000-00-00 00:00:00', 1, '', '为了在恶劣的末世环境存活下去，科学家们绞尽脑汁设计了内循环的生态农场。', 0, 0, 253, 255, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(255, '枯树林', '', '', '', '', '2025-04-22 17:47:01', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 0, 0, 254, 256, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(256, '迷雾沼泽', '', '', '', '', '2025-04-22 17:47:02', '0000-00-00 00:00:00', 1, '', '不仅泥泞难行，而且迷雾萦绕的一片沼泽，极少有人踏入进去。', 257, 0, 255, 258, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '大雾', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(257, '无人山洞', '', '', '', '', '2025-04-22 17:47:03', '0000-00-00 00:00:00', 1, '', '', 0, 256, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(258, '暴风峡谷', '', '', '', '', '2025-04-22 17:47:05', '0000-00-00 00:00:00', 1, '', '这个峡谷终年暴风呼啸，似乎是在驱逐外来者。', 0, 0, 256, 259, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '暴风', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(259, '废水处理区', '', '', '', '', '2025-04-22 17:47:06', '0000-00-00 00:00:00', 1, '', '臭气熏天的废水处理片区，没有人能在这里长待。', 0, 0, 258, 260, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(260, '垃圾填埋场', '', '', '24|1', '24|1|', '2025-04-22 17:47:07', '0000-00-00 00:00:00', 1, '', '每天都会无数的垃圾被运到此处填埋。', 0, 0, 259, 261, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(261, '牧场', '', '', '', '', '2025-04-22 17:47:11', '0000-00-00 00:00:00', 1, '', '草长得很高，牧民和牛羊都去哪了。', 0, 0, 260, 262, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(262, '葡萄园', '', '', '', '', '2025-04-22 17:47:12', '0000-00-00 00:00:00', 1, '', '你能看到一些高科技设备在自动管理着这片葡萄园。', 0, 0, 261, 263, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(263, '迷雾小道', '', '', '', '', '2025-04-22 17:47:13', '0000-00-00 00:00:00', 1, '', '人迹罕见的一条小道，终年被迷雾所覆盖。', 0, 0, 262, 264, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '大雾', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(264, '火山峡谷', '', '', '', '', '2025-04-22 17:47:14', '0000-00-00 00:00:00', 1, '', '由活火山冲击出来的一座峡谷，甚是宏伟。', 0, 0, 263, 265, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '浓雾', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(265, '发光蘑菇林', '', '', '', '', '2025-04-22 17:47:15', '0000-00-00 00:00:00', 1, '', '这里远离人类聚居地，这种变异的发光蘑菇美丽又致命。', 0, 0, 264, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(266, '机械之门', '', '', '', '', '2025-04-22 17:47:17', '0000-00-00 00:00:00', 1, '', '一个由蒸汽作为动力的纯粹合金打造成的机械门，高大威猛，是黑雾城的进出通道之一，一艘巨大的机械船停留于此。', 0, 267, 0, 727, '黑雾城', 6, '50', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(267, '瘴气林地', '', '', '', '', '2025-04-22 17:47:21', '0000-00-00 00:00:00', 1, '', '这处充满瘴气的林地位于这座被诅咒的城市外的西南一角。', 266, 0, 631, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(268, '黑雾平原', '', '', '', '', '2023-10-12 17:03:03', '0000-00-00 00:00:00', 1, '', '浓浓的黑雾覆盖在这平原上，伸手不见五指。', 0, 266, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(269, '黑雾城中心', '', '', '', '', '2025-04-22 17:48:07', '0000-00-00 00:00:00', 1, '', '由一种很坚硬的灰色合金M-06打造成的一个平台，是黑雾城的中央枢纽。', 667, 728, 727, 270, '黑雾城', 6, '51', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(270, '黑雾城东', '', '', '', '', '2025-04-22 17:48:33', '0000-00-00 00:00:00', 1, '', '整条路都是用城中最先进的合金铺成，时不时有动能车来回通行。', 0, 0, 269, 271, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(271, '黑雾城东', '', '', '', '', '2025-04-22 17:48:34', '0000-00-00 00:00:00', 1, '', '十足的合金路，也是黑雾城最繁华的地带。', 0, 0, 270, 272, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(272, '疑问之门', '', '', '24|1,25|{r.4}+2|', '24|1|,25|3|', '2025-04-22 17:48:35', '0000-00-00 00:00:00', 1, '', '从城门往外看去能看到浓浓的黑雾覆盖着，看不清更远处的景色。', 0, 0, 271, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(273, '明日小区小路', '', '', '26|1,45|{r.4}+2', '26|1|,45|4|', '2025-04-18 21:24:42', '0000-00-00 00:00:00', 1, '', '这条路通向城镇里生活比较富裕的居民住处：明日小区，用的也是比较规整的大理石铺成。', 239, 319, 320, 316, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(274, 'GM工作室', '75|1,76|1,99|1', '75|1,76|1,99|1', '48|4|', '48|4|', '2025-04-23 19:35:40', '0000-00-00 00:00:00', 1, '', '你看到天空中卷起了数道长长的白云，风从四面八方涌来。~~~~~~\r\n{f(i1).name}', 490, 276, 278, 275, '未分区', 0, '17', '', 0, 116, 56, 150, 0, 0, 1, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(275, 'GM工作室2', '144|1,145|1,146|1', '144|1,145|1,146|1', '', '', '2025-04-22 21:14:33', '0000-00-00 00:00:00', 1, '', '1.远处的草原如同波浪般起伏，风掠过，带来阵阵青草的气息。\r\n2.天边的云被风推得飞快，似乎要追赶着落日。', 0, 0, 274, 0, '未分区', 0, '42', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(276, 'GM工作室3', '', '', '', '', '2025-04-22 21:14:33', '0000-00-00 00:00:00', 1, '', '{eval(v(e.boss_ltlz_flush))}', 274, 0, 0, 0, '未分区', 0, '39', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(278, 'GM工作室4', '', '', '', '', '2025-04-22 21:14:33', '0000-00-00 00:00:00', 1, '', '', 0, 0, 0, 274, '未分区', 0, '37', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(287, '帐篷内', '', '', '', '', '2025-04-23 19:54:49', '0000-00-00 00:00:00', 1, '', '这是你的帐篷内部。', 0, 0, 0, 0, '旧街', 1, '16', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 1, '晴天', '0,0,0', 0, 0, 0, 1, 1, 0, 0),
(294, '旧街南路', '', '', '46|{r.3}+2,50|1,52|1', '46|3|,50|1|,52|1|', '2025-04-23 19:57:21', '0000-00-00 00:00:00', 1, '旧街|map001_south', '旧街广场的南边通道，这里的房子看起来正常多了，有些许漂亮的砖瓦房矗立。', 225, 307, 306, 314, '旧街', 1, '6', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(295, '旧街西路', '', '', '49|1,46|{r.3}+2', '49|1|,46|4|', '2025-04-23 20:01:31', '0000-00-00 00:00:00', 1, '旧街|map001_west', '各种各样的棚户楼，简陋的帐篷。\r\n北面不远处有个临时市场，西面是一堵厚厚的墙壁，各种淤泥和腥臭味弥漫在此。', 298, 306, 0, 225, '旧街', 1, '10', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(296, '旧街北路', '8|{r.6}+2,4|{r.10}+1', '8|2,4|10', '46|{r.3}+2', '46|4|', '2025-04-22 21:00:50', '0000-00-00 00:00:00', 1, '', '这里已经不能算是路了，一片又一片的废墟。', 302, 225, 0, 299, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(297, '废弃铁皮房', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '一间四四方方的铁皮房子，用各种废铁搭成，风一吹，摇摇欲坠。', 0, 228, 0, 0, '旧街', 1, '5,13', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(298, '临时市场', '', '', '36|1,46|{r.3}+2,53|{r.3}+1', '36|1|,46|2|,53|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '旧街|map001_west_shop', '这个临时市场看起来已经存在了很久，流浪者和旧街居民以及异地商队来来往往。', 303, 295, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 1, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(299, '瓦尔金铁匠铺', '', '', '35|1,46|{r.3}+2', '35|1|,46|3|', '2025-04-22 17:50:06', '0000-00-00 00:00:00', 1, '', '这家铁匠铺的主人叫瓦尔金，年轻的时候在新世界闯荡过，好像得罪了什么人，隐居于此。', 0, 226, 296, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(300, '浮沉诊所', '', '', '17|1,59|1,46|{r.2}+1', '17|1|,59|1|,46|2|', '2025-04-22 17:50:11', '0000-00-00 00:00:00', 1, '', '不知道为什么这家诊所的主人要取一个这个名字。', 226, 0, 0, 576, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(302, '废墟', '4|{r.5}+2,8|{r.3}+1,9|{r.2}', '4|5,8|2,9|1', '46|{r.3}+2', '46|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 10, '', '一片狼藉的废墟，一个醒目的哨站就矗立在北方不远处。', 0, 296, 0, 304, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(303, '旧街北出口', '', '', '46|{r.3}+2,53|{r.3}+2', '46|4|,53|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '北出口很大，也是旧街与外界交流沟通的其中一条重要道路，居民们有时候会去不远处的灰青草地上狩猎异兽与过往商人交易换取信用币。', 308, 298, 530, 529, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(304, '废墟', '11|{r.5}+1', '11|1', '46|{r.3}+2', '46|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 30, '', '脏乱差，前方已经没有路了，偶尔还能见到几片闪着电光的废旧板子。', 0, 0, 302, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(305, '小树林', '10|{r.4}+2', '10|3', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这片小树林丝毫没有应有的生气，反而看起来死气沉沉，左手边被一圈铁丝网围住，隐约能看到里面的建筑。', 574, 229, 0, 630, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(306, '办事处', '', '', '', '', '2025-04-23 23:33:16', '0000-00-00 00:00:00', 1, '', '空无一人，不知道人都去哪了，很难想象这个破烂地方是个办公室。', 295, 0, 0, 294, '旧街', 1, '7,9', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(307, '旧街南出口', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '你透过缝隙能看到一条鹅卵石铺成的小路，但这个出口已经被废铁树枝啥的封死了。', 294, 0, 0, 0, '旧街', 1, '8', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(308, '灰青草地', '', '', '37|{r.3}+1', '37|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '地面是绿到发青的那种颜色，泥土，稀疏的杂草堆。', 338, 303, 538, 551, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(309, '暗道', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '办事处下方的暗道，黑乎乎的什么也看不见。', 0, 0, 0, 311, '旧街', 1, '11', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(311, '暗道', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '办事处下方的暗道，黑乎乎的什么也看不见。', 0, 0, 309, 339, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(314, '服装店', '', '', '41|1,46|{r.3}+2', '41|1|,46|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '安妮开的一家服装店。', 0, 0, 294, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 1, 0, '7|1,21|1,22|1,71|1', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(316, '镇长办公室', '', '', '75|1,23|{r.3}+1,45|{r.4}+2', '75|1|,23|1|,45|4|', '2024-11-22 12:24:47', '0000-00-00 00:00:00', 1, '', '只有德高望重且武艺高超的人才能竞选成为希望镇代理镇长，负责希望镇与外界的交流沟通。', 240, 0, 273, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(317, '安宁渡口', '', '', '34|{r.2}+1', '34|1', '2024-06-26 18:22:31', '0000-00-00 00:00:00', 1, '', '安宁城的渡口，来来往往的船只不断。', 447, 0, 446, 445, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '103,1,0', 1, 2, 0, 0, 0, 0, 0),
(318, '车队驿站', '', '', '97|1|,45|{r.4}+2,53|{r.5}+1', '97|1|,45|5|,53|2|', '2025-02-08 02:32:40', '0000-00-00 00:00:00', 1, '', '这里是希望镇来往于人类各个集聚点的商人或佣兵等车队的营地，只要付出足够的代价，就能随行车队。', 235, 0, 0, 0, '希望镇', 2, '46', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '120,30,0', 0, 0, 0, 1, 0, 0, 0),
(319, '明日小区北门', '', '', '45|{r.4}+2', '45|4|', '2025-04-18 21:24:41', '0000-00-00 00:00:00', 1, '', '这里是希望镇明日小区的北门，中规中矩又不失威仪。', 273, 492, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(320, '大型集市', '', '', '45|{r.4}+2,53|{r.3}+2|', '45|4|,53|2|', '2025-04-18 21:24:43', '0000-00-00 00:00:00', 1, '', '这里集聚了大大小小的商贩，有流动摊贩也有门店摊贩，卖着各式各样的东西。', 238, 0, 604, 273, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 1, 1, '55|99,62|1,65|1,49|1', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(321, '希望教堂', '', '', '47|1,45|{r.3}+1', '47|1|,45|3|', '2025-04-02 14:29:14', '0000-00-00 00:00:00', 1, '', '在困境中的人们总是希望在心灵上得到一些寄托。', 438, 238, 442, 322, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(322, '希望镇北街', '', '', '69|{r.2}+1', '69|1|', '2025-03-02 15:23:39', '0000-00-00 00:00:00', 1, '', '这条街道往北走是居民和冒险者以及佣兵们排忧解难的地方。', 323, 239, 321, 242, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(323, '赌场', '', '', '69|{r.2}+2', '69|3|', '2025-03-02 15:23:36', '0000-00-00 00:00:00', 1, '', '末世的规则底线总是比较灵活的。', 496, 322, 438, 437, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(324, '流沙山谷', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '一条巨大的瀑布携带着无数的黄沙无时无刻地冲刷着这个山谷。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(325, '奇特溶洞', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '流水长年累月腐蚀出来的地貌，看了令人称奇。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(326, '迷失沙漠', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '真的会有人来到这里吗？', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '高温', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(327, '潮汐森林', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '涨潮时，森林隐藏，落潮时，森林浮现', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(328, '日落沼泽', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '日落的美景一览无遗，闻着沼泽上生长的芦苇的香气，能让人暂时忘记这末世的残酷。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(329, '深渊悬空池', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '真令人惊叹的自然现象！', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(330, '月光丛林', '', '', '', '', '2023-10-17 00:00:33', '0000-00-00 00:00:00', 1, '', '月光洒下，树木会泛出银白色的光芒，美极了。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(331, '白云崖', '', '', '', '', '2025-02-27 04:23:28', '0000-00-00 00:00:00', 1, '', '能依稀看到一个被厚厚的白云层掩盖住的深渊。', 546, 548, 547, 478, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(332, '栖霞山麓', '', '', '', '', '2025-02-27 04:23:39', '0000-00-00 00:00:00', 1, '', '栖霞山上有成片的枫树，深秋的栖霞，满山枫树长了红色的叶片。', 478, 473, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(333, '古藤林', '', '', '', '', '2024-09-24 00:43:28', '0000-00-00 00:00:00', 1, '', '碧绿的古藤，错综复杂。', 0, 0, 0, 0, '金陵古城', 9, '34', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(334, '百花谷', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '谷中百花盛开，宛若人间仙境', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(335, '飞瀑崖', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '飞流直下三千尺，疑似银河落九天。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(336, '星夜湖', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '听说以前的湖边会有一闪一闪的萤火虫，不知道那是什么样的一种景象呢？', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(337, '冰晶湖', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '这片湖面及湖四周都悬浮着冰晶，显然这里发生了奇异的变化。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(338, '灰青草地', '', '', '37|{r.3}+1', '37|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '地面是绿到发青的那种颜色，泥土，稀疏的杂草堆，隐约往东北方向仿佛能看到水的反光。', 346, 308, 539, 0, '旧街', 1, '38', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(339, '暗道', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '办事处下方的暗道，眼前似乎有一丝若隐若现的亮光。', 0, 482, 311, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(340, '秦淮渡口', '', '', '53|{r.3}+1', '53|2|', '2025-02-27 04:26:55', '0000-00-00 00:00:00', 1, '', '花船，商船数不胜数，秦淮河从此处流入了无边无际的东海。', 466, 448, 450, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '118,32,0', 1, 2, 0, 0, 0, 0, 0),
(341, '不冻港', '', '', '', '', '2023-10-19 21:11:43', '0000-00-00 00:00:00', 1, '', '这座港口终年不结冰，堪称是附近的一个奇迹。', 0, 0, 0, 0, '不夜之城', 12, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '37,55,0', 1, 2, 0, 0, 0, 0, 0),
(342, '奇迹港口', '', '', '110|1|', '110|1|', '2025-04-22 17:48:27', '0000-00-00 00:00:00', 1, '', '这是个充满了奇迹的港口，飞天的扫帚丶跳舞的船帆以及那唱歌的朗姆酒......', 0, 786, 0, 785, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '10,46,0', 1, 2, 0, 0, 0, 0, 0),
(343, '神圣港口', '', '', '', '', '2025-04-22 17:33:26', '0000-00-00 00:00:00', 1, '', '最古老又智慧的银月人从这里启航，迈向了向外交流的第一步，它在银月人心中有至高无上的地位。', 0, 0, 0, 851, '银月戈壁', 10, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '50,27,0', 1, 2, 0, 1, 0, 0, 0),
(344, '勘测港口', '', '', '', '', '2025-03-31 01:00:12', '0000-00-00 00:00:00', 1, '', '瓦兰人擅长勘测和算术，这个港口的每一个角度和长度都经过了精密的计算，因此得名。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '32,1,0', 1, 2, 0, 0, 0, 0, 0),
(346, '灰青草地', '', '', '37|4|', '37|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 5, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 347, 338, 552, 359, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(347, '灰青草地', '', '', '37|{r.3}+1', '37|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '左边被高大的山石挡住了，不知道里面有什么秘密。', 348, 346, 0, 360, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(348, '灰青草地', '', '', '37|{r.3}+1', '37|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 349, 347, 0, 361, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(349, '灰青草地', '', '', '37|{r.3}+1', '37|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 350, 348, 0, 362, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(350, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 351, 349, 0, 363, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(351, '灰青草地', '', '', '37|{r.3}+1', '37|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 352, 350, 0, 364, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(352, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 353, 351, 0, 365, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(353, '灰青草地', '', '', '37|{r.3}+1', '37|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 354, 352, 0, 366, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(354, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 355, 353, 0, 367, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(355, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 356, 354, 0, 368, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(356, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 357, 355, 0, 369, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(357, '灰青草地', '', '', '51|{r.4}+1', '51|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 358, 356, 0, 370, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(358, '灰青草地', '', '', '51|{r.4}+1', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 357, 0, 371, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(359, '小水池', '', '', '51|{r.4}+1', '51|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这片灰青草地中间的一个小水池，是许多野兽喝水的地方。', 360, 0, 346, 372, '旧街', 1, '19', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(360, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 361, 359, 347, 373, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(361, '灰青草地', '', '', '51|{r.4}+1', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 362, 360, 348, 374, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(362, '灰青草地', '', '', '57|{r.4}+1', '57|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 363, 361, 349, 375, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(363, '灰青草地', '', '', '51|{r.4}+1', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 364, 362, 350, 376, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(364, '灰青草地', '', '', '57|{r.4}+1', '57|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 365, 363, 351, 377, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(365, '灰青草地', '', '', '57|{r.4}+1', '57|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 366, 364, 352, 378, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(366, '灰青草地', '', '', '57|{r.4}+1', '57|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 367, 365, 353, 379, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(367, '灰青草地', '', '', '57|{r.4}+1', '57|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 368, 366, 354, 380, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(368, '灰青草地', '', '', '57|{r.4}+1', '57|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 369, 367, 355, 381, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(369, '灰青草地', '', '', '57|{r.4}+1', '57|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 370, 368, 356, 382, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(370, '灰青草地', '', '', '57|{r.4}+1', '57|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 371, 369, 357, 383, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(371, '灰青草地', '', '', '57|{r.4}+1', '57|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 370, 358, 384, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(372, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 373, 0, 359, 385, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(373, '灰青草地', '', '', '51|{r.3}', '51|0|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 374, 372, 360, 386, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(374, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 375, 373, 361, 387, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(375, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 376, 374, 362, 388, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(376, '灰青草地', '', '', '51|{r.3}', '51|0|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 377, 375, 363, 389, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(377, '灰青草地', '', '', '51|{r.3}', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 378, 376, 364, 390, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(378, '灰青草地', '', '', '51|{r.3}', '51|0|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 379, 377, 365, 391, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(379, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 380, 378, 366, 392, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(380, '灰青草地', '', '', '51|{r.3}', '51|0|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 381, 379, 367, 393, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(381, '灰青草地', '', '', '51|{r.3}', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 382, 380, 368, 394, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(382, '灰青草地', '', '', '51|{r.3}', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 383, 381, 369, 395, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(383, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 384, 382, 370, 396, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(384, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 383, 371, 397, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(385, '灰青草地', '', '', '51|{r.3}', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 386, 0, 372, 398, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(386, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 387, 385, 373, 399, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(387, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 388, 386, 374, 400, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(388, '灰青草地', '', '', '51|{r.3}', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 389, 387, 375, 401, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(389, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 390, 388, 376, 402, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(390, '灰青草地', '', '', '51|{r.3}', '51|0|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 391, 389, 377, 403, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(391, '灰青草地', '', '', '51|{r.3}', '51|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 392, 390, 378, 404, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(392, '灰青草地', '', '', '51|{r.3}', '51|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 393, 391, 379, 405, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(393, '灰青草地', '', '', '57|{r.4}+1', '57|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 394, 392, 380, 406, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(394, '灰青草地', '', '', '57|{r.4}+1', '57|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 395, 393, 381, 407, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(395, '灰青草地', '', '', '57|{r.4}+1', '57|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 396, 394, 382, 408, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(396, '灰青草地', '', '', '57|{r.4}+1', '57|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 397, 395, 383, 409, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(397, '灰青草地', '', '', '57|{r.4}+1', '57|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 396, 384, 410, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(398, '灰青草地', '', '', '57|{r.4}+1', '57|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 399, 0, 385, 411, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(399, '灰青草地', '', '', '57|{r.4}+1', '57|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 400, 398, 386, 412, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(400, '灰青草地', '', '', '57|{r.4}+1', '57|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 401, 399, 387, 413, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(401, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 402, 400, 388, 414, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(402, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 403, 401, 389, 415, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(403, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 404, 402, 390, 416, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(404, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 405, 403, 391, 417, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(405, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 406, 404, 392, 418, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(406, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 407, 405, 393, 419, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(407, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 408, 406, 394, 420, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(408, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 409, 407, 395, 421, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(409, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 410, 408, 396, 422, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(410, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 409, 397, 423, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(411, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 412, 0, 398, 424, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(412, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 413, 411, 399, 425, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(413, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 414, 412, 400, 426, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(414, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 415, 413, 401, 427, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(415, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 416, 414, 402, 428, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(416, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 417, 415, 403, 429, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(417, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 418, 416, 404, 430, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(418, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 419, 417, 405, 431, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(419, '灰青草地', '', '', '58|{r.3}+1', '58|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 420, 418, 406, 432, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(420, '灰青草地', '', '', '58|{r.3}+1', '58|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 421, 419, 407, 433, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(421, '灰青草地', '', '', '58|{r.3}+1', '58|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 422, 420, 408, 434, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(422, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 423, 421, 409, 435, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(423, '灰青草地', '', '', '58|{r.3}+1', '58|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 0, 422, 410, 436, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(424, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 425, 0, 411, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(425, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 426, 424, 412, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(426, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 427, 425, 413, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(427, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 428, 426, 414, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(428, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 429, 427, 415, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(429, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 430, 428, 416, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(430, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 431, 429, 417, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(431, '灰青草地', '', '', '55|{r.3}+1', '55|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 432, 430, 418, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(432, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 433, 431, 419, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(433, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 434, 432, 420, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(434, '灰青草地', '', '', '55|{r.3}+1', '55|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 435, 433, 421, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(435, '灰青草地', '', '', '55|{r.3}+1', '55|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这些半死不活的杂草是否也是这个时代普通人的归宿呢?', 436, 434, 422, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(436, '巨型洞穴', '', '', '56|1', '56|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 30, '', '这是一个天然的巨型洞穴，你仿佛能听到几声吼叫传来。', 0, 435, 423, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(437, '露天浴场', '', '', '45|{r.5}+5,69|{r.2}+1', '45|6|,69|2|', '2024-11-22 12:24:22', '0000-00-00 00:00:00', 1, '', '人们在这里欢呼洗漱，恍然忘记了身处的时代。', 0, 0, 323, 0, '希望镇', 2, '18', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(438, '末日剧场', '', '', '', '', '2025-03-02 15:23:35', '0000-00-00 00:00:00', 1, '', '氤氲的气氛，剧场上正在上演一幕又一幕悲怆的人类史诗。', 0, 321, 0, 323, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(439, '八车大道', '', '', '', '', '2025-02-08 02:33:01', '0000-00-00 00:00:00', 1, '', '电镀砖铺成的可供八辆车同时并头行进的大道，两边是高楼林立，前方是一座高架十字桥。', 0, 0, 244, 452, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(440, '智慧公会', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '瓦兰人打造的一个用于研究各种前沿领域的公会，吸引了来自各个地方的高智商人才。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(441, '真理图书馆', '', '', '', '', '2023-12-13 10:23:02', '0000-00-00 00:00:00', 1, '', '什么是真理?瓦罗人对知识的渴求已经到了要将一切世间真理纳入到这一所高耸入云的图书馆的地步。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(442, '公墓', '', '', '74|1', '74|1|', '2025-03-31 01:14:00', '0000-00-00 00:00:00', 1, '希望镇|map002_tomb', '一片阴冷的墓地，仿佛能听到魂灵在耳边的呢喃......', 0, 237, 0, 321, '希望镇', 2, '27', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(443, '壁炉旅馆', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '温暖的壁炉，带给每一位歇息的旅客些许的温暖。', 0, 0, 0, 0, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(444, '冲击港口', '', '', '', '', '2025-02-11 01:35:41', '0000-00-00 00:00:00', 1, '', '活火山喷出的岩浆在这个三角洲冷却形成了一个冲击平原，霍摩人在此用黑耀石修建了这样一个坚固的港口。', 0, 0, 0, 0, '熔岩山岭', 13, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '78,0,0', 1, 2, 0, 0, 0, 0, 0),
(445, '露天大型市场', '', '', '34|{r.3}+2,53|{r.5}+2,54|1', '34|4,53|4,54|1', '2023-10-29 15:45:22', '0000-00-00 00:00:00', 1, '', '来来往往的商人，旅客，当地的渔民......声声不绝的吆喝声，电子广播声，各种嘈杂的声音在这里汇集。', 0, 0, 317, 0, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(446, '滨海花园', '', '', '', '', '2023-11-14 00:09:30', '0000-00-00 00:00:00', 1, '', '安宁城的人们闲暇之余会来这个美丽祥和的花园散心。', 0, 0, 0, 317, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(447, '入城干道', '', '', '', '', '2023-11-14 10:35:06', '0000-00-00 00:00:00', 1, '', '从安宁渡口往安宁城方向的一条主干道，用平整的混凝土铺成的八车通道，上方还有色彩各异的顶棚遮挡阳光。', 0, 317, 0, 0, '安宁之地', 7, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(448, '长乐露天市场', '', '', '', '', '2025-02-27 04:27:20', '0000-00-00 00:00:00', 1, '', '金陵城最大的市场，位于秦淮渡口附近，一边倚靠秦淮河，商贾林立，小贩叫卖声连绵不绝。', 340, 0, 449, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(449, '金陵市舶司', '', '', '', '', '2025-02-27 04:27:21', '0000-00-00 00:00:00', 1, '', '金陵城设立的市舶司分部，用于管理金陵对外贸易的大小事宜。', 450, 0, 0, 448, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(450, '夫子庙东入口', '', '', '', '', '2025-02-27 04:26:54', '0000-00-00 00:00:00', 1, '', '这里是夫子庙的东边入口，用青石铸成的一座牌坊之门，上书“古秦淮”，进去后是一个古玩街道。', 465, 449, 451, 340, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(451, '古玩街道', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '这是一条繁华的街道，两边的小摊上摆满了各式各样的古玩，人群络绎不绝。', 456, 0, 457, 450, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(452, '高架十字桥底', '', '', '', '', '2025-02-08 02:33:02', '0000-00-00 00:00:00', 1, '', '各种眩目的广告扑面而来，光污染在这里体现得淋漓尽致，再过去就是皇后街了。', 0, 0, 439, 453, '未来城', 3, '20', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(453, '皇后街西', '', '', '', '', '2025-02-08 02:33:03', '0000-00-00 00:00:00', 1, '', '皇后街的西边，分布着各种小吃和餐馆，是美食爱好者的天堂。', 771, 773, 452, 454, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(454, '十字广场', '', '', '106|1|%7Bc.hour%7D%3C22%26%26%7Bc.hour%7D%3E8', '106|1|%7Bc.hour%7D%3C22%26%26%7Bc.hour%7D%3E8', '2025-02-08 02:33:56', '0000-00-00 00:00:00', 1, '', '这里是皇后街的十字广场，车水马龙，人来人往，好不热闹。', 666, 726, 453, 625, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(455, '金陵南路', '', '', '', '', '2025-02-27 04:26:39', '0000-00-00 00:00:00', 1, '', '金陵城南边的大道，人声鼎沸，两旁是眼花缭乱的小摊和商铺。', 467, 465, 476, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(456, '乌衣巷', '', '', '', '', '2025-02-27 04:27:28', '0000-00-00 00:00:00', 1, '', '旧时王谢堂前燕，飞入寻常百姓家。', 0, 451, 463, 465, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(457, '雨花街道', '', '', '', '', '2025-02-02 18:06:03', '0000-00-00 00:00:00', 1, '', '驰道如砥。树以青槐，亘以绿水玄荫耽耽，清流潺潺。', 463, 458, 459, 451, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(458, '大报恩寺塔', '', '', '', '', '2025-02-02 18:06:04', '0000-00-00 00:00:00', 1, '', '这座寺庙香火不断，历史悠久，一座巨塔高耸入云。', 457, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(459, '贡院前广场', '', '', '', '', '2025-02-05 01:11:15', '0000-00-00 00:00:00', 1, '', '这里视野开阔，身后可以看到文庙丶贡院，身前有一条秦淮河支流缓缓淌过。', 460, 462, 461, 457, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(460, '金陵贡院', '', '', '', '', '2025-02-02 18:06:10', '0000-00-00 00:00:00', 1, '', '莘莘学子于此证己立志，渴望实现自己远大的抱负。', 0, 459, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(461, '文庙', '', '', '', '', '2025-02-02 18:06:08', '0000-00-00 00:00:00', 1, '', '祭拜先哲的场所，古朴恢弘端庄，香客络绎不绝。', 0, 0, 0, 459, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(462, '河岸小道', '', '', '', '', '2025-02-05 00:59:29', '0000-00-00 00:00:00', 1, '', '这里是秦淮河支流岸边的一条小路，可以看到有几艘花船停靠在岸边，而更多的花船则是在水上行进。', 459, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `system_map` (`mid`, `mname`, `mitem`, `mitem_now`, `mnpc`, `mnpc_now`, `mgtime`, `mpick_time`, `mrefresh_time`, `mphoto`, `mdesc`, `mup`, `mdown`, `mleft`, `mright`, `marea_name`, `marea_id`, `mop_target`, `mtask_target`, `mcreat_event_id`, `mlook_event_id`, `minto_event_id`, `mout_event_id`, `mminute_event_id`, `mshop`, `mhockshop`, `mshop_item_id`, `mkill`, `mstorage`, `mtianqi`, `mdire`, `mis_tp`, `mtp_type`, `mis_rp`, `mrp_id`, `mis_shield`, `mis_signal_block`, `mhide`) VALUES
(463, '殿前路', '', '', '', '', '2025-02-27 04:27:30', '0000-00-00 00:00:00', 1, '', '一条青石铺成的路，一直通往大成殿，往来的香客不少。', 464, 457, 0, 456, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(464, '大成殿', '', '', '', '', '2025-02-27 04:27:33', '0000-00-00 00:00:00', 1, '', '大成殿内陈设仿制旧世界的编钟、编磬等十五种古代祭孔乐器，定期有艺术团体在此进行古曲、雅乐演奏。', 0, 463, 0, 476, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(465, '秦淮路', '', '', '', '', '2025-02-27 04:26:53', '0000-00-00 00:00:00', 1, '', '一条宽敞的道路，旁边就是秦淮河，故此得名。', 455, 450, 456, 466, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(466, '秦淮河岸', '', '', '', '', '2025-02-27 04:27:17', '0000-00-00 00:00:00', 1, '', '秦淮河沿岸的一条道路，能一览秦淮河的风采。', 0, 340, 465, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(467, '金陵城中心', '', '', '', '', '2025-02-27 04:23:56', '0000-00-00 00:00:00', 1, '', '这是一片广阔的中心广场，各种各样的声音此起彼伏，连绵不绝......', 469, 455, 468, 470, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(468, '玄武大街', '', '', '', '', '2025-02-27 04:27:35', '0000-00-00 00:00:00', 1, '', '宽阔的玄武大街，这一条路的尽头可以看到著名的玄武湖，', 474, 476, 475, 467, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(469, '栖霞北路', '', '', '', '', '2025-02-27 04:23:45', '0000-00-00 00:00:00', 1, '', '这一条路通向美丽的栖霞山，来来往往的行人丶游客络绎不绝。', 471, 467, 0, 479, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(470, '江宁大街', '', '', '', '', '2025-02-27 04:24:01', '0000-00-00 00:00:00', 1, '', '这是一条宽阔的大街。', 0, 0, 467, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(471, '迈皋路', '', '', '', '', '2025-02-27 04:23:41', '0000-00-00 00:00:00', 1, '', '这里有一座著名的迈皋桥，再过去不远处就是栖霞山了。', 473, 469, 477, 472, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(472, '仙林路', '', '', '', '', '2025-02-27 04:23:42', '0000-00-00 00:00:00', 1, '', '这里是金陵的高等教育区域，分布着诸多高等学府。', 0, 479, 471, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(473, '栖霞山脚', '', '', '', '', '2025-02-27 04:23:40', '0000-00-00 00:00:00', 1, '', '栖霞山的山脚，能看到两旁种满的枫树正在随风舞动。', 332, 471, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(474, '长江大桥', '', '', '', '', '2025-02-27 04:28:09', '0000-00-00 00:00:00', 1, '', '从这里俯瞰这翻涌的长江，忽知世间须臾为何物。', 480, 468, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(475, '玄武湖畔', '', '', '', '', '2025-02-27 04:27:36', '0000-00-00 00:00:00', 1, '', '霜起千年，堤绝金陵。', 0, 0, 0, 468, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(476, '金陵驿站', '', '', '', '', '2025-02-27 04:27:34', '0000-00-00 00:00:00', 1, '', '这里是金陵最古老的驿站，早已不再使用，成为了一处观光的景点，瞻仰老金陵人过去的故事。', 468, 0, 464, 455, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '118,32,0', 0, 0, 0, 1, 0, 0, 0),
(477, '明德路', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '周边分布着大大小小的商铺和饭馆等，附近的学子闲暇之余会来此放松休息。', 0, 0, 0, 471, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(478, '栖霞山顶', '', '', '', '', '2025-02-27 04:23:34', '0000-00-00 00:00:00', 1, '', '漫天红叶与千年古刹在此相会，动人心魄。', 0, 332, 331, 484, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(479, '三元巷', '', '', '', '', '2025-02-27 04:23:44', '0000-00-00 00:00:00', 1, '', '星罗棋布的小巷子，承载着多少人几十年的回忆呢。', 472, 0, 469, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(480, '浦口栈道', '', '', '', '', '2025-02-27 04:28:10', '0000-00-00 00:00:00', 1, '', '长江与支流汇合的交界处，建于江上的一条玻璃栈道。', 0, 474, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(481, '三七八巷', '', '', '', '', '2024-08-26 20:29:56', '0000-00-00 00:00:00', 1, '', '人间烟火味，最抚凡人心。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(482, '鹅卵石小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '封死的南铁门恍然就在身后，看来这就是南铁门外的地方，一个不起眼的洞穴正新鲜着。', 0, 483, 0, 0, '旧街', 1, '21', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(483, '荒野', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '旧街外的郊野，异常凄凉。', 482, 486, 487, 485, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(484, '栖霞禅寺', '', '', '', '', '2025-02-27 04:23:37', '0000-00-00 00:00:00', 1, '', '一个神秘而庄严的地方,每一处都散发着崇高的气息。', 0, 0, 478, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(485, '荒野', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '你总感觉那风吹过杂草的声音异常得诡异。', 0, 505, 483, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(486, '荒野', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '荒无人烟的荒野，你感到一阵的凄凉。', 483, 488, 506, 505, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(487, '山洞', '', '', '79|1', '79|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这是一个不大的山洞，不过有点黑，要是有把火把就好了。', 0, 0, 0, 483, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(488, '枯树林', '10|{r.2}+1', '10|2', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 486, 502, 504, 503, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(489, '湖边荒原', '', '', '', '', '2025-04-22 17:52:31', '0000-00-00 00:00:00', 1, '', '不远处有座你费尽九牛二虎之力搭建起来的简易桥，眼前的凄凉从里透到外。', 0, 0, 232, 491, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(490, 'GM工作室5', '39|5,40|5,25|10,18|10', '39|5,40|5,25|10,18|10', '', '', '2025-04-22 21:14:33', '0000-00-00 00:00:00', 1, '', '1.你感受到一阵凉风拂过面颊，带着些许湿润。\r\n2.树叶随风轻轻摇曳，发出沙沙的声音。\r\n3.寒风呼啸而过，衣角被吹得猎猎作响。', 0, 274, 0, 0, '未分区', 0, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(491, '远古石道', '', '', '', '', '2025-04-22 17:52:46', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 0, 0, 489, 557, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(492, '明日小道', '', '', '71|{r.5}+2', '71|4|', '2025-04-18 21:24:34', '0000-00-00 00:00:00', 1, '', '明日小区的通道，由鹅卵石铺成。', 319, 495, 494, 493, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(493, '一号居民楼大厅', '', '', '45|{r.2}+1', '45|2|', '2025-04-02 14:27:18', '0000-00-00 00:00:00', 1, '', '这栋居民楼的外观有些陈旧了，整体看起来大约20层高。', 0, 0, 492, 0, '希望镇', 2, '28', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(494, '二号居民楼大厅', '', '', '71|0', '71|0|', '2025-04-18 21:24:36', '0000-00-00 00:00:00', 1, '', '这里是明日小区的二号楼，装修风格比一号楼新颖了一点，就是电梯还在维修之中。', 0, 0, 0, 492, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(495, '铁网大门', '', '', '23|2', '23|2|', '2025-04-18 21:24:39', '0000-00-00 00:00:00', 1, '', '你发现不能继续往里走了，从铁网的缝隙中你看到了一排的别墅矗立。', 492, 0, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(496, '风月楼', '', '', '', '', '2024-11-22 12:24:20', '0000-00-00 00:00:00', 1, '', '只谈风月不谈情，只羡鸳鸯不羡仙。', 0, 323, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(497, '恶土边缘驿站', '', '', '53|{r.3}+1|,99|{r.4}+2|', '53|2|,99|3|', '2025-02-08 02:32:47', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，由于较为平坦，又距离城中近，你能看到不少商队在此歇息。', 500, 498, 499, 243, '未来城', 3, '47,49', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(498, '恶土边缘', '', '', '99|{r.4}+2|', '99|4|', '2024-09-30 14:41:29', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，一道深深的沟壑阻挡了你的去路。', 497, 0, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(499, '恶土边缘', '', '', '99|{r.4}+2|', '99|3|', '2024-12-02 03:07:35', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，面前的沟壑散发着一股血与火的味道。', 501, 0, 0, 497, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(500, '恶土边缘', '', '', '', '', '2024-12-02 03:07:32', '0000-00-00 00:00:00', 1, '', '这里是荒凉的黄土地平原的边缘，一道铁丝网隔出了两个世界。', 0, 497, 501, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(501, '恶土边缘', '', '', '99|{r.4}+2|', '99|5|', '2024-12-02 03:07:33', '0000-00-00 00:00:00', 1, '', '零星的流浪者部族占据着这里。横行肆虐的资源盗采、着火的油井和触目惊心的污染构成了恶土的日常。', 0, 499, 0, 500, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(502, '枯树林', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 488, 566, 567, 565, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(503, '枯树林', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 505, 565, 488, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(504, '枯树林', '', '', '', '', '2025-04-22 14:19:28', '2024-09-12 07:47:59', 1, '', '干枯的树林，树叶都掉光了，偶尔有几棵松树矗立。', 506, 567, 0, 488, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 5, 0, 0, 0),
(505, '荒野', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '荒无人烟的荒野，你感到一阵的凄凉。', 485, 503, 486, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(506, '荒野', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '荒无人烟的荒野，你感到一阵的凄凉。', 0, 504, 0, 486, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(507, '钱塘渡口', '', '', '', '', '2025-03-31 00:56:51', '0000-00-00 00:00:00', 1, '', '海阔天空浪若雷，钱塘潮涌自天来，九曲之江在此汇入东海，各个国度来来往往的船只目不暇接。', 0, 512, 508, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '121,30,0', 1, 2, 0, 0, 0, 0, 0),
(508, '钱塘古道', '', '', '', '', '2025-02-27 04:29:29', '0000-00-00 00:00:00', 1, '', '这是一条颇具古色古香的石板路，旁边就是著名的钱塘江，她正在默默地积蓄力量，等待下一次的绽放。', 0, 509, 510, 507, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(509, '两浙路市舶司', '', '', '', '', '2025-03-31 00:56:54', '0000-00-00 00:00:00', 1, '', '这里是钱塘古城管理海外事务的机构。', 508, 0, 513, 512, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(510, '余杭古道', '', '', '', '', '2023-11-03 10:05:36', '0000-00-00 00:00:00', 1, '', '这里通往钱塘古城的余杭区，那是一片富饶的地区。', 0, 513, 511, 508, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(511, '余杭广场', '', '', '', '', '2023-11-03 10:12:13', '0000-00-00 00:00:00', 1, '', '商贩丶行人络绎不绝，摊点丶店铺星罗棋布，人声鼎沸，嘈杂得很。', 0, 0, 0, 510, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(512, '钱塘贸易市场', '', '', '', '', '2025-03-31 00:56:53', '0000-00-00 00:00:00', 1, '', '这里是一个巨大的露天市场，能看到许多的脚夫在搬运货物，来来往往。', 507, 0, 509, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(513, '西湖古道', '', '', '', '', '2025-03-31 00:56:56', '0000-00-00 00:00:00', 1, '', '这里通向著名的西湖，也是经济繁荣的地带。', 510, 514, 0, 509, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(514, '西湖堤岸', '', '', '', '', '2025-03-31 00:56:57', '0000-00-00 00:00:00', 1, '', '春夏秋冬，各有不同的美景，真可谓是人间天堂。', 513, 515, 517, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(515, '西湖堤岸', '', '', '', '', '2025-02-27 14:19:03', '0000-00-00 00:00:00', 1, '', '春夏秋冬，各有不同的美景，真可谓是人间天堂。', 514, 0, 518, 516, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(516, '雷峰塔', '', '', '', '', '2025-02-27 14:19:04', '0000-00-00 00:00:00', 1, '', '夕照山上雷峰塔，夕照山下西湖水。', 0, 0, 515, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(517, '灵隐大道', '', '', '', '', '2025-03-31 00:56:58', '0000-00-00 00:00:00', 1, '', '你从这条人山人海的街道上偶尔窥见不远处那座古色古香的千年寺庙。', 0, 0, 524, 514, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(518, '林荫小道', '', '', '', '', '2025-02-27 14:19:07', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 0, 520, 519, 515, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(519, '林荫小道', '', '', '', '', '2025-03-31 00:57:03', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 524, 521, 0, 518, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(520, '林荫小道', '', '', '', '', '2025-02-27 14:19:09', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 518, 0, 521, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(521, '林荫小道', '', '', '', '', '2025-03-31 00:57:05', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 519, 0, 522, 520, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(522, '林荫小道', '', '', '', '', '2025-03-31 00:57:06', '0000-00-00 00:00:00', 1, '', '静谧的林荫小道，很适合午后散步。', 523, 0, 0, 521, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(523, '龙井古村', '', '', '', '', '2025-03-31 00:58:47', '0000-00-00 00:00:00', 1, '', '这是一座拥有悠久历史的古村落，享誉天下的龙井茶就在此诞生。', 0, 522, 0, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(524, '灵隐寺', '', '', '', '', '2025-03-31 00:56:59', '0000-00-00 00:00:00', 1, '', '背靠北高峰，面朝飞来峰，这里诉说着许多悠久的故事和传说。', 525, 519, 526, 517, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(525, '梅园', '', '', '', '', '2025-02-27 14:18:58', '0000-00-00 00:00:00', 1, '', '梅花盛开的日子，有许多观光客会来此以酒会诗，以龙井会友。', 0, 524, 0, 0, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(526, '私塾', '', '', '', '', '2025-03-31 00:57:01', '0000-00-00 00:00:00', 1, '', '这座古旧的私塾不知道居住着什么人物。', 0, 0, 0, 524, '钱塘古城', 15, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(527, '广陵渡口', '', '', '', '', '2023-11-03 15:57:46', '0000-00-00 00:00:00', 1, '', '这里是广陵古城的渡口，也是金塘大运河与东海的交汇口。', 0, 0, 0, 0, '广陵古城', 16, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '119,32,0', 1, 2, 0, 0, 0, 0, 0),
(528, '刺桐渡口', '', '', '', '', '2024-08-31 08:51:36', '0000-00-00 00:00:00', 1, '', '这里是刺桐的渡口，繁华的样子用千帆万船来形容都不夸张。', 535, 0, 533, 534, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '118,24,0', 1, 2, 0, 0, 0, 0, 0),
(529, '北部哨站', '', '', '60|1,53|{r.3}+2', '60|1|,53|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '旧街设立在此的一个哨站，不仅是提防草地上可能出现的兽潮威胁，还是过往商队于此交换通商许可的地方。', 551, 0, 303, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(530, '灰土路', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里可以绕过灰青草地的危险，去到远方，依稀能看到土路上历经岁月洗礼的轮胎印。\r\n北方的北方是{f(o.exit_n.id).exit_n.name}', 538, 543, 550, 303, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(531, '天字渡口', '', '', '', '', '2025-01-14 18:59:28', '0000-00-00 00:00:00', 1, '', '楚庭海上贸易的起点，商贾之船来来往往，好不热闹。', 0, 0, 0, 0, '楚庭古城', 18, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '113,23,0', 1, 2, 0, 0, 0, 0, 0),
(532, '曼尼拉港口', '', '', '', '', '2023-11-29 00:29:46', '0000-00-00 00:00:00', 1, '', '曼尼拉城最大的港口，也是日出之东与日出之南往来的必经之路。', 0, 0, 0, 0, '曼尼拉城', 19, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '121,14,0', 1, 2, 0, 0, 0, 0, 0),
(533, '刺桐沿海市场', '', '', '', '', '2023-11-05 15:43:06', '0000-00-00 00:00:00', 1, '', '脚夫丶远道而来的商人，过往的行人，游客，贩卖海砺煎的小贩，纵是红尘如是也。', 0, 0, 0, 528, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(534, '刺桐市舶司', '', '', '', '', '2023-11-05 15:45:24', '0000-00-00 00:00:00', 1, '', '刺桐城管理对外事宜的机构。', 536, 0, 528, 0, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(535, '丰泽大道', '', '', '', '', '2023-11-05 15:47:05', '0000-00-00 00:00:00', 1, '', '这条大道连接着刺桐港口与刺桐城的丰泽区域，两边是高低不一的红砖厝。', 0, 528, 0, 536, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(536, '六胜石塔', '', '', '', '', '2023-11-05 15:45:24', '0000-00-00 00:00:00', 1, '', '据说是刺桐的第一个灯塔，指引着来来往往的船只进出刺桐港。', 0, 534, 535, 0, '刺桐古城', 17, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(537, '界港', '', '', '', '', '2023-11-13 23:50:07', '0000-00-00 00:00:00', 1, '', '浪速城海上贸易的重要港口。', 0, 0, 0, 0, '浪速古城', 20, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '135,34,0', 1, 2, 0, 0, 0, 0, 0),
(538, '灰土路', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里更窄了，左手边就是深不可测的悬崖，你可以看到右手边那片辽阔的草原，神秘又充满危险。', 539, 530, 0, 308, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(539, '灰土路', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '你可以看到右手边那片辽阔的草原，神秘又充满危险，你发现左手方向有一片迷雾。', 552, 538, 540, 338, '旧街', 1, '', '', 0, 0, 59, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(540, '迷雾小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了，往南一看就是万丈深渊。', 542, 0, 541, 539, '旧街', 1, '', '', 0, 0, 60, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(541, '迷雾小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了。', 553, 0, 0, 540, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(542, '迷雾小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了。', 0, 540, 553, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(543, '灰土路', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '前面就是一个悬崖了，你能透过一堵厚厚的混合金属的墙壁看到一个正在喧嚣的市场。', 530, 544, 545, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(544, '悬崖边', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来。', 543, 0, 549, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(545, '悬崖边', '', '', '', '', '2025-04-22 14:19:28', '2024-07-22 12:09:22', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来，你看到一个露天的铜矿立在那边。', 550, 549, 0, 543, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 1, 0, 0, 0),
(546, '白云崖', '', '', '', '', '2024-09-24 00:43:23', '0000-00-00 00:00:00', 1, '', '能依稀看到一个被厚厚的白云层掩盖住的深渊，以及几根巨大的古藤枝条的影子。', 0, 331, 0, 0, '金陵古城', 9, '33', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(547, '白云崖', '', '', '', '', '2025-02-02 18:05:25', '0000-00-00 00:00:00', 1, '', '这里是一个60度倾斜角的悬崖，往下俯瞰是一个被淡淡的白云层掩盖住的深渊。', 0, 0, 0, 331, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(548, '白云崖', '', '', '', '', '2025-02-27 04:23:31', '2025-02-02 18:05:19', 1, '', '能比较清晰看到一个被薄薄的白云层掩盖住的深渊，往东张望依稀能看到栖霞山麓的风景。', 331, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 4, 0, 0, 0),
(549, '悬崖边', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来。', 545, 0, 0, 544, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(550, '悬崖边', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里往下看深不见底，仿佛能听到几声奇怪的叫声从底下传来。', 0, 545, 0, 530, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(551, '旧街北部前线', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这里是旧街抵御灰青草地异兽潮的前线，依稀能闻到土地中的血腥味，可以看到一条长长的围栏隔开了旧街与灰青草地。', 0, 529, 308, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(552, '峡谷口', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '你左手边布满了迷雾，一片荆棘拦住了你的去路，前方是一个峡谷的入口，右手边是那片辽阔的草原，神秘又充满危险。', 555, 539, 0, 346, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(553, '迷雾小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这条用石灰铺成的小路上空遍布着迷雾，你感觉周围的灌木丛仿佛不太正常了。', 0, 541, 0, 542, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(554, '迷雾小屋', '', '', '61|1', '61|1|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '旧街|map_001_cloudroom', '一扇棕红色的木门，上面涂抹着奇特的不断旋转的阵法，一个烧红的壁炉，能看到火星正在跳动，铺满一地的红砖，摆放着不知名的瓶瓶罐罐，等等，这里为什么会有一个屋子！', 0, 0, 0, 0, '旧街', 1, '24,35', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(555, '幽谷小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上。', 0, 552, 568, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(556, '理想城中心', '', '', '', '', '2024-09-15 04:12:59', '0000-00-00 00:00:00', 1, '', '一个以人类理想为因构建的城市，这里是它的中心广场，矗立着一尊男人的雕像，上面刻着「维特鲁威」的名字。', 0, 0, 0, 0, '理想城', 5, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(557, '远古石道', '', '', '', '', '2025-04-22 17:52:48', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 629, 628, 491, 627, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(558, '那霸港', '', '', '', '', '2023-11-13 23:54:19', '0000-00-00 00:00:00', 1, '', '首里的重要港口，通过转口贸易赚取了巨额财富。', 0, 0, 0, 0, '首里古城', 21, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '128,26,0', 1, 2, 0, 1, 0, 0, 0),
(559, '荒野', '', '', '', '', '2025-04-02 14:29:25', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，右手边被严密的铁网牢牢锁住。', 658, 233, 564, 664, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(560, '荒野', '15|{r.3}+1', '15|2', '', '', '2025-04-18 21:25:05', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。', 564, 562, 563, 233, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(561, '荒野', '', '', '', '', '2025-04-18 21:24:57', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，能隐约看到不远处有块木牌矗立。', 233, 0, 562, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(562, '荒野', '', '', '77|1|%7Bu.tasks.t16%7D%3D%3D2%26%26%7Bu.tasks.t17%7D%21%3D2', '77|1|%7Bu.tasks.t16%7D%3D%3D2%26%26%7Bu.tasks.t17%7D%21%3D2', '2025-04-18 21:24:58', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，南边是一片辽阔的森林，危险且充满了未知。', 560, 603, 626, 561, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(563, '荒野', '', '', '', '', '2024-09-21 01:19:36', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。', 0, 0, 0, 560, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(564, '荒野', '', '', '', '', '2025-03-10 16:42:45', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草。', 652, 560, 0, 559, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(565, '枯树林', '', '', '', '', '2025-04-22 14:19:28', '2025-04-08 08:28:37', 1, '', '干枯的树林，树叶都掉光了，有几棵松木挺立在那边。', 503, 0, 502, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 5, 0, 0, 0),
(566, '枯树林', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了，再往南走就是一片危险的沼泽地，还是不要靠近好。', 502, 0, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(567, '枯树林', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '干枯的树林，树叶都掉光了。', 504, 0, 0, 502, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(568, '幽谷小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上。', 570, 0, 569, 555, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(569, '幽谷小径', '', '', '', '', '2025-04-22 14:19:28', '2025-02-28 01:51:32', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上，眼前是一条死路。', 0, 0, 0, 568, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 1, 2, 0, 0, 0),
(570, '幽谷小径', '', '', '67|{r.4}+5', '67|6|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上。', 571, 568, 572, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(571, '幽谷小径', '', '', '37|{r.4}+2', '37|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上，你隐约能看到一个亮光在前方。', 578, 570, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(572, '幽谷小径', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '四周被巨大的山峰挡住了去路，日光透过峡谷的开口照在这条小径上，前面已经没有路了。', 670, 0, 0, 570, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(574, '小树林边缘', '', '', '', '', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这片小树林丝毫没有应有的生气，反而看起来死气沉沉，左手边的铁丝网挡住了去路，一条小河从眼前穿过汇入了湖泊。', 0, 305, 0, 671, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(575, '小树林边缘', '', '', '', '', '2025-04-22 17:53:08', '0000-00-00 00:00:00', 1, '', '这里的树木普遍低矮，面前就是一条河，透过左边的混合金属栅栏还能隐约看到里面的行人。', 229, 0, 0, 672, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(576, '旧吧', '', '', '63|1,62|1,46|{r.5}+1', '63|1|,62|1|,46|1|', '2025-04-22 17:50:19', '0000-00-00 00:00:00', 1, '', '一家小酒吧，这里鱼龙混杂，透过东边的木制窗户外的被隔绝的金属栅栏往外看能看到一片小树林。', 228, 0, 300, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(578, '峡谷口', '', '', '77|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2,61|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2,79|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2', '77|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2,61|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2,79|1|%7Bu.tasks.t15%7D%3D%3D2%26%26%7Bu.tasks.t16%7D%21%3D2', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这个峡谷的一个出入口，外面是一片高大的森林，里面是神秘的山谷。', 579, 571, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(579, '迷雾森林', '', '', '66|{r.3}+3', '66|3|', '2025-04-18 21:29:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 580, 578, 0, 584, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '雾天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(580, '迷雾森林', '', '', '', '', '2025-04-18 21:29:14', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 581, 579, 0, 585, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(581, '迷雾森林', '', '', '', '', '2025-04-18 21:29:13', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 582, 580, 0, 586, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(582, '迷雾森林', '', '', '', '', '2025-04-18 07:56:40', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 583, 581, 0, 587, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(583, '迷雾森林', '', '', '', '', '2024-09-12 15:52:25', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来，左边一条十米宽的小河拦住了你的去路...', 0, 582, 0, 588, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(584, '迷雾森林', '', '', '72|{r.3}+2', '72|3|', '2025-02-28 17:36:15', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 585, 0, 579, 589, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(585, '迷雾森林', '', '', '', '', '2025-03-31 01:13:24', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 586, 584, 580, 590, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(586, '迷雾森林', '', '', '', '', '2025-04-18 21:29:12', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 587, 585, 581, 591, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(587, '迷雾森林', '', '', '', '', '2025-04-18 07:56:41', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 588, 586, 582, 592, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(588, '迷雾森林', '', '', '64|2', '64|2|', '2025-03-31 01:13:27', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 0, 587, 583, 593, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(589, '迷雾森林', '', '', '', '', '2024-09-17 07:38:45', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 590, 0, 584, 594, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(590, '迷雾森林', '', '', '64|{r.5}+1', '64|2', '2024-07-04 00:31:33', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 591, 589, 585, 595, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(591, '迷雾森林', '', '', '65|{r.2}+2', '65|3|', '2025-04-18 21:29:11', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 592, 590, 586, 596, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(592, '迷雾森林', '', '', '', '', '2025-04-18 21:29:09', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 593, 591, 587, 597, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(593, '迷雾森林', '', '', '64|1', '64|1|', '2025-03-31 01:13:27', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 0, 592, 588, 598, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(594, '迷雾森林', '', '', '', '', '2024-09-17 07:38:44', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 595, 0, 589, 599, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(595, '迷雾森林', '', '', '', '', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 596, 594, 590, 600, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(596, '迷雾森林', '', '', '64|3', '64|3', '2024-07-03 07:31:16', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 597, 595, 591, 601, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(597, '迷雾森林', '', '', '64|{r.2}+1', '64|2|', '2025-04-18 21:29:07', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 598, 596, 592, 602, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(598, '迷雾森林', '', '', '65|2', '65|2|', '2025-04-22 21:38:08', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 0, 597, 593, 603, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(599, '迷雾森林', '', '', '', '', '2024-09-17 07:38:43', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 600, 0, 594, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(600, '迷雾森林', '', '', '', '', '2024-09-17 07:38:43', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 601, 599, 595, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(601, '迷雾森林', '', '', '', '', '2024-09-17 07:38:41', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 602, 600, 596, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(602, '迷雾森林', '', '', '65|{r.2}+2', '65|3|', '2024-09-17 07:38:32', '0000-00-00 00:00:00', 1, '', '这是一片充满了迷雾的森林，能见度低，又时常有刺耳的嚎叫传来...', 603, 601, 597, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(603, '迷雾森林', '', '', '', '', '2025-04-18 21:25:14', '0000-00-00 00:00:00', 1, '', '这里是迷雾森林的边缘，不远处能看到一片平地...', 562, 602, 598, 0, '迷雾森林', 23, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(604, '生产中心广场', '', '', '70|1,45|{r.4}+2,23|{r.2}+2', '70|1|,45|5|,23|3|', '2025-04-18 21:24:44', '0000-00-00 00:00:00', 1, '', '这里是希望镇的生产区域，周围零零散散伫立着一些工厂和农场，生产着整个镇所需要的日用品和食物。', 237, 607, 608, 320, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(607, '希望轻工厂', '', '', '98|1|,71|{r.4}+3', '98|1|,71|3|', '2025-04-18 21:24:48', '0000-00-00 00:00:00', 1, '', '工厂是人类向自然的一种征服，这里是希望镇的先驱者们设立的轻型工厂，生产一些日用品等。', 604, 0, 609, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(608, '生态农场', '', '', '45|{r.3}+2,71|{r.4}+3', '45|4|,71|6|', '2025-04-18 21:24:46', '0000-00-00 00:00:00', 1, '', '为了在恶劣的末世环境存活下去，希望镇最初的工程师绞尽脑汁设计了这片可以内循环的生态农场。', 0, 609, 0, 604, '希望镇', 2, '30', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(609, '发电站', '', '', '73|1', '73|1|', '2025-04-18 21:24:47', '0000-00-00 00:00:00', 1, '', '这里利用生态农场的循环生物能以及居民区的沼气丶天上的部分时段的太阳能等进行发电，供给整个希望镇的电力需求。', 608, 0, 0, 607, '希望镇', 2, '31', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(611, '公寓小屋', '', '', '', '', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '这是你在希望小区的公寓小屋，小巧又精致。', 0, 0, 0, 0, '希望镇', 2, '25', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 1, '晴天', '0,0,0', 0, 0, 0, 1, 1, 0, 0),
(612, '公寓走廊', '', '', '45|{r.3}+1', '45|1|', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 621, 0, 613, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(613, '公寓走廊', '', '', '45|{r.3}+1', '45|1|', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 0, 612, 614, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(614, '公寓走廊(电梯口)', '', '', '45|{r.3}+1', '45|1|', '2025-03-31 16:31:50', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客，一部电梯正在匆忙地运转。', 0, 0, 613, 615, '希望镇', 2, '26', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(615, '公寓走廊', '', '', '45|{r.3}+1', '45|1|', '2025-03-31 01:18:31', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 616, 614, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(616, '公寓走廊', '', '', '45|{r.3}+1', '45|3|', '2025-03-31 01:18:33', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 615, 617, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(617, '公寓走廊', '', '', '45|{r.3}+1', '45|3|', '2025-03-31 01:18:34', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 616, 0, 618, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(618, '公寓走廊', '', '', '45|{r.3}+1', '45|1|', '2025-03-31 01:18:35', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 0, 619, 617, '希望镇', 2, '29', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(619, '公寓走廊', '', '', '45|{r.3}+1', '45|1|', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 0, 0, 621, 618, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(620, '公寓走廊', '', '', '45|{r.3}+1', '45|1|', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 612, 619, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(621, '公寓走廊', '', '', '45|{r.3}+1', '45|3|', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '这里是{u.tomorrow_1_floor}层公寓大厦的走廊，挺宽敞，走过许多形形色色的住客。', 612, 0, 0, 619, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(622, '海角港', '', '', '', '', '2025-01-14 19:00:15', '0000-00-00 00:00:00', 1, '', '这是一个得天独厚丶地理位置优越的港口，常常能看见过往的帆船忙碌。', 0, 0, 0, 0, '卡普斯镇', 24, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '18,-34,0', 1, 2, 0, 1, 0, 0, 0),
(623, '失落暗礁', '', '', '', '', '2024-06-24 21:41:05', '0000-00-00 00:00:00', 1, '', '水下似乎蕴藏着深不可测的秘密，一股骇人的气息从四方传来。', 0, 0, 0, 0, '亚特兰蒂斯', 25, '32', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '-11,21,0', 1, 2, 0, 1, 0, 0, 0),
(624, '基林迪尼港', '', '', '', '', '2024-06-28 08:10:09', '0000-00-00 00:00:00', 1, '', '这个繁华的港口为蒙巴萨的繁华提供了大量的贡献，年吞吐量惊人。', 0, 0, 0, 0, '蒙巴萨城', 26, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '39,-4,0', 1, 2, 0, 1, 0, 0, 0),
(625, '皇后街东', '', '', '104|1|', '104|1|', '2025-02-08 02:34:02', '0000-00-00 00:00:00', 1, '', '皇后街的东边，是一片广阔的住宅区，有零星几家流动摊贩。', 0, 0, 454, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(626, '荒野', '', '', '', '', '2025-04-18 21:25:10', '0000-00-00 00:00:00', 1, '', '荒寂的平原，病恹恹的不知名杂草，南边是一片辽阔的森林，危险且充满了未知。', 0, 0, 0, 562, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(627, '远古石道', '', '', '', '', '2025-04-22 17:52:54', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 0, 0, 557, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(628, '远古石道', '', '', '', '', '2025-04-22 17:52:52', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 557, 0, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(629, '远古石道', '', '', '', '', '2025-04-22 17:52:50', '0000-00-00 00:00:00', 1, '', '一股沧桑的感觉扑面而来，走在上面仿佛有一种历史的践踏感。', 0, 557, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(630, '湖堤', '', '', '18|{r.5}+1', '18|5|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感。', 671, 230, 305, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(631, '瘴气林地', '', '', '', '', '2025-01-13 03:05:12', '0000-00-00 00:00:00', 1, '', '这处充满瘴气的林地位于这座被诅咒的城市外的西南一角。', 0, 0, 0, 267, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(632, '姗妮的小屋', '', '', '68|1', '68|1|', '2025-03-31 01:18:39', '0000-00-00 00:00:00', 1, '', '「姗妮」居住的小屋，一半粉色的风格，另一半是蓝色的风格，棕色梯形沙发旁边还放着一只羊驼玩偶。', 618, 0, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 1, 0, 0),
(634, '宁静森林', '', '', '', '', '2025-04-02 14:29:34', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 635, 0, 665, 640, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(635, '宁静森林', '', '', '', '', '2025-04-02 14:29:33', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 636, 634, 0, 641, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(636, '宁静森林', '', '', '', '', '2025-04-02 14:29:32', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 637, 635, 0, 642, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(637, '宁静森林', '', '', '', '', '2025-04-02 14:29:46', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 638, 636, 0, 643, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(638, '宁静森林深处', '', '', '89|1|', '89|1|', '2025-04-02 14:29:46', '0000-00-00 00:00:00', 10, '', '这里的乔木更高大了，森林中偶有猛兽咆哮，远在天边近在眼前，一条小溪流淌而过，一座木桥岁月静好。', 639, 637, 698, 644, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(639, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 638, 0, 645, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(640, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 641, 0, 634, 646, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(641, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 642, 640, 635, 647, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(642, '宁静森林', '', '', '', '', '2025-04-02 14:29:32', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 643, 641, 636, 648, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(643, '宁静森林', '', '', '88|{r.3}+1|', '88|1|', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 644, 642, 637, 649, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(644, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 645, 643, 638, 650, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(645, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 644, 639, 651, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(646, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 647, 0, 640, 652, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(647, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 648, 646, 641, 653, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(648, '宁静森林', '', '', '', '', '2025-04-02 14:29:31', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 649, 647, 642, 654, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(649, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 650, 648, 643, 655, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(650, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 651, 649, 644, 656, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(651, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 650, 645, 657, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(652, '宁静森林', '', '', '', '', '2025-03-10 16:42:46', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 653, 564, 646, 658, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(653, '宁静森林', '', '', '', '', '2025-04-02 14:29:30', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 654, 652, 647, 659, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(654, '宁静森林', '', '', '', '', '2025-04-02 14:29:30', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 655, 653, 648, 660, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(655, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 656, 654, 649, 661, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(656, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 657, 655, 650, 662, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(657, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 656, 651, 663, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(658, '宁静森林', '', '', '', '', '2025-04-02 14:29:26', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 659, 559, 652, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(659, '宁静森林', '', '', '', '', '2025-04-02 14:29:27', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 660, 658, 653, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(660, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 661, 659, 654, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(661, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 662, 660, 655, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(662, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 663, 661, 656, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(663, '宁静森林', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '巨大的乔木遮蔽了太阳的光芒，森林中偶有虫鸣鸟叫，还有几声野兽低沉的咆哮。', 0, 662, 657, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(664, '荒野哨站', '', '', '23|3', '23|3|', '2025-02-16 01:17:49', '0000-00-00 00:00:00', 1, '', '希望镇设立在原野上的一处哨站，负责警示两片森林的异常。', 0, 235, 559, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(665, '铁索桥头', '', '', '', '', '2025-04-02 14:29:35', '0000-00-00 00:00:00', 1, '', '这座铁索桥摇摇欲坠，一看就年代久远，还是不要随便上去吧。', 0, 0, 0, 634, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(666, '皇后街北', '', '', '', '', '2025-02-08 02:33:55', '0000-00-00 00:00:00', 1, '', '皇后街的北部，这里是一些工厂的场地。', 767, 454, 771, 769, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(667, '黑雾城北', '', '', '', '', '2025-04-22 17:48:48', '0000-00-00 00:00:00', 1, '', '这里是黑雾城的北部，人声鼎沸，市场繁荣，许多变异异兽材料和物资在此交易。', 729, 269, 730, 0, '黑雾城', 6, '52', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(668, '真理之门', '', '', '61|1|%7Bu.ic.i88%7D%3D%3D1%26%26%7Bu.tasks.t30%7D%3D%3D0', '61|1|%7Bu.ic.i88%7D%3D%3D1%26%26%7Bu.tasks.t30%7D%3D%3D0', '2025-04-22 17:48:25', '0000-00-00 00:00:00', 1, '', '一扇充满了玄奥的暗色之门，每一个靠近其的人都会下意识得知它的名字，但当有人尝试触摸它的时候却总是发现咫尺天涯，无法触摸。', 728, 0, 0, 0, '黑雾城', 6, '65,66', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '阴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(669, '湖中小岛', '', '', '', '', '2024-08-26 23:43:51', '0000-00-00 00:00:00', 1, '', '玄武湖中心的一处小岛，视野开阔，妙趣横生，是许多文人雅士流连忘返的地方。', 0, 0, 0, 0, '金陵古城', 9, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(670, '木屋', '', '', '77|1|%7Bu.tasks.t15%7D%21%3D2', '77|1|%7Bu.tasks.t15%7D%21%3D2', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '这座神秘的山谷里为什么会立着这样一座木屋？', 0, 572, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(671, '湖堤', '', '', '18|{r.3}+4', '18|5|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感。', 0, 630, 574, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(672, '湖堤', '', '', '', '', '2025-04-22 17:53:06', '0000-00-00 00:00:00', 1, '', '站在黑黝黝的泥土往湖里看，这条湖不大不小，五米宽，水的颜色却是一种胶质的金属感，湖泊中的水蜿蜒从面前的小河流出。', 230, 0, 575, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(673, '嗜血巷', '', '', '103|{r.5}+2|', '103|3|', '2025-01-09 13:42:17', '0000-00-00 00:00:00', 1, '', '生存法则，无止境的斗争以及不断刷新的底线，FCPD的职员们最不想来的区域之一。', 674, 244, 675, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(674, '北工业路南集市', '', '', '', '', '2025-01-09 13:42:16', '0000-00-00 00:00:00', 1, '', '这里是北工业区广场南部的一个集市，熙熙攘攘，许多灰头盖脸的工人与精明的商贩正在交谈。', 759, 673, 676, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(675, '威利斯大厦大厅', '', '', '', '', '2025-01-09 03:30:28', '0000-00-00 00:00:00', 1, '', '威利斯大厦的大厅，躺着几个流浪汉，这是一座比较有年头的建筑了，因为租金便宜住着不少低收入者以及赛博成瘾者。', 0, 0, 0, 673, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(676, '迪赞尔17号街', '', '', '101|1|,61|1|%7Bu.tasks.t25%7D%3D%3D2%26%26%7Bu.tasks.t29%7D%3D%3D0', '101|1|,61|1|%7Bu.tasks.t25%7D%3D%3D2%26%26%7Bu.tasks.t29%7D%3D%3D0', '2025-01-09 13:42:08', '0000-00-00 00:00:00', 1, '', '灯红酒绿，廉价的酒精的气味以及粗糙的胭脂粉味，宣泄自己的好去处。\r\n「营业时间告示牌」：\r\n1.地上天堂：下午4点-凌晨4点开门\r\n...', 0, 0, 0, 674, '未来城', 3, '62', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(677, '赛西的梦中幻境', '', '', '81|{r.3}+1', '81|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '粉色的云团像水一般往上流动，蒲公英轻飘飘的，蓝紫相间的丝带突然出现又突然消失，留下天空中一抹淡淡的幻香。', 679, 0, 0, 0, '旧街', 1, '36', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '未知', '0,0,0', 0, 0, 0, 1, 1, 1, 0),
(678, '@01c7fc@马哈赞加湾@end@', '', '', '', '', '2025-03-31 01:01:35', '0000-00-00 00:00:00', 1, '', '一座像月亮一样的港湾，皎洁美丽，塞恩人相信这是月亮女神的赐予。', 0, 686, 0, 685, '塞恩古城', 29, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '46,-15,0', 1, 2, 0, 1, 0, 0, 0),
(679, '赛西的梦中幻境', '', '', '81|{r.4}+1', '81|3|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '粉色是这里唯一的旋律，奇幻的造物此起彼伏，美不胜收。', 0, 677, 683, 682, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '未知', '0,0,0', 0, 0, 0, 1, 1, 1, 0),
(682, '赛西的梦中幻境', '', '', '81|{r.3}+2', '81|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '粉色是这里唯一的旋律，奇幻的造物此起彼伏，美不胜收。', 0, 0, 679, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(683, '赛西的梦中幻境', '', '', '81|{r.3}+2', '81|2|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 1, '', '粉色是这里唯一的旋律，奇幻的造物此起彼伏，美不胜收。', 0, 0, 0, 679, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(685, '海滨小道', '', '', '', '', '2025-03-31 01:01:40', '0000-00-00 00:00:00', 1, '', '踏入这条小路时，仿佛走进了一个充满热带风情的画卷。小路两旁，郁郁葱葱的热带植物簇拥着，为您带来阵阵清新的海风。阳光透过树叶的缝隙洒在地面上，形成斑驳的光影，给人一种宁静而惬意的感觉。', 0, 0, 678, 0, '塞恩古城', 29, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0);
INSERT INTO `system_map` (`mid`, `mname`, `mitem`, `mitem_now`, `mnpc`, `mnpc_now`, `mgtime`, `mpick_time`, `mrefresh_time`, `mphoto`, `mdesc`, `mup`, `mdown`, `mleft`, `mright`, `marea_name`, `marea_id`, `mop_target`, `mtask_target`, `mcreat_event_id`, `mlook_event_id`, `minto_event_id`, `mout_event_id`, `mminute_event_id`, `mshop`, `mhockshop`, `mshop_item_id`, `mkill`, `mstorage`, `mtianqi`, `mdire`, `mis_tp`, `mtp_type`, `mis_rp`, `mrp_id`, `mis_shield`, `mis_signal_block`, `mhide`) VALUES
(686, '海滨小道', '', '', '', '', '2024-06-28 08:30:21', '0000-00-00 00:00:00', 1, '', '踏入这条小路时，仿佛走进了一个充满热带风情的画卷。小路两旁，郁郁葱葱的热带植物簇拥着，为您带来阵阵清新的海风。阳光透过树叶的缝隙洒在地面上，形成斑驳的光影，给人一种宁静而惬意的感觉。', 678, 0, 0, 0, '塞恩古城', 29, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(687, '测试导入图', '', '', '', '', '2024-09-15 00:48:52', '0000-00-00 00:00:00', 1, '', '测试描述', 0, 0, 0, 0, '希望镇', 2, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(688, '御剑阁', '', '', '', '', '2024-11-22 12:23:15', '0000-00-00 00:00:00', 1, '', '晨曦照耀古剑阁，剑影隐现于山岚中，古剑阁上，云卷云舒，犹如仙境一般，青石古径，踏步而过，凛冽剑气弥漫。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(689, '百花谷', '', '', '', '', '2024-08-31 09:02:06', '0000-00-00 00:00:00', 1, '', '谷中有百花，暗香蝶自来。熏得来人醉，何时也忘却。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(690, '望尘居', '', '', '', '', '2024-08-31 09:03:42', '0000-00-00 00:00:00', 1, '', '三界，四洲，尘与光，何处安居？', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(691, '碧云轩', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '一方砚台，一幅山水画，朝那画中一观，画中人亦朝你一观。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(692, '荷花亭', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '沿渚遍莳荷花，盖不知外界季节，却是终年仲夏酷暑，荷花盛开，香远溢清。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(693, '云霄阁', '', '', '', '', '2024-08-31 09:08:47', '0000-00-00 00:00:00', 1, '', '一处四方天井，周遭茶桌萦绕，井上一片云霄浮现。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(694, '蓝玉山', '', '', '', '', '2024-08-31 09:10:22', '0000-00-00 00:00:00', 1, '', '一座小山丘，远远望去，山上皆是蓝色玉石闪烁。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(695, '玄火洞', '', '', '', '', '2025-01-14 16:24:33', '0000-00-00 00:00:00', 1, '', '这洞深浅未知，洞内处处有无根玄火燃起。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(696, '明心过海', '', '', '', '', '2025-01-14 16:24:26', '0000-00-00 00:00:00', 1, '', '明心方能渡海，明恶方能向善。', 0, 0, 0, 0, '蓬莱仙岛', 30, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(697, '旧街广场(未命名)', '4|{r.3}+1', '4|1', '11|1|,13|1,46|{r.3}+2', '11|1|,13|1|,46|4|', '2025-04-22 14:19:28', '0000-00-00 00:00:00', 60, '旧街|map001_center', '地面上凌乱不堪的各种垃圾堆放着，石阶上还有几个流浪汉在呼呼大睡。', 0, 0, 0, 0, '旧街', 1, '', '', 0, 0, 0, 0, 0, 0, 0, '1|1,2|1', 0, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(698, '小木桥上', '', '', '', '', '2025-04-02 14:29:48', '0000-00-00 00:00:00', 1, '', '一座古老的小木桥，不知承载了多少人的回忆。', 0, 0, 699, 638, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(699, '小木桥边', '', '', '', '', '2025-04-02 14:31:58', '0000-00-00 00:00:00', 1, '', '一座古老的小木桥，周围能看到一片片百花盛开的山谷。', 701, 700, 702, 698, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(700, '百花谷边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '不远处就是一片片百花盛开的山谷，真可谓是「青山含黛百花谷,东风温煦芳草茸。桃李春心吐欲抱,溪流妙意静复轻。」', 699, 705, 0, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(701, '百花谷边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '不远处就是一片片百花盛开的山谷，真可谓是「青山含黛百花谷,东风温煦芳草茸。桃李春心吐欲抱,溪流妙意静复轻。」', 704, 699, 0, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(702, '繁花小道', '', '', '', '', '2025-04-02 14:31:59', '0000-00-00 00:00:00', 1, '', '一条由各种各样姹紫嫣红的鲜花铺成的小道，令人陶醉。', 0, 0, 703, 699, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(703, '繁花小道', '', '', '61|1|%7Bu.tasks.t20%7D%3D%3D1%26%26+%7Bu.tasks.t21%7D%21%3D2', '61|1|%7Bu.tasks.t20%7D%3D%3D1%26%26+%7Bu.tasks.t21%7D%21%3D2', '2025-04-02 14:32:00', '0000-00-00 00:00:00', 1, '', '一条由各种各样姹紫嫣红的鲜花铺成的小道，令人陶醉，一片荆棘林阻挡了去路，依稀能闻到沼泽的气息。', 0, 0, 0, 702, '宁静森林', 27, '40', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(704, '百花谷深处', '', '', '90|1|', '90|1|', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 10, '', '这里就是一片片百花盛开的山谷，正如诗句所言「青山含黛百花谷,东风温煦芳草茸。桃李春心吐欲抱,溪流妙意静复轻。」', 0, 701, 0, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(705, '百花谷深处', '', '', '91|1|', '91|1|', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 10, '', '这里就是一片片百花盛开的山谷，真可谓是「青山含黛百花谷,东风温煦芳草茸。桃李春心吐欲抱,溪流妙意静复轻。」', 700, 0, 0, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(706, '幽灵沼泽边缘', '', '', '95|{r.6}+1|', '95|2|', '2025-04-02 14:43:24', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，一旁有一个用火焰开辟出来的通道。', 708, 707, 710, 703, '宁静森林', 27, '43', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(707, '幽灵沼泽边缘', '', '', '95|{r.3}|', '95|0|', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 706, 725, 711, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(708, '幽灵沼泽边缘', '', '', '95|{r.6}+3|', '95|8|', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 0, 706, 709, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(709, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜，你见到一棵枯萎的树上{eval(v(u.remove_cathaya_1)==1?那个奇怪的结构黯淡无光，看来是已经关闭了。:一个奇怪的结构，闪着诡异的玄光。)}', 0, 710, 717, 708, '宁静森林', 27, '41', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(710, '幽灵沼泽中心', '', '', '92|1|,79|1|%7Bu.tasks.t20%7D%3D%3D1%26%26%7Bu.remove_cathaya%7D%3D%3D0', '92|1|,79|1|%7Bu.tasks.t20%7D%3D%3D1%26%26%7Bu.remove_cathaya%7D%3D%3D0', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，这里的落脚点更加狭隘了，随时都有可能陷进去，荆棘的婆娑声更加频繁了。', 709, 711, 712, 706, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(711, '幽灵沼泽中心', '', '', '96|1|', '96|1|', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，这里的落脚点更加狭隘了，随时都有可能陷进去，荆棘的婆娑声更加频繁了。', 710, 724, 721, 707, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(712, '幽灵沼泽中心', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，这里的落脚点更加狭隘了，随时都有可能陷进去，荆棘的婆娑声更加频繁了。', 717, 721, 719, 710, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(714, '落雪广场', '', '', '', '', '2024-11-28 06:04:05', '0000-00-00 00:00:00', 1, '', '这城市也怪，终年下雪。', 0, 0, 0, 0, '雪漫古城', 22, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(715, '湿地', '', '', '', '', '2025-04-22 17:46:52', '0000-00-00 00:00:00', 1, '', '广袤的湿地，是鸟类和两栖动物的天堂。', 0, 0, 716, 245, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(716, '古村落', '', '', '', '', '2025-04-22 17:46:49', '0000-00-00 00:00:00', 1, '', '一座古村落', 0, 0, 0, 715, '失落之地', 4, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(717, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜，你见到不远处一棵枯萎的树上{eval(v(u.remove_cathaya_1)==1?那个奇怪的结构黯淡无光，看来是已经关闭了。:一个奇怪的结构，闪着诡异的玄光。)}', 0, 712, 718, 709, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(718, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 0, 719, 0, 717, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(719, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 718, 720, 0, 712, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(720, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 719, 722, 0, 721, '宁静森林', 27, '45', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(721, '幽灵沼泽中心', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，这里的落脚点更加狭隘了，随时都有可能陷进去，荆棘的婆娑声更加频繁了。', 712, 723, 720, 711, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(722, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 720, 0, 0, 723, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(723, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜，一颗时而虚幻时而稳定的石块立在眼前。', 721, 0, 722, 724, '宁静森林', 27, '44', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(724, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 711, 0, 723, 725, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(725, '幽灵沼泽边缘', '', '', '', '', '2024-10-27 00:16:15', '0000-00-00 00:00:00', 1, '', '一片令人心悸的沼泽地，窄得可怜的落脚点飘忽不定，还有诡异的荆棘时不时乱窜。', 707, 0, 724, 0, '宁静森林', 27, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(726, '皇后街南', '', '', '103|{r.3}+1|', '103|2|', '2025-02-08 02:34:12', '0000-00-00 00:00:00', 1, '', '一扇厚厚的合金大门出现在了面前，这里不对一般人开放，时不时有几个重装警员巡逻而过。', 454, 0, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(727, '黑雾城西', '', '', '', '', '2025-04-22 17:47:41', '0000-00-00 00:00:00', 1, '', '黑雾城的西边，是一片繁华的居民区。', 730, 0, 266, 269, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(728, '黑雾城南', '', '', '', '', '2025-04-22 17:48:24', '0000-00-00 00:00:00', 1, '', '黑雾城的南边，是工厂和一些研究所以及军工的驻地。', 269, 668, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(729, '未定之门', '', '', '25|{r.3}+1|', '25|3|', '2025-04-22 17:48:50', '0000-00-00 00:00:00', 1, '', '这扇门造型奇特，用料非凡，铭刻了法术的印记，还结合了炼金术的合金性质，这扇门的整扇门连同附近的城墙一半是阳光的领域，另一半则是黑雾的领域。', 0, 667, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(730, '纳定之地', '', '', '', '', '2025-04-22 17:47:42', '0000-00-00 00:00:00', 1, '', '黑雾城中商税纳定的地方，来来往往有许多客商。', 0, 727, 0, 667, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(731, '斗金小道', '', '', '', '', '2025-04-22 17:47:47', '0000-00-00 00:00:00', 1, '', '这条路由黑月石铺成，其中夹杂着不少灰金石，既坚固又象征着美好的寓意。', 0, 0, 732, 667, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(732, '斗金小道', '', '', '', '', '2025-04-22 17:47:49', '0000-00-00 00:00:00', 1, '', '这条路由黑月石铺成，其中夹杂着不少灰金石，既坚固又象征着美好的寓意。', 733, 0, 0, 731, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(733, '樊楼', '', '', '', '', '2025-04-22 17:47:51', '0000-00-00 00:00:00', 1, '', '庭院酒楼，酒肴飘香，昼夜无休，灯火通明，颇为繁华。', 0, 732, 0, 0, '黑雾城', 6, '', '', 0, 0, 0, 0, 0, 1, 0, '138|1', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(734, '绝望囚牢307房', '', '', '77|1|%7Bu.open_future_prison%7D%3D%3D0', '77|1|%7Bu.open_future_prison%7D%3D%3D0', '2025-01-09 03:40:59', '0000-00-00 00:00:00', 1, '', '这里是未来城关押重大罪犯，赛博精神病，危险分子等的一个高级牢房，编号307。', 735, 0, 0, 0, '未来城', 3, '53', '', 0, 0, 0, 161, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(735, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:40:57', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 736, 734, 0, 738, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(736, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:40:56', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 737, 735, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(737, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:40:55', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 0, 736, 0, 742, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(738, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:41:02', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 0, 744, 735, 739, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(739, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:41:39', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 740, 0, 738, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(740, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:41:41', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 741, 739, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(741, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:41:42', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 0, 740, 742, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(742, '绝望囚牢三层过道', '', '', '', '', '2025-01-09 03:40:53', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢三层的一条过道，高科技锁死了人性的闪耀。', 0, 0, 737, 741, '未来城', 3, '54', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(743, '绝望囚牢二层过道', '', '', '', '', '2025-01-09 03:40:51', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢二层的一条过道，很靠近地表了，隐约能听到脚步声传来，似乎还在施工中。', 0, 0, 747, 746, '未来城', 3, '55', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(744, '绝望囚牢306房', '', '', '', '', '2025-01-09 03:41:03', '0000-00-00 00:00:00', 1, '', '这里是未来城关押重大罪犯，赛博精神病，危险分子等的一个高级牢房，编号306，不过是一间空牢房。', 738, 0, 0, 0, '未来城', 3, '56', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(746, '绝望囚牢二层过道', '', '', '', '', '2024-12-01 05:07:52', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢二层的一条过道，很靠近地表了，隐约能听到脚步声传来，似乎还在施工中。', 749, 0, 743, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(747, '绝望囚牢二层过道', '', '', '', '', '2025-01-09 03:41:49', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢二层的一条过道，很靠近地表了，隐约能听到头顶天花板的脚步声传来，转角有一道楼梯。', 748, 0, 0, 743, '未来城', 3, '57', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(748, '休息室', '', '', '', '', '2024-12-01 05:07:45', '0000-00-00 00:00:00', 1, '', '一间狱警休息的小房间，不大，灯光有些昏黄，凌乱的麻将散落在木桌上。', 0, 747, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(749, '杂物间', '', '', '', '', '2024-12-01 05:07:54', '0000-00-00 00:00:00', 1, '', '一间杂物间，充满了腐朽的气味。', 0, 746, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(750, '绝望囚牢一层楼梯口', '', '', '', '', '2025-01-09 03:41:51', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢一层的楼梯口，从这里可以进入下层。', 0, 0, 755, 751, '未来城', 3, '58', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(751, '绝望囚牢一层过道', '', '', '', '', '2024-11-30 09:22:44', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢一层的过道，空气中有种难闻的气味。', 752, 0, 750, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(752, '绝望囚牢一层过道', '', '', '', '', '2024-11-30 09:22:33', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢一层的过道，空气中有种难闻的气味。', 0, 751, 0, 753, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(753, '绝望囚牢一层过道', '', '', '', '', '2024-11-30 09:22:08', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢一层的过道，空气中有种难闻的气味。', 754, 0, 752, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(754, '实验室', '', '', '', '', '2024-11-30 09:22:31', '0000-00-00 00:00:00', 1, '', '绝望囚牢一层的一间实验室，充斥着各种稀奇古怪的设备。', 0, 753, 0, 0, '未来城', 3, '59', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(755, '绝望囚牢大门', '', '', '', '', '2025-01-09 03:41:53', '0000-00-00 00:00:00', 1, '', '这里是绝望囚牢一层的合金大门，采用特殊材质打造，是进入囚牢的唯一途径。', 0, 0, 756, 750, '未来城', 3, '60', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(756, '夜筱路', '', '', '', '', '2025-01-09 03:41:54', '0000-00-00 00:00:00', 1, '', '一条简朴的水泥路，均匀镶嵌着不少的鹅卵石。', 757, 758, 0, 755, '未来城', 3, '', '', 0, 0, 173, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(757, '夜筱路', '', '', '', '', '2025-01-09 03:41:58', '0000-00-00 00:00:00', 1, '', '一条简朴的水泥路，均匀镶嵌着不少的鹅卵石。', 0, 756, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(758, '夜筱路', '', '', '', '', '2025-01-09 03:41:56', '0000-00-00 00:00:00', 1, '', '一条简朴的水泥路，均匀镶嵌着不少的鹅卵石。', 756, 759, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(759, '北工业区十字路口', '', '', '', '', '2025-01-09 03:42:01', '0000-00-00 00:00:00', 1, '', '这里附近是未来城的北工业区，车水马龙，数不清的货车来来往往。', 758, 674, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(760, '珠帘大门口', '', '', '', '', '2025-01-09 03:12:59', '0000-00-00 00:00:00', 1, '', '「地上天堂」的大门口，一扇等身高得的大门用各类廉价的工业合成珠子装饰。', 761, 0, 0, 0, '未来城', 3, '61', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(761, '走廊', '', '', '', '', '2025-01-09 03:12:28', '0000-00-00 00:00:00', 1, '', '一条不大不小的走廊，充斥着酒味，烟味以及各种奢靡的气息。', 0, 760, 763, 762, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(762, '走廊', '', '', '', '', '2025-01-09 03:12:31', '0000-00-00 00:00:00', 1, '', '一条不大不小的走廊，充斥着酒味，烟味以及各种奢靡的气息。', 764, 0, 761, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(763, '走廊', '', '', '', '', '2025-01-03 04:03:42', '0000-00-00 00:00:00', 1, '', '一条不大不小的走廊，充斥着酒味，烟味以及各种奢靡的气息。', 766, 0, 0, 761, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(764, '走廊', '', '', '', '', '2025-01-09 03:12:32', '0000-00-00 00:00:00', 1, '', '一条不大不小的走廊，充斥着酒味，烟味以及各种奢靡的气息。', 0, 762, 765, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(765, '中央吧台', '', '', '102|1|', '102|1|', '2025-01-09 03:12:34', '0000-00-00 00:00:00', 1, '', '各色闪耀的霓虹灯，阵阵靡靡之音，舞池还有放肆的人们在释放自己。', 0, 0, 766, 764, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(766, '走廊', '', '', '', '', '2025-01-03 04:03:41', '0000-00-00 00:00:00', 1, '', '一条不大不小的走廊，充斥着酒味，烟味以及各种奢靡的气息。', 0, 763, 0, 765, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(767, '皇后街北', '', '', '', '', '2025-02-08 02:34:25', '0000-00-00 00:00:00', 1, '', '皇后街的北部，这里是一些工厂的场地。', 768, 666, 772, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(768, '沙鹰路', '', '', '', '', '2025-02-08 02:34:26', '0000-00-00 00:00:00', 1, '', '由于工厂长期违规排放对环境的破坏，雾霾，毒尘终年不散。', 770, 767, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(769, '绿色未来入口', '', '', '', '', '2024-12-29 07:26:11', '0000-00-00 00:00:00', 1, '', '这里是「绿色未来有限公司」的入口，是一个移动栅栏门，偶尔能听到保安室内传出的酣睡声。', 0, 0, 666, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(770, '沙鹰路', '', '', '', '', '2024-12-20 02:23:34', '0000-00-00 00:00:00', 1, '', '由于工厂长期违规排放对环境的破坏，雾霾，毒尘终年不散。', 0, 768, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(771, '圆梦购物广场', '', '', '', '', '2025-02-08 02:33:53', '0000-00-00 00:00:00', 1, '', '圆梦集团旗下的购物广场，人流众多，商品琳琅满目。', 0, 453, 0, 666, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(772, '北野垃圾场入口', '', '', '107|{r.2}+1|%7Bu.tasks.t27%7D%3D%3D0', '107|1|%7Bu.tasks.t27%7D%3D%3D0', '2025-02-08 02:34:31', '0000-00-00 00:00:00', 1, '', '这里是北野垃圾场的入口，一扇简易生锈的铁门随风吹动嗡嗡作响，{eval(v(u.tasks.t27)==2?门开着一道缝隙:大门紧闭着)}。', 0, 0, 0, 767, '未来城', 3, '63', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(773, '警署', '', '', '', '', '2025-02-08 02:33:05', '0000-00-00 00:00:00', 1, '', '未来城皇后街区的警署，戒备森严。', 453, 0, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(774, '黄沙小路', '', '', '', '', '2025-02-08 02:34:33', '0000-00-00 00:00:00', 1, '', '一条勉强能辨认出的黄沙小路，还时不时有尘土飞扬。', 775, 772, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(775, '黄沙小路', '', '', '', '', '2025-02-08 02:34:35', '0000-00-00 00:00:00', 1, '', '一条勉强能辨认出的黄沙小路，还时不时有尘土飞扬。', 776, 774, 0, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(776, '风沙走廊', '', '', '', '', '2025-02-08 02:34:36', '0000-00-00 00:00:00', 1, '', '用废铁等各种材料搭成的一个简易走廊，在风中呼呼作响。', 0, 775, 777, 0, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(777, '风沙走廊', '', '', '', '', '2025-02-08 02:35:50', '0000-00-00 00:00:00', 1, '', '用废铁等各种材料搭成的一个简易走廊，在风中呼呼作响。', 778, 0, 779, 776, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(778, '铁皮小屋', '', '', '105|1|', '105|1|', '2025-02-08 02:35:42', '0000-00-00 00:00:00', 1, '', '一间用各种废旧铁皮搭成的小屋，不时能听到嘈杂的声音传出。', 0, 777, 0, 0, '未来城', 3, '64', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(779, '风沙走廊', '', '', '', '', '2025-02-08 02:35:51', '0000-00-00 00:00:00', 1, '', '用废铁等各种材料搭成的一个简易走廊，在风中呼呼作响。', 0, 0, 780, 777, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(780, '鹰厅', '', '', '', '', '2025-02-08 02:35:53', '0000-00-00 00:00:00', 1, '', '秃鹰帮的大厅，会事的场所。', 0, 0, 0, 779, '未来城', 3, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(782, '洞察之坪', '', '', '', '', '2025-04-22 17:43:01', '0000-00-00 00:00:00', 1, '', '这个精妙绝伦的空中机坪展露了瓦兰人对天空的野心。', 0, 0, 0, 0, '纳米之都', 8, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '32,1,0', 1, 3, 0, 1, 0, 0, 0),
(783, '卡普斯坪', '', '', '', '', '2025-01-14 18:57:45', '0000-00-00 00:00:00', 1, '', '卡普斯镇的停机坪，看起来有点小，但功能应该是正常使用的。', 0, 0, 0, 0, '卡普斯镇', 24, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '18,-34,0', 1, 3, 0, 1, 0, 0, 0),
(784, '浮沉之港', '', '', '', '', '2025-04-22 17:39:04', '0000-00-00 00:00:00', 1, '', '天空之城的机港，各路飞行工具来来往往。', 0, 0, 0, 0, '天空之城', 14, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 1, 3, 0, 1, 0, 0, 0),
(785, '大理石路', '', '', '', '', '2025-04-22 17:31:58', '0000-00-00 00:00:00', 1, '', '一条用大理石铺成的洁白过道，连接着奇迹港口的方方面面，晌午时分，路面还会映射北面高大树木的影子。', 0, 790, 342, 788, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(786, '灯塔前径', '', '', '', '', '2025-04-22 17:36:36', '0000-00-00 00:00:00', 1, '', '这条用鹅卵石铺成的小路通向奇迹港口的最大灯塔，也就是银月人口中神圣无比的阿蕾莎。', 342, 787, 0, 790, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(787, '阿蕾莎灯塔口', '', '', '', '', '2025-04-22 17:34:20', '0000-00-00 00:00:00', 1, '', '这里是银月人心目中的神圣场所，守护着一代又一代银月人免受海妖以及风暴的侵袭。', 786, 0, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(788, '港口渔市北口', '', '', '', '', '2025-04-22 17:32:02', '0000-00-00 00:00:00', 1, '', '港口渔市的北面入口，这里更多的是运输魔车的呼啸声，将新鲜的产品以最快时间运往中心城市。', 0, 791, 785, 789, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(789, '黑金石路口', '', '', '', '', '2025-04-22 17:32:03', '0000-00-00 00:00:00', 1, '', '银月人相信黑金石能提高魔力传导的效率，这些花费巨资修建的道路便是为加快运输而生。', 0, 0, 788, 0, '智慧山脊', 11, '67', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(790, '港口渔市西口', '', '', '', '', '2025-04-22 17:36:35', '0000-00-00 00:00:00', 1, '', '奇迹港口渔市的西口，可以从这里进入喧闹的渔市。', 785, 800, 786, 791, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(791, '丰收市径', '', '', '', '', '2025-04-22 17:36:34', '0000-00-00 00:00:00', 1, '', '渔市的过道，许许多多的银月人在此兜售各种各样的海产品。', 788, 792, 790, 793, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(792, '丰收市径', '', '', '', '', '2025-04-22 17:36:33', '0000-00-00 00:00:00', 1, '', '渔市的过道，许许多多的银月人在此兜售各种各样的海产品，由于墙体的隔开，两边明显狭窄了不少。', 791, 794, 800, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(793, '丰收市径', '', '', '', '', '2025-03-31 00:49:11', '0000-00-00 00:00:00', 1, '', '渔市的过道，许许多多的银月人在此兜售各种各样的海产品，北面和东面被刻满禁纹的圆石墙隔开，避免黑金石的能量干扰。', 0, 0, 791, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(794, '港口渔市南门', '', '', '', '', '2025-04-22 17:36:33', '0000-00-00 00:00:00', 1, '', '南边的出口是用青夜石铸造而成的大门，这是为了纪念当年城门外的一场大战。', 792, 795, 799, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(795, '索非亚河滩', '', '', '', '', '2025-04-22 17:36:31', '0000-00-00 00:00:00', 1, '', '索非亚河是银月人的母亲河，这里是索非亚河与迷雾海的交界处，从码头的城镇蜿蜒而过，河滩上铺着一层银白色的细沙。', 794, 796, 798, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(796, '索非亚河滩', '', '', '', '', '2025-04-22 17:35:44', '0000-00-00 00:00:00', 1, '', '这里的河流更湍急了，河滩上铺着一层更厚的银白色的细沙。', 795, 0, 797, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(797, '索非亚河滩', '', '', '', '', '2025-01-18 02:23:37', '0000-00-00 00:00:00', 1, '', '这里的河流更湍急了，河滩上铺着一层更厚的银白色的细沙。', 798, 0, 0, 796, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(798, '河畔平地', '', '', '', '', '2025-03-31 00:49:03', '0000-00-00 00:00:00', 1, '', '远处的迷雾海，挡在身前的灯塔，潺潺而过的河流，闲暇时候，银月人便会汇聚于此来一次惬意的休息时光。', 799, 797, 0, 795, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(799, '河畔平地', '', '', '', '', '2025-03-31 00:48:59', '0000-00-00 00:00:00', 1, '', '这里有一座无名墓碑，是为了纪念一位曾经漂泊而来的异乡人。', 0, 798, 0, 794, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(800, '丰收市径', '', '', '', '', '2025-04-22 17:34:26', '0000-00-00 00:00:00', 1, '', '渔市的过道，许许多多的银月人在此兜售各种各样的海产品，由于墙体的隔开，两边明显狭窄了不少。', 790, 0, 0, 792, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(801, '银月西城枢纽', '', '', '', '', '2025-04-22 17:32:05', '0000-00-00 00:00:00', 1, '', '银月城西的一处交通枢纽，是与码头互通物资的重要通道，此刻正熙熙攘攘。', 0, 0, 0, 802, '智慧山脊', 11, '68', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(802, '银月西城城门', '', '', '', '', '2025-04-22 17:32:08', '0000-00-00 00:00:00', 1, '', '银月城西的拱形城门，通体采用大理石镶嵌月银石铸造而成，即使到了晚上仍然很光亮。', 0, 0, 801, 803, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(803, '白银西街', '', '', '', '', '2025-04-22 17:32:09', '0000-00-00 00:00:00', 1, '', '数百年前，银月的一位科学家将炼金术修炼到极致，使得白银的量产成为了可能，而现在，全白银打造而成的西街无一不是在宣告银月人的富饶与智慧。', 841, 819, 802, 804, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(804, '白银西街', '', '', '', '', '2025-03-31 00:49:25', '0000-00-00 00:00:00', 1, '', '数百年前，银月的一位科学家将炼金术修炼到极致，使得白银的量产成为了可能，而现在，全白银打造而成的西街无一不是在宣告银月人的富饶与智慧。', 854, 855, 803, 805, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(805, '白银西街', '', '', '', '', '2025-04-22 17:32:17', '0000-00-00 00:00:00', 1, '', '数百年前，银月的一位科学家将炼金术修炼到极致，使得白银的量产成为了可能，而现在，全白银打造而成的西街无一不是在宣告银月人的富饶与智慧。', 856, 857, 804, 806, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(806, '紫钻广场', '', '', '', '', '2025-04-22 17:32:18', '0000-00-00 00:00:00', 1, '', '银月人通过合金冶炼技术的精进，成功研究出一种耐磨耐高温的高导材料:紫钻，而以紫钻打造的这片巨大广场彰显着银月人的辉煌。', 810, 813, 805, 807, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(807, '弦歌东街', '', '', '', '', '2025-04-22 17:32:20', '0000-00-00 00:00:00', 1, '', '银月人对弦乐的追求也是精益求精，这一条街道便是艺术家的天堂。', 843, 850, 806, 808, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(808, '弦歌东街', '', '', '', '', '2025-04-22 17:32:45', '0000-00-00 00:00:00', 1, '', '银月人对弦乐的追求也是精益求精，这一条街道便是艺术家的天堂。', 849, 864, 807, 809, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(809, '弦歌东街', '', '', '', '', '2025-04-22 17:32:52', '0000-00-00 00:00:00', 1, '', '银月人对弦乐的追求也是精益求精，这一条街道便是艺术家的天堂。', 845, 0, 808, 846, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(810, '翡翠北街', '', '', '', '', '2025-02-27 04:15:38', '0000-00-00 00:00:00', 1, '', '幽绿的翡翠点缀着平整的路面，这里是银月人中的精英心目中实现才华抱负的理想之地，自由，开放，繁华，文明，井然有序又人情满满的地方。', 811, 806, 856, 843, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(811, '翡翠北街', '', '', '', '', '2025-03-31 00:55:27', '0000-00-00 00:00:00', 1, '', '幽绿的翡翠点缀着平整的路面，这里是银月人中的精英心目中实现才华抱负的理想之地，自由，开放，繁华，文明，井然有序又人情满满的地方。', 812, 810, 861, 839, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(812, '翡翠北街', '', '', '', '', '2025-03-31 00:55:21', '0000-00-00 00:00:00', 1, '', '幽绿的翡翠点缀着平整的路面，这里是银月人中的精英心目中实现才华抱负的理想之地，自由，开放，繁华，文明，井然有序又人情满满的地方。', 844, 811, 840, 848, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(813, '水晶街道', '', '', '', '', '2025-03-31 00:55:07', '0000-00-00 00:00:00', 1, '', '这里的街面上镶嵌着闪闪发光的水晶，水晶是造物主的奇迹，也是这片奇迹之地的根本，银月人利用水晶的性质开发了许多不可思议的技艺。', 806, 814, 857, 850, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(814, '水晶街道', '', '', '', '', '2025-03-31 00:54:48', '0000-00-00 00:00:00', 1, '', '这里的街面上镶嵌着闪闪发光的水晶，水晶是造物主的奇迹，也是这片奇迹之地的根本，银月人利用水晶的性质开发了许多不可思议的技艺。', 813, 815, 858, 853, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(815, '水晶街道', '', '', '', '', '2025-03-31 00:54:48', '0000-00-00 00:00:00', 1, '', '这里的街面上镶嵌着闪闪发光的水晶，水晶是造物主的奇迹，也是这片奇迹之地的根本，银月人利用水晶的性质开发了许多不可思议的技艺。', 814, 817, 852, 818, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(816, '银月南城枢纽', '', '', '', '', '2025-03-31 00:54:23', '0000-00-00 00:00:00', 1, '', '银月城南的一处交通枢纽，是与外界交流的主要通道，来往的旅客络绎不绝。', 817, 0, 0, 0, '智慧山脊', 11, '69', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(817, '银月南城城门', '', '', '', '', '2025-03-31 00:54:25', '0000-00-00 00:00:00', 1, '', '银月城西的长拱形城门，通体采用花岗岩镶嵌水晶铸造而成，这边也是接待访客的主要区域。', 815, 816, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(818, '壁炉旅馆', '', '', '', '', '2025-03-31 00:55:03', '0000-00-00 00:00:00', 1, '', '银月城最开始建造的时候，这里便以一口终年不灭的壁炉出名，而今更是成为银月南城最大的旅店。', 853, 0, 815, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(819, '亚力酒吧', '', '', '', '', '2025-03-31 00:49:20', '0000-00-00 00:00:00', 1, '', '远道而来的客人，相信茴香的气息能让你着迷，你看那壁炉中跳动的火焰，是否也触动了你炽热的灵魂呢?', 803, 842, 0, 855, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(820, '珍珠海观光站', '', '', '', '', '2025-03-31 00:54:21', '0000-00-00 00:00:00', 1, '', '黑金石的色彩渲染了智慧的美感，不远处是银月半岛南边的珍珠海滩，飞速免费的魔法观光车正在银月城与此地流动。', 0, 821, 0, 0, '智慧山脊', 11, '70', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(821, '珍珠沙滩', '', '', '', '', '2025-03-31 00:53:37', '0000-00-00 00:00:00', 1, '', '洁白又细腻的细沙在阳光下一闪一闪的，好看极了。', 820, 824, 822, 823, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(822, '珍珠沙滩', '', '', '', '', '2025-02-27 04:19:54', '0000-00-00 00:00:00', 1, '', '洁白又细腻的细沙在阳光下一闪一闪的，好看极了，西边被一些荆棘挡住了去路。', 0, 826, 0, 821, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(823, '珍珠沙滩', '', '', '', '', '2025-03-31 00:54:02', '0000-00-00 00:00:00', 1, '', '洁白又细腻的细沙在阳光下一闪一闪的，好看极了。', 0, 825, 821, 830, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(824, '潮汐广场', '', '', '', '', '2025-03-31 00:53:44', '0000-00-00 00:00:00', 1, '', '{eval(v(c.hour)<12?\"涨潮了，青色的大理石地板被泛着咸涩泡沫的海水吞没。\":\"潮水退去，留下干咸的大理石地板上零星的细沙，偶尔还能见到几只螃蟹慵懒的身影。\")}', 821, 827, 826, 825, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(825, '珍珠海滩', '', '', '', '', '2025-03-31 00:54:01', '0000-00-00 00:00:00', 1, '', '涨潮与退潮在这片银白色的海滩上日日夜夜，循环往复。', 823, 828, 824, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(826, '珍珠海滩', '', '', '', '', '2025-02-27 04:19:55', '0000-00-00 00:00:00', 1, '', '涨潮与退潮在这片银白色的海滩上日日夜夜，循环往复。', 822, 829, 0, 824, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(827, '银色浅海', '', '', '', '', '2025-02-27 04:19:58', '0000-00-00 00:00:00', 1, '', '冰凉的海水涌了上来，远远看过去像是一片银色的镜子一般', 824, 0, 829, 828, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(828, '银色浅海', '', '', '', '', '2025-02-27 04:19:59', '0000-00-00 00:00:00', 1, '', '冰凉的海水涌了上来，远远看过去像是一片银色的镜子一般', 825, 0, 827, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(829, '银色浅海', '', '', '', '', '2025-02-27 04:19:57', '0000-00-00 00:00:00', 1, '', '冰凉的海水涌了上来，远远看过去像是一片银色的镜子一般', 826, 0, 0, 827, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(830, '碎石路', '', '', '', '', '2025-03-31 00:54:06', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走。', 0, 0, 823, 831, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(831, '碎石路', '', '', '', '', '2025-03-31 00:54:07', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走。', 834, 0, 830, 832, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(832, '碎石路', '', '', '', '', '2025-02-27 04:19:44', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走。', 0, 0, 831, 833, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(833, '碎石路', '', '', '', '', '2025-02-27 04:19:45', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走，到这似乎已经到了尽头。', 838, 0, 832, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(834, '碎石路', '', '', '', '', '2025-03-31 00:54:08', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走。', 835, 831, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(835, '碎石路', '', '', '', '', '2025-03-31 00:54:09', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走。', 836, 834, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(836, '碎石路', '', '', '', '', '2025-03-31 00:54:10', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走。', 837, 835, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(837, '碎石路', '', '', '', '', '2025-03-31 00:54:11', '0000-00-00 00:00:00', 1, '', '零零散散的碎石铺成的平整小路，没什么行人，偶尔有几处海鸟被惊醒飞走，远处是茂密的原始森林，这里放着一个游客止步的牌子。', 0, 836, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(838, '水晶小屋', '', '', '', '', '2025-02-27 04:19:46', '0000-00-00 00:00:00', 1, '', '通体由水晶打造而成的一间小屋，里面会有什么样的惊喜呢?', 0, 833, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(839, '先知学院大门', '', '', '', '', '2025-04-22 17:32:24', '0000-00-00 00:00:00', 1, '', '恢宏的先知学院大门伫立于此，映入眼帘的却不是庄严严谨的景色，而是一个高约5米的紫色漩涡。', 848, 843, 811, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(840, '长者居所', '', '', '', '', '2025-01-22 00:34:50', '0000-00-00 00:00:00', 1, '', '银月城的五位「启迪者」之一「安东尼奥.阿布勒」的居所，空气中弥漫着各类刺激的气味。', 0, 0, 0, 812, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(841, '菲尔武器店', '', '', '', '', '2025-04-22 17:32:11', '0000-00-00 00:00:00', 1, '', '菲尔是卡萨克的妻子，几年前他从银月戈壁出发几经辗转，到此后便一边以祖传手艺谋生一边寻找自己妻子的下落。', 0, 803, 0, 854, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(842, '阿格达尔花园', '', '', '', '', '2025-02-05 01:17:08', '0000-00-00 00:00:00', 1, '', '这是一座富满想象力与创造力的花园，见证了银月人的历史，聪明的银月人便将其从动荡的戈壁区域搬移至此。', 819, 862, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(843, '玛娜特艺术圣地', '', '', '', '', '2025-04-22 17:32:21', '0000-00-00 00:00:00', 1, '', '玛娜特是银月人信仰的真主之女，也是银月人信仰的艺术与水晶女神，这里自然成了银月人心中的艺术圣地。', 839, 807, 810, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(844, '教议阁', '', '', '', '', '2025-03-31 00:55:22', '0000-00-00 00:00:00', 1, '', '银月人最高权力机构，同时也是最高宗教管理机构，这里汇聚着精英中的精英，导航着银月族人大船的航向。', 0, 812, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(845, '无名半墙', '', '', '', '', '2025-04-22 17:32:53', '0000-00-00 00:00:00', 1, '', '一堵饱经岁月风霜的残破白墙，坑坑洼洼的样子诉说着它过去的经历。', 0, 809, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(846, '银月东城城门', '', '', '', '', '2025-04-22 17:32:55', '0000-00-00 00:00:00', 1, '', '银月城东的星形城门，通体采用石灰石镶嵌荧光石铸造而成，充满着银月人对于艺术独到的见解与美感。', 870, 0, 809, 847, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(847, '银月东港', '', '', '', '', '2025-04-22 17:33:07', '0000-00-00 00:00:00', 1, '', '银月半岛的东部重要大港口，承载着智慧山脊的物资运送，大大小小的集装箱堆积在这里。', 0, 0, 846, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(848, '海心公园', '', '', '', '', '2025-04-22 17:32:25', '0000-00-00 00:00:00', 1, '', '传说有位银月的勇士曾在迷雾海深处见过海洋之心，它可以暂时驱散迷雾，后来银月人建立了公园纪念这一位勇士。', 0, 839, 812, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(849, '长者居所', '', '', '', '', '2025-04-22 17:32:47', '0000-00-00 00:00:00', 1, '', '银月城的五位「启迪者」之一「瓦伦那.克里斯」的居所，房间充满了艺术的气息。', 0, 808, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(850, '贝都剧场', '', '', '', '', '2025-02-27 04:15:45', '0000-00-00 00:00:00', 1, '', '一个椭圆形的剧场，可以同时容纳几千人观看节日庆典，比赛决斗等娱乐项目。', 807, 0, 813, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(851, '临海大道', '', '', '', '', '2025-04-22 17:33:29', '0000-00-00 00:00:00', 1, '', '连接着港口与戈壁深处的一条沙石路。', 0, 0, 343, 0, '银月戈壁', 10, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(852, '海纳博物馆', '', '', '', '', '2025-01-25 02:08:36', '0000-00-00 00:00:00', 1, '', '该博物馆通体采用白色大理石建成，远远看去像是好多根柱子托着一个椭圆的白色碟盘，名字则取海纳百川之意，这里存放着银月人的起源，历史以及重要事件的足迹。', 0, 0, 0, 815, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(853, '美味一条街', '', '', '', '', '2025-03-31 00:54:50', '0000-00-00 00:00:00', 1, '', '著名的美味一条街，既有来自祖地戈壁的特产，又有经过学者根据智慧山脊培育出的特产，空气中的香气没有淡过，人潮涌动，来往游客络绎不绝。', 0, 818, 814, 863, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(854, '居民区一期', '', '', '', '', '2025-04-22 17:32:12', '0000-00-00 00:00:00', 1, '', '这里曾经是最早的开拓者安身的场所，设计还有些狂野。虽然历史悠久，但随着城市扩建，这里的地理位置显然不是最优，曾经的繁华也随之而去。', 860, 804, 841, 856, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(855, '别墅区一期', '', '', '', '', '2025-02-21 01:34:18', '0000-00-00 00:00:00', 1, '', '别墅区充满了设计的美感，也是地位的象征，这里居住着对银月作出杰出贡献的优秀人物。', 804, 859, 819, 857, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(856, '居民区二期', '', '', '', '', '2025-04-22 17:32:16', '0000-00-00 00:00:00', 1, '', '这里曾经是最早的开拓者安身的场所，设计还有些狂野。虽然历史悠久，但随着城市扩建，这里的地理位置显然不是最优，曾经的繁华也随之而去。', 861, 805, 854, 810, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(857, '别墅区三期', '', '', '', '', '2025-02-01 01:27:28', '0000-00-00 00:00:00', 1, '', '别墅区充满了设计的美感，也是地位的象征，这里居住着对银月作出杰出贡献的优秀人物。', 805, 858, 855, 813, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(858, '别墅区四期', '', '', '', '', '2025-02-21 01:34:20', '0000-00-00 00:00:00', 1, '', '别墅区充满了设计的美感，也是地位的象征，这里居住着对银月作出杰出贡献的优秀人物。', 857, 0, 859, 814, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(859, '别墅区二期', '', '', '', '', '2025-02-21 01:34:19', '0000-00-00 00:00:00', 1, '', '别墅区充满了设计的美感，也是地位的象征，这里居住着对银月作出杰出贡献的优秀人物。', 855, 0, 0, 858, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(860, '居民区三期', '', '', '', '', '2025-02-27 04:14:00', '0000-00-00 00:00:00', 1, '', '这里曾经是最早的开拓者安身的场所，设计还有些狂野。虽然历史悠久，但随着城市扩建，这里的地理位置显然不是最优，曾经的繁华也随之而去。', 0, 854, 0, 861, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(861, '居民区四期', '', '', '', '', '2025-02-27 04:14:02', '0000-00-00 00:00:00', 1, '', '这里曾经是最早的开拓者安身的场所，设计还有些狂野。虽然历史悠久，但随着城市扩建，这里的地理位置显然不是最优，曾经的繁华也随之而去。', 0, 856, 860, 811, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(862, '长者居所', '', '', '', '', '2025-02-05 01:17:09', '0000-00-00 00:00:00', 1, '', '银月城的五位「启迪者」之一「莱恩.熙妮莎」的居所，浪漫的气息从花园随风而来。', 842, 0, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(863, '长者居所', '', '', '', '', '2025-03-31 00:54:56', '0000-00-00 00:00:00', 1, '', '银月城的五位「启迪者」之一「库萨.索杰恩」的居所，这里附近充斥着烟火气息。', 0, 0, 853, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(864, '艺术长廊', '', '', '', '', '2025-02-27 04:19:09', '0000-00-00 00:00:00', 1, '', '琳琅满目的艺术品，灵光一现，也许你也能在此留下你的作品。', 808, 0, 0, 865, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(865, '艺术长廊', '', '', '', '', '2025-02-27 04:19:11', '0000-00-00 00:00:00', 1, '', '琳琅满目的艺术品，灵光一现，也许你也能在此留下你的作品。', 0, 866, 864, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(866, '艺术长廊', '', '', '', '', '2025-02-01 01:33:42', '0000-00-00 00:00:00', 1, '', '琳琅满目的艺术品，灵光一现，也许你也能在此留下你的作品。', 865, 0, 867, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(867, '艺术长廊', '', '', '', '', '2025-02-01 01:33:30', '0000-00-00 00:00:00', 1, '', '琳琅满目的艺术品，灵光一现，也许你也能在此留下你的作品。', 0, 868, 0, 866, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 0, 0, 0, 0),
(868, '艺术殿堂', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '收藏着全世界的名著，各个民族智慧的结晶在此碰撞。', 867, 0, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(869, '长者居所', '', '', '', '', '2025-04-22 17:32:58', '0000-00-00 00:00:00', 1, '', '银月城的五位「启迪者」之一「杰克.阿多」的居所，由于喜欢大海，他的住所建在了城外，面朝着无尽的迷雾海。', 0, 870, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0),
(870, '苔痕小径', '', '', '', '', '2025-04-22 17:32:56', '0000-00-00 00:00:00', 1, '', '一条长满了苔痕的小石子路，会通向什么地方呢?', 869, 846, 0, 0, '智慧山脊', 11, '', '', 0, 0, 0, 0, 0, 0, 0, '', 1, 0, '晴天', '0,0,0', 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_map_cache`
--

CREATE TABLE `system_map_cache` (
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
  `mis_signal_block` tinyint(1) NOT NULL DEFAULT '0',
  `mhide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(274, 17, '', '打随机不同数木桩', 30, 0),
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
(338, 38, '', '老鼠群', 113, 0),
(276, 39, '', '字符串连接测试', 126, 0),
(703, 40, '{u.tasks.t21}==2', '进入沼泽地', 131, 0),
(709, 41, '{u.remove_cathaya_1}==0', '解除北区封印', 137, 0),
(275, 42, '', '在线时间', 138, 0),
(706, 43, '{u.remove_cathaya_4}==0', '解除东区封印', 139, 0),
(723, 44, '{u.remove_cathaya_2}==0', '解除南区封印', 141, 0),
(720, 45, '{u.remove_cathaya_3}==0', '解除西区封印', 140, 0),
(318, 46, '{u.tasks.t23}==2', '@red@!@end@跟随去未来城的车队', 147, 0),
(497, 47, '', '@red@!@end@去希望镇', 149, 0),
(246, 48, '', '查看镜子', 151, 0),
(497, 49, '', '@red@!@end@去黑雾城', 152, 0),
(266, 50, '', '@red@!@end@去未来城', 155, 0),
(269, 51, '', '黑雾界碑', 156, 0),
(667, 52, '', '＜-进入交易市场', 157, 0),
(734, 53, '{u.open_future_prison_307}==0', '@red@!@end@叫醒三人', 160, 0),
(742, 54, '', '进入电梯(去二层)', 162, 0),
(743, 55, '', '进入电梯(去三层)', 163, 0),
(744, 56, '{u.open_future_prison}==1', '拿起神秘字条', 164, 0),
(747, 57, '', '从楼梯上去', 168, 0),
(750, 58, '', '从楼梯下去', 169, 0),
(754, 59, '{u.ic.i161}==0', '奇怪的卡片', 170, 0),
(755, 60, '', '终端验证系统', 171, 0),
(760, 61, '', '离开', 174, 0),
(676, 62, '', '进入「地上天堂」', 175, 0),
(772, 63, '{u.tasks.t27}==2', '进入北野垃圾场', 179, 0),
(778, 64, '{u.tasks.t28}==1', '攻击张三', 181, 0),
(668, 65, '{u.tasks.t29}==2&&{u.ic.i88}==0', '@red@!@end@查看真理之门', 185, 0),
(668, 66, '{u.tasks.t30}==2', '踏入虚空之门', 187, 0),
(789, 67, '', '@red@!@end@去银月城', 188, 0),
(801, 68, '', '@red@!@end@前往奇迹港口', 189, 0),
(816, 69, '', '@red@!@end@前往珍珠海滩', 190, 0),
(820, 70, '', '@red@!@end@前往银月南城', 191, 0);

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
-- 表的结构 `system_module_cj`
--

CREATE TABLE `system_module_cj` (
  `module_id` int(11) NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_module_cj`
--

INSERT INTO `system_module_cj` (`module_id`, `css`, `js`) VALUES
(1, '', 'console.log(\"你好\");'),
(2, '', ''),
(3, '', ''),
(4, '', ''),
(5, '', ''),
(6, '', ''),
(7, '', ''),
(8, '', ''),
(9, '', ''),
(10, '', ''),
(11, '', ''),
(14, '', '');

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
('money', '信用币', '点', 1),
('money2', '未来币', '枚', 0);

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
  `nchuck` int(1) NOT NULL DEFAULT '1',
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
  `nhp` decimal(65,0) NOT NULL DEFAULT '0',
  `nmaxhp` int(11) NOT NULL DEFAULT '100',
  `nmp` int(11) NOT NULL,
  `nmaxmp` int(11) NOT NULL,
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
  `nminute_event_id` int(11) NOT NULL,
  `nspeed` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `system_npc`
--

INSERT INTO `system_npc` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `nmp`, `nmaxmp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`, `nspeed`) VALUES
(1, '旧街', 11, 0, 0, 0, 0, 0, 0, 0, 1, '莉莉安', 1, 1, '女', '她看起来三十多岁，一头金色波浪，脸上长着雀斑。', '', '', '', '', 0, '', '', '', '', '1,2', '', '100', 100, 0, 0, 10, 0, '', '', '1,3,10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 13, 0, 0, 0, 0, 0, 0, 0, 1, '格兰特', 0, 1, '男', '他满脸灰尘，此刻正双腿交叉坐在自己的坐布上，右手还拎着一瓶欧念。', '', '', '', '', 0, '', '', '', '', '24', '', '100', 100, 0, 0, 1, 1, '', '', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 14, 0, 0, 0, 0, 0, 1, 0, 0, '赫炳', 0, 1, '男', '是一个艺术家，可惜生在了这个时代，靠在街头帮雇佣兵写字养家糊口。', '', '', '', '', 0, '', '23|1', '', '', '28', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 15, 0, 0, 0, 0, 0, 1, 0, 0, '周富贵', 0, 10, '男', '来看看,都是荒野上淘来的好货!', '', '', '', '', 0, '', '18|10', '商店.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 16, 0, 0, 0, 0, 0, 0, 0, 0, '王小波', 0, 6, '男', '拥有一身好气力，有各种表演的绝活，卖艺为生。', '', '', '', '', 0, '', '', '技能兑换.php', '', '', '', '100', 100, 0, 0, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 17, 0, 0, 0, 0, 0, 1, 0, 1, '薇儿', 0, 1, '女', '她看起来三十多岁，听说是个从荒野捡回来的失忆小女孩，她的养父「卡尔萨斯」给她取名「薇儿」。', '防具_7_26', '', '', '', 0, '', '1|99', '治疗.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '2', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 19, 0, 0, 0, 0, 0, 0, 0, 0, '符箓大师', 0, 0, '男', '技能大师，负责兑换技能', '', '', '', '', 0, '', '', '技能兑换.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 20, 0, 0, 0, 0, 0, 0, 0, 0, '小蛮', 0, 0, '女', '小蛮好怕...', '', '', '', '', 0, '', '', '', '', '20', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 21, 0, 0, 0, 0, 0, 0, 0, 0, '蛮族长老', 0, 0, '男', '蛮族长老', '', '', '', '', 0, '', '', '', '', '19', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 22, 0, 0, 0, 0, 0, 0, 0, 0, '蛮族猎手', 0, 0, '男', '老了,干不动了', '', '', '', '', 0, '', '', '', '', '21', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(11, '智慧山脊', 24, 0, 0, 0, 0, 0, 0, 0, 0, '羁旅者', 0, 50, '男', '没人知道他的来历。', '兵器_12_121', '', '', '', 0, '', '', '治疗_级别1.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 26, 0, 0, 0, 0, 0, 0, 0, 0, '小乞丐', 0, 1, '男', '骨瘦如柴，龟缩在一栋砖瓦房的墙角，正瑟瑟发抖。', '', '', '', '', 0, '', '', '门派管理员.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '7', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(7, '安宁海滨', 34, 0, 0, 0, 0, 0, 1, 0, 0, '渔民', 0, 1, '男', '一个皮肤黝黑粗糙的中年男人，戴着顶斗笠，穿着长衣长裤，今天的收获还不错，再这么持续一段日子，他就能换掉自己漏风的斗笠了吧。', '', '', '', '', 0, '', '', '', '{u.lang_anni}>=4', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 35, 0, 0, 0, 0, 0, 1, 1, 1, '瓦尔金', 0, 1, '男', '他看起来有五十多岁了，脸上皱纹和伤疤已经分不清了，头上的白发和金发也难以辨别。', '', '', '', '', 0, '', '5|1,74|1,105|1,112|1', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '11', '22', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 36, 0, 0, 0, 0, 0, 1, 0, 0, '杰德', 0, 1, '男', '一个旅行商人，但由于什么原因，在旧街停留了好长一阵子。', '', '', '', '', 0, '', '73|10|money', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 37, 0, 0, 0, 1),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 3),
(1, '旧街', 41, 0, 0, 0, 0, 0, 1, 1, 0, '安妮', 0, 1, '女', '她生得金发碧眼，很是抚媚，看起来二十几岁。', '', '', '', '', 0, '', '7|1|money,21|1,22|1,71|1', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 47, 0, 0, 0, 0, 0, 0, 0, 0, '卡斯珀神父', 0, 10, '男', '希望神教遍布了这片土地，他是希望神教在希望镇的一个教父，负责传教以及给信徒排忧解惑！', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '4', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 48, 0, 1, 1, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '防具_4_7,防具_5_22,兵器_1_125', '100-{u.lvl}-150', '', '', 0, '7|1', '', '', '', '', '', '9999999999999999999999', 19980925, 19980925, 19980925, 1, 10, '', '', '', 195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 49, 0, 0, 0, 0, 0, 0, 0, 0, '歌尔特', 0, 10, '男', '经营着一个佣兵集团的佣兵头子，经常会发布一些悬赏任务，正在拿着一本羊皮笔记本写着什么。', '', '', '', '', 0, '1|10,8|10', '', '', '', '', '风啸佣兵团团长', '100', 100, 0, 0, 1, 1, '', '6,5', '4,8,7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 50, 0, 0, 0, 0, 0, 1, 0, 1, '皮格', 0, 1, '男', '胖胖的中年男人，发明了很多〝黑暗料理〞，只有尝过的人才知道，不可名状之物的味道竟然出奇地好！不过他有个怪脾气，卖东西只卖给投缘的人。', '', '', '', '', 0, '', '28|6', '', '{u.tasks.t5} ==2', '', '', '100', 100, 0, 0, 1, 1, '', '', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 52, 0, 0, 0, 0, 0, 0, 0, 1, '迪伦斯', 0, 1, '男', '他似乎看起来精神状态不太好，披头散发的，也不知道能不能活到明天。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '6', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(7, '安宁海滨', 54, 0, 0, 0, 0, 0, 0, 0, 0, '苏加诺', 0, 1, '男', '一个中年男人，留着一脸的络腮胡，是安宁城对外的贸易官。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 56, 0, 1, 0, 1, 0, 0, 0, 0, '变异灰狼王', 0, 10, '母', '一头母灰狼，体型比一般灰狼更大，经历某种不知名突变，尾巴颜色带上了一点淡淡的红光。', '', '', '', '', 0, '3|2', '', '', '', '', '', '1000', 1000, 350, 350, 60, 30, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 59, 0, 0, 0, 0, 0, 0, 0, 0, '卡尔萨斯', 0, 1, '男', '浮沉诊所的主人，留着一脸大胡子，是附近医术最好的医生。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 60, 0, 0, 0, 0, 0, 0, 0, 0, '维奇', 0, 6, '男', '他通过层层选拔被选中为岗哨，成为了旧街居民发现危险的眼睛。', '兵器_3_120', '', '', '', 0, '', '', '', '', '', '旧街的岗哨', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13,21,29,30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 62, 0, 0, 0, 0, 0, 0, 0, 0, '威尔海姆', 0, 10, '男', '他就是经营旧吧的老板，右手戴着一个奇怪的戒指，脸上写满了沧桑与故事。', '防具_9_122', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 63, 0, 0, 0, 0, 0, 1, 0, 1, '黛西', 0, 10, '女', '她是酒吧的女仆，看起来身材消瘦，但长着一双水汪汪的大眼睛，性感的小嘴唇，楚楚动人。', '防具_5_22', '', '', '', 0, '', '64|1,117|1,65|1,149|1', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '{\"139\":\"{r.2}\"}', 0, '3|2,2|1', '', '', '', '', '', '660', 660, 220, 220, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '{\"140\":\"{r.2}\"}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '{\"141\":\"{r.2}\"}', 0, '3|4', '', '', '', '', '', '420', 420, 260, 260, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 68, 0, 0, 0, 0, 0, 0, 0, 0, '姗妮', 0, 0, '女', '一个艳丽的女人，举手投足间都散发着魅力，黄色的波浪发丝，每舞动一次就带起了一次迷人的涟漪。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '9', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 70, 0, 0, 0, 0, 0, 0, 0, 0, '马修', 0, 1, '男', '他是希望镇生产中心的负责人，总是戴着一个单片眼镜和一支蓝紫色的钢笔。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_maxiu', '', '20', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(23, '迷雾森林', 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', '480', 480, 300, 300, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 73, 0, 0, 0, 0, 0, 0, 0, 0, '达克莱尔', 0, 1, '男', '一个穿着灰色长衣的中年男人，是希望镇的大工程师，负责发电站的技术工作。', '兵器_10_123', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_dkle', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 74, 0, 0, 0, 0, 0, 0, 0, 0, '巴尔克', 0, 1, '男', '穿着一身白色长衫，一脸忧郁的样子。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 75, 0, 0, 0, 0, 0, 0, 0, 0, '凌影', 0, 1, '男', '他就是希望镇这一届的代理镇长，气宇轩昂，高深莫测。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_lingying', '', '18,19', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 76, 0, 0, 0, 0, 0, 0, 0, 0, '特蕾莎', 0, 1, '女', '她眼神坚毅，没有寻常女子的粉雕玉啄，偏黄的肤色上汗水正往地上滴落。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '8', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 77, 0, 0, 0, 0, 0, 0, 0, 0, 'K-M', 0, 0, '男', '一个全身裹着风衣的奇怪男人，戴着一副很奇特的眼镜。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '12,15,16,17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 78, 0, 0, 0, 0, 0, 0, 0, 0, '钟七隐', 0, 0, '', '一位耄耋老人，不知道于此作甚。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 79, 0, 0, 0, 0, 0, 0, 0, 0, '赫米特', 0, 0, '女', '他穿着一身棕色的兽衣，背着一把复合弓，似乎正在瞄准什么。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 80, 0, 0, 0, 0, 0, 0, 0, 0, '任务测试怪', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '11', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 82, 0, 0, 0, 0, 0, 0, 0, 0, '测试', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 83, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 84, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 85, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 86, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 87, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 88, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎', 0, 10, '公', '这是一头经过变异的老虎，一双锋利的牙齿异常瘆人。', '', '{r.100}', '', '', 0, '2|4,3|6', '', '', '', '', '', '1000', 1000, 600, 600, 120, 70, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 89, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎王', 0, 15, '公', '这是一头经过变异的巨齿虎王，是凶残的王者，一双锋利的牙齿异常瘆人。', '', '{r.5000}+2000', '', '{\"146\":\"{r.3}==1?1:0\"}', 0, '2|4,3|6', '', '', '', '', '', '3000', 3000, 1700, 1700, 200, 120, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 90, 0, 1, 0, 0, 0, 0, 0, 0, '变异蓝蝶后', 0, 15, '母', '这是一头经过变异的蓝蝶后，是致命的美丽，一对金色的触角颇具威严。', '', '{r.5000}+2000', '', '{\"144\":\"{r.3}==1?1:0\"}', 0, '2|4,3|6', '', '', '', '', '', '5000', 5000, 3000, 3000, 180, 140, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 91, 0, 1, 0, 0, 0, 0, 0, 0, '变异杀人蜂王', 0, 15, '公', '这是一只经过变异的杀人蜂王，是敏捷的战士，一双锋利的赤眼咄咄逼人。', '', '{r.5000}+2000', '', '{\"146\":\"{r.3}==1?1:0\"}', 0, '2|4,3|6', '', '', '', '', '', '2500', 2500, 1800, 1800, 150, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 92, 0, 0, 0, 0, 0, 0, 0, 0, '变异银杉树', 0, 0, '', '这是一棵变异的银杉树，受到了未知辐射的影响。它的树皮扭曲，枝叶以不自然的角度伸展，散发出微弱的绿色光芒。藤蔓和真菌盘绕在树干上，周围的地面破裂荒凉，仿佛受到了末日辐射的侵蚀。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '宁静森林NPC|npc002_cathaya', '9,10', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 93, 0, 0, 0, 0, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(0, '未分区', 94, 0, 0, 0, 1, 0, 0, 0, 0, '未命名', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '{\"150\":\"{r.2}\"}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(27, '宁静森林', 96, 0, 1, 0, 0, 0, 0, 0, 0, '奇怪的触手', 0, 20, '未知', '诡异的触手，不知道怎么长出来的，还是绕远点吧', '', '{r.500}+200', '', '', 0, '2|4,3|6', '', '', '', '', '', '1200', 1200, 1500, 1500, 300, 40, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 97, 0, 0, 0, 1, 0, 0, 0, 0, '智者', 0, 70, '男', '一身卫衣包裹住了全身，一双黑袖下修长的手臂，一个神秘的男人，没有人知道他的来历，也没人知道他的目的。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, '希望镇', 98, 0, 0, 0, 0, 0, 0, 0, 0, '碧翠丝', 0, 0, '女', '一个极具魅力的女人，总是身穿着白色的实验服，一头长发飘扬，戴着一副知性的眼镜，实验服的两兜还放着一些瓶瓶罐罐。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_bicuisi', '', '23', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 100, 0, 0, 0, 1, 0, 0, 0, 0, '云骁', 0, 0, '男', '他是FCPD的警长，是皇后街区的治安官。', '兵器_3_119,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '24', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 101, 0, 0, 0, 1, 0, 0, 0, 1, '罗宾', 0, 0, '男', '一个躺在地上的醉汉，手里拿着一瓶不知名的酒，嘴巴还在囔囔着什么：欧念欧念。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 102, 0, 0, 0, 1, 0, 0, 0, 0, '蒂娜', 0, 0, '女', '一个面容姣好的女人，脸上长着一些雀斑。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 104, 0, 0, 0, 1, 0, 1, 0, 1, '张铁牛', 0, 0, '男', '一个壮实的小伙子，额头绑着一条红毛巾，是一家烧烤摊的老板，来来往往，待客的笑容很是纯朴。', '', '', '', '', 0, '', '65|1,73|1,66|1', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '26', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 105, 0, 0, 0, 1, 0, 0, 0, 0, '张三', 0, 20, '男', '他是秃鹰帮的一名成员，由于脸上长满了麻子，外号二麻子。', '', '', '', '', 0, '8|3', '', '', '', '', '二麻子', '2500', 2500, 1000, 1000, 90, 30, '', '', '28', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 106, 0, 0, 0, 1, 0, 0, 0, 0, '温莎', 0, 0, '女', '她每天都会在皇后十字广场附近徘徊，有时候是发传单有时候是揽业务。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 107, 0, 0, 0, 1, 0, 0, 0, 0, '秃鹰帮巡卫', 0, 0, '男', '秃鹰帮的一名巡卫。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '27', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, '未来城', 108, 0, 0, 0, 1, 0, 0, 0, 0, '守时', 0, 70, '男', '。。。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(1, '旧街', 109, 0, 0, 0, 0, 0, 0, 0, 0, '未命名(未命名)', 0, 0, '', '', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(10, '银月戈壁', 110, 0, 0, 0, 1, 0, 0, 0, 0, '莱兹.恩', 0, 0, '男', '一个上了年纪的银月人，紫银色的皮肤黯淡了不少，那银月人标志性的大红鼻子却依旧坚挺。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `system_npc_drop_list`
--

CREATE TABLE `system_npc_drop_list` (
  `drop_id` int(11) NOT NULL,
  `drop_npc_id` int(11) NOT NULL,
  `drop_item_data` text NOT NULL,
  `drop_player_sid` text NOT NULL,
  `drop_time` datetime NOT NULL,
  `drop_mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `nchuck` int(1) NOT NULL DEFAULT '1',
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
  `nhp` decimal(65,0) NOT NULL DEFAULT '0',
  `nmaxhp` int(11) NOT NULL DEFAULT '100',
  `nmp` int(11) NOT NULL,
  `nmaxmp` int(11) NOT NULL,
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
  `nminute_event_id` int(11) NOT NULL,
  `nspeed` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

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
(17, 2, '{u.hp}<{u.maxhp}||{u.mp}<{u.maxmp}', '治疗', '8', NULL),
(46, 3, '', '和流民对话', '32', NULL),
(47, 4, '', '聆听教诲', '40', NULL),
(49, 5, '{u.tasks.t8}==2', '领取每日物资', '54', NULL),
(49, 6, '{u.tasks.t1}==2', '歌尔特的日常悬赏', '76', NULL),
(26, 7, '', '施舍', '79', NULL),
(76, 8, '', '治疗', '128', NULL),
(92, 9, '{u.remove_cathaya}==0&&{u.tasks.t20}==1', '解除封印', '135', NULL),
(92, 10, '{u.remove_cathaya}==1', '抚摸银杉树', '136', NULL),
(35, 11, '{u.tasks.t22}==2', '换取秘银', '144', NULL);

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
-- 表的结构 `system_npc_scene`
--

CREATE TABLE `system_npc_scene` (
  `narea_id` int(11) NOT NULL,
  `narea_name` varchar(255) NOT NULL,
  `nid` int(11) NOT NULL DEFAULT '0',
  `nstate` int(1) NOT NULL DEFAULT '0',
  `nkill` int(1) NOT NULL DEFAULT '0',
  `nnot_dead` int(1) NOT NULL DEFAULT '0',
  `nchuck` int(1) NOT NULL DEFAULT '1',
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
  `nhp` decimal(65,0) NOT NULL DEFAULT '0',
  `nmaxhp` int(11) NOT NULL DEFAULT '100',
  `nmp` int(11) NOT NULL,
  `nmaxmp` int(11) NOT NULL,
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
  `nminute_event_id` int(11) NOT NULL,
  `nmid` int(11) NOT NULL,
  `ncreat_time` datetime NOT NULL,
  `ncid` int(11) NOT NULL,
  `nspeed` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `system_npc_scene`
--

INSERT INTO `system_npc_scene` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `nmp`, `nmaxmp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`, `nmid`, `ncreat_time`, `ncid`, `nspeed`) VALUES
(0, '未分区', 48, 0, 0, 0, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '兵器_1_46,防具_4_7,防具_5_22', '', '', '', 0, '1|1', '', '', '', '', '', '19980925', 19980925, 19980925, 19980925, 40, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 713, '0000-00-00 00:00:00', 151, 1),
(0, '未分区', 48, 0, 0, 0, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '兵器_1_46,防具_4_7,防具_5_22', '', '', '', 0, '1|1', '', '', '', '', '', '19980925', 19980925, 19980925, 19980925, 40, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 713, '0000-00-00 00:00:00', 152, 1),
(0, '未分区', 48, 0, 0, 0, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '兵器_1_46,防具_4_7,防具_5_22', '', '', '', 0, '1|1', '', '', '', '', '', '19980925', 19980925, 19980925, 19980925, 40, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 713, '0000-00-00 00:00:00', 153, 1),
(0, '未分区', 48, 0, 0, 0, 0, 1, 0, 0, 0, '测试木桩', 0, 10, '', '你好。', '兵器_1_46,防具_4_7,防具_5_22', '', '', '', 0, '1|1', '', '', '', '', '', '19980925', 19980925, 19980925, 19980925, 40, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 713, '0000-00-00 00:00:00', 154, 1),
(1, '旧街', 11, 0, 0, 0, 0, 0, 0, 0, 1, '莉莉安', 1, 1, '女', '她看起来三十多岁，一头金色波浪，脸上长着雀斑。', '', '', '', '', 0, '', '', '', '', '1,2', '', '100', 100, 0, 0, 10, 0, '', '', '1,3,10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 713, '0000-00-00 00:00:00', 155, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 476, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 477, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 478, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 479, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 480, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 481, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 236, '0000-00-00 00:00:00', 482, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 236, '0000-00-00 00:00:00', 483, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 236, '0000-00-00 00:00:00', 484, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 236, '0000-00-00 00:00:00', 485, 1),
(1, '旧街', 14, 0, 0, 0, 0, 0, 1, 0, 0, '赫炳', 0, 1, '男', '是一个艺术家，可惜生在了这个时代，靠在街头帮雇佣兵写字养家糊口。', '', '', '', '', 0, '', '23|1', '', '', '28', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 486, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 487, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 488, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 489, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 490, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 491, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 237, '0000-00-00 00:00:00', 492, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 493, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 494, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 495, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 496, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 497, 1),
(2, '希望镇', 16, 0, 0, 0, 0, 0, 0, 0, 0, '王小波', 0, 6, '男', '拥有一身好气力，有各种表演的绝活，卖艺为生。', '', '', '', '', 0, '', '', '技能兑换.php', '', '', '', '100', 100, 0, 0, 10, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 498, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 499, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 500, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 501, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 502, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 503, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 504, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 505, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 506, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 507, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 508, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 509, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 510, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 511, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 512, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 513, 1),
(2, '希望镇', 76, 0, 0, 0, 0, 0, 0, 0, 0, '特蕾莎', 0, 1, '女', '她眼神坚毅，没有寻常女子的粉雕玉啄，偏黄的肤色上汗水正往地上滴落。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '8', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 514, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 515, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 516, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 517, 1),
(2, '希望镇', 26, 0, 0, 0, 0, 0, 0, 0, 0, '小乞丐', 0, 1, '男', '骨瘦如柴，龟缩在一栋砖瓦房的墙角，正瑟瑟发抖。', '', '', '', '', 0, '', '', '门派管理员.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '7', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 273, '0000-00-00 00:00:00', 518, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 273, '0000-00-00 00:00:00', 519, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 273, '0000-00-00 00:00:00', 520, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 273, '0000-00-00 00:00:00', 521, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 273, '0000-00-00 00:00:00', 522, 1),
(2, '希望镇', 75, 0, 0, 0, 0, 0, 0, 0, 0, '凌影', 0, 1, '男', '他就是希望镇这一届的代理镇长，气宇轩昂，高深莫测。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_lingying', '', '18,19', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 523, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 524, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 525, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 526, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 527, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 528, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 319, '0000-00-00 00:00:00', 534, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 319, '0000-00-00 00:00:00', 535, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 319, '0000-00-00 00:00:00', 536, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 319, '0000-00-00 00:00:00', 537, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 319, '0000-00-00 00:00:00', 538, 1),
(2, '希望镇', 47, 0, 0, 0, 0, 0, 0, 0, 0, '卡斯珀神父', 0, 10, '男', '希望神教遍布了这片土地，他是希望神教在希望镇的一个教父，负责传教以及给信徒排忧解惑！', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '4', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 321, '0000-00-00 00:00:00', 541, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 321, '0000-00-00 00:00:00', 542, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 321, '0000-00-00 00:00:00', 543, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 321, '0000-00-00 00:00:00', 544, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 322, '0000-00-00 00:00:00', 545, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 323, '0000-00-00 00:00:00', 546, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 323, '0000-00-00 00:00:00', 547, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 548, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 549, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 550, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 551, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 552, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 553, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 554, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 555, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 556, 1),
(2, '希望镇', 74, 0, 0, 0, 0, 0, 0, 0, 0, '巴尔克', 0, 1, '男', '穿着一身白色长衫，一脸忧郁的样子。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 442, '0000-00-00 00:00:00', 557, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 492, '0000-00-00 00:00:00', 558, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 492, '0000-00-00 00:00:00', 559, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 492, '0000-00-00 00:00:00', 560, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 492, '0000-00-00 00:00:00', 561, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 492, '0000-00-00 00:00:00', 562, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 493, '0000-00-00 00:00:00', 563, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 495, '0000-00-00 00:00:00', 564, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 495, '0000-00-00 00:00:00', 565, 1),
(1, '旧街', 77, 0, 0, 0, 0, 0, 0, 0, 0, 'K-M', 0, 0, '男', '一个全身裹着风衣的奇怪男人，戴着一副很奇特的眼镜。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '12,15,16,17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 562, '0000-00-00 00:00:00', 566, 1),
(2, '希望镇', 70, 0, 0, 0, 0, 0, 0, 0, 0, '马修', 0, 1, '男', '他是希望镇生产中心的负责人，总是戴着一个单片眼镜和一支蓝紫色的钢笔。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_maxiu', '', '20', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 567, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 568, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 569, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 570, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 571, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 572, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 573, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 574, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 580, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 581, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 582, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 583, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 584, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 585, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 586, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 587, 1),
(2, '希望镇', 73, 0, 0, 0, 0, 0, 0, 0, 0, '达克莱尔', 0, 1, '男', '一个穿着灰色长衣的中年男人，是希望镇的大工程师，负责发电站的技术工作。', '兵器_10_123', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_dkle', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 609, '0000-00-00 00:00:00', 588, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 612, '0000-00-00 00:00:00', 589, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 612, '0000-00-00 00:00:00', 590, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 613, '0000-00-00 00:00:00', 591, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 613, '0000-00-00 00:00:00', 592, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 613, '0000-00-00 00:00:00', 593, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 614, '0000-00-00 00:00:00', 594, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 615, '0000-00-00 00:00:00', 595, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 616, '0000-00-00 00:00:00', 596, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 617, '0000-00-00 00:00:00', 597, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 617, '0000-00-00 00:00:00', 598, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 617, '0000-00-00 00:00:00', 599, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 618, '0000-00-00 00:00:00', 600, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 618, '0000-00-00 00:00:00', 601, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 618, '0000-00-00 00:00:00', 602, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 619, '0000-00-00 00:00:00', 603, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 619, '0000-00-00 00:00:00', 604, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 619, '0000-00-00 00:00:00', 605, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 620, '0000-00-00 00:00:00', 606, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 621, '0000-00-00 00:00:00', 607, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 621, '0000-00-00 00:00:00', 608, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 621, '0000-00-00 00:00:00', 609, 1),
(2, '希望镇', 68, 0, 0, 0, 0, 0, 0, 0, 0, '姗妮', 0, 0, '女', '一个艳丽的女人，举手投足间都散发着魅力，黄色的波浪发丝，每舞动一次就带起了一次迷人的涟漪。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '9', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 632, '0000-00-00 00:00:00', 610, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 664, '0000-00-00 00:00:00', 611, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 664, '0000-00-00 00:00:00', 612, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 664, '0000-00-00 00:00:00', 613, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 614, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 235, '0000-00-00 00:00:00', 615, 1),
(11, '智慧山脊', 24, 0, 0, 0, 0, 0, 0, 0, 0, '羁旅者', 0, 50, '男', '没人知道他的来历，但没人敢轻视他。', '兵器_12_121', '', '', '', 0, '', '', '治疗_级别1.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 260, '0000-00-00 00:00:00', 618, 1),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', '420', 420, 260, 260, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 579, '0000-00-00 00:00:00', 647, 1),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', '420', 420, 260, 260, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 579, '0000-00-00 00:00:00', 648, 1),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', '420', 420, 260, 260, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 579, '0000-00-00 00:00:00', 649, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 236, '0000-00-00 00:00:00', 657, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 236, '0000-00-00 00:00:00', 658, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 659, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 660, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 661, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 662, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 663, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 664, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 665, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 666, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 316, '0000-00-00 00:00:00', 667, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 492, '0000-00-00 00:00:00', 668, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 273, '0000-00-00 00:00:00', 669, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 670, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 696, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 697, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 239, '0000-00-00 00:00:00', 698, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 699, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 700, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 701, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 702, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 703, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 704, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 323, '0000-00-00 00:00:00', 705, 1),
(0, '未分区', 69, 0, 0, 0, 0, 0, 0, 0, 0, '冒险者', 0, 1, '男', '这群背包客们不甘于生活的平庸，选择一条充满荆棘的道路，来慰藉自己内心的平静。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 437, '0000-00-00 00:00:00', 706, 1),
(3, '未来城', 97, 0, 0, 0, 1, 0, 0, 0, 0, '智者', 0, 70, '男', '一身卫衣包裹住了全身，一双黑袖下修长的手臂，一个神秘的男人，没有人知道他的来历，也没人知道他的目的。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 767, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 768, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 769, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 770, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 771, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 772, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 773, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 774, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 775, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 602, '0000-00-00 00:00:00', 798, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 602, '0000-00-00 00:00:00', 799, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 602, '0000-00-00 00:00:00', 800, 1),
(23, '迷雾森林', 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', '480', 480, 300, 300, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 584, '0000-00-00 00:00:00', 803, 1),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', '420', 420, 260, 260, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 579, '0000-00-00 00:00:00', 804, 1),
(23, '迷雾森林', 66, 0, 1, 0, 0, 0, 0, 0, 0, '巨齿兔', 0, 4, '公', '一只半身人高的兔子，最引人注目的是那两颗巨大的牙齿。', '', '{r.100}', '', '141|{r.2}', 0, '3|4', '', '', '', '', '', '420', 420, 260, 260, 35, 20, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 579, '0000-00-00 00:00:00', 805, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 604, '0000-00-00 00:00:00', 843, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 844, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 608, '0000-00-00 00:00:00', 845, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 848, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 849, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 850, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 851, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 852, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 853, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 240, '0000-00-00 00:00:00', 854, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 855, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 856, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 318, '0000-00-00 00:00:00', 857, 1),
(2, '希望镇', 98, 0, 0, 0, 0, 0, 0, 0, 0, '碧翠丝', 0, 0, '女', '一个极具魅力的女人，总是身穿着白色的实验服，一头长发飘扬，戴着一副知性的眼镜，实验服的两兜还放着一些瓶瓶罐罐。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '希望镇NPC|npc001_bicuisi', '', '23', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 864, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 865, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 866, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 867, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 868, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 340, '0000-00-00 00:00:00', 875, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 340, '0000-00-00 00:00:00', 876, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 340, '0000-00-00 00:00:00', 877, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 878, 1);
INSERT INTO `system_npc_scene` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `nmp`, `nmaxmp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`, `nmid`, `ncreat_time`, `ncid`, `nspeed`) VALUES
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 879, 1),
(2, '希望镇', 71, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '女', '一个长相不起眼的妇女，包着一个头巾，长期的营养不良使她看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 607, '0000-00-00 00:00:00', 880, 1),
(11, '智慧山脊', 24, 0, 0, 0, 0, 0, 0, 0, 0, '羁旅者', 0, 50, '男', '没人知道他的来历。', '兵器_12_121', '', '', '', 0, '', '', '治疗_级别1.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 272, '0000-00-00 00:00:00', 936, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 272, '0000-00-00 00:00:00', 937, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 272, '0000-00-00 00:00:00', 938, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 272, '0000-00-00 00:00:00', 939, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 272, '0000-00-00 00:00:00', 940, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 272, '0000-00-00 00:00:00', 941, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 955, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 956, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 957, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 958, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 498, '0000-00-00 00:00:00', 959, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 498, '0000-00-00 00:00:00', 960, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 499, '0000-00-00 00:00:00', 961, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 499, '0000-00-00 00:00:00', 962, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 499, '0000-00-00 00:00:00', 963, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 501, '0000-00-00 00:00:00', 964, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 501, '0000-00-00 00:00:00', 965, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 501, '0000-00-00 00:00:00', 966, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 501, '0000-00-00 00:00:00', 967, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 501, '0000-00-00 00:00:00', 968, 1),
(1, '旧街', 77, 0, 0, 0, 0, 0, 0, 0, 0, 'K-M', 0, 0, '男', '一个全身裹着风衣的奇怪男人，戴着一副很奇特的眼镜。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '12,15,16,17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 734, '0000-00-00 00:00:00', 978, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 320, '0000-00-00 00:00:00', 986, 1),
(27, '宁静森林', 88, 0, 1, 0, 0, 0, 0, 0, 0, '变异巨齿虎', 0, 10, '公', '这是一头经过变异的老虎，一双锋利的牙齿异常瘆人。', '', '{r.100}', '', '', 0, '2|4,3|6', '', '', '', '', '', '1000', 1000, 600, 600, 120, 70, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 643, '0000-00-00 00:00:00', 1043, 1),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13,21', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 703, '0000-00-00 00:00:00', 1044, 1),
(27, '宁静森林', 90, 0, 1, 0, 0, 0, 0, 0, 0, '变异蓝蝶后', 0, 15, '母', '这是一头经过变异的蓝蝶后，是致命的美丽，一对金色的触角颇具威严。', '', '{r.5000}+2000', '', '144|{r.3}==1?1:0', 0, '2|4,3|6', '', '', '', '', '', '5000', 5000, 3000, 3000, 180, 140, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 704, '0000-00-00 00:00:00', 1045, 1),
(27, '宁静森林', 91, 0, 1, 0, 0, 0, 0, 0, 0, '变异杀人蜂王', 0, 15, '公', '这是一只经过变异的杀人蜂王，是敏捷的战士，一双锋利的赤眼咄咄逼人。', '', '{r.5000}+2000', '', '146|{r.3}==1?1:0', 0, '2|4,3|6', '', '', '', '', '', '2500', 2500, 1800, 1800, 150, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 705, '0000-00-00 00:00:00', 1046, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 706, '0000-00-00 00:00:00', 1052, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 707, '0000-00-00 00:00:00', 1053, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 707, '0000-00-00 00:00:00', 1054, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 708, '0000-00-00 00:00:00', 1055, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 708, '0000-00-00 00:00:00', 1056, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 708, '0000-00-00 00:00:00', 1057, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '150|{r.2}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 708, '0000-00-00 00:00:00', 1058, 1),
(27, '宁静森林', 92, 0, 0, 0, 0, 0, 0, 0, 0, '变异银杉树', 0, 0, '', '这是一棵变异的银杉树，受到了未知辐射的影响。它的树皮扭曲，枝叶以不自然的角度伸展，散发出微弱的绿色光芒。藤蔓和真菌盘绕在树干上，周围的地面破裂荒凉，仿佛受到了末日辐射的侵蚀。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '宁静森林NPC|npc002_cathaya', '9,10', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 710, '0000-00-00 00:00:00', 1059, 1),
(1, '旧街', 79, 0, 0, 0, 0, 0, 0, 0, 0, '赫米特', 0, 0, '女', '他穿着一身棕色的兽衣，背着一把复合弓，似乎正在瞄准什么。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 710, '0000-00-00 00:00:00', 1060, 1),
(27, '宁静森林', 96, 0, 1, 0, 0, 0, 0, 0, 0, '奇怪的触手', 0, 20, '未知', '诡异的触手，不知道怎么长出来的，还是绕远点吧', '', '{r.500}+200', '', '', 0, '2|4,3|6', '', '', '', '', '', '1200', 1200, 1500, 1500, 300, 40, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 711, '0000-00-00 00:00:00', 1061, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 1360, 1),
(3, '未来城', 102, 0, 0, 0, 1, 0, 0, 0, 0, '蒂娜', 0, 0, '女', '一个面容姣好的女人，脸上长着一些雀斑。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '25', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 765, '0000-00-00 00:00:00', 1369, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 1370, 1),
(3, '未来城', 99, 0, 0, 0, 1, 0, 0, 0, 0, '流浪者', 0, 1, '男', '不知经历了什么的一群人，流浪于此，抱团取暖。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 1371, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 726, '0000-00-00 00:00:00', 1411, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 726, '0000-00-00 00:00:00', 1412, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 726, '0000-00-00 00:00:00', 1413, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 1417, 1),
(3, '未来城', 106, 0, 0, 0, 1, 0, 0, 0, 0, '温莎', 0, 0, '女', '她每天都会在皇后十字广场附近徘徊，有时候是发传单有时候是揽业务。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 454, '0000-00-00 00:00:00', 1769, 1),
(3, '未来城', 107, 0, 0, 0, 1, 0, 0, 0, 0, '秃鹰帮巡卫', 0, 0, '男', '秃鹰帮的一名巡卫。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '27', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 772, '0000-00-00 00:00:00', 1777, 1),
(3, '未来城', 107, 0, 0, 0, 1, 0, 0, 0, 0, '秃鹰帮巡卫', 0, 0, '男', '秃鹰帮的一名巡卫。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '27', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 772, '0000-00-00 00:00:00', 1778, 1),
(3, '未来城', 105, 0, 0, 0, 1, 0, 0, 0, 0, '张三', 0, 0, '男', '他是秃鹰帮的一名成员，由于脸上长满了麻子，外号二麻子。', '', '', '', '', 0, '', '', '', '', '', '二麻子', '100', 100, 0, 0, 0, 1, '', '', '28', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 778, '0000-00-00 00:00:00', 1788, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 673, '0000-00-00 00:00:00', 1789, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 673, '0000-00-00 00:00:00', 1790, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 673, '0000-00-00 00:00:00', 1791, 1),
(3, '未来城', 103, 0, 0, 0, 0, 0, 0, 0, 0, 'FCPD警员', 0, 20, '男', 'FCPD的初级警员，全副武装，戒备森严。', '兵器_3_20,防具_5_69,防具_7_71', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 673, '0000-00-00 00:00:00', 1792, 1),
(3, '未来城', 104, 0, 0, 0, 1, 0, 1, 0, 1, '张铁牛', 0, 0, '男', '一个壮实的小伙子，额头绑着一条红毛巾，是一家烧烤摊的老板，来来往往，待客的笑容很是纯朴。', '', '', '', '', 0, '', '65|1,73|1,66|1', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '26', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 625, '0000-00-00 00:00:00', 1793, 1),
(3, '未来城', 101, 0, 0, 0, 1, 0, 0, 0, 1, '罗宾', 0, 0, '男', '一个躺在地上的醉汉，手里拿着一瓶不知名的酒，嘴巴还在囔囔着什么：欧念欧念。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 676, '0000-00-00 00:00:00', 1809, 1),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13,21,29', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 676, '0000-00-00 00:00:00', 1810, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 729, '0000-00-00 00:00:00', 1811, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 729, '0000-00-00 00:00:00', 1812, 1),
(6, '黑雾城', 25, 0, 0, 0, 0, 0, 0, 0, 0, '黑冢士兵', 0, 15, '男', '这是一个全身穿着黑疙瘩的士兵，看起来威猛强大。', '兵器_3_68,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 729, '0000-00-00 00:00:00', 1813, 1),
(3, '未来城', 100, 0, 0, 0, 1, 0, 0, 0, 0, '云骁', 0, 0, '男', '他是FCPD的警长，是皇后街区的治安官。', '兵器_3_119,防具_5_69', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '24', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 243, '0000-00-00 00:00:00', 1814, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 497, '0000-00-00 00:00:00', 1815, 1),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13,21,29,30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 668, '0000-00-00 00:00:00', 1828, 1),
(10, '银月戈壁', 110, 0, 0, 0, 1, 0, 0, 0, 0, '莱兹.恩', 0, 0, '男', '一个上了年纪的银月人，紫银色的皮肤黯淡了不少，那银月人标志性的大红鼻子却依旧坚挺。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 0, 1, '', '', '31', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 342, '0000-00-00 00:00:00', 1897, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 591, '0000-00-00 00:00:00', 1902, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 591, '0000-00-00 00:00:00', 1903, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '140|{r.2}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 591, '0000-00-00 00:00:00', 1904, 1),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '139|{r.2}', 0, '3|2,2|1', '', '', '', '', '', '660', 660, 220, 220, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 593, '0000-00-00 00:00:00', 1905, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 238, '0000-00-00 00:00:00', 1925, 1),
(23, '迷雾森林', 72, 0, 1, 0, 0, 0, 0, 0, 0, '魔化鹿', 0, 5, '公', '异变后的鹿看起来好像是被用某种魔药浸泡过一样，皮肤干褶，目光空洞。', '', '{r.100}', '', '', 0, '3|4,2|4', '', '', '', '', '', '480', 480, 300, 300, 40, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 584, '0000-00-00 00:00:00', 1989, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 2005, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 242, '0000-00-00 00:00:00', 2008, 1),
(2, '希望镇', 23, 0, 0, 0, 0, 0, 0, 0, 0, '巡逻警卫', 0, 10, '男', '守卫着希望镇的和平与安宁，对你充满了警惕的神情。', '兵器_3_19', '', '', '', 0, '', '', '', '', '27', '', '1000', 1000, 0, 0, 50, 80, '希望镇NPC|npc001_ct', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 241, '0000-00-00 00:00:00', 2017, 1),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '{\"139\":\"{r.2}\"}', 0, '3|2,2|1', '', '', '', '', '', '660', 660, 220, 220, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 588, '0000-00-00 00:00:00', 2075, 1),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '{\"139\":\"{r.2}\"}', 0, '3|2,2|1', '', '', '', '', '', '660', 660, 220, 220, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 588, '0000-00-00 00:00:00', 2076, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 493, '0000-00-00 00:00:00', 2077, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 614, '0000-00-00 00:00:00', 2078, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 616, '0000-00-00 00:00:00', 2079, 1),
(2, '希望镇', 45, 0, 0, 0, 0, 0, 0, 0, 0, '居民', 0, 1, '男', '一个长相不起眼的男人，手上能看到一些老茧，长期营养不良使他看起来弱不禁风。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 616, '0000-00-00 00:00:00', 2080, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '{\"150\":\"{r.2}\"}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 706, '0000-00-00 00:00:00', 2081, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '{\"150\":\"{r.2}\"}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 706, '0000-00-00 00:00:00', 2082, 1),
(27, '宁静森林', 95, 0, 1, 0, 0, 0, 0, 0, 0, '变异毒蛙', 0, 20, '公', '一只经过变异的毒蛙，惨绿的皮肤上散发着森森白烟。', '', '{r.500}+150', '', '{\"150\":\"{r.2}\"}', 0, '2|4,6|1', '', '', '', '', '', '3000', 3000, 1800, 1800, 180, 80, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 706, '0000-00-00 00:00:00', 2083, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '{\"140\":\"{r.2}\"}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 598, '0000-00-00 00:00:00', 2103, 1),
(23, '迷雾森林', 65, 0, 1, 0, 0, 0, 0, 0, 0, '狂暴野猪', 0, 7, '公', '这头野猪的獠牙很长，是暗红色的，毛发是棕色的，眼睛猩红，浑身透露着一股杀意。', '', '{r.100}', '', '{\"140\":\"{r.2}\"}', 0, '2|3,3|3', '', '', '', '', '', '720', 720, 310, 310, 65, 25, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 598, '0000-00-00 00:00:00', 2104, 1),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '{\"139\":\"{r.2}\"}', 0, '3|2,2|1', '', '', '', '', '', '660', 660, 220, 220, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 597, '0000-00-00 00:00:00', 2105, 1),
(23, '迷雾森林', 64, 0, 1, 0, 0, 0, 0, 0, 0, '变异棕熊', 0, 6, '公', '这是一头经过变异的棕熊，身上的毛发像针一样竖了起来，双眼是恶狠狠的红色。', '', '{r.100}', '', '{\"139\":\"{r.2}\"}', 0, '3|2,2|1', '', '', '', '', '', '660', 660, 220, 220, 55, 35, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 597, '0000-00-00 00:00:00', 2106, 1),
(1, '旧街', 11, 0, 0, 0, 0, 0, 0, 0, 1, '莉莉安', 1, 1, '女', '她看起来三十多岁，一头金色波浪，脸上长着雀斑。', '', '', '', '', 0, '', '', '', '', '1,2', '', '100', 100, 0, 0, 10, 0, '', '', '1,3,10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 225, '0000-00-00 00:00:00', 2107, 1),
(1, '旧街', 13, 0, 0, 0, 0, 0, 0, 0, 1, '格兰特', 0, 1, '男', '他满脸灰尘，此刻正双腿交叉坐在自己的坐布上，右手还拎着一瓶欧念。', '', '', '', '', 0, '', '', '', '', '24', '', '100', 100, 0, 0, 1, 1, '', '', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 225, '0000-00-00 00:00:00', 2108, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 225, '0000-00-00 00:00:00', 2109, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 225, '0000-00-00 00:00:00', 2110, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 226, '0000-00-00 00:00:00', 2111, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 226, '0000-00-00 00:00:00', 2112, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 228, '0000-00-00 00:00:00', 2113, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 228, '0000-00-00 00:00:00', 2114, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 228, '0000-00-00 00:00:00', 2115, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 230, '0000-00-00 00:00:00', 2116, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 230, '0000-00-00 00:00:00', 2117, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 230, '0000-00-00 00:00:00', 2118, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 230, '0000-00-00 00:00:00', 2119, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 231, '0000-00-00 00:00:00', 2120, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 231, '0000-00-00 00:00:00', 2121, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 232, '0000-00-00 00:00:00', 2122, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 232, '0000-00-00 00:00:00', 2123, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 294, '0000-00-00 00:00:00', 2124, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 294, '0000-00-00 00:00:00', 2125, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 294, '0000-00-00 00:00:00', 2126, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 294, '0000-00-00 00:00:00', 2127, 1),
(1, '旧街', 50, 0, 0, 0, 0, 0, 1, 0, 1, '皮格', 0, 1, '男', '胖胖的中年男人，发明了很多〝黑暗料理〞，只有尝过的人才知道，不可名状之物的味道竟然出奇地好！不过他有个怪脾气，卖东西只卖给投缘的人。', '', '', '', '', 0, '', '28|6', '', '{u.tasks.t5} ==2', '', '', '100', 100, 0, 0, 1, 1, '', '', '5', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 294, '0000-00-00 00:00:00', 2128, 1),
(1, '旧街', 52, 0, 0, 0, 0, 0, 0, 0, 1, '迪伦斯', 0, 1, '男', '他似乎看起来精神状态不太好，披头散发的，也不知道能不能活到明天。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '6', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 294, '0000-00-00 00:00:00', 2129, 1),
(1, '旧街', 49, 0, 0, 0, 0, 0, 0, 0, 0, '歌尔特', 0, 10, '男', '经营着一个佣兵集团的佣兵头子，经常会发布一些悬赏任务，正在拿着一本羊皮笔记本写着什么。', '', '', '', '', 0, '1|10,8|10', '', '', '', '', '风啸佣兵团团长', '100', 100, 0, 0, 1, 1, '', '6,5', '4,8,7', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 295, '0000-00-00 00:00:00', 2130, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 295, '0000-00-00 00:00:00', 2131, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 295, '0000-00-00 00:00:00', 2132, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 295, '0000-00-00 00:00:00', 2133, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 295, '0000-00-00 00:00:00', 2134, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 296, '0000-00-00 00:00:00', 2135, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 296, '0000-00-00 00:00:00', 2136, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 296, '0000-00-00 00:00:00', 2137, 1),
(1, '旧街', 36, 0, 0, 0, 0, 0, 1, 0, 0, '杰德', 0, 1, '男', '一个旅行商人，但由于什么原因，在旧街停留了好长一阵子。', '', '', '', '', 0, '', '73|10|money', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 37, 0, 0, 0, 298, '0000-00-00 00:00:00', 2138, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 298, '0000-00-00 00:00:00', 2139, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 298, '0000-00-00 00:00:00', 2140, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 298, '0000-00-00 00:00:00', 2141, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 298, '0000-00-00 00:00:00', 2142, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 298, '0000-00-00 00:00:00', 2143, 1),
(1, '旧街', 35, 0, 0, 0, 0, 0, 1, 1, 1, '瓦尔金', 0, 1, '男', '他看起来有五十多岁了，脸上皱纹和伤疤已经分不清了，头上的白发和金发也难以辨别。', '', '', '', '', 0, '', '5|1,74|1,105|1,112|1', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '11', '22', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 299, '0000-00-00 00:00:00', 2144, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 299, '0000-00-00 00:00:00', 2145, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 299, '0000-00-00 00:00:00', 2146, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 299, '0000-00-00 00:00:00', 2147, 1),
(1, '旧街', 17, 0, 0, 0, 0, 0, 1, 0, 1, '薇儿', 0, 1, '女', '她看起来三十多岁，听说是个从荒野捡回来的失忆小女孩，她的养父「卡尔萨斯」给她取名「薇儿」。', '防具_7_26', '', '', '', 0, '', '1|99', '治疗.php', '', '', '', '100', 100, 0, 0, 1, 1, '', '2', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, '0000-00-00 00:00:00', 2148, 1),
(1, '旧街', 59, 0, 0, 0, 0, 0, 0, 0, 0, '卡尔萨斯', 0, 1, '男', '浮沉诊所的主人，留着一脸大胡子，是附近医术最好的医生。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, '0000-00-00 00:00:00', 2149, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, '0000-00-00 00:00:00', 2150, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 302, '0000-00-00 00:00:00', 2151, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 302, '0000-00-00 00:00:00', 2152, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 302, '0000-00-00 00:00:00', 2153, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 303, '0000-00-00 00:00:00', 2154, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 303, '0000-00-00 00:00:00', 2155, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 303, '0000-00-00 00:00:00', 2156, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 303, '0000-00-00 00:00:00', 2157, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 303, '0000-00-00 00:00:00', 2158, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 303, '0000-00-00 00:00:00', 2159, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 304, '0000-00-00 00:00:00', 2160, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 304, '0000-00-00 00:00:00', 2161, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 304, '0000-00-00 00:00:00', 2162, 1),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 308, '0000-00-00 00:00:00', 2163, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 308, '0000-00-00 00:00:00', 2164, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 308, '0000-00-00 00:00:00', 2165, 3),
(1, '旧街', 41, 0, 0, 0, 0, 0, 1, 1, 0, '安妮', 0, 1, '女', '她生得金发碧眼，很是抚媚，看起来二十几岁。', '', '', '', '', 0, '', '7|1|money,21|1,22|1,71|1', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 314, '0000-00-00 00:00:00', 2166, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 314, '0000-00-00 00:00:00', 2167, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 314, '0000-00-00 00:00:00', 2168, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 314, '0000-00-00 00:00:00', 2169, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 314, '0000-00-00 00:00:00', 2170, 1),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 338, '0000-00-00 00:00:00', 2171, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 338, '0000-00-00 00:00:00', 2172, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 338, '0000-00-00 00:00:00', 2173, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 346, '0000-00-00 00:00:00', 2174, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 346, '0000-00-00 00:00:00', 2175, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 346, '0000-00-00 00:00:00', 2176, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 346, '0000-00-00 00:00:00', 2177, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 347, '0000-00-00 00:00:00', 2178, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 348, '0000-00-00 00:00:00', 2179, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 348, '0000-00-00 00:00:00', 2180, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 349, '0000-00-00 00:00:00', 2181, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 349, '0000-00-00 00:00:00', 2182, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 349, '0000-00-00 00:00:00', 2183, 3),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 350, '0000-00-00 00:00:00', 2184, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 350, '0000-00-00 00:00:00', 2185, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 350, '0000-00-00 00:00:00', 2186, 1),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 351, '0000-00-00 00:00:00', 2187, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 351, '0000-00-00 00:00:00', 2188, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 351, '0000-00-00 00:00:00', 2189, 3),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 352, '0000-00-00 00:00:00', 2190, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 352, '0000-00-00 00:00:00', 2191, 1),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 353, '0000-00-00 00:00:00', 2192, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 353, '0000-00-00 00:00:00', 2193, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 353, '0000-00-00 00:00:00', 2194, 3),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 354, '0000-00-00 00:00:00', 2195, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 354, '0000-00-00 00:00:00', 2196, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 355, '0000-00-00 00:00:00', 2197, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, '0000-00-00 00:00:00', 2198, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, '0000-00-00 00:00:00', 2199, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, '0000-00-00 00:00:00', 2200, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 357, '0000-00-00 00:00:00', 2201, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 357, '0000-00-00 00:00:00', 2202, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 357, '0000-00-00 00:00:00', 2203, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 358, '0000-00-00 00:00:00', 2204, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 358, '0000-00-00 00:00:00', 2205, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 359, '0000-00-00 00:00:00', 2206, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 359, '0000-00-00 00:00:00', 2207, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 359, '0000-00-00 00:00:00', 2208, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 359, '0000-00-00 00:00:00', 2209, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 360, '0000-00-00 00:00:00', 2210, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 360, '0000-00-00 00:00:00', 2211, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 361, '0000-00-00 00:00:00', 2212, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 362, '0000-00-00 00:00:00', 2213, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 362, '0000-00-00 00:00:00', 2214, 1);
INSERT INTO `system_npc_scene` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `nmp`, `nmaxmp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`, `nmid`, `ncreat_time`, `ncid`, `nspeed`) VALUES
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 362, '0000-00-00 00:00:00', 2215, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 363, '0000-00-00 00:00:00', 2216, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 363, '0000-00-00 00:00:00', 2217, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 364, '0000-00-00 00:00:00', 2218, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 364, '0000-00-00 00:00:00', 2219, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 364, '0000-00-00 00:00:00', 2220, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 364, '0000-00-00 00:00:00', 2221, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 365, '0000-00-00 00:00:00', 2222, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 366, '0000-00-00 00:00:00', 2223, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 366, '0000-00-00 00:00:00', 2224, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 366, '0000-00-00 00:00:00', 2225, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 367, '0000-00-00 00:00:00', 2226, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 367, '0000-00-00 00:00:00', 2227, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 367, '0000-00-00 00:00:00', 2228, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 367, '0000-00-00 00:00:00', 2229, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 368, '0000-00-00 00:00:00', 2230, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 368, '0000-00-00 00:00:00', 2231, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 368, '0000-00-00 00:00:00', 2232, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 368, '0000-00-00 00:00:00', 2233, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 369, '0000-00-00 00:00:00', 2234, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 369, '0000-00-00 00:00:00', 2235, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 369, '0000-00-00 00:00:00', 2236, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 370, '0000-00-00 00:00:00', 2237, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 370, '0000-00-00 00:00:00', 2238, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 371, '0000-00-00 00:00:00', 2239, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 371, '0000-00-00 00:00:00', 2240, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 371, '0000-00-00 00:00:00', 2241, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 371, '0000-00-00 00:00:00', 2242, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 372, '0000-00-00 00:00:00', 2243, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 372, '0000-00-00 00:00:00', 2244, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 374, '0000-00-00 00:00:00', 2245, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 374, '0000-00-00 00:00:00', 2246, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 375, '0000-00-00 00:00:00', 2247, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 375, '0000-00-00 00:00:00', 2248, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 377, '0000-00-00 00:00:00', 2249, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 379, '0000-00-00 00:00:00', 2250, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 379, '0000-00-00 00:00:00', 2251, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 381, '0000-00-00 00:00:00', 2252, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 382, '0000-00-00 00:00:00', 2253, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 383, '0000-00-00 00:00:00', 2254, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 383, '0000-00-00 00:00:00', 2255, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 384, '0000-00-00 00:00:00', 2256, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 384, '0000-00-00 00:00:00', 2257, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 385, '0000-00-00 00:00:00', 2258, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 386, '0000-00-00 00:00:00', 2259, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 386, '0000-00-00 00:00:00', 2260, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 387, '0000-00-00 00:00:00', 2261, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 387, '0000-00-00 00:00:00', 2262, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 388, '0000-00-00 00:00:00', 2263, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 389, '0000-00-00 00:00:00', 2264, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 389, '0000-00-00 00:00:00', 2265, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 391, '0000-00-00 00:00:00', 2266, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 391, '0000-00-00 00:00:00', 2267, 1),
(1, '旧街', 51, 0, 1, 0, 0, 0, 0, 0, 0, '蓝蚊子', 0, 3, '母', '一到晚上，浑身身上就会发出幽蓝的亮光，很是梦幻，嗯，要是它们不冲过来吸干你的血的情况下。', '', '{r.50}', '', '{\"29\":\"{r.2}\"}', 0, '3|2', '', '', '', '', '', '260', 260, 50, 50, 30, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 392, '0000-00-00 00:00:00', 2268, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 393, '0000-00-00 00:00:00', 2269, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 393, '0000-00-00 00:00:00', 2270, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 393, '0000-00-00 00:00:00', 2271, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 394, '0000-00-00 00:00:00', 2272, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 394, '0000-00-00 00:00:00', 2273, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 394, '0000-00-00 00:00:00', 2274, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 394, '0000-00-00 00:00:00', 2275, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 395, '0000-00-00 00:00:00', 2276, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 395, '0000-00-00 00:00:00', 2277, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 395, '0000-00-00 00:00:00', 2278, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 396, '0000-00-00 00:00:00', 2279, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 396, '0000-00-00 00:00:00', 2280, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 396, '0000-00-00 00:00:00', 2281, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 397, '0000-00-00 00:00:00', 2282, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 398, '0000-00-00 00:00:00', 2283, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 399, '0000-00-00 00:00:00', 2284, 1),
(1, '旧街', 57, 0, 1, 0, 0, 0, 0, 0, 0, '红色乌鸦', 0, 4, '', '这只乌鸦全身的毛毛是瘆人的血色，但奇怪的是翅膀上有几根紫色的羽毛，它丶叫声异常的凄厉。', '', '', '', '{\"30\":\"{r.2}+1\"}', 0, '3|2', '', '', '', '', '', '300', 300, 160, 160, 40, 8, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 400, '0000-00-00 00:00:00', 2285, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 401, '0000-00-00 00:00:00', 2286, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 401, '0000-00-00 00:00:00', 2287, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 401, '0000-00-00 00:00:00', 2288, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 402, '0000-00-00 00:00:00', 2289, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 402, '0000-00-00 00:00:00', 2290, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 403, '0000-00-00 00:00:00', 2291, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 403, '0000-00-00 00:00:00', 2292, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 404, '0000-00-00 00:00:00', 2293, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 404, '0000-00-00 00:00:00', 2294, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 404, '0000-00-00 00:00:00', 2295, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 405, '0000-00-00 00:00:00', 2296, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 405, '0000-00-00 00:00:00', 2297, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 406, '0000-00-00 00:00:00', 2298, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 406, '0000-00-00 00:00:00', 2299, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 406, '0000-00-00 00:00:00', 2300, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 407, '0000-00-00 00:00:00', 2301, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 407, '0000-00-00 00:00:00', 2302, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 408, '0000-00-00 00:00:00', 2303, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 408, '0000-00-00 00:00:00', 2304, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 408, '0000-00-00 00:00:00', 2305, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 409, '0000-00-00 00:00:00', 2306, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 410, '0000-00-00 00:00:00', 2307, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 410, '0000-00-00 00:00:00', 2308, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 411, '0000-00-00 00:00:00', 2309, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 412, '0000-00-00 00:00:00', 2310, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 412, '0000-00-00 00:00:00', 2311, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 412, '0000-00-00 00:00:00', 2312, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 413, '0000-00-00 00:00:00', 2313, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 413, '0000-00-00 00:00:00', 2314, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 414, '0000-00-00 00:00:00', 2315, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 414, '0000-00-00 00:00:00', 2316, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 415, '0000-00-00 00:00:00', 2317, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 415, '0000-00-00 00:00:00', 2318, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 415, '0000-00-00 00:00:00', 2319, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 416, '0000-00-00 00:00:00', 2320, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 417, '0000-00-00 00:00:00', 2321, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 418, '0000-00-00 00:00:00', 2322, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 418, '0000-00-00 00:00:00', 2323, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 418, '0000-00-00 00:00:00', 2324, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 419, '0000-00-00 00:00:00', 2325, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 419, '0000-00-00 00:00:00', 2326, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 420, '0000-00-00 00:00:00', 2327, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 420, '0000-00-00 00:00:00', 2328, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 421, '0000-00-00 00:00:00', 2329, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 421, '0000-00-00 00:00:00', 2330, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 421, '0000-00-00 00:00:00', 2331, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 422, '0000-00-00 00:00:00', 2332, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 422, '0000-00-00 00:00:00', 2333, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 422, '0000-00-00 00:00:00', 2334, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 423, '0000-00-00 00:00:00', 2335, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 423, '0000-00-00 00:00:00', 2336, 1),
(1, '旧街', 58, 0, 1, 0, 0, 0, 0, 0, 0, '疯牛', 0, 5, '公', '这头牛已经疯了，眼睛发红，两对大角蠢蠢欲动。', '', '', '', '{\"37\":\"1\"}', 0, '3|2', '', '', '', '', '', '360', 360, 140, 140, 45, 15, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 423, '0000-00-00 00:00:00', 2337, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 424, '0000-00-00 00:00:00', 2338, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 425, '0000-00-00 00:00:00', 2339, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 425, '0000-00-00 00:00:00', 2340, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 425, '0000-00-00 00:00:00', 2341, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 426, '0000-00-00 00:00:00', 2342, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 427, '0000-00-00 00:00:00', 2343, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 428, '0000-00-00 00:00:00', 2344, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 428, '0000-00-00 00:00:00', 2345, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 429, '0000-00-00 00:00:00', 2346, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 429, '0000-00-00 00:00:00', 2347, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 429, '0000-00-00 00:00:00', 2348, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 430, '0000-00-00 00:00:00', 2349, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 430, '0000-00-00 00:00:00', 2350, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 431, '0000-00-00 00:00:00', 2351, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 431, '0000-00-00 00:00:00', 2352, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 431, '0000-00-00 00:00:00', 2353, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 432, '0000-00-00 00:00:00', 2354, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 433, '0000-00-00 00:00:00', 2355, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 433, '0000-00-00 00:00:00', 2356, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 434, '0000-00-00 00:00:00', 2357, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 434, '0000-00-00 00:00:00', 2358, 1),
(1, '旧街', 55, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼', 0, 4, '公', '一头灰狼，经历某种不知名突变，尾巴颜色带上了一点淡淡的蓝光。', '', '{r.100}', '', '', 0, '3|2,2|1', '', '', '', '', '', '380', 380, 120, 120, 35, 10, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 435, '0000-00-00 00:00:00', 2359, 1),
(1, '旧街', 56, 0, 1, 0, 1, 0, 0, 0, 0, '变异灰狼王', 0, 10, '母', '一头母灰狼，体型比一般灰狼更大，经历某种不知名突变，尾巴颜色带上了一点淡淡的红光。', '', '', '', '', 0, '3|2', '', '', '', '', '', '1000', 1000, 350, 350, 60, 30, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 436, '0000-00-00 00:00:00', 2360, 1),
(1, '旧街', 79, 0, 0, 0, 0, 0, 0, 0, 0, '赫米特', 0, 0, '女', '他穿着一身棕色的兽衣，背着一把复合弓，似乎正在瞄准什么。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 487, '0000-00-00 00:00:00', 2361, 1),
(1, '旧街', 60, 0, 0, 0, 0, 0, 0, 0, 0, '维奇', 0, 6, '男', '他通过层层选拔被选中为岗哨，成为了旧街居民发现危险的眼睛。', '兵器_3_120', '', '', '', 0, '', '', '', '', '', '旧街的岗哨', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 529, '0000-00-00 00:00:00', 2362, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 529, '0000-00-00 00:00:00', 2363, 1),
(0, '未分区', 53, 0, 0, 0, 0, 0, 0, 0, 0, '流浪商人', 0, 1, '男', '一个身穿白色长袍丶绑着蓝色头巾的流浪商人，在世界各地都能看到他们的身影。', '防具_4_44,防具_5_43', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 529, '0000-00-00 00:00:00', 2364, 1),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13,21,29,30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 554, '0000-00-00 00:00:00', 2365, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570, '0000-00-00 00:00:00', 2366, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570, '0000-00-00 00:00:00', 2367, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570, '0000-00-00 00:00:00', 2368, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570, '0000-00-00 00:00:00', 2369, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570, '0000-00-00 00:00:00', 2370, 1),
(1, '旧街', 67, 0, 1, 0, 0, 0, 0, 0, 0, '致命大黄蜂', 0, 4, '', '一只手掌大的黄蜂，尾巴有一根5cm左右长的毒刺。', '', '{r.100}', '', '', 0, '4|3,2|2', '', '', '', '', '', '120', 120, 50, 50, 25, 5, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 570, '0000-00-00 00:00:00', 2371, 1),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 571, '0000-00-00 00:00:00', 2372, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 571, '0000-00-00 00:00:00', 2373, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 571, '0000-00-00 00:00:00', 2374, 3),
(1, '旧街', 37, 0, 1, 1, 1, 0, 0, 0, 0, '变异黑耗子', 0, 2, '公', '这种耗子经过变异体型扩大了几倍，眼睛红到快要出血的样子。', '', '', '', '', 0, '3|5', '', '', '', '', '', '110', 110, 50, 50, 13, 10, '', '', '', 0, 0, 0, 0, 0, 125, 0, 0, 0, 0, 571, '0000-00-00 00:00:00', 2375, 3),
(1, '旧街', 63, 0, 0, 0, 0, 0, 1, 0, 1, '黛西', 0, 10, '女', '她是酒吧的女仆，看起来身材消瘦，但长着一双水汪汪的大眼睛，性感的小嘴唇，楚楚动人。', '防具_5_22', '', '', '', 0, '', '64|1,117|1,65|1,149|1', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 576, '0000-00-00 00:00:00', 2376, 1),
(1, '旧街', 62, 0, 0, 0, 0, 0, 0, 0, 0, '威尔海姆', 0, 10, '男', '他就是经营旧吧的老板，右手戴着一个奇怪的戒指，脸上写满了沧桑与故事。', '防具_9_122', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 576, '0000-00-00 00:00:00', 2377, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 576, '0000-00-00 00:00:00', 2378, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 576, '0000-00-00 00:00:00', 2379, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 576, '0000-00-00 00:00:00', 2380, 1),
(1, '旧街', 77, 0, 0, 0, 0, 0, 0, 0, 0, 'K-M', 0, 0, '男', '一个全身裹着风衣的奇怪男人，戴着一副很奇特的眼镜。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '12,15,16,17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 578, '0000-00-00 00:00:00', 2381, 1),
(1, '旧街', 61, 0, 0, 0, 0, 0, 0, 0, 0, '赛西', 0, 20, '女', '她身穿一件紫色长袍，戴着一顶锥形兜帽，看起来大约三十几岁，面容姣好，零星小雀斑不规则分布在泛红的脸颊上。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '13,21,29,30', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 578, '0000-00-00 00:00:00', 2382, 1),
(1, '旧街', 79, 0, 0, 0, 0, 0, 0, 0, 0, '赫米特', 0, 0, '女', '他穿着一身棕色的兽衣，背着一把复合弓，似乎正在瞄准什么。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 578, '0000-00-00 00:00:00', 2383, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 630, '0000-00-00 00:00:00', 2384, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 630, '0000-00-00 00:00:00', 2385, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 630, '0000-00-00 00:00:00', 2386, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 630, '0000-00-00 00:00:00', 2387, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 630, '0000-00-00 00:00:00', 2388, 1),
(1, '旧街', 77, 0, 0, 0, 0, 0, 0, 0, 0, 'K-M', 0, 0, '男', '一个全身裹着风衣的奇怪男人，戴着一副很奇特的眼镜。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '', '12,15,16,17', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 670, '0000-00-00 00:00:00', 2389, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 671, '0000-00-00 00:00:00', 2390, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 671, '0000-00-00 00:00:00', 2391, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 671, '0000-00-00 00:00:00', 2392, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 671, '0000-00-00 00:00:00', 2393, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 671, '0000-00-00 00:00:00', 2394, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 677, '0000-00-00 00:00:00', 2395, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 677, '0000-00-00 00:00:00', 2396, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 679, '0000-00-00 00:00:00', 2397, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 679, '0000-00-00 00:00:00', 2398, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 679, '0000-00-00 00:00:00', 2399, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 682, '0000-00-00 00:00:00', 2400, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 682, '0000-00-00 00:00:00', 2401, 1);
INSERT INTO `system_npc_scene` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `nmp`, `nmaxmp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`, `nmid`, `ncreat_time`, `ncid`, `nspeed`) VALUES
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 682, '0000-00-00 00:00:00', 2402, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 682, '0000-00-00 00:00:00', 2403, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 683, '0000-00-00 00:00:00', 2404, 1),
(0, '未分区', 81, 0, 1, 0, 0, 0, 0, 0, 0, '梦魇成长体', 0, 7, '无', '无尽的黑暗正在眼前上演，中间有一团邪恶的气息。', '', '', '', '', 0, '5|1', '', '', '', '', '', '777', 777, 0, 0, 70, 17, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 683, '0000-00-00 00:00:00', 2405, 1),
(1, '旧街', 11, 0, 0, 0, 0, 0, 0, 0, 1, '莉莉安', 1, 1, '女', '她看起来三十多岁，一头金色波浪，脸上长着雀斑。', '', '', '', '', 0, '', '', '', '', '1,2', '', '100', 100, 0, 0, 10, 0, '', '', '1,3,10', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 697, '0000-00-00 00:00:00', 2406, 1),
(1, '旧街', 13, 0, 0, 0, 0, 0, 0, 0, 1, '格兰特', 0, 1, '男', '他满脸灰尘，此刻正双腿交叉坐在自己的坐布上，右手还拎着一瓶欧念。', '', '', '', '', 0, '', '', '', '', '24', '', '100', 100, 0, 0, 1, 1, '', '', '2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 697, '0000-00-00 00:00:00', 2407, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 697, '0000-00-00 00:00:00', 2408, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 697, '0000-00-00 00:00:00', 2409, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 697, '0000-00-00 00:00:00', 2410, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 697, '0000-00-00 00:00:00', 2411, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, '0000-00-00 00:00:00', 2412, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 225, '0000-00-00 00:00:00', 2413, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 225, '0000-00-00 00:00:00', 2414, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 299, '0000-00-00 00:00:00', 2415, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 226, '0000-00-00 00:00:00', 2416, 1),
(1, '旧街', 18, 0, 1, 0, 0, 0, 0, 0, 0, '泥泞元素怪', 0, 1, '', '一种因宇宙射线引起淤泥变异的元素生物，浑身散发着恶臭的泥土味。', '', '{r.8}+1', '', '{\"25\":\"{r.2}\"}', 0, '2|1', '', '', '', '24,29', '', '50', 50, 10, 10, 10, 10, '', '', '', 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 232, '0000-00-00 00:00:00', 2417, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 226, '0000-00-00 00:00:00', 2418, 1),
(1, '旧街', 46, 0, 0, 0, 0, 0, 0, 0, 0, '流民', 0, 1, '', '杂乱的服饰，头部被一些破布紧紧包住，分不清是男是女，看着你出现，对方吓了一跳。', '', '', '', '', 0, '', '', '', '', '', '', '100', 100, 0, 0, 1, 1, '', '3', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 296, '0000-00-00 00:00:00', 2419, 1),
(0, '未分区', 48, 0, 1, 1, 0, 1, 0, 0, 0, '测试木桩你好', 0, 10, '', '你好。', '防具_4_7,防具_5_22,兵器_1_125', '100-{u.lvl}-150', '', '', 0, '7|1', '', '', '', '', '', '9999999999999999999999', 19980925, 19980925, 19980925, 1, 10, '', '', '', 195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 274, '0000-00-00 00:00:00', 2420, 1),
(0, '未分区', 48, 0, 1, 1, 0, 1, 0, 0, 0, '测试木桩你好', 0, 10, '', '你好。', '防具_4_7,防具_5_22,兵器_1_125', '100-{u.lvl}-150', '', '', 0, '7|1', '', '', '', '', '', '9999999999999999999999', 19980925, 19980925, 19980925, 1, 10, '', '', '', 195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 274, '0000-00-00 00:00:00', 2421, 1),
(0, '未分区', 48, 0, 1, 1, 0, 1, 0, 0, 0, '测试木桩你好', 0, 10, '', '你好。', '防具_4_7,防具_5_22,兵器_1_125', '100-{u.lvl}-150', '', '', 0, '7|1', '', '', '', '', '', '9999999999999999999999', 19980925, 19980925, 19980925, 1, 10, '', '', '', 195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 274, '0000-00-00 00:00:00', 2422, 1),
(0, '未分区', 48, 0, 1, 1, 0, 1, 0, 0, 0, '测试木桩你好', 0, 10, '', '你好。', '防具_4_7,防具_5_22,兵器_1_125', '100-{u.lvl}-150', '', '', 0, '7|1', '', '', '', '', '', '9999999999999999999999', 19980925, 19980925, 19980925, 1, 10, '', '', '', 195, 0, 0, 0, 0, 0, 0, 0, 0, 0, 274, '0000-00-00 00:00:00', 2423, 1);

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
  `pnid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pphoto` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `psid` text NOT NULL,
  `plvl` int(11) NOT NULL,
  `pexp` int(255) NOT NULL,
  `pmaxexp` int(255) NOT NULL,
  `php` int(255) NOT NULL,
  `pmaxhp` int(255) NOT NULL,
  `pgj` int(255) NOT NULL,
  `pfy` int(255) NOT NULL,
  `pstate` int(1) NOT NULL,
  `phunger` int(3) NOT NULL DEFAULT '500',
  `pthirst` int(3) NOT NULL DEFAULT '500',
  `pmood` int(4) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `system_pet_scene`
--

CREATE TABLE `system_pet_scene` (
  `narea_id` int(11) NOT NULL,
  `narea_name` varchar(255) NOT NULL,
  `nid` int(11) NOT NULL DEFAULT '0',
  `nstate` int(1) NOT NULL DEFAULT '0',
  `nkill` int(1) NOT NULL DEFAULT '0',
  `nnot_dead` int(1) NOT NULL DEFAULT '0',
  `nchuck` int(1) NOT NULL DEFAULT '1',
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
  `nhp` decimal(65,0) NOT NULL DEFAULT '0',
  `nmaxhp` int(11) NOT NULL DEFAULT '100',
  `nmp` int(11) NOT NULL,
  `nmaxmp` int(11) NOT NULL,
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
  `nminute_event_id` int(11) NOT NULL,
  `nmid` int(11) NOT NULL,
  `ncreat_time` datetime NOT NULL,
  `nsid` text NOT NULL,
  `npid` int(11) NOT NULL,
  `nspeed` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `system_pet_scene`
--

INSERT INTO `system_pet_scene` (`narea_id`, `narea_name`, `nid`, `nstate`, `nkill`, `nnot_dead`, `nchuck`, `nrefresh_time`, `nshop`, `nhock_shop`, `naccept_give`, `nname`, `nexp`, `nlvl`, `nsex`, `ndesc`, `nequips`, `ndrop_exp`, `ndrop_money`, `ndrop_item`, `ndrop_item_type`, `nskills`, `nshop_item_id`, `nmuban`, `nshop_cond`, `ntaskid`, `nnick_name`, `nhp`, `nmaxhp`, `nmp`, `nmaxmp`, `ngj`, `nfy`, `nimage`, `nop_target`, `ntask_target`, `ncreat_event_id`, `nlook_event_id`, `nattack_event_id`, `nwin_event_id`, `ndefeat_event_id`, `npet_event_id`, `nshop_event_id`, `nup_event_id`, `nheart_event_id`, `nminute_event_id`, `nmid`, `ncreat_time`, `nsid`, `npid`, `nspeed`) VALUES
(1, '旧街', 56, 0, 1, 0, 0, 0, 0, 0, 0, '变异灰狼王', 0, 10, '母', '一头母灰狼，体型比一般灰狼更大，经历某种不知名突变，尾巴颜色带上了一点淡淡的红光。', '', '', '', '', 0, '3|2', '', '', '', '', '', '1000', 1000, 186, 350, 60, 30, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 274, '0000-00-00 00:00:00', '959c9277a3e15eacff9e5f117e51f5bb', 55, 5),
(1, '旧街', 56, 0, 1, 0, 1, 0, 0, 0, 0, '变异灰狼王', 0, 10, '母', '一头母灰狼，体型比一般灰狼更大，经历某种不知名突变，尾巴颜色带上了一点淡淡的红光。', '', '', '', '', 0, '3|2', '', '', '', '', '', '1000', 1000, 189, 350, 60, 30, '', '', '', 0, 0, 0, 0, 0, 146, 0, 0, 0, 0, 523, '0000-00-00 00:00:00', '959c9277a3e15eacff9e5f117e51f5bb', 60, 3);

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
('sword_0001', '生锈的铁剑', '剑', 'images/剑/剑-sword_0001-生锈的铁剑.png', '', 'png'),
('map001_south', '旧街南', '旧街', 'images/旧街/旧街-map001_south-旧街南.png', 'height: 72px;width: 128px', 'png'),
('map001_west', '旧街西', '旧街', 'images/旧街/旧街-map001_west-旧街西.png', 'height: 72px;width: 128px', 'png'),
('map001_west_shop', '旧街临时市场', '旧街', 'images/旧街/旧街-map001_west_shop-旧街临时市场.png', 'height: 72px;width: 128px', 'png'),
('knife_0001', '粗糙的匕首', '刀', 'images/刀/刀-knife_0001-粗糙的匕首.png', '', 'png'),
('map001_center', '旧街广场', '旧街', 'images/旧街/旧街-map001_center-旧街广场.png', 'height: 128px; width: 128px', 'png'),
('gun-a-01', 'a-01猎豹', '枪', 'images/枪/枪-gun-a-01-a-01猎豹.jpeg', 'height: 4em', 'jpeg'),
('map_001_cloudroom', '迷雾小屋', '旧街', 'images/旧街/旧街-map_001_cloudroom-迷雾小屋.jpeg', 'height: 72px;width: 128px', 'jpeg'),
('map002_center', '希望镇广场', '希望镇', 'images/希望镇/希望镇-map002_center-希望镇广场.jpeg', 'height: 72px;width: 128px', 'jpeg'),
('map002_tomb', '无名墓地', '希望镇', 'images/希望镇/希望镇-map002_tomb-无名墓地.webp', 'height: 72px; width: 128px', 'webp'),
('map002_entrance', '希望镇入口', '希望镇', 'images/希望镇/希望镇-map002_entrance-希望镇入口.webp', 'height: 72px; width: 128px', 'webp'),
('npc001_ct', '希望镇巡逻警卫', '希望镇NPC', 'images/希望镇NPC/希望镇NPC-npc001_ct-希望镇巡逻警卫.jpeg', 'height: 4em', 'jpeg'),
('npc001_lingying', '凌影', '希望镇NPC', 'images/希望镇NPC/希望镇NPC-npc001_lingying-凌影.webp', 'height: 4em', 'webp'),
('npc001_maxiu', '马修', '希望镇NPC', 'images/希望镇NPC/希望镇NPC-npc001_maxiu-马修.webp', 'height: 4em', 'webp'),
('npc002_cathaya', '变异银杉树', '宁静森林NPC', 'images/宁静森林NPC/宁静森林NPC-npc002_cathaya-变异银杉树.webp', 'height: 4em', 'webp'),
('item001_alternator', '希望镇发电机终端', '希望镇重要物品', 'images/希望镇重要物品/希望镇重要物品-item001_alternator-希望镇发电机终端.webp', 'height: 4em', 'webp'),
('item001_tower', '大型立体式培养药罐', '希望镇重要物品', 'images/希望镇重要物品/希望镇重要物品-item001_tower-大型立体式培养药罐.webp', 'height: 4em', 'webp'),
('npc001_dkle', '达克莱尔', '希望镇NPC', 'images/希望镇NPC/希望镇NPC-npc001_dkle-达克莱尔.webp', 'height: 4em', 'webp'),
('item001_mobileterminal', 'KM的便捷终端机', '希望镇重要物品', 'images/希望镇重要物品/希望镇重要物品-item001_mobileterminal-KM的便捷终端机.jpeg', 'height: 4em', 'jpeg'),
('npc001_bicuisi', '碧翠丝', '希望镇NPC', 'images/希望镇NPC/希望镇NPC-npc001_bicuisi-碧翠丝.webp', 'height: 4em', 'webp'),
('player_46', '玩家46', '玩家形象照', 'images/玩家形象照/玩家形象照-player_46-玩家46.jpeg', 'height: 128px;width: 128px', 'jpeg'),
('player_8', '玩家8', '玩家形象照', 'images/玩家形象照/玩家形象照-player_8-玩家8.jpeg', 'height: 128px;width: 128px', 'jpeg'),
('player_1', '玩家1', '玩家形象照', 'images/玩家形象照/玩家形象照-player_1-玩家1.png', 'height: 128px;width: 128px', 'png');

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
('旧街', '5'),
('剑', '1'),
('刀', '1'),
('枪', '1'),
('希望镇', '3'),
('希望镇NPC', '5'),
('宁静森林NPC', '1'),
('希望镇重要物品', '3'),
('玩家形象照', '3');

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
  `uhp` int(11) NOT NULL DEFAULT '0',
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
  `ukill` tinyint(1) DEFAULT '0',
  `ugongji` int(11) NOT NULL DEFAULT '0',
  `ufangyu` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `system_player_aircraft`
--

CREATE TABLE `system_player_aircraft` (
  `sid` text NOT NULL,
  `aircraft_name` varchar(255) NOT NULL,
  `aircraft_cons` int(11) NOT NULL,
  `aircraft_distance` int(11) NOT NULL,
  `aircraft_speed` int(11) NOT NULL DEFAULT '1000',
  `aircraft_begin_id` int(11) NOT NULL,
  `aircraft_over_id` int(11) NOT NULL,
  `aircraft_durable` int(11) NOT NULL DEFAULT '200',
  `aircraft_max_durable` int(11) NOT NULL DEFAULT '200'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_player_aircraft`
--

INSERT INTO `system_player_aircraft` (`sid`, `aircraft_name`, `aircraft_cons`, `aircraft_distance`, `aircraft_speed`, `aircraft_begin_id`, `aircraft_over_id`, `aircraft_durable`, `aircraft_max_durable`) VALUES
('959c9277a3e15eacff9e5f117e51f5bb', '迷失未来', 200, 0, 1000, 784, 782, 200, 200);

-- --------------------------------------------------------

--
-- 表的结构 `system_player_black`
--

CREATE TABLE `system_player_black` (
  `usid` text NOT NULL,
  `osid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('959c9277a3e15eacff9e5f117e51f5bb', '飞翔的荷兰人号', 200, 0, 255, 343, 342, 200, 200);

-- --------------------------------------------------------

--
-- 表的结构 `system_player_friend`
--

CREATE TABLE `system_player_friend` (
  `usid` text NOT NULL,
  `osid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_player_friend`
--

INSERT INTO `system_player_friend` (`usid`, `osid`) VALUES
('269d6f1d2272bf0f3af7633340052a03', '959c9277a3e15eacff9e5f117e51f5bb'),
('2be824d1d1eaf47b51176faf90a5b8c9', 'f5f8f28ae6c3fb5529d578a31cfcf72d'),
('2be824d1d1eaf47b51176faf90a5b8c9', '7c936037baabb3f953d1247ac57fd33d'),
('7c936037baabb3f953d1247ac57fd33d', '2be824d1d1eaf47b51176faf90a5b8c9'),
('959c9277a3e15eacff9e5f117e51f5bb', '269d6f1d2272bf0f3af7633340052a03');

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
-- 表的结构 `system_player_land`
--

CREATE TABLE `system_player_land` (
  `sid` text NOT NULL,
  `land_name` varchar(255) NOT NULL,
  `land_cons` int(11) NOT NULL,
  `land_distance` int(11) NOT NULL,
  `land_speed` int(11) NOT NULL DEFAULT '400',
  `land_begin_id` int(11) NOT NULL,
  `land_over_id` int(11) NOT NULL,
  `land_durable` int(11) NOT NULL DEFAULT '100',
  `land_max_durable` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_player_land`
--

INSERT INTO `system_player_land` (`sid`, `land_name`, `land_cons`, `land_distance`, `land_speed`, `land_begin_id`, `land_over_id`, `land_durable`, `land_max_durable`) VALUES
('959c9277a3e15eacff9e5f117e51f5bb', '机械毛驴', 200, 0, 100, 0, 0, 200, 200);

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
(4, '防御榜', '{u.fy}', '', 10, 0),
(5, '在线榜', '{u.zxsj}', '', 10, 0);

-- --------------------------------------------------------

--
-- 表的结构 `system_region`
--

CREATE TABLE `system_region` (
  `belong` int(11) NOT NULL COMMENT '//所属大区域，0失落之地，1日出之地，2灼热之地，3日落之地，4极寒之地，5湿热之地',
  `pos` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sail_hide` int(1) NOT NULL DEFAULT '0',
  `sky_hide` int(1) NOT NULL DEFAULT '0',
  `road_hide` int(1) NOT NULL DEFAULT '0',
  `change_cond` text NOT NULL,
  `cmmt2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_region`
--

INSERT INTO `system_region` (`belong`, `pos`, `id`, `name`, `sail_hide`, `sky_hide`, `road_hide`, `change_cond`, `cmmt2`) VALUES
(0, 0, 0, '失落之地', 1, 1, 1, '', ''),
(0, 1, 1, '日出之地', 0, 0, 0, '', ''),
(0, 2, 2, '灼热之地', 0, 0, 0, '', ''),
(0, 3, 3, '日落之地', 0, 0, 0, '', ''),
(0, 4, 4, '极寒之地', 0, 0, 0, '{u.ic.i35}>0', '你没有极寒之地地图。'),
(0, 5, 5, '湿热之地', 0, 0, 0, '', ''),
(0, 6, 6, '幻想之地', 1, 0, 1, '', '');

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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `call_sum` int(11) DEFAULT '0',
  `not_return` int(1) NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_self_define_module`
--

INSERT INTO `system_self_define_module` (`pos`, `id`, `name`, `call_sum`, `not_return`, `css`, `js`) VALUES
(1, 'test', '签到', 0, 0, '', 'console.log(\"Hello, World!\");'),
(2, 'tent', '旧街帐篷', 54, 0, '', ''),
(3, 'HW003', '希望镇露天浴场终端', 94, 0, '', ''),
(4, 'bounty_01', '歌尔特日常悬赏', 3, 0, '', ''),
(5, 'HP_lift_1', '希望镇小区一区电梯', 5, 0, '', ''),
(6, 'vip', 'vip界面', 0, 0, '', ''),
(7, 'future_prison', '未来城囚牢终端', 30, 0, '', ''),
(8, 'vehicle', '海陆空载具', 7, 0, '', ''),
(9, 'szcs', '数组测试', 3, 0, '', ''),
(10, 'sc', '商城', 0, 0, '', ''),
(11, 'vvvv', '多重v语句测试', 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `system_shop`
--

CREATE TABLE `system_shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_desc` varchar(255) NOT NULL,
  `item_list` text NOT NULL,
  `buy_input_pos` int(1) NOT NULL,
  `one_page_count` int(11) NOT NULL,
  `one_css` text NOT NULL,
  `one_detail_css` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_shop`
--

INSERT INTO `system_shop` (`shop_id`, `shop_name`, `shop_desc`, `item_list`, `buy_input_pos`, `one_page_count`, `one_css`, `one_detail_css`) VALUES
(2, '测试商城', '', '1,5', 1, 8, '{item_name_url}({item_money}{item_money_unit}{item_money_name})\r\n{input_pos}{submit_pos}\r\n-\r\n', '{item_name_text}({item_money}{item_money_unit}{item_money_name})\r\n简介：{item_desc}\r\n{input_pos}{submit_pos}\r\n{last_page}');

-- --------------------------------------------------------

--
-- 表的结构 `system_shop_item`
--

CREATE TABLE `system_shop_item` (
  `belong` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `bind_iid` int(11) NOT NULL,
  `sale_open_time` datetime NOT NULL,
  `sale_close_time` datetime NOT NULL,
  `sale_money_type` text NOT NULL,
  `sale_money` int(20) NOT NULL,
  `sale_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_shop_item`
--

INSERT INTO `system_shop_item` (`belong`, `id`, `bind_iid`, `sale_open_time`, `sale_close_time`, `sale_money_type`, `sale_money`, `sale_discount`) VALUES
(2, 23, 1, '2025-03-03 22:06:00', '2025-03-03 22:03:00', 'money2', 10, 100),
(2, 24, 5, '2025-03-03 22:03:00', '2025-03-03 22:03:00', 'money2', 10, 100);

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
  `jevent_up_id` int(11) NOT NULL COMMENT '升级事件指向id',
  `jgongji` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_skill`
--

INSERT INTO `system_skill` (`jname`, `jid`, `jdesc`, `joccasion`, `jimage`, `jhurt_mod`, `jgroup_attack`, `jcooling_time`, `jcooling_round`, `jhurt_attr`, `jdeplete_attr`, `jhurt_exp`, `jdeplete_exp`, `jequip_type`, `jequip_appoint`, `juse_cond`, `jcant_use_cmmt`, `jadd_point_exp`, `jpromotion`, `jpromotion_cond`, `jeffect_cmmt`, `jevent_use_id`, `jevent_up_id`, `jgongji`) VALUES
('普通攻击', 1, '生物的战斗本能。', 0, '', '1', 1, 0, 0, 'hp', 'mp', '{e.damage}+{u.gj}', '3', 19980925, '', '', '', '{m.lvl}', '{m.lvl}*{m.lvl}', '{m.lvl}<10', '', 0, 0, 1),
('冲撞', 2, '单纯用蛮力撞向敌人的手段。', 0, '', '3', 1, 0, 0, 'hp', 'hp', '{e.damage}', '', 19980925, '', '', '', '', '{e.sk_lvl}', '', '{u.name}猛地朝着{o.name}扑撞了过去！', 0, 0, 1),
('撕咬', 3, '这似乎是变异后的生物自然进化出的本能。', 0, '', '5', 2, 0, 0, 'hp', 'mp', '{e.damage}+99', '', 19980925, '', '', '', '', '', '', '{u.name}猛地向{o.name}一扑，使出一招{m.name}，粘稠的唾液附着在尖锐的牙齿上朝{o.name}咬去!', 201, 0, 1),
('蜇击', 4, '利用毒刺进行攻击的行为。', 0, '', '4', 1, 0, 0, 'hp', 'exp', '{e.damage}', '1', 19980925, '', '', '', '1', '', '', '{u.name}亮起了毒刺，狠狠地朝{o.name}扎了过去！', 0, 0, 1),
('堕落之梦', 5, '这是梦魇生物的天生本能技能，是一种强大的精神攻击。', 0, '', '20', 1, 0, 0, 'hp', 'money', '{e.damage}', '3', 19980925, '', '', '', '', '', '', '{u.name}使用堕落之梦，{o.name}感到灵魂有些疲惫。', 0, 0, 1),
('毒液溅射', 6, '喷溅剧毒的体液对敌方造成百分比伤害。', 0, '', '6', 1, 0, 0, 'hp', 'mp', '{o.hp}/({r.5}+10)', '', 19980925, '', '', '', '', '', '', '{u.name}使用{m.name}，{o.name}顿时感觉身体极度不适。', 0, 0, 1),
('GM之力', 7, 'GM的力量', 0, '', '1', 1, 0, 0, 'hp', 'mp', '1', '2', 19980925, '', '', '', '', '', '', '打了{o.name}{ot.cut_hp}伤害。', 0, 0, 0),
('街头拳击', 8, '混迹街头，哪能不有几分本事?', 0, '', '10', 1, 0, 0, 'hp', 'mp', '{e.damage}', '', 19980925, '', '', '', '', '', '', '{u.name}对{o.name}使用了{m.name}，招招阴狠，直指{o.name}要害之处。', 0, 0, 0);

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
  `jevent_up_id` int(11) NOT NULL COMMENT '升级事件指向id',
  `jgongji` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_skill_module`
--

INSERT INTO `system_skill_module` (`jid`, `jhurt_attr`, `jdeplete_attr`, `jhurt_exp`, `jdeplete_exp`, `jadd_point_exp`, `jpromotion`, `jpromotion_cond`, `jeffect_cmmt`, `jevent_use_id`, `jevent_up_id`, `jgongji`) VALUES
(1, 'hp', 'money', '', '', '', '{m.lvl}*10', '1', '', 0, 0, 1),
(2, 'hp', 'mp', '(({u.lvl}*({r.100}+20)+{m.lvl}*8+({m.hurt_mod}*({m.lvl}+18)/6)+{u.gj}*8)-({r.o.lvl}+10)*8-{o.fy}*3)', '1', '', '{eval(v(e.sk_lvl))}', '1', '{eval(v(u.equips.b.count)==0?\"v(u.name)使用v(m.name)对v(o.name)一阵乱打。\":\"v(u.name)挥动v(u.equips.b.name)对v(o.name)一阵乱砍。\")}', 214, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `system_skill_user`
--

CREATE TABLE `system_skill_user` (
  `jsid` varchar(255) NOT NULL,
  `jid` int(10) UNSIGNED NOT NULL,
  `jlvl` int(11) NOT NULL COMMENT '技能等级',
  `jpoint` int(11) NOT NULL COMMENT '当前熟练度',
  `jdefault` int(1) NOT NULL COMMENT '0为非默认，1为默认，在自动战斗中生效',
  `jpid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_skill_user`
--

INSERT INTO `system_skill_user` (`jsid`, `jid`, `jlvl`, `jpoint`, `jdefault`, `jpid`) VALUES
('f244e629c0bc88068f2ecd6baf212683', 1, 1, 0, 0, 0),
('76623f3a68872fa88502af535498a991', 1, 1, 0, 0, 0),
('e3130d019f7689f5501bc3633f97eb88', 1, 1, 0, 0, 0),
('2f4746d4d36396302d36e51c969d3e68', 1, 1, 0, 0, 0),
('01acd0637eb2b6a6a3055e4fc37e8457', 1, 4, 2, 0, 0),
('fe3319b6dd10f68aaa36ee852cd79cc1', 1, 1, 0, 1, 0),
('f55913444ef985484baf7580c60f15ce', 1, 1, 18, 0, 0),
('945fd26d30e007abfed414cc1f2795f5', 1, 8, 12, 0, 0),
('79462faa70c368423c7f9fb106fa1f47', 1, 1, 0, 0, 0),
('01a0d4f5e64a677721a1089d4914bc6a', 1, 1, 3, 0, 0),
('a8c7b0c51c60be7441214c0b0c671d88', 1, 1, 0, 0, 0),
('214658c4375c343e280ae38e880ac4ba', 1, 1, 23, 0, 0),
('c618319c00c8a0ddfc15fefbe3f4f898', 1, 1, 0, 0, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 1, 17, 1, 0, 0),
('f4cd01caaf9ec17c03413de91b97b5f2', 1, 1, 2, 0, 0),
('344773e829d514e37d748e906a4f020a', 1, 1, 0, 0, 0),
('46fbdae565140a8d73246e1e01f64b66', 1, 1, 0, 0, 0),
('4e792f072d10eb2f6addd8d04cf5cbe8', 1, 10, 0, 1, 0),
('98c50608a11ec800fba8b2d0b7294aeb', 1, 1, 0, 0, 0),
('269d6f1d2272bf0f3af7633340052a03', 1, 6, 2, 1, 0),
('14ff4a179003b2934da7305a76f718ea', 1, 1, 0, 1, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 3, 1, 0, 0, 60),
('740c4edeb4bb99c86b2a9b6ee4321422', 1, 1, 0, 0, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 6, 1, 1, 1, 60),
('0961f64bfc048e983d34059857ffaffa', 1, 1, 0, 0, 0),
('b17c95134e98e11fd56a4d9edfd0df0d', 1, 1, 0, 0, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 3, 1, 0, 1, 55),
('11949d9ce6df5a06a3377325c71c7c4f', 1, 1, 0, 0, 0),
('f3c4859c79f6f34ac79072571744bf8e', 1, 1, 0, 0, 0),
('79ca852ae3c34e005ba8db7ca9f2429e', 1, 1, 0, 0, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 7, 1, 0, 1, 0),
('0732ec1c98e6496b097d7bee1482d96d', 1, 1, 0, 0, 0),
('40499b34a8c1fd21aca27a6f780913b7', 1, 1, 0, 0, 0),
('712f6f87ae511e72bec397c34b66341e', 1, 1, 0, 0, 0),
('3f47043a9d21b1e33eafe14c8e43ff23', 1, 1, 0, 0, 0),
('c654e54b080f01395814de4cc5a56a36', 1, 2, 2, 0, 0),
('997e35c67ee90c752adcafcb9146ef0c', 1, 2, 2, 0, 0),
('79734573fabe99c2d7b9730fb55b8179', 1, 1, 0, 0, 0),
('1031e7b699b6b7c0591c7bd314656738', 1, 1, 0, 0, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 8, 1, 0, 0, 0),
('959c9277a3e15eacff9e5f117e51f5bb', 6, 1, 0, 0, 0),
('18280efc59907bd2fb48b26d077e374c', 1, 1, 0, 0, 0),
('428ef3d7da115de87950f34ca0d6ea65', 1, 1, 0, 0, 0),
('945fd26d30e007abfed414cc1f2795f5', 5, 1, 0, 0, 0),
('75f1c222ad8c86ed1fa97f4026ccbb49', 1, 1, 0, 0, 0),
('1f50c749d050ef9cb714a1987d044462', 1, 3, 3, 1, 0),
('d772445edc9d6a2be038c82c9fd09c31', 1, 1, 0, 0, 0),
('11bcf4429ca461cbb0a1bd8bbbb804c7', 1, 1, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_storage`
--

INSERT INTO `system_storage` (`ibelong_mid`, `item_true_id`, `sid`, `uid`, `iid`, `icount`, `ibind`, `iroot`) VALUES
(287, 154, '959c9277a3e15eacff9e5f117e51f5bb', 1, 72, 1, 0, ''),
(287, 594, '959c9277a3e15eacff9e5f117e51f5bb', 1, 5, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `system_storage_locked`
--

CREATE TABLE `system_storage_locked` (
  `ibelong_mid` int(11) NOT NULL COMMENT '//所属地图',
  `sid` varchar(255) NOT NULL,
  `istate` int(1) NOT NULL COMMENT '0代表没锁，1代表锁住',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_storage_locked`
--

INSERT INTO `system_storage_locked` (`ibelong_mid`, `sid`, `istate`, `password`) VALUES
(287, '959c9277a3e15eacff9e5f117e51f5bb', 0, '1'),
(611, '959c9277a3e15eacff9e5f117e51f5bb', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `system_task`
--

CREATE TABLE `system_task` (
  `tbelong` int(11) NOT NULL COMMENT '属于哪个父任务系列',
  `tid` int(11) NOT NULL,
  `tname` varchar(255) NOT NULL,
  `tnpc_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system_task`
--

INSERT INTO `system_task` (`tbelong`, `tid`, `tname`, `tnpc_id`, `ttype`, `ttype2`, `tgiveup`, `treaccept`, `taccept_lvl`, `tcond`, `taccept_cond`, `tcmmt1`, `tcmmt2`, `ttarget_event_accept`, `ttarget_event_giveup`, `ttarget_event_finish`, `ttarget_obj`) VALUES
(1, 1, '留下的证明', 11, 2, 1, 0, 1, 1, '', '', '', '「莉莉安」：呦，这是怕了?想证明自己的价值就去东边的河流那吧！', 14, 0, 196, '25|3'),
(1, 2, '急切的交易', 13, 2, 2, 0, 0, 0, '{u.tasks.t1}==2', '', '', '「格兰特」：快点，我现在急需这个东西，要不是我分身乏术才不会叫你帮这个忙！', 19, 0, 20, '24|5'),
(1, 3, '莉莉安的书信', 11, 3, 1, 0, 0, 0, '{u.tasks.t8} == 2', '', '', '「莉莉安」:快去吧，去探明「希望镇」发生了什么，我等你的好消息！去希望小区1区306看看吧！', 22, 0, 0, ''),
(1, 4, '变异的老鼠', 49, 1, 1, 0, 0, 0, '{u.tasks.t1}==2', '', '「歌尔特」：你的实力太弱了，哼！', '「歌尔特」：怎么，几只老鼠都杀不了吗?', 35, 0, 36, '37|4'),
(1, 5, '皮格的美味实验', 50, 2, 1, 0, 0, 0, '{u.tasks.t4}==2', '', '「皮格」盯着你上下看了好几眼，然后才瞪着你说道：快滚蛋，我看你不顺眼！', '「皮格」：蓝蚊子的血+巨型苍蝇的卵+水元素生物的粘液，emmm，也许还要再来点迦仕敦的酒...你怎么还在这?说几遍了，蓝蚊子在那片灰青草地上，能找到不?再找不到我煮完这锅美味我就自己去了！', 38, 0, 43, '29|5'),
(1, 6, '迪伦斯的现状', 52, 3, 2, 0, 0, 0, '{u.tasks.t4} ==2', '', '', '「迪伦斯」：乌鸦，好多乌鸦。。。\r\n（去找歌尔特聊聊吧）', 41, 0, 0, ''),
(1, 7, '乌鸦的谜团', 49, 2, 2, 0, 0, 0, '{u.tasks.t6}==2', '', '', '「歌尔特」：去找找看看吧！往「灰青草地」深处找找，紫色的羽毛。', 42, 0, 53, '30|5'),
(1, 8, '清剿狼群', 49, 1, 1, 0, 0, 0, '{u.tasks.t5}==2', '', '', '「歌尔特」：狼群的存在威胁着旧街的安全！\r\n「歌尔特」：羊羔肉卷饼怎么一个卖4.5块了!昨天还是4.2块的!', 48, 0, 50, '55|6'),
(1, 9, '希望镇的困境', 68, 3, 1, 0, 0, 0, '{u.tasks.t3}==2', '', '', '「姗妮」：快回去吧，时间紧迫!', 86, 0, 109, ''),
(1, 10, '众人拾柴火焰高', 11, 2, 1, 0, 0, 0, '{u.tasks.t9}==2', '', '', '「莉莉安」：支援行动不是一件小事，我们需要一只先遣队的力量来组建「先驱者小队」先行一步，需要女巫丶黑客和猎人的力量，去想办法取得「赛西」丶「K-M」丶「赫米特」的信物来吧，事态紧急，一切从简。', 93, 0, 105, '132|1,133|1,134|1'),
(1, 11, '测试任务', 80, 3, 1, 0, 0, 0, '', '', '', '', 96, 0, 0, ''),
(1, 12, 'K-M的爱好', 77, 2, 1, 0, 0, 0, '{u.tasks.t10}==1', '', '', '「K-M」：土豆饼的味道，是玛格尼斯的记忆。', 99, 0, 100, '65|1'),
(1, 13, '赛西的梦魇', 61, 1, 1, 0, 0, 0, '{u.tasks.t10}==1', '', '', '「赛西」：那些东西在虚实之间，妄想触及真实的世界。', 101, 0, 104, '81|7'),
(1, 14, '赫米特的烦恼', 79, 2, 1, 0, 0, 0, '{u.tasks.t10}==1', '', '', '「赫米特」：该怎么搭一个好看又好用的小屋呢。', 106, 0, 107, '45|20'),
(1, 15, '前往希望镇.一', 77, 1, 1, 0, 0, 0, '{u.tasks.t10}==2', '', '', '「KM」：赶紧处理掉前面的大黄蜂，既然接下了任务，我们必须尽快赶往希望镇！', 114, 0, 115, '67|6'),
(1, 16, '前往希望镇.二', 77, 2, 1, 0, 0, 0, '{u.tasks.t15}==2', '', '', '「KM」：森林里危机重重，我们需要赶紧收集「赛西」需要的材料炼制驱魔药。', 117, 0, 118, '139|3,140|1,141|6'),
(1, 17, '前往希望镇.三', 77, 3, 1, 0, 0, 0, '{u.tasks.t16}==2', '', '', '「KM」：去找凌影聊聊当前的情况吧！', 119, 0, 121, ''),
(1, 18, '希望镇的困境', 75, 2, 1, 0, 0, 0, '{u.tasks.t17}==2', '', '', '「凌影」：这些变异生物简直是一把把悬在头上的刀，不知道何时会落下！', 120, 0, 127, '144|1,145|1,146|1'),
(1, 19, '未命名', 75, 1, 1, 0, 0, 0, '{u.tasks.t19}==2', '', '', '', 0, 0, 0, ''),
(1, 20, '奇怪的印记', 70, 2, 1, 0, 0, 0, '{u.tasks.t18}==2', '', '', '「马修」：一切的工作都需要等到你们寻到那「变异银杉树汁」才能继续开展！', 129, 0, 145, '148|1'),
(1, 21, '进入沼泽地', 61, 3, 1, 0, 0, 0, '{u.tasks.t20}==1', '', '', '', 130, 0, 0, ''),
(1, 22, '瓦尔金的研究', 35, 2, 2, 0, 0, 0, '{u.tasks.t10}==2', '', '', '「瓦尔金」：我对我自己的理论和发现很有信心！\r\n(取得铜矿三块锡矿4块变异黑土5块交给瓦尔金)', 142, 0, 143, '40|4,39|3,25|5'),
(1, 23, '神秘的代码', 98, 3, 1, 0, 0, 0, '{u.tasks.t20}==2', '', '', '「碧翠丝」：「守时」真的是一个天才，那么复杂的量子生命论都能研究出来，赶紧去找我的朋友「蒂娜」吧，等待你们的归来！', 146, 0, 159, ''),
(1, 24, '灰色交易', 100, 2, 2, 0, 0, 0, '{u.tasks.t23}==2', '', '', '「云骁」：墨墨迹迹的，要一瓶黑雾城的酒这么难吗?', 153, 0, 158, '138|1'),
(1, 25, '蒂娜的请求', 102, 2, 1, 0, 0, 0, '{u.tasks.t23}==2', '', '', '「蒂娜」：呵呵，等价交换的原则哦，我的手帕就在皇后街东的铁牛烧烤摊那边哦。', 176, 0, 183, '162|1'),
(1, 26, '手帕的下落', 104, 3, 1, 0, 0, 0, '{u.tasks.t25}==1', '', '', '「张铁牛」：去找秃鹰帮的二麻子拿吧!', 177, 0, 0, ''),
(1, 27, '进入秃鹰帮', 107, 3, 1, 0, 0, 0, '{u.tasks.t26}==2', '', '', '「巡卫」：义士您找二麻子，他就在走廊尽头左拐第一间屋子里面，有仇报仇有怨报怨，我等只是一月领二千未来币的打工人罢了。', 178, 0, 0, ''),
(1, 28, '击败二麻子', 105, 1, 1, 0, 0, 0, '{u.tasks.t27}==2', '', '', '二麻子：想要啊?那就打赢我吧!', 180, 0, 182, '105|1'),
(1, 29, '虚境的秘密', 61, 3, 1, 0, 0, 0, '{u.tasks.t25}==2', '', '', '「赛西」：我们得抓紧时间赶去黑雾城!', 184, 0, 0, ''),
(1, 30, '进入虚境', 61, 3, 1, 0, 0, 0, '', '', '', '「赛西」：门已经给你打开了，看来，余下的路只能你自己走下去了。', 186, 0, 0, ''),
(1, 31, '醉醺醺的酒鬼', 110, 2, 1, 0, 0, 0, '', '', '', '「莱兹.恩」：纯白的圣地啊，您为何要放弃您最忠实的仆人呢?', 197, 0, 0, '165|1');

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
  `f_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL COMMENT '系列名称',
  `f_desc` varchar(255) NOT NULL COMMENT '系列介绍'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `system_task_father`
--

INSERT INTO `system_task_father` (`f_id`, `f_name`, `f_desc`) VALUES
(1, '未知系列', '未知系列任务');

-- --------------------------------------------------------

--
-- 表的结构 `system_task_user`
--

CREATE TABLE `system_task_user` (
  `tid` int(11) NOT NULL,
  `sid` text NOT NULL,
  `tnowcount` varchar(255) NOT NULL COMMENT '//当前任务进度数量,格式:id|数量',
  `tstate` int(1) NOT NULL COMMENT '//任务状态，1未完成2已完成'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '712f6f87ae511e72bec397c34b66341e', '25|0', 1),
(1, '40499b34a8c1fd21aca27a6f780913b7', '25|0', 1),
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
(18, '959c9277a3e15eacff9e5f117e51f5bb', '144|1,145|1,146|1', 2),
(1, '269d6f1d2272bf0f3af7633340052a03', '25|0', 1),
(1, '0732ec1c98e6496b097d7bee1482d96d', '25|0', 1),
(7, '4e792f072d10eb2f6addd8d04cf5cbe8', '30|5', 2),
(6, '4e792f072d10eb2f6addd8d04cf5cbe8', '', 2),
(5, '4e792f072d10eb2f6addd8d04cf5cbe8', '29|5', 2),
(4, '4e792f072d10eb2f6addd8d04cf5cbe8', '37|4', 2),
(2, '4e792f072d10eb2f6addd8d04cf5cbe8', '24|5', 2),
(1, '4e792f072d10eb2f6addd8d04cf5cbe8', '25|3', 2),
(1, '740c4edeb4bb99c86b2a9b6ee4321422', '25|0', 1),
(20, '959c9277a3e15eacff9e5f117e51f5bb', '148|1', 2),
(21, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(22, '959c9277a3e15eacff9e5f117e51f5bb', '40|4,39|3,25|5', 2),
(1, '14ff4a179003b2934da7305a76f718ea', '25|0', 1),
(23, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(24, '959c9277a3e15eacff9e5f117e51f5bb', '138|1', 2),
(1, '11949d9ce6df5a06a3377325c71c7c4f', '25|0', 1),
(1, 'f3c4859c79f6f34ac79072571744bf8e', '25|0', 1),
(1, '79ca852ae3c34e005ba8db7ca9f2429e', '25|0', 1),
(25, '959c9277a3e15eacff9e5f117e51f5bb', '162|1', 2),
(26, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(27, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(28, '959c9277a3e15eacff9e5f117e51f5bb', '105|1', 2),
(29, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(30, '959c9277a3e15eacff9e5f117e51f5bb', '', 2),
(1, '3f47043a9d21b1e33eafe14c8e43ff23', '25|0', 1),
(1, 'c654e54b080f01395814de4cc5a56a36', '25|0', 1),
(1, '1f50c749d050ef9cb714a1987d044462', '25|0', 1),
(8, '4e792f072d10eb2f6addd8d04cf5cbe8', '55|6', 2),
(3, '4e792f072d10eb2f6addd8d04cf5cbe8', '', 2),
(9, '4e792f072d10eb2f6addd8d04cf5cbe8', '', 1),
(1, '11bcf4429ca461cbb0a1bd8bbbb804c7', '25|0', 1);

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
(1, '无敌', '666', '23', '23', 0, '2024-09-17 16:47:44', '1|44');

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
('12345678', 'lwd54088', '05ee93c4c6d65097cf576b439e6a7413', NULL, 0),
('qqqqqq', 'qqqqqq', '76e1a946158fed2415d33ba4e58bbe06', NULL, 0),
('wowgm1', 'wowgm1', '137033b69556ca35b8fb9da749db1a57', NULL, 0),
('ss123as', 'ss123as', '40ec9b3fb84f1d1c082d2e9df3d733b1', NULL, 0),
('decent001', '0116152881', '51a8c1a197e4c37ce59cc3af3b5c5d5e', NULL, 0),
('111112', '111111', '8a92f5f23dae59c409b4ef40012ce0d2', NULL, 0),
('334455', '334455', 'f716ebf9b02ce37a5a5530c8fe3c305b', NULL, 0),
('System0001', '112233', 'e23be328f7688ce960d47e9b4773c85d', NULL, 0),
('12erer', '121212', 'bea8e66969f4bcdaefedaa7bf6995ec3', NULL, 0),
('1212er', '1212er', '36310ea1a682b2574b5e99df4aa30097', NULL, 0),
('741945033', '741945033', 'a5f991264806f81164bbd92267c2824d', NULL, 0),
('1234567', 'lwd54088', 'cd1da21c393f3f7000b7538a9e3e3b3b', NULL, 0),
('leifx0792', '3152560', 'd7a145c2d6a9057895f5396f0a4f98b6', NULL, 0),
('lu7110', '123456', 'e9b4d3f3056b4f6d3184802a0a65ae9f', NULL, 0),
('xiaolei', 'xiaolei123', 'bc3006729315b7585b27d81bf0274990', NULL, 0),
('396823203', '396823203', '9a5cf8228a277c9c78d3d1d96ba9634a', NULL, 0),
('qq12345', 'qq12345', '3b6fff6a88c3fab2b21212dc1b5676c3', NULL, 0),
('quwanme', 'quwanme', '2a7ecdd538729a8426a01968c38fa3fd', NULL, 0),
('tiger123', 'tiger123456', '0515e74c53238527a0984ec7d0c2b40e', NULL, 0),
('test123', '123123', 'ad5ba9f6bc0c1ceff956e352a1c1c06e', NULL, 0),
('h123456', 'h123456', 'b071448562b7cc0823f2f175d8a1b9b4', NULL, 0),
('xunxian1', '123456', 'c566f5f84eea89926745b6ad790e917f', NULL, 0),
('k666kkk', 'h123456', '915e74aeb7dacd7cff046fb717442c84', NULL, 0),
('xunxian007', 'xunxian', 'd39a06ebe169ffccf1512794b8f731dc', NULL, 0),
('15639218532', '123654897', '723f505d88b6db518af0e156d26ed9ec', NULL, 0),
('backdoor', 'A@111111', 'e6dbb8b8b41d9c21d22811c06671a25e', NULL, 0),
('qwer1234', '5203344.', '1b3f92a425ccab85cb8010ef1067c774', NULL, 0),
('pipixia888', '5203344.', 'a81940087b5f178b64d9aa14199e7ca7', NULL, 0),
('xiaohaha', '111111', 'ec48ace33ac5046062b6416de507e72d', NULL, 0),
('qq894490616', '111111', 'ba1380d41be69537aff83a18fcdc17fd', NULL, 0),
('heiyulin', 'heiyulin', '5338ef3de7fd72cdc5749874f8ca5fd8', NULL, 0),
('diyu09', '123456', '77c380c398eca339712d35e4c883569d', NULL, 0),
('11223344', 'lwd54088', 'f2244dcbb21b08836a5f0f747367ab0e', NULL, 0),
('sansan', '123456', '4df2e27e9291efe9b9cacdf2a443c313', NULL, 0),
('1170191170', '123456', '51547217b283793f56da7e8211bc69b0', NULL, 0);

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
  ADD PRIMARY KEY (`uid`),
  ADD KEY `idx_sid` (`sid`);

--
-- 表的索引 `game_equip_detail_page`
--
ALTER TABLE `game_equip_detail_page`
  ADD PRIMARY KEY (`id`);

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
-- 表的索引 `game_self_page_future_prison`
--
ALTER TABLE `game_self_page_future_prison`
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
-- 表的索引 `game_self_page_sc`
--
ALTER TABLE `game_self_page_sc`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_szcs`
--
ALTER TABLE `game_self_page_szcs`
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
-- 表的索引 `game_self_page_vehicle`
--
ALTER TABLE `game_self_page_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_vip`
--
ALTER TABLE `game_self_page_vip`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `game_self_page_vvvv`
--
ALTER TABLE `game_self_page_vvvv`
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
-- 表的索引 `player_clan_apply`
--
ALTER TABLE `player_clan_apply`
  ADD PRIMARY KEY (`apply_id`) USING BTREE;

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
-- 表的索引 `system_clan_list`
--
ALTER TABLE `system_clan_list`
  ADD PRIMARY KEY (`clan_id`);

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
-- 表的索引 `system_item_type`
--
ALTER TABLE `system_item_type`
  ADD PRIMARY KEY (`itid`);

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
-- 表的索引 `system_map_cache`
--
ALTER TABLE `system_map_cache`
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
-- 表的索引 `system_npc_drop_list`
--
ALTER TABLE `system_npc_drop_list`
  ADD PRIMARY KEY (`drop_id`);

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
-- 表的索引 `system_npc_scene`
--
ALTER TABLE `system_npc_scene`
  ADD PRIMARY KEY (`ncid`);

--
-- 表的索引 `system_oplayer`
--
ALTER TABLE `system_oplayer`
  ADD PRIMARY KEY (`oid`) USING BTREE;

--
-- 表的索引 `system_pet_player`
--
ALTER TABLE `system_pet_player`
  ADD PRIMARY KEY (`pid`);

--
-- 表的索引 `system_pet_scene`
--
ALTER TABLE `system_pet_scene`
  ADD PRIMARY KEY (`npid`);

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
-- 表的索引 `system_region`
--
ALTER TABLE `system_region`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`pos`);

--
-- 表的索引 `system_shop`
--
ALTER TABLE `system_shop`
  ADD PRIMARY KEY (`shop_id`) USING BTREE;

--
-- 表的索引 `system_shop_item`
--
ALTER TABLE `system_shop_item`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用表AUTO_INCREMENT `game_equip_detail_page`
--
ALTER TABLE `game_equip_detail_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `game_main_page`
--
ALTER TABLE `game_main_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `game_npc_page`
--
ALTER TABLE `game_npc_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `game_oplayer_page`
--
ALTER TABLE `game_oplayer_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `game_pet_page`
--
ALTER TABLE `game_pet_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `game_player_page`
--
ALTER TABLE `game_player_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `game_pve_page`
--
ALTER TABLE `game_pve_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `game_scene_page`
--
ALTER TABLE `game_scene_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- 使用表AUTO_INCREMENT `game_self_page_bounty_01`
--
ALTER TABLE `game_self_page_bounty_01`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `game_self_page_future_prison`
--
ALTER TABLE `game_self_page_future_prison`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- 使用表AUTO_INCREMENT `game_self_page_sc`
--
ALTER TABLE `game_self_page_sc`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_self_page_szcs`
--
ALTER TABLE `game_self_page_szcs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `game_self_page_tent`
--
ALTER TABLE `game_self_page_tent`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_self_page_test`
--
ALTER TABLE `game_self_page_test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `game_self_page_vehicle`
--
ALTER TABLE `game_self_page_vehicle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `game_self_page_vip`
--
ALTER TABLE `game_self_page_vip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `game_self_page_vvvv`
--
ALTER TABLE `game_self_page_vvvv`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `game_skill_page`
--
ALTER TABLE `game_skill_page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `gm_game_attr`
--
ALTER TABLE `gm_game_attr`
  MODIFY `pos` int(11) NOT NULL AUTO_INCREMENT COMMENT ' 位置', AUTO_INCREMENT=98;

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2100;

--
-- 使用表AUTO_INCREMENT `system_clan_list`
--
ALTER TABLE `system_clan_list`
  MODIFY `clan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `system_draw`
--
ALTER TABLE `system_draw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '它的id是什么', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `system_equip_def`
--
ALTER TABLE `system_equip_def`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `system_equip_user`
--
ALTER TABLE `system_equip_user`
  MODIFY `eqid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '源id', AUTO_INCREMENT=294;

--
-- 使用表AUTO_INCREMENT `system_event`
--
ALTER TABLE `system_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- 使用表AUTO_INCREMENT `system_exp_def`
--
ALTER TABLE `system_exp_def`
  MODIFY `pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `system_fb`
--
ALTER TABLE `system_fb`
  MODIFY `fbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `system_item`
--
ALTER TABLE `system_item`
  MODIFY `item_true_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=674;

--
-- 使用表AUTO_INCREMENT `system_item_module`
--
ALTER TABLE `system_item_module`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- 使用表AUTO_INCREMENT `system_item_type`
--
ALTER TABLE `system_item_type`
  MODIFY `itid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_lp`
--
ALTER TABLE `system_lp`
  MODIFY `lp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_map`
--
ALTER TABLE `system_map`
  MODIFY `mid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=871;

--
-- 使用表AUTO_INCREMENT `system_map_cache`
--
ALTER TABLE `system_map_cache`
  MODIFY `mid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_mk`
--
ALTER TABLE `system_mk`
  MODIFY `mk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_npc`
--
ALTER TABLE `system_npc`
  MODIFY `nid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- 使用表AUTO_INCREMENT `system_npc_drop_list`
--
ALTER TABLE `system_npc_drop_list`
  MODIFY `drop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_npc_midguaiwu`
--
ALTER TABLE `system_npc_midguaiwu`
  MODIFY `ngid` int(11) NOT NULL AUTO_INCREMENT COMMENT '怪物id主键';

--
-- 使用表AUTO_INCREMENT `system_npc_scene`
--
ALTER TABLE `system_npc_scene`
  MODIFY `ncid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2424;

--
-- 使用表AUTO_INCREMENT `system_oplayer`
--
ALTER TABLE `system_oplayer`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_pet_player`
--
ALTER TABLE `system_pet_player`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `system_pet_scene`
--
ALTER TABLE `system_pet_scene`
  MODIFY `npid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_rp`
--
ALTER TABLE `system_rp`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `system_self_define_module`
--
ALTER TABLE `system_self_define_module`
  MODIFY `pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `system_shop`
--
ALTER TABLE `system_shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `system_shop_item`
--
ALTER TABLE `system_shop_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用表AUTO_INCREMENT `system_skill`
--
ALTER TABLE `system_skill`
  MODIFY `jid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `system_task_father`
--
ALTER TABLE `system_task_father`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
