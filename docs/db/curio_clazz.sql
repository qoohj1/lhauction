/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50720
 Source Host           : localhost
 Source Database       : curio

 Target Server Type    : MySQL
 Target Server Version : 50720
 File Encoding         : utf-8

 Date: 04/11/2018 11:32:35 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `curio_clazz`
-- ----------------------------
DROP TABLE IF EXISTS `curio_clazz`;
CREATE TABLE `curio_clazz` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name_en` varchar(255) DEFAULT NULL COMMENT '分类英文',
  `name_tc` varchar(255) DEFAULT NULL COMMENT '分类繁体',
  `parent_id` int(11) DEFAULT '0' COMMENT '父级分类id',
  `sort` int(8) DEFAULT '0' COMMENT '排序。数值越大，越靠前',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='内容分类表';

-- ----------------------------
--  Records of `curio_clazz`
-- ----------------------------
BEGIN;
INSERT INTO `curio_clazz` VALUES ('1', 'PRESS RELEASE AND PHOTO ALBUM', '新聞稿及相冊', '0', '5'), ('2', 'IN THE NEWS', '媒體報導', '0', '5'), ('3', '2013-06-22 - Auction 1', '2013-06-22 - 第一屆拍賣會', '1', '5'), ('4', '2013-09-07 - Mr. James L. Lager Seminar in Beijing', '2013-09-07 - 徠卡權威 James L. Lager百年徠卡經典相機研討會北京專場', '1', '5'), ('5', '2013-11-17 - Auction 2', '2013-11-17 - 第二屆拍賣會', '1', '5'), ('6', '2014-05-03 - Auction 3', '2014-05-03 - 第三屆拍賣會', '1', '5'), ('7', '2014-11-08 - Auction 4', '2014-11-08 - 第四屆拍賣會', '1', '5'), ('8', '2015-05-29 - L&H 2015 Spring Auctions : Tea Wares and Photographica', '2015-05-29 - 2015年春季拍賣 : 「鑾器天香」及「珍稀相機」專場', '1', '5'), ('9', '2015-08-06~09 - China International Incense Culture Industry Fair (Beijing) Album', '2015-08-06~09 - (北京)第四屆中國國際沉香展相冊', '1', '5'), ('10', '2015-09-18~21 - The 5th China International Incense Exhibition (Shanghai) Album', '2015-09-18~21 - 第五屆中國上海香博會相冊', '1', '5'), ('11', '2015-9-7~9 - 台灣葉紋妤香爐藝術展 (上海桂林公園四教廳)', '2015-9-7~9 - 台灣葉紋妤香爐藝術展 (上海桂林公園四教廳)', '1', '5'), ('12', '2015-11-28 - 2015 Autumn Auctions : Tea Wares / Agarwood / Jade / Wine and Photographica', '2015-11-28 - 2015年秋季拍賣 :「鑾器天成」,「朗吟奇香」,「琳翠雅玩」,「御釀芳奢」及「珍稀相機」專場', '1', '5'), ('13', '2015-12-03~07 - 2015 the 6th China (Dongguan) International Eaglewood Culture and Art Fair', '2015-12-03~07 - 2015(東莞)第六屆國際沉香文化藝術博覽會', '1', '5'), ('14', '2016-05-29 - 2016 Spring Auctions : Tea Wares / Agarwood / Miscellaneous & Jade / Ink Painting and Photographica', '2016-05-29 - 2016年春季拍賣 :「鑾器天成」,「朗吟奇香」,「古逸昌韻」,「清貢瑤彩」及「珍稀相機」專場', '1', '5'), ('15', '2016-05-28~31 International Antiques Fair', '2016-05-28~31 國際古玩展', '1', '5'), ('16', '2016-11-26 - 2016 Autumn Auctions： Antique Tea /  Tea Ware and Argawood / Miscellaneous and Ink Painting', '2016-11-26 2016年秋季拍賣：「鐵硯春秋」﹑「天祿琳琅」﹑「韻致彌香」﹑「鑾器天香—茶．香．花」專場', '1', '5'), ('17', '2017-5-28 - 2017 Spring Auctions', '2017-5-28 - 2017年春季拍賣', '1', '5'), ('18', '2017-11-26 - 2017 Autumn Auctions', '2017-11-26 - 2017年秋季拍賣', '1', '5');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
