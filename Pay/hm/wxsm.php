<?php
require 'ApiClient.php';

$client = new ApiClient();
//$client->appId = '2018020565757938';
//$client->secret = 'ABx20hEQnZVayqJUjI81Ki7lgt9GeYPu';
$client->appId = '2018031171827642';
$client->secret = 'JNnA35doGiZ8K9DwWpr1ObajSfghyEPv';
$mid = "20180225150354026148";



$response = $client->call('weixin.qr_code_pay', [
    'merchant_no' => $_REQUEST['mid'],
    'out_trade_no' => $_REQUEST['oid'],
    'spbill_create_ip' => $_REQUEST['ip'],
    'order_name' => '微信扫码支付',
    'total_amount' => $_REQUEST['amt'],
    //'sub_appid' => $_REQUEST['subid'],
    'notify_url' => $_REQUEST['url'],

]);
file_put_contents('./log.txt.hmwxsm',date('Y-m-d H:i:s').json_encode($response).PHP_EOL,FILE_APPEND);
if($response['error_code'] == 0)
{
	$pay_url = $response['qr_code'];
	echo $pay_url;
}
else
	echo "failed";
//$url = "http://mer.jiandundingzhi.com/Pay/hm/jump.php?url=".urlencode($pay_url);

//header("Location:".$url);


?>
