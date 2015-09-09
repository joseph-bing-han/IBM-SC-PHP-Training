
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `list`
-- ----------------------------
DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `user` varchar(90) DEFAULT NULL,
  `addtime` varchar(30) DEFAULT NULL,
  `content` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('admin1', 'admin1');
INSERT INTO `user` VALUES ('admin2', 'admin2');
INSERT INTO `user` VALUES ('admin3', 'admin3');
INSERT INTO `user` VALUES ('admin4', 'admin4');
INSERT INTO `user` VALUES ('admin5', 'admin5');

