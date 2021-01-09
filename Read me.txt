To work with this project locally you have to have PHP and a local server.

How to create database and table ->

CREATE DATABASE `pineapple` /*!40100 DEFAULT CHARACTER SET utf8 */

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `provider_index` (`provider`)
) ENGINE=MyISAM AUTO_INCREMENT=282 DEFAULT CHARSET=utf8
