-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?12 �?19 �?09:39
-- 服务器版本: 5.7.18-log
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `oppo`
--

-- --------------------------------------------------------

--
-- 表的结构 `oppo_admin`
--

CREATE TABLE IF NOT EXISTS `oppo_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `userName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '电子邮箱',
  `pwd` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `telephone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '电话号码',
  `headImg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '头像图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `oppo_admin`
--

INSERT INTO `oppo_admin` (`id`, `userName`, `email`, `pwd`, `telephone`, `headImg`) VALUES
(8, 'tyt', '1313@sfjh.com', 'c33367701511b4f6020ec61ded352059', '12345679810', '/uploads/20181213\\87f6e1182bd1108c3b914e32c80bafdc.jpg'),
(4, '涂奕钿', 'qewr2683@qq.com', 'c33367701511b4f6020ec61ded352059', '14725836910', '/uploads/20181213\\0925c98b112a84598ad4250ea258d5db.jpg'),
(9, 'moriarty', '12313213@asdhsj.com', 'c33367701511b4f6020ec61ded352059', '12312312123', '/uploads/20181213\\4886830d629e6a605c140249c3c40710.jpg'),
(7, 'awds', '13102030483@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '12102030104', '/uploads/20181213\\f8cc01cbcad6ffe5587c3e9e88a3bd96.jpg'),
(10, 'moriarty', 'aswds@asdas.com', 'c33367701511b4f6020ec61ded352059', '15945678523', '/uploads/20181213\\13e787b2e686f843e46a93a080165ac4.jpg'),
(11, '涂奕钿', '1561357687@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '13537142683', '/uploads/20181213\\6e55c548f4680b6683c8f8d8ff56efae.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `oppo_carousel`
--

CREATE TABLE IF NOT EXISTS `oppo_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '超链接',
  `number` int(4) NOT NULL COMMENT '排序数字',
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片位置',
  `addTime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='轮播图片' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `oppo_carousel`
--

INSERT INTO `oppo_carousel` (`id`, `title`, `link`, `number`, `url`, `addTime`) VALUES
(8, 'penguins', 'www.baidu.com', 23, '/uploads/20181214\\c54abf7e46720a1149351f62a75c89a4.jpg', '1544759162'),
(7, 'penguins', 'www.baidu.com', 22, '/uploads/20181214\\bcf9a8922943594560ef6059a38cd73c.jpg', '1544769009');

-- --------------------------------------------------------

--
-- 表的结构 `oppo_comment`
--

CREATE TABLE IF NOT EXISTS `oppo_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) NOT NULL COMMENT '评论用户id',
  `post_id` int(11) NOT NULL COMMENT '评论帖子id',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论内容',
  `addTime` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='评论' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `oppo_comment`
--

INSERT INTO `oppo_comment` (`id`, `user_id`, `post_id`, `content`, `addTime`) VALUES
(1, 1, 18, '<img src="/static/images/emoji/3.gif" style="width:30px;"><img src="/static/images/emoji/5.gif" style="width:30px;"><img src="/uploads/20181219\\18d672df2ae5b5722bf22c5d31dd964a.jpg" style="width:120px">', '1545208407'),
(2, 1, 18, '<img src="/static/images/emoji/3.gif" style="width:30px;"><img src="/static/images/emoji/5.gif" style="width:30px;"><img src="/uploads/20181219\\18d672df2ae5b5722bf22c5d31dd964a.jpg" style="width:120px">', '1545208415'),
(3, 1, 18, '啊三大撒旦', '1545210321'),
(4, 1, 18, '孔令辉的撒看来富家女', '1545210601'),
(5, 1, 18, '电风扇地方', '1545210692'),
(6, 1, 18, '斯蒂芬斯蒂芬', '1545210773'),
(7, 1, 18, '计划符合加分vhj', '1545212228'),
(8, 1, 18, '计划符合加分vhj地方大方', '1545212245');

-- --------------------------------------------------------

--
-- 表的结构 `oppo_post`
--

CREATE TABLE IF NOT EXISTS `oppo_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '发帖人',
  `topic_id` int(11) NOT NULL COMMENT '话题id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `addTime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '发帖时间',
  `is_index` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐到首页（0-否，1-是）',
  `readnum` int(10) NOT NULL DEFAULT '0' COMMENT '查看次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='帖子' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `oppo_post`
--

INSERT INTO `oppo_post` (`id`, `user_id`, `topic_id`, `title`, `images`, `content`, `addTime`, `is_index`, `readnum`) VALUES
(15, '12345678910', 3, '', '["\\/uploads\\/20181218\\\\d0282f5ebd971ba7d382740a68d91ff9.jpg"]', '<p>ahkjashdjkashdjk</p>', '1545118594', 1, 0),
(16, '12345678910', 2, 'qsdsadss', '["\\/uploads\\/20181218\\\\97c9e7933a05eaf84c7cee8ffe44bcfa.jpg"]', '<p>awrwt5ytyrrf</p>', '1545118709', 1, 0),
(17, '12345678910', 3, 'moriarty123', '["\\/uploads\\/20181218\\\\824bbd3f42b9cab165e0148007cb7b67.jpg","\\/uploads\\/20181218\\\\06f3817cd7cf6d54f34d45733821fb71.jpg"]', '<p>rtywe3fdfsdg</p>', '1545121170', 0, 0),
(18, '12345678910', 3, '东莞理工学院', '["\\/uploads\\/20181219\\\\772e78b09cb6c76b6bacb16ecdf62f3a.jpg"]', '<p>szdfsdf</p>', '1545180846', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `oppo_post_access`
--

CREATE TABLE IF NOT EXISTS `oppo_post_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `post_id` int(11) NOT NULL COMMENT '帖子id',
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问ip',
  `addTime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='查看帖子次数' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `oppo_topic`
--

CREATE TABLE IF NOT EXISTS `oppo_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '话题名称',
  `number` int(4) NOT NULL COMMENT '排序数字',
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '话题图片',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '话题简介',
  `addTime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='话题' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `oppo_topic`
--

INSERT INTO `oppo_topic` (`id`, `name`, `number`, `image`, `content`, `addTime`) VALUES
(1, '1232', 12, '/uploads/topic/20181218\\fc7c93eb7cb386ebad1671ebca15ed93.jpg', 'yutryu', '1545098316'),
(2, 'saas', 5465, '/uploads/topic/20181218\\2760496a71f83c8454efed49c1eda887.jpg', '123213dfasd', '1545098462'),
(3, 'dgut', 2, '/uploads/topic/20181218\\8fcc8cb07dde95d6ae307deaa9816bf2.jpg', '东莞理工学院是广东东莞市的第一所普通本科院校，省市共建，以市为主，由诺贝尔物理学奖获得者杨振宁博士任名誉校长 [1]  。\n', '1545099463');

-- --------------------------------------------------------

--
-- 表的结构 `oppo_user`
--

CREATE TABLE IF NOT EXISTS `oppo_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '电话号码',
  `pwd` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `oppo_user`
--

INSERT INTO `oppo_user` (`id`, `phone`, `pwd`) VALUES
(1, '12345678910', 'e10adc3949ba59abbe56e057f20f883e'),
(2, '12345678910', '4297f44b13955235245b2497399d7a93'),
(3, '17160812885', '59b618b9fbe7f75cd16b45eb28e971b3'),
(5, '13537142683', '59b618b9fbe7f75cd16b45eb28e971b3'),
(6, '12345678911', '59b618b9fbe7f75cd16b45eb28e971b3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
