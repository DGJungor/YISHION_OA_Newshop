/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : h2

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-13 10:03:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for newshop
-- ----------------------------
DROP TABLE IF EXISTS `newshop`;
CREATE TABLE `newshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `office` tinyint(4) DEFAULT NULL COMMENT '1:广东办事处',
  `sid` varchar(32) DEFAULT NULL,
  `sname` varchar(64) DEFAULT NULL,
  `declare_date` date DEFAULT NULL,
  `open_date` date DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `dep` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
