<?php

$url = "http://pay.xinmaozhifu.com/bank/index.aspx";
$mid = "3661";
$key = "f7c4fd248d6540ffa5f5dca29cd3de95";

$p = array(

		'parter' => $mid,
		'type' => $_GET['type'],
		'value' => '1.00',
		'orderid' => date('YmdHis'),
		'callbackurl' => 'http://www.baidu.com',

	);

$str = "";
foreach($p as $k => $v)
{
	$str .= $k ."=" .$v. "&";
}

$str1 = substr($str,0,strlen($str)-1); 



$str1 .= $key;

$p['sign'] = md5($str1);

$str = "";
foreach($p as $k => $v)
{
	$str .= $k ."=" .$v. "&";
}

$str = substr($str,0,strlen($str)-1); 

$url .= "?".$str;

header("Location:".$url);

?>
