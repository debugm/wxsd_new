<?php
 
// ######(以下配置为入网测试环境用)#######
// 签名证书路径
//const HFB_PRIVATE_CERT_PATH = 'C:\code\hfb-demo\hfb-merchant-web-demo-php\cert\CS20170907011890_20170907170049931.pfx';
const HFB_PRIVATE_CERT_PATH = "../cert/CS20171226019023_20171226135032635.pfx";
// 签名证书密码
const HFB_PRIVATE_CERT_PWD = '123456';

// 公钥证书
//const HFB_PUBLIC_CERT_PATH = 'C:\code\hfb-demo\hfb-merchant-web-demo-php\cert\SS20170907011890_20170907170049931.cer';
const HFB_PUBLIC_CERT_PATH = "../cert/SS20171226019023_20171226135032635.cer";

// 支付
const HFB_PAY_URL = 'https://cashier.hefupal.com/paygate/v1/web/pay';

// 收银台支付
const HFB_PAY_CASHIER_URL = 'https://cashier.hefupal.com/paygate/v1/web/cashier';

// H5支付
const H5_HFB_PAY_URL = 'https://cashier.hefupal.com/paygate/v1/web/h5/pay';

//商户接收前台通知地址
const MER_RETURN_URL = 'http://112.74.165.55/page/return.php';

//商户接收后台通知地址
const MER_NOTIFY_URL = 'http://112.74.165.55/page/notify.php';

//退款地址
const HFB_REFUND_URL = 'http://paygate.hefupal.cn/paygate/v1/web/refund';

//查询地址
const HFB_QUERY_URL = 'http://paygate.hefupal.cn/paygate/v1/web/query';

//商户号
const MERCHANTNO = 'S20171226019023';

//渠道号
const CHANNELNO = '03';

//H5渠道号
const H5CHANNELNO = '02';

//版本号
const VERSION = 'v1';

//收银台版本号
const CASHIERVERSION = 'v1.1';

//版本号
const UNIONPAYVERSION = 'v1.2';

//日志 目录 
const SDK_LOG_FILE_PATH = 'C:/logs/';

//日志级别
const SDK_LOG_LEVEL = 'DEBUG';

?>