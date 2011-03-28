SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `dos_links` (
  `hash` varchar(25) NOT NULL,
  `link` varchar(2083) NOT NULL,
  `title` varchar(100) NOT NULL,
  `target` varchar(2083) NOT NULL,
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
