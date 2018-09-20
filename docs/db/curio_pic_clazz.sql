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

 Date: 04/18/2018 11:58:35 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `curio_pic_clazz`
-- ----------------------------
DROP TABLE IF EXISTS `curio_pic_clazz`;
CREATE TABLE `curio_pic_clazz` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name_en` varchar(255) DEFAULT NULL COMMENT '分类英文',
  `name_tc` varchar(255) DEFAULT NULL COMMENT '分类繁体',
  `parent_id` int(11) DEFAULT '0' COMMENT '父级分类id',
  `sort` int(8) DEFAULT '0' COMMENT '排序。数值越大，越靠前',
  `pdf` varchar(255) DEFAULT NULL COMMENT 'pdf',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='图录分类表';

-- ----------------------------
--  Records of `curio_pic_clazz`
-- ----------------------------
BEGIN;
INSERT INTO `curio_pic_clazz` VALUES ('1', 'The 11th Auction, SPRING 2018', '第十一屆－2018春拍', '0', '5', '1', '1', null), ('2', 'The 10th Auction, AUTUMN 2017', '第十屆－2017秋拍', '0', '5', '1', '1', null), ('3', 'The 9th Auction, SPRING 2017', '第九屆－2017春拍', '0', '5', '1', '1', null), ('4', 'The 8th Auction, AUTUMN 2016', '第八屆—2016秋拍', '0', '5', '1', '1', null), ('5', 'The 7th Auction, SPRING 2016', '第七屆—2016春拍', '0', '5', '1', '1', null), ('6', 'The 6th Auction, AUTUMN 2015', '第六屆—2015秋拍', '0', '5', '1', '1', null), ('7', 'The 5th Auction, SPRING 2015', '第五屆—2015春拍', '0', '5', '1', '1', null), ('8', 'The 4th Auction, AUTUMN 2014', '第四屆—2014秋拍', '0', '5', '1', '1', null), ('9', 'The 3rd Auction, SPRING 2014', '第三屆—2014春拍', '0', '5', '1', '1', null), ('10', 'The 2nd Auction, AUTUMN 2013', '第二屆—2013秋拍', '0', '5', '1', '1', null), ('11', 'The 1st Auction, SPRING 2013', '第一屆—2013春拍', '0', '5', '1', '1', null), ('12', 'Delicacies & Wine Auction', '御養尚品 - 補品及佳釀專場', '2', '5', '', '1511625600', '1523859007'), ('13', 'Photographica Auction', '珍稀相機專場', '2', '5', '', '1511625600', '1522558111'), ('14', 'Vintage Pu-er Tea Auction', '足吾所好 - 古董級普洱茶及佳茗專場', '2', '5', '/public/pdf/pic_clazz/result_20171128.pdf', '1511625600', '1523859017'), ('15', 'Tea Wares & Agarwood Auction', '鑾器天香 – 茶道.香道.花器專場', '2', '5', '', '1511625600', '1523859024'), ('16', 'Tea Wares & Agarwood Auction', '鑾器天香 – 茶道.香道.花器專場', '3', '5', '', '1495900800', '1523859031'), ('17', 'Vintage Pu-er Tea Auction', '足吾所好 - 古董級普洱茶及佳茗專場', '3', '5', '/public/pdf/pic_clazz/tea_result.pdf', '1495900800', '1523859039'), ('18', 'Delicacies & Wine Auction', '御養尚品 - 補品及佳釀專場', '3', '5', '', '1495900800', '1523859045'), ('19', 'Miscellaneous & Jade Auction', '天祿琳琅—瓷雜古玩專場', '4', '5', '', '1480089600', '1522558181'), ('20', 'Puer Tea Auction', '韻致彌香—古董級普洱茶專場', '4', '5', '', '1480089600', '1522558194'), ('21', 'Tea Wares & Agarwood Auction', '鑾器天香—茶．香．花專場', '4', '5', '', '1480089600', '1522558201'), ('22', 'Tea Wares Auction', '鑾器天成 - 名茶御器專場', '5', '5', '/public/pdf/pic_clazz/tea_ware_result(3).pdf', '1464537600', '1522558214'), ('23', 'Agarwood & Flower Vase Auction', '朗吟奇香 - 香道花器專場', '5', '5', '/public/pdf/pic_clazz/agarwood_result.pdf', '1464537600', '1522558220'), ('24', 'Miscellaneous & Jade Auction', '古逸昌韻 - 玉器瓷雜專場', '5', '5', '/public/pdf/pic_clazz/jade_result(2).pdf', '1464537600', '1522558227'), ('25', 'Photographica Auction', '珍稀相機專場', '5', '5', '/public/pdf/pic_clazz/camera_result(2).pdf', '1464451200', '1522558234'), ('26', 'Tea Ware Auction', '鑾器天成 - 名茶御器專場', '6', '5', '', '1448640000', '1522558279'), ('27', 'Agarwood Auction', '朗吟奇香 - 沉香奇楠專場', '6', '5', '', '1448640000', '1522558287'), ('28', 'Jade Auction', '琳翠雅玩 - 玉器珍玩專場', '6', '5', '', '1448640000', '1522558294'), ('29', 'Wine Auction', '御釀芳奢 - 名酒珍釀專場', '6', '5', '', '1448640000', '1522558302'), ('30', 'Photographica Auction 6', '珍稀相機專場', '6', '5', '', '1448640000', '1522558309'), ('31', 'Tea Ware Auction 2', '鑾器天香─沉香、名茶御器及金石古玩專場', '7', '5', '/public/pdf/pic_clazz/tea_full_list_11.6.15.pdf', '1432828800', '1522558328'), ('32', 'Photographica Auction 5', '珍稀相機拍賣會 5', '7', '5', '/public/pdf/pic_clazz/camera_full_list_10.6.15.pdf', '1432828800', '1522558338'), ('33', 'Tea Ware Auction 1', '鐵醉茶香 – 沉香‧茶道具拍賣專場', '8', '5', '/public/pdf/pic_clazz/tea_ware_auction_result_list(4).pdf', '1415376000', '1522558366'), ('34', 'Photographica Auction 4', '珍稀相機拍賣會 4', '8', '5', '/public/pdf/pic_clazz/camer_auction_result_list.pdf', '1415376000', '1522558375'), ('35', 'Photographica Auction 3', '珍稀相機拍賣會 3', '9', '5', '/public/pdf/pic_clazz/l&h_auction3_result.pdf', '1399046400', '1522558394'), ('36', 'Photographica Auction 2', '珍稀相機拍賣會 2', '10', '5', '/public/pdf/pic_clazz/l&h_auction_2_hammer_price_with_premiums(3).pdf', '1384617600', '1522558402'), ('37', 'Photographica Auction 1', '珍稀相機拍賣會 1', '11', '5', '/public/pdf/pic_clazz/auction_1.pdf', '1371830400', '1522558412');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
