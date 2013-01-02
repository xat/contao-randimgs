
CREATE TABLE `tl_module` (
  `singleFolder` varchar(255) NOT NULL default '',
  `recursive` char(1) NOT NULL default '',
  `maxFiles` smallint(5) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;