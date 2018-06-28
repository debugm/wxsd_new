SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pay_apimoney`
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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_apimoney
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_article`
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
-- Table structure for `pay_articleclass`
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
-- Table structure for `pay_bankcard`
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_UID` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_bankcard
-- ----------------------------
INSERT INTO `pay_bankcard` VALUES ('38', '7', '郜溪', '6225882104206377', '招商银行', '', '招商银行上海分行常德支行', '上海市市辖区', '上海市', '2017-06-14 01:55:00', '2017-07-24 01:55:00', '116.225.115.207', '上海市嘉定区-电信', '1');

-- ----------------------------
-- Table structure for `pay_browserecord`
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

-- ----------------------------
-- Table structure for `pay_email`
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
INSERT INTO `pay_email` VALUES ('1', '0', 'smtpdm.aliyun.com', '465', 'info@mail.tianniu.cc', 'Mailpush123', 'info@mail.tianniu.cc', '支付平台');

-- ----------------------------
-- Table structure for `pay_invitecode`
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

-- ----------------------------
-- Table structure for `pay_inviteconfig`
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
-- Table structure for `pay_loginrecord`
-- ----------------------------
DROP TABLE IF EXISTS `pay_loginrecord`;
CREATE TABLE `pay_loginrecord` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `logindatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loginip` varchar(100) NOT NULL,
  `loginaddress` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_loginrecord
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_money`
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_money
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_moneychange`
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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_moneychange
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_newsclass`
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
-- Table structure for `pay_newscontent`
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
-- Table structure for `pay_order`
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_ORD` (`pay_orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=297 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_order
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_payapi`
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapi`;
CREATE TABLE `pay_payapi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `en_payname` varchar(300) DEFAULT NULL,
  `zh_payname` varchar(300) DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_ENM` (`en_payname`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapi
-- ----------------------------
INSERT INTO `pay_payapi` VALUES ('144', 'Ips', '环讯IPS', '');
INSERT INTO `pay_payapi` VALUES ('136', 'Default', '系统集成接口', '');
INSERT INTO `pay_payapi` VALUES ('137', 'WxGzh', '微信公众号支付', '');
INSERT INTO `pay_payapi` VALUES ('138', 'WxSm', '微信扫码支付-官方', '');

-- ----------------------------
-- Table structure for `pay_payapiaccount`
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
  `defaultrate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '下家费率',
  `fengding` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '封顶手续费',
  `rate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '银行费率',
  `defaultpayapiuser` bigint(20) NOT NULL DEFAULT '0',
  `keykey` varchar(100) DEFAULT NULL,
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapiaccount
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_payapibank`
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapibank`;
CREATE TABLE `pay_payapibank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `systembankid` int(11) DEFAULT NULL,
  `payapiconfigid` int(11) DEFAULT NULL,
  `bankcode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapibank
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_payapicompatibility`
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
-- Table structure for `pay_payapiconfig`
-- ----------------------------
DROP TABLE IF EXISTS `pay_payapiconfig`;
CREATE TABLE `pay_payapiconfig` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payapiid` int(11) DEFAULT '0',
  `disabled` int(11) DEFAULT '0',
  `default` int(11) NOT NULL DEFAULT '0',
  `websiteid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payapiconfig
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_paylog`
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
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_paylog
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_pcjjr`
-- ----------------------------
DROP TABLE IF EXISTS `pay_pcjjr`;
CREATE TABLE `pay_pcjjr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `datetime` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
INSERT INTO `pay_pcjjr` VALUES ('16', '0', '2017-06-10');

-- ----------------------------
-- Table structure for `pay_route`
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
-- Table structure for `pay_sms`
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
-- Table structure for `pay_systembank`
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
-- Table structure for `pay_tikuanconfig`
-- ----------------------------
DROP TABLE IF EXISTS `pay_tikuanconfig`;
CREATE TABLE `pay_tikuanconfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `tkzxmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '单笔最小提款金额',
  `tkzdmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '单笔最大提款金额',
  `dayzdmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '当日提款最大总金额',
  `dayzdnum` int(11) NOT NULL DEFAULT '0' COMMENT '当日提款最大次数',
  `t1zt` smallint(6) NOT NULL DEFAULT '0',
  `t0zt` smallint(6) NOT NULL DEFAULT '0',
  `gmt0` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `tkzt` smallint(6) NOT NULL DEFAULT '0',
  `tktype` smallint(6) NOT NULL DEFAULT '0',
  `systemxz` smallint(6) NOT NULL DEFAULT '0',
  `sxfrate` varchar(20) NOT NULL,
  `sxffixed` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IND_UID` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tikuanconfig
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_tikuandateconfig`
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
-- Table structure for `pay_tikuanmoney`
-- ----------------------------
DROP TABLE IF EXISTS `pay_tikuanmoney`;
CREATE TABLE `pay_tikuanmoney` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `websiteid` int(11) NOT NULL DEFAULT '0',
  `payapiid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `t` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `datetype` varchar(2) NOT NULL,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tikuanmoney
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_tjjjr`
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
-- Table structure for `pay_tklist`
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
  `tkmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `sxfmoney` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `t` int(4) NOT NULL DEFAULT '1',
  `payapiid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_tklist
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_user`
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
  `activatedatetime` int(11) unsigned DEFAULT '0' COMMENT '激活时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_user
-- ----------------------------
INSERT INTO `pay_user` VALUES ('1', 'adminroot', '0', '0', '0', '1', '', null, null, null);

-- ----------------------------
-- Table structure for `pay_userbasicinfo`
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

-- ----------------------------
-- Table structure for `pay_userpassword`
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
INSERT INTO `pay_userpassword` VALUES ('11', '1', '', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for `pay_userpayapi`
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

-- ----------------------------
-- Table structure for `pay_userpayapizhanghao`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_userpayapizhanghao
-- ----------------------------

-- ----------------------------
-- Table structure for `pay_userverifyinfo`
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

-- ----------------------------
-- Table structure for `pay_website`
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
-- Table structure for `pay_websiteconfig`
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
-- Table structure for `pay_wttklist`
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
