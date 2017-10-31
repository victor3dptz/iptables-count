CREATE TABLE `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `server` varchar(100) NOT NULL,
  'protocol' varchar(4) NULL,
  `port` int(10) unsigned DEFAULT NULL,
  `pkts` int(10) unsigned DEFAULT NULL,
  `bytes` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

