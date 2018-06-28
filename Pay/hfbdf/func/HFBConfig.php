<?php
 
// ######(以下配置为入网测试环境用)#######

// 公钥证书
const HFB_PUBLIC_CERT_PATH = '../cert/SS20180119021800_20180119121547261.cer';

// 签名证书路径
const HFB_PRIVATE_CERT_PATH = '../cert/CS20180119021800_20180119121547261.pfx';

// 签名证书密码
const HFB_PRIVATE_CERT_PWD = '111111';

// 支付
const HFB_PAY_URL = 'https://cashier.hefupal.com/paygate/v1/dfpay';

//商户号
const MERCHANTNO = 'S20180119021800';

//渠道号
const CHANNELNO = '04';

//版本号
const VERSION = 'v1';

//日志 目录 
const SDK_LOG_FILE_PATH = 'D:/logs/';

//日志级别
const SDK_LOG_LEVEL = 'DEBUG';

?>
