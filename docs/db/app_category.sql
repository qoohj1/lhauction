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

 Date: 11/28/2017 15:48:09 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `app_category`
-- ----------------------------
DROP TABLE IF EXISTS `app_category`;
CREATE TABLE `app_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(2) DEFAULT NULL COMMENT '产品目录状态。1为show，0为hide',
  `name_en` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `name_tc` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `app_category`
-- ----------------------------
BEGIN;
INSERT INTO `app_category` VALUES ('1', '1', 'The 1st Auction, SPRING 2013', '第一屆—2013春拍'), ('2', '1', 'The 2nd Auction, AUTUMN 2013', '第二屆—2013秋拍'), ('3', '1', 'The 3rd Auction, SPRING 2014', '第三屆—2014春拍'), ('5', '1', 'The 4th Auction, AUTUMN 2014', '第四屆—2014秋拍'), ('6', '1', 'The 5th Auction, SPRING 2015', '第五屆—2015春拍'), ('7', '1', 'The 6th Auction, AUTUMN 2015', '第六屆—2015秋拍'), ('8', '1', 'The 7th Auction, SPRING 2016', '第七屆—2016春拍'), ('9', '1', 'The 8th Auction, AUTUMN 2016', '第八屆—2016秋拍'), ('10', '1', 'The 9th Auction, SPRING 2017', '第九屆－2017春拍'), ('11', '1', 'The 10th Auction, AUTUMN 2017', '第十屆－2017秋拍');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
