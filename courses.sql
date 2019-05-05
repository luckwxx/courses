-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-05-05 06:09:25
-- 服务器版本： 8.0.12
-- PHP 版本： 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `courses`
--

-- --------------------------------------------------------

--
-- 表的结构 `apps`
--

CREATE TABLE `apps` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `subname` varchar(200) NOT NULL,
  `describe` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `ver_id` int(11) NOT NULL,
  `bundle_id` text NOT NULL,
  `logo0` varchar(200) NOT NULL,
  `logo1` varchar(200) NOT NULL,
  `pv` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
;

-- --------------------------------------------------------

--
-- 表的结构 `app_vers`
--

CREATE TABLE `app_vers` (
  `id` mediumint(9) NOT NULL,
  `ver` varchar(20) NOT NULL,
  `app_id` int(11) NOT NULL,
  `package` varchar(250) NOT NULL,
  `ver_build` varchar(20) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
;

-- --------------------------------------------------------

--
-- 表的结构 `course_group`
--

CREATE TABLE `course_group` (
  `id` mediumint(9) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `introduce` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4  NOT NULL,
  `content_type` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `color` varchar(11) NOT NULL DEFAULT '0xffffff',
  `enroll` tinyint(1) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL DEFAULT '0',
  `home` tinyint(1) NOT NULL DEFAULT '0',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
;

--
-- 转存表中的数据 `course_group`
--

INSERT INTO `course_group` (`id`, `user_id`, `title`, `introduce`, `cover_image`, `type`, `content_type`, `label`, `color`, `enroll`, `top`, `home`, `update_time`, `create_time`) VALUES
(1, 11, 'title', 'introduce', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label', '0xffffff', 0, 0, 0, '2018-11-23 13:23:00', '2018-11-23 13:23:00'),

-- --------------------------------------------------------

--
-- 表的结构 `course_section`
--

CREATE TABLE `course_section` (
  `id` mediumint(9) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `introduce` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `update_time` datetime NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
;

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `item`
--

INSERT INTO `item` (`id`, `item_name`) VALUES
(1, 'Hello World.1'),
(2, 'Lets go!'),
(4, 'sdfasvaew'),
(5, '点击添加');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `nickname`, `avatar`, `create_time`) VALUES
(11, '123456', NULL, '2018-11-16 23:15:09'),
(12, '123456', NULL, '2018-11-16 23:15:50'),
(13, '123456', NULL, '2018-11-19 08:15:00'),
(14, '123456', NULL, '2018-11-23 10:20:07'),
(15, 'we3twrq', NULL, '2018-11-23 00:00:00'),
(16, '', NULL, '2019-04-24 21:13:15'),
(17, '', NULL, '2019-04-24 21:14:34'),
(18, 'root3', NULL, '2019-04-24 21:18:03');

-- --------------------------------------------------------

--
-- 表的结构 `user_auths`
--

CREATE TABLE `user_auths` (
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `identity_type` mediumint(9) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `credential` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
;

--
-- 转存表中的数据 `user_auths`
--

INSERT INTO `user_auths` (`id`, `user_id`, `identity_type`, `identifier`, `credential`, `login_time`, `create_time`) VALUES
(5, 11, 1, '5', 'e10adc3949ba59abbe56e057f20f883e', '2019-04-24 19:32:51', '2018-11-16 23:15:09'),
(6, 12, 1, '1', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-24 21:11:07', '2018-11-16 23:15:50'),
(7, 13, 1, '2', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-19 08:15:00', '2018-11-19 08:15:00'),
(8, 14, 1, 'fasdf', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-23 10:20:07', '2018-11-23 10:20:07'),
(9, 16, 1, 'root', 'aabb2100033f0352fe7458e412495148', '2019-04-30 14:25:50', '2019-04-24 21:13:15'),
(10, 17, 1, 'root1', 'aabb2100033f0352fe7458e412495148', '2019-04-26 13:32:06', '2019-04-24 21:14:34'),
(11, 18, 1, 'root3', 'aabb2100033f0352fe7458e412495148', '2019-04-24 21:18:11', '2019-04-24 21:18:03');

--
-- 转储表的索引
--

--
-- 表的索引 `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `app_vers`
--
ALTER TABLE `app_vers`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `course_group`
--
ALTER TABLE `course_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `course_section`
--
ALTER TABLE `course_section`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user_auths`
--
ALTER TABLE `user_auths`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

-- 使用表AUTO_INCREMENT `course_group`
--
ALTER TABLE `course_group`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `course_section`
--
ALTER TABLE `course_section`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `user_auths`
--
ALTER TABLE `user_auths`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
