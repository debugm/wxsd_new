<?php


$mid = "1063";
$key = "F0272785323941798A41B201786CBBDE";

$url = "http://www.szsflwkj.com/pay/payment";

$p = array(

		//"service" => "HFQQWAP", // yinlian .qq: HFQQWAP
		"service" => "HFYLWAP", // yinlian .qq: HFQQWAP
		"version" => "v1.0",
		"signtype" => "MD5",
		"merchantid" => $mid,
		"shoporderId" => date('YmdHis'),
		"totalamount" => "1.00",
		"productname" => "charge",
		"notify_url" => "http://mer.jiandundingzhi.com/Pay/esd/notify.php",
		"callback_url" => "http://www.baidu.com",
		"nonce_str" => date('YmdHis'),

	);

$str = "";
ksort($p);
foreach($p as $k => $v)
{
	$str .= $k . "=" . $v . "&";
}

$str .= "key=".$key;
$p['sign'] = strtoupper(md5($str));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($p));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$res = json_decode($result,true);
$jump = $res['code_url'];
header("Location:".$jump);
?>


