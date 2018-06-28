<?php
require 'ApiClient.php';

$client = new ApiClient();
//$client->appId = '2018031518846970';
//$client->secret = 'cqN5LYCwXjl728QzTgniG4k6KBeao3Ux';
$client->appId = '2018032864517645';
$client->secret = '1qa3E9FVQlGPIBSwUmtT7Lzkrf45AHO8';
try{
$response = $client->call('unionpay.wap', [
    'out_trade_no' => $_GET['oid'],
    'channel_type' => '07',
    'subject' => '充值',
    'body' => '金粉世家',
    'client_ip' => $_GET['ip'],
    'total_amount' => $_GET['amt'],
    'card_no' => $_GET['cardno'],
    //'pay_type' => 3,
    //'bank_code' => '01050000',
    'notify_url' => $_GET['nurl'],
    'success_url' => 'http://vip.ziyubaihuo.com',

]);
//var_dump($response);
}catch(Exception $e)
{
    print $e->getMessage();   
exit();   
}
$pay_url = $response['pay_url'];
if($pay_url)
{
	header("Location:".$pay_url);
}


/*
$pay_url = $response['code_url'];
if(!isset($pay_url))
file_put_contents("./log.hmqq.txt",date('Y-m-d H:i:s').json_encode($response).'---'.$_GET['skid'].PHP_EOL,FILE_APPEND);


$url = "http://vip.ziyubaihuo.com/Pay/hm/jump.php?url=".urlencode($pay_url);

header("Location:".$url);
*/

?>



