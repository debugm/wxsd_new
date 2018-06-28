<?php

$url = "http://pay.ytcpu.com/quick/pay";
$key = "rrk0v8trq2j1uqs5asgu25fsgc";
$p = array(

		"partner_id" => "20180102150208719000",
		"amount" => "1",
		"pay_type" => "wxh5",
		"out_order_no" => date('YmdHis'),
		"body" => "test",
		"notify_url" => "http://localhost",
		"ip" => "127.0.0.1"
		//"sign" => "",

	
	);

$str = "";

ksort($p);
foreach($p as $k => $v)
{
	$str .= $k ."=". $v ."&" ;
}
$str .= "key=rrk0v8trq2j1uqs5asgu25fsgc";

$p['sign'] = strtoupper(md5($str));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($p));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
echo $result;

?>
