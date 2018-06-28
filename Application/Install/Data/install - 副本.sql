SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pay_apimoney
-- ----------------------------
DROP TABLE IF EXISTS `pay_apimoney`;
CREATE TABLE `pay_apimoney` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `payapiid` int(11) DEFAULT NULL,
  `money` decimal(15,3) NOT NULL DEFAULT '0.000',
  `freezemoney` decimal(15,3) NOT NULL DEFAULT '0.000' COMMENT '冻结金额',
  `status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_apimoney
-- ----------------------------
INSERT INTO `pay_apimoney` VALUES ('1', '7', '163', '1.800', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('2', '7', '144', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('3', '7', '137', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('4', '7', '138', '0.200', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('5', '7', '158', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('6', '7', '161', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('7', '7', '166', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('8', '7', '167', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('9', '7', '168', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('10', '7', '169', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('11', '7', '170', '0.010', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('12', '19', '137', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('13', '19', '138', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('14', '19', '157', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('15', '19', '158', '0.000', '0.000', '1');
INSERT INTO `pay_apimoney` VALUES ('16', '19', '159', '0.000', '0.000', '1');

-- ----------------------------
-- Table structure for pay_article
-- ----------------------------
DROP TABLE IF EXISTS `pay_article`;
CREATE TABLE `pay_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `content` text,
  `userid` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `articleclassid` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `jieshouuserlist` varchar(1000) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_article
-- ----------------------------
INSERT INTO `pay_article` VALUES ('41', '清明小长假首日 高速公路或现车流“井喷”', '&lt;p&gt;&lt;span style=&quot;font-family: 宋体, Arial, sans-serif; text-indent: 32px; background-color: rgb(255, 255, 255);&quot;&gt;今天是清明小长假首日，路政部门提醒，节日三天里高速公路实行小型客车免费通行，扫墓大军与踏青赏花出游车流汇集，高速公路与景区、墓区周边道路或面临车流“井喷”之势。6：00-12：00时为扫墓车流出发高峰时段，12：00-16：00时为返程高峰时段；大家的出行方向相对集中，主要是市区往近郊方向呈放射性的流动。&lt;/span&gt;&lt;/p&gt;', '1', '2017-04-03 00:20:14', '1', '0', '0|');
INSERT INTO `pay_article` VALUES ('42', '申城今明两天阳光 4日夜间开启“雨纷纷”', '&lt;p&gt;&lt;span style=&quot;font-family: 宋体, Arial, sans-serif; text-indent: 32px; background-color: rgb(255, 255, 255);&quot;&gt;清明小长假第一天，上海晴到多云，最高温度21℃，适宜踏青祭扫，就是风力比较大，为西北到西风天4-5级。好天气会持续至清明小长假最后一天，清明节当天夜里申城会开启“雨纷纷”模式。&lt;/span&gt;&lt;/p&gt;', '1', '2017-04-03 00:21:58', '1', '0', '0|');
INSERT INTO `pay_article` VALUES ('43', '上海抽检75批次青团 其中有1批次不合格', '&lt;p&gt;&lt;span style=&quot;font-family: 宋体, Arial, sans-serif; text-indent: 32px; background-color: rgb(255, 255, 255);&quot;&gt;据上海发布消息，清明将至，青团要美味，更要安全。上海食药监对本市生产经营的青团进行了监督检查，有74件符合食品安全标准。其中在本市流通市场及餐饮服务单位抽检合格率均为100%，1件不合格的是在上海长阳面包厂有限公司抽样的该企业生产的蛋黄肉松青团（生产日期/批号：20170313；规格型号：90克/袋），不合格指标为菌落总数，该企业已被依法查处。&lt;/span&gt;&lt;/p&gt;', '1', '2017-04-03 00:22:23', '1', '0', '0|');
INSERT INTO `pay_article` VALUES ('44', '沪2017医保年度开始 当年、历年账户这样结算', '&lt;p&gt;&lt;span style=&quot;font-family: 宋体, Arial, sans-serif; text-indent: 32px; background-color: rgb(255, 255, 255);&quot;&gt;每年4月1日，上海市民医保账户里的“当年账户”和“历年账户”都会结算一次。2017医保年度，上海在职职工和退休职工个人医保账户资金注入均有提高，最高增加额达315元。现在登录“上海医保网”查询，就能在“个人账户清算信息”里看到详细的清算信息表格。&lt;/span&gt;&lt;/p&gt;', '1', '2017-04-03 00:22:47', '1', '0', '0|');
INSERT INTO `pay_article` VALUES ('45', 'G1501长江隧道出口至高东收费站应急车道可通行', '&lt;p&gt;&lt;span style=&quot;font-family: 宋体, Arial, sans-serif; text-indent: 32px; background-color: rgb(255, 255, 255);&quot;&gt;清明外出祭扫的市民们注意！市公安局交警总队说，为缓解交通拥堵，清明小长假期间，G1501（上海绕城高速公路）长江隧道出口处至高东收费站近2公里道路的应急车道将临时“变身”普通车道。过往车辆可使用最右车道快速通过。提示：小长假一过，最右车道仍将作为应急车道使用哦！&lt;/span&gt;&lt;/p&gt;', '1', '2017-04-03 00:23:07', '1', '0', '0|');
INSERT INTO `pay_article` VALUES ('46', '2017新支付', '&lt;p&gt;2017新支付&lt;/p&gt;', '1', '2017-04-03 12:51:55', '2', '0', '0|');

-- ----------------------------
-- Table structure for pay_articleclass
-- ----------------------------
DROP TABLE IF EXISTS `pay_articleclass`;
CREATE TABLE `pay_articleclass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classname` varchar(100) NOT NULL,
  `fatherid` int(11) NOT NULL DEFAULT '0',
  `delonoff` smallint(6) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_articleclass
-- ----------------------------
INSERT INTO `pay_articleclass` VALUES ('1', '公告', '0', '1', '0', '0', null);
INSERT INTO `pay_articleclass` VALUES ('2', '弹窗公告', '0', '1', '0', '0', null);
INSERT INTO `pay_articleclass` VALUES ('3', '新闻', '0', '1', '0', '0', null);
INSERT INTO `pay_articleclass` VALUES ('7', '联系我们', '0', '0', '1', '0', '&lt;p&gt;sgdsaggsag&lt;/p&gt;&lt;p&gt;sgsadgsa&lt;/p&gt;&lt;p&gt;gsag&lt;/p&gt;&lt;p&gt;asgsa&lt;/p&gt;&lt;p&gt;gsa&lt;/p&gt;&lt;p&gt;gasg&lt;/p&gt;&lt;p&gt;asg&lt;/p&gt;&lt;p&gt;sag&lt;br/&gt;&lt;/p&gt;');
INSERT INTO `pay_articleclass` VALUES ('8', '关于我们', '0', '0', '1', '0', null);

-- ----------------------------
-- Table structure for pay_bankcard
-- ----------------------------
DROP TABLE IF EXISTS `pay_bankcard`;
CREATE TABLE `pay_bankcard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `bankfullname` varchar(100) DEFAULT NULL,
  `banknumber` varchar(100) DEFAULT NULL,
  `bankname` varchar(100) DEFAULT NULL,
  `bankfenname` varchar(100) DEFAULT NULL,
  `bankzhiname` varchar(100) DEFAULT NULL,
  `shi` varchar(100) DEFAULT NULL,
  `sheng` varchar(100) DEFAULT NULL,
  `kdatetime` datetime DEFAULT NULL,
  `jdatetime` datetime DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `ipaddress` varchar(300) DEFAULT NULL,
  `disabled` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_bankcard
-- ----------------------------
INSERT INTO `pay_bankcard` VALUES ('6', '6', 'dddddddddddddd', 'ddddddddddddddddd', '华夏银行', 'fdddddddddd', null, null, null, null, null, null, null, '1');
INSERT INTO `pay_bankcard` VALUES ('9', '8', '', '', '北京银行', '', null, '', '', null, '2014-08-16 01:27:01', null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('10', '9', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('12', '11', '', '', '东亚银行', '', null, '', '', '2014-09-10 01:58:27', '2014-11-02 02:39:47', '127.0.0.1', '本机地址-', '0');
INSERT INTO `pay_bankcard` VALUES ('13', '12', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('14', '13', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('15', '14', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('16', '14', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('17', '15', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('18', '16', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('19', '3', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('20', '4', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('21', '5', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('22', '6', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('23', '7', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('24', '8', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('25', '9', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('26', '17', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('27', '18', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('28', '19', '123', '123', '中国工商银行', 'asd', 'as', '上海市', '上海', '2017-04-10 10:30:37', '2017-05-20 10:30:37', '61.172.10.14', '上海市嘉定区-电信ADSL', '0');
INSERT INTO `pay_bankcard` VALUES ('29', '20', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('30', '21', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('31', '22', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('32', '23', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('33', '24', null, null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `pay_bankcard` VALUES ('34', '25', null, null, null, null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for pay_browserecord
-- ----------------------------
DROP TABLE IF EXISTS `pay_browserecord`;
CREATE TABLE `pay_browserecord` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_browserecord
-- ----------------------------
INSERT INTO `pay_browserecord` VALUES ('3', '12', '7', '2014-11-27 05:06:12');
INSERT INTO `pay_browserecord` VALUES ('4', '12', '7', '2014-11-27 05:06:53');
INSERT INTO `pay_browserecord` VALUES ('5', '11', '7', '2014-11-27 05:07:59');
INSERT INTO `pay_browserecord` VALUES ('6', '12', '7', '2014-11-27 05:08:43');
INSERT INTO `pay_browserecord` VALUES ('7', '11', '7', '2014-11-27 05:08:46');
INSERT INTO `pay_browserecord` VALUES ('8', '8', '7', '2014-11-27 05:08:49');
INSERT INTO `pay_browserecord` VALUES ('9', '12', '7', '2014-11-27 05:24:39');
INSERT INTO `pay_browserecord` VALUES ('10', '11', '7', '2014-11-27 11:55:28');
INSERT INTO `pay_browserecord` VALUES ('11', '10', '7', '2014-11-30 00:16:51');
INSERT INTO `pay_browserecord` VALUES ('12', '11', '7', '2014-11-30 00:16:54');
INSERT INTO `pay_browserecord` VALUES ('13', '11', '7', '2014-11-30 05:24:54');
INSERT INTO `pay_browserecord` VALUES ('14', '9', '7', '2014-11-30 05:24:57');
INSERT INTO `pay_browserecord` VALUES ('15', '12', '7', '2014-11-30 05:28:48');
INSERT INTO `pay_browserecord` VALUES ('16', '11', '7', '2014-11-30 05:28:51');
INSERT INTO `pay_browserecord` VALUES ('17', '40', '7', '2014-12-27 03:08:06');
INSERT INTO `pay_browserecord` VALUES ('18', '38', '7', '2014-12-27 03:08:13');
INSERT INTO `pay_browserecord` VALUES ('19', '39', '7', '2014-12-27 03:08:15');
INSERT INTO `pay_browserecord` VALUES ('20', '37', '7', '2014-12-30 03:44:49');
INSERT INTO `pay_browserecord` VALUES ('21', '36', '7', '2014-12-30 03:45:06');
INSERT INTO `pay_browserecord` VALUES ('22', '18', '7', '2015-02-11 04:07:19');
INSERT INTO `pay_browserecord` VALUES ('23', '40', '7', '2015-04-07 23:30:29');
INSERT INTO `pay_browserecord` VALUES ('24', '41', '0', '2017-04-03 00:20:14');
INSERT INTO `pay_browserecord` VALUES ('25', '42', '0', '2017-04-03 00:21:58');
INSERT INTO `pay_browserecord` VALUES ('26', '43', '0', '2017-04-03 00:22:23');
INSERT INTO `pay_browserecord` VALUES ('27', '44', '0', '2017-04-03 00:22:47');
INSERT INTO `pay_browserecord` VALUES ('28', '45', '0', '2017-04-03 00:23:07');
INSERT INTO `pay_browserecord` VALUES ('29', '46', '0', '2017-04-03 12:51:55');
INSERT INTO `pay_browserecord` VALUES ('30', '45', '19', '2017-04-03 13:33:47');
INSERT INTO `pay_browserecord` VALUES ('31', '45', '19', '2017-04-03 15:27:38');

-- ----------------------------
-- Table structure for pay_email
-- ----------------------------
DROP TABLE IF EXISTS `pay_email`;
CREATE TABLE `pay_email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `smtp_host` varchar(300) DEFAULT NULL,
  `smtp_port` varchar(300) DEFAULT NULL,
  `smtp_user` varchar(300) DEFAULT NULL,
  `smtp_pass` varchar(300) DEFAULT NULL,
  `smtp_email` varchar(300) DEFAULT NULL,
  `smtp_name` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_email
-- ----------------------------
INSERT INTO `pay_email` VALUES ('1', '0', 'smtp.qq.com', '465', '79808370@qq.com', 'wawcycvumrowbhag', '79808370@qq.com', '支付平台');

