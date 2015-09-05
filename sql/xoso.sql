/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : xoso

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-09-05 08:34:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `discount`
-- ----------------------------
DROP TABLE IF EXISTS `discount`;
CREATE TABLE `discount` (
  `money` float(12,0) NOT NULL DEFAULT '0',
  `percent` float(10,0) DEFAULT NULL,
  PRIMARY KEY (`money`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount
-- ----------------------------
INSERT INTO `discount` VALUES ('1000', '10');
INSERT INTO `discount` VALUES ('200000', '16');
INSERT INTO `discount` VALUES ('400000', '17');
INSERT INTO `discount` VALUES ('600000', '18');
INSERT INTO `discount` VALUES ('800000', '19');
INSERT INTO `discount` VALUES ('1000000', '20');
INSERT INTO `discount` VALUES ('3000000', '21');
INSERT INTO `discount` VALUES ('5000000', '22');

-- ----------------------------
-- Table structure for `invoice`
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` text NOT NULL COMMENT 'ten nhom/ten dai ly',
  `address` text,
  `phoneNo` text,
  `group` text NOT NULL COMMENT 'seller group, id',
  `draw_number` int(11) NOT NULL,
  `draw_date` int(11) NOT NULL,
  `total_selling` float DEFAULT '0',
  `discount_type` int(11) DEFAULT NULL,
  `discount_amount` float DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `late_payment_fee` float DEFAULT NULL,
  `deadline` int(11) NOT NULL,
  `prize_commission` float DEFAULT '0',
  `total_payment` float DEFAULT '0',
  `bill_numbers` text COMMENT 'chua cac id cua bill_winning thuoc seller',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of invoice
-- ----------------------------

-- ----------------------------
-- Table structure for `seller`
-- ----------------------------
DROP TABLE IF EXISTS `seller`;
CREATE TABLE `seller` (
  `sellergroup` varchar(100) NOT NULL,
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text,
  `phoneNo` varchar(20) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1-group payment, 0-Id payment',
  PRIMARY KEY (`id`,`sellergroup`),
  UNIQUE KEY `id` (`sellergroup`,`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seller
-- ----------------------------
INSERT INTO `seller` VALUES ('G1', '1', 'G1-1', 'ha noi', '09721221', '10', '1');
INSERT INTO `seller` VALUES ('G2', '1', 'G2-1', 'ha noi', '097212243', '10', '1');
INSERT INTO `seller` VALUES ('G3', '1', 'G3-1', 'ho chi minh city', '097812252', '10', '1');
INSERT INTO `seller` VALUES ('G1', '2', 'G1-2', 'ha noi', '097212253', '10', '1');
INSERT INTO `seller` VALUES ('G2', '2', 'G2-2', 'quang ninh', '097766212', '10', '1');
INSERT INTO `seller` VALUES ('G3', '2', 'G3-2', 'ho chi minh city', '097815212', '10', '1');
INSERT INTO `seller` VALUES ('G2', '3', 'G2-3', 'hai phong', '097713312', '10', '1');
INSERT INTO `seller` VALUES ('P', '3', 'P3', 'ha noi', '097812212', '10', '0');
INSERT INTO `seller` VALUES ('G2', '4', 'G2-4', 'ha noi', '097712216', '10', '1');
INSERT INTO `seller` VALUES ('P', '4', 'P1', 'ho chi minh city', '097813212', '10', '0');
INSERT INTO `seller` VALUES ('G2', '5', 'G2-5', 'da nang', '097712213', '10', '1');

-- ----------------------------
-- Table structure for `selling`
-- ----------------------------
DROP TABLE IF EXISTS `selling`;
CREATE TABLE `selling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `draw_number` int(11) NOT NULL,
  `draw_date` int(11) NOT NULL,
  `seller_id` varchar(255) NOT NULL,
  `total` double(16,0) NOT NULL DEFAULT '0',
  `paid` int(11) NOT NULL DEFAULT '0' COMMENT '0-chua thanh toan, 1-da thah toan',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of selling
-- ----------------------------
INSERT INTO `selling` VALUES ('5', '1', '1441144800', '1', '2000000', '0');
INSERT INTO `selling` VALUES ('6', '1', '1441144800', '2', '300000000', '0');
INSERT INTO `selling` VALUES ('7', '1', '1441144800', '3', '12000000', '0');
INSERT INTO `selling` VALUES ('8', '3', '1441231200', '122', '1000000', '0');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `ascii_name` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '10: hoat dong, 0-khong hoat dong',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `avatar` varchar(512) DEFAULT NULL,
  `cover_photo` varchar(512) DEFAULT NULL,
  `role` smallint(6) NOT NULL DEFAULT '0' COMMENT '0-normal user, 1- admin, 2-accounter',
  `address` varchar(1024) DEFAULT NULL,
  `verify_token` varchar(32) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'Đỗ Xuân Tiến', 'Do Xuan Tiến', '$2y$13$JhKc5jHXvwi4NTJsZYTbzuBE73qILB.52sCELdQqwUsdyUxEDL8s6', '10', null, '1425874990', 'tiendx1@vivas.vn', 'Z-BO4Euktnse6Sy-qqk6q_-fh82u9hFr', null, null, null, null, '1', null, null, null, null);
INSERT INTO `user` VALUES ('2', 'accounter', 'Đỗ Tiến', 'Do Tien', '$2y$13$JhKc5jHXvwi4NTJsZYTbzuBE73qILB.52sCELdQqwUsdyUxEDL8s6', '10', '1417768587', '1420534162', 'tiendx@vivas.vn', 'qpdHy-wwiKlJNOcxOX32v5jihXaBShVB', null, '', 'uploads/image/2_1418637682_GdmA5aIRewZyxbc4hLJDwDpuJpmOgNy3J9QeawBhspE_kgzFAwCKaEZt.jpg', 'uploads/image/2_1418637682_tiendx_MHoVObinvxe2.jpg', '2', '', null, '1392138000', null);
INSERT INTO `user` VALUES ('3', 'tiendx', 'mr.olala', 'mr.olala', '$2y$13$JhKc5jHXvwi4NTJsZYTbzuBE73qILB.52sCELdQqwUsdyUxEDL8s6', '10', '1419306013', '1419327524', 'tiendx3@vivas.vn', 'zYC5ZLY9xpp2xIz5Uo1gzVOso-2HKNDd', null, '', 'uploads/image/3_1419327524_851575_126362077548589_1478503186_n_u0wktm30l-6F.png', 'uploads/image/3_1419327524_mynhan_EbyJ4a1Jx6T9.jpg', '1', '', null, null, null);
INSERT INTO `user` VALUES ('5', 'thucnt', 'nguyễn trí thức', null, '$2y$13$Go8WCCIHyS6eZrMcI.zBb.PVWm60dxffy0MQ8pUEw8qNg4px6umtG', '10', '1441167421', null, 'thucnt@gmail.com', 'dCdbt5d6aymvB_9az4xg6ZU4r5ecJuPl', null, '0977298682', null, null, '1', null, null, null, null);
INSERT INTO `user` VALUES ('6', 'thunt', 'nguyễn thị thu', null, '$2y$13$2tKx.G.Y4qtVy3EovPOek.Wzgpx7cA2w2CJax0FYlbmyJHVe67DsG', '10', '1441167496', null, 'thunt@gmail.com', 'wLLqruw4FAFW954xhL6DgQA-VzF7OZhs', null, '0977298682', null, null, '2', null, null, null, null);

-- ----------------------------
-- Table structure for `winning_bills`
-- ----------------------------
DROP TABLE IF EXISTS `winning_bills`;
CREATE TABLE `winning_bills` (
  `draw_number` int(11) NOT NULL,
  `draw_date` int(11) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `win_amount` double(16,0) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of winning_bills
-- ----------------------------
INSERT INTO `winning_bills` VALUES ('1', '1441144800', '1', '1000000', '1');
INSERT INTO `winning_bills` VALUES ('1', '1441144800', '2', '100000000', '2');
INSERT INTO `winning_bills` VALUES ('1', '1441144800', '3', '1232000000', '3');
INSERT INTO `winning_bills` VALUES ('2', '1441144800', '12', '1200000', '4');
