<?php
require 'ApiClient.php';

$client = new ApiClient();
$client->appId = '2018031171827642';
$client->secret = 'JNnA35doGiZ8K9DwWpr1ObajSfghyEPv';

$response = $client->call('qq.unified', [
    'merchant_no' => $_GET['skid'],
    'out_trade_no' => $_GET['oid'],

    'spbill_create_ip' => '127.0.0.1',
    'order_name' => 'QQ钱包支付测试交易',
    'total_amount' => $_GET['amt'],
    'order_type' => 0,

    'notify_url' => $_GET['url'],

]);



$pay_url = $response['code_url'];
if(!isset($pay_url))
file_put_contents("./log.hmqq.txt",date('Y-m-d H:i:s').json_encode($response).'---'.$_GET['skid'].PHP_EOL,FILE_APPEND);


$url = "http://vip.ziyubaihuo.com/Pay/hm/jump.php?url=".urlencode($pay_url);

header("Location:".$url);


?>
