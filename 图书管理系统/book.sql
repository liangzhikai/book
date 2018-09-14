-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-09-14 01:23:20
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- 表的结构 `bk_admin`
--

CREATE TABLE `bk_admin` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_admin`
--

INSERT INTO `bk_admin` (`id`, `name`, `password`) VALUES
(5, '123qwe', '46f94c8de14fb36680850768ff1b7f'),
(4, 'chen3', '46f94c8de14fb36680850768ff1b7f2a');

-- --------------------------------------------------------

--
-- 表的结构 `bk_article`
--

CREATE TABLE `bk_article` (
  `id` mediumint(9) NOT NULL COMMENT '文章id',
  `time` date NOT NULL,
  `iy` int(11) NOT NULL COMMENT '库存',
  `gi` int(11) NOT NULL COMMENT '总库存',
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `author` varchar(30) NOT NULL COMMENT '作者',
  `thumb` varchar(160) NOT NULL COMMENT '缩略图',
  `loan` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点击数',
  `zan` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `cateid` mediumint(9) NOT NULL COMMENT '所属栏目',
  `publish` varchar(60) NOT NULL,
  `money` varchar(60) NOT NULL,
  `number` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_article`
--

INSERT INTO `bk_article` (`id`, `time`, `iy`, `gi`, `title`, `keywords`, `desc`, `author`, `thumb`, `loan`, `zan`, `rec`, `cateid`, `publish`, `money`, `number`) VALUES
(58, '2018-07-11', 63, 100, '美国历史', '历史', '浏览量', 'aga', '/book/public\\uploads/20180914\\b24c35d5caf55af998a262163c81648f.jpg', 39, 0, 0, 82, '中国邮政', '99', '123456'),
(59, '2018-06-23', 10, 10, '中国历史', '中国', '中国历史', '梁先生', '/book/public\\uploads/20180914\\22745a5a75bf129822d902da4039f3d6.jpg', 0, 0, 0, 82, '中国邮政', '34', '11112222'),
(60, '1997-11-07', 99, 99, '美食', '美食', '介绍美食', 'aga', '/book/public\\uploads/20180914\\3dce4d38de02faa54a452bd602139b3b.jpg', 0, 0, 0, 88, '中国邮政', '99', '888888'),
(61, '1997-11-07', 99, 99, '动物百科1', '动物', '动物', 'aga', '/book/public\\uploads/20180914\\3d0b8d9898676ded4a70f37165d1d99c.jpg', 0, 0, 0, 89, '中国邮政', '99', '33333'),
(62, '1997-11-07', 99, 99, '动物百科2', '动物', '动物', 'aga', '/book/public\\uploads/20180914\\6b7e70d39ad1630933d985d8a8539ffd.jpg', 0, 0, 0, 89, '中国邮政', '99', '444444'),
(63, '1997-11-07', 99, 99, '动物百科3', '动物', '动物', 'aga', '/book/public\\uploads/20180914\\1b7b8178a58bdf77aee6f1dfd75550fe.jpg', 0, 0, 0, 89, '中国邮政', '99', '555555'),
(64, '1997-11-07', 99, 99, '世界历史', '历史', '历史', 'aga', '/book/public\\uploads/20180914\\65fe864055c78d4ab945158e03ee2327.jpg', 0, 0, 0, 82, '中国邮政', '99', '99999999'),
(65, '1997-11-07', 99, 99, '恐龙探秘', '动物', '恐龙', 'aga', '/book/public\\uploads/20180914\\eacd01aa5db8b8c422dc85880d32fce9.jpg', 0, 0, 0, 89, '中国邮政', '99', '5555555');

-- --------------------------------------------------------

--
-- 表的结构 `bk_brrow`
--

CREATE TABLE `bk_brrow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_number` int(11) NOT NULL,
  `book_title` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_brrow`
--

INSERT INTO `bk_brrow` (`id`, `user_id`, `book_number`, `book_title`) VALUES
(46, 8, 123456, '美国历史');

-- --------------------------------------------------------

--
-- 表的结构 `bk_cate`
--

CREATE TABLE `bk_cate` (
  `id` mediumint(9) NOT NULL COMMENT '栏目id',
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '栏目类型：1:文章列表栏目 2:单页栏目3：图片列表',
  `keywords` varchar(255) NOT NULL COMMENT '栏目关键词',
  `desc` varchar(255) NOT NULL COMMENT '栏目描述',
  `content` text NOT NULL COMMENT '栏目内容',
  `rec_index` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `rec_bottom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '上级栏目id',
  `sort` mediumint(9) NOT NULL DEFAULT '50' COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_cate`
--

INSERT INTO `bk_cate` (`id`, `catename`, `type`, `keywords`, `desc`, `content`, `rec_index`, `rec_bottom`, `pid`, `sort`) VALUES
(82, '历史', 1, '历史', '历史', '<p>历史上下五千年<br/></p>', 0, 0, 0, 50),
(88, '美食', 1, '美食', '美食', '<p>介绍美食<br/></p>', 0, 0, 0, 50),
(89, '动物世界', 1, '动物', '动物', '<p>动物<br/></p>', 0, 0, 0, 50);

-- --------------------------------------------------------

--
-- 表的结构 `bk_record`
--

CREATE TABLE `bk_record` (
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `book_number` mediumint(9) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `book_title` varchar(30) NOT NULL,
  `book_thumb` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL,
  `time` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_record`
--

INSERT INTO `bk_record` (`id`, `user_id`, `book_number`, `user_name`, `book_title`, `book_thumb`, `type`, `time`) VALUES
(16, 8, 123456, 'chen3', '美国历史', '/book/public\\uploads/20180907\\1839c296793a280519d502de97d7a08e.jpg', '0', '2018-09-11');

-- --------------------------------------------------------

--
-- 表的结构 `bk_user`
--

CREATE TABLE `bk_user` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `ava` varchar(160) NOT NULL COMMENT '头像',
  `sex` char(2) NOT NULL,
  `personal` varchar(60) NOT NULL COMMENT '身份证',
  `credit` mediumint(9) NOT NULL COMMENT '信誉'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_user`
--

INSERT INTO `bk_user` (`id`, `name`, `age`, `email`, `address`, `phone`, `ava`, `sex`, `personal`, `credit`) VALUES
(8, 'chen3', '45', '121341324@qq.com', '大师', '1901290121212', '/book//public\\uploads/20180908\\b13031114e80768789f1c5de0d02d0c6.jpg', '1', '123456789', 11111);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bk_admin`
--
ALTER TABLE `bk_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_article`
--
ALTER TABLE `bk_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_brrow`
--
ALTER TABLE `bk_brrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_cate`
--
ALTER TABLE `bk_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_record`
--
ALTER TABLE `bk_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_user`
--
ALTER TABLE `bk_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bk_admin`
--
ALTER TABLE `bk_admin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `bk_article`
--
ALTER TABLE `bk_article`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '文章id', AUTO_INCREMENT=67;
--
-- 使用表AUTO_INCREMENT `bk_brrow`
--
ALTER TABLE `bk_brrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- 使用表AUTO_INCREMENT `bk_cate`
--
ALTER TABLE `bk_cate`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '栏目id', AUTO_INCREMENT=90;
--
-- 使用表AUTO_INCREMENT `bk_record`
--
ALTER TABLE `bk_record`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `bk_user`
--
ALTER TABLE `bk_user`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
