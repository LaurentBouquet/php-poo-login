
DROP DATABASE IF EXISTS `feedback`;
CREATE DATABASE IF NOT EXISTS `feedback`;
USE `feedback`;

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `roles` varchar(250) COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

