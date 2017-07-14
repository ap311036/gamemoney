

 
-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 01 月 03 日 19:02
-- 服务器版本: 5.1.73
-- PHP 版本: 5.4.45

--
-- 数据库: `gamemoney`
--

-- --------------------------------------------------------

--
-- 表的结构 `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(1) NOT NULL COMMENT '狀態',
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `link_url` text NOT NULL,
  `img_url` varchar(100) NOT NULL DEFAULT '',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `prize_start_date` datetime NOT NULL,
  `prize_end_date` datetime NOT NULL,
  `publish_start_date` datetime NOT NULL,
  `publish_end_date` datetime NOT NULL,
  `create_date` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `activity_prize`
--

DROP TABLE IF EXISTS `activity_prize`;
CREATE TABLE `activity_prize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `prize_id` int(11) DEFAULT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `admin_data`
--

DROP TABLE IF EXISTS `admin_data`;
CREATE TABLE IF NOT EXISTS `admin_data` (
  `ad_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理員編號',
  `ad_name` varchar(32) NOT NULL COMMENT '名字',
  `ad_account` varchar(32) NOT NULL COMMENT '帳號',
  `ad_mtid` tinyint(1) NOT NULL COMMENT '帳號類別(1:超級,2:一般)',
  `ad_pass` varchar(64) NOT NULL COMMENT '密碼',
  `ad_del` tinyint(1) NOT NULL COMMENT '是否刪除(0為未刪除)',
  UNIQUE KEY `ad_id` (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin_data`
--

INSERT INTO `admin_data` (`ad_id`, `ad_name`, `ad_account`, `ad_mtid`, `ad_pass`, `ad_del`) VALUES
(1, 'sammi', 'sammi', 1, '80177ddb6aaf8cf89951b995a6c6a30ce98ef60f', 0);

-- --------------------------------------------------------

--
-- 表的结构 `admin_type`
--

DROP TABLE IF EXISTS `admin_type`;
CREATE TABLE IF NOT EXISTS `admin_type` (
  `adt_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adt_name` varchar(32) NOT NULL COMMENT '會員類別名稱',
  UNIQUE KEY `adt_id` (`adt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin_type`
--

INSERT INTO `admin_type` (`adt_id`, `adt_name`) VALUES
(1, '超級管理員'),
(2, '管理員');

-- --------------------------------------------------------

--
-- 表的结构 `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `card_deposit`
--

DROP TABLE IF EXISTS `card_deposit`;
CREATE TABLE IF NOT EXISTS `card_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `admin_name` varchar(11) DEFAULT NULL COMMENT '儲值工作人員姓名',
  `type` int(11) NOT NULL COMMENT '卡片類別',
  `serial_number` varchar(100) NOT NULL COMMENT '要儲值的卡號',
  `card_password` varchar(100) NOT NULL COMMENT '要儲值的卡片密碼',
  `points` int(11) NOT NULL,
  `transactionid` int(11) NOT NULL COMMENT '對方的交易ID',
  `msg` varchar(225) NOT NULL COMMENT '回傳的訊息',
  `status` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `card_deposit_sum`
--

DROP TABLE IF EXISTS `card_deposit_sum`;
CREATE TABLE IF NOT EXISTS `card_deposit_sum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `deposit_sum` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `card_deposit_type`
--

DROP TABLE IF EXISTS `card_deposit_type`;
CREATE TABLE IF NOT EXISTS `card_deposit_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `card_deposit_type`
--

INSERT INTO `card_deposit_type` (`id`, `name`) VALUES
(1, 'JCard'),
(2, '員工儲值');

-- --------------------------------------------------------

--
-- 表的结构 `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1鄉,2鎮,3市，4區',
  `name` varchar(200) NOT NULL,
  `zip_code` varchar(200) NOT NULL COMMENT '郵遞區號',
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `city`
--

INSERT INTO `city` (`id`, `county_id`, `type`, `name`, `zip_code`, `createDate`) VALUES
(1, 1, 4, '中正區', '', '0000-00-00 00:00:00'),
(2, 1, 4, '大同區', '', '0000-00-00 00:00:00'),
(3, 1, 4, '中山區', '', '0000-00-00 00:00:00'),
(4, 1, 4, '松山區', '', '0000-00-00 00:00:00'),
(5, 1, 4, '大安區', '', '0000-00-00 00:00:00'),
(6, 1, 4, '萬華區', '', '0000-00-00 00:00:00'),
(7, 1, 4, '信義區', '', '0000-00-00 00:00:00'),
(8, 1, 4, '士林區', '', '0000-00-00 00:00:00'),
(9, 1, 4, '北投區', '', '0000-00-00 00:00:00'),
(10, 1, 4, '內湖區', '', '0000-00-00 00:00:00'),
(11, 1, 4, '南港區', '', '0000-00-00 00:00:00'),
(12, 1, 4, '文山區', '', '0000-00-00 00:00:00'),
(13, 2, 4, '萬里區', '', '0000-00-00 00:00:00'),
(14, 2, 4, '金山區', '', '0000-00-00 00:00:00'),
(15, 2, 4, '板橋區', '', '0000-00-00 00:00:00'),
(16, 2, 4, '汐止區', '', '0000-00-00 00:00:00'),
(17, 2, 4, '深坑區', '', '0000-00-00 00:00:00'),
(18, 2, 4, '石碇區', '', '0000-00-00 00:00:00'),
(19, 2, 4, '瑞芳區', '', '0000-00-00 00:00:00'),
(20, 2, 4, '平溪區', '', '0000-00-00 00:00:00'),
(21, 2, 4, '雙溪區', '', '0000-00-00 00:00:00'),
(22, 2, 4, '貢寮區', '', '0000-00-00 00:00:00'),
(23, 2, 4, '新店區', '', '0000-00-00 00:00:00'),
(24, 2, 4, '坪林區', '', '0000-00-00 00:00:00'),
(25, 2, 4, '烏來區', '', '0000-00-00 00:00:00'),
(26, 2, 4, '永和區', '', '0000-00-00 00:00:00'),
(27, 2, 4, '中和區', '', '0000-00-00 00:00:00'),
(28, 2, 4, '土城區', '', '0000-00-00 00:00:00'),
(29, 2, 4, '三峽區', '', '0000-00-00 00:00:00'),
(30, 2, 4, '樹林區', '', '0000-00-00 00:00:00'),
(31, 2, 4, '鶯歌區', '', '0000-00-00 00:00:00'),
(32, 2, 4, '三重區', '', '0000-00-00 00:00:00'),
(33, 2, 4, '新莊區', '', '0000-00-00 00:00:00'),
(34, 2, 4, '泰山區', '', '0000-00-00 00:00:00'),
(35, 2, 4, '林口區', '', '0000-00-00 00:00:00'),
(36, 2, 4, '蘆洲區', '', '0000-00-00 00:00:00'),
(37, 2, 4, '五股區', '', '0000-00-00 00:00:00'),
(38, 2, 4, '八里區', '', '0000-00-00 00:00:00'),
(39, 2, 4, '淡水區', '', '0000-00-00 00:00:00'),
(40, 2, 4, '三芝區', '', '0000-00-00 00:00:00'),
(41, 2, 4, '石門區', '', '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- 表的结构 `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(225) NOT NULL,
  `content` text NOT NULL,
  `is_del` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(NULL, '中國大陸'),
(NULL, '美國'),
(NULL, '日本'),
(NULL, '臺灣');

-- --------------------------------------------------------

--
-- 表的结构 `county`
--

DROP TABLE IF EXISTS `county`;
CREATE TABLE IF NOT EXISTS `county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `county_type` int(11) NOT NULL COMMENT '1縣，2直轄市',
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `county`
--

INSERT INTO `county` (`id`, `name`, `county_type`, `createDate`) VALUES
(1, '台北市', 2, '0000-00-00 00:00:00'),
(2, '新北市', 2, '0000-00-00 00:00:00'),
(3, '桃園市', 2, '0000-00-00 00:00:00'),
(4, '台中市', 2, '0000-00-00 00:00:00'),
(5, '台南市', 2, '0000-00-00 00:00:00'),
(6, '高雄市', 2, '0000-00-00 00:00:00'),
(7, '基隆市', 2, '0000-00-00 00:00:00'),
(8, '新竹市', 2, '0000-00-00 00:00:00'),
(9, '新竹縣', 1, '0000-00-00 00:00:00'),
(10, '苗栗縣', 1, '0000-00-00 00:00:00'),
(11, '彰化縣', 1, '0000-00-00 00:00:00'),
(12, '南投縣', 1, '0000-00-00 00:00:00'),
(13, '雲林縣', 1, '0000-00-00 00:00:00'),
(14, '嘉義縣', 1, '0000-00-00 00:00:00'),
(15, '嘉義市', 2, '0000-00-00 00:00:00'),
(16, '屏東縣', 1, '0000-00-00 00:00:00'),
(17, '宜蘭縣', 1, '0000-00-00 00:00:00'),
(18, '花蓮縣', 1, '0000-00-00 00:00:00'),
(19, '台東縣', 1, '0000-00-00 00:00:00'),
(20, '澎湖縣', 1, '0000-00-00 00:00:00'),
(21, '金門縣', 1, '0000-00-00 00:00:00'),
(22, '連江縣', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `game`
--

INSERT INTO `game` (`id`, `name`, `description`, `createDate`) VALUES
(1, '百大富豪', '', '0000-00-00 00:00:00'),
(2, '彩金贏分', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `game_gift`
--

DROP TABLE IF EXISTS `game_gift`;
CREATE TABLE IF NOT EXISTS `game_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `game_history`
--

DROP TABLE IF EXISTS `game_history`;
CREATE TABLE IF NOT EXISTS `game_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `mbmer_id` int(11) NOT NULL,
  `action` varchar(200) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `game_product`
--

DROP TABLE IF EXISTS `game_product`;
CREATE TABLE IF NOT EXISTS `game_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `game_rank`
--

DROP TABLE IF EXISTS `game_rank`;
CREATE TABLE IF NOT EXISTS `game_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `game_type`
--

DROP TABLE IF EXISTS `game_type`;
CREATE TABLE IF NOT EXISTS `game_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `game_video`
--

DROP TABLE IF EXISTS `game_video`;
CREATE TABLE IF NOT EXISTS `game_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `video` varchar(200) NOT NULL,
  `createDate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `account` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nick_name` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tel` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL COMMENT '國家ID',
  `invoice_type` varchar(100) NOT NULL,
  `county_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `invoice_name` varchar(200) NOT NULL,
  `invoice_county_id` int(11) NOT NULL,
  `invoice_city_id` int(11) NOT NULL,
  `invoice_zip_code` varchar(100) NOT NULL,
  `invoice_address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL COMMENT '會員性別(0:未設定,1:男,2:女)',
  `is_del` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  `type` int(11) NOT NULL COMMENT '0:一般帳號，1:fb帳號',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member_block`
--

DROP TABLE IF EXISTS `member_block`;
CREATE TABLE IF NOT EXISTS `member_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `block_member_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member_card`
--

DROP TABLE IF EXISTS `member_card`;
CREATE TABLE IF NOT EXISTS `member_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member_deposit`
--

DROP TABLE IF EXISTS `member_deposit`;
CREATE TABLE IF NOT EXISTS `member_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `from` varchar(100) NOT NULL COMMENT '從哪裡儲值',
  `is_del` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member_friend`
--

DROP TABLE IF EXISTS `member_friend`;
CREATE TABLE IF NOT EXISTS `member_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `friend_member_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_type` int(11) NOT NULL,
  `sDate` datetime NOT NULL,
  `eDate` datetime NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `is_del` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `news_type`, `sDate`, `eDate`, `title`, `content`, `is_del`, `createDate`) VALUES
(1, 1, '2016-09-01 00:00:00', '2016-09-30 00:00:00', '8/4(四) 例行維護時間延長公告', '111111', 0, '0000-00-00 00:00:00'),
(2, 2, '2016-10-04 00:00:00', '2016-11-03 00:00:00', '7/21 轉輪館「亞瑟王」臨時維護公告', '7/21 轉輪館「亞瑟王」臨時維護公告', 0, '0000-00-00 00:00:00'),
(3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 1, '0000-00-00 00:00:00'),
(4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `news_type`
--

DROP TABLE IF EXISTS `news_type`;
CREATE TABLE IF NOT EXISTS `news_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `is_del` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `news_type`
--

INSERT INTO `news_type` (`id`, `name`, `is_del`, `createDate`) VALUES
(1, '遊戲', 0, '0000-00-00 00:00:00'),
(2, '活動', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- -- 表的结构 `point_transfer`
-- --
--
-- DROP TABLE IF EXISTS `point_transfer`;
-- CREATE TABLE IF NOT EXISTS `point_transfer` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `member_id` int(11) NOT NULL,
--   `trans_member_id` int(11) NOT NULL,
--   `point` int(11) NOT NULL,
--   `status` int(11) NOT NULL,
--   `create_date` date NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_type_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `is_del` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `question2`
--

DROP TABLE IF EXISTS `question2`;
CREATE TABLE IF NOT EXISTS `question2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `is_del` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `question2`
--

INSERT INTO `question2` (`id`, `title`, `question`, `answer`, `is_del`, `create_date`) VALUES
(1, '', '反詐騙問題二', '反詐騙答案', 0, '2016-10-21 00:00:00'),
(2, '', '問題1', '答案\r\n1', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `question_type`
--

DROP TABLE IF EXISTS `question_type`;
CREATE TABLE IF NOT EXISTS `question_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `is_del` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `question_type`
--

INSERT INTO `question_type` (`id`, `name`, `is_del`, `create_date`) VALUES
(1, '遊戲問題', 0, '0000-00-00 00:00:00'),
(2, '點數問題', 0, '0000-00-00 00:00:00'),
(3, '其它問題', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `register_sms`
--

DROP TABLE IF EXISTS `register_sms`;
CREATE TABLE IF NOT EXISTS `register_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `content` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `return_code` varchar(120) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user_rule`
--

DROP TABLE IF EXISTS `user_rule`;
CREATE TABLE IF NOT EXISTS `user_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `is_del` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_rule`
--

INSERT INTO `user_rule` (`id`, `title`, `content`, `is_del`, `create_date`) VALUES
(1, '使用者規章', '個人資料需確實登記，帳號登錄以手機門號驗證為同一者認定，如為不實資料，老子有錢online可拒絕提供相關服務；經確認違規事項嚴重者，老子有錢online得將該違規帳號或其相關連帳號依照本規章規定處理。\r\n如使用者於註冊帳號時，使用不實之註冊資料、將其「遊戲帳號」、「密碼」等遊戲相關資料洩漏、交付或轉讓予他人時，老子有錢online有權與此帳號終止契約，並由使用者自行承擔所有之損失，如讓老子有錢online受有其他損害者，應賠償老子有錢online之損害，老子有錢online並保留法律追訴之權利。\r\n老子有錢online禁止從事不當遊戲與非法行為，若查明屬實有不當使用行為方式來取得遊戲帳號、虛寶道具、遊戲數值、幣值、點數(包含金流代收服務帳款未繳)…等等行為或造成影響遊戲之公平性時，老子有錢online有權視情節輕重予以禁言、停權、終止契約等處分，以維護其他玩家權益與遊戲環境。另若經老子有錢online調查有疑似使用虛偽不正之方式進行儲值，將停權該帳號7日配合調查，停權期間玩家不得因此而要求任何補償或賠償。\r\n遊戲中禁止販售、購買遊戲點數、遊戲幣、虛擬物品，如盜用他人帳號取得相關遊戲內容（虛寶道具、遊戲數值、幣值、點數），再將該物品進行轉賣，此一行為涉嫌侵占他人財產，無論買方或賣方取得不法物品，老子有錢online將全數回收並且進行調查，同時將賣方使用者帳號終止合約，買方使用者予以暫時停權以供調查。\r\n提醒：私下交易容易造成糾紛，請玩家小心避免遭騙。若以非官方管道取得之點數、點數卡、虛寶道具發生任何問題，需由玩家自行承擔，老子有錢online對此將不負責處理。\r\n嚴禁使用者假冒官方人員名義（例如：GM、客服人員…等）進行詐欺行為或妨礙其他玩家正常進行遊戲。違者初犯將鎖定遊戲帳號7天，若有再犯者，得終止遊戲合約。\r\n遊戲中禁止使用非法程式進行遊戲，或是透過非法程式影響玩家遊戲行為，如有『非正當遊戲行為』一經查獲，遊戲管理員將有權停止帳號使用。\r\n玩家在遊戲內發現錯誤問題（BUG）或其他問題時，應盡速使用客服中心回報通知官方人員，不可私自利用錯誤程式進行任何可能破壞遊戲內平衡性、影響其他玩家權益、活動比賽不公等行為，亦禁止公開、私下傳播消息，違反規定者將進行帳號終止合約。\r\n不得使用不當名稱（如不雅文字、影射字詞、違反社會道德、涉嫌誤導玩家、情色、人身攻擊…等），或是官方帳號、特殊字元等創立角色暱稱，違反規定者老子有錢online有權重新設定玩家暱稱，經警告後仍無改善，將進行終止遊戲合約。\r\n玩家不得於遊戲中進行不當發言，包含公布或傳送任何毀謗、不實、威脅、不雅、猥褻、不法、或連續性發言且制止無效(包含騷擾老子有錢客服)、侵害他人智慧財產權的資訊或從事廣告、仲介或販賣商品行為。\r\n違反規定者將刪除其發話內容並處罰該帳號禁止發言，經警告後仍無改善或依老子有錢online判定嚴重違反遊戲管理規則者進行終止遊戲合約。\r\n玩家在使用聊天功能、玩家圖像、頭像，不得透過本服務張貼任何非法、不雅、種族主義、淫穢、誹謗、污蔑或威脅的內容(含相關影射暗語)，或任何違反法律、被普遍認為屬不當資訊的內容(含相關影射暗語)。得處罰該帳號禁止發言；經警告後仍無改善者或經判定嚴重違反遊戲管理規則者，得終止遊戲合約。\r\n玩家不得在遊戲中透過任何訊息指定贏家、公開指定叫牌、故意放水輸牌等進行不公正行為，配合者將與使用者帳號一同受罰。以不當方式取得遊戲利益、除停權外，老子有錢online得沒收非法遊戲期間所獲得不當利益。\r\n活躍指數異常(1-59)之玩家持續遭到檢舉，且經查影響其他玩家權益重大，得處以永久禁言或終止遊戲合約。\r\n主管機關來函包含公務機關、檢調單位、司法機關或其他政府機關之命令。是否復權將依主管機關來函為主。老子有錢online均配合調查，玩家不得因此而要求任何補償或賠償。\r\n管理規範修改因應法律之變動或提供遊戲服務之必要，老子有錢online保留新增、修改或刪除本管理規範之全部或局部條文之權利，並於修改時於首頁進行公告，且不另行個別通知，玩家不得因此而要求任何補償或賠償，並且自該修訂條文於本網站公告之時起受其約束。玩家一旦於公告後繼續使用老子有錢online各項服務，即視為已經同意該修訂條款。\r\n', 0, 0);


-- --------------------------------------------------------

--
-- 表的结构 `member_login_log`
--

DROP TABLE IF EXISTS `member_login_log`;
CREATE TABLE IF NOT EXISTS `member_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `login_ip` varchar(200) NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `game_tax`
--
DROP TABLE IF EXISTS `game_tax`;
CREATE TABLE `game_tax` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` varchar(50) NOT NULL DEFAULT '',
  `tax` int(11) NOT NULL COMMENT '%',
  `daylimit` int(11) NOT NULL,
  `daycount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- member_transfer_log --
DROP TABLE IF EXISTS `member_transfer_log`;
CREATE TABLE `member_transfer_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `fee` int(11) DEFAULT NULL,
  `reduce_point` int(11) NOT NULL,
  `receive_point` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;




CREATE TABLE `newbie_guide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(14) DEFAULT NULL,
  `content` text,
  `imgurls` varchar(500) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
INSERT INTO `newbie_guide` (`id`, `title`, `content`, `imgurls`, `order_id`, `created_at`, `is_deleted`)
VALUES
	(1, '介面操作', '介面操作as', NULL, 1, NULL, 0),
	(2, '點數說明', '在這裡放 點數說明 的內容\n', NULL, 2, NULL, 0),
	(3, '聊天功能 ', '在這裡放 聊天功能 的內容', NULL, 3, NULL, 0),
	(4, '頭像功能', '在這裡放 頭像功能 的內容', NULL, 4, NULL, 0),
	(5, '升等系統', '在這裡放 升等系統 的內容', NULL, 5, NULL, 0),
	(6, ' 會員活躍指數', '在這裡放 會員活躍指數 的內容', NULL, 6, NULL, 0);



	CREATE TABLE `game_center_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(8) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

	INSERT INTO `game_center_list` (`id`, `title`, `order_id`, `created_at`)
VALUES
	(1, '輪轉館', 1, '2017-01-09 18:06:38'),
	(2, '電子館', 2, '2017-01-09 18:06:38'),
	(3, '博青絲落', 3, '2017-01-09 18:06:38'),
		(4, '視訊館',4, '2017-01-09 18:06:38'),
	(5, '對戰館',5, '2017-01-09 18:06:38');

	CREATE TABLE `game_intro_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gc_id` int(11) DEFAULT NULL,
  `game_title` varchar(5) DEFAULT NULL,
  `game_icon` varchar(200) DEFAULT NULL,
  `game_intro` text,
  `created_at` datetime DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `imgs_url` varchar(500) DEFAULT NULL,
  `game_rules` text,
  `rule_imgs_url` varchar(500) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `game_intro_list` (`id`, `gc_id`, `game_title`, `game_icon`, `game_intro`, `created_at`, `is_delete`, `imgs_url`, `game_rules`, `rule_imgs_url`, `order_id`)
VALUES
	(1, 1, '水果吧', 'game_icon1.png', '水果吧', '2016-01-09 00:00:00', 0, NULL, '111', NULL, 1),
	(2, 1, '超八', 'game_icon2.png', '超八', '2016-01-09 00:00:00', 0, NULL, '222', NULL, 2),
	(3, 1, '幸運鑽石', 'game_icon3.png', '幸運鑽石', '2016-01-09 00:00:00', 0, NULL, NULL, NULL, 3),
	(4, 2, '餐廳賓果', 'game_icon4.png', '餐廳賓果', '2016-01-09 00:00:00', 0, NULL, NULL, NULL, 1);



CREATE TABLE `prize` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT NULL,
  `prize_item` varchar(100) NOT NULL DEFAULT '',
  `prize_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;