/*
Navicat MySQL Data Transfer

Source Server         : jcwed
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : cj

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2019-01-17 17:59:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `aboutus`
-- ----------------------------
DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE `aboutus` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `save_time` datetime DEFAULT NULL,
  `type` int(4) DEFAULT NULL COMMENT '1代表公司图，2代表资质图片',
  `thumb_path` varchar(100) DEFAULT NULL,
  `pic_path` varchar(100) DEFAULT NULL COMMENT '原图地址',
  `sortby` tinyint(1) DEFAULT NULL COMMENT '1是横排，2是竖排',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aboutus
-- ----------------------------
INSERT INTO `aboutus` VALUES ('1', '<p style=\"margin-top: 10px; margin-bottom: 10px; text-align: left; line-height: 2em;\"><span style=\"font-family: Arial; font-size: 18px;\"></span></p><p style=\"margin-left: 28px; text-align: left; line-height: 2em;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px; font-family: 楷体, 楷体_GB2312, SimKai;\">愿景：成为中国高端化合物半导体材料与光电器件的领军企业</span></span></p><p style=\"margin-left: 28px; text-align: left; line-height: 2em;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px; font-family: 楷体, 楷体_GB2312, SimKai;\">使命：引领材料方向、服务智能创造</span></span></p><p style=\"margin-left: 28px; text-align: left; line-height: 2em;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px; font-family: 楷体, 楷体_GB2312, SimKai;\">核心价值观：求实 进取 创新 协同</span></span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px; font-family: 宋体, SimSun;\">超晶科技（北京）有限公司（简称：超晶科技）是成立于2015年，由国家千人计划特聘专家、业内多名科学家和行业专家组成国际化的技术团队，专注于为用户提供自主研制高性能化合物半导体材料和半导体光电器件。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"color: rgb(0, 0, 0); font-size: 18px; font-family: 宋体, SimSun;\">2017年，公司投资建设了千余平米的超净间，构建了材料外延、器件工艺、电路设计和封装测试的完整技术链，打造了全球一流水平的半导体材料、化合物芯片与光电器件的生产线，为提升我国在本领域的技术能力与产品水平作出应有的贡献。</span></p>', '2018-06-25 10:56:50', '1', '/Public/attached/2018-06-25/1529895408_thumb.png', '/Public/attached/2018-06-25/1529895408.png', '0');
INSERT INTO `aboutus` VALUES ('16', null, '2018-06-14 17:36:31', '2', '/Public/attached/2018-06-14/1528968989_thumb.png', '/Public/attached/2018-06-14/1528968989.png', '2');
INSERT INTO `aboutus` VALUES ('22', null, '2018-06-27 16:16:43', '2', '/Public/attached/2018-06-27/1530087399_thumb.jpg', '/Public/attached/2018-06-27/1530087399.jpg', '2');

-- ----------------------------
-- Table structure for `common_admin_nav`
-- ----------------------------
DROP TABLE IF EXISTS `common_admin_nav`;
CREATE TABLE `common_admin_nav` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '导航名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1开启 0关闭',
  `pid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '父级id',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `disorder` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(60) DEFAULT NULL COMMENT 'url地址',
  `url_type` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '是否是本站的地址 1是 0 不是',
  `collapsed` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否收缩，默认0 不收缩',
  `path` varchar(255) DEFAULT '0' COMMENT 'id直接字符串结合',
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common_admin_nav
-- ----------------------------
INSERT INTO `common_admin_nav` VALUES ('1', '左侧导航管理', '1', '0', '2017-09-16 12:03:38', '0', '', '1', '0', '0', null);
INSERT INTO `common_admin_nav` VALUES ('39', '超晶科技', '1', '1', '2017-09-16 12:08:19', '1', '#', '1', '0', '0-1', 'glyphicon glyphicon-home');
INSERT INTO `common_admin_nav` VALUES ('94', '角色权限管理', '1', '1', '2017-09-20 18:21:29', '42', '#', '1', '0', '0-1', 'glyphicon glyphicon-baby-formula');
INSERT INTO `common_admin_nav` VALUES ('95', '导航列表', '1', '94', '2017-09-20 18:22:11', '0', 'auth/navlist', '1', '0', '0-1-94', null);
INSERT INTO `common_admin_nav` VALUES ('96', '角色组', '1', '94', '2017-09-20 18:22:46', '1', 'auth/group', '1', '0', '0-1-94', null);
INSERT INTO `common_admin_nav` VALUES ('97', '管理员列表', '1', '94', '2017-09-20 18:23:16', '2', 'auth/admins', '1', '0', '0-1-94', null);
INSERT INTO `common_admin_nav` VALUES ('99', '超晶晟锐', '1', '1', '2018-05-07 22:16:07', '2', '', '1', '0', '0-1', 'glyphicon glyphicon-align-justify');
INSERT INTO `common_admin_nav` VALUES ('100', '诺迪克研究院', '1', '1', '2018-05-07 22:17:10', '3', '', '1', '0', '0-1', 'glyphicon glyphicon-align-justify');
INSERT INTO `common_admin_nav` VALUES ('101', '首页', '1', '39', '2018-05-07 22:21:28', '0', 'main/lunbo', '1', '0', '0-1-39', '');
INSERT INTO `common_admin_nav` VALUES ('102', '动态资讯', '1', '39', '2018-05-07 22:22:20', '2', 'edit/information', '1', '0', '0-1-39-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('103', '产品及解决方案', '1', '39', '2018-05-07 22:23:05', '3', 'edit/production', '1', '0', '0', '');
INSERT INTO `common_admin_nav` VALUES ('104', '产品及解决方案', '1', '39', '2018-05-07 22:24:16', '3', 'edit/production', '1', '0', '0-1-39-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('105', '联系我们', '1', '39', '2018-05-07 22:25:09', '4', 'edit/contact', '1', '0', '0', '');
INSERT INTO `common_admin_nav` VALUES ('106', '联系我们', '1', '39', '2018-05-07 22:26:01', '5', 'edit/contactus', '1', '0', '0-1-39', '');
INSERT INTO `common_admin_nav` VALUES ('107', '招贤纳士', '1', '39', '2018-05-07 22:55:43', '4', 'edit/recruitment', '1', '0', '0-1-39-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('108', '关于我们', '1', '39', '2018-05-30 18:58:24', '1', 'edit/aboutus', '1', '0', '0-1-39-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('109', '密码管理', '1', '1', '2018-05-30 19:02:25', '10', '', '1', '0', '0-1', 'glyphicon glyphicon-cog');
INSERT INTO `common_admin_nav` VALUES ('110', '修改密码', '1', '109', '2018-05-30 19:04:34', '1', 'password/updatepassword', '1', '0', '0-1-109-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('111', '首页', '1', '99', '2018-06-18 19:19:01', '0', 'shengedit/lunbo', '1', '0', '0-1-99', '');
INSERT INTO `common_admin_nav` VALUES ('112', '动态资讯', '1', '99', '2018-06-18 19:28:32', '2', 'shengedit/information', '1', '0', '0-1-99', '');
INSERT INTO `common_admin_nav` VALUES ('113', '关于我们', '1', '99', '2018-06-18 19:31:38', '1', 'shengedit/aboutus', '1', '0', '0-1-99', '');
INSERT INTO `common_admin_nav` VALUES ('114', '产品和解决方案', '1', '99', '2018-06-18 19:49:43', '3', 'shengedit/production', '1', '0', '0-1-99-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('115', '招贤纳士', '1', '99', '2018-06-18 19:54:07', '4', 'shengedit/recruitment', '1', '0', '0-1-99-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('116', '联系我们', '1', '99', '2018-06-18 19:54:50', '5', 'shengedit/contactus', '1', '0', '0-1-99-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('117', '首页', '1', '100', '2018-06-18 20:10:52', '0', 'diedit/lunbo', '1', '0', '0-1-100-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('118', '关于我们', '1', '100', '2018-06-18 20:13:29', '1', 'diedit/aboutus', '1', '0', '0-1-100-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('119', '动态资讯', '1', '0', '2018-06-18 20:14:47', '2', 'diedit/information', '1', '0', '0-0', null);
INSERT INTO `common_admin_nav` VALUES ('120', '技术服务', '1', '100', '2018-06-18 20:15:42', '3', 'diedit/production', '1', '0', '0-1-100-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('121', '动态资讯', '1', '100', '2018-06-18 20:16:38', '2', 'diedit/information', '1', '0', '0-1-100', '');
INSERT INTO `common_admin_nav` VALUES ('122', '招贤纳士', '1', '100', '2018-06-18 20:20:12', '4', 'diedit/recruitment', '1', '0', '0-1-100-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('123', '联系我们', '1', '100', '2018-06-18 20:20:31', '5', 'diedit/contactus', '1', '0', '0-1-100-0-1', null);
INSERT INTO `common_admin_nav` VALUES ('124', '专家团队', '1', '100', '2018-06-19 15:36:12', '6', 'diedit/experts', '1', '0', '0-1-100-0-1', null);

-- ----------------------------
-- Table structure for `common_role`
-- ----------------------------
DROP TABLE IF EXISTS `common_role`;
CREATE TABLE `common_role` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rolename` varchar(20) DEFAULT NULL COMMENT '角色名称',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加日期',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `perm` text COMMENT '对应的权限',
  `power` text COMMENT '对应的权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common_role
-- ----------------------------
INSERT INTO `common_role` VALUES ('3', '测试', '2017-09-19 18:51:55', '1', null, 'a:21:{i:0;s:1:\"1\";i:1;s:2:\"22\";i:2;s:2:\"25\";i:3;s:2:\"26\";i:4;s:2:\"27\";i:5;s:2:\"28\";i:6;s:2:\"29\";i:7;s:2:\"30\";i:8;s:2:\"31\";i:9;s:2:\"32\";i:10;s:2:\"33\";i:11;s:2:\"34\";i:12;s:2:\"35\";i:13;s:2:\"36\";i:14;s:2:\"56\";i:15;s:2:\"57\";i:16;s:2:\"58\";i:17;s:2:\"67\";i:18;s:2:\"68\";i:19;s:2:\"89\";i:20;s:2:\"90\";}');
INSERT INTO `common_role` VALUES ('2', '超级管理员', '2017-09-16 14:57:30', '1', null, 'a:73:{i:0;s:1:\"1\";i:1;s:2:\"21\";i:2;s:2:\"38\";i:3;s:2:\"23\";i:4;s:2:\"24\";i:5;s:2:\"22\";i:6;s:2:\"25\";i:7;s:2:\"26\";i:8;s:2:\"27\";i:9;s:2:\"28\";i:10;s:2:\"29\";i:11;s:2:\"30\";i:12;s:2:\"31\";i:13;s:2:\"32\";i:14;s:2:\"33\";i:15;s:2:\"34\";i:16;s:2:\"35\";i:17;s:2:\"36\";i:18;s:2:\"39\";i:19;s:2:\"40\";i:20;s:2:\"41\";i:21;s:2:\"42\";i:22;s:2:\"43\";i:23;s:2:\"44\";i:24;s:2:\"45\";i:25;s:2:\"46\";i:26;s:2:\"47\";i:27;s:2:\"48\";i:28;s:2:\"49\";i:29;s:2:\"50\";i:30;s:2:\"51\";i:31;s:2:\"52\";i:32;s:2:\"53\";i:33;s:2:\"54\";i:34;s:2:\"55\";i:35;s:2:\"56\";i:36;s:2:\"57\";i:37;s:2:\"58\";i:38;s:2:\"59\";i:39;s:2:\"60\";i:40;s:2:\"61\";i:41;s:2:\"62\";i:42;s:2:\"63\";i:43;s:2:\"64\";i:44;s:2:\"65\";i:45;s:2:\"66\";i:46;s:2:\"67\";i:47;s:2:\"68\";i:48;s:2:\"69\";i:49;s:2:\"70\";i:50;s:2:\"71\";i:51;s:2:\"72\";i:52;s:2:\"73\";i:53;s:2:\"74\";i:54;s:2:\"75\";i:55;s:2:\"76\";i:56;s:2:\"77\";i:57;s:2:\"78\";i:58;s:2:\"79\";i:59;s:2:\"80\";i:60;s:2:\"81\";i:61;s:2:\"82\";i:62;s:2:\"83\";i:63;s:2:\"84\";i:64;s:2:\"85\";i:65;s:2:\"86\";i:66;s:2:\"87\";i:67;s:2:\"88\";i:68;s:2:\"89\";i:69;s:2:\"90\";i:70;s:2:\"91\";i:71;s:2:\"92\";i:72;s:2:\"93\";}');
INSERT INTO `common_role` VALUES ('4', '运营', '2017-09-20 11:24:51', '1', null, 'a:17:{i:0;s:1:\"1\";i:1;s:2:\"21\";i:2;s:2:\"38\";i:3;s:2:\"79\";i:4;s:2:\"80\";i:5;s:2:\"81\";i:6;s:2:\"82\";i:7;s:2:\"83\";i:8;s:2:\"84\";i:9;s:2:\"85\";i:10;s:2:\"86\";i:11;s:2:\"87\";i:12;s:2:\"88\";i:13;s:2:\"89\";i:14;s:2:\"90\";i:15;s:2:\"94\";i:16;s:2:\"97\";}');

-- ----------------------------
-- Table structure for `common_system_user`
-- ----------------------------
DROP TABLE IF EXISTS `common_system_user`;
CREATE TABLE `common_system_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(16) NOT NULL COMMENT '后台管理的用户名',
  `passwd` char(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `gid` smallint(8) unsigned NOT NULL DEFAULT '0' COMMENT '属于哪个群组',
  `addtime` datetime NOT NULL COMMENT '添加日期',
  `super_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是超级管理员 1是有一切权限 0不是需要配置权限',
  `perm` varchar(255) DEFAULT NULL COMMENT '用户的其他权限',
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common_system_user
-- ----------------------------
INSERT INTO `common_system_user` VALUES ('1', 'admin', 'dd6e5e5918e94d997c686fcebc56922f', '1', '0', '2017-09-20 12:05:13', '1', null, '2019-01-16 13:31:14');

-- ----------------------------
-- Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL DEFAULT '1',
  `words1` varchar(200) DEFAULT NULL COMMENT '欢迎语第一行',
  `words2` varchar(200) DEFAULT NULL COMMENT '欢迎语第二行',
  `company_name` varchar(100) DEFAULT NULL COMMENT '公司地址',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `telephone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact
-- ----------------------------
INSERT INTO `contact` VALUES ('1', '联系我们', '欢迎您的到来', '超晶科技公司', '北京市清华同方科技大厦B座803', '010-8610 53859976', 'renjq@supermat.com.cn');

-- ----------------------------
-- Table structure for `di_aboutus`
-- ----------------------------
DROP TABLE IF EXISTS `di_aboutus`;
CREATE TABLE `di_aboutus` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `save_time` datetime DEFAULT NULL,
  `type` int(4) DEFAULT NULL COMMENT '1代表公司图，2代表资质图片，3是专家图',
  `thumb_path` varchar(100) DEFAULT NULL,
  `pic_path` varchar(100) DEFAULT NULL COMMENT '原图地址',
  `name` varchar(50) DEFAULT '' COMMENT '专家名字',
  `sortby` tinyint(1) DEFAULT NULL COMMENT '1是横排，2是竖排',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_aboutus
-- ----------------------------
INSERT INTO `di_aboutus` VALUES ('1', '<p data-wow-duration=\"2s\" data-wow-delay=\".3s\" data-wow-animation-name=\"fadeInLeft\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; animation-duration: 2s; animation-fill-mode: both; animation-name: fadeInLeft; text-align: center; line-height: 26px; letter-spacing: 2px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); visibility: visible; animation-delay: 0.3s;\">诺迪克光电产业研究院于2018年3月注册成立。由国家“千人计划”特聘专家王庶民教授发起并担任院长，中科院外籍院士、分子束外延之父卓以和担任名誉院长，提倡“开放、自由、共赢”的学术风气，组建了一支高水平的专家顾问团队。</p><p data-wow-duration=\"2s\" data-wow-delay=\".5s\" data-wow-animation-name=\"fadeInRight\" style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; animation-duration: 2s; animation-fill-mode: both; animation-name: fadeInRight; text-align: center; line-height: 26px; letter-spacing: 2px; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255); visibility: visible; animation-delay: 0.5s;\">诺迪克光电产业研究院将通过与欧洲高校、国内外研究所和企业合作，引进高端人才，引进高端光电子和微电子器件技术并实现技术转化，寻求合作共赢，打造具备全球一流水准的集产学研为一体的光电产业平台。</p><p><br/></p>', '2018-06-19 11:57:54', '1', null, null, '', null);
INSERT INTO `di_aboutus` VALUES ('2', '<p><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\"></strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">诺迪克研究院名誉院长</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">中科院外籍院士</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">美国科学院院士</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">美国工程院院士</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">美国科学与艺术院院士</strong></p><p style=\"line-height: 1.75em;\"><span style=\"box-sizing: border-box; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\">国际公认分子束外延、人工微结构材料生长和在新型器件研究领域的奠基人与开拓者；对Ⅲ－V族化合物半导体、金属和绝缘体的异质外延和人工结构的量子阱、超晶格及调制掺杂微结构材料系统地开展了大量先驱性的研究工作；率先成功研制十余种极为重要的且性能优异的新型微波高速电子器件和光电子器件；开创性地研制了量子阱级联式新型激光器，被认为是半导体激光器发展中的又一个里程碑。</span></p><p><br/></p>', '2018-06-19 16:30:23', '3', '/Public/attached/2018-06-19/1529396901_thumb.png', '/Public/attached/2018-06-19/1529396901.png', '卓以和', null);
INSERT INTO `di_aboutus` VALUES ('3', '<p style=\"line-height: 1.75em;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\"></strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">中组部 “千人计划”专家</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">超晶科技首席科学家</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">中科院上海微系统与信息技术研究所 研究员</strong></p><p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 10px; text-align: left;\"><strong style=\"box-sizing: border-box; color: rgb(51, 51, 51); white-space: normal; background-color: rgb(255, 255, 255);\">国家973项目首席科学家</strong></p><p style=\"line-height: 1.75em;\"><span style=\"box-sizing: border-box; color: rgb(51, 51, 51); background-color: rgb(255, 255, 255);\">世界著名分子束外延材料和器件专家；受瑞典诺贝尔物理奖和日本奖委员会邀请提名候选人；IEEE高级会员；领导并参与10余项欧盟、北欧、中瑞和国内科研项目，在欧盟科技组织和多个国际学术会议任职；编著英文专著1本，书籍篇章6章，国际学术期刊和会议论文450多篇；授权国际专利2项，中国专利14项 。</span></p><p></p>', '2018-06-19 16:38:42', '3', '/Public/attached/2018-06-19/1529396977_thumb.png', '/Public/attached/2018-06-19/1529396977.png', '王庶民', null);

-- ----------------------------
-- Table structure for `di_contact`
-- ----------------------------
DROP TABLE IF EXISTS `di_contact`;
CREATE TABLE `di_contact` (
  `id` int(11) NOT NULL DEFAULT '1',
  `words1` varchar(200) DEFAULT NULL COMMENT '欢迎语第一行',
  `words2` varchar(200) DEFAULT NULL COMMENT '欢迎语第二行',
  `company_name` varchar(100) DEFAULT NULL COMMENT '公司地址',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `telephone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_contact
-- ----------------------------
INSERT INTO `di_contact` VALUES ('1', '', '', '', '浙江省宁波市余姚市经济开发区科创中心大厦17层', '0574-62829926', '');

-- ----------------------------
-- Table structure for `di_home_image`
-- ----------------------------
DROP TABLE IF EXISTS `di_home_image`;
CREATE TABLE `di_home_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_name` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture` varchar(100) DEFAULT NULL COMMENT '原图地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_home_image
-- ----------------------------
INSERT INTO `di_home_image` VALUES ('1', null, '/Public/attached/2018-06-19/1529376835.png');
INSERT INTO `di_home_image` VALUES ('2', null, '/Public/attached/2018-06-19/1529376846.png');
INSERT INTO `di_home_image` VALUES ('3', null, '/Public/attached/2018-06-19/1529376856.png');

-- ----------------------------
-- Table structure for `di_information`
-- ----------------------------
DROP TABLE IF EXISTS `di_information`;
CREATE TABLE `di_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `information_images_path` varchar(50) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(50) DEFAULT NULL COMMENT '原图地址',
  `type` int(11) DEFAULT NULL COMMENT '1是超晶资讯；2是行业动态',
  `title` varchar(30) DEFAULT NULL,
  `content` longtext,
  `save_time` datetime DEFAULT NULL,
  `if_special` tinyint(1) DEFAULT '0' COMMENT '是否设为展板，1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_information
-- ----------------------------
INSERT INTO `di_information` VALUES ('1', '/Public/attached/2018-06-19/1529381490_thumb.png', '/Public/attached/2018-06-19/1529381490.png', '1', '诺迪克光电产业研究院与芬兰DCA建立战略合作', '<p style=\"line-height: 2em;\">&nbsp; &nbsp; &nbsp; 2018年3月20日，诺迪克光电产业研究院院长王庶民教授在芬兰与全球三大分子束外延设备制造商DCA Instruments Oy签署战略合作协议，将在研究院平台上建立中欧联合实验室，迈向国际化，并以此为切入点，逐渐汇聚国际、国内科研及项目资源，支持保持技术国际前沿性，并拓展新的业务亮点。</p><p style=\"text-align: center;\"><img src=\"/Uploads/ueditor/image/20180619/5b2882148a9de.png\" title=\"5b2882148a9de.png\" alt=\"9.png\"/></p>', '2018-06-19 12:11:19', '1');
INSERT INTO `di_information` VALUES ('2', null, null, '1', '诺迪克光电产业研究院正式成立', '<p style=\"text-align: left; line-height: 2em;\"><span style=\"font-size: 16px;\">&nbsp; &nbsp; &nbsp; 为了夯实公司的研发链条，2018年3月5日，由王庶民教授领衔的诺迪克（余姚）光电产业研究院在余姚注册成立。世界分子束外延之父、美国最高科学奖和技术奖获得者、美国科学院院士、中国科学院外籍院士卓以和先生出任该研究院名誉院长。</span></p>', '2018-06-19 12:12:34', '0');
INSERT INTO `di_information` VALUES ('3', '/Public/attached/2018-06-19/1529381678_thumb.png', '/Public/attached/2018-06-19/1529381678.png', '1', '半导体材料和光电子器件论坛在宁波成功举办', '<p style=\"line-height: 2em;\">&nbsp; &nbsp; &nbsp; 2018 年 5 月 11 日，由诺迪克光电产业研究院主办，超晶科技 (北京)有限公司承办的“半导体材料和光电子器件论坛”在浙江省委党校四明山分校举办。论坛由诺迪克光电产业研究院院长，超晶科技首席科学家王庶民教授主持。</p><p style=\"line-height: 2em; text-align: center;\"><img src=\"/Uploads/ueditor/image/20180619/5b2883070abeb.png\" title=\"5b2883070abeb.png\" alt=\"图片 3.png\"/></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\">本论坛邀请了五位重量级嘉宾参会，包括国家“千人计划”专家、中科院苏州纳米所徐科教授，国家“千人计划”专家、西南技术物理研究所宋海智教授，中科院半导体所杰青牛智川教授，清华大学杰青罗毅教授，苏州长光华芯光电技术有限公司总经理廖新胜博士等。五位专家的报告涵盖了半导体激光器的发展及趋势、红外探测器的研发现状及前景、智能驾驶领域的热门技术-激光雷达、第二代半导体 GaN 的高质量单晶研发等从材料到器件的多维度领域，现场气氛积极热烈。</p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\">超晶科技首席科学家王庶民教授做了题为:VCSEL 的研发现状及趋势的报告。主要讲解了 VCSEL 的基本概念、本领域知名专家、 VCSEL 在人工智能、高速通信领域的发展前景，重点讲解了国际上 VCSEL 的研发指标，分析了我国当前技术发展与国际上技术的差距。</p><p style=\"line-height: 2em;\">本次论坛不仅增强了超晶科技与光电材料与器件领域的科学家和企业家的互动，加深了彼此的了解，也为多方开展深层次的合作奠定了良好的基础。</p><p><br/></p>', '2018-06-19 12:14:04', '0');

-- ----------------------------
-- Table structure for `di_production`
-- ----------------------------
DROP TABLE IF EXISTS `di_production`;
CREATE TABLE `di_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(2) DEFAULT NULL COMMENT 'A是光电、B是外延',
  `name` varchar(20) DEFAULT NULL COMMENT '名称',
  `save_time` datetime DEFAULT NULL,
  `thumb_path` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(255) DEFAULT NULL COMMENT '原图地址',
  `content` longtext COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_production
-- ----------------------------
INSERT INTO `di_production` VALUES ('1', 'B', '材料定制', '2018-06-19 11:52:46', '/Public/attached/2018-06-19/1529377392_thumb.png', '/Public/attached/2018-06-19/1529377392.png', '1、固态源、双生长室系统；2、拥有成熟的GaAs基、GaSb基材料外延技术；3、可提供定制化的2英寸-4英寸III-V族化合物半导体外延片');
INSERT INTO `di_production` VALUES ('2', 'B', 'XDR衍射', '2018-06-19 11:52:32', '/Public/attached/2018-06-19/1529377475_thumb.png', '/Public/attached/2018-06-19/1529377475.png', '1、精确测定材料失配度、弛豫度、晶格常数、组分等；2、可实现半导体单晶材料mapping的快速测量；3、配备PIX cel 3D矩阵探测器，Ge（220）四晶单色器');
INSERT INTO `di_production` VALUES ('3', 'B', '光刻工艺', '2018-06-19 11:52:17', '/Public/attached/2018-06-19/1529377564_thumb.png', '/Public/attached/2018-06-19/1529377564.png', '1、最大支持8英寸；2、全自动非接触式对准曝光，无损伤光刻；3、对准精度0.5微米；4、最小线宽1微米');
INSERT INTO `di_production` VALUES ('4', 'B', '扫描电子显微镜（SEM）', '2018-06-19 11:52:02', '/Public/attached/2018-06-19/1529377625_thumb.png', '/Public/attached/2018-06-19/1529377625.png', '1、最高放大15万倍；2、15秒快速抽真空；3、高分辨率，可达8nm@10kv；4、内置彩色光学显微镜');

-- ----------------------------
-- Table structure for `di_recruitment`
-- ----------------------------
DROP TABLE IF EXISTS `di_recruitment`;
CREATE TABLE `di_recruitment` (
  `id` tinyint(4) NOT NULL DEFAULT '1',
  `content` longtext COMMENT '要求',
  `save_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_recruitment
-- ----------------------------
INSERT INTO `di_recruitment` VALUES ('1', '<h3 style=\"box-sizing: border-box; font-weight: normal; line-height: 1.1; color: rgb(51, 51, 51); margin-top: 30px; margin-bottom: 10px; white-space: normal; background-color: rgb(255, 255, 255); text-align: center;\">聚国内外良材睿智 打造光电产业生态圈</h3><p><br/></p>', '2018-06-19 11:00:24');

-- ----------------------------
-- Table structure for `di_yuangong_picture`
-- ----------------------------
DROP TABLE IF EXISTS `di_yuangong_picture`;
CREATE TABLE `di_yuangong_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(3) DEFAULT NULL COMMENT '从左到右ABC',
  `thumb_path` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(100) DEFAULT NULL COMMENT '原图地址',
  `save_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of di_yuangong_picture
-- ----------------------------

-- ----------------------------
-- Table structure for `home_image`
-- ----------------------------
DROP TABLE IF EXISTS `home_image`;
CREATE TABLE `home_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_name` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture` varchar(100) DEFAULT NULL COMMENT '原图地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of home_image
-- ----------------------------
INSERT INTO `home_image` VALUES ('11', null, '/Public/attached/2018-06-25/1529890578.png');
INSERT INTO `home_image` VALUES ('12', null, '/Public/attached/2018-06-25/1529890591.png');
INSERT INTO `home_image` VALUES ('13', null, '/Public/attached/2018-06-25/1529890599.png');

-- ----------------------------
-- Table structure for `information`
-- ----------------------------
DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `information_images_path` varchar(50) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(50) DEFAULT NULL COMMENT '原图地址',
  `type` int(11) DEFAULT NULL COMMENT '1是超晶资讯；2是行业动态',
  `title` varchar(30) DEFAULT NULL,
  `content` longtext,
  `save_time` datetime DEFAULT NULL,
  `if_special` tinyint(1) DEFAULT '0' COMMENT '是否设为展板，1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of information
-- ----------------------------
INSERT INTO `information` VALUES ('20', '/Public/attached/2018-07-05/1530789342_thumb.jpeg', '/Public/attached/2018-07-05/1530789342.jpeg', '1', '超晶诺迪克光电产业研究院正式成立', '<p style=\"text-indent: 32px; text-align: left; line-height: 1.75em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">为了夯实超晶科技的研发链条，由王庶民教授领衔的宁波诺迪克光电产业研究院在宁波余姚落地注册。世界分子束外延之父、美国最高科学奖和技术奖获得者、美国科学院院士、中国科学院外籍院士卓以和先生出任该研究院名誉院长。</span></p><p><br/></p>', '2018-06-13 10:09:29', '0');
INSERT INTO `information` VALUES ('21', '/Public/attached/2018-06-13/1528855467_thumb.png', '/Public/attached/2018-06-13/1528855467.png', '1', '超晶科技王庶民：化合物半导体芯片前景令人鼓舞', '<p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">【来源：投中网 作者：陶辉东】</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-size: 20px; font-family: &quot;Adobe Song Std L&quot;, serif; color: rgb(0, 0, 0);\">2018年4月23-25日，由投中信息、投中网主办，投中资本协办的“第十二届中国投资年会·年度峰会”在上海金茂君悦酒店举办。本次会议主题为“价值的力量”，来自国内外上百家私募股权机构汇聚一堂，对当前行业热门话题展开讨论。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">此次峰会上，超晶科技首席科学家王庶民在主题为“化合物半导体芯片的应用与机遇”演讲中表示，虽然化合物芯片现在与硅比还是“小个儿”，但是它的市场潜力很大。英特尔做了一个预言，到2030年化合物半导体将占据整个半导体芯片市场的60%，这个数据是非常惊人的。</span></p><p style=\"text-align:center\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; color: rgb(0, 0, 0);\"><img src=\"/Uploads/ueditor/image/20180613/5b207b2fea595.png\" title=\"5b207b2fea595.png\" alt=\"图片 2.png\"/></span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">王庶民表示，在国防层面，西方国家，在化合物半导体的材料、器件上都对中国是禁运，在民品领域，西方对一些高端的化合物半导体材料和器件也实现了垄断和禁运。国内除了第三代的照明用氮化镓，在化合物半导体领域，目前还没有一个企业能够为客户提供定制的材料。而超晶希望未来成为亚洲最大的化合物半导体材料的供应商。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-size: 20px; color: rgb(0, 0, 0);\"><strong><span style=\"color: rgb(0, 0, 0); font-size: 20px; font-family: &quot;Adobe Song Std L&quot;, serif;\">以下为王庶民在“第十二届中国投资年会”精彩演讲实录，投中网整理。</span></strong></span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">王庶民：感谢投中给这样一个机会跟大家分享，分享化合物半导体芯片，同时也为超晶科技做宣传。</span></p><p style=\"margin-left: 60px; text-align: left; line-height: 2em;\"><span style=\"font-size: 20px; color: rgb(0, 0, 0);\"><span style=\"color: rgb(0, 0, 0); font-size: 20px; font-family: Wingdings;\">l<span style=\"color: rgb(0, 0, 0); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp; </span></span><span style=\"color: rgb(0, 0, 0); font-size: 20px; font-family: &quot;Adobe Song Std L&quot;, serif;\">摩尔定律终结，化合物半导体登场</span></span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">首先给大家稍微科普一下化合物半导体芯片。可能在座的大部分是搞投资的。这位是2000年的诺贝尔物理奖获得者。根据他的观点，上个世纪人类有三大发明，第一个发明是1942年的核反应堆，这解决了当今社会的能源问题。第二个就是美国贝尔实验室的晶体管，这给我们带来了现在的电子时代。第三个也是在美国，就是60年代的激光器，给我们带来了现在的信息社会。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">现在我们处于信息时代，很多大家谈的是软条件，包括程序、物联网等，构成这些物联网或者是所有通信最根本的硬件、基石是两个，第一个就是所谓的集成电路，第二个就是叫半导体的异质结，由于集成电路和异质结，2000年三位专家获得了诺贝尔物理奖。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">大家知道集成电路里面有一个摩尔定律。也就是集成电路的芯片的数量是每18个月翻一番，随着数量越来越多，它一定在某个时期达到极限，这个极限就是2016年，2016年摩尔定律正式宣告终止。就在前夕，美国的英特尔公司它首先开发了14纳米的芯片，也就是说在我们像手指这么大的一个尺寸里面，一共包含了13亿个晶体管，就相当于中国全国人口的数量。所以当摩尔定律终结以后，如何再继续发展集成电路，一个必然的趋势就是找新的材料，就是叫化合物半导体材料。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">化合物半导体材料，跟传统意义上的硅材料有较大的区别，简而言之的话我们可以这样理解，就是构成集成电路的硅材料，他里面的电子运行速度是慢的，运行速度有限，但是化合物半导体速度快得多，一般来说可以快几倍和几十倍，再有就是硅材料是几乎不能发光的，我们现在进入光通讯的时代，而半导体化合物是非常好的光源，这两点决定了在新的材料方面，硅材料迟早有一天被半导体化合物材料取代。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">另外一个是异质结结构，这是一种人造的晶体材料，每一层的晶体都是原子级的，也就是纳米科学。要控制这样一种的话，就是很关键的外延集结技术，其中一种是分子束外延技术，这个开创者就是美国的卓以和新生（音）。大家听说过化合物半导体，特别是第三代，以GaN（氮化镓）为代表，除了GaN以外，还有砷化镓、磷化铟等，有照明，红外成像、激光切割、光纤通讯、射频器等。化合物半导体里面我举个例子就是垂直腔面发射激光器，像iPhone的手机里面已经大量使用，另外是在高速通信，也就是未来的5G里面会用到这样新型的激光器。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">化合物芯片与硅比现在还是小个儿，但是它的市场是有潜力的。现在已经有460亿美元以上的市场。英特尔做了一个预言，它预言到2030年，化合物半导体将占据整个半导体芯片市场的60%，这个数据是非常惊人的，也就是化合物半导体它的未来前途是非常光明的。</span></p><p style=\"margin-left: 60px; text-align: left; line-height: 2em;\"><span style=\"font-size: 20px; color: rgb(0, 0, 0);\"><span style=\"color: rgb(0, 0, 0); font-size: 20px; font-family: Wingdings;\">l<span style=\"color: rgb(0, 0, 0); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp; </span></span><span style=\"color: rgb(0, 0, 0); font-size: 20px; font-family: &quot;Adobe Song Std L&quot;, serif;\">打破西方技术垄断</span></span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">另外是它的战略意义，大家知道最近中美贸易战，大家把半导体芯片提到了一个日常的话题。同样的话对于化合物半导体它有两个层面，第一个层面是在国防层面，也就是说西方的话，特别是美国，对于中国的化合物材料、器件都是禁运的。第二个从国家军口的角度来讲需求量非常大，也就是中间的缺口很大。另外是我们国家的水平和境外相比也是差距很大。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">第二个层面就是在民品领域，西方对于一些高端的化合物材料和器件也是实现了垄断和禁运。国内除了第三代的照明氮化镓，因为这个大家投资了很多，除此以外，在化合物半导体，目前还没有一个企业是可以为客户提供定制的化合物半导体材料。而超晶是希望未来成为亚洲最大的化合物半导体材料的供应商。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">最后借这个机会也跟大家作一个宣传，关于超晶科技，我们希望在材料领域，化合物半导体的材料领域成为中国乃至亚洲的一个领先的企业。同时在高端化合物芯片方面，我们也希望成为国内的供应商。最后我们希望能够保持人才与技术的先进性，能够成为国内企业里面的一个创新基地。谢谢！</span></p><p><br/></p>', '2018-06-13 10:09:04', '1');
INSERT INTO `information` VALUES ('22', '/Public/attached/2018-06-13/1528855678_thumb.png', '/Public/attached/2018-06-13/1528855678.png', '1', '半导体材料和光电子器件论坛在宁波成功举办', '<p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-size: 20px; font-family: &quot;Adobe Song Std L&quot;, serif; color: rgb(0, 0, 0);\">2018 年 5 月 11 日，由诺迪克光电产业研究院主办，超晶科技 (北京)有限公司承办的“半导体材料和光电子器件论坛”在浙江省委党校四明山分校举办。论坛由诺迪克光电产业研究院院长，超晶科技首席科学家王庶民教授主持。</span><span style=\"font-size: 20px; font-family: &quot;Adobe Song Std L&quot;, serif;\"> </span></p><p style=\"text-align:center\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px;\"><img src=\"/Uploads/ueditor/image/20180613/5b207c43299e8.png\" title=\"5b207c43299e8.png\" alt=\"图片 3.png\"/></span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">本论坛邀请了五位重量级嘉宾参会，包括国家“千人计划”专家、中科院苏州纳米所徐科教授，国家“千人计划”专家、西南技术物理研究所宋海智教授，中科院半导体所杰青牛智川教授，清华大学杰青罗毅教授，苏州长光华芯光电技术有限公司总经理廖新胜博士等。五位专家的报告涵盖了半导体激光器的发展及趋势、红外探测器的研发现状及前景、智能驾驶领域的热门技术-激光雷达、第二代半导体 GaN 的高质量单晶研发等从材料到器件的多维度领域，现场气氛积极热烈。 </span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">超晶科技首席科学家王庶民教授做了题为:VCSEL 的研发现状及趋势的报告。主要讲解了 VCSEL 的基本概念、本领域知名专家、 VCSEL 在人工智能、高速通信领域的发展前景，重点讲解了国际上 VCSEL 的研发指标，分析了我国当前技术发展与国际上技术的差距。</span></p><p style=\"line-height: 2em;\"><span style=\"font-family: &quot;Adobe Song Std L&quot;, serif; font-size: 20px; color: rgb(0, 0, 0);\">本次论坛不仅增强了超晶科技与光电材料与器件领域的科学家和企业家的互动，加深了彼此的了解，也为多方开展深层次的合作奠定了良好的基础。</span></p><p><br/></p>', '2018-06-13 10:07:46', '0');

-- ----------------------------
-- Table structure for `production`
-- ----------------------------
DROP TABLE IF EXISTS `production`;
CREATE TABLE `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(2) DEFAULT NULL COMMENT 'A是光电、B是外延',
  `name` varchar(20) DEFAULT NULL COMMENT '名称',
  `save_time` datetime DEFAULT NULL,
  `thumb_path` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(255) DEFAULT NULL COMMENT '原图地址',
  `content` longtext COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of production
-- ----------------------------
INSERT INTO `production` VALUES ('10', 'B', '材料定制', '2018-06-14 09:36:19', '/Public/attached/2018-07-05/1530753765_thumb.jpeg', '/Public/attached/2018-07-05/1530753765.jpeg', '<p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>固态源、双生长室系统</p><p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>拥有成熟的GaAs基、GaSb基材料外延技术</p><p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>可提供定制化的2英寸-4英寸III-V族化合物半导体外延片</p><p><br/></p>');
INSERT INTO `production` VALUES ('11', 'B', 'XDR衍射', '2018-06-14 10:04:54', '/Public/attached/2018-06-14/1528940638_thumb.png', '/Public/attached/2018-06-14/1528940638.png', '<p style=\"margin-left: 48px; text-align: left;\"><br/></p><p><img src=\"/Uploads/ueditor/image/20180614/5b21c7b8aaaf4.png\" title=\"5b21c7b8aaaf4.png\" alt=\"图片 1.png\"/></p><p><br/></p><p style=\"margin-left: 48px; white-space: normal; text-align: left;\"><span style=\"font-family: Wingdings;\">Ø</span>精确测定材料失配度、弛豫度、晶格常数、组分等<img src=\"/Uploads/ueditor/image/20180614/5b21cd2a36f20.png\" title=\"5b21cd2a36f20.png\" alt=\"图片 3.png\" style=\"float: right;\"/></p><p style=\"margin-left: 48px; white-space: normal; text-align: left;\"><span style=\"font-family: Wingdings;\"><br/></span></p><p style=\"margin-left: 48px; white-space: normal; text-align: left;\"><span style=\"font-family: Wingdings;\">Ø</span>可实现半导体单晶材料mapping的快速测量</p><p style=\"margin-left: 48px; white-space: normal; text-align: left;\"><span style=\"font-family: Wingdings;\"><br/></span></p><p style=\"margin-left: 48px; white-space: normal; text-align: left;\"><span style=\"font-family: Wingdings;\">Ø</span>配备PIX cel 3D矩阵探测器，Ge（220）四晶单色器&nbsp; &nbsp;</p>');
INSERT INTO `production` VALUES ('12', 'B', '光刻工艺', '2018-06-14 10:11:33', '/Public/attached/2018-06-14/1528941052_thumb.png', '/Public/attached/2018-06-14/1528941052.png', '<p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-family: Wingdings\"><img src=\"/Uploads/ueditor/image/20180614/5b21ca18924fd.png\" title=\"5b21ca18924fd.png\" alt=\"图片 2.png\" style=\"float: right;\"/></span></p><p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-size: 16px;\"><span style=\"font-family: Wingdings;\"><span style=\"font-family: Wingdings; font-size: 20px; text-align: justify;\">Ø</span><span style=\"font-family: Wingdings; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; line-height: normal; color: rgb(255, 255, 255);\">&nbsp;</span><span style=\"font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; line-height: normal;\" times=\"\" new=\"\"> </span></span>最大支持8英寸</span></p><p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-size: 16px;\"><br/></span></p><p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-size: 16px;\"><span style=\"font-size: 16px; font-family: Wingdings;\"><span style=\"font-family: Wingdings; font-size: 20px; text-align: justify;\">Ø</span><span style=\"font-size: 16px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; color: rgb(255, 255, 255);\"></span><span style=\"font-size: 16px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\" times=\"\" new=\"\"> </span></span>全自动非接触式对准曝光，无损伤光刻</span></p><p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-size: 16px;\"><br/></span></p><p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-size: 16px;\"><span style=\"font-family: Wingdings; font-size: 20px; color: rgb(255, 255, 255);\"></span><span style=\"font-size: 20px; font-family: Wingdings;\">Ø<span style=\"font-family: Wingdings; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; line-height: normal; color: rgb(255, 255, 255);\">&nbsp;&nbsp;</span></span>对准精度0.5微米</span></p><p style=\"margin-left: 48px; text-align: left;\"><br/></p><p style=\"margin-left: 48px; text-align: justify;\"><span style=\"font-size: 16px;\"><span style=\"font-size: 20px; font-family: Wingdings;\">Ø<span style=\"font-family: Wingdings; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal; color: rgb(255, 255, 255);\">&nbsp;</span><span style=\"font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 9px; line-height: normal;\" times=\"\" new=\"\"> </span></span>最小线宽1微米</span></p><p><br/></p>');
INSERT INTO `production` VALUES ('13', 'B', '扫描电子显微镜（SEM）', '2018-06-14 09:56:56', '/Public/attached/2018-06-14/1528941441_thumb.png', '/Public/attached/2018-06-14/1528941441.png', '<p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>最高放大15万倍&nbsp; &nbsp;&nbsp;<img src=\"/Uploads/ueditor/image/20180614/5b21cb2cbe9c5.png\" title=\"5b21cb2cbe9c5.png\" alt=\"图片 5.png\" style=\"float: right;\"/></p><p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\"><br/></span></p><p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>15秒快速抽真空</p><p style=\"margin-left: 48px; text-align: left;\"><br/></p><p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>高分辨率，可达8nm@10kv</p><p style=\"margin-left: 48px; text-align: left;\"><br/></p><p style=\"margin-left: 48px; text-align: left;\"><span style=\"font-family: Wingdings\">Ø<span style=\"font:9px &#39;Times New Roman&#39;\">&nbsp; </span></span>内置彩色光学显微镜</p><p><br/></p>');

-- ----------------------------
-- Table structure for `recruitment`
-- ----------------------------
DROP TABLE IF EXISTS `recruitment`;
CREATE TABLE `recruitment` (
  `id` tinyint(4) NOT NULL DEFAULT '1',
  `content` longtext COMMENT '要求',
  `save_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recruitment
-- ----------------------------
INSERT INTO `recruitment` VALUES ('1', '<p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><br/></p><p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\">我们有梦想、有实力</span></p><p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\"><br/></span></p><p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\">我们信奉“高效协作，成就彼此”</span></p><p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\"><br/></span></p><p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\">我们期待与您携手并进，创造彼此认同的价值</span></p><p><br/></p><p style=\"box-sizing: border-box; font-family: Lato, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(121, 121, 121); margin-top: 10px; margin-bottom: 10px; font-size: 18px; white-space: normal; background-color: rgb(248, 248, 248);\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\">具体招聘岗位请点击这里 【</span><a href=\"https://www.51job.com/\" target=\"_blank\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(51, 122, 183); text-decoration: underline; outline: none; font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\"><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\">前程无忧</span></a><span style=\"font-family: 楷体, 楷体_GB2312, SimKai; font-size: 24px;\">】</span></p><p><br/></p>', '2018-06-14 10:25:41');

-- ----------------------------
-- Table structure for `sheng_aboutus`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_aboutus`;
CREATE TABLE `sheng_aboutus` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `save_time` datetime DEFAULT NULL,
  `type` int(4) DEFAULT NULL COMMENT '1代表公司图，2代表资质图片',
  `thumb_path` varchar(100) DEFAULT NULL,
  `pic_path` varchar(100) DEFAULT NULL COMMENT '原图地址',
  `sortby` tinyint(1) DEFAULT NULL COMMENT '1是横排，2是竖排',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_aboutus
-- ----------------------------
INSERT INTO `sheng_aboutus` VALUES ('1', '浙江超晶晟锐光电有限公司（简称：超晶晟锐），成立于2017年1月，注册资本1亿元人民币。超晶晟锐以“引领材料方向、服务智能创造”为使命，秉承“用户至上，精益求精”的经营理念，汇聚了一批行业顶尖技术人才，提供III-V族半导体异质结材料外延片、光电器件的定制服务。', '2018-06-19 09:31:33', '1', null, null, null);
INSERT INTO `sheng_aboutus` VALUES ('2', null, '2018-06-27 15:56:02', '2', '/Public/attached/2018-06-27/1530086154_thumb.jpg', '/Public/attached/2018-06-27/1530086154.jpg', '2');

-- ----------------------------
-- Table structure for `sheng_contact`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_contact`;
CREATE TABLE `sheng_contact` (
  `id` int(11) NOT NULL DEFAULT '1',
  `words1` varchar(200) DEFAULT NULL COMMENT '欢迎语第一行',
  `words2` varchar(200) DEFAULT NULL COMMENT '欢迎语第二行',
  `company_name` varchar(100) DEFAULT NULL COMMENT '公司地址',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `telephone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_contact
-- ----------------------------
INSERT INTO `sheng_contact` VALUES ('1', '', '', '', '浙江省余姚市三七市镇二六市村云山中路 28 号千人计划产业园 3 号楼', '0574-62829926', '');

-- ----------------------------
-- Table structure for `sheng_home_image`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_home_image`;
CREATE TABLE `sheng_home_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_name` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture` varchar(100) DEFAULT NULL COMMENT '原图地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_home_image
-- ----------------------------
INSERT INTO `sheng_home_image` VALUES ('5', null, '/Public/attached/2018-06-25/1529932492.png');

-- ----------------------------
-- Table structure for `sheng_information`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_information`;
CREATE TABLE `sheng_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `information_images_path` varchar(50) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(50) DEFAULT NULL COMMENT '原图地址',
  `type` int(11) DEFAULT NULL COMMENT '1是超晶资讯；2是行业动态',
  `title` varchar(30) DEFAULT NULL,
  `content` longtext,
  `save_time` datetime DEFAULT NULL,
  `if_special` tinyint(1) DEFAULT '0' COMMENT '是否设为展板，1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_information
-- ----------------------------
INSERT INTO `sheng_information` VALUES ('1', '/Public/attached/2018-06-18/1529322486_thumb.png', '/Public/attached/2018-06-18/1529322486.png', '1', '乘风破浪潮头立，扬帆起航正当时', '<p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">8</span><span style=\"font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">月29日上午9时，浙江超晶晟锐光电有限公司”（简称：超晶晟锐）在余姚千人计划产业园正式落成，并举行了揭牌仪式。余姚市经济开发区管委会、浙江千人计划余姚产业园的各级领导、超晶科技的股东、董事代表莅临现场。</span></p><p style=\"text-align: center;\"><img src=\"/Uploads/ueditor/image/20180618/5b279b9023abc.png\" title=\"5b279b9023abc.png\" alt=\"图片 5.png\"/></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">揭牌仪式期间，余姚市经济开发区管委会主任王燎民为超晶晟锐致辞，表达了对超晶晟锐落地余姚的热烈祝贺及未来发展的美好盼望。公司首席科学家王庶民在揭牌仪式上慷慨激昂的致辞，表达了对余姚政府的感谢，也激励了超晶人脚踏实地，勇往直前的斗志。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">随后，参加活动的众位领导及嘉宾参观了超晶晟锐洁净间与办公区，并进行了座谈，交流了超晶晟锐结合行业发展对技术及产业化的规划，得到了现场领导及嘉宾的肯定。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">浙江省千人计划余姚产业园是浙江省首个“千人计划”产业园，总投资11.5亿元，总占地面积772.45公顷，肩负推进制造业智能升级的使命。其中，重点发展以新材料、高端装备和新一代信息技术为代表的三大战略性产业，推动实现余姚工业强市战略。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 2em;\"><span style=\"font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">超晶晟锐落地浙江省千人计划余姚产业园是超晶科技发展历程上迈出的战略性一步，为公司技术突破、产业化发展奠定了坚实的基础，将成为公司引进科技、市场、政府、人才等资源的良好依托。同时，超晶晟锐的落地也为浙江省千人计划余姚产业园注入了新的动力，将成为浙江省各级政府关注的焦点。</span></p><p style=\"line-height: 2em;\"><span style=\"font-size:16px;font-family:&#39;Adobe Song Std L&#39;,&#39;serif&#39;\">乘风破浪潮头立，扬帆起航正当时，我们相信，随着公司的踏实奋进，必将实现成为中国高端化合物半导体材料与光电器件领军企业的愿景。</span></p><p><br/></p>', '2018-06-19 10:38:07', '1');

-- ----------------------------
-- Table structure for `sheng_production`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_production`;
CREATE TABLE `sheng_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(2) DEFAULT NULL COMMENT 'A是光电、B是外延',
  `name` varchar(20) DEFAULT NULL COMMENT '名称',
  `save_time` datetime DEFAULT NULL,
  `thumb_path` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(255) DEFAULT NULL COMMENT '原图地址',
  `content` longtext COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_production
-- ----------------------------
INSERT INTO `sheng_production` VALUES ('1', 'B', '材料定制', '2018-06-19 10:47:56', '/Public/attached/2018-06-18/1529333018_thumb.png', '/Public/attached/2018-06-18/1529333018.png', '<p><br/></p><p><br/></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">固态源、双生长室系统</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">拥有成熟的GaAs基、GaSb基材料外延技术</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">可提供定制化的2英寸-4英寸III-V族化合物半导体外延片</span></p><p><span style=\"font-family: DengXian;\"></span><br/></p><p><span style=\"font-size:16px;font-family:DengXian\"><br/></span></p>');
INSERT INTO `sheng_production` VALUES ('2', 'B', 'XDR衍射', '2018-06-19 10:47:34', '/Public/attached/2018-06-18/1529333130_thumb.png', '/Public/attached/2018-06-18/1529333130.png', '<p><br/></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">精确测定材料失配度、弛豫度、晶格常数、组分等</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">可实现半导体单晶材料mapping的快速测量</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">配备PIX cel 3D矩阵探测器，Ge（220）四晶单色器</span></p><p><br/></p>');
INSERT INTO `sheng_production` VALUES ('3', 'B', '光刻工艺', '2018-06-19 10:47:16', '/Public/attached/2018-06-18/1529333223_thumb.png', '/Public/attached/2018-06-18/1529333223.png', '<p><br/></p><p><br/></p><p><br/></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">最大支持8英寸</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">全自动非接触式对准曝光，无损伤光刻</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">对准精度0.5微米</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">最小线宽1微米</span></p><p><br/></p>');
INSERT INTO `sheng_production` VALUES ('4', 'B', '扫描电子显微镜（SEM）', '2018-06-19 10:46:42', '/Public/attached/2018-06-18/1529333350_thumb.png', '/Public/attached/2018-06-18/1529333350.png', '<p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">最高放大15万倍<br/></span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">15秒快速抽真空</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">高分辨率，可达8nm@10kv</span></p><p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;\">内置彩色光学显微镜</span></p>');

-- ----------------------------
-- Table structure for `sheng_recruitment`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_recruitment`;
CREATE TABLE `sheng_recruitment` (
  `id` tinyint(4) NOT NULL DEFAULT '1',
  `content` longtext COMMENT '要求',
  `save_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_recruitment
-- ----------------------------
INSERT INTO `sheng_recruitment` VALUES ('1', '<p style=\"text-indent: 32px; text-align: left; line-height: 3em;\"><span style=\"font-size: 20px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; color: rgb(0, 0, 0);\">投资人眼中的黄金项目，汇聚行业顶尖技术大咖。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 3em;\"><span style=\"font-size: 20px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; color: rgb(0, 0, 0);\">年轻的团队，追求“高效、务实、公平”。</span></p><p style=\"text-indent: 32px; text-align: left; line-height: 3em;\"><span style=\"font-size: 20px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; color: rgb(0, 0, 0);\">公司位于浙江省第一家千人计划产业园区，园区集聚优质高科技公司及人才，创业、创新氛围浓郁。</span></p><p><br/></p><p style=\"line-height: 3em;\"><span style=\"font-size: 20px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; color: rgb(0, 0, 0);\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;具体招聘岗位请点击这里 【<a href=\"https://www.51job.com/\" target=\"_blank\">前程无忧</a>】</span></p><p><br/></p>', '2018-06-19 09:42:47');

-- ----------------------------
-- Table structure for `sheng_yuangong_picture`
-- ----------------------------
DROP TABLE IF EXISTS `sheng_yuangong_picture`;
CREATE TABLE `sheng_yuangong_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(3) DEFAULT NULL COMMENT '从左到右ABC',
  `thumb_path` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(100) DEFAULT NULL COMMENT '原图地址',
  `save_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sheng_yuangong_picture
-- ----------------------------

-- ----------------------------
-- Table structure for `yuangong_picture`
-- ----------------------------
DROP TABLE IF EXISTS `yuangong_picture`;
CREATE TABLE `yuangong_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(3) DEFAULT NULL COMMENT '从左到右ABC',
  `thumb_path` varchar(100) DEFAULT NULL COMMENT '缩略图地址',
  `picture_path` varchar(100) DEFAULT NULL COMMENT '原图地址',
  `save_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yuangong_picture
-- ----------------------------
INSERT INTO `yuangong_picture` VALUES ('17', '1', '/Public/attached/2018-06-27/1530090730_thumb.jpg', '/Public/attached/2018-06-27/1530090730.jpg', '2018-06-27 17:12:12');
INSERT INTO `yuangong_picture` VALUES ('18', '1', '/Public/attached/2018-06-27/1530093610_thumb.jpg', '/Public/attached/2018-06-27/1530093610.jpg', '2018-06-27 18:00:17');
INSERT INTO `yuangong_picture` VALUES ('19', '1', '/Public/attached/2018-06-27/1530094864_thumb.JPG', '/Public/attached/2018-06-27/1530094864.JPG', '2018-06-27 18:21:11');
