/*
Navicat MySQL Data Transfer

Source Server         : base04服务器
Source Server Version : 50638
Source Host           : 118.190.201.81:3306
Source Database       : yibei

Target Server Type    : MYSQL
Target Server Version : 50638
File Encoding         : 65001

Date: 2018-09-07 15:24:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for addresses
-- ----------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收件人名称',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系电话',
  `province` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '省',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '市',
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '区',
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '街道',
  `detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '详细地址',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `default` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'false' COMMENT '默认地址 false 否 true 是',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_id_created_at_index` (`id`,`created_at`),
  KEY `addresses_user_id_index` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of addresses
-- ----------------------------
INSERT INTO `addresses` VALUES ('1', '许', '13397119221', '13', '180', '1547', null, '1', null, 'false', '1', '2018-08-17 17:05:25', '2018-08-22 11:46:56', '2018-08-22 11:46:56');
INSERT INTO `addresses` VALUES ('2', '王思聪', '18888888888', '2', '52', '503', null, '100', null, 'true', '1', '2018-08-22 18:18:05', '2018-08-22 18:18:05', null);
INSERT INTO `addresses` VALUES ('3', '123', '123456', '2', '52', '500', null, '123', null, 'true', '2', '2018-08-28 14:11:10', '2018-08-28 14:11:10', null);

-- ----------------------------
-- Table structure for admin_shops
-- ----------------------------
DROP TABLE IF EXISTS `admin_shops`;
CREATE TABLE `admin_shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_shops_admin_id_foreign` (`admin_id`),
  KEY `admin_shops_shop_id_foreign` (`shop_id`),
  CONSTRAINT `admin_shops_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  CONSTRAINT `admin_shops_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_shops
-- ----------------------------
INSERT INTO `admin_shops` VALUES ('1', '3', '1', null, null, null);

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_tag` int(11) NOT NULL DEFAULT '0' COMMENT '系统管理员标记,所有默认添加为0,系统初始化为1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', '超级管理员', 'yyjz@foxmail.com', '$2y$10$qTyLNRsJVcn/Nt6jx4SCCeV5aa9vwzHCZH2mKT8HS8W1CjzhxOhEi', '超级管理员', '1', 'LVPgCp8TmRGK6fMDYYM5k8s5lBAszk0utcB5uIGnXY34MUS5TpsiwShv2i74', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `admins` VALUES ('2', 'AA', '837711689@qq.com', '$2y$10$PCdQKSPSHRx2x9TAqdGqH.nGx/JzDYvTSt2vhcbF2VZxQUDFYxqJu', '管理员', '0', null, '2018-08-20 17:59:27', '2018-08-20 18:07:51');
INSERT INTO `admins` VALUES ('3', '分店1管理员', 'fendian1@foxmail.com', '$2y$10$HnbptN4QQe1D0hjsVXIdOejcn/2eZx/pMXEn2VT3NdiGydKtuPIaK', '管理员', '0', '1JHCOMplpbHKEZMaVjAfaSOUuqZ9iP8YHuSbfT23NXNzBzL84NjXp9e7JWUy', '2018-09-04 17:17:19', '2018-09-04 17:17:19');

-- ----------------------------
-- Table structure for articlecats
-- ----------------------------
DROP TABLE IF EXISTS `articlecats`;
CREATE TABLE `articlecats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类别名',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父分类',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图像',
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'seo标题',
  `seo_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO关键词',
  `seo_des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articlecats_id_created_at_index` (`id`,`created_at`),
  KEY `articlecats_parent_id_index` (`parent_id`),
  KEY `articlecats_sort_index` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of articlecats
-- ----------------------------

-- ----------------------------
-- Table structure for articlecats_post
-- ----------------------------
DROP TABLE IF EXISTS `articlecats_post`;
CREATE TABLE `articlecats_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articlecats_post_category_id_foreign` (`category_id`),
  KEY `articlecats_post_post_id_foreign` (`post_id`),
  KEY `articlecats_post_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `articlecats_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `articlecats` (`id`),
  CONSTRAINT `articlecats_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of articlecats_post
-- ----------------------------

-- ----------------------------
-- Table structure for attach_evals
-- ----------------------------
DROP TABLE IF EXISTS `attach_evals`;
CREATE TABLE `attach_evals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eval_id` int(10) unsigned NOT NULL,
  `type` enum('图片','视频') COLLATE utf8mb4_unicode_ci DEFAULT '图片' COMMENT '评价附加类型',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attach_evals_id_created_at_index` (`id`,`created_at`),
  KEY `attach_evals_eval_id_index` (`eval_id`),
  CONSTRAINT `attach_evals_eval_id_foreign` FOREIGN KEY (`eval_id`) REFERENCES `product_evals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of attach_evals
-- ----------------------------
INSERT INTO `attach_evals` VALUES ('1', '5', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/rmYDREz4nb.jpg', '2018-08-21 18:16:34', '2018-08-21 18:16:34', null);
INSERT INTO `attach_evals` VALUES ('2', '5', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/5qMrSLRe6j.png', '2018-08-21 18:16:34', '2018-08-21 18:16:34', null);
INSERT INTO `attach_evals` VALUES ('3', '6', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/33nV2lW28J.jpg', '2018-08-21 18:18:03', '2018-08-21 18:18:03', null);
INSERT INTO `attach_evals` VALUES ('4', '8', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/jYfj0CyedE.jpg', '2018-08-21 18:21:34', '2018-08-21 18:21:34', null);
INSERT INTO `attach_evals` VALUES ('5', '10', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/TwEiKjOtEd.jpg', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);
INSERT INTO `attach_evals` VALUES ('6', '10', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/AAGwbhV8Bz.jpg', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);
INSERT INTO `attach_evals` VALUES ('7', '10', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/rHhWdAteSw.jpg', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);
INSERT INTO `attach_evals` VALUES ('8', '10', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/s8PFIvPGOa.jpg', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);
INSERT INTO `attach_evals` VALUES ('9', '10', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/UA7XtU7ZDL.jpg', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);
INSERT INTO `attach_evals` VALUES ('10', '10', '图片', 'http://yibei.wiswebs.com/uploads/user/1/image/nogxfbttFt.jpg', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);

-- ----------------------------
-- Table structure for bank_cards
-- ----------------------------
DROP TABLE IF EXISTS `bank_cards`;
CREATE TABLE `bank_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '银行名称',
  `type` int(11) NOT NULL COMMENT '银行卡类型0储蓄卡1信用卡',
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支行',
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `count` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账号',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '短信提醒手机号',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_cards_id_index` (`id`),
  KEY `bank_cards_user_id_index` (`user_id`),
  CONSTRAINT `bank_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of bank_cards
-- ----------------------------

-- ----------------------------
-- Table structure for bank_sets
-- ----------------------------
DROP TABLE IF EXISTS `bank_sets`;
CREATE TABLE `bank_sets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '银行卡名称',
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_sets_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of bank_sets
-- ----------------------------

-- ----------------------------
-- Table structure for banner_items
-- ----------------------------
DROP TABLE IF EXISTS `banner_items`;
CREATE TABLE `banner_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '跳转链接',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `banner_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `link_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接设置方式',
  `mini_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '小程序跳转链接',
  PRIMARY KEY (`id`),
  KEY `banner_items_id_created_at_index` (`id`,`created_at`),
  KEY `banner_items_banner_id_index` (`banner_id`),
  KEY `banner_items_sort_index` (`sort`),
  CONSTRAINT `banner_items_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of banner_items
-- ----------------------------
INSERT INTO `banner_items` VALUES ('1', 'http://yibei.wiswebs.com/uploads/111.jpg', null, null, '1', '2018-08-17 14:25:52', '2018-08-17 14:26:08', '2018-08-17 14:26:08', 'custom', null);
INSERT INTO `banner_items` VALUES ('2', 'http://yibei.wiswebs.com/uploads/111.jpg', null, null, '1', '2018-08-17 14:26:05', '2018-08-17 14:26:16', '2018-08-17 14:26:16', null, null);
INSERT INTO `banner_items` VALUES ('3', 'http://yibei.wiswebs.com/uploads/0195b658b8315ea801219c775a5e67.jpg', null, null, '1', '2018-08-17 14:26:48', '2018-09-06 15:09:03', null, null, null);
INSERT INTO `banner_items` VALUES ('4', 'http://yibei.wiswebs.com/uploads/user/%E6%9C%AA%E6%A0%87%E9%A2%98-1.jpg', null, null, '1', '2018-09-06 15:21:00', '2018-09-06 15:21:00', null, null, null);

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES ('1', '首页横幅', 'index', '2018-08-17 14:06:23', '2018-08-17 14:06:23', null);

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '品牌名称',
  `intro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌介绍',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '品牌图片',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_id_created_at_index` (`id`,`created_at`),
  KEY `brands_sort_index` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of brands
-- ----------------------------

-- ----------------------------
-- Table structure for cards
-- ----------------------------
DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '卡号',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `price` double(8,2) DEFAULT NULL COMMENT '换购金额',
  `num` double(8,2) NOT NULL COMMENT '积分面额',
  `status` int(11) DEFAULT '0' COMMENT '是否出售0未1已出售',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `length` int(11) DEFAULT '8' COMMENT '卡号长度',
  PRIMARY KEY (`id`),
  KEY `cards_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cards
-- ----------------------------
INSERT INTO `cards` VALUES ('21', '50136', 'co1mkZVr', '1000.00', '12000.00', '0', '2018-08-20 17:35:45', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('22', '50138', 'fAt6UYeP', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('23', '50133', '46kBI3Gn', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('24', '50134', 'rhHq0jLO', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('25', '50131', '75HDFAwF', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('26', '50132', 'blGcd0ZF', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('27', '50137', 'CjMwk9CQ', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('28', '50135', 'hV97CZeR', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('29', '50139', 'gBjIQXA3', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('30', '50130', 'KcFsuPzo', '1000.00', '12000.00', '0', '2018-08-20 17:37:54', '2018-08-23 11:56:51', '2018-08-23 11:56:51', '8');
INSERT INTO `cards` VALUES ('31', '50132', 'Iz8MVALp', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:09', '2018-08-23 11:59:09', '8');
INSERT INTO `cards` VALUES ('32', '50136', 'ZJ9q8KeR', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:09', '2018-08-23 11:59:09', '8');
INSERT INTO `cards` VALUES ('33', '50131', 'G2rbzOgG', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('34', '50135', '0XcnIti2', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('35', '50139', '3j0494RN', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('36', '50130', 'NvP7jZoR', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('37', '50133', 'DlF0P4ze', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('38', '50137', '4ni46DJ4', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('39', '50134', 'xBH6pzEY', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('40', '50138', 'EmcbOFpR', '1000.00', '111.00', '0', '2018-08-23 11:56:59', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('41', '50130860', 'nKxDqgdB', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('42', '50139157', 'JwebWHcd', '1000.00', '100.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:06', '2018-08-23 11:59:06', '8');
INSERT INTO `cards` VALUES ('43', '50132402', 'bJEm89Fh', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('44', '50139221', '9GQB89D3', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('45', '50138356', '4q1HNT1z', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('46', '50139786', 'HITXstXJ', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('47', '50135332', 'PZNzArHB', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('48', '50138205', 'S6NnUpB3', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('49', '50137243', 'U9hoxRYA', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('50', '50135635', 'N1WtHskz', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('51', '50133600', 'WlFqWEPt', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('52', '50134614', 'lczgbXYF', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:02', '2018-08-23 11:59:02', '8');
INSERT INTO `cards` VALUES ('53', '50134734', 'F8PRCGht', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('54', '50136976', 'OS21cXBj', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('55', '50137217', 'SOwYIuPT', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('56', '50138510', 'nslBkjcH', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('57', '50130430', 'hHBYsY0x', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('58', '50132670', 'OT8OCMhX', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('59', '50134221', 'BuBvJMIT', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('60', '50138654', 'wLwvCBym', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('61', '50130334', '1hNdTnCJ', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('62', '50135611', 'P7SFNOwR', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:59:00', '2018-08-23 11:59:00', '8');
INSERT INTO `cards` VALUES ('63', '50135693', 'tcuK2vdl', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('64', '50133180', 'bLUsGvQ5', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('65', '50139025', 'ZfYIZS7a', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('66', '50135566', 'j0oV41R5', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('67', '50137749', 'fV9BTyXx', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('68', '50130289', 'LvAsNoDU', '1000.00', '111.00', '0', '2018-08-23 11:58:21', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('69', '50134206', 'OQfFn5HP', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('70', '50131059', 'QVAPYTF4', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('71', '50135717', 'yCu7HpPm', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('72', '50137409', 'g2bEVE0v', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:56', '2018-08-23 11:58:56', '8');
INSERT INTO `cards` VALUES ('73', '50130605', 'DRyzd0Zx', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('74', '50139396', 'E6KwI7yS', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('75', '50131924', 'cBrQIITx', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('76', '50130881', '45JTGQmb', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('77', '50136162', 'vU66dVxV', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('78', '50136038', 'GemqNo4c', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('79', '50135649', 'sgtjX0vE', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('80', '50131001', 'RhzURbs0', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('81', '50136367', 'vJwqgKAh', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('82', '50132391', 'VRJ6g1hR', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:53', '2018-08-23 11:58:53', '8');
INSERT INTO `cards` VALUES ('83', '50131442', 'Z83pkZxC', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('84', '50137517', '01TfuHZI', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('85', '50134062', 'DQSJCPlV', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('86', '50130246', 'crqq4Xvj', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('87', '50130342', 'FdYVgZ2K', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('88', '50134337', 'NliHhOPQ', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('89', '50135770', 'irF49pA5', '1000.00', '111.00', '0', '2018-08-23 11:58:22', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('90', '50132905', 'tvycAQ72', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('91', '50139284', 'R203xluh', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('92', '50136615', 'FLklIN6C', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:50', '2018-08-23 11:58:50', '8');
INSERT INTO `cards` VALUES ('93', '50135718', '3Uuk9JdD', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('94', '50136030', '5XyySnt0', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('95', '50130754', 'tY3C7H3H', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('96', '50137025', 'ZHJ0NjZn', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('97', '50137002', '4ZJ2f4XY', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('98', '50138498', '93i9XKe2', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('99', '50138315', 'WhXzYoYl', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('100', '50131463', 'pVyIxW3C', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('101', '50137779', 'LLV7puxw', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('102', '50134663', 'glXVHXzG', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:47', '2018-08-23 11:58:47', '8');
INSERT INTO `cards` VALUES ('103', '50134310', 'yY11hOwp', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('104', '50137135', 'klD7GAd0', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('105', '50138539', '8oNMeidH', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('106', '50136428', 'nch9Bnor', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('107', '50131339', 'G3vX4jmI', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('108', '50139379', 'yAd8NGFb', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('109', '50131514', 'qWQJvIrB', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('110', '50133062', 'nTZpE6On', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('111', '50136913', 'fUgTCeIt', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('112', '50136930', 'X81sR86q', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:44', '2018-08-23 11:58:44', '8');
INSERT INTO `cards` VALUES ('113', '50139283', '3CKVA2u3', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('114', '50131044', '8gce7d6Q', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('115', '50133032', 'TNo3vzOI', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('116', '50131917', 'uPOfq19o', '1000.00', '111.00', '0', '2018-08-23 11:58:23', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('117', '50137345', 'PGG5Qkko', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('118', '50136412', 'dg95Vem5', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('119', '50139190', 'mBqNGvT6', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('120', '50131889', 'nQ4H1v3H', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('121', '50136046', 'QOpiAUej', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('122', '50137196', '2VTDJOgs', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:41', '2018-08-23 11:58:41', '8');
INSERT INTO `cards` VALUES ('123', '50130895', 'drVU6L3Q', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('124', '50138471', '0bDFZr9d', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('125', '50133855', 'mbH9UtlC', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('126', '50135251', 'AYANAfa2', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('127', '50132047', 'VEU99E3D', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('128', '50138188', '13sunYsP', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('129', '50134247', 'TIdcz6BT', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('130', '50136199', 'SjuPPM8z', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('131', '50137126', 'vHBC2CTE', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('132', '50138553', 'MryDleVX', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:38', '2018-08-23 11:58:38', '8');
INSERT INTO `cards` VALUES ('133', '50136473', 'anK3MdbE', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('134', '50136379', 'bb8fQk7F', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('135', '50136787', 'Xm7iKAJg', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('136', '50135530', 'zaEOGZwz', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('137', '50131113', 'juxzqd68', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('138', '50130824', 'yCy7O5fa', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('139', '50131444', 'p1lnAH0J', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('140', '50133314', 'fG6g6DuW', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('141', '50130899', '7tcDLYZP', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('142', '50136819', 'Mg3AKtrF', '1000.00', '111.00', '0', '2018-08-23 11:58:24', '2018-08-23 11:58:34', '2018-08-23 11:58:34', '8');
INSERT INTO `cards` VALUES ('143', '50132007', 's09MBrV3', '1000.00', '100.00', '1', '2018-08-23 11:59:14', '2018-08-27 16:46:09', null, '8');
INSERT INTO `cards` VALUES ('144', '50134795', 'RoAOS8EY', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 12:00:14', '2018-08-23 12:00:14', '8');
INSERT INTO `cards` VALUES ('145', '50137491', 'pkw6pbNS', '1000.00', '100.00', '1', '2018-08-23 11:59:14', '2018-08-27 16:44:47', null, '8');
INSERT INTO `cards` VALUES ('146', '50130384', 'oRyGYjw6', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('147', '50133879', 'QNUbsuwx', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 12:00:14', '2018-08-23 12:00:14', '8');
INSERT INTO `cards` VALUES ('148', '50130448', 'xRHV9J4n', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('149', '50132632', 'GiXLwZZW', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('150', '50138105', '8qpRLb32', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('151', '50132879', '0Ivpkh7P', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 12:00:14', '2018-08-23 12:00:14', '8');
INSERT INTO `cards` VALUES ('152', '50136528', '8EH5izCR', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('153', '50138064', '6x1YSr0L', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('154', '50130730', 'TlaonsUS', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('155', '50130813', 'uTwjOZT0', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('156', '50131508', '2MIceyyY', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('157', '50136691', 'zExaCUsa', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('158', '50137586', 'mdiUVegj', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('159', '50136041', '6RaKc7UL', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('160', '50130327', 'GYowcOX7', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('161', '50136677', 'ZtVjiiIW', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('162', '50134414', 'QBvbxIeD', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('163', '50135925', 'wgjmo0Jl', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('164', '50136736', 'TNmYuJnj', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('165', '50136676', '3yFbOs2x', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('166', '50137863', 'QPNyOiGc', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('167', '50131227', 'K0fT6fbk', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('168', '50131529', '4pfCvUiX', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('169', '50134339', 'TVfqfJ8M', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('170', '50138576', 'LjM8s1Es', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('171', '50133995', 'KHXFAtXi', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('172', '50137178', 'BxpDrOdp', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('173', '50139122', 'fzMLDkvP', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('174', '50130705', 'mC05AFTF', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('175', '50132317', 'TQGqMMXW', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('176', '50138464', 'fxasFYL4', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('177', '50136877', 'SV6eSHOt', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('178', '50132128', 'TRoNHLg0', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('179', '50135089', 'awKOlfRQ', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('180', '50130199', 'TGJck54x', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('181', '50137388', 'VCijXj4a', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('182', '50137756', 'qi2koLRd', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('183', '50135217', 'nJUAEivQ', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('184', '50138381', 'Xg603War', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('185', '50132357', 'XNszVXJX', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('186', '50136380', 'W4z6fRlu', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('187', '50139431', 'zdd8SrT1', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('188', '50131763', 'mKiEzrfb', '1000.00', '100.00', '0', '2018-08-23 11:59:14', '2018-08-23 11:59:14', null, '8');
INSERT INTO `cards` VALUES ('189', '50139443', 'qScDVO2G', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('190', '50135908', 't1rDlgcv', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('191', '50139308', '5OLdBpTP', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('192', '50136533', '1c0DRm31', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('193', '50131108', 'J8dI9ILs', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('194', '50139922', 'kYdLy4QV', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('195', '50132114', 'FQxAgADl', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('196', '50138292', 'QE6R6J6g', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('197', '50130693', 'RiMG9eoW', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('198', '50139535', 'ho4YCZlt', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('199', '50130287', 'vjuSGjHv', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('200', '50139884', 'P5yJLjJb', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('201', '50131480', 'CZUgdIhO', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('202', '50133532', 'QoaKXJei', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('203', '50137278', 'O2iN8dLv', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('204', '50130277', 'y7r5fMxq', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('205', '50139414', 'f94VJJVr', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('206', '50132052', 'v0kluveE', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('207', '50131157', 'JqYj6Iwc', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('208', '50139301', 'I1tq2eSM', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('209', '50133901', 'iOnmCw4H', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('210', '50134903', 'uV9VdDtN', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('211', '50133317', 'bHqVss5g', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('212', '50136467', 'hdfqPb0u', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('213', '50133311', 'P03ovAKZ', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('214', '50132731', 'doDltuuI', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('215', '50138915', 'XoXsAT3U', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('216', '50139381', 'VXFVYKs1', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('217', '50138684', 'AHY7w4oH', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('218', '50133744', 'o3xrcQcx', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('219', '50135317', 'bCSGD29i', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('220', '50131959', '22T3YNle', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('221', '50130369', 'OGSY161F', '1000.00', '100.00', '0', '2018-08-23 11:59:15', '2018-08-23 11:59:15', null, '8');
INSERT INTO `cards` VALUES ('222', '50130080', 'EpZN9QNE', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('223', '50136844', 'ztTUX9qM', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('224', '50133520', 't2KDZF2S', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('225', '50130092', 'uL86ZuUg', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('226', '50139795', 'Mda6AdjY', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('227', '50138324', '7V1sz3Vk', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('228', '50131344', 'JuJMNDOL', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('229', '50134717', 'g0QbgsH4', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('230', '50133636', 'qn9EqFT7', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('231', '50131627', 'gcK9wRyc', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('232', '50131383', 'WHMuqu5u', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('233', '50130744', '2ZMane0e', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('234', '50136704', 'k7ijjlxo', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('235', '50134695', 'sEUikAfW', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('236', '50131371', 'WYvDgCYG', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('237', '50138260', 'LQEpzzal', '1000.00', '100.00', '1', '2018-08-23 11:59:16', '2018-08-27 16:42:39', null, '8');
INSERT INTO `cards` VALUES ('238', '50131537', '1lOCHeLG', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('239', '50134072', 'mlsGlLkE', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('240', '50130711', '0PPE1ByR', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('241', '50133213', 'BXgMWnIn', '1000.00', '100.00', '0', '2018-08-23 11:59:16', '2018-08-23 11:59:16', null, '8');
INSERT INTO `cards` VALUES ('242', '50138283', 'gX7uzzbI', '1000.00', '100.00', '1', '2018-08-23 11:59:16', '2018-08-27 16:32:02', null, '8');
INSERT INTO `cards` VALUES ('243', '50134127', 'fOq1dPYo', '1000.00', '10000.00', '1', '2018-08-27 15:31:21', '2018-08-27 15:31:53', null, '8');
INSERT INTO `cards` VALUES ('244', '50136577', 'xSQLHpuP', '1000.00', '10000.00', '1', '2018-08-27 15:44:20', '2018-08-27 15:45:47', null, '8');
INSERT INTO `cards` VALUES ('245', '50139455', 'ILOP8Z2G', '1000.00', '10000.00', '1', '2018-08-27 15:46:23', '2018-08-27 15:47:04', null, '8');
INSERT INTO `cards` VALUES ('246', '50132596', 'rA715exQ', '1000.00', '10000.00', '1', '2018-08-27 16:33:13', '2018-08-27 16:34:40', null, '8');
INSERT INTO `cards` VALUES ('247', '50137717', '123456', '1000.00', '10000.00', '1', '2018-08-27 16:43:56', '2018-08-27 16:44:52', null, '8');
INSERT INTO `cards` VALUES ('248', '50133587', 'fBSmANxg', '1000.00', '12000.00', '0', '2018-09-05 09:58:00', '2018-09-05 09:58:00', null, '8');
INSERT INTO `cards` VALUES ('249', '50132898', 'VX196637', '1000.00', '100.00', '0', '2018-09-05 10:52:02', '2018-09-05 10:52:02', null, '8');
INSERT INTO `cards` VALUES ('250', '50139514', 'uZ069197', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('251', '50139906', 'JG236114', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('252', '50130436', 'Hs520884', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('253', '50137322', 'Cb663038', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('254', '50138439', 'wN290007', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('255', '50136404', 'Xj534485', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('256', '50138876', 'uY624742', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('257', '50133773', 'kd602181', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('258', '50138205', 'zv915198', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');
INSERT INTO `cards` VALUES ('259', '50133371', 'Ko599340', '1000.00', '100.00', '0', '2018-09-05 10:52:12', '2018-09-05 10:52:12', null, '8');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `pc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'PC分类名称',
  `brief` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '简介',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分类别名',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `recommend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐 0否 1是',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `parent_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分类路径',
  `level` int(11) NOT NULL DEFAULT '1' COMMENT '等级',
  `show` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '是' COMMENT '是否展示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('上线','下架') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '上线' COMMENT '当前状态(上线 下架)',
  PRIMARY KEY (`id`),
  KEY `categories_id_created_at_index` (`id`,`created_at`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_level_index` (`level`),
  KEY `categories_sort_index` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', '汽车', null, null, 'qi-che', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E6%B1%BD%E8%BD%A6.png', '0', '0', '0', '1', '是', '2018-08-17 17:28:46', '2018-09-05 14:19:33', null, '上线');
INSERT INTO `categories` VALUES ('2', '宝马', null, null, 'bao-ma', '0', 'http://yibei.wiswebs.com/uploads/timg%20(1).jpg', '0', '1', '0_1', '2', '是', '2018-08-17 17:29:13', '2018-09-05 14:40:36', null, '上线');
INSERT INTO `categories` VALUES ('3', '房产置业', null, null, 'fang-chan-zhi-ye', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E6%88%BF%E4%BA%A7.png', '0', '0', '0', '1', '是', '2018-08-19 10:35:55', '2018-08-19 10:35:55', null, '上线');
INSERT INTO `categories` VALUES ('4', '黄金珠宝', null, null, 'huang-jin-zhu-bao', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%8F%A0%E5%AE%9D.png', '0', '0', '0', '1', '是', '2018-08-19 10:36:04', '2018-08-19 10:36:04', null, '上线');
INSERT INTO `categories` VALUES ('5', '广告媒体', null, null, 'guang-gao-mei-ti', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%B9%BF%E5%91%8A.png', '0', '0', '0', '1', '是', '2018-08-19 10:36:19', '2018-08-19 10:36:19', null, '上线');
INSERT INTO `categories` VALUES ('6', '国际名品', null, null, 'guo-ji-ming-pin', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%93%81%E7%89%8C.png', '0', '0', '0', '1', '是', '2018-08-19 10:36:30', '2018-08-19 10:36:30', null, '上线');
INSERT INTO `categories` VALUES ('7', '建材家居', null, null, 'jian-cai-jia-ju', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%AE%B6%E5%85%B7.png', '0', '0', '0', '1', '是', '2018-08-19 10:36:43', '2018-08-19 10:36:43', null, '上线');
INSERT INTO `categories` VALUES ('8', '消费卡区', null, null, 'xiao-fei-ka-qu', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%8D%A1.png', '0', '0', '0', '1', '是', '2018-08-19 10:36:52', '2018-08-19 10:36:52', null, '上线');
INSERT INTO `categories` VALUES ('9', '企业店铺', null, null, 'qi-ye-dian-pu', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%BA%97%E9%93%BA.png', '0', '0', '0', '1', '是', '2018-08-19 10:37:04', '2018-08-19 15:13:31', '2018-08-19 15:13:31', '上线');
INSERT INTO `categories` VALUES ('10', '商铺', null, null, 'shang-pu', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%95%86%E9%93%BA.jpg', '0', '3', '0_3', '2', '是', '2018-08-19 10:38:37', '2018-08-19 10:38:37', null, '上线');
INSERT INTO `categories` VALUES ('11', '住宅', null, null, 'zhu-zhai', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E4%BD%8F%E5%AE%85.jpg', '0', '3', '0_3', '2', '是', '2018-08-19 10:38:49', '2018-08-19 10:38:49', null, '上线');
INSERT INTO `categories` VALUES ('12', '钻石首饰', null, null, 'zuan-shi-shou-shi', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E9%92%BB%E7%9F%B3.jpg', '0', '4', '0_4', '2', '是', '2018-08-19 10:40:44', '2018-08-19 10:40:44', null, '上线');
INSERT INTO `categories` VALUES ('13', '翡翠', null, null, 'fei-cui', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%BF%A1%E7%BF%A0%E2%80%98.jpg', '0', '4', '0_4', '2', '是', '2018-08-19 10:41:22', '2018-08-19 10:41:22', null, '上线');
INSERT INTO `categories` VALUES ('14', '珍珠', null, null, 'zhen-zhu', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%8F%8D%E7%8F%A0.jpg', '0', '4', '0_4', '2', '是', '2018-08-19 10:41:34', '2018-08-19 10:41:34', null, '上线');
INSERT INTO `categories` VALUES ('15', '高炮', null, null, 'gao-pao', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E9%AB%98%E7%82%AE.jpg', '0', '5', '0_5', '2', '是', '2018-08-19 10:49:48', '2018-08-19 10:49:48', null, '上线');
INSERT INTO `categories` VALUES ('16', '灯箱广告', null, null, 'deng-xiang-guang-gao', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%81%AF%E7%AE%B1.jpg', '0', '5', '0_5', '2', '是', '2018-08-19 10:50:09', '2018-08-19 10:50:09', null, '上线');
INSERT INTO `categories` VALUES ('17', 'LED广告', null, null, 'LED-guang-gao', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/led.jpg', '0', '5', '0_5', '2', '是', '2018-08-19 10:50:27', '2018-08-19 10:50:27', null, '上线');
INSERT INTO `categories` VALUES ('18', '纸媒广告', null, null, 'zhi-mei-guang-gao', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%BA%B8%E5%AA%92.jpg', '0', '5', '0_5', '2', '是', '2018-08-19 10:50:51', '2018-08-19 10:50:51', null, '上线');
INSERT INTO `categories` VALUES ('19', '电视/广播广告', null, null, 'dian-shi-guang-bo-guang-gao', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%94%B5%E8%A7%86.jpg', '0', '5', '0_5', '2', '是', '2018-08-19 10:51:06', '2018-08-19 10:51:06', null, '上线');
INSERT INTO `categories` VALUES ('20', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E5%95%86%E9%93%BA.jpg', '0', '6', '0_6', '2', '是', '2018-08-19 13:32:47', '2018-08-19 13:32:47', null, '上线');
INSERT INTO `categories` VALUES ('21', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E4%BD%8F%E5%AE%85.jpg', '0', '6', '0_6', '2', '是', '2018-08-19 13:33:01', '2018-08-19 13:33:01', null, '上线');
INSERT INTO `categories` VALUES ('22', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%81%AF%E7%AE%B1.jpg', '0', '7', '0_7', '2', '是', '2018-08-19 13:33:15', '2018-08-19 13:33:15', null, '上线');
INSERT INTO `categories` VALUES ('23', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/led.jpg', '0', '7', '0_7', '2', '是', '2018-08-19 13:33:31', '2018-08-19 13:33:31', null, '上线');
INSERT INTO `categories` VALUES ('24', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%8F%8D%E7%8F%A0.jpg', '0', '8', '0_8', '2', '是', '2018-08-19 13:33:49', '2018-09-05 14:46:04', '2018-09-05 14:46:04', '上线');
INSERT INTO `categories` VALUES ('25', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%BA%B8%E5%AA%92.jpg', '0', '8', '0_8', '2', '是', '2018-08-19 13:34:00', '2018-08-19 13:34:00', null, '上线');
INSERT INTO `categories` VALUES ('26', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%94%B5%E8%A7%86.jpg', '0', '9', '0_9', '2', '是', '2018-08-19 13:34:14', '2018-08-19 15:13:22', '2018-08-19 15:13:22', '上线');
INSERT INTO `categories` VALUES ('27', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E9%AB%98%E7%82%AE.jpg', '0', '9', '0_9', '2', '是', '2018-08-19 13:34:23', '2018-08-19 15:13:29', '2018-08-19 15:13:29', '上线');
INSERT INTO `categories` VALUES ('28', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E9%92%BB%E7%9F%B3.jpg', '0', '9', '0_9', '2', '是', '2018-08-19 13:34:34', '2018-08-19 15:13:26', '2018-08-19 15:13:26', '上线');
INSERT INTO `categories` VALUES ('29', '二级分类', null, null, 'er-ji-fen-lei', '0', 'http://yibei.wiswebs.com/uploads/%E5%9B%BE%E6%A0%87/%E7%8F%8D%E7%8F%A0.jpg', '0', '7', '0_7', '2', '是', '2018-08-19 13:35:34', '2018-08-19 13:35:34', null, '上线');
INSERT INTO `categories` VALUES ('30', '高端定制', null, null, 'gao-duan-ding-zhi', '0', null, '0', '0', '0', '1', '是', '2018-08-31 11:53:54', '2018-08-31 11:55:22', '2018-08-31 11:55:22', '上线');
INSERT INTO `categories` VALUES ('31', '奔驰', null, null, 'ben-chi', '0', 'http://yibei.wiswebs.com/uploads/timg_1.jpg', '0', '1', '0_1', '2', '是', '2018-09-05 14:20:14', '2018-09-05 14:42:43', null, '上线');
INSERT INTO `categories` VALUES ('32', '捷豹', null, null, 'jie-bao', '0', 'http://yibei.wiswebs.com/uploads/636589483093202707JA.jpg', '0', '1', '0_1', '2', '是', '2018-09-05 14:20:33', '2018-09-05 14:35:44', null, '上线');
INSERT INTO `categories` VALUES ('33', '路虎', null, null, 'lu-hu', '0', 'http://yibei.wiswebs.com/uploads/timg.jpg', '0', '1', '0_1', '2', '是', '2018-09-05 14:20:51', '2018-09-05 14:38:01', null, '上线');

-- ----------------------------
-- Table structure for cats
-- ----------------------------
DROP TABLE IF EXISTS `cats`;
CREATE TABLE `cats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `sort` int(11) DEFAULT '0' COMMENT '权重',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺分类图片',
  PRIMARY KEY (`id`),
  KEY `cats_id_created_at_index` (`id`,`created_at`),
  KEY `cats_sort_index` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cats
-- ----------------------------
INSERT INTO `cats` VALUES ('1', '加油站', '1', '2018-08-19 11:30:37', '2018-08-19 11:30:37', null, null);
INSERT INTO `cats` VALUES ('2', '超市', '2', '2018-08-19 11:30:46', '2018-08-19 11:30:46', null, null);
INSERT INTO `cats` VALUES ('3', '酒店', '3', '2018-08-19 11:30:54', '2018-08-19 11:30:54', null, null);

-- ----------------------------
-- Table structure for certs
-- ----------------------------
DROP TABLE IF EXISTS `certs`;
CREATE TABLE `certs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '真实姓名',
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '身份证号',
  `face_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '身份证人脸图片',
  `back_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '身份证背面国徽图片',
  `hand_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手持身份证图片',
  `status` enum('审核中','已通过','未通过') COLLATE utf8mb4_unicode_ci DEFAULT '审核中' COMMENT '审核状态',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certs_id_created_at_index` (`id`,`created_at`),
  KEY `certs_user_id_index` (`user_id`),
  CONSTRAINT `certs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of certs
-- ----------------------------
INSERT INTO `certs` VALUES ('1', '王小明', '420982199404130120', 'http://yibei.wiswebs.com/uploads/user/2/image/rY6GRy3v9Z.jpg', 'http://yibei.wiswebs.com/uploads/user/2/image/8dmUI9hYmp.png', 'http://yibei.wiswebs.com/uploads/user/2/image/5YeVMg8oDp.jpg', '未通过', '2', '2018-08-27 10:34:51', '2018-08-28 17:41:06', null);
INSERT INTO `certs` VALUES ('2', '王先生', '450521198612030032', 'http://yibei.wiswebs.com/uploads/user/4/image/w6HOTCE7G4.jpg', 'http://yibei.wiswebs.com/uploads/user/4/image/3BiVMNPKpl.jpg', 'http://yibei.wiswebs.com/uploads/user/4/image/AX3ou6BOvq.jpg', '已通过', '4', '2018-08-27 14:54:24', '2018-08-27 14:56:33', null);

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '城市名称',
  `level` int(11) NOT NULL COMMENT '城市级别',
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cities_id_index` (`id`),
  KEY `cities_pid_index` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=3434 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO `cities` VALUES ('1', '0', '全国', '0', '0');
INSERT INTO `cities` VALUES ('2', '1', '北京市', '1', '0');
INSERT INTO `cities` VALUES ('3', '1', '安徽省', '1', '0');
INSERT INTO `cities` VALUES ('4', '1', '福建省', '1', '0');
INSERT INTO `cities` VALUES ('5', '1', '甘肃省', '1', '0');
INSERT INTO `cities` VALUES ('6', '1', '广东省', '1', '0');
INSERT INTO `cities` VALUES ('7', '1', '广西壮族自治区', '1', '0');
INSERT INTO `cities` VALUES ('8', '1', '贵州省', '1', '0');
INSERT INTO `cities` VALUES ('9', '1', '海南省', '1', '0');
INSERT INTO `cities` VALUES ('10', '1', '河北省', '1', '0');
INSERT INTO `cities` VALUES ('11', '1', '河南省', '1', '0');
INSERT INTO `cities` VALUES ('12', '1', '黑龙江省', '1', '0');
INSERT INTO `cities` VALUES ('13', '1', '湖北省', '1', '0');
INSERT INTO `cities` VALUES ('14', '1', '湖南省', '1', '0');
INSERT INTO `cities` VALUES ('15', '1', '吉林省', '1', '0');
INSERT INTO `cities` VALUES ('16', '1', '江苏省', '1', '0');
INSERT INTO `cities` VALUES ('17', '1', '江西省', '1', '0');
INSERT INTO `cities` VALUES ('18', '1', '辽宁省', '1', '0');
INSERT INTO `cities` VALUES ('19', '1', '内蒙古自治区', '1', '0');
INSERT INTO `cities` VALUES ('20', '1', '宁夏回族自治区', '1', '0');
INSERT INTO `cities` VALUES ('21', '1', '青海省', '1', '0');
INSERT INTO `cities` VALUES ('22', '1', '山东省', '1', '0');
INSERT INTO `cities` VALUES ('23', '1', '山西省', '1', '0');
INSERT INTO `cities` VALUES ('24', '1', '陕西省', '1', '0');
INSERT INTO `cities` VALUES ('25', '1', '上海市', '1', '0');
INSERT INTO `cities` VALUES ('26', '1', '四川省', '1', '0');
INSERT INTO `cities` VALUES ('27', '1', '天津市', '1', '0');
INSERT INTO `cities` VALUES ('28', '1', '西藏自治区', '1', '0');
INSERT INTO `cities` VALUES ('29', '1', '新疆维吾尔自治区', '1', '0');
INSERT INTO `cities` VALUES ('30', '1', '云南省', '1', '0');
INSERT INTO `cities` VALUES ('31', '1', '浙江省', '1', '0');
INSERT INTO `cities` VALUES ('32', '1', '重庆市', '1', '0');
INSERT INTO `cities` VALUES ('33', '1', '香港特别行政区', '1', '0');
INSERT INTO `cities` VALUES ('34', '1', '澳门特别行政区', '1', '0');
INSERT INTO `cities` VALUES ('35', '1', '台湾省', '1', '0');
INSERT INTO `cities` VALUES ('36', '3', '安庆', '2', '0');
INSERT INTO `cities` VALUES ('37', '3', '蚌埠', '2', '0');
INSERT INTO `cities` VALUES ('38', '3', '巢湖', '2', '0');
INSERT INTO `cities` VALUES ('39', '3', '池州', '2', '0');
INSERT INTO `cities` VALUES ('40', '3', '滁州', '2', '0');
INSERT INTO `cities` VALUES ('41', '3', '阜阳', '2', '0');
INSERT INTO `cities` VALUES ('42', '3', '淮北', '2', '0');
INSERT INTO `cities` VALUES ('43', '3', '淮南', '2', '0');
INSERT INTO `cities` VALUES ('44', '3', '黄山', '2', '0');
INSERT INTO `cities` VALUES ('45', '3', '六安', '2', '0');
INSERT INTO `cities` VALUES ('46', '3', '马鞍山', '2', '0');
INSERT INTO `cities` VALUES ('47', '3', '宿州', '2', '0');
INSERT INTO `cities` VALUES ('48', '3', '铜陵', '2', '0');
INSERT INTO `cities` VALUES ('49', '3', '芜湖', '2', '0');
INSERT INTO `cities` VALUES ('50', '3', '宣城', '2', '0');
INSERT INTO `cities` VALUES ('51', '3', '亳州', '2', '0');
INSERT INTO `cities` VALUES ('52', '2', '北京', '2', '0');
INSERT INTO `cities` VALUES ('53', '4', '福州', '2', '0');
INSERT INTO `cities` VALUES ('54', '4', '龙岩', '2', '0');
INSERT INTO `cities` VALUES ('55', '4', '南平', '2', '0');
INSERT INTO `cities` VALUES ('56', '4', '宁德', '2', '0');
INSERT INTO `cities` VALUES ('57', '4', '莆田', '2', '0');
INSERT INTO `cities` VALUES ('58', '4', '泉州', '2', '0');
INSERT INTO `cities` VALUES ('59', '4', '三明', '2', '0');
INSERT INTO `cities` VALUES ('60', '4', '厦门', '2', '0');
INSERT INTO `cities` VALUES ('61', '4', '漳州', '2', '0');
INSERT INTO `cities` VALUES ('62', '5', '兰州', '2', '0');
INSERT INTO `cities` VALUES ('63', '5', '白银', '2', '0');
INSERT INTO `cities` VALUES ('64', '5', '定西', '2', '0');
INSERT INTO `cities` VALUES ('65', '5', '甘南', '2', '0');
INSERT INTO `cities` VALUES ('66', '5', '嘉峪关', '2', '0');
INSERT INTO `cities` VALUES ('67', '5', '金昌', '2', '0');
INSERT INTO `cities` VALUES ('68', '5', '酒泉', '2', '0');
INSERT INTO `cities` VALUES ('69', '5', '临夏', '2', '0');
INSERT INTO `cities` VALUES ('70', '5', '陇南', '2', '0');
INSERT INTO `cities` VALUES ('71', '5', '平凉', '2', '0');
INSERT INTO `cities` VALUES ('72', '5', '庆阳', '2', '0');
INSERT INTO `cities` VALUES ('73', '5', '天水', '2', '0');
INSERT INTO `cities` VALUES ('74', '5', '武威', '2', '0');
INSERT INTO `cities` VALUES ('75', '5', '张掖', '2', '0');
INSERT INTO `cities` VALUES ('76', '6', '广州', '2', '0');
INSERT INTO `cities` VALUES ('77', '6', '深圳', '2', '0');
INSERT INTO `cities` VALUES ('78', '6', '潮州', '2', '0');
INSERT INTO `cities` VALUES ('79', '6', '东莞', '2', '0');
INSERT INTO `cities` VALUES ('80', '6', '佛山', '2', '0');
INSERT INTO `cities` VALUES ('81', '6', '河源', '2', '0');
INSERT INTO `cities` VALUES ('82', '6', '惠州', '2', '0');
INSERT INTO `cities` VALUES ('83', '6', '江门', '2', '0');
INSERT INTO `cities` VALUES ('84', '6', '揭阳', '2', '0');
INSERT INTO `cities` VALUES ('85', '6', '茂名', '2', '0');
INSERT INTO `cities` VALUES ('86', '6', '梅州', '2', '0');
INSERT INTO `cities` VALUES ('87', '6', '清远', '2', '0');
INSERT INTO `cities` VALUES ('88', '6', '汕头', '2', '0');
INSERT INTO `cities` VALUES ('89', '6', '汕尾', '2', '0');
INSERT INTO `cities` VALUES ('90', '6', '韶关', '2', '0');
INSERT INTO `cities` VALUES ('91', '6', '阳江', '2', '0');
INSERT INTO `cities` VALUES ('92', '6', '云浮', '2', '0');
INSERT INTO `cities` VALUES ('93', '6', '湛江', '2', '0');
INSERT INTO `cities` VALUES ('94', '6', '肇庆', '2', '0');
INSERT INTO `cities` VALUES ('95', '6', '中山', '2', '0');
INSERT INTO `cities` VALUES ('96', '6', '珠海', '2', '0');
INSERT INTO `cities` VALUES ('97', '7', '南宁', '2', '0');
INSERT INTO `cities` VALUES ('98', '7', '桂林', '2', '0');
INSERT INTO `cities` VALUES ('99', '7', '百色', '2', '0');
INSERT INTO `cities` VALUES ('100', '7', '北海', '2', '0');
INSERT INTO `cities` VALUES ('101', '7', '崇左', '2', '0');
INSERT INTO `cities` VALUES ('102', '7', '防城港', '2', '0');
INSERT INTO `cities` VALUES ('103', '7', '贵港', '2', '0');
INSERT INTO `cities` VALUES ('104', '7', '河池', '2', '0');
INSERT INTO `cities` VALUES ('105', '7', '贺州', '2', '0');
INSERT INTO `cities` VALUES ('106', '7', '来宾', '2', '0');
INSERT INTO `cities` VALUES ('107', '7', '柳州', '2', '0');
INSERT INTO `cities` VALUES ('108', '7', '钦州', '2', '0');
INSERT INTO `cities` VALUES ('109', '7', '梧州', '2', '0');
INSERT INTO `cities` VALUES ('110', '7', '玉林', '2', '0');
INSERT INTO `cities` VALUES ('111', '8', '贵阳', '2', '0');
INSERT INTO `cities` VALUES ('112', '8', '安顺', '2', '0');
INSERT INTO `cities` VALUES ('113', '8', '毕节', '2', '0');
INSERT INTO `cities` VALUES ('114', '8', '六盘水', '2', '0');
INSERT INTO `cities` VALUES ('115', '8', '黔东南', '2', '0');
INSERT INTO `cities` VALUES ('116', '8', '黔南', '2', '0');
INSERT INTO `cities` VALUES ('117', '8', '黔西南', '2', '0');
INSERT INTO `cities` VALUES ('118', '8', '铜仁', '2', '0');
INSERT INTO `cities` VALUES ('119', '8', '遵义', '2', '0');
INSERT INTO `cities` VALUES ('120', '9', '海口', '2', '0');
INSERT INTO `cities` VALUES ('121', '9', '三亚', '2', '0');
INSERT INTO `cities` VALUES ('122', '9', '白沙', '2', '0');
INSERT INTO `cities` VALUES ('123', '9', '保亭', '2', '0');
INSERT INTO `cities` VALUES ('124', '9', '昌江', '2', '0');
INSERT INTO `cities` VALUES ('125', '9', '澄迈县', '2', '0');
INSERT INTO `cities` VALUES ('126', '9', '定安县', '2', '0');
INSERT INTO `cities` VALUES ('127', '9', '东方', '2', '0');
INSERT INTO `cities` VALUES ('128', '9', '乐东', '2', '0');
INSERT INTO `cities` VALUES ('129', '9', '临高县', '2', '0');
INSERT INTO `cities` VALUES ('130', '9', '陵水', '2', '0');
INSERT INTO `cities` VALUES ('131', '9', '琼海', '2', '0');
INSERT INTO `cities` VALUES ('132', '9', '琼中', '2', '0');
INSERT INTO `cities` VALUES ('133', '9', '屯昌县', '2', '0');
INSERT INTO `cities` VALUES ('134', '9', '万宁', '2', '0');
INSERT INTO `cities` VALUES ('135', '9', '文昌', '2', '0');
INSERT INTO `cities` VALUES ('136', '9', '五指山', '2', '0');
INSERT INTO `cities` VALUES ('137', '9', '儋州', '2', '0');
INSERT INTO `cities` VALUES ('138', '10', '石家庄', '2', '0');
INSERT INTO `cities` VALUES ('139', '10', '保定', '2', '0');
INSERT INTO `cities` VALUES ('140', '10', '沧州', '2', '0');
INSERT INTO `cities` VALUES ('141', '10', '承德', '2', '0');
INSERT INTO `cities` VALUES ('142', '10', '邯郸', '2', '0');
INSERT INTO `cities` VALUES ('143', '10', '衡水', '2', '0');
INSERT INTO `cities` VALUES ('144', '10', '廊坊', '2', '0');
INSERT INTO `cities` VALUES ('145', '10', '秦皇岛', '2', '0');
INSERT INTO `cities` VALUES ('146', '10', '唐山', '2', '0');
INSERT INTO `cities` VALUES ('147', '10', '邢台', '2', '0');
INSERT INTO `cities` VALUES ('148', '10', '张家口', '2', '0');
INSERT INTO `cities` VALUES ('149', '11', '郑州', '2', '0');
INSERT INTO `cities` VALUES ('150', '11', '洛阳', '2', '0');
INSERT INTO `cities` VALUES ('151', '11', '开封', '2', '0');
INSERT INTO `cities` VALUES ('152', '11', '安阳', '2', '0');
INSERT INTO `cities` VALUES ('153', '11', '鹤壁', '2', '0');
INSERT INTO `cities` VALUES ('154', '11', '济源', '2', '0');
INSERT INTO `cities` VALUES ('155', '11', '焦作', '2', '0');
INSERT INTO `cities` VALUES ('156', '11', '南阳', '2', '0');
INSERT INTO `cities` VALUES ('157', '11', '平顶山', '2', '0');
INSERT INTO `cities` VALUES ('158', '11', '三门峡', '2', '0');
INSERT INTO `cities` VALUES ('159', '11', '商丘', '2', '0');
INSERT INTO `cities` VALUES ('160', '11', '新乡', '2', '0');
INSERT INTO `cities` VALUES ('161', '11', '信阳', '2', '0');
INSERT INTO `cities` VALUES ('162', '11', '许昌', '2', '0');
INSERT INTO `cities` VALUES ('163', '11', '周口', '2', '0');
INSERT INTO `cities` VALUES ('164', '11', '驻马店', '2', '0');
INSERT INTO `cities` VALUES ('165', '11', '漯河', '2', '0');
INSERT INTO `cities` VALUES ('166', '11', '濮阳', '2', '0');
INSERT INTO `cities` VALUES ('167', '12', '哈尔滨', '2', '0');
INSERT INTO `cities` VALUES ('168', '12', '大庆', '2', '0');
INSERT INTO `cities` VALUES ('169', '12', '大兴安岭', '2', '0');
INSERT INTO `cities` VALUES ('170', '12', '鹤岗', '2', '0');
INSERT INTO `cities` VALUES ('171', '12', '黑河', '2', '0');
INSERT INTO `cities` VALUES ('172', '12', '鸡西', '2', '0');
INSERT INTO `cities` VALUES ('173', '12', '佳木斯', '2', '0');
INSERT INTO `cities` VALUES ('174', '12', '牡丹江', '2', '0');
INSERT INTO `cities` VALUES ('175', '12', '七台河', '2', '0');
INSERT INTO `cities` VALUES ('176', '12', '齐齐哈尔', '2', '0');
INSERT INTO `cities` VALUES ('177', '12', '双鸭山', '2', '0');
INSERT INTO `cities` VALUES ('178', '12', '绥化', '2', '0');
INSERT INTO `cities` VALUES ('179', '12', '伊春', '2', '0');
INSERT INTO `cities` VALUES ('180', '13', '武汉', '2', '0');
INSERT INTO `cities` VALUES ('181', '13', '仙桃', '2', '0');
INSERT INTO `cities` VALUES ('182', '13', '鄂州', '2', '0');
INSERT INTO `cities` VALUES ('183', '13', '黄冈', '2', '0');
INSERT INTO `cities` VALUES ('184', '13', '黄石', '2', '0');
INSERT INTO `cities` VALUES ('185', '13', '荆门', '2', '0');
INSERT INTO `cities` VALUES ('186', '13', '荆州', '2', '0');
INSERT INTO `cities` VALUES ('187', '13', '潜江', '2', '0');
INSERT INTO `cities` VALUES ('188', '13', '神农架林区', '2', '0');
INSERT INTO `cities` VALUES ('189', '13', '十堰', '2', '0');
INSERT INTO `cities` VALUES ('190', '13', '随州', '2', '0');
INSERT INTO `cities` VALUES ('191', '13', '天门', '2', '0');
INSERT INTO `cities` VALUES ('192', '13', '咸宁', '2', '0');
INSERT INTO `cities` VALUES ('193', '13', '襄樊', '2', '0');
INSERT INTO `cities` VALUES ('194', '13', '孝感', '2', '0');
INSERT INTO `cities` VALUES ('195', '13', '宜昌', '2', '0');
INSERT INTO `cities` VALUES ('196', '13', '恩施', '2', '0');
INSERT INTO `cities` VALUES ('197', '14', '长沙', '2', '0');
INSERT INTO `cities` VALUES ('198', '14', '张家界', '2', '0');
INSERT INTO `cities` VALUES ('199', '14', '常德', '2', '0');
INSERT INTO `cities` VALUES ('200', '14', '郴州', '2', '0');
INSERT INTO `cities` VALUES ('201', '14', '衡阳', '2', '0');
INSERT INTO `cities` VALUES ('202', '14', '怀化', '2', '0');
INSERT INTO `cities` VALUES ('203', '14', '娄底', '2', '0');
INSERT INTO `cities` VALUES ('204', '14', '邵阳', '2', '0');
INSERT INTO `cities` VALUES ('205', '14', '湘潭', '2', '0');
INSERT INTO `cities` VALUES ('206', '14', '湘西', '2', '0');
INSERT INTO `cities` VALUES ('207', '14', '益阳', '2', '0');
INSERT INTO `cities` VALUES ('208', '14', '永州', '2', '0');
INSERT INTO `cities` VALUES ('209', '14', '岳阳', '2', '0');
INSERT INTO `cities` VALUES ('210', '14', '株洲', '2', '0');
INSERT INTO `cities` VALUES ('211', '15', '长春', '2', '0');
INSERT INTO `cities` VALUES ('212', '15', '吉林', '2', '0');
INSERT INTO `cities` VALUES ('213', '15', '白城', '2', '0');
INSERT INTO `cities` VALUES ('214', '15', '白山', '2', '0');
INSERT INTO `cities` VALUES ('215', '15', '辽源', '2', '0');
INSERT INTO `cities` VALUES ('216', '15', '四平', '2', '0');
INSERT INTO `cities` VALUES ('217', '15', '松原', '2', '0');
INSERT INTO `cities` VALUES ('218', '15', '通化', '2', '0');
INSERT INTO `cities` VALUES ('219', '15', '延边', '2', '0');
INSERT INTO `cities` VALUES ('220', '16', '南京', '2', '0');
INSERT INTO `cities` VALUES ('221', '16', '苏州', '2', '0');
INSERT INTO `cities` VALUES ('222', '16', '无锡', '2', '0');
INSERT INTO `cities` VALUES ('223', '16', '常州', '2', '0');
INSERT INTO `cities` VALUES ('224', '16', '淮安', '2', '0');
INSERT INTO `cities` VALUES ('225', '16', '连云港', '2', '0');
INSERT INTO `cities` VALUES ('226', '16', '南通', '2', '0');
INSERT INTO `cities` VALUES ('227', '16', '宿迁', '2', '0');
INSERT INTO `cities` VALUES ('228', '16', '泰州', '2', '0');
INSERT INTO `cities` VALUES ('229', '16', '徐州', '2', '0');
INSERT INTO `cities` VALUES ('230', '16', '盐城', '2', '0');
INSERT INTO `cities` VALUES ('231', '16', '扬州', '2', '0');
INSERT INTO `cities` VALUES ('232', '16', '镇江', '2', '0');
INSERT INTO `cities` VALUES ('233', '17', '南昌', '2', '0');
INSERT INTO `cities` VALUES ('234', '17', '抚州', '2', '0');
INSERT INTO `cities` VALUES ('235', '17', '赣州', '2', '0');
INSERT INTO `cities` VALUES ('236', '17', '吉安', '2', '0');
INSERT INTO `cities` VALUES ('237', '17', '景德镇', '2', '0');
INSERT INTO `cities` VALUES ('238', '17', '九江', '2', '0');
INSERT INTO `cities` VALUES ('239', '17', '萍乡', '2', '0');
INSERT INTO `cities` VALUES ('240', '17', '上饶', '2', '0');
INSERT INTO `cities` VALUES ('241', '17', '新余', '2', '0');
INSERT INTO `cities` VALUES ('242', '17', '宜春', '2', '0');
INSERT INTO `cities` VALUES ('243', '17', '鹰潭', '2', '0');
INSERT INTO `cities` VALUES ('244', '18', '沈阳', '2', '0');
INSERT INTO `cities` VALUES ('245', '18', '大连', '2', '0');
INSERT INTO `cities` VALUES ('246', '18', '鞍山', '2', '0');
INSERT INTO `cities` VALUES ('247', '18', '本溪', '2', '0');
INSERT INTO `cities` VALUES ('248', '18', '朝阳', '2', '0');
INSERT INTO `cities` VALUES ('249', '18', '丹东', '2', '0');
INSERT INTO `cities` VALUES ('250', '18', '抚顺', '2', '0');
INSERT INTO `cities` VALUES ('251', '18', '阜新', '2', '0');
INSERT INTO `cities` VALUES ('252', '18', '葫芦岛', '2', '0');
INSERT INTO `cities` VALUES ('253', '18', '锦州', '2', '0');
INSERT INTO `cities` VALUES ('254', '18', '辽阳', '2', '0');
INSERT INTO `cities` VALUES ('255', '18', '盘锦', '2', '0');
INSERT INTO `cities` VALUES ('256', '18', '铁岭', '2', '0');
INSERT INTO `cities` VALUES ('257', '18', '营口', '2', '0');
INSERT INTO `cities` VALUES ('258', '19', '呼和浩特', '2', '0');
INSERT INTO `cities` VALUES ('259', '19', '阿拉善盟', '2', '0');
INSERT INTO `cities` VALUES ('260', '19', '巴彦淖尔盟', '2', '0');
INSERT INTO `cities` VALUES ('261', '19', '包头', '2', '0');
INSERT INTO `cities` VALUES ('262', '19', '赤峰', '2', '0');
INSERT INTO `cities` VALUES ('263', '19', '鄂尔多斯', '2', '0');
INSERT INTO `cities` VALUES ('264', '19', '呼伦贝尔', '2', '0');
INSERT INTO `cities` VALUES ('265', '19', '通辽', '2', '0');
INSERT INTO `cities` VALUES ('266', '19', '乌海', '2', '0');
INSERT INTO `cities` VALUES ('267', '19', '乌兰察布市', '2', '0');
INSERT INTO `cities` VALUES ('268', '19', '锡林郭勒盟', '2', '0');
INSERT INTO `cities` VALUES ('269', '19', '兴安盟', '2', '0');
INSERT INTO `cities` VALUES ('270', '20', '银川', '2', '0');
INSERT INTO `cities` VALUES ('271', '20', '固原', '2', '0');
INSERT INTO `cities` VALUES ('272', '20', '石嘴山', '2', '0');
INSERT INTO `cities` VALUES ('273', '20', '吴忠', '2', '0');
INSERT INTO `cities` VALUES ('274', '20', '中卫', '2', '0');
INSERT INTO `cities` VALUES ('275', '21', '西宁', '2', '0');
INSERT INTO `cities` VALUES ('276', '21', '果洛', '2', '0');
INSERT INTO `cities` VALUES ('277', '21', '海北', '2', '0');
INSERT INTO `cities` VALUES ('278', '21', '海东', '2', '0');
INSERT INTO `cities` VALUES ('279', '21', '海南', '2', '0');
INSERT INTO `cities` VALUES ('280', '21', '海西', '2', '0');
INSERT INTO `cities` VALUES ('281', '21', '黄南', '2', '0');
INSERT INTO `cities` VALUES ('282', '21', '玉树', '2', '0');
INSERT INTO `cities` VALUES ('283', '22', '济南', '2', '0');
INSERT INTO `cities` VALUES ('284', '22', '青岛', '2', '0');
INSERT INTO `cities` VALUES ('285', '22', '滨州', '2', '0');
INSERT INTO `cities` VALUES ('286', '22', '德州', '2', '0');
INSERT INTO `cities` VALUES ('287', '22', '东营', '2', '0');
INSERT INTO `cities` VALUES ('288', '22', '菏泽', '2', '0');
INSERT INTO `cities` VALUES ('289', '22', '济宁', '2', '0');
INSERT INTO `cities` VALUES ('290', '22', '莱芜', '2', '0');
INSERT INTO `cities` VALUES ('291', '22', '聊城', '2', '0');
INSERT INTO `cities` VALUES ('292', '22', '临沂', '2', '0');
INSERT INTO `cities` VALUES ('293', '22', '日照', '2', '0');
INSERT INTO `cities` VALUES ('294', '22', '泰安', '2', '0');
INSERT INTO `cities` VALUES ('295', '22', '威海', '2', '0');
INSERT INTO `cities` VALUES ('296', '22', '潍坊', '2', '0');
INSERT INTO `cities` VALUES ('297', '22', '烟台', '2', '0');
INSERT INTO `cities` VALUES ('298', '22', '枣庄', '2', '0');
INSERT INTO `cities` VALUES ('299', '22', '淄博', '2', '0');
INSERT INTO `cities` VALUES ('300', '23', '太原', '2', '0');
INSERT INTO `cities` VALUES ('301', '23', '长治', '2', '0');
INSERT INTO `cities` VALUES ('302', '23', '大同', '2', '0');
INSERT INTO `cities` VALUES ('303', '23', '晋城', '2', '0');
INSERT INTO `cities` VALUES ('304', '23', '晋中', '2', '0');
INSERT INTO `cities` VALUES ('305', '23', '临汾', '2', '0');
INSERT INTO `cities` VALUES ('306', '23', '吕梁', '2', '0');
INSERT INTO `cities` VALUES ('307', '23', '朔州', '2', '0');
INSERT INTO `cities` VALUES ('308', '23', '忻州', '2', '0');
INSERT INTO `cities` VALUES ('309', '23', '阳泉', '2', '0');
INSERT INTO `cities` VALUES ('310', '23', '运城', '2', '0');
INSERT INTO `cities` VALUES ('311', '24', '西安', '2', '0');
INSERT INTO `cities` VALUES ('312', '24', '安康', '2', '0');
INSERT INTO `cities` VALUES ('313', '24', '宝鸡', '2', '0');
INSERT INTO `cities` VALUES ('314', '24', '汉中', '2', '0');
INSERT INTO `cities` VALUES ('315', '24', '商洛', '2', '0');
INSERT INTO `cities` VALUES ('316', '24', '铜川', '2', '0');
INSERT INTO `cities` VALUES ('317', '24', '渭南', '2', '0');
INSERT INTO `cities` VALUES ('318', '24', '咸阳', '2', '0');
INSERT INTO `cities` VALUES ('319', '24', '延安', '2', '0');
INSERT INTO `cities` VALUES ('320', '24', '榆林', '2', '0');
INSERT INTO `cities` VALUES ('321', '25', '上海', '2', '0');
INSERT INTO `cities` VALUES ('322', '26', '成都', '2', '0');
INSERT INTO `cities` VALUES ('323', '26', '绵阳', '2', '0');
INSERT INTO `cities` VALUES ('324', '26', '阿坝', '2', '0');
INSERT INTO `cities` VALUES ('325', '26', '巴中', '2', '0');
INSERT INTO `cities` VALUES ('326', '26', '达州', '2', '0');
INSERT INTO `cities` VALUES ('327', '26', '德阳', '2', '0');
INSERT INTO `cities` VALUES ('328', '26', '甘孜', '2', '0');
INSERT INTO `cities` VALUES ('329', '26', '广安', '2', '0');
INSERT INTO `cities` VALUES ('330', '26', '广元', '2', '0');
INSERT INTO `cities` VALUES ('331', '26', '乐山', '2', '0');
INSERT INTO `cities` VALUES ('332', '26', '凉山', '2', '0');
INSERT INTO `cities` VALUES ('333', '26', '眉山', '2', '0');
INSERT INTO `cities` VALUES ('334', '26', '南充', '2', '0');
INSERT INTO `cities` VALUES ('335', '26', '内江', '2', '0');
INSERT INTO `cities` VALUES ('336', '26', '攀枝花', '2', '0');
INSERT INTO `cities` VALUES ('337', '26', '遂宁', '2', '0');
INSERT INTO `cities` VALUES ('338', '26', '雅安', '2', '0');
INSERT INTO `cities` VALUES ('339', '26', '宜宾', '2', '0');
INSERT INTO `cities` VALUES ('340', '26', '资阳', '2', '0');
INSERT INTO `cities` VALUES ('341', '26', '自贡', '2', '0');
INSERT INTO `cities` VALUES ('342', '26', '泸州', '2', '0');
INSERT INTO `cities` VALUES ('343', '27', '天津', '2', '0');
INSERT INTO `cities` VALUES ('344', '28', '拉萨', '2', '0');
INSERT INTO `cities` VALUES ('345', '28', '阿里', '2', '0');
INSERT INTO `cities` VALUES ('346', '28', '昌都', '2', '0');
INSERT INTO `cities` VALUES ('347', '28', '林芝', '2', '0');
INSERT INTO `cities` VALUES ('348', '28', '那曲', '2', '0');
INSERT INTO `cities` VALUES ('349', '28', '日喀则', '2', '0');
INSERT INTO `cities` VALUES ('350', '28', '山南', '2', '0');
INSERT INTO `cities` VALUES ('351', '29', '乌鲁木齐', '2', '0');
INSERT INTO `cities` VALUES ('352', '29', '阿克苏', '2', '0');
INSERT INTO `cities` VALUES ('353', '29', '阿拉尔', '2', '0');
INSERT INTO `cities` VALUES ('354', '29', '巴音郭楞', '2', '0');
INSERT INTO `cities` VALUES ('355', '29', '博尔塔拉', '2', '0');
INSERT INTO `cities` VALUES ('356', '29', '昌吉', '2', '0');
INSERT INTO `cities` VALUES ('357', '29', '哈密', '2', '0');
INSERT INTO `cities` VALUES ('358', '29', '和田', '2', '0');
INSERT INTO `cities` VALUES ('359', '29', '喀什', '2', '0');
INSERT INTO `cities` VALUES ('360', '29', '克拉玛依', '2', '0');
INSERT INTO `cities` VALUES ('361', '29', '克孜勒苏', '2', '0');
INSERT INTO `cities` VALUES ('362', '29', '石河子', '2', '0');
INSERT INTO `cities` VALUES ('363', '29', '图木舒克', '2', '0');
INSERT INTO `cities` VALUES ('364', '29', '吐鲁番', '2', '0');
INSERT INTO `cities` VALUES ('365', '29', '五家渠', '2', '0');
INSERT INTO `cities` VALUES ('366', '29', '伊犁', '2', '0');
INSERT INTO `cities` VALUES ('367', '30', '昆明', '2', '0');
INSERT INTO `cities` VALUES ('368', '30', '怒江', '2', '0');
INSERT INTO `cities` VALUES ('369', '30', '普洱', '2', '0');
INSERT INTO `cities` VALUES ('370', '30', '丽江', '2', '0');
INSERT INTO `cities` VALUES ('371', '30', '保山', '2', '0');
INSERT INTO `cities` VALUES ('372', '30', '楚雄', '2', '0');
INSERT INTO `cities` VALUES ('373', '30', '大理', '2', '0');
INSERT INTO `cities` VALUES ('374', '30', '德宏', '2', '0');
INSERT INTO `cities` VALUES ('375', '30', '迪庆', '2', '0');
INSERT INTO `cities` VALUES ('376', '30', '红河', '2', '0');
INSERT INTO `cities` VALUES ('377', '30', '临沧', '2', '0');
INSERT INTO `cities` VALUES ('378', '30', '曲靖', '2', '0');
INSERT INTO `cities` VALUES ('379', '30', '文山', '2', '0');
INSERT INTO `cities` VALUES ('380', '30', '西双版纳', '2', '0');
INSERT INTO `cities` VALUES ('381', '30', '玉溪', '2', '0');
INSERT INTO `cities` VALUES ('382', '30', '昭通', '2', '0');
INSERT INTO `cities` VALUES ('383', '31', '杭州', '2', '0');
INSERT INTO `cities` VALUES ('384', '31', '湖州', '2', '0');
INSERT INTO `cities` VALUES ('385', '31', '嘉兴', '2', '0');
INSERT INTO `cities` VALUES ('386', '31', '金华', '2', '0');
INSERT INTO `cities` VALUES ('387', '31', '丽水', '2', '0');
INSERT INTO `cities` VALUES ('388', '31', '宁波', '2', '0');
INSERT INTO `cities` VALUES ('389', '31', '绍兴', '2', '0');
INSERT INTO `cities` VALUES ('390', '31', '台州', '2', '0');
INSERT INTO `cities` VALUES ('391', '31', '温州', '2', '0');
INSERT INTO `cities` VALUES ('392', '31', '舟山', '2', '0');
INSERT INTO `cities` VALUES ('393', '31', '衢州', '2', '0');
INSERT INTO `cities` VALUES ('394', '32', '重庆', '2', '0');
INSERT INTO `cities` VALUES ('395', '33', '香港', '2', '0');
INSERT INTO `cities` VALUES ('396', '34', '澳门', '2', '0');
INSERT INTO `cities` VALUES ('397', '35', '台湾', '2', '0');
INSERT INTO `cities` VALUES ('398', '36', '迎江区', '3', '0');
INSERT INTO `cities` VALUES ('399', '36', '大观区', '3', '0');
INSERT INTO `cities` VALUES ('400', '36', '宜秀区', '3', '0');
INSERT INTO `cities` VALUES ('401', '36', '桐城市', '3', '0');
INSERT INTO `cities` VALUES ('402', '36', '怀宁县', '3', '0');
INSERT INTO `cities` VALUES ('403', '36', '枞阳县', '3', '0');
INSERT INTO `cities` VALUES ('404', '36', '潜山县', '3', '0');
INSERT INTO `cities` VALUES ('405', '36', '太湖县', '3', '0');
INSERT INTO `cities` VALUES ('406', '36', '宿松县', '3', '0');
INSERT INTO `cities` VALUES ('407', '36', '望江县', '3', '0');
INSERT INTO `cities` VALUES ('408', '36', '岳西县', '3', '0');
INSERT INTO `cities` VALUES ('409', '37', '中市区', '3', '0');
INSERT INTO `cities` VALUES ('410', '37', '东市区', '3', '0');
INSERT INTO `cities` VALUES ('411', '37', '西市区', '3', '0');
INSERT INTO `cities` VALUES ('412', '37', '郊区', '3', '0');
INSERT INTO `cities` VALUES ('413', '37', '怀远县', '3', '0');
INSERT INTO `cities` VALUES ('414', '37', '五河县', '3', '0');
INSERT INTO `cities` VALUES ('415', '37', '固镇县', '3', '0');
INSERT INTO `cities` VALUES ('416', '38', '居巢区', '3', '0');
INSERT INTO `cities` VALUES ('417', '38', '庐江县', '3', '0');
INSERT INTO `cities` VALUES ('418', '38', '无为县', '3', '0');
INSERT INTO `cities` VALUES ('419', '38', '含山县', '3', '0');
INSERT INTO `cities` VALUES ('420', '38', '和县', '3', '0');
INSERT INTO `cities` VALUES ('421', '39', '贵池区', '3', '0');
INSERT INTO `cities` VALUES ('422', '39', '东至县', '3', '0');
INSERT INTO `cities` VALUES ('423', '39', '石台县', '3', '0');
INSERT INTO `cities` VALUES ('424', '39', '青阳县', '3', '0');
INSERT INTO `cities` VALUES ('425', '40', '琅琊区', '3', '0');
INSERT INTO `cities` VALUES ('426', '40', '南谯区', '3', '0');
INSERT INTO `cities` VALUES ('427', '40', '天长市', '3', '0');
INSERT INTO `cities` VALUES ('428', '40', '明光市', '3', '0');
INSERT INTO `cities` VALUES ('429', '40', '来安县', '3', '0');
INSERT INTO `cities` VALUES ('430', '40', '全椒县', '3', '0');
INSERT INTO `cities` VALUES ('431', '40', '定远县', '3', '0');
INSERT INTO `cities` VALUES ('432', '40', '凤阳县', '3', '0');
INSERT INTO `cities` VALUES ('433', '41', '蚌山区', '3', '0');
INSERT INTO `cities` VALUES ('434', '41', '龙子湖区', '3', '0');
INSERT INTO `cities` VALUES ('435', '41', '禹会区', '3', '0');
INSERT INTO `cities` VALUES ('436', '41', '淮上区', '3', '0');
INSERT INTO `cities` VALUES ('437', '41', '颍州区', '3', '0');
INSERT INTO `cities` VALUES ('438', '41', '颍东区', '3', '0');
INSERT INTO `cities` VALUES ('439', '41', '颍泉区', '3', '0');
INSERT INTO `cities` VALUES ('440', '41', '界首市', '3', '0');
INSERT INTO `cities` VALUES ('441', '41', '临泉县', '3', '0');
INSERT INTO `cities` VALUES ('442', '41', '太和县', '3', '0');
INSERT INTO `cities` VALUES ('443', '41', '阜南县', '3', '0');
INSERT INTO `cities` VALUES ('444', '41', '颖上县', '3', '0');
INSERT INTO `cities` VALUES ('445', '42', '相山区', '3', '0');
INSERT INTO `cities` VALUES ('446', '42', '杜集区', '3', '0');
INSERT INTO `cities` VALUES ('447', '42', '烈山区', '3', '0');
INSERT INTO `cities` VALUES ('448', '42', '濉溪县', '3', '0');
INSERT INTO `cities` VALUES ('449', '43', '田家庵区', '3', '0');
INSERT INTO `cities` VALUES ('450', '43', '大通区', '3', '0');
INSERT INTO `cities` VALUES ('451', '43', '谢家集区', '3', '0');
INSERT INTO `cities` VALUES ('452', '43', '八公山区', '3', '0');
INSERT INTO `cities` VALUES ('453', '43', '潘集区', '3', '0');
INSERT INTO `cities` VALUES ('454', '43', '凤台县', '3', '0');
INSERT INTO `cities` VALUES ('455', '44', '屯溪区', '3', '0');
INSERT INTO `cities` VALUES ('456', '44', '黄山区', '3', '0');
INSERT INTO `cities` VALUES ('457', '44', '徽州区', '3', '0');
INSERT INTO `cities` VALUES ('458', '44', '歙县', '3', '0');
INSERT INTO `cities` VALUES ('459', '44', '休宁县', '3', '0');
INSERT INTO `cities` VALUES ('460', '44', '黟县', '3', '0');
INSERT INTO `cities` VALUES ('461', '44', '祁门县', '3', '0');
INSERT INTO `cities` VALUES ('462', '45', '金安区', '3', '0');
INSERT INTO `cities` VALUES ('463', '45', '裕安区', '3', '0');
INSERT INTO `cities` VALUES ('464', '45', '寿县', '3', '0');
INSERT INTO `cities` VALUES ('465', '45', '霍邱县', '3', '0');
INSERT INTO `cities` VALUES ('466', '45', '舒城县', '3', '0');
INSERT INTO `cities` VALUES ('467', '45', '金寨县', '3', '0');
INSERT INTO `cities` VALUES ('468', '45', '霍山县', '3', '0');
INSERT INTO `cities` VALUES ('469', '46', '雨山区', '3', '0');
INSERT INTO `cities` VALUES ('470', '46', '花山区', '3', '0');
INSERT INTO `cities` VALUES ('471', '46', '金家庄区', '3', '0');
INSERT INTO `cities` VALUES ('472', '46', '当涂县', '3', '0');
INSERT INTO `cities` VALUES ('473', '47', '埇桥区', '3', '0');
INSERT INTO `cities` VALUES ('474', '47', '砀山县', '3', '0');
INSERT INTO `cities` VALUES ('475', '47', '萧县', '3', '0');
INSERT INTO `cities` VALUES ('476', '47', '灵璧县', '3', '0');
INSERT INTO `cities` VALUES ('477', '47', '泗县', '3', '0');
INSERT INTO `cities` VALUES ('478', '48', '铜官山区', '3', '0');
INSERT INTO `cities` VALUES ('479', '48', '狮子山区', '3', '0');
INSERT INTO `cities` VALUES ('480', '48', '郊区', '3', '0');
INSERT INTO `cities` VALUES ('481', '48', '铜陵县', '3', '0');
INSERT INTO `cities` VALUES ('482', '49', '镜湖区', '3', '0');
INSERT INTO `cities` VALUES ('483', '49', '弋江区', '3', '0');
INSERT INTO `cities` VALUES ('484', '49', '鸠江区', '3', '0');
INSERT INTO `cities` VALUES ('485', '49', '三山区', '3', '0');
INSERT INTO `cities` VALUES ('486', '49', '芜湖县', '3', '0');
INSERT INTO `cities` VALUES ('487', '49', '繁昌县', '3', '0');
INSERT INTO `cities` VALUES ('488', '49', '南陵县', '3', '0');
INSERT INTO `cities` VALUES ('489', '50', '宣州区', '3', '0');
INSERT INTO `cities` VALUES ('490', '50', '宁国市', '3', '0');
INSERT INTO `cities` VALUES ('491', '50', '郎溪县', '3', '0');
INSERT INTO `cities` VALUES ('492', '50', '广德县', '3', '0');
INSERT INTO `cities` VALUES ('493', '50', '泾县', '3', '0');
INSERT INTO `cities` VALUES ('494', '50', '绩溪县', '3', '0');
INSERT INTO `cities` VALUES ('495', '50', '旌德县', '3', '0');
INSERT INTO `cities` VALUES ('496', '51', '涡阳县', '3', '0');
INSERT INTO `cities` VALUES ('497', '51', '蒙城县', '3', '0');
INSERT INTO `cities` VALUES ('498', '51', '利辛县', '3', '0');
INSERT INTO `cities` VALUES ('499', '51', '谯城区', '3', '0');
INSERT INTO `cities` VALUES ('500', '52', '东城区', '3', '0');
INSERT INTO `cities` VALUES ('501', '52', '西城区', '3', '0');
INSERT INTO `cities` VALUES ('502', '52', '海淀区', '3', '0');
INSERT INTO `cities` VALUES ('503', '52', '朝阳区', '3', '0');
INSERT INTO `cities` VALUES ('504', '52', '崇文区', '3', '0');
INSERT INTO `cities` VALUES ('505', '52', '宣武区', '3', '0');
INSERT INTO `cities` VALUES ('506', '52', '丰台区', '3', '0');
INSERT INTO `cities` VALUES ('507', '52', '石景山区', '3', '0');
INSERT INTO `cities` VALUES ('508', '52', '房山区', '3', '0');
INSERT INTO `cities` VALUES ('509', '52', '门头沟区', '3', '0');
INSERT INTO `cities` VALUES ('510', '52', '通州区', '3', '0');
INSERT INTO `cities` VALUES ('511', '52', '顺义区', '3', '0');
INSERT INTO `cities` VALUES ('512', '52', '昌平区', '3', '0');
INSERT INTO `cities` VALUES ('513', '52', '怀柔区', '3', '0');
INSERT INTO `cities` VALUES ('514', '52', '平谷区', '3', '0');
INSERT INTO `cities` VALUES ('515', '52', '大兴区', '3', '0');
INSERT INTO `cities` VALUES ('518', '53', '鼓楼区', '3', '0');
INSERT INTO `cities` VALUES ('519', '53', '台江区', '3', '0');
INSERT INTO `cities` VALUES ('520', '53', '仓山区', '3', '0');
INSERT INTO `cities` VALUES ('521', '53', '马尾区', '3', '0');
INSERT INTO `cities` VALUES ('522', '53', '晋安区', '3', '0');
INSERT INTO `cities` VALUES ('523', '53', '福清市', '3', '0');
INSERT INTO `cities` VALUES ('524', '53', '长乐市', '3', '0');
INSERT INTO `cities` VALUES ('525', '53', '闽侯县', '3', '0');
INSERT INTO `cities` VALUES ('526', '53', '连江县', '3', '0');
INSERT INTO `cities` VALUES ('527', '53', '罗源县', '3', '0');
INSERT INTO `cities` VALUES ('528', '53', '闽清县', '3', '0');
INSERT INTO `cities` VALUES ('529', '53', '永泰县', '3', '0');
INSERT INTO `cities` VALUES ('530', '53', '平潭县', '3', '0');
INSERT INTO `cities` VALUES ('531', '54', '新罗区', '3', '0');
INSERT INTO `cities` VALUES ('532', '54', '漳平市', '3', '0');
INSERT INTO `cities` VALUES ('533', '54', '长汀县', '3', '0');
INSERT INTO `cities` VALUES ('534', '54', '永定县', '3', '0');
INSERT INTO `cities` VALUES ('535', '54', '上杭县', '3', '0');
INSERT INTO `cities` VALUES ('536', '54', '武平县', '3', '0');
INSERT INTO `cities` VALUES ('537', '54', '连城县', '3', '0');
INSERT INTO `cities` VALUES ('538', '55', '延平区', '3', '0');
INSERT INTO `cities` VALUES ('539', '55', '邵武市', '3', '0');
INSERT INTO `cities` VALUES ('540', '55', '武夷山市', '3', '0');
INSERT INTO `cities` VALUES ('541', '55', '建瓯市', '3', '0');
INSERT INTO `cities` VALUES ('542', '55', '建阳市', '3', '0');
INSERT INTO `cities` VALUES ('543', '55', '顺昌县', '3', '0');
INSERT INTO `cities` VALUES ('544', '55', '浦城县', '3', '0');
INSERT INTO `cities` VALUES ('545', '55', '光泽县', '3', '0');
INSERT INTO `cities` VALUES ('546', '55', '松溪县', '3', '0');
INSERT INTO `cities` VALUES ('547', '55', '政和县', '3', '0');
INSERT INTO `cities` VALUES ('548', '56', '蕉城区', '3', '0');
INSERT INTO `cities` VALUES ('549', '56', '福安市', '3', '0');
INSERT INTO `cities` VALUES ('550', '56', '福鼎市', '3', '0');
INSERT INTO `cities` VALUES ('551', '56', '霞浦县', '3', '0');
INSERT INTO `cities` VALUES ('552', '56', '古田县', '3', '0');
INSERT INTO `cities` VALUES ('553', '56', '屏南县', '3', '0');
INSERT INTO `cities` VALUES ('554', '56', '寿宁县', '3', '0');
INSERT INTO `cities` VALUES ('555', '56', '周宁县', '3', '0');
INSERT INTO `cities` VALUES ('556', '56', '柘荣县', '3', '0');
INSERT INTO `cities` VALUES ('557', '57', '城厢区', '3', '0');
INSERT INTO `cities` VALUES ('558', '57', '涵江区', '3', '0');
INSERT INTO `cities` VALUES ('559', '57', '荔城区', '3', '0');
INSERT INTO `cities` VALUES ('560', '57', '秀屿区', '3', '0');
INSERT INTO `cities` VALUES ('561', '57', '仙游县', '3', '0');
INSERT INTO `cities` VALUES ('562', '58', '鲤城区', '3', '0');
INSERT INTO `cities` VALUES ('563', '58', '丰泽区', '3', '0');
INSERT INTO `cities` VALUES ('564', '58', '洛江区', '3', '0');
INSERT INTO `cities` VALUES ('565', '58', '清濛开发区', '3', '0');
INSERT INTO `cities` VALUES ('566', '58', '泉港区', '3', '0');
INSERT INTO `cities` VALUES ('567', '58', '石狮市', '3', '0');
INSERT INTO `cities` VALUES ('568', '58', '晋江市', '3', '0');
INSERT INTO `cities` VALUES ('569', '58', '南安市', '3', '0');
INSERT INTO `cities` VALUES ('570', '58', '惠安县', '3', '0');
INSERT INTO `cities` VALUES ('571', '58', '安溪县', '3', '0');
INSERT INTO `cities` VALUES ('572', '58', '永春县', '3', '0');
INSERT INTO `cities` VALUES ('573', '58', '德化县', '3', '0');
INSERT INTO `cities` VALUES ('574', '58', '金门县', '3', '0');
INSERT INTO `cities` VALUES ('575', '59', '梅列区', '3', '0');
INSERT INTO `cities` VALUES ('576', '59', '三元区', '3', '0');
INSERT INTO `cities` VALUES ('577', '59', '永安市', '3', '0');
INSERT INTO `cities` VALUES ('578', '59', '明溪县', '3', '0');
INSERT INTO `cities` VALUES ('579', '59', '清流县', '3', '0');
INSERT INTO `cities` VALUES ('580', '59', '宁化县', '3', '0');
INSERT INTO `cities` VALUES ('581', '59', '大田县', '3', '0');
INSERT INTO `cities` VALUES ('582', '59', '尤溪县', '3', '0');
INSERT INTO `cities` VALUES ('583', '59', '沙县', '3', '0');
INSERT INTO `cities` VALUES ('584', '59', '将乐县', '3', '0');
INSERT INTO `cities` VALUES ('585', '59', '泰宁县', '3', '0');
INSERT INTO `cities` VALUES ('586', '59', '建宁县', '3', '0');
INSERT INTO `cities` VALUES ('587', '60', '思明区', '3', '0');
INSERT INTO `cities` VALUES ('588', '60', '海沧区', '3', '0');
INSERT INTO `cities` VALUES ('589', '60', '湖里区', '3', '0');
INSERT INTO `cities` VALUES ('590', '60', '集美区', '3', '0');
INSERT INTO `cities` VALUES ('591', '60', '同安区', '3', '0');
INSERT INTO `cities` VALUES ('592', '60', '翔安区', '3', '0');
INSERT INTO `cities` VALUES ('593', '61', '芗城区', '3', '0');
INSERT INTO `cities` VALUES ('594', '61', '龙文区', '3', '0');
INSERT INTO `cities` VALUES ('595', '61', '龙海市', '3', '0');
INSERT INTO `cities` VALUES ('596', '61', '云霄县', '3', '0');
INSERT INTO `cities` VALUES ('597', '61', '漳浦县', '3', '0');
INSERT INTO `cities` VALUES ('598', '61', '诏安县', '3', '0');
INSERT INTO `cities` VALUES ('599', '61', '长泰县', '3', '0');
INSERT INTO `cities` VALUES ('600', '61', '东山县', '3', '0');
INSERT INTO `cities` VALUES ('601', '61', '南靖县', '3', '0');
INSERT INTO `cities` VALUES ('602', '61', '平和县', '3', '0');
INSERT INTO `cities` VALUES ('603', '61', '华安县', '3', '0');
INSERT INTO `cities` VALUES ('604', '62', '皋兰县', '3', '0');
INSERT INTO `cities` VALUES ('605', '62', '城关区', '3', '0');
INSERT INTO `cities` VALUES ('606', '62', '七里河区', '3', '0');
INSERT INTO `cities` VALUES ('607', '62', '西固区', '3', '0');
INSERT INTO `cities` VALUES ('608', '62', '安宁区', '3', '0');
INSERT INTO `cities` VALUES ('609', '62', '红古区', '3', '0');
INSERT INTO `cities` VALUES ('610', '62', '永登县', '3', '0');
INSERT INTO `cities` VALUES ('611', '62', '榆中县', '3', '0');
INSERT INTO `cities` VALUES ('612', '63', '白银区', '3', '0');
INSERT INTO `cities` VALUES ('613', '63', '平川区', '3', '0');
INSERT INTO `cities` VALUES ('614', '63', '会宁县', '3', '0');
INSERT INTO `cities` VALUES ('615', '63', '景泰县', '3', '0');
INSERT INTO `cities` VALUES ('616', '63', '靖远县', '3', '0');
INSERT INTO `cities` VALUES ('617', '64', '临洮县', '3', '0');
INSERT INTO `cities` VALUES ('618', '64', '陇西县', '3', '0');
INSERT INTO `cities` VALUES ('619', '64', '通渭县', '3', '0');
INSERT INTO `cities` VALUES ('620', '64', '渭源县', '3', '0');
INSERT INTO `cities` VALUES ('621', '64', '漳县', '3', '0');
INSERT INTO `cities` VALUES ('622', '64', '岷县', '3', '0');
INSERT INTO `cities` VALUES ('623', '64', '安定区', '3', '0');
INSERT INTO `cities` VALUES ('624', '64', '安定区', '3', '0');
INSERT INTO `cities` VALUES ('625', '65', '合作市', '3', '0');
INSERT INTO `cities` VALUES ('626', '65', '临潭县', '3', '0');
INSERT INTO `cities` VALUES ('627', '65', '卓尼县', '3', '0');
INSERT INTO `cities` VALUES ('628', '65', '舟曲县', '3', '0');
INSERT INTO `cities` VALUES ('629', '65', '迭部县', '3', '0');
INSERT INTO `cities` VALUES ('630', '65', '玛曲县', '3', '0');
INSERT INTO `cities` VALUES ('631', '65', '碌曲县', '3', '0');
INSERT INTO `cities` VALUES ('632', '65', '夏河县', '3', '0');
INSERT INTO `cities` VALUES ('633', '66', '嘉峪关市', '3', '0');
INSERT INTO `cities` VALUES ('634', '67', '金川区', '3', '0');
INSERT INTO `cities` VALUES ('635', '67', '永昌县', '3', '0');
INSERT INTO `cities` VALUES ('636', '68', '肃州区', '3', '0');
INSERT INTO `cities` VALUES ('637', '68', '玉门市', '3', '0');
INSERT INTO `cities` VALUES ('638', '68', '敦煌市', '3', '0');
INSERT INTO `cities` VALUES ('639', '68', '金塔县', '3', '0');
INSERT INTO `cities` VALUES ('640', '68', '瓜州县', '3', '0');
INSERT INTO `cities` VALUES ('641', '68', '肃北', '3', '0');
INSERT INTO `cities` VALUES ('642', '68', '阿克塞', '3', '0');
INSERT INTO `cities` VALUES ('643', '69', '临夏市', '3', '0');
INSERT INTO `cities` VALUES ('644', '69', '临夏县', '3', '0');
INSERT INTO `cities` VALUES ('645', '69', '康乐县', '3', '0');
INSERT INTO `cities` VALUES ('646', '69', '永靖县', '3', '0');
INSERT INTO `cities` VALUES ('647', '69', '广河县', '3', '0');
INSERT INTO `cities` VALUES ('648', '69', '和政县', '3', '0');
INSERT INTO `cities` VALUES ('649', '69', '东乡族自治县', '3', '0');
INSERT INTO `cities` VALUES ('650', '69', '积石山', '3', '0');
INSERT INTO `cities` VALUES ('651', '70', '成县', '3', '0');
INSERT INTO `cities` VALUES ('652', '70', '徽县', '3', '0');
INSERT INTO `cities` VALUES ('653', '70', '康县', '3', '0');
INSERT INTO `cities` VALUES ('654', '70', '礼县', '3', '0');
INSERT INTO `cities` VALUES ('655', '70', '两当县', '3', '0');
INSERT INTO `cities` VALUES ('656', '70', '文县', '3', '0');
INSERT INTO `cities` VALUES ('657', '70', '西和县', '3', '0');
INSERT INTO `cities` VALUES ('658', '70', '宕昌县', '3', '0');
INSERT INTO `cities` VALUES ('659', '70', '武都区', '3', '0');
INSERT INTO `cities` VALUES ('660', '71', '崇信县', '3', '0');
INSERT INTO `cities` VALUES ('661', '71', '华亭县', '3', '0');
INSERT INTO `cities` VALUES ('662', '71', '静宁县', '3', '0');
INSERT INTO `cities` VALUES ('663', '71', '灵台县', '3', '0');
INSERT INTO `cities` VALUES ('664', '71', '崆峒区', '3', '0');
INSERT INTO `cities` VALUES ('665', '71', '庄浪县', '3', '0');
INSERT INTO `cities` VALUES ('666', '71', '泾川县', '3', '0');
INSERT INTO `cities` VALUES ('667', '72', '合水县', '3', '0');
INSERT INTO `cities` VALUES ('668', '72', '华池县', '3', '0');
INSERT INTO `cities` VALUES ('669', '72', '环县', '3', '0');
INSERT INTO `cities` VALUES ('670', '72', '宁县', '3', '0');
INSERT INTO `cities` VALUES ('671', '72', '庆城县', '3', '0');
INSERT INTO `cities` VALUES ('672', '72', '西峰区', '3', '0');
INSERT INTO `cities` VALUES ('673', '72', '镇原县', '3', '0');
INSERT INTO `cities` VALUES ('674', '72', '正宁县', '3', '0');
INSERT INTO `cities` VALUES ('675', '73', '甘谷县', '3', '0');
INSERT INTO `cities` VALUES ('676', '73', '秦安县', '3', '0');
INSERT INTO `cities` VALUES ('677', '73', '清水县', '3', '0');
INSERT INTO `cities` VALUES ('678', '73', '秦州区', '3', '0');
INSERT INTO `cities` VALUES ('679', '73', '麦积区', '3', '0');
INSERT INTO `cities` VALUES ('680', '73', '武山县', '3', '0');
INSERT INTO `cities` VALUES ('681', '73', '张家川', '3', '0');
INSERT INTO `cities` VALUES ('682', '74', '古浪县', '3', '0');
INSERT INTO `cities` VALUES ('683', '74', '民勤县', '3', '0');
INSERT INTO `cities` VALUES ('684', '74', '天祝', '3', '0');
INSERT INTO `cities` VALUES ('685', '74', '凉州区', '3', '0');
INSERT INTO `cities` VALUES ('686', '75', '高台县', '3', '0');
INSERT INTO `cities` VALUES ('687', '75', '临泽县', '3', '0');
INSERT INTO `cities` VALUES ('688', '75', '民乐县', '3', '0');
INSERT INTO `cities` VALUES ('689', '75', '山丹县', '3', '0');
INSERT INTO `cities` VALUES ('690', '75', '肃南', '3', '0');
INSERT INTO `cities` VALUES ('691', '75', '甘州区', '3', '0');
INSERT INTO `cities` VALUES ('692', '76', '从化市', '3', '0');
INSERT INTO `cities` VALUES ('693', '76', '天河区', '3', '0');
INSERT INTO `cities` VALUES ('694', '76', '东山区', '3', '0');
INSERT INTO `cities` VALUES ('695', '76', '白云区', '3', '0');
INSERT INTO `cities` VALUES ('696', '76', '海珠区', '3', '0');
INSERT INTO `cities` VALUES ('697', '76', '荔湾区', '3', '0');
INSERT INTO `cities` VALUES ('698', '76', '越秀区', '3', '0');
INSERT INTO `cities` VALUES ('699', '76', '黄埔区', '3', '0');
INSERT INTO `cities` VALUES ('700', '76', '番禺区', '3', '0');
INSERT INTO `cities` VALUES ('701', '76', '花都区', '3', '0');
INSERT INTO `cities` VALUES ('702', '76', '增城区', '3', '0');
INSERT INTO `cities` VALUES ('703', '76', '从化区', '3', '0');
INSERT INTO `cities` VALUES ('704', '76', '市郊', '3', '0');
INSERT INTO `cities` VALUES ('705', '77', '福田区', '3', '0');
INSERT INTO `cities` VALUES ('706', '77', '罗湖区', '3', '0');
INSERT INTO `cities` VALUES ('707', '77', '南山区', '3', '0');
INSERT INTO `cities` VALUES ('708', '77', '宝安区', '3', '0');
INSERT INTO `cities` VALUES ('709', '77', '龙岗区', '3', '0');
INSERT INTO `cities` VALUES ('710', '77', '盐田区', '3', '0');
INSERT INTO `cities` VALUES ('711', '78', '湘桥区', '3', '0');
INSERT INTO `cities` VALUES ('712', '78', '潮安县', '3', '0');
INSERT INTO `cities` VALUES ('713', '78', '饶平县', '3', '0');
INSERT INTO `cities` VALUES ('714', '79', '南城区', '3', '0');
INSERT INTO `cities` VALUES ('715', '79', '东城区', '3', '0');
INSERT INTO `cities` VALUES ('716', '79', '万江区', '3', '0');
INSERT INTO `cities` VALUES ('717', '79', '莞城区', '3', '0');
INSERT INTO `cities` VALUES ('718', '79', '石龙镇', '3', '0');
INSERT INTO `cities` VALUES ('719', '79', '虎门镇', '3', '0');
INSERT INTO `cities` VALUES ('720', '79', '麻涌镇', '3', '0');
INSERT INTO `cities` VALUES ('721', '79', '道滘镇', '3', '0');
INSERT INTO `cities` VALUES ('722', '79', '石碣镇', '3', '0');
INSERT INTO `cities` VALUES ('723', '79', '沙田镇', '3', '0');
INSERT INTO `cities` VALUES ('724', '79', '望牛墩镇', '3', '0');
INSERT INTO `cities` VALUES ('725', '79', '洪梅镇', '3', '0');
INSERT INTO `cities` VALUES ('726', '79', '茶山镇', '3', '0');
INSERT INTO `cities` VALUES ('727', '79', '寮步镇', '3', '0');
INSERT INTO `cities` VALUES ('728', '79', '大岭山镇', '3', '0');
INSERT INTO `cities` VALUES ('729', '79', '大朗镇', '3', '0');
INSERT INTO `cities` VALUES ('730', '79', '黄江镇', '3', '0');
INSERT INTO `cities` VALUES ('731', '79', '樟木头', '3', '0');
INSERT INTO `cities` VALUES ('732', '79', '凤岗镇', '3', '0');
INSERT INTO `cities` VALUES ('733', '79', '塘厦镇', '3', '0');
INSERT INTO `cities` VALUES ('734', '79', '谢岗镇', '3', '0');
INSERT INTO `cities` VALUES ('735', '79', '厚街镇', '3', '0');
INSERT INTO `cities` VALUES ('736', '79', '清溪镇', '3', '0');
INSERT INTO `cities` VALUES ('737', '79', '常平镇', '3', '0');
INSERT INTO `cities` VALUES ('738', '79', '桥头镇', '3', '0');
INSERT INTO `cities` VALUES ('739', '79', '横沥镇', '3', '0');
INSERT INTO `cities` VALUES ('740', '79', '东坑镇', '3', '0');
INSERT INTO `cities` VALUES ('741', '79', '企石镇', '3', '0');
INSERT INTO `cities` VALUES ('742', '79', '石排镇', '3', '0');
INSERT INTO `cities` VALUES ('743', '79', '长安镇', '3', '0');
INSERT INTO `cities` VALUES ('744', '79', '中堂镇', '3', '0');
INSERT INTO `cities` VALUES ('745', '79', '高埗镇', '3', '0');
INSERT INTO `cities` VALUES ('746', '80', '禅城区', '3', '0');
INSERT INTO `cities` VALUES ('747', '80', '南海区', '3', '0');
INSERT INTO `cities` VALUES ('748', '80', '顺德区', '3', '0');
INSERT INTO `cities` VALUES ('749', '80', '三水区', '3', '0');
INSERT INTO `cities` VALUES ('750', '80', '高明区', '3', '0');
INSERT INTO `cities` VALUES ('751', '81', '东源县', '3', '0');
INSERT INTO `cities` VALUES ('752', '81', '和平县', '3', '0');
INSERT INTO `cities` VALUES ('753', '81', '源城区', '3', '0');
INSERT INTO `cities` VALUES ('754', '81', '连平县', '3', '0');
INSERT INTO `cities` VALUES ('755', '81', '龙川县', '3', '0');
INSERT INTO `cities` VALUES ('756', '81', '紫金县', '3', '0');
INSERT INTO `cities` VALUES ('757', '82', '惠阳区', '3', '0');
INSERT INTO `cities` VALUES ('758', '82', '惠城区', '3', '0');
INSERT INTO `cities` VALUES ('759', '82', '大亚湾', '3', '0');
INSERT INTO `cities` VALUES ('760', '82', '博罗县', '3', '0');
INSERT INTO `cities` VALUES ('761', '82', '惠东县', '3', '0');
INSERT INTO `cities` VALUES ('762', '82', '龙门县', '3', '0');
INSERT INTO `cities` VALUES ('763', '83', '江海区', '3', '0');
INSERT INTO `cities` VALUES ('764', '83', '蓬江区', '3', '0');
INSERT INTO `cities` VALUES ('765', '83', '新会区', '3', '0');
INSERT INTO `cities` VALUES ('766', '83', '台山市', '3', '0');
INSERT INTO `cities` VALUES ('767', '83', '开平市', '3', '0');
INSERT INTO `cities` VALUES ('768', '83', '鹤山市', '3', '0');
INSERT INTO `cities` VALUES ('769', '83', '恩平市', '3', '0');
INSERT INTO `cities` VALUES ('770', '84', '榕城区', '3', '0');
INSERT INTO `cities` VALUES ('771', '84', '普宁市', '3', '0');
INSERT INTO `cities` VALUES ('772', '84', '揭东县', '3', '0');
INSERT INTO `cities` VALUES ('773', '84', '揭西县', '3', '0');
INSERT INTO `cities` VALUES ('774', '84', '惠来县', '3', '0');
INSERT INTO `cities` VALUES ('775', '85', '茂南区', '3', '0');
INSERT INTO `cities` VALUES ('776', '85', '茂港区', '3', '0');
INSERT INTO `cities` VALUES ('777', '85', '高州市', '3', '0');
INSERT INTO `cities` VALUES ('778', '85', '化州市', '3', '0');
INSERT INTO `cities` VALUES ('779', '85', '信宜市', '3', '0');
INSERT INTO `cities` VALUES ('780', '85', '电白县', '3', '0');
INSERT INTO `cities` VALUES ('781', '86', '梅县', '3', '0');
INSERT INTO `cities` VALUES ('782', '86', '梅江区', '3', '0');
INSERT INTO `cities` VALUES ('783', '86', '兴宁市', '3', '0');
INSERT INTO `cities` VALUES ('784', '86', '大埔县', '3', '0');
INSERT INTO `cities` VALUES ('785', '86', '丰顺县', '3', '0');
INSERT INTO `cities` VALUES ('786', '86', '五华县', '3', '0');
INSERT INTO `cities` VALUES ('787', '86', '平远县', '3', '0');
INSERT INTO `cities` VALUES ('788', '86', '蕉岭县', '3', '0');
INSERT INTO `cities` VALUES ('789', '87', '清城区', '3', '0');
INSERT INTO `cities` VALUES ('790', '87', '英德市', '3', '0');
INSERT INTO `cities` VALUES ('791', '87', '连州市', '3', '0');
INSERT INTO `cities` VALUES ('792', '87', '佛冈县', '3', '0');
INSERT INTO `cities` VALUES ('793', '87', '阳山县', '3', '0');
INSERT INTO `cities` VALUES ('794', '87', '清新县', '3', '0');
INSERT INTO `cities` VALUES ('795', '87', '连山', '3', '0');
INSERT INTO `cities` VALUES ('796', '87', '连南', '3', '0');
INSERT INTO `cities` VALUES ('797', '88', '南澳县', '3', '0');
INSERT INTO `cities` VALUES ('798', '88', '潮阳区', '3', '0');
INSERT INTO `cities` VALUES ('799', '88', '澄海区', '3', '0');
INSERT INTO `cities` VALUES ('800', '88', '龙湖区', '3', '0');
INSERT INTO `cities` VALUES ('801', '88', '金平区', '3', '0');
INSERT INTO `cities` VALUES ('802', '88', '濠江区', '3', '0');
INSERT INTO `cities` VALUES ('803', '88', '潮南区', '3', '0');
INSERT INTO `cities` VALUES ('804', '89', '城区', '3', '0');
INSERT INTO `cities` VALUES ('805', '89', '陆丰市', '3', '0');
INSERT INTO `cities` VALUES ('806', '89', '海丰县', '3', '0');
INSERT INTO `cities` VALUES ('807', '89', '陆河县', '3', '0');
INSERT INTO `cities` VALUES ('808', '90', '曲江县', '3', '0');
INSERT INTO `cities` VALUES ('809', '90', '浈江区', '3', '0');
INSERT INTO `cities` VALUES ('810', '90', '武江区', '3', '0');
INSERT INTO `cities` VALUES ('811', '90', '曲江区', '3', '0');
INSERT INTO `cities` VALUES ('812', '90', '乐昌市', '3', '0');
INSERT INTO `cities` VALUES ('813', '90', '南雄市', '3', '0');
INSERT INTO `cities` VALUES ('814', '90', '始兴县', '3', '0');
INSERT INTO `cities` VALUES ('815', '90', '仁化县', '3', '0');
INSERT INTO `cities` VALUES ('816', '90', '翁源县', '3', '0');
INSERT INTO `cities` VALUES ('817', '90', '新丰县', '3', '0');
INSERT INTO `cities` VALUES ('818', '90', '乳源', '3', '0');
INSERT INTO `cities` VALUES ('819', '91', '江城区', '3', '0');
INSERT INTO `cities` VALUES ('820', '91', '阳春市', '3', '0');
INSERT INTO `cities` VALUES ('821', '91', '阳西县', '3', '0');
INSERT INTO `cities` VALUES ('822', '91', '阳东县', '3', '0');
INSERT INTO `cities` VALUES ('823', '92', '云城区', '3', '0');
INSERT INTO `cities` VALUES ('824', '92', '罗定市', '3', '0');
INSERT INTO `cities` VALUES ('825', '92', '新兴县', '3', '0');
INSERT INTO `cities` VALUES ('826', '92', '郁南县', '3', '0');
INSERT INTO `cities` VALUES ('827', '92', '云安县', '3', '0');
INSERT INTO `cities` VALUES ('828', '93', '赤坎区', '3', '0');
INSERT INTO `cities` VALUES ('829', '93', '霞山区', '3', '0');
INSERT INTO `cities` VALUES ('830', '93', '坡头区', '3', '0');
INSERT INTO `cities` VALUES ('831', '93', '麻章区', '3', '0');
INSERT INTO `cities` VALUES ('832', '93', '廉江市', '3', '0');
INSERT INTO `cities` VALUES ('833', '93', '雷州市', '3', '0');
INSERT INTO `cities` VALUES ('834', '93', '吴川市', '3', '0');
INSERT INTO `cities` VALUES ('835', '93', '遂溪县', '3', '0');
INSERT INTO `cities` VALUES ('836', '93', '徐闻县', '3', '0');
INSERT INTO `cities` VALUES ('837', '94', '肇庆市', '3', '0');
INSERT INTO `cities` VALUES ('838', '94', '高要市', '3', '0');
INSERT INTO `cities` VALUES ('839', '94', '四会市', '3', '0');
INSERT INTO `cities` VALUES ('840', '94', '广宁县', '3', '0');
INSERT INTO `cities` VALUES ('841', '94', '怀集县', '3', '0');
INSERT INTO `cities` VALUES ('842', '94', '封开县', '3', '0');
INSERT INTO `cities` VALUES ('843', '94', '德庆县', '3', '0');
INSERT INTO `cities` VALUES ('844', '95', '石岐街道', '3', '0');
INSERT INTO `cities` VALUES ('845', '95', '东区街道', '3', '0');
INSERT INTO `cities` VALUES ('846', '95', '西区街道', '3', '0');
INSERT INTO `cities` VALUES ('847', '95', '环城街道', '3', '0');
INSERT INTO `cities` VALUES ('848', '95', '中山港街道', '3', '0');
INSERT INTO `cities` VALUES ('849', '95', '五桂山街道', '3', '0');
INSERT INTO `cities` VALUES ('850', '96', '香洲区', '3', '0');
INSERT INTO `cities` VALUES ('851', '96', '斗门区', '3', '0');
INSERT INTO `cities` VALUES ('852', '96', '金湾区', '3', '0');
INSERT INTO `cities` VALUES ('853', '97', '邕宁区', '3', '0');
INSERT INTO `cities` VALUES ('854', '97', '青秀区', '3', '0');
INSERT INTO `cities` VALUES ('855', '97', '兴宁区', '3', '0');
INSERT INTO `cities` VALUES ('856', '97', '良庆区', '3', '0');
INSERT INTO `cities` VALUES ('857', '97', '西乡塘区', '3', '0');
INSERT INTO `cities` VALUES ('858', '97', '江南区', '3', '0');
INSERT INTO `cities` VALUES ('859', '97', '武鸣县', '3', '0');
INSERT INTO `cities` VALUES ('860', '97', '隆安县', '3', '0');
INSERT INTO `cities` VALUES ('861', '97', '马山县', '3', '0');
INSERT INTO `cities` VALUES ('862', '97', '上林县', '3', '0');
INSERT INTO `cities` VALUES ('863', '97', '宾阳县', '3', '0');
INSERT INTO `cities` VALUES ('864', '97', '横县', '3', '0');
INSERT INTO `cities` VALUES ('865', '98', '秀峰区', '3', '0');
INSERT INTO `cities` VALUES ('866', '98', '叠彩区', '3', '0');
INSERT INTO `cities` VALUES ('867', '98', '象山区', '3', '0');
INSERT INTO `cities` VALUES ('868', '98', '七星区', '3', '0');
INSERT INTO `cities` VALUES ('869', '98', '雁山区', '3', '0');
INSERT INTO `cities` VALUES ('870', '98', '阳朔县', '3', '0');
INSERT INTO `cities` VALUES ('871', '98', '临桂县', '3', '0');
INSERT INTO `cities` VALUES ('872', '98', '灵川县', '3', '0');
INSERT INTO `cities` VALUES ('873', '98', '全州县', '3', '0');
INSERT INTO `cities` VALUES ('874', '98', '平乐县', '3', '0');
INSERT INTO `cities` VALUES ('875', '98', '兴安县', '3', '0');
INSERT INTO `cities` VALUES ('876', '98', '灌阳县', '3', '0');
INSERT INTO `cities` VALUES ('877', '98', '荔浦县', '3', '0');
INSERT INTO `cities` VALUES ('878', '98', '资源县', '3', '0');
INSERT INTO `cities` VALUES ('879', '98', '永福县', '3', '0');
INSERT INTO `cities` VALUES ('880', '98', '龙胜', '3', '0');
INSERT INTO `cities` VALUES ('881', '98', '恭城', '3', '0');
INSERT INTO `cities` VALUES ('882', '99', '右江区', '3', '0');
INSERT INTO `cities` VALUES ('883', '99', '凌云县', '3', '0');
INSERT INTO `cities` VALUES ('884', '99', '平果县', '3', '0');
INSERT INTO `cities` VALUES ('885', '99', '西林县', '3', '0');
INSERT INTO `cities` VALUES ('886', '99', '乐业县', '3', '0');
INSERT INTO `cities` VALUES ('887', '99', '德保县', '3', '0');
INSERT INTO `cities` VALUES ('888', '99', '田林县', '3', '0');
INSERT INTO `cities` VALUES ('889', '99', '田阳县', '3', '0');
INSERT INTO `cities` VALUES ('890', '99', '靖西县', '3', '0');
INSERT INTO `cities` VALUES ('891', '99', '田东县', '3', '0');
INSERT INTO `cities` VALUES ('892', '99', '那坡县', '3', '0');
INSERT INTO `cities` VALUES ('893', '99', '隆林', '3', '0');
INSERT INTO `cities` VALUES ('894', '100', '海城区', '3', '0');
INSERT INTO `cities` VALUES ('895', '100', '银海区', '3', '0');
INSERT INTO `cities` VALUES ('896', '100', '铁山港区', '3', '0');
INSERT INTO `cities` VALUES ('897', '100', '合浦县', '3', '0');
INSERT INTO `cities` VALUES ('898', '101', '江州区', '3', '0');
INSERT INTO `cities` VALUES ('899', '101', '凭祥市', '3', '0');
INSERT INTO `cities` VALUES ('900', '101', '宁明县', '3', '0');
INSERT INTO `cities` VALUES ('901', '101', '扶绥县', '3', '0');
INSERT INTO `cities` VALUES ('902', '101', '龙州县', '3', '0');
INSERT INTO `cities` VALUES ('903', '101', '大新县', '3', '0');
INSERT INTO `cities` VALUES ('904', '101', '天等县', '3', '0');
INSERT INTO `cities` VALUES ('905', '102', '港口区', '3', '0');
INSERT INTO `cities` VALUES ('906', '102', '防城区', '3', '0');
INSERT INTO `cities` VALUES ('907', '102', '东兴市', '3', '0');
INSERT INTO `cities` VALUES ('908', '102', '上思县', '3', '0');
INSERT INTO `cities` VALUES ('909', '103', '港北区', '3', '0');
INSERT INTO `cities` VALUES ('910', '103', '港南区', '3', '0');
INSERT INTO `cities` VALUES ('911', '103', '覃塘区', '3', '0');
INSERT INTO `cities` VALUES ('912', '103', '桂平市', '3', '0');
INSERT INTO `cities` VALUES ('913', '103', '平南县', '3', '0');
INSERT INTO `cities` VALUES ('914', '104', '金城江区', '3', '0');
INSERT INTO `cities` VALUES ('915', '104', '宜州市', '3', '0');
INSERT INTO `cities` VALUES ('916', '104', '天峨县', '3', '0');
INSERT INTO `cities` VALUES ('917', '104', '凤山县', '3', '0');
INSERT INTO `cities` VALUES ('918', '104', '南丹县', '3', '0');
INSERT INTO `cities` VALUES ('919', '104', '东兰县', '3', '0');
INSERT INTO `cities` VALUES ('920', '104', '都安', '3', '0');
INSERT INTO `cities` VALUES ('921', '104', '罗城', '3', '0');
INSERT INTO `cities` VALUES ('922', '104', '巴马', '3', '0');
INSERT INTO `cities` VALUES ('923', '104', '环江', '3', '0');
INSERT INTO `cities` VALUES ('924', '104', '大化', '3', '0');
INSERT INTO `cities` VALUES ('925', '105', '八步区', '3', '0');
INSERT INTO `cities` VALUES ('926', '105', '钟山县', '3', '0');
INSERT INTO `cities` VALUES ('927', '105', '昭平县', '3', '0');
INSERT INTO `cities` VALUES ('928', '105', '富川', '3', '0');
INSERT INTO `cities` VALUES ('929', '106', '兴宾区', '3', '0');
INSERT INTO `cities` VALUES ('930', '106', '合山市', '3', '0');
INSERT INTO `cities` VALUES ('931', '106', '象州县', '3', '0');
INSERT INTO `cities` VALUES ('932', '106', '武宣县', '3', '0');
INSERT INTO `cities` VALUES ('933', '106', '忻城县', '3', '0');
INSERT INTO `cities` VALUES ('934', '106', '金秀', '3', '0');
INSERT INTO `cities` VALUES ('935', '107', '城中区', '3', '0');
INSERT INTO `cities` VALUES ('936', '107', '鱼峰区', '3', '0');
INSERT INTO `cities` VALUES ('937', '107', '柳北区', '3', '0');
INSERT INTO `cities` VALUES ('938', '107', '柳南区', '3', '0');
INSERT INTO `cities` VALUES ('939', '107', '柳江县', '3', '0');
INSERT INTO `cities` VALUES ('940', '107', '柳城县', '3', '0');
INSERT INTO `cities` VALUES ('941', '107', '鹿寨县', '3', '0');
INSERT INTO `cities` VALUES ('942', '107', '融安县', '3', '0');
INSERT INTO `cities` VALUES ('943', '107', '融水', '3', '0');
INSERT INTO `cities` VALUES ('944', '107', '三江', '3', '0');
INSERT INTO `cities` VALUES ('945', '108', '钦南区', '3', '0');
INSERT INTO `cities` VALUES ('946', '108', '钦北区', '3', '0');
INSERT INTO `cities` VALUES ('947', '108', '灵山县', '3', '0');
INSERT INTO `cities` VALUES ('948', '108', '浦北县', '3', '0');
INSERT INTO `cities` VALUES ('949', '109', '万秀区', '3', '0');
INSERT INTO `cities` VALUES ('950', '109', '蝶山区', '3', '0');
INSERT INTO `cities` VALUES ('951', '109', '长洲区', '3', '0');
INSERT INTO `cities` VALUES ('952', '109', '岑溪市', '3', '0');
INSERT INTO `cities` VALUES ('953', '109', '苍梧县', '3', '0');
INSERT INTO `cities` VALUES ('954', '109', '藤县', '3', '0');
INSERT INTO `cities` VALUES ('955', '109', '蒙山县', '3', '0');
INSERT INTO `cities` VALUES ('956', '110', '玉州区', '3', '0');
INSERT INTO `cities` VALUES ('957', '110', '北流市', '3', '0');
INSERT INTO `cities` VALUES ('958', '110', '容县', '3', '0');
INSERT INTO `cities` VALUES ('959', '110', '陆川县', '3', '0');
INSERT INTO `cities` VALUES ('960', '110', '博白县', '3', '0');
INSERT INTO `cities` VALUES ('961', '110', '兴业县', '3', '0');
INSERT INTO `cities` VALUES ('962', '111', '南明区', '3', '0');
INSERT INTO `cities` VALUES ('963', '111', '云岩区', '3', '0');
INSERT INTO `cities` VALUES ('964', '111', '花溪区', '3', '0');
INSERT INTO `cities` VALUES ('965', '111', '乌当区', '3', '0');
INSERT INTO `cities` VALUES ('966', '111', '白云区', '3', '0');
INSERT INTO `cities` VALUES ('967', '111', '小河区', '3', '0');
INSERT INTO `cities` VALUES ('968', '111', '金阳新区', '3', '0');
INSERT INTO `cities` VALUES ('969', '111', '新天园区', '3', '0');
INSERT INTO `cities` VALUES ('970', '111', '清镇市', '3', '0');
INSERT INTO `cities` VALUES ('971', '111', '开阳县', '3', '0');
INSERT INTO `cities` VALUES ('972', '111', '修文县', '3', '0');
INSERT INTO `cities` VALUES ('973', '111', '息烽县', '3', '0');
INSERT INTO `cities` VALUES ('974', '112', '西秀区', '3', '0');
INSERT INTO `cities` VALUES ('975', '112', '关岭', '3', '0');
INSERT INTO `cities` VALUES ('976', '112', '镇宁', '3', '0');
INSERT INTO `cities` VALUES ('977', '112', '紫云', '3', '0');
INSERT INTO `cities` VALUES ('978', '112', '平坝县', '3', '0');
INSERT INTO `cities` VALUES ('979', '112', '普定县', '3', '0');
INSERT INTO `cities` VALUES ('980', '113', '毕节市', '3', '0');
INSERT INTO `cities` VALUES ('981', '113', '大方县', '3', '0');
INSERT INTO `cities` VALUES ('982', '113', '黔西县', '3', '0');
INSERT INTO `cities` VALUES ('983', '113', '金沙县', '3', '0');
INSERT INTO `cities` VALUES ('984', '113', '织金县', '3', '0');
INSERT INTO `cities` VALUES ('985', '113', '纳雍县', '3', '0');
INSERT INTO `cities` VALUES ('986', '113', '赫章县', '3', '0');
INSERT INTO `cities` VALUES ('987', '113', '威宁', '3', '0');
INSERT INTO `cities` VALUES ('988', '114', '钟山区', '3', '0');
INSERT INTO `cities` VALUES ('989', '114', '六枝特区', '3', '0');
INSERT INTO `cities` VALUES ('990', '114', '水城县', '3', '0');
INSERT INTO `cities` VALUES ('991', '114', '盘县', '3', '0');
INSERT INTO `cities` VALUES ('992', '115', '凯里市', '3', '0');
INSERT INTO `cities` VALUES ('993', '115', '黄平县', '3', '0');
INSERT INTO `cities` VALUES ('994', '115', '施秉县', '3', '0');
INSERT INTO `cities` VALUES ('995', '115', '三穗县', '3', '0');
INSERT INTO `cities` VALUES ('996', '115', '镇远县', '3', '0');
INSERT INTO `cities` VALUES ('997', '115', '岑巩县', '3', '0');
INSERT INTO `cities` VALUES ('998', '115', '天柱县', '3', '0');
INSERT INTO `cities` VALUES ('999', '115', '锦屏县', '3', '0');
INSERT INTO `cities` VALUES ('1000', '115', '剑河县', '3', '0');
INSERT INTO `cities` VALUES ('1001', '115', '台江县', '3', '0');
INSERT INTO `cities` VALUES ('1002', '115', '黎平县', '3', '0');
INSERT INTO `cities` VALUES ('1003', '115', '榕江县', '3', '0');
INSERT INTO `cities` VALUES ('1004', '115', '从江县', '3', '0');
INSERT INTO `cities` VALUES ('1005', '115', '雷山县', '3', '0');
INSERT INTO `cities` VALUES ('1006', '115', '麻江县', '3', '0');
INSERT INTO `cities` VALUES ('1007', '115', '丹寨县', '3', '0');
INSERT INTO `cities` VALUES ('1008', '116', '都匀市', '3', '0');
INSERT INTO `cities` VALUES ('1009', '116', '福泉市', '3', '0');
INSERT INTO `cities` VALUES ('1010', '116', '荔波县', '3', '0');
INSERT INTO `cities` VALUES ('1011', '116', '贵定县', '3', '0');
INSERT INTO `cities` VALUES ('1012', '116', '瓮安县', '3', '0');
INSERT INTO `cities` VALUES ('1013', '116', '独山县', '3', '0');
INSERT INTO `cities` VALUES ('1014', '116', '平塘县', '3', '0');
INSERT INTO `cities` VALUES ('1015', '116', '罗甸县', '3', '0');
INSERT INTO `cities` VALUES ('1016', '116', '长顺县', '3', '0');
INSERT INTO `cities` VALUES ('1017', '116', '龙里县', '3', '0');
INSERT INTO `cities` VALUES ('1018', '116', '惠水县', '3', '0');
INSERT INTO `cities` VALUES ('1019', '116', '三都', '3', '0');
INSERT INTO `cities` VALUES ('1020', '117', '兴义市', '3', '0');
INSERT INTO `cities` VALUES ('1021', '117', '兴仁县', '3', '0');
INSERT INTO `cities` VALUES ('1022', '117', '普安县', '3', '0');
INSERT INTO `cities` VALUES ('1023', '117', '晴隆县', '3', '0');
INSERT INTO `cities` VALUES ('1024', '117', '贞丰县', '3', '0');
INSERT INTO `cities` VALUES ('1025', '117', '望谟县', '3', '0');
INSERT INTO `cities` VALUES ('1026', '117', '册亨县', '3', '0');
INSERT INTO `cities` VALUES ('1027', '117', '安龙县', '3', '0');
INSERT INTO `cities` VALUES ('1028', '118', '铜仁市', '3', '0');
INSERT INTO `cities` VALUES ('1029', '118', '江口县', '3', '0');
INSERT INTO `cities` VALUES ('1030', '118', '石阡县', '3', '0');
INSERT INTO `cities` VALUES ('1031', '118', '思南县', '3', '0');
INSERT INTO `cities` VALUES ('1032', '118', '德江县', '3', '0');
INSERT INTO `cities` VALUES ('1033', '118', '玉屏', '3', '0');
INSERT INTO `cities` VALUES ('1034', '118', '印江', '3', '0');
INSERT INTO `cities` VALUES ('1035', '118', '沿河', '3', '0');
INSERT INTO `cities` VALUES ('1036', '118', '松桃', '3', '0');
INSERT INTO `cities` VALUES ('1037', '118', '万山特区', '3', '0');
INSERT INTO `cities` VALUES ('1038', '119', '红花岗区', '3', '0');
INSERT INTO `cities` VALUES ('1039', '119', '务川县', '3', '0');
INSERT INTO `cities` VALUES ('1040', '119', '道真县', '3', '0');
INSERT INTO `cities` VALUES ('1041', '119', '汇川区', '3', '0');
INSERT INTO `cities` VALUES ('1042', '119', '赤水市', '3', '0');
INSERT INTO `cities` VALUES ('1043', '119', '仁怀市', '3', '0');
INSERT INTO `cities` VALUES ('1044', '119', '遵义县', '3', '0');
INSERT INTO `cities` VALUES ('1045', '119', '桐梓县', '3', '0');
INSERT INTO `cities` VALUES ('1046', '119', '绥阳县', '3', '0');
INSERT INTO `cities` VALUES ('1047', '119', '正安县', '3', '0');
INSERT INTO `cities` VALUES ('1048', '119', '凤冈县', '3', '0');
INSERT INTO `cities` VALUES ('1049', '119', '湄潭县', '3', '0');
INSERT INTO `cities` VALUES ('1050', '119', '余庆县', '3', '0');
INSERT INTO `cities` VALUES ('1051', '119', '习水县', '3', '0');
INSERT INTO `cities` VALUES ('1052', '119', '道真', '3', '0');
INSERT INTO `cities` VALUES ('1053', '119', '务川', '3', '0');
INSERT INTO `cities` VALUES ('1054', '120', '秀英区', '3', '0');
INSERT INTO `cities` VALUES ('1055', '120', '龙华区', '3', '0');
INSERT INTO `cities` VALUES ('1056', '120', '琼山区', '3', '0');
INSERT INTO `cities` VALUES ('1057', '120', '美兰区', '3', '0');
INSERT INTO `cities` VALUES ('1058', '137', '市区', '3', '0');
INSERT INTO `cities` VALUES ('1059', '137', '洋浦开发区', '3', '0');
INSERT INTO `cities` VALUES ('1060', '137', '那大镇', '3', '0');
INSERT INTO `cities` VALUES ('1061', '137', '王五镇', '3', '0');
INSERT INTO `cities` VALUES ('1062', '137', '雅星镇', '3', '0');
INSERT INTO `cities` VALUES ('1063', '137', '大成镇', '3', '0');
INSERT INTO `cities` VALUES ('1064', '137', '中和镇', '3', '0');
INSERT INTO `cities` VALUES ('1065', '137', '峨蔓镇', '3', '0');
INSERT INTO `cities` VALUES ('1066', '137', '南丰镇', '3', '0');
INSERT INTO `cities` VALUES ('1067', '137', '白马井镇', '3', '0');
INSERT INTO `cities` VALUES ('1068', '137', '兰洋镇', '3', '0');
INSERT INTO `cities` VALUES ('1069', '137', '和庆镇', '3', '0');
INSERT INTO `cities` VALUES ('1070', '137', '海头镇', '3', '0');
INSERT INTO `cities` VALUES ('1071', '137', '排浦镇', '3', '0');
INSERT INTO `cities` VALUES ('1072', '137', '东成镇', '3', '0');
INSERT INTO `cities` VALUES ('1073', '137', '光村镇', '3', '0');
INSERT INTO `cities` VALUES ('1074', '137', '木棠镇', '3', '0');
INSERT INTO `cities` VALUES ('1075', '137', '新州镇', '3', '0');
INSERT INTO `cities` VALUES ('1076', '137', '三都镇', '3', '0');
INSERT INTO `cities` VALUES ('1077', '137', '其他', '3', '0');
INSERT INTO `cities` VALUES ('1078', '138', '长安区', '3', '0');
INSERT INTO `cities` VALUES ('1079', '138', '桥东区', '3', '0');
INSERT INTO `cities` VALUES ('1080', '138', '桥西区', '3', '0');
INSERT INTO `cities` VALUES ('1081', '138', '新华区', '3', '0');
INSERT INTO `cities` VALUES ('1082', '138', '裕华区', '3', '0');
INSERT INTO `cities` VALUES ('1083', '138', '井陉矿区', '3', '0');
INSERT INTO `cities` VALUES ('1084', '138', '高新区', '3', '0');
INSERT INTO `cities` VALUES ('1085', '138', '辛集市', '3', '0');
INSERT INTO `cities` VALUES ('1086', '138', '藁城市', '3', '0');
INSERT INTO `cities` VALUES ('1087', '138', '晋州市', '3', '0');
INSERT INTO `cities` VALUES ('1088', '138', '新乐市', '3', '0');
INSERT INTO `cities` VALUES ('1089', '138', '鹿泉市', '3', '0');
INSERT INTO `cities` VALUES ('1090', '138', '井陉县', '3', '0');
INSERT INTO `cities` VALUES ('1091', '138', '正定县', '3', '0');
INSERT INTO `cities` VALUES ('1092', '138', '栾城县', '3', '0');
INSERT INTO `cities` VALUES ('1093', '138', '行唐县', '3', '0');
INSERT INTO `cities` VALUES ('1094', '138', '灵寿县', '3', '0');
INSERT INTO `cities` VALUES ('1095', '138', '高邑县', '3', '0');
INSERT INTO `cities` VALUES ('1096', '138', '深泽县', '3', '0');
INSERT INTO `cities` VALUES ('1097', '138', '赞皇县', '3', '0');
INSERT INTO `cities` VALUES ('1098', '138', '无极县', '3', '0');
INSERT INTO `cities` VALUES ('1099', '138', '平山县', '3', '0');
INSERT INTO `cities` VALUES ('1100', '138', '元氏县', '3', '0');
INSERT INTO `cities` VALUES ('1101', '138', '赵县', '3', '0');
INSERT INTO `cities` VALUES ('1102', '139', '新市区', '3', '0');
INSERT INTO `cities` VALUES ('1103', '139', '南市区', '3', '0');
INSERT INTO `cities` VALUES ('1104', '139', '北市区', '3', '0');
INSERT INTO `cities` VALUES ('1105', '139', '涿州市', '3', '0');
INSERT INTO `cities` VALUES ('1106', '139', '定州市', '3', '0');
INSERT INTO `cities` VALUES ('1107', '139', '安国市', '3', '0');
INSERT INTO `cities` VALUES ('1108', '139', '高碑店市', '3', '0');
INSERT INTO `cities` VALUES ('1109', '139', '满城县', '3', '0');
INSERT INTO `cities` VALUES ('1110', '139', '清苑县', '3', '0');
INSERT INTO `cities` VALUES ('1111', '139', '涞水县', '3', '0');
INSERT INTO `cities` VALUES ('1112', '139', '阜平县', '3', '0');
INSERT INTO `cities` VALUES ('1113', '139', '徐水县', '3', '0');
INSERT INTO `cities` VALUES ('1114', '139', '定兴县', '3', '0');
INSERT INTO `cities` VALUES ('1115', '139', '唐县', '3', '0');
INSERT INTO `cities` VALUES ('1116', '139', '高阳县', '3', '0');
INSERT INTO `cities` VALUES ('1117', '139', '容城县', '3', '0');
INSERT INTO `cities` VALUES ('1118', '139', '涞源县', '3', '0');
INSERT INTO `cities` VALUES ('1119', '139', '望都县', '3', '0');
INSERT INTO `cities` VALUES ('1120', '139', '安新县', '3', '0');
INSERT INTO `cities` VALUES ('1121', '139', '易县', '3', '0');
INSERT INTO `cities` VALUES ('1122', '139', '曲阳县', '3', '0');
INSERT INTO `cities` VALUES ('1123', '139', '蠡县', '3', '0');
INSERT INTO `cities` VALUES ('1124', '139', '顺平县', '3', '0');
INSERT INTO `cities` VALUES ('1125', '139', '博野县', '3', '0');
INSERT INTO `cities` VALUES ('1126', '139', '雄县', '3', '0');
INSERT INTO `cities` VALUES ('1127', '140', '运河区', '3', '0');
INSERT INTO `cities` VALUES ('1128', '140', '新华区', '3', '0');
INSERT INTO `cities` VALUES ('1129', '140', '泊头市', '3', '0');
INSERT INTO `cities` VALUES ('1130', '140', '任丘市', '3', '0');
INSERT INTO `cities` VALUES ('1131', '140', '黄骅市', '3', '0');
INSERT INTO `cities` VALUES ('1132', '140', '河间市', '3', '0');
INSERT INTO `cities` VALUES ('1133', '140', '沧县', '3', '0');
INSERT INTO `cities` VALUES ('1134', '140', '青县', '3', '0');
INSERT INTO `cities` VALUES ('1135', '140', '东光县', '3', '0');
INSERT INTO `cities` VALUES ('1136', '140', '海兴县', '3', '0');
INSERT INTO `cities` VALUES ('1137', '140', '盐山县', '3', '0');
INSERT INTO `cities` VALUES ('1138', '140', '肃宁县', '3', '0');
INSERT INTO `cities` VALUES ('1139', '140', '南皮县', '3', '0');
INSERT INTO `cities` VALUES ('1140', '140', '吴桥县', '3', '0');
INSERT INTO `cities` VALUES ('1141', '140', '献县', '3', '0');
INSERT INTO `cities` VALUES ('1142', '140', '孟村', '3', '0');
INSERT INTO `cities` VALUES ('1143', '141', '双桥区', '3', '0');
INSERT INTO `cities` VALUES ('1144', '141', '双滦区', '3', '0');
INSERT INTO `cities` VALUES ('1145', '141', '鹰手营子矿区', '3', '0');
INSERT INTO `cities` VALUES ('1146', '141', '承德县', '3', '0');
INSERT INTO `cities` VALUES ('1147', '141', '兴隆县', '3', '0');
INSERT INTO `cities` VALUES ('1148', '141', '平泉县', '3', '0');
INSERT INTO `cities` VALUES ('1149', '141', '滦平县', '3', '0');
INSERT INTO `cities` VALUES ('1150', '141', '隆化县', '3', '0');
INSERT INTO `cities` VALUES ('1151', '141', '丰宁', '3', '0');
INSERT INTO `cities` VALUES ('1152', '141', '宽城', '3', '0');
INSERT INTO `cities` VALUES ('1153', '141', '围场', '3', '0');
INSERT INTO `cities` VALUES ('1154', '142', '从台区', '3', '0');
INSERT INTO `cities` VALUES ('1155', '142', '复兴区', '3', '0');
INSERT INTO `cities` VALUES ('1156', '142', '邯山区', '3', '0');
INSERT INTO `cities` VALUES ('1157', '142', '峰峰矿区', '3', '0');
INSERT INTO `cities` VALUES ('1158', '142', '武安市', '3', '0');
INSERT INTO `cities` VALUES ('1159', '142', '邯郸县', '3', '0');
INSERT INTO `cities` VALUES ('1160', '142', '临漳县', '3', '0');
INSERT INTO `cities` VALUES ('1161', '142', '成安县', '3', '0');
INSERT INTO `cities` VALUES ('1162', '142', '大名县', '3', '0');
INSERT INTO `cities` VALUES ('1163', '142', '涉县', '3', '0');
INSERT INTO `cities` VALUES ('1164', '142', '磁县', '3', '0');
INSERT INTO `cities` VALUES ('1165', '142', '肥乡县', '3', '0');
INSERT INTO `cities` VALUES ('1166', '142', '永年县', '3', '0');
INSERT INTO `cities` VALUES ('1167', '142', '邱县', '3', '0');
INSERT INTO `cities` VALUES ('1168', '142', '鸡泽县', '3', '0');
INSERT INTO `cities` VALUES ('1169', '142', '广平县', '3', '0');
INSERT INTO `cities` VALUES ('1170', '142', '馆陶县', '3', '0');
INSERT INTO `cities` VALUES ('1171', '142', '魏县', '3', '0');
INSERT INTO `cities` VALUES ('1172', '142', '曲周县', '3', '0');
INSERT INTO `cities` VALUES ('1173', '143', '桃城区', '3', '0');
INSERT INTO `cities` VALUES ('1174', '143', '冀州市', '3', '0');
INSERT INTO `cities` VALUES ('1175', '143', '深州市', '3', '0');
INSERT INTO `cities` VALUES ('1176', '143', '枣强县', '3', '0');
INSERT INTO `cities` VALUES ('1177', '143', '武邑县', '3', '0');
INSERT INTO `cities` VALUES ('1178', '143', '武强县', '3', '0');
INSERT INTO `cities` VALUES ('1179', '143', '饶阳县', '3', '0');
INSERT INTO `cities` VALUES ('1180', '143', '安平县', '3', '0');
INSERT INTO `cities` VALUES ('1181', '143', '故城县', '3', '0');
INSERT INTO `cities` VALUES ('1182', '143', '景县', '3', '0');
INSERT INTO `cities` VALUES ('1183', '143', '阜城县', '3', '0');
INSERT INTO `cities` VALUES ('1184', '144', '安次区', '3', '0');
INSERT INTO `cities` VALUES ('1185', '144', '广阳区', '3', '0');
INSERT INTO `cities` VALUES ('1186', '144', '霸州市', '3', '0');
INSERT INTO `cities` VALUES ('1187', '144', '三河市', '3', '0');
INSERT INTO `cities` VALUES ('1188', '144', '固安县', '3', '0');
INSERT INTO `cities` VALUES ('1189', '144', '永清县', '3', '0');
INSERT INTO `cities` VALUES ('1190', '144', '香河县', '3', '0');
INSERT INTO `cities` VALUES ('1191', '144', '大城县', '3', '0');
INSERT INTO `cities` VALUES ('1192', '144', '文安县', '3', '0');
INSERT INTO `cities` VALUES ('1193', '144', '大厂', '3', '0');
INSERT INTO `cities` VALUES ('1194', '145', '海港区', '3', '0');
INSERT INTO `cities` VALUES ('1195', '145', '山海关区', '3', '0');
INSERT INTO `cities` VALUES ('1196', '145', '北戴河区', '3', '0');
INSERT INTO `cities` VALUES ('1197', '145', '昌黎县', '3', '0');
INSERT INTO `cities` VALUES ('1198', '145', '抚宁县', '3', '0');
INSERT INTO `cities` VALUES ('1199', '145', '卢龙县', '3', '0');
INSERT INTO `cities` VALUES ('1200', '145', '青龙', '3', '0');
INSERT INTO `cities` VALUES ('1201', '146', '路北区', '3', '0');
INSERT INTO `cities` VALUES ('1202', '146', '路南区', '3', '0');
INSERT INTO `cities` VALUES ('1203', '146', '古冶区', '3', '0');
INSERT INTO `cities` VALUES ('1204', '146', '开平区', '3', '0');
INSERT INTO `cities` VALUES ('1205', '146', '丰南区', '3', '0');
INSERT INTO `cities` VALUES ('1206', '146', '丰润区', '3', '0');
INSERT INTO `cities` VALUES ('1207', '146', '遵化市', '3', '0');
INSERT INTO `cities` VALUES ('1208', '146', '迁安市', '3', '0');
INSERT INTO `cities` VALUES ('1209', '146', '滦县', '3', '0');
INSERT INTO `cities` VALUES ('1210', '146', '滦南县', '3', '0');
INSERT INTO `cities` VALUES ('1211', '146', '乐亭县', '3', '0');
INSERT INTO `cities` VALUES ('1212', '146', '迁西县', '3', '0');
INSERT INTO `cities` VALUES ('1213', '146', '玉田县', '3', '0');
INSERT INTO `cities` VALUES ('1214', '146', '唐海县', '3', '0');
INSERT INTO `cities` VALUES ('1215', '147', '桥东区', '3', '0');
INSERT INTO `cities` VALUES ('1216', '147', '桥西区', '3', '0');
INSERT INTO `cities` VALUES ('1217', '147', '南宫市', '3', '0');
INSERT INTO `cities` VALUES ('1218', '147', '沙河市', '3', '0');
INSERT INTO `cities` VALUES ('1219', '147', '邢台县', '3', '0');
INSERT INTO `cities` VALUES ('1220', '147', '临城县', '3', '0');
INSERT INTO `cities` VALUES ('1221', '147', '内丘县', '3', '0');
INSERT INTO `cities` VALUES ('1222', '147', '柏乡县', '3', '0');
INSERT INTO `cities` VALUES ('1223', '147', '隆尧县', '3', '0');
INSERT INTO `cities` VALUES ('1224', '147', '任县', '3', '0');
INSERT INTO `cities` VALUES ('1225', '147', '南和县', '3', '0');
INSERT INTO `cities` VALUES ('1226', '147', '宁晋县', '3', '0');
INSERT INTO `cities` VALUES ('1227', '147', '巨鹿县', '3', '0');
INSERT INTO `cities` VALUES ('1228', '147', '新河县', '3', '0');
INSERT INTO `cities` VALUES ('1229', '147', '广宗县', '3', '0');
INSERT INTO `cities` VALUES ('1230', '147', '平乡县', '3', '0');
INSERT INTO `cities` VALUES ('1231', '147', '威县', '3', '0');
INSERT INTO `cities` VALUES ('1232', '147', '清河县', '3', '0');
INSERT INTO `cities` VALUES ('1233', '147', '临西县', '3', '0');
INSERT INTO `cities` VALUES ('1234', '148', '桥西区', '3', '0');
INSERT INTO `cities` VALUES ('1235', '148', '桥东区', '3', '0');
INSERT INTO `cities` VALUES ('1236', '148', '宣化区', '3', '0');
INSERT INTO `cities` VALUES ('1237', '148', '下花园区', '3', '0');
INSERT INTO `cities` VALUES ('1238', '148', '宣化县', '3', '0');
INSERT INTO `cities` VALUES ('1239', '148', '张北县', '3', '0');
INSERT INTO `cities` VALUES ('1240', '148', '康保县', '3', '0');
INSERT INTO `cities` VALUES ('1241', '148', '沽源县', '3', '0');
INSERT INTO `cities` VALUES ('1242', '148', '尚义县', '3', '0');
INSERT INTO `cities` VALUES ('1243', '148', '蔚县', '3', '0');
INSERT INTO `cities` VALUES ('1244', '148', '阳原县', '3', '0');
INSERT INTO `cities` VALUES ('1245', '148', '怀安县', '3', '0');
INSERT INTO `cities` VALUES ('1246', '148', '万全县', '3', '0');
INSERT INTO `cities` VALUES ('1247', '148', '怀来县', '3', '0');
INSERT INTO `cities` VALUES ('1248', '148', '涿鹿县', '3', '0');
INSERT INTO `cities` VALUES ('1249', '148', '赤城县', '3', '0');
INSERT INTO `cities` VALUES ('1250', '148', '崇礼县', '3', '0');
INSERT INTO `cities` VALUES ('1251', '149', '金水区', '3', '0');
INSERT INTO `cities` VALUES ('1252', '149', '邙山区', '3', '0');
INSERT INTO `cities` VALUES ('1253', '149', '二七区', '3', '0');
INSERT INTO `cities` VALUES ('1254', '149', '管城区', '3', '0');
INSERT INTO `cities` VALUES ('1255', '149', '中原区', '3', '0');
INSERT INTO `cities` VALUES ('1256', '149', '上街区', '3', '0');
INSERT INTO `cities` VALUES ('1257', '149', '惠济区', '3', '0');
INSERT INTO `cities` VALUES ('1258', '149', '郑东新区', '3', '0');
INSERT INTO `cities` VALUES ('1259', '149', '经济技术开发区', '3', '0');
INSERT INTO `cities` VALUES ('1260', '149', '高新开发区', '3', '0');
INSERT INTO `cities` VALUES ('1261', '149', '出口加工区', '3', '0');
INSERT INTO `cities` VALUES ('1262', '149', '巩义市', '3', '0');
INSERT INTO `cities` VALUES ('1263', '149', '荥阳市', '3', '0');
INSERT INTO `cities` VALUES ('1264', '149', '新密市', '3', '0');
INSERT INTO `cities` VALUES ('1265', '149', '新郑市', '3', '0');
INSERT INTO `cities` VALUES ('1266', '149', '登封市', '3', '0');
INSERT INTO `cities` VALUES ('1267', '149', '中牟县', '3', '0');
INSERT INTO `cities` VALUES ('1268', '150', '西工区', '3', '0');
INSERT INTO `cities` VALUES ('1269', '150', '老城区', '3', '0');
INSERT INTO `cities` VALUES ('1270', '150', '涧西区', '3', '0');
INSERT INTO `cities` VALUES ('1271', '150', '瀍河回族区', '3', '0');
INSERT INTO `cities` VALUES ('1272', '150', '洛龙区', '3', '0');
INSERT INTO `cities` VALUES ('1273', '150', '吉利区', '3', '0');
INSERT INTO `cities` VALUES ('1274', '150', '偃师市', '3', '0');
INSERT INTO `cities` VALUES ('1275', '150', '孟津县', '3', '0');
INSERT INTO `cities` VALUES ('1276', '150', '新安县', '3', '0');
INSERT INTO `cities` VALUES ('1277', '150', '栾川县', '3', '0');
INSERT INTO `cities` VALUES ('1278', '150', '嵩县', '3', '0');
INSERT INTO `cities` VALUES ('1279', '150', '汝阳县', '3', '0');
INSERT INTO `cities` VALUES ('1280', '150', '宜阳县', '3', '0');
INSERT INTO `cities` VALUES ('1281', '150', '洛宁县', '3', '0');
INSERT INTO `cities` VALUES ('1282', '150', '伊川县', '3', '0');
INSERT INTO `cities` VALUES ('1283', '151', '鼓楼区', '3', '0');
INSERT INTO `cities` VALUES ('1284', '151', '龙亭区', '3', '0');
INSERT INTO `cities` VALUES ('1285', '151', '顺河回族区', '3', '0');
INSERT INTO `cities` VALUES ('1286', '151', '金明区', '3', '0');
INSERT INTO `cities` VALUES ('1287', '151', '禹王台区', '3', '0');
INSERT INTO `cities` VALUES ('1288', '151', '杞县', '3', '0');
INSERT INTO `cities` VALUES ('1289', '151', '通许县', '3', '0');
INSERT INTO `cities` VALUES ('1290', '151', '尉氏县', '3', '0');
INSERT INTO `cities` VALUES ('1291', '151', '开封县', '3', '0');
INSERT INTO `cities` VALUES ('1292', '151', '兰考县', '3', '0');
INSERT INTO `cities` VALUES ('1293', '152', '北关区', '3', '0');
INSERT INTO `cities` VALUES ('1294', '152', '文峰区', '3', '0');
INSERT INTO `cities` VALUES ('1295', '152', '殷都区', '3', '0');
INSERT INTO `cities` VALUES ('1296', '152', '龙安区', '3', '0');
INSERT INTO `cities` VALUES ('1297', '152', '林州市', '3', '0');
INSERT INTO `cities` VALUES ('1298', '152', '安阳县', '3', '0');
INSERT INTO `cities` VALUES ('1299', '152', '汤阴县', '3', '0');
INSERT INTO `cities` VALUES ('1300', '152', '滑县', '3', '0');
INSERT INTO `cities` VALUES ('1301', '152', '内黄县', '3', '0');
INSERT INTO `cities` VALUES ('1302', '153', '淇滨区', '3', '0');
INSERT INTO `cities` VALUES ('1303', '153', '山城区', '3', '0');
INSERT INTO `cities` VALUES ('1304', '153', '鹤山区', '3', '0');
INSERT INTO `cities` VALUES ('1305', '153', '浚县', '3', '0');
INSERT INTO `cities` VALUES ('1306', '153', '淇县', '3', '0');
INSERT INTO `cities` VALUES ('1307', '154', '济源市', '3', '0');
INSERT INTO `cities` VALUES ('1308', '155', '解放区', '3', '0');
INSERT INTO `cities` VALUES ('1309', '155', '中站区', '3', '0');
INSERT INTO `cities` VALUES ('1310', '155', '马村区', '3', '0');
INSERT INTO `cities` VALUES ('1311', '155', '山阳区', '3', '0');
INSERT INTO `cities` VALUES ('1312', '155', '沁阳市', '3', '0');
INSERT INTO `cities` VALUES ('1313', '155', '孟州市', '3', '0');
INSERT INTO `cities` VALUES ('1314', '155', '修武县', '3', '0');
INSERT INTO `cities` VALUES ('1315', '155', '博爱县', '3', '0');
INSERT INTO `cities` VALUES ('1316', '155', '武陟县', '3', '0');
INSERT INTO `cities` VALUES ('1317', '155', '温县', '3', '0');
INSERT INTO `cities` VALUES ('1318', '156', '卧龙区', '3', '0');
INSERT INTO `cities` VALUES ('1319', '156', '宛城区', '3', '0');
INSERT INTO `cities` VALUES ('1320', '156', '邓州市', '3', '0');
INSERT INTO `cities` VALUES ('1321', '156', '南召县', '3', '0');
INSERT INTO `cities` VALUES ('1322', '156', '方城县', '3', '0');
INSERT INTO `cities` VALUES ('1323', '156', '西峡县', '3', '0');
INSERT INTO `cities` VALUES ('1324', '156', '镇平县', '3', '0');
INSERT INTO `cities` VALUES ('1325', '156', '内乡县', '3', '0');
INSERT INTO `cities` VALUES ('1326', '156', '淅川县', '3', '0');
INSERT INTO `cities` VALUES ('1327', '156', '社旗县', '3', '0');
INSERT INTO `cities` VALUES ('1328', '156', '唐河县', '3', '0');
INSERT INTO `cities` VALUES ('1329', '156', '新野县', '3', '0');
INSERT INTO `cities` VALUES ('1330', '156', '桐柏县', '3', '0');
INSERT INTO `cities` VALUES ('1331', '157', '新华区', '3', '0');
INSERT INTO `cities` VALUES ('1332', '157', '卫东区', '3', '0');
INSERT INTO `cities` VALUES ('1333', '157', '湛河区', '3', '0');
INSERT INTO `cities` VALUES ('1334', '157', '石龙区', '3', '0');
INSERT INTO `cities` VALUES ('1335', '157', '舞钢市', '3', '0');
INSERT INTO `cities` VALUES ('1336', '157', '汝州市', '3', '0');
INSERT INTO `cities` VALUES ('1337', '157', '宝丰县', '3', '0');
INSERT INTO `cities` VALUES ('1338', '157', '叶县', '3', '0');
INSERT INTO `cities` VALUES ('1339', '157', '鲁山县', '3', '0');
INSERT INTO `cities` VALUES ('1340', '157', '郏县', '3', '0');
INSERT INTO `cities` VALUES ('1341', '158', '湖滨区', '3', '0');
INSERT INTO `cities` VALUES ('1342', '158', '义马市', '3', '0');
INSERT INTO `cities` VALUES ('1343', '158', '灵宝市', '3', '0');
INSERT INTO `cities` VALUES ('1344', '158', '渑池县', '3', '0');
INSERT INTO `cities` VALUES ('1345', '158', '陕县', '3', '0');
INSERT INTO `cities` VALUES ('1346', '158', '卢氏县', '3', '0');
INSERT INTO `cities` VALUES ('1347', '159', '梁园区', '3', '0');
INSERT INTO `cities` VALUES ('1348', '159', '睢阳区', '3', '0');
INSERT INTO `cities` VALUES ('1349', '159', '永城市', '3', '0');
INSERT INTO `cities` VALUES ('1350', '159', '民权县', '3', '0');
INSERT INTO `cities` VALUES ('1351', '159', '睢县', '3', '0');
INSERT INTO `cities` VALUES ('1352', '159', '宁陵县', '3', '0');
INSERT INTO `cities` VALUES ('1353', '159', '虞城县', '3', '0');
INSERT INTO `cities` VALUES ('1354', '159', '柘城县', '3', '0');
INSERT INTO `cities` VALUES ('1355', '159', '夏邑县', '3', '0');
INSERT INTO `cities` VALUES ('1356', '160', '卫滨区', '3', '0');
INSERT INTO `cities` VALUES ('1357', '160', '红旗区', '3', '0');
INSERT INTO `cities` VALUES ('1358', '160', '凤泉区', '3', '0');
INSERT INTO `cities` VALUES ('1359', '160', '牧野区', '3', '0');
INSERT INTO `cities` VALUES ('1360', '160', '卫辉市', '3', '0');
INSERT INTO `cities` VALUES ('1361', '160', '辉县市', '3', '0');
INSERT INTO `cities` VALUES ('1362', '160', '新乡县', '3', '0');
INSERT INTO `cities` VALUES ('1363', '160', '获嘉县', '3', '0');
INSERT INTO `cities` VALUES ('1364', '160', '原阳县', '3', '0');
INSERT INTO `cities` VALUES ('1365', '160', '延津县', '3', '0');
INSERT INTO `cities` VALUES ('1366', '160', '封丘县', '3', '0');
INSERT INTO `cities` VALUES ('1367', '160', '长垣县', '3', '0');
INSERT INTO `cities` VALUES ('1368', '161', '浉河区', '3', '0');
INSERT INTO `cities` VALUES ('1369', '161', '平桥区', '3', '0');
INSERT INTO `cities` VALUES ('1370', '161', '罗山县', '3', '0');
INSERT INTO `cities` VALUES ('1371', '161', '光山县', '3', '0');
INSERT INTO `cities` VALUES ('1372', '161', '新县', '3', '0');
INSERT INTO `cities` VALUES ('1373', '161', '商城县', '3', '0');
INSERT INTO `cities` VALUES ('1374', '161', '固始县', '3', '0');
INSERT INTO `cities` VALUES ('1375', '161', '潢川县', '3', '0');
INSERT INTO `cities` VALUES ('1376', '161', '淮滨县', '3', '0');
INSERT INTO `cities` VALUES ('1377', '161', '息县', '3', '0');
INSERT INTO `cities` VALUES ('1378', '162', '魏都区', '3', '0');
INSERT INTO `cities` VALUES ('1379', '162', '禹州市', '3', '0');
INSERT INTO `cities` VALUES ('1380', '162', '长葛市', '3', '0');
INSERT INTO `cities` VALUES ('1381', '162', '许昌县', '3', '0');
INSERT INTO `cities` VALUES ('1382', '162', '鄢陵县', '3', '0');
INSERT INTO `cities` VALUES ('1383', '162', '襄城县', '3', '0');
INSERT INTO `cities` VALUES ('1384', '163', '川汇区', '3', '0');
INSERT INTO `cities` VALUES ('1385', '163', '项城市', '3', '0');
INSERT INTO `cities` VALUES ('1386', '163', '扶沟县', '3', '0');
INSERT INTO `cities` VALUES ('1387', '163', '西华县', '3', '0');
INSERT INTO `cities` VALUES ('1388', '163', '商水县', '3', '0');
INSERT INTO `cities` VALUES ('1389', '163', '沈丘县', '3', '0');
INSERT INTO `cities` VALUES ('1390', '163', '郸城县', '3', '0');
INSERT INTO `cities` VALUES ('1391', '163', '淮阳县', '3', '0');
INSERT INTO `cities` VALUES ('1392', '163', '太康县', '3', '0');
INSERT INTO `cities` VALUES ('1393', '163', '鹿邑县', '3', '0');
INSERT INTO `cities` VALUES ('1394', '164', '驿城区', '3', '0');
INSERT INTO `cities` VALUES ('1395', '164', '西平县', '3', '0');
INSERT INTO `cities` VALUES ('1396', '164', '上蔡县', '3', '0');
INSERT INTO `cities` VALUES ('1397', '164', '平舆县', '3', '0');
INSERT INTO `cities` VALUES ('1398', '164', '正阳县', '3', '0');
INSERT INTO `cities` VALUES ('1399', '164', '确山县', '3', '0');
INSERT INTO `cities` VALUES ('1400', '164', '泌阳县', '3', '0');
INSERT INTO `cities` VALUES ('1401', '164', '汝南县', '3', '0');
INSERT INTO `cities` VALUES ('1402', '164', '遂平县', '3', '0');
INSERT INTO `cities` VALUES ('1403', '164', '新蔡县', '3', '0');
INSERT INTO `cities` VALUES ('1404', '165', '郾城区', '3', '0');
INSERT INTO `cities` VALUES ('1405', '165', '源汇区', '3', '0');
INSERT INTO `cities` VALUES ('1406', '165', '召陵区', '3', '0');
INSERT INTO `cities` VALUES ('1407', '165', '舞阳县', '3', '0');
INSERT INTO `cities` VALUES ('1408', '165', '临颍县', '3', '0');
INSERT INTO `cities` VALUES ('1409', '166', '华龙区', '3', '0');
INSERT INTO `cities` VALUES ('1410', '166', '清丰县', '3', '0');
INSERT INTO `cities` VALUES ('1411', '166', '南乐县', '3', '0');
INSERT INTO `cities` VALUES ('1412', '166', '范县', '3', '0');
INSERT INTO `cities` VALUES ('1413', '166', '台前县', '3', '0');
INSERT INTO `cities` VALUES ('1414', '166', '濮阳县', '3', '0');
INSERT INTO `cities` VALUES ('1415', '167', '道里区', '3', '0');
INSERT INTO `cities` VALUES ('1416', '167', '南岗区', '3', '0');
INSERT INTO `cities` VALUES ('1417', '167', '动力区', '3', '0');
INSERT INTO `cities` VALUES ('1418', '167', '平房区', '3', '0');
INSERT INTO `cities` VALUES ('1419', '167', '香坊区', '3', '0');
INSERT INTO `cities` VALUES ('1420', '167', '太平区', '3', '0');
INSERT INTO `cities` VALUES ('1421', '167', '道外区', '3', '0');
INSERT INTO `cities` VALUES ('1422', '167', '阿城区', '3', '0');
INSERT INTO `cities` VALUES ('1423', '167', '呼兰区', '3', '0');
INSERT INTO `cities` VALUES ('1424', '167', '松北区', '3', '0');
INSERT INTO `cities` VALUES ('1425', '167', '尚志市', '3', '0');
INSERT INTO `cities` VALUES ('1426', '167', '双城市', '3', '0');
INSERT INTO `cities` VALUES ('1427', '167', '五常市', '3', '0');
INSERT INTO `cities` VALUES ('1428', '167', '方正县', '3', '0');
INSERT INTO `cities` VALUES ('1429', '167', '宾县', '3', '0');
INSERT INTO `cities` VALUES ('1430', '167', '依兰县', '3', '0');
INSERT INTO `cities` VALUES ('1431', '167', '巴彦县', '3', '0');
INSERT INTO `cities` VALUES ('1432', '167', '通河县', '3', '0');
INSERT INTO `cities` VALUES ('1433', '167', '木兰县', '3', '0');
INSERT INTO `cities` VALUES ('1434', '167', '延寿县', '3', '0');
INSERT INTO `cities` VALUES ('1435', '168', '萨尔图区', '3', '0');
INSERT INTO `cities` VALUES ('1436', '168', '红岗区', '3', '0');
INSERT INTO `cities` VALUES ('1437', '168', '龙凤区', '3', '0');
INSERT INTO `cities` VALUES ('1438', '168', '让胡路区', '3', '0');
INSERT INTO `cities` VALUES ('1439', '168', '大同区', '3', '0');
INSERT INTO `cities` VALUES ('1440', '168', '肇州县', '3', '0');
INSERT INTO `cities` VALUES ('1441', '168', '肇源县', '3', '0');
INSERT INTO `cities` VALUES ('1442', '168', '林甸县', '3', '0');
INSERT INTO `cities` VALUES ('1443', '168', '杜尔伯特', '3', '0');
INSERT INTO `cities` VALUES ('1444', '169', '呼玛县', '3', '0');
INSERT INTO `cities` VALUES ('1445', '169', '漠河县', '3', '0');
INSERT INTO `cities` VALUES ('1446', '169', '塔河县', '3', '0');
INSERT INTO `cities` VALUES ('1447', '170', '兴山区', '3', '0');
INSERT INTO `cities` VALUES ('1448', '170', '工农区', '3', '0');
INSERT INTO `cities` VALUES ('1449', '170', '南山区', '3', '0');
INSERT INTO `cities` VALUES ('1450', '170', '兴安区', '3', '0');
INSERT INTO `cities` VALUES ('1451', '170', '向阳区', '3', '0');
INSERT INTO `cities` VALUES ('1452', '170', '东山区', '3', '0');
INSERT INTO `cities` VALUES ('1453', '170', '萝北县', '3', '0');
INSERT INTO `cities` VALUES ('1454', '170', '绥滨县', '3', '0');
INSERT INTO `cities` VALUES ('1455', '171', '爱辉区', '3', '0');
INSERT INTO `cities` VALUES ('1456', '171', '五大连池市', '3', '0');
INSERT INTO `cities` VALUES ('1457', '171', '北安市', '3', '0');
INSERT INTO `cities` VALUES ('1458', '171', '嫩江县', '3', '0');
INSERT INTO `cities` VALUES ('1459', '171', '逊克县', '3', '0');
INSERT INTO `cities` VALUES ('1460', '171', '孙吴县', '3', '0');
INSERT INTO `cities` VALUES ('1461', '172', '鸡冠区', '3', '0');
INSERT INTO `cities` VALUES ('1462', '172', '恒山区', '3', '0');
INSERT INTO `cities` VALUES ('1463', '172', '城子河区', '3', '0');
INSERT INTO `cities` VALUES ('1464', '172', '滴道区', '3', '0');
INSERT INTO `cities` VALUES ('1465', '172', '梨树区', '3', '0');
INSERT INTO `cities` VALUES ('1466', '172', '虎林市', '3', '0');
INSERT INTO `cities` VALUES ('1467', '172', '密山市', '3', '0');
INSERT INTO `cities` VALUES ('1468', '172', '鸡东县', '3', '0');
INSERT INTO `cities` VALUES ('1469', '173', '前进区', '3', '0');
INSERT INTO `cities` VALUES ('1470', '173', '郊区', '3', '0');
INSERT INTO `cities` VALUES ('1471', '173', '向阳区', '3', '0');
INSERT INTO `cities` VALUES ('1472', '173', '东风区', '3', '0');
INSERT INTO `cities` VALUES ('1473', '173', '同江市', '3', '0');
INSERT INTO `cities` VALUES ('1474', '173', '富锦市', '3', '0');
INSERT INTO `cities` VALUES ('1475', '173', '桦南县', '3', '0');
INSERT INTO `cities` VALUES ('1476', '173', '桦川县', '3', '0');
INSERT INTO `cities` VALUES ('1477', '173', '汤原县', '3', '0');
INSERT INTO `cities` VALUES ('1478', '173', '抚远县', '3', '0');
INSERT INTO `cities` VALUES ('1479', '174', '爱民区', '3', '0');
INSERT INTO `cities` VALUES ('1480', '174', '东安区', '3', '0');
INSERT INTO `cities` VALUES ('1481', '174', '阳明区', '3', '0');
INSERT INTO `cities` VALUES ('1482', '174', '西安区', '3', '0');
INSERT INTO `cities` VALUES ('1483', '174', '绥芬河市', '3', '0');
INSERT INTO `cities` VALUES ('1484', '174', '海林市', '3', '0');
INSERT INTO `cities` VALUES ('1485', '174', '宁安市', '3', '0');
INSERT INTO `cities` VALUES ('1486', '174', '穆棱市', '3', '0');
INSERT INTO `cities` VALUES ('1487', '174', '东宁县', '3', '0');
INSERT INTO `cities` VALUES ('1488', '174', '林口县', '3', '0');
INSERT INTO `cities` VALUES ('1489', '175', '桃山区', '3', '0');
INSERT INTO `cities` VALUES ('1490', '175', '新兴区', '3', '0');
INSERT INTO `cities` VALUES ('1491', '175', '茄子河区', '3', '0');
INSERT INTO `cities` VALUES ('1492', '175', '勃利县', '3', '0');
INSERT INTO `cities` VALUES ('1493', '176', '龙沙区', '3', '0');
INSERT INTO `cities` VALUES ('1494', '176', '昂昂溪区', '3', '0');
INSERT INTO `cities` VALUES ('1495', '176', '铁峰区', '3', '0');
INSERT INTO `cities` VALUES ('1496', '176', '建华区', '3', '0');
INSERT INTO `cities` VALUES ('1497', '176', '富拉尔基区', '3', '0');
INSERT INTO `cities` VALUES ('1498', '176', '碾子山区', '3', '0');
INSERT INTO `cities` VALUES ('1499', '176', '梅里斯达斡尔区', '3', '0');
INSERT INTO `cities` VALUES ('1500', '176', '讷河市', '3', '0');
INSERT INTO `cities` VALUES ('1501', '176', '龙江县', '3', '0');
INSERT INTO `cities` VALUES ('1502', '176', '依安县', '3', '0');
INSERT INTO `cities` VALUES ('1503', '176', '泰来县', '3', '0');
INSERT INTO `cities` VALUES ('1504', '176', '甘南县', '3', '0');
INSERT INTO `cities` VALUES ('1505', '176', '富裕县', '3', '0');
INSERT INTO `cities` VALUES ('1506', '176', '克山县', '3', '0');
INSERT INTO `cities` VALUES ('1507', '176', '克东县', '3', '0');
INSERT INTO `cities` VALUES ('1508', '176', '拜泉县', '3', '0');
INSERT INTO `cities` VALUES ('1509', '177', '尖山区', '3', '0');
INSERT INTO `cities` VALUES ('1510', '177', '岭东区', '3', '0');
INSERT INTO `cities` VALUES ('1511', '177', '四方台区', '3', '0');
INSERT INTO `cities` VALUES ('1512', '177', '宝山区', '3', '0');
INSERT INTO `cities` VALUES ('1513', '177', '集贤县', '3', '0');
INSERT INTO `cities` VALUES ('1514', '177', '友谊县', '3', '0');
INSERT INTO `cities` VALUES ('1515', '177', '宝清县', '3', '0');
INSERT INTO `cities` VALUES ('1516', '177', '饶河县', '3', '0');
INSERT INTO `cities` VALUES ('1517', '178', '北林区', '3', '0');
INSERT INTO `cities` VALUES ('1518', '178', '安达市', '3', '0');
INSERT INTO `cities` VALUES ('1519', '178', '肇东市', '3', '0');
INSERT INTO `cities` VALUES ('1520', '178', '海伦市', '3', '0');
INSERT INTO `cities` VALUES ('1521', '178', '望奎县', '3', '0');
INSERT INTO `cities` VALUES ('1522', '178', '兰西县', '3', '0');
INSERT INTO `cities` VALUES ('1523', '178', '青冈县', '3', '0');
INSERT INTO `cities` VALUES ('1524', '178', '庆安县', '3', '0');
INSERT INTO `cities` VALUES ('1525', '178', '明水县', '3', '0');
INSERT INTO `cities` VALUES ('1526', '178', '绥棱县', '3', '0');
INSERT INTO `cities` VALUES ('1527', '179', '伊春区', '3', '0');
INSERT INTO `cities` VALUES ('1528', '179', '带岭区', '3', '0');
INSERT INTO `cities` VALUES ('1529', '179', '南岔区', '3', '0');
INSERT INTO `cities` VALUES ('1530', '179', '金山屯区', '3', '0');
INSERT INTO `cities` VALUES ('1531', '179', '西林区', '3', '0');
INSERT INTO `cities` VALUES ('1532', '179', '美溪区', '3', '0');
INSERT INTO `cities` VALUES ('1533', '179', '乌马河区', '3', '0');
INSERT INTO `cities` VALUES ('1534', '179', '翠峦区', '3', '0');
INSERT INTO `cities` VALUES ('1535', '179', '友好区', '3', '0');
INSERT INTO `cities` VALUES ('1536', '179', '上甘岭区', '3', '0');
INSERT INTO `cities` VALUES ('1537', '179', '五营区', '3', '0');
INSERT INTO `cities` VALUES ('1538', '179', '红星区', '3', '0');
INSERT INTO `cities` VALUES ('1539', '179', '新青区', '3', '0');
INSERT INTO `cities` VALUES ('1540', '179', '汤旺河区', '3', '0');
INSERT INTO `cities` VALUES ('1541', '179', '乌伊岭区', '3', '0');
INSERT INTO `cities` VALUES ('1542', '179', '铁力市', '3', '0');
INSERT INTO `cities` VALUES ('1543', '179', '嘉荫县', '3', '0');
INSERT INTO `cities` VALUES ('1544', '180', '江岸区', '3', '0');
INSERT INTO `cities` VALUES ('1545', '180', '武昌区', '3', '0');
INSERT INTO `cities` VALUES ('1546', '180', '江汉区', '3', '0');
INSERT INTO `cities` VALUES ('1547', '180', '硚口区', '3', '0');
INSERT INTO `cities` VALUES ('1548', '180', '汉阳区', '3', '0');
INSERT INTO `cities` VALUES ('1549', '180', '青山区', '3', '0');
INSERT INTO `cities` VALUES ('1550', '180', '洪山区', '3', '0');
INSERT INTO `cities` VALUES ('1551', '180', '东西湖区', '3', '0');
INSERT INTO `cities` VALUES ('1552', '180', '汉南区', '3', '0');
INSERT INTO `cities` VALUES ('1553', '180', '蔡甸区', '3', '0');
INSERT INTO `cities` VALUES ('1554', '180', '江夏区', '3', '0');
INSERT INTO `cities` VALUES ('1555', '180', '黄陂区', '3', '0');
INSERT INTO `cities` VALUES ('1556', '180', '新洲区', '3', '0');
INSERT INTO `cities` VALUES ('1557', '180', '经济开发区', '3', '0');
INSERT INTO `cities` VALUES ('1558', '181', '仙桃市', '3', '0');
INSERT INTO `cities` VALUES ('1559', '182', '鄂城区', '3', '0');
INSERT INTO `cities` VALUES ('1560', '182', '华容区', '3', '0');
INSERT INTO `cities` VALUES ('1561', '182', '梁子湖区', '3', '0');
INSERT INTO `cities` VALUES ('1562', '183', '黄州区', '3', '0');
INSERT INTO `cities` VALUES ('1563', '183', '麻城市', '3', '0');
INSERT INTO `cities` VALUES ('1564', '183', '武穴市', '3', '0');
INSERT INTO `cities` VALUES ('1565', '183', '团风县', '3', '0');
INSERT INTO `cities` VALUES ('1566', '183', '红安县', '3', '0');
INSERT INTO `cities` VALUES ('1567', '183', '罗田县', '3', '0');
INSERT INTO `cities` VALUES ('1568', '183', '英山县', '3', '0');
INSERT INTO `cities` VALUES ('1569', '183', '浠水县', '3', '0');
INSERT INTO `cities` VALUES ('1570', '183', '蕲春县', '3', '0');
INSERT INTO `cities` VALUES ('1571', '183', '黄梅县', '3', '0');
INSERT INTO `cities` VALUES ('1572', '184', '黄石港区', '3', '0');
INSERT INTO `cities` VALUES ('1573', '184', '西塞山区', '3', '0');
INSERT INTO `cities` VALUES ('1574', '184', '下陆区', '3', '0');
INSERT INTO `cities` VALUES ('1575', '184', '铁山区', '3', '0');
INSERT INTO `cities` VALUES ('1576', '184', '大冶市', '3', '0');
INSERT INTO `cities` VALUES ('1577', '184', '阳新县', '3', '0');
INSERT INTO `cities` VALUES ('1578', '185', '东宝区', '3', '0');
INSERT INTO `cities` VALUES ('1579', '185', '掇刀区', '3', '0');
INSERT INTO `cities` VALUES ('1580', '185', '钟祥市', '3', '0');
INSERT INTO `cities` VALUES ('1581', '185', '京山县', '3', '0');
INSERT INTO `cities` VALUES ('1582', '185', '沙洋县', '3', '0');
INSERT INTO `cities` VALUES ('1583', '186', '沙市区', '3', '0');
INSERT INTO `cities` VALUES ('1584', '186', '荆州区', '3', '0');
INSERT INTO `cities` VALUES ('1585', '186', '石首市', '3', '0');
INSERT INTO `cities` VALUES ('1586', '186', '洪湖市', '3', '0');
INSERT INTO `cities` VALUES ('1587', '186', '松滋市', '3', '0');
INSERT INTO `cities` VALUES ('1588', '186', '公安县', '3', '0');
INSERT INTO `cities` VALUES ('1589', '186', '监利县', '3', '0');
INSERT INTO `cities` VALUES ('1590', '186', '江陵县', '3', '0');
INSERT INTO `cities` VALUES ('1591', '187', '潜江市', '3', '0');
INSERT INTO `cities` VALUES ('1592', '188', '神农架林区', '3', '0');
INSERT INTO `cities` VALUES ('1593', '189', '张湾区', '3', '0');
INSERT INTO `cities` VALUES ('1594', '189', '茅箭区', '3', '0');
INSERT INTO `cities` VALUES ('1595', '189', '丹江口市', '3', '0');
INSERT INTO `cities` VALUES ('1596', '189', '郧县', '3', '0');
INSERT INTO `cities` VALUES ('1597', '189', '郧西县', '3', '0');
INSERT INTO `cities` VALUES ('1598', '189', '竹山县', '3', '0');
INSERT INTO `cities` VALUES ('1599', '189', '竹溪县', '3', '0');
INSERT INTO `cities` VALUES ('1600', '189', '房县', '3', '0');
INSERT INTO `cities` VALUES ('1601', '190', '曾都区', '3', '0');
INSERT INTO `cities` VALUES ('1602', '190', '广水市', '3', '0');
INSERT INTO `cities` VALUES ('1603', '191', '天门市', '3', '0');
INSERT INTO `cities` VALUES ('1604', '192', '咸安区', '3', '0');
INSERT INTO `cities` VALUES ('1605', '192', '赤壁市', '3', '0');
INSERT INTO `cities` VALUES ('1606', '192', '嘉鱼县', '3', '0');
INSERT INTO `cities` VALUES ('1607', '192', '通城县', '3', '0');
INSERT INTO `cities` VALUES ('1608', '192', '崇阳县', '3', '0');
INSERT INTO `cities` VALUES ('1609', '192', '通山县', '3', '0');
INSERT INTO `cities` VALUES ('1610', '193', '襄城区', '3', '0');
INSERT INTO `cities` VALUES ('1611', '193', '樊城区', '3', '0');
INSERT INTO `cities` VALUES ('1612', '193', '襄阳区', '3', '0');
INSERT INTO `cities` VALUES ('1613', '193', '老河口市', '3', '0');
INSERT INTO `cities` VALUES ('1614', '193', '枣阳市', '3', '0');
INSERT INTO `cities` VALUES ('1615', '193', '宜城市', '3', '0');
INSERT INTO `cities` VALUES ('1616', '193', '南漳县', '3', '0');
INSERT INTO `cities` VALUES ('1617', '193', '谷城县', '3', '0');
INSERT INTO `cities` VALUES ('1618', '193', '保康县', '3', '0');
INSERT INTO `cities` VALUES ('1619', '194', '孝南区', '3', '0');
INSERT INTO `cities` VALUES ('1620', '194', '应城市', '3', '0');
INSERT INTO `cities` VALUES ('1621', '194', '安陆市', '3', '0');
INSERT INTO `cities` VALUES ('1622', '194', '汉川市', '3', '0');
INSERT INTO `cities` VALUES ('1623', '194', '孝昌县', '3', '0');
INSERT INTO `cities` VALUES ('1624', '194', '大悟县', '3', '0');
INSERT INTO `cities` VALUES ('1625', '194', '云梦县', '3', '0');
INSERT INTO `cities` VALUES ('1626', '195', '长阳', '3', '0');
INSERT INTO `cities` VALUES ('1627', '195', '五峰', '3', '0');
INSERT INTO `cities` VALUES ('1628', '195', '西陵区', '3', '0');
INSERT INTO `cities` VALUES ('1629', '195', '伍家岗区', '3', '0');
INSERT INTO `cities` VALUES ('1630', '195', '点军区', '3', '0');
INSERT INTO `cities` VALUES ('1631', '195', '猇亭区', '3', '0');
INSERT INTO `cities` VALUES ('1632', '195', '夷陵区', '3', '0');
INSERT INTO `cities` VALUES ('1633', '195', '宜都市', '3', '0');
INSERT INTO `cities` VALUES ('1634', '195', '当阳市', '3', '0');
INSERT INTO `cities` VALUES ('1635', '195', '枝江市', '3', '0');
INSERT INTO `cities` VALUES ('1636', '195', '远安县', '3', '0');
INSERT INTO `cities` VALUES ('1637', '195', '兴山县', '3', '0');
INSERT INTO `cities` VALUES ('1638', '195', '秭归县', '3', '0');
INSERT INTO `cities` VALUES ('1639', '196', '恩施市', '3', '0');
INSERT INTO `cities` VALUES ('1640', '196', '利川市', '3', '0');
INSERT INTO `cities` VALUES ('1641', '196', '建始县', '3', '0');
INSERT INTO `cities` VALUES ('1642', '196', '巴东县', '3', '0');
INSERT INTO `cities` VALUES ('1643', '196', '宣恩县', '3', '0');
INSERT INTO `cities` VALUES ('1644', '196', '咸丰县', '3', '0');
INSERT INTO `cities` VALUES ('1645', '196', '来凤县', '3', '0');
INSERT INTO `cities` VALUES ('1646', '196', '鹤峰县', '3', '0');
INSERT INTO `cities` VALUES ('1647', '197', '岳麓区', '3', '0');
INSERT INTO `cities` VALUES ('1648', '197', '芙蓉区', '3', '0');
INSERT INTO `cities` VALUES ('1649', '197', '天心区', '3', '0');
INSERT INTO `cities` VALUES ('1650', '197', '开福区', '3', '0');
INSERT INTO `cities` VALUES ('1651', '197', '雨花区', '3', '0');
INSERT INTO `cities` VALUES ('1652', '197', '开发区', '3', '0');
INSERT INTO `cities` VALUES ('1653', '197', '浏阳市', '3', '0');
INSERT INTO `cities` VALUES ('1654', '197', '长沙县', '3', '0');
INSERT INTO `cities` VALUES ('1655', '197', '望城县', '3', '0');
INSERT INTO `cities` VALUES ('1656', '197', '宁乡县', '3', '0');
INSERT INTO `cities` VALUES ('1657', '198', '永定区', '3', '0');
INSERT INTO `cities` VALUES ('1658', '198', '武陵源区', '3', '0');
INSERT INTO `cities` VALUES ('1659', '198', '慈利县', '3', '0');
INSERT INTO `cities` VALUES ('1660', '198', '桑植县', '3', '0');
INSERT INTO `cities` VALUES ('1661', '199', '武陵区', '3', '0');
INSERT INTO `cities` VALUES ('1662', '199', '鼎城区', '3', '0');
INSERT INTO `cities` VALUES ('1663', '199', '津市市', '3', '0');
INSERT INTO `cities` VALUES ('1664', '199', '安乡县', '3', '0');
INSERT INTO `cities` VALUES ('1665', '199', '汉寿县', '3', '0');
INSERT INTO `cities` VALUES ('1666', '199', '澧县', '3', '0');
INSERT INTO `cities` VALUES ('1667', '199', '临澧县', '3', '0');
INSERT INTO `cities` VALUES ('1668', '199', '桃源县', '3', '0');
INSERT INTO `cities` VALUES ('1669', '199', '石门县', '3', '0');
INSERT INTO `cities` VALUES ('1670', '200', '北湖区', '3', '0');
INSERT INTO `cities` VALUES ('1671', '200', '苏仙区', '3', '0');
INSERT INTO `cities` VALUES ('1672', '200', '资兴市', '3', '0');
INSERT INTO `cities` VALUES ('1673', '200', '桂阳县', '3', '0');
INSERT INTO `cities` VALUES ('1674', '200', '宜章县', '3', '0');
INSERT INTO `cities` VALUES ('1675', '200', '永兴县', '3', '0');
INSERT INTO `cities` VALUES ('1676', '200', '嘉禾县', '3', '0');
INSERT INTO `cities` VALUES ('1677', '200', '临武县', '3', '0');
INSERT INTO `cities` VALUES ('1678', '200', '汝城县', '3', '0');
INSERT INTO `cities` VALUES ('1679', '200', '桂东县', '3', '0');
INSERT INTO `cities` VALUES ('1680', '200', '安仁县', '3', '0');
INSERT INTO `cities` VALUES ('1681', '201', '雁峰区', '3', '0');
INSERT INTO `cities` VALUES ('1682', '201', '珠晖区', '3', '0');
INSERT INTO `cities` VALUES ('1683', '201', '石鼓区', '3', '0');
INSERT INTO `cities` VALUES ('1684', '201', '蒸湘区', '3', '0');
INSERT INTO `cities` VALUES ('1685', '201', '南岳区', '3', '0');
INSERT INTO `cities` VALUES ('1686', '201', '耒阳市', '3', '0');
INSERT INTO `cities` VALUES ('1687', '201', '常宁市', '3', '0');
INSERT INTO `cities` VALUES ('1688', '201', '衡阳县', '3', '0');
INSERT INTO `cities` VALUES ('1689', '201', '衡南县', '3', '0');
INSERT INTO `cities` VALUES ('1690', '201', '衡山县', '3', '0');
INSERT INTO `cities` VALUES ('1691', '201', '衡东县', '3', '0');
INSERT INTO `cities` VALUES ('1692', '201', '祁东县', '3', '0');
INSERT INTO `cities` VALUES ('1693', '202', '鹤城区', '3', '0');
INSERT INTO `cities` VALUES ('1694', '202', '靖州', '3', '0');
INSERT INTO `cities` VALUES ('1695', '202', '麻阳', '3', '0');
INSERT INTO `cities` VALUES ('1696', '202', '通道', '3', '0');
INSERT INTO `cities` VALUES ('1697', '202', '新晃', '3', '0');
INSERT INTO `cities` VALUES ('1698', '202', '芷江', '3', '0');
INSERT INTO `cities` VALUES ('1699', '202', '沅陵县', '3', '0');
INSERT INTO `cities` VALUES ('1700', '202', '辰溪县', '3', '0');
INSERT INTO `cities` VALUES ('1701', '202', '溆浦县', '3', '0');
INSERT INTO `cities` VALUES ('1702', '202', '中方县', '3', '0');
INSERT INTO `cities` VALUES ('1703', '202', '会同县', '3', '0');
INSERT INTO `cities` VALUES ('1704', '202', '洪江市', '3', '0');
INSERT INTO `cities` VALUES ('1705', '203', '娄星区', '3', '0');
INSERT INTO `cities` VALUES ('1706', '203', '冷水江市', '3', '0');
INSERT INTO `cities` VALUES ('1707', '203', '涟源市', '3', '0');
INSERT INTO `cities` VALUES ('1708', '203', '双峰县', '3', '0');
INSERT INTO `cities` VALUES ('1709', '203', '新化县', '3', '0');
INSERT INTO `cities` VALUES ('1710', '204', '城步', '3', '0');
INSERT INTO `cities` VALUES ('1711', '204', '双清区', '3', '0');
INSERT INTO `cities` VALUES ('1712', '204', '大祥区', '3', '0');
INSERT INTO `cities` VALUES ('1713', '204', '北塔区', '3', '0');
INSERT INTO `cities` VALUES ('1714', '204', '武冈市', '3', '0');
INSERT INTO `cities` VALUES ('1715', '204', '邵东县', '3', '0');
INSERT INTO `cities` VALUES ('1716', '204', '新邵县', '3', '0');
INSERT INTO `cities` VALUES ('1717', '204', '邵阳县', '3', '0');
INSERT INTO `cities` VALUES ('1718', '204', '隆回县', '3', '0');
INSERT INTO `cities` VALUES ('1719', '204', '洞口县', '3', '0');
INSERT INTO `cities` VALUES ('1720', '204', '绥宁县', '3', '0');
INSERT INTO `cities` VALUES ('1721', '204', '新宁县', '3', '0');
INSERT INTO `cities` VALUES ('1722', '205', '岳塘区', '3', '0');
INSERT INTO `cities` VALUES ('1723', '205', '雨湖区', '3', '0');
INSERT INTO `cities` VALUES ('1724', '205', '湘乡市', '3', '0');
INSERT INTO `cities` VALUES ('1725', '205', '韶山市', '3', '0');
INSERT INTO `cities` VALUES ('1726', '205', '湘潭县', '3', '0');
INSERT INTO `cities` VALUES ('1727', '206', '吉首市', '3', '0');
INSERT INTO `cities` VALUES ('1728', '206', '泸溪县', '3', '0');
INSERT INTO `cities` VALUES ('1729', '206', '凤凰县', '3', '0');
INSERT INTO `cities` VALUES ('1730', '206', '花垣县', '3', '0');
INSERT INTO `cities` VALUES ('1731', '206', '保靖县', '3', '0');
INSERT INTO `cities` VALUES ('1732', '206', '古丈县', '3', '0');
INSERT INTO `cities` VALUES ('1733', '206', '永顺县', '3', '0');
INSERT INTO `cities` VALUES ('1734', '206', '龙山县', '3', '0');
INSERT INTO `cities` VALUES ('1735', '207', '赫山区', '3', '0');
INSERT INTO `cities` VALUES ('1736', '207', '资阳区', '3', '0');
INSERT INTO `cities` VALUES ('1737', '207', '沅江市', '3', '0');
INSERT INTO `cities` VALUES ('1738', '207', '南县', '3', '0');
INSERT INTO `cities` VALUES ('1739', '207', '桃江县', '3', '0');
INSERT INTO `cities` VALUES ('1740', '207', '安化县', '3', '0');
INSERT INTO `cities` VALUES ('1741', '208', '江华', '3', '0');
INSERT INTO `cities` VALUES ('1742', '208', '冷水滩区', '3', '0');
INSERT INTO `cities` VALUES ('1743', '208', '零陵区', '3', '0');
INSERT INTO `cities` VALUES ('1744', '208', '祁阳县', '3', '0');
INSERT INTO `cities` VALUES ('1745', '208', '东安县', '3', '0');
INSERT INTO `cities` VALUES ('1746', '208', '双牌县', '3', '0');
INSERT INTO `cities` VALUES ('1747', '208', '道县', '3', '0');
INSERT INTO `cities` VALUES ('1748', '208', '江永县', '3', '0');
INSERT INTO `cities` VALUES ('1749', '208', '宁远县', '3', '0');
INSERT INTO `cities` VALUES ('1750', '208', '蓝山县', '3', '0');
INSERT INTO `cities` VALUES ('1751', '208', '新田县', '3', '0');
INSERT INTO `cities` VALUES ('1752', '209', '岳阳楼区', '3', '0');
INSERT INTO `cities` VALUES ('1753', '209', '君山区', '3', '0');
INSERT INTO `cities` VALUES ('1754', '209', '云溪区', '3', '0');
INSERT INTO `cities` VALUES ('1755', '209', '汨罗市', '3', '0');
INSERT INTO `cities` VALUES ('1756', '209', '临湘市', '3', '0');
INSERT INTO `cities` VALUES ('1757', '209', '岳阳县', '3', '0');
INSERT INTO `cities` VALUES ('1758', '209', '华容县', '3', '0');
INSERT INTO `cities` VALUES ('1759', '209', '湘阴县', '3', '0');
INSERT INTO `cities` VALUES ('1760', '209', '平江县', '3', '0');
INSERT INTO `cities` VALUES ('1761', '210', '天元区', '3', '0');
INSERT INTO `cities` VALUES ('1762', '210', '荷塘区', '3', '0');
INSERT INTO `cities` VALUES ('1763', '210', '芦淞区', '3', '0');
INSERT INTO `cities` VALUES ('1764', '210', '石峰区', '3', '0');
INSERT INTO `cities` VALUES ('1765', '210', '醴陵市', '3', '0');
INSERT INTO `cities` VALUES ('1766', '210', '株洲县', '3', '0');
INSERT INTO `cities` VALUES ('1767', '210', '攸县', '3', '0');
INSERT INTO `cities` VALUES ('1768', '210', '茶陵县', '3', '0');
INSERT INTO `cities` VALUES ('1769', '210', '炎陵县', '3', '0');
INSERT INTO `cities` VALUES ('1770', '211', '朝阳区', '3', '0');
INSERT INTO `cities` VALUES ('1771', '211', '宽城区', '3', '0');
INSERT INTO `cities` VALUES ('1772', '211', '二道区', '3', '0');
INSERT INTO `cities` VALUES ('1773', '211', '南关区', '3', '0');
INSERT INTO `cities` VALUES ('1774', '211', '绿园区', '3', '0');
INSERT INTO `cities` VALUES ('1775', '211', '双阳区', '3', '0');
INSERT INTO `cities` VALUES ('1776', '211', '净月潭开发区', '3', '0');
INSERT INTO `cities` VALUES ('1777', '211', '高新技术开发区', '3', '0');
INSERT INTO `cities` VALUES ('1778', '211', '经济技术开发区', '3', '0');
INSERT INTO `cities` VALUES ('1779', '211', '汽车产业开发区', '3', '0');
INSERT INTO `cities` VALUES ('1780', '211', '德惠市', '3', '0');
INSERT INTO `cities` VALUES ('1781', '211', '九台市', '3', '0');
INSERT INTO `cities` VALUES ('1782', '211', '榆树市', '3', '0');
INSERT INTO `cities` VALUES ('1783', '211', '农安县', '3', '0');
INSERT INTO `cities` VALUES ('1784', '212', '船营区', '3', '0');
INSERT INTO `cities` VALUES ('1785', '212', '昌邑区', '3', '0');
INSERT INTO `cities` VALUES ('1786', '212', '龙潭区', '3', '0');
INSERT INTO `cities` VALUES ('1787', '212', '丰满区', '3', '0');
INSERT INTO `cities` VALUES ('1788', '212', '蛟河市', '3', '0');
INSERT INTO `cities` VALUES ('1789', '212', '桦甸市', '3', '0');
INSERT INTO `cities` VALUES ('1790', '212', '舒兰市', '3', '0');
INSERT INTO `cities` VALUES ('1791', '212', '磐石市', '3', '0');
INSERT INTO `cities` VALUES ('1792', '212', '永吉县', '3', '0');
INSERT INTO `cities` VALUES ('1793', '213', '洮北区', '3', '0');
INSERT INTO `cities` VALUES ('1794', '213', '洮南市', '3', '0');
INSERT INTO `cities` VALUES ('1795', '213', '大安市', '3', '0');
INSERT INTO `cities` VALUES ('1796', '213', '镇赉县', '3', '0');
INSERT INTO `cities` VALUES ('1797', '213', '通榆县', '3', '0');
INSERT INTO `cities` VALUES ('1798', '214', '江源区', '3', '0');
INSERT INTO `cities` VALUES ('1799', '214', '八道江区', '3', '0');
INSERT INTO `cities` VALUES ('1800', '214', '长白', '3', '0');
INSERT INTO `cities` VALUES ('1801', '214', '临江市', '3', '0');
INSERT INTO `cities` VALUES ('1802', '214', '抚松县', '3', '0');
INSERT INTO `cities` VALUES ('1803', '214', '靖宇县', '3', '0');
INSERT INTO `cities` VALUES ('1804', '215', '龙山区', '3', '0');
INSERT INTO `cities` VALUES ('1805', '215', '西安区', '3', '0');
INSERT INTO `cities` VALUES ('1806', '215', '东丰县', '3', '0');
INSERT INTO `cities` VALUES ('1807', '215', '东辽县', '3', '0');
INSERT INTO `cities` VALUES ('1808', '216', '铁西区', '3', '0');
INSERT INTO `cities` VALUES ('1809', '216', '铁东区', '3', '0');
INSERT INTO `cities` VALUES ('1810', '216', '伊通', '3', '0');
INSERT INTO `cities` VALUES ('1811', '216', '公主岭市', '3', '0');
INSERT INTO `cities` VALUES ('1812', '216', '双辽市', '3', '0');
INSERT INTO `cities` VALUES ('1813', '216', '梨树县', '3', '0');
INSERT INTO `cities` VALUES ('1814', '217', '前郭尔罗斯', '3', '0');
INSERT INTO `cities` VALUES ('1815', '217', '宁江区', '3', '0');
INSERT INTO `cities` VALUES ('1816', '217', '长岭县', '3', '0');
INSERT INTO `cities` VALUES ('1817', '217', '乾安县', '3', '0');
INSERT INTO `cities` VALUES ('1818', '217', '扶余县', '3', '0');
INSERT INTO `cities` VALUES ('1819', '218', '东昌区', '3', '0');
INSERT INTO `cities` VALUES ('1820', '218', '二道江区', '3', '0');
INSERT INTO `cities` VALUES ('1821', '218', '梅河口市', '3', '0');
INSERT INTO `cities` VALUES ('1822', '218', '集安市', '3', '0');
INSERT INTO `cities` VALUES ('1823', '218', '通化县', '3', '0');
INSERT INTO `cities` VALUES ('1824', '218', '辉南县', '3', '0');
INSERT INTO `cities` VALUES ('1825', '218', '柳河县', '3', '0');
INSERT INTO `cities` VALUES ('1826', '219', '延吉市', '3', '0');
INSERT INTO `cities` VALUES ('1827', '219', '图们市', '3', '0');
INSERT INTO `cities` VALUES ('1828', '219', '敦化市', '3', '0');
INSERT INTO `cities` VALUES ('1829', '219', '珲春市', '3', '0');
INSERT INTO `cities` VALUES ('1830', '219', '龙井市', '3', '0');
INSERT INTO `cities` VALUES ('1831', '219', '和龙市', '3', '0');
INSERT INTO `cities` VALUES ('1832', '219', '安图县', '3', '0');
INSERT INTO `cities` VALUES ('1833', '219', '汪清县', '3', '0');
INSERT INTO `cities` VALUES ('1834', '220', '玄武区', '3', '0');
INSERT INTO `cities` VALUES ('1835', '220', '鼓楼区', '3', '0');
INSERT INTO `cities` VALUES ('1836', '220', '白下区', '3', '0');
INSERT INTO `cities` VALUES ('1837', '220', '建邺区', '3', '0');
INSERT INTO `cities` VALUES ('1838', '220', '秦淮区', '3', '0');
INSERT INTO `cities` VALUES ('1839', '220', '雨花台区', '3', '0');
INSERT INTO `cities` VALUES ('1840', '220', '下关区', '3', '0');
INSERT INTO `cities` VALUES ('1841', '220', '栖霞区', '3', '0');
INSERT INTO `cities` VALUES ('1842', '220', '浦口区', '3', '0');
INSERT INTO `cities` VALUES ('1843', '220', '江宁区', '3', '0');
INSERT INTO `cities` VALUES ('1844', '220', '六合区', '3', '0');
INSERT INTO `cities` VALUES ('1845', '220', '溧水县', '3', '0');
INSERT INTO `cities` VALUES ('1846', '220', '高淳县', '3', '0');
INSERT INTO `cities` VALUES ('1847', '221', '沧浪区', '3', '0');
INSERT INTO `cities` VALUES ('1848', '221', '金阊区', '3', '0');
INSERT INTO `cities` VALUES ('1849', '221', '平江区', '3', '0');
INSERT INTO `cities` VALUES ('1850', '221', '虎丘区', '3', '0');
INSERT INTO `cities` VALUES ('1851', '221', '吴中区', '3', '0');
INSERT INTO `cities` VALUES ('1852', '221', '相城区', '3', '0');
INSERT INTO `cities` VALUES ('1853', '221', '园区', '3', '0');
INSERT INTO `cities` VALUES ('1854', '221', '新区', '3', '0');
INSERT INTO `cities` VALUES ('1855', '221', '常熟市', '3', '0');
INSERT INTO `cities` VALUES ('1856', '221', '张家港市', '3', '0');
INSERT INTO `cities` VALUES ('1857', '221', '玉山镇', '3', '0');
INSERT INTO `cities` VALUES ('1858', '221', '巴城镇', '3', '0');
INSERT INTO `cities` VALUES ('1859', '221', '周市镇', '3', '0');
INSERT INTO `cities` VALUES ('1860', '221', '陆家镇', '3', '0');
INSERT INTO `cities` VALUES ('1861', '221', '花桥镇', '3', '0');
INSERT INTO `cities` VALUES ('1862', '221', '淀山湖镇', '3', '0');
INSERT INTO `cities` VALUES ('1863', '221', '张浦镇', '3', '0');
INSERT INTO `cities` VALUES ('1864', '221', '周庄镇', '3', '0');
INSERT INTO `cities` VALUES ('1865', '221', '千灯镇', '3', '0');
INSERT INTO `cities` VALUES ('1866', '221', '锦溪镇', '3', '0');
INSERT INTO `cities` VALUES ('1867', '221', '开发区', '3', '0');
INSERT INTO `cities` VALUES ('1868', '221', '吴江市', '3', '0');
INSERT INTO `cities` VALUES ('1869', '221', '太仓市', '3', '0');
INSERT INTO `cities` VALUES ('1870', '222', '崇安区', '3', '0');
INSERT INTO `cities` VALUES ('1871', '222', '北塘区', '3', '0');
INSERT INTO `cities` VALUES ('1872', '222', '南长区', '3', '0');
INSERT INTO `cities` VALUES ('1873', '222', '锡山区', '3', '0');
INSERT INTO `cities` VALUES ('1874', '222', '惠山区', '3', '0');
INSERT INTO `cities` VALUES ('1875', '222', '滨湖区', '3', '0');
INSERT INTO `cities` VALUES ('1876', '222', '新区', '3', '0');
INSERT INTO `cities` VALUES ('1877', '222', '江阴市', '3', '0');
INSERT INTO `cities` VALUES ('1878', '222', '宜兴市', '3', '0');
INSERT INTO `cities` VALUES ('1879', '223', '天宁区', '3', '0');
INSERT INTO `cities` VALUES ('1880', '223', '钟楼区', '3', '0');
INSERT INTO `cities` VALUES ('1881', '223', '戚墅堰区', '3', '0');
INSERT INTO `cities` VALUES ('1882', '223', '郊区', '3', '0');
INSERT INTO `cities` VALUES ('1883', '223', '新北区', '3', '0');
INSERT INTO `cities` VALUES ('1884', '223', '武进区', '3', '0');
INSERT INTO `cities` VALUES ('1885', '223', '溧阳市', '3', '0');
INSERT INTO `cities` VALUES ('1886', '223', '金坛市', '3', '0');
INSERT INTO `cities` VALUES ('1887', '224', '清河区', '3', '0');
INSERT INTO `cities` VALUES ('1888', '224', '清浦区', '3', '0');
INSERT INTO `cities` VALUES ('1889', '224', '楚州区', '3', '0');
INSERT INTO `cities` VALUES ('1890', '224', '淮阴区', '3', '0');
INSERT INTO `cities` VALUES ('1891', '224', '涟水县', '3', '0');
INSERT INTO `cities` VALUES ('1892', '224', '洪泽县', '3', '0');
INSERT INTO `cities` VALUES ('1893', '224', '盱眙县', '3', '0');
INSERT INTO `cities` VALUES ('1894', '224', '金湖县', '3', '0');
INSERT INTO `cities` VALUES ('1895', '225', '新浦区', '3', '0');
INSERT INTO `cities` VALUES ('1896', '225', '连云区', '3', '0');
INSERT INTO `cities` VALUES ('1897', '225', '海州区', '3', '0');
INSERT INTO `cities` VALUES ('1898', '225', '赣榆县', '3', '0');
INSERT INTO `cities` VALUES ('1899', '225', '东海县', '3', '0');
INSERT INTO `cities` VALUES ('1900', '225', '灌云县', '3', '0');
INSERT INTO `cities` VALUES ('1901', '225', '灌南县', '3', '0');
INSERT INTO `cities` VALUES ('1902', '226', '崇川区', '3', '0');
INSERT INTO `cities` VALUES ('1903', '226', '港闸区', '3', '0');
INSERT INTO `cities` VALUES ('1904', '226', '经济开发区', '3', '0');
INSERT INTO `cities` VALUES ('1905', '226', '启东市', '3', '0');
INSERT INTO `cities` VALUES ('1906', '226', '如皋市', '3', '0');
INSERT INTO `cities` VALUES ('1907', '226', '通州市', '3', '0');
INSERT INTO `cities` VALUES ('1908', '226', '海门市', '3', '0');
INSERT INTO `cities` VALUES ('1909', '226', '海安县', '3', '0');
INSERT INTO `cities` VALUES ('1910', '226', '如东县', '3', '0');
INSERT INTO `cities` VALUES ('1911', '227', '宿城区', '3', '0');
INSERT INTO `cities` VALUES ('1912', '227', '宿豫区', '3', '0');
INSERT INTO `cities` VALUES ('1913', '227', '宿豫县', '3', '0');
INSERT INTO `cities` VALUES ('1914', '227', '沭阳县', '3', '0');
INSERT INTO `cities` VALUES ('1915', '227', '泗阳县', '3', '0');
INSERT INTO `cities` VALUES ('1916', '227', '泗洪县', '3', '0');
INSERT INTO `cities` VALUES ('1917', '228', '海陵区', '3', '0');
INSERT INTO `cities` VALUES ('1918', '228', '高港区', '3', '0');
INSERT INTO `cities` VALUES ('1919', '228', '兴化市', '3', '0');
INSERT INTO `cities` VALUES ('1920', '228', '靖江市', '3', '0');
INSERT INTO `cities` VALUES ('1921', '228', '泰兴市', '3', '0');
INSERT INTO `cities` VALUES ('1922', '228', '姜堰市', '3', '0');
INSERT INTO `cities` VALUES ('1923', '229', '云龙区', '3', '0');
INSERT INTO `cities` VALUES ('1924', '229', '鼓楼区', '3', '0');
INSERT INTO `cities` VALUES ('1925', '229', '九里区', '3', '0');
INSERT INTO `cities` VALUES ('1926', '229', '贾汪区', '3', '0');
INSERT INTO `cities` VALUES ('1927', '229', '泉山区', '3', '0');
INSERT INTO `cities` VALUES ('1928', '229', '新沂市', '3', '0');
INSERT INTO `cities` VALUES ('1929', '229', '邳州市', '3', '0');
INSERT INTO `cities` VALUES ('1930', '229', '丰县', '3', '0');
INSERT INTO `cities` VALUES ('1931', '229', '沛县', '3', '0');
INSERT INTO `cities` VALUES ('1932', '229', '铜山县', '3', '0');
INSERT INTO `cities` VALUES ('1933', '229', '睢宁县', '3', '0');
INSERT INTO `cities` VALUES ('1934', '230', '城区', '3', '0');
INSERT INTO `cities` VALUES ('1935', '230', '亭湖区', '3', '0');
INSERT INTO `cities` VALUES ('1936', '230', '盐都区', '3', '0');
INSERT INTO `cities` VALUES ('1937', '230', '盐都县', '3', '0');
INSERT INTO `cities` VALUES ('1938', '230', '东台市', '3', '0');
INSERT INTO `cities` VALUES ('1939', '230', '大丰市', '3', '0');
INSERT INTO `cities` VALUES ('1940', '230', '响水县', '3', '0');
INSERT INTO `cities` VALUES ('1941', '230', '滨海县', '3', '0');
INSERT INTO `cities` VALUES ('1942', '230', '阜宁县', '3', '0');
INSERT INTO `cities` VALUES ('1943', '230', '射阳县', '3', '0');
INSERT INTO `cities` VALUES ('1944', '230', '建湖县', '3', '0');
INSERT INTO `cities` VALUES ('1945', '231', '广陵区', '3', '0');
INSERT INTO `cities` VALUES ('1946', '231', '维扬区', '3', '0');
INSERT INTO `cities` VALUES ('1947', '231', '邗江区', '3', '0');
INSERT INTO `cities` VALUES ('1948', '231', '仪征市', '3', '0');
INSERT INTO `cities` VALUES ('1949', '231', '高邮市', '3', '0');
INSERT INTO `cities` VALUES ('1950', '231', '江都市', '3', '0');
INSERT INTO `cities` VALUES ('1951', '231', '宝应县', '3', '0');
INSERT INTO `cities` VALUES ('1952', '232', '京口区', '3', '0');
INSERT INTO `cities` VALUES ('1953', '232', '润州区', '3', '0');
INSERT INTO `cities` VALUES ('1954', '232', '丹徒区', '3', '0');
INSERT INTO `cities` VALUES ('1955', '232', '丹阳市', '3', '0');
INSERT INTO `cities` VALUES ('1956', '232', '扬中市', '3', '0');
INSERT INTO `cities` VALUES ('1957', '232', '句容市', '3', '0');
INSERT INTO `cities` VALUES ('1958', '233', '东湖区', '3', '0');
INSERT INTO `cities` VALUES ('1959', '233', '西湖区', '3', '0');
INSERT INTO `cities` VALUES ('1960', '233', '青云谱区', '3', '0');
INSERT INTO `cities` VALUES ('1961', '233', '湾里区', '3', '0');
INSERT INTO `cities` VALUES ('1962', '233', '青山湖区', '3', '0');
INSERT INTO `cities` VALUES ('1963', '233', '红谷滩新区', '3', '0');
INSERT INTO `cities` VALUES ('1964', '233', '昌北区', '3', '0');
INSERT INTO `cities` VALUES ('1965', '233', '高新区', '3', '0');
INSERT INTO `cities` VALUES ('1966', '233', '南昌县', '3', '0');
INSERT INTO `cities` VALUES ('1967', '233', '新建县', '3', '0');
INSERT INTO `cities` VALUES ('1968', '233', '安义县', '3', '0');
INSERT INTO `cities` VALUES ('1969', '233', '进贤县', '3', '0');
INSERT INTO `cities` VALUES ('1970', '234', '临川区', '3', '0');
INSERT INTO `cities` VALUES ('1971', '234', '南城县', '3', '0');
INSERT INTO `cities` VALUES ('1972', '234', '黎川县', '3', '0');
INSERT INTO `cities` VALUES ('1973', '234', '南丰县', '3', '0');
INSERT INTO `cities` VALUES ('1974', '234', '崇仁县', '3', '0');
INSERT INTO `cities` VALUES ('1975', '234', '乐安县', '3', '0');
INSERT INTO `cities` VALUES ('1976', '234', '宜黄县', '3', '0');
INSERT INTO `cities` VALUES ('1977', '234', '金溪县', '3', '0');
INSERT INTO `cities` VALUES ('1978', '234', '资溪县', '3', '0');
INSERT INTO `cities` VALUES ('1979', '234', '东乡县', '3', '0');
INSERT INTO `cities` VALUES ('1980', '234', '广昌县', '3', '0');
INSERT INTO `cities` VALUES ('1981', '235', '章贡区', '3', '0');
INSERT INTO `cities` VALUES ('1982', '235', '于都县', '3', '0');
INSERT INTO `cities` VALUES ('1983', '235', '瑞金市', '3', '0');
INSERT INTO `cities` VALUES ('1984', '235', '南康市', '3', '0');
INSERT INTO `cities` VALUES ('1985', '235', '赣县', '3', '0');
INSERT INTO `cities` VALUES ('1986', '235', '信丰县', '3', '0');
INSERT INTO `cities` VALUES ('1987', '235', '大余县', '3', '0');
INSERT INTO `cities` VALUES ('1988', '235', '上犹县', '3', '0');
INSERT INTO `cities` VALUES ('1989', '235', '崇义县', '3', '0');
INSERT INTO `cities` VALUES ('1990', '235', '安远县', '3', '0');
INSERT INTO `cities` VALUES ('1991', '235', '龙南县', '3', '0');
INSERT INTO `cities` VALUES ('1992', '235', '定南县', '3', '0');
INSERT INTO `cities` VALUES ('1993', '235', '全南县', '3', '0');
INSERT INTO `cities` VALUES ('1994', '235', '宁都县', '3', '0');
INSERT INTO `cities` VALUES ('1995', '235', '兴国县', '3', '0');
INSERT INTO `cities` VALUES ('1996', '235', '会昌县', '3', '0');
INSERT INTO `cities` VALUES ('1997', '235', '寻乌县', '3', '0');
INSERT INTO `cities` VALUES ('1998', '235', '石城县', '3', '0');
INSERT INTO `cities` VALUES ('1999', '236', '安福县', '3', '0');
INSERT INTO `cities` VALUES ('2000', '236', '吉州区', '3', '0');
INSERT INTO `cities` VALUES ('2001', '236', '青原区', '3', '0');
INSERT INTO `cities` VALUES ('2002', '236', '井冈山市', '3', '0');
INSERT INTO `cities` VALUES ('2003', '236', '吉安县', '3', '0');
INSERT INTO `cities` VALUES ('2004', '236', '吉水县', '3', '0');
INSERT INTO `cities` VALUES ('2005', '236', '峡江县', '3', '0');
INSERT INTO `cities` VALUES ('2006', '236', '新干县', '3', '0');
INSERT INTO `cities` VALUES ('2007', '236', '永丰县', '3', '0');
INSERT INTO `cities` VALUES ('2008', '236', '泰和县', '3', '0');
INSERT INTO `cities` VALUES ('2009', '236', '遂川县', '3', '0');
INSERT INTO `cities` VALUES ('2010', '236', '万安县', '3', '0');
INSERT INTO `cities` VALUES ('2011', '236', '永新县', '3', '0');
INSERT INTO `cities` VALUES ('2012', '237', '珠山区', '3', '0');
INSERT INTO `cities` VALUES ('2013', '237', '昌江区', '3', '0');
INSERT INTO `cities` VALUES ('2014', '237', '乐平市', '3', '0');
INSERT INTO `cities` VALUES ('2015', '237', '浮梁县', '3', '0');
INSERT INTO `cities` VALUES ('2016', '238', '浔阳区', '3', '0');
INSERT INTO `cities` VALUES ('2017', '238', '庐山区', '3', '0');
INSERT INTO `cities` VALUES ('2018', '238', '瑞昌市', '3', '0');
INSERT INTO `cities` VALUES ('2019', '238', '九江县', '3', '0');
INSERT INTO `cities` VALUES ('2020', '238', '武宁县', '3', '0');
INSERT INTO `cities` VALUES ('2021', '238', '修水县', '3', '0');
INSERT INTO `cities` VALUES ('2022', '238', '永修县', '3', '0');
INSERT INTO `cities` VALUES ('2023', '238', '德安县', '3', '0');
INSERT INTO `cities` VALUES ('2024', '238', '星子县', '3', '0');
INSERT INTO `cities` VALUES ('2025', '238', '都昌县', '3', '0');
INSERT INTO `cities` VALUES ('2026', '238', '湖口县', '3', '0');
INSERT INTO `cities` VALUES ('2027', '238', '彭泽县', '3', '0');
INSERT INTO `cities` VALUES ('2028', '239', '安源区', '3', '0');
INSERT INTO `cities` VALUES ('2029', '239', '湘东区', '3', '0');
INSERT INTO `cities` VALUES ('2030', '239', '莲花县', '3', '0');
INSERT INTO `cities` VALUES ('2031', '239', '芦溪县', '3', '0');
INSERT INTO `cities` VALUES ('2032', '239', '上栗县', '3', '0');
INSERT INTO `cities` VALUES ('2033', '240', '信州区', '3', '0');
INSERT INTO `cities` VALUES ('2034', '240', '德兴市', '3', '0');
INSERT INTO `cities` VALUES ('2035', '240', '上饶县', '3', '0');
INSERT INTO `cities` VALUES ('2036', '240', '广丰县', '3', '0');
INSERT INTO `cities` VALUES ('2037', '240', '玉山县', '3', '0');
INSERT INTO `cities` VALUES ('2038', '240', '铅山县', '3', '0');
INSERT INTO `cities` VALUES ('2039', '240', '横峰县', '3', '0');
INSERT INTO `cities` VALUES ('2040', '240', '弋阳县', '3', '0');
INSERT INTO `cities` VALUES ('2041', '240', '余干县', '3', '0');
INSERT INTO `cities` VALUES ('2042', '240', '波阳县', '3', '0');
INSERT INTO `cities` VALUES ('2043', '240', '万年县', '3', '0');
INSERT INTO `cities` VALUES ('2044', '240', '婺源县', '3', '0');
INSERT INTO `cities` VALUES ('2045', '241', '渝水区', '3', '0');
INSERT INTO `cities` VALUES ('2046', '241', '分宜县', '3', '0');
INSERT INTO `cities` VALUES ('2047', '242', '袁州区', '3', '0');
INSERT INTO `cities` VALUES ('2048', '242', '丰城市', '3', '0');
INSERT INTO `cities` VALUES ('2049', '242', '樟树市', '3', '0');
INSERT INTO `cities` VALUES ('2050', '242', '高安市', '3', '0');
INSERT INTO `cities` VALUES ('2051', '242', '奉新县', '3', '0');
INSERT INTO `cities` VALUES ('2052', '242', '万载县', '3', '0');
INSERT INTO `cities` VALUES ('2053', '242', '上高县', '3', '0');
INSERT INTO `cities` VALUES ('2054', '242', '宜丰县', '3', '0');
INSERT INTO `cities` VALUES ('2055', '242', '靖安县', '3', '0');
INSERT INTO `cities` VALUES ('2056', '242', '铜鼓县', '3', '0');
INSERT INTO `cities` VALUES ('2057', '243', '月湖区', '3', '0');
INSERT INTO `cities` VALUES ('2058', '243', '贵溪市', '3', '0');
INSERT INTO `cities` VALUES ('2059', '243', '余江县', '3', '0');
INSERT INTO `cities` VALUES ('2060', '244', '沈河区', '3', '0');
INSERT INTO `cities` VALUES ('2061', '244', '皇姑区', '3', '0');
INSERT INTO `cities` VALUES ('2062', '244', '和平区', '3', '0');
INSERT INTO `cities` VALUES ('2063', '244', '大东区', '3', '0');
INSERT INTO `cities` VALUES ('2064', '244', '铁西区', '3', '0');
INSERT INTO `cities` VALUES ('2065', '244', '苏家屯区', '3', '0');
INSERT INTO `cities` VALUES ('2066', '244', '东陵区', '3', '0');
INSERT INTO `cities` VALUES ('2067', '244', '沈北新区', '3', '0');
INSERT INTO `cities` VALUES ('2068', '244', '于洪区', '3', '0');
INSERT INTO `cities` VALUES ('2069', '244', '浑南新区', '3', '0');
INSERT INTO `cities` VALUES ('2070', '244', '新民市', '3', '0');
INSERT INTO `cities` VALUES ('2071', '244', '辽中县', '3', '0');
INSERT INTO `cities` VALUES ('2072', '244', '康平县', '3', '0');
INSERT INTO `cities` VALUES ('2073', '244', '法库县', '3', '0');
INSERT INTO `cities` VALUES ('2074', '245', '西岗区', '3', '0');
INSERT INTO `cities` VALUES ('2075', '245', '中山区', '3', '0');
INSERT INTO `cities` VALUES ('2076', '245', '沙河口区', '3', '0');
INSERT INTO `cities` VALUES ('2077', '245', '甘井子区', '3', '0');
INSERT INTO `cities` VALUES ('2078', '245', '旅顺口区', '3', '0');
INSERT INTO `cities` VALUES ('2079', '245', '金州区', '3', '0');
INSERT INTO `cities` VALUES ('2080', '245', '开发区', '3', '0');
INSERT INTO `cities` VALUES ('2081', '245', '瓦房店市', '3', '0');
INSERT INTO `cities` VALUES ('2082', '245', '普兰店市', '3', '0');
INSERT INTO `cities` VALUES ('2083', '245', '庄河市', '3', '0');
INSERT INTO `cities` VALUES ('2084', '245', '长海县', '3', '0');
INSERT INTO `cities` VALUES ('2085', '246', '铁东区', '3', '0');
INSERT INTO `cities` VALUES ('2086', '246', '铁西区', '3', '0');
INSERT INTO `cities` VALUES ('2087', '246', '立山区', '3', '0');
INSERT INTO `cities` VALUES ('2088', '246', '千山区', '3', '0');
INSERT INTO `cities` VALUES ('2089', '246', '岫岩', '3', '0');
INSERT INTO `cities` VALUES ('2090', '246', '海城市', '3', '0');
INSERT INTO `cities` VALUES ('2091', '246', '台安县', '3', '0');
INSERT INTO `cities` VALUES ('2092', '247', '本溪', '3', '0');
INSERT INTO `cities` VALUES ('2093', '247', '平山区', '3', '0');
INSERT INTO `cities` VALUES ('2094', '247', '明山区', '3', '0');
INSERT INTO `cities` VALUES ('2095', '247', '溪湖区', '3', '0');
INSERT INTO `cities` VALUES ('2096', '247', '南芬区', '3', '0');
INSERT INTO `cities` VALUES ('2097', '247', '桓仁', '3', '0');
INSERT INTO `cities` VALUES ('2098', '248', '双塔区', '3', '0');
INSERT INTO `cities` VALUES ('2099', '248', '龙城区', '3', '0');
INSERT INTO `cities` VALUES ('2100', '248', '喀喇沁左翼蒙古族自治县', '3', '0');
INSERT INTO `cities` VALUES ('2101', '248', '北票市', '3', '0');
INSERT INTO `cities` VALUES ('2102', '248', '凌源市', '3', '0');
INSERT INTO `cities` VALUES ('2103', '248', '朝阳县', '3', '0');
INSERT INTO `cities` VALUES ('2104', '248', '建平县', '3', '0');
INSERT INTO `cities` VALUES ('2105', '249', '振兴区', '3', '0');
INSERT INTO `cities` VALUES ('2106', '249', '元宝区', '3', '0');
INSERT INTO `cities` VALUES ('2107', '249', '振安区', '3', '0');
INSERT INTO `cities` VALUES ('2108', '249', '宽甸', '3', '0');
INSERT INTO `cities` VALUES ('2109', '249', '东港市', '3', '0');
INSERT INTO `cities` VALUES ('2110', '249', '凤城市', '3', '0');
INSERT INTO `cities` VALUES ('2111', '250', '顺城区', '3', '0');
INSERT INTO `cities` VALUES ('2112', '250', '新抚区', '3', '0');
INSERT INTO `cities` VALUES ('2113', '250', '东洲区', '3', '0');
INSERT INTO `cities` VALUES ('2114', '250', '望花区', '3', '0');
INSERT INTO `cities` VALUES ('2115', '250', '清原', '3', '0');
INSERT INTO `cities` VALUES ('2116', '250', '新宾', '3', '0');
INSERT INTO `cities` VALUES ('2117', '250', '抚顺县', '3', '0');
INSERT INTO `cities` VALUES ('2118', '251', '阜新', '3', '0');
INSERT INTO `cities` VALUES ('2119', '251', '海州区', '3', '0');
INSERT INTO `cities` VALUES ('2120', '251', '新邱区', '3', '0');
INSERT INTO `cities` VALUES ('2121', '251', '太平区', '3', '0');
INSERT INTO `cities` VALUES ('2122', '251', '清河门区', '3', '0');
INSERT INTO `cities` VALUES ('2123', '251', '细河区', '3', '0');
INSERT INTO `cities` VALUES ('2124', '251', '彰武县', '3', '0');
INSERT INTO `cities` VALUES ('2125', '252', '龙港区', '3', '0');
INSERT INTO `cities` VALUES ('2126', '252', '南票区', '3', '0');
INSERT INTO `cities` VALUES ('2127', '252', '连山区', '3', '0');
INSERT INTO `cities` VALUES ('2128', '252', '兴城市', '3', '0');
INSERT INTO `cities` VALUES ('2129', '252', '绥中县', '3', '0');
INSERT INTO `cities` VALUES ('2130', '252', '建昌县', '3', '0');
INSERT INTO `cities` VALUES ('2131', '253', '太和区', '3', '0');
INSERT INTO `cities` VALUES ('2132', '253', '古塔区', '3', '0');
INSERT INTO `cities` VALUES ('2133', '253', '凌河区', '3', '0');
INSERT INTO `cities` VALUES ('2134', '253', '凌海市', '3', '0');
INSERT INTO `cities` VALUES ('2135', '253', '北镇市', '3', '0');
INSERT INTO `cities` VALUES ('2136', '253', '黑山县', '3', '0');
INSERT INTO `cities` VALUES ('2137', '253', '义县', '3', '0');
INSERT INTO `cities` VALUES ('2138', '254', '白塔区', '3', '0');
INSERT INTO `cities` VALUES ('2139', '254', '文圣区', '3', '0');
INSERT INTO `cities` VALUES ('2140', '254', '宏伟区', '3', '0');
INSERT INTO `cities` VALUES ('2141', '254', '太子河区', '3', '0');
INSERT INTO `cities` VALUES ('2142', '254', '弓长岭区', '3', '0');
INSERT INTO `cities` VALUES ('2143', '254', '灯塔市', '3', '0');
INSERT INTO `cities` VALUES ('2144', '254', '辽阳县', '3', '0');
INSERT INTO `cities` VALUES ('2145', '255', '双台子区', '3', '0');
INSERT INTO `cities` VALUES ('2146', '255', '兴隆台区', '3', '0');
INSERT INTO `cities` VALUES ('2147', '255', '大洼县', '3', '0');
INSERT INTO `cities` VALUES ('2148', '255', '盘山县', '3', '0');
INSERT INTO `cities` VALUES ('2149', '256', '银州区', '3', '0');
INSERT INTO `cities` VALUES ('2150', '256', '清河区', '3', '0');
INSERT INTO `cities` VALUES ('2151', '256', '调兵山市', '3', '0');
INSERT INTO `cities` VALUES ('2152', '256', '开原市', '3', '0');
INSERT INTO `cities` VALUES ('2153', '256', '铁岭县', '3', '0');
INSERT INTO `cities` VALUES ('2154', '256', '西丰县', '3', '0');
INSERT INTO `cities` VALUES ('2155', '256', '昌图县', '3', '0');
INSERT INTO `cities` VALUES ('2156', '257', '站前区', '3', '0');
INSERT INTO `cities` VALUES ('2157', '257', '西市区', '3', '0');
INSERT INTO `cities` VALUES ('2158', '257', '鲅鱼圈区', '3', '0');
INSERT INTO `cities` VALUES ('2159', '257', '老边区', '3', '0');
INSERT INTO `cities` VALUES ('2160', '257', '盖州市', '3', '0');
INSERT INTO `cities` VALUES ('2161', '257', '大石桥市', '3', '0');
INSERT INTO `cities` VALUES ('2162', '258', '回民区', '3', '0');
INSERT INTO `cities` VALUES ('2163', '258', '玉泉区', '3', '0');
INSERT INTO `cities` VALUES ('2164', '258', '新城区', '3', '0');
INSERT INTO `cities` VALUES ('2165', '258', '赛罕区', '3', '0');
INSERT INTO `cities` VALUES ('2166', '258', '清水河县', '3', '0');
INSERT INTO `cities` VALUES ('2167', '258', '土默特左旗', '3', '0');
INSERT INTO `cities` VALUES ('2168', '258', '托克托县', '3', '0');
INSERT INTO `cities` VALUES ('2169', '258', '和林格尔县', '3', '0');
INSERT INTO `cities` VALUES ('2170', '258', '武川县', '3', '0');
INSERT INTO `cities` VALUES ('2171', '259', '阿拉善左旗', '3', '0');
INSERT INTO `cities` VALUES ('2172', '259', '阿拉善右旗', '3', '0');
INSERT INTO `cities` VALUES ('2173', '259', '额济纳旗', '3', '0');
INSERT INTO `cities` VALUES ('2174', '260', '临河区', '3', '0');
INSERT INTO `cities` VALUES ('2175', '260', '五原县', '3', '0');
INSERT INTO `cities` VALUES ('2176', '260', '磴口县', '3', '0');
INSERT INTO `cities` VALUES ('2177', '260', '乌拉特前旗', '3', '0');
INSERT INTO `cities` VALUES ('2178', '260', '乌拉特中旗', '3', '0');
INSERT INTO `cities` VALUES ('2179', '260', '乌拉特后旗', '3', '0');
INSERT INTO `cities` VALUES ('2180', '260', '杭锦后旗', '3', '0');
INSERT INTO `cities` VALUES ('2181', '261', '昆都仑区', '3', '0');
INSERT INTO `cities` VALUES ('2182', '261', '青山区', '3', '0');
INSERT INTO `cities` VALUES ('2183', '261', '东河区', '3', '0');
INSERT INTO `cities` VALUES ('2184', '261', '九原区', '3', '0');
INSERT INTO `cities` VALUES ('2185', '261', '石拐区', '3', '0');
INSERT INTO `cities` VALUES ('2186', '261', '白云矿区', '3', '0');
INSERT INTO `cities` VALUES ('2187', '261', '土默特右旗', '3', '0');
INSERT INTO `cities` VALUES ('2188', '261', '固阳县', '3', '0');
INSERT INTO `cities` VALUES ('2189', '261', '达尔罕茂明安联合旗', '3', '0');
INSERT INTO `cities` VALUES ('2190', '262', '红山区', '3', '0');
INSERT INTO `cities` VALUES ('2191', '262', '元宝山区', '3', '0');
INSERT INTO `cities` VALUES ('2192', '262', '松山区', '3', '0');
INSERT INTO `cities` VALUES ('2193', '262', '阿鲁科尔沁旗', '3', '0');
INSERT INTO `cities` VALUES ('2194', '262', '巴林左旗', '3', '0');
INSERT INTO `cities` VALUES ('2195', '262', '巴林右旗', '3', '0');
INSERT INTO `cities` VALUES ('2196', '262', '林西县', '3', '0');
INSERT INTO `cities` VALUES ('2197', '262', '克什克腾旗', '3', '0');
INSERT INTO `cities` VALUES ('2198', '262', '翁牛特旗', '3', '0');
INSERT INTO `cities` VALUES ('2199', '262', '喀喇沁旗', '3', '0');
INSERT INTO `cities` VALUES ('2200', '262', '宁城县', '3', '0');
INSERT INTO `cities` VALUES ('2201', '262', '敖汉旗', '3', '0');
INSERT INTO `cities` VALUES ('2202', '263', '东胜区', '3', '0');
INSERT INTO `cities` VALUES ('2203', '263', '达拉特旗', '3', '0');
INSERT INTO `cities` VALUES ('2204', '263', '准格尔旗', '3', '0');
INSERT INTO `cities` VALUES ('2205', '263', '鄂托克前旗', '3', '0');
INSERT INTO `cities` VALUES ('2206', '263', '鄂托克旗', '3', '0');
INSERT INTO `cities` VALUES ('2207', '263', '杭锦旗', '3', '0');
INSERT INTO `cities` VALUES ('2208', '263', '乌审旗', '3', '0');
INSERT INTO `cities` VALUES ('2209', '263', '伊金霍洛旗', '3', '0');
INSERT INTO `cities` VALUES ('2210', '264', '海拉尔区', '3', '0');
INSERT INTO `cities` VALUES ('2211', '264', '莫力达瓦', '3', '0');
INSERT INTO `cities` VALUES ('2212', '264', '满洲里市', '3', '0');
INSERT INTO `cities` VALUES ('2213', '264', '牙克石市', '3', '0');
INSERT INTO `cities` VALUES ('2214', '264', '扎兰屯市', '3', '0');
INSERT INTO `cities` VALUES ('2215', '264', '额尔古纳市', '3', '0');
INSERT INTO `cities` VALUES ('2216', '264', '根河市', '3', '0');
INSERT INTO `cities` VALUES ('2217', '264', '阿荣旗', '3', '0');
INSERT INTO `cities` VALUES ('2218', '264', '鄂伦春自治旗', '3', '0');
INSERT INTO `cities` VALUES ('2219', '264', '鄂温克族自治旗', '3', '0');
INSERT INTO `cities` VALUES ('2220', '264', '陈巴尔虎旗', '3', '0');
INSERT INTO `cities` VALUES ('2221', '264', '新巴尔虎左旗', '3', '0');
INSERT INTO `cities` VALUES ('2222', '264', '新巴尔虎右旗', '3', '0');
INSERT INTO `cities` VALUES ('2223', '265', '科尔沁区', '3', '0');
INSERT INTO `cities` VALUES ('2224', '265', '霍林郭勒市', '3', '0');
INSERT INTO `cities` VALUES ('2225', '265', '科尔沁左翼中旗', '3', '0');
INSERT INTO `cities` VALUES ('2226', '265', '科尔沁左翼后旗', '3', '0');
INSERT INTO `cities` VALUES ('2227', '265', '开鲁县', '3', '0');
INSERT INTO `cities` VALUES ('2228', '265', '库伦旗', '3', '0');
INSERT INTO `cities` VALUES ('2229', '265', '奈曼旗', '3', '0');
INSERT INTO `cities` VALUES ('2230', '265', '扎鲁特旗', '3', '0');
INSERT INTO `cities` VALUES ('2231', '266', '海勃湾区', '3', '0');
INSERT INTO `cities` VALUES ('2232', '266', '乌达区', '3', '0');
INSERT INTO `cities` VALUES ('2233', '266', '海南区', '3', '0');
INSERT INTO `cities` VALUES ('2234', '267', '化德县', '3', '0');
INSERT INTO `cities` VALUES ('2235', '267', '集宁区', '3', '0');
INSERT INTO `cities` VALUES ('2236', '267', '丰镇市', '3', '0');
INSERT INTO `cities` VALUES ('2237', '267', '卓资县', '3', '0');
INSERT INTO `cities` VALUES ('2238', '267', '商都县', '3', '0');
INSERT INTO `cities` VALUES ('2239', '267', '兴和县', '3', '0');
INSERT INTO `cities` VALUES ('2240', '267', '凉城县', '3', '0');
INSERT INTO `cities` VALUES ('2241', '267', '察哈尔右翼前旗', '3', '0');
INSERT INTO `cities` VALUES ('2242', '267', '察哈尔右翼中旗', '3', '0');
INSERT INTO `cities` VALUES ('2243', '267', '察哈尔右翼后旗', '3', '0');
INSERT INTO `cities` VALUES ('2244', '267', '四子王旗', '3', '0');
INSERT INTO `cities` VALUES ('2245', '268', '二连浩特市', '3', '0');
INSERT INTO `cities` VALUES ('2246', '268', '锡林浩特市', '3', '0');
INSERT INTO `cities` VALUES ('2247', '268', '阿巴嘎旗', '3', '0');
INSERT INTO `cities` VALUES ('2248', '268', '苏尼特左旗', '3', '0');
INSERT INTO `cities` VALUES ('2249', '268', '苏尼特右旗', '3', '0');
INSERT INTO `cities` VALUES ('2250', '268', '东乌珠穆沁旗', '3', '0');
INSERT INTO `cities` VALUES ('2251', '268', '西乌珠穆沁旗', '3', '0');
INSERT INTO `cities` VALUES ('2252', '268', '太仆寺旗', '3', '0');
INSERT INTO `cities` VALUES ('2253', '268', '镶黄旗', '3', '0');
INSERT INTO `cities` VALUES ('2254', '268', '正镶白旗', '3', '0');
INSERT INTO `cities` VALUES ('2255', '268', '正蓝旗', '3', '0');
INSERT INTO `cities` VALUES ('2256', '268', '多伦县', '3', '0');
INSERT INTO `cities` VALUES ('2257', '269', '乌兰浩特市', '3', '0');
INSERT INTO `cities` VALUES ('2258', '269', '阿尔山市', '3', '0');
INSERT INTO `cities` VALUES ('2259', '269', '科尔沁右翼前旗', '3', '0');
INSERT INTO `cities` VALUES ('2260', '269', '科尔沁右翼中旗', '3', '0');
INSERT INTO `cities` VALUES ('2261', '269', '扎赉特旗', '3', '0');
INSERT INTO `cities` VALUES ('2262', '269', '突泉县', '3', '0');
INSERT INTO `cities` VALUES ('2263', '270', '西夏区', '3', '0');
INSERT INTO `cities` VALUES ('2264', '270', '金凤区', '3', '0');
INSERT INTO `cities` VALUES ('2265', '270', '兴庆区', '3', '0');
INSERT INTO `cities` VALUES ('2266', '270', '灵武市', '3', '0');
INSERT INTO `cities` VALUES ('2267', '270', '永宁县', '3', '0');
INSERT INTO `cities` VALUES ('2268', '270', '贺兰县', '3', '0');
INSERT INTO `cities` VALUES ('2269', '271', '原州区', '3', '0');
INSERT INTO `cities` VALUES ('2270', '271', '海原县', '3', '0');
INSERT INTO `cities` VALUES ('2271', '271', '西吉县', '3', '0');
INSERT INTO `cities` VALUES ('2272', '271', '隆德县', '3', '0');
INSERT INTO `cities` VALUES ('2273', '271', '泾源县', '3', '0');
INSERT INTO `cities` VALUES ('2274', '271', '彭阳县', '3', '0');
INSERT INTO `cities` VALUES ('2275', '272', '惠农县', '3', '0');
INSERT INTO `cities` VALUES ('2276', '272', '大武口区', '3', '0');
INSERT INTO `cities` VALUES ('2277', '272', '惠农区', '3', '0');
INSERT INTO `cities` VALUES ('2278', '272', '陶乐县', '3', '0');
INSERT INTO `cities` VALUES ('2279', '272', '平罗县', '3', '0');
INSERT INTO `cities` VALUES ('2280', '273', '利通区', '3', '0');
INSERT INTO `cities` VALUES ('2281', '273', '中卫县', '3', '0');
INSERT INTO `cities` VALUES ('2282', '273', '青铜峡市', '3', '0');
INSERT INTO `cities` VALUES ('2283', '273', '中宁县', '3', '0');
INSERT INTO `cities` VALUES ('2284', '273', '盐池县', '3', '0');
INSERT INTO `cities` VALUES ('2285', '273', '同心县', '3', '0');
INSERT INTO `cities` VALUES ('2286', '274', '沙坡头区', '3', '0');
INSERT INTO `cities` VALUES ('2287', '274', '海原县', '3', '0');
INSERT INTO `cities` VALUES ('2288', '274', '中宁县', '3', '0');
INSERT INTO `cities` VALUES ('2289', '275', '城中区', '3', '0');
INSERT INTO `cities` VALUES ('2290', '275', '城东区', '3', '0');
INSERT INTO `cities` VALUES ('2291', '275', '城西区', '3', '0');
INSERT INTO `cities` VALUES ('2292', '275', '城北区', '3', '0');
INSERT INTO `cities` VALUES ('2293', '275', '湟中县', '3', '0');
INSERT INTO `cities` VALUES ('2294', '275', '湟源县', '3', '0');
INSERT INTO `cities` VALUES ('2295', '275', '大通', '3', '0');
INSERT INTO `cities` VALUES ('2296', '276', '玛沁县', '3', '0');
INSERT INTO `cities` VALUES ('2297', '276', '班玛县', '3', '0');
INSERT INTO `cities` VALUES ('2298', '276', '甘德县', '3', '0');
INSERT INTO `cities` VALUES ('2299', '276', '达日县', '3', '0');
INSERT INTO `cities` VALUES ('2300', '276', '久治县', '3', '0');
INSERT INTO `cities` VALUES ('2301', '276', '玛多县', '3', '0');
INSERT INTO `cities` VALUES ('2302', '277', '海晏县', '3', '0');
INSERT INTO `cities` VALUES ('2303', '277', '祁连县', '3', '0');
INSERT INTO `cities` VALUES ('2304', '277', '刚察县', '3', '0');
INSERT INTO `cities` VALUES ('2305', '277', '门源', '3', '0');
INSERT INTO `cities` VALUES ('2306', '278', '平安县', '3', '0');
INSERT INTO `cities` VALUES ('2307', '278', '乐都县', '3', '0');
INSERT INTO `cities` VALUES ('2308', '278', '民和', '3', '0');
INSERT INTO `cities` VALUES ('2309', '278', '互助', '3', '0');
INSERT INTO `cities` VALUES ('2310', '278', '化隆', '3', '0');
INSERT INTO `cities` VALUES ('2311', '278', '循化', '3', '0');
INSERT INTO `cities` VALUES ('2312', '279', '共和县', '3', '0');
INSERT INTO `cities` VALUES ('2313', '279', '同德县', '3', '0');
INSERT INTO `cities` VALUES ('2314', '279', '贵德县', '3', '0');
INSERT INTO `cities` VALUES ('2315', '279', '兴海县', '3', '0');
INSERT INTO `cities` VALUES ('2316', '279', '贵南县', '3', '0');
INSERT INTO `cities` VALUES ('2317', '280', '德令哈市', '3', '0');
INSERT INTO `cities` VALUES ('2318', '280', '格尔木市', '3', '0');
INSERT INTO `cities` VALUES ('2319', '280', '乌兰县', '3', '0');
INSERT INTO `cities` VALUES ('2320', '280', '都兰县', '3', '0');
INSERT INTO `cities` VALUES ('2321', '280', '天峻县', '3', '0');
INSERT INTO `cities` VALUES ('2322', '281', '同仁县', '3', '0');
INSERT INTO `cities` VALUES ('2323', '281', '尖扎县', '3', '0');
INSERT INTO `cities` VALUES ('2324', '281', '泽库县', '3', '0');
INSERT INTO `cities` VALUES ('2325', '281', '河南蒙古族自治县', '3', '0');
INSERT INTO `cities` VALUES ('2326', '282', '玉树县', '3', '0');
INSERT INTO `cities` VALUES ('2327', '282', '杂多县', '3', '0');
INSERT INTO `cities` VALUES ('2328', '282', '称多县', '3', '0');
INSERT INTO `cities` VALUES ('2329', '282', '治多县', '3', '0');
INSERT INTO `cities` VALUES ('2330', '282', '囊谦县', '3', '0');
INSERT INTO `cities` VALUES ('2331', '282', '曲麻莱县', '3', '0');
INSERT INTO `cities` VALUES ('2332', '283', '市中区', '3', '0');
INSERT INTO `cities` VALUES ('2333', '283', '历下区', '3', '0');
INSERT INTO `cities` VALUES ('2334', '283', '天桥区', '3', '0');
INSERT INTO `cities` VALUES ('2335', '283', '槐荫区', '3', '0');
INSERT INTO `cities` VALUES ('2336', '283', '历城区', '3', '0');
INSERT INTO `cities` VALUES ('2337', '283', '长清区', '3', '0');
INSERT INTO `cities` VALUES ('2338', '283', '章丘市', '3', '0');
INSERT INTO `cities` VALUES ('2339', '283', '平阴县', '3', '0');
INSERT INTO `cities` VALUES ('2340', '283', '济阳县', '3', '0');
INSERT INTO `cities` VALUES ('2341', '283', '商河县', '3', '0');
INSERT INTO `cities` VALUES ('2342', '284', '市南区', '3', '0');
INSERT INTO `cities` VALUES ('2343', '284', '市北区', '3', '0');
INSERT INTO `cities` VALUES ('2344', '284', '城阳区', '3', '0');
INSERT INTO `cities` VALUES ('2345', '284', '四方区', '3', '0');
INSERT INTO `cities` VALUES ('2346', '284', '李沧区', '3', '0');
INSERT INTO `cities` VALUES ('2347', '284', '黄岛区', '3', '0');
INSERT INTO `cities` VALUES ('2348', '284', '崂山区', '3', '0');
INSERT INTO `cities` VALUES ('2349', '284', '胶州市', '3', '0');
INSERT INTO `cities` VALUES ('2350', '284', '即墨市', '3', '0');
INSERT INTO `cities` VALUES ('2351', '284', '平度市', '3', '0');
INSERT INTO `cities` VALUES ('2352', '284', '胶南市', '3', '0');
INSERT INTO `cities` VALUES ('2353', '284', '莱西市', '3', '0');
INSERT INTO `cities` VALUES ('2354', '285', '滨城区', '3', '0');
INSERT INTO `cities` VALUES ('2355', '285', '惠民县', '3', '0');
INSERT INTO `cities` VALUES ('2356', '285', '阳信县', '3', '0');
INSERT INTO `cities` VALUES ('2357', '285', '无棣县', '3', '0');
INSERT INTO `cities` VALUES ('2358', '285', '沾化县', '3', '0');
INSERT INTO `cities` VALUES ('2359', '285', '博兴县', '3', '0');
INSERT INTO `cities` VALUES ('2360', '285', '邹平县', '3', '0');
INSERT INTO `cities` VALUES ('2361', '286', '德城区', '3', '0');
INSERT INTO `cities` VALUES ('2362', '286', '陵县', '3', '0');
INSERT INTO `cities` VALUES ('2363', '286', '乐陵市', '3', '0');
INSERT INTO `cities` VALUES ('2364', '286', '禹城市', '3', '0');
INSERT INTO `cities` VALUES ('2365', '286', '宁津县', '3', '0');
INSERT INTO `cities` VALUES ('2366', '286', '庆云县', '3', '0');
INSERT INTO `cities` VALUES ('2367', '286', '临邑县', '3', '0');
INSERT INTO `cities` VALUES ('2368', '286', '齐河县', '3', '0');
INSERT INTO `cities` VALUES ('2369', '286', '平原县', '3', '0');
INSERT INTO `cities` VALUES ('2370', '286', '夏津县', '3', '0');
INSERT INTO `cities` VALUES ('2371', '286', '武城县', '3', '0');
INSERT INTO `cities` VALUES ('2372', '287', '东营区', '3', '0');
INSERT INTO `cities` VALUES ('2373', '287', '河口区', '3', '0');
INSERT INTO `cities` VALUES ('2374', '287', '垦利县', '3', '0');
INSERT INTO `cities` VALUES ('2375', '287', '利津县', '3', '0');
INSERT INTO `cities` VALUES ('2376', '287', '广饶县', '3', '0');
INSERT INTO `cities` VALUES ('2377', '288', '牡丹区', '3', '0');
INSERT INTO `cities` VALUES ('2378', '288', '曹县', '3', '0');
INSERT INTO `cities` VALUES ('2379', '288', '单县', '3', '0');
INSERT INTO `cities` VALUES ('2380', '288', '成武县', '3', '0');
INSERT INTO `cities` VALUES ('2381', '288', '巨野县', '3', '0');
INSERT INTO `cities` VALUES ('2382', '288', '郓城县', '3', '0');
INSERT INTO `cities` VALUES ('2383', '288', '鄄城县', '3', '0');
INSERT INTO `cities` VALUES ('2384', '288', '定陶县', '3', '0');
INSERT INTO `cities` VALUES ('2385', '288', '东明县', '3', '0');
INSERT INTO `cities` VALUES ('2386', '289', '市中区', '3', '0');
INSERT INTO `cities` VALUES ('2387', '289', '任城区', '3', '0');
INSERT INTO `cities` VALUES ('2388', '289', '曲阜市', '3', '0');
INSERT INTO `cities` VALUES ('2389', '289', '兖州市', '3', '0');
INSERT INTO `cities` VALUES ('2390', '289', '邹城市', '3', '0');
INSERT INTO `cities` VALUES ('2391', '289', '微山县', '3', '0');
INSERT INTO `cities` VALUES ('2392', '289', '鱼台县', '3', '0');
INSERT INTO `cities` VALUES ('2393', '289', '金乡县', '3', '0');
INSERT INTO `cities` VALUES ('2394', '289', '嘉祥县', '3', '0');
INSERT INTO `cities` VALUES ('2395', '289', '汶上县', '3', '0');
INSERT INTO `cities` VALUES ('2396', '289', '泗水县', '3', '0');
INSERT INTO `cities` VALUES ('2397', '289', '梁山县', '3', '0');
INSERT INTO `cities` VALUES ('2398', '290', '莱城区', '3', '0');
INSERT INTO `cities` VALUES ('2399', '290', '钢城区', '3', '0');
INSERT INTO `cities` VALUES ('2400', '291', '东昌府区', '3', '0');
INSERT INTO `cities` VALUES ('2401', '291', '临清市', '3', '0');
INSERT INTO `cities` VALUES ('2402', '291', '阳谷县', '3', '0');
INSERT INTO `cities` VALUES ('2403', '291', '莘县', '3', '0');
INSERT INTO `cities` VALUES ('2404', '291', '茌平县', '3', '0');
INSERT INTO `cities` VALUES ('2405', '291', '东阿县', '3', '0');
INSERT INTO `cities` VALUES ('2406', '291', '冠县', '3', '0');
INSERT INTO `cities` VALUES ('2407', '291', '高唐县', '3', '0');
INSERT INTO `cities` VALUES ('2408', '292', '兰山区', '3', '0');
INSERT INTO `cities` VALUES ('2409', '292', '罗庄区', '3', '0');
INSERT INTO `cities` VALUES ('2410', '292', '河东区', '3', '0');
INSERT INTO `cities` VALUES ('2411', '292', '沂南县', '3', '0');
INSERT INTO `cities` VALUES ('2412', '292', '郯城县', '3', '0');
INSERT INTO `cities` VALUES ('2413', '292', '沂水县', '3', '0');
INSERT INTO `cities` VALUES ('2414', '292', '苍山县', '3', '0');
INSERT INTO `cities` VALUES ('2415', '292', '费县', '3', '0');
INSERT INTO `cities` VALUES ('2416', '292', '平邑县', '3', '0');
INSERT INTO `cities` VALUES ('2417', '292', '莒南县', '3', '0');
INSERT INTO `cities` VALUES ('2418', '292', '蒙阴县', '3', '0');
INSERT INTO `cities` VALUES ('2419', '292', '临沭县', '3', '0');
INSERT INTO `cities` VALUES ('2420', '293', '东港区', '3', '0');
INSERT INTO `cities` VALUES ('2421', '293', '岚山区', '3', '0');
INSERT INTO `cities` VALUES ('2422', '293', '五莲县', '3', '0');
INSERT INTO `cities` VALUES ('2423', '293', '莒县', '3', '0');
INSERT INTO `cities` VALUES ('2424', '294', '泰山区', '3', '0');
INSERT INTO `cities` VALUES ('2425', '294', '岱岳区', '3', '0');
INSERT INTO `cities` VALUES ('2426', '294', '新泰市', '3', '0');
INSERT INTO `cities` VALUES ('2427', '294', '肥城市', '3', '0');
INSERT INTO `cities` VALUES ('2428', '294', '宁阳县', '3', '0');
INSERT INTO `cities` VALUES ('2429', '294', '东平县', '3', '0');
INSERT INTO `cities` VALUES ('2430', '295', '荣成市', '3', '0');
INSERT INTO `cities` VALUES ('2431', '295', '乳山市', '3', '0');
INSERT INTO `cities` VALUES ('2432', '295', '环翠区', '3', '0');
INSERT INTO `cities` VALUES ('2433', '295', '文登市', '3', '0');
INSERT INTO `cities` VALUES ('2434', '296', '潍城区', '3', '0');
INSERT INTO `cities` VALUES ('2435', '296', '寒亭区', '3', '0');
INSERT INTO `cities` VALUES ('2436', '296', '坊子区', '3', '0');
INSERT INTO `cities` VALUES ('2437', '296', '奎文区', '3', '0');
INSERT INTO `cities` VALUES ('2438', '296', '青州市', '3', '0');
INSERT INTO `cities` VALUES ('2439', '296', '诸城市', '3', '0');
INSERT INTO `cities` VALUES ('2440', '296', '寿光市', '3', '0');
INSERT INTO `cities` VALUES ('2441', '296', '安丘市', '3', '0');
INSERT INTO `cities` VALUES ('2442', '296', '高密市', '3', '0');
INSERT INTO `cities` VALUES ('2443', '296', '昌邑市', '3', '0');
INSERT INTO `cities` VALUES ('2444', '296', '临朐县', '3', '0');
INSERT INTO `cities` VALUES ('2445', '296', '昌乐县', '3', '0');
INSERT INTO `cities` VALUES ('2446', '297', '芝罘区', '3', '0');
INSERT INTO `cities` VALUES ('2447', '297', '福山区', '3', '0');
INSERT INTO `cities` VALUES ('2448', '297', '牟平区', '3', '0');
INSERT INTO `cities` VALUES ('2449', '297', '莱山区', '3', '0');
INSERT INTO `cities` VALUES ('2450', '297', '开发区', '3', '0');
INSERT INTO `cities` VALUES ('2451', '297', '龙口市', '3', '0');
INSERT INTO `cities` VALUES ('2452', '297', '莱阳市', '3', '0');
INSERT INTO `cities` VALUES ('2453', '297', '莱州市', '3', '0');
INSERT INTO `cities` VALUES ('2454', '297', '蓬莱市', '3', '0');
INSERT INTO `cities` VALUES ('2455', '297', '招远市', '3', '0');
INSERT INTO `cities` VALUES ('2456', '297', '栖霞市', '3', '0');
INSERT INTO `cities` VALUES ('2457', '297', '海阳市', '3', '0');
INSERT INTO `cities` VALUES ('2458', '297', '长岛县', '3', '0');
INSERT INTO `cities` VALUES ('2459', '298', '市中区', '3', '0');
INSERT INTO `cities` VALUES ('2460', '298', '山亭区', '3', '0');
INSERT INTO `cities` VALUES ('2461', '298', '峄城区', '3', '0');
INSERT INTO `cities` VALUES ('2462', '298', '台儿庄区', '3', '0');
INSERT INTO `cities` VALUES ('2463', '298', '薛城区', '3', '0');
INSERT INTO `cities` VALUES ('2464', '298', '滕州市', '3', '0');
INSERT INTO `cities` VALUES ('2465', '299', '张店区', '3', '0');
INSERT INTO `cities` VALUES ('2466', '299', '临淄区', '3', '0');
INSERT INTO `cities` VALUES ('2467', '299', '淄川区', '3', '0');
INSERT INTO `cities` VALUES ('2468', '299', '博山区', '3', '0');
INSERT INTO `cities` VALUES ('2469', '299', '周村区', '3', '0');
INSERT INTO `cities` VALUES ('2470', '299', '桓台县', '3', '0');
INSERT INTO `cities` VALUES ('2471', '299', '高青县', '3', '0');
INSERT INTO `cities` VALUES ('2472', '299', '沂源县', '3', '0');
INSERT INTO `cities` VALUES ('2473', '300', '杏花岭区', '3', '0');
INSERT INTO `cities` VALUES ('2474', '300', '小店区', '3', '0');
INSERT INTO `cities` VALUES ('2475', '300', '迎泽区', '3', '0');
INSERT INTO `cities` VALUES ('2476', '300', '尖草坪区', '3', '0');
INSERT INTO `cities` VALUES ('2477', '300', '万柏林区', '3', '0');
INSERT INTO `cities` VALUES ('2478', '300', '晋源区', '3', '0');
INSERT INTO `cities` VALUES ('2479', '300', '高新开发区', '3', '0');
INSERT INTO `cities` VALUES ('2480', '300', '民营经济开发区', '3', '0');
INSERT INTO `cities` VALUES ('2481', '300', '经济技术开发区', '3', '0');
INSERT INTO `cities` VALUES ('2482', '300', '清徐县', '3', '0');
INSERT INTO `cities` VALUES ('2483', '300', '阳曲县', '3', '0');
INSERT INTO `cities` VALUES ('2484', '300', '娄烦县', '3', '0');
INSERT INTO `cities` VALUES ('2485', '300', '古交市', '3', '0');
INSERT INTO `cities` VALUES ('2486', '301', '城区', '3', '0');
INSERT INTO `cities` VALUES ('2487', '301', '郊区', '3', '0');
INSERT INTO `cities` VALUES ('2488', '301', '沁县', '3', '0');
INSERT INTO `cities` VALUES ('2489', '301', '潞城市', '3', '0');
INSERT INTO `cities` VALUES ('2490', '301', '长治县', '3', '0');
INSERT INTO `cities` VALUES ('2491', '301', '襄垣县', '3', '0');
INSERT INTO `cities` VALUES ('2492', '301', '屯留县', '3', '0');
INSERT INTO `cities` VALUES ('2493', '301', '平顺县', '3', '0');
INSERT INTO `cities` VALUES ('2494', '301', '黎城县', '3', '0');
INSERT INTO `cities` VALUES ('2495', '301', '壶关县', '3', '0');
INSERT INTO `cities` VALUES ('2496', '301', '长子县', '3', '0');
INSERT INTO `cities` VALUES ('2497', '301', '武乡县', '3', '0');
INSERT INTO `cities` VALUES ('2498', '301', '沁源县', '3', '0');
INSERT INTO `cities` VALUES ('2499', '302', '城区', '3', '0');
INSERT INTO `cities` VALUES ('2500', '302', '矿区', '3', '0');
INSERT INTO `cities` VALUES ('2501', '302', '南郊区', '3', '0');
INSERT INTO `cities` VALUES ('2502', '302', '新荣区', '3', '0');
INSERT INTO `cities` VALUES ('2503', '302', '阳高县', '3', '0');
INSERT INTO `cities` VALUES ('2504', '302', '天镇县', '3', '0');
INSERT INTO `cities` VALUES ('2505', '302', '广灵县', '3', '0');
INSERT INTO `cities` VALUES ('2506', '302', '灵丘县', '3', '0');
INSERT INTO `cities` VALUES ('2507', '302', '浑源县', '3', '0');
INSERT INTO `cities` VALUES ('2509', '302', '大同县', '3', '0');
INSERT INTO `cities` VALUES ('2510', '303', '城区', '3', '0');
INSERT INTO `cities` VALUES ('2511', '303', '高平市', '3', '0');
INSERT INTO `cities` VALUES ('2512', '303', '沁水县', '3', '0');
INSERT INTO `cities` VALUES ('2513', '303', '阳城县', '3', '0');
INSERT INTO `cities` VALUES ('2514', '303', '陵川县', '3', '0');
INSERT INTO `cities` VALUES ('2515', '303', '泽州县', '3', '0');
INSERT INTO `cities` VALUES ('2516', '304', '榆次区', '3', '0');
INSERT INTO `cities` VALUES ('2517', '304', '介休市', '3', '0');
INSERT INTO `cities` VALUES ('2518', '304', '榆社县', '3', '0');
INSERT INTO `cities` VALUES ('2519', '304', '左权县', '3', '0');
INSERT INTO `cities` VALUES ('2520', '304', '和顺县', '3', '0');
INSERT INTO `cities` VALUES ('2521', '304', '昔阳县', '3', '0');
INSERT INTO `cities` VALUES ('2522', '304', '寿阳县', '3', '0');
INSERT INTO `cities` VALUES ('2523', '304', '太谷县', '3', '0');
INSERT INTO `cities` VALUES ('2524', '304', '祁县', '3', '0');
INSERT INTO `cities` VALUES ('2525', '304', '平遥县', '3', '0');
INSERT INTO `cities` VALUES ('2526', '304', '灵石县', '3', '0');
INSERT INTO `cities` VALUES ('2527', '305', '尧都区', '3', '0');
INSERT INTO `cities` VALUES ('2528', '305', '侯马市', '3', '0');
INSERT INTO `cities` VALUES ('2529', '305', '霍州市', '3', '0');
INSERT INTO `cities` VALUES ('2530', '305', '曲沃县', '3', '0');
INSERT INTO `cities` VALUES ('2531', '305', '翼城县', '3', '0');
INSERT INTO `cities` VALUES ('2532', '305', '襄汾县', '3', '0');
INSERT INTO `cities` VALUES ('2533', '305', '洪洞县', '3', '0');
INSERT INTO `cities` VALUES ('2534', '305', '吉县', '3', '0');
INSERT INTO `cities` VALUES ('2535', '305', '安泽县', '3', '0');
INSERT INTO `cities` VALUES ('2536', '305', '浮山县', '3', '0');
INSERT INTO `cities` VALUES ('2537', '305', '古县', '3', '0');
INSERT INTO `cities` VALUES ('2538', '305', '乡宁县', '3', '0');
INSERT INTO `cities` VALUES ('2539', '305', '大宁县', '3', '0');
INSERT INTO `cities` VALUES ('2540', '305', '隰县', '3', '0');
INSERT INTO `cities` VALUES ('2541', '305', '永和县', '3', '0');
INSERT INTO `cities` VALUES ('2542', '305', '蒲县', '3', '0');
INSERT INTO `cities` VALUES ('2543', '305', '汾西县', '3', '0');
INSERT INTO `cities` VALUES ('2544', '306', '离石市', '3', '0');
INSERT INTO `cities` VALUES ('2545', '306', '离石区', '3', '0');
INSERT INTO `cities` VALUES ('2546', '306', '孝义市', '3', '0');
INSERT INTO `cities` VALUES ('2547', '306', '汾阳市', '3', '0');
INSERT INTO `cities` VALUES ('2548', '306', '文水县', '3', '0');
INSERT INTO `cities` VALUES ('2549', '306', '交城县', '3', '0');
INSERT INTO `cities` VALUES ('2550', '306', '兴县', '3', '0');
INSERT INTO `cities` VALUES ('2551', '306', '临县', '3', '0');
INSERT INTO `cities` VALUES ('2552', '306', '柳林县', '3', '0');
INSERT INTO `cities` VALUES ('2553', '306', '石楼县', '3', '0');
INSERT INTO `cities` VALUES ('2554', '306', '岚县', '3', '0');
INSERT INTO `cities` VALUES ('2555', '306', '方山县', '3', '0');
INSERT INTO `cities` VALUES ('2556', '306', '中阳县', '3', '0');
INSERT INTO `cities` VALUES ('2557', '306', '交口县', '3', '0');
INSERT INTO `cities` VALUES ('2558', '307', '朔城区', '3', '0');
INSERT INTO `cities` VALUES ('2559', '307', '平鲁区', '3', '0');
INSERT INTO `cities` VALUES ('2560', '307', '山阴县', '3', '0');
INSERT INTO `cities` VALUES ('2561', '307', '应县', '3', '0');
INSERT INTO `cities` VALUES ('2562', '307', '右玉县', '3', '0');
INSERT INTO `cities` VALUES ('2563', '307', '怀仁县', '3', '0');
INSERT INTO `cities` VALUES ('2564', '308', '忻府区', '3', '0');
INSERT INTO `cities` VALUES ('2565', '308', '原平市', '3', '0');
INSERT INTO `cities` VALUES ('2566', '308', '定襄县', '3', '0');
INSERT INTO `cities` VALUES ('2567', '308', '五台县', '3', '0');
INSERT INTO `cities` VALUES ('2568', '308', '代县', '3', '0');
INSERT INTO `cities` VALUES ('2569', '308', '繁峙县', '3', '0');
INSERT INTO `cities` VALUES ('2570', '308', '宁武县', '3', '0');
INSERT INTO `cities` VALUES ('2571', '308', '静乐县', '3', '0');
INSERT INTO `cities` VALUES ('2572', '308', '神池县', '3', '0');
INSERT INTO `cities` VALUES ('2573', '308', '五寨县', '3', '0');
INSERT INTO `cities` VALUES ('2574', '308', '岢岚县', '3', '0');
INSERT INTO `cities` VALUES ('2575', '308', '河曲县', '3', '0');
INSERT INTO `cities` VALUES ('2576', '308', '保德县', '3', '0');
INSERT INTO `cities` VALUES ('2577', '308', '偏关县', '3', '0');
INSERT INTO `cities` VALUES ('2578', '309', '城区', '3', '0');
INSERT INTO `cities` VALUES ('2579', '309', '矿区', '3', '0');
INSERT INTO `cities` VALUES ('2580', '309', '郊区', '3', '0');
INSERT INTO `cities` VALUES ('2581', '309', '平定县', '3', '0');
INSERT INTO `cities` VALUES ('2582', '309', '盂县', '3', '0');
INSERT INTO `cities` VALUES ('2583', '310', '盐湖区', '3', '0');
INSERT INTO `cities` VALUES ('2584', '310', '永济市', '3', '0');
INSERT INTO `cities` VALUES ('2585', '310', '河津市', '3', '0');
INSERT INTO `cities` VALUES ('2586', '310', '临猗县', '3', '0');
INSERT INTO `cities` VALUES ('2587', '310', '万荣县', '3', '0');
INSERT INTO `cities` VALUES ('2588', '310', '闻喜县', '3', '0');
INSERT INTO `cities` VALUES ('2589', '310', '稷山县', '3', '0');
INSERT INTO `cities` VALUES ('2590', '310', '新绛县', '3', '0');
INSERT INTO `cities` VALUES ('2591', '310', '绛县', '3', '0');
INSERT INTO `cities` VALUES ('2592', '310', '垣曲县', '3', '0');
INSERT INTO `cities` VALUES ('2593', '310', '夏县', '3', '0');
INSERT INTO `cities` VALUES ('2594', '310', '平陆县', '3', '0');
INSERT INTO `cities` VALUES ('2595', '310', '芮城县', '3', '0');
INSERT INTO `cities` VALUES ('2596', '311', '莲湖区', '3', '0');
INSERT INTO `cities` VALUES ('2597', '311', '新城区', '3', '0');
INSERT INTO `cities` VALUES ('2598', '311', '碑林区', '3', '0');
INSERT INTO `cities` VALUES ('2599', '311', '雁塔区', '3', '0');
INSERT INTO `cities` VALUES ('2600', '311', '灞桥区', '3', '0');
INSERT INTO `cities` VALUES ('2601', '311', '未央区', '3', '0');
INSERT INTO `cities` VALUES ('2602', '311', '阎良区', '3', '0');
INSERT INTO `cities` VALUES ('2603', '311', '临潼区', '3', '0');
INSERT INTO `cities` VALUES ('2604', '311', '长安区', '3', '0');
INSERT INTO `cities` VALUES ('2605', '311', '蓝田县', '3', '0');
INSERT INTO `cities` VALUES ('2606', '311', '周至县', '3', '0');
INSERT INTO `cities` VALUES ('2607', '311', '户县', '3', '0');
INSERT INTO `cities` VALUES ('2608', '311', '高陵县', '3', '0');
INSERT INTO `cities` VALUES ('2609', '312', '汉滨区', '3', '0');
INSERT INTO `cities` VALUES ('2610', '312', '汉阴县', '3', '0');
INSERT INTO `cities` VALUES ('2611', '312', '石泉县', '3', '0');
INSERT INTO `cities` VALUES ('2612', '312', '宁陕县', '3', '0');
INSERT INTO `cities` VALUES ('2613', '312', '紫阳县', '3', '0');
INSERT INTO `cities` VALUES ('2614', '312', '岚皋县', '3', '0');
INSERT INTO `cities` VALUES ('2615', '312', '平利县', '3', '0');
INSERT INTO `cities` VALUES ('2616', '312', '镇坪县', '3', '0');
INSERT INTO `cities` VALUES ('2617', '312', '旬阳县', '3', '0');
INSERT INTO `cities` VALUES ('2618', '312', '白河县', '3', '0');
INSERT INTO `cities` VALUES ('2619', '313', '陈仓区', '3', '0');
INSERT INTO `cities` VALUES ('2620', '313', '渭滨区', '3', '0');
INSERT INTO `cities` VALUES ('2621', '313', '金台区', '3', '0');
INSERT INTO `cities` VALUES ('2622', '313', '凤翔县', '3', '0');
INSERT INTO `cities` VALUES ('2623', '313', '岐山县', '3', '0');
INSERT INTO `cities` VALUES ('2624', '313', '扶风县', '3', '0');
INSERT INTO `cities` VALUES ('2625', '313', '眉县', '3', '0');
INSERT INTO `cities` VALUES ('2626', '313', '陇县', '3', '0');
INSERT INTO `cities` VALUES ('2627', '313', '千阳县', '3', '0');
INSERT INTO `cities` VALUES ('2628', '313', '麟游县', '3', '0');
INSERT INTO `cities` VALUES ('2629', '313', '凤县', '3', '0');
INSERT INTO `cities` VALUES ('2630', '313', '太白县', '3', '0');
INSERT INTO `cities` VALUES ('2631', '314', '汉台区', '3', '0');
INSERT INTO `cities` VALUES ('2632', '314', '南郑县', '3', '0');
INSERT INTO `cities` VALUES ('2633', '314', '城固县', '3', '0');
INSERT INTO `cities` VALUES ('2634', '314', '洋县', '3', '0');
INSERT INTO `cities` VALUES ('2635', '314', '西乡县', '3', '0');
INSERT INTO `cities` VALUES ('2636', '314', '勉县', '3', '0');
INSERT INTO `cities` VALUES ('2637', '314', '宁强县', '3', '0');
INSERT INTO `cities` VALUES ('2638', '314', '略阳县', '3', '0');
INSERT INTO `cities` VALUES ('2639', '314', '镇巴县', '3', '0');
INSERT INTO `cities` VALUES ('2640', '314', '留坝县', '3', '0');
INSERT INTO `cities` VALUES ('2641', '314', '佛坪县', '3', '0');
INSERT INTO `cities` VALUES ('2642', '315', '商州区', '3', '0');
INSERT INTO `cities` VALUES ('2643', '315', '洛南县', '3', '0');
INSERT INTO `cities` VALUES ('2644', '315', '丹凤县', '3', '0');
INSERT INTO `cities` VALUES ('2645', '315', '商南县', '3', '0');
INSERT INTO `cities` VALUES ('2646', '315', '山阳县', '3', '0');
INSERT INTO `cities` VALUES ('2647', '315', '镇安县', '3', '0');
INSERT INTO `cities` VALUES ('2648', '315', '柞水县', '3', '0');
INSERT INTO `cities` VALUES ('2649', '316', '耀州区', '3', '0');
INSERT INTO `cities` VALUES ('2650', '316', '王益区', '3', '0');
INSERT INTO `cities` VALUES ('2651', '316', '印台区', '3', '0');
INSERT INTO `cities` VALUES ('2652', '316', '宜君县', '3', '0');
INSERT INTO `cities` VALUES ('2653', '317', '临渭区', '3', '0');
INSERT INTO `cities` VALUES ('2654', '317', '韩城市', '3', '0');
INSERT INTO `cities` VALUES ('2655', '317', '华阴市', '3', '0');
INSERT INTO `cities` VALUES ('2656', '317', '华县', '3', '0');
INSERT INTO `cities` VALUES ('2657', '317', '潼关县', '3', '0');
INSERT INTO `cities` VALUES ('2658', '317', '大荔县', '3', '0');
INSERT INTO `cities` VALUES ('2659', '317', '合阳县', '3', '0');
INSERT INTO `cities` VALUES ('2660', '317', '澄城县', '3', '0');
INSERT INTO `cities` VALUES ('2661', '317', '蒲城县', '3', '0');
INSERT INTO `cities` VALUES ('2662', '317', '白水县', '3', '0');
INSERT INTO `cities` VALUES ('2663', '317', '富平县', '3', '0');
INSERT INTO `cities` VALUES ('2664', '318', '秦都区', '3', '0');
INSERT INTO `cities` VALUES ('2665', '318', '渭城区', '3', '0');
INSERT INTO `cities` VALUES ('2666', '318', '杨陵区', '3', '0');
INSERT INTO `cities` VALUES ('2667', '318', '兴平市', '3', '0');
INSERT INTO `cities` VALUES ('2668', '318', '三原县', '3', '0');
INSERT INTO `cities` VALUES ('2669', '318', '泾阳县', '3', '0');
INSERT INTO `cities` VALUES ('2670', '318', '乾县', '3', '0');
INSERT INTO `cities` VALUES ('2671', '318', '礼泉县', '3', '0');
INSERT INTO `cities` VALUES ('2672', '318', '永寿县', '3', '0');
INSERT INTO `cities` VALUES ('2673', '318', '彬县', '3', '0');
INSERT INTO `cities` VALUES ('2674', '318', '长武县', '3', '0');
INSERT INTO `cities` VALUES ('2675', '318', '旬邑县', '3', '0');
INSERT INTO `cities` VALUES ('2676', '318', '淳化县', '3', '0');
INSERT INTO `cities` VALUES ('2677', '318', '武功县', '3', '0');
INSERT INTO `cities` VALUES ('2678', '319', '吴起县', '3', '0');
INSERT INTO `cities` VALUES ('2679', '319', '宝塔区', '3', '0');
INSERT INTO `cities` VALUES ('2680', '319', '延长县', '3', '0');
INSERT INTO `cities` VALUES ('2681', '319', '延川县', '3', '0');
INSERT INTO `cities` VALUES ('2682', '319', '子长县', '3', '0');
INSERT INTO `cities` VALUES ('2683', '319', '安塞县', '3', '0');
INSERT INTO `cities` VALUES ('2684', '319', '志丹县', '3', '0');
INSERT INTO `cities` VALUES ('2685', '319', '甘泉县', '3', '0');
INSERT INTO `cities` VALUES ('2686', '319', '富县', '3', '0');
INSERT INTO `cities` VALUES ('2687', '319', '洛川县', '3', '0');
INSERT INTO `cities` VALUES ('2688', '319', '宜川县', '3', '0');
INSERT INTO `cities` VALUES ('2689', '319', '黄龙县', '3', '0');
INSERT INTO `cities` VALUES ('2690', '319', '黄陵县', '3', '0');
INSERT INTO `cities` VALUES ('2691', '320', '榆阳区', '3', '0');
INSERT INTO `cities` VALUES ('2692', '320', '神木县', '3', '0');
INSERT INTO `cities` VALUES ('2693', '320', '府谷县', '3', '0');
INSERT INTO `cities` VALUES ('2694', '320', '横山县', '3', '0');
INSERT INTO `cities` VALUES ('2695', '320', '靖边县', '3', '0');
INSERT INTO `cities` VALUES ('2696', '320', '定边县', '3', '0');
INSERT INTO `cities` VALUES ('2697', '320', '绥德县', '3', '0');
INSERT INTO `cities` VALUES ('2698', '320', '米脂县', '3', '0');
INSERT INTO `cities` VALUES ('2699', '320', '佳县', '3', '0');
INSERT INTO `cities` VALUES ('2700', '320', '吴堡县', '3', '0');
INSERT INTO `cities` VALUES ('2701', '320', '清涧县', '3', '0');
INSERT INTO `cities` VALUES ('2702', '320', '子洲县', '3', '0');
INSERT INTO `cities` VALUES ('2703', '321', '长宁区', '3', '0');
INSERT INTO `cities` VALUES ('2704', '321', '闸北区', '3', '0');
INSERT INTO `cities` VALUES ('2705', '321', '闵行区', '3', '0');
INSERT INTO `cities` VALUES ('2706', '321', '徐汇区', '3', '0');
INSERT INTO `cities` VALUES ('2707', '321', '浦东新区', '3', '0');
INSERT INTO `cities` VALUES ('2708', '321', '杨浦区', '3', '0');
INSERT INTO `cities` VALUES ('2709', '321', '普陀区', '3', '0');
INSERT INTO `cities` VALUES ('2710', '321', '静安区', '3', '0');
INSERT INTO `cities` VALUES ('2711', '321', '卢湾区', '3', '0');
INSERT INTO `cities` VALUES ('2712', '321', '虹口区', '3', '0');
INSERT INTO `cities` VALUES ('2713', '321', '黄浦区', '3', '0');
INSERT INTO `cities` VALUES ('2714', '321', '南汇区', '3', '0');
INSERT INTO `cities` VALUES ('2715', '321', '松江区', '3', '0');
INSERT INTO `cities` VALUES ('2716', '321', '嘉定区', '3', '0');
INSERT INTO `cities` VALUES ('2717', '321', '宝山区', '3', '0');
INSERT INTO `cities` VALUES ('2718', '321', '青浦区', '3', '0');
INSERT INTO `cities` VALUES ('2719', '321', '金山区', '3', '0');
INSERT INTO `cities` VALUES ('2720', '321', '奉贤区', '3', '0');
INSERT INTO `cities` VALUES ('2721', '321', '崇明县', '3', '0');
INSERT INTO `cities` VALUES ('2722', '322', '青羊区', '3', '0');
INSERT INTO `cities` VALUES ('2723', '322', '锦江区', '3', '0');
INSERT INTO `cities` VALUES ('2724', '322', '金牛区', '3', '0');
INSERT INTO `cities` VALUES ('2725', '322', '武侯区', '3', '0');
INSERT INTO `cities` VALUES ('2726', '322', '成华区', '3', '0');
INSERT INTO `cities` VALUES ('2727', '322', '龙泉驿区', '3', '0');
INSERT INTO `cities` VALUES ('2728', '322', '青白江区', '3', '0');
INSERT INTO `cities` VALUES ('2729', '322', '新都区', '3', '0');
INSERT INTO `cities` VALUES ('2730', '322', '温江区', '3', '0');
INSERT INTO `cities` VALUES ('2731', '322', '高新区', '3', '0');
INSERT INTO `cities` VALUES ('2732', '322', '高新西区', '3', '0');
INSERT INTO `cities` VALUES ('2733', '322', '都江堰市', '3', '0');
INSERT INTO `cities` VALUES ('2734', '322', '彭州市', '3', '0');
INSERT INTO `cities` VALUES ('2735', '322', '邛崃市', '3', '0');
INSERT INTO `cities` VALUES ('2736', '322', '崇州市', '3', '0');
INSERT INTO `cities` VALUES ('2737', '322', '金堂县', '3', '0');
INSERT INTO `cities` VALUES ('2738', '322', '双流县', '3', '0');
INSERT INTO `cities` VALUES ('2739', '322', '郫县', '3', '0');
INSERT INTO `cities` VALUES ('2740', '322', '大邑县', '3', '0');
INSERT INTO `cities` VALUES ('2741', '322', '蒲江县', '3', '0');
INSERT INTO `cities` VALUES ('2742', '322', '新津县', '3', '0');
INSERT INTO `cities` VALUES ('2743', '322', '都江堰市', '3', '0');
INSERT INTO `cities` VALUES ('2744', '322', '彭州市', '3', '0');
INSERT INTO `cities` VALUES ('2745', '322', '邛崃市', '3', '0');
INSERT INTO `cities` VALUES ('2746', '322', '崇州市', '3', '0');
INSERT INTO `cities` VALUES ('2747', '322', '金堂县', '3', '0');
INSERT INTO `cities` VALUES ('2748', '322', '双流县', '3', '0');
INSERT INTO `cities` VALUES ('2749', '322', '郫县', '3', '0');
INSERT INTO `cities` VALUES ('2750', '322', '大邑县', '3', '0');
INSERT INTO `cities` VALUES ('2751', '322', '蒲江县', '3', '0');
INSERT INTO `cities` VALUES ('2752', '322', '新津县', '3', '0');
INSERT INTO `cities` VALUES ('2753', '323', '涪城区', '3', '0');
INSERT INTO `cities` VALUES ('2754', '323', '游仙区', '3', '0');
INSERT INTO `cities` VALUES ('2755', '323', '江油市', '3', '0');
INSERT INTO `cities` VALUES ('2756', '323', '盐亭县', '3', '0');
INSERT INTO `cities` VALUES ('2757', '323', '三台县', '3', '0');
INSERT INTO `cities` VALUES ('2758', '323', '平武县', '3', '0');
INSERT INTO `cities` VALUES ('2759', '323', '安县', '3', '0');
INSERT INTO `cities` VALUES ('2760', '323', '梓潼县', '3', '0');
INSERT INTO `cities` VALUES ('2761', '323', '北川县', '3', '0');
INSERT INTO `cities` VALUES ('2762', '324', '马尔康县', '3', '0');
INSERT INTO `cities` VALUES ('2763', '324', '汶川县', '3', '0');
INSERT INTO `cities` VALUES ('2764', '324', '理县', '3', '0');
INSERT INTO `cities` VALUES ('2765', '324', '茂县', '3', '0');
INSERT INTO `cities` VALUES ('2766', '324', '松潘县', '3', '0');
INSERT INTO `cities` VALUES ('2767', '324', '九寨沟县', '3', '0');
INSERT INTO `cities` VALUES ('2768', '324', '金川县', '3', '0');
INSERT INTO `cities` VALUES ('2769', '324', '小金县', '3', '0');
INSERT INTO `cities` VALUES ('2770', '324', '黑水县', '3', '0');
INSERT INTO `cities` VALUES ('2771', '324', '壤塘县', '3', '0');
INSERT INTO `cities` VALUES ('2772', '324', '阿坝县', '3', '0');
INSERT INTO `cities` VALUES ('2773', '324', '若尔盖县', '3', '0');
INSERT INTO `cities` VALUES ('2774', '324', '红原县', '3', '0');
INSERT INTO `cities` VALUES ('2775', '325', '巴州区', '3', '0');
INSERT INTO `cities` VALUES ('2776', '325', '通江县', '3', '0');
INSERT INTO `cities` VALUES ('2777', '325', '南江县', '3', '0');
INSERT INTO `cities` VALUES ('2778', '325', '平昌县', '3', '0');
INSERT INTO `cities` VALUES ('2779', '326', '通川区', '3', '0');
INSERT INTO `cities` VALUES ('2780', '326', '万源市', '3', '0');
INSERT INTO `cities` VALUES ('2781', '326', '达县', '3', '0');
INSERT INTO `cities` VALUES ('2782', '326', '宣汉县', '3', '0');
INSERT INTO `cities` VALUES ('2783', '326', '开江县', '3', '0');
INSERT INTO `cities` VALUES ('2784', '326', '大竹县', '3', '0');
INSERT INTO `cities` VALUES ('2785', '326', '渠县', '3', '0');
INSERT INTO `cities` VALUES ('2786', '327', '旌阳区', '3', '0');
INSERT INTO `cities` VALUES ('2787', '327', '广汉市', '3', '0');
INSERT INTO `cities` VALUES ('2788', '327', '什邡市', '3', '0');
INSERT INTO `cities` VALUES ('2789', '327', '绵竹市', '3', '0');
INSERT INTO `cities` VALUES ('2790', '327', '罗江县', '3', '0');
INSERT INTO `cities` VALUES ('2791', '327', '中江县', '3', '0');
INSERT INTO `cities` VALUES ('2792', '328', '康定县', '3', '0');
INSERT INTO `cities` VALUES ('2793', '328', '丹巴县', '3', '0');
INSERT INTO `cities` VALUES ('2794', '328', '泸定县', '3', '0');
INSERT INTO `cities` VALUES ('2795', '328', '炉霍县', '3', '0');
INSERT INTO `cities` VALUES ('2796', '328', '九龙县', '3', '0');
INSERT INTO `cities` VALUES ('2797', '328', '甘孜县', '3', '0');
INSERT INTO `cities` VALUES ('2798', '328', '雅江县', '3', '0');
INSERT INTO `cities` VALUES ('2799', '328', '新龙县', '3', '0');
INSERT INTO `cities` VALUES ('2800', '328', '道孚县', '3', '0');
INSERT INTO `cities` VALUES ('2801', '328', '白玉县', '3', '0');
INSERT INTO `cities` VALUES ('2802', '328', '理塘县', '3', '0');
INSERT INTO `cities` VALUES ('2803', '328', '德格县', '3', '0');
INSERT INTO `cities` VALUES ('2804', '328', '乡城县', '3', '0');
INSERT INTO `cities` VALUES ('2805', '328', '石渠县', '3', '0');
INSERT INTO `cities` VALUES ('2806', '328', '稻城县', '3', '0');
INSERT INTO `cities` VALUES ('2807', '328', '色达县', '3', '0');
INSERT INTO `cities` VALUES ('2808', '328', '巴塘县', '3', '0');
INSERT INTO `cities` VALUES ('2809', '328', '得荣县', '3', '0');
INSERT INTO `cities` VALUES ('2810', '329', '广安区', '3', '0');
INSERT INTO `cities` VALUES ('2811', '329', '华蓥市', '3', '0');
INSERT INTO `cities` VALUES ('2812', '329', '岳池县', '3', '0');
INSERT INTO `cities` VALUES ('2813', '329', '武胜县', '3', '0');
INSERT INTO `cities` VALUES ('2814', '329', '邻水县', '3', '0');
INSERT INTO `cities` VALUES ('2815', '330', '利州区', '3', '0');
INSERT INTO `cities` VALUES ('2816', '330', '元坝区', '3', '0');
INSERT INTO `cities` VALUES ('2817', '330', '朝天区', '3', '0');
INSERT INTO `cities` VALUES ('2818', '330', '旺苍县', '3', '0');
INSERT INTO `cities` VALUES ('2819', '330', '青川县', '3', '0');
INSERT INTO `cities` VALUES ('2820', '330', '剑阁县', '3', '0');
INSERT INTO `cities` VALUES ('2821', '330', '苍溪县', '3', '0');
INSERT INTO `cities` VALUES ('2822', '331', '峨眉山市', '3', '0');
INSERT INTO `cities` VALUES ('2823', '331', '乐山市', '3', '0');
INSERT INTO `cities` VALUES ('2824', '331', '犍为县', '3', '0');
INSERT INTO `cities` VALUES ('2825', '331', '井研县', '3', '0');
INSERT INTO `cities` VALUES ('2826', '331', '夹江县', '3', '0');
INSERT INTO `cities` VALUES ('2827', '331', '沐川县', '3', '0');
INSERT INTO `cities` VALUES ('2828', '331', '峨边', '3', '0');
INSERT INTO `cities` VALUES ('2829', '331', '马边', '3', '0');
INSERT INTO `cities` VALUES ('2830', '332', '西昌市', '3', '0');
INSERT INTO `cities` VALUES ('2831', '332', '盐源县', '3', '0');
INSERT INTO `cities` VALUES ('2832', '332', '德昌县', '3', '0');
INSERT INTO `cities` VALUES ('2833', '332', '会理县', '3', '0');
INSERT INTO `cities` VALUES ('2834', '332', '会东县', '3', '0');
INSERT INTO `cities` VALUES ('2835', '332', '宁南县', '3', '0');
INSERT INTO `cities` VALUES ('2836', '332', '普格县', '3', '0');
INSERT INTO `cities` VALUES ('2837', '332', '布拖县', '3', '0');
INSERT INTO `cities` VALUES ('2838', '332', '金阳县', '3', '0');
INSERT INTO `cities` VALUES ('2839', '332', '昭觉县', '3', '0');
INSERT INTO `cities` VALUES ('2840', '332', '喜德县', '3', '0');
INSERT INTO `cities` VALUES ('2841', '332', '冕宁县', '3', '0');
INSERT INTO `cities` VALUES ('2842', '332', '越西县', '3', '0');
INSERT INTO `cities` VALUES ('2843', '332', '甘洛县', '3', '0');
INSERT INTO `cities` VALUES ('2844', '332', '美姑县', '3', '0');
INSERT INTO `cities` VALUES ('2845', '332', '雷波县', '3', '0');
INSERT INTO `cities` VALUES ('2846', '332', '木里', '3', '0');
INSERT INTO `cities` VALUES ('2847', '333', '东坡区', '3', '0');
INSERT INTO `cities` VALUES ('2848', '333', '仁寿县', '3', '0');
INSERT INTO `cities` VALUES ('2849', '333', '彭山县', '3', '0');
INSERT INTO `cities` VALUES ('2850', '333', '洪雅县', '3', '0');
INSERT INTO `cities` VALUES ('2851', '333', '丹棱县', '3', '0');
INSERT INTO `cities` VALUES ('2852', '333', '青神县', '3', '0');
INSERT INTO `cities` VALUES ('2853', '334', '阆中市', '3', '0');
INSERT INTO `cities` VALUES ('2854', '334', '南部县', '3', '0');
INSERT INTO `cities` VALUES ('2855', '334', '营山县', '3', '0');
INSERT INTO `cities` VALUES ('2856', '334', '蓬安县', '3', '0');
INSERT INTO `cities` VALUES ('2857', '334', '仪陇县', '3', '0');
INSERT INTO `cities` VALUES ('2858', '334', '顺庆区', '3', '0');
INSERT INTO `cities` VALUES ('2859', '334', '高坪区', '3', '0');
INSERT INTO `cities` VALUES ('2860', '334', '嘉陵区', '3', '0');
INSERT INTO `cities` VALUES ('2861', '334', '西充县', '3', '0');
INSERT INTO `cities` VALUES ('2862', '335', '市中区', '3', '0');
INSERT INTO `cities` VALUES ('2863', '335', '东兴区', '3', '0');
INSERT INTO `cities` VALUES ('2864', '335', '威远县', '3', '0');
INSERT INTO `cities` VALUES ('2865', '335', '资中县', '3', '0');
INSERT INTO `cities` VALUES ('2866', '335', '隆昌县', '3', '0');
INSERT INTO `cities` VALUES ('2867', '336', '东  区', '3', '0');
INSERT INTO `cities` VALUES ('2868', '336', '西  区', '3', '0');
INSERT INTO `cities` VALUES ('2869', '336', '仁和区', '3', '0');
INSERT INTO `cities` VALUES ('2870', '336', '米易县', '3', '0');
INSERT INTO `cities` VALUES ('2871', '336', '盐边县', '3', '0');
INSERT INTO `cities` VALUES ('2872', '337', '船山区', '3', '0');
INSERT INTO `cities` VALUES ('2873', '337', '安居区', '3', '0');
INSERT INTO `cities` VALUES ('2874', '337', '蓬溪县', '3', '0');
INSERT INTO `cities` VALUES ('2875', '337', '射洪县', '3', '0');
INSERT INTO `cities` VALUES ('2876', '337', '大英县', '3', '0');
INSERT INTO `cities` VALUES ('2877', '338', '雨城区', '3', '0');
INSERT INTO `cities` VALUES ('2878', '338', '名山县', '3', '0');
INSERT INTO `cities` VALUES ('2879', '338', '荥经县', '3', '0');
INSERT INTO `cities` VALUES ('2880', '338', '汉源县', '3', '0');
INSERT INTO `cities` VALUES ('2881', '338', '石棉县', '3', '0');
INSERT INTO `cities` VALUES ('2882', '338', '天全县', '3', '0');
INSERT INTO `cities` VALUES ('2883', '338', '芦山县', '3', '0');
INSERT INTO `cities` VALUES ('2884', '338', '宝兴县', '3', '0');
INSERT INTO `cities` VALUES ('2885', '339', '翠屏区', '3', '0');
INSERT INTO `cities` VALUES ('2886', '339', '宜宾县', '3', '0');
INSERT INTO `cities` VALUES ('2887', '339', '南溪县', '3', '0');
INSERT INTO `cities` VALUES ('2888', '339', '江安县', '3', '0');
INSERT INTO `cities` VALUES ('2889', '339', '长宁县', '3', '0');
INSERT INTO `cities` VALUES ('2890', '339', '高县', '3', '0');
INSERT INTO `cities` VALUES ('2891', '339', '珙县', '3', '0');
INSERT INTO `cities` VALUES ('2892', '339', '筠连县', '3', '0');
INSERT INTO `cities` VALUES ('2893', '339', '兴文县', '3', '0');
INSERT INTO `cities` VALUES ('2894', '339', '屏山县', '3', '0');
INSERT INTO `cities` VALUES ('2895', '340', '雁江区', '3', '0');
INSERT INTO `cities` VALUES ('2896', '340', '简阳市', '3', '0');
INSERT INTO `cities` VALUES ('2897', '340', '安岳县', '3', '0');
INSERT INTO `cities` VALUES ('2898', '340', '乐至县', '3', '0');
INSERT INTO `cities` VALUES ('2899', '341', '大安区', '3', '0');
INSERT INTO `cities` VALUES ('2900', '341', '自流井区', '3', '0');
INSERT INTO `cities` VALUES ('2901', '341', '贡井区', '3', '0');
INSERT INTO `cities` VALUES ('2902', '341', '沿滩区', '3', '0');
INSERT INTO `cities` VALUES ('2903', '341', '荣县', '3', '0');
INSERT INTO `cities` VALUES ('2904', '341', '富顺县', '3', '0');
INSERT INTO `cities` VALUES ('2905', '342', '江阳区', '3', '0');
INSERT INTO `cities` VALUES ('2906', '342', '纳溪区', '3', '0');
INSERT INTO `cities` VALUES ('2907', '342', '龙马潭区', '3', '0');
INSERT INTO `cities` VALUES ('2908', '342', '泸县', '3', '0');
INSERT INTO `cities` VALUES ('2909', '342', '合江县', '3', '0');
INSERT INTO `cities` VALUES ('2910', '342', '叙永县', '3', '0');
INSERT INTO `cities` VALUES ('2911', '342', '古蔺县', '3', '0');
INSERT INTO `cities` VALUES ('2912', '343', '和平区', '3', '0');
INSERT INTO `cities` VALUES ('2913', '343', '河西区', '3', '0');
INSERT INTO `cities` VALUES ('2914', '343', '南开区', '3', '0');
INSERT INTO `cities` VALUES ('2915', '343', '河北区', '3', '0');
INSERT INTO `cities` VALUES ('2916', '343', '河东区', '3', '0');
INSERT INTO `cities` VALUES ('2917', '343', '红桥区', '3', '0');
INSERT INTO `cities` VALUES ('2918', '343', '东丽区', '3', '0');
INSERT INTO `cities` VALUES ('2919', '343', '津南区', '3', '0');
INSERT INTO `cities` VALUES ('2920', '343', '西青区', '3', '0');
INSERT INTO `cities` VALUES ('2921', '343', '北辰区', '3', '0');
INSERT INTO `cities` VALUES ('2922', '343', '塘沽区', '3', '0');
INSERT INTO `cities` VALUES ('2923', '343', '汉沽区', '3', '0');
INSERT INTO `cities` VALUES ('2924', '343', '大港区', '3', '0');
INSERT INTO `cities` VALUES ('2925', '343', '武清区', '3', '0');
INSERT INTO `cities` VALUES ('2926', '343', '宝坻区', '3', '0');
INSERT INTO `cities` VALUES ('2927', '343', '经济开发区', '3', '0');
INSERT INTO `cities` VALUES ('2928', '343', '宁河县', '3', '0');
INSERT INTO `cities` VALUES ('2929', '343', '静海县', '3', '0');
INSERT INTO `cities` VALUES ('2930', '343', '蓟县', '3', '0');
INSERT INTO `cities` VALUES ('2931', '344', '城关区', '3', '0');
INSERT INTO `cities` VALUES ('2932', '344', '林周县', '3', '0');
INSERT INTO `cities` VALUES ('2933', '344', '当雄县', '3', '0');
INSERT INTO `cities` VALUES ('2934', '344', '尼木县', '3', '0');
INSERT INTO `cities` VALUES ('2935', '344', '曲水县', '3', '0');
INSERT INTO `cities` VALUES ('2936', '344', '堆龙德庆县', '3', '0');
INSERT INTO `cities` VALUES ('2937', '344', '达孜县', '3', '0');
INSERT INTO `cities` VALUES ('2938', '344', '墨竹工卡县', '3', '0');
INSERT INTO `cities` VALUES ('2939', '345', '噶尔县', '3', '0');
INSERT INTO `cities` VALUES ('2940', '345', '普兰县', '3', '0');
INSERT INTO `cities` VALUES ('2941', '345', '札达县', '3', '0');
INSERT INTO `cities` VALUES ('2942', '345', '日土县', '3', '0');
INSERT INTO `cities` VALUES ('2943', '345', '革吉县', '3', '0');
INSERT INTO `cities` VALUES ('2944', '345', '改则县', '3', '0');
INSERT INTO `cities` VALUES ('2945', '345', '措勤县', '3', '0');
INSERT INTO `cities` VALUES ('2946', '346', '昌都县', '3', '0');
INSERT INTO `cities` VALUES ('2947', '346', '江达县', '3', '0');
INSERT INTO `cities` VALUES ('2948', '346', '贡觉县', '3', '0');
INSERT INTO `cities` VALUES ('2949', '346', '类乌齐县', '3', '0');
INSERT INTO `cities` VALUES ('2950', '346', '丁青县', '3', '0');
INSERT INTO `cities` VALUES ('2951', '346', '察雅县', '3', '0');
INSERT INTO `cities` VALUES ('2952', '346', '八宿县', '3', '0');
INSERT INTO `cities` VALUES ('2953', '346', '左贡县', '3', '0');
INSERT INTO `cities` VALUES ('2954', '346', '芒康县', '3', '0');
INSERT INTO `cities` VALUES ('2955', '346', '洛隆县', '3', '0');
INSERT INTO `cities` VALUES ('2956', '346', '边坝县', '3', '0');
INSERT INTO `cities` VALUES ('2957', '347', '林芝县', '3', '0');
INSERT INTO `cities` VALUES ('2958', '347', '工布江达县', '3', '0');
INSERT INTO `cities` VALUES ('2959', '347', '米林县', '3', '0');
INSERT INTO `cities` VALUES ('2960', '347', '墨脱县', '3', '0');
INSERT INTO `cities` VALUES ('2961', '347', '波密县', '3', '0');
INSERT INTO `cities` VALUES ('2962', '347', '察隅县', '3', '0');
INSERT INTO `cities` VALUES ('2963', '347', '朗县', '3', '0');
INSERT INTO `cities` VALUES ('2964', '348', '那曲县', '3', '0');
INSERT INTO `cities` VALUES ('2965', '348', '嘉黎县', '3', '0');
INSERT INTO `cities` VALUES ('2966', '348', '比如县', '3', '0');
INSERT INTO `cities` VALUES ('2967', '348', '聂荣县', '3', '0');
INSERT INTO `cities` VALUES ('2968', '348', '安多县', '3', '0');
INSERT INTO `cities` VALUES ('2969', '348', '申扎县', '3', '0');
INSERT INTO `cities` VALUES ('2970', '348', '索县', '3', '0');
INSERT INTO `cities` VALUES ('2971', '348', '班戈县', '3', '0');
INSERT INTO `cities` VALUES ('2972', '348', '巴青县', '3', '0');
INSERT INTO `cities` VALUES ('2973', '348', '尼玛县', '3', '0');
INSERT INTO `cities` VALUES ('2974', '349', '日喀则市', '3', '0');
INSERT INTO `cities` VALUES ('2975', '349', '南木林县', '3', '0');
INSERT INTO `cities` VALUES ('2976', '349', '江孜县', '3', '0');
INSERT INTO `cities` VALUES ('2977', '349', '定日县', '3', '0');
INSERT INTO `cities` VALUES ('2978', '349', '萨迦县', '3', '0');
INSERT INTO `cities` VALUES ('2979', '349', '拉孜县', '3', '0');
INSERT INTO `cities` VALUES ('2980', '349', '昂仁县', '3', '0');
INSERT INTO `cities` VALUES ('2981', '349', '谢通门县', '3', '0');
INSERT INTO `cities` VALUES ('2982', '349', '白朗县', '3', '0');
INSERT INTO `cities` VALUES ('2983', '349', '仁布县', '3', '0');
INSERT INTO `cities` VALUES ('2984', '349', '康马县', '3', '0');
INSERT INTO `cities` VALUES ('2985', '349', '定结县', '3', '0');
INSERT INTO `cities` VALUES ('2986', '349', '仲巴县', '3', '0');
INSERT INTO `cities` VALUES ('2987', '349', '亚东县', '3', '0');
INSERT INTO `cities` VALUES ('2988', '349', '吉隆县', '3', '0');
INSERT INTO `cities` VALUES ('2989', '349', '聂拉木县', '3', '0');
INSERT INTO `cities` VALUES ('2990', '349', '萨嘎县', '3', '0');
INSERT INTO `cities` VALUES ('2991', '349', '岗巴县', '3', '0');
INSERT INTO `cities` VALUES ('2992', '350', '乃东县', '3', '0');
INSERT INTO `cities` VALUES ('2993', '350', '扎囊县', '3', '0');
INSERT INTO `cities` VALUES ('2994', '350', '贡嘎县', '3', '0');
INSERT INTO `cities` VALUES ('2995', '350', '桑日县', '3', '0');
INSERT INTO `cities` VALUES ('2996', '350', '琼结县', '3', '0');
INSERT INTO `cities` VALUES ('2997', '350', '曲松县', '3', '0');
INSERT INTO `cities` VALUES ('2998', '350', '措美县', '3', '0');
INSERT INTO `cities` VALUES ('2999', '350', '洛扎县', '3', '0');
INSERT INTO `cities` VALUES ('3000', '350', '加查县', '3', '0');
INSERT INTO `cities` VALUES ('3001', '350', '隆子县', '3', '0');
INSERT INTO `cities` VALUES ('3002', '350', '错那县', '3', '0');
INSERT INTO `cities` VALUES ('3003', '350', '浪卡子县', '3', '0');
INSERT INTO `cities` VALUES ('3004', '351', '天山区', '3', '0');
INSERT INTO `cities` VALUES ('3005', '351', '沙依巴克区', '3', '0');
INSERT INTO `cities` VALUES ('3006', '351', '新市区', '3', '0');
INSERT INTO `cities` VALUES ('3007', '351', '水磨沟区', '3', '0');
INSERT INTO `cities` VALUES ('3008', '351', '头屯河区', '3', '0');
INSERT INTO `cities` VALUES ('3009', '351', '达坂城区', '3', '0');
INSERT INTO `cities` VALUES ('3010', '351', '米东区', '3', '0');
INSERT INTO `cities` VALUES ('3011', '351', '乌鲁木齐县', '3', '0');
INSERT INTO `cities` VALUES ('3012', '352', '阿克苏市', '3', '0');
INSERT INTO `cities` VALUES ('3013', '352', '温宿县', '3', '0');
INSERT INTO `cities` VALUES ('3014', '352', '库车县', '3', '0');
INSERT INTO `cities` VALUES ('3015', '352', '沙雅县', '3', '0');
INSERT INTO `cities` VALUES ('3016', '352', '新和县', '3', '0');
INSERT INTO `cities` VALUES ('3017', '352', '拜城县', '3', '0');
INSERT INTO `cities` VALUES ('3018', '352', '乌什县', '3', '0');
INSERT INTO `cities` VALUES ('3019', '352', '阿瓦提县', '3', '0');
INSERT INTO `cities` VALUES ('3020', '352', '柯坪县', '3', '0');
INSERT INTO `cities` VALUES ('3021', '353', '阿拉尔市', '3', '0');
INSERT INTO `cities` VALUES ('3022', '354', '库尔勒市', '3', '0');
INSERT INTO `cities` VALUES ('3023', '354', '轮台县', '3', '0');
INSERT INTO `cities` VALUES ('3024', '354', '尉犁县', '3', '0');
INSERT INTO `cities` VALUES ('3025', '354', '若羌县', '3', '0');
INSERT INTO `cities` VALUES ('3026', '354', '且末县', '3', '0');
INSERT INTO `cities` VALUES ('3027', '354', '焉耆', '3', '0');
INSERT INTO `cities` VALUES ('3028', '354', '和静县', '3', '0');
INSERT INTO `cities` VALUES ('3029', '354', '和硕县', '3', '0');
INSERT INTO `cities` VALUES ('3030', '354', '博湖县', '3', '0');
INSERT INTO `cities` VALUES ('3031', '355', '博乐市', '3', '0');
INSERT INTO `cities` VALUES ('3032', '355', '精河县', '3', '0');
INSERT INTO `cities` VALUES ('3033', '355', '温泉县', '3', '0');
INSERT INTO `cities` VALUES ('3034', '356', '呼图壁县', '3', '0');
INSERT INTO `cities` VALUES ('3035', '356', '米泉市', '3', '0');
INSERT INTO `cities` VALUES ('3036', '356', '昌吉市', '3', '0');
INSERT INTO `cities` VALUES ('3037', '356', '阜康市', '3', '0');
INSERT INTO `cities` VALUES ('3038', '356', '玛纳斯县', '3', '0');
INSERT INTO `cities` VALUES ('3039', '356', '奇台县', '3', '0');
INSERT INTO `cities` VALUES ('3040', '356', '吉木萨尔县', '3', '0');
INSERT INTO `cities` VALUES ('3041', '356', '木垒', '3', '0');
INSERT INTO `cities` VALUES ('3042', '357', '哈密市', '3', '0');
INSERT INTO `cities` VALUES ('3043', '357', '伊吾县', '3', '0');
INSERT INTO `cities` VALUES ('3044', '357', '巴里坤', '3', '0');
INSERT INTO `cities` VALUES ('3045', '358', '和田市', '3', '0');
INSERT INTO `cities` VALUES ('3046', '358', '和田县', '3', '0');
INSERT INTO `cities` VALUES ('3047', '358', '墨玉县', '3', '0');
INSERT INTO `cities` VALUES ('3048', '358', '皮山县', '3', '0');
INSERT INTO `cities` VALUES ('3049', '358', '洛浦县', '3', '0');
INSERT INTO `cities` VALUES ('3050', '358', '策勒县', '3', '0');
INSERT INTO `cities` VALUES ('3051', '358', '于田县', '3', '0');
INSERT INTO `cities` VALUES ('3052', '358', '民丰县', '3', '0');
INSERT INTO `cities` VALUES ('3053', '359', '喀什市', '3', '0');
INSERT INTO `cities` VALUES ('3054', '359', '疏附县', '3', '0');
INSERT INTO `cities` VALUES ('3055', '359', '疏勒县', '3', '0');
INSERT INTO `cities` VALUES ('3056', '359', '英吉沙县', '3', '0');
INSERT INTO `cities` VALUES ('3057', '359', '泽普县', '3', '0');
INSERT INTO `cities` VALUES ('3058', '359', '莎车县', '3', '0');
INSERT INTO `cities` VALUES ('3059', '359', '叶城县', '3', '0');
INSERT INTO `cities` VALUES ('3060', '359', '麦盖提县', '3', '0');
INSERT INTO `cities` VALUES ('3061', '359', '岳普湖县', '3', '0');
INSERT INTO `cities` VALUES ('3062', '359', '伽师县', '3', '0');
INSERT INTO `cities` VALUES ('3063', '359', '巴楚县', '3', '0');
INSERT INTO `cities` VALUES ('3064', '359', '塔什库尔干', '3', '0');
INSERT INTO `cities` VALUES ('3065', '360', '克拉玛依市', '3', '0');
INSERT INTO `cities` VALUES ('3066', '361', '阿图什市', '3', '0');
INSERT INTO `cities` VALUES ('3067', '361', '阿克陶县', '3', '0');
INSERT INTO `cities` VALUES ('3068', '361', '阿合奇县', '3', '0');
INSERT INTO `cities` VALUES ('3069', '361', '乌恰县', '3', '0');
INSERT INTO `cities` VALUES ('3070', '362', '石河子市', '3', '0');
INSERT INTO `cities` VALUES ('3071', '363', '图木舒克市', '3', '0');
INSERT INTO `cities` VALUES ('3072', '364', '吐鲁番市', '3', '0');
INSERT INTO `cities` VALUES ('3073', '364', '鄯善县', '3', '0');
INSERT INTO `cities` VALUES ('3074', '364', '托克逊县', '3', '0');
INSERT INTO `cities` VALUES ('3075', '365', '五家渠市', '3', '0');
INSERT INTO `cities` VALUES ('3076', '366', '阿勒泰市', '3', '0');
INSERT INTO `cities` VALUES ('3077', '366', '布克赛尔', '3', '0');
INSERT INTO `cities` VALUES ('3078', '366', '伊宁市', '3', '0');
INSERT INTO `cities` VALUES ('3079', '366', '布尔津县', '3', '0');
INSERT INTO `cities` VALUES ('3080', '366', '奎屯市', '3', '0');
INSERT INTO `cities` VALUES ('3081', '366', '乌苏市', '3', '0');
INSERT INTO `cities` VALUES ('3082', '366', '额敏县', '3', '0');
INSERT INTO `cities` VALUES ('3083', '366', '富蕴县', '3', '0');
INSERT INTO `cities` VALUES ('3084', '366', '伊宁县', '3', '0');
INSERT INTO `cities` VALUES ('3085', '366', '福海县', '3', '0');
INSERT INTO `cities` VALUES ('3086', '366', '霍城县', '3', '0');
INSERT INTO `cities` VALUES ('3087', '366', '沙湾县', '3', '0');
INSERT INTO `cities` VALUES ('3088', '366', '巩留县', '3', '0');
INSERT INTO `cities` VALUES ('3089', '366', '哈巴河县', '3', '0');
INSERT INTO `cities` VALUES ('3090', '366', '托里县', '3', '0');
INSERT INTO `cities` VALUES ('3091', '366', '青河县', '3', '0');
INSERT INTO `cities` VALUES ('3092', '366', '新源县', '3', '0');
INSERT INTO `cities` VALUES ('3093', '366', '裕民县', '3', '0');
INSERT INTO `cities` VALUES ('3094', '366', '和布克赛尔', '3', '0');
INSERT INTO `cities` VALUES ('3095', '366', '吉木乃县', '3', '0');
INSERT INTO `cities` VALUES ('3096', '366', '昭苏县', '3', '0');
INSERT INTO `cities` VALUES ('3097', '366', '特克斯县', '3', '0');
INSERT INTO `cities` VALUES ('3098', '366', '尼勒克县', '3', '0');
INSERT INTO `cities` VALUES ('3099', '366', '察布查尔', '3', '0');
INSERT INTO `cities` VALUES ('3100', '367', '盘龙区', '3', '0');
INSERT INTO `cities` VALUES ('3101', '367', '五华区', '3', '0');
INSERT INTO `cities` VALUES ('3102', '367', '官渡区', '3', '0');
INSERT INTO `cities` VALUES ('3103', '367', '西山区', '3', '0');
INSERT INTO `cities` VALUES ('3104', '367', '东川区', '3', '0');
INSERT INTO `cities` VALUES ('3105', '367', '安宁市', '3', '0');
INSERT INTO `cities` VALUES ('3106', '367', '呈贡县', '3', '0');
INSERT INTO `cities` VALUES ('3107', '367', '晋宁县', '3', '0');
INSERT INTO `cities` VALUES ('3108', '367', '富民县', '3', '0');
INSERT INTO `cities` VALUES ('3109', '367', '宜良县', '3', '0');
INSERT INTO `cities` VALUES ('3110', '367', '嵩明县', '3', '0');
INSERT INTO `cities` VALUES ('3111', '367', '石林县', '3', '0');
INSERT INTO `cities` VALUES ('3112', '367', '禄劝', '3', '0');
INSERT INTO `cities` VALUES ('3113', '367', '寻甸', '3', '0');
INSERT INTO `cities` VALUES ('3114', '368', '兰坪', '3', '0');
INSERT INTO `cities` VALUES ('3115', '368', '泸水县', '3', '0');
INSERT INTO `cities` VALUES ('3116', '368', '福贡县', '3', '0');
INSERT INTO `cities` VALUES ('3117', '368', '贡山', '3', '0');
INSERT INTO `cities` VALUES ('3118', '369', '宁洱', '3', '0');
INSERT INTO `cities` VALUES ('3119', '369', '思茅区', '3', '0');
INSERT INTO `cities` VALUES ('3120', '369', '墨江', '3', '0');
INSERT INTO `cities` VALUES ('3121', '369', '景东', '3', '0');
INSERT INTO `cities` VALUES ('3122', '369', '景谷', '3', '0');
INSERT INTO `cities` VALUES ('3123', '369', '镇沅', '3', '0');
INSERT INTO `cities` VALUES ('3124', '369', '江城', '3', '0');
INSERT INTO `cities` VALUES ('3125', '369', '孟连', '3', '0');
INSERT INTO `cities` VALUES ('3126', '369', '澜沧', '3', '0');
INSERT INTO `cities` VALUES ('3127', '369', '西盟', '3', '0');
INSERT INTO `cities` VALUES ('3128', '370', '古城区', '3', '0');
INSERT INTO `cities` VALUES ('3129', '370', '宁蒗', '3', '0');
INSERT INTO `cities` VALUES ('3130', '370', '玉龙', '3', '0');
INSERT INTO `cities` VALUES ('3131', '370', '永胜县', '3', '0');
INSERT INTO `cities` VALUES ('3132', '370', '华坪县', '3', '0');
INSERT INTO `cities` VALUES ('3133', '371', '隆阳区', '3', '0');
INSERT INTO `cities` VALUES ('3134', '371', '施甸县', '3', '0');
INSERT INTO `cities` VALUES ('3135', '371', '腾冲县', '3', '0');
INSERT INTO `cities` VALUES ('3136', '371', '龙陵县', '3', '0');
INSERT INTO `cities` VALUES ('3137', '371', '昌宁县', '3', '0');
INSERT INTO `cities` VALUES ('3138', '372', '楚雄市', '3', '0');
INSERT INTO `cities` VALUES ('3139', '372', '双柏县', '3', '0');
INSERT INTO `cities` VALUES ('3140', '372', '牟定县', '3', '0');
INSERT INTO `cities` VALUES ('3141', '372', '南华县', '3', '0');
INSERT INTO `cities` VALUES ('3142', '372', '姚安县', '3', '0');
INSERT INTO `cities` VALUES ('3143', '372', '大姚县', '3', '0');
INSERT INTO `cities` VALUES ('3144', '372', '永仁县', '3', '0');
INSERT INTO `cities` VALUES ('3145', '372', '元谋县', '3', '0');
INSERT INTO `cities` VALUES ('3146', '372', '武定县', '3', '0');
INSERT INTO `cities` VALUES ('3147', '372', '禄丰县', '3', '0');
INSERT INTO `cities` VALUES ('3148', '373', '大理市', '3', '0');
INSERT INTO `cities` VALUES ('3149', '373', '祥云县', '3', '0');
INSERT INTO `cities` VALUES ('3150', '373', '宾川县', '3', '0');
INSERT INTO `cities` VALUES ('3151', '373', '弥渡县', '3', '0');
INSERT INTO `cities` VALUES ('3152', '373', '永平县', '3', '0');
INSERT INTO `cities` VALUES ('3153', '373', '云龙县', '3', '0');
INSERT INTO `cities` VALUES ('3154', '373', '洱源县', '3', '0');
INSERT INTO `cities` VALUES ('3155', '373', '剑川县', '3', '0');
INSERT INTO `cities` VALUES ('3156', '373', '鹤庆县', '3', '0');
INSERT INTO `cities` VALUES ('3157', '373', '漾濞', '3', '0');
INSERT INTO `cities` VALUES ('3158', '373', '南涧', '3', '0');
INSERT INTO `cities` VALUES ('3159', '373', '巍山', '3', '0');
INSERT INTO `cities` VALUES ('3160', '374', '潞西市', '3', '0');
INSERT INTO `cities` VALUES ('3161', '374', '瑞丽市', '3', '0');
INSERT INTO `cities` VALUES ('3162', '374', '梁河县', '3', '0');
INSERT INTO `cities` VALUES ('3163', '374', '盈江县', '3', '0');
INSERT INTO `cities` VALUES ('3164', '374', '陇川县', '3', '0');
INSERT INTO `cities` VALUES ('3165', '375', '香格里拉县', '3', '0');
INSERT INTO `cities` VALUES ('3166', '375', '德钦县', '3', '0');
INSERT INTO `cities` VALUES ('3167', '375', '维西', '3', '0');
INSERT INTO `cities` VALUES ('3168', '376', '泸西县', '3', '0');
INSERT INTO `cities` VALUES ('3169', '376', '蒙自县', '3', '0');
INSERT INTO `cities` VALUES ('3170', '376', '个旧市', '3', '0');
INSERT INTO `cities` VALUES ('3171', '376', '开远市', '3', '0');
INSERT INTO `cities` VALUES ('3172', '376', '绿春县', '3', '0');
INSERT INTO `cities` VALUES ('3173', '376', '建水县', '3', '0');
INSERT INTO `cities` VALUES ('3174', '376', '石屏县', '3', '0');
INSERT INTO `cities` VALUES ('3175', '376', '弥勒县', '3', '0');
INSERT INTO `cities` VALUES ('3176', '376', '元阳县', '3', '0');
INSERT INTO `cities` VALUES ('3177', '376', '红河县', '3', '0');
INSERT INTO `cities` VALUES ('3178', '376', '金平', '3', '0');
INSERT INTO `cities` VALUES ('3179', '376', '河口', '3', '0');
INSERT INTO `cities` VALUES ('3180', '376', '屏边', '3', '0');
INSERT INTO `cities` VALUES ('3181', '377', '临翔区', '3', '0');
INSERT INTO `cities` VALUES ('3182', '377', '凤庆县', '3', '0');
INSERT INTO `cities` VALUES ('3183', '377', '云县', '3', '0');
INSERT INTO `cities` VALUES ('3184', '377', '永德县', '3', '0');
INSERT INTO `cities` VALUES ('3185', '377', '镇康县', '3', '0');
INSERT INTO `cities` VALUES ('3186', '377', '双江', '3', '0');
INSERT INTO `cities` VALUES ('3187', '377', '耿马', '3', '0');
INSERT INTO `cities` VALUES ('3188', '377', '沧源', '3', '0');
INSERT INTO `cities` VALUES ('3189', '378', '麒麟区', '3', '0');
INSERT INTO `cities` VALUES ('3190', '378', '宣威市', '3', '0');
INSERT INTO `cities` VALUES ('3191', '378', '马龙县', '3', '0');
INSERT INTO `cities` VALUES ('3192', '378', '陆良县', '3', '0');
INSERT INTO `cities` VALUES ('3193', '378', '师宗县', '3', '0');
INSERT INTO `cities` VALUES ('3194', '378', '罗平县', '3', '0');
INSERT INTO `cities` VALUES ('3195', '378', '富源县', '3', '0');
INSERT INTO `cities` VALUES ('3196', '378', '会泽县', '3', '0');
INSERT INTO `cities` VALUES ('3197', '378', '沾益县', '3', '0');
INSERT INTO `cities` VALUES ('3198', '379', '文山县', '3', '0');
INSERT INTO `cities` VALUES ('3199', '379', '砚山县', '3', '0');
INSERT INTO `cities` VALUES ('3200', '379', '西畴县', '3', '0');
INSERT INTO `cities` VALUES ('3201', '379', '麻栗坡县', '3', '0');
INSERT INTO `cities` VALUES ('3202', '379', '马关县', '3', '0');
INSERT INTO `cities` VALUES ('3203', '379', '丘北县', '3', '0');
INSERT INTO `cities` VALUES ('3204', '379', '广南县', '3', '0');
INSERT INTO `cities` VALUES ('3205', '379', '富宁县', '3', '0');
INSERT INTO `cities` VALUES ('3206', '380', '景洪市', '3', '0');
INSERT INTO `cities` VALUES ('3207', '380', '勐海县', '3', '0');
INSERT INTO `cities` VALUES ('3208', '380', '勐腊县', '3', '0');
INSERT INTO `cities` VALUES ('3209', '381', '红塔区', '3', '0');
INSERT INTO `cities` VALUES ('3210', '381', '江川县', '3', '0');
INSERT INTO `cities` VALUES ('3211', '381', '澄江县', '3', '0');
INSERT INTO `cities` VALUES ('3212', '381', '通海县', '3', '0');
INSERT INTO `cities` VALUES ('3213', '381', '华宁县', '3', '0');
INSERT INTO `cities` VALUES ('3214', '381', '易门县', '3', '0');
INSERT INTO `cities` VALUES ('3215', '381', '峨山', '3', '0');
INSERT INTO `cities` VALUES ('3216', '381', '新平', '3', '0');
INSERT INTO `cities` VALUES ('3217', '381', '元江', '3', '0');
INSERT INTO `cities` VALUES ('3218', '382', '昭阳区', '3', '0');
INSERT INTO `cities` VALUES ('3219', '382', '鲁甸县', '3', '0');
INSERT INTO `cities` VALUES ('3220', '382', '巧家县', '3', '0');
INSERT INTO `cities` VALUES ('3221', '382', '盐津县', '3', '0');
INSERT INTO `cities` VALUES ('3222', '382', '大关县', '3', '0');
INSERT INTO `cities` VALUES ('3223', '382', '永善县', '3', '0');
INSERT INTO `cities` VALUES ('3224', '382', '绥江县', '3', '0');
INSERT INTO `cities` VALUES ('3225', '382', '镇雄县', '3', '0');
INSERT INTO `cities` VALUES ('3226', '382', '彝良县', '3', '0');
INSERT INTO `cities` VALUES ('3227', '382', '威信县', '3', '0');
INSERT INTO `cities` VALUES ('3228', '382', '水富县', '3', '0');
INSERT INTO `cities` VALUES ('3229', '383', '西湖区', '3', '0');
INSERT INTO `cities` VALUES ('3230', '383', '上城区', '3', '0');
INSERT INTO `cities` VALUES ('3231', '383', '下城区', '3', '0');
INSERT INTO `cities` VALUES ('3232', '383', '拱墅区', '3', '0');
INSERT INTO `cities` VALUES ('3233', '383', '滨江区', '3', '0');
INSERT INTO `cities` VALUES ('3234', '383', '江干区', '3', '0');
INSERT INTO `cities` VALUES ('3235', '383', '萧山区', '3', '0');
INSERT INTO `cities` VALUES ('3236', '383', '余杭区', '3', '0');
INSERT INTO `cities` VALUES ('3237', '383', '市郊', '3', '0');
INSERT INTO `cities` VALUES ('3238', '383', '建德市', '3', '0');
INSERT INTO `cities` VALUES ('3239', '383', '富阳市', '3', '0');
INSERT INTO `cities` VALUES ('3240', '383', '临安市', '3', '0');
INSERT INTO `cities` VALUES ('3241', '383', '桐庐县', '3', '0');
INSERT INTO `cities` VALUES ('3242', '383', '淳安县', '3', '0');
INSERT INTO `cities` VALUES ('3243', '384', '吴兴区', '3', '0');
INSERT INTO `cities` VALUES ('3244', '384', '南浔区', '3', '0');
INSERT INTO `cities` VALUES ('3245', '384', '德清县', '3', '0');
INSERT INTO `cities` VALUES ('3246', '384', '长兴县', '3', '0');
INSERT INTO `cities` VALUES ('3247', '384', '安吉县', '3', '0');
INSERT INTO `cities` VALUES ('3248', '385', '南湖区', '3', '0');
INSERT INTO `cities` VALUES ('3249', '385', '秀洲区', '3', '0');
INSERT INTO `cities` VALUES ('3250', '385', '海宁市', '3', '0');
INSERT INTO `cities` VALUES ('3251', '385', '嘉善县', '3', '0');
INSERT INTO `cities` VALUES ('3252', '385', '平湖市', '3', '0');
INSERT INTO `cities` VALUES ('3253', '385', '桐乡市', '3', '0');
INSERT INTO `cities` VALUES ('3254', '385', '海盐县', '3', '0');
INSERT INTO `cities` VALUES ('3255', '386', '婺城区', '3', '0');
INSERT INTO `cities` VALUES ('3256', '386', '金东区', '3', '0');
INSERT INTO `cities` VALUES ('3257', '386', '兰溪市', '3', '0');
INSERT INTO `cities` VALUES ('3258', '386', '市区', '3', '0');
INSERT INTO `cities` VALUES ('3259', '386', '佛堂镇', '3', '0');
INSERT INTO `cities` VALUES ('3260', '386', '上溪镇', '3', '0');
INSERT INTO `cities` VALUES ('3261', '386', '义亭镇', '3', '0');
INSERT INTO `cities` VALUES ('3262', '386', '大陈镇', '3', '0');
INSERT INTO `cities` VALUES ('3263', '386', '苏溪镇', '3', '0');
INSERT INTO `cities` VALUES ('3264', '386', '赤岸镇', '3', '0');
INSERT INTO `cities` VALUES ('3265', '386', '东阳市', '3', '0');
INSERT INTO `cities` VALUES ('3266', '386', '永康市', '3', '0');
INSERT INTO `cities` VALUES ('3267', '386', '武义县', '3', '0');
INSERT INTO `cities` VALUES ('3268', '386', '浦江县', '3', '0');
INSERT INTO `cities` VALUES ('3269', '386', '磐安县', '3', '0');
INSERT INTO `cities` VALUES ('3270', '387', '莲都区', '3', '0');
INSERT INTO `cities` VALUES ('3271', '387', '龙泉市', '3', '0');
INSERT INTO `cities` VALUES ('3272', '387', '青田县', '3', '0');
INSERT INTO `cities` VALUES ('3273', '387', '缙云县', '3', '0');
INSERT INTO `cities` VALUES ('3274', '387', '遂昌县', '3', '0');
INSERT INTO `cities` VALUES ('3275', '387', '松阳县', '3', '0');
INSERT INTO `cities` VALUES ('3276', '387', '云和县', '3', '0');
INSERT INTO `cities` VALUES ('3277', '387', '庆元县', '3', '0');
INSERT INTO `cities` VALUES ('3278', '387', '景宁', '3', '0');
INSERT INTO `cities` VALUES ('3279', '388', '海曙区', '3', '0');
INSERT INTO `cities` VALUES ('3280', '388', '江东区', '3', '0');
INSERT INTO `cities` VALUES ('3281', '388', '江北区', '3', '0');
INSERT INTO `cities` VALUES ('3282', '388', '镇海区', '3', '0');
INSERT INTO `cities` VALUES ('3283', '388', '北仑区', '3', '0');
INSERT INTO `cities` VALUES ('3284', '388', '鄞州区', '3', '0');
INSERT INTO `cities` VALUES ('3285', '388', '余姚市', '3', '0');
INSERT INTO `cities` VALUES ('3286', '388', '慈溪市', '3', '0');
INSERT INTO `cities` VALUES ('3287', '388', '奉化市', '3', '0');
INSERT INTO `cities` VALUES ('3288', '388', '象山县', '3', '0');
INSERT INTO `cities` VALUES ('3289', '388', '宁海县', '3', '0');
INSERT INTO `cities` VALUES ('3290', '389', '越城区', '3', '0');
INSERT INTO `cities` VALUES ('3291', '389', '上虞市', '3', '0');
INSERT INTO `cities` VALUES ('3292', '389', '嵊州市', '3', '0');
INSERT INTO `cities` VALUES ('3293', '389', '绍兴县', '3', '0');
INSERT INTO `cities` VALUES ('3294', '389', '新昌县', '3', '0');
INSERT INTO `cities` VALUES ('3295', '389', '诸暨市', '3', '0');
INSERT INTO `cities` VALUES ('3296', '390', '椒江区', '3', '0');
INSERT INTO `cities` VALUES ('3297', '390', '黄岩区', '3', '0');
INSERT INTO `cities` VALUES ('3298', '390', '路桥区', '3', '0');
INSERT INTO `cities` VALUES ('3299', '390', '温岭市', '3', '0');
INSERT INTO `cities` VALUES ('3300', '390', '临海市', '3', '0');
INSERT INTO `cities` VALUES ('3301', '390', '玉环县', '3', '0');
INSERT INTO `cities` VALUES ('3302', '390', '三门县', '3', '0');
INSERT INTO `cities` VALUES ('3303', '390', '天台县', '3', '0');
INSERT INTO `cities` VALUES ('3304', '390', '仙居县', '3', '0');
INSERT INTO `cities` VALUES ('3305', '391', '鹿城区', '3', '0');
INSERT INTO `cities` VALUES ('3306', '391', '龙湾区', '3', '0');
INSERT INTO `cities` VALUES ('3307', '391', '瓯海区', '3', '0');
INSERT INTO `cities` VALUES ('3308', '391', '瑞安市', '3', '0');
INSERT INTO `cities` VALUES ('3309', '391', '乐清市', '3', '0');
INSERT INTO `cities` VALUES ('3310', '391', '洞头县', '3', '0');
INSERT INTO `cities` VALUES ('3311', '391', '永嘉县', '3', '0');
INSERT INTO `cities` VALUES ('3312', '391', '平阳县', '3', '0');
INSERT INTO `cities` VALUES ('3313', '391', '苍南县', '3', '0');
INSERT INTO `cities` VALUES ('3314', '391', '文成县', '3', '0');
INSERT INTO `cities` VALUES ('3315', '391', '泰顺县', '3', '0');
INSERT INTO `cities` VALUES ('3316', '392', '定海区', '3', '0');
INSERT INTO `cities` VALUES ('3317', '392', '普陀区', '3', '0');
INSERT INTO `cities` VALUES ('3318', '392', '岱山县', '3', '0');
INSERT INTO `cities` VALUES ('3319', '392', '嵊泗县', '3', '0');
INSERT INTO `cities` VALUES ('3320', '393', '衢州市', '3', '0');
INSERT INTO `cities` VALUES ('3321', '393', '江山市', '3', '0');
INSERT INTO `cities` VALUES ('3322', '393', '常山县', '3', '0');
INSERT INTO `cities` VALUES ('3323', '393', '开化县', '3', '0');
INSERT INTO `cities` VALUES ('3325', '394', '合川区', '3', '0');
INSERT INTO `cities` VALUES ('3326', '394', '江津区', '3', '0');
INSERT INTO `cities` VALUES ('3327', '394', '南川区', '3', '0');
INSERT INTO `cities` VALUES ('3328', '394', '永川区', '3', '0');
INSERT INTO `cities` VALUES ('3329', '394', '南岸区', '3', '0');
INSERT INTO `cities` VALUES ('3330', '394', '渝北区', '3', '0');
INSERT INTO `cities` VALUES ('3331', '394', '万盛区', '3', '0');
INSERT INTO `cities` VALUES ('3332', '394', '大渡口区', '3', '0');
INSERT INTO `cities` VALUES ('3333', '394', '万州区', '3', '0');
INSERT INTO `cities` VALUES ('3334', '394', '北碚区', '3', '0');
INSERT INTO `cities` VALUES ('3335', '394', '沙坪坝区', '3', '0');
INSERT INTO `cities` VALUES ('3336', '394', '巴南区', '3', '0');
INSERT INTO `cities` VALUES ('3337', '394', '涪陵区', '3', '0');
INSERT INTO `cities` VALUES ('3338', '394', '江北区', '3', '0');
INSERT INTO `cities` VALUES ('3339', '394', '九龙坡区', '3', '0');
INSERT INTO `cities` VALUES ('3340', '394', '渝中区', '3', '0');
INSERT INTO `cities` VALUES ('3341', '394', '黔江开发区', '3', '0');
INSERT INTO `cities` VALUES ('3342', '394', '长寿区', '3', '0');
INSERT INTO `cities` VALUES ('3343', '394', '双桥区', '3', '0');
INSERT INTO `cities` VALUES ('3344', '394', '綦江县', '3', '0');
INSERT INTO `cities` VALUES ('3345', '394', '潼南县', '3', '0');
INSERT INTO `cities` VALUES ('3346', '394', '铜梁县', '3', '0');
INSERT INTO `cities` VALUES ('3347', '394', '大足县', '3', '0');
INSERT INTO `cities` VALUES ('3348', '394', '荣昌县', '3', '0');
INSERT INTO `cities` VALUES ('3349', '394', '璧山县', '3', '0');
INSERT INTO `cities` VALUES ('3350', '394', '垫江县', '3', '0');
INSERT INTO `cities` VALUES ('3351', '394', '武隆县', '3', '0');
INSERT INTO `cities` VALUES ('3352', '394', '丰都县', '3', '0');
INSERT INTO `cities` VALUES ('3353', '394', '城口县', '3', '0');
INSERT INTO `cities` VALUES ('3354', '394', '梁平县', '3', '0');
INSERT INTO `cities` VALUES ('3355', '394', '开县', '3', '0');
INSERT INTO `cities` VALUES ('3356', '394', '巫溪县', '3', '0');
INSERT INTO `cities` VALUES ('3357', '394', '巫山县', '3', '0');
INSERT INTO `cities` VALUES ('3358', '394', '奉节县', '3', '0');
INSERT INTO `cities` VALUES ('3359', '394', '云阳县', '3', '0');
INSERT INTO `cities` VALUES ('3360', '394', '忠县', '3', '0');
INSERT INTO `cities` VALUES ('3361', '394', '石柱', '3', '0');
INSERT INTO `cities` VALUES ('3362', '394', '彭水', '3', '0');
INSERT INTO `cities` VALUES ('3363', '394', '酉阳', '3', '0');
INSERT INTO `cities` VALUES ('3364', '394', '秀山', '3', '0');
INSERT INTO `cities` VALUES ('3365', '395', '沙田区', '3', '0');
INSERT INTO `cities` VALUES ('3366', '395', '东区', '3', '0');
INSERT INTO `cities` VALUES ('3367', '395', '观塘区', '3', '0');
INSERT INTO `cities` VALUES ('3368', '395', '黄大仙区', '3', '0');
INSERT INTO `cities` VALUES ('3369', '395', '九龙城区', '3', '0');
INSERT INTO `cities` VALUES ('3370', '395', '屯门区', '3', '0');
INSERT INTO `cities` VALUES ('3371', '395', '葵青区', '3', '0');
INSERT INTO `cities` VALUES ('3372', '395', '元朗区', '3', '0');
INSERT INTO `cities` VALUES ('3373', '395', '深水埗区', '3', '0');
INSERT INTO `cities` VALUES ('3374', '395', '西贡区', '3', '0');
INSERT INTO `cities` VALUES ('3375', '395', '大埔区', '3', '0');
INSERT INTO `cities` VALUES ('3376', '395', '湾仔区', '3', '0');
INSERT INTO `cities` VALUES ('3377', '395', '油尖旺区', '3', '0');
INSERT INTO `cities` VALUES ('3378', '395', '北区', '3', '0');
INSERT INTO `cities` VALUES ('3379', '395', '南区', '3', '0');
INSERT INTO `cities` VALUES ('3380', '395', '荃湾区', '3', '0');
INSERT INTO `cities` VALUES ('3381', '395', '中西区', '3', '0');
INSERT INTO `cities` VALUES ('3382', '395', '离岛区', '3', '0');
INSERT INTO `cities` VALUES ('3383', '396', '澳门', '3', '0');
INSERT INTO `cities` VALUES ('3384', '397', '台北', '3', '0');
INSERT INTO `cities` VALUES ('3385', '397', '高雄', '3', '0');
INSERT INTO `cities` VALUES ('3386', '397', '基隆', '3', '0');
INSERT INTO `cities` VALUES ('3387', '397', '台中', '3', '0');
INSERT INTO `cities` VALUES ('3388', '397', '台南', '3', '0');
INSERT INTO `cities` VALUES ('3389', '397', '新竹', '3', '0');
INSERT INTO `cities` VALUES ('3390', '397', '嘉义', '3', '0');
INSERT INTO `cities` VALUES ('3391', '397', '宜兰县', '3', '0');
INSERT INTO `cities` VALUES ('3392', '397', '桃园县', '3', '0');
INSERT INTO `cities` VALUES ('3393', '397', '苗栗县', '3', '0');
INSERT INTO `cities` VALUES ('3394', '397', '彰化县', '3', '0');
INSERT INTO `cities` VALUES ('3395', '397', '南投县', '3', '0');
INSERT INTO `cities` VALUES ('3396', '397', '云林县', '3', '0');
INSERT INTO `cities` VALUES ('3397', '397', '屏东县', '3', '0');
INSERT INTO `cities` VALUES ('3398', '397', '台东县', '3', '0');
INSERT INTO `cities` VALUES ('3399', '397', '花莲县', '3', '0');
INSERT INTO `cities` VALUES ('3400', '397', '澎湖县', '3', '0');
INSERT INTO `cities` VALUES ('3401', '3', '合肥', '2', '0');
INSERT INTO `cities` VALUES ('3402', '3401', '庐阳区', '3', '0');
INSERT INTO `cities` VALUES ('3403', '3401', '瑶海区', '3', '0');
INSERT INTO `cities` VALUES ('3404', '3401', '蜀山区', '3', '0');
INSERT INTO `cities` VALUES ('3405', '3401', '包河区', '3', '0');
INSERT INTO `cities` VALUES ('3406', '3401', '长丰县', '3', '0');
INSERT INTO `cities` VALUES ('3407', '3401', '肥东县', '3', '0');
INSERT INTO `cities` VALUES ('3408', '3401', '肥西县', '3', '0');
INSERT INTO `cities` VALUES ('3427', '1231', '第什营乡', '2', '0');
INSERT INTO `cities` VALUES ('3428', '3427', '康家洼村', '2', '0');
INSERT INTO `cities` VALUES ('3429', '3427', '西盖村', '2', '0');
INSERT INTO `cities` VALUES ('3430', '3427', '东盖村', '2', '0');
INSERT INTO `cities` VALUES ('3431', '3427', '圣佛堂村', '2', '0');
INSERT INTO `cities` VALUES ('3432', '398', '1', '4', '0');
INSERT INTO `cities` VALUES ('3433', '3432', '22', '5', '0');

-- ----------------------------
-- Table structure for cities_freights
-- ----------------------------
DROP TABLE IF EXISTS `cities_freights`;
CREATE TABLE `cities_freights` (
  `cities_id` int(10) unsigned NOT NULL,
  `freights_id` int(10) unsigned NOT NULL,
  `freight_type` int(11) DEFAULT NULL COMMENT '计算方式0件数1重量3体积',
  `freight_first_count` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '首重/首件/首体积',
  `the_freight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '运费',
  `freight_continue_count` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '续重/续件/续体积',
  `freight_continue_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '续运费',
  KEY `cities_freights_cities_id_index` (`cities_id`),
  KEY `cities_freights_freights_id_index` (`freights_id`),
  CONSTRAINT `cities_freights_cities_id_foreign` FOREIGN KEY (`cities_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cities_freights_freights_id_foreign` FOREIGN KEY (`freights_id`) REFERENCES `freight_tems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cities_freights
-- ----------------------------

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '国家名称',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `sort` int(11) DEFAULT NULL COMMENT '单号',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_id_sort_created_at_index` (`id`,`sort`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', '易呗', 'http://yibei.wiswebs.com/uploads/06.jpg', '1', '2018-08-17 15:27:46', '2018-08-17 15:28:20', '2018-08-17 15:28:20');

-- ----------------------------
-- Table structure for coupon_order
-- ----------------------------
DROP TABLE IF EXISTS `coupon_order`;
CREATE TABLE `coupon_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(10) unsigned NOT NULL,
  `order2_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_order_coupon_id_foreign` (`coupon_id`),
  KEY `coupon_order_order2_id_foreign` (`order2_id`),
  KEY `coupon_order_id_index` (`id`),
  CONSTRAINT `coupon_order_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_users` (`id`),
  CONSTRAINT `coupon_order_order2_id_foreign` FOREIGN KEY (`order2_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of coupon_order
-- ----------------------------

-- ----------------------------
-- Table structure for coupon_product
-- ----------------------------
DROP TABLE IF EXISTS `coupon_product`;
CREATE TABLE `coupon_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `spec_price_id` int(10) unsigned DEFAULT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_product_product_id_foreign` (`product_id`),
  KEY `coupon_product_spec_price_id_foreign` (`spec_price_id`),
  KEY `coupon_product_coupon_id_foreign` (`coupon_id`),
  KEY `coupon_product_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `coupon_product_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `coupon_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `coupon_product_spec_price_id_foreign` FOREIGN KEY (`spec_price_id`) REFERENCES `spec_product_prices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of coupon_product
-- ----------------------------

-- ----------------------------
-- Table structure for coupon_rule
-- ----------------------------
DROP TABLE IF EXISTS `coupon_rule`;
CREATE TABLE `coupon_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(10) unsigned NOT NULL,
  `rule_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_rule_coupon_id_foreign` (`coupon_id`),
  KEY `coupon_rule_rule_id_foreign` (`rule_id`),
  KEY `coupon_rule_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `coupon_rule_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `coupon_rule_rule_id_foreign` FOREIGN KEY (`rule_id`) REFERENCES `rules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of coupon_rule
-- ----------------------------

-- ----------------------------
-- Table structure for coupon_users
-- ----------------------------
DROP TABLE IF EXISTS `coupon_users`;
CREATE TABLE `coupon_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_type` tinyint(4) DEFAULT NULL COMMENT '优惠券类型',
  `order_id` int(11) DEFAULT NULL COMMENT '使用的订单好',
  `from_way` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '优惠券来源',
  `use_time` timestamp NULL DEFAULT NULL COMMENT '使用时间',
  `time_begin` timestamp NULL DEFAULT NULL COMMENT '有效期起始时间',
  `time_end` timestamp NULL DEFAULT NULL COMMENT '有效期终止时间',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '兑换码，暂不用',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '优惠券状态 0未使用 1冻结 2已使用 3过期 4作废',
  `user_id` int(10) unsigned NOT NULL,
  `coupon_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_users_id_created_at_index` (`id`,`created_at`),
  KEY `coupon_users_order_id_index` (`order_id`),
  KEY `coupon_users_user_id_index` (`user_id`),
  KEY `coupon_users_coupon_id_index` (`coupon_id`),
  CONSTRAINT `coupon_users_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  CONSTRAINT `coupon_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of coupon_users
-- ----------------------------

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `max_count` int(11) NOT NULL DEFAULT '0' COMMENT '每人最多领取数量',
  `time_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 固定有效日期',
  `expire_days` int(11) NOT NULL DEFAULT '30' COMMENT '领券后有效期',
  `time_begin` date NOT NULL DEFAULT '2000-01-01' COMMENT '有效期开始时间',
  `time_end` date NOT NULL DEFAULT '2000-01-01' COMMENT '有效期结束时间',
  `type` enum('满减','打折') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '满减' COMMENT '优惠券类型',
  `base` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '满足最小金额',
  `given` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `discount` double(8,2) NOT NULL DEFAULT '100.00' COMMENT '折扣，九折就输入90，不打折就输入100',
  `together` enum('是','否') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '否' COMMENT '叠加使用',
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '总部' COMMENT '买单部门',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '说明',
  `range` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0全场通用 1指定分类 2指定商品',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '适用分类',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupons_id_created_at_index` (`id`,`created_at`),
  KEY `coupons_time_begin_index` (`time_begin`),
  KEY `coupons_time_end_index` (`time_end`),
  KEY `coupons_category_id_index` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of coupons
-- ----------------------------

-- ----------------------------
-- Table structure for credit_logs
-- ----------------------------
DROP TABLE IF EXISTS `credit_logs`;
CREATE TABLE `credit_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL COMMENT '积分余额',
  `change` int(11) NOT NULL COMMENT '积分变动，正为增加，负为支出',
  `detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '详情',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0注册赠送，1推荐好友赠送， 2购物赠送, 3消耗',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credit_logs_id_created_at_index` (`id`,`created_at`),
  KEY `credit_logs_user_id_index` (`user_id`),
  CONSTRAINT `credit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of credit_logs
-- ----------------------------
INSERT INTO `credit_logs` VALUES ('1', '10000', '10000', '管理员操作变动货呗:10000', '4', '1', '2018-08-21 14:34:52', '2018-08-21 14:34:52', null);
INSERT INTO `credit_logs` VALUES ('2', '9970', '-30', '用户使用积分消费，订单编号:1', '3', '1', '2018-08-21 14:35:08', '2018-08-21 14:35:08', null);
INSERT INTO `credit_logs` VALUES ('3', '9852', '-118', '用户使用积分消费，订单编号:2', '3', '1', '2018-08-22 18:18:07', '2018-08-22 18:18:07', null);
INSERT INTO `credit_logs` VALUES ('4', '10000', '10000', '货呗卡充值,充值货呗卡号为50134127', '5', '4', '2018-08-27 15:31:53', '2018-08-27 15:31:53', null);
INSERT INTO `credit_logs` VALUES ('5', '20000', '10000', '货呗卡充值,充值货呗卡号为50136577', '5', '4', '2018-08-27 15:45:47', '2018-08-27 15:45:47', null);
INSERT INTO `credit_logs` VALUES ('6', '30000', '10000', '货呗卡充值,充值货呗卡号为50139455', '5', '4', '2018-08-27 15:47:04', '2018-08-27 15:47:04', null);
INSERT INTO `credit_logs` VALUES ('7', '100', '100', '货呗卡充值,充值货呗卡号为50138283', '5', '2', '2018-08-27 16:32:02', '2018-08-27 16:32:02', null);
INSERT INTO `credit_logs` VALUES ('8', '40000', '10000', '货呗卡充值,充值货呗卡号为50132596', '5', '4', '2018-08-27 16:34:40', '2018-08-27 16:34:40', null);
INSERT INTO `credit_logs` VALUES ('9', '200', '100', '货呗卡充值,充值货呗卡号为50138260', '5', '2', '2018-08-27 16:42:39', '2018-08-27 16:42:39', null);
INSERT INTO `credit_logs` VALUES ('10', '300', '100', '货呗卡充值,充值货呗卡号为50137491', '5', '2', '2018-08-27 16:44:47', '2018-08-27 16:44:47', null);
INSERT INTO `credit_logs` VALUES ('11', '50000', '10000', '货呗卡充值,充值货呗卡号为50137717', '5', '4', '2018-08-27 16:44:52', '2018-08-27 16:44:52', null);
INSERT INTO `credit_logs` VALUES ('12', '400', '100', '货呗卡充值,充值货呗卡号为50132007', '5', '2', '2018-08-27 16:46:09', '2018-08-27 16:46:09', null);

-- ----------------------------
-- Table structure for custom_page_types
-- ----------------------------
DROP TABLE IF EXISTS `custom_page_types`;
CREATE TABLE `custom_page_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自定义类型名称',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自定义类型别名',
  `des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自定义类型描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_page_types_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of custom_page_types
-- ----------------------------

-- ----------------------------
-- Table structure for custom_post_type_items
-- ----------------------------
DROP TABLE IF EXISTS `custom_post_type_items`;
CREATE TABLE `custom_post_type_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段名',
  `des` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段中文',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段类型',
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段预设值',
  `custom_post_type_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_post_type_items_id_created_at_index` (`id`,`created_at`),
  KEY `custom_post_type_items_custom_post_type_id_index` (`custom_post_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of custom_post_type_items
-- ----------------------------

-- ----------------------------
-- Table structure for custom_post_types
-- ----------------------------
DROP TABLE IF EXISTS `custom_post_types`;
CREATE TABLE `custom_post_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自定义类型名称',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自定义类型别名',
  `des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自定义类型描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_post_types_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of custom_post_types
-- ----------------------------

-- ----------------------------
-- Table structure for customer_services
-- ----------------------------
DROP TABLE IF EXISTS `customer_services`;
CREATE TABLE `customer_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '平台： QQ 微信 电话 WEB客服',
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '职位：售前，售后，技术',
  `head_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `qr_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '二维码',
  `commit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系方式',
  `show` int(11) DEFAULT '1' COMMENT '是否显示 1显示 0不显示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_services_id_created_at_index` (`id`,`created_at`),
  KEY `customer_services_show_index` (`show`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of customer_services
-- ----------------------------
INSERT INTO `customer_services` VALUES ('1', '小王', '0', '0', 'http://yibei.wiswebs.com/uploads/222.jpg', 'http://yibei.wiswebs.com/uploads/111.jpg', '123456', '1', '2018-08-23 15:12:19', '2018-08-23 15:12:19', null);

-- ----------------------------
-- Table structure for distribution_logs
-- ----------------------------
DROP TABLE IF EXISTS `distribution_logs`;
CREATE TABLE `distribution_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_user_id` int(11) NOT NULL COMMENT '订单用户',
  `user_id` int(11) NOT NULL COMMENT '分佣用户',
  `commission` decimal(10,2) NOT NULL COMMENT '佣金',
  `order_money` decimal(10,2) NOT NULL COMMENT '订单金额',
  `user_dis_level` int(11) NOT NULL COMMENT '分佣用户层级',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '佣金发放状态 待发放 已发放 订单作废',
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distribution_logs_id_created_at_index` (`id`,`created_at`),
  KEY `distribution_logs_user_id_index` (`user_id`),
  KEY `distribution_logs_order_id_index` (`order_id`),
  CONSTRAINT `distribution_logs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of distribution_logs
-- ----------------------------

-- ----------------------------
-- Table structure for flash_sales
-- ----------------------------
DROP TABLE IF EXISTS `flash_sales`;
CREATE TABLE `flash_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` double(8,2) NOT NULL COMMENT '销售价格',
  `origin_price` double(8,2) DEFAULT NULL COMMENT '商品原价',
  `product_num` int(11) NOT NULL COMMENT '参加活动商品数',
  `buy_limit` int(11) NOT NULL COMMENT '每人限购数量',
  `buy_num` int(11) DEFAULT '0' COMMENT '已出售数量',
  `order_num` int(11) DEFAULT '0' COMMENT '订单数量',
  `intro` longtext COLLATE utf8mb4_unicode_ci COMMENT '活动介绍',
  `time_begin` timestamp NULL DEFAULT NULL COMMENT '活动开始时间',
  `time_end` timestamp NULL DEFAULT NULL COMMENT '活动结束时间',
  `is_end` tinyint(4) DEFAULT '0' COMMENT '活动是否结束',
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品名称',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品图片',
  `product_id` int(10) unsigned NOT NULL,
  `spec_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flash_sales_id_created_at_index` (`id`,`created_at`),
  KEY `flash_sales_product_id_index` (`product_id`),
  KEY `flash_sales_spec_id_index` (`spec_id`),
  CONSTRAINT `flash_sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of flash_sales
-- ----------------------------

-- ----------------------------
-- Table structure for freight_tems
-- ----------------------------
DROP TABLE IF EXISTS `freight_tems`;
CREATE TABLE `freight_tems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '运费模板名称',
  `count_type` int(11) DEFAULT NULL COMMENT '计算方式0件数1重量3体积',
  `use_default` int(11) DEFAULT NULL COMMENT '是否使用系统默认0不使用1使用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `freight_tems_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of freight_tems
-- ----------------------------

-- ----------------------------
-- Table structure for group_sales
-- ----------------------------
DROP TABLE IF EXISTS `group_sales`;
CREATE TABLE `group_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动标题',
  `time_begin` timestamp NULL DEFAULT NULL COMMENT '开始时间',
  `time_end` timestamp NULL DEFAULT NULL COMMENT '结束时间',
  `price` decimal(10,2) NOT NULL COMMENT '团购价格',
  `product_max` int(11) NOT NULL COMMENT '最大出售数量，0表示不限量',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '已出售数量',
  `order_num` int(11) NOT NULL DEFAULT '0' COMMENT '订单数量',
  `buy_base` int(11) NOT NULL DEFAULT '5142' COMMENT '虚拟出售基数',
  `intro` longtext COLLATE utf8mb4_unicode_ci COMMENT '活动介绍',
  `origin_price` decimal(10,2) DEFAULT NULL COMMENT '商品原价',
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `recommend` tinyint(4) DEFAULT '0' COMMENT '推荐 0不推荐 1推荐',
  `view` int(11) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `is_end` tinyint(4) DEFAULT '0' COMMENT '是否结束',
  `spec_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_sales_id_created_at_index` (`id`,`created_at`),
  KEY `group_sales_spec_id_index` (`spec_id`),
  KEY `group_sales_product_id_index` (`product_id`),
  CONSTRAINT `group_sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `group_sales_spec_id_foreign` FOREIGN KEY (`spec_id`) REFERENCES `spec_product_prices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of group_sales
-- ----------------------------

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品图片',
  `price` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `cost` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '成本价格',
  `count` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '商品数量',
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '规格单元',
  `order_id` int(11) NOT NULL COMMENT '订单编号',
  `product_id` int(11) NOT NULL COMMENT '产品编号',
  `spec_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名称',
  `spec_keyname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jifen` int(11) DEFAULT '0' COMMENT '购物所需积分',
  PRIMARY KEY (`id`),
  KEY `items_id_created_at_index` (`id`,`created_at`),
  KEY `items_order_id_index` (`order_id`),
  KEY `items_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('1', 'sana豆乳 日本畅销化妆水肤质通用', 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400_2.png', '155.00', '0.00', '1.00', '', '1', '5', null, null, '2018-08-21 14:35:08', '2018-08-21 14:35:08', null, '30');
INSERT INTO `items` VALUES ('2', 'sana日本药妆第一品牌洗颜乳', 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400_3.png', '25.00', '0.00', '1.00', '', '2', '6', null, null, '2018-08-22 18:18:07', '2018-08-22 18:18:07', null, '88');
INSERT INTO `items` VALUES ('3', 'sana豆乳 日本畅销化妆水肤质通用', 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400_2.png', '155.00', '0.00', '1.00', '', '2', '5', null, null, '2018-08-22 18:18:07', '2018-08-22 18:18:07', null, '30');

-- ----------------------------
-- Table structure for ke_fu_feed_backs
-- ----------------------------
DROP TABLE IF EXISTS `ke_fu_feed_backs`;
CREATE TABLE `ke_fu_feed_backs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('反映问题','提出建议','其他') COLLATE utf8mb4_unicode_ci DEFAULT '反映问题' COMMENT '反馈类型',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '意见反馈描述',
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系电话',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ke_fu_feed_backs_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ke_fu_feed_backs
-- ----------------------------

-- ----------------------------
-- Table structure for laravel_sms
-- ----------------------------
DROP TABLE IF EXISTS `laravel_sms`;
CREATE TABLE `laravel_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `temp_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `voice_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fail_times` mediumint(9) NOT NULL DEFAULT '0',
  `last_fail_time` int(10) unsigned NOT NULL DEFAULT '0',
  `sent_time` int(10) unsigned NOT NULL DEFAULT '0',
  `result_info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laravel_sms_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of laravel_sms
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2013_01_06_023308_create_user_levels_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('3', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('4', '2015_06_04_164421_create_wechat_menus_table', '1');
INSERT INTO `migrations` VALUES ('5', '2015_06_07_164706_create_wechat_replies_table', '1');
INSERT INTO `migrations` VALUES ('6', '2015_06_08_164805_create_wechat_materials_table', '1');
INSERT INTO `migrations` VALUES ('7', '2015_06_22_062053_create_wechat_events_table', '1');
INSERT INTO `migrations` VALUES ('8', '2015_12_21_111514_create_sms_table', '1');
INSERT INTO `migrations` VALUES ('9', '2017_04_28_020931_create_addresses_table', '1');
INSERT INTO `migrations` VALUES ('10', '2017_04_28_021242_create_categories_table', '1');
INSERT INTO `migrations` VALUES ('11', '2017_04_28_021847_create_brands_table', '1');
INSERT INTO `migrations` VALUES ('12', '2017_04_28_023207_create_coupons_table', '1');
INSERT INTO `migrations` VALUES ('13', '2017_04_28_023209_create_orders_table', '1');
INSERT INTO `migrations` VALUES ('14', '2017_06_20_045807_create_items_table', '1');
INSERT INTO `migrations` VALUES ('15', '2017_06_22_035655_create_coupon_rules_table', '1');
INSERT INTO `migrations` VALUES ('16', '2017_07_25_200600_create_product_types_table', '1');
INSERT INTO `migrations` VALUES ('17', '2017_07_25_200700_create_products_table', '1');
INSERT INTO `migrations` VALUES ('18', '2017_07_25_200704_create_product_images_table', '1');
INSERT INTO `migrations` VALUES ('19', '2017_08_02_095047_create_product_users_table', '1');
INSERT INTO `migrations` VALUES ('20', '2017_08_02_142702_create_themes_table', '1');
INSERT INTO `migrations` VALUES ('21', '2017_08_04_113005_create_settings_table', '1');
INSERT INTO `migrations` VALUES ('22', '2017_10_17_163918_create_articlecats_table', '1');
INSERT INTO `migrations` VALUES ('23', '2017_10_17_181019_create_posts_table', '1');
INSERT INTO `migrations` VALUES ('24', '2017_10_17_200801_create_pages_table', '1');
INSERT INTO `migrations` VALUES ('25', '2017_10_17_204518_create_banners_table', '1');
INSERT INTO `migrations` VALUES ('26', '2017_10_25_095654_create_bank_cards_table', '1');
INSERT INTO `migrations` VALUES ('27', '2017_12_04_121716_create_banner_items_table', '1');
INSERT INTO `migrations` VALUES ('28', '2017_12_18_115603_create_custom_post_types_table', '1');
INSERT INTO `migrations` VALUES ('29', '2017_12_18_143620_create_custom_post_type_items_table', '1');
INSERT INTO `migrations` VALUES ('30', '2017_12_19_095254_create_post_items_table', '1');
INSERT INTO `migrations` VALUES ('31', '2017_12_20_163428_create_custom_page_types_table', '1');
INSERT INTO `migrations` VALUES ('32', '2017_12_20_170817_create_page_items_table', '1');
INSERT INTO `migrations` VALUES ('33', '2018_01_04_031451_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('34', '2018_01_07_044710_create_specs_table', '1');
INSERT INTO `migrations` VALUES ('35', '2018_01_07_045334_create_spec_items_table', '1');
INSERT INTO `migrations` VALUES ('36', '2018_01_07_050610_create_product_attrs_table', '1');
INSERT INTO `migrations` VALUES ('37', '2018_01_09_110519_create_spec_product_prices_table', '1');
INSERT INTO `migrations` VALUES ('38', '2018_01_10_082148_create_product_attr_values_table', '1');
INSERT INTO `migrations` VALUES ('39', '2018_01_16_053634_create_order_actions_table', '1');
INSERT INTO `migrations` VALUES ('40', '2018_01_17_014828_create_distribution_logs_table', '1');
INSERT INTO `migrations` VALUES ('41', '2018_01_18_080824_create_coupon_product_table', '1');
INSERT INTO `migrations` VALUES ('42', '2018_01_18_100650_create_coupon_users_table', '1');
INSERT INTO `migrations` VALUES ('43', '2018_01_19_030502_create_product_promps_table', '1');
INSERT INTO `migrations` VALUES ('44', '2018_01_19_155802_create_order_promps_table', '1');
INSERT INTO `migrations` VALUES ('45', '2018_01_21_164610_create_flash_sales_table', '1');
INSERT INTO `migrations` VALUES ('46', '2018_01_21_185336_create_team_sales_table', '1');
INSERT INTO `migrations` VALUES ('47', '2018_01_21_203421_create_team_founds_table', '1');
INSERT INTO `migrations` VALUES ('48', '2018_01_21_225210_create_team_follows_table', '1');
INSERT INTO `migrations` VALUES ('49', '2018_01_21_225803_create_team_lotteries_table', '1');
INSERT INTO `migrations` VALUES ('50', '2018_01_22_090007_create_group_sales_table', '1');
INSERT INTO `migrations` VALUES ('51', '2018_02_02_164452_create_bank_sets_table', '1');
INSERT INTO `migrations` VALUES ('52', '2018_02_06_175333_create_credit_logs_table', '1');
INSERT INTO `migrations` VALUES ('53', '2018_02_06_175718_create_money_logs_table', '1');
INSERT INTO `migrations` VALUES ('54', '2018_02_07_140622_create_order_cancels_table', '1');
INSERT INTO `migrations` VALUES ('55', '2018_02_07_161742_create_order_cancel_images_table', '1');
INSERT INTO `migrations` VALUES ('56', '2018_02_07_162503_create_order_refunds_table', '1');
INSERT INTO `migrations` VALUES ('57', '2018_02_08_172525_create_refund_logs_table', '1');
INSERT INTO `migrations` VALUES ('58', '2018_02_09_144152_create_cities_table', '1');
INSERT INTO `migrations` VALUES ('59', '2018_02_09_171048_create_freight_tems_table', '1');
INSERT INTO `migrations` VALUES ('60', '2018_02_12_105500_create_refund_moneys_table', '1');
INSERT INTO `migrations` VALUES ('61', '2018_02_23_084924_entrust_setup_tables', '1');
INSERT INTO `migrations` VALUES ('62', '2018_02_23_155530_create_order_refunds_img_table', '1');
INSERT INTO `migrations` VALUES ('63', '2018_02_24_143301_create_product_word_table', '1');
INSERT INTO `migrations` VALUES ('64', '2018_02_27_151040_create_singel_pages_table', '1');
INSERT INTO `migrations` VALUES ('65', '2018_02_27_172143_create_customer_services_table', '1');
INSERT INTO `migrations` VALUES ('66', '2018_02_28_150044_create_with_drawls_table', '1');
INSERT INTO `migrations` VALUES ('67', '2018_04_02_151712_create_countries_table', '1');
INSERT INTO `migrations` VALUES ('68', '2018_04_08_080824_create_post_product_table', '1');
INSERT INTO `migrations` VALUES ('69', '2018_04_12_104042_create_notices_table', '1');
INSERT INTO `migrations` VALUES ('70', '2018_04_18_155224_create_posts_images_table', '1');
INSERT INTO `migrations` VALUES ('71', '2018_04_23_021242_update_categories_table', '1');
INSERT INTO `migrations` VALUES ('72', '2018_05_23_200700_update_products_table', '1');
INSERT INTO `migrations` VALUES ('73', '2018_05_23_200704_update_product_images_table', '1');
INSERT INTO `migrations` VALUES ('75', '2018_08_11_140446_create_stores_table', '1');
INSERT INTO `migrations` VALUES ('76', '2018_08_11_140447_create_stores_products_table', '1');
INSERT INTO `migrations` VALUES ('77', '2018_08_13_101433_create_projects_table', '1');
INSERT INTO `migrations` VALUES ('78', '2018_08_13_105142_create_project_images_table', '1');
INSERT INTO `migrations` VALUES ('79', '2018_08_14_100336_create_notifications_table', '1');
INSERT INTO `migrations` VALUES ('80', '2018_08_14_162611_update_products_table2', '1');
INSERT INTO `migrations` VALUES ('81', '2018_08_14_162613_update_spec_product_prices_table', '1');
INSERT INTO `migrations` VALUES ('82', '2018_08_15_092544_create_cats_table', '1');
INSERT INTO `migrations` VALUES ('83', '2018_08_15_154325_create_cards_table', '1');
INSERT INTO `migrations` VALUES ('84', '2018_08_15_161641_modify_orders_table', '1');
INSERT INTO `migrations` VALUES ('85', '2018_08_15_161907_modify_items_table', '1');
INSERT INTO `migrations` VALUES ('86', '2018_08_15_182731_create_certs_table', '1');
INSERT INTO `migrations` VALUES ('87', '2018_08_17_091553_create_product_evals_table', '1');
INSERT INTO `migrations` VALUES ('88', '2018_08_17_092709_create_attach_evals_table', '1');
INSERT INTO `migrations` VALUES ('89', '2018_06_19_121716_update_banner_items_table', '2');
INSERT INTO `migrations` VALUES ('90', '2018_08_20_092544_update_cats_table', '3');
INSERT INTO `migrations` VALUES ('91', '2018_08_20_154325_update_cards_table', '4');
INSERT INTO `migrations` VALUES ('92', '2018_08_22_172253_create_ke_fu_feed_backs_table', '5');
INSERT INTO `migrations` VALUES ('93', '2018_09_04_161102_create_admin_shops_table', '6');

-- ----------------------------
-- Table structure for money_logs
-- ----------------------------
DROP TABLE IF EXISTS `money_logs`;
CREATE TABLE `money_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(8,2) NOT NULL COMMENT '余额',
  `change` double(8,2) NOT NULL COMMENT '余额变动记录',
  `detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '详情',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0系统赠送，1分佣 2消费',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `money_logs_id_created_at_index` (`id`,`created_at`),
  KEY `money_logs_user_id_index` (`user_id`),
  CONSTRAINT `money_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of money_logs
-- ----------------------------
INSERT INTO `money_logs` VALUES ('1', '1000.00', '1000.00', '管理员操作变动余额:1000', '4', '1', '2018-08-21 14:34:58', '2018-08-21 14:34:58', null);
INSERT INTO `money_logs` VALUES ('2', '0.20', '0.10', '充值0.1元到账户余额', '4', '2', '2018-08-27 16:11:56', '2018-08-27 16:11:56', null);
INSERT INTO `money_logs` VALUES ('3', '1.00', '1.00', '充值1元到账户余额', '4', '4', '2018-08-27 16:46:58', '2018-08-27 16:46:58', null);

-- ----------------------------
-- Table structure for notices
-- ----------------------------
DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notices_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notices
-- ----------------------------
INSERT INTO `notices` VALUES ('1', '暄妍科技与爱迪尔签订战略合作', '<p>暄妍科技与爱迪尔珠宝签订战略合作</p>\r\n<p><img src=\"http://yibei.wiswebs.com/uploads/59ba1be9c3bba.jpg?1536215871572\" alt=\"59ba1be9c3bba\" /></p>', '2018-08-17 17:23:20', '2018-09-06 14:37:54', null);
INSERT INTO `notices` VALUES ('2', '暄妍科技与奔驰签订战略合作', '<p>暄妍科技与奔驰签订战略合作</p>', '2018-09-06 14:17:14', '2018-09-06 14:17:14', null);
INSERT INTO `notices` VALUES ('3', '暄妍科技与宝马签订战略合作', '<p>暄妍科技与宝马签订战略合作</p>', '2018-09-06 14:18:06', '2018-09-06 14:18:06', null);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`),
  KEY `notifications_id_created_at_index` (`id`,`created_at`),
  KEY `notifications_read_at_index` (`read_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('f4c04b94-7027-4ea6-ad32-3e9a981a346d', 'App\\Notifications\\NoticeNotification', '1', 'App\\User', '{\"content\":\"\\u6d4b\\u8bd5\\u4fe1\\u606f\",\"type\":\"\\u5546\\u6237\\u6d88\\u606f\"}', '2018-08-17 14:30:08', '2018-08-17 14:08:41', '2018-08-17 14:30:08');

-- ----------------------------
-- Table structure for order_actions
-- ----------------------------
DROP TABLE IF EXISTS `order_actions`;
CREATE TABLE `order_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单状态',
  `shipping_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '物流状态',
  `pay_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付状态',
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作',
  `status_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述',
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作用户',
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_actions_id_created_at_index` (`id`,`created_at`),
  KEY `order_actions_order_id_index` (`order_id`),
  CONSTRAINT `order_actions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_actions
-- ----------------------------
INSERT INTO `order_actions` VALUES ('1', '未确认', '未发货', '已支付', '支付状态修改', '无', '超级管理员', '1', '2018-08-21 14:35:32', '2018-08-21 14:35:32', null);
INSERT INTO `order_actions` VALUES ('2', '已确认', '未发货', '已支付', '订单状态修改', '无', '超级管理员', '1', '2018-08-21 14:35:47', '2018-08-21 14:35:47', null);
INSERT INTO `order_actions` VALUES ('3', '已确认', '已发货', '已支付', '物流状态修改', '无', '超级管理员', '1', '2018-08-21 14:35:49', '2018-08-21 14:35:49', null);
INSERT INTO `order_actions` VALUES ('4', '已确认', '已收货', '已支付', '确认订单', '无', '易呗测试用户', '1', '2018-08-21 14:36:10', '2018-08-21 14:36:10', null);
INSERT INTO `order_actions` VALUES ('5', '未确认', '未发货', '已支付', '支付状态修改', '无', '超级管理员', '2', '2018-08-22 18:18:36', '2018-08-22 18:18:36', null);
INSERT INTO `order_actions` VALUES ('6', '已确认', '未发货', '已支付', '订单状态修改', '无', '超级管理员', '2', '2018-08-22 18:18:39', '2018-08-22 18:18:39', null);
INSERT INTO `order_actions` VALUES ('7', '已确认', '已发货', '已支付', '物流状态修改', '无', '超级管理员', '2', '2018-08-22 18:18:55', '2018-08-22 18:18:55', null);
INSERT INTO `order_actions` VALUES ('8', '已确认', '已收货', '已支付', '确认订单', '无', '易呗测试用户', '2', '2018-08-22 18:19:02', '2018-08-22 18:19:02', null);

-- ----------------------------
-- Table structure for order_cancel_images
-- ----------------------------
DROP TABLE IF EXISTS `order_cancel_images`;
CREATE TABLE `order_cancel_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片路径',
  `order_cancel_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_cancel_images_id_created_at_index` (`id`,`created_at`),
  KEY `order_cancel_images_order_cancel_id_index` (`order_cancel_id`),
  CONSTRAINT `order_cancel_images_order_cancel_id_foreign` FOREIGN KEY (`order_cancel_id`) REFERENCES `order_cancels` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_cancel_images
-- ----------------------------

-- ----------------------------
-- Table structure for order_cancels
-- ----------------------------
DROP TABLE IF EXISTS `order_cancels`;
CREATE TABLE `order_cancels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '取消订单原因',
  `money` double(8,2) NOT NULL COMMENT '退还金额',
  `user_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '退还金额',
  `credits` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '退还金额',
  `auth` int(11) NOT NULL DEFAULT '0' COMMENT '审核状态，0待处理 1通过 2不通过',
  `refound` int(11) NOT NULL DEFAULT '0' COMMENT '金额退回路径 0原路返回 1返回到余额',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注信息',
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_cancels_id_created_at_index` (`id`,`created_at`),
  KEY `order_cancels_order_id_index` (`order_id`),
  CONSTRAINT `order_cancels_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_cancels
-- ----------------------------

-- ----------------------------
-- Table structure for order_promps
-- ----------------------------
DROP TABLE IF EXISTS `order_promps`;
CREATE TABLE `order_promps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `type` int(11) NOT NULL COMMENT '0 打折优惠 1减价优惠',
  `base` decimal(10,2) NOT NULL COMMENT '需满足的价格',
  `value` decimal(10,2) NOT NULL COMMENT '优惠数值 打折就是折扣， 减价就是减价金额 固定金额就是出售价格',
  `time_begin` timestamp NULL DEFAULT NULL COMMENT '活动开始时间',
  `time_end` timestamp NULL DEFAULT NULL COMMENT '活动结束时间',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活动宣传图片',
  `intro` longtext COLLATE utf8mb4_unicode_ci COMMENT '活动介绍',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_promps_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_promps
-- ----------------------------

-- ----------------------------
-- Table structure for order_refunds
-- ----------------------------
DROP TABLE IF EXISTS `order_refunds`;
CREATE TABLE `order_refunds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '类型 0退款 1退货退款 2换货',
  `count` int(11) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '退换理由',
  `describe` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '问题描述',
  `remark` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理员备注',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '退换状态 -2用户取消-1审核不通过0待审核1通过2已发货3已完成',
  `seller_delivery_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '卖家重新发货物流公司',
  `seller_delivery_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '卖家重新发货物流单号',
  `refund_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '退还支付金额',
  `refund_deposit` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '退还账户余额',
  `refund_credit` int(11) NOT NULL DEFAULT '0' COMMENT '退还积分',
  `refund_type` int(11) NOT NULL DEFAULT '0' COMMENT '0原路返回 1退款到余额',
  `refund_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '退款时间',
  `is_receive` int(11) NOT NULL DEFAULT '0' COMMENT '0未收到 1收到 申请售后时是否收到货物',
  `return_status` int(11) NOT NULL DEFAULT '0' COMMENT '0买家未发货 1买家已发货 2卖家已收货',
  `return_delivery_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '买家发货物流公司',
  `return_delivery_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '买家发货物流单号',
  `return_delivery_money` double(8,2) DEFAULT '0.00' COMMENT '快递费用',
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_refunds_id_created_at_index` (`id`,`created_at`),
  KEY `order_refunds_order_id_index` (`order_id`),
  KEY `order_refunds_user_id_index` (`user_id`),
  KEY `order_refunds_item_id_index` (`item_id`),
  CONSTRAINT `order_refunds_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `order_refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_refunds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_refunds
-- ----------------------------

-- ----------------------------
-- Table structure for order_refunds_img
-- ----------------------------
DROP TABLE IF EXISTS `order_refunds_img`;
CREATE TABLE `order_refunds_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_refunds_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_refunds_img_id_created_at_index` (`id`,`created_at`),
  KEY `order_refunds_img_order_refunds_id_index` (`order_refunds_id`),
  CONSTRAINT `order_refunds_img_order_refunds_id_foreign` FOREIGN KEY (`order_refunds_id`) REFERENCES `order_refunds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order_refunds_img
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `snumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商户订单号',
  `price` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `cost` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '成本',
  `origin_price` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `preferential` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '订单促销优惠金额',
  `coupon_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券优惠金额',
  `credits` int(11) NOT NULL DEFAULT '0' COMMENT '使用积分',
  `credits_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '使用积分抵扣金额',
  `user_level_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '会员等级折扣',
  `user_money_pay` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '用户余额支付',
  `price_adjust` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '调整价格',
  `freight` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `sendtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发货时间',
  `confirm_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '确认时间',
  `paytime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '支付时间',
  `pay_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '在线支付' COMMENT '支付方式',
  `pay_platform` enum('微信支付','支付宝','微信(PAYSAPI)','管理员操作') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '微信支付' COMMENT '支付平台',
  `order_pay` enum('未支付','已支付') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '未支付',
  `pay_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '平台订单号',
  `out_trade_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '商户订单号',
  `order_status` enum('未确认','已确认','无效','已取消') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '未确认',
  `order_delivery` enum('未发货','已发货','已收货','退换货') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '未发货',
  `invoice` enum('要','不要') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '不要' COMMENT '要不要发票',
  `invoice_type` enum('','个人','公司') COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '发票对象',
  `invoice_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '发票抬头',
  `tax_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '税号',
  `delivery_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '快递公司',
  `delivery_return` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '回寄快递单号',
  `delivery_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '快递单号',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户留言',
  `prom_id` int(11) DEFAULT NULL COMMENT '促销ID',
  `prom_type` int(11) DEFAULT NULL COMMENT '促销类型',
  `user_id` int(10) unsigned NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人电话',
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人地址',
  `delivery_province` int(10) unsigned DEFAULT '0',
  `delivery_city` int(10) unsigned DEFAULT '0',
  `delivery_district` int(10) unsigned DEFAULT '0',
  `delivery_street` int(10) unsigned DEFAULT '0',
  `backup01` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员备注信息',
  `backup02` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备用',
  `backup03` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备用',
  `backup04` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备用',
  `backup05` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jifen` int(11) DEFAULT '0' COMMENT '购物所需积分',
  PRIMARY KEY (`id`),
  KEY `orders_id_created_at_index` (`id`,`created_at`),
  KEY `orders_prom_id_index` (`prom_id`),
  KEY `orders_user_id_index` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '6000001', '155.00', '0.00', '155.00', '0.00', '0.00', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '2018-08-21 14:35:49', '2018-08-21 14:36:10', '2018-08-21 14:35:08', '在线支付', '管理员操作', '已支付', '', '', '已确认', '已收货', '不要', '', '', '', '', '', '', null, '0', '0', '1', '许', '13397119221', '湖北省武汉硚口区1', '0', '0', '0', '0', '', '', '', '', '', '2018-08-21 14:35:08', '2018-08-21 14:36:10', null, '30');
INSERT INTO `orders` VALUES ('2', '6000002', '180.00', '0.00', '180.00', '0.00', '0.00', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '2018-08-22 18:18:55', '2018-08-22 18:19:01', '2018-08-22 18:18:07', '在线支付', '管理员操作', '已支付', '', '', '已确认', '已收货', '不要', '', '', '', '', '', '', null, '0', '0', '1', '王思聪', '18888888888', '北京市北京朝阳区100', '0', '0', '0', '0', '', '', '', '', '', '2018-08-22 18:18:07', '2018-08-22 18:19:01', null, '118');

-- ----------------------------
-- Table structure for page_items
-- ----------------------------
DROP TABLE IF EXISTS `page_items`;
CREATE TABLE `page_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段名',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段中文名',
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段值',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `page_id` int(10) unsigned DEFAULT NULL,
  `custom_page_types_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_items_id_created_at_index` (`id`,`created_at`),
  KEY `page_items_page_id_index` (`page_id`),
  KEY `page_items_custom_page_types_id_index` (`custom_page_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of page_items
-- ----------------------------

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '别名',
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '正文',
  `view` int(11) NOT NULL DEFAULT '1' COMMENT '浏览量',
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'seo标题',
  `seo_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO关键词',
  `seo_des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO描述',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '文章状态 0 草稿 1 发布',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '封面图片',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '1');
INSERT INTO `permission_role` VALUES ('2', '1');
INSERT INTO `permission_role` VALUES ('3', '1');
INSERT INTO `permission_role` VALUES ('4', '1');
INSERT INTO `permission_role` VALUES ('5', '1');
INSERT INTO `permission_role` VALUES ('6', '1');
INSERT INTO `permission_role` VALUES ('7', '1');
INSERT INTO `permission_role` VALUES ('8', '1');
INSERT INTO `permission_role` VALUES ('9', '1');
INSERT INTO `permission_role` VALUES ('10', '1');
INSERT INTO `permission_role` VALUES ('11', '1');
INSERT INTO `permission_role` VALUES ('12', '1');
INSERT INTO `permission_role` VALUES ('13', '1');
INSERT INTO `permission_role` VALUES ('14', '1');
INSERT INTO `permission_role` VALUES ('15', '1');
INSERT INTO `permission_role` VALUES ('16', '1');
INSERT INTO `permission_role` VALUES ('17', '1');
INSERT INTO `permission_role` VALUES ('18', '1');
INSERT INTO `permission_role` VALUES ('19', '1');
INSERT INTO `permission_role` VALUES ('20', '1');
INSERT INTO `permission_role` VALUES ('21', '1');
INSERT INTO `permission_role` VALUES ('22', '1');
INSERT INTO `permission_role` VALUES ('23', '1');
INSERT INTO `permission_role` VALUES ('24', '1');
INSERT INTO `permission_role` VALUES ('25', '1');
INSERT INTO `permission_role` VALUES ('26', '1');
INSERT INTO `permission_role` VALUES ('27', '1');
INSERT INTO `permission_role` VALUES ('28', '1');
INSERT INTO `permission_role` VALUES ('29', '1');
INSERT INTO `permission_role` VALUES ('30', '1');
INSERT INTO `permission_role` VALUES ('31', '1');
INSERT INTO `permission_role` VALUES ('32', '1');
INSERT INTO `permission_role` VALUES ('33', '1');
INSERT INTO `permission_role` VALUES ('34', '1');
INSERT INTO `permission_role` VALUES ('35', '1');
INSERT INTO `permission_role` VALUES ('36', '1');
INSERT INTO `permission_role` VALUES ('37', '1');
INSERT INTO `permission_role` VALUES ('38', '1');
INSERT INTO `permission_role` VALUES ('39', '1');
INSERT INTO `permission_role` VALUES ('40', '1');
INSERT INTO `permission_role` VALUES ('41', '1');
INSERT INTO `permission_role` VALUES ('42', '1');
INSERT INTO `permission_role` VALUES ('43', '1');
INSERT INTO `permission_role` VALUES ('44', '1');
INSERT INTO `permission_role` VALUES ('45', '1');
INSERT INTO `permission_role` VALUES ('46', '1');
INSERT INTO `permission_role` VALUES ('47', '1');
INSERT INTO `permission_role` VALUES ('48', '1');
INSERT INTO `permission_role` VALUES ('49', '1');
INSERT INTO `permission_role` VALUES ('50', '1');
INSERT INTO `permission_role` VALUES ('51', '1');
INSERT INTO `permission_role` VALUES ('52', '1');
INSERT INTO `permission_role` VALUES ('53', '1');
INSERT INTO `permission_role` VALUES ('54', '1');
INSERT INTO `permission_role` VALUES ('55', '1');
INSERT INTO `permission_role` VALUES ('56', '1');
INSERT INTO `permission_role` VALUES ('57', '1');
INSERT INTO `permission_role` VALUES ('58', '1');
INSERT INTO `permission_role` VALUES ('59', '1');
INSERT INTO `permission_role` VALUES ('60', '1');
INSERT INTO `permission_role` VALUES ('61', '1');
INSERT INTO `permission_role` VALUES ('62', '1');
INSERT INTO `permission_role` VALUES ('63', '1');
INSERT INTO `permission_role` VALUES ('64', '1');
INSERT INTO `permission_role` VALUES ('65', '1');
INSERT INTO `permission_role` VALUES ('66', '1');
INSERT INTO `permission_role` VALUES ('67', '1');
INSERT INTO `permission_role` VALUES ('68', '1');
INSERT INTO `permission_role` VALUES ('69', '1');
INSERT INTO `permission_role` VALUES ('70', '1');
INSERT INTO `permission_role` VALUES ('71', '1');
INSERT INTO `permission_role` VALUES ('72', '1');
INSERT INTO `permission_role` VALUES ('73', '1');
INSERT INTO `permission_role` VALUES ('74', '1');
INSERT INTO `permission_role` VALUES ('75', '1');
INSERT INTO `permission_role` VALUES ('76', '1');
INSERT INTO `permission_role` VALUES ('77', '1');
INSERT INTO `permission_role` VALUES ('78', '1');
INSERT INTO `permission_role` VALUES ('79', '1');
INSERT INTO `permission_role` VALUES ('80', '1');
INSERT INTO `permission_role` VALUES ('81', '1');
INSERT INTO `permission_role` VALUES ('82', '1');
INSERT INTO `permission_role` VALUES ('83', '1');
INSERT INTO `permission_role` VALUES ('84', '1');
INSERT INTO `permission_role` VALUES ('85', '1');
INSERT INTO `permission_role` VALUES ('86', '1');
INSERT INTO `permission_role` VALUES ('87', '1');
INSERT INTO `permission_role` VALUES ('88', '1');
INSERT INTO `permission_role` VALUES ('89', '1');
INSERT INTO `permission_role` VALUES ('90', '1');
INSERT INTO `permission_role` VALUES ('91', '1');
INSERT INTO `permission_role` VALUES ('92', '1');
INSERT INTO `permission_role` VALUES ('93', '1');
INSERT INTO `permission_role` VALUES ('94', '1');
INSERT INTO `permission_role` VALUES ('95', '1');
INSERT INTO `permission_role` VALUES ('96', '1');
INSERT INTO `permission_role` VALUES ('97', '1');
INSERT INTO `permission_role` VALUES ('98', '1');
INSERT INTO `permission_role` VALUES ('99', '1');
INSERT INTO `permission_role` VALUES ('100', '1');
INSERT INTO `permission_role` VALUES ('101', '1');
INSERT INTO `permission_role` VALUES ('102', '1');
INSERT INTO `permission_role` VALUES ('103', '1');
INSERT INTO `permission_role` VALUES ('104', '1');
INSERT INTO `permission_role` VALUES ('105', '1');
INSERT INTO `permission_role` VALUES ('106', '1');
INSERT INTO `permission_role` VALUES ('107', '1');
INSERT INTO `permission_role` VALUES ('108', '1');
INSERT INTO `permission_role` VALUES ('109', '1');
INSERT INTO `permission_role` VALUES ('110', '1');
INSERT INTO `permission_role` VALUES ('105', '2');
INSERT INTO `permission_role` VALUES ('106', '2');
INSERT INTO `permission_role` VALUES ('52', '3');
INSERT INTO `permission_role` VALUES ('53', '3');
INSERT INTO `permission_role` VALUES ('54', '3');
INSERT INTO `permission_role` VALUES ('55', '3');
INSERT INTO `permission_role` VALUES ('56', '3');
INSERT INTO `permission_role` VALUES ('57', '3');
INSERT INTO `permission_role` VALUES ('58', '3');
INSERT INTO `permission_role` VALUES ('59', '3');
INSERT INTO `permission_role` VALUES ('60', '3');
INSERT INTO `permission_role` VALUES ('61', '3');
INSERT INTO `permission_role` VALUES ('62', '3');
INSERT INTO `permission_role` VALUES ('63', '3');
INSERT INTO `permission_role` VALUES ('64', '3');
INSERT INTO `permission_role` VALUES ('65', '3');
INSERT INTO `permission_role` VALUES ('66', '3');
INSERT INTO `permission_role` VALUES ('67', '3');
INSERT INTO `permission_role` VALUES ('68', '3');
INSERT INTO `permission_role` VALUES ('69', '3');
INSERT INTO `permission_role` VALUES ('70', '3');
INSERT INTO `permission_role` VALUES ('71', '3');
INSERT INTO `permission_role` VALUES ('72', '3');
INSERT INTO `permission_role` VALUES ('73', '3');
INSERT INTO `permission_role` VALUES ('74', '3');
INSERT INTO `permission_role` VALUES ('75', '3');
INSERT INTO `permission_role` VALUES ('76', '3');
INSERT INTO `permission_role` VALUES ('77', '3');
INSERT INTO `permission_role` VALUES ('78', '3');
INSERT INTO `permission_role` VALUES ('79', '3');
INSERT INTO `permission_role` VALUES ('80', '3');
INSERT INTO `permission_role` VALUES ('81', '3');
INSERT INTO `permission_role` VALUES ('82', '3');
INSERT INTO `permission_role` VALUES ('83', '3');
INSERT INTO `permission_role` VALUES ('84', '3');
INSERT INTO `permission_role` VALUES ('85', '3');
INSERT INTO `permission_role` VALUES ('86', '3');
INSERT INTO `permission_role` VALUES ('87', '3');
INSERT INTO `permission_role` VALUES ('88', '3');
INSERT INTO `permission_role` VALUES ('89', '3');
INSERT INTO `permission_role` VALUES ('90', '3');
INSERT INTO `permission_role` VALUES ('91', '3');
INSERT INTO `permission_role` VALUES ('92', '3');
INSERT INTO `permission_role` VALUES ('93', '3');
INSERT INTO `permission_role` VALUES ('94', '3');
INSERT INTO `permission_role` VALUES ('95', '3');
INSERT INTO `permission_role` VALUES ('96', '3');
INSERT INTO `permission_role` VALUES ('97', '3');
INSERT INTO `permission_role` VALUES ('98', '3');
INSERT INTO `permission_role` VALUES ('106', '3');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'edit',
  `show_menu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  KEY `permissions_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '1', 'settings.*', 'system_web_info_settings', '网站信息设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('2', '1', 'banners.*', 'system_banners_set', '横幅设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('3', '1', 'bannerItems.*', 'system_bannerItems_set', '横幅内页设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('4', '1', 'singelPages.*', 'system_single_page_set', '单页面设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('5', '1', 'customerServices.*', 'system_customer_service_set', '客服设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('6', '1', 'notices.*', 'notices_set', '通知设置', '所有页面和操作', 'edit', '1', '通知消息', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('7', '30', 'withDrawls.*', 'system_withDrawls_set', '钱包用户操作记录', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('8', '3', 'users.create', 'system_users_add', '添加会员页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('9', '3', 'users.store', 'system_users_store', '添加会员操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('10', '3', 'users.destroy', 'system_users_del', '删除会员操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('11', '3', 'users.edit', 'system_users_edit', '修改会员页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('12', '3', 'users.update', 'system_users_update', '修改会员操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('13', '3', 'users.index', 'system_users_list_show', '查看会员列表页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('14', '3', 'users.show', 'system_users_show', '查看会员页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('15', '4', 'userLevels.create', 'system_userLevels_add', '添加会员等级页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('16', '4', 'userLevels.store', 'system_userLevels_store', '添加会员等级操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('17', '4', 'userLevels.update', 'system_userLevels_update', '修改会员等级操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('18', '4', 'userLevels.destroy', 'system_userLevels_del', '删除会员等级操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('19', '4', 'userLevels.edit', 'system_userLevels_edit', '修改会员等级页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('20', '4', 'userLevels.index', 'system_userLevels_list_show', '查看会员等级列表页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('21', '5', 'wechat.menu.*', 'system_wechat_menu_set', '微信菜单设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('22', '5', 'wechat.reply.*', 'system_wechat_reply_message_set', '微信回复消息设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('23', '1', 'bankSets.*', 'system_bank_set', '银行卡设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('24', '1', 'countries.*', 'system_countries_set', '产地设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('25', '1', 'advertiseMobiles.*', 'system_bank_set', '移动端广告设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('26', '8', 'managers.create', 'system_managers_add', '添加管理员页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('27', '8', 'managers.destroy', 'system_managers_del', '删除管理员操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('28', '8', 'managers.store', 'system_managers_store', '添加管理员操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('29', '8', 'managers.update', 'system_managers_update', '修改管理员操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('30', '8', 'managers.edit', 'system_managers_edit', '修改管理员页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('31', '8', 'managers.index', 'system_managers_list_show', '查看管理员列表页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('32', '9', 'roles.create', 'system_roles_add', '添加角色页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('33', '9', 'roles.store', 'system_roles_store', '添加角色操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('34', '9', 'roles.destroy', 'system_roles_del', '删除角色操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('35', '9', 'roles.update', 'system_roles_update', '更新角色操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('36', '9', 'roles.edit', 'system_roles_edit', '修改角色页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('37', '9', 'roles.index', 'system_roles_list_show', '查看角色列表页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('38', '24', 'permissions.create', 'system_permissions_add', '添加权限页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('39', '24', 'permissions.store', 'system_permissions_store', '添加权限操作', '操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('40', '24', 'permissions.index', 'system_permissions_show', '查看权限列表页面', '页面', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('41', '1', 'cities.*', 'system_cities_set', '地区设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('42', '1', 'freightTems.*', 'system_freightTems_set', '运费模板设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('43', '31', 'articlecats.*', 'system_articlecats_set', '模板分类设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('44', '31', 'posts.*', 'system_posts_set', '模板文章设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('45', '31', 'customPostTypes.*', 'system_customPostTypes_set', '模板自定义文章设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('46', '31', 'customPostTypeItems.*', 'system_customPostTypeItems_set', '模板自定义文章详情设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('47', '31', 'pages.*', 'system_pages_set', '模板单页设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('48', '31', 'customPageTypes.*', 'system_customPageTypes_set', '模板自定义单页设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('49', '31', 'pageItems.*', 'system_pageItems_set', '模板自定义单页详情设置', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('50', '27', 'distributions.*', 'system_distributions_set', '分销设置', '所有页面和操作', 'edit', '1', '分销', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('51', '27', 'distributionLogs.*', 'system_distributionLogs_set', '分销日志设置', '所有页面和操作', 'edit', '1', '分销', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('52', '10', 'stat.*', 'shop_all_statics_show', '查看商城统计信息页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('53', '11', 'orders.destroy', 'shop_orders_del', '删除订单操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('54', '11', 'orders.show', 'shop_orders_edit', '详细订单页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('55', '11', 'orders.edit', 'shop_orders_edit', '修改订单页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('56', '11', 'orders.update', 'shop_orders_update', '修改订单操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('57', '11', 'orders.index', 'shop_orders_list_show', '查看订单列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('58', '11', 'orderCancels.*', 'shop_orders_orderCancels', '订单退款管理', '所有页面和操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('59', '11', 'orderRefunds.*', 'shop_orders_orderRefunds', '订单退换货管理', '所有页面和操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('60', '11', 'refundMoneys.*', 'shop_orders_orderRefundMoneys', '订单退款记录', '所有页面和操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('61', '12', 'products.create', 'shop_products_add', '添加商品页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('62', '12', 'products.store', 'shop_products_store', '添加商品操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('63', '12', 'products.update', 'shop_products_update', '修改商品操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('64', '12', 'products.destroy', 'shop_products_del', '删除商品', '操作', 'edit', '1', '商城', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `permissions` VALUES ('65', '12', 'products.edit', 'shop_products_edit', '修改商品页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('66', '12', 'products.index', 'shop_products_list_show', '查看商品列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('67', '12', 'products.alllow', 'shop_products_alllow', '查看商品库存报警列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('68', '12', 'wordlist.*', 'shop_products_wordlist', '查看商品附加字段列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('69', '13', 'categories.create', 'shop_product_categories_add', '添加商品分类页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('70', '13', 'categories.store', 'shop_product_categories_store', '添加商品分类操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('71', '13', 'categories.update', 'shop_product_categories_update', '修改商品分类操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('72', '13', 'categories.destroy', 'shop_product_categories_del', '删除商品分类操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('73', '13', 'categories.edit', 'shop_product_categories_edit', '修改商品分类页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('74', '13', 'categories.index', 'shop_product_categories_list_show', '查看商品分类列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('75', '14', 'brands.create', 'shop_product_brand_add', '添加商品品牌页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('76', '14', 'brands.store', 'shop_product_brand_store', '添加商品品牌操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('77', '14', 'brands.update', 'shop_product_brand_update', '修改商品品牌操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('78', '14', 'brands.destroy', 'shop_product_brand_del', '删除商品品牌操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('79', '14', 'brands.edit', 'shop_product_brand_edit', '修改商品品牌页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('80', '14', 'brands.index', 'shop_product_brand_list_show', '查看商品品牌列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('81', '15', 'productTypes.create', 'shop_productTypes_add', '添加商品模型页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('82', '15', 'productTypes.store', 'shop_productTypes_store', '添加商品模型操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('83', '15', 'productTypes.update', 'shop_productTypes_update', '修改商品模型操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('84', '15', 'productTypes.destroy', 'shop_productTypes_del', '删除商品模型操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('85', '15', 'productTypes.edit', 'shop_productTypes_edit', '修改商品模型页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('86', '15', 'productTypes.index', 'shop_productTypes_list_show', '查看商品模型列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('87', '16', 'specs.create', 'shop_product_specs_add', '添加商品规格页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('88', '16', 'specs.store', 'shop_product_specs_store', '添加商品规格操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('89', '16', 'specs.update', 'shop_product_specs_update', '修改商品规格操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('90', '16', 'specs.destroy', 'shop_product_specs_del', '删除商品规格操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('91', '16', 'specs.edit', 'shop_product_specs_edit', '修改商品规格', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('92', '16', 'specs.index', 'shop_product_specs_list_show', '查看商品规格列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('93', '17', 'productAttrs.create', 'shop_productAttrs_add', '添加商品属性页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('94', '17', 'productAttrs.store', 'shop_productAttrs_store', '添加商品属性操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('95', '17', 'productAttrs.update', 'shop_productAttrs_update', '修改商品属性操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('96', '17', 'productAttrs.destroy', 'shop_productAttrs_del', '删除商品属性操作', '操作', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('97', '17', 'productAttrs.edit', 'shop_productAttrs_edit', '修改商品属性页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('98', '17', 'productAttrs.index', 'shop_productAttrs_list_show', '查看商品属性列表页面', '页面', 'edit', '1', '商城', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('99', '18', 'productPromps.*', 'product_promps_set', '商品促销设置', '所有页面和操作', 'edit', '1', '促销', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('100', '18', 'orderPromps.*', 'order_promps_set', '订单促销设置', '所有页面和操作', 'edit', '1', '促销', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('101', '18', 'coupons.*', 'coupons_promps_set', '优惠券设置', '所有页面和操作', 'edit', '1', '促销', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('102', '18', 'couponRules.*', 'coupons_promps_auto_rules', '优惠券自动发放', '所有页面和操作', 'edit', '1', '促销', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('103', '18', 'flashSales.*', 'promps_flashSales_set', '秒杀设置', '所有页面和操作', 'edit', '1', '促销', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('104', '18', 'teamSales.*', 'promps_teamSales_set', '拼团设置', '所有页面和操作', 'edit', '1', '促销', '2018-08-17 11:47:06', '2018-08-17 11:47:06');
INSERT INTO `permissions` VALUES ('105', '1', 'cats.*', null, '店铺分类管理', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 13:39:43', '2018-08-17 13:39:43');
INSERT INTO `permissions` VALUES ('106', '1', 'stores.*', null, '店铺管理', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 13:40:05', '2018-08-17 13:40:05');
INSERT INTO `permissions` VALUES ('107', '1', 'projects.*', null, '商户需求管理', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 13:40:33', '2018-08-17 13:40:33');
INSERT INTO `permissions` VALUES ('108', '1', 'cards.*', null, '积分卡管理', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 13:41:48', '2018-08-17 13:41:48');
INSERT INTO `permissions` VALUES ('109', '1', 'certs.*', null, '实名认证管理', '所有页面和操作', 'edit', '1', '系统', '2018-08-17 13:42:13', '2018-08-17 13:42:13');
INSERT INTO `permissions` VALUES ('110', '1', 'keFuFeedBacks.*', null, '客服反馈', '所有页面和操作', 'edit', '1', '系统', '2018-08-22 17:37:51', '2018-08-22 17:37:51');

-- ----------------------------
-- Table structure for post_items
-- ----------------------------
DROP TABLE IF EXISTS `post_items`;
CREATE TABLE `post_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段名',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段中文名',
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段值',
  `post_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_items_id_created_at_index` (`id`,`created_at`),
  KEY `post_items_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post_items
-- ----------------------------

-- ----------------------------
-- Table structure for post_product
-- ----------------------------
DROP TABLE IF EXISTS `post_product`;
CREATE TABLE `post_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `spec_price_id` int(10) unsigned DEFAULT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_product_product_id_foreign` (`product_id`),
  KEY `post_product_spec_price_id_foreign` (`spec_price_id`),
  KEY `post_product_post_id_foreign` (`post_id`),
  KEY `post_product_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `post_product_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `post_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `post_product_spec_price_id_foreign` FOREIGN KEY (`spec_price_id`) REFERENCES `spec_product_prices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post_product
-- ----------------------------

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '正文',
  `view` int(11) NOT NULL DEFAULT '1' COMMENT '浏览量',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO_标题',
  `seo_des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO_描述',
  `seo_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'SEO_关键词',
  `status` tinyint(4) DEFAULT '0' COMMENT '文章状态 0 草稿 1 发布',
  `user_id` int(11) DEFAULT '0' COMMENT '发布用户id',
  `is_hot` tinyint(4) DEFAULT '0' COMMENT '是否热门 0 不是热门 1 热门',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_id_created_at_index` (`id`,`created_at`),
  KEY `posts_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for posts_images
-- ----------------------------
DROP TABLE IF EXISTS `posts_images`;
CREATE TABLE `posts_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_images_id_created_at_index` (`id`,`created_at`),
  KEY `posts_images_post_id_index` (`post_id`),
  CONSTRAINT `posts_images_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts_images
-- ----------------------------

-- ----------------------------
-- Table structure for product_attr_values
-- ----------------------------
DROP TABLE IF EXISTS `product_attr_values`;
CREATE TABLE `product_attr_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attr_values_id_created_at_product_id_index` (`id`,`created_at`,`product_id`),
  KEY `product_attr_values_attr_id_index` (`attr_id`),
  KEY `product_attr_values_product_id_index` (`product_id`),
  CONSTRAINT `product_attr_values_attr_id_foreign` FOREIGN KEY (`attr_id`) REFERENCES `product_attrs` (`id`),
  CONSTRAINT `product_attr_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_attr_values
-- ----------------------------

-- ----------------------------
-- Table structure for product_attrs
-- ----------------------------
DROP TABLE IF EXISTS `product_attrs`;
CREATE TABLE `product_attrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '属性名',
  `isIndex` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '否' COMMENT '是否索引',
  `input_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0手动输入 1列表选择 2手动多行输入',
  `values` text COLLATE utf8mb4_unicode_ci COMMENT '属性取值列表',
  `attr_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0唯一属性 1单选属性 2复选属性',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `type_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attrs_id_created_at_index` (`id`,`created_at`),
  KEY `product_attrs_type_id_index` (`type_id`),
  KEY `product_attrs_sort_index` (`sort`),
  CONSTRAINT `product_attrs_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_attrs
-- ----------------------------

-- ----------------------------
-- Table structure for product_evals
-- ----------------------------
DROP TABLE IF EXISTS `product_evals`;
CREATE TABLE `product_evals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论内容',
  `anonymous` int(11) DEFAULT '0' COMMENT '1的话匿名不显示昵称,0的话显示',
  `zan` int(11) DEFAULT '0' COMMENT '点赞数',
  `all_level` int(11) NOT NULL COMMENT '总体评价12345五个等级',
  `service_level` int(11) NOT NULL COMMENT '商家服务评价12345五个等级',
  `logistics_level` int(11) NOT NULL COMMENT '物流速度评价12345五个等级',
  `overall_level` int(11) NOT NULL COMMENT '整体评价12345五个等级',
  `product_id` int(10) unsigned DEFAULT NULL,
  `spec_id` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_evals_id_created_at_index` (`id`,`created_at`),
  KEY `product_evals_product_id_index` (`product_id`),
  KEY `product_evals_spec_id_index` (`spec_id`),
  KEY `product_evals_user_id_index` (`user_id`),
  CONSTRAINT `product_evals_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_evals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_evals
-- ----------------------------
INSERT INTO `product_evals` VALUES ('5', '122', '0', '0', '3', '2', '3', '2', '5', '0', '1', '2018-08-21 18:16:34', '2018-08-21 18:17:22', '2018-08-21 18:17:22');
INSERT INTO `product_evals` VALUES ('6', '123', '0', '0', '3', '3', '3', '5', '5', '0', '1', '2018-08-21 18:18:03', '2018-08-21 18:18:03', null);
INSERT INTO `product_evals` VALUES ('7', '123', '0', '0', '3', '3', '3', '5', '5', '0', '1', '2018-08-21 18:19:03', '2018-08-21 18:19:03', null);
INSERT INTO `product_evals` VALUES ('8', '1', '1', '0', '2', '1', '1', '2', '5', '0', '1', '2018-08-21 18:21:34', '2018-08-21 18:21:34', null);
INSERT INTO `product_evals` VALUES ('9', '1', '1', '0', '2', '1', '1', '2', '5', '0', '1', '2018-08-21 18:22:33', '2018-08-23 08:56:59', '2018-08-23 08:56:59');
INSERT INTO `product_evals` VALUES ('10', '好评', '0', '0', '4', '4', '4', '3', '5', '0', '1', '2018-08-22 10:00:55', '2018-08-22 10:00:55', null);
INSERT INTO `product_evals` VALUES ('11', '12345', '1', '2', '2', '2', '3', '4', '6', '0', '1', '2018-08-24 18:18:43', '2018-08-28 14:41:00', null);

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_id_created_at_index` (`id`,`created_at`),
  KEY `product_images_product_id_index` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('1', 'http://yibei.wiswebs.com/uploads/商品/6402.png', '1', '2018-08-17 16:16:08', '2018-08-19 15:11:19', '2018-08-19 15:11:19');
INSERT INTO `product_images` VALUES ('2', 'http://yibei.wiswebs.com/uploads/商品/6403.png', '1', '2018-08-17 16:16:13', '2018-08-19 15:11:20', '2018-08-19 15:11:20');
INSERT INTO `product_images` VALUES ('3', 'http://yibei.wiswebs.com/uploads/商品/6404.png', '1', '2018-08-17 16:16:15', '2018-08-19 15:11:21', '2018-08-19 15:11:21');
INSERT INTO `product_images` VALUES ('4', 'http://yibei.wiswebs.com/uploads/商品/640.jpg', '2', '2018-08-17 16:19:17', '2018-08-19 15:15:27', '2018-08-19 15:15:27');
INSERT INTO `product_images` VALUES ('5', 'http://yibei.wiswebs.com/uploads/商品/TB2_v2Du84lpuFjy1zjXXcAKpXa_!!2477804224.jpg_430x430q90.jpg', '2', '2018-08-17 16:19:20', '2018-08-19 15:15:28', '2018-08-19 15:15:28');
INSERT INTO `product_images` VALUES ('6', 'http://yibei.wiswebs.com/uploads/商品/TB2KAjbbAUkyKJjy1zjXXX1wFXa_!!2477804224.jpg_430x430q90.jpg', '2', '2018-08-17 16:19:23', '2018-08-19 15:15:28', '2018-08-19 15:15:28');
INSERT INTO `product_images` VALUES ('7', 'http://yibei.wiswebs.com/uploads/商品/640_1.png', '3', '2018-08-17 16:22:57', '2018-08-19 15:15:45', '2018-08-19 15:15:45');
INSERT INTO `product_images` VALUES ('8', 'http://yibei.wiswebs.com/uploads/商品/6_2.jpg', '3', '2018-08-17 16:23:05', '2018-08-17 16:23:07', '2018-08-17 16:23:07');
INSERT INTO `product_images` VALUES ('9', 'http://yibei.wiswebs.com/uploads/商品/6402_1.png', '4', '2018-08-19 10:19:14', '2018-08-19 15:16:01', '2018-08-19 15:16:01');
INSERT INTO `product_images` VALUES ('10', 'http://yibei.wiswebs.com/uploads/商品/6403_1.png', '4', '2018-08-19 10:19:23', '2018-08-19 15:16:02', '2018-08-19 15:16:02');
INSERT INTO `product_images` VALUES ('11', 'http://yibei.wiswebs.com/uploads/商品/640_2.png', '4', '2018-08-19 10:19:28', '2018-08-19 15:16:02', '2018-08-19 15:16:02');
INSERT INTO `product_images` VALUES ('12', 'http://yibei.wiswebs.com/uploads/商品/6401.png', '5', '2018-08-19 11:11:20', '2018-08-19 15:16:26', '2018-08-19 15:16:26');
INSERT INTO `product_images` VALUES ('13', 'http://yibei.wiswebs.com/uploads/商品/640_3.png', '5', '2018-08-19 11:11:30', '2018-08-19 15:16:27', '2018-08-19 15:16:27');
INSERT INTO `product_images` VALUES ('14', 'http://yibei.wiswebs.com/uploads/商品/6_4.jpg', '5', '2018-08-19 11:11:40', '2018-08-19 11:11:41', '2018-08-19 11:11:41');
INSERT INTO `product_images` VALUES ('15', 'http://yibei.wiswebs.com/uploads/商品/6401.png', '6', '2018-08-19 11:14:12', '2018-08-19 11:15:06', '2018-08-19 11:15:06');
INSERT INTO `product_images` VALUES ('16', 'http://yibei.wiswebs.com/uploads/商品/6401_1.png', '6', '2018-08-19 11:14:20', '2018-08-19 11:15:16', '2018-08-19 11:15:16');
INSERT INTO `product_images` VALUES ('17', 'http://yibei.wiswebs.com/uploads/商品/640_4.png', '6', '2018-08-19 11:14:29', '2018-08-19 11:15:11', '2018-08-19 11:15:11');
INSERT INTO `product_images` VALUES ('18', 'http://yibei.wiswebs.com/uploads/商品/640_4.png', '6', '2018-08-19 11:15:23', '2018-08-19 15:18:08', '2018-08-19 15:18:08');
INSERT INTO `product_images` VALUES ('19', 'http://yibei.wiswebs.com/uploads/商品/6401_1.png', '6', '2018-08-19 11:15:26', '2018-08-19 15:18:09', '2018-08-19 15:18:09');
INSERT INTO `product_images` VALUES ('20', 'http://yibei.wiswebs.com/uploads/商品/汽车/640.png', '7', '2018-08-19 11:21:38', '2018-08-19 11:21:39', '2018-08-19 11:21:39');
INSERT INTO `product_images` VALUES ('21', 'http://yibei.wiswebs.com/uploads/商品/汽车/640.png', '7', '2018-08-19 11:21:43', '2018-08-19 11:21:43', null);
INSERT INTO `product_images` VALUES ('22', 'http://yibei.wiswebs.com/uploads/商品/汽车/6401_2.png', '7', '2018-08-19 11:21:45', '2018-08-19 11:21:45', null);
INSERT INTO `product_images` VALUES ('23', 'http://yibei.wiswebs.com/uploads/商品/汽车/640_1.png', '8', '2018-08-19 11:24:43', '2018-08-19 11:24:43', null);
INSERT INTO `product_images` VALUES ('24', 'http://yibei.wiswebs.com/uploads/商品/房产置业/640.png', '9', '2018-08-19 11:55:42', '2018-08-19 11:55:42', null);
INSERT INTO `product_images` VALUES ('25', 'http://yibei.wiswebs.com/uploads/商品/房产置业/6403.png', '9', '2018-08-19 11:55:46', '2018-08-19 11:55:46', null);
INSERT INTO `product_images` VALUES ('26', 'http://yibei.wiswebs.com/uploads/商品/房产置业/6401.png', '10', '2018-08-19 11:57:45', '2018-08-19 11:57:45', null);
INSERT INTO `product_images` VALUES ('27', 'http://yibei.wiswebs.com/uploads/商品/房产置业/640_1.png', '10', '2018-08-19 11:57:52', '2018-08-19 11:57:52', null);
INSERT INTO `product_images` VALUES ('28', 'http://yibei.wiswebs.com/uploads/商品/黄金珠宝/640.png', '11', '2018-08-19 13:47:21', '2018-08-19 13:47:21', null);
INSERT INTO `product_images` VALUES ('29', 'http://yibei.wiswebs.com/uploads/商品/黄金珠宝/6401.png', '11', '2018-08-19 13:47:24', '2018-08-19 13:47:24', null);
INSERT INTO `product_images` VALUES ('30', 'http://yibei.wiswebs.com/uploads/商品/黄金珠宝/640.png', '12', '2018-08-19 13:51:13', '2018-08-19 13:51:13', null);
INSERT INTO `product_images` VALUES ('31', 'http://yibei.wiswebs.com/uploads/商品/黄金珠宝/6401.png', '12', '2018-08-19 13:51:19', '2018-08-19 13:51:19', null);
INSERT INTO `product_images` VALUES ('32', 'http://yibei.wiswebs.com/uploads/商品/黄金珠宝/6404.png', '13', '2018-08-19 14:04:19', '2018-08-19 14:04:19', null);
INSERT INTO `product_images` VALUES ('33', 'http://yibei.wiswebs.com/uploads/商品/黄金珠宝/6403.png', '13', '2018-08-19 14:04:23', '2018-08-19 14:04:23', null);
INSERT INTO `product_images` VALUES ('34', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/640.png', '14', '2018-08-19 14:09:11', '2018-08-19 14:09:11', null);
INSERT INTO `product_images` VALUES ('35', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/6401.png', '14', '2018-08-19 14:09:13', '2018-08-19 14:09:13', null);
INSERT INTO `product_images` VALUES ('36', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/6403.png', '14', '2018-08-19 14:09:17', '2018-08-19 14:09:17', null);
INSERT INTO `product_images` VALUES ('37', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/6403_1.png', '15', '2018-08-19 14:12:11', '2018-08-19 14:12:11', null);
INSERT INTO `product_images` VALUES ('38', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/640_1.png', '15', '2018-08-19 14:12:17', '2018-08-19 14:12:17', null);
INSERT INTO `product_images` VALUES ('39', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/640_2.png', '16', '2018-08-19 14:15:49', '2018-08-19 14:15:49', null);
INSERT INTO `product_images` VALUES ('40', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/6402_1.png', '16', '2018-08-19 14:15:53', '2018-08-19 14:15:53', null);
INSERT INTO `product_images` VALUES ('41', 'http://yibei.wiswebs.com/uploads/商品/建材家居/640.png', '17', '2018-08-19 14:19:25', '2018-08-19 14:19:25', null);
INSERT INTO `product_images` VALUES ('42', 'http://yibei.wiswebs.com/uploads/商品/建材家居/6402.png', '17', '2018-08-19 14:19:26', '2018-08-19 14:19:26', null);
INSERT INTO `product_images` VALUES ('43', 'http://yibei.wiswebs.com/uploads/商品/建材家居/6403.png', '17', '2018-08-19 14:19:28', '2018-08-19 14:19:28', null);
INSERT INTO `product_images` VALUES ('44', 'http://yibei.wiswebs.com/uploads/商品/建材家居/6401.png', '18', '2018-08-19 14:21:42', '2018-08-19 14:21:42', null);
INSERT INTO `product_images` VALUES ('45', 'http://yibei.wiswebs.com/uploads/商品/建材家居/640_1.png', '18', '2018-08-19 14:21:46', '2018-08-19 14:21:46', null);
INSERT INTO `product_images` VALUES ('46', 'http://yibei.wiswebs.com/uploads/商品/建材家居/6402_1.png', '18', '2018-08-19 14:21:49', '2018-08-19 14:21:49', null);
INSERT INTO `product_images` VALUES ('47', 'http://yibei.wiswebs.com/uploads/商品/建材家居/640_2.png', '19', '2018-08-19 14:24:29', '2018-08-19 14:24:29', null);
INSERT INTO `product_images` VALUES ('48', 'http://yibei.wiswebs.com/uploads/商品/建材家居/6403_1.png', '20', '2018-08-19 14:31:36', '2018-08-19 14:31:36', null);
INSERT INTO `product_images` VALUES ('49', 'http://yibei.wiswebs.com/uploads/商品/建材家居/6402_2.png', '20', '2018-08-19 14:31:40', '2018-08-19 14:31:40', null);
INSERT INTO `product_images` VALUES ('50', 'http://yibei.wiswebs.com/uploads/商品/建材家居/640_3.png', '20', '2018-08-19 14:31:44', '2018-08-19 14:31:44', null);
INSERT INTO `product_images` VALUES ('51', 'http://yibei.wiswebs.com/uploads/商品/消费卡区/640.png', '21', '2018-08-19 14:35:12', '2018-08-19 14:35:12', null);
INSERT INTO `product_images` VALUES ('52', 'http://yibei.wiswebs.com/uploads/商品/企业店铺/640(1).jpg', '22', '2018-08-19 14:38:03', '2018-08-19 14:38:03', null);
INSERT INTO `product_images` VALUES ('53', 'http://yibei.wiswebs.com/uploads/商品/企业店铺/6402(1).jpg', '22', '2018-08-19 14:38:05', '2018-08-19 14:38:05', null);
INSERT INTO `product_images` VALUES ('54', 'http://yibei.wiswebs.com/uploads/商品/企业店铺/640.jpg', '23', '2018-08-19 14:40:26', '2018-09-07 14:50:24', '2018-09-07 14:50:24');
INSERT INTO `product_images` VALUES ('55', 'http://yibei.wiswebs.com/uploads/商品/企业店铺/6402.jpg', '23', '2018-08-19 14:40:28', '2018-09-07 14:50:23', '2018-09-07 14:50:23');
INSERT INTO `product_images` VALUES ('56', 'http://yibei.wiswebs.com/uploads/商品/企业店铺/640_1.jpg', '24', '2018-08-19 14:43:21', '2018-09-07 14:40:53', '2018-09-07 14:40:53');
INSERT INTO `product_images` VALUES ('57', 'http://yibei.wiswebs.com/uploads/商品/企业店铺/6403.jpg', '24', '2018-08-19 14:43:24', '2018-09-07 14:40:52', '2018-09-07 14:40:52');
INSERT INTO `product_images` VALUES ('58', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/6402.jpg', '25', '2018-08-19 14:46:25', '2018-09-07 11:51:06', '2018-09-07 11:51:06');
INSERT INTO `product_images` VALUES ('59', 'http://yibei.wiswebs.com/uploads/商品/广告媒体/640.jpg', '25', '2018-08-19 14:46:29', '2018-09-07 11:51:29', '2018-09-07 11:51:29');
INSERT INTO `product_images` VALUES ('60', 'http://yibei.wiswebs.com/uploads/商品/国际名品/640_2.png', '1', '2018-08-19 15:11:29', '2018-08-19 15:14:42', '2018-08-19 15:14:42');
INSERT INTO `product_images` VALUES ('61', 'https://yibei.wiswebs.com/uploads/商品/国际名品/7_2.jpg', '1', '2018-08-19 15:15:12', '2018-08-19 15:15:12', null);
INSERT INTO `product_images` VALUES ('62', 'http://yibei.wiswebs.com/uploads/商品/国际名品/TB2_v2Du84lpuFjy1zjXXcAKpXa_!!2477804224.jpg_430x430q90.jpg', '2', '2018-08-19 15:15:34', '2018-08-19 15:15:34', null);
INSERT INTO `product_images` VALUES ('63', 'http://yibei.wiswebs.com/uploads/商品/国际名品/400.png', '3', '2018-08-19 15:15:51', '2018-08-19 15:15:51', null);
INSERT INTO `product_images` VALUES ('64', 'http://yibei.wiswebs.com/uploads/商品/国际名品/400_1.png', '4', '2018-08-19 15:16:06', '2018-08-19 15:16:06', null);
INSERT INTO `product_images` VALUES ('65', 'http://yibei.wiswebs.com/uploads/商品/汽车/400_2.png', '5', '2018-08-19 15:16:38', '2018-08-19 15:16:38', null);
INSERT INTO `product_images` VALUES ('66', 'http://yibei.wiswebs.com/uploads/商品/汽车/400_3.png', '6', '2018-08-19 15:18:14', '2018-08-19 15:18:14', null);
INSERT INTO `product_images` VALUES ('67', 'http://yibei.wiswebs.com/uploads/宝马/cq5dam.resized.img.585.low.time1516697452475.jpg', '25', '2018-09-07 11:52:35', '2018-09-07 11:52:35', null);
INSERT INTO `product_images` VALUES ('68', 'http://yibei.wiswebs.com/uploads/宝马/cq5dam.resized.img.585.low.time1516697532162.jpg', '25', '2018-09-07 11:52:38', '2018-09-07 11:52:38', null);
INSERT INTO `product_images` VALUES ('69', 'http://yibei.wiswebs.com/uploads/宝马/3_series_sedan_n.png', '25', '2018-09-07 11:53:00', '2018-09-07 11:53:00', null);
INSERT INTO `product_images` VALUES ('70', 'http://yibei.wiswebs.com/uploads/宝马/3_series_sedan_n.png', '25', '2018-09-07 11:53:57', '2018-09-07 11:53:57', null);
INSERT INTO `product_images` VALUES ('71', 'http://yibei.wiswebs.com/uploads/宝马/5_series_li_2017.png', '24', '2018-09-07 14:41:00', '2018-09-07 14:41:00', null);
INSERT INTO `product_images` VALUES ('72', 'http://yibei.wiswebs.com/uploads/宝马/cq5dam.resized.img.1680.large.time1522330114215.jpg', '24', '2018-09-07 14:41:04', '2018-09-07 14:41:04', null);
INSERT INTO `product_images` VALUES ('73', 'http://yibei.wiswebs.com/uploads/宝马/cq5dam.resized.img.890.medium.time1530276733179.jpg', '24', '2018-09-07 14:41:08', '2018-09-07 14:41:08', null);
INSERT INTO `product_images` VALUES ('74', 'http://yibei.wiswebs.com/uploads/宝马/6_series_gran_coupe_2011.png', '23', '2018-09-07 14:50:31', '2018-09-07 14:50:31', null);
INSERT INTO `product_images` VALUES ('75', 'http://yibei.wiswebs.com/uploads/宝马/cq5dam.resized.img.890.medium.time1474513717408.jpg', '23', '2018-09-07 14:50:36', '2018-09-07 14:50:36', null);
INSERT INTO `product_images` VALUES ('76', 'http://yibei.wiswebs.com/uploads/宝马/Wallpaper_1920x1200_05.jpg', '23', '2018-09-07 14:50:38', '2018-09-07 14:50:38', null);

-- ----------------------------
-- Table structure for product_promps
-- ----------------------------
DROP TABLE IF EXISTS `product_promps`;
CREATE TABLE `product_promps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `type` int(11) NOT NULL COMMENT '0 打折优惠 1减价优惠 2固定金额出售',
  `value` decimal(10,2) NOT NULL COMMENT '优惠数值 打折就是折扣， 减价就是减价金额 固定金额就是出售价格',
  `time_begin` timestamp NULL DEFAULT NULL COMMENT '活动开始时间',
  `time_end` timestamp NULL DEFAULT NULL COMMENT '活动结束时间',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活动宣传图片',
  `intro` longtext COLLATE utf8mb4_unicode_ci COMMENT '活动介绍',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_promps_id_created_at_index` (`id`,`created_at`),
  KEY `product_promps_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_promps
-- ----------------------------

-- ----------------------------
-- Table structure for product_theme
-- ----------------------------
DROP TABLE IF EXISTS `product_theme`;
CREATE TABLE `product_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `theme_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_theme_product_id_foreign` (`product_id`),
  KEY `product_theme_theme_id_foreign` (`theme_id`),
  KEY `product_theme_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `product_theme_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_theme_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_theme
-- ----------------------------

-- ----------------------------
-- Table structure for product_types
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品模型名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_types_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_types
-- ----------------------------
INSERT INTO `product_types` VALUES ('1', '易呗', '2018-09-03 18:18:04', '2018-09-03 18:18:51', '2018-09-03 18:18:51');
INSERT INTO `product_types` VALUES ('2', '宝马3系GT', '2018-09-07 12:02:12', '2018-09-07 14:37:35', '2018-09-07 14:37:35');

-- ----------------------------
-- Table structure for product_user
-- ----------------------------
DROP TABLE IF EXISTS `product_user`;
CREATE TABLE `product_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_user_product_id_foreign` (`product_id`),
  KEY `product_user_user_id_foreign` (`user_id`),
  KEY `product_user_id_product_id_user_id_created_at_index` (`id`,`product_id`,`user_id`,`created_at`),
  CONSTRAINT `product_user_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_user
-- ----------------------------
INSERT INTO `product_user` VALUES ('3', '3', '1', '2018-08-19 14:59:56', null, null);

-- ----------------------------
-- Table structure for product_word
-- ----------------------------
DROP TABLE IF EXISTS `product_word`;
CREATE TABLE `product_word` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_word_word_id_foreign` (`word_id`),
  KEY `product_word_product_id_foreign` (`product_id`),
  KEY `product_word_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `product_word_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_word_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `word` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_word
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '产品名称',
  `sn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品编号',
  `image` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '产品图片',
  `price` double(8,2) NOT NULL COMMENT '产品价格',
  `market_price` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `cost` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '产品成本',
  `inventory` int(11) NOT NULL DEFAULT '1' COMMENT '库存',
  `max_buy` int(11) NOT NULL DEFAULT '100' COMMENT '单次最大可买数量',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '重量(单位:克)',
  `freight` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品关键词',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '附加说明：活动促销信息等用，高亮显示在价格下方',
  `intro` longtext COLLATE utf8mb4_unicode_ci COMMENT '产品介绍',
  `delivery` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配送区域',
  `free_shipping` tinyint(4) NOT NULL DEFAULT '0' COMMENT '免邮 0不免费 1免费',
  `service_promise` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '服务承诺',
  `recommend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐 0 否 1 是',
  `recommend_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '可为推荐产品自定义标题',
  `recommend_intro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '可为推荐产品自定义副标题',
  `shelf` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否上架 0 否 1 是',
  `sort` int(11) DEFAULT '0' COMMENT '展示排序',
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0非新品 1新品',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0非热卖 1热卖',
  `views` int(11) NOT NULL DEFAULT '1' COMMENT '浏览量',
  `collectoins` int(11) NOT NULL DEFAULT '1' COMMENT '收藏量',
  `sales_count` int(11) NOT NULL DEFAULT '1' COMMENT '销售量',
  `prom_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0无1抢购2团购3商品促销4订单促销5拼团',
  `prom_id` int(11) NOT NULL DEFAULT '0' COMMENT '优惠活动ID',
  `commission` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '佣金用于提成',
  `spu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'spu',
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sku',
  `shipping_area_ids` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配送物流shipping_area_id,以逗号分隔',
  `brand_id` int(10) unsigned DEFAULT NULL COMMENT '所属品牌',
  `type_id` int(10) unsigned DEFAULT NULL COMMENT '所属模型',
  `category_id` int(10) unsigned DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jifen` int(11) DEFAULT '0' COMMENT '购物所需积分',
  PRIMARY KEY (`id`),
  KEY `products_id_created_at_index` (`id`,`created_at`),
  KEY `products_prom_id_index` (`prom_id`),
  KEY `products_brand_id_index` (`brand_id`),
  KEY `products_type_id_index` (`type_id`),
  KEY `products_category_id_index` (`category_id`),
  KEY `products_sort_index` (`sort`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `products_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '日本Fancl/无添加 柔滑保湿洁面粉50g 新版', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/640.png', '99.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '日本Fancl/无添加 柔滑保湿洁面粉50g 新版', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/1.jpg?1534661367733\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/2.jpg?1534661372094\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/3.jpg?1534661375424\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/4.jpg?1534661379414\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/5.jpg?1534661383271\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/6.jpg?1534661386978\" alt=\"6\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '1', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '6', null, '2018-08-17 16:16:01', '2018-08-19 14:54:20', null, '50');
INSERT INTO `products` VALUES ('2', '山本汉方 日本进口大麦若叶青汁排毒减肥清肠代餐粉3g*44袋*3盒', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/TB2_v2Du84lpuFjy1zjXXcAKpXa_!!2477804224.jpg_430x430q90.jpg', '229.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '山本汉方 日本进口大麦若叶青汁排毒减肥清肠代餐粉3g*44袋*3盒', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/1_1.jpg?1534661439673\" alt=\"1_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/2_1.jpg?1534661446259\" alt=\"2_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/3_1.jpg?1534661449911\" alt=\"3_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/4_1.jpg?1534661454967\" alt=\"4_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/5_1.jpg?1534661461164\" alt=\"5_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/6_1.jpg?1534661465649\" alt=\"6_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/7.jpg?1534661468813\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/8.jpg?1534661474055\" alt=\"8\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '6', null, '2018-08-17 16:19:07', '2018-08-19 14:55:49', null, '88');
INSERT INTO `products` VALUES ('3', '日本进口花王/KAO 热敷蒸汽眼罩睡眠眼罩2盒 28片套装', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/400.png', '154.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '日本进口花王/KAO 热敷蒸汽眼罩睡眠眼罩2盒 28片套装', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/2_2.jpg?1534661542757\" alt=\"2_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/3_2.jpg?1534661549478\" alt=\"3_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/4_2.jpg?1534661557291\" alt=\"4_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/5_2.jpg?1534661562847\" alt=\"5_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/6_2.jpg?1534661566203\" alt=\"6_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/7_1.jpg?1534661575645\" alt=\"7_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/8_1.jpg?1534661582641\" alt=\"8_1\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '6', null, '2018-08-17 16:22:49', '2018-08-19 14:57:37', null, '60');
INSERT INTO `products` VALUES ('4', '日本进口 黛珂净化前导液 适用所有肤质', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/400_1.png', '288.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '日本进口 黛珂净化前导液 适用所有肤质', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/1_2.jpg?1534661613664\" alt=\"1_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/2_3.jpg?1534661623776\" alt=\"2_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/3_3.jpg?1534661627480\" alt=\"3_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/4_3.jpg?1534661633818\" alt=\"4_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/5_3.jpg?1534661640676\" alt=\"5_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/6_3.jpg?1534661646643\" alt=\"6_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/7_2.jpg?1534661655376\" alt=\"7_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%9B%BD%E9%99%85%E5%90%8D%E5%93%81/8_2.jpg?1534661659339\" alt=\"8_2\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '6', null, '2018-08-19 10:19:03', '2018-08-19 14:59:00', null, '50');
INSERT INTO `products` VALUES ('5', 'sana豆乳 日本畅销化妆水肤质通用', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400_2.png', '155.00', '0.00', '0.00', '18', '100', '0', '0.00', null, 'sana豆乳 日本畅销化妆水肤质通用', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/1_3.jpg?1534663036916\" alt=\"1_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/2_4.jpg?1534663042504\" alt=\"2_4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/3_4.jpg?1534663047179\" alt=\"3_4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/4_5.jpg?1534663055072\" alt=\"4_5\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '1', null, '2018-08-19 11:11:04', '2018-08-22 18:18:36', null, '30');
INSERT INTO `products` VALUES ('6', 'sana日本药妆第一品牌洗颜乳', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400_3.png', '25.00', '0.00', '0.00', '19', '100', '0', '0.00', null, 'sana日本药妆第一品牌洗颜乳', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/1_4.jpg?1534648109445\" alt=\"1_4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/2_4.jpg?1534648116127\" alt=\"2_4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/3_4.jpg?1534648124872\" alt=\"3_4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/4_5.jpg?1534648133113\" alt=\"4_5\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '1', null, '2018-08-19 11:13:54', '2018-08-22 18:18:36', null, '88');
INSERT INTO `products` VALUES ('7', '嘉宝星星泡芙草莓苹果味', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400.png', '99.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '嘉宝星星泡芙草莓苹果味', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/1.jpg?1534648548601\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/2.jpg?1534648555423\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/3.jpg?1534648559934\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/4.jpg?1534648565127\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/5.jpg?1534648571029\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/6.jpg?1534648575917\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/7.jpg?1534648582157\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/8.jpg?1534648586665\" alt=\"8\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/9.jpg?1534648592095\" alt=\"9\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/10.jpg?1534648597520\" alt=\"10\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '1', null, '2018-08-19 11:21:30', '2018-08-19 11:21:30', null, '55');
INSERT INTO `products` VALUES ('8', '泰国进口 皇家足贴', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/400_1.png', '88.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '泰国进口 皇家足贴', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/1_1.jpg?1534648698711\" alt=\"1_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/2_1.jpg?1534648736607\" alt=\"2_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/3_1.jpg?1534648745477\" alt=\"3_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/4_1.jpg?1534648754105\" alt=\"4_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/5_1.jpg?1534648760597\" alt=\"5_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/6_1.jpg?1534648770091\" alt=\"6_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/7_1.jpg?1534648779734\" alt=\"7_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/8_1.jpg?1534648787490\" alt=\"8_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/9_1.jpg?1534648791658\" alt=\"9_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/10_1.jpg?1534648796546\" alt=\"10_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B1%BD%E8%BD%A6/11.jpg?1534648801092\" alt=\"11\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '1', null, '2018-08-19 11:24:36', '2018-08-19 11:24:36', null, '100');
INSERT INTO `products` VALUES ('9', '经典配方 泰国虎牌膏药', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/400.png', '55.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '经典配方 泰国虎牌膏药', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/1.jpg?1534650606257\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/2.jpg?1534650613943\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/3.jpg?1534650623199\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/4.jpg?1534650629257\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/5.jpg?1534650633703\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/6.jpg?1534650638062\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/7.jpg?1534650642447\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/8.jpg?1534650647335\" alt=\"8\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/9.jpg?1534650651438\" alt=\"9\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/10.jpg?1534650655903\" alt=\"10\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/11.jpg?1534650659812\" alt=\"11\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '3', null, '2018-08-19 11:55:35', '2018-08-19 11:55:35', null, '20');
INSERT INTO `products` VALUES ('10', '日本进口 久光贴 一袋7片装', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/400_1.png', '66.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '日本进口 久光贴 一袋7片装', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/1_1.jpg?1534650750040\" alt=\"1_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/2_1.jpg?1534650756251\" alt=\"2_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/3_1.jpg?1534650762162\" alt=\"3_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/4_1.jpg?1534650768526\" alt=\"4_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/5_1.jpg?1534650773015\" alt=\"5_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/6_1.jpg?1534650779900\" alt=\"6_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%88%BF%E4%BA%A7%E7%BD%AE%E4%B8%9A/7_1.jpg?1534650787070\" alt=\"7_1\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '3', null, '2018-08-19 11:57:41', '2018-08-19 11:57:41', null, '33');
INSERT INTO `products` VALUES ('11', '童年时光小金豆DHA', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/400.png', '128.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '童年时光小金豆DHA', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/6.jpg?1534657334136\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/1.jpg?1534657305141\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/5.jpg?1534657327839\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/2.jpg?1534657309523\" alt=\"2\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '14', null, '2018-08-19 13:47:16', '2018-08-19 13:47:16', null, '88');
INSERT INTO `products` VALUES ('12', '童年时光钙镁锌', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/400_1.png', '188.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '童年时光钙镁锌', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/1_1.jpg?1534657540386\" alt=\"1_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/2.jpg?1534657556491\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/4_1.jpg?1534657563443\" alt=\"4_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/5_1.jpg?1534657568143\" alt=\"5_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/6.jpg?1534657576056\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/7.jpg?1534657581180\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/8.jpg?1534657586646\" alt=\"8\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/9.jpg?1534657590623\" alt=\"9\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '13', null, '2018-08-19 13:51:08', '2018-08-19 13:51:08', null, '50');
INSERT INTO `products` VALUES ('13', '和光堂植物性爽身粉', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/6404.png', '88.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '和光堂植物性爽身粉', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/1_2.jpg?1534658082929\" alt=\"1_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/2_2.jpg?1534658141466\" alt=\"2_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/3_2.jpg?1534658150098\" alt=\"3_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/4_2.jpg?1534658160662\" alt=\"4_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/5_2.jpg?1534658164614\" alt=\"5_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/6_2.jpg?1534658169645\" alt=\"6_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/7_2.jpg?1534658174217\" alt=\"7_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/8_2.jpg?1534658351329\" alt=\"8_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E9%BB%84%E9%87%91%E7%8F%A0%E5%AE%9D/10_2.jpg?1534658363301\" alt=\"10_2\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '12', null, '2018-08-19 14:04:10', '2018-08-19 14:04:10', null, '20');
INSERT INTO `products` VALUES ('14', '日本进口安耐晒防晒喷雾', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/400.png', '129.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '日本进口安耐晒防晒喷雾', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/1.jpg?1534658622698\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/2.jpg?1534658630501\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/3.jpg?1534658635272\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/4.jpg?1534658638856\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/5.jpg?1534658643899\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/6.jpg?1534658647328\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/7.jpg?1534658652929\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/8.jpg?1534658656148\" alt=\"8\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/9.jpg?1534658661384\" alt=\"9\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/10.jpg?1534658665379\" alt=\"10\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/11.jpg?1534658668962\" alt=\"11\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '19', null, '2018-08-19 14:09:06', '2018-08-19 14:09:06', null, '55');
INSERT INTO `products` VALUES ('15', 'RAY超薄蚕丝RAY面膜', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/400_1.png', '55.00', '0.00', '0.00', '20', '100', '0', '0.00', null, 'RAY超薄蚕丝RAY面膜', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/1_1.jpg?1534658788719\" alt=\"1_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/2_1.jpg?1534658797172\" alt=\"2_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/3_1.jpg?1534658806929\" alt=\"3_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/4_1.jpg?1534658814466\" alt=\"4_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/5_1.jpg?1534658819486\" alt=\"5_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/6_1.jpg?1534658827771\" alt=\"6_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/7_1.jpg?1534658834481\" alt=\"7_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/9_1.jpg?1534658847119\" alt=\"9_1\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '18', null, '2018-08-19 14:12:01', '2018-08-19 14:12:01', null, '15');
INSERT INTO `products` VALUES ('16', 'ROHTO乐敦美白淡斑精华液', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/400_2.png', '880.00', '0.00', '0.00', '20', '100', '0', '0.00', null, 'ROHTO乐敦美白淡斑精华液', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/1_2.jpg?1534659038911\" alt=\"1_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/2_2.jpg?1534659047087\" alt=\"2_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/3.jpg?1534659051307\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/4.jpg?1534659056351\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%B9%BF%E5%91%8A%E5%AA%92%E4%BD%93/5_2.jpg?1534659063602\" alt=\"5_2\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '2', null, '2018-08-19 14:15:39', '2018-08-19 15:26:16', null, '300');
INSERT INTO `products` VALUES ('17', 'FANCL纳米卸妆油', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/400.png', '260.00', '0.00', '0.00', '20', '100', '0', '0.00', null, 'FANCL纳米卸妆油', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/1.jpg?1534659253195\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/2.jpg?1534659261847\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/3.jpg?1534659265176\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/4.jpg?1534659268669\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/5.jpg?1534659272308\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/6.jpg?1534659276111\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/7.jpg?1534659280103\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/8.jpg?1534659283799\" alt=\"8\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/9.jpg?1534659287426\" alt=\"9\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '29', null, '2018-08-19 14:19:21', '2018-08-19 14:19:21', null, '60');
INSERT INTO `products` VALUES ('18', '黛珂平衡水油 牛油果乳液', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/400_1.png', '280.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '黛珂平衡水油 牛油果乳液', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/1_1.jpg?1534659396117\" alt=\"1_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/2_1.jpg?1534659404310\" alt=\"2_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/3_1.jpg?1534659413156\" alt=\"3_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/4_1.jpg?1534659419953\" alt=\"4_1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/5_1.jpg?1534659423696\" alt=\"5_1\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '23', null, '2018-08-19 14:21:38', '2018-08-19 14:21:38', null, '66');
INSERT INTO `products` VALUES ('19', '黑龙堂深层卸妆油', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/400_2.png', '288.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '黑龙堂深层卸妆油', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/1_2.jpg?1534659571585\" alt=\"1_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/2_2.jpg?1534659578006\" alt=\"2_2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/3_2.jpg?1534659584732\" alt=\"3_2\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '22', null, '2018-08-19 14:24:19', '2018-08-19 14:24:19', null, '60');
INSERT INTO `products` VALUES ('20', '多效合一净透洗颜乳', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/400_3.png', '59.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '多效合一净透洗颜乳', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/1_3.jpg?1534659976188\" alt=\"1_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/2_3.jpg?1534659991435\" alt=\"2_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/3_3.jpg?1534659995107\" alt=\"3_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/4_3.jpg?1534660001561\" alt=\"4_3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E5%BB%BA%E6%9D%90%E5%AE%B6%E5%B1%85/5_2.jpg?1534660011754\" alt=\"5_2\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '25', null, '2018-08-19 14:31:26', '2018-08-19 14:31:26', null, '30');
INSERT INTO `products` VALUES ('21', '狮王原装牙刷面包超人宝宝', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B6%88%E8%B4%B9%E5%8D%A1%E5%8C%BA/400.png', '28.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '狮王原装牙刷面包超人宝宝', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B6%88%E8%B4%B9%E5%8D%A1%E5%8C%BA/1.jpg?1534660189886\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B6%88%E8%B4%B9%E5%8D%A1%E5%8C%BA/2.jpg?1534660193521\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B6%88%E8%B4%B9%E5%8D%A1%E5%8C%BA/3.jpg?1534660197021\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B6%88%E8%B4%B9%E5%8D%A1%E5%8C%BA/4.jpg?1534660200162\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E6%B6%88%E8%B4%B9%E5%8D%A1%E5%8C%BA/5.jpg?1534660205022\" alt=\"5\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '8', null, '2018-08-19 14:35:07', '2018-09-05 14:46:04', null, '16');
INSERT INTO `products` VALUES ('22', '婴儿肌玻尿酸高保湿面膜', null, 'http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/400(1).jpg', '58.00', '0.00', '0.00', '20', '100', '0', '0.00', null, '婴儿肌玻尿酸高保湿面膜', '<p><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/1.jpg?1534660363647\" alt=\"1\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/2.jpg?1534660369282\" alt=\"2\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/3.jpg?1534660373064\" alt=\"3\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/4.jpg?1534660376778\" alt=\"4\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/5.jpg?1534660381823\" alt=\"5\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/6.jpg?1534660385754\" alt=\"6\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/7.jpg?1534660390808\" alt=\"7\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/8.jpg?1534660394121\" alt=\"8\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/9.jpg?1534660399556\" alt=\"9\" /><img src=\"http://yibei.wiswebs.com/uploads/%E5%95%86%E5%93%81/%E4%BC%81%E4%B8%9A%E5%BA%97%E9%93%BA/10.jpg?1534660405571\" alt=\"10\" /></p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '17', null, '2018-08-19 14:37:59', '2018-08-19 15:13:03', null, '20');
INSERT INTO `products` VALUES ('23', '宝马640i', null, 'http://yibei.wiswebs.com/uploads/%E5%AE%9D%E9%A9%AC/6_series_gran_coupe_2011.png', '878000.00', '878000.00', '0.00', '20', '100', '0', '0.00', null, '6系四门轿跑车', '<p>6系四门轿跑车</p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '2', null, '2018-08-19 14:40:18', '2018-09-07 14:51:42', null, '0');
INSERT INTO `products` VALUES ('24', '新BMW530Li尊享型豪华套装', null, 'http://yibei.wiswebs.com/uploads/%E5%AE%9D%E9%A9%AC/5_series_li_2017.png', '519900.00', '519900.00', '0.00', '20', '100', '0', '0.00', null, '新BMW 5系四门轿车', '<p>新BMW 5系四门轿车</p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '2', null, '2018-08-19 14:43:14', '2018-09-07 14:48:02', null, '0');
INSERT INTO `products` VALUES ('25', '2018款BMW 330i XDrive M运动款', null, 'http://yibei.wiswebs.com/uploads/%E5%AE%9D%E9%A9%AC/3_series_sedan_n.png', '469800.00', '469800.00', '0.00', '20', '100', '0', '0.00', null, '宝马3系GT', '<p>宝马3系GT</p>', null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '2', null, '2018-08-19 14:46:16', '2018-09-07 14:40:43', null, '0');
INSERT INTO `products` VALUES ('26', '易呗', null, null, '11.00', '0.00', '0.00', '20', '100', '0', '0.00', null, null, null, null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '0', null, '2018-09-03 18:22:01', '2018-09-03 18:22:01', null, '0');
INSERT INTO `products` VALUES ('27', '易呗', null, null, '11.00', '0.00', '0.00', '20', '100', '0', '0.00', null, null, null, null, '0', null, '0', null, null, '1', '0', '0', '0', '1', '1', '0', '0', '0', '0.00', null, null, '', null, null, '0', null, '2018-09-03 18:22:11', '2018-09-03 18:22:11', null, '0');

-- ----------------------------
-- Table structure for project_images
-- ----------------------------
DROP TABLE IF EXISTS `project_images`;
CREATE TABLE `project_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片链接',
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_images_id_created_at_index` (`id`,`created_at`),
  KEY `project_images_project_id_index` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_images
-- ----------------------------

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '项目名称',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号',
  `weixin_qq` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '微信/qq',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '项目地址',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '具体信息',
  `jindu` double DEFAULT NULL COMMENT '经度',
  `weidu` double DEFAULT NULL COMMENT '纬度',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of projects
-- ----------------------------

-- ----------------------------
-- Table structure for refund_logs
-- ----------------------------
DROP TABLE IF EXISTS `refund_logs`;
CREATE TABLE `refund_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_refund_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `refund_logs_id_created_at_index` (`id`,`created_at`),
  KEY `refund_logs_order_refund_id_index` (`order_refund_id`),
  CONSTRAINT `refund_logs_order_refund_id_foreign` FOREIGN KEY (`order_refund_id`) REFERENCES `order_refunds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of refund_logs
-- ----------------------------

-- ----------------------------
-- Table structure for refund_moneys
-- ----------------------------
DROP TABLE IF EXISTS `refund_moneys`;
CREATE TABLE `refund_moneys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `snumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商户订单号',
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '平台订单号',
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付方式',
  `total_fee` double(8,2) NOT NULL COMMENT '订单总金额',
  `snumber_refund` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '退款订单号',
  `refund_fee` double(8,2) NOT NULL COMMENT '退款金额',
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '退款原因',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '退款状态',
  `last_query` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后查询状态时间',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `order_type` enum('取消订单','售后退款') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '退款记录生成的来源',
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `refund_moneys_id_created_at_index` (`id`,`created_at`),
  KEY `refund_moneys_order_id_index` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of refund_moneys
-- ----------------------------

-- ----------------------------
-- Table structure for role_admin
-- ----------------------------
DROP TABLE IF EXISTS `role_admin`;
CREATE TABLE `role_admin` (
  `admin_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`,`role_id`),
  KEY `role_admin_role_id_foreign` (`role_id`),
  CONSTRAINT `role_admin_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_admin_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_admin
-- ----------------------------
INSERT INTO `role_admin` VALUES ('1', '1');
INSERT INTO `role_admin` VALUES ('3', '3');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  KEY `roles_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '超级管理员', '超级管理员', '拥有最高权限，能控制一切', '2018-08-17 11:47:05', '2018-08-17 11:47:05');
INSERT INTO `roles` VALUES ('2', '企业管理员', null, '仅能管理店铺和店铺分类', '2018-09-03 17:56:46', '2018-09-03 17:57:04');
INSERT INTO `roles` VALUES ('3', '分店管理员', null, '管理分店的商品', '2018-09-04 17:16:16', '2018-09-04 17:16:16');

-- ----------------------------
-- Table structure for rules
-- ----------------------------
DROP TABLE IF EXISTS `rules`;
CREATE TABLE `rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 新用户注册 1 购物满送 2 推荐新用户注册 3 推荐新用户下单 4 免费领取',
  `base` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '购物满金额',
  `time_begin` date NOT NULL DEFAULT '1970-01-01' COMMENT '有效期开始时间',
  `time_end` date NOT NULL DEFAULT '1970-01-01' COMMENT '有效期结束时间',
  `max_count` int(11) NOT NULL DEFAULT '0' COMMENT '最大发放次数',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT '已经发放次数',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rules_id_created_at_index` (`id`,`created_at`),
  KEY `rules_time_begin_index` (`time_begin`),
  KEY `rules_time_end_index` (`time_end`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rules
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '属性名称',
  `value` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '属性值',
  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '属性分组',
  `des` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '属性描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('2', 'name', '易呗商城', 'basic', '店铺名称', '2018-08-17 11:47:06', '2018-08-31 14:28:15', null);
INSERT INTO `settings` VALUES ('3', 'icp', '', 'basic', 'ICP备案信息', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('4', 'logo', null, 'basic', 'LOGO', '2018-08-17 11:47:06', '2018-08-31 14:28:15', null);
INSERT INTO `settings` VALUES ('5', 'seo_title', '', 'basic', '网站标题', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('6', 'seo_des', '', 'basic', '网站描述', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('7', 'seo_keywords', '', 'basic', '网站关键字', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('8', 'service_tel', null, 'basic', '服务电话', '2018-08-17 11:47:06', '2018-08-31 14:28:15', null);
INSERT INTO `settings` VALUES ('9', 'weixin', null, 'basic', '微信公众号', '2018-08-17 11:47:06', '2018-08-31 14:28:15', null);
INSERT INTO `settings` VALUES ('10', 'inventory_default', '20', 'basic', '默认库存', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('11', 'inventory_warn', '3', 'basic', '库存预警数', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('12', 'freight_free_limit', '0', 'basic', '全场满多少免运费', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('13', 'withdraw_limit', '1', 'basic', '满多少才能提现', '2018-08-17 11:47:06', '2018-08-27 16:52:34', null);
INSERT INTO `settings` VALUES ('14', 'withdraw_min', '1', 'basic', '最少提现额度', '2018-08-17 11:47:06', '2018-08-27 16:52:34', null);
INSERT INTO `settings` VALUES ('15', 'withdraw_day_max_num', '3', 'basic', '单日最多提现多少次', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('16', 'share_qrcode_img', '', 'basic', '分享二维码底图', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('17', 'account_bind', '否', 'basic', '第三方登录，需绑定账号', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('18', 'sms_platform', '阿里云', 'sms', '短信平台', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('19', 'sms_appkey', '', 'sms', '短信平台[appkey]', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('20', 'sms_secretKey', '', 'sms', '短信平台[secretKey]', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('21', 'sms_send_register', '否', 'sms', '用户注册时是否发送短信', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('22', 'sms_send_password', '否', 'sms', '用户找回密码时是否发送短信', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('23', 'sms_send_account_check', '否', 'sms', '身份验证时是否发送短信', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('24', 'sms_send_order', '否', 'sms', '用户下单时是否发送短信给商家', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('25', 'sms_send_pay', '否', 'sms', '客户支付时是否发短信给商家', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('26', 'sms_send_deliver', '否', 'sms', '商家发货时是否给客户发短信', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('27', 'credits_alias', '货呗', 'credits', '积分别名', '2018-08-17 11:47:06', '2018-08-19 15:20:09', null);
INSERT INTO `settings` VALUES ('28', 'register_credits', '0', 'credits', '注册赠送积分', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('29', 'invite_credits', '0', 'credits', '邀请人获赠积分', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('30', 'credits_switch', '否', 'credits', '积分抵扣开关', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('31', 'credits_min', '100', 'credits', '最低使用积分条件', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('32', 'credits_max', '10', 'credits', '最高抵扣比率%', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('33', 'consume_credits', '0', 'credits', '购物送积分比例', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('34', 'credits_rate', '10', 'credits', '1元能兑换多少积分', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('35', 'auto_complete', '7', 'order', '自动确认收货时间', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('36', 'after_sale_time', '15', 'order', '多少天内可申请售后', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('37', 'inventory_consume', '支付成功', 'order', '减库存的时机  下单成功  支付成功', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('38', 'user_level_switch', '不开启', 'order', '开启 不开启 是否开启会员等级功能，不同的会员等级可以享受不同的折扣', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('39', 'order_expire_time', null, 'order', '订单支付超时时间(单位为分钟，0表示永不过期)', '2018-08-17 11:47:06', '2018-08-21 09:40:34', null);
INSERT INTO `settings` VALUES ('40', 'distribution', '否', 'distribution', '是否开启分销 ', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('41', 'distribution_condition', '管理员开启', 'distribution', '成为分销者的方式 注册用户 购买商品 管理员开启', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('42', 'distribution_type', '订单', 'distribution', '按\"商品\"提成  按\"订单\"金额提成', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('43', 'distribution_percent', '0', 'distribution', '订单金额提成比例', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('44', 'distribution_selft', '0', 'distribution', '购买者提成点', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('45', 'distribution_level1_name', '一级分销商', 'distribution', '一级分销商名称', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('46', 'distribution_level1_percent', '0', 'distribution', '一级分销商提成比例', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('47', 'distribution_level2_name', '二级分销商', 'distribution', '二级分销商名称', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('48', 'distribution_level2_percent', '0', 'distribution', '二级分销商提成比例', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('49', 'distribution_level3_name', '三级分销商', 'distribution', '三级分销商名称', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('50', 'distribution_level3_percent', '0', 'distribution', '三级分销商提成比例', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('51', 'feie_sn', '', 'printer', '飞蛾小票打印机SN', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('52', 'feie_user', '', 'printer', '飞蛾小票打印机USER', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('53', 'feie_ukey', '', 'printer', '飞蛾小票打印机UKEY', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('54', 'records_per_page', '10', 'other', '每页显示信息条目', '2018-08-17 11:47:06', '2018-09-04 09:21:09', null);
INSERT INTO `settings` VALUES ('55', 'category_level', '3', 'other', '分类信息等级数', '2018-08-17 11:47:06', '2018-08-17 11:47:06', null);
INSERT INTO `settings` VALUES ('56', 'theme', 'jifen', '', '', '2018-08-17 11:47:25', '2018-08-17 15:26:35', null);
INSERT INTO `settings` VALUES ('57', 'FUNC_BRAND', '0', '', '', '2018-08-17 11:47:25', '2018-08-17 14:58:10', null);
INSERT INTO `settings` VALUES ('58', 'FUNC_PRODUCT_PROMP', '0', '', '', '2018-08-17 11:47:25', '2018-08-17 14:58:10', null);
INSERT INTO `settings` VALUES ('59', 'FUNC_TEAMSALE', '0', '', '', '2018-08-17 11:47:25', '2018-08-17 14:58:10', null);
INSERT INTO `settings` VALUES ('60', 'FUNC_FLASHSALE', '0', '', '', '2018-08-17 11:47:25', '2018-08-17 14:58:10', null);
INSERT INTO `settings` VALUES ('61', 'FUNC_COUPON', '0', '', '', '2018-08-17 11:47:25', '2018-08-17 14:58:10', null);
INSERT INTO `settings` VALUES ('62', 'FUNC_FOOTER', '1', '', '', '2018-08-17 11:47:25', '2018-08-17 13:38:54', null);
INSERT INTO `settings` VALUES ('63', 'theme_main_color', '', '', '', '2018-08-17 11:47:25', '2018-08-17 11:47:25', null);
INSERT INTO `settings` VALUES ('64', 'theme_second_color', '', '', '', '2018-08-17 11:47:25', '2018-08-17 11:47:25', null);
INSERT INTO `settings` VALUES ('65', 'FUNC_MEMBER_LEVEL', '1', '', '', '2018-08-17 11:53:31', '2018-08-17 13:38:47', null);
INSERT INTO `settings` VALUES ('66', 'FUNC_AFTERSALE', '1', '', '', '2018-08-17 11:53:31', '2018-08-17 13:38:47', null);
INSERT INTO `settings` VALUES ('67', 'FUNC_CREDITS', '1', '', '', '2018-08-17 11:53:31', '2018-08-17 13:38:46', null);
INSERT INTO `settings` VALUES ('68', 'FUNC_FUNDS', '1', '', '', '2018-08-17 11:53:31', '2018-08-17 13:38:47', null);
INSERT INTO `settings` VALUES ('69', 'FUNC_CASH_WITHDRWA', '1', '', '', '2018-08-17 11:53:31', '2018-08-17 13:38:46', null);
INSERT INTO `settings` VALUES ('70', 'FUNC_COLLECT', '', '', '', '2018-08-17 11:53:31', '2018-08-17 11:53:31', null);
INSERT INTO `settings` VALUES ('71', 'FUNC_DISTRIBUTION', '0', '', '', '2018-08-17 11:53:31', '2018-08-17 14:30:37', null);
INSERT INTO `settings` VALUES ('72', 'FUNC_ORDER_PROMP', '0', '', '', '2018-08-17 13:38:29', '2018-08-17 14:58:10', null);
INSERT INTO `settings` VALUES ('73', 'image_new', '', '', '', '2018-08-17 13:38:31', '2018-08-17 13:38:31', null);
INSERT INTO `settings` VALUES ('74', 'image_prmop', '', '', '', '2018-08-17 13:38:32', '2018-08-17 13:38:32', null);
INSERT INTO `settings` VALUES ('75', 'image_sales_count', '', '', '', '2018-08-17 13:38:32', '2018-08-17 13:38:32', null);
INSERT INTO `settings` VALUES ('76', 'sms_sign', '', '', '', '2018-08-17 13:38:32', '2018-08-17 13:38:32', null);
INSERT INTO `settings` VALUES ('77', 'sms_vevify_template', '', '', '', '2018-08-17 13:38:32', '2018-08-17 13:38:32', null);
INSERT INTO `settings` VALUES ('78', 'sms_notify_template', '', '', '', '2018-08-17 13:38:32', '2018-08-17 13:38:32', null);
INSERT INTO `settings` VALUES ('79', 'email', null, '', '', '2018-08-17 13:38:32', '2018-08-21 19:27:07', null);
INSERT INTO `settings` VALUES ('80', 'FUNC_FAPIAO', '1', '', '', '2018-08-17 13:38:38', '2018-08-17 13:38:53', null);
INSERT INTO `settings` VALUES ('81', 'FUNC_YUNLIKE', '1', '', '', '2018-08-17 13:38:38', '2018-08-17 13:38:53', null);
INSERT INTO `settings` VALUES ('82', 'FUNC_WECHATPAY', '1', '', '', '2018-08-17 13:38:38', '2018-08-17 13:38:53', null);
INSERT INTO `settings` VALUES ('83', 'AUTH_CERTS', '1', '', '', '2018-08-17 13:38:38', '2018-08-17 13:38:53', null);
INSERT INTO `settings` VALUES ('84', 'CARD_CODE', '', '', '', '2018-08-20 15:10:43', '2018-08-20 15:10:43', null);
INSERT INTO `settings` VALUES ('85', 'CARD_NUM', '8', '', '', '2018-08-20 16:36:29', '2018-08-23 11:58:21', null);
INSERT INTO `settings` VALUES ('86', 'send_credits_bili', '5', '', '', '2018-08-20 18:12:43', '2018-08-27 14:23:06', null);
INSERT INTO `settings` VALUES ('87', 'send_credits_info', '注：需支付转赠金额1%的呗壳，请保证呗壳金额充足', '', '', '2018-08-20 18:12:43', '2018-08-21 09:37:09', null);
INSERT INTO `settings` VALUES ('88', 'withdraw_bili', '0', '', '', '2018-08-21 09:20:47', '2018-08-27 16:52:53', null);
INSERT INTO `settings` VALUES ('89', 'withdraw_bili_info', '注：需支付提现金额1%的手续费', '', '', '2018-08-21 09:20:47', '2018-08-21 09:40:34', null);
INSERT INTO `settings` VALUES ('90', 'send_credits_min_num', null, '', '', '2018-08-24 08:58:26', '2018-08-27 14:23:06', null);
INSERT INTO `settings` VALUES ('91', 'near_shop_distance', null, '', '', '2018-08-24 17:14:05', '2018-08-31 14:28:15', null);
INSERT INTO `settings` VALUES ('92', 'FUNC_MANY_SHOP', '1', '', '', '2018-09-04 17:15:44', '2018-09-04 17:16:40', null);

-- ----------------------------
-- Table structure for singel_pages
-- ----------------------------
DROP TABLE IF EXISTS `singel_pages`;
CREATE TABLE `singel_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '别名',
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '正文',
  `view` int(11) DEFAULT '1' COMMENT '浏览量',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `singel_pages_id_created_at_index` (`id`,`created_at`),
  KEY `singel_pages_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of singel_pages
-- ----------------------------
INSERT INTO `singel_pages` VALUES ('1', '关注我们', 'weixin', null, '1', '2018-08-17 11:47:21', '2018-08-17 11:47:21', null);
INSERT INTO `singel_pages` VALUES ('2', '店铺信息', 'shopinfo', null, '1', '2018-08-17 11:47:21', '2018-08-17 11:47:21', null);

-- ----------------------------
-- Table structure for spec_items
-- ----------------------------
DROP TABLE IF EXISTS `spec_items`;
CREATE TABLE `spec_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规格条目名称',
  `spec_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spec_items_id_created_at_index` (`id`,`created_at`),
  KEY `spec_items_spec_id_index` (`spec_id`),
  CONSTRAINT `spec_items_spec_id_foreign` FOREIGN KEY (`spec_id`) REFERENCES `specs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of spec_items
-- ----------------------------

-- ----------------------------
-- Table structure for spec_product_prices
-- ----------------------------
DROP TABLE IF EXISTS `spec_product_prices`;
CREATE TABLE `spec_product_prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `inventory` int(11) NOT NULL DEFAULT '0',
  `qrcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '二维码',
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '规格图片',
  `prom_id` int(11) DEFAULT NULL COMMENT '促销ID',
  `prom_type` int(11) DEFAULT NULL COMMENT '促销类型',
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `jifen` int(11) DEFAULT '0' COMMENT '购物所需积分',
  PRIMARY KEY (`id`),
  KEY `spec_product_prices_id_created_at_index` (`id`,`created_at`),
  KEY `spec_product_prices_product_id_index` (`product_id`),
  CONSTRAINT `spec_product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of spec_product_prices
-- ----------------------------

-- ----------------------------
-- Table structure for specs
-- ----------------------------
DROP TABLE IF EXISTS `specs`;
CREATE TABLE `specs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规格名称',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `type_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specs_id_created_at_index` (`id`,`created_at`),
  KEY `specs_type_id_index` (`type_id`),
  KEY `specs_sort_index` (`sort`),
  CONSTRAINT `specs_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of specs
-- ----------------------------

-- ----------------------------
-- Table structure for stores
-- ----------------------------
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店铺名称',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店铺图片',
  `jindu` double NOT NULL COMMENT '店铺经度',
  `weidu` double NOT NULL COMMENT '店铺纬度',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店铺地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stores_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stores
-- ----------------------------
INSERT INTO `stores` VALUES ('1', '奔驰梅赛德斯', 'http://yibei.wiswebs.com/uploads/%E5%A5%94%E9%A9%B0/timg123.jpg', '114.24613', '30.629789', '武汉星威汽车销售服务有限公司', '2018-08-17 16:11:58', '2018-09-07 15:23:29', null);
INSERT INTO `stores` VALUES ('2', '爱迪尔珠宝', 'http://yibei.wiswebs.com/uploads/59b9fce67311c.jpg', '114.293673', '30.582118', '武汉中山大道库玛华中珠宝三楼', '2018-08-19 11:01:34', '2018-09-06 14:13:43', null);
INSERT INTO `stores` VALUES ('3', '路虎汽车', 'http://yibei.wiswebs.com/uploads/%E8%B7%AF%E8%99%8E/%E6%9C%AA%E6%A0%87%E9%A2%98-1.jpg', '114.3162', '30.581084', '武汉库玛华中珠宝交易中心三楼', '2018-09-06 15:25:11', '2018-09-07 15:06:03', null);
INSERT INTO `stores` VALUES ('4', '宝马汽车', 'http://yibei.wiswebs.com/uploads/%E5%AE%9D%E9%A9%AC/timg3.jpg', '114.3162', '30.581084', '武汉库玛华中珠宝交易中心三楼', '2018-09-06 15:29:05', '2018-09-07 15:01:34', null);
INSERT INTO `stores` VALUES ('5', '捷豹汽车', 'http://yibei.wiswebs.com/uploads/%E6%8D%B7%E8%B1%B9/3844758_210918063385_2%E5%89%AF%E6%9C%AC.jpg', '114.3162', '30.581084', '武汉库玛华中珠宝交易中心三楼', '2018-09-06 15:30:13', '2018-09-07 15:15:40', null);
INSERT INTO `stores` VALUES ('6', '太子酒店', null, '114.3162', '30.581084', '武汉库玛华中珠宝交易中心三楼', '2018-09-06 15:31:22', '2018-09-07 10:29:31', '2018-09-07 10:29:31');

-- ----------------------------
-- Table structure for stores_cats
-- ----------------------------
DROP TABLE IF EXISTS `stores_cats`;
CREATE TABLE `stores_cats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stores_cats_store_id_foreign` (`store_id`),
  KEY `stores_cats_cat_id_foreign` (`cat_id`),
  KEY `stores_cats_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `stores_cats_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `cats` (`id`),
  CONSTRAINT `stores_cats_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stores_cats
-- ----------------------------

-- ----------------------------
-- Table structure for stores_products
-- ----------------------------
DROP TABLE IF EXISTS `stores_products`;
CREATE TABLE `stores_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stores_products_store_id_foreign` (`store_id`),
  KEY `stores_products_product_id_foreign` (`product_id`),
  KEY `stores_products_id_created_at_index` (`id`,`created_at`),
  CONSTRAINT `stores_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `stores_products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stores_products
-- ----------------------------
INSERT INTO `stores_products` VALUES ('1', '1', '1', null, null, null);
INSERT INTO `stores_products` VALUES ('2', '1', '2', null, null, null);
INSERT INTO `stores_products` VALUES ('3', '1', '3', null, null, null);
INSERT INTO `stores_products` VALUES ('4', '1', '4', null, null, null);
INSERT INTO `stores_products` VALUES ('5', '2', '5', null, null, null);
INSERT INTO `stores_products` VALUES ('6', '2', '6', null, null, null);
INSERT INTO `stores_products` VALUES ('7', '2', '7', null, null, null);
INSERT INTO `stores_products` VALUES ('8', '2', '8', null, null, null);
INSERT INTO `stores_products` VALUES ('9', '2', '9', null, null, null);
INSERT INTO `stores_products` VALUES ('10', '2', '10', null, null, null);
INSERT INTO `stores_products` VALUES ('11', '2', '11', null, null, null);
INSERT INTO `stores_products` VALUES ('12', '2', '12', null, null, null);
INSERT INTO `stores_products` VALUES ('13', '2', '13', null, null, null);
INSERT INTO `stores_products` VALUES ('14', '2', '14', null, null, null);
INSERT INTO `stores_products` VALUES ('15', '2', '15', null, null, null);
INSERT INTO `stores_products` VALUES ('16', '2', '16', null, null, null);
INSERT INTO `stores_products` VALUES ('17', '2', '17', null, null, null);
INSERT INTO `stores_products` VALUES ('18', '2', '18', null, null, null);
INSERT INTO `stores_products` VALUES ('19', '2', '19', null, null, null);
INSERT INTO `stores_products` VALUES ('20', '2', '20', null, null, null);
INSERT INTO `stores_products` VALUES ('21', '2', '21', null, null, null);
INSERT INTO `stores_products` VALUES ('22', '2', '22', null, null, null);
INSERT INTO `stores_products` VALUES ('26', '4', '25', null, null, null);
INSERT INTO `stores_products` VALUES ('27', '4', '24', null, null, null);
INSERT INTO `stores_products` VALUES ('28', '4', '23', null, null, null);

-- ----------------------------
-- Table structure for team_follows
-- ----------------------------
DROP TABLE IF EXISTS `team_follows`;
CREATE TABLE `team_follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户昵称',
  `head_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户头像',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '参团状态0:待拼单(表示已下单但是未支付)1拼单成功(已支付)2成团成功3成团失败',
  `is_winner` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否中奖',
  `user_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `found_id` int(10) unsigned NOT NULL,
  `found_user_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_follows_id_created_at_index` (`id`,`created_at`),
  KEY `team_follows_user_id_index` (`user_id`),
  KEY `team_follows_team_id_index` (`team_id`),
  KEY `team_follows_found_user_id_index` (`found_user_id`),
  KEY `team_follows_found_id_index` (`found_id`),
  KEY `team_follows_order_id_index` (`order_id`),
  CONSTRAINT `team_follows_found_id_foreign` FOREIGN KEY (`found_id`) REFERENCES `team_founds` (`id`),
  CONSTRAINT `team_follows_found_user_id_foreign` FOREIGN KEY (`found_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `team_follows_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `team_follows_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `team_sales` (`id`),
  CONSTRAINT `team_follows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of team_follows
-- ----------------------------

-- ----------------------------
-- Table structure for team_founds
-- ----------------------------
DROP TABLE IF EXISTS `team_founds`;
CREATE TABLE `team_founds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time_begin` timestamp NULL DEFAULT NULL COMMENT '开团时间',
  `time_end` timestamp NULL DEFAULT NULL COMMENT '结束时间',
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户昵称',
  `head_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户头像',
  `join_num` int(11) NOT NULL COMMENT '已拼人数',
  `need_mem` int(11) NOT NULL COMMENT '成团人数',
  `price` decimal(10,2) NOT NULL COMMENT '拼团价格',
  `origin_price` decimal(10,2) DEFAULT NULL COMMENT '原本价格',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '拼团状态0:待开团(表示已下单但是未支付)1:已经开团(团长已支付)2:拼团成功,3拼团失败',
  `user_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_founds_id_created_at_index` (`id`,`created_at`),
  KEY `team_founds_user_id_index` (`user_id`),
  KEY `team_founds_team_id_index` (`team_id`),
  KEY `team_founds_order_id_index` (`order_id`),
  CONSTRAINT `team_founds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `team_founds_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `team_sales` (`id`),
  CONSTRAINT `team_founds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of team_founds
-- ----------------------------

-- ----------------------------
-- Table structure for team_lotteries
-- ----------------------------
DROP TABLE IF EXISTS `team_lotteries`;
CREATE TABLE `team_lotteries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户昵称',
  `head_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户头像',
  `user_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_lotteries_id_created_at_index` (`id`,`created_at`),
  KEY `team_lotteries_user_id_index` (`user_id`),
  KEY `team_lotteries_team_id_index` (`team_id`),
  KEY `team_lotteries_order_id_index` (`order_id`),
  CONSTRAINT `team_lotteries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `team_lotteries_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `team_sales` (`id`),
  CONSTRAINT `team_lotteries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of team_lotteries
-- ----------------------------

-- ----------------------------
-- Table structure for team_sales
-- ----------------------------
DROP TABLE IF EXISTS `team_sales`;
CREATE TABLE `team_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活动名称',
  `type` tinyint(4) NOT NULL COMMENT '类型 0分享团 1佣金团 2抽奖团',
  `expire_hour` int(11) NOT NULL COMMENT '开团后过期时间 单位小时',
  `price` double(8,2) NOT NULL COMMENT '销售价格',
  `member` int(11) NOT NULL COMMENT '成团人数',
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `bonus` double(8,2) DEFAULT '0.00' COMMENT '团长佣金',
  `lottery_count` int(11) DEFAULT '1' COMMENT '中奖人数',
  `buy_limit` int(11) NOT NULL DEFAULT '1' COMMENT '限购数量',
  `sales_sum` int(11) DEFAULT '0' COMMENT '已拼数量',
  `sales_sum_base` int(11) DEFAULT '0' COMMENT '已拼数量虚假基数',
  `sort` int(11) DEFAULT '50' COMMENT '排序',
  `share_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '分享标题',
  `share_des` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '分享描述',
  `share_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '分享图片',
  `shelf` tinyint(4) DEFAULT '1' COMMENT '上架 0不上架 1上架',
  `origin_price` double(8,2) DEFAULT NULL COMMENT '商品原价',
  `spec_id` int(10) unsigned DEFAULT '0',
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_sales_id_created_at_index` (`id`,`created_at`),
  KEY `team_sales_product_id_index` (`product_id`),
  KEY `team_sales_spec_id_index` (`spec_id`),
  KEY `team_sales_sort_index` (`sort`),
  CONSTRAINT `team_sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of team_sales
-- ----------------------------

-- ----------------------------
-- Table structure for themes
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '专题名称',
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '封面图片',
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '专题介绍',
  `intro` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '专题图文详情',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `themes_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of themes
-- ----------------------------

-- ----------------------------
-- Table structure for user_levels
-- ----------------------------
DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE `user_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户等级',
  `amount` int(11) NOT NULL COMMENT '需达到消费金额',
  `discount` int(11) NOT NULL COMMENT '享受折扣',
  `discribe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_levels_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_levels
-- ----------------------------
INSERT INTO `user_levels` VALUES ('1', '注册会员', '0', '100', '注册会员', '2018-08-17 11:47:05', '2018-08-17 11:47:05', null);
INSERT INTO `user_levels` VALUES ('2', '铜牌会员', '1000', '98', '铜牌会员', '2018-08-17 11:47:05', '2018-08-17 11:47:05', null);
INSERT INTO `user_levels` VALUES ('3', '白银会员', '3000', '95', '白银会员', '2018-08-17 11:47:05', '2018-08-17 11:47:05', null);
INSERT INTO `user_levels` VALUES ('4', '黄金会员', '10000', '92', '黄金会员', '2018-08-17 11:47:05', '2018-08-17 11:47:05', null);
INSERT INTO `user_levels` VALUES ('5', '钻石会员', '50000', '88', '钻石会员', '2018-08-17 11:47:05', '2018-08-17 11:47:05', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_validated` tinyint(4) DEFAULT '0' COMMENT '是否认证邮箱 0 否 1 是',
  `nickname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password-pay` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '支付密码',
  `sex` enum('女','男') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '男' COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `head_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户头像',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机',
  `qq` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'QQ',
  `openid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '微信OPEN ID',
  `unionid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公众平台ID',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '推荐码',
  `share_qcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '推荐二维码',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态0正常 1冻结',
  `credits` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `user_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '用户金额',
  `distribut_money` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '累积分佣金额',
  `consume_total` double(8,2) NOT NULL DEFAULT '0.00' COMMENT '累计消费额度',
  `last_login` timestamp NULL DEFAULT NULL COMMENT '最后登录日期',
  `last_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
  `oauth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '第三方来源',
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '省',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '市',
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '区',
  `lock` tinyint(4) DEFAULT '0' COMMENT '冻结用户 0 否 1 是',
  `is_distribute` tinyint(4) DEFAULT '0' COMMENT '是否分销商 0 否 1 是',
  `leader1` int(10) unsigned DEFAULT '0' COMMENT '一级推荐人',
  `leader2` int(10) unsigned DEFAULT '0' COMMENT '二级推荐人',
  `leader3` int(10) unsigned DEFAULT '0' COMMENT '三级推荐人',
  `level1` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级下线数',
  `level2` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级下线数',
  `level3` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '三级下线数',
  `user_level` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_created_at_index` (`id`,`created_at`),
  KEY `users_user_level_index` (`user_level`),
  CONSTRAINT `users_user_level_foreign` FOREIGN KEY (`user_level`) REFERENCES `user_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'user', '18717160163@qq.com', '0', '易呗测试用户', '$2y$10$WaaBj3Vt1aj.fGrRIkn3legMUcCWOfpE9SwX/gOx/zY0f3w0nuvry', null, '男', null, null, '18717160163', null, 'odh7zsgI75iT8FRh0fGlSojc9PWM', null, null, 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQF78DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAycWgwUWdwTlRkT2oxMDAwMGcwM0IAAgRQaK9aAwQAAAAA', '0', '9852', '1000.00', '0.00', '0.00', null, null, null, '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-17 11:47:05', '2018-08-27 15:13:36');
INSERT INTO `users` VALUES ('2', '王小明', null, '0', 'HipePeng', null, '$2y$10$vM0laRngNYRyeAErtTyvbOGIHo/Y2FTkjC3p.Mg.h4BL490QllPu.', '女', null, 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKmEn0Rqc3WvO6UpZRaxEJW03rNl7xiasc1tUIq8pKeTaOn8icf6RWjDaxuoU1gjD6bTpicvY4IKjUjQ/132', '13125110550', null, 'oMXdy0x0PyLeUAJfeaMYKAMj7H1o', 'onYzBwEI-W69VwHpaMBT7lAAMMqI', null, null, '0', '400', '2.20', '0.00', '0.00', '2018-09-06 12:41:21', '58.48.77.239', '微信', '湖北', '武汉', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-24 15:21:47', '2018-09-06 12:41:21');
INSERT INTO `users` VALUES ('3', '彭民', null, '0', '彭民', null, null, '男', null, '', null, null, 'oMXdy0-5XftPtnAARW_5ZsKRaSWw', 'onYzBwDWAoWZi0R83MVJxwzY1qpg', null, null, '0', '0', '0.00', '0.00', '0.00', '2018-08-24 15:57:39', '61.129.6.148', '微信', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-24 15:57:39', '2018-08-24 15:57:39');
INSERT INTO `users` VALUES ('4', '王先生', null, '0', 'Benny', null, '$2y$10$YQ54ar8OZ2G.2D70tasLKuUoP686HA8NV.LZO/b2T0sOKaiodhgtm', '男', null, 'http://thirdwx.qlogo.cn/mmopen/vi_32/K3micVlTFWZbBSeMoTlMsoFt1AQD1bHYQdKXnu9OpibvCk5ouTvn1wOD9ic5ODmYVEJ484OQ5TmD5u81hTYhwyefw/132', '13397119221', null, 'oMXdy052llcueQ1WUp--WPISF6R8', 'onYzBwJl0KU_UqRXpOoMf_W5lCCw', null, 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQES8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAySW5EcmdSTlRkT2oxMDAwMGcwM3EAAgRosJRaAwQAAAAA', '0', '50000', '1.00', '0.00', '0.00', '2018-09-07 13:09:19', '171.82.1.22', '微信', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-25 11:12:41', '2018-09-07 13:09:19');
INSERT INTO `users` VALUES ('5', '文竣', null, '0', '文竣', null, null, '女', null, 'http://thirdwx.qlogo.cn/mmopen/vi_32/Uj8UYOic8oKZRrvBYFMU41x30OpQbILupHVjO0vrtelguKl669uLWL0NY40a1mbp2f7enEtuIfWz67ia236TVKtg/132', null, null, 'oMXdy00qt-it6_mkTXNtcsuNE2Rg', 'onYzBwGaVU-pEex-uPOb5-Qjj9_Y', null, null, '0', '0', '0.00', '0.00', '0.00', '2018-08-28 13:20:15', '61.151.178.176', '微信', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-28 13:20:15', '2018-08-28 13:20:15');
INSERT INTO `users` VALUES ('6', '遇见', null, '0', '遇见', null, null, '男', null, 'http://thirdwx.qlogo.cn/mmopen/vi_32/ssTicnko71r9xRAKicCyULRbBuHicNjKFgzq0ponDeW4QrLa3xdEXG1JjnTGcOL4stkTH4fAJlTucIt4452EwYzbw/132', null, null, 'oMXdy06QxwJ9HjlN3dOCVWqQilFs', 'onYzBwMhgw5ywSRx0VTLLnqX_xWI', null, null, '0', '0', '0.00', '0.00', '0.00', '2018-09-03 14:41:59', '171.113.207.225', '微信', '湖北', '武汉', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-28 14:16:13', '2018-09-03 14:41:59');
INSERT INTO `users` VALUES ('7', '◆爱吃猫的鱼♂', null, '0', '◆爱吃猫的鱼♂', null, null, '女', null, 'http://thirdwx.qlogo.cn/mmopen/vi_32/4oZJ8zm7iaQzRDccpRt48eUxlVsibPPSiaJmH1RychXJvZDRFSHFvRV0o8PdTcavEQLaavO1xD6P27xNW5rSaJbQQ/132', null, null, 'oMXdy05e5lfW33fo_h7GhEdV_uuo', 'onYzBwIpBzkAIXu0zsodZ5lmxwZY', null, null, '0', '0', '0.00', '0.00', '0.00', '2018-09-05 23:13:38', '49.222.187.101', '微信', '湖北', '武汉', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-29 16:03:39', '2018-09-05 23:13:38');
INSERT INTO `users` VALUES ('8', '荷青水香', null, '0', '荷青水香', null, null, '男', null, 'http://thirdwx.qlogo.cn/mmopen/vi_32/yy4RlSUfRR0GQZ2FXSKzLpwf3SPHib9JECVVdBPxnpePfMnLAickh1nPEr6HxxcrYHe9J8xpCHjUTFfpweFyOUmg/132', null, null, 'oMXdy04Xq6Rt6Ksg78qkTbtmRXSg', 'onYzBwMcg3tSt7kzem1NhnEkyp2I', null, null, '0', '0', '0.00', '0.00', '0.00', '2018-09-01 20:36:01', '122.188.134.75', '微信', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', '1', null, '2018-08-31 10:42:02', '2018-09-01 20:36:01');

-- ----------------------------
-- Table structure for wechat_events
-- ----------------------------
DROP TABLE IF EXISTS `wechat_events`;
CREATE TABLE `wechat_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '事件名称',
  `type` enum('addon','material') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '事件类型',
  `value` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '触发值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wechat_events_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wechat_events
-- ----------------------------

-- ----------------------------
-- Table structure for wechat_materials
-- ----------------------------
DROP TABLE IF EXISTS `wechat_materials`;
CREATE TABLE `wechat_materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `media_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'mediaId',
  `original_id` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '原始微信素材id',
  `parent_id` int(11) DEFAULT '0' COMMENT '父id',
  `type` enum('article','image','voice','video','text') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '素材类型',
  `is_multi` tinyint(4) DEFAULT '0' COMMENT '是否是多图文 0 否 1 是',
  `can_edited` tinyint(4) DEFAULT '0' COMMENT '是否可编辑 0 不可 1 可编辑',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标题',
  `description` varchar(360) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '摘要',
  `author` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `cover_media_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面 media_id',
  `cover_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面url',
  `show_cover_pic` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示封面 0 不显示 1 显示',
  `created_from` tinyint(4) DEFAULT '0' COMMENT '0 微信同步到微易 1自微易同步到微信',
  `source_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '内容连接资源',
  `content_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '原文链接',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wechat_materials_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wechat_materials
-- ----------------------------

-- ----------------------------
-- Table structure for wechat_menus
-- ----------------------------
DROP TABLE IF EXISTS `wechat_menus`;
CREATE TABLE `wechat_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0' COMMENT '菜单父id',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单名称',
  `type` enum('click','view','scancode_push','scancode_waitmsg','pic_sysphoto','pic_photo_or_album','pic_weixin','location_select') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'click' COMMENT '菜单类型',
  `key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单触发值',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wechat_menus_id_created_at_index` (`id`,`created_at`),
  KEY `wechat_menus_parent_id_index` (`parent_id`),
  KEY `wechat_menus_sort_index` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wechat_menus
-- ----------------------------

-- ----------------------------
-- Table structure for wechat_replies
-- ----------------------------
DROP TABLE IF EXISTS `wechat_replies`;
CREATE TABLE `wechat_replies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('follow','no-match','keywords') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '回复类型 follow 关注回复 default 默认回复 keywords 关键词回复',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '规则名称',
  `trigger_keywords` text COLLATE utf8mb4_unicode_ci COMMENT '触发文字',
  `trigger_type` enum('equal','contain') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '触发条件类型',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '触发内容 events',
  `group_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '适用范围：组id数组',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wechat_replies_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wechat_replies
-- ----------------------------

-- ----------------------------
-- Table structure for with_drawls
-- ----------------------------
DROP TABLE IF EXISTS `with_drawls`;
CREATE TABLE `with_drawls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '单号',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '交易方式(充值|提现|交易)',
  `price` double(8,2) DEFAULT NULL COMMENT '交易价格',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '交易状态(发起|处理中|已完成|撤回)',
  `arrive_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '预计到账时间',
  `account_tem` double(8,2) DEFAULT NULL COMMENT '临时余额',
  `card_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '银行卡名称',
  `card_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '银行卡号',
  `bank_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `with_drawls_user_id_foreign` (`user_id`),
  KEY `with_drawls_id_created_at_index` (`id`,`created_at`),
  KEY `with_drawls_bank_id_index` (`bank_id`),
  CONSTRAINT `with_drawls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of with_drawls
-- ----------------------------

-- ----------------------------
-- Table structure for word
-- ----------------------------
DROP TABLE IF EXISTS `word`;
CREATE TABLE `word` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `word_id_created_at_index` (`id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of word
-- ----------------------------
