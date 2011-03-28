SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `dos_links`
--

CREATE TABLE IF NOT EXISTS `dos_links` (
  `hash` varchar(25) NOT NULL,
  `link` varchar(2083) NOT NULL,
  `title` varchar(100) NOT NULL,
  `target` varchar(2083) NOT NULL,
  `use_get` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
