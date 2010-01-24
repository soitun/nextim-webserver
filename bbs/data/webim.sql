create TABLE webim_histories (
 `id` int(11) unsigned NOT NULL auto_increment,
 `send` tinyint (1),
 `type` varchar(20),
 `to` mediumint(8) unsigned not null default '0',
 `from` mediumint(8) unsigned not null default '0',
 `body` text,
 `style` varchar(150),
 `timestamp` double,
 `todel` TINYINT( 1 ) NOT NULL DEFAULT '0',
 `fromdel` TINYINT( 1 ) NOT NULL DEFAULT '0',
 PRIMARY KEY (id),
 KEY `todel` (`todel`),
  KEY `fromdel` (`fromdel`),
  KEY `timestamp` (`timestamp`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `send` (`send`)
) ENGINE=MyISAM; 

create TABLE webim_setting (
 `uid` mediumint(8) unsigned not null default '0',
 `web` blob,
 `air` blob,
 PRIMARY KEY (uid)
) ENGINE=MyISAM;