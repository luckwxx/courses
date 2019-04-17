-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-04-17 02:33:45
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
  `update_time` datetime NOT NULL ,
  `create_time` datetime NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  ;

--
-- 转存表中的数据 `course_group`
--

INSERT INTO `course_group` (`id`, `user_id`, `title`, `introduce`, `cover_image`, `type`, `content_type`, `label`, `color`, `enroll`, `top`, `home`, `update_time`, `create_time`) VALUES
(1, 11, 'title', 'introduce', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label', '0xffffff', 0, 0, 0, '2018-11-23 13:23:00', '2018-11-23 13:23:00'),
(2, 12, 'title晚饭前无法', 'introduce暗示法确定', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 13:24:21', '2018-11-23 13:24:21'),
(3, 13, 'title晚饭', 'introduce暗示法确定', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 13:24:25', '2018-11-23 13:24:25'),
(4, 11, 'title晚饭', 'introduce暗示法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 13:24:28', '2018-11-23 13:24:28'),
(5, 12, '12', 'introduce暗示法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 13:37:02', '2018-11-23 13:37:02'),
(6, 12, '12问题', 'introduce暗示法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 14:23:10', '2018-11-23 14:23:10'),
(7, 12, '12问题安抚', 'introduce暗示法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 14:23:12', '2018-11-23 14:23:12'),
(8, 12, '12问题安抚暗室逢灯', 'introduce暗示安抚法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 14:23:16', '2018-11-23 14:23:16'),
(9, 12, '1安慰', 'introduce暗示安抚法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-23 14:23:19', '2018-11-23 14:23:19'),
(10, 11, '1安慰2', 'introduce暗示安抚法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-24 14:24:17', '2018-11-23 14:24:17'),
(11, 12, 'title晚饭', 'introduce暗示法', '/upload/img/650a5bb99fef3ecfd47e93728fad97bb.png', 'type', 'content_type', 'label阿萨德', '0xffffff', 0, 0, 0, '2018-11-24 13:04:26', '2018-11-24 13:04:26');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `nickname`, `avatar`, `create_time`) VALUES
(11, '123456', NULL, '2018-11-16 23:15:09'),
(12, '123456', NULL, '2018-11-16 23:15:50'),
(13, '123456', NULL, '2018-11-19 08:15:00'),
(14, '123456', NULL, '2018-11-23 10:20:07'),
(15, 'we3twrq', NULL, '2018-11-23 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  ;

--
-- 转存表中的数据 `user_auths`
--

INSERT INTO `user_auths` (`id`, `user_id`, `identity_type`, `identifier`, `credential`, `login_time`, `create_time`) VALUES
(5, 11, 1, '5', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-16 23:15:09', '2018-11-16 23:15:09'),
(6, 12, 1, '1', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-24 21:11:07', '2018-11-16 23:15:50'),
(7, 13, 1, '2', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-19 08:15:00', '2018-11-19 08:15:00'),
(8, 14, 1, 'fasdf', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-23 10:20:07', '2018-11-23 10:20:07');

--
-- 转储表的索引
--

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
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `user_auths`
--
ALTER TABLE `user_auths`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