-- ----------------------------
-- Table structure for pay_invitecode
-- ----------------------------
DROP TABLE IF EXISTS `pay_invitecode`;
CREATE TABLE `pay_invitecode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invitecode` varchar(32) NOT NULL,
  `fmusernameid` int(11) unsigned NOT NULL DEFAULT '0',
  `syusernameid` int(11) NOT NULL DEFAULT '0',
  `regtype` int(11) NOT NULL DEFAULT '4',
  `fbdatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `yxdatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `sydatetime` int(11) unsigned DEFAULT '0',
  `inviteconfigzt` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitecode` (`invitecode`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_invitecode
-- ----------------------------
INSERT INTO `pay_invitecode` VALUES ('12', '97xThB1Cz4OoV7y9OrdKW7HbmMDdeC', '1', '17', '4', '1491146221', '1491148800', '1491146782', '2');
INSERT INTO `pay_invitecode` VALUES ('13', 'XSR1xQqTuBAOflNTaGVJsShJe9ihpj', '1', '18', '4', '1491147225', '1491148800', '1491147268', '2');
INSERT INTO `pay_invitecode` VALUES ('5', 'Icrt3mdyaiwKtR9sEqqL9a43jU4qHI', '1', '7', '4', '1491064074', '1491148800', '1491069586', '2');
INSERT INTO `pay_invitecode` VALUES ('6', 'f2yOFZJcqjxzVYBITX1WKEVQbYycM5', '1', '8', '4', '1491069805', '1491148800', '1491069829', '2');
INSERT INTO `pay_invitecode` VALUES ('7', 'kqkPFdRhF4mHxbuGKnTrTUBOhh8BUR', '1', '9', '4', '1491100066', '1491148800', '1491100145', '2');
INSERT INTO `pay_invitecode` VALUES ('14', '8dCbyzAO1GasJ5Ycqtc4apoLIszGVs', '1', '19', '4', '1491149144', '1491235200', '1491149186', '2');
INSERT INTO `pay_invitecode` VALUES ('23', 'zRZQ7voR12Bwx2VIcFfMi2Y3kkwz2S', '1', '0', '4', '1491196956', '1491235200', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('22', '6qkHxq9cClyCbh8mHcBvGfaIgOCnju', '1', '0', '4', '1491196907', '1491235200', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('24', 'vYpIZhhM4LKGATPsuNwIrVrlIPWzQU', '1', '0', '4', '1491197037', '1491235200', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('25', 'Wlltmcb6IFJjZQ5aWKrV8ktlyrV6jo', '1', '0', '4', '1491197286', '1491235200', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('26', '3y3caWLuxezJnOk8WkLEawlaHgd7WU', '1', '0', '4', '1491197358', '1491235200', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('27', 'LEto8DDFVYHNssNQH44ZxozYWxkg6j', '7', '0', '4', '1491199837', '1491235200', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('28', 'GJhipszCqCRrFQTH5vQvOB3GZnBBb7', '19', '20', '4', '1491235513', '1491321600', '1491235668', '2');
INSERT INTO `pay_invitecode` VALUES ('29', 'gElczzSWWpznTeXFPdyDbxgPNCvZb8', '1', '21', '4', '1491317272', '1491321600', '1491317286', '2');
INSERT INTO `pay_invitecode` VALUES ('30', 'um7KnpqaAapwrMjjqg4R5qh88zvLjZ', '1', '22', '4', '1491319745', '1491321600', '1491319789', '2');
INSERT INTO `pay_invitecode` VALUES ('31', 'ALP9duzS6BpSJgzRevRPY2iqFSxi4v', '1', '23', '4', '1491320343', '1491321600', '1491320387', '2');
INSERT INTO `pay_invitecode` VALUES ('32', 'k7IuU11htdy9AVSNZZFOzRIlSqUVkz', '1', '24', '4', '1491539877', '1491580800', '1491540040', '2');
INSERT INTO `pay_invitecode` VALUES ('33', 'SYMhPSCV2wLORE6ZrClUigccU6LsTp', '24', '25', '4', '1492017189', '1492099200', '1492017227', '2');
INSERT INTO `pay_invitecode` VALUES ('34', 'SXBtGRVpcHO5PhccFbxiWUzsz39JfL', '1', '0', '4', '1492254180', '1492272000', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('35', 'ihscRCuWHBKhpOIqlWH7kOXLKH6xKc', '1', '0', '4', '1492414217', '1492444800', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('38', 'kQPlSEOXLzbaQraYNw2JnJnTKe9tRV', '1', '0', '5', '1492414670', '1492444800', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('39', 'WyuKrMj6urEJGR7PNNeF1SbyZEvgNP', '19', '0', '4', '1494301533', '1494345600', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('40', 'BB21uauc2YBODn58qc7pg3qeKiPJCf', '19', '0', '4', '1494485745', '1494518400', '0', '1');
INSERT INTO `pay_invitecode` VALUES ('41', 'EjgWacbaJJXD8HXkKAvKruLKu1oRSw', '19', '0', '4', '1494839689', '1494864000', '0', '1');

-- ----------------------------
-- Table structure for pay_inviteconfig
-- ----------------------------
DROP TABLE IF EXISTS `pay_inviteconfig`;
CREATE TABLE `pay_inviteconfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invitezt` smallint(6) DEFAULT '1',
  `invitetype2number` int(11) NOT NULL DEFAULT '20',
  `invitetype2ff` smallint(6) NOT NULL DEFAULT '1',
  `invitetype5number` int(11) NOT NULL DEFAULT '20',
  `invitetype5ff` smallint(6) NOT NULL DEFAULT '1',
  `invitetype6number` int(11) NOT NULL DEFAULT '20',
  `invitetype6ff` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_inviteconfig
-- ----------------------------
INSERT INTO `pay_inviteconfig` VALUES ('1', '1', '100', '0', '100', '0', '100', '0');

-- ----------------------------
-- Table structure for pay_loginrecord
-- ----------------------------
DROP TABLE IF EXISTS `pay_loginrecord`;
CREATE TABLE `pay_loginrecord` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `logindatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loginip` varchar(100) NOT NULL,
  `loginaddress` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_loginrecord
-- ----------------------------
INSERT INTO `pay_loginrecord` VALUES ('1', '20', '2017-04-15 14:17:13', '223.211.255.22', '广东省深圳市-天威宽频');
INSERT INTO `pay_loginrecord` VALUES ('2', '1', '2017-04-15 14:18:18', '223.211.255.22', '广东省深圳市-天威宽频');
INSERT INTO `pay_loginrecord` VALUES ('3', '19', '2017-04-15 14:45:30', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('4', '1', '2017-04-15 14:58:51', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('5', '19', '2017-04-15 15:04:10', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('6', '1', '2017-04-16 07:41:42', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('7', '1', '2017-04-16 15:20:24', '119.36.144.126', '湖北省-联通');
INSERT INTO `pay_loginrecord` VALUES ('8', '19', '2017-04-16 15:47:18', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('9', '1', '2017-04-17 02:31:29', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('10', '1', '2017-04-17 02:33:32', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('11', '1', '2017-04-17 02:36:21', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('12', '1', '2017-04-17 02:48:28', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('13', '1', '2017-04-17 03:02:56', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('14', '1', '2017-04-17 03:03:02', '61.172.10.14', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('15', '1', '2017-04-17 03:35:51', '223.211.255.31', '广东省深圳市-天威宽频');
INSERT INTO `pay_loginrecord` VALUES ('16', '1', '2017-04-17 03:36:16', '223.211.255.31', '广东省深圳市-天威宽频');
INSERT INTO `pay_loginrecord` VALUES ('17', '1', '2017-04-17 04:34:50', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('18', '1', '2017-04-17 04:34:55', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('19', '1', '2017-04-17 04:35:39', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('20', '1', '2017-04-17 04:41:22', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('21', '1', '2017-04-17 04:41:33', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('22', '1', '2017-04-17 04:46:04', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('23', '1', '2017-04-17 04:47:37', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('24', '1', '2017-04-17 04:47:42', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('25', '1', '2017-04-17 04:49:13', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('26', '1', '2017-04-17 04:49:18', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('27', '1', '2017-04-17 04:51:07', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('28', '1', '2017-04-17 04:51:12', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('29', '1', '2017-04-17 04:52:04', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('30', '1', '2017-04-17 04:52:08', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('31', '1', '2017-04-17 04:54:02', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('32', '1', '2017-04-17 04:54:06', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('33', '1', '2017-04-17 05:02:55', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('34', '1', '2017-04-17 05:03:12', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('35', '1', '2017-04-17 05:49:10', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('36', '1', '2017-04-17 05:49:15', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('37', '1', '2017-04-17 07:29:55', '223.211.255.31', '广东省深圳市-天威宽频');
INSERT INTO `pay_loginrecord` VALUES ('38', '1', '2017-04-17 07:30:09', '223.211.255.31', '广东省深圳市-天威宽频');
INSERT INTO `pay_loginrecord` VALUES ('39', '1', '2017-04-18 02:32:29', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('40', '1', '2017-04-18 02:32:35', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('41', '1', '2017-04-18 07:02:14', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('42', '1', '2017-04-18 07:02:24', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('43', '7', '2017-04-18 07:03:13', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('44', '1', '2017-04-18 08:38:52', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('45', '1', '2017-04-18 08:38:56', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('46', '1', '2017-04-18 13:37:30', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('47', '1', '2017-04-18 13:37:40', '221.239.227.194', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('48', '1', '2017-04-19 05:12:13', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('49', '1', '2017-04-19 05:12:18', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('50', '1', '2017-04-20 07:45:13', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('51', '1', '2017-04-20 07:45:17', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('52', '1', '2017-04-20 08:43:32', '140.240.20.82', '海南省-电信');
INSERT INTO `pay_loginrecord` VALUES ('53', '1', '2017-04-20 08:43:41', '140.240.20.82', '海南省-电信');
INSERT INTO `pay_loginrecord` VALUES ('54', '1', '2017-04-20 12:33:18', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('55', '1', '2017-04-20 12:33:22', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('56', '7', '2017-04-21 04:01:33', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('57', '19', '2017-04-21 04:02:09', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('58', '1', '2017-04-21 09:26:52', '125.84.185.181', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('59', '1', '2017-04-21 09:27:00', '125.84.185.181', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('60', '1', '2017-04-21 10:07:38', '125.84.185.181', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('61', '1', '2017-04-21 10:07:48', '125.84.185.181', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('62', '19', '2017-04-21 10:08:54', '125.84.185.181', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('63', '1', '2017-04-22 03:00:38', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('64', '1', '2017-04-22 03:00:43', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('65', '1', '2017-04-22 16:03:09', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('66', '1', '2017-04-22 16:03:17', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('67', '1', '2017-04-23 15:19:28', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('68', '1', '2017-04-23 15:19:34', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('69', '1', '2017-04-24 02:29:23', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('70', '1', '2017-04-24 02:29:27', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('71', '1', '2017-04-25 02:16:35', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('72', '1', '2017-04-25 02:17:00', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('73', '1', '2017-04-25 04:19:42', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('74', '19', '2017-04-26 01:34:43', '114.239.72.60', '江苏省宿迁市-电信');
INSERT INTO `pay_loginrecord` VALUES ('75', '1', '2017-04-26 01:38:39', '125.84.187.165', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('76', '1', '2017-04-26 01:39:00', '125.84.187.165', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('77', '1', '2017-04-26 01:56:36', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('78', '1', '2017-04-26 01:56:41', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('79', '19', '2017-04-26 07:42:59', '223.104.176.6', '中国-移动');
INSERT INTO `pay_loginrecord` VALUES ('80', '1', '2017-04-26 07:47:13', '223.104.176.6', '中国-移动');
INSERT INTO `pay_loginrecord` VALUES ('81', '1', '2017-04-26 07:47:30', '223.104.176.6', '中国-移动');
INSERT INTO `pay_loginrecord` VALUES ('82', '1', '2017-04-26 09:17:20', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('83', '1', '2017-04-26 10:56:17', '119.117.205.137', '辽宁省锦州市-联通');
INSERT INTO `pay_loginrecord` VALUES ('84', '1', '2017-04-26 10:56:29', '119.117.205.137', '辽宁省锦州市-联通');
INSERT INTO `pay_loginrecord` VALUES ('85', '1', '2017-04-26 14:40:36', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('86', '1', '2017-04-26 14:52:56', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('87', '1', '2017-04-26 14:55:16', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('88', '1', '2017-04-26 14:57:19', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('89', '1', '2017-04-26 14:58:48', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('90', '1', '2017-04-26 15:01:30', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('91', '1', '2017-04-26 15:08:42', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('92', '1', '2017-04-26 15:10:43', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('93', '1', '2017-04-26 15:11:37', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('94', '1', '2017-04-26 15:13:18', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('95', '1', '2017-04-26 15:14:56', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('96', '1', '2017-04-26 15:17:56', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('97', '1', '2017-04-26 15:21:44', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('98', '1', '2017-04-26 15:22:31', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('99', '1', '2017-04-26 15:26:10', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('100', '1', '2017-04-26 15:27:13', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('101', '1', '2017-04-26 15:28:51', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('102', '1', '2017-04-26 15:30:42', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('103', '1', '2017-04-26 15:32:36', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('104', '1', '2017-04-26 15:32:55', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('105', '1', '2017-04-26 15:34:13', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('106', '1', '2017-04-26 15:34:54', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('107', '1', '2017-04-26 15:35:54', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('108', '1', '2017-04-26 15:37:06', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('109', '1', '2017-04-26 15:47:33', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('110', '1', '2017-04-26 15:51:54', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('111', '1', '2017-04-26 15:59:34', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('112', '1', '2017-04-26 16:04:35', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('113', '1', '2017-04-26 16:06:54', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('114', '1', '2017-04-27 00:45:19', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('115', '1', '2017-04-27 02:29:23', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('116', '19', '2017-04-27 03:22:17', '117.136.5.36', '辽宁省-移动(全省通用)');
INSERT INTO `pay_loginrecord` VALUES ('117', '1', '2017-04-27 03:48:19', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('118', '1', '2017-04-27 08:08:27', '58.39.245.95', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('119', '1', '2017-04-27 11:36:42', '140.243.235.254', '福建省-联通');
INSERT INTO `pay_loginrecord` VALUES ('120', '19', '2017-04-27 11:53:33', '140.243.235.254', '福建省-联通');
INSERT INTO `pay_loginrecord` VALUES ('121', '19', '2017-04-29 07:34:19', '117.136.11.23', '福建省-移动(全省通用)');
INSERT INTO `pay_loginrecord` VALUES ('122', '19', '2017-05-02 03:42:20', '211.97.128.232', '福建省厦门市-联通');
INSERT INTO `pay_loginrecord` VALUES ('123', '19', '2017-05-02 06:33:59', '125.84.191.130', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('124', '19', '2017-05-05 01:29:57', '125.84.189.170', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('125', '19', '2017-05-05 01:32:43', '121.34.34.185', '广东省深圳市南山区-电信');
INSERT INTO `pay_loginrecord` VALUES ('126', '19', '2017-05-05 12:30:01', '211.97.129.182', '福建省厦门市-联通');
INSERT INTO `pay_loginrecord` VALUES ('127', '19', '2017-05-05 16:58:41', '112.111.146.174', '福建省龙岩市-联通');
INSERT INTO `pay_loginrecord` VALUES ('128', '19', '2017-05-06 05:26:21', '110.87.90.248', '福建省厦门市-电信');
INSERT INTO `pay_loginrecord` VALUES ('129', '1', '2017-05-06 07:53:24', '116.224.136.77', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('130', '1', '2017-05-06 15:38:49', '183.37.245.13', '广东省深圳市-电信');
INSERT INTO `pay_loginrecord` VALUES ('131', '1', '2017-05-07 14:50:58', '116.224.136.77', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('132', '1', '2017-05-08 03:42:37', '116.224.136.77', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('133', '1', '2017-05-08 09:25:06', '114.95.46.55', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('134', '1', '2017-05-08 10:08:38', '114.95.46.55', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('135', '19', '2017-05-09 03:44:36', '112.111.146.174', '福建省龙岩市-联通');
INSERT INTO `pay_loginrecord` VALUES ('136', '19', '2017-05-09 04:06:03', '219.131.204.56', '广东省珠海市-广东科学技术职业学院(珠海校区)');
INSERT INTO `pay_loginrecord` VALUES ('137', '1', '2017-05-09 04:22:14', '125.84.185.89', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('138', '1', '2017-05-09 10:03:40', '114.95.46.55', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('139', '19', '2017-05-10 06:11:45', '61.154.201.200', '福建省厦门市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('140', '19', '2017-05-11 06:51:00', '125.84.184.105', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('141', '1', '2017-05-11 06:51:07', '119.79.25.251', '中国-科技网');
INSERT INTO `pay_loginrecord` VALUES ('142', '19', '2017-05-11 06:53:56', '119.79.25.251', '中国-科技网');
INSERT INTO `pay_loginrecord` VALUES ('143', '1', '2017-05-11 06:54:03', '125.84.184.105', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('144', '1', '2017-05-11 07:05:43', '119.79.25.251', '中国-科技网');
INSERT INTO `pay_loginrecord` VALUES ('145', '1', '2017-05-12 06:48:35', '114.95.46.55', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('146', '1', '2017-05-12 07:44:29', '114.95.46.55', '上海市嘉定区-电信');
INSERT INTO `pay_loginrecord` VALUES ('147', '19', '2017-05-13 10:00:39', '60.176.63.92', '浙江省杭州市-电信');
INSERT INTO `pay_loginrecord` VALUES ('148', '19', '2017-05-14 07:13:12', '60.186.172.144', '浙江省杭州市-电信');
INSERT INTO `pay_loginrecord` VALUES ('149', '1', '2017-05-15 03:16:32', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('150', '1', '2017-05-15 05:12:57', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('151', '19', '2017-05-15 09:08:03', '125.84.190.168', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('152', '1', '2017-05-15 09:09:53', '125.84.190.168', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('153', '19', '2017-05-15 09:11:15', '115.218.9.243', '浙江省温州市-电信');
INSERT INTO `pay_loginrecord` VALUES ('154', '1', '2017-05-15 09:18:24', '115.218.9.243', '浙江省温州市-电信');
INSERT INTO `pay_loginrecord` VALUES ('155', '19', '2017-05-16 11:23:10', '120.85.87.163', '广东省广州市-联通');
INSERT INTO `pay_loginrecord` VALUES ('156', '1', '2017-05-16 11:34:10', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('157', '1', '2017-05-17 02:22:08', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('158', '1', '2017-05-17 12:57:25', '119.36.144.126', '湖北省-联通');
INSERT INTO `pay_loginrecord` VALUES ('159', '1', '2017-05-18 17:17:06', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('160', '1', '2017-05-19 01:32:46', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('161', '19', '2017-05-19 04:39:56', '171.43.218.42', '湖北省-电信');
INSERT INTO `pay_loginrecord` VALUES ('162', '1', '2017-05-19 07:25:18', '58.62.205.20', '广东省广州市-电信');
INSERT INTO `pay_loginrecord` VALUES ('163', '1', '2017-05-19 07:27:17', '58.62.205.20', '广东省广州市-电信');
INSERT INTO `pay_loginrecord` VALUES ('164', '1', '2017-05-19 08:33:35', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('165', '1', '2017-05-20 12:49:05', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('166', '7', '2017-05-21 15:56:21', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('167', '1', '2017-05-21 15:57:08', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('168', '1', '2017-05-22 06:30:36', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('169', '1', '2017-05-22 16:18:22', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('170', '1', '2017-05-23 02:02:29', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('171', '1', '2017-05-23 06:34:38', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('172', '7', '2017-05-23 07:08:06', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('173', '1', '2017-05-23 10:03:22', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('174', '1', '2017-05-23 10:07:43', '222.72.174.12', '上海市-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('175', '1', '2017-05-24 08:04:07', '125.84.184.246', '重庆市-电信');
INSERT INTO `pay_loginrecord` VALUES ('176', '19', '2017-05-24 08:33:55', '183.18.34.208', '广东省湛江市-电信');
INSERT INTO `pay_loginrecord` VALUES ('177', '1', '2017-05-25 02:29:18', '58.39.241.35', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('178', '1', '2017-05-25 04:15:47', '58.39.241.35', '上海市嘉定区-电信ADSL');
INSERT INTO `pay_loginrecord` VALUES ('179', '1', '2017-05-25 10:08:25', '58.39.241.35', '上海市嘉定区-电信ADSL');

-- ----------------------------
-- Table structure for pay_member
-- ----------------------------
DROP TABLE IF EXISTS `pay_member`;
CREATE TABLE `pay_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `usertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `superioruserid` int(11) unsigned NOT NULL DEFAULT '0',
  `websiteid` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `activate` varchar(200) NOT NULL,
  `regdatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `activatedatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `fullname` varchar(50) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `birthday` int(11) unsigned NOT NULL DEFAULT '0',
  `sfznumber` varchar(20) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `qqnumber` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `loginpassword` varchar(32) NOT NULL,
  `paypassword` varchar(32) NOT NULL,
  `payapicontent` varchar(500) NOT NULL,
  `defaultpayapi` varchar(50) NOT NULL,
  `uploadsfzzm` varchar(200) NOT NULL,
  `uploadsfzbm` varchar(200) NOT NULL,
  `uploadscsfz` varchar(200) NOT NULL,
  `uploadyhkzm` varchar(200) NOT NULL,
  `uploadyhkbm` varchar(200) NOT NULL,
  `uploadyyzz` varchar(200) NOT NULL,
  `authstate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `domain` varchar(100) NOT NULL,
  `md5key` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_member
