# Dump of table api_setting
# ------------------------------------------------------------

CREATE TABLE `api_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `api_key` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `api_setting` WRITE;
/*!40000 ALTER TABLE `api_setting` DISABLE KEYS */;

INSERT INTO `api_setting` (`id`, `api_key`)
VALUES
	(1,'1111');
UNLOCK TABLES;


# Dump of table broadcast
# ------------------------------------------------------------

CREATE TABLE `broadcast` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `msg` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# Dump of table jpot
# ------------------------------------------------------------

CREATE TABLE `jpot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `accumulation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jpot` WRITE;
/*!40000 ALTER TABLE `jpot` DISABLE KEYS */;

INSERT INTO `jpot` (`id`, `accumulation`)
VALUES
	(1,100000000),
	(2,50000000),
	(3,20000000),
	(4,5000000);

/*!40000 ALTER TABLE `jpot` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jpot_error_log
# ------------------------------------------------------------

CREATE TABLE `jpot_error_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jpot_id` int(11) unsigned NOT NULL,
  `error_msg` text NOT NULL,
  `game_id` int(11) unsigned NOT NULL,
  `win_amount` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table jpot_setting
# ------------------------------------------------------------

CREATE TABLE `jpot_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jpot_id` tinyint(4) unsigned NOT NULL COMMENT '對應jpot.id',
  `button_points` int(11) unsigned NOT NULL COMMENT '底分,/100為顯示數字',
  `charge_points` int(11) unsigned NOT NULL COMMENT '押分,/100為顯示數字',
  `acc_ratio` int(11) unsigned NOT NULL COMMENT '累積比率,/100為顯示數字',
  `acc_limit` int(11) unsigned NOT NULL COMMENT '累積上限,/100為顯示數字',
  `lottery_ratio` int(11) unsigned NOT NULL COMMENT '抽獎機率,/100000為顯示數字',
  `charge_ratio` int(11) unsigned NOT NULL COMMENT '押分比例,/100為顯示數字',
  `jpot_name` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `jpot_setting` WRITE;
/*!40000 ALTER TABLE `jpot_setting` DISABLE KEYS */;

INSERT INTO `jpot_setting` (`id`, `jpot_id`, `button_points`, `charge_points`, `acc_ratio`, `acc_limit`, `lottery_ratio`, `charge_ratio`)
VALUES
	(1, 1, 10000000, 50000, 40, 100000000, 10, 150000),
	(2, 2, 5000000, 30000, 30, 50000000, 30, 25000),
	(3, 3, 2000000, 20000, 20, 20000000, 10, 10000),
	(4, 4, 500000, 10000, 10, 5000000, 10, 10000);


/*!40000 ALTER TABLE `jpot_setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jpot_win_record
# ------------------------------------------------------------

CREATE TABLE `jpot_win_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jpot_id` int(11) unsigned NOT NULL,
  `game_id` int(11) unsigned NOT NULL,
  `win_amount` int(11) unsigned NOT NULL,
  `member_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

