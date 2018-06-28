<?php

$url = "http://payment.shopping98.com/scan/pay/gateway";
$key = "3cd53f62141142db8e1792f79aedd805";

$p = array(

		"service" => "v1_scan_pay",
		"version" => "1.0",
		"mch_no" => "707425938644959232",
		"charset" => "UTF-8",
		"req_time" => date('YmdHis'),
		"nonce_str" => time(),
		"out_trade_no" => date('YmdHis'),
		"order_subject" => "UserRecharge",
		"order_desc" => "test",
		"acquirer_type" => "wechat",

		"total_fee" => "1000",
		"notify_url" => "http://localhost",
		"client_ip" => "127.0.0.1",
		"order_time" =>  date('YmdHis'),	

	);
ksort($p);
$str = "";
foreach($p as $k => $v)
{
	$str .= $k ."=". $v ."&";
}
$str = substr($str,0,strlen($str)-1);
$str .= $key;

$p['sign'] = md5($str);
$p['sign_type'] = "MD5";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($p));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
echo $result;


?>
