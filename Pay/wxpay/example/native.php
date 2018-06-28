<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
//register_shutdown_function(function(){ var_dump(error_get_last()); });
require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';

//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$notify = new NativePay();
//$url1 = $notify->GetPrePayUrl("123456789");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */

$oid = $_GET['oid'];
$amt = floatval($_GET['amt']) * 100;
//$nurl = $_GET['url'];
$nurl = "http://pay.ziyubaihuo.com/Pay/wxpay/example/testnotify.php";


$input = new WxPayUnifiedOrder();
$appid = $_GET['appid'];
$mchid = $_GET['mchid'];
$input->SetAppid($appid);//公众账号ID
$input->SetMch_id($mchid);//商户号

$input->SetBody("订单充值");
$input->SetAttach("test");
$input->SetOut_trade_no($oid);
$input->SetTotal_fee($amt);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
$input->SetNotify_url($nurl);
$input->SetTrade_type("NATIVE");
$input->SetProduct_id("123456789");
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>中银微信支付</title>
</head>
<body>
	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">微信扫码支付</div><br/>
	<div style="margin-right: 10px;color:red;font-size:15px;font-weight: bolder;">订单号：<?php echo $oid;?></div>
	<div style="margin-right: 10px;color:red;font-size:15px;font-weight: bolder;">支付金额：<?php echo $_GET['amt'];?>元</div>
	<img alt="模式二扫码支付" src="qrcode.php?data=<?php echo urlencode($url2);?>" style="width:250px;height:250px;"/>

	<br/>
	
</body>
</html>
