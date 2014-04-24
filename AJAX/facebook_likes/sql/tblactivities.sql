# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.27)
# Database: php4wa
# Generation Time: 2014-03-31 08:58:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tblactivities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tblactivities`;

CREATE TABLE `tblactivities` (
  `pk_activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `likes` int(11) DEFAULT '0',
  PRIMARY KEY (`pk_activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tblactivities` WRITE;
/*!40000 ALTER TABLE `tblactivities` DISABLE KEYS */;

INSERT INTO `tblactivities` (`pk_activity_id`, `activity_description`, `likes`)
VALUES
	(205,'Interactive Multimedia Design is my second home!',3),
	(202,'Building apps like there\'s no tomorrow',0),
	(203,'Not much here.',3);

/*!40000 ALTER TABLE `tblactivities` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
