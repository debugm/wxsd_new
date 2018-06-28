<?php
require 'ApiClient.php';

$client = new ApiClient();
$client->appId = '2018031434859239';
$client->secret = 'uYMxswl9FGhLUP5KCTEHAgpecrODatiQ';
try{
$response = $client->call('unionpay.quickpay', [
    'out_trade_no' => date('YmdHis').rand(1111,9999),
    'user_id' => 123,
    'channel_type' => '07',
    'subject' => '充值',
    'body' => '0',
    'total_amount' => '1',
    'notify_url' => 'http://vip.ziyubaihuo.com/Pay/hm/notify.php',
    'success_url' => 'http://vip.ziyubaihuo.com',

]);
var_dump($response);
}catch(Exception $e)
{
    print $e->getMessage();   
exit();   
}

/*
$pay_url = $response['code_url'];
if(!isset($pay_url))
file_put_contents("./log.hmqq.txt",date('Y-m-d H:i:s').json_encode($response).'---'.$_GET['skid'].PHP_EOL,FILE_APPEND);


$url = "http://vip.ziyubaihuo.com/Pay/hm/jump.php?url=".urlencode($pay_url);

header("Location:".$url);
*/

?>
