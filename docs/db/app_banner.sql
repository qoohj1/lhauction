/*
 Navicat Premium Data Transfer

 Source Server         : curio
 Source Server Type    : MySQL
 Source Server Version : 50720
 Source Host           : localhost
 Source Database       : curio

 Target Server Type    : MySQL
 Target Server Version : 50720
 File Encoding         : utf-8

 Date: 11/25/2017 19:37:22 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `app_banner`
-- ----------------------------
DROP TABLE IF EXISTS `app_banner`;
CREATE TABLE `app_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `status` int(2) DEFAULT NULL COMMENT '图片状态。1为show，0为hide。',
  `image` varchar(128) DEFAULT NULL COMMENT '图片url',
  `urlen` varchar(128) DEFAULT NULL,
  `urltc` varchar(128) DEFAULT NULL COMMENT '链接url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