-- ----------------------------
INSERT INTO `pay_member` VALUES ('1', 'adminroot', '0', '0', '0', '1', '', '', '0', '0', '', '1', '0', '', '', '', '', 'f6fdffe48c908deb0f4c3bd36c032e72', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', '', '', '', '0', '', '');
INSERT INTO `pay_member` VALUES ('2', 'zyzyzzy123', '5', '12', '0', '1', '909252890@qq.com', 'fdf558d4c24a15a6e63e8a923a313f2e9126fba04637ff45115c09dd8496e454', '0', '0', '郜溪', '1', '0', '340621197810134831', '13301686250', '22691531', '中国上海', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'WxGzh|WxSm|Default|Cashier|Mfhcdnative|Baofoo|XingYeZfb|XingYeWx|XingYeWg|IpsZfb|', 'WxGzh', '553a540058c61.jpg', '553a540b11255.jpg', '553a541c2df31.jpg', '552e1c4fa112a.PNG', '552e1c354620d.png', '553a5ae88d4c1.jpg', '1', 'pay.17588.com', '6qNCl9z4M8VbZMyPEyqlzOes1IXA3u');
INSERT INTO `pay_member` VALUES ('8', 'user1234', '4', '1', '0', '0', 'user@qq.com', '7f5c6ad23b6a747b534f2001d787c3a19eee5d330a8e3fa53527181387d76321', '1491069829', '0', '', '1', '0', '', '', '', '', '6ad14ba9986e3615423dfca256d04e3f', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '', '0', '', '');
INSERT INTO `pay_member` VALUES ('9', 'xiayu37', '4', '1', '0', '0', '16132626@qq.com', 'f4585f43662d99f62565f800890ec9c3d3cd7d6de68c1b9e11ba8a1b721cda43', '1491100145', '0', '', '1', '0', '', '', '', '', 'd0dcbf0d12a6b1e7fbfa2ce5848f3eff', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '', '0', '', '');

-- ----------------------------
-- Table structure for pay_money
-- ----------------------------
DROP TABLE IF EXISTS `pay_money`;
CREATE TABLE `pay_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `money` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `freezemoney` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '冻结金额',
  `wallet` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_UID` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_money
-- ----------------------------
INSERT INTO `pay_money` VALUES ('1', '7', '2.01', '0.00', '0.90');

-- ----------------------------
-- Table structure for pay_moneychange
-- ----------------------------
DROP TABLE IF EXISTS `pay_moneychange`;
CREATE TABLE `pay_moneychange` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ymoney` decimal(15,3) NOT NULL DEFAULT '0.000',
  `money` decimal(15,3) NOT NULL DEFAULT '0.000',
  `gmoney` decimal(15,3) NOT NULL DEFAULT '0.000',
  `datetime` datetime DEFAULT NULL,
  `transid` varchar(100) DEFAULT NULL,
  `tongdao` int(11) DEFAULT NULL,
  `lx` int(11) NOT NULL DEFAULT '1',
  `tcuserid` int(11) DEFAULT NULL,
  `tcdengji` int(11) DEFAULT NULL,
  `orderid` varchar(300) DEFAULT NULL,
  `contentstr` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_moneychange
-- ----------------------------
INSERT INTO `pay_moneychange` VALUES ('1', '7', '2.000', '1.000', '3.000', '2017-05-23 13:01:42', '20170523130136702375', '163', '1', null, null, '20170523130136702375', null);
INSERT INTO `pay_moneychange` VALUES ('2', '7', '3.000', '1.000', '4.000', '2017-05-23 13:02:11', '20170523130205608693', '163', '1', null, null, '20170523130205608693', null);
INSERT INTO `pay_moneychange` VALUES ('3', '7', '4.000', '-2.000', '2.000', '2017-05-23 13:04:46', '', '163', '7', null, null, '', '');
INSERT INTO `pay_moneychange` VALUES ('4', '7', '0.000', '1.000', '1.000', '2017-05-23 13:08:03', '20170523130757651918', '163', '1', null, null, '20170523130757651918', null);
INSERT INTO `pay_moneychange` VALUES ('5', '7', '1.000', '1.000', '2.000', '2017-05-23 13:08:36', '20170523130822875626', '163', '1', null, null, '20170523130822875626', null);
INSERT INTO `pay_moneychange` VALUES ('6', '7', '0.000', '1.000', '1.000', '2017-05-23 13:10:20', '20170523131015645686', '163', '1', null, null, '20170523131015645686', null);
INSERT INTO `pay_moneychange` VALUES ('7', '7', '1.000', '1.000', '2.000', '2017-05-23 13:10:44', '20170523131038204863', '163', '1', null, null, '20170523131038204863', null);
INSERT INTO `pay_moneychange` VALUES ('8', '7', '2.000', '1.000', '3.000', '2017-05-23 13:12:24', '20170523131219338403', '163', '1', null, null, '20170523131219338403', null);
INSERT INTO `pay_moneychange` VALUES ('9', '7', '3.000', '1.000', '4.000', '2017-05-23 13:13:04', '20170523131259325463', '163', '1', null, null, '20170523131259325463', null);
INSERT INTO `pay_moneychange` VALUES ('10', '7', '0.000', '1.000', '1.000', '2017-05-23 13:19:42', '20170523131937583771', '163', '1', null, null, '20170523131937583771', null);
INSERT INTO `pay_moneychange` VALUES ('11', '7', '1.000', '1.000', '2.000', '2017-05-23 13:19:58', '20170523131953207510', '163', '1', null, null, '20170523131953207510', null);
INSERT INTO `pay_moneychange` VALUES ('12', '7', '0.000', '1.000', '1.000', '2017-05-23 13:23:20', '20170523132315345217', '163', '1', null, null, '20170523132315345217', null);
INSERT INTO `pay_moneychange` VALUES ('13', '7', '1.000', '1.000', '2.000', '2017-05-23 13:23:34', '20170523132330725982', '163', '1', null, null, '20170523132330725982', null);
INSERT INTO `pay_moneychange` VALUES ('14', '7', '0.000', '1.000', '1.000', '2017-05-23 14:36:55', '20170523143601848899', '163', '1', null, null, '20170523143601848899', null);
INSERT INTO `pay_moneychange` VALUES ('15', '7', '1.000', '1.000', '2.000', '2017-05-23 14:37:40', '20170523143734150965', '163', '1', null, null, '20170523143734150965', null);
INSERT INTO `pay_moneychange` VALUES ('16', '7', '0.000', '1.000', '1.000', '2017-05-23 14:38:58', '20170523143853115629', '163', '1', null, null, '20170523143853115629', null);
INSERT INTO `pay_moneychange` VALUES ('17', '7', '1.000', '1.000', '2.000', '2017-05-23 14:39:17', '20170523143913165939', '163', '1', null, null, '20170523143913165939', null);
INSERT INTO `pay_moneychange` VALUES ('18', '7', '2.000', '1.000', '3.000', '2017-05-23 14:50:56', '20170523145050275056', '163', '1', null, null, '20170523145050275056', null);
INSERT INTO `pay_moneychange` VALUES ('19', '7', '0.000', '1.000', '1.000', '2017-05-23 15:03:15', '20170523150310277159', '163', '1', null, null, '20170523150310277159', null);
INSERT INTO `pay_moneychange` VALUES ('20', '7', '1.000', '1.000', '2.000', '2017-05-23 15:03:40', '20170523150334750685', '163', '1', null, null, '20170523150334750685', null);
INSERT INTO `pay_moneychange` VALUES ('21', '7', '2.000', '1.000', '3.000', '2017-05-23 15:05:06', '20170523150501891481', '163', '1', null, null, '20170523150501891481', null);
INSERT INTO `pay_moneychange` VALUES ('22', '7', '0.000', '0.200', '0.200', '2017-05-23 15:05:34', '20170523150515348402', '138', '1', null, null, '20170523150515348402', null);
INSERT INTO `pay_moneychange` VALUES ('23', '7', '3.000', '0.900', '3.900', '2017-05-23 15:06:38', '20170523150633724873', '163', '1', null, null, '20170523150633724873', null);
INSERT INTO `pay_moneychange` VALUES ('24', '12', '0.000', '0.100', '0.100', '2017-05-23 15:06:38', '20170523150633724873', '163', '9', '7', '1', 'tx20170523150638', null);
INSERT INTO `pay_moneychange` VALUES ('25', '7', '3.900', '0.900', '4.800', '2017-05-23 15:11:55', '20170523151150548835', '163', '1', null, null, '20170523151150548835', null);
INSERT INTO `pay_moneychange` VALUES ('26', '12', '0.000', '0.100', '0.100', '2017-05-23 15:11:55', '20170523151150548835', '163', '9', '7', '1', 'tx20170523151155', null);
INSERT INTO `pay_moneychange` VALUES ('27', '7', '4.800', '0.900', '5.700', '2017-05-23 15:12:21', '20170523151214712405', '163', '1', null, null, '20170523151214712405', null);
INSERT INTO `pay_moneychange` VALUES ('28', '12', '0.000', '0.100', '0.100', '2017-05-23 15:12:21', '20170523151214712405', '163', '9', '7', '1', 'tx20170523151221', null);
INSERT INTO `pay_moneychange` VALUES ('29', '7', '5.700', '0.900', '6.600', '2017-05-23 15:17:03', '20170523151657918617', '163', '1', null, null, '20170523151657918617', null);
INSERT INTO `pay_moneychange` VALUES ('30', '12', '0.000', '0.100', '0.100', '2017-05-23 15:17:03', '20170523151657918617', '163', '9', '7', '1', 'tx20170523151703', null);
INSERT INTO `pay_moneychange` VALUES ('31', '7', '0.000', '0.900', '0.900', '2017-05-23 15:18:32', '20170523151827494909', '163', '1', null, null, '20170523151827494909', null);
INSERT INTO `pay_moneychange` VALUES ('32', '12', '0.000', '0.100', '0.100', '2017-05-23 15:18:32', '20170523151827494909', '163', '9', '7', '1', 'tx20170523151832', null);
INSERT INTO `pay_moneychange` VALUES ('33', '7', '0.900', '0.900', '1.800', '2017-05-23 15:19:01', '20170523151856982644', '163', '1', null, null, '20170523151856982644', null);
INSERT INTO `pay_moneychange` VALUES ('34', '12', '0.000', '0.100', '0.100', '2017-05-23 15:19:01', '20170523151856982644', '163', '9', '7', '1', 'tx20170523151901', null);
INSERT INTO `pay_moneychange` VALUES ('35', '7', '0.000', '0.900', '0.900', '2017-05-23 15:37:07', '20170523153702127282', '163', '1', null, null, '20170523153702127282', null);
INSERT INTO `pay_moneychange` VALUES ('36', '12', '0.000', '0.100', '0.100', '2017-05-23 15:37:07', '20170523153702127282', '163', '9', '7', '1', 'tx20170523153707', null);
INSERT INTO `pay_moneychange` VALUES ('37', '7', '0.900', '0.900', '1.800', '2017-05-23 15:37:33', '20170523153728779112', '163', '1', null, null, '20170523153728779112', null);
INSERT INTO `pay_moneychange` VALUES ('38', '12', '0.000', '0.100', '0.100', '2017-05-23 15:37:33', '20170523153728779112', '163', '9', '7', '1', 'tx20170523153733', null);
INSERT INTO `pay_moneychange` VALUES ('39', '7', '0.000', '0.200', '0.200', '2017-05-23 15:41:51', '20170523154131640116', '138', '1', null, null, '20170523154131640116', null);
INSERT INTO `pay_moneychange` VALUES ('40', '7', '0.000', '0.010', '0.010', '2017-05-23 18:14:33', '20170523181318481223', '170', '1', null, null, '20170523181318481223', null);

-- ----------------------------
-- Table structure for pay_newsclass
-- ----------------------------
DROP TABLE IF EXISTS `pay_newsclass`;
CREATE TABLE `pay_newsclass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `superiorid` int(11) unsigned NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_newsclass
-- ----------------------------

-- ----------------------------
-- Table structure for pay_newscontent
-- ----------------------------
DROP TABLE IF EXISTS `pay_newscontent`;
CREATE TABLE `pay_newscontent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `newsclassid` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text,
  `datetime` datetime NOT NULL,
  `clicknum` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_newscontent
-- ----------------------------

-- ----------------------------
-- Table structure for pay_order
-- ----------------------------
DROP TABLE IF EXISTS `pay_order`;
CREATE TABLE `pay_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pay_memberid` varchar(100) NOT NULL,
  `pay_orderid` varchar(100) NOT NULL,
  `pay_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `pay_poundage` decimal(15,3) NOT NULL,
  `pay_actualamount` decimal(15,3) NOT NULL,
  `pay_applydate` int(11) unsigned NOT NULL DEFAULT '0',
  `pay_successdate` int(11) unsigned NOT NULL DEFAULT '0',
  `pay_bankcode` varchar(100) DEFAULT NULL,
  `pay_notifyurl` varchar(500) NOT NULL,
  `pay_callbackurl` varchar(500) NOT NULL,
  `pay_bankname` varchar(300) DEFAULT NULL,
  `pay_status` int(11) NOT NULL DEFAULT '0',
  `pay_productname` varchar(300) DEFAULT NULL,
  `pay_productnum` varchar(300) DEFAULT NULL,
  `pay_productdesc` varchar(1000) DEFAULT NULL,
  `pay_producturl` varchar(500) DEFAULT NULL,
  `pay_reserved1` varchar(1000) DEFAULT NULL,
  `pay_reserved2` varchar(1000) DEFAULT NULL,
  `pay_reserved3` varchar(1000) DEFAULT NULL,
  `pay_tongdao` varchar(50) DEFAULT NULL,
  `pay_zh_tongdao` varchar(50) DEFAULT NULL,
  `pay_tjurl` varchar(1000) DEFAULT NULL,
  `num` int(11) NOT NULL DEFAULT '0',
  `memberid` varchar(100) DEFAULT NULL,
  `key` varchar(500) DEFAULT NULL,
  `account` varchar(100) DEFAULT NULL,
  `del` smallint(6) NOT NULL DEFAULT '0',
  `ddlx` int(11) DEFAULT '0',
  `pay_ytongdao` varchar(50) DEFAULT NULL,
  `pay_yzh_tongdao` varchar(50) DEFAULT NULL,
  `xx` smallint(6) unsigned NOT NULL DEFAULT '0',
  `xx_content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_ORD` (`pay_orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_order
-- ----------------------------
INSERT INTO `pay_order` VALUES ('1', '10007', '20170523153702127282', '1.000', '0.100', '0.900', '1495525023', '1495525027', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '2', '会员服务', '', '', '', '', '', '', 'Qiantong', '钱通支付', 'https://pay.17588.com/demo/qt.php', '0', '1001507', '', '张三', '0', '0', 'Qiantong', '钱通支付', '0', '');
INSERT INTO `pay_order` VALUES ('2', '10007', '20170523153728779112', '1.000', '0.100', '0.900', '1495525048', '1495525053', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '2', '会员服务', '', '', '', '', '', '', 'Qiantong', '钱通支付', 'https://pay.17588.com/demo/qt.php', '0', '1001507', '', '张三', '0', '0', 'Qiantong', '钱通支付', '0', '');
INSERT INTO `pay_order` VALUES ('3', '10007', '20170523154131640116', '0.200', '0.000', '0.200', '1495525291', '1495525311', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '2', 'VIP基础服务', '', '', '', '', '', '', 'WxSm', '微信扫码支付-官方', 'https://pay.17588.com/demo/', '0', '1242856102', '8DD5C65B16849B9319D8FB8B2712D96E', 'wxf33668d58442ff6e', '0', '0', 'WxSm', '微信扫码支付-官方', '0', '');
INSERT INTO `pay_order` VALUES ('4', '10007', '20170523175453225044', '0.010', '0.000', '0.010', '1495533294', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('5', '10007', '20170523175524897496', '0.010', '0.000', '0.010', '1495533326', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('6', '10007', '20170523175603803523', '0.010', '0.000', '0.010', '1495533409', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('7', '10007', '20170523175721648477', '0.010', '0.000', '0.010', '1495533453', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('8', '10007', '20170523180559638196', '0.010', '0.000', '0.010', '1495533960', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('9', '10007', '20170523180633601259', '0.010', '0.000', '0.010', '1495533997', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('10', '10007', '20170523180658575448', '0.010', '0.000', '0.010', '1495534019', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('11', '10007', '20170523180757498557', '0.010', '0.000', '0.010', '1495534078', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('12', '10007', '20170523181318481223', '0.010', '0.000', '0.010', '1495534424', '1495534473', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '2', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('13', '10007', '20170523183512842166', '0.100', '0.000', '0.100', '1495535713', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('14', '10007', '20170523184827222087', '0.100', '0.000', '0.100', '1495536508', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('15', '10007', '20170523185241590786', '0.100', '0.000', '0.100', '1495536761', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('16', '10007', '20170523185247372974', '0.100', '0.000', '0.100', '1495536768', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('17', '10007', '20170523185318617832', '0.100', '0.000', '0.100', '1495536800', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('18', '10007', '20170523190005450435', '0.100', '0.000', '0.100', '1495537206', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('19', '10007', '20170523190110241650', '0.100', '0.000', '0.100', '1495537272', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('20', '10007', '20170523192814341996', '0.010', '0.000', '0.010', '1495538921', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('21', '10007', '20170523194554521242', '0.010', '0.000', '0.010', '1495539956', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Mbpay', '摩宝支付', 'https://pay.17588.com/demo/mb.php', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '0', '0', 'Mbpay', '摩宝支付', '0', '');
INSERT INTO `pay_order` VALUES ('22', '10007', '20170523203227401572', '0.100', '0.000', '0.100', '1495542749', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SE', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('23', '10007', '20170524114746896958', '0.100', '0.000', '0.100', '1495597668', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('24', '10007', '20170524120144753601', '0.100', '0.000', '0.100', '1495598505', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('25', '10007', '20170524120827429452', '0.100', '0.000', '0.100', '1495598909', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('26', '10007', '20170524122733599796', '0.100', '0.000', '0.100', '1495600054', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('27', '10007', '20170524124924177314', '0.100', '0.000', '0.100', '1495601365', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('28', '10007', '20170524130453766981', '0.100', '0.000', '0.100', '1495602295', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('29', '10007', '20170524130911863350', '0.100', '0.000', '0.100', '1495602552', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('30', '10007', '20170524132335374474', '0.100', '0.000', '0.100', '1495603417', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('31', '10007', '20170524225609895234', '0.100', '0.000', '0.100', '1495637770', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');
INSERT INTO `pay_order` VALUES ('32', '10007', '20170524225853926398', '0.100', '0.000', '0.100', '1495637934', '0', 'WXZF', 'https://pay.17588.com/demo/server.php', 'https://pay.17588.com/demo/page.php', '微信支付', '0', '会员服务', '', '', '', '', '', '', 'Alipay', '支付宝官方', 'https://pay.17588.com/demo/ali.php', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '0', '0', 'Alipay', '支付宝官方', '0', '');

-- ----------------------------
-- Table structure for pay_payapi
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapi`;
CREATE TABLE `pay_payapi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `en_payname` varchar(300) DEFAULT NULL,
  `zh_payname` varchar(300) DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_ENM` (`en_payname`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapi
-- ----------------------------
INSERT INTO `pay_payapi` VALUES ('144', 'Ips', '环讯IPS', '');
INSERT INTO `pay_payapi` VALUES ('136', 'Default', '系统集成接口', '');
INSERT INTO `pay_payapi` VALUES ('137', 'WxGzh', '微信公众号支付', '');
INSERT INTO `pay_payapi` VALUES ('138', 'WxSm', '微信扫码支付-官方', '');
INSERT INTO `pay_payapi` VALUES ('145', 'IpsWx', '环讯IPS微信', '');
INSERT INTO `pay_payapi` VALUES ('141', 'WxServer', '微信服务商官方', '');
INSERT INTO `pay_payapi` VALUES ('146', 'IpsZfb', '环讯IPS支付宝', '');
INSERT INTO `pay_payapi` VALUES ('147', 'XingYeWg', '兴业银行', '');
INSERT INTO `pay_payapi` VALUES ('148', 'XingYeWx', '兴业银行微信', '');
INSERT INTO `pay_payapi` VALUES ('149', 'XingYeZfb', '兴业银行支付宝', '');
INSERT INTO `pay_payapi` VALUES ('150', 'Baofoo', '宝付', '');
INSERT INTO `pay_payapi` VALUES ('151', 'Mfhcdnative', '现代支付(扫码)', '');
INSERT INTO `pay_payapi` VALUES ('154', 'Cashier', '二维码收款[官方]', '');
INSERT INTO `pay_payapi` VALUES ('155', 'Qianyifu', '仟易付', '');
INSERT INTO `pay_payapi` VALUES ('156', 'Cmbc', '民生银行', '');
INSERT INTO `pay_payapi` VALUES ('157', 'Uka', '优卡联盟', '');
INSERT INTO `pay_payapi` VALUES ('158', 'Wlzhifu', '未来支付', '');
INSERT INTO `pay_payapi` VALUES ('159', 'Yespay', '银盛支付', '');
INSERT INTO `pay_payapi` VALUES ('160', 'KuaiQian', '快钱支付', '');
INSERT INTO `pay_payapi` VALUES ('161', 'Wftwx', '威富通微信扫码', '');
INSERT INTO `pay_payapi` VALUES ('162', 'Inbon', '鹰博微信扫码', '');
INSERT INTO `pay_payapi` VALUES ('163', 'Qiantong', '钱通支付', '');
INSERT INTO `pay_payapi` VALUES ('164', 'Juzhen', '矩阵支付', '');
INSERT INTO `pay_payapi` VALUES ('165', 'XyNative', '兴业扫码', '');
INSERT INTO `pay_payapi` VALUES ('166', 'XyJsapi', '兴业微信', '');
INSERT INTO `pay_payapi` VALUES ('167', 'Haike', '海科扫码', '');
INSERT INTO `pay_payapi` VALUES ('168', 'Alipay', '支付宝官方', '');
INSERT INTO `pay_payapi` VALUES ('169', 'Unionpay', '中国银联', '');
INSERT INTO `pay_payapi` VALUES ('170', 'Mbpay', '摩宝支付', '');

-- ----------------------------
-- Table structure for pay_payapiaccount
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapiaccount`;
CREATE TABLE `pay_payapiaccount` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payapiid` int(11) DEFAULT '0',
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `sid` varchar(300) DEFAULT NULL,
  `key` varchar(500) DEFAULT NULL,
  `account` varchar(300) DEFAULT NULL,
  `domain` varchar(300) DEFAULT NULL,
  `pagereturn` varchar(500) DEFAULT NULL,
  `serverreturn` varchar(500) DEFAULT NULL,
  `defaultrate` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `fengding` decimal(15,2) NOT NULL DEFAULT '0.00',
  `rate` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `defaultpayapiuser` bigint(20) NOT NULL DEFAULT '0',
  `keykey` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapiaccount
-- ----------------------------
INSERT INTO `pay_payapiaccount` VALUES ('1', '137', '0', '1242856102', '8DD5C65B16849B9319D8FB8B2712D96E', 'wxf33668d58442ff6e', '', '', '', '0.00000', '0.00', '0.00000', '1', 'c1f6681b1f655fb2f2c1dc75c5a99b1e');
INSERT INTO `pay_payapiaccount` VALUES ('2', '138', '0', '1242856102', '8DD5C65B16849B9319D8FB8B2712D96E', 'wxf33668d58442ff6e', '', '', '', '0.00000', '0.00', '0.00000', '0', 'c1f6681b1f655fb2f2c1dc75c5a99b1e');
INSERT INTO `pay_payapiaccount` VALUES ('3', '157', '0', '1000', '2cd7f3bbae6547ae9cf87c3893db9bee', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('4', '158', '0', '00065503', 'IJNHTI3D7C9EPLMJ', '100009900000001', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('5', '159', '0', 'shanghu_test', '', '银盛支付商户测试公司', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('6', '160', '0', '1013575351301', '', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('7', '144', '0', '180645', 'Fu6QNh36Cxl31cv8DpYRpCznHolCaxhRnjpymhntyZLcwG5JpUz1rDHjBRLHYrn4LbWLw59jJnX4cS6xo6uylEbeyLGhryrWqwPpaZSvPJAedC0hBEc1FF5Lt0dmySGb', '1806450019', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('8', '161', '0', '7551000001', '9d101c97133837e13dde2d32a5054abb', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('36', '168', '0', '2017051807274286', 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiUosZgKnQpb6fMzgtk96lJoSul11fVLLs094wdCZNEdHaBQdb/GMkl5OQJPPsVOnae4aEgY1aXGfZUB2OziZSLDvZqD4TJQlB1Dxn/Gi8QKPWf9c8mu60cXho0bH9RqemIp7bmSejDVMo5YZXq/3y7Lw8N7LRUBRErpVNKOarpf+gXyfENVLcSxo9ZnTlm/Xthm/Dtk+HtNOAzuu/Zoq5F2XCwoVge9nmBoc3UhiJMoLl4afH9Moas1tIrG3f7SEJEXhyrrsXbK0N9/SDzVWHaHTWnmBEy0N89pA36dv81icxT1lub53unQ2v8oKV8m9MK0JKWw+TyqMD1r/gyj+EQIDAQAB', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('35', '167', '0', '00000000518691', 'Pyb1Vi6P7xlZ', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('34', '166', '0', '7551000001', '9d101c97133837e13dde2d32a5054abb', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('33', '165', '0', '7551000001', '9d101c97133837e13dde2d32a5054abb', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('32', '164', '0', '898000000020194', '', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('31', '163', '0', '1001507', '', '张三', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('30', '162', '0', '6000000001', '', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('37', '169', '0', '777290058110048', '000000', '', '', '', '', '0.00000', '0.00', '0.00000', '1', '');
INSERT INTO `pay_payapiaccount` VALUES ('38', '170', '0', '2110001494927470', 'c89765d46632721dabad5b182f74b614', '2110001494927470', '', '', '', '0.00000', '0.00', '0.00000', '1', '');

-- ----------------------------
-- Table structure for pay_payapibank
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapibank`;
CREATE TABLE `pay_payapibank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `systembankid` int(11) DEFAULT NULL,
  `payapiconfigid` int(11) DEFAULT NULL,
  `bankcode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=385 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapibank
-- ----------------------------
INSERT INTO `pay_payapibank` VALUES ('1', '194', '4', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('2', '177', '4', '');
INSERT INTO `pay_payapibank` VALUES ('3', '178', '4', '');
INSERT INTO `pay_payapibank` VALUES ('4', '180', '4', '');
INSERT INTO `pay_payapibank` VALUES ('5', '175', '4', '');
INSERT INTO `pay_payapibank` VALUES ('6', '172', '4', '');
INSERT INTO `pay_payapibank` VALUES ('7', '173', '4', '');
INSERT INTO `pay_payapibank` VALUES ('8', '165', '4', '');
INSERT INTO `pay_payapibank` VALUES ('9', '168', '4', '');
INSERT INTO `pay_payapibank` VALUES ('10', '167', '4', '');
INSERT INTO `pay_payapibank` VALUES ('11', '182', '4', '');
INSERT INTO `pay_payapibank` VALUES ('12', '184', '4', '');
INSERT INTO `pay_payapibank` VALUES ('13', '171', '4', '');
INSERT INTO `pay_payapibank` VALUES ('14', '181', '4', '');
INSERT INTO `pay_payapibank` VALUES ('15', '179', '4', '');
INSERT INTO `pay_payapibank` VALUES ('16', '166', '4', '');
INSERT INTO `pay_payapibank` VALUES ('17', '169', '4', '');
INSERT INTO `pay_payapibank` VALUES ('18', '176', '4', '');
INSERT INTO `pay_payapibank` VALUES ('19', '183', '4', '');
INSERT INTO `pay_payapibank` VALUES ('20', '162', '4', '');
INSERT INTO `pay_payapibank` VALUES ('21', '164', '4', '');
INSERT INTO `pay_payapibank` VALUES ('22', '170', '4', '');
INSERT INTO `pay_payapibank` VALUES ('23', '193', '4', '');
INSERT INTO `pay_payapibank` VALUES ('24', '174', '4', '');
INSERT INTO `pay_payapibank` VALUES ('25', '194', '3', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('26', '177', '3', '');
INSERT INTO `pay_payapibank` VALUES ('27', '178', '3', '');
INSERT INTO `pay_payapibank` VALUES ('28', '180', '3', '');
INSERT INTO `pay_payapibank` VALUES ('29', '175', '3', '');
INSERT INTO `pay_payapibank` VALUES ('30', '172', '3', '');
INSERT INTO `pay_payapibank` VALUES ('31', '173', '3', '');
INSERT INTO `pay_payapibank` VALUES ('32', '165', '3', '');
INSERT INTO `pay_payapibank` VALUES ('33', '168', '3', '');
INSERT INTO `pay_payapibank` VALUES ('34', '167', '3', '');
INSERT INTO `pay_payapibank` VALUES ('35', '182', '3', '');
INSERT INTO `pay_payapibank` VALUES ('36', '184', '3', '');
INSERT INTO `pay_payapibank` VALUES ('37', '171', '3', '');
INSERT INTO `pay_payapibank` VALUES ('38', '181', '3', '');
INSERT INTO `pay_payapibank` VALUES ('39', '179', '3', '');
INSERT INTO `pay_payapibank` VALUES ('40', '166', '3', '');
INSERT INTO `pay_payapibank` VALUES ('41', '169', '3', '');
INSERT INTO `pay_payapibank` VALUES ('42', '176', '3', '');
INSERT INTO `pay_payapibank` VALUES ('43', '183', '3', '');
INSERT INTO `pay_payapibank` VALUES ('44', '162', '3', '');
INSERT INTO `pay_payapibank` VALUES ('45', '164', '3', '');
INSERT INTO `pay_payapibank` VALUES ('46', '170', '3', '');
INSERT INTO `pay_payapibank` VALUES ('47', '193', '3', '');
INSERT INTO `pay_payapibank` VALUES ('48', '174', '3', '');
INSERT INTO `pay_payapibank` VALUES ('49', '194', '17', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('50', '177', '17', '');
INSERT INTO `pay_payapibank` VALUES ('51', '178', '17', '');
INSERT INTO `pay_payapibank` VALUES ('52', '180', '17', '');
INSERT INTO `pay_payapibank` VALUES ('53', '175', '17', '');
INSERT INTO `pay_payapibank` VALUES ('54', '172', '17', '');
INSERT INTO `pay_payapibank` VALUES ('55', '173', '17', '');
INSERT INTO `pay_payapibank` VALUES ('56', '165', '17', '');
INSERT INTO `pay_payapibank` VALUES ('57', '168', '17', '');
INSERT INTO `pay_payapibank` VALUES ('58', '167', '17', '');
INSERT INTO `pay_payapibank` VALUES ('59', '182', '17', '');
INSERT INTO `pay_payapibank` VALUES ('60', '184', '17', '');
INSERT INTO `pay_payapibank` VALUES ('61', '171', '17', '');
INSERT INTO `pay_payapibank` VALUES ('62', '181', '17', '');
INSERT INTO `pay_payapibank` VALUES ('63', '179', '17', '');
INSERT INTO `pay_payapibank` VALUES ('64', '166', '17', '');
INSERT INTO `pay_payapibank` VALUES ('65', '169', '17', '');
INSERT INTO `pay_payapibank` VALUES ('66', '176', '17', '');
INSERT INTO `pay_payapibank` VALUES ('67', '183', '17', '');
INSERT INTO `pay_payapibank` VALUES ('68', '162', '17', '');
INSERT INTO `pay_payapibank` VALUES ('69', '164', '17', '');
INSERT INTO `pay_payapibank` VALUES ('70', '170', '17', '');
INSERT INTO `pay_payapibank` VALUES ('71', '193', '17', '');
INSERT INTO `pay_payapibank` VALUES ('72', '174', '17', '');
INSERT INTO `pay_payapibank` VALUES ('73', '194', '18', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('74', '177', '18', '');
INSERT INTO `pay_payapibank` VALUES ('75', '178', '18', '');
INSERT INTO `pay_payapibank` VALUES ('76', '180', '18', '');
INSERT INTO `pay_payapibank` VALUES ('77', '175', '18', '');
INSERT INTO `pay_payapibank` VALUES ('78', '172', '18', '');
INSERT INTO `pay_payapibank` VALUES ('79', '173', '18', '');
INSERT INTO `pay_payapibank` VALUES ('80', '165', '18', '');
INSERT INTO `pay_payapibank` VALUES ('81', '168', '18', '');
INSERT INTO `pay_payapibank` VALUES ('82', '167', '18', '');
INSERT INTO `pay_payapibank` VALUES ('83', '182', '18', '');
INSERT INTO `pay_payapibank` VALUES ('84', '184', '18', '');
INSERT INTO `pay_payapibank` VALUES ('85', '171', '18', '');
INSERT INTO `pay_payapibank` VALUES ('86', '181', '18', '');
INSERT INTO `pay_payapibank` VALUES ('87', '179', '18', '');
INSERT INTO `pay_payapibank` VALUES ('88', '166', '18', '');
INSERT INTO `pay_payapibank` VALUES ('89', '169', '18', '');
INSERT INTO `pay_payapibank` VALUES ('90', '176', '18', '');
INSERT INTO `pay_payapibank` VALUES ('91', '183', '18', '');
INSERT INTO `pay_payapibank` VALUES ('92', '162', '18', '');
INSERT INTO `pay_payapibank` VALUES ('93', '164', '18', '');
INSERT INTO `pay_payapibank` VALUES ('94', '170', '18', '');
INSERT INTO `pay_payapibank` VALUES ('95', '193', '18', '');
INSERT INTO `pay_payapibank` VALUES ('96', '174', '18', '');
INSERT INTO `pay_payapibank` VALUES ('97', '194', '19', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('98', '177', '19', '');
INSERT INTO `pay_payapibank` VALUES ('99', '178', '19', '');
INSERT INTO `pay_payapibank` VALUES ('100', '180', '19', '');
INSERT INTO `pay_payapibank` VALUES ('101', '175', '19', '');
INSERT INTO `pay_payapibank` VALUES ('102', '172', '19', '');
INSERT INTO `pay_payapibank` VALUES ('103', '173', '19', '');
INSERT INTO `pay_payapibank` VALUES ('104', '165', '19', '');
INSERT INTO `pay_payapibank` VALUES ('105', '168', '19', '');
INSERT INTO `pay_payapibank` VALUES ('106', '167', '19', '');
INSERT INTO `pay_payapibank` VALUES ('107', '182', '19', '');
INSERT INTO `pay_payapibank` VALUES ('108', '184', '19', '');
INSERT INTO `pay_payapibank` VALUES ('109', '171', '19', '');
INSERT INTO `pay_payapibank` VALUES ('110', '181', '19', '');
INSERT INTO `pay_payapibank` VALUES ('111', '179', '19', '');
INSERT INTO `pay_payapibank` VALUES ('112', '166', '19', '');
INSERT INTO `pay_payapibank` VALUES ('113', '169', '19', '');
INSERT INTO `pay_payapibank` VALUES ('114', '176', '19', '');
INSERT INTO `pay_payapibank` VALUES ('115', '183', '19', '');
INSERT INTO `pay_payapibank` VALUES ('116', '162', '19', '');
INSERT INTO `pay_payapibank` VALUES ('117', '164', '19', '');
INSERT INTO `pay_payapibank` VALUES ('118', '170', '19', '');
INSERT INTO `pay_payapibank` VALUES ('119', '193', '19', '');
INSERT INTO `pay_payapibank` VALUES ('120', '174', '19', '');
INSERT INTO `pay_payapibank` VALUES ('121', '194', '2', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('122', '177', '2', '');
INSERT INTO `pay_payapibank` VALUES ('123', '178', '2', '');
INSERT INTO `pay_payapibank` VALUES ('124', '180', '2', '');
INSERT INTO `pay_payapibank` VALUES ('125', '175', '2', '');
INSERT INTO `pay_payapibank` VALUES ('126', '172', '2', '');
INSERT INTO `pay_payapibank` VALUES ('127', '173', '2', '');
INSERT INTO `pay_payapibank` VALUES ('128', '165', '2', '');
INSERT INTO `pay_payapibank` VALUES ('129', '168', '2', '');
INSERT INTO `pay_payapibank` VALUES ('130', '167', '2', '');
INSERT INTO `pay_payapibank` VALUES ('131', '182', '2', '');
INSERT INTO `pay_payapibank` VALUES ('132', '184', '2', '');
INSERT INTO `pay_payapibank` VALUES ('133', '171', '2', '');
INSERT INTO `pay_payapibank` VALUES ('134', '181', '2', '');
INSERT INTO `pay_payapibank` VALUES ('135', '179', '2', '');
INSERT INTO `pay_payapibank` VALUES ('136', '166', '2', '');
INSERT INTO `pay_payapibank` VALUES ('137', '169', '2', '');
INSERT INTO `pay_payapibank` VALUES ('138', '176', '2', '');
INSERT INTO `pay_payapibank` VALUES ('139', '183', '2', '');
INSERT INTO `pay_payapibank` VALUES ('140', '162', '2', '');
INSERT INTO `pay_payapibank` VALUES ('141', '164', '2', '');
INSERT INTO `pay_payapibank` VALUES ('142', '170', '2', '');
INSERT INTO `pay_payapibank` VALUES ('143', '193', '2', '');
INSERT INTO `pay_payapibank` VALUES ('144', '174', '2', '');
INSERT INTO `pay_payapibank` VALUES ('145', '194', '20', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('146', '177', '20', '');
INSERT INTO `pay_payapibank` VALUES ('147', '178', '20', '');
INSERT INTO `pay_payapibank` VALUES ('148', '180', '20', '');
INSERT INTO `pay_payapibank` VALUES ('149', '175', '20', '');
INSERT INTO `pay_payapibank` VALUES ('150', '172', '20', '');
INSERT INTO `pay_payapibank` VALUES ('151', '173', '20', '');
INSERT INTO `pay_payapibank` VALUES ('152', '165', '20', '');
INSERT INTO `pay_payapibank` VALUES ('153', '168', '20', '');
INSERT INTO `pay_payapibank` VALUES ('154', '167', '20', '');
INSERT INTO `pay_payapibank` VALUES ('155', '182', '20', '');
INSERT INTO `pay_payapibank` VALUES ('156', '184', '20', '');
INSERT INTO `pay_payapibank` VALUES ('157', '171', '20', '');
INSERT INTO `pay_payapibank` VALUES ('158', '181', '20', '');
INSERT INTO `pay_payapibank` VALUES ('159', '179', '20', '');
INSERT INTO `pay_payapibank` VALUES ('160', '166', '20', '');
INSERT INTO `pay_payapibank` VALUES ('161', '169', '20', '');
INSERT INTO `pay_payapibank` VALUES ('162', '176', '20', '');
INSERT INTO `pay_payapibank` VALUES ('163', '183', '20', '');
INSERT INTO `pay_payapibank` VALUES ('164', '162', '20', '');
INSERT INTO `pay_payapibank` VALUES ('165', '164', '20', '');
INSERT INTO `pay_payapibank` VALUES ('166', '170', '20', '');
INSERT INTO `pay_payapibank` VALUES ('167', '193', '20', '');
INSERT INTO `pay_payapibank` VALUES ('168', '174', '20', '');
INSERT INTO `pay_payapibank` VALUES ('169', '194', '21', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('170', '177', '21', '');
INSERT INTO `pay_payapibank` VALUES ('171', '178', '21', '');
INSERT INTO `pay_payapibank` VALUES ('172', '180', '21', '');
INSERT INTO `pay_payapibank` VALUES ('173', '175', '21', '');
INSERT INTO `pay_payapibank` VALUES ('174', '172', '21', '');
INSERT INTO `pay_payapibank` VALUES ('175', '173', '21', '');
INSERT INTO `pay_payapibank` VALUES ('176', '165', '21', '');
INSERT INTO `pay_payapibank` VALUES ('177', '168', '21', '');
INSERT INTO `pay_payapibank` VALUES ('178', '167', '21', '');
INSERT INTO `pay_payapibank` VALUES ('179', '182', '21', '');
INSERT INTO `pay_payapibank` VALUES ('180', '184', '21', '');
INSERT INTO `pay_payapibank` VALUES ('181', '171', '21', '');
INSERT INTO `pay_payapibank` VALUES ('182', '181', '21', '');
INSERT INTO `pay_payapibank` VALUES ('183', '179', '21', '');
INSERT INTO `pay_payapibank` VALUES ('184', '166', '21', '');
INSERT INTO `pay_payapibank` VALUES ('185', '169', '21', '');
INSERT INTO `pay_payapibank` VALUES ('186', '176', '21', '');
INSERT INTO `pay_payapibank` VALUES ('187', '183', '21', '');
INSERT INTO `pay_payapibank` VALUES ('188', '162', '21', '');
INSERT INTO `pay_payapibank` VALUES ('189', '164', '21', '');
INSERT INTO `pay_payapibank` VALUES ('190', '170', '21', '');
INSERT INTO `pay_payapibank` VALUES ('191', '193', '21', '');
INSERT INTO `pay_payapibank` VALUES ('192', '174', '21', '');
INSERT INTO `pay_payapibank` VALUES ('193', '194', '22', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('194', '177', '22', '');
INSERT INTO `pay_payapibank` VALUES ('195', '178', '22', '');
INSERT INTO `pay_payapibank` VALUES ('196', '180', '22', '');
INSERT INTO `pay_payapibank` VALUES ('197', '175', '22', '');
INSERT INTO `pay_payapibank` VALUES ('198', '172', '22', '');
INSERT INTO `pay_payapibank` VALUES ('199', '173', '22', '');
INSERT INTO `pay_payapibank` VALUES ('200', '165', '22', '');
INSERT INTO `pay_payapibank` VALUES ('201', '168', '22', '');
INSERT INTO `pay_payapibank` VALUES ('202', '167', '22', '');
INSERT INTO `pay_payapibank` VALUES ('203', '182', '22', '');
INSERT INTO `pay_payapibank` VALUES ('204', '184', '22', '');
INSERT INTO `pay_payapibank` VALUES ('205', '171', '22', '');
INSERT INTO `pay_payapibank` VALUES ('206', '181', '22', '');
INSERT INTO `pay_payapibank` VALUES ('207', '179', '22', '');
INSERT INTO `pay_payapibank` VALUES ('208', '166', '22', '');
INSERT INTO `pay_payapibank` VALUES ('209', '169', '22', '');
INSERT INTO `pay_payapibank` VALUES ('210', '176', '22', '');
INSERT INTO `pay_payapibank` VALUES ('211', '183', '22', '');
INSERT INTO `pay_payapibank` VALUES ('212', '162', '22', '');
INSERT INTO `pay_payapibank` VALUES ('213', '164', '22', '');
INSERT INTO `pay_payapibank` VALUES ('214', '170', '22', '');
INSERT INTO `pay_payapibank` VALUES ('215', '193', '22', '');
INSERT INTO `pay_payapibank` VALUES ('216', '174', '22', '');
INSERT INTO `pay_payapibank` VALUES ('217', '194', '23', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('218', '177', '23', '');
INSERT INTO `pay_payapibank` VALUES ('219', '178', '23', '');
INSERT INTO `pay_payapibank` VALUES ('220', '180', '23', '');
INSERT INTO `pay_payapibank` VALUES ('221', '175', '23', '');
INSERT INTO `pay_payapibank` VALUES ('222', '172', '23', '');
INSERT INTO `pay_payapibank` VALUES ('223', '173', '23', '');
INSERT INTO `pay_payapibank` VALUES ('224', '165', '23', '');
INSERT INTO `pay_payapibank` VALUES ('225', '168', '23', '');
INSERT INTO `pay_payapibank` VALUES ('226', '167', '23', '');
INSERT INTO `pay_payapibank` VALUES ('227', '182', '23', '');
INSERT INTO `pay_payapibank` VALUES ('228', '184', '23', '');
INSERT INTO `pay_payapibank` VALUES ('229', '171', '23', '');
INSERT INTO `pay_payapibank` VALUES ('230', '181', '23', '');
INSERT INTO `pay_payapibank` VALUES ('231', '179', '23', '');
INSERT INTO `pay_payapibank` VALUES ('232', '166', '23', '');
INSERT INTO `pay_payapibank` VALUES ('233', '169', '23', '');
INSERT INTO `pay_payapibank` VALUES ('234', '176', '23', '');
INSERT INTO `pay_payapibank` VALUES ('235', '183', '23', '');
INSERT INTO `pay_payapibank` VALUES ('236', '162', '23', '');
INSERT INTO `pay_payapibank` VALUES ('237', '164', '23', '');
INSERT INTO `pay_payapibank` VALUES ('238', '170', '23', '');
INSERT INTO `pay_payapibank` VALUES ('239', '193', '23', '');
INSERT INTO `pay_payapibank` VALUES ('240', '174', '23', '');
INSERT INTO `pay_payapibank` VALUES ('241', '194', '24', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('242', '177', '24', '');
INSERT INTO `pay_payapibank` VALUES ('243', '178', '24', '');
INSERT INTO `pay_payapibank` VALUES ('244', '180', '24', '');
INSERT INTO `pay_payapibank` VALUES ('245', '175', '24', '');
INSERT INTO `pay_payapibank` VALUES ('246', '172', '24', '');
INSERT INTO `pay_payapibank` VALUES ('247', '173', '24', '');
INSERT INTO `pay_payapibank` VALUES ('248', '165', '24', '');
INSERT INTO `pay_payapibank` VALUES ('249', '168', '24', '');
INSERT INTO `pay_payapibank` VALUES ('250', '167', '24', '');
INSERT INTO `pay_payapibank` VALUES ('251', '182', '24', '');
INSERT INTO `pay_payapibank` VALUES ('252', '184', '24', '');
INSERT INTO `pay_payapibank` VALUES ('253', '171', '24', '');
INSERT INTO `pay_payapibank` VALUES ('254', '181', '24', '');
INSERT INTO `pay_payapibank` VALUES ('255', '179', '24', '');
INSERT INTO `pay_payapibank` VALUES ('256', '166', '24', '');
INSERT INTO `pay_payapibank` VALUES ('257', '169', '24', '');
INSERT INTO `pay_payapibank` VALUES ('258', '176', '24', '');
INSERT INTO `pay_payapibank` VALUES ('259', '183', '24', '');
INSERT INTO `pay_payapibank` VALUES ('260', '162', '24', '');
INSERT INTO `pay_payapibank` VALUES ('261', '164', '24', '');
INSERT INTO `pay_payapibank` VALUES ('262', '170', '24', '');
INSERT INTO `pay_payapibank` VALUES ('263', '193', '24', '');
INSERT INTO `pay_payapibank` VALUES ('264', '174', '24', '');
INSERT INTO `pay_payapibank` VALUES ('265', '194', '25', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('266', '177', '25', '');
INSERT INTO `pay_payapibank` VALUES ('267', '178', '25', '');
INSERT INTO `pay_payapibank` VALUES ('268', '180', '25', '');
INSERT INTO `pay_payapibank` VALUES ('269', '175', '25', '');
INSERT INTO `pay_payapibank` VALUES ('270', '172', '25', '');
INSERT INTO `pay_payapibank` VALUES ('271', '173', '25', '');
INSERT INTO `pay_payapibank` VALUES ('272', '165', '25', '');
INSERT INTO `pay_payapibank` VALUES ('273', '168', '25', '');
INSERT INTO `pay_payapibank` VALUES ('274', '167', '25', '');
INSERT INTO `pay_payapibank` VALUES ('275', '182', '25', '');
INSERT INTO `pay_payapibank` VALUES ('276', '184', '25', '');
INSERT INTO `pay_payapibank` VALUES ('277', '171', '25', '');
INSERT INTO `pay_payapibank` VALUES ('278', '181', '25', '');
INSERT INTO `pay_payapibank` VALUES ('279', '179', '25', '');
INSERT INTO `pay_payapibank` VALUES ('280', '166', '25', '');
INSERT INTO `pay_payapibank` VALUES ('281', '169', '25', '');
INSERT INTO `pay_payapibank` VALUES ('282', '176', '25', '');
INSERT INTO `pay_payapibank` VALUES ('283', '183', '25', '');
INSERT INTO `pay_payapibank` VALUES ('284', '162', '25', '');
INSERT INTO `pay_payapibank` VALUES ('285', '164', '25', '');
INSERT INTO `pay_payapibank` VALUES ('286', '170', '25', '');
INSERT INTO `pay_payapibank` VALUES ('287', '193', '25', '');
INSERT INTO `pay_payapibank` VALUES ('288', '174', '25', '');
INSERT INTO `pay_payapibank` VALUES ('289', '194', '26', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('290', '177', '26', '');
INSERT INTO `pay_payapibank` VALUES ('291', '178', '26', '');
INSERT INTO `pay_payapibank` VALUES ('292', '180', '26', '');
INSERT INTO `pay_payapibank` VALUES ('293', '175', '26', '');
INSERT INTO `pay_payapibank` VALUES ('294', '172', '26', '');
INSERT INTO `pay_payapibank` VALUES ('295', '173', '26', '');
INSERT INTO `pay_payapibank` VALUES ('296', '165', '26', '');
INSERT INTO `pay_payapibank` VALUES ('297', '168', '26', '');
INSERT INTO `pay_payapibank` VALUES ('298', '167', '26', '');
INSERT INTO `pay_payapibank` VALUES ('299', '182', '26', '');
INSERT INTO `pay_payapibank` VALUES ('300', '184', '26', '');
INSERT INTO `pay_payapibank` VALUES ('301', '171', '26', '');
INSERT INTO `pay_payapibank` VALUES ('302', '181', '26', '');
INSERT INTO `pay_payapibank` VALUES ('303', '179', '26', '');
INSERT INTO `pay_payapibank` VALUES ('304', '166', '26', '');
INSERT INTO `pay_payapibank` VALUES ('305', '169', '26', '');
INSERT INTO `pay_payapibank` VALUES ('306', '176', '26', '');
INSERT INTO `pay_payapibank` VALUES ('307', '183', '26', '');
INSERT INTO `pay_payapibank` VALUES ('308', '162', '26', '');
INSERT INTO `pay_payapibank` VALUES ('309', '164', '26', '');
INSERT INTO `pay_payapibank` VALUES ('310', '170', '26', '');
INSERT INTO `pay_payapibank` VALUES ('311', '193', '26', '');
INSERT INTO `pay_payapibank` VALUES ('312', '174', '26', '');
INSERT INTO `pay_payapibank` VALUES ('313', '194', '27', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('314', '177', '27', '');
INSERT INTO `pay_payapibank` VALUES ('315', '178', '27', '');
INSERT INTO `pay_payapibank` VALUES ('316', '180', '27', '');
INSERT INTO `pay_payapibank` VALUES ('317', '175', '27', '');
INSERT INTO `pay_payapibank` VALUES ('318', '172', '27', '');
INSERT INTO `pay_payapibank` VALUES ('319', '173', '27', '');
INSERT INTO `pay_payapibank` VALUES ('320', '165', '27', '');
INSERT INTO `pay_payapibank` VALUES ('321', '168', '27', '');
INSERT INTO `pay_payapibank` VALUES ('322', '167', '27', '');
INSERT INTO `pay_payapibank` VALUES ('323', '182', '27', '');
INSERT INTO `pay_payapibank` VALUES ('324', '184', '27', '');
INSERT INTO `pay_payapibank` VALUES ('325', '171', '27', '');
INSERT INTO `pay_payapibank` VALUES ('326', '181', '27', '');
INSERT INTO `pay_payapibank` VALUES ('327', '179', '27', '');
INSERT INTO `pay_payapibank` VALUES ('328', '166', '27', '');
INSERT INTO `pay_payapibank` VALUES ('329', '169', '27', '');
INSERT INTO `pay_payapibank` VALUES ('330', '176', '27', '');
INSERT INTO `pay_payapibank` VALUES ('331', '183', '27', '');
INSERT INTO `pay_payapibank` VALUES ('332', '162', '27', '');
INSERT INTO `pay_payapibank` VALUES ('333', '164', '27', '');
INSERT INTO `pay_payapibank` VALUES ('334', '170', '27', '');
INSERT INTO `pay_payapibank` VALUES ('335', '193', '27', '');
INSERT INTO `pay_payapibank` VALUES ('336', '174', '27', '');
INSERT INTO `pay_payapibank` VALUES ('337', '194', '28', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('338', '177', '28', '');
INSERT INTO `pay_payapibank` VALUES ('339', '178', '28', '');
INSERT INTO `pay_payapibank` VALUES ('340', '180', '28', '');
INSERT INTO `pay_payapibank` VALUES ('341', '175', '28', '');
INSERT INTO `pay_payapibank` VALUES ('342', '172', '28', '');
INSERT INTO `pay_payapibank` VALUES ('343', '173', '28', '');
INSERT INTO `pay_payapibank` VALUES ('344', '165', '28', '');
INSERT INTO `pay_payapibank` VALUES ('345', '168', '28', '');
INSERT INTO `pay_payapibank` VALUES ('346', '167', '28', '');
INSERT INTO `pay_payapibank` VALUES ('347', '182', '28', '');
INSERT INTO `pay_payapibank` VALUES ('348', '184', '28', '');
INSERT INTO `pay_payapibank` VALUES ('349', '171', '28', '');
INSERT INTO `pay_payapibank` VALUES ('350', '181', '28', '');
INSERT INTO `pay_payapibank` VALUES ('351', '179', '28', '');
INSERT INTO `pay_payapibank` VALUES ('352', '166', '28', '');
INSERT INTO `pay_payapibank` VALUES ('353', '169', '28', '');
INSERT INTO `pay_payapibank` VALUES ('354', '176', '28', '');
INSERT INTO `pay_payapibank` VALUES ('355', '183', '28', '');
INSERT INTO `pay_payapibank` VALUES ('356', '162', '28', '');
INSERT INTO `pay_payapibank` VALUES ('357', '164', '28', '');
INSERT INTO `pay_payapibank` VALUES ('358', '170', '28', '');
INSERT INTO `pay_payapibank` VALUES ('359', '193', '28', '');
INSERT INTO `pay_payapibank` VALUES ('360', '174', '28', '');
INSERT INTO `pay_payapibank` VALUES ('361', '194', '29', 'WXZF');
INSERT INTO `pay_payapibank` VALUES ('362', '177', '29', '');
INSERT INTO `pay_payapibank` VALUES ('363', '178', '29', '');
INSERT INTO `pay_payapibank` VALUES ('364', '180', '29', '');
INSERT INTO `pay_payapibank` VALUES ('365', '175', '29', '');
INSERT INTO `pay_payapibank` VALUES ('366', '172', '29', '');
INSERT INTO `pay_payapibank` VALUES ('367', '173', '29', '');
INSERT INTO `pay_payapibank` VALUES ('368', '165', '29', '');
INSERT INTO `pay_payapibank` VALUES ('369', '168', '29', '');
INSERT INTO `pay_payapibank` VALUES ('370', '167', '29', '');
INSERT INTO `pay_payapibank` VALUES ('371', '182', '29', '');
INSERT INTO `pay_payapibank` VALUES ('372', '184', '29', '');
INSERT INTO `pay_payapibank` VALUES ('373', '171', '29', '');
INSERT INTO `pay_payapibank` VALUES ('374', '181', '29', '');
INSERT INTO `pay_payapibank` VALUES ('375', '179', '29', '');
INSERT INTO `pay_payapibank` VALUES ('376', '166', '29', '');
INSERT INTO `pay_payapibank` VALUES ('377', '169', '29', '');
INSERT INTO `pay_payapibank` VALUES ('378', '176', '29', '');
INSERT INTO `pay_payapibank` VALUES ('379', '183', '29', '');
INSERT INTO `pay_payapibank` VALUES ('380', '162', '29', '');
INSERT INTO `pay_payapibank` VALUES ('381', '164', '29', '');
INSERT INTO `pay_payapibank` VALUES ('382', '170', '29', '');
INSERT INTO `pay_payapibank` VALUES ('383', '193', '29', '');
INSERT INTO `pay_payapibank` VALUES ('384', '174', '29', '');

-- ----------------------------
-- Table structure for pay_payapicompatibility
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapicompatibility`;
CREATE TABLE `pay_payapicompatibility` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payapiid` int(11) DEFAULT NULL,
  `field` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapicompatibility
-- ----------------------------
INSERT INTO `pay_payapicompatibility` VALUES ('1', '125', 'MerchantID');
INSERT INTO `pay_payapicompatibility` VALUES ('2', '125', 'PayID');
INSERT INTO `pay_payapicompatibility` VALUES ('3', '125', 'TradeDate');
INSERT INTO `pay_payapicompatibility` VALUES ('4', '125', 'OrderMoney');
INSERT INTO `pay_payapicompatibility` VALUES ('5', '125', 'ProductName');
INSERT INTO `pay_payapicompatibility` VALUES ('6', '125', 'Amount');
INSERT INTO `pay_payapicompatibility` VALUES ('7', '125', 'ProductLogo');
INSERT INTO `pay_payapicompatibility` VALUES ('8', '125', 'Username');
INSERT INTO `pay_payapicompatibility` VALUES ('9', '125', 'Email');
INSERT INTO `pay_payapicompatibility` VALUES ('10', '125', 'Mobile');
INSERT INTO `pay_payapicompatibility` VALUES ('11', '125', 'AdditionalInfo');
INSERT INTO `pay_payapicompatibility` VALUES ('12', '125', 'Merchant_url');
INSERT INTO `pay_payapicompatibility` VALUES ('13', '125', 'Return_url');
INSERT INTO `pay_payapicompatibility` VALUES ('14', '125', 'Md5Sign');
INSERT INTO `pay_payapicompatibility` VALUES ('15', '125', 'NoticeType');
INSERT INTO `pay_payapicompatibility` VALUES ('16', '126', 'p0_Cmd');
INSERT INTO `pay_payapicompatibility` VALUES ('17', '126', 'p1_MerId');
INSERT INTO `pay_payapicompatibility` VALUES ('18', '126', 'p2_Order');
INSERT INTO `pay_payapicompatibility` VALUES ('19', '126', 'p3_Amt');
INSERT INTO `pay_payapicompatibility` VALUES ('20', '126', 'p4_Cur');
INSERT INTO `pay_payapicompatibility` VALUES ('21', '126', 'p5_Pid');
INSERT INTO `pay_payapicompatibility` VALUES ('22', '126', 'p6_Pcat');
INSERT INTO `pay_payapicompatibility` VALUES ('23', '126', 'p7_Pdesc');
INSERT INTO `pay_payapicompatibility` VALUES ('24', '126', 'p8_Url');
INSERT INTO `pay_payapicompatibility` VALUES ('25', '126', 'p9_SAF');
INSERT INTO `pay_payapicompatibility` VALUES ('26', '126', 'pa_MP');
INSERT INTO `pay_payapicompatibility` VALUES ('27', '126', 'pd_FrpId');
INSERT INTO `pay_payapicompatibility` VALUES ('28', '126', 'pr_NeedResponse');
INSERT INTO `pay_payapicompatibility` VALUES ('29', '126', 'hmac');
INSERT INTO `pay_payapicompatibility` VALUES ('30', '127', 'service');
INSERT INTO `pay_payapicompatibility` VALUES ('31', '127', 'merchant_ID');
INSERT INTO `pay_payapicompatibility` VALUES ('32', '127', 'notify_url');
INSERT INTO `pay_payapicompatibility` VALUES ('33', '127', 'return_url');
INSERT INTO `pay_payapicompatibility` VALUES ('34', '127', 'sign');
INSERT INTO `pay_payapicompatibility` VALUES ('35', '127', 'sign_type');
INSERT INTO `pay_payapicompatibility` VALUES ('36', '127', 'charset');
INSERT INTO `pay_payapicompatibility` VALUES ('37', '127', 'title');
INSERT INTO `pay_payapicompatibility` VALUES ('38', '127', 'body');
INSERT INTO `pay_payapicompatibility` VALUES ('39', '127', 'order_no');
INSERT INTO `pay_payapicompatibility` VALUES ('40', '127', 'total_fee');
INSERT INTO `pay_payapicompatibility` VALUES ('41', '127', 'payment_type');
INSERT INTO `pay_payapicompatibility` VALUES ('42', '127', 'paymethod');
INSERT INTO `pay_payapicompatibility` VALUES ('43', '127', 'pay_cus_no');
INSERT INTO `pay_payapicompatibility` VALUES ('44', '127', 'defaultbank');
INSERT INTO `pay_payapicompatibility` VALUES ('45', '127', 'seller_email');
INSERT INTO `pay_payapicompatibility` VALUES ('46', '127', 'buyer_email');
INSERT INTO `pay_payapicompatibility` VALUES ('47', '128', 'bank_code');
INSERT INTO `pay_payapicompatibility` VALUES ('48', '128', 'client_ip');
INSERT INTO `pay_payapicompatibility` VALUES ('49', '128', 'extend_param');
INSERT INTO `pay_payapicompatibility` VALUES ('50', '128', 'extra_return_param');
INSERT INTO `pay_payapicompatibility` VALUES ('51', '128', 'input_charset');
INSERT INTO `pay_payapicompatibility` VALUES ('52', '128', 'interface_version');
INSERT INTO `pay_payapicompatibility` VALUES ('53', '128', 'merchant_code');
INSERT INTO `pay_payapicompatibility` VALUES ('54', '128', 'notify_url');
INSERT INTO `pay_payapicompatibility` VALUES ('55', '128', 'order_amount');
INSERT INTO `pay_payapicompatibility` VALUES ('56', '128', 'order_no');
INSERT INTO `pay_payapicompatibility` VALUES ('57', '128', 'order_time');
INSERT INTO `pay_payapicompatibility` VALUES ('58', '128', 'product_code');
INSERT INTO `pay_payapicompatibility` VALUES ('59', '128', 'product_desc');
INSERT INTO `pay_payapicompatibility` VALUES ('60', '128', 'product_name');
INSERT INTO `pay_payapicompatibility` VALUES ('61', '128', 'product_num');
INSERT INTO `pay_payapicompatibility` VALUES ('62', '128', 'return_url');
INSERT INTO `pay_payapicompatibility` VALUES ('63', '128', 'service_type');
INSERT INTO `pay_payapicompatibility` VALUES ('64', '128', 'show_url');
INSERT INTO `pay_payapicompatibility` VALUES ('65', '128', 'sign');
INSERT INTO `pay_payapicompatibility` VALUES ('66', '129', 'Mer_code');
INSERT INTO `pay_payapicompatibility` VALUES ('67', '129', 'Billno');
INSERT INTO `pay_payapicompatibility` VALUES ('68', '129', 'Amount');
INSERT INTO `pay_payapicompatibility` VALUES ('69', '129', 'Date');
INSERT INTO `pay_payapicompatibility` VALUES ('70', '129', 'Currency_Type');
INSERT INTO `pay_payapicompatibility` VALUES ('71', '129', 'Gateway_Type');
INSERT INTO `pay_payapicompatibility` VALUES ('72', '129', 'Lang');
INSERT INTO `pay_payapicompatibility` VALUES ('73', '129', 'Merchanturl');
INSERT INTO `pay_payapicompatibility` VALUES ('74', '129', 'FailUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('75', '129', 'Attach');
INSERT INTO `pay_payapicompatibility` VALUES ('76', '129', 'OrderEncodeType');
INSERT INTO `pay_payapicompatibility` VALUES ('77', '129', 'RetEncodeType');
INSERT INTO `pay_payapicompatibility` VALUES ('78', '129', 'Rettype');
INSERT INTO `pay_payapicompatibility` VALUES ('79', '129', 'ServerUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('80', '129', 'SignMD5');
INSERT INTO `pay_payapicompatibility` VALUES ('81', '130', 'version');
INSERT INTO `pay_payapicompatibility` VALUES ('82', '130', 'charset');
INSERT INTO `pay_payapicompatibility` VALUES ('83', '130', 'transType');
INSERT INTO `pay_payapicompatibility` VALUES ('84', '130', 'merAbbr');
INSERT INTO `pay_payapicompatibility` VALUES ('85', '130', 'merId');
INSERT INTO `pay_payapicompatibility` VALUES ('86', '130', 'merCode');
INSERT INTO `pay_payapicompatibility` VALUES ('87', '130', 'acqCode');
INSERT INTO `pay_payapicompatibility` VALUES ('88', '130', 'backEndUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('89', '130', 'frontEndUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('90', '130', 'orderTime');
INSERT INTO `pay_payapicompatibility` VALUES ('91', '130', 'orderNumber');
INSERT INTO `pay_payapicompatibility` VALUES ('92', '130', 'commodityName');
INSERT INTO `pay_payapicompatibility` VALUES ('93', '130', 'commodityUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('94', '130', 'commodityUnitPrice');
INSERT INTO `pay_payapicompatibility` VALUES ('95', '130', 'commodityQuantity');
INSERT INTO `pay_payapicompatibility` VALUES ('96', '130', 'transferFee');
INSERT INTO `pay_payapicompatibility` VALUES ('97', '130', 'commodityDiscount');
INSERT INTO `pay_payapicompatibility` VALUES ('98', '130', 'orderAmount');
INSERT INTO `pay_payapicompatibility` VALUES ('99', '130', 'orderCurrency');
INSERT INTO `pay_payapicompatibility` VALUES ('100', '130', 'customerName');
INSERT INTO `pay_payapicompatibility` VALUES ('101', '130', 'defaultPayType');
INSERT INTO `pay_payapicompatibility` VALUES ('102', '131', 'characterSet');
INSERT INTO `pay_payapicompatibility` VALUES ('103', '131', 'callbackUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('104', '131', 'notifyUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('105', '131', 'ipAddress');
INSERT INTO `pay_payapicompatibility` VALUES ('106', '131', 'merchantId');
INSERT INTO `pay_payapicompatibility` VALUES ('107', '131', 'requestId');
INSERT INTO `pay_payapicompatibility` VALUES ('108', '131', 'signType');
INSERT INTO `pay_payapicompatibility` VALUES ('109', '131', 'type');
INSERT INTO `pay_payapicompatibility` VALUES ('110', '131', 'version');
INSERT INTO `pay_payapicompatibility` VALUES ('111', '131', 'merchantCert');
INSERT INTO `pay_payapicompatibility` VALUES ('112', '131', 'hmac');
INSERT INTO `pay_payapicompatibility` VALUES ('113', '131', 'amount');
INSERT INTO `pay_payapicompatibility` VALUES ('114', '131', 'bankAbbr');
INSERT INTO `pay_payapicompatibility` VALUES ('115', '131', 'currency');
INSERT INTO `pay_payapicompatibility` VALUES ('116', '131', 'orderDate');
INSERT INTO `pay_payapicompatibility` VALUES ('117', '131', 'orderId');
INSERT INTO `pay_payapicompatibility` VALUES ('118', '131', 'merAcDate');
INSERT INTO `pay_payapicompatibility` VALUES ('119', '131', 'period');
INSERT INTO `pay_payapicompatibility` VALUES ('120', '131', 'periodUnit');
INSERT INTO `pay_payapicompatibility` VALUES ('121', '131', 'merchantAbbr');
INSERT INTO `pay_payapicompatibility` VALUES ('122', '131', 'productDesc');
INSERT INTO `pay_payapicompatibility` VALUES ('123', '131', 'productId');
INSERT INTO `pay_payapicompatibility` VALUES ('124', '131', 'productName');
INSERT INTO `pay_payapicompatibility` VALUES ('125', '131', 'productNum');
INSERT INTO `pay_payapicompatibility` VALUES ('126', '131', 'reserved1');
INSERT INTO `pay_payapicompatibility` VALUES ('127', '131', 'reserved2');
INSERT INTO `pay_payapicompatibility` VALUES ('128', '131', 'userToken');
INSERT INTO `pay_payapicompatibility` VALUES ('129', '131', 'showUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('130', '131', 'couponsFlag');
INSERT INTO `pay_payapicompatibility` VALUES ('131', '132', 'interfaceVersion');
INSERT INTO `pay_payapicompatibility` VALUES ('132', '132', 'tranType');
INSERT INTO `pay_payapicompatibility` VALUES ('133', '132', 'bankCode');
INSERT INTO `pay_payapicompatibility` VALUES ('134', '132', 'payProducts');
INSERT INTO `pay_payapicompatibility` VALUES ('135', '132', 'merNo');
INSERT INTO `pay_payapicompatibility` VALUES ('136', '132', 'goodsName');
INSERT INTO `pay_payapicompatibility` VALUES ('137', '132', 'goodsDesc');
INSERT INTO `pay_payapicompatibility` VALUES ('138', '132', 'orderDate');
INSERT INTO `pay_payapicompatibility` VALUES ('139', '132', 'orderNo');
INSERT INTO `pay_payapicompatibility` VALUES ('140', '132', 'amount');
INSERT INTO `pay_payapicompatibility` VALUES ('141', '132', 'goodId');
INSERT INTO `pay_payapicompatibility` VALUES ('142', '132', 'merUserId');
INSERT INTO `pay_payapicompatibility` VALUES ('143', '132', 'merExtend');
INSERT INTO `pay_payapicompatibility` VALUES ('144', '132', 'customerName');
INSERT INTO `pay_payapicompatibility` VALUES ('145', '132', 'mobileNo');
INSERT INTO `pay_payapicompatibility` VALUES ('146', '132', 'customerEmail');
INSERT INTO `pay_payapicompatibility` VALUES ('147', '132', 'customerID');
INSERT INTO `pay_payapicompatibility` VALUES ('148', '132', 'charSet');
INSERT INTO `pay_payapicompatibility` VALUES ('149', '132', 'tradeMode');
INSERT INTO `pay_payapicompatibility` VALUES ('150', '132', 'expireTime');
INSERT INTO `pay_payapicompatibility` VALUES ('151', '132', 'reqTime');
INSERT INTO `pay_payapicompatibility` VALUES ('152', '132', 'reqIp');
INSERT INTO `pay_payapicompatibility` VALUES ('153', '132', 'respMode');
INSERT INTO `pay_payapicompatibility` VALUES ('154', '132', 'callbackUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('155', '132', 'serverCallUrl');
INSERT INTO `pay_payapicompatibility` VALUES ('156', '132', 'signType');
INSERT INTO `pay_payapicompatibility` VALUES ('157', '132', 'signMsg');

-- ----------------------------
-- Table structure for pay_payapiconfig
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapiconfig`;
CREATE TABLE `pay_payapiconfig` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payapiid` int(11) DEFAULT '0',
  `disabled` int(11) DEFAULT '0',
  `default` int(11) NOT NULL DEFAULT '0',
  `websiteid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapiconfig
-- ----------------------------
INSERT INTO `pay_payapiconfig` VALUES ('1', '136', '0', '1', '0');
INSERT INTO `pay_payapiconfig` VALUES ('2', '144', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('3', '137', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('4', '138', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('5', '145', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('6', '141', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('7', '146', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('8', '147', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('9', '148', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('10', '149', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('11', '150', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('12', '151', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('13', '154', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('14', '155', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('15', '156', '0', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('16', '157', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('17', '158', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('18', '159', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('19', '160', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('20', '161', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('21', '162', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('22', '163', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('23', '164', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('24', '165', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('25', '166', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('26', '167', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('27', '168', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('28', '169', '1', '0', '0');
INSERT INTO `pay_payapiconfig` VALUES ('29', '170', '1', '0', '0');

-- ----------------------------
-- Table structure for pay_paylog
-- ----------------------------
DROP TABLE IF EXISTS `pay_paylog`;
CREATE TABLE `pay_paylog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `out_trade_no` varchar(50) NOT NULL,
  `result_code` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `fromuser` varchar(50) NOT NULL,
  `time_end` int(11) unsigned NOT NULL DEFAULT '0',
  `total_fee` smallint(6) unsigned NOT NULL DEFAULT '0',
  `payname` varchar(50) NOT NULL,
  `bank_type` varchar(20) DEFAULT NULL,
  `trade_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_TRD` (`transaction_id`),
  UNIQUE KEY `IND_ORD` (`out_trade_no`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_paylog
-- ----------------------------
INSERT INTO `pay_paylog` VALUES ('1', '20170415221358925859', 'SUCCESS', '4002922001201704157147285980', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'JSAPI');
INSERT INTO `pay_paylog` VALUES ('2', '20170415221828882942732', 'SUCCESS', '4010092001201704157149174533', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('7', '20170415222525662466', 'SUCCESS', '4002922001201704157147587594', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('11', '20170415212238446810', 'SUCCESS', '4010092001201704157141569732', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('12', '20170415222844139787', 'SUCCESS', '4002922001201704157149424771', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('14', '20170415223013399355', 'SUCCESS', '4002922001201704157150347389', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('15', '20170415223236109561', 'SUCCESS', '4002922001201704157149506388', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('16', '20170415223553296204', 'SUCCESS', '4002922001201704157147906257', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('17', '20170415223948872840', 'SUCCESS', '4010092001201704157149696706', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('21', '20170415224125823352141', 'SUCCESS', '4010092001201704157145904494', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '10', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('27', '2017041522462519189592', 'SUCCESS', '4010092001201704157149803558', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '10', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('60', '20170420215254176538', 'SUCCESS', '4002922001201704207739062031', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('70', '20170424104606101535', 'SUCCESS', '4002922001201704248151212812', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('71', '20170424105520561025', 'SUCCESS', '4002922001201704248153471541', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('73', '20170424114042971024', 'SUCCESS', '4002922001201704248157456824', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('78', '20170424114720569850', 'SUCCESS', '4002922001201704248162767412', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('85', '2017042412090532', 'SUCCESS', '4002922001201704248159742907', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('99', '2017042412594413', 'SUCCESS', '4010092001201704248167483173', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('116', '2017042402443434', 'SUCCESS', '4002922001201704248178159069', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'JSAPI');
INSERT INTO `pay_paylog` VALUES ('124', '9223372036854775807', 'SUCCESS', '4002922001201704248183029128', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('131', '20170424153128488763', 'SUCCESS', '4002922001201704248187112639', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('135', '20170424153442224059', 'SUCCESS', '4002922001201704248183600406', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('140', '20170424153757457926', 'SUCCESS', '4002922001201704248185533038', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('145', '20170424154018268711', 'SUCCESS', '4002922001201704248182210233', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('151', '20170424154436582496', 'SUCCESS', '4002922001201704248182283722', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('158', '20170424154846200427', 'SUCCESS', '4002922001201704248185766969', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('162', '20170424155246101564', 'SUCCESS', '4002922001201704248184025500', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('163', '20170424155857369710', 'SUCCESS', '4002922001201704248187821447', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'JSAPI');
INSERT INTO `pay_paylog` VALUES ('164', '20170424160846962346', 'SUCCESS', '4002922001201704248190457499', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('165', '2017042510181167', 'SUCCESS', '4002922001201704258265387967', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('166', '2017042511353039', 'SUCCESS', '4010092001201704258273701130', 'oJYCAsw6QRYc2U6WgknJrn6CVmWo', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('167', '2017042703542344', 'SUCCESS', '4002922001201704278545320947', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'JSAPI');
INSERT INTO `pay_paylog` VALUES ('168', '2017042704135949', 'SUCCESS', '4002922001201704278545840553', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('169', '20170504081641450', 'SUCCESS', '4008052001201705049566919150', 'oJYCAs4PgrJd3yklK_olY17oMegM', '4294967295', '100', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('170', '20170507231935854805', 'SUCCESS', '4002922001201705079983909067', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('171', '20170523124722363331', 'SUCCESS', '4002922001201705232188820396', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('172', '20170523150515348402', 'SUCCESS', '4002922001201705232205009540', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');
INSERT INTO `pay_paylog` VALUES ('173', '20170523154131640116', 'SUCCESS', '4002922001201705232209515774', 'oJYCAs78BUy-P7QBfAvEDU87mmR0', '4294967295', '20', 'WXGzh', 'CFT', 'NATIVE');

-- ----------------------------
-- Table structure for pay_pcjjr
-- ----------------------------
DROP TABLE IF EXISTS `pay_pcjjr`;
CREATE TABLE `pay_pcjjr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `datetime` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_pcjjr
-- ----------------------------
INSERT INTO `pay_pcjjr` VALUES ('13', '0', '2014-09-09');
INSERT INTO `pay_pcjjr` VALUES ('5', '0', '2014-09-11');
INSERT INTO `pay_pcjjr` VALUES ('4', '0', '2014-09-10');
INSERT INTO `pay_pcjjr` VALUES ('7', '0', '2014-09-24');
INSERT INTO `pay_pcjjr` VALUES ('8', '0', '2014-06-20');
INSERT INTO `pay_pcjjr` VALUES ('9', '0', '2014-09-18');
INSERT INTO `pay_pcjjr` VALUES ('10', '0', '2014-09-17');
INSERT INTO `pay_pcjjr` VALUES ('11', '0', '2014-09-02');
INSERT INTO `pay_pcjjr` VALUES ('14', '0', '2017-04-01');
INSERT INTO `pay_pcjjr` VALUES ('15', '0', '2017-07-01');

-- ----------------------------
-- Table structure for pay_route
-- ----------------------------
DROP TABLE IF EXISTS `pay_route`;
CREATE TABLE `pay_route` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `urlstr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_route
-- ----------------------------

-- ----------------------------
-- Table structure for pay_sms
-- ----------------------------
DROP TABLE IF EXISTS `pay_sms`;
CREATE TABLE `pay_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) DEFAULT '0',
  `fetionuser` varchar(300) DEFAULT NULL,
  `fetionpass` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_sms
-- ----------------------------
INSERT INTO `pay_sms` VALUES ('1', '0', '15871707089', 'a10251219');

-- ----------------------------
-- Table structure for pay_systembank
-- ----------------------------
DROP TABLE IF EXISTS `pay_systembank`;
CREATE TABLE `pay_systembank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bankcode` varchar(100) DEFAULT NULL,
  `bankname` varchar(300) DEFAULT NULL,
  `images` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_systembank
-- ----------------------------
INSERT INTO `pay_systembank` VALUES ('162', 'BOB', '北京银行', 'BOB.gif');
INSERT INTO `pay_systembank` VALUES ('164', 'BEA', '东亚银行', 'BEA.gif');
INSERT INTO `pay_systembank` VALUES ('165', 'ICBC', '中国工商银行', 'ICBC.gif');
INSERT INTO `pay_systembank` VALUES ('166', 'CEB', '中国光大银行', 'CEB.gif');
INSERT INTO `pay_systembank` VALUES ('167', 'GDB', '广发银行', 'GDB.gif');
INSERT INTO `pay_systembank` VALUES ('168', 'HXB', '华夏银行', 'HXB.gif');
INSERT INTO `pay_systembank` VALUES ('169', 'CCB', '中国建设银行', 'CCB.gif');
INSERT INTO `pay_systembank` VALUES ('170', 'BCM', '交通银行', 'BCM.gif');
INSERT INTO `pay_systembank` VALUES ('171', 'CMSB', '中国民生银行', 'CMSB.gif');
INSERT INTO `pay_systembank` VALUES ('172', 'NJCB', '南京银行', 'NJCB.gif');
INSERT INTO `pay_systembank` VALUES ('173', 'NBCB', '宁波银行', 'NBCB.gif');
INSERT INTO `pay_systembank` VALUES ('174', 'ABC', '中国农业银行', '5414c87492ad8.gif');
INSERT INTO `pay_systembank` VALUES ('175', 'PAB', '平安银行', '5414c0929a632.gif');
INSERT INTO `pay_systembank` VALUES ('176', 'BOS', '上海银行', 'BOS.gif');
INSERT INTO `pay_systembank` VALUES ('177', 'SPDB', '上海浦东发展银行', 'SPDB.gif');
INSERT INTO `pay_systembank` VALUES ('178', 'SDB', '深圳发展银行', 'SDB.gif');
INSERT INTO `pay_systembank` VALUES ('179', 'CIB', '兴业银行', 'CIB.gif');
INSERT INTO `pay_systembank` VALUES ('180', 'PSBC', '中国邮政储蓄银行', 'PSBC.gif');
INSERT INTO `pay_systembank` VALUES ('181', 'CMBC', '招商银行', 'CMBC.gif');
INSERT INTO `pay_systembank` VALUES ('182', 'CZB', '浙商银行', 'CZB.gif');
INSERT INTO `pay_systembank` VALUES ('183', 'BOC', '中国银行', 'BOC.gif');
INSERT INTO `pay_systembank` VALUES ('184', 'CNCB', '中信银行', 'CNCB.gif');
INSERT INTO `pay_systembank` VALUES ('193', 'ALIPAY', '支付宝', '58b83a5820644.jpg');
INSERT INTO `pay_systembank` VALUES ('194', 'WXZF', '微信支付', '58b83a757a298.jpg');

-- ----------------------------
-- Table structure for pay_tikuanconfig
-- ----------------------------
DROP TABLE IF EXISTS `pay_tikuanconfig`;
CREATE TABLE `pay_tikuanconfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `tkzxmoney` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '单笔最小提款金额',
  `tkzdmoney` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '单笔最大提款金额',
  `dayzdmoney` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '当日提款最大总金额',
  `dayzdnum` int(11) NOT NULL DEFAULT '0' COMMENT '当日提款最大次数',
  `t1zt` smallint(6) NOT NULL DEFAULT '0',
  `t0zt` smallint(6) NOT NULL DEFAULT '0',
  `gmt0` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `tkzt` smallint(6) NOT NULL DEFAULT '0',
  `tktype` smallint(6) NOT NULL DEFAULT '0',
  `systemxz` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tikuanconfig
-- ----------------------------
INSERT INTO `pay_tikuanconfig` VALUES ('1', '0', '0', '100.0000', '10000.0000', '100000.0000', '10', '1', '1', '0.00', '1', '1', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('2', '0', '7', '100.0000', '99999.0000', '999999.0000', '10', '1', '1', '10.00', '1', '0', '1');
INSERT INTO `pay_tikuanconfig` VALUES ('3', '0', '8', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('4', '0', '10', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('5', '1', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('6', '0', '6', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('7', '0', '11', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('8', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('9', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('10', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('11', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('12', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('13', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('14', '0', '12', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('15', '0', '13', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('16', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('17', '0', '14', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('18', '0', '19', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('19', '0', '20', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('20', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('21', '0', '0', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('22', '0', '24', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');
INSERT INTO `pay_tikuanconfig` VALUES ('23', '0', '25', '0.0000', '0.0000', '0.0000', '0', '0', '0', '0.00', '0', '0', '0');

-- ----------------------------
-- Table structure for pay_tikuandateconfig
-- ----------------------------
DROP TABLE IF EXISTS `pay_tikuandateconfig`;
CREATE TABLE `pay_tikuandateconfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `baiks` int(11) DEFAULT '0',
  `baijs` int(11) DEFAULT '0',
  `wanks` int(11) DEFAULT '0',
  `wanjs` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tikuandateconfig
-- ----------------------------
INSERT INTO `pay_tikuandateconfig` VALUES ('1', '0', '24', '17', '18', '24');

-- ----------------------------
-- Table structure for pay_tikuanmoney
-- ----------------------------
DROP TABLE IF EXISTS `pay_tikuanmoney`;
CREATE TABLE `pay_tikuanmoney` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `payapiid` int(11) NOT NULL DEFAULT '0',
  `t` int(11) NOT NULL DEFAULT '0',
  `money` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `datetype` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=490 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tikuanmoney
-- ----------------------------
INSERT INTO `pay_tikuanmoney` VALUES ('1', '20', '0', '138', '0', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('2', '19', '0', '137', '1', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('3', '19', '0', '138', '1', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('4', '19', '0', '157', '1', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('5', '19', '0', '158', '1', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('6', '19', '0', '159', '1', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('7', '19', '0', '137', '0', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('8', '7', '0', '137', '0', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('9', '7', '0', '159', '0', '0.00000', '');
INSERT INTO `pay_tikuanmoney` VALUES ('10', '19', '0', '144', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('11', '19', '0', '144', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('12', '19', '0', '144', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('13', '19', '0', '144', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('14', '19', '0', '144', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('15', '19', '0', '144', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('16', '19', '0', '137', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('17', '19', '0', '137', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('18', '19', '0', '137', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('19', '19', '0', '137', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('20', '19', '0', '137', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('21', '19', '0', '137', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('22', '19', '0', '138', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('23', '19', '0', '138', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('24', '19', '0', '138', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('25', '19', '0', '138', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('26', '19', '0', '138', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('27', '19', '0', '138', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('28', '19', '0', '157', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('29', '19', '0', '157', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('30', '19', '0', '157', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('31', '19', '0', '157', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('32', '19', '0', '157', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('33', '19', '0', '157', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('34', '19', '0', '158', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('35', '19', '0', '158', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('36', '19', '0', '158', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('37', '19', '0', '158', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('38', '19', '0', '158', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('39', '19', '0', '158', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('40', '19', '0', '159', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('41', '19', '0', '159', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('42', '19', '0', '159', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('43', '19', '0', '159', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('44', '19', '0', '159', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('45', '19', '0', '159', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('46', '19', '0', '160', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('47', '19', '0', '160', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('48', '19', '0', '160', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('49', '19', '0', '160', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('50', '19', '0', '160', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('51', '19', '0', '160', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('52', '19', '0', '161', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('53', '19', '0', '161', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('54', '19', '0', '161', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('55', '19', '0', '161', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('56', '19', '0', '161', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('57', '19', '0', '161', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('58', '19', '0', '162', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('59', '19', '0', '162', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('60', '19', '0', '162', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('61', '19', '0', '162', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('62', '19', '0', '162', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('63', '19', '0', '162', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('64', '19', '0', '163', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('65', '19', '0', '163', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('66', '19', '0', '163', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('67', '19', '0', '163', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('68', '19', '0', '163', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('69', '19', '0', '163', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('70', '19', '0', '164', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('71', '19', '0', '164', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('72', '19', '0', '164', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('73', '19', '0', '164', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('74', '19', '0', '164', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('75', '19', '0', '164', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('76', '25', '0', '144', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('77', '25', '0', '144', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('78', '25', '0', '144', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('79', '25', '0', '144', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('80', '25', '0', '144', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('81', '25', '0', '144', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('82', '25', '0', '137', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('83', '25', '0', '137', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('84', '25', '0', '137', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('85', '25', '0', '137', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('86', '25', '0', '137', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('87', '25', '0', '137', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('88', '25', '0', '138', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('89', '25', '0', '138', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('90', '25', '0', '138', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('91', '25', '0', '138', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('92', '25', '0', '138', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('93', '25', '0', '138', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('94', '25', '0', '157', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('95', '25', '0', '157', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('96', '25', '0', '157', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('97', '25', '0', '157', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('98', '25', '0', '157', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('99', '25', '0', '157', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('100', '25', '0', '158', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('101', '25', '0', '158', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('102', '25', '0', '158', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('103', '25', '0', '158', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('104', '25', '0', '158', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('105', '25', '0', '158', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('106', '25', '0', '159', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('107', '25', '0', '159', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('108', '25', '0', '159', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('109', '25', '0', '159', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('110', '25', '0', '159', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('111', '25', '0', '159', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('112', '25', '0', '160', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('113', '25', '0', '160', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('114', '25', '0', '160', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('115', '25', '0', '160', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('116', '25', '0', '160', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('117', '25', '0', '160', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('118', '25', '0', '161', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('119', '25', '0', '161', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('120', '25', '0', '161', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('121', '25', '0', '161', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('122', '25', '0', '161', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('123', '25', '0', '161', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('124', '25', '0', '162', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('125', '25', '0', '162', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('126', '25', '0', '162', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('127', '25', '0', '162', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('128', '25', '0', '162', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('129', '25', '0', '162', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('130', '25', '0', '163', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('131', '25', '0', '163', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('132', '25', '0', '163', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('133', '25', '0', '163', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('134', '25', '0', '163', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('135', '25', '0', '163', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('136', '25', '0', '164', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('137', '25', '0', '164', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('138', '25', '0', '164', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('139', '25', '0', '164', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('140', '25', '0', '164', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('141', '25', '0', '164', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('142', '19', '0', '165', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('143', '19', '0', '165', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('144', '19', '0', '165', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('145', '19', '0', '165', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('146', '19', '0', '165', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('147', '19', '0', '165', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('148', '19', '0', '166', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('149', '19', '0', '166', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('150', '19', '0', '166', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('151', '19', '0', '166', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('152', '19', '0', '166', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('153', '19', '0', '166', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('154', '19', '0', '167', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('155', '19', '0', '167', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('156', '19', '0', '167', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('157', '19', '0', '167', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('158', '19', '0', '167', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('159', '19', '0', '167', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('160', '25', '0', '165', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('161', '25', '0', '165', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('162', '25', '0', '165', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('163', '25', '0', '165', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('164', '25', '0', '165', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('165', '25', '0', '165', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('166', '25', '0', '166', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('167', '25', '0', '166', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('168', '25', '0', '166', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('169', '25', '0', '166', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('170', '25', '0', '166', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('171', '25', '0', '166', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('172', '25', '0', '167', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('173', '25', '0', '167', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('174', '25', '0', '167', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('175', '25', '0', '167', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('176', '25', '0', '167', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('177', '25', '0', '167', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('178', '20', '0', '144', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('179', '20', '0', '144', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('180', '20', '0', '144', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('181', '20', '0', '144', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('182', '20', '0', '144', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('183', '20', '0', '144', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('184', '20', '0', '137', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('185', '20', '0', '137', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('186', '20', '0', '137', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('187', '20', '0', '137', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('188', '20', '0', '137', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('189', '20', '0', '137', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('190', '20', '0', '138', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('191', '20', '0', '138', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('192', '20', '0', '138', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('193', '20', '0', '138', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('194', '20', '0', '138', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('195', '20', '0', '138', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('196', '20', '0', '157', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('197', '20', '0', '157', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('198', '20', '0', '157', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('199', '20', '0', '157', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('200', '20', '0', '157', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('201', '20', '0', '157', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('202', '20', '0', '158', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('203', '20', '0', '158', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('204', '20', '0', '158', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('205', '20', '0', '158', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('206', '20', '0', '158', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('207', '20', '0', '158', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('208', '20', '0', '159', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('209', '20', '0', '159', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('210', '20', '0', '159', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('211', '20', '0', '159', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('212', '20', '0', '159', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('213', '20', '0', '159', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('214', '20', '0', '160', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('215', '20', '0', '160', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('216', '20', '0', '160', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('217', '20', '0', '160', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('218', '20', '0', '160', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('219', '20', '0', '160', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('220', '20', '0', '161', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('221', '20', '0', '161', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('222', '20', '0', '161', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('223', '20', '0', '161', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('224', '20', '0', '161', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('225', '20', '0', '161', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('226', '20', '0', '162', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('227', '20', '0', '162', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('228', '20', '0', '162', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('229', '20', '0', '162', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('230', '20', '0', '162', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('231', '20', '0', '162', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('232', '20', '0', '163', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('233', '20', '0', '163', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('234', '20', '0', '163', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('235', '20', '0', '163', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('236', '20', '0', '163', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('237', '20', '0', '163', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('238', '20', '0', '164', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('239', '20', '0', '164', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('240', '20', '0', '164', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('241', '20', '0', '164', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('242', '20', '0', '164', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('243', '20', '0', '164', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('244', '20', '0', '165', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('245', '20', '0', '165', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('246', '20', '0', '165', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('247', '20', '0', '165', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('248', '20', '0', '165', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('249', '20', '0', '165', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('250', '20', '0', '166', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('251', '20', '0', '166', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('252', '20', '0', '166', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('253', '20', '0', '166', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('254', '20', '0', '166', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('255', '20', '0', '166', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('256', '20', '0', '167', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('257', '20', '0', '167', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('258', '20', '0', '167', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('259', '20', '0', '167', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('260', '20', '0', '167', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('261', '20', '0', '167', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('262', '24', '0', '144', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('263', '24', '0', '144', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('264', '24', '0', '144', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('265', '24', '0', '144', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('266', '24', '0', '144', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('267', '24', '0', '144', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('268', '24', '0', '137', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('269', '24', '0', '137', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('270', '24', '0', '137', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('271', '24', '0', '137', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('272', '24', '0', '137', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('273', '24', '0', '137', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('274', '24', '0', '138', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('275', '24', '0', '138', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('276', '24', '0', '138', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('277', '24', '0', '138', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('278', '24', '0', '138', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('279', '24', '0', '138', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('280', '24', '0', '157', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('281', '24', '0', '157', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('282', '24', '0', '157', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('283', '24', '0', '157', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('284', '24', '0', '157', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('285', '24', '0', '157', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('286', '24', '0', '158', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('287', '24', '0', '158', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('288', '24', '0', '158', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('289', '24', '0', '158', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('290', '24', '0', '158', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('291', '24', '0', '158', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('292', '24', '0', '159', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('293', '24', '0', '159', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('294', '24', '0', '159', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('295', '24', '0', '159', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('296', '24', '0', '159', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('297', '24', '0', '159', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('298', '24', '0', '160', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('299', '24', '0', '160', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('300', '24', '0', '160', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('301', '24', '0', '160', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('302', '24', '0', '160', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('303', '24', '0', '160', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('304', '24', '0', '161', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('305', '24', '0', '161', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('306', '24', '0', '161', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('307', '24', '0', '161', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('308', '24', '0', '161', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('309', '24', '0', '161', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('310', '24', '0', '162', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('311', '24', '0', '162', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('312', '24', '0', '162', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('313', '24', '0', '162', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('314', '24', '0', '162', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('315', '24', '0', '162', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('316', '24', '0', '163', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('317', '24', '0', '163', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('318', '24', '0', '163', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('319', '24', '0', '163', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('320', '24', '0', '163', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('321', '24', '0', '163', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('322', '24', '0', '164', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('323', '24', '0', '164', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('324', '24', '0', '164', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('325', '24', '0', '164', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('326', '24', '0', '164', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('327', '24', '0', '164', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('328', '24', '0', '165', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('329', '24', '0', '165', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('330', '24', '0', '165', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('331', '24', '0', '165', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('332', '24', '0', '165', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('333', '24', '0', '165', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('334', '24', '0', '166', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('335', '24', '0', '166', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('336', '24', '0', '166', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('337', '24', '0', '166', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('338', '24', '0', '166', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('339', '24', '0', '166', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('340', '24', '0', '167', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('341', '24', '0', '167', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('342', '24', '0', '167', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('343', '24', '0', '167', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('344', '24', '0', '167', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('345', '24', '0', '167', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('346', '19', '0', '168', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('347', '19', '0', '168', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('348', '19', '0', '168', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('349', '19', '0', '168', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('350', '19', '0', '168', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('351', '19', '0', '168', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('352', '0', '0', '170', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('353', '0', '0', '170', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('354', '0', '0', '170', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('355', '0', '0', '170', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('356', '0', '0', '170', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('357', '0', '0', '170', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('358', '25', '0', '168', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('359', '25', '0', '168', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('360', '25', '0', '168', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('361', '25', '0', '168', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('362', '25', '0', '168', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('363', '25', '0', '168', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('364', '25', '0', '169', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('365', '25', '0', '169', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('366', '25', '0', '169', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('367', '25', '0', '169', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('368', '25', '0', '169', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('369', '25', '0', '169', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('370', '25', '0', '170', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('371', '25', '0', '170', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('372', '25', '0', '170', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('373', '25', '0', '170', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('374', '25', '0', '170', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('375', '25', '0', '170', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('376', '7', '0', '144', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('377', '7', '0', '144', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('378', '7', '0', '144', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('379', '7', '0', '144', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('380', '7', '0', '144', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('381', '7', '0', '144', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('382', '7', '0', '137', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('383', '7', '0', '137', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('384', '7', '0', '137', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('385', '7', '0', '137', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('386', '7', '0', '137', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('387', '7', '0', '137', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('388', '7', '0', '138', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('389', '7', '0', '138', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('390', '7', '0', '138', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('391', '7', '0', '138', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('392', '7', '0', '138', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('393', '7', '0', '138', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('394', '7', '0', '157', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('395', '7', '0', '157', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('396', '7', '0', '157', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('397', '7', '0', '157', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('398', '7', '0', '157', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('399', '7', '0', '157', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('400', '7', '0', '158', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('401', '7', '0', '158', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('402', '7', '0', '158', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('403', '7', '0', '158', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('404', '7', '0', '158', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('405', '7', '0', '158', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('406', '7', '0', '159', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('407', '7', '0', '159', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('408', '7', '0', '159', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('409', '7', '0', '159', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('410', '7', '0', '159', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('411', '7', '0', '159', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('412', '7', '0', '160', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('413', '7', '0', '160', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('414', '7', '0', '160', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('415', '7', '0', '160', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('416', '7', '0', '160', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('417', '7', '0', '160', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('418', '7', '0', '161', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('419', '7', '0', '161', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('420', '7', '0', '161', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('421', '7', '0', '161', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('422', '7', '0', '161', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('423', '7', '0', '161', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('424', '7', '0', '162', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('425', '7', '0', '162', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('426', '7', '0', '162', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('427', '7', '0', '162', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('428', '7', '0', '162', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('429', '7', '0', '162', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('430', '7', '0', '163', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('431', '7', '0', '163', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('432', '7', '0', '163', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('433', '7', '0', '163', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('434', '7', '0', '163', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('435', '7', '0', '163', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('436', '7', '0', '164', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('437', '7', '0', '164', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('438', '7', '0', '164', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('439', '7', '0', '164', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('440', '7', '0', '164', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('441', '7', '0', '164', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('442', '7', '0', '165', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('443', '7', '0', '165', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('444', '7', '0', '165', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('445', '7', '0', '165', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('446', '7', '0', '165', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('447', '7', '0', '165', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('448', '7', '0', '166', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('449', '7', '0', '166', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('450', '7', '0', '166', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('451', '7', '0', '166', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('452', '7', '0', '166', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('453', '7', '0', '166', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('454', '7', '0', '167', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('455', '7', '0', '167', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('456', '7', '0', '167', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('457', '7', '0', '167', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('458', '7', '0', '167', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('459', '7', '0', '167', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('460', '7', '0', '168', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('461', '7', '0', '168', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('462', '7', '0', '168', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('463', '7', '0', '168', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('464', '7', '0', '168', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('465', '7', '0', '168', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('466', '7', '0', '169', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('467', '7', '0', '169', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('468', '7', '0', '169', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('469', '7', '0', '169', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('470', '7', '0', '169', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('471', '7', '0', '169', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('472', '7', '0', '170', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('473', '7', '0', '170', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('474', '7', '0', '170', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('475', '7', '0', '170', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('476', '7', '0', '170', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('477', '7', '0', '170', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('478', '19', '0', '169', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('479', '19', '0', '169', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('480', '19', '0', '169', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('481', '19', '0', '169', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('482', '19', '0', '169', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('483', '19', '0', '169', '1', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('484', '19', '0', '170', '0', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('485', '19', '0', '170', '0', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('486', '19', '0', '170', '0', '0.00000', 'j');
INSERT INTO `pay_tikuanmoney` VALUES ('487', '19', '0', '170', '1', '0.00000', 'b');
INSERT INTO `pay_tikuanmoney` VALUES ('488', '19', '0', '170', '1', '0.00000', 'w');
INSERT INTO `pay_tikuanmoney` VALUES ('489', '19', '0', '170', '1', '0.00000', 'j');

-- ----------------------------
-- Table structure for pay_tjjjr
-- ----------------------------
DROP TABLE IF EXISTS `pay_tjjjr`;
CREATE TABLE `pay_tjjjr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `datetime` date NOT NULL,
  `shuoming` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tjjjr
-- ----------------------------
INSERT INTO `pay_tjjjr` VALUES ('13', '0', '2014-09-09', '国庆');
INSERT INTO `pay_tjjjr` VALUES ('8', '0', '2014-06-20', null);
INSERT INTO `pay_tjjjr` VALUES ('10', '0', '2014-09-16', '儿童节');
INSERT INTO `pay_tjjjr` VALUES ('11', '0', '2014-09-03', '在在在');
INSERT INTO `pay_tjjjr` VALUES ('12', '0', '2014-09-05', '林枯要');
INSERT INTO `pay_tjjjr` VALUES ('14', '0', '2014-09-19', '中秋节');

-- ----------------------------
-- Table structure for pay_tklist
-- ----------------------------
DROP TABLE IF EXISTS `pay_tklist`;
CREATE TABLE `pay_tklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `bankname` varchar(300) NOT NULL,
  `bankfenname` varchar(300) NOT NULL,
  `bankzhiname` varchar(300) NOT NULL,
  `banknumber` varchar(300) NOT NULL,
  `bankfullname` varchar(300) NOT NULL,
  `sheng` varchar(300) NOT NULL,
  `shi` varchar(300) NOT NULL,
  `sqdatetime` datetime DEFAULT NULL,
  `cldatetime` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `tkmoney` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `sxfmoney` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `money` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `t` int(4) NOT NULL DEFAULT '1',
  `payapiid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tklist
-- ----------------------------
INSERT INTO `pay_tklist` VALUES ('9', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:02:05', '2015-04-25 03:35:44', '0', '100.0000', '0.0000', '100.0000', '0', '125');
INSERT INTO `pay_tklist` VALUES ('10', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:22:04', '2015-04-25 03:35:28', '0', '100.0000', '12.0000', '88.0000', '1', '125');
INSERT INTO `pay_tklist` VALUES ('11', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:29:34', '2015-04-25 03:35:20', '0', '100.0000', '12.0000', '88.0000', '1', '125');
INSERT INTO `pay_tklist` VALUES ('12', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:29:47', '2017-04-13 02:31:00', '2', '100.0000', '12.0000', '88.0000', '1', '125');
INSERT INTO `pay_tklist` VALUES ('13', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:30:11', '2017-04-07 22:55:13', '2', '100.0000', '0.0000', '100.0000', '1', '129');
INSERT INTO `pay_tklist` VALUES ('14', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:30:20', '2015-04-25 03:50:37', '2', '100.0000', '0.0000', '100.0000', '1', '129');
INSERT INTO `pay_tklist` VALUES ('15', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-01-03 23:30:30', '2017-04-07 22:55:07', '2', '123.0000', '0.0000', '123.0000', '1', '129');
INSERT INTO `pay_tklist` VALUES ('17', '7', '中国民生银行', 'sagsdgsgsagasgas', '', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-04-25 16:22:18', '2017-04-07 15:59:48', '2', '100.0000', '12.0000', '88.0000', '1', '125');
INSERT INTO `pay_tklist` VALUES ('18', '7', '中国民生银行', 'sagsdgsgsagasgas', '大富豪123', 'gasdgsadgsadgsagasgd', 'asgsadgsadgsadgsadgsadg', '山西省', '晋城市', '2015-04-25 16:26:40', '2017-04-06 11:01:42', '2', '100.0000', '0.0000', '100.0000', '0', '125');

-- ----------------------------
-- Table structure for pay_user
-- ----------------------------
DROP TABLE IF EXISTS `pay_user`;
CREATE TABLE `pay_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(300) NOT NULL,
  `usertype` tinyint(4) DEFAULT '4',
  `superioruserid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '上家用户id',
  `websiteid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分站id',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0 未激活，1  正常，2 禁用',
  `email` varchar(500) NOT NULL,
  `activate` varchar(500) DEFAULT NULL,
  `regdatetime` int(11) unsigned DEFAULT '0',
  `activatedatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_user
-- ----------------------------
INSERT INTO `pay_user` VALUES ('1', 'adminroot', '0', '0', '0', '1', '', null, null, null);
INSERT INTO `pay_user` VALUES ('7', 'demo', '5', '12', '0', '1', '22345678@qq.com', 'fdf558d4c24a15a6e63e8a923a313f2e9126fba04637ff45115c09dd8496e454', '2014', '2014-02-25 13:33:58');
INSERT INTO `pay_user` VALUES ('19', 'user1234', '5', '1', '0', '1', '22691531@qq.com', 'f4ee69d8e67390608905ea1680dbe480d3525889e5fd2172743075592e09620c', '1491149186', '2017-04-03 00:08:21');
INSERT INTO `pay_user` VALUES ('20', 'xiayu3', '4', '19', '0', '1', '182@qq.com', '1d83067e470fd4ccc6b830b0f3e50020407a536c0baeeb32661c453e5757f6b6', '1491235668', null);
INSERT INTO `pay_user` VALUES ('25', '123', '4', '24', '0', '2', '123456@qq.com', '3d00b44aa0a2acc6d1fd2c9ecf89149235de170fc7836ea645e1a7d7b307ff6e', '1492017227', null);
INSERT INTO `pay_user` VALUES ('24', 'hyrmw111', '5', '1', '0', '1', '1260089111@qq.com', '7faad95a8121d2a4dc26ea1e56a4aa97fe1290d9a5dc167df4be7cb97ef11f67', '1491540040', '2017-04-07 12:41:10');

-- ----------------------------
-- Table structure for pay_userbasicinfo
-- ----------------------------
DROP TABLE IF EXISTS `pay_userbasicinfo`;
CREATE TABLE `pay_userbasicinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `sex` smallint(6) NOT NULL DEFAULT '1',
  `birthday` date DEFAULT NULL,
  `sfznumber` varchar(30) DEFAULT NULL,
  `phonenumber` varchar(30) DEFAULT NULL,
  `qqnumber` varchar(30) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_userbasicinfo
-- ----------------------------
INSERT INTO `pay_userbasicinfo` VALUES ('7', '7', '郜溪', '1', '2017-03-23', '340621197810134831', '13301686250', '340621197810134831', '中国上海');
INSERT INTO `pay_userbasicinfo` VALUES ('18', '20', null, '1', null, null, null, null, null);
INSERT INTO `pay_userbasicinfo` VALUES ('23', '25', null, '1', null, null, null, null, null);

-- ----------------------------
-- Table structure for pay_userpassword
-- ----------------------------
DROP TABLE IF EXISTS `pay_userpassword`;
CREATE TABLE `pay_userpassword` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `loginpassword` varchar(300) NOT NULL,
  `paypassword` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_userpassword
-- ----------------------------
INSERT INTO `pay_userpassword` VALUES ('7', '7', '25d55ad283aa400af464c76d713c07ad', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `pay_userpassword` VALUES ('11', '1', 'f6fdffe48c908deb0f4c3bd36c032e72', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `pay_userpassword` VALUES ('18', '19', 'c33367701511b4f6020ec61ded352059', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `pay_userpassword` VALUES ('19', '20', '133701a417efb408ad4d000bb9f69e0f', '133701a417efb408ad4d000bb9f69e0f');
INSERT INTO `pay_userpassword` VALUES ('23', '24', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `pay_userpassword` VALUES ('24', '25', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70');

-- ----------------------------
-- Table structure for pay_userpayapi
-- ----------------------------
DROP TABLE IF EXISTS `pay_userpayapi`;
CREATE TABLE `pay_userpayapi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `payapicontent` varchar(300) DEFAULT NULL,
  `defaultpayapi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_userpayapi
-- ----------------------------
INSERT INTO `pay_userpayapi` VALUES ('12', '7', 'WxGzh|WxSm|Wlzhifu|Qiantong|XyJsapi|Haike|Alipay|Unionpay|Mbpay|Wftwx|Ips|', '');
INSERT INTO `pay_userpayapi` VALUES ('26', '20', '|Mfhcdnative|Qianyifu|Ips|WxGzh|WxSm|', '');
INSERT INTO `pay_userpayapi` VALUES ('25', '19', 'WxGzh|WxSm|Uka|Wlzhifu|Yespay|', 'WxGzh');
INSERT INTO `pay_userpayapi` VALUES ('30', '24', '|Ips|IpsZfb|', '');
INSERT INTO `pay_userpayapi` VALUES ('31', '25', '', '');

-- ----------------------------
-- Table structure for pay_userpayapizhanghao
-- ----------------------------
DROP TABLE IF EXISTS `pay_userpayapizhanghao`;
CREATE TABLE `pay_userpayapizhanghao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `payapiid` int(11) NOT NULL,
  `defaultpayapiuserid` int(11) unsigned NOT NULL DEFAULT '0',
  `feilv` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `fengding` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_userpayapizhanghao
-- ----------------------------
INSERT INTO `pay_userpayapizhanghao` VALUES ('67', '19', '159', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('2', '7', '129', '115', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('5', '7', '130', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('6', '7', '131', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('9', '7', '132', '118', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('17', '7', '125', '111', '0.00000', '555.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('74', '7', '169', '37', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('75', '7', '170', '38', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('72', '7', '167', '35', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('73', '7', '168', '36', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('22', '7', '127', '0', '0.00400', '500.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('69', '7', '165', '33', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('71', '7', '166', '34', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('25', '7', '126', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('26', '7', '133', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('68', '7', '164', '32', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('28', '7', '135', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('60', '19', '137', '1', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('30', '7', '134', '158', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('56', '7', '159', '5', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('65', '19', '157', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('34', '7', '151', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('64', '7', '137', '1', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('55', '7', '158', '4', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('59', '19', '138', '2', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('54', '7', '138', '2', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('39', '24', '144', '0', '1.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('66', '19', '158', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('41', '24', '151', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('42', '24', '157', '190', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('43', '7', '144', '7', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('63', '7', '163', '31', '0.10000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('57', '20', '138', '2', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('62', '7', '162', '30', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('47', '24', '146', '0', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('61', '7', '161', '8', '0.00000', '0.00');
INSERT INTO `pay_userpayapizhanghao` VALUES ('58', '20', '137', '1', '0.00000', '0.00');

-- ----------------------------
-- Table structure for pay_userverifyinfo
-- ----------------------------
DROP TABLE IF EXISTS `pay_userverifyinfo`;
CREATE TABLE `pay_userverifyinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `uploadsfzzm` varchar(500) DEFAULT NULL,
  `uploadsfzbm` varchar(500) DEFAULT NULL,
  `uploadscsfz` varchar(500) DEFAULT NULL,
  `uploadyhkzm` varchar(500) DEFAULT NULL,
  `uploadyhkbm` varchar(500) DEFAULT NULL,
  `uploadyyzz` varchar(500) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `domain` varchar(200) DEFAULT NULL,
  `md5key` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_userverifyinfo
-- ----------------------------
INSERT INTO `pay_userverifyinfo` VALUES ('7', '7', '553a540058c61.jpg', '553a540b11255.jpg', '553a541c2df31.jpg', '552e1c4fa112a.PNG', '552e1c354620d.png', '553a5ae88d4c1.jpg', '1', 'pay.17588.com', '6qNCl9z4M8VbZMyPEyqlzOes1IXA3u');
INSERT INTO `pay_userverifyinfo` VALUES ('17', '19', '58ec9ea09806f.jpg', '58ec9eaa7f148.jpg', '58ec9eb60d784.jpg', '58ec9ed596e2b.jpg', '58ec9ee222286.jpg', '58ec9eeab1351.jpg', '1', null, '6qNCl9z4M8VbZMyPEyqlzOes1IXA3u');
INSERT INTO `pay_userverifyinfo` VALUES ('18', '20', '58f1fe3a90c27.jpg', '58f1fe4275887.jpg', '58f1fe4a1b272.jpg', '58f1fe522628d.jpg', '58f1fe593a10d.jpg', '58f1fe6053b96.jpg', '1', null, 'V5fIZoAdv7cRcRsMt3aOWVdUAUtUqp');
INSERT INTO `pay_userverifyinfo` VALUES ('22', '24', null, null, null, null, null, null, '0', null, null);
INSERT INTO `pay_userverifyinfo` VALUES ('23', '25', null, null, null, null, null, null, '0', null, null);

-- ----------------------------
-- Table structure for pay_website
-- ----------------------------
DROP TABLE IF EXISTS `pay_website`;
CREATE TABLE `pay_website` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websitename` varchar(300) DEFAULT NULL,
  `websitedomain` varchar(300) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_website
-- ----------------------------
INSERT INTO `pay_website` VALUES ('1', null, null, '11', '0');

-- ----------------------------
-- Table structure for pay_websiteconfig
-- ----------------------------
DROP TABLE IF EXISTS `pay_websiteconfig`;
CREATE TABLE `pay_websiteconfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `websitename` varchar(300) DEFAULT NULL,
  `domain` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `tel` varchar(300) DEFAULT NULL,
  `qq` varchar(300) DEFAULT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `icp` varchar(300) DEFAULT NULL,
  `tongji` varchar(1000) DEFAULT NULL,
  `login` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_websiteconfig
-- ----------------------------
INSERT INTO `pay_websiteconfig` VALUES ('1', '0', '雀付聚合支付系统', 'pay.17588.com', '16132626@qq.com', '4001234456', '22691531', '', '备案号', '统计', 'zypay');

-- ----------------------------
-- Table structure for pay_wttklist
-- ----------------------------
DROP TABLE IF EXISTS `pay_wttklist`;
CREATE TABLE `pay_wttklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `bankname` varchar(300) NOT NULL,
  `bankfenname` varchar(300) NOT NULL,
  `bankzhiname` varchar(300) NOT NULL,
  `banknumber` varchar(300) NOT NULL,
  `bankfullname` varchar(300) NOT NULL,
  `sheng` varchar(300) NOT NULL,
  `shi` varchar(300) NOT NULL,
  `sqdatetime` datetime DEFAULT NULL,
  `cldatetime` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `tkmoney` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `sxfmoney` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `money` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `t` int(4) NOT NULL DEFAULT '1',
  `payapiid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_wttklist
-- ----------------------------
DROP TRIGGER IF EXISTS `moneyupdate`;
DELIMITER ;;
CREATE TRIGGER `moneyupdate` AFTER UPDATE ON `pay_apimoney` FOR EACH ROW BEGIN
	IF NOT EXISTS (SELECT 1 FROM pay_money WHERE userid = new.userid) THEN
       INSERT INTO pay_money (userid,money,freezemoney,wallet) VALUES (new.userid,new.money,new.freezemoney,new.money);
   ELSE
       UPDATE pay_money SET money = (money + (new.money-old.money)), freezemoney = (freezemoney + (new.freezemoney-old.freezemoney)) WHERE userid = new.userid;
   END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `articledel`;
DELIMITER ;;
CREATE TRIGGER `articledel` AFTER DELETE ON `pay_article` FOR EACH ROW BEGIN
    delete from pay_browserecord where article= old.id;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `bankdel`;
DELIMITER ;;
CREATE TRIGGER `bankdel` AFTER DELETE ON `pay_systembank` FOR EACH ROW BEGIN
    delete from pay_payapibank where systembankid = old.id;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `userdel`;
DELIMITER ;;
CREATE TRIGGER `userdel` AFTER DELETE ON `pay_user` FOR EACH ROW BEGIN
    delete from pay_userbasicinfo where userid = old.id;
   delete from pay_userverifyinfo where userid = old.id;
  delete from pay_userpassword where userid = old.id;
   delete from pay_money where userid = old.id;
 delete from pay_apimoney where userid = old.id;
END
;;
DELIMITER ;
SET FOREIGN_KEY_CHECKS=1;
