

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for country_zones
-- ----------------------------
DROP TABLE IF EXISTS `country_zones`;
CREATE TABLE `country_zones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(9) unsigned NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `tax` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3957 DEFAULT CHARSET=utf8;