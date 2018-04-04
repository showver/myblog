-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-11-23 03:02:21
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `my_blog`
--

CREATE TABLE IF NOT EXISTS `my_blog` (
  `b_id` int(32) NOT NULL AUTO_INCREMENT,
  `id` int(32) NOT NULL,
  `c_id` int(32) NOT NULL,
  `b_title` varchar(32) NOT NULL,
  `b_bar` varchar(50) NOT NULL,
  `b_content` text NOT NULL,
  `b_pubtime` int(32) NOT NULL,
  `look` int(32) NOT NULL,
  `b_type` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `my_blog`
--

INSERT INTO `my_blog` (`b_id`, `id`, `c_id`, `b_title`, `b_bar`, `b_content`, `b_pubtime`, `look`, `b_type`) VALUES
(25, 11, 65, '投入他的风格', '郭德纲的风格', '个大概豆腐干地方', 1511266976, 44, 0),
(24, 11, 65, '45453456', '韩国和规范的', '感到反感的', 1511266966, 44, 0);

-- --------------------------------------------------------

--
-- 表的结构 `my_class`
--

CREATE TABLE IF NOT EXISTS `my_class` (
  `c_id` int(50) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(100) NOT NULL,
  `f_id` int(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `level` int(50) NOT NULL,
  `add_time` int(32) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- 转存表中的数据 `my_class`
--

INSERT INTO `my_class` (`c_id`, `f_name`, `f_id`, `path`, `level`, `add_time`) VALUES
(65, 'ai广告', 1, '0,1,65', 2, 1510137236),
(71, 'ai w ', 70, '0,1,70,71', 3, 1510065048),
(66, '惹ffrr', 1, '0,1,66', 2, 1510065034),
(73, '日日日', 65, '0,1,65,73', 3, 1510137305),
(72, 'web开发', 0, '0,72', 1, 1510120101),
(70, 'ai w恶意', 1, '0,1,70,71', 3, 1510137221);

-- --------------------------------------------------------

--
-- 表的结构 `my_gro`
--

CREATE TABLE IF NOT EXISTS `my_gro` (
  `uid` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `my_gro`
--

INSERT INTO `my_gro` (`uid`, `name`) VALUES
(0, '管理员'),
(1, '游客'),
(2, '美女宝宝');

-- --------------------------------------------------------

--
-- 表的结构 `my_pinglun`
--

CREATE TABLE IF NOT EXISTS `my_pinglun` (
  `p_id` int(50) NOT NULL AUTO_INCREMENT,
  `b_id` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `p_content` text NOT NULL,
  `p_pubtime` int(32) NOT NULL,
  `p_shenhe` int(10) NOT NULL DEFAULT '0',
  `p_zhuangtai` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `my_pinglun`
--

INSERT INTO `my_pinglun` (`p_id`, `b_id`, `id`, `p_content`, `p_pubtime`, `p_shenhe`, `p_zhuangtai`) VALUES
(1, 25, 11, 'hjksdahfjkfjnfkjshnfjksdfjksdfjsdhfjk', 55234563, 0, 1),
(2, 25, 11, 'dsfsg额方法噶发撒', 2556464, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `my_user`
--

CREATE TABLE IF NOT EXISTS `my_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `cretime` int(32) NOT NULL,
  `gro` int(20) NOT NULL,
  `shell` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `my_user`
--

INSERT INTO `my_user` (`id`, `user`, `pwd`, `cretime`, `gro`, `shell`) VALUES
(15, '6666', '666666', 66, 0, 11),
(17, '5555555', '5555555555', 1509029070, 0, 888),
(8, '3是1', '33', 1508819856, 0, 33333),
(11, '我00', '123456', 1508809860, 0, 3455),
(12, '饿', '222222', 1508765124, 0, 22),
(18, '小美女', '123456', 1509029106, 2, 888),
(32, '3323', '2333434', 1509356020, 0, 888),
(27, 'weige ', '123456', 1509276708, 1, 888),
(21, '4444', '444', 1509029793, 1, 888),
(22, '111', '1111', 1509029852, 0, 888),
(23, '5555', '5555', 1509029887, 1, 888),
(24, '22222', '2222', 1509274159, 1, 888),
(25, 'uuu', 'uuuuuu', 1509030091, 0, 888),
(26, '游客', '123456', 1509271144, 1, 888),
(28, 'ooo', '123456', 1509278283, 0, 888),
(29, '111', '11111111', 1509278537, 2, 888),
(30, '222', '11111111', 1509278833, 1, 888),
(31, '3333', '4444444444444', 1509279071, 1, 888),
(33, '66777', 'wwwww', 1511233111, 0, 888);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
