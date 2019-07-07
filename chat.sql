/*
 Navicat Premium Data Transfer

 Source Server         : centos7
 Source Server Type    : MySQL
 Source Server Version : 80013
 Source Host           : 192.168.204.129:3306
 Source Schema         : chat

 Target Server Type    : MySQL
 Target Server Version : 80013
 File Encoding         : 65001

 Date: 07/07/2019 12:25:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '管理员', '$2y$10$RdqtizgBjx3HPe/lsN6sQu/rBSQdaG9V1Tl5XsK8i9T11NzcfHo4K', '2019-06-17 23:42:10', NULL);
INSERT INTO `users` VALUES (8, '张三', '$2y$10$0K6uU3DIR3qyhQNg.u/Vieng4Fk87mgz3Eh1mN3mQDaCExGMhCzAG', '2019-06-17 23:42:15', NULL);
INSERT INTO `users` VALUES (10, '最后一眼', '$2y$10$OaYw0JtknAqs21K/uWgoYOh7Zg4mTr0uDPJ9EPjSukVVtN5Z4fATq', '2019-06-17 23:42:19', NULL);
INSERT INTO `users` VALUES (11, 'wang', '$2y$10$a6lQ9rgn1n.6YpuIe3T4Iu8SXdiPnzUwDOeiMrThb9jhrbakXI2kO', '2019-06-17 23:42:23', NULL);
INSERT INTO `users` VALUES (12, 'wangttt', '$2y$10$kJTyce2/DxACs7eQAm79MubK0PnyKZwn2sJ09VZJn9yRXw1otXLcW', '2019-06-17 23:42:26', NULL);
INSERT INTO `users` VALUES (13, 'wangtt', '$2y$10$4bYrPipb3C07fPgSU0nL5.3aifZPe/Vq0ees5HXxXjpNR4zIqVbkG', '2019-06-17 23:42:28', NULL);
INSERT INTO `users` VALUES (14, 'wan', '$2y$10$c3gAVg3scKd/rU6dXrHaveuZQNOSYws1McroSKMzBK.Hw2PbeOYFy', '2019-06-17 23:41:53', NULL);
INSERT INTO `users` VALUES (15, 'linyang', '$2y$10$6wQQsr8SHh6J9lAvUgP4be/ksFLhPedEoddAO6CYAI0I5brcYyupu', '2019-06-18 20:10:21', NULL);

SET FOREIGN_KEY_CHECKS = 1;
